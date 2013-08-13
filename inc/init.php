<?php

	// Add activation and initialization hooks
	add_action( 'plugins_loaded', 'su_init' );
	register_activation_hook( SU_PLUGIN_FILE, 'su_check_version' );
	register_activation_hook( SU_PLUGIN_FILE, 'su_create_skins_dir' );

	// Define global plugin instance
	$shult = null;

	/**
	 * Register main plugin function to perform checks that plugin is installed
	 *
	 * Useful for integration with themes and other plugins
	 *
	 * @global Sunrise_Plugin_Framework_2 $shult
	 * @return \Sunrise_Plugin_Framework_2
	 */
	function shortcodes_ultimate() {
		global $shult;
		return $shult;
	}

	/**
	 * Plugin initialization hook
	 */
	function su_init() {
		// Get global plugin instance
		global $shult;
		// Create plugin instance
		$shult = new Sunrise_Plugin_Framework_2( SU_PLUGIN_FILE );
		// Register settings page
		$shult->add_options_page( array( 'link' => false ), su_plugin_options() );
		// Translate plugin meta
		__( 'Shortcodes Ultimate', $shult->textdomain );
		__( 'Vladimir Anokhin', $shult->textdomain );
		__( 'Supercharge your WordPress theme with mega pack of shortcodes', $shult->textdomain );
		// Add links to plugins dashboard
		add_filter( 'plugin_action_links_' . $shult->basename, 'su_plugin_actions_links', -10 );
	}

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
		$message_wp = sprintf( __( '<h1>Oops! Plugin not activated&hellip;</h1> <p>Shortcodes Ultimate is not fully compatible with your version of WordPress (%s).<br />Reccomended WordPress version &ndash; %s (or higher).</p><a href="%s">&larr; Return to the plugins screen</a> <a href="%s"%s>Continue and activate anyway &rarr;</a>',
		                           'shortcodes-ultimate' ), $wp, $min_wp,
		                       network_admin_url( 'plugins.php?deactivate=true' ),
		                       $_SERVER['REQUEST_URI'] . '&continue=true', ' style="float:right;font-weight:bold"' );
		$message_php = sprintf( __( '<h1>Oops! Plugin not activated&hellip;</h1> <p>Shortcodes Ultimate is not fully compatible with your PHP version (%s).<br />Reccomended PHP version &ndash; %s (or higher).</p><a href="%s">&larr; Return to the plugins screen</a> <a href="%s"%s>Continue and activate anyway &rarr;</a>',
		                            'shortcodes-ultimate' ), $php, $min_php,
		                        network_admin_url( 'plugins.php?deactivate=true' ),
		                        $_SERVER['REQUEST_URI'] . '&continue=true', ' style="float:right;font-weight:bold"' );
		// Check Forced activation
		if ( !isset( $_GET['continue'] ) ) if ( version_compare( $min_wp, $wp, '>' ) ) {
			deactivate_plugins( plugin_basename( SU_PLUGIN_FILE ) );
			wp_die( $message_wp );
		}
		elseif ( version_compare( $min_php, $php, '>' ) ) {
			deactivate_plugins( plugin_basename( SU_PLUGIN_FILE ) );
			wp_die( $message_php );
		}
	}

	/**
	 * Create empty directory for skins if not exists
	 */
	function su_create_skins_dir() {
		$upload_dir = wp_upload_dir();
		$path = trailingslashit( path_join( $upload_dir['basedir'], 'shortcodes-ultimate-skins' ) );
		if ( !file_exists( $path ) ) mkdir( $path, 0755 );
	}

	/**
	 * Plugin actions links
	 */
	function su_plugin_actions_links( $links ) {
		$shult = shortcodes_ultimate();
		$links[] = '<a href="' . $shult->admin_url . '#tab-1">' . __( 'Settings', $shult->textdomain ) . '</a>';
		$links[] = '<a href="' . $shult->admin_url . '#tab-0"><b>' . __( 'Welcome', $shult->textdomain ) . '</b></a>';
		return $links;
	}

	/**
	 * Plugin options
	 */
	function su_plugin_options() {
		$shult = shortcodes_ultimate();
		return array( array( 'name' => __( 'About', $shult->textdomain ), 'type' => 'opentab' ),
		              array( 'type' => 'about' ), array( 'type' => 'closetab', 'actions' => false ),
		              array( 'name' => __( 'Settings', $shult->textdomain ), 'type' => 'opentab' ),
		              array( 'name' => __( 'Custom formatting', $shult->textdomain ), 'desc' =>
		              __( 'Disable this option if you have some problems with other plugins or content formatting',
		                  $shult->textdomain ) .
		              '<br /><a href="http://support.gndev.info/docs/custom-formatting/" target="_blank">' .
		              __( 'Documentation article', $shult->textdomain ) . '</a>', 'std' => 'on',
		                     'id' => 'custom_formatting', 'type' => 'checkbox',
		                     'label' => __( 'Enabled', $shult->textdomain ) ),
		              array( 'name' => __( 'Compatibility mode', $shult->textdomain ), 'desc' =>
		              __( 'Enable this option if you have some problems with other plugins that uses similar shortcode names',
		                  $shult->textdomain ) . '<br /><code>[button] => [su_button]</code> ' .
		              __( 'etc.', $shult->textdomain ) .
		              '<br /><a href="http://support.gndev.info/docs/compatibility-mode/" target="_blank">' .
		              __( 'Documentation article', $shult->textdomain ) . '</a>', 'std' => '',
		                     'id' => 'compatibility_mode', 'type' => 'checkbox',
		                     'label' => __( 'Enabled', $shult->textdomain ) ),
		              array( 'name' => __( 'Skin', $shult->textdomain ),
		                     'desc' => sprintf( __( 'Choose skin for shortcodes.<br /><a href="%s" target="_blank">Learn how to create custom skin</a><br /><a href="%s" target="_blank"><b>Download more skins</b></a>',
		                                            $shult->textdomain ),
		                                        'http://support.gndev.info/docs/create-custom-skin/',
		                                        'http://gndev.info/shortcodes-ultimate/addons/' ), 'std' => 'default',
		                     'id' => 'skin', 'type' => 'skin' ), array( 'type' => 'closetab' ),
		              array( 'name' => __( 'Custom CSS', $shult->textdomain ), 'type' => 'opentab' ),
		              array( 'id' => 'custom_css', 'type' => 'css' ), array( 'type' => 'closetab' ),
		              array( 'name' => __( 'Galleries', $shult->textdomain ), 'type' => 'opentab' ),
		              array( 'id' => 'galleries', 'type' => 'galleries' ), array( 'type' => 'closetab' ),
		              array( 'name' => __( 'Cheatsheet', $shult->textdomain ), 'type' => 'opentab' ),
		              array( 'type' => 'cheatsheet' ), array( 'type' => 'closetab', 'actions' => false ), );
	}