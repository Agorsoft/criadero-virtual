<?php
function criadero_virtual_register_metaboxes() {
    add_meta_box('criadero_virtual_perro_metabox', __('Detalles del Perro', 'criadero-virtual'), 'criadero_virtual_perro_metabox_callback', 'perro', 'normal', 'high');
    add_meta_box('criadero_virtual_camada_metabox', __('Detalles de la Camada', 'criadero-virtual'), 'criadero_virtual_camada_metabox_callback', 'camada', 'normal', 'high');
}

add_action('add_meta_boxes', 'criadero_virtual_register_metaboxes');

function criadero_virtual_perro_metabox_callback($post) {
    wp_nonce_field('criadero_virtual_save_perro_meta', 'criadero_virtual_perro_meta_nonce');
    ?>
    <div class="criadero-virtual-metabox">
        <div class="row">
            <div class="half">
                <label for="camada"><?php _e('Camada', 'criadero-virtual'); ?></label>
                <select name="camada" id="camada">
                    <option value=""><?php _e('No disponible', 'criadero-virtual'); ?></option>
                    <?php
                    $camadas = get_posts(array('post_type' => 'camada', 'numberposts' => -1));
                    foreach ($camadas as $camada) {
                        echo '<option value="' . esc_attr($camada->ID) . '">' . esc_html($camada->post_title) . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="half">
                <label for="fecha_nacimiento"><?php _e('Fecha de nacimiento', 'criadero-virtual'); ?></label>
                <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" value="<?php echo esc_attr(get_post_meta($post->ID, 'fecha_nacimiento', true)); ?>">
            </div>
        </div>
        <div class="row">
            <div class="half">
                <label for="sexo"><?php _e('Sexo', 'criadero-virtual'); ?></label>
                <select name="sexo" id="sexo">
                    <option value="Macho" <?php selected(get_post_meta($post->ID, 'sexo', true), 'Macho'); ?>><?php _e('Macho', 'criadero-virtual'); ?></option>
                    <option value="Hembra" <?php selected(get_post_meta($post->ID, 'sexo', true), 'Hembra'); ?>><?php _e('Hembra', 'criadero-virtual'); ?></option>
                </select>
            </div>
            <div class="half">
                <label for="padre"><?php _e('Padre', 'criadero-virtual'); ?></label>
                <select name="padre" id="padre">
                    <option value=""><?php _e('No disponible', 'criadero-virtual'); ?></option>
                    <?php
                    $padres = get_posts(array('post_type' => 'perro', 'meta_key' => 'sexo', 'meta_value' => 'Macho', 'numberposts' => -1));
                    foreach ($padres as $padre) {
                        echo '<option value="' . esc_attr($padre->ID) . '">' . esc_html($padre->post_title) . '</option>';
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="half">
                <label for="madre"><?php _e('Madre', 'criadero-virtual'); ?></label>
                <select name="madre" id="madre">
                    <option value=""><?php _e('No disponible', 'criadero-virtual'); ?></option>
                    <?php
                    $madres = get_posts(array('post_type' => 'perro', 'meta_key' => 'sexo', 'meta_value' => 'Hembra', 'numberposts' => -1));
                    foreach ($madres as $madre) {
                        echo '<option value="' . esc_attr($madre->ID) . '">' . esc_html($madre->post_title) . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="half">
                <label for="color"><?php _e('Color', 'criadero-virtual'); ?></label>
                <input type="text" name="color" id="color" value="<?php echo esc_attr(get_post_meta($post->ID, 'color', true)); ?>">
            </div>
        </div>
        <div class="row">
            <div class="half">
                <label for="altura"><?php _e('Altura', 'criadero-virtual'); ?></label>
                <input type="text" name="altura" id="altura" value="<?php echo esc_attr(get_post_meta($post->ID, 'altura', true)); ?>">
            </div>
            <div class="half">
                <label for="loe"><?php _e('LOE', 'criadero-virtual'); ?></label>
                <input type="text" name="loe" id="loe" value="<?php echo esc_attr(get_post_meta($post->ID, 'loe', true)); ?>">
            </div>
        </div>
        <div class="row">
            <div class="half">
                <label for="chip"><?php _e('Chip', 'criadero-virtual'); ?></label>
                <input type="text" name="chip" id="chip" value="<?php echo esc_attr(get_post_meta($post->ID, 'chip', true)); ?>">
            </div>
            <div class="half-checkbox">
                <label for="disponible_monta"><?php _e('Disponible para monta', 'criadero-virtual'); ?></label>
                <input type="checkbox" name="disponible_monta" id="disponible_monta" value="1" <?php checked(get_post_meta($post->ID, 'disponible_monta', true), 1); ?>>
            </div>
        </div>
        <div class="row">
            <div class="full">
                <label for="titulos"><?php _e('Títulos', 'criadero-virtual'); ?></label>
                <textarea name="titulos" id="titulos"><?php echo esc_textarea(get_post_meta($post->ID, 'titulos', true)); ?></textarea>
            </div>
        </div>
        <div class="row">
            <div class="full">
                <label for="galeria"><?php _e('Galería', 'criadero-virtual'); ?></label>
                <input type="hidden" name="galeria" id="galeria" value="<?php echo esc_attr(get_post_meta($post->ID, 'galeria', true)); ?>">
                <button type="button" id="galeria_button"><?php _e('Seleccionar imágenes', 'criadero-virtual'); ?></button>
                <div id="galeria_preview">
                    <?php
                    $galeria_ids = get_post_meta($post->ID, 'galeria', true);
                    if ($galeria_ids) {
                        $galeria_ids_array = explode(',', $galeria_ids);
                        foreach ($galeria_ids_array as $id) {
                            $img_url = wp_get_attachment_url($id);
                            echo '<div class="gallery-item" data-id="' . esc_attr($id) . '">';
                            echo '<img src="' . esc_url($img_url) . '" />';
                            echo '<button type="button" class="remove-image-button">&times;</button>';
                            echo '</div>';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php
}

function criadero_virtual_save_perro_meta($post_id) {
    if (!isset($_POST['criadero_virtual_perro_meta_nonce']) || !wp_verify_nonce($_POST['criadero_virtual_perro_meta_nonce'], 'criadero_virtual_save_perro_meta')) {
        return;
    }

    $fields = ['camada', 'fecha_nacimiento', 'sexo', 'padre', 'madre', 'color', 'altura', 'loe', 'chip', 'disponible_monta', 'titulos', 'galeria'];
    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
        } else {
            delete_post_meta($post_id, $field);
        }
    }
}

add_action('save_post', 'criadero_virtual_save_perro_meta');

function criadero_virtual_camada_metabox_callback($post) {
    wp_nonce_field('criadero_virtual_save_camada_meta', 'criadero_virtual_camada_meta_nonce');
    ?>
    <div class="criadero-virtual-metabox">
        <div class="row">
            <div class="half">
                <label for="fecha_monta"><?php _e('Fecha de monta', 'criadero-virtual'); ?></label>
                <input type="date" name="fecha_monta" id="fecha_monta" value="<?php echo esc_attr(get_post_meta($post->ID, 'fecha_monta', true)); ?>">
            </div>
            <div class="half">
                <label for="fecha_camada"><?php _e('Fecha de camada', 'criadero-virtual'); ?></label>
                <input type="date" name="fecha_camada" id="fecha_camada" value="<?php echo esc_attr(get_post_meta($post->ID, 'fecha_camada', true)); ?>">
            </div>
        </div>
        <div class="row">
            <div class="half">
                <label for="padre"><?php _e('Padre', 'criadero-virtual'); ?></label>
                <select name="padre" id="padre">
                    <option value=""><?php _e('No disponible', 'criadero-virtual'); ?></option>
                    <?php
                    $padres = get_posts(array('post_type' => 'perro', 'meta_key' => 'sexo', 'meta_value' => 'Macho', 'numberposts' => -1));
                    foreach ($padres as $padre) {
                        echo '<option value="' . esc_attr($padre->ID) . '">' . esc_html($padre->post_title) . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="half">
                <label for="madre"><?php _e('Madre', 'criadero-virtual'); ?></label>
                <select name="madre" id="madre">
                    <option value=""><?php _e('No disponible', 'criadero-virtual'); ?></option>
                    <?php
                    $madres = get_posts(array('post_type' => 'perro', 'meta_key' => 'sexo', 'meta_value' => 'Hembra', 'numberposts' => -1));
                    foreach ($madres as $madre) {
                        echo '<option value="' . esc_attr($madre->ID) . '">' . esc_html($madre->post_title) . '</option>';
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="half">
                <label for="embarazo_camada"><?php _e('Embarazo de camada', 'criadero-virtual'); ?></label>
                <select name="embarazo_camada" id="embarazo_camada">
                    <option value=""><?php _e('No disponible', 'criadero-virtual'); ?></option>
                    <option value="Positivo" <?php selected(get_post_meta($post->ID, 'embarazo_camada', true), 'Positivo'); ?>><?php _e('Positivo', 'criadero-virtual'); ?></option>
                    <option value="Negativo" <?php selected(get_post_meta($post->ID, 'embarazo_camada', true), 'Negativo'); ?>><?php _e('Negativo', 'criadero-virtual'); ?></option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="full">
                <label for="galeria"><?php _e('Galería', 'criadero-virtual'); ?></label>
                <input type="hidden" name="galeria" id="galeria" value="<?php echo esc_attr(get_post_meta($post->ID, 'galeria', true)); ?>">
                <button type="button" id="galeria_button"><?php _e('Seleccionar imágenes', 'criadero-virtual'); ?></button>
                <div id="galeria_preview">
                    <?php
                    $galeria_ids = get_post_meta($post->ID, 'galeria', true);
                    if ($galeria_ids) {
                        $galeria_ids_array = explode(',', $galeria_ids);
                        foreach ($galeria_ids_array as $id) {
                            $img_url = wp_get_attachment_url($id);
                            echo '<div class="gallery-item" data-id="' . esc_attr($id) . '">';
                            echo '<img src="' . esc_url($img_url) . '" />';
                            echo '<button type="button" class="remove-image-button">&times;</button>';
                            echo '</div>';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php
}

function criadero_virtual_save_camada_meta($post_id) {
    if (!isset($_POST['criadero_virtual_camada_meta_nonce']) || !wp_verify_nonce($_POST['criadero_virtual_camada_meta_nonce'], 'criadero_virtual_save_camada_meta')) {
        return;
    }

    $fields = ['fecha_monta', 'fecha_camada', 'padre', 'madre', 'embarazo_camada', 'galeria'];
    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
        } else {
            delete_post_meta($post_id, $field);
        }
    }
}

add_action('save_post', 'criadero_virtual_save_camada_meta');