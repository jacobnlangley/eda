<?php
/*
Template Name: Blogs Page
*/
?>
<?php

get_header();

?>
<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
     <?php 
// the query
$wpb_all_query = new WP_Query(array('post_type'=>'post', 'post_status'=>'publish', 'posts_per_page'=>-1)); ?>
 
<?php if ( $wpb_all_query->have_posts() ) : ?>
 
<ul>
 
    <!-- the loop -->
    <?php while ( $wpb_all_query->have_posts() ) : $wpb_all_query->the_post();

          $ch_img = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' ); 

     ?>


        
        <div class="blog_post_feature_image">
                <?php //the_post_thumbnail('thumbnail'); ?>

                <img class="blog_post_img" src="<?php echo $ch_img; ?>">
            </div>

            <div class="blog_post_title">
              <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </div>

            <div class="blog_post_description">
              <?php the_content();?>
            </div>
    <?php endwhile; ?>
    <!-- end of the loop -->
 
</ul>
 
    <?php wp_reset_postdata(); ?>
 
<?php else : ?>
    <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>
    </main>
</div>
<?php 
get_footer();
?>

   