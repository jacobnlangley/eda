<?php 
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit; ?>
 <div class="post-slides">
	<div class="post-content-position">	
		<!-- Content-left/right -->
		<!-- <div class="post-content-left wp-medium-6 wpcolumns"> -->
			<div class="post-content-left wp-medium-12 wpcolumns">
			<div class="recentpost-inner-content">
				<?php if($showCategory) { ?>
						<div class="recentpost-categories">		
								<?php echo $cat_list; ?>
							</div>
						<?php } ?>
					<?php
					if($category == 129){
						?>
					<div class="faith_slider_cat">For Faith</div>

					<h2 class="wp-post-title faith_slider_title">
						<?php the_title(); ?>
					</h2>


					<?php 
					}else{
						?>
						<h2 class="wp-post-title">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h2>

					<?php
					}
					?>
					<?php if($showDate || $showAuthor)    {  ?>	
						<div class="wp-post-date">		
							<?php  if($showAuthor) { ?> <span><?php  esc_html_e( 'By', 'wp-responsive-recent-post-slider' ); ?> <?php the_author(); ?></span><?php } ?>
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
							
							<?php if($showreadmore) { ?>
								<a class="readmorebtn" href="<?php the_permalink(); ?>"><?php _e('Read More', 'wp-responsive-recent-post-slider'); ?></a>
							<?php } ?>
							
						</div>
						<?php } ?>
			</div>
		</div>
		<?php
		if($category == 129){
						?>
		<div class="post-image-bg" style="background: url('<?php echo $feat_image; ?>');">
			<img src="<?php //echo $feat_image; ?>" alt="<?php //the_title(); ?>" />
		</div>
		<?php
			}else{
		?>
			<div class="post-image-bg">
				<img src="<?php echo $feat_image; ?>" alt="<?php the_title(); ?>" />
			</div>
		<?php
		}
		?>
	</div>
</div>