<?php
require_once APPPATH.'models/daos/Indicator_summary_dao.php';
require_once APPPATH.'models/daos/Indicator_dao.php';
require_once APPPATH.'models/daos/Utility_dao.php';
require_once APPPATH.'models/Indicator_instruction_model.php';

class Indicator_summary_model extends CI_Model {
    private $id;
    private $overdue;
    private $almost;
    private $active;
    private $indicator;
    private $utility;

    public function __construct($id=NULL, $overdue=NULL, $almost=NULL, $active=NULL,
                                $indicator=NULL, $utility=NULL) {
        parent::__construct();
        $this->id = $id;
        $this->overdue = $overdue;
        $this->almost = $almost;
        $this->active = $active;
        $this->indicator = $indicator;
        $this->utility = $utility;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getOverdue() {
        return $this->overdue;
    }

    public function setOverdue($overdue) {
        $this->overdue = $overdue;
    }

    public function getAlmost() {
        return $this->almost;
    }

    public function setAlmost($almost) {
        $this->almost = $almost;
    }

    public function getActive() {
        return $this->active;
    }

    public function setActive($active) {
        $this->active = $active;
    }

    public function getIndicator() {
        return $this->indicator;
    }

    public function getIndicatorId() {
        return $this->indicator != NULL ? $this->indicator->getId() : NULL;
    }

    public function setIndicator($indicator) {
        $this->indicator = $indicator;
    }

    public function getUtility() {
        return $this->utility;
    }

    public function getUtilityId() {
        return $this->utility != NULL ? $this->utility->getId() : NULL;
    }

    public function setUtility($utility) {
        $this->utility = $utility;
    }

    public static function getUtilitySummary($utility) {
        $indicator_summary_dao = new Indicator_summary_dao();
        $summaries = $indicator_summary_dao->get(array(
            Indicator_summary_dao::UTILITY_FIELD => $utility->getId()
        ));

        return Indicator_summary_model::classifyByStatus($summaries);
    }

    public static function getSummaryByStatus($utility, $status) {
        $indicator_summary_dao = new Indicator_summary_dao();
        $indicator_dao = new Indicator_dao();
        $utility_indicators = $indicator_dao->get(array(
            Indicator_dao::KIND_FIELD => Indicator_model::getUtilityKind()
        ));

        switch ($status) {
            case 'OVERDUE':
                $overdue_summary = array();
                foreach ($utility_indicators as $utility_indicator) {
                    $summary = $indicator_summary_dao->get(array(
                        Indicator_summary_dao::UTILITY_FIELD => $utility->getId(),
                        Indicator_summary_dao::INDICATOR_FIELD => $utility_indicator->getId()
                    ));

                    if (sizeof($summary) > 0) {
                        $summary = $summary[0];
                        $overdue_summary[$utility_indicator->getName()] = $summary->getOverdue();
                    }
                }
                return $overdue_summary;
                break;
            case 'ALMOST':
                $almost_summary = array();
                foreach ($utility_indicators as $utility_indicator) {
                    $summary = $indicator_summary_dao->get(array(
                        Indicator_summary_dao::UTILITY_FIELD => $utility->getId(),
                        Indicator_summary_dao::INDICATOR_FIELD => $utility_indicator->getId()
                    ));

                    if (sizeof($summary) > 0) {
                        $summary = $summary[0];
                        $almost_summary[$utility_indicator->getName()] = $summary->getAlmost();
                    }
                }
                return $almost_summary;
                break;
            case 'ACTIVE':
                $active_summary = array();
                foreach ($utility_indicators as $utility_indicator) {
                    $summary = $indicator_summary_dao->get(array(
                        Indicator_summary_dao::UTILITY_FIELD => $utility->getId(),
                        Indicator_summary_dao::INDICATOR_FIELD => $utility_indicator->getId()
                    ));

                    if (sizeof($summary) > 0) {
                        $summary = $summary[0];
                        $active_summary[$utility_indicator->getName()] = $summary->getActive();
                    }
                }
                return $active_summary;
                break;
        }
    }

    public static function getIndicatorSummary($indicator, $utility) {
        $indicator_summary_dao = new Indicator_summary_dao();
        $summaries = $indicator_summary_dao->get(array(
            Indicator_summary_dao::INDICATOR_FIELD => $indicator->getId(),
            Indicator_summary_dao::UTILITY_FIELD => $utility->getId()
        ));

        return Indicator_summary_model::classifyByStatus($summaries);
    }

    public static function createBlankSummaryData() {
        $indicator_dao = new Indicator_dao();
        $utility_dao = new Utility_dao();
        $indicator_summary_dao = new Indicator_summary_dao();
        $utility_indicators = $indicator_dao->get(array(
            Indicator_dao::KIND_FIELD => Indicator_model::getUtilityKind()
        ));

        $utilities = $utility_dao->get();
        foreach ($utilities as $utility) {
            foreach ($utility_indicators as $utility_indicator) {
                $indicator_summary_object = $indicator_summary_dao->get(array(
                    Indicator_summary_dao::INDICATOR_FIELD => $utility_indicator->getId(),
                    Indicator_summary_dao::UTILITY_FIELD => $utility->getId()
                ));

                if (sizeof($indicator_summary_object) == 0) {
                    $indicator_summary_object = new Indicator_summary_model(NULL, 0, 0, 0,
                        $utility_indicator, $utility);
                    $indicator_summary_dao->post($indicator_summary_object);
                }
            }
        }
    }

    public static function addSummaryData() {
        $indicator_instruction = new Indicator_instruction_model();
        $indicator_dao = new Indicator_dao();
        $utilitydao = new Utility_dao();
        $indicator_summary_dao = new Indicator_summary_dao();
        $utility_indicators = $indicator_dao->get(array(
            Indicator_dao::KIND_FIELD => Indicator_model::getUtilityKind()
        ));

        $utilities = $utilitydao->get();
        $indicator_summaries = array();
        foreach ($utilities as $utility) {
            foreach ($utility_indicators as $utility_indicator) {
                $overdue = $indicator_instruction->getNumberOfUtilityIndicatorInstructionsByStatus(
                    $utility_indicator, $utility, 'OVERDUE');
                $almost = $indicator_instruction->getNumberOfUtilityIndicatorInstructionsByStatus(
                    $utility_indicator, $utility, 'ALMOST');
                $active = $indicator_instruction->getNumberOfUtilityIndicatorInstructionsByStatus(
                    $utility_indicator, $utility, 'ACTIVE');

                $indicator_summary_object = $indicator_summary_dao->get(array(
                    Indicator_summary_dao::INDICATOR_FIELD => $utility_indicator->getId(),
                    Indicator_summary_dao::UTILITY_FIELD => $utility->getId()
                ))[0];
                $indicator_summary_object->setOverdue($overdue);
                $indicator_summary_object->setAlmost($almost);
                $indicator_summary_object->setActive($active);
                array_push($indicator_summaries, $indicator_summary_object);
            }
        }

        foreach ($indicator_summaries as $indicator_summary) {
            $indicator_summary_dao->update($indicator_summary);
        }
    }

    private static function classifyByStatus($summaries) {
        $totals_summary = array();

        $overdue_total = 0;
        foreach ($summaries as $summary) {
            $overdue_total += $summary->getOverdue();
        }
        $totals_summary['OVERDUE'] = $overdue_total;

        $almost_total = 0;
        foreach ($summaries as $summary) {
            $almost_total += $summary->getAlmost();
        }
        $totals_summary['ALMOST'] = $almost_total;

        $active_total = 0;
        foreach ($summaries as $summary) {
            $active_total += $summary->getActive();
        }
        $totals_summary['ACTIVE'] = $active_total;

        return $totals_summary;
    }
}