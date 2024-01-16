<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Confusion_matrix extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('result_model');
	}

	public function index()
	{
		$results = $this->result_model->getAll();
		$statistics = [
			'precision' => 0,
			'accuracy' => 0,
			'recall' => 0,
			'f_measure' => 0
		];

		foreach ($results as $item) {
			$statistics['precision'] += $item->precision_value;
			$statistics['accuracy'] += $item->accuracy_value;
			$statistics['recall'] += $item->recall_value;
			$statistics['f_measure'] += $item->f_measure_value;
		}

		$data = array(
			'title' => 'Confusion Matrix',
			'results' => $results,
			'statistics' => $statistics
		);

		$this->template->admin('admin/VCMatrix', $data);
	}
}
