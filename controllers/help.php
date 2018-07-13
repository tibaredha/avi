<?php
class Help extends Controller {

	function __construct() {
		parent::__construct();
	}
	
	function index() {
		$this->view->title = 'Help';
		$this->view->msg = 'Help';
		$this->view->render('help/index');	
	}
}