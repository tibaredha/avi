<div class="sheader1l">
<?php
Session::init();
if (isset($_SESSION['errorlogin'])) {
$sError = '<p id="errorlogin">' . $_SESSION['errorlogin'] . '</p>';		
echo $sError;			
}
else
{
$sError='<p id="llogin">importation</p>';
echo $sError;
}
?>
</div>
<div class="sheader1r"><p id="llogin"><?php html::NAV();?></p></div>
<div class="sheader2l">
Gérer les certificats de décès
</div>
<div class="sheader2r">***</div>
<div class="contentl formaut">
<?php

	//include '../../libs/simplexlsx.class.php';
    include './libs/simplexlsx.class.php';
    //$xlsx = new SimpleXLSX( '../../libs/deces.xlsx' );
	$xlsx = new SimpleXLSX( './libs/deces.xlsx' );
    try {
       $conn = new PDO( "mysql:host=localhost;dbname=framework", "root", "");
       $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e)
    {
        echo $sql . "<br>" . $e->getMessage();
    }
    $stmt = $conn->prepare( "INSERT INTO deceshosp ( WILAYAD,COMMUNED,STRUCTURED,NOM,PRENOM,FILSDE,ETDE,SEX,DATENAISSANCE,Days,Weeks,Months,Years,WILAYA,WILAYAR,COMMUNE,COMMUNER,ADRESSE,CIM1,CIM2,CIM3,CIM4,CIM5,NDLMAAP,CD,LD,AUTRES,NDLM,DECEMAT,GRS,DATEHOSPI,SERVICEHOSPIT,DUREEHOSPIT,MEDECINHOSPIT,DINS,HINS) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)"); 
											     										  
    $stmt->bindParam( 1, $WILAYAD);
    $stmt->bindParam( 2, $COMMUNED);
    $stmt->bindParam( 3, $STRUCTURED);
    $stmt->bindParam( 4, $NOM);
    $stmt->bindParam( 5, $PRENOM);
    $stmt->bindParam( 6, $FILSDE);
    $stmt->bindParam( 7, $ETDE);
    $stmt->bindParam( 8, $SEX);
    $stmt->bindParam( 9, $DATENAISSANCE);
    $stmt->bindParam( 10, $Days);
    $stmt->bindParam( 11, $Weeks);
    $stmt->bindParam( 12, $Months);
    $stmt->bindParam( 13, $Years);
    $stmt->bindParam( 14, $WILAYA);
    $stmt->bindParam( 15, $WILAYAR);
    $stmt->bindParam( 16, $COMMUNE);
	$stmt->bindParam( 17, $COMMUNER);
    $stmt->bindParam( 18, $ADRESSE);
    $stmt->bindParam( 19, $CIM1);
    $stmt->bindParam( 20, $CIM2);
    $stmt->bindParam( 21, $CIM3);
    $stmt->bindParam( 22, $CIM4);
    $stmt->bindParam( 23, $CIM5);
    $stmt->bindParam( 24, $NDLMAAP);
    $stmt->bindParam( 25, $CD);
    $stmt->bindParam( 26, $LD);
    $stmt->bindParam( 27, $AUTRES);
    $stmt->bindParam( 28, $NDLM);
    $stmt->bindParam( 29, $DECEMAT);
    $stmt->bindParam( 30, $GRS);
    $stmt->bindParam( 31, $DATEHOSPI);
    $stmt->bindParam( 32, $SERVICEHOSPIT);
    $stmt->bindParam( 33, $DUREEHOSPIT);
    $stmt->bindParam( 34, $MEDECINHOSPIT);
    $stmt->bindParam( 35, $DINS);
    $stmt->bindParam( 36, $HINS);
	
	foreach ($xlsx->rows() as $fields)
    {
		$WILAYAD = $fields[0];
		$COMMUNED = $fields[1];
		$STRUCTURED = $fields[2];
		$NOM = $fields[3];
		$PRENOM = $fields[4];
		$FILSDE= $fields[5];
		$ETDE= $fields[6];
		$SEX= $fields[7];
		$DATENAISSANCE= $fields[8];
		$Days= $fields[9];
		$Weeks= $fields[10];
		$Months= $fields[11];
		$Years= $fields[12];
		$WILAYA= $fields[13];
		$WILAYAR= $fields[14];
		$COMMUNE= $fields[15];
		$COMMUNER= $fields[16];
	    $ADRESSE= $fields[17];
		$CIM1= $fields[18];
		$CIM2= $fields[19];
		$CIM3= $fields[20];
		$CIM4= $fields[21];
		$CIM5= $fields[22];
		$NDLMAAP= $fields[23];
		$CD= $fields[24];
		$LD= $fields[25];
		$AUTRES= $fields[26];
		$NDLM= $fields[27];
		$DECEMAT= $fields[28];
		$GRS= $fields[29];
		$DATEHOSPI= $fields[30];
		$SERVICEHOSPIT= $fields[31];
		$DUREEHOSPIT= $fields[32];
		$MEDECINHOSPIT= $fields[33];
		$DINS= $fields[34];
		$HINS= $fields[35];
		$stmt->execute();
    }
	echo "importation faite avec succes";
?>	
</div>	
<div class="content"><img id="image" src="<?php echo URL;?>public/images/import.jpg" ></div>
<div class="contentr"><img id="image" src="<?php echo URL;?>public/images/<?php echo logo;?>"></div>	
<div class="scontentl2"><?php echo "";echo $this->msg; echo "";?></div>		
<div class="scontentl3"><?php ?></div>
<div class="scontentr1"><?php echo "";echo dsp; echo "";?></div>	
	
	
	
	
	
	
	
	
	
	
	