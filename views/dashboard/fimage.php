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

 

if ( isset($this->id) )
{
	// $id = intval (1);
	$id = intval ($this->id);
	$hote = 'localhost';
	$base = 'avi';
	$user = 'root';
	$pass = '';
	$cnx = mysql_connect($hote, $user, $pass) or die(mysql_error());
	$ret = mysql_select_db($base) or die(mysql_error());
	$req = "SELECT * FROM images WHERE img_id = " . $id;
	$ret = mysql_query ($req) or die (mysql_error ());
	$col = mysql_fetch_row ($ret);

	if ( !$col[0] )
	{
	echo "Id d'image inconnu";
	} 
	else 
	{
	header ("Content-type: " . $col[1]);
    echo $col[2];
	}

} 
else 
{
echo "Mauvais id d'image";
}


?>




</div>	
<div class="content"><img id="image" src="<?php echo URL;?>public/images/Login.jpg" ></div>
<div class="contentr"><img id="image" src="<?php echo URL;?>public/images/<?php echo logod;?>"></div>	

	
<div class="scontentl2"><?php echo "Date d'expiration : ".Session::dateexpiration; ?></div>		
<div class="scontentl3"><?php html::rsc();?></div>
<div class="scontentr1"><?php echo "";echo dsp; echo "";?></div>		

