<?php
/**
 * Initialize admin theme
 *
 * @package    Configure 8 Admin
 * @subpackage Functions
 * @since      1.0.0
 */

namespace CFE_Admin_Theme;

// Stop if accessed directly.
if ( ! defined( 'BLUDIT' ) ) {
	die();
}

include( 'includes/classes/class-bootstrap.php' );

/**
 * Constant: plugin class
 *
 * The class of the companion plugin.
 *
 * @since  1.0.0
 */
define( 'THEME_PLUGIN', 'configureight' );

/**
 * Get theme plugin
 *
 * @since  1.0.0
 * @return mixed Returns the companion plugin object or false.
 */
function plugin() {

	if ( $themePlugin ) {
		return $themePlugin;
	}
	return false;
}

/**
 * Body classes
 *
 * @since  1.0.0
 * @return string Returns various classes.
 */
function body_classes() {

	// Access global variables.
	global $url;

	$classes = [
		'bl-admin',
		'admin-page-' . strtok( $url->slug(), '/' )
	];

	if ( str_contains( $url->slug(), '/' ) ) {
		$classes[] = 'admin-' . str_replace( '/', '-', $url->slug() );
	}
	echo implode( ' ', $classes );
}
