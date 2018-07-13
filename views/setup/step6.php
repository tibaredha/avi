<div class="sheader1l"><p id="lsetup"><?php echo "";echo $this->msg; echo "";?></p></div><div class="sheader1r"><p id="lsetup"><?php html::NAV();?></p></div>
<div class="sheader2l"><p id="lsetup">7-Done</p></div><div class="sheader2r">sheader3</div>
<div class="contentl">
<p>Installation finished! <b>Please delete the "setup" folder now.</b></p>

<p>Now you can login with the default administrator account and password</p>

<ul>
	<li>Username: <b>admin</b></li>
	<li>Password: <b>admin</b></li>
</ul>

<p>Please change the default password after you logged in!</p>

<form action="<?php echo URL;?>login" method="post">			
   
	<input  id="submits"   type="submit" />
</form>

</div>	
<div class="content"><img id="image" src="<?php echo URL;?>public/images/OK.jpg"></div>
<div class="contentr"><img id="image" src="<?php echo URL;?>public/images/<?php echo logod;?>"></div>

	
<div class="scontentl2"><?php echo "";echo $this->msg; echo "";?></div>		
<div class="scontentl3"><?php echo "";echo $this->msg; echo "";?></div>
<div class="scontentr1"><?php echo "";echo dsp; echo "";?></div>		