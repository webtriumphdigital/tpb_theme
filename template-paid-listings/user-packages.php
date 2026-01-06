<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
if ( $user_packages ) : ?>
	<div class="widget-your-packages">
		<h2 class="title-profile"><?php esc_html_e( 'Your Packages', 'justhome' ); ?></h2>
		<div class="box-white-dashboard">
			<div class="user-property-packaged row">
				<?php
					$prefix = WP_REALESTATE_WC_PAID_LISTINGS_PREFIX;
					$checked = 1; foreach ( $user_packages as $key => $package ) :
					$package_count = get_post_meta($package->ID, $prefix.'package_count', true);
					$property_limit = get_post_meta($package->ID, $prefix.'property_limit', true);
					$property_duration = get_post_meta($package->ID, $prefix.'property_duration', true);
				?>
						<div class="col-6 col-md-3">
							<div class="inner-user-property-packaged">
								<?php if ( defined('WP_REALESTATE_WC_PAID_LISTINGS_PLUGIN_VERSION') && version_compare(WP_REALESTATE_WC_PAID_LISTINGS_PLUGIN_VERSION, '2.2.0', '>=') ) { ?>
									<input type="radio" <?php checked( $checked, 1 ); ?> name="wjbwpl_property_package" value="user-<?php echo esc_attr($package->ID); ?>" id="user-package-<?php echo esc_attr($package->ID); ?>" />
								<?php } else { ?>
									<input type="radio" <?php checked( $checked, 1 ); ?> name="wjbwpl_listing_user_package" value="<?php echo esc_attr($package->ID); ?>" id="user-package-<?php echo esc_attr($package->ID); ?>" />
								<?php } ?>

								<label for="user-package-<?php echo esc_attr($package->ID); ?>">
									<span class="value">
										<?php echo trim($package->post_title); ?>
									</span>
									<span class="des-package">
										<?php
											if ( $property_limit ) {
												printf( _n( '%s property posted out of %d', '%s properties posted out of %d', $package_count, 'justhome' ), $package_count, $property_limit );
											} else {
												printf( _n( '%s property posted', '%s properties posted', $package_count, 'justhome' ), $package_count );
											}

											if ( $property_duration ) {
												printf(  ', ' . _n( 'listed for %s day', 'listed for %s days', $property_duration, 'justhome' ), $property_duration );
											}

											$checked = 0;
										?>
									</span>
								</label>
							</div>
						</div>
				<?php endforeach; ?>
			</div>
			<div class="bottom-packages mt-2">
				<button class="btn btn-theme" type="submit">
					<?php esc_html_e('Add Listing', 'justhome') ?><svg class="next" xmlns="http://www.w3.org/2000/svg" width="14" height="12" viewBox="0 0 14 12" fill="none"><path d="M0.8125 5.43752H12.0341L7.73716 1.34477C7.51216 1.13045 7.50344 0.77439 7.71775 0.54939C7.93178 0.324671 8.28784 0.315671 8.51312 0.529984L13.4204 5.20436C13.6327 5.41698 13.75 5.69936 13.75 6.00002C13.75 6.30039 13.6327 6.58305 13.4105 6.80495L8.51284 11.4698C8.404 11.5735 8.2645 11.625 8.125 11.625C7.9765 11.625 7.828 11.5665 7.71747 11.4504C7.50316 11.2254 7.51188 10.8696 7.73688 10.6553L12.0518 6.56252H0.8125C0.502 6.56252 0.25 6.31052 0.25 6.00002C0.25 5.68952 0.502 5.43752 0.8125 5.43752Z" fill="currentColor"></path></svg>
				</button>
			</div>
		</div>
	</div>
<?php endif; ?>