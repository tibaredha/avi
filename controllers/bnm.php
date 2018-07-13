<?php
class bnm extends Controller { 
	
	public $controleur="bnm";
	
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
	    $this->view->title = 'dashboard';
		$this->view->msg = 'dashboard';
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
	$data['mois']     = $_POST['mois'];
	$data['annee']    = $_POST['annee'];
	$data['WILAYAD']   = $_POST['WILAYAD'];
	$data['COMMUNED']  = $_POST['COMMUNED'];
	$data['nm1']       = $_POST['nm1'];$data['nf1']      = $_POST['nf1'];
	$data['nm2']       = $_POST['nm2'];$data['nf2']      = $_POST['nf2'];
	$data['mnm1']      = $_POST['mnm1'];$data['mnf1']    = $_POST['mnf1'];
	$data['m1']        = $_POST['m1'];$data['m2']        = $_POST['m2'];
	$data['djm1']      = $_POST['djm1'];$data['djf1']      = $_POST['djf1'];
	$data['dm1'] = $_POST['dm1'];        $data['df1'] = $_POST['df1'];
	$data['dm2'] = $_POST['dm2'];        $data['df2'] = $_POST['df2'];
	$data['dm3'] = $_POST['dm3'];        $data['df3'] = $_POST['df3'];
	$data['dm4'] = $_POST['dm4'];        $data['df4'] = $_POST['df4'];
	$data['dm5'] = $_POST['dm5'];        $data['df5'] = $_POST['df5'];
	$data['dm6'] = $_POST['dm6'];        $data['df6'] = $_POST['df6'];
	$data['dm7'] = $_POST['dm7'];        $data['df7'] = $_POST['df7'];
	$data['dm8'] = $_POST['dm8'];        $data['df8'] = $_POST['df8'];
	$data['dm9'] = $_POST['dm9'];        $data['df9'] = $_POST['df9'];
	$data['dm10'] = $_POST['dm10'];      $data['df10'] = $_POST['df10'];
	$data['dm11'] = $_POST['dm11'];      $data['df11'] = $_POST['df11'];
	$data['dm12'] = $_POST['dm12'];      $data['df12'] = $_POST['df12'];
	$data['dm13'] = $_POST['dm13'];      $data['df13'] = $_POST['df13'];
	$data['dm14'] = $_POST['dm14'];      $data['df14'] = $_POST['df14'];
	$data['dm15'] = $_POST['dm15'];      $data['df15'] = $_POST['df15'];
	$data['dm16'] = $_POST['dm16'];      $data['df16'] = $_POST['df16'];
	$data['dm17'] = $_POST['dm17'];      $data['df17'] = $_POST['df17'];
	$data['dm18'] = $_POST['dm18'];      $data['df18'] = $_POST['df18'];
	$data['dm19'] = $_POST['dm19'];      $data['df19'] = $_POST['df19'];
	$last_id=$this->model->create($data);
	//echo '<pre>';print_r ($data);echo '<pre>';
	header('location: ' . URL .$this->controleur.'/search/0/10?o=id&q='.$last_id);
	}

	function Evaluation() {
	    $this->view->title = 'Evaluation';
		$this->view->msg = 'Evaluation';
		$this->view->render($this->controleur.'/Evaluation');
	}
	
	
	public function delete($id)
	{
	$this->model->deletebnm($id);    
	header('location: ' . URL .$this->controleur. '/search/0/10?o=id&q=');
	}
	
	
	public function edit($id) 
	{
        $this->view->title = 'Edit Bordereau';
		$this->view->msg = 'Edit Bordereau';
		$this->view->user = $this->model->userSingleList($id);
		$this->view->render($this->controleur.'/edit');
	}
	
	public function editSave($id)
	{
		$data = array();
		$data['id']        = $id;
		$data['mois']     = $_POST['mois'];
		$data['annee']    = $_POST['annee'];
		$data['WILAYAD']   = $_POST['WILAYAD'];
		$data['COMMUNED']  = $_POST['COMMUNED'];
		$data['nm1']       = $_POST['nm1'];$data['nf1']      = $_POST['nf1'];
		$data['nm2']       = $_POST['nm2'];$data['nf2']      = $_POST['nf2'];
		$data['mnm1']      = $_POST['mnm1'];$data['mnf1']    = $_POST['mnf1'];
		$data['m1']        = $_POST['m1'];$data['m2']        = $_POST['m2'];
		$data['djm1']      = $_POST['djm1'];$data['djf1']      = $_POST['djf1'];
		$data['dm1'] = $_POST['dm1'];        $data['df1'] = $_POST['df1'];
		$data['dm2'] = $_POST['dm2'];        $data['df2'] = $_POST['df2'];
		$data['dm3'] = $_POST['dm3'];        $data['df3'] = $_POST['df3'];
		$data['dm4'] = $_POST['dm4'];        $data['df4'] = $_POST['df4'];
		$data['dm5'] = $_POST['dm5'];        $data['df5'] = $_POST['df5'];
		$data['dm6'] = $_POST['dm6'];        $data['df6'] = $_POST['df6'];
		$data['dm7'] = $_POST['dm7'];        $data['df7'] = $_POST['df7'];
		$data['dm8'] = $_POST['dm8'];        $data['df8'] = $_POST['df8'];
		$data['dm9'] = $_POST['dm9'];        $data['df9'] = $_POST['df9'];
		$data['dm10'] = $_POST['dm10'];      $data['df10'] = $_POST['df10'];
		$data['dm11'] = $_POST['dm11'];      $data['df11'] = $_POST['df11'];
		$data['dm12'] = $_POST['dm12'];      $data['df12'] = $_POST['df12'];
		$data['dm13'] = $_POST['dm13'];      $data['df13'] = $_POST['df13'];
		$data['dm14'] = $_POST['dm14'];      $data['df14'] = $_POST['df14'];
		$data['dm15'] = $_POST['dm15'];      $data['df15'] = $_POST['df15'];
		$data['dm16'] = $_POST['dm16'];      $data['df16'] = $_POST['df16'];
		$data['dm17'] = $_POST['dm17'];      $data['df17'] = $_POST['df17'];
		$data['dm18'] = $_POST['dm18'];      $data['df18'] = $_POST['df18'];
		$data['dm19'] = $_POST['dm19'];      $data['df19'] = $_POST['df19'];
		// echo '<pre>';print_r ($data);echo '<pre>';
		$this->model->editSave($data);
		header('location: ' . URL .$this->controleur.'/search/0/10?o=id&q=');
	}
	
	
	
	
	
	
	
	
	
	
}