<?php
/**
 * Custom portfolio post type
 *
 * @package   SimplePortfolioGenesis
 * @author    Robin Cornett <hello@robincornett.com>
 * @license   GPL-2.0+
 * @link      http://robincornett.com
 * @copyright 2015 Robin Cornett Creative, LLC
 *
 * Plugin Name:       Simple Portfolio for Genesis
 * Plugin URI:        http://robincornett.com
 * Description:       This sets up a simple portfolio CPT with tags.
 * Author:            Robin Cornett
 * Author URI:        http://robincornett.com
 * Text Domain:       simple-portfolio-genesis
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Version:           1.0.0
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Include classes
function simpleportfoliogenesis_require() {
	$files = array(
		'class-simpleportfoliogenesis',
		'class-simpleportfoliogenesis-customfields',
		'class-simpleportfoliogenesis-posttype',
	);

	foreach ( $files as $file ) {
		require plugin_dir_path( __FILE__ ) . 'includes/' . $file . '.php';
	}
}
simpleportfoliogenesis_require();

$simpleportfoliogenesis_customfields = new SimplePortfolioGenesis_CustomFields();
$simpleportfoliogenesis_posttype     = new SimplePortfolioGenesis_PostType();

$simpleportfoliogenesis = new SimplePortfolioGenesis(
	$simpleportfoliogenesis_customfields,
	$simpleportfoliogenesis_posttype
);

// Run the plugin
$simpleportfoliogenesis->run();
