<?php 



if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_campos-camera',
		'title' => 'Campos - Câmera',
		'fields' => array (
			array (
				'key' => 'field_5935a3f21283c',
				'label' => 'Email do cliente',
				'name' => 'email_do_cliente',
				'type' => 'email',
				'instructions' => 'Digite o nome do cliente aqui',
				'required' => 1,
				'default_value' => '',
				'placeholder' => 'Digite aqui o endereço de e-mail do cliente',
				'prepend' => '',
				'append' => '',
			),
			array (
				'key' => 'field_5935a5e3f7376',
				'label' => 'Data / Hora (Início)',
				'name' => 'inicio',
				'type' => 'date_time_picker',
				'instructions' => 'Escolha o dia em que será habilitado o acesso.',
				'required' => 1,
				'show_date' => 'true',
				'date_format' => 'dd/mm/yy',
				'time_format' => 'HH:mm',
				'show_week_number' => 'false',
				'picker' => 'slider',
				'save_as_timestamp' => 'true',
				'get_as_timestamp' => 'true',
			),
			array (
				'key' => 'field_5935a93dc7969',
				'label' => 'Data / Hora (Fim)',
				'name' => 'fim',
				'type' => 'date_time_picker',
				'instructions' => 'Escolha o dia em que será habilitado o acesso.',
				'required' => 1,
				'show_date' => 'true',
				'date_format' => 'dd/mm/yy',
				'time_format' => 'HH:mm',
				'show_week_number' => 'false',
				'picker' => 'slider',
				'save_as_timestamp' => 'true',
				'get_as_timestamp' => 'true',
			),
			array (
				'key' => 'field_59369f0b430d2',
				'label' => 'Senha',
				'name' => 'senha_acesso',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_59399ba62eb67',
				'label' => 'E-mail enviado?',
				'name' => 'enviado',
				'type' => 'true_false',
				'required' => 0,
				'message' => '',
				'default_value' => 0,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'acesso_camera',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
				0 => 'permalink',
				1 => 'the_content',
				2 => 'excerpt',
				3 => 'custom_fields',
				4 => 'discussion',
				5 => 'comments',
				6 => 'revisions',
				7 => 'slug',
				8 => 'author',
				9 => 'format',
				10 => 'featured_image',
				11 => 'send-trackbacks',
			),
		),
		'menu_order' => 0,
	));
}

/*
{"servico":{"name":"servico","label":"Servi\u00e7os","singular_label":"Servi\u00e7o","description":"Cadastro dos servi\u00e7os prestados.","public":"true","publicly_queryable":"true","show_ui":"true","show_in_nav_menus":"true","show_in_rest":"false","rest_base":"","has_archive":"false","has_archive_string":"","exclude_from_search":"false","capability_type":"post","hierarchical":"false","rewrite":"true","rewrite_slug":"","rewrite_withfront":"true","query_var":"true","query_var_slug":"","menu_position":"","show_in_menu":"true","show_in_menu_string":"","menu_icon":"dashicons-hammer","supports":["title","editor","thumbnail","excerpt"],"taxonomies":[],"labels":{"menu_name":"Servi\u00e7os","all_items":"Todos servi\u00e7os","add_new":"","add_new_item":"","edit_item":"","new_item":"","view_item":"","view_items":"","search_items":"","not_found":"","not_found_in_trash":"","parent_item_colon":"","featured_image":"","set_featured_image":"","remove_featured_image":"","use_featured_image":"","archives":"","insert_into_item":"","uploaded_to_this_item":"","filter_items_list":"","items_list_navigation":"","items_list":"","attributes":""},"custom_supports":""},"petcasa":{"name":"petcasa","label":"Pets da Casa","singular_label":"Pet da Casa","description":"Cadastre aqui os pets da casa","public":"true","publicly_queryable":"true","show_ui":"true","show_in_nav_menus":"true","show_in_rest":"false","rest_base":"","has_archive":"false","has_archive_string":"","exclude_from_search":"false","capability_type":"post","hierarchical":"false","rewrite":"true","rewrite_slug":"","rewrite_withfront":"true","query_var":"true","query_var_slug":"","menu_position":"","show_in_menu":"true","show_in_menu_string":"","menu_icon":"","supports":["title","editor","thumbnail"],"taxonomies":[],"labels":{"menu_name":"Pets da casa","all_items":"Todos os Pets","add_new":"Novo Pet","add_new_item":"","edit_item":"","new_item":"","view_item":"","view_items":"","search_items":"","not_found":"","not_found_in_trash":"","parent_item_colon":"","featured_image":"","set_featured_image":"","remove_featured_image":"","use_featured_image":"","archives":"","insert_into_item":"","uploaded_to_this_item":"","filter_items_list":"","items_list_navigation":"","items_list":"","attributes":""},"custom_supports":""},"acesso_camera":{"name":"acesso_camera","label":"Acesso a cameras","singular_label":"Acesso a c\u00e2mera","description":"Gerencia o acesso as c\u00e2meras","public":"true","publicly_queryable":"true","show_ui":"true","show_in_nav_menus":"true","show_in_rest":"false","rest_base":"","has_archive":"false","has_archive_string":"","exclude_from_search":"false","capability_type":"post","hierarchical":"false","rewrite":"true","rewrite_slug":"","rewrite_withfront":"true","query_var":"true","query_var_slug":"","menu_position":"","show_in_menu":"true","show_in_menu_string":"","menu_icon":"","supports":["title","editor","thumbnail"],"taxonomies":[],"labels":{"all_items":"C\u00e2meras","menu_name":"","add_new":"","add_new_item":"","edit_item":"","new_item":"","view_item":"","view_items":"","search_items":"","not_found":"","not_found_in_trash":"","parent_item_colon":"","featured_image":"","set_featured_image":"","remove_featured_image":"","use_featured_image":"","archives":"","insert_into_item":"","uploaded_to_this_item":"","filter_items_list":"","items_list_navigation":"","items_list":"","attributes":""},"custom_supports":""}}
*/