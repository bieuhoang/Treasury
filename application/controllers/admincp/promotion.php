<?php defined('BASEPATH') or exit('No direct script access allowed.');

class Promotion extends Admin_Controller
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
	public function index($offset = 0)
	{
		$limit = 20;
		$this->template->set('items', Model\Promotion::with('owner')->order_by('created_at', 'desc')->limit($limit, $offset)->all());
		$total_rows = Model\Promotion::count_all();

		$this->load->library('pagination');
		$this->pagination->initialize(array(
			'base_url' => site_url('admin/promotion/index/'),
			'per_page' => $limit,
			'uri_segment' => 4,
			'total_rows' => $total_rows
		));

		// add assets
		add_assets(array('functions/admincp/promotion.index.js'));

		$this->template
			->set_title(config_item('site_name'), 'Promotions Management')			
			->set('offset', $offset)
			->set('limit', $limit)
			->set('pagination_links', $this->pagination->create_links())
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
	public function edit($id = 0)
	{
		// submit form
		if( isset($_POST['submited']) )
		{
			$id = $this->input->post('id');
			if($id)
			{
				$model = Model\Promotion::find($id);
			}
			else
			{
				$model = new Model\Promotion();
			}

			$model->title = $this->input->post('title', true);
			$model->content = $this->input->post('content', true);

			$date = $this->input->post('date_from_date', true);
			if(! $date)
			{
				$date = date('Y/m/d');
			}
			$time = $this->input->post('date_from_time', true);
			if(! $time)
			{
				$time = date('h:i a');
			}
			$date_from = date('Y-m-d H:i:s', strtotime($date.' '.$time));
			$model->date_from = $date_from;
			$date = $this->input->post('date_to_date', true);
			if(! $date)
			{
				$date = date('Y/m/d');
			}
			$time = $this->input->post('date_to_time', true);
			if(! $time)
			{
				$time = date('h:i a');
			}
			$date_to = date('Y-m-d H:i:s', strtotime($date.' '.$time));
			$model->date_to = $date_to;
			$model->gender_limit = $this->input->post('gender_limit', true);
			$model->age_limit = $this->input->post('age_limit', true);
			$model->created_by = $this->input->post('created_by', true);

			// image
			if(!empty($_FILES['userfile']))
			{
				$upload_path = 'uploads/promotions/'.$model->created_by.'/'.date('Ymd').'/';
				if(! is_dir($upload_path))
				{
					mkdir($upload_path, 0777, 1);
				}

				$this->load->library('upload');
				$this->upload->initialize(array(
					'upload_path' => $upload_path,
					'allowed_types' => 'jpeg|png|jpg|gif',
					'encrypt_name' => true,
					'max_width' => '1024',
					'max_height' => '768'
				));

				if($this->upload->do_upload('userfile'))
				{
					$upload_data = $this->upload->data();
					$image = $upload_path . $upload_data['file_name'];
					$model->image = $image;
				}
			}

			if($model->save(TRUE))
			{
				$this->template->set_message(($id ? 'Updated successfully' : 'Added new successfully'), 'success');
			}
			else
			{
				$this->template->set_message(($id ? 'Update not success' : 'Add new not success'), 'error');
			}

			redirect('admin/promotion/edit/'.$id, 'refresh');
		}

		if($id)
		{
			$promotion = Model\Promotion::find($id);
			$this->template->set('promotion', $promotion);
		}

		add_assets(array('functions/admincp/promotion.edit.js'));

		$this->template
			->set_title(config_item('site_name'), 'Edit promotion')
			->set('id', $id)
			->set('stores', Model\Group::find(3)->users())
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
	public function remove()
	{
		$id = $this->input->post('id');
		$promotion = Model\Promotion::find($id);

		if(is_null($promotion))
		{
			if($this->input->is_ajax_request())
			{
				$this->response->status(false)->message('Promotion is not exists or deleted.')->json();
			}
			else
			{
				show_404();
				return;
			}
		}

		if($promotion->delete())
		{
			$status = true;
			$msg = 'Deleted successfully';
		}
		else
		{
			$status = false;
			$msg = 'Can not delete promotion at the moment';
		}

		if($this->input->is_ajax_request())
		{
			$this->response->status($status)->message($msg)->json();
		}
		else
		{
			redirect('admin/promotion', 'refresh');
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
	public function block()
	{
		$id = $this->input->post('id');
		$promotion = Model\Promotion::find($id);

		if(is_null($promotion))
		{
			if($this->input->is_ajax_request())
			{
				$this->response->status(false)->message('Promotion is not exists or deleted.')->json();
			}
			else
			{
				show_404();
				return;
			}
		}

		$promotion->status = 0;

		if($promotion->save())
		{
			$status = true;
			$msg = 'Blocked successfully';
		}
		else
		{
			$status = false;
			$msg = 'Can not block promotion at the moment';
		}

		if($this->input->is_ajax_request())
		{
			$this->response->status($status)->message($msg)->json();
		}
		else
		{
			redirect('admin/promotion', 'refresh');
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
	public function active()
	{
		$id = $this->input->post('id');
		$promotion = Model\Promotion::find($id);

		if(is_null($promotion))
		{
			if($this->input->is_ajax_request())
			{
				$this->response->status(false)->message('Promotion is not exists or deleted.')->json();
			}
			else
			{
				show_404();
				return;
			}
		}

		$promotion->status = 1;

		if($promotion->save())
		{
			$status = true;
			$msg = 'Actived successfully';
		}
		else
		{
			$status = false;
			$msg = 'Can not active promotion at the moment';
		}

		if($this->input->is_ajax_request())
		{
			$this->response->status($status)->message($msg)->json();
		}
		else
		{
			redirect('admin/promotion', 'refresh');
		}
	}
public function pending(){
		$id = $this->input->post('id');
		$promotion = Model\Promotion::find($id);

		if(is_null($promotion))
		{
			if($this->input->is_ajax_request())
			{
				$this->response->status(false)->message('Promotion is not exists or deleted.')->json();
			}
			else
			{
				show_404();
				return;
			}
		}

		$promotion->status = 2;

		if($promotion->save())
		{
			$status = true;
			$msg = 'change To Pending successfully';
		}
		else
		{
			$status = false;
			$msg = 'Can not pending promotion at the moment';
		}

		if($this->input->is_ajax_request())
		{
			$this->response->status($status)->message($msg)->json();
		}
		else
		{
			redirect('admin/promotion', 'refresh');
		}
	}
}