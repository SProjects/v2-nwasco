<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utility extends CI_Controller {

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
	 public function details($id)//single post page
    {

 
		 $this->layout->add_custom_meta('meta', array(
            'charset' => 'utf-8'
        ));

        $this->layout->add_custom_meta('meta', array(
            'http-equiv' => 'X-UA-Compatible',
            'content' => 'IE=edge'
        ));

$js_text = <<<EOF

    jQuery(document).ready(function($) {
                $("#dxs").tooltip();
              $('#mycontent').slimScroll({
                  color: '#333',
                  height: '570px',
                  size: '10px',
                  borderRadius: '0px',
                  railBorderRadius: '0px',
                  railVisible: true,
                  alwaysVisible: true
              });
              $('#sidebar').slimScroll({
                  height: '150px',
                  railVisible: true,
                  alwaysVisible: true
              });
              $('#slimtest3').slimScroll({
                  color: '#285FAC',
                  size: '10px',
                  height: '180px',
                  alwaysVisible: true
              });

                 $('table.directives').DataTable({});
                 $('table.tariffs').DataTable();
                 $('table.projects').DataTable();
                 $("[data-toggle=tooltip]").tooltip();
          });
EOF;

$this->layout->add_js_rawtext($js_text, 'footer');

        $this->layout->set_body_attr(array('id' => 'home', 'class' => 'fixed-sidebar no-skin-config full-height-layout'));

		$this->layout->add_css_file('//fonts.googleapis.com/css?family=Open+Sans:400,600,700');
        $this->layout->add_css_files(array('font-awesome.css'), base_url().'assets/font-awesome/css/');
        $this->layout->add_css_files(array('toastr.min.css'), base_url().'assets/css/plugins/toastr/');
        $this->layout->add_css_files(array('jquery.gritter.css'), base_url().'assets/js/plugins/gritter/');
        $this->layout->add_css_files(array('slick.css'), base_url().'assets/css/plugins/slick/');
        $this->layout->add_css_files(array('slick-theme.css'), base_url().'assets/css/plugins/slick/');
        $this->layout->add_css_files(array('dataTables.bootstrap.css','dataTables.responsive.css','dataTables.tableTools.min.css'), base_url().'assets/css/plugins/dataTables/');
        $this->layout->add_css_files(array('bootstrap.min.css','animate.css','style.css','unslider.css'), base_url().'assets/css/');

        //Main Scripts
        $this->layout->add_js_files(array('jquery-2.1.1.js'), base_url('assets/js/'), 'footer');

        $this->layout->add_js_files(array('jquery.metisMenu.js'), base_url('assets/js/plugins/metisMenu/'), 'footer');

        $this->layout->add_js_files(array('jquery.slimscroll.min.js'), base_url('assets/js/plugins/slimscroll/'), 'footer');
        //Toastr
        $this->layout->add_js_files(array('toastr.min.js'), base_url('assets/js/plugins/toastr/'), 'footer');
        //Tinycon
        $this->layout->add_js_files(array('tinycon.min.js'), base_url('assets/js/plugins/tinycon/'), 'footer');
        //Slick
        $this->layout->add_js_files(array('slick.min.js'), base_url('assets/js/plugins/slick/'), 'footer');

        //Data Tables -->
        $this->layout->add_js_files(array('jquery.dataTables.js','dataTables.bootstrap.js','dataTables.responsive.js','dataTables.tableTools.min.js'), base_url('assets/js/plugins/dataTables/'), 'footer');

        $this->layout->add_js_files(array('inspinia.js','bootstrap.min.js'), base_url('assets/js/'), 'footer');

        // Pace
        $this->layout->add_js_files(array('pace.min.js'), base_url('assets/js/plugins/pace/'), 'footer');
		
    	$this->data['current_user_menu'] = '';
	   if ($this->ion_auth->logged_in())
            {

        $this->layout->set_title('Welcome to :: Nwasco Dashboard');
        $this->layout->set_body_attr(array('id' => 'home', 'class' => 'test more_class'));
        $data['title'] = $this->lang->line('login_heading');
    		$data['user'] = $this->ion_auth->user()->row();
<<<<<<< HEAD
        $data['utilities']  = $this->core->getAllUtilities();
    		$data['schemes']  = $this->core->getSchemes();
=======
    		$data['utilities']  = $this->core->getAllUtilities();
>>>>>>> origin/master
    		$data['indicators']  = $this->core->getIndicators();
        $data['directives'] = $this->core->listDirectives($id);
        $data['projects']   = $this->core->listProjects($id);
        $data['tariffs']    = $this->core->listTarrifs($id);
        $data['licence']    = $this->core->listLcondtions($id);
        $data['srs']    = $this->core->listSRS($id); 
        // load views and send data
         
        // load views and send data
        $this->data['current_user_menu'] = $this->load->view('header', $data);
    		$this->data['current_user_menu'] = $this->load->view('templates/view_utility', $data);
    		$this->data['current_user_menu'] = $this->load->view('footer_main', $data);
       }
       else
       {
         //If no session, redirect to login page
         redirect('auth/login');
       }

}
}