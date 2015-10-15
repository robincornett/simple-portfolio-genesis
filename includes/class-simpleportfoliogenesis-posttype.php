<?php

class SimplePortfolioGenesis_PostType {

	protected $post_type = 'portfolio';
	protected $taxonomy  = 'portfolio_category';

	public function register() {
		$this->register_post_type();
		$this->register_taxonomy();
	}

	function register_post_type() {
		$labels = array(
			'name'          => __( 'Portfolio', 'simple-portfolio-genesis' ),
			'singular_name' => __( 'Portfolio', 'simple-portfolio-genesis' ),
		);

		$supports = array(
			'title',
			'thumbnail',
			'editor',
			'excerpt',
			'genesis-cpt-archives-settings',
		);

		$post_type_args = array(
			'labels'              => $labels,
			'capability_type'     => 'page',
			'exclude_from_search' => false,
			'has_archive'         => true,
			'hierarchical'        => false,
			'menu_icon'           => 'dashicons-heart',
			'public'              => true,
			'rewrite'             => array( 'slug' => 'portfolio' ),
			'show_in_nav_menus'   => false,
			'supports'            => $supports,
		);

		register_post_type( $this->post_type, $post_type_args );

	}

	function register_taxonomy() {

		$labels = array(
			'name'                       => __( 'Portfolio Categories', 'simple-portfolio-genesis' ),
			'singular_name'              => __( 'Portfolio Category', 'simple-portfolio-genesis' ),
			'search_items'               => __( 'Search Portfolio Categories', 'simple-portfolio-genesis' ),
			'all_items'                  => __( 'All Portfolio Categories', 'simple-portfolio-genesis' ),
			'parent_item'                => __( 'Parent Portfolio Category', 'simple-portfolio-genesis' ),
			'parent_item_colon'          => __( 'Parent Portfolio Category:', 'simple-portfolio-genesis' ),
			'edit_item'                  => __( 'Edit Portfolio Category', 'simple-portfolio-genesis' ),
			'update_item'                => __( 'Update Portfolio Category', 'simple-portfolio-genesis' ),
			'add_new_item'               => __( 'Add New Portfolio Category', 'simple-portfolio-genesis' ),
			'new_item_name'              => __( 'New Portfolio Category Name', 'simple-portfolio-genesis' ),
			'separate_items_with_commas' => __( 'Separate Portfolio categories with commas', 'simple-portfolio-genesis' ),
			'add_or_remove_items'        => __( 'Add or remove Portfolio categories', 'simple-portfolio-genesis' ),
			'choose_from_most_used'      => __( 'Choose from the most used Portfolio categories', 'simple-portfolio-genesis' ),
			'menu_name'                  => __( 'Portfolio Categories', 'simple-portfolio-genesis' ),
		);

		$args = array(
			'labels'            => $labels,
			'singular_label'    => __( 'Portfolio Category', 'simple-portfolio-genesis' ),
			'public'            => true,
			'rewrite'           => array( 'slug' => 'project' ),
			'show_admin_column' => true,
			'show_in_nav_menus' => false,
			'show_ui'           => true,
			'show_tagcloud'     => true,
			'hierarchical'      => false,
		);

		register_taxonomy( $this->taxonomy, array( $this->post_type ), $args );
	}

	public function portfolio_number_posts( $query ) {
		$terms = get_object_taxonomies( $this->post_type );
		if ( ! is_admin() && $query->is_main_query() && ( is_post_type_archive( 'portfolio' ) || is_tax( $terms ) ) ) {
			$query->set( 'posts_per_page', 12 );
		}
	}

	public function load_templates() {
		$parent = basename( get_template_directory() );
		if ( 'genesis' === $parent ) {
			add_filter( 'archive_template', array( $this, 'load_archive_template' ) );
			add_filter( 'single_template', array( $this, 'load_single_template' ) );
		}
	}

	public function load_archive_template( $archive_template ) {
		$terms = get_object_taxonomies( $this->post_type );
		if ( is_post_type_archive( $this->post_type ) || is_tax( $terms ) ) {
			$archive_template = plugin_dir_path( dirname( __FILE__ ) ) . '/views/archive-' . $this->post_type . '.php';
		}
		return $archive_template;
	}

	public function load_single_template( $single_template ) {
		if ( is_singular( $this->post_type ) ) {
			$single_template = plugin_dir_path( dirname( __FILE__ ) ) . '/views/single-' . $this->post_type . '.php';
		}
		return $single_template;
	}
}
