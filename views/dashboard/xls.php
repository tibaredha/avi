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
<div class="sheader2l"></div>
<div class="sheader2r">sheader2R</div>
<div class="contentl">
<?php 
HTML::XLS($_SERVER['SERVER_NAME'],Session::get('structure'),$this->d1,$this->d2);
?>

</div>	
<div class="content"><img id="image" src="<?php echo URL;?>public/images/xls.png" ></div>
<div class="contentr"><img id="image" src="<?php echo URL;?>public/images/<?php echo logo;?>"></div>		
<div class="scontentl2"><?php echo " Du "; echo $this->d1 ; echo " Au "; echo $this->d2;?></div>		
<div class="scontentl3"><?php ?></div>
<div class="scontentr1"><?php echo "";echo dsp; echo "";?></div>		

