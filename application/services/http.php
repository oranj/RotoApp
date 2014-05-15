<?php

use \Roto\General\ServiceRegistry;
use \Roto\Router\Router;
use \Roto\Dispatcher\HttpDispatcher;
use \Roto\View\View;


return function( ServiceRegistry $di ) {
	$root = dirname(dirname(dirname(__FILE__)));

	$di->service('httpRouter', function() use ($di) {

		$dispatcher = $di->get('httpDispatcher');

		return (new Router($di))

			->map('home', '', function() use ($dispatcher) {
				$dispatcher->setController('http/index');
			})

			->map('folder', '(:folder/)', function($args) use ($dispatcher) {
				$dispatcher->setController('http/'.$args['folder']);
			})

			->map('fullish', '(:folder/)?(:base).(:extension)', function($args) use ($dispatcher) {

				$dispatcher->setController('http/'.$args['folder']);
				$dispatcher->setAction($args['base']);
			});
	});

	$di->service('httpDispatcher', function() use ($di, $root) {
		$layoutRoot = $root.'/layout/templates/';
		return new HttpDispatcher($di, $layoutRoot);
	});

	$di->service('get', function() {
		return $_GET;
	});

	$di->service('post', function() {
		return $_POST;
	});

	$di->service('input', function() {
		$input = file_get_contents('php://input');
		if (isset($_SERVER['CONTENT_TYPE']) && stristr($_SERVER['CONTENT_TYPE'], 'application/json') !== false) {
			return json_decode($input);
		}
		return null;
	});


	$di->factory('layout', function($layoutName) use ($root) {
		$layoutRoot = $root.'/application/layouts/';
		return new View($layoutRoot.$layoutName);
	});

	$di->factory('view', function($viewName) use ($root) {
		$viewRoot = $root.'/application/view/';
		return new View($viewRoot.$viewName);
	});

	$di->factory('widget', function($widgetName) use ($root) {
		$widgetRoot = $root.'/application/widgets/';
		return new View($widgetRoot.$widgetName);
	});


};