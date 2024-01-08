<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dataset extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('dataset_model');
	}

	public function training()
	{
		$data = array(
			'title' => 'Data Latih',
			'datasets' => $this->dataset_model->getAllTrainingDatasets(),
			'statistics' => $this->dataset_model->getStatisticsTrainingDatasets(),
		);

		$this->template->admin('admin/VDataLatih', $data);
	}

	public function testing()
	{
		$data = array(
			'title' => 'Data Uji',
			'datasets' => $this->dataset_model->getAllTestingDatasets(),
			'statistics' => $this->dataset_model->getStatisticsTestingDatasets(),
		);

		$this->template->admin('admin/VDataUji', $data);
	}
}
