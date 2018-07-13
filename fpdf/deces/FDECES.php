<?php
if ($_POST['type']=='2') 
{
header("Location: ../../dashboard/XLS/".$_POST['Datedebut']."/".$_POST['Datefin']."/") ;
}
else 
{
require('deces.php');
$pdf = new deces();$pdf->AliasNbPages();
$STRUCTURED=$_POST["structure"];
$login=$_POST["login"];
$date=date("d-m-y");
if (!ISSET($_POST['Datedebut'])||!ISSET($_POST['Datefin'])){$datejour1 =date("Y-m-d");$datejour2 =date("Y-m-d");}else{if(empty($_POST['Datedebut'])||empty($_POST['Datefin'])){ $datejour1 =date("Y-m-d");$datejour2 =date("Y-m-d");}else{ $datejour1 =$pdf->dateFR2US($_POST['Datedebut']) ;$datejour2 =$pdf->dateFR2US($_POST['Datefin']) ;}}
if ($datejour1>$datejour2 or  $datejour1==$datejour2 ){header("Location: ../../dashboard/Evaluation") ;}

//1eme partie   RELEVE DES CAUSES DE DEDECS
if ($_POST['deces']=='1') 
{
$pdf = new deces( 'L', 'mm', 'A4' );$pdf->AliasNbPages();//importatant pour metre en fonction  le totale nombre de page avec "/{nb}" 
$pdf->SetTitle('Releve Des Causes De Deces '."Du ".$datejour1." Au ".$datejour2);$pdf->SetFillColor(230);
$pdf->SetFillColor(230);//fond gris il faut ajouter au cell un autre parametre pour qui accepte la coloration
$pdf->SetTextColor(0,0,0);//text noire
$pdf->AddPage('L','A4');$pdf->SetFont('Times', 'B', 10);
//stattistic avec kashi class
// $x=$pdf->STAT('Days',$datejour1,$datejour2);
// $pdf->SetXY(5,40);$pdf->cell(50,5,'moyenne : '.$pdf->mean($x, $type="arithmetic"),0,0,'L',1,0);
// $pdf->SetXY(5,45);$pdf->cell(50,5,'median : '.$pdf->median($x),0,0,'L',1,0);
// $pdf->SetXY(5,50);$pdf->cell(50,5,'cv : '.$pdf->cv($x),0,0,'L',1,0);
$pdf->listedeces("=".$STRUCTURED,$datejour1,$datejour2,$login,'I');	
}

//2eme partie   RELEVE DES CAUSES DE DECES+
if ($_POST['deces']=='2') 
{
$pdf = new deces( 'L', 'mm', 'A4' );$pdf->AliasNbPages();//importatant pour metre en fonction  le totale nombre de page avec "/{nb}" 
$pdf->SetTitle('Releve Des Causes De Deces '."Du ".$datejour1." Au ".$datejour2);$pdf->SetFillColor(230);
$pdf->SetFillColor(230);//fond gris il faut ajouter au cell un autre parametre pour qui accepte la coloration
$pdf->SetTextColor(0,0,0);//text noire
$pdf->AddPage('L','A4');$pdf->SetFont('Times', 'B', 10);
$pdf->listedeces("=".$STRUCTURED,$datejour1,$datejour2,$login,'');
}

//3ere partie Mortalite Intra-Hospitaliere
if ($_POST['deces']=='3') 
{
$EPH1='='.$STRUCTURED;
$pdf = new deces( 'P', 'mm', 'A4' );$pdf->AliasNbPages();//important pour metre en fonction  le totale nombre de page avec "/{nb}" 
$pdf->SetTitle('Deces Hospitalier '."Du ".$datejour1." Au ".$datejour2);$pdf->SetFillColor(230);//fond gris il faut ajouter au cell un autre parametre pour qui accepte la coloration
$pdf->SetFont('Times', 'B', 13);//prise encharge du nbr de page // $pdf->SetMargins(0,0,0);$pdf->AliasNbPages();
$pdf->SetTextColor(0,0,0);//text noire$pdf->SetTextColor(0,0,255);



$pdf->AddPage();$pdf->BORDEREAU("BORDEREAU  D'ENVOI",$datejour1,$datejour2,$EPH1,$STRUCTURED); 
$pdf->AddPage();$pdf->PAGEDEGARDE("BORDEREAU  D'ENVOI",$datejour1,$datejour2,$EPH1,$STRUCTURED); 
$pdf->AddPage();$pdf->SetFont( 'Arial', '', 10 );$pdf->servicehospitalisation(html_entity_decode(utf8_decode("I-Distribution des décès par Service D'hospitalisation")),$datejour1,$datejour2,'SERVICEHOSPIT',$EPH1);
$pdf->AddPage();$pdf->SetFont( 'Arial', '', 10 );$pdf->dureehospitalisation1(html_entity_decode(utf8_decode("II-Distribution des décès par Durée D'hospitalisation")),$datejour1,$datejour2,'SERVICEHOSPIT',$EPH1);
$pdf->AddPage();$pdf->SetFont( 'Arial', '', 10 );$pdf->SetXY(5,25);$pdf->cell(200,5,html_entity_decode(utf8_decode("III-Distribution des décès par tranche d'age et sexe (global)")),1,0,'C',1,0);
$pdf->T2F20($pdf->dataagesexe(5,42,'Years','deceshosp','DINS','COMMUNER',$datejour1,$datejour2,$EPH1),$datejour1,$datejour2);
$pdf->AddPage();$pdf->SetFont( 'Arial', '', 10 );$pdf->SetXY(5,25);$pdf->cell(200,5,html_entity_decode(utf8_decode("IV-Distribution des décès par tranche d'age et sexe (pediatrique) ")),1,0,'C',1,0);
$pdf->T2F20PED($pdf->dataagesexeped(5,42,'Days','deceshosp','DINS','COMMUNER',$datejour1,$datejour2,$EPH1),$datejour1,$datejour2);
$pdf->AddPage();$pdf->SetFont( 'Arial', '', 10 );$pdf->SetXY(5,25);$pdf->cell(200,5,html_entity_decode(utf8_decode("V-Distribution des décès par tranche d'age et sexe (Néonatale Précoce) ")),1,0,'C',1,0);
$pdf->T2F20PEDJ($pdf->dataagesexepedj(5,42,'Days','deceshosp','DINS','COMMUNER',$datejour1,$datejour2,$EPH1),$datejour1,$datejour2);
$pdf->AddPage();$pdf->SetFont( 'Arial', '', 10 );$pdf->SetXY(5,25);$pdf->cell(200,5,html_entity_decode(utf8_decode("VI-Distribution des décès par wilaya de residence ")),1,0,'C',1,0);
$pdf->tblparwilaya('Deces',$datejour1,$datejour2,$EPH1) ;//non coriger  probleme des hors commune 
$pdf->AddPage();$pdf->SetFont( 'Arial', '', 10 );$pdf->SetXY(5,25);$pdf->cell(200,5,html_entity_decode(utf8_decode("VII-Distribution des décès par wilaya de residence (SIG) ")),1,0,'C',1,0);
$pdf->Algerie($pdf->datasigwil($datejour1,$datejour2,$EPH1),20,128,3.7,'wilaya'); 
$pdf->AddPage();$pdf->SetFont( 'Arial', '', 10 );$pdf->SetXY(5,25);$pdf->cell(200,5,html_entity_decode(utf8_decode("VIII-Distribution des décès par communes de residence ")),1,0,'C',1,0);
$pdf->tblparcommune('Deces',$datejour1,$datejour2,$EPH1) ;//non coriger  probleme des hors commune 
$pdf->AddPage();$pdf->SetFont( 'Arial', '', 10 );$pdf->SetXY(5,25);$pdf->cell(200,5,html_entity_decode(utf8_decode("IX-Distribution des décès par communes de residence (SIG) ")),1,0,'C',1,0);
$pdf->djelfa($pdf->datasig($datejour1,$datejour2,$EPH1),20,128,3.7,'commune');//commune//dairas 
$pdf->AddPage();$pdf->tblparcim1(html_entity_decode(utf8_decode("X-Distribution des causes de décès suivant la classification internationale des maladies cim10 (chapitres)")),$datejour1,$datejour2,$EPH1);//CODECIM
$pdf->AddPage();$pdf->tblparcim2(html_entity_decode(utf8_decode("XI-Distribution des causes de décès suivant la classification internationale des maladies cim10 (categories)")),$datejour1,$datejour2,$EPH1);//CODECIM
$pdf->AddPage();$pdf->DEMOGRAPHIE("SITUATION DEMOGRAPHIQUE : ",$datejour1,$datejour2,$EPH1,$STRUCTURED); 
$pdf->AddPage();$pdf->DECESMATERNELS("DECES MATERNELS : ",$datejour1,$datejour2,$EPH1,$STRUCTURED); 

$pdf->AddPage();$pdf->SetFont( 'Arial', '', 10 );$pdf->SetXY(5,25);$pdf->cell(200,5,html_entity_decode(utf8_decode("V-Distribution des deces Maternels par tranche d'age")),1,0,'C',1,0);
$pdf->T2F20MM($pdf->dataMM(5,42,'Years','deceshosp','DINS','COMMUNER',$datejour1,$datejour2,$EPH1),$datejour1,$datejour2);




$pdf->SetXY(120,$pdf->GetY()+15); $pdf->cell(90,10,"Le Praticien Responsable ",0,0,'L',0);$pdf->SetXY(120,$pdf->GetY()+5); $pdf->cell(90,10,'Dr '.$login,0,0,'L',0);	
}
$pdf->Output("EPA_".$STRUCTURED.".PDF",'I');
}
?>