<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package schmopera
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function sch_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'footer'    => 'page',
	) );
}
add_action( 'after_setup_theme', 'sch_jetpack_setup' );
