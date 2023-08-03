<?php
class Template
{
    protected $_ci;

    function __construct(){
        $this->_ci = &get_instance();
    }
    
    function admin($content, $data = null){
        $this->_ci->load->view('admin/template/header', $data); // Header
        $this->_ci->load->view($content, $data); // Content
    }

}
?>