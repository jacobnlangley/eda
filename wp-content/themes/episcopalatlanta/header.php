<?php
//echo dirname(__DIR__);
?><!DOCTYPE html>
<html lang="en"  style="margin-top:0 !important; ">
    <head>

        <title><?php
            if (!wp_title('')) {
                echo wp_title() . '  ' . get_bloginfo('name');
            } else {

                echo get_bloginfo('name');
            }
            ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="<?php echo get_bloginfo('template_directory'); ?>/style.css" rel="stylesheet">
        <link href="<?php echo get_bloginfo('template_directory'); ?>/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo get_bloginfo('template_directory'); ?>/css/font-awesome.min.css" rel="stylesheet">
        <script
                src="https://code.jquery.com/jquery-2.2.4.min.js"
                integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
                crossorigin="anonymous">
            
        </script>
        <style>
            ul {
                list-style-type: none;
                margin: 0;
                padding: 0;
                overflow: hidden;

            }

            li {
                float: left;
            }

            li a, .dropbtn {
                display: inline-block;
                color: black;
                text-align: center;
                margin: 14px 10px;
                text-decoration: none;
            }

            li a:hover, .dropdown:hover .dropbtn {
                background-color: white;
            }

            li.dropdown {
                display: inline-block;
            }

            .dropdown-content {
                display: none;
                position: absolute;
                background-color: #fff;
                min-width: 130px;
                box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
                z-index: 1;
            }

            .dropdown-content a {
                color: black;
                margin: 12px 16px;
                text-decoration: none;
                display: block;
                text-align: left;
            }

            .dropdown-content a:hover {background-color: #ffffff00;}

            .dropdown:hover .dropdown-content {
                display: block;
            }
            #bodyContent,#firstHeading{
              color: #fff;
            }
            #content{
              padding: 15px;
            }
            div#siteNotice{
              margin: 10px auto;
            width: 100%;
            }
            div#siteNotice input{
                  width: 100%;
            }

            li.main-menu-item a.main-menu-item-link {
                cursor: default;
            }
        </style>
        <?php
        wp_head();
      
if(is_front_page())
{
?>

 <?php } ?>
    </head>
    <body <?php body_class(); ?>> 
        <div class="eda_inner_container" >      
        <header>
            <div class="section1 container">
                <div class="header_logo" id="episcopalatlanta_logo">
                   <a href="<?php echo get_home_url(); ?>"> <img src="<?php echo ot_get_option('site_logo'); ?>" class="header_logo"/></a>
                </div>
                <div class="header_buttons_container">
                    <div class="find_church_btn_container">
                        <!-- <input type="button" id="find_church_btn" value="FIND A CHURCH" class="btn_find_church mreg"> -->

                        <a href="<?php echo get_site_url().'/churchdirectory/';?>" class="btn_find_church mreg" id="find_church_btn">FIND A PARISH</a>
                    </div>
                    <div class="search-container">
                        <!-- <input type="text" id="search-bar" placeholder="SEARCH SITE">
                        <a href="#"><img class="search-icon mreg" src="http://www.endlessicons.com/wp-content/uploads/2012/12/search-icon.png"></a> -->

                        <!-- <form role="search" method="get" class="main_search_form" action="http://eda.prosaverapp.com">
                      <label for="search-form-5abb7c2bb3051"></label><input type="search" placeholder="SEARCH SITE" id="search-bar" value="" name="s" title="Search for:"><button style="display: none;" type="submit" class="common_search_btn">Search</button>
                    </form>   -->  

                        <form role="search" method="get" class="wpr-search-form " action="https://edatl.wpengine.com/"><label for="search-form-5a940a5134358"></label><input id="search-bar" type="search" placeholder="SEARCH SITE" value="" name="s" title="Search for:"><button style="display: none;" type="submit" class="wpr_submit search-icon mreg"><i class="wpr-icon-search"></i></button></form>
                    </div>
                </div>
                <div class="header_menu_container">
                    <div class="header_menu" id="episcopalatlanta_menu">

                        <?php
                        $menu_name = 'Header Menu';
                        $locations = get_nav_menu_locations();
                        $menu = wp_get_nav_menu_object($locations[$menu_name]);
                        $menuitems = wp_get_nav_menu_items($menu->term_id, array('order' => 'DESC'));
                        $depth = 0;
                        ?>

                        <?php //wp_nav_menu( array( 'theme_location' => 'header-menu', 'menu_class' => 'nav-menu', 'fallback_cb' => false ) ); ?>


                        <ul class="slid">
                            <?php
                            $identifier = 1;
                            $count = 0;
                            $sub = 0;
                            $found = false;
                            $submenu = false;
                            $Arr = wp_get_nav_menu_items('Header Menu');
                            //$Arr = wp_nav_menu( array( 'theme_location' => 'header-menu', 'menu_class' => 'slid', 'fallback_cb' => false ) );
                            if(isset($_REQUEST['testing'])){
                                echo "<pre>";
                                var_dump($Arr);
                                die();
                            }               
                            $parent_id = 0;
                            foreach ($Arr as $index => $item):

                                // get page id from using menu item object id
                                $id = get_post_meta($item->ID, '_menu_item_object_id', true);
                                // var_dump($id);
                                // set up a page object to retrieve page data
                                $page = get_page($id);
                                $link = get_page_link($id);
                                $title = $item->post_title?:($page->post_title);
                                // item does not have a parent so menu_item_parent equals 0 (false)
                                if (!$item->menu_item_parent){
                                    // save this id for later comparison with sub-menu items
                                    $parent_id = $item->ID;                                    
                                    ?>
                                    <li class="main-menu-item dropdown">
                                        <a data-page-url="<?php echo $link; ?>" href="<?php echo $item->url; ?>" class="main-menu-item-link dropbtn mreg"  id="menu-<?php echo $id; ?>">
                                            <?php echo $title; ?>
                                        </a>                                    
                                <?php                                    
                                }
                                else if($parent_id == $item->menu_item_parent){
                                    $sub_parent_id = $item;
                                    if (!$submenu){ 
                                        $submenu = true;
                                        ?>
                                        <div class = "dropdown-content">
                                        <?php
                                    }
                                        ?>
                                        <a href="<?php echo $item->url; ?>" class="sub-menu-link menu_color mreg"><?php echo $title; ?></a>
                                        <?php                                        
                                        $i++;
                                }
                                if($Arr[$index+1]->menu_item_parent!=$parent_id){
                                    if($submenu){
                                        $submenu=false;
                                        ?>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </li>
                                    <?php
                                }                            

                                    endforeach;
                                    ?>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
        <div class="home_content">