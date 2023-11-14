<?php
/**
 * Login page template
 *
 * @package    Configure 8 Admin
 * @subpackage Templates
 * @since      1.0.0
 */

// Access namespaced functions.
use function CFE_Admin_Theme\{
	favicon_tag,
	plugin,
	svg_icon
};

// Maybe get minified assets.
$suffix = '.min';
if ( defined( 'DEBUG_MODE' ) && DEBUG_MODE ) {
	$suffix = '';
}

?>
<!DOCTYPE html>
<html dir="auto" class="no-js" lang="<?php echo $L->currentLanguageShortVersion(); ?>">

<head>
	<title><?php $L->p( 'User Login' ); ?> | <?php echo $site->title(); ?></title>

	<meta charset="<?php echo CHARSET; ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
	<meta name="robots" content="noindex,nofollow">

	<?php // Change `<html>` 'no-js' class to 'js' if JavaScript is enabled.
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n"; ?>

	<?php echo favicon_tag(); ?>

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
					<img src="<?php echo $site->logo(); ?>" width="80">
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
			<p class="login-site-link"><a href="<?php echo HTML_PATH_ROOT; ?>"><?php $L->p( 'Go to Site' ); ?><?php svg_icon( 'arrow-right' ); ?></a></p>
		</div>
	</div>
	<?php Theme :: plugins( 'loginBodyEnd' ); ?>
</body>
</html>
