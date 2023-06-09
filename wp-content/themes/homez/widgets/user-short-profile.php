<?php 
if ( !is_user_logged_in() || !class_exists('WP_RealEstate_User') ) {
    return;
}
extract( $args );
extract( $args );
extract( $instance );

global $post;

echo trim($before_widget);
$title = apply_filters('widget_title', $instance['title']);
if ( $title ) {
    echo trim($before_title)  . trim( $title ) . $after_title;
}
$user_id = get_current_user_id();
if ( WP_RealEstate_User::is_agent($user_id) ) {
    if ($nav_menu_agent) {
        $term = get_term_by( 'slug', $nav_menu_agent, 'nav_menu' );
        if ( !empty($term) ) {
            $nav_menu_id = $term->term_id;
        }
    }
} elseif ( WP_RealEstate_User::is_agency() ) {
    
    if ($nav_menu_agency) {
        $term = get_term_by( 'slug', $nav_menu_agency, 'nav_menu' );
        if ( !empty($term) ) {
            $nav_menu_id = $term->term_id;
        }
    }
} else {
    if ($nav_menu_user) {
        $term = get_term_by( 'slug', $nav_menu_user, 'nav_menu' );
        if ( !empty($term) ) {
            $nav_menu_id = $term->term_id;
        }
    }
}
?>

<?php if ( !empty($nav_menu_id) ) { ?>
    <div class="user_short_profile">
        <?php
            $args = array(
                'menu'        => $nav_menu_id,
                'container_class' => 'navbar-collapse p-0',
                'menu_class' => 'menu-dashboard p-0',
                'fallback_cb' => '',
                'walker' => new Homez_Nav_Menu()
            );
            wp_nav_menu($args);
        ?>
    </div>
<?php }

echo trim($after_widget);