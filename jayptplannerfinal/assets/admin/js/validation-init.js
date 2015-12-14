var Script = function () {

    $.validator.setDefaults({
        submitHandler: function() { this.submit(); }
    });

    $().ready(function() {
        // validate the comment form when it is submitted
        $("#commentForm").validate();

        // validate signup form on keyup and submit
        $("#myinfo").validate({
            rules: {
                first_name: "required",
                last_name: "required",
                email_addres: {
                    required: true,
                    email: true
                }
            },
            messages: {
                first_name: "Please enter your firstname",
                last_name: "Please enter your lastname",
                email_addres: "Please enter a valid email address",
                agree: "Please accept our policy"
            }
        });

	$("#chngPass").validate({
            rules: {
                npass: {
                    required: true,
                    minlength: 5
                },
                cpass: {
                    required: true,
                    minlength: 5,
                    equalTo: "#npass"
                }
            },
            messages: {
                npass: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long"
                },
                cpass: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long",
                    equalTo: "Please enter the same password as above"
                }
            }
        });

	$("#siteSettings").validate({
            rules: {
                site_name: "required",
                system_email: {
                    required: true,
                    email: true
                },
		trial_period_comA: {
		    required: true,
		    number: true,
		},
		trial_period_comB: {
		    required: true,
		    number: true,
		}
            },
            messages: {
                site_name: "Please enter your Site Name",
                system_email: "Please enter a valid System Email",
		trial_period_comA: "Please enter a valid Trial Period For Commercial User A",
		trial_period_comB: "Please enter a valid Trial Period For Commercial User B",
            }
        });

	$("#contactinfo").validate({
            rules: {
                contact_email: {
                    required: true,
                    email: true
                }
            },
            messages: {
                contact_email: "Please enter a valid Contact Email"
            }
        });

	$("#editPage").validate({
            rules: {
                page_title: "required",
                page_tag: "required",
                page_key: "required",
                page_alias: "required"
            },
            messages: {
                page_title: "Please Enter Page Title",
                page_tag: "Please Enter Meta Tag",
                page_key: "Please Enter Meta Keywords",
                page_alias: "Please Enter Alias"
            }
        });

	$("#edittrainer").validate({
            rules: {
                trainer_name: "required",
                trainer_email: {
                    required: true,
                    email: true
                },
                trainer_com: "required",
                trainer_phn: "required",
		bil_address: "required",
		work_address: "required"
		
            },
            messages: {
                trainer_name: "Please Enter Name",
                trainer_email: {
                    required: 'Please enter email',
                    email: 'Please enter proper email'
                },
                trainer_com: "Please Enter Comapny name",
                trainer_phn: "Please Enter Phone number",
		bil_address: "Please Enter Billing Address",
		work_address: "Please Enter Work Address"
            },
	     submitHandler: function(form) {
			    if (document.getElementById('u_hdn').value!='no'){
				form.submit();
			    }
			    else{
			    $("#username_error").css({ 'display': "block","color":"#b94a48;" });
			    $("#username_error").show();
			    document.getElementById("username_error").innerHTML = "This email already exists";
			    }
		     }
        }); 
	
	//country validation
	$("#addSliderForm").validate({
	    rules: {
		image_name: {
		    required: true,
		    extension: "jpeg,png,jpg",
		    //accept: "jpeg",
		}
	    },
	    messages: {
		image_name: "Please Select an image file",

	    }
	});
	
	$("#addtestimonials").validate({
	
	    // Specify the validation rules
	    rules: {
		name: "required",
		image:"required",
		short_desc: "required",
		desc:"required"   
	    },
	    messages: {
		name: "Please Enter name",
		image:"Please select an image",
		short_desc:"Please enter Short description",
		desc: "Please enter Description"
	    }
	});
	
    
	$("#edittestimonials").validate({
	
	    // Specify the validation rules
	    rules: {
		name: "required",
		short_desc: "required",
		desc:"required"
		    
	       },
	    messages: {
		name: "Please Enter name",
		short_desc:"Please enter Short description",
		desc: "Please enter Description"  
	    }
	   
	});
	
	$("#edit_user").validate({
	
	    // Specify the validation rules
	    rules: {
		name: "required",
		email: {
                    required: true,
                    email: true
                },
		address:"required",
		company:"required",
		work_address:"required",
		billing_address:"required",
		phone:
		{
		    required:true,
		    number:true	
		}   
	       },
	    messages: {
		name: "Please Enter name",
		email: {
                    required: 'Please enter email',
                    email: 'Please enter proper email'
                },
		address:"Please Enter address",
		company: "Please enter Company",
		work_address:"Please enter work address",
		billing_address:"Please Enter billing address",
		phone:
		{
		   required: "Please Enter phone no.",
		   number:"Please enter digit"
		}
	    }
	   
	});
	
	
	
	
	

    });

}();

    

     
