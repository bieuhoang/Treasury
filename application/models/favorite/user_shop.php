<?php

namespace Model\Favorite;

use \Gas\Core;
use \Gas\ORM;

class User_Shop extends ORM {
	
	public $table = 'user_shop_favorites';

	public $primary_key = 'id';

	public $foreign_key = array('\\model\\user' => 'user_id', '\\model\\user' => 'owner_id');

	function _init()
	{
		self::$relationships = array (
			'user' => ORM::belongs_to('\\Model\\User'),
			'owner' => ORM::belongs_to('\\Model\\User')
		);

		self::$fields = array(
			'id' => ORM::field('auto[11]'),
			'user_id' => ORM::field('int[11]'),
			'owner_id' => ORM::field('int[11]')
		);
	}
}