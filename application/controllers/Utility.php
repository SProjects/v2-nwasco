<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utility extends CI_Controller {
    public $utilitydao;
    public $indicatordao;
    public $indicatorpropertydao;
    public $indicatorinstructiondao;

    public function __construct() {
        parent::__construct();
        $this->loadDaos();
        $this->utilitydao = $this->utility_dao;
        $this->indicatorpropertydao = $this->indicator_property_dao;
        $this->indicatorinstructiondao = $this->indicator_instruction_dao;
        $this->indicatordao = $this->indicator_dao;

        $this->load->model('request_model');
        $this->load->library('ion_auth');

        if (!$this->ion_auth->logged_in()) {
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
        $this->layout->add_css_files(array('font-awesome.css'), base_url() . 'assets/font-awesome/css/');
        $this->layout->add_css_files(array('toastr.min.css'), base_url() . 'assets/css/plugins/toastr/');
        $this->layout->add_css_files(array('jquery.gritter.css'), base_url() . 'assets/js/plugins/gritter/');
        $this->layout->add_css_files(array('slick.css'), base_url() . 'assets/css/plugins/slick/');
        $this->layout->add_css_files(array('slick-theme.css'), base_url() . 'assets/css/plugins/slick/');
        $this->layout->add_css_files(array('dataTables.bootstrap.css', 'dataTables.responsive.css', 'dataTables.tableTools.min.css'), base_url() . 'assets/css/plugins/dataTables/');
        $this->layout->add_css_files(array('bootstrap.min.css', 'animate.css', 'style.css', 'unslider.css'), base_url() . 'assets/css/');

        $this->layout->add_js_file('//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js');

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
        $this->layout->add_js_files(array('jquery.dataTables.js', 'dataTables.bootstrap.js', 'dataTables.responsive.js', 'dataTables.tableTools.min.js'), base_url('assets/js/plugins/dataTables/'), 'footer');

        $this->layout->add_js_files(array('inspinia.js', 'bootstrap.min.js'), base_url('assets/js/'), 'footer');

        // Pace
        $this->layout->add_js_files(array('pace.min.js'), base_url('assets/js/plugins/pace/'), 'footer');


    }

    public function loadDaos() {
        $this->load->model('daos/utility_dao');
        $this->load->model('daos/indicator_dao');
        $this->load->model('daos/indicator_instruction_dao');
        $this->load->model('daos/indicator_property_dao');
    }

    public function index() {
        if ($this->ion_auth->logged_in()) {
            $this->layout->set_title('Welcome to :: Nwasco Dashboard');
            $this->layout->set_body_attr(array('id' => 'home', 'class' => 'test more_class'));
            $data['title'] = $this->lang->line('login_heading');
            $data['user'] = $this->ion_auth->user()->row();
            $data['utilities'] = $this->core->getAllUtilities();
            $data['schemes'] = $this->core->getSchemes();
            $data['indicators'] = $this->core->getIndicators();
            $data['request_summary'] = Request_model::getRequestsSummary();

            $utilities = $this->utilitydao->get(); //Using the UtilityDao class
            $data['utilityObjs'] = $utilities;

            $this->load->view('header', $data);
            $this->load->view('utilities/index', $data);
            $this->load->view('footer_main', $data);
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
            $data['utilities'] = $this->core->getAllUtilities();
            $data['schemes'] = $this->core->getSchemes();
            $data['indicators'] = $this->core->getIndicators();
            $data['inspectors'] = $this->ion_auth->users()->result();
            $data['request_summary'] = Request_model::getRequestsSummary();

            $this->load->view('header', $data);
            $this->load->view('utilities/add', $data);
            $this->load->view('footer_main');
        } else {
            redirect('auth/login');
        }
    }

    public function create() {
        $name = $this->input->post('name');
        $abbreviation = $this->input->post('abbreviation');
        $inspector_id = $this->input->post('inspector');

        $inspector = NULL;
        if($inspector_id != -1) {
            $inspector = $this->ion_auth->user($inspector_id)->row();
        }

        $new_utility = new Utility_model(NULL, $name, $abbreviation, $inspector);
        if($this->utilitydao->post($new_utility)) {
            $this->output->set_status_header(200);
            return true;
        } else {
            $this->output->set_status_header(500);
            return false;
        }
    }

    public function edit($id) {
        if ($this->ion_auth->logged_in()) {
            $this->layout->set_title('Welcome to :: Nwasco Dashboard');
            $this->layout->set_body_attr(array('id' => 'home', 'class' => 'test more_class'));
            $data['title'] = $this->lang->line('login_heading');
            $data['user'] = $this->ion_auth->user()->row();
            $data['utilities'] = $this->core->getAllUtilities();
            $data['schemes'] = $this->core->getSchemes();
            $data['indicators'] = $this->core->getIndicators();
            $data['inspectors'] = $this->ion_auth->users()->result();
            $data['request_summary'] = Request_model::getRequestsSummary();

            $utility = $this->utilitydao->getById($id);
            $data['utility'] = $utility;

            $this->load->view('header', $data);
            $this->load->view('utilities/edit', $data);
            $this->load->view('footer_main');
        } else {
            redirect('auth/login');
        }
    }

    public function update() {
        if ($this->ion_auth->logged_in()) {
            $id = $this->input->post('id');
            $name = $this->input->post('name');
            $abbreviation = $this->input->post('abbreviation');
            $inspector_id = $this->input->post('inspector');

            //TODO: Improve this by adding it to a save() in the Utility model
            $utility = $this->utilitydao->getById($id);
            $utility->setName($name);
            $utility->setAbbreviation($abbreviation);
            if ($inspector_id == -1) {
                $utility->setInspector(NULL);
            } elseif ($inspector_id != $utility->getInspectorId()) {
                $inspector = $this->ion_auth->user($inspector_id)->row();
                $utility->setInspector($inspector);
            }

            if($this->utilitydao->update($utility)) {
                $this->output->set_status_header(200);
            } else {
                $this->output->set_status_header(500);
            }
        } else {
            redirect('auth/login');
        }
    }

    public function show($id) {
        $this->layout->set_title('Welcome to :: Nwasco Dashboard');
        $this->layout->set_body_attr(array('id' => 'home', 'class' => 'test more_class'));
        $data['title'] = $this->lang->line('login_heading');
        $data['user'] = $this->ion_auth->user()->row();
        $data['utilities'] = $this->core->getAllUtilities();
        $data['schemes'] = $this->core->getSchemes();
        $data['indicators'] = $this->core->getIndicators();
        $data['directives'] = $this->core->listDirectives($id);
        $data['projects'] = $this->core->listProjects($id);
        $data['tariffs'] = $this->core->listTarrifs($id);
        $data['licence'] = $this->core->listLcondtions($id);
        $data['srs'] = $this->core->listSRS($id);
        $data['request_summary'] = Request_model::getRequestsSummary();

        $utility = $this->utilitydao->getById($id);
        $data['utility'] = $utility;
        $data['instructions'] = Utility_model::getIndicatorInstructions($utility);

        $this->load->view('header', $data);
        $this->load->view('utilities/instructions/show', $data);
        $this->load->view('footer_main', $data);
    }

}