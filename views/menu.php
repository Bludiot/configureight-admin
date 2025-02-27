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
				<?php menu_link( 'dashboard', 'gauge' ); ?><span class="admin-menu-text"><?php $L->p( 'Dashboard' ); ?></span></a>

				<?php if ( checkRole( [ 'admin' ], false ) ) : ?>
					<?php menu_link( 'developers',  'info' , 'icon-link', $L->get( 'System information' ) ); ?><span class="screen-reader-text"><?php $L->p( 'System Info' ); ?></span></a>
				<?php endif; ?>
			</li>

			<li class="admin-menu-item">
				<?php menu_link( 'edit-user/' . $login->username(), 'id-tag' ); ?><span class="admin-menu-text"><?php $L->p( 'Your Profile' ); ?></span></a>
			</li>

			<li class="admin-menu-item has-icon-link">
				<a class="nav-link" href="<?php echo DOMAIN_BASE; ?>"><?php svg_icon( 'house' ); ?><span class="admin-menu-text"><?php $L->p( 'View Site' ); ?></span></a>

				<a class="nav-link icon-link" href="<?php echo DOMAIN_BASE; ?>" target="_blank" title="<?php $L->p( 'View site in new tab' ); ?>"><?php svg_icon( 'external-link' ); ?><span class="screen-reader-text"><?php $L->p( 'View Site in New Tab' ); ?></span></a>
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
				<a href="<?php echo $view_page; ?>"><?php svg_icon( 'screen' ); ?><span class="admin-menu-text"><?php $L->p( 'View Page' ); ?></span></a>

				<a class="nav-link icon-link" href="<?php echo $view_page; ?>" target="_blank" title="<?php $L->p( 'View page in new tab' ); ?>"><?php svg_icon( 'external-link' ); ?><span class="screen-reader-text"><?php $L->p( 'View Page in New Tab' ); ?></span></a>
			</li>
			<?php endif; ?>

			<li class="admin-menu-item has-icon-link">
				<?php menu_link( 'content', 'file' ); ?><span class="admin-menu-text"><?php $L->p( 'Pages' ); ?></span></a>
				<?php menu_link( 'new-content', 'plus', 'icon-link', $L->get( 'Add new content' ) ); ?><span class="screen-reader-text"><?php $L->p( 'Add Content' ); ?></span></a>
			</li>

			<?php if ( getPlugin( 'Post_Comments' ) ) : ?>
			<?php if ( checkRole( [ 'admin' ], false ) ) : ?>
			<li class="admin-menu-item has-icon-link">
				<a class="nav-link" href="<?php echo DOMAIN_ADMIN . 'plugin/Post_Comments'; ?>"><?php svg_icon( 'comments' ); ?><span class="admin-menu-text"><?php $L->p( 'Comments' ); ?></span></a>
				<a class="nav-link icon-link" href="<?php echo DOMAIN_ADMIN . 'configure-plugin/Post_Comments'; ?>" title="<?php $L->p( 'Comments settings' ); ?>"><?php svg_icon( 'gear' ); ?><span class="screen-reader-text"><?php $L->p( 'Comments Settings' ); ?></span></a>
			</li>
			<?php endif; endif; ?>

			<?php if ( checkRole( [ 'admin' ], false ) ) : ?>
			<li class="admin-menu-item has-icon-link">
				<?php menu_link( 'categories', 'folder' ); ?><span class="admin-menu-text"><?php $L->p( 'Categories' ); ?></span></a>
				<?php menu_link( 'new-category', 'plus', 'icon-link', $L->get( 'Add new category' ) ); ?><span class="screen-reader-text"><?php $L->p( 'Add Category' ); ?></span></a>
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
				<?php menu_link( 'settings', 'gear' ); ?><span class="admin-menu-text"><?php $L->p( 'Settings' ); ?></span></a>
			</li>
			<?php endif; ?>

			<?php if ( checkRole( [ 'admin' ], false ) ) : ?>
			<li class="admin-menu-item has-icon-link">
				<?php menu_link( 'users', 'user' ); ?><span class="admin-menu-text"><?php $L->p( 'Users' ); ?></span></a>
				<?php menu_link( 'new-user', 'plus', 'icon-link', $L->get( 'Add new user' ) ); ?><span class="screen-reader-text"><?php $L->p( 'Add User' ); ?></span></a>
			</li>
			<?php endif; ?>

			<?php if ( checkRole( [ 'admin' ], false ) ) : ?>
			<li class="admin-menu-item has-icon-link">
				<?php menu_link( 'plugins', 'plug' ); ?><span class="admin-menu-text"><?php $L->p( 'Plugins' ); ?></span></a>
				<?php menu_link( 'plugins-position', 'arrows-v', 'icon-link', $L->get( 'Sort sidebar plugins' ) ); ?><span class="screen-reader-text"><?php $L->p( 'Sort Plugins' ); ?></span></a>
			</li>
			<?php endif; ?>

			<?php if ( checkRole( [ 'admin' ], false ) ) : ?>
			<li class="admin-menu-item">
				<?php menu_link( 'themes', 'paint-roller' ); ?><span class="admin-menu-text"><?php $L->p( 'Themes' ); ?></span></a>
			</li>
			<?php endif; ?>

			<?php
			if (
				checkRole( [ 'admin' ], false ) &&
				plugin()
			) : ?>
			<li class="admin-menu-item has-icon-link">
				<?php menu_link( 'configure-plugin/' . plugin()->className(), 'paint-brush' ); ?><span class="admin-menu-text"><?php $L->p( 'Options' ); ?></span></a>
				<?php menu_link( 'plugin/' . plugin()->className(), 'book-open', 'icon-link', $L->get( 'Options guide' ) ); ?><span class="screen-reader-text"><?php $L->p( 'Options Guide' ); ?></span></a>
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
