<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Justhome_Elementor_Widget_Property_Archive_Sortby extends Elementor\Widget_Base {

	public function get_name() {
		return 'apus_element_property_archive_sortby';
	}

	public function get_title() {
		return esc_html__( 'Property Archive:: Sort By', 'justhome' );
	}

	public function get_categories() {
		return [ 'justhome-property-archive-elements' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_title',
			[
				'label' => esc_html__( 'Settings', 'justhome' ),
			]
		);

		$this->add_control(
            'title',
            [
                'label'         => esc_html__( 'Title', 'justhome' ),
                'type'          => Elementor\Controls_Manager::TEXT,
                'default'   	=> 'Sort by',
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

		$this->start_controls_section(
			'section_title_style',
			[
				'label' => esc_html__( 'Title', 'justhome' ),
				'tab' => Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Text Color', 'justhome' ),
				'type' => Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => Elementor\Core\Schemes\Color::get_type(),
					'value' => Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					// Stronger selector to avoid section style from overwriting
					'{{WRAPPER}} .results-count' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'scheme' => Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .results-count',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings();

        extract( $settings );
        
		$orderby_options = apply_filters( 'wp-realestate-properties-orderby', array(
			'menu_order' => esc_html__('Default', 'justhome'),
			'newest' => esc_html__('Newest', 'justhome'),
			'oldest' => esc_html__('Oldest', 'justhome'),
			'price-lowest' => esc_html__('Lowest Price', 'justhome'),
			'price-highest' => esc_html__('Highest Price', 'justhome'),
			'random' => esc_html__('Random', 'justhome'),
		));
		$orderby = isset( $_GET['filter-orderby'] ) ? wp_unslash( $_GET['filter-orderby'] ) : 'menu_order';
		if ( !WP_RealEstate_Mixes::is_ajax_request() ) {
			wp_enqueue_script('wre-select2');
			wp_enqueue_style('wre-select2');
		}
		?>
		<div class="properties-ordering-wrapper <?php echo esc_attr($el_class); ?>">
			<form class="properties-ordering" method="get" action="<?php echo WP_RealEstate_Mixes::get_properties_page_url(); ?>">
				<?php if ( $title ) { ?>
					<div class="label"><?php echo esc_html($title); ?></div>
				<?php } ?>
				<select name="filter-orderby" class="orderby" <?php if ( $title ) { ?>data-placeholder="<?php echo esc_attr($title); ?>" <?php } ?>>
					<?php foreach ( $orderby_options as $id => $name ) : ?>
						<option value="<?php echo esc_attr( $id ); ?>" <?php selected( $orderby, $id ); ?>><?php echo esc_html( $name ); ?></option>
					<?php endforeach; ?>
				</select>
				<input type="hidden" name="paged" value="1" />
				<?php WP_RealEstate_Mixes::query_string_form_fields( null, array( 'filter-orderby', 'submit', 'paged' ) ); ?>
			</form>
		</div>
		<?php
	}

}

Elementor\Plugin::instance()->widgets_manager->register( new Justhome_Elementor_Widget_Property_Archive_Sortby );
