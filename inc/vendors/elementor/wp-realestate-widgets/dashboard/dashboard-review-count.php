<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Justhome_Elementor_Widget_Dashboard_Review_Count extends Elementor\Widget_Base {

	public function get_name() {
		return 'apus_element_dashboard_review_count';
	}

	public function get_title() {
		return esc_html__( 'Dashboard:: Review Count', 'justhome' );
	}
	
	public function get_categories() {
		return [ 'justhome-dashboard-elements' ];
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
				'default' => 'Reviews',
			]
		);

		$this->add_control(
			'selected_icon',
			[
				'label' => esc_html__( 'Icon', 'justhome' ),
				'type' => Elementor\Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'fa-solid',
				],
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

		?>
		<div class="dashboard-review-count <?php echo esc_attr($el_class); ?>">
			<?php
			$user_id = get_current_user_id();

			$query_vars = array(
				'post_type'     => 'property',
				'post_status'   => 'publish',
				'author'        => $user_id,
				'fields'		=> 'ids',
				'posts_per_page' => -1
			);
			$properties = new WP_Query($query_vars);

			$post_ids = array();
			if ( !empty($properties->posts) ) {
				$post_ids = $properties->posts;
			}

			$args = array(
				'post_type' => array('property'),
				'status' => 'approve',
				'number'  => -1,
				'fields'  => 'ids',
				'meta_query' => array(
			        array(
			           'key' => '_rating_avg',
			           'value' => 0,
			           'compare' => '>',
			        )
			    )
			);
			$comments_count = 0;
			if ( !empty($post_ids) ) {
				$comments = WP_RealEstate_Review::get_comments( $args, $post_ids );
				if ( $comments ) {
					$comments_count = count($comments);
				}
			}
			?>
			<div class="statistics dashboard-box d-flex align-items-center">
				<div class="inner-left flex-grow-1">
					<div class="properties-count"><?php echo WP_RealEstate_Mixes::format_number($comments_count); ?></div>
					<?php if ( $title ) { ?>
						<h4><?php echo esc_html($title); ?></h4>
					<?php } ?>
				</div>
				<div class="inner-right d-flex align-items-center justify-content-center">
					<?php
					if ( empty( $settings['icon'] ) && ! Elementor\Icons_Manager::is_migration_allowed() ) {
						// add old default
						$settings['icon'] = 'fa fa-star';
					}

					if ( ! empty( $settings['icon'] ) ) {
						$this->add_render_attribute( 'icon', 'class', $settings['icon'] );
						$this->add_render_attribute( 'icon', 'aria-hidden', 'true' );
					}

					$migrated = isset( $settings['__fa4_migrated']['selected_icon'] );
					$is_new = empty( $settings['icon'] ) && Elementor\Icons_Manager::is_migration_allowed();
					if ( $is_new || $migrated ) {
						if(!empty($settings['selected_icon']['value'])){
							Elementor\Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] );
						} else{
							echo '<i class="flaticon-email"></i>';
						}
					} else { ?>
						<i <?php $this->print_render_attribute_string( 'icon' ); ?>></i>
					<?php } ?>
				</div>
			</div>
		</div>
		<?php
	}

}

Elementor\Plugin::instance()->widgets_manager->register( new Justhome_Elementor_Widget_Dashboard_Review_Count );
