<div class="sheader1l">
<?php
Session::init();
if (isset($_SESSION['errorlogin'])) {
$sError = '<p id="errorlogin">' . $_SESSION['errorlogin'] . '</p>';		
echo $sError;			
}
else
{
$sError='<p id="llogin">Connecter</p>';
echo $sError;
}
?>
</div>
<div class="sheader1r"><p id="llogin"><?php html::NAV();?></p></div>
<div class="sheader2l">
Gérer les image data base 
</div>
<div class="sheader2r">***</div>
<div class="contentl formaut">

<?php 
function transfert(){
$ret = false;
$img_blob = '';
$img_taille = 0;
$img_type = '';
$img_nom = '';
$taille_max = 250000;
$ret = is_uploaded_file($_FILES['fic']['tmp_name']);
if (!$ret) 
{
	echo "Problème de transfert";
	return false;
} 
else 
{
	// Le fichier a bien été reçu
	$img_taille = $_FILES['fic']['size'];
	if ($img_taille > $taille_max) 
	{
		echo "Trop gros !";
		return false;
	}

	$img_type = $_FILES['fic']['type'];
	$img_nom  = $_FILES['fic']['name'];
	
	$hote = 'localhost';
	$base = 'avi';
	$user = 'root';
	$pass = '';
	$cnx = mysql_connect($hote, $user, $pass) or die(mysql_error());
	$ret = mysql_select_db($base) or die(mysql_error());
	$img_blob = file_get_contents ($_FILES['fic']['tmp_name']);
	
	$req = "INSERT INTO images (" ."img_nom, img_taille, img_type, img_blob " .") VALUES (" ."'" . $img_nom . "', " ."'" . $img_taille . "', " ."'" . $img_type . "', " ."'" .addslashes($img_blob)."') ";
	$ret = mysql_query ($req) or die (mysql_error ());
	return true;	
}

}


?>


<?php

if ( isset($_FILES['fic']) )
{
transfert();
}
?>

<h3>Envoi d'une image</h3>
<form enctype="multipart/form-data" action="#" method="post">
<input type="hidden" name="MAX_FILE_SIZE" value="250000" />
<input type="file" name="fic" size=50 />
<input type="submit" value="Envoyer" />
</form>

<?php
$hote = 'localhost';
$base = 'avi';
$user = 'root';
$pass = '';
$cnx = mysql_connect($hote, $user, $pass) or die(mysql_error());
$ret = mysql_select_db($base) or die(mysql_error());
$req = "SELECT img_nom, img_id FROM images ORDER BY img_nom";

$ret = mysql_query ($req) or die (mysql_error ());
while ( $col = mysql_fetch_row ($ret) )
{
echo "<a href=\"".URL."dashboard/fimage/".$col[1]."\">" . $col[0] . "</a><br />";

}
?>


</div>	
<div class="content"><img id="image" src="<?php echo URL;?>public/images/Login.jpg" ></div>
<div class="contentr"><img id="image" src="<?php echo URL;?>public/images/<?php echo logod;?>"></div>	

	
<div class="scontentl2"><?php echo "Date d'expiration : ".Session::dateexpiration; ?></div>		
<div class="scontentl3"><?php html::rsc();?></div>
<div class="scontentr1"><?php echo "";echo dsp; echo "";?></div>		

