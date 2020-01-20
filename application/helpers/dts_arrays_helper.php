<?php
/**
 *  This helper is used for main function which are used on different views/controller
 */

if ( ! function_exists( 'dts_get_select_options' ) ) {
	/**
	 * Function that return deal options
	 *
	 * @param array $args
	 *
	 * @param bool $default_value
	 *
	 * @param string|object $default_controller
	 *
	 * @return array
	 */

	function dts_get_select_options( $args = array(), $default_value = true, &$default_controller = '' ) {

		$default_controller->load->model( 'admin/global/model_global' );
		$values = $default_controller->model_global->load_select_array( $args, $default_value );

		return $values;
	}
}


if ( ! function_exists( 'dts_get_all_options' ) ) {
	/**
	 * Function that return all options based on type
	 *
	 * @param $default_controller
	 * @param $type
	 *
	 * @return array
	 */

	function dts_get_all_options( &$default_controller, $type ) {

		$default_controller->load->model( 'admin/global/model_global' );
		$options = $default_controller->model_global->get_all_options( $type );

		return $options;
	}
}


if ( ! function_exists( 'dts_only_keys' ) ) {
	/**
	 * Function that return all options based on type
	 *
	 * @param $array
	 *
	 * @return array
	 */

	function dts_only_keys( $array ) {

		$keys_array = array();

		foreach ( $array as $key => $value ) {
			$keys_array[] = $key;
		}

		return $keys_array;

	}
}

if ( ! function_exists( 'dts_get_label_for_table_type' ) ) {
	/**
	 * Function that return label for type
	 *
	 * @param $default_controller
	 * @param $table
	 * @param $type
	 *
	 * @return array
	 */

	function dts_get_label_for_table_type( &$default_controller, $table, $type ) {

		return dts_get_meta_for_table_type( $default_controller, $table, $type )['label'];

	}
}

if ( ! function_exists( 'dts_get_meta_for_table_type' ) ) {
	/**
	 * Function that return meta for type
	 *
	 * @param $default_controller
	 * @param $table
	 * @param $type
	 *
	 * @return array
	 */

	function dts_get_meta_for_table_type( &$default_controller, $table, $type ) {

		return $default_controller->get_data( 'table_types' )[ $table ][ $type ];

	}
}

if ( ! function_exists( 'dts_get_all_items' ) ) {
	/**
	 * Function that return all items based on type
	 *
	 * @param $default_controller
	 * @param $type
	 *
	 * @return array
	 */

	function dts_get_all_items( &$default_controller, $type ) {

		$default_controller->load->model( 'admin/items/model_items' );
		$items = $default_controller->model_items->get_items( $type );

		return $items;

	}
}