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

	public function training_dataset()
	{
		$rawPayload = $this->security->xss_clean($this->input->raw_input_stream);
		$payload = json_decode($rawPayload);

		$selectedId = $payload->id;
		if (empty($selectedId)) {
			show_404();
		}

		$this->tweet_model->makeTweetAs($selectedId, 'Training');

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

		$this->tweet_model->makeTweetAs($selectedId, 'Testing');

		header('application/json');
		echo json_encode(['status' => true, 'message' => 'Successfully make tweets as testing dataset']);
	}
}
