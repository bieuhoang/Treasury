<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class Promotion extends ORM {

	const STATUS_INACTIVE = 0;
	const STATUS_ACTIVE = 1;
	const STATUS_PENDING = 2;
	
	public $table = 'promotions';

	public $primary_key = 'id';

	public $foreign_key = array('\\model\\user' => 'created_by');

	function _init()
	{
		self::$relationships = array (
			'owner' =>     ORM::belongs_to('\\Model\\User')
		);

		self::$fields = array(
			'id' => ORM::field('auto[10]'),
			'username' => ORM::field('char[64]'),
			'password' => ORM::field('char[255]'),
			'email' => ORM::field('char[255]'),
		);
	}

	function image($width = 100, $height = null)
	{
		$height = is_null($height) ? '' : '&h='.$height;
		return base_url('public/thumb.php?src='.base_url($this->image).'&w='.$width.$height);
	}

	public function status()
	{
		switch($this->status)
		{
			case 0:
				return 'InActive';
				break;
			case 1:
				return 'Active';
				break;
			case 2:
				return 'Pending';
				break;
			default:
				return '';
				break;
		}
	}

	public function url()
	{
		return site_url('promotion/'.$this->id.'-'.url_title($this->title, '-', true));
	}

	public function date_from($format = 'm/d/Y h:i A')
	{
		return date($format, strtotime($this->date_from));
	}

	public function date_to($format = 'm/d/Y h:i A')
	{
		return date($format, strtotime($this->date_to));
	}

	public function content($word_limit = 0)
	{
		if($word_limit)
		{
			ci()->load->helper('text');
			return word_limiter($this->content, $word_limit);
		}

		return $this->content;
	}
}