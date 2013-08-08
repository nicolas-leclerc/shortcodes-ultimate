<?php

	/*
	  Plugin Name: Shortcodes Ultimate
	  Plugin URI: http://gndev.info/shortcodes-ultimate/
	  Version: 4.0.0
	  Author: Vladimir Anokhin
	  Author URI: http://gndev.info/
	  Description: Supercharge your WordPress theme with mega pack of shortcodes
	  Text Domain: shortcodes-ultimate
	  Domain Path: /languages
	  License: GPL
	 */

	// Define plugin file constant
	define( 'SU_PLUGIN_FILE', __FILE__ );

	// Include classes
	require_once 'classes/sunrise.class.php';
	require_once 'classes/media-upload.class.php';

	// Include plugin files
	require_once 'inc/init.php';
	require_once 'inc/assets.php';
	require_once 'inc/tools.php';
	require_once 'inc/resize.php';
	require_once 'inc/shortcodes/data.php';
	require_once 'inc/generator.php';
	require_once 'inc/widget.php';
	require_once 'inc/shortcodes/shortcodes.php';

	// Example add-on
	// require_once 'inc/example-addon.php';
?>