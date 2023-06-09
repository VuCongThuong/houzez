<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
homez_load_select2();
?>
<h1 class="title-profile"><?php esc_html_e( 'Favorite', 'homez' ) ; ?></h1>
<?php
if ( !empty($property_ids) && is_array($property_ids) ) {
	if ( get_query_var( 'paged' ) ) {
	    $paged = get_query_var( 'paged' );
	} elseif ( get_query_var( 'page' ) ) {
	    $paged = get_query_var( 'page' );
	} else {
	    $paged = 1;
	}
	$query_args = array(
		'post_type'         => 'property',
		'posts_per_page'    => get_option('posts_per_page'),
		'paged'    			=> $paged,
		'post_status'       => 'publish',
		'post__in'       	=> $property_ids,
	);
	if ( isset($_GET['search']) ) {
		$query_vars['s'] = $_GET['search'];
	}
	if ( isset($_GET['orderby']) ) {
		switch ($_GET['orderby']) {
			case 'menu_order':
				$query_vars['orderby'] = array(
					'menu_order' => 'ASC',
					'date'       => 'DESC',
					'ID'         => 'DESC',
				);
				break;
			case 'newest':
				$query_vars['orderby'] = 'date';
				$query_vars['order'] = 'DESC';
				break;
			case 'oldest':
				$query_vars['orderby'] = 'date';
				$query_vars['order'] = 'ASC';
				break;
		}
	}

	$properties = new WP_Query($query_args);
	if ( $properties->have_posts() ) { ?>
		<div class="box-white-dashboard pb-0">
			<div class="d-flex align-items-center top-dashboard-search">
				<div class="search-properties-favorite-form widget-search">
					<form action="" method="get">
						<div class="input-group">
							<button class="search-submit btn btn-search" name="submit"><i class="flaticon-search"></i></button>
							<input type="text" placeholder="<?php echo esc_html__( 'Search ...', 'homez' ); ?>" class="form-control" name="search" value="<?php echo esc_attr(isset($_GET['search']) ? $_GET['search'] : ''); ?>">
						</div>
						<input type="hidden" name="paged" value="1" />
					</form>
				</div>
				<div class="sort-properties-favorite-form sortby-form ms-auto">
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
			<div class="row">
				<?php while ( $properties->have_posts() ) : $properties->the_post();
					?>
					<div class="col-12 col-md-6 col-lg-3 property-item-favorite property-favorite-wrapper">
						<?php echo WP_RealEstate_Template_Loader::get_template_part( 'properties-styles/inner-list-favorite' ); ?>
					</div>
					<?php
				endwhile;
				wp_reset_postdata(); ?>
			</div>
			<?php WP_RealEstate_Mixes::custom_pagination( array(
				'max_num_pages' => $properties->max_num_pages,
				'prev_text'     => '<i class="ti-angle-left"></i>',
				'next_text'     => '<i class="ti-angle-right"></i>',
				'wp_query' 		=> $properties
			)); ?>
		</div>
		<?php
	}
?>

<?php } else { ?>
	<div class="not-found box-white-dashboard"><?php esc_html_e('No properties found.', 'homez'); ?></div>
<?php } ?>