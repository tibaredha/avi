<div class="sheader1l"><p id="lnouveau"><?php echo "Gérer les certificats de décès";?></p></div><div class="sheader1r"><p id="lnouveau"><?php html::NAV();?></p></div>
<div class="sheader2l">
<P><?php echo "Visualiser le certificat de décès de : ".$this->user[0]['NOM'];?> <?php echo $this->user[0]['PRENOM'];?><?php //echo $this->user[0]['id'];?></P>
</div>
<div class="sheader2r">
<?php
$ctrl='dashboard';
$mdl='search';
$data = array(
"c"   => $ctrl,
"m"   => $mdl,
"combo"   => array("id"=>'id',"Nom"=>'NOM',"prenom"=>'PRENOM',"Sexe"=>'SEX'),
"submitvalue" => 'Search',
"cb1" => $ctrl,"mb1" => 'nouveau',        "tb1" => 'nouveau',"vb1" => '', "icon1" => 'add.PNG',
"cb2" => $ctrl,"mb2" => 'impr',            "tb2" => 'Print', "vb2" => '',  "icon2" => 'print.PNG',
"cb3" => $ctrl,"mb3" => 'CGR',            "tb3" => 'graphe',"vb3" => '',  "icon3" => 'graph.PNG',
"cb4" => $ctrl,"mb4" => '',               "tb4" => 'Search',"vb4" => '',  "icon4" => 'search.PNG');

echo "<button id=\"Cleari\"  onclick=\"document.location='".URL.$data['cb1']."/".$data['mb1']."/';  \"   title=\"".$data['tb1']."\">&nbsp;<img src=\"".URL."public/images/".$data['icon1']."\" width='15' height='15' border='0' alt=''/>&nbsp;".$data['vb1']."&nbsp;</button> " ;
echo "<button id=\"Cleari\"  onclick=\"document.location='".URL.$data['cb2']."/".$data['mb2']."/';  \"   title=\"".$data['tb2']."\">&nbsp;<img src=\"".URL."public/images/".$data['icon2']."\" width='15' height='15' border='0' alt=''/>&nbsp;".$data['vb2']."&nbsp;</button> " ;
?>

</div>
<div class="listl">
	<form  action="<?php echo URL."dashboard/validate/".$this->user[0]['id'];?>"  method="POST"> 
		<div class="tabbed_area">  
			<ul class="tabs">  
				<li><a href="javascript:tabSwitch('tab_1', 'content_1');" id="tab_1" class="active">1er partie</a></li>  
				<li><a href="javascript:tabSwitch('tab_2', 'content_2');" id="tab_2">2em partie</a></li> 
				<li><a href="javascript:tabSwitch('tab_3', 'content_3');" id="tab_3">3em partie</a></li> 	
				<li><a href="javascript:tabSwitch('tab_4', 'content_4');" id="tab_4">4em partie </a></li> 	
			</ul>
			<?php
			echo '<div id="content_1" class="contenttabs1">  ';
			$commune1=HTML::nbrtostring('structure','id',Session::get('structure'),'numcom');
			$commune2=HTML::nbrtostring('structure','id',Session::get('structure'),'com');
			// $data[''];
			echo '<label id="lWILAYAD">Wilaya:</label>';     HTML::WILAYA('WILAYAD','WILAYAD','WILAYAD','wil','17000','Djelfa') ;
			echo '<label id="lCOMMUNED">Commune:</label>';   HTML::COMMUNE('COMMUNED','COMMUNED','COMMUNED',$commune1,$commune2);
			echo '<label id="lDINS">Date décès:</label>';    echo '<input id="DINS"   type="txt"  name="DINS"   value="'.HTML::dateUS2FR($this->user[0]['DINS']).'" />';
															 echo '<input id="HINS"   type="txt"  name="HINS"   value="'.$this->user[0]['HINS'].'" />';
			echo '<label  id="lNOM">Nom:</label>';           echo '<input id="NOM"    type="txt"  name="NOM"    value="'.$this->user[0]['NOM'].'" autofocus  />';
			echo '<label  id="lPRENOM">Prénom:</label> ';    echo '<input id="PRENOM" type="txt"  name="PRENOM" value="'.$this->user[0]['PRENOM'].'" />';
			echo '<label  id="lFILSDE">Père:</label>';       echo '<input id="FILSDE" type="txt"  name="FILSDE" value="'.$this->user[0]['FILSDE'].'" />';
			echo '<label  id="lETDE">Mère:</label>';         echo '<input id="ETDE"   type="txt"  name="ETDE"   value="'.$this->user[0]['ETDE'].'" />';
			
			echo '<label  id="lSEXE">Sexe:</label>';
			echo '<select id="SEXE"  name="SEXE"  >  ';
			     echo '<option value="'.$this->user[0]['SEX'].'">'.$this->user[0]['SEX'].'</option>';
				 echo '<option value="M">Masculin</option>';
				 echo '<option value="F">Feminin</option> ';
			echo '</select>';
			
			echo '<label for="DATENS"  id="lDATENS">Né(e) le:</label>';     echo '<input id="DATENS" type="txt"  name="DATENS" value="'.HTML::dateUS2FR($this->user[0]['DATENAISSANCE']).'" />';
			echo '<label for="WILAYAN" id="lWILAYAN">Wilaya:</label>';    HTML::WILAYA('WILAYAN','WILAYAN','WILAYAN','wil',$this->user[0]['WILAYA'],HTML::nbrtostring('wil','IDWIL',$this->user[0]['WILAYA'],'WILAYAS')) ;
			echo '<label for="COMMUNEN"id="lCOMMUNEN">Commune:</label>';  HTML::COMMUNE('COMMUNEN','COMMUNEN','COMMUNEN',$this->user[0]['COMMUNE'],HTML::nbrtostring('com','IDCOM',$this->user[0]['COMMUNE'],'COMMUNE'));
			echo '<label for="WILAYAR" id="lWILAYAR">Wilaya:</label>';    HTML::WILAYA('WILAYAR','WILAYAR','WILAYAR','wil',$this->user[0]['WILAYAR'],HTML::nbrtostring('wil','IDWIL',$this->user[0]['WILAYAR'],'WILAYAS')) ;
			echo '<label for="COMMUNER"id="lCOMMUNER">Commune:</label> '; HTML::COMMUNE('COMMUNER','COMMUNER','COMMUNER',$this->user[0]['COMMUNER'],HTML::nbrtostring('com','IDCOM',$this->user[0]['COMMUNER'],'COMMUNE'));
			echo '<label for="ADRESSE" id="lADRESSE">Adresse:</label>';   echo '<input id="ADRESSE" type="text" name="ADRESSE" value="'.$this->user[0]['ADRESSE'].'"/>';

			echo '<label id="lLD7">Signalement médico-légal:</label>';
			
			if ($this->user[0]['OMLI']=='1') 
			{
			echo '<label id="lLD8">Obstacle médico-légal a l\'inhumation  :</label> ';                               echo '<input id="LD8" type="checkbox"  name="OMLI" value="OMLI" checked/> ';
			}
			else
			{
			echo '<label id="lLD8">Obstacle médico-légal a l\'inhumation  :</label> ';                               echo '<input id="LD8" type="checkbox"  name="OMLI" value="OMLI" /> ';
			}
			
			if ($this->user[0]['MIEC']=='1') 
			{
			echo '<label id="lLD9">Mise immédiate en cercueil hermétique en raison du risque de contagion :</label>';echo '<input id="LD9" type="checkbox"  name="MIEC" value="MIEC" checked /> ';
			}
			else
			{
			echo '<label id="lLD9">Mise immédiate en cercueil hermétique en raison du risque de contagion :</label>';echo '<input id="LD9" type="checkbox"  name="MIEC" value="MIEC" /> ';
			}
			
			if ($this->user[0]['EPFP']=='1') 
			{
			echo '<label id="lLD10">Existence d\'une prothèse fonctionnant au moyen d\'une pile :</label> ';         echo '<input id="LD10" type="checkbox" name="EPFP" value="EPFP" checked />';
			}
			else
			{
			echo '<label id="lLD10">Existence d\'une prothèse fonctionnant au moyen d\'une pile :</label> ';         echo '<input id="LD10" type="checkbox" name="EPFP" value="EPFP" />';
			}
			
			echo '<label id="lLD0">lieu du décès:</label>';
			echo '<label id="lLD1">Domicile:</label>'; 
			echo '<label id="lLD2">Voie publique:</label>'; 
			echo '<label id="lLD3">Autres :</label>'; 
			echo '<label id="lLD4">Structure publique:</label>'; 
			echo '<label id="lLD5">Structure privée:</label>'; 
			
			
			switch($this->user[0]['LD'])  
				{
				   case 'DOM' :
						{ 
						echo '<input id="LD1" type="radio"  name="LD" value="DOM" checked/>';
						echo '<input id="LD2" type="radio"  name="LD" value="VP"/>';
						echo '<input id="LD3" type="radio"  name="LD" value="AAP"/><input id="LD6" type="txt"    name="AUTRES" value="'.$this->user[0]['AUTRES'].'" /> ';
						echo '<input id="LD4" type="radio"  name="LD" value="SSP"/>';
						echo '<input id="LD5" type="radio"  name="LD" value="SSPV"/>';
						break;}
				   case 'VP' :
						{ 
						echo '<input id="LD1" type="radio"  name="LD" value="DOM"/>';
						echo '<input id="LD2" type="radio"  name="LD" value="VP" checked/>';
						echo '<input id="LD3" type="radio"  name="LD" value="AAP"/><input id="LD6" type="txt"    name="AUTRES" value="'.$this->user[0]['AUTRES'].'"/> ';
						echo '<input id="LD4" type="radio"  name="LD" value="SSP"/>';
						echo '<input id="LD5" type="radio"  name="LD" value="SSPV"/>';
						break;}
				   case 'AAP' :
						{ 
						echo '<input id="LD1" type="radio"  name="LD" value="DOM" />';
						echo '<input id="LD2" type="radio"  name="LD" value="VP" />';
						echo '<input id="LD3" type="radio"  name="LD" value="AAP" checked/><input id="LD6" type="txt"    name="AUTRES" value="'.$this->user[0]['AUTRES'].'"   /> ';
						echo '<input id="LD4" type="radio"  name="LD" value="SSP"  />';
						echo '<input id="LD5" type="radio"  name="LD" value="SSPV" />';
						break;}
					 case 'SSP' :
						{ 
						echo '<input id="LD1" type="radio"  name="LD" value="DOM" />';
						echo '<input id="LD2" type="radio"  name="LD" value="VP" />';
						echo '<input id="LD3" type="radio"  name="LD" value="AAP" /><input id="LD6" type="txt"    name="AUTRES" value="'.$this->user[0]['AUTRES'].'" /> ';
						echo '<input id="LD4" type="radio"  name="LD" value="SSP" checked />';
						echo '<input id="LD5" type="radio"  name="LD" value="SSPV" />';
						break;}
					 case 'SSPV' :
						{ 
						echo '<input id="LD1" type="radio"  name="LD" value="DOM" />';
						echo '<input id="LD2" type="radio"  name="LD" value="VP" />';
						echo '<input id="LD3" type="radio"  name="LD" value="AAP" /><input id="LD6" type="txt"    name="AUTRES" value="'.$this->user[0]['AUTRES'].'" /> ';
						echo '<input id="LD4" type="radio"  name="LD" value="SSP"  />';
						echo '<input id="LD5" type="radio"  name="LD" value="SSPV" checked/>';
						break;}			
				}
			echo '<label id="lProfession">Profession :</label>';                         HTML::Profession(44,44,'Profession','deces','Profession',Session::get('structure'),$this->user[0]['Profession'],HTML::nbrtostring('Profession','id',$this->user[0]['Profession'],'Profession')) ;
			echo '<label for="DATEHOSPI"id="lDATEHOSPI">Date d\'hospitalisation:</label> '; echo '<input id="DATEHOSPI" type="txt" name="DATEHOSPI" value="'.HTML::dateUS2FR($this->user[0]['DATEHOSPI']).'" />';echo '<input id="HEURESHOSPI" type="txt"  name="HEURESHOSPI" value="'.$this->user[0]['HEURESHOSPI'].'"/>';
			echo '<label for="SERVICEHOSPIT"id="lSERVICEHOSPIT"  >Service :</label>';    HTML::SER(44,44,'SERVICEHOSPIT','deces','servicedeces',$this->user[0]['SERVICEHOSPIT'],HTML::nbrtostring('servicedeces','id',$this->user[0]['SERVICEHOSPIT'],'service')) ;
			echo '<label for="MEDECINHOSPIT"id="lMEDECINHOSPIT"  >';
				  echo '<a title="Nouveau Medecin"  href="'.URL.'dashboard/createmedecin/'.Session::get('structure').'"> Medecin:</a>';
				  echo'<img src="'.URL.'public/images/add.PNG" width="12" height="12" border="0" alt=""   />';
			echo '</label>';
			HTML::MED(44,44,'MEDECINHOSPIT','deces','medecindeces',Session::get('structure'),$this->user[0]['MEDECINHOSPIT'],$this->user[0]['MEDECINHOSPIT']) ;
			echo '</div>';
			
			echo '<div id="content_2" class="contenttabs2">';
			echo '<label id="lCIM0">Partie I : Maladie(s) ou affection(s) morbide (s) ayant directement provoqué le décés:</label>';
			echo '<label id="lCIM1">&nbsp;Cause directe :&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; a)</label><input title="La définition n\'inclut pas les symptômes ni les modes de décès"id="CIM1" type="txt" name="CIM1" value="'.$this->user[0]['CIM1'].'"  />';
			echo '<label id="lCIM2">&nbsp;Due à ou consécutive à : b)</label><input title="La définition n\'inclut pas les symptômes ni les modes de décès"   id="CIM2" type="txt" name="CIM2" value="'.$this->user[0]['CIM2'].'"  />';
			echo '<label id="lCIM3">&nbsp;Due à ou consécutive à : c)</label><input title="La définition n\'inclut pas les symptômes ni les modes de décès"   id="CIM3" type="txt" name="CIM3" value="'.$this->user[0]['CIM3'].'"  />';
			echo '<label id="lCIM4">&nbsp;Due à ou consécutive à : d)</label><input title="La définition n\'inclut pas les symptômes ni les modes de décès"   id="CIM4" type="txt" name="CIM4" value="'.$this->user[0]['CIM4'].'"  />';
			echo '<label id="lCIM00">Partie II : Autres états morbides ayant pu contribuer au décés, non mentionnés en partie 1:</label>';
			echo '<label id="lCIM5"> Autres états :</label>            <input id="CIM5" type="txt" name="CIM5" value="'.$this->user[0]['CIM5'].'"  />';
			HTML::cim1('CODECIM0','deces','chapitre',$this->user[0]['CODECIM0'],HTML::nbrtostring('chapitre','IDCHAP',$this->user[0]['CODECIM0'],'CHAP'));
			HTML::cim2('CODECIM',$this->user[0]['CODECIM'],HTML::nbrtostring('cim','row_id',$this->user[0]['CODECIM'],'diag_nom')) ;
			echo '<label id="lCIM7">  * la cause initiale = la dernière ligne</label>';
			echo '<label id="lCIM01">Cause de décés:</label>';
			echo '<label id="lCIM02">Cause naturelle:</label>'; 
			echo '<label id="lCIM03">Cause viollente:</label>';
			echo '<label id="lCIM04">Cause indeterminée:</label>';	
				
				
				switch($this->user[0]['CD'])  
				{
				   case 'CN' :
						{ 
						echo'<input  title="Cause endogene(maladie,senescence)"id="CIM02" type="radio"  name="CD" value="CN"checked />';
			            echo'<input  title="Cause exogene(accident,scuicide,homicide)"id="CIM03" type="radio"  name="CD" value="CV" />';
			            echo'<input title="Indeterminée(homicide,scuicide,accident)"id="CIM04" type="radio"  name="CD" value="CI" />';
						break;}
				   case 'CV' :
						{ 
						echo'<input  title="Cause endogene(maladie,senescence)"id="CIM02" type="radio"  name="CD" value="CN" />';
						echo'<input  title="Cause exogene(accident,scuicide,homicide)"id="CIM03" type="radio"  name="CD" value="CV" checked/>';
						echo'<input title="Indeterminée(homicide,scuicide,accident)"id="CIM04" type="radio"  name="CD" value="CI" />';
						break;}
				   case 'CI' :
						{ 
						echo'<input  title="Cause endogene(maladie,senescence)"id="CIM02" type="radio"  name="CD" value="CN" />';
						echo'<input  title="Cause exogene(accident,scuicide,homicide)"id="CIM03" type="radio"  name="CD" value="CV" />';
						echo'<input title="Indeterminée(homicide,scuicide,accident)"id="CIM04" type="radio"  name="CD" value="CI" checked/>';
						break;}		
				}		
				
			echo '<label id="lNDM1">Nature de la mort:</label>';
				echo '<label id="lNDM2">Naturelle:</label>';
				echo '<label id="lNDM3">Accident:</label>';
				echo '<label id="lNDM4">auto induite:</label>';
				echo '<label id="lNDM5">agression:</label>';
				echo '<label id="lNDM6">indéterminée:</label>';
				echo '<label id="lNDM7">Autre (a préciser):</label>';
				switch($this->user[0]['NDLM'])  
				{
				    case 'NAT' :
						{  
						echo'<input id="NDM2" type="radio"  name="NDLM" value="NAT" checked />';
						echo'<input id="NDM3" type="radio"  name="NDLM" value="ACC" />';
						echo'<input id="NDM4" type="radio"  name="NDLM" value="AID" />';
						echo'<input id="NDM5" type="radio"  name="NDLM" value="AGR" />';
						echo'<input id="NDM6" type="radio"  name="NDLM" value="IND" />';
						echo'<input id="NDM7" type="radio"  name="NDLM" value="AAP" /><input id="NDLMAAP" type="txt" name="NDLMAAP" value="'.$this->user[0]['NDLMAAP'].'"/>';
						break;}
					 case 'ACC' :
						{ 
						echo'<input id="NDM2" type="radio"  name="NDLM" value="NAT" />';
						echo'<input id="NDM3" type="radio"  name="NDLM" value="ACC" checked/>';
						echo'<input id="NDM4" type="radio"  name="NDLM" value="AID" />';
						echo'<input id="NDM5" type="radio"  name="NDLM" value="AGR" />';
						echo'<input id="NDM6" type="radio"  name="NDLM" value="IND" />';
						echo'<input id="NDM7" type="radio"  name="NDLM" value="AAP" /><input id="NDLMAAP" type="txt" name="NDLMAAP" value="'.$this->user[0]['NDLMAAP'].'"/>';
						break;}
					 case 'AID' :
						{ 
						echo'<input id="NDM2" type="radio"  name="NDLM" value="NAT" />';
						echo'<input id="NDM3" type="radio"  name="NDLM" value="ACC" />';
						echo'<input id="NDM4" type="radio"  name="NDLM" value="AID" checked/>';
						echo'<input id="NDM5" type="radio"  name="NDLM" value="AGR" />';
						echo'<input id="NDM6" type="radio"  name="NDLM" value="IND" />';
						echo'<input id="NDM7" type="radio"  name="NDLM" value="AAP" /><input id="NDLMAAP" type="txt" name="NDLMAAP" value="'.$this->user[0]['NDLMAAP'].'"/>';
						break;}
					 case 'AGR' :
						{
						echo'<input id="NDM2" type="radio"  name="NDLM" value="NAT" />';
						echo'<input id="NDM3" type="radio"  name="NDLM" value="ACC" />';
						echo'<input id="NDM4" type="radio"  name="NDLM" value="AID" />';
						echo'<input id="NDM5" type="radio"  name="NDLM" value="AGR" checked/>';
						echo'<input id="NDM6" type="radio"  name="NDLM" value="IND" />';
						echo'<input id="NDM7" type="radio"  name="NDLM" value="AAP" /><input id="NDLMAAP" type="txt" name="NDLMAAP" value="'.$this->user[0]['NDLMAAP'].'"/>';
						break;}
					 case 'IND' :
						{  
						echo'<input id="NDM2" type="radio"  name="NDLM" value="NAT" />';
						echo'<input id="NDM3" type="radio"  name="NDLM" value="ACC" />';
						echo'<input id="NDM4" type="radio"  name="NDLM" value="AID" />';
						echo'<input id="NDM5" type="radio"  name="NDLM" value="AGR" />';
						echo'<input id="NDM6" type="radio"  name="NDLM" value="IND" checked/>';
						echo'<input id="NDM7" type="radio"  name="NDLM" value="AAP" /><input id="NDLMAAP" type="txt" name="NDLMAAP" value="'.$this->user[0]['NDLMAAP'].'"/>';
						break;}
					 case 'AAP' :
						{  
						echo'<input id="NDM2" type="radio"  name="NDLM" value="NAT" />';
						echo'<input id="NDM3" type="radio"  name="NDLM" value="ACC" />';
						echo'<input id="NDM4" type="radio"  name="NDLM" value="AID" />';
						echo'<input id="NDM5" type="radio"  name="NDLM" value="AGR" />';
						echo'<input id="NDM6" type="radio"  name="NDLM" value="IND" />';
						echo'<input id="NDM7" type="radio"  name="NDLM" value="AAP" checked/><input id="NDLMAAP" type="txt" name="NDLMAAP" value="'.$this->user[0]['NDLMAAP'].'"/>';
						break;}		
				}			
			echo '</div>';
			echo '<div id="content_3" class="contenttabs3">';
			echo '<label id="lDECEMAT0"  >Décés maternel:</label>';
			
				if ($this->user[0]['DECEMAT']=='1') 
				{
				echo '<label id="lDECEMAT"  >Décés maternel:</label>       <input id="DECEMAT"    type="checkbox"  name="DECEMAT" checked /> ';
				}
				else
				{
				echo '<label id="lDECEMAT"  >Décés maternel:</label>       <input id="DECEMAT"    type="checkbox"  name="DECEMAT"  /> ';
				}
			
			echo '<label id="lDGRO">Durant la grossesse:</label>';
			echo '<label id="lDACC">Durant l\'accouchement:</label>';
			echo '<label id="lDAVO">Durant l\'avortement:</label>';
			echo '<label id="lAGESTATION">Aprés la gestation "post partum" :</label>';
			echo '<label id="lIDETER">Indéterminé:</label> ';
			
			
			
			switch($this->user[0]['GRS'])  
				{
				   case 'DGRO' :
						{ 
						echo'<input id="DGRO"       type="radio"     name="GRS"     value="DGRO" checked/>';
						echo'<input id="DACC"       type="radio"     name="GRS"     value="DACC" />';
						echo'<input id="DAVO"       type="radio"     name="GRS"     value="DAVO" />';
						echo'<input id="AGESTATION" type="radio"     name="GRS"     value="AGESTATION" />';
						echo'<input id="IDETER"     type="radio"     name="GRS"     value="IDETER"  />';
						break;}
				  case 'DACC' :
						{ 
						echo'<input id="DGRO"       type="radio"     name="GRS"     value="DGRO" />';
						echo'<input id="DACC"       type="radio"     name="GRS"     value="DACC" checked/>';
						echo'<input id="DAVO"       type="radio"     name="GRS"     value="DAVO" />';
						echo'<input id="AGESTATION" type="radio"     name="GRS"     value="AGESTATION" />';
						echo'<input id="IDETER"     type="radio"     name="GRS"     value="IDETER"  />';
						break;}
				  case 'DAVO' :
						{
						echo'<input id="DGRO"       type="radio"     name="GRS"     value="DGRO" />';
						echo'<input id="DACC"       type="radio"     name="GRS"     value="DACC" />';
						echo'<input id="DAVO"       type="radio"     name="GRS"     value="DAVO" checked/>';
						echo'<input id="AGESTATION" type="radio"     name="GRS"     value="AGESTATION" />';
						echo'<input id="IDETER"     type="radio"     name="GRS"     value="IDETER"  />';
						break;}
				  case 'AGESTATION' :
						{ 
						echo'<input id="DGRO"       type="radio"     name="GRS"     value="DGRO" />';
						echo'<input id="DACC"       type="radio"     name="GRS"     value="DACC" />';
						echo'<input id="DAVO"       type="radio"     name="GRS"     value="DAVO" />';
						echo'<input id="AGESTATION" type="radio"     name="GRS"     value="AGESTATION" checked/>';
						echo'<input id="IDETER"     type="radio"     name="GRS"     value="IDETER"  />'; 
						break;}
				  case 'IDETER' :
						{ 
						echo'<input id="DGRO"       type="radio"     name="GRS"     value="DGRO" />';
						echo'<input id="DACC"       type="radio"     name="GRS"     value="DACC" />';
						echo'<input id="DAVO"       type="radio"     name="GRS"     value="DAVO" />';
						echo'<input id="AGESTATION" type="radio"     name="GRS"     value="AGESTATION" />';
						echo'<input id="IDETER"     type="radio"     name="GRS"     value="IDETER" checked />';
						break;}		
				}
			echo '<label id="MNP0">Mortinatalité, périnatalité:</label> ';
			if ($this->user[0]['GM']=='1') 
			{
			echo '<label id="MNP1">Grossesse multiple:</label>          <input id="GM"         type="checkbox"  name="GM" checked /> ';
			}
			else
			{
			echo '<label id="MNP1">Grossesse multiple:</label>          <input id="GM"         type="checkbox"  name="GM"  /> ';
			}
			if ($this->user[0]['MN']=='1') 
			{
			echo '<label id="MNP2">Mort-né:</label>                     <input id="MN"         type="checkbox"  name="MN" checked /> ';
			}
			else
			{
			echo '<label id="MNP2">Mort-né:</label>                     <input id="MN"         type="checkbox"  name="MN"  /> ';
			}
			echo '<label id="MNP3">Age gestationnel:</label>            <input id="AGEGEST"    type="txt" name="AGEGEST"   value="'.$this->user[0]['AGEGEST'].'" />';
			echo '<label id="MNP4">Poids a la naissance:</label>        <input id="POIDNSC"    type="txt" name="POIDNSC"   value="'.$this->user[0]['POIDNSC'].'" />';
			echo '<label id="MNP5">Age de la mére:</label>              <input id="AGEMERE"    type="txt" name="AGEMERE"   value="'.$this->user[0]['AGEMERE'].'" />';
			
			if ($this->user[0]['DPNAT']=='1') 
				{
				echo '<label id="MNP6">Si décés périnatal préciser:</label> <input id="DPNAT"      type="checkbox"  name="DPNAT" checked /> ';
			    echo '<input id="EMDPNAT" type="txt"  name="EMDPNAT" value="'.$this->user[0]['EMDPNAT'].'" />';
				
				}
				else
				{
				echo '<label id="MNP6">Si décés périnatal préciser:</label> <input id="DPNAT"      type="checkbox"  name="DPNAT"  /> ';
			    echo '<input id="EMDPNAT" type="txt"  name="EMDPNAT" value="'.$this->user[0]['EMDPNAT'].'" />';
				
				}
			
			echo '<label id="POSTOPP0">Intervention chirugicale:</label> ';
			
			if ($this->user[0]['POSTOPP']=='1') 
				{
				echo '<label id="POSTOPP1">4 semaines avant le décés:</label>          <input id="POSTOPP2"         type="checkbox"  name="POSTOPP" checked /> ';
				}
				else
				{
				echo '<label id="POSTOPP1">4 semaines avant le décés:</label>          <input id="POSTOPP2"         type="checkbox"  name="POSTOPP"  /> ';
				}
			echo '</div>';
			echo '<div id="content_4" class="contenttabs4"> ';
			echo '<label id="lNOMAR">: اللفـب</label>                <input id="NOMAR"       type="txt" name="NOMAR"       value="'.$this->user[0]['NOMAR'].'" />';
			echo '<label id="lPRENOMAR">: الإسم</label>               <input id="PRENOMAR"    type="txt" name="PRENOMAR"    value="'.$this->user[0]['PRENOMAR'].'" />';
			echo '<label id="lFILSDEAR">: الأب</label>                <input id="FILSDEAR"    type="txt" name="FILSDEAR"    value="'.$this->user[0]['FILSDEAR'].'" />';
			echo '<label id="lETDEAR">: الأم</label>                  <input id="ETDEAR"      type="txt" name="ETDEAR"      value="'.$this->user[0]['ETDEAR'].'" />';
			echo '<label id="lNOMPRENOMAR">: إسم و لقب الزوج</label> <input id="NOMPRENOMAR" type="txt" name="NOMPRENOMAR" value="'.$this->user[0]['NOMPRENOMAR'].'" />';
			echo '<label id="lPROAR">: المهنة </label>               <input id="PROAR"       type="txt" name="PROAR"       value="'.$this->user[0]['PROAR'].'" />';
			echo '<label id="lADAR">: عنوان الإقامة</label>           <input id="ADAR"        type="txt" name="ADAR"        value="'.$this->user[0]['ADAR'].'" />';
			echo '<input type="hidden" name="WILAYA"     value="'.Session::get('wilaya').'"/>';
			echo '<input type="hidden" name="STRUCTURE"  value="'.Session::get('structure').'"/>';
			echo '<input type="hidden" name="STRUCTURED" value="'.Session::get('structure').'"/>';
			echo '<input type="hidden" name="login"      value="'.Session::get('login').'"/>';
			echo '<input id="submitnew" type="submit" />	'; 
			echo '</div>';
			?> 
		</div> 
	</form> 
</div>	
<div class="scontentl2"><?php echo "";echo $this->msg; echo "";?></div>		
<div class="scontentl3"><?php html::rsc();?></div>
<div class="scontentr1"><?php echo "";echo dsp; echo "";?></div>	