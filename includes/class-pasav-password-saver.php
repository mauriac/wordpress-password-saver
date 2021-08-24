<?php

/**
 *
 * @link       #
 * @since      1.0.0
 *
 * @package    Pasav
 * @subpackage Pasav/includes
 */

/**
 * Manage password saver cpt.
 *
 * @package    Pasav
 * @subpackage Pasav/includes
 * @author     Mauriac Azoua <azouamauriac@gmail.com>
 */
class Pasav_Password_Saver {

	/**
	 * The post id.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string.
	 */
	private $id;

	/**
	 * The post settings.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string.
	 */
	private $settings;

	/**
	 * The post title.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string.
	 */
	private $title;

	/**
	 * Constructor.
	 *
	 * @since    1.0.0
	 */
	public function __construct( $post_id ) {
		if ( $post_id ) {
			$this->id       = $post_id;
			$this->settings = get_post_meta( $post_id, 'pasav-options', true );
			$this->title    = get_the_title( $post_id );
		}
	}

	/**
	 * Get post id.
	 *
	 * @since    1.0.0
	 */
	public function get_id() {
		return $this->id;
	}

	/**
	 * Get settings.
	 *
	 * @since    1.0.0
	 * @param string $key comment.
	 */
	public function get_settings( $key = null ) {
		if ( $key ) {
			if ( isset( $this->settings[ $key ] ) ) {
				return $this->settings[ $key ];
			} else {
				return null;
			}
		}
		return $this->settings;
	}

	/**
	 * Get post title.
	 *
	 * @since    1.0.0
	 */
	public function get_title() {
		return $this->title;
	}

}
