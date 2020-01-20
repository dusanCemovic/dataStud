<?php

/**
 *  This helper is used for main function which are used on different views/controller
 */

if ( ! function_exists( 'dts_init_options' ) ) {

	function dts_init_options( &$controller ) {

		$controller->load->model( 'global/model_global' );
		$global_options = $controller->model_global->get_global_options();
		//$demo_options = $controller->model_global->get_demo_options();

		if ( empty( $global_options ) ) {
			var_dump( 'DataStud is not set properly' );
			exit();
		} else {
			if ( isset( $global_options['site_name'] ) ) {
				define( 'SITE_NAME', $global_options['site_name'] );

			} else {
				define( 'SITE_NAME', 'DataStud' );
			}

			if ( isset( $global_options['tag_line'] ) ) {
				define( 'TAG_LINE', $global_options['tag_line'] );
			}
		}

		if ( dts_is_logged( $controller ) ) {
			if ( isset( $global_options['personal_user'] ) && intval( $global_options['personal_user'] ) === 1 ) {
				define( 'PERSONAL_SQL_USE', true );
			}

//			if ( isset( $demo_options['active'] ) && intval( $demo_options['active'] ) === 1 && isset( $demo_options['step']) ) {
//				define( 'DEMO_ACTIVE', true );
//				define( 'DEMO_STEP', intval($demo_options['step']) );
//			}

		}
	}
}

if ( ! function_exists( 'dts_is_logged' ) ) {
	/**
	 * @param $default_controller
	 *
	 * @return bool if user is logged
	 */
	function dts_is_logged( &$default_controller ) {

		return $default_controller->session->is_logged_in == '1';
	}
}

if ( ! function_exists( 'dts_get_permalink' ) ) {
	/**
	 *  This function returns permalink
	 *
	 * @return string
	 */
	function dts_get_permalink() {

		return ( isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] === 'on' ? "https" : "http" ) . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

	}
}

if ( ! function_exists( 'dts_login_check' ) ) {
	/**
	 * This function check if user is logged in
	 *
	 * @param $default_controller
	 */
	function dts_login_check( &$default_controller ) {

		if ( ! dts_is_logged( $default_controller ) ) {
			// for logged user redirect to their profile
			redirect( base_url() . 'login/?redirect_url=' . dts_get_permalink() );
		}
	}
}