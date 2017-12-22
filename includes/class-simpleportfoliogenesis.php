<?php

class SimplePortfolioGenesis {

	public function __construct( $customfields, $post_type ) {
		$this->customfields = $customfields;
		$this->post_type    = $post_type;
	}

	public function run() {
		add_action( 'init', array( $this->post_type, 'register' ) );
		add_action( 'after_setup_theme', array( $this->post_type, 'load_templates' ) );
		add_action( 'pre_get_posts', array( $this->post_type, 'portfolio_number_posts' ), 9999 );

		add_action( 'sixtenpress_load_fields', array( $this, 'load_fields' ) );
		add_action( 'cmb2_init', array( $this->customfields, 'register_metabox' ) );
		add_action( 'admin_enqueue_scripts', array( $this->customfields, 'admin_css' ) );

		add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );
		add_filter( 'display_featured_image_genesis_skipped_posttypes', array( $this, 'skip_portfolio_image' ) );

		add_image_size( 'simpleportfolio', 440, 330, true );
	}

	/**
	 * Load the 6/10 Press custom fields.
	 */
	public function load_fields() {
		include_once plugin_dir_path( __FILE__ ) . 'class-simpleportfoliogenesis-sixtenfields.php';
		$custom_fields = new SimplePortfolioGenesisSixTenFields();
	}

	/**
	 * Set up text domain for translations
	 *
	 * @since 1.0.0
	 */
	public function load_textdomain() {
		load_plugin_textdomain( 'simple-portfolio-genesis', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}

	public function skip_portfolio_image( $post_type ) {
		$post_type[] = is_singular( 'portfolio' );
		return $post_type;
	}
}
