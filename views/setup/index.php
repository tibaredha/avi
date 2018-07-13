<div class="sheader1l"><p id="lsetup"><?php echo "";echo $this->msg; echo "";?></p></div><div class="sheader1r"><p id="lsetup"><?php html::NAV();?></p></div>
<div class="sheader2l"><p id="lsetup">1-Introduction</p></div><div class="sheader2r">sheader3</div>
<div class="contentl">

<form action="<?php echo URL;?>setup/step1" method="post">			
    <input type="hidden" name="nextStep" value="eula">
	<input  id="submits"   type="submit" value="Start" />
</form>

</div>	
<div class="content"><img id="image" src="<?php echo URL;?>public/images/setup.jpg"></div>
<div class="contentr"><img id="image" src="<?php echo URL;?>public/images/<?php echo logod;?>"></div>

	
<div class="scontentl2"><?php echo "";echo $this->msg; echo "";?></div>		
<div class="scontentl3"><?php echo "";echo $this->msg; echo "";?></div>
<div class="scontentr1"><?php echo "";echo dsp; echo "";?></div>		