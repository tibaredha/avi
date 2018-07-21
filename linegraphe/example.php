<?php

include('PHP2PDFGraphCompare.php');

$pdf = new PDF( '$p_orient', 'mm', '$p_size' );
$pdf->Open();
$pdf->AddPage();

// define position
$y = 30; 
$w = ($pdf->w - 20);
$h = 80;
$x = 15;
	
// define title	
$repTitle = "Visits";
				
$arrData = array();

// define old data
$arrData[] = array(
	"title" => "3 Months Ago",
	"color" => array(255,22,0),
	"data" => array(
		array(
			"key"   => 1,
			"value" => 3500
		),
		array(
			"key"   => 2,
			"value" => 900
		),
		array(
			"key"   => 3,
			"value" => 4100
		),
		array(
			"key"   => 4,
			"value" => 4100
		),
		array(
			"key"   => 5,
			"value" => 4000
		),
		array(
			"key"   => 6,
			"value" => 3700
		),
		array(
			"key"   => 7,
			"value" => 3100
		),
		array(
			"key"   => 8,
			"value" => 3900
		),
		array(
			"key"   => 9,
			"value" => 3200
		),
		array(
			"key"   => 10,
			"value" => 2850
		),
	)
);
// define old data
$arrData[] = array(
	"title" => "2 Months Ago",
	"color" => array(0,137,197),
	"data" => array(
		array(
			"key"   => 1,
			"value" => 2500
		),
		array(
			"key"   => 2,
			"value" => 1900
		),
		array(
			"key"   => 3,
			"value" => 3200
		),
		array(
			"key"   => 4,
			"value" => 3100
		),
		array(
			"key"   => 5,
			"value" => 3000
		),
		array(
			"key"   => 6,
			"value" => 2700
		),
		array(
			"key"   => 7,
			"value" => 2100
		),
		array(
			"key"   => 8,
			"value" => 1900
		),
		array(
			"key"   => 9,
			"value" => 2200
		),
		array(
			"key"   => 10,
			"value" => 3210
		),
	)
);
// define old data
$arrData[] = array(
	"title" => "Last Month",
	"color" => array(55,00,122),
	"data" => array(
		array(
			"key"   => 1,
			"value" => 800
		),
		array(
			"key"   => 2,
			"value" => 3100
		),
		array(
			"key"   => 3,
			"value" => 2700
		),
		array(
			"key"   => 4,
			"value" => 2100
		),
		array(
			"key"   => 5,
			"value" => 2000
		),
		array(
			"key"   => 6,
			"value" => 2700
		),
		array(
			"key"   => 7,
			"value" => 3000
		),
		array(
			"key"   => 8,
			"value" => 3600
		),
		array(
			"key"   => 9,
			"value" => 3250
		),
		array(
			"key"   => 10,
			"value" => 3150
		),
	)
);
// define current data
$arrData[] = array(
	"title" => "Current",
	"color" => array(237,125,22),
	"data" => array(
		array(
			"key"   => 1,
			"value" => 1800
		),
		array(
			"key"   => 2,
			"value" => 2900
		),
		array(
			"key"   => 3,
			"value" => 3700
		),
		array(
			"key"   => 4,
			"value" => 3100
		),
		array(
			"key"   => 5,
			"value" => 4100
		),
		array(
			"key"   => 6,
			"value" => 3800
		),
		array(
			"key"   => 7,
			"value" => 3900
		),
		array(
			"key"   => 8,
			"value" => 3600
		),
		array(
			"key"   => 9,
			"value" => 3800
		),
		array(
			"key"   => 10,
			"value" => 3750
		),
	)
);
// gen line charts
$pdf->LineChart($x,$y,$w,$h,$repTitle,$arrData);

// gen pdf file
$pdf->Output();