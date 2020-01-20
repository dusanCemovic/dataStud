<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Controller_statistics extends Dts_Controller {

	private $pages;
	private $data;
	private $module;

	/**
	 * Main constructor.
	 */
	public function __construct() {

		$this->pages  = array();
		$this->data   = array();
		$this->module = 'statistics';

		parent::__construct( $this->pages, $this->data, $this->module );

	}

	public function statistics() {

		// set title
		$this->set_title( "Statistics" );

		$this->additional_info('enable_charts', true);

		$this->add_page( 'statistics' );
		$this->load_default_view();
	}
}