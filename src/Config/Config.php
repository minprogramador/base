<?php

namespace App\Config;

use Slim\Http\Request;
use Slim\Http\Response;

class Config {
	
	public static function index(Request $request, Response $response) {
		global $app;
		$container = $app->getContainer();
		return $container->renderer->render($response, 'config/config.html', []);

//		$data = array('pagina' => 'index');
	//	return $response->withJson($data);
	}
	
	public static function recsenha(Request $request, Response $response) {
		global $app;
		$data = array('pagina' => 'recuperar senha');
		return $response->withJson($data);
	}
	
	public static function contato(Request $request, Response $response) {
		global $app;
		$data = array('pagina' => 'contato');
		return $response->withJson($data);
	}
	
	public static function login(Request $request, Response $response) {
		global $app;
			// Sample log message
		$container = $app->getContainer();

		// Render index view
		return $container->renderer->render($response, 'config/index.html', []);



//		$data = array('pagina' => 'login');
	//	return $response->withJson($data);
	}
	
}
