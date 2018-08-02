<div class="sheader1l"><p id="dashboard"><?php echo "Gérer Echantillon des poussins representative du lot  (poids a jeun en grammes)";?></p></div><div class="sheader1r"><p id="dashboard"><?php html::NAV();?></p></div>
<div class="sheader2l">

<?php
$ctrl='dashboard';
$mdl='search';
$data = array(
"c"   => $ctrl,
"m"   => $mdl,
"combo"   => array("id"=>'id'),
"submitvalue" => 'Search',
"cb1" => $ctrl,"mb1" => 'nouveau',        "tb1" => 'nouveau',"vb1" => '', "icon1" => 'add.PNG',
"cb2" => $ctrl,"mb2" => 'Evaluation',     "tb2" => 'Print', "vb2" => '',  "icon2" => 'print.PNG',
"cb3" => $ctrl,"mb3" => 'CGR',            "tb3" => 'graphe',"vb3" => '',  "icon3" => 'graph.PNG',
"cb4" => $ctrl,"mb4" => '',               "tb4" => 'Search',"vb4" => '',  "icon4" => 'search.PNG');
html::form($data) ;

?>
</div>
<div class="sheader2r">
<?php
echo "<button id=\"Cleari\"  onclick=\"document.location='".URL.$data['cb1']."/".$data['mb1']."/';  \"   title=\"".$data['tb1']."\">&nbsp;<img src=\"".URL."public/images/".$data['icon1']."\" width='15' height='15' border='0' alt=''/>&nbsp;".$data['vb1']."&nbsp;</button> " ;
echo "<button id=\"Cleari\"  onclick=\"document.location='".URL.$data['cb2']."/".$data['mb2']."/';  \"   title=\"".$data['tb2']."\">&nbsp;<img src=\"".URL."public/images/".$data['icon2']."\" width='15' height='15' border='0' alt=''/>&nbsp;".$data['vb2']."&nbsp;</button> " ;
?>
</div>

<?php

		if (isset($this->userListview))
		{
		ob_start();
		echo '<div class="listl">';
		echo'<table>';$colspan=15;
			echo'<tr bgcolor="#00CED1">';
			echo'<th class="crtl">id</th>';
			echo'<th class="crtldate">Date</th>';
			echo'<th class="crtldate">Wilaya</th>';
			echo'<th class="crtl">Commune</th>';
			echo'<th class="crtl">Client</th>';
			echo'<th class="crtl">Cycle</th>';
			echo'<th class="crtl">Batiment</th>';
			echo'<th class="crtl">Semaine</th>';
			echo'<th class="crtl">cal</th>';
			echo'<th class="crtl">Eva</th>';
			echo'<th class="crtl">Update</th>';
			echo'<th class="crtl">Delete</th>';
			echo'</tr>';
			foreach($this->userListview as $key => $value)
			{ 
			$bgcolor_donate ='#EDF7FF';
			echo "<tr bgcolor=\"".$bgcolor_donate."\"  onmouseover=\"this.style.backgroundColor='#9FF781';\"   onmouseout=\"this.style.backgroundColor='".$bgcolor_donate."';\"  >" ;
			echo '<td align="center"  >'.$value['id'].'</td>';
			echo '<td align="center"  >'.HTML::dateUS2FR($value['date']).'</td>';// 
			echo '<td align="left"  >'.html::nbrtostring('wil','IDWIL',$value['WILAYAD'],'WILAYAS').'</td>';
			echo '<td align="left"  >'.html::nbrtostring('com','IDCOM',$value['COMMUNED'],'COMMUNE').'</td>';
			echo '<td align="center"  >'.html::nbrtostring('client','idclient',$value['avicli'],'nomavi').'</td>';
			echo '<td align="center"  >'.$value['avicycl'].'</td>';
			echo '<td align="center"  >'.$value['avibtm'].'</td>';
			echo '<td align="center"  >'.$value['avisem'].'</td>';
			echo '<td align="center" style="width:10px;"  bgcolor="#FFFF00"><a target="_blank" title="cal"  href="'.URL.'fpdf/avi/cal.php?uc='.date('Y-m-d').'" ><img src="'.URL.'public/images/b_props.png"   width="16" height="16" border="0" alt=""   /></a></td>';
			echo '<td align="center" style="width:10px;" bgcolor="#0000FF"><a target="_blank" title="eva"  href="'.URL.'fpdf/avi/avi.php?uc='.$value['id'].'" ><img src="'.URL.'public/images/b_props.png"   width="16" height="16" border="0" alt=""   /></a></td>';
			echo '<td align="center" style="width:10px;" bgcolor="#32CD32"><a target="_blank" title="editer"  href="'.URL.$ctrl.'/edit/'.$value['id'].'" ><img src="'.URL.'public/images/edit.png"   width="16" height="16" border="0" alt=""   /></a></td>';
			echo '<td align="center" style="width:10px;" bgcolor="#FF0000" ><a class="delete" title="supprimer"  href="'.URL.$ctrl.'/delete/'.$value['id'].'" ><img src="'.URL.'public/images/delete.png"   width="16" height="16" border="0" alt=""   /></a></td>';
			echo'</tr>';
			}
			$total_count=count($this->userListview1);
			$total_count1=count($this->userListview);
			if ($total_count <= 0 )
			{
				echo '<tr><td align="center" colspan="'.$colspan.'" ><span> No record found for deces </span></td> </tr>';
				header('location: ' . URL .$ctrl.'/nouveau/'.$this->userListviewq);
				echo '<tr bgcolor="#00CED1"  ><td align="left"   colspan="'.$colspan.'" ><span>' .$total_count1.'/'.$total_count.' Record(s) found.</span></td></tr>';					
			}
			else
			{		
				echo '<tr bgcolor="#00CED1"><td   id="bdn"  colspan="'.$colspan.'" >'. HTML::barre_navigation ($total_count,$this->userListviewl,$this->userListviewo,$this->userListviewq,$this->userListviewp,$this->userListviewb,$ctrl,$mdl).'</td></tr>';	
				
				$limit=$this->userListviewl;		
				$page=$this->userListviewp;
				if ($page <= 0){$prev_page =$this->userListviewp;}else{$prev_page = $page-$limit;}
				$total_page = ceil($total_count/$limit); echo "<br>" ;  
				$prev_url = URL.$ctrl.'/'.$mdl.'/'.$prev_page.'/'.$limit.'?q='.$this->userListviewq.'&o='.$this->userListviewo.'';   
				$next_url = URL.$ctrl.'/'.$mdl.'/'.($page+$limit).'/'.$limit.'?q='.$this->userListviewq.'&o='.$this->userListviewo.'';    
				echo '<tr bgcolor="#00CED1"  ><td id="btdn" colspan="'.$colspan.'" >';	
				?> 
				<?php echo '<button id="buttoni"'; echo ($page<=0)?'disabled':'';?>                  onclick="document.location='<?php echo $prev_url; ?>'"> <?php echo ""; echo 'Previews</button>&nbsp;<span>[' .$total_count1.'/'.$total_count.' Record(s) found.]</span>'; ?>                              
				<?php echo '<button id="buttons"'; echo ($page>=$total_page*$limit)?'disabled':'';?> onclick="document.location='<?php echo $next_url; ?>'"> <?php echo "Next</button>";?> 
				<?php 
			}	
		echo "</table>";
		echo "</div>";
		ob_end_flush();
		}
		else 
		{
		echo '<div class="contentl">';
		// HTML::multigraphe(30,340,'Naissance Par annee et sexe  Arret Au : ','avi','date','SEX','M','F','='.Session::get('structure')) ;
		HTML::graphemois(30,340,'Echantillons des poussins par mois Arret Au : ','','avi','date','',date('Y'),'','='.Session::get('structure')); 
		echo "</div>";
		echo'<div class="content"><img id="image" src="'.URL.'public/images/dashbord.jpg" ></div>';
		echo'<div class="contentr"><img id="image" src="'.URL.'public/images/'.logod.'"></div>';
		}
?>






	
<div class="scontentl2">
<?php 
	// if (Session::get('loggedIn') == false)
	// {
	// echo '<a href="'.URL.'">x</a>';echo '&nbsp;';
	// echo '<a href="'.URL.'x">x</a>';echo '&nbsp;';
	// echo '<a href="'.URL.'x">x</a>';echo '&nbsp;';
	// }
	// else
	// {
	// echo '<a href="'.URL.'x">x</a>';echo '&nbsp;';
	// if (Session::get('login') == admin)
	// {
		// echo '<a href="'.URL.'x/x/0">x</a>';echo '&nbsp;';
		// echo '<a href="'.URL.'x/x/">x</a>';echo '&nbsp;';
		// echo '<a href="'.URL.'x/x/">x</a>';echo '&nbsp;';
	// }
	// if (Session::get('login') == sadmin)
	// {
	    // echo '<a href="'.URL.'x/x/">x</a>';echo '&nbsp;';
		// echo '<a href="'.URL.'x/x/0">x</a>';echo '&nbsp;';
		// echo '<a href="'.URL.'x/x/">x</a>';echo '&nbsp;';
		// echo '<a href="'.URL.'x/x/">x</a>';echo '&nbsp;';
		// echo '<a href="'.URL.'x/x/x">x</a>';echo '&nbsp;';
		// echo '<a href="'.URL.'x/x/0">x</a>';echo '&nbsp;';
	// }
	echo '<a href="'.URL.'dashboard/nouveau/">Année</a>';echo '&nbsp;'; 
	// echo '<a href="'.URL.'dashboard/graphe/1">Mois</a>';echo '&nbsp;';
	  
	
	// }
?>			
</div>		
<div class="scontentl3">
<?php 
	// if (Session::get('loggedIn') == false)
	// {
	// echo '<a href="'.URL.'">x</a>';echo '&nbsp;';
	// echo '<a href="'.URL.'x">x</a>';echo '&nbsp;';
	// echo '<a href="'.URL.'x">x</a>';echo '&nbsp;';
	// }
	// else
	// {
	// echo '<a href="'.URL.'x">x</a>';echo '&nbsp;';
	// if (Session::get('login') == admin)
	// {
		// echo '<a href="'.URL.'x/x/0">x</a>';echo '&nbsp;';
		// echo '<a href="'.URL.'x/x/">x</a>';echo '&nbsp;';
		// echo '<a href="'.URL.'x/x/">x</a>';echo '&nbsp;';
	// }
	// if (Session::get('login') == sadmin)
	// {
	    // echo '<a href="'.URL.'x/x/">x</a>';echo '&nbsp;';
		// echo '<a href="'.URL.'x/x/0">x</a>';echo '&nbsp;';
		// echo '<a href="'.URL.'x/x/">x</a>';echo '&nbsp;';
		// echo '<a href="'.URL.'x/x/">x</a>';echo '&nbsp;';
		// echo '<a href="'.URL.'x/x/x">x</a>';echo '&nbsp;';
		// echo '<a href="'.URL.'x/x/0">x</a>';echo '&nbsp;';
	// }
	// echo '<a href="'.URL.'x/user/">x</a>';echo '&nbsp;';
	// echo '<a href="'.URL.'x/x">x</a>';echo '&nbsp;';   
	
	// }
	
	echo '<a href="'.URL.'dashboard/nouveau/">Mois</a>';echo '&nbsp;';
?>
</div>
<div class="scontentr1"><?php echo "";//echo dsp; echo "";?></div>		