<?php
/**
 * Archive for Portfolio Post Type.
 */

add_filter( 'post_class', 'simpleportfoliogenesis_portfolio_post_class' );
function simpleportfoliogenesis_portfolio_post_class( $classes ) {
	global $wp_query;

	if ( ! $wp_query->is_main_query() ) {
		return $classes;
	}

	$number       = 3;
	$column_class = 'one-third';
	$classes[]    = 'grid ' . $column_class;

	if ( 0 === $wp_query->current_post % $number ) {
		$classes[] = 'first';
	}
	if ( ( $wp_query->current_post + 1 ) % 2 ) {
		$classes[] = 'odd';
	}

	return $classes;
}

remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
remove_action( 'genesis_entry_content', 'genesis_do_post_content' );

// Move Title below Image
remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );
add_action( 'genesis_entry_header', 'simpleportfoliogenesis_archive_images', 5 );
function simpleportfoliogenesis_archive_images() {
	$image = genesis_get_image( 'format=url&size=simpleportfolio' );
	if ( ! $image ) {
		$image = get_stylesheet_directory() . '/images/blank.jpg';
	}
	$project_link = get_post_meta( get_the_ID(), '_simpleportfoliogenesis_link', true );
	$permalink    = get_permalink();
	$content      = get_the_content();
	$link         = empty( $content ) && $project_link ? $project_link : null;
	$output       = '';
	if ( $link ) {
		$output = sprintf( '<a href="%s" rel="bookmark" target="_blank">', $link );
	} elseif ( $content ) {
		$output = sprintf( '<a href="%s" rel="bookmark">', $permalink );
	}
	if ( $image ) {
		$output .= sprintf( '<img src="%s" alt="%s" class="aligncenter" />', $image, the_title_attribute( 'echo=0' ) );
	}
	if ( $content || $link ) {
		$output .= '</a>';
	}

	echo wp_kses_post( $output );
}

genesis();
