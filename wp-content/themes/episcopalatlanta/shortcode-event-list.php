<?php
/**
 * Event List Widget: Standard List
 *
 * The template is used for displaying the [eo_event] shortcode *unless* it is wrapped around a placeholder: e.g. [eo_event] {placeholder} [/eo_event].
 *
 * You can use this to edit how the output of the eo_event shortcode. See http://docs.wp-event-organiser.com/shortcodes/events-list
 * For the event list widget see widget-event-list.php
 *
 * For a list of available functions (outputting dates, venue details etc) see http://codex.wp-event-organiser.com/
 *
 ***************** NOTICE: *****************
 *  Do not make changes to this file. Any changes made to this file
 * will be overwritten if the plug-in is updated.
 *
 * To overwrite this template with your own, make a copy of it (with the same name)
 * in your theme directory. See http://docs.wp-event-organiser.com/theme-integration for more information
 *
 * WordPress will automatically prioritise the template in your theme directory.
 ***************** NOTICE: *****************
 *
 * @package Event Organiser (plug-in)
 * @since 1.7
 */
global $eo_event_loop,$eo_event_loop_args,$wp_query;

// $big = 999999999; // need an unlikely integer
 
// echo paginate_links( array(
//     'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
//     'format' => '?paged=%#%',
//     'current' => max( 1, get_query_var('paged') ),
//     'total' => 1
// ) );

//The list ID / classes
$id = ( $eo_event_loop_args['id'] ? 'id="' . $eo_event_loop_args['id'] . '"' : '' );
$classes = $eo_event_loop_args['class'];

 isset( $wp_query->max_num_pages ) ? $wp_query->max_num_pages : 1;

$category = get_queried_object(); 
$category_slug = $category->slug;

// add_filter( 'get_meta_sql', 'get_meta_sql_date', 10, 2 );
$post_no = get_option('posts_per_page');
if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
else { $paged = 1; }

// $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
    'post_type' => 'event',
    'meta_query' => array(),
    'showpastevents'   => true,
    'posts_per_page' => $post_no,
    'paged' => $paged,
);

 if(!empty($_GET['search_term'])){

 	$args['s'] = $_GET['search_term'];

 // 	$args = array(
	//     'post_type' => 'event',
	//     's' => $_GET['search_term'],
	// );
 
	

 }

if(!empty($_GET['event_date'])){


$newDate = date("Y-m-d H:i:s", strtotime($_GET['date']));
	//echo $newDate;

//$args['StartDate'] = $_GET['date'];
// $args['event_end_before'] = $_GET['date'];
// $args['ondate'] = $_GET['date'];

$args['meta_query'][] = array(

 			'relation' => 'AND',
                array(
                     'key' => '_eventorganiser_schedule_start_start',
                     // 'value' => $newDate,
                     'value' => $_GET['event_date'],
                     'compare' => '<=',
                     'type'      => 'DATE'
                ),

                array(
                     'key' => '_eventorganiser_schedule_start_finish',
                     // 'value' => $newDate,
                     'value' => $_GET['event_date'],
                     'compare' => '>=',
                      'type'      => 'DATE'
                ),
            );




// $args['meta_query'][] = 
//                 array(
//                      'key' => '_eventorganiser_schedule_start_start',
//                      'value' => array('2018-03-07 00:00:00', '2018-03-07 23:59:59'),
//                       'compare' => 'BETWEEN',
//             		'type' => 'DATE'
//                 );

 }

  if($category_slug){
 	$args['tax_query'] = array(
                array(
                     'taxonomy' => 'event-category',
                     'field' => 'slug',
                     'terms' => $category_slug,
                )
           );
 }

 // if(!empty($category_slug)){

 // }

 $eo_event_loop = new WP_Query($args);

// remove_filter( 'get_meta_sql', 'get_meta_sql_date', 10, 2 );
// $eo_event_loop_args = array('numberposts'=>2, 'showpastevents'=>true);

// $eo_event_loop = eo_get_events($eo_event_loop_args);

// $eo_event_loop = eo_get_events(array(
//               'numberposts'=>5,
//               'event_start_after'=>'today',
//               'showpastevents'=>true,//Will be deprecated, but set it to true to play it safe.
//          ));

 // if($_REQUEST['test']){
	// 	//var_dump($wp_query);
	// 	echo '<pre>';
	// 	print_r($eo_event_loop);
	// 	print_r($eo_events);
	// 	exit();
	// }

?>

<?php if ( $eo_event_loop->have_posts() ) :  ?>

	<ul <?php echo $id; ?> class="<?php echo esc_attr( $classes );?>" > 

		<?php while ( $eo_event_loop->have_posts() ) :  $eo_event_loop->the_post(); 
		$ch_img = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' ); 
		?>
		 <div class="blog_posts_div blog_posts_<?php echo $post->ID; ?>">
		        
		        <!-- <div class="blog_post_feature_image">

		                <img class="blog_post_img" src="<?php echo $ch_img; ?>">
		                <?php //echo get_the_post_thumbnail( $post->ID, 'large');?>
		            </div> -->
<?php $meta = get_post_meta( get_the_ID() ); ?>
					

					<div class="event_date_time">

						<!-- <li class="<?php echo esc_attr( implode( ' ',$eo_event_classes ) ); ?>" > -->
							<!-- <a href="<?php //echo eo_get_permalink(); ?>"><?php //the_title(); ?></a>  -->
							<?php echo __( '','eventorganiser' ) . ' ' . eo_get_the_start( 'F j, Y' ); ?>
						<!-- </li> -->
					</div>		

					<div class="clearfloat"></div>

		             <div class="blog_post_title">
		              <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		            </div>


		            <div class="event_posts_classes">
						<?php
							//Generate HTML classes for this event
							$eo_event_classes = eo_get_event_classes();

							//For non-all-day events, include time format
							$format = eo_get_event_datetime_format();
						?>
					</div>
					
					
					<div class="clearfloat"></div>
					
			<div class="clearfloat"></div>

			<?php $address = array_filter( eo_get_venue_address() ); ?>

			<?php if(!empty($address)){?>
			<div class="event_addr">

				<!-- <span class="event_addr_span">Address :</span> -->
				<?php
						
			 echo implode( ", ", $address ) . ' <a target="_blank" class="event_custom_map" href="http://maps.google.com?q='.implode( ", ", $address ).'">(map)</a>';
			     ?>
			</div>
			<?php }?>

			<div class="event_list_category">
				<?php $termss = wp_get_post_terms($post->ID, 'event-category');?>
				<?php if ( get_the_terms( get_the_ID(), 'event-category' ) && ! is_wp_error( get_the_terms( get_the_ID(), 'event-category' ) ) ) { ?>
					<li>
						<!-- <span class="event_addr_span"><?php //esc_html_e( 'Categories', 'eventorganiser' ); ?> :</span> --> <?php echo strip_tags(get_the_term_list( get_the_ID(), 'event-category', '', ', ', '' )); ?></li>
				<?php } ?>
			</div>

			<div class="event_map"><?php //echo eo_get_venue_url(); ?></div>
			<div class="clearfloat"></div>
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
            <div class="news_divider"></div>
        </div>
		<?php 
		endwhile; 

		wp_reset_postdata(); 
		?>
		<div class="nav-previous alignleft"><?php //next_posts_link( 'Older posts' ); ?></div>
<div class="nav-next alignright"><?php //previous_posts_link( 'Newer posts' ); ?></div>

<?php
		if (function_exists("pagination")) 
		{
		    //pagination($eo_event_loop->max_num_pages);
		} 
		?>

		<div class="my-post-nav-links">
                        <div class="my-prev-post"><?php previous_posts_link('< PREVIOUS PAGE', $eo_event_loop->max_num_pages ); ?></div>
                        <div class="my-next-post"><?php next_posts_link(' NEXT PAGE >', $eo_event_loop->max_num_pages ); ?></div>
                        <div class="clearfloat"></div>
                    </div>

	</ul>
<?php

//wpbeginner_numeric_posts_nav();

 ?>



<?php elseif ( ! empty( $eo_event_loop_args['no_events'] ) ) :  ?>

	<ul id="<?php echo esc_attr( $id );?>" class="<?php echo esc_attr( $classes );?>" > 
		<li class="eo-no-events" > <?php echo $eo_event_loop_args['no_events']; ?> </li>
	</ul>

<?php endif;

if($eo_event_loop->post_count == 0){
	?>
	<div class="no_event_found no_post_result">
		No Event Found
	</div>
	<?php
}
