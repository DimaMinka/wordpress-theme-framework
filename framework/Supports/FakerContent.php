<?php

namespace JustCoded\WP\Framework\Supports;

use Faker\Provider\Uuid;
use Faker\Provider\TextBase;
use Faker\Factory;
use JustCoded\WP\Framework\Objects\Singleton;

/**
 * Class FakerContent
 * Fakerpress plugin extension which allows to generated faker content for custom fields.
 */
class FakerContent {
	use Singleton;

	/**
	 * Faker object
	 *
	 * @var $faker
	 */
	public $faker;

	/**
	 * FakerContent construct
	 */
	protected function __construct() {
		$this->faker = Factory::create();
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
		return $this->faker->date( $format );
	}

	/**
	 * Get fake timezone.
	 *
	 * @return string
	 */
	public function timezone() {
		return $this->faker->timezone;
	}

	/**
	 * Get fake person name.
	 *
	 * @return string
	 */
	public function person() {
		return $this->faker->name;
	}

	/**
	 * Get fake name.
	 *
	 * @return string
	 */
	public function company() {
		return $this->faker->company;
	}

	/**
	 * Get fake email.
	 *
	 * @return string
	 */
	public function email() {
		return $this->faker->safeEmail;
	}

	/**
	 * Get fake domain.
	 *
	 * @return string
	 */
	public function domain() {
		return $this->faker->domainName;
	}

	/**
	 * Get fake IP address.
	 *
	 * @return string
	 */
	public function ip() {
		return $this->faker->localIpv4;
	}
}