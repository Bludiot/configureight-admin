<?php
/**
 * Base page template
 *
 * @package    Configure 8 Admin
 * @subpackage Templates
 * @since      1.0.0
 */

// Access namespaced functions.
use function CFE_Admin_Theme\{
	plugin,
	is_rtl,
	body_classes
};

// Site direction.
$dir = 'ltr';
if ( is_rtl() ) {
	$dir = 'rtl';
}

// HTML element class.
$html_class = 'no-js';

// Language direction class.
if ( is_rtl() ) {
	$html_class .= ' rtl';
} else {
	$html_class .= ' ltr';
}

// Class removed on click by script in the theme plugin.
if ( plugin() && 'theme' == plugin()->admin_theme() && 'themes' == $url->slug() ) {
	$html_class .= ' no-scroll';
}

// User toolbar option.
$show_toolbar = true;
if (
	'frontend' == plugin()->show_user_toolbar() ||
	'disabled' == plugin()->show_user_toolbar()
) {
	$show_toolbar = false;
}

?>
<!DOCTYPE html>
<html dir="<?php echo $dir; ?>" class="<?php echo $html_class; ?>" lang="<?php echo $L->currentLanguageShortVersion(); ?>" xmlns:og="http://opengraphprotocol.org/schema/" data-admin-page>

<?php include( 'views/head.php' ); ?>

<body class="<?php body_classes(); ?>">

<?php Theme :: plugins( 'adminBodyBegin' );

// Get user toolbar if option is set.
if ( plugin() && 'configureight' == plugin()->className() && $show_toolbar ) {
	include( 'views/toolbar.php' );
}

?>

<?php
// JavaScript generated by PHP.
	echo '<script charset="utf-8">' . PHP_EOL;
	include( PATH_CORE_JS.'variables.php' );
	echo '</script>' . PHP_EOL;

	echo '<script charset="utf-8">' . PHP_EOL;
	include( PATH_CORE_JS.'bludit-ajax.php' );
	echo '</script>' . PHP_EOL;
?>

<?php

// JavaScript alerts.
echo '<div id="jsshadow"></div>';
include( 'views/alert.php' ); ?>

<div class="admin-wrapper">

	<?php if ( plugin() && 'configureight' == plugin()->className() ) : ?>
	<div id="admin-menu" class="admin-menu" style="display: <?php echo ( plugin()->admin_menu() ? 'block' : 'none' ); ?>;">
		<?php include( 'views/menu.php' ); ?>
	</div>
	<?php else : ?>
	<div id="admin-menu" class="admin-menu">
		<?php include( 'views/menu.php' ); ?>
	</div>
	<?php endif; ?>

	<div id="admin-content" class="admin-content">
	<?php
		if ( Sanitize :: pathFile( PATH_ADMIN_VIEWS, $layout['view'] . '.php' ) ) {
			include( PATH_ADMIN_VIEWS.$layout['view'] . '.php' );
		} elseif ( $layout['plugin'] && method_exists( $layout['plugin'], 'adminView' ) ) {
			echo $layout['plugin']->adminView();
		} else {
			echo '<h1 class="text-center">' . $L->g( 'Page not found' ) . '</h1>';
			echo '<h2 class="text-center">' . $L->g( 'Choose a page from the menu.' ) . '</h2>';
		}
	?>
	</div>
</div>

<?php Theme :: plugins( 'adminBodyEnd' ); ?>

</body>
</html>
