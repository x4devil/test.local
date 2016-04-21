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
	$homestead = $app['homestead_repo']->findBySupplier($supplier->getId());
	if ($supplier == NULL || $homestead == NULL) {
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

$app->get('/homestead', function (Application $app) {
	$tempalteData['houses'] = $app['house_repo']->findByHomestead($app['session']->get('homestead'));
	return $app['twig']->render('homestead.twig', $tempalteData);
})->before($checkPermission);


$app->get('/house', function (Application $app) {
	return $app['twig']->render('house.twig');
})->before($checkPermission);

$app->put('/house', function (Request $request, Application $app) {
	$data = $request->request->all();
	$data['id_homestead'] = $app['session']->get('homestead');
	$data['empty_place'] = $request->get('place');

	$app['house_repo']->insertHouse(
		$app['house_repo']->createArray($data));
	return $app->redirect('/homestead');
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