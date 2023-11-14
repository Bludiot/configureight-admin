<?php
/**
 * Login page template
 *
 * @package    Configure 8 Admin
 * @subpackage Templates
 * @since      1.0.0
 */

// Maybe get minified assets.
$suffix = '.min';
if ( defined( 'DEBUG_MODE' ) && DEBUG_MODE ) {
	$suffix = '';
}

?>
<!DOCTYPE html>
<html dir="auto" class="no-js" lang="<?php echo $L->currentLanguageShortVersion(); ?>">

<head>
	<title>Bludit</title>

	<meta charset="<?php echo CHARSET; ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
	<meta name="robots" content="noindex,nofollow">

	<?php // Change `<html>` 'no-js' class to 'js' if JavaScript is enabled.
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n"; ?>

	<link rel="shortcut icon" type="image/x-icon" href="<?php echo HTML_PATH_CORE_IMG . 'favicon.png?version=' . BLUDIT_VERSION; ?>">

	<?php
	echo Theme :: css(
		[
			"assets/css/login{$suffix}.css"
		],
		DOMAIN_ADMIN_THEME
	);

	echo Theme :: jquery();
	echo Theme :: jsBootstrap();
	?>

	<?php Theme :: plugins( 'loginHead' ); ?>
</head>

<body class="bl-admin bl-admin-login">

	<?php Theme :: plugins( 'loginBodyBegin' ); ?>
	<?php include( 'html/alert.php' ); ?>

	<div class="container">
		<div class="row justify-content-md-center site-branding">
		<?php
		if ( ! empty( $site->logo() ) ) : ?>
		<div class="site-logo" data-site-logo>
			<figure>
				<a href="<?php echo $site->url(); ?>">
					<img src="<?php echo $site->logo(); ?>" alt="<?php echo $site->title(); ?>" width="80">
				</a>
				<figcaption class="screen-reader-text"><?php echo $site->title(); ?></figcaption>
			</figure>
		</div>
		<?php endif; ?>
		</div>
		<div class="row justify-content-md-center pt-5">
			<div class="col-md-4 mt-5 p-5">
			<?php
			if ( Sanitize :: pathFile( PATH_ADMIN_VIEWS, $layout['view'] . '.php' ) ) {
				include( PATH_ADMIN_VIEWS . $layout['view'] . '.php' );
			}
			?>
			</div>
		</div>
	</div>

	<?php Theme :: plugins( 'loginBodyEnd' ); ?>

</body>
</html>
