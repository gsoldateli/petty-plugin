<?php

function cptui_register_my_cpts() {

	/**
	 * Post Type: Serviços.
	 */

	$labels = array(
		"name" => __( 'Serviços', 'sage' ),
		"singular_name" => __( 'Serviço', 'sage' ),
		"menu_name" => __( 'Serviços', 'sage' ),
		"all_items" => __( 'Todos serviços', 'sage' ),
	);

	$args = array(
		"label" => __( 'Serviços', 'sage' ),
		"labels" => $labels,
		"description" => "Cadastro dos serviços prestados.",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "servico", "with_front" => true ),
		"query_var" => true,
		"menu_icon" => "dashicons-hammer",
		"supports" => array( "title", "editor", "thumbnail", "excerpt" ),
	);

	register_post_type( "servico", $args );

	/**
	 * Post Type: Pets da Casa.
	 */

	$labels = array(
		"name" => __( 'Pets da Casa', 'sage' ),
		"singular_name" => __( 'Pet da Casa', 'sage' ),
		"menu_name" => __( 'Pets da casa', 'sage' ),
		"all_items" => __( 'Todos os Pets', 'sage' ),
		"add_new" => __( 'Novo Pet', 'sage' ),
	);

	$args = array(
		"label" => __( 'Pets da Casa', 'sage' ),
		"labels" => $labels,
		"description" => "Cadastre aqui os pets da casa",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "petcasa", "with_front" => true ),
		"query_var" => true,
		"supports" => array( "title", "editor", "thumbnail" ),
	);

	register_post_type( "petcasa", $args );

	/**
	 * Post Type: Acesso a cameras.
	 */

	$labels = array(
		"name" => __( 'Acesso a cameras', 'sage' ),
		"singular_name" => __( 'Acesso a câmera', 'sage' ),
		"all_items" => __( 'Câmeras', 'sage' ),
	);

	$args = array(
		"label" => __( 'Acesso a cameras', 'sage' ),
		"labels" => $labels,
		"description" => "Gerencia o acesso as câmeras",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "acesso_camera", "with_front" => true ),
		"query_var" => true,
		"supports" => array( "title", "editor", "thumbnail" ),
	);

	register_post_type( "acesso_camera", $args );
}

add_action( 'init', 'cptui_register_my_cpts' );
