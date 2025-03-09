import './scss/sync.scss';
jQuery(document).ready(function($) {
    var $formPanel = $('#form-panel');
    var $formTagBox = $('#form-panel.contact-form-editor-panel');
    let $edit_with_elementor_url = $('.cf7-builder-sync-url').data('elementor-url');
    let $post_id = $('.cf7-builder-sync-url').data('post-id');
    let $form_id = $('.cf7-builder-sync-url').data('form-id');
    if ($formPanel.length && $edit_with_elementor_url && typeof $edit_with_elementor_url !== 'undefined') {
        // Add buttons wrapper div
        var buttonsHtml = '<div class="cf7-builder-button-wrapper">' +
            '<a href="'+ $edit_with_elementor_url +'" ' +
            'class="button button-primary" ' +
            'style="margin-top: 20px; display: inline-block;" ' +
            'target="_blank">' +
            'Edit with Elementor' +
            '</a>' +
            '<button class="button button-secondary cf7-builder-sync-form" ' +
            'style="margin-top: 20px; margin-left: 10px;" ' +
            'data-post-id="' + $post_id + '" ' +
            'data-form-id="' + $form_id + '">' +
            'Sync' +
            '</button>' +
            '</div>';
        $formPanel.append(buttonsHtml);
    }
    if ($formTagBox.length && $edit_with_elementor_url && typeof $edit_with_elementor_url !== 'undefined') {
        // Add overlay to the form-tag-box
        $formTagBox.css('position', 'relative');
        var $overlay = $('<div/>', {
            class: 'cf7-builder-overlay'
        }).append($('<div/>', {
            class: 'cf7-builder-overlay-message'
        }).html('This form is managed by CF7 Builder'));

        $formTagBox.append($overlay);
    }
    // call ajax when sync button is clicked
    $(document).on('click', '.cf7-builder-sync-form', function(e) {
        e.preventDefault();
        var data = {
            action: 'cf7_builder_sync',
            nonce: builder7AjaxObject.nonce,
            post_id: $(this).data('post-id'),
            form_id: $(this).data('form-id'),
        };
        $.ajax({
            url: builder7AjaxObject.ajaxurl,
            type: 'POST',
            data: data,
            success: function(response) {
                if (response.success) {
                    alert(response.data);
                } else {
                    alert(response.data);
                }
            }
        });
    });
});