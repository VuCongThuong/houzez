<?php
/**
 * Display single product reviews (comments)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product-reviews.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 4.3.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( ! comments_open() ) {
	return;
}

?>
<div id="reviews" class="clearfix">
		<div id="comments" class="box-detail">
			<?php if ( have_comments() ) : ?>
				<h2 class="space-30 comments-title"><?php comments_number( esc_html__('0 Comments', 'homez'), esc_html__('1 Comment', 'homez'), esc_html__('% Comments', 'homez') ); ?></h2>
				<ol class="comment-list">
					<?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) ); ?>
				</ol>

				<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
					echo '<nav class="woocommerce-pagination">';
					paginate_comments_links( apply_filters( 'woocommerce_comment_pagination_args', array(
						'prev_text' => '&larr;',
						'next_text' => '&rarr;',
						'type'      => 'list',
					) ) );
					echo '</nav>';
				endif; ?>

			<?php else : ?>

				<p class="woocommerce-noreviews"><?php esc_html_e( 'There are no reviews yet.', 'homez' ); ?></p>

			<?php endif; ?>
		</div>
	<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->get_id() ) ) : ?>
			<div id="review_form_wrapper" class="box-detail">
				<div id="review_form">
					<?php
						if ( wc_review_ratings_enabled() ) {
							$rating = '<p class="comment-form-rating d-flex align-items-center">
							<label for="rating">' . esc_html__( 'Your Rating', 'homez' ) .'</label>
							<select name="rating" id="rating">
								<option value="">' . esc_html__( 'Rate&hellip;', 'homez' ) . '</option>
								<option value="5">' . esc_html__( 'Perfect', 'homez' ) . '</option>
								<option value="4">' . esc_html__( 'Good', 'homez' ) . '</option>
								<option value="3">' . esc_html__( 'Average', 'homez' ) . '</option>
								<option value="2">' . esc_html__( 'Not that bad', 'homez' ) . '</option>
								<option value="1">' . esc_html__( 'Very Poor', 'homez' ) . '</option>
							</select></p>';
						}

						$commenter = wp_get_current_commenter();
						$fields = array();
							
						$comment_form = array(
							'title_reply'          => have_comments() ? esc_html__( 'Add a review', 'homez' ) : sprintf( esc_html__( 'Be the first to review &ldquo;%s&rdquo;', 'homez' ), get_the_title() ),
							'title_reply_to'       => esc_html__( 'Leave a Reply to %s', 'homez' ),
							'comment_notes_before' => '',
							'comment_notes_after'  => '',
							'fields'               => array_merge( $fields, array(

								'review' => $rating,

								'author' => '<div class="row"><div class="col-md-6 col-12"><div class="comment-form-author form-group">'  .
								            '<label class="for-control">'.esc_html__('Name', 'homez').'</label><input id="author" name="author" class="form-control" placeholder="'.esc_attr__( 'Enter Name', 'homez' ).'" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" />
								            </div></div>',
								'email'  => '<div class="col-md-6 col-12"><div class="comment-form-email form-group">' .
								            '<label class="for-control">'.esc_html__('Email', 'homez').'</label><input id="email" name="email" class="form-control" placeholder="'.esc_attr__( 'Enter Email', 'homez' ).'" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-required="true" />
								            </div></div></div>',
							)),
							'label_submit'  => esc_html__( 'submit review', 'homez' ),
							'logged_in_as'  => '',
							'comment_field' => '',
							'class_submit' => 'btn btn-dark btn-outline'
						);

						if ( $account_page_url = wc_get_page_permalink( 'myaccount' ) ) {
							$comment_form['must_log_in'] = '<p class="must-log-in">' .  sprintf(wp_kses(__( 'You must be <a href="%s">logged in</a> to post a review.', 'homez' ), array('a' => array('class' => array(), 'href' => array())) ), esc_url( $account_page_url ) ) . '</p>';
						}

						if ( wc_review_ratings_enabled() && is_user_logged_in() ) {
							$comment_form['comment_field'] = '<p class="comment-form-rating d-flex align-items-center"><label for="rating">' . esc_html__( 'Your Rating', 'homez' ) .'</label><select name="rating" id="rating">
								<option value="">' . esc_html__( 'Rate&hellip;', 'homez' ) . '</option>
								<option value="5">' . esc_html__( 'Perfect', 'homez' ) . '</option>
								<option value="4">' . esc_html__( 'Good', 'homez' ) . '</option>
								<option value="3">' . esc_html__( 'Average', 'homez' ) . '</option>
								<option value="2">' . esc_html__( 'Not that bad', 'homez' ) . '</option>
								<option value="1">' . esc_html__( 'Very Poor', 'homez' ) . '</option>
							</select></p>';
						}

						$comment_form['comment_field'] .= '<div class="form-group space-comment"><label class="for-control">'.esc_html__('Review', 'homez').'</label><textarea class="form-control" id="comment" name="comment" cols="45" rows="8" placeholder="'.esc_attr__( 'Enter Review', 'homez' ).'" aria-required="true"></textarea>
							</div>';

						comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
					?>
				</div>
			</div>
	<?php else : ?>
		<div class="box-detail">
			<p class="woocommerce-verification-required"><?php esc_html_e( 'Only logged in customers who have purchased this product may leave a review.', 'homez' ); ?></p>
		</div>
	<?php endif; ?>
</div>