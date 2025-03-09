jQuery(document).ready(function($) {
    $(document).on('wpcf7invalid', function(event) {
        // Access form details if needed; example uses form ID
        // Iterate over invalid inputs if you want to deal with them specifically
        var inputs = event.detail.inputs;
        $.each(inputs, function(index, input) {
            var inputName = input.name;
            // Use setTimeout to wait for DOM update after AJAX
            setTimeout(function() {
                let errorMessage = $('[name="' + inputName + '"]').parents('.l-cf7-field-parent, .b7-field-parent').data('custom-validation');
                // Only display error message if it exists and is not empty
                if (errorMessage && errorMessage.trim() !== '') {
                    $('[name="' + inputName + '"]').siblings('span').html(errorMessage);
                }
            }, 10); // Small delay to ensure DOM is updated
        });
        
    });
});
