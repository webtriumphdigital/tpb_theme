<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Justhome_Elementor_Widget_Dashboard_Chart extends Elementor\Widget_Base {

	public function get_name() {
		return 'apus_element_dashboard_chart';
	}

	public function get_title() {
		return esc_html__( 'Dashboard:: Chart', 'justhome' );
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
				'default' => 'Page Views',
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

        $query_vars = array(
			'post_type'     => 'property',
			'post_status'   => apply_filters('wp-realestate-my-properties-post-statuses', array( 'publish', 'expired', 'pending', 'pending_approve', 'pending_payment', 'draft', 'preview' )),
			'paged'         => 1,
			'author'        => get_current_user_id(),
			'orderby'		=> 'date',
			'order'			=> 'DESC',
			'fields'			=> 'ids'
		);

		$properties = new WP_Query($query_vars);
		?>
		<div class="dashboard-chart <?php echo esc_attr($el_class); ?>">
			
				
				<?php
				if ( !empty($properties->posts) ) {
					justhome_load_select2();
				?>
					<div class="box-white-dashboard">
						<div class="heading-inner">
							<?php if ( $title ) { ?>
								<h4 class="title"><?php echo esc_html($title); ?></h4>
							<?php } ?>
							<div class="search-form-stats">
								<form class="stats-graph-search-form form-theme" method="post">
									<div class="row">
										<div class="col-sm-6 col-12">
											<div class="form-group">
												<label><?php esc_html_e('Select Properties', 'justhome'); ?></label>
												<select class="form-control" name="property_id">
													<?php foreach ($properties->posts as $post_id) { ?>
														<option value="<?php echo esc_attr($post_id); ?>"><?php echo esc_html(get_the_title($post_id)); ?></option>
													<?php } ?>
												</select>
											</div>
										</div>

										<div class="col-sm-6 col-12">
											<div class="form-group">
												<label><?php esc_html_e('Date', 'justhome'); ?></label>
												<select class="form-control" name="nb_days">
													<option value="30"><?php esc_html_e('30 days', 'justhome'); ?></option>
													<option value="15" selected><?php esc_html_e('15 days', 'justhome'); ?></option>
													<option value="7"><?php esc_html_e('7 days', 'justhome'); ?></option>
												</select>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>

						<div class="page_views-wrapper">
							<canvas id="dashboard_property_chart_wrapper" data-property_id="<?php echo esc_attr($properties->posts[0]); ?>" data-nonce="<?php echo esc_attr(wp_create_nonce( 'wp-realestate-property-chart-nonce' )); ?>"></canvas>
						</div>
					</div>
				<?php } ?>
		</div>
		<?php
	}

}

Elementor\Plugin::instance()->widgets_manager->register( new Justhome_Elementor_Widget_Dashboard_Chart );
