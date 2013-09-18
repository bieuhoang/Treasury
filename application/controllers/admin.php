<?php defined('BASEPATH') or exit('No direct script access allowed.');

class Admin extends Admin_Controller
{
	/**
	 * __construct()
	 * --------------------------------------------------------
	 * @author Long Nguyen
	 * @link http://lnguyen.info
	 * @version 1.0
	 * @package Treasury
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Dashboard page
	 * --------------------------------------------------------
	 * @author Long Nguyen
	 * @link http://lnguyen.info
	 * @version 1.0
	 * @package Treasury
	 */
	public function index()
	{
		// users
		$this->template
			->set('total_users_24h', $this->auth->where('created_on > ', time() - 24*60*60)->users(2)->num_rows())
			->set('total_users_7days', $this->auth->where('created_on > ', time() - 7*24*60*60)->users(2)->num_rows())
			->set('total_users_31days', $this->auth->where('created_on > ', time() - 31*24*60*60)->users(2)->num_rows())
			->set('total_users_this_month', $this->auth->where('created_on > ', mktime(0, 0, 0, date('n'), 1, date('Y')))->users(2)->num_rows());

		// owners
		$this->template
			->set('total_owners_24h', $this->auth->where('created_on > ', time() - 24*60*60)->users(3)->num_rows())
			->set('total_owners_7days', $this->auth->where('created_on > ', time() - 7*24*60*60)->users(3)->num_rows())
			->set('total_owners_31days', $this->auth->where('created_on > ', time() - 31*24*60*60)->users(3)->num_rows())
			->set('total_owners_this_month', $this->auth->where('created_on > ', mktime(0, 0, 0, date('n'), 1, date('Y')))->users(3)->num_rows());

		// promotions
		$this->template
			->set('total_promotions_24h', count(Model\Promotion::select('id')->where('created_at > ', date('Y-m-d H:i:s', time() - 24*60*60))->all()))
			->set('total_promotions_7days', count(Model\Promotion::select('id')->where('created_at > ', date('Y-m-d H:i:s', time() - 7*24*60*60))->all()))
			->set('total_promotions_31days', count(Model\Promotion::select('id')->where('created_at > ', date('Y-m-d H:i:s', time() - 31*24*60*60))->all()))
			->set('total_promotions_this_month', count(Model\Promotion::select('id')->where('created_at > ', date('Y-m-d H:i:s', mktime(0, 0, 0, date('n'), 1, date('Y'))))->all()));

		// add assets
		add_assets(array('functions/admincp/admin.dashboard.js'));

		// template render
		$this->template
			->set_title(config_item('site_name'), 'Dashboard')
			->set_yield('admincp/index')
			->render();
	}

	/**
	 * Page 404 - not found
	 * --------------------------------------------------------
	 * @author Long Nguyen
	 * @link http://lnguyen.info
	 * @version 1.0
	 * @package Treasury
	 */
	public function page_404()
	{
		$this->template
			->set_title(config_item('site_name'), '404 not found')
			->set_yield('admincp/page_404')
			->render();
	}

	/**
	 * Page 403 - access denied
	 * --------------------------------------------------------
	 * @author Long Nguyen
	 * @link http://lnguyen.info
	 * @version 1.0
	 * @package Treasury
	 */
	public function page_403()
	{
		$this->template
			->set_title(config_item('site_name'), '403 access denied')
			->set_yield('admincp/page_403')
			->render();
	}
}