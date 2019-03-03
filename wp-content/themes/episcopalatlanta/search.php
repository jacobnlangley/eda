<?php
/**
 * The template for displaying an event-category page
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
get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
       <div class="entry">
            <div class="at-above-post-page addthis_tool" data-url="http://edatl.wpengine.com/search/"></div><section class="vc_section"><div class="vc_row wpb_row vc_row-fluid"><div class="wpb_column vc_column_container vc_col-sm-12"><div class="vc_column-inner "><div class="wpb_wrapper"></div></div></div></div><div class="vc_row wpb_row vc_row-fluid cust_top_banner_div search_banner search_result_banner vc_custom_1521606236417 vc_row-has-fill"><div class="wpb_column vc_column_container vc_col-sm-12"><div class="vc_column-inner "><div class="wpb_wrapper"></div></div></div></div></section><div class="vc_row wpb_row vc_row-fluid sidebar_with_dropdown vc_custom_1519222075957"><div class="wpb_column vc_column_container vc_col-sm-1"><div class="vc_column-inner "><div class="wpb_wrapper"></div></div></div><div class="sidebar_menu_div wpb_column vc_column_container vc_col-sm-3"><div class="vc_column-inner "><div class="wpb_wrapper"><div class="vc_row wpb_row vc_inner vc_row-fluid sidebar_sep_div vc_custom_1519217447864 search_sidebar_vc_custom vc_row-has-fill"><div class="wpb_column vc_column_container vc_col-sm-4"><div class="vc_column-inner "><div class="wpb_wrapper"><div  class="vc_icon_element vc_icon_element-outer comm_icon wpb_animate_when_almost_visible wpb_bounceIn bounceIn vc_icon_element-align-left">
  <div class="vc_icon_element-inner vc_icon_element-color-blue vc_icon_element-size-md vc_icon_element-style- vc_icon_element-background-color-grey">
    <span class="vc_icon_element-icon fa fa-graduation-cap" ></span></div>
</div>
</div></div></div><div class="sidebar_left_cont wpb_column vc_column_container vc_col-sm-8"><div class="vc_column-inner "><div class="wpb_wrapper"><div style="color: #4d307d;text-align: left;font-family:Abril Fatface;font-weight:400;font-style:normal" class="vc_custom_heading find_community_link" ><a href="http://edatl.wpengine.com/churchdirectory/" target=" _blank">Find a Community</a></div></div></div></div></div><div class="vc_row wpb_row vc_inner vc_row-fluid sidebar_sep_div vc_custom_1519217460112 search_sidebar_vc_custom vc_row-has-fill"><div class="wpb_column vc_column_container vc_col-sm-4"><div class="vc_column-inner "><div class="wpb_wrapper"><div   class="vc_icon_element vc_icon_element-outer mail_icon wpb_animate_when_almost_visible wpb_bounceIn bounceIn vc_icon_element-align-left">
  <div class="vc_icon_element-inner vc_icon_element-color-blue vc_icon_element-size-md vc_icon_element-style- vc_icon_element-background-color-grey">
    <span class="vc_icon_element-icon fa fa-envelope" ></span></div>
</div>
</div></div></div><div class="sidebar_left_cont wpb_column vc_column_container vc_col-sm-8"><div class="vc_column-inner "><div class="wpb_wrapper"><div style="color: #4d307d;text-align: left;font-family:Abril Fatface;font-weight:400;font-style:normal" class="vc_custom_heading find_community_link" ><a href="http://edatl.wpengine.com" target=" _blank">Sign Up For Emails</a></div></div></div></div></div></div></div></div><div class="wpb_column vc_column_container vc_col-sm-7"><div class="vc_column-inner "><div class="wpb_wrapper"><div class="vc_row wpb_row vc_inner vc_row-fluid"><div class="wpb_column vc_column_container vc_col-sm-12"><div class="vc_column-inner "><div class="wpb_wrapper"><h2 style="color: #4d307d;text-align: left;font-family:Abril Fatface;font-weight:400;font-style:normal" class="vc_custom_heading" >Search</h2>
  <div class="main_search_div">
  
        <form role="search" method="get" class="main_search_form" action="http://edatl.wpengine.com">
          <label for="search-form-5abb7c2bb3051"></label><input type="search" class="main_search_enter" placeholder="Search" value="" name="s" title="Search for:"><button type="submit" class="common_search_btn">Search</button>
        </form>              

    <div class="clearfloat"></div>
    <div class="main_search_result_div">
      <span class="main_search_span">Search Results for :</span> <?php 
echo get_search_query(); ?>
    </div>
  <!-- </form> -->
  <hr class="search_hr">
  </div>
  

  <div class="wpb_text_column wpb_content_element " >
    <div class="wpb_wrapper">
      <p style="text-align: left;"></p>

    </div>
  </div>

  <div class="wpb_text_column wpb_content_element " >
    <div class="wpb_wrapper">
<?php
//$tag_name = single_cat_title();
/*var_dump($tag->slug);
echo single_tag_title();*/

$post_no = 5;
 $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
 global $wp_query;
// $args = array('post_type'=>'post', 'post_status'=>'publish', 'posts_per_page'=>$post_no,'paged' => $paged,);

  //$search_term = 'hunger';

  // $search_term = $_GET['s'];

// $args = array('post_type'=>'page', 'post_status'=>'publish', 'posts_per_page'=>$post_no,'paged' => $paged,);

// if(!empty($search_term)){

//   $args['s'] = $search_term;
  

//  }

// $wpb_all_query = new WP_Query($args); 
if (have_posts()) : while (have_posts()) : the_post();
?>
 
<?php //if ( $wpb_all_query->have_posts() ) : ?>
 

 
    <!-- the loop -->
    <?php //while ( $wpb_all_query->have_posts() ) : $wpb_all_query->the_post();

          //$ch_img = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' ); 
// ob_start();  // run the_content() through the Output Buffer
// the_content();
// $html = ob_get_clean(); // Store the formatted HTML
// $content = new DomDocument(); // Create a new DOMDocument Object to work with our HTML
// libxml_use_internal_errors(true);
// $content->loadHTML( $html ); // Load the $html into the new object
// $finder = new DomXPath( $content );  // Create a new DOMXPath object with our $content object that we will evaluate
// $classname = 'wpb_text_column wpb_content_element';
// $item_list = $finder->query("//*[contains(@class, '$classname')]");
// var_dump($item_list);
     ?>

     <div class="blog_posts_div blog_posts_<?php echo $post->ID; ?>">
        

            <div class="blog_post_title">
              <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </div>

            <div class="blog_post_description">
              <?php 
              the_excerpt();

              //the_content();
    //           for( $i = 0; $i < $item_list->length; $i++ ){
    // $value = $item_list->item( $i )->nodeValue;
    // // echo $value;
    // // $value = (strlen($value) > 45) ? substr($value,0,10).'...' : $value;
    // $value = (strlen($value) > 13) ? substr($value,0,100) : $value;
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
    //pagination($wpb_all_query->max_num_pages);
} 


    ?>

   <div class="my-post-nav-links">
                        <div class="my-prev-post"><?php previous_posts_link('< PREVIOUS PAGE', $wp_query->max_num_pages ); ?></div>
                        <div class="my-next-post"><?php next_posts_link(' NEXT PAGE >', $wp_query->max_num_pages ); ?></div>
                        <div class="clearfloat"></div>
                    </div>
 
<?php else : ?>
    <p><?php _e( 'Sorry, no search matched your criteria.' ); ?></p>
<?php endif; 

?>

    </div>
  </div>
</div></div></div></div></div></div></div><div class="wpb_column vc_column_container vc_col-sm-1"><div class="vc_column-inner "><div class="wpb_wrapper"></div></div></div></div>
<!-- AddThis Advanced Settings above via filter on the_content --><!-- AddThis Advanced Settings below via filter on the_content --><!-- AddThis Advanced Settings generic via filter on the_content --><!-- AddThis Share Buttons above via filter on the_content --><!-- AddThis Share Buttons below via filter on the_content --><div class="at-below-post-page addthis_tool" data-url="http://edatl.wpengine.com/search/"></div><!-- AddThis Share Buttons generic via filter on the_content -->        </div><!-- entry -->
</main>
</div>
<?php

get_footer();