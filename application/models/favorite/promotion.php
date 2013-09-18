<?php

namespace Model\Favorite;

use \Gas\Core;
use \Gas\ORM;

class Promotion extends ORM {
	
	public $table = 'users_favorites';

	public $primary_key = 'id';

	public $foreign_key = array('\\model\\user' => 'user_id');

	function _init()
	{
		self::$relationships = array (
			'user' => ORM::belongs_to('\\Model\\User')
		);

		self::$fields = array(
			'id' => ORM::field('auto[11]'),
			'user_id' => ORM::field('int[11]'),
			'owner_id' => ORM::field('int[11]')
		);
	}
}