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

		echo "@relation tweet\n@attribute requirement string\n@attribute class {Negatif, Netral, Positif}\n\n@data\n";
		$label = Dataset_model::RESULT_LABEL;
		$data = $this->dataset_model->getAllTestingDatasets();
		foreach ($data as $item) {
			$sentiment = addslashes($item->sentiment);
			$predictionResult = $label[$item->prediction_result] ?? '?';
			echo "'{$sentiment}'" . $separator . $predictionResult . "\n";
		}
	}

	public function prediction()
	{
		$output = null;
		$status = null;
		exec("cd ../python && python3 testing_prediction.py 2>&1", $output, $status);

		if (!$status) {
			return $this->output
				->set_content_type('application/json')
				->set_status_header('200')
				->set_output(json_encode([
					'status' => true,
					'message' => 'Successfully testing prediction datasets using naive bayes model',
				]));
		}

		return $this->output
			->set_content_type('application/json')
			->set_status_header(500)
			->set_output(json_encode([
				'status' => false,
				'message' => 'Upps, there are an error when processing the request',
				'error' => $output
			]));
	}
}
