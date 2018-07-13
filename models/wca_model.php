<?php
class wca_Model extends Model {

	public function __construct() {
		parent::__construct();
		// Session::init();
	}
	//*********************************************************************************************************************//
	public function userSearchwil($o, $q, $p, $l) {
	$structure = Session::get("structure");
    return $this->db->select("SELECT * FROM wil where  $o like '$q%' order by WILAYAS limit $p,$l ");// 
    }
    public function userSearchwil1($o, $q) {
        $structure = Session::get("structure");
		return $this->db->select("SELECT * FROM wil where  $o like '$q%' order by WILAYAS");//  
    }
	//*********************************************************************************************************************//
	public function userSearchcom($o, $q, $p, $l) {
	$structure = Session::get("structure");
    return $this->db->select("SELECT * FROM com where  $o like '$q%' order by COMMUNE limit $p,$l ");// 
    }
    public function userSearchcom1($o, $q) {
        $structure = Session::get("structure");
		return $this->db->select("SELECT * FROM com where  $o like '$q%' order by COMMUNE");//  
    }
	//***************************************************************************************************************//
	
	
}