<?php

class Indicator_properties extends CI_Controller {
    public $indicatordao;
    public $indicatorpropertydao;

    public function __construct() {
        parent::__construct();
        $this->loadDaos();
        $this->load->model('indicator_model');
        $this->indicatordao = $this->indicator_dao;
        $this->indicatorpropertydao = $this->indicator_property_dao;

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
        $this->load->model('daos/indicator_dao');
        $this->load->model('daos/indicator_property_dao');
    }

    public function show($indicator_id) {
        $this->layout->set_title('Welcome to :: Nwasco Dashboard');
        $this->layout->set_body_attr(array('id' => 'home', 'class' => 'test more_class'));
        $data['title'] = $this->lang->line('login_heading');
        $data['user'] = $this->ion_auth->user()->row();
        $data['utilities'] = $this->core->getAllUtilities();
        $data['schemes'] = $this->core->getSchemes();
        $data['indicators'] = $this->core->getIndicators();
        $data['sindicators'] = $this->core->getSchemeIndicators();

        $indicator = $this->indicatordao->getById($indicator_id);
        $data['indicator'] = $indicator;
        $data['indicator_properties'] = $this->indicatorpropertydao->getByIndicator($indicator);

        $this->load->view('header', $data);
        $this->load->view('indicator_properties/show', $data);
        $this->load->view('footer_main');
    }

    public function add($indicator_id) {
        $this->layout->set_title('Welcome to :: Nwasco Dashboard');
        $this->layout->set_body_attr(array('id' => 'home', 'class' => 'test more_class'));
        $data['title'] = $this->lang->line('login_heading');
        $data['user'] = $this->ion_auth->user()->row();
        $data['utilities'] = $this->core->getAllUtilities();
        $data['schemes'] = $this->core->getSchemes();
        $data['indicators'] = $this->core->getIndicators();
        $data['sindicators'] = $this->core->getSchemeIndicators();

        $indicator = $this->indicatordao->getById($indicator_id);
        $data['indicator'] = $indicator;
        $data['datatypes'] = Indicator_property_model::getAllDataTypes();

        $this->load->view('header', $data);
        $this->load->view('indicator_properties/add', $data);
        $this->load->view('footer_main');
    }

    public function create() {
        $name = $this->input->post('name');
        $description = $this->input->post('description');
        $datatype = $this->input->post('datatype');
        $indicator_id = $this->input->post('indicator_id');

        $indicator = $this->indicatordao->getById($indicator_id);

        $new_indicator_property = new Indicator_property_model(NULL, $name, $description, $datatype, $indicator);
        if($this->indicatorpropertydao->post($new_indicator_property)) {
            $this->output->set_status_header(200);
            return true;
        } else {
            $this->output->set_status_header(500);
            return false;
        }
    }

    public function edit($indicator_id, $id) {
        if ($this->ion_auth->logged_in()) {
            $this->layout->set_title('Welcome to :: Nwasco Dashboard');
            $this->layout->set_body_attr(array('id' => 'home', 'class' => 'test more_class'));
            $data['title'] = $this->lang->line('login_heading');
            $data['user'] = $this->ion_auth->user()->row();
            $data['utilities'] = $this->core->getAllUtilities();
            $data['schemes'] = $this->core->getSchemes();
            $data['indicators'] = $this->core->getIndicators();
            $data['sindicators'] = $this->core->getSchemeIndicators();

            $indicator = $this->indicatordao->getById($indicator_id);
            $data['indicator'] = $indicator;
            $data['datatypes'] = Indicator_property_model::getAllDataTypes();
            $data['indicator_property'] = $this->indicatorpropertydao->getById($id);

            $this->load->view('header', $data);
            $this->load->view('indicator_properties/edit', $data);
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
            $datatype = $this->input->post('datatype');
            $indicator_id = $this->input->post('indicator_id');

            $indicator = $this->indicatordao->getById($indicator_id);

            //TODO: Improve this by adding it to a save() in the IndicatorProperty model
            $indicator_property = $this->indicatorpropertydao->getById($id);
            $indicator_property->setName($name);
            $indicator_property->setDescription($description);
            if ($datatype == -1) {
                $indicator_property->setDatatype(NULL);
            } else {
                $indicator_property->setDatatype($datatype);
            }
            $indicator_property->setIndicator($indicator);

            if($this->indicatorpropertydao->update($indicator_property)) {
                $this->output->set_status_header(200);
            } else {
                $this->output->set_status_header(500);
            }
        } else {
            redirect('auth/login');
        }
    }

    public function delete($indicator_id, $id) {
        if ($this->ion_auth->logged_in()) {
            $this->indicatorpropertydao->delete($id);
            redirect('/indicator_properties/show/'.$indicator_id, 'refresh');
        } else {
            redirect('auth/login');
        }
    }
}