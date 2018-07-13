<?php
class naissance_Model extends Model {

	public function __construct() {
		parent::__construct();
		// Session::init();
	}
	//remise a zero par structure
	// public function reset($id) {       
	    // $this->db->deletem('deceshosp',"STRUCTURED != '$id'");
    // }
	 // public function listemedecin($id) {
        // return $this->db->select('SELECT * FROM medecindeces WHERE structure = :id order by Nom  limit 0,3 ', array(':id' => $id));
     // } 
	 
	// public function medecinSave($data) {
	// $this->db->insert('medecindeces', array(
			// 'Nom'       => $data['Nom'],
            // 'Prenom'    => $data['Prenom'],
            // 'wilaya'    => $data['wilaya'],
			// 'structure' => $data['structure']
	
	 // ));
        // echo '<pre>';print_r ($data);echo '<pre>';
		// return $last_id = $this->db->lastInsertId();
    // }
	// public function deletemedecin($id) {       
        // $this->db->delete('medecindeces', "id = '$id'");
    // }
	
	// function dateUS2FR($date)//2013-01-01
    // {
	// $J      = substr($date,8,2);
    // $M      = substr($date,5,2);
    // $A      = substr($date,0,4);
	// $dateUS2FR =  $J."-".$M."-".$A ;
    // return $dateUS2FR;//01-01-2013
    // }
	// function dateFR2US($date)//01/01/2013
	// {
	// $J      = substr($date,0,2);
    // $M      = substr($date,3,2);
    // $A      = substr($date,6,4);
	// $dateFR2US =  $A."-".$M."-".$J ;
    // return $dateFR2US;//2013-01-01
	// }
	// function CalculateTimestampFromCurrDatetime($DateTime = -1) 
    // {
	// if ($DateTime == -1 || $DateTime == '' || $DateTime == '0000-00-00 00:00:00' || $DateTime == '0000-00-00') 
	// {
		// $DateTime = date("Y-m-d H:i:s");
	// }
	// $NewDate['year']   = substr($DateTime,0,4);
	// $NewDate['month']  = substr($DateTime,5,2);
	// $NewDate['day']    = substr($DateTime,8,2);
	// $NewDate['hour']   = substr($DateTime,11,2);
	// $NewDate['minute'] = substr($DateTime,14,2);
	// $NewDate['second'] = substr($DateTime,17,2);
	// return mktime($NewDate['hour'], $NewDate['minute'], $NewDate['second'], $NewDate['month'], $NewDate['day'], $NewDate['year']);
   // }
   // calculate date difference
	// function CalculateDateDifference($TimestampFirst, $TimestampSecond = -1)	
	// {
		// if ($TimestampSecond == -1) 
		// {
			// $TimestampSecond = CalculateTimestampFromCurrDatetime();
		// }

		// if ($TimestampSecond < $TimestampFirst) 
		// {
			// $TempTimestamp = $TimestampFirst;
			// $TimestampFirst = $TimestampSecond;
			// $TimestampSecond = $TempTimestamp;
			
			// $NegativeDifference = true;
		// }
		// else 
		// {
			// $NegativeDifference = false;
		// }

		// list($Year1, $Month1, $Day1) = explode('-', date('Y-m-d', $TimestampFirst));
		// list($Year2, $Month2, $Day2) = explode('-', date('Y-m-d', $TimestampSecond));
		// $Time1 = (date('H',$TimestampFirst)*3600) + (date('i',$TimestampFirst)*60) + (date('s',$TimestampFirst));
		// $Time2 = (date('H',$TimestampSecond)*3600) + (date('i',$TimestampSecond)*60) + (date('s',$TimestampSecond));

		// $YearDiff = $Year2 - $Year1;
		// $MonthDiff = ($Year2 * 12 + $Month2) - ($Year1 * 12 + $Month1);

		// if($Month1 > $Month2)
		// {
			// $YearDiff -= 1;
		// }
		// elseif($Month1 == $Month2)
		// {
			// if($Day1 > $Day2) 
			// {
				// $YearDiff -= 1;
			// }
			// elseif($Day1 == $Day2) 
			// {
				// if($Time1 > $Time2) 
				// {
					// $YearDiff -= 1;
				// }
			// }
		// }

		////handle over flow of month difference
		// if($Day1 > $Day2) 
		// {
			// $MonthDiff -= 1;
		// }
		// elseif($Day1 == $Day2) 
		// {
			// if($Time1 > $Time2) 
			// {
				// $MonthDiff -= 1;
			// }
		// }

		// $DateDifference = Array();
		// $TotalSeconds = $TimestampSecond - $TimestampFirst;

		// $WeekDiff = floor(($TotalSeconds / 604800));
		// $DayDiff = floor(($TotalSeconds / 86400));

		// if ($NegativeDifference == true) 
		// {
			// $DateDifference['years'] = ($YearDiff == 0) ? $YearDiff : -($YearDiff);
			// $DateDifference['months'] = ($MonthDiff == 0) ? $MonthDiff : -($MonthDiff);
			// $DateDifference['weeks'] = ($WeekDiff == 0) ? $WeekDiff : -($WeekDiff);
			// $DateDifference['days'] = ($DayDiff == 0) ? $DayDiff : -($DayDiff);
		// }
		// else 
		// {
			// $DateDifference['years'] = $YearDiff;
			// $DateDifference['months'] = $MonthDiff;
			// $DateDifference['weeks'] = $WeekDiff;
			// $DateDifference['days'] = $DayDiff;
		// }
		
		// return $DateDifference;
	// }
	//*********************************************************************************************************************//
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
	 // public function createdeces($data) {
		// $Date1 = $this->dateFR2US($data['DATENS']) ;echo '</br>';
		// $Date2 = $this->dateFR2US($data['DINS']);echo '</br>';
		// $Timestamp1 = $this->CalculateTimestampFromCurrDatetime($Date1);echo '</br>';
		// $Timestamp2 = $this->CalculateTimestampFromCurrDatetime($Date2);echo '</br>';
		// $DateDiff = $this->CalculateDateDifference($Timestamp1, $Timestamp2);echo '</br>';
	    ////echo '<pre>';print_r ($DateDiff);echo '<pre>';
		// $Date11 = $this->dateFR2US($data['DATEHOSPI']);echo '</br>';
		// $Date22 = $this->dateFR2US($data['DINS']);echo '</br>';
		// $Timestamp11 = $this->CalculateTimestampFromCurrDatetime($Date11);echo '</br>';
		// $Timestamp22 = $this->CalculateTimestampFromCurrDatetime($Date22);echo '</br>';
		// $DateDiff1 = $this->CalculateDateDifference($Timestamp11, $Timestamp22);echo '</br>';
		////echo '<pre>';print_r ($DateDiff1);echo '<pre>';
		// $this->db->insert('deceshosp', array(
			// 'WILAYAD'    => $data['WILAYAD'],
            // 'COMMUNED'   => $data['COMMUNED'],
            // 'STRUCTURED' => $data['STRUCTURED'],
			// 'DINS'   => $this->dateFR2US($data['DINS']),
            // 'HINS'   => $data['HINS'],
            // 'NOM'    => $data['NOM'],
            // 'PRENOM' => $data['PRENOM'],
            // 'FILSDE' => $data['FILSDE'],
			// 'ETDE'   => $data['ETDE'],
			// 'SEX'    => $data['SEXE'],
			// 'DATENAISSANCE' => $this->dateFR2US($data['DATENS']),
			// 'Days' => $DateDiff['days'],
            // 'Weeks' => $DateDiff['weeks'],
            // 'Months' => $DateDiff['months'],
            // 'Years' => $DateDiff['years'],
			// 'WILAYA'   => $data['WILAYAN'],
            // 'COMMUNE'  => $data['COMMUNEN'],
            // 'WILAYAR'  => $data['WILAYAR'],
            // 'COMMUNER' => $data['COMMUNER'],
            // 'ADRESSE'  => $data['ADRESSE'],
			// 'CD'  => $data['CD'],
			// 'LD'  => $data['LD'],
			// 'AUTRES'  => $data['AUTRES'],
			// 'OMLI'  => $data['OMLI'],
			// 'MIEC'  => $data['MIEC'],
			// 'EPFP'  => $data['EPFP'],
			// 'CIM1'  => $data['CIM1'],
			// 'CIM2'  => $data['CIM2'],
			// 'CIM3'  => $data['CIM3'],
			// 'CIM4'  => $data['CIM4'],
			// 'CIM5'  => $data['CIM5'],
			// 'NDLM'  => $data['NDLM'],
			// 'NDLMAAP'  => $data['NDLMAAP'],
			// 'GM'  => $data['GM'],
			// 'MN'  => $data['MN'],
			// 'AGEGEST'  => $data['AGEGEST'],
			// 'POIDNSC'  => $data['POIDNSC'],
			// 'AGEMERE'  => $data['AGEMERE'],
			// 'DPNAT'  => $data['DPNAT'],
			// 'EMDPNAT'  => $data['EMDPNAT'],
			// 'DECEMAT'  => $data['DECEMAT'],
			// 'GRS'  => $data['GRS'],
			// 'POSTOPP'  => $data['POSTOPP'],
		    // 'DATEHOSPI'  => $this->dateFR2US($data['DATEHOSPI']), 
		    // 'HEURESHOSPI'  => $data['HEURESHOSPI'],
			// 'SERVICEHOSPIT'  => $data['SERVICEHOSPIT'],
		    // 'DUREEHOSPIT'  => $DateDiff1['days'],
            // 'MEDECINHOSPIT'  => $data['MEDECINHOSPIT'],
			// 'CODECIM0'  => $data['CODECIM0'],
			// 'CODECIM'  => $data['CODECIM'],
            // 'WRS'=> $data['WILAYA'],
            // 'SRS'=> $data['STRUCTURE'],
            // 'USER'=> $data['login'],
			// 'NOMAR'    => $data['NOMAR'],
            // 'PRENOMAR' => $data['PRENOMAR'],
            // 'FILSDEAR' => $data['FILSDEAR'],
			// 'ETDEAR'   => $data['ETDEAR'],
			// 'NOMPRENOMAR' => $data['NOMPRENOMAR'],
			// 'PROAR' => $data['PROAR'],
			// 'ADAR'   => $data['ADAR'],
			// 'Profession' => $data['Profession']
			
        // ));
        // echo '<pre>';print_r ($data);echo '<pre>';
		// return $last_id = $this->db->lastInsertId();
    // }
	// public function editSave($data) {
		// $Date1 = $this->dateFR2US($data['DATENS']) ;echo '</br>';
		// $Date2 = $this->dateFR2US($data['DINS']) ;echo '</br>';
		// $Timestamp1 = $this->CalculateTimestampFromCurrDatetime($Date1);echo '</br>';
		// $Timestamp2 = $this->CalculateTimestampFromCurrDatetime($Date2);echo '</br>';
		// $DateDiff = $this->CalculateDateDifference($Timestamp1, $Timestamp2);echo '</br>';
	    ////echo '<pre>';print_r ($DateDiff);echo '<pre>';
		// $Date11 = $this->dateFR2US($data['DATEHOSPI']) ;echo '</br>';
		// $Date22 = $this->dateFR2US($data['DINS']);echo '</br>';
		// $Timestamp11 = $this->CalculateTimestampFromCurrDatetime($Date11);echo '</br>';
		// $Timestamp22 = $this->CalculateTimestampFromCurrDatetime($Date22);echo '</br>';
		// $DateDiff1 = $this->CalculateDateDifference($Timestamp11, $Timestamp22);echo '</br>';
		////echo '<pre>';print_r ($DateDiff1);echo '<pre>';
		 // $postData = array(
			// 'WILAYAD'    => $data['WILAYAD'],
            // 'COMMUNED'   => $data['COMMUNED'],
            // 'STRUCTURED' => $data['STRUCTURED'],
			// 'DINS'   => $this->dateFR2US($data['DINS']),
            // 'HINS'   => $data['HINS'],
            // 'NOM'    => $data['NOM'],
            // 'PRENOM' => $data['PRENOM'],
            // 'FILSDE' => $data['FILSDE'],
			// 'ETDE'   => $data['ETDE'],
			// 'SEX'    => $data['SEXE'],
			// 'DATENAISSANCE' => $this->dateFR2US($data['DATENS']),
			// 'Days' => $DateDiff['days'],
            // 'Weeks' => $DateDiff['weeks'],
            // 'Months' => $DateDiff['months'],
            // 'Years' => $DateDiff['years'],
			// 'WILAYA'   => $data['WILAYAN'],
            // 'COMMUNE'  => $data['COMMUNEN'],
            // 'WILAYAR'  => $data['WILAYAR'],
            // 'COMMUNER' => $data['COMMUNER'],
            // 'ADRESSE'  => $data['ADRESSE'],
			// 'CD'  => $data['CD'],
			// 'LD'  => $data['LD'],
			// 'AUTRES'  => $data['AUTRES'],
			// 'OMLI'  => $data['OMLI'],
			// 'MIEC'  => $data['MIEC'],
			// 'EPFP'  => $data['EPFP'],
			// 'CIM1'  => $data['CIM1'],
			// 'CIM2'  => $data['CIM2'],
			// 'CIM3'  => $data['CIM3'],
			// 'CIM4'  => $data['CIM4'],
			// 'CIM5'  => $data['CIM5'],
			// 'NDLM'  => $data['NDLM'],
			// 'NDLMAAP'  => $data['NDLMAAP'],
			// 'GM'  => $data['GM'],
			// 'MN'  => $data['MN'],
			// 'AGEGEST'  => $data['AGEGEST'],
			// 'POIDNSC'  => $data['POIDNSC'],
			// 'AGEMERE'  => $data['AGEMERE'],
			// 'DPNAT'  => $data['DPNAT'],
			// 'EMDPNAT'  => $data['EMDPNAT'],
			// 'DECEMAT'  => $data['DECEMAT'],
			// 'GRS'  => $data['GRS'],
			// 'POSTOPP'  => $data['POSTOPP'],
		    // 'DATEHOSPI'  => $this->dateFR2US($data['DATEHOSPI']),
		    // 'HEURESHOSPI'  => $data['HEURESHOSPI'],
			// 'SERVICEHOSPIT'  => $data['SERVICEHOSPIT'],
		    // 'DUREEHOSPIT'  => $DateDiff1['days'],
            // 'MEDECINHOSPIT'  => $data['MEDECINHOSPIT'],
			// 'CODECIM0'  => $data['CODECIM0'],
			// 'CODECIM'  => $data['CODECIM'],
            // 'WRS'=> $data['WILAYA'],
            // 'SRS'=> $data['STRUCTURE'],
            // 'USER'=> $data['login'],
			// 'NOMAR'    => $data['NOMAR'],
            // 'PRENOMAR' => $data['PRENOMAR'],
            // 'FILSDEAR' => $data['FILSDEAR'],
			// 'ETDEAR'   => $data['ETDEAR'],
			// 'NOMPRENOMAR' => $data['NOMPRENOMAR'],
			// 'PROAR' => $data['PROAR'],
			// 'ADAR'   => $data['ADAR'],
			// 'Profession' => $data['Profession']
        // );
       ////echo '<pre>';print_r ($postData);echo '<pre>'; 
        // $this->db->update('deceshosp', $postData, "id =" . $data['id'] . "");
		// return $last_id = $data['id'];
    // }
	
	// public function deletedeces($id) {       
        // $this->db->delete('deceshosp', "id = '$id'");
    // }



	
}