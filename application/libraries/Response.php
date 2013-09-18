<?php defined('BASEPATH') or exit('No direct script access allowed.');

class Response
{
	var $data = array();

	public function import($data = array())
	{
		if(is_array($data))
		{
			$this->data = array_merge($this->data, $data);
		}

		return $this;
	}

	public function status($status = true)
	{
		$this->data['status'] = $status;
		return $this;
	}

	public function message($message = '')
	{
		$this->data['msg'] = $message;
		return $this;
	}

	public function json($exit = true)
	{
		if(is_array($this->data) and count($this->data))
		{
			if($exit)
			{
				exit(json_encode($this->data));
			}
		}

		return json_encode($this->data);
	}
}