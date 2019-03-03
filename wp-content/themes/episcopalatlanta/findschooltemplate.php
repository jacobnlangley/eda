<?php /* Template Name: Find School Template */ ?>
<?php get_header(); ?>
<?php
function custom_sort_asc_value($a, $b)
{
    $a = strtolower($a);
    $b = strtolower($b);
    if ($a == $b) {
        return 0;
    }
    return ($a < $b) ? -1 : 1;
}

//echo "Find School Template";
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
<div class="row church_map_search find_church_map">
    <div class="col-sm-8 church_map_div">
        <div id="map"></div>
    </div>
    <div class="col-sm-4 church_search_div">
        <div class="chrch_search_cont chrch_list_siblings">
            <div id="imaginary_container">
                <div class="srch_title">Search</div>
                <div class="input-group schurch_params stylish-input-group">
                    <input type="text" class="form-control church_srh_query" placeholder="Name, City, zip, etc."
                           id="church_search">
                    <span class="input-group-addon">
                        <button type="submit" id="find_church_button">
                            <!-- <i class="icon-search"></i> -->
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                    <input type="hidden" id="addrLat" name="addrLat"/>
                    <input type="hidden" id="addrLng" name="addrLng"/>
                </div>

                <div class="or_nearby schurch_params">
                    <span class="orspan">OR</span>
                    <a href="javascript:void(0)" class="near_me_btn">NEAR ME</a>
                </div>
                <div class="clearfloat"></div>
            </div>

            <?php

            function get_meta_values($key = '', $type = 'post', $status = 'publish')
            {

                global $wpdb;

                if (empty($key))
                    return;

                $r = $wpdb->get_col($wpdb->prepare("
                      SELECT DISTINCT pm.meta_value FROM {$wpdb->postmeta} pm
                      LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id
                      WHERE pm.meta_key = '%s' 
                      AND p.post_status = '%s' 
                      AND p.post_type = '%s'
                  ", $key, $status, $type));

                return $r;
            }

            $service_time1 = get_meta_values('holy_eucharist_service_time_1', 'church');
            $service_time2 = get_meta_values('holy_eucharist_service_time_2', 'church');
            $service_time3 = get_meta_values('holy_eucharist_service_time_3', 'church');
            $service_time4 = get_meta_values('holy_eucharist_service_time_4', 'church');
            $service_time5 = get_meta_values('holy_eucharist_service_time_5', 'church');

            $service_time1 = array_map('strtolower', $service_time1);
            $service_time2 = array_map('strtolower', $service_time2);
            $service_time3 = array_map('strtolower', $service_time3);
            $service_time4 = array_map('strtolower', $service_time4);
            $service_time5 = array_map('strtolower', $service_time5);

            $service_time = array_unique(array_merge($service_time1, $service_time2, $service_time3, $service_time4, $service_time5));

            $service_language = get_meta_values('service_language', 'church');
            usort($service_language, 'custom_sort_asc_value');
            usort($service_time, 'custom_sort_asc_value');
            ?>

            <!--  <div class="church_filter_sort">
                <div class="church_cat_div sort_filter">


                    <?php $terms = get_terms(array(
                'taxonomy' => 'church_tag',
                'hide_empty' => false,
            ));


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
            </div> -->

        </div>

        <div class="church_search_divider chrch_list_siblings"></div>

        <div class="church_result_title chrch_list_siblings">
            Search Results
        </div>

        <div class="custom_loader"
             style="display: none; background-image: url(<?php echo get_site_url() . '/wp-content/themes/episcopalatlanta/images/cust_loader.gif' ?>);"></div>

        <div class="church_result_container" id="ajax_church_result">

            <div class="church_srch_result chrch_list_siblings">
                <?php

                // if($_REQUEST['test_time']){
                //   //var_dump($service_time1);

                //   echo "<pre>";
                //   print_r($service_time);
                //   print_r($service_language);
                // }
                $args = array('post_type' => 'schools', 'posts_per_page' => -1);
                $loop = new WP_Query($args);

                // echo "<pre>";
                // print_r($loop);
                $i = 0;
                while ($loop->have_posts()) : $loop->the_post();

                    $ch_adr = get_post_meta($post->ID, 'sch_address', true);
                    $ch_lat = get_post_meta($post->ID, 'lat', true);
                    $ch_url = get_post_meta($post->ID, 'sch_website', true);
                    $ch_city = get_post_meta($post->ID, 'sch_city', true);
                    $ch_state = get_post_meta($post->ID, 'sch_state', true);
                    $ch_zip = get_post_meta($post->ID, 'sch_zip', true);
                    $ch_lng = get_post_meta($post->ID, 'lng', true);
                    $ch_phn = get_post_meta($post->ID, 'sch_phone', true);
                    $ch_descrip = get_post_meta($post->ID, 'sch_descrip', true);
                    $sch_social_1 = get_post_meta($post->ID, 'sch_social_1', true);
                    $sch_social_1_url = get_post_meta($post->ID, 'sch_social_1_url', true);
                    $sch_social_2 = get_post_meta($post->ID, 'sch_social_2', true);
                    $sch_social_2_url = get_post_meta($post->ID, 'sch_social_2_url', true);
                    $sch_social_3 = get_post_meta($post->ID, 'sch_social_3', true);
                    $sch_social_3_url = get_post_meta($post->ID, 'sch_social_3_url', true);
                    $sch_grades_served = get_post_meta($post->ID, 'sch_grades_served', true);
                    $sch_life_1 = get_post_meta($post->ID, 'sch_life_1', true);
                    $sch_life_1_url = get_post_meta($post->ID, 'sch_life_1_url', true);
                    $sch_life_2 = get_post_meta($post->ID, 'sch_life_2', true);
                    $sch_life_2_url = get_post_meta($post->ID, 'sch_life_2_url', true);
                    $sch_life_3 = get_post_meta($post->ID, 'sch_life_3', true);
                    $sch_life_3_url = get_post_meta($post->ID, 'sch_life_3_url', true);
                    $sch_life_4 = get_post_meta($post->ID, 'sch_life_4', true);
                    $sch_life_4_url = get_post_meta($post->ID, 'sch_life_4_url', true);
                    $sh_t1 = get_post_meta($post->ID, 'holy_eucharist_service_time_1', true);
                    $sh_t2 = get_post_meta($post->ID, 'holy_eucharist_service_time_2', true);
                    $sh_t3 = get_post_meta($post->ID, 'holy_eucharist_service_time_3', true);
                    $sh_t4 = get_post_meta($post->ID, 'holy_eucharist_service_time_4', true);
                    $sh_t5 = get_post_meta($post->ID, 'holy_eucharist_service_time_5', true);
                    $plc_id = get_post_meta($post->ID, 'place_id', true);
                    $ch_na = get_the_title();
                    $ch_img = wp_get_attachment_url(get_post_thumbnail_id($post->ID), 'thumbnail');
                    $ch_name = html_entity_decode($ch_na);


                    $feat_img1 = wp_get_attachment_url(get_post_thumbnail_id($post->ID), 'thumbnail');
                    $feat_img2 = kdmfi_get_featured_image_src('featured-image-2', 'full', $post->ID);
                    $feat_img3 = kdmfi_get_featured_image_src('featured-image-3', 'full', $post->ID);
                    $feat_img4 = kdmfi_get_featured_image_src('featured-image-4', 'full', $post->ID);
                    $feat_img5 = kdmfi_get_featured_image_src('featured-image-5', 'full', $post->ID);


                    $ch_adr = trim(preg_replace('/\s+/', ' ', $ch_adr));

                    // $terms = get_the_terms( $post->ID );
                    //$termss = wp_get_post_terms($post->ID, 'church_category');
                    $termss = wp_get_post_terms($post->ID, 'church_tag');

                    $sstime = array();
                    $featureImg = array();

                    if (!empty($sh_t1)) {
                        array_push($sstime, $sh_t1);
                    }
                    if (!empty($sh_t2)) {
                        array_push($sstime, $sh_t2);
                    }
                    if (!empty($sh_t3)) {
                        array_push($sstime, $sh_t3);
                    }
                    if (!empty($sh_t4)) {
                        array_push($sstime, $sh_t4);
                    }
                    if (!empty($sh_t5)) {
                        array_push($sstime, $sh_t5);
                    }


                    if (!empty($feat_img1)) {
                        array_push($featureImg, $feat_img1);
                    }
                    if (!empty($feat_img2)) {
                        array_push($featureImg, $feat_img2);
                    }
                    if (!empty($feat_img3)) {
                        array_push($featureImg, $feat_img3);
                    }
                    if (!empty($feat_img4)) {
                        array_push($featureImg, $feat_img4);
                    }
                    if (!empty($feat_img5)) {
                        array_push($featureImg, $feat_img5);
                    }


                    // echo "<pre>";
                    // print_r($sstime);


                    // usort($sstime,'custom_sort_asc_value');
                    // echo "<br><pre>";
                    //   print_r($sstime);
                    //var_dump($terms);

                    // echo "<pre>";
                    // var_dump($termss[0]['name']);


                    ?>

                    <div data-attr="<?php echo $i; ?>" class="church_list_container chr_list_cont_<?php echo $i; ?>">

                        <div class="church_title chtitle_<?php echo $i; ?>">
                            <div class="chr_website_link" href="javascript:void(0)">
                                <?php the_title(); ?>
                            </div>
                        </div>

                        <div class="church_content ch_cont_<?php echo $i; ?>">
                            <div class="chr_ri">

                                <div class="church_img">

                                    <?php if (!empty($ch_img)) {
                                        the_post_thumbnail('thumbnail');
                                    } else {
                                        ?>
                                        <img height="150" width="150"
                                             src="<?php echo get_site_url() . '/wp-content/uploads/2018/03/placeholder-church.jpg'; ?>">
                                        <?php
                                    }
                                    ?>
                                </div>

                                <div class="church_addr">
                                    <?php echo $ch_adr . '<br>' . $ch_city . ', ' . $ch_state . ', ' . $ch_zip; ?>
                                </div>

                                <!-- <div class="chr_cat">

                            <?php
                                foreach ($termss as $cat_chr) {
                                    ?>
                                <span><?php //echo $cat_chr->name;?></span>

                                <?php
                                }
                                ?>
                        </div> -->

                                <div class="church_description">
                                    <?php
                                    echo $ch_phn;
                                    //the_content();?>
                                </div>

                            </div>
                            <div class="chr_le">
                                <!-- <i class="fa fa-ellipsis-v" aria-hidden="true"></i> -->
                                <a class="chr_detail_link" chr-data="<?php echo $i; ?>"
                                   data-placeid="<?php echo $plc_id; ?>" href="javascript:void(0)"><i
                                            class="fa fa-arrow-right"></i></a>
                            </div>
                            <div class="clearfloat"></div>

                        </div>

                    </div>
                    <div class="clearfloat"></div>
                    <?php
                    // if(empty($ch_img)){

                    $ch_img_def = get_site_url() . '/wp-content/uploads/2018/03/placeholder-church.jpg';

                    // }

                    $church_data[] = [
                        'lat' => $ch_lat,
                        'lng' => $ch_lng,
                        'content' => $ch_name,
                        'img' => $ch_img_def,
                        'addr' => $ch_adr,
                        'phn' => $ch_phn,
                        'ch_url' => $ch_url,
                        'ch_city' => $ch_city,
                        'ch_state' => $ch_state,
                        'ch_zip' => $ch_zip,
                        'stime' => $sstime,
                        'plc_id' => $plc_id,
                        'featimg' => $featureImg,
                        'sch_descrip' => $ch_descrip,
                        'sch_social_1' => $sch_social_1,
                        'sch_social_1_url' => $sch_social_1_url,
                        'sch_social_2' => $sch_social_2,
                        'sch_social_2_url' => $sch_social_2_url,
                        'sch_social_3' => $sch_social_3,
                        'sch_social_3_url' => $sch_social_3_url,
                        'sch_grades_served'=> $sch_grades_served,
                        'sch_life_1' => $sch_life_1,
                        'sch_life_1_url' => $sch_life_1_url,
                        'sch_life_2' => $sch_life_2,
                        'sch_life_2_url' => $sch_life_2_url,
                        'sch_life_3' => $sch_life_3,
                        'sch_life_3_url' => $sch_life_3_url,
                        'sch_life_4' => $sch_life_4,
                        'sch_life_4_url' => $sch_life_4_url,
                        // 'stime2'=> $sh_t2,
                        // 'stime3'=> $sh_t3,
                        // 'stime4'=> $sh_t4,
                        // 'stime5'=> $sh_t5,
                    ];

                    $i++;
                endwhile;
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
                        <i class="fa fa-phone"></i>:
                        <a href="javascript:void(0)">(404) 881-0835</a>
                    </div>
                    <div class="chr_detail_website">
                        <i class="fa fa-link"></i>:
                        <a target="_blank" href="javascript:void(0)"> Website</a>
                    </div>
                    <div class="chr_detail_social">
                        <a target="_blank" href="javascript:void(0)">
                            <i class="fa fa-facebook"></i>
                        </a>
                        <a target="_blank" href="javascript:void(0)">
                            <i class="fa fa-facebook"></i>
                        </a>
                        <a target="_blank" href="javascript:void(0)">
                            <i class="fa fa-facebook"></i>
                        </a>
                    </div>
                    <div class="chr_descrip">
                        <h6>About Saint Bart's</h6>
                        <p></p>
                    </div>
                </div>

<!--                <div class="chr_detail_slider_div">-->
<!--                    <div class="chr_detail_carousel">-->
<!--                        <div class="chr_detail_slider_cont">-->
<!--                      <div class="chr_img_cover">-->
<!--                        <img class="chr_detail_carousel_img" src="--><?php ////echo get_site_url().'/wp-content/uploads/2018/04/ch2.jpg';?><!--" />-->
<!--                      </div>-->
<!--                    </div>-->
<!---->
<!--                        <div class="chr_detail_slider_cont">-->
<!--                      <div class="chr_img_cover">-->
<!--                        <img class="chr_detail_carousel_img" src="--><?php //echo get_site_url().'/wp-content/uploads/2018/04/c4.jpg';?><!--" />-->
<!--                      </div>-->
<!--                    </div>-->
<!---->
<!--                        <div class="chr_detail_slider_cont">-->
<!---->
<!--                    <img class="chr_detail_carousel_img" src="--><?php //echo get_site_url().'/wp-content/uploads/2018/04/ch2.jpg';?><!--" />-->
<!--                  </div>-->
<!--                  <div class="chr_detail_slider_cont">-->
<!---->
<!--                    <img class="chr_detail_carousel_img" src="--><?php //echo get_site_url().'/wp-content/uploads/2018/04/c2.jpg';?><!--" />-->
<!---->
<!--                  </div>-->
<!---->
<!--                  <div class="chr_detail_slider_cont">-->
<!--                    <img class="chr_detail_carousel_img" src="--><?php //echo get_site_url().'/wp-content/uploads/2018/04/c4.jpg';?><!--" />-->
<!---->
<!--                  </div>-->
<!--                    </div>-->
<!--                </div>-->

                <div class="chr_detail_divider"></div>

                <div class="service_time_ministries">

                    <div class="stime_col stime_ministries_col">
                        <div class="stime_ministries_title">
                            Grades Served
                        </div>
                        <div class="stime_content stime_ministries_content">
                            <ul>
                                <li></li>
                            </ul>
                        </div>
                    </div>

                    <div class="minitries_col stime_ministries_col">
                        <div class="stime_ministries_title">
                            Student Life
                        </div>
                        <div class="stime_ministries_content">
                            <ul>
                                <li>
                                    <a href="#" target="_blank">Choir</a>
                                    <i class="fa fa-arrow-circle-right"></i>
                                </li>
                                <li>
                                    <a href="#" target="_blank">Choir</a>
                                    <i class="fa fa-arrow-circle-right"></i>
                                </li>
                                <li>
                                    <a href="#" target="_blank">Choir</a>
                                    <i class="fa fa-arrow-circle-right"></i>
                                </li>
                                <li>
                                    <a href="#" target="_blank">Choir</a>
                                    <i class="fa fa-arrow-circle-right"></i>
                                </li>
                                <li>
                                    <a href="#" target="_blank">Choir</a>
                                    <i class="fa fa-arrow-circle-right"></i>
                                </li>
                            </ul>
                        </div>

                    </div>
                    <div class="clearfloat"></div>
                </div>

                <div class="chr_detail_divider"></div>

<!--                <div class="google_reviews_cont" style="display:none">-->
<!--                    <div class="google-reviews">-->
<!---->
<!--                        <div class="author_pic_div auth_cont">-->
<!--                            <img class="author_img"-->
<!--                                 src="https://lh6.googleusercontent.com/-C4_kA4lIrAg/AAAAAAAAAAI/AAAAAAAADNg/PdvWdMRT9Wk/s128-c0x00000000-cc-rp-mo/photo.jpg">-->
<!--                        </div>-->
<!--                        <div class="author_details auth_cont">-->
<!--                            <div class="author_name_div">-->
<!--                                Thomas Rector-->
<!--                            </div>-->
<!--                            <div class="author_rating_div auth_cont">-->
<!--                                <span class="fa fa-star checked"></span>-->
<!--                                <span class="fa fa-star checked"></span>-->
<!--                                <span class="fa fa-star checked"></span>-->
<!--                                <span class="fa fa-star"></span>-->
<!--                                <span class="fa fa-star"></span>-->
<!--                            </div>-->
<!--                            <div class="rating_time_div auth_cont">-->
<!--                                a month ago-->
<!--                            </div>-->
<!--                            <div class="clearfloat"></div>-->
<!--                            <div class="rating_comment">-->
<!--                                Clean beautiful and classic.-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="clearfloat"></div>-->
<!--                    </div>-->
<!--                </div>-->
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>

<script>
  var chr_dat = [];
  var placeIdArray = [];
  // var church_details = {};

  var oldCenter = 0;


  chr_dat = '<?php echo json_encode($church_data); ?>';
  // var markers = new Array();


  var chr_data_default = JSON.parse(chr_dat);
  var autocompleteId = "church_search";

  // var markers = [];

  // console.log(chr_data_default);
  var latlong = {
    "current": {"lati": 33.8749964, "lngi": -84.4295305},
  }
  var church_details = [];

  function initMap(chr_data=[], allowBlank) {
    var lat;
    var lng;
    lat = jQuery('#addrLat').val();
    lng = jQuery('#addrLng').val();
    allowBlank = allowBlank || false;
    // console.log(oldCenter);
    var markers = [];
    church_details = [];
    // alert(lat+' '+lng);
    // var markers = new Array();

    if (!chr_data.length && !allowBlank) {

      chr_data = chr_data_default;
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
    if (jQuery("#" + autocompleteId).length) {
      var autocomplete = new google.maps.places.Autocomplete(input);
      autocomplete.addListener('place_changed', function () {
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

    }
    ;


    var bound = new google.maps.LatLngBounds();


    for (i = 0; i < chr_data.length; i++) {
      var lat = chr_data[i]['lat'];
      var lng = chr_data[i]['lng'];
      bound.extend(new google.maps.LatLng(parseFloat(lat), parseFloat(lng)));

      // OTHER CODE
    }


    //console.log( bound.getCenter() )

    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 9,
      scrollwheel: false,
      center: bound.getCenter(),
      mapTypeControlOptions: {
        mapTypeIds: ['roadmap', 'satellite', 'hybrid', 'terrain',
          'styled_map']
      }
    });

    if (chr_data.length == 0) {
      map.setCenter(oldCenter);
    }
    else {
      oldCenter = map.getCenter();
    }

    var infowindow = new google.maps.InfoWindow();


    var marker, i, tooltip, latlng;
    var geocoder = new google.maps.Geocoder;

    for (i = 0; i < chr_data.length; i++) {
      // setTimeout( function () {
      // console.log('inside_for');
      var lat = chr_data[i]['lat'];
      var lng = chr_data[i]['lng'];
      var img = chr_data[i]['img'];
      var f1 = chr_data[i]['featimg1'];
      var f2 = chr_data[i]['featimg2'];
      var f3 = chr_data[i]['featimg3'];
      var f4 = chr_data[i]['featimg4'];
      var f5 = chr_data[i]['featimg1'];
      var place_id = chr_data[i]['plc_id'];
      var icon = {
        url: '<?php echo get_site_url() . "/wp-content/uploads/2018/03/EDA_Map_Marker_general.png";?>',
        scaledSize: new google.maps.Size(35, 35), // scaled size
        origin: new google.maps.Point(0, 0), // origin
        anchor: new google.maps.Point(0, 0) // anchor
      };

      // console.log("HERE with "+lat+" : "+lng+" : ");
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(parseFloat(lat), parseFloat(lng)),
        map: map,
        icon: icon,
        animation: google.maps.Animation.DROP,
        title: chr_data[i]['content']
      });

      // var geocoder = new google.maps.Geocoder;

      // latlng = {lat: parseFloat(lat), lng: parseFloat(lng)};


      // geocoder.geocode({'location': latlng}, function(results, status,i) {
      //    if (status === google.maps.GeocoderStatus.OK) {
      //      // console.log("result is ",results);
      //      if (results[0]) {
      //        console.log(results);
      //        console.log(results[0].place_id);
      //        placeIdArray[i]=results[0].place_id;
      //      } else {
      //        // window.alert('No results found');
      //      }
      //    } else {
      //      // window.alert('Geocoder failed due to: ' + status);
      //    }
      //    //console.log("Place ids ",placeIdArray);
      //  });


      if (place_id != null && place_id != undefined && place_id != '') {

        var request = {
          placeId: place_id
        };

        var service = new google.maps.places.PlacesService(map);

        // setTimeout( function () {

        service.getDetails(request, function (place, status) {
          // console.log(status)
          if (status == google.maps.places.PlacesServiceStatus.OK) {
            console.log(place);
            // $.each(place.photos,function(index,photoObj){
            //   console.log("photo ",photoObj.getUrl());
            // });

            // church_details.i.reviews = place.reviews;
            church_details[place.place_id] = {reviews: place.reviews, url: place.url};

            // rtimes = thesorted.map(function(x) {
            //   return new Date(x * 1000);
            // });

            // church_details.push({reviews:place.reviews});

            console.log(church_details);

            // var src = "https://maps.googleapis.com/maps/api/place/photo?maxwidth=600&photoreference="+place.reference+"&key=AIzaSyCxFgdIx2m0eu8MBKRY68X7eUrSqkemHKc";
            // console.log("photo url ",src);


          }
        });

      }

      // }, 1000);

      var selectIcon = {
        url: '<?php echo get_site_url() . "/wp-content/uploads/2018/03/EDA_Map_Marker_active.png";?>',
        scaledSize: new google.maps.Size(35, 35), // scaled size
        origin: new google.maps.Point(0, 0), // origin
        anchor: new google.maps.Point(0, 0) // anchor
      }


      // google.maps.event.addListener(marker, 'mouseover', function(marker, i) {

      //     tooltip = new Tooltip(chr_data[i]['content']);
      //     tooltip.open(this.getMap(), this);
      // });

      // google.maps.event.addListener(marker, 'mouseout', function(marker, i) {
      //     tooltip.close();
      // });


      google.maps.event.addListener(marker, 'click', (function (marker, i) {

        // jQuery( "a.chr_detail_link[chr-data='"+i+"']" ).trigger( "click" );
        return function () {

          jQuery('.chr_detail_title').html(chr_data[i]['content']);
          jQuery('.chr_detail_phone').html(chr_data[i]['phn']);
          jQuery('.chr_detail_address').html(chr_data[i]['addr'] + '<br>' + chr_data[i]['ch_city'] + ', ' + chr_data[i]['ch_state'] + ', ' + chr_data[i]['ch_zip']);
          jQuery('.stime_content ul').html('');
          jQuery(".chr_detail_website a").attr("href", chr_data[i]['ch_url']);
          jQuery('.chr_detail_slider_div .chr_detail_carousel').html('');
          destroyCarousel();

          if (typeof chr_data[i]['stime'] !== 'undefined' && chr_data[i]['stime'].length > 0) {
            // jQuery('.stime_content').html('<ul></ul>');
            var cList = jQuery('.stime_content ul');

            $.each(chr_data[i]['stime'], function (j) {
              // console.log(chr_data[i]['stime']);
              var li = jQuery('<li/>')
                  .addClass('stime_li')
                  .attr('role', 'menuitem')
                  .appendTo(cList);
              var aaa = jQuery('<a/>')
                  .addClass('ui-all')
                  .text(chr_data[i]['stime'][j])
                  .appendTo(li);
            });
          }


          if (typeof chr_data[i]['featimg'] !== 'undefined' && chr_data[i]['featimg'].length > 0) {
            // jQuery('.stime_content').html('<ul></ul>');
            var scontent = jQuery('.dummy-chr-slider-container').html();
            var fList = jQuery('.chr_detail_slider_div .chr_detail_carousel');
            fList.html('');


            $.each(chr_data[i]['featimg'], function (key, value) {
              console.log(key);
              fList.append(scontent);
              var latestElement = fList.find('.chr_detail_slider_cont:last-child');

              latestElement.find(".chr_detail_carousel_img").attr('src', value);


            });
            // jQuery('.chr_detail_slider_div .chr_detail_carousel').slick('unslick').slick('reinit');
            // $('.chr_detail_slider_div .chr_detail_carousel').slick('reinit');
            // destroyCarousel()
            slickCarousel();
            jQuery(window).resize();

          } else {

            jQuery('.chr_detail_slider_div .chr_detail_carousel').html('');

            jQuery('.chr_detail_slider_div .chr_detail_carousel').html('<div class="chr_detail_slider_cont">' +
                '<div class="chr_img_cover">' +
                '<img class="chr_detail_carousel_img" src="' + chr_data[i]['img'] + '"/>' +
                '</div>' +
                '</div>');


          }


          var pid = jQuery('a.chr_detail_link[chr-data="' + i + '"]').attr('data-placeid');
          console.log(pid);

          if (pid != undefined && pid != null && pid != '') {
            // if (typeof church_details[pid]['reviews'] != undefined && church_details[pid]['reviews'].length > 0) {

            // console.log(church_details[pid]['reviews']);s

            var rList = jQuery('.google_reviews_cont');
            var googleReviewHTML = jQuery(".dummy-google-review-container").html();
            var moreReview = jQuery(".dummy_more_auth_review_btn").html();
            rList.html('');

            thesorted = church_details[pid]['reviews'].sort(function (x, y) {
              return y.time - x.time;
            });

            // google.maps.event.addListener(infowindow,'closeclick',function(){
            $.each(thesorted, function (key, value) {

              // console.log(value.profile_photo_url);

              if (key > 4) {
                // jQuery(".chrch_search_cont").insertAfter(latestElement);
                rList.append(moreReview);
                jQuery(".google_reviews_cont .btn_links").attr('href', church_details[pid]['url'])
                return false;
              }

              rList.append(googleReviewHTML);
              var latestElement = rList.find('.google-reviews:last-child');
              latestElement.find(".author_name_div a").html(value.author_name);
              if (value.profile_photo_url != undefined) {
                latestElement.find(".author_img").attr('src', value.profile_photo_url);
              } else {
                latestElement.find(".author_img").attr('src', "<?php echo get_site_url() . '/wp-content/uploads/2018/04/default_user.jpg'; ?>");
              }
              latestElement.find(".rating_time_div").html(value.relative_time_description);
              latestElement.find(".rating_comment").html(value.text);
              latestElement.find(".auth_url_link").attr('href', value.author_url);
              // for($k=1;$k<value.rating;$k++){
              latestElement.find(".author_rating_div span").slice(0, value.rating).addClass('checked');
              // }
              // }
            });

          } else {
            console.log('empty pid');
            jQuery('.google_reviews_cont').html('');
          }

          jQuery('.chrch_list_siblings').hide();
          jQuery('.church_srch_result_detail').show();

          // infowindow.setContent(
          // '<div id="content" style="width: 240px;background-color:#37363a;">'+
          // '<div class="image-section">'+
          // '<img src="'+chr_data[i]['img']+'" height="200" width="269">'+
          // '</div>'+
          // '<h4 id="firstHeading" class="firstHeading" text-color="white">'+chr_data[i]['content']+'</h4>'+
          // '<div id="bodyContent">'+
          // '<p>'+chr_data[i]['addr']+', '+chr_data[i]['ch_city']+', '+chr_data[i]['ch_state']+', '+chr_data[i]['ch_zip']+'</p>'+
          // '<div class="church_phn_learn_more">'+
          // '<div class="chrch_phn content_divide">'+chr_data[i]['phn']+'</div>'+
          // '<div class="learn_more content_divide"><a target="_blank" class="chrch_redirect" href="'+chr_data[i]['ch_url']+'">Learn more</a></div>'+
          // '<div class="clear_float"></div>'+
          // '</div>'+
          // '</div>'
          // );

          for (var j = 0; j < markers.length; j++) {
            markers[j].setIcon(icon);
          }

          // infowindow.open(map, marker);
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

      google.maps.event.addListener(infowindow, 'closeclick', function () {
        for (var j = 0; j < markers.length; j++) {
          markers[j].setIcon(icon);
        }
      });
      // }, 250);
    }

    jQuery(document).on("click", "a.chr_detail_link", function (e) {

      var ci = jQuery(this).attr('chr-data');


      markers[ci].setIcon(selectIcon);

      jQuery('.chr_detail_title').html(chr_data[ci]['content']);
      jQuery('.chr_detail_phone a').text(chr_data[ci]['phn']);
      jQuery(".chr_detail_phone a").attr('href', 'tel:' + chr_data[ci]['phn']);
      jQuery('.chr_descrip h6').text('About ' + chr_data[ci]['content']);
      jQuery('.chr_descrip p').html(chr_data[ci]['sch_descrip']);
      jQuery('.chr_detail_address').html(chr_data[ci]['addr'] + '<br>' + chr_data[ci]['ch_city'] + ', ' + chr_data[ci]['ch_state'] + ', ' + chr_data[ci]['ch_zip']);
      jQuery('.stime_content ul li').text(chr_data[ci]['sch_grades_served']);
      jQuery('.stime_ministries_content ul li a').text(chr_data[ci]['sch_life_1']);
      jQuery(".stime_ministries_content ul li a").attr('href', chr_data[ci]['sch_life_1_url']);
      jQuery(".stime_ministries_content ul li:nth-of-type(2) a").text( chr_data[ci]['sch_life_2']);
      jQuery(".stime_ministries_content ul li:nth-of-type(2) a").attr('href', chr_data[ci]['sch_life_2_url']);
      jQuery(".cstime_ministries_content ul li:nth-of-type(3) a").text(chr_data[ci]['sch_life_3']);
      jQuery(".stime_ministries_content ul li:nth-of-type(3) a").attr('href', chr_data[ci]['sch_life_3_url']);
      jQuery(".cstime_ministries_content ul li:nth-of-type(4) a").text(chr_data[ci]['sch_life_4']);
      jQuery(".stime_ministries_content ul li:nth-of-type(4) a").attr('href', chr_data[ci]['sch_life_4_url']);
      jQuery('.chr_detail_slider_div .chr_detail_carousel').html('');
      destroyCarousel();
      jQuery(".chr_detail_website a").attr('href', chr_data[ci]['ch_url']);
      jQuery(".chr_detail_social a").attr('href', chr_data[ci]['sch_social_1_url']);
      jQuery(".chr_detail_social a i").attr('class', 'fa fa-' + chr_data[ci]['sch_social_1']);
      jQuery(".chr_detail_social a:nth-of-type(2)").attr('href', chr_data[ci]['sch_social_2_url']);
      jQuery(".chr_detail_social a:nth-of-type(2) i").attr('class', 'fa fa-' + chr_data[ci]['sch_social_2']);
      jQuery(".chr_detail_social a:nth-of-type(3)").attr('href', chr_data[ci]['sch_social_3_url']);
      jQuery(".chr_detail_social a:nth-of-type(3) i").attr('class', 'fa fa-' + chr_data[ci]['sch_social_3']);
      // jQuery(".chr_detail_social a").text(chr_data[ci]['ch_social']);
      // jQuery(window).resize();
      // jQuery("#google-reviews").googlePlaces({
      //       placeId: 'ChIJ9aOumeMc9YgR6aduLmyXQEk' //Find placeID @: https://developers.google.com/places/place-id
      //     , render: ['reviews']
      //     , min_rating: 4
      //     , max_rows:4
      //  });

      if (typeof chr_data[ci]['stime'] !== 'undefined' && chr_data[ci]['stime'].length > 0) {
        // jQuery('.stime_content').html('<ul></ul>');
        var cList = jQuery('.stime_content ul');

        $.each(chr_data[ci]['stime'], function (i) {
          var li = jQuery('<li/>')
              .addClass('stime_li')
              .attr('role', 'menuitem')
              .appendTo(cList);
          var aaa = jQuery('<a/>')
              .addClass('ui-all')
              .text(chr_data[ci]['stime'][i])
              .appendTo(li);
        });
      }

      if (typeof chr_data[ci]['featimg'] !== 'undefined' && chr_data[ci]['featimg'].length > 0) {
        // jQuery('.stime_content').html('<ul></ul>');
        var scontent = jQuery('.dummy-chr-slider-container').html();
        var fList = jQuery('.chr_detail_slider_div .chr_detail_carousel');
        fList.html('');


        $.each(chr_data[ci]['featimg'], function (key, value) {
          console.log(key);
          fList.append(scontent);
          var latestElement = fList.find('.chr_detail_slider_cont:last-child');

          latestElement.find(".chr_detail_carousel_img").attr('src', value);


        });
        // jQuery('.chr_detail_slider_div .chr_detail_carousel').slick('unslick').slick('reinit');
        // $('.chr_detail_slider_div .chr_detail_carousel').slick('reinit');
        // destroyCarousel()
        slickCarousel();
        jQuery(window).resize();

      } else {

        jQuery('.chr_detail_slider_div .chr_detail_carousel').html('');

        jQuery('.chr_detail_slider_div .chr_detail_carousel').html('<div class="chr_detail_slider_cont">' +
            '<div class="chr_img_cover">' +
            '<img class="chr_detail_carousel_img" src="' + chr_data[ci]['img'] + '"/>' +
            '</div>' +
            '</div>');
      }

      var pid = jQuery(this).attr('data-placeid');
      // console.log(pid);

      if (pid != undefined && pid != null && pid != '') {
        // if (typeof church_details[pid]['reviews'] != undefined && church_details[pid]['reviews'].length > 0) {

        console.log(church_details[pid]['reviews']);

        var rList = jQuery('.google_reviews_cont');
        var googleReviewHTML = jQuery(".dummy-google-review-container").html();
        var moreReview = jQuery(".dummy_more_auth_review_btn").html();
        rList.html('');

        thesorted = church_details[pid]['reviews'].sort(function (x, y) {
          return y.time - x.time;
        });

        // google.maps.event.addListener(infowindow,'closeclick',function(){
        $.each(thesorted, function (key, value) {

          // console.log(value.profile_photo_url);
          // console.log(key);
          if (key > 4) {
            // jQuery(".chrch_search_cont").insertAfter(latestElement);
            rList.append(moreReview);
            jQuery(".google_reviews_cont .btn_links").attr('href', church_details[pid]['url'])
            return false;
          }
          rList.append(googleReviewHTML);
          var latestElement = rList.find('.google-reviews:last-child');
          latestElement.find(".author_name_div a").html(value.author_name);
          if (value.profile_photo_url != undefined) {
            latestElement.find(".author_img").attr('src', value.profile_photo_url);
          } else {
            latestElement.find(".author_img").attr('src', "<?php echo get_site_url() . '/wp-content/uploads/2018/04/default_user.jpg'; ?>");
          }
          latestElement.find(".rating_time_div").html(value.relative_time_description);
          latestElement.find(".rating_comment").html(value.text);
          latestElement.find(".auth_url_link").attr('href', value.author_url);
          // for($k=1;$k<value.rating;$k++){
          latestElement.find(".author_rating_div span").slice(0, value.rating).addClass('checked');
          // }
        });
      }
      jQuery('.chrch_list_siblings').hide();
      jQuery('.church_srch_result_detail').show();
    });
    jQuery(document).on("click", "a.all_chr_detail_link", function (e) {
      jQuery('.google_reviews_cont').html('');
      for (var j = 0; j < markers.length; j++) {
        markers[j].setIcon(icon);
      }
      // });
      jQuery('.church_srch_result_detail').hide();
      jQuery('.chrch_list_siblings').show();
    });


    // console.log(markers);

    // jQuery('.church_list_container').on('click', function(e){

    //   var myClass = jQuery(this).attr("class");
    //   // console.log(e.target);
    //   if(jQuery(e.target).attr('class') != 'chr_website_link'){
    //       google.maps.event.trigger(markers[jQuery(this).attr('data-attr')], 'click');
    //   }

    // });

    //  marker.addListener('click', function() {
    //   infowindow.open(map, marker);
    // });

    //Associate the styled map with the MapTypeId and set it to display.
    map.mapTypes.set('styled_map', styledMapType);
    map.setMapTypeId('styled_map');

    // var containerClass=".church_result_container";
    //   $(document).ready(function(){
    //     var windowHeight = $(window).height();
    //     $(containerClass).height();
    //     console.log(windowHeight);
    //   });
    //   $( window ).resize(function() {
    //     var windowHeight = $(window).height();
    //     $(containerClass).height();
    //     console.log(windowHeight);
    //      var windowHeight = $(window).height() + 384;
    //      $('.church_srch_result').slimScroll({ height: windowHeight });
    //   });

    //   $(function(){
    //      var windowHeight = $(window).height() + 384;
    //      $('.church_srch_result').slimScroll({ height: windowHeight });
    //   });

    jQuery('#church_search').keyup(function () {
      if (jQuery(this).val().length != 0) {
        jQuery('#find_church_button').attr('disabled', false);
      } else {
        jQuery('#addrLat').val('');
        jQuery('#addrLng').val('');
        //jQuery('#find_church_button').attr('disabled',true);
      }
    });
    function slickCarousel() {
      $('.chr_detail_slider_div .chr_detail_carousel').slick({
        dots: true,
        infinite: true,
        speed: 1000,
        fade: true,
        arrow: true,
        cssEase: 'linear'
      });
    }
    function destroyCarousel() {
      if ($('.chr_detail_slider_div .chr_detail_carousel').hasClass('slick-initialized')) {
        $('.chr_detail_slider_div .chr_detail_carousel').slick('destroy');
      }
    }
  }
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyCxFgdIx2m0eu8MBKRY68X7eUrSqkemHKc&callback=initMap">
</script>

<script type="text/javascript">
  jQuery(document).ready(function() {
    // jQuery('#find_church_button').attr('disabled',true);
    // jQuery('#church_search').keyup(function(){
    //     if(jQuery(this).val().length !=0){
    //            console.log('has query');
    //         jQuery('#find_church_button').attr('disabled', false);
    //     }else{
    //          console.log('no query');
    //         //jQuery('#find_church_button').attr('disabled',true);
    //        }
    // });

    // jQuery('#church_search').keyup(function(){
    //   jQuery('#church_search').bind("keyup keypress", function(e) {
    //     var code = e.keyCode || e.which;
    //     if(jQuery(this).val().length !=0)
    //         jQuery('#find_church_button').attr('disabled', false);
    //         if (code  == 13) {
    //           searchChurches();
    //         }
    //     else
    //         jQuery('#find_church_button').attr('disabled',true);
    //         if (code  == 13) {
    //           e.preventDefault();
    //           return false;
    //         }
    // })

    jQuery('#church_search').keydown(function(e){
      if (e.keyCode == 13) {
        if(jquery(this).val().length !=0){

          searchChurches();

        }else{

          e.preventDefault();
          return false;

        }
      }
    });


    jQuery(document).on('focusin', '#church_search', function(){
      console.log("Saving value " + jQuery(this).val());
      jQuery(this).data('val', jQuery(this).val());
    }).on('change','#church_search', function(){
      var prev = jQuery(this).data('val');
      var current = jQuery(this).val();
      console.log("Prev value " + prev);
      console.log("New value " + current);
      if(prev!=current){
        console.log("different input");
        jQuery('#addrLat').val('');
        jQuery('#addrLng').val('');
      }
    });

  });
</script>