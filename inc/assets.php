<?php

	/**
	 * Register all plugin assets in one place
	 */
	function su_register_assets() {
		// Get plugin object
		$shult = shortcodes_ultimate();
		// qTip
		wp_register_script( 'qtip', $shult->assets( 'js', 'qtip.js' ), array( 'jquery' ), '1.0.0-rc3', true );
		// Magnific Popup
		wp_register_style( 'magnific-popup', $shult->assets( 'css', 'magnific-popup.css' ), false, '0.8.6', 'all' );
		wp_register_script( 'magnific-popup', $shult->assets( 'js', 'magnific-popup.js' ), array( 'jquery' ), '0.8.6',
		                    true );
		// Ace
		wp_register_script( 'ace', '//cdnjs.cloudflare.com/ajax/libs/ace/1.1.01/ace.js', false, '1.1.01', true );
		// Iframe transport
		wp_register_script( 'iframe-transport', $shult->assets( 'js', 'iframe-transport.js' ), array( 'jquery' ), '1.7',
		                    true );
		// File upload
		wp_register_script( 'file-upload', $shult->assets( 'js', 'file-upload.js' ),
		                    array( 'iframe-transport', 'jquery-ui-widget' ), '5.31.6', true );
		// Options page
		wp_register_style( 'su-options-page', $shult->assets( 'css', 'options-page.css' ), false, $shult->version,
		                   'all' );
		wp_register_script( 'su-options-page', $shult->assets( 'js', 'options-page.js' ),
		                    array( 'magnific-popup', 'file-upload', 'jquery-ui-sortable', 'ace' ), $shult->version,
		                    true );
		// Generator
		wp_register_style( 'su-generator', $shult->assets( 'css', 'generator.css' ),
		                   array( 'farbtastic', 'magnific-popup' ), $shult->version, 'all' );
		wp_register_script( 'su-generator', $shult->assets( 'js', 'generator.js' ),
		                    array( 'file-upload', 'farbtastic', 'magnific-popup', 'qtip' ), $shult->version, true );
		// Shortcodes stylesheets
		wp_register_style( 'su-content-shortcodes', su_skin_url( 'content-shortcodes.css' ), false, $shult->version,
		                   'all' );
		wp_register_style( 'su-box-shortcodes', su_skin_url( 'box-shortcodes.css' ), false, $shult->version, 'all' );
		wp_register_style( 'su-media-shortcodes', su_skin_url( 'media-shortcodes.css' ), false, $shult->version,
		                   'all' );
		wp_register_style( 'su-other-shortcodes', su_skin_url( 'other-shortcodes.css' ), false, $shult->version,
		                   'all' );
		wp_register_style( 'su-galleries-shortcodes', su_skin_url( 'galleries-shortcodes.css' ), false, $shult->version,
		                   'all' );
		wp_register_style( 'su-players-shortcodes', su_skin_url( 'players-shortcodes.css' ), false, $shult->version,
		                   'all' );
		// Shortcodes scripts
		wp_register_script( 'swiper', $shult->assets( 'js', 'swiper.js' ), array( 'jquery' ), $shult->version, true );
		wp_register_script( 'jplayer', $shult->assets( 'js', 'jplayer.js' ), array( 'jquery' ), $shult->version, true );
		wp_register_script( 'su-galleries-shortcodes', $shult->assets( 'js', 'galleries-shortcodes.js' ),
		                    array( 'jquery', 'swiper' ), $shult->version, true );
		wp_register_script( 'su-players-shortcodes', $shult->assets( 'js', 'players-shortcodes.js' ),
		                    array( 'jquery', 'jplayer' ), $shult->version, true );
		wp_register_script( 'su-other-shortcodes', $shult->assets( 'js', 'other-shortcodes.js' ), array( 'jquery' ),
		                    $shult->version, true );
	}

	add_action( 'wp_head', 'su_register_assets' );
	add_action( 'admin_head', 'su_register_assets' );
	add_action( 'su_generator_preview_before', 'su_register_assets' );

	// Prepare global assets variable
	$su_query_assets = array( 'css' => array(), 'js' => array() );

	/**
	 * Helper to add assets to the global query
	 *
	 * @param string $type   Asset type (css/js)
	 * @param mixed  $handle Asset handle. Can be an array with handles
	 */
	function su_query_asset( $type, $handle ) {
		global $su_query_assets;
		// Array with handles
		if ( is_array( $handle ) ) foreach ( $handle as $h ) $su_query_assets[$type][$h] = $h;
		// Single handle
		else $su_query_assets[$type][$handle] = $handle;
	}

	/**
	 * Enqueue requested assets
	 */
	function su_enqueue_assets() {
		// Get assets query and plugin object
		$assets = su_get_assets();
		// Enqueue stylesheets
		foreach ( $assets['css'] as $style ) wp_enqueue_style( $style );
		// Enqueue scripts
		foreach ( $assets['js'] as $script ) wp_enqueue_script( $script );
		// Print custom css
		su_print_custom_css();
	}

	add_action( 'wp_footer', 'su_enqueue_assets' );
	add_action( 'admin_footer', 'su_enqueue_assets' );

	/**
	 * Print requested assets
	 */
	function su_print_assets() {
		// Prepare assets set
		$assets = su_get_assets();
		// Enqueue stylesheets
		wp_print_styles( $assets['css'] );
		// Enqueue scripts
		wp_print_scripts( $assets['js'] );
		// Print custom css
		su_print_custom_css();
	}

	add_action( 'su_generator_preview_after', 'su_print_assets' );

	/**
	 * Print custom CSS
	 */
	function su_print_custom_css() {
		$shult = shortcodes_ultimate();
		// Get custom CSS and apply filters to it
		$custom_css = apply_filters( 'shortcodes_ultimate_custom_css',
		                             str_replace('&#039;', '\'', html_entity_decode( $shult->get_option( 'custom_css' ) ) ) );
		// Print CSS if exists
		if ( $custom_css ) echo "\n\n<!-- Shortcodes Ultimate custom CSS - begin -->\n<style type='text/css'>\n" .
			stripslashes( str_replace( array( '%theme_url%', '%home_url%', '%plugin_url%' ),
			                           array( get_stylesheet_directory_uri(), get_option( 'home' ), $shult->url ),
			                           $custom_css ) ) .
			"\n</style>\n<!-- Shortcodes Ultimate custom CSS - end -->\n\n";
	}

	/**
	 * Get requested assets set
	 */
	function su_get_assets() {
		// Get assets query
		global $su_query_assets;
		// Apply filters to assets set
		$su_query_assets['css'] = array_unique( ( array ) apply_filters( 'shortcodes_ultimate_css',
		                                                                 ( array ) array_unique( $su_query_assets['css'] ) ) );
		$su_query_assets['js'] = array_unique( ( array ) apply_filters( 'shortcodes_ultimate_js',
		                                                                ( array ) array_unique( $su_query_assets['js'] ) ) );
		// Return set
		return $su_query_assets;
	}

	/**
	 * Enqueue additional assets at options page created with Sunrise Plugin Framework
	 */
	function su_add_options_page_assets() {
		$shult = shortcodes_ultimate();
		// Check this is Shortcodes Ultimate settings page
		if ( $_GET['page'] !== $shult->slug ) return;
		// Request assets
		su_query_asset( 'css', array( 'magnific-popup', 'ace', 'su-options-page' ) );
		su_query_asset( 'js',
		                array( 'jquery', 'magnific-popup', 'jquery-ui-core', 'jquery-ui-widget', 'jquery-ui-mouse',
		                       'jquery-ui-sortable', 'iframe-transport', 'file-upload', 'css', 'su-options-page' ) );
	}

	add_action( 'sunrise_page_before', 'su_add_options_page_assets' );

	/**
	 * Helper to get full URL of a skin file
	 *
	 * @param string $file Skin file name (ex. box-shortcodes.css)
	 *
	 * @return string Absolute url to skin file
	 */
	function su_skin_url( $file = '' ) {
		$shult = shortcodes_ultimate();
		$skin = $shult->get_option( 'skin' );
		$uploads = wp_upload_dir();
		$uploads = $uploads['baseurl'];
		// Prepare url to skin directory
		$url = ( $skin === 'default' ) ? $shult->assets( 'css', '' ) : $uploads . '/shortcodes-ultimate-skins/' . $skin;
		return trailingslashit( $url ) . $file;
	}