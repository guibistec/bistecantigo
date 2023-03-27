/* Custom metabox functions for Mokaine */

jQuery( function ($) {     	

	// Intro metaboxes behaviour - DA RIVEDERE, non è escluso che va rimossa
	// var bgImage = $('input[value="image_bg"]'),
	// 	bgMockup = $('input[value="device_mockup"]'),
	// 	mockupMetabox = $('[class*="slide_mockup_layout"]');	
	// function introMb() {
	//     if ( bgMockup.is(':checked') ) {
	//     	mockupMetabox.fadeIn();
	//     } else {
	//     	mockupMetabox.hide();
	//     }
	// }
	// introMb();
	// $('input[name*="[slide_type]"]').on('click', introMb );
	// Custom color swatches on color picker

	var palette = ['#fd685b', '#ff8657', '#fecd5e', '#a1d26e', '#4fcead', '#4FC1E9', '#5D9CEC', '#ab94e9', '#ea89bf', '#E6E9ED', '#AAB2BD', '#545766'];

	$('.redux-color-init').each(function() { // redux colorpicker
		$(this).iris({
		    palettes: palette,
		    // Redux fix to update color
		    change: function(event, ui) {
		        $(this).closest('.wp-picker-container').find('.wp-color-result').css( 'background-color', ui.color.toString());
			}
		});
	});

	function colorPickerMeta() {
		$('.cmb2-colorpicker').each(function() { // metabox colorpicker
			$(this).iris({
			    palettes: palette
			});	
		});
	}
	colorPickerMeta();
	$('body').on('click', '.cmb-add-group-row', function() {
		colorPickerMeta();
	});
	if ( $('input.popup-colorpicker').length > 0 ) {
		$('input.popup-colorpicker').wpColorPicker({ // shortcode colorpicker
			palettes: palette
		});
	}

	// Intro metaboxes behaviour

	function introMb() {

		$('select[name*="[_mokaine_slide_type]"]').each(function() {

			var trigger = $(this),
				slidePanel = trigger.closest('.cmb-repeatable-grouping'),
				bgImage = trigger.find('option[value="image_bg"]'),
				bgMockup = trigger.find('option[value="device_mockup"]'),
				bgMap = trigger.find('option[value="intro_map"]'),
				bgImageDisable = slidePanel.find('[class*="slide-mockup-layout"], [class*="map-latitude"], [class*="map-longitude"], [class*="map-zoom"], [class*="map-style"], [class*="map-marker"], [class*="map-tooltip"]'),
				bgMockupDisable = slidePanel.find('[class*="map-latitude"], [class*="map-longitude"], [class*="map-zoom"], [class*="map-style"], [class*="map-marker"], [class*="map-tooltip"]'),
				bgMapDisable = slidePanel.find('[class*="select-image"], [class*="slide-font-color"], [class*="slide-title"], [class*="slide-subtitle"], [class*="slide-button"], [class*="slide-mockup-layout"], [class*="credits-box"]');

		    if ( bgImage.is(':selected') ) {

		    	bgMockupDisable.removeClass('visuallyhidden');
		    	bgMapDisable.removeClass('visuallyhidden');	    	
		    	bgImageDisable.addClass('visuallyhidden');	   

		    } else if ( bgMockup.is(':selected') ) {

		    	bgImageDisable.removeClass('visuallyhidden');
		    	bgMapDisable.removeClass('visuallyhidden');	    	
		    	bgMockupDisable.addClass('visuallyhidden');	   

		    } else if ( bgMap.is(':selected') ) {

		    	bgImageDisable.removeClass('visuallyhidden');
		    	bgMockupDisable.removeClass('visuallyhidden');	    	
		    	bgMapDisable.addClass('visuallyhidden');	   

		    }

		});

	}

	introMb();
	$('#_mokaine_single_slide_repeat').on('change', 'select[name*="[_mokaine_slide_type]"]', introMb );
	$('.cmb-repeatable-group').on( 'click', '.cmb-shift-rows', introMb );



	// Slider panel expand/collapse

	function togglePanel() {

		var trigger = $(this),
			slidePanel = trigger.closest('.cmb-repeatable-grouping'),
			notToHide = '[class*="slide-select-image"], [class*="slide-type"], [class*="slide-more-options-trigger"], .cmb-group-title, .cmb-remove-field-row',
			togglingItems = slidePanel.find('.cmb-nested').find('.cmb-row').not(notToHide);

		if ( slidePanel.hasClass('expanded') ) {

		    slidePanel.removeClass('expanded').addClass('closed');
		    togglingItems.hide();
		    if ( trigger.is('.intro-more-options') ) {
		    	trigger.text(passed_data.closedString) // vars are stored in mokaine/start.php - original string is into meta/meta-config.php
		    } else {
		    	slidePanel.find('.intro-more-options').text(passed_data.closedString)
		    }

		}  else if ( slidePanel.hasClass('closed') ) {

		    slidePanel.removeClass('closed').addClass('expanded');
		    togglingItems.fadeIn();
		    if ( trigger.is('.intro-more-options') ) {		    
		    	trigger.text(passed_data.expandedString) // vars are stored in mokaine/start.php - original string is into meta/meta-config.php
		    } else {
		    	slidePanel.find('.intro-more-options').text(passed_data.expandedString)
		    }

		} else {

		    slidePanel.addClass('expanded');
		    togglingItems.fadeIn();
		    if ( trigger.is('.intro-more-options') ) {		    
		    	trigger.text(passed_data.expandedString) // vars are stored in mokaine/start.php - original string is into meta/meta-config.php
		    } else {
		    	slidePanel.find('.intro-more-options').text(passed_data.expandedString)
		    }

		}

	}

	$('#_mokaine_single_slide_repeat').on('click', '.cmb-repeatable-grouping .cmb-th', togglePanel );
	$('#_mokaine_single_slide_repeat').on('click', '.intro-more-options', togglePanel );


	// Show/hide Intro Settings extra fields on Pages
	function introSettings() {

		var selectContainer = $('[id*="mokaine_select_intro_parse"]'),
			subEls = $('#cmb2-metabox-select_intro .cmb-row:not(.cmb2-id--mokaine-select-intro-parse)');

		selectContainer.on('change', function() {

			// console.log($(this).val());

			if( $(this).val() == '' ) {
				subEls.hide();
				$('#cmb2-metabox-select_intro .cmb2-id--mokaine-select-intro-parse').addClass('no-border');
			} else {
				subEls.fadeIn('slow');
				$('#cmb2-metabox-select_intro .cmb2-id--mokaine-select-intro-parse').removeClass('no-border');
			}

		});

		selectContainer.trigger('change');

	}

	if( $('[id*="mokaine_select_intro_parse"]').length > 0 ) {
		introSettings();
	}

	if( $('#redux-header').length > 0 ) {
		$('#redux-header').prepend('<div class="go-pro-redux"><h3>Supercharge Beetle Go with new features!</h3><a class="button" href="http://mokaine.com/beetle-pro-wordpress-theme/">Discover <strong>Beetle Pro</strong></a></div>')
	}

});