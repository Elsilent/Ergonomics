<?php
require_once __DIR__ . '/vendor/autoload.php';
use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$app = new Application();

// db connection
$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options'  => array(
        'driver'   => 'pdo_pgsql',
        'host'     => 'localhost',
        'port'     => '5432',
        'dbname'   => 'Ergonomics',
        'user'     => 'postgres',
//        'password' => 'postgres'
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
//    $csv = array_map('str_getcsv', file(__DIR__ . '/Logs/logs.csv'));
    return $app['twig']->render('index.twig', array('statistics' => true));
})->bind('statistics');

$app->get('/progress', function() use ($app){
    try {
        $usernames = $app['db']->fetchAll('SELECT DISTINCT username FROM logs;');
    } catch (\Exception $e) {
        return new Response('DB error',
            Response::HTTP_INTERNAL_SERVER_ERROR,
            array('content-type' => 'text/html')
        );
    }
    return $app['twig']->render('index.twig', array('progress' => true, 'usernames' => $usernames));
})->bind('progress');

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
        return new Response('OK',
            Response::HTTP_OK,
            array('content-type' => 'text/html')
        );
    } catch (\Exception $e) {
        return new Response('Write error',
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
        return new Response('DB error',
            Response::HTTP_NOT_FOUND,
            array('content-type' => 'text/html')
        );
    }
})->bind('save');

$app->get('/data', function() use ($app){
    try {
        $logs = $app['db']->fetchAll(
            'SELECT * FROM logs
             WHERE
             form1 IS NOT NULL AND
             form2 IS NOT NULL AND
             form3 IS NOT NULL AND
             form4 IS NOT NULL;');
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
        return new Response('DB error',
            Response::HTTP_NOT_FOUND,
            array('content-type' => 'text/html')
        );
    }
})->bind('getData');

$app->get('/statistics/average', function() use ($app){
    try {
        $log = $app['db']->fetchAll(
            'SELECT avg(form1) as form1, avg(form2) as form2, avg(form3) as form3, avg(form4) as form4 FROM logs
             WHERE
              form1 IS NOT NULL AND
              form2 IS NOT NULL AND
              form3 IS NOT NULL AND
              form4 IS NOT NULL;');
        $out = [];
        foreach($log as $log) {
            $out[] = [
                'x' => 0,
                'y' => (int)$log['form1'],
                'n' => 1,
                's' => (int)$log['form1'],
            ];
            $out[] = [
                'x' => 1,
                'y' => (int)$log['form2'],
                'n' => 1,
                's' => (int)$log['form2'],
            ];
            $out[] = [
                'x' => 2,
                'y' => (int)$log['form3'],
                'n' => 1,
                's' => (int)$log['form3'],
            ];
            $out[] = [
                'x' => 3,
                'y' => (int)$log['form4'],
                'n' => 1,
                's' => (int)$log['form4'],
            ];
        }
        return $app->json($out, 201);
    } catch (\Exception $e) {
        print_r($e);
        return new Response('DB error',
            Response::HTTP_NOT_FOUND,
            array('content-type' => 'text/html')
        );
    }
})->bind('getAverage');

$app->get('/statistics/{form}', function($form) use ($app){
    try{
        $results = $app['db']->fetchAll(
            "SELECT row_number() OVER (ORDER BY id ASC) as row_num, id, {$form} as form, username FROM logs
             WHERE
             form1 IS NOT NULL AND
             form2 IS NOT NULL AND
             form3 IS NOT NULL AND
             form4 IS NOT NULL
            ORDER BY id ASC LIMIT 20;"
        );
        $out = [];
        foreach($results as $res) {
            // x => row_num - 1, т.к. отсчет с x = 0
            $out['data'][] = [
                'x' => $res['row_num'] - 1,
                'y' => $res['form'],
                'n' => 1,
                's' => $res['form']
            ];
            $out['username'][] = $res['username'];
        }
    } catch (\Exception $e) {
        print_r($e);
        return new Response('DB error',
            Response::HTTP_NOT_FOUND,
            array('content-type' => 'text/html')
        );
    }
    return $app->json($out, 201);
})->bind('getDataByForm');

$app->get('/progress/data/{username}', function($username) use ($app){
    try{
        $results = $app['db']->fetchAll(
          "SELECT row_number() OVER (ORDER BY id ASC) as row_num, * FROM logs
           WHERE username='{$username}'
           ORDER BY id ASC LIMIT 5;"
        );
        $out = [];
        foreach($results as $res) {
            // x - индекс точки по оси X
            // y - значение времени
            // n - на что делим (dwa weightVariableName)
            // s - значение (dwa valueVariableName)
            $out[$res['username']][] = [
                'x' => $res['row_num'],
                'y' => $res['form4'],
                'n' => 1,
                's' => $res['form4']
            ];
        }
    } catch (\Exception $e) {
        print_r($e);
        return new Response('DB error',
            Response::HTTP_NOT_FOUND,
            array('content-type' => 'text/html')
        );
    }
    return $app->json($out, 201);
})->bind('getProgress');

$app->get('/progress/all', function() use ($app) {
   try {
       // t => temp table logs, r => rows by username DESC,
       // row_num => rows by username ASC
       $results = $app['db']->fetchAll(
            "WITH res AS (
                SELECT *
                FROM (
                       SELECT
                         row_number()
                         OVER (PARTITION BY username
                           ORDER BY id DESC) AS r,
                         row_number()
                         OVER (PARTITION BY username
                           ORDER BY id ASC ) AS row_num,
                         t.*
                       FROM
                         logs t) x
                WHERE
                  x.r <= 5
            )
            SELECT * FROM res ORDER BY id ASC;"
       );
       $out = [];
       foreach($results as $res) {
           $out[$res['username']][] = [
               'x' => $res['row_num'],
               'y' => $res['form4'],
               'n' => 1,
               's' => $res['form4']
           ];
       }
   } catch (\Exception $e) {
       print_r($e);
       return new Response('DB error',
           Response::HTTP_NOT_FOUND,
           array('content-type' => 'text/html')
       );
   }
   return $app->json($out, 201);
})->bind('allProgress');



$app->run();
