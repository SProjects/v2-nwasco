<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Directive extends CI_Controller {

	function Utilities() {

	// load controller parent

	parent::Controller();
	    $this->load->library('ion_auth');
    if (!$this->ion_auth->logged_in())
    {
      //redirect them to the login page
      redirect('auth/login', 'refresh');
    }
       
    }

	function index() {

	//$data['utilities']=$this->core->getUsersWhere(‘id <‘,5);

	//$data['utilities']=$this->core->getNumUtilities();

	//$data['title'] = 'Utilities';

	// load ‘users_view’ view

	//$this->load->view('utility_view',$data);

	}
	 public function edit($id)//single post page
    {
		 $this->layout->add_custom_meta('meta', array(
            'charset' => 'utf-8'
        ));

        $this->layout->add_custom_meta('meta', array(
            'http-equiv' => 'X-UA-Compatible',
            'content' => 'IE=edge'
        ));

$js_text = <<<EOF
 $(document).ready(function () {
                Tinycon.setOptions({
	            background: '#e0913b'
	            });
	            Tinycon.setBubble(8);

	            $('.autoplay').slick({
				  slidesToShow: 3,
				  slidesToScroll: 1,
				  autoplay: true,
				  autoplaySpeed: 2000,
				});
    });
EOF;

$this->layout->add_js_rawtext($js_text, 'footer');

        $this->layout->set_body_attr(array('id' => 'home', 'class' => 'fixed-sidebar no-skin-config full-height-layout'));

		$this->layout->add_css_file('https://fonts.googleapis.com/css?family=Open+Sans:400,600,700');
        $this->layout->add_css_files(array('bootstrap.min.css'), base_url().'assets/css/');
        $this->layout->add_css_files(array('font-awesome.css'), base_url().'assets/font-awesome/css/');
        $this->layout->add_css_files(array('toastr.min.css'), base_url().'assets/css/plugins/toastr/');
        $this->layout->add_css_files(array('jquery.gritter.css'), base_url().'assets/js/plugins/gritter/');
        $this->layout->add_css_files(array('slick.css'), base_url().'assets/css/plugins/slick/');
        $this->layout->add_css_files(array('slick-theme.css'), base_url().'assets/css/plugins/slick/');
        $this->layout->add_css_files(array('animate.css','style.css'), base_url().'assets/css/');
        //Main Scripts
        $this->layout->add_js_files(array('jquery-2.1.1.js','bootstrap.min.js','inspinia.js'), base_url('assets/js/'), 'footer', 'async');
        $this->layout->add_js_files(array('jquery.metisMenu.js'), base_url('assets/js/plugins/metisMenu/'), 'footer', 'async');
        $this->layout->add_js_files(array('jquery.slimscroll.min.js'), base_url('assets/js/plugins/slimscroll/'), 'footer', 'async');

        // Pace
        $this->layout->add_js_files(array('pace.min.js'), base_url('assets/js/plugins/pace/'), 'footer', 'async');
        // JQuery
        $this->layout->add_js_files(array('jquery-ui.min.js'), base_url('assets/js/plugins/jquery-ui/'), 'footer', 'async');
        // GITTER
        $this->layout->add_js_files(array('jquery.gritter.min.js'), base_url('assets/js/plugins/gritter/'), 'footer', 'async');
        //Toastr
        $this->layout->add_js_files(array('toastr.min.js'), base_url('assets/js/plugins/toastr/'), 'footer', 'async');
        //Tinycon
        $this->layout->add_js_files(array('tinycon.min.js'), base_url('assets/js/plugins/tinycon/'), 'footer', 'async');
        //Slick
        $this->layout->add_js_files(array('slick.min.js'), base_url('assets/js/plugins/slick/'), 'footer', 'async');


		
    	$this->data['current_user_menu'] = '';
	    if($this->ion_auth->in_group('admin'))
	    {
         

        $this->layout->set_title('Welcome to :: Nwasco Dashboard');
        $this->layout->set_body_attr(array('id' => 'home', 'class' => 'test more_class'));
        $data['title'] = $this->lang->line('login_heading');
		$data['user'] = $this->ion_auth->user()->row();
        $data['utilities']  = $this->core->getAllUtilities();
		$data['schemes']  = $this->core->getSchemes();
        $data['indicators']  = $this->core->getIndicators();
        $data['directives'] = $this->core->listDirectives($id);
        $data['projects']   = $this->core->listProjects($id);
        $data['tariffs']    = $this->core->listTarrifs($id);
        $data['licence']    = $this->core->listLcondtions($id);
        $data['srs']    = $this->core->listSRS($id); 
        // load views and send data
         
        // load views and send data
        $this->data['current_user_menu'] = $this->load->view('header', $data);
		$this->data['current_user_menu'] = $this->load->view('templates/edit_directive', $data);
		$this->data['current_user_menu'] = $this->load->view('footer_main');
       }
       else
       {
         //If no session, redirect to login page
         redirect('auth/login');
       }
    }

}