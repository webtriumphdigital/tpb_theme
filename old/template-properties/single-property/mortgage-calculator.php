<?php

global $post;
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


$down_payment = justhome_get_config('mortgage_calculator_down_payment', '10000');
$meta_obj = WP_RealEstate_Property_Meta::get_instance($post->ID);
$price = $meta_obj->get_post_meta( 'price' );

if ( empty( $price ) || ! is_numeric( $price ) ) {
	$price = justhome_get_config('mortgage_calculator_total_amount', '70000');
} elseif ( $price < $down_payment ) {
	$price = justhome_get_config('mortgage_calculator_total_amount', '70000');
}

?>

<div class="apus-mortgage-calculator">
	<h3 class="title"><?php esc_html_e('Mortgage Calculator', 'justhome'); ?></h3>
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
					<div class="col-6 col-lg-4">
						<div class="form-group">
							<input id="total-amount-id" class="form-control total-amount" type="text" value="<?php echo esc_attr($price); ?>">
							<label for="total-amount-id" class="for-control"><?php esc_html_e( 'Total Amount ', 'justhome' ); echo trim('('.$currency_symbol).')'; ?></label>
						</div>
					</div>
					<div class="col-6 col-lg-4">
						<div class="form-group">
							<input id="down-payment-id" class="form-control down-payment" type="text" value="<?php echo esc_attr($down_payment); ?>">
							<label for="down-payment-id" class="for-control"><?php esc_html_e( 'Down Payment ', 'justhome' ); echo trim('('.$currency_symbol).')'; ?></label>
						</div>
					</div>
					<div class="col-6 col-lg-4">
						<div class="form-group">
							<input id="interest-rate-id" class="form-control interest-rate" type="text" value="<?php echo esc_attr(justhome_get_config('mortgage_calculator_interest_rate', '3.5')); ?>">
							<label for="interest-rate-id" class="for-control"><?php esc_html_e( 'Interest Rate %', 'justhome' ); ?></label>
						</div>
					</div>

					<div class="col-6 col-lg-4">
						<div class="form-group">
							<input id="loan-terms-id" class="form-control loan-terms" type="text" value="<?php echo esc_attr(justhome_get_config('mortgage_calculator_loan_terms', '15')); ?>">
							<label for="loan-terms-id" class="for-control"><?php esc_html_e( 'Loan Terms (Years)', 'justhome' ); ?></label>
						</div>
					</div>
					<div class="col-6 col-lg-4">
						<div class="form-group">
							<input id="property-tax-id" class="form-control property-tax" type="text" value="<?php echo esc_attr(justhome_get_config('mortgage_calculator_property_tax', '3000')); ?>">
							<label for="property-tax-id" class="for-control"><?php esc_html_e( 'Property Tax ', 'justhome' ); echo trim('('.$currency_symbol).')'; ?></label>
						</div>
					</div>
					<div class="col-6 col-lg-4">
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