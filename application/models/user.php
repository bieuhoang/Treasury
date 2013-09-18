<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class User extends ORM {

	const STATUS_INACTIVE = 0;
	const STATUS_ACTIVE = 1;

	public $table = 'users';

	public $primary_key = 'id';

	public $foreign_key = array('\\model\\category' => 'cat_id');

	function _init()
	{

		self::$relationships = array (
			'promotions' => ORM::has_many('\\Model\\Promotion', array('order_by:date_from[desc]')),
			'favorites' => ORM::has_many('\\Model\\Favorite\\Promotion => \\Model\\Promotion'),
			'category' =>     ORM::belongs_to('\\Model\\Category'),
			'groups' => ORM::has_many('\\Model\\User_Group => \\Model\\Group')
		);

		self::$fields = array(
			'id' => ORM::field('auto[10]'),
			'username' => ORM::field('char[64]'),
			'password' => ORM::field('char[255]'),
			'email' => ORM::field('char[255]'),
		);
	}

	public function url()
	{
		$title = implode(' ', array($this->first_name, $this->last_name));
		return 'store/'.$this->id.'-'.url_title($title, '-', true);
	}

	public function fullname()
	{
		return $this->first_name . ' ' . $this->last_name;
	}

	// --------------------------------------------------------------------
	// Post Model Initialisation
	//   Add your own custom initialisation code to the Model
	// The parameter indicates if the current config was loaded from cache or not
	// --------------------------------------------------------------------
	public function group_name()
	{
		$group_names = array();

		foreach(ci()->auth_model->get_users_groups($this->id)->result() as $group_name)
		{
			$group_names[] = ucwords($group_name->name);
		}

		return implode(', ', $group_names);
	}

	// --------------------------------------------------------------------
	// Post Model Initialisation
	//   Add your own custom initialisation code to the Model
	// The parameter indicates if the current config was loaded from cache or not
	// --------------------------------------------------------------------
	public function group_ids()
	{
		$group_ids = array();

		foreach(ci()->auth_model->get_users_groups($this->id)->result() as $group)
		{
			$group_ids[] = ucwords($group->id);
		}

		return $group_ids;
	}

	// --------------------------------------------------------------------
	// Post Model Initialisation
	//   Add your own custom initialisation code to the Model
	// The parameter indicates if the current config was loaded from cache or not
	// --------------------------------------------------------------------
	public function register_date($format = 'Y-m-d h:i A')
	{
		return date($format, $this->created_on);
	}

	// --------------------------------------------------------------------
	// Post Model Initialisation
	//   Add your own custom initialisation code to the Model
	// The parameter indicates if the current config was loaded from cache or not
	// --------------------------------------------------------------------
	public function block()
	{
		return ci()->auth_model->deactive($this->id);
	}

	// --------------------------------------------------------------------
	// Post Model Initialisation
	//   Add your own custom initialisation code to the Model
	// The parameter indicates if the current config was loaded from cache or not
	// --------------------------------------------------------------------
	public function current_promotions()
	{
		return Promotion::where('created_by = '.$this->id.' AND date_from <= \''.date('Y-m-d H:i:s').'\' AND date_to >= \''.date('Y-m-d H:i:s').'\'')
				->order_by('date_from', 'ASC')
				->all();
	}

	// --------------------------------------------------------------------
	// Post Model Initialisation
	//   Add your own custom initialisation code to the Model
	// The parameter indicates if the current config was loaded from cache or not
	// --------------------------------------------------------------------
	public function past_promotions()
	{
		return Promotion::where('created_by = '.$this->id.' AND date_to < \''.date('Y-m-d H:i:s').'\'')
				->order_by('date_to', 'DESC')
				->all();
	}

	// --------------------------------------------------------------------
	// Post Model Initialisation
	//   Add your own custom initialisation code to the Model
	// The parameter indicates if the current config was loaded from cache or not
	// --------------------------------------------------------------------
	public function avatar($width = 150, $height = null)
	{
		return $this->avatar != ''
				? img(array(
					'src' => base_url('public/thumb.php?src='.base_url($this->avatar).'&w='.$width.(is_null($height) ? '' : ('&h='.$height))),
					'width' => $width,
					'height' => $height,
					'alt' => $this->fullname(),
					'class' => 'avatar'
				))
				: img(array(
					'src' => 'public/img/avatar.png',
					'width' => $width,
					'height' => $height,
					'alt' => $this->fullname(),
					'class' => 'avatar'
				));
	}

	// --------------------------------------------------------------------
	// Post Model Initialisation
	//   Add your own custom initialisation code to the Model
	// The parameter indicates if the current config was loaded from cache or not
	// --------------------------------------------------------------------
	public function has_avatar()
	{
		return ($this->avatar != '');
	}

	// --------------------------------------------------------------------
	// Post Model Initialisation
	//   Add your own custom initialisation code to the Model
	// The parameter indicates if the current config was loaded from cache or not
	// --------------------------------------------------------------------
	public function has_map()
	{
		return ($this->longitude != '' and $this->latitude != '');
	}

	// --------------------------------------------------------------------
	// Post Model Initialisation
	//   Add your own custom initialisation code to the Model
	// The parameter indicates if the current config was loaded from cache or not
	// --------------------------------------------------------------------
	public function profile($field_name = '')
	{
		$profile_fields = @unserialize($this->profile_fields);

		if($profile_fields)
		{
			foreach($profile_fields as $field => $value)
			{
				if($field == $field_name)
				{
					return $value;
				}
			}
		}
	}

	public function status()
	{
		if($this->id == 1) return '';
		switch($this->status)
		{
			case 0:
				return 'X'; break;
			case 1:
				return 'V'; break;
			default:
				return ''; break;
		}
	}

	// --------------------------------------------------------------------
	// Post Model Initialisation
	//   Add your own custom initialisation code to the Model
	// The parameter indicates if the current config was loaded from cache or not
	// --------------------------------------------------------------------
	public function sendmail($args = array())
	{
		ci()->load->library('email');

		if(config_item('email_smtp_host') != ''
			and config_item('email_smtp_port') != ''
			and config_item('email_smtp_username')
			and config_item('email_smtp_password'))
		{
			ci()->email->initialize(array(
				'protocol' => 'smtp',
				'smtp_host' => config_item('email_smtp_host'),
				'smtp_port' => config_item('email_smtp_port'),
				'smtp_user' => config_item('email_smtp_username'),
				'smtp_pass' => config_item('email_smtp_password'),
				'mailtype' => 'html'
			));
		}

		ci()->email->from('admin@domain.com', 'Treasury');
		ci()->email->to($args['email']);
		ci()->email->subject(config_item('message_register_subject'));
		$body = str_replace(array(
			'{username}', '{password}', '{site_url}'
		), array(
			$args['username'], $args['password'], site_url()
		), config_item('message_register_content'));
		ci()->email->message($body);

		try {
			//ci()->email->send();
			return true;
		}
		catch(Exception $e) {
			return false;
		}

	}

	// --------------------------------------------------------------------
	// Post Model Initialisation
	//   Add your own custom initialisation code to the Model
	// The parameter indicates if the current config was loaded from cache or not
	// --------------------------------------------------------------------
	public function send_mail_forgot_password($email, $username, $key)
	{
		ci()->load->library('email');

		if(config_item('email_smtp_host') != ''
			and config_item('email_smtp_port') != ''
			and config_item('email_smtp_username')
			and config_item('email_smtp_password'))
		{
			ci()->email->initialize(array(
				'protocol' => 'smtp',
				'smtp_host' => config_item('email_smtp_host'),
				'smtp_port' => config_item('email_smtp_port'),
				'smtp_user' => config_item('email_smtp_username'),
				'smtp_pass' => config_item('email_smtp_password'),
				'mailtype' => 'html'
			));
		}

		ci()->email->from('admin@domain.com', 'Treasury');
		ci()->email->to($email);
		ci()->email->subject('Request reset password');
		$body = $this->load->view('auth/email/forgot_password', array(
			'identity' => $username,
			'forgotten_password_code' => $key
		), true);
		ci()->email->message($body);

		try {
			ci()->email->send();
			return true;
		}
		catch (Exception $e) {
			return false;
		}
	}

	// --------------------------------------------------------------------
	// Post Model Initialisation
	//   Add your own custom initialisation code to the Model
	// The parameter indicates if the current config was loaded from cache or not
	// --------------------------------------------------------------------
	public function send_mail_forgot_password_success($email, $username, $password)
	{
		ci()->load->library('email');

		if(config_item('email_smtp_host') != ''
			and config_item('email_smtp_port') != ''
			and config_item('email_smtp_username')
			and config_item('email_smtp_password'))
		{
			ci()->email->initialize(array(
				'protocol' => 'smtp',
				'smtp_host' => config_item('email_smtp_host'),
				'smtp_port' => config_item('email_smtp_port'),
				'smtp_user' => config_item('email_smtp_username'),
				'smtp_pass' => config_item('email_smtp_password'),
				'mailtype' => 'html'
			));
		}

		ci()->email->from('admin@domain.com', 'Treasury');
		ci()->email->to($email);
		ci()->email->subject('Your new password - Treasury');
		$body = $this->load->view('auth/email/new_passsword', array(
			'identity' => $username,
			'new_password' => $password
		), true);
		ci()->email->message($body);

		try {
			ci()->email->send();
			return true;
		}
		catch(Exception $e) {
			return false;
		}

	}

}