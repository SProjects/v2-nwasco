<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Indicator extends CI_Controller{
    public $indicatordao;
    public $utilitydao;
    public $schemedao;

    public function __construct() {
        parent::__construct();
        $this->loadDaos();
        $this->indicatordao = $this->indicator_dao;
        $this->utilitydao = $this->utility_dao;
        $this->schemedao = $this->scheme_dao;

        $this->load->model('request_model');
        $this->load->model('Indicator_summary_model');
        $this->load->library('ion_auth');
		$this->lang->load('auth');

        if (!$this->ion_auth->logged_in()) {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }

        $this->layout->add_custom_meta('meta', array(
            'charset' => 'utf-8'
        ));

        $this->layout->add_custom_meta('meta', array(
            'http-equiv' => 'X-UA-Compatible',
            'content' => 'IE=edge'
        ));

        $js_text = <<<EOF
        
         $(document).ready(function(){
        
                    $('.summernote').summernote({
                      height: 200,                 // set editor height
                      focus: true,                  // set focus to editable area after initializing summernote
                      toolbar: [
                                ['style', ['style']],
                                ['font', ['bold', 'italic', 'underline', 'clear']],
                                ['fontname', ['fontname']],
                                ['color', ['color']],
                                ['para', ['ul', 'ol', 'paragraph']],
                                ['height', ['height']],
                                ['help', ['help']]
                              ]
                    });
                     $('#mycontent').slimScroll({
                          color: '#333',
                          height: '540px',
                          size: '10px',
                          borderRadius: '0px',
                          railBorderRadius: '0px',
                          railVisible: true,
                          alwaysVisible: true
                      });
        
                    $('#data_1 .input-group.date').datepicker({
                        todayBtn: "linked",
                        keyboardNavigation: false,
                        forceParse: false,
                        calendarWeeks: true,
                        autoclose: true,
                        format: "yyyy-mm-dd"
                    });
        
                    $('#data_2 .input-group.date').datepicker({
                        todayBtn: "linked",
                        keyboardNavigation: false,
                        forceParse: false,
                        calendarWeeks: true,
                        autoclose: true,
                        format: "yyyy-mm-dd"
                    });
        
                     var config = {
                        '.chosen-select'           : {},
                        '.chosen-select-deselect'  : {allow_single_deselect:true},
                        '.chosen-select-no-single' : {disable_search_threshold:10},
                        '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
                        '.chosen-select-width'     : {width:"95%"}
                        }
                    for (var selector in config) {
                        $(selector).chosen(config[selector]);
                    }
        
        
               });
EOF;

        $this->layout->add_js_rawtext($js_text, 'footer');

        $this->layout->set_body_attr(array('id' => 'home', 'class' => 'fixed-sidebar no-skin-config full-height-layout'));

        $this->layout->add_css_file('https://fonts.googleapis.com/css?family=Open+Sans:400,600,700');
        $this->layout->add_css_files(array('bootstrap.min.css'), base_url().'assets/css/');
        $this->layout->add_css_files(array('font-awesome.css'), base_url().'assets/font-awesome/css/');
        $this->layout->add_css_files(array('datepicker3.css'), base_url().'assets/css/plugins/datapicker/');
        $this->layout->add_css_file('http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.1/summernote.css');
        $this->layout->add_css_files(array('summernote.css','summernote-bs3.css'), base_url().'assets/css/plugins/summernote/');
        $this->layout->add_css_files(array('animate.css','style.css', 'base.css'), base_url().'assets/css/');

        $this->layout->add_js_file('//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js');
        $this->layout->add_js_files(array('bootstrap.min.js'), base_url('assets/js/'), 'footer');

        //Data picker -->
        $this->layout->add_js_files(array('bootstrap-datepicker.js'), base_url('assets/js/plugins/datapicker/'), 'footer');

        $this->layout->add_js_files(array('jquery.metisMenu.js'), base_url('assets/js/plugins/metisMenu/'), 'footer');
        $this->layout->add_js_files(array('jquery.slimscroll.min.js'), base_url('assets/js/plugins/slimscroll/'), 'footer');

        $this->layout->add_js_files(array('inspinia.js'), base_url('assets/js/'), 'footer');
        // Pace
        $this->layout->add_js_files(array('pace.min.js'), base_url('assets/js/plugins/pace/'), 'footer');
        //Select2 -->
        $this->layout->add_js_files(array('select2.full.min.js'), base_url('assets/js/plugins/select2/'), 'footer');

        $this->layout->add_js_file('//cdnjs.cloudflare.com/ajax/libs/summernote/0.8.1/summernote.js');
        $this->layout->add_js_files(array('tinycon.min.js'), base_url('assets/js/plugins/tinycon/'), 'footer');
        //Main Scripts
    }

    public function loadDaos(){
        $this->load->model('daos/indicator_dao');
        $this->load->model('daos/utility_dao');
        $this->load->model('daos/scheme_dao');
    }

	public function index() {
        if ($this->ion_auth->logged_in()) {
            $this->layout->set_title('Welcome to :: Nwasco Dashboard');
            $this->layout->set_body_attr(array('id' => 'home', 'class' => 'test more_class'));
            $data['title'] = $this->lang->line('login_heading');
            $data['user'] = $this->ion_auth->user()->row();
            $data['utilities'] = $this->utilitydao->get();
            $data['schemes'] = $this->schemedao->get();
            $data['indicators'] = $this->indicatordao->get();
            $data['request_summary'] = Request_model::getRequestsSummary();

            $utility_where_field = array(Indicator_dao::KIND_FIELD => Indicator_model::getUtilityKind());
            $indicators = $this->indicatordao->get($utility_where_field);
            $data['utilityIndicatorObjs'] = $indicators;

            $scheme_where_field = array(Indicator_dao::KIND_FIELD => Indicator_model::getSchemeKind());
            $indicators = $this->indicatordao->get($scheme_where_field);
            $data['schemeIndicatorObjs'] = $indicators;

            $this->load->view('header', $data);
            $this->load->view('indicators/index', $data);
            $this->load->view('footer_main');
        } else {
            redirect('auth/login');
        }
	}

	public function add() {
        if ($this->ion_auth->logged_in()) {
            $this->layout->set_title('Welcome to :: Nwasco Dashboard');
            $this->layout->set_body_attr(array('id' => 'home', 'class' => 'test more_class'));
            $data['title'] = $this->lang->line('login_heading');
            $data['user'] = $this->ion_auth->user()->row();
            $data['utilities'] = $this->utilitydao->get();
            $data['schemes'] = $this->schemedao->get();
            $data['indicators'] = $this->indicatordao->get();
            $data['request_summary'] = Request_model::getRequestsSummary();

            $data['kinds'] = Indicator_model::getAllKinds();

            $this->load->view('header', $data);
            $this->load->view('indicators/add', $data);
            $this->load->view('footer_main');
        } else {
            redirect('auth/login');
        }
    }

    public function create() {
        $name = $this->input->post('name');
        $description = $this->input->post('description');
        $kind = $this->input->post('kind');
        $days_to_expire = $this->input->post('days_to_expire');
        $have_chart = $this->input->post('have_chart');

        if($name == NULL || $description == NULL || $kind == -1 || $days_to_expire == NULL) {
            $this->session->set_flashdata('message', 'Notice: One or more missing fields');
            redirect('add');
        }

        $new_indicator = new Indicator_model(NULL, $name, $description, $kind, $days_to_expire, $have_chart);
        if($this->indicatordao->post($new_indicator)) {
            return true;
        } else {
            return false;
        }
    }

	public function edit($id) {
        if ($this->ion_auth->logged_in()) {
            $this->layout->set_title('Welcome to :: Nwasco Dashboard');
            $this->layout->set_body_attr(array('id' => 'home', 'class' => 'test more_class'));
            $data['title'] = $this->lang->line('login_heading');
            $data['user'] = $this->ion_auth->user()->row();
            $data['utilities'] = $this->utilitydao->get();
            $data['schemes'] = $this->schemedao->get();
            $data['indicators'] = $this->indicatordao->get();
            $data['request_summary'] = Request_model::getRequestsSummary();

            $data['kinds'] = Indicator_model::getAllKinds();

            $indicator = $this->indicatordao->getById($id);
            $data['indicator'] = $indicator;

            $this->load->view('header', $data);
            $this->load->view('indicators/edit', $data);
            $this->load->view('footer_main');
        } else {
            redirect('auth/login');
        }
    }

    public function update() {
        if ($this->ion_auth->logged_in()) {
            $id = $this->input->post('id');
            $name = $this->input->post('name');
            $description = $this->input->post('description');
            $kind = $this->input->post('kind');
            $days_to_expire = $this->input->post('days_to_expire');
            $have_chart = $this->input->post('have_chart');

            if($name == NULL || $description == NULL || $kind == -1 || $days_to_expire == NULL) {
                $this->session->set_flashdata('message', 'Notice: One or more missing fields');
                redirect('edit/'.$id);
            }

            $indicator = $this->indicatordao->getById($id);
            $indicator->setName($name);
            $indicator->setDescription($description);
            $indicator->setKind($kind);
            $indicator->setDaysToExpire($days_to_expire);
            $indicator->setHaveChart($have_chart);

            if($this->indicatordao->update($indicator)) {
                $this->output->set_status_header(200);
            } else {
                $this->output->set_status_header(500);
            }
        } else {
            redirect('auth/login');
        }
    }

    public function show_utility($id) {
        if ($this->ion_auth->logged_in()) {
            $this->layout->set_title('Welcome to :: Nwasco Dashboard');
            $this->layout->set_body_attr(array('id' => 'home', 'class' => 'test more_class'));
            $data['title'] = $this->lang->line('login_heading');
            $data['user'] = $this->ion_auth->user()->row();
            $data['utilities'] = $this->utilitydao->get();
            $data['schemes'] = $this->schemedao->get();
            $data['indicators'] = $this->indicatordao->get();
            $data['request_summary'] = Request_model::getRequestsSummary();

            $data['indicator'] = $this->indicatordao->getById($id);
            $data['utility_objects'] = $this->utilitydao->get();

            $this->load->view('header', $data);
            $this->load->view('indicators/utilities/show', $data);
            $this->load->view('footer_main');
        } else {
            redirect('auth/login');
        }
    }

    public function show_scheme($id) {
        if ($this->ion_auth->logged_in()) {
            $this->layout->set_title('Welcome to :: Nwasco Dashboard');
            $this->layout->set_body_attr(array('id' => 'home', 'class' => 'test more_class'));
            $data['title'] = $this->lang->line('login_heading');
            $data['user'] = $this->ion_auth->user()->row();
            $data['utilities'] = $this->utilitydao->get();
            $data['schemes'] = $this->schemedao->get();
            $data['indicators'] = $this->indicatordao->get();
            $data['request_summary'] = Request_model::getRequestsSummary();

            $data['indicator'] = $this->indicatordao->getById($id);
            $data['scheme_objects'] = $this->schemedao->get();

            $this->load->view('header', $data);
            $this->load->view('indicators/schemes/show', $data);
            $this->load->view('footer_main');
        } else {
            redirect('auth/login');
        }
    }

    public function delete($id) {
        if ($this->ion_auth->logged_in()) {
            $this->indicatordao->delete($id);
            redirect('/indicator/', 'refresh');
        } else {
            redirect('auth/login');
        }
    }
}


