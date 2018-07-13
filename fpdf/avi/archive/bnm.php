<?php
require('deces.php');
$pdf = new deces();$pdf->AliasNbPages();
$date=date("d-m-y");
$pdf->SetFillColor(230);//fond gris il faut ajouter au cell un autre parametre pour qui accepte la coloration
$pdf->SetTextColor(0,0,0);//text noire
$pdf->SetFont('Times', 'B', 10);

if ($_POST['BNM']=='0') //1ere partie
{
$pdf->AddPage('L','A4');
$pdf->SetDisplayMode('fullpage','single');//mode d affichage 
$pdf->SetFont('Arial','B',9);

$pdf->SetXY(05,5); $pdf->cell(285,5,"REPUBLIQUE ALGERIENNE DEMOCRATIQUE ET POPULAIRE",0,0,'C',0,0);
$pdf->SetXY(05,10);$pdf->cell(285,5,"MINISTERE DE LA SANTE DE LA POPULATION ET DE LA REFORME HOSPITALIERE",0,0,'C',0,0);
$pdf->SetXY(05,15);$pdf->cell(285,5,"DIRECTION DE LA SANTE ET DE LA POPULATION DE LA WILAYA DE DJELFA",0,0,'C',0,0);
$pdf->SetXY(05,20);$pdf->cell(142,5,"SERVICE PREVENTION",0,0,'L',0,0);$pdf->cell(142,5," LE : ".date ('d-m-Y'),0,0,'R',0,0);
$pdf->SetXY(05,25);$pdf->cell(142,5,"N               / ".$_POST['annee'],0,0,'L',0,0);
$pdf->SetXY(60,30);$pdf->cell(100,5,"Mouvement De La Population",0,0,'L',0,0);
$pdf->SetXY(60,35);$pdf->cell(100,5,"Annee  ".$_POST['annee'],0,0,'L',0,0);
$pdf->SetXY(60,40);$pdf->cell(100,5,"BNM Par Mois ",0,0,'L',0,0);
$pdf->SetFillColor(200 );
$pdf->SetXY(05,50);$pdf->cell(45,5,"Mois",1,0,'L',1,0);
$pdf->cell(20,10,"Janvier",1,0,'C',1,0);
$pdf->cell(20,10,"Fevrier",1,0,'C',1,0);
$pdf->cell(20,10,"Mars",1,0,'C',1,0);
$pdf->cell(20,10,"Avril",1,0,'C',1,0);
$pdf->cell(20,10,"Mai",1,0,'C',1,0);
$pdf->cell(20,10,"Juin",1,0,'C',1,0);
$pdf->cell(20,10,"Juillet",1,0,'C',1,0);
$pdf->cell(20,10,"Aout",1,0,'C',1,0);
$pdf->cell(20,10,"Septembre",1,0,'C',1,0);
$pdf->cell(20,10,"October",1,0,'C',1,0);
$pdf->cell(20,10,"Novombre",1,0,'C',1,0);
$pdf->cell(20,10,"Decembre",1,0,'C',1,0);

$pdf->SetXY(05,55);$pdf->cell(45,5,"Commune",1,0,1,'L',0);
$pdf->mysqlconnect();
$query = "SELECT * from COM where IDWIL='17000' and yes='1' order by COMMUNE "; 
$pdf->SetXY(05,60); 
$resultat=mysql_query($query);
$totalmbr1=mysql_num_rows($resultat);
while($row=mysql_fetch_object($resultat))
{

$pdf->cell(45,5,$row->COMMUNE,1,0,'l',0);
$pdf->cell(20,5,$pdf->etabnm($row->IDCOM,'01',$_POST['annee']),1,0,'C',0,0);
$pdf->cell(20,5,$pdf->etabnm($row->IDCOM,'02',$_POST['annee']),1,0,'C',0,0);
$pdf->cell(20,5,$pdf->etabnm($row->IDCOM,'03',$_POST['annee']),1,0,'C',0,0);
$pdf->cell(20,5,$pdf->etabnm($row->IDCOM,'04',$_POST['annee']),1,0,'C',0,0);
$pdf->cell(20,5,$pdf->etabnm($row->IDCOM,'05',$_POST['annee']),1,0,'C',0,0);
$pdf->cell(20,5,$pdf->etabnm($row->IDCOM,'06',$_POST['annee']),1,0,'C',0,0);
$pdf->cell(20,5,$pdf->etabnm($row->IDCOM,'07',$_POST['annee']),1,0,'C',0,0);
$pdf->cell(20,5,$pdf->etabnm($row->IDCOM,'08',$_POST['annee']),1,0,'C',0,0);
$pdf->cell(20,5,$pdf->etabnm($row->IDCOM,'09',$_POST['annee']),1,0,'C',0,0);
$pdf->cell(20,5,$pdf->etabnm($row->IDCOM,'10',$_POST['annee']),1,0,'C',0,0);
$pdf->cell(20,5,$pdf->etabnm($row->IDCOM,'11',$_POST['annee']),1,0,'C',0,0);
$pdf->cell(20,5,$pdf->etabnm($row->IDCOM,'12',$_POST['annee']),1,0,'C',0,0);
$pdf->setxy(5,$pdf->gety()+5); 
}
}


if ($_POST['BNM']=='1') //1ere partie
{
$pdf->AddPage('L','A4');
$pdf->SetDisplayMode('fullpage','single');//mode d affichage 
$pdf->SetFont('Arial','B',9);

$pdf->SetXY(05,5); $pdf->cell(285,5,"REPUBLIQUE ALGERIENNE DEMOCRATIQUE ET POPULAIRE",0,0,'C',0,0);
$pdf->SetXY(05,10);$pdf->cell(285,5,"MINISTERE DE LA SANTE DE LA POPULATION ET DE LA REFORME HOSPITALIERE",0,0,'C',0,0);
$pdf->SetXY(05,15);$pdf->cell(285,5,"DIRECTION DE LA SANTE ET DE LA POPULATION DE LA WILAYA DE DJELFA",0,0,'C',0,0);
$pdf->SetXY(05,20);$pdf->cell(142,5,"SERVICE PREVENTION",0,0,'L',0,0);$pdf->cell(142,5," LE : ".date ('d-m-Y'),0,0,'R',0,0);
$pdf->SetXY(05,25);$pdf->cell(142,5,"N               / ".$_POST['annee'],0,0,'L',0,0);
$pdf->SetXY(60,30);$pdf->cell(100,5,"Mouvement De La Population",0,0,'L',0,0);
$pdf->SetXY(60,35);$pdf->cell(100,5,"Annee  ".$_POST['annee'],0,0,'L',0,0);
$pdf->SetXY(60,40);$pdf->cell(100,5,"Naissance Par Mois Et Par Sexe",0,0,'L',0,0);
$pdf->SetFillColor(200 );
$pdf->SetXY(05,50);$pdf->cell(25,5,"Mois",1,0,'L',1,0);$pdf->cell(20,5,"Janvier",1,0,'C',1,0);$pdf->cell(20,5,"Fevrier",1,0,'C',1,0);$pdf->cell(20,5,"Mars",1,0,'C',1,0);$pdf->cell(20,5,"Avril",1,0,'C',1,0);$pdf->cell(20,5,"Mai",1,0,'C',1,0);$pdf->cell(20,5,"Juin",1,0,'C',1,0);$pdf->cell(20,5,"Juillet",1,0,'C',1,0);$pdf->cell(20,5,"Aout",1,0,'C',1,0);$pdf->cell(20,5,"Septembre",1,0,'C',1,0);$pdf->cell(20,5,"October",1,0,'C',1,0);$pdf->cell(20,5,"Novombre",1,0,'C',1,0);$pdf->cell(20,5,"Decembre",1,0,'C',1,0);$pdf->cell(20,5,"Total",1,0,'C',1,0);
$pdf->SetXY(05,55);$pdf->cell(25,5,"Commune",1,0,1,'L',0);
$pdf->cell(10,5,"Mas",1,0,'C',1,0);$pdf->cell(10,5,"Fem",1,0,'C',1,0);
$pdf->cell(10,5,"Mas",1,0,'C',1,0);$pdf->cell(10,5,"Fem",1,0,'C',1,0);
$pdf->cell(10,5,"Mas",1,0,'C',1,0);$pdf->cell(10,5,"Fem",1,0,'C',1,0);
$pdf->cell(10,5,"Mas",1,0,'C',1,0);$pdf->cell(10,5,"Fem",1,0,'C',1,0);
$pdf->cell(10,5,"Mas",1,0,'C',1,0);$pdf->cell(10,5,"Fem",1,0,'C',1,0);
$pdf->cell(10,5,"Mas",1,0,'C',1,0);$pdf->cell(10,5,"Fem",1,0,'C',1,0);
$pdf->cell(10,5,"Mas",1,0,'C',1,0);$pdf->cell(10,5,"Fem",1,0,'C',1,0);
$pdf->cell(10,5,"Mas",1,0,'C',1,0);$pdf->cell(10,5,"Fem",1,0,'C',1,0);
$pdf->cell(10,5,"Mas",1,0,'C',1,0);$pdf->cell(10,5,"Fem",1,0,'C',1,0);
$pdf->cell(10,5,"Mas",1,0,'C',1,0);$pdf->cell(10,5,"Fem",1,0,'C',1,0);
$pdf->cell(10,5,"Mas",1,0,'C',1,0);$pdf->cell(10,5,"Fem",1,0,'C',1,0);
$pdf->cell(10,5,"Mas",1,0,'C',1,0);$pdf->cell(10,5,"Fem",1,0,'C',1,0);
$pdf->cell(10,5,"Mas",1,0,'C',1,0);$pdf->cell(10,5,"Fem",1,0,'C',1,0);
$pdf->mysqlconnect();
$query = "SELECT * from COM where IDWIL='17000' and yes='1' order by COMMUNE "; 
$pdf->SetXY(05,60); 
$resultat=mysql_query($query);
$totalmbr1=mysql_num_rows($resultat);
while($row=mysql_fetch_object($resultat))
{
$pdf->cell(25,5,$row->COMMUNE,1,0,'l',0);
$pdf->cell(10,5,$pdf->bnm('nm1',$row->IDCOM,'01',$_POST['annee'])+$pdf->bnm('nm2',$row->IDCOM,'01',$_POST['annee']),1,0,'C',0);$pdf->cell(10,5,$pdf->bnm('nf1',$row->IDCOM,'01',$_POST['annee'])+$pdf->bnm('nf2',$row->IDCOM,'01',$_POST['annee']),1,0,'C',0);
$pdf->cell(10,5,$pdf->bnm('nm1',$row->IDCOM,'02',$_POST['annee'])+$pdf->bnm('nm2',$row->IDCOM,'02',$_POST['annee']),1,0,'C',0);$pdf->cell(10,5,$pdf->bnm('nf1',$row->IDCOM,'02',$_POST['annee'])+$pdf->bnm('nf2',$row->IDCOM,'02',$_POST['annee']),1,0,'C',0);
$pdf->cell(10,5,$pdf->bnm('nm1',$row->IDCOM,'03',$_POST['annee'])+$pdf->bnm('nm2',$row->IDCOM,'03',$_POST['annee']),1,0,'C',0);$pdf->cell(10,5,$pdf->bnm('nf1',$row->IDCOM,'03',$_POST['annee'])+$pdf->bnm('nf2',$row->IDCOM,'03',$_POST['annee']),1,0,'C',0);
$pdf->cell(10,5,$pdf->bnm('nm1',$row->IDCOM,'04',$_POST['annee'])+$pdf->bnm('nm2',$row->IDCOM,'04',$_POST['annee']),1,0,'C',0);$pdf->cell(10,5,$pdf->bnm('nf1',$row->IDCOM,'04',$_POST['annee'])+$pdf->bnm('nf2',$row->IDCOM,'04',$_POST['annee']),1,0,'C',0);
$pdf->cell(10,5,$pdf->bnm('nm1',$row->IDCOM,'05',$_POST['annee'])+$pdf->bnm('nm2',$row->IDCOM,'05',$_POST['annee']),1,0,'C',0);$pdf->cell(10,5,$pdf->bnm('nf1',$row->IDCOM,'05',$_POST['annee'])+$pdf->bnm('nf2',$row->IDCOM,'05',$_POST['annee']),1,0,'C',0);
$pdf->cell(10,5,$pdf->bnm('nm1',$row->IDCOM,'06',$_POST['annee'])+$pdf->bnm('nm2',$row->IDCOM,'06',$_POST['annee']),1,0,'C',0);$pdf->cell(10,5,$pdf->bnm('nf1',$row->IDCOM,'06',$_POST['annee'])+$pdf->bnm('nf2',$row->IDCOM,'06',$_POST['annee']),1,0,'C',0);
$pdf->cell(10,5,$pdf->bnm('nm1',$row->IDCOM,'07',$_POST['annee'])+$pdf->bnm('nm2',$row->IDCOM,'07',$_POST['annee']),1,0,'C',0);$pdf->cell(10,5,$pdf->bnm('nf1',$row->IDCOM,'07',$_POST['annee'])+$pdf->bnm('nf2',$row->IDCOM,'07',$_POST['annee']),1,0,'C',0);
$pdf->cell(10,5,$pdf->bnm('nm1',$row->IDCOM,'08',$_POST['annee'])+$pdf->bnm('nm2',$row->IDCOM,'08',$_POST['annee']),1,0,'C',0);$pdf->cell(10,5,$pdf->bnm('nf1',$row->IDCOM,'08',$_POST['annee'])+$pdf->bnm('nf2',$row->IDCOM,'08',$_POST['annee']),1,0,'C',0);
$pdf->cell(10,5,$pdf->bnm('nm1',$row->IDCOM,'09',$_POST['annee'])+$pdf->bnm('nm2',$row->IDCOM,'09',$_POST['annee']),1,0,'C',0);$pdf->cell(10,5,$pdf->bnm('nf1',$row->IDCOM,'09',$_POST['annee'])+$pdf->bnm('nf2',$row->IDCOM,'09',$_POST['annee']),1,0,'C',0);
$pdf->cell(10,5,$pdf->bnm('nm1',$row->IDCOM,'10',$_POST['annee'])+$pdf->bnm('nm2',$row->IDCOM,'10',$_POST['annee']),1,0,'C',0);$pdf->cell(10,5,$pdf->bnm('nf1',$row->IDCOM,'10',$_POST['annee'])+$pdf->bnm('nf2',$row->IDCOM,'10',$_POST['annee']),1,0,'C',0);
$pdf->cell(10,5,$pdf->bnm('nm1',$row->IDCOM,'11',$_POST['annee'])+$pdf->bnm('nm2',$row->IDCOM,'11',$_POST['annee']),1,0,'C',0);$pdf->cell(10,5,$pdf->bnm('nf1',$row->IDCOM,'11',$_POST['annee'])+$pdf->bnm('nf2',$row->IDCOM,'11',$_POST['annee']),1,0,'C',0);
$pdf->cell(10,5,$pdf->bnm('nm1',$row->IDCOM,'12',$_POST['annee'])+$pdf->bnm('nm2',$row->IDCOM,'12',$_POST['annee']),1,0,'C',0);$pdf->cell(10,5,$pdf->bnm('nf1',$row->IDCOM,'12',$_POST['annee'])+$pdf->bnm('nf2',$row->IDCOM,'12',$_POST['annee']),1,0,'C',0);

$pdf->cell(10,5,
$pdf->bnm('nm1',$row->IDCOM,'1',$_POST['annee']) + $pdf->bnm('nm2',$row->IDCOM,'1',$_POST['annee'])+
$pdf->bnm('nm1',$row->IDCOM,'2',$_POST['annee']) + $pdf->bnm('nm2',$row->IDCOM,'2',$_POST['annee'])+
$pdf->bnm('nm1',$row->IDCOM,'3',$_POST['annee']) + $pdf->bnm('nm2',$row->IDCOM,'3',$_POST['annee'])+
$pdf->bnm('nm1',$row->IDCOM,'4',$_POST['annee']) + $pdf->bnm('nm2',$row->IDCOM,'4',$_POST['annee'])+
$pdf->bnm('nm1',$row->IDCOM,'5',$_POST['annee']) + $pdf->bnm('nm2',$row->IDCOM,'5',$_POST['annee'])+
$pdf->bnm('nm1',$row->IDCOM,'6',$_POST['annee']) + $pdf->bnm('nm2',$row->IDCOM,'6',$_POST['annee'])+
$pdf->bnm('nm1',$row->IDCOM,'7',$_POST['annee']) + $pdf->bnm('nm2',$row->IDCOM,'7',$_POST['annee'])+
$pdf->bnm('nm1',$row->IDCOM,'8',$_POST['annee']) + $pdf->bnm('nm2',$row->IDCOM,'8',$_POST['annee'])+
$pdf->bnm('nm1',$row->IDCOM,'9',$_POST['annee']) + $pdf->bnm('nm2',$row->IDCOM,'9',$_POST['annee'])+
$pdf->bnm('nm1',$row->IDCOM,'10',$_POST['annee']) + $pdf->bnm('nm2',$row->IDCOM,'10',$_POST['annee'])+
$pdf->bnm('nm1',$row->IDCOM,'11',$_POST['annee']) + $pdf->bnm('nm2',$row->IDCOM,'11',$_POST['annee'])+
$pdf->bnm('nm1',$row->IDCOM,'12',$_POST['annee']) + $pdf->bnm('nm2',$row->IDCOM,'12',$_POST['annee']),1,0,'C',0);

$pdf->cell(10,5,
$pdf->bnm('nf1',$row->IDCOM,'1',$_POST['annee']) + $pdf->bnm('nf2',$row->IDCOM,'1',$_POST['annee'])+
$pdf->bnm('nf1',$row->IDCOM,'2',$_POST['annee']) + $pdf->bnm('nf2',$row->IDCOM,'2',$_POST['annee'])+
$pdf->bnm('nf1',$row->IDCOM,'3',$_POST['annee']) + $pdf->bnm('nf2',$row->IDCOM,'3',$_POST['annee'])+
$pdf->bnm('nf1',$row->IDCOM,'4',$_POST['annee']) + $pdf->bnm('nf2',$row->IDCOM,'4',$_POST['annee'])+
$pdf->bnm('nf1',$row->IDCOM,'5',$_POST['annee']) + $pdf->bnm('nf2',$row->IDCOM,'5',$_POST['annee'])+
$pdf->bnm('nf1',$row->IDCOM,'6',$_POST['annee']) + $pdf->bnm('nf2',$row->IDCOM,'6',$_POST['annee'])+
$pdf->bnm('nf1',$row->IDCOM,'7',$_POST['annee']) + $pdf->bnm('nf2',$row->IDCOM,'7',$_POST['annee'])+
$pdf->bnm('nf1',$row->IDCOM,'8',$_POST['annee']) + $pdf->bnm('nf2',$row->IDCOM,'8',$_POST['annee'])+
$pdf->bnm('nf1',$row->IDCOM,'9',$_POST['annee']) + $pdf->bnm('nf2',$row->IDCOM,'9',$_POST['annee'])+
$pdf->bnm('nf1',$row->IDCOM,'10',$_POST['annee']) + $pdf->bnm('nf2',$row->IDCOM,'10',$_POST['annee'])+
$pdf->bnm('nf1',$row->IDCOM,'11',$_POST['annee']) + $pdf->bnm('nf2',$row->IDCOM,'11',$_POST['annee'])+
$pdf->bnm('nf1',$row->IDCOM,'12',$_POST['annee']) + $pdf->bnm('nf2',$row->IDCOM,'12',$_POST['annee']),1,0,'C',0);
$pdf->setxy(5,$pdf->gety()+5); 
}
$pdf->SetXY(05,65);$pdf->cell(25,5,"Total",1,0,1,'L',0);
$pdf->cell(10,5,$pdf->sumbnm('nm1','1',$_POST['annee'])+$pdf->sumbnm('nm2','1',$_POST['annee']),1,0,'C',1,0);$pdf->cell(10,5,$pdf->sumbnm('nf1','1',$_POST['annee'])+$pdf->sumbnm('nf2','1',$_POST['annee']),1,0,'C',1,0);
$pdf->cell(10,5,$pdf->sumbnm('nm1','2',$_POST['annee'])+$pdf->sumbnm('nm2','2',$_POST['annee']),1,0,'C',1,0);$pdf->cell(10,5,$pdf->sumbnm('nf1','2',$_POST['annee'])+$pdf->sumbnm('nf2','2',$_POST['annee']),1,0,'C',1,0);
$pdf->cell(10,5,$pdf->sumbnm('nm1','3',$_POST['annee'])+$pdf->sumbnm('nm2','3',$_POST['annee']),1,0,'C',1,0);$pdf->cell(10,5,$pdf->sumbnm('nf1','3',$_POST['annee'])+$pdf->sumbnm('nf2','3',$_POST['annee']),1,0,'C',1,0);
$pdf->cell(10,5,$pdf->sumbnm('nm1','4',$_POST['annee'])+$pdf->sumbnm('nm2','4',$_POST['annee']),1,0,'C',1,0);$pdf->cell(10,5,$pdf->sumbnm('nf1','4',$_POST['annee'])+$pdf->sumbnm('nf2','4',$_POST['annee']),1,0,'C',1,0);
$pdf->cell(10,5,$pdf->sumbnm('nm1','5',$_POST['annee'])+$pdf->sumbnm('nm2','5',$_POST['annee']),1,0,'C',1,0);$pdf->cell(10,5,$pdf->sumbnm('nf1','5',$_POST['annee'])+$pdf->sumbnm('nf2','5',$_POST['annee']),1,0,'C',1,0);
$pdf->cell(10,5,$pdf->sumbnm('nm1','6',$_POST['annee'])+$pdf->sumbnm('nm2','6',$_POST['annee']),1,0,'C',1,0);$pdf->cell(10,5,$pdf->sumbnm('nf1','6',$_POST['annee'])+$pdf->sumbnm('nf2','6',$_POST['annee']),1,0,'C',1,0);
$pdf->cell(10,5,$pdf->sumbnm('nm1','7',$_POST['annee'])+$pdf->sumbnm('nm2','7',$_POST['annee']),1,0,'C',1,0);$pdf->cell(10,5,$pdf->sumbnm('nf1','7',$_POST['annee'])+$pdf->sumbnm('nf2','7',$_POST['annee']),1,0,'C',1,0);
$pdf->cell(10,5,$pdf->sumbnm('nm1','8',$_POST['annee'])+$pdf->sumbnm('nm2','8',$_POST['annee']),1,0,'C',1,0);$pdf->cell(10,5,$pdf->sumbnm('nf1','8',$_POST['annee'])+$pdf->sumbnm('nf2','8',$_POST['annee']),1,0,'C',1,0);
$pdf->cell(10,5,$pdf->sumbnm('nm1','9',$_POST['annee'])+$pdf->sumbnm('nm2','9',$_POST['annee']),1,0,'C',1,0);$pdf->cell(10,5,$pdf->sumbnm('nf1','9',$_POST['annee'])+$pdf->sumbnm('nf2','9',$_POST['annee']),1,0,'C',1,0);
$pdf->cell(10,5,$pdf->sumbnm('nm1','10',$_POST['annee'])+$pdf->sumbnm('nm2','10',$_POST['annee']),1,0,'C',1,0);$pdf->cell(10,5,$pdf->sumbnm('nf1','10',$_POST['annee'])+$pdf->sumbnm('nf2','10',$_POST['annee']),1,0,'C',1,0);
$pdf->cell(10,5,$pdf->sumbnm('nm1','11',$_POST['annee'])+$pdf->sumbnm('nm2','11',$_POST['annee']),1,0,'C',1,0);$pdf->cell(10,5,$pdf->sumbnm('nf1','11',$_POST['annee'])+$pdf->sumbnm('nf2','11',$_POST['annee']),1,0,'C',1,0);
$pdf->cell(10,5,$pdf->sumbnm('nm1','12',$_POST['annee'])+$pdf->sumbnm('nm2','12',$_POST['annee']),1,0,'C',1,0);$pdf->cell(10,5,$pdf->sumbnm('nf1','12',$_POST['annee'])+$pdf->sumbnm('nf2','12',$_POST['annee']),1,0,'C',1,0);
$pdf->cell(10,5,$pdf->sumbnm('nm1','1',$_POST['annee'])+$pdf->sumbnm('nm2','1',$_POST['annee'])+$pdf->sumbnm('nm1','2',$_POST['annee'])+$pdf->sumbnm('nm2','2',$_POST['annee'])+$pdf->sumbnm('nm1','3',$_POST['annee'])+$pdf->sumbnm('nm2','3',$_POST['annee'])+$pdf->sumbnm('nm1','4',$_POST['annee'])+$pdf->sumbnm('nm2','4',$_POST['annee'])+$pdf->sumbnm('nm1','5',$_POST['annee'])+$pdf->sumbnm('nm2','5',$_POST['annee'])+$pdf->sumbnm('nm1','6',$_POST['annee'])+$pdf->sumbnm('nm2','6',$_POST['annee'])+$pdf->sumbnm('nm1','7',$_POST['annee'])+$pdf->sumbnm('nm2','7',$_POST['annee'])+$pdf->sumbnm('nm1','8',$_POST['annee'])+$pdf->sumbnm('nm2','8',$_POST['annee'])+$pdf->sumbnm('nm1','9',$_POST['annee'])+$pdf->sumbnm('nm2','9',$_POST['annee'])+$pdf->sumbnm('nm1','10',$_POST['annee'])+$pdf->sumbnm('nm2','10',$_POST['annee'])+$pdf->sumbnm('nm1','11',$_POST['annee'])+$pdf->sumbnm('nm2','11',$_POST['annee'])+$pdf->sumbnm('nm1','12',$_POST['annee'])+$pdf->sumbnm('nm2','12',$_POST['annee']),1,0,'C',1,0);
$pdf->cell(10,5,$pdf->sumbnm('nf1','1',$_POST['annee'])+$pdf->sumbnm('nf2','1',$_POST['annee'])+$pdf->sumbnm('nf1','2',$_POST['annee'])+$pdf->sumbnm('nf2','2',$_POST['annee'])+$pdf->sumbnm('nf1','3',$_POST['annee'])+$pdf->sumbnm('nf2','3',$_POST['annee'])+$pdf->sumbnm('nf1','4',$_POST['annee'])+$pdf->sumbnm('nf2','4',$_POST['annee'])+$pdf->sumbnm('nf1','5',$_POST['annee'])+$pdf->sumbnm('nf2','5',$_POST['annee'])+$pdf->sumbnm('nf1','6',$_POST['annee'])+$pdf->sumbnm('nf2','6',$_POST['annee'])+$pdf->sumbnm('nf1','7',$_POST['annee'])+$pdf->sumbnm('nf2','7',$_POST['annee'])+$pdf->sumbnm('nf1','8',$_POST['annee'])+$pdf->sumbnm('nf2','8',$_POST['annee'])+$pdf->sumbnm('nf1','9',$_POST['annee'])+$pdf->sumbnm('nf2','9',$_POST['annee'])+$pdf->sumbnm('nf1','10',$_POST['annee'])+$pdf->sumbnm('nf2','10',$_POST['annee'])+$pdf->sumbnm('nf1','11',$_POST['annee'])+$pdf->sumbnm('nf2','11',$_POST['annee'])+$pdf->sumbnm('nf1','12',$_POST['annee'])+$pdf->sumbnm('nf2','12',$_POST['annee']),1,0,'C',1,0);

}

if ($_POST['BNM']=='2') //2eme partie
{
$pdf->AddPage('L','A4');
$pdf->SetDisplayMode('fullpage','single');//mode d affichage 
$pdf->SetFont('Arial','B',9);

$pdf->SetXY(05,5); $pdf->cell(285,5,"REPUBLIQUE ALGERIENNE DEMOCRATIQUE ET POPULAIRE",0,0,'C',0,0);
$pdf->SetXY(05,10);$pdf->cell(285,5,"MINISTERE DE LA SANTE DE LA POPULATION ET DE LA REFORME HOSPITALIERE",0,0,'C',0,0);
$pdf->SetXY(05,15);$pdf->cell(285,5,"DIRECTION DE LA SANTE ET DE LA POPULATION DE LA WILAYA DE DJELFA",0,0,'C',0,0);
$pdf->SetXY(05,20);$pdf->cell(142,5,"SERVICE PREVENTION",0,0,'L',0,0);$pdf->cell(142,5," LE : ".date ('d-m-Y'),0,0,'R',0,0);
$pdf->SetXY(05,25);$pdf->cell(142,5,"N               / ".$_POST['annee'],0,0,'L',0,0);
$pdf->SetXY(60,30);$pdf->cell(100,5,"Mouvement De La Population",0,0,'L',0,0);
$pdf->SetXY(60,35);$pdf->cell(100,5,"Annee  ".$_POST['annee'],0,0,'L',0,0);
$pdf->SetXY(60,40);$pdf->cell(100,5,"Mariage Par Mois",0,0,'L',0,0);
$pdf->SetFillColor(200 );
$pdf->SetXY(05,50);$pdf->cell(25,5,"Mois",1,0,'L',1,0);$pdf->cell(20,5,"Janvier",1,0,'C',1,0);$pdf->cell(20,5,"Fevrier",1,0,'C',1,0);$pdf->cell(20,5,"Mars",1,0,'C',1,0);$pdf->cell(20,5,"Avril",1,0,'C',1,0);$pdf->cell(20,5,"Mai",1,0,'C',1,0);$pdf->cell(20,5,"Juin",1,0,'C',1,0);$pdf->cell(20,5,"Juillet",1,0,'C',1,0);$pdf->cell(20,5,"Aout",1,0,'C',1,0);$pdf->cell(20,5,"Septembre",1,0,'C',1,0);$pdf->cell(20,5,"October",1,0,'C',1,0);$pdf->cell(20,5,"Novombre",1,0,'C',1,0);$pdf->cell(20,5,"Decembre",1,0,'C',1,0);$pdf->cell(20,5,"Total",1,0,'C',1,0);
$pdf->mysqlconnect();
$query = "SELECT * from COM where IDWIL='17000' and yes='1' order by COMMUNE "; 
$pdf->SetXY(05,55); 
$resultat=mysql_query($query);
$totalmbr1=mysql_num_rows($resultat);
while($row=mysql_fetch_object($resultat))
{
$pdf->cell(25,5,$row->COMMUNE,1,0,'l',0);
$pdf->cell(20,5,$pdf->bnm('m1',$row->IDCOM,'01',$_POST['annee'])+$pdf->bnm('m2',$row->IDCOM,'01',$_POST['annee']),1,0,'C',0);
$pdf->cell(20,5,$pdf->bnm('m1',$row->IDCOM,'02',$_POST['annee'])+$pdf->bnm('m2',$row->IDCOM,'02',$_POST['annee']),1,0,'C',0);
$pdf->cell(20,5,$pdf->bnm('m1',$row->IDCOM,'03',$_POST['annee'])+$pdf->bnm('m2',$row->IDCOM,'03',$_POST['annee']),1,0,'C',0);
$pdf->cell(20,5,$pdf->bnm('m1',$row->IDCOM,'04',$_POST['annee'])+$pdf->bnm('m2',$row->IDCOM,'04',$_POST['annee']),1,0,'C',0);
$pdf->cell(20,5,$pdf->bnm('m1',$row->IDCOM,'05',$_POST['annee'])+$pdf->bnm('m2',$row->IDCOM,'05',$_POST['annee']),1,0,'C',0);
$pdf->cell(20,5,$pdf->bnm('m1',$row->IDCOM,'06',$_POST['annee'])+$pdf->bnm('m2',$row->IDCOM,'06',$_POST['annee']),1,0,'C',0);
$pdf->cell(20,5,$pdf->bnm('m1',$row->IDCOM,'07',$_POST['annee'])+$pdf->bnm('m2',$row->IDCOM,'07',$_POST['annee']),1,0,'C',0);
$pdf->cell(20,5,$pdf->bnm('m1',$row->IDCOM,'08',$_POST['annee'])+$pdf->bnm('m2',$row->IDCOM,'08',$_POST['annee']),1,0,'C',0);
$pdf->cell(20,5,$pdf->bnm('m1',$row->IDCOM,'09',$_POST['annee'])+$pdf->bnm('m2',$row->IDCOM,'09',$_POST['annee']),1,0,'C',0);
$pdf->cell(20,5,$pdf->bnm('m1',$row->IDCOM,'10',$_POST['annee'])+$pdf->bnm('m2',$row->IDCOM,'10',$_POST['annee']),1,0,'C',0);
$pdf->cell(20,5,$pdf->bnm('m1',$row->IDCOM,'11',$_POST['annee'])+$pdf->bnm('m2',$row->IDCOM,'11',$_POST['annee']),1,0,'C',0);
$pdf->cell(20,5,$pdf->bnm('m1',$row->IDCOM,'12',$_POST['annee'])+$pdf->bnm('m2',$row->IDCOM,'12',$_POST['annee']),1,0,'C',0);

$pdf->cell(20,5,
$pdf->bnm('m1',$row->IDCOM,'1',$_POST['annee']) + $pdf->bnm('m2',$row->IDCOM,'1',$_POST['annee'])+
$pdf->bnm('m1',$row->IDCOM,'2',$_POST['annee']) + $pdf->bnm('m2',$row->IDCOM,'2',$_POST['annee'])+
$pdf->bnm('m1',$row->IDCOM,'3',$_POST['annee']) + $pdf->bnm('m2',$row->IDCOM,'3',$_POST['annee'])+
$pdf->bnm('m1',$row->IDCOM,'4',$_POST['annee']) + $pdf->bnm('m2',$row->IDCOM,'4',$_POST['annee'])+
$pdf->bnm('m1',$row->IDCOM,'5',$_POST['annee']) + $pdf->bnm('m2',$row->IDCOM,'5',$_POST['annee'])+
$pdf->bnm('m1',$row->IDCOM,'6',$_POST['annee']) + $pdf->bnm('m2',$row->IDCOM,'6',$_POST['annee'])+
$pdf->bnm('m1',$row->IDCOM,'7',$_POST['annee']) + $pdf->bnm('m2',$row->IDCOM,'7',$_POST['annee'])+
$pdf->bnm('m1',$row->IDCOM,'8',$_POST['annee']) + $pdf->bnm('m2',$row->IDCOM,'8',$_POST['annee'])+
$pdf->bnm('m1',$row->IDCOM,'9',$_POST['annee']) + $pdf->bnm('m2',$row->IDCOM,'9',$_POST['annee'])+
$pdf->bnm('m1',$row->IDCOM,'10',$_POST['annee']) + $pdf->bnm('m2',$row->IDCOM,'10',$_POST['annee'])+
$pdf->bnm('m1',$row->IDCOM,'11',$_POST['annee']) + $pdf->bnm('m2',$row->IDCOM,'11',$_POST['annee'])+
$pdf->bnm('m1',$row->IDCOM,'12',$_POST['annee']) + $pdf->bnm('m2',$row->IDCOM,'12',$_POST['annee']),1,0,'C',0);
$pdf->setxy(5,$pdf->gety()+5); 
}
$pdf->SetXY(05,60);$pdf->cell(25,5,"Total",1,0,1,'L',0);
$pdf->cell(20,5,$pdf->sumbnm('m1','1',$_POST['annee'])+$pdf->sumbnm('m2','1',$_POST['annee']),1,0,'C',1,0);
$pdf->cell(20,5,$pdf->sumbnm('m1','2',$_POST['annee'])+$pdf->sumbnm('m2','2',$_POST['annee']),1,0,'C',1,0);
$pdf->cell(20,5,$pdf->sumbnm('m1','3',$_POST['annee'])+$pdf->sumbnm('m2','3',$_POST['annee']),1,0,'C',1,0);
$pdf->cell(20,5,$pdf->sumbnm('m1','4',$_POST['annee'])+$pdf->sumbnm('m2','4',$_POST['annee']),1,0,'C',1,0);
$pdf->cell(20,5,$pdf->sumbnm('m1','5',$_POST['annee'])+$pdf->sumbnm('m2','5',$_POST['annee']),1,0,'C',1,0);
$pdf->cell(20,5,$pdf->sumbnm('m1','6',$_POST['annee'])+$pdf->sumbnm('m2','6',$_POST['annee']),1,0,'C',1,0);
$pdf->cell(20,5,$pdf->sumbnm('m1','7',$_POST['annee'])+$pdf->sumbnm('m2','7',$_POST['annee']),1,0,'C',1,0);
$pdf->cell(20,5,$pdf->sumbnm('m1','8',$_POST['annee'])+$pdf->sumbnm('m2','8',$_POST['annee']),1,0,'C',1,0);
$pdf->cell(20,5,$pdf->sumbnm('m1','9',$_POST['annee'])+$pdf->sumbnm('m2','9',$_POST['annee']),1,0,'C',1,0);
$pdf->cell(20,5,$pdf->sumbnm('m1','10',$_POST['annee'])+$pdf->sumbnm('m2','10',$_POST['annee']),1,0,'C',1,0);
$pdf->cell(20,5,$pdf->sumbnm('m1','11',$_POST['annee'])+$pdf->sumbnm('m2','11',$_POST['annee']),1,0,'C',1,0);
$pdf->cell(20,5,$pdf->sumbnm('m1','12',$_POST['annee'])+$pdf->sumbnm('m2','12',$_POST['annee']),1,0,'C',1,0);
$pdf->cell(20,5,$pdf->sumbnm('m1','1',$_POST['annee'])+$pdf->sumbnm('m2','1',$_POST['annee'])+$pdf->sumbnm('m1','2',$_POST['annee'])+$pdf->sumbnm('m2','2',$_POST['annee'])+$pdf->sumbnm('m1','3',$_POST['annee'])+$pdf->sumbnm('m2','3',$_POST['annee'])+$pdf->sumbnm('m1','4',$_POST['annee'])+$pdf->sumbnm('m2','4',$_POST['annee'])+$pdf->sumbnm('m1','5',$_POST['annee'])+$pdf->sumbnm('m2','5',$_POST['annee'])+$pdf->sumbnm('m1','6',$_POST['annee'])+$pdf->sumbnm('m2','6',$_POST['annee'])+$pdf->sumbnm('m1','7',$_POST['annee'])+$pdf->sumbnm('m2','7',$_POST['annee'])+$pdf->sumbnm('m1','8',$_POST['annee'])+$pdf->sumbnm('m2','8',$_POST['annee'])+$pdf->sumbnm('m1','9',$_POST['annee'])+$pdf->sumbnm('m2','9',$_POST['annee'])+$pdf->sumbnm('m1','10',$_POST['annee'])+$pdf->sumbnm('m2','10',$_POST['annee'])+$pdf->sumbnm('m1','11',$_POST['annee'])+$pdf->sumbnm('m2','11',$_POST['annee'])+$pdf->sumbnm('m1','12',$_POST['annee'])+$pdf->sumbnm('m2','12',$_POST['annee']),1,0,'C',1,0);
}

if ($_POST['BNM']=='3') //3eme partie
{
$pdf->AddPage('L','A4');
$pdf->SetDisplayMode('fullpage','single');//mode d affichage 
$pdf->SetFont('Arial','B',9);

$pdf->SetXY(05,5); $pdf->cell(285,5,"REPUBLIQUE ALGERIENNE DEMOCRATIQUE ET POPULAIRE",0,0,'C',0,0);
$pdf->SetXY(05,10);$pdf->cell(285,5,"MINISTERE DE LA SANTE DE LA POPULATION ET DE LA REFORME HOSPITALIERE",0,0,'C',0,0);
$pdf->SetXY(05,15);$pdf->cell(285,5,"DIRECTION DE LA SANTE ET DE LA POPULATION DE LA WILAYA DE DJELFA",0,0,'C',0,0);
$pdf->SetXY(05,20);$pdf->cell(142,5,"SERVICE PREVENTION",0,0,'L',0,0);$pdf->cell(142,5," LE : ".date ('d-m-Y'),0,0,'R',0,0);
$pdf->SetXY(05,25);$pdf->cell(142,5,"N               / ".$_POST['annee'],0,0,'L',0,0);
$pdf->SetXY(60,30);$pdf->cell(100,5,"Mouvement De La Population",0,0,'L',0,0);
$pdf->SetXY(60,35);$pdf->cell(100,5,"Annee  ".$_POST['annee'],0,0,'L',0,0);
$pdf->SetXY(60,40);$pdf->cell(100,5,"Deces Par Mois Et Par Sexe",0,0,'L',0,0);
$pdf->SetFillColor(200 );
$pdf->SetXY(05,50);$pdf->cell(25,5,"Mois",1,0,'L',1,0);$pdf->cell(20,5,"Janvier",1,0,'C',1,0);$pdf->cell(20,5,"Fevrier",1,0,'C',1,0);$pdf->cell(20,5,"Mars",1,0,'C',1,0);$pdf->cell(20,5,"Avril",1,0,'C',1,0);$pdf->cell(20,5,"Mai",1,0,'C',1,0);$pdf->cell(20,5,"Juin",1,0,'C',1,0);$pdf->cell(20,5,"Juillet",1,0,'C',1,0);$pdf->cell(20,5,"Aout",1,0,'C',1,0);$pdf->cell(20,5,"Septembre",1,0,'C',1,0);$pdf->cell(20,5,"October",1,0,'C',1,0);$pdf->cell(20,5,"Novombre",1,0,'C',1,0);$pdf->cell(20,5,"Decembre",1,0,'C',1,0);$pdf->cell(20,5,"Total",1,0,'C',1,0);
$pdf->SetXY(05,55);$pdf->cell(25,5,"Commune",1,0,1,'L',0);
$pdf->cell(10,5,"Mas",1,0,'C',1,0);$pdf->cell(10,5,"Fem",1,0,'C',1,0);
$pdf->cell(10,5,"Mas",1,0,'C',1,0);$pdf->cell(10,5,"Fem",1,0,'C',1,0);
$pdf->cell(10,5,"Mas",1,0,'C',1,0);$pdf->cell(10,5,"Fem",1,0,'C',1,0);
$pdf->cell(10,5,"Mas",1,0,'C',1,0);$pdf->cell(10,5,"Fem",1,0,'C',1,0);
$pdf->cell(10,5,"Mas",1,0,'C',1,0);$pdf->cell(10,5,"Fem",1,0,'C',1,0);
$pdf->cell(10,5,"Mas",1,0,'C',1,0);$pdf->cell(10,5,"Fem",1,0,'C',1,0);
$pdf->cell(10,5,"Mas",1,0,'C',1,0);$pdf->cell(10,5,"Fem",1,0,'C',1,0);
$pdf->cell(10,5,"Mas",1,0,'C',1,0);$pdf->cell(10,5,"Fem",1,0,'C',1,0);
$pdf->cell(10,5,"Mas",1,0,'C',1,0);$pdf->cell(10,5,"Fem",1,0,'C',1,0);
$pdf->cell(10,5,"Mas",1,0,'C',1,0);$pdf->cell(10,5,"Fem",1,0,'C',1,0);
$pdf->cell(10,5,"Mas",1,0,'C',1,0);$pdf->cell(10,5,"Fem",1,0,'C',1,0);
$pdf->cell(10,5,"Mas",1,0,'C',1,0);$pdf->cell(10,5,"Fem",1,0,'C',1,0);
$pdf->cell(10,5,"Mas",1,0,'C',1,0);$pdf->cell(10,5,"Fem",1,0,'C',1,0);
$pdf->mysqlconnect();
$query = "SELECT * from COM where IDWIL='17000' and yes='1' order by COMMUNE "; 
$pdf->SetXY(05,60); 
$resultat=mysql_query($query);
$totalmbr1=mysql_num_rows($resultat);
while($row=mysql_fetch_object($resultat))
{
$pdf->cell(25,5,$row->COMMUNE,1,0,'l',0);
$pdf->cell(10,5,$pdf->Dbnm('m',$row->IDCOM,'01',$_POST['annee']),1,0,'C',0);$pdf->cell(10,5,$pdf->Dbnm('f',$row->IDCOM,'01',$_POST['annee']),1,0,'C',0);
$pdf->cell(10,5,$pdf->Dbnm('m',$row->IDCOM,'02',$_POST['annee']),1,0,'C',0);$pdf->cell(10,5,$pdf->Dbnm('f',$row->IDCOM,'02',$_POST['annee']),1,0,'C',0);
$pdf->cell(10,5,$pdf->Dbnm('m',$row->IDCOM,'03',$_POST['annee']),1,0,'C',0);$pdf->cell(10,5,$pdf->Dbnm('f',$row->IDCOM,'03',$_POST['annee']),1,0,'C',0);
$pdf->cell(10,5,$pdf->Dbnm('m',$row->IDCOM,'04',$_POST['annee']),1,0,'C',0);$pdf->cell(10,5,$pdf->Dbnm('f',$row->IDCOM,'04',$_POST['annee']),1,0,'C',0);
$pdf->cell(10,5,$pdf->Dbnm('m',$row->IDCOM,'05',$_POST['annee']),1,0,'C',0);$pdf->cell(10,5,$pdf->Dbnm('f',$row->IDCOM,'05',$_POST['annee']),1,0,'C',0);
$pdf->cell(10,5,$pdf->Dbnm('m',$row->IDCOM,'06',$_POST['annee']),1,0,'C',0);$pdf->cell(10,5,$pdf->Dbnm('f',$row->IDCOM,'06',$_POST['annee']),1,0,'C',0);
$pdf->cell(10,5,$pdf->Dbnm('m',$row->IDCOM,'07',$_POST['annee']),1,0,'C',0);$pdf->cell(10,5,$pdf->Dbnm('f',$row->IDCOM,'07',$_POST['annee']),1,0,'C',0);
$pdf->cell(10,5,$pdf->Dbnm('m',$row->IDCOM,'08',$_POST['annee']),1,0,'C',0);$pdf->cell(10,5,$pdf->Dbnm('f',$row->IDCOM,'08',$_POST['annee']),1,0,'C',0);
$pdf->cell(10,5,$pdf->Dbnm('m',$row->IDCOM,'09',$_POST['annee']),1,0,'C',0);$pdf->cell(10,5,$pdf->Dbnm('f',$row->IDCOM,'09',$_POST['annee']),1,0,'C',0);
$pdf->cell(10,5,$pdf->Dbnm('m',$row->IDCOM,'10',$_POST['annee']),1,0,'C',0);$pdf->cell(10,5,$pdf->Dbnm('f',$row->IDCOM,'10',$_POST['annee']),1,0,'C',0);
$pdf->cell(10,5,$pdf->Dbnm('m',$row->IDCOM,'11',$_POST['annee']),1,0,'C',0);$pdf->cell(10,5,$pdf->Dbnm('f',$row->IDCOM,'11',$_POST['annee']),1,0,'C',0);
$pdf->cell(10,5,$pdf->Dbnm('m',$row->IDCOM,'12',$_POST['annee']),1,0,'C',0);$pdf->cell(10,5,$pdf->Dbnm('f',$row->IDCOM,'12',$_POST['annee']),1,0,'C',0);


$pdf->cell(10,5,$pdf->Dbnm('m',$row->IDCOM,'1',$_POST['annee']) + $pdf->Dbnm('m',$row->IDCOM,'2',$_POST['annee']) + $pdf->Dbnm('m',$row->IDCOM,'3',$_POST['annee']) + $pdf->Dbnm('m',$row->IDCOM,'4',$_POST['annee']) + $pdf->Dbnm('m',$row->IDCOM,'5',$_POST['annee']) + $pdf->Dbnm('m',$row->IDCOM,'6',$_POST['annee']) + $pdf->Dbnm('m',$row->IDCOM,'7',$_POST['annee']) + $pdf->Dbnm('m',$row->IDCOM,'8',$_POST['annee']) + $pdf->Dbnm('m',$row->IDCOM,'9',$_POST['annee']) + $pdf->Dbnm('m',$row->IDCOM,'10',$_POST['annee']) + $pdf->Dbnm('m',$row->IDCOM,'11',$_POST['annee']) + $pdf->Dbnm('m',$row->IDCOM,'12',$_POST['annee']) ,1,0,'C',0);
$pdf->cell(10,5,$pdf->Dbnm('f',$row->IDCOM,'1',$_POST['annee']) + $pdf->Dbnm('f',$row->IDCOM,'2',$_POST['annee']) + $pdf->Dbnm('f',$row->IDCOM,'3',$_POST['annee']) + $pdf->Dbnm('f',$row->IDCOM,'4',$_POST['annee']) + $pdf->Dbnm('f',$row->IDCOM,'5',$_POST['annee']) + $pdf->Dbnm('f',$row->IDCOM,'6',$_POST['annee']) + $pdf->Dbnm('f',$row->IDCOM,'7',$_POST['annee']) + $pdf->Dbnm('f',$row->IDCOM,'8',$_POST['annee']) + $pdf->Dbnm('f',$row->IDCOM,'9',$_POST['annee']) + $pdf->Dbnm('f',$row->IDCOM,'10',$_POST['annee']) + $pdf->Dbnm('f',$row->IDCOM,'11',$_POST['annee']) + $pdf->Dbnm('f',$row->IDCOM,'12',$_POST['annee']) ,1,0,'C',0);


$pdf->setxy(5,$pdf->gety()+5); 
}
$pdf->SetXY(05,65);$pdf->cell(25,5,"Total",1,0,1,'L',0);
$pdf->cell(10,5,$pdf->sumDbnm('m','1',$_POST['annee']),1,0,'C',1,0);$pdf->cell(10,5,$pdf->sumDbnm('f','1',$_POST['annee']),1,0,'C',1,0);
$pdf->cell(10,5,$pdf->sumDbnm('m','2',$_POST['annee']),1,0,'C',1,0);$pdf->cell(10,5,$pdf->sumDbnm('f','2',$_POST['annee']),1,0,'C',1,0);
$pdf->cell(10,5,$pdf->sumDbnm('m','3',$_POST['annee']),1,0,'C',1,0);$pdf->cell(10,5,$pdf->sumDbnm('f','3',$_POST['annee']),1,0,'C',1,0);
$pdf->cell(10,5,$pdf->sumDbnm('m','4',$_POST['annee']),1,0,'C',1,0);$pdf->cell(10,5,$pdf->sumDbnm('f','4',$_POST['annee']),1,0,'C',1,0);
$pdf->cell(10,5,$pdf->sumDbnm('m','5',$_POST['annee']),1,0,'C',1,0);$pdf->cell(10,5,$pdf->sumDbnm('f','5',$_POST['annee']),1,0,'C',1,0);
$pdf->cell(10,5,$pdf->sumDbnm('m','6',$_POST['annee']),1,0,'C',1,0);$pdf->cell(10,5,$pdf->sumDbnm('f','6',$_POST['annee']),1,0,'C',1,0);
$pdf->cell(10,5,$pdf->sumDbnm('m','7',$_POST['annee']),1,0,'C',1,0);$pdf->cell(10,5,$pdf->sumDbnm('f','7',$_POST['annee']),1,0,'C',1,0);
$pdf->cell(10,5,$pdf->sumDbnm('m','8',$_POST['annee']),1,0,'C',1,0);$pdf->cell(10,5,$pdf->sumDbnm('f','8',$_POST['annee']),1,0,'C',1,0);
$pdf->cell(10,5,$pdf->sumDbnm('m','9',$_POST['annee']),1,0,'C',1,0);$pdf->cell(10,5,$pdf->sumDbnm('f','9',$_POST['annee']),1,0,'C',1,0);
$pdf->cell(10,5,$pdf->sumDbnm('m','10',$_POST['annee']),1,0,'C',1,0);$pdf->cell(10,5,$pdf->sumDbnm('f','10',$_POST['annee']),1,0,'C',1,0);
$pdf->cell(10,5,$pdf->sumDbnm('m','11',$_POST['annee']),1,0,'C',1,0);$pdf->cell(10,5,$pdf->sumDbnm('f','11',$_POST['annee']),1,0,'C',1,0);
$pdf->cell(10,5,$pdf->sumDbnm('m','12',$_POST['annee']),1,0,'C',1,0);$pdf->cell(10,5,$pdf->sumDbnm('f','12',$_POST['annee']),1,0,'C',1,0);
$pdf->cell(10,5,$pdf->sumDbnm('m','1',$_POST['annee'])+$pdf->sumDbnm('m','2',$_POST['annee'])+$pdf->sumDbnm('m','3',$_POST['annee'])+$pdf->sumDbnm('m','4',$_POST['annee'])+$pdf->sumDbnm('m','5',$_POST['annee'])+$pdf->sumDbnm('m','6',$_POST['annee'])+$pdf->sumDbnm('m','7',$_POST['annee'])+$pdf->sumDbnm('m','8',$_POST['annee'])+$pdf->sumDbnm('m','9',$_POST['annee'])+$pdf->sumDbnm('m','10',$_POST['annee'])+$pdf->sumDbnm('m','11',$_POST['annee'])+$pdf->sumDbnm('m','12',$_POST['annee']),1,0,'C',1,0);
$pdf->cell(10,5,$pdf->sumDbnm('f','1',$_POST['annee'])+$pdf->sumDbnm('f','2',$_POST['annee'])+$pdf->sumDbnm('f','3',$_POST['annee'])+$pdf->sumDbnm('f','4',$_POST['annee'])+$pdf->sumDbnm('f','5',$_POST['annee'])+$pdf->sumDbnm('f','6',$_POST['annee'])+$pdf->sumDbnm('f','7',$_POST['annee'])+$pdf->sumDbnm('f','8',$_POST['annee'])+$pdf->sumDbnm('f','9',$_POST['annee'])+$pdf->sumDbnm('f','10',$_POST['annee'])+$pdf->sumDbnm('f','11',$_POST['annee'])+$pdf->sumDbnm('f','12',$_POST['annee']),1,0,'C',1,0);
}
if ($_POST['BNM']=='4') //4eme partie
{
$pdf->AddPage('L','A4');
$pdf->SetDisplayMode('fullpage','single');//mode d affichage 
$pdf->SetFont('Arial','B',9);

$pdf->SetXY(05,5); $pdf->cell(285,5,"REPUBLIQUE ALGERIENNE DEMOCRATIQUE ET POPULAIRE",0,0,'C',0,0);
$pdf->SetXY(05,10);$pdf->cell(285,5,"MINISTERE DE LA SANTE DE LA POPULATION ET DE LA REFORME HOSPITALIERE",0,0,'C',0,0);
$pdf->SetXY(05,15);$pdf->cell(285,5,"DIRECTION DE LA SANTE ET DE LA POPULATION DE LA WILAYA DE DJELFA",0,0,'C',0,0);
$pdf->SetXY(05,20);$pdf->cell(142,5,"SERVICE PREVENTION",0,0,'L',0,0);$pdf->cell(142,5," LE : ".date ('d-m-Y'),0,0,'R',0,0);
$pdf->SetXY(05,25);$pdf->cell(142,5,"N               / ".$_POST['annee'],0,0,'L',0,0);
$pdf->SetXY(60,30);$pdf->cell(100,5,"Mouvement De La Population",0,0,'L',0,0);
$pdf->SetXY(60,35);$pdf->cell(100,5,"Annee  ".$_POST['annee'],0,0,'L',0,0);
$pdf->SetXY(60,40);$pdf->cell(100,5,"Bordereau Numerique Mensuel Wilaya De djelfa",0,0,'L',0,0);
$pdf->SetXY(05,50);$pdf->cell(140,5,"1-Naisances Par Sexe Enregistrees Dans La Commune",1,0,'L',1,0);  
$pdf->SetXY(05,$pdf->GetY()+5);$pdf->cell(95,5,"",1,0,'L',0,0);$pdf->cell(15,5,"Masculin",1,0,'C',1,0);          $pdf->cell(15,5,"Feminin",1,0,'C',1,0);$pdf->cell(15,5,"Total",1,0,'C',1,0);
$pdf->SetXY(05,$pdf->GetY()+5);$pdf->cell(95,5,"Naissances Survenues Au cours Du Mois",1,0,'L',0,0);             $pdf->cell(15,5,$pdf->sumfbnm('nm1',$_POST['annee']),1,0,'C',0,0);$pdf->cell(15,5,$pdf->sumfbnm('nf1',$_POST['annee']),1,0,'C',0,0);$pdf->cell(15,5,$pdf->sumfbnm('nm1',$_POST['annee'])+$pdf->sumfbnm('nf1',$_POST['annee']),1,0,'C',0,0);
$pdf->SetXY(05,$pdf->GetY()+5);$pdf->cell(95,5,"Naissances Enregistrees Par Jugement",1,0,'L',0,0);              $pdf->cell(15,5,$pdf->sumfbnm('nm2',$_POST['annee']),1,0,'C',0,0);$pdf->cell(15,5,$pdf->sumfbnm('nf2',$_POST['annee']),1,0,'C',0,0);$pdf->cell(15,5,$pdf->sumfbnm('nm2',$_POST['annee'])+$pdf->sumfbnm('nf2',$_POST['annee']),1,0,'C',0,0);
$pdf->SetXY(05,$pdf->GetY()+5);$pdf->cell(95,5,"Total Des Naissances Enregistrees Au Cours Du Mois",1,0,'L',0,0);$pdf->cell(15,5,$pdf->sumfbnm('nm1',$_POST['annee'])+$pdf->sumfbnm('nm2',$_POST['annee']),1,0,'C',0,0);$pdf->cell(15,5,$pdf->sumfbnm('nf1',$_POST['annee'])+$pdf->sumfbnm('nf2',$_POST['annee']),1,0,'C',0,0);$pdf->cell(15,5,$pdf->sumfbnm('nm1',$_POST['annee'])+$pdf->sumfbnm('nf1',$_POST['annee'])+$pdf->sumfbnm('nm2',$_POST['annee'])+$pdf->sumfbnm('nf2',$_POST['annee']),1,0,'C',0,0);

$pdf->SetXY(05,$pdf->GetY()+15);$pdf->cell(140,5,"2-Mort Nees Enregistres Dans La Commune Selon Le Sexe",1,0,'L',1,0);  
$pdf->SetXY(05,$pdf->GetY()+5);$pdf->cell(95,5,"",1,0,'L',0,0);$pdf->cell(15,5,"Masculin",1,0,'C',1,0);           $pdf->cell(15,5,"Feminin",1,0,'C',1,0);$pdf->cell(15,5,"Total",1,0,'C',1,0);
$pdf->SetXY(05,$pdf->GetY()+5);$pdf->cell(95,5,"Total Des Mort Nees Enregistres Au Cours Du Mois",1,0,'L',0,0);   $pdf->cell(15,5,$pdf->sumfbnm('mnm1',$_POST['annee']),1,0,'C',0,0);$pdf->cell(15,5,$pdf->sumfbnm('mnf1',$_POST['annee']),1,0,'C',0,0);$pdf->cell(15,5,$pdf->sumfbnm('mnm1',$_POST['annee'])+$pdf->sumfbnm('mnf1',$_POST['annee']),1,0,'C',0,0);

$pdf->SetXY(05,$pdf->GetY()+15);$pdf->cell(140,5,"3-Mariages Enregistrees Dans La Commune",1,0,'L',1,0);  
$pdf->SetXY(05,$pdf->GetY()+5);$pdf->cell(95,5,"",1,0,'L',0,0);$pdf->cell(45,5,"Nombre",1,0,'C',1,0);         
$pdf->SetXY(05,$pdf->GetY()+5);$pdf->cell(95,5,"Mariages Enregistres Au Cours Du Mois",1,0,'L',0,0);               $pdf->cell(45,5,$pdf->sumfbnm('m1',$_POST['annee']),1,0,'C',0,0);
$pdf->SetXY(05,$pdf->GetY()+5);$pdf->cell(95,5,"Mariages Enregistres Par Jugement Au Cours Du Mois",1,0,'L',0,0);  $pdf->cell(45,5,$pdf->sumfbnm('m2',$_POST['annee']),1,0,'C',0,0);
$pdf->SetXY(05,$pdf->GetY()+5);$pdf->cell(95,5,"Total",1,0,'L',0,0);                                               $pdf->cell(45,5,$pdf->sumfbnm('m1',$_POST['annee'])+$pdf->sumfbnm('m2',$_POST['annee']),1,0,'C',0,0);

$pdf->SetXY(05,$pdf->GetY()+15);$pdf->cell(140,5,"4-Deces Enregistres Par Jugement Dans La Commune",1,0,'L',1,0);  
$pdf->SetXY(05,$pdf->GetY()+5);$pdf->cell(95,5,"",1,0,'L',0,0);$pdf->cell(15,5,"Masculin",1,0,'C',1,0);            $pdf->cell(15,5,"Feminin",1,0,'C',1,0);$pdf->cell(15,5,"Total",1,0,'C',1,0);
$pdf->SetXY(05,$pdf->GetY()+5);$pdf->cell(95,5,"Deces Enregistres Par Jugement Au Cours Du Mois",1,0,'L',0,0);     $pdf->cell(15,5,$pdf->sumfbnm('djm1',$_POST['annee']),1,0,'C',0,0);$pdf->cell(15,5,$pdf->sumfbnm('djf1',$_POST['annee']),1,0,'C',0,0);$pdf->cell(15,5,$pdf->sumfbnm('djm1',$_POST['annee'])+$pdf->sumfbnm('djf1',$_POST['annee']),1,0,'C',0,0);

$pdf->SetXY(150,50);$pdf->cell(140,5,"5-Deces Survenus Dans La Commune au cours du mois par groupe d age et par sexe",1,0,'L',1,0);
$pdf->SetXY(150,$pdf->GetY()+5);$pdf->cell(35,5,"Groupe D age",1,0,'C',1,0);$pdf->cell(35,5,"Masculin",1,0,'C',1,0);$pdf->cell(35,5,"Feminin",1,0,'C',1,0);$pdf->cell(35,5,"Total",1,0,'C',1,0);
$pdf->SetXY(150,$pdf->GetY()+5);$pdf->cell(35,5,"Moins d un an",1,0,'C',0,0);$pdf->cell(35,5,$pdf->sumfbnm('dm1',$_POST['annee']),1,0,'C',0,0);$pdf->cell(35,5,$pdf->sumfbnm('df1',$_POST['annee']),1,0,'C',0,0);$pdf->cell(35,5,$pdf->sumfbnm('dm1',$_POST['annee'])+$pdf->sumfbnm('df1',$_POST['annee']),1,0,'C',0,0);
$pdf->SetXY(150,$pdf->GetY()+5);$pdf->cell(35,5,"01-04",1,0,'C',0,0);        $pdf->cell(35,5,$pdf->sumfbnm('dm2',$_POST['annee']),1,0,'C',0,0);$pdf->cell(35,5,$pdf->sumfbnm('df2',$_POST['annee']),1,0,'C',0,0);$pdf->cell(35,5,$pdf->sumfbnm('dm2',$_POST['annee'])+$pdf->sumfbnm('df2',$_POST['annee']),1,0,'C',0,0);
$pdf->SetXY(150,$pdf->GetY()+5);$pdf->cell(35,5,"05-09",1,0,'C',0,0);        $pdf->cell(35,5,$pdf->sumfbnm('dm3',$_POST['annee']),1,0,'C',0,0);$pdf->cell(35,5,$pdf->sumfbnm('df3',$_POST['annee']),1,0,'C',0,0);$pdf->cell(35,5,$pdf->sumfbnm('dm3',$_POST['annee'])+$pdf->sumfbnm('df3',$_POST['annee']),1,0,'C',0,0);
$pdf->SetXY(150,$pdf->GetY()+5);$pdf->cell(35,5,"10-14",1,0,'C',0,0);        $pdf->cell(35,5,$pdf->sumfbnm('dm4',$_POST['annee']),1,0,'C',0,0);$pdf->cell(35,5,$pdf->sumfbnm('df4',$_POST['annee']),1,0,'C',0,0);$pdf->cell(35,5,$pdf->sumfbnm('dm4',$_POST['annee'])+$pdf->sumfbnm('df4',$_POST['annee']),1,0,'C',0,0);
$pdf->SetXY(150,$pdf->GetY()+5);$pdf->cell(35,5,"15-19",1,0,'C',0,0);        $pdf->cell(35,5,$pdf->sumfbnm('dm5',$_POST['annee']),1,0,'C',0,0);$pdf->cell(35,5,$pdf->sumfbnm('df5',$_POST['annee']),1,0,'C',0,0);$pdf->cell(35,5,$pdf->sumfbnm('dm5',$_POST['annee'])+$pdf->sumfbnm('df5',$_POST['annee']),1,0,'C',0,0);
$pdf->SetXY(150,$pdf->GetY()+5);$pdf->cell(35,5,"20-24",1,0,'C',0,0);        $pdf->cell(35,5,$pdf->sumfbnm('dm6',$_POST['annee']),1,0,'C',0,0);$pdf->cell(35,5,$pdf->sumfbnm('df6',$_POST['annee']),1,0,'C',0,0);$pdf->cell(35,5,$pdf->sumfbnm('dm6',$_POST['annee'])+$pdf->sumfbnm('df6',$_POST['annee']),1,0,'C',0,0);
$pdf->SetXY(150,$pdf->GetY()+5);$pdf->cell(35,5,"25-29",1,0,'C',0,0);        $pdf->cell(35,5,$pdf->sumfbnm('dm7',$_POST['annee']),1,0,'C',0,0);$pdf->cell(35,5,$pdf->sumfbnm('df7',$_POST['annee']),1,0,'C',0,0);$pdf->cell(35,5,$pdf->sumfbnm('dm7',$_POST['annee'])+$pdf->sumfbnm('df7',$_POST['annee']),1,0,'C',0,0);
$pdf->SetXY(150,$pdf->GetY()+5);$pdf->cell(35,5,"30-34",1,0,'C',0,0);        $pdf->cell(35,5,$pdf->sumfbnm('dm8',$_POST['annee']),1,0,'C',0,0);$pdf->cell(35,5,$pdf->sumfbnm('df8',$_POST['annee']),1,0,'C',0,0);$pdf->cell(35,5,$pdf->sumfbnm('dm8',$_POST['annee'])+$pdf->sumfbnm('df8',$_POST['annee']),1,0,'C',0,0);
$pdf->SetXY(150,$pdf->GetY()+5);$pdf->cell(35,5,"35-39",1,0,'C',0,0);        $pdf->cell(35,5,$pdf->sumfbnm('dm9',$_POST['annee']),1,0,'C',0,0);$pdf->cell(35,5,$pdf->sumfbnm('df9',$_POST['annee']),1,0,'C',0,0);$pdf->cell(35,5,$pdf->sumfbnm('dm9',$_POST['annee'])+$pdf->sumfbnm('df9',$_POST['annee']),1,0,'C',0,0);
$pdf->SetXY(150,$pdf->GetY()+5);$pdf->cell(35,5,"40-44",1,0,'C',0,0);        $pdf->cell(35,5,$pdf->sumfbnm('dm10',$_POST['annee']),1,0,'C',0,0);$pdf->cell(35,5,$pdf->sumfbnm('df10',$_POST['annee']),1,0,'C',0,0);$pdf->cell(35,5,$pdf->sumfbnm('dm10',$_POST['annee'])+$pdf->sumfbnm('df10',$_POST['annee']),1,0,'C',0,0);
$pdf->SetXY(150,$pdf->GetY()+5);$pdf->cell(35,5,"45-49",1,0,'C',0,0);        $pdf->cell(35,5,$pdf->sumfbnm('dm11',$_POST['annee']),1,0,'C',0,0);$pdf->cell(35,5,$pdf->sumfbnm('df11',$_POST['annee']),1,0,'C',0,0);$pdf->cell(35,5,$pdf->sumfbnm('dm11',$_POST['annee'])+$pdf->sumfbnm('df11',$_POST['annee']),1,0,'C',0,0);
$pdf->SetXY(150,$pdf->GetY()+5);$pdf->cell(35,5,"50-54",1,0,'C',0,0);        $pdf->cell(35,5,$pdf->sumfbnm('dm12',$_POST['annee']),1,0,'C',0,0);$pdf->cell(35,5,$pdf->sumfbnm('df12',$_POST['annee']),1,0,'C',0,0);$pdf->cell(35,5,$pdf->sumfbnm('dm12',$_POST['annee'])+$pdf->sumfbnm('df12',$_POST['annee']),1,0,'C',0,0);
$pdf->SetXY(150,$pdf->GetY()+5);$pdf->cell(35,5,"55-59",1,0,'C',0,0);        $pdf->cell(35,5,$pdf->sumfbnm('dm13',$_POST['annee']),1,0,'C',0,0);$pdf->cell(35,5,$pdf->sumfbnm('df13',$_POST['annee']),1,0,'C',0,0);$pdf->cell(35,5,$pdf->sumfbnm('dm13',$_POST['annee'])+$pdf->sumfbnm('df13',$_POST['annee']),1,0,'C',0,0);
$pdf->SetXY(150,$pdf->GetY()+5);$pdf->cell(35,5,"60-64",1,0,'C',0,0);        $pdf->cell(35,5,$pdf->sumfbnm('dm14',$_POST['annee']),1,0,'C',0,0);$pdf->cell(35,5,$pdf->sumfbnm('df14',$_POST['annee']),1,0,'C',0,0);$pdf->cell(35,5,$pdf->sumfbnm('dm14',$_POST['annee'])+$pdf->sumfbnm('df14',$_POST['annee']),1,0,'C',0,0);
$pdf->SetXY(150,$pdf->GetY()+5);$pdf->cell(35,5,"65-69",1,0,'C',0,0);        $pdf->cell(35,5,$pdf->sumfbnm('dm15',$_POST['annee']),1,0,'C',0,0);$pdf->cell(35,5,$pdf->sumfbnm('df15',$_POST['annee']),1,0,'C',0,0);$pdf->cell(35,5,$pdf->sumfbnm('dm15',$_POST['annee'])+$pdf->sumfbnm('df15',$_POST['annee']),1,0,'C',0,0);
$pdf->SetXY(150,$pdf->GetY()+5);$pdf->cell(35,5,"70-74",1,0,'C',0,0);        $pdf->cell(35,5,$pdf->sumfbnm('dm16',$_POST['annee']),1,0,'C',0,0);$pdf->cell(35,5,$pdf->sumfbnm('df16',$_POST['annee']),1,0,'C',0,0);$pdf->cell(35,5,$pdf->sumfbnm('dm16',$_POST['annee'])+$pdf->sumfbnm('df16',$_POST['annee']),1,0,'C',0,0);
$pdf->SetXY(150,$pdf->GetY()+5);$pdf->cell(35,5,"75-79",1,0,'C',0,0);        $pdf->cell(35,5,$pdf->sumfbnm('dm17',$_POST['annee']),1,0,'C',0,0);$pdf->cell(35,5,$pdf->sumfbnm('df17',$_POST['annee']),1,0,'C',0,0);$pdf->cell(35,5,$pdf->sumfbnm('dm17',$_POST['annee'])+$pdf->sumfbnm('df17',$_POST['annee']),1,0,'C',0,0);
$pdf->SetXY(150,$pdf->GetY()+5);$pdf->cell(35,5,"80-84",1,0,'C',0,0);        $pdf->cell(35,5,$pdf->sumfbnm('dm18',$_POST['annee']),1,0,'C',0,0);$pdf->cell(35,5,$pdf->sumfbnm('df18',$_POST['annee']),1,0,'C',0,0);$pdf->cell(35,5,$pdf->sumfbnm('dm18',$_POST['annee'])+$pdf->sumfbnm('df18',$_POST['annee']),1,0,'C',0,0);
$pdf->SetXY(150,$pdf->GetY()+5);$pdf->cell(35,5,"85 et plus ",1,0,'C',0,0);  $pdf->cell(35,5,$pdf->sumfbnm('dm19',$_POST['annee']),1,0,'C',0,0);$pdf->cell(35,5,$pdf->sumfbnm('df19',$_POST['annee']),1,0,'C',0,0);$pdf->cell(35,5,$pdf->sumfbnm('dm19',$_POST['annee'])+$pdf->sumfbnm('df19',$_POST['annee']),1,0,'C',0,0);
$pdf->SetXY(150,$pdf->GetY()+5);$pdf->cell(35,5,"Total ",1,0,'C',0,0);       
$pdf->cell(35,5,$pdf->sumfbnm('dm1',$_POST['annee'])+$pdf->sumfbnm('dm2',$_POST['annee'])+$pdf->sumfbnm('dm3',$_POST['annee'])+$pdf->sumfbnm('dm4',$_POST['annee'])+$pdf->sumfbnm('dm5',$_POST['annee'])+$pdf->sumfbnm('dm6',$_POST['annee'])+$pdf->sumfbnm('dm7',$_POST['annee'])+$pdf->sumfbnm('dm8',$_POST['annee'])+$pdf->sumfbnm('dm9',$_POST['annee'])+$pdf->sumfbnm('dm10',$_POST['annee'])+$pdf->sumfbnm('dm11',$_POST['annee'])+$pdf->sumfbnm('dm12',$_POST['annee'])+$pdf->sumfbnm('dm13',$_POST['annee'])+$pdf->sumfbnm('dm14',$_POST['annee'])+$pdf->sumfbnm('dm15',$_POST['annee'])+$pdf->sumfbnm('dm16',$_POST['annee'])+$pdf->sumfbnm('dm17',$_POST['annee'])+$pdf->sumfbnm('dm18',$_POST['annee'])+$pdf->sumfbnm('dm19',$_POST['annee']),1,0,'C',0,0);
$pdf->cell(35,5,$pdf->sumfbnm('df1',$_POST['annee'])+$pdf->sumfbnm('df2',$_POST['annee'])+$pdf->sumfbnm('df3',$_POST['annee'])+$pdf->sumfbnm('df4',$_POST['annee'])+$pdf->sumfbnm('df5',$_POST['annee'])+$pdf->sumfbnm('df6',$_POST['annee'])+$pdf->sumfbnm('df7',$_POST['annee'])+$pdf->sumfbnm('df8',$_POST['annee'])+$pdf->sumfbnm('df9',$_POST['annee'])+$pdf->sumfbnm('df10',$_POST['annee'])+$pdf->sumfbnm('df11',$_POST['annee'])+$pdf->sumfbnm('df12',$_POST['annee'])+$pdf->sumfbnm('df13',$_POST['annee'])+$pdf->sumfbnm('df14',$_POST['annee'])+$pdf->sumfbnm('df15',$_POST['annee'])+$pdf->sumfbnm('df16',$_POST['annee'])+$pdf->sumfbnm('df17',$_POST['annee'])+$pdf->sumfbnm('df18',$_POST['annee'])+$pdf->sumfbnm('df19',$_POST['annee']),1,0,'C',0,0);
$pdf->cell(35,5,$pdf->sumfbnm('dm1',$_POST['annee'])+$pdf->sumfbnm('dm2',$_POST['annee'])+$pdf->sumfbnm('dm3',$_POST['annee'])+$pdf->sumfbnm('dm4',$_POST['annee'])+$pdf->sumfbnm('dm5',$_POST['annee'])+$pdf->sumfbnm('dm6',$_POST['annee'])+$pdf->sumfbnm('dm7',$_POST['annee'])+$pdf->sumfbnm('dm8',$_POST['annee'])+$pdf->sumfbnm('dm9',$_POST['annee'])+$pdf->sumfbnm('dm10',$_POST['annee'])+$pdf->sumfbnm('dm11',$_POST['annee'])+$pdf->sumfbnm('dm12',$_POST['annee'])+$pdf->sumfbnm('dm13',$_POST['annee'])+$pdf->sumfbnm('dm14',$_POST['annee'])+$pdf->sumfbnm('dm15',$_POST['annee'])+$pdf->sumfbnm('dm16',$_POST['annee'])+$pdf->sumfbnm('dm17',$_POST['annee'])+$pdf->sumfbnm('dm18',$_POST['annee'])+$pdf->sumfbnm('dm19',$_POST['annee'])+$pdf->sumfbnm('df1',$_POST['annee'])+$pdf->sumfbnm('df2',$_POST['annee'])+$pdf->sumfbnm('df3',$_POST['annee'])+$pdf->sumfbnm('df4',$_POST['annee'])+$pdf->sumfbnm('df5',$_POST['annee'])+$pdf->sumfbnm('df6',$_POST['annee'])+$pdf->sumfbnm('df7',$_POST['annee'])+$pdf->sumfbnm('df8',$_POST['annee'])+$pdf->sumfbnm('df9',$_POST['annee'])+$pdf->sumfbnm('df10',$_POST['annee'])+$pdf->sumfbnm('df11',$_POST['annee'])+$pdf->sumfbnm('df12',$_POST['annee'])+$pdf->sumfbnm('df13',$_POST['annee'])+$pdf->sumfbnm('df14',$_POST['annee'])+$pdf->sumfbnm('df15',$_POST['annee'])+$pdf->sumfbnm('df16',$_POST['annee'])+$pdf->sumfbnm('df17',$_POST['annee'])+$pdf->sumfbnm('df18',$_POST['annee'])+$pdf->sumfbnm('df19',$_POST['annee']),1,0,'C',0,0);
}
if ($_POST['BNM']=='5') //5eme partie
{
$mois="IS NOT NULL";$annee=$_POST['annee'];

$pdf->AddPage('P','A4');
$pdf->SetDisplayMode('fullpage','single');//mode d affichage 
$pdf->SetFont('Arial','B',9);
$pdf->SetXY(05,5); $pdf->cell(205,5,"REPUBLIQUE ALGERIENNE DEMOCRATIQUE ET POPULAIRE",0,0,'C',0,0);
$pdf->SetXY(05,10);$pdf->cell(205,5,"MINISTERE DE LA SANTE DE LA POPULATION ET DE LA REFORME HOSPITALIERE",0,0,'C',0,0);
$pdf->SetXY(05,15);$pdf->cell(205,5,"DIRECTION DE LA SANTE ET DE LA POPULATION DE LA WILAYA DE DJELFA",0,0,'C',0,0);
$pdf->SetXY(05,20);$pdf->cell(142,5,"SERVICE PREVENTION",0,0,'L',0,0);$pdf->cell(142,5," LE : ".date ('d-m-Y'),0,0,'R',0,0);
$pdf->SetXY(05,25);$pdf->cell(142,5,"N               / ".$_POST['annee'],0,0,'L',0,0);
$pdf->SetXY(60,30);$pdf->cell(100,5,"Mouvement De La Population Etat Civil ",0,0,'L',0,0);
$pdf->SetXY(60,35);$pdf->cell(100,5,"Annee  ".$_POST['annee'],0,0,'L',0,0);
$pdf->SetXY(60,40);$pdf->cell(100,5,"Naissances / Mariages / Deces ",0,0,'L',0,0);
$pdf->SetFillColor(200 );
$pdf->SetXY(05,50);$pdf->cell(25,5,"Mois",1,0,'L',1,0);

$pdf->cell(58,5,"Naissances",1,0,'C',1,0);$pdf->cell(58,5,html_entity_decode(utf8_decode("Mariages")),1,0,'C',1,0);$pdf->cell(58,5,html_entity_decode(utf8_decode("Deces Enregistrés")),1,0,'C',1,0); 
$pdf->SetXY(05,55);$pdf->cell(25,5,"Commune",1,0,1,'L',0);
$pdf->cell(19,5,"M",1,0,'C',1,0);$pdf->cell(19,5,"F",1,0,'C',1,0);$pdf->cell(20,5,"T",1,0,'C',1,0);
$pdf->cell(58,5,"",1,0,'C',1,0);
$pdf->cell(19,5,"N",1,0,'C',1,0);$pdf->cell(19,5,"j",1,0,'C',1,0);$pdf->cell(20,5,"T",1,0,'C',1,0);

$pdf->mysqlconnect();
$query = "SELECT * from COM where IDWIL='17000' and yes='1' order by COMMUNE "; 
$pdf->SetXY(05,60); 
$resultat=mysql_query($query);
$totalmbr1=mysql_num_rows($resultat);
while($row=mysql_fetch_object($resultat))
{


$nm=$pdf->bnm('nm1',$row->IDCOM,'1',$_POST['annee']) + $pdf->bnm('nm2',$row->IDCOM,'1',$_POST['annee'])+
$pdf->bnm('nm1',$row->IDCOM,'2',$_POST['annee']) + $pdf->bnm('nm2',$row->IDCOM,'2',$_POST['annee'])+
$pdf->bnm('nm1',$row->IDCOM,'3',$_POST['annee']) + $pdf->bnm('nm2',$row->IDCOM,'3',$_POST['annee'])+
$pdf->bnm('nm1',$row->IDCOM,'4',$_POST['annee']) + $pdf->bnm('nm2',$row->IDCOM,'4',$_POST['annee'])+
$pdf->bnm('nm1',$row->IDCOM,'5',$_POST['annee']) + $pdf->bnm('nm2',$row->IDCOM,'5',$_POST['annee'])+
$pdf->bnm('nm1',$row->IDCOM,'6',$_POST['annee']) + $pdf->bnm('nm2',$row->IDCOM,'6',$_POST['annee'])+
$pdf->bnm('nm1',$row->IDCOM,'7',$_POST['annee']) + $pdf->bnm('nm2',$row->IDCOM,'7',$_POST['annee'])+
$pdf->bnm('nm1',$row->IDCOM,'8',$_POST['annee']) + $pdf->bnm('nm2',$row->IDCOM,'8',$_POST['annee'])+
$pdf->bnm('nm1',$row->IDCOM,'9',$_POST['annee']) + $pdf->bnm('nm2',$row->IDCOM,'9',$_POST['annee'])+
$pdf->bnm('nm1',$row->IDCOM,'10',$_POST['annee']) + $pdf->bnm('nm2',$row->IDCOM,'10',$_POST['annee'])+
$pdf->bnm('nm1',$row->IDCOM,'11',$_POST['annee']) + $pdf->bnm('nm2',$row->IDCOM,'11',$_POST['annee'])+$pdf->bnm('nm1',$row->IDCOM,'12',$_POST['annee']) + $pdf->bnm('nm2',$row->IDCOM,'12',$_POST['annee']);
$nf = $pdf->bnm('nf1',$row->IDCOM,'1',$_POST['annee']) + $pdf->bnm('nf2',$row->IDCOM,'1',$_POST['annee'])+
$pdf->bnm('nf1',$row->IDCOM,'2',$_POST['annee']) + $pdf->bnm('nf2',$row->IDCOM,'2',$_POST['annee'])+
$pdf->bnm('nf1',$row->IDCOM,'3',$_POST['annee']) + $pdf->bnm('nf2',$row->IDCOM,'3',$_POST['annee'])+
$pdf->bnm('nf1',$row->IDCOM,'4',$_POST['annee']) + $pdf->bnm('nf2',$row->IDCOM,'4',$_POST['annee'])+
$pdf->bnm('nf1',$row->IDCOM,'5',$_POST['annee']) + $pdf->bnm('nf2',$row->IDCOM,'5',$_POST['annee'])+
$pdf->bnm('nf1',$row->IDCOM,'6',$_POST['annee']) + $pdf->bnm('nf2',$row->IDCOM,'6',$_POST['annee'])+
$pdf->bnm('nf1',$row->IDCOM,'7',$_POST['annee']) + $pdf->bnm('nf2',$row->IDCOM,'7',$_POST['annee'])+
$pdf->bnm('nf1',$row->IDCOM,'8',$_POST['annee']) + $pdf->bnm('nf2',$row->IDCOM,'8',$_POST['annee'])+
$pdf->bnm('nf1',$row->IDCOM,'9',$_POST['annee']) + $pdf->bnm('nf2',$row->IDCOM,'9',$_POST['annee'])+
$pdf->bnm('nf1',$row->IDCOM,'10',$_POST['annee']) + $pdf->bnm('nf2',$row->IDCOM,'10',$_POST['annee'])+
$pdf->bnm('nf1',$row->IDCOM,'11',$_POST['annee']) + $pdf->bnm('nf2',$row->IDCOM,'11',$_POST['annee'])+
$pdf->bnm('nf1',$row->IDCOM,'12',$_POST['annee']) + $pdf->bnm('nf2',$row->IDCOM,'12',$_POST['annee']);
$pdf->cell(25,5,$row->COMMUNE,1,0,'l',0);
$pdf->cell(19,5,$nm,1,0,'C',0);
$pdf->cell(19,5,$nf,1,0,'C',0);
$pdf->cell(20,5,$nm+$nf,1,0,'C',0);
$pdf->cell(58,5,
$pdf->bnm('m1',$row->IDCOM,'1',$_POST['annee']) + $pdf->bnm('m2',$row->IDCOM,'1',$_POST['annee'])+
$pdf->bnm('m1',$row->IDCOM,'2',$_POST['annee']) + $pdf->bnm('m2',$row->IDCOM,'2',$_POST['annee'])+
$pdf->bnm('m1',$row->IDCOM,'3',$_POST['annee']) + $pdf->bnm('m2',$row->IDCOM,'3',$_POST['annee'])+
$pdf->bnm('m1',$row->IDCOM,'4',$_POST['annee']) + $pdf->bnm('m2',$row->IDCOM,'4',$_POST['annee'])+
$pdf->bnm('m1',$row->IDCOM,'5',$_POST['annee']) + $pdf->bnm('m2',$row->IDCOM,'5',$_POST['annee'])+
$pdf->bnm('m1',$row->IDCOM,'6',$_POST['annee']) + $pdf->bnm('m2',$row->IDCOM,'6',$_POST['annee'])+
$pdf->bnm('m1',$row->IDCOM,'7',$_POST['annee']) + $pdf->bnm('m2',$row->IDCOM,'7',$_POST['annee'])+
$pdf->bnm('m1',$row->IDCOM,'8',$_POST['annee']) + $pdf->bnm('m2',$row->IDCOM,'8',$_POST['annee'])+
$pdf->bnm('m1',$row->IDCOM,'9',$_POST['annee']) + $pdf->bnm('m2',$row->IDCOM,'9',$_POST['annee'])+
$pdf->bnm('m1',$row->IDCOM,'10',$_POST['annee']) + $pdf->bnm('m2',$row->IDCOM,'10',$_POST['annee'])+
$pdf->bnm('m1',$row->IDCOM,'11',$_POST['annee']) + $pdf->bnm('m2',$row->IDCOM,'11',$_POST['annee'])+
$pdf->bnm('m1',$row->IDCOM,'12',$_POST['annee']) + $pdf->bnm('m2',$row->IDCOM,'12',$_POST['annee']),1,0,'C',0);
$a=$pdf->Dbnm('m',$row->IDCOM,'1',$_POST['annee']) + $pdf->Dbnm('m',$row->IDCOM,'2',$_POST['annee']) + $pdf->Dbnm('m',$row->IDCOM,'3',$_POST['annee']) + $pdf->Dbnm('m',$row->IDCOM,'4',$_POST['annee']) + $pdf->Dbnm('m',$row->IDCOM,'5',$_POST['annee']) + $pdf->Dbnm('m',$row->IDCOM,'6',$_POST['annee']) + $pdf->Dbnm('m',$row->IDCOM,'7',$_POST['annee']) + $pdf->Dbnm('m',$row->IDCOM,'8',$_POST['annee']) + $pdf->Dbnm('m',$row->IDCOM,'9',$_POST['annee']) + $pdf->Dbnm('m',$row->IDCOM,'10',$_POST['annee']) + $pdf->Dbnm('m',$row->IDCOM,'11',$_POST['annee']) + $pdf->Dbnm('m',$row->IDCOM,'12',$_POST['annee']);
$b=$pdf->Dbnm('f',$row->IDCOM,'1',$_POST['annee']) + $pdf->Dbnm('f',$row->IDCOM,'2',$_POST['annee']) + $pdf->Dbnm('f',$row->IDCOM,'3',$_POST['annee']) + $pdf->Dbnm('f',$row->IDCOM,'4',$_POST['annee']) + $pdf->Dbnm('f',$row->IDCOM,'5',$_POST['annee']) + $pdf->Dbnm('f',$row->IDCOM,'6',$_POST['annee']) + $pdf->Dbnm('f',$row->IDCOM,'7',$_POST['annee']) + $pdf->Dbnm('f',$row->IDCOM,'8',$_POST['annee']) + $pdf->Dbnm('f',$row->IDCOM,'9',$_POST['annee']) + $pdf->Dbnm('f',$row->IDCOM,'10',$_POST['annee']) + $pdf->Dbnm('f',$row->IDCOM,'11',$_POST['annee']) + $pdf->Dbnm('f',$row->IDCOM,'12',$_POST['annee']);  
$pdf->cell(19,5,$a ,1,0,'C',0);
$pdf->cell(19,5,$b,1,0,'C',0);
$pdf->cell(20,5,$a+$b,1,0,'C',0);
$pdf->setxy(5,$pdf->gety()+5); 
}
$pdf->SetXY(05,$pdf->gety());
$pdf->cell(25,5,"Total",1,0,'L',1,0);
$pdf->cell(19,5,"",1,0,'l',1,0);
$pdf->cell(19,5,"",1,0,'l',1,0);
$pdf->cell(20,5,"",1,0,'l',1,0);
$pdf->cell(58,5,"",1,0,'l',1,0);
$pdf->cell(19,5,"",1,0,'l',1,0);
$pdf->cell(19,5,"",1,0,'l',1,0);
$pdf->cell(20,5,"",1,0,'l',1,0);

$pdf->AddPage('P','A4');$pdf->SetDisplayMode('fullpage','single');$pdf->SetFont( 'Arial', '', 10 );
$pdf->SetXY(5,25);$pdf->cell(200,5,html_entity_decode(utf8_decode("I-Distribution des naissances par communes de Naissance (SIG) ")),1,0,'C',1,0);
$pdf->djelfa($pdf->bnmsig($mois,$annee,"1"),20,128,3.7,'commune');//commune//dairas 

$pdf->AddPage('P','A4');$pdf->SetDisplayMode('fullpage','single');$pdf->SetFont( 'Arial', '', 10 );
$pdf->SetXY(5,25);$pdf->cell(200,5,html_entity_decode(utf8_decode("II-Distribution des morts néés par communes de Naissance (SIG) ")),1,0,'C',1,0);
$pdf->djelfa($pdf->bnmsig($mois,$annee,"2"),20,128,3.7,'commune');//commune//dairas 

$pdf->AddPage('P','A4');$pdf->SetDisplayMode('fullpage','single');$pdf->SetFont( 'Arial', '', 10 );
$pdf->SetXY(5,25);$pdf->cell(200,5,html_entity_decode(utf8_decode("III-Distribution des mariages par communes de Naissance (SIG) ")),1,0,'C',1,0);
$pdf->djelfa($pdf->bnmsig($mois,$annee,"3"),20,128,3.7,'commune');//commune//dairas 

$pdf->AddPage('P','A4');$pdf->SetDisplayMode('fullpage','single');$pdf->SetFont( 'Arial', '', 10 );
$pdf->SetXY(5,25);$pdf->cell(200,5,html_entity_decode(utf8_decode("IV-Distribution des deces masculins par communes de Naissance (SIG) ")),1,0,'C',1,0);
$pdf->djelfa($pdf->bnmsig($mois,$annee,"4"),20,128,3.7,'commune');//commune//dairas 

$pdf->AddPage('P','A4');$pdf->SetDisplayMode('fullpage','single');$pdf->SetFont( 'Arial', '', 10 );
$pdf->SetXY(5,25);$pdf->cell(200,5,html_entity_decode(utf8_decode("V-Distribution des deces feminins par communes de Naissance (SIG) ")),1,0,'C',1,0);
$pdf->djelfa($pdf->bnmsig($mois,$annee,"5"),20,128,3.7,'commune');//commune//dairas 

$pdf->AddPage('P','A4');$pdf->SetDisplayMode('fullpage','single');$pdf->SetFont( 'Arial', '', 10 );
$pdf->SetXY(5,25);$pdf->cell(200,5,html_entity_decode(utf8_decode("VI-Distribution des deces par communes de Naissance (SIG) ")),1,0,'C',1,0);
$pdf->djelfa($pdf->bnmsig($mois,$annee,"6"),20,128,3.7,'commune');//commune//dairas 
}

$pdf->Output();
?>