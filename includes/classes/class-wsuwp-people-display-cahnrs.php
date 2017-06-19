<?php

/**
 * Class for CAHNRS customizations to WSUWP Content Syndicate People.
 *
 * WSUWP_People_Display_CAHNR
 */
class WSUWP_People_Display_CAHNRS {

	public function __construct() {

		add_action( 'after_setup_theme', array( $this, 'init' ) );

	} // end __construct()

	/**
	 * Start plugin customisations after theme setup
	 */
	public function init() {

		add_filter( 'wsuwp_people_item_html', array( $this, 'filter_wsuwp_people_item_html' ), 1, 4 );

		add_filter( 'wsuwp_people_inner_html', array( $this, 'wsuwp_people_inner_html' ), 1, 2 );

		add_filter( 'shortcode_atts_wsuwp_people', array( $this, 'shortcode_atts_cahnrswp_people' ), 1, 4 );

		add_filter( 'wsuwp_people_sort_items', array( $this, 'wsuwp_people_sort_items' ), 1, 3 );

	} // end init

	/**
	 * Get HTML for the specified display type
	 *
	 * @param string $html HTML generated for a person in Content Syndicate People
	 * @param stdClass $person Data returned from the WP REST API.
	 * @param string $type Type of display to use
	 * @param array $atts Attributes passed to the shortcode.
	 *
	 * @return string Generated HTML for an individual person.
	 */
	public function filter_wsuwp_people_item_html( $html, $person, $type, $atts ) {

		switch ( $type ) {

			case 'table':

				$html .= $this->get_person_display_table( $person, $atts );
				break;

		} // end switch()

		return $html;

	} // end filter_wsuwp_people_item_html

	/**
	 * Get HTML for table display type
	 *
	 * @param stdClass $person Data returned from the WP REST API.
	 * @param array $atts Attributes passed to the shortcode.
	 *
	 * @return string Generated HTML for an individual person.
	 */
	protected function get_person_display_table( $person, $atts ) {

		if ( isset( $person->profile_photo ) && ( '' !== $person->profile_photo ) ) {

			$photo = $person->profile_photo;

		} else {

			$photo = 'https://people.wsu.edu/wp-content/uploads/sites/908/2015/07/HeadShot_Template2.jpg';

		} // end if()

		$first_name = ( isset( $person->first_name ) ) ? $person->first_name : '';

		$last_name = ( isset( $person->last_name ) ) ? $person->last_name : '';

		if ( is_array( $person->working_titles ) && ( ! empty( $person->working_titles[0] ) ) ) {

			$position_title = $person->working_titles[0];

		} else {

			$position_title = ( isset( $person->position_title ) ) ?  ucwords( strtolower( $person->position_title ) ) : '';

		} // end if

		$email = ( isset( $person->email ) ) ? $person->email : '';

		$phone = ( isset( $person->phone ) ) ? $person->phone : '';

		if ( isset( $person->office_alt ) && ( '' !== $person->office_alt ) ) {

			$office = $person->office_alt;

		} else {

			$office = ( isset( $person->office ) ) ?  ucwords( strtolower( $person->office ) ) : '';

		} // end if()

		ob_start();

		include CAHNRSWPPEOPLEPATH . 'includes/table-display/person.php';

		$html = ob_get_clean();

		return $html;

	} // end get_person_display_table

	/**
	 * Add or Remove HTML from list of people.
	 *
	 * @param string $html HTML generated for all people in Content Syndicate People
	 * @param array $atts Attributes passed to the shortcode.
	 *
	 * @return string Generated HTML for an individual person.
	 */
	public function wsuwp_people_inner_html( $html, $atts ) {

		switch ( $atts['output'] ) {

			case 'table':
				ob_start();
				include CAHNRSWPPEOPLEPATH . 'includes/table-display/table.php';
				$html = ob_get_clean();
				break;

		} // end switch()

		return $html;

	} // end 

	/**
	 * Add additional shortcode attributes
	 *
	 * @param array $out Array of key value shortcode pairs return from shorcode_atts
	 * @param array $pairs
	 * @param array $atts Attributes passed to the shortcode.
	 * @param string $shortcode Shortcode name.
	 *
	 * @return array $out Array of key value shortcode pairs.
	 */
	public function shortcode_atts_cahnrswp_people( $out, $pairs, $atts, $shortcode ) {

		$out['bio'] = ( ! empty( $atts['bio'] ) ) ? $atts['bio'] : '';

		$out['biolabel'] = ( ! empty( $atts['biolabel'] ) ) ? $atts['biolabel'] : '';

		return $out;

	} // end shortcode_atts_cahnrswp_people

	/**
	 * Sort People by $att criteria
	 *
	 * @param array $people Data returned from the WP REST API.
	 * @param array $atts Attributes passed to the shortcode.
	 *
	 * @return array Sorted data.
	 */
	public function wsuwp_people_sort_items( $people, $atts ) {

		if ( is_array( $people ) ) {

			uasort( $people, function( $a, $b ) {

				return ( $a->last_name < $b->last_name ) ? -1 : 1;

			});

		} // end if()

		return $people;

	} // end wsuwp_people_sort_items


} // end WSUWP_People_Display_CAHNRS

$wsuwp_people_display_cahnrs = new WSUWP_People_Display_CAHNRS();