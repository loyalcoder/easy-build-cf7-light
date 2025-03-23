jQuery(function($){
    "use strict"
    $(document).on('submit', '.crete-post', function(e){
        e.preventDefault();
        var formData = new FormData();
        formData.append('action', 'create_cf7_builder_post');
        formData.append('nonce', easyBuilderCf7lightObj.nonce);
        formData.append('title', $('#cf7-title').val());
        formData.append('cf7_form_id', $('#cf7-select').val());
        formData.append('selected_layout', $('#selected-layout').val());

        $.ajax({
            url: easyBuilderCf7lightObj.ajaxurl,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    let link = '<a href="'+response.data.edit_url+'" target="_blank">Edit With Elementor</a>';
                    let newWindow = window.open(response.data.edit_url, '_blank');
                    if (!newWindow || newWindow.closed || typeof newWindow.closed == 'undefined') {
                        if (confirm("Failed to open new window. Reload page?")) {
                            window.location.reload();
                        }
                    }
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
                alert('An error occurred. Please try again.');
            }
        });
    });
    $(document).on('click', '.cf7-builder-sync', function(e) {
        e.preventDefault();
        var data = {
            action: 'cf7_builder_sync',
            nonce: easyBuilderCf7lightObj.nonce,
            post_id: $(this).data('post-id'),
            form_id: $(this).data('form-id'),
        };
    
        showCustomAlert('loading', 'Syncing', 'Please wait while we sync your form.');
    
        $.ajax({
            url: easyBuilderCf7lightObj.ajaxurl,
            type: 'POST',
            data: data,
            success: function(response) {
                console.log(response);
                
                if (response.success) {
                    showCustomAlert('success', 'Sync Successful', 'Your form has been successfully synced.');
                } else {
                    showCustomAlert('error', 'Oops...', 'Something went wrong! ' + (response.data || 'Please try again.'));
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
                showCustomAlert('error', 'Error', 'An error occurred while syncing. Please try again later.');
            }
        });
    });
});

function showCustomAlert(type, title, message) {
    const alert = document.getElementById('custom-alert');
    const alertIcon = document.getElementById('alert-icon');
    const alertTitle = document.getElementById('alert-title');
    const alertMessage = document.getElementById('alert-message');
    const alertButton = document.getElementById('alert-button');
    alertIcon.className = 'alert-icon ' + type;
    alertTitle.textContent = title;
    alertMessage.textContent = message;

    if (type === 'loading') {
        alertButton.style.display = 'none';
    } else {
        alertButton.style.display = 'inline-block';
    }

    alert.style.display = 'block';

    alertButton.onclick = function() {
        alert.style.display = 'none';
    };
}