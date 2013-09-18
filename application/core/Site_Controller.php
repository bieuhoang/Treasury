<?php defined('BASEPATH') or exit('No direct script access allowed.');

class Site_Controller extends Base_Controller
{
	public function __construct()
	{
		parent::__construct();

		// set blocks
		$this->template
			->set_layout('application')
			->set_block('top_navigation', 'blocks/top_navigation');

		// add script js
		add_assets(array(
			'functions/scripts.js',
			'styles.css'
		));

		// query string
		$this->config->set_item('query_string', $this->input->get('s'));
	}
}