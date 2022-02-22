<?php

/**
 * The plugin
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              SAE
 * @since             1.0.0
 * @package           pdf-2-db
 *
 * @wordpress-plugin
 * Plugin Name:       pdf-2-db
 * Plugin URI:        pdf-2-db
 * Description:       This plugin will convert the contents of PDF files to strings for database storage. A 	work in progress.
 * Version:           1.0.0
 * Author:            SAE
 * Author URI:        SAE
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       pdf-2-db
 * Domain Path:       /languages
 * 
 * 
 * 
 */

 
include_once(__DIR__.'/vendor/autoload.php');

function shortcode(){

	$path = plugin_dir_path(__FILE__);
	echo $path;
}

add_shortcode('shortcode_mf', 'shortcode');


// add_action('init', function(){

// 	$config = new \Smalot\PdfParser\Config();
// 	$config->setHorizontalOffset('');
// 	$config->setRetainImageContent(false);

// 	$parser = new \Smalot\PdfParser\Parser([], $config);
// 	$pdf    = $parser->parseFile(plugin_dir_path(__FILE__).'whoops.pdf');
// 	update_metadata('user', 2, 'resume', $pdf->getText());
// });


add_action('um_user_edit_profile', 'function_name', 10, 1);

function function_name($args){
	update_metadata('user', 2, 'test_spot', 'testing update');
	?>
		<script>
			console.log('hook go boom?');
			console.log('<?php echo $args;?>');
		</script>
	<?php
}