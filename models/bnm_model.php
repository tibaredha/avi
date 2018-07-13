<?php
class bnm_Model extends Model {

	public function __construct() {
		parent::__construct();
		// Session::init();
	}
	
	public function create($data) {

	        $sth = $this->db->prepare("SELECT * FROM Bordereau WHERE mois = :mois  and  annee=:annee and  COMMUNED=:COMMUNED  and  WILAYAD=:WILAYAD");
			$sth->execute(array(
				 ':mois' => $data['mois'] , ':annee'=> $data['annee'], ':COMMUNED'=>$data['COMMUNED'],':WILAYAD'=>$data['WILAYAD']	
			));
			$data1 = $sth->fetch();
			$count = $sth->rowCount();
			
			if ($count > 0) 
			{
			    // echo 'sup 0';
				// Session::init();
				// Session::set('errorregister', 'Username already exists.');
				// header('location: ../nouveau/');
			} 
			else 
			{
			$this->db->insert('Bordereau', array(		
			'mois' =>$data['mois'],
			'annee' =>$data['annee'],
			'WILAYAD' =>$data['WILAYAD'],
			'COMMUNED' =>$data['COMMUNED'],
			'nm1' =>$data['nm1'],
			'nf1' =>$data['nf1'],
			'nm2' =>$data['nm2'],
			'nf2' =>$data['nf2'],
			'mnm1' =>$data['mnm1'],
			'mnf1' =>$data['mnf1'],
			'm1' =>$data['m1'],
			'm2' =>$data['m2'],
			'djm1' =>$data['djm1'],
			'djf1' =>$data['djf1'],
			'dm1' =>$data['dm1'],   
			'df1' =>$data['df1'],
			'dm2' =>$data['dm2'],     
			'df2' =>$data['df2'],
			'dm3' =>$data['dm3'],     
			'df3' =>$data['df3'],
			'dm4' =>$data['dm4'],     
			'df4' =>$data['df4'],
			'dm5' =>$data['dm5'],     
			'df5' =>$data['df5'],
			'dm6' =>$data['dm6'],     
			'df6' =>$data['df6'],
			'dm7' =>$data['dm7'],      
			'df7' =>$data['df7'],
			'dm8' =>$data['dm8'],      
			'df8' =>$data['df8'],
			'dm9' =>$data['dm9'],      
			'df9' =>$data['df9'],
			'dm10' =>$data['dm10'],     
			'df10' =>$data['df10'],
			'dm11' =>$data['dm11'],     
			'df11' =>$data['df11'],
			'dm12' =>$data['dm12'],     
			'df12' =>$data['df12'],
			'dm13' =>$data['dm13'],      
			'df13' =>$data['df13'],
			'dm14' =>$data['dm14'],     
			'df14' =>$data['df14'],
			'dm15' =>$data['dm15'],      
			'df15' =>$data['df15'],
			'dm16' =>$data['dm16'],     
			'df16' =>$data['df16'],
			'dm17' =>$data['dm17'],     
			'df17' =>$data['df17'],
			'dm18' =>$data['dm18'],      
			'df18' =>$data['df18'],
			'dm19' =>$data['dm19'],     
			'df19' =>$data['df19']    
			));		
		  
            // echo '<pre>';print_r ($data);echo '<pre>';
           return $last_id = $this->db->lastInsertId();
			}		
    }
	
	public function userSearch($o, $q, $p, $l) {
	$structure = Session::get("structure");
    return $this->db->select("SELECT * FROM bordereau where  $o like '$q%' order by id limit $p,$l ");// 
    }
    public function userSearch1($o, $q) {
        $structure = Session::get("structure");
		return $this->db->select("SELECT * FROM bordereau where $o like '$q%' order by id");//  
    }
	 public function userSingleList($id) {
        return $this->db->select('SELECT * FROM bordereau WHERE id = :id', array(':id' => $id));
     }
	 
	public function deletebnm($id) {       
        $this->db->delete('bordereau', "id = '$id'");
    } 
	 
	public function editSave($data) {
		$postData = array(
           'mois' =>$data['mois'],
			'annee' =>$data['annee'],
			'WILAYAD' =>$data['WILAYAD'],
			'COMMUNED' =>$data['COMMUNED'],
			'nm1' =>$data['nm1'],
			'nf1' =>$data['nf1'],
			'nm2' =>$data['nm2'],
			'nf2' =>$data['nf2'],
			'mnm1' =>$data['mnm1'],
			'mnf1' =>$data['mnf1'],
			'm1' =>$data['m1'],
			'm2' =>$data['m2'],
			'djm1' =>$data['djm1'],
			'djf1' =>$data['djf1'],
			'dm1' =>$data['dm1'],   
			'df1' =>$data['df1'],
			'dm2' =>$data['dm2'],     
			'df2' =>$data['df2'],
			'dm3' =>$data['dm3'],     
			'df3' =>$data['df3'],
			'dm4' =>$data['dm4'],     
			'df4' =>$data['df4'],
			'dm5' =>$data['dm5'],     
			'df5' =>$data['df5'],
			'dm6' =>$data['dm6'],     
			'df6' =>$data['df6'],
			'dm7' =>$data['dm7'],      
			'df7' =>$data['df7'],
			'dm8' =>$data['dm8'],      
			'df8' =>$data['df8'],
			'dm9' =>$data['dm9'],      
			'df9' =>$data['df9'],
			'dm10' =>$data['dm10'],     
			'df10' =>$data['df10'],
			'dm11' =>$data['dm11'],     
			'df11' =>$data['df11'],
			'dm12' =>$data['dm12'],     
			'df12' =>$data['df12'],
			'dm13' =>$data['dm13'],      
			'df13' =>$data['df13'],
			'dm14' =>$data['dm14'],     
			'df14' =>$data['df14'],
			'dm15' =>$data['dm15'],      
			'df15' =>$data['df15'],
			'dm16' =>$data['dm16'],     
			'df16' =>$data['df16'],
			'dm17' =>$data['dm17'],     
			'df17' =>$data['df17'],
			'dm18' =>$data['dm18'],      
			'df18' =>$data['df18'],
			'dm19' =>$data['dm19'],     
			'df19' =>$data['df19']    
        );
        $this->db->update('Bordereau', $postData, "id =" . $data['id'] . "");
	    //echo '<pre>';print_r ($postData);echo '<pre>';
    } 
	
}