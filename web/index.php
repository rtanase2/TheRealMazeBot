<?php

require('../vendor/autoload.php');

$config = new \Doctrine\DBAL\Configuration();
//..
$connectionParams = array(
    'dbname' => 'sql3115178',
    'user' => 'root',
    'password' => '',
    'host' => 'sql3.freemysqlhosting.net',
    'driver' => 'pdo_mysql',
);
$conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);

$app = new Silex\Application();
$app['debug'] = true;

// Register the monolog logging service
$app->register(new Silex\Provider\MonologServiceProvider(), array(
  'monolog.logfile' => 'php://stderr',
));

// Register view rendering
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/views',
));

// Our web handlers A.K.A. our routes

$app->get('/', function() use($app) {
  return $app['twig']->render('home.html.twig');
});

$app->get('/mazes/all', function() use($app) {
  $config = new \Doctrine\DBAL\Configuration();
//..
  $connectionParams = array(
      'dbname' => 'sql3115178',
      'user' => 'root',
      'password' => '',
      'host' => 'sql3.freemysqlhosting.net',
      'driver' => 'pdo_mysql',
  );
  $conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);
  $conn->query("SELECT 101 FROM mazes");
  return $app['twig']->render('all_mazes.html.twig');
});

$app->get('/mazes/random', function() use($app) {
  $vars = array("id" => 1);
  return $app['twig']->render('maze.html.twig', $vars);
});

$app->get('/mazes/recent', function() use($app) {
  $vars = array("id" => 1);
  return $app['twig']->render('maze.html.twig', $vars);
});

$app->run();
