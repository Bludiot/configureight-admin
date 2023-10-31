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
	body_classes
};

?>
<!DOCTYPE html>
<html dir="auto" class="no-js" lang="<?php echo $L->currentLanguageShortVersion(); ?>" xmlns:og="http://opengraphprotocol.org/schema/" data-admin-page>

<?php include( 'views/head.php' ); ?>

<body class="<?php body_classes(); ?>">

<?php include( 'views/toolbar.php' ); ?>

<?php Theme :: plugins( 'adminBodyBegin' ); ?>

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

	<div id="admin-menu" class="admin-menu">
		<?php include( 'views/menu.php' ); ?>
	</div>

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
