<?php

class SimplePortfolioGenesis_CustomFields {

	protected $prefix = '_simpleportfoliogenesis_';

	/**
	 * Register the portfolio post type metabox
	 * @return CMB2 metabox
	 */
	public function register_metabox() {

		$portfolio_metabox = new_cmb2_box( array(
			'id'           => $this->prefix . 'fields',
			'title'        => __( 'Portfolio Fields', 'simple-portfolio-genesis' ),
			'object_types' => array( 'portfolio' ),
			'context'      => 'normal',
			'priority'     => 'high',
		) );

		$this->define_fields( $portfolio_metabox );
		$this->define_group_fields( $portfolio_metabox );
	}

	/**
	 * Define metabox fields
	 * @param  string $box portfolio_metabox
	 * @return array      fields for portfolio post type
	 */
	protected function define_fields( $box ) {
		$fields = apply_filters( 'simpleportfoliogenesis_customfields', array(
			array(
				'name'      => __( 'Project Link', 'simple-portfolio-genesis' ),
				'id'        => 'link',
				'type'      => 'text_url',
				'protocols' => array( 'http', 'https' ),
			),
			array(
				'name' => __( 'Project Image', 'simple-portfolio-genesis' ),
				'id'   => 'image',
				'type' => 'file',
			),
			array(
				'name'    => __( 'Tools', 'simple-portfolio-genesis' ),
				'id'      => 'group',
				'type'    => 'group',
				'options' => array(
					'group_title'   => __( 'Tool', 'simple-portfolio-genesis' ),
					'add_button'    => __( 'Add Another Tool', 'simple-portfolio-genesis' ),
					'remove_button' => __( 'Remove Tool', 'simple-portfolio-genesis' ),
				),
				'repeatable' => true,
			),
		) );
		$this->register_fields( $fields, $box );
	}

	/**
	 * Register CMB2 fields
	 * @param  array $fields all metabox fields
	 * @param  string $box    portfolio_metabox
	 * @return CMB2 metabox
	 */
	protected function register_fields( $fields, $box ) {
		foreach ( $fields as $field ) {
			$box->add_field( array(
				'name'       => $field['name'],
				'id'         => $this->prefix . $field['id'],
				'type'       => $field['type'],
				'protocols'  => isset( $field['protocols'] ) ? $field['protocols'] : '',
				'repeatable' => isset( $field['repeatable'] ) ? true : false,
				'options'    => isset( $field['options'] ) ? $field['options'] : '',
			) );
		}
	}

	/**
	 * Define group/repeating fields
	 * @param  string $box portfolio_metabox
	 * @return array      all fields for the group metabox
	 */
	protected function define_group_fields( $box ) {
		$group_fields = apply_filters( 'simpleportfoliogenesis_groupfields', array(
			array(
				'name' => __( 'Name', 'simple-portfolio-genesis' ),
				'id'   => 'title',
				'type' => 'text',
			),
			array(
				'name' => __( 'Link', 'simple-portfolio-genesis' ),
				'id'   => 'link',
				'type' => 'text_url',
			),
		) );
		$this->register_group_fields( $group_fields, $box );
	}

	/**
	 * Register fields for the group metabox
	 * @param  array $fields fields defined above
	 * @param  string $box    portfolio_metabox
	 * @return all registered fields
	 */
	protected function register_group_fields( $fields, $box ) {
		foreach ( $fields as $field ) {
			$box->add_group_field( $this->prefix . 'group', array(
				'name'       => $field['name'],
				'id'         => $field['id'],
				'type'       => $field['type'],
				'protocols'  => isset( $field['protocols'] ) ? $field['protocols'] : '',
				'repeatable' => isset( $field['repeatable'] ) ? true : false,
				'options'    => isset( $field['options'] ) ? $field['options'] : '',
			) );
		}
	}

	/**
	 * Inline CSS for CMB2 fields
	 */
	public function admin_css() {
		$screen = get_current_screen();
		if ( 'portfolio' !== $screen->post_type ) {
			return;
		} ?>

		<style type="text/css">
		@media only screen and (min-width: 799px) {
			.cmb2-id--simpleportfoliogenesis-group-0-title,
			.cmb2-id--simpleportfoliogenesis-group-0-link { float: left; width: 49%; margin-right: 1% !important; }
			.cmb2-id--simpleportfoliogenesis-group-0-title .cmb-th,
			.cmb2-id--simpleportfoliogenesis-group-0-link .cmb-th { width: 100% !important; }
			.cmb2-id--simpleportfoliogenesis-group-0-title .cmb-td,
			.cmb2-id--simpleportfoliogenesis-group-0-link .cmb-td { clear: both; width: 100% !important; }
		}
		</style> <?php
	}
}
