<?php
/**
 * Admin menu
 *
 * @package    Configure 8 Admin
 * @subpackage Templates
 * @since      1.0.0
 */

// Access namespaced functions.
use function CFE_Admin_Theme\{
	plugin,
	svg_icon,
	plugin_sidebars_count
};

// Theme plugin data.
$theme_options = '';
if ( plugin() ) {
	$theme_options = get_object_vars( plugin() );
}

// Posts label.
$loop = $L->get( 'Blog' );
if ( plugin() && THEME_PLUGIN == $theme_options['className'] ) {
	if ( 'news' == $theme_options['db']['loop_style'] ) {
		$loop = $L->get( 'News' );
	}
}

?>
<nav>
	<ul class="admin-menu-list nav flex-column">

		<li class="admin-menu-item menu-heading">
			<h3><a class="nav-link" href="<?php echo HTML_PATH_ADMIN_ROOT . 'dashboard'; ?>"><?php $L->p( 'Admin' ); ?></a></h3>
		</li>

		<ul>
			<li class="admin-menu-item has-icon-link">
				<a class="nav-link" href="<?php echo HTML_PATH_ADMIN_ROOT . 'dashboard'; ?>"><?php svg_icon( 'gauge' ); ?><?php $L->p( 'Dashboard' ); ?></a>

				<?php if ( checkRole( [ 'admin' ], false ) ) : ?>
				<a class="nav-link icon-link" href="<?php echo HTML_PATH_ADMIN_ROOT . 'developers'; ?>"><?php svg_icon( 'info' ); ?><span class="screen-reader-text"><?php $L->p( 'System Info' ); ?></span></a>
				<?php endif; ?>
			</li>

			<li class="admin-menu-item">
				<a class="nav-link" href="<?php echo HTML_PATH_ADMIN_ROOT . 'edit-user/' . $login->username(); ?>"><?php svg_icon( 'user' ); ?><?php $L->p( 'Your Profile' ); ?></a>
			</li>

			<li class="admin-menu-item has-icon-link">
				<a class="nav-link" href="<?php echo HTML_PATH_ROOT; ?>"><?php svg_icon( 'house' ); ?><?php $L->p( 'View Site' ); ?></a>

				<a class="nav-link icon-link" href="<?php echo HTML_PATH_ROOT; ?>" target="_blank"><?php svg_icon( 'external-link' ); ?><span class="screen-reader-text"><?php $L->p( 'View Site in New Tab' ); ?></span></a>
			</li>
		</ul>

		<?php if ( checkRole( [ 'admin' ], false ) ) : ?>
		<li class="admin-menu-item menu-heading">
			<h3><a class="nav-link" href="<?php echo HTML_PATH_ADMIN_ROOT . 'content'; ?>"><?php $L->p( 'Content' ); ?></a></h3>
		</li>
		<?php endif; ?>

		<ul>
			<li class="admin-menu-item">
				<a class="nav-link" href="<?php echo HTML_PATH_ADMIN_ROOT . 'new-content'; ?>"><?php svg_icon( 'pencil' ); ?><?php echo ucwords( $L->get( 'Compose' ) ); ?></a>
			</li>

			<li class="admin-menu-item">
				<a class="nav-link" href="<?php echo HTML_PATH_ADMIN_ROOT . 'content'; ?>"><?php svg_icon( 'pin' ); ?><?php echo $loop; ?></a>
			</li>

			<li class="admin-menu-item">
				<a class="nav-link" href="<?php echo HTML_PATH_ADMIN_ROOT . 'content#static'; ?>"><?php svg_icon( 'file' ); ?><?php $L->p( 'Static' ); ?></a>
			</li>

			<?php if ( checkRole( [ 'admin' ], false ) ) : ?>
			<li class="admin-menu-item has-icon-link">
				<a class="nav-link" href="<?php echo HTML_PATH_ADMIN_ROOT . 'categories'; ?>"><?php svg_icon( 'folder' ); ?><?php $L->p( 'Categories' ); ?></a>
				<a class="nav-link icon-link" href="<?php echo HTML_PATH_ADMIN_ROOT . 'new-category'; ?>"><?php svg_icon( 'plus' ); ?><span class="screen-reader-text"><?php $L->p( 'Add Category' ); ?></span></a>
			</li>
			<?php endif; ?>
		</ul>

		<?php if ( checkRole( [ 'admin' ], false ) ) : ?>
		<li class="admin-menu-item menu-heading">
			<h3><a class="nav-link" href="<?php echo HTML_PATH_ADMIN_ROOT . 'settings'; ?>"><?php $L->p( 'Manage' ); ?></a></h3>
		</li>
		<?php endif; ?>

		<ul>
			<?php if ( checkRole( [ 'admin' ], false ) ) : ?>
			<li class="admin-menu-item">
				<a class="nav-link" href="<?php echo HTML_PATH_ADMIN_ROOT . 'settings'; ?>"><?php svg_icon( 'gear' ); ?><?php $L->p( 'Settings' ); ?></a>
			</li>
			<?php endif; ?>

			<?php if ( checkRole( [ 'admin' ], false ) ) : ?>
			<li class="admin-menu-item has-icon-link">
				<a class="nav-link" href="<?php echo HTML_PATH_ADMIN_ROOT . 'users'; ?>"><?php svg_icon( 'users' ); ?><?php $L->p( 'Users' ); ?></a>
				<a class="nav-link icon-link" href="<?php echo HTML_PATH_ADMIN_ROOT . 'new-user'; ?>"><?php svg_icon( 'plus' ); ?><span class="screen-reader-text"><?php $L->p( 'Add User' ); ?></span></a>
			</li>
			<?php endif; ?>

			<?php if ( checkRole( [ 'admin' ], false ) ) : ?>
			<li class="admin-menu-item has-icon-link">
				<a class="nav-link" href="<?php echo HTML_PATH_ADMIN_ROOT . 'plugins'; ?>"><?php svg_icon( 'plug' ); ?><?php $L->p( 'Plugins' ); ?></a>
				<a class="nav-link icon-link" href="<?php echo HTML_PATH_ADMIN_ROOT . 'plugins-position'; ?>"><?php svg_icon( 'arrows-v' ); ?><span class="screen-reader-text"><?php $L->p( 'Sort Plugins' ); ?></span></a>
			</li>
			<?php endif; ?>

			<?php if ( checkRole( [ 'admin' ], false ) ) : ?>
			<li class="admin-menu-item">
				<a class="nav-link" href="<?php echo HTML_PATH_ADMIN_ROOT . 'themes'; ?>"><?php svg_icon( 'paint-roller' ); ?><?php $L->p( 'Themes' ); ?></a>
			</li>
			<?php endif; ?>

			<?php
			if (
				checkRole( [ 'admin' ], false ) &&
				plugin()
			) : ?>
			<li class="admin-menu-item">
				<a class="nav-link" href="<?php echo HTML_PATH_ADMIN_ROOT . 'configure-plugin/' . $theme_options['directoryName']; ?>"><?php svg_icon( 'paint-brush' ); ?><?php $L->p( 'Options' ); ?></a>
			</li>
			<?php endif; ?>
		</ul>

		<?php
		if (
			checkRole( [ 'admin', 'editor' ], false ) &&
			plugin_sidebars_count() > 0
		) :

		?>
		<li class="admin-menu-item menu-heading">
			<h3><a class="nav-link" href="<?php echo HTML_PATH_ADMIN_ROOT . 'settings'; ?>"><?php $L->p( 'Features ' ); ?></a></h3>
		</li>
		<ul>
			<?php
			foreach ( $plugins['adminSidebar'] as $link ) {
				if ( 'theme' != $link->type() ) {
					printf(
						'<li class="admin-menu-item">%s</li>',
						$link->adminSidebar()
					);
				}
			} ?>
		</ul>
		<?php endif; ?>
	</ul>
</nav>
