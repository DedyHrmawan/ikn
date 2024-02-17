<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Scrapping extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('tweet_model');
		$this->load->model('dataset_model');
	}

	public function index()
	{
		$data = array(
			'title' => 'Scrapping Data',
			'tweets' => $this->tweet_model->getAll()
		);

		$this->template->admin('admin/VScrapping', $data);
	}

	public function training_dataset()
	{
		$rawPayload = $this->security->xss_clean($this->input->raw_input_stream);
		$payload = json_decode($rawPayload);

		$selectedId = $payload->id;
		if (empty($selectedId)) {
			show_404();
		}

		$this->tweet_model->makeTweetAs($selectedId, Dataset_model::TRAINING_DATASET);

		header('application/json');
		echo json_encode(['status' => true, 'message' => 'Successfully make tweets as training dataset']);
	}

	public function testing_dataset()
	{
		$rawPayload = $this->security->xss_clean($this->input->raw_input_stream);
		$payload = json_decode($rawPayload);

		$selectedId = $payload->id;
		if (empty($selectedId)) {
			show_404();
		}

		$this->tweet_model->makeTweetAs($selectedId, Dataset_model::TESTING_DATASET);

		header('application/json');
		echo json_encode(['status' => true, 'message' => 'Successfully make tweets as testing dataset']);
	}

	public function scrapping()
	{
		$output = null;
		$status = null;
		exec("cd ../python && python3 twitter_scrapping.py 2>&1", $output, $status);

		if (!$status) {
			return $this->output
				->set_content_type('application/json')
				->set_status_header('200')
				->set_output(json_encode([
					'status' => true,
					'message' => 'Successfully scrapping data on twitter',
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
