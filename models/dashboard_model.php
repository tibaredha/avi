<?php
class Dashboard_Model extends Model {

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

			$this->db->insert('avi', array(		
			'Date' =>$this->dateFR2US($data['Date']),
			'WILAYAD' =>$data['WILAYAD'],
			'COMMUNED' =>$data['COMMUNED'],   
			'avicli' =>$data['avicli'],   
			'avicycl' =>$data['avicycl'],   
			'avibtm' =>$data['avibtm'],   
			'avisem' =>$data['avisem'],
			'code_patient' =>$data['code_patient'],//MOYENNE 
			'Mortalite' =>$data['Mortalite'], 
			'avi0' =>$data['avi0'],   
			'avi1' =>$data['avi1'],   
			'avi2' =>$data['avi2'],   
			'avi3' =>$data['avi3'],   
			'avi4' =>$data['avi4'],   
			'avi5' =>$data['avi5'],   
			'avi6' =>$data['avi6'],   
			'avi7' =>$data['avi7'],   
			'avi8' =>$data['avi8'],   
			'avi9' =>$data['avi9'],   
			'avi10' =>$data['avi10'],  
			'avi11' =>$data['avi11'],   
			'avi12' =>$data['avi12'],   
			'avi13' =>$data['avi13'],   
			'avi14' =>$data['avi14'],   
			'avi15' =>$data['avi15'],   
			'avi16' =>$data['avi16'],   
			'avi17' =>$data['avi17'],   
			'avi18' =>$data['avi18'],   
			'avi19' =>$data['avi19'],   
			'avi20' =>$data['avi20'],  
			'avi21' =>$data['avi21'],   
			'avi22' =>$data['avi22'],   
			'avi23' =>$data['avi23'],   
			'avi24' =>$data['avi24'],   
			'avi25' =>$data['avi25'],   
			'avi26' =>$data['avi26'],   
			'avi27' =>$data['avi27'],   
			'avi28' =>$data['avi28'],   
			'avi29' =>$data['avi29'],   
			'avi30' =>$data['avi30'], 
			'avi31' =>$data['avi31'],   
			'avi32' =>$data['avi32'],   
			'avi33' =>$data['avi33'],   
			'avi34' =>$data['avi34'],   
			'avi35' =>$data['avi15'],   
			'avi36' =>$data['avi36'],   
			'avi37' =>$data['avi37'],   
			'avi38' =>$data['avi38'],   
			'avi39' =>$data['avi39'],   
			'avi40' =>$data['avi40'],  
			'avi41' =>$data['avi41'],   
			'avi42' =>$data['avi42'],   
			'avi43' =>$data['avi43'],   
			'avi44' =>$data['avi44'],   
			'avi45' =>$data['avi45'],   
			'avi46' =>$data['avi46'],   
			'avi47' =>$data['avi47'],   
			'avi48' =>$data['avi48'],   
			'avi49' =>$data['avi49'],   
			'avi50' =>$data['avi50'],
			'avi51' =>$data['avi51'],   
			'avi52' =>$data['avi52'],   
			'avi53' =>$data['avi53'],   
			'avi54' =>$data['avi54'],   
			'avi55' =>$data['avi55'],   
			'avi56' =>$data['avi56'],   
			'avi57' =>$data['avi57'],   
			'avi58' =>$data['avi58'],   
			'avi59' =>$data['avi59'],   
			'avi60' =>$data['avi60'],  
			'avi61' =>$data['avi61'],   
			'avi62' =>$data['avi62'],   
			'avi63' =>$data['avi63'],   
			'avi64' =>$data['avi64'],   
			'avi65' =>$data['avi65'],   
			'avi66' =>$data['avi66'],   
			'avi67' =>$data['avi67'],   
			'avi68' =>$data['avi68'],   
			'avi69' =>$data['avi69'],   
			'avi70' =>$data['avi70'], 
			'avi71' =>$data['avi71'],   
			'avi72' =>$data['avi72'],   
			'avi73' =>$data['avi73'],   
			'avi74' =>$data['avi74'],   
			'avi75' =>$data['avi75'],   
			'avi76' =>$data['avi76'],   
			'avi77' =>$data['avi77'],   
			'avi78' =>$data['avi78'],   
			'avi79' =>$data['avi79'],   
			'avi80' =>$data['avi80'], 
			'avi81' =>$data['avi81'],   
			'avi82' =>$data['avi82'],   
			'avi83' =>$data['avi83'],   
			'avi84' =>$data['avi84'],   
			'avi85' =>$data['avi85'],   
			'avi86' =>$data['avi86'],   
			'avi87' =>$data['avi87'],   
			'avi88' =>$data['avi88'],   
			'avi89' =>$data['avi89'],   
			'avi90' =>$data['avi90'], 
			'avi91' =>$data['avi91'],   
			'avi92' =>$data['avi92'],   
			'avi93' =>$data['avi93'],   
			'avi94' =>$data['avi94'],   
			'avi95' =>$data['avi95'],   
			'avi96' =>$data['avi96'],   
			'avi97' =>$data['avi97'],   
			'avi98' =>$data['avi98'],   
			'avi99' =>$data['avi99']   
			));		
		  
            //echo '<pre>';print_r ($data);echo '<pre>';
           return $last_id = $this->db->lastInsertId();
				
    }
	
	public function userSearch($o, $q, $p, $l) {
	$structure = Session::get("structure");
    return $this->db->select("SELECT * FROM avi where  $o like '$q%' order by id limit $p,$l ");// 
    }
    public function userSearch1($o, $q) {
        $structure = Session::get("structure");
		return $this->db->select("SELECT * FROM avi where $o like '$q%' order by id");//  
    }
	 public function userSingleList($id) {
        return $this->db->select('SELECT * FROM avi WHERE id = :id', array(':id' => $id));
     }
	 
	public function deletebnm($id) {       
        $this->db->delete('avi', "id = '$id'");
    } 
	 
	public function editSave($data) {
		$postData = array(
            'Date' =>$this->dateFR2US($data['Date']),
			'WILAYAD' =>$data['WILAYAD'],
			'COMMUNED' =>$data['COMMUNED'],   
			'avicli' =>$data['avicli'],   
			'avicycl' =>$data['avicycl'],   
			'avibtm' =>$data['avibtm'],   
			'avisem' =>$data['avisem'],
			'code_patient' =>$data['code_patient'],//MOYENNE
			'Mortalite' =>$data['Mortalite'], 
			'avi0' =>$data['avi0'],   
			'avi1' =>$data['avi1'],   
			'avi2' =>$data['avi2'],   
			'avi3' =>$data['avi3'],   
			'avi4' =>$data['avi4'],   
			'avi5' =>$data['avi5'],   
			'avi6' =>$data['avi6'],   
			'avi7' =>$data['avi7'],   
			'avi8' =>$data['avi8'],   
			'avi9' =>$data['avi9'],   
			'avi10' =>$data['avi10'],  
			'avi11' =>$data['avi11'],   
			'avi12' =>$data['avi12'],   
			'avi13' =>$data['avi13'],   
			'avi14' =>$data['avi14'],   
			'avi15' =>$data['avi15'],   
			'avi16' =>$data['avi16'],   
			'avi17' =>$data['avi17'],   
			'avi18' =>$data['avi18'],   
			'avi19' =>$data['avi19'],   
			'avi20' =>$data['avi20'],  
			'avi21' =>$data['avi21'],   
			'avi22' =>$data['avi22'],   
			'avi23' =>$data['avi23'],   
			'avi24' =>$data['avi24'],   
			'avi25' =>$data['avi25'],   
			'avi26' =>$data['avi26'],   
			'avi27' =>$data['avi27'],   
			'avi28' =>$data['avi28'],   
			'avi29' =>$data['avi29'],   
			'avi30' =>$data['avi30'], 
			'avi31' =>$data['avi31'],   
			'avi32' =>$data['avi32'],   
			'avi33' =>$data['avi33'],   
			'avi34' =>$data['avi34'],   
			'avi35' =>$data['avi15'],   
			'avi36' =>$data['avi36'],   
			'avi37' =>$data['avi37'],   
			'avi38' =>$data['avi38'],   
			'avi39' =>$data['avi39'],   
			'avi40' =>$data['avi40'],  
			'avi41' =>$data['avi41'],   
			'avi42' =>$data['avi42'],   
			'avi43' =>$data['avi43'],   
			'avi44' =>$data['avi44'],   
			'avi45' =>$data['avi45'],   
			'avi46' =>$data['avi46'],   
			'avi47' =>$data['avi47'],   
			'avi48' =>$data['avi48'],   
			'avi49' =>$data['avi49'],   
			'avi50' =>$data['avi50'],
			'avi51' =>$data['avi51'],   
			'avi52' =>$data['avi52'],   
			'avi53' =>$data['avi53'],   
			'avi54' =>$data['avi54'],   
			'avi55' =>$data['avi55'],   
			'avi56' =>$data['avi56'],   
			'avi57' =>$data['avi57'],   
			'avi58' =>$data['avi58'],   
			'avi59' =>$data['avi59'],   
			'avi60' =>$data['avi60'],  
			'avi61' =>$data['avi61'],   
			'avi62' =>$data['avi62'],   
			'avi63' =>$data['avi63'],   
			'avi64' =>$data['avi64'],   
			'avi65' =>$data['avi65'],   
			'avi66' =>$data['avi66'],   
			'avi67' =>$data['avi67'],   
			'avi68' =>$data['avi68'],   
			'avi69' =>$data['avi69'],   
			'avi70' =>$data['avi70'], 
			'avi71' =>$data['avi71'],   
			'avi72' =>$data['avi72'],   
			'avi73' =>$data['avi73'],   
			'avi74' =>$data['avi74'],   
			'avi75' =>$data['avi75'],   
			'avi76' =>$data['avi76'],   
			'avi77' =>$data['avi77'],   
			'avi78' =>$data['avi78'],   
			'avi79' =>$data['avi79'],   
			'avi80' =>$data['avi80'], 
			'avi81' =>$data['avi81'],   
			'avi82' =>$data['avi82'],   
			'avi83' =>$data['avi83'],   
			'avi84' =>$data['avi84'],   
			'avi85' =>$data['avi85'],   
			'avi86' =>$data['avi86'],   
			'avi87' =>$data['avi87'],   
			'avi88' =>$data['avi88'],   
			'avi89' =>$data['avi89'],   
			'avi90' =>$data['avi90'], 
			'avi91' =>$data['avi91'],   
			'avi92' =>$data['avi92'],   
			'avi93' =>$data['avi93'],   
			'avi94' =>$data['avi94'],   
			'avi95' =>$data['avi95'],   
			'avi96' =>$data['avi96'],   
			'avi97' =>$data['avi97'],   
			'avi98' =>$data['avi98'],   
			'avi99' =>$data['avi99']     
        );
        $this->db->update('avi', $postData, "id =" . $data['id'] . "");
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