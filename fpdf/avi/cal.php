<?php
require('cavi.php');

$pdf = new cavi();$pdf->AliasNbPages();
$date=date("d-m-y");
$pdf->SetFillColor(230);//fond gris il faut ajouter au cell un autre parametre pour qui accepte la coloration
$pdf->SetTextColor(0,0,0);//text noire
$pdf->SetFont('Times', 'B', 10);
$pdf->AddPage('L','A4');$pdf->SetDisplayMode('fullpage','single'); $pdf->SetFont('Arial','B',9);
$pdf->SetXY(05,5); $pdf->cell(285,5,"REPUBLIQUE ALGERIENNE DEMOCRATIQUE ET POPULAIRE",0,0,'C',0,0);
$pdf->SetXY(05,10); $pdf->cell(285,5,"Echantillon des poussins representative du lot  (poids a jeun en grammes).   ",0,0,'C',0,0);
$id=$_GET['uc'];
$pdf->calvac("2018-05-30");
$pdf->SetMargins(7,7);
$pdf->SetAutoPageBreak(false, 0);
$greyValue = 0;// set fill color for non-weekend holidays
$pdf->SetFillColor(0,255,0);
$year = gmdate("Y");// print the calendar for a whole year
for ($month = 1; $month <= 12; ++$month)
	{
	$date = $pdf->MDYtoJD($month, 1, $year);
	$pdf->printMonth($date,"2018-05-30");
	}
$pdf->Output();
?>