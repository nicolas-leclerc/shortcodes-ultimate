<div id="su-custom-css-screen">
	<div class="su-custom-css-originals">
		<strong><?php _e( 'You can see the original styles to override it', $this->textdomain ); ?></strong><br/>
		<a href="<?php echo $this->assets( 'css', 'content-shortcodes.css' ); ?>">content-shortcodes.css</a>
		<span></span>
		<a href="<?php echo $this->assets( 'css', 'box-shortcodes.css' ); ?>">box-shortcodes.css</a>
		<span></span>
		<a href="<?php echo $this->assets( 'css', 'media-shortcodes.css' ); ?>">media-shortcodes.css</a>
		<span></span>
		<a href="<?php echo $this->assets( 'css', 'galleries-shortcodes.css' ); ?>">galleries-shortcodes.css</a>
		<span></span>
		<a href="<?php echo $this->assets( 'css', 'players-shortcodes.css' ); ?>">players-shortcodes.css</a>
		<span></span>
		<a href="<?php echo $this->assets( 'css', 'other-shortcodes.css' ); ?>">other-shortcodes.css</a>
	</div>
	<div class="su-custom-css-vars">
		<strong><?php _e( 'You can use next variables in your custom CSS', $this->textdomain ); ?></strong><br/>
		<code>%home_url%</code> - <?php _e( 'home url', $this->textdomain ); ?><br/>
		<code>%theme_url%</code> - <?php _e( 'theme url', $this->textdomain ); ?><br/>
		<code>%plugin_url%</code> - <?php _e( 'plugin url', $this->textdomain ); ?>
	</div>
	<div id="su-custom-css-editor">
		<span id="su-fullscreen" title="<?php _e( 'Toggle fullscreen', $this->textdomain ); ?>"></span>
		<textarea name="<?php echo $option['id']; ?>" id="sunrise-plugin-field-<?php echo $option['id']; ?>" class="regular-text"><?php echo stripslashes( $settings[$option['id']] ); ?></textarea>
	</div>
</div>