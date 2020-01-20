<?php if ( ! defined( 'BASEPATH' ) ) {
	exit( 'No direct script access allowed' );
}

class Dts_Controller extends CI_Controller {


	private $pages;
	private $data;
	private $module;

	/**
	 * Metricco_Controller constructor.
	 *
	 * @param $pages array of pages which need to be loaded
	 * @param $data array of params
	 * @param $module string of active module
	 */
	public function __construct( $pages = array(), $data = array(), $module = '' ) {

		parent::__construct();

		$this->pages  = $pages;
		$this->data   = $data;
		$this->module = $module;

		$this->cssvar = false;
		$this->jsvar  = false;

		$this->init_modules();

	}

	/**
	 * This function adds page into array of pages which has to be loaded
	 *
	 * @param $page string
	 */
	public function add_page( $page ) {

		$this->pages[] = $page;
	}

	/**
	 * This function set class on body tag
	 *
	 * @param $class
	 */
	public function add_class( $class ) {

		$this->data['page_classes'][] = $class;
	}


	/**
	 * This function set page title
	 *
	 * @param $title
	 */
	public function set_title( $title ) {

		$this->data['title'] = $title . ' - ' . SITE_NAME;
	}

	/**
	 * This function add modal (hidden popup)
	 *
	 * @param $modal
	 */
	public function add_modal( $modal ) {

		$this->data['page_modals'][] = $modal;
	}

	/**
	 * This is getter of data
	 *
	 * @param string $param is concrete param from all data
	 * @param string $inner_param is inner element of array
	 *
	 * @return array
	 */
	public function get_data( $param = '', $inner_param = '' ) {

		if ( $param !== '' ) {

			if ( $inner_param !== '' ) {
				return $this->data[ $param ][ $inner_param ];
			} else {
				return $this->data[ $param ];
			}
		} else {
			return $this->data;
		}


	}

	/**
	 * This is exist checker of data
	 *
	 * @param string $param is concrete param from all data
	 *
	 * @return bool
	 */
	public function exist_data( $param = '' ) {

		if ( $param !== '' ) {
			return isset( $this->data[ $param ] );
		} else {
			return false;
		}


	}

	/**
	 * This function enable/disable custom css (load additional css in template folder)
	 *
	 * @param bool $flag
	 */
	public function enable_custom_css( $flag = true ) {
		$this->cssvar = $flag;
	}

	/**
	 * This function enable/disable custom js (load additional js in template folder)
	 *
	 * @param bool $flag
	 */
	public function enable_custom_js( $flag = true ) {
		$this->jsvar = $flag;
	}

	/**
	 * This function adds param into data array
	 *
	 * @param $key
	 * @param $value
	 *
	 * @internal param bool $flag
	 */
	public function additional_info( $key, $value ) {
		$this->data[ $key ] = $value;
	}

	/**
	 * This function call views based on pages[]
	 */
	public function load_default_view() {

		$module       = $this->module;
		$data         = $this->data;
		$pages        = $this->pages;
		$body_classes = array();
		$modals       = array();

		if ( isset( $data['page_classes'] ) != false ) {
			// body classes are empty
			$body_classes = array_merge( $body_classes, $data['page_classes'] );
		}

		//$body_classes[] = smoothScroll();

		$this->additional_info( 'body_classes', $body_classes );

		// load additional modals
		if ( isset( $data['page_modals'] ) != false ) {
			$modals = array_merge( $modals, $data['page_modals'] );
		}
		$this->additional_info( 'modals', $modals );

		/*
		#######################
		#     LOAD HEADER     #
		#######################
		*/

		$this->load->helper( 'dts_loader' );

		// CSS
		if ( $this->cssvar ) {
			$this->load_module_template( 'additional_css', 'additional-css.php' );
		}
		// JS

		if ( $this->jsvar ) {
			$this->load_module_template( 'additional_js', 'additional-js.php' );
		}

		$this->load_template_part( 'meta', get_meta_parts() );

		$this->load_template_part( 'header', get_header_parts( $modals ) );

		/*
		#####################
		#     LOAD SIDEAREA     #
		#####################
		*/

		// HTML
		$this->load->view( 'template/sidearea', $data );

		/*
		#####################
		#     LOAD BODY     #
		#####################
		*/

		$this->load->view( 'template/content_start', $data );

		// HTML
		foreach ( $pages as $page ) {
			if ( file_exists( APPPATH . '/views/pages/' . $module . '/' . $page . '.php' ) ) {
				$this->load->view( 'pages/' . $module . '/' . $page, $data );
			}
		}

		$this->load->view( 'template/content_end', $data );

		/*
		#######################
		#     LOAD FOOTER     #
		#######################
		*/

		// HTML
		$this->load->view( 'template/footer', $data );

	}

	/**
	 *
	 * This function load parts and place into local data
	 * It is used in template module such as header and footer
	 *
	 * @param $template_module string is module which is added
	 * @param $template_array array with all template
	 */
	public function load_template_part( $template_module, $template_array ) {

		$local_view = array(); // this is used only for local templates
		$data       = $this->get_data();

		foreach ( $template_array as $template ) {
			$local_view[ $template_module . '_' . $template ] = $this->load->view( 'template/' . $template_module . '/parts/' . $template_module . '-' . $template, $data, true );
		}

		/* this is main loader for part */
		$this->load->view( 'template/' . $template_module . '/' . $template_module . '.php', $local_view );
	}

	/**
	 *
	 * This function load template of concrete module and place into data
	 *
	 * @param $template_param string name of params which contains added template
	 * @param $template_slug string path to template
	 */
	public function load_module_template( $template_param, $template_slug ) {

		$this->additional_info( $template_param, $this->load->view( 'pages/' . $this->module . '/templates/' . $template_slug, $this->data, true ) );
	}


	/**
	 * This function init login modules (input fields)
	 */
	public function init_modules() {

		if ( function_exists( 'dts_init_options' )) {
			dts_init_options( $this );
		}

	}
}