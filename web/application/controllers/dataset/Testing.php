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

	public function export()
	{
		$namaFile = "data-uji.arff";

		$separator = ",";

		header("Content-type: text/plain");
		header("Content-Disposition: attachment; filename=" . $namaFile);

		echo "@relation tweet\n@attribute requirement string\n@attribute class {netral, positif, negatif}\n\n@data\n";
		$label = ['netral', 'positif', 'negatif'];
		$data = $this->dataset_model->getAllTestingDatasets();
		foreach ($data as $item) {
			$sentiment = addslashes($item->sentiment);
			$predictionResult = $label[$item->prediction_result] ?? '?';
			echo "'{$sentiment}'" . $separator . $predictionResult . "\n";
		}
	}
}
