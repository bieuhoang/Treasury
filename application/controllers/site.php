<?php defined('BASEPATH') or exit('No direct script access allowed.');

class Site extends Site_Controller
{
	/**
	 * __construct()
	 * --------------------------------------------------------	 *
	 * @author Long Nguyen
	 * @link http://lnguyen.info
	 * @version 1.0
	 * @package Treasury
	 */
	public function __construct()
	{
		parent::__construct();

		// load helper
		$this->load->helper('text');
	}

	/**
	 * home page
	 * --------------------------------------------------------	 *
	 * @author Long Nguyen
	 * @link http://lnguyen.info
	 * @version 1.0
	 * @package Treasury
	 */
	public function index($offset = 0)
	{
		// load helper
		$this->load->helper('user');

		// limit
		$limit = 20;
		// get newest shops
		$this->newest_shops = $this->auth->limit(2)->users(3)->result();
		$this->promotions = Model\Promotion::where('status', 1)->order_by('date_from', 'desc')->limit($limit, $offset)->all();

		// pagination
		$this->load->library('pagination');
		$this->pagination->initialize(array(
			'base_url' => site_url(),
			'per_page' => $limit,
			'uri_segment' => 1,
			'total_rows' => count(Model\Promotion::select('id')->where('status', 1)->all())
		));

		// add assets
		add_assets('http://maps.google.com/maps/api/js?sensor=false');
		add_assets('functions/site/index.js');

		// template render
		$this->template
			->set_title(config_item('site_name'), 'Home page')
			->render();
	}

	/**
	 * home page
	 * --------------------------------------------------------	 *
	 * @author Long Nguyen
	 * @link http://lnguyen.info
	 * @version 1.0
	 * @package Treasury
	 */
	public function search()
	{
		// add assets
		add_assets('http://maps.google.com/maps/api/js?sensor=false');
		add_assets('functions/search.js');

		// template render
		$this->template
			->set_title(config_item('site_name'), 'Search', config_item('query_string'))
			->render();
	}

	/**
	 * about us page
	 * --------------------------------------------------------	 *
	 * @author Long Nguyen
	 * @link http://lnguyen.info
	 * @version 1.0
	 * @package Treasury
	 */
	public function about_us()
	{
		// add asset
		add_assets('functions/site/aboutus.js');

		// template render
		$this->template
			->set_title(config_item('site_name'), 'About us')
			->render();
	}

	/**
	 * terms and conditions page
	 * --------------------------------------------------------	 *
	 * @author Long Nguyen
	 * @link http://lnguyen.info
	 * @version 1.0
	 * @package Treasury
	 */
	public function terms_and_conditions()
	{
		// add asset
		add_assets('functions/site/termsandconditions.js');

		// template render
		$this->template
			->set_title(config_item('site_name'), 'Terms and Conditions')
			->render();
	}

	/**
	 * contact page
	 * --------------------------------------------------------	 *
	 * @author Long Nguyen
	 * @link http://lnguyen.info
	 * @version 1.0
	 * @package Treasury
	 */
	public function contact_us()
	{
		// add asset
		add_assets('functions/site/contactus.js');

		// template render
		$this->template
			->set_title(config_item('site_name'), 'Contact us')
			->render();
	}

	/**
	 * page
	 * --------------------------------------------------------	 *
	 * @author Long Nguyen
	 * @link http://lnguyen.info
	 * @version 1.0
	 * @package Treasury
	 */
	public function page_home($num, $name)
	{
		$page = new stdClass;
		$page->content = config_item('page_home_content_'.$num);
		$page->title = config_item('page_home_title_'.$num);
		$page->code ='page_home_content_'.$num;
		// template render
		$this->template
			->set('page', $page)
			->set_title(config_item('site_name'), $page->title)
			->render();
	}

	/**
	 * 404 page
	 * --------------------------------------------------------	 *
	 * @author Long Nguyen
	 * @link http://lnguyen.info
	 * @version 1.0
	 * @package Treasury
	 */
	public function page_404()
	{
		// template render
		$this->template
			->set_title(config_item('site_name'), '404 not found')
			->render();
	}

	/**
	 * 404 page
	 * --------------------------------------------------------	 *
	 * @author Long Nguyen
	 * @link http://lnguyen.info
	 * @version 1.0
	 * @package Treasury
	 */
	public function get_all_promotion()
	{
		$this->load->helper('text');

		$items = Model\Promotion::where('status', 1)->all();
		$output = array(
			'total_items' => 0,
			'items' => array()
		);

		foreach($items as $item)
		{
			$owner = $item->owner();
			$output['items'][] = array(
				'title' => $item->title,
				'content' => word_limiter($item->content, 30),
				'date_from' => $item->date_from,
				'date_to' => $item->date_to,
				'gender_limit' => $item->gender_limit,
				'age_limit' => $item->age_limit,
				'latitude' => $item->latitude,
				'longitude' => $item->longitude,
				'owner' => array(
					'id' => $owner->id,
					'username' => $owner->username,
					'fullname' => $owner->fullname(),
					'company' => $owner->company,
					'phone' => $owner->phone,
					'email' => $owner->email,
					'address' => $owner->address,
					'website' => $owner->website
				)
			);
		}

		$output['total_items'] = count($items);

		if($this->input->is_ajax_request())
		{
			$this->response->import($output)->json();
		}
		else
		{
			redirect('', 'refresh');
		}
	}

	/**
	 * 404 page
	 * --------------------------------------------------------	 *
	 * @author Long Nguyen
	 * @link http://lnguyen.info
	 * @version 1.0
	 * @package Treasury
	 */
	public function get_all_shop()
	{
		if(!$this->input->is_ajax_request())
		{
			redirect('', 'refresh');
		}

		$this->load->helper('text');

		// if($this->auth->logged_in())
		// {
		// 	$shop_ids = array();
		// 	$shops = Model\Favorite\User_Shop::select('shop_id')->where('user_id', $this->auth->get_user_id())->all();
		// 	foreach($shops as $shop)
		// 	{
		// 		$shop_ids[] = $shop->shop_id;
		// 	}

		// 	if(count($shop_ids))
		// 	{
		// 		$items = $this->auth->where('id', $shop_ids);
		// 	}
		// }
		// else
		{
			$items = $this->auth->where('active', 1)->users(3);
		}
		$output = array(
			'total_items' => 0,
			'items' => array()
		);

		if(isset($items))
		{
			foreach($items->result() as $item)
			{
				$output['items'][] = array(
					'id' => $item->id,
					'username' => $item->username,
					'fullname' => implode(' ', array($item->first_name, $item->last_name)),
					'store_name_seo' => url_title(implode(' ', array($item->first_name, $item->last_name)), '-', true),
					'company' => $item->company,
					'phone' => $item->phone,
					'avatar' => $item->avatar,
					'email' => $item->email,
					'latitude' => $item->latitude,
					'longitude' => $item->longitude,
					'address' => $item->address,
					'website' => $item->website
				);
			}
		}

		$output['total_items'] = isset($items) ? count($items) : 0;
		$this->response->import($output)->json();
	}

	/**
	 * 404 page
	 * --------------------------------------------------------	 *
	 * @author Long Nguyen
	 * @link http://lnguyen.info
	 * @version 1.0
	 * @package Treasury
	 */
	public function save_page()
	{
		$page_name = $this->input->post('page');
		$content = $this->input->post('content', true);

		$page = Model\Option::where('option_name', $page_name)->first();

		if(is_null($page))
		{
			$page = new Model\Option();
			$page->option_name = $page_name;
			$page->auto_load = 1;
		}

		$page->option_value = $content;

		if($page->save())
		{
			if($this->input->is_ajax_request())
			{
				$this->response->status(true)->message('Changes saved.')->json();
			}
			else
			{
				redirect('', 'refresh');
			}
		}
		else
		{
			if($this->input->is_ajax_request())
			{
				$this->response->status(false)->message('You can not save at the moment.')->json();
			}
			else
			{
				redirect('', 'refresh');
			}
		}
	}

	/**
	 * update page title
	 * --------------------------------------------------------	 *
	 * @author Long Nguyen
	 * @link http://lnguyen.info
	 * @version 1.0
	 * @package Treasury
	 */
	public function update_page_title()
	{
		$page_name = $this->input->post('page');
		$page_name = str_replace('content', 'title', $page_name);
		$content = $this->input->post('content', true);

		$page = Model\Option::where('option_name', $page_name)->first();

		if(is_null($page))
		{
			$page = new Model\Option();
			$page->option_name = $page_name;
			$page->auto_load = 1;
		}

		$page->option_value = $content;

		if($page->save())
		{
			if($this->input->is_ajax_request())
			{
				$this->response->status(true)->message('Changes saved.')->json();
			}
			else
			{
				redirect('', 'refresh');
			}
		}
		else
		{
			if($this->input->is_ajax_request())
			{
				$this->response->status(false)->message('You can not change at the moment.')->json();
			}
			else
			{
				redirect('', 'refresh');
			}
		}
	}
}