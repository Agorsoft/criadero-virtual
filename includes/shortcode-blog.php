<?php
function custom_blog_shortcode($atts) {
    $atts = shortcode_atts(
        array(
            'sexo' => 'Hembra', // Valor por defecto
            'columns_desktop' => 3, // Número de columnas en escritorio
            'columns_tablet' => 2, // Número de columnas en tablet
            'columns_mobile' => 1, // Número de columnas en móvil
            'width' => '100%', // Ancho del contenedor
            'max_width' => '1200px', // Ancho máximo del contenedor
        ),
        $atts,
        'custom_blog'
    );

    $args = array(
        'post_type' => 'perro', // Asegúrate de usar el CPT correcto
        'meta_query' => array(
            array(
                'key'     => 'sexo',
                'value'   => $atts['sexo'],
                'compare' => '='
            )
        )
    );

    $query = new WP_Query($args);

    ob_start();

    if ($query->have_posts()) {
        ?>
        <style>
            .custom-blog-container {
                width: <?php echo esc_attr($atts['width']); ?>;
                max-width: <?php echo esc_attr($atts['max_width']); ?>;
                margin: 0 auto;
            }
            .custom-blog-grid {
                display: grid;
                grid-template-columns: repeat(<?php echo esc_attr($atts['columns_desktop']); ?>, 1fr);
                gap: 20px;
            }
            .custom-blog-item {
                position: relative;
            }
            .custom-blog-image {
                width: 100%;
                height: auto;
            }
            .custom-blog-title {
                font-size: 1.5em;
                margin: 10px 0;
            }
            .custom-blog-tag {
                position: absolute;
                top: 10px;
                right: 10px;
                background-color: red;
                color: white;
                padding: 5px 10px;
                font-size: 0.9em;
                font-weight: bold;
                z-index: 10;
            }
            @media (max-width: 1024px) {
                .custom-blog-grid {
                    grid-template-columns: repeat(<?php echo esc_attr($atts['columns_tablet']); ?>, 1fr);
                }
            }
            @media (max-width: 768px) {
                .custom-blog-grid {
                    grid-template-columns: repeat(<?php echo esc_attr($atts['columns_mobile']); ?>, 1fr);
                }
            }
        </style>
        <div class="custom-blog-container">
            <div class="custom-blog-grid">
                <?php while ($query->have_posts()) : $query->the_post(); ?>
                    <div class="custom-blog-item">
                        <?php if (has_post_thumbnail()) : ?>
                            <img src="<?php the_post_thumbnail_url('medium'); ?>" class="custom-blog-image" alt="<?php the_title(); ?>">
                        <?php endif; ?>
                        <h2 class="custom-blog-title"><?php the_title(); ?></h2>
                        <?php
                        // Verificar si el perro está disponible para monta
                        $disponible_para_monta = get_post_meta(get_the_ID(), 'disponible_para_monta', true);
                        if ($disponible_para_monta === 'sí') : ?>
                            <div class="custom-blog-tag">Disponible para monta</div>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
        <?php
    } else {
        echo '<p>No se encontraron posts.</p>';
    }

    wp_reset_postdata();

    return ob_get_clean();
}
add_shortcode('custom_blog', 'custom_blog_shortcode');