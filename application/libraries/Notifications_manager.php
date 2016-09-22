<?php

class Notifications_manager {

    public function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->library('email_manager');
        $this->CI->load->library('ion_auth');
    }

    public function getNotification($user) {
        $notifications = array();
        $notifications = array_merge($notifications, $this->pendingRequest($user));
        $notifications = array_merge($notifications, $this->utilityInstructions($user));
        $notifications = array_merge($notifications, $this->schemeInstructions($user));
        return $notifications;
    }

    private function pendingRequest($user) {
        $notifications = array();
        $admin_requests = ($this->CI->ion_auth->is_admin($user->id)) ? $this->CI->email_manager->getRequests($user, 'PENDING') : array();
        $requests = ($this->CI->ion_auth->is_admin($user->id)) ? array() : $this->CI->email_manager->getRequests($user, 'ACCEPTED');

        $number_of_admin_requests = count($admin_requests);
        if($number_of_admin_requests > 0)
            array_push($notifications, $number_of_admin_requests.' pending administrator level request(s).');

        $number_of_requests = count($requests);
        if($number_of_requests > 0)
            array_push($notifications, $number_of_requests.' approved request(s).');

        return $notifications;
    }

    private function  utilityInstructions($user) {
        $notifications = array();
        $utility_instructions = $this->CI->email_manager->getSummaryUtilityInstructions($user);

        $overdue_count = 0;
        $almost_count = 0;
        if (count($utility_instructions) > 0) {
            foreach ($utility_instructions as $utility_name => $indicators) {
                foreach ($indicators as $indicator_name => $summary) {
                    $overdue_count += $summary[0]['OVERDUE'];
                    $almost_count += $summary[0]['ALMOST'];
                }
            }
        }

        if($overdue_count > 0)
            array_push($notifications, $overdue_count.' overdue Commercial Utility instruction(s).');

        if($almost_count > 0)
            array_push($notifications, $almost_count.' almost due Commercial Utility instruction(s).');

        return $notifications;
    }

    private function  schemeInstructions($user) {
        $notifications = array();
        $scheme_instructions = $this->CI->email_manager->getSummarySchemeInstructions($user);

        $overdue_count = 0;
        $almost_count = 0;
        if (count($scheme_instructions) > 0) {
            foreach ($scheme_instructions as $scheme_name => $indicators) {
                foreach ($indicators as $indicator_name => $summary) {
                    $overdue_count += $summary[0]['OVERDUE'];
                    $almost_count += $summary[0]['ALMOST'];
                }
            }
        }

        if($overdue_count > 0)
            array_push($notifications, $overdue_count.' overdue Private Scheme instruction(s).');

        if($almost_count > 0)
            array_push($notifications, $almost_count.' almost due Private Scheme instruction(s).');

        return $notifications;
    }

}