jQuery(document).ready(function($){

	// if(typeof $ ==='undefined'){
	//   $=jQuery;
	//   // console.log("Inside here");
	//   // console.log("$ is ",$);
	// }
	if(window.innerWidth < 991){
        jQuery(".chrch_search_cont").insertBefore(".find_church_sub_head");

        jQuery(".sidebar_with_dropdown.section_mockup_resources_type .wpb_column.vc_column_container.vc_col-sm-8").insertBefore(".sidebar_with_dropdown.section_mockup_resources_type .wpb_column.vc_column_container.vc_col-sm-2");
        jQuery(".wpb_column.vc_column_container.vc_col-sm-7").insertBefore(".wpb_column.vc_column_container.vc_col-sm-3");

        jQuery(".chrch_search_cont").insertAfter(".worship_filter_locator"); 
        jQuery(".worship_loader_location").addClass("custom_loader");

        jQuery(".sidebar_with_dropdown.resourcebar .wpb_column.vc_column_container.vc_col-sm-3").insertAfter('.sidebar_with_dropdown.resourcebar .wpb_column.vc_column_container.vc_col-sm-9');
    }

    if(window.innerWidth < 767){

    	jQuery(".submit_post_frontend_form .event_submit_div").insertAfter(".submit_post_frontend_form .featured_image_div");

    }

    
    jQuery('a[href*=".pdf"]').each(function() {
	    jQuery(this).attr("target","_blank");
	});

	jQuery('a[href*="https://public.serviceu.com"]').each(function() {
	    jQuery(this).attr("target","_blank");
	});

	jQuery('a[href*="www.biblegateway.com/passage/?search"]').each(function() {
	    jQuery(this).attr("target","_blank");
	});
	
	jQuery(document).on("click",".youth-box-wrap .wpb_column",function(event){
		var currentElement = jQuery(this).index();
		// console.log( jQuery(this).index() );
		// console.log(currentElement+1);
		jQuery(".youth-box-wrap .wpb_column").removeClass("youth_active");
		// eq(jQuery(this).index()).addClass('your_new_class');
		jQuery(".youth-box-wrap .wpb_column").eq(currentElement).addClass("youth_active");
		jQuery( '#wpsisac-slick-slider-1' ).slick('slickGoTo', currentElement);
		jQuery( '#wpsisac-slick-slider-2' ).slick('slickGoTo', currentElement);
	});


	jQuery(document).on("click",".top_toggle_calendar_div a.general_top_event_title",function(e){
		e.preventDefault();
		jQuery('.calendar_toggle_btn').removeClass('top_event_title_active');
		jQuery(this).addClass("top_event_title_active");
		jQuery( '.diocese_calendar_child' ).hide();
		jQuery( '.general_event_child' ).show();
		jQuery( ".fc-month-button" ).trigger( "click" );
	});

	jQuery(document).on("click",".top_toggle_calendar_div a.dc_top_event_title",function(e){
		e.preventDefault();
		jQuery('.calendar_toggle_btn').removeClass('top_event_title_active');
		jQuery(this).addClass("top_event_title_active"); 
		jQuery( '.general_event_child' ).hide();
		jQuery( '.diocese_calendar_child' ).show();
	});


	var calenderType = getUrlParameter('id');

	if(typeof calenderType !== 'undefined' && calenderType == 'ec'){

			jQuery( ".top_toggle_calendar_div a.general_top_event_title" ).trigger( "click" );

	}else if(typeof calenderType !== 'undefined' && calenderType == 'dc'){

		if(window.location.href.indexOf("eventsearch") > -1){

			jQuery( ".top_toggle_calendar_div a.general_top_event_title" ).trigger( "click" );
		}else{

			jQuery( ".top_toggle_calendar_div a.dc_top_event_title" ).trigger( "click" );
		}
	}


	jQuery(document).on("click",".custom_slider_anchor",function(event){
		
		window.location.href = jQuery(this).attr("data-link");
		// console.log( jQuery(this).index() );
	});

	if(jQuery('.full_calender_container').length != 0){

		jQuery('.full_calender_container .my-post-nav-links a').each(function() {

			var str = jQuery(this).attr('href');

			var res = str.replace("id=dc", "id=ec");
		    jQuery(this).attr("href",res);
		});
	}

	jQuery('.common_search_btn').attr('disabled',true);

	jQuery('.main_search_enter').keyup(function(){
        if(jQuery(this).val().length !=0){
            jQuery('.common_search_btn').attr('disabled', false);            
        }else{
	        jQuery('.common_search_btn').attr('disabled',true);
  		}
    });


	if(jQuery('#wpsisac-slick-slider-1').length != 0){

		jQuery("#wpsisac-slick-slider-1").slick({
			autoplay: true,
			autoplaySpeed: 4000,
			arrows: false,
			dots: true
		});

		jQuery('#wpsisac-slick-slider-1').on('afterChange', function(event, slick, currentSlide, nextSlide){
	        // finally let's do this after changing slides
	        // console.log('after change');
	        var currentSlide = jQuery("#wpsisac-slick-slider-1").slick("slickCurrentSlide");
	        jQuery(".youth-box-wrap .wpb_column").removeClass("youth_active");
		
			jQuery(".youth-box-wrap .wpb_column").eq(currentSlide).addClass("youth_active");
	    });
	}

	if(jQuery('.inspiration_slider_div #recent-post-slider-3').length != 0){

		jQuery('.inspiration_slider_div #recent-post-slider-3').on('afterChange', function(event, slick, currentSlide, nextSlide){

			var currentSlide = jQuery(".inspiration_slider_div #recent-post-slider-3").slick("slickCurrentSlide");

				jQuery(".insp_date_div .for_faith_date_cont").removeClass("faith_active");
				jQuery(".insp_date_div .for_faith_date_cont").eq(currentSlide).addClass("faith_active");

		});
	}

	if(jQuery('#wpsisac-slick-slider-2').length != 0){

		jQuery("#wpsisac-slick-slider-2").slick({
			autoplay: true,
      autoplaySpeed: 4000,
      arrows: false,
			dots: true
		});

		jQuery('#wpsisac-slick-slider-2').on('afterChange', function(event, slick, currentSlide, nextSlide){
	        // finally let's do this after changing slides
	        // console.log('after change');
	        var currentSlide = jQuery("#wpsisac-slick-slider-2").slick("slickCurrentSlide");
	        jQuery(".youth-box-wrap .wpb_column").removeClass("youth_active");
		
			jQuery(".youth-box-wrap .wpb_column").eq(currentSlide).addClass("youth_active");
	    });
	}

    

// find search

var pgurl = window.location.href;
	// jQuery("ul.slid li").each(function(){
	//   if(jQuery(this).find('a').attr("href") == pgurl || jQuery(this).find('a').attr("href") == '' )
	//     jQuery(this).addClass("custom_active");
	// });

	 jQuery('ul.slid li a').each(function() {
	  if (this.href === pgurl) {
	   jQuery(this).addClass('custom_active');
	   jQuery(this).parents('li').addClass('custom_active current_menu_active');
	   jQuery("#episcopalatlanta_menu").on("mouseenter",function(){
	   	// jQuery(".current_menu_active").addClass("custom_active");
	   	jQuery(".current_menu_active").removeClass("custom_active");
	   });
	   jQuery("#episcopalatlanta_menu").on("mouseleave",function(){
	   	// jQuery(".current_menu_active").removeClass("custom_active");
	   	jQuery(".current_menu_active").addClass("custom_active");
	   });
	  }
	 });

	  // jQuery('#sandbox-container input').datepicker({
   //      dateFormat: 'dd-mm-yy',
   //  });


	 jQuery('#sandbox-container input').datepicker({
    autoclose: true
});

	jQuery('#sandbox-container input').on('show', function(e){
	    console.debug('show', e.date, jQuery(this).data('stickyDate'));
	    
	    if ( e.date ) {
	         jQuery(this).data('stickyDate', e.date);
	    }
	    else {
	         jQuery(this).data('stickyDate', null);
	    }
	});

	jQuery('#sandbox-container input').on('hide', function(e){
	    console.debug('hide', e.date, jQuery(this).data('stickyDate'));
	    var stickyDate = jQuery(this).data('stickyDate');
	    
	    if ( !e.date && stickyDate ) {
	        console.debug('restore stickyDate', stickyDate);
	        jQuery(this).datepicker('setDate', stickyDate);
	        jQuery(this).data('stickyDate', null);
	    }
	});

	jQuery('.paths_to_prayer_slider').slick({
	  dots: true,
	  infinite: true,
	  speed: 300,
	  slidesToShow: 4,
	  slidesToScroll: 1,
	  responsive: [
	    {
	      breakpoint: 1024,
	      settings: {
	        slidesToShow: 3,
	        slidesToScroll: 3,
	        infinite: true,
	        dots: true
	      }
	    },
	    {
	      breakpoint: 600,
	      settings: {
	        slidesToShow: 2,
	        slidesToScroll: 2
	      }
	    },
	    {
	      breakpoint: 480,
	      settings: {
	        slidesToShow: 1,
	        slidesToScroll: 1
	      }
	    }
	    // You can unslick at a given breakpoint now by adding:
	    // settings: "unslick"
	    // instead of a settings object
	  ]
	});

	jQuery('.for_faith_carousel').slick({
	  dots: true,
	  infinite: true,
	  speed: 300,
	  slidesToShow: 4,
	  slidesToScroll: 1,
	  responsive: [
	    {
	      breakpoint: 1024,
	      settings: {
	        slidesToShow: 3,
	        slidesToScroll: 3,
	        infinite: true,
	        dots: true
	      }
	    },
	    {
	      breakpoint: 600,
	      settings: {
	        slidesToShow: 2,
	        slidesToScroll: 2
	      }
	    },
	    {
	      breakpoint: 480,
	      settings: {
	        slidesToShow: 1,
	        slidesToScroll: 1
	      }
	    }
	    // You can unslick at a given breakpoint now by adding:
	    // settings: "unslick"
	    // instead of a settings object
	  ]
	});

	jQuery('.chr_detail_slider_div .chr_detail_carousel').slick({
	  dots: true,
	  infinite: true,
	  speed: 1000,
	  fade: true,
	  arrow:false,
	  cssEase: 'linear'
	});

	jQuery('.para_accedar_slider').slick({
	  dots: true,
	  infinite: true,
	  speed: 300,
	  slidesToShow: 4,
	  slidesToScroll: 1,
	  responsive: [
	    {
	      breakpoint: 1024,
	      settings: {
	        slidesToShow: 3,
	        slidesToScroll: 3,
	        infinite: true,
	        dots: true
	      }
	    },
	    {
	      breakpoint: 600,
	      settings: {
	        slidesToShow: 2,
	        slidesToScroll: 2
	      }
	    },
	    {
	      breakpoint: 480,
	      settings: {
	        slidesToShow: 1,
	        slidesToScroll: 1
	      }
	    }
	    // You can unslick at a given breakpoint now by adding:
	    // settings: "unslick"
	    // instead of a settings object
	  ]
	});

	jQuery("a#scroll").click(function(e) {
		e.preventDefault() 
	    jQuery('html, body').animate({
	        scrollTop: jQuery(".towards_scroll").offset().top
	    }, 500);
	});

	 jQuery(document).on('change', '.btn-file :file', function() {
		var input = jQuery(this),
			label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
		input.trigger('fileselect', [label]);
		});

		jQuery('.btn-file :file').on('fileselect', function(event, label) {
		    
		    var input = jQuery(this).parents('.input-group').find(':text'),
		        log = label;
		    
		    if( input.length ) {
		        input.val(log);
		    } else {
		        if( log ) alert(log);
		    }
	    
		});
		function readURL(input) {
		    if (input.files && input.files[0]) {
		        var reader = new FileReader();
		        
		        reader.onload = function (e) {
		            jQuery('#img-upload').attr('src', e.target.result);
		            jQuery('#img-upload').attr("height", '170');
					jQuery('#img-upload').attr("width", '170');
		        }
		        
		        reader.readAsDataURL(input.files[0]);
		    }
		}

		jQuery("#event_featured_img").change(function(){
		    readURL(this);
		}); 


		jQuery("#news_featured_img").change(function(){
		    readURL(this);
		}); 


	jQuery('#e_start_date').datepicker({
		    autoclose: true
		});

	jQuery('#e_start_date').on('show', function(e){
	    console.debug('show', e.date, jQuery(this).data('stickyDate'));
	    
	    if ( e.date ) {
	         jQuery(this).data('stickyDate', e.date);
	    }
	    else {
	         jQuery(this).data('stickyDate', null);
	    }
	});

	jQuery('#e_start_date').on('hide', function(e){
	    console.debug('hide', e.date, jQuery(this).data('stickyDate'));
	    var stickyDate = jQuery(this).data('stickyDate');
	    
	    if ( !e.date && stickyDate ) {
	        console.debug('restore stickyDate', stickyDate);
	        jQuery(this).datepicker('setDate', stickyDate);
	        jQuery(this).data('stickyDate', null);
	    }
	});


	jQuery('#e_end_date').datepicker({
		    autoclose: true
		});

	jQuery('#e_end_date').on('show', function(e){
	    console.debug('show', e.date, jQuery(this).data('stickyDate'));
	    
	    if ( e.date ) {
	         jQuery(this).data('stickyDate', e.date);
	    }
	    else {
	         jQuery(this).data('stickyDate', null);
	    }
	});

	jQuery('#e_end_date').on('hide', function(e){
	    console.debug('hide', e.date, jQuery(this).data('stickyDate'));
	    var stickyDate = jQuery(this).data('stickyDate');
	    
	    if ( !e.date && stickyDate ) {
	        console.debug('restore stickyDate', stickyDate);
	        jQuery(this).datepicker('setDate', stickyDate);
	        jQuery(this).data('stickyDate', null);
	    }
	});


	jQuery('#e_start_time').timepicker({defaultTime: null}).on('show.timepicker', function(e) {
	 
	});

	jQuery('#e_end_time').timepicker({defaultTime: null}).on('show.timepicker', function(e) {
	 
	});

	// jQuery('#e_end_date').on('show', function(e){
	//     console.debug('show', e.date, jQuery(this).data('stickyDate'));
	    
	//     if ( e.date ) {
	//          jQuery(this).data('stickyDate', e.date);
	//     }
	//     else {
	//          jQuery(this).data('stickyDate', null);
	//     }
	// });

	// jQuery('#e_end_date').on('hide', function(e){
	//     console.debug('hide', e.date, jQuery(this).data('stickyDate'));
	//     var stickyDate = jQuery(this).data('stickyDate');
	    
	//     if ( !e.date && stickyDate ) {
	//         console.debug('restore stickyDate', stickyDate);
	//         jQuery(this).datetimepicker('setDate', stickyDate);
	//         jQuery(this).data('stickyDate', null);
	//     }
	// });


			 var start = new Date();
			// set end date to max one year period:
			var end = new Date(new Date().setYear(start.getFullYear()+1));

			jQuery('#e_start_date').datepicker({
			    startDate : start,
			    endDate   : end
			// update "toDate" defaults whenever "fromDate" changes
			}).on('changeDate', function(){
			    // set the "toDate" start to not be later than "fromDate" ends:
			    jQuery('#e_end_date').datepicker('setStartDate', new Date(jQuery(this).val()));
			}); 

			jQuery('#e_end_date').datepicker({
			    startDate : start,
			    endDate   : end
			// update "fromDate" defaults whenever "toDate" changes
			}).on('changeDate', function(){
			    // set the "fromDate" end to not be later than "toDate" starts:
			    jQuery('#e_start_date').datepicker('setEndDate', new Date(jQuery(this).val()));
			});


			jQuery("#submit-event-form").submit(function(e) {
				// e.preventDefault();
				var title = jQuery("#event_title").val();
				var content = jQuery("#event_content").val();
				
				if(title == "") {
					e.preventDefault();
					jQuery('html, body').animate({
				        scrollTop: jQuery(".event_submit_container").offset().top
				    }, 500);

				    jQuery(".event_title_error").css('color','red');
					jQuery(".event_title_error").show().html("Please enter Event title");
					setTimeout(function(){
					 jQuery('.error_hide_msg').hide();
					}, 3000);
				} else {
					// e.preventDefault();
					jQuery(".error_hide_msg").html("").hide();
				}

			});


			jQuery("#submit-news-form").submit(function(e) {
				// e.preventDefault();
				var title = jQuery("#event_title").val();
				var content = jQuery("#event_content").val();
				
				if(title == "") {
					e.preventDefault();
					jQuery('html, body').animate({
				        scrollTop: jQuery(".event_submit_container").offset().top
				    }, 500);

				    jQuery(".event_title_error").css('color','red');
					jQuery(".event_title_error").show().html("Please enter News title");
					setTimeout(function(){
					 jQuery('.error_hide_msg').hide();
					}, 3000);
				} else {
					// e.preventDefault();
					jQuery(".error_hide_msg").html("").hide();
				}

			});

			if(jQuery('.event_submit_container .error_hide_msg').length != 0){

					setTimeout(function(){
					 jQuery('.error_hide_msg').hide();
					}, 3000);

			}


			jQuery('.sqs-video-icon').on('click', function(ev) {

				jQuery('.video_playback_result').html('');
				jQuery('.video_playback_container').show();
				jQuery('.video_playback_result').hide();
				jQuery('.sqs-video-icon').show();

				var video_src = jQuery(this).siblings('.video_playback_container').attr('video-data-html');

				jQuery(this).siblings('.video_playback_container').hide();

				jQuery(this).hide();

				jQuery(this).siblings('.video_playback_result').html(video_src);
				jQuery(this).siblings('.video_playback_result').show();

			});



			jQuery("#mc4wp-form-1").submit(function(e) {

				jQuery('.mc4wp-alert.mc4wp-success').hide();
				console.log(jQuery('.mc4wp-alert.mc4wp-success'));
				jQuery('.mc4wp-alert.mc4wp-success p').html('');

				

				var emailaddress = jQuery('#mc4wp-form-1 .btn_email').val();

				if ($.trim(emailaddress).length == 0) {
					//alert('Email is required');
					jQuery(".newsletter_custom_msg").css('color','red');
					jQuery(".newsletter_custom_msg").show().html("Email is required");
					setTimeout(function(){
					 jQuery('.newsletter_custom_msg').hide();
					 jQuery('.newsletter_custom_msg').html("");
					}, 3000);
					e.preventDefault();

				}else{

					// if(validateEmail(emailaddress)) {
					// 	alert('valid email');
					// }else{
					// 	alert('not valid email');
					// 	e.preventDefault();
					// }

					if( /(.+)@(.+){2,}\.(.+){2,}/.test(emailaddress) ){
						// alert('valid email');

					  // valid email
					} else {
						// alert('not valid email');
						jQuery(".newsletter_custom_msg").css('color','red');
						jQuery(".newsletter_custom_msg").show().html("Please include an ‘@’ in the email address");
						setTimeout(function(){
						 jQuery('.newsletter_custom_msg').hide();
						 jQuery('.newsletter_custom_msg').html("");
						}, 3000);
						e.preventDefault();
					  // invalid email
					}

				}
				

				
			});





    
});


	var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

	    for (i = 0; i < sURLVariables.length; i++) {
	        sParameterName = sURLVariables[i].split('=');

	        if (sParameterName[0] === sParam) {
	            return sParameterName[1] === undefined ? true : sParameterName[1];
	        }
	    }
	};

	// function validateEmail($email) {
	//   var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
	//   return emailReg.test( $email );
	// }

	function validateEmail(emailaddress) {
		// var filter = /^[w-.+]+@[a-zA-Z0-9.-]+.[a-zA-z0-9]{2,4}$/;
		var filter = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
		if (filter.test(emailaddress)) {
			return true;
		}
		else 
		{
			return false;
		}
	}

// window.load(function($){
// 	var pgurl = window.location.href;
// 	jQuery("ul.slid li").each(function(){
// 	  if(jQuery(this).find('a').attr("href") == pgurl || jQuery(this).find('a').attr("href") == '' )
// 	    jQuery(this).addClass("custom_active");
// 	})
// });

