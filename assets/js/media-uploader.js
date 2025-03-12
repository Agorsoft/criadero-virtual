jQuery(document).ready(function($) {
    var file_frame;
    var wp_media_post_id = wp.media.model.settings.post.id;
    var set_to_post_id = 0;

    $('#galeria_button').on('click', function(event) {
        event.preventDefault();

        if (file_frame) {
            file_frame.uploader.uploader.param('post_id', set_to_post_id);
            file_frame.open();
            return;
        } else {
            wp.media.model.settings.post.id = set_to_post_id;
        }

        file_frame = wp.media.frames.file_frame = wp.media({
            title: 'Seleccionar imágenes',
            button: {
                text: 'Usar estas imágenes',
            },
            multiple: true
        });

        file_frame.on('select', function() {
            var attachments = file_frame.state().get('selection').map(function(attachment) {
                attachment.toJSON();
                return attachment;
            });

            var attachment_ids = [];
            var preview_html = '';
            attachments.forEach(function(attachment) {
                attachment_ids.push(attachment.id);
                preview_html += '<div class="gallery-item" data-id="' + attachment.id + '">';
                preview_html += '<img src="' + attachment.attributes.url + '" />';
                preview_html += '<button type="button" class="remove-image-button">&times;</button>';
                preview_html += '</div>';
            });

            var existing_ids = $('#galeria').val();
            if (existing_ids) {
                attachment_ids = existing_ids.split(',').concat(attachment_ids);
            }

            $('#galeria').val(attachment_ids.join(','));
            $('#galeria_preview').html(preview_html);
            wp.media.model.settings.post.id = wp_media_post_id;
        });

        file_frame.open();
    });

    $(document).on('click', '.remove-image-button', function() {
        var image_id = $(this).parent().data('id');
        var attachment_ids = $('#galeria').val().split(',');
        attachment_ids = attachment_ids.filter(function(id) {
            return id != image_id;
        });
        $('#galeria').val(attachment_ids.join(','));
        $(this).parent().remove();
    });

    $('a.add_media').on('click', function() {
        wp.media.model.settings.post.id = wp_media_post_id;
    });
});