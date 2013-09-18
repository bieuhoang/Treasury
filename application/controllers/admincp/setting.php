<?php defined('BASEPATH') or exit('No direct script access allowed.');

class Setting extends Admin_Controller
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
	}

	/**
	 * Setting general page
	 * --------------------------------------------------------	 *
	 * @author Long Nguyen
	 * @link http://lnguyen.info
	 * @version 1.0
	 * @package Treasury
	 */
	public function index()
	{
		if($this->input->post())
		{
			$datas = $this->input->post('form');
			foreach($datas as $field => $value)
			{
				$option = Model\Option::where('option_name', $field)->first();
				if($option)
				{
					$option->option_value = $value;
				}
				else
				{
					$option = new Model\Option();
					$option->option_name = $field;
					$option->option_value = $value;
					$option->auto_load = 1;
				}

				// save
				if($option->save())
				{
					$this->config->set_item($field, $value);
				}
			}
		}

		// add assets
		add_assets(array('functions/admincp/setting.js'));

		// template render
		$this->template
			->set_title(config_item('site_name'), 'Settings')
			->render();
	}
}