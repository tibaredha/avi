<div class="sheader1l">
<?php
Session::init();
if (isset($_SESSION['errorlogin'])) {
$sError = '<p id="errorlogin">' . $_SESSION['errorlogin'] . '</p>';		
echo $sError;			
}
else
{
$sError='<p id="llogin">Gérer Echantillon des poussins representative du lot (poids a jeun en grammes)</p>';
echo $sError;
}
?>
</div>
<div class="sheader1r"><p id="llogin"><?php html::NAV();?></p></div>
<div class="sheader2l">
Ajout client
</div>
<div class="sheader2r">***</div>
<div class="contentl formaut">
<div class="form-style-10   ">
<form  action="<?php echo URL."dashboard/createclient/";  ?>" method="post">			
<div class="section"><span>1</span>Date</div>
<div class="inner-wrap"><input id="dateinsp"  type="text" name="dateins"  value="<?php echo date('d-m-Y');  ?>"   required=""/></div>
<div class="section"><span>2</span>Nom</div>
<div class="inner-wrap"><input type="text" name="nomavi" onkeyup="javascript:this.value=this.value.toUpperCase();" required=""/></div>
<div class="section"><span>3</span>Prénom</div>
<div class="inner-wrap"><input type="text" name="prenomavi" onkeyup="javascript:this.value=this.value.toUpperCase();" required=""/></div>
<div class="section"><span>4</span>fils de</div>
<div class="inner-wrap"><input type="text" name="filsde" onkeyup="javascript:this.value=this.value.toUpperCase();" required=""/></div>
</br>
<div class="inner-wrap"><input    type="submit" /></div>
</form>
</div>
</div>	
<div class="content"><img id="image" src="<?php echo URL;?>public/images/users.jpg" ></div>
<div class="contentr"><img id="image" src="<?php echo URL;?>public/images/<?php echo logod;?>"></div>		
<div class="scontentl2"><?php echo "Date d'expiration : ".Session::dateexpiration; ?></div>		
<div class="scontentl3"><?php html::rsc();?></div>
<div class="scontentr1"><?php echo "";echo dsp; echo "";?></div>		