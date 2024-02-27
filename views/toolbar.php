<?php
/**
 * User toolbar
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

// View page link.
$view_slug = '';
$view_page = '';
if ( str_contains( $url->slug(), 'edit-content' ) ) {
	$view_slug = str_replace( 'edit-content/', '', $url->slug() );
	$view_page = DOMAIN_BASE . $view_slug;
}

$view_text = '';
if ( str_contains( $url->slug(), 'edit-content' ) ) {
	$view_text = ( $page->isStatic() ? $L->get( 'View Page' ) : $L->get( 'View Post' ) );
}

// Get a username or fallback.
$user = new User( Session :: get( 'username' ) );
$name = $L->get( 'profile-link-default' );

if ( $user->nickname() ) {
	$name = $user->nickname();
} elseif ( $user->firstName() ) {
	$name = $user->firstName();
}

// User avatar & profile link.
if ( $user->profilePicture() ) {
	$avatar  = $user->profilePicture();
	$profile = sprintf(
		'%sedit-user/%s',
		DOMAIN_ADMIN,
		Session :: get( 'username' )
	);
} else {
	$avatar  = DOMAIN_THEME . 'assets/images/avatar-default.png';
	$profile = sprintf(
		'%sedit-user/%s#picture',
		DOMAIN_ADMIN,
		Session :: get( 'username' )
	);
}

?>
<section id="admin-toolbar" class="admin-toolbar" data-admin-user-toolbar>
	<nav class="admin-toolbar-nav toolbar-user-action">
		<ul class="admin-toolbar-nav-list">
			<li class="top-level-item">
				<a href="<?php echo DOMAIN_BASE; ?>" title="<?php $L->p( 'View Site' ); ?>">
					<?php svg_icon( 'house' ); ?><?php $L->p( 'Site' ); ?>
				</a>
			</li>

			<?php if ( checkRole( [ 'admin' ], false ) ) : ?>
			<li class="top-level-item has-submenu">
				<a href="<?php echo DOMAIN_ADMIN . 'dashboard'; ?>"><?php svg_icon( 'gauge' ); $L->p( 'Admin' ); ?><?php svg_icon( 'angle-down' ); ?></a>

				<ul>
					<li>
						<a href="<?php echo DOMAIN_ADMIN . 'dashboard'; ?>"><?php $L->p( 'Dashboard' ); ?></a>
					</li>
					<li>
						<a href="<?php echo DOMAIN_ADMIN . 'about';?>"><?php $L->p( 'System' ); ?></a>
					</li>

					<li>
						<a href="<?php echo DOMAIN_ADMIN . 'developers';?>"><?php $L->p( 'Server' ); ?></a>
					</li>
				</ul>
			</li>
			<?php else : ?>
			<li>
				<a href="<?php echo DOMAIN_ADMIN . 'dashboard'; ?>"><?php $L->p( 'Dashboard' ); ?></a>
			</li>
			<?php endif; ?>

			<li class="top-level-item has-submenu">
				<a href="<?php echo DOMAIN_ADMIN . 'content';?>"><?php svg_icon( 'file' ); ?><?php $L->p( 'Content' ); ?><?php svg_icon( 'angle-down' ); ?></a>

				<ul>
					<li>
						<a href="<?php echo DOMAIN_ADMIN . 'new-content'; ?>"><?php echo ucwords( $L->get( 'Compose' ) ); ?></a>
					</li>

					<li>
						<a href="<?php echo DOMAIN_ADMIN . 'content'; ?>"><?php $L->p( 'Pages' ); ?></a>
					</li>

					<?php if ( checkRole( [ 'admin' ], false ) ) : ?>
					<li>
						<a href="<?php echo DOMAIN_ADMIN . 'categories'; ?>"><?php $L->p( 'Categories' ); ?></a>
					</li>
					<?php endif; ?>

					<?php if ( str_contains( $url->slug(), 'edit-content' ) ) : ?>
					<li class="top-level-item">
						<a href="<?php echo $view_page; ?>"><?php echo $view_text; ?></a>
					</li>
					<?php endif; ?>
				</ul>
			</li>

			<?php if ( str_contains( $url->slug(), 'edit-content' ) ) : ?>
			<li class="top-level-item">
				<a href="<?php echo $view_page; ?>"><?php echo $view_text; ?></a>
			</li>
			<?php endif; ?>

			<?php if ( checkRole( [ 'admin' ], false ) ) : ?>
			<li class="top-level-item has-submenu">
				<a href="<?php echo DOMAIN_ADMIN . 'settings'; ?>"><?php svg_icon( 'gear' ); ?><?php $L->p( 'Manage' ); ?><?php svg_icon( 'angle-down' ); ?></a>

				<ul>
					<?php if ( checkRole( [ 'admin' ], false ) ) : ?>
					<li>
						<a href="<?php echo DOMAIN_ADMIN . 'settings'; ?>"><?php $L->p( 'Settings' ); ?></a>
					</li>
					<?php endif; ?>

					<?php if ( checkRole( [ 'admin' ], false ) ) : ?>
					<li>
						<a href="<?php echo DOMAIN_ADMIN . 'users'; ?>"><?php $L->p( 'Users' ); ?></a>
					</li>
					<?php endif; ?>

					<?php if ( checkRole( [ 'admin' ], false ) ) : ?>
					<li>
						<a href="<?php echo DOMAIN_ADMIN . 'plugins'; ?>"><?php $L->p( 'Plugins' ); ?></a>
					</li>
					<?php endif; ?>

					<?php if ( checkRole( [ 'admin' ], false ) ) : ?>
					<li>
						<a href="<?php echo DOMAIN_ADMIN . 'themes'; ?>"><?php $L->p( 'Themes' ); ?></a>
					</li>
					<?php endif; ?>

					<?php
					if (
						checkRole( [ 'admin' ], false ) &&
						plugin()
					) : ?>
					<li>
						<a href="<?php echo DOMAIN_ADMIN . 'configure-plugin/' . plugin()->className(); ?>"><?php $L->p( 'Options' ); ?></a>
					</li>
					<?php endif; ?>
				</ul>
			</li>
			<?php endif; ?>
			<?php if ( checkRole( [ 'admin' ], false ) ) : ?>
			<li class="top-level-item has-submenu">
				<a href="<?php echo DOMAIN_ADMIN . 'plugin/' . plugin()->className(); ?>"><?php svg_icon( 'book-open' ); ?><?php $L->p( 'Help' ); ?><?php svg_icon( 'angle-down' ); ?></a>

				<ul>
					<li>
						<a href="<?php echo DOMAIN_ADMIN . 'plugin/' . plugin()->className(); ?>"><?php $L->p( 'Theme Guide' ); ?></a>
					</li>
					<li>
						<a href="<?php echo DOMAIN_ADMIN . 'plugin/' . plugin()->className() . '?page=colors'; ?>"><?php $L->p( 'Colors Reference' ); ?></a>
					</li>
					<li>
						<a href="<?php echo DOMAIN_ADMIN . 'plugin/' . plugin()->className() . '?page=fonts'; ?>"><?php $L->p( 'Fonts Reference' ); ?></a>
					</li>
					<li>
						<a href="<?php echo DOMAIN_ADMIN . 'plugin/' . plugin()->className() . '?page=database'; ?>"><?php $L->p( 'Options Database' ); ?></a>
					</li>
				</ul>
			</li>
			<?php endif; ?>
			<?php
			if (
				checkRole( [ 'admin', 'editor' ], false ) &&
				plugin_sidebars_count() > 0
			) : ?>
			<li class="top-level-item has-submenu">
				<a class="nav-link" href="<?php echo DOMAIN_ADMIN . 'settings'; ?>"><?php svg_icon( 'banner-v' ); ?><?php $L->p( 'Features' ); ?><?php svg_icon( 'angle-down' ); ?></a>
				<ul>
					<?php
					foreach ( $plugins['adminSidebar'] as $link ) {
						if ( 'theme' != $link->type() ) {
							printf(
								'<li>%s</li>',
								$link->adminSidebar()
							);
						}
					} ?>
				</ul>
			</li>
			<?php endif; ?>
		</ul>
	</nav>
	<nav class="admin-toolbar-nav toolbar-user-info">
		<ul class="admin-toolbar-nav-list">
			<li class="top-level-item has-submenu">
				<a id="profile-link" href="<?php echo $profile; ?>">
					<img class="avatar user-avatar user toolbar-avatar admin-toolbar-avatar" src="<?php echo $avatar; ?>" width="24"> <span><?php echo $name; ?></span>
				</a>

				<ul class="user-actions-sublist">
					<li>
						<a href="<?php echo DOMAIN_ADMIN . 'edit-user/' . $login->username(); ?>"><?php $L->p( 'Your Profile' ); ?></a>
					</li>

					<li>
						<a id="toolbar-logout" href="<?php echo DOMAIN_ADMIN . 'logout'; ?>"><?php $L->p( 'Log Out' ); ?></a>
					</li>
				</ul>
			</li>
		</ul>
	</nav>
</section>
