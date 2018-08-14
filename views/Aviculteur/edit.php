<div class="sheader1l"><p id="lhelp"><?php echo "";echo $this->msg; echo "";?></p></div><div class="sheader1r"><p id="lhelp"><?php html::NAV();?></p></div>
<div class="sheader2l">Edit produit pharmaceutique </div><div class="sheader2r">***</div>
<div class="contentl">
<form  action="<?php echo URL."produit/editSave/".$this->user[0]['id']; ?>"  method="POST"> 
 <div class="form-style-10">

		<div class="section"><span>1</span>Nom Commercial</div><div class="inner-wrap"><input  type="text" name="produit"                 value="<?php echo $this->user[0]['produit']; ?>"    onkeyup="javascript:this.value=this.value.toUpperCase();" required /></div>
		<div class="section"><span>2</span>Dénomination Commune internationale</div><div class="inner-wrap"><input type="text" name="dci" value="<?php echo $this->user[0]['dci']; ?>"        onkeyup="javascript:this.value=this.value.toUpperCase();" required /></div>
	    <div class="section"><span>3</span>Type Produit</div><div class="inner-wrap"><input type="text" name="type"                       value="<?php echo $this->user[0]['type']; ?>"       onkeyup="javascript:this.value=this.value.toUpperCase();" required /></div>
		<div class="section"><span>4</span>Date Produit</div><div class="inner-wrap"><input type="text" name="date"                       value="<?php echo $this->user[0]['date']; ?>"       onkeyup="javascript:this.value=this.value.toUpperCase();" required /></div>
		
		</br>
		<div class="inner-wrap"><input  type="submit" /></div>



</div>
</form> 
</div>	
<div class="content"><img id="image" src="<?php echo URL;?>public/images/ipa.jpg"></div>
<div class="contentr"><img id="image" src="<?php echo URL;?>public/images/<?php echo logod;?>"></div>
<div class="scontentl2"><?php echo "";echo $this->msg; echo "";?></div>		
<div class="scontentl3"><?php html::rsc();?></div>
<div class="scontentr1"><?php echo "";echo dsp; echo "";?></div>









