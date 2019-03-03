<?php /* Template Name: SidebarTemplate */ ?>
<?php

get_header();
//echo "Home Page";
?>
<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

<?php
 if ( is_active_sidebar( 'custom-side-bar' ) ) :
 ?>
 	<div class="col-md-4">
 		<?php dynamic_sidebar( 'custom-side-bar' ); ?>
	</div>
 <?php
 endif;
?>

<?php
 if ( is_active_sidebar( 'custom-side-bar' ) ) :
 ?>
 <div class="col-md-8">
  <?php
 endif;
?>


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
if(is_front_page())
{

	// echo "front page";
	$args = array( 'post_type' => 'church', 'posts_per_page' => -1 );
	$loop = new WP_Query( $args );

	// echo "<pre>";
	// print_r($loop);
	$i = 1;
	while ( $loop->have_posts() ) : $loop->the_post();

		$ch_adr = get_post_meta($post->ID, 'church_address', true);
		$ch_lat = get_post_meta($post->ID, 'lati', true); 
		$ch_lng = get_post_meta($post->ID, 'lng', true); 
		$ch_na = get_the_title();
		$ch_img = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' ); 
		$ch_name = html_entity_decode($ch_na);

		$ch_adr = trim(preg_replace('/\s+/', ' ', $ch_adr));

		// $terms = get_the_terms( $post->ID );
		$termss = wp_get_post_terms($post->ID, 'church_category');

		//var_dump($terms);

		// echo "<pre>";
	// var_dump($termss[0]['name']);

		$church_data[]=[
			'lat'=>$ch_lat,
			'lng'=>$ch_lng,
			'content'=>$ch_name,
			'img'=> $ch_img,
			'addr'=> $ch_adr
		];

		$i++;
		endwhile;

?>
 <div id="map" style="height:400px;"></div>
<?php
 if ( is_active_sidebar( 'custom-side-bar' ) ) :
 ?>
 	</div>
  <?php
 endif;
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
            url: img, // url
            scaledSize: new google.maps.Size(40, 40), // scaled size
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
              infowindow.setContent('<div id="content" style="width: 300px;background-color:#37363a;">'+
            '<div class="input-group stylish-input-group">'+
                    '<input type="text" class="form-control" id="home-church-search-bar">'+
                    '<span class="input-group-addon">'+
                        '<button type="submit" id="church_srch_btn">'+
                            '<i class="fa fa-search"></i>'+
                        '</button>'+ 
                    '</span>'+
                '</div>'+
            '<div class="image-section">'+
            '<img src="'+chr_data[i]['img']+'" height="200" width="269">'+
            '</div>'+
            '<h4 id="firstHeading" class="firstHeading" text-color="white">'+chr_data[i]['content']+'</h4>'+
            '<div id="bodyContent">'+
            '<p>'+chr_data[i]['addr']+'</p>'+
            '</div>'+
            '</div>');
              infowindow.open(map, marker);
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
    <script type="text/javascript">
    	jQuery(document).ready(function($) { 
    		if($('#church_srch_btn').length != 0){
	    	 $('#church_srch_btn').attr('disabled',true);
			    $('#home-church-search-bar').keyup(function(){
			        if($(this).val().length !=0)
			            $('#church_srch_btn').attr('disabled', false);            
			        else
			            $('#church_srch_btn').attr('disabled',true);
			    })
			}
    	});
    </script>
<?php
}
get_footer();
?>

   