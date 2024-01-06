<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Scrapping extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('tweet_model');
	}

	public function index()
	{
		$data = array(
			'title' => 'Scrapping Data',
			'tweets' => $this->tweet_model->getAll()
		);

		$this->template->admin('admin/VScrapping', $data);
	}
}
