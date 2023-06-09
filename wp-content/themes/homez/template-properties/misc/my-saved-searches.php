<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
homez_load_select2();
?>
<div class="clearfix">
	
	<h3 class="title-profile"><?php echo esc_html__('My Saved Search','homez') ?></h3>
	<?php if ( !empty($alerts) && !empty($alerts->posts) ) {
		$email_frequency_default = WP_RealEstate_Saved_Search::get_email_frequency(); ?>
		<div class="box-white-dashboard">

			<div class="d-flex align-items-center top-dashboard-search">
					<div class="search-properties-saved-search-form widget-search">
						<form action="" method="get">
							<div class="input-group">
								<input type="text" placeholder="<?php echo esc_html__( 'Search ...', 'homez' ); ?>" class="form-control" name="search" value="<?php echo esc_attr(isset($_GET['search']) ? $_GET['search'] : ''); ?>">
									<button class="search-submit btn btn-search" name="submit">
										<i class="flaticon-search"></i>
									</button>
							</div>
							<input type="hidden" name="paged" value="1" />
						</form>
					</div>
					<div class="sort-properties-saved-search-form sortby-form ms-auto sort-my-properties-form">
						<?php
							$orderby_options = apply_filters( 'wp_realestate_my_properties_orderby', array(
								'menu_order'	=> esc_html__( 'Default', 'homez' ),
								'newest' 		=> esc_html__( 'Newest', 'homez' ),
								'oldest'     	=> esc_html__( 'Oldest', 'homez' ),
							) );

							$orderby = isset( $_GET['orderby'] ) ? wp_unslash( $_GET['orderby'] ) : 'newest'; 
						?>

						<div class="orderby-wrapper d-flex align-items-center">
							<span class="text-sort">
								<?php echo esc_html__('Sort by: ','homez'); ?>
							</span>
							<form class="my-properties-ordering" method="get">
								<select name="orderby" class="orderby">
									<?php foreach ( $orderby_options as $id => $name ) : ?>
										<option value="<?php echo esc_attr( $id ); ?>" <?php selected( $orderby, $id ); ?>><?php echo esc_html( $name ); ?></option>
									<?php endforeach; ?>
								</select>
								<input type="hidden" name="paged" value="1" />
								<?php WP_RealEstate_Mixes::query_string_form_fields( null, array( 'orderby', 'submit', 'paged' ) ); ?>
							</form>
						</div>
					</div>
			</div>

			<div class="wrapper-save-search">
			<div class="table-responsive">
				<table class="property-table user-transactions">
					<thead>
						<tr>
							<td class="title"><?php esc_html_e('Title', 'homez'); ?></td>
							<td class="alert-query"><?php esc_html_e('Saved Search Query', 'homez'); ?></td>
							<td class="property-number"><?php esc_html_e('Number Properties', 'homez'); ?></td>
							<td class="property-times"><?php esc_html_e('Times', 'homez'); ?></td>
							<td class="property-actions"><?php esc_html_e('Actions', 'homez'); ?></td>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($alerts->posts as $saved_search_id) {
						
						$email_frequency = get_post_meta($saved_search_id, WP_REALESTATE_PROPERTY_SAVED_SEARCH_PREFIX . 'email_frequency', true);
						if ( !empty($email_frequency_default[$email_frequency]['label']) ) {
							$email_frequency = $email_frequency_default[$email_frequency]['label'];
						}

						$saved_search_query = get_post_meta($saved_search_id, WP_REALESTATE_PROPERTY_SAVED_SEARCH_PREFIX . 'saved_search_query', true);
						$params = null;
						if ( !empty($saved_search_query) ) {
							$params = json_decode($saved_search_query, true);
						}

						$query_args = array(
							'post_type' => 'property',
						    'post_status' => 'publish',
						    'post_per_page' => 1,
						    'fields' => 'ids'
						);
						$properties = WP_RealEstate_Query::get_posts($query_args, $params);
						$count_properties = $properties->found_posts;

						$properties_saved_search_url = WP_RealEstate_Mixes::get_properties_page_url();
						if ( !empty($params) ) {
							foreach ($params as $key => $value) {
								if ( is_array($value) ) {
									$properties_saved_search_url = remove_query_arg( $key.'[]', $properties_saved_search_url );
									foreach ($value as $val) {
										$properties_saved_search_url = add_query_arg( $key.'[]', $val, $properties_saved_search_url );
									}
								} else {
									$properties_saved_search_url = add_query_arg( $key, $value, remove_query_arg( $key, $properties_saved_search_url ) );
								}
							}
						}
						?>

						<?php do_action( 'wp_realestate_before_saved_search_content', $saved_search_id ); ?>
						<tr <?php post_class('saved-search-wrapper'); ?>>
							<td class="property-table-info-content-title">
						        <a href="<?php echo esc_url($properties_saved_search_url); ?>" rel="bookmark"><?php echo get_the_title($saved_search_id); ?></a>
							</td>
							<td>
								<div class="alert-query">
						        	<?php
						        	$params = WP_RealEstate_Abstract_Filter::get_filters($params);
						        	if ( $params ) {
						        		?>
						        		<ul class="list">
						        			<?php
							        			foreach ($params as $key => $value) {
							        				WP_RealEstate_Property_Filter::display_filter_value_simple($key, $value, $params);
							        			}
						        			?>
						        		</ul>
						        	<?php } ?>
						        </div>
							</td>
							<td>
								<div class="property-found">
						            <?php echo sprintf(esc_html__('Properties found %d', 'homez'), intval($count_properties) ); ?>
						        </div>
							</td>
							<td>
								<div class="property-metas">
						            <?php echo trim($email_frequency); ?>
						        </div>
							</td>
							<td>
								<a href="javascript:void(0)" class="btn-remove-saved-search btn-action-icon deleted" data-saved_search_id="<?php echo esc_attr($saved_search_id); ?>" data-nonce="<?php echo esc_attr(wp_create_nonce( 'wp-realestate-remove-saved-search-nonce' )); ?>"><i class="flaticon-bin"></i></a>
							</td>
						</tr>
						
						<?php do_action( 'wp_realestate_after_saved_search_content', $saved_search_id );
					}

					?>
					</tbody>
				</table>
			</div>
			</div>

			<?php WP_RealEstate_Mixes::custom_pagination( array(
				'wp_query' => $alerts,
				'max_num_pages' => $alerts->max_num_pages,
				'prev_text'     => esc_html__( 'Previous page', 'homez' ),
				'next_text'     => esc_html__( 'Next page', 'homez' ),
			)); ?>
		</div>

	<?php } else { ?>
		<div class="not-found box-white-dashboard"><?php esc_html_e('No property alert found.', 'homez'); ?></div>
	<?php } ?>
</div>