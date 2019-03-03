<?php
/*
Template Name: Post Single Page
*/

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			 <div class="entry">
            <div class="at-above-post-page addthis_tool" data-url="http://eda.prosaverapp.com/news/"></div><div class="vc_row wpb_row vc_row-fluid"><div class="wpb_column vc_column_container vc_col-sm-12"><div class="vc_column-inner "><div class="wpb_wrapper"></div></div></div></div>
            <div class="vc_row wpb_row vc_row-fluid blog_news_main_container demo-container"><div class="wpb_column vc_column_container vc_col-sm-12"><div class="vc_column-inner "><div class="wpb_wrapper">
	<div class="wpb_text_column wpb_content_element " >
		<div class="wpb_wrapper">
		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			/*
			 * Include the post format-specific template for the content. If you want to
			 * use this in a child theme, then include a file called content-___.php
			 * (where ___ is the post format) and that will be used instead.
			 */
			$ch_img = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' ); 
			$purchase_link = get_post_meta($post->ID, 'custom_purchase_link', true); 

			
			?>


    
     <div class="blog_single_div blog_posts_single_<?php echo $post->ID; ?>">

     	<div class="blog_single_date">
            	<?php echo get_the_date('F j, Y');
            	//$time = human_time_diff(strtotime(get_the_date()));?>
            </div>

     	<div class="blog_single_title">
              <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
            </div>
        
        <div class="blog_single_feature_image">

                <img class="blog_single_img" src="<?php echo $ch_img; ?>">
            </div>

            

            <div class="blog_single_description">
              <?php the_content();?>
            </div>

            <!-- <div class="blog_single_tags"><p><span class="bs_tag_title"></span><?php //the_tags();?></p></div> -->

            <!-- <div class="addthis_inline_share_toolbox"></div> -->
            <div class="share_container_line">
	            <span class="share_title">Share</span><?php echo do_shortcode('[addthis tool="addthis_inline_share_toolbox_dr3u"]'); ?>
	            <div class="clearfloat"></div>
	        </div>

           <?php if(!empty($purchase_link)){ ?>
            <div class="btn_div single_blog_purchase"><a href="<?php echo $purchase_link; ?>" class="btn_links btn_link1">Purchase Book</a></div>
            <?php }?>

        </div>

        
        	

        </div>
        <?php $excluded_terms = array('tag__not_in' => array(129)); ?>
<!-- <div class="singe_event_pagination">		

			<span> <?php //previous_post_link('%link', '<i>Previous Post</i>', false, $excluded_terms); ?> </span> <span style="float: right;" > <?php //next_post_link('%link', '<i>Next Post</i>', false, $excluded_terms); ?> </span>
			<div class="clearfloat"></div>
		</div>
 -->


<div class="single_next_prev_cont">
    <div class="left">
        <?php previous_post_link('%link', '< Previous Post', false, $excluded_terms); ?> 
    </div>
    <div class="right">
        <?php next_post_link('%link', 'Next Post >', false, $excluded_terms); ?> 
    </div>
    <div class="clear"></div>
</div>


			<?php
			// /get_template_part( 'content', get_post_format() );

			// If comments are open or we have at least one comment, load up the comment template.
			// if ( comments_open() || get_comments_number() ) :
			// 	comments_template();
			// endif;

			// Previous/next post navigation.

		// End the loop.
		endwhile;
		?>

		</div>
	</div>
</div></div>
<div class="clearfloat"></div>
</div>
<!-- AddThis Advanced Settings above via filter on the_content --><!-- AddThis Advanced Settings below via filter on the_content --><!-- AddThis Share Buttons above via filter on the_content --><!-- AddThis Share Buttons below via filter on the_content --><div class="at-below-post-page addthis_tool" data-url="http://eda.prosaverapp.com/news/"></div>        </div><!-- entry -->
</main>
</div>

<?php get_footer(); ?>
