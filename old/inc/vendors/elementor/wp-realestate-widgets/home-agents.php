<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Justhome_Elementor_RealEstate_Agents extends Elementor\Widget_Base {

	public function get_name() {
        return 'apus_element_realestate_agents';
    }

	public function get_title() {
        return esc_html__( 'Apus Agents', 'justhome' );
    }
    
	public function get_categories() {
        return [ 'justhome-elements' ];
    }

	protected function register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Agents', 'justhome' ),
                'tab' => Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Title', 'justhome' ),
                'type' => Elementor\Controls_Manager::TEXT,
                'input_type' => 'text',
                'placeholder' => esc_html__( 'Enter your title here', 'justhome' ),
            ]
        );

        $this->add_control(
            'content',
            [
                'label' => esc_html__( 'Description', 'justhome' ),
                'type' => Elementor\Controls_Manager::TEXTAREA,
            ]
        );

        $this->add_control(
            'limit',
            [
                'label' => esc_html__( 'Limit', 'justhome' ),
                'type' => Elementor\Controls_Manager::NUMBER,
                'input_type' => 'number',
                'description' => esc_html__( 'Limit agents to display', 'justhome' ),
                'default' => 4
            ]
        );
        
        $this->add_control(
            'orderby',
            [
                'label' => esc_html__( 'Order by', 'justhome' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => array(
                    '' => esc_html__('Default', 'justhome'),
                    'date' => esc_html__('Date', 'justhome'),
                    'ID' => esc_html__('ID', 'justhome'),
                    'author' => esc_html__('Author', 'justhome'),
                    'title' => esc_html__('Title', 'justhome'),
                    'modified' => esc_html__('Modified', 'justhome'),
                    'rand' => esc_html__('Random', 'justhome'),
                    'comment_count' => esc_html__('Comment count', 'justhome'),
                    'menu_order' => esc_html__('Menu order', 'justhome'),
                ),
                'default' => ''
            ]
        );

        $this->add_control(
            'order',
            [
                'label' => esc_html__( 'Sort order', 'justhome' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => array(
                    '' => esc_html__('Default', 'justhome'),
                    'ASC' => esc_html__('Ascending', 'justhome'),
                    'DESC' => esc_html__('Descending', 'justhome'),
                ),
                'default' => ''
            ]
        );

        $this->add_control(
            'get_agents_by',
            [
                'label' => esc_html__( 'Get Agents By', 'justhome' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => array(
                    'featured' => esc_html__('Featured Agents', 'justhome'),
                    'recent' => esc_html__('Recent Agents', 'justhome'),
                ),
                'default' => 'recent'
            ]
        );

        $this->add_control(
            'item_style',
            [
                'label' => esc_html__( 'Item Style', 'justhome' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => array(
                    'inner-grid' => esc_html__('Grid', 'justhome'),
                    'inner-list' => esc_html__('List', 'justhome'),
                ),
                'default' => 'inner-grid'
            ]
        );

        $this->add_control(
            'layout_type',
            [
                'label' => esc_html__( 'Layout', 'justhome' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => array(
                    'grid' => esc_html__('Grid', 'justhome'),
                    'carousel' => esc_html__('Carousel', 'justhome'),
                ),
                'default' => 'carousel'
            ]
        );

        $columns = range( 1, 12 );
        $columns = array_combine( $columns, $columns );

        $this->add_responsive_control(
            'columns',
            [
                'label' => esc_html__( 'Columns', 'justhome' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => $columns,
                'frontend_available' => true,
                'default' => 3,
            ]
        );

        $this->add_responsive_control(
            'slides_to_scroll',
            [
                'label' => esc_html__( 'Slides to Scroll', 'justhome' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'description' => esc_html__( 'Set how many slides are scrolled per swipe.', 'justhome' ),
                'options' => $columns,
                'condition' => [
                    'columns!' => '1',
                    'layout_type' => 'carousel',
                ],
                'frontend_available' => true,
                'default' => 3,
            ]
        );

        $this->add_control(
            'rows',
            [
                'label' => esc_html__( 'Rows', 'justhome' ),
                'type' => Elementor\Controls_Manager::TEXT,
                'input_type' => 'number',
                'placeholder' => esc_html__( 'Enter your rows number here', 'justhome' ),
                'default' => 1,
                'condition' => [
                    'layout_type' => 'carousel',
                ],
            ]
        );

        $this->add_control(
            'show_nav',
            [
                'label'         => esc_html__( 'Show Navigation', 'justhome' ),
                'type'          => Elementor\Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Show', 'justhome' ),
                'label_off'     => esc_html__( 'Hide', 'justhome' ),
                'return_value'  => true,
                'default'       => true,
                'condition' => [
                    'layout_type' => 'carousel',
                ],
            ]
        );

        $this->add_control(
            'show_pagination',
            [
                'label'         => esc_html__( 'Show Pagination', 'justhome' ),
                'type'          => Elementor\Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Show', 'justhome' ),
                'label_off'     => esc_html__( 'Hide', 'justhome' ),
                'return_value'  => true,
                'default'       => true,
                'condition' => [
                    'layout_type' => 'carousel',
                ],
            ]
        );

        $this->add_control(
            'slider_autoplay',
            [
                'label'         => esc_html__( 'Autoplay', 'justhome' ),
                'type'          => Elementor\Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Yes', 'justhome' ),
                'label_off'     => esc_html__( 'No', 'justhome' ),
                'return_value'  => true,
                'default'       => true,
                'condition' => [
                    'layout_type' => 'carousel',
                ],
            ]
        );

        $this->add_control(
            'infinite_loop',
            [
                'label'         => esc_html__( 'Infinite Loop', 'justhome' ),
                'type'          => Elementor\Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Yes', 'justhome' ),
                'label_off'     => esc_html__( 'No', 'justhome' ),
                'return_value'  => true,
                'default'       => true,
                'condition' => [
                    'layout_type' => 'carousel',
                ],
            ]
        );

        $this->add_control(
            'view_all',
            [
                'label' => esc_html__( 'View All', 'justhome' ),
                'type' => Elementor\Controls_Manager::SWITCHER,
                'default' => '',
                'label_on' => esc_html__( 'Hide', 'justhome' ),
                'label_off' => esc_html__( 'Show', 'justhome' ),
            ]
        );

        $this->add_control(
            'text_view',
            [
                'label' => esc_html__( 'Text View All', 'justhome' ),
                'type' => Elementor\Controls_Manager::TEXT,
                'input_type' => 'text',
                'default' => 'See All Properties',
                'condition' => [
                    'view_all' => ['yes'],
                ]
            ]
        );

        $this->add_control(
            'link_view',
            [
                'label' => esc_html__( 'View Link', 'justhome' ),
                'type' => Elementor\Controls_Manager::TEXT,
                'input_type' => 'url',
                'placeholder' => esc_html__( 'Enter your Link here', 'justhome' ),
                'condition' => [
                    'view_all' => ['yes'],
                ]
            ]
        );

   		$this->add_control(
            'el_class',
            [
                'label'         => esc_html__( 'Extra class name', 'justhome' ),
                'type'          => Elementor\Controls_Manager::TEXT,
                'placeholder'   => esc_html__( 'If you wish to style particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'justhome' ),
            ]
        );

        $this->end_controls_section();

    }

	protected function render() {
        $settings = $this->get_settings();

        extract( $settings );

        $args = array(
            'limit' => $limit,
            'get_agents_by' => $get_agents_by,
            'orderby' => $orderby,
            'order' => $order
        );
        $loop = justhome_get_agents($args);
        if ( $loop->have_posts() ) {

            $columns = !empty($columns) ? $columns : 3;
            $columns_tablet = !empty($columns_tablet) ? $columns_tablet : 3;
            $columns_mobile = !empty($columns_mobile) ? $columns_mobile : 2;
            
            $slides_to_scroll = !empty($slides_to_scroll) ? $slides_to_scroll : $columns;
            $slides_to_scroll_tablet = !empty($slides_to_scroll_tablet) ? $slides_to_scroll_tablet : $slides_to_scroll;
            $slides_to_scroll_mobile = !empty($slides_to_scroll_mobile) ? $slides_to_scroll_mobile : 1;
            ?>
            <div class="widget-agents <?php echo esc_attr($layout_type); ?> <?php echo esc_attr($el_class); ?>">
                <?php if( $title || !empty($content) || ( $view_all == 'yes' && !(empty($link_view)) && !(empty($text_view)) ) ){ ?>
                    <div class="d-sm-flex info-widget-top align-items-end">
                        <div class="info-left">
                            <?php if ( $title ) { ?>
                                <h2 class="widgettitle"><?php echo esc_html($title); ?></h2>
                            <?php } ?>
                            <?php if ( !empty($content) ) { ?>
                                <div class="des"><?php echo trim($content); ?></div>
                            <?php } ?>
                        </div>
                        <?php if ( $view_all == 'yes' && !(empty($link_view)) && !(empty($text_view)) ) { ?>
                             <div class="ms-auto">
                                <a href="<?php echo esc_url( $link_view ); ?>" class="btn-readmore">
                                    <?php echo esc_html($text_view); ?><i class="flaticon-up-right-arrow next"></i>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
                <?php if ( $layout_type == 'carousel' ): ?>
                    <div class="slick-carousel <?php echo esc_attr( ( $loop->post_count <= $columns )?'hidden-dots':'' ); ?>"
                        data-items="<?php echo esc_attr($columns); ?>"
                        data-large="<?php echo esc_attr( $columns_tablet ); ?>"
                        data-medium="<?php echo esc_attr( $columns_tablet ); ?>"
                        data-small="<?php echo esc_attr($columns_mobile); ?>"
                        data-smallest="<?php echo esc_attr($columns_mobile); ?>"

                        data-slidestoscroll="<?php echo esc_attr($slides_to_scroll); ?>"
                        data-slidestoscroll_large="<?php echo esc_attr( $slides_to_scroll_tablet ); ?>"
                        data-slidestoscroll_medium="<?php echo esc_attr( $slides_to_scroll_tablet ); ?>"
                        data-slidestoscroll_small="<?php echo esc_attr($slides_to_scroll_mobile); ?>"
                        data-slidestoscroll_smallest="<?php echo esc_attr($slides_to_scroll_mobile); ?>"
                        
                        data-pagination="<?php echo esc_attr( $show_pagination ? 'true' : 'false' ); ?>" data-nav="<?php echo esc_attr( $show_nav ? 'true' : 'false' ); ?>" data-rows="<?php echo esc_attr( $rows ); ?>" data-infinite="<?php echo esc_attr( $infinite_loop ? 'true' : 'false' ); ?>" data-autoplay="<?php echo esc_attr( $slider_autoplay ? 'true' : 'false' ); ?>">
                        <?php while ( $loop->have_posts() ): $loop->the_post(); ?>
                            <div class="item">
                                <?php echo WP_RealEstate_Template_Loader::get_template_part( 'agents-styles/'.$item_style ); ?>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php else: ?>
                    <?php
                        $mdcol = 12/$columns;
                        $smcol = 12/$columns_tablet;
                        $xscol = 12/$columns_mobile;
                    ?>
                    <div class="row">
                        <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
                            <div class="col-xl-<?php echo esc_attr($mdcol); ?> col-md-<?php echo esc_attr($smcol); ?> col-<?php echo esc_attr($columns_mobile); ?>">
                                <?php echo WP_RealEstate_Template_Loader::get_template_part( 'agents-styles/'.$item_style ); ?>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
                <?php wp_reset_postdata(); ?>
            </div>
            <?php
        }

    }

}

Elementor\Plugin::instance()->widgets_manager->register( new Justhome_Elementor_RealEstate_Agents );