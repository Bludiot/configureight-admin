<?php
/**
 * Page <head> section
 *
 * @package    Configure 8 Admin
 * @subpackage Templates
 * @since      1.0.0
 */

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

	<link rel="shortcut icon" type="image/x-icon" href="<?php echo HTML_PATH_CORE_IMG . 'favicon.png?version=' . BLUDIT_VERSION; ?>">

	<?php
		echo Theme :: cssLineAwesome();
		echo Theme :: css(
			[
				'jquery.datetimepicker.min.css',
				'select2.min.css',
				'select2-bootstrap4.min.css'
			],
			DOMAIN_CORE_CSS
		);
		echo Theme :: css(
			[
				'assets/css/bootstrap.min.css',
				'assets/css/style.min.css'
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

		Theme :: plugins( 'adminHead' );

		?>
</head>
