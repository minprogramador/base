<?php

namespace App\Config;

use Slim\Http\Request;
use Slim\Http\Response;

class Usuario {
	
	public static function index(Request $request, Response $response) {
		global $app;
		$container = $app->getContainer();
		return $container->renderer->render($response, 'config/config.html', []);

//		$data = array('pagina' => 'index');
	//	return $response->withJson($data);
	}
	
	public static function main(Request $request, Response $response) {
		global $app;
		$container = $app->getContainer();

		// Render index view
		return $container->renderer->render($response, 'config/usuario/index.html', []);


	}
	
}
