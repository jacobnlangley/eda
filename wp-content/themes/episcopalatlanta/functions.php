<?php

/**
 * Activates Theme Mode
 */
/**
 * Optional: set 'ot_show_pages' filter to false.
 * This will hide the settings & documentation pages.
 */

include_once __DIR__."/custom_ajax_call.php";
include_once __DIR__."/event-custom-changes.php";

add_theme_support('post-thumbnails');


//Register menu


function register_my_menus() {
    register_nav_menus(
            array(
                'header-menu' => __('Header Menu'),
                'footer-menu' => __('Footer Menu'),
                'contact-menu' => __('Contact Menu'),
                'popup-menu' => __('Popup Menu')
            )
    );
}
add_action('after_setup_theme', 'register_my_menus');


add_filter( 'kdmfi_featured_images', function( $featured_images ) {
  // Add featured-image-2 to pages and posts
  $args_1 = array(
    'id' => 'featured-image-2',
    'desc' => 'Your description here.',
    'label_name' => 'Featured Image 2',
    'label_set' => 'Set featured image 2',
    'label_remove' => 'Remove featured image 2',
    'label_use' => 'Set featured image 2',
    'post_type' => array( 'church' ),
  );

  // Add featured-image-2 to pages only
  $args_2 = array(
    'id' => 'featured-image-3',
    'desc' => 'Your description here.',
    'label_name' => 'Featured Image 3',
    'label_set' => 'Set featured image 3',
    'label_remove' => 'Remove featured image 3',
    'label_use' => 'Set featured image 3',
    'post_type' => array( 'church' ),
  );

  $args_3 = array(
    'id' => 'featured-image-4',
    'desc' => 'Your description here.',
    'label_name' => 'Featured Image 4',
    'label_set' => 'Set featured image 4',
    'label_remove' => 'Remove featured image 4',
    'label_use' => 'Set featured image 4',
    'post_type' => array( 'church' ),
  );

  $args_4 = array(
    'id' => 'featured-image-5',
    'desc' => 'Your description here.',
    'label_name' => 'Featured Image 5',
    'label_set' => 'Set featured image 5',
    'label_remove' => 'Remove featured image 5',
    'label_use' => 'Set featured image 5',
    'post_type' => array( 'church' ),
  );

  // Add the featured images to the array, so that you are not overwriting images that maybe are created in other filter calls
  $featured_images[] = $args_1;
  $featured_images[] = $args_2;
  $featured_images[] = $args_3;
  $featured_images[] = $args_4;

  // Important! Return all featured images
  return $featured_images;
});


function pagination($pages = '', $range = 4)
{  
     $showitems = ($range * 2)+1;  
 
     global $paged;
     if(empty($paged)) $paged = 1;
 
     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   
 
     if(1 != $pages)
     {
         echo "<div class=\"pagination\"><span>Page ".$paged." of ".$pages."</span>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; First</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo; Previous</a>";
 
         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
             }
         }
 
         if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">Next &rsaquo;</a>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>Last &raquo;</a>";
         echo "</div>\n";
     }
}


function common_script_with_jquery()
{

	wp_register_script( 'google-placesjs', get_template_directory_uri() . '/js/google-places.js', array( 'jquery'), null,  true  );

	wp_enqueue_script('google-placesjs');



	// wp_register_script( 'jqueryjs', get_template_directory_uri() . '/js/jquery.min.js', array( 'jquery'), null,  true  );

	// wp_enqueue_script('jqueryjs');

//	wp_register_script( 'slimscrolljs', get_template_directory_uri() . '/js/jquery.slimscroll.js', array( 'jquery'), null,  true  );
//
//	wp_enqueue_script('slimscrolljs');


	wp_register_script( 'tetherjs', get_template_directory_uri() . '/js/tether.min.js', array( 'jquery'), null,  true  );
	wp_enqueue_script('tetherjs');


	wp_register_script( 'bootstrapjs', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery'), null,  true  );

	wp_enqueue_script('bootstrapjs');


	// wp_register_script( 'datepickerjs', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js', null, null, true );

	wp_register_script( 'datepickerjs', get_template_directory_uri() . '/js/bootstrap-datepicker.min.js', array( 'jquery'), null,  true  );

	wp_enqueue_script('datepickerjs');


	// wp_register_script( 'momentjs', 'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js', null, null, true );

	wp_register_script( 'momentjs', get_template_directory_uri() . '/js/moment.min.js', array( 'jquery'), null, true );


	wp_enqueue_script('momentjs');


	// wp_register_script( 'timepickerjs', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js', null, null, true );

	wp_register_script( 'timepickerjs', get_template_directory_uri() . '/js/bootstrap-timepicker.min.js', array( 'jquery'), null, true  );


	wp_enqueue_script('timepickerjs');


   
    wp_register_script( 'jquery_ui_js', get_template_directory_uri() . '/js/jquery-ui.min.js', array( 'jquery'), null, true );

     wp_enqueue_script( 'jquery_ui_js' );

    // wp_register_script( 'common_script', get_template_directory_uri() . '/js/common_script.js', array( 'jquery','momentjs','timepickerjs','datepickerjs' ) );

    wp_register_script( 'common_script', get_template_directory_uri() . '/js/common_script.js', array( 'jquery','momentjs','timepickerjs','datepickerjs','jquery_ui_js' ) );

    // For either a plugin or a theme, you can then enqueue the script:
    wp_enqueue_script( 'common_script' );


}
add_action( 'wp_enqueue_scripts', 'common_script_with_jquery' );

add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);

function _remove_script_version( $src ){ 
$parts = explode( '?', $src ); 	
return $parts[0]; 
} 
add_filter( 'script_loader_src', '_remove_script_version', 15, 1 ); 
add_filter( 'style_loader_src', '_remove_script_version', 15, 1 );


// if(!is_admin()) {
//     // Move all JS from header to footer
//     remove_action('wp_head', 'wp_print_scripts');
//     remove_action('wp_head', 'wp_print_head_scripts', 9);
//     remove_action('wp_head', 'wp_enqueue_scripts', 1);
//     add_action('wp_footer', 'wp_print_scripts', 5);
//     add_action('wp_footer', 'wp_enqueue_scripts', 5);
//     add_action('wp_footer', 'wp_print_head_scripts', 5);
// }

if (!(is_admin() )) {
    function defer_parsing_of_js ( $url ) {
        if ( FALSE === strpos( $url, '.js' ) ) return $url;
        if ( strpos( $url, 'jquery.js' ) ) return $url;
        return "$url' defer ";
        // return "$url' defer onload='";
    }
    add_filter( 'clean_url', 'defer_parsing_of_js', 11, 1 );
}

function special_nav_class ($classes, $item) {
    if (in_array('current-menu-item', $classes) ){
        $classes[] = 'active ';
    }
    return $classes;
}


function child_enqueue_styles() {

	wp_enqueue_style( 'gstyle', get_template_directory_uri() . '/css/technource-g.css',false,'1.1','all');
	wp_enqueue_style( 'ustyle', get_template_directory_uri() . '/css/technource-u.css',false,'1.1','all');
	wp_enqueue_style( 'jstyle', get_template_directory_uri() . '/css/technource-j.css',false,'1.1','all');
	wp_enqueue_style( 'googleplacesstyle', get_template_directory_uri() . '/css/google-places.css',false,'1.1','all');
	wp_enqueue_style( 'date_timepickerstyle', get_template_directory_uri() . '/css/date_timepicker.min.css',false,'1.1','all');

	// wp_enqueue_style( 'datepicker', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css');


	// wp_enqueue_style( 'timepicker', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.min.css');


}

add_action( 'wp_enqueue_scripts', 'child_enqueue_styles');


// function wpse_enqueue_datepicker() {
//     // Load the datepicker script (pre-registered in WordPress).
//     wp_enqueue_script( 'jquery-ui-datepicker' );

//     // You need styling for the datepicker. For simplicity I've linked to Google's hosted jQuery UI CSS.
//     wp_register_style( 'jquery-ui', 'http://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css' );
//     wp_enqueue_style( 'jquery-ui' );  
// }
// add_action( 'wp_enqueue_scripts', 'wpse_enqueue_datepicker' );



function ajax_custom_call()
{

    // Register the script like this for a theme:
    wp_register_script( 'find_church', get_template_directory_uri() . '/js/find_church.js', array( 'jquery' ) );
 
    // For either a plugin or a theme, you can then enqueue the script:
    wp_enqueue_script( 'find_church' );

    

    wp_localize_script( 'find_church', 'get_church_call', array(
		'ajax_url' => admin_url( 'admin-ajax.php' )
	));
}

function ajax_event_call()
{

	 //wp_register_script( 'calendar_script', get_template_directory_uri() . '/js/fullcalendar.js', array( 'jquery' ));
    // wp_register_script( 'calendar_script', 'http://eda.prosaverapp.com/wp-content/plugins/event-organiser/js/fullcalendar.js' , array( 'jquery' ));

    // wp_enqueue_script( 'calendar_script' );

    // Register the script like this for a theme:
    wp_register_script( 'find_event', get_template_directory_uri() . '/js/find_events.js', array( 'jquery') );
 
    // For either a plugin or a theme, you can then enqueue the script:
    wp_enqueue_script( 'find_event' );

    

    wp_localize_script( 'find_event', 'get_event_call', array(
		'ajax_url' => admin_url( 'admin-ajax.php' )
	));
}

add_action( 'wp_enqueue_scripts', 'ajax_custom_call' );
add_action( 'wp_enqueue_scripts', 'ajax_event_call' );

add_action( 'wp_ajax_nopriv_get_event_list', 'get_event_list' );
add_action( 'wp_ajax_get_event_list', 'get_event_list' );

add_action( 'wp_ajax_nopriv_get_church_list', 'get_church_list' );
add_action( 'wp_ajax_get_church_list', 'get_church_list' );


function my_custom_sidebar() {
    register_sidebar(
        array (
            'name' => __( 'Custom', 'your-theme-domain' ),
            'id' => 'custom-side-bar',
            'description' => __( 'Custom Sidebar', 'your-theme-domain' ),
            'before_widget' => '<div class="widget-content">',
            'after_widget' => "</div>",
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        )
    );
}
add_action( 'widgets_init', 'my_custom_sidebar' );


require(trailingslashit(get_template_directory()) . 'theme-options.php' );


function single_feature_blog() {


$args = array(
    'post_type' => 'post',
    'posts_per_page' => 1,
    'post_status' => 'publish',
    'orderby'     => 'id', 
    'order'       => 'DESC',
    'meta_key'		=> 'is_featured_post',
	'meta_value'	=> 1
);
 
$loop = new WP_Query($args);
// echo "<pre>";
// print_r($loop);
// exit();
if($loop->post_count != 0){

ob_start();

				$i = 1;
				global $post;
				while ( $loop->have_posts() ) : $loop->the_post();

					$ch_img = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' ); 

					$termss = wp_get_post_terms($post->ID, 'category');
					$get_author_id = get_the_author_meta('ID');
					$get_author_gravatar = get_avatar_url($get_author_id, array('size' => 450));


					$fname = get_the_author_meta('first_name');
					$lname = get_the_author_meta('last_name');
					$full_name = '';

					if( empty($fname)){
					    $full_name = $lname;
					} elseif( empty( $lname )){
					    $full_name = $fname;
					} else {
					    //both first name and last name are present
					    $full_name = "{$fname} {$lname}";
					}

					

					?>

			<div class="post-slides feature_slide">
				<div class="post-list">
					<div class="post-list-content">
					<div class="wp-medium-5 wpcolumns">
						<div class="post-image-bg">
							<img class="post_feature_img" src="<?php echo $ch_img; ?>" alt="<?php the_title(); ?>" />
						</div>
						
					</div>
					<div class="wp-medium-7 wpcolumns">
								
						  <h2 class="wp-post-title post_feature_title">
							<?php the_title(); ?>
						</h2>
							<?php if($showDate || $showAuthor)    {  ?>	
						<div class="wp-post-date">		
							<?php  if($showAuthor) { ?> <span><?php  esc_html_e( 'By', 'wp-responsive-recent-post-slider' ); ?> <?php the_author(); ?></span><?php } ?>
							<?php echo ($showAuthor && $showDate) ? '&nbsp;/&nbsp;' : '' ?>
							<?php if($showDate) { echo get_the_date(); } ?>
							</div>
							<?php }   ?>
								<?php //if($showContent) {  ?>	
							<div class="wp-post-content post_feature_content">

								<div class="post_feature_text">
									<?php the_content();?>
								</div>
								<div class="author_details">


									<div class="pf_author_img">
										<img src="<?php echo $get_author_gravatar;?>" alt="<?php get_the_title();?>" />
									</div>

									<div class="pf_right">

										<div class="pf_author_name">
											<?php echo $full_name;?>
										</div>

										<div class="pf_date_cat">
										<?php
										foreach ($termss as $cat_chr) {
											?>
												
												<div><?php $time = human_time_diff(strtotime(get_the_date())); ?>
												<span class="post_date"><?php echo $time;?></span> AGO in <span class="post_cat_name"><?php echo $cat_chr->name;?></span></div>

												<?php
												}
											?>
										</div>
									</div>

								</div>
								
							<?php //} ?>
							
							</div>
					</div>
					</div>
					
				</div>
			</div>

			
				<div class="clearfloat"></div>
				  <?php
				  $i++;
				endwhile;
				?>
          
<?php
}
else{
?>

<div class="no_result">
	<?php echo "No Featured Post Found"; ?>
</div>




	<?php
}
$resp_content = ob_get_clean();


	return $resp_content;
}


function grid_feature_blog() {

?>

	<div class="feature_post_grid">
	<div class="feature_post_grid_cont">
<?php
$args = array(
    'post_type' => 'post',
    'posts_per_page' => 4,
    'offset' =>  1,
    'post_status' => 'publish',
    'orderby'     => 'id', 
    'order'       => 'DESC',
    'meta_key'		=> 'is_featured_post',
	'meta_value'	=> 1
);
 
$loop = new WP_Query($args);
// echo "<pre>";
// print_r($loop);
// exit();
if($loop->post_count != 0){

ob_start();

				$i = 1;
				global $post;
				while ( $loop->have_posts() ) : $loop->the_post();

					$ch_img = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' ); 

					$termss = wp_get_post_terms($post->ID, 'category');
					$get_author_id = get_the_author_meta('ID');
					$get_author_gravatar = get_avatar_url($get_author_id, array('size' => 450));


					$fname = get_the_author_meta('first_name');
					$lname = get_the_author_meta('last_name');
					$full_name = '';

					if( empty($fname)){
					    $full_name = $lname;
					} elseif( empty( $lname )){
					    $full_name = $fname;
					} else {
					    //both first name and last name are present
					    $full_name = "{$fname} {$lname}";
					}

					

					?>

			<div class="fp_grid_container fp_grid_<?php echo $i; ?>">
				<div class="post-list">
					<div class="post-list-content">
					<div class="wp-medium-3 wpcolumns fp_grid_colums">

					<div class="fp_grid_normal">

						<div class="post-image-bg">
							<img class="fp_grid_img" src="<?php echo $ch_img; ?>" alt="<?php the_title(); ?>" />
						</div>

						<div class="fp_cat">

							<?php 
							foreach ($termss as $cat_chr) {
								?>
								<span><?php echo $cat_chr->name;?></span>

								<?php
							}
							?>
						</div>

						<div class="fp_grid_bottom">

							<div class="fp_grid_title_div">
								<div class="wp-post-title fp_grid_title">
									<?php the_title(); ?>
								</div>
							</div>

							

							<div class="post_feature_text">
								<?php the_content();?>
							</div>

						</div>
					</div>

					<div class="fp_grid_onhover">

						<?php 
						foreach ($termss as $cat_chr) {
							?>
							<div class="fp_grid_cat_hover"><span><?php echo $cat_chr->name;?></span></div>

							<?php
						}
						?>
					

						

						<div class="fp_grid_title_hover">
								<?php the_title(); ?>
						</div>

						

						<div class="pf_grid_text_hover">
							<?php the_content();?>
						</div>

						<div class="btn_div pf_read_more" style="text-align: center;"><a target="_blank" href="<?php the_permalink(); ?>" class="btn_links btn_link1">READ MORE</a></div>

					
					</div>

						
					</div>
					</div>
				</div>
			</div>


					
						

				
				  <?php
				  $i++;
				endwhile;
				?>
          
<?php
}
else{
?>

<div class="no_result">
	<?php echo "No Featured Post Found"; ?>
</div>




	<?php
}
?>
<div class="clearfloat"></div>
</div>
</div>
<?php
$resp_content = ob_get_clean();


	return $resp_content;
}


function grid_faith_carousel() {

$args = array(
    'post_type' => 'post',
    'offset' =>  1,
    'post_status' => 'publish',
    'orderby'     => 'id', 
    'order'       => 'DESC',
    'tag' =>'for-faith',
);
 
$loop = new WP_Query($args);

if($loop->post_count != 0){

ob_start();
?>
<div class="for_faith_carousel">
	<?php
		$i = 1;
		global $post;
		while ( $loop->have_posts() ) : $loop->the_post();

			$ch_img = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' ); 

			?>


			<div class="for_faith_slider_cont">

				<span class="for_faith_carousel_img" style="background: url('<?php echo $ch_img; ?>');"></span>
				<a href="<?php the_permalink();?>"><!-- <img class="for_faith_carousel_img" src="<?php //echo $ch_img; ?>" /> -->	
				<div class="faith_carouse_title_div">				
					<span class="faith_carouse_title"><?php the_title(); ?></span>
				</div>
			</a></div>				
				

		
		  <?php
		  $i++;
		endwhile;
		?>
          
<?php
}
else{
?>

<div class="no_result">
	<?php echo "No Faith Post Found"; ?>
</div>

	<?php
}
?>

</div>
<?php
$resp_content = ob_get_clean();


	return $resp_content;
}


function inspiration_faith_content() {

$args = array(
    'post_type' => 'post',
    // 'offset' =>  1,
    // 'posts_per_page' => 4,
    'post_status' => 'publish',
    'orderby'     => 'id', 
    'order'       => 'DESC',
    'tag' =>'for-faith',
);
 
$loop = new WP_Query($args);

if($loop->post_count != 0){

ob_start();
?>
<div class="for_faith_content">
	<?php
		$i = 1;
		global $post;
		while ( $loop->have_posts() ) : $loop->the_post();

			$ch_img = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' ); 

			?>


			<div style="display: none;" class="for_faith_date_cont faith_post_<?php echo $i; ?> <?php if($i==1){ echo 'faith_active';} ?>">

				<h2 style="font-size: 20px;color: #4f2d80;text-align: center;font-family:Londrina Outline;font-weight:400;font-style:normal" class="vc_custom_heading inspiration_date_title"><?php echo get_the_date('m/d/y');?></h2>


				<div class="wpb_text_column wpb_content_element  inspiration_date_text">
					<div class="wpb_wrapper">
					<?php
					my_excerpt(90);
					 //the_excerpt(); ?>
					</div>
				</div>

				<div class="wpb_text_column wpb_content_element  inspiration_date_btn">
					<div class="wpb_wrapper">
						<div class="btn_div" style="text-align: center;"><a href="<?php the_permalink();?>" class="btn_links btn_link1">EN ESPAÑOL</a></div>

					</div>
				</div>

			</div>			
				

		
		  <?php
		  $i++;
		endwhile;
		?>
          
<?php
}
else{
?>

<div class="no_result">
	<?php echo "No Faith Post Found"; ?>
</div>

	<?php
}
?>

</div>
<?php
$resp_content = ob_get_clean();


	return $resp_content;
}




function blog_posts($atts = array()){
// the query

	ob_start();
	// $post_no = 2;
$post_no = get_option('posts_per_page');

 $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array('post_type'=>'post', 'post_status'=>'publish', 'posts_per_page'=>$post_no,'paged' => $paged,);


if(!empty($atts['tag'])){
 	$args['tag'] = $atts['tag'];
 	// echo $atts['tag'];
 }

 $args['tag__not_in'] = array(129);

 $wpb_all_query = new WP_Query($args); 
?>
 
<?php if ( $wpb_all_query->have_posts() ) : ?>
 

 
    <!-- the loop -->
    <?php while ( $wpb_all_query->have_posts() ) : $wpb_all_query->the_post();

          $ch_img = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' ); 

     ?>

     <div class="blog_posts_div blog_posts_<?php echo $post->ID; ?>">
        
        <div class="blog_post_date">

                <?php echo get_the_date('F j, Y');?>
            </div>

            <div class="blog_post_title">
              <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </div>

            <div class="blog_post_description">

              <?php

              $word_count = str_word_count(get_the_content());
               $content = get_the_content();
					if($word_count<45)
					{
						the_content();
					}
					else
					{
						//the_excerpt();

						my_excerpt(48);
						 //echo limit_words(get_the_excerpt(), '180');
						//wpdocs_custom_excerpt_length(180);
						?>
						<div class="btn_div" style="text-align: left;">
						<a class="btn_links news_readmore_btn" href="<?php echo get_the_permalink() ?>">Read More</a>
						</div>
						<?php
						//echo substr($content, 0, 600).' ...<a class="event_readmore_btn" href="'.get_the_permalink().'">Read More</a>';
					}
						
					?>
            </div>

            <div class="blog_posts_tags"><p><?php //the_tags(); ?></p></div>

            <div class="addthis_inline_share_toolbox"></div>

            <div class="news_divider"></div>

        </div>
    <?php endwhile; ?>
    <!-- end of the loop -->

 
    <?php wp_reset_postdata(); 

if (function_exists("pagination")) {
    //pagination($wpb_all_query->max_num_pages);
} 




    ?>
    <div class="my_pagination">
	    <?php 
	$total_pages = $wpb_all_query->max_num_pages; 


	// if ($total_pages > 1){ 
	// $current_page = max(1, get_query_var('paged')); 

	// echo paginate_links(array( 
	// 'base' => get_pagenum_link(1) . '%_%', 
	// 'format' => 'page/%#%', 
	// 'current' => $current_page, 
	// 'total' => $total_pages, 
	// 'before_page_number' => '<div>', 
	// 'after_page_number' => '</div>' 
	// )); 
	// } 
	?>
	<div class="clearfloat"></div>
	</div>

    <div class="my-post-nav-links">
                        <div class="my-prev-post"><?php previous_posts_link('< PREVIOUS PAGE', $wpb_all_query->max_num_pages ); ?></div>
                        <div class="my-next-post"><?php next_posts_link(' NEXT PAGE >', $wpb_all_query->max_num_pages ); ?></div>
                        <div class="clearfloat"></div>
                    </div>
 
<?php else : ?>
    <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; 

$resp_content = ob_get_clean();


	return $resp_content;

}


function featured_blog_posts($atts = array()){
// the query

	ob_start();
	// $post_no = 2;
$post_no = get_option('posts_per_page');

 $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array('post_type'=>'post', 'post_status'=>'publish', 'posts_per_page'=>$post_no,'paged' => $paged,'meta_key'		=> 'is_featured_post',
	'meta_value'	=> 1);


if(!empty($atts['tag'])){
 	$args['tag'] = $atts['tag'];
 	// echo $atts['tag'];
 }

 //$args['tag__not_in'] = array(129);

 $wpb_all_query = new WP_Query($args); 
?>
 
<?php if ( $wpb_all_query->have_posts() ) : ?>
 

 
    <!-- the loop -->
    <?php while ( $wpb_all_query->have_posts() ) : $wpb_all_query->the_post();

          $ch_img = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' ); 

     ?>

     <div class="blog_posts_div blog_posts_<?php echo $post->ID; ?>">
        
        <div class="blog_post_date">

                <?php echo get_the_date('F j, Y');?>
            </div>

            <div class="blog_post_title">
              <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </div>

            <div class="blog_post_description">

              <?php

              $word_count = str_word_count(get_the_content());
               $content = get_the_content();
					if($word_count<45)
					{
						the_content();
					}
					else
					{
						//the_excerpt();

						my_excerpt(48);
						 //echo limit_words(get_the_excerpt(), '180');
						//wpdocs_custom_excerpt_length(180);
						?>
						<div class="btn_div" style="text-align: left;">
						<a class="btn_links news_readmore_btn" href="<?php echo get_the_permalink() ?>">Read More</a>
						</div>
						<?php
						//echo substr($content, 0, 600).' ...<a class="event_readmore_btn" href="'.get_the_permalink().'">Read More</a>';
					}
						
					?>
            </div>

            <div class="blog_posts_tags"><p><?php //the_tags(); ?></p></div>

            <div class="addthis_inline_share_toolbox"></div>

            <div class="news_divider"></div>

        </div>
    <?php endwhile; ?>
    <!-- end of the loop -->

 
    <?php wp_reset_postdata(); 

if (function_exists("pagination")) {
    //pagination($wpb_all_query->max_num_pages);
} 




    ?>
    <div class="my_pagination">
	    <?php 
	$total_pages = $wpb_all_query->max_num_pages; 


	// if ($total_pages > 1){ 
	// $current_page = max(1, get_query_var('paged')); 

	// echo paginate_links(array( 
	// 'base' => get_pagenum_link(1) . '%_%', 
	// 'format' => 'page/%#%', 
	// 'current' => $current_page, 
	// 'total' => $total_pages, 
	// 'before_page_number' => '<div>', 
	// 'after_page_number' => '</div>' 
	// )); 
	// } 
	?>
	<div class="clearfloat"></div>
	</div>

    <div class="my-post-nav-links">
                        <div class="my-prev-post"><?php previous_posts_link('< PREVIOUS PAGE', $wpb_all_query->max_num_pages ); ?></div>
                        <div class="my-next-post"><?php next_posts_link(' NEXT PAGE >', $wpb_all_query->max_num_pages ); ?></div>
                        <div class="clearfloat"></div>
                    </div>
 
<?php else : ?>
    <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; 

$resp_content = ob_get_clean();


	return $resp_content;

}

function for_faith_post(){
// the query

	ob_start();
$post_no = get_option('posts_per_page');

 $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array('post_type'=>'post', 'post_status'=>'publish', 'posts_per_page'=>$post_no,'paged' => $paged, 'tag' =>'for-faith');


// if(!empty($atts['tag'])){
//  	$args['tag'] = $atts['tag'];
//  	// echo $atts['tag'];
//  }



 $wpb_all_query = new WP_Query($args); 
?>
 
<?php if ( $wpb_all_query->have_posts() ) : ?>
 

 
    <!-- the loop -->
    <?php while ( $wpb_all_query->have_posts() ) : $wpb_all_query->the_post();

          $ch_img = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' ); 

     ?>

     <div class="blog_posts_div blog_posts_<?php echo $post->ID; ?>">

     		<div class="blog_post_title">
              <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </div>

            <div class="faith_post_date">
            	<?php echo get_the_date('F j, Y');?>
            </div>
        
        	<div class="blog_post_feature_image faith_feature_image">

                <img class="blog_post_img faith_blog_post_img" src="<?php echo $ch_img; ?>">
            </div>


            <div class="blog_post_description">
              <?php the_content();?>
            </div>

            <div class="sqs-block-content"><hr class="faith_post_divider"></div>

            <div class="blog_posts_tags"><p><span style="color:#333;">Tags:</span> <?php $posttags = get_the_tags();
if ($posttags) {
  foreach($posttags as $tag) {
    echo $tag->name . ' '; 
  }
} //the_tags(); ?></p></div>

           <!--  <div class="faith_share_toolbox"><?php //echo do_shortcode('[addthis tool="addthis_inline_share_toolbox_dr3u"]'); ?></div> -->

        </div>
    <?php endwhile; ?>
    <!-- end of the loop -->

 
    <?php wp_reset_postdata(); 

// if (function_exists("pagination")) {
//     //pagination($wpb_all_query->max_num_pages);
// } 


    ?>

 <div class="my-post-nav-links">
                        <div class="my-prev-post"><?php previous_posts_link('< NEWER POSTS', $wpb_all_query->max_num_pages ); ?></div>
                        <div class="my-next-post"><?php next_posts_link(' OLDER POSTS >', $wpb_all_query->max_num_pages ); ?></div>
                        <div class="clearfloat"></div>
                    </div>

 
<?php else : ?>
    <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; 

$resp_content = ob_get_clean();


	return $resp_content;

}

function post_type_tags( $post_type = '' ) {
    global $wpdb;

    if ( empty( $post_type ) ) {
        $post_type = get_post_type();
    }

    return $wpdb->get_results( $wpdb->prepare( "
        SELECT COUNT( DISTINCT tr.object_id ) 
            AS count, tt.taxonomy, tt.description, tt.term_taxonomy_id, t.name, t.slug, t.term_id 
        FROM {$wpdb->posts} p 
        INNER JOIN {$wpdb->term_relationships} tr 
            ON p.ID=tr.object_id 
        INNER JOIN {$wpdb->term_taxonomy} tt 
            ON tt.term_taxonomy_id=tr.term_taxonomy_id 
        INNER JOIN {$wpdb->terms} t 
            ON t.term_id=tt.term_taxonomy_id 
        WHERE p.post_type=%s 
            AND tt.taxonomy='post_tag' 
        GROUP BY tt.term_taxonomy_id 
        ORDER BY count DESC
    ", $post_type ) );
}

function posttags(){
// $terms = get_terms( array(
// 					    'taxonomy' => 'post_tag',
// 					    'hide_empty' => false,
// 					) ); 

$terms = post_type_tags( 'post' );

?>
<ul class="posts_tag_list">
<?php
foreach ($terms as $taxonomy) {
	            		 	// var_dump($key);
	            		 	// var_dump($value);
	            		 	$cat_slug = $taxonomy->slug;
	            		 	$cat_name = $taxonomy->name;
	            		 	$cat_count = $taxonomy->count;
	            		 	$cat_id = $taxonomy->term_id;
	            		 	if($cat_id != 129){
			            		 	?>
			            		 	<li><a href="<?php echo get_site_url().'/tag/'.$cat_slug; ?>"><?php echo $cat_name; ?></a></li>
			            		 	<?php
			            		 }
		            		 }
	            		 ?>
	            		</ul>
	            		<?php
}


add_shortcode('postTagsList','posttags');

function archivePosts()
{
	global $wp_query;
	if(have_posts()):
		while (have_posts() ) : 

			the_post();

	        $ch_img = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' ); 

	     ?>

	     <div class="blog_posts_div blog_posts_<?php echo $post->ID; ?>">
	        
	        <div class="blog_post_feature_image">

	                <img class="blog_post_img" src="<?php echo $ch_img; ?>">
	            </div>

	            <div class="blog_post_title">
	              <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	            </div>

	            <div class="blog_post_description">
	              <?php the_content();?>
	            </div>

	            <div class="blog_posts_tags"><p><?php the_tags(); ?></p></div>

	            <div class="addthis_inline_share_toolbox"></div>

	        </div>
	    <?php 
		endwhile;
		wp_reset_postdata(); 

		if (function_exists("pagination")):
		    pagination($wp_query->max_num_pages);
		endif;

	else:
		?>
		<div class="no_result">
			<?php echo "No Posts Found"; ?>
		</div>
		<?php
	endif;
}

function my_custom_get_posts( $query ) {
    if ( is_admin() || ! $query->is_main_query() )
        return;

    if ( $query->is_archive() ) {
        $query->set( 'tag__not_in', array(129) );
    }
}
add_action( 'pre_get_posts', 'my_custom_get_posts', 1 );

function blog_posts_stories(){
// the query
	ob_start();
$wpb_all_query = new WP_Query(array('post_type'=>'post', 'post_status'=>'publish', 'posts_per_page'=>7, 'tag__not_in'=>array(129))); ?>
 
<?php if ( $wpb_all_query->have_posts() ) : ?>
 

 
    <!-- the loop -->
    <?php while ( $wpb_all_query->have_posts() ) : $wpb_all_query->the_post();

          //$ch_img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail' ); 

          	$trimmed_content = '';
			$content = get_the_content();
			$trimmed_content = wp_trim_words( $content, 15, '...' );

			$ch_img = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' ); 

 		// 	// echo htmlspecialchars($ch_img);
 		// 	var_dump($ch_img);
 		// 	die();



     ?>

     <div class="blog_stories_div blogpost_stories_<?php echo $post->ID; ?>">
        
        <div class="blog_stories_feature_image">

        	<?php //echo $ch_img;
        	 //the_post_thumbnail('thumbnail'); ?>
                <!-- <img class="blog_stories_img" src="<?php //echo $ch_img; ?>"> -->

                <span class="blog_stories_img" style="background: url('<?php echo $ch_img; ?>');"><span>

            </div>

            <div class="blog_stories_post_date">

                <?php echo get_the_date('F j, Y');?>
            </div>

            <!-- <div class="blog_stories_right"> -->

	            <div class="blog_stories_title">
	              <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	            </div>

	        <!-- </div> -->

	        <div class="clearfloat"></div>
	        <div class="post_stories_divider"></div>

            <!-- <div class="blog_posts_tags"><p><?php //the_tags(); ?></p></div> -->

            <!-- <div class="addthis_inline_share_toolbox"></div> -->

        </div>
    <?php endwhile; ?>
    <!-- end of the loop -->

 
    <?php wp_reset_postdata(); ?>
 
<?php else : ?>
    <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; 

$resp_content = ob_get_clean();


	return $resp_content;

}

function grid_blog() {

?>

	<div class="feature_post_grid">
	<div class="feature_post_grid_cont">
<?php
$args = array(
    'post_type' => 'post',
    'posts_per_page' => 4,
    'post_status' => 'publish',
    'orderby'     => 'id', 
    'order'       => 'DESC',
    'tag__not_in' => array( 129),
);
 
$loop = new WP_Query($args);
// echo "<pre>";
// print_r($loop);
// exit();
if($loop->post_count != 0){

ob_start();

				$i = 1;
				global $post;
				while ( $loop->have_posts() ) : $loop->the_post();


					$ch_img = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' ); 

					$termss = wp_get_post_terms($post->ID, 'category');
					$get_author_id = get_the_author_meta('ID');
					$get_author_gravatar = get_avatar_url($get_author_id, array('size' => 450));


					$fname = get_the_author_meta('first_name');
					$lname = get_the_author_meta('last_name');
					$full_name = '';

					if( empty($fname)){
					    $full_name = $lname;
					} elseif( empty( $lname )){
					    $full_name = $fname;
					} else {
					    //both first name and last name are present
					    $full_name = "{$fname} {$lname}";
					}

					

					?>

			<div class="fp_grid_container fp_grid_<?php echo $i; ?>">
				<div class="post-list">
					<div class="post-list-content">
					<div class="wp-medium-3 wpcolumns fp_grid_colums">

					<div class="fp_grid_normal">

						<div class="post-image-bg">
							<img class="fp_grid_img" src="<?php echo $ch_img; ?>" alt="<?php the_title(); ?>" />
						</div>

						<div class="fp_cat">

							<?php 
							foreach ($termss as $cat_chr) {
								?>
								<span><?php echo $cat_chr->name;?></span>

								<?php
							}
							?>
						</div>

						<div class="fp_grid_bottom">

							<div class="fp_grid_title_div">
								<div class="wp-post-title fp_grid_title">
									<?php the_title(); ?>
								</div>
							</div>

							

							<div class="post_feature_text">
								<?php //the_excerpt();
								 my_excerpt(10);?>
							</div>

						</div>
					</div>

					<div class="fp_grid_onhover">

						<?php 
						foreach ($termss as $cat_chr) {
							?>
							<div class="fp_grid_cat_hover"><span><?php echo $cat_chr->name;?></span></div>

							<?php
						}
						?>


						<div class="fp_grid_title_hover">
								<?php the_title(); ?>
						</div>

						

						<div class="pf_grid_text_hover">
							<?php //the_excerpt();
							my_excerpt(10);
							?>
						</div>

						<div class="btn_div pf_read_more" style="text-align: center;"><a target="_blank" href="<?php the_permalink(); ?>" class="btn_links btn_link1">READ MORE</a></div>

					
					</div>

						
					</div>
					</div>
				</div>
			</div>

				  <?php
				  $i++;
				endwhile;
				?>
          
<?php
}
else{
?>

<div class="no_result">
	<?php echo "No Post Found"; ?>
</div>




	<?php
}
?>
<div class="clearfloat"></div>
</div>
</div>
<?php
$resp_content = ob_get_clean();


	return $resp_content;
}

function event_search_params(){

	// $act_url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

	// 	preg_match("/[^\/]+$/", $act_url, $matches);
	// 	$last_word = $matches[2]; // test
	// 	var_dump($last_word);

	// echo $last_word;

	$category = get_queried_object(); 
	$category_slug = $category->slug;

?>

	<div class="event_search_div">

		<form id="event_search_form">
		
		<div class="event_date_box event_filter_params" id="sandbox-container">
			<label class="events_srch_label">Events in</label>
			<input id="theeventdate" class="event_search_enter" data-date-format="yyyy-mm-dd" type="text" placeholder="Date">
		</div>

<?php
		$_GET['search_term'];


		?>


		<div class="event_search_box event_filter_params">
			<label class="events_srch_label">Search</label>
			<input type="text" id="event_search_term" class="event_search_enter" placeholder="Search" value="<?php if($_GET['search_term']){ echo $_GET['search_term'];}?>">
		</div>
		<?php

	$taxonomy = 'event-category';
	$terms = get_terms($taxonomy);


	if ( $terms && !is_wp_error( $terms ) ) :
	?>
		<div class="event_cat_box event_filter_params">
			<label class="events_srch_label">Category</label>
	    	<select id="event_category_name">
		          <option value="">FILTER BY CATEGORY</option>
		            		<?php
		         foreach ( $terms as $term ) { ?>
		           <!--  <li><a href="<?php //echo get_term_link($term->slug, $taxonomy); ?>"><?php echo $term->name; ?></a></li> -->
		            <option <?php if($category_slug == $term->slug){ echo 'selected';} ?> event-cat-slug="<?php echo $term->slug; ?>" value="<?php echo $term->term_id; ?>"><?php echo $term->name; ?></option>
		        <?php } ?>
		    </select>
	    </div>
	<?php endif;

	?>
		<div class="event_search_btn event_filter_params">
			<!-- <a href="javascript:void(0)">Find Events</a> -->
			<label class="events_srch_label" style="visibility: hidden;">Search</label>
			<button type="button" id="filter_event_btn" class="btn">Find Events</button>
		</div>

		<div class="event_reset_btn event_filter_params">
			<!-- <a href="javascript:void(0)">Find Events</a> -->
			<label class="events_srch_label" style="visibility: hidden;">Search</label>
			<button type="button" id="filter_reset_btn" class="btn">Reset</button>
		</div>

		<div class="clearfloat"></div>
	</form>
	</div>
	

<?php


}

add_shortcode( 'eventSearchParams', 'event_search_params' );


function main_search_form(){

	// $act_url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

	// 	preg_match("/[^\/]+$/", $act_url, $matches);
	// 	$last_word = $matches[2]; // test
	// 	var_dump($last_word);

	// echo $last_word;


?>

	<div class="main_search_div">
<?php
		$_GET['search_term'];

		?>


        <form role="search" method="get" class="main_search_form" action="http://eda.prosaverapp.com">
          <label for="search-form-5abb7c2bb3051"></label><input type="search" class="main_search_enter" placeholder="Search" value="" name="s" title="Search for:"><button type="submit" class="common_search_btn">Search</button>
        </form>               


<!-- 
		<div class="main_search_box main_filter_params">
			<input type="text" id="main_search_term" class="main_search_enter" placeholder="Search" value="<?php //if($_GET['search_term']){ //echo $_GET['search_term'];}?>">
		</div>
	
		<div class="main_search_btn main_filter_params">
			<button type="button" id="filter_event_btn" class="btn">Search</button>
		</div> -->

		<div class="clearfloat"></div>
	<hr class="search_hr">
	</div>
	
<?php


}

add_shortcode( 'mainSearchForm', 'main_search_form' );


function main_search_result(){

	// $act_url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

	// 	preg_match("/[^\/]+$/", $act_url, $matches);
	// 	$last_word = $matches[2]; // test
	// 	var_dump($last_word);

	// echo $last_word;
	ob_start();

	$post_no = 5;
 $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
// $args = array('post_type'=>'post', 'post_status'=>'publish', 'posts_per_page'=>$post_no,'paged' => $paged,);

  $search_term = 'find a church';

$args = array('post_type'=>'page', 'post_status'=>'publish', 'posts_per_page'=>$post_no,'paged' => $paged,);

if(!empty($search_term)){

  $args['s'] = $search_term;
  

 }


$wpb_all_query = new WP_Query($args); 
?>
 
<?php if ( $wpb_all_query->have_posts() ) : ?>
 

 
    <!-- the loop -->
    <?php while ( $wpb_all_query->have_posts() ) : $wpb_all_query->the_post();

          //$ch_img = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' ); 
// ob_start();  // run the_content() through the Output Buffer
// the_content();
// $html = ob_get_clean(); // Store the formatted HTML
// $content = new DomDocument(); // Create a new DOMDocument Object to work with our HTML
// libxml_use_internal_errors(true);
// $content->loadHTML( $html ); // Load the $html into the new object
// $finder = new DomXPath( $content );  // Create a new DOMXPath object with our $content object that we will evaluate
// $classname = 'vc_col-sm-8';
// $item_list = $finder->query("//*[contains(@class, '$classname')]");
//var_dump($item_list);
     ?>

     <div class="blog_posts_div blog_posts_<?php echo $post->ID; ?>">
        

            <div class="blog_post_title">
              <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </div>

            <div class="blog_post_description">
              <?php //the_content();
    //           for( $i = 0; $i < $item_list->length; $i++ ){
    // $value = $item_list->item( $i )->nodeValue;
    // echo $value;
    //       }

//               if($item_list->length > 0) {
//   $node = $item_list->item(0);
//   echo "{$node->nodeName} - {$node->nodeValue}";
// }

      //echo $item_list;
      ?>
            </div>

        </div>
    <?php endwhile; ?>
    <!-- end of the loop -->

 
    <?php wp_reset_postdata(); 

if (function_exists("pagination")) {
    pagination($wpb_all_query->max_num_pages);
} 


    ?>

    <div class="post-nav-links">
                        <div class="prev-post"><?php //previous_posts_link('Newer', $wpb_all_query->max_num_pages ); ?></div>
                        <div class="next-post"><?php //next_posts_link('Older', $wpb_all_query->max_num_pages ); ?></div>
                    </div>
 
<?php else : ?>
    <p><?php _e( 'Sorry, no search matched your criteria.' ); ?></p>
<?php endif; 

$resp_content = ob_get_clean();


	return $resp_content;

}

add_shortcode( 'mainSearchResult', 'main_search_result' );


function change_search_url_rewrite() {
    if ( is_search() && ! empty( $_GET['s'] ) ) {
        wp_redirect( home_url( "/search/" ) . urlencode( get_query_var( 's' ) ) );
        exit();
    }   
}
add_action( 'template_redirect', 'change_search_url_rewrite' );


function torque_breadcrumbs() {
	/* Breadcrumbs code will go here */
 
  $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
  // $delimiter = '&raquo;'; // delimiter between crumbs
  $delimiter = '<span class="crumb_separate">&gt;</span>'; // delimiter between crumbs
  $home = 'Home'; // text for the 'Home' link
  $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
  $before = '<span class="current">'; // tag before the current crumb
  $after = '</span>'; // tag after the current crumb
 
  global $post;
  $homeLink = get_bloginfo('url');
 
  if (is_home() || is_front_page()) {
 
    if ($showOnHome == 1) echo '<div id="crumbs"><a href="' . $homeLink . '">' . $home . '</a></div>';
 
  } else {
 
    //echo '<div id="crumbs" class="custom_breadcrumb"><a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';

    echo '<div id="crumbs" class="custom_breadcrumb">';
 
    if ( is_category() ) {
      $thisCat = get_category(get_query_var('cat'), false);
      if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
      echo $before . 'Archive by category "' . single_cat_title('', false) . '"' . $after;
 
    } elseif ( is_search() ) {
      echo $before . 'Search results for "' . get_search_query() . '"' . $after;
 
    } elseif ( is_day() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('d') . $after;
 
    } elseif ( is_month() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('F') . $after;
 
    } elseif ( is_year() ) {
      echo $before . get_the_time('Y') . $after;
 
    } elseif ( is_single() && !is_attachment() ) {
      if ( get_post_type() != 'post' ) {
        $post_type = get_post_type_object(get_post_type());
        $slug = $post_type->rewrite;
        echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
        if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
      } else {
        $cat = get_the_category(); $cat = $cat[0];
        $cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
        if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
        echo $cats;
        if ($showCurrent == 1) echo $before . get_the_title() . $after;
      }
 
    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
      $post_type = get_post_type_object(get_post_type());
      echo $before . $post_type->labels->singular_name . $after;
 
    } elseif ( is_attachment() ) {
      $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
      if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
 
    } elseif ( is_page() && !$post->post_parent ) {
      if ($showCurrent == 1) echo $before . get_the_title() . $after;
 
    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      for ($i = 0; $i < count($breadcrumbs); $i++) {
        echo $breadcrumbs[$i];
        if ($i != count($breadcrumbs)-1) echo ' ' . $delimiter . ' ';
      }
      if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
 
    } elseif ( is_tag() ) {
      echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;
 
    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $before . 'Articles posted by ' . $userdata->display_name . $after;
 
    } elseif ( is_404() ) {
      echo $before . 'Error 404' . $after;
    }
 
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __('Page') . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
 
    echo '</div>';
 
  }

}

add_shortcode( 'dynamicBreadcrumb', 'torque_breadcrumbs' );

function my_dynamic_sidebar($vars) {
 if ( is_active_sidebar( 'custom-side-bar' ) ) : ?>
    <?php dynamic_sidebar( 'custom-side-bar' ); ?>
<?php endif; 
}

add_shortcode( 'dynamicSidebar', 'my_dynamic_sidebar' );


function my_dynamic_title(){

	$category = get_queried_object(); 
	$category_slug = $category->slug;

	if(!empty($_GET['event_date'])){
		$newDate = date("F j, Y", strtotime($_GET['event_date']));
	}
	?>
	<div class="custom_top_heading dynamic_title_heading">
		<?php
		if(!empty($_GET['event_date']) && !empty($_GET['search_term'])){

			echo "Search Result for : ". $_GET['search_term'].' on '.$newDate;

		}elseif(!empty($_GET['event_date'])){

			echo "Search Result for : ". $newDate;

		}elseif(!empty($_GET['search_term'])){

			echo "Search Result for : ". $_GET['search_term'];

		}elseif(!empty($category_slug)){
			echo "Category : ".$category->name;
		}else{
			echo "Search";
		}

	?>
	</div>
<?php
}


function get_event_list(){

	// $event_srch_term = $_REQUEST['event_search_term'];
// ob_start();

// 	echo do_shortcode("[eo_fullcalendar headerLeft='prev,next today' headerCenter='title' headerRight='month,agendaWeek']");

//  //return my_event_calendar_callback();
// $resp_content = ob_get_clean();
// echo json_encode(['content'=>$resp_content]);
// //echo $resp_content;
// die();

}


function wpdocs_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'wpdocs_excerpt_more' );


class Excerpt {

  // Default length (by WordPress)
  public static $length = 55;

  // So you can call: my_excerpt('short');
  public static $types = array(
      'short' => 25,
      'regular' => 55,
      'long' => 100
    );

  /**
   * Sets the length for the excerpt,
   * then it adds the WP filter
   * And automatically calls the_excerpt();
   *
   * @param string $new_length 
   * @return void
   * @author Baylor Rae'
   */
  public static function length($new_length = 55) {
    Excerpt::$length = $new_length;

    add_filter('excerpt_length', 'Excerpt::new_length');

    Excerpt::output();
  }

  // Tells WP the new length
  public static function new_length() {
    if( isset(Excerpt::$types[Excerpt::$length]) )
      return Excerpt::$types[Excerpt::$length];
    else
      return Excerpt::$length;
  }

  // Echoes out the excerpt
  public static function output() {
    the_excerpt();
  }

}

// An alias to the class
function my_excerpt($length = 55) {
  Excerpt::length($length);
}

add_filter( 'eventorganiser_fullcalendar_query', 'my_event_calendar_callback', 10, 1 );

function my_event_calendar_callback( $query ){

	//$event_srch_term = $_REQUEST['event_search_term'];

	// $category = get_queried_object(); 
	// $category_slug = $category->slug;



	$event_srch_term = $_REQUEST['search_term'];
$category_slug = $_REQUEST['category'];
	//var_dump($event_srch_term);
	//die();






	 $query = array(
	 	'post_type' => 'event',
	    // 's' => 'dismantling',
	    's' => $event_srch_term,
	 	);

	 if($category_slug){
	 	// var_dump($category_slug);

	 	// die();
	 	// $query['tax_query'] = array(
   //              array(
   //                   'taxonomy' => 'event-category',
   //                   'field' => 'slug',
   //                   'terms' => $category_slug,
   //              )
   //         );
	 }

// my_event_calendar_callback($args);

	//Change first value and return it
	return $query;

}

// function prefix_my_custom_admin_scripts() {
//     wp_enqueue_media();
// }
// add_action('wp_enqueue_scripts', 'prefix_my_custom_admin_scripts');


require_once(ABSPATH . "wp-admin" . '/includes/image.php');
require_once(ABSPATH . "wp-admin" . '/includes/file.php');
require_once(ABSPATH . "wp-admin" . '/includes/media.php');


function ty_front_end_form() {

	$success_event = '';

	if($_POST){
		$success_event = ty_save_post_data();
	}

	?>

	

	<?php //echo $success_event;

$error_msg = '';
if(!empty($success_event) && $success_event==1){
	//echo home_url();

	$error_msg = 'Event has been submited successfully';
	?>

	<div class="event_error_msg error_hide_msg" style="color: green;">
		<?php echo $error_msg;?>
	</div>
<?php

}elseif(!empty($success_event) && $success_event==0){

	$error_msg = 'Event submit fail!!';
?>
	<div class="event_error_msg error_hide_msg" style="color: red;">

		<?php echo $error_msg;?>

	</div>
<?php
}
	?>

 


<!-- <div class="col-md-1">
     
    </div> -->
    <!-- <div class="col-md-8" style="float: left;"> -->
      
   


    
<form id="submit-event-form" class="submit_post_frontend_form" name="submit-event-form" method="post" action="" enctype="multipart/form-data">
 <div class="col-md-8" style="float: left;">
<!-- <p><label for="title">Event Title</label><br /> -->
	<div class="event_title_div">
		<input type="text" id="event_title" value="" placeholder="Enter Title Here" tabindex="1" name="event_title" />
		<div class="event_title_error error_hide_msg" style="color: red;"></div>
	</div> 
	 

	<div class="event_description_div">
		<!-- <label for="description">Event Description</label> -->
	 
		<!-- <textarea id="event_content" tabindex="3" name="event_content" cols="50" rows="6"></textarea> -->
		 

		<?php 

		$content = '';

		$settings = array(
			'media_buttons' => true,
			'drag_drop_upload' => true,
			'tinymce' => true
		);
		$editor_id = 'event_content';
		wp_editor( $content, $editor_id, $settings);
		?>

		
	</div>

	<div class="event_details_div">

		<div class="event_title_labels">Event Details</div>

 		<div class="event_start_date_time">

 			<div class="col-sm-3" style="float: left;">

	 			<div class="e_detail_span e_detail_child">
					<span>Start Date/Time :</span>
				</div>

			</div>

			<div class="col-sm-9" style="float: left;">

				<div class="e_start_field e_detail_child">
					<input type="text" placeholder="Event Start Date" data-date-format="yyyy-mm-dd" id="e_start_date" name="e_start_date">
				</div>

				<div class="e_start_field e_detail_child">
					<input type="text" placeholder="Event Start Time" id="e_start_time" name="e_start_time">
				</div>

			</div>
			<div class="clearfloat"></div>
 		</div>

 		<div class="event_start_end_time">

 			<div class="col-sm-3" style="float: left;">

	 			<div class="e_detail_span e_detail_child">
					<span>End Date/Time :</span>
				</div>

			</div>

			<div class="col-sm-9" style="float: left;">

				<div class="e_end_field e_detail_child">
					<input type="text" placeholder="Event End Date"  data-date-format="yyyy-mm-dd" id="e_end_date" name="e_end_date">
				</div>

				<div class="e_end_field e_detail_child">
					<input type="text" placeholder="Event End Time" id="e_end_time" name="e_end_time">
				</div>


			</div>

			<div class="clearfloat"></div>
 		</div>


		<div class="event_venue_div">

			<div class="event_title_labels">Event Venue Details</div>

			<div class="col-sm-3" style="float: left;">

				<div class="e_detail_span e_detail_child">
					<span>Venue Name :</span>
				</div>
				<div class="clearfloat"></div>
			</div>

			<div class="col-sm-9" style="float: left;">

				<div class="e_venue_field e_detail_child">
					<input type="text" id="e_venue_name" name="e_venue_name">
				</div>
			</div>

			<div class="col-sm-3" style="float: left;">
				
				<div class="e_detail_span e_detail_child">
					<span>Address :</span>
				</div>
				<div class="clearfloat"></div>
			</div>

			<div class="col-sm-9" style="float: left;">
				<div class="e_venue_field e_detail_child">
					<input type="text" id="e_venue_addr" name="e_venue_addr">
				</div>
			</div>

			<div class="col-sm-3" style="float: left;">
				
				<div class="e_detail_span e_detail_child">
					<span>City :</span>
				</div>

				<div class="clearfloat"></div>
			</div>

			<div class="col-sm-9" style="float: left;">

				<div class="e_venue_field e_detail_child">
					<input type="text" id="e_venue_city" name="e_venue_city">
				</div>
			</div>


			<div class="col-sm-3" style="float: left;">
				<div class="e_detail_span e_detail_child">
					<span>State/Province :</span>
				</div>
				<div class="clearfloat"></div>
			</div>

			<div class="col-sm-9" style="float: left;">

				<div class="e_venue_field e_detail_child">
					<input type="text" id="e_venue_state_province" name="e_venue_state_province">
				</div>

			</div>

			<div class="col-sm-3" style="float: left;">
				<div class="e_detail_span e_detail_child">
					<span>Post Code :</span>
				</div>
				<div class="clearfloat"></div>
			</div>

			<div class="col-sm-9" style="float: left;">

				<div class="e_venue_field e_detail_child">
					<input type="text" id="e_venue_postcode" name="e_venue_postcode">
				</div>
				<div class="clearfloat"></div>

			</div>

			<div class="col-sm-3" style="float: left;">
				<div class="e_detail_span e_detail_child">
					<span>Country :</span>
				</div>
				<div class="clearfloat"></div>
			</div>

			<div class="col-sm-9" style="float: left;">

				<div class="e_venue_field e_detail_child">
					<input type="text" id="e_venue_country" name="e_venue_country">
				</div>
				<div class="clearfloat"></div>
			</div>

			<div class="clearfloat"></div>

		</div>

	</div>

	<div class="event_submit_div">

		<input type="submit" value="Submit Event" tabindex="6" id="submit" name="submit" />
	</div>


</div>

<div class="col-md-4" style="float: left;">


	<div class="event_category_div">

		<div class="event_title_labels">Event Category</div>
	 
	<!-- <p><?php //wp_dropdown_categories( 'show_option_none=Category&tab_index=4&taxonomy=event-category' ); ?></p> -->

		<div class="event_category_content">
			<ul>
		<?php $terms = get_terms( array(
						    'taxonomy' => 'event-category',
						    'hide_empty' => false,
						) ); 

					
    		foreach ($terms as $taxonomy) {
    		 	// var_dump($key);
    		 	// var_dump($value);
    		 	$cat_slug = $taxonomy->slug;
    		 	$cat_name = $taxonomy->name;
    		 	$cat_count = $taxonomy->count;
    		 	$cat_id = $taxonomy->term_id;
    		 	?>
    		 	<li><input type="checkbox" class="event_categories" name="event_cat[]" value="<?php echo $cat_id; ?>"><?php echo $cat_name;?></li>
    		 
    		 <?php } ?>	
    		</ul>
    	</div>
    </div>
	        	
 	<div class="event_tag_div">

		<div class="event_title_labels">Event Tags</div>
		 
		<input type="text" value="" tabindex="5" placeholder="Add tags" name="event_tags" id="event_tags" />
	</div>
 
<!-- <p><input type="submit" value="Publish Event" tabindex="6" id="submit" name="submit" /></p> -->

<!-- <p><input type="file" name="event_featured_img" id="event_featured_img" size="50"><p> -->

	<div class="featured_image_div">

		<div class="event_title_labels">Featured Image</div>

		<div class="featured_img_display"><img id='img-upload' /></div> 
        <div class="input-group">
            <span class="input-group-btn">
                <span class="btn btn-default btn-file browse_button">
                    <span class="fimag_upload_text">Upload</span> <input type="file" name="event_featured_img" id="event_featured_img">
                </span>
            </span>
            <input style="display: none;" type="text" id="image_text" class="form-control" readonly>
        </div>
        
    </div>
				    
				    
 
<input type="hidden" name="post-type" id="post-type" value="event" />
 
<input type="hidden" name="action" value="custom_posts" />
 
<?php wp_nonce_field( 'name_of_my_action','name_of_nonce_field' ); ?>
 </p>
</div>
</form>
<!-- </div> -->
 
    <!-- <div class="col-md-3">
      <p>Sed ut perspiciatis...</p>
    </div> -->
<!-- <div class="col-md-1">
      
    </div> -->
<?php
 
 
}
add_shortcode('submit-event-form','ty_front_end_form');


function ty_save_post_data() {

if ( empty($_POST) || !wp_verify_nonce($_POST['name_of_nonce_field'],'name_of_my_action') )
{
return 'Sorry, your nonce did not verify.';

}else{

// Do some minor form validation to make sure there is content
if (isset ($_POST['event_title'])) {
$title =  $_POST['event_title'];
} else {
echo 'Please enter a title';
exit;
}
if (isset ($_POST['event_content'])) {
$description = $_POST['event_content'];
} else {
echo 'Please enter the content';
exit;
}

if(isset($_POST['event_tags'])){
$tags = $_POST['event_tags'];
}else{
$tags = "";
}

if(isset($_POST['e_start_date'])){
	$start_date = $_POST['e_start_date'];
}else{
	$start_date = "";
}

if(isset($_POST['e_end_date'])){
	$end_date = $_POST['e_end_date'];
}else{
	$end_date = "";
}

if(isset($_POST['e_start_time'])){
	$start_time = $_POST['e_start_time'];
}else{
	$start_time = "";
}

if(isset($_POST['e_end_time'])){
	$end_time = $_POST['e_end_time'];
}else{
	$end_time = "";
}

if(!empty($start_date) && !empty($start_time)){
	$start_date_time = $start_date.' '.date("H:i:s", strtotime($start_time));
}

if(!empty($end_date) && !empty($end_time)){
	$end_date_time = $end_date.' '.date("H:i:s", strtotime($end_time));
}


if(!empty($_POST['e_venue_name'])){
	$venue_name = $_POST['e_venue_name'];
}

if(!empty($_POST['e_venue_addr'])){
	$venue_addr = $_POST['e_venue_addr'];
}

if(!empty($_POST['e_venue_city'])){
	$venue_city = $_POST['e_venue_city'];
}

if(!empty($_POST['e_venue_state_province'])){
	$venue_state_province = $_POST['e_venue_state_province'];
}

if(!empty($_POST['e_venue_postcode'])){
	$venue_postcode = $_POST['e_venue_postcode'];
}

if(!empty($_POST['e_venue_country'])){
	$venue_country = $_POST['e_venue_country'];
}

// Add the content of the form to $post as an array
$post = array(
'post_title' => wp_strip_all_tags( $title ),
'post_content' => $description,
'post_category' => $_POST['event_cat'],  // Usable for custom taxonomies too
'tags_input' => $_POST['event_tags'],
'post_status' => 'draft',            // Choose: publish, preview, future, etc.
'post_type' => $_POST['post-type']  // Use a custom post type if you want to
);

$pid = wp_insert_post($post);  // http://codex.wordpress.org/Function_Reference/wp_insert_post

$attach_id = media_handle_upload( 'event_featured_img', $pid);

if(!empty($attach_id)){
	update_post_meta($pid,'_thumbnail_id',$attach_id);
}

// if ( is_wp_error( $attach_id ) ) {
// 		// There was an error uploading the image.
// 		echo "There was an error uploading the image";
// 		die();
// 	} else {
// 		echo "The image was uploaded successfully!";
// 	}
// set_post_thumbnail( $pid, $attach_id );
// if ( isset( $post['tags_input'] ) && is_object_in_taxonomy( $_POST['post-type'], 'event-tag' ) ) {
        wp_set_post_terms( $pid, $post['tags_input'], 'event-tag');
        wp_set_post_terms( $pid, $post['post_category'], 'event-category');

        if(!empty($venue_name)){
			$venue_id = wp_set_post_terms( $pid, $venue_name, 'event-venue');
		}

		if(!empty($venue_id[0])){
			
			if(!empty($venue_addr)){
				add_metadata('eo_venue', $venue_id[0], '_address', $venue_addr);
			}
			if(!empty($venue_city)){
				add_metadata('eo_venue', $venue_id[0], '_city', $venue_city);
			}
			if(!empty($venue_state_province)){
				add_metadata('eo_venue', $venue_id[0], '_state', $venue_state_province);
			}
			if(!empty($venue_postcode)){
				add_metadata('eo_venue', $venue_id[0], '_postcode', $venue_postcode);
			}
			if(!empty($venue_country)){
				add_metadata('eo_venue', $venue_id[0], '_country', $venue_country);
			}
		
		}


        if(!empty($start_date_time)){
	        add_post_meta($pid, '_eventorganiser_schedule_start_start', $start_date_time);
	    }

	    if(!empty($end_date_time)){
	        add_post_meta($pid, '_eventorganiser_schedule_start_finish', $end_date_time);
	    }


if ( $pid ) {
	return 1;
}else{
	return 0;
}

//$location = home_url(); // redirect location, should be login page

//echo "<meta http-equiv='refresh' content='0;url=$location' />"; exit;
} // end IF

}


function ty_news_form() {

	$success_event = '';

	if($_POST){
		$success_event = ty_save_news_data();
	}

	?>

	<?php //echo $success_event;

$error_msg = '';
if(!empty($success_event) && $success_event==1){
	//echo home_url();

	$error_msg = 'News has been submited successfully';
	?>

	<div class="event_error_msg error_hide_msg" style="color: green;">
		<?php echo $error_msg;?>
	</div>
<?php

}elseif(!empty($success_event) && $success_event==0){

	$error_msg = 'News submit fail!!';
?>
	<div class="event_error_msg error_hide_msg" style="color: red;">

		<?php echo $error_msg;?>

	</div>
<?php
}
	?>


<!-- <div class="col-md-1">
     
    </div> -->
    <!-- <div class="col-md-8" style="float: left;"> -->
      
   


    
<form id="submit-news-form" class="submit_post_frontend_form" name="submit-news-form" method="post" action="" enctype="multipart/form-data">
 <div class="col-md-8" style="float: left;">
<!-- <p><label for="title">Event Title</label><br /> -->
	<div class="event_title_div">
		<input type="text" id="event_title" value="" placeholder="Enter Title Here" tabindex="1" name="event_title" />
		<div class="event_title_error error_hide_msg" style="color: red;"></div>
	</div> 
	 

	<div class="event_description_div">
		<!-- <label for="description">Event Description</label> -->
	 
		<!-- <textarea id="event_content" tabindex="3" name="event_content" cols="50" rows="6"></textarea> -->
		 

		<?php 

		$content = '';

		$settings = array(
			'media_buttons' => false,
			'drag_drop_upload' => true,
			'tinymce' => true
		);
		$editor_id = 'news_content';
		wp_editor( $content, $editor_id, $settings);
		?>

		
	</div>

	<div class="event_details_div">

		
	</div>

	<div class="event_submit_div">

		<input type="submit" value="Submit News" tabindex="6" id="submit" name="submit" />
	</div>


</div>

<div class="col-md-4" style="float: left;">


	<div class="event_category_div">

		<div class="event_title_labels">News Category</div>
	 
	<!-- <p><?php //wp_dropdown_categories( 'show_option_none=Category&tab_index=4&taxonomy=event-category' ); ?></p> -->

		<div class="event_category_content">
			<ul>
		<?php $terms = get_terms( array(
						    'taxonomy' => 'category',
						    'hide_empty' => false,
						) ); 

					
    		foreach ($terms as $taxonomy) {
    		 	// var_dump($key);
    		 	// var_dump($value);
    		 	$cat_slug = $taxonomy->slug;
    		 	$cat_name = $taxonomy->name;
    		 	$cat_count = $taxonomy->count;
    		 	$cat_id = $taxonomy->term_id;
    		 	?>
    		 	<li><input type="checkbox" class="event_categories" name="event_cat[]" value="<?php echo $cat_id; ?>"><?php echo $cat_name;?></li>

    		 
    		 <?php } ?>
    		 </ul>	
    	</div>
    </div>
	        	
 	<div class="event_tag_div">

		<div class="event_title_labels">News Tags</div>
		 
		<input type="text" value="" tabindex="5" placeholder="Add tags" name="event_tags" id="event_tags" />
	</div>


	<div class="featured_image_div">

		<div class="event_title_labels">Featured Image</div>

		<div class="featured_img_display"><img id='img-upload' /></div> 
        <div class="input-group">
            <span class="input-group-btn">
                <span class="btn btn-default btn-file browse_button">
                    <span class="fimag_upload_text">Upload</span> <input type="file" name="news_featured_img" id="news_featured_img">
                </span>
            </span>
            <input style="display: none;" type="text" id="image_text" class="form-control" readonly>
        </div>
        
    </div>
				    
				    
 
<input type="hidden" name="post-type" id="post-type" value="post" />
 
<input type="hidden" name="action" value="custom_posts" />
 
<?php wp_nonce_field( 'name_of_my_action','name_of_nonce_field' ); ?>
 </p>
</div>
</form>
<!-- </div> -->
 
    <!-- <div class="col-md-3">
      <p>Sed ut perspiciatis...</p>
    </div> -->
<!-- <div class="col-md-1">
      
    </div> -->
<?php
 
 
}
add_shortcode('submit-news-form','ty_news_form');


function ty_save_news_data() {

if ( empty($_POST) || !wp_verify_nonce($_POST['name_of_nonce_field'],'name_of_my_action') )
{
return 'Sorry, your nonce did not verify.';

}else{

// Do some minor form validation to make sure there is content
if (isset ($_POST['event_title'])) {
$title =  $_POST['event_title'];
} else {
echo 'Please enter a title';
exit;
}
if (isset ($_POST['news_content'])) {
$description = $_POST['news_content'];
} else {
echo 'Please enter the content';
exit;
}

if(isset($_POST['event_tags'])){
$tags = $_POST['event_tags'];
}else{
$tags = "";
}


// $uploaddir = wp_upload_dir();
// $file = $_FILES['news_featured_img' ];
// $uploadfile = $uploaddir['path'] . '/' . basename( $file['name'] );
// // var_dump($uploadfile);
// move_uploaded_file( $file['tmp_name'] , $uploadfile );
// // die();
// $filename = basename( $uploadfile );
// $wp_filetype = wp_check_filetype(basename($filename), null );
// $attachment = array(
// 	'post_mime_type' => $wp_filetype['type'],
// 	'post_title' => preg_replace('/\.[^.]+$/', '', $filename),
// 	'post_content' => '',
// 	'post_status' => 'inherit',
// 	'menu_order' => $_i + 1000
// 	);

// $attach_id = wp_insert_attachment( $attachment, $uploadfile );

// die();

// Add the content of the form to $post as an array
$post = array(
'post_title' => wp_strip_all_tags( $title ),
'post_content' => $description,
'post_category' => $_POST['event_cat'],  // Usable for custom taxonomies too
'tags_input' => $_POST['event_tags'],
'post_status' => 'draft',            // Choose: publish, preview, future, etc.
'post_type' => $_POST['post-type']  // Use a custom post type if you want to
);

$pid = wp_insert_post($post);  // http://codex.wordpress.org/Function_Reference/wp_insert_post

$attach_id = media_handle_upload( 'news_featured_img', $pid);

if(!empty($attach_id)){
	update_post_meta($pid,'_thumbnail_id',$attach_id);
}

// set_post_thumbnail( $pid, $attach_id );
// if ( isset( $post['tags_input'] ) && is_object_in_taxonomy( $_POST['post-type'], 'event-tag' ) ) {
        wp_set_post_terms( $pid, $post['tags_input'], 'event-tag');
        wp_set_post_terms( $pid, $post['post_category'], 'event-category');

        if(!empty($venue_name)){
			$venue_id = wp_set_post_terms( $pid, $venue_name, 'event-venue');
		}

		if(!empty($venue_id[0])){
			
			if(!empty($venue_addr)){
				add_metadata('eo_venue', $venue_id[0], '_address', $venue_addr);
			}
			if(!empty($venue_city)){
				add_metadata('eo_venue', $venue_id[0], '_city', $venue_city);
			}
			if(!empty($venue_state_province)){
				add_metadata('eo_venue', $venue_id[0], '_state', $venue_state_province);
			}
			if(!empty($venue_postcode)){
				add_metadata('eo_venue', $venue_id[0], '_postcode', $venue_postcode);
			}
			if(!empty($venue_country)){
				add_metadata('eo_venue', $venue_id[0], '_country', $venue_country);
			}
		
		}


        if(!empty($start_date_time)){
	        add_post_meta($pid, '_eventorganiser_schedule_start_start', $start_date_time);
	    }

	    if(!empty($end_date_time)){
	        add_post_meta($pid, '_eventorganiser_schedule_start_finish', $end_date_time);
	    }


if ( $pid ) {
	return 1;
}else{
	return 0;
}

//$location = home_url(); // redirect location, should be login page

//echo "<meta http-equiv='refresh' content='0;url=$location' />"; exit;
} // end IF

}




add_shortcode( 'dynamicTitle', 'my_dynamic_title' );
add_shortcode( 'gridBlog', 'grid_blog' );
add_shortcode( 'blogPost', 'blog_posts' );
add_shortcode( 'forFaithPost', 'for_faith_post' );
add_shortcode( 'archivePosts', 'archivePosts' );
add_shortcode( 'blogPostSories', 'blog_posts_stories' );
add_shortcode( 'gridFeatureBlog', 'grid_feature_blog' );
add_shortcode( 'singleFeatureBlog', 'single_feature_blog' );
add_shortcode( 'featuredBlogPosts', 'featured_blog_posts');
add_shortcode( 'gridFaithCarousel', 'grid_faith_carousel' );
add_shortcode( 'inspirationFaithContent', 'inspiration_faith_content' );


?>