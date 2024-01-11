<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dataset_model extends CI_Model
{
	const RESULT_LABEL = [
		"Netral",
		"Positif",
		"Negatif"
	];

	const TRAINING_DATASET = 'Training';
	const TESTING_DATASET = 'Testing';

	public function __construct()
	{
		parent::__construct();
	}

	public function getAll()
	{
		$query = $this->db->get('datasets');

		return $query->result();
	}

	public function getAllTrainingDatasets()
	{
		$query = $this->db->where('class', self::TRAINING_DATASET)->get('datasets');

		return $query->result();
	}

	public function getStatisticsTrainingDatasets()
	{
		$query = $this->db
			->select('expected_result, COUNT(*) as count')
			->group_by('expected_result')
			->where('class', 'Training')
			->get('datasets');

		$results = $query->result();

		$statistics = ['Total' => 0];
		foreach ($results as $item) {
			if (is_numeric($item->expected_result)) {
				$statistics[self::RESULT_LABEL[$item->expected_result]] = $item->count;
			}

			$statistics['Total'] += $item->count;
		}

		return $statistics;
	}

	public function getAllTestingDatasets()
	{
		$query = $this->db->where('class', self::TESTING_DATASET)->get('datasets');

		return $query->result();
	}

	public function getStatisticsTestingDatasets()
	{
		$query = $this->db
			->select('expected_result, COUNT(*) as count')
			->group_by('expected_result')
			->where('class', 'Testing')
			->get('datasets');

		$results = $query->result();

		$statistics = ['Total' => 0];
		foreach ($results as $item) {
			if (is_numeric(($item->expected_result))) {
				$statistics[self::RESULT_LABEL[$item->expected_result]] = $item->count;
			}

			$statistics['Total'] += $item->count;
		}

		return $statistics;
	}

	public function update($id, $payload)
	{
		$this->db->where('id', $id)->update('datasets', $payload);
	}

	public function delete($id)
	{
		$this->db->where('id', $id)->delete('datasets');
	}
}
