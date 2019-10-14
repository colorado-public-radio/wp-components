<?php
/**
 * Google Tag Manager component.
 *
 * @package WP_Components
 */

namespace WP_Components\Integrations;

/**
 * Google Tag Manager.
 */
class Google_Tag_Manager extends \WP_Components\Component {

	use \WP_Components\WP_Query;

	/**
	 * Unique component slug.
	 *
	 * @var string
	 */
	public $name = 'google-tag-manager';

	/**
	 * Define a default config.
	 *
	 * @return array Default config.
	 */
	public function default_config() : array {
		return [
			'container_id' => '',
			'data_layer'   => [],
		];
	}

	/**
	 * Set targeting arguments from wp_query.
	 *
	 * @return Google_Tag_Manager
	 */
	public function query_has_set() : self {
		return $this->merge_config(
			[
				'data_layer' => [],
			]
		);
	}

	/**
	 * Get value for content type targeting.
	 *
	 * @return string
	 */
	public function get_authors() : array {
		if ( $this->query->is_single() ) {
			$bylines = ( new \WP_Components\Byline_Wrapper() )->set_post( $this->query->ID );

			// Return array of author names.
			return array_map(
				function( $byline ) {
					return $byline->get_config( 'name' );
				},
				$bylines->children
			);
		}

		return [];
	}

	/**
	 * Get value for content type targeting.
	 *
	 * @return string
	 */
	public function get_post_type() : ?string {
		if ( $this->query->is_single() ) {
			return $this->query->post->post_type;
		}

		return null;
	}

	/**
	 * Get value for content id targeting.
	 *
	 * @return string
	 */
	public function get_post_id() : ?string {
		if ( $this->query->is_single() ) {
			return $this->query->post->ID;
		}

		return null;
	}

	/**
	 * Get value for tags targeting.
	 *
	 * @return array
	 */
	public function get_tags() : array {
		// Single article.
		if ( $this->query->is_single() ) {
			$tags = wp_get_post_tags( $this->query->post->ID ?? 0 );

			return array_map(
				function( $tag ) {
					return $tag->name;
				},
				$tags
			);
		}

		// Tag landing.
		if ( $this->query->is_tag() ) {
			return [ $this->query->queried_object->name ];
		}

		return [];
	}

	/**
	 * Get post title, if applicable
	 *
	 * @return string
	 */
	public function get_title() : ?string {
		if ( $this->query->is_single() ) {
			return $this->query->post->post_title ?? '';
		}

		return null;
	}
}
