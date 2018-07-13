<div class="sheader1l"><p id="lhelp"><?php echo "";echo $this->msg; echo "";?></p></div><div class="sheader1r"><p id="lhelp"><?php html::NAV();?></p></div>
<div class="sheader2l">liste des médecins</div><div class="sheader2r">***</div>
<div class="contentl formaut">
<div class="form-style-10   ">
<form method="post" action="<?php echo URL;?>dashboard/medecinSave/">
	<div class="section"><span>1</span>Nom</div> <div class="inner-wrap"><input type="text" name="Nom"    value="" /></div>
	<div class="section"><span>2</span>Prénom</div><div class="inner-wrap"><input type="text" name="Prenom" value="" /></div>
	<input type="hidden" name="wilaya" value="<?php echo Session::get('wilaya')  ;?>"/>
	<input type="hidden" name="structure" value="<?php echo Session::get('structure')  ;?>"/>
	</br>
	<div class="inner-wrap"><input  id="Clearb" type="submit" /></div>	
</form>
</br>
<?php
$colspan=4;
echo'<table >';
	
    echo'</tr>';
	echo'<tr bgcolor="#00CED1">';
	echo'<th style="width:10px;">Nom</th>';
	echo'<th style="width:10px;">Prenom</th>';
	echo'<th style="width:10px;">Sup</th>';
	echo'</tr>';

foreach($this->userListview as $key => $value)
			{ 
			$bgcolor_donate ='#EDF7FF';
            echo "<tr bgcolor=\"".$bgcolor_donate."\"  onmouseover=\"this.style.backgroundColor='#9FF781';\"   onmouseout=\"this.style.backgroundColor='".$bgcolor_donate."';\"  >" ;
			
			echo'<td align="left" >'.$value['Nom'].'</td>';
			echo'<td align="left" >'.$value['Prenom'].'</td>';
			echo '<td align="center" style="width:10px;" ><a class="delete" title="supprimer"  href="'.URL.'dashboard/deletemedecin/'.$value['id'].'/'.$value['structure'].'/'.'" ><img src="'.URL.'public/images/delete.png"   width="16" height="16" border="0" alt=""   /></a></td>';
			echo '</tr>';			
			}
echo "</table>";	

?>

</div>

</div>	
<div class="content"><img id="image" src="<?php echo URL;?>public/images/med.jpg"></div>
<div class="contentr"><img id="image" src="<?php echo URL;?>public/images/<?php echo logo;?>"></div>
<div class="scontentl2"><?php echo "";echo $this->msg; echo "";?></div>		
<div class="scontentl3"><?php echo "";echo $this->msg; echo "";?></div>
<div class="scontentr1"><?php echo "";echo dsp; echo "";?></div>

