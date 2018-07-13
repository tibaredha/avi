<?php
$id=$_GET["uc"];
require('deces.php');
$pdf = new deces( 'P', 'mm', 'A4',true,'UTF-8',false );
$pdf->setPrintHeader(false);$pdf->SetAutoPageBreak(TRUE, 0);$pdf->setPrintFooter(false);
$pdf->AddPage('P','A4');
$pdf->setRTL(true); 
$pdf->RoundedRect($x=5, $y=5, $w=200, $h=285, $r=2, $round_corner='1111', $style='', $border_style=array(), $fill_color=array());
$pdf->RoundedRect($x=145, $y=46, $w=1, $h=244, $r=2, $round_corner='1111', $style='', $border_style=array(), $fill_color=array());
$pdf->SetFont('aefurat', '', 14);
$pdf->SetXY(5,10);$pdf->Cell(200,6,$pdf->repar,0,1,'C');
$pdf->SetXY(5,20);$pdf->Cell(200,6,$pdf->mspar,0,1,'C');
$pdf->SetXY(5,30);$pdf->Cell(200,6,$pdf->dspar,0,1,'C');
$pdf->SetFillColor(245);
$pdf->mysqlconnect();
$query = "select * from deceshosp WHERE  id = '$id'    ";
$resultat=mysql_query($query);
while($result=mysql_fetch_object($resultat))
{
$pdf->SetXY(65+5,$pdf->GetY()+10);$pdf->Cell(140-10,15,'التصريح بالوفـــاة',1,1,'C',1,0);
$pdf->SetXY(5+5,$pdf->GetY()-15);$pdf->Cell(50,15,'الموسسة '.$pdf->nbrtostring("structure","id",$result->STRUCTURED,"structurear"),1,1,'C',1,0);
$pdf->SetXY(5+5,$pdf->GetY());$pdf->Cell(50,15,'سعداوي المختار',1,1,'C',1,0);
$pdf->Text(65,$pdf->GetY()-10,$pdf->ANNEEAR($result->DINS));$pdf->Text(65+20,$pdf->GetY(),'..........................................................................................');
$pdf->Text(65,$pdf->GetY()+10,$pdf->JOURAR($result->DINS));$pdf->Text(65+20,$pdf->GetY(),'..........................................................................................');
$pdf->Text(65,$pdf->GetY()+10,$pdf->MOISAR($result->DINS));$pdf->Text(65+20,$pdf->GetY(),'..........................................................................................');
$pdf->Text(65,$pdf->GetY()+10,"نحن :".'...............');
$pdf->Text(65+30,$pdf->GetY(),"مدير المؤسسة العمومية ".'................................................');
$pdf->Text(140,$pdf->GetY(),$pdf->nbrtostring("structure","id",$result->STRUCTURED,"structurear"));
$pdf->Text(65,$pdf->GetY()+10,"نشعر رئيس المجلس الشعبي البلدي  ضابط الحلة المدنية ببلدية :".'...................');
$pdf->Text(175,$pdf->GetY(),$pdf->nbrtostring("structure","id",$result->STRUCTURED,"daira"));
$pdf->Text(65,$pdf->GetY()+10," انه و قي هذا اليوم و على الساعة : ".$pdf->HEURSAR($result->HINS));$pdf->Text(60+55,$pdf->GetY(),"..................................................................");
$pdf->Text(65,$pdf->GetY()+10,"والدقيقة : ".$pdf->MINUTEAR($result->HINS));$pdf->Text(82,$pdf->GetY(),".............................................................................................");
$pdf->Text(65,$pdf->GetY()+10,"توفي (ت) المسمى (ة) : ".$result->NOMAR."  ".$result->PRENOMAR);
$pdf->Text(65,$pdf->GetY()+10,"المولود (ة) : ".$result->DATENAISSANCE);
$pdf->Text(140,$pdf->GetY()," بـ : ".$pdf->nbrtostring("com","IDCOM",$result->COMMUNE,"communear")." ولاية ".$pdf->nbrtostring("wil","IDWIL",$result->WILAYA,"WILAYASAR") );
$pdf->Text(65,$pdf->GetY()+10,"إبن (ة) : ".$result->FILSDEAR);
$pdf->Text(140,$pdf->GetY(),"و : ".$result->ETDEAR);
$pdf->Text(65,$pdf->GetY()+10,"زوج (ة) : ".$result->NOMPRENOMAR);
$pdf->Text(65,$pdf->GetY()+10,"المهنة : ".$result->PROAR);
$pdf->Text(140,$pdf->GetY(),"عنوان الإقامة : ".$result->ADAR);
$pdf->Text(65,$pdf->GetY()+10,"دخل (ت) الى المستشفى يوم : ".$result->DATEHOSPI);
$pdf->Text(65,$pdf->GetY()+10,"و توفي (ت) يوم : ".$result->DINS);
$pdf->Text(140,$pdf->GetY(),"على الساعة : ".$result->HINS);
$pdf->Text(129,$pdf->GetY()+25,"في : ".$result->DINS);
$pdf->Text(150,$pdf->GetY()+10,"امضاء المدير");
$pdf->Text(25,$pdf->GetY()-10,"امضاء الطبيب");                             
$pdf->SetXY(5,$pdf->GetY()+10);$pdf->Cell(60,6,".......................................... ",0,1,'C');
$pdf->setRTL(false); $pdf->Text(150,$pdf->GetY()-8,$result->MEDECINHOSPIT);$pdf->setRTL(true); 
$pdf->Text(5,$pdf->GetY()+20,"الكتابة السابقة للاسم و اللقب :");
$pdf->Text(7,$pdf->GetY()+10,"_____________________");
$pdf->setRTL(false); $pdf->Text(150,$pdf->GetY(),$result->NOM);$pdf->setRTL(true); 
$pdf->Text(7,$pdf->GetY()+10,"_____________________");
$pdf->setRTL(false); $pdf->Text(150,$pdf->GetY(),$result->PRENOM);$pdf->setRTL(true); 
$nec =$result->id;
$pdf->SetXY(10,80);$pdf->Cell(50,15,'الرقم : '.date('Y').'/'.$nec,1,1,'C',1,0);
$pdf->SetXY(10,120);$pdf->Cell(50,10,'دفتر عائلي رقم : '.$nec,1,1,'C',1,0);
$pdf->SetXY(10,135);$pdf->Cell(50,10,'صادر بتاريخ : '.date('Y-m-d'),1,1,'C',1,0);
$pdf->SetXY(10,150);$pdf->Cell(50,10,'الجلفة',1,1,'C',1,0);
$pdf->SetFont('helvetica', '', 10);
// define barcode style
$style = array(
    'position' => '',
    'align' => 'R',
    'stretch' => false,
    'fitwidth' => false,
    'cellfitalign' => '',
    'border' => false,
    'hpadding' => 'auto',
    'vpadding' => 'auto',
    'fgcolor' => array(0,0,0),
    'bgcolor' => false, //array(255,255,255),
    'text' => true,
    'font' => 'helvetica',
    'fontsize' => 8,
    'stretchtext' => 4
);
$pdf->SetXY(10,99);$pdf->write1DBarcode($nec, 'C39', '', '', '', 18, 0.4, $style, 'N');
$pdf->Ln();
}
$pdf->AddPage('P','A4');
$pdf->setRTL(true); 
$pdf->RoundedRect($x=5, $y=5, $w=200, $h=285, $r=2, $round_corner='1111', $style='', $border_style=array(), $fill_color=array());
$pdf->RoundedRect($x=145, $y=46, $w=1, $h=244, $r=2, $round_corner='1111', $style='', $border_style=array(), $fill_color=array());
$pdf->SetFont('aefurat', '', 14);
$pdf->SetXY(5,10);$pdf->Cell(200,6,$pdf->repar,0,1,'C');
$pdf->SetXY(5,20);$pdf->Cell(200,6,$pdf->mspar,0,1,'C');
$pdf->SetXY(5,30);$pdf->Cell(200,6,$pdf->dspar,0,1,'C');
$pdf->SetFillColor(245);
$pdf->mysqlconnect();
$query = "select * from deceshosp WHERE  id = '$id'    ";
$resultat=mysql_query($query);
while($result=mysql_fetch_object($resultat))
{
$pdf->SetXY(65+5,$pdf->GetY()+10);$pdf->Cell(140-10,15,'رسالــــة تعزيــــــة',1,1,'C',1,0);
$pdf->SetXY(5+5,$pdf->GetY()-15);$pdf->Cell(50,15,'الموسسة '.$pdf->nbrtostring("structure","id",$result->STRUCTURED,"structurear"),1,1,'C',1,0);
$pdf->SetXY(5+5,$pdf->GetY());$pdf->Cell(50,15,'سعداوي المختار',1,1,'C',1,0);
$pdf->Text(65,$pdf->GetY()+10,'سلام الله عليكم ورحمته تعالى وبركاته.');
$pdf->Text(65,$pdf->GetY()+10,"نحن :".'...............');
$pdf->Text(65+30,$pdf->GetY(),"مدير المؤسسة العمومية ".'................................................');
$pdf->Text(140,$pdf->GetY(),$pdf->nbrtostring("structure","id",$result->STRUCTURED,"structurear"));
$pdf->Text(65,$pdf->GetY()+10,"أبلغت هذا اليوم بوفاة ");
$pdf->Text(65,$pdf->GetY()+10,"و بهذه المناسبة الأليمة أتقدم بعبارات العزاء لأخينا و كامل افراد عائلته  ");
$pdf->Text(65,$pdf->GetY()+10,"داعين للمرحوم بالثواب و المغفرة و لأهله بالصبر و السلوان. مع أصدق عبارات الود و المحبة");
$pdf->Text(129,$pdf->GetY()+25,"في : ".$result->DINS);
$pdf->Text(150,$pdf->GetY()+10,"امضاء المدير");
}





$pdf->Output();
?>


