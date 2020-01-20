<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Controller_profile extends Dts_Controller {

	private $pages;
	private $data;
	private $module;

	/**
	 * Main constructor.
	 */
	public function __construct() {

		$this->pages  = array();
		$this->data   = array();
		$this->module = 'profile';

		parent::__construct( $this->pages, $this->data, $this->module );

	}

	public function profile_view() {

		// set title
		$this->set_title( 'Profile' );

		$this->add_page( 'profile_view' );
		$this->load_default_view();
	}
}