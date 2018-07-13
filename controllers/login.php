<?php
class Login extends Controller {

	function __construct() {
		parent::__construct();	
	}
	
	function index() {
	    $this->view->title = 'login';
		$this->view->msg = 'login';
		$this->view->render('login/index');
	}
	
	function run()
	{
	$this->view->title = 'login';
	$this->view->msg = 'login';
	$this->model->run();
	}
}