<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class Option extends ORM {

 	public $table = 'options';

	public $primary_key = 'id';

	function _init()
	{
		self::$relationships = array ();

		self::$fields = array(
				'id' => ORM::field('auto[11]'),
				'option_name' => ORM::field('char[200]'),
				'option_value' => ORM::field('string'),
				'auto_load' => ORM::field('numeric')
		);
	}
}