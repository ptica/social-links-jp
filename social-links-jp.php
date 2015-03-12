<?php
/*
Plugin Name: Social links JP
Plugin URI: http://f11.cz/
Description: Shows how to use WP register_setting() API
Author: Ozh
Author URI: http://planetozh.com/
*/

add_action('admin_init', 'social_links_jp_init' );
add_action('admin_menu', 'social_links_jp_add_page');

// Init plugin options to white list our options
function social_links_jp_init(){
	register_setting( 'social_links_jp_options', 'social_links_jp', 'social_links_jp_validate' );
}

// Add menu page
function social_links_jp_add_page() {
	add_options_page('Odkazy na sociální sítě', 'Sociální sítě', 'manage_categories', 'social_links_jp', 'social_links_jp_do_page');
}

// Draw the menu page itself
function social_links_jp_do_page() {
	?>
	<div class="wrap">
		<h2>Odkazy na sociální sítě</h2>
		<form method="post" action="options.php">
			<?php settings_fields('social_links_jp_options'); ?>
			<?php $options = get_option('social_links_jp'); ?>
			<table class="form-table">
				<tr valign="top"><th scope="row" style="width:180px">Twitter</th>
					<td><input type="text" name="social_links_jp[twitter]" value="<?php echo $options['twitter']; ?>" style="width:280px"></td>
				</tr>
				<tr valign="top"><th scope="row">Facebook</th>
					<td><input type="text" name="social_links_jp[facebook]" value="<?php echo $options['facebook']; ?>" style="width:280px"></td>
				</tr>
				<tr valign="top"><th scope="row">LinkedIn</th>
					<td><input type="text" name="social_links_jp[linkedin]" value="<?php echo $options['linkedin']; ?>"style="width:280px"></td>
				</tr>
			</table>
			<p class="submit">
			<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
			</p>
		</form>
	</div>
	<?php
}

// Sanitize and validate input. Accepts an array, return a sanitized array.
function social_links_jp_validate($input) {
	// Say our second option must be safe text with no HTML tags
	$input['twitter']  =  wp_filter_nohtml_kses($input['twitter']);
	$input['facebook'] =  wp_filter_nohtml_kses($input['facebook']);
	$input['linkedin'] =  wp_filter_nohtml_kses($input['linkedin']);

	return $input;
}
