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

	public static function find(Request $request, Response $response) {
		
		global $app;
		
		$container  = $app->getContainer();
		$stmt	= 
		$container
		->pdo
		->select([
				 	'usuarios.id as id',
				 	'usuarios.usuario as usuario',
				 	'usuarios.email as email',
				 	'usuarios.start as start',
				 	'usuarios.update as `update`',
				 	'usuarios.status as status'
				 ]
		)
		->from('usuarios');
		
		$stmt	= $stmt->execute();
		$data	= $stmt->fetch();

		$dataok = [
			'data' => [
				'attributes' => $data
			]
		];
		return $response->withJson($dataok);

	}
	
	public static function listar(Request $request, Response $response) {

		global $app;

		$container  = $app->getContainer();
		$stmt 		= 
			$container
			->pdo
			->select(
				[
					 'usuarios.id as id',
					'usuarios.usuario as usuario',
					'usuarios.start as start',
					'usuarios.update as `update`',
					'controle.limite as limite',
					'controle.usado as usado',
					'usuarios.status as status'
				]
			)
			->from('usuarios')
			->join('controle', 'controle.usuario', '=', 'usuarios.id');
		
		$currPage	= $_GET['page'] ?? 1;
		$limit		= $_GET['limit'] ?? 5;
		$offset		= $limit;
		$row		= $limit;

		if ($currPage == 1) {
			$offset = $limit;
			$row 	= 0;
		} else {
			$offset = ($offset * $currPage);
			$row 	= ($row * $currPage - $limit );
		}

		$stmt	= $stmt->limit( (int)$offset , (int)$row );
		$stmt	= $stmt->execute();
		$data	= $stmt->fetchall();

		$dataok = [
			'data' => $data,
			'links' => [
				'prev' => './usuarios/listar',
				'next' => './usuarios/listar',
			],
			'meta' => [
				'currentPage' => '1',
				'total' => count($data)
			]
		];
		return $response->withJson($dataok);

	}

	public static function salvar(Request $request, Response $response) {
		
		global $app;
		
		$post = $request->getParsedBody();
		print_r($post);
		die;
	}

	public static function editar(Request $request, Response $response) {
		
		global $app;
		$container = $app->getContainer();
		
		$post	 = $request->getParsedBody();
		$payload = [];

		if (array_key_exists('id', $post)) {
			$id	= $post['id'];
		}

		if (array_key_exists('usuario', $post)) {
			$payload['usuario'] = $post['usuario'];
		}

		if (array_key_exists('email', $post)) {
			$payload['email'] = $post['email'];
		}

		if (array_key_exists('senha', $post)) {
			$senha = $post['senha'];
			$senha = md5($senha);
			$payload['senha'] = $senha;
		}

		if (array_key_exists('status', $post)) {
			$payload['status'] = $post['status'];
		}
		
		if(count($payload) > 0 AND isset($id)) {

			
			$update = $container->pdo->update($payload)
			->table('usuarios')
			->where('id', '=', $id);
			
			$affectedRows = $update->execute();
			//print_r($affectedRows);
			
			
			$dataok = [
			'data' => 'Ok',
			];
			return $response->withJson($dataok);



		}else{
			$dataok = [];
			return $response->withJson($dataok);
		}
	}

}





