jQuery(document).ready(function($){

	// Hide/Show Add Shortocode button
	function handleButton() {
		if ( $('.chosen-single').hasClass('chosen-default') ) {
			$('#add-shortcode').hide();
		} else {
			$('#add-shortcode').show();
		}
	}	 

	$('#mokaine-shortcodes').change(function() {
		handleButton();
	});

	// Upload function
	function initUpload(clone) {
			
		var itemToInit = null;

		itemToInit = typeof clone !== 'undefined' ? clone : $('.content-image');
			
        itemToInit.find('.image-upload').on('click',function( event ) {
				
            var activeFileUploadContext = jQuery(this).parent();
            var relid = jQuery(this).attr('rel-id');
			
            event.preventDefault();
            
            // if its not null, its broking custom_file_frame's onselect "activeFileUploadContext"
            custom_file_frame = null;

            // Create the media frame.
            custom_file_frame = wp.media.frames.customHeader = wp.media({

                // Set the title of the modal.
                title: jQuery(this).data('choose'),

                // Tell the modal to show only images. Ignore if want ALL
                library: {
                    type: 'image'
                },
                // Customize the submit button.
                button: {
                    // Set the text of the button.
                    text: jQuery(this).data('update')
                }

            });

            custom_file_frame.on( 'select', function() {
       
                // Grab the selected attachment.
                var attachment = custom_file_frame.state().get('selection').first();

                // Update value of the targetfield input with the attachment url.
                jQuery('.image-screenshot',activeFileUploadContext).attr('src', attachment.attributes.url);
                jQuery('#' + relid ).val(attachment.attributes.url).trigger('change');

                jQuery('.image-upload',activeFileUploadContext).hide();
                jQuery('.image-screenshot',activeFileUploadContext).show();
                jQuery('.image-upload-remove',activeFileUploadContext).show();

        	});

        	custom_file_frame.open();

        });

	   	itemToInit.find('.image-upload-remove').on('click', function( event ) {

	        var activeFileUploadContext = jQuery(this).parent();
	        var relid = jQuery(this).attr('rel-id');
	
	        event.preventDefault();
	
	        jQuery('#' + relid).val('');
	        jQuery(this).prev().fadeIn('slow');
	        jQuery('.image-screenshot',activeFileUploadContext).fadeOut('slow');
	        jQuery(this).fadeOut('slow');

	    });

	}


	// Open shortcode popup
	$('body').on('click','.mokaine-shortcode-generator', function(e) {
    	e.preventDefault();
    	handleButton(); // handleButton again
 
        $.magnificPopup.open({
            mainClass: 'mfp-zoom-in',
 		 	items: {
  	     		src: '#mokaine-sc-generator'
        	},
         	type: 'inline',
            removalDelay: 500
	    }, 0);         
 
	}); 	


	// Init chosen plugin to make select boxes user-friendly (http://harvesthq.github.io/chosen/)
	$('select#mokaine-shortcodes').chosen();

	// call function to upload images
	initUpload();

    
    function store_shortcode() {
		
		var name = $('#mokaine-shortcodes').val();
		var dataType = $('#options-' + name).attr('data-type');
		var attr_text = attr_textarea = attr_radio = attr_checkbox = attr_select = attr_multiselect = attr_image = attr_icon = '';

		// opening shortcode
		opening = '[' + name;

		// text loop for extra attrs (valid for colorpicker too)
		$('#options-' + name + ' input[type=text]:not([data-attrname="content_inside"], .skip-processing)').each(function() {
			if( $(this).val() != '' ) { // if input is not empty
				attr_text += ' ' + $(this).attr('data-attrname') + '="' + $(this).val() + '"';	
			}
		});

		opening += attr_text;

		// textarea loop for extra attrs
		$('#options-' + name + ' textarea:not([data-attrname="content_inside"], .skip-processing)').each(function() {
			if( $(this).val() != '' ) { // if textarea is not empty
				attr_textarea += ' ' + $(this).attr('data-attrname') + '="' + $(this).val() + '"';	
			}
		});
		
		opening += attr_textarea;	

		// radio loop for extra attrs
		$('#options-' + name + ' input[type=radio]:not(.skip-processing)').each(function() {
			if( $(this).attr('checked') == 'checked' ) { // if radio is checked
				attr_radio += ' ' + $(this).attr('data-attrname') + '="' + $(this).attr('value') + '"';
			}
		});
		
		opening += attr_radio;				
		 
		// checkbox loop for extra attrs
		$('#options-' + name + ' input[type=checkbox]:not(.skip-processing)').each(function() {
			if( $(this).attr('checked') == 'checked' ) { // if checkbox is checked
				attr_checkbox += ' ' + $(this).attr('data-attrname') + '="true"';
			};	
		});
		
		opening += attr_checkbox;	
		
		// select loop for extra attrs
		$('#options-' + name + ' select:not([multiple=multiple], .skip-processing)').each(function() {
			if( $(this).val() != 'none' ) { // if select value is not 'none'
				attr_select += ' ' + $(this).attr('data-attrname') + '="' + $(this).attr('value') + '"';
			}	
		});
		
		opening += attr_select;
		
		// multiselect loop for extra attrs
		$('#options-' + name + ' select[multiple=multiple]:not(.skip-processing)').each(function() {
			var $categories = ( $(this).val() != null && $(this).val().length > 0 ) ? $(this).val() : 'all';
			attr_multiselect += ' ' + $(this).attr('data-attrname') + '="' + $categories + '"';	
		});
		
		opening += attr_multiselect;
		
		// image upload loop for extra attrs
		$('#options-' + name + ' img.image-screenshot:not(.skip-processing)').each(function() {
			if( $(this).attr('src') != '' ) { // if image is not empty
				attr_image += ' ' + $(this).attr('data-attrname') + '="' + $(this).attr('src') + '"';	
			}
		});
		
		opening += attr_image;
		
		// icon loop for extra attrs
		$('#options-' + name + ' .icon-option i.selected:not(.skip-processing)').each(function() {
			if( $(this).length > 0 ) {
				attr_icon += ' ' + $(this).closest('.icons-container').attr('data-attrname') + '="' + $(this).attr('class').split(' ')[0] + '"';
			}
		});
		
		opening += attr_icon;
		
		opening += ']';

		// closing shortcode
		closing = '[/' + name + ']';

		// output opening shortcode with attrs
		$('#shortcode-storage-opening').html(opening);	

		// output content inside shortcode tags
		$('[data-type="enclosing"]').each(function() {

			var enclosings = $(this),
				contentInside = enclosings.find('[data-attrname="content_inside"]');

			if( contentInside.length > 0 && enclosings.is(':visible') ) {

				content = (contentInside.val().length > 0) ? contentInside.val() : '';
				$('#shortcode-storage-content').html(content);

			}

		});

		// output closing shortcode
		if( dataType != 'self_closing' ) {
			$('#shortcode-storage-closing').html(closing);
		}
		
	 }
     
	// Click on Add Shortcode
    $('#add-shortcode').click(function() {
    	
    	var name = $('#mokaine-shortcodes').val(),
    		dataType = $('#options-' + name).attr('data-type');
    	
    	store_shortcode();
						
		window.wp.media.editor.insert( $('#shortcode-storage-opening').text() + $('#shortcode-storage-content').text() + $('#shortcode-storage-closing').text() );
		$.magnificPopup.close();
		
		// wipe out storage 
		$('#shortcode-storage-opening, #shortcode-storage-content, #shortcode-storage-closing').text('');
		
		resetFileds();
			
		return false;

    });

    // Select another shortcode
    $('#mokaine-shortcodes').change(function(){

		$('.shortcode-options').hide().removeClass('selected-panel');
		$('#options-' + $(this).val()).show().addClass('selected-panel');

		// Lock/Unlock button
		if ( $('.shortcode-options.selected-panel').hasClass('locked-panel') ) {
			$('#add-shortcode').addClass('locked-btn');
		} else {
			$('#add-shortcode').removeClass('locked-btn');
		}

    });
 	
 	// Handle repeatable items
    $('.add-list-item').click(function() {
    	
    	if(!$(this).parent().find('.remove-list-item').is(':visible')) $(this).parent().find('.remove-list-item').show();
    	
    	//clone item 
    	var $clone = $(this).parent().find('.shortcode-dynamic-item:first').clone();
    	$clone.find('input[type=text],textarea').attr('value','');  	
    	
    	//init new upload button and clear image if it's an upload
    	if( $clone.find('.image-upload').length > 0 ) {
    		$clone.find('.image-screenshot').attr('src','');
    		$clone.find('.image-upload-remove').hide();
    		$clone.find('.image-upload').css('display','inline-block');
    		setTimeout(function() { initUpload($clone) }, 200);
    	}
    	
    	//append clone
		$(this).prevAll('.shortcode-dynamic-items').append($clone);
			
		return false;

    });
	
    $('body').on('click', '.remove-list-item', function(){
    	if($(this).parent().find('.shortcode-dynamic-item').length > 1){
    		$(this).parent().find('.shortcode-dynamic-item:last').remove();
    	}
    	if($(this).parent().find('.shortcode-dynamic-item').length == 1) $(this).hide();
    	
		return false;

    });
    
    // hide remove button first
    $('.remove-list-item').hide();
	
	// icon selection
	$('.icon-option i').click(function() {
		$('.icon-option i').removeClass('selected');
		$(this).addClass('selected');
	});
	
	// icon set selection
	$('select[data-attrname="icon-select"]').change(function() {
		var $selected_set = $(this).val();
		$(this).parents('.shortcode-options').find('.icon-option').hide();
		$(this).parents('.shortcode-options').find('.icon-option.' + $selected_set).stop(true,true).fadeIn();
	});
	$('select[data-attrname="icon-select"]').trigger('change');

	
	function resetFileds() {
		$('#mokaine-sc-generator').find('.image-screenshot').attr('src','');
		$('#mokaine-sc-generator').find('.image-upload-remove').hide();
		$('#mokaine-sc-generator').find('.image-upload').show();
		$('#mokaine-sc-generator').find('.wp-color-result').attr('style','');
		$('#mokaine-sc-generator').find('input.wp-color-picker').val('');
		$('select[name="icon-set-select"]').trigger('change');
		$('select[data-attrname="device"]').parents('.content-device').nextAll('.content-color').show();
		$('select[data-attrname="device"]').parents('.content-device').nextAll('.label-color').show();
		$('select[data-attrname="device"]').parents('.content-device').nextAll('.content-color').next('.clear').show();
		$('select[data-attrname="device"]').parents('.content-device').nextAll('.content-color').find('select').removeClass('skip-processing');
	
		//reset icons
		$('#mokaine-sc-generator').find('.icon-option i').removeClass('selected');
		
	}	

});
