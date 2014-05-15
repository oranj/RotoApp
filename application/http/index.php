<?php

namespace http;

class index extends \Roto\Controller\Controller {

	public function indexAction() {

		$view = $this->di->make('view', 'index.html.php');
		$madlib = $this->di->make('widget', 'Madlib.php');
		$layout = $this->di->make('layout', 'html.php');

		$dispatcher = $this->di->get('httpDispatcher');
		$dispatcher->setLayout($layout);

		$layout->setMany(array(
			'title' => 'RotoApp Demo',
			'view' => $view
		));

		$view->set('madlib', $madlib);

		$madlib->setMany(array(
			'who' => 'World',
			'what' => 'Roto',
			'adjective' => 'cool'
		));

		return $view;
	}

}
