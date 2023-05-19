<?php
/**
 * Materials
 *
 * @package    wp-realestate
 * @author     Habq 
 * @license    GNU General Public License, version 3
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
class WP_RealEstate_Taxonomy_Property_Material{

	/**
	 *
	 */
	public static function init() {
		add_action( 'init', array( __CLASS__, 'definition' ), 1 );
	}

	/**
	 *
	 */
	public static function definition($args) {
		$labels = array(
			'name'              => __( 'Materials', 'wp-realestate' ),
			'singular_name'     => __( 'Material', 'wp-realestate' ),
			'search_items'      => __( 'Search Materials', 'wp-realestate' ),
			'all_items'         => __( 'All Materials', 'wp-realestate' ),
			'parent_item'       => __( 'Parent Material', 'wp-realestate' ),
			'parent_item_colon' => __( 'Parent Material:', 'wp-realestate' ),
			'edit_item'         => __( 'Edit', 'wp-realestate' ),
			'update_item'       => __( 'Update', 'wp-realestate' ),
			'add_new_item'      => __( 'Add New', 'wp-realestate' ),
			'new_item_name'     => __( 'New Material', 'wp-realestate' ),
			'menu_name'         => __( 'Materials', 'wp-realestate' ),
		);

		$rewrite_slug = get_option('wp_realestate_property_material_slug');
		if ( empty($rewrite_slug) ) {
			$rewrite_slug = _x( 'property-material', 'Materials slug - resave permalinks after changing this', 'wp-realestate' );
		}
		$rewrite = array(
			'slug'         => $rewrite_slug,
			'with_front'   => false,
			'hierarchical' => false,
		);
		register_taxonomy( 'property_material', 'property', array(
			'labels'            => apply_filters( 'wp_realestate_taxomony_property_material_labels', $labels ),
			'hierarchical'      => true,
			'rewrite'           => $rewrite,
			'public'            => true,
			'show_ui'           => true,
			'show_in_rest'		=> true
		) );
	}

}

WP_RealEstate_Taxonomy_Property_Material::init();