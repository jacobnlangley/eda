<?php 
// Exit if accessed directly
global $post;
if ( !defined( 'ABSPATH' ) ) exit; ?>
 <div class="post-slides">
	<div class="post-list">
		<div class="post-list-content">
		<div class="wp-medium-5 wpcolumns">
		<div class="post-image-bg">
			<img src="<?php echo $feat_image; ?>" alt="<?php the_title(); ?>" />
			</div>
			
			</div>
			<div class="wp-medium-7 wpcolumns">
			<?php

			$read_more_link = get_post_meta($post->ID, 'read_more_link', true);
			$termss = wp_get_post_terms($post->ID, 'custom_post_category');

			// echo "<pre>";
			// print_r($termss);

			$get_author_id = get_the_author_meta('ID');
					// $get_author_gravatar = get_avatar_url($get_author_id, array('size' => 450));


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

					

						// foreach ($termss as $taxonomy) {
      //               // var_dump($key);
      //               // var_dump($value);
      //               // $cat_slug = $taxonomy->slug;
      //               // $cat_name = $taxonomy->name;
      //               // $cat_count = $taxonomy->count;
      //               $cat_id = $taxonomy->term_id;
      //               echo $cat_id;
                   
		    //         }
			// var_dump($termss);
			 if($showCategory) { 

			 	if($termss[0]->term_id == 46){
			 		?>

			 		<div class="featured-custom-catgory">		
								<?php
								if($post_type == 'location'){

								 	echo 'FEATURED PARISH'; 

								}else{

									echo 'FEATURED';
								}

								 ?>
							</div>


			 	<?php
			 	}else{

			 		?>

			 		<div class="recentpost-categories">		
								<?php echo $cat_list; ?>
							</div>
				<?php

				 	}
				} 
			 	?>

			  <h2 class="wp-post-title">
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</h2>
				<?php if($showDate || $showAuthor)    {  ?>	
			<div class="wp-post-date">		
				<?php  if($showAuthor) { ?> <span><?php  //esc_html_e( 'By', 'wp-responsive-recent-post-slider' ); ?> <?php //the_author(); ?></span>
				<div class="pf_author_name">
											<?php echo $full_name;?>
										</div>
<?php } ?>
				<?php echo ($showAuthor && $showDate) ? '&nbsp;/&nbsp;' : '' ?>
				<?php if($showDate) { echo get_the_date(); } ?>
				</div>
				<?php }   ?>
					<?php if($showContent) {  ?>	
				<div class="wp-post-content">
					<?php
					$customExcerpt = get_the_excerpt();				
					if (has_excerpt($post->ID))  { ?>
						<div class="wp-sub-content"><?php echo $customExcerpt ; ?></div> 
					<?php } else {
						$excerpt = strip_shortcodes(strip_tags(get_the_content())); ?>
					<div class="wp-sub-content"><?php echo wprps_limit_words($excerpt,$words_limit); ?></div>					
					<?php } ?>
					
					<?php

					// /var_dump($post_type);

					 if($showreadmore) { 

					 	if($post_type == 'magazine' || $post_type == 'classes' || $post_type == 'volunteer' || $post_type == 'location'){
					 		$rd_more_text = "Learn More";
					 	}
					 	elseif($post_type == 'testimonial'){
					 		$rd_more_text = "Full Story";
					 	}else{
					 		$rd_more_text = "Read More";
					 	}

					 		?>
						<a class="readmorebtn" target="_blank" href="<?php if($post_type == 'location'){ if(!empty($read_more_link)){ echo $read_more_link;} }else{ the_permalink(); }?>"><?php _e($rd_more_text, 'wp-responsive-recent-post-slider'); ?></a>
					<?php } ?>
					
				</div>
				<?php } ?>
				
				</div>
		</div>
		</div>
		
	</div>