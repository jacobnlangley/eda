jQuery(document).ready(function($) {


	jQuery( document ).on( 'click', '#find_church_button', function() {
		searchChurches();
	});


	jQuery( document ).on( 'change', '#church_category', function() {
		searchChurches();
	});

	jQuery( document ).on( 'change', '#church_service_time', function() {
		searchChurches();
	});

	jQuery( document ).on( 'change', '#church_service_language', function() {
		searchChurches();
	});

	jQuery( document ).on( 'click', '#map_church_srch', function() {
		searchChurches();
	});

	jQuery( document ).on( 'click', '#church_srch_btn', function() {
		homeSearchChurches();
	});


});

function homeSearchChurches(){
	var church_name = jQuery('#home-church-search-bar').val();
	var church_cat = jQuery('#church_category').val();
	var church_on_map = '1';
	

	// if(church_cat != ''){

		// jQuery('#ajax_church_result').hide();
		// jQuery('.custom_loader').show();

		jQuery.ajax({
			url : get_church_call.ajax_url,
			type : 'post',
			dataType: "json",
			data : {
				action : 'get_church_list',
				church_name : church_name,
				church_cat: church_cat,
				church_on_map: church_on_map
			},
			success : function( response ) {
				console.log(response);

				// jQuery('#ajax_church_result').show();
				// jQuery('.custom_loader').hide();
				// jQuery('#ajax_church_result').html( response.content );

				initMap(response.church_data);
				// localStorage.setItem('church_data',response.church_data);
			}
		});
	// }
}

function searchChurches(){
	var church_name = jQuery('#church_search').val();
	var church_cat = jQuery('#church_category').val();
	var church_service_time = jQuery('#church_service_time').val();
	var church_service_language = jQuery('#church_service_language').val();
	var srch_lat = jQuery('#addrLat').val();
	var srch_lng = jQuery('#addrLng').val();

	// if(church_cat != ''){

		jQuery('#ajax_church_result').hide();
		jQuery('.custom_loader').show();

		jQuery.ajax({
			url : get_church_call.ajax_url,
			type : 'post',
			dataType: "json",
			data : {
				action : 'get_church_list',
				church_name : church_name,
				church_cat: church_cat,
				church_service_time: church_service_time,
				church_service_language: church_service_language,
				srch_lat: srch_lat,
				srch_lng: srch_lng
			},
			success : function( response ) {
				console.log(response);

				jQuery('#ajax_church_result').show();
				jQuery('.custom_loader').hide();
				jQuery('#ajax_church_result').html( response.content );

				initMap(response.church_data, true);
				jQuery('.chr_detail_slider_div .chr_detail_carousel').slick({
				  dots: true,
				  infinite: true,
				  speed: 1000,
				  fade: true,
				  arrow:false,
				  cssEase: 'linear'
				});
				// jQuery('.chr_detail_slider_div .chr_detail_carousel').slick('reinit');
				// localStorage.setItem('church_data',response.church_data);
			}
		});
	// }
}