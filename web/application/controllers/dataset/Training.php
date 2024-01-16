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

		redirect(base_url('data-latih'));
	}

	public function delete($id)
	{
		$this->dataset_model->delete($id);

		redirect(base_url('data-latih'));
	}

	public function export()
	{
		$namaFile = "data-latih.arff";

		$separator = ",";

		header("Content-type: text/plain");
		header("Content-Disposition: attachment; filename=" . $namaFile);

		echo "@relation tweet\n@attribute requirement string\n@attribute class {Negatif, Netral, Positif}\n\n@data\n";
		$label = Dataset_model::RESULT_LABEL;
		$data = $this->dataset_model->getAllTrainingDatasets();
		foreach ($data as $item) {
			if (!is_numeric($item->expected_result)) {
				continue;
			}

			$sentiment = addslashes($item->sentiment);
			echo "'{$sentiment}'" . $separator . $label[$item->expected_result] . "\n";
		}
	}

	public function preprocessing()
	{
		$output = null;
		$status = null;
		exec("cd ../python && python3 build_model.py", $output, $status);

		if (!$status) {
			return $this->output
				->set_content_type('application/json')
				->set_status_header('200')
				->set_output(json_encode([
					'status' => true,
					'message' => 'Successfully preprocessing dataset and build naive bayes model'
				]));
		}

		return $this->output
			->set_content_type('application/json')
			->set_status_header(500)
			->set_output(json_encode([
				'status' => false,
				'message' => 'Upps, there are an error when processing the request'
			]));
	}
}
