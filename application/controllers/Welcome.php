<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('download');
	}
	public function VScrapping()
	{
		$data = array(
			'title' => 'Scrapping Data',
		);
		$this->template->admin('admin/VScrapping', $data);
	}

	public function VDataLatih()
	{
		$data = array(
			'title' => 'Data Latih',
		);
		$this->template->admin('admin/VDataLatih', $data);
	}

	public function exportDataLatih(){
        $namaFile = "data-latih.arff";
        
        $separator = ",";
        
        header("Content-type: text/plain");
        header("Content-Disposition: attachment; filename=".$namaFile);

        echo "@relation tweet\n@attribute requirement string\n@attribute class {netral, positif, negatif}\n\n@data\n";
            echo "'ini adalah contoh tweet netral'".$separator."netral\n";            
            echo "'ini adalah contoh tweet positif'".$separator."positif\n";            
            echo "'ini adalah contoh tweet negatif'".$separator."negatif\n";            
    }


	public function VDataUji()
	{
		$data = array(
			'title' => 'Data Uji',
		);
		$this->template->admin('admin/VDataUji', $data);
	}

	public function exportDataUji(){
        $namaFile = "data-uji.arff";
        
        $separator = ",";
        
        header("Content-type: text/plain");
        header("Content-Disposition: attachment; filename=".$namaFile);

        echo "@relation tweet\n@attribute requirement string\n@attribute class {netral, positif, negatif}\n\n@data\n";
            echo "'ini adalah contoh data uji 1'".$separator."?\n";            
            echo "'ini adalah contoh data uji 2'".$separator."?\n";            
    }

	public function VCMatrix()
	{
		$data = array(
			'title' => 'Confusion Matrix',
		);
		$this->template->admin('admin/VCMatrix', $data);
	}
}
