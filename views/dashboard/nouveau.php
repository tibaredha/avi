<div class="sheader1l"><p id="lnouveau"><?php echo "Gérer les certificats de décès";?></p></div><div class="sheader1r"><p id="lnouveau"><?php html::NAV();?></p></div>
<div class="sheader2l">Créer un nouveau certificat de deces</div><div class="sheader2r">
ID Défunt( e ) :
<label style="display: none;" id="show_codeP">
<input type="text" name="code_patient" id="code_patient"  style="border: none; background-color: green; color: white; font-family:courier; text-align:center;  "   size="15" readonly="">
</label>                                

                                   


</div>
<div class="listl">
	<form  action="<?php echo URL."dashboard/create/";  ?>"  method="POST"> 
		<div class="tabbed_area">  
			<ul class="tabs">  
				<li><a href="javascript:tabSwitch('tab_1', 'content_1');" id="tab_1" class="active">1er partie</a></li>  
				<li><a href="javascript:tabSwitch('tab_2', 'content_2');" id="tab_2">2em partie</a></li> 
				<li><a href="javascript:tabSwitch('tab_3', 'content_3');" id="tab_3">3em partie</a></li> 	
				<li><a href="javascript:tabSwitch('tab_4', 'content_4');" id="tab_4">4em partie </a></li> 	
			</ul>    	 
			<?php
			$data = array(
			""       => '', 
			""       => '' 
			);
			HTML::tabs($data);
			?>				
		</div> 
	</form> 
</div>	
<div class="scontentl2"><?php echo "";echo $this->msg; echo "";?></div>		
<div class="scontentl3"><?php html::rsc();?></div>
<div class="scontentr1"><?php echo "";echo dsp; echo "";?></div>	