<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Controller_home extends Dts_Controller {

	private $pages;
	private $data;
	private $module;

	/**
	 * Main constructor.
	 */
	public function __construct() {

		$this->pages  = array();
		$this->data   = array();
		$this->module = 'home';

		parent::__construct( $this->pages, $this->data, $this->module );

	}

	public function home($info = '') {

		//metricco_login_check( $this );

		// set title
		$this->set_title( "Home" );

		if($info === 'welcome') {
			$this->set_title( "Welcome to DataStud" );
		}

		$this->add_page( 'landing' );
		$this->load_default_view();
	}
}