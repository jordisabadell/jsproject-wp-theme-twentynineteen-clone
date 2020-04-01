<?php
/**
 * Twenty Nineteen Clone back compat functionality
 *
 * Prevents Twenty Nineteen Clone from running on WordPress versions prior to 4.7,
 * since this theme is not meant to be backward compatible beyond that and
 * relies on many newer functions and markup changes introduced in 4.7.
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen_Clone
 * @since Twenty Nineteen Clone 1.0.0
 */

/**
 * Prevent switching to Twenty Nineteen Clone on old versions of WordPress.
 *
 * Switches to the default theme.
 *
 * @since Twenty Nineteen Clone 1.0.0
 */
function twentynineteenclone_switch_theme() {
	switch_theme( WP_DEFAULT_THEME );
	unset( $_GET['activated'] );
	add_action( 'admin_notices', 'twentynineteenclone_upgrade_notice' );
}
add_action( 'after_switch_theme', 'twentynineteenclone_switch_theme' );

/**
 * Adds a message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * Twenty Nineteen Clone on WordPress versions prior to 4.7.
 *
 * @since Twenty Nineteen Clone 1.0.0
 *
 * @global string $wp_version WordPress version.
 */
function twentynineteenclone_upgrade_notice() {
	/* translators: %s: WordPress version. */
	$message = sprintf( __( 'Twenty Nineteen Clone requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'twentynineteenclone' ), $GLOBALS['wp_version'] );
	printf( '<div class="error"><p>%s</p></div>', $message );
}

/**
 * Prevents the Customizer from being loaded on WordPress versions prior to 4.7.
 *
 * @since Twenty Nineteen Clone 1.0.0
 *
 * @global string $wp_version WordPress version.
 */
function twentynineteenclone_customize() {
	wp_die(
		sprintf(
			/* translators: %s: WordPress version. */
			__( 'Twenty Nineteen Clone requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'twentynineteenclone' ),
			$GLOBALS['wp_version']
		),
		'',
		array(
			'back_link' => true,
		)
	);
}
add_action( 'load-customize.php', 'twentynineteenclone_customize' );

/**
 * Prevents the Theme Preview from being loaded on WordPress versions prior to 4.7.
 *
 * @since Twenty Nineteen Clone 1.0.0
 *
 * @global string $wp_version WordPress version.
 */
function twentynineteenclone_preview() {
	if ( isset( $_GET['preview'] ) ) {
		/* translators: %s: WordPress version. */
		wp_die( sprintf( __( 'Twenty Nineteen Clone requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'twentynineteenclone' ), $GLOBALS['wp_version'] ) );
	}
}
add_action( 'template_redirect', 'twentynineteenclone_preview' );
