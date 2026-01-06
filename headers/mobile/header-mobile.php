<div id="apus-header-mobile" class="header-mobile d-block d-xl-none clearfix">    
    <div class="container">
        <div class="row">
            <div class="d-flex align-items-center col-12">
                <div class="col-3">
                    <?php if ( justhome_get_config('header_mobile_menu', true) ) { ?>
                        <a href="#navbar-offcanvas" class="btn-showmenu">
                            <i class="vertical-icon"></i>
                        </a>
                    <?php } ?>
                </div>
                <div class="col-6 text-center">
                    <?php
                        $logo_url = justhome_get_config('media-mobile-logo');
                    ?>
                    <?php if( !empty($logo_url) ): ?>
                        <div class="logo">
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                                <img src="<?php echo esc_url( $logo_url ); ?>" alt="<?php bloginfo( 'name' ); ?>">
                            </a>
                        </div>
                    <?php else: ?>
                        <div class="logo logo-theme">
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                                <img src="<?php echo esc_url( get_template_directory_uri().'/images/logo.svg'); ?>" alt="<?php bloginfo( 'name' ); ?>">
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-3">
    <?php
        if ( justhome_get_config('header_mobile_login', true) && justhome_is_wp_realestate_activated() ) {
            if ( is_user_logged_in() ) {
                // Existing code for logged-in user menus
                // Remove or comment out the following code if you don't need it
            } else {
                // Replace login/register icon with a call button
                ?>
                <div class="top-wrapper-menu float-end">
                    <a class="btn-call" href="tel:+66957200530">
                        <i class="flaticon-phone"></i>
                    </a>
                </div>
                <?php
            }
        }
    ?>
</div>

            </div>
        </div>
    </div>
</div>