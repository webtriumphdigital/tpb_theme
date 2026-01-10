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

            add_action( 'elementor/controls/controls_registered', array( $this, 'modify_controls' ), 10, 1 );
            add_action('elementor/editor/before_enqueue_styles', array( $this, 'style' ) );
            
            add_filter( 'elementor/icons_manager/additional_tabs', array( $this, 'custom_icons' ) );
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

        public function custom_icons($icons_args = array()) {
            $flaticon_icons = array(
                'user', 'phone', 'magnifiying-glass', 'filter', 'arrow-down-sign-to-navigate', 'location', 'hotel', 'bath-tub', 'bathtub', 'minus-front', 'heart', 'heart-1', 'search-house', 'seller', 'buy-home', 'website', 'computer', 'house', 'rating', 'customer', 'house-1', 'shield', 'home', 'online-meeting', 'key', 'rental', 'play', 'twitter', 'linkedin', 'facebook', 'instagram', 'bungalow', 'cottage', 'buildings', 'building', 'office-building', 'check', 'paper-plane', 'message', 'pdf', 'tag', 'star', 'star-1', 'walk', 'bike', 'gallery', 'buildings-1', 'building-1', 'city', 'drill', 'hammer', 'garage', 'tools-and-utensils', 'before-after', 'share', 'outbox', 'compare', 'calendar', 'whatsapp', 'chat-bubble', 'comment', 'home-1', 'house-3', 'house-4', 'home-2', 'plus', 'home-3', 'home-4', 'layers', 'padlock', 'logout', 'layers-1', 'find', 'upload', 'file', 'upload-1', 'delete', 'edit', 'location-1', 'video-chat', 'location-pin', 'close', 'google', 'time', 'high-five', 'profit', 'house-2', 'magnifying-glass', 'maps-and-flags'
            );

            $icons_args['homeo-flaticon-icon'] = array(
                'name'          => 'homeo-flaticon-icon',
                'label'         => esc_html__( 'Flaticon Icon', 'homeo' ),
                'labelIcon'     => 'fas fa-user',
                'prefix'        => 'flaticon-',
                'displayPrefix' => 'flaticon-',
                'url'           => get_template_directory_uri() . '/css/flaticon.css',
                'icons'         => $flaticon_icons,
                'ver'           => HOMEO_THEME_VERSION,
            );

            $themify_icons = array(
                'volume', 'user', 'unlock', 'unlink', 'trash', 'thought', 'target', 'tag', 'tablet', 'star', 'spray', 'signal', 'shopping-cart', 'shopping-cart-full', 'settings', 'search', 'zoom-in', 'zoom-out', 'cut', 'ruler', 'ruler-pencil', 'ruler-alt', 'bookmark', 'bookmark-alt', 'reload', 'plus', 'pin', 'pencil', 'pencil-alt', 'paint-roller', 'paint-bucket', 'na', 'mobile', 'minus', 'medall', 'medall-alt', 'marker', 'marker-alt', 'arrow-up', 'arrow-right', 'arrow-left', 'arrow-down', 'lock', 'location-arrow', 'link', 'layout', 'layers', 'layers-alt', 'key', 'import', 'image', 'heart', 'heart-broken', 'hand-stop', 'hand-open', 'hand-drag', 'folder', 'flag', 'flag-alt', 'flag-alt-2', 'eye', 'export', 'exchange-vertical', 'desktop', 'cup', 'crown', 'comments', 'comment', 'comment-alt', 'close', 'clip', 'angle-up', 'angle-right', 'angle-left', 'angle-down', 'check', 'check-box', 'camera', 'announcement', 'brush', 'briefcase', 'bolt', 'bolt-alt', 'blackboard', 'bag', 'move', 'arrows-vertical', 'arrows-horizontal', 'fullscreen', 'arrow-top-right', 'arrow-top-left', 'arrow-circle-up', 'arrow-circle-right', 'arrow-circle-left', 'arrow-circle-down', 'angle-double-up', 'angle-double-right', 'angle-double-left', 'angle-double-down', 'zip', 'world', 'wheelchair', 'view-list', 'view-list-alt', 'view-grid', 'uppercase', 'upload', 'underline', 'truck', 'timer', 'ticket', 'thumb-up', 'thumb-down', 'text', 'stats-up', 'stats-down', 'split-v', 'split-h', 'smallcap', 'shine', 'shift-right', 'shift-left', 'shield', 'notepad', 'server', 'quote-right', 'quote-left', 'pulse', 'printer', 'power-off', 'plug', 'pie-chart', 'paragraph', 'panel', 'package', 'music', 'music-alt', 'mouse', 'mouse-alt', 'money', 'microphone', 'menu', 'menu-alt', 'map', 'map-alt', 'loop', 'location-pin', 'list', 'light-bulb', 'talic', 'info', 'infinite', 'id-badge', 'hummer', 'home', 'help', 'headphone', 'harddrives', 'harddrive', 'gift', 'game', 'filter', 'files', 'file', 'eraser', 'envelope', 'download', 'direction', 'direction-alt', 'dashboard', 'control-stop', 'control-shuffle', 'control-play', 'control-pause', 'control-forward', 'control-backward', 'cloud', 'cloud-up', 'cloud-down', 'clipboard', 'car', 'calendar', 'book', 'bell', 'basketball', 'bar-chart', 'bar-chart-alt', 'back-right', 'back-left', 'arrows-corner', 'archive', 'anchor', 'align-right', 'align-left', 'align-justify', 'align-center', 'alert', 'alarm-clock', 'agenda', 'write', 'window', 'widgetized', 'widget', 'widget-alt', 'wallet', 'video-clapper', 'video-camera', 'vector', 'themify-logo', 'themify-favicon', 'themify-favicon-alt', 'support', 'stamp', 'split-v-alt', 'slice', 'shortcode', 'shift-right-alt', 'shift-left-alt', 'ruler-alt-2', 'receipt', 'pin2', 'pin-alt', 'pencil-alt2', 'palette', 'more', 'more-alt', 'microphone-alt', 'magnet', 'line-double', 'line-dotted', 'line-dashed', 'layout-width-full', 'layout-width-default', 'layout-width-default-alt', 'layout-tab', 'layout-tab-window', 'layout-tab-v', 'layout-tab-min', 'layout-slider', 'layout-slider-alt', 'layout-sidebar-right', 'layout-sidebar-none', 'layout-sidebar-left', 'layout-placeholder', 'layout-menu', 'layout-menu-v', 'layout-menu-separated', 'layout-menu-full', 'layout-media-right-alt', 'layout-media-right', 'layout-media-overlay', 'layout-media-overlay-alt', 'layout-media-overlay-alt-2', 'layout-media-left-alt', 'layout-media-left', 'layout-media-center-alt', 'layout-media-center', 'layout-list-thumb', 'layout-list-thumb-alt', 'layout-list-post', 'layout-list-large-image', 'layout-line-solid', 'layout-grid4', 'layout-grid3', 'layout-grid2', 'layout-grid2-thumb', 'layout-cta-right', 'layout-cta-left', 'layout-cta-center', 'layout-cta-btn-right', 'layout-cta-btn-left', 'layout-column4', 'layout-column3', 'layout-column2', 'layout-accordion-separated', 'layout-accordion-merged', 'layout-accordion-list', 'ink-pen', 'info-alt', 'help-alt', 'headphone-alt', 'hand-point-up', 'hand-point-right', 'hand-point-left', 'hand-point-down', 'gallery', 'face-smile', 'face-sad', 'credit-card', 'control-skip-forward', 'control-skip-backward', 'control-record', 'control-eject', 'comments-smiley', 'brush-alt', 'youtube', 'vimeo', 'twitter', 'time', 'tumblr', 'skype', 'share', 'share-alt', 'rocket', 'pinterest', 'new-window', 'microsoft', 'list-ol', 'linkedin', 'layout-sidebar-2', 'layout-grid4-alt', 'layout-grid3-alt', 'layout-grid2-alt', 'layout-column4-alt', 'layout-column3-alt', 'layout-column2-alt', 'instagram', 'google', 'github', 'flickr', 'facebook', 'dropbox', 'dribbble', 'apple', 'android', 'save', 'save-alt', 'yahoo', 'wordpress', 'vimeo-alt', 'twitter-alt', 'tumblr-alt', 'trello', 'stack-overflow', 'soundcloud', 'sharethis', 'sharethis-alt', 'reddit', 'pinterest-alt', 'microsoft-alt', 'linux', 'jsfiddle', 'joomla', 'html5', 'flickr-alt', 'email', 'drupal', 'dropbox-alt', 'css3', 'rss', 'rss-alt'
            );

            $icons_args['homeo-themify-icon'] = array(
                'name'          => 'homeo-themify-icon',
                'label'         => esc_html__( 'Themify Icon', 'homeo' ),
                'labelIcon'     => 'fas fa-user',
                'prefix'        => 'ti-',
                'displayPrefix' => 'ti-',
                'url'           => get_template_directory_uri() . '/css/themify-icons.css',
                'icons'         => $themify_icons,
                'ver'           => HOMEO_THEME_VERSION,
            );

            return $icons_args;
        }

        public function style() {
            wp_enqueue_style('homeo-flaticon',  get_template_directory_uri() . '/css/flaticon.css');
            wp_enqueue_style('themify-icons',  get_template_directory_uri() . '/css/themify-icons.css');
            wp_enqueue_style('line-font',  get_template_directory_uri() . '/css/line-font.css');
        }

        public function modify_controls( $controls_registry ) {
            // Get existing icons
            $icons = $controls_registry->get_control( 'icon' )->get_settings( 'options' );
            
            $new_icons = $icons;

            // Then we set a new list of icons as the options of the icon control
            $controls_registry->get_control( 'icon' )->set_settings( 'options', $new_icons );
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