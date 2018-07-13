<?php
class wca extends Controller { 
	
	public $controleur="wca";
	
	function __construct() {
		parent::__construct();
		Session::init();
		$logged = Session::get('loggedIn');
		if ($logged == false) {
			Session::destroy();
			header('location: '.URL.'login');
			exit;
		}
		$this->view->js = array($this->controleur.'/js/default.js');	
	}
	
	
	function wil() {
	    $this->view->title = 'wil';
		$this->view->msg = 'wilaya';
		$this->view->render($this->controleur.'/wil');
	}
	
	function searchwil()
	{
	    $url1 = explode('/',$_GET['url']);	
		$this->view->title = 'searchwil';
	    $this->view->msg = 'searchwil';
		$this->view->userListviewo = $_GET['o']; //criter de choix
	    $this->view->userListviewq = $_GET['q']; //key word  
		$this->view->userListviewp = $url1[2];    //parametre 2 page                     limit 2,3
		$this->view->userListviewl =8     ;     //parametre 3 nombre de ligne par page  limit 2,3 
		$this->view->userListviewb =15       ;   //parametre nombre de chiffre dan la barre  navigation
		$this->view->userListview = $this->model->userSearchwil($this->view->userListviewo,$this->view->userListviewq,$this->view->userListviewp,$this->view->userListviewl);
		$this->view->userListview1= $this->model->userSearchwil1($this->view->userListviewo,$this->view->userListviewq); // compte total pour bare de navigation
		$this->view->render($this->controleur.'/wil');
	}
	//********************************************************************************************************************************************//
	function com() {
	    $this->view->title = 'com';
		$this->view->msg = 'commune';
		$this->view->render($this->controleur.'/com');
	}
	
	function searchcom()
	{
	    $url1 = explode('/',$_GET['url']);	
		$this->view->title = 'searchcom';
	    $this->view->msg = 'searchcom';
		$this->view->userListviewo = $_GET['o']; //criter de choix
	    $this->view->userListviewq = $_GET['q']; //key word  
		$this->view->userListviewp = $url1[2];    //parametre 2 page                     limit 2,3
		$this->view->userListviewl =8     ;     //parametre 3 nombre de ligne par page  limit 2,3 
		$this->view->userListviewb =15       ;   //parametre nombre de chiffre dan la barre  navigation
		$this->view->userListview = $this->model->userSearchcom($this->view->userListviewo,$this->view->userListviewq,$this->view->userListviewp,$this->view->userListviewl);
		$this->view->userListview1= $this->model->userSearchcom1($this->view->userListviewo,$this->view->userListviewq); // compte total pour bare de navigation
		$this->view->render($this->controleur.'/com');
	}
		
	
}