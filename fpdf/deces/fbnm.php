<?php
require('deces.php');
$pdf = new deces();$pdf->AliasNbPages();
$pdf->SetFillColor(230);//fond gris il faut ajouter au cell un autre parametre pour qui accepte la coloration
$pdf->SetTextColor(0,0,0);//text noire
$pdf->SetFont('Times', 'B', 10);
$pdf->AddPage('L','A4');
$pdf->SetDisplayMode('fullpage','single');//mode d affichage 
$pdf->SetFont('Arial','B',9);
$pdf->mysqlconnect();
$id=$_GET['uc'];
$query = "select * from Bordereau WHERE  id = '$id'     ";
$resultat=mysql_query($query);
while($result=mysql_fetch_object($resultat))//
{
$pdf->SetXY(05,5); $pdf->cell(285,5,html_entity_decode(utf8_decode($pdf->repfr)),0,0,'C',0,0);
$pdf->SetXY(05,10);$pdf->cell(285,5,html_entity_decode(utf8_decode($pdf->mspfr)),0,0,'C',0,0);
$pdf->SetXY(05,15);$pdf->cell(285,5,html_entity_decode(utf8_decode($pdf->dspfr)),0,0,'C',0,0);
$pdf->SetXY(05,20);$pdf->cell(142,5,"SERVICE PREVENTION",0,0,'L',0,0);$pdf->cell(142,5," LE : ".date ('d-m-Y'),0,0,'R',0,0);
$pdf->SetXY(05,25);$pdf->cell(142,5,"N ........... / ".$result->annee,0,0,'L',0,0);
$pdf->SetXY(60,30);$pdf->cell(100,5,"Mouvement De La Population",0,0,'L',0,0);
$pdf->SetXY(60,35);$pdf->cell(100,5,"Annee : ".$result->annee."   Mois : ".$result->mois."   Commune : ".$pdf->nbrtostring('com','IDCOM',$result->COMMUNED,'COMMUNE'),0,0,'L',0,0);        
$pdf->SetXY(60,40);$pdf->cell(100,5,"Bordereau Numerique Mensuel",0,0,'L',0,0);

$pdf->SetXY(05,50);$pdf->cell(140,5,"1-Naisances Par Sexe Enregistrees Dans La Commune",1,0,'L',1,0);  
$pdf->SetXY(05,$pdf->GetY()+5);$pdf->cell(95,5,"",1,0,'L',0,0);$pdf->cell(15,5,"Masculin",1,0,'C',1,0);          $pdf->cell(15,5,"Feminin",1,0,'C',1,0);$pdf->cell(15,5,"Total",1,0,'C',1,0);
$pdf->SetXY(05,$pdf->GetY()+5);$pdf->cell(95,5,"Naissances Survenues Au cours Du Mois",1,0,'L',0,0);             $pdf->cell(15,5,$result->nm1,1,0,'C',0,0);$pdf->cell(15,5,$result->nf1,1,0,'C',0,0);$pdf->cell(15,5,$result->nm1+$result->nf1,1,0,'C',0,0);
$pdf->SetXY(05,$pdf->GetY()+5);$pdf->cell(95,5,"Naissances Enregistrees Par Jugement",1,0,'L',0,0);              $pdf->cell(15,5,$result->nm2,1,0,'C',0,0);$pdf->cell(15,5,$result->nf2,1,0,'C',0,0);$pdf->cell(15,5,$result->nm2+$result->nf2,1,0,'C',0,0);
$pdf->SetXY(05,$pdf->GetY()+5);$pdf->cell(95,5,"Total Des Naissances Enregistrees Au Cours Du Mois",1,0,'L',0,0);$pdf->cell(15,5,$result->nm1+$result->nm2,1,0,'C',0,0);$pdf->cell(15,5,$result->nf1+$result->nf2,1,0,'C',0,0);$pdf->cell(15,5,$result->nm1+$result->nf1+$result->nm2+$result->nf2,1,0,'C',0,0);

$pdf->SetXY(05,$pdf->GetY()+15);$pdf->cell(140,5,"2-Mort Nees Enregistres Dans La Commune Selon Le Sexe",1,0,'L',1,0);  
$pdf->SetXY(05,$pdf->GetY()+5);$pdf->cell(95,5,"",1,0,'L',0,0);$pdf->cell(15,5,"Masculin",1,0,'C',1,0);           $pdf->cell(15,5,"Feminin",1,0,'C',1,0);$pdf->cell(15,5,"Total",1,0,'C',1,0);
$pdf->SetXY(05,$pdf->GetY()+5);$pdf->cell(95,5,"Total Des Mort Nees Enregistres Au Cours Du Mois",1,0,'L',0,0);   $pdf->cell(15,5,$result->mnm1,1,0,'C',0,0);$pdf->cell(15,5,$result->mnf1,1,0,'C',0,0);$pdf->cell(15,5,$result->mnm1+$result->mnf1,1,0,'C',0,0);

$pdf->SetXY(05,$pdf->GetY()+15);$pdf->cell(140,5,"3-Mariages Enregistrees Dans La Commune",1,0,'L',1,0);  
$pdf->SetXY(05,$pdf->GetY()+5);$pdf->cell(95,5,"",1,0,'L',0,0);$pdf->cell(45,5,"Nombre",1,0,'C',1,0);         
$pdf->SetXY(05,$pdf->GetY()+5);$pdf->cell(95,5,"Mariages Enregistres Au Cours Du Mois",1,0,'L',0,0);               $pdf->cell(45,5,$result->m1,1,0,'C',0,0);
$pdf->SetXY(05,$pdf->GetY()+5);$pdf->cell(95,5,"Mariages Enregistres Par Jugement Au Cours Du Mois",1,0,'L',0,0);  $pdf->cell(45,5,$result->m2,1,0,'C',0,0);
$pdf->SetXY(05,$pdf->GetY()+5);$pdf->cell(95,5,"Total",1,0,'L',0,0);                                               $pdf->cell(45,5,$result->m1+$result->m2,1,0,'C',0,0);

$pdf->SetXY(05,$pdf->GetY()+15);$pdf->cell(140,5,"4-Deces Enregistres Par Jugement Dans La Commune",1,0,'L',1,0);  
$pdf->SetXY(05,$pdf->GetY()+5);$pdf->cell(95,5,"",1,0,'L',0,0);$pdf->cell(15,5,"Masculin",1,0,'C',1,0);            $pdf->cell(15,5,"Feminin",1,0,'C',1,0);$pdf->cell(15,5,"Total",1,0,'C',1,0);
$pdf->SetXY(05,$pdf->GetY()+5);$pdf->cell(95,5,"Deces Enregistres Par Jugement Au Cours Du Mois",1,0,'L',0,0);     $pdf->cell(15,5,$result->djm1,1,0,'C',0,0);$pdf->cell(15,5,$result->djf1,1,0,'C',0,0);$pdf->cell(15,5,$result->djm1+$result->djf1,1,0,'C',0,0);

$pdf->SetXY(150,50);$pdf->cell(140,5,"5-Deces Survenus Dans La Commune au cours du mois par groupe d age et par sexe",1,0,'L',1,0);
$pdf->SetXY(150,$pdf->GetY()+5);$pdf->cell(35,5,"Groupe D age",1,0,'C',1,0);$pdf->cell(35,5,"Masculin",1,0,'C',1,0);$pdf->cell(35,5,"Feminin",1,0,'C',1,0);$pdf->cell(35,5,"Total",1,0,'C',1,0);
$pdf->SetXY(150,$pdf->GetY()+5);$pdf->cell(35,5,"Moins d un an",1,0,'C',0,0);$pdf->cell(35,5,$result->dm1,1,0,'C',0,0);$pdf->cell(35,5,$result->df1,1,0,'C',0,0);$pdf->cell(35,5,$result->dm1+$result->df1,1,0,'C',0,0);
$pdf->SetXY(150,$pdf->GetY()+5);$pdf->cell(35,5,"01-04",1,0,'C',0,0);        $pdf->cell(35,5,$result->dm2,1,0,'C',0,0);$pdf->cell(35,5,$result->df2,1,0,'C',0,0);$pdf->cell(35,5,$result->dm2+$result->df2,1,0,'C',0,0);
$pdf->SetXY(150,$pdf->GetY()+5);$pdf->cell(35,5,"05-09",1,0,'C',0,0);        $pdf->cell(35,5,$result->dm3,1,0,'C',0,0);$pdf->cell(35,5,$result->df3,1,0,'C',0,0);$pdf->cell(35,5,$result->dm3+$result->df3,1,0,'C',0,0);
$pdf->SetXY(150,$pdf->GetY()+5);$pdf->cell(35,5,"10-14",1,0,'C',0,0);        $pdf->cell(35,5,$result->dm4,1,0,'C',0,0);$pdf->cell(35,5,$result->df4,1,0,'C',0,0);$pdf->cell(35,5,$result->dm4+$result->df4,1,0,'C',0,0);
$pdf->SetXY(150,$pdf->GetY()+5);$pdf->cell(35,5,"15-19",1,0,'C',0,0);        $pdf->cell(35,5,$result->dm5,1,0,'C',0,0);$pdf->cell(35,5,$result->df5,1,0,'C',0,0);$pdf->cell(35,5,$result->dm5+$result->df5,1,0,'C',0,0);
$pdf->SetXY(150,$pdf->GetY()+5);$pdf->cell(35,5,"20-24",1,0,'C',0,0);        $pdf->cell(35,5,$result->dm6,1,0,'C',0,0);$pdf->cell(35,5,$result->df6,1,0,'C',0,0);$pdf->cell(35,5,$result->dm6+$result->df6,1,0,'C',0,0);
$pdf->SetXY(150,$pdf->GetY()+5);$pdf->cell(35,5,"25-29",1,0,'C',0,0);        $pdf->cell(35,5,$result->dm7,1,0,'C',0,0);$pdf->cell(35,5,$result->df7,1,0,'C',0,0);$pdf->cell(35,5,$result->dm7+$result->df7,1,0,'C',0,0);
$pdf->SetXY(150,$pdf->GetY()+5);$pdf->cell(35,5,"30-34",1,0,'C',0,0);        $pdf->cell(35,5,$result->dm8,1,0,'C',0,0);$pdf->cell(35,5,$result->df8,1,0,'C',0,0);$pdf->cell(35,5,$result->dm8+$result->df8,1,0,'C',0,0);
$pdf->SetXY(150,$pdf->GetY()+5);$pdf->cell(35,5,"35-39",1,0,'C',0,0);        $pdf->cell(35,5,$result->dm9,1,0,'C',0,0);$pdf->cell(35,5,$result->df9,1,0,'C',0,0);$pdf->cell(35,5,$result->dm9+$result->df9,1,0,'C',0,0);
$pdf->SetXY(150,$pdf->GetY()+5);$pdf->cell(35,5,"40-44",1,0,'C',0,0);        $pdf->cell(35,5,$result->dm10,1,0,'C',0,0);$pdf->cell(35,5,$result->df10,1,0,'C',0,0);$pdf->cell(35,5,$result->dm10+$result->df10,1,0,'C',0,0);
$pdf->SetXY(150,$pdf->GetY()+5);$pdf->cell(35,5,"45-49",1,0,'C',0,0);        $pdf->cell(35,5,$result->dm11,1,0,'C',0,0);$pdf->cell(35,5,$result->df11,1,0,'C',0,0);$pdf->cell(35,5,$result->dm11+$result->df11,1,0,'C',0,0);
$pdf->SetXY(150,$pdf->GetY()+5);$pdf->cell(35,5,"50-54",1,0,'C',0,0);        $pdf->cell(35,5,$result->dm12,1,0,'C',0,0);$pdf->cell(35,5,$result->df12,1,0,'C',0,0);$pdf->cell(35,5,$result->dm12+$result->df12,1,0,'C',0,0);
$pdf->SetXY(150,$pdf->GetY()+5);$pdf->cell(35,5,"55-59",1,0,'C',0,0);        $pdf->cell(35,5,$result->dm13,1,0,'C',0,0);$pdf->cell(35,5,$result->df13,1,0,'C',0,0);$pdf->cell(35,5,$result->dm13+$result->df13,1,0,'C',0,0);
$pdf->SetXY(150,$pdf->GetY()+5);$pdf->cell(35,5,"60-64",1,0,'C',0,0);        $pdf->cell(35,5,$result->dm14,1,0,'C',0,0);$pdf->cell(35,5,$result->df14,1,0,'C',0,0);$pdf->cell(35,5,$result->dm14+$result->df14,1,0,'C',0,0);
$pdf->SetXY(150,$pdf->GetY()+5);$pdf->cell(35,5,"65-69",1,0,'C',0,0);        $pdf->cell(35,5,$result->dm15,1,0,'C',0,0);$pdf->cell(35,5,$result->df15,1,0,'C',0,0);$pdf->cell(35,5,$result->dm15+$result->df15,1,0,'C',0,0);
$pdf->SetXY(150,$pdf->GetY()+5);$pdf->cell(35,5,"70-74",1,0,'C',0,0);        $pdf->cell(35,5,$result->dm16,1,0,'C',0,0);$pdf->cell(35,5,$result->df16,1,0,'C',0,0);$pdf->cell(35,5,$result->dm16+$result->df16,1,0,'C',0,0);
$pdf->SetXY(150,$pdf->GetY()+5);$pdf->cell(35,5,"75-79",1,0,'C',0,0);        $pdf->cell(35,5,$result->dm17,1,0,'C',0,0);$pdf->cell(35,5,$result->df17,1,0,'C',0,0);$pdf->cell(35,5,$result->dm17+$result->df17,1,0,'C',0,0);
$pdf->SetXY(150,$pdf->GetY()+5);$pdf->cell(35,5,"80-84",1,0,'C',0,0);        $pdf->cell(35,5,$result->dm18,1,0,'C',0,0);$pdf->cell(35,5,$result->df18,1,0,'C',0,0);$pdf->cell(35,5,$result->dm18+$result->df18,1,0,'C',0,0);
$pdf->SetXY(150,$pdf->GetY()+5);$pdf->cell(35,5,"85 et plus ",1,0,'C',0,0);  $pdf->cell(35,5,$result->dm19,1,0,'C',0,0);$pdf->cell(35,5,$result->df19,1,0,'C',0,0);$pdf->cell(35,5,$result->dm19+$result->df19,1,0,'C',0,0);
$pdf->SetXY(150,$pdf->GetY()+5);$pdf->cell(35,5,"Total ",1,0,'C',1,0);       
$pdf->cell(35,5,$result->dm1+$result->dm2+$result->dm3+$result->dm4+$result->dm5+$result->dm6+$result->dm7+$result->dm8+$result->dm9+$result->dm10+$result->dm11+$result->dm12+$result->dm13+$result->dm14+$result->dm15+$result->dm16+$result->dm17+$result->dm18+$result->dm19,1,0,'C',1,0);
$pdf->cell(35,5,$result->df1+$result->df2+$result->df3+$result->df4+$result->df5+$result->df6+$result->df7+$result->df8+$result->df9+$result->df10+$result->df11+$result->df12+$result->df13+$result->df14+$result->df15+$result->df16+$result->df17+$result->df18+$result->df19,1,0,'C',1,0);
$pdf->cell(35,5,$result->dm1+$result->dm2+$result->dm3+$result->dm4+$result->dm5+$result->dm6+$result->dm7+$result->dm8+$result->dm9+$result->dm10+$result->dm11+$result->dm12+$result->dm13+$result->dm14+$result->dm15+$result->dm16+$result->dm17+$result->dm18+$result->dm19+$result->df1+$result->df2+$result->df3+$result->df4+$result->df5+$result->df6+$result->df7+$result->df8+$result->df9+$result->df10+$result->df11+$result->df12+$result->df13+$result->df14+$result->df15+$result->df16+$result->df17+$result->df18+$result->df19,1,0,'C',1,0);
}
$pdf->SetXY(220,$pdf->GetY()+15);$pdf->cell(35,5,"Service prevention ",0,0,'C',0,0);
$pdf->SetXY(220,$pdf->GetY()+5);$pdf->cell(35,5,"Dr redha TIBA ",0,0,'C',0,0);
$pdf->Output();
?>