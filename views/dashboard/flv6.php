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
<?php echo $this->flv ;?>
</div>
<div class="sheader2r">sheader2R</div>
<div class="contentl">

<center></br>
<object type="application/x-shockwave-flash" data="<?php echo URL;?>views/dashboard/music/player_flv.swf" width="500" height="350">
	<param name="movie" value="player_flv.swf" />
	<param name="allowFullScreen" value="true" />
	<param name="FlashVars" value="flv=<?php echo $this->flv ;?>" />
</object>
</center>
</div>	


<div class="content"><img id="image" src="<?php echo URL;?>public/images/video1.png" ></div>
<div class="contentr"><img id="image" src="<?php echo URL;?>public/images/<?php echo logo;?>"></div>	

	
<div class="scontentl2"><?php echo "";echo $this->msg; echo "";?></div>		
<div class="scontentl3"><?php ?></div>
<div class="scontentr1"><?php echo "";echo dsp; echo "";?></div>	



