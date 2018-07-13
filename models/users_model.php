<?php
class users_Model extends Model {

	public function __construct() {
		parent::__construct();
		// Session::init();
	}
	//*********************************************************************************************************************//
	public function userSearchusers($o, $q, $p, $l) {
	$structure = Session::get("structure");
    return $this->db->select("SELECT * FROM users where  $o like '$q%' order by login limit $p,$l ");// 
    }
    public function userSearchusers1($o, $q) {
        $structure = Session::get("structure");
		return $this->db->select("SELECT * FROM users where  $o like '$q%' order by login");//  
    }
	public function userSave($data) {
        $postData = array(
            'wilaya' => $data['wilaya'],
            'structure' => $data['structure'],
            'login' => $data['login'],
			'password' => $data['password']
        );
		echo '<pre>';print_r ($postData);echo '<pre>'; 
        $this->db->update('users', $postData, "id =" . $data['id'] . "");
    }
	
		
}