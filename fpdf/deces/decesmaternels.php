<?php
require('deces.php');
$pdf = new deces();$pdf->AliasNbPages();

$pdf->SetFont('Arial','B',9);
$ID=$_GET["uc"];
$pdf->mysqlconnect();
$query = "SELECT * FROM deceshosp where id='".$ID."'  ";
$resultat=mysql_query($query);
$pdf->SetFont('Arial','B',10);
while($row=mysql_fetch_object($resultat))
{
for ($x = 1; $x <= 87; $x++) {
$pdf->AddPage();
$pdf->setSourceFile('DM2013.pdf');
$tplIdx = $pdf->importPage($x);
$pdf->useTemplate($tplIdx, 5, 5, 200);
$pdf->SetFont('Arial','B',10); 
} 

}	









$pdf->Output();
?>