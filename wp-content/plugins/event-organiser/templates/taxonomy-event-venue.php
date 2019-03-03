<?php
/**
 * The template for displaying the venue page
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
<?php $venue_id = get_queried_object_id();
	$venue = get_queried_object(); 
	$venue_slug = $venue->slug;
 ?>
<?php
echo do_shortcode('[vc_row el_class="full_calender_container demo-container"][vc_column width="3/4" el_class="custom_event_div"][vc_row_inner el_class="calender_top_section"][vc_column_inner el_class="top_event_title_div" width="1/2"][vc_custom_heading text="GENERAL EVENTS" font_container="tag:h4|text_align:center" link="url:https%3A%2F%2Fconnecting.episcopalatlanta.org%2Fevents%2F|||" el_class="top_event_heading"][/vc_column_inner][vc_column_inner el_class="top_event_title_div" width="1/2"][vc_custom_heading text="COMPANY CALENDAR" font_container="tag:h4|text_align:center" link="url:http%3A%2F%2Fmagentoshopify.com%2Fprojects%2Fepiscopalatlanta%2F%23|||" el_class="top_event_heading"][/vc_column_inner][/vc_row_inner][vc_row_inner][vc_column_inner][vc_column_text][eventSearchParams][/vc_column_text][/vc_column_inner][/vc_row_inner][vc_column_text el_class="event_calender_div"][eo_fullcalendar event_venue="'.$venue_slug.'" headerLeft=\'prev,next today\' headerCenter=\'title\' headerRight=\'month,agendaWeek\'][/vc_column_text][vc_row_inner][vc_column_inner][vc_column_text][eo_events venue="'.$venue_slug.'"][/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_column][vc_column width="1/4" el_class="leader_visitation_div"][vc_row_inner el_class="leader_visitation_heading"][vc_column_inner][vc_custom_heading text="Leadership Visitation" font_container="tag:h2|text_align:left|color:%23333333" el_class="leader_visit_title"][/vc_column_inner][/vc_row_inner][vc_row_inner el_class="leader_visit_title_text"][vc_column_inner][vc_custom_heading text="Lorem ipsum" font_container="tag:h6|text_align:left" el_class="sub_leader_visit_title"][vc_column_text el_class="sub_leader_visit_text"]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis[/vc_column_text][/vc_column_inner][/vc_row_inner][vc_row_inner el_class="leader_visit_title_text"][vc_column_inner][vc_custom_heading text="Lorem ipsum" font_container="tag:h6|text_align:left" el_class="sub_leader_visit_title"][/vc_column_inner][/vc_row_inner][vc_column_text el_class="sub_leader_visit_text"]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis[/vc_column_text][vc_row_inner el_class="leader_visit_title_text"][vc_column_inner][vc_custom_heading text="Lorem ipsum" font_container="tag:h6|text_align:left" el_class="sub_leader_visit_title"][vc_column_text el_class="sub_leader_visit_text"]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis[/vc_column_text][/vc_column_inner][/vc_row_inner][vc_row_inner el_class="leader_visit_title_text"][vc_column_inner][vc_custom_heading text="Lorem ipsum" font_container="tag:h6|text_align:left" el_class="sub_leader_visit_title"][vc_column_text el_class="sub_leader_visit_text"]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis[/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]');
?>
<?php get_footer();
