<?php

	/**
	 * Generator button
	 *
	 * @param string $target
	 * @param
	 * @param string $class
	 * @param bool   $icon
	 * @param bool   $echo
	 *
	 * @return string
	 */
	function su_generator_button( $target = 'content', $text = null, $class = 'button', $icon = true, $echo = true ) {
		$shult = shortcodes_ultimate();
		// Prepare text
		$text = ( is_null( $text ) ) ? __( 'Insert shortcode', $shult->textdomain ) : $text;
		// Prepare icon
		$icon = ( $icon ) ? '<img src="' . $shult->assets( 'images', 'generator/button.png' ) . '" alt="" /> ' : '';
		// Print button
		$button =
			'<a href="#su-generator" class="su-generator-button ' . $class . '" title="' . $text . '" data-target="' .
			$target . '">' . $icon . $text . '</a>';
		// Show generator popup
		add_action( 'wp_footer', 'su_generator_popup' );
		add_action( 'admin_footer', 'su_generator_popup' );
		// Request assets
		su_query_asset( 'css', array( 'farbtastic', 'magnific-popup', 'su-generator' ) );
		su_query_asset( 'js', array( 'jquery',
		                             'jquery-ui-widget',
		                             'iframe-transport',
		                             'fileupload',
		                             'farbtastic',
		                             'qtip',
		                             'magnific-popup',
		                             'su-generator' ) );
		if ( $echo ) echo $button;
		else return $button;
	}

	add_action( 'media_buttons', 'su_generator_button', 100 );

	/**
	 * Generator popup form
	 */
	function su_generator_popup() {
		$shult = shortcodes_ultimate();
		?>
		<div id="su-generator-wrap" style="display:none">
			<div id="su-generator">
				<div id="su-generator-header">
					<div id="su-generator-tools">
						<a href="<?php echo $shult->admin_url; ?>#tab-1" target="_blank"
							title="<?php _e( 'Settings', $shult->textdomain ); ?>"><?php _e( 'Plugin settings',
						                                                                     $shult->textdomain ); ?></a>
						<span></span> <a href="http://gndev.info/shortcodes-ultimate/" target="_blank"
							title="<?php _e( 'Plugin homepage', $shult->textdomain ); ?>"><?php _e( 'Plugin homepage',
						                                                                            $shult->textdomain ); ?></a>
						<span></span> <a href="http://wordpress.org/support/plugin/shortcodes-ultimate/" target="_blank"
							title="<?php _e( 'Support forums', $shult->textdomain ); ?>"><?php _e( 'Support forums',
						                                                                           $shult->textdomain ); ?></a>
					</div>
					<input type="text" name="su_generator_search" id="su-generator-search" value=""
						placeholder="<?php _e( 'Search for shortcodes', $shult->textdomain ); ?>" />
					<div id="su-generator-filter">
						<strong><?php _e( 'Filter by type', $shult->textdomain ); ?></strong> <a href="#"
							data-filter="all"><?php _e( 'All', $shult->textdomain ); ?></a> <a href="#"
							data-filter="content"><?php _e( 'Content', $shult->textdomain ); ?></a> <a href="#"
							data-filter="box"><?php _e( 'Boxes', $shult->textdomain ); ?></a> <a href="#"
							data-filter="media"><?php _e( 'Media', $shult->textdomain ); ?></a> <a href="#"
							data-filter="gallery"><?php _e( 'Gallery', $shult->textdomain ); ?></a> <a href="#"
							data-filter="other"><?php _e( 'Other', $shult->textdomain ); ?></a>
					</div>
					<div id="su-generator-choices">
						<?php
							// Choices loop
							foreach ( su_shortcodes() as $name => $shortcode ) {
								$icon = ( isset( $shortcode['icon'] ) ) ? $shortcode['icon']
									: $shult->assets( 'images/icons', $name ) . '.png';
								echo
									'<span data-shortcode="' . $name . '" title="' . esc_attr( $shortcode['desc'] ) .
									'" data-desc="' . esc_attr( $shortcode['desc'] ) . '" data-group="' .
									$shortcode['group'] . '"><img src="' . $icon .
									'" alt="" width="32" height="32" /><strong>' . $shortcode['name'] .
									'</strong></span>';
							}
						?>
					</div>
				</div>
				<div id="su-generator-settings"></div>
				<input type="hidden" name="su-generator-selected" id="su-generator-selected"
					value="<?php echo $shult->url; ?>" />
				<input type="hidden" name="su-generator-url" id="su-generator-url" value="<?php echo $shult->url; ?>" />
				<input type="hidden" name="su-compatibility-mode-prefix" id="su-compatibility-mode-prefix"
					value="<?php echo su_compatibility_mode_prefix(); ?>" />
				<div id="su-generator-result" style="display:none"></div>
			</div>
		</div>
	<?php
	}

	/**
	 * Process AJAX request
	 */
	function su_generator_settings() {
		$shult = shortcodes_ultimate();
		// Capability check
		if ( !current_user_can( 'edit_posts' ) ) wp_die( __( 'Access denied', $shult->textdomain ) );
		// Param check
		if ( empty( $_REQUEST['shortcode'] ) ) wp_die( __( 'Shortcode not specified', $shult->textdomain ) );
		// Request queried shortcode
		$shortcode = su_shortcodes( htmlentities( $_REQUEST['shortcode'] ) );
		// Shortcode header
		$return = '<div id="su-generator-breadcrumbs"><a href="#" id="su-generator-select-another" title="' .
			__( 'Click to return to the shortcodes list', $shult->textdomain ) . '">' .
			__( 'All shortcodes', $shult->textdomain ) . '</a> &rarr; <span>' . $shortcode['name'] . '</span> <small>' .
			$shortcode['desc'] . '</small></div>';
		// Shortcode has atts
		if ( count( $shortcode['atts'] ) && $shortcode['atts'] ) {
			// Loop through shortcode parameters
			foreach ( $shortcode['atts'] as $attr_name => $attr_info ) {
				$return .= '<div class="su-generator-attr-container">';
				$return .= '<h5>' . $attr_info['name'] . '</h5>';
				// Create field types
				switch ( $attr_info['type'] ) {
					// Select
					case 'select':
						// Detect array type (numbers or strings with translations)
						$is_numbers = is_numeric( implode( '', array_keys( $attr_info['values'] ) ) ) ? true : false;
						// Multiple selects
						$multiple = ( $attr_info['multiple'] ) ? ' multiple' : '';
						$return .= '<select name="' . $attr_name . '" id="su-generator-attr-' . $attr_name .
							'" class="su-generator-attr"' . $multiple . '>';
						// Create options
						foreach ( $attr_info['values'] as $option_value => $option_title ) {
							// Values is indexed array, replace  array keys by titles
							if ( $is_numbers ) $option_value = $option_title;
							// Is this option selected
							$selected = ( $attr_info['default'] == $option_value ) ? ' selected="selected"' : '';
							// Create option
							$return .=
								'<option value="' . $option_value . '"' . $selected . '>' . $option_title . '</option>';
						}
						$return .= '</select>';
						break;
					// Switch
					case 'switch':
						$return .= '<span class="su-generator-switch su-generator-switch-' . $attr_info['default'] .
							'"><span class="su-generator-yes">' . __( 'Yes', $shult->textdomain ) .
							'</span><span class="su-generator-no">' . __( 'No', $shult->textdomain ) .
							'</span></span><input type="hidden" name="' . $attr_name . '" value="' .
							esc_attr( $attr_info['default'] ) . '" id="su-generator-attr-' .
							$attr_name . '" class="su-generator-attr" />';
						break;
					// Upload
					case 'upload':
						$return .=
							'<div class="su-generator-upload-field-wrap"><span class="su-generator-upload-field"><input type="text" name="' .
							$attr_name . '" value="' . esc_attr( $attr_info['default'] ) . '" id="su-generator-attr-' .
							$attr_name .
							'" class="su-generator-attr" /></span><span class="su-generator-upload-button"><a href="#" class="button">&hellip;</a><input type="file" name="su_generator_file_upload" /></span></div><small class="description">' .
							__( 'Max upload file size', $shult->textdomain ) . ': ' .
							floor( wp_max_upload_size() / 1024 / 1024 ) . __( 'Mb', $shult->textdomain ) .
							'. <a href="http://www.wpbeginner.com/wp-tutorials/how-to-increase-the-maximum-file-upload-size-in-wordpress/" target="_blank">' .
							__( 'How to increase', $shult->textdomain ) . '</a>.</small>';
						break;
					// Color
					case 'color':
						$return .=
							'<span class="su-generator-select-color"><span class="su-generator-select-color-wheel"></span><input type="text" name="' .
							$attr_name . '" value="' . $attr_info['default'] . '" id="su-generator-attr-' .
							$attr_name . '" class="su-generator-attr su-generator-select-color-value" /></span>';
						break;
					// Gallery
					case 'gallery':
						// Prepare galleries list
						$galleries = $shult->get_option( 'galleries' );
						$created = ( is_array( $galleries ) && count( $galleries ) ) ? true : false;
						$return .= '<select name="' . $attr_name . '" id="su-generator-attr-' .
							$attr_name . '" class="su-generator-attr">';
						// Check that galleries is exists
						if ( $created ) // Create options
						foreach ( $galleries as $g_id => $gallery ) {
							// Is this option selected
							$selected = ( $g_id == 0 ) ? ' selected="selected"' : '';
							// Prepare title
							$gallery['name'] = ( $gallery['name'] == '' ) ? __( 'Untitled gallery', $shult->textdomain )
								: stripslashes( $gallery['name'] );
							// Create option
							$return .= '<option value="' . ( $g_id + 1 ) . '"' . $selected . '>' .
								$gallery['name'] . '</option>';
						}
						// Galleries not created
						else
							$return .= '<option value="0" selected>' .
								__( 'Galleries not found', $shult->textdomain ) . '</option>';
						$return .= '</select><small class="description"><a href="' . $shult->admin_url .
							'#tab-3" target="_blank">' . __( 'Manage galleries', $shult->textdomain ) . '</a></small>';
						break;
					// Number
					case 'number':
						$return .= '<input type="number" name="' . $attr_name . '" value="' .
							esc_attr( $attr_info['default'] ) . '" id="su-generator-attr-' . $attr_name . '" min="' .
							$attr_info['min'] . '" max="' . $attr_info['max'] . '" step="' .
							$attr_info['step'] . '" class="su-generator-attr" />';
						break;
					// Text and other types
					default:
						$return .=
							'<input type="text" name="' . $attr_name . '" value="' . esc_attr( $attr_info['default'] ) .
							'" id="su-generator-attr-' . $attr_name . '" class="su-generator-attr" />';
						break;
				}
				if ( $attr_info['desc'] ) $return .= '<div class="su-generator-attr-desc">' . str_replace( '<b%value>',
				                                                                                           '<b class="su-generator-set-value" title="' .
				                                                                                           __( 'Click to set this value',
				                                                                                               $shult->textdomain ) .
				                                                                                           '">',
				                                                                                           $attr_info['desc'] ) . '</div>';
				$return .= '</div>';
			}
		}
		// Single shortcode (not closed)
		if ( $shortcode['type'] == 'single'
		) $return .= '<input type="hidden" name="su-generator-content" id="su-generator-content" value="false" />';
		// Wrapping shortcode
		else
			$return .= '<div class="su-generator-attr-container"><h5>' . __( 'Content', $shult->textdomain ) .
				'</h5><textarea name="su-generator-content" id="su-generator-content" rows="3">' .
				esc_attr( $shortcode['content'] ) . '</textarea></div>';
		$return .= '<div id="su-generator-preview"></div>';
		$return .=
			'<div class="su-generator-actions"><a href="#" class="button button-primary button-large" id="su-generator-insert">' .
			__( 'Insert shortcode', $shult->textdomain ) .
			'</a> <a href="#" class="button button-large" id="su-generator-preview-link">' .
			__( 'Live preview', $shult->textdomain ) .
			'</a> <a href="#" class="button alignright button-large" id="su-generator-cancel">' .
			__( 'Close window', $shult->textdomain ) . '</a></div>';
		echo $return;
		exit;
	}

	add_action( 'wp_ajax_su_generator_settings', 'su_generator_settings' );

	/**
	 * Process AJAX request and generate preview HTML
	 */
	function su_generator_preview() {
		$shult = shortcodes_ultimate();
		// Check authentication
		if ( !current_user_can( 'edit_posts' ) ) die( __( 'Access denied', $shult->textdomain ) );
		// Output results
		do_action( 'su_generator_preview_before' );
		echo '<h5>' . __( 'Preview', $shult->textdomain ) . '</h5>';
		echo do_shortcode( str_replace( '\"', '"', $_POST['shortcode'] ) );
		echo '<div class="su-spacer"></div>';
		do_action( 'su_generator_preview_after' );
		die();
	}

	add_action( 'wp_ajax_su_generator_preview', 'su_generator_preview' );

	/**
	 * Process AJAX request and generate json-encoded array with terms
	 */
	function su_generator_get_terms() {
		$shult = shortcodes_ultimate();
		// Check authentication
		if ( !current_user_can( 'edit_posts' ) ) die( __( 'Access denied', $shult->textdomain ) );
		die( json_encode( su_get_terms( sanitize_text_field( $_POST['taxonomy'] ) ) ) );
	}

	add_action( 'wp_ajax_su_generator_get_terms', 'su_generator_get_terms' );

	/**
	 * Function to handle uploads
	 */
	function su_generator_upload() {
		$shult = shortcodes_ultimate();
		// Check capability
		if ( !current_user_can( 'edit_posts' ) ) die( __( 'Access denied', $shult->textdomain ) );
		// Create mew upload instance
		$upload = new MediaUpload;
		// Save file
		$file = $upload->saveUpload( $field_name = 'file' );
		// Print result
		die( wp_get_attachment_url( $file['attachment_id'] ) );
	}

	add_action( 'wp_ajax_su_generator_upload', 'su_generator_upload' );
?>