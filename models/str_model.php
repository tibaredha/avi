<?php
class str_Model extends Model {

	public function __construct() {
		parent::__construct();
		// Session::init();
	}
	//*********************************************************************************************************************//
	public function userSearchstr($o, $q, $p, $l) {
	$structure = Session::get("structure");
    return $this->db->select("SELECT * FROM structure where  $o like '$q%' order by structure limit $p,$l ");// 
    }
    public function userSearchstr1($o, $q) {
        $structure = Session::get("structure");
		return $this->db->select("SELECT * FROM structure where  $o like '$q%' order by structure");//  
    }
	
	
	
}