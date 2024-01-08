<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tweet_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('date');
	}

	public function getAll()
	{
		$query = $this->db->get('tweets');

		return $query->result();
	}

	public function makeTweetAs(array $id, string $type)
	{
		$this->db->trans_start();

		// get tweets by id
		$tweets = $this->db
			->select('tweet')
			->where_in('id', $id)
			->get('tweets');

		// move tweet into dataset table
		foreach ($tweets->result() as $item) {
			$data = [
				'sentiment' => $item->tweet,
				'class' => $type,
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s"),
			];
			$this->db->insert('datasets', $data);
		}

		// deleting tweets data
		$this->db->where_in('id', $id)->delete('tweets');

		$this->db->trans_complete();
	}
}
