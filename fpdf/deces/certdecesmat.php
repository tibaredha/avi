<?php
require('deces.php');
$pdf = new deces();$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->setSourceFile('certdecesmat1.pdf');
$tplIdx = $pdf->importPage(32);
$pdf->useTemplate($tplIdx, 5, 5, 200);
$pdf->SetFont('Arial','B',9);
$ID=$_GET["uc"];
$pdf->mysqlconnect();
$query = "SELECT * FROM deceshosp where id='".$ID."'  ";
$resultat=mysql_query($query);
$pdf->SetFont('Arial','B',10);
while($row=mysql_fetch_object($resultat))
{	
	//partie administrative***//
	$pdf->SetFont('Arial','B',08);
	$pdf->SetXY(48,22);$pdf->Write(0,'REPUBLIQUE ALGERIENNE DEMOCRATIQUE ET POPULAIRE');
	$pdf->SetXY(28,27);$pdf->Write(0,'MINISTERE DE LA SANTE, DE LA POPULATION ET DE LA REFORME HOSPITALIERE');
	// $pdf->SetXY(28,27);$pdf->Write(0,'DIRECTION DE LA SANTE ETDE LA POPULATIONDE DE LA WILAYA DE DJELFA');
	$pdf->SetXY(64,35.5);$pdf->Write(0,'ETABLISSEMENT DE SANTE : '.$pdf->nbrtostring('structure','id',intval(trim($row->STRUCTURED)),'structure'));
	$pdf->SetFont('Arial','B',10);
	$pdf->SetTextColor(255,0,0);
	$pdf->SetXY(36,46);$pdf->Write(0,"Djelfa");
	$pdf->SetXY(45,46+7);$pdf->Write(0,$row->NOM);$pdf->SetXY(127,46+7);$pdf->Write(0,$row->NOM);
	$pdf->SetXY(32,46+14);$pdf->Write(0,$row->PRENOM);
	$pdf->SetXY(46,46+21.5);$pdf->Write(0,$pdf->dateUS2FR($row->DATENAISSANCE));
	$pdf->SetXY(73,46+28);$pdf->Write(0,$row->ADRESSE.'_'.html_entity_decode(utf8_decode($pdf->nbrtostring('com','IDCOM',$row->COMMUNER,'COMMUNE'))));
    //LIEU DU DECES
	switch($row->LD)  
		{
			case 'DOM':
				{
				$pdf->SetXY(76,91.5);$pdf->Write(0,'X');
				break;
				}
			case 'VP':
				{
				//$pdf->SetXY(65.8,96.7+4);$pdf->Write(0,"X");
				break;
				}
			case 'AAP':
				{
				///$pdf->SetXY(21.8,96.7+8);$pdf->Write(0,"X");// $pdf->SetXY(49.8,96.7+8);$pdf->Write(0,$row->AUTRES);
				break;
				}
			case 'SSP':
				{
				$pdf->SetXY(76.8,111.5);$pdf->Write(0,'X');
				$pdf->SetXY(76.8+20,111.5);$pdf->Write(0,$pdf->nbrtostring('structure','id',intval(trim($row->STRUCTURED)),'structure'));//
				if (intval(trim($row->STRUCTURED))=='1') {$pdf->SetXY(93,128.5);$pdf->Write(0,'X');} 
				if (intval(trim($row->STRUCTURED))=='2') {$pdf->SetXY(93,128.5);$pdf->Write(0,'X');} 
				if (intval(trim($row->STRUCTURED))=='3') {$pdf->SetXY(93,128.5);$pdf->Write(0,'X');} 
				if (intval(trim($row->STRUCTURED))=='4') {$pdf->SetXY(93,128.5);$pdf->Write(0,'X');} 
				if (intval(trim($row->STRUCTURED))=='5') {$pdf->SetXY(93,124.5);$pdf->Write(0,'X');} 
				if (intval(trim($row->STRUCTURED))=='6') {$pdf->SetXY(93,128.5);$pdf->Write(0,'X');} 
				if (intval(trim($row->STRUCTURED))=='7') {$pdf->SetXY(159,129.5);$pdf->Write(0,'X');$pdf->SetXY(70+20,135);$pdf->Write(0,nbrtostring('structure','id',intval(trim($row->STRUCTURED)),'structure'));} 
				if (intval(trim($row->STRUCTURED))=='8') {$pdf->SetXY(159,129.5);$pdf->Write(0,'X');$pdf->SetXY(70+20,135);$pdf->Write(0,nbrtostring('structure','id',intval(trim($row->STRUCTURED)),'structure'));} 
				if (intval(trim($row->STRUCTURED))=='9') {$pdf->SetXY(159,129.5);$pdf->Write(0,'X');$pdf->SetXY(70+20,135);$pdf->Write(0,nbrtostring('structure','id',intval(trim($row->STRUCTURED)),'structure'));} 
				if (intval(trim($row->STRUCTURED))=='10') {$pdf->SetXY(159,129.5);$pdf->Write(0,'X');$pdf->SetXY(70+20,135);$pdf->Write(0,nbrtostring('structure','id',intval(trim($row->STRUCTURED)),'structure'));} 
				if (intval(trim($row->STRUCTURED))=='11') {$pdf->SetXY(159,129.5);$pdf->Write(0,'X');$pdf->SetXY(70+20,135);$pdf->Write(0,nbrtostring('structure','id',intval(trim($row->STRUCTURED)),'structure'));} 
				break;
				}
			case 'SSPV':
				{
				$pdf->SetXY(76,98.2);$pdf->Write(0,'X');
				break;
				}		
		}
		
	$pdf->SetXY(60,111.5+24+6);$pdf->Write(0,html_entity_decode(utf8_decode($pdf->nbrtostring('servicedeces','id',intval(trim($row->SERVICEHOSPIT)),'service'))));	
	$pdf->SetXY(66,123+33.5);$pdf->Write(0,$pdf->dateUS2FR($row->DATEHOSPI));$pdf->SetXY(125,123+33.5);$pdf->Write(0,$row->HEURESHOSPI);
	$pdf->SetXY(56,130+33.5);$pdf->Write(0,$pdf->dateUS2FR($row->DINS));$pdf->SetXY(125,130+33.5);$pdf->Write(0,$row->HINS);  
	//Moment du décès
	if ($row->DECEMAT=='1')
	{
	switch($row->GRS)          
		{
			case 'DGRO':
				{
				$pdf->SetXY(94,178);$pdf->Write(0,"X");
				break;
				}
			case 'DACC':
				{
				$pdf->SetXY(94,178+4.7);$pdf->Write(0,"X");
				break;
				}
			case 'DAVO':
				{
				$pdf->SetXY(94,178+13.5);$pdf->Write(0,"X");
				break;
				}
			case 'AGESTATION':
				{
				$pdf->SetXY(94,178+17.5);$pdf->Write(0,"X");
				break;
				}
			case 'IDETER':
				{
				// $pdf->SetXY(109,142+4.5);$pdf->Write(0,"X");
				break;
				}		
		}
	}
	else
	{
	////$pdf->SetXY(176,136.7+58.5);$pdf->Write(0,"X");
	}

// if ($row->CODECIM=='1119')
	// {
// $pdf->SetXY(146,208);$pdf->Write(0,"X");	
	// }
// if ($row->CODECIM=='1083')
	// {
// $pdf->SetXY(146,208+5);$pdf->Write(0,"X");	
	// }
// if ($row->CODECIM=='1')
	// {
// $pdf->SetXY(146,208+10);$pdf->Write(0,"X");	
	// }
// if ($row->CODECIM=='1')
	// {
// $pdf->SetXY(146,208+14);$pdf->Write(0,"X");	
	// }
// if ($row->CODECIM=='1')
	// {
// $pdf->SetXY(146,208+19);$pdf->Write(0,"X");	
	// }
// if ($row->CODECIM=='1')
	// {
// $pdf->SetXY(146,208+23);$pdf->Write(0,"X");	
	// }	
$pdf->SetXY(28,244.5);$pdf->Write(0,$pdf->dateUS2FR($row->DINS));$pdf->SetXY(100,244.5);$pdf->Write(0,html_entity_decode(utf8_decode($pdf->nbrtostring('com','IDCOM',$row->COMMUNED,'COMMUNE'))));$pdf->SetXY(93+62,244.5);$pdf->Write(0,$row->USER);
// if($row->SEX=='M' or $row->DECEMAT=='0')
// {
// header('location: ../deces/LDECES/');
// }

$pdf->Output();
}

?>