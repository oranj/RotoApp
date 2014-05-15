<?php

error_reporting(E_ALL);
date_default_timezone_set('Europe/London');

$root = dirname(__FILE__);

// autoload composer dependency files
include_once($root.'/vendor/autoload.php');

// autoload web files.
spl_autoload_register(function($className) use ($root) {
	$path = $root.'/application/'.ltrim(str_replace('\\', '/', $className), '/').'.php';
	if (file_exists($path)) {
		include_once($path);
	}
});

// load all service files.
$di = new \Roto\General\ServiceRegistry();

$servicesDirectory = $root.'/application/services/';
$serviceFiles = scandir($servicesDirectory);

foreach ($serviceFiles as $serviceFile) {
	if (is_file($servicesDirectory.$serviceFile)) {
		$callback = require($servicesDirectory.$serviceFile);
		$callback($di);
	}
};

require_once($root .'/application/lib/general.php');

list($router, $dispatcher) = $di->getMany(array('httpRouter', 'httpDispatcher'));

$router->route($_SERVER['REQUEST_URI']);
$dispatcher->execute();
