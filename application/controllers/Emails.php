<?php

class Emails extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->library('email_manager');
    }

    public function sendEmail() {
        $this->email->initialize(array(
            'protocol' => 'smtp',
            'smtp_host' => 'tls://smtp.gmail.com',
            'smtp_user' => getenv('SMTP_USERNAME'),
            'smtp_pass' => getenv('SMTP_PASSWORD'),
            'smtp_port' => 465,
            'crlf' => "\r\n",
            'newline' => "\r\n"
        ));

        $this->email->set_header('MIME-Version', '1.0; charset=utf-8');
        $this->email->set_header('Content-type', 'text/html');

        $this->email->from('info@nwasco.org', 'National Water Supply and Sanitation Council');

        $users = $this->ion_auth->users()->result();

        foreach ($users as $user) {
            $admin_requests = ($this->ion_auth->is_admin($user->id)) ? $this->email_manager->getRequests($user, 'PENDING') : array();
            $requests = ($this->ion_auth->is_admin($user->id)) ? array() : $this->email_manager->getRequests($user, 'ACCEPTED');

            $utility_instructions = $this->email_manager->getSummaryUtilityInstructions($user);
            $scheme_instructions = $this->email_manager->getSummarySchemeInstructions($user);

            if (sizeof($requests) > 0 || $utility_instructions != NULL || $scheme_instructions != NULL) {
                $data['recipient'] = $user;
                $data['admin_requests'] = $admin_requests;
                $data['requests'] = $requests;
                $data['utility_instructions'] = $utility_instructions;
                $data['scheme_instructions'] = $scheme_instructions;

                $recipient_email = $user->email;
                if ($recipient_email != NULL && valid_email($recipient_email)) {
                    $this->email->to($recipient_email);
                    $this->email->subject('Alert - National Water Supply and Sanitation Council (no-reply)');

                    $body = $this->load->view('emails/alert.php', $data, TRUE);
                    $this->email->message($body);

                    $this->email->send();
                }
            }
        }
    }
}