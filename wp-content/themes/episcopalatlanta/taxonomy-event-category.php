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
<?php 
	$category = get_queried_object(); 
	$category_slug = $category->slug;
 ?>
<?php
echo do_shortcode('[vc_row][vc_column css=".vc_custom_1520332208702 dynamic_title_back{background-color: #efefef !important;}" el_class="top-black-bg-title"][vc_column_text][dynamicTitle][/vc_column_text][/vc_column][/vc_row][vc_row][vc_column][vc_row_inner el_class="top_toggle_calendar_div"][vc_column_inner][vc_column_text]</p>
<div class="btn_div" style="text-align: left;"><a class="btn_links general_top_event_title calendar_toggle_btn top_event_title_active" href="http://eda.prosaverapp.com/">EVENTS CALENDAR</a></div>
<p>[/vc_column_text][vc_column_text]</p>
<div class="btn_div" style="text-align: left;"><a class="btn_links dc_top_event_title calendar_toggle_btn" href="http://eda.prosaverapp.com/">DIOCESAN CALENDAR</a></div>
<p>[/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row el_class="full_calender_container demo-container general_event_child"][vc_column width="3/4" el_class="custom_event_div"][vc_row_inner el_class="event_search_para_div general_event_child"][vc_column_inner][vc_column_text][eventSearchParams][/vc_column_text][/vc_column_inner][/vc_row_inner][vc_column_text el_class="event_calender_div general_event_child"][eo_fullcalendar headerLeft="prev,next" headerCenter="title" headerRight="month,agendaWeek"][/vc_column_text][vc_row_inner el_class="event_listing_div general_event_child"][vc_column_inner][vc_column_text][eo_events event_category="'.$category_slug.'"][/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_column][vc_column width="1/4" el_class="leader_visitation_div"][vc_row_inner el_class="leader_visit_title_text"][vc_column_inner][vc_custom_heading text="Submit Event" el_class="event_submit_title"][vc_column_text el_class="sub_leader_visit_text"]
<div class="btn_div" style="text-align: center;"><a class="btn_links event_submit_btn" href="http://eda.prosaverapp.com/add-event">SUBMIT EVENT</a></div>
[/vc_column_text][vc_column_text]
<div class="news_sidebar_divider"></div>
[/vc_column_text][/vc_column_inner][/vc_row_inner][vc_row_inner el_class="leader_visitation_heading"][vc_column_inner][vc_custom_heading text="Leadership Visitation" font_container="tag:h2|text_align:left|color:%23333333" el_class="leader_visit_title"][/vc_column_inner][/vc_row_inner][vc_row_inner el_class="leader_visit_title_text"][vc_column_inner][vc_custom_heading text="Lorem ipsum" font_container="tag:h6|text_align:left" el_class="sub_leader_visit_title"][vc_column_text el_class="sub_leader_visit_text"]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis[/vc_column_text][/vc_column_inner][/vc_row_inner][vc_row_inner el_class="leader_visit_title_text"][vc_column_inner][vc_custom_heading text="Lorem ipsum" font_container="tag:h6|text_align:left" el_class="sub_leader_visit_title"][/vc_column_inner][/vc_row_inner][vc_column_text el_class="sub_leader_visit_text"]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis[/vc_column_text][vc_row_inner el_class="leader_visit_title_text"][vc_column_inner][vc_custom_heading text="Lorem ipsum" font_container="tag:h6|text_align:left" el_class="sub_leader_visit_title"][vc_column_text el_class="sub_leader_visit_text"]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis[/vc_column_text][/vc_column_inner][/vc_row_inner][vc_row_inner el_class="leader_visit_title_text"][vc_column_inner][vc_custom_heading text="Lorem ipsum" font_container="tag:h6|text_align:left" el_class="sub_leader_visit_title"][vc_column_text el_class="sub_leader_visit_text"]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis[/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row][vc_column][vc_column_text]
[/vc_column_text][/vc_column][/vc_row][vc_section el_class="diocese_calendar_div diocese_calendar_child"][vc_row][vc_column][/vc_column][/vc_row][vc_row css=".vc_custom_1519222050054{background-color: #e5e5e5 !important;}" el_class="it_mean_div"][vc_column][vc_row_inner el_class="dc_page_layer"][vc_column_inner][vc_column_text]
<h1 style="text-align: center;">Diocesan Calendar</h1>
[/vc_column_text][vc_column_text el_class="it_mean_text"]
<h3 style="text-align: center; color: silver;">This diocesan calendar lists events and trainings of particular interest to clergy and parish employees as well as members of commissions and committees.
Other events and trainings can be found on <em>Connecting</em>.
<a href="https://connecting.episcopalatlanta.org/events/" target="_blank" rel="noopener">View <em>Connecting</em> events</a><a href="https://connecting.episcopalatlanta.org/submissions" target="_blank" rel="noopener"> | Submit news and events</a></h3>
[/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][/vc_section][vc_row css=".vc_custom_1523350069398{margin-bottom: 30px !important;}" el_class="sidebar_with_dropdown diocese_calendar_div diocese_calendar_child dc_page_layer"][vc_column][vc_row_inner el_class="calendar_div"][vc_column_inner][vc_column_text]<iframe style="border-width: 0;" src="https://calendar.google.com/calendar/embed?height=600&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=google-calendar%40episcopalatlanta.com&amp;color=%2323164E&amp;ctz=America%2FNew_York" width="800" height="600" frameborder="0" scrolling="no"></iframe>[/vc_column_text][vc_btn title="Subscribe" shape="square" color="violet" align="left" link="url:https%3A%2F%2Fcalendar.google.com%2Fcalendar%2Fical%2Fgoogle-calendar%2540episcopalatlanta.com%2Fpublic%2Fbasic.ics|||"][vc_column_text][/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]');
?>
<?php get_footer();
