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

/**
 * Get SVG files
 *
 * @since  1.0.0
 * @param  string $filename Name of the SVG file.
 * @return mixed Returns the contents of the SVG file or
 *               returns null if the filename is not found.
 */
function get_svg_icon( $filename = '' ) {

	// Access global variables.
	global $site;

	$path = PATH_ROOT . 'bl-kernel/admin/themes/' . $site->adminTheme() . '/assets/images/svg/' . $filename . '.svg';
	$args = [
		'svg',
		'g',
		'path'
	];

	if ( is_file( $path ) && is_readable( $path ) ) {

		$file = strip_tags( $path, $args );
		return file_get_contents( $file );

	} else {
		return $path;
	}
}

/**
 * SVG icon
 *
 * Prints the contents of a given SVG file.
 *
 * @since  1.0.0
 * @param  string $filename Name of the SVG file.
 * @param  boolean $wrap Wraps the icon in HTML if true.
 * @param  string $class Additional class names for the wrapper.
 * @param  string $title Contents of the title attribute if
 *                       $wrap is true.
 * @return void
 */
function svg_icon( $filename, $wrap = true, $class = '' ) {

	if ( ! empty( $class ) ) {
		$class = ' ' . $class;
	}

	if ( true == $wrap ) {
		printf(
			'<span class="svg-icon%s">%s</span>',
			$class,
			get_svg_icon( $filename )
		);
	} else {
		echo get_svg_icon( $filename );
	}
}
