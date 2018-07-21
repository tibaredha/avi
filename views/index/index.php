<div class="sheader1l"><p id="lacceuil"><?php echo "";echo $this->msg; echo "";?></p></div><div class="sheader1r"><p id="lsetup"><?php html::NAV();?></p></div>
<div class="sheader2l">Gérer Echantillon des poussins representative du lot (poids a jeun en grammes)</div>
<div class="sheader2r"></div>
<div class="contentl">
<!--<marquee behavior="slide" direction="up" scrollamount="2">

<p><font color="#FF0000">*</font>&nbsp;&nbsp;&nbsp;les informations rapportées par les certificats de deces permettent l'elaboration </p>
<p><font color="#FF0000">*</font>&nbsp;&nbsp;&nbsp;des statistiques exhaustives des causes médicales de deces en algerie</p>
<p><font color="#FF0000">*</font>&nbsp;&nbsp;&nbsp;dont l'utilisation a pour  but  d'orienter et évaluer les actions et les recherches </p>
<p><font color="#FF0000">*</font>&nbsp;&nbsp;&nbsp;dans le domaine de la sante publique</p>
<p><font color="#FF0000">*</font>&nbsp;&nbsp;&nbsp;donc la qualité et la precision des certificat de deces doit etre ameliorée</p>
<p><font color="#FF0000">*</font>&nbsp;&nbsp;&nbsp;compte tenu des evolutions technologiques le passage a un mode de certification </p>
<p><font color="#FF0000">*</font>&nbsp;&nbsp;&nbsp;electronique des deces est imperatif</p>
<p><font color="#FF0000">*</font>&nbsp;&nbsp;&nbsp;&nbsp;deverait permettre d'ameliorer considerablement le circuit du certificat de décès </p>
	<span class="import" onclick="show_popup('popup_upload')">Import CSV to MySQL</span>
</marquee>-->
 <!--<div id="popup_upload">
        <div class="form_upload">
            <span class="close" onclick="close_popup('popup_upload')">x</span>
            <h2>Upload CSV file</h2>
            <form action="import.php" method="post" enctype="multipart/form-data">
                <input type="file" name="csv_file" id="csv_file" class="file_input">
                <input type="submit" value="Upload file" id="upload_btn">
            </form>
        </div>
    </div>-->
	
<?php 
// html::mysqliconnect();
// echo "";
// echo dsp; 
// echo "";
// HTML::normaldist(30,340,'normal distribution : ','','avi','date','',date('Y'),'','='.Session::get('structure'));
HTML::normaldist1(30,340,'Distribution poids a jeun en grammes 01-64 semaines : ','','avi','date','',date('Y'),'','='.Session::get('structure'));


?>	
	

	
	
</div>	
<div class="content"><img id="image" src="<?php echo URL;?>public/images/accueil.jpg"></div>
<div class="contentr"><img id="image" src="<?php echo URL;?>public/images/<?php echo logod;?>"></div>	
<div class="scontentl2"><?php echo ""; echo "********************";?></div>		
<div class="scontentl3"><?php html::rsc();?></div>
<div class="scontentr1"><?php echo "";echo dsp; echo "";?></div>		