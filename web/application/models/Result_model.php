<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Result_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	function getAll()
	{
		$query = $this->db->get('results');

		return $query->result();
	}
}
