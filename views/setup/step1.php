<div class="sheader1l"><p id="lsetup"><?php echo "";echo $this->msg; echo "";?></p></div><div class="sheader1r"><p id="lsetup"><?php html::NAV();?></p></div>
<div class="sheader2l"><p id="lsetup">2-EULA</p></div><div class="sheader2r">sheader3</div>
<div class="contentl">

<div >You must accept the EULA to continue!</div>
<textarea class="info" style="height: 230px; width: 100%;">
<?php
$eula = file_get_contents(URL."views\setup\eula.txt");
echo $eula; 
?>
</textarea>
<form action="<?php echo URL;?>setup/step2" method="post">			
    <a id="Cancel" href="<?php echo URL;?>setup/" ><img src="<?php echo URL;?>public/images/icons/cross.png" alt=""/> Cancel </a>
	<input type="hidden"  name="nextStep" value="requirements">
	<input  id="submits"   type="submit"  value="I accept the EULA"   />
</form>

</div>	
<div class="content"><img id="image" src="<?php echo URL;?>public/images/EULA.jpg"></div>
<div class="contentr"><img id="image" src="<?php echo URL;?>public/images/<?php echo logod;?>"></div>

	
<div class="scontentl2"><?php echo "";echo $this->msg; echo "";?></div>		
<div class="scontentl3"><?php echo "";echo $this->msg; echo "";?></div>
<div class="scontentr1"><?php echo "";echo dsp; echo "";?></div>		