<?php
/**
 * Plugin Name: Criadero Virtual
 * Description: Plugin para gestionar datos de un criadero de perros.
 * Author: VisualmentCD
 * Version: 1.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Define constants
define('CRIADERO_VIRTUAL_VERSION', '1.0');
define('CRIADERO_VIRTUAL_PLUGIN_DIR', plugin_dir_path(__FILE__));

// Include necessary files
require_once CRIADERO_VIRTUAL_PLUGIN_DIR . 'includes/cpt-perro.php';
require_once CRIADERO_VIRTUAL_PLUGIN_DIR . 'includes/cpt-camada.php';
require_once CRIADERO_VIRTUAL_PLUGIN_DIR . 'includes/metaboxes.php';
require_once CRIADERO_VIRTUAL_PLUGIN_DIR . 'includes/enqueue-scripts.php';
require_once CRIADERO_VIRTUAL_PLUGIN_DIR . 'includes/shortcode-blog.php';

// Activation hook
register_activation_hook(__FILE__, 'criadero_virtual_activate');

function criadero_virtual_activate() {
    // Trigger CPT registration on activation
    criadero_virtual_register_cpt_perro();
    criadero_virtual_register_cpt_camada();
    // Flush rewrite rules to ensure CPTs are registered correctly
    flush_rewrite_rules();
}

// Deactivation hook
register_deactivation_hook(__FILE__, 'criadero_virtual_deactivate');

function criadero_virtual_deactivate() {
    // Flush rewrite rules to remove CPTs
    flush_rewrite_rules();
}