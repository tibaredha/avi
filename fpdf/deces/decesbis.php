<?php
//ancien fichier de deces 
require('invoice.php');
class DEC extends PDF_Invoice
{
     
	 public $nomprenom ="tibaredha";
	 public $db_host="localhost";
	 public $db_name="deces"; //probleme avec base de donnes  il faut change  gpts avec mvc   
     public $db_user="root";
     public $db_pass="";
	 public $utf8 = "" ;
	
	function dspnbr($datejour1,$datejour2,$STRUCTURED)
	{
	$this->mysqlconnect();
	$sql = " select * from deceshosp where (DINS BETWEEN '$datejour1' AND '$datejour2') and ( STRUCTURED  $STRUCTURED )          ";
	$requete = @mysql_query($sql) or die($sql."<br>".mysql_error());
	$collecte=mysql_num_rows($requete);
	mysql_free_result($requete);
	return $collecte;
	}
	
	function LineGraph($x,$y,$w, $h, $data, $options='', $colors=null, $maxVal=0, $nbDiv=4){
		/*******************************************
		Explain the variables:
		
		$x=x
		$y=y
		$w = the width of the diagram
		$h = the height of the diagram
		$data = the data for the diagram in the form of a multidimensional array
		$options = the possible formatting options which include:
			'V' = Print Vertical Divider lines
			'H' = Print Horizontal Divider Lines
			'kB' = Print bounding box around the Key (legend)
			'vB' = Print bounding box around the values under the graph
			'gB' = Print bounding box around the graph
			'dB' = Print bounding box around the entire diagram
		$colors = A multidimensional array containing RGB values
		$maxVal = The Maximum Value for the graph vertically
		$nbDiv = The number of vertical Divisions
		*******************************************/
		$this->SetDrawColor(0,0,0);
		$this->SetLineWidth(0.2);
		$keys = array_keys($data);
		$ordinateWidth = 10;
		$w -= $ordinateWidth;
		$valX = $this->getX()+$x+$ordinateWidth;
		$valY = $this->getY()+$y;
		$margin = 1;
		$titleH = 8;
		$titleW = $w;
		$lineh = 5;
		$keyH = count($data)*$lineh;
		$keyW = $w/5;
		$graphValH = 5;
		$graphValW = $w-$keyW-3*$margin;
		$graphH = $h-(3*$margin)-$graphValH;
		$graphW = $w-(2*$margin)-($keyW+$margin);
		$graphX = $valX+$margin;
		$graphY = $valY+$margin;
		$graphValX = $valX+$margin;
		$graphValY = $valY+2*$margin+$graphH;
		$keyX = $valX+(2*$margin)+$graphW;
		$keyY = $valY+$margin+.5*($h-(2*$margin))-.5*($keyH);
		//draw graph frame border
		if(strstr($options,'gB')){
			$this->Rect($valX,$valY,$w,$h);
		}
		//draw graph diagram border
		if(strstr($options,'dB')){
			$this->Rect($valX+$margin,$valY+$margin,$graphW,$graphH);
		}
		//draw key legend border
		if(strstr($options,'kB')){
			$this->Rect($keyX,$keyY,$keyW,$keyH);
		}
		//draw graph value box
		if(strstr($options,'vB')){
			$this->Rect($graphValX,$graphValY,$graphValW,$graphValH);
		}
		//define colors
		if($colors===null){
			$safeColors = array(0,51,102,153,204,225);
			for($i=0;$i<count($data);$i++){
				$colors[$keys[$i]] = array($safeColors[array_rand($safeColors)],$safeColors[array_rand($safeColors)],$safeColors[array_rand($safeColors)]);
			}
		}
		//form an array with all data values from the multi-demensional $data array
		$ValArray = array();
		foreach($data as $key => $value){
			foreach($data[$key] as $val){
				$ValArray[]=$val;					
			}
		}
		//define max value
		if($maxVal<ceil(max($ValArray))){
			$maxVal = ceil(max($ValArray));
		}
		//draw horizontal lines
		$vertDivH = $graphH/$nbDiv;
		if(strstr($options,'H')){
			for($i=0;$i<=$nbDiv;$i++){
				if($i<$nbDiv){
					$this->Line($graphX,$graphY+$i*$vertDivH,$graphX+$graphW,$graphY+$i*$vertDivH);
				} else{
					$this->Line($graphX,$graphY+$graphH,$graphX+$graphW,$graphY+$graphH);
				}
			}
		}
		//draw vertical lines
		$horiDivW = floor($graphW/(count($data[$keys[0]])-1));
		if(strstr($options,'V')){
			for($i=0;$i<=(count($data[$keys[0]])-1);$i++){
				if($i<(count($data[$keys[0]])-1)){
					$this->Line($graphX+$i*$horiDivW,$graphY,$graphX+$i*$horiDivW,$graphY+$graphH);
				} else {
					$this->Line($graphX+$graphW,$graphY,$graphX+$graphW,$graphY+$graphH);
				}
			}
		}
		//draw graph lines
		foreach($data as $key => $value){
			$this->setDrawColor($colors[$key][0],$colors[$key][1],$colors[$key][2]);
			$this->SetLineWidth(0.8);
			$valueKeys = array_keys($value);
			for($i=0;$i<count($value);$i++){
				if($i==count($value)-2){
					$this->Line(
						$graphX+($i*$horiDivW),
						$graphY+$graphH-($value[$valueKeys[$i]]/$maxVal*$graphH),
						$graphX+$graphW,
						$graphY+$graphH-($value[$valueKeys[$i+1]]/$maxVal*$graphH)
					);
				} else if($i<(count($value)-1)) {
					$this->Line(
						$graphX+($i*$horiDivW),
						$graphY+$graphH-($value[$valueKeys[$i]]/$maxVal*$graphH),
						$graphX+($i+1)*$horiDivW,
						$graphY+$graphH-($value[$valueKeys[$i+1]]/$maxVal*$graphH)
					);
				}
			}
			//Set the Key (legend)
			$this->SetFont('Courier','',10);
			if(!isset($n))$n=0;
			$this->Line($keyX+1,$keyY+$lineh/2+$n*$lineh,$keyX+8,$keyY+$lineh/2+$n*$lineh);
			$this->SetXY($keyX+8,$keyY+$n*$lineh);
			$this->Cell($keyW,$lineh,$key,0,1,'L');
			$n++;
		}
		//print the abscissa values
		foreach($valueKeys as $key => $value){
			if($key==0){
				$this->SetXY($graphValX,$graphValY);
				$this->Cell(30,$lineh,$value,0,0,'L');
			} else if($key==count($valueKeys)-1){
				$this->SetXY($graphValX+$graphValW-30,$graphValY);
				$this->Cell(30,$lineh,$value,0,0,'R');
			} else {
				$this->SetXY($graphValX+$key*$horiDivW-15,$graphValY);
				$this->Cell(30,$lineh,$value,0,0,'C');
			}
		}
		//print the ordinate values
		for($i=0;$i<=$nbDiv;$i++){
			$this->SetXY($graphValX-10,$graphY+($nbDiv-$i)*$vertDivH-3);
			$this->Cell(8,6,sprintf('%.1f',$maxVal/$nbDiv*$i),0,0,'R');
		}
		$this->SetDrawColor(0,0,0);
		$this->SetLineWidth(0.2);
	}
	
	function dateUS2FR($date)//2013-01-01
    {
	$J= substr($date,8,2);$M= substr($date,5,2);$A= substr($date,0,4);$dateUS2FR =  $J."-".$M."-".$A ;
    return $dateUS2FR;//01-01-2013
    }	
	function dateFR2US($date)//01/01/2013
	{
	$J= substr($date,0,2);$M= substr($date,3,2);$A= substr($date,6,4);$dateFR2US =  $A."-".$M."-".$J ;
    return $dateFR2US;//2013-01-01
	}
	
	function mysqlconnect()
	{
	$this->db_host;
	$this->db_name;
	$this->db_user;
	$this->db_pass;
    $cnx = mysql_connect($this->db_host,$this->db_user,$this->db_pass)or die ('I cannot connect to the database because: ' . mysql_error());
    $db  = mysql_select_db($this->db_name,$cnx) ;
	mysql_query("SET NAMES 'UTF8' ");
	return $db;
	}
	function nbrtostring($db_name,$tb_name,$colonename,$colonevalue,$resultatstring) 
	{
	if (is_numeric($colonevalue) and $colonevalue!=='') 
	{ 
	$db_host="localhost"; 
    $db_user="root";
    $db_pass="";
    $cnx = mysql_connect($db_host,$db_user,$db_pass)or die ('I cannot connect to the database because: ' . mysql_error());
    $db  = mysql_select_db($db_name,$cnx) ;
    // mysql_query("SET NAMES 'UTF8' ");
    $result = mysql_query("SELECT * FROM $tb_name where $colonename=$colonevalue" );
    $row=mysql_fetch_object($result);
	$resultat=$row->$resultatstring;
	return $resultat;
	} 
	return $resultat2='-------';
	}
	function stringtostring($tb_name,$colonename,$colonevalue,$resultatstring) 
	{
	if (isset($colonevalue) and $colonevalue!=='' ) 
	{ 
	$this->mysqlconnect();
    $result = mysql_query("SELECT * FROM $tb_name where $colonename='$colonevalue'" );
    $row1=mysql_fetch_object($result);
	// $resultat=$row1->$resultatstring;
	// return $resultat;
	} 
	return $resultat2='-------';
	}
	
	function decescimcomm($DATEJOUR1,$DATEJOUR2,$COMMUNER,$STRUCTURED,$CODECIM0) 
	{
	$this->mysqlconnect();
	$sql = " select * from deceshosp where DINS BETWEEN '$DATEJOUR1' AND '$DATEJOUR2' and COMMUNER=$COMMUNER and STRUCTURED $STRUCTURED and CODECIM0=$CODECIM0 ";
	$requete = @mysql_query($sql) or die($sql."<br>".mysql_error());
	$OP=mysql_num_rows($requete);
	mysql_free_result($requete);
	return $OP;
	}
	function datacimchapitre1($datejour1,$datejour2,$STRUCTURED,$CODECIM0) 
	{
	$data = array(
	"titre"=> 'Nombre De Deces',
	"A"    => '00-00',
	"B"    => '01-10',
	"C"    => '09-100',
	"D"    => '99-1000',
	"E"    => '999-10000',
	"1"    => $this->decescimcomm($datejour1,$datejour2,916,$STRUCTURED,$CODECIM0),//daira  Djelfa
	"2"    => $this->decescimcomm($datejour1,$datejour2,924,$STRUCTURED,$CODECIM0)+$this->decescimcomm($datejour1,$datejour2,925,$STRUCTURED,$CODECIM0),//daira  ainoussera
	"3"    => $this->decescimcomm($datejour1,$datejour2,929,$STRUCTURED,$CODECIM0)+$this->decescimcomm($datejour1,$datejour2,931,$STRUCTURED,$CODECIM0),//daira  birine
	"4"    => $this->decescimcomm($datejour1,$datejour2,929,$STRUCTURED,$CODECIM0)+$this->decescimcomm($datejour1,$datejour2,927,$STRUCTURED,$CODECIM0)+$this->decescimcomm($datejour1,$datejour2,928,$STRUCTURED,$CODECIM0),//daira  sidilaadjel
	"5"    => $this->decescimcomm($datejour1,$datejour2,932,$STRUCTURED,$CODECIM0)+$this->decescimcomm($datejour1,$datejour2,933,$STRUCTURED,$CODECIM0)+$this->decescimcomm($datejour1,$datejour2,934,$STRUCTURED,$CODECIM0),//daira  hadsahari
	"6"    => $this->decescimcomm($datejour1,$datejour2,935,$STRUCTURED,$CODECIM0)+$this->decescimcomm($datejour1,$datejour2,939,$STRUCTURED,$CODECIM0)+$this->decescimcomm($datejour1,$datejour2,941,$STRUCTURED,$CODECIM0)+$this->decescimcomm($datejour1,$datejour2,940,$STRUCTURED,$CODECIM0),//daira  hassibahbah
	"7"    => $this->decescimcomm($datejour1,$datejour2,942,$STRUCTURED,$CODECIM0)+$this->decescimcomm($datejour1,$datejour2,946,$STRUCTURED,$CODECIM0)+$this->decescimcomm($datejour1,$datejour2,947,$STRUCTURED,$CODECIM0),//daira  darchioukhe
	"8"    => $this->decescimcomm($datejour1,$datejour2,920,$STRUCTURED,$CODECIM0)+$this->decescimcomm($datejour1,$datejour2,919,$STRUCTURED,$CODECIM0)+$this->decescimcomm($datejour1,$datejour2,923,$STRUCTURED,$CODECIM0),//daira  charef
	"9"    => $this->decescimcomm($datejour1,$datejour2,917,$STRUCTURED,$CODECIM0)+$this->decescimcomm($datejour1,$datejour2,964,$STRUCTURED,$CODECIM0)+$this->decescimcomm($datejour1,$datejour2,963,$STRUCTURED,$CODECIM0),//daira  idrissia
	"10"   => $this->decescimcomm($datejour1,$datejour2,965,$STRUCTURED,$CODECIM0)+$this->decescimcomm($datejour1,$datejour2,958,$STRUCTURED,$CODECIM0)+$this->decescimcomm($datejour1,$datejour2,962,$STRUCTURED,$CODECIM0)+$this->decescimcomm($datejour1,$datejour2,957,$STRUCTURED,$CODECIM0),//daira  ain elbel
	"11"   => $this->decescimcomm($datejour1,$datejour2,948,$STRUCTURED,$CODECIM0)+$this->decescimcomm($datejour1,$datejour2,952,$STRUCTURED,$CODECIM0)+$this->decescimcomm($datejour1,$datejour2,954,$STRUCTURED,$CODECIM0)+$this->decescimcomm($datejour1,$datejour2,953,$STRUCTURED,$CODECIM0)+$this->decescimcomm($datejour1,$datejour2,951,$STRUCTURED,$CODECIM0),//daira  messaad
	"12"   => $this->decescimcomm($datejour1,$datejour2,967,$STRUCTURED,$CODECIM0)+$this->decescimcomm($datejour1,$datejour2,968,$STRUCTURED,$CODECIM0)+$this->decescimcomm($datejour1,$datejour2,956,$STRUCTURED,$CODECIM0),//daira  faid elbotma
	"916"  => $this->decescimcomm($datejour1,$datejour2,916,$STRUCTURED,$CODECIM0),//daira  Djelfa
	"917"  => $this->decescimcomm($datejour1,$datejour2,917,$STRUCTURED,$CODECIM0),//daira El Idrissia
	"918"  => $this->decescimcomm($datejour1,$datejour2,918,$STRUCTURED,$CODECIM0),//Oum Cheggag
	"919"  => $this->decescimcomm($datejour1,$datejour2,919,$STRUCTURED,$CODECIM0),//El Guedid
	"920"  => $this->decescimcomm($datejour1,$datejour2,920,$STRUCTURED,$CODECIM0),//daira Charef
	"921"  => $this->decescimcomm($datejour1,$datejour2,921,$STRUCTURED,$CODECIM0),//El Hammam
	"922"  => $this->decescimcomm($datejour1,$datejour2,922,$STRUCTURED,$CODECIM0),//Touazi
	"923"  => $this->decescimcomm($datejour1,$datejour2,923,$STRUCTURED,$CODECIM0),//Beni Yacoub
	"924"  => $this->decescimcomm($datejour1,$datejour2,924,$STRUCTURED,$CODECIM0),//daira ainoussera
	"925"  => $this->decescimcomm($datejour1,$datejour2,925,$STRUCTURED,$CODECIM0),//guernini
	"926"  => $this->decescimcomm($datejour1,$datejour2,926,$STRUCTURED,$CODECIM0),//daira sidilaadjel
	"927"  => $this->decescimcomm($datejour1,$datejour2,927,$STRUCTURED,$CODECIM0),//hassifdoul
	"928"  => $this->decescimcomm($datejour1,$datejour2,928,$STRUCTURED,$CODECIM0),//elkhamis
	"929"  => $this->decescimcomm($datejour1,$datejour2,929,$STRUCTURED,$CODECIM0),//daira birine
	"930"  => $this->decescimcomm($datejour1,$datejour2,930,$STRUCTURED,$CODECIM0),//Dra Souary
	"931"  => $this->decescimcomm($datejour1,$datejour2,931,$STRUCTURED,$CODECIM0),//benahar
	"932"  => $this->decescimcomm($datejour1,$datejour2,932,$STRUCTURED,$CODECIM0),//daira hadshari
	"933"  => $this->decescimcomm($datejour1,$datejour2,933,$STRUCTURED,$CODECIM0),//bouiratlahdab
	"934"  => $this->decescimcomm($datejour1,$datejour2,934,$STRUCTURED,$CODECIM0),//ainfka
	"935"  => $this->decescimcomm($datejour1,$datejour2,935,$STRUCTURED,$CODECIM0),//daira hassi bahbah
	"936"  => $this->decescimcomm($datejour1,$datejour2,936,$STRUCTURED,$CODECIM0),//Mouilah
	"937"  => $this->decescimcomm($datejour1,$datejour2,937,$STRUCTURED,$CODECIM0),//El Mesrane
	"938"  => $this->decescimcomm($datejour1,$datejour2,938,$STRUCTURED,$CODECIM0),//Hassi el Mora
	"939"  => $this->decescimcomm($datejour1,$datejour2,939,$STRUCTURED,$CODECIM0),//zaafrane
	"940"  => $this->decescimcomm($datejour1,$datejour2,940,$STRUCTURED,$CODECIM0),//hassi el euche
	"941"  => $this->decescimcomm($datejour1,$datejour2,941,$STRUCTURED,$CODECIM0),//ain maabed
	"942"  => $this->decescimcomm($datejour1,$datejour2,942,$STRUCTURED,$CODECIM0),//daira darchioukh
	"943"  => $this->decescimcomm($datejour1,$datejour2,943,$STRUCTURED,$CODECIM0),//Guendouza
	"944"  => $this->decescimcomm($datejour1,$datejour2,944,$STRUCTURED,$CODECIM0),//El Oguila
	"945"  => $this->decescimcomm($datejour1,$datejour2,945,$STRUCTURED,$CODECIM0),//El Merdja
	"946"  => $this->decescimcomm($datejour1,$datejour2,946,$STRUCTURED,$CODECIM0),//mliliha
	"947"  => $this->decescimcomm($datejour1,$datejour2,947,$STRUCTURED,$CODECIM0),//sidibayzid
	"948"  => $this->decescimcomm($datejour1,$datejour2,948,$STRUCTURED,$CODECIM0),//daira Messad
	"949"  => $this->decescimcomm($datejour1,$datejour2,949,$STRUCTURED,$CODECIM0),//Abdelmadjid
	"950"  => $this->decescimcomm($datejour1,$datejour2,950,$STRUCTURED,$CODECIM0),//Haniet Ouled Salem
	"951"  => $this->decescimcomm($datejour1,$datejour2,951,$STRUCTURED,$CODECIM0),//Guettara
	"952"  => $this->decescimcomm($datejour1,$datejour2,952,$STRUCTURED,$CODECIM0),//Deldoul
	"953"  => $this->decescimcomm($datejour1,$datejour2,953,$STRUCTURED,$CODECIM0),//Sed Rahal
	"954"  => $this->decescimcomm($datejour1,$datejour2,954,$STRUCTURED,$CODECIM0),//Selmana
	"955"  => $this->decescimcomm($datejour1,$datejour2,955,$STRUCTURED,$CODECIM0),//El Gahra
	"956"  => $this->decescimcomm($datejour1,$datejour2,956,$STRUCTURED,$CODECIM0),//Oum Laadham
	"957"  => $this->decescimcomm($datejour1,$datejour2,957,$STRUCTURED,$CODECIM0),//Mouadjebar
	"958"  => $this->decescimcomm($datejour1,$datejour2,958,$STRUCTURED,$CODECIM0),//daira Ain el Ibel
	"959"  => $this->decescimcomm($datejour1,$datejour2,959,$STRUCTURED,$CODECIM0),//Amera
	"960"  => $this->decescimcomm($datejour1,$datejour2,960,$STRUCTURED,$CODECIM0),//N'thila
	"961"  => $this->decescimcomm($datejour1,$datejour2,961,$STRUCTURED,$CODECIM0),//Oued Seddeur
	"962"  => $this->decescimcomm($datejour1,$datejour2,962,$STRUCTURED,$CODECIM0),//Zaccar
	"963"  => $this->decescimcomm($datejour1,$datejour2,963,$STRUCTURED,$CODECIM0),//Douis
	"964"  => $this->decescimcomm($datejour1,$datejour2,964,$STRUCTURED,$CODECIM0),//Ain Chouhada
	"965"  => $this->decescimcomm($datejour1,$datejour2,965,$STRUCTURED,$CODECIM0),//Tadmit
	"966"  => $this->decescimcomm($datejour1,$datejour2,966,$STRUCTURED,$CODECIM0),//El Hiouhi
	"967"  => $this->decescimcomm($datejour1,$datejour2,967,$STRUCTURED,$CODECIM0),//daira Faidh el Botma
	"968"  => $this->decescimcomm($datejour1,$datejour2,968,$STRUCTURED,$CODECIM0) //Amourah
	);		
	return $data;
	}
	function decescimcommcat($DATEJOUR1,$DATEJOUR2,$COMMUNER,$STRUCTURED,$CODECIM0) 
	{
	$this->mysqlconnect();
	$sql = " select * from deceshosp where DINS BETWEEN '$DATEJOUR1' AND '$DATEJOUR2' and COMMUNER=$COMMUNER and STRUCTURED $STRUCTURED and CODECIM=$CODECIM0 ";
	$requete = @mysql_query($sql) or die($sql."<br>".mysql_error());
	$OP=mysql_num_rows($requete);
	mysql_free_result($requete);
	return $OP;
	}
	function datacimcat1($datejour1,$datejour2,$STRUCTURED,$CODECIM0) 
	{
	$data = array(
	"titre"=> 'Nombre De Deces',
	"A"    => '00-00',
	"B"    => '01-10',
	"C"    => '09-100',
	"D"    => '99-1000',
	"E"    => '999-10000',
	"1"    => $this->decescimcommcat($datejour1,$datejour2,916,$STRUCTURED,$CODECIM0),//daira  Djelfa
	"2"    => $this->decescimcommcat($datejour1,$datejour2,924,$STRUCTURED,$CODECIM0)+$this->decescimcommcat($datejour1,$datejour2,925,$STRUCTURED,$CODECIM0),//daira  ainoussera
	"3"    => $this->decescimcommcat($datejour1,$datejour2,929,$STRUCTURED,$CODECIM0)+$this->decescimcommcat($datejour1,$datejour2,931,$STRUCTURED,$CODECIM0),//daira  birine
	"4"    => $this->decescimcommcat($datejour1,$datejour2,929,$STRUCTURED,$CODECIM0)+$this->decescimcommcat($datejour1,$datejour2,927,$STRUCTURED,$CODECIM0)+$this->decescimcommcat($datejour1,$datejour2,928,$STRUCTURED,$CODECIM0),//daira  sidilaadjel
	"5"    => $this->decescimcommcat($datejour1,$datejour2,932,$STRUCTURED,$CODECIM0)+$this->decescimcommcat($datejour1,$datejour2,933,$STRUCTURED,$CODECIM0)+$this->decescimcommcat($datejour1,$datejour2,934,$STRUCTURED,$CODECIM0),//daira  hadsahari
	"6"    => $this->decescimcommcat($datejour1,$datejour2,935,$STRUCTURED,$CODECIM0)+$this->decescimcommcat($datejour1,$datejour2,939,$STRUCTURED,$CODECIM0)+$this->decescimcommcat($datejour1,$datejour2,941,$STRUCTURED,$CODECIM0)+$this->decescimcommcat($datejour1,$datejour2,940,$STRUCTURED,$CODECIM0),//daira  hassibahbah
	"7"    => $this->decescimcommcat($datejour1,$datejour2,942,$STRUCTURED,$CODECIM0)+$this->decescimcommcat($datejour1,$datejour2,946,$STRUCTURED,$CODECIM0)+$this->decescimcommcat($datejour1,$datejour2,947,$STRUCTURED,$CODECIM0),//daira  darchioukhe
	"8"    => $this->decescimcommcat($datejour1,$datejour2,920,$STRUCTURED,$CODECIM0)+$this->decescimcommcat($datejour1,$datejour2,919,$STRUCTURED,$CODECIM0)+$this->decescimcommcat($datejour1,$datejour2,923,$STRUCTURED,$CODECIM0),//daira  charef
	"9"    => $this->decescimcommcat($datejour1,$datejour2,917,$STRUCTURED,$CODECIM0)+$this->decescimcommcat($datejour1,$datejour2,964,$STRUCTURED,$CODECIM0)+$this->decescimcommcat($datejour1,$datejour2,963,$STRUCTURED,$CODECIM0),//daira  idrissia
	"10"   => $this->decescimcommcat($datejour1,$datejour2,965,$STRUCTURED,$CODECIM0)+$this->decescimcommcat($datejour1,$datejour2,958,$STRUCTURED,$CODECIM0)+$this->decescimcommcat($datejour1,$datejour2,962,$STRUCTURED,$CODECIM0)+$this->decescimcommcat($datejour1,$datejour2,957,$STRUCTURED,$CODECIM0),//daira  ain elbel
	"11"   => $this->decescimcommcat($datejour1,$datejour2,948,$STRUCTURED,$CODECIM0)+$this->decescimcommcat($datejour1,$datejour2,952,$STRUCTURED,$CODECIM0)+$this->decescimcommcat($datejour1,$datejour2,954,$STRUCTURED,$CODECIM0)+$this->decescimcommcat($datejour1,$datejour2,953,$STRUCTURED,$CODECIM0)+$this->decescimcommcat($datejour1,$datejour2,951,$STRUCTURED,$CODECIM0),//daira  messaad
	"12"   => $this->decescimcommcat($datejour1,$datejour2,967,$STRUCTURED,$CODECIM0)+$this->decescimcommcat($datejour1,$datejour2,968,$STRUCTURED,$CODECIM0)+$this->decescimcommcat($datejour1,$datejour2,956,$STRUCTURED,$CODECIM0),//daira  faid elbotma
	"916"  => $this->decescimcommcat($datejour1,$datejour2,916,$STRUCTURED,$CODECIM0),//daira  Djelfa
	"917"  => $this->decescimcommcat($datejour1,$datejour2,917,$STRUCTURED,$CODECIM0),//daira El Idrissia
	"918"  => $this->decescimcommcat($datejour1,$datejour2,918,$STRUCTURED,$CODECIM0),//Oum Cheggag
	"919"  => $this->decescimcommcat($datejour1,$datejour2,919,$STRUCTURED,$CODECIM0),//El Guedid
	"920"  => $this->decescimcommcat($datejour1,$datejour2,920,$STRUCTURED,$CODECIM0),//daira Charef
	"921"  => $this->decescimcommcat($datejour1,$datejour2,921,$STRUCTURED,$CODECIM0),//El Hammam
	"922"  => $this->decescimcommcat($datejour1,$datejour2,922,$STRUCTURED,$CODECIM0),//Touazi
	"923"  => $this->decescimcommcat($datejour1,$datejour2,923,$STRUCTURED,$CODECIM0),//Beni Yacoub
	"924"  => $this->decescimcommcat($datejour1,$datejour2,924,$STRUCTURED,$CODECIM0),//daira ainoussera
	"925"  => $this->decescimcommcat($datejour1,$datejour2,925,$STRUCTURED,$CODECIM0),//guernini
	"926"  => $this->decescimcommcat($datejour1,$datejour2,926,$STRUCTURED,$CODECIM0),//daira sidilaadjel
	"927"  => $this->decescimcommcat($datejour1,$datejour2,927,$STRUCTURED,$CODECIM0),//hassifdoul
	"928"  => $this->decescimcommcat($datejour1,$datejour2,928,$STRUCTURED,$CODECIM0),//elkhamis
	"929"  => $this->decescimcommcat($datejour1,$datejour2,929,$STRUCTURED,$CODECIM0),//daira birine
	"930"  => $this->decescimcommcat($datejour1,$datejour2,930,$STRUCTURED,$CODECIM0),//Dra Souary
	"931"  => $this->decescimcommcat($datejour1,$datejour2,931,$STRUCTURED,$CODECIM0),//benahar
	"932"  => $this->decescimcommcat($datejour1,$datejour2,932,$STRUCTURED,$CODECIM0),//daira hadshari
	"933"  => $this->decescimcommcat($datejour1,$datejour2,933,$STRUCTURED,$CODECIM0),//bouiratlahdab
	"934"  => $this->decescimcommcat($datejour1,$datejour2,934,$STRUCTURED,$CODECIM0),//ainfka
	"935"  => $this->decescimcommcat($datejour1,$datejour2,935,$STRUCTURED,$CODECIM0),//daira hassi bahbah
	"936"  => $this->decescimcommcat($datejour1,$datejour2,936,$STRUCTURED,$CODECIM0),//Mouilah
	"937"  => $this->decescimcommcat($datejour1,$datejour2,937,$STRUCTURED,$CODECIM0),//El Mesrane
	"938"  => $this->decescimcommcat($datejour1,$datejour2,938,$STRUCTURED,$CODECIM0),//Hassi el Mora
	"939"  => $this->decescimcommcat($datejour1,$datejour2,939,$STRUCTURED,$CODECIM0),//zaafrane
	"940"  => $this->decescimcommcat($datejour1,$datejour2,940,$STRUCTURED,$CODECIM0),//hassi el euche
	"941"  => $this->decescimcommcat($datejour1,$datejour2,941,$STRUCTURED,$CODECIM0),//ain maabed
	"942"  => $this->decescimcommcat($datejour1,$datejour2,942,$STRUCTURED,$CODECIM0),//daira darchioukh
	"943"  => $this->decescimcommcat($datejour1,$datejour2,943,$STRUCTURED,$CODECIM0),//Guendouza
	"944"  => $this->decescimcommcat($datejour1,$datejour2,944,$STRUCTURED,$CODECIM0),//El Oguila
	"945"  => $this->decescimcommcat($datejour1,$datejour2,945,$STRUCTURED,$CODECIM0),//El Merdja
	"946"  => $this->decescimcommcat($datejour1,$datejour2,946,$STRUCTURED,$CODECIM0),//mliliha
	"947"  => $this->decescimcommcat($datejour1,$datejour2,947,$STRUCTURED,$CODECIM0),//sidibayzid
	"948"  => $this->decescimcommcat($datejour1,$datejour2,948,$STRUCTURED,$CODECIM0),//daira Messad
	"949"  => $this->decescimcommcat($datejour1,$datejour2,949,$STRUCTURED,$CODECIM0),//Abdelmadjid
	"950"  => $this->decescimcommcat($datejour1,$datejour2,950,$STRUCTURED,$CODECIM0),//Haniet Ouled Salem
	"951"  => $this->decescimcommcat($datejour1,$datejour2,951,$STRUCTURED,$CODECIM0),//Guettara
	"952"  => $this->decescimcommcat($datejour1,$datejour2,952,$STRUCTURED,$CODECIM0),//Deldoul
	"953"  => $this->decescimcommcat($datejour1,$datejour2,953,$STRUCTURED,$CODECIM0),//Sed Rahal
	"954"  => $this->decescimcommcat($datejour1,$datejour2,954,$STRUCTURED,$CODECIM0),//Selmana
	"955"  => $this->decescimcommcat($datejour1,$datejour2,955,$STRUCTURED,$CODECIM0),//El Gahra
	"956"  => $this->decescimcommcat($datejour1,$datejour2,956,$STRUCTURED,$CODECIM0),//Oum Laadham
	"957"  => $this->decescimcommcat($datejour1,$datejour2,957,$STRUCTURED,$CODECIM0),//Mouadjebar
	"958"  => $this->decescimcommcat($datejour1,$datejour2,958,$STRUCTURED,$CODECIM0),//daira Ain el Ibel
	"959"  => $this->decescimcommcat($datejour1,$datejour2,959,$STRUCTURED,$CODECIM0),//Amera
	"960"  => $this->decescimcommcat($datejour1,$datejour2,960,$STRUCTURED,$CODECIM0),//N'thila
	"961"  => $this->decescimcommcat($datejour1,$datejour2,961,$STRUCTURED,$CODECIM0),//Oued Seddeur
	"962"  => $this->decescimcommcat($datejour1,$datejour2,962,$STRUCTURED,$CODECIM0),//Zaccar
	"963"  => $this->decescimcommcat($datejour1,$datejour2,963,$STRUCTURED,$CODECIM0),//Douis
	"964"  => $this->decescimcommcat($datejour1,$datejour2,964,$STRUCTURED,$CODECIM0),//Ain Chouhada
	"965"  => $this->decescimcommcat($datejour1,$datejour2,965,$STRUCTURED,$CODECIM0),//Tadmit
	"966"  => $this->decescimcommcat($datejour1,$datejour2,966,$STRUCTURED,$CODECIM0),//El Hiouhi
	"967"  => $this->decescimcommcat($datejour1,$datejour2,967,$STRUCTURED,$CODECIM0),//daira Faidh el Botma
	"968"  => $this->decescimcommcat($datejour1,$datejour2,968,$STRUCTURED,$CODECIM0) //Amourah
	);		
	return $data;
	}
	
	function DECMAT($colone1,$colone2,$colone3,$datejour1,$datejour2,$SEXEDNR,$STRUCTURED)
	{
	$this->mysqlconnect();
	$sql = " select * from deceshosp where  ($colone1 >=$colone2  and $colone1 <=$colone3)  and (DINS BETWEEN '$datejour1' AND '$datejour2') and (SEX='$SEXEDNR' and STRUCTURED $STRUCTURED )          ";
	$requete = @mysql_query($sql) or die($sql."<br>".mysql_error());
	$collecte=mysql_num_rows($requete);
	mysql_free_result($requete);
	return $collecte;
	}
	
	function AGESEXECIM($colone1,$colone2,$colone3,$datejour1,$datejour2,$SEXEDNR,$STRUCTURED,$CIM,$CODECIM0)
	{
	$this->mysqlconnect();
	$sql = " select * from deceshosp where  ($colone1 >=$colone2  and $colone1 <=$colone3)  and (DINS BETWEEN '$datejour1' AND '$datejour2') and (SEX='$SEXEDNR' and STRUCTURED $STRUCTURED )  and $CIM=$CODECIM0        ";
	$requete = @mysql_query($sql) or die($sql."<br>".mysql_error());
	$collecte=mysql_num_rows($requete);
	mysql_free_result($requete);
	return $collecte;
	}
	function dataagesexecim($x,$y,$colone1,$TABLE,$DINS,$COMMUNER,$datejour1,$datejour2,$STRUCTURED,$CIM,$CODECIM0) 
	{
	$T2F20=array(
	"xt" => $x,
	"yt" => $y,
	"wc" => "",
	"hc" => "",
	"tt" => "Repartition des deces par tranche d'age et sexe (global)",
	"tc" => "Sexe",
	"tc1" =>"M",
	"tc3" =>"F",
	"tc5" =>"Total",
	"1M"  => $this->AGESEXECIM($colone1,0,4,$datejour1,$datejour2,'M',$STRUCTURED,$CIM,$CODECIM0),    "1F"  => $this->AGESEXECIM($colone1,0,4,$datejour1,$datejour2,'F',$STRUCTURED,$CIM,$CODECIM0),
	"2M"  => $this->AGESEXECIM($colone1,5,9,$datejour1,$datejour2,'M',$STRUCTURED,$CIM,$CODECIM0),    "2F"  => $this->AGESEXECIM($colone1,5,9,$datejour1,$datejour2,'F',$STRUCTURED,$CIM,$CODECIM0),
	"3M"  => $this->AGESEXECIM($colone1,10,14,$datejour1,$datejour2,'M',$STRUCTURED,$CIM,$CODECIM0),  "3F"  => $this->AGESEXECIM($colone1,10,14,$datejour1,$datejour2,'F',$STRUCTURED,$CIM,$CODECIM0),
	"4M"  => $this->AGESEXECIM($colone1,15,19,$datejour1,$datejour2,'M',$STRUCTURED,$CIM,$CODECIM0),  "4F"  => $this->AGESEXECIM($colone1,15,19,$datejour1,$datejour2,'F',$STRUCTURED,$CIM,$CODECIM0),
	"5M"  => $this->AGESEXECIM($colone1,20,24,$datejour1,$datejour2,'M',$STRUCTURED,$CIM,$CODECIM0),  "5F"  => $this->AGESEXECIM($colone1,20,24,$datejour1,$datejour2,'F',$STRUCTURED,$CIM,$CODECIM0),
	"6M"  => $this->AGESEXECIM($colone1,25,29,$datejour1,$datejour2,'M',$STRUCTURED,$CIM,$CODECIM0),  "6F"  => $this->AGESEXECIM($colone1,25,29,$datejour1,$datejour2,'F',$STRUCTURED,$CIM,$CODECIM0),
	"7M"  => $this->AGESEXECIM($colone1,30,34,$datejour1,$datejour2,'M',$STRUCTURED,$CIM,$CODECIM0),  "7F"  => $this->AGESEXECIM($colone1,30,34,$datejour1,$datejour2,'F',$STRUCTURED,$CIM,$CODECIM0),
	"8M"  => $this->AGESEXECIM($colone1,35,39,$datejour1,$datejour2,'M',$STRUCTURED,$CIM,$CODECIM0),  "8F"  => $this->AGESEXECIM($colone1,35,39,$datejour1,$datejour2,'F',$STRUCTURED,$CIM,$CODECIM0),
	"9M"  => $this->AGESEXECIM($colone1,40,44,$datejour1,$datejour2,'M',$STRUCTURED,$CIM,$CODECIM0),  "9F"  => $this->AGESEXECIM($colone1,40,44,$datejour1,$datejour2,'F',$STRUCTURED,$CIM,$CODECIM0),
	"10M" => $this->AGESEXECIM($colone1,45,49,$datejour1,$datejour2,'M',$STRUCTURED,$CIM,$CODECIM0),  "10F" => $this->AGESEXECIM($colone1,45,49,$datejour1,$datejour2,'F',$STRUCTURED,$CIM,$CODECIM0),
	"11M" => $this->AGESEXECIM($colone1,50,54,$datejour1,$datejour2,'M',$STRUCTURED,$CIM,$CODECIM0),  "11F" => $this->AGESEXECIM($colone1,50,54,$datejour1,$datejour2,'F',$STRUCTURED,$CIM,$CODECIM0),
	"12M" => $this->AGESEXECIM($colone1,55,59,$datejour1,$datejour2,'M',$STRUCTURED,$CIM,$CODECIM0),  "12F" => $this->AGESEXECIM($colone1,55,59,$datejour1,$datejour2,'F',$STRUCTURED,$CIM,$CODECIM0),
	"13M" => $this->AGESEXECIM($colone1,60,64,$datejour1,$datejour2,'M',$STRUCTURED,$CIM,$CODECIM0),  "13F" => $this->AGESEXECIM($colone1,60,64,$datejour1,$datejour2,'F',$STRUCTURED,$CIM,$CODECIM0),
	"14M" => $this->AGESEXECIM($colone1,65,69,$datejour1,$datejour2,'M',$STRUCTURED,$CIM,$CODECIM0),  "14F" => $this->AGESEXECIM($colone1,65,69,$datejour1,$datejour2,'F',$STRUCTURED,$CIM,$CODECIM0),
	"15M" => $this->AGESEXECIM($colone1,70,74,$datejour1,$datejour2,'M',$STRUCTURED,$CIM,$CODECIM0),  "15F" => $this->AGESEXECIM($colone1,70,74,$datejour1,$datejour2,'F',$STRUCTURED,$CIM,$CODECIM0),
	"16M" => $this->AGESEXECIM($colone1,75,79,$datejour1,$datejour2,'M',$STRUCTURED,$CIM,$CODECIM0),  "16F" => $this->AGESEXECIM($colone1,75,79,$datejour1,$datejour2,'F',$STRUCTURED,$CIM,$CODECIM0),
	"17M" => $this->AGESEXECIM($colone1,80,84,$datejour1,$datejour2,'M',$STRUCTURED,$CIM,$CODECIM0),  "17F" => $this->AGESEXECIM($colone1,80,84,$datejour1,$datejour2,'F',$STRUCTURED,$CIM,$CODECIM0),
	"18M" => $this->AGESEXECIM($colone1,85,89,$datejour1,$datejour2,'M',$STRUCTURED,$CIM,$CODECIM0),  "18F" => $this->AGESEXECIM($colone1,85,89,$datejour1,$datejour2,'F',$STRUCTURED,$CIM,$CODECIM0),
	"19M" => $this->AGESEXECIM($colone1,90,94,$datejour1,$datejour2,'M',$STRUCTURED,$CIM,$CODECIM0),  "19F" => $this->AGESEXECIM($colone1,90,94,$datejour1,$datejour2,'F',$STRUCTURED,$CIM,$CODECIM0),
	"20M" => $this->AGESEXECIM($colone1,95,150,$datejour1,$datejour2,'M',$STRUCTURED,$CIM,$CODECIM0), "20F" => $this->AGESEXECIM($colone1,95,150,$datejour1,$datejour2,'F',$STRUCTURED,$CIM,$CODECIM0),			
	"T" =>'1',
	"tl" =>"Age",
	"1MF"  => '00-04',  
	"2MF"  => '05-09',   
	"3MF"  => '10-14',  
	"4MF"  => '15-19',   
	"5MF"  => '20-24',  
	"6MF"  => '25-29',   
	"7MF"  => '30-34',  
	"8MF"  => '35-39',   
	"9MF"  => '40-44',   
	"10MF" => '45-49',  
	"11MF" => '50-54',  
	"12MF" => '55-59', 
	"13MF" => '60-64',  
	"14MF" => '65-69', 
	"15MF" => '70-74',  
	"16MF" => '75-79',  
	"17MF" => '80-84',  
	"18MF" => '85-89', 
	"19MF" => '90-94', 
	"20MF" => '95-99'  
	);
	return $T2F20;
	}
	function T2F20($data,$datejour1,$datejour2)  //tableau  corige le 15/08/2016
    {
	$this->SetXY($data['xt'],$data['yt']);     $this->cell(105,05,$data['tt'],1,0,'L',1,0);
	$this->SetXY($data['xt'],$this->GetY()+5); $this->cell(15,15,$data['tl'],1,0,'C',1,0);
	$this->SetXY($data['xt']+15,$this->GetY());$this->cell(75+15,10,$data['tc'],1,0,'C',1,0);$this->SetXY($data['xt']+15,$this->GetY()+10);$this->cell(30,5,$data['tc1'],1,0,'C',1,0); $this->SetXY($data['xt']+45,$this->GetY());$this->cell(30,5,$data['tc3'],1,0,'C',1,0);$this->SetXY($data['xt']+75,$this->GetY());$this->cell(15,5,$data['tc5'],1,0,'C',1,0);$this->SetXY($data['xt']+75+15,$this->GetY());$this->cell(15,5,'P %',1,0,'C',1,0);
	
	$TM=$data['1M']+$data['2M']+$data['3M']+$data['4M']+$data['5M']+$data['6M']+$data['7M']+$data['8M']+$data['9M']+$data['10M']+$data['11M']+$data['12M']+$data['13M']+$data['14M']+$data['15M']+$data['16M']+$data['17M']+$data['18M']+$data['19M']+$data['20M'];
	$TF=$data['1F']+$data['2F']+$data['3F']+$data['4F']+$data['5F']+$data['6F']+$data['7F']+$data['8F']+$data['9F']+$data['10F']+$data['11F']+$data['12F']+$data['13F']+$data['14F']+$data['15F']+$data['16F']+$data['17F']+$data['18F']+$data['19F']+$data['20F'];
	if ($TM+$TF > 0){$T=$TM+$TF;}else{$T=1;}
	$datamf = array($data['1M']+$data['1F'],
	                $data['2M']+$data['2F'],
					$data['3M']+$data['3F'],
					$data['4M']+$data['4F'],
					$data['5M']+$data['5F'],
					$data['6M']+$data['6F'],
					$data['7M']+$data['7F'],
					$data['8M']+$data['8F'],
					$data['9M']+$data['9F'],
					$data['10M']+$data['10F'],
					$data['11M']+$data['11F'],
					$data['12M']+$data['12F'],
					$data['13M']+$data['13F'],
					$data['14M']+$data['14F'],
					$data['15M']+$data['15F'],
					$data['16M']+$data['16F'],
					$data['17M']+$data['17F'],
					$data['18M']+$data['18F'],
					$data['19M']+$data['19F'],
					$data['20M']+$data['20F']);

	$this->SetXY($data['xt'],$this->GetY()+5);$this->cell(15,5,$data['1MF'],1,0,'C',1,0);
	$this->SetXY($data['xt']+15,$this->GetY());$this->cell(30,5,$data['1M'],1,0,'C',0,0);
	$this->SetXY($data['xt']+45,$this->GetY());$this->cell(30,5,$data['1F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75,$this->GetY());$this->cell(15,5,$data['1M']+$data['1F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75+15,$this->GetY());$this->cell(15,5,round(((($data['1M']+$data['1F'])/$T)*100),2).' %',1,0,'R',1,0);        
	
	$this->SetXY($data['xt'],$this->GetY()+5);$this->cell(15,5,$data['2MF'],1,0,'C',1,0);
	$this->SetXY($data['xt']+15,$this->GetY());$this->cell(30,5,$data['2M'],1,0,'C',0,0);
	$this->SetXY($data['xt']+45,$this->GetY());$this->cell(30,5,$data['2F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75,$this->GetY());$this->cell(15,5,$data['2M']+$data['2F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75+15,$this->GetY());$this->cell(15,5,round(((($data['2M']+$data['2F'])/$T)*100),2).' %',1,0,'R',1,0);        
 
	$this->SetXY($data['xt'],$this->GetY()+5);$this->cell(15,5,$data['3MF'],1,0,'C',1,0);
	$this->SetXY($data['xt']+15,$this->GetY());$this->cell(30,5,$data['3M'],1,0,'C',0,0);
	$this->SetXY($data['xt']+45,$this->GetY());$this->cell(30,5,$data['3F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75,$this->GetY());$this->cell(15,5,$data['3M']+$data['3F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75+15,$this->GetY());$this->cell(15,5,round(((($data['3M']+$data['3F'])/$T)*100),2).' %',1,0,'R',1,0);        
	 
	$this->SetXY($data['xt'],$this->GetY()+5);$this->cell(15,5,$data['4MF'],1,0,'C',1,0);
	$this->SetXY($data['xt']+15,$this->GetY());$this->cell(30,5,$data['4M'],1,0,'C',0,0);
	$this->SetXY($data['xt']+45,$this->GetY());$this->cell(30,5,$data['4F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75,$this->GetY());$this->cell(15,5,$data['4M']+$data['4F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75+15,$this->GetY());$this->cell(15,5,round(((($data['4M']+$data['4F'])/$T)*100),2).' %',1,0,'R',1,0);        
	
	$this->SetXY($data['xt'],$this->GetY()+5);$this->cell(15,5,$data['5MF'],1,0,'C',1,0);
	$this->SetXY($data['xt']+15,$this->GetY());$this->cell(30,5,$data['5M'],1,0,'C',0,0);
	$this->SetXY($data['xt']+45,$this->GetY());$this->cell(30,5,$data['5F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75,$this->GetY());$this->cell(15,5,$data['5M']+$data['5F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75+15,$this->GetY());$this->cell(15,5,round(((($data['5M']+$data['5F'])/$T)*100),2).' %',1,0,'R',1,0);        
	 
	$this->SetXY($data['xt'],$this->GetY()+5);$this->cell(15,5,$data['6MF'],1,0,'C',1,0);
	$this->SetXY($data['xt']+15,$this->GetY());$this->cell(30,5,$data['6M'],1,0,'C',0,0);
	$this->SetXY($data['xt']+45,$this->GetY());$this->cell(30,5,$data['6F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75,$this->GetY());$this->cell(15,5,$data['6M']+$data['6F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75+15,$this->GetY());$this->cell(15,5,round(((($data['6M']+$data['6F'])/$T)*100),2).' %',1,0,'R',1,0);        
	
	$this->SetXY($data['xt'],$this->GetY()+5);$this->cell(15,5,$data['7MF'],1,0,'C',1,0);
	$this->SetXY($data['xt']+15,$this->GetY());$this->cell(30,5,$data['7M'],1,0,'C',0,0);
	$this->SetXY($data['xt']+45,$this->GetY());$this->cell(30,5,$data['7F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75,$this->GetY());$this->cell(15,5,$data['7M']+$data['7F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75+15,$this->GetY());$this->cell(15,5,round(((($data['7M']+$data['7F'])/$T)*100),2).' %',1,0,'R',1,0);        
 
	$this->SetXY($data['xt'],$this->GetY()+5);$this->cell(15,5,$data['8MF'],1,0,'C',1,0);
	$this->SetXY($data['xt']+15,$this->GetY());$this->cell(30,5,$data['8M'],1,0,'C',0,0);
	$this->SetXY($data['xt']+45,$this->GetY());$this->cell(30,5,$data['8F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75,$this->GetY());$this->cell(15,5,$data['8M']+$data['8F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75+15,$this->GetY());$this->cell(15,5,round(((($data['8M']+$data['8F'])/$T)*100),2).' %',1,0,'R',1,0);        
	
	$this->SetXY($data['xt'],$this->GetY()+5);$this->cell(15,5,$data['9MF'],1,0,'C',1,0);
	$this->SetXY($data['xt']+15,$this->GetY());$this->cell(30,5,$data['9M'],1,0,'C',0,0);
	$this->SetXY($data['xt']+45,$this->GetY());$this->cell(30,5,$data['9F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75,$this->GetY());$this->cell(15,5,$data['9M']+$data['9F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75+15,$this->GetY());$this->cell(15,5,round(((($data['9M']+$data['9F'])/$T)*100),2).' %',1,0,'R',1,0);        
	
	$this->SetXY($data['xt'],$this->GetY()+5);$this->cell(15,5,$data['10MF'],1,0,'C',1,0);
	$this->SetXY($data['xt']+15,$this->GetY());$this->cell(30,5,$data['10M'],1,0,'C',0,0);
	$this->SetXY($data['xt']+45,$this->GetY());$this->cell(30,5,$data['10F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75,$this->GetY());$this->cell(15,5,$data['10M']+$data['10F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75+15,$this->GetY());$this->cell(15,5,round(((($data['10M']+$data['10F'])/$T)*100),2).' %',1,0,'R',1,0);        
	
	$this->SetXY($data['xt'],$this->GetY()+5);$this->cell(15,5,$data['11MF'],1,0,'C',1,0);
	$this->SetXY($data['xt']+15,$this->GetY());$this->cell(30,5,$data['11M'],1,0,'C',0,0);
	$this->SetXY($data['xt']+45,$this->GetY());$this->cell(30,5,$data['11F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75,$this->GetY());$this->cell(15,5,$data['11M']+$data['11F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75+15,$this->GetY());$this->cell(15,5,round(((($data['11M']+$data['11F'])/$T)*100),2).' %',1,0,'R',1,0);        
	
	$this->SetXY($data['xt'],$this->GetY()+5);$this->cell(15,5,$data['12MF'],1,0,'C',1,0);
	$this->SetXY($data['xt']+15,$this->GetY());$this->cell(30,5,$data['12M'],1,0,'C',0,0);
	$this->SetXY($data['xt']+45,$this->GetY());$this->cell(30,5,$data['12F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75,$this->GetY());$this->cell(15,5,$data['12M']+$data['12F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75+15,$this->GetY());$this->cell(15,5,round(((($data['12M']+$data['12F'])/$T)*100),2).' %',1,0,'R',1,0);        
	
	$this->SetXY($data['xt'],$this->GetY()+5);$this->cell(15,5,$data['13MF'],1,0,'C',1,0);
	$this->SetXY($data['xt']+15,$this->GetY());$this->cell(30,5,$data['13M'],1,0,'C',0,0);
	$this->SetXY($data['xt']+45,$this->GetY());$this->cell(30,5,$data['13F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75,$this->GetY());$this->cell(15,5,$data['13M']+$data['13F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75+15,$this->GetY());$this->cell(15,5,round(((($data['13M']+$data['13F'])/$T)*100),2).' %',1,0,'R',1,0);        
	
	$this->SetXY($data['xt'],$this->GetY()+5);$this->cell(15,5,$data['14MF'],1,0,'C',1,0);
	$this->SetXY($data['xt']+15,$this->GetY());$this->cell(30,5,$data['14M'],1,0,'C',0,0);
	$this->SetXY($data['xt']+45,$this->GetY());$this->cell(30,5,$data['14F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75,$this->GetY());$this->cell(15,5,$data['14M']+$data['14F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75+15,$this->GetY());$this->cell(15,5,round(((($data['14M']+$data['14F'])/$T)*100),2).' %',1,0,'R',1,0);        
	
	$this->SetXY($data['xt'],$this->GetY()+5);$this->cell(15,5,$data['15MF'],1,0,'C',1,0);
	$this->SetXY($data['xt']+15,$this->GetY());$this->cell(30,5,$data['15M'],1,0,'C',0,0);
	$this->SetXY($data['xt']+45,$this->GetY());$this->cell(30,5,$data['15F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75,$this->GetY());$this->cell(15,5,$data['15M']+$data['15F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75+15,$this->GetY());$this->cell(15,5,round(((($data['15M']+$data['15F'])/$T)*100),2).' %',1,0,'R',1,0);        
	
	$this->SetXY($data['xt'],$this->GetY()+5); $this->cell(15,5,$data['16MF'],1,0,'C',1,0);
	$this->SetXY($data['xt']+15,$this->GetY());$this->cell(30,5,$data['16M'],1,0,'C',0,0);
	$this->SetXY($data['xt']+45,$this->GetY());$this->cell(30,5,$data['16F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75,$this->GetY());$this->cell(15,5,$data['16M']+$data['16F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75+15,$this->GetY());$this->cell(15,5,round(((($data['16M']+$data['16F'])/$T)*100),2).' %',1,0,'R',1,0);        
	
	$this->SetXY($data['xt'],$this->GetY()+5); $this->cell(15,5,$data['17MF'],1,0,'C',1,0);
	$this->SetXY($data['xt']+15,$this->GetY());$this->cell(30,5,$data['17M'],1,0,'C',0,0);
	$this->SetXY($data['xt']+45,$this->GetY());$this->cell(30,5,$data['17F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75,$this->GetY());$this->cell(15,5,$data['17M']+$data['17F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75+15,$this->GetY());$this->cell(15,5,round(((($data['17M']+$data['17F'])/$T)*100),2).' %',1,0,'R',1,0);        
	
	$this->SetXY($data['xt'],$this->GetY()+5); $this->cell(15,5,$data['18MF'],1,0,'C',1,0);
	$this->SetXY($data['xt']+15,$this->GetY());$this->cell(30,5,$data['18M'],1,0,'C',0,0);
	$this->SetXY($data['xt']+45,$this->GetY());$this->cell(30,5,$data['18F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75,$this->GetY());$this->cell(15,5,$data['18M']+$data['18F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75+15,$this->GetY());$this->cell(15,5,round(((($data['18M']+$data['18F'])/$T)*100),2).' %',1,0,'R',1,0);        
	
	$this->SetXY($data['xt'],$this->GetY()+5); $this->cell(15,5,$data['19MF'],1,0,'C',1,0);
	$this->SetXY($data['xt']+15,$this->GetY());$this->cell(30,5,$data['19M'],1,0,'C',0,0);
	$this->SetXY($data['xt']+45,$this->GetY());$this->cell(30,5,$data['19F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75,$this->GetY());$this->cell(15,5,$data['19M']+$data['19F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75+15,$this->GetY());$this->cell(15,5,round(((($data['19M']+$data['19F'])/$T)*100),2).' %',1,0,'R',1,0);        
	
	$this->SetXY($data['xt'],$this->GetY()+5); $this->cell(15,5,$data['20MF'],1,0,'C',1,0);
	$this->SetXY($data['xt']+15,$this->GetY());$this->cell(30,5,$data['20M'],1,0,'C',0,0);
	$this->SetXY($data['xt']+45,$this->GetY());$this->cell(30,5,$data['20F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75,$this->GetY());$this->cell(15,5,$data['20M']+$data['20F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75+15,$this->GetY());$this->cell(15,5,round(((($data['20M']+$data['20F'])/$T)*100),2).' %',1,0,'R',1,0);        
	
	$this->SetXY($data['xt'],$this->GetY()+5);$this->cell(15,5,'Total',1,0,'C',1,0);
	$this->SetXY($data['xt']+15,$this->GetY());$this->cell(30,5,$TM,1,0,'C',1,0);
	$this->SetXY($data['xt']+45,$this->GetY());$this->cell(30,5,$TF,1,0,'C',1,0);
	$this->SetXY($data['xt']+75,$this->GetY());$this->cell(15,5,$T,1,0,'C',1,0);
	$this->SetXY($data['xt']+75+15,$this->GetY());$this->cell(15,5,round(((($TM+$TF)/$T)*100),2).' %',1,0,'R',1,0); 	                                                                
	
	$this->SetXY($data['xt'],$this->GetY()+5); $this->cell(15,5,'P %',1,0,'C',1,0);      
	$this->SetXY($data['xt']+15,$this->GetY());$this->cell(30,5,round(($TM/$T)*100,2),1,0,'C',1,0);
	$this->SetXY($data['xt']+45,$this->GetY());$this->cell(30,5,round(($TF/$T)*100,2),1,0,'C',1,0);
	$this->SetXY($data['xt']+75,$this->GetY());$this->cell(15,5,round(($T/$T)*100,2).' %',1,0,'C',1,0);
	$this->SetXY($data['xt']+75+15,$this->GetY());$this->cell(15,5,'***',1,0,'C',1,0); 	                                                                
	
	$this->SetXY(5,25+10);$this->cell(285,5,html_entity_decode(utf8_decode("Cette étude a porté sur ".$T." décès survenus durant la periode du ".$this->dateUS2FR($datejour1)." au ".$this->dateUS2FR($datejour2)." au niveau de 36 communes ")),0,0,'L',0);
	$this->SetXY(5,175);  $this->cell(285,5,html_entity_decode(utf8_decode("1-Répartition des décès par sexe : ")),0,0,'L',0);
	$this->SetXY(5,175+5);$this->cell(285,5,html_entity_decode(utf8_decode("La répartition des ".$T." décès enregistrés montre que :")),0,0,'L',0);
	$this->SetXY(5,175+10);$this->cell(285,5,html_entity_decode(utf8_decode(round(($TM/$T)*100,2)."% des décès touche les hommes. ")),0,0,'L',0);
	$this->SetXY(5,175+15);$this->cell(285,5,html_entity_decode(utf8_decode(round(($TF/$T)*100,2)."% des décès touche les femmes. ")),0,0,'L',0);
	if ($TF > 0){$TF0=$TF;}else{$TF0=1;}
	$this->SetXY(5,175+20);$this->cell(285,5,html_entity_decode(utf8_decode("avec un sexe ratio de ".round(($TM/$TF0),2))),0,0,'L',0);
	$this->SetXY(5,175+30);$this->cell(285,5,html_entity_decode(utf8_decode("2-Répartition des décès par tranche d'âge : ")),0,0,'L',0);
	rsort($datamf);
	$this->SetXY(5,175+35);$this->cell(285,5,html_entity_decode(utf8_decode("la proportion des décès la plus élevée est : ".round($datamf[0]*100/$T,2)."%")),0,0,'L',0);
	sort($datamf);
	$this->SetXY(5,175+40);$this->cell(285,5,html_entity_decode(utf8_decode("la proportion des décès la moins élevée est : ".round($datamf[0]*100/$T,2)."%")),0,0,'L',0);
	$pie2 = array(
	"x" => 135, 
	"y" => 200, 
	"r" => 17,
	"v1" => $TM,
	"v2" => $TF,
	"t0" => html_entity_decode(utf8_decode("Distribution des décès par sexe ")),
	"t1" => "M",
	"t2" => "F");
    $this->pie2($pie2);
	
	$TA1=$data['1M']+$data['1F'];
	$TA2=$data['2M']+$data['2F'];
	$TA3=$data['3M']+$data['3F'];
	$TA4=$data['4M']+$data['4F'];
	$TA5=$data['5M']+$data['5F'];
	$TA6=$data['6M']+$data['6F'];
	$TA7=$data['7M']+$data['7F'];
	$TA8=$data['8M']+$data['8F'];
	$TA9=$data['9M']+$data['9F'];
	$TA10=$data['10M']+$data['10F'];
	$TA11=$data['11M']+$data['11F'];
	$TA12=$data['12M']+$data['12F'];
	$TA13=$data['13M']+$data['13F'];
	$TA14=$data['14M']+$data['14F'];
	$TA15=$data['15M']+$data['15F'];
	$TA16=$data['16M']+$data['16F'];
	$TA17=$data['17M']+$data['17F'];
	$TA18=$data['18M']+$data['18F'];
	$TA19=$data['19M']+$data['19F'];
	$TA20=$data['20M']+$data['20F'];
	$this->bar20(135,150,$TA1,$TA2,$TA3,$TA4,$TA5,$TA6,$TA7,$TA8,$TA9,$TA10,$TA11,$TA12,$TA13,$TA14,$TA15,$TA16,$TA17,$TA18,$TA19,$TA20,utf8_decode('Distribution des décès par tranche d\'age en année'));
	}
	function decescim($DATEJOUR1,$DATEJOUR2,$WILAYAR,$STRUCTURED,$CODECIM) 
	{
	$this->mysqlconnect();
	$sql = " select * from deceshosp where DINS BETWEEN '$DATEJOUR1' AND '$DATEJOUR2' and WILAYAR=$WILAYAR and STRUCTURED $STRUCTURED and CODECIM0=$CODECIM  ";
	$requete = @mysql_query($sql) or die($sql."<br>".mysql_error());
	$OP=mysql_num_rows($requete);
	mysql_free_result($requete);
	return $OP;
	}
	function datacimchapitre($datejour1,$datejour2,$STRUCTURED,$CODECIM) 
	{
	$data = array(
	"titre"=> 'Nombre De Deces',
	"A"    => '00-00',
	"B"    => '01-10',
	"C"    => '09-100',
	"D"    => '99-1000',
	"E"    => '999-10000',
	"1"    => $this->decescim($datejour1,$datejour2,1000,$STRUCTURED,$CODECIM),
	"2"    => $this->decescim($datejour1,$datejour2,2000,$STRUCTURED,$CODECIM),
	"3"    => $this->decescim($datejour1,$datejour2,3000,$STRUCTURED,$CODECIM),
	"4"    => $this->decescim($datejour1,$datejour2,4000,$STRUCTURED,$CODECIM),
	"5"    => $this->decescim($datejour1,$datejour2,5000,$STRUCTURED,$CODECIM),
	"6"    => $this->decescim($datejour1,$datejour2,6000,$STRUCTURED,$CODECIM),
	"7"    => $this->decescim($datejour1,$datejour2,7000,$STRUCTURED,$CODECIM),
	"8"    => $this->decescim($datejour1,$datejour2,8000,$STRUCTURED,$CODECIM),
	"9"    => $this->decescim($datejour1,$datejour2,9000,$STRUCTURED,$CODECIM),
	"10"    => $this->decescim($datejour1,$datejour2,10000,$STRUCTURED,$CODECIM),
	"11"    => $this->decescim($datejour1,$datejour2,11000,$STRUCTURED,$CODECIM),
	"12"    => $this->decescim($datejour1,$datejour2,12000,$STRUCTURED,$CODECIM),
	"13"    => $this->decescim($datejour1,$datejour2,13000,$STRUCTURED,$CODECIM),
	"14"    => $this->decescim($datejour1,$datejour2,14000,$STRUCTURED,$CODECIM),
	"15"    => $this->decescim($datejour1,$datejour2,15000,$STRUCTURED,$CODECIM),
	"16"    => $this->decescim($datejour1,$datejour2,16000,$STRUCTURED,$CODECIM),
	"17"    => $this->decescim($datejour1,$datejour2,17000,$STRUCTURED,$CODECIM),
	"18"    => $this->decescim($datejour1,$datejour2,18000,$STRUCTURED,$CODECIM),
	"19"    => $this->decescim($datejour1,$datejour2,19000,$STRUCTURED,$CODECIM),
	"20"    => $this->decescim($datejour1,$datejour2,20000,$STRUCTURED,$CODECIM),
	"21"    => $this->decescim($datejour1,$datejour2,21000,$STRUCTURED,$CODECIM),
	"22"    => $this->decescim($datejour1,$datejour2,22000,$STRUCTURED,$CODECIM),
	"23"    => $this->decescim($datejour1,$datejour2,23000,$STRUCTURED,$CODECIM),
	"24"    => $this->decescim($datejour1,$datejour2,24000,$STRUCTURED,$CODECIM),
	"25"    => $this->decescim($datejour1,$datejour2,25000,$STRUCTURED,$CODECIM),
	"26"    => $this->decescim($datejour1,$datejour2,26000,$STRUCTURED,$CODECIM),
	"27"    => $this->decescim($datejour1,$datejour2,27000,$STRUCTURED,$CODECIM),
	"28"    => $this->decescim($datejour1,$datejour2,28000,$STRUCTURED,$CODECIM),
	"29"    => $this->decescim($datejour1,$datejour2,29000,$STRUCTURED,$CODECIM),
	"30"    => $this->decescim($datejour1,$datejour2,30000,$STRUCTURED,$CODECIM),
	"31"    => $this->decescim($datejour1,$datejour2,31000,$STRUCTURED,$CODECIM),
	"32"    => $this->decescim($datejour1,$datejour2,32000,$STRUCTURED,$CODECIM),
	"33"    => $this->decescim($datejour1,$datejour2,33000,$STRUCTURED,$CODECIM),
	"34"    => $this->decescim($datejour1,$datejour2,34000,$STRUCTURED,$CODECIM),
	"35"    => $this->decescim($datejour1,$datejour2,35000,$STRUCTURED,$CODECIM),
	"36"    => $this->decescim($datejour1,$datejour2,36000,$STRUCTURED,$CODECIM),
	"37"    => $this->decescim($datejour1,$datejour2,37000,$STRUCTURED,$CODECIM),
	"38"    => $this->decescim($datejour1,$datejour2,38000,$STRUCTURED,$CODECIM),
	"39"    => $this->decescim($datejour1,$datejour2,39000,$STRUCTURED,$CODECIM),
	"40"    => $this->decescim($datejour1,$datejour2,40000,$STRUCTURED,$CODECIM),
	"41"    => $this->decescim($datejour1,$datejour2,41000,$STRUCTURED,$CODECIM),
	"42"    => $this->decescim($datejour1,$datejour2,42000,$STRUCTURED,$CODECIM),
	"43"    => $this->decescim($datejour1,$datejour2,43000,$STRUCTURED,$CODECIM),
	"44"    => $this->decescim($datejour1,$datejour2,44000,$STRUCTURED,$CODECIM),
	"45"    => $this->decescim($datejour1,$datejour2,45000,$STRUCTURED,$CODECIM),
	"46"    => $this->decescim($datejour1,$datejour2,46000,$STRUCTURED,$CODECIM),
	"47"    => $this->decescim($datejour1,$datejour2,47000,$STRUCTURED,$CODECIM),
	"48"    => $this->decescim($datejour1,$datejour2,48000,$STRUCTURED,$CODECIM)
	);		
	return $data;
	}
	function decescimcat($DATEJOUR1,$DATEJOUR2,$WILAYAR,$STRUCTURED,$CODECIM) 
	{
	$this->mysqlconnect();
	$sql = " select * from deceshosp where DINS BETWEEN '$DATEJOUR1' AND '$DATEJOUR2' and WILAYAR=$WILAYAR and STRUCTURED $STRUCTURED and CODECIM=$CODECIM  ";
	$requete = @mysql_query($sql) or die($sql."<br>".mysql_error());
	$OP=mysql_num_rows($requete);
	mysql_free_result($requete);
	return $OP;
	}
	function datacimcat($datejour1,$datejour2,$STRUCTURED,$CODECIM) 
	{
	$data = array(
	"titre"=> 'Nombre De Deces',
	"A"    => '00-00',
	"B"    => '01-10',
	"C"    => '09-100',
	"D"    => '99-1000',
	"E"    => '999-10000',
	"1"    => $this->decescimcat($datejour1,$datejour2,1000,$STRUCTURED,$CODECIM),
	"2"    => $this->decescimcat($datejour1,$datejour2,2000,$STRUCTURED,$CODECIM),
	"3"    => $this->decescimcat($datejour1,$datejour2,3000,$STRUCTURED,$CODECIM),
	"4"    => $this->decescimcat($datejour1,$datejour2,4000,$STRUCTURED,$CODECIM),
	"5"    => $this->decescimcat($datejour1,$datejour2,5000,$STRUCTURED,$CODECIM),
	"6"    => $this->decescimcat($datejour1,$datejour2,6000,$STRUCTURED,$CODECIM),
	"7"    => $this->decescimcat($datejour1,$datejour2,7000,$STRUCTURED,$CODECIM),
	"8"    => $this->decescimcat($datejour1,$datejour2,8000,$STRUCTURED,$CODECIM),
	"9"    => $this->decescimcat($datejour1,$datejour2,9000,$STRUCTURED,$CODECIM),
	"10"    => $this->decescimcat($datejour1,$datejour2,10000,$STRUCTURED,$CODECIM),
	"11"    => $this->decescimcat($datejour1,$datejour2,11000,$STRUCTURED,$CODECIM),
	"12"    => $this->decescimcat($datejour1,$datejour2,12000,$STRUCTURED,$CODECIM),
	"13"    => $this->decescimcat($datejour1,$datejour2,13000,$STRUCTURED,$CODECIM),
	"14"    => $this->decescimcat($datejour1,$datejour2,14000,$STRUCTURED,$CODECIM),
	"15"    => $this->decescimcat($datejour1,$datejour2,15000,$STRUCTURED,$CODECIM),
	"16"    => $this->decescimcat($datejour1,$datejour2,16000,$STRUCTURED,$CODECIM),
	"17"    => $this->decescimcat($datejour1,$datejour2,17000,$STRUCTURED,$CODECIM),
	"18"    => $this->decescimcat($datejour1,$datejour2,18000,$STRUCTURED,$CODECIM),
	"19"    => $this->decescimcat($datejour1,$datejour2,19000,$STRUCTURED,$CODECIM),
	"20"    => $this->decescimcat($datejour1,$datejour2,20000,$STRUCTURED,$CODECIM),
	"21"    => $this->decescimcat($datejour1,$datejour2,21000,$STRUCTURED,$CODECIM),
	"22"    => $this->decescimcat($datejour1,$datejour2,22000,$STRUCTURED,$CODECIM),
	"23"    => $this->decescimcat($datejour1,$datejour2,23000,$STRUCTURED,$CODECIM),
	"24"    => $this->decescimcat($datejour1,$datejour2,24000,$STRUCTURED,$CODECIM),
	"25"    => $this->decescimcat($datejour1,$datejour2,25000,$STRUCTURED,$CODECIM),
	"26"    => $this->decescimcat($datejour1,$datejour2,26000,$STRUCTURED,$CODECIM),
	"27"    => $this->decescimcat($datejour1,$datejour2,27000,$STRUCTURED,$CODECIM),
	"28"    => $this->decescimcat($datejour1,$datejour2,28000,$STRUCTURED,$CODECIM),
	"29"    => $this->decescimcat($datejour1,$datejour2,29000,$STRUCTURED,$CODECIM),
	"30"    => $this->decescimcat($datejour1,$datejour2,30000,$STRUCTURED,$CODECIM),
	"31"    => $this->decescimcat($datejour1,$datejour2,31000,$STRUCTURED,$CODECIM),
	"32"    => $this->decescimcat($datejour1,$datejour2,32000,$STRUCTURED,$CODECIM),
	"33"    => $this->decescimcat($datejour1,$datejour2,33000,$STRUCTURED,$CODECIM),
	"34"    => $this->decescimcat($datejour1,$datejour2,34000,$STRUCTURED,$CODECIM),
	"35"    => $this->decescimcat($datejour1,$datejour2,35000,$STRUCTURED,$CODECIM),
	"36"    => $this->decescimcat($datejour1,$datejour2,36000,$STRUCTURED,$CODECIM),
	"37"    => $this->decescimcat($datejour1,$datejour2,37000,$STRUCTURED,$CODECIM),
	"38"    => $this->decescimcat($datejour1,$datejour2,38000,$STRUCTURED,$CODECIM),
	"39"    => $this->decescimcat($datejour1,$datejour2,39000,$STRUCTURED,$CODECIM),
	"40"    => $this->decescimcat($datejour1,$datejour2,40000,$STRUCTURED,$CODECIM),
	"41"    => $this->decescimcat($datejour1,$datejour2,41000,$STRUCTURED,$CODECIM),
	"42"    => $this->decescimcat($datejour1,$datejour2,42000,$STRUCTURED,$CODECIM),
	"43"    => $this->decescimcat($datejour1,$datejour2,43000,$STRUCTURED,$CODECIM),
	"44"    => $this->decescimcat($datejour1,$datejour2,44000,$STRUCTURED,$CODECIM),
	"45"    => $this->decescimcat($datejour1,$datejour2,45000,$STRUCTURED,$CODECIM),
	"46"    => $this->decescimcat($datejour1,$datejour2,46000,$STRUCTURED,$CODECIM),
	"47"    => $this->decescimcat($datejour1,$datejour2,47000,$STRUCTURED,$CODECIM),
	"48"    => $this->decescimcat($datejour1,$datejour2,48000,$STRUCTURED,$CODECIM)
	);		
	return $data;
	}
	
	
	function STAT($colone1,$datejour1,$datejour2)
	{
    $this->mysqlconnect();
	$sql = " select * from deceshosp where $colone1>=1 and  $colone1<=150  and (DINS BETWEEN '$datejour1' AND '$datejour2')  ";
	$requete = @mysql_query($sql) or die($sql."<br>".mysql_error());
	$x = array(); 
	while($value=mysql_fetch_array($requete))
		{
		 array_push( $x,$value[$colone1]);
		}
	
	return $x;
	}
	function boxplotgv($x,$y,$titre,$data)
    {
	sort($data);
	
	$contd=count ($data);
	// for ($i = 0; $i <= $contd-1; $i++) {
	// $this->SetXY(255,$this->GetY()-5);$this->cell(15,5,$data[$i],1,0,'L',1,0); 
    // }
	
	$min=$data[0];
	$q1=$data[round($contd / 4)];
	$mediane=$this->median($data);
	//$mean=round($this->mean($data),2);
	$q3=$data[round($contd * 3 / 4)];
	$max=$data[$contd-1];
	$total=$min+$q1+$q3+$max;                                       
		if($total==0){
		$total=1;
		}
	$a=round($min*100/$total,2);
	$b=round($q1*100/$total,2);
	$c=round($q3*100/$total,2);
	$d=round($max*100/$total,2);
	// $m=round($mean*100/$total,2);
	
	$this->SetFont('Times', 'BIU', 11);
	$this->SetXY($x-15,$y-108-5);$this->Cell(0, 5,$titre ,0, 2, 'L');
	$this->RoundedRect($x-15,$y-108-5, 45, 118, 2, $style = '');
	$this->SetFont('Times', 'B', 11);
	
	$this->SetXY($x-15,$y);$this->cell(10,-5,$min,0,0,'L',0,0);
	$this->SetFillColor(0,0,0);$this->SetXY($x+4.5,$y);$this->cell(5,-1,'',1,0,'C',1,0);
	$this->SetFillColor(0,0,0);$this->SetXY($x+6.5,$y);$this->cell(1,-$a,'',1,0,'C',1,0);
	$this->SetFillColor(224,255,255);$this->SetXY($x,$y-$a);$this->cell(15,-$b,'',1,0,'C',1,0);
	$this->SetFillColor(224,255,255);$this->SetXY($x,$y-$a-$b);$this->cell(15,-$c,'',1,0,'C',1,0);
	$this->SetFillColor(255,64,64);$this->SetXY($x,$y-$a-$b);$this->cell(15,-1,'',1,0,'C',1,0);
	
	$this->SetFillColor(230);$this->SetXY($x-15,$y-$a-$b+2.5);$this->cell(10,-5,$mediane,0,0,'L',0,0);
	$this->SetFillColor(0,0,0);$this->SetXY($x+6.5,$y-$a-$b-$c);$this->cell(1,-$d,'',1,0,'C',1,0);
	$this->SetFillColor(0,0,0);$this->SetXY($x+4.5,$y-$a-$b-$c-$d);$this->cell(5,-1,'',1,0,'C',1,0);
	$this->SetFillColor(230);$this->SetXY($x-15,$y-$a-$b-$c-$d);$this->cell(10,-5,$max,0,0,'L',0,0);
	
	$this->SetFillColor(230);
	$this->SetTextColor(0,0,0);//text noire
	$this->SetFont('Times', 'B', 11);
	}
	
	function T2F20STAT($colone1,$datejour1,$datejour2,$titre)
    {
	$d=$this->STAT($colone1,$datejour1,$datejour2);
	$this->SetXY(125,42);  
	$this->SetXY(125,$this->GetY()+120);$this->cell(45,5,'IC 95% Mean',1,0,'L',1,0);
	$this->SetXY(125,$this->GetY()+5);$this->cell(10,5,round(array_sum($d)/count($d),2)-round(1.96*($this->sd($d)/count($d)),2),1,0,'C',1,0);$this->cell(25,5,round(array_sum($d)/count($d),2),1,0,'C',1,0);
	$this->cell(10,5,round(array_sum($d)/count($d),2)+round(1.96*($this->sd($d)/count($d)),2),1,0,'C',1,0);
 
    $this->SetXY(180,$this->GetY()-5);$this->cell(15,5,'Mean',1,0,'L',1,0);      $this->cell(20,5,round($this->mean($d),2),1,0,'L',1,0);
    $this->SetXY(217.5,$this->GetY());$this->cell(15,5,'Mode',1,0,'L',1,0);      $this->cell(20,5,implode(" ",$this->mode($d)),1,0,'L',1,0);
    $this->SetXY(255,$this->GetY());$this->cell(15,5,'median',1,0,'L',1,0);      $this->cell(20,5,round($this->median($d),2),1,0,'L',1,0);
   
    $this->SetXY(180,$this->GetY()+5);$this->cell(15,5,'var(n-1)',1,0,'L',1,0);  $this->cell(20,5,round($this->variance($d),2),1,0,'L',1,0);
    $this->SetXY(217.5,$this->GetY());$this->cell(15,5,'std(n-1)',1,0,'L',1,0);  $this->cell(20,5,round($this->sd($d),2),1,0,'L',1,0);
    $this->SetXY(255,$this->GetY());$this->cell(15,5,'cv',1,0,'L',1,0);          $this->cell(20,5,round($this->cv($d),2),1,0,'L',1,0);
   
    $this->boxplotgv(140,155,'boxplot:'.$titre,$d);
	}
	
	function pyramide($x,$y,$titre,$pyramide)
    {
	$ta1M=$pyramide['1M'];$ta1F=$pyramide['1F'];
	$ta2M=$pyramide['2M'];$ta2F=$pyramide['2F'];
	$ta3M=$pyramide['3M'];$ta3F=$pyramide['3F'];
	$ta4M=$pyramide['4M'];$ta4F=$pyramide['4F'];
	$ta5M=$pyramide['5M'];$ta5F=$pyramide['5F'];
	$ta6M=$pyramide['6M'];$ta6F=$pyramide['6F'];
	$ta7M=$pyramide['7M'];$ta7F=$pyramide['7F'];
	$ta8M=$pyramide['8M'];$ta8F=$pyramide['8F'];
	$ta9M=$pyramide['9M'];$ta9F=$pyramide['9F'];
	$ta10M=$pyramide['10M'];$ta10F=$pyramide['10F'];
	$ta11M=$pyramide['11M'];$ta11F=$pyramide['11F'];
	$ta12M=$pyramide['12M'];$ta12F=$pyramide['12F'];
	$ta13M=$pyramide['13M'];$ta13F=$pyramide['13F'];
	$ta14M=$pyramide['14M'];$ta14F=$pyramide['14F'];
	$ta15M=$pyramide['15M'];$ta15F=$pyramide['15F'];
	$ta16M=$pyramide['16M'];$ta16F=$pyramide['16F'];
	$ta17M=$pyramide['17M'];$ta17F=$pyramide['17F'];
	$ta18M=$pyramide['18M'];$ta18F=$pyramide['18F'];
	$ta19M=$pyramide['19M'];$ta19F=$pyramide['19F'];
	$ta20M=$pyramide['20M'];$ta20F=$pyramide['20F'];
	
	$totalm=$ta1M+$ta2M+$ta3M+$ta4M+$ta5M+$ta6M+$ta7M+$ta8M+$ta9M+$ta10M+$ta11M+$ta12M+$ta13M+$ta14M+$ta15M+$ta16M+$ta17M+$ta18M+$ta19M+$ta20M;                                       
	$totalf=$ta1F+$ta2F+$ta3F+$ta4F+$ta5F+$ta6F+$ta7F+$ta8F+$ta9F+$ta10F+$ta11F+$ta12F+$ta13F+$ta14F+$ta15F+$ta16F+$ta17F+$ta18F+$ta19F+$ta20F;
	if($totalm==0){
	$totalm=1;
	}
	if($totalf==0){
	$totalf=1;
	}
	$pta1M=round($ta1M*100/$totalm,2);$pta1F=round($ta1F*100/$totalf,2);
	$pta2M=round($ta2M*100/$totalm,2);$pta2F=round($ta2F*100/$totalf,2);
	$pta3M=round($ta3M*100/$totalm,2);$pta3F=round($ta3F*100/$totalf,2);
	$pta4M=round($ta4M*100/$totalm,2);$pta4F=round($ta4F*100/$totalf,2);
	$pta5M=round($ta5M*100/$totalm,2);$pta5F=round($ta5F*100/$totalf,2);
	$pta6M=round($ta6M*100/$totalm,2);$pta6F=round($ta6F*100/$totalf,2);
	$pta7M=round($ta7M*100/$totalm,2);$pta7F=round($ta7F*100/$totalf,2);
	$pta8M=round($ta8M*100/$totalm,2);$pta8F=round($ta8F*100/$totalf,2);
	$pta9M=round($ta9M*100/$totalm,2);$pta9F=round($ta9F*100/$totalf,2);
	$pta10M=round($ta10M*100/$totalm,2);$pta10F=round($ta10F*100/$totalf,2);
	$pta11M=round($ta11M*100/$totalm,2);$pta11F=round($ta11F*100/$totalf,2);
	$pta12M=round($ta12M*100/$totalm,2);$pta12F=round($ta12F*100/$totalf,2);
	$pta13M=round($ta13M*100/$totalm,2);$pta13F=round($ta13F*100/$totalf,2);
	$pta14M=round($ta14M*100/$totalm,2);$pta14F=round($ta14F*100/$totalf,2);
	$pta15M=round($ta15M*100/$totalm,2);$pta15F=round($ta15F*100/$totalf,2);
	$pta16M=round($ta16M*100/$totalm,2);$pta16F=round($ta16F*100/$totalf,2);
	$pta17M=round($ta17M*100/$totalm,2);$pta17F=round($ta17F*100/$totalf,2);
	$pta18M=round($ta18M*100/$totalm,2);$pta18F=round($ta18F*100/$totalf,2);
	$pta19M=round($ta19M*100/$totalm,2);$pta19F=round($ta19F*100/$totalf,2);
	$pta20M=round($ta20M*100/$totalm,2);$pta20F=round($ta20F*100/$totalf,2);
	
	$this->SetFont('Times', 'BIU', 11);
	$this->SetXY($x-20,$y-108);$this->Cell(0, 5,$titre ,0, 2, 'L');
	$this->RoundedRect($x-20,$y-108, 110, 118, 2, $style = '');
	$this->SetFont('Times', 'B', 11);
	// $this->SetXY($x-20,$y);$this->cell(2.5,-100,'***',1,0,'L',1,0);
	$this->SetXY($x+4.5-20,$y-100);$this->cell(20,5,'Masculin',1,0,'C',1,0);$this->SetXY($x+65,$y-100);$this->cell(20,5,'Feminin',1,0,'C',1,0);
	
	$this->SetXY($x+24.5,$y);$this->cell(10,5,'20',1,0,'L',1,0);$this->SetXY($x+35,$y);$this->cell(10,5,'20',1,0,'R',1,0);
	$this->SetXY($x+14.5,$y);$this->cell(10,5,'40',1,0,'L',1,0);$this->SetXY($x+45,$y);$this->cell(10,5,'40',1,0,'R',1,0);
	$this->SetXY($x+4.5,$y);$this->cell(10,5,'60',1,0,'L',1,0);$this->SetXY($x+55,$y);$this->cell(10,5,'60',1,0,'R',1,0);
	$this->SetXY($x+4.5-10,$y);$this->cell(10,5,'80',1,0,'L',1,0);$this->SetXY($x+65,$y);$this->cell(10,5,'80',1,0,'R',1,0);
	$this->SetXY($x+4.5-20,$y);$this->cell(10,5,'100',1,0,'L',1,0);$this->SetXY($x+75,$y);$this->cell(10,5,'100',1,0,'R',1,0);
	
	$this->SetFillColor(120,120,255);$w0=$pta1M;$this->SetXY( ($x+268.5-$w0)/2,$y-5);$this->cell(($w0+1)/2,5,$ta1M,1,0,'R',1,0);$this->SetFillColor(255,120,120);$w1=$pta1F;$this->SetXY($x+35,$y-5);$this->cell(($w1+1)/2,5,$ta1F,1,0,'L',1,0);
	$this->SetFillColor(120,120,255);$w0=$pta2M;$this->SetXY( ($x+268.5-$w0)/2,$y-10);$this->cell(($w0+1)/2,5,$ta2M,1,0,'R',1,0);$this->SetFillColor(255,120,120);$w1=$pta2F;$this->SetXY($x+35,$y-10);$this->cell(($w1+1)/2,5,$ta2F,1,0,'L',1,0);
	$this->SetFillColor(120,120,255);$w0=$pta3M;$this->SetXY( ($x+268.5-$w0)/2,$y-15);$this->cell(($w0+1)/2,5,$ta3M,1,0,'R',1,0);$this->SetFillColor(255,120,120);$w1=$pta3F;$this->SetXY($x+35,$y-15);$this->cell(($w1+1)/2,5,$ta3F,1,0,'L',1,0);
	$this->SetFillColor(120,120,255);$w0=$pta4M;$this->SetXY( ($x+268.5-$w0)/2,$y-20);$this->cell(($w0+1)/2,5,$ta4M,1,0,'R',1,0);$this->SetFillColor(255,120,120);$w1=$pta4F;$this->SetXY($x+35,$y-20);$this->cell(($w1+1)/2,5,$ta4F,1,0,'L',1,0);
	$this->SetFillColor(120,120,255);$w0=$pta5M;$this->SetXY( ($x+268.5-$w0)/2,$y-25);$this->cell(($w0+1)/2,5,$ta5M,1,0,'R',1,0);$this->SetFillColor(255,120,120);$w1=$pta5F;$this->SetXY($x+35,$y-25);$this->cell(($w1+1)/2,5,$ta5F,1,0,'L',1,0);
	$this->SetFillColor(120,120,255);$w0=$pta6M;$this->SetXY( ($x+268.5-$w0)/2,$y-30);$this->cell(($w0+1)/2,5,$ta6M,1,0,'R',1,0);$this->SetFillColor(255,120,120);$w1=$pta6F;$this->SetXY($x+35,$y-30);$this->cell(($w1+1)/2,5,$ta6F,1,0,'L',1,0);
	$this->SetFillColor(120,120,255);$w0=$pta7M;$this->SetXY( ($x+268.5-$w0)/2,$y-35);$this->cell(($w0+1)/2,5,$ta7M,1,0,'R',1,0);$this->SetFillColor(255,120,120);$w1=$pta7F;$this->SetXY($x+35,$y-35);$this->cell(($w1+1)/2,5,$ta7F,1,0,'L',1,0);
	$this->SetFillColor(120,120,255);$w0=$pta8M;$this->SetXY( ($x+268.5-$w0)/2,$y-40);$this->cell(($w0+1)/2,5,$ta8M,1,0,'R',1,0);$this->SetFillColor(255,120,120);$w1=$pta8F;$this->SetXY($x+35,$y-40);$this->cell(($w1+1)/2,5,$ta8F,1,0,'L',1,0);
	$this->SetFillColor(120,120,255);$w0=$pta9M;$this->SetXY( ($x+268.5-$w0)/2,$y-45);$this->cell(($w0+1)/2,5,$ta9M,1,0,'R',1,0);$this->SetFillColor(255,120,120);$w1=$pta9F;$this->SetXY($x+35,$y-45);$this->cell(($w1+1)/2,5,$ta9F,1,0,'L',1,0);
	$this->SetFillColor(120,120,255);$w0=$pta10M;$this->SetXY( ($x+268.5-$w0)/2,$y-50);$this->cell(($w0+1)/2,5,$ta10M,1,0,'R',1,0);$this->SetFillColor(255,120,120);$w1=$pta10F;$this->SetXY($x+35,$y-50);$this->cell(($w1+1)/2,5,$ta10F,1,0,'L',1,0);
	$this->SetFillColor(120,120,255);$w0=$pta11M;$this->SetXY( ($x+268.5-$w0)/2,$y-55);$this->cell(($w0+1)/2,5,$ta11M,1,0,'R',1,0);$this->SetFillColor(255,120,120);$w1=$pta11F;$this->SetXY($x+35,$y-55);$this->cell(($w1+1)/2,5,$ta11F,1,0,'L',1,0);
	$this->SetFillColor(120,120,255);$w0=$pta12M;$this->SetXY( ($x+268.5-$w0)/2,$y-60);$this->cell(($w0+1)/2,5,$ta12M,1,0,'R',1,0);$this->SetFillColor(255,120,120);$w1=$pta12F;$this->SetXY($x+35,$y-60);$this->cell(($w1+1)/2,5,$ta12F,1,0,'L',1,0);
	$this->SetFillColor(120,120,255);$w0=$pta13M;$this->SetXY( ($x+268.5-$w0)/2,$y-65);$this->cell(($w0+1)/2,5,$ta13M,1,0,'R',1,0);$this->SetFillColor(255,120,120);$w1=$pta13F;$this->SetXY($x+35,$y-65);$this->cell(($w1+1)/2,5,$ta13F,1,0,'L',1,0);
	$this->SetFillColor(120,120,255);$w0=$pta14M;$this->SetXY( ($x+268.5-$w0)/2,$y-70);$this->cell(($w0+1)/2,5,$ta14M,1,0,'R',1,0);$this->SetFillColor(255,120,120);$w1=$pta14F;$this->SetXY($x+35,$y-70);$this->cell(($w1+1)/2,5,$ta14F,1,0,'L',1,0);
	$this->SetFillColor(120,120,255);$w0=$pta15M;$this->SetXY( ($x+268.5-$w0)/2,$y-75);$this->cell(($w0+1)/2,5,$ta15M,1,0,'R',1,0);$this->SetFillColor(255,120,120);$w1=$pta15F;$this->SetXY($x+35,$y-75);$this->cell(($w1+1)/2,5,$ta15F,1,0,'L',1,0);
	$this->SetFillColor(120,120,255);$w0=$pta16M;$this->SetXY( ($x+268.5-$w0)/2,$y-80);$this->cell(($w0+1)/2,5,$ta16M,1,0,'R',1,0);$this->SetFillColor(255,120,120);$w1=$pta16F;$this->SetXY($x+35,$y-80);$this->cell(($w1+1)/2,5,$ta16F,1,0,'L',1,0);
	$this->SetFillColor(120,120,255);$w0=$pta17M;$this->SetXY( ($x+268.5-$w0)/2,$y-85);$this->cell(($w0+1)/2,5,$ta17M,1,0,'R',1,0);$this->SetFillColor(255,120,120);$w1=$pta17F;$this->SetXY($x+35,$y-85);$this->cell(($w1+1)/2,5,$ta17F,1,0,'L',1,0);
	$this->SetFillColor(120,120,255);$w0=$pta18M;$this->SetXY( ($x+268.5-$w0)/2,$y-90);$this->cell(($w0+1)/2,5,$ta18M,1,0,'R',1,0);$this->SetFillColor(255,120,120);$w1=$pta18F;$this->SetXY($x+35,$y-90);$this->cell(($w1+1)/2,5,$ta18F,1,0,'L',1,0);
	$this->SetFillColor(120,120,255);$w0=$pta19M;$this->SetXY( ($x+268.5-$w0)/2,$y-95);$this->cell(($w0+1)/2,5,$ta19M,1,0,'R',1,0);$this->SetFillColor(255,120,120);$w1=$pta19F;$this->SetXY($x+35,$y-95);$this->cell(($w1+1)/2,5,$ta19F,1,0,'L',1,0);
	$this->SetFillColor(120,120,255);$w0=$pta20M;$this->SetXY( ($x+268.5-$w0)/2,$y-100);$this->cell(($w0+1)/2,5,$ta20M,1,0,'R',1,0);$this->SetFillColor(255,120,120);$w1=$pta20F;$this->SetXY($x+35,$y-100);$this->cell(($w1+1)/2,5,$ta20F,1,0,'L',1,0);
	$this->SetFillColor(230);//fond gris il faut ajouter au cell un autre parametre pour qui accepte la coloration
	$this->SetTextColor(0,0,0);//text noire
	}
	
	function dureehospitalisation($titre,$datejour1,$datejour2,$valeurs) 
	{    
		$this->SetFont('Times', 'B', 10);
		$this->SetXY(5,25);$this->cell(200,5,$titre,1,0,'C',1,0);
		$this->SetXY(5,35+7);
		$this->cell(40,5,"DUREE SEJOUR",1,0,'L',1,0);
	    $this->cell(20,5,"DECES",1,0,'C',1,0);
		$this->cell(45,5,"TX MORTALITE",1,0,'C',1,0);
		$this->SetXY(5,40+7);
		$IDWIL=17000;
		$ANNEE='2016';
		$this->mysqlconnect();
		$req="SELECT * FROM deceshosp where  DINS BETWEEN '$datejour1' AND '$datejour2' ";
		$query1 = mysql_query($req);   
		$totalmbr11=mysql_num_rows($query1);
		
		$query="SELECT $valeurs,count($valeurs)as nbr FROM deceshosp where DINS BETWEEN '$datejour1' AND '$datejour2' GROUP BY $valeurs  order by $valeurs asc "; //    % %will search form 0-9,a-z            
		$resultat=mysql_query($query);
		$totalmbr1=mysql_num_rows($resultat);
		while($row=mysql_fetch_object($resultat))
		{
			$this->SetFont('Times', '', 10);
		
			$this->cell(40,4,trim($row->$valeurs),1,0,'L',0);
			$this->cell(20,4,trim($row->nbr),1,0,'C',0);
			$this->cell(45,4,round(($row->nbr*100)/$totalmbr11,2).' %',1,0,'C',0);
			$this->SetXY(5,$this->GetY()+4); 
		}
		$this->SetXY(5,$this->GetY());  
		$this->cell(40,5,"Total ".$totalmbr1." : DUREE",1,0,'L',1,0);	  
		$this->cell(20,5,$totalmbr11,1,0,'C',1,0);	  
		$this->cell(45,5,'100%',1,0,'C',1,0);  
	}
	
	
	
	function neonat($x,$y,$age,$val,$val1,$titre,$datejour1,$datejour2) 
	{    
		$this->SetFont('Times', 'B', 10);
		$this->SetXY(5,25);$this->cell(285,5,$titre.$age,1,0,'C',1,0);
		$this->SetXY($x,$y);
		$this->cell(20,5,"Age:".$age,1,0,'C',1,0);
	    $this->cell(20,5,"N",1,0,'C',1,0);
		$this->cell(20,5,"P%",1,0,'C',1,0);
		$this->SetXY($x,$y+5);
		$IDWIL=17000;
		$ANNEE='2016';
		$this->mysqlconnect();
		$req="SELECT * FROM deceshosp  where ($age BETWEEN $val and $val1)  and  (DINS BETWEEN '$datejour1' AND '$datejour2')";
		$query1 = mysql_query($req);   
		$totalmbr11=mysql_num_rows($query1);
		$query="SELECT $age,count($age)as nbr FROM deceshosp where ($age BETWEEN $val and $val1)  and  (DINS BETWEEN '$datejour1' AND '$datejour2') GROUP BY $age  order by $age asc "; //    % %will search form 0-9,a-z            
		$resultat=mysql_query($query);
		$totalmbr1=mysql_num_rows($resultat);
		while($row=mysql_fetch_object($resultat))
		{
			$this->SetFont('Times', '', 10);
			$this->cell(20,4,trim($row->$age),1,0,'C',0);
			$this->cell(20,4,trim($row->nbr),1,0,'C',0);
			$this->cell(20,4,round(($row->nbr*100)/$totalmbr11,2).' %',1,0,'C',0);
			$this->SetXY($x,$this->GetY()+4); 
		}
		$this->SetXY($x,$this->GetY());$this->cell(20,5,"Total",1,0,'C',1,0);	  
		$this->cell(20,5,$totalmbr11,1,0,'C',1,0);	  
		$this->cell(20,5,'100%',1,0,'C',1,0);  
	}
	
	function neonat1($age,$val,$val1,$titre,$datejour1,$datejour2) 
	{    
		$this->SetFont('Times', 'B', 10);
		$this->SetXY(5,25);$this->cell(285,5,$titre.$age,1,0,'C',1,0);
		$this->SetXY(5,35);
		$this->cell(20,5,"Age:".$age,1,0,'C',1,0);
	    $this->cell(20,5,"N",1,0,'C',1,0);
		$this->cell(20,5,"P%",1,0,'C',1,0);
		$this->SetXY(5,40);
		$IDWIL=17000;
		$ANNEE='2016';
		$this->mysqlconnect();
		$req="SELECT * FROM deceshosp  where  (DINS BETWEEN '$datejour1' AND '$datejour2')";
		$query1 = mysql_query($req);   
		$totalmbr11=mysql_num_rows($query1);
		$query="SELECT $age,count($age)as nbr FROM deceshosp where   (DINS BETWEEN '$datejour1' AND '$datejour2') GROUP BY $age  order by $age asc "; //    % %will search form 0-9,a-z            
		$resultat=mysql_query($query);
		$totalmbr1=mysql_num_rows($resultat);
		while($row=mysql_fetch_object($resultat))
		{
			$this->SetFont('Times', '', 10);
			$this->cell(20,4,trim($row->$age),1,0,'C',0);
			$this->cell(20,4,trim($row->nbr),1,0,'C',0);
			$this->cell(20,4,round(($row->nbr*100)/$totalmbr11,2).' %',1,0,'C',0);
			$this->SetXY(5,$this->GetY()+4); 
		}
		$this->SetXY(5,$this->GetY());$this->cell(20,5,"Total",1,0,'C',1,0);	  
		$this->cell(20,5,$totalmbr11,1,0,'C',1,0);	  
		$this->cell(20,5,'100%',1,0,'C',1,0);  
	}
	
	function pie2($data)
    {
	$xc=$data['x'];
	$yc=$data['y'];
	$r=$data['r'];
	if ($data['v1']+$data['v2'] > 0){$tot=$data['v1']+$data['v2'];}else {$tot=1;}
	$p1=round($data['v1']*100/$tot,2);
	$p2=round($data['v2']*100/$tot,2);
	$a1=$p1*3.6;
	$a2=$a1+($p2*3.6);
	$this->SetFont('Times', 'BIU', 11);
	$this->SetXY($xc-20,$yc-25);$this->Cell(0, 5,$data['t0'] ,0, 2, 'L');
	$this->RoundedRect($xc-20,$yc-25, 90, 45, 2, $style = '');
	$this->SetFont('Times', 'B', 11);
	$this->SetFillColor(120,120,255);$this->Sector($xc,$yc,$r,0,$a1);
	$this->SetXY($xc+25,$yc-15);$this->cell(10,5,'',1,0,'C',1,0);$this->cell(10,5,$data['t1'],1,0,'C',0,0);$this->cell(20,5,$p1.'%',1,0,'C',0,0);
	$this->SetFillColor(120,255,120);$this->Sector($xc,$yc,$r,$a1,$a2);
	$this->SetXY($xc+25,$yc-5);$this->cell(10,5,'',1,0,'C',1,0);$this->cell(10,5,$data['t2'],1,0,'C',0,0);$this->cell(20,5,$p2.'%',1,0,'C',0,0);
	$this->SetFillColor(230);//fond gris il faut ajouter au cell un autre parametre pour qui accepte la coloration
	$this->SetTextColor(0,0,0);//text noire
	$this->SetFont('Times', 'B', 11);
	}
	
	function bar($x,$y,$a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$titre)
    {
	if ($a+$b+$c+$d+$e+$f+$g+$h+$i+$j > 0){$total=$a+$b+$c+$d+$e+$f+$g+$h+$i+$j;}else {$total=1;}
	$ap=round($a*100/$total,2);
	$bp=round($b*100/$total,2);
	$cp=round($c*100/$total,2);
	$dp=round($d*100/$total,2);
	$ep=round($e*100/$total,2);
	$fp=round($f*100/$total,2);
	$gp=round($g*100/$total,2);
	$hp=round($h*100/$total,2);
	$ip=round($i*100/$total,2);
	$jp=round($j*100/$total,2);
	$this->SetFont('Times', 'BIU', 11);
	$this->SetXY($x-20,$y-108);$this->Cell(0, 5,$titre ,0, 2, 'L');
	$this->RoundedRect($x-20,$y-108, 90, 130, 2, $style = '');
	$this->SetFont('Times', 'B',08);$this->SetFillColor(120,255,120);
	
	$w=9;
	$this->SetXY($x-20,$y+10);   
	$this->cell($w,-$ap,$ap,1,0,'C',1,0);        
	$this->cell($w,-$bp,$bp,1,0,'C',1,0);
	$this->cell($w,-$cp,$cp,1,0,'C',1,0);
	$this->cell($w,-$dp,$dp,1,0,'C',1,0);
	$this->cell($w,-$ep,$ep,1,0,'C',1,0);
	$this->cell($w,-$fp,$fp,1,0,'C',1,0);
	$this->cell($w,-$gp,$gp,1,0,'C',1,0);
	$this->cell($w,-$hp,$hp,1,0,'C',1,0);
	$this->cell($w,-$ip,$ip,1,0,'C',1,0);
	$this->cell($w,-$jp,$jp,1,0,'C',1,0);
	$this->SetXY($x-20,$y+12);    
	$this->cell($w,5,'00-09',1,0,'C',0,0);
	$this->cell($w,5,'10-19',1,0,'C',0,0);
	$this->cell($w,5,'20-29',1,0,'C',0,0);
	$this->cell($w,5,'30-39',1,0,'C',0,0);
	$this->cell($w,5,'40-49',1,0,'C',0,0);
	$this->cell($w,5,'50-59',1,0,'C',0,0);
	$this->cell($w,5,'60-69',1,0,'C',0,0);
	$this->cell($w,5,'70-79',1,0,'C',0,0);
	$this->cell($w,5,'80-89',1,0,'C',0,0);
	$this->cell($w,5,'90-99',1,0,'C',0,0);
	$this->SetFillColor(230);//fond gris il faut ajouter au cell un autre parametre pour qui accepte la coloration
	$this->SetTextColor(0,0,0);//text noire
	$this->SetFont('Times', 'B', 11);
	}
	
}	