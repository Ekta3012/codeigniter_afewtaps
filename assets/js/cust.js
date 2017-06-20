/* loader */
window.addEventListener("load",function(){
	
	var load_screen = document.getElementById("loadingthescreen");
	document.body.removeChild(loadingthescreen);
	
});
/* end of the loader */


/* the navbar hidden effect */
 $('#main-nav').hide();
$(window).scroll(function() {
    if ($(this).scrollTop() > 500)
     {
        $('#main-nav').fadeIn("slow");
     }
    else
     {
      $('#main-nav').fadeOut("slow");
     }
 });

/* end of the navbar hidden effect */








		function openNav() {
    document.getElementById("mysidenav").style.width = "35%";


}

		function closeNav() {
    document.getElementById("mysidenav").style.width = "0";

}






/* first  learn more */
 $(document).ready(function(){
    $("#showthirdfourthfifth").click(function(){
        $("#sec_thirdfourthfifth").slideDown();
    });
    $(".theclosebutton").click(function(){
        $("#sec_thirdfourthfifth").slideUp("slow");
    });
}); 


$(function(){
		$('#showthirdfourthfifth').on('click',function(){
			$('#sec_thirdfourthfifth').addClass('animate fadeInDown');
		});
	});
/* end of first  learn more */	


/* second  learn more */

$(document).ready(function(){
    $("#learnmore_webdash").click(function(){
        $("#fifteen_sixteenseventeen").slideDown();
    });
    $(".theclosebuttonsec").click(function(){
        $("#fifteen_sixteenseventeen").slideUp("slow");
    });
}); 




/* end of second  learn more */	

/* 6- > 7 8 9 10 */

 $(document).ready(function(){
    $("#showseveneightnineten").click(function(){
        $("#six_seveneightnintenele").slideDown();
    });
    $(".theclosebuttonserviceapp").click(function(){
        $("#six_seveneightnintenele").slideUp("slow");
    });
}); 





/* end of 6-> 7 8 9 10 */

/* form open */
 $(document).ready(function(){
    $("#showform").click(function(){
        $("#twentythree_twentyfour").slideDown("slow");
    });
    $(".theclosebuttonformopen").click(function(){
        $("#twentythree_twentyfour").slideUp("slow");
    });
}); 

/* end of form open */

/*navbar */

/* form open */
 $(document).ready(function(){
    $("#openslidetwelve").click(function(){
        $("#eleven_twelve").slideDown("slow");
    });
    $(".theclosebuttonslidetwelve").click(function(){
        $("#eleven_twelve").slideUp("slow");
    });
}); 
/* end of form */

/* $(function() {
    $('#showform').click(function() {
       $('#showform').css('bottom', '-=30px');
    });
	 $('#showform').click(function() {
       $('#showform').css('top', '-=30px');
    });
}); */


/* the back to top button */
/*
if ( ($(window).height() + 100) < $(document).height() ) {
    $('#top-link-block').removeClass('hidden').affix({
        // how far to scroll down before link "slides" into view
        offset: {top:100}
    });
}
*/
/* end of back to top button */

/* firstdiv drop it down */




/* end of firstdiv drop it down */

/* benefits of serving */

$('.thefirstcontent').show(); 

$('.thesecondcontent').hide(); 

$('.thethirdcontent').hide(); 

$('.thefourthcontent').hide(); 

$('.thefifthcontent').hide(); 

$('.thesixthcontent').hide(); 

$('.theseventhcontent').hide(); 

$('.theeighthcontent').hide(); 



$('.changethefirst').mouseover(function () {
      $('.thefirstcontent').hide(200);      
});



$('.changethefirstborder').mouseover(function () {
     $(".changedbord").css({"border-bottom": "none"}); 
});


$('.changedbord').mouseover(function () {
     $(this).css({"border-bottom": "3px solid #03a6ff"}); 
});




$('.thefirstpicture').mouseover(function () {
      $('.thefirstcontent').show(200);      
});
$('.thefirstpicture').mouseout(function () {
      $('.thefirstcontent').hide(200);      
});

$('.theeighthpicture').mouseover(function () {
      $('.theeighthcontent').show(200);      
});
$('.theeighthpicture').mouseout(function () {
      $('.theeighthcontent').hide(200);      
});



$('.thesecondpicture  ').mouseover(function () {
      $('.thesecondcontent').show(200);      
});
$('.thesecondpicture  ').mouseout(function () {
       $('.thesecondcontent').hide(200);   
});


$('.thethirdpicture  ').mouseover(function () {
      $('.thethirdcontent').show(200);      
});
$('.thethirdpicture  ').mouseout(function () {
      $('.thethirdcontent').hide(200);      
});


$('.thefourthpicture  ').mouseover(function () {
      $('.thefourthcontent').show(200);      
});
$('.thefourthpicture  ').mouseout(function () {
      $('.thefourthcontent').hide(200);      
});


$('.thefifthpicture  ').mouseover(function () {
      $('.thefifthcontent').show(200);      
});
$('.thefifthpicture  ').mouseout(function () {
      $('.thefifthcontent').hide(200);      
});


$('.thesixthpicture  ').mouseover(function () {
      $('.thesixthcontent').show(200);      
});
$('.thesixthpicture  ').mouseout(function () {
      $('.thesixthcontent').hide(200);      
});


$('.theseventhpicture  ').mouseover(function () {
      $('.theseventhcontent').show(200);      
});
$('.theseventhpicture  ').mouseout(function () {
      $('.theseventhcontent').hide(200);      
});

/* end of benefits of serving */
 
/* some of our concepts  */


$('.thefirstcontentt').show(); 

$('.thesecondcontentt').hide(); 

$('.thethirdcontentt').hide(); 

$('.thefourthcontentt').hide(); 

$('.thefifthcontentt').hide(); 

$('.thesixthcontentt').hide(); 

$('.theseventhcontentt').hide(); 




$('.changethefirst').mouseover(function () {
      $('.thefirstcontentt').hide(200);      
});


$('.thefirstpicturee').mouseover(function () {
      $('.thefirstcontentt').show(200);      
});
$('.thefirstpicturee').mouseout(function () {
      $('.thefirstcontentt').hide(200);      
});


$('.thesecondpicturee  ').mouseover(function () {
      $('.thesecondcontentt').show(200);      
});
$('.thesecondpicturee  ').mouseout(function () {
      $('.thesecondcontentt').hide(200);      
});



$('.thethirdpicturee  ').mouseover(function () {
      $('.thethirdcontentt').show(200);      
});
$('.thethirdpicturee  ').mouseout(function () {
      $('.thethirdcontentt').hide(200);      
});


$('.thefourthpicturee  ').mouseover(function () {
      $('.thefourthcontentt').show(200);      
});
$('.thefourthpicturee  ').mouseout(function () {
      $('.thefourthcontentt').hide(200);      
});



$('.thefifthpicturee  ').mouseover(function () {
      $('.thefifthcontentt').show(200);      
});
$('.thefifthpicturee  ').mouseout(function () {
      $('.thefifthcontentt').hide(200);      
});



$('.thesixthpicturee  ').mouseover(function () {
      $('.thesixthcontentt').show(200);      
});
$('.thesixthpicturee  ').mouseout(function () {
      $('.thesixthcontentt').hide(200);      
});



$('.theseventhpicturee  ').mouseover(function () {
      $('.theseventhcontentt').show(200);      
});
$('.theseventhpicturee  ').mouseout(function () {
      $('.theseventhcontentt').hide(200);      
});







/* end of some of our conecpts */

/* user app icons description */


$('.thefirstcontents').show(); 

$('.thesecondcontents').hide(); 

$('.thethirdcontents').hide(); 

$('.thefourthcontents').hide(); 

$('.thefifthcontents').hide(); 


$('.changethefirst').mouseover(function () {
      $('.thefirstcontents').hide(200);      
});


$('.thefirstpictures').mouseover(function () {
      $('.thefirstcontents').show(200);      
});
$('.thefirstpictures').mouseout(function () {
      $('.thefirstcontents').hide(200);      
});


$('.thesecondpictures  ').mouseover(function () {
      $('.thethirdcontents').show(200);      
});
$('.thesecondpictures  ').mouseout(function () {
       $('.thethirdcontents').hide(200);   
});


$('.thethirdpictures  ').mouseover(function () {
      $('.thefifthcontents').show(200);      
});
$('.thethirdpictures  ').mouseout(function () {
      $('.thefifthcontents').hide(200);      
});


$('.thesixthpictures').mouseover(function () {
      $('.thefourthcontents').show(200);      
});
$('.thesixthpictures').mouseout(function () {
      $('.thefourthcontents').hide(200);      
});

$('.thefourthpictures').mouseover(function () {
      $('.thesecondcontents').show(200);      
});
$('.thefourthpictures').mouseout(function () {
      $('.thesecondcontents').hide(200);      
});







/* end of user app icons description */

/* the simple carousel calling method */


$('.containerss').carousel();

$('.containerss').carousel({

  // the number of images to display
  num: 3, 

  // max width of the active image
  maxWidth: 340,

  // min width of the active image
  maxHeight: 530, 

  // enable auto play
  autoPlay: true,

  // autoplay interval
  showTime: 3000,

  // animation speed
  animationTime: 300,

  // 0.0 - 1.0
  scale: 0.8,

  // the distance between images
  distance: 90
  
});
/* end of the simple carousel calling method */

