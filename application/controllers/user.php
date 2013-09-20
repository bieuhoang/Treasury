<?php

defined('BASEPATH') or exit('No direct script access allowed.');

class User extends Site_Controller {

	// --------------------------------------------------------------------
	// __construct()
	// --------------------------------------------------------------------

	public function __construct() {
		parent::__construct();
	}

	// --------------------------------------------------------------------
	// login page
	// --------------------------------------------------------------------

	public function login() {
		if ( $this->auth->logged_in() ) {
			redirect();
		}

		// add asset
		add_assets(array ('functions/user/login.js'));

		if ( $this->input->post('form') ) {
			$data		 = $this->input->post('form', TRUE);
			$remember	 = $this->input->post('remember');
			if ( $this->auth->login($data['email'], $data['password'], $remember) === false ) {
				$this->auth->set_error_delimiters('', '');
				$errors = $this->auth->errors_array();
				$this->template
						->set('message', '<strong>Error:</strong> ' . implode('<br>', $errors) . '.');
			}
			else {
				if ( $this->auth->in_group(3) ) { // is owner group
					redirect('store-dashboard');
				}
				else {
					if ( $this->auth->in_group(1) ) {
						redirect('admin');
					}
					else {
						redirect('my-dashboard');
					}
				}
			}
		}

		$this->template
				->set_title(config_item('site_name'), 'Login')
				->render();
	}

	// --------------------------------------------------------------------
	// logout
	// --------------------------------------------------------------------

	public function logout() {
		$this->auth->logout();
		redirect();
	}

	// --------------------------------------------------------------------
	// register
	// --------------------------------------------------------------------

	public function register() {
		// $this->auth->register('owner', 'password', 'owner@admin.com', array('first_name' => 'Shop', 'last_name' => 'Owner'), array(3));
		// $this->auth->register('user', 'password', 'user@admin.com', array('first_name' => 'Normal', 'last_name' => 'User'), array(2));
		$this->form_validation
				->set_rules('form[username]', 'Username', 'required')
				->set_rules('form[password]', 'Password', 'required')
				->set_rules('form[repassword]', 'Retype Password', 'required')
				->set_rules('form[email]', 'Email address', 'required|email');

		if ( $this->form_validation->run() == TRUE ) {
			$form = $this->input->post('form');

			// email check
			if ( $this->auth->email_check($form['email']) ) {
				$this->response->import(array (
					'status' => false,
					'msg' => 'Email is exists already'
				))->json();
			}

			// send mail confirm
			$this->auth->set_hook('post_register', 'register_sendmail', 'Model\User', 'sendmail', array ($form));

			if ( $this->auth->register(
							xss_clean($form['username']), xss_clean($form['password']), xss_clean($form['email']), array (
						'first_name' => xss_clean($form['first_name']),
						'last_name' => xss_clean($form['last_name']),
						'company' => xss_clean($form['company']),
						'phone' => xss_clean($form['phone']),
						'birthday' => xss_clean($form['birthday']),
						'gender' => xss_clean($form['gender'])
							), array (2)
					) ) {
				// login
				$this->auth->login($form['username'], $form['password']);

				// response
				$status	 = true;
				$msg	 = 'Register successfully';
			}
			else {
				$status	 = false;
				$msg	 = $this->auth->errors();
			}

			if ( $this->input->is_ajax_request() ) {
				if ( $status ) {
					$this
							->response
							->import(array (
								'redirect' => 'my-dashboard'
					));
				}

				$this
						->response
						->status($status)
						->message($msg)
						->json();
			}
		}
		else {
			if ( $this->input->is_ajax_request() ) {
				$this
						->response
						->status($status)
						->message(validation_errors())
						->json();
			}
			else {
				$this->template->set('form_errors', validation_errors());
			}
		}

		add_assets('functions/user/register.js');

		$this->template
				->set_title(config_item('site_name'), 'Register for normal user')
				->render();
	}

	// --------------------------------------------------------------------
	// register for shop owner
	// --------------------------------------------------------------------

	public function register_shop() {
		$this->form_validation
				->set_rules('form[username]', 'Username', 'required')
				->set_rules('form[password]', 'Password', 'required')
				->set_rules('form[repassword]', 'Retype Password', 'required')
				->set_rules('form[email]', 'Email address', 'required|email');

		if ( $this->form_validation->run() == TRUE ) {
			$form = $this->input->post('form');

			$email_check = $this->auth->email_check($form['email']);
			// email check
			if ( $email_check ) {
				$this->response
						->status(false)
						->message('Email is exists already')
						->json();
			}

			// send mail confirm
			$this->auth->set_hook('post_register', 'register_sendmail', 'Model\User', 'sendmail', array ($form));

			// logo
			$logo = '';
			if ( !empty($_FILES['userfile']) ) {
				$upload_path = 'uploads/users/';
				if ( !is_dir($upload_path) ) {
					mkdir($upload_path, 0777, 1);
				}

				$this->load->library('upload');
				$this->upload->initialize(array (
					'upload_path' => $upload_path,
					'allowed_types' => 'jpeg|png|jpg|gif',
					'encrypt_name' => true,
					'max_width' => '1024',
					'max_height' => '768'
				));

				if ( $this->upload->do_upload('userfile') ) {
					$upload_data = $this->upload->data();
					$logo		 = $upload_path . $upload_data['file_name'];
				}
			}

			if ( $user_id = $this->auth->register(
							xss_clean($form['username']), xss_clean($form['password']), xss_clean($form['email']), array (
						'first_name' => xss_clean($form['first_name']),
						'last_name' => xss_clean($form['last_name']),
						'address' => xss_clean($form['address']),
						'zip' => xss_clean($form['zip']),
						'city' => xss_clean($form['city']),
						'public_text' => isset($form['public_text']) ? xss_clean($form['public_text']) : '',
						'avatar' => $logo
							), array (3)
					) ) {
				// login
				$this->auth->login($form['username'], $form['password']);

				// response
				$status	 = true;
				$msg	 = 'Register successfully';
			}
			else {
				$status	 = false;
				$msg	 = $this->auth->errors();
			}

			if ( $this->input->is_ajax_request() ) {
				if ( $status ) {
					$this->response->import(array (
						'redirect' => 'store/'.$user_id.'-'.url_title($form['first_name'].' '.$form['last_name'])
					));
				}

				$this->response
					->status($status)
					->message($msg)
					->json();
			}
		}
		else {
			$this->template->set('form_errors', validation_errors());
		}
		// add assets
		add_assets('functions/user/register.js');

		// assign template vars
		$this->template
				->set('categories', Model\Category::all())
				->set_title(config_item('site_name'), 'Register for shop owner')
				->render();
	}

	// --------------------------------------------------------------------
	// forgot password
	// --------------------------------------------------------------------

	public function forgot_password() {
		$this->form_validation->set_rules('email', 'Email address', 'required|email');

		if ( $this->form_validation->run() === true ) {
			$email = $this->input->post('email', true);
			if ( $this->auth->email_check($email) ) {
				$user		 = Model\User::where('email', $email)->first();
				$forgotten	 = $this->auth_model->forgotten_password($user->username);

				if ( $forgotten ) {
					Model\User::send_mail_forgot_password($email, $user->username, Model\User::find($user->id)->forgotten_password_code);
					$status	 = true;
					$message = 'We just sent an email to: ' . $email;
				}
				else {
					$status	 = false;
					$message = $this->auth->errors();
				}

				//
				$this->template->set_message($message, $status ? 'success' : 'error');
				if ( $status ) {
					redirect('login', 'refresh');
				}
				else {
					redirect('forgot-password', 'refresh');
				}
			}
			else {
				$this->template->set_message('Email is not exists.', 'error');
				redirect('forgot-password', 'refresh');
			}
		}

		$this->template
				->set_title(config_item('site_name'), 'Forgot password')
				->render();
	}

	// --------------------------------------------------------------------
	// forgot password
	// --------------------------------------------------------------------

	public function reset_password($code = null) {
		if ( is_null($code) ) {
			redirect('login', 'refresh');
		}

		$user = Model\User::where('forgotten_password_code', $code)->first();
		if ( !$user ) {
			$this->template->set_message('Code is expired or not exists.', 'error');
			redirect('login', 'refresh');
		}

		// to reset password
		$new_password = $this->auth_model->forgotten_password_complete($code);

		if ( $new_password ) {  //if the reset worked then send them to the login page
			Model\User::send_mail_forgot_password_success($user->email, $user->username, $new_password);
			$this->template->set_message($this->auth->messages(), 'success');
			redirect("login", 'refresh');
		}

		//if the reset didnt work then send them back to the forgot password page
		else {
			$this->template->set_message($this->auth->errors(), 'error');
			redirect("forgot-password", 'refresh');
		}
	}

	// --------------------------------------------------------------------
	// profile
	// --------------------------------------------------------------------

	public function my_profile() {
		// check user login
		if ( !$this->auth->logged_in() ) {
			if ( $this->input->is_ajax_request() ) {
				$this->response->status(false)->message('')->import(array ('required_login' => true))->json();
			}
			else {
				redirect('login', 'refresh');
			}
		}

		// add assets
		if ( $this->auth->in_group(array (3)) ) {
			add_assets('http://maps.google.com/maps/api/js?sensor=false');
		}
		add_assets(array ('functions/user/myprofile.js'));

		// template render
		$this->template
				->set_block('user_sidebar', 'user/blocks/sidebar')
				->set_title(config_item('site_name'), 'My Profile')
				->render();
	}

	// --------------------------------------------------------------------
	// my store (for owner group)
	// --------------------------------------------------------------------

	public function update_profile() {
		$this->load->library('form_validation');
		// $this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|email');
		if ( $this->form_validation->run() === TRUE ) {
			// $username = $this->input->post('username', true);
			$password	 = $this->input->post('password', true);
			$repassword	 = $this->input->post('repassword', true);

			if ( $password != $repassword ) {
				$status	 = false;
				$msg	 = 'Password does not match';
			}
			else {
				$data = array (
					// 'username' => $username,
					'first_name' => $this->input->post('first_name', true),
					'last_name' => $this->input->post('last_name', true),
					'company' => $this->input->post('company', true),
					'phone' => $this->input->post('phone', true),
					'email' => $this->input->post('email', true)
				);

				// avatar
				if ( !empty($_FILES['userfile']) ) {
					$upload_path = 'uploads/avatar/';
					if ( !is_dir($upload_path) ) {
						mkdir($upload_path, 0777, 1);
					}

					$this->load->library('upload');
					$this->upload->initialize(array (
						'upload_path' => $upload_path,
						'allowed_types' => 'jpeg|png|jpg|gif',
						'encrypt_name' => true,
						'max_width' => '1024',
						'max_height' => '768'
					));

					if ( $this->upload->do_upload('userfile') ) {
						$upload_data	 = $this->upload->data();
						$avatar			 = $upload_path . $upload_data['file_name'];
						$data['avatar']	 = $avatar;
					}
					else {
						$this->response->status(false)->message($this->upload->display_errors())->json();
					}
				}

				if ( $this->input->post('latitude') and $this->input->post('longitude') ) {
					$data['latitude']	 = $this->input->post('latitude', true);
					$data['longitude']	 = $this->input->post('longitude', true);
				}

				if ( $this->input->post('public_text') ) {
					$data['public_text'] = $this->input->post('public_text', true);
				}

				if ( $this->input->post('address') ) {
					$data['address'] = $this->input->post('address', true);
				}

				if ( $this->input->post('zip') ) {
					$data['zip'] = $this->input->post('zip', true);
				}

				if ( $this->input->post('city') ) {
					$data['city'] = $this->input->post('city', true);
				}

				if ( $password !== '' ) {
					$data['password'] = $password;
				}

				if ( $this->auth->update($this->current_user->id, $data) ) {
					$status	 = true;
					$msg	 = 'Updated profile successfully';
				}
				else {
					$status	 = false;
					$msg	 = 'Can not update profile at the moment.';
				}
			}

			if ( $this->input->is_ajax_request() ) {
				if ( isset($avatar) ) {
					$this->response->import(array (
						'avatar' => $avatar
					));
				}
				$this->response->status($status)->message($msg)->json();
			}
			else {
				$this->template->set_message($msg, $status ? 'success' : 'error');
				redirect('my-profile', 'refresh');
			}
		}
		else {
			if ( $this->input->is_ajax_request() ) {
				$this->response->status(false)->message(validation_errors('', ''))->json();
			}
		}
	}

	// --------------------------------------------------------------------
	// my store (for owner group)
	// --------------------------------------------------------------------

	public function my_store($offset = 0) {
		// check user login
		if ( !$this->auth->logged_in() ) {
			redirect('login');
		}

		// check permission
		if ( !$this->auth->in_group(array (3)) ) {
			show_error('Can not access this page', 403);
		}

		$limit = 25;

		$this->promotion = new Model\Promotion();
		$this->template->set('items', $this->promotion->where('created_by', $this->current_user->id)->limit($limit, $offset)->all());

		// total rows
		$this->promotion = new Model\Promotion();
		$total_rows		 = $this->promotion->where('created_by', $this->current_user->id)->count_all();

		// pagination
		$this->load->library('pagination');
		$this->pagination->initialize(array (
			'base_url' => site_url('my-store'),
			'per_page' => $limit,
			'uri_segment' => 2,
			'total_rows' => $total_rows
		));

		// add assets
		add_assets(array ('functions/user/mystore.js'));

		$this->template
				->set_block('user_sidebar', 'user/blocks/sidebar')
				->set_title(config_item('site_name'), 'My Store')
				->set('pagination_links', $this->pagination->create_links())
				->render();
	}

	// --------------------------------------------------------------------
	// my treasury (for owner group)
	// --------------------------------------------------------------------

	public function my_treasury() {
		// check user login
		if ( !$this->auth->logged_in() ) {
			redirect('login');
		}

		// check permission
		if ( !$this->auth->in_group(array (3)) ) {
			show_error('Can not access this page', 403);
		}

		$this->template
				->set('total_promotions', count(Model\Promotion::select('id')->where('created_by', $this->current_user->id)->all()))
				->set('total_favorites', count(Model\Favorite\Promotion::select('id')->where('shop_id', $this->current_user->id)->all()))
				->set('total_user_registered', count(Model\Favorite\User_Shop::select('id')->where('shop_id', $this->current_user->id)->all()));


		// add assets
		add_assets(array ('functions/user/mytreasury.js'));

		$this->template
				->set_block('user_sidebar', 'user/blocks/sidebar')
				->set_title(config_item('site_name'), 'My Treasury')
				->render();
	}

	// --------------------------------------------------------------------
	// change password (for owner group)
	// --------------------------------------------------------------------

	public function change_password() {
		// check user login
		if ( !$this->auth->logged_in() ) {
			redirect('login');
		}

		$this->load->library('form_validation');
		$this->form_validation->set_rules('current_password', 'Current password', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('repassword', 'Re-password', 'required');
		if ( $this->form_validation->run() === TRUE ) {
			$current_password	 = $this->input->post('current_password', true);
			$new_password		 = $this->input->post('password', true);
			$repassword			 = $this->input->post('repassword', true);
			if ( $new_password == $repassword ) {
				if ( $this->auth->change_password($this->auth->user()->row()->username, $current_password, $new_password) ) {
					$status	 = true;
					$msg	 = 'Changed password successfully';
				}
				else {
					$status	 = false;
					$msg	 = $this->auth->errors();
				}

				if ( $this->input->is_ajax_request() ) {
					$this->response->status($status)->message($msg)->json();
				}
				else {
					$this->template->set_message($msg, $status ? 'success' : 'error');
				}
			}
			else {
				$this->template->set_message('Password does not match.', 'error');
			}
		}

		// add assets
		add_assets(array ('functions/user/changepassword.js'));

		$this->template
				->set_block('user_sidebar', 'user/blocks/sidebar')
				->set_title(config_item('site_name'), 'Change password')
				->render();
	}

	// --------------------------------------------------------------------
	// add new promotion (for owner group)
	// --------------------------------------------------------------------

	public function add_new_promotion() {
		// check user login
		if ( !$this->auth->logged_in() ) {
			redirect('login');
		}

		// check permission
		if ( !$this->auth->in_group(array (3)) ) {
			show_error('Can not access this page', 403);
		}

		if ( $this->input->post() ) {
			$this->load->library('form_validation');
			$this->form_validation
					->set_rules('title', 'Title', 'required')
					->set_rules('content', 'Content', 'required');
			// ->set_rules('date_from', 'Date from', 'required')
			// ->set_rules('date_to', 'Date to', 'required');

			if ( $this->form_validation->run() === TRUE ) {
				$this->promotion			 = new Model\Promotion();
				$this->promotion->title		 = $this->input->post('title', true);
				$this->promotion->content	 = $this->input->post('content', true);
				$date						 = $this->input->post('date_from_date', true);
				if ( !$date ) {
					$date = date('Y/m/d');
				}
				$time = $this->input->post('date_from_time', true);
				if ( !$time ) {
					$time = date('h:i a');
				}
				$date_from					 = date('Y-m-d H:i:s', strtotime($date . ' ' . $time));
				$this->promotion->date_from	 = $date_from;
				$date						 = $this->input->post('date_to_date', true);
				if ( !$date ) {
					$date = date('Y/m/d');
				}
				$time = $this->input->post('date_to_time', true);
				if ( !$time ) {
					$time = date('h:i a');
				}
				$date_to						 = date('Y-m-d H:i:s', strtotime($date . ' ' . $time));
				$this->promotion->date_to		 = $date_to;
				$this->promotion->latitude		 = $this->input->post('latitude', true);
				$this->promotion->longitude		 = $this->input->post('longitude', true);
				$this->promotion->gender_limit	 = $this->input->post('gender_limit', true);
				$this->promotion->age_limit		 = $this->input->post('age_groups_limit', true);
				$this->promotion->member_limit	 = $this->input->post('member_limit', true);
				$this->promotion->created_by	 = $this->current_user->id;

				// image
				if ( !empty($_FILES['userfile']) ) {
					$upload_path = 'uploads/promotions/' . $this->current_user->id . '/' . date('Ymd') . '/';
					if ( !is_dir($upload_path) ) {
						mkdir($upload_path, 0777, 1);
					}

					$this->load->library('upload');
					$this->upload->initialize(array (
						'upload_path' => $upload_path,
						'allowed_types' => 'jpeg|png|jpg|gif',
						'encrypt_name' => true,
						'max_width' => '1024',
						'max_height' => '768'
					));

					if ( $this->upload->do_upload('userfile') ) {
						$upload_data			 = $this->upload->data();
						$image					 = $upload_path . $upload_data['file_name'];
						$this->promotion->image	 = $image;
					}
					else {
						$this->response->status(false)->message($this->upload->display_errors())->json();
					}
				}

				if ( $this->promotion->save() ) {
					$status	 = true;
					$msg	 = 'Added promotion successfully';
				}
				else {
					$status	 = false;
					$msg	 = 'Can not add promotion at the moment.';
				}

				if ( $this->input->is_ajax_request() ) {
					$this->response->status($status)->message($msg)->json();
				}
				else {
					$this->template->set_message($msg, $status ? 'success' : 'error');
					redirect('user/add-new-promotion', 'refresh');
				}
			}
			else {
				if ( $this->input->is_ajax_request() ) {
					$this->response->status(false)->message(validation_errors())->json();
				}
				else {
					$this->template->set_message(validation_errors(), 'error');
				}
			}
		}

		// add assets
		add_assets(array (
			// 'http://maps.google.com/maps/api/js?sensor=false',
			'functions/user/addpromotion.js'
		));

		$this->template
				->set_block('user_sidebar', 'user/blocks/sidebar')
				->set_title(config_item('site_name'), 'Add new promotion')
				->render();
	}

	// --------------------------------------------------------------------
	// edit promotion (for owner group)
	// --------------------------------------------------------------------

	public function edit_promotion($id = 0) {
		// check user login
		if ( !$this->auth->logged_in() ) {
			redirect('login');
		}

		// check permission
		if ( !$this->auth->in_group(array (3)) ) {
			show_error('Can not access this page', 403);
		}

		$this->promotion = Model\Promotion::find($id);
		// check promotion exists
		if ( $id == 0 || $this->promotion->count_all_results() == 0 ) {
			show_error('Promotion is not selected or deleted');
		}

		if ( $this->input->post() ) {
			$this->load->library('form_validation');
			$this->form_validation
					->set_rules('title', 'Title', 'required')
					->set_rules('content', 'Content', 'required');
			// ->set_rules('date_from', 'Date from', 'required')
			// ->set_rules('date_to', 'Date to', 'required');

			if ( $this->form_validation->run() === TRUE ) {
				$this->promotion->title		 = $this->input->post('title', true);
				$this->promotion->content	 = $this->input->post('content', true);
				$date						 = $this->input->post('date_from_date', true);
				if ( !$date ) {
					$date = date('Y/m/d');
				}
				$time = $this->input->post('date_from_time', true);
				if ( !$time ) {
					$time = date('h:i a');
				}
				$date_from					 = date('Y-m-d H:i:s', strtotime($date . ' ' . $time));
				$this->promotion->date_from	 = $date_from;
				$date						 = $this->input->post('date_to_date', true);
				if ( !$date ) {
					$date = date('Y/m/d');
				}
				$time = $this->input->post('date_to_time', true);
				if ( !$time ) {
					$time = date('h:i a');
				}
				$this->promotion->latitude			 = $this->input->post('latitude', true);
				$this->promotion->longitude			 = $this->input->post('longitude', true);
				$this->promotion->gender_limit		 = $this->input->post('gender_limit', true);
				$this->promotion->age_limit			 = $this->input->post('age_limit', true);
				$this->promotion->member_limit		 = $this->input->post('member_limit', true);
				$this->promotion->last_changed_by	 = $this->current_user->id;

				// image
				if ( !empty($_FILES['userfile']) ) {
					$upload_path = 'uploads/promotions/' . $this->current_user->id . '/' . date('Ymd') . '/';
					if ( !is_dir($upload_path) ) {
						mkdir($upload_path, 0777, 1);
					}

					$this->load->library('upload');
					$this->upload->initialize(array (
						'upload_path' => $upload_path,
						'allowed_types' => 'jpeg|png|jpg|gif',
						'encrypt_name' => true,
						'max_width' => '1024',
						'max_height' => '768'
					));

					if ( $this->upload->do_upload('userfile') ) {
						$upload_data			 = $this->upload->data();
						$image					 = $upload_path . $upload_data['file_name'];
						$this->promotion->image	 = $image;
					}
					else {
						$this->response->status(false)->message($this->upload->display_errors())->json();
					}
				}

				if ( $this->promotion->save() ) {
					$status	 = true;
					$msg	 = 'Changed promotion successfully';
				}
				else {
					$status	 = false;
					$msg	 = 'Can not change promotion at the moment.';
				}

				if ( $this->input->is_ajax_request() ) {
					if ( isset($this->promotion->image) ) {
						$this->response->import(array ('img' => $this->promotion->image));
					}
					$this->response->status($status)->message($msg)->json();
				}
				else {
					$this->template->set_message($msg, $status ? 'success' : 'error');
					redirect('user/edit_promotion/' . $this->promotion->id, 'refresh');
				}
			}
			else {
				if ( $this->input->is_ajax_request() ) {
					$this->response->status(false)->message(validation_errors())->json();
				}
				else {
					$this->template->set_message(validation_errors(), 'error');
					redirect('user/edit_promotion/' . $this->promotion->id, 'refresh');
				}
			}
		}

		// add assets
		add_assets(array (
			// 'http://maps.google.com/maps/api/js?sensor=false',
			'functions/user/editpromotion.js'
		));

		$this->template
				->set_block('user_sidebar', 'user/blocks/sidebar')
				->set_title(config_item('site_name'), 'Edit promotion: #' . $this->promotion->id)
				->render();
	}

	// --------------------------------------------------------------------
	// add new promotion (for owner group)
	// --------------------------------------------------------------------

	public function delete_promotion() {
		$id = $this->input->post('id', true);

		$this->promotion = new Model\Promotion();
		$this->promotion->find($id);

		if ( !$this->promotion->count_all_results() ) {
			if ( $this->input->is_ajax_request() ) {
				$this->response->status(false)->message('No exists')->json();
			}
			else {
				redirect('my-store');
			}
		}
		else {
			if ( $this->promotion->delete() ) {
				$status	 = true;
				$msg	 = 'Delete promotion successfully';
			}
			else {
				$status	 = false;
				$msg	 = 'Can not delete promotion at the moment.';
			}

			if ( $this->input->is_ajax_request() ) {
				$this->response->status($status)->message($msg)->json();
			}
			else {
				$this->template->set($msg, $status ? 'success' : 'error');
				redirect('my-store', 'refresh');
			}
		}
	}

	// --------------------------------------------------------------------
	// block promotion (for owner group)
	// --------------------------------------------------------------------

	public function block_promotion() {
		$id = $this->input->post('id', true);

		$this->promotion = new Model\Promotion();
		$this->promotion->find($id);

		if ( !$this->promotion->count_all_results() ) {
			if ( $this->input->is_ajax_request() ) {
				$this->response->status(false)->message('No exists')->json();
			}
			else {
				redirect('my-store');
			}
		}
		else {
			$data = array (
				'status' => 0,
				'last_changed_by' => $this->current_user->id
			);
			if ( $this->promotion->set($data)->save() ) {
				$status	 = true;
				$msg	 = 'Block promotion successfully';
			}
			else {
				$status	 = false;
				$msg	 = 'Can not block promotion at the moment.';
			}

			if ( $this->input->is_ajax_request() ) {
				$this->response->status($status)->message($msg)->json();
			}
			else {
				$this->template->set($msg, $status ? 'success' : 'error');
				redirect('my-store', 'refresh');
			}
		}
	}

	// --------------------------------------------------------------------
	// active promotion (for owner group)
	// --------------------------------------------------------------------

	public function active_promotion() {
		$id = $this->input->post('id', true);

		$this->promotion = new Model\Promotion();
		$this->promotion->find($id);

		if ( !$this->promotion->count_all_results() ) {
			if ( $this->input->is_ajax_request() ) {
				$this->response->status(false)->message('No exists')->json();
			}
			else {
				redirect('my-store');
			}
		}
		else {
			$data = array (
				'status' => 1,
				'last_changed_by' => $this->current_user->id
			);
			if ( $this->promotion->set($data)->save() ) {
				$status	 = true;
				$msg	 = 'Active promotion successfully';
			}
			else {
				$status	 = false;
				$msg	 = 'Can not active promotion at the moment.';
			}

			if ( $this->input->is_ajax_request() ) {
				$this->response->status($status)->message($msg)->json();
			}
			else {
				$this->template->set($msg, $status ? 'success' : 'error');
				redirect('my-store', 'refresh');
			}
		}
	}

	// --------------------------------------------------------------------
	// active promotion (for owner group)
	// --------------------------------------------------------------------

	public function my_shop() {
		// check user login
		if ( !$this->auth->logged_in() ) {
			redirect('login');
		}

		// add assets
		add_assets('http://maps.google.com/maps/api/js?sensor=false');
		add_assets(array ('functions/user/myshop.js'));

		// template render
		$this->template
				->set_block('user_sidebar', 'user/blocks/sidebar')
				->set_title(config_item('site_name'), 'My Shop')
				->set('pagination_links', '')
				->render();
	}

	// --------------------------------------------------------------------
	// active promotion (for owner group)
	// --------------------------------------------------------------------

	public function my_dashboard() {
		// check user login
		if ( !$this->auth->logged_in() ) {
			redirect('login');
		}

		// load helper
		$this->load->helper('user');

		// add assets
		add_assets(array ('functions/user/mydashboard.js'));

		// get all shop of this user
		$my_shop_ids = Model\Favorite\User_Shop::select('shop_id')->where('user_id', $this->current_user->id)->all();
		$shop_ids	 = array ();
		if ( $my_shop_ids ) {
			foreach ( $my_shop_ids as $shop ) {
				$shop_ids[] = (int) $shop->shop_id;
			}
		}

		$offerings			 = count($shop_ids) ? Model\Promotion::where('created_by', $shop_ids)
						->where('date_from >=', date('Y-m-d H:i:s'))
						->order_by('date_to')->all() : array ();
		$my_shops			 = count($shop_ids) ? Model\User::where_in('id', $shop_ids)->all() : array ();
		$missed_offerings	 = count($shop_ids) ? Model\Promotion::where('created_by IN(' . implode(',', $shop_ids) . ') AND date_from < \'' . date('Y-m-d H:i:s') . '\'')->order_by('date_to')->all() : array ();

		// template render
		$this->template
				->set_block('user_sidebar', 'user/blocks/sidebar')
				->set_title(config_item('site_name'), 'Dashboard')
				->set('offerings', $offerings)
				->set('missed_offerings', $missed_offerings)
				->set('my_shops', $my_shops)
				->render();
	}

	// --------------------------------------------------------------------
	// active promotion (for owner group)
	// --------------------------------------------------------------------

	public function view_shop($id = 0) {
		if ( $id === 0 ) {
			// redirect to homepage
			redirect();
		}

		$this->shop = Model\User::find($id);

		// add assets
		if ( $this->shop->has_map() ) {
			add_assets('http://maps.google.com/maps/api/js?sensor=false');
		}
		add_assets(array ('functions/user/viewshop.js'));

		// template render
		$this->template
				->set_block('user_sidebar', 'user/blocks/sidebar')
				->set_title(config_item('site_name'), 'View Shop: ' . $this->shop->fullname())
				->render();
	}

	// --------------------------------------------------------------------
	// active promotion (for owner group)
	// --------------------------------------------------------------------

	public function my_promotion() {
		// check user login
		if ( !$this->auth->logged_in() ) {
			redirect('login');
		}

		// add assets
		add_assets(array ('functions/user/mypromotion.js'));

		// template render
		$this->template
				->set_block('user_sidebar', 'user/blocks/sidebar')
				->set_title(config_item('site_name'), 'My Promotion')
				->render();
	}

	// --------------------------------------------------------------------
	// active promotion (for owner group)
	// --------------------------------------------------------------------

	public function save_my_favorite() {
		if ( !$this->input->is_ajax_request() ) {
			redirect('', 'refresh');
		}

		$shop_id = $this->input->post('id');
		$total	 = Model\Favorite\User_Shop::where('user_id = ' . $this->current_user->id . ' AND shop_id = ' . $shop_id)->all();

		if ( sizeof($total) == 0 ) {
			$this->user			 = new Model\Favorite\User_Shop();
			$this->user->user_id = $this->current_user->id;
			$this->user->shop_id = $shop_id;
			if ( $this->user->save() ) {
				$this->response
						->status(true)
						->message('Save to your favorites successfully')
						->json();
			}
			else {
				$this->response
						->status(false)
						->message('Can not save to your favorites at the moment')
						->json();
			}
		}
		else {
			$this->response
					->status(false)
					->message('This shop is exists already in your favorites.')
					->json();
		}
	}

	// --------------------------------------------------------------------
	// active promotion (for owner group)
	// --------------------------------------------------------------------

	public function get_all_my_shop() {
		if ( !$this->input->is_ajax_request() ) {
			redirect('', 'refresh');
		}

		$items = Model\Favorite\User_Shop::where('user_id', $this->current_user->id)->all();

		$output = array (
			'total_items' => 0,
			'items' => array ()
		);

		foreach ( $items as $item ) {
			$user				 = $this->auth->user($item->shop_id)->row();
			$output['items'][]	 = array (
				'id' => $user->id,
				'username' => $user->username,
				'fullname' => implode(' ', array ($user->first_name, $user->last_name)),
				'company' => $user->company,
				'phone' => $user->phone,
				'email' => $user->email,
				'latitude' => $user->latitude,
				'longitude' => $user->longitude,
				'address' => $user->address,
				'website' => $user->website
			);
		}

		$output['total_items'] = count($items);
		$this->response->import($output)->json();
	}

	// --------------------------------------------------------------------
	// active promotion (for owner group)
	// --------------------------------------------------------------------
	public function save_public_page() {
		$content = $this->input->post('content', true);

		if ( !$this->auth->logged_in() ) {
			$this->response->status(false)->message('Require login')->json();
		}

		if ( $this->auth->update($this->current_user->id, array (
					'public_text' => $content
				)) ) {
			$this->response->status(true)->message('Saved changes')->json();
		}
		else {
			$this->response->status(false)->message('Can not save at the moment')->json();
		}
	}

	public function cancel_account() {
		// check user login
		if ( !$this->auth->logged_in() ) {
			redirect('login');
		}

		// template render
		$this->template
				->set_block('user_sidebar', 'user/blocks/sidebar')
				->set_title(config_item('site_name'), 'Cancel my account')
				->render();
	}

	public function post_cancel_account() {
		if ( $this->input->post() ) {
			$confirm = $this->input->post('confirm', true);
			if ( strtoupper($confirm) === 'OK' ) {
				// delete this user
				$user = Model\User::find($this->current_user->id);
				if ( $user ) {
					$user->delete();
					// delete all shop of this user
					Model\Favorite\User_Shop::where('user_id', $this->current_user->id)->delete();
					// logout
					$this->auth->logout();
					// redirect to home page
					redirect('/', 'refresh');
				}
			}
			else {
				$this->template->set_message('Please enter OK to confirm.');
				redirect('user/cancel_account', 'refresh');
			}
		}
	}

	public function view_promotion($id = 0) {
		if ( !$id ) {
			show_error('Promotion not found');
		}

		$promotion			 = Model\Promotion::find($id);
		$other_promotions	 = Model\Promotion::where('created_by = ' . $promotion->owner()->id . ' AND id != ' . $promotion->id)
				->order_by('date_to DESC')
				->limit(5)
				->all();
		$this->shop			 = $promotion->owner();

		$this->template
				->set_title(config_item('site_name'), $promotion->title)
				->set('promotion', $promotion)
				->set('other_promotions', $other_promotions)
				->render();
	}

	public function qr_code() {
		if ( $this->input->post('qr_code') ) {
			$qr_code = $this->input->post('qr_code');		
		}else{
			$qr_code = site_url()."/profile";
		}
		$user	 = Model\User::find($this->current_user->id);
		if ( $user && $qr_code !== '' ) {
			$user->qr_code = $qr_code;
			$user->save();
			$this->current_user->qr_code = $qr_code;
		}

		$this->template
				->set_title(config_item('site_name'), 'QR Code')
				->set_block('user_sidebar', 'user/blocks/sidebar')
				->render();
	}

}