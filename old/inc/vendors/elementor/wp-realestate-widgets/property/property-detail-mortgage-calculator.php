<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Justhome_Elementor_Widget_Detail_Property_Mortgage_Calculator extends Elementor\Widget_Base {

	public function get_name() {
		return 'apus_element_detail_property_mortgage_calculator';
	}

	public function get_title() {
		return esc_html__( 'Property Details:: Mortgage Calculator', 'justhome' );
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
            'total_amount',
            [
                'label'         => esc_html__( 'Total Amount', 'justhome' ),
                'type'          => Elementor\Controls_Manager::TEXT,
                'default'   => '70000',
            ]
        );

		$this->add_control(
            'down_payment',
            [
                'label'         => esc_html__( 'Down Payment', 'justhome' ),
                'type'          => Elementor\Controls_Manager::TEXT,
                'default'   => '10000',
            ]
        );

		$this->add_control(
            'interest_rate',
            [
                'label'         => esc_html__( 'Interest rate %', 'justhome' ),
                'type'          => Elementor\Controls_Manager::TEXT,
                'default'   => '3.5',
            ]
        );

        $this->add_control(
            'loan_terms',
            [
                'label'         => esc_html__( 'Loan Terms (Years)', 'justhome' ),
                'type'          => Elementor\Controls_Manager::TEXT,
                'default'   => '15',
            ]
        );

        $this->add_control(
            'property_tax',
            [
                'label'         => esc_html__( 'Property Tax', 'justhome' ),
                'type'          => Elementor\Controls_Manager::TEXT,
                'default'   => '3000',
            ]
        );

        $this->add_control(
            'home_insurance',
            [
                'label'         => esc_html__( 'Home Insurance', 'justhome' ),
                'type'          => Elementor\Controls_Manager::TEXT,
                'default'   => '1000',
            ]
        );

        $this->add_control(
			'principal_interest_color',
			[
				'label' => esc_html__( 'Principal Interest Color', 'justhome' ),
				'type' => Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => Elementor\Core\Schemes\Color::get_type(),
					'value' => Elementor\Core\Schemes\Color::COLOR_1,
				],
			]
		);

        $this->add_control(
			'property_tax_color',
			[
				'label' => esc_html__( 'Property Tax Color', 'justhome' ),
				'type' => Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => Elementor\Core\Schemes\Color::get_type(),
					'value' => Elementor\Core\Schemes\Color::COLOR_1,
				],
			]
		);

        $this->add_control(
			'home_insurance_color',
			[
				'label' => esc_html__( 'Home Insurance Color', 'justhome' ),
				'type' => Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => Elementor\Core\Schemes\Color::get_type(),
					'value' => Elementor\Core\Schemes\Color::COLOR_1,
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
	        

			$current_currency = WP_RealEstate_Price::get_current_currency();
			$multi_currencies = WP_RealEstate_Price::get_currencies_settings();

			if ( !empty($multi_currencies) && !empty($multi_currencies[$current_currency]) ) {
				$currency_args = $multi_currencies[$current_currency];
			}

			if ( !empty($currency_args) ) {
				$currency_symbol = !empty($currency_args['custom_symbol']) ? $currency_args['custom_symbol'] : '';
				if ( empty($currency_symbol) ) {
					$currency = !empty($currency_args['currency']) ? $currency_args['currency'] : 'USD';
					$currency_symbol = WP_RealEstate_Price::currency_symbol($currency);
				}
			}


			$meta_obj = WP_RealEstate_Property_Meta::get_instance($post->ID);
			$price = $meta_obj->get_post_meta( 'price' );

			if ( empty( $price ) || ! is_numeric( $price ) ) {
				$price = $total_amount;
			} elseif ( $price < $down_payment ) {
				$price = $total_amount;
			}

			?>

			<div class="apus-mortgage-calculator">
				<div class="row apus-mortgage-wrapper ">
					<div class="col-12 apus-mortgage-inner">
						<div class="apus_mortgage_results d-lg-flex align-items-center">

							<div class="mortgage-calculator-chart-wrapper">
								<?php
									$principal_interest_color = justhome_get_config('mortgage_calculator_principal_interest_color', '#E7C873');
									$property_tax_color = justhome_get_config('mortgage_calculator_property_tax_color', '#58A0E5');
									$home_insurance_color = justhome_get_config('mortgage_calculator_home_insurance_color', '#EB6E85');
								?>
								<div class="position-relative">
									<canvas class="mortgage-calculator-chart" id="mortgage-calculator-chart" width="250" height="250" data-principal_interest="<?php echo esc_attr($principal_interest_color); ?>" data-property_tax="<?php echo esc_attr($property_tax_color); ?>" data-home_insurance="<?php echo esc_attr($home_insurance_color); ?>"></canvas>

									<div class="monthly-payment-wrap text-center">
										<div class="monthly-payment monthly-payment-val">
											<?php echo WP_RealEstate_Price::format_price( $price ); ?>
										</div>
										<div class="monthly-requency"><?php esc_html_e('pre monthly', 'justhome'); ?></div>
									</div>
								</div>

								<div class="d-flex align-items-center flex-wrap calculator-chart-percent d-none">
									<div class="principal-interest-st" style="background-color: <?php echo esc_attr($principal_interest_color); ?>;"></div>
									<div class="property-tax-st" style="background-color: <?php echo esc_attr($property_tax_color); ?>;"></div>
									<div class="home-insurance-st" style="background-color: <?php echo esc_attr($home_insurance_color); ?>;"></div>
								</div>
								
							</div><!-- mortgage-calculator-chart -->

							<ul class="list list-result-calculator d-flex flex-wrap">

								<li>
									<span class="name-result"><?php esc_html_e('Principal & Interest', 'justhome'); ?></span> 
									<span class="principal-interest-val"></span>
								</li>

								<li>
									<span class="name-result"><?php esc_html_e('Property Tax', 'justhome'); ?></span> 
									<span class="property-tax-val"></span>
								</li>

								<li> 
									<span class="name-result"><?php esc_html_e('Home Insurance', 'justhome'); ?></span> 
									<span class="home-insurance-val"></span>
								</li>

							</ul>
						</div>
					</div>
					<div class="col-12 apus-mortgage-inner-bottom">
						<form method="post" class="mortgage-calculator-form form-theme">
							<input class="currency_symbol d-none" type="text" name="currency_symbol" value="<?php echo esc_attr($currency_symbol); ?>">
							<div class="row row-20">
								<div class="col-12 col-sm-6 col-lg-4">
									<div class="form-group">
										<input id="total-amount-id" class="form-control total-amount" type="text" value="<?php echo esc_attr($price); ?>">
										<label for="total-amount-id" class="for-control"><?php esc_html_e( 'Total Amount ', 'justhome' ); echo trim('('.$currency_symbol).')'; ?></label>
									</div>
								</div>
								<div class="col-12 col-sm-6 col-lg-4">
									<div class="form-group">
										<input id="down-payment-id" class="form-control down-payment" type="text" value="<?php echo esc_attr($down_payment); ?>">
										<label for="down-payment-id" class="for-control"><?php esc_html_e( 'Down Payment ', 'justhome' ); echo trim('('.$currency_symbol).')'; ?></label>
									</div>
								</div>
								<div class="col-12 col-sm-6 col-lg-4">
									<div class="form-group">
										<input id="interest-rate-id" class="form-control interest-rate" type="text" value="<?php echo esc_attr(justhome_get_config('mortgage_calculator_interest_rate', '3.5')); ?>">
										<label for="interest-rate-id" class="for-control"><?php esc_html_e( 'Interest Rate %', 'justhome' ); ?></label>
									</div>
								</div>

								<div class="col-12 col-sm-6 col-lg-4">
									<div class="form-group">
										<input id="loan-terms-id" class="form-control loan-terms" type="text" value="<?php echo esc_attr(justhome_get_config('mortgage_calculator_loan_terms', '15')); ?>">
										<label for="loan-terms-id" class="for-control"><?php esc_html_e( 'Loan Terms (Years)', 'justhome' ); ?></label>
									</div>
								</div>
								<div class="col-12 col-sm-6 col-lg-4">
									<div class="form-group">
										<input id="property-tax-id" class="form-control property-tax" type="text" value="<?php echo esc_attr(justhome_get_config('mortgage_calculator_property_tax', '3000')); ?>">
										<label for="property-tax-id" class="for-control"><?php esc_html_e( 'Property Tax ', 'justhome' ); echo trim('('.$currency_symbol).')'; ?></label>
									</div>
								</div>
								<div class="col-12 col-sm-6 col-lg-4">
									<div class="form-group">
										<input id="home-insurance-id" class="form-control home-insurance" type="text" value="<?php echo esc_attr(justhome_get_config('mortgage_calculator_home_insurance', '1000')); ?>">
										<label for="home-insurance-id" class="for-control"><?php esc_html_e( 'Home Insurance ', 'justhome' ); echo trim('('.$currency_symbol).')'; ?></label>
									</div>
								</div>
							</div>
							<div class="wrapper-submit">
								<button class="btn btn-theme btn-mortgage-calculator" type="button"><?php esc_html_e('CALCULATE', 'justhome'); ?><i class="flaticon-up-right-arrow next"></i></button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<?php
	    }
	}

}

Elementor\Plugin::instance()->widgets_manager->register( new Justhome_Elementor_Widget_Detail_Property_Mortgage_Calculator );
