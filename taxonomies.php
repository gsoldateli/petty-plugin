<?php 
function cptui_register_my_taxes() {

	/**
	 * Taxonomy: Espécies.
	 */

	$labels = array(
		"name" => __( 'Espécies', 'sage' ),
		"singular_name" => __( 'Espécie', 'sage' ),
	);

	$args = array(
		"label" => __( 'Espécies', 'sage' ),
		"labels" => $labels,
		"public" => true,
		"hierarchical" => true,
		"label" => "Espécies",
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'especie', 'with_front' => true, ),
		"show_admin_column" => false,
		"show_in_rest" => false,
		"rest_base" => "",
		"show_in_quick_edit" => false,
	);
	register_taxonomy( "especie", array( "petcasa" ), $args );
}

add_action( 'init', 'cptui_register_my_taxes' );
