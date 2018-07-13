<?php
if ($_POST['type']=='2') {
//header("Location: ../../dashboard/XLS/".$_POST['Datedebut']."/".$_POST['Datefin']."/") ;
}
else {
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
$pdf->AddPage('L','A4');
$pdf->SetFont('Times', 'B', 10);
$EPH1="IS NOT NULL";
$pdf->listedeces($EPH1,$datejour1,$datejour2,$login,'I');	
}

//2eme partie   RELEVE DES CAUSES DE DECES+
if ($_POST['deces']=='2') 
{
$pdf = new deces( 'L', 'mm', 'A4' );$pdf->AliasNbPages();//importatant pour metre en fonction  le totale nombre de page avec "/{nb}" 
$pdf->SetTitle('Releve Des Causes De Deces '."Du ".$datejour1." Au ".$datejour2);$pdf->SetFillColor(230);
$pdf->SetFillColor(230);//fond gris il faut ajouter au cell un autre parametre pour qui accepte la coloration
$pdf->SetTextColor(0,0,0);//text noire
$pdf->AddPage('L','A4');
$pdf->SetFont('Times', 'B', 10);
$EPH1="IS NOT NULL";
$pdf->listedeces($EPH1,$datejour1,$datejour2,$login,'');
}

//3ere partie Mortalite Intra-Hospitaliere
if ($_POST['deces']=='3') 
{
$pdf = new deces( 'P', 'mm', 'A4' );$pdf->AliasNbPages();//importatant pour metre en fonction  le totale nombre de page avec "/{nb}" 
$pdf->SetTitle('Deces Hospitalier '."Du ".$datejour1." Au ".$datejour2);$pdf->SetFillColor(230);//fond gris il faut ajouter au cell un autre parametre pour qui accepte la coloration
$pdf->SetTextColor(0,0,255);//text noire
$pdf->SetFont('Times', 'B', 13);$pdf->AliasNbPages();//prise encharge du nbr de page // $pdf->SetMargins(0,0,0);
$EPH1="IS NOT NULL";
$pdf->AddPage();//corige
$pdf->SetXY(5,10);$pdf->cell(200,5,html_entity_decode(utf8_decode($pdf->repfr)),0,0,'C',1,0);
$pdf->SetXY(5,20);$pdf->cell(200,5,html_entity_decode(utf8_decode($pdf->mspfr)),0,0,'C',1,0);
$pdf->SetXY(5,30);$pdf->cell(200,5,html_entity_decode(utf8_decode($pdf->dspfr)),0,0,'C',1,0);
$pdf->SetXY(5,40);$pdf->cell(100,5,"Service Prevention",0,0,'L',0,0);$pdf->SetXY(155,40);$pdf->cell(50,5,"Le : ........................",0,0,'L',0,0);
$pdf->SetXY(5,45);$pdf->cell(100,5,html_entity_decode(utf8_decode("N°...... / ".date('Y'))),0,0,'L',0,0);
$pdf->SetXY(55,55);$pdf->cell(150,5,html_entity_decode(utf8_decode("A")),0,0,'C',0,0);
$pdf->SetXY(55,60);$pdf->cell(150,5,html_entity_decode(utf8_decode("Monsieur le Directeur de la sante et de la population de la wilaya de Djelfa")),0,0,'C',0,0);
$pdf->SetXY(5,80);$pdf->cell(200,10,html_entity_decode(utf8_decode("BORDEREAU  D'ENVOI" )),0,0,'C',1,0);
$pdf->RoundedRect(5,108, 15, 130, 2, $style = '');
$pdf->RoundedRect(20,108, 105, 130, 2, $style = '');
$pdf->RoundedRect(20+105,108, 15, 130, 2, $style = '');
$pdf->RoundedRect(20+105+15,108, 65, 130, 2, $style = '');
$pdf->SetXY(5,108);$pdf->cell(15,10,html_entity_decode(utf8_decode("N°" )),1,0,'C',1,0);
$pdf->SetXY(5+15,108);$pdf->cell(105,10,html_entity_decode(utf8_decode("DESIGNATION" )),1,0,'C',1,0);
$pdf->SetXY(5+15+105,108);$pdf->cell(15,10,html_entity_decode(utf8_decode("NBR" )),1,0,'C',1,0);
$pdf->SetXY(5+30+105,108);$pdf->cell(65,10,html_entity_decode(utf8_decode("OBSERVATION" )),1,0,'C',1,0);
$pdf->SetXY(5+15,128);$pdf->cell(105,10,html_entity_decode(utf8_decode("Veuillez trouver ci-joint" )),0,0,'C',0,0);
$pdf->SetXY(5,148);$pdf->cell(15,10,html_entity_decode(utf8_decode("1" )),0,0,'C',0,0);
$pdf->SetXY(5+15,148);$pdf->cell(105,10,html_entity_decode(utf8_decode("Certificat de décès" )),0,0,'L',0,0);
$pdf->SetXY(5+15+105,148);$pdf->cell(15,10,$pdf->valeurmois('deceshosp','DINS',$datejour1,$datejour2,$EPH1),0,0,'C',0,0);
$pdf->SetXY(5+30+105,148);$pdf->cell(65,10,html_entity_decode(utf8_decode("" )),0,0,'C',0,0);
$pdf->SetXY(5,158);$pdf->cell(15,10,html_entity_decode(utf8_decode("2" )),0,0,'C',0,0);
$pdf->SetXY(5+15,158);$pdf->cell(105,10,html_entity_decode(utf8_decode("Liste nominative des décès hospitaliers" )),0,0,'L',0,0);
$pdf->SetXY(5+15+105,158);$pdf->cell(15,10,html_entity_decode(utf8_decode("01" )),0,0,'C',0,0);
$pdf->SetXY(5+30+105,158);$pdf->cell(65,10,html_entity_decode(utf8_decode("Rapport" )),0,0,'C',0,0);
$pdf->SetXY(5,168);$pdf->cell(15,10,html_entity_decode(utf8_decode("3" )),0,0,'C',0,0);
$pdf->SetXY(5+15,168);$pdf->cell(105,10,html_entity_decode(utf8_decode("Rapport de la mortatlité hospitaliere" )),0,0,'L',0,0);
$pdf->SetXY(5+15+105,168);$pdf->cell(15,10,html_entity_decode(utf8_decode("01" )),0,0,'C',0,0);
$pdf->SetXY(5+30+105,168);$pdf->cell(65,10,html_entity_decode(utf8_decode("Mortalité Hospitalière" )),0,0,'C',0,0);
$pdf->SetXY(5,178);$pdf->cell(15,10,html_entity_decode(utf8_decode("4" )),0,0,'C',0,0);
$pdf->SetXY(5+15,178);$pdf->cell(105,10,html_entity_decode(utf8_decode("Support Informatique (CD)" )),0,0,'L',0,0);
$pdf->SetXY(5+15+105,178);$pdf->cell(15,10,html_entity_decode(utf8_decode("01" )),0,0,'C',0,0);
$pdf->SetXY(5+30+105,178);$pdf->cell(65,10,html_entity_decode(utf8_decode("Du ".$pdf->dateUS2FR($datejour1)." Au ".$pdf->dateUS2FR($datejour2) )),0,0,'C',0,0);
$pdf->SetXY(5+30+105,250);$pdf->cell(40,10,html_entity_decode(utf8_decode("Le Directeur" )),0,0,'L',0,0);

$pdf->AddPage();//corige
$pdf->SetXY(5,10);$pdf->cell(200,5,html_entity_decode(utf8_decode($pdf->repfr)),0,0,'C',1,0);
$pdf->SetXY(5,20);$pdf->cell(200,5,html_entity_decode(utf8_decode($pdf->mspfr)),0,0,'C',1,0);
$pdf->SetXY(5,30);$pdf->cell(200,5,html_entity_decode(utf8_decode($pdf->dspfr)),0,0,'C',1,0);
$pdf->SetFont('Times', 'B', 16);
$pdf->SetTextColor(0,0,0);$pdf->SetTextColor(255,0,0);
$pdf->SetXY(5,70);$pdf->cell(200,5,"Mortalite Intra-Hospitaliere",0,0,'C',1,0);
$pdf->SetXY(5,80);$pdf->cell(200,5,"Du ".$pdf->dateUS2FR($datejour1)." Au ".$pdf->dateUS2FR($datejour2),0,0,'C',1,0);
$pdf->SetXY(5,90);$pdf->cell(200,5,"Wilaya de djelfa",0,0,'C',1,0);

$pdf->SetTextColor(0,0,0);
$pdf->SetFont( 'Arial', '', 10 );
$h=150;
$pdf->SetXY(45,$h);
$pdf->cell(10,10,"id",1,0,1,'C',0);
$pdf->cell(50,10,"Etablissements",1,0,1,'C',0);
$pdf->cell(30,10,"Nbr Deces",1,0,1,'C',0);
$pdf->cell(30,10,"% Deces",1,0,1,'C',0);
$pdf->SetXY(45,$h+10); 
$pdf->mysqlconnect();
$pdf->SetFont('Arial', '',9, '', true);
$query = "SELECT * FROM structure ";
$resultat=mysql_query($query);
$totalmbr1=mysql_num_rows($resultat);
while($row=mysql_fetch_object($resultat))
{
$pdf->cell(10,5,$row->id,1,0,'C',0);
$pdf->cell(50,5,$row->structure,1,0,'L',0);
$pdf->cell(30,5,$pdf->dspnbr($datejour1,$datejour2,"=".$row->id),1,0,'C',0);
$pdf->cell(30,5,round((($pdf->dspnbr($datejour1,$datejour2,"=".$row->id)*100) / $pdf->dspnbr($datejour1,$datejour2,$EPH1)),2),1,0,'C',0);
$pdf->SetXY(45,$pdf->GetY()+5); 
}
$pdf->cell(60,10,"Total Etablissements",1,0,1,'C',0);
$pdf->cell(30,10,$pdf->dspnbr($datejour1,$datejour2,$EPH1),1,0,'C',1,0);
$pdf->cell(30,10,'100 %',1,0,'C',1,0);
$pdf->SetXY(5,270);$pdf->cell(200,5,"Dr ".$login,0,0,'C',1,0);


$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Times', 'B', 11);
$EPH1="IS NOT NULL";
$pdf->AddPage();
$pdf->SetFont( 'Arial', '', 10 );
$pdf->servicehospitalisation(html_entity_decode(utf8_decode("I-Distribution des décès par Service D'hospitalisation")),$datejour1,$datejour2,'SERVICEHOSPIT',$EPH1);

$pdf->AddPage();//corige
$pdf->SetFont( 'Arial', '', 10 );
$pdf->dureehospitalisation1(html_entity_decode(utf8_decode("II-Distribution des décès par Durée D'hospitalisation")),$datejour1,$datejour2,'SERVICEHOSPIT',$EPH1);

$pdf->AddPage();//corige
$pdf->SetFont( 'Arial', '', 10 );
$pdf->SetXY(5,25);$pdf->cell(200,5,html_entity_decode(utf8_decode("III-Distribution des décès par tranche d'age et sexe (global)")),1,0,'C',1,0);
$pdf->SetFont( 'Arial', '', 10 );
$pdf->T2F20($pdf->dataagesexe(5,42,'Years','deceshosp','DINS','COMMUNER',$datejour1,$datejour2,$EPH1),$datejour1,$datejour2);

$pdf->AddPage();//corrige
$pdf->SetFont( 'Arial', '', 10 );
$pdf->SetXY(5,25);$pdf->cell(200,5,html_entity_decode(utf8_decode("IV-Distribution des décès par tranche d'age et sexe (pediatrique) ")),1,0,'C',1,0);
$pdf->T2F20PED($pdf->dataagesexeped(5,42,'Days','deceshosp','DINS','COMMUNER',$datejour1,$datejour2,$EPH1),$datejour1,$datejour2);

$pdf->AddPage();//corige
$pdf->SetFont( 'Arial', '', 10 );
$pdf->SetXY(5,25);$pdf->cell(200,5,html_entity_decode(utf8_decode("V-Distribution des décès par tranche d'age et sexe (Néonatale Précoce) ")),1,0,'C',1,0);
$pdf->T2F20PEDJ($pdf->dataagesexepedj(5,42,'Days','deceshosp','DINS','COMMUNER',$datejour1,$datejour2,$EPH1),$datejour1,$datejour2);

$pdf->AddPage();//corige
$pdf->SetFont( 'Arial', '', 10 );
$pdf->SetXY(5,25);$pdf->cell(200,5,html_entity_decode(utf8_decode("VI-Distribution des décès par communes de residence ")),1,0,'C',1,0);
$pdf->tblparcommune('Deces',$datejour1,$datejour2,$EPH1) ;//non coriger  probleme des hors commune 

$pdf->AddPage();//corige
$pdf->SetFont( 'Arial', '', 10 );
$pdf->SetXY(5,25);$pdf->cell(200,5,html_entity_decode(utf8_decode("VII-Distribution des décès par wilaya de residence (SIG) ")),1,0,'C',1,0);
$pdf->Algerie($pdf->datasigwil($datejour1,$datejour2,$EPH1),20,128,3.7,'wilaya'); 

$pdf->AddPage();//corige
$pdf->SetFont( 'Arial', '', 10 );
$pdf->SetXY(5,25);$pdf->cell(200,5,html_entity_decode(utf8_decode("VII-Distribution des décès par communes de residence (SIG) ")),1,0,'C',1,0);
$pdf->djelfa($pdf->datasig($datejour1,$datejour2,$EPH1),20,128,3.7,'commune');//commune//dairas 

$pdf->AddPage();//corige
$pdf->tblparcim1(html_entity_decode(utf8_decode("VIII-Distribution des causes de décès suivant la classification internationale des maladies cim10 (chapitres)")),$datejour1,$datejour2,$EPH1);//CODECIM

$pdf->AddPage();//corige
$pdf->tblparcim2(html_entity_decode(utf8_decode("IX-Distribution des causes de décès suivant la classification internationale des maladies cim10 (categories)")),$datejour1,$datejour2,$EPH1);//CODECIM

$pdf->SetXY(120,$pdf->GetY()+5); $pdf->cell(90,10,"Le Praticien Responsable ",0,0,'L',0);
$pdf->SetXY(120,$pdf->GetY()+5); $pdf->cell(90,10,'Dr '.$login,0,0,'L',0);	

}
$pdf->Output();
}
?>