<?php
function criadero_virtual_register_cpt_perro() {
    $labels = array(
        'name'               => _x('Perros', 'post type general name', 'criadero-virtual'),
        'singular_name'      => _x('Perro', 'post type singular name', 'criadero-virtual'),
        'menu_name'          => _x('Perros', 'admin menu', 'criadero-virtual'),
        'name_admin_bar'     => _x('Perro', 'add new on admin bar', 'criadero-virtual'),
        'add_new'            => _x('Añadir nuevo', 'perro', 'criadero-virtual'),
        'add_new_item'       => __('Añadir nuevo Perro', 'criadero-virtual'),
        'new_item'           => __('Nuevo Perro', 'criadero-virtual'),
        'edit_item'          => __('Editar Perro', 'criadero-virtual'),
        'view_item'          => __('Ver Perro', 'criadero-virtual'),
        'all_items'          => __('Todos los Perros', 'criadero-virtual'),
        'search_items'       => __('Buscar Perros', 'criadero-virtual'),
        'parent_item_colon'  => __('Perros padre:', 'criadero-virtual'),
        'not_found'          => __('No se encontraron Perros.', 'criadero-virtual'),
        'not_found_in_trash' => __('No se encontraron Perros en la papelera.', 'criadero-virtual')
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'perro'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array('title', 'editor', 'thumbnail'),
        'menu_icon'          => 'dashicons-pets',
    );

    register_post_type('perro', $args);
}

add_action('init', 'criadero_virtual_register_cpt_perro');