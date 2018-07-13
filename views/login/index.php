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
Gérer les certificats de décès
</div>
<div class="sheader2r">***</div>
<div class="contentl formaut">
<div class="form-style-10   ">
<form  action="login/run" method="post">			
<?php 
echo "<p>";
echo "<select  name=\"demgraphie\">";
echo '<option value="1">Deces</option>';
echo '<option value="2">Naissance</option>';
echo "</select>";
echo "</p> ";
?>
<div class="section"><span>1</span>login</div>
<div class="inner-wrap"><input type="text" name="login" onkeyup="javascript:this.value=this.value.toUpperCase();" required=""/>
</div>
<div class="section"><span>2</span>Passwords</div>
<div class="inner-wrap"><input   type="password" name="password" /></div>
</br>
<div class="inner-wrap"><input    type="submit" /></div>
</form>
</div>	

</div>	
<div class="content"><img id="image" src="<?php echo URL;?>public/images/Login.jpg" ></div>
<div class="contentr"><img id="image" src="<?php echo URL;?>public/images/<?php echo logod;?>"></div>	

	
<div class="scontentl2"><?php echo "Date d'expiration : ".Session::dateexpiration; ?></div>		
<div class="scontentl3"><?php html::rsc();?></div>
<div class="scontentr1"><?php echo "";echo dsp; echo "";?></div>		

