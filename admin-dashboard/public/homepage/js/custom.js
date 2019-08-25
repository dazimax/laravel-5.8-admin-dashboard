$(window).load(function(){

	"use strict";
	
	
	/* ========================================================== */
	/*   LayerSlider                                              */
	/* ========================================================== */
	$(function(){
	
		// Calling LayerSlider on the target element with adding custom slider options
		$('#layerslider, #layerslider2').layerSlider({
			autoStart: true,
			pauseOnHover: true,
			navPrevNext: false,
			navButtons: true,
			navStartStop: true,
			thumbnailNavigation: false,
			autoPlayVideos: false,
			firstLayer: 1,
			skin: 'v5',
			skinsPath: 'layerslider/skins/'
 
			// Please make sure that you didn't forget to add a comma to the line endings
			// except the last line!
		});
	
	});
 
	
	/* ========================================================== */
	/*   Popup-Gallery                                            */
	/* ========================================================== */
	$('.popup-gallery').find('a.popup1').magnificPopup({
		type: 'image',
		gallery: {
		  enabled:true
		}
	}); 
	
	$('.popup-gallery').find('a.popup2').magnificPopup({
		type: 'image',
		gallery: {
		  enabled:true
		}
	}); 
 
	$('.popup-gallery').find('a.popup3').magnificPopup({
		type: 'image',
		gallery: {
		  enabled:true
		}
	}); 
 
	$('.popup-gallery').find('a.popup4').magnificPopup({
		type: 'iframe',
		gallery: {
		  enabled:false
		}
	});  
 
 
	/* ========================================================== */
	/*   Navigation Background Color                              */
	/* ========================================================== */
	
	$(window).scroll(function() {
		if($(this).scrollTop() > 100) {
			$('.navbar-fixed-top').addClass('opaque');
		} else {
			$('.navbar-fixed-top').removeClass('opaque');
		}
	});
 
	
	/* ========================================================== */
	/*   Navigation Color                                         */
	/* ========================================================== */
	
	$('#navbar-collapse-02').onePageNav({
		filter: ':not(.external)'
	});


	/* ========================================================== */
	/*   SmoothScroll                                             */
	/* ========================================================== */
	
	$(".nav li a, a.scrool").click(function(e){
		
		var full_url = this.href;
		var parts = full_url.split("#");
		var trgt = parts[1];
		var target_offset = $("#"+trgt).offset();
		var target_top = target_offset.top;
		
		$('html,body').animate({scrollTop:target_top -69}, 1000);
			return false;
		
	});


	/* ========================================================== */
	/*   Newsletter                                               */
	/* ========================================================== */
	
	$('.newsletter_box .newsletter_form').each( function(){
		var form = $(this);
		//form.validate();
		form.submit(function(e) {
			if (!e.isDefaultPrevented()) {
				jQuery.post(this.action,{
					'email':$('input[name="nf_email"]').val(),
				},function(data){
					form.fadeOut('fast', function() {
						$(this).siblings('p.newsletter_success_box').show();
					});
				});
				e.preventDefault();
			}
		});
	});	
	
	
	/* ========================================================== */
	/*   Contact                                                  */
	/* ========================================================== */
	// $('#contact-form').each( function(){
	// 	var form = $(this);
	// 	//form.validate();
	// 	form.submit(function(e) {
	// 		if (!e.isDefaultPrevented()) {
	// 			jQuery.post(this.action,{
	// 				'names':$('input[name="contact_names"]').val(),
	// 				'email':$('input[name="contact_email"]').val(),
	// 				'phone':$('input[name="contact_phone"]').val(),
	// 				'message':$('textarea[name="contact_message"]').val(),
	// 			},function(data){
	// 				form.fadeOut('fast', function() {
	// 					$(this).siblings('p').show();
	// 				});
	// 			});
	// 			e.preventDefault();
	// 		}
	// 	});
	// })

	
});
	
	
	/* ========================================================== */
	/*   Page Loader                                              */
	/* ========================================================== */
	  $('#loader').fadeOut(100);