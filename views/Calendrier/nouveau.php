<div class="sheader1l"><p id="lhelp"><?php echo "";echo $this->msg; echo "";?></p></div><div class="sheader1r"><p id="lhelp"><?php html::NAV();?></p></div>
<div class="sheader2l">Nouveau produit pharmaceutique dans  le Calendrier   </div><div class="sheader2r">***</div>
<div class="contentl">
<form  action="<?php echo URL."Calendrier/create/";  ?>"  method="POST"> 
 <div class="form-style-10">

		<div class="section"><span>1</span>Nom Commercial</div><div class="inner-wrap"><?php HTML::produit('vaccin','vaccin','vaccin','produit','1','produit') ;?></div>
		<div class="section"><span>2</span>Jours Calendrier </div><div class="inner-wrap"><input type="text" name="jcal" onkeyup="javascript:this.value=this.value.toUpperCase();" required /></div>
		<div class="section"><span>3</span>Date Calendrier</div><div class="inner-wrap"><input type="text" name="Date"    value="<?php echo date('Y-m-d'); ?>"    onkeyup="javascript:this.value=this.value.toUpperCase();" required /></div>
		
		</br>
		<div class="inner-wrap"><input  type="submit" /></div>



</div>
</form> 
</div>	
<div class="content"><img id="image" src="<?php echo URL;?>public/images/list.jpg"></div>
<div class="contentr"><img id="image" src="<?php echo URL;?>public/images/<?php echo logod;?>"></div>
<div class="scontentl2"><?php echo "";echo $this->msg; echo "";?></div>		
<div class="scontentl3"><?php html::rsc();?></div>
<div class="scontentr1"><?php echo "";echo dsp; echo "";?></div>



		