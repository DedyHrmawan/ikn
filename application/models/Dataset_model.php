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
}
