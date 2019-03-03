<?php ?>
<div class="clearfloat"></div>
<div class="eda_sticky_footer">
    <footer>
        <div class="footer_section row">
            <div class="footer_part1 col-md-3">
                <div class="sub_cont">
                    <div class="footer_part1_title">
                        <h5><?php echo ot_get_option('footer_title'); ?></h5>
                    </div>
                    <div class="footer_part1_desc">
                        <p><?php echo ot_get_option('footer_desc'); ?></p>
                    </div>
                </div>
            </div>
            <div class="footer_part2 col-md-3">
                <div class="other_link_container">
                    <?php
                    $Arr = wp_get_nav_menu_items('Other Links');

                    foreach ($Arr as $val) {
                        if ($val->menu_item_parent) {
                            continue;
                        }
                        ?>
                        <div class="other_link_title"><a href="<?php echo $val->url; ?>" class="other_links"><?php echo $val->title; ?></a></div>
                        <?php
                    }
                    ?>                        
                </div>
                <div class="extra_link_container">
                    <?php
                    $Arr1 = wp_get_nav_menu_items('Extra Links');

                    foreach ($Arr1 as $val1) {
                        if ($val1->menu_item_parent) {
                            continue;
                        }
                        ?>
                        <div class="extra_link_title"><a href="<?php echo $val1->url; ?>" class="extra_links"><?php echo $val1->title; ?></a></div>
                        <?php
                    }
                    ?>                        
                </div>
            </div>
            <div class="footer_part3 col-md-2">
                <div class="follow_us_container">
                    <div class="social-media-container space">
                        <div class="title">FOLLOW US</div>
                        <div class="social">
                            <?php
                            if (ot_get_option('facebook_link') != "") {
                                ?>
                                <div class="fb link social_section"><a href="<?php echo ot_get_option('facebook_link'); ?>"><i class="fa  fa-facebook" aria-hidden="true"></i><span class="fb link link_text">Facebook</span></a></div>
                                <?php
                            }
                            if (ot_get_option('twitter_link') != "") {
                                ?>
                                <div class="tw link social_section"><a href="<?php echo ot_get_option('twitter_link'); ?>"><i class="fa fa-twitter" aria-hidden="true"></i><span class="tweeter link link_text">Twitter</span></a></div>
                                <?php
                            }

                            if (ot_get_option('instagram_link') != "") {
                                ?>
                                <div class="ins link social_section"><a href="<?php echo ot_get_option('instagram_link'); ?>"><i class="fa fa-instagram" aria-hidden="true"></i><span class="instagram link link_text">Instagram</span></a></div>
                                <?php
                            }
                            if (ot_get_option('youtube_link') != "") {
                                ?>
                                <div class="ins link social_section"><a href="<?php echo ot_get_option('youtube_link'); ?>"><i class="fa fa-youtube" aria-hidden="true"></i><span class="instagram link link_text">Youtube</span></a></div>
                                <?php
                            }

                          
                            if (ot_get_option('rss_link') != "") {
                                ?>
                                <div class="rss link social_section"><a href="<?php echo ot_get_option('rss_link'); ?>"><i class="fa fa-rss" aria-hidden="true"></i><span class="rss link link_text">RSS</span></a></div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>                   
                </div>
            </div>
            <div class="footer_part4  col-md-4">
                <div class="sub_cont">
                    <div class="title">SUBSCRIBE TO OUR NEWSLETTER</div>
                    <div class="desc">Join Our Online Community</div>
                    <?php //echo do_shortcode('[mc4wp_form id="2168"]'); ?>
                    <div class="input_email">
                        <!-- <input type="text" class="btn_email" placeholder="E-mail"/> -->
                        <!-- <button class="btn">SIGN UP</button> -->
                        <div class="btn_div" style="text-align: center;"><a target="_blank" class="btn_links newsletter_btn" href="http://episcopalatlanta.us13.list-manage.com/subscribe?u=e8da37f40d2a147f50bd0f7fc&id=573d393d97 ">SIGN UP</a></div>
                    </div>
                    <div class="horizon_logo">
                        <img src="<?php echo get_site_url() ."/wp-content/uploads/2018/02/epc_logo_horiz.png"; ?>">
                    </div>
                </div>
            </div>
        </div>

    </footer>
    <div class="footer-menu-container clearfix">
        <div class="copyright">
            <p class="copy"> @ <?php echo date('Y'); ?> All rights reserved.</p>
        </div>
        <div class="menu-container" style="float: right;display: inline-block;">
            <?php
            $Arr = wp_get_nav_menu_items('Footer Menu');

            foreach ($Arr as $val) {
                if ($val->menu_item_parent) {
                    continue;
                }
                ?>
                <li style="display: inline-block;"><a href="<?php echo $val->url; ?>"><?php echo $val->title; ?></a></li>
                    <?php
                }
                ?>                        
        </div>
    </div>
</div>
</div>
</div>
<!-- <script src="<?php //echo get_bloginfo('template_directory'); ?>/js/jquery.min.js" type="text/javascript"></script>
<script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script>
<script src="<?php //echo get_bloginfo('template_directory'); ?>/js/bootstrap.min.js" type="text/javascript"></script> -->
<?php
if(is_front_page())
{
?>
 <!-- <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCxFgdIx2m0eu8MBKRY68X7eUrSqkemHKc&callback=initMap">
    </script> -->
 <?php } ?>
<script>
  (function($) {
  })( jQuery );
</script>
<!-- <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5a9500ab5860cb83"></script> -->
<?php wp_footer(); ?>
</body>
</html>