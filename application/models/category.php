<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class Category extends ORM {

 	public $table = 'categories';

	public $primary_key = 'id';

	public $foreign_key = array('\\model\\user' => 'cat_id');

	function _init()
	{
		self::$relationships = array(
			'stores' => ORM::has_many('\\Model\\User'),
		);

		self::$fields = array(
				'id' => ORM::field('auto[11]'),
				'title' => ORM::field('char[200]'),
				'description' => ORM::field('string'),
				'created_at' => ORM::field('numeric'),
				'updated_at' => ORM::field('numeric')
		);
	}
}