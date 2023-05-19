<?php

function homez_child_enqueue_styles() {
	wp_enqueue_style( 'homez-child-style', get_stylesheet_uri() );
}

add_action( 'wp_enqueue_scripts', 'homez_child_enqueue_styles', 200 );

/**
 * Custom shortcode icon header
 */
add_shortcode('custom-icon-right-header',function(){
	ob_start();
    //#apus_login_register_tabs_form
	?>
	<div class="elementor-element elementor-element-248d3d5 elementor-widget__width-auto elementor-icon-list--layout-inline elementor-list-item-link-full_width elementor-widget elementor-widget-icon-list"
	     data-id="248d3d5" data-element_type="widget" data-widget_type="icon-list.default">
		<div class="elementor-widget-container">
			<link rel="stylesheet" href="/wp-content/plugins/elementor/assets/css/widget-icon-list.min.css">
			<ul class="elementor-icon-list-items elementor-inline-items">
				<li class="elementor-icon-list-item elementor-inline-item">
					<a href="<?php echo ( is_user_logged_in() ) ? '/favorite/' : '#apus_login_register_tabs_form'; ?>" class="<?php echo ( is_user_logged_in() ) ? 'favorite' : 'btn-login apus-user-login'; ?>">
					<span class="elementor-icon-list-icon">
						<i aria-hidden="true" class="far fa-heart"></i> </span>
						<span class="elementor-icon-list-text">Ưa thích</span>
					</a>
				</li>
				<li class="elementor-icon-list-item elementor-inline-item">
					<a href="<?php echo ( is_user_logged_in() ) ? '/compare/' : '#apus_login_register_tabs_form'; ?>" class="<?php echo ( is_user_logged_in() ) ? 'compare' : 'btn-login apus-user-login'; ?>">
					<span class="elementor-icon-list-icon">
						<i aria-hidden="true" class="far fa-plus-square"></i> </span>
						<span class="elementor-icon-list-text">So sánh</span>
					</a>
				</li>
				<li class="elementor-icon-list-item elementor-inline-item">
					<a href="<?php echo ( is_user_logged_in() ) ? '/message/' : '#apus_login_register_tabs_form'; ?>" class="<?php echo ( is_user_logged_in() ) ? 'message' : 'btn-login apus-user-login'; ?>">
					<span class="elementor-icon-list-icon">
						<i aria-hidden="true" class="far fa-comment-dots"></i> </span>
						<span class="elementor-icon-list-text">Message</span>
					</a>
				</li>
			</ul>
		</div>
	</div>
	<?php
	return ob_get_clean();
});

add_action('wp_footer', function(){
    ?>
    <div class="d-flex justify-content-center align-items-center custom-loading d-none">
        <div class="spinner-border text-light" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    <script>
        jQuery(document).ready(function ($) {
            $("select[name='filter-cfield-select-quan-huyen']").prop("disabled", true);
            $(".select-field-region1").on('change', function(){
                let id = $(this).find("option:selected").val();
                $.ajax({
                    url: '<?php echo admin_url('admin-ajax.php');?>',
                    type: 'post',
                    data: {
                        id: id,
                        action: "get_district_by_id"
                    },
                    beforeSend: function() {
                        $('.custom-loading').removeClass('d-none');
                    },
                    success: function(response) {
                        $('.custom-loading').addClass('d-none');
                        $("select[name='filter-cfield-select-quan-huyen']").html(response);
                        $("select[name='filter-cfield-select-quan-huyen']").prop("disabled", false);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error(textStatus, errorThrown);
                    }
                });
            });
        })
    </script>
    <?php
});
/**
 * call ajax find taxonomy by id
 */
add_action( 'wp_ajax_get_district_by_id', 'get_district_by_id' );
add_action( 'wp_ajax_nopriv_get_district_by_id', 'my_ajaxget_district_by_id_handler' );

function get_district_by_id(){
	$child_theme_directory = get_stylesheet_directory();
	$json_file_path = $child_theme_directory . '/data/districts.json';
	$json_data = file_get_contents($json_file_path);
	$data = json_decode($json_data, true);
	$term_id = isset( $_POST['id'] ) ? $_POST['id'] : '';
	$term = get_term_meta($term_id,'idprovince',true);

	$valid_districts = array();
	foreach ($data['district'] as $item) {
		if ($item['idProvince'] == $term) {
			$valid_districts[] = $item;
		}
	}
	$options = '<option value="">Chọn quận huyện</option>';
	foreach ($valid_districts as $district) {
		$options .= '<option value="' . $district['idDistrict'] . '">' . $district['name'] . '</option>';
	}
	echo $options;
	wp_die();
}
