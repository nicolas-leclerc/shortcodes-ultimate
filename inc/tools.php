<?php

	/**
	 * Csv files parser
	 * Converts csv-files to html-tables
	 *
	 * @param type $file File url to parse
	 */
	function su_parse_csv( $file ) {
		$csv_lines = file( $file );
		if ( is_array( $csv_lines ) ) {
			$cnt = count( $csv_lines );
			for ( $i = 0; $i < $cnt; $i++ ) {
				$line = $csv_lines[$i];
				$line = trim( $line );
				$first_char = true;
				$col_num = 0;
				$length = strlen( $line );
				for ( $b = 0; $b < $length; $b++ ) {
					if ( $skip_char != true ) {
						$process = true;
						if ( $first_char == true ) {
							if ( $line[$b] == '"' ) {
								$terminator = '";';
								$process = false;
							}
							else
								$terminator = ';';
							$first_char = false;
						}
						if ( $line[$b] == '"' ) {
							$next_char = $line[$b + 1];
							if ( $next_char == '"' )
								$skip_char = true;
							elseif ( $next_char == ';' ) {
								if ( $terminator == '";' ) {
									$first_char = true;
									$process = false;
									$skip_char = true;
								}
							}
						}
						if ( $process == true ) {
							if ( $line[$b] == ';' ) {
								if ( $terminator == ';' ) {
									$first_char = true;
									$process = false;
								}
							}
						}
						if ( $process == true )
							$column .= $line[$b];
						if ( $b == ($length - 1) )
							$first_char = true;
						if ( $first_char == true ) {
							$values[$i][$col_num] = $column;
							$column = '';
							$col_num++;
						}
					}
					else
						$skip_char = false;
				}
			}
		}
		$return = '<table><tr>';
		foreach ( $values[0] as $value )
			$return .= '<th>' . $value . '</th>';
		$return .= '</tr>';
		array_shift( $values );
		foreach ( $values as $rows ) {
			$return .= '<tr>';
			foreach ( $rows as $col ) {
				$return .= '<td>' . $col . '</td>';
			}
			$return .= '</tr>';
		}
		$return .= '</table>';
		return $return;
	}

	/**
	 * Color shift a hex value by a specific percentage factor
	 *
	 * @param string $supplied_hex Any valid hex value. Short forms e.g. #333 accepted.
	 * @param string $shift_method How to shift the value e.g( +,up,lighter,>)
	 * @param integer $percentage Percentage in range of [0-100] to shift provided hex value by
	 * @return string shifted hex value
	 * @version 1.0 2008-03-28
	 */
	function su_hex_shift( $supplied_hex, $shift_method, $percentage = 50 ) {
		$shifted_hex_value = null;
		$valid_shift_option = FALSE;
		$current_set = 1;
		$RGB_values = array( );
		$valid_shift_up_args = array( 'up', '+', 'lighter', '>' );
		$valid_shift_down_args = array( 'down', '-', 'darker', '<' );
		$shift_method = strtolower( trim( $shift_method ) );
		// Check Factor
		if ( !is_numeric( $percentage ) || ($percentage = ( int ) $percentage) < 0 || $percentage > 100 )
			trigger_error( "Invalid factor", E_USER_NOTICE );
		// Check shift method
		foreach ( array( $valid_shift_down_args, $valid_shift_up_args ) as $options ) {
			foreach ( $options as $method ) {
				if ( $method == $shift_method ) {
					$valid_shift_option = !$valid_shift_option;
					$shift_method = ( $current_set === 1 ) ? '+' : '-';
					break 2;
				}
			}
			++$current_set;
		}
		if ( !$valid_shift_option )
			trigger_error( "Invalid shift method", E_USER_NOTICE );
		// Check Hex string
		switch ( strlen( $supplied_hex = ( str_replace( '#', '', trim( $supplied_hex ) ) ) ) ) {
			case 3:
				if ( preg_match( '/^([0-9a-f])([0-9a-f])([0-9a-f])/i', $supplied_hex ) ) {
					$supplied_hex = preg_replace( '/^([0-9a-f])([0-9a-f])([0-9a-f])/i', '\\1\\1\\2\\2\\3\\3', $supplied_hex );
				}
				else {
					trigger_error( "Invalid hex color value", E_USER_NOTICE );
				}
				break;
			case 6:
				if ( !preg_match( '/^[0-9a-f]{2}[0-9a-f]{2}[0-9a-f]{2}$/i', $supplied_hex ) ) {
					trigger_error( "Invalid hex color value", E_USER_NOTICE );
				}
				break;
			default:
				trigger_error( "Invalid hex color length", E_USER_NOTICE );
		}
		// Start shifting
		$RGB_values['R'] = hexdec( $supplied_hex{0} . $supplied_hex{1} );
		$RGB_values['G'] = hexdec( $supplied_hex{2} . $supplied_hex{3} );
		$RGB_values['B'] = hexdec( $supplied_hex{4} . $supplied_hex{5} );
		foreach ( $RGB_values as $c => $v ) {
			switch ( $shift_method ) {
				case '-':
					$amount = round( ((255 - $v) / 100) * $percentage ) + $v;
					break;
				case '+':
					$amount = $v - round( ($v / 100) * $percentage );
					break;
				default:
					trigger_error( "Oops. Unexpected shift method", E_USER_NOTICE );
			}
			$shifted_hex_value .= $current_value = (
				strlen( $decimal_to_hex = dechex( $amount ) ) < 2
				) ? '0' . $decimal_to_hex : $decimal_to_hex;
		}
		return '#' . $shifted_hex_value;
	}

	/**
	 * Apply all custom formatting options of plugin
	 */
	function su_apply_formatting() {
		// Get plugin object
		global $shult;
		// Enable shortcodes in text widgets
		add_filter( 'widget_text', 'do_shortcode' );
		// Enable shortcodes in category descriptions
		add_filter( 'category_description', 'do_shortcode' );
		// Enable auto-formatting
		if ( $shult->get_option( 'custom_formatting' ) == 'on' ) {
			// Disable WordPress native content formatters
			remove_filter( 'the_content', 'wpautop' );
			remove_filter( 'the_content', 'wptexturize' );
			// Apply custom formatter function
			add_filter( 'the_content', 'su_custom_formatter', 99 );
			add_filter( 'widget_text', 'su_custom_formatter', 99 );
			add_filter( 'category_description', 'su_custom_formatter', 99 );
		}
		// Fix for large posts, http://core.trac.wordpress.org/ticket/8553
		@ini_set( 'pcre.backtrack_limit', 500000 );
	}

	add_action( 'init', 'su_apply_formatting' );

	/**
	 * Custom formatter function
	 *
	 * @param string $content
	 * @return string Formatted content with clean shortcodes content
	 */
	function su_custom_formatter( $content ) {
		// Prepare variables
		$new_content = '';
		// Matches the contents and the open and closing tags
		$pattern_full = '{(\[raw\].*?\[/raw\])}is';
		// Matches just the contents
		$pattern_contents = '{\[raw\](.*?)\[/raw\]}is';
		// Divide content into pieces
		$pieces = preg_split( $pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE );
		// Loop over pieces
		foreach ( $pieces as $piece ) {
			// Look for presence of the shortcode, Append to content (no formatting)
			if ( preg_match( $pattern_contents, $piece, $matches ) )
				$new_content .= $matches[1];
			// Format and append to content
			else
				$new_content .= wptexturize( wpautop( $piece ) );
		}
		// Return formatted content
		return $new_content;
	}

	/**
	 * Custom do_shortcode function for nested shortcodes
	 *
	 * @param string $content Shortcode content
	 * @param string $pre First shortcode letter
	 * @return string Formatted content
	 */
	function su_do_shortcode( $content, $pre ) {
		if ( strpos( $content, '[_' ) !== false )
			$content = preg_replace( '@(\[_*)_(' . $pre . '|/)@', "$1$2", $content );
		return do_shortcode( $content );
	}

	/**
	 * Shortcode names prefix in compatibility mode
	 *
	 * @return string Special prefix
	 */
	function su_compatibility_mode_prefix() {
		global $shult;
		return $shult->get_option( 'compatibility_mode' ) === 'on' ? 'su_' : '';
	}

	/**
	 * Tweet relative time (like: 5 seconds ago)
	 */
	function su_rel_time( $original, $do_more = 0 ) {
		global $shult;
		// array of time period chunks
		$chunks = array(
			array( 60 * 60 * 24 * 365, __( 'year', $shult->textdomain ) ),
			array( 60 * 60 * 24 * 30, __( 'month', $shult->textdomain ) ),
			array( 60 * 60 * 24 * 7, __( 'week', $shult->textdomain ) ),
			array( 60 * 60 * 24, __( 'day', $shult->textdomain ) ),
			array( 60 * 60, __( 'hour', $shult->textdomain ) ),
			array( 60, __( 'minute', $shult->textdomain ) ),
		);
		$today = time();
		$since = $today - $original;
		for ( $i = 0, $j = count( $chunks ); $i < $j; $i++ ) {
			$seconds = $chunks[$i][0];
			$name = $chunks[$i][1];

			if ( ($count = floor( $since / $seconds )) != 0 )
				break;
		}
		$return = ($count == 1) ? '1 ' . $name : "$count {$name}" . __( 's', $shult->textdomain );
		if ( $i + 1 < $j ) {
			$seconds2 = $chunks[$i + 1][0];
			$name2 = $chunks[$i + 1][1];

			// add second item if it's greater than 0
			if ( (($count2 = floor( ($since - ($seconds * $count)) / $seconds2 )) != 0) && $do_more )
				$return .= ( $count2 == 1) ? ', 1 ' . $name2 : ", $count2 {$name2}" . __( 's', $shult->textdomain );
		}
		return $return;
	}

	/**
	 * Add hyperlinks to tweets
	 */
	function su_parse_links( $text ) {
		// Props to Allen Shaw & webmancers.com
		// match protocol://address/path/file.extension?some=variable&another=asf%
		$text = preg_replace( '/\b([a-zA-Z]+:\/\/[\w_.\-]+\.[a-zA-Z]{2,6}[\/\w\-~.?=&%#+$*!]*)\b/i', "<a href=\"$1\" class=\"twitter-link\">$1</a>", $text );
		// match www.something.domain/path/file.extension?some=variable&another=asf%
		$text = preg_replace( '/\b(?<!:\/\/)(www\.[\w_.\-]+\.[a-zA-Z]{2,6}[\/\w\-~.?=&%#+$*!]*)\b/i', "<a href=\"http://$1\" class=\"twitter-link\">$1</a>", $text );

		// match name@address
		$text = preg_replace( "/\b([a-zA-Z][a-zA-Z0-9\_\.\-]*[a-zA-Z]*\@[a-zA-Z][a-zA-Z0-9\_\.\-]*[a-zA-Z]{2,6})\b/i", "<a href=\"mailto://$1\" class=\"twitter-link\">$1</a>", $text );
		//mach #trendingtopics. Props to Michael Voigt
		$text = preg_replace( '/([\.|\,|\:|\¡|\¿|\>|\{|\(]?)#{1}(\w*)([\.|\,|\:|\!|\?|\>|\}|\)]?)\s/i', "$1<a href=\"http://twitter.com/#search?q=$2\" class=\"twitter-link\">#$2</a>$3 ", $text );
		return $text;
	}

	/**
	 * Get tweets by username
	 */
	function su_get_tweets( $username, $limit, $show_time ) {
		// Get plugin object
		global $shult;
		// Get tweets
		$tweets = json_decode( file_get_contents( 'https://api.twitter.com/1/statuses/user_timeline.json?screen_name=' . $username . '&count=' . $limit ) );
		// No username
		if ( !$username ) {
			$return = __( 'username not specified', $shult->textdomain );
			$error = true;
		}
		// No messages
		if ( !count( $tweets ) ) {
			$return = __( 'no public messages', $shult->textdomain );
			$error = true;
		}
		// Loop tweets
		if ( count( $tweets ) )
			foreach ( $tweets as $num => $tweet ) {
				// Prepare relative time
				$time = ( $show_time ) ? '<span class="su-tweet-time">' . su_rel_time( strtotime( $tweet->created_at ) ) . '</span>'
						: '';
				// Prepare last tweet class
				$last_tweet_class = ( $num == ( $limit - 1 ) ) ? ' su-tweet-last' : '';
				// Prepare markup
				$return = '<div class="su-tweet' . $last_tweet_class . '">';
				$return .= '<a href="http://twitter.com/' . $username . '" class="su-tweet-username">@' . $username . '</a>: ';
				$return .= su_parse_links( $tweet->text );
				$return .= $time;
				$return .= '</div>';
			}
		// Return results
		return ( $error ) ? '<p class="su-error"><strong>Tweets:</strong> ' . $return . '</p>'
				: $return;
	}

	/**
	 * Get video ID by url
	 *
	 * @param string $url Video url
	 * @return mixed Video ID or false
	 */
	function su_video_id( $url ) {
		$url = parse_url( $url );
		$host = $url['host'];
		parse_str( $url['query'], $query );
		// YouTube
		if ( $host === 'youtube.com' || $host === 'www.youtube.com' )
			$return = $query['v'];
		// Vimeo
		elseif ( $host === 'vimeo.com' || $host === 'www.vimeo.com' )
			$return = mb_substr( $url['path'], 1 );
		// Other providers
		else
			$return = false;
		// Return video ID
		return $return;
	}

	function su_get_categories() {
		$cats = array( );
		foreach ( ( array ) get_terms( 'category' ) as $cat ) {
			$cats[$cat->slug] = $cat->name;
		}
		return $cats;
	}

	function su_get_post_types() {
		$types = array( );
		foreach ( ( array ) get_post_types( '', 'objects' ) as $cpt => $cpt_data ) {
			$types[$cpt] = $cpt_data->label;
		}
		return $types;
	}

	function su_get_users() {
		$users = array( );
		foreach ( ( array ) get_users() as $user ) {
			$users[$user->ID] = $user->data->display_name;
		}
		return $users;
	}

	function su_get_taxonomies( $first = false ) {
		$taxes = array( );
		foreach ( ( array ) get_taxonomies( '', 'objects' ) as $tax ) {
			$taxes[$tax->name] = $tax->label;
		}
		// Return only first taxonomy name
		if ($first) {
			reset( $taxes );
			return key( $taxes );
		}
		return $taxes;
	}

	function su_get_terms( $taxonomy ) {
		$terms = array( );
		// Get the terms
		foreach ( ( array ) get_terms( $taxonomy ) as $term ) {
			$terms[$term->slug] = $term->name;
		}
		return $terms;
	}

?>