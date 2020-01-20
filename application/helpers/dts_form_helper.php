<?php

if ( ! function_exists( 'dts_global_input' ) ) {
	/**
	 * This function return input field
	 *
	 * @param $param is an input field
	 *
	 * @return string
	 */
	function dts_global_input( $param ) {


		switch ( $param['type'] ) {
			case 'text' :
				{
					dts_form_input( $param );
				}
				break;
			case 'textarea' :
				{
					dts_form_textarea( $param );
				}
				break;
			case 'email' :
				{
					dts_form_input( $param );
				}
				break;
			case 'select' :
				{
					dts_form_select( $param );
				}
				break;
			case 'date' :
				{
					dts_form_datepicker( $param );
				}
				break;
			case 'password' :
				{
					dts_form_password( $param );
				}
				break;
			case 'submit' :
				{
					dts_form_submit( $param );
				}
				break;
			default :
			{
				dts_form_input( $param );
			}
		}

	}
}

if ( ! function_exists( 'dts_form_input_number' ) ) {
	/**
	 * Text Input Number Field
	 *
	 * @param mixed
	 * @param string
	 * @param mixed
	 *
	 * @return    string
	 */
	function dts_form_input_number( $data = '', $value = '', $extra = '' ) {
		$defaults = array(
			'type'  => 'number',
			'name'  => is_array( $data ) ? '' : $data,
			'value' => $value
		);

		return '<input ' . _parse_form_attributes( $data, $defaults ) . _attributes_to_string( $extra ) . " />\n";
	}
}

if ( ! function_exists( 'dts_get_form_input' ) ) {
	/**
	 * This function return input
	 *
	 * @param $param is an input field
	 *
	 * @return string
	 */
	function dts_get_form_input( $param ) {

		$string = '';

		if ( isset( $param['label'] ) && $param['label'] !== '' ) {
			$string .= '<label class="control-label" for="' . $param['id'] . '">' . $param['label'] . '</label>';
		}

		if ( isset( $param['type'] ) && $param['type'] === 'number' ) {
			$string .= dts_form_input_number( $param );
		} else {
			$string .= form_input( $param );
		}

		if ( ! isset( $param['enable_error_field'] ) || $param['enable_error_field'] === 'yes' ) {
			$string .= dts_get_error_field( $param );
		}

		return $string;
	}
}

if ( ! function_exists( 'dts_form_input' ) ) {
	/**
	 * This function print select
	 *
	 * @param $param is an input field
	 *
	 * @return string
	 */
	function dts_form_input( $param ) {

		echo dts_get_form_input( $param );

	}
}

if ( ! function_exists( 'dts_get_form_textarea' ) ) {
	/**
	 * This function return input
	 *
	 * @param $param is an input field
	 *
	 * @return string
	 */
	function dts_get_form_textarea( $param ) {

		$string = '';

		if ( isset( $param['label'] ) && $param['label'] !== '' ) {
			$string .= '<label class="control-label" for="' . $param['id'] . '">' . $param['label'] . '</label>';
		}

		$string .= form_textarea( $param );

		if ( ! isset( $param['enable_error_field'] ) || $param['enable_error_field'] === 'yes' ) {
			$string .= dts_get_error_field( $param );
		}

		return $string;
	}
}

if ( ! function_exists( 'dts_form_textarea' ) ) {
	/**
	 * This function print select
	 *
	 * @param $param is an input field
	 *
	 * @return string
	 */
	function dts_form_textarea( $param ) {

		echo dts_get_form_textarea( $param );

	}
}

if ( ! function_exists( 'dts_get_form_select' ) ) {
	/**
	 * This function return select
	 *
	 * @param $param is an input field
	 *
	 * @return string
	 */
	function dts_get_form_select( $param ) {

		$required = '';
		$string   = '';

		if ( isset( $param['required'] ) && $param['required'] === 'required' ) {
			$required = 'required="required"';
		}

		if ( isset( $param['label'] ) && $param['label'] !== '' ) {
			$string .= '<label class="control-label" for="' . $param['id'] . '">' . $param['label'] . '</label>';
		}

		if ( isset( $param['label-chatbot'] ) && $param['label-chatbot'] !== '' ) {
			$string .= ' or <a class="dts-label-chatbot-trigger" data-toggle="modal" data-target="#dts-modal-add-' . $param['modal-id'] . '">' . $param['label-chatbot'] . '</a>';
		}

		$string .= '<select class="' . $param["class"] . '" id="' . $param['id'] . '" name="' . $param['name'] . '" ' . $required . ' >';

		if ( isset( $param['default'] ) && $param['default'] === 'yes' ) {
			$string .= '<option value="">---</option>';
		}

		foreach ( $param['options'] as $key => $value ) {
			$selected = isset( $param['value'] ) && $param['value'] == $key ? 'selected="selected"' : '';
			$string   .= '<option ' . $selected . ' value="' . $key . '">' . $value . '</option>';
		}


		$string .= '</select>';

		if ( ! isset( $param['enable_error_field'] ) || $param['enable_error_field'] === 'yes' ) {
			$string .= dts_get_error_field( $param );
		}

		return $string;

	}
}

if ( ! function_exists( 'dts_form_select' ) ) {
	/**
	 * This function print select
	 *
	 * @param $param is an input field
	 *
	 * @return string
	 */
	function dts_form_select( $param ) {

		echo dts_get_form_select( $param );

	}
}

if ( ! function_exists( 'dts_get_form_datepicker' ) ) {
	/**
	 * This function return datePicker and its error field
	 *
	 * @param $param is an input field
	 *
	 * @return string
	 */
	function dts_get_form_datepicker( $param ) {

		$string          = '';
		$required        = '';
		$disabled        = '';
		$data            = '';
		$value           = '';
		$placeholder     = '';
		$additional_data = '';

		if ( isset( $param["required"] ) && $param["required"] == 'required' ) {
			$required = 'required="required"';
		}

		if ( isset( $param["disabled"] ) && $param["disabled"] == 'disabled' ) {
			$disabled = 'disabled="disabled"';
		}

		if ( isset( $param['data'] ) ) {
			$data = $param['data'];
		}

		if ( isset( $param['value'] ) ) {
			$value = $param['value'];
		}

		if ( isset( $param['placeholder'] ) ) {
			$placeholder = $param['placeholder'];
		}

		if ( isset( $param['additional_data'] ) ) {
			$additional_data = $param['additional_data'];
		}

		if ( isset( $param['label'] ) && $param['label'] !== '' ) {
			$string .= '<label class="control-label" for="' . $param['id'] . '">' . $param['label'] . '</label>';
		}

		$string .= '<div class="input-group date ' . $param["class"] . '" ' . $data . ' >
                <span class="dts-datepicker-icon-delete fa fa-close"></span>
                <input id="' . $param["id"] . '" name="' . $param["name"] . '" placeholder="' . $placeholder . '" type="text" readonly ' . $required . ' class="form-control date-picker" value="' . $value . '" ' . $additional_data . ' ' . $disabled . ' />';

		$string .= '<span class="datepicker-icon input-group-btn">
                    <button class="btn default date-set" type="button">
                        <i class="fa fa-calendar"></i>
                    </button>
                </span>
            </div>';

		if ( ! isset( $param['enable_error_field'] ) || $param['enable_error_field'] === 'yes' ) {
			$string .= dts_get_error_field( $param );
		}

		return $string;

	}
}

if ( ! function_exists( 'dts_form_datepicker' ) ) {
	/**
	 * This function return datePicker and its error field
	 *
	 * @param $param is an input field
	 *
	 * @return string
	 */
	function dts_form_datepicker( $param ) {
		echo dts_get_form_datepicker( $param );
	}
}

if ( ! function_exists( 'dts_get_form_password' ) ) {
	/**
	 * This function return input password
	 *
	 * @param $param is an input field
	 *
	 * @return string
	 */
	function dts_get_form_password( $param ) {

		$string = '';

		if ( isset( $param['label'] ) && $param['label'] !== '' ) {
			$string .= '<label class="control-label" for="' . $param['id'] . '">' . $param['label'] . '</label>';
		}

		$string .= form_password( $param );

		if ( ! isset( $param['enable_error_field'] ) || $param['enable_error_field'] === 'yes' ) {
			$string .= dts_get_error_field( $param );
		}

		return $string;
	}
}

if ( ! function_exists( 'dts_form_password' ) ) {
	/**
	 * This function print input password
	 *
	 * @param $param is an input field
	 *
	 * @return string
	 */
	function dts_form_password( $param ) {

		echo dts_get_form_password( $param );

	}
}

if ( ! function_exists( 'dts_get_form_submit' ) ) {
	/**
	 * This function return input
	 *
	 * @param $param is an input field
	 *
	 * @return string
	 */
	function dts_get_form_submit( $param ) {

		$string = '';

		$string .= form_submit( $param );


		return $string;
	}
}

if ( ! function_exists( 'dts_form_submit' ) ) {
	/**
	 * This function print select
	 *
	 * @param $param is an input field
	 *
	 * @return string
	 */
	function dts_form_submit( $param ) {

		echo dts_get_form_submit( $param );

	}
}

if ( ! function_exists( 'dts_error_field' ) ) {
	/**
	 * This function prints input error field
	 *
	 * @param $param is an input field
	 * @param bool $hide
	 */
	function dts_error_field( $param, $hide = false ) {

		echo dts_get_error_field($param, $hide);
	}
}

if ( ! function_exists( 'dts_get_error_field' ) ) {
	/**
	 * This function return input error field
	 *
	 * @param $param is an input field
	 * @param bool $hide
	 *
	 * @return string
	 */
	function dts_get_error_field( $param, $hide = false ) {

		$hidden_class = '';
		if ( $hide ) {
			$hidden_class = 'dts-hidden';
		}

		return '<div class="' . $param["id"] . 'Error dts-error-field ' . $hidden_class . '"></div>';
	}
}

if (!function_exists( 'dts_form_error' )) {
	/**
	 * This function prints input error and clean p tags
	 *
	 * @param $item is error massage
	 * @return string
	 */
	function dts_form_error($item) {

		$pattern = "/([<]([\/])?[p][>])/";

		return preg_replace($pattern, '', form_error($item));
	}
}