<?php
/**
 * Admin menu
 *
 * @package    Configure 8 Admin
 * @subpackage Templates
 * @since      1.0.0
 */

// Theme plugin data.
$theme_plugin  = getPlugin( $site->theme() );
$theme_options = '';
if ( $theme_plugin ) {
	$theme_options = get_object_vars( $theme_plugin );
}

?>
<nav>
	<ul class="admin-menu-list nav flex-column">

		<li class="menu-heading">
			<h3><a class="nav-link" href="<?php echo HTML_PATH_ADMIN_ROOT . 'dashboard'; ?>"><?php $L->p( 'Site Admin' ); ?></a></h3>
		</li>

		<ul>
			<li>
				<a class="nav-link" href="<?php echo HTML_PATH_ADMIN_ROOT . 'dashboard'; ?>"><span class="fa fa-tachometer"></span><?php $L->p( 'Dashboard' ); ?></a>
			</li>

			<li>
				<a class="nav-link" target="_blank" href="<?php echo HTML_PATH_ROOT; ?>"><span class="fa fa-home"></span><?php $L->p( 'View Site' ); ?></a>
			</li>

			<li>
				<a class="nav-link" href="<?php echo HTML_PATH_ADMIN_ROOT . 'edit-user/' . $login->username(); ?>"><span class="fa fa-user"></span><?php $L->p( 'Your Profile' ); ?></a>
			</li>
		</ul>

		<?php if ( checkRole( [ 'admin' ], false ) ) : ?>
		<li class="menu-heading">
			<h3><a class="nav-link" href="<?php echo HTML_PATH_ADMIN_ROOT . 'content'; ?>"><?php $L->p( 'Content' ); ?></a></h3>
		</li>
		<?php endif; ?>

		<ul>
			<li>
				<a class="nav-link" href="<?php echo HTML_PATH_ADMIN_ROOT . 'content'; ?>"><span class="fa fa-thumb-tack"></span><?php $L->p( 'Blog' ); ?></a>
			</li>

			<li>
				<a class="nav-link" href="<?php echo HTML_PATH_ADMIN_ROOT . 'content#static'; ?>"><span class="fa fa-file"></span><?php $L->p( 'Static' ); ?></a>
			</li>

			<li>
				<a class="nav-link" href="<?php echo HTML_PATH_ADMIN_ROOT . 'new-content'; ?>"><span class="fa fa-pencil"></span><?php echo ucwords( $L->get( 'New Content' ) ); ?></a>
			</li>

			<?php if ( checkRole( [ 'admin' ], false ) ) : ?>
			<li>
				<a class="nav-link" href="<?php echo HTML_PATH_ADMIN_ROOT . 'categories'; ?>"><span class="fa fa-folder" style="transform: rotate(-90deg) translateX(-2px);"></span><?php $L->p( 'Categories' ); ?></a>
			</li>
			<?php endif; ?>
		</ul>

		<?php if ( checkRole( [ 'admin' ], false ) ) : ?>
		<li class="menu-heading">
			<h3><a class="nav-link" href="<?php echo HTML_PATH_ADMIN_ROOT . 'settings'; ?>"><?php $L->p( 'Manage' ); ?></a></h3>
		</li>
		<?php endif; ?>

		<ul>
			<?php if ( checkRole( [ 'admin' ], false ) ) : ?>
			<li>
				<a class="nav-link" href="<?php echo HTML_PATH_ADMIN_ROOT . 'settings'; ?>"><span class="fa fa-gear"></span><?php $L->p( 'Settings' ); ?></a>
			</li>
			<?php endif; ?>

			<?php if ( checkRole( [ 'admin' ], false ) ) : ?>
			<li>
				<a class="nav-link" href="<?php echo HTML_PATH_ADMIN_ROOT . 'users'; ?>"><span class="fa fa-users"></span><?php $L->p( 'Users' ); ?></a>
			</li>
			<?php endif; ?>

			<?php if ( checkRole( [ 'admin' ], false ) ) : ?>
			<li>
				<a class="nav-link" href="<?php echo HTML_PATH_ADMIN_ROOT . 'plugins'; ?>"><span class="fa fa-plug"></span><?php $L->p( 'Plugins' ); ?></a>
			</li>
			<?php endif; ?>

			<?php if ( checkRole( [ 'admin' ], false ) ) : ?>
			<li>
				<a class="nav-link" href="<?php echo HTML_PATH_ADMIN_ROOT . 'themes'; ?>"><span class="fa fa-desktop"></span><?php $L->p( 'Themes' ); ?></a>
			</li>
			<?php endif; ?>

			<?php
			if (
				checkRole( [ 'admin' ], false ) &&
				$theme_plugin
			) : ?>
			<li>
				<a class="nav-link" href="<?php echo HTML_PATH_ADMIN_ROOT . 'configure-plugin/' . $theme_options['directoryName']; ?>"><span class="fa fa-paint-brush"></span><?php $L->p( 'Options' ); ?></a>
			</li>
			<?php endif; ?>

			<?php if ( checkRole( [ 'admin' ], false ) ) : ?>
			<li>
				<a class="nav-link" href="<?php echo HTML_PATH_ADMIN_ROOT . '/'; ?>"><span class="fa fa-gear"></span><?php $L->p( 'Admin' ); ?></a>
			</li>
			<?php endif; ?>
		</ul>

		<?php
		if (
			checkRole( [ 'admin', 'editor' ], false ) &&
			! empty( $plugins['adminSidebar'] )
		) : ?>
		<li class="menu-heading">
			<h3><a class="nav-link" href="<?php echo HTML_PATH_ADMIN_ROOT . 'settings'; ?>"><?php $L->p( 'Features' ); ?></a></h3>
		</li>
		<ul>
			<?php
			foreach ( $plugins['adminSidebar'] as $link ) {
				printf(
					'<li>%s</li>',
					$link->adminSidebar()
				);
			} ?>
		</ul>
		<?php endif; ?>
	</ul>
</nav>
