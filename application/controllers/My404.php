<?php 
class My404 extends CI_Controller 
{
    public function __construct() 
    {
        parent::__construct();
    }

    public function index() 
    {
        $this->layout->set_body_attr(array('class' => 'gray-bg'));

        $this->layout->add_css_files(array('bootstrap.min.css'), base_url().'assets/css/');
        $this->layout->add_css_files(array('font-awesome.css'), base_url().'assets/font-awesome/css/');
        $this->layout->add_css_files(array('animate.css','style.css'), base_url().'assets/css/');
        $this->output->set_status_header('404');
        $this->load->view('404');//loading in my template 
    } 
}