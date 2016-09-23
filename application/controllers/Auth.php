<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    public $utilitydao;
    public $schemedao;
    public $indicatordao;

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library(array('ion_auth', 'form_validation'));
        $this->load->helper(array('url', 'language'));

        $this->loadDaos();
        $this->load->model('request_model');
        $this->utilitydao = $this->utility_dao;
        $this->schemedao = $this->scheme_dao;
        $this->indicatordao = $this->indicator_dao;

        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

        $this->lang->load('auth');

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
                  height: '540px',
                  size: '10px',
                  borderRadius: '0px',
                  railBorderRadius: '0px',
                  railVisible: true,
                  alwaysVisible: true
              });
              $('.element-detail-box').slimScroll({
                  color: '#333',
                  height: '540px',
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

                $("[data-toggle=modal]").click(function(event) {
                            event.preventDefault();
                            var url = $(this).attr("href");
                            if (url.indexOf("#") == 0) {
                                $(url).modal('open');
                            } else {
                                $.get(url, function(data) {
                                    $('<div class="modal hide fade">' + data + '</div>').modal().on('hidden', function () { $(this).remove(); });
                                }).success(function() { $('input:text:visible:first').focus(); });
                            }
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


        $this->layout->add_js_files('//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js');
        //Main Scripts
        $this->layout->add_js_files(array('jquery-2.1.1.js', 'bootstrap.min.js'), base_url('assets/js/'), 'footer');

        $this->layout->add_js_files(array('jquery.metisMenu.js'), base_url('assets/js/plugins/metisMenu/'), 'footer');

        $this->layout->add_js_files(array('jquery.slimscroll.min.js'), base_url('assets/js/plugins/slimscroll/'), 'footer');
        // GITTER
        $this->layout->add_js_files(array('jquery.gritter.min.js'), base_url('assets/js/plugins/gritter/'), 'footer');
        //Toastr
        $this->layout->add_js_files(array('toastr.min.js'), base_url('assets/js/plugins/toastr/'), 'footer');
        //Tinycon
        $this->layout->add_js_files(array('tinycon.min.js'), base_url('assets/js/plugins/tinycon/'), 'footer');
        //Slick
        $this->layout->add_js_files(array('slick.min.js'), base_url('assets/js/plugins/slick/'), 'footer');

        //Data Tables -->
        $this->layout->add_js_files(array('jquery.dataTables.js', 'dataTables.bootstrap.js', 'dataTables.responsive.js', 'dataTables.tableTools.min.js'), base_url('assets/js/plugins/dataTables/'), 'footer');

        $this->layout->add_js_files(array('inspinia.js'), base_url('assets/js/'), 'footer');

        // Pace
        $this->layout->add_js_files(array('pace.min.js'), base_url('assets/js/plugins/pace/'), 'footer');
    }

    public function loadDaos() {
        $this->load->model('daos/utility_dao');
        $this->load->model('daos/scheme_dao');
        $this->load->model('daos/indicator_dao');
    }

    // redirect if needed, otherwise display the user list
    function index() {

        if (!$this->ion_auth->logged_in()) {

            // redirect them to the login page
            redirect('auth/login', 'refresh');
        } elseif (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
        {
            // redirect them to the home page because they must be an administrator to view this
            return show_error('You must be an administrator to view this page.');
        } else {
            // set the flash data error message if there is one
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

            //list the users
            $this->data['users'] = $this->ion_auth->users()->result();
            foreach ($this->data['users'] as $k => $user) {
                $this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
            }


            $this->layout->set_title('View Users :: Nwasco Dashboard');
            $this->data['user'] = $this->ion_auth->user()->row();
            $this->data['utilities'] = $this->utilitydao->get();
            $this->data['schemes'] = $this->schemedao->get();
            $this->data['indicators'] = $this->indicatordao->get();
            $this->data['request_summary'] = Request_model::getRequestsSummary();

            $this->_render_page('header', $this->data);
            $this->_render_page('user_nav', $this->data);
            $this->_render_page('auth/index', $this->data);
            $this->_render_page('user_foot', $this->data);
            $this->_render_page('footer_main', $this->data);

        }
    }

    // log the user in
    function login() {

        $this->layout->add_custom_meta('meta', array(
            'charset' => 'utf-8'
        ));

        $this->layout->add_custom_meta('meta', array(
            'http-equiv' => 'X-UA-Compatible',
            'content' => 'IE=edge'
        ));
        $css_text = <<<EOF

body {
    background-color: #fff;
}
EOF;

        $this->layout->add_css_rawtext($css_text);

        $this->layout->set_body_attr(array('id' => 'home', 'class' => 'gray-bg'));

        $this->layout->add_css_files(array('bootstrap.min.css'), base_url() . 'assets/css/');
        $this->layout->add_css_files(array('font-awesome.css'), base_url() . 'assets/font-awesome/css/');
        $this->layout->add_css_files(array('animate.css', 'style.css'), base_url() . 'assets/css/');
        $this->layout->add_js_files(array('jquery-2.1.1.js', 'bootstrap.min.js'), base_url('assets/js/'), 'footer', 'async');
        $this->layout->set_title('Welcome to Nwasco Dashboard | Login');
        $this->data['title'] = $this->lang->line('login_heading');

        //validate form input
        $this->form_validation->set_rules('identity', str_replace(':', '', $this->lang->line('login_identity_label')), 'required');
        $this->form_validation->set_rules('password', str_replace(':', '', $this->lang->line('login_password_label')), 'required');

        if ($this->form_validation->run() == true) {
            // check to see if the user is logging in
            // check for "remember me"
            $remember = (bool)$this->input->post('remember');

            if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember)) {
                //if the login is successful
                //redirect them back to the home page
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect('dashboard', 'refresh');
            } else {
                // if the login was un-successful
                // redirect them back to the login page
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                redirect('auth/login', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
            }
        } else {
            // the user is not logging in so display the login page
            // set the flash data error message if there is one
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

            $this->data['identity'] = array('name' => 'identity',
                'id' => 'identity',
                'type' => 'text',
                'value' => $this->form_validation->set_value('identity'),
            );
            $this->data['password'] = array('name' => 'password',
                'id' => 'password',
                'type' => 'password',
            );

            $this->_render_page('auth/login', $this->data);
        }
    }

    // log the user out
    function logout() {
        $this->data['title'] = "Logout";

        // log the user out
        $logout = $this->ion_auth->logout();

        // redirect them to the login page
        $this->session->set_flashdata('message', $this->ion_auth->messages());
        redirect('auth/login', 'refresh');
    }

    // change password
    function change_password() {
        $this->form_validation->set_rules('old', $this->lang->line('change_password_validation_old_password_label'), 'required');
        $this->form_validation->set_rules('new', $this->lang->line('change_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
        $this->form_validation->set_rules('new_confirm', $this->lang->line('change_password_validation_new_password_confirm_label'), 'required');

        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $user = $this->ion_auth->user()->row();

        if ($this->form_validation->run() == false) {
            // display the form
            // set the flash data error message if there is one
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

            $this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
            $this->data['old_password'] = array(
                'name' => 'old',
                'id' => 'old',
                'type' => 'password',
            );
            $this->data['new_password'] = array(
                'name' => 'new',
                'id' => 'new',
                'type' => 'password',
                'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
            );
            $this->data['new_password_confirm'] = array(
                'name' => 'new_confirm',
                'id' => 'new_confirm',
                'type' => 'password',
                'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
            );
            $this->data['user_id'] = array(
                'name' => 'user_id',
                'id' => 'user_id',
                'type' => 'hidden',
                'value' => $user->id,
            );

            $this->layout->set_title('Change Password :: Nwasco Dashboard');
            $this->data['user'] = $this->ion_auth->user()->row();
            $this->data['utilities'] = $this->utilitydao->get();
            $this->data['schemes'] = $this->schemedao->get();
            $this->data['indicators'] = $this->indicatordao->get();
            $this->data['request_summary'] = Request_model::getRequestsSummary();

            // render
            $this->_render_page('header', $this->data);
            $this->_render_page('user_nav', $this->data);
            $this->_render_page('auth/change_password', $this->data);
            $this->_render_page('user_foot', $this->data);
            $this->_render_page('footer_main', $this->data);
        } else {
            $identity = $this->session->userdata('identity');

            $change = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'));

            if ($change) {
                //if the password was successfully changed
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                $this->logout();
            } else {
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                redirect('auth/change_password', 'refresh');
            }
        }
    }

    // forgot password
    function forgot_password() {
        // setting validation rules by checking whether identity is username or email
        if ($this->config->item('identity', 'ion_auth') != 'email') {
            $this->form_validation->set_rules('identity', $this->lang->line('forgot_password_identity_label'), 'required');
        } else {
            $this->form_validation->set_rules('identity', $this->lang->line('forgot_password_validation_email_label'), 'required|valid_email');
        }


        if ($this->form_validation->run() == false) {
            $this->data['type'] = $this->config->item('identity', 'ion_auth');
            // setup the input
            $this->data['identity'] = array('name' => 'identity',
                'id' => 'identity',
            );

            if ($this->config->item('identity', 'ion_auth') != 'email') {
                $this->data['identity_label'] = $this->lang->line('forgot_password_identity_label');
            } else {
                $this->data['identity_label'] = $this->lang->line('forgot_password_email_identity_label');
            }

            // set any errors and display the form
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

            $this->layout->set_title('Forgot Password :: Nwasco Dashboard');
            $this->data['user'] = $this->ion_auth->user()->row();
            $this->data['utilities'] = $this->utilitydao->get();
            $this->data['schemes'] = $this->schemedao->get();
            $this->data['indicators'] = $this->indicatordao->get();
            $this->data['request_summary'] = Request_model::getRequestsSummary();
            // render
            $this->_render_page('header', $this->data);
            $this->_render_page('user_nav', $this->data);
            $this->_render_page('auth/forgot_password', $this->data);
            $this->_render_page('user_foot', $this->data);
            $this->_render_page('footer_main', $this->data);

        } else {
            $identity_column = $this->config->item('identity', 'ion_auth');
            $identity = $this->ion_auth->where($identity_column, $this->input->post('identity'))->users()->row();

            if (empty($identity)) {

                if ($this->config->item('identity', 'ion_auth') != 'email') {
                    $this->ion_auth->set_error('forgot_password_identity_not_found');
                } else {
                    $this->ion_auth->set_error('forgot_password_email_not_found');
                }

                $this->session->set_flashdata('message', $this->ion_auth->errors());
                redirect("auth/forgot_password", 'refresh');
            }

            // run the forgotten password method to email an activation code to the user
            $forgotten = $this->ion_auth->forgotten_password($identity->{$this->config->item('identity', 'ion_auth')});

            if ($forgotten) {
                // if there were no errors
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect("auth/login", 'refresh'); //we should display a confirmation page here instead of the login page
            } else {
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                redirect("auth/forgot_password", 'refresh');
            }
        }
    }

    // reset password - final step for forgotten password
    public function reset_password($code = NULL) {
        if (!$code) {
            show_404();
        }

        $user = $this->ion_auth->forgotten_password_check($code);

        if ($user) {
            // if the code is valid then display the password reset form

            $this->form_validation->set_rules('new', $this->lang->line('reset_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
            $this->form_validation->set_rules('new_confirm', $this->lang->line('reset_password_validation_new_password_confirm_label'), 'required');

            if ($this->form_validation->run() == false) {
                // display the form

                // set the flash data error message if there is one
                $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

                $this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
                $this->data['new_password'] = array(
                    'name' => 'new',
                    'id' => 'new',
                    'type' => 'password',
                    'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
                );
                $this->data['new_password_confirm'] = array(
                    'name' => 'new_confirm',
                    'id' => 'new_confirm',
                    'type' => 'password',
                    'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
                );
                $this->data['user_id'] = array(
                    'name' => 'user_id',
                    'id' => 'user_id',
                    'type' => 'hidden',
                    'value' => $user->id,
                );
                $this->data['csrf'] = $this->_get_csrf_nonce();
                $this->data['code'] = $code;

                $this->layout->set_title('Reset Password :: Nwasco Dashboard');
                $this->data['user'] = $this->ion_auth->user()->row();
                $this->data['utilities'] = $this->utilitydao->get();
                $this->data['schemes'] = $this->schemedao->get();
                $this->data['indicators'] = $this->indicatordao->get();
                $this->data['request_summary'] = Request_model::getRequestsSummary();

                // render
                $this->_render_page('header', $this->data);
                $this->_render_page('user_nav', $this->data);
                $this->_render_page('auth/reset_password', $this->data);
                $this->_render_page('user_foot', $this->data);
                $this->_render_page('footer_main', $this->data);
            } else {
                // do we have a valid request?
                if ($this->_valid_csrf_nonce() === FALSE || $user->id != $this->input->post('user_id')) {

                    // something fishy might be up
                    $this->ion_auth->clear_forgotten_password_code($code);

                    show_error($this->lang->line('error_csrf'));

                } else {
                    // finally change the password
                    $identity = $user->{$this->config->item('identity', 'ion_auth')};

                    $change = $this->ion_auth->reset_password($identity, $this->input->post('new'));

                    if ($change) {
                        // if the password was successfully changed
                        $this->session->set_flashdata('message', $this->ion_auth->messages());
                        redirect("auth/login", 'refresh');
                    } else {
                        $this->session->set_flashdata('message', $this->ion_auth->errors());
                        redirect('auth/reset_password/' . $code, 'refresh');
                    }
                }
            }
        } else {
            // if the code is invalid then send them back to the forgot password page
            $this->session->set_flashdata('message', $this->ion_auth->errors());
            redirect("auth/forgot_password", 'refresh');
        }
    }


    // activate the user
    function activate($id, $code = false) {
        if ($code !== false) {
            $activation = $this->ion_auth->activate($id, $code);
        } else if ($this->ion_auth->is_admin()) {
            $activation = $this->ion_auth->activate($id);
        }

        if ($activation) {
            // redirect them to the auth page
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect("auth", 'refresh');
        } else {
            // redirect them to the forgot password page
            $this->session->set_flashdata('message', $this->ion_auth->errors());
            redirect("auth/forgot_password", 'refresh');
        }
    }

    // deactivate the user
    function deactivate($id = NULL) {
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            // redirect them to the home page because they must be an administrator to view this
            return show_error('You must be an administrator to view this page.');
        }

        $id = (int)$id;

        $this->load->library('form_validation');
        $this->form_validation->set_rules('confirm', $this->lang->line('deactivate_validation_confirm_label'), 'required');
        $this->form_validation->set_rules('id', $this->lang->line('deactivate_validation_user_id_label'), 'required|alpha_numeric');

        if ($this->form_validation->run() == FALSE) {
            // insert csrf check
            $this->data['csrf'] = $this->_get_csrf_nonce();
            $this->data['user'] = $this->ion_auth->user($id)->row();


            $this->layout->set_title('Deactivate User :: Nwasco Dashboard');
            $this->data['user'] = $this->ion_auth->user()->row();
            $this->data['utilities'] = $this->utilitydao->get();
            $this->data['schemes'] = $this->schemedao->get();
            $this->data['indicators'] = $this->indicatordao->get();
            $this->data['request_summary'] = Request_model::getRequestsSummary();

            // render
            $this->_render_page('header', $this->data);
            $this->_render_page('user_nav', $this->data);
            $this->_render_page('auth/deactivate_user', $this->data);;
            $this->_render_page('user_foot', $this->data);
            $this->_render_page('footer_main', $this->data);
        } else {
            // do we really want to deactivate?
            if ($this->input->post('confirm') == 'yes') {
                // do we have a valid request?
                if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id')) {
                    show_error($this->lang->line('error_csrf'));
                }

                // do we have the right userlevel?
                if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) {
                    $this->ion_auth->deactivate($id);
                }
            }

            // redirect them back to the auth page
            redirect('auth', 'refresh');
        }
    }

    // create a new user
    function create_user() {
        $this->data['title'] = $this->lang->line('create_user_heading');

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            redirect('auth', 'refresh');
        }

        $tables = $this->config->item('tables', 'ion_auth');
        $identity_column = $this->config->item('identity', 'ion_auth');
        $this->data['identity_column'] = $identity_column;

        // validate form input
        $this->form_validation->set_rules('first_name', $this->lang->line('create_user_validation_fname_label'), 'required');
        $this->form_validation->set_rules('last_name', $this->lang->line('create_user_validation_lname_label'), 'required');
        if ($identity_column !== 'email') {
            $this->form_validation->set_rules('identity', $this->lang->line('create_user_validation_identity_label'), 'required|is_unique[' . $tables['users'] . '.' . $identity_column . ']');
            $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email');
        } else {
            $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique[' . $tables['users'] . '.email]');
        }
        $this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'trim');
        $this->form_validation->set_rules('company', $this->lang->line('create_user_validation_company_label'), 'trim');
        $this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
        $this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required');

        if ($this->form_validation->run() == true) {
            $email = strtolower($this->input->post('email'));
            $identity = ($identity_column === 'email') ? $email : $this->input->post('identity');
            $password = $this->input->post('password');

            $additional_data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'company' => $this->input->post('company'),
                'phone' => $this->input->post('phone'),
            );
        }
        if ($this->form_validation->run() == true && $this->ion_auth->register($identity, $password, $email, $additional_data)) {
            // check to see if we are creating the user
            // redirect them back to the admin page
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect("auth", 'refresh');
        } else {
            // display the create user form
            // set the flash data error message if there is one
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

            $this->data['first_name'] = array(
                'name' => 'first_name',
                'id' => 'first_name',
                'type' => 'text',
                'class' => 'form-control',
                'placeholder' => 'First Name',
                'value' => $this->form_validation->set_value('first_name'),
            );
            $this->data['last_name'] = array(
                'name' => 'last_name',
                'id' => 'last_name',
                'type' => 'text',
                'class' => 'form-control',
                'placeholder' => 'Last Name',
                'value' => $this->form_validation->set_value('last_name'),
            );
            $this->data['identity'] = array(
                'name' => 'identity',
                'id' => 'identity',
                'type' => 'text',
                'value' => $this->form_validation->set_value('identity'),
            );
            $this->data['email'] = array(
                'name' => 'email',
                'id' => 'email',
                'type' => 'text',
                'class' => 'form-control',
                'placeholder' => 'Email Address',
                'value' => $this->form_validation->set_value('email'),
            );
            $this->data['company'] = array(
                'name' => 'company',
                'id' => 'company',
                'type' => 'text',
                'class' => 'form-control',
                'placeholder' => 'Company',
                'value' => $this->form_validation->set_value('company'),
            );
            $this->data['phone'] = array(
                'name' => 'phone',
                'id' => 'phone',
                'type' => 'text',
                'class' => 'form-control',
                'placeholder' => 'Phone Number',
                'value' => $this->form_validation->set_value('phone'),
            );
            $this->data['password'] = array(
                'name' => 'password',
                'id' => 'password',
                'type' => 'password',
                'class' => 'form-control',
                'placeholder' => 'Password',
                'value' => $this->form_validation->set_value('password'),
            );
            $this->data['password_confirm'] = array(
                'name' => 'password_confirm',
                'id' => 'password_confirm',
                'type' => 'password',
                'class' => 'form-control',
                'placeholder' => 'Confirm Password',
                'value' => $this->form_validation->set_value('password_confirm'),
            );

            $this->layout->set_title('Create User :: Nwasco Dashboard');
            $this->data['user'] = $this->ion_auth->user()->row();
            $this->data['utilities'] = $this->utilitydao->get();
            $this->data['schemes'] = $this->schemedao->get();
            $this->data['indicators'] = $this->indicatordao->get();
            $this->data['request_summary'] = Request_model::getRequestsSummary();

            $this->_render_page('header', $this->data);
            $this->_render_page('user_nav', $this->data);
            $this->_render_page('auth/create_user', $this->data);
            $this->_render_page('user_foot', $this->data);
            $this->_render_page('footer_main', $this->data);
        }
    }

    // edit a user
    function edit_user($id) {
        $this->data['title'] = $this->lang->line('edit_user_heading');

        if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_admin() && !($this->ion_auth->user()->row()->id == $id))) {
            redirect('auth', 'refresh');
        }

        $user = $this->ion_auth->user($id)->row();
        $groups = $this->ion_auth->groups()->result_array();
        $currentGroups = $this->ion_auth->get_users_groups($id)->result();

        // validate form input
        $this->form_validation->set_rules('first_name', $this->lang->line('edit_user_validation_fname_label'), 'required');
        $this->form_validation->set_rules('last_name', $this->lang->line('edit_user_validation_lname_label'), 'required');
        $this->form_validation->set_rules('phone', $this->lang->line('edit_user_validation_phone_label'), 'required');

        if (isset($_POST) && !empty($_POST)) {
            // do we have a valid request?
            if ($this->_valid_csrf_nonce() === FALSE) {
                show_error($this->lang->line('error_csrf'));
            }

            // update the password if it was posted
            if ($this->input->post('password')) {
                $this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
                $this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');
            }

            if ($this->form_validation->run() === TRUE) {
                $data = array(
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    'phone' => $this->input->post('phone'),
                );

                // update the password if it was posted
                if ($this->input->post('password')) {
                    $data['password'] = $this->input->post('password');
                }


                // Only allow updating groups if user is admin
                if ($this->ion_auth->is_admin()) {
                    //Update the groups user belongs to
                    $groupData = $this->input->post('groups');

                    if (isset($groupData) && !empty($groupData)) {

                        $this->ion_auth->remove_from_group('', $id);

                        foreach ($groupData as $grp) {
                            $this->ion_auth->add_to_group($grp, $id);
                        }

                    }
                }

                // check to see if we are updating the user
                if ($this->ion_auth->update($user->id, $data)) {
                    // redirect them back to the admin page if admin, or to the base url if non admin
                    $this->session->set_flashdata('message', $this->ion_auth->messages());
                    if ($this->ion_auth->is_admin()) {
                        redirect('auth', 'refresh');
                    } else {
                        redirect('/', 'refresh');
                    }

                } else {
                    // redirect them back to the admin page if admin, or to the base url if non admin
                    $this->session->set_flashdata('message', $this->ion_auth->errors());
                    if ($this->ion_auth->is_admin()) {
                        redirect('auth', 'refresh');
                    } else {
                        redirect('/', 'refresh');
                    }

                }

            }
        }

        // display the edit user form
        $this->data['csrf'] = $this->_get_csrf_nonce();

        // set the flash data error message if there is one
        $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

        // pass the user to the view
        $this->data['user'] = $user;
        $this->data['groups'] = $groups;
        $this->data['currentGroups'] = $currentGroups;

        $this->data['first_name'] = array(
            'name' => 'first_name',
            'id' => 'first_name',
            'type' => 'text',
            'class' => 'form-control',
            'placeholder' => 'First Name',
            'value' => $this->form_validation->set_value('first_name', $user->first_name),
        );
        $this->data['last_name'] = array(
            'name' => 'last_name',
            'id' => 'last_name',
            'type' => 'text',
            'class' => 'form-control',
            'placeholder' => 'Last Name',
            'value' => $this->form_validation->set_value('last_name', $user->last_name),
        );
        $this->data['phone'] = array(
            'name' => 'phone',
            'id' => 'phone',
            'type' => 'text',
            'class' => 'form-control',
            'placeholder' => 'Phone Number',
            'value' => $this->form_validation->set_value('phone', $user->phone),
        );
        $this->data['password'] = array(
            'name' => 'password',
            'id' => 'password',
            'type' => 'password',
            'class' => 'form-control',
            'placeholder' => 'Password',
        );
        $this->data['password_confirm'] = array(
            'name' => 'password_confirm',
            'id' => 'password_confirm',
            'type' => 'password',
            'class' => 'form-control',
            'placeholder' => 'Confirm Password',
        );


        $this->layout->set_title('View Users :: Nwasco Dashboard');
        $this->data['user'] = $this->ion_auth->user()->row();
        $this->data['utilities'] = $this->utilitydao->get();
        $this->data['schemes'] = $this->schemedao->get();
        $this->data['indicators'] = $this->indicatordao->get();
        $this->data['request_summary'] = Request_model::getRequestsSummary();

        $this->_render_page('header', $this->data);
        $this->_render_page('user_nav', $this->data);
        $this->_render_page('auth/edit_user', $this->data);
        $this->_render_page('user_foot', $this->data);
        $this->_render_page('footer_main', $this->data);
    }

    // create a new group
    function create_group() {
        $this->data['title'] = $this->lang->line('create_group_title');

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            redirect('auth', 'refresh');
        }

        // validate form input
        $this->form_validation->set_rules('group_name', $this->lang->line('create_group_validation_name_label'), 'required|alpha_dash');

        if ($this->form_validation->run() == TRUE) {
            $new_group_id = $this->ion_auth->create_group($this->input->post('group_name'), $this->input->post('description'));
            if ($new_group_id) {
                // check to see if we are creating the group
                // redirect them back to the admin page
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect("auth/view_groups", 'refresh');
            }
        } else {
            // display the create group form
            // set the flash data error message if there is one
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

            $this->data['group_name'] = array(
                'name' => 'group_name',
                'id' => 'group_name',
                'type' => 'text',
                'value' => $this->form_validation->set_value('group_name'),
            );
            $this->data['description'] = array(
                'name' => 'description',
                'id' => 'description',
                'type' => 'text',
                'value' => $this->form_validation->set_value('description'),
            );

            $this->layout->set_title('View Users :: Nwasco Dashboard');
            $this->data['user'] = $this->ion_auth->user()->row();
            $this->data['utilities'] = $this->utilitydao->get();
            $this->data['schemes'] = $this->schemedao->get();
            $this->data['indicators'] = $this->indicatordao->get();
            $this->data['request_summary'] = Request_model::getRequestsSummary();

            // render
            $this->_render_page('header', $this->data);
            $this->_render_page('user_nav', $this->data);
            $this->_render_page('auth/create_group', $this->data);
            $this->_render_page('user_foot', $this->data);
            $this->_render_page('footer_main', $this->data);
        }
    }

    function view_groups() {
        if (!$this->ion_auth->logged_in()) {

            // redirect them to the login page
            redirect('auth/login', 'refresh');
        } elseif (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
        {
            // redirect them to the home page because they must be an administrator to view this
            return show_error('You must be an administrator to view this page.');
        } else {
            // set the flash data error message if there is one
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

            //list the roles
            $this->data['roles'] = $this->ion_auth->groups()->result();

            $this->layout->set_title('View Users :: Nwasco Dashboard');
            $this->data['user'] = $this->ion_auth->user()->row();
            $this->data['utilities'] = $this->utilitydao->get();
            $this->data['schemes'] = $this->schemedao->get();
            $this->data['indicators'] = $this->indicatordao->get();
            $this->data['request_summary'] = Request_model::getRequestsSummary();

            $this->_render_page('header', $this->data);
            $this->_render_page('user_nav', $this->data);
            $this->_render_page('auth/view_groups', $this->data);
            $this->_render_page('user_foot', $this->data);
            $this->_render_page('footer_main', $this->data);
        }
    }

    // edit a group
    function edit_group($id) {
        // bail if no group id given
        if (!$id || empty($id)) {
            redirect('auth', 'refresh');
        }

        $this->data['title'] = $this->lang->line('edit_group_title');

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            redirect('auth', 'refresh');
        }

        $group = $this->ion_auth->group($id)->row();

        // validate form input
        $this->form_validation->set_rules('group_name', $this->lang->line('edit_group_validation_name_label'), 'required|alpha_dash');

        if (isset($_POST) && !empty($_POST)) {
            if ($this->form_validation->run() === TRUE) {
                $group_update = $this->ion_auth->update_group($id, $_POST['group_name'], $_POST['group_description']);

                if ($group_update) {
                    $this->session->set_flashdata('message', $this->lang->line('edit_group_saved'));
                } else {
                    $this->session->set_flashdata('message', $this->ion_auth->errors());
                }
                redirect("auth/view_groups", 'refresh');
            }
        }

        // set the flash data error message if there is one
        $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

        // pass the user to the view
        $this->data['group'] = $group;

        $readonly = $this->config->item('admin_group', 'ion_auth') === $group->name ? 'readonly' : '';

        $this->data['group_name'] = array(
            'name' => 'group_name',
            'id' => 'group_name',
            'type' => 'text',
            'value' => $this->form_validation->set_value('group_name', $group->name),
            $readonly => $readonly,
        );
        $this->data['group_description'] = array(
            'name' => 'group_description',
            'id' => 'group_description',
            'type' => 'text',
            'value' => $this->form_validation->set_value('group_description', $group->description),
        );

        $this->layout->set_title('Edit Group :: Nwasco Dashboard');
        $this->data['user'] = $this->ion_auth->user()->row();
        $this->data['utilities'] = $this->utilitydao->get();
        $this->data['schemes'] = $this->schemedao->get();
        $this->data['indicators'] = $this->indicatordao->get();
        $this->data['request_summary'] = Request_model::getRequestsSummary();

        // render
        $this->_render_page('header', $this->data);
        $this->_render_page('user_nav', $this->data);
        $this->_render_page('auth/edit_group', $this->data);
        $this->_render_page('user_foot', $this->data);
        $this->_render_page('footer_main', $this->data);
    }


    function _get_csrf_nonce() {
        $this->load->helper('string');
        $key = random_string('alnum', 8);
        $value = random_string('alnum', 20);
        $this->session->set_flashdata('csrfkey', $key);
        $this->session->set_flashdata('csrfvalue', $value);

        return array($key => $value);
    }

    function _valid_csrf_nonce() {
        return TRUE;
    }

    function _render_page($view, $data = null, $returnhtml = false)//I think this makes more sense
    {

        $this->viewdata = (empty($data)) ? $this->data : $data;

        $view_html = $this->load->view($view, $this->viewdata, $returnhtml);

        if ($returnhtml) return $view_html;//This will return html on 3rd argument being true
    }

}
