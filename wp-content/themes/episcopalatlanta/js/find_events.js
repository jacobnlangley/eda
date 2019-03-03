jQuery(document).ready(function($) {


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

	// console.log($('#event_category_name').val());
	// console.log($('#event_search_term').val());
	// console.log($('#theeventdate').val());

	if($('.no_event_found').length != 0 ){
		jQuery(".no_event_found").insertAfter(".event_search_para_div");
	}

	$('#filter_event_btn').attr('disabled',true);

    $('#event_search_term').keyup(function(){
        if($(this).val().length !=0){
            $('#filter_event_btn').attr('disabled', false);            
        }else{
        	if($('#theeventdate').val().length ==0){
	            $('#filter_event_btn').attr('disabled',true);
	        }
  		}
    });

    $('#theeventdate').datepicker()
    .on('changeDate', function(e) {
    	// alert('date selected');
        // `e` here contains the extra attributes
        if($('#theeventdate').val().length !=0){
	        $('#filter_event_btn').attr('disabled', false); 
	    }
    });



    $( "#theeventdate" ).focusout(function() {
	  if($('#theeventdate').val().length !=0){
	    	$('#filter_event_btn').attr('disabled', false); 
	    }
	});


    if($('.event_search_div').length != 0){

	    if($('#event_search_term').val().length !=0 || $('#theeventdate').val().length !=0){
	    	$('#filter_event_btn').attr('disabled', false); 
	    }
	}


	jQuery( document ).on( 'click', '#filter_event_btn', function() {
		searchEvents();
	});

	jQuery( document ).on( 'click', '#filter_reset_btn', function() {
		window.location.href = 'http://eda.prosaverapp.com/calendar/';
	});


	

	jQuery( document ).on( 'change', '#event_category_name', function() {
		// searchChurches();
				var cat = $('option:selected', this).attr('event-cat-slug');

				var getUrl = window.location;
				var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[0];

				var reUrl = baseUrl+'events/category/'+cat+'/';

				//window.location.href = reUrl;
				// console.log(reUrl);
				// console.log(cat);

				if(typeof cat != 'undefined'){
					window.location.href = reUrl;
				}else if(window.location.href != "http://eda.prosaverapp.com/calendar/"){
					// console.log("redirect");
					window.location.href = "http://eda.prosaverapp.com/calendar/";
				}
	});

	jQuery( document ).on( 'change', '#theeventdate', function() {
		// searchChurches();
				var date = $(this).val();

				var getUrl = window.location;
				var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[0];

				//var reUrl = baseUrl+'events/category/'+cat+'/';

				//window.location.href = reUrl;
				// console.log(reUrl);
				console.log(date);

				// if(typeof cat != 'undefined'){
				// 	window.location.href = reUrl;
				// }
	});

	var eventDate = getUrlParameter('event_date');

	//console.log(eventDate);

	if(eventDate != 'undefined'){
		$("#theeventdate").datepicker('setDate', eventDate);
	}

	$("#theeventdate").datepicker({
	    onSelect: function(dateText, inst) {
	        var date = $(this).val();
	        // var time = $('#time').val();
	        console.log(date);
	        // $("#start").val(date + time.toString(' HH:mm').toString());

	    }
	});

	$('.event_search_enter').keypress(function (e) {
	 var key = e.which;
	 var search_term = jQuery('#event_search_term').val();
	 var search_date = jQuery('#theeventdate').val();
	 if(key == 13)  // the enter key code
	  {
	    if(search_date != '' || search_term != ''){
	    	searchEvents();
	    }
	    else{
	    	return false;  
	    }
	    
	  }
	});   


});

function re_init_calendar (start, end, timezone, callback) {
    		var options = this.options;
    		var request = {
    				start: start.format( "YYYY-MM-DD" ),
    				end: end.format( "YYYY-MM-DD" ),
    				timeformat: options.timeFormatphp,
    				users_events: 0,
    		};

    		if (typeof options.category !== "undefined" && options.category !== "") {
    			request.category = options.category;
    		}
    		if (typeof options.venue !== "undefined" && options.venue !== "") {
    			request.venue = options.venue;
    		}
    		if (typeof options.tag !== "undefined" && options.tag !== "") {
    			request.tag = options.tag;
    		}
    		if (typeof options.organiser !== "undefined" && options.organiser !== 0) {
    			request.organiser = options.organiser;
    		}
    		if (options.event_series) {
    			request.event_series = options.event_series;
    		}

    		request = wp.hooks.applyFilters( 'eventorganiser.fullcalendar_request', request, start, end, timezone, options );

    		$.ajax({
    			url: eventorganiser.ajaxurl + "?action=eventorganiser-fullcal",
    			dataType: "JSON",
    			data: request,
    			complete: function( r, status ){
    				if ( EO_SCRIPT_DEBUG ) {
    					if( status == "error" ){

    					}else if( status == "parsererror" ){
    						if( window.console ){
    							console.log( "Response is not valid JSON. This is usually caused by error notices from WordPress or other plug-ins" );
    							console.log( "Response reads: " + r.responseText );
    						}
      						alert( "An error has occurred in parsing the response. Please inspect console log for details" );
    					}
    				}
    			},
    			success: callback,
    		});
    	}

function searchEvents(){
	var event_date = jQuery('#theeventdate').val();
	var event_cat = jQuery('#event_category_name').val();
	var event_search_term = jQuery('#event_search_term').val();

	var cont_update = $('.event_calender_div .wpb_wrapper').first();

	// if(church_cat != ''){

		jQuery('#ajax_church_result').hide();
		jQuery('.custom_loader').show();

		// var currUrl = window.location.href;

				var getUrl = window.location;
				//var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];

				var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[0];

				//var reUrl = baseUrl+'?search_term='+event_search_term;

				//var reUrl = baseUrl+'search?search_term='+event_search_term;

			var queryParameters = {}, queryString = location.search.substring(1),
			    re = /([^&=]+)=([^&]*)/g, m;

			// Creates a map with the query string parameters
			while (m = re.exec(queryString)) {
			    queryParameters[decodeURIComponent(m[1])] = decodeURIComponent(m[2]);
			}

			// Add new parameters or update existing ones
			// if(event_search_term != ''){
				queryParameters['search_term'] = event_search_term;
			// }
			// if(event_date != ''){
				queryParameters['event_date'] = event_date;
			// }

			/*
			 * Replace the query portion of the URL.
			 * jQuery.param() -> create a serialized representation of an array or
			 *     object, suitable for use in a URL query string or Ajax request.
			 */
			//location.search = $.param(queryParameters);


				// console.log($.param(queryParameters));
				console.log(baseUrl+'search?'+$.param(queryParameters));
				window.location.href = baseUrl+'eventsearch?'+$.param(queryParameters);

		
}