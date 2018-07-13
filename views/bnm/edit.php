<div class="sheader1r"><p id="llogin"><?php html::NAV();?></p></div>
<div class="sheader2r">Bordereau Numerique Mensuel</div>
<div class="contentsig">
<form  action="<?php echo URL."bnm/editSave/".$this->user[0]['id']; ?>"  method="POST"> 
<?php
$data = array(
"mois"     => $this->user[0]['mois'] ,
"annee"    => $this->user[0]['annee'] ,
"WILAYA1"  => $this->user[0]['WILAYAD'] ,
"WILAYA2"  => View::nbrtostring('wil','IDWIL',$this->user[0]['WILAYAD'],'WILAYAS'),
"COMMUNE1" => $this->user[0]['COMMUNED'] ,
"COMMUNE2" => View::nbrtostring('com','IDCOM',$this->user[0]['COMMUNED'],'COMMUNE'),
"nm1" => $this->user[0]['nm1'],"nf1"  => $this->user[0]['nf1'],
"nm2" => $this->user[0]['nm2'],"nf2"  => $this->user[0]['nf2'],
"mnm1"=> $this->user[0]['mnm1'],"mnf1"=> $this->user[0]['mnf1'],
"m1"  => $this->user[0]['m1'],"m2"    => $this->user[0]['m2'],
"djm1"=> $this->user[0]['djm1'],"djf1"=> $this->user[0]['djf1'],

"dm1"=> $this->user[0]['dm1'],"df1"=> $this->user[0]['df1'],
"dm2"=> $this->user[0]['dm2'],"df2"=> $this->user[0]['df2'],
"dm3"=> $this->user[0]['dm3'],"df3"=> $this->user[0]['df3'],
"dm4"=> $this->user[0]['dm4'],"df4"=> $this->user[0]['df4'],
"dm5"=> $this->user[0]['dm5'],"df5"=> $this->user[0]['df5'],
"dm6"=> $this->user[0]['dm6'],"df6"=> $this->user[0]['df6'],
"dm7"=> $this->user[0]['dm7'],"df7"=> $this->user[0]['df7'],
"dm8"=> $this->user[0]['dm8'],"df8"=> $this->user[0]['df8'],
"dm9"=> $this->user[0]['dm9'],"df9"=> $this->user[0]['df9'],
"dm10"=> $this->user[0]['dm10'],"df10"=> $this->user[0]['df10'],
"dm11"=> $this->user[0]['dm11'],"df11"=> $this->user[0]['df11'],
"dm12"=> $this->user[0]['dm12'],"df12"=> $this->user[0]['df12'],
"dm13"=> $this->user[0]['dm13'],"df13"=> $this->user[0]['df13'],
"dm14"=> $this->user[0]['dm14'],"df14"=> $this->user[0]['df14'],
"dm15"=> $this->user[0]['dm15'],"df15"=> $this->user[0]['df15'],
"dm16"=> $this->user[0]['dm16'],"df16"=> $this->user[0]['df16'],
"dm17"=> $this->user[0]['dm17'],"df17"=> $this->user[0]['df17'],
"dm18"=> $this->user[0]['dm18'],"df18"=> $this->user[0]['df18'],
"dm19"=> $this->user[0]['dm19'],"df19"=> $this->user[0]['df19'],
"dm20"=> "","df20"=> ""
);
HTML::tabsbnm($data);
?>
</form> 			
</div>
<div class="contenth"><img id="image" src="<?php echo URL;?>public/images/demographie1.jpg" ></div>	
<div class="content"><img id="image" src="<?php echo URL;?>public/images/djelfa.png" ></div>
<div class="contentb"><img id="image" src="<?php echo URL;?>public/images/demographie1.jpg" ></div>
<div class="contentr"><img id="image" src="<?php echo URL;?>public/images/<?php echo logod;?>"></div>	
<div class="scontentr1"><?php echo "";echo dsp; echo "";?></div>



<?php 
// lang(Session::get('lang'));
// ob_start();

// $data = array(
// "titre"     => 'Update Eleve Scolarise', 
// "btn"       => 'scolaire', 
// "id"        => $this->user[0]['id'], 
// "butun"     => 'Update eleve', 
// "photos"    => 'PYRAMIDE.jpg',
// "action"    => 'scolaire/editSave/'.$this->user[0]['id'],
// "DINS"      => date('Y-m-d'),
// "HINS"      => date("H:i"),
// "NOM"       => $this->user[0]['NOM'],
// "PRENOM"    => $this->user[0]['PRENOM'],    
// "FILSDE"    => $this->user[0]['FILSDE'], 
// "ETDE"      => $this->user[0]['ETDE'], 
// "SEXE"      => array($this->user[0]['SEXE'],"M", "F"),
// "DATENS"    => $this->user[0]['DATENS'],
// "WILAYAN1"  => $this->user[0]['WILAYAN'] ,
// "WILAYAN2"  => View::nbrtostring('wil','IDWIL',$this->user[0]['WILAYAN'],'WILAYAS'),
// "COMMUNEN1" => $this->user[0]['COMMUNEN'] ,
// "COMMUNEN2" => View::nbrtostring('com','IDCOM',$this->user[0]['COMMUNEN'],'COMMUNE'),
// "WILAYAR1"  => $this->user[0]['WILAYAR'] ,
// "WILAYAR2"  => View::nbrtostring('wil','IDWIL',$this->user[0]['WILAYAR'],'WILAYAS'),
// "COMMUNER1" => $this->user[0]['COMMUNER'],
// "COMMUNER2" => View::nbrtostring('com','IDCOM',$this->user[0]['COMMUNER'],'COMMUNE'),
// "ADRESSE1"  => $this->user[0]['ADRESSE'],
// "ADRESSE2"  => $this->user[0]['ADRESSE'],
// "TEL"       => $this->user[0]['TEL'],
// "TELF"      => $this->user[0]['TELF'],
// "EMAIL"     => $this->user[0]['EMAIL'],
// "GRABO"     => $this->user[0]['GRABO'] ,"GRRH"  => $this->user[0]['GRRH'],
// "NEC"       => $this->user[0]['NEC'],"DATEINS"=> $this->user[0]['DATEINS'],       
// "WILAYASS1" => $this->user[0]['WILAYASS'] ,
// "WILAYASS2" => View::nbrtostring('wil','IDWIL',$this->user[0]['WILAYASS'],'WILAYAS'),
// "COMMUNESS1" => $this->user[0]['COMMUNESS'] ,
// "COMMUNESS2" => View::nbrtostring('com','IDCOM',$this->user[0]['COMMUNESS'],'COMMUNE'),
// "ETASS1"     => $this->user[0]['ETASS'] ,
// "ETASS2"     => $this->user[0]['ETASS'] ,
// "x"         => "30",
// "y"         => "240"
// );
// View::datass($data);
// verifsession();	
// lang(Session::get('lang'));
// ob_start();$url1 = explode('/',$_GET['url']);
// View::fieldset("bnm0","<strong> Date-Wilaya-Commune</strong>"); 
// View::fieldset("bnm1","<strong>1-Naisances Par Sexe Enregistrées Dans La Commune</strong>"); 
// View::fieldset("bnm2","<strong>2-Mort Nées Enregistrés Dans La Commune Selon Le Sexe  </strong>"); 
// View::fieldset("bnm3","<strong>3-Mariages Enregistrées Dans La Commune</strong>"); 
// View::fieldset("bnm4","<strong>4-Deces Enregistrés Par Jugement Dans La Commune</strong>"); 
// View::fieldset("bnm5","<strong>5-Deces Survenus Dans La Commune</strong>"); 
// View::fieldset("bnm6","<strong>***</strong>"); 
// $data = array(
// "mois"     => $this->user[0]['mois'] ,
// "annee"     => $this->user[0]['annee'] ,
// "btn"       => 'Bordereau', 
// "id"        => $this->user[0]['id'], 
// "butun"     => 'Update Bordereau Numerique', 
// "photos"    => 'public/images/photos/pda.jpg',
// "action"    => 'Bordereau/editSave/'.$this->user[0]['id'],
// "WILAYAN1"  => $this->user[0]['WILAYAN'] ,
// "WILAYAN2"  => View::nbrtostring('wil','IDWIL',$this->user[0]['WILAYAN'],'WILAYAS'),
// "COMMUNEN1" => $this->user[0]['COMMUNEN'] ,
// "COMMUNEN2" => View::nbrtostring('com','IDCOM',$this->user[0]['COMMUNEN'],'COMMUNE'),
// "nm1" => $this->user[0]['nm1'],"nf1" => $this->user[0]['nf1'],
// "nm2" => $this->user[0]['nm2'],"nf2" => $this->user[0]['nf2'],
// "mnm1"=> $this->user[0]['mnm1'],"mnf1"=> $this->user[0]['mnf1'],
// "m1"=> $this->user[0]['m1'],"m2"=> $this->user[0]['m2'],
// "djm1"=> $this->user[0]['djm1'],"djf1"=> $this->user[0]['djf1'],
// "dm1"=> $this->user[0]['dm1'],"df1"=> $this->user[0]['df1'],
// "dm2"=> $this->user[0]['dm2'],"df2"=> $this->user[0]['df2'],
// "dm3"=> $this->user[0]['dm3'],"df3"=> $this->user[0]['df3'],
// "dm4"=> $this->user[0]['dm4'],"df4"=> $this->user[0]['df4'],
// "dm5"=> $this->user[0]['dm5'],"df5"=> $this->user[0]['df5'],
// "dm6"=> $this->user[0]['dm6'],"df6"=> $this->user[0]['df6'],
// "dm7"=> $this->user[0]['dm7'],"df7"=> $this->user[0]['df7'],
// "dm8"=> $this->user[0]['dm8'],"df8"=> $this->user[0]['df8'],
// "dm9"=> $this->user[0]['dm9'],"df9"=> $this->user[0]['df9'],
// "dm10"=> $this->user[0]['dm10'],"df10"=> $this->user[0]['df10'],
// "dm11"=> $this->user[0]['dm11'],"df11"=> $this->user[0]['df11'],
// "dm12"=> $this->user[0]['dm12'],"df12"=> $this->user[0]['df12'],
// "dm13"=> $this->user[0]['dm13'],"df13"=> $this->user[0]['df13'],
// "dm14"=> $this->user[0]['dm14'],"df14"=> $this->user[0]['df14'],
// "dm15"=> $this->user[0]['dm15'],"df15"=> $this->user[0]['df15'],
// "dm16"=> $this->user[0]['dm16'],"df16"=> $this->user[0]['df16'],
// "dm17"=> $this->user[0]['dm17'],"df17"=> $this->user[0]['df17'],
// "dm18"=> $this->user[0]['dm18'],"df18"=> $this->user[0]['df18'],
// "dm19"=> $this->user[0]['dm19'],"df19"=> $this->user[0]['df19']
// );

// view::button($data['btn'],'');
// echo "<h2>Update Bordereau Numerique Mensuel </h2 ><hr /><br />";
// $this->f0(URL.$data['action'],'post');
// View::photosurl(1170,230,URL.$data['photos']);
// $x=50;$y=10;
// $this->label($x,$y+250,'Date');    $this->date($x+450,$y+240,'mois',0,$data['mois'],'date');  $this->date($x+580,$y+240,'annee',0,$data['annee'],'date');
// $this->label($x,$y+280,'Wilaya');  $this->WILAYA($x+450,$y+270,'WILAYAN','country','mvc','wil',$data['WILAYAN1'],$data['WILAYAN2']);
// $this->label($x,$y+310,'Commune'); $this->COMMUNE($x+450,$y+300,'COMMUNEN','COMMUNEN',$data['COMMUNEN1'],$data['COMMUNEN2']);
// $this->label($x+465,$y+375,'Masculin');         $this->label($x+565,$y+375,'Feminin');   
// $this->label($x,$y+400,'Naissances Survenues Au cours Du Mois');                 $this->date($x+450,$y+390,'nm1',0,$data['nm1'],'date'); $this->date($x+550,$y+390,'nf1',0,$data['nf1'],'date');
// $this->label($x,$y+430,'Naissances Enregistrées Par Jugement');                  $this->date($x+450,$y+420,'nm2',0,$data['nm2'],'date'); $this->date($x+550,$y+420,'nf2',0,$data['nf2'],'date');
// $this->label($x+465,$y+495,'Masculin');         $this->label($x+565,$y+495,'Feminin'); 
// $this->label($x,$y+520,'Total Des Mort Nées Enregistrés Au Cours Du Mois ');   $this->date($x+450,$y+510,'mnm1',0,$data['mnm1'],'date');$this->date($x+550,$y+510,'mnf1',0,$data['mnf1'],'date');
// $this->label($x,$y+580,'Mariages Enregistrés Au Cours Du Mois ');              $this->date($x+550,$y+570,'m1',0,$data['m1'],'date');
// $this->label($x,$y+610,'Mariages Enregistrés Par Jugement Au Cours Du Mois '); $this->date($x+550,$y+600,'m2',0,$data['m2'],'date');
// $this->label($x+465,$y+675,'Masculin');         $this->label($x+565,$y+675,'Feminin'); 
// $this->label($x,$y+700,'Deces Enregistrés Par Jugement Au Cours Du Mois ');    $this->date($x+450,$y+690,'djm1',0,$data['djm1'],'date');$this->date($x+550,$y+690,'djf1',0,$data['djf1'],'date');
// $this->label($x+865,$y+225,'Masculin');      $this->label($x+965,$y+225,'Feminin');   
// $this->label($x+750,$y+250,'moins 1 ans');   $this->date($x+850,$y+240,'dm1',0,$data['dm1'],'date');$this->date($x+950,$y+240,'df1',0,$data['df1'],'date');
// $this->label($x+750,$y+280,'01-04 ans');     $this->date($x+850,$y+270,'dm2',0,$data['dm2'],'date');$this->date($x+950,$y+270,'df2',0,$data['df2'],'date');
// $this->label($x+750,$y+310,'05-09 ans');     $this->date($x+850,$y+300,'dm3',0,$data['dm3'],'date');$this->date($x+950,$y+300,'df3',0,$data['df3'],'date');
// $this->label($x+750,$y+340,'10-14 ans');     $this->date($x+850,$y+330,'dm4',0,$data['dm4'],'date');$this->date($x+950,$y+330,'df4',0,$data['df4'],'date');
// $this->label($x+750,$y+370,'15-19 ans');     $this->date($x+850,$y+360,'dm5',0,$data['dm5'],'date');$this->date($x+950,$y+360,'df5',0,$data['df5'],'date');
// $this->label($x+750,$y+400,'20-24 ans');     $this->date($x+850,$y+390,'dm6',0,$data['dm6'],'date');$this->date($x+950,$y+390,'df6',0,$data['df6'],'date');
// $this->label($x+750,$y+430,'25-29 ans');     $this->date($x+850,$y+420,'dm7',0,$data['dm7'],'date');$this->date($x+950,$y+420,'df7',0,$data['df7'],'date');
// $this->label($x+750,$y+460,'30-34 ans');     $this->date($x+850,$y+450,'dm8',0,$data['dm8'],'date');$this->date($x+950,$y+450,'df8',0,$data['df8'],'date');
// $this->label($x+750,$y+490,'35-39 ans');     $this->date($x+850,$y+480,'dm9',0,$data['dm9'],'date');$this->date($x+950,$y+480,'df9',0,$data['df9'],'date');
// $this->label($x+750,$y+520,'40-44 ans');     $this->date($x+850,$y+510,'dm10',0,$data['dm10'],'date');$this->date($x+950,$y+510,'df10',0,$data['df10'],'date');
// $this->label($x+750,$y+550,'45-49 ans');     $this->date($x+850,$y+540,'dm11',0,$data['dm11'],'date');$this->date($x+950,$y+540,'df11',0,$data['df11'],'date');
// $this->label($x+750,$y+580,'50-54 ans');     $this->date($x+850,$y+570,'dm12',0,$data['dm12'],'date');$this->date($x+950,$y+570,'df12',0,$data['df12'],'date');
// $this->label($x+750,$y+610,'55-59 ans');     $this->date($x+850,$y+600,'dm13',0,$data['dm13'],'date');$this->date($x+950,$y+600,'df13',0,$data['df13'],'date');
// $this->label($x+750,$y+640,'60-64 ans');     $this->date($x+850,$y+630,'dm14',0,$data['dm14'],'date');$this->date($x+950,$y+630,'df14',0,$data['df14'],'date');
// $this->label($x+750,$y+670,'65-69 ans');     $this->date($x+850,$y+660,'dm15',0,$data['dm15'],'date');$this->date($x+950,$y+660,'df15',0,$data['df15'],'date');
// $this->label($x+750,$y+700,'70-74 ans');     $this->date($x+850,$y+690,'dm16',0,$data['dm16'],'date');$this->date($x+950,$y+690,'df16',0,$data['df16'],'date');
// $this->label($x+750,$y+730,'75-79 ans');     $this->date($x+850,$y+720,'dm17',0,$data['dm17'],'date');$this->date($x+950,$y+720,'df17',0,$data['df17'],'date');
// $this->label($x+750,$y+760,'80-84 ans');     $this->date($x+850,$y+750,'dm18',0,$data['dm18'],'date');$this->date($x+950,$y+750,'df18',0,$data['df18'],'date');
// $this->label($x+750,$y+790,'85 et plus');    $this->date($x+850,$y+780,'dm19',0,$data['dm19'],'date');$this->date($x+950,$y+780,'df19',0,$data['df19'],'date');
// $this->submit($x+230,$y+760,$data['butun']);
// $this->f1();
// ob_end_flush();
// view::sautligne(28);




// ob_end_flush(); 	
?>