<!DOCTYPE html>
<html>
<head>
<title><?php if (isset ($this->title)){echo $this->title; }else {echo title ;}?></title>
<link rel="icon" type="image/png" href="<?PHP echo URL; ?>public/images/<?php echo logo ?>?t=<?php echo time();?>" />
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" type="text/css" href="<?php echo URL;?>public/css/bootstrap.min.css?t=<?php echo time();?>">
<link rel="stylesheet" type="text/css" href="<?php echo URL;?>public/css/cssgrid.css?t=<?php echo time();?>">
<link rel="stylesheet" type="text/css" href="<?php echo URL;?>public/css/tabs.css?t=<?php echo time();?>">
<link rel="stylesheet" type="text/css" href="<?php echo URL;?>public/css/mystyle.css?t=<?php echo time();?>">
<script src="<?php echo URL;?>public/js/jquery.js?t=<?php echo time();?>"></script>
<script src="<?php echo URL;?>public/js/jquery.maskedinput.js?t=<?php echo time();?>"></script>
<script src="<?php echo URL;?>public/js/mystyle.js?t=<?php echo time();?>"></script>
<script src="<?php echo URL;?>public/js/popper.min.js?t=<?php echo time();?>"></script>
<script src="<?php echo URL;?>public/js/bootstrap.min.js?t=<?php echo time();?>"></script>
<script src="<?php echo URL;?>public/js/bootstrap.bundle.min.js?t=<?php echo time();?>"></script>
<?php if (isset($this->js)){foreach ($this->js as $js){echo '<script type="text/javascript" src="'.URL.'views/'.$js.'"></script>';}}?>
</head>
<body>
<?php 
Session::init();
function getmicrotime(){list($usec, $sec) = explode(" ",microtime());return ((float)$usec + (float)$sec);}
$temps = getmicrotime();
?>
<div class="tiba" >
    <div class="headerl"></div>
	<div class="headerc">Ministere De L'agriculture Et Du Developpement Rural</div>
	<div class="headerr"></div>
	<div class="sheaderl">
	<?php 
	if (Session::get('loggedIn') == false)
	{
	echo '<a href="'.URL.'">Accueil <img src="'.URL.'public/images/b_home.png" width="16" height="16" border="0" alt=""/></a>';echo '&nbsp;';
	echo '<a href="'.URL.'setup">Setup <img src="'.URL.'public/images/setup.jpg" width="16" height="16" border="0" alt=""/></a>';echo '&nbsp;';
	echo '<a href="'.URL.'help">Help <img src="'.URL.'public/images/help.jpg" width="16" height="16" border="0" alt=""/></a>';echo '&nbsp;';
	echo '<a href="'.URL.'login">Login <img src="'.URL.'public/images/Login.jpg" width="16" height="16" border="0" alt=""/></a>';echo '&nbsp;';
	echo '<a href="'.URL.'register">Register <img src="'.URL.'public/images/register.jpg" width="16" height="16" border="0" alt=""/></a>';echo '&nbsp;';
	}
	else
	{
	
		if (Session::get('demgraphie') == 1)
		{
		echo '<a href="'.URL.'dashboard">Accueil <img src="'.URL.'public/images/b_home.png" width="16" height="16" border="0" alt=""/></a>';echo '&nbsp;';
		   if (Session::get('login') == admin)
			{
				echo '<a href="'.URL.'dashboard/Evaluation/0">Evaluation <img src="'.URL.'public/images/eva.png" width="16" height="16" border="0" alt=""/></a>';echo '&nbsp;';
				echo '<a href="'.URL.'dashboard/SIGA/">Siga <img src="'.URL.'public/images/sig.png" width="16" height="16" border="0" alt=""/></a>';echo '&nbsp;';
				echo '<a href="'.URL.'dashboard/CIM/">CIM <img src="'.URL.'public/images/cim.jpg" width="16" height="16" border="0" alt=""/></a>';echo '&nbsp;';
			}
			if (Session::get('login') == sadmin)
			{  
				//echo '<a href="'.URL.'dashboard/Evaluation/">Evaluation <img src="'.URL.'public/images/eva.png" width="16" height="16" border="0" alt=""/></a>';echo '&nbsp;';
				//echo '<a href="'.URL.'dashboard/DSP/">DSP <img src="'.URL.'public/images/eva.png" width="16" height="16" border="0" alt=""/></a>';echo '&nbsp;';
				//echo '<a href="'.URL.'dashboard/SIGA/">Sig <img src="'.URL.'public/images/sig.png" width="16" height="16" border="0" alt=""/></a>';echo '&nbsp;';
				//echo '<a href="'.URL.'dashboard/CIM/">CIM <img src="'.URL.'public/images/cim.jpg" width="16" height="16" border="0" alt=""/></a>';echo '&nbsp;';
				//echo '<a href="'.URL.'dashboard/cfg/">Cfg <img src="'.URL.'public/images/cfg.jpg" width="16" height="16" border="0" alt=""/></a>';echo '&nbsp;';
				//echo '<a href="'.URL.'bnm/">BNM <img src="'.URL.'public/images/demographie.jpg" width="16" height="16" border="0" alt=""/></a>';echo '&nbsp;';
			    //echo '<a href="'.URL.'avi/">AVI <img src="'.URL.'public/images/possin.jpg" width="16" height="16" border="0" alt=""/></a>';echo '&nbsp;';
			
			}
		}
		else
		{
		echo '<a href="'.URL.'naissance">Accueil <img src="'.URL.'public/images/b_home.png" width="16" height="16" border="0" alt=""/></a>';echo '&nbsp;';
		}	
		echo '<a href="'.URL.'Aviculteur">Aviculteur <img src="'.URL.'public/images/help.jpg" width="16" height="16" border="0" alt=""/></a>';echo '&nbsp;';
		echo '<a href="'.URL.'Produit">Produit <img src="'.URL.'public/images/help.jpg" width="16" height="16" border="0" alt=""/></a>';echo '&nbsp;';
		echo '<a href="'.URL.'Calendrier">Calendrier <img src="'.URL.'public/images/help.jpg" width="16" height="16" border="0" alt=""/></a>';echo '&nbsp;';
		echo '<a href="'.URL.'users/user/">Compte <img src="'.URL.'public/images/user.jpg" width="16" height="16" border="0" alt=""/></a>';echo '&nbsp;';
		echo '<a href="'.URL.'help">Help <img src="'.URL.'public/images/help.jpg" width="16" height="16" border="0" alt=""/></a>';echo '&nbsp;';
		echo '<a href="'.URL.'dashboard/logout">Logout <img src="'.URL.'public/images/s_loggoff.png" width="16" height="16" border="0" alt=""/></a>';echo '&nbsp;';   
	}
	?>				
    </div>	
	<div class="sheaderr"><?php if (Session::get('loggedIn') == true){echo '<p id="wdj" >'; echo HTML::nbrtostring('structure','id',Session::get('structure'),'structure').' : '.Session::get('login') ;echo '</p>';}else {echo '<p id="wdj" >Wilaya De Djelfa</p>';}	?>	</div>	