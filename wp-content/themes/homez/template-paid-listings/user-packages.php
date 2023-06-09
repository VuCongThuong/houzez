<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
if ( $user_packages ) : ?>
	<div class="widget-your-packages">
		<h2 class="title-profile"><?php esc_html_e( 'Your Packages', 'homez' ); ?></h2>
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
												printf( _n( '%s property posted out of %d', '%s properties posted out of %d', $package_count, 'homez' ), $package_count, $property_limit );
											} else {
												printf( _n( '%s property posted', '%s properties posted', $package_count, 'homez' ), $package_count );
											}

											if ( $property_duration ) {
												printf(  ', ' . _n( 'listed for %s day', 'listed for %s days', $property_duration, 'homez' ), $property_duration );
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
				<button class="btn btn-theme btn-outline" type="submit">
					<?php esc_html_e('ADD LISTING', 'homez') ?><i class="flaticon-up-right-arrow next"></i>
				</button>
			</div>
		</div>
	</div>
<?php endif; ?>