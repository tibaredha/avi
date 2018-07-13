<?php
class med_Model extends Model {

	public function __construct() {
		parent::__construct();
		// Session::init();
	}
	//*********************************************************************************************************************//
	public function userSearchmed($o, $q, $p, $l) {
	$structure = Session::get("structure");
    return $this->db->select("SELECT * FROM medecindeces where  $o like '$q%' order by structure limit $p,$l ");// 
    }
    public function userSearchmed1($o, $q) {
        $structure = Session::get("structure");
		return $this->db->select("SELECT * FROM medecindeces where  $o like '$q%' order by structure");//  
    }
	
	public function listemedecin($id) {
        return $this->db->select('SELECT * FROM medecindeces WHERE structure = :id order by Nom ', array(':id' => $id));
    } 
	 
	public function medecinSave($data) {
	$this->db->insert('medecindeces', array(
			'Nom'       => $data['Nom'],
            'Prenom'    => $data['Prenom'],
            'wilaya'    => $data['wilaya'],
			'structure' => $data['structure']
	
	 ));
    //echo '<pre>';print_r ($data);echo '<pre>';
	return $last_id = $this->db->lastInsertId();
    }
	
	public function deletemedecin($id) {       
        //$this->db->delete('medecindeces', "id = '$id'");
    }
	 
	
}