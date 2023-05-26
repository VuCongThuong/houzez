<?php
// DEFINE CONSTANCES
define('URL_CUSTOM_TEMPLATE',get_bloginfo( 'template_directory' ).'/template-custom');

define('URL_ORDER_MANAGEMENT_TEMPLATE',URL_CUSTOM_TEMPLATE.'/template-order-managentment');

define('URL_BOOKING_TEMPLATE',URL_CUSTOM_TEMPLATE.'/template-booking');

// PATH
define('PATH_ORDER_MANAGEMENT_TEMPLATE', get_template_directory().'/template-custom/template-order-managentment');

define('PATH_BOOKING_TEMPLATE', get_template_directory().'/template-custom/template-booking');

// Get add-to-cart for Properties
add_action( 'wp-realestate-single-property-overview', 'show_add_to_cart_for_property_posts' );
function show_add_to_cart_for_property_posts($post)
{

	$product = get_page_by_title( $post->post_title, OBJECT, 'product' );
	if ($product && $product->ID)
	{
		echo do_shortcode( '[add_to_cart id='.$product->ID.']' );
	}
}

add_filter('template_include','template_custom');

function template_custom($template)
{
	global $wp;
	$URI = $_SERVER['REQUEST_URI'];

    // Template order-management for admin/agency/agent
	if (str_contains($URI, 'quan-ly-order') 
	&& (current_user_can('administrator')
	|| current_user_can('wp_realestate_agent')
	|| current_user_can('wp_realestate_agency')))
	{
		include_once PATH_ORDER_MANAGEMENT_TEMPLATE .'/index.php';

		$template = '';
	}

    // Template order-management for users
    if (str_contains($URI, 'quan-ly-order') && current_user_can('customer'))
    {
        include_once PATH_ORDER_MANAGEMENT_TEMPLATE .'/user.php';

		$template = '';
    }

    // Template booking for users
    if (str_contains($URI, 'booking'))
    {
        include_once PATH_BOOKING_TEMPLATE .'/index.php';

		$template = '';
    }

return $template;
}

// Add custom fields to order management
function add_custom_order_meta_box() {
    add_meta_box(
        'custom-order-field',
        'Custom Order Field',
        'render_custom_order_field',
        'shop_order',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_custom_order_meta_box');
function render_custom_order_field($post) {
    $custom_field_value = get_post_meta($post->ID, 'custom_order_field', true);
    $confirm_sales_value = get_post_meta($post->ID, 'confirm_sales', true);
    ?>
    <p>
        <label for="custom-order-field">Ghi Chú Xác Nhận Đã Chuyển Tiền Cho Đại Lý:</label>
        <input type="text" id="custom-order-field" name="custom_order_field" value="<?php echo esc_attr($custom_field_value); ?>">
    </p>
    <p>
        <label for="confirm-sales">Xác nhận bán hàng:</label><br>
        <label>
            <input type="radio" name="confirm_sales" value="yes" <?php checked($confirm_sales_value, 'yes'); ?>>
            Yes
        </label>
        <label>
            <input type="radio" name="confirm_sales" value="no" <?php checked($confirm_sales_value, 'no'); ?>>
            No
        </label>
    </p>
    <?php
}

function save_custom_order_field($post_id) {
    if (isset($_POST['custom_order_field'])) {
        $custom_field_value = sanitize_text_field($_POST['custom_order_field']);
        update_post_meta($post_id, 'custom_order_field', $custom_field_value);
    }
    if (isset($_POST['confirm_sales'])) {
        $confirm_sales_value = sanitize_text_field($_POST['confirm_sales']);
        update_post_meta($post_id, 'confirm_sales', $confirm_sales_value);
    }
}
add_action('save_post_shop_order', 'save_custom_order_field');


// Add nav menu items
function add_order_management_button($items, $args) {
    // Order management
    if ($args->theme_location == 'primary'
    && (current_user_can('administrator')
    || current_user_can('wp_realestate_agent')
    || current_user_can('wp_realestate_agency')
    || current_user_can('customer'))){
		$items .= '<li class="menu-item"><a href="quan-ly-order">Quản Lý Order</a></li>';
    	}

    // Booking
    if ($args->theme_location == 'primary'){
        $items .= '<li class="menu-item"><a href="booking">Booking</a></li>';
    }
    return $items;
}
add_filter('wp_nav_menu_items', 'add_order_management_button', 10, 2);