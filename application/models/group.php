<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class Group extends ORM {
	
	public $table = 'groups';

	public $primary_key = 'id';

	function _init()
	{

		self::$relationships = array (			
			'users' =>     ORM::has_many('\\Model\\User_Group => \\Model\\User')
		);

		self::$fields = array(
			'id' => ORM::field('auto[10]'),
			'user_id' => ORM::field('int[11]'),
			'group_id' => ORM::field('int[11]'),
		);
	}
	
}