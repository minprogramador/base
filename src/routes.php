<?php


$app->group('/config', function() {
	$this->get('/', 	'App\Config\Config::index');
	$this->get('/login', 	'App\Config\Config::login');
	$this->get('/usuarios',	'App\Config\Usuario::main');
	$this->get('/usuarios/listar',	'App\Config\Usuario::listar');
	$this->get('/usuarios/{id}',	'App\Config\Usuario::find');
	$this->post('/usuarios',	'App\Config\Usuario::salvar');
	$this->patch('/usuarios/{id}',	'App\Config\Usuario::editar');

	$this->get('/sair',		'App\Config\Config::sair');
	$this->get('/config',	'App\Config\Config::main');
	$this->get('/logs',		'App\Config\Logs::main');

});
