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
    }

    public function getRequests($user, $kind) {
        $request_dao = new Request_dao();
        return $request_dao->get(array(
            Request_dao::USER_FIELD => $user->id,
            Request_dao::STATUS_FIELD => $kind
        ));
    }

    public function getSummaryUtilityInstructions($user) {
        $utility_dao = new Utility_dao();
        $indicator_dao = new Indicator_dao();
        $indicator_instruction = new Indicator_instruction_model();
        $utilities = $utility_dao->get(array(Utility_dao::INSPECTOR_FIELD => $user->id));

        $instructions_summary = NULL;
        foreach ($utilities as $utility) {
            $indicators = $indicator_dao->get(array(Indicator_dao::KIND_FIELD => Indicator_model::getUtilityKind()));
            foreach ($indicators as $indicator) {
                $instructions_summary[$utility->getName()][$indicator->getName()] = array();
                $summary = $indicator_instruction->getUtilityInstructionsStatusSummary($utility, $indicator);
                array_push($instructions_summary[$utility->getName()][$indicator->getName()],  array(
                    'OVERDUE' => $summary['OVERDUE'],
                    'ALMOST' => $summary['ALMOST']
                ));
            }
        }
        return $instructions_summary;
    }

    public function getSummarySchemeInstructions($user) {
        $scheme_dao = new Scheme_dao();
        $indicator_dao = new Indicator_dao();
        $indicator_instruction = new Indicator_instruction_model();
        $schemes = $scheme_dao->get(array(Scheme_dao::INSPECTOR_FIELD => $user->id));

        $instructions_summary = NULL;
        foreach ($schemes as $scheme) {
            $indicators = $indicator_dao->get(array(Indicator_dao::KIND_FIELD => Indicator_model::getSchemeKind()));
            foreach ($indicators as $indicator) {
                $instructions_summary[$scheme->getName()][$indicator->getName()] = array();
                $summary = $indicator_instruction->getSchemeInstructionsStatusSummary($scheme, $indicator);
                array_push($instructions_summary[$scheme->getName()][$indicator->getName()],  array(
                    'OVERDUE' => $summary['OVERDUE'],
                    'ALMOST' => $summary['ALMOST']
                ));
            }
        }
        return $instructions_summary;
    }
}