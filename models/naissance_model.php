<?php
class naissance_Model extends Model {

	public function __construct() {
		parent::__construct();
		// Session::init();
	}
	
	public function userSearch($o, $q, $p, $l) {
	$structure = Session::get("structure");
    return $this->db->select("SELECT * FROM naissance where STRUCTURED=$structure and $o like '$q%' order by NOM limit $p,$l ");// 
    }
    public function userSearch1($o, $q) {
        $structure = Session::get("structure");
		return $this->db->select("SELECT * FROM naissance where STRUCTURED=$structure and $o like '$q%' order by NOM");//  
    }
	 public function userSingleList($id) {
        return $this->db->select('SELECT * FROM naissance WHERE id = :id', array(':id' => $id));
     }
	
	
}