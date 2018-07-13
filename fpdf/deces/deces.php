<?php
require('../fpdi.php');

class deces extends FPDI
{ 
     public $nomprenom ="tibaredha";
	 public $db_host="localhost";
	 public $db_name="framework"; 
     public $db_user="root";
     public $db_pass="";
	 public $utf8 = "" ;
	 
	 public $repfr="République algérienne démocratique et populaire";
	 public $mspfr="Ministère de la santé de la population et de la réforme hospitalière";
	 public $dspfr="Direction de la santé et de la population de la wilaya de Djelfa";
	
	function mysqlconnect()
	{
	$this->db_host;
	$this->db_name;
	$this->db_user;
	$this->db_pass;
    $cnx = mysql_connect($this->db_host,$this->db_user,$this->db_pass)or die ('I cannot connect to the database because: ' . mysql_error());
    $db  = mysql_select_db($this->db_name,$cnx) ;
	mysql_query("SET NAMES 'UTF8' ");
	return $db;
	}
	
	function etabnm($communen,$mois,$annee) 
	{
	$this->mysqlconnect();
	$req="SELECT * FROM bordereau where  COMMUNED='$communen' and  mois='$mois' and  annee='$annee'";
	$query = mysql_query($req);   
	$rs = mysql_fetch_assoc($query);
	$OP=mysql_num_rows($query);
	if ($OP=='1') 
	{
	$OP='Oui';
	}
	else
	{
	$OP='';
	}
	mysql_free_result($query);
	return $OP;
	}
	
	
	
	function bnm($col,$communen,$mois,$annee) 
	{
	$this->mysqlconnect();
	$req="SELECT $col  FROM bordereau where  COMMUNED='$communen' and  mois='$mois' and  annee='$annee'  ";
	$query = mysql_query($req);   
	$rs = mysql_fetch_assoc($query);
	if (isset($rs[$col])) 
	{
	$OP=$rs[$col];
	}
	else
	{
	$OP='';
	}
	mysql_free_result($query);
	return $OP;
	}
	
	function sumbnm($col,$mois,$annee) 
	{
	$this->mysqlconnect();
	$req="SELECT SUM($col) AS SAD FROM bordereau where mois='$mois' and  annee='$annee'  ";
	$query = mysql_query($req);   
	$rs = mysql_fetch_assoc($query);
	$OP=$rs['SAD'];
	mysql_free_result($query);
	return $OP;
	}
	
	function Dbnm($col,$communen,$mois,$annee) 
	{
	$this->mysqlconnect();
	
	if ($col=='m') 
	{
	$req="SELECT dm1+dm2+dm3+dm4+dm5+dm6+dm7+dm8+dm9+dm10+dm11+dm12+dm13+dm14+dm15+dm16+dm17+dm18+dm19+djm1 as dmf  FROM bordereau where  COMMUNED='$communen' and  mois='$mois' and  annee='$annee'  ";
	}
	if ($col=='f') 
	{
	$req="SELECT df1+df2+df3+df4+df5+df6+df7+df8+df9+df10+df11+df12+df13+df14+df15+df16+df17+df18+df19+djf1 as dmf  FROM bordereau where  COMMUNED='$communen' and  mois='$mois' and  annee='$annee'  ";
	}
	$query = mysql_query($req);   
	$rs = mysql_fetch_assoc($query);
	if (isset($rs['dmf'])) 
	{
	$OP=$rs['dmf'];
	}
	else
	{
	$OP='';
	}
	mysql_free_result($query);
	return $OP;
	}
	function sumDbnm($col,$mois,$annee) //somme verticale des affection depiste
	{
	$this->mysqlconnect();
	if ($col=='m') 
	{
	$req="SELECT SUM(dm1+dm2+dm3+dm4+dm5+dm6+dm7+dm8+dm9+dm10+dm11+dm12+dm13+dm14+dm15+dm16+dm17+dm18+dm19+djm1) AS SAD FROM bordereau where mois='$mois' and  annee='$annee'  ";
	}
	if ($col=='f') 
	{
	$req="SELECT SUM(df1+df2+df3+df4+df5+df6+df7+df8+df9+df10+df11+df12+df13+df14+df15+df16+df17+df18+df19+djf1) AS SAD FROM bordereau where mois='$mois' and  annee='$annee'  ";
	}
	$query = mysql_query($req);   
	$rs = mysql_fetch_assoc($query);
	$OP=$rs['SAD'];
	mysql_free_result($query);
	return $OP;
	}
	  function sumfbnm($col,$annee) //somme verticale des affection depiste
	{
	$this->mysqlconnect();
	$req="SELECT SUM($col) AS SAD FROM bordereau where   annee='$annee'  ";
	$query = mysql_query($req);   
	$rs = mysql_fetch_assoc($query);
	$OP=$rs['SAD'];
	mysql_free_result($query);
	return $OP;
	}
	
	
	
	function STAT($colone1,$datejour1,$datejour2)
	{
    $this->mysqlconnect();
	$sql = " select DINS,Days,Weeks,Months,Years,DUREEHOSPIT from deceshosp where (DINS BETWEEN '$datejour1' AND '$datejour2') and ($colone1>10 and  $colone1<=150)   ";
	$requete = @mysql_query($sql) or die($sql."<br>".mysql_error());
	$x = array(); 
	while($value=mysql_fetch_array($requete))
		{
		 array_push( $x,$value[$colone1]);
		}
	
	return $x;
	} 
	
	
	
	function dspnbr($datejour1,$datejour2,$STRUCTURED)
	{
	$this->mysqlconnect();
	$sql = " select * from deceshosp where (DINS BETWEEN '$datejour1' AND '$datejour2') and ( STRUCTURED  $STRUCTURED )          ";
	$requete = @mysql_query($sql) or die($sql."<br>".mysql_error());
	$collecte=mysql_num_rows($requete);
	mysql_free_result($requete);
	return $collecte;
	}
	
	
	
	
	function valeurmois($TBL,$COLONE1,$DATEJOUR1,$DATEJOUR2,$STR) 
	{
	$this->mysqlconnect();
	$sql = " select * from $TBL  where $COLONE1 BETWEEN '$DATEJOUR1' AND '$DATEJOUR2' and  STRUCTURED  $STR ";
	$requete = @mysql_query($sql) or die($sql."<br>".mysql_error());
	$OP=mysql_num_rows($requete);
	mysql_free_result($requete);
	return $OP;
	}
	
	
	
	
	function dateFR2US($date)//01/01/2013
	{
	$J      = substr($date,0,2);
    $M      = substr($date,3,2);
    $A      = substr($date,6,4);
	$dateFR2US =  $A."-".$M."-".$J ;
    return $dateFR2US;//2013-01-01
	}
	
    function dateUS2FR($date)//2013-01-01
    {
	$J      = substr($date,8,2);
    $M      = substr($date,5,2);
    $A      = substr($date,0,4);
	$dateUS2FR =  $J."/".$M."/".$A ;
    return $dateUS2FR;//01/01/2013
    }	
	
	function nbrtostring($tb_name,$colonename,$colonevalue,$resultatstring) 
	{
	if (is_numeric($colonevalue) and $colonevalue!=='0') 
	{ 
	$this->mysqlconnect();
	$result = mysql_query("SELECT * FROM $tb_name where $colonename=$colonevalue" );
	$row=mysql_fetch_object($result);
	$resultat=$row->$resultatstring;
	return $resultat;
	} 
	return $resultat2='??????';
	}
	function _Arc($x1, $y1, $x2, $y2, $x3, $y3)
	{
		$h = $this->h;
		$this->_out(sprintf('%.2F %.2F %.2F %.2F %.2F %.2F c ', $x1*$this->k, ($h-$y1)*$this->k,
							$x2*$this->k, ($h-$y2)*$this->k, $x3*$this->k, ($h-$y3)*$this->k));
	}
	
	
	
	
	// fonctions privées

	
	function RoundedRect($x, $y, $w, $h, $r, $style = '')
	{
		$k = $this->k;
		$hp = $this->h;
		if($style=='F')
			$op='f';
		elseif($style=='FD' || $style=='DF')
			$op='B';
		else
			$op='S';
		$MyArc = 4/3 * (sqrt(2) - 1);
		$this->_out(sprintf('%.2F %.2F m',($x+$r)*$k,($hp-$y)*$k ));
		$xc = $x+$w-$r ;
		$yc = $y+$r;
		$this->_out(sprintf('%.2F %.2F l', $xc*$k,($hp-$y)*$k ));

		$this->_Arc($xc + $r*$MyArc, $yc - $r, $xc + $r, $yc - $r*$MyArc, $xc + $r, $yc);
		$xc = $x+$w-$r ;
		$yc = $y+$h-$r;
		$this->_out(sprintf('%.2F %.2F l',($x+$w)*$k,($hp-$yc)*$k));
		$this->_Arc($xc + $r, $yc + $r*$MyArc, $xc + $r*$MyArc, $yc + $r, $xc, $yc + $r);
		$xc = $x+$r ;
		$yc = $y+$h-$r;
		$this->_out(sprintf('%.2F %.2F l',$xc*$k,($hp-($y+$h))*$k));
		$this->_Arc($xc - $r*$MyArc, $yc + $r, $xc - $r, $yc + $r*$MyArc, $xc - $r, $yc);
		$xc = $x+$r ;
		$yc = $y+$r;
		$this->_out(sprintf('%.2F %.2F l',($x)*$k,($hp-$yc)*$k ));
		$this->_Arc($xc - $r, $yc - $r*$MyArc, $xc - $r*$MyArc, $yc - $r, $xc, $yc - $r);
		$this->_out($op);
	}
	function Sector($xc, $yc, $r, $a, $b, $style='FD', $cw=true, $o=90)
	{
		$d0 = $a - $b;
		if($cw){
			$d = $b;
			$b = $o - $a;
			$a = $o - $d;
		}else{
			$b += $o;
			$a += $o;
		}
		while($a<0)
			$a += 360;
		while($a>360)
			$a -= 360;
		while($b<0)
			$b += 360;
		while($b>360)
			$b -= 360;
		if ($a > $b)
			$b += 360;
		$b = $b/360*2*M_PI;
		$a = $a/360*2*M_PI;
		$d = $b - $a;
		if ($d == 0 && $d0 != 0)
			$d = 2*M_PI;
		$k = $this->k;
		$hp = $this->h;
		if (sin($d/2))
			$MyArc = 4/3*(1-cos($d/2))/sin($d/2)*$r;
		else
			$MyArc = 0;
		//first put the center
		$this->_out(sprintf('%.2F %.2F m',($xc)*$k,($hp-$yc)*$k));
		//put the first point
		$this->_out(sprintf('%.2F %.2F l',($xc+$r*cos($a))*$k,(($hp-($yc-$r*sin($a)))*$k)));
		//draw the arc
		if ($d < M_PI/2){
			$this->_Arc($xc+$r*cos($a)+$MyArc*cos(M_PI/2+$a),
						$yc-$r*sin($a)-$MyArc*sin(M_PI/2+$a),
						$xc+$r*cos($b)+$MyArc*cos($b-M_PI/2),
						$yc-$r*sin($b)-$MyArc*sin($b-M_PI/2),
						$xc+$r*cos($b),
						$yc-$r*sin($b)
						);
		}else{
			$b = $a + $d/4;
			$MyArc = 4/3*(1-cos($d/8))/sin($d/8)*$r;
			$this->_Arc($xc+$r*cos($a)+$MyArc*cos(M_PI/2+$a),
						$yc-$r*sin($a)-$MyArc*sin(M_PI/2+$a),
						$xc+$r*cos($b)+$MyArc*cos($b-M_PI/2),
						$yc-$r*sin($b)-$MyArc*sin($b-M_PI/2),
						$xc+$r*cos($b),
						$yc-$r*sin($b)
						);
			$a = $b;
			$b = $a + $d/4;
			$this->_Arc($xc+$r*cos($a)+$MyArc*cos(M_PI/2+$a),
						$yc-$r*sin($a)-$MyArc*sin(M_PI/2+$a),
						$xc+$r*cos($b)+$MyArc*cos($b-M_PI/2),
						$yc-$r*sin($b)-$MyArc*sin($b-M_PI/2),
						$xc+$r*cos($b),
						$yc-$r*sin($b)
						);
			$a = $b;
			$b = $a + $d/4;
			$this->_Arc($xc+$r*cos($a)+$MyArc*cos(M_PI/2+$a),
						$yc-$r*sin($a)-$MyArc*sin(M_PI/2+$a),
						$xc+$r*cos($b)+$MyArc*cos($b-M_PI/2),
						$yc-$r*sin($b)-$MyArc*sin($b-M_PI/2),
						$xc+$r*cos($b),
						$yc-$r*sin($b)
						);
			$a = $b;
			$b = $a + $d/4;
			$this->_Arc($xc+$r*cos($a)+$MyArc*cos(M_PI/2+$a),
						$yc-$r*sin($a)-$MyArc*sin(M_PI/2+$a),
						$xc+$r*cos($b)+$MyArc*cos($b-M_PI/2),
						$yc-$r*sin($b)-$MyArc*sin($b-M_PI/2),
						$xc+$r*cos($b),
						$yc-$r*sin($b)
						);
		}
		//terminate drawing
		if($style=='F')
			$op='f';
		elseif($style=='FD' || $style=='DF')
			$op='b';
		else
			$op='s';
		$this->_out($op);
	}
	function pie2($data)
    {
	$xc=$data['x'];
	$yc=$data['y'];
	$r=$data['r'];
	if ($data['v1']+$data['v2'] > 0){$tot=$data['v1']+$data['v2'];}else {$tot=1;}
	$p1=round($data['v1']*100/$tot,2);
	$p2=round($data['v2']*100/$tot,2);
	$a1=$p1*3.6;
	$a2=$a1+($p2*3.6);
	$this->SetFont('Times', 'BIU', 11);
	$this->SetXY($xc-20,$yc-25);$this->Cell(0, 5,$data['t0'] ,0, 2, 'L');
	$this->RoundedRect($xc-20,$yc-25, 90, 45, 2, $style = '');
	$this->SetFont('Times', 'B', 11);
	$this->SetFillColor(120,120,255);$this->Sector($xc,$yc,$r,0,$a1);
	$this->SetXY($xc+25,$yc-15);$this->cell(10,5,'',1,0,'C',1,0);$this->cell(10,5,$data['t1'],1,0,'C',0,0);$this->cell(20,5,$p1.'%',1,0,'C',0,0);
	$this->SetFillColor(120,255,120);$this->Sector($xc,$yc,$r,$a1,$a2);
	$this->SetXY($xc+25,$yc-5);$this->cell(10,5,'',1,0,'C',1,0);$this->cell(10,5,$data['t2'],1,0,'C',0,0);$this->cell(20,5,$p2.'%',1,0,'C',0,0);
	$this->SetFillColor(230);//fond gris il faut ajouter au cell un autre parametre pour qui accepte la coloration
	$this->SetTextColor(0,0,0);//text noire
	$this->SetFont('Times', 'B', 11);
	}
	var $angle=0;
	function Rotate($angle,$x=-1,$y=-1)
	{
		if($x==-1)
			$x=$this->x;
		if($y==-1)
			$y=$this->y;
		if($this->angle!=0)
			$this->_out('Q');
		$this->angle=$angle;
		if($angle!=0)
		{
			$angle*=M_PI/180;
			$c=cos($angle);
			$s=sin($angle);
			$cx=$x*$this->k;
			$cy=($this->h-$y)*$this->k;
			$this->_out(sprintf('q %.5F %.5F %.5F %.5F %.2F %.2F cm 1 0 0 1 %.2F %.2F cm',$c,$s,-$s,$c,$cx,$cy,-$cx,-$cy));
		}
	}
	
	function RotatedText($x,$y,$txt,$angle)
	{
		//Rotation du texte autour de son origine
		$this->Rotate($angle,$x,$y);
		$this->Text($x,$y,$txt);
		$this->Rotate(0);
	}
	
	
	function barservice($x,$y,$a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$k,$l,$m,$n,$o,$p,$q,$r,$s,$t,$titre)
    {
	$total1=$a+$b+$c+$d+$e+$f+$g+$h+$i+$j+$k+$l+$m+$n+$o+$p+$q+$r+$s+$t;
	
	if ($total1==0)  {$total=1;} else {$total=$total1;} 
	
	$ap=round($a*100/$total,2);
	$bp=round($b*100/$total,2);
	$cp=round($c*100/$total,2);
	$dp=round($d*100/$total,2);
	$ep=round($e*100/$total,2);
	$fp=round($f*100/$total,2);
	$gp=round($g*100/$total,2);
	$hp=round($h*100/$total,2);
	$ip=round($i*100/$total,2);
	$jp=round($j*100/$total,2);
	$kp=round($k*100/$total,2);
	$lp=round($l*100/$total,2);
	$mp=round($m*100/$total,2);
	$np=round($n*100/$total,2);
	$op=round($o*100/$total,2);
	$pp=round($p*100/$total,2);
	$qp=round($q*100/$total,2);
	$rp=round($r*100/$total,2);
	$sp=round($s*100/$total,2);
	$tp=round($t*100/$total,2);
	$this->SetFont('Times', 'BIU', 11);
	$this->SetXY($x-20,$y-108);$this->Cell(0, 5,$titre ,0, 2, 'L');
	$this->RoundedRect($x-20,$y-108, 90, 130, 2, $style = '');
	$this->SetFont('Times', 'B',08);$this->SetFillColor(120,255,120);
	$w=4.5;
	$this->SetXY($x-20,$y+10);   
	$this->cell($w,-$ap,'',1,0,'C',1,0);        
	$this->cell($w,-$bp,'',1,0,'C',1,0);
	$this->cell($w,-$cp,'',1,0,'C',1,0);
	$this->cell($w,-$dp,'',1,0,'C',1,0);
	$this->cell($w,-$ep,'',1,0,'C',1,0);
	$this->cell($w,-$fp,'',1,0,'C',1,0);
	$this->cell($w,-$gp,'',1,0,'C',1,0);
	$this->cell($w,-$hp,'',1,0,'C',1,0);
	$this->cell($w,-$ip,'',1,0,'C',1,0);
	$this->cell($w,-$jp,'',1,0,'C',1,0);
	$this->cell($w,-$kp,'',1,0,'C',1,0);        
	$this->cell($w,-$lp,'',1,0,'C',1,0);
	$this->cell($w,-$mp,'',1,0,'C',1,0);
	$this->cell($w,-$np,'',1,0,'C',1,0);
	$this->cell($w,-$op,'',1,0,'C',1,0);
	$this->cell($w,-$pp,'',1,0,'C',1,0);
	$this->cell($w,-$qp,'',1,0,'C',1,0);
	$this->cell($w,-$rp,'',1,0,'C',1,0);
	$this->cell($w,-$sp,'',1,0,'C',1,0);
	$this->cell($w,-$tp,'',1,0,'C',1,0);
	$this->SetXY($x-20,$y+12);    
	$this->cell($w,5,'1',1,0,'C',0,0);
	$this->cell($w,5,'2',1,0,'C',0,0);
	$this->cell($w,5,'3',1,0,'C',0,0);
	$this->cell($w,5,'4',1,0,'C',0,0);
	$this->cell($w,5,'5',1,0,'C',0,0);
	$this->cell($w,5,'6',1,0,'C',0,0);
	$this->cell($w,5,'7',1,0,'C',0,0);
	$this->cell($w,5,'8',1,0,'C',0,0);
	$this->cell($w,5,'9',1,0,'C',0,0);
	$this->cell($w,5,'10',1,0,'C',0,0);
	$this->cell($w,5,'11',1,0,'C',0,0);
	$this->cell($w,5,'12',1,0,'C',0,0);
	$this->cell($w,5,'13',1,0,'C',0,0);
	$this->cell($w,5,'14',1,0,'C',0,0);
	$this->cell($w,5,'15',1,0,'C',0,0);
	$this->cell($w,5,'16',1,0,'C',0,0);
	$this->cell($w,5,'17',1,0,'C',0,0);
	$this->cell($w,5,'18',1,0,'C',0,0);
	$this->cell($w,5,'19',1,0,'C',0,0);
	$this->cell($w,5,'20',1,0,'C',0,0);
	$this->SetFont('Times', 'B', 9);
	$this->SetXY(111,160-2.5);$this->cell(5,5,'00-',0,0,'C',0);
	$this->SetXY(111,150-2.5);$this->cell(5,5,'10-',0,0,'C',0);
	$this->SetXY(111,140-2.5);$this->cell(5,5,'20-',0,0,'C',0);
	$this->SetXY(111,130-2.5);$this->cell(5,5,'30-',0,0,'C',0);
	$this->SetXY(111,120-2.5);$this->cell(5,5,'40-',0,0,'C',0);
	$this->SetXY(111,110-2.5);$this->cell(5,5,'50-',0,0,'C',0);
	$this->SetXY(111,100-2.5);$this->cell(5,5,'60-',0,0,'C',0);
	$this->SetXY(111,90-2.5);$this->cell(5,5,'70-',0,0,'C',0);
	$this->SetXY(111,80-2.5);$this->cell(5,5,'80-',0,0,'C',0);
	$this->SetXY(111,70-2.5);$this->cell(5,5,'90-',0,0,'C',0);
	$this->SetXY(111,60-2.5);$this->cell(5,5,'100-',0,0,'C',0);
	$this->SetTextColor(255,0,0);
	$this->RotatedText($x-17.5,$y+10-$ap,'-'.$ap.'%',80);
	$this->RotatedText($x-17.5+5,$y+10-$bp,'-'.$bp.'%',80);
	$this->RotatedText($x-17.5+9,$y+10-$cp,'-'.$cp.'%',80);
	$this->RotatedText($x-17.5+14,$y+10-$dp,'-'.$dp.'%',80);
	$this->RotatedText($x-17.5+18.5,$y+10-$ep,'-'.$ep.'%',80);
	$this->RotatedText($x-17.5+23,$y+10-$fp,'-'.$fp.'%',80);
	$this->RotatedText($x-17.5+27,$y+10-$gp,'-'.$gp.'%',80);
	$this->RotatedText($x-17.5+32,$y+10-$hp,'-'.$hp.'%',80);
	$this->RotatedText($x-17.5+36.5,$y+10-$ip,'-'.$ip.'%',80);
	$this->RotatedText($x-17.5+41,$y+10-$jp,'-'.$jp.'%',80);
	$this->RotatedText($x-17.5+45.5,$y+10-$kp,'-'.$kp.'%',80);
	$this->RotatedText($x-17.5+49.5,$y+10-$lp,'-'.$lp.'%',80);
	$this->RotatedText($x-17.5+54,$y+10-$mp,'-'.$mp.'%',80);
	$this->RotatedText($x-17.5+59,$y+10-$np,'-'.$np.'%',80);
	$this->RotatedText($x-17.5+63,$y+10-$op,'-'.$op.'%',80);
	$this->RotatedText($x-17.5+68,$y+10-$pp,'-'.$pp.'%',80);
	$this->RotatedText($x-17.5+72.5,$y+10-$qp,'-'.$qp.'%',80);
	$this->RotatedText($x-17.5+77,$y+10-$rp,'-'.$rp.'%',80);
	$this->RotatedText($x-17.5+81.5,$y+10-$sp,'-'.$sp.'%',80);
	$this->RotatedText($x-17.5+85.5,$y+10-$tp,'-'.$tp.'%',80);
	$this->SetTextColor(0,0,0);
	$this->SetFillColor(230);//fond gris il faut ajouter au cell un autre parametre pour qui accepte la coloration
	$this->SetTextColor(0,0,0);//text noire
	$this->SetFont('Times', 'B', 11);
	}
	
	function listedeces($STRUCTURED,$datejour1,$datejour2,$login,$type)
	{
	$this->SetDisplayMode('fullpage','single');//mode d affichage 
	$this->SetFont('Arial','B',10);
	$this->SetXY(5,5);$this->cell(290,5,html_entity_decode(utf8_decode($this->repfr)),0,0,'C',1,0);
	$this->SetXY(5,10);$this->cell(290,5,html_entity_decode(utf8_decode($this->mspfr)),0,0,'C',1,0);
	$this->SetXY(5,15);$this->cell(290,5,html_entity_decode(utf8_decode($this->dspfr)),0,0,'C',1,0);
	if($STRUCTURED=='IS NOT NULL') {
	$this->Text(05,25,html_entity_decode(utf8_decode("Service Prévention")));
	} else{
	$STRUCTUREDX = explode('=',$STRUCTURED);
	$this->Text(05,25,$this->nbrtostring("structure","id",intval($STRUCTUREDX),"structure"));	$this->Text(240,25," LE : ".date('d-m-Y')); 
	}
	$this->Text(05,30,"SEMEP");
	$this->Text(05,35,"N ... /".date('Y'));
	$this->SetXY(5,35);$this->cell(290,5,html_entity_decode(utf8_decode("RELEVE DES CAUSES DE DECES ")),0,0,'C',0,0);
	$this->SetXY(5,40);$this->cell(290,5,html_entity_decode(utf8_decode("Du  ".$this->dateUS2FR($datejour1)."  Au  ".$this->dateUS2FR($datejour2))),0,0,'C',0,0);
	$this->SetXY(5,45);$this->cell(290,5,html_entity_decode(utf8_decode("Ref : circulaire numero 607 du 24 septembre 1994  ")),0,0,'C',0,0);
	$h=55;
	$this->SetFillColor(200 );
	$this->SetXY(05,$h);
	$this->cell(10,10,html_entity_decode(utf8_decode("N°")),1,0,1,'C',0);
	$this->cell(20,10,html_entity_decode(utf8_decode("Date Décès")),1,0,1,'C',0);
	
	if ($type=='I') {
	$this->cell(10,10,"Sexe",1,0,1,'C',0);
	$this->cell(10,10,"Age",1,0,1,'C',0);
	$this->cell(30,10,"Residence ",1,0,1,'C',0);
	$this->cell(25,10,"Profession",1,0,1,'C',0);
	$this->cell(40,10,"Service ",1,0,1,'C',0);
	$this->cell(15,10,"Duree",1,0,1,'C',0);
	$this->cell(126,10,"Cause du deces",1,0,1,'C',0);
	} else {
	$this->cell(70,10,"Nom_Prenom",1,0,1,'C',0);
	$this->cell(10,10,"Sexe",1,0,1,'C',0);
	$this->cell(20,10,"Nee le",1,0,1,'C',0);
	$this->cell(10,10,"Age",1,0,1,'C',0);
	$this->cell(45,10,"residence",1,0,1,'C',0);
	$this->cell(20,10,"Admission",1,0,1,'C',0);
	$this->cell(56,10,"Service ",1,0,1,'C',0);
	$this->cell(15,10,"Duree",1,0,1,'C',0);
	$this->cell(10,10,"CIM",1,0,1,'C',0);
	}
	$this->SetXY(05,$h+10); 
	$this->mysqlconnect();
	$this->SetFont('Arial', '',9, '', true);
	$query = "SELECT * FROM deceshosp where DINS BETWEEN '$datejour1' AND '$datejour2' and STRUCTURED $STRUCTURED  order by  DINS     ";
	$resultat=mysql_query($query);
	$totalmbr1=mysql_num_rows($resultat);
	$x=0;
	while($row=mysql_fetch_object($resultat))
	{
	$x=$x+1;
	$this->SetFillColor(200 );
	$this->cell(10,5,$x,1,0,'C',0);
	$this->cell(20,5,$this->dateUS2FR($row->DINS),1,0,'C',0);
	
	if ($type=='I') {
	$this->cell(10,5,trim($row->SEX),1,0,'C',0);
	if ($row->Years > 0 ) 
	{
	$this->cell(10,5,$row->Years." A",1,0,'C',0);
	} 
	else 
	{
		if ($row->Days <= 30 ) 
		{
		$this->cell(10,5,$row->Days." J",1,0,'C',0);
		} 
		else
		{
		$this->cell(10,5,$row->Months." M",1,0,'C',0);
		} 
	}
	$this->cell(30,5,$this->nbrtostring("com","IDCOM",$row->COMMUNER,"COMMUNE"),1,0,'L',0);
	$this->cell(25,5,'***',1,0,'L',0);
	$this->cell(40,5,html_entity_decode(utf8_decode($this->nbrtostring("servicedeces","id",$row->SERVICEHOSPIT,"service"))),1,0,'L',0);//5  =hauteur de la cellule origine =7
	$this->cell(15,5,$row->DUREEHOSPIT.' j',1,0,'C',0);
	$this->cell(126,5,'('.html_entity_decode(utf8_decode($this->nbrtostring("CIM","row_id",$row->CODECIM,'diag_nom'))).')_'.$row->CIM1,1,0,'L',0);
	}else{
	$this->cell(70,5,trim($row->NOM).'_'.strtolower (trim($row->PRENOM)).' ['.strtolower (trim($row->FILSDE)).']',1,0,'L',0);
    $this->cell(10,5,trim($row->SEX),1,0,'C',0);
    $this->cell(20,5,$this->dateUS2FR($row->DATENAISSANCE),1,0,'C',0);
	if ($row->Years > 0 ) 
	{
	$this->cell(10,5,$row->Years." A",1,0,'C',0);
	} 
	else 
	{
		if ($row->Days <= 30 ) 
		{
		$this->cell(10,5,$row->Days." J",1,0,'C',0);
		} 
		else
		{
		$this->cell(10,5,$row->Months." M",1,0,'C',0);
		} 
	}
	
	$this->cell(45,5,$this->nbrtostring("com","IDCOM",$row->COMMUNER,"COMMUNE"),1,0,'L',0);
	$this->cell(20,5,$this->dateUS2FR($row->DATEHOSPI),1,0,'C',0);
	$this->cell(56,5,html_entity_decode(utf8_decode($this->nbrtostring("servicedeces","id",$row->SERVICEHOSPIT,"service"))),1,0,'L',0);
	$this->cell(15,5,$row->DUREEHOSPIT.' j',1,0,'C',0);
	$this->cell(10,5,html_entity_decode(utf8_decode($this->nbrtostring("CIM","row_id",$row->CODECIM,'diag_cod'))),1,0,'C',0);
	}
	$this->SetXY(5,$this->GetY()+5); 
	}
	$this->SetFillColor(200 );
	$this->SetFont('Arial', '',10, '', true);  
	$this->SetXY(5,$this->GetY());$this->cell(40,05,"TOTAL",1,0,1,'C',0);	  
	$this->SetXY(45,$this->GetY());$this->cell(246,05,$totalmbr1." Deces",1,1,1,'C',0);				 
	$this->SetXY(190,$this->GetY()+5); $this->cell(90,10,"LE PRATICIEN RESPONSABLE ",0,0,'L',0);
	$this->SetXY(190,$this->GetY()+5); $this->cell(90,10,'Dr '.$login,0,0,'L',0);
	}
	
	function BORDEREAU($titre,$datejour1,$datejour2,$EPH1,$STRUCTURED) 
	{
	$this->SetXY(5,10);$this->cell(200,5,html_entity_decode(utf8_decode($this->repfr)),0,0,'C',1,0);
	$this->SetXY(5,20);$this->cell(200,5,html_entity_decode(utf8_decode($this->mspfr)),0,0,'C',1,0);
	$this->SetXY(5,30);$this->cell(200,5,html_entity_decode(utf8_decode($this->dspfr)),0,0,'C',1,0);
	$this->SetXY(5,40);$this->cell(100,5,$this->nbrtostring("structure","id",$STRUCTURED,"structure"),0,0,'L',0,0);$this->SetXY(155,40);$this->cell(50,5,"Le : ........................",0,0,'L',0,0);
	$this->SetXY(5,45);$this->cell(100,5,html_entity_decode(utf8_decode("N°...... / ".date('Y'))),0,0,'L',0,0);
	$this->SetXY(55,55);$this->cell(150,5,html_entity_decode(utf8_decode("A")),0,0,'C',0,0);
	$this->SetXY(55,60);$this->cell(150,5,html_entity_decode(utf8_decode("Monsieur le Directeur de la sante et de la population de la wilaya de Djelfa")),0,0,'C',0,0);
	$this->SetXY(5,80);$this->cell(200,10,html_entity_decode(utf8_decode($titre )),0,0,'C',1,0);
	$this->RoundedRect(5,108, 15, 130, 2, $style = '');
	$this->RoundedRect(20,108, 105, 130, 2, $style = '');
	$this->RoundedRect(20+105,108, 15, 130, 2, $style = '');
	$this->RoundedRect(20+105+15,108, 65, 130, 2, $style = '');
	$this->SetXY(5,108);$this->cell(15,10,html_entity_decode(utf8_decode("N°" )),1,0,'C',1,0);
	$this->SetXY(5+15,108);$this->cell(105,10,html_entity_decode(utf8_decode("DESIGNATION" )),1,0,'C',1,0);
	$this->SetXY(5+15+105,108);$this->cell(15,10,html_entity_decode(utf8_decode("NBR" )),1,0,'C',1,0);
	$this->SetXY(5+30+105,108);$this->cell(65,10,html_entity_decode(utf8_decode("OBSERVATION" )),1,0,'C',1,0);
	$this->SetXY(5+15,128);$this->cell(105,10,html_entity_decode(utf8_decode("Veuillez trouver ci-joint" )),0,0,'C',0,0);
	$this->SetXY(5,148);$this->cell(15,10,html_entity_decode(utf8_decode("1" )),0,0,'C',0,0);
	$this->SetXY(5+15,148);$this->cell(105,10,html_entity_decode(utf8_decode("Certificat de décès" )),0,0,'L',0,0);
	$this->SetXY(5+15+105,148);$this->cell(15,10,$this->valeurmois('deceshosp','DINS',$datejour1,$datejour2,$EPH1),0,0,'C',0,0);
	$this->SetXY(5+30+105,148);$this->cell(65,10,html_entity_decode(utf8_decode("" )),0,0,'C',0,0);
	$this->SetXY(5,158);$this->cell(15,10,html_entity_decode(utf8_decode("2" )),0,0,'C',0,0);
	$this->SetXY(5+15,158);$this->cell(105,10,html_entity_decode(utf8_decode("Liste nominative des décès hospitaliers" )),0,0,'L',0,0);
	$this->SetXY(5+15+105,158);$this->cell(15,10,html_entity_decode(utf8_decode("01" )),0,0,'C',0,0);
	$this->SetXY(5+30+105,158);$this->cell(65,10,html_entity_decode(utf8_decode("Rapport" )),0,0,'C',0,0);
	$this->SetXY(5,168);$this->cell(15,10,html_entity_decode(utf8_decode("3" )),0,0,'C',0,0);
	$this->SetXY(5+15,168);$this->cell(105,10,html_entity_decode(utf8_decode("Rapport de la mortatlité hospitalière" )),0,0,'L',0,0);
	$this->SetXY(5+15+105,168);$this->cell(15,10,html_entity_decode(utf8_decode("01" )),0,0,'C',0,0);
	$this->SetXY(5+30+105,168);$this->cell(65,10,html_entity_decode(utf8_decode("Mortalité Hospitalière" )),0,0,'C',0,0);
	$this->SetXY(5,178);$this->cell(15,10,html_entity_decode(utf8_decode("4" )),0,0,'C',0,0);
	$this->SetXY(5+15,178);$this->cell(105,10,html_entity_decode(utf8_decode("Support Informatique (CD)" )),0,0,'L',0,0);
	$this->SetXY(5+15+105,178);$this->cell(15,10,html_entity_decode(utf8_decode("01" )),0,0,'C',0,0);
	$this->SetXY(5+30+105,178);$this->cell(65,10,html_entity_decode(utf8_decode("Du ".$this->dateUS2FR($datejour1)." Au ".$this->dateUS2FR($datejour2) )),0,0,'C',0,0);
	$this->SetXY(5+30+105,250);$this->cell(40,10,html_entity_decode(utf8_decode("Le Directeur" )),0,0,'L',0,0);
	}
	
	function DECMAT($colone1,$colone2,$colone3,$datejour1,$datejour2,$SEXEDNR,$STRUCTURED)
	{
	$this->mysqlconnect();
	$sql = " select * from deceshosp where  ($colone1 >=$colone2  and $colone1 <=$colone3)  and (DINS BETWEEN '$datejour1' AND '$datejour2') and (SEX='$SEXEDNR' and STRUCTURED $STRUCTURED )          ";
	$requete = @mysql_query($sql) or die($sql."<br>".mysql_error());
	$collecte=mysql_num_rows($requete);
	mysql_free_result($requete);
	return $collecte;
	}
	
	
	function DEMOGRAPHIE($titre,$datejour1,$datejour2,$EPH1,$STRUCTURED) 
	{
	$this->SetFont('Times', 'B', 11);
	$this->SetXY(5,10);$this->cell(200,5,html_entity_decode(utf8_decode($this->repfr)),0,0,'C',1,0);
	$this->SetXY(5,20);$this->cell(200,5,html_entity_decode(utf8_decode($this->mspfr)),0,0,'C',1,0);
	$this->SetXY(5,30);$this->cell(200,5,html_entity_decode(utf8_decode($this->dspfr)),0,0,'C',1,0);
	$datey = explode('-', $datejour2);$date=$datey[0];
	$this->SetXY(5,38);$this->cell(195,10,$titre.$this->nbrtostring("structure","id",$STRUCTURED,"structure")." ( Annee : ".$date." )",0,0,'C',0);
	$y=50;
	$this->SetXY(5,50);$this->cell(65,10,"Effectifs",1,0,1,'C',0);$this->SetXY(70,50);$this->cell(30,10,"Periode",1,0,1,'C',0);$this->SetXY(100,50);$this->cell(30,10,"Etat Civil",1,0,1,'C',0);$this->SetXY(130,50);$this->cell(35,10,"Milieu Assiste",1,0,1,'C',0);$this->SetXY(165,50);$this->cell(35,10,"Observation",1,0,1,'C',0);
	$this->SetXY(5,$y+10);$this->cell(65,25,"Naissance Vivantes",1,0,'C',0);
	$this->SetXY(70,$y+10);$this->cell(30,5,"1ere trimestre",1,0,'C',0);$this->SetXY(100,$y+10);$this->cell(30,5,"",1,0,'C',0);$this->SetXY(130,$y+10);$this->cell(35,5,"",1,0,'C',0);$this->SetXY(165,$y+10);$this->cell(35,5,"",1,0,'C',0);
	$this->SetXY(70,$y+15);$this->cell(30,5,"2eme trimestre",1,0,'C',0);$this->SetXY(100,$y+15);$this->cell(30,5,"",1,0,'C',0);$this->SetXY(130,$y+15);$this->cell(35,5,"",1,0,'C',0);$this->SetXY(165,$y+15);$this->cell(35,5,"",1,0,'C',0);
	$this->SetXY(70,$y+20);$this->cell(30,5,"3eme trimestre",1,0,'C',0);$this->SetXY(100,$y+20);$this->cell(30,5,"",1,0,'C',0);$this->SetXY(130,$y+20);$this->cell(35,5,"",1,0,'C',0);$this->SetXY(165,$y+20);$this->cell(35,5,"",1,0,'C',0);
	$this->SetXY(70,$y+25);$this->cell(30,5,"4eme trimestre",1,0,'C',0);$this->SetXY(100,$y+25);$this->cell(30,5,"",1,0,'C',0);$this->SetXY(130,$y+25);$this->cell(35,5,"",1,0,'C',0);$this->SetXY(165,$y+25);$this->cell(35,5,"",1,0,'C',0);
	$this->SetXY(70,$y+30);$this->cell(30,5,"Total",1,0,'C',1,0);       $this->SetXY(100,$y+30);$this->cell(30,5,"",1,0,'C',1,0);$this->SetXY(130,$y+30);$this->cell(35,5,"",1,0,'C',1,0);$this->SetXY(165,$y+30);$this->cell(35,5,"",1,0,'C',1,0);
    
	
	
	$y=50+25;
	$mt1=$this->AGESEXE('Days',0,365*150,$date.'-01-01',$date.'-03-31','M',"=".$STRUCTURED);
	$ft1=$this->AGESEXE('Days',0,365*150,$date.'-01-01',$date.'-03-31','F',"=".$STRUCTURED);
	$mt2=$this->AGESEXE('Days',0,365*150,$date.'-04-01',$date.'-06-30','M',"=".$STRUCTURED);
	$ft2=$this->AGESEXE('Days',0,365*150,$date.'-04-01',$date.'-06-30','F',"=".$STRUCTURED);
	$mt3=$this->AGESEXE('Days',0,365*150,$date.'-07-01',$date.'-09-30','M',"=".$STRUCTURED);
	$ft3=$this->AGESEXE('Days',0,365*150,$date.'-07-01',$date.'-09-30','F',"=".$STRUCTURED);
	$mt4=$this->AGESEXE('Days',0,365*150,$date.'-10-01',$date.'-12-31','M',"=".$STRUCTURED);
	$ft4=$this->AGESEXE('Days',0,365*150,$date.'-10-01',$date.'-12-31','F',"=".$STRUCTURED);
		
	$tm=$mt1+$mt2+$mt3+$mt4;
	$tf=$ft1+$ft2+$ft3+$ft4;
	
	$y=85;
	$this->SetXY(5,$y);$this->cell(65,25,"Deces tout age confondus",1,0,'C',0);
	$this->SetXY(70,$y);$this->cell(30,5,"1ere trimestre",1,0,'C',0);  $this->SetXY(100,$y);$this->cell(30,5,"",1,0,'C',0);$this->SetXY(130,$y);$this->cell(35,5,$mt1+$ft1,1,0,'C',0);$this->SetXY(165,$y);$this->cell(35,5,"",1,0,'C',0);
	$this->SetXY(70,$y+5);$this->cell(30,5,"2eme trimestre",1,0,'C',0);$this->SetXY(100,$y+5);$this->cell(30,5,"",1,0,'C',0);$this->SetXY(130,$y+5);$this->cell(35,5,$mt2+$ft2,1,0,'C',0);$this->SetXY(165,$y+5);$this->cell(35,5,"",1,0,'C',0);
	$this->SetXY(70,$y+10);$this->cell(30,5,"3eme trimestre",1,0,'C',0);$this->SetXY(100,$y+10);$this->cell(30,5,"",1,0,'C',0);$this->SetXY(130,$y+10);$this->cell(35,5,$mt3+$ft3,1,0,'C',0);$this->SetXY(165,$y+10);$this->cell(35,5,"",1,0,'C',0);
	$this->SetXY(70,$y+15);$this->cell(30,5,"4eme trimestre",1,0,'C',0);$this->SetXY(100,$y+15);$this->cell(30,5,"",1,0,'C',0);$this->SetXY(130,$y+15);$this->cell(35,5,$mt4+$ft4,1,0,'C',0);$this->SetXY(165,$y+15);$this->cell(35,5,"",1,0,'C',0);
	$this->SetXY(70,$y+20);$this->cell(30,5,"Total",1,0,'C',1,0);       $this->SetXY(100,$y+20);$this->cell(30,5,"",1,0,'C',1,0);$this->SetXY(130,$y+20);$this->cell(35,5,$tm+$tf,1,0,'C',1,0);$this->SetXY(165,$y+20);$this->cell(35,5,"",1,0,'C',1,0);

	$y=110;
	$mt1=$this->AGESEXE('Days',0,365,$date.'-01-01',$date.'-03-31','M',"=".$STRUCTURED);
	$ft1=$this->AGESEXE('Days',0,365,$date.'-01-01',$date.'-03-31','F',"=".$STRUCTURED);
	$mt2=$this->AGESEXE('Days',0,365,$date.'-04-01',$date.'-06-30','M',"=".$STRUCTURED);
	$ft2=$this->AGESEXE('Days',0,365,$date.'-04-01',$date.'-06-30','F',"=".$STRUCTURED);
	$mt3=$this->AGESEXE('Days',0,365,$date.'-07-01',$date.'-09-30','M',"=".$STRUCTURED);
	$ft3=$this->AGESEXE('Days',0,365,$date.'-07-01',$date.'-09-30','F',"=".$STRUCTURED);
	$mt4=$this->AGESEXE('Days',0,365,$date.'-10-01',$date.'-12-31','M',"=".$STRUCTURED);
	$ft4=$this->AGESEXE('Days',0,365,$date.'-10-01',$date.'-12-31','F',"=".$STRUCTURED);
	$tm=$mt1+$mt2+$mt3+$mt4;
	$tf=$ft1+$ft2+$ft3+$ft4;
	$this->SetXY(5,$y);$this->cell(65,25,"Deces des enfant de moins d'un an",1,0,'C',0);
	$this->SetXY(70,$y);$this->cell(30,5,"1ere trimestre",1,0,'C',0);  $this->SetXY(100,$y);$this->cell(30,5,"",1,0,'C',0);$this->SetXY(130,$y);$this->cell(35,5,$mt1+$ft1,1,0,'C',0);$this->SetXY(165,$y);$this->cell(35,5,"",1,0,'C',0);
	$this->SetXY(70,$y+5);$this->cell(30,5,"2eme trimestre",1,0,'C',0);$this->SetXY(100,$y+5);$this->cell(30,5,"",1,0,'C',0);$this->SetXY(130,$y+5);$this->cell(35,5,$mt2+$ft2,1,0,'C',0);$this->SetXY(165,$y+5);$this->cell(35,5,"",1,0,'C',0);
	$this->SetXY(70,$y+10);$this->cell(30,5,"3eme trimestre",1,0,'C',0);$this->SetXY(100,$y+10);$this->cell(30,5,"",1,0,'C',0);$this->SetXY(130,$y+10);$this->cell(35,5,$mt3+$ft3,1,0,'C',0);$this->SetXY(165,$y+10);$this->cell(35,5,"",1,0,'C',0);
	$this->SetXY(70,$y+15);$this->cell(30,5,"4eme trimestre",1,0,'C',0);$this->SetXY(100,$y+15);$this->cell(30,5,"",1,0,'C',0);$this->SetXY(130,$y+15);$this->cell(35,5,$mt4+$ft4,1,0,'C',0);$this->SetXY(165,$y+15);$this->cell(35,5,"",1,0,'C',0);
	$this->SetXY(70,$y+20);$this->cell(30,5,"Total",1,0,'C',1,0);         $this->SetXY(100,$y+20);$this->cell(30,5,"",1,0,'C',1,0);$this->SetXY(130,$y+20);$this->cell(35,5,$tm+$tf,1,0,'C',1,0);$this->SetXY(165,$y+20);$this->cell(35,5,"",1,0,'C',1,0);

	$y=135;
	$mt1=$this->AGESEXE('Days',0,7,$date.'-01-01',$date.'-03-31','M',"=".$STRUCTURED);
	$ft1=$this->AGESEXE('Days',0,7,$date.'-01-01',$date.'-03-31','F',"=".$STRUCTURED);
	$mt2=$this->AGESEXE('Days',0,7,$date.'-04-01',$date.'-06-30','M',"=".$STRUCTURED);
	$ft2=$this->AGESEXE('Days',0,7,$date.'-04-01',$date.'-06-30','F',"=".$STRUCTURED);
	$mt3=$this->AGESEXE('Days',0,7,$date.'-07-01',$date.'-09-30','M',"=".$STRUCTURED);
	$ft3=$this->AGESEXE('Days',0,7,$date.'-07-01',$date.'-09-30','F',"=".$STRUCTURED);
	$mt4=$this->AGESEXE('Days',0,7,$date.'-10-01',$date.'-12-31','M',"=".$STRUCTURED);
	$ft4=$this->AGESEXE('Days',0,7,$date.'-10-01',$date.'-12-31','F',"=".$STRUCTURED);
	$tm=$mt1+$mt2+$mt3+$mt4;
	$tf=$ft1+$ft2+$ft3+$ft4;
	$this->SetXY(5,$y);$this->cell(65,25,"Deces des nouveaux nes (0-6 jours)",1,0,'C',0);
	$this->SetXY(70,$y);$this->cell(30,5,"1ere trimestre",1,0,'C',0);  $this->SetXY(100,$y);$this->cell(30,5,"",1,0,'C',0);$this->SetXY(130,$y);$this->cell(35,5,$mt1+$ft1,1,0,'C',0);$this->SetXY(165,$y);$this->cell(35,5,"",1,0,'C',0);
	$this->SetXY(70,$y+5);$this->cell(30,5,"2eme trimestre",1,0,'C',0);$this->SetXY(100,$y+5);$this->cell(30,5,"",1,0,'C',0);$this->SetXY(130,$y+5);$this->cell(35,5,$mt2+$ft2,1,0,'C',0);$this->SetXY(165,$y+5);$this->cell(35,5,"",1,0,'C',0);
	$this->SetXY(70,$y+10);$this->cell(30,5,"3eme trimestre",1,0,'C',0);$this->SetXY(100,$y+10);$this->cell(30,5,"",1,0,'C',0);$this->SetXY(130,$y+10);$this->cell(35,5,$mt3+$ft3,1,0,'C',0);$this->SetXY(165,$y+10);$this->cell(35,5,"",1,0,'C',0);
	$this->SetXY(70,$y+15);$this->cell(30,5,"4eme trimestre",1,0,'C',0);$this->SetXY(100,$y+15);$this->cell(30,5,"",1,0,'C',0);$this->SetXY(130,$y+15);$this->cell(35,5,$mt4+$ft4,1,0,'C',0);$this->SetXY(165,$y+15);$this->cell(35,5,"",1,0,'C',0);
	$this->SetXY(70,$y+20);$this->cell(30,5,"Total",1,0,'C',1,0);         $this->SetXY(100,$y+20);$this->cell(30,5,"",1,0,'C',1,0);$this->SetXY(130,$y+20);$this->cell(35,5,$tm+$tf,1,0,'C',1,0);$this->SetXY(165,$y+20);$this->cell(35,5,"",1,0,'C',1,0);

	$y=160;
	$mt1=$this->AGESEXE('Days',8,28,$date.'-01-01',$date.'-03-31','M',"=".$STRUCTURED);
	$ft1=$this->AGESEXE('Days',8,28,$date.'-01-01',$date.'-03-31','F',"=".$STRUCTURED);
	$mt2=$this->AGESEXE('Days',8,28,$date.'-04-01',$date.'-06-30','M',"=".$STRUCTURED);
	$ft2=$this->AGESEXE('Days',8,28,$date.'-04-01',$date.'-06-30','F',"=".$STRUCTURED);
	$mt3=$this->AGESEXE('Days',8,28,$date.'-07-01',$date.'-09-30','M',"=".$STRUCTURED);
	$ft3=$this->AGESEXE('Days',8,28,$date.'-07-01',$date.'-09-30','F',"=".$STRUCTURED);
	$mt4=$this->AGESEXE('Days',8,28,$date.'-10-01',$date.'-12-31','M',"=".$STRUCTURED);
	$ft4=$this->AGESEXE('Days',8,28,$date.'-10-01',$date.'-12-31','F',"=".$STRUCTURED);
	$tm=$mt1+$mt2+$mt3+$mt4;
	$tf=$ft1+$ft2+$ft3+$ft4;
	$this->SetXY(5,$y);$this->cell(65,25,"Deces des nouveaux nes (7-28 jours)",1,0,'C',0);
	$this->SetXY(70,$y);$this->cell(30,5,"1ere trimestre",1,0,'C',0);  $this->SetXY(100,$y);$this->cell(30,5,"",1,0,'C',0);$this->SetXY(130,$y);$this->cell(35,5,$mt1+$ft1,1,0,'C',0);$this->SetXY(165,$y);$this->cell(35,5,"",1,0,'C',0);
	$this->SetXY(70,$y+5);$this->cell(30,5,"2eme trimestre",1,0,'C',0);$this->SetXY(100,$y+5);$this->cell(30,5,"",1,0,'C',0);$this->SetXY(130,$y+5);$this->cell(35,5,$mt2+$ft2,1,0,'C',0);$this->SetXY(165,$y+5);$this->cell(35,5,"",1,0,'C',0);
	$this->SetXY(70,$y+10);$this->cell(30,5,"3eme trimestre",1,0,'C',0);$this->SetXY(100,$y+10);$this->cell(30,5,"",1,0,'C',0);$this->SetXY(130,$y+10);$this->cell(35,5,$mt3+$ft3,1,0,'C',0);$this->SetXY(165,$y+10);$this->cell(35,5,"",1,0,'C',0);
	$this->SetXY(70,$y+15);$this->cell(30,5,"4eme trimestre",1,0,'C',0);$this->SetXY(100,$y+15);$this->cell(30,5,"",1,0,'C',0);$this->SetXY(130,$y+15);$this->cell(35,5,$mt4+$ft4,1,0,'C',0);$this->SetXY(165,$y+15);$this->cell(35,5,"",1,0,'C',0);
	$this->SetXY(70,$y+20);$this->cell(30,5,"Total",1,0,'C',1,0);         $this->SetXY(100,$y+20);$this->cell(30,5,"",1,0,'C',1,0);$this->SetXY(130,$y+20);$this->cell(35,5,$tm+$tf,1,0,'C',1,0);$this->SetXY(165,$y+20);$this->cell(35,5,"",1,0,'C',1,0);

	$y=185;
	$mt1=$this->AGESEXE('Days',0,28,$date.'-01-01',$date.'-03-31','M',"=".$STRUCTURED);
	$ft1=$this->AGESEXE('Days',0,28,$date.'-01-01',$date.'-03-31','F',"=".$STRUCTURED);
	$mt2=$this->AGESEXE('Days',0,28,$date.'-04-01',$date.'-06-30','M',"=".$STRUCTURED);
	$ft2=$this->AGESEXE('Days',0,28,$date.'-04-01',$date.'-06-30','F',"=".$STRUCTURED);
	$mt3=$this->AGESEXE('Days',0,28,$date.'-07-01',$date.'-09-30','M',"=".$STRUCTURED);
	$ft3=$this->AGESEXE('Days',0,28,$date.'-07-01',$date.'-09-30','F',"=".$STRUCTURED);
	$mt4=$this->AGESEXE('Days',0,28,$date.'-10-01',$date.'-12-31','M',"=".$STRUCTURED);
	$ft4=$this->AGESEXE('Days',0,28,$date.'-10-01',$date.'-12-31','F',"=".$STRUCTURED);
	$tm=$mt1+$mt2+$mt3+$mt4;
	$tf=$ft1+$ft2+$ft3+$ft4;
	$this->SetXY(5,$y);$this->cell(65,25,"Deces des nouveaux nes (0-28 jours)",1,0,'C',0);
	$this->SetXY(70,$y);$this->cell(30,5,"1ere trimestre",1,0,'C',0);  $this->SetXY(100,$y);$this->cell(30,5,"",1,0,'C',0);$this->SetXY(130,$y);$this->cell(35,5,$mt1+$ft1,1,0,'C',0);$this->SetXY(165,$y);$this->cell(35,5,"",1,0,'C',0);
	$this->SetXY(70,$y+5);$this->cell(30,5,"2eme trimestre",1,0,'C',0);$this->SetXY(100,$y+5);$this->cell(30,5,"",1,0,'C',0);$this->SetXY(130,$y+5);$this->cell(35,5,$mt2+$ft2,1,0,'C',0);$this->SetXY(165,$y+5);$this->cell(35,5,"",1,0,'C',0);
	$this->SetXY(70,$y+10);$this->cell(30,5,"3eme trimestre",1,0,'C',0);$this->SetXY(100,$y+10);$this->cell(30,5,"",1,0,'C',0);$this->SetXY(130,$y+10);$this->cell(35,5,$mt3+$ft3,1,0,'C',0);$this->SetXY(165,$y+10);$this->cell(35,5,"",1,0,'C',0);
	$this->SetXY(70,$y+15);$this->cell(30,5,"4eme trimestre",1,0,'C',0);$this->SetXY(100,$y+15);$this->cell(30,5,"",1,0,'C',0);$this->SetXY(130,$y+15);$this->cell(35,5,$mt4+$ft4,1,0,'C',0);$this->SetXY(165,$y+15);$this->cell(35,5,"",1,0,'C',0);
	$this->SetXY(70,$y+20);$this->cell(30,5,"Total",1,0,'C',1,0);         $this->SetXY(100,$y+20);$this->cell(30,5,"",1,0,'C',1,0);$this->SetXY(130,$y+20);$this->cell(35,5,$tm+$tf,1,0,'C',1,0);$this->SetXY(165,$y+20);$this->cell(35,5,"",1,0,'C',1,0);
     
	$y=210;
	$this->SetXY(5,$y);$this->cell(65,25,"Mort nes",1,0,'C',0);
	$this->SetXY(70,$y);$this->cell(30,5,"1ere trimestre",1,0,'C',0);  $this->SetXY(100,$y);$this->cell(30,5,"",1,0,'C',0);$this->SetXY(130,$y);$this->cell(35,5,"",1,0,'C',0);$this->SetXY(165,$y);$this->cell(35,5,"",1,0,'C',0);
	$this->SetXY(70,$y+5);$this->cell(30,5,"2eme trimestre",1,0,'C',0);$this->SetXY(100,$y+5);$this->cell(30,5,"",1,0,'C',0);$this->SetXY(130,$y+5);$this->cell(35,5,"",1,0,'C',0);$this->SetXY(165,$y+5);$this->cell(35,5,"",1,0,'C',0);
	$this->SetXY(70,$y+10);$this->cell(30,5,"3eme trimestre",1,0,'C',0);$this->SetXY(100,$y+10);$this->cell(30,5,"",1,0,'C',0);$this->SetXY(130,$y+10);$this->cell(35,5,"",1,0,'C',0);$this->SetXY(165,$y+10);$this->cell(35,5,"",1,0,'C',0);
	$this->SetXY(70,$y+15);$this->cell(30,5,"4eme trimestre",1,0,'C',0);$this->SetXY(100,$y+15);$this->cell(30,5,"",1,0,'C',0);$this->SetXY(130,$y+15);$this->cell(35,5,"",1,0,'C',0);$this->SetXY(165,$y+15);$this->cell(35,5,"",1,0,'C',0);
	$this->SetXY(70,$y+20);$this->cell(30,5,"Total",1,0,'C',1,0);         $this->SetXY(100,$y+20);$this->cell(30,5,"",1,0,'C',1,0);$this->SetXY(130,$y+20);$this->cell(35,5,"",1,0,'C',1,0);$this->SetXY(165,$y+20);$this->cell(35,5,"",1,0,'C',1,0);

	$y=235;
	$ft1=$this->DECMAT('Days',365*20,365*200,$date.'-01-01',$date.'-03-31','F',"=".$STRUCTURED);
	$ft2=$this->DECMAT('Days',365*20,365*200,$date.'-04-01',$date.'-06-30','F',"=".$STRUCTURED);
	$ft3=$this->DECMAT('Days',365*20,365*200,$date.'-07-01',$date.'-09-30','F',"=".$STRUCTURED);
	$ft4=$this->DECMAT('Days',365*20,365*200,$date.'-10-01',$date.'-12-31','F',"=".$STRUCTURED);
	$tf=$ft1+$ft2+$ft3+$ft4;
	$this->SetXY(5,$y);$this->cell(65,25,"Deces maternels",1,0,'C',0);
	$this->SetXY(70,$y);$this->cell(30,5,"1ere trimestre",1,0,'C',0);  $this->SetXY(100,$y);$this->cell(30,5,"",1,0,'C',0);$this->SetXY(130,$y);$this->cell(35,5,$ft1,1,0,'C',0);$this->SetXY(165,$y);$this->cell(35,5,"",1,0,'C',0);
	$this->SetXY(70,$y+5);$this->cell(30,5,"2eme trimestre",1,0,'C',0);$this->SetXY(100,$y+5);$this->cell(30,5,"",1,0,'C',0);$this->SetXY(130,$y+5);$this->cell(35,5,$ft2,1,0,'C',0);$this->SetXY(165,$y+5);$this->cell(35,5,"",1,0,'C',0);
	$this->SetXY(70,$y+10);$this->cell(30,5,"3eme trimestre",1,0,'C',0);$this->SetXY(100,$y+10);$this->cell(30,5,"",1,0,'C',0);$this->SetXY(130,$y+10);$this->cell(35,5,$ft3,1,0,'C',0);$this->SetXY(165,$y+10);$this->cell(35,5,"",1,0,'C',0);
	$this->SetXY(70,$y+15);$this->cell(30,5,"4eme trimestre",1,0,'C',0);$this->SetXY(100,$y+15);$this->cell(30,5,"",1,0,'C',0);$this->SetXY(130,$y+15);$this->cell(35,5,$ft4,1,0,'C',0);$this->SetXY(165,$y+15);$this->cell(35,5,"",1,0,'C',0);
	$this->SetXY(70,$y+20);$this->cell(30,5,"Total",1,0,'C',1,0);       $this->SetXY(100,$y+20);$this->cell(30,5,"",1,0,'C',1,0);$this->SetXY(130,$y+20);$this->cell(35,5,$tf,1,0,'C',1,0);$this->SetXY(165,$y+20);$this->cell(35,5,"",1,0,'C',1,0);

	$this->SetFont('Times', 'B', 13);
	}
	
	function DECESMATERNELS($titre,$datejour1,$datejour2,$EPH1,$STRUCTURED) 
	{
	$this->SetFont('Times', 'B', 11);
	$this->SetXY(5,10);$this->cell(200,5,html_entity_decode(utf8_decode($this->repfr)),0,0,'C',1,0);
	$this->SetXY(5,20);$this->cell(200,5,html_entity_decode(utf8_decode($this->mspfr)),0,0,'C',1,0);
	$this->SetXY(5,30);$this->cell(200,5,html_entity_decode(utf8_decode($this->dspfr)),0,0,'C',1,0);
	$h=50;
	$this->SetFont('Times', 'B', 11);
	$this->SetFillColor(200 );
	$this->SetXY(5,38);$this->cell(195,10,$titre.$this->nbrtostring("structure","id",$STRUCTURED,"structure"),0,0,'C',0);
	$this->SetXY(05,$h);
	$this->cell(20,10,"Date Deces",1,0,1,'C',0);
	$this->cell(45,10,"Nom et Prenom ",1,0,1,'C',0);
	$this->cell(10,10,"Age",1,0,1,'C',0);
	$this->cell(121,10,"Cause du deces",1,0,1,'C',0);
	$this->SetXY(05,$h+10); 
	$this->mysqlconnect();
	$this->SetFont('Arial', '',9, '', true);
	$query = "SELECT * FROM deceshosp where DINS BETWEEN '$datejour1' AND '$datejour2' and STRUCTURED='$STRUCTURED' and DECEMAT=1 order by  DINS     ";
	$resultat=mysql_query($query);
	$totalmbr1=mysql_num_rows($resultat);
	while($row=mysql_fetch_object($resultat))
	{
	$this->SetFillColor(200 );
	$this->cell(20,5,$this->dateUS2FR($row->DINS),1,0,'C',0);
	$this->cell(45,5,$row->NOM.'_'.$row->PRENOM,1,0,'L',0);
	if ($row->Years > 0 ) 
	{
	$this->cell(10,5,$row->Years." A",1,0,'C',0);
	} 
	else 
	{
		if ($row->Days <= 30 ) 
		{
		$this->cell(10,5,$row->Days." J",1,0,'C',0);
		} 
		else
		{
		$this->cell(10,5,$row->Months." M",1,0,'C',0);
		} 
	}
	$this->cell(121,5,html_entity_decode(utf8_decode($this->nbrtostring("CIM","row_id",$row->CODECIM,'diag_nom'))),1,0,'L',0);
	$this->SetXY(5,$this->GetY()+5); 
	}
	$this->SetFillColor(200 );
	$this->SetFont('Arial', '',10, '', true);  
	$this->SetXY(5,$this->GetY());$this->cell(40,05,"TOTAL",1,0,1,'C',0);	  
	$this->SetXY(45,$this->GetY());$this->cell(156,05,$totalmbr1." Deces",1,1,1,'C',0);				 
	// $this->SetXY(150,$this->GetY()+5); $this->cell(90,10,"LE PRATICIEN RESPONSABLE ",0,0,'L',0);
	// $this->SetXY(150,$this->GetY()+5); $this->cell(90,10,'Dr '.$_SESSION["login"],0,0,'L',0);	
	}
	
	
	
	function PAGEDEGARDE($titre,$datejour1,$datejour2,$EPH1,$STRUCTURED) 
	{
	$this->SetXY(5,10);$this->cell(200,5,html_entity_decode(utf8_decode($this->repfr)),0,0,'C',1,0);
	$this->SetXY(5,20);$this->cell(200,5,html_entity_decode(utf8_decode($this->mspfr)),0,0,'C',1,0);
	$this->SetXY(5,30);$this->cell(200,5,html_entity_decode(utf8_decode($this->dspfr)),0,0,'C',1,0);
	$this->SetFont('Times', 'B', 16);
	$this->SetTextColor(0,0,0);$this->SetTextColor(255,0,0);
	$this->SetXY(5,70);$this->cell(200,5,"Mortalite Intra-Hospitaliere",0,0,'C',1,0);
	$this->SetXY(5,80);$this->cell(200,5,"Du ".$this->dateUS2FR($datejour1)." Au ".$this->dateUS2FR($datejour2),0,0,'C',1,0);
	$this->SetXY(5,90);$this->cell(200,5,$this->nbrtostring("structure","id",$STRUCTURED,"structure"),0,0,'C',1,0);
    
	$this->SetTextColor(0,0,0);$this->SetFont('Times', 'B', 11);
	$this->SetXY(5,$this->GetY()+20);$this->cell(200,10,html_entity_decode(utf8_decode("Sommaire")),0,0,'L',1,0);
	$this->SetXY(5,$this->GetY()+10);$this->cell(200,10,html_entity_decode(utf8_decode("I-Distribution des décès par Service D'hospitalisation")),0,0,'L',1,0);
	$this->SetXY(5,$this->GetY()+10);$this->cell(200,10,html_entity_decode(utf8_decode("II-Distribution des décès par Durée D'hospitalisation")),0,0,'L',1,0);
	$this->SetXY(5,$this->GetY()+10);$this->cell(200,10,html_entity_decode(utf8_decode("III-Distribution des décès par tranche d'age et sexe (global)")),0,0,'L',1,0);
	$this->SetXY(5,$this->GetY()+10);$this->cell(200,10,html_entity_decode(utf8_decode("IV-Distribution des décès par tranche d'age et sexe (pediatrique) ")),0,0,'L',1,0);
	$this->SetXY(5,$this->GetY()+10);$this->cell(200,10,html_entity_decode(utf8_decode("V-Distribution des décès par tranche d'age et sexe (Néonatale Précoce) ")),0,0,'L',1,0);
	$this->SetXY(5,$this->GetY()+10);$this->cell(200,10,html_entity_decode(utf8_decode("VI-Distribution des décès par wilaya de residence ")),0,0,'L',1,0);
	$this->SetXY(5,$this->GetY()+10);$this->cell(200,10,html_entity_decode(utf8_decode("VII-Distribution des décès par wilaya de residence (SIG) ")),0,0,'L',1,0);
	$this->SetXY(5,$this->GetY()+10);$this->cell(200,10,html_entity_decode(utf8_decode("VIII-Distribution des décès par communes de residence")),0,0,'L',1,0);
	$this->SetXY(5,$this->GetY()+10);$this->cell(200,10,html_entity_decode(utf8_decode("IX-Distribution des décès par communes de residence (SIG) ")),0,0,'L',1,0);
	$this->SetXY(5,$this->GetY()+10);$this->cell(200,10,html_entity_decode(utf8_decode("X-Distribution des causes de décès suivant la classification internationale des maladies cim10 (chapitres)")),0,0,'L',1,0);
	$this->SetXY(5,$this->GetY()+10);$this->cell(200,10,html_entity_decode(utf8_decode("XI-Distribution des causes de décès suivant la classification internationale des maladies cim10 (categories)")),0,0,'L',1,0);
	$this->SetXY(5,$this->GetY()+10);$this->cell(200,10,html_entity_decode(utf8_decode("XII-SITUATION DEMOGRAPHIQUE")),0,0,'L',1,0);
	$this->SetXY(5,$this->GetY()+10);$this->cell(200,10,html_entity_decode(utf8_decode("XIII-DECES MATERNELS")),0,0,'L',1,0);
	$this->SetXY(5,$this->GetY()+10);$this->cell(200,10,html_entity_decode(utf8_decode("")),0,0,'L',1,0);
	$this->SetXY(5,$this->GetY()+10);$this->cell(200,10,html_entity_decode(utf8_decode("")),0,0,'L',1,0);
	$this->SetTextColor(0,0,0);
	$this->SetFont('Times', 'B', 11);
	}
	
	
	
	function nbrservice($nbrservice,$datejour1,$datejour2,$eph)
	{
	$this->mysqlconnect();
	$sql = " select * from deceshosp where SERVICEHOSPIT=$nbrservice  and STRUCTURED $eph and (DINS BETWEEN '$datejour1' AND '$datejour2')";
	$requete = @mysql_query($sql) or die($sql."<br>".mysql_error());
	$collecte=mysql_num_rows($requete);
	mysql_free_result($requete);
	return $collecte;
	}
	function nbrservicedsexe($sexe,$datejour1,$datejour2,$eph)
	{
	$this->mysqlconnect();
	$sql = " select * from deceshosp where SEX = '$sexe'  and STRUCTURED $eph and (DINS BETWEEN '$datejour1' AND '$datejour2')";
	$requete = @mysql_query($sql) or die($sql."<br>".mysql_error());
	$collecte=mysql_num_rows($requete);
	mysql_free_result($requete);
	return $collecte;
	}
	function servicehospitalisation($titre,$datejour1,$datejour2,$valeurs,$eph) 
	{ 
		$TA1=$this->nbrservice(1,$datejour1,$datejour2,$eph);	
		$TA2=$this->nbrservice(2,$datejour1,$datejour2,$eph);	
		$TA3=$this->nbrservice(3,$datejour1,$datejour2,$eph);	
		$TA4=$this->nbrservice(4,$datejour1,$datejour2,$eph);	
		$TA5=$this->nbrservice(5,$datejour1,$datejour2,$eph);	
		$TA6=$this->nbrservice(6,$datejour1,$datejour2,$eph);	
		$TA7=$this->nbrservice(7,$datejour1,$datejour2,$eph);	
		$TA8=$this->nbrservice(8,$datejour1,$datejour2,$eph);	
		$TA9=$this->nbrservice(9,$datejour1,$datejour2,$eph);	
		$TA10=$this->nbrservice(10,$datejour1,$datejour2,$eph);	
		$TA11=$this->nbrservice(11,$datejour1,$datejour2,$eph);	
		$TA12=$this->nbrservice(12,$datejour1,$datejour2,$eph);	
		$TA13=$this->nbrservice(13,$datejour1,$datejour2,$eph);	
		$TA14=$this->nbrservice(14,$datejour1,$datejour2,$eph);	
		$TA15=$this->nbrservice(15,$datejour1,$datejour2,$eph);	
		$TA16=$this->nbrservice(16,$datejour1,$datejour2,$eph);	
		$TA17=$this->nbrservice(17,$datejour1,$datejour2,$eph);	
		$TA18=$this->nbrservice(18,$datejour1,$datejour2,$eph);	
		$TA19=$this->nbrservice(19,$datejour1,$datejour2,$eph);	
		$TA20=$this->nbrservice(20,$datejour1,$datejour2,$eph);	
		$TA21x=$TA1+$TA2+$TA3+$TA4+$TA5+$TA6+$TA7+$TA8+$TA9+$TA10+$TA11+$TA12+$TA13+$TA14+$TA15+$TA16+$TA17+$TA18+$TA19+$TA20;
		if ($TA21x>0) {
		$TA21=$TA1+$TA2+$TA3+$TA4+$TA5+$TA6+$TA7+$TA8+$TA9+$TA10+$TA11+$TA12+$TA13+$TA14+$TA15+$TA16+$TA17+$TA18+$TA19+$TA20;
		}else{
		$TA21=1;
		} 
		$datamf = array($TA1,$TA2,$TA3,$TA4,$TA5,$TA6,$TA7,$TA8,$TA9,$TA10,$TA11,$TA12,$TA13,$TA14,$TA15,$TA16,$TA17,$TA18,$TA19,$TA20);
		$this->SetXY(5,25+10);$this->cell(285,5,html_entity_decode(utf8_decode("Cette étude a porté sur ".$TA21." décès survenus durant la periode du ".$this->dateUS2FR($datejour1)." au ".$this->dateUS2FR($datejour2)." au niveau de 36 communes ")),0,0,'L',0);
		$this->SetFont('Times', 'B', 10);
		$this->SetXY(5,25);$this->cell(200,5,$titre,1,0,'C',1,0);
		$this->SetXY(5,35+7);$this->cell(105,5,"Repartition des deces par service ",1,0,'L',1,0);
		$this->SetXY(5,35+7+5);$this->cell(10,5,"Num",1,0,'C',1,0);    $this->cell(50,5,"Service",1,0,'L',1,0);                 $this->cell(20,5,"Nbr Deces",1,0,'C',1,0);$this->cell(25,5,"Tx %",1,0,'C',1,0);
		$this->SetXY(5,35+7+10);$this->cell(10,5,"1",1,0,'L',0);       $this->cell(50,5,"Cardiologie",1,0,'L',0);               $this->cell(20,5,$TA1,1,0,'C',0);         $this->cell(25,5,round(($TA1*100)/$TA21,2),1,0,'C',0);
		$this->SetXY(5,35+7+15);$this->cell(10,5,"2",1,0,'L',0);        $this->cell(50,5,"Chirurgie generale",1,0,'L',0);        $this->cell(20,5,$TA2,1,0,'C',0);         $this->cell(25,5,round(($TA2*100)/$TA21,2),1,0,'C',0);
		$this->SetXY(5,35+7+20);$this->cell(10,5,"3",1,0,'L',0);        $this->cell(50,5,"Chirurgie pediatrique",1,0,'L',0);     $this->cell(20,5,$TA3,1,0,'C',0);         $this->cell(25,5,round(($TA3*100)/$TA21,2),1,0,'C',0);
		$this->SetXY(5,35+7+25);$this->cell(10,5,"4",1,0,'L',0);        $this->cell(50,5,"Gastrologie enterologie",1,0,'L',0);   $this->cell(20,5,$TA4,1,0,'C',0);         $this->cell(25,5,round(($TA4*100)/$TA21,2),1,0,'C',0);
		$this->SetXY(5,35+7+30);$this->cell(10,5,"5",1,0,'L',0);        $this->cell(50,5,"Gyneco-obstetrique",1,0,'L',0);        $this->cell(20,5,$TA5,1,0,'C',0);         $this->cell(25,5,round(($TA5*100)/$TA21,2),1,0,'C',0);
		$this->SetXY(5,35+7+35);$this->cell(10,5,"6",1,0,'L',0);        $this->cell(50,5,"Maladies infectieuses",1,0,'L',0);     $this->cell(20,5,$TA6,1,0,'C',0);         $this->cell(25,5,round(($TA6*100)/$TA21,2),1,0,'C',0);
		$this->SetXY(5,35+7+40);$this->cell(10,5,"7",1,0,'L',0);        $this->cell(50,5,"Medecine interne",1,0,'L',0);          $this->cell(20,5,$TA7,1,0,'C',0);         $this->cell(25,5,round(($TA7*100)/$TA21,2),1,0,'C',0);
		$this->SetXY(5,35+7+45);$this->cell(10,5,"8",1,0,'L',0);        $this->cell(50,5,"Nephrologie hemodialyse",1,0,'L',0);   $this->cell(20,5,$TA8,1,0,'C',0);         $this->cell(25,5,round(($TA8*100)/$TA21,2),1,0,'C',0);
		$this->SetXY(5,35+7+50);$this->cell(10,5,"9",1,0,'L',0);        $this->cell(50,5,"Neurochirurgie",1,0,'L',0);            $this->cell(20,5,$TA9,1,0,'C',0);         $this->cell(25,5,round(($TA9*100)/$TA21,2),1,0,'C',0);
		$this->SetXY(5,35+7+55);$this->cell(10,5,"10",1,0,'L',0);       $this->cell(50,5,"Neonatologie",1,0,'L',0);              $this->cell(20,5,$TA10,1,0,'C',0);         $this->cell(25,5,round(($TA10*100)/$TA21,2),1,0,'C',0);
		$this->SetXY(5,35+7+60);$this->cell(10,5,"11",1,0,'L',0);       $this->cell(50,5,"Orthopedie traumatologie",1,0,'L',0);  $this->cell(20,5,$TA11,1,0,'C',0);         $this->cell(25,5,round(($TA11*100)/$TA21,2),1,0,'C',0);
		$this->SetXY(5,35+7+65);$this->cell(10,5,"12",1,0,'L',0);       $this->cell(50,5,"Ophtalmologie",1,0,'L',0);             $this->cell(20,5,$TA12,1,0,'C',0);         $this->cell(25,5,round(($TA12*100)/$TA21,2),1,0,'C',0);
		$this->SetXY(5,35+7+70);$this->cell(10,5,"13",1,0,'L',0);       $this->cell(50,5,"Oto-rhino-laryngologie",1,0,'L',0);    $this->cell(20,5,$TA13,1,0,'C',0);         $this->cell(25,5,round(($TA13*100)/$TA21,2),1,0,'C',0);
		$this->SetXY(5,35+7+75);$this->cell(10,5,"14",1,0,'L',0);       $this->cell(50,5,"Oncologie medicale",1,0,'L',0);        $this->cell(20,5,$TA14,1,0,'C',0);         $this->cell(25,5,round(($TA14*100)/$TA21,2),1,0,'C',0);
		$this->SetXY(5,35+7+80);$this->cell(10,5,"15",1,0,'L',0);       $this->cell(50,5,"Pediaitrie",1,0,'L',0);                $this->cell(20,5,$TA15,1,0,'C',0);         $this->cell(25,5,round(($TA15*100)/$TA21,2),1,0,'C',0);
		$this->SetXY(5,35+7+85);$this->cell(10,5,"16",1,0,'L',0);       $this->cell(50,5,"Pneumo-phtisiologie",1,0,'L',0);       $this->cell(20,5,$TA16,1,0,'C',0);         $this->cell(25,5,round(($TA16*100)/$TA21,2),1,0,'C',0);
		$this->SetXY(5,35+7+90);$this->cell(10,5,"17",1,0,'L',0);       $this->cell(50,5,"Psychiatrie",1,0,'L',0);               $this->cell(20,5,$TA17,1,0,'C',0);         $this->cell(25,5,round(($TA17*100)/$TA21,2),1,0,'C',0);
		$this->SetXY(5,35+7+95);$this->cell(10,5,"18",1,0,'L',0);       $this->cell(50,5,"Reanimation",1,0,'L',0);               $this->cell(20,5,$TA18,1,0,'C',0);         $this->cell(25,5,round(($TA18*100)/$TA21,2),1,0,'C',0);
		$this->SetXY(5,35+7+100);$this->cell(10,5,"19",1,0,'L',0);       $this->cell(50,5,"Urologie",1,0,'L',0);                  $this->cell(20,5,$TA19,1,0,'C',0);         $this->cell(25,5,round(($TA19*100)/$TA21,2),1,0,'C',0);
		$this->SetXY(5,35+7+105);$this->cell(10,5,"20",1,0,'L',0);      $this->cell(50,5,"Umc",1,0,'L',0);                       $this->cell(20,5,$TA20,1,0,'C',0);         $this->cell(25,5,round(($TA20*100)/$TA21,2),1,0,'C',0);
        $this->SetXY(5,35+7+110); $this->cell(60,5,"Total",1,0,'L',1,0);$this->cell(20,5,$TA21,1,0,'C',1,0);                     $this->cell(25,5,round(($TA21*100)/$TA21,2),1,0,'C',1,0);						
		$mas=$this->nbrservicedsexe('M',$datejour1,$datejour2,$eph);
		$fem=$this->nbrservicedsexe('F',$datejour1,$datejour2,$eph);
		$pie2 = array(
		"x" => 135, 
		"y" => 200, 
		"r" => 17,
		"v1" =>$mas ,
		"v2" =>$fem ,
		"t0" => html_entity_decode(utf8_decode("Distribution des décès par sexe ")),
		"t1" => "M",
		"t2" => "F");
		$this->pie2($pie2);
		$this->SetXY(5,160);$this->cell(285,5,html_entity_decode(utf8_decode("1-Repartition des deces par service : ")),0,0,'L',0);
	    rsort($datamf);
	    $this->SetXY(5,165);$this->cell(285,5,html_entity_decode(utf8_decode("la proportion des décès la plus élevée est : ".round($datamf[0]*100/$TA21,2)."%")),0,0,'L',0);
	    sort($datamf);
	    $this->SetXY(5,170);$this->cell(285,5,html_entity_decode(utf8_decode("la proportion des décès la moins élevée est : ".round($datamf[0]*100/$TA21,2)."%")),0,0,'L',0);
		$this->SetXY(5,175+5);  $this->cell(285,5,html_entity_decode(utf8_decode("2-Répartition des décès par sexe : ")),0,0,'L',0);
	    $this->SetXY(5,175+10);$this->cell(285,5,html_entity_decode(utf8_decode("La répartition des ".$TA21." décès enregistrés montre que :")),0,0,'L',0);
	    $this->SetXY(5,175+15);$this->cell(285,5,html_entity_decode(utf8_decode(round(($mas/$TA21)*100,2)."% des décès touche les hommes. ")),0,0,'L',0);
	    $this->SetXY(5,175+20);$this->cell(285,5,html_entity_decode(utf8_decode(round(($fem/$TA21)*100,2)."% des décès touche les femmes. ")),0,0,'L',0);
	    if ($fem > 0){$fem=$fem;}else{$fem=1;}
	    $this->SetXY(5,175+25);$this->cell(285,5,html_entity_decode(utf8_decode("avec un sexe ratio de ".round(($mas/$fem),2))),0,0,'L',0);
		$this->barservice(135,150,$TA1,$TA2,$TA3,$TA4,$TA5,$TA6,$TA7,$TA8,$TA9,$TA10,$TA11,$TA12,$TA13,$TA14,$TA15,$TA16,$TA17,$TA18,$TA19,$TA20,$titre); 	
		}
	
	    function nbrservicedinf($nbrservice,$datejour1,$datejour2,$eph)
		{
		$this->mysqlconnect();
		$sql = " select * from deceshosp where DUREEHOSPIT <= $nbrservice  and STRUCTURED $eph and (DINS BETWEEN '$datejour1' AND '$datejour2')";
		$requete = @mysql_query($sql) or die($sql."<br>".mysql_error());
		$collecte=mysql_num_rows($requete);
		mysql_free_result($requete);
		return $collecte;
		}

		function nbrservicedsup($nbrservice,$datejour1,$datejour2,$eph)
		{
		$this->mysqlconnect();
		$sql = " select * from deceshosp where DUREEHOSPIT >= $nbrservice  and STRUCTURED $eph and (DINS BETWEEN '$datejour1' AND '$datejour2')";
		$requete = @mysql_query($sql) or die($sql."<br>".mysql_error());
		$collecte=mysql_num_rows($requete);
		mysql_free_result($requete);
		return $collecte;
		}

		function nbrserviced($nbrservice,$datejour1,$datejour2,$eph)
		{
		$this->mysqlconnect();
		$sql = " select * from deceshosp where DUREEHOSPIT=$nbrservice  and STRUCTURED $eph and (DINS BETWEEN '$datejour1' AND '$datejour2')";
		$requete = @mysql_query($sql) or die($sql."<br>".mysql_error());
		$collecte=mysql_num_rows($requete);
		mysql_free_result($requete);
		return $collecte;
		}
		function dureehospitalisation1($titre,$datejour1,$datejour2,$valeurs,$eph) 
	   { 
		$TA1=$this->nbrservicedinf(0,$datejour1,$datejour2,$eph);	
		$TA2=$this->nbrserviced(1,$datejour1,$datejour2,$eph);	
		$TA3=$this->nbrserviced(2,$datejour1,$datejour2,$eph);	
		$TA4=$this->nbrserviced(3,$datejour1,$datejour2,$eph);	
		$TA5=$this->nbrserviced(4,$datejour1,$datejour2,$eph);	
		$TA6=$this->nbrserviced(5,$datejour1,$datejour2,$eph);	
		$TA7=$this->nbrserviced(6,$datejour1,$datejour2,$eph);	
		$TA8=$this->nbrserviced(7,$datejour1,$datejour2,$eph);	
		$TA9=$this->nbrserviced(8,$datejour1,$datejour2,$eph);	
		$TA10=$this->nbrserviced(9,$datejour1,$datejour2,$eph);	
		$TA11=$this->nbrserviced(10,$datejour1,$datejour2,$eph);	
		$TA12=$this->nbrserviced(11,$datejour1,$datejour2,$eph);	
		$TA13=$this->nbrserviced(12,$datejour1,$datejour2,$eph);	
		$TA14=$this->nbrserviced(13,$datejour1,$datejour2,$eph);	
		$TA15=$this->nbrserviced(14,$datejour1,$datejour2,$eph);	
		$TA16=$this->nbrserviced(15,$datejour1,$datejour2,$eph);	
		$TA17=$this->nbrserviced(16,$datejour1,$datejour2,$eph);	
		$TA18=$this->nbrserviced(17,$datejour1,$datejour2,$eph);	
		$TA19=$this->nbrserviced(18,$datejour1,$datejour2,$eph);	
		$TA20=$this->nbrservicedsup(19,$datejour1,$datejour2,$eph);	
		$TA21x=$TA1+$TA2+$TA3+$TA4+$TA5+$TA6+$TA7+$TA8+$TA9+$TA10+$TA11+$TA12+$TA13+$TA14+$TA15+$TA16+$TA17+$TA18+$TA19+$TA20;
		if ($TA21x>0) {
		$TA21=$TA1+$TA2+$TA3+$TA4+$TA5+$TA6+$TA7+$TA8+$TA9+$TA10+$TA11+$TA12+$TA13+$TA14+$TA15+$TA16+$TA17+$TA18+$TA19+$TA20;
		}else{
		$TA21=1;
		} 
		$datamf = array($TA1,$TA2,$TA3,$TA4,$TA5,$TA6,$TA7,$TA8,$TA9,$TA10,$TA11,$TA12,$TA13,$TA14,$TA15,$TA16,$TA17,$TA18,$TA19,$TA20);
		$this->SetXY(5,25+10);$this->cell(285,5,html_entity_decode(utf8_decode("Cette étude a porté sur ".$TA21." décès survenus durant la periode du ".$this->dateUS2FR($datejour1)." au ".$this->dateUS2FR($datejour2)." au niveau de 36 communes ")),0,0,'L',0);
		$this->SetFont('Times', 'B', 10);
		$this->SetXY(5,25);$this->cell(200,5,$titre,1,0,'C',1,0);
		$this->SetXY(5,35+7);$this->cell(105,5,html_entity_decode(utf8_decode("Repartition des deces par Durée D'hospitalisation ")),1,0,'L',1,0);
		$this->SetXY(5,35+7+5);$this->cell(60,5,"Nombre de jours",1,0,'C',1,0);                    $this->cell(20,5,"Nbr Deces",1,0,'C',1,0);$this->cell(25,5,"Tx %",1,0,'C',1,0);
		$this->SetXY(5,35+7+10);$this->cell(60,5,"0",1,0,'C',0);        $this->cell(20,5,$TA1,1,0,'C',0);         $this->cell(25,5,round(($TA1*100)/$TA21,2),1,0,'C',0);
		$this->SetXY(5,35+7+15);$this->cell(60,5,"1",1,0,'C',0);        $this->cell(20,5,$TA2,1,0,'C',0);         $this->cell(25,5,round(($TA2*100)/$TA21,2),1,0,'C',0);
		$this->SetXY(5,35+7+20);$this->cell(60,5,"2",1,0,'C',0);        $this->cell(20,5,$TA3,1,0,'C',0);         $this->cell(25,5,round(($TA3*100)/$TA21,2),1,0,'C',0);
		$this->SetXY(5,35+7+25);$this->cell(60,5,"3",1,0,'C',0);        $this->cell(20,5,$TA4,1,0,'C',0);         $this->cell(25,5,round(($TA4*100)/$TA21,2),1,0,'C',0);
		$this->SetXY(5,35+7+30);$this->cell(60,5,"4",1,0,'C',0);        $this->cell(20,5,$TA5,1,0,'C',0);         $this->cell(25,5,round(($TA5*100)/$TA21,2),1,0,'C',0);
		$this->SetXY(5,35+7+35);$this->cell(60,5,"5",1,0,'C',0);        $this->cell(20,5,$TA6,1,0,'C',0);         $this->cell(25,5,round(($TA6*100)/$TA21,2),1,0,'C',0);
		$this->SetXY(5,35+7+40);$this->cell(60,5,"6",1,0,'C',0);        $this->cell(20,5,$TA7,1,0,'C',0);         $this->cell(25,5,round(($TA7*100)/$TA21,2),1,0,'C',0);
		$this->SetXY(5,35+7+45);$this->cell(60,5,"7",1,0,'C',0);        $this->cell(20,5,$TA8,1,0,'C',0);         $this->cell(25,5,round(($TA8*100)/$TA21,2),1,0,'C',0);
		$this->SetXY(5,35+7+50);$this->cell(60,5,"8",1,0,'C',0);        $this->cell(20,5,$TA9,1,0,'C',0);         $this->cell(25,5,round(($TA9*100)/$TA21,2),1,0,'C',0);
		$this->SetXY(5,35+7+55);$this->cell(60,5,"9",1,0,'C',0);        $this->cell(20,5,$TA10,1,0,'C',0);         $this->cell(25,5,round(($TA10*100)/$TA21,2),1,0,'C',0);
		$this->SetXY(5,35+7+60);$this->cell(60,5,"10",1,0,'C',0);       $this->cell(20,5,$TA11,1,0,'C',0);         $this->cell(25,5,round(($TA11*100)/$TA21,2),1,0,'C',0);
		$this->SetXY(5,35+7+65);$this->cell(60,5,"11",1,0,'C',0);       $this->cell(20,5,$TA12,1,0,'C',0);         $this->cell(25,5,round(($TA12*100)/$TA21,2),1,0,'C',0);
		$this->SetXY(5,35+7+70);$this->cell(60,5,"12",1,0,'C',0);       $this->cell(20,5,$TA13,1,0,'C',0);         $this->cell(25,5,round(($TA13*100)/$TA21,2),1,0,'C',0);
		$this->SetXY(5,35+7+75);$this->cell(60,5,"13",1,0,'C',0);       $this->cell(20,5,$TA14,1,0,'C',0);         $this->cell(25,5,round(($TA14*100)/$TA21,2),1,0,'C',0);
		$this->SetXY(5,35+7+80);$this->cell(60,5,"14",1,0,'C',0);       $this->cell(20,5,$TA15,1,0,'C',0);         $this->cell(25,5,round(($TA15*100)/$TA21,2),1,0,'C',0);
		$this->SetXY(5,35+7+85);$this->cell(60,5,"15",1,0,'C',0);       $this->cell(20,5,$TA16,1,0,'C',0);         $this->cell(25,5,round(($TA16*100)/$TA21,2),1,0,'C',0);
		$this->SetXY(5,35+7+90);$this->cell(60,5,"16",1,0,'C',0);       $this->cell(20,5,$TA17,1,0,'C',0);         $this->cell(25,5,round(($TA17*100)/$TA21,2),1,0,'C',0);
		$this->SetXY(5,35+7+95);$this->cell(60,5,"17",1,0,'C',0);       $this->cell(20,5,$TA18,1,0,'C',0);         $this->cell(25,5,round(($TA18*100)/$TA21,2),1,0,'C',0);
		$this->SetXY(5,35+7+100);$this->cell(60,5,"18",1,0,'C',0);      $this->cell(20,5,$TA19,1,0,'C',0);         $this->cell(25,5,round(($TA19*100)/$TA21,2),1,0,'C',0);
		$this->SetXY(5,35+7+105);$this->cell(60,5,">=19",1,0,'C',0);     $this->cell(20,5,$TA20,1,0,'C',0);         $this->cell(25,5,round(($TA20*100)/$TA21,2),1,0,'C',0);
        $this->SetXY(5,35+7+110); $this->cell(60,5,"Total",1,0,'L',1,0);$this->cell(20,5,$TA21,1,0,'C',1,0);        $this->cell(25,5,round(($TA21*100)/$TA21,2),1,0,'C',1,0);						
		$mas=$this->nbrservicedsexe('M',$datejour1,$datejour2,$eph);
		$fem=$this->nbrservicedsexe('F',$datejour1,$datejour2,$eph);
		$pie2 = array(
		"x" => 135, 
		"y" => 200, 
		"r" => 17,
		"v1" =>$mas ,
		"v2" =>$fem ,
		"t0" => html_entity_decode(utf8_decode("Distribution des décès par sexe ")),
		"t1" => "M",
		"t2" => "F");
		$this->pie2($pie2);
		$this->SetXY(5,175+5);  $this->cell(285,5,html_entity_decode(utf8_decode("2-Répartition des décès par sexe : ")),0,0,'L',0);
	    $this->SetXY(5,175+10);$this->cell(285,5,html_entity_decode(utf8_decode("La répartition des ".$TA21." décès enregistrés montre que :")),0,0,'L',0);
	    $this->SetXY(5,175+15);$this->cell(285,5,html_entity_decode(utf8_decode(round(($mas/$TA21)*100,2)."% des décès touche les hommes. ")),0,0,'L',0);
	    $this->SetXY(5,175+20);$this->cell(285,5,html_entity_decode(utf8_decode(round(($fem/$TA21)*100,2)."% des décès touche les femmes. ")),0,0,'L',0);
	    if ($fem > 0){$fem=$fem;}else{$fem=1;}
	    $this->SetXY(5,175+25);$this->cell(285,5,html_entity_decode(utf8_decode("avec un sexe ratio de ".round(($mas/$fem),2))),0,0,'L',0);
		$this->SetXY(5,160);$this->cell(285,5,html_entity_decode(utf8_decode("1-Repartition des deces par Durée D'hospitalisation : ")),0,0,'L',0);
	    rsort($datamf);
	    $this->SetXY(5,165);$this->cell(285,5,html_entity_decode(utf8_decode("la proportion des décès la plus élevée est : ".round($datamf[0]*100/$TA21,2)."%")),0,0,'L',0);
	    sort($datamf);
	    $this->SetXY(5,170);$this->cell(285,5,html_entity_decode(utf8_decode("la proportion des décès la moins élevée est : ".round($datamf[0]*100/$TA21,2)."%")),0,0,'L',0);
		$this->barservice(135,150,$TA1,$TA2,$TA3,$TA4,$TA5,$TA6,$TA7,$TA8,$TA9,$TA10,$TA11,$TA12,$TA13,$TA14,$TA15,$TA16,$TA17,$TA18,$TA19,$TA20,$titre); 	
	    }
		
	function T2F20($data,$datejour1,$datejour2)  //tableau  corige le 15/08/2016
    {
	$this->SetXY($data['xt'],$data['yt']);     $this->cell(105,05,$data['tt'],1,0,'L',1,0);
	$this->SetXY($data['xt'],$this->GetY()+5); $this->cell(15,15,$data['tl'],1,0,'C',1,0);
	$this->SetXY($data['xt']+15,$this->GetY());$this->cell(75+15,10,$data['tc'],1,0,'C',1,0);$this->SetXY($data['xt']+15,$this->GetY()+10);$this->cell(30,5,$data['tc1'],1,0,'C',1,0); $this->SetXY($data['xt']+45,$this->GetY());$this->cell(30,5,$data['tc3'],1,0,'C',1,0);$this->SetXY($data['xt']+75,$this->GetY());$this->cell(15,5,$data['tc5'],1,0,'C',1,0);$this->SetXY($data['xt']+75+15,$this->GetY());$this->cell(15,5,'P %',1,0,'C',1,0);
	
	$TM=$data['1M']+$data['2M']+$data['3M']+$data['4M']+$data['5M']+$data['6M']+$data['7M']+$data['8M']+$data['9M']+$data['10M']+$data['11M']+$data['12M']+$data['13M']+$data['14M']+$data['15M']+$data['16M']+$data['17M']+$data['18M']+$data['19M']+$data['20M'];
	$TF=$data['1F']+$data['2F']+$data['3F']+$data['4F']+$data['5F']+$data['6F']+$data['7F']+$data['8F']+$data['9F']+$data['10F']+$data['11F']+$data['12F']+$data['13F']+$data['14F']+$data['15F']+$data['16F']+$data['17F']+$data['18F']+$data['19F']+$data['20F'];
	if ($TM+$TF > 0){$T=$TM+$TF;}else{$T=1;}
	$datamf = array($data['1M']+$data['1F'],
	                $data['2M']+$data['2F'],
					$data['3M']+$data['3F'],
					$data['4M']+$data['4F'],
					$data['5M']+$data['5F'],
					$data['6M']+$data['6F'],
					$data['7M']+$data['7F'],
					$data['8M']+$data['8F'],
					$data['9M']+$data['9F'],
					$data['10M']+$data['10F'],
					$data['11M']+$data['11F'],
					$data['12M']+$data['12F'],
					$data['13M']+$data['13F'],
					$data['14M']+$data['14F'],
					$data['15M']+$data['15F'],
					$data['16M']+$data['16F'],
					$data['17M']+$data['17F'],
					$data['18M']+$data['18F'],
					$data['19M']+$data['19F'],
					$data['20M']+$data['20F']);

	$this->SetXY($data['xt'],$this->GetY()+5);$this->cell(15,5,$data['1MF'],1,0,'C',1,0);
	$this->SetXY($data['xt']+15,$this->GetY());$this->cell(30,5,$data['1M'],1,0,'C',0,0);
	$this->SetXY($data['xt']+45,$this->GetY());$this->cell(30,5,$data['1F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75,$this->GetY());$this->cell(15,5,$data['1M']+$data['1F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75+15,$this->GetY());$this->cell(15,5,round(((($data['1M']+$data['1F'])/$T)*100),2).' %',1,0,'R',1,0);        
	
	$this->SetXY($data['xt'],$this->GetY()+5);$this->cell(15,5,$data['2MF'],1,0,'C',1,0);
	$this->SetXY($data['xt']+15,$this->GetY());$this->cell(30,5,$data['2M'],1,0,'C',0,0);
	$this->SetXY($data['xt']+45,$this->GetY());$this->cell(30,5,$data['2F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75,$this->GetY());$this->cell(15,5,$data['2M']+$data['2F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75+15,$this->GetY());$this->cell(15,5,round(((($data['2M']+$data['2F'])/$T)*100),2).' %',1,0,'R',1,0);        
 
	$this->SetXY($data['xt'],$this->GetY()+5);$this->cell(15,5,$data['3MF'],1,0,'C',1,0);
	$this->SetXY($data['xt']+15,$this->GetY());$this->cell(30,5,$data['3M'],1,0,'C',0,0);
	$this->SetXY($data['xt']+45,$this->GetY());$this->cell(30,5,$data['3F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75,$this->GetY());$this->cell(15,5,$data['3M']+$data['3F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75+15,$this->GetY());$this->cell(15,5,round(((($data['3M']+$data['3F'])/$T)*100),2).' %',1,0,'R',1,0);        
	 
	$this->SetXY($data['xt'],$this->GetY()+5);$this->cell(15,5,$data['4MF'],1,0,'C',1,0);
	$this->SetXY($data['xt']+15,$this->GetY());$this->cell(30,5,$data['4M'],1,0,'C',0,0);
	$this->SetXY($data['xt']+45,$this->GetY());$this->cell(30,5,$data['4F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75,$this->GetY());$this->cell(15,5,$data['4M']+$data['4F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75+15,$this->GetY());$this->cell(15,5,round(((($data['4M']+$data['4F'])/$T)*100),2).' %',1,0,'R',1,0);        
	
	$this->SetXY($data['xt'],$this->GetY()+5);$this->cell(15,5,$data['5MF'],1,0,'C',1,0);
	$this->SetXY($data['xt']+15,$this->GetY());$this->cell(30,5,$data['5M'],1,0,'C',0,0);
	$this->SetXY($data['xt']+45,$this->GetY());$this->cell(30,5,$data['5F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75,$this->GetY());$this->cell(15,5,$data['5M']+$data['5F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75+15,$this->GetY());$this->cell(15,5,round(((($data['5M']+$data['5F'])/$T)*100),2).' %',1,0,'R',1,0);        
	 
	$this->SetXY($data['xt'],$this->GetY()+5);$this->cell(15,5,$data['6MF'],1,0,'C',1,0);
	$this->SetXY($data['xt']+15,$this->GetY());$this->cell(30,5,$data['6M'],1,0,'C',0,0);
	$this->SetXY($data['xt']+45,$this->GetY());$this->cell(30,5,$data['6F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75,$this->GetY());$this->cell(15,5,$data['6M']+$data['6F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75+15,$this->GetY());$this->cell(15,5,round(((($data['6M']+$data['6F'])/$T)*100),2).' %',1,0,'R',1,0);        
	
	$this->SetXY($data['xt'],$this->GetY()+5);$this->cell(15,5,$data['7MF'],1,0,'C',1,0);
	$this->SetXY($data['xt']+15,$this->GetY());$this->cell(30,5,$data['7M'],1,0,'C',0,0);
	$this->SetXY($data['xt']+45,$this->GetY());$this->cell(30,5,$data['7F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75,$this->GetY());$this->cell(15,5,$data['7M']+$data['7F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75+15,$this->GetY());$this->cell(15,5,round(((($data['7M']+$data['7F'])/$T)*100),2).' %',1,0,'R',1,0);        
 
	$this->SetXY($data['xt'],$this->GetY()+5);$this->cell(15,5,$data['8MF'],1,0,'C',1,0);
	$this->SetXY($data['xt']+15,$this->GetY());$this->cell(30,5,$data['8M'],1,0,'C',0,0);
	$this->SetXY($data['xt']+45,$this->GetY());$this->cell(30,5,$data['8F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75,$this->GetY());$this->cell(15,5,$data['8M']+$data['8F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75+15,$this->GetY());$this->cell(15,5,round(((($data['8M']+$data['8F'])/$T)*100),2).' %',1,0,'R',1,0);        
	
	$this->SetXY($data['xt'],$this->GetY()+5);$this->cell(15,5,$data['9MF'],1,0,'C',1,0);
	$this->SetXY($data['xt']+15,$this->GetY());$this->cell(30,5,$data['9M'],1,0,'C',0,0);
	$this->SetXY($data['xt']+45,$this->GetY());$this->cell(30,5,$data['9F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75,$this->GetY());$this->cell(15,5,$data['9M']+$data['9F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75+15,$this->GetY());$this->cell(15,5,round(((($data['9M']+$data['9F'])/$T)*100),2).' %',1,0,'R',1,0);        
	
	$this->SetXY($data['xt'],$this->GetY()+5);$this->cell(15,5,$data['10MF'],1,0,'C',1,0);
	$this->SetXY($data['xt']+15,$this->GetY());$this->cell(30,5,$data['10M'],1,0,'C',0,0);
	$this->SetXY($data['xt']+45,$this->GetY());$this->cell(30,5,$data['10F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75,$this->GetY());$this->cell(15,5,$data['10M']+$data['10F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75+15,$this->GetY());$this->cell(15,5,round(((($data['10M']+$data['10F'])/$T)*100),2).' %',1,0,'R',1,0);        
	
	$this->SetXY($data['xt'],$this->GetY()+5);$this->cell(15,5,$data['11MF'],1,0,'C',1,0);
	$this->SetXY($data['xt']+15,$this->GetY());$this->cell(30,5,$data['11M'],1,0,'C',0,0);
	$this->SetXY($data['xt']+45,$this->GetY());$this->cell(30,5,$data['11F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75,$this->GetY());$this->cell(15,5,$data['11M']+$data['11F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75+15,$this->GetY());$this->cell(15,5,round(((($data['11M']+$data['11F'])/$T)*100),2).' %',1,0,'R',1,0);        
	
	$this->SetXY($data['xt'],$this->GetY()+5);$this->cell(15,5,$data['12MF'],1,0,'C',1,0);
	$this->SetXY($data['xt']+15,$this->GetY());$this->cell(30,5,$data['12M'],1,0,'C',0,0);
	$this->SetXY($data['xt']+45,$this->GetY());$this->cell(30,5,$data['12F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75,$this->GetY());$this->cell(15,5,$data['12M']+$data['12F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75+15,$this->GetY());$this->cell(15,5,round(((($data['12M']+$data['12F'])/$T)*100),2).' %',1,0,'R',1,0);        
	
	$this->SetXY($data['xt'],$this->GetY()+5);$this->cell(15,5,$data['13MF'],1,0,'C',1,0);
	$this->SetXY($data['xt']+15,$this->GetY());$this->cell(30,5,$data['13M'],1,0,'C',0,0);
	$this->SetXY($data['xt']+45,$this->GetY());$this->cell(30,5,$data['13F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75,$this->GetY());$this->cell(15,5,$data['13M']+$data['13F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75+15,$this->GetY());$this->cell(15,5,round(((($data['13M']+$data['13F'])/$T)*100),2).' %',1,0,'R',1,0);        
	
	$this->SetXY($data['xt'],$this->GetY()+5);$this->cell(15,5,$data['14MF'],1,0,'C',1,0);
	$this->SetXY($data['xt']+15,$this->GetY());$this->cell(30,5,$data['14M'],1,0,'C',0,0);
	$this->SetXY($data['xt']+45,$this->GetY());$this->cell(30,5,$data['14F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75,$this->GetY());$this->cell(15,5,$data['14M']+$data['14F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75+15,$this->GetY());$this->cell(15,5,round(((($data['14M']+$data['14F'])/$T)*100),2).' %',1,0,'R',1,0);        
	
	$this->SetXY($data['xt'],$this->GetY()+5);$this->cell(15,5,$data['15MF'],1,0,'C',1,0);
	$this->SetXY($data['xt']+15,$this->GetY());$this->cell(30,5,$data['15M'],1,0,'C',0,0);
	$this->SetXY($data['xt']+45,$this->GetY());$this->cell(30,5,$data['15F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75,$this->GetY());$this->cell(15,5,$data['15M']+$data['15F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75+15,$this->GetY());$this->cell(15,5,round(((($data['15M']+$data['15F'])/$T)*100),2).' %',1,0,'R',1,0);        
	
	$this->SetXY($data['xt'],$this->GetY()+5); $this->cell(15,5,$data['16MF'],1,0,'C',1,0);
	$this->SetXY($data['xt']+15,$this->GetY());$this->cell(30,5,$data['16M'],1,0,'C',0,0);
	$this->SetXY($data['xt']+45,$this->GetY());$this->cell(30,5,$data['16F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75,$this->GetY());$this->cell(15,5,$data['16M']+$data['16F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75+15,$this->GetY());$this->cell(15,5,round(((($data['16M']+$data['16F'])/$T)*100),2).' %',1,0,'R',1,0);        
	
	$this->SetXY($data['xt'],$this->GetY()+5); $this->cell(15,5,$data['17MF'],1,0,'C',1,0);
	$this->SetXY($data['xt']+15,$this->GetY());$this->cell(30,5,$data['17M'],1,0,'C',0,0);
	$this->SetXY($data['xt']+45,$this->GetY());$this->cell(30,5,$data['17F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75,$this->GetY());$this->cell(15,5,$data['17M']+$data['17F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75+15,$this->GetY());$this->cell(15,5,round(((($data['17M']+$data['17F'])/$T)*100),2).' %',1,0,'R',1,0);        
	
	$this->SetXY($data['xt'],$this->GetY()+5); $this->cell(15,5,$data['18MF'],1,0,'C',1,0);
	$this->SetXY($data['xt']+15,$this->GetY());$this->cell(30,5,$data['18M'],1,0,'C',0,0);
	$this->SetXY($data['xt']+45,$this->GetY());$this->cell(30,5,$data['18F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75,$this->GetY());$this->cell(15,5,$data['18M']+$data['18F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75+15,$this->GetY());$this->cell(15,5,round(((($data['18M']+$data['18F'])/$T)*100),2).' %',1,0,'R',1,0);        
	
	$this->SetXY($data['xt'],$this->GetY()+5); $this->cell(15,5,$data['19MF'],1,0,'C',1,0);
	$this->SetXY($data['xt']+15,$this->GetY());$this->cell(30,5,$data['19M'],1,0,'C',0,0);
	$this->SetXY($data['xt']+45,$this->GetY());$this->cell(30,5,$data['19F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75,$this->GetY());$this->cell(15,5,$data['19M']+$data['19F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75+15,$this->GetY());$this->cell(15,5,round(((($data['19M']+$data['19F'])/$T)*100),2).' %',1,0,'R',1,0);        
	
	$this->SetXY($data['xt'],$this->GetY()+5); $this->cell(15,5,$data['20MF'],1,0,'C',1,0);
	$this->SetXY($data['xt']+15,$this->GetY());$this->cell(30,5,$data['20M'],1,0,'C',0,0);
	$this->SetXY($data['xt']+45,$this->GetY());$this->cell(30,5,$data['20F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75,$this->GetY());$this->cell(15,5,$data['20M']+$data['20F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75+15,$this->GetY());$this->cell(15,5,round(((($data['20M']+$data['20F'])/$T)*100),2).' %',1,0,'R',1,0);        
	
	$this->SetXY($data['xt'],$this->GetY()+5);$this->cell(15,5,'Total',1,0,'C',1,0);
	$this->SetXY($data['xt']+15,$this->GetY());$this->cell(30,5,$TM,1,0,'C',1,0);
	$this->SetXY($data['xt']+45,$this->GetY());$this->cell(30,5,$TF,1,0,'C',1,0);
	$this->SetXY($data['xt']+75,$this->GetY());$this->cell(15,5,$T,1,0,'C',1,0);
	$this->SetXY($data['xt']+75+15,$this->GetY());$this->cell(15,5,round(((($TM+$TF)/$T)*100),2).' %',1,0,'R',1,0); 	                                                                
	
	$this->SetXY($data['xt'],$this->GetY()+5); $this->cell(15,5,'P %',1,0,'C',1,0);      
	$this->SetXY($data['xt']+15,$this->GetY());$this->cell(30,5,round(($TM/$T)*100,2),1,0,'C',1,0);
	$this->SetXY($data['xt']+45,$this->GetY());$this->cell(30,5,round(($TF/$T)*100,2),1,0,'C',1,0);
	$this->SetXY($data['xt']+75,$this->GetY());$this->cell(15,5,round(($T/$T)*100,2).' %',1,0,'C',1,0);
	$this->SetXY($data['xt']+75+15,$this->GetY());$this->cell(15,5,'***',1,0,'C',1,0); 	                                                                
	
	$this->SetXY(5,25+10);$this->cell(285,5,html_entity_decode(utf8_decode("Cette étude a porté sur ".$T." décès survenus durant la periode du ".$this->dateUS2FR($datejour1)." au ".$this->dateUS2FR($datejour2)." au niveau de 36 communes ")),0,0,'L',0);
	$this->SetXY(5,175);  $this->cell(285,5,html_entity_decode(utf8_decode("1-Répartition des décès par sexe : ")),0,0,'L',0);
	$this->SetXY(5,175+5);$this->cell(285,5,html_entity_decode(utf8_decode("La répartition des ".$T." décès enregistrés montre que :")),0,0,'L',0);
	$this->SetXY(5,175+10);$this->cell(285,5,html_entity_decode(utf8_decode(round(($TM/$T)*100,2)."% des décès touche les hommes. ")),0,0,'L',0);
	$this->SetXY(5,175+15);$this->cell(285,5,html_entity_decode(utf8_decode(round(($TF/$T)*100,2)."% des décès touche les femmes. ")),0,0,'L',0);
	if ($TF > 0){$TF0=$TF;}else{$TF0=1;}
	$this->SetXY(5,175+20);$this->cell(285,5,html_entity_decode(utf8_decode("avec un sexe ratio de ".round(($TM/$TF0),2))),0,0,'L',0);
	$this->SetXY(5,175+30);$this->cell(285,5,html_entity_decode(utf8_decode("2-Répartition des décès par tranche d'âge : ")),0,0,'L',0);
	rsort($datamf);
	$this->SetXY(5,175+35);$this->cell(285,5,html_entity_decode(utf8_decode("la proportion des décès la plus élevée est : ".round($datamf[0]*100/$T,2)."%")),0,0,'L',0);
	sort($datamf);
	$this->SetXY(5,175+40);$this->cell(285,5,html_entity_decode(utf8_decode("la proportion des décès la moins élevée est : ".round($datamf[0]*100/$T,2)."%")),0,0,'L',0);
	$pie2 = array(
	"x" => 135, 
	"y" => 200, 
	"r" => 17,
	"v1" => $TM,
	"v2" => $TF,
	"t0" => html_entity_decode(utf8_decode("Distribution des décès par sexe ")),
	"t1" => "M",
	"t2" => "F");
    $this->pie2($pie2);
	
	$TA1=$data['1M']+$data['1F'];
	$TA2=$data['2M']+$data['2F'];
	$TA3=$data['3M']+$data['3F'];
	$TA4=$data['4M']+$data['4F'];
	$TA5=$data['5M']+$data['5F'];
	$TA6=$data['6M']+$data['6F'];
	$TA7=$data['7M']+$data['7F'];
	$TA8=$data['8M']+$data['8F'];
	$TA9=$data['9M']+$data['9F'];
	$TA10=$data['10M']+$data['10F'];
	$TA11=$data['11M']+$data['11F'];
	$TA12=$data['12M']+$data['12F'];
	$TA13=$data['13M']+$data['13F'];
	$TA14=$data['14M']+$data['14F'];
	$TA15=$data['15M']+$data['15F'];
	$TA16=$data['16M']+$data['16F'];
	$TA17=$data['17M']+$data['17F'];
	$TA18=$data['18M']+$data['18F'];
	$TA19=$data['19M']+$data['19F'];
	$TA20=$data['20M']+$data['20F'];
	$this->bar20(135,150,$TA1,$TA2,$TA3,$TA4,$TA5,$TA6,$TA7,$TA8,$TA9,$TA10,$TA11,$TA12,$TA13,$TA14,$TA15,$TA16,$TA17,$TA18,$TA19,$TA20,utf8_decode('Distribution des décès par tranche d\'age en année'));
	}
	function AGESEXE($colone1,$colone2,$colone3,$datejour1,$datejour2,$SEXEDNR,$STRUCTURED)
	{
	$this->mysqlconnect();
	$sql = " select * from deceshosp where  ($colone1 >=$colone2  and $colone1 <=$colone3)  and (DINS BETWEEN '$datejour1' AND '$datejour2') and (SEX='$SEXEDNR' and STRUCTURED $STRUCTURED )          ";
	$requete = @mysql_query($sql) or die($sql."<br>".mysql_error());
	$collecte=mysql_num_rows($requete);
	mysql_free_result($requete);
	return $collecte;
	}
	function bar20($x,$y,$a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$k,$l,$m,$n,$o,$p,$q,$r,$s,$t,$titre)
    {
	if ($a+$b+$c+$d+$e+$f+$g+$h+$i+$j+$k+$l+$m+$n+$o+$p+$q+$r+$s+$t > 0){$total=$a+$b+$c+$d+$e+$f+$g+$h+$i+$j+$k+$l+$m+$n+$o+$p+$q+$r+$s+$t;}else {$total=1;}
	$ap=round($a*100/$total,2);
	$bp=round($b*100/$total,2);
	$cp=round($c*100/$total,2);
	$dp=round($d*100/$total,2);
	$ep=round($e*100/$total,2);
	$fp=round($f*100/$total,2);
	$gp=round($g*100/$total,2);
	$hp=round($h*100/$total,2);
	$ip=round($i*100/$total,2);
	$jp=round($j*100/$total,2);
	$kp=round($k*100/$total,2);
	$lp=round($l*100/$total,2);
	$mp=round($m*100/$total,2);
	$np=round($n*100/$total,2);
	$op=round($o*100/$total,2);
	$pp=round($p*100/$total,2);
	$qp=round($q*100/$total,2);
	$rp=round($r*100/$total,2);
	$sp=round($s*100/$total,2);
	$tp=round($t*100/$total,2);
	$this->SetFont('Times', 'BIU', 11);
	$this->SetXY($x-20,$y-108);$this->Cell(0, 5,$titre ,0, 2, 'L');
	$this->RoundedRect($x-20,$y-108, 90, 130, 2, $style = '');
	$this->SetFont('Times', 'B',08);$this->SetFillColor(120,255,120);
	$w=4.5;
	$h=1;
	$this->SetFont('Times', 'B', 9);
	$this->SetXY(111,160-2.5);$this->cell(5,5,'00-',0,0,'C',0);
	$this->SetXY(111,150-2.5);$this->cell(5,5,'10-',0,0,'C',0);
	$this->SetXY(111,140-2.5);$this->cell(5,5,'20-',0,0,'C',0);
	$this->SetXY(111,130-2.5);$this->cell(5,5,'30-',0,0,'C',0);
	$this->SetXY(111,120-2.5);$this->cell(5,5,'40-',0,0,'C',0);
	$this->SetXY(111,110-2.5);$this->cell(5,5,'50-',0,0,'C',0);
	$this->SetXY(111,100-2.5);$this->cell(5,5,'60-',0,0,'C',0);
	$this->SetXY(111,90-2.5);$this->cell(5,5,'70-',0,0,'C',0);
	$this->SetXY(111,80-2.5);$this->cell(5,5,'80-',0,0,'C',0);
	$this->SetXY(111,70-2.5);$this->cell(5,5,'90-',0,0,'C',0);
	$this->SetXY(111,60-2.5);$this->cell(5,5,'100-',0,0,'C',0);
	$this->SetXY($x-20,$y+10);
	$this->cell($w,-$ap*$h,'',1,0,'C',1,0);     
	$this->cell($w,-$bp*$h,'',1,0,'C',1,0);
	$this->cell($w,-$cp*$h,'',1,0,'C',1,0);
	$this->cell($w,-$dp*$h,'',1,0,'C',1,0);
	$this->cell($w,-$ep*$h,'',1,0,'C',1,0);
	$this->cell($w,-$fp*$h,'',1,0,'C',1,0);
	$this->cell($w,-$gp*$h,'',1,0,'C',1,0);
	$this->cell($w,-$hp*$h,'',1,0,'C',1,0);
	$this->cell($w,-$ip*$h,'',1,0,'C',1,0);
	$this->cell($w,-$jp*$h,'',1,0,'C',1,0);
	$this->cell($w,-$kp*$h,'',1,0,'C',1,0);        
	$this->cell($w,-$lp*$h,'',1,0,'C',1,0);
	$this->cell($w,-$mp*$h,'',1,0,'C',1,0);
	$this->cell($w,-$np*$h,'',1,0,'C',1,0);
	$this->cell($w,-$op*$h,'',1,0,'C',1,0);
	$this->cell($w,-$pp*$h,'',1,0,'C',1,0);
	$this->cell($w,-$qp*$h,'',1,0,'C',1,0);
	$this->cell($w,-$rp*$h,'',1,0,'C',1,0);
	$this->cell($w,-$sp*$h,'',1,0,'C',1,0);
	$this->cell($w,-$tp*$h,'',1,0,'C',1,0);
	$this->SetTextColor(255,0,0);
	$this->RotatedText($x-17.5,$y+10-$ap,'-'.$ap.'%',80);
	$this->RotatedText($x-17.5+5,$y+10-$bp,'-'.$bp.'%',80);
	$this->RotatedText($x-17.5+9,$y+10-$cp,'-'.$cp.'%',80);
	$this->RotatedText($x-17.5+14,$y+10-$dp,'-'.$dp.'%',80);
	$this->RotatedText($x-17.5+18.5,$y+10-$ep,'-'.$ep.'%',80);
	$this->RotatedText($x-17.5+23,$y+10-$fp,'-'.$fp.'%',80);
	$this->RotatedText($x-17.5+27,$y+10-$gp,'-'.$gp.'%',80);
	$this->RotatedText($x-17.5+32,$y+10-$hp,'-'.$hp.'%',80);
	$this->RotatedText($x-17.5+36.5,$y+10-$ip,'-'.$ip.'%',80);
	$this->RotatedText($x-17.5+41,$y+10-$jp,'-'.$jp.'%',80);
	$this->RotatedText($x-17.5+45.5,$y+10-$kp,'-'.$kp.'%',80);
	$this->RotatedText($x-17.5+49.5,$y+10-$lp,'-'.$lp.'%',80);
	$this->RotatedText($x-17.5+54,$y+10-$mp,'-'.$mp.'%',80);
	$this->RotatedText($x-17.5+59,$y+10-$np,'-'.$np.'%',80);
	$this->RotatedText($x-17.5+63,$y+10-$op,'-'.$op.'%',80);
	$this->RotatedText($x-17.5+68,$y+10-$pp,'-'.$pp.'%',80);
	$this->RotatedText($x-17.5+72.5,$y+10-$qp,'-'.$qp.'%',80);
	$this->RotatedText($x-17.5+77,$y+10-$rp,'-'.$rp.'%',80);
	$this->RotatedText($x-17.5+81.5,$y+10-$sp,'-'.$sp.'%',80);
	$this->RotatedText($x-17.5+85.5,$y+10-$tp,'-'.$tp.'%',80);
	$this->SetTextColor(0,0,0);
	$this->SetXY($x-20,$y+12);    
	$this->SetFont('Times', 'B', 9);
	$this->cell($w,5,'05',1,0,'C',0,0);
	$this->cell($w,5,'10',1,0,'C',0,0);
	$this->cell($w,5,'15',1,0,'C',0,0);
	$this->cell($w,5,'20',1,0,'C',0,0);
	$this->cell($w,5,'25',1,0,'C',0,0);
	$this->cell($w,5,'30',1,0,'C',0,0);
	$this->cell($w,5,'35',1,0,'C',0,0);
	$this->cell($w,5,'40',1,0,'C',0,0);
	$this->cell($w,5,'45',1,0,'C',0,0);
	$this->cell($w,5,'50',1,0,'C',0,0);
	$this->cell($w,5,'55',1,0,'C',0,0);
	$this->cell($w,5,'60',1,0,'C',0,0);
	$this->cell($w,5,'65',1,0,'C',0,0);
	$this->cell($w,5,'70',1,0,'C',0,0);
	$this->cell($w,5,'75',1,0,'C',0,0);
	$this->cell($w,5,'80',1,0,'C',0,0);
	$this->cell($w,5,'85',1,0,'C',0,0);
	$this->cell($w,5,'90',1,0,'C',0,0);
	$this->cell($w,5,'95',1,0,'C',0,0);
	$this->cell($w,5,'99',1,0,'C',0,0);
	$this->SetFillColor(230);//fond gris il faut ajouter au cell un autre parametre pour qui accepte la coloration
	$this->SetTextColor(0,0,0);//text noire
	$this->SetFont('Times', 'B', 11);
	}
	function dataagesexe($x,$y,$colone1,$TABLE,$DINS,$COMMUNER,$datejour1,$datejour2,$STRUCTURED) 
	{
	$T2F20=array(
	"xt" => $x,
	"yt" => $y,
	"wc" => "",
	"hc" => "",
	"tt" => "Repartition des deces par tranche d'age et sexe (global)",
	"tc" => "Sexe",
	"tc1" =>"M",
	"tc3" =>"F",
	"tc5" =>"Total",
	"1M"  => $this->AGESEXE($colone1,0,4,$datejour1,$datejour2,'M',$STRUCTURED),    "1F"  => $this->AGESEXE($colone1,0,4,$datejour1,$datejour2,'F',$STRUCTURED),
	"2M"  => $this->AGESEXE($colone1,5,9,$datejour1,$datejour2,'M',$STRUCTURED),    "2F"  => $this->AGESEXE($colone1,5,9,$datejour1,$datejour2,'F',$STRUCTURED),
	"3M"  => $this->AGESEXE($colone1,10,14,$datejour1,$datejour2,'M',$STRUCTURED),  "3F"  => $this->AGESEXE($colone1,10,14,$datejour1,$datejour2,'F',$STRUCTURED),
	"4M"  => $this->AGESEXE($colone1,15,19,$datejour1,$datejour2,'M',$STRUCTURED),  "4F"  => $this->AGESEXE($colone1,15,19,$datejour1,$datejour2,'F',$STRUCTURED),
	"5M"  => $this->AGESEXE($colone1,20,24,$datejour1,$datejour2,'M',$STRUCTURED),  "5F"  => $this->AGESEXE($colone1,20,24,$datejour1,$datejour2,'F',$STRUCTURED),
	"6M"  => $this->AGESEXE($colone1,25,29,$datejour1,$datejour2,'M',$STRUCTURED),  "6F"  => $this->AGESEXE($colone1,25,29,$datejour1,$datejour2,'F',$STRUCTURED),
	"7M"  => $this->AGESEXE($colone1,30,34,$datejour1,$datejour2,'M',$STRUCTURED),  "7F"  => $this->AGESEXE($colone1,30,34,$datejour1,$datejour2,'F',$STRUCTURED),
	"8M"  => $this->AGESEXE($colone1,35,39,$datejour1,$datejour2,'M',$STRUCTURED),  "8F"  => $this->AGESEXE($colone1,35,39,$datejour1,$datejour2,'F',$STRUCTURED),
	"9M"  => $this->AGESEXE($colone1,40,44,$datejour1,$datejour2,'M',$STRUCTURED),  "9F"  => $this->AGESEXE($colone1,40,44,$datejour1,$datejour2,'F',$STRUCTURED),
	"10M" => $this->AGESEXE($colone1,45,49,$datejour1,$datejour2,'M',$STRUCTURED),  "10F" => $this->AGESEXE($colone1,45,49,$datejour1,$datejour2,'F',$STRUCTURED),
	"11M" => $this->AGESEXE($colone1,50,54,$datejour1,$datejour2,'M',$STRUCTURED),  "11F" => $this->AGESEXE($colone1,50,54,$datejour1,$datejour2,'F',$STRUCTURED),
	"12M" => $this->AGESEXE($colone1,55,59,$datejour1,$datejour2,'M',$STRUCTURED),  "12F" => $this->AGESEXE($colone1,55,59,$datejour1,$datejour2,'F',$STRUCTURED),
	"13M" => $this->AGESEXE($colone1,60,64,$datejour1,$datejour2,'M',$STRUCTURED),  "13F" => $this->AGESEXE($colone1,60,64,$datejour1,$datejour2,'F',$STRUCTURED),
	"14M" => $this->AGESEXE($colone1,65,69,$datejour1,$datejour2,'M',$STRUCTURED),  "14F" => $this->AGESEXE($colone1,65,69,$datejour1,$datejour2,'F',$STRUCTURED),
	"15M" => $this->AGESEXE($colone1,70,74,$datejour1,$datejour2,'M',$STRUCTURED),  "15F" => $this->AGESEXE($colone1,70,74,$datejour1,$datejour2,'F',$STRUCTURED),
	"16M" => $this->AGESEXE($colone1,75,79,$datejour1,$datejour2,'M',$STRUCTURED),  "16F" => $this->AGESEXE($colone1,75,79,$datejour1,$datejour2,'F',$STRUCTURED),
	"17M" => $this->AGESEXE($colone1,80,84,$datejour1,$datejour2,'M',$STRUCTURED),  "17F" => $this->AGESEXE($colone1,80,84,$datejour1,$datejour2,'F',$STRUCTURED),
	"18M" => $this->AGESEXE($colone1,85,89,$datejour1,$datejour2,'M',$STRUCTURED),  "18F" => $this->AGESEXE($colone1,85,89,$datejour1,$datejour2,'F',$STRUCTURED),
	"19M" => $this->AGESEXE($colone1,90,94,$datejour1,$datejour2,'M',$STRUCTURED),  "19F" => $this->AGESEXE($colone1,90,94,$datejour1,$datejour2,'F',$STRUCTURED),
	"20M" => $this->AGESEXE($colone1,95,150,$datejour1,$datejour2,'M',$STRUCTURED), "20F" => $this->AGESEXE($colone1,95,150,$datejour1,$datejour2,'F',$STRUCTURED),			
	"T" =>'1',
	"tl" =>"Age",
	"1MF"  => '00-04',  
	"2MF"  => '05-09',   
	"3MF"  => '10-14',  
	"4MF"  => '15-19',   
	"5MF"  => '20-24',  
	"6MF"  => '25-29',   
	"7MF"  => '30-34',  
	"8MF"  => '35-39',   
	"9MF"  => '40-44',   
	"10MF" => '45-49',  
	"11MF" => '50-54',  
	"12MF" => '55-59', 
	"13MF" => '60-64',  
	"14MF" => '65-69', 
	"15MF" => '70-74',  
	"16MF" => '75-79',  
	"17MF" => '80-84',  
	"18MF" => '85-89', 
	"19MF" => '90-94', 
	"20MF" => '95-99'  
	);
	return $T2F20;
	}
	function dataagesexeped($x,$y,$colone1,$TABLE,$DINS,$COMMUNER,$datejour1,$datejour2,$STRUCTURED) 
	{
	$T2F20=array(
	"xt" => $x,
	"yt" => $y,
	"wc" => "",
	"hc" => "",
	"tt" => "Repartition des deces par tranche d'age et sexe (pediatrique)",
	"tc" => "Sexe",
	"tc1" =>"M",
	"tc3" =>"F",
	"tc5" =>"Total",
	"1M"  => $this->AGESEXE($colone1,0,7,$datejour1,$datejour2,'M',$STRUCTURED),           "1F"  => $this->AGESEXE($colone1,0,7,$datejour1,$datejour2,'F',$STRUCTURED),
	"2M"  => $this->AGESEXE($colone1,8,28,$datejour1,$datejour2,'M',$STRUCTURED),          "2F"  => $this->AGESEXE($colone1,8,28,$datejour1,$datejour2,'F',$STRUCTURED),
	"3M"  => $this->AGESEXE($colone1,29,365,$datejour1,$datejour2,'M',$STRUCTURED),        "3F"  => $this->AGESEXE($colone1,29,365,$datejour1,$datejour2,'F',$STRUCTURED),
	"4M"  => $this->AGESEXE($colone1,366,365*4,$datejour1,$datejour2,'M',$STRUCTURED),     "4F"  => $this->AGESEXE($colone1,366,365*4,$datejour1,$datejour2,'F',$STRUCTURED),
	"5M"  => $this->AGESEXE($colone1,365*4,365*15,$datejour1,$datejour2,'M',$STRUCTURED),  "5F"  => $this->AGESEXE($colone1,365*4,365*15,$datejour1,$datejour2,'F',$STRUCTURED),			
	"T" =>'1',
	"tl" =>"Age",
	"1MF"  => '00j-07j',  
	"2MF"  => '08j-28j',   
	"3MF"  => '01m-01a',  
	"4MF"  => '01a-04a',   
	"5MF"  => '05a-15a'  
	);
	return $T2F20;
	}
	function bar5($x,$y,$a,$b,$c,$d,$e,$titre)
    {
	if($a+$b+$c+$d+$e>0){$total=$a+$b+$c+$d+$e;}else{$total=1;}
	$ap=round($a*100/$total,2);
	$bp=round($b*100/$total,2);
	$cp=round($c*100/$total,2);
	$dp=round($d*100/$total,2);
	$ep=round($e*100/$total,2);
	$this->SetFont('Times', 'BIU', 11);
	$this->SetXY($x-20,$y-108);$this->Cell(0, 5,$titre ,0, 2, 'L');
	$this->RoundedRect($x-20,$y-108, 90, 130, 2, $style = '');
	$this->SetFont('Times', 'B',08);$this->SetFillColor(120,255,120);
	// $this->SetXY($x-5,$y);$this->cell(0.5,-100,'',1,0,'L',1,0);
	// $this->SetXY($x-19,$y-100);$this->cell(13,5,'100 % ',1,0,'L',1,0);
	// $this->SetXY($x-19,$y-50);$this->cell(13,5,'50 % ',1,0,'L',1,0);
	// $this->SetXY($x-19,$y-05);$this->cell(13,5,'00 % ',1,0,'L',1,0);
	$w=18;
	$this->SetXY($x-20,$y+10);   
	$this->cell($w,-$ap,$ap,1,0,'C',1,0);        
	$this->cell($w,-$bp,$bp,1,0,'C',1,0);
	$this->cell($w,-$cp,$cp,1,0,'C',1,0);
	$this->cell($w,-$dp,$dp,1,0,'C',1,0);
	$this->cell($w,-$ep,$ep,1,0,'C',1,0);
	
	$this->SetXY($x-20,$y+12);    
	$this->cell($w,5,'00-07',1,0,'C',0,0);
	$this->cell($w,5,'08-28',1,0,'C',0,0);
	$this->cell($w,5,'01-01',1,0,'C',0,0);
	$this->cell($w,5,'01-04',1,0,'C',0,0);
	$this->cell($w,5,'05-15',1,0,'C',0,0);
	
	$this->SetFillColor(230);//fond gris il faut ajouter au cell un autre parametre pour qui accepte la coloration
	$this->SetTextColor(0,0,0);//text noire
	$this->SetFont('Times', 'B', 11);
	}
	function T2F20PED($data,$datejour1,$datejour2)
    {
	//tc2
	$this->SetXY($data['xt'],$data['yt']);     $this->cell(90+15,05,$data['tt'],1,0,'L',1,0);
	$this->SetXY($data['xt'],$this->GetY()+5); $this->cell(15,15,$data['tl'],1,0,'C',1,0);
	$this->SetXY($data['xt']+15,$this->GetY());$this->cell(75+15,10,$data['tc'],1,0,'C',1,0);$this->SetXY($data['xt']+15,$this->GetY()+10);$this->cell(30,5,$data['tc1'],1,0,'C',1,0); $this->SetXY($data['xt']+45,$this->GetY());$this->cell(30,5,$data['tc3'],1,0,'C',1,0);$this->SetXY($data['xt']+75,$this->GetY());$this->cell(15,5,$data['tc5'],1,0,'C',1,0);$this->SetXY($data['xt']+75+15,$this->GetY());$this->cell(15,5,'P %',1,0,'C',1,0);
	$TM=$data['1M']+$data['2M']+$data['3M']+$data['4M']+$data['5M'];
	$TF=$data['1F']+$data['2F']+$data['3F']+$data['4F']+$data['5F'];
	if ($TM+$TF>0){$T=$TM+$TF;}else {$T=1;}
	
	
	
	$datamf = array($data['1M']+$data['1F'],
	                $data['2M']+$data['2F'],
					$data['3M']+$data['3F'],
					$data['4M']+$data['4F'],
					$data['5M']+$data['5F']);
	
	
	$this->SetXY($data['xt'],$this->GetY()+5); $this->cell(15,5,$data['1MF'],1,0,'C',1,0);
	$this->SetXY($data['xt']+15,$this->GetY());$this->cell(30,5,$data['1M'],1,0,'C',0,0);
	$this->SetXY($data['xt']+45,$this->GetY());$this->cell(30,5,$data['1F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75,$this->GetY());$this->cell(15,5,$data['1M']+$data['1F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75+15,$this->GetY());$this->cell(15,5,round(((($data['1M']+$data['1F'])/$T)*100),2).' %',1,0,'R',1,0);        
	
	$this->SetXY($data['xt'],$this->GetY()+5);$this->cell(15,5,$data['2MF'],1,0,'C',1,0);
	$this->SetXY($data['xt']+15,$this->GetY());$this->cell(30,5,$data['2M'],1,0,'C',0,0);
	$this->SetXY($data['xt']+45,$this->GetY());$this->cell(30,5,$data['2F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75,$this->GetY());$this->cell(15,5,$data['2M']+$data['2F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75+15,$this->GetY());$this->cell(15,5,round(((($data['2M']+$data['2F'])/$T)*100),2).' %',1,0,'R',1,0);        
	
	
	$this->SetXY($data['xt'],$this->GetY()+5);$this->cell(15,5,$data['3MF'],1,0,'C',1,0);
	$this->SetXY($data['xt']+15,$this->GetY());$this->cell(30,5,$data['3M'],1,0,'C',0,0);
	$this->SetXY($data['xt']+45,$this->GetY());$this->cell(30,5,$data['3F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75,$this->GetY());$this->cell(15,5,$data['3M']+$data['3F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75+15,$this->GetY());$this->cell(15,5,round(((($data['3M']+$data['3F'])/$T)*100),2).' %',1,0,'R',1,0);        
	
	$this->SetXY($data['xt'],$this->GetY()+5);$this->cell(15,5,$data['4MF'],1,0,'C',1,0);
	$this->SetXY($data['xt']+15,$this->GetY());$this->cell(30,5,$data['4M'],1,0,'C',0,0);
	$this->SetXY($data['xt']+45,$this->GetY());$this->cell(30,5,$data['4F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75,$this->GetY());$this->cell(15,5,$data['4M']+$data['4F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75+15,$this->GetY());$this->cell(15,5,round(((($data['4M']+$data['4F'])/$T)*100),2).' %',1,0,'R',1,0);        
	
	$this->SetXY($data['xt'],$this->GetY()+5);$this->cell(15,5,$data['5MF'],1,0,'C',1,0);
	$this->SetXY($data['xt']+15,$this->GetY());$this->cell(30,5,$data['5M'],1,0,'C',0,0);
	$this->SetXY($data['xt']+45,$this->GetY());$this->cell(30,5,$data['5F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75,$this->GetY());$this->cell(15,5,$data['5M']+$data['5F'],1,0,'C',0,0);
	$this->SetXY($data['xt']+75+15,$this->GetY());$this->cell(15,5,round(((($data['5M']+$data['5F'])/$T)*100),2).' %',1,0,'R',1,0);        
	
	$this->SetXY($data['xt'],$this->GetY()+5);$this->cell(15,5,'Total',1,0,'C',1,0);
	$this->SetXY($data['xt']+15,$this->GetY());$this->cell(30,5,$TM,1,0,'C',1,0);
	$this->SetXY($data['xt']+45,$this->GetY());$this->cell(30,5,$TF,1,0,'C',1,0);
	$this->SetXY($data['xt']+75,$this->GetY());$this->cell(15,5,$T,1,0,'C',1,0);
	$this->SetXY($data['xt']+75+15,$this->GetY());$this->cell(15,5,round(((($TM+$TF)/$T)*100),2).' %',1,0,'R',1,0); 	                                                                
	
	
	$this->SetXY($data['xt'],$this->GetY()+5); $this->cell(15,5,'P %',1,0,'C',1,0);      
	$this->SetXY($data['xt']+15,$this->GetY());      $this->cell(30,5,round(($TM/$T)*100,2),1,0,'C',1,0);
	$this->SetXY($data['xt']+45,$this->GetY());      $this->cell(30,5,round(($TF/$T)*100,2),1,0,'C',1,0);
	$this->SetXY($data['xt']+75,$this->GetY());      $this->cell(15,5,round(($T/$T)*100,2).' %',1,0,'C',1,0);
	$this->SetXY($data['xt']+75+15,$this->GetY());   $this->cell(15,5,'***',1,0,'C',1,0); 	                                                                
	$this->SetXY(5,25+10);$this->cell(285,5,html_entity_decode(utf8_decode("Cette étude a porté sur ".$T." décès survenus durant la periode du ".$this->dateUS2FR($datejour1)." au ".$this->dateUS2FR($datejour2)." au niveau de 36 communes ")),0,0,'L',0);
	$this->SetXY(5,175);$this->cell(285,5,html_entity_decode(utf8_decode("1-Répartition des décès par sexe : ")),0,0,'L',0);
	$this->SetXY(5,175+5);$this->cell(285,5,html_entity_decode(utf8_decode("La répartition des ".$T." décès enregistrés montre que :")),0,0,'L',0);
	$this->SetXY(5,175+10);$this->cell(285,5,html_entity_decode(utf8_decode(round(($TM/$T)*100,2)."% des décès touche les garcons. ")),0,0,'L',0);
	$this->SetXY(5,175+15);$this->cell(285,5,html_entity_decode(utf8_decode(round(($TF/$T)*100,2)."% des décès touche les filles. ")),0,0,'L',0);
	if($TF>0){$TF0=$TF; }else{$TF0=1;}
	$this->SetXY(5,175+20);$this->cell(285,5,html_entity_decode(utf8_decode("avec un sexe ratio de ".round(($TM/$TF0),2))),0,0,'L',0);
	$this->SetXY(5,175+30);$this->cell(285,5,html_entity_decode(utf8_decode("2-Répartition des décès par tranche d'âge : ")),0,0,'L',0);
	rsort($datamf);
	$this->SetXY(5,175+35,$this->GetY()+5);$this->cell(285,5,html_entity_decode(utf8_decode("la proportion des décès la plus élevée est : ".round($datamf[0]*100/$T,2)."%")),0,0,'L',0);
    sort($datamf);
    $this->SetXY(5,175+40,$this->GetY()+5);$this->cell(285,5,html_entity_decode(utf8_decode("la proportion des décès la moins élevée est : ".round($datamf[0]*100/$T,2)."%")),0,0,'L',0);
	$pie2 = array(
	"x" => 135, 
	"y" => 200, 
	"r" => 17,
	"v1" => $TM,
	"v2" => $TF,
	"t0" => html_entity_decode(utf8_decode("Distribution des décès par sexe ")),
	"t1" => "M",
	"t2" => "F");
    $this->pie2($pie2);
    $TA1=$data['1M']+$data['1F'];
	$TA2=$data['2M']+$data['2F'];
	$TA3=$data['3M']+$data['3F'];
	$TA4=$data['4M']+$data['4F'];
	$TA5=$data['5M']+$data['5F'];
	$this->bar5(135,150,$TA1,$TA2,$TA3,$TA4,$TA5,utf8_decode('Distribution des décès par tranche d\'age ')); 
	}
	function dataagesexepedj($x,$y,$colone1,$TABLE,$DINS,$COMMUNER,$datejour1,$datejour2,$STRUCTURED) 
	{
	$T2F20=array(
	"xt" => $x,
	"yt" => $y,
	"wc" => "",
	"hc" => "",
	"tt" => "Repartition des deces par tranche d'age et sexe (pediatrique)",
	"tc" => "Sexe",
	"tc1" =>"M",
	"tc3" =>"F",
	"tc5" =>"Total",
	"1M"  => $this->AGESEXE($colone1,0,1,$datejour1,$datejour2,'M',$STRUCTURED),  "1F"  => $this->AGESEXE($colone1,0,1,$datejour1,$datejour2,'F',$STRUCTURED),
	"2M"  => $this->AGESEXE($colone1,2,2,$datejour1,$datejour2,'M',$STRUCTURED),  "2F"  => $this->AGESEXE($colone1,2,2,$datejour1,$datejour2,'F',$STRUCTURED),
	"3M"  => $this->AGESEXE($colone1,3,3,$datejour1,$datejour2,'M',$STRUCTURED),  "3F"  => $this->AGESEXE($colone1,3,3,$datejour1,$datejour2,'F',$STRUCTURED),
	"4M"  => $this->AGESEXE($colone1,4,4,$datejour1,$datejour2,'M',$STRUCTURED),  "4F"  => $this->AGESEXE($colone1,4,4,$datejour1,$datejour2,'F',$STRUCTURED),
	"5M"  => $this->AGESEXE($colone1,5,5,$datejour1,$datejour2,'M',$STRUCTURED),  "5F"  => $this->AGESEXE($colone1,5,5,$datejour1,$datejour2,'F',$STRUCTURED),			
	"6M"  => $this->AGESEXE($colone1,6,6,$datejour1,$datejour2,'M',$STRUCTURED),  "6F"  => $this->AGESEXE($colone1,6,6,$datejour1,$datejour2,'F',$STRUCTURED),			
	"7M"  => $this->AGESEXE($colone1,7,7,$datejour1,$datejour2,'M',$STRUCTURED),  "7F"  => $this->AGESEXE($colone1,7,7,$datejour1,$datejour2,'F',$STRUCTURED),			
	"T" =>'1',
	"tl" =>"Age",
	"1MF"  => '01j',  
	"2MF"  => '02j',   
	"3MF"  => '03j',  
	"4MF"  => '04j',   
	"5MF"  => '05j',
	"6MF"  => '06j',
	"7MF"  => '07j'	
	);
	return $T2F20;
	}
	function bar7($x,$y,$a,$b,$c,$d,$e,$f,$g,$titre)
    {
	if($a+$b+$c+$d+$e+$f+$g>0){$total=$a+$b+$c+$d+$e+$f+$g;}else{$total=1;}
	$ap=round($a*100/$total,2);
	$bp=round($b*100/$total,2);
	$cp=round($c*100/$total,2);
	$dp=round($d*100/$total,2);
	$ep=round($e*100/$total,2);
	$fp=round($f*100/$total,2);
	$gp=round($g*100/$total,2);
	$this->SetFont('Times', 'BIU', 11);
	$this->SetXY($x-20,$y-108);$this->Cell(0, 5,$titre ,0, 2, 'L');
	$this->RoundedRect($x-20,$y-108, 90, 130, 2, $style = '');
	$this->SetFont('Times', 'B',08);$this->SetFillColor(120,255,120);
	// $this->SetXY($x-5,$y);$this->cell(0.5,-100,'',1,0,'L',1,0);
	// $this->SetXY($x-19,$y-100);$this->cell(13,5,'100 % ',1,0,'L',1,0);
	// $this->SetXY($x-19,$y-50);$this->cell(13,5,'50 % ',1,0,'L',1,0);
	// $this->SetXY($x-19,$y-05);$this->cell(13,5,'00 % ',1,0,'L',1,0);
	$w=12.80;
	$this->SetXY($x-20,$y+10);   
	$this->cell($w,-$ap,$ap,1,0,'C',1,0);        
	$this->cell($w,-$bp,$bp,1,0,'C',1,0);
	$this->cell($w,-$cp,$cp,1,0,'C',1,0);
	$this->cell($w,-$dp,$dp,1,0,'C',1,0);
	$this->cell($w,-$ep,$ep,1,0,'C',1,0);
	$this->cell($w,-$fp,$fp,1,0,'C',1,0);
	$this->cell($w,-$gp,$gp,1,0,'C',1,0);
	$this->SetXY($x-20,$y+12);    
	$this->cell($w,5,'01',1,0,'C',0,0);
	$this->cell($w,5,'02',1,0,'C',0,0);
	$this->cell($w,5,'03',1,0,'C',0,0);
	$this->cell($w,5,'04',1,0,'C',0,0);
	$this->cell($w,5,'05',1,0,'C',0,0);
	$this->cell($w,5,'06',1,0,'C',0,0);
	$this->cell($w,5,'07',1,0,'C',0,0);
	$this->SetFillColor(230);//fond gris il faut ajouter au cell un autre parametre pour qui accepte la coloration
	$this->SetTextColor(0,0,0);//text noire
	$this->SetFont('Times', 'B', 11);
	}
	
	function AGESEXEMM($colone1,$colone2,$colone3,$datejour1,$datejour2,$SEXEDNR,$STRUCTURED)
	{
	$this->mysqlconnect();
	$sql = " select * from deceshosp where  ($colone1 >=$colone2  and $colone1 <=$colone3)  and (DINS BETWEEN '$datejour1' AND '$datejour2') and (SEX='$SEXEDNR' and STRUCTURED $STRUCTURED )  and DECEMAT=1  ";
	$requete = @mysql_query($sql) or die($sql."<br>".mysql_error());
	$collecte=mysql_num_rows($requete);
	mysql_free_result($requete);
	return $collecte;
	}

	function dataMM($x,$y,$colone1,$TABLE,$DINS,$COMMUNER,$datejour1,$datejour2,$STRUCTURED) 
	{
	$T2F20=array(
	"xt" => $x,
	"yt" => $y,
	"wc" => "",
	"hc" => "",
	"tt" => "Repartition des deces Maternels",
	"tc" => "Effectif",
	"tc1" =>"Total",
	"tc3" =>"F",
	"tc5" =>"Total",
	"1MM"  => $this->AGESEXEMM($colone1,15,19,$datejour1,$datejour2,'F',$STRUCTURED), 
	"2MM"  => $this->AGESEXEMM($colone1,20,24,$datejour1,$datejour2,'F',$STRUCTURED), 
	"3MM"  => $this->AGESEXEMM($colone1,25,29,$datejour1,$datejour2,'F',$STRUCTURED), 
	"4MM"  => $this->AGESEXEMM($colone1,30,34,$datejour1,$datejour2,'F',$STRUCTURED),  
	"5MM"  => $this->AGESEXEMM($colone1,35,39,$datejour1,$datejour2,'F',$STRUCTURED), 			
	"6MM"  => $this->AGESEXEMM($colone1,40,44,$datejour1,$datejour2,'F',$STRUCTURED), 					
	"7MM"  => $this->AGESEXEMM($colone1,45,49,$datejour1,$datejour2,'F',$STRUCTURED), 
	"T" =>'1',
	"tl" =>"Age",
	"1MF"  => '15-19',  
	"2MF"  => '20-24',   
	"3MF"  => '25-29',  
	"4MF"  => '30-34',   
	"5MF"  => '35-39',
	"6MF"  => '40-44',
	"7MF"  => '45-49'	
	);
	return $T2F20;
	}

	function T2F20MM($data,$datejour1,$datejour2)
    {
	$this->SetXY($data['xt'],$data['yt']);      $this->cell(90+15,05,$data['tt'],1,0,'L',1,0);
	$this->SetXY($data['xt'],$this->GetY()+5);  $this->cell(15,15,$data['tl'],1,0,'C',1,0);
	$this->SetXY($data['xt']+15,$this->GetY()); $this->cell(75+15,10,$data['tc'],1,0,'C',1,0);
	$this->SetXY($data['xt']+15,$this->GetY()+10);$this->cell(75,5,$data['tc1'],1,0,'C',1,0); 
	$this->SetXY($data['xt']+75+15,$this->GetY());$this->cell(15,5,'P %',1,0,'C',1,0);
	$TM=$data['1MM']+$data['2MM']+$data['3MM']+$data['4MM']+$data['5MM']+$data['6MM']+$data['7MM'];
	if($TM>0){$T=$TM;}else{$T=1;}
	$datamf = array($data['1MM'],$data['2MM'],$data['3MM'],$data['4MM'],$data['5MM'],$data['6MM'],$data['7MM']);
	$this->SetXY($data['xt'],$this->GetY()+5); $this->cell(15,5,$data['1MF'],1,0,'C',1,0);$this->SetXY($data['xt']+15,$this->GetY());    $this->cell(75,5,$data['1MM'],1,0,'C',0,0);$this->SetXY($data['xt']+75+15,$this->GetY());$this->cell(15,5,round(((($data['1MM'])/$T)*100),2).' %',1,0,'R',1,0);        
	$this->SetXY($data['xt'],$this->GetY()+5); $this->cell(15,5,$data['2MF'],1,0,'C',1,0);$this->SetXY($data['xt']+15,$this->GetY());    $this->cell(75,5,$data['2MM'],1,0,'C',0,0);$this->SetXY($data['xt']+75+15,$this->GetY());$this->cell(15,5,round(((($data['2MM'])/$T)*100),2).' %',1,0,'R',1,0);        
	$this->SetXY($data['xt'],$this->GetY()+5); $this->cell(15,5,$data['3MF'],1,0,'C',1,0);$this->SetXY($data['xt']+15,$this->GetY());    $this->cell(75,5,$data['3MM'],1,0,'C',0,0);$this->SetXY($data['xt']+75+15,$this->GetY());$this->cell(15,5,round(((($data['3MM'])/$T)*100),2).' %',1,0,'R',1,0);        
	$this->SetXY($data['xt'],$this->GetY()+5); $this->cell(15,5,$data['4MF'],1,0,'C',1,0);$this->SetXY($data['xt']+15,$this->GetY());    $this->cell(75,5,$data['4MM'],1,0,'C',0,0);$this->SetXY($data['xt']+75+15,$this->GetY());$this->cell(15,5,round(((($data['4MM'])/$T)*100),2).' %',1,0,'R',1,0);        
	$this->SetXY($data['xt'],$this->GetY()+5); $this->cell(15,5,$data['5MF'],1,0,'C',1,0);$this->SetXY($data['xt']+15,$this->GetY());    $this->cell(75,5,$data['5MM'],1,0,'C',0,0);$this->SetXY($data['xt']+75+15,$this->GetY());$this->cell(15,5,round(((($data['5MM'])/$T)*100),2).' %',1,0,'R',1,0);        
	$this->SetXY($data['xt'],$this->GetY()+5); $this->cell(15,5,$data['6MF'],1,0,'C',1,0);$this->SetXY($data['xt']+15,$this->GetY());    $this->cell(75,5,$data['6MM'],1,0,'C',0,0);$this->SetXY($data['xt']+75+15,$this->GetY());$this->cell(15,5,round(((($data['6MM'])/$T)*100),2).' %',1,0,'R',1,0);        
	$this->SetXY($data['xt'],$this->GetY()+5); $this->cell(15,5,$data['7MF'],1,0,'C',1,0);$this->SetXY($data['xt']+15,$this->GetY());    $this->cell(75,5,$data['7MM'],1,0,'C',0,0);$this->SetXY($data['xt']+75+15,$this->GetY());$this->cell(15,5,round(((($data['7MM'])/$T)*100),2).' %',1,0,'R',1,0);        
	$this->SetXY($data['xt'],$this->GetY()+5); $this->cell(15,5,'Total',1,0,'C',1,0);$this->SetXY($data['xt']+15,$this->GetY());         $this->cell(75,5,$TM,1,0,'C',1,0);$this->SetXY($data['xt']+75+15,$this->GetY());$this->cell(15,5,round(((($TM)/$T)*100),2).' %',1,0,'R',1,0); 	                                                                
	$this->SetXY($data['xt'],$this->GetY()+5); $this->cell(15,5,'P %',1,0,'C',1,0);      
	$this->SetXY($data['xt']+15,$this->GetY());      $this->cell(75,5,round(($TM/$T)*100,2),1,0,'C',1,0);
	$this->SetXY($data['xt']+75+15,$this->GetY());   $this->cell(15,5,'***',1,0,'C',1,0); 	                                                                
	$this->SetXY(5,25+10);$this->cell(285,5,html_entity_decode(utf8_decode("Cette étude a porté sur ".$T." décès survenus durant la periode du ".$this->dateUS2FR($datejour1)." au ".$this->dateUS2FR($datejour2)." au niveau de 36 communes ")),0,0,'L',0);
	$this->SetXY(5,100+30);$this->cell(285,5,html_entity_decode(utf8_decode("1-Répartition des décès par tranche d'âge : ")),0,0,'L',0);
	rsort($datamf);
	$this->SetXY(5,$this->GetY()+5);$this->cell(285,5,html_entity_decode(utf8_decode("la proportion des décès la plus élevée est : ".round($datamf[0]*100/$T,2)."%")),0,0,'L',0);
    sort($datamf);
    $this->SetXY(5,$this->GetY()+5);$this->cell(285,5,html_entity_decode(utf8_decode("la proportion des décès la moins élevée est : ".round($datamf[0]*100/$T,2)."%")),0,0,'L',0);
	$TA1=$data['1MM'];
	$TA2=$data['2MM'];
	$TA3=$data['3MM'];
	$TA4=$data['4MM'];
	$TA5=$data['5MM'];
	$TA6=$data['6MM'];
	$TA7=$data['7MM'];
	$this->bar7(135,150,$TA1,$TA2,$TA3,$TA4,$TA5,$TA6,$TA7,utf8_decode('Distribution des décès par tranche d\'age en Annee')); 
	}
	
	function T2F20PEDJ($data,$datejour1,$datejour2)
    {
	$this->SetXY($data['xt'],$data['yt']);     $this->cell(90+15,05,$data['tt'],1,0,'L',1,0);
	$this->SetXY($data['xt'],$this->GetY()+5); $this->cell(15,15,$data['tl'],1,0,'C',1,0);
	$this->SetXY($data['xt']+15,$this->GetY());$this->cell(75+15,10,$data['tc'],1,0,'C',1,0);$this->SetXY($data['xt']+15,$this->GetY()+10);$this->cell(30,5,$data['tc1'],1,0,'C',1,0); $this->SetXY($data['xt']+45,$this->GetY());$this->cell(30,5,$data['tc3'],1,0,'C',1,0);$this->SetXY($data['xt']+75,$this->GetY());$this->cell(15,5,$data['tc5'],1,0,'C',1,0);$this->SetXY($data['xt']+75+15,$this->GetY());$this->cell(15,5,'P %',1,0,'C',1,0);
	$TM=$data['1M']+$data['2M']+$data['3M']+$data['4M']+$data['5M']+$data['6M']+$data['7M'];
	$TF=$data['1F']+$data['2F']+$data['3F']+$data['4F']+$data['5F']+$data['6F']+$data['7F'];
	if($TM+$TF>0){$T=$TM+$TF;}else{$T=1;}
	$datamf = array($data['1M']+$data['1F'],$data['2M']+$data['2F'],$data['3M']+$data['3F'],$data['4M']+$data['4F'],$data['5M']+$data['5F'],$data['6M']+$data['6F'],$data['7M']+$data['7F']);
	$this->SetXY($data['xt'],$this->GetY()+5); $this->cell(15,5,$data['1MF'],1,0,'C',1,0);$this->SetXY($data['xt']+15,$this->GetY());      $this->cell(30,5,$data['1M'],1,0,'C',0,0);$this->SetXY($data['xt']+45,$this->GetY());$this->cell(30,5,$data['1F'],1,0,'C',0,0);$this->SetXY($data['xt']+75,$this->GetY());$this->cell(15,5,$data['1M']+$data['1F'],1,0,'C',0,0);$this->SetXY($data['xt']+75+15,$this->GetY());$this->cell(15,5,round(((($data['1M']+$data['1F'])/$T)*100),2).' %',1,0,'R',1,0);        
	$this->SetXY($data['xt'],$this->GetY()+5); $this->cell(15,5,$data['2MF'],1,0,'C',1,0);$this->SetXY($data['xt']+15,$this->GetY());      $this->cell(30,5,$data['2M'],1,0,'C',0,0);$this->SetXY($data['xt']+45,$this->GetY());$this->cell(30,5,$data['2F'],1,0,'C',0,0);$this->SetXY($data['xt']+75,$this->GetY());$this->cell(15,5,$data['2M']+$data['2F'],1,0,'C',0,0);$this->SetXY($data['xt']+75+15,$this->GetY());$this->cell(15,5,round(((($data['2M']+$data['2F'])/$T)*100),2).' %',1,0,'R',1,0);        
	$this->SetXY($data['xt'],$this->GetY()+5); $this->cell(15,5,$data['3MF'],1,0,'C',1,0);$this->SetXY($data['xt']+15,$this->GetY());      $this->cell(30,5,$data['3M'],1,0,'C',0,0);$this->SetXY($data['xt']+45,$this->GetY());$this->cell(30,5,$data['3F'],1,0,'C',0,0);$this->SetXY($data['xt']+75,$this->GetY());$this->cell(15,5,$data['3M']+$data['3F'],1,0,'C',0,0);$this->SetXY($data['xt']+75+15,$this->GetY());$this->cell(15,5,round(((($data['3M']+$data['3F'])/$T)*100),2).' %',1,0,'R',1,0);        
	$this->SetXY($data['xt'],$this->GetY()+5); $this->cell(15,5,$data['4MF'],1,0,'C',1,0);$this->SetXY($data['xt']+15,$this->GetY());      $this->cell(30,5,$data['4M'],1,0,'C',0,0);$this->SetXY($data['xt']+45,$this->GetY());$this->cell(30,5,$data['4F'],1,0,'C',0,0);$this->SetXY($data['xt']+75,$this->GetY());$this->cell(15,5,$data['4M']+$data['4F'],1,0,'C',0,0);$this->SetXY($data['xt']+75+15,$this->GetY());$this->cell(15,5,round(((($data['4M']+$data['4F'])/$T)*100),2).' %',1,0,'R',1,0);        
	$this->SetXY($data['xt'],$this->GetY()+5); $this->cell(15,5,$data['5MF'],1,0,'C',1,0);$this->SetXY($data['xt']+15,$this->GetY());      $this->cell(30,5,$data['5M'],1,0,'C',0,0);$this->SetXY($data['xt']+45,$this->GetY());$this->cell(30,5,$data['5F'],1,0,'C',0,0);$this->SetXY($data['xt']+75,$this->GetY());$this->cell(15,5,$data['5M']+$data['5F'],1,0,'C',0,0);$this->SetXY($data['xt']+75+15,$this->GetY());$this->cell(15,5,round(((($data['5M']+$data['5F'])/$T)*100),2).' %',1,0,'R',1,0);        
	$this->SetXY($data['xt'],$this->GetY()+5); $this->cell(15,5,$data['6MF'],1,0,'C',1,0);$this->SetXY($data['xt']+15,$this->GetY());      $this->cell(30,5,$data['6M'],1,0,'C',0,0);$this->SetXY($data['xt']+45,$this->GetY());$this->cell(30,5,$data['6F'],1,0,'C',0,0);$this->SetXY($data['xt']+75,$this->GetY());$this->cell(15,5,$data['6M']+$data['6F'],1,0,'C',0,0);$this->SetXY($data['xt']+75+15,$this->GetY());$this->cell(15,5,round(((($data['6M']+$data['6F'])/$T)*100),2).' %',1,0,'R',1,0);        
	$this->SetXY($data['xt'],$this->GetY()+5); $this->cell(15,5,$data['7MF'],1,0,'C',1,0);$this->SetXY($data['xt']+15,$this->GetY());      $this->cell(30,5,$data['7M'],1,0,'C',0,0);$this->SetXY($data['xt']+45,$this->GetY());$this->cell(30,5,$data['7F'],1,0,'C',0,0);$this->SetXY($data['xt']+75,$this->GetY());$this->cell(15,5,$data['7M']+$data['7F'],1,0,'C',0,0);$this->SetXY($data['xt']+75+15,$this->GetY());$this->cell(15,5,round(((($data['7M']+$data['7F'])/$T)*100),2).' %',1,0,'R',1,0);        
	$this->SetXY($data['xt'],$this->GetY()+5); $this->cell(15,5,'Total',1,0,'C',1,0);$this->SetXY($data['xt']+15,$this->GetY());           $this->cell(30,5,$TM,1,0,'C',1,0);$this->SetXY($data['xt']+45,$this->GetY());$this->cell(30,5,$TF,1,0,'C',1,0);$this->SetXY($data['xt']+75,$this->GetY());$this->cell(15,5,$T,1,0,'C',1,0);$this->SetXY($data['xt']+75+15,$this->GetY());$this->cell(15,5,round(((($TM+$TF)/$T)*100),2).' %',1,0,'R',1,0); 	                                                                
	$this->SetXY($data['xt'],$this->GetY()+5); $this->cell(15,5,'P %',1,0,'C',1,0);      
	$this->SetXY($data['xt']+15,$this->GetY());      $this->cell(30,5,round(($TM/$T)*100,2),1,0,'C',1,0);
	$this->SetXY($data['xt']+45,$this->GetY());      $this->cell(30,5,round(($TF/$T)*100,2),1,0,'C',1,0);
	$this->SetXY($data['xt']+75,$this->GetY());      $this->cell(15,5,round(($T/$T)*100,2).' %',1,0,'C',1,0);
	$this->SetXY($data['xt']+75+15,$this->GetY());   $this->cell(15,5,'***',1,0,'C',1,0); 	                                                                
	$this->SetXY(5,25+10);$this->cell(285,5,html_entity_decode(utf8_decode("Cette étude a porté sur ".$T." décès survenus durant la periode du ".$this->dateUS2FR($datejour1)." au ".$this->dateUS2FR($datejour2)." au niveau de 36 communes ")),0,0,'L',0);
	$this->SetXY(5,175);$this->cell(285,5,html_entity_decode(utf8_decode("1-Répartition des décès par sexe : ")),0,0,'L',0);
	$this->SetXY(5,175+5);$this->cell(285,5,html_entity_decode(utf8_decode("La répartition des ".$T." décès enregistrés montre que :")),0,0,'L',0);
	$this->SetXY(5,175+10);$this->cell(285,5,html_entity_decode(utf8_decode(round(($TM/$T)*100,2)."% des décès touche les garcons. ")),0,0,'L',0);
	$this->SetXY(5,175+15);$this->cell(285,5,html_entity_decode(utf8_decode(round(($TF/$T)*100,2)."% des décès touche les filles. ")),0,0,'L',0);
	if($TF>0){$TF0=$TF;}else{$TF0=1;}
	$this->SetXY(5,175+20);$this->cell(285,5,html_entity_decode(utf8_decode("avec un sexe ratio de ".round(($TM/$TF0),2))),0,0,'L',0);
	$this->SetXY(5,175+30);$this->cell(285,5,html_entity_decode(utf8_decode("2-Répartition des décès par tranche d'âge : ")),0,0,'L',0);
	rsort($datamf);
	$this->SetXY(5,175+35,$this->GetY()+5);$this->cell(285,5,html_entity_decode(utf8_decode("la proportion des décès la plus élevée est : ".round($datamf[0]*100/$T,2)."%")),0,0,'L',0);
    sort($datamf);
    $this->SetXY(5,175+40,$this->GetY()+5);$this->cell(285,5,html_entity_decode(utf8_decode("la proportion des décès la moins élevée est : ".round($datamf[0]*100/$T,2)."%")),0,0,'L',0);
	$pie2 = array(
	"x" => 135, 
	"y" => 200, 
	"r" => 17,
	"v1" => $TM,
	"v2" => $TF,
	"t0" => html_entity_decode(utf8_decode("Distribution des décès par sexe ")),
	"t1" => "M",
	"t2" => "F");
    $this->pie2($pie2);
	$TA1=$data['1M']+$data['1F'];
	$TA2=$data['2M']+$data['2F'];
	$TA3=$data['3M']+$data['3F'];
	$TA4=$data['4M']+$data['4F'];
	$TA5=$data['5M']+$data['5F'];
	$TA6=$data['6M']+$data['6F'];
	$TA7=$data['7M']+$data['7F'];
	$this->bar7(135,150,$TA1,$TA2,$TA3,$TA4,$TA5,$TA6,$TA7,utf8_decode('Distribution des décès par tranche d\'age en jours')); 
	}
	function valeurmoisdeces($SRS,$TBL,$COLONE1,$COLONE2,$DATEJOUR1,$DATEJOUR2,$VALEUR2,$STR,$STRUCTURED) 
	{
	$this->mysqlconnect();
	$sql = " select * from $TBL where $COLONE1 BETWEEN '$DATEJOUR1' AND '$DATEJOUR2' and ($COLONE2='$VALEUR2') and (STRUCTURED $STRUCTURED)";
	$requete = @mysql_query($sql) or die($sql."<br>".mysql_error());
	$OP=mysql_num_rows($requete);
	mysql_free_result($requete);
	return $OP;
	}
	function valeurmoisdeceshc($TBL,$COLONE1,$DATEJOUR1,$DATEJOUR2,$STRUCTURED) 
	{
	$this->mysqlconnect();
	$sql = " select * from $TBL where  ($COLONE1 BETWEEN '$DATEJOUR1' AND '$DATEJOUR2')  and  WILAYAR!=17000  and  (STRUCTURED $STRUCTURED)";
	$requete = @mysql_query($sql) or die($sql."<br>".mysql_error());
	$OP=mysql_num_rows($requete);
	mysql_free_result($requete);
	return $OP;
	}
	function valeurmoisdecest($SRS,$TBL,$COLONE1,$COLONE2,$DATEJOUR1,$DATEJOUR2,$VALEUR2,$STR,$STRUCTURED) 
	{
	$this->mysqlconnect();
	$sql = " select * from $TBL where $COLONE1 BETWEEN '$DATEJOUR1' AND '$DATEJOUR2' and (STRUCTURED $STRUCTURED)";
	$requete = @mysql_query($sql) or die($sql."<br>".mysql_error());
	$OP=mysql_num_rows($requete);
	mysql_free_result($requete);
	return $OP;
	}	
	
	function tblparcommune($dnrdon,$datejour1,$datejour2,$STRUCTURED) 
	{    
		$this->SetFont('Times', 'B', 10);
		$h=35;
		$this->SetXY(8,$h);$this->cell(15,5,"IDCOM",1,0,'C',1,0);
		$this->cell(90,5,"Commune",1,0,'C',1,0);
	    $this->cell(20,5,"Superficie",1,0,'C',1,0);
		$this->cell(30,5,"Population 2008",1,0,'C',1,0);
		$this->cell(20,5,$dnrdon,1,0,'C',1,0);
		$this->cell(20,5,"Tx mortalite",1,0,'C',1,0);
		$this->SetXY(8,$h+5);
		$IDWIL=17000;
		$ANNEE='2007';
		$this->mysqlconnect();
		$query="SELECT * FROM com where IDWIL='$IDWIL' and yes='1' order by COMMUNE "; //    % %will search form 0-9,a-z            
		$resultat=mysql_query($query);
		$totalmbr1=mysql_num_rows($resultat);
		while($row=mysql_fetch_object($resultat))
		{
			$this->SetFont('Times', '', 10);
			$this->cell(15,4,trim($row->IDCOM),1,0,'C',0);
			$this->cell(90,4,trim($row->COMMUNE),1,0,'L',0);
			$this->cell(20,4,trim($row->SUPER),1,0,'L',0);
			$this->cell(30,4,trim($row->POPULATION),1,0,'L',0);
			$this->cell(20,4,$this->valeurmoisdeces('','deceshosp','DINS','COMMUNER',$datejour1,$datejour2,trim($row->IDCOM),'',$STRUCTURED),1,0,'L',0);
			$this->cell(20,4,round(($this->valeurmoisdeces('','deceshosp','DINS','COMMUNER',$datejour1,$datejour2,trim($row->IDCOM),'',$STRUCTURED)*1000)/$row->POPULATION,3),1,0,'L',0);
			$this->SetXY(8,$this->GetY()+4); 
		}
		$req="SELECT SUM(SUPER) AS total FROM com WHERE IDWIL='$IDWIL' and yes='1'";
		$query1 = mysql_query($req);   
		$rs = mysql_fetch_assoc($query1);
		$req1="SELECT SUM(POPULATION) AS total1 FROM com WHERE IDWIL='$IDWIL' and yes='1'";
		$query11 = mysql_query($req1);   
		$rs1 = mysql_fetch_assoc($query11);
        //non coriger  probleme des hors commune 
		$this->SetXY(8,$this->GetY());
		$this->cell(15,5,"HC",1,0,'C',1,0);
		$this->cell(140,5,"Hors Communes",1,0,'C',1,0);
		$this->cell(20,5,$this->valeurmoisdeceshc('deceshosp','DINS',$datejour1,$datejour2,$STRUCTURED),1,0,'C',1,0);
		$this->cell(20,5,"",1,0,'C',1,0);
		
		$this->SetXY(8,$this->GetY()+5);$this->cell(15,5,"Total",1,0,'C',1,0);	  
		$this->cell(90,5,$totalmbr1."  Communes",1,0,'C',1,0);	  
		$this->cell(20,5,round($rs['total'],2),1,0,'C',1,0);	  
	    $this->cell(30,5,round($rs1['total1'],2),1,0,'C',1,0);	  
		$this->cell(20,5,$this->valeurmoisdecest('','deceshosp','DINS','COMMUNER',$datejour1,$datejour2,'','',$STRUCTURED),1,0,'C',1,0);	  
		$this->cell(20,5,round(($this->valeurmoisdecest('','deceshosp','DINS','COMMUNER',$datejour1,$datejour2,'','',$STRUCTURED)*1000)/round($rs1['total1'],3),3),1,0,'C',1,0);	  
	}
	
	function tblparwilaya($dnrdon,$datejour1,$datejour2,$STRUCTURED) 
	{    
		$this->SetFont('Times', 'B', 10);
		$h=35;
		$this->SetXY(8,$h);$this->cell(15,5,"IDWIL",1,0,'C',1,0);
		$this->cell(90,5,"Wilaya",1,0,'C',1,0);
	    $this->cell(20,5,"Superficie",1,0,'C',1,0);
		$this->cell(30,5,"Population 2008",1,0,'C',1,0);
		$this->cell(20,5,$dnrdon,1,0,'C',1,0);
		$this->cell(20,5,"Tx mortalite",1,0,'C',1,0);
		$this->SetXY(8,$h+5);
		// $IDWIL=17000;
		// $ANNEE='2007';
		$this->mysqlconnect();
		$query="SELECT * FROM wil  "; //    % %will search form 0-9,a-z            
		$resultat=mysql_query($query);
		$totalmbr1=mysql_num_rows($resultat);
		while($row=mysql_fetch_object($resultat))
		{
			$this->SetFont('Times', '', 10);
			$this->cell(15,4,trim($row->IDWIL),1,0,'C',0);
		    $this->cell(90,4,trim($row->WILAYAS),1,0,'L',0);
			$this->cell(20,4,trim(""),1,0,'L',0);
			$this->cell(30,4,trim(""),1,0,'L',0);
			$this->cell(20,4,$this->valeurmoisdeces('','deceshosp','DINS','WILAYAR',$datejour1,$datejour2,trim($row->IDWIL),'',$STRUCTURED),1,0,'L',0);
			$this->cell(20,4,trim(""),1,0,'L',0);
			// $this->cell(20,4,trim($row->SUPER),1,0,'L',0);
			// $this->cell(30,4,trim($row->POPULATION),1,0,'L',0);
			// $this->cell(20,4,$this->valeurmoisdeces('','deceshosp','DINS','COMMUNER',$datejour1,$datejour2,trim($row->IDCOM),'',$STRUCTURED),1,0,'L',0);
			// $this->cell(20,4,round(($this->valeurmoisdeces('','deceshosp','DINS','COMMUNER',$datejour1,$datejour2,trim($row->IDCOM),'',$STRUCTURED)*1000)/$row->POPULATION,3),1,0,'L',0);
			$this->SetXY(8,$this->GetY()+4); 
		}
		// $req="SELECT SUM(SUPER) AS total FROM com WHERE IDWIL='$IDWIL' and yes='1'";
		// $query1 = mysql_query($req);   
		// $rs = mysql_fetch_assoc($query1);
		// $req1="SELECT SUM(POPULATION) AS total1 FROM com WHERE IDWIL='$IDWIL' and yes='1'";
		// $query11 = mysql_query($req1);   
		// $rs1 = mysql_fetch_assoc($query11);
        //non coriger  probleme des hors wilaya 
		$this->SetXY(8,$this->GetY());
		$this->cell(15,5,"Hw",1,0,'C',1,0);
		$this->cell(140,5,"Hors Wilaya",1,0,'C',1,0);
		$this->cell(20,5,"***",1,0,'C',1,0);
		//$this->cell(20,5,$this->valeurmoisdeceshc('deceshosp','DINS',$datejour1,$datejour2,$STRUCTURED),1,0,'C',1,0);
		$this->cell(20,5,"",1,0,'C',1,0);
		$this->SetXY(8,$this->GetY()+5);$this->cell(15,5,"Total",1,0,'C',1,0);	  
		$this->cell(90,5,($totalmbr1-1)."  Wilayas",1,0,'C',1,0);	  
		$this->cell(20,5,"",1,0,'C',1,0);
		$this->cell(30,5,"",1,0,'C',1,0);
		$this->cell(20,5,"",1,0,'C',1,0);
		$this->cell(20,5,"",1,0,'C',1,0);
		// $this->cell(20,5,round($rs['total'],2),1,0,'C',1,0);	  
	    // $this->cell(30,5,round($rs1['total1'],2),1,0,'C',1,0);	  
		// $this->cell(20,5,$this->valeurmoisdecest('','deceshosp','DINS','COMMUNER',$datejour1,$datejour2,'','',$STRUCTURED),1,0,'C',1,0);	  
		// $this->cell(20,5,round(($this->valeurmoisdecest('','deceshosp','DINS','COMMUNER',$datejour1,$datejour2,'','',$STRUCTURED)*1000)/round($rs1['total1'],3),3),1,0,'C',1,0);	  
	}
	
	
	
	
	
	function datasigwil($datejour1,$datejour2,$STRUCTURED) 
	{
	$data = array(
	"titre"=> 'Nombre De Deces',
	"A"    => '00-00',
	"B"    => '01-10',
	"C"    => '09-100',
	"D"    => '99-1000',
	"E"    => '999-10000',
	"1"    => $this->deceswil($datejour1,$datejour2,1000,$STRUCTURED),
	"2"    => $this->deceswil($datejour1,$datejour2,2000,$STRUCTURED),
	"3"    => $this->deceswil($datejour1,$datejour2,3000,$STRUCTURED),
	"4"    => $this->deceswil($datejour1,$datejour2,4000,$STRUCTURED),
	"5"    => $this->deceswil($datejour1,$datejour2,5000,$STRUCTURED),
	"6"    => $this->deceswil($datejour1,$datejour2,6000,$STRUCTURED),
	"7"    => $this->deceswil($datejour1,$datejour2,7000,$STRUCTURED),
	"8"    => $this->deceswil($datejour1,$datejour2,8000,$STRUCTURED),
	"9"    => $this->deceswil($datejour1,$datejour2,9000,$STRUCTURED),
	"10"    => $this->deceswil($datejour1,$datejour2,10000,$STRUCTURED),
	"11"    => $this->deceswil($datejour1,$datejour2,11000,$STRUCTURED),
	"12"    => $this->deceswil($datejour1,$datejour2,12000,$STRUCTURED),
	"13"    => $this->deceswil($datejour1,$datejour2,13000,$STRUCTURED),
	"14"    => $this->deceswil($datejour1,$datejour2,14000,$STRUCTURED),
	"15"    => $this->deceswil($datejour1,$datejour2,15000,$STRUCTURED),
	"16"    => $this->deceswil($datejour1,$datejour2,16000,$STRUCTURED),
	"17"    => $this->deceswil($datejour1,$datejour2,17000,$STRUCTURED),
	"18"    => $this->deceswil($datejour1,$datejour2,18000,$STRUCTURED),
	"19"    => $this->deceswil($datejour1,$datejour2,19000,$STRUCTURED),
	"20"    => $this->deceswil($datejour1,$datejour2,20000,$STRUCTURED),
	"21"    => $this->deceswil($datejour1,$datejour2,21000,$STRUCTURED),
	"22"    => $this->deceswil($datejour1,$datejour2,22000,$STRUCTURED),
	"23"    => $this->deceswil($datejour1,$datejour2,23000,$STRUCTURED),
	"24"    => $this->deceswil($datejour1,$datejour2,24000,$STRUCTURED),
	"25"    => $this->deceswil($datejour1,$datejour2,25000,$STRUCTURED),
	"26"    => $this->deceswil($datejour1,$datejour2,26000,$STRUCTURED),
	"27"    => $this->deceswil($datejour1,$datejour2,27000,$STRUCTURED),
	"28"    => $this->deceswil($datejour1,$datejour2,28000,$STRUCTURED),
	"29"    => $this->deceswil($datejour1,$datejour2,29000,$STRUCTURED),
	"30"    => $this->deceswil($datejour1,$datejour2,30000,$STRUCTURED),
	"31"    => $this->deceswil($datejour1,$datejour2,31000,$STRUCTURED),
	"32"    => $this->deceswil($datejour1,$datejour2,32000,$STRUCTURED),
	"33"    => $this->deceswil($datejour1,$datejour2,33000,$STRUCTURED),
	"34"    => $this->deceswil($datejour1,$datejour2,34000,$STRUCTURED),
	"35"    => $this->deceswil($datejour1,$datejour2,35000,$STRUCTURED),
	"36"    => $this->deceswil($datejour1,$datejour2,36000,$STRUCTURED),
	"37"    => $this->deceswil($datejour1,$datejour2,37000,$STRUCTURED),
	"38"    => $this->deceswil($datejour1,$datejour2,38000,$STRUCTURED),
	"39"    => $this->deceswil($datejour1,$datejour2,39000,$STRUCTURED),
	"40"    => $this->deceswil($datejour1,$datejour2,40000,$STRUCTURED),
	"41"    => $this->deceswil($datejour1,$datejour2,41000,$STRUCTURED),
	"42"    => $this->deceswil($datejour1,$datejour2,42000,$STRUCTURED),
	"43"    => $this->deceswil($datejour1,$datejour2,43000,$STRUCTURED),
	"44"    => $this->deceswil($datejour1,$datejour2,44000,$STRUCTURED),
	"45"    => $this->deceswil($datejour1,$datejour2,45000,$STRUCTURED),
	"46"    => $this->deceswil($datejour1,$datejour2,46000,$STRUCTURED),
	"47"    => $this->deceswil($datejour1,$datejour2,47000,$STRUCTURED),
	"48"    => $this->deceswil($datejour1,$datejour2,48000,$STRUCTURED)
	);		
	return $data;
	}
	
	function deceswil($DATEJOUR1,$DATEJOUR2,$WILAYAR,$STRUCTURED) 
	{
	$this->mysqlconnect();
	$sql = " select * from deceshosp where DINS BETWEEN '$DATEJOUR1' AND '$DATEJOUR2' and WILAYAR=$WILAYAR and STRUCTURED $STRUCTURED  ";
	$requete = @mysql_query($sql) or die($sql."<br>".mysql_error());
	$OP=mysql_num_rows($requete);
	mysql_free_result($requete);
	return $OP;
	}
	function color($x) 
    {	
	if($x <= 0 ){$this->SetDrawColor(255,0,0);$this->SetFillColor(193,205,205);}//gris
	if($x >0  and $x<=10){$this->SetDrawColor(255,0,0);$this->SetFillColor(0,250,255);}//jaune
	if($x >10 and $x<=100){$this->SetDrawColor(255,0,0);$this->SetFillColor(0,255,0);}//orange
	if($x >100 and $x<=1000){$this->SetDrawColor(255,0,0);$this->SetFillColor(255,0,0);}//rouge
	if($x >1000 and $x<=10000){$this->SetDrawColor(255,0,0);$this->SetFillColor(165,42,42);}//brond	
    }
	function Algerie($data,$x,$y,$z,$cd) 
    {
	//$this->Image('../public/IMAGES/photos/pc.gif',250,50,30,30,0);
	$this->SetXY(220,40);$this->cell(65,5,'WILAYA DE DJELFA',1,0,'C',1,0);
	$this->RoundedRect($x-15,35,158,200, 2, $style = '');
	$this->RoundedRect($x-15,35,200,200, 2, $style = '');
	
	if ($cd=='wilaya')
	{
	       //tindouf
			$this->color($data['37']);$this->Polygon(array((98+$x)/$z,(244+$y)/$z,(100+$x)/$z,(248+$y)/$z,(106+$x)/$z,(250+$y)/$z,(113+$x)/$z,(250+$y)/$z,(120+$x)/$z,(254+$y)/$z,(125+$x)/$z,(271+$y)/$z,(133+$x)/$z,(290+$y)/$z,(136+$x)/$z,(295+$y)/$z,(136+$x)/$z,(304+$y)/$z,(141+$x)/$z,(310+$y)/$z,(147+$x)/$z,(314+$y)/$z,(159+$x)/$z,(318+$y)/$z,(159+$x)/$z,(327+$y)/$z,(146+$x)/$z,(341+$y)/$z,(138+$x)/$z,(335+$y)/$z,(133+$x)/$z,(343+$y)/$z,(127+$x)/$z,(354+$y)/$z,(110+$x)/$z,(354+$y)/$z,(101+$x)/$z,(361+$y)/$z,(87+$x)/$z,(367+$y)/$z,(8+$x)/$z,(308+$y)/$z,(10+$x)/$z,(264+$y)/$z,(26+$x)/$z,(256+$y)/$z,(41+$x)/$z,(248+$y)/$z,(47+$x)/$z,(248+$y)/$z,(52+$x)/$z,(243+$y)/$z,(64+$x)/$z,(246+$y)/$z,(72+$x)/$z,(243+$y)/$z,(89+$x)/$z,(243+$y)/$z,(95+$x)/$z,(248+$y)/$z,(98+$x)/$z,(244+$y)/$z),'FD');
			//adrar
			$this->color($data['1']);$this->Polygon(array((159+$x)/$z,(318+$y)/$z,(163+$x)/$z,(302+$y)/$z,(168+$x)/$z,(299+$y)/$z,(174+$x)/$z,(289+$y)/$z,(183+$x)/$z,(282+$y)/$z,(190+$x)/$z,(272+$y)/$z,(200+$x)/$z,(269+$y)/$z,(219+$x)/$z,(267+$y)/$z,(222+$x)/$z,(263+$y)/$z,(226+$x)/$z,(261+$y)/$z,(226+$x)/$z,(244+$y)/$z,(233+$x)/$z,(240+$y)/$z,(238+$x)/$z,(235+$y)/$z,(242+$x)/$z,(234+$y)/$z,(242+$x)/$z,(229+$y)/$z,(247+$x)/$z,(224+$y)/$z,(255+$x)/$z,(214+$y)/$z,(261+$x)/$z,(210+$y)/$z,(265+$x)/$z,(209+$y)/$z,(269+$x)/$z,(204+$y)/$z,(274+$x)/$z,(203+$y)/$z,(277+$x)/$z,(198+$y)/$z,(282+$x)/$z,(197+$y)/$z,(286+$x)/$z,(194+$y)/$z,(292+$x)/$z,(191+$y)/$z,(295+$x)/$z,(187+$y)/$z,(298+$x)/$z,(187+$y)/$z,(297+$x)/$z,(224+$y)/$z,(294+$x)/$z,(236+$y)/$z,(297+$x)/$z,(246+$y)/$z,(300+$x)/$z,(268+$y)/$z,(297+$x)/$z,(285+$y)/$z,(292+$x)/$z,(293+$y)/$z,(292+$x)/$z,(306+$y)/$z,(288+$x)/$z,(311+$y)/$z,(288+$x)/$z,(317+$y)/$z,(291+$x)/$z,(321+$y)/$z,(288+$x)/$z,(328+$y)/$z,(287+$x)/$z,(338+$y)/$z,(278+$x)/$z,(339+$y)/$z,(274+$x)/$z,(345+$y)/$z,(269+$x)/$z,(350+$y)/$z,(269+$x)/$z,(357+$y)/$z,(279+$x)/$z,(371+$y)/$z,(282+$x)/$z,(485+$y)/$z,(291+$x)/$z,(486+$y)/$z,(293+$x)/$z,(495+$y)/$z,(297+$x)/$z,(499+$y)/$z,(304+$x)/$z,(512+$y)/$z,(306+$x)/$z,(520+$y)/$z,(310+$x)/$z,(532+$y)/$z,(313+$x)/$z,(539+$y)/$z,(302+$x)/$z,(534+$y)/$z,(294+$x)/$z,(534+$y)/$z,(287+$x)/$z,(525+$y)/$z,(275+$x)/$z,(518+$y)/$z,(273+$x)/$z,(506+$y)/$z,(87+$x)/$z,(367+$y)/$z,(101+$x)/$z,(361+$y)/$z,(110+$x)/$z,(354+$y)/$z,(127+$x)/$z,(354+$y)/$z,(133+$x)/$z,(343+$y)/$z,(138+$x)/$z,(335+$y)/$z,(146+$x)/$z,(341+$y)/$z,(159+$x)/$z,(327+$y)/$z,(159+$x)/$z,(318+$y)/$z),'FD');
			//tamanraset
			$this->color($data['11']);$this->Polygon(array((300+$x)/$z,(268+$y)/$z,(324+$x)/$z,(265+$y)/$z,(330+$x)/$z,(269+$y)/$z,(333+$x)/$z,(275+$y)/$z,(339+$x)/$z,(276+$y)/$z,(344+$x)/$z,(282+$y)/$z,(349+$x)/$z,(277+$y)/$z,(355+$x)/$z,(275+$y)/$z,(357+$x)/$z,(271+$y)/$z,(363+$x)/$z,(269+$y)/$z,(366+$x)/$z,(265+$y)/$z,(368+$x)/$z,(262+$y)/$z,(375+$x)/$z,(258+$y)/$z,(379+$x)/$z,(257+$y)/$z,(382+$x)/$z,(253+$y)/$z,(386+$x)/$z,(251+$y)/$z,(390+$x)/$z,(248+$y)/$z,(391+$x)/$z,(244+$y)/$z,(396+$x)/$z,(243+$y)/$z,(397+$x)/$z,(284+$y)/$z,(396+$x)/$z,(294+$y)/$z,(399+$x)/$z,(310+$y)/$z,(399+$x)/$z,(325+$y)/$z,(404+$x)/$z,(326+$y)/$z,(406+$x)/$z,(331+$y)/$z,(411+$x)/$z,(333+$y)/$z,(415+$x)/$z,(337+$y)/$z,(411+$x)/$z,(345+$y)/$z,(417+$x)/$z,(353+$y)/$z,(423+$x)/$z,(367+$y)/$z,(423+$x)/$z,(372+$y)/$z,(428+$x)/$z,(374+$y)/$z,(433+$x)/$z,(385+$y)/$z,(440+$x)/$z,(393+$y)/$z,(444+$x)/$z,(393+$y)/$z,(449+$x)/$z,(399+$y)/$z,(452+$x)/$z,(401+$y)/$z,(453+$x)/$z,(420+$y)/$z,(456+$x)/$z,(429+$y)/$z,(459+$x)/$z,(433+$y)/$z,(457+$x)/$z,(438+$y)/$z,(465+$x)/$z,(443+$y)/$z,(486+$x)/$z,(439+$y)/$z,(490+$x)/$z,(434+$y)/$z,(497+$x)/$z,(429+$y)/$z,(501+$x)/$z,(426+$y)/$z,(517+$x)/$z,(426+$y)/$z,(532+$x)/$z,(432+$y)/$z,(531+$x)/$z,(455+$y)/$z,(410+$x)/$z,(557+$y)/$z,(338+$x)/$z,(573+$y)/$z,(331+$x)/$z,(568+$y)/$z,(334+$x)/$z,(562+$y)/$z,(334+$x)/$z,(547+$y)/$z,(313+$x)/$z,(539+$y)/$z,(310+$x)/$z,(532+$y)/$z,(306+$x)/$z,(520+$y)/$z,(304+$x)/$z,(512+$y)/$z,(297+$x)/$z,(499+$y)/$z,(293+$x)/$z,(495+$y)/$z,(291+$x)/$z,(486+$y)/$z,(282+$x)/$z,(485+$y)/$z,(279+$x)/$z,(371+$y)/$z,(269+$x)/$z,(357+$y)/$z,(269+$x)/$z,(350+$y)/$z,(274+$x)/$z,(345+$y)/$z,(278+$x)/$z,(339+$y)/$z,(287+$x)/$z,(338+$y)/$z,(288+$x)/$z,(328+$y)/$z,(291+$x)/$z,(321+$y)/$z,(288+$x)/$z,(317+$y)/$z,(288+$x)/$z,(311+$y)/$z,(292+$x)/$z,(306+$y)/$z,(292+$x)/$z,(293+$y)/$z,(297+$x)/$z,(285+$y)/$z,(300+$x)/$z,(268+$y)/$z),'FD');
			//illizi
			$this->color($data['33']);$this->Polygon(array((396+$x)/$z,(243+$y)/$z,(400+$x)/$z,(239+$y)/$z,(408+$x)/$z,(235+$y)/$z,(415+$x)/$z,(232+$y)/$z,(419+$x)/$z,(233+$y)/$z,(423+$x)/$z,(231+$y)/$z,(452+$x)/$z,(223+$y)/$z,(483+$x)/$z,(215+$y)/$z,(494+$x)/$z,(212+$y)/$z,(495+$x)/$z,(218+$y)/$z,(496+$x)/$z,(224+$y)/$z,(493+$x)/$z,(227+$y)/$z,(497+$x)/$z,(234+$y)/$z,(507+$x)/$z,(254+$y)/$z,(509+$x)/$z,(282+$y)/$z,(512+$x)/$z,(293+$y)/$z,(511+$x)/$z,(300+$y)/$z,(510+$x)/$z,(307+$y)/$z,(510+$x)/$z,(314+$y)/$z,(511+$x)/$z,(323+$y)/$z,(514+$x)/$z,(326+$y)/$z,(514+$x)/$z,(331+$y)/$z,(508+$x)/$z,(338+$y)/$z,(503+$x)/$z,(340+$y)/$z,(502+$x)/$z,(346+$y)/$z,(507+$x)/$z,(353+$y)/$z,(512+$x)/$z,(360+$y)/$z,(513+$x)/$z,(363+$y)/$z,(519+$x)/$z,(368+$y)/$z,(521+$x)/$z,(382+$y)/$z,(528+$x)/$z,(394+$y)/$z,(536+$x)/$z,(395+$y)/$z,(542+$x)/$z,(395+$y)/$z,(548+$x)/$z,(394+$y)/$z,(554+$x)/$z,(399+$y)/$z,(561+$x)/$z,(402+$y)/$z,(566+$x)/$z,(401+$y)/$z,(571+$x)/$z,(409+$y)/$z,(577+$x)/$z,(421+$y)/$z,(571+$x)/$z,(427+$y)/$z,(565+$x)/$z,(433+$y)/$z,(531+$x)/$z,(455+$y)/$z,(532+$x)/$z,(432+$y)/$z,(517+$x)/$z,(426+$y)/$z,(501+$x)/$z,(426+$y)/$z,(497+$x)/$z,(429+$y)/$z,(490+$x)/$z,(434+$y)/$z,(486+$x)/$z,(439+$y)/$z,(465+$x)/$z,(443+$y)/$z,(457+$x)/$z,(438+$y)/$z,(459+$x)/$z,(433+$y)/$z,(456+$x)/$z,(429+$y)/$z,(453+$x)/$z,(420+$y)/$z,(452+$x)/$z,(401+$y)/$z,(449+$x)/$z,(399+$y)/$z,(444+$x)/$z,(393+$y)/$z,(440+$x)/$z,(393+$y)/$z,(433+$x)/$z,(385+$y)/$z,(428+$x)/$z,(374+$y)/$z,(423+$x)/$z,(372+$y)/$z,(423+$x)/$z,(367+$y)/$z,(417+$x)/$z,(353+$y)/$z,(411+$x)/$z,(345+$y)/$z,(415+$x)/$z,(337+$y)/$z,(411+$x)/$z,(333+$y)/$z,(406+$x)/$z,(331+$y)/$z,(404+$x)/$z,(326+$y)/$z,(399+$x)/$z,(325+$y)/$z,(399+$x)/$z,(310+$y)/$z,(396+$x)/$z,(294+$y)/$z,(397+$x)/$z,(284+$y)/$z,(396+$x)/$z,(243+$y)/$z),'FD');
			//ghardaya
			$this->color($data['47']);$this->Polygon(array((298+$x)/$z,(187+$y)/$z,(304+$x)/$z,(179+$y)/$z,(303+$x)/$z,(170+$y)/$z,(306+$x)/$z,(169+$y)/$z,(306+$x)/$z,(164+$y)/$z,(303+$x)/$z,(162+$y)/$z,(303+$x)/$z,(151+$y)/$z,(315+$x)/$z,(150+$y)/$z,(323+$x)/$z,(149+$y)/$z,(331+$x)/$z,(150+$y)/$z,(332+$x)/$z,(147+$y)/$z,(328+$x)/$z,(145+$y)/$z,(338+$x)/$z,(144+$y)/$z,(341+$x)/$z,(142+$y)/$z,(343+$x)/$z,(144+$y)/$z,(347+$x)/$z,(144+$y)/$z,(360+$x)/$z,(143+$y)/$z,(374+$x)/$z,(146+$y)/$z,(374+$x)/$z,(153+$y)/$z,(369+$x)/$z,(160+$y)/$z,(360+$x)/$z,(170+$y)/$z,(360+$x)/$z,(188+$y)/$z,(352+$x)/$z,(213+$y)/$z,(344+$x)/$z,(240+$y)/$z,(336+$x)/$z,(255+$y)/$z,(324+$x)/$z,(265+$y)/$z,(300+$x)/$z,(268+$y)/$z,(297+$x)/$z,(246+$y)/$z,(294+$x)/$z,(236+$y)/$z,(297+$x)/$z,(224+$y)/$z,(298+$x)/$z,(187+$y)/$z),'FD');
			//ouargla
			$this->color($data['30']);$this->Polygon(array((374+$x)/$z,(146+$y)/$z,(372+$x)/$z,(137+$y)/$z,(373+$x)/$z,(132+$y)/$z,(374+$x)/$z,(137+$y)/$z,(380+$x)/$z,(132+$y)/$z,(401+$x)/$z,(131+$y)/$z,(400+$x)/$z,(125+$y)/$z,(402+$x)/$z,(122+$y)/$z,(399+$x)/$z,(119+$y)/$z,(400+$x)/$z,(116+$y)/$z,(402+$x)/$z,(115+$y)/$z,(405+$x)/$z,(113+$y)/$z,(407+$x)/$z,(122+$y)/$z,(409+$x)/$z,(129+$y)/$z,(417+$x)/$z,(149+$y)/$z,(420+$x)/$z,(154+$y)/$z,(422+$x)/$z,(160+$y)/$z,(426+$x)/$z,(162+$y)/$z,(431+$x)/$z,(171+$y)/$z,(480+$x)/$z,(167+$y)/$z,(494+$x)/$z,(212+$y)/$z,(483+$x)/$z,(215+$y)/$z,(452+$x)/$z,(223+$y)/$z,(423+$x)/$z,(231+$y)/$z,(419+$x)/$z,(233+$y)/$z,(415+$x)/$z,(232+$y)/$z,(408+$x)/$z,(235+$y)/$z,(400+$x)/$z,(239+$y)/$z,(396+$x)/$z,(243+$y)/$z,(391+$x)/$z,(244+$y)/$z,(390+$x)/$z,(248+$y)/$z,(386+$x)/$z,(251+$y)/$z,(382+$x)/$z,(253+$y)/$z,(379+$x)/$z,(257+$y)/$z,(375+$x)/$z,(258+$y)/$z,(368+$x)/$z,(262+$y)/$z,(366+$x)/$z,(265+$y)/$z,(363+$x)/$z,(269+$y)/$z,(357+$x)/$z,(271+$y)/$z,(355+$x)/$z,(275+$y)/$z,(349+$x)/$z,(277+$y)/$z,(344+$x)/$z,(282+$y)/$z,(339+$x)/$z,(276+$y)/$z,(333+$x)/$z,(275+$y)/$z,(330+$x)/$z,(269+$y)/$z,(324+$x)/$z,(265+$y)/$z,(336+$x)/$z,(255+$y)/$z,(344+$x)/$z,(240+$y)/$z,(352+$x)/$z,(213+$y)/$z,(360+$x)/$z,(188+$y)/$z,(360+$x)/$z,(170+$y)/$z,(369+$x)/$z,(160+$y)/$z,(374+$x)/$z,(153+$y)/$z,(374+$x)/$z,(146+$y)/$z),'FD');
			//bechar
			$this->color($data['8']);$this->Polygon(array((98+$x)/$z,(244+$y)/$z,(101+$x)/$z,(240+$y)/$z,(108+$x)/$z,(231+$y)/$z,(114+$x)/$z,(227+$y)/$z,(119+$x)/$z,(226+$y)/$z,(122+$x)/$z,(222+$y)/$z,(128+$x)/$z,(219+$y)/$z,(133+$x)/$z,(215+$y)/$z,(142+$x)/$z,(215+$y)/$z,(147+$x)/$z,(213+$y)/$z,(148+$x)/$z,(207+$y)/$z,(151+$x)/$z,(204+$y)/$z,(147+$x)/$z,(199+$y)/$z,(145+$x)/$z,(195+$y)/$z,(148+$x)/$z,(191+$y)/$z,(149+$x)/$z,(185+$y)/$z,(154+$x)/$z,(183+$y)/$z,(160+$x)/$z,(182+$y)/$z,(169+$x)/$z,(180+$y)/$z,(169+$x)/$z,(171+$y)/$z,(178+$x)/$z,(170+$y)/$z,(192+$x)/$z,(169+$y)/$z,(204+$x)/$z,(171+$y)/$z,(212+$x)/$z,(171+$y)/$z,(212+$x)/$z,(163+$y)/$z,(217+$x)/$z,(163+$y)/$z,(218+$x)/$z,(169+$y)/$z,(226+$x)/$z,(167+$y)/$z,(237+$x)/$z,(169+$y)/$z,(235+$x)/$z,(194+$y)/$z,(239+$x)/$z,(197+$y)/$z,(238+$x)/$z,(202+$y)/$z,(244+$x)/$z,(206+$y)/$z,(245+$x)/$z,(210+$y)/$z,(250+$x)/$z,(210+$y)/$z,(255+$x)/$z,(214+$y)/$z,(247+$x)/$z,(224+$y)/$z,(242+$x)/$z,(229+$y)/$z,(242+$x)/$z,(234+$y)/$z,(238+$x)/$z,(235+$y)/$z,(233+$x)/$z,(240+$y)/$z,(226+$x)/$z,(244+$y)/$z,(226+$x)/$z,(261+$y)/$z,(222+$x)/$z,(263+$y)/$z,(219+$x)/$z,(267+$y)/$z,(200+$x)/$z,(269+$y)/$z,(190+$x)/$z,(272+$y)/$z,(183+$x)/$z,(282+$y)/$z,(174+$x)/$z,(289+$y)/$z,(168+$x)/$z,(299+$y)/$z,(163+$x)/$z,(302+$y)/$z,(159+$x)/$z,(318+$y)/$z,(147+$x)/$z,(314+$y)/$z,(141+$x)/$z,(310+$y)/$z,(136+$x)/$z,(304+$y)/$z,(136+$x)/$z,(295+$y)/$z,(133+$x)/$z,(290+$y)/$z,(125+$x)/$z,(271+$y)/$z,(120+$x)/$z,(254+$y)/$z,(113+$x)/$z,(250+$y)/$z,(106+$x)/$z,(250+$y)/$z,(100+$x)/$z,(248+$y)/$z,(98+$x)/$z,(244+$y)/$z),'FD');
			//elbayed
			$this->color($data['32']);$this->Polygon(array((236+$x)/$z,(170+$y)/$z,(240+$x)/$z,(169+$y)/$z,(242+$x)/$z,(165+$y)/$z,(243+$x)/$z,(160+$y)/$z,(244+$x)/$z,(153+$y)/$z,(243+$x)/$z,(148+$y)/$z,(245+$x)/$z,(145+$y)/$z,(245+$x)/$z,(139+$y)/$z,(246+$x)/$z,(131+$y)/$z,(249+$x)/$z,(127+$y)/$z,(249+$x)/$z,(124+$y)/$z,(247+$x)/$z,(122+$y)/$z,(250+$x)/$z,(122+$y)/$z,(247+$x)/$z,(118+$y)/$z,(247+$x)/$z,(115+$y)/$z,(245+$x)/$z,(113+$y)/$z,(244+$x)/$z,(108+$y)/$z,(246+$x)/$z,(106+$y)/$z,(246+$x)/$z,(101+$y)/$z,(251+$x)/$z,(104+$y)/$z,(256+$x)/$z,(102+$y)/$z,(260+$x)/$z,(104+$y)/$z,(262+$x)/$z,(101+$y)/$z,(268+$x)/$z,(101+$y)/$z,(272+$x)/$z,(103+$y)/$z,(272+$x)/$z,(107+$y)/$z,(277+$x)/$z,(107+$y)/$z,(280+$x)/$z,(112+$y)/$z,(285+$x)/$z,(118+$y)/$z,(289+$x)/$z,(118+$y)/$z,(292+$x)/$z,(123+$y)/$z,(294+$x)/$z,(128+$y)/$z,(294+$x)/$z,(132+$y)/$z,(298+$x)/$z,(132+$y)/$z,(299+$x)/$z,(136+$y)/$z,(304+$x)/$z,(136+$y)/$z,(304+$x)/$z,(139+$y)/$z,(299+$x)/$z,(140+$y)/$z,(303+$x)/$z,(151+$y)/$z,(303+$x)/$z,(162+$y)/$z,(306+$x)/$z,(164+$y)/$z,(306+$x)/$z,(169+$y)/$z,(303+$x)/$z,(170+$y)/$z,(304+$x)/$z,(179+$y)/$z,(298+$x)/$z,(187+$y)/$z,(295+$x)/$z,(187+$y)/$z,(292+$x)/$z,(190+$y)/$z,(286+$x)/$z,(194+$y)/$z,(282+$x)/$z,(197+$y)/$z,(277+$x)/$z,(198+$y)/$z,(274+$x)/$z,(203+$y)/$z,(269+$x)/$z,(204+$y)/$z,(265+$x)/$z,(209+$y)/$z,(261+$x)/$z,(210+$y)/$z,(255+$x)/$z,(214+$y)/$z,(249+$x)/$z,(210+$y)/$z,(245+$x)/$z,(210+$y)/$z,(244+$x)/$z,(206+$y)/$z,(238+$x)/$z,(202+$y)/$z,(238+$x)/$z,(197+$y)/$z,(235+$x)/$z,(193+$y)/$z,(236+$x)/$z,(170+$y)/$z),'FD');
			//naama
			$this->color($data['45']);$this->Polygon(array((217+$x)/$z,(163+$y)/$z,(218+$x)/$z,(160+$y)/$z,(218+$x)/$z,(157+$y)/$z,(215+$x)/$z,(155+$y)/$z,(211+$x)/$z,(153+$y)/$z,(209+$x)/$z,(149+$y)/$z,(206+$x)/$z,(146+$y)/$z,(208+$x)/$z,(143+$y)/$z,(207+$x)/$z,(140+$y)/$z,(203+$x)/$z,(137+$y)/$z,(203+$x)/$z,(131+$y)/$z,(204+$x)/$z,(128+$y)/$z,(204+$x)/$z,(124+$y)/$z,(202+$x)/$z,(122+$y)/$z,(202+$x)/$z,(113+$y)/$z,(204+$x)/$z,(109+$y)/$z,(209+$x)/$z,(106+$y)/$z,(218+$x)/$z,(105+$y)/$z,(223+$x)/$z,(106+$y)/$z,(227+$x)/$z,(106+$y)/$z,(230+$x)/$z,(104+$y)/$z,(234+$x)/$z,(106+$y)/$z,(236+$x)/$z,(115+$y)/$z,(244+$x)/$z,(108+$y)/$z,(244+$x)/$z,(113+$y)/$z,(247+$x)/$z,(115+$y)/$z,(247+$x)/$z,(118+$y)/$z,(250+$x)/$z,(120+$y)/$z,(247+$x)/$z,(122+$y)/$z,(249+$x)/$z,(124+$y)/$z,(249+$x)/$z,(127+$y)/$z,(246+$x)/$z,(131+$y)/$z,(245+$x)/$z,(139+$y)/$z,(245+$x)/$z,(145+$y)/$z,(243+$x)/$z,(148+$y)/$z,(244+$x)/$z,(153+$y)/$z,(243+$x)/$z,(160+$y)/$z,(241+$x)/$z,(165+$y)/$z,(240+$x)/$z,(169+$y)/$z,(236+$x)/$z,(169+$y)/$z,(226+$x)/$z,(167+$y)/$z,(218+$x)/$z,(169+$y)/$z,(217+$x)/$z,(163+$y)/$z),'FD');
			//laghouat
			$this->color($data['3']);$this->Polygon(array((280+$x)/$z,(112+$y)/$z,(282+$x)/$z,(111+$y)/$z,(283+$x)/$z,(107+$y)/$z,(288+$x)/$z,(107+$y)/$z,(290+$x)/$z,(104+$y)/$z,(291+$x)/$z,(100+$y)/$z,(296+$x)/$z,(99+$y)/$z,(301+$x)/$z,(95+$y)/$z,(304+$x)/$z,(93+$y)/$z,(307+$x)/$z,(103+$y)/$z,(310+$x)/$z,(106+$y)/$z,(312+$x)/$z,(110+$y)/$z,(316+$x)/$z,(111+$y)/$z,(318+$x)/$z,(108+$y)/$z,(320+$x)/$z,(105+$y)/$z,(323+$x)/$z,(107+$y)/$z,(326+$x)/$z,(119+$y)/$z,(331+$x)/$z,(120+$y)/$z,(335+$x)/$z,(123+$y)/$z,(338+$x)/$z,(124+$y)/$z,(341+$x)/$z,(128+$y)/$z,(345+$x)/$z,(130+$y)/$z,(349+$x)/$z,(131+$y)/$z,(353+$x)/$z,(133+$y)/$z,(358+$x)/$z,(138+$y)/$z,(361+$x)/$z,(143+$y)/$z,(347+$x)/$z,(144+$y)/$z,(343+$x)/$z,(144+$y)/$z,(340+$x)/$z,(142+$y)/$z,(338+$x)/$z,(144+$y)/$z,(327+$x)/$z,(145+$y)/$z,(332+$x)/$z,(147+$y)/$z,(331+$x)/$z,(150+$y)/$z,(323+$x)/$z,(148+$y)/$z,(315+$x)/$z,(150+$y)/$z,(303+$x)/$z,(151+$y)/$z,(299+$x)/$z,(140+$y)/$z,(304+$x)/$z,(139+$y)/$z,(304+$x)/$z,(136+$y)/$z,(299+$x)/$z,(136+$y)/$z,(298+$x)/$z,(132+$y)/$z,(294+$x)/$z,(132+$y)/$z,(294+$x)/$z,(128+$y)/$z,(292+$x)/$z,(123+$y)/$z,(289+$x)/$z,(118+$y)/$z,(285+$x)/$z,(118+$y)/$z,(280+$x)/$z,(112+$y)/$z,(280+$x)/$z,(112+$y)/$z),'FD');
			//tiaret
			$this->color($data['14']);$this->Polygon(array((304+$x)/$z,(93+$y)/$z,(306+$x)/$z,(90+$y)/$z,(308+$x)/$z,(86+$y)/$z,(310+$x)/$z,(82+$y)/$z,(313+$x)/$z,(80+$y)/$z,(314+$x)/$z,(76+$y)/$z,(311+$x)/$z,(74+$y)/$z,(307+$x)/$z,(74+$y)/$z,(303+$x)/$z,(73+$y)/$z,(299+$x)/$z,(71+$y)/$z,(298+$x)/$z,(68+$y)/$z,(295+$x)/$z,(66+$y)/$z,(290+$x)/$z,(66+$y)/$z,(285+$x)/$z,(65+$y)/$z,(281+$x)/$z,(63+$y)/$z,(278+$x)/$z,(63+$y)/$z,(273+$x)/$z,(65+$y)/$z,(270+$x)/$z,(66+$y)/$z,(268+$x)/$z,(71+$y)/$z,(267+$x)/$z,(73+$y)/$z,(262+$x)/$z,(74+$y)/$z,(260+$x)/$z,(79+$y)/$z,(263+$x)/$z,(81+$y)/$z,(266+$x)/$z,(83+$y)/$z,(265+$x)/$z,(87+$y)/$z,(263+$x)/$z,(90+$y)/$z,(265+$x)/$z,(94+$y)/$z,(268+$x)/$z,(98+$y)/$z,(268+$x)/$z,(101+$y)/$z,(272+$x)/$z,(103+$y)/$z,(272+$x)/$z,(107+$y)/$z,(277+$x)/$z,(107+$y)/$z,(280+$x)/$z,(112+$y)/$z,(282+$x)/$z,(111+$y)/$z,(283+$x)/$z,(107+$y)/$z,(288+$x)/$z,(107+$y)/$z,(290+$x)/$z,(104+$y)/$z,(291+$x)/$z,(100+$y)/$z,(296+$x)/$z,(99+$y)/$z,(301+$x)/$z,(95+$y)/$z,(304+$x)/$z,(93+$y)/$z),'FD');
			//eloued
			$this->color($data['39']);$this->Polygon(array((380+$x)/$z,(132+$y)/$z,(380+$x)/$z,(126+$y)/$z,(380+$x)/$z,(121+$y)/$z,(379+$x)/$z,(117+$y)/$z,(380+$x)/$z,(113+$y)/$z,(382+$x)/$z,(109+$y)/$z,(380+$x)/$z,(105+$y)/$z,(378+$x)/$z,(102+$y)/$z,(379+$x)/$z,(99+$y)/$z,(383+$x)/$z,(98+$y)/$z,(396+$x)/$z,(100+$y)/$z,(402+$x)/$z,(99+$y)/$z,(409+$x)/$z,(100+$y)/$z,(413+$x)/$z,(103+$y)/$z,(418+$x)/$z,(104+$y)/$z,(424+$x)/$z,(106+$y)/$z,(425+$x)/$z,(102+$y)/$z,(430+$x)/$z,(100+$y)/$z,(434+$x)/$z,(101+$y)/$z,(440+$x)/$z,(103+$y)/$z,(444+$x)/$z,(104+$y)/$z,(439+$x)/$z,(106+$y)/$z,(438+$x)/$z,(112+$y)/$z,(439+$x)/$z,(120+$y)/$z,(442+$x)/$z,(122+$y)/$z,(444+$x)/$z,(128+$y)/$z,(446+$x)/$z,(133+$y)/$z,(447+$x)/$z,(136+$y)/$z,(451+$x)/$z,(136+$y)/$z,(455+$x)/$z,(139+$y)/$z,(456+$x)/$z,(143+$y)/$z,(459+$x)/$z,(144+$y)/$z,(461+$x)/$z,(154+$y)/$z,(466+$x)/$z,(158+$y)/$z,(471+$x)/$z,(161+$y)/$z,(476+$x)/$z,(163+$y)/$z,(479+$x)/$z,(167+$y)/$z,(431+$x)/$z,(171+$y)/$z,(426+$x)/$z,(162+$y)/$z,(422+$x)/$z,(160+$y)/$z,(420+$x)/$z,(154+$y)/$z,(417+$x)/$z,(149+$y)/$z,(409+$x)/$z,(129+$y)/$z,(407+$x)/$z,(122+$y)/$z,(405+$x)/$z,(113+$y)/$z,(402+$x)/$z,(115+$y)/$z,(400+$x)/$z,(116+$y)/$z,(399+$x)/$z,(119+$y)/$z,(402+$x)/$z,(122+$y)/$z,(400+$x)/$z,(125+$y)/$z,(401+$x)/$z,(131+$y)/$z,(380+$x)/$z,(132+$y)/$z),'FD');
			//djelfa
			$this->color($data['17']);$this->Polygon(array((298+$x)/$z,(68+$y)/$z,(300+$x)/$z,(66+$y)/$z,(302+$x)/$z,(67+$y)/$z,(304+$x)/$z,(69+$y)/$z,(307+$x)/$z,(69+$y)/$z,(309+$x)/$z,(67+$y)/$z,(311+$x)/$z,(70+$y)/$z,(313+$x)/$z,(70+$y)/$z,(315+$x)/$z,(67+$y)/$z,(318+$x)/$z,(65+$y)/$z,(318+$x)/$z,(58+$y)/$z,(322+$x)/$z,(58+$y)/$z,(323+$x)/$z,(63+$y)/$z,(326+$x)/$z,(63+$y)/$z,(329+$x)/$z,(59+$y)/$z,(332+$x)/$z,(61+$y)/$z,(334+$x)/$z,(64+$y)/$z,(337+$x)/$z,(65+$y)/$z,(339+$x)/$z,(68+$y)/$z,(339+$x)/$z,(71+$y)/$z,(337+$x)/$z,(74+$y)/$z,(334+$x)/$z,(76+$y)/$z,(333+$x)/$z,(79+$y)/$z,(336+$x)/$z,(81+$y)/$z,(336+$x)/$z,(87+$y)/$z,(340+$x)/$z,(89+$y)/$z,(343+$x)/$z,(90+$y)/$z,(344+$x)/$z,(94+$y)/$z,(346+$x)/$z,(98+$y)/$z,(347+$x)/$z,(102+$y)/$z,(350+$x)/$z,(105+$y)/$z,(353+$x)/$z,(108+$y)/$z,(356+$x)/$z,(111+$y)/$z,(355+$x)/$z,(115+$y)/$z,(358+$x)/$z,(118+$y)/$z,(362+$x)/$z,(120+$y)/$z,(365+$x)/$z,(121+$y)/$z,(369+$x)/$z,(122+$y)/$z,(372+$x)/$z,(123+$y)/$z,(374+$x)/$z,(125+$y)/$z,(374+$x)/$z,(130+$y)/$z,(373+$x)/$z,(132+$y)/$z,(372+$x)/$z,(137+$y)/$z,(374+$x)/$z,(146+$y)/$z,(360+$x)/$z,(143+$y)/$z,(357+$x)/$z,(138+$y)/$z,(353+$x)/$z,(133+$y)/$z,(349+$x)/$z,(131+$y)/$z,(345+$x)/$z,(130+$y)/$z,(340+$x)/$z,(128+$y)/$z,(338+$x)/$z,(124+$y)/$z,(335+$x)/$z,(123+$y)/$z,(331+$x)/$z,(121+$y)/$z,(326+$x)/$z,(119+$y)/$z,(323+$x)/$z,(107+$y)/$z,(320+$x)/$z,(105+$y)/$z,(318+$x)/$z,(108+$y)/$z,(316+$x)/$z,(111+$y)/$z,(312+$x)/$z,(110+$y)/$z,(310+$x)/$z,(106+$y)/$z,(307+$x)/$z,(103+$y)/$z,(304+$x)/$z,(93+$y)/$z,(306+$x)/$z,(90+$y)/$z,(308+$x)/$z,(86+$y)/$z,(310+$x)/$z,(82+$y)/$z,(313+$x)/$z,(80+$y)/$z,(314+$x)/$z,(76+$y)/$z,(311+$x)/$z,(74+$y)/$z,(307+$x)/$z,(74+$y)/$z,(303+$x)/$z,(73+$y)/$z,(298+$x)/$z,(68+$y)/$z),'FD');
			//biskra
			$this->color($data['7']);$this->Polygon(array((353+$x)/$z,(108+$y)/$z,(356+$x)/$z,(105+$y)/$z,(353+$x)/$z,(102+$y)/$z,(352+$x)/$z,(98+$y)/$z,(354+$x)/$z,(95+$y)/$z,(357+$x)/$z,(93+$y)/$z,(360+$x)/$z,(93+$y)/$z,(363+$x)/$z,(91+$y)/$z,(365+$x)/$z,(88+$y)/$z,(368+$x)/$z,(87+$y)/$z,(371+$x)/$z,(87+$y)/$z,(374+$x)/$z,(80+$y)/$z,(380+$x)/$z,(81+$y)/$z,(386+$x)/$z,(81+$y)/$z,(386+$x)/$z,(77+$y)/$z,(390+$x)/$z,(73+$y)/$z,(396+$x)/$z,(74+$y)/$z,(396+$x)/$z,(81+$y)/$z,(403+$x)/$z,(81+$y)/$z,(410+$x)/$z,(81+$y)/$z,(409+$x)/$z,(87+$y)/$z,(415+$x)/$z,(86+$y)/$z,(418+$x)/$z,(94+$y)/$z,(415+$x)/$z,(99+$y)/$z,(413+$x)/$z,(103+$y)/$z,(409+$x)/$z,(100+$y)/$z,(402+$x)/$z,(99+$y)/$z,(396+$x)/$z,(100+$y)/$z,(383+$x)/$z,(98+$y)/$z,(379+$x)/$z,(99+$y)/$z,(378+$x)/$z,(102+$y)/$z,(380+$x)/$z,(105+$y)/$z,(382+$x)/$z,(109+$y)/$z,(380+$x)/$z,(113+$y)/$z,(379+$x)/$z,(117+$y)/$z,(380+$x)/$z,(121+$y)/$z,(380+$x)/$z,(126+$y)/$z,(380+$x)/$z,(132+$y)/$z,(372+$x)/$z,(137+$y)/$z,(373+$x)/$z,(132+$y)/$z,(374+$x)/$z,(130+$y)/$z,(374+$x)/$z,(125+$y)/$z,(372+$x)/$z,(123+$y)/$z,(369+$x)/$z,(122+$y)/$z,(365+$x)/$z,(121+$y)/$z,(362+$x)/$z,(120+$y)/$z,(358+$x)/$z,(118+$y)/$z,(355+$x)/$z,(115+$y)/$z,(356+$x)/$z,(111+$y)/$z,(353+$x)/$z,(108+$y)/$z),'FD');
			//msila
			$this->color($data['28']);$this->Polygon(array((338+$x)/$z,(56+$y)/$z,(341+$x)/$z,(56+$y)/$z,(344+$x)/$z,(56+$y)/$z,(347+$x)/$z,(55+$y)/$z,(349+$x)/$z,(52+$y)/$z,(352+$x)/$z,(52+$y)/$z,(355+$x)/$z,(52+$y)/$z,(358+$x)/$z,(51+$y)/$z,(358+$x)/$z,(53+$y)/$z,(357+$x)/$z,(56+$y)/$z,(359+$x)/$z,(56+$y)/$z,(361+$x)/$z,(56+$y)/$z,(364+$x)/$z,(56+$y)/$z,(366+$x)/$z,(56+$y)/$z,(370+$x)/$z,(57+$y)/$z,(372+$x)/$z,(58+$y)/$z,(374+$x)/$z,(60+$y)/$z,(376+$x)/$z,(63+$y)/$z,(379+$x)/$z,(64+$y)/$z,(375+$x)/$z,(66+$y)/$z,(369+$x)/$z,(66+$y)/$z,(369+$x)/$z,(72+$y)/$z,(367+$x)/$z,(75+$y)/$z,(367+$x)/$z,(79+$y)/$z,(373+$x)/$z,(80+$y)/$z,(371+$x)/$z,(87+$y)/$z,(368+$x)/$z,(87+$y)/$z,(365+$x)/$z,(88+$y)/$z,(363+$x)/$z,(91+$y)/$z,(360+$x)/$z,(93+$y)/$z,(357+$x)/$z,(93+$y)/$z,(354+$x)/$z,(95+$y)/$z,(352+$x)/$z,(98+$y)/$z,(353+$x)/$z,(102+$y)/$z,(355+$x)/$z,(105+$y)/$z,(353+$x)/$z,(108+$y)/$z,(350+$x)/$z,(105+$y)/$z,(347+$x)/$z,(102+$y)/$z,(346+$x)/$z,(98+$y)/$z,(344+$x)/$z,(94+$y)/$z,(343+$x)/$z,(90+$y)/$z,(340+$x)/$z,(89+$y)/$z,(336+$x)/$z,(87+$y)/$z,(336+$x)/$z,(81+$y)/$z,(333+$x)/$z,(79+$y)/$z,(334+$x)/$z,(76+$y)/$z,(337+$x)/$z,(74+$y)/$z,(339+$x)/$z,(71+$y)/$z,(339+$x)/$z,(68+$y)/$z,(337+$x)/$z,(65+$y)/$z,(334+$x)/$z,(64+$y)/$z,(332+$x)/$z,(61+$y)/$z,(338+$x)/$z,(56+$y)/$z),'FD');
			//batna
			$this->color($data['5']);$this->Polygon(array((379+$x)/$z,(64+$y)/$z,(382+$x)/$z,(63+$y)/$z,(382+$x)/$z,(59+$y)/$z,(388+$x)/$z,(58+$y)/$z,(390+$x)/$z,(54+$y)/$z,(395+$x)/$z,(56+$y)/$z,(400+$x)/$z,(55+$y)/$z,(404+$x)/$z,(56+$y)/$z,(407+$x)/$z,(56+$y)/$z,(410+$x)/$z,(57+$y)/$z,(413+$x)/$z,(57+$y)/$z,(416+$x)/$z,(60+$y)/$z,(416+$x)/$z,(63+$y)/$z,(413+$x)/$z,(65+$y)/$z,(412+$x)/$z,(71+$y)/$z,(412+$x)/$z,(75+$y)/$z,(411+$x)/$z,(78+$y)/$z,(409+$x)/$z,(81+$y)/$z,(403+$x)/$z,(81+$y)/$z,(396+$x)/$z,(81+$y)/$z,(396+$x)/$z,(74+$y)/$z,(389+$x)/$z,(73+$y)/$z,(386+$x)/$z,(77+$y)/$z,(386+$x)/$z,(81+$y)/$z,(380+$x)/$z,(81+$y)/$z,(373+$x)/$z,(80+$y)/$z,(367+$x)/$z,(79+$y)/$z,(367+$x)/$z,(75+$y)/$z,(369+$x)/$z,(72+$y)/$z,(369+$x)/$z,(66+$y)/$z,(375+$x)/$z,(66+$y)/$z,(379+$x)/$z,(64+$y)/$z),'FD');
			//khanchela
			$this->color($data['40']);$this->Polygon(array((416+$x)/$z,(63+$y)/$z,(419+$x)/$z,(62+$y)/$z,(423+$x)/$z,(63+$y)/$z,(426+$x)/$z,(62+$y)/$z,(429+$x)/$z,(62+$y)/$z,(432+$x)/$z,(63+$y)/$z,(435+$x)/$z,(65+$y)/$z,(433+$x)/$z,(68+$y)/$z,(433+$x)/$z,(76+$y)/$z,(430+$x)/$z,(79+$y)/$z,(431+$x)/$z,(83+$y)/$z,(434+$x)/$z,(87+$y)/$z,(431+$x)/$z,(92+$y)/$z,(430+$x)/$z,(100+$y)/$z,(425+$x)/$z,(102+$y)/$z,(423+$x)/$z,(106+$y)/$z,(418+$x)/$z,(104+$y)/$z,(413+$x)/$z,(103+$y)/$z,(415+$x)/$z,(99+$y)/$z,(417+$x)/$z,(94+$y)/$z,(415+$x)/$z,(86+$y)/$z,(409+$x)/$z,(87+$y)/$z,(409+$x)/$z,(81+$y)/$z,(411+$x)/$z,(78+$y)/$z,(413+$x)/$z,(75+$y)/$z,(412+$x)/$z,(71+$y)/$z,(413+$x)/$z,(65+$y)/$z,(416+$x)/$z,(63+$y)/$z),'FD');
			//tebessa
			$this->color($data['12']);$this->Polygon(array((435+$x)/$z,(65+$y)/$z,(438+$x)/$z,(64+$y)/$z,(442+$x)/$z,(62+$y)/$z,(443+$x)/$z,(56+$y)/$z,(442+$x)/$z,(52+$y)/$z,(446+$x)/$z,(50+$y)/$z,(450+$x)/$z,(48+$y)/$z,(453+$x)/$z,(48+$y)/$z,(454+$x)/$z,(56+$y)/$z,(456+$x)/$z,(59+$y)/$z,(456+$x)/$z,(63+$y)/$z,(454+$x)/$z,(66+$y)/$z,(455+$x)/$z,(70+$y)/$z,(459+$x)/$z,(72+$y)/$z,(456+$x)/$z,(75+$y)/$z,(456+$x)/$z,(79+$y)/$z,(454+$x)/$z,(82+$y)/$z,(455+$x)/$z,(86+$y)/$z,(454+$x)/$z,(90+$y)/$z,(452+$x)/$z,(95+$y)/$z,(446+$x)/$z,(97+$y)/$z,(443+$x)/$z,(104+$y)/$z,(440+$x)/$z,(103+$y)/$z,(434+$x)/$z,(101+$y)/$z,(430+$x)/$z,(100+$y)/$z,(431+$x)/$z,(92+$y)/$z,(433+$x)/$z,(87+$y)/$z,(432+$x)/$z,(83+$y)/$z,(430+$x)/$z,(79+$y)/$z,(433+$x)/$z,(76+$y)/$z,(433+$x)/$z,(68+$y)/$z,(435+$x)/$z,(65+$y)/$z),'FD');
			//saida
			$this->color($data['20']);$this->Polygon(array((246+$x)/$z,(101+$y)/$z,(243+$x)/$z,(97+$y)/$z,(240+$x)/$z,(96+$y)/$z,(243+$x)/$z,(94+$y)/$z,(242+$x)/$z,(90+$y)/$z,(238+$x)/$z,(89+$y)/$z,(238+$x)/$z,(84+$y)/$z,(241+$x)/$z,(81+$y)/$z,(245+$x)/$z,(80+$y)/$z,(249+$x)/$z,(80+$y)/$z,(251+$x)/$z,(82+$y)/$z,(254+$x)/$z,(82+$y)/$z,(257+$x)/$z,(81+$y)/$z,(260+$x)/$z,(79+$y)/$z,(263+$x)/$z,(81+$y)/$z,(266+$x)/$z,(83+$y)/$z,(265+$x)/$z,(87+$y)/$z,(263+$x)/$z,(90+$y)/$z,(265+$x)/$z,(94+$y)/$z,(268+$x)/$z,(98+$y)/$z,(268+$x)/$z,(101+$y)/$z,(262+$x)/$z,(101+$y)/$z,(259+$x)/$z,(104+$y)/$z,(256+$x)/$z,(102+$y)/$z,(252+$x)/$z,(104+$y)/$z,(246+$x)/$z,(101+$y)/$z),'FD');
			//sidi belabas
			$this->color($data['22']);$this->Polygon(array((218+$x)/$z,(105+$y)/$z,(220+$x)/$z,(102+$y)/$z,(223+$x)/$z,(97+$y)/$z,(225+$x)/$z,(95+$y)/$z,(226+$x)/$z,(90+$y)/$z,(223+$x)/$z,(88+$y)/$z,(221+$x)/$z,(84+$y)/$z,(221+$x)/$z,(80+$y)/$z,(223+$x)/$z,(76+$y)/$z,(226+$x)/$z,(73+$y)/$z,(232+$x)/$z,(71+$y)/$z,(235+$x)/$z,(72+$y)/$z,(241+$x)/$z,(72+$y)/$z,(241+$x)/$z,(81+$y)/$z,(238+$x)/$z,(84+$y)/$z,(238+$x)/$z,(89+$y)/$z,(242+$x)/$z,(90+$y)/$z,(243+$x)/$z,(94+$y)/$z,(240+$x)/$z,(96+$y)/$z,(243+$x)/$z,(97+$y)/$z,(246+$x)/$z,(101+$y)/$z,(246+$x)/$z,(106+$y)/$z,(244+$x)/$z,(108+$y)/$z,(244+$x)/$z,(113+$y)/$z,(236+$x)/$z,(115+$y)/$z,(234+$x)/$z,(106+$y)/$z,(230+$x)/$z,(104+$y)/$z,(227+$x)/$z,(106+$y)/$z,(223+$x)/$z,(106+$y)/$z,(218+$x)/$z,(105+$y)/$z),'FD');
			//tlemcen
			$this->color($data['13']);$this->Polygon(array((204+$x)/$z,(109+$y)/$z,(202+$x)/$z,(104+$y)/$z,(200+$x)/$z,(101+$y)/$z,(202+$x)/$z,(98+$y)/$z,(199+$x)/$z,(94+$y)/$z,(201+$x)/$z,(90+$y)/$z,(197+$x)/$z,(88+$y)/$z,(195+$x)/$z,(85+$y)/$z,(191+$x)/$z,(81+$y)/$z,(199+$x)/$z,(80+$y)/$z,(202+$x)/$z,(79+$y)/$z,(203+$x)/$z,(75+$y)/$z,(207+$x)/$z,(75+$y)/$z,(211+$x)/$z,(77+$y)/$z,(216+$x)/$z,(77+$y)/$z,(221+$x)/$z,(80+$y)/$z,(221+$x)/$z,(84+$y)/$z,(223+$x)/$z,(88+$y)/$z,(226+$x)/$z,(90+$y)/$z,(225+$x)/$z,(95+$y)/$z,(223+$x)/$z,(97+$y)/$z,(220+$x)/$z,(102+$y)/$z,(218+$x)/$z,(105+$y)/$z,(209+$x)/$z,(106+$y)/$z,(204+$x)/$z,(109+$y)/$z),'FD');
			//aintimouchent
			$this->color($data['46']);$this->Polygon(array((232+$x)/$z,(71+$y)/$z,(232+$x)/$z,(68+$y)/$z,(229+$x)/$z,(66+$y)/$z,(225+$x)/$z,(65+$y)/$z,(222+$x)/$z,(67+$y)/$z,(220+$x)/$z,(64+$y)/$z,(217+$x)/$z,(65+$y)/$z,(214+$x)/$z,(68+$y)/$z,(214+$x)/$z,(71+$y)/$z,(211+$x)/$z,(74+$y)/$z,(207+$x)/$z,(73+$y)/$z,(203+$x)/$z,(75+$y)/$z,(207+$x)/$z,(75+$y)/$z,(211+$x)/$z,(77+$y)/$z,(216+$x)/$z,(77+$y)/$z,(221+$x)/$z,(80+$y)/$z,(223+$x)/$z,(76+$y)/$z,(226+$x)/$z,(73+$y)/$z,(232+$x)/$z,(71+$y)/$z),'FD');
			//maascare
			$this->color($data['29']);$this->Polygon(array((232+$x)/$z,(68+$y)/$z,(235+$x)/$z,(66+$y)/$z,(237+$x)/$z,(64+$y)/$z,(240+$x)/$z,(62+$y)/$z,(241+$x)/$z,(61+$y)/$z,(246+$x)/$z,(60+$y)/$z,(249+$x)/$z,(62+$y)/$z,(252+$x)/$z,(63+$y)/$z,(254+$x)/$z,(65+$y)/$z,(257+$x)/$z,(66+$y)/$z,(260+$x)/$z,(67+$y)/$z,(263+$x)/$z,(68+$y)/$z,(266+$x)/$z,(69+$y)/$z,(268+$x)/$z,(70+$y)/$z,(267+$x)/$z,(73+$y)/$z,(262+$x)/$z,(74+$y)/$z,(260+$x)/$z,(79+$y)/$z,(257+$x)/$z,(81+$y)/$z,(254+$x)/$z,(82+$y)/$z,(251+$x)/$z,(82+$y)/$z,(249+$x)/$z,(80+$y)/$z,(245+$x)/$z,(80+$y)/$z,(241+$x)/$z,(81+$y)/$z,(241+$x)/$z,(72+$y)/$z,(235+$x)/$z,(72+$y)/$z,(232+$x)/$z,(71+$y)/$z,(232+$x)/$z,(68+$y)/$z),'FD');
			//oran
			$this->color($data['31']);$this->Polygon(array((220+$x)/$z,(64+$y)/$z,(223+$x)/$z,(62+$y)/$z,(226+$x)/$z,(60+$y)/$z,(229+$x)/$z,(61+$y)/$z,(232+$x)/$z,(60+$y)/$z,(234+$x)/$z,(58+$y)/$z,(236+$x)/$z,(56+$y)/$z,(239+$x)/$z,(57+$y)/$z,(242+$x)/$z,(58+$y)/$z,(246+$x)/$z,(60+$y)/$z,(243+$x)/$z,(61+$y)/$z,(240+$x)/$z,(60+$y)/$z,(237+$x)/$z,(64+$y)/$z,(235+$x)/$z,(66+$y)/$z,(232+$x)/$z,(68+$y)/$z,(229+$x)/$z,(66+$y)/$z,(225+$x)/$z,(65+$y)/$z,(222+$x)/$z,(67+$y)/$z,(220+$x)/$z,(64+$y)/$z),'FD');
			//ghelizane
			$this->color($data['48']);$this->Polygon(array((252+$x)/$z,(63+$y)/$z,(252+$x)/$z,(60+$y)/$z,(254+$x)/$z,(58+$y)/$z,(257+$x)/$z,(57+$y)/$z,(258+$x)/$z,(54+$y)/$z,(261+$x)/$z,(52+$y)/$z,(261+$x)/$z,(49+$y)/$z,(263+$x)/$z,(47+$y)/$z,(266+$x)/$z,(46+$y)/$z,(269+$x)/$z,(48+$y)/$z,(271+$x)/$z,(52+$y)/$z,(275+$x)/$z,(54+$y)/$z,(278+$x)/$z,(54+$y)/$z,(281+$x)/$z,(55+$y)/$z,(280+$x)/$z,(59+$y)/$z,(281+$x)/$z,(63+$y)/$z,(278+$x)/$z,(63+$y)/$z,(273+$x)/$z,(65+$y)/$z,(270+$x)/$z,(66+$y)/$z,(268+$x)/$z,(70+$y)/$z,(266+$x)/$z,(69+$y)/$z,(263+$x)/$z,(68+$y)/$z,(260+$x)/$z,(67+$y)/$z,(257+$x)/$z,(66+$y)/$z,(254+$x)/$z,(65+$y)/$z,(252+$x)/$z,(63+$y)/$z),'FD');
			//mostaghanem
			$this->color($data['27']);$this->Polygon(array((242+$x)/$z,(58+$y)/$z,(245+$x)/$z,(57+$y)/$z,(248+$x)/$z,(55+$y)/$z,(249+$x)/$z,(51+$y)/$z,(252+$x)/$z,(48+$y)/$z,(256+$x)/$z,(47+$y)/$z,(259+$x)/$z,(45+$y)/$z,(261+$x)/$z,(42+$y)/$z,(265+$x)/$z,(42+$y)/$z,(266+$x)/$z,(46+$y)/$z,(263+$x)/$z,(47+$y)/$z,(261+$x)/$z,(49+$y)/$z,(261+$x)/$z,(52+$y)/$z,(258+$x)/$z,(54+$y)/$z,(257+$x)/$z,(57+$y)/$z,(254+$x)/$z,(58+$y)/$z,(252+$x)/$z,(60+$y)/$z,(252+$x)/$z,(63+$y)/$z,(249+$x)/$z,(62+$y)/$z,(246+$x)/$z,(60+$y)/$z,(242+$x)/$z,(58+$y)/$z),'FD');
			//chelef
			$this->color($data['2']);$this->Polygon(array((265+$x)/$z,(42+$y)/$z,(268+$x)/$z,(40+$y)/$z,(271+$x)/$z,(38+$y)/$z,(274+$x)/$z,(37+$y)/$z,(278+$x)/$z,(37+$y)/$z,(281+$x)/$z,(36+$y)/$z,(285+$x)/$z,(37+$y)/$z,(287+$x)/$z,(39+$y)/$z,(284+$x)/$z,(41+$y)/$z,(285+$x)/$z,(45+$y)/$z,(287+$x)/$z,(50+$y)/$z,(285+$x)/$z,(53+$y)/$z,(281+$x)/$z,(55+$y)/$z,(278+$x)/$z,(54+$y)/$z,(275+$x)/$z,(54+$y)/$z,(271+$x)/$z,(52+$y)/$z,(269+$x)/$z,(48+$y)/$z,(266+$x)/$z,(46+$y)/$z,(265+$x)/$z,(42+$y)/$z),'FD');
			//tissemsilet 
			$this->color($data['38']);$this->Polygon(array((287+$x)/$z,(50+$y)/$z,(288+$x)/$z,(53+$y)/$z,(290+$x)/$z,(50+$y)/$z,(293+$x)/$z,(56+$y)/$z,(295+$x)/$z,(54+$y)/$z,(298+$x)/$z,(54+$y)/$z,(301+$x)/$z,(55+$y)/$z,(303+$x)/$z,(57+$y)/$z,(302+$x)/$z,(60+$y)/$z,(301+$x)/$z,(63+$y)/$z,(300+$x)/$z,(66+$y)/$z,(298+$x)/$z,(68+$y)/$z,(295+$x)/$z,(66+$y)/$z,(290+$x)/$z,(66+$y)/$z,(285+$x)/$z,(65+$y)/$z,(281+$x)/$z,(63+$y)/$z,(280+$x)/$z,(59+$y)/$z,(281+$x)/$z,(55+$y)/$z,(285+$x)/$z,(53+$y)/$z,(287+$x)/$z,(50+$y)/$z),'FD');
			//aindefla
			$this->color($data['44']);$this->Polygon(array((287+$x)/$z,(39+$y)/$z,(290+$x)/$z,(40+$y)/$z,(293+$x)/$z,(40+$y)/$z,(296+$x)/$z,(40+$y)/$z,(299+$x)/$z,(39+$y)/$z,(302+$x)/$z,(39+$y)/$z,(309+$x)/$z,(39+$y)/$z,(309+$x)/$z,(42+$y)/$z,(309+$x)/$z,(46+$y)/$z,(311+$x)/$z,(49+$y)/$z,(307+$x)/$z,(51+$y)/$z,(307+$x)/$z,(54+$y)/$z,(303+$x)/$z,(57+$y)/$z,(301+$x)/$z,(55+$y)/$z,(298+$x)/$z,(54+$y)/$z,(295+$x)/$z,(54+$y)/$z,(293+$x)/$z,(56+$y)/$z,(290+$x)/$z,(55+$y)/$z,(288+$x)/$z,(53+$y)/$z,(287+$x)/$z,(50+$y)/$z,(285+$x)/$z,(45+$y)/$z,(284+$x)/$z,(41+$y)/$z,(287+$x)/$z,(39+$y)/$z),'FD');
			//tipaza
			$this->color($data['42']);$this->Polygon(array((285+$x)/$z,(37+$y)/$z,(288+$x)/$z,(36+$y)/$z,(290+$x)/$z,(34+$y)/$z,(293+$x)/$z,(34+$y)/$z,(296+$x)/$z,(34+$y)/$z,(299+$x)/$z,(34+$y)/$z,(302+$x)/$z,(33+$y)/$z,(305+$x)/$z,(32+$y)/$z,(309+$x)/$z,(34+$y)/$z,(313+$x)/$z,(33+$y)/$z,(316+$x)/$z,(32+$y)/$z,(314+$x)/$z,(36+$y)/$z,(311+$x)/$z,(38+$y)/$z,(309+$x)/$z,(39+$y)/$z,(302+$x)/$z,(39+$y)/$z,(299+$x)/$z,(39+$y)/$z,(296+$x)/$z,(40+$y)/$z,(293+$x)/$z,(40+$y)/$z,(290+$x)/$z,(40+$y)/$z,(287+$x)/$z,(39+$y)/$z,(285+$x)/$z,(37+$y)/$z),'FD');
			//medea
			$this->color($data['26']);$this->Polygon(array((309+$x)/$z,(42+$y)/$z,(311+$x)/$z,(42+$y)/$z,(314+$x)/$z,(41+$y)/$z,(317+$x)/$z,(41+$y)/$z,(320+$x)/$z,(41+$y)/$z,(323+$x)/$z,(40+$y)/$z,(326+$x)/$z,(38+$y)/$z,(329+$x)/$z,(37+$y)/$z,(331+$x)/$z,(39+$y)/$z,(334+$x)/$z,(40+$y)/$z,(334+$x)/$z,(46+$y)/$z,(332+$x)/$z,(50+$y)/$z,(334+$x)/$z,(52+$y)/$z,(337+$x)/$z,(56+$y)/$z,(332+$x)/$z,(61+$y)/$z,(329+$x)/$z,(59+$y)/$z,(326+$x)/$z,(63+$y)/$z,(323+$x)/$z,(63+$y)/$z,(322+$x)/$z,(58+$y)/$z,(318+$x)/$z,(58+$y)/$z,(318+$x)/$z,(65+$y)/$z,(315+$x)/$z,(67+$y)/$z,(313+$x)/$z,(70+$y)/$z,(311+$x)/$z,(70+$y)/$z,(309+$x)/$z,(67+$y)/$z,(307+$x)/$z,(69+$y)/$z,(304+$x)/$z,(69+$y)/$z,(302+$x)/$z,(67+$y)/$z,(300+$x)/$z,(66+$y)/$z,(301+$x)/$z,(63+$y)/$z,(302+$x)/$z,(60+$y)/$z,(303+$x)/$z,(57+$y)/$z,(307+$x)/$z,(54+$y)/$z,(307+$x)/$z,(51+$y)/$z,(311+$x)/$z,(49+$y)/$z,(309+$x)/$z,(46+$y)/$z,(309+$x)/$z,(42+$y)/$z),'FD');
			//alger
			$this->color($data['16']);$this->Polygon(array((316+$x)/$z,(32+$y)/$z,(319+$x)/$z,(33+$y)/$z,(322+$x)/$z,(34+$y)/$z,(325+$x)/$z,(33+$y)/$z,(328+$x)/$z,(31+$y)/$z,(328+$x)/$z,(28+$y)/$z,(324+$x)/$z,(30+$y)/$z,(322+$x)/$z,(27+$y)/$z,(318+$x)/$z,(27+$y)/$z,(316+$x)/$z,(32+$y)/$z),'FD');
			//blida
			$this->color($data['9']);$this->Polygon(array((325+$x)/$z,(33+$y)/$z,(327+$x)/$z,(35+$y)/$z,(326+$x)/$z,(38+$y)/$z,(323+$x)/$z,(40+$y)/$z,(320+$x)/$z,(41+$y)/$z,(317+$x)/$z,(41+$y)/$z,(314+$x)/$z,(41+$y)/$z,(311+$x)/$z,(42+$y)/$z,(309+$x)/$z,(42+$y)/$z,(309+$x)/$z,(39+$y)/$z,(311+$x)/$z,(38+$y)/$z,(314+$x)/$z,(36+$y)/$z,(313+$x)/$z,(33+$y)/$z,(316+$x)/$z,(32+$y)/$z,(319+$x)/$z,(33+$y)/$z,(322+$x)/$z,(34+$y)/$z,(325+$x)/$z,(33+$y)/$z),'FD');
			//bouira
			$this->color($data['10']);$this->Polygon(array((329+$x)/$z,(37+$y)/$z,(331+$x)/$z,(35+$y)/$z,(334+$x)/$z,(33+$y)/$z,(337+$x)/$z,(33+$y)/$z,(339+$x)/$z,(33+$y)/$z,(341+$x)/$z,(37+$y)/$z,(344+$x)/$z,(39+$y)/$z,(348+$x)/$z,(39+$y)/$z,(355+$x)/$z,(38+$y)/$z,(356+$x)/$z,(44+$y)/$z,(352+$x)/$z,(46+$y)/$z,(349+$x)/$z,(48+$y)/$z,(349+$x)/$z,(52+$y)/$z,(347+$x)/$z,(55+$y)/$z,(344+$x)/$z,(56+$y)/$z,(340+$x)/$z,(56+$y)/$z,(337+$x)/$z,(56+$y)/$z,(334+$x)/$z,(52+$y)/$z,(332+$x)/$z,(50+$y)/$z,(334+$x)/$z,(46+$y)/$z,(334+$x)/$z,(40+$y)/$z,(331+$x)/$z,(39+$y)/$z,(329+$x)/$z,(37+$y)/$z),'FD');
			//boumerdes
			$this->color($data['35']);$this->Polygon(array((328+$x)/$z,(28+$y)/$z,(331+$x)/$z,(29+$y)/$z,(334+$x)/$z,(27+$y)/$z,(337+$x)/$z,(26+$y)/$z,(340+$x)/$z,(27+$y)/$z,(342+$x)/$z,(24+$y)/$z,(346+$x)/$z,(24+$y)/$z,(346+$x)/$z,(27+$y)/$z,(344+$x)/$z,(29+$y)/$z,(342+$x)/$z,(31+$y)/$z,(339+$x)/$z,(33+$y)/$z,(337+$x)/$z,(33+$y)/$z,(334+$x)/$z,(33+$y)/$z,(331+$x)/$z,(35+$y)/$z,(329+$x)/$z,(37+$y)/$z,(326+$x)/$z,(38+$y)/$z,(325+$x)/$z,(33+$y)/$z,(328+$x)/$z,(32+$y)/$z,(328+$x)/$z,(28+$y)/$z),'FD');
			//tiziouzou
			$this->color($data['15']);$this->Polygon(array((346+$x)/$z,(24+$y)/$z,(350+$x)/$z,(24+$y)/$z,(355+$x)/$z,(24+$y)/$z,(362+$x)/$z,(24+$y)/$z,(362+$x)/$z,(28+$y)/$z,(360+$x)/$z,(32+$y)/$z,(357+$x)/$z,(35+$y)/$z,(355+$x)/$z,(38+$y)/$z,(348+$x)/$z,(39+$y)/$z,(344+$x)/$z,(39+$y)/$z,(341+$x)/$z,(37+$y)/$z,(339+$x)/$z,(33+$y)/$z,(342+$x)/$z,(31+$y)/$z,(344+$x)/$z,(29+$y)/$z,(346+$x)/$z,(27+$y)/$z,(346+$x)/$z,(24+$y)/$z),'FD');
			//bejaia
			$this->color($data['6']);$this->Polygon(array((362+$x)/$z,(24+$y)/$z,(365+$x)/$z,(24+$y)/$z,(368+$x)/$z,(25+$y)/$z,(371+$x)/$z,(26+$y)/$z,(373+$x)/$z,(30+$y)/$z,(381+$x)/$z,(31+$y)/$z,(381+$x)/$z,(33+$y)/$z,(380+$x)/$z,(37+$y)/$z,(379+$x)/$z,(40+$y)/$z,(376+$x)/$z,(40+$y)/$z,(375+$x)/$z,(34+$y)/$z,(372+$x)/$z,(34+$y)/$z,(369+$x)/$z,(35+$y)/$z,(366+$x)/$z,(37+$y)/$z,(364+$x)/$z,(40+$y)/$z,(362+$x)/$z,(42+$y)/$z,(359+$x)/$z,(44+$y)/$z,(356+$x)/$z,(44+$y)/$z,(355+$x)/$z,(38+$y)/$z,(357+$x)/$z,(35+$y)/$z,(360+$x)/$z,(32+$y)/$z,(362+$x)/$z,(28+$y)/$z,(362+$x)/$z,(24+$y)/$z),'FD');
			//bordj
			$this->color($data['34']);$this->Polygon(array((364+$x)/$z,(40+$y)/$z,(367+$x)/$z,(41+$y)/$z,(370+$x)/$z,(42+$y)/$z,(373+$x)/$z,(43+$y)/$z,(374+$x)/$z,(46+$y)/$z,(376+$x)/$z,(49+$y)/$z,(374+$x)/$z,(51+$y)/$z,(374+$x)/$z,(54+$y)/$z,(372+$x)/$z,(58+$y)/$z,(370+$x)/$z,(57+$y)/$z,(366+$x)/$z,(56+$y)/$z,(364+$x)/$z,(56+$y)/$z,(361+$x)/$z,(56+$y)/$z,(359+$x)/$z,(56+$y)/$z,(357+$x)/$z,(56+$y)/$z,(358+$x)/$z,(53+$y)/$z,(358+$x)/$z,(51+$y)/$z,(355+$x)/$z,(52+$y)/$z,(352+$x)/$z,(52+$y)/$z,(349+$x)/$z,(52+$y)/$z,(349+$x)/$z,(48+$y)/$z,(352+$x)/$z,(46+$y)/$z,(356+$x)/$z,(44+$y)/$z,(359+$x)/$z,(44+$y)/$z,(362+$x)/$z,(42+$y)/$z,(364+$x)/$z,(40+$y)/$z),'FD');
			//setif
			$this->color($data['9']);$this->Polygon(array((381+$x)/$z,(33+$y)/$z,(384+$x)/$z,(34+$y)/$z,(389+$x)/$z,(34+$y)/$z,(390+$x)/$z,(38+$y)/$z,(393+$x)/$z,(41+$y)/$z,(395+$x)/$z,(44+$y)/$z,(393+$x)/$z,(47+$y)/$z,(396+$x)/$z,(48+$y)/$z,(396+$x)/$z,(53+$y)/$z,(395+$x)/$z,(56+$y)/$z,(390+$x)/$z,(54+$y)/$z,(388+$x)/$z,(58+$y)/$z,(382+$x)/$z,(59+$y)/$z,(382+$x)/$z,(63+$y)/$z,(379+$x)/$z,(64+$y)/$z,(376+$x)/$z,(63+$y)/$z,(374+$x)/$z,(60+$y)/$z,(372+$x)/$z,(58+$y)/$z,(374+$x)/$z,(58+$y)/$z,(374+$x)/$z,(51+$y)/$z,(376+$x)/$z,(49+$y)/$z,(374+$x)/$z,(46+$y)/$z,(373+$x)/$z,(43+$y)/$z,(370+$x)/$z,(42+$y)/$z,(367+$x)/$z,(41+$y)/$z,(364+$x)/$z,(40+$y)/$z,(366+$x)/$z,(37+$y)/$z,(369+$x)/$z,(35+$y)/$z,(372+$x)/$z,(34+$y)/$z,(375+$x)/$z,(34+$y)/$z,(376+$x)/$z,(40+$y)/$z,(379+$x)/$z,(40+$y)/$z,(380+$x)/$z,(37+$y)/$z,(381+$x)/$z,(33+$y)/$z),'FD');
			//mila
			$this->color($data['43']);$this->Polygon(array((389+$x)/$z,(34+$y)/$z,(392+$x)/$z,(33+$y)/$z,(395+$x)/$z,(32+$y)/$z,(400+$x)/$z,(32+$y)/$z,(404+$x)/$z,(32+$y)/$z,(407+$x)/$z,(33+$y)/$z,(405+$x)/$z,(35+$y)/$z,(405+$x)/$z,(39+$y)/$z,(408+$x)/$z,(42+$y)/$z,(409+$x)/$z,(45+$y)/$z,(406+$x)/$z,(47+$y)/$z,(405+$x)/$z,(50+$y)/$z,(402+$x)/$z,(52+$y)/$z,(400+$x)/$z,(55+$y)/$z,(395+$x)/$z,(56+$y)/$z,(396+$x)/$z,(53+$y)/$z,(396+$x)/$z,(48+$y)/$z,(393+$x)/$z,(47+$y)/$z,(395+$x)/$z,(44+$y)/$z,(393+$x)/$z,(41+$y)/$z,(390+$x)/$z,(38+$y)/$z,(389+$x)/$z,(34+$y)/$z),'FD');
			//jijel
			$this->color($data['18']);$this->Polygon(array((381+$x)/$z,(31+$y)/$z,(384+$x)/$z,(29+$y)/$z,(386+$x)/$z,(27+$y)/$z,(388+$x)/$z,(25+$y)/$z,(392+$x)/$z,(25+$y)/$z,(395+$x)/$z,(25+$y)/$z,(398+$x)/$z,(23+$y)/$z,(401+$x)/$z,(22+$y)/$z,(404+$x)/$z,(24+$y)/$z,(405+$x)/$z,(25+$y)/$z,(406+$x)/$z,(30+$y)/$z,(404+$x)/$z,(32+$y)/$z,(400+$x)/$z,(32+$y)/$z,(395+$x)/$z,(32+$y)/$z,(392+$x)/$z,(33+$y)/$z,(389+$x)/$z,(34+$y)/$z,(384+$x)/$z,(34+$y)/$z,(381+$x)/$z,(33+$y)/$z,(381+$x)/$z,(31+$y)/$z),'FD');
			//oumelbaouaki
			$this->color($data['4']);$this->Polygon(array((409+$x)/$z,(45+$y)/$z,(411+$x)/$z,(47+$y)/$z,(414+$x)/$z,(46+$y)/$z,(417+$x)/$z,(46+$y)/$z,(421+$x)/$z,(46+$y)/$z,(423+$x)/$z,(49+$y)/$z,(427+$x)/$z,(48+$y)/$z,(428+$x)/$z,(47+$y)/$z,(431+$x)/$z,(50+$y)/$z,(434+$x)/$z,(52+$y)/$z,(437+$x)/$z,(55+$y)/$z,(443+$x)/$z,(56+$y)/$z,(442+$x)/$z,(62+$y)/$z,(438+$x)/$z,(64+$y)/$z,(435+$x)/$z,(65+$y)/$z,(432+$x)/$z,(63+$y)/$z,(429+$x)/$z,(62+$y)/$z,(426+$x)/$z,(62+$y)/$z,(423+$x)/$z,(63+$y)/$z,(419+$x)/$z,(62+$y)/$z,(416+$x)/$z,(63+$y)/$z,(416+$x)/$z,(60+$y)/$z,(413+$x)/$z,(57+$y)/$z,(410+$x)/$z,(57+$y)/$z,(407+$x)/$z,(56+$y)/$z,(404+$x)/$z,(56+$y)/$z,(400+$x)/$z,(55+$y)/$z,(402+$x)/$z,(52+$y)/$z,(405+$x)/$z,(50+$y)/$z,(406+$x)/$z,(47+$y)/$z,(409+$x)/$z,(45+$y)/$z),'FD');
			//constantine
			$this->color($data['25']);$this->Polygon(array((407+$x)/$z,(33+$y)/$z,(410+$x)/$z,(32+$y)/$z,(413+$x)/$z,(31+$y)/$z,(416+$x)/$z,(32+$y)/$z,(417+$x)/$z,(35+$y)/$z,(419+$x)/$z,(37+$y)/$z,(421+$x)/$z,(39+$y)/$z,(422+$x)/$z,(42+$y)/$z,(421+$x)/$z,(46+$y)/$z,(417+$x)/$z,(46+$y)/$z,(414+$x)/$z,(46+$y)/$z,(411+$x)/$z,(47+$y)/$z,(409+$x)/$z,(45+$y)/$z,(408+$x)/$z,(42+$y)/$z,(405+$x)/$z,(39+$y)/$z,(405+$x)/$z,(35+$y)/$z,(407+$x)/$z,(33+$y)/$z),'FD');
			//skikda
			$this->color($data['21']);$this->Polygon(array((401+$x)/$z,(22+$y)/$z,(402+$x)/$z,(19+$y)/$z,(405+$x)/$z,(17+$y)/$z,(408+$x)/$z,(17+$y)/$z,(410+$x)/$z,(19+$y)/$z,(413+$x)/$z,(20+$y)/$z,(415+$x)/$z,(22+$y)/$z,(418+$x)/$z,(22+$y)/$z,(421+$x)/$z,(22+$y)/$z,(425+$x)/$z,(21+$y)/$z,(428+$x)/$z,(19+$y)/$z,(429+$x)/$z,(22+$y)/$z,(430+$x)/$z,(26+$y)/$z,(430+$x)/$z,(29+$y)/$z,(427+$x)/$z,(31+$y)/$z,(424+$x)/$z,(31+$y)/$z,(422+$x)/$z,(34+$y)/$z,(419+$x)/$z,(37+$y)/$z,(417+$x)/$z,(35+$y)/$z,(416+$x)/$z,(32+$y)/$z,(413+$x)/$z,(31+$y)/$z,(410+$x)/$z,(32+$y)/$z,(407+$x)/$z,(33+$y)/$z,(404+$x)/$z,(32+$y)/$z,(406+$x)/$z,(30+$y)/$z,(405+$x)/$z,(27+$y)/$z,(404+$x)/$z,(24+$y)/$z,(401+$x)/$z,(22+$y)/$z),'FD');
			//annaba
			$this->color($data['23']);$this->Polygon(array((428+$x)/$z,(19+$y)/$z,(430+$x)/$z,(17+$y)/$z,(433+$x)/$z,(17+$y)/$z,(437+$x)/$z,(18+$y)/$z,(438+$x)/$z,(22+$y)/$z,(439+$x)/$z,(24+$y)/$z,(437+$x)/$z,(27+$y)/$z,(437+$x)/$z,(30+$y)/$z,(434+$x)/$z,(30+$y)/$z,(430+$x)/$z,(29+$y)/$z,(430+$x)/$z,(26+$y)/$z,(429+$x)/$z,(22+$y)/$z,(428+$x)/$z,(19+$y)/$z),'FD');
			//guelma
			$this->color($data['24']);$this->Polygon(array((437+$x)/$z,(30+$y)/$z,(439+$x)/$z,(31+$y)/$z,(443+$x)/$z,(31+$y)/$z,(444+$x)/$z,(33+$y)/$z,(441+$x)/$z,(37+$y)/$z,(438+$x)/$z,(40+$y)/$z,(435+$x)/$z,(42+$y)/$z,(431+$x)/$z,(42+$y)/$z,(428+$x)/$z,(43+$y)/$z,(428+$x)/$z,(47+$y)/$z,(427+$x)/$z,(48+$y)/$z,(423+$x)/$z,(49+$y)/$z,(421+$x)/$z,(46+$y)/$z,(422+$x)/$z,(42+$y)/$z,(421+$x)/$z,(39+$y)/$z,(419+$x)/$z,(37+$y)/$z,(422+$x)/$z,(34+$y)/$z,(424+$x)/$z,(31+$y)/$z,(427+$x)/$z,(31+$y)/$z,(430+$x)/$z,(29+$y)/$z,(434+$x)/$z,(30+$y)/$z, (437+$x)/$z,(30+$y)/$z),'FD');
			//taref
			$this->color($data['36']);$this->Polygon(array((439+$x)/$z,(24+$y)/$z,(442+$x)/$z,(23+$y)/$z,(445+$x)/$z,(22+$y)/$z,(448+$x)/$z,(20+$y)/$z,(451+$x)/$z,(19+$y)/$z,(454+$x)/$z,(20+$y)/$z,(457+$x)/$z,(20+$y)/$z,(460+$x)/$z,(19+$y)/$z,(460+$x)/$z,(22+$y)/$z,(460+$x)/$z,(24+$y)/$z,(456+$x)/$z,(24+$y)/$z,(456+$x)/$z,(29+$y)/$z,(453+$x)/$z,(31+$y)/$z,(450+$x)/$z,(33+$y)/$z,(447+$x)/$z,(35+$y)/$z,(444+$x)/$z,(33+$y)/$z,(443+$x)/$z,(31+$y)/$z,(439+$x)/$z,(31+$y)/$z,(437+$x)/$z,(30+$y)/$z,(437+$x)/$z,(27+$y)/$z,(439+$x)/$z,(24+$y)/$z),'FD');
			//soukahras
			$this->color($data['41']);$this->Polygon(array((450+$x)/$z,(33+$y)/$z,(453+$x)/$z,(34+$y)/$z,(455+$x)/$z,(36+$y)/$z,(455+$x)/$z,(39+$y)/$z,(454+$x)/$z,(44+$y)/$z,(453+$x)/$z,(48+$y)/$z,(450+$x)/$z,(48+$y)/$z,(446+$x)/$z,(50+$y)/$z,(442+$x)/$z,(52+$y)/$z,(443+$x)/$z,(56+$y)/$z,(437+$x)/$z,(55+$y)/$z,(434+$x)/$z,(52+$y)/$z,(431+$x)/$z,(50+$y)/$z,(428+$x)/$z,(47+$y)/$z,(428+$x)/$z,(43+$y)/$z,(431+$x)/$z,(42+$y)/$z,(435+$x)/$z,(42+$y)/$z,(438+$x)/$z,(40+$y)/$z,(441+$x)/$z,(37+$y)/$z,(444+$x)/$z,(33+$y)/$z, (447+$x)/$z,(35+$y)/$z,(450+$x)/$z,(33+$y)/$z),'FD');		
	}			
	$this->RoundedRect($x-10,155,30,55, 2, $style = '');
	$this->color(0);    $this->SetXY($x-10,150);$this->cell(30,5,$data['titre'],0,0,'C',0,0);
	$this->color(0);    $this->SetXY($x-5,$this->GetY()+10);$this->cell(5,5,'',1,0,'C',1,0);$this->cell(15,5,$data['A'],0,0,'L',0,0);
	$this->color(1);    $this->SetXY($x-5,$this->GetY()+10);$this->cell(5,5,'',1,0,'C',1,0);$this->cell(15,5,$data['B'],0,0,'L',0,0);
	$this->color(11);   $this->SetXY($x-5,$this->GetY()+10);$this->cell(5,5,'',1,0,'C',1,0);$this->cell(15,5,$data['C'],0,0,'L',0,0);
	$this->color(101);  $this->SetXY($x-5,$this->GetY()+10);$this->cell(5,5,'',1,0,'C',1,0);$this->cell(15,5,$data['D'],0,0,'L',0,0);
	$this->color(1001); $this->SetXY($x-5,$this->GetY()+10);$this->cell(5,5,'',1,0,'C',1,0);$this->cell(15,5,$data['E'],0,0,'L',0,0);
	$this->color(0);    $this->SetXY($x-10,$this->GetY()+15);$this->cell(40,5,'00km_____45km_____90km',0,0,'L',0,0);
	$this->color(0);    $this->SetXY($x-10,$this->GetY()+5);$this->cell(40,5,'Source : Dr TIBA Redha  DSP DJELFA ',0,0,'L',0,0);
	$this->color(0);
	$this->SetFont('Times', 'BIU', 8);
	$this->SetDrawColor(255,0,0);
	$this->SetXY(150,35);$this->cell(65,4,'Algerie',0,0,'C',0,0);
	$this->SetFont('Times', 'B', 7.5);
	$yy=165;
	$this->SetXY($yy,$this->GetY()+4);$this->cell(25,4,'1-Adrar',0,0,'L',0,0);$this->color($data['1']);$this->cell(10,3,$data['1'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+4);$this->cell(25,4,'2-Chlef',0,0,'L',0,0);$this->color($data['12']);$this->cell(10,3,$data['12'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+4);$this->cell(25,4,'3-Laghouat',0,0,'L',0,0);$this->color($data['3']);$this->cell(10,3,$data['3'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+4);$this->cell(25,4,'4-Oum el bouaghi',0,0,'L',0,0);$this->color($data['4']);$this->cell(10,3,$data['4'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+4);$this->cell(25,4,'5-Batna',0,0,'L',0,0);$this->color($data['5']);$this->cell(10,3,$data['5'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+4);$this->cell(25,4,'6-Bejaia',0,0,'L',0,0);$this->color($data['6']);$this->cell(10,3,$data['6'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+4);$this->cell(25,4,'7-Biskra',0,0,'L',0,0);$this->color($data['7']);$this->cell(10,3,$data['7'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+4);$this->cell(25,4,'8-Bechar',0,0,'L',0,0);$this->color($data['8']);$this->cell(10,3,$data['8'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+4);$this->cell(25,4,'9-Blida',0,0,'L',0,0);$this->color($data['9']);$this->cell(10,3,$data['9'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+4);$this->cell(25,4,'10-Bouira',0,0,'L',0,0);$this->color($data['10']);$this->cell(10,3,$data['10'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+4);$this->cell(25,4,'11-Tamanrasset',0,0,'L',0,0);$this->color($data['11']);$this->cell(10,3,$data['11'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+4);$this->cell(25,4,'12-Tebessa',0,0,'L',0,0);$this->color($data['12']);$this->cell(10,3,$data['12'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+4);$this->cell(25,4,'13-Tlemcen',0,0,'L',0,0);$this->color($data['13']);$this->cell(10,3,$data['13'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+4);$this->cell(25,4,'14-Tiaret',0,0,'L',0,0);$this->color($data['14']);$this->cell(10,3,$data['14'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+4);$this->cell(25,4,'15-Tizi ouzou',0,0,'L',0,0);$this->color($data['15']);$this->cell(10,3,$data['15'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+4);$this->cell(25,4,'16-Alger',0,0,'L',0,0);$this->color($data['16']);$this->cell(10,3,$data['16'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+4);$this->cell(25,4,'17-Djelfa',0,0,'L',0,0);$this->color($data['17']);$this->cell(10,3,$data['17'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+4);$this->cell(25,4,'18-Jijel',0,0,'L',0,0);$this->color($data['18']);$this->cell(10,3,$data['18'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+4);$this->cell(25,4,'19-Setif',0,0,'L',0,0);$this->color($data['19']);$this->cell(10,3,$data['19'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+4);$this->cell(25,4,'20-Saida',0,0,'L',0,0);$this->color($data['20']);$this->cell(10,3,$data['20'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+4);$this->cell(25,4,'21-Skikda',0,0,'L',0,0);$this->color($data['21']);$this->cell(10,3,$data['21'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+4);$this->cell(25,4,'22-Sidi bel abbes',0,0,'L',0,0);$this->color($data['22']);$this->cell(10,3,$data['22'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+4);$this->cell(25,4,'23-Annaba',0,0,'L',0,0);$this->color($data['23']);$this->cell(10,3,$data['23'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+4);$this->cell(25,4,'24-Guelma',0,0,'L',0,0);$this->color($data['24']);$this->cell(10,3,$data['24'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+4);$this->cell(25,4,'25-Constantine',0,0,'L',0,0);$this->color($data['25']);$this->cell(10,3,$data['25'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+4);$this->cell(25,4,'26-Medea',0,0,'L',0,0);$this->color($data['26']);$this->cell(10,3,$data['26'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+4);$this->cell(25,4,'27-Mostaganem',0,0,'L',0,0);$this->color($data['27']);$this->cell(10,3,$data['27'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+4);$this->cell(25,4,'28-M sila',0,0,'L',0,0);$this->color($data['28']);$this->cell(10,3,$data['28'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+4);$this->cell(25,4,'29-Mascara',0,0,'L',0,0);$this->color($data['29']);$this->cell(10,3,$data['29'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+4);$this->cell(25,4,'30-Ouargla',0,0,'L',0,0);$this->color($data['30']);$this->cell(10,3,$data['30'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+4);$this->cell(25,4,'31-Oran',0,0,'L',0,0);$this->color($data['31']);$this->cell(10,3,$data['31'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+4);$this->cell(25,4,'32-El bayadh',0,0,'L',0,0);$this->color($data['32']);$this->cell(10,3,$data['32'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+4);$this->cell(25,4,'33-Illizi',0,0,'L',0,0);$this->color($data['33']);$this->cell(10,3,$data['33'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+4);$this->cell(25,4,'34-Bordj bou arreridj',0,0,'L',0,0);$this->color($data['34']);$this->cell(10,3,$data['34'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+4);$this->cell(25,4,'35-Boumerdes',0,0,'L',0,0);$this->color($data['35']);$this->cell(10,3,$data['35'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+4);$this->cell(25,4,'36-El taref',0,0,'L',0,0);$this->color($data['36']);$this->cell(10,3,$data['36'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+4);$this->cell(25,4,'37-Tindouf',0,0,'L',0,0);$this->color($data['37']);$this->cell(10,3,$data['37'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+4);$this->cell(25,4,'38-Tissemsilt',0,0,'L',0,0);$this->color($data['38']);$this->cell(10,3,$data['38'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+4);$this->cell(25,4,'39-El oued',0,0,'L',0,0);$this->color($data['39']);$this->cell(10,3,$data['39'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+4);$this->cell(25,4,'40-Khenchela',0,0,'L',0,0);$this->color($data['40']);$this->cell(10,3,$data['40'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+4);$this->cell(25,4,'41-Souk ahras',0,0,'L',0,0);$this->color($data['41']);$this->cell(10,3,$data['41'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+4);$this->cell(25,4,'42-Tipaza',0,0,'L',0,0);$this->color($data['42']);$this->cell(10,3,$data['42'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+4);$this->cell(25,4,'43-Mila',0,0,'L',0,0);$this->color($data['43']);$this->cell(10,3,$data['43'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+4);$this->cell(25,4,'44-Ain defla',0,0,'L',0,0);$this->color($data['44']);$this->cell(10,3,$data['44'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+4);$this->cell(25,4,'45-Naama',0,0,'L',0,0);$this->color($data['45']);$this->cell(10,3,$data['45'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+4);$this->cell(25,4,'46-Ain temouchent',0,0,'L',0,0);$this->color($data['46']);$this->cell(10,3,$data['46'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+4);$this->cell(25,4,'47-Ghardaia',0,0,'L',0,0);$this->color($data['47']);$this->cell(10,3,$data['47'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+4);$this->cell(25,4,'48-Relizane',0,0,'L',0,0);$this->color($data['48']);$this->cell(10,3,$data['48'],0,0,'C',1,0);										
	$this->SetDrawColor(0,0,0);
	$this->SetFont('Times', 'B', 5.5);
	$this->SetXY(65,119);$this->cell(55,5,'1',0,0,'L',0,0);$this->SetXY(78,44);$this->cell(55,5,'2',0,0,'L',0,0);$this->SetXY(90.5,68);$this->cell(55,5,'3',0,0,'L',0,0);$this->SetXY(117,47);$this->cell(55,5,'4',0,0,'L',0,0);$this->SetXY(110,50);$this->cell(55,5,'5',0,0,'L',0,0);$this->SetXY(103,40);$this->cell(55,5,'6',0,0,'L',0,0);$this->SetXY(108,56);$this->cell(55,5,'7',0,0,'L',0,0);$this->SetXY(55,90);$this->cell(55,5,'8',0,0,'L',0,0);	$this->SetXY(90,42.5);$this->cell(55,5,'9',0,0,'L',0,0);$this->SetXY(96,45);$this->cell(55,5,'10',0,0,'L',0,0);	$this->SetXY(95,129);$this->cell(55,5,'11',0,0,'L',0,0);$this->SetXY(123,52);$this->cell(55,5,'12',0,0,'L',0,0);$this->SetXY(60,57);$this->cell(55,5,'13',0,0,'L',0,0);$this->SetXY(80.5,55);$this->cell(55,5,'14',0,0,'L',0,0);	$this->SetXY(99,40);$this->cell(55,5,'15',0,0,'L',0,0);$this->SetXY(90,40);$this->cell(55,5,'16',0,0,'L',0,0);$this->SetXY(90.5,55);$this->cell(55,5,'17',0,0,'L',0,0);	$this->SetXY(109,40);$this->cell(55,5,'18',0,0,'L',0,0);$this->SetXY(107,45);$this->cell(55,5,'19',0,0,'L',0,0);$this->SetXY(71,57);$this->cell(55,5,'20',0,0,'L',0,0);$this->SetXY(116,39.5);$this->cell(55,5,'21',0,0,'L',0,0);$this->SetXY(66,57);$this->cell(55,5,'22',0,0,'L',0,0);$this->SetXY(120.5,38.5);$this->cell(55,5,'23',0,0,'L',0,0);$this->SetXY(119.5,42);$this->cell(55,5,'24',0,0,'L',0,0);$this->SetXY(115,43);$this->cell(55,5,'25',0,0,'L',0,0);$this->SetXY(90,45);$this->cell(55,5,'26',0,0,'L',0,0);$this->SetXY(72,47);$this->cell(55,5,'27',0,0,'L',0,0);$this->SetXY(98,52);$this->cell(55,5,'28',0,0,'L',0,0);	$this->SetXY(71,52);$this->cell(55,5,'29',0,0,'L',0,0);$this->SetXY(110,90);$this->cell(55,5,'30',0,0,'L',0,0);$this->SetXY(66,49);$this->cell(55,5,'31',0,0,'L',0,0);$this->SetXY(75.5,68);$this->cell(55,5,'32',0,0,'L',0,0);$this->SetXY(125,119);$this->cell(55,5,'33',0,0,'L',0,0);$this->SetXY(102,45);$this->cell(55,5,'34',0,0,'L',0,0);	$this->SetXY(94,40);$this->cell(55,5,'35',0,0,'L',0,0);$this->SetXY(124,39.5);$this->cell(55,5,'36',0,0,'L',0,0);$this->SetXY(25,112);$this->cell(55,5,'37',0,0,'L',0,0);$this->SetXY(81.5,48.5);$this->cell(55,5,'38',0,0,'L',0,0);	$this->SetXY(118.5,68);$this->cell(55,5,'39',0,0,'L',0,0);$this->SetXY(117,52);$this->cell(55,5,'40',0,0,'L',0,0);$this->SetXY(122,44.5);$this->cell(55,5,'41',0,0,'L',0,0);$this->SetXY(84,42);$this->cell(55,5,'42',0,0,'L',0,0);$this->SetXY(111,43);$this->cell(55,5,'43',0,0,'L',0,0);$this->SetXY(84,45);$this->cell(55,5,'44',0,0,'L',0,0);$this->SetXY(65,68);$this->cell(55,5,'45',0,0,'L',0,0);$this->SetXY(63,51.5);$this->cell(55,5,'46',0,0,'L',0,0);$this->SetXY(90,90);$this->cell(55,5,'47',0,0,'L',0,0);		$this->SetXY(75,48);$this->cell(55,5,'48',0,0,'L',0,0);	
    $this->SetDrawColor(0,0,0);
	$this->SetFont('Times', 'B', 10);
    }
	
	function Polygon($points, $style='D')
	{
	//Draw a polygon
	if($style=='F')
		$op = 'f';
	elseif($style=='FD' || $style=='DF')
		$op = 'b';
	else
		$op = 's';

	$h = $this->h;
	$k = $this->k;

	$points_string = '';
	for($i=0; $i<count($points); $i+=2){
		$points_string .= sprintf('%.2F %.2F', $points[$i]*$k, ($h-$points[$i+1])*$k);
		if($i==0)
			$points_string .= ' m ';
		else
			$points_string .= ' l ';
	}
	$this->_out($points_string . $op);
   }
   function datasig($datejour1,$datejour2,$STRUCTURED) 
	{
	$data = array(
	"titre"=> 'Nombre De Deces',
	"A"    => '00-00',
	"B"    => '01-10',
	"C"    => '09-100',
	"D"    => '99-1000',
	"E"    => '999-10000',
	"1"    => $this->decescomm($datejour1,$datejour2,916,$STRUCTURED),//daira  Djelfa
	"2"    => $this->decescomm($datejour1,$datejour2,924,$STRUCTURED)+$this->decescomm($datejour1,$datejour2,925,$STRUCTURED),//daira  ainoussera
	"3"    => $this->decescomm($datejour1,$datejour2,929,$STRUCTURED)+$this->decescomm($datejour1,$datejour2,931,$STRUCTURED),//daira  birine
	"4"    => $this->decescomm($datejour1,$datejour2,929,$STRUCTURED)+$this->decescomm($datejour1,$datejour2,927,$STRUCTURED)+$this->decescomm($datejour1,$datejour2,928,$STRUCTURED),//daira  sidilaadjel
	"5"    => $this->decescomm($datejour1,$datejour2,932,$STRUCTURED)+$this->decescomm($datejour1,$datejour2,933,$STRUCTURED)+$this->decescomm($datejour1,$datejour2,934,$STRUCTURED),//daira  hadsahari
	"6"    => $this->decescomm($datejour1,$datejour2,935,$STRUCTURED)+$this->decescomm($datejour1,$datejour2,939,$STRUCTURED)+$this->decescomm($datejour1,$datejour2,941,$STRUCTURED)+$this->decescomm($datejour1,$datejour2,940,$STRUCTURED),//daira  hassibahbah
	"7"    => $this->decescomm($datejour1,$datejour2,942,$STRUCTURED)+$this->decescomm($datejour1,$datejour2,946,$STRUCTURED)+$this->decescomm($datejour1,$datejour2,947,$STRUCTURED),//daira  darchioukhe
	"8"    => $this->decescomm($datejour1,$datejour2,920,$STRUCTURED)+$this->decescomm($datejour1,$datejour2,919,$STRUCTURED)+$this->decescomm($datejour1,$datejour2,923,$STRUCTURED),//daira  charef
	"9"    => $this->decescomm($datejour1,$datejour2,917,$STRUCTURED)+$this->decescomm($datejour1,$datejour2,964,$STRUCTURED)+$this->decescomm($datejour1,$datejour2,963,$STRUCTURED),//daira  idrissia
	"10"   => $this->decescomm($datejour1,$datejour2,965,$STRUCTURED)+$this->decescomm($datejour1,$datejour2,958,$STRUCTURED)+$this->decescomm($datejour1,$datejour2,962,$STRUCTURED)+$this->decescomm($datejour1,$datejour2,957,$STRUCTURED),//daira  ain elbel
	"11"   => $this->decescomm($datejour1,$datejour2,948,$STRUCTURED)+$this->decescomm($datejour1,$datejour2,952,$STRUCTURED)+$this->decescomm($datejour1,$datejour2,954,$STRUCTURED)+$this->decescomm($datejour1,$datejour2,953,$STRUCTURED)+$this->decescomm($datejour1,$datejour2,951,$STRUCTURED),//daira  messaad
	"12"   => $this->decescomm($datejour1,$datejour2,967,$STRUCTURED)+$this->decescomm($datejour1,$datejour2,968,$STRUCTURED)+$this->decescomm($datejour1,$datejour2,956,$STRUCTURED),//daira  faid elbotma
	"916"  => $this->decescomm($datejour1,$datejour2,916,$STRUCTURED),//daira  Djelfa
	"917"  => $this->decescomm($datejour1,$datejour2,917,$STRUCTURED),//daira El Idrissia
	"918"  => $this->decescomm($datejour1,$datejour2,918,$STRUCTURED),//Oum Cheggag
	"919"  => $this->decescomm($datejour1,$datejour2,919,$STRUCTURED),//El Guedid
	"920"  => $this->decescomm($datejour1,$datejour2,920,$STRUCTURED),//daira Charef
	"921"  => $this->decescomm($datejour1,$datejour2,921,$STRUCTURED),//El Hammam
	"922"  => $this->decescomm($datejour1,$datejour2,922,$STRUCTURED),//Touazi
	"923"  => $this->decescomm($datejour1,$datejour2,923,$STRUCTURED),//Beni Yacoub
	"924"  => $this->decescomm($datejour1,$datejour2,924,$STRUCTURED),//daira ainoussera
	"925"  => $this->decescomm($datejour1,$datejour2,925,$STRUCTURED),//guernini
	"926"  => $this->decescomm($datejour1,$datejour2,926,$STRUCTURED),//daira sidilaadjel
	"927"  => $this->decescomm($datejour1,$datejour2,927,$STRUCTURED),//hassifdoul
	"928"  => $this->decescomm($datejour1,$datejour2,928,$STRUCTURED),//elkhamis
	"929"  => $this->decescomm($datejour1,$datejour2,929,$STRUCTURED),//daira birine
	"930"  => $this->decescomm($datejour1,$datejour2,930,$STRUCTURED),//Dra Souary
	"931"  => $this->decescomm($datejour1,$datejour2,931,$STRUCTURED),//benahar
	"932"  => $this->decescomm($datejour1,$datejour2,932,$STRUCTURED),//daira hadshari
	"933"  => $this->decescomm($datejour1,$datejour2,933,$STRUCTURED),//bouiratlahdab
	"934"  => $this->decescomm($datejour1,$datejour2,934,$STRUCTURED),//ainfka
	"935"  => $this->decescomm($datejour1,$datejour2,935,$STRUCTURED),//daira hassi bahbah
	"936"  => $this->decescomm($datejour1,$datejour2,936,$STRUCTURED),//Mouilah
	"937"  => $this->decescomm($datejour1,$datejour2,937,$STRUCTURED),//El Mesrane
	"938"  => $this->decescomm($datejour1,$datejour2,938,$STRUCTURED),//Hassi el Mora
	"939"  => $this->decescomm($datejour1,$datejour2,939,$STRUCTURED),//zaafrane
	"940"  => $this->decescomm($datejour1,$datejour2,940,$STRUCTURED),//hassi el euche
	"941"  => $this->decescomm($datejour1,$datejour2,941,$STRUCTURED),//ain maabed
	"942"  => $this->decescomm($datejour1,$datejour2,942,$STRUCTURED),//daira darchioukh
	"943"  => $this->decescomm($datejour1,$datejour2,943,$STRUCTURED),//Guendouza
	"944"  => $this->decescomm($datejour1,$datejour2,944,$STRUCTURED),//El Oguila
	"945"  => $this->decescomm($datejour1,$datejour2,945,$STRUCTURED),//El Merdja
	"946"  => $this->decescomm($datejour1,$datejour2,946,$STRUCTURED),//mliliha
	"947"  => $this->decescomm($datejour1,$datejour2,947,$STRUCTURED),//sidibayzid
	"948"  => $this->decescomm($datejour1,$datejour2,948,$STRUCTURED),//daira Messad
	"949"  => $this->decescomm($datejour1,$datejour2,949,$STRUCTURED),//Abdelmadjid
	"950"  => $this->decescomm($datejour1,$datejour2,950,$STRUCTURED),//Haniet Ouled Salem
	"951"  => $this->decescomm($datejour1,$datejour2,951,$STRUCTURED),//Guettara
	"952"  => $this->decescomm($datejour1,$datejour2,952,$STRUCTURED),//Deldoul
	"953"  => $this->decescomm($datejour1,$datejour2,953,$STRUCTURED),//Sed Rahal
	"954"  => $this->decescomm($datejour1,$datejour2,954,$STRUCTURED),//Selmana
	"955"  => $this->decescomm($datejour1,$datejour2,955,$STRUCTURED),//El Gahra
	"956"  => $this->decescomm($datejour1,$datejour2,956,$STRUCTURED),//Oum Laadham
	"957"  => $this->decescomm($datejour1,$datejour2,957,$STRUCTURED),//Mouadjebar
	"958"  => $this->decescomm($datejour1,$datejour2,958,$STRUCTURED),//daira Ain el Ibel
	"959"  => $this->decescomm($datejour1,$datejour2,959,$STRUCTURED),//Amera
	"960"  => $this->decescomm($datejour1,$datejour2,960,$STRUCTURED),//N'thila
	"961"  => $this->decescomm($datejour1,$datejour2,961,$STRUCTURED),//Oued Seddeur
	"962"  => $this->decescomm($datejour1,$datejour2,962,$STRUCTURED),//Zaccar
	"963"  => $this->decescomm($datejour1,$datejour2,963,$STRUCTURED),//Douis
	"964"  => $this->decescomm($datejour1,$datejour2,964,$STRUCTURED),//Ain Chouhada
	"965"  => $this->decescomm($datejour1,$datejour2,965,$STRUCTURED),//Tadmit
	"966"  => $this->decescomm($datejour1,$datejour2,966,$STRUCTURED),//El Hiouhi
	"967"  => $this->decescomm($datejour1,$datejour2,967,$STRUCTURED),//daira Faidh el Botma
	"968"  => $this->decescomm($datejour1,$datejour2,968,$STRUCTURED) //Amourah
	);		
	return $data;
	}
	function decescomm($DATEJOUR1,$DATEJOUR2,$COMMUNER,$STRUCTURED) 
	{
	$this->mysqlconnect();
	$sql = " select * from deceshosp where DINS BETWEEN '$DATEJOUR1' AND '$DATEJOUR2' and COMMUNER=$COMMUNER and STRUCTURED $STRUCTURED  ";
	$requete = @mysql_query($sql) or die($sql."<br>".mysql_error());
	$OP=mysql_num_rows($requete);
	mysql_free_result($requete);
	return $OP;
	}
	
   	function djelfa($data,$x,$y,$z,$cd) 
    {
	//$this->Image('../public/IMAGES/photos/pc.gif',250,50,30,30,0);
	$this->SetXY(220,40);$this->cell(65,5,'WILAYA DE DJELFA',1,0,'C',1,0);
	$this->RoundedRect($x-15,35,155,200, 2, $style = '');
	$this->RoundedRect($x-15,35,200,200, 2, $style = '');
	if ($cd=='dairas')
	{
	    //dairas ain-oussera//1-ain-oussera//2-guernini
		$this->color($data['2']);$this->Polygon(array((130+$x)/$z,(58+$y)/$z,(135+$x)/$z,(62+$y)/$z,(127+$x)/$z,(76+$y)/$z,(119+$x)/$z,(80+$y)/$z,(119+$x)/$z,(85+$y)/$z,(123+$x)/$z,(86+$y)/$z,(126+$x)/$z,(82+$y)/$z,(139+$x)/$z,(82+$y)/$z,(138+$x)/$z,(90+$y)/$z,(133+$x)/$z,(93+$y)/$z,(122+$x)/$z,(111+$y)/$z,(111+$x)/$z,(123+$y)/$z,(109+$x)/$z,(131+$y)/$z,(113+$x)/$z,(135+$y)/$z,(107+$x)/$z,(136+$y)/$z,(98+$x)/$z,(153+$y)/$z,(108+$x)/$z,(163+$y)/$z,(132+$x)/$z,(155+$y)/$z,(141+$x)/$z,(148+$y)/$z,(154+$x)/$z,(144+$y)/$z,(154+$x)/$z,(136+$y)/$z,(154+$x)/$z,(136+$y)/$z,(162+$x)/$z,(127+$y)/$z,(161+$x)/$z,(123+$y)/$z,(164+$x)/$z,(117+$y)/$z,(158+$x)/$z,(116+$y)/$z,(155+$x)/$z,(87+$y)/$z,(160+$x)/$z,(83+$y)/$z,(160+$x)/$z,(78+$y)/$z,(155+$x)/$z,(78+$y)/$z,(150+$x)/$z,(82+$y)/$z,(150+$x)/$z,(11+$y)/$z,(145+$x)/$z,(8+$y)/$z,(143+$x)/$z,(14+$y)/$z,(145+$x)/$z,(22+$y)/$z,(143+$x)/$z,(28+$y)/$z,(147+$x)/$z,(33+$y)/$z,(147+$x)/$z,(44+$y)/$z,(142+$x)/$z,(48+$y)/$z,(137+$x)/$z,(53+$y)/$z,(130+$x)/$z,(58+$y)/$z),'FD');														
		//dairas birin//2-benahar//1-birine
		$this->color($data['3']);$this->Polygon(array((150+$x)/$z,(11+$y)/$z,(150+$x)/$z,(82+$y)/$z,(155+$x)/$z,(78+$y)/$z,(160+$x)/$z,(78+$y)/$z,(160+$x)/$z,(83+$y)/$z,(155+$x)/$z,(87+$y)/$z,(158+$x)/$z,(116+$y)/$z,(164+$x)/$z,(117+$y)/$z,(161+$x)/$z,(123+$y)/$z,(162+$x)/$z,(127+$y)/$z,(172+$x)/$z,(123+$y)/$z,(179+$x)/$z,(119+$y)/$z,(191+$x)/$z,(105+$y)/$z,(200+$x)/$z,(98+$y)/$z,(194+$x)/$z,(78+$y)/$z,(204+$x)/$z,(75+$y)/$z,(224+$x)/$z,(68+$y)/$z,(243+$x)/$z,(53+$y)/$z,(221+$x)/$z,(30+$y)/$z,(220+$x)/$z,(22+$y)/$z,(212+$x)/$z,(22+$y)/$z,(207+$x)/$z,(14+$y)/$z,(205+$x)/$z,(9+$y)/$z,(198+$x)/$z,(14+$y)/$z,(197+$x)/$z,(25+$y)/$z,(191+$x)/$z,(36+$y)/$z,(185+$x)/$z,(36+$y)/$z,(181+$x)/$z,(38+$y)/$z,(173+$x)/$z,(50+$y)/$z,(172+$x)/$z,(38+$y)/$z,(170+$x)/$z,(25+$y)/$z,(165+$x)/$z,(23+$y)/$z,(161+$x)/$z,(6+$y)/$z,(150+$x)/$z,(11+$y)/$z),'FD');												
		//dairas sidilaadjel//2-hassifedoul//1-sidilaadjel//3-elkhamiss
		$this->color($data['4']);$this->Polygon(array((11+$x)/$z,(64+$y)/$z,(11+$x)/$z,(76+$y)/$z,(44+$x)/$z,(102+$y)/$z,(59+$x)/$z,(106+$y)/$z,(70+$x)/$z,(120+$y)/$z,(89+$x)/$z,(103+$y)/$z,(97+$x)/$z,(110+$y)/$z,(98+$x)/$z,(119+$y)/$z,(111+$x)/$z,(123+$y)/$z,(122+$x)/$z,(111+$y)/$z,(133+$x)/$z,(93+$y)/$z,(138+$x)/$z,(90+$y)/$z,(139+$x)/$z,(82+$y)/$z,(126+$x)/$z,(82+$y)/$z,(123+$x)/$z,(86+$y)/$z,(119+$x)/$z,(85+$y)/$z,(119+$x)/$z,(80+$y)/$z,(127+$x)/$z,(76+$y)/$z,(135+$x)/$z,(62+$y)/$z,(130+$x)/$z,(58+$y)/$z,(120+$x)/$z,(70+$y)/$z,(119+$x)/$z,(77+$y)/$z,(114+$x)/$z,(77+$y)/$z,(109+$x)/$z,(82+$y)/$z,(101+$x)/$z,(81+$y)/$z,(87+$x)/$z,(70+$y)/$z,(68+$x)/$z,(78+$y)/$z,(50+$x)/$z,(80+$y)/$z,(48+$x)/$z,(60+$y)/$z,(11+$x)/$z,(64+$y)/$z),'FD');
		//dairas had-sahari//2-ainfaka//1-had-sahari//3-bouiratlahdab							
		$this->color($data['5']);$this->Polygon(array((154+$x)/$z,(136+$y)/$z,(154+$x)/$z,(144+$y)/$z,(163+$x)/$z,(145+$y)/$z,(170+$x)/$z,(149+$y)/$z,(177+$x)/$z,(150+$y)/$z,(200+$x)/$z,(133+$y)/$z,(207+$x)/$z,(130+$y)/$z,(216+$x)/$z,(132+$y)/$z,(228+$x)/$z,(132+$y)/$z,(234+$x)/$z,(137+$y)/$z,(254+$x)/$z,(117+$y)/$z,(256+$x)/$z,(118+$y)/$z,(266+$x)/$z,(108+$y)/$z,(263+$x)/$z,(92+$y)/$z,(269+$x)/$z,(89+$y)/$z,(270+$x)/$z,(74+$y)/$z,(243+$x)/$z,(53+$y)/$z,(224+$x)/$z,(68+$y)/$z,(204+$x)/$z,(75+$y)/$z,(194+$x)/$z,(78+$y)/$z,(194+$x)/$z,(78+$y)/$z,(200+$x)/$z,(98+$y)/$z,(191+$x)/$z,(105+$y)/$z,(179+$x)/$z,(119+$y)/$z,(172+$x)/$z,(123+$y)/$z,(162+$x)/$z,(127+$y)/$z,(154+$x)/$z,(136+$y)/$z),'FD');			
		//dairas hassi-bahbah//2-zaafrane//4-ainmaabed//3-eleuch//1-hassi-bahbah
		$this->color($data['6']);$this->Polygon(array((108+$x)/$z,(163+$y)/$z,(102+$x)/$z,(167+$y)/$z,(89+$x)/$z,(168+$y)/$z,(85+$x)/$z,(172+$y)/$z,(81+$x)/$z,(193+$y)/$z,(114+$x)/$z,(198+$y)/$z,(118+$x)/$z,(196+$y)/$z,(123+$x)/$z,(196+$y)/$z,(127+$x)/$z,(204+$y)/$z,(128+$x)/$z,(215+$y)/$z,(133+$x)/$z,(221+$y)/$z,(138+$x)/$z,(222+$y)/$z,(139+$x)/$z,(232+$y)/$z,(142+$x)/$z,(237+$y)/$z,(141+$x)/$z,(242+$y)/$z,(145+$x)/$z,(245+$y)/$z,(142+$x)/$z,(256+$y)/$z,(155+$x)/$z,(259+$y)/$z,(164+$x)/$z,(249+$y)/$z,(174+$x)/$z,(243+$y)/$z,(173+$x)/$z,(227+$y)/$z,(178+$x)/$z,(224+$y)/$z,(183+$x)/$z,(223+$y)/$z,(189+$x)/$z,(223+$y)/$z,(189+$x)/$z,(217+$y)/$z,(193+$x)/$z,(212+$y)/$z,(201+$x)/$z,(210+$y)/$z,(205+$x)/$z,(208+$y)/$z,(217+$x)/$z,(197+$y)/$z,(207+$x)/$z,(194+$y)/$z,(203+$x)/$z,(183+$y)/$z,(197+$x)/$z,(183+$y)/$z,(191+$x)/$z,(177+$y)/$z,(214+$x)/$z,(164+$y)/$z,(222+$x)/$z,(164+$y)/$z,(222+$x)/$z,(150+$y)/$z,(233+$x)/$z,(137+$y)/$z,(228+$x)/$z,(132+$y)/$z,(216+$x)/$z,(132+$y)/$z,(207+$x)/$z,(130+$y)/$z,(200+$x)/$z,(133+$y)/$z,(177+$x)/$z,(150+$y)/$z,(170+$x)/$z,(149+$y)/$z,(163+$x)/$z,(145+$y)/$z,(154+$x)/$z,(144+$y)/$z,(141+$x)/$z,(148+$y)/$z,(132+$x)/$z,(155+$y)/$z,(108+$x)/$z,(163+$y)/$z),'FD');
		//dairas darchioukh//3-sidibayzid//1-darchioukh//2-mliliha
		$this->color($data['7']);$this->Polygon(array((233+$x)/$z,(137+$y)/$z,(222+$x)/$z,(150+$y)/$z,(222+$x)/$z,(164+$y)/$z,(214+$x)/$z,(164+$y)/$z,(191+$x)/$z,(177+$y)/$z,(197+$x)/$z,(183+$y)/$z,(203+$x)/$z,(183+$y)/$z,(207+$x)/$z,(194+$y)/$z,(217+$x)/$z,(197+$y)/$z,(205+$x)/$z,(208+$y)/$z,(211+$x)/$z,(218+$y)/$z,(218+$x)/$z,(217+$y)/$z,(233+$x)/$z,(219+$y)/$z,(239+$x)/$z,(226+$y)/$z,(240+$x)/$z,(241+$y)/$z,(245+$x)/$z,(243+$y)/$z,(245+$x)/$z,(250+$y)/$z,(249+$x)/$z,(250+$y)/$z,(251+$x)/$z,(246+$y)/$z,(258+$x)/$z,(244+$y)/$z,(272+$x)/$z,(255+$y)/$z,(274+$x)/$z,(250+$y)/$z,(269+$x)/$z,(248+$y)/$z,(268+$x)/$z,(243+$y)/$z,(271+$x)/$z,(240+$y)/$z,(276+$x)/$z,(242+$y)/$z,(279+$x)/$z,(247+$y)/$z,(283+$x)/$z,(250+$y)/$z,(288+$x)/$z,(248+$y)/$z,(306+$x)/$z,(247+$y)/$z,(306+$x)/$z,(243+$y)/$z,(302+$x)/$z,(240+$y)/$z,(301+$x)/$z,(214+$y)/$z,(276+$x)/$z,(212+$y)/$z,(272+$x)/$z,(206+$y)/$z,(265+$x)/$z,(211+$y)/$z,(262+$x)/$z,(204+$y)/$z,(261+$x)/$z,(197+$y)/$z,(254+$x)/$z,(194+$y)/$z,(252+$x)/$z,(186+$y)/$z,(249+$x)/$z,(182+$y)/$z,(253+$x)/$z,(180+$y)/$z,(250+$x)/$z,(165+$y)/$z,(255+$x)/$z,(154+$y)/$z,(248+$x)/$z,(159+$y)/$z,(233+$x)/$z,(137+$y)/$z),'FD');
		//djelfa
		$this->color($data['1']);$this->Polygon(array((173+$x)/$z,(227+$y)/$z,(174+$x)/$z,(243+$y)/$z,(177+$x)/$z,(248+$y)/$z,(184+$x)/$z,(251+$y)/$z,(185+$x)/$z,(256+$y)/$z,(188+$x)/$z,(260+$y)/$z,(194+$x)/$z,(258+$y)/$z,(201+$x)/$z,(263+$y)/$z,(214+$x)/$z,(255+$y)/$z,(212+$x)/$z,(240+$y)/$z,(217+$x)/$z,(230+$y)/$z,(215+$x)/$z,(220+$y)/$z,(218+$x)/$z,(217+$y)/$z,(211+$x)/$z,(218+$y)/$z,(205+$x)/$z,(208+$y)/$z,(201+$x)/$z,(210+$y)/$z,(193+$x)/$z,(212+$y)/$z,(189+$x)/$z,(217+$y)/$z,(189+$x)/$z,(223+$y)/$z,(183+$x)/$z,(223+$y)/$z,(178+$x)/$z,(224+$y)/$z,(173+$x)/$z,(227+$y)/$z),'FD');
		//dairas idrissia//1-idrissia//3-ainchouhadda//2-douisse
		$this->color($data['9']);$this->Polygon(array((67+$x)/$z,(278+$y)/$z,(72+$x)/$z,(289+$y)/$z,(77+$x)/$z,(305+$y)/$z,(85+$x)/$z,(320+$y)/$z,(91+$x)/$z,(325+$y)/$z,(93+$x)/$z,(333+$y)/$z,(100+$x)/$z,(334+$y)/$z,(102+$x)/$z,(339+$y)/$z,(107+$x)/$z,(343+$y)/$z,(111+$x)/$z,(343+$y)/$z,(118+$x)/$z,(344+$y)/$z,(126+$x)/$z,(338+$y)/$z,(134+$x)/$z,(339+$y)/$z,(132+$x)/$z,(332+$y)/$z,(143+$x)/$z,(315+$y)/$z,(137+$x)/$z,(311+$y)/$z,(133+$x)/$z,(313+$y)/$z,(131+$x)/$z,(310+$y)/$z,(127+$x)/$z,(311+$y)/$z,(127+$x)/$z,(303+$y)/$z,(132+$x)/$z,(299+$y)/$z,(129+$x)/$z,(297+$y)/$z,(128+$x)/$z,(288+$y)/$z,(123+$x)/$z,(288+$y)/$z,(115+$x)/$z,(285+$y)/$z,(110+$x)/$z,(289+$y)/$z,(100+$x)/$z,(285+$y)/$z,(100+$x)/$z,(280+$y)/$z,(106+$x)/$z,(277+$y)/$z,(107+$x)/$z,(273+$y)/$z,(101+$x)/$z,(273+$y)/$z,(95+$x)/$z,(269+$y)/$z,(96+$x)/$z,(261+$y)/$z,(78+$x)/$z,(265+$y)/$z,(77+$x)/$z,(275+$y)/$z,(67+$x)/$z,(278+$y)/$z),'FD');
		//dairas charef//2-guedid//1-charef//3-benyaagoub
		$this->color($data['8']);$this->Polygon(array((81+$x)/$z,(193+$y)/$z,(74+$x)/$z,(209+$y)/$z,(62+$x)/$z,(211+$y)/$z,(65+$x)/$z,(227+$y)/$z,(67+$x)/$z,(278+$y)/$z,(77+$x)/$z,(275+$y)/$z,(78+$x)/$z,(265+$y)/$z,(96+$x)/$z,(261+$y)/$z,(95+$x)/$z,(269+$y)/$z,(101+$x)/$z,(273+$y)/$z,(107+$x)/$z,(273+$y)/$z,(106+$x)/$z,(277+$y)/$z,(100+$x)/$z,(280+$y)/$z,(100+$x)/$z,(285+$y)/$z,(110+$x)/$z,(289+$y)/$z,(115+$x)/$z,(285+$y)/$z,(123+$x)/$z,(288+$y)/$z,(128+$x)/$z,(288+$y)/$z,(128+$x)/$z,(283+$y)/$z,(129+$x)/$z,(280+$y)/$z,(133+$x)/$z,(279+$y)/$z,(138+$x)/$z,(282+$y)/$z,(145+$x)/$z,(277+$y)/$z,(152+$x)/$z,(269+$y)/$z,(157+$x)/$z,(264+$y)/$z,(155+$x)/$z,(259+$y)/$z,(142+$x)/$z,(256+$y)/$z,(145+$x)/$z,(245+$y)/$z,(141+$x)/$z,(242+$y)/$z,(142+$x)/$z,(237+$y)/$z,(139+$x)/$z,(232+$y)/$z,(138+$x)/$z,(222+$y)/$z,(133+$x)/$z,(221+$y)/$z,(128+$x)/$z,(215+$y)/$z,(128+$x)/$z,(215+$y)/$z,(127+$x)/$z,(204+$y)/$z,(123+$x)/$z,(196+$y)/$z,(118+$x)/$z,(196+$y)/$z,(114+$x)/$z,(198+$y)/$z,(81+$x)/$z,(193+$y)/$z),'FD');
        //dairas ainelbel//3-taadmit //1-ainelbel//4-zakar//2-moudjbara
		$this->color($data['10']);$this->Polygon(array((143+$x)/$z,(315+$y)/$z,(151+$x)/$z,(310+$y)/$z,(157+$x)/$z,(314+$y)/$z,(161+$x)/$z,(319+$y)/$z,(170+$x)/$z,(316+$y)/$z,(172+$x)/$z,(324+$y)/$z,(177+$x)/$z,(329+$y)/$z,(176+$x)/$z,(344+$y)/$z,(186+$x)/$z,(368+$y)/$z,(197+$x)/$z,(360+$y)/$z,(199+$x)/$z,(352+$y)/$z,(196+$x)/$z,(352+$y)/$z,(193+$x)/$z,(354+$y)/$z,(191+$x)/$z,(352+$y)/$z,(187+$x)/$z,(350+$y)/$z,(186+$x)/$z,(353+$y)/$z,(183+$x)/$z,(348+$y)/$z,(182+$x)/$z,(333+$y)/$z,(183+$x)/$z,(327+$y)/$z,(187+$x)/$z,(322+$y)/$z,(194+$x)/$z,(314+$y)/$z,(203+$x)/$z,(309+$y)/$z,(210+$x)/$z,(302+$y)/$z,(215+$x)/$z,(293+$y)/$z,(222+$x)/$z,(281+$y)/$z,(227+$x)/$z,(268+$y)/$z,(231+$x)/$z,(279+$y)/$z,(231+$x)/$z,(308+$y)/$z,(229+$x)/$z,(322+$y)/$z,(237+$x)/$z,(322+$y)/$z,(240+$x)/$z,(320+$y)/$z,(247+$x)/$z,(325+$y)/$z,(252+$x)/$z,(313+$y)/$z,(256+$x)/$z,(308+$y)/$z,(262+$x)/$z,(302+$y)/$z,(266+$x)/$z,(289+$y)/$z,(252+$x)/$z,(272+$y)/$z,(242+$x)/$z,(252+$y)/$z,(245+$x)/$z,(250+$y)/$z,(245+$x)/$z,(243+$y)/$z,(240+$x)/$z,(241+$y)/$z,(239+$x)/$z,(226+$y)/$z,(233+$x)/$z,(219+$y)/$z,(227+$x)/$z,(219+$y)/$z,(218+$x)/$z,(217+$y)/$z,(215+$x)/$z,(220+$y)/$z,(217+$x)/$z,(230+$y)/$z,(212+$x)/$z,(240+$y)/$z,(214+$x)/$z,(255+$y)/$z,(214+$x)/$z,(255+$y)/$z,(201+$x)/$z,(263+$y)/$z,(194+$x)/$z,(258+$y)/$z,(188+$x)/$z,(260+$y)/$z,(185+$x)/$z,(256+$y)/$z,(184+$x)/$z,(251+$y)/$z,(177+$x)/$z,(248+$y)/$z,(174+$x)/$z,(243+$y)/$z,(164+$x)/$z,(249+$y)/$z,(155+$x)/$z,(259+$y)/$z,(157+$x)/$z,(264+$y)/$z,(152+$x)/$z,(269+$y)/$z,(145+$x)/$z,(277+$y)/$z,(138+$x)/$z,(282+$y)/$z,(133+$x)/$z,(279+$y)/$z,(129+$x)/$z,(280+$y)/$z,(128+$x)/$z,(283+$y)/$z,(128+$x)/$z,(288+$y)/$z,(129+$x)/$z,(297+$y)/$z,(132+$x)/$z,(299+$y)/$z,(127+$x)/$z,(303+$y)/$z,(127+$x)/$z,(311+$y)/$z,(131+$x)/$z,(310+$y)/$z,(133+$x)/$z,(313+$y)/$z,(137+$x)/$z,(311+$y)/$z,(143+$x)/$z,(315+$y)/$z),'FD');
		//dairas messaad//1-mesaad//2-deldoul//3-selmana//4-sedrahal//5-getara
		$this->color($data['11']);$this->Polygon(array((290+$x)/$z,(465+$y)/$z,(311+$x)/$z,(474+$y)/$z,(328+$x)/$z,(481+$y)/$z,(345+$x)/$z,(492+$y)/$z,(373+$x)/$z,(520+$y)/$z,(380+$x)/$z,(535+$y)/$z,(389+$x)/$z,(544+$y)/$z,(392+$x)/$z,(555+$y)/$z,(400+$x)/$z,(567+$y)/$z,(485+$x)/$z,(590+$y)/$z,(473+$x)/$z,(522+$y)/$z,(443+$x)/$z,(525+$y)/$z,(422+$x)/$z,(510+$y)/$z,(381+$x)/$z,(472+$y)/$z,(360+$x)/$z,(480+$y)/$z,(325+$x)/$z,(430+$y)/$z,(337+$x)/$z,(427+$y)/$z,(327+$x)/$z,(411+$y)/$z,(302+$x)/$z,(371+$y)/$z,(312+$x)/$z,(360+$y)/$z,(308+$x)/$z,(358+$y)/$z,(307+$x)/$z,(352+$y)/$z,(303+$x)/$z,(344+$y)/$z,(303+$x)/$z,(338+$y)/$z,(293+$x)/$z,(328+$y)/$z,(292+$x)/$z,(320+$y)/$z,(284+$x)/$z,(306+$y)/$z,(277+$x)/$z,(303+$y)/$z,(277+$x)/$z,(299+$y)/$z,(266+$x)/$z,(289+$y)/$z,(262+$x)/$z,(302+$y)/$z,(256+$x)/$z,(308+$y)/$z,(252+$x)/$z,(313+$y)/$z,(247+$x)/$z,(325+$y)/$z,(240+$x)/$z,(320+$y)/$z,(237+$x)/$z,(322+$y)/$z,(229+$x)/$z,(322+$y)/$z,(231+$x)/$z,(308+$y)/$z,(231+$x)/$z,(279+$y)/$z,(227+$x)/$z,(268+$y)/$z,(222+$x)/$z,(281+$y)/$z,(215+$x)/$z,(293+$y)/$z,(210+$x)/$z,(302+$y)/$z,(203+$x)/$z,(309+$y)/$z,(194+$x)/$z,(314+$y)/$z,(187+$x)/$z,(322+$y)/$z,(183+$x)/$z,(327+$y)/$z,(182+$x)/$z,(333+$y)/$z,(183+$x)/$z,(348+$y)/$z,(186+$x)/$z,(353+$y)/$z,(187+$x)/$z,(350+$y)/$z,(191+$x)/$z,(352+$y)/$z,(193+$x)/$z,(354+$y)/$z,(196+$x)/$z,(352+$y)/$z,(199+$x)/$z,(352+$y)/$z,(197+$x)/$z,(360+$y)/$z,(186+$x)/$z,(368+$y)/$z,(192+$x)/$z,(393+$y)/$z,(197+$x)/$z,(397+$y)/$z,(197+$x)/$z,(403+$y)/$z,(213+$x)/$z,(404+$y)/$z,(228+$x)/$z,(412+$y)/$z,(241+$x)/$z,(419+$y)/$z,(254+$x)/$z,(432+$y)/$z,(267+$x)/$z,(446+$y)/$z,(275+$x)/$z,(461+$y)/$z,(290+$x)/$z,(465+$y)/$z),'FD');
		//dairas faid boutma//1-faid boutma//2-amoura//3-oumeladam
		$this->color($data['12']);$this->Polygon(array((306+$x)/$z,(247+$y)/$z,(288+$x)/$z,(248+$y)/$z,(283+$x)/$z,(250+$y)/$z,(279+$x)/$z,(247+$y)/$z,(276+$x)/$z,(242+$y)/$z,(271+$x)/$z,(240+$y)/$z,(268+$x)/$z,(243+$y)/$z,(269+$x)/$z,(248+$y)/$z,(274+$x)/$z,(250+$y)/$z,(272+$x)/$z,(255+$y)/$z,(258+$x)/$z,(244+$y)/$z,(251+$x)/$z,(246+$y)/$z,(249+$x)/$z,(250+$y)/$z,(245+$x)/$z,(250+$y)/$z,(242+$x)/$z,(252+$y)/$z,(252+$x)/$z,(272+$y)/$z,(266+$x)/$z,(289+$y)/$z,(277+$x)/$z,(299+$y)/$z,(277+$x)/$z,(303+$y)/$z,(284+$x)/$z,(306+$y)/$z,(292+$x)/$z,(320+$y)/$z,(293+$x)/$z,(328+$y)/$z,(303+$x)/$z,(338+$y)/$z,(303+$x)/$z,(344+$y)/$z,(307+$x)/$z,(352+$y)/$z,(308+$x)/$z,(358+$y)/$z,(312+$x)/$z,(360+$y)/$z,(302+$x)/$z,(371+$y)/$z,(327+$x)/$z,(411+$y)/$z,(337+$x)/$z,(427+$y)/$z,(325+$x)/$z,(430+$y)/$z,(360+$x)/$z,(480+$y)/$z,(381+$x)/$z,(472+$y)/$z,(422+$x)/$z,(510+$y)/$z,(443+$x)/$z,(525+$y)/$z,(473+$x)/$z,(522+$y)/$z,(473+$x)/$z,(498+$y)/$z,(489+$x)/$z,(463+$y)/$z,(486+$x)/$z,(449+$y)/$z,(493+$x)/$z,(442+$y)/$z,(473+$x)/$z,(434+$y)/$z,(462+$x)/$z,(434+$y)/$z,(458+$x)/$z,(424+$y)/$z,(443+$x)/$z,(425+$y)/$z,(439+$x)/$z,(418+$y)/$z,(435+$x)/$z,(420+$y)/$z,(432+$x)/$z,(416+$y)/$z,(419+$x)/$z,(416+$y)/$z,(416+$x)/$z,(414+$y)/$z,(411+$x)/$z,(405+$y)/$z,(407+$x)/$z,(402+$y)/$z,(398+$x)/$z,(398+$y)/$z,(384+$x)/$z,(395+$y)/$z,(378+$x)/$z,(389+$y)/$z,(364+$x)/$z,(384+$y)/$z,(356+$x)/$z,(378+$y)/$z,(356+$x)/$z,(374+$y)/$z,(369+$x)/$z,(373+$y)/$z,(379+$x)/$z,(360+$y)/$z,(388+$x)/$z,(360+$y)/$z,(386+$x)/$z,(353+$y)/$z,(372+$x)/$z,(354+$y)/$z,(366+$x)/$z,(349+$y)/$z,(367+$x)/$z,(342+$y)/$z,(364+$x)/$z,(338+$y)/$z,(359+$x)/$z,(338+$y)/$z,(358+$x)/$z,(335+$y)/$z,(349+$x)/$z,(338+$y)/$z,(348+$x)/$z,(332+$y)/$z,(343+$x)/$z,(329+$y)/$z,(348+$x)/$z,(323+$y)/$z,(342+$x)/$z,(322+$y)/$z,(342+$x)/$z,(317+$y)/$z,(337+$x)/$z,(317+$y)/$z,(340+$x)/$z,(312+$y)/$z,(331+$x)/$z,(308+$y)/$z,(329+$x)/$z,(302+$y)/$z,(324+$x)/$z,(302+$y)/$z,(316+$x)/$z,(298+$y)/$z,(317+$x)/$z,(280+$y)/$z,(306+$x)/$z,(247+$y)/$z),'FD');
	}
	if ($cd=='commune')
	{
	//A-ain-oussera
		//dairas ain-oussera
		    $this->color($data['1']);$this->Polygon(array((130+$x)/$z,(58+$y)/$z,(135+$x)/$z,(62+$y)/$z,(127+$x)/$z,(76+$y)/$z,(119+$x)/$z,(80+$y)/$z,(119+$x)/$z,(85+$y)/$z,(123+$x)/$z,(86+$y)/$z,(126+$x)/$z,(82+$y)/$z,(139+$x)/$z,(82+$y)/$z,(138+$x)/$z,(90+$y)/$z,(133+$x)/$z,(93+$y)/$z,(122+$x)/$z,(111+$y)/$z,(122+$x)/$z,(111+$y)/$z,(111+$x)/$z,(123+$y)/$z,(109+$x)/$z,(131+$y)/$z,(113+$x)/$z,(135+$y)/$z,(107+$x)/$z,(136+$y)/$z,(98+$x)/$z,(153+$y)/$z,(108+$x)/$z,(163+$y)/$z,(132+$x)/$z,(155+$y)/$z,(141+$x)/$z,(148+$y)/$z,(154+$x)/$z,(144+$y)/$z,(154+$x)/$z,(136+$y)/$z,(154+$x)/$z,(136+$y)/$z,(162+$x)/$z,(127+$y)/$z,(161+$x)/$z,(123+$y)/$z,(164+$x)/$z,(117+$y)/$z,(158+$x)/$z,(116+$y)/$z,(155+$x)/$z,(87+$y)/$z,(160+$x)/$z,(83+$y)/$z,(160+$x)/$z,(78+$y)/$z ,(155+$x)/$z,(78+$y)/$z,(150+$x)/$z,(82+$y)/$z,(150+$x)/$z,(11+$y)/$z,(145+$x)/$z,(8+$y)/$z,(143+$x)/$z,(14+$y)/$z,(145+$x)/$z,(22+$y)/$z,(143+$x)/$z,(28+$y)/$z,(147+$x)/$z,(33+$y)/$z,(147+$x)/$z,(44+$y)/$z,(142+$x)/$z,(48+$y)/$z,(137+$x)/$z,(53+$y)/$z,(130+$x)/$z,(58+$y)/$z),'FD');	
			//1-ain-oussera
			$this->color($data['924']);$this->Polygon(array((130+$x)/$z,(58+$y)/$z,(135+$x)/$z,(62+$y)/$z,(127+$x)/$z,(76+$y)/$z,(119+$x)/$z,(80+$y)/$z,(119+$x)/$z,(85+$y)/$z,(123+$x)/$z,(86+$y)/$z,(126+$x)/$z,(82+$y)/$z,(139+$x)/$z,(82+$y)/$z,(138+$x)/$z,(90+$y)/$z,(133+$x)/$z,(93+$y)/$z,(122+$x)/$z,(111+$y)/$z,(154+$x)/$z,(136+$y)/$z,(162+$x)/$z,(127+$y)/$z,(161+$x)/$z,(123+$y)/$z,(164+$x)/$z,(117+$y)/$z,(158+$x)/$z,(116+$y)/$z,(155+$x)/$z,(87+$y)/$z,(160+$x)/$z,(83+$y)/$z,(160+$x)/$z,(78+$y)/$z ,(155+$x)/$z,(78+$y)/$z,(150+$x)/$z,(82+$y)/$z,(150+$x)/$z,(11+$y)/$z,(145+$x)/$z,(8+$y)/$z,(143+$x)/$z,(14+$y)/$z,(145+$x)/$z,(22+$y)/$z,(143+$x)/$z,(28+$y)/$z,(147+$x)/$z,(33+$y)/$z,(147+$x)/$z,(44+$y)/$z,(142+$x)/$z,(48+$y)/$z,(137+$x)/$z,(53+$y)/$z,(130+$x)/$z,(58+$y)/$z),'FD');
			//2-guernini
			$this->color($data['925']);$this->Polygon(array((111+$x)/$z,(123+$y)/$z,(109+$x)/$z,(131+$y)/$z,(113+$x)/$z,(135+$y)/$z,(107+$x)/$z,(136+$y)/$z,(98+$x)/$z,(153+$y)/$z,(108+$x)/$z,(163+$y)/$z,(132+$x)/$z,(155+$y)/$z,(141+$x)/$z,(148+$y)/$z,(154+$x)/$z,(144+$y)/$z,(154+$x)/$z,(136+$y)/$z,(122+$x)/$z,(111+$y)/$z,(111+$x)/$z,(123+$y)/$z),'FD');
		//dairas birin
			//1-birine
			$this->color($data['929']);$this->Polygon(array((173+$x)/$z,(50+$y)/$z,(188+$x)/$z,(64+$y)/$z,(193+$x)/$z,(64+$y)/$z,(194+$x)/$z,(78+$y)/$z,(204+$x)/$z,(75+$y)/$z,(224+$x)/$z,(68+$y)/$z,(243+$x)/$z,(53+$y)/$z,(221+$x)/$z,(30+$y)/$z,(220+$x)/$z,(22+$y)/$z,(212+$x)/$z,(22+$y)/$z,(207+$x)/$z,(14+$y)/$z,(205+$x)/$z,(9+$y)/$z,(198+$x)/$z,(14+$y)/$z ,(197+$x)/$z,(25+$y)/$z ,(191+$x)/$z,(36+$y)/$z,(185+$x)/$z,(36+$y)/$z,(181+$x)/$z,(38+$y)/$z,(173+$x)/$z,(50+$y)/$z),'FD');
			//2-benahar
			$this->color($data['931']);$this->Polygon(array((150+$x)/$z,(11+$y)/$z,(150+$x)/$z,(82+$y)/$z,(155+$x)/$z,(78+$y)/$z,(160+$x)/$z,(78+$y)/$z,(160+$x)/$z,(83+$y)/$z,(155+$x)/$z,(87+$y)/$z,(158+$x)/$z,(116+$y)/$z,(164+$x)/$z,(117+$y)/$z,(161+$x)/$z,(123+$y)/$z,(162+$x)/$z,(127+$y)/$z,(172+$x)/$z,(123+$y)/$z,(179+$x)/$z,(119+$y)/$z,(191+$x)/$z,(105+$y)/$z,(200+$x)/$z,(98+$y)/$z,(194+$x)/$z,(78+$y)/$z,(193+$x)/$z,(64+$y)/$z,(188+$x)/$z,(64+$y)/$z,(173+$x)/$z,(50+$y)/$z,(172+$x)/$z,(38+$y)/$z,(170+$x)/$z,(25+$y)/$z,(165+$x)/$z,(23+$y)/$z,(161+$x)/$z,(6+$y)/$z,(150+$x)/$z,(11+$y)/$z),'FD');
		//dairas sidilaadjel
			//1-sidilaadjel
			$this->color($data['926']);$this->Polygon(array((68+$x)/$z,(78+$y)/$z,(69+$x)/$z,(91+$y)/$z,(59+$x)/$z,(106+$y)/$z,(70+$x)/$z,(120+$y)/$z,(89+$x)/$z,(103+$y)/$z,(101+$x)/$z,(81+$y)/$z,(87+$x)/$z,(70+$y)/$z,(68+$x)/$z,(78+$y)/$z),'FD');
			//2-hassifedoul
			$this->color($data['927']);$this->Polygon(array((11+$x)/$z,(64+$y)/$z,(48+$x)/$z,(60+$y)/$z,(50+$x)/$z,(80+$y)/$z,(68+$x)/$z,(78+$y)/$z,(69+$x)/$z,(91+$y)/$z,(59+$x)/$z,(106+$y)/$z,(44+$x)/$z,(102+$y)/$z,(11+$x)/$z,(76+$y)/$z,(11+$x)/$z,(64+$y)/$z),'FD');
			//3-elkhamiss
			$this->color($data['928']);$this->Polygon(array((101+$x)/$z,(81+$y)/$z,(89+$x)/$z,(103+$y)/$z,(97+$x)/$z,(110+$y)/$z,(98+$x)/$z,(119+$y)/$z,(111+$x)/$z,(123+$y)/$z,(122+$x)/$z,(111+$y)/$z,(133+$x)/$z,(93+$y)/$z,(138+$x)/$z,(90+$y)/$z,(139+$x)/$z,(82+$y)/$z,(126+$x)/$z,(82+$y)/$z,(123+$x)/$z,(86+$y)/$z,(119+$x)/$z,(85+$y)/$z,(119+$x)/$z,(80+$y)/$z,(127+$x)/$z,(76+$y)/$z,(135+$x)/$z,(62+$y)/$z,(130+$x)/$z,(58+$y)/$z,(120+$x)/$z,(70+$y)/$z,(119+$x)/$z,(77+$y)/$z,(114+$x)/$z,(77+$y)/$z,(109+$x)/$z,(82+$y)/$z,(101+$x)/$z,(81+$y)/$z),'FD');	
		//dairas had-sahari
			//1-had-sahari
			$this->color($data['932']);$this->Polygon(array((191+$x)/$z,(105+$y)/$z,(198+$x)/$z,(112+$y)/$z,(200+$x)/$z,(133+$y)/$z,(207+$x)/$z,(130+$y)/$z,(216+$x)/$z,(132+$y)/$z,(228+$x)/$z,(132+$y)/$z,(234+$x)/$z,(137+$y)/$z,(254+$x)/$z,(117+$y)/$z,(256+$x)/$z,(118+$y)/$z,(248+$x)/$z,(105+$y)/$z,(237+$x)/$z,(100+$y)/$z,(224+$x)/$z,(68+$y)/$z,(204+$x)/$z,(75+$y)/$z,(194+$x)/$z,(78+$y)/$z,(194+$x)/$z,(78+$y)/$z,(200+$x)/$z,(98+$y)/$z,(191+$x)/$z,(105+$y)/$z),'FD');
			//2-ainfaka
			$this->color($data['934']);$this->Polygon(array((243+$x)/$z,(53+$y)/$z,(224+$x)/$z,(68+$y)/$z,(237+$x)/$z,(100+$y)/$z,(248+$x)/$z,(105+$y)/$z,(256+$x)/$z,(118+$y)/$z,(266+$x)/$z,(108+$y)/$z,(263+$x)/$z,(92+$y)/$z,(269+$x)/$z,(89+$y)/$z,(270+$x)/$z,(74+$y)/$z,(243+$x)/$z,(53+$y)/$z),'FD');
			//3-bouiratlahdab
			$this->color($data['933']);$this->Polygon(array((154+$x)/$z,(136+$y)/$z,(154+$x)/$z,(144+$y)/$z,(163+$x)/$z,(145+$y)/$z,(170+$x)/$z,(149+$y)/$z,(177+$x)/$z,(150+$y)/$z,(200+$x)/$z,(133+$y)/$z,(198+$x)/$z,(112+$y)/$z,(191+$x)/$z,(105+$y)/$z,(179+$x)/$z,(119+$y)/$z,(172+$x)/$z,(123+$y)/$z,(162+$x)/$z,(127+$y)/$z,(154+$x)/$z,(136+$y)/$z),'FD');
	//B-hassi-bahbah  
		//dairas hassi-bahbah
			//1-hassi-bahbah
			$this->color($data['935']);$this->Polygon(array((108+$x)/$z,(163+$y)/$z,(113+$x)/$z,(171+$y)/$z,(124+$x)/$z,(171+$y)/$z,(125+$x)/$z,(180+$y)/$z,(139+$x)/$z,(181+$y)/$z,(152+$x)/$z,(185+$y)/$z,(157+$x)/$z,(195+$y)/$z,(159+$x)/$z,(200+$y)/$z,(176+$x)/$z,(192+$y)/$z,(181+$x)/$z,(188+$y)/$z,(179+$x)/$z,(183+$y)/$z,(185+$x)/$z,(181+$y)/$z,(191+$x)/$z,(177+$y)/$z,(184+$x)/$z,(173+$y)/$z,(187+$x)/$z,(170+$y)/$z,(181+$x)/$z,(163+$y)/$z,(177+$x)/$z,(156+$y)/$z,(177+$x)/$z,(150+$y)/$z,(170+$x)/$z,(149+$y)/$z,(163+$x)/$z,(145+$y)/$z,(154+$x)/$z,(144+$y)/$z,(141+$x)/$z,(148+$y)/$z,(132+$x)/$z,(155+$y)/$z,(108+$x)/$z,(163+$y)/$z),'FD');
			//2-zaafrane
			$this->color($data['939']);$this->Polygon(array((108+$x)/$z,(163+$y)/$z,(102+$x)/$z,(167+$y)/$z,(89+$x)/$z,(168+$y)/$z,(85+$x)/$z,(172+$y)/$z,(81+$x)/$z,(193+$y)/$z,(114+$x)/$z,(198+$y)/$z,(118+$x)/$z,(196+$y)/$z,(123+$x)/$z,(196+$y)/$z,(127+$x)/$z,(204+$y)/$z,(128+$x)/$z,(215+$y)/$z,(133+$x)/$z,(221+$y)/$z,(138+$x)/$z,(222+$y)/$z,(139+$x)/$z,(232+$y)/$z,(142+$x)/$z,(237+$y)/$z,(141+$x)/$z,(242+$y)/$z,(145+$x)/$z,(245+$y)/$z,(142+$x)/$z,(256+$y)/$z,(155+$x)/$z,(259+$y)/$z,(164+$x)/$z,(249+$y)/$z,(174+$x)/$z,(243+$y)/$z,(173+$x)/$z,(227+$y)/$z,(164+$x)/$z,(223+$y)/$z,(170+$x)/$z,(214+$y)/$z,(159+$x)/$z,(200+$y)/$z,(157+$x)/$z,(195+$y)/$z,(152+$x)/$z,(185+$y)/$z,(139+$x)/$z,(181+$y)/$z,(125+$x)/$z,(180+$y)/$z,(124+$x)/$z,(171+$y)/$z,(113+$x)/$z,(171+$y)/$z,(108+$x)/$z,(163+$y)/$z),'FD');
			//3-eleuch
			$this->color($data['940']);$this->Polygon(array((177+$x)/$z,(150+$y)/$z,(177+$x)/$z,(156+$y)/$z,(181+$x)/$z,(163+$y)/$z,(187+$x)/$z,(170+$y)/$z,(184+$x)/$z,(173+$y)/$z,(191+$x)/$z,(177+$y)/$z,(214+$x)/$z,(164+$y)/$z,(222+$x)/$z,(164+$y)/$z,(222+$x)/$z,(150+$y)/$z,(233+$x)/$z,(137+$y)/$z,(228+$x)/$z,(132+$y)/$z,(216+$x)/$z,(132+$y)/$z,(207+$x)/$z,(130+$y)/$z,(200+$x)/$z,(133+$y)/$z,(177+$x)/$z,(150+$y)/$z),'FD');
			//4-ainmaabed
			$this->color($data['941']);$this->Polygon(array((217+$x)/$z,(197+$y)/$z,(207+$x)/$z,(194+$y)/$z,(203+$x)/$z,(183+$y)/$z,(197+$x)/$z,(183+$y)/$z,(191+$x)/$z,(177+$y)/$z,(185+$x)/$z,(181+$y)/$z,(179+$x)/$z,(183+$y)/$z,(181+$x)/$z,(188+$y)/$z,(176+$x)/$z,(192+$y)/$z,(159+$x)/$z,(200+$y)/$z,(170+$x)/$z,(214+$y)/$z,(164+$x)/$z,(223+$y)/$z,(173+$x)/$z,(227+$y)/$z,(178+$x)/$z,(224+$y)/$z,(183+$x)/$z,(223+$y)/$z,(189+$x)/$z,(223+$y)/$z,(189+$x)/$z,(217+$y)/$z,(193+$x)/$z,(212+$y)/$z,(201+$x)/$z,(210+$y)/$z,(205+$x)/$z,(208+$y)/$z,(217+$x)/$z,(197+$y)/$z),'FD');
		//dairas darchioukh
			//1-darchioukh
			$this->color($data['942']);$this->Polygon(array((205+$x)/$z,(208+$y)/$z,(211+$x)/$z,(218+$y)/$z,(218+$x)/$z,(217+$y)/$z,(221+$x)/$z,(211+$y)/$z,(227+$x)/$z,(208+$y)/$z,(237+$x)/$z,(208+$y)/$z,(240+$x)/$z,(201+$y)/$z,(248+$x)/$z,(198+$y)/$z,(254+$x)/$z,(194+$y)/$z,(252+$x)/$z,(186+$y)/$z,(249+$x)/$z,(182+$y)/$z,(253+$x)/$z,(180+$y)/$z,(250+$x)/$z,(165+$y)/$z,(226+$x)/$z,(187+$y)/$z,(226+$x)/$z,(194+$y)/$z,(217+$x)/$z,(197+$y)/$z,(205+$x)/$z,(208+$y)/$z),'FD');
			//2-mliliha
			$this->color($data['946']);$this->Polygon(array((254+$x)/$z,(194+$y)/$z,(248+$x)/$z,(198+$y)/$z,(240+$x)/$z,(201+$y)/$z,(237+$x)/$z,(208+$y)/$z,(227+$x)/$z,(208+$y)/$z,(221+$x)/$z,(211+$y)/$z,(218+$x)/$z,(217+$y)/$z,(227+$x)/$z,(219+$y)/$z,(233+$x)/$z,(219+$y)/$z,(239+$x)/$z,(226+$y)/$z,(240+$x)/$z,(241+$y)/$z,(245+$x)/$z,(243+$y)/$z,(245+$x)/$z,(250+$y)/$z,(249+$x)/$z,(250+$y)/$z,(251+$x)/$z,(246+$y)/$z,(258+$x)/$z,(244+$y)/$z,(272+$x)/$z,(255+$y)/$z,(274+$x)/$z,(250+$y)/$z,(269+$x)/$z,(248+$y)/$z,(268+$x)/$z,(243+$y)/$z,(271+$x)/$z,(240+$y)/$z,(276+$x)/$z,(242+$y)/$z,(279+$x)/$z,(247+$y)/$z,(283+$x)/$z,(250+$y)/$z,(288+$x)/$z,(248+$y)/$z,(306+$x)/$z,(247+$y)/$z,(306+$x)/$z,(243+$y)/$z,(302+$x)/$z,(240+$y)/$z,(301+$x)/$z,(214+$y)/$z,(276+$x)/$z,(212+$y)/$z,(272+$x)/$z,(206+$y)/$z,(265+$x)/$z,(211+$y)/$z,(262+$x)/$z,(204+$y)/$z,(261+$x)/$z,(197+$y)/$z,(254+$x)/$z,(194+$y)/$z),'FD');
			//3-sidibayzid
			$this->color($data['947']);$this->Polygon(array((233+$x)/$z,(137+$y)/$z,(222+$x)/$z,(150+$y)/$z,(222+$x)/$z,(164+$y)/$z,(214+$x)/$z,(164+$y)/$z,(191+$x)/$z,(177+$y)/$z,(197+$x)/$z,(183+$y)/$z,(203+$x)/$z,(183+$y)/$z,(207+$x)/$z,(194+$y)/$z,(217+$x)/$z,(197+$y)/$z,(226+$x)/$z,(194+$y)/$z,(226+$x)/$z,(187+$y)/$z,(250+$x)/$z,(165+$y)/$z,(255+$x)/$z,(154+$y)/$z,(248+$x)/$z,(159+$y)/$z,(233+$x)/$z,(137+$y)/$z),'FD');
	//C-djelfa
		//djelfa
		$this->color($data['916']);$this->Polygon(array((173+$x)/$z,(227+$y)/$z,(174+$x)/$z,(243+$y)/$z,(177+$x)/$z,(248+$y)/$z,(184+$x)/$z,(251+$y)/$z,(185+$x)/$z,(256+$y)/$z,(188+$x)/$z,(260+$y)/$z,(194+$x)/$z,(258+$y)/$z,(201+$x)/$z,(263+$y)/$z,(214+$x)/$z,(255+$y)/$z,(212+$x)/$z,(240+$y)/$z,(217+$x)/$z,(230+$y)/$z,(215+$x)/$z,(220+$y)/$z,(218+$x)/$z,(217+$y)/$z,(211+$x)/$z,(218+$y)/$z,(205+$x)/$z,(208+$y)/$z,(201+$x)/$z,(210+$y)/$z,(193+$x)/$z,(212+$y)/$z,(189+$x)/$z,(217+$y)/$z,(189+$x)/$z,(223+$y)/$z,(183+$x)/$z,(223+$y)/$z,(178+$x)/$z,(224+$y)/$z,(173+$x)/$z,(227+$y)/$z),'FD');
		//dairas idrissia
			//1-idrissia
			$this->color($data['917']);$this->Polygon(array((67+$x)/$z,(278+$y)/$z,(72+$x)/$z,(289+$y)/$z,(77+$x)/$z,(305+$y)/$z,(88+$x)/$z,(304+$y)/$z,(92+$x)/$z,(300+$y)/$z,(110+$x)/$z,(289+$y)/$z,(100+$x)/$z,(285+$y)/$z,(100+$x)/$z,(280+$y)/$z,(106+$x)/$z,(277+$y)/$z,(107+$x)/$z,(273+$y)/$z,(101+$x)/$z,(273+$y)/$z,(95+$x)/$z,(269+$y)/$z,(96+$x)/$z,(261+$y)/$z,(78+$x)/$z,(265+$y)/$z,(77+$x)/$z,(275+$y)/$z,(67+$x)/$z,(278+$y)/$z),'FD');
			//2-douisse
			$this->color($data['963']);$this->Polygon(array((111+$x)/$z,(343+$y)/$z,(118+$x)/$z,(344+$y)/$z,(126+$x)/$z,(338+$y)/$z,(134+$x)/$z,(339+$y)/$z,(132+$x)/$z,(332+$y)/$z,(143+$x)/$z,(315+$y)/$z,(137+$x)/$z,(311+$y)/$z,(133+$x)/$z,(313+$y)/$z,(131+$x)/$z,(310+$y)/$z,(127+$x)/$z,(311+$y)/$z,(127+$x)/$z,(303+$y)/$z,(132+$x)/$z,(299+$y)/$z,(129+$x)/$z,(297+$y)/$z,(128+$x)/$z,(288+$y)/$z,(123+$x)/$z,(288+$y)/$z,(115+$x)/$z,(285+$y)/$z,(110+$x)/$z,(289+$y)/$z,(92+$x)/$z,(300+$y)/$z,(95+$x)/$z,(304+$y)/$z,(101+$x)/$z,(306+$y)/$z,(106+$x)/$z,(307+$y)/$z,(105+$x)/$z,(318+$y)/$z,(105+$x)/$z,(329+$y)/$z,(108+$x)/$z,(332+$y)/$z,(111+$x)/$z,(343+$y)/$z),'FD');
			//3-ainchouhadda
			$this->color($data['964']);$this->Polygon(array((77+$x)/$z,(305+$y)/$z,(85+$x)/$z,(320+$y)/$z,(91+$x)/$z,(325+$y)/$z,(93+$x)/$z,(333+$y)/$z,(100+$x)/$z,(334+$y)/$z,(102+$x)/$z,(339+$y)/$z,(107+$x)/$z,(343+$y)/$z,(111+$x)/$z,(343+$y)/$z,(108+$x)/$z,(332+$y)/$z,(105+$x)/$z,(329+$y)/$z,(105+$x)/$z,(318+$y)/$z,(106+$x)/$z,(307+$y)/$z,(101+$x)/$z,(306+$y)/$z,(95+$x)/$z,(304+$y)/$z,(92+$x)/$z,(300+$y)/$z,(88+$x)/$z,(304+$y)/$z,(77+$x)/$z,(305+$y)/$z),'FD');
		//dairas charef
			//1-charef
			$this->color($data['920']);$this->Polygon(array((110+$x)/$z,(289+$y)/$z,(115+$x)/$z,(285+$y)/$z,(115+$x)/$z,(279+$y)/$z,(121+$x)/$z,(272+$y)/$z,(137+$x)/$z,(263+$y)/$z,(142+$x)/$z,(256+$y)/$z,(145+$x)/$z,(245+$y)/$z,(141+$x)/$z,(242+$y)/$z,(142+$x)/$z,(237+$y)/$z,(139+$x)/$z,(232+$y)/$z,(138+$x)/$z,(222+$y)/$z,(133+$x)/$z,(221+$y)/$z,(128+$x)/$z,(215+$y)/$z,(118+$x)/$z,(228+$y)/$z,(113+$x)/$z,(239+$y)/$z,(96+$x)/$z,(253+$y)/$z,(96+$x)/$z,(261+$y)/$z,(95+$x)/$z,(269+$y)/$z,(101+$x)/$z,(273+$y)/$z,(107+$x)/$z,(273+$y)/$z,(106+$x)/$z,(277+$y)/$z,(100+$x)/$z,(280+$y)/$z,(100+$x)/$z,(285+$y)/$z,(110+$x)/$z,(289+$y)/$z),'FD');
			//2-guedid
			$this->color($data['919']);$this->Polygon(array((81+$x)/$z,(193+$y)/$z,(74+$x)/$z,(209+$y)/$z,(62+$x)/$z,(211+$y)/$z,(65+$x)/$z,(227+$y)/$z,(67+$x)/$z,(278+$y)/$z,(77+$x)/$z,(275+$y)/$z,(78+$x)/$z,(265+$y)/$z,(96+$x)/$z,(261+$y)/$z,(96+$x)/$z,(253+$y)/$z,(113+$x)/$z,(239+$y)/$z,(118+$x)/$z,(228+$y)/$z,(128+$x)/$z,(215+$y)/$z,(127+$x)/$z,(204+$y)/$z,(123+$x)/$z,(196+$y)/$z,(118+$x)/$z,(196+$y)/$z,(114+$x)/$z,(198+$y)/$z,(81+$x)/$z,(193+$y)/$z),'FD');
			//3-benyaagoub
			$this->color($data['923']);$this->Polygon(array((115+$x)/$z,(285+$y)/$z,(123+$x)/$z,(288+$y)/$z,(128+$x)/$z,(288+$y)/$z,(128+$x)/$z,(283+$y)/$z,(129+$x)/$z,(280+$y)/$z,(133+$x)/$z,(279+$y)/$z,(138+$x)/$z,(282+$y)/$z,(145+$x)/$z,(277+$y)/$z,(152+$x)/$z,(269+$y)/$z,(157+$x)/$z,(264+$y)/$z,(155+$x)/$z,(259+$y)/$z,(142+$x)/$z,(256+$y)/$z,(137+$x)/$z,(263+$y)/$z,(121+$x)/$z,(272+$y)/$z,(115+$x)/$z,(279+$y)/$z,(115+$x)/$z,(285+$y)/$z),'FD');
		//dairas ainelbel
			//1-ainelbel
			$this->color($data['958']);$this->Polygon(array((155+$x)/$z,(259+$y)/$z,(157+$x)/$z,(264+$y)/$z,(162+$x)/$z,(261+$y)/$z,(170+$x)/$z,(260+$y)/$z,(175+$x)/$z,(254+$y)/$z,(180+$x)/$z,(257+$y)/$z,(180+$x)/$z,(265+$y)/$z,(180+$x)/$z,(280+$y)/$z,(176+$x)/$z,(281+$y)/$z,(177+$x)/$z,(289+$y)/$z,(181+$x)/$z,(293+$y)/$z,(181+$x)/$z,(299+$y)/$z,(177+$x)/$z,(302+$y)/$z,(177+$x)/$z,(307+$y)/$z,(187+$x)/$z,(322+$y)/$z,(194+$x)/$z,(314+$y)/$z,(203+$x)/$z,(309+$y)/$z,(210+$x)/$z,(302+$y)/$z,(207+$x)/$z,(296+$y)/$z,(209+$x)/$z,(291+$y)/$z,(206+$x)/$z,(283+$y)/$z,(200+$x)/$z,(282+$y)/$z,(201+$x)/$z,(277+$y)/$z,(211+$x)/$z,(273+$y)/$z,(212+$x)/$z,(259+$y)/$z,(214+$x)/$z,(255+$y)/$z,(201+$x)/$z,(263+$y)/$z,(194+$x)/$z,(258+$y)/$z,(188+$x)/$z,(260+$y)/$z,(185+$x)/$z,(256+$y)/$z,(184+$x)/$z,(251+$y)/$z,(177+$x)/$z,(248+$y)/$z,(174+$x)/$z,(243+$y)/$z,(164+$x)/$z,(249+$y)/$z,(155+$x)/$z,(259+$y)/$z),'FD');
			//2-moudjbara
			$this->color($data['957']);$this->Polygon(array((218+$x)/$z,(217+$y)/$z,(215+$x)/$z,(220+$y)/$z,(217+$x)/$z,(230+$y)/$z,(212+$x)/$z,(240+$y)/$z,(214+$x)/$z,(255+$y)/$z,(222+$x)/$z,(248+$y)/$z,(233+$x)/$z,(257+$y)/$z,(232+$x)/$z,(271+$y)/$z,(231+$x)/$z,(279+$y)/$z,(231+$x)/$z,(308+$y)/$z,(229+$x)/$z,(322+$y)/$z,(237+$x)/$z,(322+$y)/$z,(240+$x)/$z,(320+$y)/$z,(247+$x)/$z,(325+$y)/$z,(252+$x)/$z,(313+$y)/$z,(256+$x)/$z,(308+$y)/$z,(262+$x)/$z,(302+$y)/$z,(266+$x)/$z,(289+$y)/$z,(252+$x)/$z,(272+$y)/$z,(242+$x)/$z,(252+$y)/$z,(245+$x)/$z,(250+$y)/$z,(245+$x)/$z,(243+$y)/$z,(240+$x)/$z,(241+$y)/$z,(239+$x)/$z,(226+$y)/$z,(233+$x)/$z,(219+$y)/$z,(227+$x)/$z,(219+$y)/$z,(218+$x)/$z,(217+$y)/$z),'FD');
			//3-taadmit
			$this->color($data['965']);$this->Polygon(array((143+$x)/$z,(315+$y)/$z,(151+$x)/$z,(310+$y)/$z,(157+$x)/$z,(314+$y)/$z,(161+$x)/$z,(319+$y)/$z,(170+$x)/$z,(316+$y)/$z,(172+$x)/$z,(324+$y)/$z,(177+$x)/$z,(329+$y)/$z,(176+$x)/$z,(344+$y)/$z,(186+$x)/$z,(368+$y)/$z,(197+$x)/$z,(360+$y)/$z,(199+$x)/$z,(352+$y)/$z,(196+$x)/$z,(352+$y)/$z,(193+$x)/$z,(354+$y)/$z,(191+$x)/$z,(352+$y)/$z,(187+$x)/$z,(350+$y)/$z,(186+$x)/$z,(353+$y)/$z,(183+$x)/$z,(348+$y)/$z,(182+$x)/$z,(333+$y)/$z,(183+$x)/$z,(327+$y)/$z,(187+$x)/$z,(322+$y)/$z,(177+$x)/$z,(307+$y)/$z,(177+$x)/$z,(302+$y)/$z,(181+$x)/$z,(299+$y)/$z,(181+$x)/$z,(293+$y)/$z,(177+$x)/$z,(289+$y)/$z,(176+$x)/$z,(281+$y)/$z,(180+$x)/$z,(280+$y)/$z,(180+$x)/$z,(265+$y)/$z,(180+$x)/$z,(257+$y)/$z,(175+$x)/$z,(254+$y)/$z,(170+$x)/$z,(260+$y)/$z,(162+$x)/$z,(261+$y)/$z,(157+$x)/$z,(264+$y)/$z,(152+$x)/$z,(269+$y)/$z,(145+$x)/$z,(277+$y)/$z,(138+$x)/$z,(282+$y)/$z,(133+$x)/$z,(279+$y)/$z,(129+$x)/$z,(280+$y)/$z,(128+$x)/$z,(283+$y)/$z,(128+$x)/$z,(288+$y)/$z,(129+$x)/$z,(297+$y)/$z,(132+$x)/$z,(299+$y)/$z,(127+$x)/$z,(303+$y)/$z,(127+$x)/$z,(311+$y)/$z,(131+$x)/$z,(310+$y)/$z,(133+$x)/$z,(313+$y)/$z,(137+$x)/$z,(311+$y)/$z,(143+$x)/$z,(315+$y)/$z),'FD');
			//4-zakar
			$this->color($data['962']);$this->Polygon(array((214+$x)/$z,(255+$y)/$z,(212+$x)/$z,(259+$y)/$z,(211+$x)/$z,(273+$y)/$z,(201+$x)/$z,(277+$y)/$z,(200+$x)/$z,(282+$y)/$z,(206+$x)/$z,(283+$y)/$z,(209+$x)/$z,(291+$y)/$z,(207+$x)/$z,(296+$y)/$z,(210+$x)/$z,(302+$y)/$z,(215+$x)/$z,(293+$y)/$z,(222+$x)/$z,(281+$y)/$z,(227+$x)/$z,(268+$y)/$z,(231+$x)/$z,(279+$y)/$z,(232+$x)/$z,(271+$y)/$z,(233+$x)/$z,(257+$y)/$z,(222+$x)/$z,(248+$y)/$z,(214+$x)/$z,(255+$y)/$z),'FD');
	//D-mesaad
		//dairas messaad
			//1-mesaad
			$this->color($data['948']);$this->Polygon(array((247+$x)/$z,(325+$y)/$z,(251+$x)/$z,(333+$y)/$z,(252+$x)/$z,(342+$y)/$z,(249+$x)/$z,(346+$y)/$z,(246+$x)/$z,(349+$y)/$z,(242+$x)/$z,(352+$y)/$z,(240+$x)/$z,(346+$y)/$z,(234+$x)/$z,(340+$y)/$z,(230+$x)/$z,(334+$y)/$z,(229+$x)/$z,(322+$y)/$z,(237+$x)/$z,(322+$y)/$z,(240+$x)/$z,(320+$y)/$z,(247+$x)/$z,(325+$y)/$z),'FD');
			//2-deldoul
			$this->color($data['952']);$this->Polygon(array((301+$x)/$z,(446+$y)/$z,(314+$x)/$z,(429+$y)/$z,(264+$x)/$z,(395+$y)/$z,(262+$x)/$z,(389+$y)/$z,(250+$x)/$z,(380+$y)/$z,(242+$x)/$z,(352+$y)/$z,(240+$x)/$z,(346+$y)/$z,(234+$x)/$z,(340+$y)/$z,(230+$x)/$z,(334+$y)/$z,(229+$x)/$z,(322+$y)/$z,(231+$x)/$z,(308+$y)/$z,(231+$x)/$z,(279+$y)/$z,(227+$x)/$z,(268+$y)/$z,(222+$x)/$z,(281+$y)/$z,(215+$x)/$z,(293+$y)/$z,(210+$x)/$z,(302+$y)/$z,(203+$x)/$z,(309+$y)/$z,(194+$x)/$z,(314+$y)/$z,(187+$x)/$z,(322+$y)/$z,(183+$x)/$z,(327+$y)/$z,(182+$x)/$z,(333+$y)/$z,(183+$x)/$z,(348+$y)/$z,(186+$x)/$z,(353+$y)/$z,(187+$x)/$z,(350+$y)/$z,(191+$x)/$z,(352+$y)/$z,(193+$x)/$z,(354+$y)/$z,(196+$x)/$z,(352+$y)/$z,(199+$x)/$z,(352+$y)/$z,(197+$x)/$z,(360+$y)/$z,(186+$x)/$z,(368+$y)/$z,(197+$x)/$z,(372+$y)/$z,(203+$x)/$z,(372+$y)/$z,(207+$x)/$z,(370+$y)/$z,(211+$x)/$z,(372+$y)/$z,(216+$x)/$z,(380+$y)/$z,(223+$x)/$z,(381+$y)/$z,(237+$x)/$z,(399+$y)/$z,(260+$x)/$z,(411+$y)/$z,(301+$x)/$z,(446+$y)/$z),'FD');
			//3-selmana
			$this->color($data['954']);$this->Polygon(array((314+$x)/$z,(429+$y)/$z,(327+$x)/$z,(411+$y)/$z,(302+$x)/$z,(371+$y)/$z,(312+$x)/$z,(360+$y)/$z,(308+$x)/$z,(358+$y)/$z,(307+$x)/$z,(352+$y)/$z,(303+$x)/$z,(344+$y)/$z,(303+$x)/$z,(338+$y)/$z,(293+$x)/$z,(328+$y)/$z,(292+$x)/$z,(320+$y)/$z,(284+$x)/$z,(306+$y)/$z,(277+$x)/$z,(303+$y)/$z,(277+$x)/$z,(299+$y)/$z,(266+$x)/$z,(289+$y)/$z,(262+$x)/$z,(302+$y)/$z,(256+$x)/$z,(308+$y)/$z,(252+$x)/$z,(313+$y)/$z,(247+$x)/$z,(325+$y)/$z,(251+$x)/$z,(333+$y)/$z,(252+$x)/$z,(342+$y)/$z,(249+$x)/$z,(346+$y)/$z,(246+$x)/$z,(349+$y)/$z,(242+$x)/$z,(352+$y)/$z,(250+$x)/$z,(380+$y)/$z,(262+$x)/$z,(389+$y)/$z,(264+$x)/$z,(395+$y)/$z,(314+$x)/$z,(429+$y)/$z),'FD');
			//4-sedrahal
			$this->color($data['953']);$this->Polygon(array((186+$x)/$z,(368+$y)/$z,(192+$x)/$z,(393+$y)/$z,(197+$x)/$z,(397+$y)/$z,(197+$x)/$z,(403+$y)/$z,(213+$x)/$z,(404+$y)/$z,(228+$x)/$z,(412+$y)/$z,(241+$x)/$z,(419+$y)/$z,(254+$x)/$z,(432+$y)/$z,(267+$x)/$z,(446+$y)/$z,(275+$x)/$z,(461+$y)/$z,(290+$x)/$z,(465+$y)/$z,(301+$x)/$z,(446+$y)/$z,(260+$x)/$z,(411+$y)/$z,(237+$x)/$z,(399+$y)/$z,(223+$x)/$z,(381+$y)/$z,(216+$x)/$z,(380+$y)/$z,(211+$x)/$z,(372+$y)/$z,(207+$x)/$z,(370+$y)/$z,(203+$x)/$z,(372+$y)/$z,(197+$x)/$z,(372+$y)/$z,(186+$x)/$z,(368+$y)/$z),'FD');
			//5-getara
			$this->color($data['951']);$this->Polygon(array((290+$x)/$z,(465+$y)/$z,(311+$x)/$z,(474+$y)/$z,(328+$x)/$z,(481+$y)/$z,(345+$x)/$z,(492+$y)/$z,(373+$x)/$z,(520+$y)/$z,(380+$x)/$z,(535+$y)/$z,(389+$x)/$z,(544+$y)/$z,(392+$x)/$z,(555+$y)/$z,(400+$x)/$z,(567+$y)/$z,(485+$x)/$z,(590+$y)/$z,(473+$x)/$z,(522+$y)/$z,(443+$x)/$z,(525+$y)/$z,(422+$x)/$z,(510+$y)/$z,(381+$x)/$z,(472+$y)/$z,(360+$x)/$z,(480+$y)/$z,(325+$x)/$z,(430+$y)/$z,(337+$x)/$z,(427+$y)/$z,(327+$x)/$z,(411+$y)/$z,(314+$x)/$z,(429+$y)/$z,(301+$x)/$z,(446+$y)/$z,(290+$x)/$z,(465+$y)/$z),'FD');
		//dairas faid boutma
			//1-faid boutma
			$this->color($data['967']);$this->Polygon(array((306+$x)/$z,(247+$y)/$z,(288+$x)/$z,(248+$y)/$z,(283+$x)/$z,(250+$y)/$z,(279+$x)/$z,(247+$y)/$z,(276+$x)/$z,(242+$y)/$z,(271+$x)/$z,(240+$y)/$z,(268+$x)/$z,(243+$y)/$z,(269+$x)/$z,(248+$y)/$z,(274+$x)/$z,(250+$y)/$z,(272+$x)/$z,(255+$y)/$z,(258+$x)/$z,(244+$y)/$z,(251+$x)/$z,(246+$y)/$z,(249+$x)/$z,(250+$y)/$z,(245+$x)/$z,(250+$y)/$z,(242+$x)/$z,(252+$y)/$z,(252+$x)/$z,(272+$y)/$z,(266+$x)/$z,(289+$y)/$z,(277+$x)/$z,(299+$y)/$z,(277+$x)/$z,(303+$y)/$z,(284+$x)/$z,(306+$y)/$z,(298+$x)/$z,(295+$y)/$z,(301+$x)/$z,(291+$y)/$z,(310+$x)/$z,(288+$y)/$z,(317+$x)/$z,(280+$y)/$z,(303+$x)/$z,(262+$y)/$z,(306+$x)/$z,(247+$y)/$z),'FD');
			//2-amoura
			$this->color($data['968']);$this->Polygon(array((367+$x)/$z,(342+$y)/$z,(364+$x)/$z,(338+$y)/$z,(359+$x)/$z,(338+$y)/$z,(358+$x)/$z,(335+$y)/$z,(349+$x)/$z,(338+$y)/$z,(348+$x)/$z,(332+$y)/$z,(343+$x)/$z,(329+$y)/$z,(348+$x)/$z,(323+$y)/$z,(342+$x)/$z,(322+$y)/$z,(342+$x)/$z,(317+$y)/$z,(337+$x)/$z,(317+$y)/$z,(340+$x)/$z,(312+$y)/$z,(331+$x)/$z,(308+$y)/$z,(329+$x)/$z,(302+$y)/$z,(324+$x)/$z,(302+$y)/$z,(316+$x)/$z,(298+$y)/$z,(317+$x)/$z,(280+$y)/$z,(310+$x)/$z,(288+$y)/$z,(301+$x)/$z,(291+$y)/$z,(298+$x)/$z,(295+$y)/$z,(284+$x)/$z,(306+$y)/$z,(292+$x)/$z,(320+$y)/$z,(293+$x)/$z,(328+$y)/$z,(303+$x)/$z,(338+$y)/$z,(303+$x)/$z,(344+$y)/$z,(307+$x)/$z,(352+$y)/$z,(308+$x)/$z,(358+$y)/$z,(312+$x)/$z,(360+$y)/$z,(302+$x)/$z,(371+$y)/$z,(367+$x)/$z,(342+$y)/$z),'FD');
			//3-oumeladam
			$this->color($data['956']);$this->Polygon(array((473+$x)/$z,(522+$y)/$z,(473+$x)/$z,(498+$y)/$z,(489+$x)/$z,(463+$y)/$z,(486+$x)/$z,(449+$y)/$z,(493+$x)/$z,(442+$y)/$z,(473+$x)/$z,(434+$y)/$z,(462+$x)/$z,(434+$y)/$z,(458+$x)/$z,(424+$y)/$z,(443+$x)/$z,(425+$y)/$z,(439+$x)/$z,(418+$y)/$z,(435+$x)/$z,(420+$y)/$z,(432+$x)/$z,(416+$y)/$z,(419+$x)/$z,(416+$y)/$z,(416+$x)/$z,(414+$y)/$z,(411+$x)/$z,(405+$y)/$z,(407+$x)/$z,(402+$y)/$z,(398+$x)/$z,(398+$y)/$z,(384+$x)/$z,(395+$y)/$z,(378+$x)/$z,(389+$y)/$z,(364+$x)/$z,(384+$y)/$z,(356+$x)/$z,(378+$y)/$z,(356+$x)/$z,(374+$y)/$z,(369+$x)/$z,(373+$y)/$z,(379+$x)/$z,(360+$y)/$z,(388+$x)/$z,(360+$y)/$z,(386+$x)/$z,(353+$y)/$z,(372+$x)/$z,(354+$y)/$z,(366+$x)/$z,(349+$y)/$z,(367+$x)/$z,(342+$y)/$z,(302+$x)/$z,(371+$y)/$z,(327+$x)/$z,(411+$y)/$z,(337+$x)/$z,(427+$y)/$z,(325+$x)/$z,(430+$y)/$z,(360+$x)/$z,(480+$y)/$z,(381+$x)/$z,(472+$y)/$z,(422+$x)/$z,(510+$y)/$z,(443+$x)/$z,(525+$y)/$z,(473+$x)/$z,(522+$y)/$z),'FD');																	

	}			
	$this->RoundedRect($x-10,155,30,55, 2, $style = '');
	$this->color(0);    $this->SetXY($x-10,150);$this->cell(30,5,$data['titre'],0,0,'C',0,0);
	$this->color(0);    $this->SetXY($x-5,$this->GetY()+10);$this->cell(5,5,'',1,0,'C',1,0);$this->cell(15,5,$data['A'],0,0,'L',0,0);
	$this->color(1);    $this->SetXY($x-5,$this->GetY()+10);$this->cell(5,5,'',1,0,'C',1,0);$this->cell(15,5,$data['B'],0,0,'L',0,0);
	$this->color(11);   $this->SetXY($x-5,$this->GetY()+10);$this->cell(5,5,'',1,0,'C',1,0);$this->cell(15,5,$data['C'],0,0,'L',0,0);
	$this->color(101);  $this->SetXY($x-5,$this->GetY()+10);$this->cell(5,5,'',1,0,'C',1,0);$this->cell(15,5,$data['D'],0,0,'L',0,0);
	$this->color(1001); $this->SetXY($x-5,$this->GetY()+10);$this->cell(5,5,'',1,0,'C',1,0);$this->cell(15,5,$data['E'],0,0,'L',0,0);
	$this->color(0);    $this->SetXY($x-10,$this->GetY()+15);$this->cell(40,5,'00km_____45km_____90km',0,0,'L',0,0);
	$this->color(0);    $this->SetXY($x-10,$this->GetY()+5);$this->cell(40,5,'Source : Dr TIBA Redha  DSP DJELFA',0,0,'L',0,0);
	$this->color(0);
	$this->SetFont('Times', 'BIU', 8);
	$this->SetDrawColor(255,0,0);
	$this->SetXY(150,42);$this->cell(65,5,'La Wilaya De Djelfa',0,0,'C',0,0);
	$this->SetFont('Times', 'B', 8);
	$yy=165;
	$this->SetXY($yy,$this->GetY()+5);$this->cell(25,5,'1-Ain Chouhada',0,0,'L',0,0);$this->color($data['964']);$this->cell(10,4,$data['964'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+5);$this->cell(25,5,'2-Ain el Ibel',0,0,'L',0,0);$this->color($data['958']);$this->cell(10,4,$data['958'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+5);$this->cell(25,5,'3-Ain Fekka',0,0,'L',0,0);$this->color($data['934']);$this->cell(10,4,$data['934'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+5);$this->cell(25,5,'4-Ain Maabed',0,0,'L',0,0);$this->color($data['941']);$this->cell(10,4,$data['941'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+5);$this->cell(25,5,'5-Ain Oussera',0,0,'L',0,0);$this->color($data['924']);$this->cell(10,4,$data['924'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+5);$this->cell(25,5,'6-Amourah',0,0,'L',0,0);$this->color($data['968']);$this->cell(10,4,$data['968'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+5);$this->cell(25,5,'7-Benhar',0,0,'L',0,0);$this->color($data['931']);$this->cell(10,4,$data['931'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+5);$this->cell(25,5,'8-Beni Yacoub',0,0,'L',0,0);$this->color($data['923']);$this->cell(10,4,$data['923'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+5);$this->cell(25,5,'9-Birine',0,0,'L',0,0);$this->color($data['929']);$this->cell(10,4,$data['929'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+5);$this->cell(25,5,'10-Bouira Lahdab',0,0,'L',0,0);$this->color($data['933']);$this->cell(10,4,$data['933'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+5);$this->cell(25,5,'11-Charef',0,0,'L',0,0);$this->color($data['920']);$this->cell(10,4,$data['920'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+5);$this->cell(25,5,'12-Dar Chioukh',0,0,'L',0,0);$this->color($data['942']);$this->cell(10,4,$data['942'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+5);$this->cell(25,5,'13-Deldoul',0,0,'L',0,0);$this->color($data['952']);$this->cell(10,4,$data['952'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+5);$this->cell(25,5,'14-Djelfa',0,0,'L',0,0);$this->color($data['916']);$this->cell(10,4,$data['916'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+5);$this->cell(25,5,'15-Douis',0,0,'L',0,0);$this->color($data['963']);$this->cell(10,4,$data['963'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+5);$this->cell(25,5,'16-El Guedid',0,0,'L',0,0);$this->color($data['919']);$this->cell(10,4,$data['919'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+5);$this->cell(25,5,'17-El Idrissia',0,0,'L',0,0);$this->color($data['917']);$this->cell(10,4,$data['917'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+5);$this->cell(25,5,'18-El Khemis',0,0,'L',0,0);$this->color($data['928']);$this->cell(10,4,$data['928'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+5);$this->cell(25,5,'19-Faidh el Botma',0,0,'L',0,0);$this->color($data['967']);$this->cell(10,4,$data['967'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+5);$this->cell(25,5,'20-Guernini',0,0,'L',0,0);$this->color($data['925']);$this->cell(10,4,$data['925'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+5);$this->cell(25,5,'21-Guettara',0,0,'L',0,0);$this->color($data['951']);$this->cell(10,4,$data['951'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+5);$this->cell(25,5,'22-Had-Sahary',0,0,'L',0,0);$this->color($data['932']);$this->cell(10,4,$data['932'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+5);$this->cell(25,5,'23-Hassi Bahbah',0,0,'L',0,0);$this->color($data['935']);$this->cell(10,4,$data['935'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+5);$this->cell(25,5,'24-Hassi el Euch',0,0,'L',0,0);$this->color($data['940']);$this->cell(10,4,$data['940'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+5);$this->cell(25,5,'25-Hassi Fedoul',0,0,'L',0,0);$this->color($data['927']);$this->cell(10,4,$data['927'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+5);$this->cell(25,5,'26-M Liliha',0,0,'L',0,0);$this->color($data['946']);$this->cell(10,4,$data['946'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+5);$this->cell(25,5,'27-Messad',0,0,'L',0,0);$this->color($data['948']);$this->cell(10,4,$data['948'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+5);$this->cell(25,5,'28-Mouadjebar',0,0,'L',0,0);$this->color($data['957']);$this->cell(10,4,$data['957'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+5);$this->cell(25,5,'29-Oum Laadham',0,0,'L',0,0);$this->color($data['956']);$this->cell(10,4,$data['956'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+5);$this->cell(25,5,'30-Sed Rahal',0,0,'L',0,0);$this->color($data['953']);$this->cell(10,4,$data['953'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+5);$this->cell(25,5,'31-Selmana',0,0,'L',0,0);$this->color($data['954']);$this->cell(10,4,$data['954'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+5);$this->cell(25,5,'32-Sidi Baizid',0,0,'L',0,0);$this->color($data['947']);$this->cell(10,4,$data['947'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+5);$this->cell(25,5,'33-Sidi Ladjel',0,0,'L',0,0);$this->color($data['926']);$this->cell(10,4,$data['926'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+5);$this->cell(25,5,'34-Tadmit',0,0,'L',0,0);$this->color($data['965']);$this->cell(10,4,$data['965'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+5);$this->cell(25,5,'35-Zaafrane',0,0,'L',0,0);$this->color($data['939']);$this->cell(10,4,$data['939'],0,0,'C',1,0);
	$this->SetXY($yy,$this->GetY()+5);$this->cell(25,5,'36-Zaccar',0,0,'L',0,0);$this->color($data['962']);$this->cell(10,4,$data['962'],0,0,'C',1,0);												
	$this->SetDrawColor(0,0,0);
	$this->SetFont('Times', 'B', 10);
	$this->SetFont('Times', 'B', 6);
	$this->SetXY(30,119);$this->cell(55,5,'*1',0,0,'L',0,0);
	$this->SetXY(55,107);$this->cell(65,5,'*2',0,0,'L',0,0);
	$this->SetXY(70,54);$this->cell(65,5,'*3',0,0,'L',0,0);
	$this->SetXY(54,87);$this->cell(65,5,'*4',0,0,'L',0,0);
	$this->SetXY(42,61);$this->cell(65,5,'*5',0,0,'L',0,0);
	$this->SetXY(90,118);$this->cell(65,5,'*6',0,0,'L',0,0);
	$this->SetXY(50,53);$this->cell(65,5,'*7',0,0,'L',0,0);
	$this->SetXY(42,105);$this->cell(65,5,'*8',0,0,'L',0,0);
	$this->SetXY(59,45);$this->cell(65,5,'*9',0,0,'L',0,0);
	$this->SetXY(51,68);$this->cell(65,5,'*10',0,0,'L',0,0);
	$this->SetXY(36,100);$this->cell(65,5,'*11',0,0,'L',0,0);
	$this->SetXY(66,86);$this->cell(65,5,'*12',0,0,'L',0,0);
	$this->SetXY(65,132);$this->cell(65,5,'*13',0,0,'L',0,0);
	$this->SetXY(56,97);$this->cell(65,5,'*14',0,0,'L',0,0);
	$this->SetXY(35,119);$this->cell(65,5,'*15',0,0,'L',0,0);
	$this->SetXY(28,95);$this->cell(65,5,'*16',0,0,'L',0,0);
	$this->SetXY(27,110);$this->cell(65,5,'*17',0,0,'L',0,0);
	$this->SetXY(33,58);$this->cell(65,5,'*18',0,0,'L',0,0);
	$this->SetXY(80,105);$this->cell(65,5,'*19',0,0,'L',0,0);
	$this->SetXY(38,70);$this->cell(65,5,'*20',0,0,'L',0,0);
	$this->SetXY(110,175);$this->cell(65,5,'*21',0,0,'L',0,0);
	$this->SetXY(62,61);$this->cell(65,5,'*22',0,0,'L',0,0);
	$this->SetXY(45,77);$this->cell(65,5,'*23',0,0,'L',0,0);
	$this->SetXY(58,73,$this->GetY()+5);$this->cell(65,5,'*24',0,0,'L',0,0);
	$this->SetXY(14,55);$this->cell(65,5,'*25',0,0,'L',0,0);
	$this->SetXY(73,94);$this->cell(65,5,'*26',0,0,'L',0,0);
	$this->SetXY(68,122);$this->cell(65,5,'*27',0,0,'L',0,0);
	$this->SetXY(69,110);$this->cell(65,5,'*28',0,0,'L',0,0);
	$this->SetXY(100,148);$this->cell(65,5,'*29',0,0,'L',0,0);
	$this->SetXY(59,137);$this->cell(65,5,'*30',0,0,'L',0,0);
	$this->SetXY(77,132);$this->cell(65,5,'*31',0,0,'L',0,0);
	$this->SetXY(62,80);$this->cell(65,5,'*32',0,0,'L',0,0);
	$this->SetXY(25,57);$this->cell(65,5,'*33',0,0,'L',0,0);
	$this->SetXY(45,112);$this->cell(65,5,'*34',0,0,'L',0,0);
	$this->SetXY(42,87);$this->cell(65,5,'*35',0,0,'L',0,0);
	$this->SetXY(63,105);$this->cell(65,5,'*36',0,0,'L',0,0);											
	$this->SetDrawColor(0,0,0);
	$this->SetFont('Times', 'B', 10);
    }
   
   function tblparcim1($titre,$datejour1,$datejour2,$EPH1) 
	{    
		$this->SetFont('Times', 'B', 10);
		$this->SetXY(5,25);$this->cell(200,5,$titre,1,0,'C',1,0);
		$this->SetXY(5,35);
		$this->cell(10,5,"Code",1,0,'C',1,0);
		$this->cell(165,5,"Chapitre",1,0,'C',1,0);
	    $this->cell(10,5,"Nbr",1,0,'C',1,0);
		$this->cell(15,5,"TXM",1,0,'C',1,0);
		$this->SetXY(5,40);
		$IDWIL=17000;
		$ANNEE='2016';
		$this->mysqlconnect();
		$req="SELECT * FROM deceshosp where STRUCTURED $EPH1 and  DINS BETWEEN '$datejour1' AND '$datejour2' ";
		$query1 = mysql_query($req);   
		$totalmbr11=mysql_num_rows($query1);
		
		$query="SELECT CODECIM0,count(CODECIM0)as nbr FROM deceshosp where STRUCTURED $EPH1 and  DINS BETWEEN '$datejour1' AND '$datejour2' GROUP BY CODECIM0  order by nbr desc "; //    % %will search form 0-9,a-z            
		$resultat=mysql_query($query);
		$totalmbr1=mysql_num_rows($resultat);
		while($row=mysql_fetch_object($resultat))
		{
			$this->SetFont('Times', '', 10);
			$this->cell(10,4,trim($this->nbrtostring('chapitre','IDCHAP',$row->CODECIM0,'IDCHAP')),1,0,'C',0);
			$this->cell(165,4,html_entity_decode(utf8_decode($this->nbrtostring('chapitre','IDCHAP',$row->CODECIM0,'CHAP'))) ,1,0,'L',0);
			$this->cell(10,4,trim($row->nbr),1,0,'C',0);
			$this->cell(15,4,round(($row->nbr*100)/$totalmbr11,2).' %',1,0,'C',0);
			$this->SetXY(5,$this->GetY()+4); 
		}
		$this->SetXY(5,$this->GetY());$this->cell(10,5,"Total",1,0,'C',1,0);	  
		$this->cell(165,5,$totalmbr1." : Chapitres",1,0,'C',1,0);	  
		$this->cell(10,5,$totalmbr11,1,0,'C',1,0);	  
		$this->cell(15,5,'100%',1,0,'C',1,0);  
	}
   function nbrtostringcim($db_name,$tb_name,$colonename,$colonevalue,$resultatstring) 
	{
	if (is_numeric($colonevalue) and $colonevalue!=='0') 
	{ 
	$db_host="localhost"; 
    $db_user="root";
    $db_pass="";
    $cnx = mysql_connect($db_host,$db_user,$db_pass)or die ('I cannot connect to the database because: ' . mysql_error());
    $db  = mysql_select_db($db_name,$cnx) ;
    mysql_query("SET NAMES 'UTF8' ");
    $result = mysql_query("SELECT * FROM $tb_name where $colonename=$colonevalue" );
    $row=mysql_fetch_object($result);
	$resultat=$row->$resultatstring;
	return $resultat;
	} 
	return $resultat2='-------';
	}
	
   function tblparcim2($titre,$datejour1,$datejour2,$EPH1) 
	{    
		$this->SetFont('Times', 'B', 10);
		$this->SetXY(5,25);$this->cell(200,5,$titre,1,0,'C',1,0);
		$this->SetXY(5,35);
		$this->cell(10,5,"Code",1,0,'C',1,0);
		$this->cell(165,5,"Categorie",1,0,'C',1,0);
	    $this->cell(10,5,"Nbr",1,0,'C',1,0);
		$this->cell(15,5,"TXM",1,0,'C',1,0);
		$this->SetXY(5,40);
		$IDWIL=17000;
		$ANNEE='2016';
		$this->mysqlconnect();
		$req="SELECT * FROM deceshosp where STRUCTURED $EPH1 and  DINS BETWEEN '$datejour1' AND '$datejour2' ";
		$query1 = mysql_query($req);   
		$totalmbr11=mysql_num_rows($query1);
		$query="SELECT CODECIM,count(CODECIM)as nbr FROM deceshosp where STRUCTURED $EPH1 and  DINS BETWEEN '$datejour1' AND '$datejour2' GROUP BY CODECIM  order by nbr desc "; //    % %will search form 0-9,a-z            
		$resultat=mysql_query($query);
		$totalmbr1=mysql_num_rows($resultat);
		while($row=mysql_fetch_object($resultat))
		{
			$this->SetFont('Times', '', 10);
			$this->cell(10,4,trim($this->nbrtostringcim('deces','cim','row_id',$row->CODECIM,'diag_cod')),1,0,'C',0);
			$this->cell(165,4,html_entity_decode(utf8_decode($this->nbrtostringcim('deces','cim','row_id',$row->CODECIM,'diag_nom'))) ,1,0,'L',0);
			$this->cell(10,4,trim($row->nbr),1,0,'C',0);
			$this->cell(15,4,round(($row->nbr*100)/$totalmbr11,2).' %',1,0,'C',0);
			$this->SetXY(5,$this->GetY()+4); 
		}
		$this->SetXY(5,$this->GetY());$this->cell(10,5,"Total",1,0,'C',1,0);	  
		$this->cell(165,5,$totalmbr1." : Categorie",1,0,'C',1,0);	  
		$this->cell(10,5,$totalmbr11,1,0,'C',1,0);	  
		$this->cell(15,5,'100%',1,0,'C',1,0);  
	}
	
	function bnmcomm($mois,$annee,$COMMUNER,$type) 
	{
	if ($type=='1') {$col="nm1+nf1+nm2+nf2";}//naissance
	if ($type=='2') {$col="mnm1+mnf1";}//mort néé
	if ($type=='3') {$col="m1+m2";}//mariage
	if ($type=='4') {$col="djm1+dm1+dm2+dm3+dm4+dm5+dm6+dm7+dm8+dm9+dm10+dm11+dm12+dm13+dm14+dm15+dm16+dm17+dm18+dm19";}//deces m
	if ($type=='5') {$col="djf1+df1+df2+df3+df4+df5+df6+df7+df8+df9+df10+df11+df12+df13+df14+df15+df16+df17+df18+df19";}//deces f
	if ($type=='6') {$col="djm1+dm1+dm2+dm3+dm4+dm5+dm6+dm7+dm8+dm9+dm10+dm11+dm12+dm13+dm14+dm15+dm16+dm17+dm18+dm19+djf1+df1+df2+df3+df4+df5+df6+df7+df8+df9+df10+df11+df12+df13+df14+df15+df16+df17+df18+df19";}//deces f
	
	$this->mysqlconnect();
	$req="SELECT SUM($col) AS SAD FROM bordereau where mois $mois and  annee = $annee and COMMUNED=$COMMUNER ";
	$query = mysql_query($req);   
	$rs = mysql_fetch_assoc($query);
	$OP=$rs['SAD'];
	mysql_free_result($query);
	return $OP;
	}
	
	function bnmsig($mois,$annee,$type) 
	{
	$data = array(
	"titre"=> 'Nombre De Deces',
	"A"    => '00-00',
	"B"    => '01-10',
	"C"    => '09-100',
	"D"    => '99-1000',
	"E"    => '999-10000',
	"1"    => $this->bnmcomm($mois,$annee,916,$type),//daira  Djelfa
	"2"    => $this->bnmcomm($mois,$annee,924,$type)+$this->bnmcomm($mois,$annee,925,$type),//daira  ainoussera
	"3"    => $this->bnmcomm($mois,$annee,929,$type)+$this->bnmcomm($mois,$annee,931,$type),//daira  birine
	"4"    => $this->bnmcomm($mois,$annee,929,$type)+$this->bnmcomm($mois,$annee,927,$type)+$this->bnmcomm($mois,$annee,928,$type),//daira  sidilaadjel
	"5"    => $this->bnmcomm($mois,$annee,932,$type)+$this->bnmcomm($mois,$annee,933,$type)+$this->bnmcomm($mois,$annee,934,$type),//daira  hadsahari
	"6"    => $this->bnmcomm($mois,$annee,935,$type)+$this->bnmcomm($mois,$annee,939,$type)+$this->bnmcomm($mois,$annee,941,$type)+$this->bnmcomm($mois,$annee,940,$type),//daira  hassibahbah
	"7"    => $this->bnmcomm($mois,$annee,942,$type)+$this->bnmcomm($mois,$annee,946,$type)+$this->bnmcomm($mois,$annee,947,$type),//daira  darchioukhe
	"8"    => $this->bnmcomm($mois,$annee,920,$type)+$this->bnmcomm($mois,$annee,919,$type)+$this->bnmcomm($mois,$annee,923,$type),//daira  charef
	"9"    => $this->bnmcomm($mois,$annee,917,$type)+$this->bnmcomm($mois,$annee,964,$type)+$this->bnmcomm($mois,$annee,963,$type),//daira  idrissia
	"10"   => $this->bnmcomm($mois,$annee,965,$type)+$this->bnmcomm($mois,$annee,958,$type)+$this->bnmcomm($mois,$annee,962,$type)+$this->bnmcomm($mois,$annee,957,$type),//daira  ain elbel
	"11"   => $this->bnmcomm($mois,$annee,948,$type)+$this->bnmcomm($mois,$annee,952,$type)+$this->bnmcomm($mois,$annee,954,$type)+$this->bnmcomm($mois,$annee,953,$type)+$this->bnmcomm($mois,$annee,951,$type),//daira  messaad
	"12"   => $this->bnmcomm($mois,$annee,967,$type)+$this->bnmcomm($mois,$annee,968,$type)+$this->bnmcomm($mois,$annee,956,$type),//daira  faid elbotma
	"916"  => $this->bnmcomm($mois,$annee,916,$type),//daira  Djelfa
	"917"  => $this->bnmcomm($mois,$annee,917,$type),//daira El Idrissia
	"918"  => $this->bnmcomm($mois,$annee,918,$type),//Oum Cheggag
	"919"  => $this->bnmcomm($mois,$annee,919,$type),//El Guedid
	"920"  => $this->bnmcomm($mois,$annee,920,$type),//daira Charef
	"921"  => $this->bnmcomm($mois,$annee,921,$type),//El Hammam
	"922"  => $this->bnmcomm($mois,$annee,922,$type),//Touazi
	"923"  => $this->bnmcomm($mois,$annee,923,$type),//Beni Yacoub
	"924"  => $this->bnmcomm($mois,$annee,924,$type),//daira ainoussera
	"925"  => $this->bnmcomm($mois,$annee,925,$type),//guernini
	"926"  => $this->bnmcomm($mois,$annee,926,$type),//daira sidilaadjel
	"927"  => $this->bnmcomm($mois,$annee,927,$type),//hassifdoul
	"928"  => $this->bnmcomm($mois,$annee,928,$type),//elkhamis
	"929"  => $this->bnmcomm($mois,$annee,929,$type),//daira birine
	"930"  => $this->bnmcomm($mois,$annee,930,$type),//Dra Souary
	"931"  => $this->bnmcomm($mois,$annee,931,$type),//benahar
	"932"  => $this->bnmcomm($mois,$annee,932,$type),//daira hadshari
	"933"  => $this->bnmcomm($mois,$annee,933,$type),//bouiratlahdab
	"934"  => $this->bnmcomm($mois,$annee,934,$type),//ainfka
	"935"  => $this->bnmcomm($mois,$annee,935,$type),//daira hassi bahbah
	"936"  => $this->bnmcomm($mois,$annee,936,$type),//Mouilah
	"937"  => $this->bnmcomm($mois,$annee,937,$type),//El Mesrane
	"938"  => $this->bnmcomm($mois,$annee,938,$type),//Hassi el Mora
	"939"  => $this->bnmcomm($mois,$annee,939,$type),//zaafrane
	"940"  => $this->bnmcomm($mois,$annee,940,$type),//hassi el euche
	"941"  => $this->bnmcomm($mois,$annee,941,$type),//ain maabed
	"942"  => $this->bnmcomm($mois,$annee,942,$type),//daira darchioukh
	"943"  => $this->bnmcomm($mois,$annee,943,$type),//Guendouza
	"944"  => $this->bnmcomm($mois,$annee,944,$type),//El Oguila
	"945"  => $this->bnmcomm($mois,$annee,945,$type),//El Merdja
	"946"  => $this->bnmcomm($mois,$annee,946,$type),//mliliha
	"947"  => $this->bnmcomm($mois,$annee,947,$type),//sidibayzid
	"948"  => $this->bnmcomm($mois,$annee,948,$type),//daira Messad
	"949"  => $this->bnmcomm($mois,$annee,949,$type),//Abdelmadjid
	"950"  => $this->bnmcomm($mois,$annee,950,$type),//Haniet Ouled Salem
	"951"  => $this->bnmcomm($mois,$annee,951,$type),//Guettara
	"952"  => $this->bnmcomm($mois,$annee,952,$type),//Deldoul
	"953"  => $this->bnmcomm($mois,$annee,953,$type),//Sed Rahal
	"954"  => $this->bnmcomm($mois,$annee,954,$type),//Selmana
	"955"  => $this->bnmcomm($mois,$annee,955,$type),//El Gahra
	"956"  => $this->bnmcomm($mois,$annee,956,$type),//Oum Laadham
	"957"  => $this->bnmcomm($mois,$annee,957,$type),//Mouadjebar
	"958"  => $this->bnmcomm($mois,$annee,958,$type),//daira Ain el Ibel
	"959"  => $this->bnmcomm($mois,$annee,959,$type),//Amera
	"960"  => $this->bnmcomm($mois,$annee,960,$type),//N'thila
	"961"  => $this->bnmcomm($mois,$annee,961,$type),//Oued Seddeur
	"962"  => $this->bnmcomm($mois,$annee,962,$type),//Zaccar
	"963"  => $this->bnmcomm($mois,$annee,963,$type),//Douis
	"964"  => $this->bnmcomm($mois,$annee,964,$type),//Ain Chouhada
	"965"  => $this->bnmcomm($mois,$annee,965,$type),//Tadmit
	"966"  => $this->bnmcomm($mois,$annee,966,$type),//El Hiouhi
	"967"  => $this->bnmcomm($mois,$annee,967,$type),//daira Faidh el Botma
	"968"  => $this->bnmcomm($mois,$annee,968,$type) //Amourah
	);		
	return $data;
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
   
}