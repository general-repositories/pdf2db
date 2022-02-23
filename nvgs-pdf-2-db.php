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

// basic direct-call prevention
if (!defined('ABSPATH')) die('No cheating!');



// create the function that handles all data between upload to parser to database
function handlePDF($args){
	
	// include the pdf parser library that we need
	include_once(__DIR__.'/vendor/autoload.php');
	
	if($args['submitted']['resume_upload']){
		
		$current_user = get_current_user_id();
	
		$config = new \Smalot\PdfParser\Config();
		$config->setHorizontalOffset('');
		$config->setRetainImageContent(false);
	
		$parser = new \Smalot\PdfParser\Parser([], $config);
		
		add_action('shutdown', function() use ($current_user, $parser){
			
			$db_entry = get_user_meta($current_user, 'resume_upload', true);
			
			$uploads_path = wp_upload_dir(null, false, false);
			$um_user_pdf = $uploads_path['basedir'] . '/ultimatemember' . '/' . $current_user . '/' . $db_entry;
	
			$pdf = $parser->parseFile($um_user_pdf);
			$string = sanitize_text_field($pdf->getText());
			
			update_metadata( 'user', $current_user, 'resume', $string );
		});
	}
}



add_action('um_user_edit_profile', 'handlePDF', 10, 1);