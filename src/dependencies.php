<?php
// DIC configuration

$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

$container['notFoundHandler'] = function ($c) {
	return function ($request, $response) use ($c) {
	$c->logger->alert("acesso.incomum");

	$response = new \Slim\Http\Response(404);
		return $response->write("Page not found");
	};
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
	$logger->pushProcessor(new Monolog\Processor\WebProcessor());
	$logger->pushProcessor(new Monolog\Processor\UidProcessor());
	$handler = new Monolog\Handler\StreamHandler($settings['path'], $settings['level']);
    $logger->pushHandler($handler);
    return $logger;
};

$container['pdo'] = function ($c) {
	$pdo_config = $c->get('settings')['db'];

	$dsn =  "mysql:host={$pdo_config['host']};".
			"dbname={$pdo_config['dbname']};".
			"charset=utf8";

	$usr = $pdo_config['user'];
	$pwd = $pdo_config['password'];

	$pdo = new \Slim\PDO\Database($dsn, $usr, $pwd);

	return $pdo;
};
