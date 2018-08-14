<div class="sheader1l"><p id="lhelp"><?php echo "";echo $this->msg; echo "";?></p></div><div class="sheader1r"><p id="lhelp"><?php html::NAV();?></p></div>
<div class="sheader2l">Nouveau aviculteur</div><div class="sheader2r">***</div>
<div class="contentl">
<form  action="<?php echo URL."Aviculteur/create/";  ?>"  method="POST"> 
 

		<span>1</span>Date<input id="dateins"  type="text" name="dateins"  value="<?php echo date('d-m-Y');  ?>"   required=""/></br>
		<span>2</span>Nom<input type="text" name="nomavi" onkeyup="javascript:this.value=this.value.toUpperCase();" required=""/></br>
		<span>3</span>Prénom<input type="text" name="prenomavi" onkeyup="javascript:this.value=this.value.toUpperCase();" required=""/></br>
		<span>4</span>Fils de<input type="text" name="filsde" onkeyup="javascript:this.value=this.value.toUpperCase();" required=""/></br>
		
		<span>5</span>Wilaya
		<?php HTML::WILAYA('WILAYAR','b0n2c','WILAYAR','wil','17000','w') ;?>
		</br>
		<span>6</span>Commune
		<?php HTML::COMMUNE('COMMUNER','b0n3c','COMMUNER','926','c');?>
		</br>
		<span>7</span>Adresse<input type="text" name="ADRESSE" onkeyup="javascript:this.value=this.value.toUpperCase();" required=""/></br>
		
		</br>
		<div class="inner-wrap"><input  type="submit" /></div>




</form> 
</div>	
<div class="content"><img id="image" src="<?php echo URL;?>public/images/ipa.jpg"></div>
<div class="contentr"><img id="image" src="<?php echo URL;?>public/images/<?php echo logod;?>"></div>
<div class="scontentl2"><?php echo "";echo $this->msg; echo "";?></div>		
<div class="scontentl3"><?php html::rsc();?></div>
<div class="scontentr1"><?php echo "";echo dsp; echo "";?></div>



		