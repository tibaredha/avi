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
//croissance par semaine 
$tablec = array(
 1 => 150,
 2 => 300,
 3 => 460,
 4 => 600,
 5 => 700,
 6 => 790,
 7 => 880,
 8 => 970,
 9 => 1060,
 10 => 1150,
 11 => 1240,
 12 => 1340,
 13 => 1450,
 14 => 1560,
 15 => 1680,
 16 => 1800,
 17 => 1930,
 18 => 2060,
 19 => 2190,
 20 => 2330,
 21 => 2508,
 22 => 2686,
 23 => 2864,
 24 => 3042,
 25 => 3220,
 26 => 3355,
 27 => 3470,
 28 => 3575,
 29 => 3633,
 30 => 3690,
 31 => 3713,
 32 => 3735,
 33 => 3745,
 34 => 3755,
 35 => 3765,
 36 => 3775,
 37 => 3785,
 38 => 3795,
 39 => 3805,
 40 => 3815,
 41 => 3825,
 42 => 3835,
 43 => 3845,
 44 => 3855,
 45 => 3865,
 46 => 3875,
 47 => 3885,
 48 => 3895,
 49 => 3905,
 50 => 3915,
 51 => 3925,
 52 => 3935,
 53 => 3945,
 54 => 3955,
 55 => 3965,
 56 => 3975,
 57 => 3985,
 58 => 3995,
 59 => 4005,
 60 => 4015,
 61 => 4025,
 62 => 4035,
 63 => 4045,
 64 => 4055
 );
$id=$_GET['uc'];
$pdf->mysqlconnect();
$query = "SELECT * from avi where id = $id "; 
$query1 = mysql_query($query);   
$rs = mysql_fetch_assoc($query1);
mysql_free_result($query1);
$pdf->setxy(5,$pdf->gety()+10);$pdf->cell(25,5,'Date',1,0,'L',1,0);  $pdf->cell(25,5,$rs['date'],1,0,'C',0);  $pdf->cell(25,5,'Wilaya',1,0,'L',1,0);$pdf->cell(25,5,$rs['WILAYAD'],1,0,'C',0);$pdf->cell(25,5,'Commune',1,0,'L',1,0);$pdf->cell(25,5,$rs['COMMUNED'],1,0,'C',0);
$pdf->setxy(5,$pdf->gety()+5); $pdf->cell(25,5,'Client',1,0,'L',1,0);$pdf->cell(25,5,$rs['avicli'],1,0,'C',0);$pdf->cell(25,5,'Cycle',1,0,'L',1,0);$pdf->cell(25,5,$rs['avicycl'],1,0,'C',0); $pdf->cell(25,5,'Batiment',1,0,'L',1,0);  $pdf->cell(25,5,$rs['avibtm'],1,0,'C',0);$pdf->cell(25,5,'Semaine',1,0,'L',1,0);$pdf->cell(25,5,$rs['avisem'],1,0,'C',0);
$pdf->setxy(5,$pdf->gety()+10); $pdf->cell(25,5,$rs['avi0'],1,0,'C',0);$pdf->cell(25,5,$rs['avi20'],1,0,'C',0);$pdf->cell(25,5,$rs['avi40'],1,0,'C',0);$pdf->cell(25,5,$rs['avi60'],1,0,'C',0);$pdf->cell(25,5,$rs['avi80'],1,0,'C',0);
$pdf->setxy(5,$pdf->gety()+5); $pdf->cell(25,5,$rs['avi1'],1,0,'C',0);$pdf->cell(25,5,$rs['avi21'],1,0,'C',0);$pdf->cell(25,5,$rs['avi41'],1,0,'C',0);$pdf->cell(25,5,$rs['avi61'],1,0,'C',0);$pdf->cell(25,5,$rs['avi81'],1,0,'C',0);
$pdf->setxy(5,$pdf->gety()+5); $pdf->cell(25,5,$rs['avi2'],1,0,'C',0);$pdf->cell(25,5,$rs['avi22'],1,0,'C',0);$pdf->cell(25,5,$rs['avi42'],1,0,'C',0);$pdf->cell(25,5,$rs['avi62'],1,0,'C',0);$pdf->cell(25,5,$rs['avi82'],1,0,'C',0);
$pdf->setxy(5,$pdf->gety()+5); $pdf->cell(25,5,$rs['avi3'],1,0,'C',0);$pdf->cell(25,5,$rs['avi23'],1,0,'C',0);$pdf->cell(25,5,$rs['avi43'],1,0,'C',0);$pdf->cell(25,5,$rs['avi63'],1,0,'C',0);$pdf->cell(25,5,$rs['avi83'],1,0,'C',0);
$pdf->setxy(5,$pdf->gety()+5); $pdf->cell(25,5,$rs['avi4'],1,0,'C',0);$pdf->cell(25,5,$rs['avi24'],1,0,'C',0);$pdf->cell(25,5,$rs['avi44'],1,0,'C',0);$pdf->cell(25,5,$rs['avi64'],1,0,'C',0);$pdf->cell(25,5,$rs['avi84'],1,0,'C',0);
$pdf->setxy(5,$pdf->gety()+5); $pdf->cell(25,5,$rs['avi5'],1,0,'C',0);$pdf->cell(25,5,$rs['avi25'],1,0,'C',0);$pdf->cell(25,5,$rs['avi45'],1,0,'C',0);$pdf->cell(25,5,$rs['avi65'],1,0,'C',0);$pdf->cell(25,5,$rs['avi85'],1,0,'C',0);
$pdf->setxy(5,$pdf->gety()+5); $pdf->cell(25,5,$rs['avi6'],1,0,'C',0);$pdf->cell(25,5,$rs['avi26'],1,0,'C',0);$pdf->cell(25,5,$rs['avi46'],1,0,'C',0);$pdf->cell(25,5,$rs['avi66'],1,0,'C',0);$pdf->cell(25,5,$rs['avi86'],1,0,'C',0);
$pdf->setxy(5,$pdf->gety()+5); $pdf->cell(25,5,$rs['avi7'],1,0,'C',0);$pdf->cell(25,5,$rs['avi27'],1,0,'C',0);$pdf->cell(25,5,$rs['avi47'],1,0,'C',0);$pdf->cell(25,5,$rs['avi67'],1,0,'C',0);$pdf->cell(25,5,$rs['avi87'],1,0,'C',0);
$pdf->setxy(5,$pdf->gety()+5); $pdf->cell(25,5,$rs['avi8'],1,0,'C',0);$pdf->cell(25,5,$rs['avi28'],1,0,'C',0);$pdf->cell(25,5,$rs['avi48'],1,0,'C',0);$pdf->cell(25,5,$rs['avi68'],1,0,'C',0);$pdf->cell(25,5,$rs['avi88'],1,0,'C',0);
$pdf->setxy(5,$pdf->gety()+5); $pdf->cell(25,5,$rs['avi9'],1,0,'C',0);$pdf->cell(25,5,$rs['avi29'],1,0,'C',0);$pdf->cell(25,5,$rs['avi49'],1,0,'C',0);$pdf->cell(25,5,$rs['avi69'],1,0,'C',0);$pdf->cell(25,5,$rs['avi89'],1,0,'C',0);
$pdf->setxy(5,$pdf->gety()+5); $pdf->cell(25,5,$rs['avi10'],1,0,'C',0);$pdf->cell(25,5,$rs['avi30'],1,0,'C',0);$pdf->cell(25,5,$rs['avi50'],1,0,'C',0);$pdf->cell(25,5,$rs['avi70'],1,0,'C',0);$pdf->cell(25,5,$rs['avi90'],1,0,'C',0);
$pdf->setxy(5,$pdf->gety()+5); $pdf->cell(25,5,$rs['avi11'],1,0,'C',0);$pdf->cell(25,5,$rs['avi31'],1,0,'C',0);$pdf->cell(25,5,$rs['avi51'],1,0,'C',0);$pdf->cell(25,5,$rs['avi71'],1,0,'C',0);$pdf->cell(25,5,$rs['avi91'],1,0,'C',0);
$pdf->setxy(5,$pdf->gety()+5); $pdf->cell(25,5,$rs['avi12'],1,0,'C',0);$pdf->cell(25,5,$rs['avi32'],1,0,'C',0);$pdf->cell(25,5,$rs['avi52'],1,0,'C',0);$pdf->cell(25,5,$rs['avi72'],1,0,'C',0);$pdf->cell(25,5,$rs['avi92'],1,0,'C',0);
$pdf->setxy(5,$pdf->gety()+5); $pdf->cell(25,5,$rs['avi13'],1,0,'C',0);$pdf->cell(25,5,$rs['avi33'],1,0,'C',0);$pdf->cell(25,5,$rs['avi53'],1,0,'C',0);$pdf->cell(25,5,$rs['avi73'],1,0,'C',0);$pdf->cell(25,5,$rs['avi93'],1,0,'C',0);
$pdf->setxy(5,$pdf->gety()+5); $pdf->cell(25,5,$rs['avi14'],1,0,'C',0);$pdf->cell(25,5,$rs['avi34'],1,0,'C',0);$pdf->cell(25,5,$rs['avi54'],1,0,'C',0);$pdf->cell(25,5,$rs['avi74'],1,0,'C',0);$pdf->cell(25,5,$rs['avi94'],1,0,'C',0);
$pdf->setxy(5,$pdf->gety()+5); $pdf->cell(25,5,$rs['avi15'],1,0,'C',0);$pdf->cell(25,5,$rs['avi35'],1,0,'C',0);$pdf->cell(25,5,$rs['avi55'],1,0,'C',0);$pdf->cell(25,5,$rs['avi75'],1,0,'C',0);$pdf->cell(25,5,$rs['avi95'],1,0,'C',0);
$pdf->setxy(5,$pdf->gety()+5); $pdf->cell(25,5,$rs['avi16'],1,0,'C',0);$pdf->cell(25,5,$rs['avi36'],1,0,'C',0);$pdf->cell(25,5,$rs['avi56'],1,0,'C',0);$pdf->cell(25,5,$rs['avi76'],1,0,'C',0);$pdf->cell(25,5,$rs['avi96'],1,0,'C',0);
$pdf->setxy(5,$pdf->gety()+5); $pdf->cell(25,5,$rs['avi17'],1,0,'C',0);$pdf->cell(25,5,$rs['avi37'],1,0,'C',0);$pdf->cell(25,5,$rs['avi57'],1,0,'C',0);$pdf->cell(25,5,$rs['avi77'],1,0,'C',0);$pdf->cell(25,5,$rs['avi97'],1,0,'C',0);
$pdf->setxy(5,$pdf->gety()+5); $pdf->cell(25,5,$rs['avi18'],1,0,'C',0);$pdf->cell(25,5,$rs['avi38'],1,0,'C',0);$pdf->cell(25,5,$rs['avi58'],1,0,'C',0);$pdf->cell(25,5,$rs['avi78'],1,0,'C',0);$pdf->cell(25,5,$rs['avi98'],1,0,'C',0);
$pdf->setxy(5,$pdf->gety()+5); $pdf->cell(25,5,$rs['avi19'],1,0,'C',0);$pdf->cell(25,5,$rs['avi39'],1,0,'C',0);$pdf->cell(25,5,$rs['avi59'],1,0,'C',0);$pdf->cell(25,5,$rs['avi79'],1,0,'C',0);$pdf->cell(25,5,$rs['avi99'],1,0,'C',0);

$data = array(   $rs['avi0'],$rs['avi1'],$rs['avi2'],$rs['avi3'],$rs['avi4'],$rs['avi5'],$rs['avi6'],$rs['avi7'],$rs['avi8'],$rs['avi9'],$rs['avi10']
				,$rs['avi11'],$rs['avi12'],$rs['avi13'],$rs['avi14'],$rs['avi15'],$rs['avi16'],$rs['avi17'],$rs['avi18'],$rs['avi19'],$rs['avi20']
				,$rs['avi21'],$rs['avi22'],$rs['avi23'],$rs['avi24'],$rs['avi25'],$rs['avi26'],$rs['avi27'],$rs['avi28'],$rs['avi29'],$rs['avi30']
				,$rs['avi31'],$rs['avi32'],$rs['avi33'],$rs['avi34'],$rs['avi35'],$rs['avi36'],$rs['avi37'],$rs['avi38'],$rs['avi39'],$rs['avi40']
				,$rs['avi41'],$rs['avi42'],$rs['avi43'],$rs['avi44'],$rs['avi45'],$rs['avi46'],$rs['avi47'],$rs['avi48'],$rs['avi49'],$rs['avi50']
				,$rs['avi51'],$rs['avi52'],$rs['avi53'],$rs['avi54'],$rs['avi55'],$rs['avi56'],$rs['avi57'],$rs['avi58'],$rs['avi59'],$rs['avi60']
				,$rs['avi61'],$rs['avi62'],$rs['avi63'],$rs['avi64'],$rs['avi65'],$rs['avi66'],$rs['avi67'],$rs['avi68'],$rs['avi69'],$rs['avi70']
				,$rs['avi71'],$rs['avi72'],$rs['avi73'],$rs['avi74'],$rs['avi75'],$rs['avi76'],$rs['avi77'],$rs['avi78'],$rs['avi79'],$rs['avi80']
				,$rs['avi81'],$rs['avi82'],$rs['avi83'],$rs['avi84'],$rs['avi85'],$rs['avi86'],$rs['avi87'],$rs['avi88'],$rs['avi89'],$rs['avi90']
				,$rs['avi91'],$rs['avi92'],$rs['avi93'],$rs['avi94'],$rs['avi95'],$rs['avi96'],$rs['avi97'],$rs['avi98'],$rs['avi99']);
sort($data);
$pdf->setxy(150,$pdf->gety()-95); $pdf->cell(25,5,$data[0],1,0,'C',0);$pdf->cell(25,5,$data[20],1,0,'C',0);$pdf->cell(25,5,$data[40],1,0,'C',0);$pdf->cell(25,5,$data[60],1,0,'C',0);$pdf->cell(25,5,$data[80],1,0,'C',0);
$pdf->setxy(150,$pdf->gety()+5); $pdf->cell(25,5,$data[1],1,0,'C',0);$pdf->cell(25,5,$data[21],1,0,'C',0);$pdf->cell(25,5,$data[41],1,0,'C',0);$pdf->cell(25,5,$data[61],1,0,'C',0);$pdf->cell(25,5,$data[81],1,0,'C',0);
$pdf->setxy(150,$pdf->gety()+5); $pdf->cell(25,5,$data[2],1,0,'C',0);$pdf->cell(25,5,$data[22],1,0,'C',0);$pdf->cell(25,5,$data[42],1,0,'C',0);$pdf->cell(25,5,$data[62],1,0,'C',0);$pdf->cell(25,5,$data[82],1,0,'C',0);
$pdf->setxy(150,$pdf->gety()+5); $pdf->cell(25,5,$data[3],1,0,'C',0);$pdf->cell(25,5,$data[23],1,0,'C',0);$pdf->cell(25,5,$data[43],1,0,'C',0);$pdf->cell(25,5,$data[63],1,0,'C',0);$pdf->cell(25,5,$data[83],1,0,'C',0);
$pdf->setxy(150,$pdf->gety()+5); $pdf->cell(25,5,$data[4],1,0,'C',0);$pdf->cell(25,5,$data[24],1,0,'C',0);$pdf->cell(25,5,$data[44],1,0,'C',0);$pdf->cell(25,5,$data[64],1,0,'C',0);$pdf->cell(25,5,$data[84],1,0,'C',0);
$pdf->setxy(150,$pdf->gety()+5); $pdf->cell(25,5,$data[5],1,0,'C',0);$pdf->cell(25,5,$data[25],1,0,'C',0);$pdf->cell(25,5,$data[45],1,0,'C',0);$pdf->cell(25,5,$data[65],1,0,'C',0);$pdf->cell(25,5,$data[85],1,0,'C',0);
$pdf->setxy(150,$pdf->gety()+5); $pdf->cell(25,5,$data[6],1,0,'C',0);$pdf->cell(25,5,$data[26],1,0,'C',0);$pdf->cell(25,5,$data[46],1,0,'C',0);$pdf->cell(25,5,$data[66],1,0,'C',0);$pdf->cell(25,5,$data[86],1,0,'C',0);
$pdf->setxy(150,$pdf->gety()+5); $pdf->cell(25,5,$data[7],1,0,'C',0);$pdf->cell(25,5,$data[27],1,0,'C',0);$pdf->cell(25,5,$data[47],1,0,'C',0);$pdf->cell(25,5,$data[67],1,0,'C',0);$pdf->cell(25,5,$data[87],1,0,'C',0);
$pdf->setxy(150,$pdf->gety()+5); $pdf->cell(25,5,$data[8],1,0,'C',0);$pdf->cell(25,5,$data[28],1,0,'C',0);$pdf->cell(25,5,$data[48],1,0,'C',0);$pdf->cell(25,5,$data[68],1,0,'C',0);$pdf->cell(25,5,$data[88],1,0,'C',0);
$pdf->setxy(150,$pdf->gety()+5); $pdf->cell(25,5,$data[9],1,0,'C',0);$pdf->cell(25,5,$data[29],1,0,'C',0);$pdf->cell(25,5,$data[49],1,0,'C',0);$pdf->cell(25,5,$data[69],1,0,'C',0);$pdf->cell(25,5,$data[89],1,0,'C',0);
$pdf->setxy(150,$pdf->gety()+5); $pdf->cell(25,5,$data[10],1,0,'C',0);$pdf->cell(25,5,$data[30],1,0,'C',0);$pdf->cell(25,5,$data[50],1,0,'C',0);$pdf->cell(25,5,$data[70],1,0,'C',0);$pdf->cell(25,5,$data[90],1,0,'C',0);
$pdf->setxy(150,$pdf->gety()+5); $pdf->cell(25,5,$data[11],1,0,'C',0);$pdf->cell(25,5,$data[31],1,0,'C',0);$pdf->cell(25,5,$data[51],1,0,'C',0);$pdf->cell(25,5,$data[71],1,0,'C',0);$pdf->cell(25,5,$data[91],1,0,'C',0);
$pdf->setxy(150,$pdf->gety()+5); $pdf->cell(25,5,$data[12],1,0,'C',0);$pdf->cell(25,5,$data[32],1,0,'C',0);$pdf->cell(25,5,$data[52],1,0,'C',0);$pdf->cell(25,5,$data[72],1,0,'C',0);$pdf->cell(25,5,$data[92],1,0,'C',0);
$pdf->setxy(150,$pdf->gety()+5); $pdf->cell(25,5,$data[13],1,0,'C',0);$pdf->cell(25,5,$data[33],1,0,'C',0);$pdf->cell(25,5,$data[53],1,0,'C',0);$pdf->cell(25,5,$data[73],1,0,'C',0);$pdf->cell(25,5,$data[93],1,0,'C',0);
$pdf->setxy(150,$pdf->gety()+5); $pdf->cell(25,5,$data[14],1,0,'C',0);$pdf->cell(25,5,$data[34],1,0,'C',0);$pdf->cell(25,5,$data[54],1,0,'C',0);$pdf->cell(25,5,$data[74],1,0,'C',0);$pdf->cell(25,5,$data[94],1,0,'C',0);
$pdf->setxy(150,$pdf->gety()+5); $pdf->cell(25,5,$data[15],1,0,'C',0);$pdf->cell(25,5,$data[35],1,0,'C',0);$pdf->cell(25,5,$data[55],1,0,'C',0);$pdf->cell(25,5,$data[75],1,0,'C',0);$pdf->cell(25,5,$data[95],1,0,'C',0);
$pdf->setxy(150,$pdf->gety()+5); $pdf->cell(25,5,$data[16],1,0,'C',0);$pdf->cell(25,5,$data[36],1,0,'C',0);$pdf->cell(25,5,$data[56],1,0,'C',0);$pdf->cell(25,5,$data[76],1,0,'C',0);$pdf->cell(25,5,$data[96],1,0,'C',0);
$pdf->setxy(150,$pdf->gety()+5); $pdf->cell(25,5,$data[17],1,0,'C',0);$pdf->cell(25,5,$data[37],1,0,'C',0);$pdf->cell(25,5,$data[57],1,0,'C',0);$pdf->cell(25,5,$data[77],1,0,'C',0);$pdf->cell(25,5,$data[97],1,0,'C',0);
$pdf->setxy(150,$pdf->gety()+5); $pdf->cell(25,5,$data[18],1,0,'C',0);$pdf->cell(25,5,$data[38],1,0,'C',0);$pdf->cell(25,5,$data[58],1,0,'C',0);$pdf->cell(25,5,$data[78],1,0,'C',0);$pdf->cell(25,5,$data[98],1,0,'C',0);
$pdf->setxy(150,$pdf->gety()+5); $pdf->cell(25,5,$data[19],1,0,'C',0);$pdf->cell(25,5,$data[39],1,0,'C',0);$pdf->cell(25,5,$data[59],1,0,'C',0);$pdf->cell(25,5,$data[79],1,0,'C',0);$pdf->cell(25,5,$data[99],1,0,'C',0);

$contd=count ($data);
$pdf->setxy(5,$pdf->gety()+10); $pdf->cell(25,5,'count : ',1,0,'l',1,0); $pdf->cell(25,5,$contd,1,0,'C',0);  $pdf->cell(25,5,'sum: ',1,0,'l',1,0); $pdf->cell(25,5,array_sum ($data),1,0,'C',0);
$pdf->setxy(5,$pdf->gety()+5); $pdf->cell(25,5,'min : ',1,0,'l',1,0); $pdf->cell(25,5,$data[0],1,0,'C',0);  $pdf->cell(25,5,'max : ',1,0,'l',1,0); $pdf->cell(25,5,$data[$contd - 1],1,0,'C',0); $pdf->cell(25,5,'etendu : ',1,0,'l',1,0); $pdf->cell(25,5,$data[$contd - 1]-$data[0],1,0,'C',0);
$m=round($pdf->mean($data,$type="arithmetic"));$m10=($m*10)/100;
$pdf->setxy(5,$pdf->gety()+5); $pdf->cell(25,5,'moyenne : ',1,0,'l',1,0); $pdf->cell(25,5,round($pdf->mean($data,$type="arithmetic"),2),1,0,'C',0,0);  $pdf->cell(25,5,'moyenne - 10%',1,0,'l',1,0);$pdf->cell(25,5,round($pdf->mean($data,$type="arithmetic")-$m10,2),1,0,'C',0);$pdf->cell(25,5,'moyenne + 10%',1,0,'l',1,0);                    $pdf->cell(25,5,round($pdf->mean($data,$type="arithmetic")+$m10,2),1,0,'C',0,0);  
$pdf->setxy(5,$pdf->gety()+5);  $pdf->cell(25,5,'q1 : ',1,0,'l',1,0);        $pdf->cell(25,5,$data[round($contd / 4)],1,0,'C',0,0);                           $pdf->cell(25,5,'median : ',1,0,'l',1,0);  $pdf->cell(25,5,$pdf->median($data),1,0,'C',0,0);                            $pdf->cell(25,5,'q3 : ',1,0,'l',1,0);        $pdf->cell(25,5,$data[round($contd * 3 / 4)],1,0,'C',0);    
$pdf->SetXY(5,$pdf->GetY()+5);  $pdf->cell(25,5,'var (n-1)',1,0,'L',1,0);    $pdf->cell(25,5,round($pdf->variance($data),2),1,0,'C',0,0);                     $pdf->cell(25,5,'std (n-1)',1,0,'L',1,0);  $pdf->cell(25,5,round($pdf->sd($data),2),1,0,'C',0,0);
$pdf->SetXY(5,$pdf->GetY()+5);  $pdf->cell(25,5,'skew',1,0,'L',1,0);         $pdf->cell(25,5,round($pdf->skew($data),2),1,0,'C',0,0);$pdf->cell(25,5,$pdf->isSkew($data),1,0,'C',0,0);                          $pdf->cell(25,5,'kurt',1,0,'L',1,0);                $pdf->cell(25,5,round($pdf->kurt($data),2),1,0,'C',0,0);$pdf->cell(25,5,$pdf->iskurt($data),1,0,'C',0,0);
$pdf->SetXY(5,$pdf->GetY()+5);  $pdf->cell(25,5,'cv',1,0,'L',1,0);           $pdf->cell(25,5,round($pdf->cv($data),2),1,0,'C',0,0);
$sup = round($pdf->mean($data,$type="arithmetic")+$m10,2);
$inf = round($pdf->mean($data,$type="arithmetic")-$m10,2);				
function filterArraysup($value){
    return ($value >= $GLOBALS['sup']);
}
$filteredArraysup = array_filter($data, 'filterArraysup');
$contsup=count ($filteredArraysup);
// $pdf->SetXY(5,$pdf->GetY()+10);
// foreach($filteredArraysup as $k => $v){
// $pdf->SetXY(5,$pdf->GetY()+5);    $pdf->cell(20,5,"$v",1,0,'C',1,0);	
// }
function filterArrayinf($value){   
    return ($value <= $GLOBALS['inf']);
}
$filteredArrayinf = array_filter($data, 'filterArrayinf');
$continf=count ($filteredArrayinf);
// $pdf->SetXY(5,$pdf->GetY()+10);
// foreach($filteredArrayinf as $k => $v){
// $pdf->SetXY(5,$pdf->GetY()+5);    $pdf->cell(20,5,"$v",1,0,'C',1,0);	
// }
// $pdf->SetXY(5,$pdf->GetY()+10);    $pdf->cell(20,5,$continf,1,0,'C',1,0);
// $pdf->SetXY(5,$pdf->GetY()+10);    $pdf->cell(20,5,$contsup,1,0,'C',1,0);$pdf->SetXY(5,$pdf->GetY()+10);
$pdf->cell(25,5,'Homgeneite',1,0,'L',1,0); $pdf->cell(25,5,(100-($contsup+$continf)).'%',1,0,'C',0,0);
$pdf->setxy(5,$pdf->gety()+5);  $pdf->cell(25,5,'Moyenne The ',1,0,'L',1,0); $pdf->cell(25,5,$tablec[$rs['avisem']],1,0,'C',0,0);  $pdf->cell(25,5,'Z= ',1,0,'L',1,0); $pdf->cell(25,5,round((round($pdf->mean($data,$type="arithmetic"),2)-$tablec[$rs['avisem']])/(round($pdf->sd($data),2)/10),2),1,0,'C',0,0); 
$pdf->setxy(5,$pdf->gety()+5);  $pdf->cell(25,5,'IC95 M - ',1,0,'l',1,0);      $pdf->cell(25,5,round($pdf->mean($data,$type="arithmetic")-(1.96*round($pdf->sd($data),2))/10,2),1,0,'C',0); $pdf->cell(25,5,'moyenne : ',1,0,'l',1,0); $pdf->cell(25,5,round($pdf->mean($data,$type="arithmetic"),2),1,0,'C',0,0);$pdf->cell(25,5,'IC95 M +',1,0,'l',1,0); $pdf->cell(25,5,round($pdf->mean($data,$type="arithmetic")+(1.96*round($pdf->sd($data),2))/10,2),1,0,'C',0,0);  


$pdf->AddPage('L','A4');$pdf->SetDisplayMode('fullpage','single'); $pdf->SetFont('Arial','B',9);
$pdf->SetXY(5,$pdf->GetY()+2);  $pdf->cell(20,10,'Classe',1,0,'C',1,0);          $pdf->cell(20,10,'Centre',1,0,'C',1,0);    $pdf->cell(20,10,'Effectif',1,0,'C',1,0);  $pdf->cell(20,10,'Sum',1,0,'C',1,0);
$bare=10;
                                $datar=$pdf->histr($data, $bare);                $datarcc=$pdf->histrcc($data, $bare);      $datab=$pdf->histb($data, $bare);          $sum = 0;
for ($i = 0; $i < $bare; $i++) 
{
$nf=$datarcc[$i]*$datab[$i];$sum+=$nf;
$pdf->SetXY(5,$pdf->GetY()+10); $pdf->cell(20,10,"[".$datar[$i]."[",1,0,'C',1,0);$pdf->cell(20,10,$datarcc[$i],1,0,'C',0,0);$pdf->cell(20,10,$datab[$i],1,0,'C',0,0);  $pdf->cell(20,10,$nf,1,0,'C',0,0);         
}
$m10=(($sum/100)*10)/100;
$pdf->SetXY(5,$pdf->GetY()+10);  $pdf->cell(20,5,'Classe',1,0,'C',1,0);           $pdf->cell(20,5,'Centre',1,0,'C',1,0);    $pdf->cell(20,5,'100',1,0,'C',1,0);        $pdf->cell(20,5,$sum,1,0,'C',1,0);





$pdf->setxy(5,$pdf->gety()+10);  $pdf->cell(20,5,'count : n ',1,0,'l',1,0); $pdf->cell(20,5,$contd,1,0,'C',0);
$pdf->setxy(5,$pdf->gety()+5);   $pdf->cell(20,5,'min : ',1,0,'l',1,0);     $pdf->cell(20,5,$data[0],1,0,'C',0);  
$pdf->setxy(5,$pdf->gety()+5);   $pdf->cell(20,5,'max : ',1,0,'l',1,0);     $pdf->cell(20,5,$data[$contd - 1],1,0,'C',0);
$pdf->setxy(5,$pdf->gety()+5);   $pdf->cell(20,5,'etendue : ',1,0,'l',1,0); $pdf->cell(20,5,$data[$contd - 1]-$data[0],1,0,'C',0);
$pdf->setxy(5,$pdf->gety()+5);   $pdf->cell(20,5,'sum : ',1,0,'l',1,0);     $pdf->cell(20,5,$sum,1,0,'C',0);


$pdf->SetXY(5,$pdf->GetY()+5);  $pdf->cell(20,5,'m - 10 %',1,0,'L',1,0);$pdf->cell(20,5,($sum/100)-$m10,1,0,'C',0);
$pdf->SetXY(5,$pdf->GetY()+5);  $pdf->cell(20,5,'moyenne',1,0,'L',1,0); $pdf->cell(20,5,$sum/100,1,0,'C',0,0);
$pdf->SetXY(5,$pdf->GetY()+5);  $pdf->cell(20,5,'m + 10 %',1,0,'L',1,0);$pdf->cell(20,5,($sum/100)+$m10,1,0,'C',0);


$pdf->SetXY(5,$pdf->GetY()+5);  $pdf->cell(20,5,'Variance ',1,0,'L',1,0);$pdf->cell(20,5,'',1,0,'C',0,0);
$pdf->SetXY(5,$pdf->GetY()+5);  $pdf->cell(20,5,'Ecartype ',1,0,'L',1,0);$pdf->cell(20,5,'',1,0,'C',0,0);
$pdf->SetXY(5,$pdf->GetY()+5);  $pdf->cell(20,5,'IC95 m ',1,0,'L',1,0);  $pdf->cell(20,5,'',1,0,'C',0,0);

$avibtm=$rs['avibtm'];
$pdf->bar($x=110,$y=120,$w=15,$datab,$datar,$datarcc,$titre="Repartition du poids du  batiment : ".$avibtm);
$pdf->boxplotgv($x=260,$y=125,'',$data);

// $pdf->SetFillColor(255, 0, 0);
// $b=50;

// $c=$data[0];
// $d=$data[$contd - 1];
// $e=$d-$c;

// $pdf->SetXY(90,130-$b);  $pdf->cell(1,$b,'',1,0,'C',1,0);$pdf->SetXY(215,130-$b);  $pdf->cell(1,$b,'',1,0,'C',1,0);
// $pdf->SetXY(289,130-$b); $pdf->cell(1,$b,'',1,0,'C',1,0);

//199


$pdf->AddPage('L','A4');$pdf->SetDisplayMode('fullpage','single'); $pdf->SetFont('Arial','B',9);

$query = "SELECT * from avi where avibtm = $avibtm  order by avisem asc "; 
$pdf->SetXY(05,55); 
$resultat=mysql_query($query);
$totalmbr1=mysql_num_rows($resultat);
$aa= array();
while($row=mysql_fetch_object($resultat))
{
$aa[]=$row->code_patient;
$aa1[]=$row->avisem;
$aa2[]=$row->code_patient;
}
// $a1=array("red","green");
// $a2=array("blue","yellow");
// print_r(array_merge($a1,$a2));
// $tiba=array();
// $tiba=array_merge($aa1,$aa2);
$pdf->barni($x=110,$y=120,$w=15,$aa,$aa1,$aa2,$titre=" Evolution de la moyenne du poids : ".$totalmbr1." semaines du  batiment : ".$avibtm);

$pdf->AddPage('L','A4');$pdf->SetDisplayMode('fullpage','single'); $pdf->SetFont('Arial','B',9);
// define position
$y = 30; 
$w = 280;
$h = 80;
$x = 15;




	
// define title	
$repTitle = "Evolution de la moyenne du poids";
$arrData = array();
// define  data
$arrData[] = array(
	"title" => "*******",
	"color" => array(255,22,0),
	"data" => array(
		array("key"   => 1,"value" => $tablec[1]),
		array("key"   => 2,"value" => $tablec[2]),
		array("key"   => 3,"value" => $tablec[3]),
		array("key"   => 4,"value" => $tablec[4]),
		array("key"   => 5,"value" => $tablec[5]),
		array("key"   => 6,"value" => $tablec[6]),
		array("key"   => 7,"value" => $tablec[7]),
		array("key"   => 8,"value" => $tablec[8]),
		array("key"   => 9,"value" => $tablec[9]),
		array("key"   => 10,"value" => $tablec[10]),
	
	    array("key"   => 11,"value" => $tablec[11]),
		array("key"   => 12,"value" => $tablec[12]),
		array("key"   => 13,"value" => $tablec[13]),
		array("key"   => 14,"value" => $tablec[14]),
		array("key"   => 15,"value" => $tablec[15]),
		array("key"   => 16,"value" => $tablec[16]),
		array("key"   => 17,"value" => $tablec[17]),
		array("key"   => 18,"value" => $tablec[18]),
		array("key"   => 19,"value" => $tablec[19]),
		array("key"   => 20,"value" => $tablec[20]),
		
		array("key"   => 21,"value" => $tablec[21]),
		array("key"   => 22,"value" => $tablec[22]),
		array("key"   => 23,"value" => $tablec[23]),
		array("key"   => 24,"value" => $tablec[24]),
		array("key"   => 25,"value" => $tablec[25]),
		array("key"   => 26,"value" => $tablec[26]),
		array("key"   => 27,"value" => $tablec[27]),
		array("key"   => 28,"value" => $tablec[28]),
		array("key"   => 29,"value" => $tablec[29]),
		array("key"   => 30,"value" => $tablec[30]),
		
		array("key"   => 31,"value" => $tablec[31]),
		array("key"   => 32,"value" => $tablec[32]),
		array("key"   => 33,"value" => $tablec[33]),
		array("key"   => 34,"value" => $tablec[34]),
		array("key"   => 35,"value" => $tablec[35]),
		array("key"   => 36,"value" => $tablec[36]),
		array("key"   => 37,"value" => $tablec[37]),
		array("key"   => 38,"value" => $tablec[38]),
		array("key"   => 39,"value" => $tablec[39]),
		array("key"   => 40,"value" => $tablec[40]),
		
		array("key"   => 41,"value" => $tablec[41]),
		array("key"   => 42,"value" => $tablec[42]),
		array("key"   => 43,"value" => $tablec[43]),
		array("key"   => 44,"value" => $tablec[44]),
		array("key"   => 45,"value" => $tablec[45]),
		array("key"   => 46,"value" => $tablec[46]),
		array("key"   => 47,"value" => $tablec[47]),
		array("key"   => 48,"value" => $tablec[48]),
		array("key"   => 49,"value" => $tablec[49]),
		array("key"   => 50,"value" => $tablec[50]),
		
		array("key"   => 51,"value" => $tablec[51]),
		array("key"   => 52,"value" => $tablec[52]),
		array("key"   => 53,"value" => $tablec[53]),
		array("key"   => 54,"value" => $tablec[54]),
		array("key"   => 55,"value" => $tablec[55]),
		array("key"   => 56,"value" => $tablec[56]),
		array("key"   => 57,"value" => $tablec[57]),
		array("key"   => 58,"value" => $tablec[58]),
		array("key"   => 59,"value" => $tablec[59]),
		array("key"   => 60,"value" => $tablec[60]),
		array("key"   => 61,"value" => $tablec[61]),
		array("key"   => 62,"value" => $tablec[62]),
		array("key"   => 63,"value" => $tablec[63]),
		array("key"   => 64,"value" => $tablec[64]),
	
	)
);



$arrData[] = array(
	"title" => "+",
	"color" => array(0,225,0),
	"data"  => array(
		array("key"   => 1,"value" => $aa2[0]),
		
		// array("key"   => 2,"value" => $aa2[1]),
		// array("key"   => 3,"value" => $aa2[2]),
		// array("key"   => 4,"value" => $tablec[4]),
		// array("key"   => 5,"value" => $tablec[5]),
		// array("key"   => 6,"value" => $tablec[6]),
		// array("key"   => 7,"value" => $tablec[7]),
		// array("key"   => 8,"value" => $tablec[8]),
		// array("key"   => 9,"value" => $tablec[9]),
		// array("key"   => 10,"value" => $tablec[10]),
	
	    // array("key"   => 11,"value" => $tablec[11]),
		// array("key"   => 12,"value" => $tablec[12]),
		// array("key"   => 13,"value" => $tablec[13]),
		// array("key"   => 14,"value" => $tablec[14]),
		// array("key"   => 15,"value" => $tablec[15]),
		// array("key"   => 16,"value" => $tablec[16]),
		// array("key"   => 17,"value" => $tablec[17]),
		// array("key"   => 18,"value" => $tablec[18]),
		// array("key"   => 19,"value" => $tablec[19]),
		// array("key"   => 20,"value" => $tablec[20]),
		
		// array("key"   => 21,"value" => $tablec[21]),
		// array("key"   => 22,"value" => $tablec[22]),
		// array("key"   => 23,"value" => $tablec[23]),
		// array("key"   => 24,"value" => $tablec[24]),
		// array("key"   => 25,"value" => $tablec[25]),
		// array("key"   => 26,"value" => $tablec[26]),
		// array("key"   => 27,"value" => $tablec[27]),
		// array("key"   => 28,"value" => $tablec[28]),
		// array("key"   => 29,"value" => $tablec[29]),
		// array("key"   => 30,"value" => $tablec[30]),
		
		// array("key"   => 31,"value" => $tablec[31]),
		// array("key"   => 32,"value" => $tablec[32]),
		// array("key"   => 33,"value" => $tablec[33]),
		// array("key"   => 34,"value" => $tablec[34]),
		// array("key"   => 35,"value" => $tablec[35]),
		// array("key"   => 36,"value" => $tablec[36]),
		// array("key"   => 37,"value" => $tablec[37]),
		// array("key"   => 38,"value" => $tablec[38]),
		// array("key"   => 39,"value" => $tablec[39]),
		// array("key"   => 40,"value" => $tablec[40]),
		
		// array("key"   => 41,"value" => $tablec[41]),
		// array("key"   => 42,"value" => $tablec[42]),
		// array("key"   => 43,"value" => $tablec[43]),
		// array("key"   => 44,"value" => $tablec[44]),
		// array("key"   => 45,"value" => $tablec[45]),
		// array("key"   => 46,"value" => $tablec[46]),
		// array("key"   => 47,"value" => $tablec[47]),
		// array("key"   => 48,"value" => $tablec[48]),
		// array("key"   => 49,"value" => $tablec[49]),
		// array("key"   => 50,"value" => $tablec[50]),
		
		// array("key"   => 51,"value" => $tablec[51]),
		// array("key"   => 52,"value" => $tablec[52]),
		// array("key"   => 53,"value" => $tablec[53]),
		// array("key"   => 54,"value" => $tablec[54]),
		// array("key"   => 55,"value" => $tablec[55]),
		// array("key"   => 56,"value" => $tablec[56]),
		// array("key"   => 57,"value" => $tablec[57]),
		// array("key"   => 58,"value" => $tablec[58]),
		// array("key"   => 59,"value" => $tablec[59]),
		// array("key"   => 60,"value" => $tablec[60]),
		// array("key"   => 61,"value" => $tablec[61]),
		// array("key"   => 62,"value" => $tablec[62]),
		// array("key"   => 63,"value" => $tablec[63]),
		// array("key"   => 64,"value" => $tablec[64]),
	
	)
);



//pour plusieur courbe il sufit de renseigne un autre $arrData[]  avec d'autres valeurs 
$pdf->LineChart($x,$y,$w,$h,$repTitle,$arrData);

$pdf->Output();
?>