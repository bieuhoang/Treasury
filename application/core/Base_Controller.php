<?php

defined('BASEPATH') or defined('No direct script access allowed.');

class Base_Controller extends CI_Controller {

	public function __construct() {
		parent::__construct();

		// load database
		$this->load->database();

		// load helpers
		$this->load->helper(array ('url', 'form', 'html', 'download', 'file', 'assets', 'inflector', 'security', 'language', 'user'));

		// load libraries
		$this->load->library(array ('session', 'template', 'assets', 'auth', 'response', 'form_validation', 'gas'));

		// load model
		$this->load->model('auth_model');

		// check cookie
		if ( $this->input->cookie('identity') ) {
			$this->session->set_userdata('user_id', $this->input->cookie('identity'));
			// thiết lập lại cookie tính từ thời điểm này
			$this->input->set_cookie('identity', $this->session->userdata('user_id'), time() + 86500);
		}
		// get user
		$this->current_user = $this->auth->logged_in() ? $this->auth_model->user()->row() : FALSE;

		if ( $this->current_user ) {
			$this->current_user->fullname = implode(' ', array ($this->current_user->first_name, $this->current_user->last_name));
		}
		if ( $this->current_user && isset($this->current_user->qr_code) && $this->current_user->qr_code !== '' ) {
			$this->current_user->qr_code = site_url() . '/' . (Model\User::find($this->current_user->id)->url());
		}

		// ip address
		$this->ip_address = $this->input->ip_address();

		// get options
		foreach ( Model\Option::select('option_name, option_value')->where('auto_load', 1)->all() as $option ) {
			$this->config->set_item($option->option_name, $option->option_value);
		}

		$this->template->set('site_config', array (
			'app' => array (
				'siteUrl' => site_url(),
				'baseUrl' => base_url(),
				'language' => $this->config->item('language'),
				'charset' => $this->config->item('charset'),
				'urlSuffix' => $this->config->item('url_suffix'),
				'indexPage' => $this->config->item('index_page'),
				'currentUrl' => current_url()
			),
			'asset' => array (
				'jsDir' => 'public/js',
				'cssDir' => 'public/css',
				'imgDir' => 'public/img'
			),
			'user' => $this->current_user ? array (
				'username' => $this->current_user->username,
				'email' => $this->current_user->email,
				'id' => $this->current_user->id,
				'firstName' => $this->current_user->first_name,
				'lastName' => $this->current_user->last_name,
				'fullname' => $this->current_user->fullname,
				'isAdmin' => $this->auth->is_admin(),
				'isOwner' => $this->auth->in_group(array (3))
					) : false
		));

		// add assets
		$this->assets->add(array (
			'jquery.min.js',
			'bootstrap.min.js',
			'core.js',
			'helper.js',
			'php.js',
			'bootstrap.css',
			'bootstrap-responsive.min.css'
		));

		if ( isset($_GET['debug']) ) {
			$this->output->enable_profiler(TRUE);
		}
	}

}

function ci() {
	return get_instance();
}