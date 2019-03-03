<?php
/**
 * The template for displaying a single event
 *
 * Please note that since 1.7, this template is not used by default. You can edit the 'event details'
 * by using the event-meta-event-single.php template.
 *
 * Or you can edit the entire single event template by creating a single-event.php template
 * in your theme. You can use this template as a guide.
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
 * @since 1.0.0
 */

//Call the template header
get_header(); ?>

<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="container">
			  <div class="row">
			    <div class="col-md-12">
			    	<div class="backto_all_event">
			    		<a href="<?php echo get_site_url().'/calendar';?>"> All Events</a>
			    	</div>

		<?php while ( have_posts() ) : the_post(); 

		$ch_img = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' ); 
		?>

		<div class="blog_single_div blog_posts_single_<?php echo $post->ID; ?>">

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<header class="entry-header">

				<!-- Display event title -->
				<h1 class="entry-title"><?php the_title(); ?></h1>

			</header><!-- .entry-header -->

			<div class="blog_single_feature_image">

                <img class="blog_single_img" src="<?php echo $ch_img; ?>">
            </div>
	
			<div class="entry-content">
				<!-- Get event information, see template: event-meta-event-single.php -->
				<?php eo_get_template_part( 'event-meta', 'event-single' ); ?>

				<!-- The content or the description of the event-->
				<?php the_content(); ?>
			</div><!-- .entry-content -->

			<?php //echo do_shortcode('[eo_events]%event_venue_address%[/eo_events]');?>

			<?php
	// 		$address = array_filter( eo_get_venue_address() );
 // echo implode( ", ", $address );
     ?>

			</article><!-- #post-<?php the_ID(); ?> -->

			<!-- If comments are enabled, show them -->
			<div class="comments-template">
				<?php //comments_template(); ?>
			</div>		

		</div>

		<!-- <div class="singe_event_pagination">		

			<span> <?php //previous_post_link(); ?> </span> <span style="float: right;" > <?php //next_post_link(); ?> </span>
			<div class="clearfloat"></div>
		</div> -->


<div class="single_next_prev_cont singe_event_pagination">
    <div class="left">
        <?php previous_post_link('%link', '< Previous Post'); ?> 
    </div>
    <div class="right">
        <?php next_post_link('%link', 'Next Post >'); ?> 
    </div>
    <div class="clear"></div>
</div>
<div class="clearfloat"></div>

		<?php endwhile; // end of the loop. ?>

				</div>
 			 
 			</div>
 		</div>
		</main><!-- .site-main -->
	</div><!-- .content-area -->

<!-- Call template footer -->
<?php get_footer();
