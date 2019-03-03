<?php /* Template Name: FindChurchWorship */ ?>
<?php

get_header();

function custom_sort_asc_value($a, $b) {
  $a = strtolower($a);
  $b = strtolower($b);
    if ($a == $b) {
        return 0;
    }
    return ($a < $b) ? -1 : 1;
}
//echo "Home Page";
?>
<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<?php if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
			<?php endif; ?>
<!-- <h1><?php //the_title(); ?></h1>  --> 
        <div class="entry">
            <?php the_content(); ?>
        </div><!-- entry -->
<?php endwhile; ?>
<?php endif; ?>
</main>
</div>

  <?php

        // if($_REQUEST['test_time']){
        //   //var_dump($service_time1);

        //   echo "<pre>";
        //   print_r($service_time);
        //   print_r($service_language);
        // }
        $args = array( 'post_type' => 'church', 'posts_per_page' => -1 );
        $loop = new WP_Query( $args );

        // echo "<pre>";
        // print_r($loop);
        $i = 0;
        while ( $loop->have_posts() ) : $loop->the_post();

          $ch_adr = get_post_meta($post->ID, 'church_address', true);
          $ch_lat = get_post_meta($post->ID, 'lati', true); 
          $ch_url = get_post_meta($post->ID, 'church_website', true);
          $ch_city = get_post_meta($post->ID, 'church_city', true); 
          $ch_state = get_post_meta($post->ID, 'church_state', true); 
          $ch_zip = get_post_meta($post->ID, 'church_zip', true); 
          $ch_lng = get_post_meta($post->ID, 'lng', true); 
          $ch_phn = get_post_meta($post->ID, 'phone_number', true); 
          $ch_na = get_the_title();
          $ch_img = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' ); 
          $ch_name = html_entity_decode($ch_na);

          $ch_adr = trim(preg_replace('/\s+/', ' ', $ch_adr));

          // $terms = get_the_terms( $post->ID );
          //$termss = wp_get_post_terms($post->ID, 'church_category');
          $termss = wp_get_post_terms($post->ID, 'church_tag');

          //var_dump($terms);

          // echo "<pre>";
        // var_dump($termss[0]['name']);

           if(empty($ch_img)){
                
                 $ch_img = get_site_url().'/wp-content/uploads/2018/03/placeholder-church.jpg';

                }

          $church_data[]=[
            'lat'=>$ch_lat,
            'lng'=>$ch_lng,
            'content'=>$ch_name,
            'img'=> $ch_img,
            'addr'=> $ch_adr,
            'phn'=> $ch_phn,
            'ch_url'=> $ch_url,
            'ch_city'=> $ch_city,
            'ch_state'=> $ch_state,
            'ch_zip'=> $ch_zip
          ];
          
          $i++;
        endwhile;
        ?>

<div class="worship_loader_location" style="display: none; background-image: url(<?php echo get_site_url().'/wp-content/themes/episcopalatlanta/images/cust_loader.gif'?>);"></div>
<div class="row church_map_search feature_location">
  <div class="col-sm-12 church_map_div">
 <div id="map"></div>

 <div class="right_info_window">

    <div class="chrch_search_cont">
    <div id="imaginary_container">
      <div class="srch_title">Search</div> 
                <div class="input-group stylish-input-group">
                    <input type="text" class="form-control church_srh_query" id="church_search" placeholder="SEARCH LOCATION">
                    <span class="input-group-addon">
                        <button type="submit" id="find_church_button">
                            <!-- <i class="icon-search"></i> -->
                            <i class="fa fa-search"></i>
                        </button>  
                    </span>
                    <input type="hidden" id="addrLat" name="addrLat" />
          <input type="hidden" id="addrLng" name="addrLng" />  
                </div>
            </div>

            <?php

            function get_meta_values( $key = '', $type = 'post', $status = 'publish' ) {

                  global $wpdb;

                  if( empty( $key ) )
                      return;

                  $r = $wpdb->get_col( $wpdb->prepare( "
                      SELECT DISTINCT pm.meta_value FROM {$wpdb->postmeta} pm
                      LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id
                      WHERE pm.meta_key = '%s' 
                      AND p.post_status = '%s' 
                      AND p.post_type = '%s'
                  ", $key, $status, $type ) );

                  return $r;
              }

        $service_time1 = get_meta_values( 'holy_eucharist_service_time_1', 'church' );
        $service_time2 = get_meta_values( 'holy_eucharist_service_time_2', 'church' );
        $service_time3 = get_meta_values( 'holy_eucharist_service_time_3', 'church' );
        $service_time4 = get_meta_values( 'holy_eucharist_service_time_4', 'church' );
        $service_time5 = get_meta_values( 'holy_eucharist_service_time_5', 'church' );

        $service_time1 = array_map('strtolower', $service_time1);
        $service_time2 = array_map('strtolower', $service_time2);
        $service_time3 = array_map('strtolower', $service_time3);
        $service_time4 = array_map('strtolower', $service_time4);
        $service_time5 = array_map('strtolower', $service_time5);

        $service_time = array_unique(array_merge($service_time1, $service_time2, $service_time3, $service_time4, $service_time5));

        $service_language = get_meta_values( 'service_language', 'church' );
        usort($service_language,'custom_sort_asc_value');
        usort($service_time,'custom_sort_asc_value');
             ?>

            <div class="church_filter_sort">
              <div class="church_cat_div sort_filter">
                

                <?php $terms = get_terms( array(
              'taxonomy' => 'church_tag',
              'hide_empty' => false,
          ) ); 
            if($_REQUEST['stime']){
                  echo "<pre>";
                  print_r($service_time);
                }

                
          ?>  

          <select id="church_category">
                  <option value="">Filter by Category</option>
                  <?php
                  foreach ($terms as $taxonomy) {
                    // var_dump($key);
                    // var_dump($value);
                    $cat_slug = $taxonomy->slug;
                    $cat_name = $taxonomy->name;
                    $cat_count = $taxonomy->count;
                    $cat_id = $taxonomy->term_id;
                    ?>
                    <option value="<?php echo $cat_id; ?>"><?php echo $cat_name; ?></option>
                    <?php
                   } ?> 
                </select> 
              </div>
              <div class="sort_near sort_filter">
                <select id="church_service_time">
                  <option value="">Filter by Service Time</option>
                  <?php
                  foreach ($service_time as $stime) {
                    ?>
                    <option value="<?php echo $stime; ?>"><?php echo ucwords($stime); ?></option>
                    <?php
                   } ?> 
                </select> 
              </div>
              <div class="sort_near sort_filter lang_filter">
                <select id="church_service_language">
                  <option value="">Filter by Service Language</option>
                  <?php
                  foreach ($service_language as $slanguage) {
                    ?>
                    <option value="<?php echo $slanguage; ?>"><?php echo ucwords($slanguage); ?></option>
                    <?php
                   } ?> 
                </select> 
              </div>
              <div class="clearfloat"></div>
            </div>

          </div>
 <div id="content custom_info_window" style="width: 300px;background-color:#37363a;">
                <div class="chrch_map_cont_div">
                  <div class="image-section">
                  <img class="chrch_map_img" src="<?php echo get_site_url().'/wp-content/uploads/2018/02/c2.jpg';?>" height="200" width="269">
                  </div>
                  <h4 id="firstHeading" class="firstHeading chrch_map_heading" text-color="white">Emmaus House Chapel</h4>
                  <div id="bodyContent">
                  <p class="chrch_map_addr">993 Hank Aaron Drive SW Atlanta, GA 30315</p>
                  <div class="church_phn_learn_more">
                  <div class="chrch_phn content_divide chrch_map_phone">404-602-5320</div>
                  <div class="learn_more content_divide"><a target="_blank" class="chrch_redirect chrch_map_redirect" href="javascript:void(0)">Learn more</a></div>
                  <div class="clear_float"></div>
                  </div>
                  </div>
                </div>
        </div>
    </div>

            
            </div>
          </div>

<?php 
// if(is_front_page())
// {
?>
 <!-- <div id="map" style="width:1280px;height:400px;"></div> -->
<?php
//}
get_footer();
?>
<script>

 
  var chr_dat = [];

var oldCenter=0;


  chr_dat = '<?php echo json_encode($church_data); ?>';
// var markers = new Array();



var chr_data_default = JSON.parse(chr_dat);
var autocompleteId= "church_search";

// var markers = [];

// console.log(chr_data_default);
  var latlong = { 
    "current":{"lati": 33.8749964, "lngi": -84.4295305 },
  }

 function initMap(chr_data=[],allowBlank) {
    var lat;
  var lng;  
  lat = $('#addrLat').val();
  lng = $('#addrLng').val();
  allowBlank = allowBlank || false;
  console.log(oldCenter);
  var markers = [];
  // alert(lat+' '+lng);
 // var markers = new Array();

  if(!chr_data.length && !allowBlank){

    chr_data= chr_data_default;
  }

        console.log(chr_data);
        // Create a new StyledMapType object, passing it an array of styles,
        // and the name to be displayed on the map type control.
        var styledMapType = new google.maps.StyledMapType(
            [
  {
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#f5f5f5"
      }
    ]
  },
  {
    "elementType": "labels.icon",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#616161"
      }
    ]
  },
  {
    "elementType": "labels.text.stroke",
    "stylers": [
      {
        "color": "#f5f5f5"
      }
    ]
  },
  {
    "featureType": "administrative.land_parcel",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#bdbdbd"
      }
    ]
  },
  {
    "featureType": "poi",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#eeeeee"
      }
    ]
  },
  {
    "featureType": "poi",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#757575"
      }
    ]
  },
  {
    "featureType": "poi.park",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#e5e5e5"
      }
    ]
  },
  {
    "featureType": "poi.park",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#9e9e9e"
      }
    ]
  },
  {
    "featureType": "road",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#ffffff"
      }
    ]
  },
  {
    "featureType": "road.arterial",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#757575"
      }
    ]
  },
  {
    "featureType": "road.highway",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#dadada"
      }
    ]
  },
  {
    "featureType": "road.highway",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#616161"
      }
    ]
  },
  {
    "featureType": "road.local",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#9e9e9e"
      }
    ]
  },
  {
    "featureType": "transit.line",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#e5e5e5"
      }
    ]
  },
  {
    "featureType": "transit.station",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#eeeeee"
      }
    ]
  },
  {
    "featureType": "water",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#c9c9c9"
      }
    ]
  },
  {
    "featureType": "water",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#9e9e9e"
      }
    ]
  }
],
            {name: 'Styled Map'});


         var input = document.getElementById(autocompleteId),
          headerInput = document.getElementById('all_cities');
      if ($("#"+autocompleteId).length) {
          var autocomplete = new google.maps.places.Autocomplete(input);
          autocomplete.addListener('place_changed', function() {
                  var place = autocomplete.getPlace(),
                      stateFound = false,
                      cityFound = false,
                      zipcodeFound = true,
                      countryFound = false;
                      console.log(place);
                      document.getElementById('addrLat').value = place.geometry.location.lat();
                  document.getElementById('addrLng').value = place.geometry.location.lng();
                  searchChurches();
              });

          };


        var bound = new google.maps.LatLngBounds();


    for (i = 0; i < chr_data.length; i++) {
      var lat = chr_data[i]['lat'];
        var lng = chr_data[i]['lng'];
      bound.extend( new google.maps.LatLng(parseFloat(lat) ,parseFloat(lng)));

      // OTHER CODE
    }


    //console.log( bound.getCenter() )

        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 9,
          scrollwheel: false,
          center: bound.getCenter(),
          fullscreenControl: false,
          mapTypeControlOptions: {
            mapTypeIds: ['roadmap', 'satellite', 'hybrid', 'terrain',
                    'styled_map']
          }
        });

        if(chr_data.length==0){
          map.setCenter(oldCenter);
        }
        else{
          oldCenter = map.getCenter();
        }

        var infowindow = new google.maps.InfoWindow();


        var marker, i;


        for (i = 0; i < chr_data.length; i++) {
          // console.log('inside_for');
          var lat = chr_data[i]['lat'];
          var lng = chr_data[i]['lng'];
          var img = chr_data[i]['img'];
          var icon = {
            url: '<?php echo get_site_url()."/wp-content/uploads/2018/03/EDA_Map_Marker_general.png";?>',
            scaledSize: new google.maps.Size(35, 35), // scaled size
            origin: new google.maps.Point(0,0), // origin
            anchor: new google.maps.Point(0, 0) // anchor
        };
                  
          // console.log("HERE with "+lat+" : "+lng+" : ");
          marker = new google.maps.Marker({
            position: new google.maps.LatLng(parseFloat(lat) ,parseFloat(lng)),
            map: map,
            icon: icon,
            animation: google.maps.Animation.DROP,
          });

          var selectIcon = {
            url: '<?php echo get_site_url()."/wp-content/uploads/2018/03/EDA_Map_Marker_active.png";?>',
            scaledSize: new google.maps.Size(35, 35), // scaled size
            origin: new google.maps.Point(0,0), // origin
            anchor: new google.maps.Point(0, 0) // anchor
          }

          google.maps.event.addListener(marker, 'click', (function(marker, i) {
               
            return function() {

              if(window.innerWidth < 991){
                    infowindow.setContent(
                  '<div id="content" style="width: 240px;background-color:#37363a;">'+
                  '<div class="image-section">'+
                  '<img src="'+chr_data[i]['img']+'" height="200" width="269">'+
                  '</div>'+
                  '<h4 id="firstHeading" class="firstHeading" text-color="white">'+chr_data[i]['content']+'</h4>'+
                  '<div id="bodyContent">'+
                  '<p>'+chr_data[i]['addr']+', '+chr_data[i]['ch_city']+', '+chr_data[i]['ch_state']+', '+chr_data[i]['ch_zip']+'</p>'+
                  '<div class="church_phn_learn_more">'+
                  '<div class="chrch_phn content_divide">'+chr_data[i]['phn']+'</div>'+
                  '<div class="learn_more content_divide"><a target="_blank" class="chrch_redirect" href="'+chr_data[i]['ch_url']+'">Learn more</a></div>'+
                  '<div class="clear_float"></div>'+
                  '</div>'+
                  '</div>'
                  );
              }

            $('.chrch_map_img').attr("src",chr_data[i]['img']);
              $('.chrch_map_heading').html(chr_data[i]['content']);
              $('.chrch_map_phone').html(chr_data[i]['phn']);
              $('.chrch_map_addr').html(chr_data[i]['addr']+', '+chr_data[i]['ch_city']+', '+chr_data[i]['ch_state']+', '+chr_data[i]['ch_zip']);

              $("a.chrch_map_redirect").attr("href", chr_data[i]['ch_url']);

              for (var j = 0; j < markers.length; j++) {
                    markers[j].setIcon(icon);
                }


              if(window.innerWidth < 991){
                infowindow.open(map, marker);
              }
              marker.setIcon(selectIcon);
            }

          })(marker, i));

          // google.maps.event.addListener(infowindow,'closeclick',function(){
          //    marker.setIcon(icon);
          // });
          markers.push(marker);

         // markers.forEach(function(marker) {
         //     // marker.infowindow.close(map, marker);
         //     marker.setIcon(icon);
         //  }); 

           google.maps.event.addListener(infowindow,'closeclick',function(){
             for (var j = 0; j < markers.length; j++) {
                    markers[j].setIcon(icon);
                }
          });
        }

        // google.maps.event.addListener( map,'click', function () {
        //     infowindow.close();

        //     //Change the marker icon
        //     marker.setIcon(icon);
        // });



        // console.log(markers);

      $('.church_list_container').on('click', function(e){

        var myClass = $(this).attr("class");
        // console.log(e.target);
        if($(e.target).attr('class') != 'chr_website_link'){
            google.maps.event.trigger(markers[$(this).attr('data-attr')], 'click');
        }
        
      });

        //  marker.addListener('click', function() {
        //   infowindow.open(map, marker);
        // });

        //Associate the styled map with the MapTypeId and set it to display.
        map.mapTypes.set('styled_map', styledMapType);
        map.setMapTypeId('styled_map');
      
      }

    </script>
     <script async defer
    src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyCxFgdIx2m0eu8MBKRY68X7eUrSqkemHKc&callback=initMap">
    </script>
    <script type="text/javascript">
    	jQuery(document).ready(function($) { 
	    	 $('#find_church_button').attr('disabled',true);
			    $('#church_search').keyup(function(){
			        if($(this).val().length !=0){
			            $('#find_church_button').attr('disabled', false);            
			        }else{
			            //$('#find_church_button').attr('disabled',true);
              }
			    });

          // $('#church_search').keyup(function(){
          //   $('#church_search').bind("keyup keypress", function(e) {
          //     var code = e.keyCode || e.which;
          //     if($(this).val().length !=0)
          //         $('#find_church_button').attr('disabled', false);  
          //         if (code  == 13) {  
          //           searchChurches();
          //         }          
          //     else
          //         $('#find_church_button').attr('disabled',true);
          //         if (code  == 13) {   
          //           e.preventDefault();
          //           return false;
          //         }
          // })

          $('#church_search').keydown(function(e){
              if (e.keyCode == 13) {
                if($(this).val().length !=0){

                    searchChurches();

                }else{

                  e.preventDefault();
                  return false;

                }
              }
          });


          $(document).on('focusin', '#church_search', function(){
              console.log("Saving value " + $(this).val());
              $(this).data('val', $(this).val());
          }).on('change','#church_search', function(){
              var prev = $(this).data('val');
              var current = $(this).val();
              console.log("Prev value " + prev);
              console.log("New value " + current);
              if(prev!=current){
                console.log("different input");
                $('#addrLat').val('');
                $('#addrLng').val('');
              }
          });


          // $('#church_search').on('change', function(){
          //     if ($("#institute_signup_form").length > 0){
          //             $('#addrLat').val('');
          //             $('#addrLng').val('');
          //       }
          //       window.location='./login.html';
          //   });

                 
    	});
    </script>

