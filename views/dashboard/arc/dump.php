<div class="sheader1l">
<?php
Session::init();
if (isset($_SESSION['errorlogin'])) {
$sError = '<p id="errorlogin">' . $_SESSION['errorlogin'] . '</p>';		
echo $sError;			
}
else
{
$sError='<p id="llogin">Dump Sauvegarde data base</p>';
echo $sError;
}
?>
</div>
<div class="sheader1r"><p id="llogin"><?php html::NAV();?></p></div>
<div class="sheader2l">
Gérer les certificats de décès
</div>
<div class="sheader2r">***</div>
<div class="contentl ">
<?php 

HTML::dump_MySQL($_SERVER['SERVER_NAME'],"root","","framework",2);

?>

</div>	
<div class="content"><img id="image" src="<?php echo URL;?>public/images/dump.jpg" ></div>
<div class="contentr"><img id="image" src="<?php echo URL;?>public/images/<?php echo logo;?>"></div>	

	
<div class="scontentl2"><?php echo "";echo $this->msg; echo "";?></div>		
<div class="scontentl3"><?php ?></div>
<div class="scontentr1"><?php echo "";echo dsp; echo "";?></div>		

