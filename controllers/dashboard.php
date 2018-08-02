<?php
class Dashboard extends Controller { 
	
	public $controleur="dashboard";
	
	
	
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
	$data['Date']      = $_POST['Date'];
	$data['WILAYAD']   = $_POST['WILAYAD'];
	$data['COMMUNED']  = $_POST['COMMUNED'];
	$data['avicli']    = $_POST['avicli'];
	$data['avicycl']   = $_POST['avicycl'];
	$data['avibtm']    = $_POST['avibtm'];
	$data['avisem']    = $_POST['avisem'];
	$data['code_patient'] = $_POST['code_patient'];
	
	$data['Mortalite'] = $_POST['Mortalite'];
	$data['avi0']       = $_POST['avi0'];
	$data['avi1']       = $_POST['avi1'];
	$data['avi2']       = $_POST['avi2'];
	$data['avi3']       = $_POST['avi3'];
	$data['avi4']       = $_POST['avi4'];
	$data['avi5']       = $_POST['avi5'];
	$data['avi6']       = $_POST['avi6'];
	$data['avi7']       = $_POST['avi7'];
	$data['avi8']       = $_POST['avi8'];
	$data['avi9']       = $_POST['avi9'];
	$data['avi10']      = $_POST['avi10'];
	$data['avi11']      = $_POST['avi11'];
	$data['avi12']      = $_POST['avi12'];
	$data['avi13']      = $_POST['avi13'];
	$data['avi14']      = $_POST['avi14'];
	$data['avi15']      = $_POST['avi15'];
	$data['avi16']      = $_POST['avi16'];
	$data['avi17']      = $_POST['avi17'];
	$data['avi18']      = $_POST['avi18'];
	$data['avi19']      = $_POST['avi19'];
	$data['avi20']      = $_POST['avi20'];
	$data['avi21']      = $_POST['avi21'];
	$data['avi22']      = $_POST['avi22'];
	$data['avi23']      = $_POST['avi23'];
	$data['avi24']      = $_POST['avi24'];
	$data['avi25']      = $_POST['avi25'];
	$data['avi26']      = $_POST['avi26'];
	$data['avi27']      = $_POST['avi27'];
	$data['avi28']      = $_POST['avi28'];
	$data['avi29']      = $_POST['avi29'];
	$data['avi30']      = $_POST['avi30'];
	$data['avi31']      = $_POST['avi31'];
	$data['avi32']      = $_POST['avi32'];
	$data['avi33']      = $_POST['avi33'];
	$data['avi34']      = $_POST['avi34'];
	$data['avi35']      = $_POST['avi35'];
	$data['avi36']      = $_POST['avi36'];
	$data['avi37']      = $_POST['avi37'];
	$data['avi38']      = $_POST['avi38'];
	$data['avi39']      = $_POST['avi39'];
	$data['avi40']      = $_POST['avi40'];
	$data['avi41']      = $_POST['avi41'];
	$data['avi42']      = $_POST['avi42'];
	$data['avi43']      = $_POST['avi43'];
	$data['avi44']      = $_POST['avi44'];
	$data['avi45']      = $_POST['avi45'];
	$data['avi46']      = $_POST['avi46'];
	$data['avi47']      = $_POST['avi47'];
	$data['avi48']      = $_POST['avi48'];
	$data['avi49']      = $_POST['avi49'];
	$data['avi50']      = $_POST['avi50'];
	$data['avi51']      = $_POST['avi51'];
	$data['avi52']      = $_POST['avi52'];
	$data['avi53']      = $_POST['avi53'];
	$data['avi54']      = $_POST['avi54'];
	$data['avi55']      = $_POST['avi55'];
	$data['avi56']      = $_POST['avi56'];
	$data['avi57']      = $_POST['avi57'];
	$data['avi58']      = $_POST['avi58'];
	$data['avi59']      = $_POST['avi59'];
	$data['avi60']      = $_POST['avi60'];
	$data['avi61']      = $_POST['avi61'];
	$data['avi62']      = $_POST['avi62'];
	$data['avi63']      = $_POST['avi63'];
	$data['avi64']      = $_POST['avi64'];
	$data['avi65']      = $_POST['avi65'];
	$data['avi66']      = $_POST['avi66'];
	$data['avi67']      = $_POST['avi67'];
	$data['avi68']      = $_POST['avi68'];
	$data['avi69']      = $_POST['avi69'];
	$data['avi70']      = $_POST['avi70'];
	$data['avi71']      = $_POST['avi71'];
	$data['avi72']      = $_POST['avi72'];
	$data['avi73']      = $_POST['avi73'];
	$data['avi74']      = $_POST['avi74'];
	$data['avi75']      = $_POST['avi75'];
	$data['avi76']      = $_POST['avi76'];
	$data['avi77']      = $_POST['avi77'];
	$data['avi78']      = $_POST['avi78'];
	$data['avi79']      = $_POST['avi79'];
	$data['avi80']      = $_POST['avi80'];
	$data['avi81']      = $_POST['avi81'];
	$data['avi82']      = $_POST['avi82'];
	$data['avi83']      = $_POST['avi83'];
	$data['avi84']      = $_POST['avi84'];
	$data['avi85']      = $_POST['avi85'];
	$data['avi86']      = $_POST['avi86'];
	$data['avi87']      = $_POST['avi87'];
	$data['avi88']      = $_POST['avi88'];
	$data['avi89']      = $_POST['avi89'];
	$data['avi90']      = $_POST['avi90'];
	$data['avi91']      = $_POST['avi91'];
	$data['avi92']      = $_POST['avi92'];
	$data['avi93']      = $_POST['avi93'];
	$data['avi94']      = $_POST['avi94'];
	$data['avi95']      = $_POST['avi95'];
	$data['avi96']      = $_POST['avi96'];
	$data['avi97']      = $_POST['avi97'];
	$data['avi98']      = $_POST['avi98'];
	$data['avi99']      = $_POST['avi99'];
	$data['WILAYA']      = $_POST['WILAYA'];
	$data['STRUCTURE']   = $_POST['STRUCTURE'];
	$data['STRUCTURED']  = $_POST['STRUCTURED'];
	$data['login']       = $_POST['login'];
	// echo '<pre>';print_r ($data);echo '<pre>';
	$last_id=$this->model->create($data);
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
        $this->view->title = 'Edit avi';
		$this->view->msg = 'Edit avi';
		$this->view->user = $this->model->userSingleList($id);
		$this->view->render($this->controleur.'/edit');
	}
	
	public function editSave($id)
	{
	$data = array();
	$data['Date']      = $_POST['Date'];
	$data['WILAYAD']   = $_POST['WILAYAD'];
	$data['COMMUNED']  = $_POST['COMMUNED'];
	$data['avicli']    = $_POST['avicli'];
	$data['avicycl']   = $_POST['avicycl'];
	$data['avibtm']    = $_POST['avibtm'];
	$data['avisem']    = $_POST['avisem'];
	$data['code_patient'] = $_POST['code_patient'];
	$data['Mortalite'] = $_POST['Mortalite'];
	$data['avi0']       = $_POST['avi0'];
	$data['avi1']       = $_POST['avi1'];
	$data['avi2']       = $_POST['avi2'];
	$data['avi3']       = $_POST['avi3'];
	$data['avi4']       = $_POST['avi4'];
	$data['avi5']       = $_POST['avi5'];
	$data['avi6']       = $_POST['avi6'];
	$data['avi7']       = $_POST['avi7'];
	$data['avi8']       = $_POST['avi8'];
	$data['avi9']       = $_POST['avi9'];
	$data['avi10']      = $_POST['avi10'];
	$data['avi11']      = $_POST['avi11'];
	$data['avi12']      = $_POST['avi12'];
	$data['avi13']      = $_POST['avi13'];
	$data['avi14']      = $_POST['avi14'];
	$data['avi15']      = $_POST['avi15'];
	$data['avi16']      = $_POST['avi16'];
	$data['avi17']      = $_POST['avi17'];
	$data['avi18']      = $_POST['avi18'];
	$data['avi19']      = $_POST['avi19'];
	$data['avi20']      = $_POST['avi20'];
	$data['avi21']      = $_POST['avi21'];
	$data['avi22']      = $_POST['avi22'];
	$data['avi23']      = $_POST['avi23'];
	$data['avi24']      = $_POST['avi24'];
	$data['avi25']      = $_POST['avi25'];
	$data['avi26']      = $_POST['avi26'];
	$data['avi27']      = $_POST['avi27'];
	$data['avi28']      = $_POST['avi28'];
	$data['avi29']      = $_POST['avi29'];
	$data['avi30']      = $_POST['avi30'];
	$data['avi31']      = $_POST['avi31'];
	$data['avi32']      = $_POST['avi32'];
	$data['avi33']      = $_POST['avi33'];
	$data['avi34']      = $_POST['avi34'];
	$data['avi35']      = $_POST['avi35'];
	$data['avi36']      = $_POST['avi36'];
	$data['avi37']      = $_POST['avi37'];
	$data['avi38']      = $_POST['avi38'];
	$data['avi39']      = $_POST['avi39'];
	$data['avi40']      = $_POST['avi40'];
	$data['avi41']      = $_POST['avi41'];
	$data['avi42']      = $_POST['avi42'];
	$data['avi43']      = $_POST['avi43'];
	$data['avi44']      = $_POST['avi44'];
	$data['avi45']      = $_POST['avi45'];
	$data['avi46']      = $_POST['avi46'];
	$data['avi47']      = $_POST['avi47'];
	$data['avi48']      = $_POST['avi48'];
	$data['avi49']      = $_POST['avi49'];
	$data['avi50']      = $_POST['avi50'];
	$data['avi51']      = $_POST['avi51'];
	$data['avi52']      = $_POST['avi52'];
	$data['avi53']      = $_POST['avi53'];
	$data['avi54']      = $_POST['avi54'];
	$data['avi55']      = $_POST['avi55'];
	$data['avi56']      = $_POST['avi56'];
	$data['avi57']      = $_POST['avi57'];
	$data['avi58']      = $_POST['avi58'];
	$data['avi59']      = $_POST['avi59'];
	$data['avi60']      = $_POST['avi60'];
	$data['avi61']      = $_POST['avi61'];
	$data['avi62']      = $_POST['avi62'];
	$data['avi63']      = $_POST['avi63'];
	$data['avi64']      = $_POST['avi64'];
	$data['avi65']      = $_POST['avi65'];
	$data['avi66']      = $_POST['avi66'];
	$data['avi67']      = $_POST['avi67'];
	$data['avi68']      = $_POST['avi68'];
	$data['avi69']      = $_POST['avi69'];
	$data['avi70']      = $_POST['avi70'];
	$data['avi71']      = $_POST['avi71'];
	$data['avi72']      = $_POST['avi72'];
	$data['avi73']      = $_POST['avi73'];
	$data['avi74']      = $_POST['avi74'];
	$data['avi75']      = $_POST['avi75'];
	$data['avi76']      = $_POST['avi76'];
	$data['avi77']      = $_POST['avi77'];
	$data['avi78']      = $_POST['avi78'];
	$data['avi79']      = $_POST['avi79'];
	$data['avi80']      = $_POST['avi80'];
	$data['avi81']      = $_POST['avi81'];
	$data['avi82']      = $_POST['avi82'];
	$data['avi83']      = $_POST['avi83'];
	$data['avi84']      = $_POST['avi84'];
	$data['avi85']      = $_POST['avi85'];
	$data['avi86']      = $_POST['avi86'];
	$data['avi87']      = $_POST['avi87'];
	$data['avi88']      = $_POST['avi88'];
	$data['avi89']      = $_POST['avi89'];
	$data['avi90']      = $_POST['avi90'];
	$data['avi91']      = $_POST['avi91'];
	$data['avi92']      = $_POST['avi92'];
	$data['avi93']      = $_POST['avi93'];
	$data['avi94']      = $_POST['avi94'];
	$data['avi95']      = $_POST['avi95'];
	$data['avi96']      = $_POST['avi96'];
	$data['avi97']      = $_POST['avi97'];
	$data['avi98']      = $_POST['avi98'];
	$data['avi99']      = $_POST['avi99'];
	$data['id']         =$id;
		
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
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}