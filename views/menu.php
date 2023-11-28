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
	menu_link,
	svg_icon,
	plugin_sidebars_count
};

// View page link.
$view_slug = '';
$view_page = '';
if ( str_contains( $url->slug(), 'edit-content' ) ) {
	$view_slug = str_replace( 'edit-content/', '', $url->slug() );
	$view_page = DOMAIN_BASE . $view_slug;
}

?>
<nav>
	<ul class="admin-menu-list nav flex-column">

		<li class="admin-menu-item menu-heading">
			<h3><a class="nav-link" href="<?php echo DOMAIN_ADMIN . 'dashboard'; ?>"><?php $L->p( 'Admin' ); ?></a></h3>
		</li>

		<ul>
			<li class="admin-menu-item has-icon-link">
				<?php menu_link( 'dashboard' ); ?><?php svg_icon( 'gauge' ); ?><?php $L->p( 'Dashboard' ); ?></a>

				<?php if ( checkRole( [ 'admin' ], false ) ) : ?>
					<?php menu_link( 'developers', 'icon-link' ); ?><?php svg_icon( 'info' ); ?><span class="screen-reader-text"><?php $L->p( 'System Info' ); ?></span></a>
				<?php endif; ?>
			</li>

			<li class="admin-menu-item">
				<?php menu_link( 'edit-user/' . $login->username() ); ?><?php svg_icon( 'id-tag' ); ?><?php $L->p( 'Your Profile' ); ?></a>
			</li>

			<li class="admin-menu-item has-icon-link">
				<a class="nav-link" href="<?php echo DOMAIN_BASE; ?>"><?php svg_icon( 'house' ); ?><?php $L->p( 'View Site' ); ?></a>

				<a class="nav-link icon-link" href="<?php echo DOMAIN_BASE; ?>" target="_blank"><?php svg_icon( 'external-link' ); ?><span class="screen-reader-text"><?php $L->p( 'View Site in New Tab' ); ?></span></a>
			</li>
		</ul>

		<?php if ( checkRole( [ 'admin' ], false ) ) : ?>
		<li class="admin-menu-item menu-heading">
			<h3><a class="nav-link" href="<?php echo DOMAIN_ADMIN . 'content'; ?>"><?php $L->p( 'Content' ); ?></a></h3>
		</li>
		<?php endif; ?>

		<ul>
			<?php if ( str_contains( $url->slug(), 'edit-content' ) ) : ?>
			<li class="admin-menu-item has-icon-link">
				<a href="<?php echo $view_page; ?>"><?php svg_icon( 'screen' ); ?><?php $L->p( 'View Page' ); ?></a>

				<a class="nav-link icon-link" href="<?php echo $view_page; ?>" target="_blank"><?php svg_icon( 'external-link' ); ?><span class="screen-reader-text"><?php $L->p( 'View Page in New Tab' ); ?></span></a>
			</li>
			<?php endif; ?>

			<li class="admin-menu-item">
				<?php menu_link( 'new-content' ); ?><?php svg_icon( 'pencil' ); ?><?php echo ucwords( $L->get( 'Compose' ) ); ?></a>
			</li>

			<li class="admin-menu-item">
				<?php menu_link( 'content' ); ?><?php svg_icon( 'file' ); ?><?php $L->p( 'Pages' ); ?></a>
			</li>

			<?php if ( checkRole( [ 'admin' ], false ) ) : ?>
			<li class="admin-menu-item has-icon-link">
				<?php menu_link( 'categories' ); ?><?php svg_icon( 'folder' ); ?><?php $L->p( 'Categories' ); ?></a>
				<?php menu_link( 'new-category', 'icon-link' ); ?><?php svg_icon( 'plus' ); ?><span class="screen-reader-text"><?php $L->p( 'Add Category' ); ?></span></a>
			</li>
			<?php endif; ?>
		</ul>

		<?php if ( checkRole( [ 'admin' ], false ) ) : ?>
		<li class="admin-menu-item menu-heading">
			<h3><a class="nav-link" href="<?php echo DOMAIN_ADMIN . 'settings'; ?>"><?php $L->p( 'Manage' ); ?></a></h3>
		</li>
		<?php endif; ?>

		<ul>
			<?php if ( checkRole( [ 'admin' ], false ) ) : ?>
			<li class="admin-menu-item">
				<?php menu_link( 'settings' ); ?><?php svg_icon( 'gear' ); ?><?php $L->p( 'Settings' ); ?></a>
			</li>
			<?php endif; ?>

			<?php if ( checkRole( [ 'admin' ], false ) ) : ?>
			<li class="admin-menu-item has-icon-link">
				<?php menu_link( 'users' ); ?><?php svg_icon( 'user' ); ?><?php $L->p( 'Users' ); ?></a>
				<?php menu_link( 'new-user', 'icon-link' ); ?><?php svg_icon( 'plus' ); ?><span class="screen-reader-text"><?php $L->p( 'Add User' ); ?></span></a>
			</li>
			<?php endif; ?>

			<?php if ( checkRole( [ 'admin' ], false ) ) : ?>
			<li class="admin-menu-item has-icon-link">
				<?php menu_link( 'plugins' ); ?><?php svg_icon( 'plug' ); ?><?php $L->p( 'Plugins' ); ?></a>
				<?php menu_link( 'plugins-position', 'icon-link' ); ?><?php svg_icon( 'arrows-v' ); ?><span class="screen-reader-text"><?php $L->p( 'Sort Plugins' ); ?></span></a>
			</li>
			<?php endif; ?>

			<?php if ( checkRole( [ 'admin' ], false ) ) : ?>
			<li class="admin-menu-item">
				<?php menu_link( 'themes' ); ?><?php svg_icon( 'paint-roller' ); ?><?php $L->p( 'Themes' ); ?></a>
			</li>
			<?php endif; ?>

			<?php
			if (
				checkRole( [ 'admin' ], false ) &&
				plugin()
			) : ?>
			<li class="admin-menu-item">
				<?php menu_link( 'configure-plugin/' . plugin()->className() ); ?><?php svg_icon( 'paint-brush' ); ?><?php $L->p( 'Options' ); ?></a>
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
			<h3><a class="nav-link" href="<?php echo DOMAIN_ADMIN . 'settings'; ?>"><?php $L->p( 'Features ' ); ?></a></h3>
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
