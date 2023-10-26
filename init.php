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
