
function myFunction() {
    
	 tabSwitch('tab_2', 'content_2');
	 //document.getElementById("CIM1").autofocus;
     //document.getElementById("CIM1").focus();
	
	
	// alert("Hello! I am an alert box!");
	 //document.getElementById('content_2').style.display = 'active';  
	//var x = document.getElementById("MEDECINHOSPIT");
    //x.value = x.value.toUpperCase();
}
function myFunction1() {
    
	 tabSwitch('tab_3', 'content_3');
	 //document.getElementById("CIM1").autofocus;
     //document.getElementById("CIM1").focus();
	
	
	// alert("Hello! I am an alert box!");
	 //document.getElementById('content_2').style.display = 'active';  
	//var x = document.getElementById("MEDECINHOSPIT");
    //x.value = x.value.toUpperCase();
}



/*disable clic droit
function disableselect(e){ 
return false 
} 
function reEnable(){ 
return true 
} 
document.onselectstart=new Function ("return false") 
document.oncontextmenu=new Function ("return false") 
if (window.sidebar){ 
document.onmousedown=disableselect 
document.onclick=reEnable 
} 
*/
/*disable clic droit fin */

// show_popup : show the popup
function show_popup(id) {
	// show the popup
	$('#'+id).show();
}

// close_popup : close the popup
function close_popup(id) {
	// hide the popup
	$('#'+id).hide();
}
// show_popup : show the popup fin 




$(function() {    
    $('.delete').click(function(e) {
        var c = confirm(" Vous êtes sure de supprimer l'enregistrement ? \n  Si oui, confirmer la suppression ");
        if (c == false) return false;   
    });   
});

$(document).ready(function()
{
		$(".WILAYAD").change(function()
		{
			var id=$(this).val();
			var dataString = 'id='+ id;

			$.ajax
			({
				type: "POST",                           // Le type de ma requete
				url: "/framework/public/js/ajaxwc.PHP", // L'url vers laquelle la requete sera envoyee
				data: dataString,                       // Les donnees que l'on souhaite envoyer au serveur au format varaible ,JSON
				cache: false,
				success: function(html)                 // La reponse du serveur est contenu dans data  text xml json JSON (JavaScript Object Notation) 
						{
						$(".COMMUNED").html(html);      // On peut faire ce qu'on veut avec ici
						} 		
			});

		});
});
$(document).ready(function()
{
		$(".WILAYAN").change(function()
		{
			var id=$(this).val();
			var dataString = 'id='+ id;

			$.ajax
			({
				type: "POST",                           // Le type de ma requete
				url: "/framework/public/js/ajaxwc.PHP", // L'url vers laquelle la requete sera envoyee
				data: dataString,                       // Les donnees que l'on souhaite envoyer au serveur au format varaible ,JSON
				cache: false,
				success: function(html)                 // La reponse du serveur est contenu dans data  text xml json JSON (JavaScript Object Notation) 
						{
						$(".COMMUNEN").html(html);      // On peut faire ce qu'on veut avec ici
						} 		
			});

		});
});
$(document).ready(function()
{
		$(".WILAYAR").change(function()
		{
			var id=$(this).val();
			var dataString = 'id='+ id;

			$.ajax
			({
				type: "POST",                           // Le type de ma requete
				url: "/framework/public/js/ajaxwc.PHP", // L'url vers laquelle la requete sera envoyee
				data: dataString,                       // Les donnees que l'on souhaite envoyer au serveur au format varaible ,JSON
				cache: false,
				success: function(html)                 // La reponse du serveur est contenu dans data  text xml json JSON (JavaScript Object Notation) 
						{
						$(".COMMUNER").html(html);      // On peut faire ce qu'on veut avec ici
						} 		
			});

		});
});
$(document).ready(function()
{
		$(".wilaya").change(function()
		{
			var id=$(this).val();
			var dataString = 'id='+ id;

			$.ajax
			({
				type: "POST",                           // Le type de ma requete
				url: "/framework/public/js/ajaxws.PHP", // L'url vers laquelle la requete sera envoyee
				data: dataString,                       // Les donnees que l'on souhaite envoyer au serveur au format varaible ,JSON
				cache: false,
				success: function(html)              // La reponse du serveur est contenu dans data  text xml json JSON (JavaScript Object Notation) 
						{
						$(".structure").html(html);   // On peut faire ce qu'on veut avec ici
						} 		
			});

		});
});

$(document).ready(function() {	
});
//jvs pour chapitre categorie de la cim10
$(document).ready(function()
{
		$(".cim1").change(function()
		{
			var id=$(this).val();
			var dataString = 'id='+ id;

			$.ajax
			({
				type: "POST",                        // Le type de ma requete
				url: "/deces/public/js/ajaxcim.php",                // L'url vers laquelle la requete sera envoyee
				data: dataString,                    // Les donnees que l'on souhaite envoyer au serveur au format varaible ,JSON
				cache: false,
				success: function(html)              // La reponse du serveur est contenu dans data  text xml json JSON (JavaScript Object Notation) 
						{
						$(".cim2").html(html);   // On peut faire ce qu'on veut avec ici
						} 
					
			});

		});
});

/*Activates the Tabs*/
function tabSwitch(new_tab, new_content) {    
    document.getElementById('content_1').style.display = 'none';  
    document.getElementById('content_2').style.display = 'none';  
    document.getElementById('content_3').style.display = 'none';  
	document.getElementById('content_4').style.display = 'none';  
	
	/*document.getElementById('content_3').style.display = 'none';*/ 
	document.getElementById(new_content).style.display = 'block';     
    document.getElementById('tab_1').className = '';  
    document.getElementById('tab_2').className = '';  
    document.getElementById('tab_3').className = '';  
	document.getElementById('tab_4').className = '';  
	
	/*document.getElementById('tab_3').className = ''; */        
    document.getElementById(new_tab).className = 'active';        
}



function toggleFullScreen() {
  if ((document.fullScreenElement && document.fullScreenElement !== null) ||    
   (!document.mozFullScreen && !document.webkitIsFullScreen)) {
    if (document.documentElement.requestFullScreen) {  
      document.documentElement.requestFullScreen();  
    } else if (document.documentElement.mozRequestFullScreen) {  
      document.documentElement.mozRequestFullScreen();  
    } else if (document.documentElement.webkitRequestFullScreen) {  
      document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);  
    }  
  } else {  
    if (document.cancelFullScreen) {  
      document.cancelFullScreen();  
    } else if (document.mozCancelFullScreen) {  
      document.mozCancelFullScreen();  
    } else if (document.webkitCancelFullScreen) {  
      document.webkitCancelFullScreen();  
    }  
  }  
}
//generation de code 
 function genererCodeP(){
        //var dt_dec= Date('Y');
      
       var DINS= document.getElementById("DINS").value;
	   var DATENS= document.getElementById("DATENS").value;
       var cod_wil= document.getElementById("WILAYAN").value;
       var cod_com= document.getElementById("COMMUNEN").value;
        //var n_acte= document.getElementById("acte").value;
        //var res1 = dt_nais.substring(8, 10);
        //var res2 = dt_dec.substring(13, 15);
        //var codePati= res1+cod_wil+cod_com3+n_acte+res2;
       // if(dt_dec != '' && dt_nais != '' && cod_wil != '' && cod_com3 != '' && n_acte != ''){
           // document.getElementById("show_codeP").style.display="";
          //  document.getElementById("code_patient").value= codePati;           
    //} 
	var val1 = DINS.substring(8, 10);
	var val2 = DATENS.substring(8, 10);
	var val3 = cod_wil.substring(-1);
	var val4 = cod_com.substring(-1);
	
	
	var codePati= val1+val2+val3+val4;
	document.getElementById("show_codeP").style.display="";
	document.getElementById("code_patient").value= codePati; 
	}


//generation de code 
function genererCodeP1(){
        //var dt_dec= Date('Y');
      
     var val0= parseInt(document.getElementById("avibn0").value);
	 var val1= parseInt(document.getElementById("avibn1").value);
     var val2= parseInt(document.getElementById("avibn2").value);
     var val3= parseInt(document.getElementById("avibn3").value);
     var val4= parseInt(document.getElementById("avibn4").value);
     var val5= parseInt(document.getElementById("avibn5").value);
     var val6= parseInt(document.getElementById("avibn6").value);
     var val7= parseInt(document.getElementById("avibn7").value);
     var val8= parseInt(document.getElementById("avibn8").value);
     var val9= parseInt(document.getElementById("avibn9").value);
     var val10= parseInt(document.getElementById("avibn10").value);
     
	 var val11= parseInt(document.getElementById("avibn11").value);
     var val12= parseInt(document.getElementById("avibn12").value);
     var val13= parseInt(document.getElementById("avibn13").value);
     var val14= parseInt(document.getElementById("avibn14").value);
     var val15= parseInt(document.getElementById("avibn15").value);
     var val16= parseInt(document.getElementById("avibn16").value);
     var val17= parseInt(document.getElementById("avibn17").value);
     var val18= parseInt(document.getElementById("avibn18").value);
     var val19= parseInt(document.getElementById("avibn19").value);
     var val20= parseInt(document.getElementById("avibn20").value);
	 
     var val21= parseInt(document.getElementById("avibn21").value);
     var val22= parseInt(document.getElementById("avibn22").value);
     var val23= parseInt(document.getElementById("avibn23").value);
     var val24= parseInt(document.getElementById("avibn24").value);
     var val25= parseInt(document.getElementById("avibn25").value);
     var val26= parseInt(document.getElementById("avibn26").value);
     var val27= parseInt(document.getElementById("avibn27").value);
     var val28= parseInt(document.getElementById("avibn28").value);
     var val29= parseInt(document.getElementById("avibn29").value);
     var val30= parseInt(document.getElementById("avibn30").value);
	
	 var val31= parseInt(document.getElementById("avibn31").value);
     var val32= parseInt(document.getElementById("avibn32").value);
     var val33= parseInt(document.getElementById("avibn33").value);
     var val34= parseInt(document.getElementById("avibn34").value);
     var val35= parseInt(document.getElementById("avibn35").value);
     var val36= parseInt(document.getElementById("avibn36").value);
     var val37= parseInt(document.getElementById("avibn37").value);
     var val38= parseInt(document.getElementById("avibn38").value);
     var val39= parseInt(document.getElementById("avibn39").value);
     var val40= parseInt(document.getElementById("avibn40").value);
	
	 var val41= parseInt(document.getElementById("avibn41").value);
     var val42= parseInt(document.getElementById("avibn42").value);
     var val43= parseInt(document.getElementById("avibn43").value);
     var val44= parseInt(document.getElementById("avibn44").value);
     var val45= parseInt(document.getElementById("avibn45").value);
     var val46= parseInt(document.getElementById("avibn46").value);
     var val47= parseInt(document.getElementById("avibn47").value);
     var val48= parseInt(document.getElementById("avibn48").value);
     var val49= parseInt(document.getElementById("avibn49").value);
     var val50= parseInt(document.getElementById("avibn50").value);
	
	 var val51= parseInt(document.getElementById("avibn51").value);
     var val52= parseInt(document.getElementById("avibn52").value);
     var val53= parseInt(document.getElementById("avibn53").value);
     var val54= parseInt(document.getElementById("avibn54").value);
     var val55= parseInt(document.getElementById("avibn55").value);
     var val56= parseInt(document.getElementById("avibn56").value);
     var val57= parseInt(document.getElementById("avibn57").value);
     var val58= parseInt(document.getElementById("avibn58").value);
     var val59= parseInt(document.getElementById("avibn59").value);
     var val60= parseInt(document.getElementById("avibn60").value);
	
	 var val61= parseInt(document.getElementById("avibn61").value);
     var val62= parseInt(document.getElementById("avibn62").value);
     var val63= parseInt(document.getElementById("avibn63").value);
     var val64= parseInt(document.getElementById("avibn64").value);
     var val65= parseInt(document.getElementById("avibn65").value);
     var val66= parseInt(document.getElementById("avibn66").value);
     var val67= parseInt(document.getElementById("avibn67").value);
     var val68= parseInt(document.getElementById("avibn68").value);
     var val69= parseInt(document.getElementById("avibn69").value);
     var val70= parseInt(document.getElementById("avibn70").value);
	 var val71= parseInt(document.getElementById("avibn71").value);
     var val72= parseInt(document.getElementById("avibn72").value);
     var val73= parseInt(document.getElementById("avibn73").value);
     var val74= parseInt(document.getElementById("avibn74").value);
     var val75= parseInt(document.getElementById("avibn75").value);
     var val76= parseInt(document.getElementById("avibn76").value);
     var val77= parseInt(document.getElementById("avibn77").value);
     var val78= parseInt(document.getElementById("avibn78").value);
     var val79= parseInt(document.getElementById("avibn79").value);
     var val80= parseInt(document.getElementById("avibn80").value);
	 var val81= parseInt(document.getElementById("avibn81").value);
     var val82= parseInt(document.getElementById("avibn82").value);
     var val83= parseInt(document.getElementById("avibn83").value);
     var val84= parseInt(document.getElementById("avibn84").value);
     var val85= parseInt(document.getElementById("avibn85").value);
     var val86= parseInt(document.getElementById("avibn86").value);
     var val87= parseInt(document.getElementById("avibn87").value);
     var val88= parseInt(document.getElementById("avibn88").value);
     var val89= parseInt(document.getElementById("avibn89").value);
     var val90= parseInt(document.getElementById("avibn90").value);
	 var val91= parseInt(document.getElementById("avibn91").value);
     var val92= parseInt(document.getElementById("avibn92").value);
     var val93= parseInt(document.getElementById("avibn93").value);
     var val94= parseInt(document.getElementById("avibn94").value);
     var val95= parseInt(document.getElementById("avibn95").value);
     var val96= parseInt(document.getElementById("avibn96").value);
     var val97= parseInt(document.getElementById("avibn97").value);
     var val98= parseInt(document.getElementById("avibn98").value);
     var val99= parseInt(document.getElementById("avibn99").value);
    
	
	var codePati= val0+val1+val2+val3+val4+val5+val6+val7+val8+val9+val10+val11+val12+val13+val14+val15+val16+val17+val18+val19+val20+val21+val22+val23+val24+val25+val26+val27+val28+val29+val30+val31+val32+val33+val34+val35+val36+val37+val38+val39+val40+val41+val42+val43+val44+val45+val46+val47+val48+val49+val50+val51+val52+val53+val54+val55+val56+val57+val58+val59+val60+val61+val62+val63+val64+val65+val66+val67+val68+val69+val70 +val71+val72+val73+val74+val75+val76+val77+val78+val79+val80+val81+val82+val83+val84+val85+val86+val87+val88+val89+val90+val91+val92+val93+val94+val95+val96+val97+val98+val99;
	var codePati1= codePati/100;
	
	// document.getElementById("show_codeP").style.display="";
	document.getElementById("code_patient").value = "Total : "+codePati; 
	document.getElementById("code_patient1").value = "Moyenne : "+ codePati1; 
	}



