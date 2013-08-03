<?php

	$su_query_assets = array( 'css' => array(), 'js' => array() );

	function su_query_asset( $type, $handle ) {
		global $su_query_assets;
		$su_query_assets[$type][$handle] = $handle;
	}

	function su_register_assets() {
		// Get plugin object
		global $shult;
		// Register stylesheets
		wp_register_style( 'su-content-shortcodes', $shult->assets( 'css', 'content-shortcodes.css' ), false, $shult->version, 'all' );
		wp_register_style( 'su-box-shortcodes', $shult->assets( 'css', 'box-shortcodes.css' ), false, $shult->version, 'all' );
		wp_register_style( 'su-media-shortcodes', $shult->assets( 'css', 'media-shortcodes.css' ), false, $shult->version, 'all' );
		wp_register_style( 'su-other-shortcodes', $shult->assets( 'css', 'other-shortcodes.css' ), false, $shult->version, 'all' );
		wp_register_style( 'su-galleries-shortcodes', $shult->assets( 'css', 'galleries-shortcodes.css' ), false, $shult->version, 'all' );
		wp_register_style( 'su-players-shortcodes', $shult->assets( 'css', 'players-shortcodes.css' ), false, $shult->version, 'all' );
		// Register scripts
		wp_register_script( 'swiper', $shult->assets( 'js', 'swiper.js' ), array( 'jquery' ), $shult->version, true );
		wp_register_script( 'jplayer', $shult->assets( 'js', 'jplayer.js' ), array( 'jquery' ), $shult->version, true );
		wp_register_script( 'su-galleries-shortcodes', $shult->assets( 'js', 'galleries-shortcodes.js' ), array( 'jquery', 'swiper' ), $shult->version, true );
		wp_register_script( 'su-players-shortcodes', $shult->assets( 'js', 'players-shortcodes.js' ), array( 'jquery', 'jplayer' ), $shult->version, true );
		wp_register_script( 'su-other-shortcodes', $shult->assets( 'js', 'other-shortcodes.js' ), array( 'jquery' ), $shult->version, true );
	}

	add_action( 'wp_head', 'su_register_assets' );
	add_action( 'su_generator_preview_before', 'su_register_assets' );


	function su_enqueue_assets() {
		// Get assets query and plugin object
		global $su_query_assets, $shult;
		// Apply filters to modify assets set
		$su_query_assets['css'] = ( array ) apply_filters( 'shortcodes_ultimate_css', ( array ) array_unique( $su_query_assets['css'] ) );
		$su_query_assets['js'] = ( array ) apply_filters( 'shortcodes_ultimate_js', ( array ) array_unique( $su_query_assets['js'] ) );
		// Get custom CSS
		$custom_css = $shult->get_option( 'custom_css' );
		// Enqueue stylesheets
		wp_print_styles( array_unique( $su_query_assets['css'] ) );
		// Enqueue scripts
		wp_print_scripts( array_unique( $su_query_assets['js'] ) );
		// Print custom css
		if ( $custom_css ) echo "\n\n<!-- Shortcodes Ultimate custom CSS - begin -->\n<style type='text/css'>\n" .
			stripslashes( str_replace( array( '%theme_url%', '%home_url%', '%plugin_url%' ), array( get_stylesheet_directory_uri(), get_option( 'home' ), $shult->url ), $custom_css ) ) .
			"\n</style>\n<!-- Shortcodes Ultimate custom CSS - end -->\n\n";
	}

	add_action( 'wp_footer', 'su_enqueue_assets' );
	add_action( 'su_generator_preview_after', 'su_enqueue_generator_assets' );