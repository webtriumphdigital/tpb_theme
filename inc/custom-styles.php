<?php
if ( !function_exists ('justhome_custom_styles') ) {
	function justhome_custom_styles() {
		global $post;	
		
		ob_start();	
		?>
		
			<?php if ( justhome_get_config('main_color') != "" ) {
				$main_color = justhome_get_config('main_color');
			} else {
				$main_color = '#E7C873';
			}
			if ( justhome_get_config('second_color') != "" ) {
				$second_color = justhome_get_config('second_color');
			} else {
				$second_color = '#1A1A1A';
			}

			if ( justhome_get_config('main_hover_color') != "" ) {
				$main_hover_color = justhome_get_config('main_hover_color');
			} else {
				$main_hover_color = '#D9B75A';
			}

			if ( justhome_get_config('second_hover_color') != "" ) {
				$second_hover_color = justhome_get_config('second_hover_color');
			} else {
				$second_hover_color = '#222222';
			}

			if ( justhome_get_config('text_color') != "" ) {
				$text_color = justhome_get_config('text_color');
			} else {
				$text_color = '#1A1A1A';
			}

			if ( justhome_get_config('link_color') != "" ) {
				$link_color = justhome_get_config('link_color');
			} else {
				$link_color = '#1A1A1A';
			}

			if ( justhome_get_config('link_hover_color') != "" ) {
				$link_hover_color = justhome_get_config('link_hover_color');
			} else {
				$link_hover_color = '#1F4B43';
			}

			if ( justhome_get_config('heading_color') != "" ) {
				$heading_color = justhome_get_config('heading_color');
			} else {
				$heading_color = '#1A1A1A';
			}

			$main_color_rgb = justhome_hex2rgb($main_color);
			$second_color_rgb = justhome_hex2rgb($second_color);
			
			// font
			$main_font = justhome_get_config('main-font');
			$main_font = !empty($main_font) ? json_decode($main_font, true) : array();
			$main_font_family = !empty($main_font['fontfamily']) ? $main_font['fontfamily'] : 'Roboto';
			$main_font_weight = !empty($main_font['fontweight']) ? $main_font['fontweight'] : 400;
			$main_font_size = !empty(justhome_get_config('main-font-size')) ? justhome_get_config('main-font-size').'px' : '15px';

			$main_font_arr = explode(',', $main_font_family);
			if ( count($main_font_arr) == 1 ) {
				$main_font_family = "'".$main_font_family."'";
			}

			$heading_font = justhome_get_config('heading-font');
			$heading_font = !empty($heading_font) ? json_decode($heading_font, true) : array();
			$heading_font_family = !empty($heading_font['fontfamily']) ? $heading_font['fontfamily'] : 'Roboto';
			$heading_font_weight = !empty($heading_font['fontweight']) ? $heading_font['fontweight'] : 500;

			$heading_font_arr = explode(',', $heading_font_family);
			if ( count($heading_font_arr) == 1 ) {
				$heading_font_family = "'".$heading_font_family."'";
			}
			?>
			:root {
			  --justhome-theme-color: <?php echo trim($main_color); ?>;
			  --justhome-second-color: <?php echo trim($second_color); ?>;
			  --justhome-text-color: <?php echo trim($text_color); ?>;
			  --justhome-link-color: <?php echo trim($link_color); ?>;
			  --justhome-link_hover_color: <?php echo trim($link_hover_color); ?>;
			  --justhome-heading-color: <?php echo trim($heading_color); ?>;
			  --justhome-theme-hover-color: <?php echo trim($main_hover_color); ?>;
			  --justhome-second-hover-color: <?php echo trim($second_hover_color); ?>;

			  --justhome-main-font: <?php echo trim($main_font_family); ?>;
			  --justhome-main-font-size: <?php echo trim($main_font_size); ?>;
			  --justhome-main-font-weight: <?php echo trim($main_font_weight); ?>;
			  --justhome-heading-font: <?php echo trim($heading_font_family); ?>;
			  --justhome-heading-font-weight: <?php echo trim($heading_font_weight); ?>;

			  --justhome-theme-color-005: <?php echo justhome_generate_rgba($main_color_rgb, 0.05); ?>
			  --justhome-theme-color-007: <?php echo justhome_generate_rgba($main_color_rgb, 0.07); ?>
			  --justhome-theme-color-010: <?php echo justhome_generate_rgba($main_color_rgb, 0.1); ?>
			  --justhome-theme-color-015: <?php echo justhome_generate_rgba($main_color_rgb, 0.15); ?>
			  --justhome-theme-color-020: <?php echo justhome_generate_rgba($main_color_rgb, 0.2); ?>
			  --justhome-theme-color-050: <?php echo justhome_generate_rgba($main_color_rgb, 0.5); ?>
			  --justhome-second-color-050: <?php echo justhome_generate_rgba($second_color_rgb, 0.5); ?>
			}
			
			<?php if (  justhome_get_config('header_mobile_color') != "" ) : ?>
				#apus-header-mobile {
					background-color: <?php echo esc_html( justhome_get_config('header_mobile_color') ); ?>;
				}
			<?php endif; ?>

	<?php
		$content = ob_get_clean();
		$content = str_replace(array("\r\n", "\r"), "\n", $content);
		$lines = explode("\n", $content);
		$new_lines = array();
		foreach ($lines as $i => $line) {
			if (!empty($line)) {
				$new_lines[] = trim($line);
			}
		}
		
		return implode($new_lines);
	}
}