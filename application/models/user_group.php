<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class User_Group extends ORM {
	
	public $table = 'users_groups';

	public $primary_key = 'id';

	public $foreign_key = array(
		'\\model\\user' => 'user_id',
		'\\model\\group' => 'group_id'
	);

	function _init()
	{

		self::$relationships = array (			
			'user' =>     ORM::belongs_to('\\Model\\User'),
			'group' =>     ORM::belongs_to('\\Model\\Group'),
		);

		self::$fields = array(
			'id' => ORM::field('auto[10]'),
			'user_id' => ORM::field('int[11]'),
			'group_id' => ORM::field('int[11]'),
		);
	}
	
}