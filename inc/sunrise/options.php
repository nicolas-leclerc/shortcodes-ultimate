<?php

	/** Plugin options */
	$options = array(
		array(
			'name' => __( 'About', $this->textdomain ),
			'type' => 'opentab'
		),
		array(
			'type' => 'about'
		),
		array(
			'type' => 'closetab',
			'actions' => false
		),
		array(
			'name' => __( 'Settings', $this->textdomain ),
			'type' => 'opentab'
		),
		array(
			'name' => __( 'Custom formatting', $this->textdomain ),
			'desc' => __( 'Disable this option if you have some problems with other plugins or content formatting', $this->textdomain ) . '<br /><a href="http://support.gndev.info/docs/custom-formatting/" target="_blank">' . __( 'Documentation article', $this->textdomain ) . '</a>',
			'std' => 'on',
			'id' => 'custom_formatting',
			'type' => 'checkbox',
			'label' => __( 'Enabled', $this->textdomain )
		),
		array(
			'name' => __( 'Compatibility mode', $this->textdomain ),
			'desc' => __( 'Enable this option if you have some problems with other plugins that uses similar shortcode names', $this->textdomain ) . '<br /><code>[button] => [su_button]</code> ' . __( 'etc.', $this->textdomain ) . '<br /><a href="http://support.gndev.info/docs/compatibility-mode/" target="_blank">' . __( 'Documentation article', $this->textdomain ) . '</a>',
			'std' => '',
			'id' => 'compatibility_mode',
			'type' => 'checkbox',
			'label' => __( 'Enabled', $this->textdomain )
		),
		array(
			'type' => 'closetab'
		),
		array(
			'name' => __( 'Custom CSS', $this->textdomain ),
			'type' => 'opentab'
		),
		array(
			'id' => 'custom_css',
			'type' => 'css'
		),
		array(
			'type' => 'closetab'
		),
		array(
			'name' => __( 'Galleries', $this->textdomain ),
			'type' => 'opentab'
		),
		array(
			'id' => 'galleries',
			'type' => 'galleries'
		),
		array(
			'type' => 'closetab'
		),
		array(
			'name' => __( 'Cheatsheet', $this->textdomain ),
			'type' => 'opentab'
		),
		array(
			'type' => 'cheatsheet'
		),
		array(
			'type' => 'closetab',
			'actions' => false
		),
	);
?>