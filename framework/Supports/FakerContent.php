<?php

namespace JustCoded\WP\Framework\Supports;

use JustCoded\WP\Framework\Objects\Singleton;
use Faker\Provider\Uuid;
use Faker\Provider\TextBase;

/**
 * Class FakerContent
 * Fakerpress plugin extension which allows to generated faker content for custom fields.
 */
class FakerContent {
	use Singleton;

	/**
	 * FakerContent data.
	 *
	 * @var $data
	 */
	public $data;

	/**
	 * FakerContent construct.
	 */
	public function __construct() {
		if ( self::do_fakerpress() ) {
			add_action( 'wp_insert_post', array( $this, 'insert_post' ), 10, 3 );
		}
	}

	/**
	 * Fires once a post has been saved.
	 *
	 * @param int      $post_id Post ID.
	 * @param \WP_Post $post    Post object.
	 * @param bool     $update  Whether this is an existing post being updated or not.
	 */
	public function insert_post( $post_id, $post, $update ) {
		$this->do_save( $post_id, $this->data );
	}

	/**
	 * Saved faker content.
	 *
	 * @param int   $post_id Post ID.
	 * @param array $data    Form data.
	 *
	 * @return bool
	 */
	public function do_save( $post_id, $data ) {
		foreach ( $data as $meta_key => $meta_value ) {
			if ( class_exists( 'acf' ) ) {
				update_field( $meta_key, $meta_value, $post_id );
			} else {
				update_post_meta( $post_id, $meta_key, $meta_value );
			}
		}

		return true;
	}

	/**
	 * Generated array for flexible content.
	 *
	 * @param array $data Flexible content data.
	 *
	 * @return array
	 */
	public function flexible_content( $data = array() ) {
		$flexible_content = array();
		if ( empty( $data ) && ! class_exists( 'acf' ) ) {
			return $flexible_content;
		}
		foreach ( $data as $layout => $fields ) {
			foreach ( $fields as $field_value ) {
				$flexible_content[] = array_merge( $field_value, array( 'acf_fc_layout' => $layout ) );
			}
		}

		return $flexible_content;
	}

	/**
	 * Generated array for repeater fields.
	 *
	 * @param array $data Repeater fields data.
	 *
	 * @return array
	 */
	public function repeater( $data = array() ) {
		$repeater = array();
		if ( empty( $data ) ) {
			return $repeater;
		}
		foreach ( $data as $fields ) {
			$repeater[] = $fields;
		}

		return $repeater;
	}

	/**
	 * Get fake text.
	 *
	 * @param int $max_chars Chars number.
	 *
	 * @return string
	 */
	public function text( $max_chars = 200 ) {
		return TextBase::text( $max_chars );
	}

	/**
	 * Get fake words.
	 *
	 * @param int $chars Chars number.
	 *
	 * @return string
	 */
	public function words( $chars = 3 ) {
		return ucfirst( TextBase::words( $chars, true ) );
	}

	/**
	 * Get fake number.
	 *
	 * @return int
	 */
	public function number() {
		return rand( 1, 99 );
	}

	/**
	 * Get fake date.
	 *
	 * @param string $format Date format.
	 *
	 * @return string
	 */
	public function date( $format = 'Y-m-d' ) {
		return date( $format );
	}

	/**
	 * Generated and save attachment file.
	 *
	 * @param int    $width  Attachment width.
	 * @param int    $height Attachment height.
	 * @param string $type   Attachment type( id, url ).
	 *
	 * @return int|string
	 */
	public function attachment_generated( $width = 1100, $height = 800, $type = 'id' ) {
		$attach_url = "http://via.placeholder.com/{$width}x{$height}/";

		if ( 'id' !== $type ) {
			return $attach_url;
		}

		$response = wp_remote_get( $attach_url, array( 'timeout' => 5 ) );

		// Bail early if we have an error.
		if ( is_wp_error( $response ) ) {
			return false;
		}

		$bits = wp_remote_retrieve_body( $response );

		// Prevent Weird bits.
		if ( false === $bits ) {
			return false;
		}

		$filename = Uuid::uuid() . '.jpg';
		$upload   = wp_upload_bits( $filename, '', $bits );

		$attachment = array(
			'guid'           => $upload['url'],
			'post_mime_type' => 'image/jpeg',
			'post_title'     => $filename,
			'post_content'   => '',
			'post_status'    => 'inherit',
		);

		// Insert the attachment.
		$attach_id = wp_insert_attachment( $attachment, $upload['file'], 0 );

		return $attach_id;
	}

	/**
	 * Check that required plugin is installed and activated
	 *
	 * @return bool
	 */
	public static function check_requirements() {
		return is_plugin_active( 'fakerpress/fakerpress.php' );
	}

	/**
	 * Check work plugin Fakerpress for generated faker content.
	 *
	 * @return bool
	 */
	public static function do_fakerpress() {
		if ( isset( $_POST['fakerpress']['view'] ) && $_POST['fakerpress']['view'] === 'posts' ) {
			return true;
		} else {
			return false;
		}
	}
}