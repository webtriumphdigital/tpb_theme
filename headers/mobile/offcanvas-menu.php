<nav id="navbar-offcanvas" class="navbar hidden-lg" role="navigation">
    <ul>
        <?php
            $mobile_menu = 'primary';
            $menus = get_nav_menu_locations();
            if( !empty($menus['mobile-primary']) && wp_get_nav_menu_items($menus['mobile-primary'])) {
                $mobile_menu = 'mobile-primary';
            }
            $args = array(
                'theme_location' => $mobile_menu,
                'container' => false,
                'menu_class' => 'nav navbar-nav',
                'fallback_cb'     => false,
                'walker' => new Justhome_Mobile_Menu(),
                'items_wrap' => '%3$s',
            );
            wp_nav_menu($args);
        ?>
        
        
    </ul>

    <?php if ( justhome_get_config('header_mobile_add_listing_btn', true) && justhome_is_wp_realestate_activated() ) {
            $page_id = wp_realestate_get_option('submit_property_form_page_id');
            $submit_url = $page_id ? get_permalink($page_id) : home_url( '/' );
        ?>  
            <span class="mobile-submit text-center">
                <a href="/list-your-property/" class="w-100 btn btn-theme btn-submit"><?php esc_html_e('List Your Property', 'justhome'); ?><svg class="next" xmlns="http://www.w3.org/2000/svg" width="14" height="12" viewBox="0 0 14 12" fill="none"><path d="M0.8125 5.43752H12.0341L7.73716 1.34477C7.51216 1.13045 7.50344 0.77439 7.71775 0.54939C7.93178 0.324671 8.28784 0.315671 8.51312 0.529984L13.4204 5.20436C13.6327 5.41698 13.75 5.69936 13.75 6.00002C13.75 6.30039 13.6327 6.58305 13.4105 6.80495L8.51284 11.4698C8.404 11.5735 8.2645 11.625 8.125 11.625C7.9765 11.625 7.828 11.5665 7.71747 11.4504C7.50316 11.2254 7.51188 10.8696 7.73688 10.6553L12.0518 6.56252H0.8125C0.502 6.56252 0.25 6.31052 0.25 6.00002C0.25 5.68952 0.502 5.43752 0.8125 5.43752Z" fill="currentColor"></path></svg></a>
            </span>
        <?php } ?>
</nav>