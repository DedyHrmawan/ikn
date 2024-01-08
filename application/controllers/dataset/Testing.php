<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Testing extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('dataset_model');
	}

	public function index()
	{
		$data = array(
			'title' => 'Data Uji',
			'datasets' => $this->dataset_model->getAllTestingDatasets(),
			'statistics' => $this->dataset_model->getStatisticsTestingDatasets(),
		);

		$this->template->admin('admin/VDataUji', $data);
	}
}
