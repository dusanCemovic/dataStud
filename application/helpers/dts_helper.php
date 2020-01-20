<?php
/**
 *  This helper is used for main function which are used on different views/controller
 */

if ( ! function_exists( 'dts_is_timestamp' ) ) {
	function dts_is_timestamp( $timestamp ) {
		return ( (string) (int) $timestamp === $timestamp ) && ( $timestamp <= PHP_INT_MAX ) && ( $timestamp >= ~PHP_INT_MAX );
	}
}

if ( ! function_exists( 'dts_date' ) ) {
	function dts_date( $date, $format = DATE_FORMAT_PHP_SORTABLE ) {

		if ( $date === '' || $date === 0 || $date === '0' ) {
			return '';
		}

		$timestamp = dts_is_timestamp( $date ) ? $date : strtotime( $date );

		return date( $format, $timestamp );
	}
}

if ( ! function_exists( 'underscore_to_camel_case' ) ) {

	/**
	 * This function is only used to translate underscore to camel case
	 *
	 * @param $string
	 * @param bool $capitalizeFirstCharacter
	 *
	 * @return mixed
	 */
	function underscore_to_camel_case( $string, $capitalizeFirstCharacter = false ) {

		$str = str_replace( ' ', '', ucwords( str_replace( '_', ' ', $string ) ) );

		if ( ! $capitalizeFirstCharacter ) {
			$str[0] = strtolower( $str[0] );
		}

		return $str;
	}
}

if ( ! function_exists( 'camel_case_to_underscore' ) ) {

	/**
	 * This function is only used to translate camel case to underscore
	 *
	 * @param $string
	 *
	 * @return mixed
	 */
	function camel_case_to_underscore( $string ) {

		$str = strtolower( preg_replace( '/(?<!^)[A-Z]/', '_$0', $string ) );

		return $str;
	}
}

if ( ! function_exists( 'dts_merge_args' ) ) {
	/**
	 * Function that merge default and new values for array
	 *
	 * @param $pairs
	 * @param $atts
	 *
	 * @return array
	 */
	function dts_merge_args( $pairs, $atts ) {
		$atts = (array) $atts;
		$out  = array();
		foreach ( $pairs as $name => $default ) {
			if ( array_key_exists( $name, $atts ) ) {
				$out[ $name ] = $atts[ $name ];
			} else {
				$out[ $name ] = $default;
			}
		}

		return $out;
	}
}


if ( ! function_exists( 'dts_string' ) ) {
	/**
	 * Function that return/translate
	 *
	 *
	 * @param string $string
	 * @param string $lang
	 *
	 * @return string
	 */
	function dts_string( $string, $lang = 'en' ) {

		return $string;
	}
}

if ( ! function_exists( 'dts_echo_string' ) ) {
	/**
	 * Function that echo/translate
	 *
	 *
	 * @param string $string
	 * @param string $lang
	 *
	 * @return string
	 */
	function dts_echo_string( $string, $lang = 'en' ) {

		echo dts_string($string, $lang);
	}
}

if ( ! function_exists( 'dts_get_user_id' ) ) {
	/**
	 * @param $load object is controller
	 *
	 * @return int|bool userid of logged user
	 */
	function dts_get_user_id( $load ) {
		return $load->encryption->decrypt( $load->session->usi );
	}
}

if ( ! function_exists( 'dts_demo_activated' ) ) {
	/**
	 *
	 * @return bool
	 */
	function dts_demo_activated() {
		return defined( 'DEMO_ACTIVE' );
	}
}


if ( ! function_exists( 'dts_demo_step' ) ) {
	/**
	 *
	 * @return string for active step
	 */
	function dts_demo_step() {
		if ( defined( 'DEMO_ACTIVE' ) ) {
			return DEMO_STEP;
		} else {
			return false;
		}
	}
}
