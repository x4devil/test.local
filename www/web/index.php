<?php
use Doctrine\DBAL\Connection;
use Silex\Application;
use Silex\Provider\DoctrineServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

define('DEBUG_MODE', true);
define('ROOT_FOLDER', __DIR__ . '/..');

if (php_sapi_name() === 'cli-server' && is_file(__DIR__ . preg_replace('/(\?.*)$/', '', $_SERVER['REQUEST_URI']))) {
	return false;
}
require_once __DIR__.'/../vendor/autoload.php';

Request::enableHttpMethodParameterOverride();

$app = new Silex\Application();

$app -> register(new TwigServiceProvider(), 
		array('twig.path' => __DIR__ . '/../views'));
$app -> register(new DoctrineServiceProvider(), 
	array(
		'db.options' => array(
			'driver' => 'pdo_mysql', 
			'host' => 'localhost',
			'dbname' => 'selotur', 
			'user' => 'root',
			'password' => '', 
			'charset' => 'utf8'
		),
	)
); 
$app->register(new Silex\Provider\SessionServiceProvider());

$app->register(new Silex\Provider\MonologServiceProvider(), array(
    'monolog.logfile' => ROOT_FOLDER . '/logs' . '/selotur.log',
    'monolog.name' => 'selotur.app'
));

//Repositories
$app['supplier_repo'] = new Selotur\Repository\SupplierRepo($app['db']);
$app['homestead_repo'] = new Selotur\Repository\HomesteadRepo($app['db']);
$app['house_repo'] = new Selotur\Repository\HouseRepo($app['db'], $app);
$app['region_repo'] = new Selotur\Repository\RegionRepo($app['db']);
$app['live_type_repo'] = new Selotur\Repository\LiveTypeRepo($app['db']);
$app['photo_repo'] = new Selotur\Repository\PhotoRepo($app['db']);
$app['tourism_type_repo'] = new Selotur\Repository\TourismTypeRepo($app['db']);
$app['service_repo'] = new Selotur\Repository\ServiceRepo($app['db']);
$app['supplier_service_repo'] = new Selotur\Repository\SupplierServiceRepo($app['db']);

if ( DEBUG_MODE ) {
    $logger = new Doctrine\DBAL\Logging\DebugStack();
    $app['db.config']->setSQLLogger($logger);
    $app->error(function(\Exception $e, $code) use ($app, $logger) {
        if ( $e instanceof PDOException and count($logger->queries) ) {
            $query = array_pop($logger->queries);
            $app['monolog']->err($query['sql'], array(
                'params' => $query['params'],
                'types' => $query['types']
            ));
        }
    });
    $app->after(function(Request $request, Response $response) use ($app, $logger) {
        foreach ( $logger->queries as $query ) {
            $app['monolog']->debug($query['sql'], array(
                'params' => $query['params'],
                'types' => $query['types']
            ));
        }
    });
}

$checkPermission = function () use ($app) {
	$auth = $app['session']->get('auth');
	$supplier = $app['session']->get('supplier');

	if (!$auth) {
		return $app->redirect('/');
	}

	if ($supplier == NULL) {
		return $app->redirect('/');
	}
};

$app->get('/', function (Application $app) {
	return $app['twig']->render('index.twig');
});

$app->put('/login', function (Request $request) use ($app) {
	$email = $request->get('email');
	$password = $request->get('password');

	$supplier = $app['supplier_repo']->findByEmailAndPasssword($email, $password);
	if ($supplier == NULL) {
		return $app->redirect('/');
	}
	$homestead = $app['homestead_repo']->findBySupplier($supplier->getId());
	if ($homestead == NULL) {
		return $app->redirect('/');
	}
	$app['session']->set('auth', true);
	$app['session']->set('supplier', $supplier->getId());
	$app['session']->set('homestead', $homestead->getId());
	return $app->redirect('/homestead');
});

$app->get('/logout', function(Application $app) {
	return $app->redirect('/');
});

$app->get('/registration', function (Application $app) {
	return $app['twig']->render('registration.twig');
});

$app->put('/registration', function (Request $request, Application $app) {
	if ($app['supplier_repo']->findByEmail($request->get('email'))) {
		return $app->redirect('/registration');
	}

	$app['homestead_repo']->createSupplier(
		$request->get('email'), 
		$request->get('phone'), 
		$request->get('fio'), 
		$request->get('password'));

	$supplier = $app['supplier_repo']->findByEmailAndPasssword($request->get('email'), $request->get('password'));
	if ($supplier == NULL) {
		return $app->redirect('/');
	}
	$homestead = $app['homestead_repo']->findBySupplier($supplier->getId());
	if ($homestead == NULL) {
		return $app->redirect('/');
	}

	$app['session']->set('auth', true);
	$app['session']->set('supplier', $supplier->getId());
	$app['session']->set('homestead', $homestead->getId());
	return $app->redirect('/homestead');
});

$app->get('/homestead', function (Application $app) {
	$templateData['houses'] = $app['house_repo']->findByHomestead($app['session']->get('homestead'));
	$templateData['homestead'] = $app['homestead_repo']->findBySupplier($app['session']->get('supplier'));
	$templateData['regions'] = $app['region_repo']->findAll();
	$templateData['tourismTypes'] = $app['tourism_type_repo']->findByHomestead($app['session']->get('homestead')); 

 	return $app['twig']->render('homestead.twig', $templateData);
})->before($checkPermission);

$app->put('/homestead', function (Application $app, Request $request) {
	$data = $request->request->all();
	foreach ($data as $id => $val) {
		$app['house_repo']->changeEmptyPlace($id, $val);
	}
	$homestead['id_region'] = $request->get('id_region');
	$homestead['area'] = $request->get('area');
	$homestead['address'] = $request->get('address');

	$app['homestead_repo']->updateHomestead($homestead, $app['session']->get('homestead'));

	// Апдейтим виды туризма
	$types = $app['tourism_type_repo']->findByHomestead($app['session']->get('homestead')); 
	foreach ($types as $type) {
		$data2['active'] = $request->get('type-'.$type->getId()) != NULL 
			? 1 
			: 0;
		$app['tourism_type_repo']->updateTourismType(array('id'=> $type->getId()), $data2);
	}

	return $app->redirect('/homestead');
})->before($checkPermission);


$app->get('/house', function (Application $app) {
	$liveTypes = $app['live_type_repo']->findAll();
	return $app['twig']->render('house.twig', 
		array('liveTypes' => $liveTypes));
})->before($checkPermission);

$app->put('/house', function (Request $request, Application $app) {
	$data = $request->request->all();
	$data['id_homestead'] = $app['session']->get('homestead');
	$data['empty_place'] = $request->get('place');

	$app['house_repo']->insertHouse(
		$app['house_repo']->createArray($data));
	return $app->redirect('/homestead');
})->before($checkPermission);

$app->get('/house/edit/{id}', function (Application $app, $id) {
	$house = $app['house_repo']->findById($id);
	$liveTypes = $app['live_type_repo']->findAll();

	if (!isset($house)
		|| $house->getHomestead() != $app['session']->get('homestead')) {
		return $app->redirect('/homestead');
	}

	$tempalteData['house'] = $house;
	$tempalteData['liveTypes'] = $liveTypes;

	return $app['twig']->render('house.twig', $tempalteData);
})->before($checkPermission);

$app->put('/house/edit/{id}', function (Request $request, Application $app, $id) {
	$data = $request->request->all();
	$data['id_homestead'] = $app['session']->get('homestead');
	$data['empty_place'] = $request->get('place');

	$app['house_repo']->updateHouse(
		$app['house_repo']->createArray($data),
		$id);
	return $app->redirect('/homestead');
})->before($checkPermission);

$app->delete('/house/edit/{id}', function (Application $app, $id) {
	$app['house_repo']->deleteHouse($id);
	return $app->redirect('/homestead');
})->before($checkPermission);

$app->get('/service', function (Application $app) {
	$tempalteData['services'] = $app['service_repo']->findByHomestead($app['session']->get('homestead'));
	$tempalteData['supplierServices'] = $app['supplier_service_repo']->findByHomestead($app['session']->get('homestead'));

	return $app['twig']->render('service.twig', $tempalteData);
})->before($checkPermission);

$app->put('/service', function (Application $app, Request $request ) {
	$type = $request->get('type');
	if ($type == 1) {
		$services = $app['service_repo']->findByHomestead($app['session']->get('homestead'));

		foreach ($services as $service) {
			$price = $request->get('price-'.$service->getIdService());
			$active = $request->get('active-'.$service->getIdService()) != NULL 
				? 1
				: 0;

			$app['service_repo']->updateService(
				$app['session']->get('homestead'),
				$service->getIdService(),
				$price,
				$active);
		}
		//Доп услуги
		$services = $app['supplier_service_repo']->findByHomestead($app['session']->get('homestead'));

		foreach ($services as $service) {
			$id['id_homestead'] = $app['session']->get('homestead');
			$id['id'] = $service->getId();

			$data['name'] = $request->get('supp-name-'.$service->getId());
			$data['price'] = $request->get('supp-price-'.$service->getId());

			$app['supplier_service_repo']->updateService($id, $data);
		}
	} else if ($type == 3) {
		//Добавление услуги
		$data['name'] = $request->get('supp-name');
		$data['price'] = $request->get('supp-price');
		$data['id_homestead'] = $app['session']->get('homestead');

		$app['supplier_service_repo']->insertService($data);
	}

	return $app->redirect('/service');
})->before($checkPermission);

$app->get('/delete/{id}', function(Application $app,$id) {
	$service = $app['supplier_service_repo']->findById($id);
	if ($service == NULL) {
		return $app->redirect('/service');
	}

	if ($service->getHomestead() != $app['session']->get('homestead')) {
		return $app->redirect('/service');
	}

	$app['supplier_service_repo']->deleteService($id);
	return $app->redirect('/service');
})->before($checkPermission);

$app->error(function(\Exception $e, $code) {
    if (DEBUG_MODE) {
    	return $e;
    } else {
    	$app->redirect('/');
    }
    $app->log($e);
});

$app->run();
