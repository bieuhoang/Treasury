<?php defined('BASEPATH') or exit('No direct script access allowed.');

class User extends Admin_Controller
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
	 * Users management page
	 * --------------------------------------------------------	 *
	 * @author Long Nguyen
	 * @link http://lnguyen.info
	 * @version 1.0
	 * @package Treasury
	 */
	public function index()
	{
		$this->template->set('items', Model\User::all());

		// add assets
		add_assets(array('functions/admincp/user.index.js'));

		// template render
		$this->template
			->set_title(config_item('site_name'), 'Users Management')
			->render();
	}

	/**
	 * Add new user page
	 * --------------------------------------------------------	 *
	 * @author Long Nguyen
	 * @link http://lnguyen.info
	 * @version 1.0
	 * @package Treasury
	 */
	public function edit($id = 0)
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'email|required');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('repassword', 'Retype Password', 'required');
		$this->form_validation->set_rules('group_id', 'Group', 'required');
		$birthDayStr = $this->input->post('birthday', true);
		if($birthDayStr != null){
			$time = strtotime($birthDayStr);
		}

		if($this->form_validation->run() === TRUE)
		{
			$password = $this->input->post('password', true);
			$repassword = $this->input->post('repassword', true);

			// check password match
			if($password == $repassword)
			{
				$email = $this->input->post('email', true);

				if($this->auth->email_check($email))
				{
					if($this->input->is_ajax_request())
					{
						$this->response->status(false)->message('Email is exists already')->json();
					}
				}
				else
				{
					$username = $this->input->post('username', true);
					$username = $this->input->post('username', true);
					$company = $this->input->post('company', true);
					$phone = $this->input->post('phone', true);
					$first_name = $this->input->post('first_name', true);
					$last_name = $this->input->post('last_name', true);
					$group = $this->input->post('group_id', true);

					$profiles = array(
						'first_name' => $first_name,
						'last_name' => $last_name,
						'company' => $company,
						'phone' => $phone,
						'birthday' => $time,
					);

					$profiles['address'] = $this->input->post('address') ? $this->input->post('address') : '';
					$profiles['zip'] = $this->input->post('zip') ? $this->input->post('zip') : '';
					$profiles['city'] = $this->input->post('city') ? $this->input->post('city') : '';
					$profiles['cat_id'] = $this->input->post('cat_id') ? $this->input->post('cat_id') : '';

					if($this->auth->register($username, $password, $email, $profiles, array($group)))
					{
						if($this->input->is_ajax_request())
						{
							$this->response->status(true)->message('Register member successfully')->json();
						}
						else
						{
							$this->template->set_message('Register member successfully', 'success');
						}
					}
					else
					{
						if($this->input->is_ajax_request())
						{
							$this->response->status(false)->message('Can not register member at the moment.')->json();
						}
						else
						{
							$this->template->set_message('Can not register member at the moment.', 'error');
						}
					}
				}
			}
			else
			{
				if($this->input->is_ajax_request())
				{
					$this->response->status(false)->message('Password does not match')->json();
				}
				else
				{
					$this->template->set_message('Password does not match.', 'error');
				}
			}				
		}
		else
		{
			if($this->input->is_ajax_request())
			{
				$this->response->status(false)->message(validation_errors('', ''))->json();
			}
			else
			{
				$this->template->set_message(validation_errors(), 'error');
			}
		}

		// add assetts
		add_assets(array(
			'functions/admincp/user.edit.js'
		));

		$title = '';
		$users_groups = array();
		if($id)
		{
			$user = $this->auth->user($id)->row();
			$this->template->set('user', $user);
			$title = 'Edit user: #'.$user->id;
			foreach($this->auth->get_users_groups($user->id)->result() as $group)
			{
				$users_groups[] = $group->id;
			}
		}
		else
		{
			$title = 'Add new user';
		}

		// template render
		$this->template
			->set_title(config_item('site_name'), $title)
			->set('heading', $title)
			->set('users_groups', $users_groups)
			->set('categories', Model\Category::all())
			->render();
	}

	/**
	 * do block user
	 * --------------------------------------------------------	 *
	 * @author Long Nguyen
	 * @link http://lnguyen.info
	 * @version 1.0
	 * @package Treasury
	 */
	public function block()
	{
		$id = $this->input->post('id');

		if($id)
		{
			if(Model\User::find($id))
			{
				$return = $this->auth->deactivate($id);

				if($return)
				{
					if($this->input->is_ajax_request())
					{
						exit(json_encode(array('status' => true, 'msg' => '')));
					}
					else
					{
						redirect('admin/user', 'refresh');
					}
				}
				else
				{
					if($this->input->is_ajax_request())
					{
						exit(json_encode(array('status' => false, 'msg' => 'Can not block this user at the moment. Please try again later.')));
					}
					else
					{
						redirect('admin/user', 'refresh');
					}
				}
			}
		}

		if($this->input->is_ajax_request())
		{
			exit(json_encode(array('status' => true, 'msg' => 'This user is not exists or deleted.')));
		}
		else
		{
			redirect('admin/user', 'refresh');
		}
	}

	/**
	 * do block user
	 * --------------------------------------------------------	 *
	 * @author Long Nguyen
	 * @link http://lnguyen.info
	 * @version 1.0
	 * @package Treasury
	 */
	public function active()
	{
		$id = $this->input->post('id');

		if($id)
		{
			if(Model\User::find($id))
			{
				$return = $this->auth->activate($id);

				if($return)
				{
					if($this->input->is_ajax_request())
					{
						exit(json_encode(array('status' => true, 'msg' => '')));
					}
					else
					{
						redirect('admin/user', 'refresh');
					}
				}
				else
				{
					if($this->input->is_ajax_request())
					{
						exit(json_encode(array('status' => false, 'msg' => 'Can not block this user at the moment. Please try again later.')));
					}
					else
					{
						redirect('admin/user', 'refresh');
					}
				}
			}
		}

		if($this->input->is_ajax_request())
		{
			exit(json_encode(array('status' => true, 'msg' => 'This user is not exists or deleted.')));
		}
		else
		{
			redirect('admin/user', 'refresh');
		}
	}

	/**
	 * do delete user
	 * --------------------------------------------------------	 *
	 * @author Long Nguyen
	 * @link http://lnguyen.info
	 * @version 1.0
	 * @package Treasury
	 */
	public function remove()
	{
		$id = $this->input->post('id');

		if($id)
		{
			$user = new Model\User();
			if($user->find($id))
			{
				$return = $this->auth->delete_user($id);

				if($return)
				{
					if($this->input->is_ajax_request())
					{
						exit(json_encode(array('status' => true, 'msg' => '')));
					}
					else
					{
						redirect('admin/user', 'refresh');
					}
				}
				else
				{
					if($this->input->is_ajax_request())
					{
						exit(json_encode(array('status' => false, 'msg' => 'Can not delete this user at the moment. Please try again later.')));
					}
					else
					{
						redirect('admin/user', 'refresh');
					}
				}
			}
		}

		if($this->input->is_ajax_request())
		{
			exit(json_encode(array('status' => true, 'msg' => 'This user is not exists or deleted.')));
		}
		else
		{
			redirect('admin/user', 'refresh');
		}
	}
}