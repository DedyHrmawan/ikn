<?php
defined('BASEPATH') or exit('No direct script access allowed');

abstract class MY_Controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	protected function successJsonResponse($data, $status = 200)
	{
		return $this->output
			->set_content_type('application/json')
			->set_status_header($status)
			->set_output(json_encode($data));
	}
}
