<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$agents_display_mode = homez_get_agents_display_mode();

$total = $agents->found_posts;
$per_page = $agents->query_vars['posts_per_page'];
$current = max( 1, $agents->get( 'paged', 1 ) );
$last  = min( $total, $per_page * $current );

$pre_page  = max( 0, ($agents->get( 'paged', 1 ) - 1 ) );
$i =  $per_page * $pre_page;

?>
<div class="results-count">
	<span class="last"><?php echo esc_html($last); ?></span>
</div>

<div class="items-wrapper">
	
	<?php 
	$i = 0;
	$columns = homez_get_agents_columns();
	$bcol = $columns ? 12/$columns : 4;
	if ( $agents_display_mode == 'grid' ) {
	?>
			<?php while ( $agents->have_posts() ) : $agents->the_post(); ?>
				<div class="col-6 col-md-4 col-xl-<?php echo esc_attr($bcol); ?>">
					<?php echo WP_RealEstate_Template_Loader::get_template_part( 'agents-styles/inner-grid' ); ?>
				</div>
			<?php $i++; endwhile; ?>
	<?php } else { ?>
		<?php while ( $agents->have_posts() ) : $agents->the_post(); ?>
			<div class="col-6 col-md-4 col-xl-<?php echo esc_attr($bcol); ?>">
				<?php echo WP_RealEstate_Template_Loader::get_template_part( 'agents-styles/inner-list' ); ?>
			</div>
		<?php $i++; endwhile; ?>
	<?php } ?>
	
</div>

<div class="apus-pagination-next-link"><?php next_posts_link( '&nbsp;', $agents->max_num_pages ); ?></div>