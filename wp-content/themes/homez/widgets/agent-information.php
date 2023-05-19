<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
extract( $args );
global $post;
if ( !empty($post->post_type) && $post->post_type == 'agent' ) {
	extract( $args );
	extract( $instance );

	echo trim($before_widget);
	$title = !empty($instance['title']) ? sprintf($instance['title'], $a_title) : '';
	$title = apply_filters('widget_title', $title);

	if ( $title ) {
	    echo trim($before_title)  . trim( $title ) . $after_title;
	}

	$phone = homez_agent_display_phone($post, 'title', false, true);
	$fax = homez_agent_display_meta_data($post, 'fax', esc_html__('Fax', 'homez'), '', false);
	$email = homez_agent_display_email($post, 'title', false);
	$website = homez_agent_display_website($post, 'title', false);
	$location = homez_agent_display_full_location($post, 'title', false);
	$member_since = homez_agent_display_member_since($post, 'title', false);
	$languages = homez_agent_display_meta_data($post, 'languages', esc_html__('Language', 'homez'), '', false);
	?>
		<div class="agent-information author-information">
			<?php echo trim($location); ?>
			<?php echo trim($phone); ?>
            <?php echo trim($fax); ?>
            <?php echo trim($email); ?>
            <?php echo trim($website); ?>
            <?php echo trim($member_since); ?>
            <?php echo trim($languages); ?>
		</div>
	<?php
	echo trim($after_widget);
}