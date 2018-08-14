<?php
class produit extends Controller { 
	
	public $controleur="produit";
	
	
	
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
	function index() {
	    $this->view->title = 'Produit';
		$this->view->msg = 'Produit';
		$this->view->render($this->controleur.'/index');
	}
	

	function nouveau() {
	    $this->view->title = 'nouveau';
		$this->view->msg = 'nouveau';
		$this->view->render($this->controleur.'/nouveau');
	}
	
	function search()
	{
	    $url1 = explode('/',$_GET['url']);	
		$this->view->title = 'Search';
	    $this->view->msg = 'Search';
		$this->view->userListviewo = $_GET['o']; //criter de choix
	    $this->view->userListviewq = $_GET['q']; //key word  
		$this->view->userListviewp = $url1[2];    //parametre 2 page                     limit 2,3
		$this->view->userListviewl =9     ;     //parametre 3 nombre de ligne par page  limit 2,3 
		$this->view->userListviewb =15       ;   //parametre nombre de chiffre dan la barre  navigation
		$this->view->userListview = $this->model->userSearch($this->view->userListviewo,$this->view->userListviewq,$this->view->userListviewp,$this->view->userListviewl);
		$this->view->userListview1= $this->model->userSearch1($this->view->userListviewo,$this->view->userListviewq); // compte total pour bare de navigation
		$this->view->render($this->controleur.'/index');
	}
	
	function create() 
	{
	$data = array();
	
	$data['date']         = $_POST['date'];
	$data['produit']      = $_POST['produit'];
	$data['dci']          = $_POST['dci'];
	$data['type']         = $_POST['type'];
	//echo '<pre>';print_r ($data);echo '<pre>';
	$last_id=$this->model->create($data);
	header('location: ' . URL .$this->controleur.'/search/0/10?o=id&q='.$last_id);
	}

	// function Evaluation() {
	    // $this->view->title = 'Evaluation';
		// $this->view->msg = 'Evaluation';
		// $this->view->render($this->controleur.'/Evaluation');
	// }
	
	
	public function delete($id)
	{
	$this->model->deletebnm($id);    
	header('location: ' . URL .$this->controleur. '/search/0/10?o=id&q=');
	}
	
	
	public function edit($id) 
	{
        $this->view->title = 'Edit Produit';
		$this->view->msg = 'Edit Produit';
		$this->view->user = $this->model->userSingleList($id);
		$this->view->render($this->controleur.'/edit');
	}
	
	public function editSave($id)
	{
	$data = array();
	$data['date']         = $_POST['date'];
	$data['produit']    = $_POST['produit'];
	$data['dci']        = $_POST['dci'];
	$data['type']       = $_POST['type'];
	$data['id']         = $id;
		
		// echo '<pre>';print_r ($data);echo '<pre>';
		$this->model->editSave($data);
		header('location: ' . URL .$this->controleur.'/search/0/10?o=id&q=');
	}
	
	function logout()
	{
		Session::destroy();
		header('location: ' . URL .  'login');
		exit;
	}
	
	function client() {
	    $this->view->title = 'nouveau client';
		$this->view->msg = 'nouveau client';
		$this->view->render($this->controleur.'/client');
	}
	
	function createclient() 
	{
	$data = array();
	$data['dateins']      = $_POST['dateins'];
	$data['nomavi']       = $_POST['nomavi'];
	$data['prenomavi']    = $_POST['prenomavi'];
	$data['filsde']       = $_POST['filsde'];
	// echo '<pre>';print_r ($data);echo '<pre>';
	$last_id=$this->model->createclient($data);
	header('location: ' . URL .$this->controleur.'/nouveau/');
	}
		
	
}