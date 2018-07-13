<?php

require('../TCPDF.php');

class deces extends TCPDF
{ 
     public $nomprenom ="tibaredha";
	 public $db_host="localhost";
	 public $db_name="framework"; 
     public $db_user="root";
     public $db_pass="";
	 public $utf8 = "" ;
	
	public $repar="الجمـهوريـــة الجزائرية الديمقراطية الشعبيــــــــة";
	public $repfr="République algérienne démocratique et populaire";
	public $mspar="وزارة الصحــــــــة و السكـــــــــان وإصلاح المستشــــــفيات";
	public $mspfr="Ministère de la sante de la population et de la réforme hospitalière";
	public $dspfr="Direction de la sante et de la population de la wilaya de Djelfa";
	public $dspar="مـديريــــــة الصحــــة و الســـــكان لولايـــــة الجلفــــــة";

	
	
	
	
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
	
	function dateFR2US($date)//01/01/2013
	{
	$J      = substr($date,0,2);
    $M      = substr($date,3,2);
    $A      = substr($date,6,4);
	$dateFR2US =  $A."-".$M."-".$J ;
    return $dateFR2US;//2013-01-01
	}
	
    function dateUS2FR($date)//2013-01-01
    {
	$J      = substr($date,8,2);
    $M      = substr($date,5,2);
    $A      = substr($date,0,4);
	$dateUS2FR =  $J."/".$M."/".$A ;
    return $dateUS2FR;//01/01/2013
    }	
	
	function nbrtostring($tb_name,$colonename,$colonevalue,$resultatstring) 
	{
	if (is_numeric($colonevalue) and $colonevalue!=='0') 
	{ 
	$this->mysqlconnect();
	$result = mysql_query("SELECT * FROM $tb_name where $colonename=$colonevalue" );
	$row=mysql_fetch_object($result);
	$resultat=$row->$resultatstring;
	return $resultat;
	} 
	return $resultat2='??????';
	}
	
	function DATEPV($DATEINS) {
	
		$J      = substr($DATEINS,8,2);                  
		$M      = substr($DATEINS,5,2);
		$A      = substr($DATEINS,2,2); 
		//transformer une date donne en lettre
		$JOURS = array("الاول","الثانى","الثالث","الرابع","الخامس","السادس","السابع","الثامن","التاسع","العاشر","الحادي عشر","الثاني عشر","الثالث عشر"," الرابع عشر  "," الخامس عشر "," السادس عشر "," السابع عشر "," الثامن عشر "," التاسع عشر "," العشرين "," الواحد و العشرين"," الثاني و العشرين "," الثالث و العشرين "," الرابع و العشرين "," الخامس و العشرين "," السادس و العشرين "," السابع و العشرين "," الثامن و العشرين "," التاسع و العشرين "," الثلاثين "," الواحد و الثلاثين ");
	    //$JOURS1 = $JOURS[date("d")-1] ;
		$JOURS1 = $JOURS[$J-1] ;
		$MOIS = array("", "جانفى", "فيفري", "مارس", "افريل", "ماي", "جوان", "جويلية", "اوت", "سبتمبر", "اكتوبر", "نوفمبر", "ديسمبر");
		$MOIS1 =  $MOIS[ $M-0 ] ;
		//$MOIS1 =  $MOIS[date("n")] ;
		$ANNEE = array("ثلاثة عشر  ","أربعة عشر  ","خمسة عشر  ","ستة عشر  ","سبعة عشر  ","ثمانية عشر ","تسعة عشر  ","عشرين");
		//$ANNEE1 =  $ANNEE[date("y")-13] ;
		$ANNEE1 =  $ANNEE[ $A - 13] ;
		$DATEPV="في عـــام الفيــــن و".$ANNEE1."وفي اليـــوم ".$JOURS1." من شهـــر ".$MOIS1;
		
		return $DATEPV;
}


   function arDate() {
		$Jour = array("الاحد", "الاثنين", "الثلثاء", "الاربعاء", "الخميس", "الجمعة", "السبت");
		$Mois = array("", "جانفى", "فيفري", "مارس", "افريل", "ماي", "جوان", "جويلية", "اوت", "سبتمبر", "اكتوبر", "نوفمبر", "ديسمبر");
		$Jour1 = array("الاحد", "الاثنين", "الثلثاء", "الاربعاء", "الخميس", "الجمعة", "السبت");
		$anne1 = array("الاحد", "الاثنين", "الثلثاء", "الاربعاء", "الخميس", "الجمعة", "السبت");
		$datear = $Jour[date("w")] . " " . date("d") . " " . $Mois[date("n")] . " " . date("Y");
		return $datear;
	}
	
	function ANNEEAR($DATEINS) {
		$A      = substr($DATEINS,2,2); 
		$ANNEE = array("ثلاثة عشر  ","أربعة عشر  ","خمسة عشر  ","ستة عشر  ","سبعة عشر  ","ثمانية عشر ","تسعة عشر  ","عشرين");
		$ANNEE1 =  $ANNEE[ $A - 13] ;
		$DATEPV="في عـــام الفيــــن و".$ANNEE1;
		return $DATEPV;
	}
    function JOURAR($DATEINS) {
		$J      = substr($DATEINS,8,2);                  
		$JOURS = array("الاول","الثانى","الثالث","الرابع","الخامس","السادس","السابع","الثامن","التاسع","العاشر","الحادي عشر","الثاني عشر","الثالث عشر"," الرابع عشر  "," الخامس عشر "," السادس عشر "," السابع عشر "," الثامن عشر "," التاسع عشر "," العشرين "," الواحد و العشرين"," الثاني و العشرين "," الثالث و العشرين "," الرابع و العشرين "," الخامس و العشرين "," السادس و العشرين "," السابع و العشرين "," الثامن و العشرين "," التاسع و العشرين "," الثلاثين "," الواحد و الثلاثين ");
		$JOURS1 = $JOURS[$J-1] ;
		$DATEPV="وفي اليـــوم ".$JOURS1;
		return $DATEPV;
	}	
   function MOISAR($DATEINS) {             
		$M      = substr($DATEINS,5,2);
		$MOIS = array("", "جانفى", "فيفري", "مارس", "افريل", "ماي", "جوان", "جويلية", "اوت", "سبتمبر", "اكتوبر", "نوفمبر", "ديسمبر");
		$MOIS1 =  $MOIS[ $M-0 ] ;
		$DATEPV="من شهـــر ".$MOIS1;
		return $DATEPV;
	}		
	
	function HEURSAR($HINS) {
		$H      = substr($HINS,0,2);                  
		if($H>0){
		$HEURS = array("الاول","الثانى","الثالث","الرابع","الخامس","السادس","السابع","الثامن","التاسع","العاشر","الحادي عشر","الثاني عشر","الثالث عشر"," الرابع عشر  "," الخامس عشر "," السادس عشر "," السابع عشر "," الثامن عشر "," التاسع عشر "," العشرين "," الواحد و العشرين"," الثاني و العشرين "," الثالث و العشرين "," الرابع و العشرين ");
		$HEURS1 = $HEURS[$H-1] ;
		return $HEURS1;
		}
		else{
		return $HEURS1='???';
		}	
	}	
	function MINUTEAR($HINS) {
		$M      = substr($HINS,4,2);                  
		if($M>0){
		$MINUTE = array("الاولى","الثانية","الثالثة","الرابعة","الخامسة","السادسة","السابعة","الثامنة","التاسعة","العاشرة","الحادي عشرة","الثاني عشرة","الثالث عشرة"," الرابع عشرة  "," الخامس عشرة "," السادس عشرة "," السابع عشرة "," الثامن عشرة "," التاسع عشرة "," العشرين "," الواحد و العشرين"," الثاني و العشرين "," الثالث و العشرين "," الرابع و العشرين ");
		$MINUTE1 = $MINUTE[$M-1] ;
		return $MINUTE1;
		}
		else{
		return $MINUTE1="???";
		}
	}		
}