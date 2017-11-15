<?php

namespace Just_Coded\Theme_Framework\Supports;
use jcf\models\Settings;

/**
 * Class JustCustomFields
 *
 * Register hooks to rewrite storage file path
 *
 * @package Just_Coded\Theme_Framework\Supports
 */
class JustCustomFields {
	/**
	 * JustCustomFields constructor.
	 * Register jcf hooks
	 */
	public function __construct() {
		add_filter( 'jcf_config_filepath', array( $this, 'jcf_config_filepath' ), 10, 2 );
	}

	/**
	 * Patch config file path to get data from "/config/jcf.json" file
	 *
	 * @param string $path  Path generated by a plugin.
	 * @param string $source_settings   Source settings value.
	 *
	 * @return string
	 */
	public function jcf_config_filepath( $path, $source_settings ) {
		if ( Settings::CONF_SOURCE_FS_THEME === $source_settings ) {
			$path = get_stylesheet_directory() . '/config/just-custom-fields.json';
		}
		return $path;
	}
}
