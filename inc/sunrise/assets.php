<?php

	// Prepare data
	global $pagenow;

	// Register qTip
	wp_register_script( 'qtip', $this->assets( 'js', 'qtip.js' ), array( 'jquery' ), $this->version, false );
	// Register Magnific Popup assets
	wp_register_style( 'magnific-popup', $this->assets( 'css', 'popup.css' ), false, $this->version, 'all' );
	wp_register_script( 'magnific-popup', $this->assets( 'js', 'popup.js' ), array( 'jquery' ), $this->version, false );

	// BACKEND
	if ( is_admin() && $_GET['page'] === $this->slug ) {
		wp_enqueue_style( 'magnific-popup' );
		wp_enqueue_style( 'codemirror', $this->assets( 'css', 'codemirror.css' ), false, $this->version, 'all' );
		wp_enqueue_style( 'codemirror-ambiance', $this->assets( 'css', 'codemirror-ambiance.css' ), false, $this->version, 'all' );
		wp_enqueue_style( 'su-backend', $this->assets( 'css', 'backend.css' ), false, $this->version, 'all' );
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'magnific-popup' );
		wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script( 'jquery-ui-widget' );
		wp_enqueue_script( 'jquery-ui-mouse' );
		wp_enqueue_script( 'jquery-ui-sortable' );
		wp_enqueue_script( 'iframe-transport', $this->assets( 'js', 'iframe-transport.js' ), array( 'jquery' ), $this->version, false );
		wp_enqueue_script( 'fileupload', $this->assets( 'js', 'fileupload.js' ), array( 'iframe-transport', 'jquery-ui-widget' ), $this->version, false );
		wp_enqueue_script( 'codemirror', $this->assets( 'js', 'codemirror.js' ), array( 'jquery' ), $this->version, false );
		wp_enqueue_script( 'codemirror-css', $this->assets( 'js', 'codemirror-css.js' ), array( 'codemirror' ), $this->version, false );
		wp_enqueue_script( 'su-backend', $this->assets( 'js', 'backend.js' ), array( 'magnific-popup', 'fileupload', 'jquery-ui-sortable', 'codemirror-css' ), $this->version, false );
	}
	// GENERATOR
	elseif ( is_admin() && in_array( $pagenow, array( 'post.php', 'edit.php', 'post-new.php', 'index.php', 'edit-tags.php', 'widgets.php' ) ) ) {
		wp_enqueue_style( 'farbtastic' );
		wp_enqueue_style( 'magnific-popup' );
		wp_enqueue_style( 'su-generator', $this->assets( 'css', 'generator.css' ), array( 'farbtastic', 'magnific-popup' ), $this->version, 'all' );
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'jquery-ui-widget' );
		wp_enqueue_script( 'iframe-transport', $this->assets( 'js', 'iframe-transport.js' ), array( 'jquery-ui-widget' ), $this->version, false );
		wp_enqueue_script( 'fileupload', $this->assets( 'js', 'fileupload.js' ), array( 'iframe-transport' ), $this->version, false );
		wp_enqueue_script( 'farbtastic' );
		wp_enqueue_script( 'qtip' );
		wp_enqueue_script( 'magnific-popup' );
		wp_enqueue_script( 'su-generator', $this->assets( 'js', 'generator.js' ), array( 'fileupload', 'farbtastic', 'magnific-popup', 'qtip' ), $this->version, false );
	}
?>