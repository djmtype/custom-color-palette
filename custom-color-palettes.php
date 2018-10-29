<?php
/*
Plugin Name: Custom Color Palettes
Plugin URI: https://themezee.com/plugins/custom-color-palettes/
Description: A small and simple plugin to adjust the default color palette of the new WordPress Gutenberg Editor
Author: ThemeZee
Author URI: https://themezee.com/
Version: 1.0
Text Domain: custom-color-palettes
Domain Path: /languages/
License: GPL v3
License URI: http://www.gnu.org/licenses/gpl-3.0.html

ThemeZee Custom Color Palettes
Copyright(C) 2018, ThemeZee.com - support@themezee.com

*/

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Main ThemeZee_Custom_Color_Palettes Class
 *
 * @package ThemeZee Custom Color Palettes
 */
class ThemeZee_Custom_Color_Palettes {

	/**
	 * Call all Functions to setup the Plugin
	 *
	 * @uses ThemeZee_Custom_Color_Palettes::constants() Setup the constants needed
	 * @uses ThemeZee_Custom_Color_Palettes::includes() Include the required files
	 * @uses ThemeZee_Custom_Color_Palettes::setup_actions() Setup the hooks and actions
	 * @return void
	 */
	static function setup() {

		// Setup Constants.
		self::constants();

		// Setup Translation.
		add_action( 'plugins_loaded', array( __CLASS__, 'translation' ) );

		// Include Files.
		self::includes();

		// Setup Action Hooks.
		self::setup_actions();

	}

	/**
	 * Setup plugin constants
	 *
	 * @return void
	 */
	static function constants() {

		// Define Plugin Name.
		define( 'TZCCP_NAME', 'Custom Color Palettes' );

		// Define Version Number.
		define( 'TZCCP_VERSION', '1.0' );

		// Plugin Folder Path.
		define( 'TZCCP_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

		// Plugin Folder URL.
		define( 'TZCCP_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

		// Plugin Root File.
		define( 'TZCCP_PLUGIN_FILE', __FILE__ );

	}

	/**
	 * Load Translation File
	 *
	 * @return void
	 */
	static function translation() {

		load_plugin_textdomain( 'custom-color-palettes', false, dirname( plugin_basename( TZCCP_PLUGIN_FILE ) ) . '/languages/' );

	}

	/**
	 * Include required files
	 *
	 * @return void
	 */
	static function includes() {

		// Include Settings Classes.
		#require_once TZCCP_PLUGIN_DIR . '/includes/class-tzcat-settings.php';
		#require_once TZCCP_PLUGIN_DIR . '/includes/class-tzcat-settings-page.php';

	}

	/**
	 * Setup Action Hooks
	 *
	 * @see https://codex.wordpress.org/Function_Reference/add_action WordPress Codex
	 * @return void
	 */
	static function setup_actions() {

		// Enqueue Plugin Stylesheet.
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_styles' ) );

		// Add Settings link to Plugin actions.
		add_filter( 'plugin_action_links_' . plugin_basename( TZCCP_PLUGIN_FILE ), array( __CLASS__, 'plugin_action_links' ) );

	}

	/**
	 * Enqueue Styles
	 *
	 * @return void
	 */
	static function enqueue_styles() {

		// Enqueue Color Palette Stylesheet.
		wp_enqueue_style( 'themezee-custom-color-palettes', TZCCP_PLUGIN_URL . 'assets/css/custom-color-palettes.css', array(), TZCCP_VERSION );

	}

	/**
	 * Add Settings link to the plugin actions
	 *
	 * @return array $actions Plugin action links
	 */
	static function plugin_action_links( $actions ) {

		$settings_link = array( 'settings' => sprintf( '<a href="%s">%s</a>', admin_url( 'options-general.php?page=themezee-custom-color-palettes' ), __( 'Settings', 'custom-color-palettes' ) ) );

		return array_merge( $settings_link, $actions );
	}
}

// Run Plugin.
ThemeZee_Custom_Color_Palettes::setup();