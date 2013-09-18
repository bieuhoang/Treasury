<?php defined('BASEPATH') or exit('No direct script access allowed.');

class Admin_Controller extends Base_Controller
{
	public function __construct()
	{
		parent::__construct();

		// These pages get past permission checks
		$ignored_pages = array(
			'admin/login', 
			'admin/logout', 
			'admin/forgot_password'
		);

		// Check if the current page is to be ignored
		$current_page = $this->uri->segment(1, '') . '/' . $this->uri->segment(2, 'index');

		// Dont need to log in, this is an open page
		if (in_array($current_page, $ignored_pages))
		{				
			return TRUE;
		}
		elseif($this->current_user == FALSE)
		{
			redirect('login', 'refresh');
		}

		// check if not admin, you will redirect to page 403
		if($this->auth->is_admin() === false)
		{
			redirect('admin/page_403', 'refresh');
		}

		// set template layout
		$this->template
			->set_layout('admin')
			->set_block('top_navigation', 'blocks/admin_top_navigation');

		// add script js
		add_assets(array(
			'styles.css',
			'styles.admin.css',
			'functions/admincp/scripts.js'
		));
	}
}