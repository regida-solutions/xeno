<?php
/**
 * Run all body classes.
 *
 * @package Xeno
 */

declare( strict_types=1 );

namespace Xeno\Setup\BodyClasses;

add_filter( 'body_class', __NAMESPACE__ . '\\add_body_classes' );

/**
 * Add body classes.
 *
 * @param  array $classes Body classes.
 * @return array
 */
function add_body_classes( array $classes ): array {
	return array_merge( $classes, get_body_classes() );
}

/**
 * Get body classes.
 *
 * @return array
 */
function get_body_classes(): array {

	$id = get_the_ID();

	$reset_top_space    = get_post_meta( $id, '_reset_page_top_space', true );
	$reset_bottom_space = get_post_meta( $id, '_reset_page_bottom_space', true );
	$use_sticky         = get_theme_mod( 'use_sticky', false );
	$sticky_position    = get_theme_mod( 'sticky_position', 'header' );

	$classes = [];

	// Reset vertical spacing.
	if ( $reset_top_space && '' !== $reset_top_space ) {
			$classes[] = 'reset-page-top-space';
	}

	if ( $reset_bottom_space && '' !== $reset_bottom_space ) {
			$classes[] = 'reset-page-bottom-space';
	}

	if ( $use_sticky ) {
		$classes[] = 'has-sticky';
	}

	if ( 'under_header' === $sticky_position ) {
		$classes[] = 'has-under-header-sticky';
	}

	return $classes;
}
