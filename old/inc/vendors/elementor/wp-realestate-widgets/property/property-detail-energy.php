<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Justhome_Elementor_Widget_Detail_Property_Energy extends Elementor\Widget_Base {

	public function get_name() {
		return 'apus_element_detail_property_energy';
	}

	public function get_title() {
		return esc_html__( 'Property Details:: Energy', 'justhome' );
	}

	public function get_categories() {
		return [ 'justhome-property-detail-elements' ];
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
                'label' => esc_html__( 'Title', 'justhome' ),
                'type' => Elementor\Controls_Manager::TEXT,
                'input_type' => 'text',
                'placeholder' => esc_html__( 'Enter your title here', 'justhome' ),
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
        if ( justhome_is_property_single_page() ) {
        	global $post;
			$post_id = get_the_ID();
		} else {
			$args = array(
				'limit' => 1,
				'fields' => 'ids',
			);
			$properties = justhome_get_properties($args);
			if ( !empty($properties->posts) ) {
				$post_id = $properties->posts[0];
				$post = get_post($post_id);
			}
		}
		if ( !empty($post) ) {
	        ?>
	        <?php if ( $energy_class ) { ?>
                            <h2 class="title-related-properties"><?php echo esc_html($title); ?></h2>
                        <?php } ?>
			<div class="property-detail-energy <?php echo esc_attr($el_class); ?>">
				<?php
				$meta_obj = WP_RealEstate_Property_Meta::get_instance($post->ID);
				if ( $meta_obj->check_post_meta_exist('energy_class') && ($energy_class = $meta_obj->get_post_meta('energy_class')) ) {
				    $options = array(
				        'A+' => esc_html__('A+', 'justhome'),
				        'A' => esc_html__('A', 'justhome'),
				        'B' => esc_html__('B', 'justhome'),
				        'C' => esc_html__('C', 'justhome'),
				        'D' => esc_html__('D', 'justhome'),
				        'E' => esc_html__('E', 'justhome'),
				        'F' => esc_html__('F', 'justhome'),
				        'G' => esc_html__('G', 'justhome'),
				        'H' => esc_html__('H', 'justhome'),
				    );
				?>
			        <div class="inner">
			            <div class="energy-inner-top">
			                <ul class="list">
			                    <li>
			                        <div class="text"><?php echo esc_html($meta_obj->get_post_meta_title( 'energy_class' )); ?>:</div>
			                        <div class="value"><?php echo trim($energy_class); ?></div>
			                    </li>
			                    <?php if ( $meta_obj->check_post_meta_exist('energy_index') && ($energy_index = $meta_obj->get_post_meta('energy_index')) ) { ?>
			                        <li>
			                            <div class="text"><?php echo esc_html($meta_obj->get_post_meta_title( 'energy_index' )); ?>:</div>
			                            <div class="value"><?php echo trim($energy_index); ?></div>
			                        </li>
			                    <?php } ?>
			                </ul>
			            </div>
			            <div class="energy-inner d-flex align-items-center">
			                <?php foreach ($options as $key => $title) {
			                    $classs = 'energy-'. strtolower($key);
			                    if ( $key == 'A+' ) {
			                        $classs = 'energy-aplus';
			                    }
			                ?>
			                    <div class="energy-group <?php echo esc_attr($classs); ?>">
			                        <?php echo esc_html($title); ?>
			                        <?php if ( $energy_class == $key ) {
			                            $energy_index = $meta_obj->get_post_meta('energy_index');
			                            $energy_index_text = '';
			                            if ( !empty($energy_index) ) {
			                                $energy_index_text = $energy_index.' '.esc_html__('kWh/m²a', 'justhome'). ' |';
			                            }
			                        ?>
			                            <div class="indicator-energy">
			                                <?php echo sprintf(esc_html__('%s Your energy class is %s', 'justhome'), $energy_index_text, $title); ?>
			                            </div>
			                        <?php } ?>
			                    </div>
			                <?php } ?>
			            </div>
			        </div>

			        <?php do_action('wp-realestate-single-property-energy', $post); ?>

				<?php }
				?>
			</div>
			<?php
	    }
	}

}

Elementor\Plugin::instance()->widgets_manager->register( new Justhome_Elementor_Widget_Detail_Property_Energy );
