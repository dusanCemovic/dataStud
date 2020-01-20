<?php

class Model_global extends CI_Model {
    public function __construct() {

    }

	/**
	 * This function return all options based on type
	 *
	 * @param $type string
	 *
	 * @return array of all possible options
	 */
	public function get_all_options( $type ) {

		$this->db->where( DB_PREFIX  .  "add_fields.af_option_source = '". $type ."'" );
		$this->db->from( DB_PREFIX  .  'add_fields' );
		$this->db->order_by('af_sort', "asc");

		$options = array();

		$query_get_options = $this->db->get();
		if ( $query_get_options !== false && $query_get_options->num_rows() !== 0 ) {
			foreach ( $query_get_options->result() as $option ) {
				$options[ $option->af_option_name ] = array(
					"id"   => $option->af_option_id,
					"attr"   => $option->af_option_attr,
					"parent" => $option->af_parent_id,
					"sort"   => $option->af_sort
				);
			}
		}

		return $options;
    }

	/**
	 * This function return all distinct types of items or deals which has different options
	 *
	 * @param $table string
	 *
	 * @return array of all possible types
	 */
	public function get_all_distinct_types( $table ) {

		$this->db->where( DB_PREFIX  .  "options.o_name = '". $table ."_types'" );
		$this->db->from( DB_PREFIX  .  'options' );

		$types = array();


		$query_get_types = $this->db->get();
		if ( $query_get_types !== false && $query_get_types->num_rows() === 1 ) {
			$values = json_decode( $query_get_types->result()[0]->o_value );


			foreach ( $values as $type_key => $type_single ) {
				$types[ $type_key ] = array();
				foreach ( $type_single as $type_single_key => $type_single_value ) {
					$types[ $type_key ][$type_single_key] = $type_single_value;
				}
			}
		}

		return $types;
	}

	/**
	 * This function return custom array that depends completely on args
	 *
	 * @param $args array
	 *
	 * @param $default_value
	 *
	 * @return array of all possible types
	 */
	public function load_select_array( $args, $default_value ) {

		if ( isset( $args->table ) ) {
			$this->db->from( DB_PREFIX . $args->table );
		}

		if ( isset( $args->where_key ) && isset( $args->where_values ) ) {
			$this->db->where_in( DB_PREFIX . $args->table . "." . $args->where_key, (array) $args->where_values );
		}

		if ( defined('PERSONAL_SQL_USE' )) {
			$this->db->where( DB_PREFIX . $args->table . '.temp_user_id', metricco_get_user_id( $this ) );
		}

		$values    = array();

		if ( $default_value ) {
			$values[''] = '---';
		}

		$param_key = $args->param_key;

		$query = $this->db->get();
		if ( $query !== false && $query->num_rows() > 0 ) {

			foreach ( $query->result() as $key => $value ) {
				$values[ $value->$param_key ] = $value->$param_key;
			}

		}

		if ( isset( $args->param_value ) && $args->param_value !== '' ) {

			$this->db->from( DB_PREFIX . $args->table . '_meta' );
			$this->db->where( DB_PREFIX . $args->table . "_meta.im_type", $args->param_value );

			if ( defined('PERSONAL_SQL_USE' )) {
				$this->db->where( DB_PREFIX . $args->table . '_meta.temp_user_id', metricco_get_user_id( $this ) );
			}

			$query_meta = $this->db->get();

			if ( $query_meta !== false && $query_meta->num_rows() > 0 ) {

				foreach ( $query_meta->result() as $key => $value ) {
					if ( in_array( $value->im_item_id, $values ) ) {
						$values[ $value->im_item_id ] = $value->im_value;
					}
				}
			}

		}

		return $values;
	}


	/**
	 * This function returns metricco global options
	 * @return array
	 */
	public function get_global_options( ) {

		$this->db->where( DB_PREFIX  .  "options.o_name = 'setup_options'" );
		$this->db->from( DB_PREFIX  .  'options' );

		$query = $this->db->get();
		$options = array();
		if ( $query->num_rows() === 1 && $query->result()[0]->o_value !== '') {
			$options = json_decode( $query->result()[0]->o_value );
		}

		return (array) $options;
	}

	/**
	 * @return bool
	 */
	public function custom_sql( ) {

		$this->db->from( 'lista_artikala' );

		$query = $this->db->get();
		$data = array();
		foreach ( $query->result() as $value ) {
			foreach ( $value as $key => $new_value ) {
				if($key == 'la_id') {
					continue;
				}
				$new_data = array();
				$new_data['im_item_id'] = $value->la_id;
				$new_data['im_type'] = 'i_' . $key;
				$new_data['im_value'] = $new_value;
				$data[] = $new_data;
			}
		}

		//$query_result_insert = $this->db->insert_batch( DB_PREFIX  .  'items_meta', $data );

		return true;
	}

}