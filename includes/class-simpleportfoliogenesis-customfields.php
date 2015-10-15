<?php

class SimplePortfolioGenesis_CustomFields {

	protected $prefix = '_simpleportfoliogenesis_';

	function register_fields() {

		$portfolio_metabox = new_cmb2_box( array(
			'id'           => $this->prefix . 'fields',
			'title'        => __( 'Portfolio Fields', 'simple-portfolio-genesis' ),
			'object_types' => array( 'portfolio' ),
			'context'      => 'normal',
			'priority'     => 'high',
		) );

		$fields = $this->add_fields();

		foreach ( $fields as $field ) {
			$portfolio_metabox->add_field( array(
				'name'       => $field['name'],
				'id'         => $this->prefix . $field['id'],
				'type'       => $field['type'],
				'protocols'  => isset( $field['protocols'] ) ? $field['protocols'] : '',
				'repeatable' => isset( $field['repeatable'] ) ? true : false,
				'options'    => isset( $field['options'] ) ? $field['options'] : '',
			) );
		}

		$group_fields = $this->add_group_fields();

		foreach ( $group_fields as $field ) {
			$portfolio_metabox->add_group_field( $this->prefix . 'group', array(
				'name'       => $field['name'],
				'id'         => $field['id'],
				'type'       => $field['type'],
				'protocols'  => isset( $field['protocols'] ) ? $field['protocols'] : '',
				'repeatable' => isset( $field['repeatable'] ) ? true : false,
				'options'    => isset( $field['options'] ) ? $field['options'] : '',
			) );
		}
	}

	protected function add_fields() {
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
			),
		) );
		return $fields;
	}

	protected function add_group_fields() {
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
		return $group_fields;
	}

	public function admin_css() {
		$screen = get_current_screen();
		if ( 'portfolio' === $screen->post_type ) { ?>
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
}
