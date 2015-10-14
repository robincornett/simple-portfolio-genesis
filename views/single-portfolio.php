<?php

add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

add_action( 'get_header', 'simpleportfoliogenesis_maybe_do_sidebar' );
function simpleportfoliogenesis_maybe_do_sidebar() {
	$link  = simpleportfoliogenesis_portfolio_link();
	$tools = simpleportfoliogenesis_portfolio_tools();
	if ( ! $link && ! $tools ) {
		return;
	}
	add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_content_sidebar' );
	remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
	add_action( 'genesis_before_content', 'genesis_do_post_title', 15 );
	remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );
	add_action( 'genesis_sidebar', 'simpleportfoliogenesis_do_portfolio_sidebar' );
}

add_action( 'genesis_before_content', 'simpleportfoliogenesis_do_portfolio_image' );
function simpleportfoliogenesis_do_portfolio_image() {
	$image = simpleportfoliogenesis_portfolio_image();
	if ( $image ) {
		printf( '<img src="%s" class="aligncenter" />', esc_url( $image ) );
	}
}

function simpleportfoliogenesis_do_portfolio_sidebar() {
	$link = simpleportfoliogenesis_portfolio_link();
	if ( $link ) {
		printf( '<a class="button wide" target="_blank" href="%s">%s</a>', esc_url( simpleportfoliogenesis_portfolio_link() ), esc_attr__( 'visit this project', 'simple-portfolio-genesis' ) );
	}
	$tools = simpleportfoliogenesis_portfolio_tools();
	if ( $tools ) {
		printf( '<section class="widget toolbox">%s</section>', wp_kses_post( $tools ) );
	}
	$post_meta = get_the_term_list( get_the_ID(), 'portfolio_category', 'work: ', ' | ', '' );
	if ( $post_meta ) {
		printf( '<p class="entry-meta">%s</p>', wp_kses_post( $post_meta ) );
	}
}

function simpleportfoliogenesis_portfolio_link() {
	$link = get_post_meta( get_the_ID(), '_simpleportfoliogenesis_link', true );
	return $link ? $link : false;
}

function simpleportfoliogenesis_portfolio_image() {
	$image = get_post_meta( get_the_ID(), '_simpleportfoliogenesis_image', true );
	if ( ! $image ) {
		return false;
	}
	return $image;
}

function simpleportfoliogenesis_portfolio_tools() {
	$entries = get_post_meta( get_the_ID(), '_simpleportfoliogenesis_group', true );
	if ( ! $entries ) {
		return;
	}
	$content  = sprintf( '<h2>%s</h2>', __( 'Toolbox:', 'simple-portfolio-genesis' ) );
	$content .= '<ul>';
	foreach ( (array) $entries as $entry ) {
		$content .= '<li>';
		$content .= isset( $entry['link'] ) ? sprintf( '<a href="%s" target="_blank">', $entry['link'] ) : '';
		$content .= isset( $entry['title'] ) ? $entry['title'] : $entry['link'];
		$content .= isset( $entry['link'] ) ? '</a>' : '';
		$content .= '</li>';
	}
	$content .= '</ul>';
	$content .= sprintf( '<p class="entry-meta">%s</p>', __( '* affliate link', 'simple-portfolio-genesis' ) );
	return $content;
}

genesis();
