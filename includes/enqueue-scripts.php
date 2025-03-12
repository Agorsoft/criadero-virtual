<?php
function criadero_virtual_enqueue_scripts($hook) {
    if ('post.php' != $hook && 'post-new.php' != $hook) {
        return;
    }

    wp_enqueue_style('criadero-virtual-styles', plugin_dir_url(__FILE__) . '../assets/css/style.css');
    wp_enqueue_script('criadero-virtual-media-uploader', plugin_dir_url(__FILE__) . '../assets/js/media-uploader.js', array('jquery'), null, true);
    wp_enqueue_media();
}

add_action('admin_enqueue_scripts', 'criadero_virtual_enqueue_scripts');