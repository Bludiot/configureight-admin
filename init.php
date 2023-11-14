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

	// Access global variables.
	global $site;

	$plugin = false;
	if ( getPlugin( $site->theme() ) ) {
		$plugin = getPlugin( $site->theme() );
	}
	return $plugin;
}

/**
 * Favicon tag
 *
 * Returns the site icon meta tag.
 *
 * @since  1.0.0
 * @return mixed Returns the icon tag or null.
 */
function favicon_tag() {

	// If plugin has icon URL.
	if ( plugin() && plugin()->favicon_src() ) {

		// Get icon src.
		$favicon = plugin()->favicon_src();

		// Get the image file extension.
		$info = pathinfo( $favicon );
		$type = $info['extension'];

		return sprintf(
			'<link rel="icon" href="%s" type="image/%s">',
			$favicon,
			$type
		);
	}
	return null;
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

	// User toolbar.
	if ( plugin() && (
			'enabled' == plugin()->show_user_toolbar() ||
			'backend' == plugin()->show_user_toolbar()
		)
	) {
		$classes[] = 'toolbar-active';
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

/**
 * Plugin sidebars count
 *
 * This counts plugins with the `adminSidebar()`
 * method implemented. Theme options plugin is
 * excluded from the count because this theme
 * adds a link for theme options if a theme plugin
 * is available. So if the theme options plugin
 * is the only plugin activated with a sidebar link
 * then the plugin links section is not printed.
 *
 * @since  1.0.0
 * @global array $plugins Array of active plugins.
 * @return integer Returns a number of plugins.
 */
function plugin_sidebars_count() {

	// Access global variables.
	global $plugins;

	if ( empty( $plugins['adminSidebar'] ) ) {
		return 0;
	}

	$count = 0;
	foreach ( $plugins['adminSidebar'] as $link ) {
		if ( 'theme' != $link->type() ) {
			$count++;
		}
	}
	return $count;
}

/**
 * Default theme
 *
 * Restore admin theme to default in the site database.
 *
 * @since  1.0.0
 * @return void
 */
function restore_default_theme() {

	// Access global variables.
	global $site;

	// Define database file.
	$db_file = DB_SITE;

	// Get current admin theme.
	$current = '"adminTheme":"' . $site->adminTheme() . '"';
	if ( DEBUG_MODE ) {
		$current = '"adminTheme": "' . $site->adminTheme() . '"';
	}

	// Get database content.
	$content = file_get_contents( $db_file );
	$replace = '"adminTheme":"booty"';
	if ( DEBUG_MODE ) {
		$replace = '"adminTheme": "booty"';
	}

	// Change admin theme to default.
	$content = str_replace( $current, $replace, $content );

	// Write theme into the database file.
	file_put_contents ( $db_file, $content );
}

/**
 * Restore the default admin theme if the
 * Configure 8 frontend theme is not active.
 */
if ( 'configureight' != $site->theme() ) {
	restore_default_theme();
}
