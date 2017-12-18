<?php
namespace JustCoded\WP\Framework\Objects;

/**
 * Model is the base class for data models.
 * Model should implement data get/set operations.
 *
 * Base Model class implements basic "property" features for clean usage in views.
 *
 * A property is defined by a getter method (e.g. `getLabel`), and/or a setter method (e.g. `setLabel`). For example,
 * the following getter and setter methods define a property named `label`:
 *
 * ~~~
 * private $_label;
 *
 * public function getLabel()
 * {
 *     return $this->_label;
 * }
 *
 * public function setLabel($value)
 * {
 *     $this->_label = $value;
 * }
 * ~~~
 *
 * Property names are *case-insensitive*.
 *
 * A property can be accessed like a member variable of an object. Reading or writing a property will cause the invocation
 * of the corresponding getter or setter method. For example,
 *
 * ~~~
 * // equivalent to $label = $object->getLabel();
 * $label = $object->label;
 * // equivalent to $object->setLabel('abc');
 * $object->label = 'abc';
 * ~~~
 *
 * If a property has only a getter method and has no setter method, it is considered as *read-only*. In this case, trying
 * to modify the property value will cause an exception.
 */
class Model {

	/**
	 * Current $post object
	 *
	 * @var \WP_Post
	 */
	public $post;

	/**
	 * Internal cache of wp queries
	 *
	 * @var \WP_Query[]
	 */
	private $_queries = [];

	/**
	 * Model constructor.
	 */
	public function __construct() {
		// set current post for new created instance.
		$this->set_post( null );
	}

	/**
	 * Returns the value of an object property.
	 *
	 * Do not call this method directly as it is a PHP magic method that
	 * will be implicitly called when executing `$value = $object->property;`.
	 *
	 * @param string $name The property name.
	 *
	 * @return mixed the property value
	 * @throws \Exception Property is not defined.
	 * @see __set()
	 */
	public function __get( $name ) {
		// trying to find get_{property} method.
		$getter = 'get_' . $name;
		if ( method_exists( $this, $getter ) ) {
			return $this->$getter();
		} else {
			throw new \Exception( 'Getting unknown property: ' . get_class( $this ) . '::' . $name );
		}
	}

	/**
	 * Run query and remember it to cache
	 * In this way you can use magic getter withour reseting query
	 *
	 * @param array  $params Usual WP_Query params array.
	 * @param string $method Cache key.
	 *
	 * @return \WP_Query
	 */
	public function wp_query( $params, $method ) {
		if ( ! isset( $this->_queries[ $method ] ) ) {
			$this->_queries[ $method ] = new \WP_Query( $params );
		}

		return $this->_queries[ $method ];
	}

	/**
	 * Run query and remember it to cache
	 * In this way you can use magic getter withour reseting query
	 *
	 * @param array  $params Usual WP_Query params array.
	 * @param string $method Cache key.
	 *
	 * @return \WP_Query
	 */
	public function archive_query( $params, $method ) {
		if ( ! isset( $this->_queries[ $method ] ) ) {
			global $wp_query;
			$wp_query->is_single = false;

			$paged           = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
			$params['paged'] = $paged;

			$this->_queries[ $method ] = new \WP_Query( $params );
		}

		return $this->_queries[ $method ];
	}

	/**
	 * Clean up queries cache in case you need to run new query
	 */
	public function reset_queries() {
		$this->_queries = [];
	}

	/**
	 * Set $post property correctly
	 *
	 * @param \WP_Post|int|null $post Post object, id or null to take current object.
	 */
	public function set_post( $post = null ) {
		if ( is_null( $post ) ) {
			$post = get_the_ID();
		}
		$this->post = get_post( $post );
	}

}
