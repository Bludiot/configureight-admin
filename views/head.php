<?php
/**
 * Page <head> section
 *
 * @package    Configure 8 Admin
 * @subpackage Templates
 * @since      1.0.0
 */

// Access namespaced functions.
use function CFE_Admin_Theme\{
	plugin,
	favicon_tag
};

// Maybe get minified assets.
$suffix = '.min';
if ( defined( 'DEBUG_MODE' ) && DEBUG_MODE ) {
	$suffix = '';
}

?>
<head data-admin-head>
	<title><?php echo $layout['title']; ?></title>

	<meta charset="<?php echo CHARSET; ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
	<meta name="robots" content="noindex,nofollow">

	<?php // Preconnect and preload files. ?>
	<link rel="preconnect" href="//fonts.adobe.com" />
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

	<?php

	// Change `<html>` 'no-js' class to 'js' if JavaScript is enabled.
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n"; ?>

	<?php echo favicon_tag(); ?>

	<?php
		echo Theme :: cssLineAwesome();
		echo Theme :: css(
			[
				'jquery.datetimepicker.min.css'
			],
			DOMAIN_CORE_CSS
		);
		echo Theme :: css(
			[
				"assets/css/style{$suffix}.css"
			],
			DOMAIN_ADMIN_THEME
		);

		echo Theme :: jquery();
		echo Theme :: jsBootstrap();
		echo Theme :: jsSortable();
		echo Theme :: js(
			[
				'jquery.datetimepicker.full.min.js',
				'select2.full.min.js',
				'functions.js'
			],
			DOMAIN_CORE_JS, null
		);

		// Hook for plugins.
		Theme :: plugins( 'adminHead' );

		// Admin CSS from Configure 8 theme options plugin.
		if ( plugin() && 'configureight' === plugin()->className() ) :

			if ( ! empty( plugin()->admin_css() ) ) {
				$style  = '<style>';
				$style .= strip_tags( plugin()->admin_css() );
				$style .= '</style>';

				echo $style;
			}
		endif; ?>
</head>
