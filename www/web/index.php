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
$repos = array();
$app['supplier_repo'] = new Selotur\Repository\SupplierRepo($app['db']);

$app->get('/', function (Application $app) {
	$templateData = array();
	return $app['twig']->render('index.twig', $templateData);
});

$app->put('/login', function (Request $request) use ($app) {
	$email = $request->get('email');
	$password = $request->get('password');

	$supplier = $app['supplier_repo']->findByEmailAndPasssword($email, $password);
	if ($supplier == NULL) {
		return $app->redirect('/');
	}
	$app['session']->set('isAut', true);
	$app['session']->set('suplier', $suplier);
	return $app->redirect('/homestead');
});

$app->get('/homestead', function (Application $app) {
	$templateData = array();
	return $app['twig']->render('homestead.twig', $templateData);
});


$app->error(function(\Exception $e, $code) {
    if (DEBUG_MODE) {
    	return $e;
    } else {
    	$app->redirect('/');
    }
    $app->log($e);
});

$app->run();
