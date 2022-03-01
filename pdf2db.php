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
 * Plugin Name:       onward-pdf-2-db
 * Plugin URI:        https://onwardus.org
 * Description:       This plugin will convert the contents of PDF files to strings for database storage. An extension of Ultimate Member functionality for user searching.
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
// B I T E
if ( !defined( 'ABSPATH' ) ) die( 'No cheating!' );

function add_pdf_query( $query_args, $directory_settings ){

	if ( ! empty( $_POST['search'] ) ) {

		$search = trim( stripslashes( sanitize_text_field( $_POST['search'] ) ) );

		$query_args['meta_query'][] = array(
			'key' => 'nvgs_applicant_file',
			'value' => $search,
			'compare' => 'LIKE'
		);

		$query_args['meta_query']['relation'] = 'OR';
	}
	
	update_metadata('user',1,'query_args',json_encode($query_args['meta_query']));
	update_metadata('user',1,'directory_settings',json_encode($directory_settings));


	return $query_args;
}

add_filter( 'um_prepare_user_query_args', 'add_pdf_query', 10, 2 );

// create the function that handles all data between upload to parser to database
function handlePDF( $args ){
	
	// include the pdf parser library that we need
	include_once( __DIR__.'/vendor/autoload.php' );
	
	$current_user = get_current_user_id();
	
	if( $args[ 'submitted' ][ 'onward_resume_file' ] != 'empty_file'
			&& $args[ 'submitted' ][ 'onward_resume_file' ] ){
				
		$config = new \Smalot\PdfParser\Config();
		$config->setHorizontalOffset( '' );
		$config->setRetainImageContent( false );
		
		$parser = new \Smalot\PdfParser\Parser( [], $config );
		
		add_action( 'shutdown', function() use ( $current_user, $parser ){
			
			$db_entry = get_user_meta( $current_user, 'onward_resume_file', true );
			
		  $uploads_path = wp_upload_dir( null, false, false );
			$um_user_pdf = $uploads_path[ 'basedir' ] . '/ultimatemember' . '/' . $current_user . '/' . $db_entry;
			
			$pdf = $parser->parseFile( $um_user_pdf );
			$string = sanitize_text_field( $pdf->getText() );
			
			update_metadata( 'user', $current_user, 'nvgs_applicant_file', $string );
			um_reset_user();
      $string = sanitize_text_field( '' );

		});
	}elseif($args['submitted']['onward_resume_file'] == 'empty_file'){
		
		delete_user_meta( $current_user, 'nvgs_applicant_file');
	}
}



add_action( 'um_user_edit_profile', 'handlePDF', 10, 1 );