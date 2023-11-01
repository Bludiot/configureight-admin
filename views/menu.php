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

// Posts label.
$loop = $L->get( 'Blog' );
if ( $theme_plugin && THEME_PLUGIN == $theme_options['className'] ) {
	if ( 'news' == $theme_options['db']['loop_style'] ) {
		$loop = $L->get( 'News' );
	}
}

?>
<nav>
	<ul class="admin-menu-list nav flex-column">

		<li class="menu-heading">
			<h3><a class="nav-link" href="<?php echo HTML_PATH_ADMIN_ROOT . 'dashboard'; ?>"><?php $L->p( 'Site Admin' ); ?></a></h3>
		</li>

		<ul>
			<li>
				<a class="nav-link" href="<?php echo HTML_PATH_ADMIN_ROOT . 'dashboard'; ?>"><span class="fa fa-tachometer" role="icon"></span><?php $L->p( 'Dashboard' ); ?></a>

				<?php if ( checkRole( [ 'admin' ], false ) ) : ?>
				<a class="nav-link icon-link" href="<?php echo HTML_PATH_ADMIN_ROOT . 'developers'; ?>"><span class="fa fa-info" role="icon"></span><span class="screen-reader-text"><?php $L->p( 'System Info' ); ?></span></a>
				<?php endif; ?>
			</li>

			<li>
				<a class="nav-link" href="<?php echo HTML_PATH_ADMIN_ROOT . 'edit-user/' . $login->username(); ?>"><span class="fa fa-user" role="icon"></span><?php $L->p( 'Your Profile' ); ?></a>
			</li>

			<li>
				<a class="nav-link" target="_blank" href="<?php echo HTML_PATH_ROOT; ?>"><span class="fa fa-home" role="icon"></span><?php $L->p( 'View Site' ); ?></a>
			</li>
		</ul>

		<?php if ( checkRole( [ 'admin' ], false ) ) : ?>
		<li class="menu-heading">
			<h3><a class="nav-link" href="<?php echo HTML_PATH_ADMIN_ROOT . 'content'; ?>"><?php $L->p( 'Content' ); ?></a></h3>
		</li>
		<?php endif; ?>

		<ul>
			<li>
				<a class="nav-link" href="<?php echo HTML_PATH_ADMIN_ROOT . 'new-content'; ?>"><span class="fa fa-pencil" role="icon"></span><?php echo ucwords( $L->get( 'Compose' ) ); ?></a>
			</li>

			<li>
				<a class="nav-link" href="<?php echo HTML_PATH_ADMIN_ROOT . 'content'; ?>"><span class="fa fa-thumb-tack" role="icon"></span><?php echo $loop; ?></a>
			</li>

			<li>
				<a class="nav-link" href="<?php echo HTML_PATH_ADMIN_ROOT . 'content#static'; ?>"><span class="fa fa-file" role="icon"></span><?php $L->p( 'Static' ); ?></a>
			</li>

			<?php if ( checkRole( [ 'admin' ], false ) ) : ?>
			<li>
				<a class="nav-link" href="<?php echo HTML_PATH_ADMIN_ROOT . 'categories'; ?>"><span class="fa fa-folder" role="icon" style="transform: rotate(-90deg) translateX(-2px);"></span><?php $L->p( 'Categories' ); ?></a>
				<a class="nav-link icon-link" href="<?php echo HTML_PATH_ADMIN_ROOT . 'new-category'; ?>"><span class="fa fa-plus" role="icon"></span><span class="screen-reader-text"><?php $L->p( 'Add Category' ); ?></span></a>
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
				<a class="nav-link" href="<?php echo HTML_PATH_ADMIN_ROOT . 'settings'; ?>"><span class="fa fa-gear" role="icon"></span><?php $L->p( 'Settings' ); ?></a>
			</li>
			<?php endif; ?>

			<?php if ( checkRole( [ 'admin' ], false ) ) : ?>
			<li>
				<a class="nav-link" href="<?php echo HTML_PATH_ADMIN_ROOT . 'users'; ?>"><span class="fa fa-users" role="icon"></span><?php $L->p( 'Users' ); ?></a>
				<a class="nav-link icon-link" href="<?php echo HTML_PATH_ADMIN_ROOT . 'new-user'; ?>"><span class="fa fa-plus" role="icon"></span><span class="screen-reader-text"><?php $L->p( 'Add User' ); ?></span></a>
			</li>
			<?php endif; ?>

			<?php if ( checkRole( [ 'admin' ], false ) ) : ?>
			<li>
				<a class="nav-link" href="<?php echo HTML_PATH_ADMIN_ROOT . 'plugins'; ?>"><span class="fa fa-plug" role="icon"></span><?php $L->p( 'Plugins' ); ?></a>
				<a class="nav-link icon-link" href="<?php echo HTML_PATH_ADMIN_ROOT . 'plugins-position'; ?>"><span class="fa fa-arrows-v" role="icon"></span><span class="screen-reader-text"><?php $L->p( 'Sort Plugins' ); ?></span></a>
			</li>
			<?php endif; ?>

			<?php if ( checkRole( [ 'admin' ], false ) ) : ?>
			<li>
				<a class="nav-link" href="<?php echo HTML_PATH_ADMIN_ROOT . 'themes'; ?>"><span class="fa fa-desktop" role="icon"></span><?php $L->p( 'Themes' ); ?></a>
			</li>
			<?php endif; ?>

			<?php
			if (
				checkRole( [ 'admin' ], false ) &&
				$theme_plugin
			) : ?>
			<li>
				<a class="nav-link" href="<?php echo HTML_PATH_ADMIN_ROOT . 'configure-plugin/' . $theme_options['directoryName']; ?>"><span class="fa fa-paint-brush" role="icon"></span><?php $L->p( 'Options' ); ?></a>
			</li>
			<?php endif; ?>

			<?php if ( checkRole( [ 'admin' ], false ) ) : ?>
			<li>
				<a class="nav-link" href="<?php echo HTML_PATH_ADMIN_ROOT . '/'; ?>"><span class="fa fa-gear" role="icon"></span><?php $L->p( 'Admin' ); ?></a>
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
