<?php

return [
	'settings' => [
		'displayErrorDetails'   => true,
		'addContentLengthHeader' => false,
		'renderer' => [
			'template_path' => __DIR__ . '/../tpls/',
		],
		'db' => [
			'host'		=> '127.0.0.1',
			'user'		=> 'root',
			'password'	=> '2019maconhaOk@@',
			'dbname'	=> 'base',
		],
		'logger' => [
			'name' => 'Itouch',
			'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app_'. date("Y-m-d").'.log',
			'level' => \Monolog\Logger::DEBUG,
		]
	]
];
