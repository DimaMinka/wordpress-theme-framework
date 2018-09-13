<?php

namespace JustCoded\WP\Framework\ACF;


use JustCoded\WP\Framework\Objects\Singleton;

class ACF_Support {
	use Singleton;

	/**
	 * Class constructor.
	 */
	public function __construct() {
		add_filter( 'acf/input/admin_head', array( $this, 'register_assets' ) );
		add_action( 'admin_menu', array( $this, 'acf_remove_ui' ) );
		add_action( 'init', array( $this, 'hide_content_box' ) );
	}

	/**
	 * Flexible Collapse Fields and Responsive ACF Fields.
	 */
	public function register_assets() {
		if ( is_admin() ) {
			wp_enqueue_script( '_jtf-acf_collapse', jtf_plugin_url( 'assets/js/acf-flexible-collapse.js' ), [ 'jquery' ] );
			wp_enqueue_style( '_jtf-acf_responsive_fields', jtf_plugin_url( 'assets/css/acf-responsive-columns.css' ) );
		}
	}

	/**
	 * Remove ACF UI from menu.
	 */
	public function acf_remove_ui() {
		remove_menu_page( 'edit.php?post_type=acf-field-group' );
	}

	/**
	 * Hide content box for Post and Page.
	 */
	public function hide_content_box() {
		remove_post_type_support( 'page', 'editor' );
		remove_post_type_support( 'post', 'editor' );
	}

	/**
	 * Check that required plugin is installed and activated
	 *
	 * @return bool
	 */
	public static function check_requirements() {
		return is_plugin_active( 'advanced-custom-fields-pro/acf.php' );
	}
}