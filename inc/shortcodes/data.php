<?php

	/**
	 * A list of available shortcodes and their parameters
	 */
	function su_shortcodes( $shortcode = false ) {
		// Get plugin object
		$shult = shortcodes_ultimate();
		// Setup shortcodes data
		$shortcodes = apply_filters( 'shortcodes_ultimate_data', array(
			# heading
			'heading' => array(
				'name' => __( 'Heading', $shult->textdomain ),
				'type' => 'wrap',
				'group' => 'content',
				'atts' => array(
					'style' => array(
						'type' => 'select',
						'values' => array(
							'default' => __( 'Default', $shult->textdomain ),
							'metro' => __( 'Metro', $shult->textdomain ),
							'thin' => __( 'Thin', $shult->textdomain )
						),
						'default' => 'default',
						'name' => __( 'Style', $shult->textdomain ), 'desc' => __( 'Choose heading style preset', $shult->textdomain )
					)
				),
				'usage' => '[heading] Content [/heading]<br/>[heading style="metro"] Content [/heading]', 'content' => __( 'Heading text', $shult->textdomain ),
				'desc' => __( 'Styled heading', $shult->textdomain )
			),
			# tabs
			'tabs' => array(
				'name' => __( 'Tabs', $shult->textdomain ),
				'type' => 'wrap',
				'group' => 'box',
				'atts' => array(
					'style' => array(
						'type' => 'select',
						'values' => array(
							'default' => __( 'Default', $shult->textdomain ),
							'metro' => __( 'Metro', $shult->textdomain ),
							'vertical' => __( 'Vertical', $shult->textdomain )
						),
						'default' => 'default',
						'name' => __( 'Style', $shult->textdomain ), 'desc' => __( 'Choose tabs style preset', $shult->textdomain )
					)
				),
				'usage' => '[tabs style="default"] [tab title="Tab name"] Tab content [/tab] [/tabs]',
				'content' => __( "[tab title=\"Title 1\"]Content 1[/tab]\n[tab title=\"Title 2\"]Content 2[/tab]\n[tab title=\"Title 3\"]Content 3[/tab]", $shult->textdomain ),
				'desc' => __( 'Tabs container', $shult->textdomain )
			),
			# tab
			'tab' => array(
				'name' => __( 'Tab', $shult->textdomain ),
				'type' => 'wrap',
				'group' => 'box',
				'atts' => array(
					'title' => array(
						'values' => array( ),
						'default' => __( 'Tab name', $shult->textdomain ),
						'name' => __( 'Title', $shult->textdomain ),
						'desc' => __( 'Enter tab name', $shult->textdomain )
					)
				),
				'usage' => '[tabs] [tab title="Tab name"] Tab content [/tab] [/tabs]', 'content' => __( 'Tab content', $shult->textdomain ),
				'desc' => __( 'Single tab', $shult->textdomain )
			),
			# spoiler
			'spoiler' => array(
				'name' => __( 'Spoiler', $shult->textdomain ),
				'type' => 'wrap',
				'group' => 'box',
				'atts' => array(
					'title' => array(
						'values' => array( ),
						'default' => __( 'Spoiler title', $shult->textdomain ),
						'name' => __( 'Title', $shult->textdomain ), 'desc' => __( 'Text in spoiler title', $shult->textdomain )
					),
					'open' => array(
						'type' => 'switch',
						'default' => 'no',
						'name' => __( 'Open', $shult->textdomain ),
						'desc' => __( 'Is spoiler content visible by default', $shult->textdomain )
					),
					'style' => array(
						'type' => 'select',
						'values' => array(
							'default' => __( 'Default', $shult->textdomain ),
							'metro' => __( 'Metro', $shult->textdomain )
						),
						'default' => 'default',
						'name' => __( 'Style', $shult->textdomain ), 'desc' => __( 'Select spoiler style preset', $shult->textdomain )
					)
				),
				'usage' => '[spoiler title="Spoiler title"] Hidden text [/spoiler]', 'content' => __( 'Hidden content', $shult->textdomain ), 'desc' => __( 'Spoiler with hidden content', $shult->textdomain )
			),
			# accordion
			'accordion' => array(
				'name' => __( 'Accordion', $shult->textdomain ),
				'type' => 'wrap',
				'group' => 'box',
				'atts' => array( ),
				'usage' => '[accordion]<br/>[spoiler open="yes"] content [/spoiler]<br/>[spoiler] content [/spoiler]<br/>[spoiler] content [/spoiler]<br/>[/accordion]',
				'content' => __( "[spoiler]Content[/spoiler]\n[spoiler]Content[/spoiler]\n[spoiler]Content[/spoiler]", $shult->textdomain ), 'desc' => __( 'Accordion with spoilers', $shult->textdomain )
			),
			# divider
			'divider' => array(
				'name' => __( 'Divider', $shult->textdomain ),
				'type' => 'single',
				'group' => 'content',
				'atts' => array(
					'style' => array(
						'type' => 'select',
						'values' => array(
							'default' => __( 'Default', $shult->textdomain ),
							'metro' => __( 'Metro', $shult->textdomain ),
							'light' => __( 'Light', $shult->textdomain )
						),
						'default' => 'default',
						'name' => __( 'Style', $shult->textdomain ), 'desc' => __( 'Select divider style preset', $shult->textdomain )
					),
					'top' => array(
						'type' => 'switch',
						'default' => 'yes',
						'name' => __( 'Show TOP link', $shult->textdomain ),
						'desc' => __( 'Show link to top of the page or not', $shult->textdomain )
					),
					'text' => array(
						'values' => array( ),
						'default' => __( 'Go to top', $shult->textdomain ),
						'name' => __( 'Link text', $shult->textdomain ), 'desc' => __( 'Text for the GO TOP link', $shult->textdomain )
					)
				),
				'usage' => '[divider top="yes" text="Go to top"]',
				'desc' => __( 'Content divider with optional TOP link', $shult->textdomain )
			),
			# spacer
			'spacer' => array(
				'name' => __( 'Spacer', $shult->textdomain ),
				'type' => 'single',
				'group' => 'content other',
				'atts' => array(
					'size' => array(
						'type' => 'number',
						'min' => 0,
						'max' => 10000,
						'step' => 5,
						'default' => 20,
						'name' => __( 'Height', $shult->textdomain ), 'desc' => __( 'Height of the spacer in pixels', $shult->textdomain )
					)
				),
				'usage' => '[spacer size="20"]',
				'desc' => __( 'Empty space with adjustable height', $shult->textdomain )
			),
			# highlight
			'highlight' => array(
				'name' => __( 'Highlight', $shult->textdomain ),
				'type' => 'wrap',
				'group' => 'content',
				'atts' => array(
					'background' => array(
						'type' => 'color',
						'values' => array( ),
						'default' => '#DDFF99',
						'name' => __( 'Background', $shult->textdomain ),
						'desc' => __( 'Highlighted text background color', $shult->textdomain )
					),
					'color' => array(
						'type' => 'color',
						'values' => array( ),
						'default' => '#000000',
						'name' => __( 'Text color', $shult->textdomain ), 'desc' => __( 'Highlighted text color', $shult->textdomain )
					)
				),
				'usage' => '[highlight background="#DDFF99" color="#000000"] Content [/highlight]', 'content' => __( 'Highlighted text', $shult->textdomain ),
				'desc' => __( 'Highlighted text', $shult->textdomain )
			),
			# label
			'label' => array(
				'name' => __( 'Label', $shult->textdomain ),
				'type' => 'wrap',
				'group' => 'content',
				'atts' => array(
					'type' => array(
						'type' => 'select',
						'values' => array(
							'default' => __( 'Default', $shult->textdomain ),
							'success' => __( 'Success', $shult->textdomain ),
							'warning' => __( 'Warning', $shult->textdomain ),
							'important' => __( 'Important', $shult->textdomain ),
							'black' => __( 'Black', $shult->textdomain ),
							'info' => __( 'Info', $shult->textdomain )
						),
						'default' => 'default',
						'name' => __( 'Type', $shult->textdomain ),
						'desc' => __( 'Style of the label', $shult->textdomain )
					)
				),
				'usage' => '[label type="info"] Information [/label]', 'content' => __( 'Label', $shult->textdomain ),
				'desc' => __( 'Styled label', $shult->textdomain )
			),
			# quote
			'quote' => array(
				'name' => __( 'Quote', $shult->textdomain ),
				'type' => 'wrap',
				'group' => 'box',
				'atts' => array(
					'style' => array(
						'type' => 'select',
						'values' => array(
							'default' => __( 'Default', $shult->textdomain ),
							'metro' => __( 'Metro', $shult->textdomain ),
							'simple' => __( 'Simple', $shult->textdomain )
						),
						'default' => 'default',
						'name' => __( 'Style', $shult->textdomain ),
						'desc' => __( 'Quote style preset', $shult->textdomain )
					),
					'cite' => array(
						'values' => array( ),
						'default' => '',
						'name' => __( 'Cite', $shult->textdomain ),
						'desc' => __( 'Quote author name', $shult->textdomain )
					),
					'url' => array(
						'values' => array( ),
						'default' => '',
						'name' => __( 'Cite url', $shult->textdomain ),
						'desc' => __( 'Url of the quote author. Leave empty to disable link', $shult->textdomain )
					)
				),
				'usage' => '[quote style="default"] Content [/quote]', 'content' => __( 'Quote', $shult->textdomain ),
				'desc' => __( 'Blockquote alternative', $shult->textdomain )
			),
			# pullquote
			'pullquote' => array(
				'name' => __( 'Pullquote', $shult->textdomain ),
				'type' => 'wrap',
				'group' => 'box',
				'atts' => array(
					'style' => array(
						'type' => 'select',
						'values' => array(
							'default' => __( 'Default', $shult->textdomain ),
							'metro' => __( 'Metro', $shult->textdomain ),
							'simple' => __( 'Simple', $shult->textdomain )
						),
						'default' => 'default',
						'name' => __( 'Style', $shult->textdomain ),
						'desc' => __( 'Choose style preset for pullquote', $shult->textdomain )
					),
					'align' => array(
						'type' => 'select',
						'values' => array(
							'left' => __( 'Left', $shult->textdomain ),
							'right' => __( 'Right', $shult->textdomain )
						),
						'default' => 'left',
						'name' => __( 'Align', $shult->textdomain ), 'desc' => __( 'Pullquote alignment (float)', $shult->textdomain )
					)
				),
				'usage' => '[pullquote align="left"] Content [/pullquote]', 'content' => __( 'Pullquote', $shult->textdomain ),
				'desc' => __( 'Pullquote', $shult->textdomain )
			),
			# dropcap
			'dropcap' => array(
				'name' => __( 'Dropcap', $shult->textdomain ),
				'type' => 'wrap',
				'group' => 'content',
				'atts' => array(
					'style' => array(
						'type' => 'select',
						'values' => array(
							'default' => __( 'Default', $shult->textdomain ),
							'metro' => __( 'Metro', $shult->textdomain ),
							'light' => __( 'Light', $shult->textdomain ),
							'simple' => __( 'Simple', $shult->textdomain )
						),
						'default' => 'default',
						'name' => __( 'Style', $shult->textdomain ), 'desc' => __( 'Dropcap style preset', $shult->textdomain )
					),
					'size' => array(
						'type' => 'select',
						'values' => array( 1, 2, 3, 4, 5 ), 'default' => 3,
						'name' => __( 'Size', $shult->textdomain ), 'desc' => __( 'Choose dropcap size', $shult->textdomain )
					)
				),
				'usage' => '[dropcap style="default"]D[/dropcap]ropcap', 'content' => __( 'D', $shult->textdomain ),
				'desc' => __( 'Dropcap', $shult->textdomain )
			),
			# row
			'row' => array(
				'name' => __( 'Row', $shult->textdomain ),
				'type' => 'wrap',
				'group' => 'box',
				'atts' => array(
					'style' => array(
						'type' => 'select',
						'values' => array(
							'default' => __( 'Default', $shult->textdomain ),
							'metro' => __( 'Metro', $shult->textdomain ), 'align-left' => __( 'Align to left', $shult->textdomain )
						),
						'default' => 'default',
						'name' => __( 'Style', $shult->textdomain ),
						'desc' => __( 'Style preset for the inner columns', $shult->textdomain )
					)
				),
				'usage' => '[row]<br/>[column size="1/2"] 50% [/column]<br/>[column size="1/4"] 25% [/column]<br/>[column size="1/4"] 25% [/column]<br/>[/row]',
				'content' => __( "[column size=\"1/3\"]Content[/column]\n[column size=\"1/3\"]Content[/column]\n[column size=\"1/3\"]Content[/column]", $shult->textdomain ), 'desc' => __( 'Row for flexible columns', $shult->textdomain )
			),
			# column
			'column' => array(
				'name' => __( 'Column', $shult->textdomain ),
				'type' => 'wrap',
				'group' => 'box',
				'atts' => array(
					'size' => array(
						'type' => 'select',
						'values' => array(
							'1/1' => __( 'Full width', $shult->textdomain ),
							'1/2' => __( 'One half', $shult->textdomain ),
							'1/3' => __( 'One third', $shult->textdomain ),
							'2/3' => __( 'Two third', $shult->textdomain ),
							'1/4' => __( 'One fourth', $shult->textdomain ),
							'3/4' => __( 'Three fourth', $shult->textdomain ),
							'1/5' => __( 'One fifth', $shult->textdomain ),
							'2/5' => __( 'Two fifth', $shult->textdomain ),
							'3/5' => __( 'Three fifth', $shult->textdomain ),
							'4/5' => __( 'Four fifth', $shult->textdomain ),
							'1/6' => __( 'One sixth', $shult->textdomain ),
							'5/6' => __( 'Five sixth', $shult->textdomain )
						),
						'default' => '1/2',
						'name' => __( 'Size', $shult->textdomain ),
						'desc' => __( 'Select column width. This width will be calculated depend page width', $shult->textdomain )
					)
				),
				'usage' => '[row]<br/>[column size="6"] 50% [/column]<br/>[column size="3"] 25% [/column]<br/>[column size="3"] 25% [/column]<br/>[/row]', 'content' => __( 'Column content', $shult->textdomain ), 'desc' => __( 'Flexible and responsive columns', $shult->textdomain )
			),
			# list
			'list' => array(
				'name' => __( 'List', $shult->textdomain ),
				'type' => 'wrap',
				'group' => 'content',
				'atts' => array(
					'style' => array(
						'type' => 'select',
						'values' => array(
							'star' => __( 'Star', $shult->textdomain ),
							'arrow' => __( 'Arrow', $shult->textdomain ),
							'check' => __( 'Check', $shult->textdomain ),
							'cross' => __( 'Cross', $shult->textdomain ),
							'thumbs' => __( 'Thumbs up', $shult->textdomain ),
							'link' => __( 'Link', $shult->textdomain ),
							'gear' => __( 'Gear', $shult->textdomain ),
							'time' => __( 'Time', $shult->textdomain ),
							'note' => __( 'Note', $shult->textdomain ),
							'plus' => __( 'Plus', $shult->textdomain ),
							'guard' => __( 'Guard', $shult->textdomain ),
							'event' => __( 'Event', $shult->textdomain ),
							'idea' => __( 'Idea', $shult->textdomain ),
							'settings' => __( 'Settings', $shult->textdomain ),
							'twitter' => __( 'Twitter', $shult->textdomain )
						),
						'default' => 'star',
						'name' => __( 'Style', $shult->textdomain ), 'desc' => __( 'List items style/icons', $shult->textdomain )
					)
				),
				'usage' => '[list style="check"] <ul> <li> List item </li> </ul> [/list]',
				'content' => __( "<ul>\n<li>List item</li>\n<li>List item</li>\n<li>List item</li>\n</ul>", $shult->textdomain ), 'desc' => __( 'Styled unordered list', $shult->textdomain )
			),
			# button
			'button' => array(
				'name' => __( 'Button', $shult->textdomain ),
				'type' => 'wrap',
				'group' => 'content',
				'atts' => array(
					'url' => array(
						'values' => array( ),
						'default' => get_option( 'home' ),
						'name' => __( 'Link', $shult->textdomain ),
						'desc' => __( 'Button link', $shult->textdomain )
					),
					'target' => array(
						'type' => 'select',
						'values' => array(
							'self' => __( 'Same tab', $shult->textdomain ),
							'blank' => __( 'New tab', $shult->textdomain )
						),
						'default' => 'self',
						'name' => __( 'Target', $shult->textdomain ),
						'desc' => __( 'Button link target', $shult->textdomain )
					),
					'style' => array(
						'type' => 'select',
						'values' => array(
							'default' => __( 'Default', $shult->textdomain ),
							'metro' => __( 'Metro', $shult->textdomain ),
							'soft' => __( 'Soft', $shult->textdomain ),
							'glass' => __( 'Glass', $shult->textdomain ),
							'bubbles' => __( 'Bubbles', $shult->textdomain ),
							'noise' => __( 'Noise', $shult->textdomain ),
							'stroked' => __( 'Stroked', $shult->textdomain ),
							'3d' => __( '3D', $shult->textdomain )
						),
						'default' => 'default',
						'name' => __( 'Style', $shult->textdomain ), 'desc' => __( 'Button background style preset', $shult->textdomain )
					),
					'background' => array(
						'type' => 'color',
						'values' => array( ),
						'default' => '#2D89EF',
						'name' => __( 'Background', $shult->textdomain ), 'desc' => __( 'Button background color', $shult->textdomain )
					),
					'color' => array(
						'type' => 'color',
						'values' => array( ),
						'default' => '#FFFFFF',
						'name' => __( 'Text color', $shult->textdomain ),
						'desc' => __( 'Button text color', $shult->textdomain )
					),
					'size' => array(
						'type' => 'select',
						'values' => array( 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12 ), 'default' => 3,
						'name' => __( 'Size', $shult->textdomain ),
						'desc' => __( 'Button size', $shult->textdomain )
					),
					'wide' => array(
						'type' => 'switch',
						'default' => 'no',
						'name' => __( 'Fluid', $shult->textdomain ), 'desc' => __( 'Fluid buttons has 100% width', $shult->textdomain )
					),
					'radius' => array(
						'type' => 'select',
						'values' => array( 'auto', 'round', '0', '5', '10', '20' ),
						'default' => 'auto',
						'name' => __( 'Radius', $shult->textdomain ),
						'desc' => __( 'Radius of button corners. Auto-radius calculation based on button size', $shult->textdomain )
					),
					'icon' => array(
						'type' => 'upload',
						'default' => '',
						'name' => __( 'Icon', $shult->textdomain ),
						'desc' => __( 'You can upload custom icon for this button. Try to begin with <a href="http://webdesign.tutsplus.com/freebies/icons-freebies/exclusive-freebie-50-crisp-web-app-icons/" target="_blank">these free high-quality icons</a>. Download archive, unpack icons and upload in this field', $shult->textdomain )
					),
					'ts_color' => array(
						'type' => 'select',
						'values' => array(
							'light' => __( 'Light', $shult->textdomain ),
							'dark' => __( 'Dark', $shult->textdomain )
						),
						'default' => 'dark',
						'name' => __( 'Text shadow color', $shult->textdomain ), 'desc' => __( 'Color of button text shadow', $shult->textdomain )
					),
					'ts_pos' => array(
						'type' => 'select',
						'values' => array(
							'none' => __( 'None', $shult->textdomain ),
							'top' => __( 'Top', $shult->textdomain ),
							'right' => __( 'Right', $shult->textdomain ),
							'bottom' => __( 'Bottom', $shult->textdomain ),
							'left' => __( 'Left', $shult->textdomain ),
							'top-right' => __( 'Top right', $shult->textdomain ),
							'top-left' => __( 'Top left', $shult->textdomain ), 'bottom-right' => __( 'Bottom right', $shult->textdomain ), 'bottom-left' => __( 'Bottom left', $shult->textdomain )
						),
						'default' => 'top-left', 'name' => __( 'Text shadow position', $shult->textdomain ), 'desc' => __( 'Position of button text shadow', $shult->textdomain )
					),
					'class' => array(
						'values' => array( ),
						'default' => '',
						'name' => __( 'CSS class', $shult->textdomain ), 'desc' => __( 'Extra CSS class for button', $shult->textdomain )
					)
				),
				'usage' => '[button url="#" background="#b00" size="3" style="default"] Button text [/button]', 'content' => __( 'Button text', $shult->textdomain ),
				'desc' => __( 'Styled button', $shult->textdomain )
			),
			# service
			'service' => array(
				'name' => __( 'Service', $shult->textdomain ),
				'type' => 'wrap',
				'group' => 'box',
				'atts' => array(
					'title' => array(
						'values' => array( ),
						'default' => __( 'Service title', $shult->textdomain ),
						'name' => __( 'Title', $shult->textdomain ),
						'desc' => __( 'Service name', $shult->textdomain )
					),
					'icon' => array(
						'type' => 'upload',
						'default' => '',
						'name' => __( 'Icon', $shult->textdomain ),
						'desc' => __( 'You can upload custom icon for this box', $shult->textdomain )
					),
					'size' => array(
						'type' => 'select',
						'values' => array( 16, 24, 32, 48 ),
						'default' => 32,
						'name' => __( 'Icon size', $shult->textdomain ),
						'desc' => __( 'Size of the uploaded icon in pixels', $shult->textdomain )
					)
				),
				'usage' => '[service title="Service title" icon="service.png" size="32"] Service description [/service]', 'content' => __( 'Service description', $shult->textdomain ), 'desc' => __( 'Service box with title', $shult->textdomain )
			),
			# box
			'box' => array(
				'name' => __( 'Box', $shult->textdomain ),
				'type' => 'wrap',
				'group' => 'box',
				'atts' => array(
					'title' => array(
						'values' => array( ),
						'default' => __( 'Box title', $shult->textdomain ),
						'name' => __( 'Title', $shult->textdomain ), 'desc' => __( 'Text for the box title', $shult->textdomain )
					),
					'style' => array(
						'type' => 'select',
						'values' => array(
							'default' => __( 'Default', $shult->textdomain ),
							'soft' => __( 'Soft', $shult->textdomain ),
							'glass' => __( 'Glass', $shult->textdomain ),
							'bubbles' => __( 'Bubbles', $shult->textdomain ),
							'noise' => __( 'Noise', $shult->textdomain )
						),
						'default' => 'default',
						'name' => __( 'Style', $shult->textdomain ),
						'desc' => __( 'Box style preset', $shult->textdomain )
					),
					'box_color' => array(
						'type' => 'color',
						'values' => array( ),
						'default' => '#333333',
						'name' => __( 'Color', $shult->textdomain ),
						'desc' => __( 'Color for the box title and borders', $shult->textdomain )
					),
					'title_color' => array(
						'type' => 'color',
						'values' => array( ),
						'default' => '#FFFFFF',
						'name' => __( 'Title text color', $shult->textdomain ), 'desc' => __( 'Color for the box title text', $shult->textdomain )
					),
					'radius' => array(
						'type' => 'select',
						'values' => array( '0', '3', '5', '10', '20' ),
						'default' => '3',
						'name' => __( 'Radius', $shult->textdomain ),
						'desc' => __( 'Box corners radius', $shult->textdomain )
					)
				),
				'usage' => '[box title="Box title"] Content [/box]', 'content' => __( 'Box content', $shult->textdomain ), 'desc' => __( 'Colored box with caption', $shult->textdomain )
			),
			# note
			'note' => array(
				'name' => __( 'Note', $shult->textdomain ),
				'type' => 'wrap',
				'group' => 'box',
				'atts' => array(
					'background' => array(
						'type' => 'color',
						'values' => array( ),
						'default' => '#FFFF66',
						'name' => __( 'Background', $shult->textdomain ), 'desc' => __( 'Note background color', $shult->textdomain )
					),
					'color' => array(
						'type' => 'color',
						'values' => array( ),
						'default' => '#333333',
						'name' => __( 'Text color', $shult->textdomain ),
						'desc' => __( 'Note text color', $shult->textdomain )
					),
					'radius' => array(
						'type' => 'select',
						'values' => array( '0', '3', '5', '10', '20' ),
						'default' => '3',
						'name' => __( 'Radius', $shult->textdomain ), 'desc' => __( 'Note corners radius', $shult->textdomain )
					)
				),
				'usage' => '[note background="#FFCC00"] Content [/note]', 'content' => __( 'Note text', $shult->textdomain ),
				'desc' => __( 'Colored box', $shult->textdomain )
			),
			# private
			'private' => array(
				'name' => __( 'Private', $shult->textdomain ),
				'type' => 'wrap',
				'group' => 'other',
				'atts' => array( ),
				'usage' => '[private] Private content [/private]', 'content' => __( 'Private note text', $shult->textdomain ), 'desc' => __( 'Private note for post authors', $shult->textdomain )
			),
			# youtube
			'youtube' => array(
				'name' => __( 'YouTube' ),
				'type' => 'single',
				'group' => 'media',
				'atts' => array(
					'url' => array(
						'values' => array( ),
						'default' => '',
						'name' => __( 'Url', $shult->textdomain ),
						'desc' => __( 'Url of YouTube page with video. Ex: http://youtube.com/watch?v=XXXXXX', $shult->textdomain )
					),
					'width' => array(
						'type' => 'number',
						'min' => 0,
						'max' => 10000,
						'step' => 20,
						'default' => 600,
						'name' => __( 'Width', $shult->textdomain ),
						'desc' => __( 'Player width', $shult->textdomain )
					),
					'height' => array(
						'type' => 'number',
						'min' => 0,
						'max' => 10000,
						'step' => 20,
						'default' => 300,
						'name' => __( 'Height', $shult->textdomain ),
						'desc' => __( 'Player height', $shult->textdomain )
					),
					'autoplay' => array(
						'type' => 'switch',
						'default' => 'no',
						'name' => __( 'Autoplay', $shult->textdomain ),
						'desc' => __( 'Play video automatically when page is loaded', $shult->textdomain )
					)
				),
				'usage' => '[youtube url="http://www.youtube.com/watch?v=NbE8INOjTKM"]', 'desc' => __( 'YouTube video', $shult->textdomain )
			),
			# vimeo
			'vimeo' => array(
				'name' => __( 'Vimeo' ),
				'type' => 'single',
				'group' => 'media',
				'atts' => array(
					'url' => array(
						'values' => array( ),
						'default' => '',
						'name' => __( 'Url', $shult->textdomain ), 'desc' => __( 'Url of Vimeo page with video', $shult->textdomain )
					),
					'width' => array(
						'type' => 'number',
						'min' => 0,
						'max' => 10000,
						'step' => 20,
						'default' => 600,
						'name' => __( 'Width', $shult->textdomain ),
						'desc' => __( 'Player width', $shult->textdomain )
					),
					'height' => array(
						'type' => 'number',
						'min' => 0,
						'max' => 10000,
						'step' => 20,
						'default' => 300,
						'name' => __( 'Height', $shult->textdomain ),
						'desc' => __( 'Player height', $shult->textdomain )
					),
					'autoplay' => array(
						'type' => 'switch',
						'default' => 'no',
						'name' => __( 'Autoplay', $shult->textdomain ),
						'desc' => __( 'Play video automatically when page is loaded', $shult->textdomain )
					)
				),
				'usage' => '[vimeo url="http://vimeo.com/21294655"]', 'desc' => __( 'Vimeo video', $shult->textdomain )
			),
			# audio
			'audio' => array(
				'name' => __( 'Audio', $shult->textdomain ),
				'type' => 'single',
				'group' => 'media',
				'atts' => array(
					'url' => array(
						'type' => 'upload',
						'default' => '',
						'name' => __( 'File', $shult->textdomain ),
						'desc' => __( 'Audio file url. Supported formats: mp3, ogg', $shult->textdomain )
					),
					'style' => array(
						'type' => 'select',
						'values' => array(
							'default' => __( 'Default', $shult->textdomain ),
							'metro' => __( 'Metro', $shult->textdomain ),
							'button' => __( 'Button', $shult->textdomain ),
							'hidden' => __( 'Hidden', $shult->textdomain )
						),
						'default' => 'default',
						'name' => __( 'Style', $shult->textdomain ),
						'desc' => __( 'Player style preset', $shult->textdomain )
					),
					'width' => array(
						'type' => 'select',
						'values' => array( 'auto', '200px', '50%' ),
						'default' => 'auto',
						'name' => __( 'Width', $shult->textdomain ),
						'desc' => __( 'Player width. You can specify width in percents and player will be responsive', $shult->textdomain )
					),
					'autoplay' => array(
						'type' => 'switch',
						'default' => 'no',
						'name' => __( 'Autoplay', $shult->textdomain ),
						'desc' => __( 'Play file automatically when page is loaded', $shult->textdomain )
					),
					'loop' => array(
						'type' => 'switch',
						'default' => 'no',
						'name' => __( 'Loop', $shult->textdomain ),
						'desc' => __( 'Repeat when playback is ended', $shult->textdomain )
					)
				),
				'usage' => '[audio url="http://example.com/audio.mp3"]',
				'desc' => __( 'Custom audio player', $shult->textdomain )
			),
			# video
			'video' => array(
				'name' => __( 'Video', $shult->textdomain ),
				'type' => 'single',
				'group' => 'media',
				'atts' => array(
					'url' => array(
						'type' => 'upload',
						'default' => '',
						'name' => __( 'File', $shult->textdomain ),
						'desc' => __( 'Url to mp4/flv video-file', $shult->textdomain )
					),
					'poster' => array(
						'type' => 'upload',
						'default' => '',
						'name' => __( 'Poster', $shult->textdomain ),
						'desc' => __( 'Url to poster image, that will be shown before playback', $shult->textdomain )
					),
					'title' => array(
						'values' => array( ),
						'default' => '',
						'name' => __( 'Title', $shult->textdomain ),
						'desc' => __( 'Player title', $shult->textdomain )
					),
					'style' => array(
						'type' => 'select',
						'values' => array(
							'default' => __( 'Default', $shult->textdomain ),
							'metro' => __( 'Metro', $shult->textdomain ),
							'minimal' => __( 'Minimal', $shult->textdomain )
						),
						'default' => 'default',
						'name' => __( 'Style', $shult->textdomain ),
						'desc' => __( 'Player style preset', $shult->textdomain )
					),
					'width' => array(
						'type' => 'number',
						'min' => 0,
						'max' => 10000,
						'step' => 20,
						'default' => 600,
						'name' => __( 'Width', $shult->textdomain ),
						'desc' => __( 'Player width', $shult->textdomain )
					),
					'height' => array(
						'type' => 'number',
						'min' => 0,
						'max' => 10000,
						'step' => 20,
						'default' => 300,
						'name' => __( 'Height', $shult->textdomain ),
						'desc' => __( 'Player height', $shult->textdomain )
					),
					'controls' => array(
						'type' => 'switch',
						'default' => 'yes',
						'name' => __( 'Controls', $shult->textdomain ),
						'desc' => __( 'Show player controls (play/pause etc.) or not', $shult->textdomain )
					),
					'autoplay' => array(
						'type' => 'switch',
						'default' => 'no',
						'name' => __( 'Autoplay', $shult->textdomain ),
						'desc' => __( 'Play file automatically when page is loaded', $shult->textdomain )
					),
					'loop' => array(
						'type' => 'switch',
						'default' => 'no',
						'name' => __( 'Loop', $shult->textdomain ),
						'desc' => __( 'Repeat when playback is ended', $shult->textdomain )
					)
				),
				'usage' => '[video url="http://example.com/video.mp4"]',
				'desc' => __( 'Custom video player', $shult->textdomain )
			),
			# table
			'table' => array(
				'name' => __( 'Table', $shult->textdomain ),
				'type' => 'mixed',
				'group' => 'content',
				'atts' => array(
					'style' => array(
						'type' => 'select',
						'values' => array(
							'default' => __( 'Default', $shult->textdomain ),
							'metro' => __( 'Metro', $shult->textdomain ),
							'minimal' => __( 'Minimal', $shult->textdomain )
						),
						'default' => 'default',
						'name' => __( 'Style', $shult->textdomain ),
						'desc' => __( 'Table style preset', $shult->textdomain )
					),
					'url' => array(
						'type' => 'upload',
						'default' => '',
						'name' => __( 'CSV file', $shult->textdomain ),
						'desc' => __( 'Upload CSV file if you want to create HTML-table from file', $shult->textdomain )
					)
				),
				'usage' => '[table style="default"] <table> ... </table> [/table]<br/>[table style="default" url="http://example.com/file.csv"] [/table]',
				'content' => __( "<table>\n<tr>\n\t<td>Table</td>\n\t<td>Table</td>\n</tr>\n<tr>\n\t<td>Table</td>\n\t<td>Table</td>\n</tr>\n</table>", $shult->textdomain ),
				'desc' => __( 'Styled table from HTML or CSV file', $shult->textdomain )
			),
			# permalink
			'permalink' => array(
				'name' => __( 'Permalink', $shult->textdomain ),
				'type' => 'mixed',
				'group' => 'content other',
				'atts' => array(
					'id' => array(
						'values' => array( ), 'default' => 1,
						'name' => __( 'ID', $shult->textdomain ),
						'desc' => __( 'Post or page ID', $shult->textdomain )
					),
					'target' => array(
						'type' => 'select',
						'values' => array(
							'self' => __( 'Same tab', $shult->textdomain ),
							'blank' => __( 'New tab', $shult->textdomain )
						),
						'default' => 'self',
						'name' => __( 'Target', $shult->textdomain ),
						'desc' => __( 'Link target. blank - link will be opened in new window/tab', $shult->textdomain )
					),
				),
				'usage' => '[permalink id=52]<br/>[permalink id="52" target="blank"] Content [/permalink]',
				'content' => '', 'desc' => __( 'Permalink to specified post/page', $shult->textdomain )
			),
			# members
			'members' => array(
				'name' => __( 'Members', $shult->textdomain ),
				'type' => 'wrap',
				'group' => 'other',
				'atts' => array(
					'style' => array(
						'type' => 'select',
						'values' => array(
							'default' => __( 'Default', $shult->textdomain ),
							'metro' => __( 'Metro', $shult->textdomain ),
							'simple' => __( 'Simple', $shult->textdomain )
						),
						'default' => 'default',
						'name' => __( 'Style', $shult->textdomain ),
						'desc' => __( 'Box style preset. This box will be shown for not logged users only', $shult->textdomain )
					),
					'message' => array(
						'values' => array( ),
						'default' => __( 'This content is for registered users only. Please %login%.', $shult->textdomain ),
						'name' => __( 'Message', $shult->textdomain ), 'desc' => __( 'Message for not logged users', $shult->textdomain )
					),
					'login' => array(
						'values' => array( ),
						'default' => __( 'login', $shult->textdomain ),
						'name' => __( 'Login link text', $shult->textdomain ), 'desc' => __( 'Text for the login link', $shult->textdomain )
					)
				),
				'usage' => '[members style="default"] Content for logged members [/members]', 'content' => __( 'Content for logged members', $shult->textdomain ),
				'desc' => __( 'Content for logged in members only', $shult->textdomain )
			),
			# guests
			'guests' => array(
				'name' => __( 'Guests', $shult->textdomain ),
				'type' => 'wrap',
				'group' => 'other',
				'atts' => array( ),
				'usage' => '[guests] Content for guests [/guests]', 'content' => __( 'Content for guests', $shult->textdomain ), 'desc' => __( 'Content for guests only', $shult->textdomain )
			),
			# feed
			'feed' => array(
				'name' => __( 'RSS Feed', $shult->textdomain ),
				'type' => 'single',
				'group' => 'content other',
				'atts' => array(
					'url' => array(
						'values' => array( ),
						'default' => '',
						'name' => __( 'Url', $shult->textdomain ),
						'desc' => __( 'Url to RSS-feed', $shult->textdomain )
					),
					'limit' => array(
						'type' => 'select',
						'values' => array( 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ), 'default' => 3,
						'name' => __( 'Limit', $shult->textdomain ), 'desc' => __( 'Number of items to show', $shult->textdomain )
					)
				),
				'usage' => '[feed url="http://rss1.smashingmagazine.com/feed/" limit="5"]', 'desc' => __( 'Feed grabber', $shult->textdomain )
			),
			# menu
			'menu' => array(
				'name' => __( 'Menu', $shult->textdomain ),
				'type' => 'single',
				'group' => 'other',
				'atts' => array(
					'name' => array(
						'values' => array( ),
						'default' => '',
						'name' => __( 'Menu name', $shult->textdomain ), 'desc' => __( 'Custom menu name. Ex: Main menu', $shult->textdomain )
					)
				),
				'usage' => '[menu name="Main menu"]', 'desc' => __( 'Custom menu by name', $shult->textdomain )
			),
			# subpages
			'subpages' => array(
				'name' => __( 'Sub pages', $shult->textdomain ),
				'type' => 'single',
				'group' => 'other',
				'atts' => array(
					'depth' => array(
						'type' => 'select',
						'values' => array( 1, 2, 3 ), 'default' => 1,
						'name' => __( 'Depth', $shult->textdomain ),
						'desc' => __( 'Max depth level of children pages', $shult->textdomain )
					),
					'id' => array(
						'values' => array( ),
						'default' => '',
						'name' => __( 'Parent ID', $shult->textdomain ),
						'desc' => __( 'ID of the parent page. Leave blank to use current page', $shult->textdomain )
					)
				),
				'usage' => '[subpages]<br/>[subpages depth="2" p="122"]', 'desc' => __( 'List of sub pages', $shult->textdomain )
			),
			# siblings
			'siblings' => array(
				'name' => __( 'Siblings', $shult->textdomain ),
				'type' => 'single',
				'group' => 'other',
				'atts' => array(
					'depth' => array(
						'type' => 'select',
						'values' => array( 1, 2, 3 ), 'default' => 1,
						'name' => __( 'Depth', $shult->textdomain ),
						'desc' => __( 'Max depth level', $shult->textdomain )
					)
				),
				'usage' => '[siblings]<br/>[siblings depth="2"]', 'desc' => __( 'List of cureent page siblings', $shult->textdomain )
			),
			# document
			'document' => array(
				'name' => __( 'Document', $shult->textdomain ),
				'type' => 'single',
				'group' => 'media',
				'atts' => array(
					'url' => array(
						'type' => 'upload',
						'default' => '',
						'name' => __( 'Url', $shult->textdomain ),
						'desc' => __( 'Url to uploaded document. Supported formats: doc, xls, pdf etc.', $shult->textdomain )
					),
					'width' => array(
						'type' => 'number',
						'min' => 0,
						'max' => 10000,
						'step' => 20,
						'default' => 600,
						'name' => __( 'Width', $shult->textdomain ),
						'desc' => __( 'Viewer width', $shult->textdomain )
					),
					'height' => array(
						'type' => 'number',
						'min' => 0,
						'max' => 10000,
						'step' => 20,
						'default' => 600,
						'name' => __( 'Height', $shult->textdomain ),
						'desc' => __( 'Viewer height', $shult->textdomain )
					)
				),
				'usage' => '[document url="file.doc" width="600" height="400"]', 'desc' => __( 'Document viewer by Google', $shult->textdomain )
			),
			# gmap
			'gmap' => array(
				'name' => __( 'Gmap', $shult->textdomain ),
				'type' => 'single',
				'group' => 'media',
				'atts' => array(
					'width' => array(
						'type' => 'number',
						'min' => 0,
						'max' => 10000,
						'step' => 20,
						'default' => 600,
						'name' => __( 'Width', $shult->textdomain ),
						'desc' => __( 'Map width', $shult->textdomain )
					),
					'height' => array(
						'type' => 'number',
						'min' => 0,
						'max' => 10000,
						'step' => 20,
						'default' => 400,
						'name' => __( 'Height', $shult->textdomain ),
						'desc' => __( 'Map height', $shult->textdomain )
					),
					'address' => array(
						'values' => array( ),
						'default' => '',
						'name' => __( 'Marker', $shult->textdomain ),
						'desc' => __( 'Address for the marker. You can type it in any language', $shult->textdomain )
					),
				),
				'usage' => '[gmap width="600" height="400" address="New York"]', 'desc' => __( 'Maps by Google', $shult->textdomain )
			),
			# slider
			'slider' => array(
				'name' => __( 'Slider', $shult->textdomain ),
				'type' => 'single',
				'group' => 'media',
				'atts' => array(
					'gallery' => array(
						'type' => 'gallery',
						'name' => __( 'Gallery', $shult->textdomain ),
						'desc' => __( 'Choose source gallery, that will be used for this slider', $shult->textdomain )
					),
					'width' => array(
						'type' => 'number',
						'min' => 0,
						'max' => 10000,
						'step' => 20,
						'default' => 600,
						'name' => __( 'Width', $shult->textdomain ), 'desc' => __( 'Slider width (in pixels)', $shult->textdomain )
					),
					'height' => array(
						'type' => 'number',
						'min' => 0,
						'max' => 10000,
						'step' => 20,
						'default' => 300,
						'name' => __( 'Height', $shult->textdomain ), 'desc' => __( 'Slider height (in pixels)', $shult->textdomain )
					),
					'title' => array(
						'type' => 'switch',
						'default' => 'yes',
						'name' => __( 'Show titles', $shult->textdomain ), 'desc' => __( 'Display slide titles', $shult->textdomain )
					),
					'centered' => array(
						'type' => 'switch',
						'default' => 'yes',
						'name' => __( 'Center', $shult->textdomain ), 'desc' => __( 'Is slider centered on the page', $shult->textdomain )
					),
					'arrows' => array(
						'type' => 'switch',
						'default' => 'yes',
						'name' => __( 'Arrows', $shult->textdomain ), 'desc' => __( 'Show left and right arrows', $shult->textdomain )
					),
					'pages' => array(
						'type' => 'switch',
						'default' => 'yes',
						'name' => __( 'Pagination', $shult->textdomain ),
						'desc' => __( 'Show pagination', $shult->textdomain )
					),
					'mousewheel' => array(
						'type' => 'switch',
						'default' => 'yes', 'name' => __( 'Mouse wheel control', $shult->textdomain ),
						'desc' => __( 'Allow to change slides with mouse wheel', $shult->textdomain )
					),
					'autoplay' => array(
						'type' => 'number',
						'min' => 0,
						'max' => 100000,
						'step' => 100,
						'default' => 5000,
						'name' => __( 'Autoplay', $shult->textdomain ),
						'desc' => __( 'Choose interval between slide animations. Set to 0 to disable autoplay', $shult->textdomain )
					),
					'speed' => array(
						'type' => 'number',
						'min' => 0,
						'max' => 20000,
						'step' => 100,
						'default' => 600,
						'name' => __( 'Speed', $shult->textdomain ), 'desc' => __( 'Specify animation speed', $shult->textdomain )
					),
					'target' => array(
						'type' => 'switch',
						'default' => 'yes',
						'name' => __( 'Links target', $shult->textdomain ),
						'desc' => __( 'Open slides links in new window/tab', $shult->textdomain )
					)
				),
				'usage' => '[slider gallery="1"]', 'desc' => __( 'Customizable image slider', $shult->textdomain )
			),
			# carousel
			'carousel' => array(
				'name' => __( 'Carousel', $shult->textdomain ),
				'type' => 'single',
				'group' => 'media',
				'atts' => array(
					'gallery' => array(
						'type' => 'gallery',
						'name' => __( 'Gallery', $shult->textdomain ),
						'desc' => __( 'Choose source gallery, that will be used for this carousel', $shult->textdomain )
					),
					'width' => array(
						'type' => 'number',
						'min' => 0,
						'max' => 10000,
						'step' => 20,
						'default' => 600,
						'name' => __( 'Width', $shult->textdomain ), 'desc' => __( 'Carousel width (in pixels)', $shult->textdomain )
					),
					'height' => array(
						'type' => 'number',
						'min' => 0,
						'max' => 10000,
						'step' => 20,
						'default' => 100,
						'name' => __( 'Height', $shult->textdomain ), 'desc' => __( 'Carousel height (in pixels)', $shult->textdomain )
					),
					'items' => array(
						'type' => 'number',
						'min' => 1,
						'max' => 20,
						'step' => 1, 'default' => 3,
						'name' => __( 'Items to show', $shult->textdomain ),
						'desc' => __( 'How much carousel items is visible', $shult->textdomain )
					),
					'scroll' => array(
						'type' => 'number',
						'min' => 1,
						'max' => 20,
						'step' => 1, 'default' => 1,
						'name' => __( 'Scroll number', $shult->textdomain ),
						'desc' => __( 'How much items are scrolled in one transition', $shult->textdomain )
					),
					'title' => array(
						'type' => 'switch',
						'default' => 'yes',
						'name' => __( 'Show titles', $shult->textdomain ), 'desc' => __( 'Display titles for each item', $shult->textdomain )
					),
					'centered' => array(
						'type' => 'switch',
						'default' => 'yes',
						'name' => __( 'Center', $shult->textdomain ), 'desc' => __( 'Is carousel centered on the page', $shult->textdomain )
					),
					'arrows' => array(
						'type' => 'switch',
						'default' => 'yes',
						'name' => __( 'Arrows', $shult->textdomain ), 'desc' => __( 'Show left and right arrows', $shult->textdomain )
					),
					'pages' => array(
						'type' => 'switch',
						'default' => 'no',
						'name' => __( 'Pagination', $shult->textdomain ),
						'desc' => __( 'Show pagination', $shult->textdomain )
					),
					'mousewheel' => array(
						'type' => 'switch',
						'default' => 'yes', 'name' => __( 'Mouse wheel control', $shult->textdomain ),
						'desc' => __( 'Allow to rotate carousel with mouse wheel', $shult->textdomain )
					),
					'autoplay' => array(
						'type' => 'number',
						'min' => 0,
						'max' => 100000,
						'step' => 100,
						'default' => 5000,
						'name' => __( 'Autoplay', $shult->textdomain ),
						'desc' => __( 'Choose interval between auto animations. Set to 0 to disable autoplay', $shult->textdomain )
					),
					'speed' => array(
						'type' => 'number',
						'min' => 0,
						'max' => 20000,
						'step' => 100,
						'default' => 600,
						'name' => __( 'Speed', $shult->textdomain ), 'desc' => __( 'Specify animation speed', $shult->textdomain )
					),
					'target' => array(
						'type' => 'switch',
						'default' => 'yes',
						'name' => __( 'Links target', $shult->textdomain ),
						'desc' => __( 'Open carousel links in new window/tab', $shult->textdomain )
					)
				),
				'usage' => '[carousel gallery="1"]', 'desc' => __( 'Customizable image carousel', $shult->textdomain )
			),
			# custom_gallery
			'custom_gallery' => array(
				'name' => __( 'Gallery', $shult->textdomain ),
				'type' => 'single',
				'group' => 'media',
				'atts' => array(
					'gallery' => array(
						'type' => 'gallery',
						'name' => __( 'Gallery', $shult->textdomain ),
						'desc' => __( 'Choose source gallery, that will be used for this shortcode', $shult->textdomain )
					),
					'width' => array(
						'type' => 'number',
						'min' => 20,
						'max' => 2000,
						'step' => 20,
						'default' => 186,
						'name' => __( 'Width', $shult->textdomain ), 'desc' => __( 'Single item width (in pixels)', $shult->textdomain )
					),
					'height' => array(
						'type' => 'number',
						'min' => 20,
						'max' => 2000,
						'step' => 20,
						'default' => 120,
						'name' => __( 'Height', $shult->textdomain ), 'desc' => __( 'Single item height (in pixels)', $shult->textdomain )
					),
					'title' => array(
						'type' => 'select',
						'values' => array(
							'never' => __( 'Never', $shult->textdomain ),
							'hover' => __( 'On mouse over', $shult->textdomain ),
							'always' => __( 'Always', $shult->textdomain )
						),
						'default' => 'hover',
						'name' => __( 'Show titles', $shult->textdomain ),
						'desc' => __( 'Title display mode', $shult->textdomain )
					),
					'target' => array(
						'type' => 'switch',
						'default' => 'yes',
						'name' => __( 'Links target', $shult->textdomain ), 'desc' => __( 'Open links in new window/tab', $shult->textdomain )
					)
				),
				'usage' => '[custom_gallery gallery="1"]', 'desc' => __( 'Customizable image gallery', $shult->textdomain )
			),
			# posts
			'posts' => array(
				'name' => __( 'Posts', $shult->textdomain ),
				'type' => 'single',
				'group' => 'other',
				'atts' => array(
					'template' => array(
						'default' => 'templates/default-loop.php', 'name' => __( 'Template', $shult->textdomain ),
						'desc' => __( '<b>Do not change this field value if you do not understand description below.</b><br/>Relative path to the template file. Default templates is placed under the plugin directory (templates folder). You can copy it under your theme directory and modify as you want. You can use following default templates that already available in the plugin directory:<br/><b%value>templates/default-loop.php</b> - posts loop<br/><b%value>templates/teaser-loop.php</b> - posts loop with thumbnail and title<br/><b%value>templates/single-post.php</b> - single post template<br/><b%value>templates/list-loop.php</b> - unordered list with posts titles', $shult->textdomain )
					),
					'id' => array(
						'default' => '',
						'name' => __( 'Post ID\'s', $shult->textdomain ),
						'desc' => __( 'Enter comma separated ID\'s of the posts that you want to show', $shult->textdomain )
					),
					'posts_per_page' => array(
						'type' => 'number',
						'min' => -1,
						'max' => 10000,
						'step' => 1,
						'default' => get_option( 'posts_per_page' ),
						'name' => __( 'Posts per page', $shult->textdomain ),
						'desc' => __( 'Specify number of posts that you want to show. Enter -1 to get all posts', $shult->textdomain )
					),
					'post_type' => array(
						'type' => 'select',
						'multiple' => true,
						'values' => su_get_post_types(),
						'default' => 'default',
						'name' => __( 'Post types', $shult->textdomain ),
						'desc' => __( 'Select post types. Hold Ctrl key to select multiple post types', $shult->textdomain )
					),
					'taxonomy' => array(
						'type' => 'select',
						'values' => su_get_taxonomies(),
						'default' => '',
						'name' => __( 'Taxonomy', $shult->textdomain ),
						'desc' => __( 'Select taxonomy to show posts from', $shult->textdomain )
					),
					'tax_term' => array(
						'type' => 'select',
						'multiple' => true,
						'values' => su_get_terms( su_get_taxonomies( true ) ),
						'default' => '',
						'name' => __( 'Terms', $shult->textdomain ), 'desc' => __( 'Select terms to show posts from', $shult->textdomain )
					),
					'tax_operator' => array(
						'type' => 'select',
						'values' => array( 'IN', 'NOT IN', 'AND' ),
						'default' => 'IN', 'name' => __( 'Taxonomy term operator', $shult->textdomain ),
						'desc' => __( 'IN - posts that have any of selected categories terms<br/>NOT IN - posts that is does not have any of selected terms<br/>AND - posts that have all selected terms', $shult->textdomain )
					),
					'author' => array(
						'type' => 'select',
						'multiple' => true,
						'values' => su_get_users(),
						'default' => 'default',
						'name' => __( 'Authors', $shult->textdomain ),
						'desc' => __( 'Choose the authors whose posts you want to show', $shult->textdomain )
					),
					'meta_key' => array(
						'default' => '',
						'name' => __( 'Meta key', $shult->textdomain ),
						'desc' => __( 'Enter meta key name to show posts that have this key', $shult->textdomain )
					),
					'offset' => array(
						'type' => 'number',
						'min' => 0,
						'max' => 10000,
						'step' => 1, 'default' => 0,
						'name' => __( 'Offset', $shult->textdomain ),
						'desc' => __( 'Specify offset to start posts loop not from first post', $shult->textdomain )
					),
					'order' => array(
						'type' => 'select',
						'values' => array(
							'desc' => __( 'Descending', $shult->textdomain ),
							'asc' => __( 'Ascending', $shult->textdomain )
						),
						'default' => 'DESC',
						'name' => __( 'Order', $shult->textdomain ),
						'desc' => __( 'Posts order', $shult->textdomain )
					),
					'orderby' => array(
						'type' => 'select',
						'values' => array(
							'none' => __( 'None', $shult->textdomain ),
							'id' => __( 'Post ID', $shult->textdomain ),
							'author' => __( 'Post author', $shult->textdomain ),
							'title' => __( 'Post title', $shult->textdomain ),
							'name' => __( 'Post slug', $shult->textdomain ),
							'date' => __( 'Date', $shult->textdomain ), 'modified' => __( 'Last modified date', $shult->textdomain ),
							'parent' => __( 'Post parent', $shult->textdomain ),
							'rand' => __( 'Random', $shult->textdomain ), 'comment_count' => __( 'Comments number', $shult->textdomain ),
							'menu_order' => __( 'Menu order', $shult->textdomain ), 'meta_value' => __( 'Meta key values', $shult->textdomain ),
						),
						'default' => 'date',
						'name' => __( 'Order by', $shult->textdomain ),
						'desc' => __( 'Order posts by', $shult->textdomain )
					),
					'post_parent' => array(
						'default' => '',
						'name' => __( 'Post parent', $shult->textdomain ),
						'desc' => __( 'Show childrens of entered post (enter post ID)', $shult->textdomain )
					),
					'post_status' => array(
						'type' => 'select',
						'values' => array(
							'publish' => __( 'Published', $shult->textdomain ),
							'pending' => __( 'Pending', $shult->textdomain ),
							'draft' => __( 'Draft', $shult->textdomain ),
							'auto-draft' => __( 'Auto-draft', $shult->textdomain ),
							'future' => __( 'Future post', $shult->textdomain ),
							'private' => __( 'Private post', $shult->textdomain ),
							'inherit' => __( 'Inherit', $shult->textdomain ),
							'trash' => __( 'Trashed', $shult->textdomain ),
							'any' => __( 'Any', $shult->textdomain ),
						),
						'default' => 'publish',
						'name' => __( 'Post status', $shult->textdomain ),
						'desc' => __( 'Show only posts with selected status', $shult->textdomain )
					),
					'ignore_sticky_posts' => array(
						'type' => 'switch',
						'default' => 'no',
						'name' => __( 'Ignore sticky', $shult->textdomain ),
						'desc' => __( 'Select Yes to ignore posts that is sticked', $shult->textdomain )
					),
				),
				'usage' => '[posts template="templates/posts.php"]',
				'desc' => __( 'Custom posts query with customizable template', $shult->textdomain )
			)
			) );
		// Return result
		return ( $shortcode ) ? $shortcodes[$shortcode] :
			$shortcodes;
	}

	/**
	 * Register shortcodes
	 */
	function su_register_shortcodes() {
		// Loop through shortcodes
		foreach ( ( array ) su_shortcodes() as $shortcode => $data ) {
			// Prepare shortcode function name
			$function = ( $data['function'] ) ? $data['function'] : 'su_' . $shortcode . '_shortcode';
			// Register shortcode
			add_shortcode( su_compatibility_mode_prefix() . $shortcode, $function );
		}
	}

	add_action( 'init', 'su_register_shortcodes' );
?>