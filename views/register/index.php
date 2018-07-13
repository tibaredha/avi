<div class="sheader1l">
<?php
Session::init();
if (isset($_SESSION['errorregister'])) {
$sError = '<p id="errorregister">' . $_SESSION['errorregister'] . '</p>';		
echo $sError;			
}
else
{
$sError='<p id="lregister">Register</p>';
echo $sError;
}
?>
</div>
<div class="sheader1r"><p id="lregister"><?php html::NAV();?></p></div>
<div class="sheader2l">
Gérer les certificats de décès
</div>
<div class="sheader2r">***</div>
<div class="contentl formaut">
    <div class="form-style-10">
    <form class="tabaut"action="register/Registerrun" method="post">	
	    <?php 
		// echo "<p>";
		// echo "<select  name=\"demgraphie\">";
		// echo '<option value="1">Deces</option>';
		// echo '<option value="2">Naissance</option>';
		// echo "</select>";
		// echo "</p> ";
		?>
	    <div class="section"><span>1</span>Wilaya</div>
		<div class="inner-wrap"><?php HTML::WILAYA('wilaya','wilayarg','wilaya','wil','17000','wilaya') ;?></div>
		<div class="section"><span>2</span>Structure</div>
		<div class="inner-wrap"><?php HTML::structure('structure','structurerg','structure','01','structure') ?></div>
		<div class="section"><span>3</span>Login</div>
		<div class="inner-wrap"><input  type="text" name="login" onkeyup="javascript:this.value=this.value.toUpperCase();" required=""  /></div>
		<div class="section"><span>4</span>Password</div>
		<div class="inner-wrap"><input type="password" name="password" required="" /></div>
	    </br>
		<div class="inner-wrap"><input  type="submit" /></div>
	
	</form>
	</div>
</div>	
<div class="content"><img id="image" src="<?php echo URL;?>public/images/register.jpg"></div>
<div class="contentr"><img id="image" src="<?php echo URL;?>public/images/<?php echo logod;?>"></div>	

	
<div class="scontentl2">
<?php 
echo "<a href='javascript:self.history.back();'>Go Back</a>";//link to the previous page
//echo "";
//echo $this->msg; echo "";
?>
</div>		
<div class="scontentl3"><?php html::rsc();?></div>
<div class="scontentr1"><?php echo "";echo dsp; echo "";?></div>		
