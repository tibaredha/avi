<div class="sheader1l"><p id="evaluation"><?php echo "Gérer Echantillon des poussins representative du lot (poids a jeun en grammes)";?></p></div><div class="sheader1r"><p id="evaluation"><?php html::NAV();?></p></div>
<div class="sheader2l"><?php echo $this->msg; echo " Echantillon : ";?></div><div class="sheader2r">***</div>
<div class="contentl">
<?php 
            echo "<hr>";
	
	echo '<form ALIGN="center" action="'.URL.'fpdf/avi/evaavi.php" method="POST">';
			echo " <input id=\"typea1\"  type=\"text\" name=\"annee\"  value=\"".date('d-m-Y')."\"  required />";
			echo " <input id=\"typea1\"  type=\"text\" name=\"annee1\"  value=\"".date('d-m-Y')."\"  required />";
			echo "<p>";;echo "</p>";
				echo "<hr>";
			echo "<p>";
			echo "<select id=\"type1\" name=\"BNM\">";
			echo '<option value="0">***</option>';
			// echo '<option value="1">Naissance</option>';
			// echo '<option value="2">Mariage</option>';
			// echo '<option value="3">Deces</option>';
			// echo '<option value="4">Bnm</option>';
			// echo '<option value="5">Rapport</option>';
			echo '';
			echo "</select>";
			echo "</p> ";
				
			echo "<p>";
			echo "<select id=\"type2\" name=\"type\">";
			echo"<option value=\"1\">PDF</option>"."\n";
			// echo"<option value=\"2\">XLS</option>"."\n";
			echo "</select>";
			echo "</p>";
			   echo "<hr>";
			echo '<input type="hidden" name="login" value="'.Session::get('login').'"/>';   
			echo ' <input type="hidden" name="structure" value="'.Session::get('structure').'"/> ';     
			echo "<p><input  id=\"submitr\" type=\"submit\" value=\"Calculer\" /></p>";
	echo "</form>";
	          echo "<hr>";

?>
</div>	
<div class="content"><img id="image" src="<?php echo URL;?>public/images/eva.png"></div>
<div class="contentr"><img id="image" src="<?php echo URL;?>public/images/<?php echo logod;?>"></div>

	
<div class="scontentl2"><?php echo "***";//echo $this->msg; echo "";?></div>		
<div class="scontentl3"><?php echo "***";//echo $this->msg; echo "";?></div>
<div class="scontentr1"><?php echo "***";//echo dsp; echo "";?></div>		
