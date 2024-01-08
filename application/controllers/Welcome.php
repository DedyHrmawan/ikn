<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('download');
	}

	public function VCMatrix()
	{
		$data = array(
			'title' => 'Confusion Matrix',
		);
		$this->template->admin('admin/VCMatrix', $data);
	}
}
