<?php
/**
 * User toolbar
 *
 * @package    Configure 8 Admin
 * @subpackage Templates
 * @since      1.0.0
 */

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
	<nav class="user-action">
		<ul class="admin-toolbar-nav-list">
			<li>
				<a href="<?php echo DOMAIN_ADMIN;?>" target="_blank"><?php $L->p( 'Site Admin' ); ?></a>

				<ul>
					<li>
						<a href="<?php echo HTML_PATH_ADMIN_ROOT . 'dashboard'; ?>"><?php $L->p( 'Dashboard' ); ?></a>
					</li>

					<li>
						<a target="_blank" href="<?php echo HTML_PATH_ROOT; ?>"><?php $L->p( 'View Site' ); ?></a>
					</li>

					<li>
						<a href="<?php echo HTML_PATH_ADMIN_ROOT . 'edit-user/' . $login->username(); ?>"><?php $L->p( 'Your Profile' ); ?></a>
					</li>
				</ul>
			</li>

			<li>
				<a href="<?php echo DOMAIN_ADMIN . 'content';?>"><?php $L->p( 'Content' ); ?></a>

				<ul>
					<li>
						<a href="<?php echo HTML_PATH_ADMIN_ROOT . 'content'; ?>"><?php $L->p( 'Blog' ); ?></a>
					</li>

					<li>
						<a href="<?php echo HTML_PATH_ADMIN_ROOT . 'content#static'; ?>"><?php $L->p( 'Static' ); ?></a>
					</li>

					<li>
						<a href="<?php echo HTML_PATH_ADMIN_ROOT . 'new-content'; ?>"><?php echo ucwords( $L->get( 'New Content' ) ); ?></a>
					</li>

					<?php if ( checkRole( [ 'admin' ], false ) ) : ?>
					<li>
						<a href="<?php echo HTML_PATH_ADMIN_ROOT . 'categories'; ?>"></span><?php $L->p( 'Categories' ); ?></a>
					</li>
					<?php endif; ?>
				</ul>
			</li>

			<?php if ( checkRole( [ 'admin' ], false ) ) : ?>
			<li>
				<a href="<?php echo HTML_PATH_ADMIN_ROOT . 'settings'; ?>"><?php $L->p( 'Manage' ); ?></a>

				<ul>
					<?php if ( checkRole( [ 'admin' ], false ) ) : ?>
					<li>
						<a href="<?php echo HTML_PATH_ADMIN_ROOT . 'settings'; ?>"></span><?php $L->p( 'Settings' ); ?></a>
					</li>
					<?php endif; ?>

					<?php if ( checkRole( [ 'admin' ], false ) ) : ?>
					<li>
						<a href="<?php echo HTML_PATH_ADMIN_ROOT . 'users'; ?>"></span><?php $L->p( 'Users' ); ?></a>
					</li>
					<?php endif; ?>

					<?php if ( checkRole( [ 'admin' ], false ) ) : ?>
					<li>
						<a href="<?php echo HTML_PATH_ADMIN_ROOT . 'plugins'; ?>"><?php $L->p( 'Plugins' ); ?></a>
					</li>
					<?php endif; ?>

					<?php if ( checkRole( [ 'admin' ], false ) ) : ?>
					<li>
						<a href="<?php echo HTML_PATH_ADMIN_ROOT . 'themes'; ?>"></span><?php $L->p( 'Themes' ); ?></a>
					</li>
					<?php endif; ?>

					<?php
					if (
						checkRole( [ 'admin' ], false ) &&
						$theme_plugin
					) : ?>
					<li>
						<a href="<?php echo HTML_PATH_ADMIN_ROOT . 'configure-plugin/' . $theme_options['directoryName']; ?>"><?php $L->p( 'Options' ); ?></a>
					</li>
					<?php endif; ?>

					<?php if ( checkRole( [ 'admin' ], false ) ) : ?>
					<li>
						<a href="<?php echo HTML_PATH_ADMIN_ROOT . '/'; ?>"><?php $L->p( 'Admin' ); ?></a>
					</li>
					<?php endif; ?>
				</ul>
			</li>
			<?php endif; ?>
		</ul>
	</nav>
	<nav class="user-info">
		<ul class="admin-toolbar-nav-list">
			<li>
				<a id="profile-link" href="<?php echo $profile; ?>">
					<img class="avatar user-avatar user toolbar-avatar" src="<?php echo $avatar; ?>" width="24"> <span><?php echo $name; ?></span>
				</a>
			</li>

			<li>
				<a id="toolbar-logout" href="<?php echo HTML_PATH_ADMIN_ROOT . 'logout'; ?>"><?php $L->p( 'Logout' ); ?></a>
			</li>
		</ul>
	</nav>
</section>
