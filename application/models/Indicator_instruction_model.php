<?php
require_once APPPATH.'models/daos/Indicator_instruction_dao.php';
require_once APPPATH.'models/daos/Indicator_property_dao.php';

class Indicator_instruction_model extends CI_Model {
    private $id;
    private $value;
    private $union_token;
    private $deleted_at;
    private $indicator_property;
    private $indicator;
    private $utility;
    private $scheme;

    public function __construct($id=NULL, $value=NULL, $union_token=NULL, $indicator_property=NULL,
                                $indicator=NULL, $utility=NULL, $scheme=NULL, $deleted_at=NULL) {
        parent::__construct();
        $this->id = $id;
        $this->value = $value;
        $this->union_token = $union_token;
        $this->indicator_property = $indicator_property;
        $this->indicator = $indicator;
        $this->utility = $utility;
        $this->scheme = $scheme;
        $this->deleted_at = $deleted_at;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getValue() {
        return $this->value;
    }

    public function setValue($value) {
        $this->value = $value;
    }

    public function getUnionToken() {
        return $this->union_token;
    }

    public function setUnionToken($union_token) {
        $this->union_token = $union_token;
    }

    public function getDeletedAt() {
        return $this->deleted_at;
    }

    public function setDeletedAt($deleted_at) {
        $this->deleted_at = $deleted_at;
    }

    public function getIndicatorProperty() {
        return $this->indicator_property;
    }

    public function setIndicatorProperty($indicator_property) {
        $this->indicator_property = $indicator_property;
    }

    public function getIndicator() {
        return $this->indicator;
    }

    public function setIndicator($indicator) {
        $this->indicator = $indicator;
    }

    public function getUtility() {
        return $this->utility;
    }

    public function setUtility($utility) {
        $this->utility = $utility;
    }

    public function isUtility() {
        return ($this->utility == NULL) ? FALSE : TRUE;
    }

    public function getScheme() {
        return $this->scheme;
    }

    public function setScheme($scheme) {
        $this->scheme = $scheme;
    }

    public function isScheme() {
        return ($this->scheme == NULL) ? FALSE : TRUE;
    }

    public function getUtilityInstructionsFromPostData($indicators, $utility, $indicator, $union_token=NULL) {
        $instruction_objects = array();
        $indicator_property_dao = new Indicator_property_dao();
        $union_token = ($union_token==NULL) ? self::generateUniqueToken() : $union_token;

        foreach ($indicators as $property_token => $instruction_value) {
            $indicator_property = $indicator_property_dao->get(array(
                Indicator_property_dao::TOKEN_FIELD => $property_token
            ))[0];

            $instruction = new Indicator_instruction_model(
                NULL, $instruction_value, $union_token, $indicator_property, $indicator, $utility, NULL, NULL);
            array_push($instruction_objects, $instruction);
        }

        return $instruction_objects;
    }

    public function getSchemeInstructionsFromPostData($indicators, $scheme, $indicator, $union_token=NULL) {
        $instruction_objects = array();
        $indicator_property_dao = new Indicator_property_dao();
        $union_token = ($union_token==NULL) ? self::generateUniqueToken() : $union_token;

        foreach ($indicators as $property_token => $instruction_value) {
            $indicator_property = $indicator_property_dao->get(array(
                Indicator_property_dao::TOKEN_FIELD => $property_token
            ))[0];

            $instruction = new Indicator_instruction_model(
                NULL, $instruction_value, $union_token, $indicator_property, $indicator, NULL, $scheme, NULL);
            array_push($instruction_objects, $instruction);
        }

        return $instruction_objects;
    }

    public function updateExistingInstructions($existing_instructions, $new_instructions){
        $updated_instructions = array();
        foreach ($existing_instructions as $existing_instruction) {
            foreach ($new_instructions as $new_instruction) {
                $existing_instruction_property_id = $existing_instruction->getIndicatorProperty()->getId();
                $new_instruction_property_id = $new_instruction->getIndicatorProperty()->getId();
                if ($existing_instruction_property_id == $new_instruction_property_id) {
                    $existing_instruction->setValue($new_instruction->getValue());
                    array_push($updated_instructions, $existing_instruction);
                }
            }
        }
        return $updated_instructions;
    }

    public function getStatus($instructions) {
        foreach ($instructions as $instruction) {
            if($instruction->getIndicatorProperty()->getDatatype() == 'DATE') {
                $due_date = strtotime($instruction->getValue());
                if($due_date == NULL)
                    return 'MISSING';

                $days_to_expire = $instruction->getIndicator()->getDaysToExpire();

                $now = time();
                $date_difference = $due_date - $now;
                $days_difference = floor($date_difference/(60 * 60 * 24));

                if ($days_difference < 0 || $days_difference == 0)
                    return 'OVERDUE';

                if(($days_difference > $days_to_expire) && ($days_difference != $days_to_expire))
                    return 'ACTIVE';

                if (1<$days_difference && $days_difference<$days_to_expire)
                    return 'ALMOST';
            }
        }
    }

    public function getUtilityInstructionsStatusSummary($utility, $indicator){
        $instruction_groups = Utility_model::getIndicatorInstructions($utility);

        $active_count = 0;
        $almost_count = 0;
        $overdue_count = 0;

        foreach ($instruction_groups[$indicator->getName()] as $instructions) {
            switch ($this->getStatus($instructions)) {
                case 'ACTIVE':
                    $active_count += 1;
                    break;
                case 'ALMOST':
                    $almost_count += 1;
                    break;
                case 'OVERDUE':
                    $overdue_count += 1;
                    break;
            }
        }

        $summary['ACTIVE'] = $active_count;
        $summary['ALMOST'] = $almost_count;
        $summary['OVERDUE'] = $overdue_count;

        return $summary;
    }

    public function getSchemeInstructionsStatusSummary($scheme, $indicator){
        $instruction_groups = Scheme_model::getIndicatorInstructions($scheme);

        $active_count = 0;
        $almost_count = 0;
        $overdue_count = 0;

        foreach ($instruction_groups[$indicator->getName()] as $instructions) {
            switch ($this->getStatus($instructions)) {
                case 'ACTIVE':
                    $active_count += 1;
                    break;
                case 'ALMOST':
                    $almost_count += 1;
                    break;
                case 'OVERDUE':
                    $overdue_count += 1;
                    break;
            }
        }

        $summary['ACTIVE'] = $active_count;
        $summary['ALMOST'] = $almost_count;
        $summary['OVERDUE'] = $overdue_count;

        return $summary;
    }

    public static function generateUniqueToken() {
        while(TRUE) {
            $token = random_string('alnum', 10);
            if(Indicator_instruction_model::isTokenUnique($token)) {
                return $token;
            }
        }
    }

    private static function isTokenUnique($generated_token) {
        $indicator_instruction_dao = new Indicator_instruction_dao();
        $where_field = array(Indicator_instruction_dao::UNION_TOKEN_FIELD => $generated_token);
        $indicator_property = $indicator_instruction_dao->get($where_field);
        return (sizeof($indicator_property) > 0) ? FALSE : TRUE;
    }
}