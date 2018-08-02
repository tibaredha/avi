<?php
require('cavi.php');
$pdf = new cavi();$pdf->AliasNbPages();
$pdf->AddPage('L','A4');$pdf->SetDisplayMode('fullpage','single'); $pdf->SetFont('Arial','B',9);
$pdf->SetFillColor(230);//fond gris il faut ajouter au cell un autre parametre pour qui accepte la coloration
$pdf->SetTextColor(0,0,0);//text noire
$pdf->SetFont('Times', 'B', 10);
$pdf->SetXY(05,5); $pdf->cell(285,5,"REPUBLIQUE ALGERIENNE DEMOCRATIQUE ET POPULAIRE",0,0,'C',0,0);
$pdf->SetXY(05,10); $pdf->cell(285,5,"Echantillon des poussins representative du lot  (poids a jeun en grammes).   ",0,0,'C',0,0);
$date=date("d-m-y");



$pdf->Output();
?>