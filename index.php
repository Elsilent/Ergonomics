<?php
require_once __DIR__ . '/vendor/autoload.php';
use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$app = new Application();

// db connection
$app['connection'] = pg_connect("host='localhost' port=5432 dbname=Ergonomics user=postgres password=user");
$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options'  => array(
        'driver'   => 'pdo_pgsql',
        'host'     => 'localhost',
        'port'     => '5432',
        'dbname'   => 'Ergonomics',
        'user'     => 'postgres',
        'password' => 'user'
    ),
));

// debug on
$app['debug'] = true;

// twig templates dir
$app->register(new TwigServiceProvider(), array(
    'twig.path' => __DIR__ . '/Views/'
));
// for twig path
$app->register(new UrlGeneratorServiceProvider());
// session
$app->register(new \Silex\Provider\SessionServiceProvider());
// index
$app->get('/', function() use ($app){
    return $app['twig']->render('index.twig', array());
});
// forms
$app->get('/form/{id}', function($id) use ($app){
    return $app['twig']->render('index.twig', array('id' => $id));
})->bind('form')->assert('id', '\d+');

$app->post('/user', function(Request $req) use ($app){
    $app['session']->set('user', ['username' => $req->get('fio')]);
    return $app->redirect('/form/1');
})->bind('user');

$app->get('/statistics', function() use ($app){
    $csv = array_map('str_getcsv', file(__DIR__ . '/Logs/logs.csv'));
    return $app['twig']->render('index.twig', array('statistics' => ['rr']));
})->bind('statistics');

$app->post('/form/{id}/find', function($id, Request $req) use ($app){
    try {
        $user = $app['session']->get('user');
        $user['form' . $id] = $req->get('time');
        $app['session']->set('user', $user);
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

$app->post('/save', function() use ($app){
    try {
        $app['db']->insert('logs', $app['session']->get('user'));
        return $app->redirect('/statistics');
    } catch (\Exception $e) {
        return new Response('Content',
            Response::HTTP_INTERNAL_SERVER_ERROR,
            array('content-type' => 'text/html')
        );
    }
})->bind('save');

$app->get('/data', function() use ($app){
    try {
        $logs = $app['db']->fetchAll('SELECT * FROM logs');
        $out = [];
        foreach($logs as $log) {
            // x - индекс точки по оси X
            // y - значение времени
            // n - на что делим (dwa weightVariableName)
            // s - значение (dwa valueVariableName)
            $out[$log['username']] = [
                $log['form1'] ? [
                    'x' => 0,
                    'y' => $log['form1'],
                    'n' => 1,
                    's' => $log['form1'],
                ] : null,
                $log['form2'] ? [
                    'x' => 1,
                    'y' => $log['form2'],
                    'n' => 1,
                    's' => $log['form2'],
                ] : null,
                $log['form3'] ? [
                    'x' => 2,
                    'y' => $log['form3'],
                    'n' => 1,
                    's' => $log['form3'],
                ] : null,
                $log['form4'] ? [
                    'x' => 3,
                    'y' => $log['form4'],
                    'n' => 1,
                    's' => $log['form4'],
                ] : null,
            ];
        }
        return $app->json($out, 201);
    } catch (\Exception $e) {
        print_r($e);
    }
})->bind('getData');



$app->run();