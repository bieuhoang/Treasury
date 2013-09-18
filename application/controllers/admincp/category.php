<?php defined('BASEPATH') or exit('No direct script access allowed.');

class Category extends Admin_Controller
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
	 * Promotion page
	 * --------------------------------------------------------	 *
	 * @author Long Nguyen
	 * @link http://lnguyen.info
	 * @version 1.0
	 * @package Treasury
	 */
	public function index($id = 0)
	{
		if($id)
		{
			$this->template->set('cat', Model\Category::find($id));
		}

		// add assets
		add_assets('functions/admincp/category.index.js');

		$items = Model\Category::with('stores')->all();
		$this->template
			->set('items', $items)
			->set_title(config_item('site_name'), 'Categories Management')
			->render();
	}

	/**
	 * Create new promotion page
	 * --------------------------------------------------------	 *
	 * @author Long Nguyen
	 * @link http://lnguyen.info
	 * @version 1.0
	 * @package Treasury
	 */
	public function add()
	{
		$this->load->library('form_validation');
		$this->form_validation
			->set_rules('title', 'Title', 'required');

		if($this->form_validation->run() === TRUE)
		{
			$cat = Model\Category::make(array(
				'title' => $this->input->post('title', true),
				'description' => $this->input->post('description', true)
			));

			if($cat->save(TRUE))
			{
				$this->template->set_message('Added category successfully', 'success');
			}
			else
			{
				$this->template->set_message('Can not add category at the moment', 'error');
			}
			redirect('admin/category', 'refresh');

		}
	}

	/**
	 * Create new promotion page
	 * --------------------------------------------------------	 *
	 * @author Long Nguyen
	 * @link http://lnguyen.info
	 * @version 1.0
	 * @package Treasury
	 */
	public function update()
	{
		$id = $this->input->post('id');
		$cat = Model\Category::find($id);
		if($cat)
		{

			$this->load->library('form_validation');
			$this->form_validation
				->set_rules('title', 'Title', 'required');

			if($this->form_validation->run() === TRUE)
			{
				$cat->title = $this->input->post('title', true);
				$cat->description = $this->input->post('description', true);

				if($cat->save())
				{
					$this->template->set_message('Updated category successfully', 'success');
				}
				else
				{
					$this->template->set_message('Can not update category at the moment', 'error');
				}
			}

			redirect('admin/category', 'refresh');
		}
	}

	/**
	 * Create new promotion page
	 * --------------------------------------------------------	 *
	 * @author Long Nguyen
	 * @link http://lnguyen.info
	 * @version 1.0
	 * @package Treasury
	 */
	public function delete()
	{
		$id = $this->input->post('id');
		$cat = Model\Category::find($id);
		if($cat)
		{
			if($cat->delete())
			{
				$this->template->set_message('Deleted category successfully', 'success');
			}
			else
			{
				$this->template->set_message('Can not delete category at the moment', 'error');
			}

			redirect('admin/category', 'refresh');
		}
	}
}