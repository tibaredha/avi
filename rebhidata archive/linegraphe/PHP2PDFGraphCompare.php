<?php

define('FPDF_FONTPATH','font/');
require('fpdf.php');

class PDF extends FPDF
{

	function PDF()
	{
		$this->FPDF();
	}
	
	function getMax($arrData) {
		$max = 0;
		for($ii=0;$ii<count($arrData);$ii++) {
			for($i=0;$i<count($arrData[$ii]['data']);$i++) {
				if($arrData[$ii]['data'][$i]['value'] > $max) $max = $arrData[$ii]['data'][$i]['value'];
			}
		}
		// set round to maximum
		$mxratio = ($max < 1000?1.6:1.2);

		$max = round($max*$mxratio);
		$max = ceil(round($max / 1000,1) * 1000);
		$max = ($max > 0?$max:50);
		
		return $max;
	
	}
	
	function LineChart($x,$y,$w,$h,$title,$arrData) {
		// get max value
		$max = $this->getMax($arrData);
		// define title
		$this->SetTextColor(155,155,155);
		$this->SetLineWidth(0.3);
		$this->SetFont('arial','b',12);
		$this->SetXY($x,$y-2);
		$this->Cell(150,6,$title,0,0,'L');
	    $this->SetDrawColor(170,170,170);
	    $this->SetLineWidth(0.3);
	    $this->Line($x,($y+3.5),125,($y+3.5));
	    $this->SetDrawColor(200,200,200);
	    $this->Line($x,($y+3.7),125,($y+3.7));
		// define lines title
		$this->SetFont('arial','',7);
		$wTitle = round(($w)/(count($arrData)));
		for($i=0;$i<count($arrData);$i++) {
			$this->Circle($x+0.5+($wTitle*$i), $y+10, 1.6, 0, 360, 'F','',array($arrData[$i]['color'][0],$arrData[$i]['color'][1],$arrData[$i]['color'][2]));
			$this->Text($x+4+($wTitle*$i),$y+11,$arrData[$i]['title']);
		}
		
		$curY = $y+12;
		
		// draw axis
    	$this->SetLineWidth(0.01);
    	$this->SetDrawColor(200,200,200);
    	$this->Line($x,($curY+$h-2),$w,($curY+$h-2));
    	
    	// get axis X points
    	$px = round(($w) / (count($arrData[0]['data'])),2);
    	$pyini = ($curY+2.5);
    	$pyend = ($curY+$h-2);
    	$pylong = $pyend-$pyini;
    	
    	$this->SetDrawColor(240,240,240);
    	$this->SetLineWidth(0.001);
		
		$this->Line($x,($curY+$h-$pylong),$w,($curY+$h-$pylong));
    	
    	$this->Line($x,($curY+$h-($pylong/2)),$w,($curY+$h-($pylong/2)));
    	
    	$this->SetLineWidth(0.5);
    	
    	$this->SetFont('arial','',5);
		
		// define Zero Zone
    	$zero = $curY+$h-2;
    	
    	for($ii=0;$ii<count($arrData);$ii++) {
		
			for($i=0;$i<count($arrData[$ii]['data']);$i++) {
		
				$this->SetLineWidth(0.8);
				
				// show horizontal text
				$this->Text(($x+($i*$px)),$curY+$h,$arrData[$ii]['data'][$i]['key']);

				// change color
				$this->SetDrawColor($arrData[$ii]['color'][0],$arrData[$ii]['color'][1],$arrData[$ii]['color'][2]);
				
				// get scale
				$yesc = round(($pylong / $max) * $arrData[$ii]['data'][$i]['value']);

				// calculate each point
				$xpnt = ($x+($i*$px));
				$ypnt = $zero-$yesc;
				
				// draw point
				$this->Circle($xpnt, $ypnt, 0.7, 0, 360, 'DF','',array($arrData[$ii]['color'][0],$arrData[$ii]['color'][1],$arrData[$ii]['color'][2]));
				
				// get next point
				
				if($i < (count($arrData[$ii]['data'])-1)) {
					$xpnt2 = ($x+(($i+1)*$px));
					$ypnt2 = $zero-round(($pylong / $max) * $arrData[$ii]['data'][$i+1]['value']);		
				} else {
					$xpnt2 = $xpnt;
					$ypnt2 = $ypnt;
				}
				
				// draw the line
				$this->Line($xpnt,$ypnt,$xpnt2,$ypnt2);
				
			}
		
		}
		
		$this->SetTextColor(255,255,255);
    	
    	$this->Text($x+0.1,$curY+$h-$pylong+1.9,$max);
    	
    	$this->Text($x+0.1,($curY+$h-round($pylong/2)+1.9),round($max/2));
    	
    	$this->SetTextColor(99,99,99);

    	$this->Text($x,$curY+$h-$pylong+1.8,$max);
    	
    	$this->Text($x,($curY+$h-round($pylong/2)+1.8),round($max/2));
		
	}
		
	function Ellipse($x0, $y0, $rx, $ry = 0, $angle = 0, $astart = 0, $afinish = 360, $style = '', $line_style = null, $fill_color = null, $nSeg = 8) {
		if ($rx) {
			if (!(false === strpos($style, 'F')) && $fill_color) {
				list($r, $g, $b) = $fill_color;
				$this->SetFillColor($r, $g, $b);
			}
			switch ($style) {
				case 'F':
					$op = 'f';
					$line_style = null;
					break;
				case 'FD': case 'DF':
					$op = 'B';
					break;
				case 'C':
					$op = 's'; // small 's' means closing the path as well
					break;
				default:
					$op = 'S';
					break;
			}
			if ($line_style)
				$this->SetLineStyle($line_style);
			if (!$ry)
				$ry = $rx;
			$rx *= $this->k;
			$ry *= $this->k;
			if ($nSeg < 2)
				$nSeg = 2;

			$astart = deg2rad((float) $astart);
			$afinish = deg2rad((float) $afinish);
			$totalAngle = $afinish - $astart;

			$dt = $totalAngle/$nSeg;
			$dtm = $dt/3;

			$x0 *= $this->k;
			$y0 = ($this->h - $y0) * $this->k;
			if ($angle != 0) {
				$a = -deg2rad((float) $angle);
				$this->_out(sprintf('q %.2f %.2f %.2f %.2f %.2f %.2f cm', cos($a), -1 * sin($a), sin($a), cos($a), $x0, $y0));
				$x0 = 0;
				$y0 = 0;
			}

			$t1 = $astart;
			$a0 = $x0 + ($rx * cos($t1));
			$b0 = $y0 + ($ry * sin($t1));
			$c0 = -$rx * sin($t1);
			$d0 = $ry * cos($t1);
			$this->_Point($a0 / $this->k, $this->h - ($b0 / $this->k));
			for ($i = 1; $i <= $nSeg; $i++) {
				// Draw this bit of the total curve
				$t1 = ($i * $dt) + $astart;
				$a1 = $x0 + ($rx * cos($t1));
				$b1 = $y0 + ($ry * sin($t1));
				$c1 = -$rx * sin($t1);
				$d1 = $ry * cos($t1);
				$this->_Curve(($a0 + ($c0 * $dtm)) / $this->k,
							$this->h - (($b0 + ($d0 * $dtm)) / $this->k),
							($a1 - ($c1 * $dtm)) / $this->k,
							$this->h - (($b1 - ($d1 * $dtm)) / $this->k),
							$a1 / $this->k,
							$this->h - ($b1 / $this->k));
				$a0 = $a1;
				$b0 = $b1;
				$c0 = $c1;
				$d0 = $d1;
			}
			$this->_out($op);
			if ($angle !=0)
				$this->_out('Q');
		}
    }

	// Draws a circle
	// Parameters:
	// - x0, y0: Center point
	// - r: Radius
	// - astart: Start angle
	// - afinish: Finish angle
	// - style: Style of circle (draw and/or fill) (D, F, DF, FD, C (D + close))
	// - line_style: Line style for circle. Array like for SetLineStyle
	// - fill_color: Fill color. Array with components (red, green, blue)
	// - nSeg: Ellipse is made up of nSeg Bézier curves
    function Circle($x0, $y0, $r, $astart = 0, $afinish = 360, $style = '', $line_style = null, $fill_color = null, $nSeg = 8) {
		$this->Ellipse($x0, $y0, $r, 0, 0, $astart, $afinish, $style, $line_style, $fill_color, $nSeg);
    }

    function _Point($x, $y) {
		$this->_out(sprintf('%.2f %.2f m', $x * $this->k, ($this->h - $y) * $this->k));
    }

    function _Line($x, $y) {
		$this->_out(sprintf('%.2f %.2f l', $x * $this->k, ($this->h - $y) * $this->k));
    }

    function _Curve($x1, $y1, $x2, $y2, $x3, $y3) {
		$this->_out(sprintf('%.2f %.2f %.2f %.2f %.2f %.2f c', $x1 * $this->k, ($this->h - $y1) * $this->k, $x2 * $this->k, ($this->h - $y2) * $this->k, $x3 * $this->k, ($this->h - $y3) * $this->k));
    }
	
}

