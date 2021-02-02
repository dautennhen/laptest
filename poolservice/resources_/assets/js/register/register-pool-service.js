
function scroll_to_class(element_class, removed_height) {
	var scroll_to = $(element_class).offset().top - removed_height;
	if($(window).scrollTop() != scroll_to) {
		$('html, body').stop().animate({scrollTop: scroll_to}, 0);
	}
}

function bar_progress(progress_line_object, direction) {
	var number_of_steps = progress_line_object.data('number-of-steps');
	var now_value = progress_line_object.data('now-value');
	var new_value = 0;
	if(direction == 'right') {
		new_value = now_value + ( 100 / number_of_steps );
	}
	else if(direction == 'left') {
		new_value = now_value - ( 100 / number_of_steps );
	}
	progress_line_object.attr('style', 'width: ' + new_value + '%;').data('now-value', new_value);
}

Stripe.setPublishableKey('pk_test_S8LYhESxrcuH15YYm7gXBRyH');

function stripeResponseHandler(status, response) {
	if (response.error) {
		$('input#hdf_stripeToken').val('');
		// re-enable the submit button
		$('.submit-button').removeAttr("disabled");
		// show the errors on the form
		$(".payment-errors").html(response.error.message);
	} else {
		var form$ = $("#frmPoolSubscriber");
		// token contains id, last4, and card type
		var token = response['id'];
		// insert the token into the form so it gets submitted to the server
		$('input#hdf_stripeToken').val(token);
	}
}

function validationInputData()
{		
	var form = $( "#frmPoolSubscriber" );
	// add validate expiration date
	$.validator.addMethod(
		"ExpDate",
			function(value, element, params) {
				var minMonth = new Date().getMonth() + 1;
				var minYear = new Date().getFullYear();
				var str=$('#f1-expiration-date').val();
				var res = str.split("/");

				var $month = res[0];
				var $year = res[1];

				var month = parseInt($month, 10);
				var year = parseInt($year, 10);
				
				if ((year < minYear) || ((year === minYear) && (month < minMonth)) || (year > minYear+40)) {
					return false;
				} else {
					return true;
				}			
			}
		,"Your Expiration date is invalid.");
	form.validate({
		rules: {
			'zipcode[0]': {
				required: true,
				number: true,
				maxlength: 5
			},
			'chk_service_type[]':{
				required: true,
			},
			'chk_weekly_pool[]':{
				required: true,				
			},
			'rdo_weekly_pool':{
				required: '#chk-weekly-pool:checked',
			},
			'email':{
				required: true,
				email:true,
				maxlength: 50,
				remote: {
					headers : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
					url: "register/check-email-exists",
					type: 'POST',
					data:
					{
						email: function()
						{
							return $('#frmPoolSubscriber :input[name="email"]').val();
						}
					}
				}
			},
			'password':{
				required: true,
				minlength: 6,
				maxlength: 50
			},
			'repeat-password':{
				required: true,
				equalTo: "#password",
				minlength: 6,
				maxlength: 50
			},
			'fullname':{
				required: true,
				maxlength: 50
			},
			'company':{
				required: true,
				maxlength: 100
			},
			'street':{
				required: true,
				maxlength: 100
			},
			'city':{
				required: true,
				maxlength: 100
			},
			'state':{
				required: true
			},
			'billing_state':{
				required: '#chk_billing_address:unchecked'
			},
			'zip':{
				required: true,
				number: true,
				maxlength: 5
			},
			'phone':{
				required: true,
				number: true,
				maxlength: 15
			},
			'card_name':{
				required: true,
				
				maxlength: 50
			},
			'card_number':{
				required: true,
				creditcard: true,
				number: true,
				maxlength: 20
			},
			'stripeToken':{
				required: true,
			},
			'expiration_date':{
				required: true,
				ExpDate:true,
				maxlength: 9
			},
			'billing_address':{
				required: '#chk_billing_address:unchecked',
				maxlength: 50
			},
			'billing_city':{
				required: '#chk_billing_address:unchecked',
				maxlength: 50
			},
			'billing_zipcode':{
				required: '#chk_billing_address:unchecked',
				maxlength: 5
			}
		},
		messages: {
			'billing_zipcode':{
				required: 'Provide your zip code.'
			},	
			'street':{
				required: 'Provide address.'
			},
			'city':{
				required: 'Provide city.'
			},		
			'state':{
				required: 'Provide state.'
			},
			'billing_state':{
				required: 'Provide state.'
			},
			'zip':{
				required:'Provide your zip code.'
			},
			'phone':{
				required: 'Provide phone.'
			},
			'card_name':{
				required: 'Provide card name.'
			},
			'card_number':{
				required: 'Provide card number.'
			},
			'expiration_date':{
				required: 'Provide expiration date.'				
			},
			'billing_address':{
				required: 'Provide your address.'
			},
			'billing_city':{
				required: 'Provide your city.'
			},
			'zipcode[0]': {
				required: 'Provide your zipcode.'
			},
			'email':{
				required: "Provide your email address.",
				email: "Provide a valid email address.",
				remote: jQuery.validator.format("This email is already taken.")
			},      
			'chk_weekly_pool[]':{
				required: "You must choose at least 1 service."
			},
			'chk_service_type[]': {
				required:"Please choose at least 1 service."
			},
			'password': { 
				required: "Provide your password.", 
				rangelength: jQuery.validator.format("Enter at least {0} characters.") 
			},
			'repeat-password': { 
				required: "Repeat your password.", 
				minlength: jQuery.validator.format("Enter at least {0} characters."), 
				equalTo: "Enter the same password as above." 
			}, 
			'stripeToken': { 
				required: "Invalid number account."
			},
			'fullname':{
				required: "Provide full name."
			},
			'company':{
				required: "Provide company name."
			},
		},
		highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error');
        },
		unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
		errorPlacement: function(error, element) {
			// console.log(element.attr("name"));
			if (element.attr("name") == "chk_weekly_pool[]") {					
				error.insertAfter("#lblSpa");
			} else if(element.attr("name") == "chk_service_type[]"){
				error.insertAfter("#lblServiceType");
			} else if(element.attr("name") == "rdo_weekly_pool"){
				error.insertAfter("#error_weekly_pool");
			} else if(element.attr("name") == "stripeToken"){
				error.insertAfter("#error_token");
			}else{
				error.insertAfter(element);
			}
		}
	});	
}

function validationEmail()
{
	var form = $( "#frmEmailNotify" );
	form.validate({
		rules: {
			'not-exist-email':{
				required: true,
				email:true,
				maxlength: 50,
				remote: {
					headers : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
					url: "register/check-email-exists",
					type: 'POST',
					data:
					{
						email: function()
						{
							return $('#frmEmailNotify :input[name="not-exist-email"]').val();
						}
					}
				}
			}
		},
		messages: {
			'not-exist-email':{
				required: "Please enter your email address.",
				email: "Please enter a valid email address.",
				remote: jQuery.validator.format("This email is already existed.")
			}
		},
		highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error');
        },
		unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('has-error');
        }
	});	
}

function autoAddInput()
{
	_.templateSettings.variable = "element";
	var tpl = _.template($("#form_tpl").html());

	var counter = 1;
	$(document).on('click', '.btn-add', function(e)
    {
		var controlForm = $('.controls');
        e.preventDefault();
        var tplData = {
            i: counter
        };
        $("#controls").append(tpl(tplData));
        $('input[name="zipcode['+counter+']"]').rules("add", {
            required: true,
            number: true,
            maxlength: 5,
            messages: {
                required: "Provide your zip code."                
            },
            highlight: function(element) {
                $(element).closest('.form-group').addClass('has-error');
            },
            unhighlight: function(element) {
                $(element).closest('.form-group').removeClass('has-error');
            }
        });

        controlForm.find('.entry:not(:last) .btn-add')
            .removeClass('btn-add').addClass('btn-remove')
            .removeClass('btn-success').addClass('btn-danger')
            .html('<span class="fa fa-minus"></span>');

		counter += 1;
    }).on('click', '.btn-remove', function(e)
    {
		$(this).parents('.entry:first').remove();

		e.preventDefault();
		return false;
	});
}

$(document).ready(function() {	
	//main form validation
	validationInputData();
	// email form validation
	validationEmail();
	// auto add zipcode
	autoAddInput();
	
	$('#f1-expiration-date').payment('formatCardExpiry');

    /*Fullscreen background*/    
    $('#top-navbar-1').on('shown.bs.collapse', function(){
    	$.backstretch("resize");
    });
    $('#top-navbar-1').on('hidden.bs.collapse', function(){
    	$.backstretch("resize");
    });
    
    /*Form*/
    $('.f1 fieldset:first').fadeIn('slow');
    
    $('.f1 input[type="text"], .f1 input[type="password"], .f1 textarea').on('focus', function() {
    	$(this).removeClass('input-error');
    });
    
    // next step billing
	$('.f1 .btn-next-billing').on('click', function() {
		//load data for next tab
		$('#frmPoolSubscriber #sum_price').text("$"+$('#hdf_price').val());
		if ($('.chk-service-weely:checked').length == $('.chk-service-weely').length)
		{
			$('#frmPoolSubscriber #sum_service').text("pool: " + $('#rdo_weekly_pool').val()+ ", spa");
		}
		else
		{
			$('#frmPoolSubscriber #sum_service').text($('.chk-service-weely:checked').val());
		}

		$('#frmPoolSubscriber #sum_email').text($('#frmPoolSubscriber :input[name="email"]').val());
		$('#frmPoolSubscriber #sum_password').text($('#frmPoolSubscriber :input[name="password"]').val());
		$('#frmPoolSubscriber #sum_fullname').text($('#frmPoolSubscriber :input[name="fullname"]').val());
		$('#frmPoolSubscriber #sum_address').text($('#frmPoolSubscriber :input[name="street"]').val());

		$('#frmPoolSubscriber #sum_city_zipcode').text($('#frmPoolSubscriber :input[name="billing_city"]').val() + " " + $('#frmPoolSubscriber :input[name="zip"]').val());
		
		$('#frmPoolSubscriber #sum_billing_address').text($('#frmPoolSubscriber :input[name="billing_address"]').val());

    	var parent_fieldset = $(this).parents('fieldset');
    	// navigation steps / progress steps
    	var current_active_step = $(this).parents('.f1').find('.f1-step.active');
    	var progress_line = $(this).parents('.f1').find('.f1-progress-line');		

    	if($( "#frmPoolSubscriber" ).valid()) {
			var card_number=$('input#card_number').val();
			var expiration_date=$('input#f1-expiration-date').val();
			var ccv_number=$('input#f1-ccv-number').val();

			var card=Stripe.card.validateCardNumber(card_number);
			var day=Stripe.card.validateExpiry(expiration_date);
			var ccv=Stripe.card.validateCVC(ccv_number);

			if(card && day && ccv)
			{
				var arr = expiration_date.split('/');
				var checkStripe=Stripe.createToken({
					number:card_number,
					cvc:ccv_number,
					exp_month: parseInt(arr[0]),
					exp_year: parseInt(arr[1]),
				}, stripeResponseHandler);
			}	

    		parent_fieldset.fadeOut(400, function() {
    			// change icons
    			current_active_step.removeClass('active').addClass('activated').next().addClass('active');
    			// progress bar
    			bar_progress(progress_line, 'right');
    			// show next step
	    		$(this).next().fadeIn();
	    		// scroll window to beginning of the form
    			scroll_to_class( $('.f1'), 20 );
	    	});
    	}
	});



	// next step
    $('.f1 .btn-next').on('click', function() { 
    	if($( "#frmPoolSubscriber" ).valid()) {
			var parent_fieldset = $(this).parents('fieldset');
			// navigation steps / progress steps
			var current_active_step = $(this).parents('.f1').find('.f1-step.active');
			var progress_line = $(this).parents('.f1').find('.f1-progress-line');
    		parent_fieldset.fadeOut(400, function() {
    			// change icons
    			current_active_step.removeClass('active').addClass('activated').next().addClass('active');
    			// progress bar
    			bar_progress(progress_line, 'right');
    			// show next step
	    		$(this).next().fadeIn();
	    		// scroll window to beginning of the form
    			scroll_to_class( $('.f1'), 20 );
	    	});
    	}
    	
    });

	// next information
    $('.f1 .btn-next-info').on('click', function() { 
    	if($( "#frmPoolSubscriber" ).valid()) {
			if ($('.chk-service-weely:checked').length == $('.chk-service-weely').length)
			{
				$('#billing_money').text('$30/month.');
			}
			else
			{
				$('#billing_money').text('$25/month.');
			}
			var parent_fieldset = $(this).parents('fieldset');
			// navigation steps / progress steps
			var current_active_step = $(this).parents('.f1').find('.f1-step.active');
			var progress_line = $(this).parents('.f1').find('.f1-progress-line');
    		parent_fieldset.fadeOut(400, function() {
    			// change icons
    			current_active_step.removeClass('active').addClass('activated').next().addClass('active');
    			// progress bar
    			bar_progress(progress_line, 'right');
    			// show next step
	    		$(this).next().fadeIn();
	    		// scroll window to beginning of the form
    			scroll_to_class( $('.f1'), 20 );
	    	});
    	}    	
    });

	// next step zipcode
    $('.f1 .btn-next-zipcode').on('click', function() { 
		var parent_fieldset = $(this).parents('fieldset');
		// navigation steps / progress steps
		var current_active_step = $(this).parents('.f1').find('.f1-step.active');
		var progress_line = $(this).parents('.f1').find('.f1-progress-line');
		if($( "#frmPoolSubscriber" ).valid()) {	
			parent_fieldset.fadeOut(400, function() {
				// change icons
				current_active_step.removeClass('active').addClass('activated').next().addClass('active');
				// progress bar
				bar_progress(progress_line, 'right');
				// show next step
				$(this).next().fadeIn();
				// scroll window to beginning of the form
				scroll_to_class( $('.f1'), 20 );
			});
		}
    });

	// next step zipcode pool
    $('.f1 .btn-next-zipcode-pool').on('click', function() { 
		var parent_fieldset = $(this).parents('fieldset');
		// navigation steps / progress steps
		var current_active_step = $(this).parents('.f1').find('.f1-step.active');
		var progress_line = $(this).parents('.f1').find('.f1-progress-line');

    	if($( "#frmPoolSubscriber" ).valid()) {	
			var zipcodes= $(".zipcode-list").map(function() {
				return $(this).val();
			}).get();
			$.ajax({ cache: false,
				headers : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				url: "register/check-zipcode-exists",
				type: 'POST',
				data:
				{
					zipcode: function()
					{
						return zipcodes;
					}
				},
				success: function (data) {
					if(data==="true")
					{
						parent_fieldset.fadeOut(400, function() {
							// change icons
							current_active_step.removeClass('active').addClass('activated').next().addClass('active');
							// progress bar
							bar_progress(progress_line, 'right');
							// show next step
							$(this).next().fadeIn();
							// scroll window to beginning of the form
							scroll_to_class( $('.f1'), 20 );
						});
					}
					else
					{
						$("#zipcodeModal").modal();
					}					
				},
				error: function (ajaxContext) {
					console.log(ajaxContext.responseText);
				}
			});			
    	}    	
    });

	// next step
    $('.f1 .btn-next-weekly').on('click', function() { 		
    	if($( "#frmPoolSubscriber" ).valid()) {
			var zipcodes= $(".zipcode-list").map(function() {
				return $(this).val();
			}).get();
			$('#frmPoolSubscriber :input[name="zippool"]').val(zipcodes);
			var parent_fieldset = $(this).parents('fieldset');
			// navigation steps / progress steps
			var current_active_step = $(this).parents('.f1').find('.f1-step.active');
			var progress_line = $(this).parents('.f1').find('.f1-progress-line');
    		parent_fieldset.fadeOut(400, function() {
    			// change icons
    			current_active_step.removeClass('active').addClass('activated').next().addClass('active');
    			// progress bar
    			bar_progress(progress_line, 'right');
    			// show next step
	    		$(this).next().fadeIn();
	    		// scroll window to beginning of the form
    			scroll_to_class( $('.f1'), 20 );
	    	});
    	}    	
    });

	$('#frmPoolSubscriber .chk-service-weely').on('change', function () {
		if ($('.chk-service-weely:checked').length == $('.chk-service-weely').length)
		{
			$('#weekly_money').text('$30');
			$('#hdf_price').val('30');
		}
		else
		{
			$('#weekly_money').text('$25');
			$('#hdf_price').val('25');
		}
	});

	$('#frmPoolSubscriber input[name="chk_billing_address"]').on('change', function () {
		if($("#chk_billing_address").is(':checked'))
		{
			$("#f1-billing-street-address").val($("#street").val());
			$("#f1-billing-city").val($("#city").val());
			$("#f1-billing-zipcode").val($("#f1-zipcode").val());
			$("#billing_state").val($("#select-state").val());

			$("#f1-billing-street-address").prop('disabled', 'disabled');
			$("#f1-billing-city").prop('disabled', 'disabled');
			$("#f1-billing-zipcode").prop('disabled', 'disabled');
			$("#billing_state").prop('disabled', 'disabled');
		}			
		else
		{
			$("#f1-billing-street-address").val('');
			$("#f1-billing-city").val('');
			$("#f1-billing-zipcode").val('');
			$("#billing_state").val('');

			$("#f1-billing-street-address").prop('disabled', false);
			$("#f1-billing-city").prop('disabled', false);
			$("#f1-billing-zipcode").prop('disabled', false);
			$("#billing_state").prop('disabled', false);
		}
    });
    
    // previous step
    $('.f1 .btn-previous').on('click', function() {
    	// navigation steps / progress steps
    	var current_active_step = $(this).parents('.f1').find('.f1-step.active');
    	var progress_line = $(this).parents('.f1').find('.f1-progress-line');
    	
    	$(this).parents('fieldset').fadeOut(400, function() {
    		// change icons
    		current_active_step.removeClass('active').prev().removeClass('activated').addClass('active');
    		// progress bar
    		bar_progress(progress_line, 'left');
    		// show previous step
    		$(this).prev().fadeIn();
    		// scroll window to beginning of the form
			scroll_to_class( $('.f1'), 20 );
    	});
    });

	var frm = $('#frmPoolSubscriber');
    frm.submit(function (ev) {
        $.ajax({
			beforeSend:function() { 
				$("#divModel").css("display", "block");
			},
			complete:function() {
				$("#divModel").css("display", "none");
			},
            type: frm.attr('method'),
            url: frm.attr('action'),
            data: frm.serialize(),
			success: function(data) {
				if(data.success===true)
				{
					$("#notifyModal #get_your_email").text('You are almost done! Please check your email at (' + data.message + ') and follow the instruction to completed the sign up process');
				}
				else
				{
					$("#notifyModal #get_your_email").text(data.message);
				}
				
				$("#notifyModal").modal();
				$('#frmPoolSubscriber .btn-submit').prop('disabled', 'disabled');	
				$('#frmPoolSubscriber .btn-previous').prop('disabled', 'disabled');	
			}
        });
		
        return false;
    });
});
