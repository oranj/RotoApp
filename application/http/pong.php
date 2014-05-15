<?php

namespace http;

class pong extends \Roto\Controller\Controller {

	public function indexAction() {

		list($get, $post, $dispatcher, $input) = $this->di->getMany(array('get', 'post', 'httpDispatcher', 'input'));

		$dispatcher->header("Content-type: application/json");

		return new \Roto\View\LambdaView(function() use ($get, $post, $input) {
			echo json_encode(array(
				'get' => $get,
				'post' => $post,
				'input' => $input
			), JSON_PRETTY_PRINT);
		});

	}

}