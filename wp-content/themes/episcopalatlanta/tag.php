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

/*echo "hello";*/

// $category = get_queried_object();

$tag = get_queried_object(); 
$current_tag = single_tag_title("", false);
?>

<?php
//$tag_name = single_cat_title();
/*var_dump($tag->slug);
echo single_tag_title();*/
echo do_shortcode('<p>[vc_row][vc_column][/vc_column][/vc_row][vc_row][vc_column css=".vc_custom_1520332208702 news_tag_back{background-color: #efefef !important;}" el_class="top-black-bg-title"][vc_custom_heading text="News For: '.$current_tag.'" font_container="tag:h2|text_align:center" el_class="custom_top_heading"][/vc_column][/vc_row][vc_row el_class="blog_news_main_container demo-container"][vc_column width="3/4"][vc_column_text][blogPost tag="'.$tag->slug.'"][/vc_column_text][/vc_column][vc_column width="1/4"][vc_row_inner el_class="blog_news_sidebar"][vc_column_inner][vc_custom_heading text="Search"][vc_column_text]<form class="wpr-search-form " role="search" action="http://eda.prosaverapp.com" method="get"><label for="search-form-5a940a5134358"></label><input class="news_or_event_search" title="Search for:" name="s" type="search" value="" placeholder="SEARCH NEWS" /><button class="wpr_submit search-icon mreg" style="display: none;" type="submit"><i class="wpr-icon-search"></i></button></form>[/vc_column_text][vc_column_text]
<div class="news_sidebar_divider"></div>
[/vc_column_text][/vc_column_inner][/vc_row_inner][vc_row_inner el_class="blog_news_sidebar"][vc_column_inner][vc_custom_heading text="Submit"][vc_column_text]
<div class="btn_div" style="text-align: center;"><a class="btn_links news_submit_btn" href="'.get_home_url().'/add-news/'.'">SUBMIT NEWS STORY</a></div>
[/vc_column_text][vc_column_text]
<div class="news_sidebar_divider"></div>
[/vc_column_text][/vc_column_inner][/vc_row_inner][vc_row_inner][vc_column_inner][vc_custom_heading text="All Posts"][vc_column_text el_class="blog_stories_lists"][blogPostSories][/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]</p>');

get_footer();