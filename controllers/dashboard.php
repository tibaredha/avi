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
	
	function dump() 
	{
	    $this->view->title = 'dump';
		$this->view->msg = 'dashboard';
		$this->view->render($this->controleur.'/dump');
		
	}
	
	
	
	
	
	function imp() {
	    $this->view->title = 'imp';
		$this->view->msg = 'imp';
		$this->view->render($this->controleur.'/php');
	}
	
	
	function createmedecin($id) 
	{
	    $this->view->title = 'dashboard';
		$this->view->msg = 'dashboard';
		$this->view->userListview = $this->model->listemedecin($id) ;
		$this->view->render($this->controleur.'/createmedecin');
	}
	
	public function medecinSave()
	{
		$data = array();
		$data['Nom']        = $_POST['Nom'];
		$data['Prenom']     = $_POST['Prenom'];
		$data['wilaya']     = $_POST['wilaya'];
	    $data['structure']  = $_POST['structure'];
	   // echo '<pre>';print_r ($data);echo '<pre>';
	   $this->model->medecinSave($data);
		header('location: ' . URL .$this->controleur. '/nouveau');
	}	
	public function deletemedecin($id)
	{
	$url1 = explode('/',$_GET['url']);
	$this->model->deletemedecin($id);    
	header('location: ' . URL .$this->controleur. '/createmedecin/'.$url1[3]);
	}	
	
	
	function flv6($flv) 
	{
	$this->view->title = $flv;
	$this->view->msg = 'dashboard';
	$this->view->flv=$flv;
	$this->view->render($this->controleur.'/flv6');    
	}
	
	function graphe($id) 
	{
	    $this->view->title = 'dashboard';
		$this->view->msg = 'dashboard';
		if($id!=0) {
		$this->view->render($this->controleur.'/index'.$id);
		} else {
		$this->view->render($this->controleur.'/index');
		}	
	}
	
	//remise a zero par structure
	function reset($id) {
	    $this->view->title = 'reset';
		$this->view->msg = 'reset';
		$this->model->reset($id);
		header('location: '.URL.$this->controleur.'/cfg/');
	}
	
	function logout()
	{
		Session::destroy();
		header('location: ' . URL .  'login');
		exit;
	}
	
	function cfg() {
	    $this->view->title = 'configuration';
		$this->view->msg = 'configuration';
		$this->view->render($this->controleur.'/configuration');
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
	
	public function create() 
	{
		$data = array();
		$data['NOM']           = $_POST['NOM'];
		$data['PRENOM']        = $_POST['PRENOM'];
		$data['FILSDE']        = $_POST['FILSDE'];
		$data['ETDE']          = $_POST['ETDE'];
		$data['SEXE']          = $_POST['SEXE'];
		$data['DATENS']        = $_POST['DATENS'];
		$data['WILAYAN']       = $_POST['WILAYAN'];
		$data['COMMUNEN']      = $_POST['COMMUNEN'];
		$data['WILAYAR']       = $_POST['WILAYAR'];
		$data['COMMUNER']      = $_POST['COMMUNER'];
		$data['ADRESSE']       = $_POST['ADRESSE'];
		$data['WILAYAD']       = $_POST['WILAYAD'];
		$data['COMMUNED']      = $_POST['COMMUNED'];
		$data['STRUCTURED']    = $_POST['STRUCTURED'];
		$data['DINS']          = $_POST['DINS'];
		$data['HINS']          = $_POST['HINS'];
		$data['DATEHOSPI']     = $_POST['DATEHOSPI'];
		$data['HEURESHOSPI']   = $_POST['HEURESHOSPI'];
		$data['SERVICEHOSPIT'] = $_POST['SERVICEHOSPIT'];
		$data['MEDECINHOSPIT'] = $_POST['MEDECINHOSPIT'];
		$data['LD']            = $_POST['LD'];
		$data['AUTRES']        = $_POST['AUTRES'];
		if (isset($_POST['OMLI'])){$data['OMLI']='1';}else{$data['OMLI']='';}
		if (isset($_POST['MIEC'])){$data['MIEC']='1';}else{$data['MIEC']='';}
		if (isset($_POST['EPFP'])){$data['EPFP']='1';}else{$data['EPFP']='';}
		$data['CIM1']          = $_POST['CIM1'];
		$data['CIM2']          = $_POST['CIM2'];
		$data['CIM3']          = $_POST['CIM3'];
		$data['CIM4']          = $_POST['CIM4'];
		$data['CIM5']          = $_POST['CIM5'];
		$data['CD']            = $_POST['CD'];
		$data['CODECIM0']      = $_POST['CODECIM0'];
		$data['CODECIM']       = $_POST['CODECIM'];
		$data['NDLM']          = $_POST['NDLM'];
        $data['NDLMAAP']       = $_POST['NDLMAAP'];
		if (isset($_POST['GM'])){$data['GM']='1'; }else{$data['GM']='';}
		if (isset($_POST['MN'])){$data['MN']='1';}else{$data['MN']='';}
		$data['AGEGEST']       = $_POST['AGEGEST'];
		$data['POIDNSC']       = $_POST['POIDNSC'];
		$data['AGEMERE']       = $_POST['AGEMERE'];
		if (isset($_POST['DPNAT'])){$data['DPNAT']='1'; }else{$data['DPNAT']='';}
		$data['EMDPNAT']       = $_POST['EMDPNAT'];
		if (isset($_POST['DECEMAT'])){$data['DECEMAT']='1'; }else{$data['DECEMAT']='';}
		$data['GRS']           = $_POST['GRS'];
		if (isset($_POST['POSTOPP'])){$data['POSTOPP']='1';}else{$data['POSTOPP']='';}
		$data['WILAYA']        = $_POST['WILAYA'];
		$data['STRUCTURE']     = $_POST['STRUCTURE'];
		$data['login']         = $_POST['login'];
		$data['NOMAR']         = $_POST['NOMAR'];
		$data['PRENOMAR']      = $_POST['PRENOMAR'];
		$data['FILSDEAR']      = $_POST['FILSDEAR'];
		$data['ETDEAR']        = $_POST['ETDEAR'];
		$data['ETDEAR']        = $_POST['ETDEAR'];
		$data['NOMPRENOMAR']   = $_POST['NOMPRENOMAR'];
		$data['PROAR']         = $_POST['PROAR'];
		$data['ADAR']          = $_POST['ADAR'];
		$data['Profession']    = $_POST['Profession'];
		//echo '<pre>';print_r ($data);echo '<pre>';  
		$last_id=$this->model->createdeces($data);
		header('location: '.URL.$this->controleur.'/search/0/10?o=id&q='.$last_id);
	}
	
	public function view($id) 
	{
        $this->view->title = 'view deces';
		$this->view->msg = 'view deces';
		$this->view->user = $this->model->userSingleList($id);
		$this->view->render($this->controleur.'/view');
	}
	
	
	
	
	function edit($id) {
	    $this->view->title = 'edit deces';
		$this->view->msg = 'Edit deces';
		$this->view->user = $this->model->userSingleList($id);
		$this->view->render($this->controleur.'/edit');
	}
	
	public function editSave($id) 
	{
		$data = array();
		$data['NOM']           = $_POST['NOM'];
		$data['PRENOM']        = $_POST['PRENOM'];
		$data['FILSDE']        = $_POST['FILSDE'];
		$data['ETDE']          = $_POST['ETDE'];
		$data['SEXE']          = $_POST['SEXE'];
		$data['DATENS']        = $_POST['DATENS'];
		$data['WILAYAN']       = $_POST['WILAYAN'];
		$data['COMMUNEN']      = $_POST['COMMUNEN'];
		$data['WILAYAR']       = $_POST['WILAYAR'];
		$data['COMMUNER']      = $_POST['COMMUNER'];
		$data['ADRESSE']       = $_POST['ADRESSE'];
		$data['WILAYAD']       = $_POST['WILAYAD'];
		$data['COMMUNED']      = $_POST['COMMUNED'];
		$data['STRUCTURED']    = $_POST['STRUCTURED'];
		$data['DINS']          = $_POST['DINS'];
		$data['HINS']          = $_POST['HINS'];
		$data['DATEHOSPI']     = $_POST['DATEHOSPI'];
		$data['HEURESHOSPI']   = $_POST['HEURESHOSPI'];
		$data['SERVICEHOSPIT'] = $_POST['SERVICEHOSPIT'];
		$data['MEDECINHOSPIT'] = $_POST['MEDECINHOSPIT'];
		$data['LD']            = $_POST['LD'];
		$data['AUTRES']        = $_POST['AUTRES'];
		if (isset($_POST['OMLI'])){$data['OMLI']='1';}else{$data['OMLI']='';}
		if (isset($_POST['MIEC'])){$data['MIEC']='1';}else{$data['MIEC']='';}
		if (isset($_POST['EPFP'])){$data['EPFP']='1';}else{$data['EPFP']='';}
		$data['CIM1']          = $_POST['CIM1'];
		$data['CIM2']          = $_POST['CIM2'];
		$data['CIM3']          = $_POST['CIM3'];
		$data['CIM4']          = $_POST['CIM4'];
		$data['CIM5']          = $_POST['CIM5'];
		$data['CD']            = $_POST['CD'];
		$data['CODECIM0']      = $_POST['CODECIM0'];
		$data['CODECIM']       = $_POST['CODECIM'];
		$data['NDLM']          = $_POST['NDLM'];
        $data['NDLMAAP']       = $_POST['NDLMAAP'];
		if (isset($_POST['GM'])){$data['GM']='1'; }else{$data['GM']='';}
		if (isset($_POST['MN'])){$data['MN']='1';}else{$data['MN']='';}
		$data['AGEGEST']       = $_POST['AGEGEST'];
		$data['POIDNSC']       = $_POST['POIDNSC'];
		$data['AGEMERE']       = $_POST['AGEMERE'];
		if (isset($_POST['DPNAT'])){$data['DPNAT']='1'; }else{$data['DPNAT']='';}
		$data['EMDPNAT']       = $_POST['EMDPNAT'];
		if (isset($_POST['DECEMAT'])){$data['DECEMAT']='1'; }else{$data['DECEMAT']='';}
		$data['GRS']           = $_POST['GRS'];
		if (isset($_POST['POSTOPP'])){$data['POSTOPP']='1';}else{$data['POSTOPP']='';}
		$data['WILAYA']        = $_POST['WILAYA'];
		$data['STRUCTURE']     = $_POST['STRUCTURE'];
		$data['login']         = $_POST['login'];
		$data['NOMAR']         = $_POST['NOMAR'];
		$data['PRENOMAR']      = $_POST['PRENOMAR'];
		$data['FILSDEAR']      = $_POST['FILSDEAR'];
		$data['ETDEAR']        = $_POST['ETDEAR'];
		$data['ETDEAR']        = $_POST['ETDEAR'];
		$data['NOMPRENOMAR']   = $_POST['NOMPRENOMAR'];
		$data['PROAR']         = $_POST['PROAR'];
		$data['ADAR']          = $_POST['ADAR'];
		$data['Profession']    = $_POST['Profession'];
		$data['id']            = $id;
		echo '<pre>';print_r ($data);echo '<pre>';  
		$last_id=$this->model->editSave($data);
		header('location: '.URL.$this->controleur.'/search/0/10?o=id&q='.$last_id);
	}
	
	public function delete($id)
	{
	$this->model->deletedeces($id);    
	header('location: ' . URL .$this->controleur. '/search/0/10?o=NOM&q=');
	}
	//**********************************************************************************************************************************//

	function DSP() {
	    $this->view->title = 'Evaluation';
		$this->view->msg = 'Evaluation';
		$this->view->render($this->controleur.'/DSP');
	}
	
	
	function Evaluation() {
	    $this->view->title = 'Evaluation';
		$this->view->msg = 'Evaluation';
		$this->view->render($this->controleur.'/Evaluation');
	}
	
	function SIGA() 
	{	
	    $this->view->title = 'Systeme Information Geographique';
		$this->view->msg = 'Systeme Information Geographique';
		$this->view->render($this->controleur.'/sigax');
	}
	
	function SIG($id) 
	{	
	    $this->view->title = 'Systeme Information Geographique';
		$this->view->msg = 'Systeme Information Geographique';
		switch ($id) 
		{ 
			case 17: 
				$this->view->render($this->controleur.'/sigay');
			break;
			
            case 14: 
				$this->view->render($this->controleur.'/sigay');
			break;
			
			default:
				$this->view->render($this->controleur.'/sigay');
		}	
	}
	
	function XLS() 
	{
	    $url1 = explode('/',$_GET['url']);	
	    $this->view->title = 'XLS';
		$this->view->msg = 'XLS';
		$this->view->d1 = $url1[2]; 
		$this->view->d2 = $url1[3]; 
		$this->view->render($this->controleur.'/XLS');
	}
	
	function decesmaternel($id) 
	{
	    $this->view->title = 'decesmaternel';
		$this->view->msg = 'decesmaternel';
		$this->view->user = $this->model->userSingleList($id);
		$this->view->render($this->controleur.'/decesmaternel');
	}	
	function decesperinatal($id) 
	{
	    $this->view->title = 'decesperinatal';
		$this->view->msg = 'decesperinatal';
		$this->view->user = $this->model->userSingleList($id);
		$this->view->render($this->controleur.'/decesperinatal');
	}	
	
	
	
}