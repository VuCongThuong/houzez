<?php
global $post;
wp_enqueue_script('addthis');
?>
<div class="apus-social-share">
		<div class="bo-social-icons bo-sicolor social-radius-rounded">
		<strong><?php esc_html_e('Share this post : ', 'homez'); ?></strong>
		<?php if ( homez_get_config('facebook_share', 1) ): ?>
 			<a href="javascript:void(0);" data-original-title="facebook" class="bo-social-facebook addthis_button_facebook"><i class="fab fa-facebook-f"></i> 
 			</a>
		<?php endif; ?>
		<?php if ( homez_get_config('twitter_share', 1) ): ?>
 			<a href="javascript:void(0);" data-original-title="twitter" class="bo-social-twitter addthis_button_twitter"><i class="fab fa-twitter"></i></a>
		<?php endif; ?>
		<?php if ( homez_get_config('linkedin_share', 1) ): ?>
 			<a href="javascript:void(0);" data-original-title="linkedin" class="bo-social-linkedin addthis_button_linkedin"><i class="fab fa-linkedin-in"></i></a>
		<?php endif; ?>
		
		<?php if ( homez_get_config('pinterest_share', 1) ): ?>
 			<a href="javascript:void(0);" data-original-title="pinterest" class="bo-social-pinterest addthis_button_pinterest"><i class="fab fa-pinterest-p"></i> </a>
		<?php endif; ?>

		<?php if ( homez_get_config('more_share', 1) ): ?>
			<a href="javascript:void(0);" data-original-title="share_more" class="addthis_button_compact"><i class="fas fa-plus"></i></a>
		<?php endif; ?>
	</div>
</div>