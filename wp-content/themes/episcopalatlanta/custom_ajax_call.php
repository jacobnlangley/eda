<?php


function getDistance($latFrom, $latTo, $lngFrom, $lngTo, $unit){

		$theta = $lngFrom - $lngTo;
	    $dist = sin(deg2rad($latFrom)) * sin(deg2rad($latTo)) +  cos(deg2rad($latFrom)) * cos(deg2rad($latTo)) * cos(deg2rad($theta));
	    $dist = acos($dist);
	    $dist = rad2deg($dist);
	    $miles = $dist * 60 * 1.1515;
	    $unit = strtoupper($unit);
	    if ($unit == "K") {
	        return ($miles * 1.609344).' km';
	    } else if ($unit == "N") {
	        return ($miles * 0.8684).' nm';
	    } else {
	        return $miles;
	        // return $miles.' mi';
	    }
	}


function get_church_list() {

	$mile_radius = 7;
	// var_dump($_POST);exit();

	$search_term = $_POST['church_name'];

	$search_on_map = $_POST['church_on_map'];

	$post_type = 'church';
	$church_cat = $_POST['church_cat'];
	$chr_service_time = $_POST['church_service_time'];

	$chr_service_lang = $_POST['church_service_language'];

	$latFrom = $_POST['srch_lat'];
	$lngFrom = $_POST['srch_lng'];

	$latFrom = floatval($latFrom);
	$lngFrom = floatval($lngFrom);

	$church_data = array();


 $args = array(
    'post_type' => $post_type,
    // 's' => $search_term,
    'posts_per_page' => -1,
    'post_status' => 'publish',
    'meta_query' => array(),
    // 'orderby'     => 'title', 
    // 'order'       => 'ASC',
);

 if(!empty($search_on_map)){

 	$args['s'] = $search_term;
 }



 //var_dump($args['meta_query']);



  if($chr_service_lang){
 	$args['meta_query'][] = 
                array(
                     'key' => 'service_language',
                     'value' => $chr_service_lang,
                     'compare' => '='
                );
 }

//var_dump($args['meta_query']);
 if($chr_service_time){
 	$args['meta_query'][] = array(

 			'relation' => 'OR',
                array(
                     'key' => 'holy_eucharist_service_time_1',
                     'value' => $chr_service_time,
                     'compare' => '='
                ),

                array(
                     'key' => 'holy_eucharist_service_time_2',
                     'value' => $chr_service_time,
                     'compare' => '='
                ),

                array(
                     'key' => 'holy_eucharist_service_time_3',
                     'value' => $chr_service_time,
                     'compare' => '='
                ),

                array(
                     'key' => 'holy_eucharist_service_time_4',
                     'value' => $chr_service_time,
                     'compare' => '='
                ),

                array(
                     'key' => 'holy_eucharist_service_time_5',
                     'value' => $chr_service_time,
                     'compare' => '='
                ),
           );
 }

//var_dump($args['meta_query']);


 if($church_cat){
 	$args['tax_query'] = array(
                array(
                     'taxonomy' => 'church_tag',
                     'field' => 'term_id',
                     'terms' => $church_cat,
                )
           );
 }

$loop = new WP_Query($args);
// echo "<pre>";
// print_r($loop);
// exit();

//var_dump($loop->post_count);
if($loop->post_count != 0){

ob_start();
?>

<div class="church_result_container" id="ajax_church_result">
<div class="church_srch_result chrch_list_siblings">
            	<?php
    //         	$args = array( 'post_type' => 'church', 'posts_per_page' => 10 );
				// $loop = new WP_Query( $args );
				$i = 0;
				global $post;
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
					$distance="";
					$sh_t1 = get_post_meta($post->ID, 'holy_eucharist_service_time_1', true);
			        $sh_t2 = get_post_meta($post->ID, 'holy_eucharist_service_time_2', true);
			        $sh_t3 = get_post_meta($post->ID, 'holy_eucharist_service_time_3', true);
			        $sh_t4 = get_post_meta($post->ID, 'holy_eucharist_service_time_4', true);
			        $sh_t5 = get_post_meta($post->ID, 'holy_eucharist_service_time_5', true);
			        $plc_id = get_post_meta($post->ID, 'place_id', true);

			        $feat_img1 = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' );
		          $feat_img2 = kdmfi_get_featured_image_src( 'featured-image-2', 'full', $post->ID );
		          $feat_img3 = kdmfi_get_featured_image_src( 'featured-image-3', 'full', $post->ID );
		          $feat_img4 = kdmfi_get_featured_image_src( 'featured-image-4', 'full', $post->ID );
		          $feat_img5 = kdmfi_get_featured_image_src( 'featured-image-5', 'full', $post->ID );

					$sstime = array();
					 $featureImg = array();

			          if(!empty($sh_t1)){
			            array_push($sstime, $sh_t1);
			          }
			          if(!empty($sh_t2)){
			            array_push($sstime, $sh_t2);
			          }
			          if(!empty($sh_t3)){
			            array_push($sstime, $sh_t3);
			          }
			          if(!empty($sh_t4)){
			            array_push($sstime, $sh_t4);
			          }
			          if(!empty($sh_t5)){
			            array_push($sstime, $sh_t5);
			          }

			          if(!empty($feat_img1)){
			            array_push($featureImg, $feat_img1);
			          }
			          if(!empty($feat_img2)){
			            array_push($featureImg, $feat_img2);
			          }
			          if(!empty($feat_img3)){
			            array_push($featureImg, $feat_img3);
			          }
			          if(!empty($feat_img4)){
			            array_push($featureImg, $feat_img4);
			          }
			          if(!empty($feat_img5)){
			            array_push($featureImg, $feat_img5);
			          }





		            if((!empty($latFrom )) && (!empty($lngFrom))){

						$distance = getDistance($latFrom, $ch_lat, $lngFrom, $ch_lng, "M");

						//var_dump($distance);

							if($distance > $mile_radius){
								continue;
							}

					}

					// getDistance($latFrom, $latTo, $lngFrom, $lngTo, $unit)
					// var_dump($latFrom);
					// var_dump($lngFrom);
					// var_dump($ch_lat);
					// var_dump($ch_lng);
					

					//$distance = getDistance(33.9442935, 33.9442737, -84.2181094, -84.2881495, "M");

					$ch_adr = trim(preg_replace('/\s+/', ' ', $ch_adr));

					$termss = wp_get_post_terms($post->ID, 'church_tag');

					
					?>

				<div data-attr="<?php echo $i;?>" class="church_list_container chr_list_cont_<?php echo $i; ?>">

					<div class="church_title chtitle_<?php echo $i; ?>">
					  <a class="chr_website_link" target="_blank" href="<?php echo $ch_url;?>">
					  	<?php the_title(); ?>
					  		
					  	</a>
					</div>

					<div class="church_content ch_cont_<?php echo $i; ?>">

						<div class="chr_ri">

						<div class="church_img">
						  	<?php if(!empty($ch_img)){
						  	 the_post_thumbnail('thumbnail'); 
			                }else{
			                  ?>
			                  <img height="150" width="150" src="<?php echo get_site_url().'/wp-content/uploads/2018/03/placeholder-church.jpg';?>">
			                  <?php 
			                }
			                ?>
						</div>

						<div class="church_addr">
							<?php echo $ch_adr.'<br>'. $ch_city.', '.$ch_state.', '.$ch_zip; ?>
						</div>

					

						<div class="church_description">
						  <?php
			               echo $ch_phn;
			               //the_content();?>
						</div>

						</div>

						<div class="chr_le">
			              <a class="chr_detail_link" chr-data="<?php echo $i; ?>" data-placeid="<?php echo $plc_id; ?>" href="javascript:void(0)"><i class="fa fa-arrow-right"></i></a>
			            </div>
			            <div class="clearfloat"></div>
					</div>

				</div>
				<div class="clearfloat"></div>
				  <?php

				   // if(empty($ch_img)){
                
                 $ch_img_def = get_site_url().'/wp-content/uploads/2018/03/placeholder-church.jpg';

                // }
				  $church_data[]=[
				      'lat'=>$ch_lat,
				      'lng'=>$ch_lng,
				      'content'=>$ch_name,
				      'img'=> $ch_img_def,
				      'addr'=> $ch_adr,
				      'phn'=> $ch_phn,
				      'ch_url'=> $ch_url,
			          'ch_city'=> $ch_city,
			          'ch_state'=> $ch_state,
			          'ch_zip'=> $ch_zip,
				      'dist'=> $distance,
				      'stime'=> $sstime,
				      'plc_id'=> $plc_id,
				      'featimg'=> $featureImg
				    ];
				  $i++;
				endwhile;
				if($i<1){
					echo "No Church Found";
				}
				?>
            </div>

            <div class="church_srch_result_detail">
              <div class="chr_detail_container">
                <div class="all_church_link_cont">
                  <a class="all_chr_detail_link" href="javascript:void(0)"><i class="fa fa-arrow-left"></i></a>
                </div>
                <div class="chr_detail_title">
                  <h3>All Episcopal church</h3>
                </div>
                <div class="chr_detail_address">
                  634 W Peachtree St NW
                  Atlanta, GA 30308
                </div>
                <div class="chr_detail_phone">
                  (404) 881-0835
                </div>
                <div class="chr_detail_website">
                  <a target="_blank" href="javascript:void(0)">Website</a>
                </div>
                
              </div>

               <div class="chr_detail_slider_div">
                <div class="chr_detail_carousel">
                	
                  <!-- <div class="chr_detail_slider_cont">
                    
                      <div class="chr_img_cover">
                        <img class="chr_detail_carousel_img" src="<?php echo $ch_img;?>" />
                      </div>
                    </div> -->

                <!--   <div class="chr_detail_slider_cont">
                   
                    <img class="chr_detail_carousel_img" src="<?php //echo get_site_url().'/wp-content/uploads/2018/04/ch2.jpg';?>" />
                  </div>
                  <div class="chr_detail_slider_cont">

                    <img class="chr_detail_carousel_img" src="<?php //echo get_site_url().'/wp-content/uploads/2018/04/c2.jpg';?>" />

                  </div>

                  <div class="chr_detail_slider_cont">
                    <img class="chr_detail_carousel_img" src="<?php //echo get_site_url().'/wp-content/uploads/2018/04/c4.jpg';?>" />
                    
                  </div> -->
                </div>
              </div>

              <div class="chr_detail_divider"></div>

              <div class="service_time_ministries">
                
                <div class="stime_col stime_ministries_col">
                  <div class="stime_ministries_title">
                    Service Times
                  </div>
                  <div class="stime_content stime_ministries_content">
                    <ul></ul>
                  </div>
                </div>

                <div class="minitries_col stime_ministries_col">
                  <div class="stime_ministries_title">
                    Ministries
                  </div>
                  <div class="stime_ministries_content">
                    
                  </div>
                  
                </div>
                <div class="clearfloat"></div>
              </div>

              <div class="chr_detail_divider"></div>

              <div class="google_reviews_cont">
                <div class="google-reviews">

                  <div class="author_pic_div auth_cont">
                    <img class="author_img" src="https://lh6.googleusercontent.com/-C4_kA4lIrAg/AAAAAAAAAAI/AAAAAAAADNg/PdvWdMRT9Wk/s128-c0x00000000-cc-rp-mo/photo.jpg">
                  </div>

                  <div class="author_details auth_cont">

                    <div class="author_name_div">
                       <a target="_blank" class="auth_url_link" href="javascript:void(0)">Thomas Rector</a>
                    </div>

                    <div class="author_rating_div auth_cont">
                      <span class="fa fa-star checked"></span>
                      <span class="fa fa-star checked"></span>
                      <span class="fa fa-star checked"></span>
                      <span class="fa fa-star"></span>
                      <span class="fa fa-star"></span>
                    </div>

                    <div class="rating_time_div auth_cont">
                      a month ago
                    </div>

                    <div class="clearfloat"></div>

                    <div class="rating_comment">
                      Clean beautiful and classic.
                    </div>

                  </div>

                  <div class="clearfloat"></div>


                </div>
              </div>

            </div>
        </div>
<?php
}
else{
?>

<div class="no_result">
	<?php echo "No Church Found"; ?>
</div>

	<?php
}
$resp_content = ob_get_clean();
echo json_encode(['content'=>$resp_content, 'church_data'=>$church_data]);
//echo $resp_content;
die();
// return $wp_query;


 // $pageposts = $wpdb->get_results($querystr, OBJECT);

}
