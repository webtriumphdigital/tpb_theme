<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Justhome_Elementor_Widget_Agent_Archive_Maps extends Elementor\Widget_Base {

	public function get_name() {
		return 'apus_element_agent_archive_maps';
	}

	public function get_title() {
		return esc_html__( 'Agent Archive:: Maps', 'justhome' );
	}

	public function get_categories() {
		return [ 'justhome-agent-archive-elements' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_title',
			[
				'label' => esc_html__( 'Title', 'justhome' ),
			]
		);

		$this->add_control(
            'select_height',
            [
                'label' => esc_html__( 'Customize Height', 'justhome' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => array(
                    'full' => esc_html__('Full', 'justhome'),
                    'customize' => esc_html__('Customize', 'justhome'),
                ),
                'default' => 'full'
            ]
        );

		$this->add_responsive_control(
            'height',
            [
                'label' => esc_html__( 'Height', 'justhome' ),
                'type' => Elementor\Controls_Manager::SLIDER,
                'default' => [
                    'size' => 235,
                ],
                'range' => [
                    'px' => [
                        'min' => 235,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} #agents-google-maps' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'select_height' => 'customize',
                ],
            ]
        );

        $this->add_control(
            'show_mobile',
            [
                'label'         => esc_html__( 'Always Show Mobile', 'justhome' ),
                'type'          => Elementor\Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Show', 'justhome' ),
                'label_off'     => esc_html__( 'Hide', 'justhome' ),
                'return_value'  => true,
                'default'       => true,
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
            'section_box_style',
            [
                'label' => esc_html__( 'Style', 'justhome' ),
                'tab' => Elementor\Controls_Manager::TAB_STYLE,
            ]
        );


		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings();

        extract( $settings );
		?>
		<div class="agent-maps <?php echo esc_attr($el_class); ?>">
			<?php if ( empty($show_mobile) ) { ?>
                <span class="action-show-filters action-mobile-map text-theme d-inline-block d-dk-none"><i class="flaticon-filter pre"></i><?php esc_html_e('Show Map','justhome') ?></span>
            <?php } ?>
			<div id="agents-google-maps" class="<?php echo esc_attr( ($select_height == "full")?'fix-map':'' ) ?>"></div>
		</div>
		<?php
	}

}

Elementor\Plugin::instance()->widgets_manager->register( new Justhome_Elementor_Widget_Agent_Archive_Maps );
