<?php
function dateFR2US($date)//01/01/2013
	{
	$J      = substr($date,0,2);
    $M      = substr($date,3,2);
    $A      = substr($date,6,4);
	$dateFR2US =  $A."-".$M."-".$J ;
    return $dateFR2US;//2013-01-01
	}
function mysqlconnect()
{
$nomprenom ="tibaredha";
$db_host="localhost";
$db_name="deces"; //probleme avec base de donnes  il faut change  gpts avec mvc   
$db_user="root";
$db_pass="";
$utf8 = "" ;
$cnx = mysql_connect($db_host,$db_user,$db_pass)or die ('I cannot connect to the database because: ' . mysql_error());
$db  = mysql_select_db($db_name,$cnx) ;
mysql_query("SET NAMES 'UTF8' ");
return $db;
}
function nbrtostring($tb_name,$colonename,$colonevalue,$resultatstring) 
{
if (is_numeric($colonevalue) and $colonevalue!=='0') 
{ 
mysqlconnect();
$result = mysql_query("SELECT * FROM $tb_name where $colonename=$colonevalue" );
$row=mysql_fetch_object($result);
$resultat=$row->$resultatstring;
return $resultat;
} 
return $resultat2='??????';
}
require('deces.php');
$pdf = new deces();$pdf->AliasNbPages();
$ID=$_GET["uc"];
mysqlconnect();
$query = "SELECT * FROM deceshosp where id='".$ID."'  ";
$resultat=mysql_query($query);
while($row=mysql_fetch_object($resultat))
{
// if($row->Days >= 28)
// {
   // header('location: ../dashboard/search/0/10?o=NOM&q=');
// }



$pdf->AddPage();
$pdf->setSourceFile('fcdpn.pdf');
$tplIdx = $pdf->importPage(1);
$pdf->useTemplate($tplIdx, 5, 5, 200);
$pdf->SetFont('Arial','B',10);


$pdf->SetFont('Arial','B',08);
$pdf->SetXY(64,35.5);$pdf->Write(0,'ETABLISSEMENT DE SANTE : '.nbrtostring('structure','id',intval(trim($row->STRUCTURED)),'structure'));
$pdf->SetFont('Arial','B',10);
$pdf->SetTextColor(255,0,0);

// $pdf->SetXY(36,46);$pdf->Write(0,"Djelfa");
$pdf->SetXY(80,75);$pdf->Write(0,$row->NOM.'_'.$row->PRENOM);
$pdf->SetXY(80,75+6);$pdf->Write(0,nbrtostring('structure','id',intval(trim($row->STRUCTURED)),'structure'));
$pdf->SetXY(80,75+6+7);$pdf->Write(0,$row->ADRESSE);
$pdf->SetXY(80,75+6+7+6);$pdf->Write(0,$row->NOM.'_'.$row->FILSDE);
$pdf->SetXY(80,75+6+7+6+6);$pdf->Write(0,'/***/');
$pdf->SetXY(80,75+6+7+6+6+6);$pdf->Write(0,$row->ADRESSE);
$pdf->SetXY(80,75+6+7+6+6+6+6+5);$pdf->Write(0,$row->ETDE);$pdf->SetXY(140,75+6+7+6+6+6+6+5);$pdf->Write(0,'/***/');
$pdf->SetXY(80,75+6+7+6+6+6+6+5+10);$pdf->Write(0,$row->ADRESSE);


$pdf->SetXY(80,75+6+7+6+6+6+6+5+10+28);$pdf->Write(0,$_POST['p1']);
$pdf->SetXY(80,75+6+7+6+6+6+6+5+10+36);$pdf->Write(0,nbrtostring('WIL','IDWIL',$row->WILAYAD,'WILAYAS'));
$pdf->SetXY(80,75+6+7+6+6+6+6+5+10+46);$pdf->Write(0,nbrtostring('com','IDCOM',$row->COMMUNED,'COMMUNE'));
// $pdf->SetXY(46,46+21.5);$pdf->Write(0,$row->DATENAISSANCE);
// $pdf->SetXY(73,46+28);$pdf->Write(0,$row->ADRESSE.'_'.$row->COMMUNER);


switch($_POST['p4'])  
		{
			case '1':
				{
				$pdf->SetXY(110,187);$pdf->Write(0,'X');$pdf->SetXY(162,187+19);$pdf->Write(0,'1');
				
				break;
				}
				
			case '2':
				{
				$pdf->SetXY(110,187+10);$pdf->Write(0,'X');$pdf->SetXY(162,187+19);$pdf->Write(0,'2');
				break;
				}
			case '3':
				{
				$pdf->SetXY(110,187+22);$pdf->Write(0,'X');$pdf->SetXY(162,187+19);$pdf->Write(0,'3');
				break;
				}		
			case '4':
				{
				$pdf->SetXY(110,187+32);$pdf->Write(0,'X');$pdf->SetXY(162,187+19);$pdf->Write(0,'4');
				break;
				}
			case '5':
				{
				$pdf->SetXY(110,187+42);$pdf->Write(0,'X');$pdf->SetXY(162,187+19);$pdf->Write(0,'5');
				break;
				}		
		}


$pdf->AddPage();
$pdf->setSourceFile('fcdpn.pdf');
$tplIdx = $pdf->importPage(2);
$pdf->useTemplate($tplIdx, 5, 5, 200);
$pdf->SetFont('Arial','B',10);
$pdf->SetTextColor(255,0,0);
$pdf->SetXY(70,15);$pdf->Write(0,$_POST['p1'].':'.$row->NOM.'_'.$row->PRENOM.' / '.nbrtostring('structure','id',intval(trim($row->STRUCTURED)),'structure'));
switch($_POST['p5'])  
		{
			case '1':
				{
				$pdf->SetXY(117,49);$pdf->Write(0,'X');$pdf->SetXY(167,49+3);$pdf->Write(0,'1');
				
				break;
				}
				
			case '2':
				{
				$pdf->SetXY(117,49+5);$pdf->Write(0,'X');$pdf->SetXY(167,49+3);$pdf->Write(0,'2');
				
				break;
				}
		}

switch($_POST['p6'])  
		{
			case '1':
				{
				$pdf->SetXY(117,49+12);$pdf->Write(0,'X');$pdf->SetXY(167,49+14);$pdf->Write(0,'1');
				
				break;
				}
				
			case '2':
				{
				$pdf->SetXY(117,49+18);$pdf->Write(0,'X');$pdf->SetXY(167,49+14);$pdf->Write(0,'2');
				
				break;
				}
		}

switch($_POST['p7'])  
		{
			case '1':
				{
				$pdf->SetXY(116,49+24);$pdf->Write(0,'X');$pdf->SetXY(167,80);$pdf->Write(0,'1');
				
				break;
				}
			case '2':
				{
				$pdf->SetXY(116,49+31);$pdf->Write(0,'X');$pdf->SetXY(167,80);$pdf->Write(0,'2');
				
				break;
				}	
			case '3':
				{
				$pdf->SetXY(116,49+38);$pdf->Write(0,'X');$pdf->SetXY(167,80);$pdf->Write(0,'3');
				
				break;
				}	
		}
switch($_POST['p8'])  
		{
			case '1':
				{
				$pdf->SetXY(116,49+45);$pdf->Write(0,'X');$pdf->SetXY(167,49+52);$pdf->Write(0,'1');
				
				break;
				}
			case '2':
				{
				$pdf->SetXY(116,49+51);$pdf->Write(0,'X');$pdf->SetXY(167,49+52);$pdf->Write(0,'2');
				
				break;
				}
			case '3':
				{
				$pdf->SetXY(116,49+58);$pdf->Write(0,'X');$pdf->SetXY(167,49+52);$pdf->Write(0,'3');
				
				break;
				}	
		}

$pdf->SetXY(99,46+68);   $pdf->Write(0,substr($row->DATENAISSANCE,8,2));//0000-00-00
$pdf->SetXY(99,46+68+5); $pdf->Write(0,substr($row->DATENAISSANCE,5,2));
$pdf->SetXY(99,46+68+10);$pdf->Write(0,substr($row->DATENAISSANCE,0,4));
$pdf->SetXY(99,46+68+15);$pdf->Write(0,'***');

$pdf->SetXY(99,46+68+22);   $pdf->Write(0,substr($row->DINS,8,2));//0000-00-00
$pdf->SetXY(99,46+68+28); $pdf->Write(0,substr($row->DINS,5,2));
$pdf->SetXY(99,46+68+34);$pdf->Write(0,substr($row->DINS,0,4));
$pdf->SetXY(99,46+68+39);$pdf->Write(0,$row->HINS);


$pdf->SetXY(80,46+68+48);$pdf->Write(0,$_POST['p11']);
$pdf->SetXY(99,46+68+55);$pdf->Write(0,$_POST['p12']);
$pdf->SetXY(99,46+68+60);$pdf->Write(0,$_POST['p13']);

switch($_POST['p14'])  
		{
			case '1':
				{
				$pdf->SetXY(116,184);$pdf->Write(0,'X');$pdf->SetXY(167,190);$pdf->Write(0,'1');
				break;
				}
			case '2':
				{
				$pdf->SetXY(116,189);$pdf->Write(0,'X');$pdf->SetXY(167,190);$pdf->Write(0,'2');
				break;
				}
				
			case '3':
				{
				$pdf->SetXY(116,195);$pdf->Write(0,'X');$pdf->SetXY(167,190);$pdf->Write(0,'3');
				break;
				}
			case '4':
				{
				$pdf->SetXY(116,200);$pdf->Write(0,'X');$pdf->SetXY(167,190);$pdf->Write(0,'4');
				break;
				}		
		}
$pdf->AddPage();
$pdf->setSourceFile('fcdpn.pdf');
$tplIdx = $pdf->importPage(3);
$pdf->useTemplate($tplIdx, 5, 5, 200);
$pdf->SetFont('Arial','B',10);
$pdf->SetTextColor(255,0,0);
$pdf->SetXY(70,15);$pdf->Write(0,$_POST['p1'].':'.$row->NOM.'_'.$row->PRENOM.' / '.nbrtostring('structure','id',intval(trim($row->STRUCTURED)),'structure'));
switch($_POST['p15'])  
		{
			case '1':
				{
				$pdf->SetXY(112,60);$pdf->Write(0,'X');$pdf->SetXY(162,78);$pdf->Write(0,'1');
				
				break;
				}
			case '1':
				{
				$pdf->SetXY(112,67);$pdf->Write(0,'X');$pdf->SetXY(162,78);$pdf->Write(0,'2');
				
				break;
				}	
			case '3':
				{
				$pdf->SetXY(112,73);$pdf->Write(0,'X');$pdf->SetXY(162,78);$pdf->Write(0,'3');
				
				break;
				}
			case '4':
				{
				$pdf->SetXY(112,83);$pdf->Write(0,'X');$pdf->SetXY(162,78);$pdf->Write(0,'4');
				
				break;
				}	
			case '5':
				{
				$pdf->SetXY(112,94);$pdf->Write(0,'X');$pdf->SetXY(162,78);$pdf->Write(0,'5');
				
				break;
				}	
				
		}


switch($_POST['p16'])  
		{
			
			case '1':
				{
				$pdf->SetXY(112,115);$pdf->Write(0,'X');$pdf->SetXY(162,140);$pdf->Write(0,'1');
				
				break;
				}	
			case '2':
				{
				$pdf->SetXY(112,125);$pdf->Write(0,'X');$pdf->SetXY(162,140);$pdf->Write(0,'2');
				
				break;
				}	
			case '3':
				{
				$pdf->SetXY(112,136);$pdf->Write(0,'X');$pdf->SetXY(162,140);$pdf->Write(0,'3');
				
				break;
				}
			case '4':
				{
				$pdf->SetXY(112,148);$pdf->Write(0,'X');$pdf->SetXY(162,140);$pdf->Write(0,'4');
				
				break;
				}
			case '5':
				{
				$pdf->SetXY(112,157);$pdf->Write(0,'X');$pdf->SetXY(162,140);$pdf->Write(0,'5');
				
				break;
				}
			case '6':
				{
				$pdf->SetXY(112,164);$pdf->Write(0,'X');$pdf->SetXY(162,140);$pdf->Write(0,'6');
				
				break;
				}

			case '7':
				{
				$pdf->SetXY(112,170);$pdf->Write(0,'X');$pdf->SetXY(162,140);$pdf->Write(0,'7');
				
				break;
				}	
		}

$pdf->SetXY(115,188);$pdf->Write(0,$_POST['p17']);


$pdf->AddPage();
$pdf->setSourceFile('fcdpn.pdf');
$tplIdx = $pdf->importPage(4);
$pdf->useTemplate($tplIdx, 5, 5, 200);
$pdf->SetFont('Arial','B',10);
$pdf->SetTextColor(255,0,0);
$pdf->SetXY(70,15);$pdf->Write(0,$_POST['p1'].':'.$row->NOM.'_'.$row->PRENOM.' / '.nbrtostring('structure','id',intval(trim($row->STRUCTURED)),'structure'));

$pdf->SetXY(115,60);$pdf->Write(0,$_POST['p18']);
$pdf->SetXY(115,70);$pdf->Write(0,$_POST['p19']);
$pdf->SetXY(115,80);$pdf->Write(0,$_POST['p20']);


switch($_POST['p21'])  
		{
			case '1':
				{
				$pdf->SetXY(117,90);$pdf->Write(0,'X');$pdf->SetXY(169,113);$pdf->Write(0,'1');
				break;
				}
			case '2':
				{
				$pdf->SetXY(117,98);$pdf->Write(0,'X');$pdf->SetXY(169,113);$pdf->Write(0,'2');
				break;
				}
            case '3':
				{
				$pdf->SetXY(117,104);$pdf->Write(0,'X');$pdf->SetXY(169,113);$pdf->Write(0,'3');
				break;
				}
            case '4':
				{
				$pdf->SetXY(117,113);$pdf->Write(0,'X');$pdf->SetXY(169,113);$pdf->Write(0,'4');
				break;
				}
			case '5':
				{
				$pdf->SetXY(117,119);$pdf->Write(0,'X');$pdf->SetXY(169,113);$pdf->Write(0,'5');
				break;
				}
	        case '6':
				{
				$pdf->SetXY(117,126);$pdf->Write(0,'X');$pdf->SetXY(169,113);$pdf->Write(0,'6');
				break;
				}
             case '7':
				{
				$pdf->SetXY(117,134);$pdf->Write(0,'X');$pdf->SetXY(169,113);$pdf->Write(0,'7');
				break;
				}		
		}


switch($_POST['p22'])  
		{
             case '1':
				{
				$pdf->SetXY(115,142);$pdf->Write(0,'X');$pdf->SetXY(169,150);$pdf->Write(0,'1');
				break;
				}
			case '2':
				{
				$pdf->SetXY(115,150);$pdf->Write(0,'X');$pdf->SetXY(169,150);$pdf->Write(0,'2');
				break;
				}
			case '3':
				{
				$pdf->SetXY(116,158);$pdf->Write(0,'X');$pdf->SetXY(169,150);$pdf->Write(0,'3');
				break;
				}	
		}
switch($_POST['p23'])  
		{  
			case '1':
				{
				$pdf->SetXY(116,167);$pdf->Write(0,'X');$pdf->SetXY(169,170);$pdf->Write(0,'1');
				break;
				}
            case '2':
				{
				$pdf->SetXY(116,174);$pdf->Write(0,'X');$pdf->SetXY(169,170);$pdf->Write(0,'2');
				break;
				}		
		}

switch($_POST['p24'])  
		{  
            case '1':
				{
				$pdf->SetXY(116,182);$pdf->Write(0,'X');$pdf->SetXY(169,190);$pdf->Write(0,'1');
				break;
				}
			 case '2':
				{
				$pdf->SetXY(116,190);$pdf->Write(0,'X');$pdf->SetXY(169,190);$pdf->Write(0,'2');
				break;
				}
			case '3':
				{
				$pdf->SetXY(116,199);$pdf->Write(0,'X');$pdf->SetXY(169,190);$pdf->Write(0,'3');
				break;
				}	
		}
$pdf->SetXY(80,208);$pdf->Write(0,$row->MEDECINHOSPIT);

switch($_POST['p25'])  
		{  
			case '1':
				{
				$pdf->SetXY(117,218);$pdf->Write(0,'X');$pdf->SetXY(169,227);$pdf->Write(0,'1');
				break;
				}
			case '2':
				{
				$pdf->SetXY(117,225);$pdf->Write(0,'X');$pdf->SetXY(169,227);$pdf->Write(0,'2');
				break;
				}
			case '3':
				{
				$pdf->SetXY(117,232);$pdf->Write(0,'X');$pdf->SetXY(169,227);$pdf->Write(0,'3');
				break;
				}
			case '4':
				{
				$pdf->SetXY(117,238);$pdf->Write(0,'X');$pdf->SetXY(169,227);$pdf->Write(0,'4');
				break;
				}		
		}


}
$pdf->Output();
?>