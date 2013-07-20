<?php

	register_activation_hook( SU_PLUGIN_FILE, 'su_check_version' );

	/**
	 * Check WordPress and PHP version on activation
	 */
	function su_check_version() {
		// Prepare versions
		$min_wp = '3.3';
		$min_php = '5.1';
		$wp = get_bloginfo( 'version' );
		$php = phpversion();
		// Load textdomain
		load_plugin_textdomain( 'shortcodes-ultimate', false, 'shortcodes-ultimate/languages/' );
		// Prepare messages
		$message_wp = sprintf( __( '<h1>Oops! Plugin not activated&hellip;</h1> <p>Shortcodes Ultimate is not fully compatible with your version of WordPress (%s).<br />Reccomended WordPress version &ndash; %s (or higher).</p><a href="%s">&larr; Return to the plugins screen</a> <a href="%s"%s>Continue and activate anyway &rarr;</a>', 'shortcodes-ultimate' ), $wp, $min_wp, network_admin_url( 'plugins.php?deactivate=true' ), $_SERVER['REQUEST_URI'] . '&continue=true', ' style="float:right;font-weight:bold"' );
		$message_php = sprintf( __( '<h1>Oops! Plugin not activated&hellip;</h1> <p>Shortcodes Ultimate is not fully compatible with your PHP version (%s).<br />Reccomended PHP version &ndash; %s (or higher).</p><a href="%s">&larr; Return to the plugins screen</a> <a href="%s"%s>Continue and activate anyway &rarr;</a>', 'shortcodes-ultimate' ), $php, $min_php, network_admin_url( 'plugins.php?deactivate=true' ), $_SERVER['REQUEST_URI'] . '&continue=true', ' style="float:right;font-weight:bold"' );
		// Check Forced activation
		if ( !isset( $_GET['continue'] ) )
			if ( version_compare( $min_wp, $wp, '>' ) ) {
				deactivate_plugins( plugin_basename( SU_PLUGIN_FILE ) );
				wp_die( $message_wp );
			}
			elseif ( version_compare( $min_php, $php, '>' ) ) {
				deactivate_plugins( plugin_basename( SU_PLUGIN_FILE ) );
				wp_die( $message_php );
			}
	}

	// Create plugin instance
	$shult = new Sunrise_Plugin_Framework;

	// Register settings page
	$shult->add_settings_page( array(
		'parent' => 'options-general.php',
		'page_title' => $shult->name,
		'menu_title' => $shult->name,
		'capability' => 'manage_options',
		'settings_link' => false
	) );

	// Translate plugin meta
	__( 'Shortcodes Ultimate', $shult->textdomain );
	__( 'Vladimir Anokhin', $shult->textdomain );
	__( 'Supercharge your WordPress theme with mega pack of shortcodes', $shult->textdomain );

	/**
	 * Plugin actions links
	 */
	function su_docs_settings_links( $links ) {
		global $shult;
		$links[] = '<a href="' . $shult->admin_url . '#tab-1">' . __( 'Settings', $shult->textdomain ) . '</a>';
		$links[] = '<a href="' . $shult->admin_url . '#tab-0"><b>' . __( 'Welcome', $shult->textdomain ) . '</b></a>';
		return $links;
	}

	add_filter( 'plugin_action_links_' . $shult->slug . '/' . $shult->slug . '.php', 'su_docs_settings_links', -10 );

	/**
	 * Register main plugin function to perform checks that plugin is installed
	 *
	 * Useful for integration with themes and other plugins
	 *
	 * @global Sunrise_Plugin_Framework $shult
	 * @return \Sunrise_Plugin_Framework
	 */
	function shortcodes_ultimate() {
		global $shult;
		return $shult;
	}

?>