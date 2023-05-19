<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
extract( $args );
global $post;
if ( !empty($post->post_type) && $post->post_type == 'agency' ) {
	extract( $args );
	extract( $instance );

	echo trim($before_widget);
	$title = !empty($instance['title']) ? sprintf($instance['title'], $a_title) : '';
	$title = apply_filters('widget_title', $title);

	if ( $title ) {
	    echo trim($before_title)  . trim( $title ) . $after_title;
	}

	$phone = homez_agency_display_phone($post, 'title', false, true);
	$fax = homez_agency_display_meta_data($post, 'fax', esc_html__('Fax', 'homez'), '', false);
	$email = homez_agency_display_email($post, 'title', false);
	$website = homez_agency_display_website($post, 'title', false);
	$member_since = homez_agency_display_member_since($post, 'title', false);

	$skype = homez_agency_display_meta_data($post, 'skype', esc_html__('Skype', 'homez'), '', false);
	$license = homez_agency_display_meta_data($post, 'license', esc_html__('License', 'homez'), '', false);
	$opening_hours = homez_agency_display_meta_data($post, 'opening_hours', esc_html__('Opening Hours', 'homez'), '', false);
	$languages = homez_agency_display_meta_data($post, 'languages', esc_html__('Languages', 'homez'), '', false);
	$tax_number = homez_agency_display_meta_data($post, 'tax_number', esc_html__('Tax number', 'homez'), '', false);
	?>	

		<div class="agency-information author-information">
			<?php homez_agency_display_nb_properties($post, 'title'); ?>
			<?php echo trim($phone); ?>
            <?php echo trim($fax); ?>
            <?php echo trim($email); ?>
            <?php echo trim($website); ?>
            <?php echo trim($member_since); ?>
            <?php echo trim($skype); ?>
            <?php echo trim($opening_hours); ?>
            <?php echo trim($languages); ?>
            <?php echo trim($license); ?>
            <?php echo trim($tax_number); ?>
		</div>
	<?php
	echo trim($after_widget);
}