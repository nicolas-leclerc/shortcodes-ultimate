<?php
	$template_skins_path = path_join( get_template_directory(), 'shortcodes/skins/' );
	$option['options'] = array( 'default' );
	foreach ( glob( $template_skins_path . '*', GLOB_ONLYDIR ) as $dir ) {
		$dir = str_replace( $template_skins_path, '', $dir );
		$option['options'][] = $dir;
	}
	$trigger = ( $option['trigger'] ) ? ' data-trigger="true" data-trigger-type="select"' : '';
	$triggable = ( $option['triggable'] ) ?
		' data-triggable="' . $option['triggable'] . '" class="sunrise-plugin-triggable hide-if-js"' : '';
?>
<tr<?php echo $trigger, $triggable; ?>>
	<th scope="row">
		<label for="sunrise-plugin-field-<?php echo $option['id']; ?>"><?php echo $option['name']; ?></label></th>
	<td>
		<select name="<?php echo $option['id']; ?>" id="sunrise-plugin-field-<?php echo $option['id']; ?>" class="sunrise-plugin-select">
			<?php
				foreach ( $option['options'] as $skin ) {
					$selected = ( $settings[$option['id']] == $skin ) ? ' selected="selected"' : '';
					?>
					<option value="<?php echo $skin; ?>"<?php echo $selected; ?>><?php echo $skin; ?></option>
				<?php
				}
			?>
		</select> <span class="description"><?php echo $option['desc']; ?></span>
	</td>
</tr>