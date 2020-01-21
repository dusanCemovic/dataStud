<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Controller_main_api extends Dts_Controller {

	private $pages;
	private $data;
	private $module;

	/**
	 * Main constructor.
	 */
	public function __construct() {

		$this->pages  = array();
		$this->data   = array();
		$this->module = 'api';

		parent::__construct( $this->pages, $this->data, $this->module );

	}

	public function result() {
		// silence
	}
}