<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    public $utilitydao;
    public $schemedao;
    public $indicatordao;

    public function __construct() {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->library('notifications_manager');
        $this->lang->load('auth');
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $this->loadDaos();
        $this->load->model('request_model');
        $this->load->model('indicator_summary_model');
        $this->utilitydao = $this->utility_dao;
        $this->schemedao = $this->scheme_dao;
        $this->indicatordao = $this->indicator_dao;
    }

    public function loadDaos() {
        $this->load->model('daos/utility_dao');
        $this->load->model('daos/scheme_dao');
        $this->load->model('daos/indicator_dao');
    }

    public function index() {
        set_time_limit(0);
        $this->layout->add_custom_meta('meta', array(
            'charset' => 'utf-8'
        ));

        $this->layout->add_custom_meta('meta', array(
            'http-equiv' => 'X-UA-Compatible',
            'content' => 'IE=edge'
        ));

        $js_text2 = <<<EOF
$(function() {

            $("#slideshow > div:gt(0)").hide();

            setInterval(function() {
              $('#slideshow > div:first')
                .fadeOut(1000)
                .next()
                .fadeIn(1000)
                .end()
                .appendTo('#slideshow');
            },  6000);

        });

EOF;

        $js_text = <<<EOF
 $(document).ready(function () {
                setTimeout(function () {
                    toastr.options = {
                        closeButton: true,
                        progressBar: true,
                        showMethod: 'slideDown',
                        timeOut: 4000
                    };
                    toastr.success('Admin Dashboard', 'Welcome to NWASCO');

                }, 1300);

                $('.autoplay').slick({
                  slidesToShow: 3,
                  slidesToScroll: 1,
                  autoplay: true,
                  autoplaySpeed: 2000,
                });

            $(".select2_demo_1").select2();
            $(".select2_demo_2").select2();
            $(".select2_demo_3").select2({
                placeholder: "Select a state",
                allowClear: true
            });
             $('#mycontent').slimScroll({
                  color: '#333',
                  height: '570px',
                  size: '10px',
                  borderRadius: '0px',
                  railBorderRadius: '0px',
                  railVisible: true,
                  alwaysVisible: true
              });

              $('.my-indicators').unslider({
                autoplay: true,
                arrows: false,
                nav: false,
                delay: 10000
                });

              $('.my-slider').unslider({
                autoplay: false,
                nav: false
                });
            $('#slideshow').fadeSlideShow({
                PlayPauseElement: false,
                NextElement: false,
                PrevElement: false,
                ListElement: false
            });
    });
EOF;
        $this->layout->add_js_rawtext($js_text2, 'header');
        $this->layout->add_js_rawtext($js_text, 'footer');

        $this->layout->set_body_attr(array('id' => 'home', 'class' => 'fixed-sidebar no-skin-config full-height-layout'));

        $this->layout->add_css_file('https://fonts.googleapis.com/css?family=Roboto:400,700|Ubuntu');
        $this->layout->add_css_files(array('bootstrap.min.css'), base_url() . 'assets/css/');
        $this->layout->add_css_files(array('font-awesome.css'), base_url() . 'assets/font-awesome/css/');
        $this->layout->add_css_files(array('toastr.min.css'), base_url() . 'assets/css/plugins/toastr/');
        $this->layout->add_css_files(array('select2.min.css'), base_url() . 'assets/css/plugins/select2/');
        $this->layout->add_css_files(array('jquery.gritter.css'), base_url() . 'assets/js/plugins/gritter/');
        $this->layout->add_css_files(array('slick.css'), base_url() . 'assets/css/plugins/slick/');
        $this->layout->add_css_files(array('slick-theme.css'), base_url() . 'assets/css/plugins/slick/');

        //Alertify
        $this->layout->add_css_files(array('alertify.core.css'), base_url('assets/css/'));
        $this->layout->add_css_files(array('alertify.default.css'), base_url('assets/css/'));
        $this->layout->add_css_files(array('alertify.bootstrap.css'), base_url('assets/css/'));

        //Main Stylesheet
        $this->layout->add_css_files(array('unslider.css', 'animate.css', 'style.css', 'slider.css'), base_url() . 'assets/css/');
        // Google
        $this->layout->add_js_file('//ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js');
        //Main Scripts
        $this->layout->add_js_files(array('bootstrap.min.js', 'inspinia.js', 'unslider-min.js'), base_url('assets/js/'), 'footer');
        $this->layout->add_js_files(array('jquery.metisMenu.js'), base_url('assets/js/plugins/metisMenu/'), 'footer');
        $this->layout->add_js_files(array('jquery.slimscroll.min.js'), base_url('assets/js/plugins/slimscroll/'), 'footer');
        // Google
        $this->layout->add_js_file('https://www.google.com/jsapi');
        // Pace
        $this->layout->add_js_files(array('pace.min.js'), base_url('assets/js/plugins/pace/'), 'footer');
        // JQuery
        $this->layout->add_js_files(array('jquery-ui.min.js'), base_url('assets/js/plugins/jquery-ui/'), 'footer');
        // GITTER
        $this->layout->add_js_files(array('jquery.gritter.min.js'), base_url('assets/js/plugins/gritter/'), 'footer');
        //Toastr
        $this->layout->add_js_files(array('toastr.min.js'), base_url('assets/js/plugins/toastr/'), 'footer');
        //Tinycon
        $this->layout->add_js_files(array('tinycon.min.js'), base_url('assets/js/plugins/tinycon/'), 'footer');
        //Slick
        $this->layout->add_js_files(array('slick.min.js'), base_url('assets/js/plugins/slick/'), 'footer');
        //Select2 -->
        $this->layout->add_js_files(array('select2.full.min.js'), base_url('assets/js/plugins/select2/'), 'footer');

        //Data Tables -->
        $this->layout->add_js_files(array('jquery.dataTables.js', 'dataTables.bootstrap.js', 'dataTables.responsive.js', 'dataTables.tableTools.min.js'), base_url('assets/js/plugins/dataTables/'), 'footer');

        //Alertify
        $this->layout->add_js_files(array('alertify.min.js'), base_url('assets/js/'), 'footer');

        //ChartJS-->
        $this->layout->add_js_files(array('Chart.min.js'), base_url('assets/js/plugins/chartJs/'), 'header');


        if ($this->ion_auth->logged_in()) {
            $user = $this->ion_auth->user()->row();
            $this->data['title'] = $this->lang->line('dashboard_heading');

            $this->layout->set_title('Welcome to :: Nwasco Dashboard');
            $this->layout->set_body_attr(array('id' => 'home', 'class' => 'test more_class'));
            $data['dashboard'] = $this->lang->line('dashboard_heading');
            $data['user'] = $user;
            $data['utilities'] = $this->utilitydao->get();
            $data['schemes'] = $this->schemedao->get();
            $data['indicators'] = $this->indicatordao->get();
            $data['utility_indicators'] = $this->indicatordao->get(array(
                Indicator_dao::KIND_FIELD => Indicator_model::getUtilityKind()
            ));

            $data['request_summary'] = Request_model::getRequestsSummary();
            $data['notifications'] = $this->notifications_manager->getNotifications($user);

            $this->load->view('header', $data);
            $this->load->view('index', $data);
            $this->load->view('footer_main', $data);
        } else {
            redirect('auth/login', 'refresh');
        }

    }
}
