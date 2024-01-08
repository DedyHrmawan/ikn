<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Training extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('dataset_model');
	}

	public function index()
	{
		$data = array(
			'title' => 'Data Latih',
			'datasets' => $this->dataset_model->getAllTrainingDatasets(),
			'statistics' => $this->dataset_model->getStatisticsTrainingDatasets(),
		);

		$this->template->admin('admin/VDataLatih', $data);
	}

	public function update($id)
	{
		if (empty($this->input->post())) {
			show_404();
		}

		$payload = [
			'sentiment' => $this->input->post('sentiment'),
			'expected_result' => $this->input->post('expected_result'),
		];

		$this->dataset_model->update($id, $payload);

		redirect(site_url('data-latih'));
	}

	public function delete($id)
	{
		$this->dataset_model->delete($id);

		redirect(site_url('data-latih'));
	}
}
