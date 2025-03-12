<?php
function criadero_virtual_register_cpt_camada() {
    $labels = array(
        'name'               => _x('Camadas', 'post type general name', 'criadero-virtual'),
        'singular_name'      => _x('Camada', 'post type singular name', 'criadero-virtual'),
        'menu_name'          => _x('Camadas', 'admin menu', 'criadero-virtual'),
        'name_admin_bar'     => _x('Camada', 'add new on admin bar', 'criadero-virtual'),
        'add_new'            => _x('Añadir nueva', 'camada', 'criadero-virtual'),
        'add_new_item'       => __('Añadir nueva Camada', 'criadero-virtual'),
        'new_item'           => __('Nueva Camada', 'criadero-virtual'),
        'edit_item'          => __('Editar Camada', 'criadero-virtual'),
        'view_item'          => __('Ver Camada', 'criadero-virtual'),
        'all_items'          => __('Todas las Camadas', 'criadero-virtual'),
        'search_items'       => __('Buscar Camadas', 'criadero-virtual'),
        'parent_item_colon'  => __('Camadas padre:', 'criadero-virtual'),
        'not_found'          => __('No se encontraron Camadas.', 'criadero-virtual'),
        'not_found_in_trash' => __('No se encontraron Camadas en la papelera.', 'criadero-virtual')
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'camada'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array('title', 'editor', 'thumbnail'),
        'menu_icon'          => 'dashicons-screenoptions',
    );

    register_post_type('camada', $args);
}

add_action('init', 'criadero_virtual_register_cpt_camada');