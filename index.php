<?php
require_once __DIR__ . '/vendor/autoload.php';
use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$app = new Application();

// db connection
//$app['connection'] = pg_connect("host='localhost' port=5432 dbname=publish user=postgres password=user");

// debug on
$app['debug'] = true;

// twig templates dir
$app->register(new TwigServiceProvider(), array(
    'twig.path' => __DIR__ . '/Views/'
));
// for twig path
$app->register(new UrlGeneratorServiceProvider());
// index
$app->get('/', function() use ($app){
    return $app['twig']->render('index.twig', array());
});
// forms
$app->get('/form/{id}', function($id) use ($app){
    return $app['twig']->render('index.twig', array('id' => $id));
})->bind('form')->assert('id', '\d+');

$app->post('/form/{id}/find', function($id, Request $req) use ($app){
    try {
        // обычные логи
        $log = fopen(__DIR__ . '/Logs/logs', 'a+');
        $logcsv = fopen(__DIR__ . '/Logs/logs.csv', 'a+');
        fwrite($log, "Form{$id}:" . PHP_EOL);
        fwrite($log, "Time('Min:sec:msec'):{$req->get('time')}" . PHP_EOL);
        fwrite($log, "==================" . PHP_EOL);
        fclose($log);
        // логи в формате csv
        fputcsv($logcsv, array("Form{$id}", "{$req->get('time')}"));
        fclose($logcsv);
        return new Response('Content',
            Response::HTTP_OK,
            array('content-type' => 'text/html')
        );
    } catch (\Exception $e) {
        return new Response('Content',
            Response::HTTP_INTERNAL_SERVER_ERROR,
            array('content-type' => 'text/html')
        );
    }
})->bind('find')->assert('id', '\d+');


$app->run();