<div class="sheader1r"><p id="llogin"><?php html::NAV();?></p></div>
<div class="sheader2r">Bordereau Numerique Mensuel</div>
<div class="contentsig">
<form  action="<?php echo URL."bnm/create/";  ?>"  method="POST"> 
<?php
$data = array(
"mois"     => date('m') ,
"annee"    => date('Y') ,
"WILAYA1"  => '17000' ,
"WILAYA2"  => 'Djelfa',
"COMMUNE1" => HTML::nbrtostring('structure','id',Session::get('structure'),'numcom') ,
"COMMUNE2" => HTML::nbrtostring('structure','id',Session::get('structure'),'com'),
"nm1" => "","nf1" => "",
"nm2" => "","nf2" => "",
"mnm1"=> "","mnf1"=> "",
"m1"  => "","m2"  => "",
"djm1"=> "","djf1"=> "",
"dm1"=> "","df1"=> "",
"dm2"=> "","df2"=> "",
"dm3"=> "","df3"=> "",
"dm4"=> "","df4"=> "",
"dm5"=> "","df5"=> "",
"dm6"=> "","df6"=> "",
"dm7"=> "","df7"=> "",
"dm8"=> "","df8"=> "",
"dm9"=> "","df9"=> "",
"dm10"=> "","df10"=> "",
"dm11"=> "","df11"=> "",
"dm12"=> "","df12"=> "",
"dm13"=> "","df13"=> "",
"dm14"=> "","df14"=> "",
"dm15"=> "","df15"=> "",
"dm16"=> "","df16"=> "",
"dm17"=> "","df17"=> "",
"dm18"=> "","df18"=> "",
"dm19"=> "","df19"=> "",
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