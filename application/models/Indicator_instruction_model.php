<?php
require_once APPPATH.'models/daos/Indicator_instruction_dao.php';

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