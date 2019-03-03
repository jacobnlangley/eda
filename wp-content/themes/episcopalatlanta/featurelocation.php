<?php /* Template Name: Feature Location */ ?>
<?php

get_header();
//echo "Home Page";
?>
<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <div class="entry">
            <?php the_content(); ?>
        </div><!-- entry -->
<?php endwhile; ?>
<?php endif; ?>
</main>
</div>
<?php

$args = array( 'post_type' => 'church', 'posts_per_page' => -1 );
  $loop = new WP_Query( $args );

  // echo "<pre>";
  // print_r($loop);
  $i = 1;
  while ( $loop->have_posts() ) : $loop->the_post();

    $ch_adr = get_post_meta($post->ID, 'church_address', true);
    $ch_lat = get_post_meta($post->ID, 'lati', true); 
    $ch_lng = get_post_meta($post->ID, 'lng', true); 
    $ch_phn = get_post_meta($post->ID, 'phone_number', true); 
    $ch_na = get_the_title();
    $ch_img = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' ); 
    $ch_name = html_entity_decode($ch_na);
    $ch_url = get_post_meta($post->ID, 'church_website', true);
    $ch_city = get_post_meta($post->ID, 'church_city', true); 
    $ch_state = get_post_meta($post->ID, 'church_state', true); 
    $ch_zip = get_post_meta($post->ID, 'church_zip', true); 

    $ch_adr = trim(preg_replace('/\s+/', ' ', $ch_adr));

    // $terms = get_the_terms( $post->ID );
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
<div class="row church_map_search feature_location">
  <div class="col-sm-12 church_map_div">
    <div id="map" height="400px" ></div>
    <div id="content custom_info_window" class="right_info_window" style="width: 300px;background-color:#37363a;">
            <div class="input-group stylish-input-group">
                    <input type="text" class="form-control" id="home-church-search-bar">
                    <span class="input-group-addon">
                        <button type="submit" id="church_srch_btn">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
            <div class="chrch_map_cont_div">
              <div class="image-section">
              <img class="chrch_map_img" src="<?php echo get_site_url().'/wp-content/uploads/2018/02/c2.jpg';?>" height="200" width="269">
              </div>
              <h4 id="firstHeading" class="firstHeading chrch_map_heading" text-color="white">Emmaus House Chapel</h4>
              <div id="bodyContent">
              <p class="chrch_map_addr">993 Hank Aaron Drive SW Atlanta, GA 30315</p>
              <div class="church_phn_learn_more">
              <div class="chrch_phn content_divide chrch_map_phone">404-602-5320</div>
              <div class="learn_more content_divide"><a class="chrch_redirect chrch_map_redirect" href="javascript:void(0)">Learn more</a></div>
              <div class="clear_float"></div>
              </div>
              </div>
            </div>
        </div>
  </div>
 </div>
<?php
get_footer();
?>
<script>
   var lat;
  var lng;
  var chr_dat = [];




  chr_dat = '<?php echo json_encode($church_data); ?>';


var chr_data_default = JSON.parse(chr_dat);

// console.log(chr_data_default);
  var latlong = { 
    "current":{"lati": 33.8749964, "lngi": -84.4295305 },
  }

 function initMap(chr_data=[]) {
  if(!chr_data.length){
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
          center: bound.getCenter(),
          mapTypeControlOptions: {
            mapTypeIds: ['roadmap', 'satellite', 'hybrid', 'terrain',
                    'styled_map']
          }
        });



        var infowindow = new google.maps.InfoWindow();


        var marker, i;


        for (i = 0; i < chr_data.length; i++) {
          // console.log('inside_for');
          var lat = chr_data[i]['lat'];
          var lng = chr_data[i]['lng'];
          var img = chr_data[i]['img'];
          var icon = {
            url: img,
            scaledSize: new google.maps.Size(50, 50), // scaled size
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

          google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {

              $('.chrch_map_img').attr("src",chr_data[i]['img']);
              $('.chrch_map_heading').html(chr_data[i]['content']);
              $('.chrch_map_phone').html(chr_data[i]['phn']);
              $('.chrch_map_addr').html(chr_data[i]['addr']+', '+chr_data[i]['ch_city']+', '+chr_data[i]['ch_state']+', '+chr_data[i]['ch_zip']);

              $("a.chrch_map_redirect").attr("href", chr_data[i]['ch_url']);
              // $('.right_info_window').show();
            //   infowindow.setContent('<div id="content" style="width: 300px;background-color:#37363a;">'+
            // '<div class="input-group stylish-input-group">'+
            //         '<input type="text" class="form-control" id="home-church-search-bar">'+
            //         '<span class="input-group-addon">'+
            //             '<button type="submit" id="church_srch_btn">'+
            //                 '<i class="fa fa-search"></i>'+
            //             '</button>'+ 
            //         '</span>'+
            //     '</div>'+
            // '<div class="image-section">'+
            // '<img src="'+chr_data[i]['img']+'" height="200" width="269">'+
            // '</div>'+
            // '<h4 id="firstHeading" class="firstHeading" text-color="white">'+chr_data[i]['content']+'</h4>'+
            // '<div id="bodyContent">'+
            // '<p>'+chr_data[i]['addr']+'</p>'+
            // '<div class="church_phn_learn_more">'+
            // '<div class="chrch_phn content_divide">'+chr_data[i]['phn']+'</div>'+
            // '<div class="learn_more content_divide"><a class="chrch_redirect" href="javascript:void(0)">Learn more</a></div>'+
            // '<div class="clear_float"></div>'+
            // '</div>'+
            // '</div>');
              //infowindow.open(map, marker);
              if($('#church_srch_btn').length != 0){
         $('#church_srch_btn').attr('disabled',true);
          $('#home-church-search-bar').keyup(function(){
              if($(this).val().length !=0)
                  $('#church_srch_btn').attr('disabled', false);            
              else
                  $('#church_srch_btn').attr('disabled',true);
          })
      }
            }

          })(marker, i));
        }

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

