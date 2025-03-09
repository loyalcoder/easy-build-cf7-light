(function($) {
    $(document).on('elementor/loaded', function() {
        // Function to add the custom button
        function addCustomButton(headerBar) {

             var customButton = $('<a/>', {
                href: '#', // Your button URL or action here
                class: 'elementor-button elementor-button-default custom-button', // Added a custom class
                text: 'Sync with CF7',
                target: '_blank',
                rel:'noopener'
            });

            // Create a container for better styling and positioning
             const customButtonContainer = $('<div class="custom-button-container"></div>');
              customButtonContainer.append(customButton);


            // Append the button container *after* the Elementor logo
            //$('.elementor-logo', headerBar).after(customButtonContainer);  // Use .after()

            $('.eui-1wid1gg .eui-mjywep .eui-elxt0u > div:first-child', headerBar).after(customButtonContainer);


        }


        const observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                 if (mutation.addedNodes) {
                     for (let node of mutation.addedNodes) {
                          if (node.nodeType === Node.ELEMENT_NODE && $(node).hasClass('eui-1wid1gg')) {
                                addCustomButton(node);
                                observer.disconnect(); // Stop observer

                        }
                    }
                 }

            });
        });


        // Start observing changes in the head element (where the header is likely added)
        // Make sure this selector matches the actual markup
        const targetNode = parent.document.head; // Or wherever the header is inserted

        if(targetNode) { //Check if target Node exists

                observer.observe(targetNode,  { childList: true, subtree: true });


        }

    });
})(jQuery);