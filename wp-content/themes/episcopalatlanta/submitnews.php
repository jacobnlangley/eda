<?php /* Template Name: SubmitNews */ ?>
<?php

get_header();
//echo "Home Page";

// $cust_para = add_query_arg( array(
//     'key1' => '{test}',
//     'key2' => 'value2',
// ));



// $queryURL = parse_url( html_entity_decode( esc_url( add_query_arg( $arr_params ) ) ) );
// parse_str( $queryURL['query'], $getVar );
// $variableNum1 = $getVar['var1'];
// $variableNum2 = $getVar['var2'];
// echo 'Describe yourself: ' . $variableNum1 . '. What do you like most about PHP? ' . $variableNum2;


// {
//   var_dump($queryURL);
// }


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
            <?php

             the_content(); 

             // if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == "event") {

             //  //store our post vars into variables for later use
             //  //now would be a good time to run some basic error checking/validation
             //  //to ensure that data for these values have been set
             //  $title     = $_POST['event_title'];
             //  $content   = $_POST['event_content'];
             //  $post_type = 'event';
             //  $custom_field_1 = $_POST['event_startdate'];
             //  $custom_field_2 = $_POST['event_enddate'];    

             //  //the array of arguements to be inserted with wp_insert_post
             //  $new_post = array(
             //  'post_title'    => $title,
             //  'post_content'  => $content,
             //  'post_status'   => 'draft',          
             //  'post_type'     => $post_type 
             //  );

             //  //insert the the post into database by passing $new_post to wp_insert_post
             //  //store our post ID in a variable $pid
             //  $pid = wp_insert_post($new_post);

             //  //we now use $pid (post id) to help add out post meta data
             //  add_post_meta($pid, 'meta_key', $custom_field_1, true);
             //  add_post_meta($pid, 'meta_key', $custom_field_2, true);

             //  }
             //echo do_shortcode('[custom-post]');
              ?>

<div class="container-fluid event_submit_container">    
  <div class="row content">
      <div class="col-sm-12 text-center"> 
        <?php
        echo do_shortcode('[submit-news-form]');
              ?>

            </div>
          </div>
        </div>
        </div><!-- entry -->
<?php endwhile; ?>
<?php endif; ?>
</main>
</div>
<?php 

get_footer();
?>

   