<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dataset_model extends CI_Model
{

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
		$query = $this->db->where('class', 'Training')->get('datasets');

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
			if (!$item->expected_result) {
				$statistics[$item->expected_result] = $item->count;
			}

			$statistics['Total'] += $item->count;
		}

		return $statistics;
	}

	public function getAllTestingDatasets()
	{
		$query = $this->db->where('class', 'Testing')->get('datasets');

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
			if (!$item->expected_result) {
				$statistics[$item->expected_result] = $item->count;
			}

			$statistics['Total'] += $item->count;
		}

		return $statistics;
	}
}
