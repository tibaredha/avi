<style type="text/css"> 
#contente_2, #contente_3, #contente_4, #contente_5, #contente_6 { display: none; height: auto; clear: all;} 
</style> 
<script type="text/javascript">
/*Activates the Tabs*/
function tabSwitch(new_tab, new_content) {    
    document.getElementById('content_1').style.display = 'none';  
    document.getElementById('content_2').style.display = 'none';  
    document.getElementById('content_3').style.display = 'none';  
	document.getElementById('content_4').style.display = 'none';  
	document.getElementById('content_5').style.display = 'none';  
	document.getElementById('content_6').style.display = 'none';  
	/*document.getElementById('content_3').style.display = 'none';*/ 
	document.getElementById(new_content).style.display = 'block';     
    document.getElementById('tabe_1').className = '';  
    document.getElementById('tabe_2').className = '';  
    document.getElementById('tabe_3').className = '';  
	document.getElementById('tabe_4').className = '';  
	document.getElementById('tabe_5').className = '';  
	document.getElementById('tabe_6').className = '';  
	/*document.getElementById('tab_3').className = ''; */        
    document.getElementById(new_tab).className = 'active';        
}
</script>




<div class="sheader1l"><p id="lnouveau"><?php echo "";echo $this->msg; echo "";?></p></div><div class="sheader1r"><p id="lnouveau"><?php html::NAV();?></p></div>
<div class="sheader2l">sheader3</div><div class="sheader2r">sheader33</div>
<div class="listl">
	
	<form  action="<?php echo URL."fpdf/deces/decesmaternels.php?uc=".$this->user[0]['id'];  ?>"  method="POST"> 
		<div class="tabbed_area">  
			 <ul class="tabs">  
            <li><a href="javascript:tabSwitch('tabe_1', 'content_1');" id="tabe_1" class="active">Section 1</a></li>  
            <li><a href="javascript:tabSwitch('tabe_2', 'content_2');" id="tabe_2">Section 2</a></li> 
			<li><a href="javascript:tabSwitch('tabe_3', 'content_3');" id="tabe_3">Section 3</a></li> 	
            <li><a href="javascript:tabSwitch('tabe_4', 'content_4');" id="tabe_4">Section 4</a></li> 	
            <li><a href="javascript:tabSwitch('tabe_5', 'content_5');" id="tabe_5">Section 5</a></li> 	
            <li><a href="javascript:tabSwitch('tabe_6', 'content_6');" id="tabe_6">Section 6</a></li> 	
		</ul> 
        <div id="content_1" class="contenttabs1">  
		<h4>Caractéristiques de la femme</h4>
		
		<label id="lM1">Q1: Numéro d'identification </label>   <input id="M1"    type="txt"  name="M1"     value="" placeholder="xxxxxxx"/>
		<label id="lM2">Q2: Date de naissance</label>          <input id="M2"     type="txt" name="M2"    value="" placeholder="xxxxxxx" />
		<label id="lM3">Q3: Age</label>                        <input id="M3"     type="txt" name="M3"    value="" placeholder="xxxxxxx" />
		<label id="lM4">Q4: Date du décès</label>              <input id="M4"     type="txt" name="M4"    value="" placeholder="xxxxxxx" />
		<label id="lM5">Q5: Heure du Décè</label>              <input id="M5"     type="txt" name="M5"    value="" placeholder="xxxxxxx" />
		<label id="lM6">Q6: Wilaya de résidence</label>        <input id="M6"     type="txt" name="M6"    value="" placeholder="xxxxxxx" />
		<label id="lM7">Q7: Profession de la patiente</label>  <input id="M7"     type="txt" name="M7"    value="" placeholder="xxxxxxx" />
		<label id="lM8">Q8: instruction de la patiente</label>  
		<select id="M8"  name="M8"  >  
					<option value="1">Analphabète</option>
				    <option value="2">Ecole coranique</option>
				    <option value="3">Primaire</option>
					<option value="4">Moyen</option>
					<option value="5">Secondaire </option>
					<option value="6">Universitaire</option>
					<option value="7">Non précis</option>
				</select>
		<label id="lM9">Q9: Profession du conjoint</label>  <input id="M9"     type="txt" name="M9"    value="" placeholder="xxxxxxx"   />
		<label id="lM10">Q10:instruction du conjoint</label>  
		<select id="M10"  name="M10"  >  
					<option value="1">Analphabète</option>
				    <option value="2">Ecole coranique</option>
				    <option value="3">Primaire</option>
					<option value="4">Moyen</option>
					<option value="5">Secondaire </option>
					<option value="6">Universitaire</option>
					<option value="7">Non précis</option>
				</select>
		
		<label id="lM11">Q11: Couverture sociale</label>  
		<select id="M11"  name="M11"  >  
					<option value="1">Oui</option>
				    <option value="2">Non</option>
				    <option value="3">Non précisé</option>
				</select>
		
		<label id="lM12">Q12:Lieu du décès</label>  
		<select id="M12"  name="M12"  >  
					<option value="1">Domicile</option>
				    <option value="2">Maternité publique extrahospitaiière</option>
				    <option value="3">EHS mère/enfant</option>
					<option value="4">EPH</option>
					<option value="5">CHU</option>
					<option value="6">EHU</option>
					<option value="7">Structure de santé privée</option>
				    <option value="8">Autre</option>
				    <option value="9">Si autre, Préciser</option>
				    </select>
		<label id="lM13">Q13:Moment du décès</label>  
		<select id="M13"  name="M13"  >  
					<option value="1">Pendant la grossesse</option>
				    <option value="2">Pendant l'avortement </option>
				    <option value="3">Pendant le travail ou l'accouchement </option>
					<option value="4">Dans les 24 heures suivant l'issue de la grossesse</option>
					<option value="5">Dans les 42 jours suivant un avortement </option>
					<option value="6">Dans les 42 jours suivant un accouchement </option>
					<option value="7">Dans les 42 jours suivant l'issue d'une grossesse molaire</option>
				    <option value="7">Dans les 42 jours suivant l'issue d'une grossesse extra-utérine</option>
				    </select>
		
		<label id="lM14">Q14: NBR de jours  l'acc ou de l'avo, et le décès </label>  <input id="M14"     type="txt" name="M14"    value="" placeholder="xxxxxxx"   />
		<label id="lM15">Q15: Nom de l'assesseur </label>                            <input id="M15"     type="txt" name="M15"    value="" placeholder="xxxxxxx"   />
		<label id="lM16">Q16: Qualité de l'assesseur </label>                        <input id="M16"     type="txt" name="M16"    value="" placeholder="xxxxxxx"   />
		<label id="lM17">Q17: Lieu de travail </label>                               <input id="M17"     type="txt" name="M17"    value="" placeholder="xxxxxxx"   />
		<label id="lM18">Numéro de téléphone</label>                                 <input id="M18"     type="txt" name="M18"    value="" placeholder="xxxxxxx"   />
		<label id="lM19">Adresse email </label>                                      <input id="M19"     type="txt" name="M19"    value="" placeholder="xxxxxxx"   />
		<label id="lM20">Q19:Date de l'enquête</label>                               <input id="M20"     type="txt" name="M20"    value="" placeholder="xxxxxxx"   />
        </div>
		
		<div id="content_2" class="contenttabs2"> 
		<h4>Antécédents personnels de la femme</h4>
		<?php
         
        ?>
		</div>
		
		<div id="content_3" class="contenttabs3">  
		<h4>Histoire de la grossesse ayant entraîné le décès</h4>    		  
		<?php
        
        ?>
		</div>

		<div id="content_4" class="contenttabs4">  
		<h4>Issue de la grossesse</h4>    		  
		<?php
        
        ?>
		</div>
        
		<div id="content_5" class="contenttabs5">  
		<h4>Enchaînement des événements ayant mené au décès</h4>    		  
		<?php
       
        ?>
		</div>
        
		<div id="content_6" class="contenttabs6">  
		<h4>Caractéristiques de l'établissement où a eu lieu i'issue de la grossesse</h4>    		  
		<?php
       
        ?>
			<input  id="submitnew" type="submit" />
			
			
		<input type="hidden" name="WILAYA"      value="<?php echo Session::get('wilaya')  ;?>"/>
		<input type="hidden" name="STRUCTURE"   value="<?php echo Session::get('structure')  ;?>"/>
		<input type="hidden" name="STRUCTURED"  value="<?php echo Session::get('structure')  ;?>"/>
		<input type="hidden" name="login"       value="<?php echo Session::get('login')  ;?>"/>	
		</div>
		
		
		
		
		
			<?php
			$data = array(
			""       => '', 
			""       => '' 
			);
			//HTML::tabs($data);
			?>				
		</div> 
	</form> 
</div>	
<div class="scontentl2"><?php echo "";echo $this->msg; echo "";?></div>		
<div class="scontentl3"><?php echo "";echo $this->msg; echo "";?></div>
<div class="scontentr1"><?php echo "";echo dsp; echo "";?></div>	