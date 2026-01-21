<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if( ! class_exists( 'Homeo_Elementor_Extensions' ) ) {
    final class Homeo_Elementor_Extensions {

        private static $_instance = null;

        
        public function __construct() {
            add_action( 'elementor/elements/categories_registered', array( $this, 'add_widget_categories' ) );
            add_action( 'init', array( $this, 'elementor_widgets' ),  100 );
            add_filter( 'homeo_generate_post_builder', array( $this, 'render_post_builder' ), 10, 2 );

            add_filter( 'elementor/icons_manager/additional_tabs', array( $this, 'custom_icons' ) );

            add_action('elementor/editor/before_enqueue_styles', array( $this, 'style' ) );
        }

        public static function instance () {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }
            return self::$_instance;
        }
        
        public function add_widget_categories( $elements_manager ) {
            $elements_manager->add_category(
                'homeo-elements',
                [
                    'title' => esc_html__( 'Homeo Elements', 'homeo' ),
                    'icon' => 'fa fa-shopping-bag',
                ]
            );

            $elements_manager->add_category(
                'homeo-header-elements',
                [
                    'title' => esc_html__( 'Homeo Header Elements', 'homeo' ),
                    'icon' => 'fa fa-shopping-bag',
                ]
            );

        }

        public function elementor_widgets() {
            // general elements
            get_template_part( 'inc/vendors/elementor/widgets/heading' );
            get_template_part( 'inc/vendors/elementor/widgets/posts' );
            get_template_part( 'inc/vendors/elementor/widgets/call_to_action' );
            get_template_part( 'inc/vendors/elementor/widgets/features_box' );
            get_template_part( 'inc/vendors/elementor/widgets/social_links' );
            get_template_part( 'inc/vendors/elementor/widgets/testimonials' );
            get_template_part( 'inc/vendors/elementor/widgets/brands' );
            get_template_part( 'inc/vendors/elementor/widgets/popup_video' );
            get_template_part( 'inc/vendors/elementor/widgets/banner' );
            get_template_part( 'inc/vendors/elementor/widgets/banner_account' );
            get_template_part( 'inc/vendors/elementor/widgets/countdown' );
            get_template_part( 'inc/vendors/elementor/widgets/nav_menu' );
            get_template_part( 'inc/vendors/elementor/widgets/team' );
            get_template_part( 'inc/vendors/elementor/widgets/achievements' );

            // header elements
            get_template_part( 'inc/vendors/elementor/header-widgets/logo' );
            get_template_part( 'inc/vendors/elementor/header-widgets/primary_menu' );
            

            if ( homeo_is_mailchimp_activated() ) {
                get_template_part( 'inc/vendors/elementor/widgets/mailchimp' );
            }
            
            if ( homeo_is_revslider_activated() ) {
                get_template_part( 'inc/vendors/elementor/widgets/revslider' );
            }

            if ( homeo_is_wp_realestate_activated() ) {
                get_template_part( 'inc/vendors/elementor/wp-realestate-widgets/properties' );
                get_template_part( 'inc/vendors/elementor/wp-realestate-widgets/properties_maps' );
                get_template_part( 'inc/vendors/elementor/wp-realestate-widgets/properties_tabs' );
                get_template_part( 'inc/vendors/elementor/wp-realestate-widgets/properties_slider' );
                get_template_part( 'inc/vendors/elementor/wp-realestate-widgets/agents' );
                get_template_part( 'inc/vendors/elementor/wp-realestate-widgets/agencies' );
                get_template_part( 'inc/vendors/elementor/wp-realestate-widgets/location_banner' );
                get_template_part( 'inc/vendors/elementor/wp-realestate-widgets/type-banner' );

                get_template_part( 'inc/vendors/elementor/wp-realestate-widgets/search_form' );
                get_template_part( 'inc/vendors/elementor/wp-realestate-widgets/search_form_tabs' );

                get_template_part( 'inc/vendors/elementor/wp-realestate-widgets/user_info' );

                get_template_part( 'inc/vendors/elementor/wp-realestate-widgets/compare-btn' );
                get_template_part( 'inc/vendors/elementor/wp-realestate-widgets/favorite-btn' );
                get_template_part( 'inc/vendors/elementor/wp-realestate-widgets/submit-btn' );
                get_template_part( 'inc/vendors/elementor/wp-realestate-widgets/currencies' );
            }

            if ( homeo_is_wp_realestate_wc_paid_listings_activated() ) {
                get_template_part( 'inc/vendors/elementor/wc-paid-listings-widgets/packages' );
                get_template_part( 'inc/vendors/elementor/wc-paid-listings-widgets/user_packages' );
                get_template_part( 'inc/vendors/elementor/wc-paid-listings-widgets/transactions' );
            }

            if ( homeo_is_wp_private_message() ) {
                get_template_part( 'inc/vendors/elementor/wp-private-message-widgets/header-notification' );
            }
        }
        public function style() {
            wp_enqueue_style('homeo-flaticon',  get_template_directory_uri() . '/css/flaticon.css');
            wp_enqueue_style('themify-icons',  get_template_directory_uri() . '/css/themify-icons.css');
            wp_enqueue_style('line-font',  get_template_directory_uri() . '/css/line-font.css');
        }

        public function custom_icons($icons_args = array()) {
            $flaticon_icons = array(
                'flaticon-user', 'flaticon-phone', 'flaticon-magnifiying-glass', 'flaticon-filter', 'flaticon-arrow-down-sign-to-navigate', 'flaticon-location', 'flaticon-hotel', 'flaticon-bath-tub', 'flaticon-bathtub', 'flaticon-minus-front', 'flaticon-heart', 'flaticon-heart-1', 'flaticon-search-house', 'flaticon-seller', 'flaticon-buy-home', 'flaticon-website', 'flaticon-computer', 'flaticon-house', 'flaticon-rating', 'flaticon-customer', 'flaticon-house-1', 'flaticon-shield', 'flaticon-home', 'flaticon-online-meeting', 'flaticon-key', 'flaticon-rental', 'flaticon-play', 'flaticon-twitter', 'flaticon-linkedin', 'flaticon-facebook', 'flaticon-instagram', 'flaticon-bungalow', 'flaticon-cottage', 'flaticon-buildings', 'flaticon-building', 'flaticon-office-building', 'flaticon-check', 'flaticon-paper-plane', 'flaticon-message', 'flaticon-pdf', 'flaticon-tag', 'flaticon-star', 'flaticon-star-1', 'flaticon-walk', 'flaticon-bike', 'flaticon-gallery', 'flaticon-buildings-1', 'flaticon-building-1', 'flaticon-city', 'flaticon-drill', 'flaticon-hammer', 'flaticon-garage', 'flaticon-tools-and-utensils', 'flaticon-before-after', 'flaticon-share', 'flaticon-outbox', 'flaticon-compare', 'flaticon-calendar', 'flaticon-whatsapp', 'flaticon-chat-bubble', 'flaticon-comment', 'flaticon-home-1', 'flaticon-house-3', 'flaticon-house-4', 'flaticon-home-2', 'flaticon-plus', 'flaticon-home-3', 'flaticon-home-4', 'flaticon-layers', 'flaticon-padlock', 'flaticon-logout', 'flaticon-layers-1', 'flaticon-find', 'flaticon-upload', 'flaticon-file', 'flaticon-upload-1', 'flaticon-delete', 'flaticon-edit', 'flaticon-location-1', 'flaticon-video-chat', 'flaticon-location-pin', 'flaticon-close', 'flaticon-google', 'flaticon-time'
            );

            $icons_args['homeo-flaticon-icon'] = array(
                'name'          => 'homeo-flaticon-icon',
                'label'         => esc_html__( 'Flaticon Icon', 'homeo' ),
                'labelIcon'     => 'fas fa-user',
                'prefix'        => '',
                'displayPrefix' => '',
                'url'           => get_template_directory_uri() . '/css/flaticon.css',
                'icons'         => $flaticon_icons,
                'ver'           => HOMEO_THEME_VERSION,
            );
            
            $themify_icons = array(
                'ti-volume', 'ti-user', 'ti-unlock', 'ti-unlink', 'ti-trash', 'ti-thought', 'ti-target', 'ti-tag', 'ti-tablet', 'ti-star', 'ti-spray', 'ti-signal', 'ti-shopping-cart', 'ti-shopping-cart-full', 'ti-settings', 'ti-search', 'ti-zoom-in', 'ti-zoom-out', 'ti-cut', 'ti-ruler', 'ti-ruler-pencil', 'ti-ruler-alt', 'ti-bookmark', 'ti-bookmark-alt', 'ti-reload', 'ti-plus', 'ti-pin', 'ti-pencil', 'ti-pencil-alt', 'ti-paint-roller', 'ti-paint-bucket', 'ti-na', 'ti-mobile', 'ti-minus', 'ti-medall', 'ti-medall-alt', 'ti-marker', 'ti-marker-alt', 'ti-arrow-up', 'ti-arrow-right', 'ti-arrow-left', 'ti-arrow-down', 'ti-lock', 'ti-location-arrow', 'ti-link', 'ti-layout', 'ti-layers', 'ti-layers-alt', 'ti-key', 'ti-import', 'ti-image', 'ti-heart', 'ti-heart-broken', 'ti-hand-stop', 'ti-hand-open', 'ti-hand-drag', 'ti-folder', 'ti-flag', 'ti-flag-alt', 'ti-flag-alt-2', 'ti-eye', 'ti-export', 'ti-exchange-vertical', 'ti-desktop', 'ti-cup', 'ti-crown', 'ti-comments', 'ti-comment', 'ti-comment-alt', 'ti-close', 'ti-clip', 'ti-angle-up', 'ti-angle-right', 'ti-angle-left', 'ti-angle-down', 'ti-check', 'ti-check-box', 'ti-camera', 'ti-announcement', 'ti-brush', 'ti-briefcase', 'ti-bolt', 'ti-bolt-alt', 'ti-blackboard', 'ti-bag', 'ti-move', 'ti-arrows-vertical', 'ti-arrows-horizontal', 'ti-fullscreen', 'ti-arrow-top-right', 'ti-arrow-top-left', 'ti-arrow-circle-up', 'ti-arrow-circle-right', 'ti-arrow-circle-left', 'ti-arrow-circle-down', 'ti-angle-double-up', 'ti-angle-double-right', 'ti-angle-double-left', 'ti-angle-double-down', 'ti-zip', 'ti-world', 'ti-wheelchair', 'ti-view-list', 'ti-view-list-alt', 'ti-view-grid', 'ti-uppercase', 'ti-upload', 'ti-underline', 'ti-truck', 'ti-timer', 'ti-ticket', 'ti-thumb-up', 'ti-thumb-down', 'ti-text', 'ti-stats-up', 'ti-stats-down', 'ti-split-v', 'ti-split-h', 'ti-smallcap', 'ti-shine', 'ti-shift-right', 'ti-shift-left', 'ti-shield', 'ti-notepad', 'ti-server', 'ti-quote-right', 'ti-quote-left', 'ti-pulse', 'ti-printer', 'ti-power-off', 'ti-plug', 'ti-pie-chart', 'ti-paragraph', 'ti-panel', 'ti-package', 'ti-music', 'ti-music-alt', 'ti-mouse', 'ti-mouse-alt', 'ti-money', 'ti-microphone', 'ti-menu', 'ti-menu-alt', 'ti-map', 'ti-map-alt', 'ti-loop', 'ti-location-pin', 'ti-list', 'ti-light-bulb', 'ti-talic', 'ti-info', 'ti-infinite', 'ti-id-badge', 'ti-hummer', 'ti-home', 'ti-help', 'ti-headphone', 'ti-harddrives', 'ti-harddrive', 'ti-gift', 'ti-game', 'ti-filter', 'ti-files', 'ti-file', 'ti-eraser', 'ti-envelope', 'ti-download', 'ti-direction', 'ti-direction-alt', 'ti-dashboard', 'ti-control-stop', 'ti-control-shuffle', 'ti-control-play', 'ti-control-pause', 'ti-control-forward', 'ti-control-backward', 'ti-cloud', 'ti-cloud-up', 'ti-cloud-down', 'ti-clipboard', 'ti-car', 'ti-calendar', 'ti-book', 'ti-bell', 'ti-basketball', 'ti-bar-chart', 'ti-bar-chart-alt', 'ti-back-right', 'ti-back-left', 'ti-arrows-corner', 'ti-archive', 'ti-anchor', 'ti-align-right', 'ti-align-left', 'ti-align-justify', 'ti-align-center', 'ti-alert', 'ti-alarm-clock', 'ti-agenda', 'ti-write', 'ti-window', 'ti-widgetized', 'ti-widget', 'ti-widget-alt', 'ti-wallet', 'ti-video-clapper', 'ti-video-camera', 'ti-vector', 'ti-themify-logo', 'ti-themify-favicon', 'ti-themify-favicon-alt', 'ti-support', 'ti-stamp', 'ti-split-v-alt', 'ti-slice', 'ti-shortcode', 'ti-shift-right-alt', 'ti-shift-left-alt', 'ti-ruler-alt-2', 'ti-receipt', 'ti-pin2', 'ti-pin-alt', 'ti-pencil-alt2', 'ti-palette', 'ti-more', 'ti-more-alt', 'ti-microphone-alt', 'ti-magnet', 'ti-line-double', 'ti-line-dotted', 'ti-line-dashed', 'ti-layout-width-full', 'ti-layout-width-default', 'ti-layout-width-default-alt', 'ti-layout-tab', 'ti-layout-tab-window', 'ti-layout-tab-v', 'ti-layout-tab-min', 'ti-layout-slider', 'ti-layout-slider-alt', 'ti-layout-sidebar-right', 'ti-layout-sidebar-none', 'ti-layout-sidebar-left', 'ti-layout-placeholder', 'ti-layout-menu', 'ti-layout-menu-v', 'ti-layout-menu-separated', 'ti-layout-menu-full', 'ti-layout-media-right-alt', 'ti-layout-media-right', 'ti-layout-media-overlay', 'ti-layout-media-overlay-alt', 'ti-layout-media-overlay-alt-2', 'ti-layout-media-left-alt', 'ti-layout-media-left', 'ti-layout-media-center-alt', 'ti-layout-media-center', 'ti-layout-list-thumb', 'ti-layout-list-thumb-alt', 'ti-layout-list-post', 'ti-layout-list-large-image', 'ti-layout-line-solid', 'ti-layout-grid4', 'ti-layout-grid3', 'ti-layout-grid2', 'ti-layout-grid2-thumb', 'ti-layout-cta-right', 'ti-layout-cta-left', 'ti-layout-cta-center', 'ti-layout-cta-btn-right', 'ti-layout-cta-btn-left', 'ti-layout-column4', 'ti-layout-column3', 'ti-layout-column2', 'ti-layout-accordion-separated', 'ti-layout-accordion-merged', 'ti-layout-accordion-list', 'ti-ink-pen', 'ti-info-alt', 'ti-help-alt', 'ti-headphone-alt', 'ti-hand-point-up', 'ti-hand-point-right', 'ti-hand-point-left', 'ti-hand-point-down', 'ti-gallery', 'ti-face-smile', 'ti-face-sad', 'ti-credit-card', 'ti-control-skip-forward', 'ti-control-skip-backward', 'ti-control-record', 'ti-control-eject', 'ti-comments-smiley', 'ti-brush-alt', 'ti-youtube', 'ti-vimeo', 'ti-twitter', 'ti-time', 'ti-tumblr', 'ti-skype', 'ti-share', 'ti-share-alt', 'ti-rocket', 'ti-pinterest', 'ti-new-window', 'ti-microsoft', 'ti-list-ol', 'ti-linkedin', 'ti-layout-sidebar-2', 'ti-layout-grid4-alt', 'ti-layout-grid3-alt', 'ti-layout-grid2-alt', 'ti-layout-column4-alt', 'ti-layout-column3-alt', 'ti-layout-column2-alt', 'ti-instagram', 'ti-google', 'ti-github', 'ti-flickr', 'ti-facebook', 'ti-dropbox', 'ti-dribbble', 'ti-apple', 'ti-android', 'ti-save', 'ti-save-alt', 'ti-yahoo', 'ti-wordpress', 'ti-vimeo-alt', 'ti-twitter-alt', 'ti-tumblr-alt', 'ti-trello', 'ti-stack-overflow', 'ti-soundcloud', 'ti-sharethis', 'ti-sharethis-alt', 'ti-reddit', 'ti-pinterest-alt', 'ti-microsoft-alt', 'ti-linux', 'ti-jsfiddle', 'ti-joomla', 'ti-html5', 'ti-flickr-alt', 'ti-email', 'ti-drupal', 'ti-dropbox-alt', 'ti-css3', 'ti-rss', 'ti-rss-alt'
            );

            $icons_args['homeo-themify-icon'] = array(
                'name'          => 'homeo-themify-icon',
                'label'         => esc_html__( 'Themify Icon', 'homeo' ),
                'labelIcon'     => 'fas fa-user',
                'prefix'        => '',
                'displayPrefix' => '',
                'url'           => get_template_directory_uri() . '/css/themify-icons.css',
                'icons'         => $themify_icons,
                'ver'           => HOMEO_THEME_VERSION,
            );

            return $icons_args;
        }
        public function render_page_content($post_id) {
            if ( class_exists( 'Elementor\Core\Files\CSS\Post' ) ) {
                $css_file = new Elementor\Core\Files\CSS\Post( $post_id );
                $css_file->enqueue();
            }

            return Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $post_id );
        }

        public function render_post_builder($html, $post) {
            if ( !empty($post) && !empty($post->ID) ) {
                return $this->render_page_content($post->ID);
            }
            return $html;
        }
    }
}

if ( did_action( 'elementor/loaded' ) ) {
    // Finally initialize code
    Homeo_Elementor_Extensions::instance();
}