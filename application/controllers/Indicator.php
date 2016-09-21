<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Indicator extends CI_Controller{
    public $indicatordao;

    public function __construct() {
        parent::__construct();
        $this->loadDaos();
        $this->indicatordao = $this->indicator_dao;

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
        $this->layout->add_css_files(array('animate.css','style.css'), base_url().'assets/css/');

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
    }

	public function index() {
        if ($this->ion_auth->logged_in()) {
            $this->layout->set_title('Welcome to :: Nwasco Dashboard');
            $this->layout->set_body_attr(array('id' => 'home', 'class' => 'test more_class'));
            $data['title'] = $this->lang->line('login_heading');
            $data['user'] = $this->ion_auth->user()->row();
            $data['schemes']  = $this->core->getSchemes();
            $data['utilities']  = $this->core->getAllUtilities();
            $data['indicators']  = $this->core->getIndicators();
            $data['directives'] = $this->core->show_directives();

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
            $data['schemes']  = $this->core->getSchemes();
            $data['utilities']  = $this->core->getAllUtilities();
            $data['indicators']  = $this->core->getIndicators();

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

        $new_indicator = new Indicator_model(NULL, $name, $description, $kind, $days_to_expire);
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
            $data['schemes']  = $this->core->getSchemes();
            $data['utilities']  = $this->core->getAllUtilities();
            $data['indicators']  = $this->core->getIndicators();

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

            $indicator = $this->indicatordao->getById($id);
            $indicator->setName($name);
            $indicator->setDescription($description);
            $indicator->setKind($kind);
            $indicator->setDaysToExpire($days_to_expire);

            if($this->indicatordao->update($indicator)) {
                $this->output->set_status_header(200);
            } else {
                $this->output->set_status_header(500);
            }
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

    //Methods to handle directives. TODO: Should be moved to a Directives controller

    public function details($id) {
        $this->data['current_user_menu'] = '';
        if($this->ion_auth->in_group('admin')) {
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
            $this->data['current_user_menu'] = $this->load->view('templates/view_indicator', $data);
            $this->data['current_user_menu'] = $this->load->view('footer_main');
        } else {
         //If no session, redirect to login page
         redirect('auth/login');
        }
    }

    public function show_directive() {
        $this->data['current_user_menu'] = '';
        if ($this->ion_auth->logged_in()) {
            $this->layout->set_title('Welcome to :: Nwasco Dashboard');
            $this->layout->set_body_attr(array('id' => 'home', 'class' => 'test more_class'));
            $data['title'] = $this->lang->line('login_heading');
            $data['user'] = $this->ion_auth->user()->row();
            $id = $this->uri->segment(3);
            $data['utilities']  = $this->core->getAllUtilities();
            $data['schemes']  = $this->core->getSchemes();
            $data['indicators']  = $this->core->getIndicators();
            $data['directives'] = $this->core->show_directives();
            $data['single_directive'] = $this->core->directive_id($id);

            // load views and send data
            $this->data['current_user_menu'] = $this->load->view('header', $data);
            $this->data['current_user_menu'] = $this->load->view('templates/edit_directive', $data);
            $this->data['current_user_menu'] = $this->load->view('footer_main');
        } else {
         //If no session, redirect to login page
         redirect('auth/login');
        }
    }

    public function add_directive() {
        $this->data['current_user_menu'] = '';
        if ($this->ion_auth->logged_in()) {
            $this->layout->set_title('Add Directive :: Nwasco Dashboard');
            $this->layout->set_body_attr(array('id' => 'home', 'class' => 'test more_class'));
            $data['title'] = $this->lang->line('login_heading');
            $data['user'] = $this->ion_auth->user()->row();
            $data['utilities']  = $this->core->getAllUtilities();
            $data['schemes']  = $this->core->getSchemes();
            $data['indicators']  = $this->core->getIndicators();

            // load views and send data
            $this->data['current_user_menu'] = $this->load->view('header', $data);
            $this->data['current_user_menu'] = $this->load->view('templates/add_directive', $data);
            $this->data['current_user_menu'] = $this->load->view('footer_main');
        } else {
            //If no session, redirect to login page
            redirect('auth/login');
       }
    }

    public function edit_directive() {
        $this->data['current_user_menu'] = '';
        if ($this->ion_auth->logged_in()) {
            $this->layout->set_title('Welcome to :: Nwasco Dashboard');
            $this->layout->set_body_attr(array('id' => 'home', 'class' => 'test more_class'));
            $data['title'] = $this->lang->line('login_heading');
            $data['user'] = $this->ion_auth->user()->row();
            $id = $this->uri->segment(3);
            $data['schemes']  = $this->core->getSchemes();
            $data['utilities']  = $this->core->getAllUtilities();
            $data['indicators']  = $this->core->getIndicators();
            $data['directives'] = $this->core->show_directives();
            $data['single_directive'] = $this->core->edit_directive($id);

            // load views and send data
            $this->data['current_user_menu'] = $this->load->view('header', $data);
            $this->data['current_user_menu'] = $this->load->view('templates/edit_directive', $data);
            $this->data['current_user_menu'] = $this->load->view('footer_main');
        } else {
             //If no session, redirect to login page
             redirect('auth/login');
        }
    }

    public function update_directive() {
        $issue_date = $this->input->post('issue_date');
        $issue_date = date( 'Y-m-d H:i:s', strtotime( $issue_date ) );
        $due_date = $this->input->post('due_date');
        $due_date = date( 'Y-m-d H:i:s', strtotime( $due_date ) );
        $id= $this->input->post('dir_id');
        $data = array(
        'issue_date' => $issue_date,
        'due_date' => $due_date,
        'directive' => $this->input->post('directive'),
        'comments' => $this->input->post('comment')
        );
        $this->core->update_directive($id, $data);
        echo'<div class="alert alert-success">One record inserted Successfully</div>';
        $this->edit_directive($id);
    }
}


