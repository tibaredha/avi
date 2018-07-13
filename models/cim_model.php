<?php
class cim_Model extends Model {

	public function __construct() {
		parent::__construct();
		// Session::init();
	}
	//*********************************************************************************************************************//
	public function userSearchcim($o, $q, $p, $l) {
	$structure = Session::get("structure");
    return $this->db->select("SELECT * FROM cim where  $o like '$q%' order by diag_nom limit $p,$l ");// 
    }
    public function userSearchcim1($o, $q) {
        $structure = Session::get("structure");
		return $this->db->select("SELECT * FROM cim where  $o like '$q%' order by diag_nom");//  
    }
	//*********************************************************************************************************************//
	
	
}