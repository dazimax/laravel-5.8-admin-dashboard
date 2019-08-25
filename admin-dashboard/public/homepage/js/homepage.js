
$(document).ready(function(){
	
	$("form#home-contact-form").submit(function(e){
		e.preventDefault();
	    po.ajax({
	        type: 'POST',
	        url: $('form#home-contact-form').attr('action'),
	        data: $('form#home-contact-form').serialize(),
	        success: function(respond) {
	            if (respond.status == false) {
	            	new PNotify({
					    title: 'Error!',
					    text: respond.msg,
					    type: 'error'
					});
	            } else if(respond.status == true) {
	            	new PNotify({
					    title: 'Success!',
					    text: respond.msg,
					    type: 'success'
					});
					$('form#home-contact-form')[0].reset();
	            }else{
	            	new PNotify({
					    title: 'Error!',
					    text: 'Something went wrong..!',
					    type: 'error'
					});
	            }

	        }
	    });
	});


	$("form#homeRegisterForm").submit(function(e){
		var recapchaCustom = '';
		e.preventDefault();
		if($(this).find('input[name="password"]').val() != $(this).find('input[name="repassword"]').val()){
        	new PNotify({
			    title: 'Error!',
			    text: "passwords don't match",
			    type: 'error'
			});
		}else{
		    po.ajax({
		        type: 'POST',
		        url: $('form#homeRegisterForm').attr('action'),
		        data: $('form#homeRegisterForm').serialize(),
		        success: function(respond) {
		            if (respond.status == false) {
		            	new PNotify({
						    title: 'Error!',
						    text: respond.msg,
						    type: 'error'
						});
        				var recaptchaframe = $('.g-recaptcha iframe');
        				var recaptchaSoure = recaptchaframe[0].src;
        				recaptchaframe[0].src = '';
        				recaptchaframe[0].src = recaptchaSoure;
		            } else if(respond.status == true) {
		            	new PNotify({
						    title: 'Success!',
						    text: respond.msg,
						    type: 'success'
						});
						$('form#homeRegisterForm')[0].reset();
		            } else {
		            	new PNotify({
						    title: 'Error!',
						    text: 'Something went wrong..!',
						    type: 'error'
						});
		            }
		        }
		    });
		}
	});


	$("form#homeLoginForm").submit(function(e){
		e.preventDefault();
	    po.ajax({
	        type: 'POST',
	        url: $('form#homeLoginForm').attr('action'),
	        data: $('form#homeLoginForm').serialize(),
	        success: function(respond) {
	            if (respond.status == false) {
	            	new PNotify({
					    title: 'Error!',
					    text: respond.msg,
					    type: 'error'
					});
	            }else if(respond.status == true) {
	            	new PNotify({
					    title: 'Success!',
					    text: respond.msg,
					    type: 'success'
					});
	            	//window.location = "/home";
	            	window.location = "/user/profile";
	            }else{
	            	new PNotify({
					    title: 'Error!',
					    text: 'Something went wrong..!',
					    type: 'error'
					});
	            }
	        }
	    });
	});

});