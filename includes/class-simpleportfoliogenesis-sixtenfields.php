<?php

class SimplePortfolioGenesisSixTenFields extends SixTenPressCustomFields {

	protected $post_type = 'portfolio';

	protected $prefix = '_simpleportfoliogenesis';

	protected $key = 'simpleportfoliogenesis';

	protected $type = 'single';

	public function get_metaboxes() {
		return array(
			array(
				'name'  => 'simpleportfoliogenesis',
				'label' => __( 'Portfolio Fields', 'simple-portfolio-genesis' ),
			),
		);
	}

	public function get_fields() {
		return array(
			array(
				'label'   => __( 'Project Link', 'simple-portfolio-genesis' ),
				'setting' => 'link',
				'type'    => 'text',
				'format'  => 'url',
			),
			array(
				'label'   => __( 'Project Image', 'simple-portfolio-genesis' ),
				'setting' => 'image',
				'type'    => 'file',
				'library' => array( 'image' ),
			),
			array(
				'setting'    => 'group',
				'label'      => __( 'Tools', 'simple-portfolio-genesis' ),
				'group'      => $this->tools(),
				'repeatable' => true,
				'type'       => 'group',
			),
		);
	}

	protected function tools() {
		return apply_filters( 'simpleportfoliogenesis_groupfields', array(
			array(
				'label'   => __( 'Name', 'simple-portfolio-genesis' ),
				'setting' => 'title',
				'type'    => 'text',
				'row'     => 'one-half first odd',
			),
			array(
				'label'   => __( 'Link', 'simple-portfolio-genesis' ),
				'setting' => 'link',
				'type'    => 'text',
				'format'  => 'url',
				'row'     => 'one-half',
			),
		) );
	}
}
