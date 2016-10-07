<?php
require_once APPPATH.'models/daos/Request_dao.php';
require_once APPPATH.'models/daos/Utility_dao.php';
require_once APPPATH.'models/daos/Scheme_dao.php';
require_once APPPATH.'models/daos/Indicator_dao.php';
require_once APPPATH.'models/daos/Indicator_instruction_dao.php';
require_once APPPATH.'models/Indicator_model.php';
require_once APPPATH.'models/Indicator_instruction_model.php';

class Email_manager {

    public function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->library('ion_auth');
    }

    public function getRequests($user, $kind) {
        $request_dao = new Request_dao();

        if($this->CI->ion_auth->is_admin($user->id)) {
            return $request_dao->get(array(
                Request_dao::STATUS_FIELD => $kind,
                Request_dao::DELETED_AT_FIELD => NULL
            ));
        }

        return $request_dao->get(array(
            Request_dao::USER_FIELD => $user->id,
            Request_dao::STATUS_FIELD => $kind,
            Request_dao::DELETED_AT_FIELD => NULL
        ));
    }

    public function getSummaryUtilityInstructions($user) {
        $utility_dao = new Utility_dao();
        $indicator_dao = new Indicator_dao();
        $indicator_instruction = new Indicator_instruction_model();
        $utilities = $utility_dao->get(array(Utility_dao::INSPECTOR_FIELD => $user->id));

        $instructions_summary = array();
        foreach ($utilities as $utility) {
            $indicators = $indicator_dao->get(array(Indicator_dao::KIND_FIELD => Indicator_model::getUtilityKind()));
            foreach ($indicators as $indicator) {
                $summary = $indicator_instruction->getUtilityInstructionsStatusSummary($utility, $indicator);

                if($summary['OVERDUE'] != 0 || $summary['ALMOST'] != 0) {
                    $instructions_summary[$utility->getName()][$indicator->getName()] = array();
                    array_push($instructions_summary[$utility->getName()][$indicator->getName()], array(
                        'OVERDUE' => $summary['OVERDUE'],
                        'ALMOST' => $summary['ALMOST']
                    ));
                }
            }
        }
        return $instructions_summary;
    }

    public function getSummarySchemeInstructions($user) {
        $scheme_dao = new Scheme_dao();
        $indicator_dao = new Indicator_dao();
        $indicator_instruction = new Indicator_instruction_model();
        $schemes = $scheme_dao->get(array(Scheme_dao::INSPECTOR_FIELD => $user->id));

        $instructions_summary = array();
        foreach ($schemes as $scheme) {
            $indicators = $indicator_dao->get(array(Indicator_dao::KIND_FIELD => Indicator_model::getSchemeKind()));
            foreach ($indicators as $indicator) {
                $summary = $indicator_instruction->getSchemeInstructionsStatusSummary($scheme, $indicator);

                if($summary['OVERDUE'] != 0 || $summary['ALMOST'] != 0) {
                    $instructions_summary[$scheme->getName()][$indicator->getName()] = array();
                    array_push($instructions_summary[$scheme->getName()][$indicator->getName()],  array(
                        'OVERDUE' => $summary['OVERDUE'],
                        'ALMOST' => $summary['ALMOST']
                    ));
                }
            }
        }
        return $instructions_summary;
    }

    public function shouldCreateEmail($instructions) {
        return $this->hasData($instructions);
    }

    public function hasData($instructions) {
        foreach ($instructions as $facility_name => $indicators) {
            foreach ($indicators as $indicator_name => $summary) {
                if(count($summary) > 0){
                    if($summary[0]['OVERDUE'] > 0 || $summary[0]['ALMOST'] > 0)
                        return TRUE;
                }
            }
        }
        return FALSE;
    }
}