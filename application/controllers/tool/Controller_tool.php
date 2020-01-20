<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Controller_tool extends Dts_Controller {

	private $pages;
	private $data;
	private $module;

	/**
	 * Main constructor.
	 */
	public function __construct() {

		$this->pages  = array();
		$this->data   = array();
		$this->module = 'tool';

		parent::__construct( $this->pages, $this->data, $this->module );

	}

	public function result() {

		// set title
		$this->set_title( 'Results' );

		$this->add_page( 'result' );
		$this->load_default_view();
	}

	public function ideal_combo() {

		// set title
		$this->set_title( 'Results (Ideal)' );

		$this->add_page( 'ideal_combo' );
		$this->load_default_view();
	}
}