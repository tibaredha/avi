<?php
class users extends Controller { 
	
	public $controleur="users";
	
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
	

	function users() {
	    $this->view->title = 'users';
		$this->view->msg = 'users';
		$this->view->render($this->controleur.'/users');
	}
	
	function searchusers()
	{
	    $url1 = explode('/',$_GET['url']);	
		$this->view->title = 'searchusers';
	    $this->view->msg = 'searchusers';
		$this->view->userListviewo = $_GET['o']; //criter de choix
	    $this->view->userListviewq = $_GET['q']; //key word  
		$this->view->userListviewp = $url1[2];    //parametre 2 page                     limit 2,3
		$this->view->userListviewl =8     ;     //parametre 3 nombre de ligne par page  limit 2,3 
		$this->view->userListviewb =15       ;   //parametre nombre de chiffre dan la barre  navigation
		$this->view->userListview = $this->model->userSearchusers($this->view->userListviewo,$this->view->userListviewq,$this->view->userListviewp,$this->view->userListviewl);
		$this->view->userListview1= $this->model->userSearchusers1($this->view->userListviewo,$this->view->userListviewq); // compte total pour bare de navigation
		$this->view->render($this->controleur.'/users');
	}
	
	function user() {
	    $this->view->title = 'user';
		$this->view->msg = 'user';
		$this->view->render($this->controleur.'/user');
	}
	
	function userSave($id) 
	{
	    $data = array();
		$data['id']         = $id;
		$data['login']      = $_POST['login'];
		$data['password']   = md5($_POST['password']);
		$data['wilaya']   = $_POST['wilaya'];
		$data['structure']   = $_POST['structure'];
		//echo '<pre>';print_r ($data);echo '<pre>';
		$this->model->userSave($data);
		header('location: ' . URL ."login");
	}	
	
}