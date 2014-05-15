<?php

use \Roto\General\Config;
use \Roto\General\ServiceRegistry;

return function( ServiceRegistry $di ) {

	$root = dirname(dirname(dirname(__FILE__)));

	$di->service('cfg', function() use ($root) {
		return new Config(
			$root.'/config/config.ini'
		);
	});

};