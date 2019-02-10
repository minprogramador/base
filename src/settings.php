<?php

return [
	'settings' => [
		'displayErrorDetails'   => true,
		'addContentLengthHeader' => false,
		'renderer' => [
			'template_path' => __DIR__ . '/../templates/',
		],
		'logger' => [
			'name' => 'Itouch',
			'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app_'. date("Y-m-d").'.log',
			'level' => \Monolog\Logger::DEBUG,
		],
		'mustache' => [
			'template' => [
				'paths' => [
					 __DIR__ . '/../templates/'
				],
				'extension' => 'html',
				'charset' => 'utf-8',
			],
		]
	]
];
