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

<?php
//$tag_name = single_cat_title();
/*var_dump($tag->slug);
echo single_tag_title();*/
echo do_shortcode('[vc_row][vc_column][/vc_column][/vc_row][vc_row el_class="blog_news_main_container demo-container"][vc_column width="3/4"][vc_custom_heading text="News Posts" font_container="tag:h2|text_align:center|color:%23333333" el_class="blog_news_heading"][vc_column_text][archivePosts][/vc_column_text][/vc_column][vc_column width="1/4"][vc_row_inner el_class="blog_news_archive_side"][vc_column_inner][vc_wp_archives title="News Archives" options="count"][/vc_column_inner][/vc_row_inner][vc_row_inner][vc_column_inner][vc_custom_heading text="Thumbnails of Stories"][vc_column_text el_class="blog_stories_lists"][blogPostSories][/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]');

get_footer();