<div class="sheader1l">
<?php
Session::init();
if (isset($_SESSION['errorregister'])) {
$sError = '<p id="errorregister">' . $_SESSION['errorregister'] . '</p>';		
echo $sError;			
}
else
{
$sError='<p id="lregister">createmedecin</p>';
echo $sError;
}
?>
</div><div class="sheader1r"><p id="lregister"><?php html::NAV();?></p></div>
<div class="sheader2l">
<form action="<?php echo URL;?>med/medecinSave" method="post">	
Nom   <input type="text" name="Nom"    value="" />
Prénom<input type="text" name="Prenom" value="" />
<input type="hidden" name="wilaya" value="<?php echo Session::get('wilaya')  ;?>"/>
<input type="hidden" name="structure" value="<?php echo Session::get('structure')  ;?>"/>
<input id="submitr" type="submit" />
</form>
</div>
<div class="sheader2r">sheader3</div>
<div class="contentl">
<?php
$colspan=4;
echo'<table width="63%" border="1" cellpadding="5" cellspacing="1" align="left">';
	echo'<tr bgcolor="#00CED1"   >';
	echo'<th style="width:10px;"  colspan="'.$colspan.'" >';
	echo 'liste des medecins'; echo '&nbsp;';		
	echo'</th>';
	echo'</tr>';
    echo'</tr>';
	echo'<tr bgcolor="#00CED1">';
	echo'<th style="width:10px;">Id</th>';
	echo'<th style="width:10px;">Nom</th>';
	echo'<th style="width:10px;">Prenom</th>';
	echo'<th style="width:10px;">Sup</th>';
	echo'</tr>';

foreach($this->userListview as $key => $value)
			{ 
			$bgcolor_donate ='#EDF7FF';
            echo "<tr bgcolor=\"".$bgcolor_donate."\"  onmouseover=\"this.style.backgroundColor='#9FF781';\"   onmouseout=\"this.style.backgroundColor='".$bgcolor_donate."';\"  >" ;
			echo'<td align="left" >'.$value['id'].'</td>';
			echo'<td align="left" >'.$value['Nom'].'</td>';
			echo'<td align="left" >'.$value['Prenom'].'</td>';
			
			echo '<td align="center" style="width:10px;" ><a class="delete" title="supprimer"  href="'.URL.'dashboard/deletemedecin/'.$value['id'].'" ><img src="'.URL.'public/images/delete.png"   width="16" height="16" border="0" alt=""   /></a></td>';
			echo '</tr>';			
			}
echo "</table>";
?>
</div>	
<div class="content"><img id="image" src="<?php echo URL;?>public/images/med.jpg"></div>
<div class="contentr"><img id="image" src="<?php echo URL;?>public/images/<?php echo logo;?>"></div>	

	
<div class="scontentl2"><?php echo "";echo $this->msg; echo "";?></div>		
<div class="scontentl3"><?php echo "";echo $this->msg; echo "";?></div>
<div class="scontentr1"><?php echo "";echo dsp; echo "";?></div>		
