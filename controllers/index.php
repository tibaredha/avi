<?php
class Index extends Controller {

	function __construct() {
		parent::__construct();
	}
	
	function index() {
		$this->view->title = 'Acceuil';
		$this->view->msg = 'Acceuil';
		$this->view->render('index/index');
	}	
}