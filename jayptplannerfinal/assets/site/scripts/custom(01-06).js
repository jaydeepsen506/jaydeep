
$(window).load(function() { // makes sure the whole site is loaded

	"use strict";



//------------------------------------------------------------------------
//						PRELOADER SCRIPT
//------------------------------------------------------------------------   
	$('#preloader').delay(400).fadeOut('slow'); // will fade out the white DIV that covers the website.
	$('#preloader .inner').fadeOut(); // will first fade out the loading animation


//------------------------------------------------------------------------
//						WOW ANIMATION SETTINGS
//------------------------------------------------------------------------ 	
	var wow = new WOW({
		offset:100,        // distance to the element when triggering the animation (default is 0)
		mobile:false       // trigger animations on mobile devices (default is true)
  	});
	wow.init();


	
//------------------------------------------------------------------------
//						STELLAR (PARALLAX) SETTINGS
//------------------------------------------------------------------------ 	
if(!(navigator.userAgent.match(/iPhone|iPad|iPod|Android|BlackBerry|IEMobile/i))) {
	$.stellar({
		horizontalScrolling: false,
		positionProperty: 'transform'
	});
}



//------------------------------------------------------------------------
//						NAVBAR SLIDE SCRIPT
//------------------------------------------------------------------------ 		
	$(window).scroll(function () {
		if ($(window).scrollTop() > $("nav").height()) {
		    $("nav.navbar-slide").addClass("show-menu");
		} else {
		    $("nav.navbar-slide").removeClass("show-menu");
				$(".navbar-slide .navMenuCollapse").collapse({toggle: false});
				$(".navbar-slide .navMenuCollapse").collapse("hide");
				$(".navbar-slide .navbar-toggle").addClass("collapsed");
		}
	});
	
})




$(document).ready(function(){
	
	"use strict";


	
//------------------------------------------------------------------------
//						ANCHOR SMOOTHSCROLL SETTINGS
//------------------------------------------------------------------------
	$('a.goto, .navbar .nav a').smoothScroll({speed: 1200});
	



//------------------------------------------------------------------------
//						FULL HEIGHT SECTION SCRIPT
//------------------------------------------------------------------------
	$("#minimal-intro").css("min-height",$( window ).height());
	$( window ).resize(function() {
		$("#minimal-intro").css("min-height",$( window ).height());
	})


	
	
//------------------------------------------------------------------------
//						INTRO SUPERSLIDER SETTINGS
//------------------------------------------------------------------------
	$("#slides").superslides({
		play: 8000, //Milliseconds before progressing to next slide automatically. Use a falsey value to disable.
		animation: "fade", //slide or fade. This matches animations defined by fx engine.
		pagination: false,
		inherit_height_from:".intro-block",
		inherit_width_from:".intro-block"
	});




//------------------------------------------------------------------------
//						SCREENSHOTS SLIDER SETTINGS
//------------------------------------------------------------------------
	var owl = $("#screenshots-slider");
	owl.owlCarousel({
	    items : 5, 
	    itemsDesktop : [1400,4], 
	    itemsDesktopSmall : [1200,3], 
	    itemsTablet: [900,2], 
	    itemsMobile : [600,1],
		    stopOnHover:true
	});
	
	
	
//------------------------------------------------------------------------
//						TESTIMONIALS SLIDER SETTINGS
//------------------------------------------------------------------------
	var owl = $("#testimonials-slider");
	owl.owlCarousel({
	    singleItem:true,
		    autoPlay:5000,
		    stopOnHover:true
	});



//------------------------------------------------------------------------	
//                    MAGNIFIC POPUP(LIGHTBOX) SETTINGS
//------------------------------------------------------------------------  
	          
	$('#screenshots-slider').magnificPopup({
	    delegate: 'a',
	    type: 'image',
	    gallery: {
		enabled: true
	    }
	});


	
//------------------------------------------------------------------------
//					SUBSCRIBE FORM VALIDATION'S SETTINGS
//------------------------------------------------------------------------          
	$('#subscribe_form').validate({
	    onfocusout: false,
	    onkeyup: false,
	    rules: {
		email: {
		    required: true,
		    email: true
		}
	    },
	    errorPlacement: function(error, element) {
		error.appendTo( element.closest("form"));
	    },
	    messages: {
		email: {
		    required: "We need your email address to contact you",
		    email: "Please, enter a valid email"
		}
	    },
					    
	    highlight: function(element) {
		$(element)
	    },                    
					    
	    success: function(element) {
		element
		.text('').addClass('valid')
	    }
	}); 
	

		
				
//------------------------------------------------------------------------------------
//						SUBSCRIBE FORM MAILCHIMP INTEGRATIONS SCRIPT
//------------------------------------------------------------------------------------		
	$('#subscribe_form').submit(function() {
	    $('.error').hide();
	    $('.error').fadeIn();
	    // submit the form
	    if($(this).valid()){
		$('#subscribe_submit').button('loading'); 
		var action = $(this).attr('action');
		$.ajax({
		    url: action,
		    type: 'POST',
		    data: {
			newsletter_email: $('#subscribe_email').val()
		    },
		    success: function(data) {
			$('#subscribe_submit').button('reset');
					    
					    //Use modal popups to display messages
					    $('#modalMessage .modal-title').html('<i class="icon icon-envelope-open"></i>' + data);
					    $('#modalMessage').modal('show');
					    
		    },
		    error: function() {
			$('#subscribe_submit').button('reset');
					    
					    //Use modal popups to display messages
					    $('#modalMessage .modal-title').html('<i class="icon icon-ban"></i>Oops!<br>Something went wrong!');
					    $('#modalMessage').modal('show');
					    
		    }
		});
	    }
	    return false; 
	});
	  
	  
	  
	  
//------------------------------------------------------------------------------------
//						CONTACT FORM VALIDATION'S SETTINGS
//------------------------------------------------------------------------------------		  
	$('#contact_form').validate({
	    onfocusout: false,
	    onkeyup: false,
	    rules: {
		name: "required",
		message: "required",
		email: {
		    required: true,
		    email: true
		}
	    },
	    errorPlacement: function(error, element) {
		error.insertAfter(element);
	    },
	    messages: {
		name: "What's your name?",
		message: "Type your message",
		email: {
		    required: "What's your email?",
		    email: "Please, enter a valid email"
		}
	    },
					    
	    highlight: function(element) {
		$(element)
		.text('').addClass('error')
	    },                    
					    
	    success: function(element) {
		element
		.text('').addClass('valid')
	    }
	});   




//------------------------------------------------------------------------------------
//								CONTACT FORM SCRIPT
//------------------------------------------------------------------------------------	
	
	$('#contact_form').submit(function() {
	    // submit the form
	    if($(this).valid()){
		$('#contact_submit').button('loading'); 
		var action = $(this).attr('action');
		$.ajax({
		    url: action,
		    type: 'POST',
		    data: {
			contactname: $('#contact_name').val(),
			contactemail: $('#contact_email').val(),
			contactmessage: $('#contact_message').val()
		    },
		    success: function() {
			$('#contact_submit').button('reset');
			$('#modalContact').modal('hide');
			
			//Use modal popups to display messages
			$('#modalMessage .modal-title').html('<i class="icon icon-envelope-open"></i>Well done!<br>Your message has been successfully sent!');
			$('#modalMessage').modal('show');
		    },
		    error: function() {
			$('#contact_submit').button('reset');
			$('#modalContact').modal('hide');
			
			//Use modal popups to display messages
			$('#modalMessage .modal-title').html('<i class="icon icon-ban"></i>Oops!<br>Something went wrong!');
			$('#modalMessage').modal('show');
		    }
		});
	    } else {
		$('#contact_submit').button('reset')
	    }
	    return false; 
	});
	
//------------------------------------------------------------------------------------
//						LOGIN FORM VALIDATION'S SETTINGS
//------------------------------------------------------------------------------------		  
	$('#login_form').validate({
	    onfocusout: false,
	    onkeyup: false,
	    rules: {
		email: {
		    required: true,
		    email: true
		},
		password: "required",
		
	    },
	    errorPlacement: function(error, element) {
		error.insertAfter(element);
	    },
	    messages: {
		email: {
		    required: "What's your email?",
		    email: "Please, enter a valid email"
		},
		password: "Type your password",
	    },
					    
	    highlight: function(element) {
		$(element)
		.text('').addClass('error')
	    },                    
					    
	    success: function(element) {
		element
		.text('').addClass('valid')
	    }
	});
	
//------------------------------------------------------------------------------------
//						REGISTRATION FORM VALIDATION'S SETTINGS
//------------------------------------------------------------------------------------		  
	$('#registration_form').validate({
	    onfocusout: false,
	    onkeyup: false,
	    rules: {
		email: {
		    required: true,
		    email: true
		},
		password: {
                    required: true,
                    minlength: 5
                },
		
	    },
	    errorPlacement: function(error, element) {
		error.insertAfter(element);
	    },
	    messages: {
		email: {
		    required: "What's your email?",
		    email: "Please, enter a valid email"
		},
		password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long"
                },
	    },
					    
	    highlight: function(element) {
		$(element)
		.text('').addClass('error')
	    },                    
					    
	    success: function(element) {
		element
		.text('').addClass('valid')
	    }
	});
	  
	  
//------------------------------------------------------------------------------------
//						FORGET PASSWORD FORM VALIDATION'S SETTINGS
//------------------------------------------------------------------------------------		  
	$('#forgetpassword_form').validate({
	    onfocusout: false,
	    onkeyup: false,
	    rules: {
		email: {
		    required: true,
		    email: true
		},
		
	    },
	    errorPlacement: function(error, element) {
		error.insertAfter(element);
	    },
	    messages: {
		email: {
		    required: "What's your email?",
		    email: "Please, enter a valid email"
		},
	    },
					    
	    highlight: function(element) {
		$(element)
		.text('').addClass('error')
	    },                    
					    
	    success: function(element) {
		element
		.text('').addClass('valid')
	    }
	});
	
//------------------------------------------------------------------------------------
//								FORGET PASSWORD FORM SCRIPT
//------------------------------------------------------------------------------------	
	
	$('#forgetpassword_form').submit(function() {
	    // submit the form
	    if($(this).valid()){
		$('#forgetpassword_submit').button('loading'); 
		var action = $(this).attr('action');
		$.ajax({
		    url: action,
		    type: 'POST',
		    data: {
			email: $('#forgetpassword_email').val(),
		    },
		    success: function(data) {
			if (data == "forget_mail_send")
			{
				$('#forgetpassword_submit').button('reset');
				$('#modalforgetpassword').modal('hide');
				
				//Use modal popups to display messages
				$('#modalMessage .modal-title').html('<i class="icon icon-envelope-open"></i>Well done!<br>Pelase Check your email for details!');
				$('#modalMessage').modal('show');
			}
			else if (data == "forget_mail_not_send"){
				$('#forgetpassword_submit').button('reset');
				$('#modalforgetpassword').modal('hide');
				
				//Use modal popups to display messages
				$('#modalMessage .modal-title').html('<i class="icon icon-ban"></i>Oops!<br>Something went wrong!');
				$('#modalMessage').modal('show');	
			}
			else if (data == "user_not_exist"){
				$('#forgetpassword_submit').button('reset');
				$('#modalforgetpassword').modal('hide');
				
				//Use modal popups to display messages
				$('#modalMessage .modal-title').html('<i class="icon icon-ban"></i>Oops!<br>User not exist!');
				$('#modalMessage').modal('show');	
			}
		    },
		    error: function() {
			$('#forgetpassword_submit').button('reset');
			$('#modalforgetpassword').modal('hide');
			
			//Use modal popups to display messages
			$('#modalMessage .modal-title').html('<i class="icon icon-ban"></i>Oops!<br>Something went wrong!');
			$('#modalMessage').modal('show');
		    }
		});
	    } else {
		$('#contact_submit').button('reset')
	    }
	    return false; 
	});
	
//------------------------------------------------------------------------------------
//						RESET PASSWORD FORM VALIDATION'S SETTINGS
//------------------------------------------------------------------------------------		  
	$('#resetpassword_form').validate({
	    onfocusout: false,
	    onkeyup: false,
	    rules: {
		password: {
                    required: true,
                    minlength: 5
                },
		cpassword: {
                    required: true,
                    minlength: 5,
                    equalTo: "#resetpassword_password"
                }
	    },
	    errorPlacement: function(error, element) {
		error.insertAfter(element);
	    },
	    messages: {
		password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long"
                },
		cpassword: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long",
                    equalTo: "Please enter the same password as above"
                }
	    },
					    
	    highlight: function(element) {
		$(element)
		.text('').addClass('error')
	    },                    
					    
	    success: function(element) {
		element
		.text('').addClass('valid')
	    }
	});
	
//------------------------------------------------------------------------------------
//								RESET FORM SCRIPT
//------------------------------------------------------------------------------------	
	
	$('#resetpassword_form').submit(function() {
	    // submit the form
	    if($(this).valid()){
		$('#resetpassword_submit').button('loading'); 
		var action = $(this).attr('action');
		$.ajax({
		    url: action,
		    type: 'POST',
		    data: {
			password: $('#resetpassword_password').val(),
			code: $('#forget_code').val(),
		    },
		    success: function(data) {
			
			var loc = window.location;
			var pathName = loc.pathname.substring(0, loc.pathname.lastIndexOf('/') + 1);//to get path of current url

			window.location = pathName ;
			//if (data == "password_reset_sucess")
			//{
			//	$('#resetpassword_submit').button('reset');
			//	$('#modalresetpassword').modal('hide');
			//	
			//	//Use modal popups to display messages
			//	$('#modalMessage .modal-title').html('<i class="icon icon-envelope-open"></i>Well done!<br>You have successfully changed your password. Check your email for details!');
			//	$('#modalMessage').modal('show');
			//}
			//else if (data == "password_reset_failed"){
			//	$('#resetpassword_submit').button('reset');
			//	$('#modalresetpassword').modal('hide');
			//	
			//	//Use modal popups to display messages
			//	$('#modalMessage .modal-title').html('<i class="icon icon-ban"></i>Oops!<br>Something went wrong!');
			//	$('#modalMessage').modal('show');	
			//}
			//else if (data == "wrong_link"){
			//	$('#resetpassword_submit').button('reset');
			//	$('#modalresetpassword').modal('hide');
			//	
			//	//Use modal popups to display messages
			//	$('#modalMessage .modal-title').html('<i class="icon icon-ban"></i>Oops!<br>Click on the link sent in your email address!');
			//	$('#modalMessage').modal('show');	
			//}
		    },
		    error: function() {
			$('#resetpassword_submit').button('reset');
			$('#modalresetpassword').modal('hide');
			
			//Use modal popups to display messages
			$('#modalMessage .modal-title').html('<i class="icon icon-ban"></i>Oops!<br>Something went wrong!');
			$('#modalMessage').modal('show');
		    }
		});
	    } else {
		$('#contact_submit').button('reset')
	    }
	    return false; 
	});
	  

});