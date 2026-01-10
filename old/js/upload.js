jQuery(document).ready(function($){
	"use strict";
	var justhome_upload;
	var justhome_selector;

	function justhome_add_file(event, selector) {

		var upload = $(".uploaded-file"), frame;
		var $el = $(this);
		justhome_selector = selector;

		event.preventDefault();

		// If the media frame already exists, reopen it.
		if ( justhome_upload ) {
			justhome_upload.open();
			return;
		} else {
			// Create the media frame.
			justhome_upload = wp.media.frames.justhome_upload =  wp.media({
				// Set the title of the modal.
				title: "Select Image",

				// Customize the submit button.
				button: {
					// Set the text of the button.
					text: "Selected",
					// Tell the button not to close the modal, since we're
					// going to refresh the page when the image is selected.
					close: false
				}
			});

			// When an image is selected, run a callback.
			justhome_upload.on( 'select', function() {
				// Grab the selected attachment.
				var attachment = justhome_upload.state().get('selection').first();

				justhome_upload.close();
				justhome_selector.find('.upload_image').val(attachment.attributes.url).change();
				if ( attachment.attributes.type == 'image' ) {
					justhome_selector.find('.justhome_screenshot').empty().hide().prepend('<img src="' + attachment.attributes.url + '">').slideDown('fast');
				}
			});

		}
		// Finally, open the modal.
		justhome_upload.open();
	}

	function justhome_remove_file(selector) {
		selector.find('.justhome_screenshot').slideUp('fast').next().val('').trigger('change');
	}
	
	$('body').on('click', '.justhome_upload_image_action .remove-image', function(event) {
		justhome_remove_file( $(this).parent().parent() );
	});

	$('body').on('click', '.justhome_upload_image_action .add-image', function(event) {
		justhome_add_file(event, $(this).parent().parent());
	});

});