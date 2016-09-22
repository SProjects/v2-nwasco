<?php

class Requests extends CI_Controller {
    public $requestdao;
    public $indicatordao;
    public $indicatorinstructiondao;

    public function __construct() {
        parent::__construct();
        $this->loadDaos();
        $this->requestdao = $this->request_dao;
        $this->indicatordao = $this->indicator_dao;
        $this->indicatorinstructiondao = $this->indicator_instruction_dao;

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

    public function loadDaos(){
        $this->load->model('daos/request_dao');
        $this->load->model('daos/indicator_dao');
        $this->load->model('daos/indicator_instruction_dao');
    }

    public function create($kind, $status, $indicator_id, $instruction_token, $user_id, $source, $facility_id) {
        $indicator = $this->indicatordao->getById($indicator_id);
        $instructions = $this->indicatorinstructiondao->get(array(
            Indicator_instruction_dao::UNION_TOKEN_FIELD => $instruction_token
        ));
        $user = $this->ion_auth->user($user_id)->row();

        $request = new Request_model(NULL, $kind, $status, $instructions, date('Y-m-d h:i:sa', time()), $user, $indicator);
        if($this->requestdao->post($request)) {
            $this->output->set_status_header(200);
            redirect('/'.$source.'/show/'.$facility_id, 'refresh');
        } else {
            $this->output->set_status_header(500);
            redirect('/'.$source.'/show/'.$facility_id, 'refresh');
        }
    }

    public function show($kind) {
        $this->layout->set_title('Welcome to :: Nwasco Dashboard');
        $this->layout->set_body_attr(array('id' => 'home', 'class' => 'test more_class'));
        $data['title'] = $this->lang->line('login_heading');
        $data['user'] = $this->ion_auth->user()->row();
        $data['utilities'] = $this->core->getAllUtilities();
        $data['schemes'] = $this->core->getSchemes();
        $data['indicators'] = $this->core->getIndicators();
        $data['sindicators'] = $this->core->getSchemeIndicators();
        $data['request_summary'] = Request_model::getRequestsSummary();

        $data['heading'] = $kind;
        $data['requests'] = $this->requestdao->get(array(
            Request_dao::KIND_FIELD => $kind,
            Request_dao::STATUS_FIELD => 'PENDING'
        ));

        $this->load->view('header', $data);
        $this->load->view('requests/show', $data);
        $this->load->view('footer_main');
    }

    public function approve($id, $status=NULL, $kind) {
        $request = $this->requestdao->getById($id);
        $request->setStatus($status);
        $this->requestdao->update($request);

        redirect('/requests/show/'.$kind, 'refresh');
    }

    public function delete($id, $kind) {
        $this->requestdao->delete($id);
        redirect('/requests/show/'.$kind, 'refresh');
    }
}