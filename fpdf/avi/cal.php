<?php
require('cavi.php');

$pdf = new cavi();$pdf->AliasNbPages();

$pdf->SetFillColor(230);//fond gris il faut ajouter au cell un autre parametre pour qui accepte la coloration
$pdf->SetTextColor(0,0,0);//text noire
$pdf->SetFont('Times', 'B', 10);
$pdf->AddPage('L','A4');$pdf->SetDisplayMode('fullpage','single'); $pdf->SetFont('Arial','B',9);
$pdf->SetXY(05,5); $pdf->cell(285,5,"REPUBLIQUE ALGERIENNE DEMOCRATIQUE ET POPULAIRE",0,0,'C',0,0);
$pdf->SetXY(05,10); $pdf->cell(285,5,"Calendrier vaccinal des poussins ",0,0,'C',0,0);
$id=$_POST['uc'];


// $date=date("d-m-y");
//partie normal
// $pdf->calvac($id);
// $pdf->SetMargins(7,7);
// $pdf->SetAutoPageBreak(false, 0);
// $year = gmdate("Y");
// $pdf->SetFillColor(0,255,0);                           
// for ($month = 1; $month <= 12; ++$month)
// {
// $date = $pdf->MDYtoJD($month, 1, $year);
// $pdf->printMonth($date,$id);
// }

//parti qui prend en charge  2 annees successives 	
$pdf->calvac($id);
$pdf->SetMargins(7,7);
$pdf->SetAutoPageBreak(false, 0);
$url = explode('-',$id);
$year = $url[0];
$pdf->SetFillColor(0,255,0);                           
for ($month = $url[1]; $month <= $url[1]+11; ++$month)
{
$date = $pdf->MDYtoJD($month, 1, $year);
$pdf->printMonth($date,$id);
}
	
	
	
	
	

$pdf->Output();
?>