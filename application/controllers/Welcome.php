<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function VScrapping()
	{
		$data = array(
			'title' => 'Scrapping Data',
          );
		$this->template->admin('admin/VScrapping',$data );
	}

	public function VDataLatih()
	{
		$data = array(
			'title' => 'Data Latih',
          );
		$this->template->admin('admin/VDataLatih',$data );
	}

	public function VDataUji()
	{
		$data = array(
			'title' => 'Data Uji',
          );
		$this->template->admin('admin/VDataUji',$data );
	}

	public function VCMatrix()
	{
		$data = array(
			'title' => 'Confusion Matrix',
          );
		$this->template->admin('admin/VCMatrix',$data );
	}
}
