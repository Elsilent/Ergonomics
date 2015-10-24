<?php
require_once __DIR__ . '/vendor/autoload.php';
use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;

$app = new Application();

// соединение с БД
$app['connection'] = pg_connect("host='localhost' port=5432 dbname=publish user=postgres password=user");

// debug on
$app['debug'] = true;

// подключаем twig
$app->register(new TwigServiceProvider(), array(
    'twig.path' => __DIR__ . '/Views/'
));
// генератор url'ов
$app->register(new UrlGeneratorServiceProvider());
// index
$app->get('/', function() use ($app){
    return $app['twig']->render('index.twig', array());
});
// forms
$app->get('/form/{id}', function($id) use ($app){
    return $app['twig']->render('index.twig', array('id' => $id));
})->bind('form')->assert('id', '\d+');


$app->run();