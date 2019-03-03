<?php

/**
 * Initialize the options before anything else.
 */
add_action('admin_init', 'custom_theme_options', 1);

/**
 * Build the custom settings & update OptionTree.
 */
function custom_theme_options() {
    /**
     * Get a copy of the saved settings array.
     */
    $saved_settings = get_option('option_tree_settings', array());

    /**
     * Custom settings array that will eventually be
     * passes to the OptionTree Settings API Class.
     */
    $custom_settings = array(
        'sections' => array(
            array(
                'id' => 'header_logo',
                'title' => 'Site Logo'
            ),
             array(
                'id' => 'follow_us',
                'title' => 'Follow Us'
            ), 
            array(
                'id' => 'footer',
                'title' => 'Footer Title & Description'
            ), 
            
        ),
        'settings' => array(
            array(
                'id' => 'facebook_link1',
                'label' => __('Facebook Link', 'option-tree-theme'),
                'desc' => '',
                'std' => '',
                'type' => 'text',
                'section' => 'social',
            ),
            array(
                'id' => 'site_logo',
                'label' => __('Site Logo', 'option-tree-theme'),
                'desc' => 'Upload Site Logo From Here',
                'std' => '',
                'type' => 'upload',
                'section' => 'header_logo',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => '',
                'condition' => '',
                'operator' => 'and'
            ),
            array(
                'id' => 'site_footer_logo',
                'label' => __('Site Footer Logo', 'option-tree-theme'),
                'desc' => 'Upload Site Footer Logo From Here',
                'std' => '',
                'type' => 'upload',
                'section' => 'header_logo',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => '',
                'condition' => '',
                'operator' => 'and'
            ),
             array(
                'id' => 'facebook_link',
                'label' => __('Facebook Link', 'option-tree-theme'),
                'desc' => '',
                'std' => '',
                'type' => 'text',
                'section' => 'follow_us',
            ),
            array(
                'id' => 'twitter_link',
                'label' => __('Twitter Link', 'option-tree-theme'),
                'desc' => '',
                'std' => '',
                'type' => 'text',
                'section' => 'follow_us',
            ),
            array(
                'id' => 'instagram_link',
                'label' => __('Instagram Link', 'option-tree-theme'),
                'desc' => '',
                'std' => '',
                'type' => 'text',
                'section' => 'follow_us',
            ),
            array(
                'id' => 'youtube_link',
                'label' => __('Youtube Link', 'option-tree-theme'),
                'desc' => '',
                'std' => '',
                'type' => 'text',
                'section' => 'follow_us',
            ),
            array(
                'id' => 'rss_link',
                'label' => __('RSS Link', 'option-tree-theme'),
                'desc' => '',
                'std' => '',
                'type' => 'text',
                'section' => 'follow_us',
            ),
            array(
                'id' => 'footer_title',
                'label' => __('Footer Title For Footer First Section', 'option-tree-theme'),
                'desc' => '',
                'std' => '',
                'type' => 'text',
                'section' => 'footer',
            ),
            array(
                'id' => 'footer_desc',
                'label' => __('Footer Description For Footer First Section', 'option-tree-theme'),
                'desc' => '',
                'std' => '',
                'type' => 'textarea',
                'section' => 'footer',
            ),
        )
    );
    /* settings are not the same update the DB */
    if ($saved_settings !== $custom_settings) {
        update_option('option_tree_settings', $custom_settings);
    }
}
