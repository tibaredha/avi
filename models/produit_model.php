<?php
class produit_Model extends Model {

	public function __construct() {
		parent::__construct();
		// Session::init();
		
		Model::createTable();
		
	}
	function dateUS2FR($date)//2013-01-01
    {
	$J      = substr($date,8,2);
    $M      = substr($date,5,2);
    $A      = substr($date,0,4);
	$dateUS2FR =  $J."-".$M."-".$A ;
    return $dateUS2FR;//01-01-2013
    }
	function dateFR2US($date)//01/01/2013
	{
	$J      = substr($date,0,2);
    $M      = substr($date,3,2);
    $A      = substr($date,6,4);
	$dateFR2US =  $A."-".$M."-".$J ;
    return $dateFR2US;//2013-01-01
	}
	
	
	
	public function create($data) {

			$this->db->insert('produit', array(		
			'date' =>$data['date'],
			'produit' =>$data['produit'],
			'dci' =>$data['dci'],   
			'type' =>$data['type'] 
			));		
		  
            //echo '<pre>';print_r ($data);echo '<pre>';
           return $last_id = $this->db->lastInsertId();
				
    }
	
	public function userSearch($o, $q, $p, $l) {
	$structure = Session::get("structure");
    return $this->db->select("SELECT * FROM produit where  $o like '$q%' order by id limit $p,$l ");// 
    }
    public function userSearch1($o, $q) {
        $structure = Session::get("structure");
		return $this->db->select("SELECT * FROM produit where $o like '$q%' order by id");//  
    }
	 public function userSingleList($id) {
        return $this->db->select('SELECT * FROM produit WHERE id = :id', array(':id' => $id));
     }
	 
	public function deletebnm($id) {       
        $this->db->delete('produit', "id = '$id'");
    } 
	 
	public function editSave($data) {
		$postData = array(
           'date' =>$data['date'],
		   'produit' =>$data['produit'],
			'dci'    =>$data['dci'],   
			'type'   =>$data['type']    
        );
        $this->db->update('produit', $postData, "id =" . $data['id'] . "");
	    // echo '<pre>';print_r ($postData);echo '<pre>';
    } 

    public function createclient($data) {

			$this->db->insert('client', array(		
			'dateins' =>$this->dateFR2US($data['dateins']),
			'nomavi' =>$data['nomavi'],
			'prenomavi' =>$data['prenomavi'],   
			'filsde' =>$data['filsde'] 
			));		
		  
            //echo '<pre>';print_r ($data);echo '<pre>';
           return $last_id = $this->db->lastInsertId();
				
    }
}