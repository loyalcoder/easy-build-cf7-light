jQuery(window).on('elementor/frontend/init', function() {
    if (typeof elementor !== 'undefined') {
        elementor.channels.editor.on('editor:save', function(options) {
            console.log('data-sage');
            
            var postId = elementor.config.document.id;
            var postData = elementor.elements.toJSON();

            // Show loading indicator
            elementor.saver.isLoading = true;

            jQuery.ajax({
                url: cf7ElementorAjax.ajaxurl,
                type: 'POST',
                dataType: 'json',
                data: {
                    action: 'cf7_elementor_save_template',
                    nonce: cf7ElementorAjax.nonce,
                    post_id: postId,
                    content: JSON.stringify(postData)
                },
                success: function(response) {
                    if (response.success) {
                        elementor.notifications.showToast({
                            message: response.data.message
                        });
                    } else {
                        elementor.notifications.showToast({
                            message: response.data.message,
                            type: 'error'
                        });
                    }
                },
                error: function() {
                    elementor.notifications.showToast({
                        message: 'An error occurred while saving the template.',
                        type: 'error'
                    });
                },
                complete: function() {
                    // Hide loading indicator
                    elementor.saver.isLoading = false;
                }
            });
        });
    }
});
