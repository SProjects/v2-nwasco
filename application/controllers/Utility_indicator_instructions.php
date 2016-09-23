<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utility_indicator_instructions extends CI_Controller {
    public $indicatordao;
    public $indicatorpropertydao;
    public $utilitydao;
    public $schemedao;
    public $requestdao;
    public $indicatorinstructiondao;
    public $indicatorinstructionmodel;

    public function __construct() {
        parent::__construct();
        $this->loadDaos();
        $this->indicatordao = $this->indicator_dao;
        $this->indicatorpropertydao = $this->indicator_property_dao;
        $this->utilitydao = $this->utility_dao;
        $this->schemedao = $this->scheme_dao;
        $this->requestdao = $this->request_dao;
        $this->indicatorinstructiondao = $this->indicator_instruction_dao;
        $this->indicatorinstructionmodel = $this->indicator_instruction_model;

        $this->lang->load('auth');
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
        $this->layout->add_css_files(array('bootstrap.min.css', 'animate.css', 'style.css', 'unslider.css', 'base.css'), base_url() . 'assets/css/');

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
        $this->load->model('daos/scheme_dao');
        $this->load->model('daos/request_dao');
        $this->load->model('daos/indicator_property_dao');
        $this->load->model('daos/indicator_dao');
        $this->load->model('daos/indicator_instruction_dao');
        $this->load->model('indicator_instruction_model');
    }

    public function add($utility_id, $indicator_id) {
        if ($this->ion_auth->logged_in()) {
            $this->layout->set_title('Welcome to :: Nwasco Dashboard');
            $this->layout->set_body_attr(array('id' => 'home', 'class' => 'test more_class'));
            $data['title'] = $this->lang->line('login_heading');
            $data['user'] = $this->ion_auth->user()->row();
            $data['utilities'] = $this->utilitydao->get();
            $data['schemes'] = $this->schemedao->get();
            $data['indicators'] = $this->indicatordao->get();
            $data['request_summary'] = Request_model::getRequestsSummary();

            $indicator = $this->indicatordao->getById($indicator_id);

            $data['utility'] = $this->utilitydao->getById($utility_id);
            $data['indicator'] = $indicator;
            $data['indicator_properties'] = $indicator->getIndicatorProperties($indicator);

            $this->load->view('header', $data);
            $this->load->view('utility_indicator_instructions/add', $data);
            $this->load->view('footer_main');
        } else {
            redirect('auth/login');
        }
    }

    public function create() {
        if ($this->ion_auth->logged_in()) {
            $indicator_id = $this->input->post('indicator_id');
            $utility_id = $this->input->post('utility_id');

            $indicator = $this->indicatordao->getById($indicator_id);
            $utility = $this->utilitydao->getById($utility_id);

            $new_indicator_instructions = array();
            $indicator_properties = $indicator->getIndicatorProperties($indicator);

            //Loop over the Instructions fields using their tokens to pick post data from the dynamic form
            foreach ($indicator_properties as $indicator_property) {
                $token = $indicator_property->getToken();
                $new_indicator_instructions[$token] = $this->input->post($indicator_property->getToken());
            }

            //Create IndicatorInstruction objects from the form data. Each field is an IndicatorInstruction.
            $new_instructions = $this->indicatorinstructionmodel->getUtilityInstructionsFromPostData(
                $new_indicator_instructions, $utility, $indicator, NULL);

            foreach ($new_instructions as $new_instruction) {
                if ($this->indicatorinstructiondao->post($new_instruction)) {
                    $this->output->set_status_header(200);
                } else {
                    $this->output->set_status_header(500);
                }
            }
        } else {
            redirect('auth/login');
        }
    }

    public function edit($utility_id, $indicator_id, $union_token) {
        if ($this->ion_auth->logged_in()) {
            $this->layout->set_title('Welcome to :: Nwasco Dashboard');
            $this->layout->set_body_attr(array('id' => 'home', 'class' => 'test more_class'));
            $data['title'] = $this->lang->line('login_heading');
            $data['user'] = $this->ion_auth->user()->row();
            $data['utilities'] = $this->utilitydao->get();
            $data['schemes'] = $this->schemedao->get();
            $data['indicators'] = $this->indicatordao->get();
            $data['request_summary'] = Request_model::getRequestsSummary();

            $indicator = $this->indicatordao->getById($indicator_id);
            $utility = $this->utilitydao->getById($utility_id);

            $existing_instructions = $this->indicatorinstructiondao->get(array(
                Indicator_instruction_dao::UNION_TOKEN_FIELD => $union_token,
                Indicator_instruction_dao::UTILITY_FIELD => $utility->getId(),
                Indicator_instruction_dao::INDICATOR_FIELD => $indicator->getId()
            ));

            $data['union_token'] = $union_token;
            $data['utility'] = $this->utilitydao->getById($utility_id);
            $data['indicator'] = $indicator;
            $data['existing_instructions'] = $existing_instructions;

            $this->load->view('header', $data);
            $this->load->view('utility_indicator_instructions/edit', $data);
            $this->load->view('footer_main');
        } else {
            redirect('auth/login');
        }
    }

    public function update() {
        if ($this->ion_auth->logged_in()) {
            $indicator_id = $this->input->post('indicator_id');
            $utility_id = $this->input->post('utility_id');
            $union_token = $this->input->post('union_token');

            $indicator = $this->indicatordao->getById($indicator_id);
            $utility = $this->utilitydao->getById($utility_id);

            $existing_instructions = $this->indicatorinstructiondao->get(array(
                Indicator_instruction_dao::UNION_TOKEN_FIELD => $union_token,
                Indicator_instruction_dao::UTILITY_FIELD => $utility->getId(),
                Indicator_instruction_dao::INDICATOR_FIELD => $indicator->getId()
            ));

            $updated_indicator_instructions = array();
            $indicator_properties = $indicator->getIndicatorProperties($indicator);

            foreach ($indicator_properties as $indicator_property) {
                $token = $indicator_property->getToken();
                $updated_indicator_instructions[$token] = $this->input->post($indicator_property->getToken());
            }

            //Create IndicatorInstruction objects from the form data. Each field is an IndicatorInstruction.
            $new_instructions = $this->indicatorinstructionmodel->getUtilityInstructionsFromPostData(
                $updated_indicator_instructions, $utility, $indicator, $union_token);

            //Use new instruction data to update the value fields on the exisiting instructions
            $updated_instructions = $this->indicatorinstructionmodel->updateExistingInstructions(
                $existing_instructions, $new_instructions);

            foreach ($updated_instructions as $updated_instruction) {
                if ($this->indicatorinstructiondao->update($updated_instruction)) {
                    $this->destroy_request($updated_instruction);
                    $this->output->set_status_header(200);
                } else {
                    $this->output->set_status_header(500);
                }
            }
        } else {
            redirect('auth/login');
        }
    }

    public function archive($utility_id, $indicator_id, $union_token) {
        if ($this->ion_auth->logged_in()) {
            $indicator = $this->indicatordao->getById($indicator_id);
            $utility = $this->utilitydao->getById($utility_id);

            $existing_instructions = $this->indicatorinstructiondao->get(array(
                Indicator_instruction_dao::UNION_TOKEN_FIELD => $union_token,
                Indicator_instruction_dao::UTILITY_FIELD => $utility->getId(),
                Indicator_instruction_dao::INDICATOR_FIELD => $indicator->getId()
            ));

            foreach ($existing_instructions as $existing_instruction) {
                $existing_instruction->setDeletedAt(date("Y-m-d",time()));
                $this->indicatorinstructiondao->update($existing_instruction);
                $this->destroy_request($existing_instruction);
            }

            redirect('/utility/show/'.$utility->getId(), 'refresh');
        } else {
            redirect('auth/login');
        }
    }

    public function complete($union_token, $utility_id) {
        if ($this->ion_auth->logged_in()) {
            $instructions = $this->indicatorinstructiondao->get(
                array(Indicator_instruction_dao::UNION_TOKEN_FIELD => $union_token)
            );

            $completion_time = date('Y-m-d h:i:sa', time());
            foreach ($instructions as $instruction) {
                $instruction->setCompletedAt($completion_time);
                $this->indicatorinstructiondao->update($instruction);
            }
            redirect('/utility/show/'.$utility_id, 'refresh');
        } else {
            redirect('auth/login');
        }
    }

    private function destroy_request($instruction) {
        $requests = $this->requestdao->get(array(
            Request_dao::INSTRUCTION_FIELD => $instruction->getUnionToken()
        ));

        if (sizeof($requests) > 0) {
            $request = $requests[0];
            if($request != NULL)
                $request->destroy($request);
        }
    }
}