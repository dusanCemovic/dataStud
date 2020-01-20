<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Controller_account extends Dts_Controller {

	private $pages;
	private $data;
	private $module;

	/**
	 * Main constructor.
	 */
	public function __construct() {

		$this->pages  = array();
		$this->data   = array();
		$this->module = 'account';

		parent::__construct( $this->pages, $this->data, $this->module );

	}

	public function profile_registration_form() {

		// set title
		$this->set_title( 'Registration' );

		$this->add_page( 'registration_form' );
		$this->load_default_view();
	}
}