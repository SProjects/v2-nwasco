<?php
require_once APPPATH.'models/daos/Indicator_property_dao.php';

class Indicator_property_model extends CI_Model {
    private $id;
    private $name;
    private $description;
    private $datatype;
    private $token;
    private $indicator;

    public function __construct($id=NULL, $name=NULL, $description=NULL,
                                $datatype=NULL, $token=NULL, $indicator=NULL) {
        parent::__construct();
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->datatype = $datatype;
        $this->token = $token;
        $this->indicator = $indicator;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getDatatype() {
        return $this->datatype;
    }

    public function setDatatype($datatype) {
        $this->datatype = $datatype;
    }

    public function getIndicator() {
        return $this->indicator;
    }

    public function setIndicator($indicator) {
        $this->indicator = $indicator;
    }

    public function getToken() {
        return $this->token;
    }

    public function setToken($token) {
        $this->token = $token;
    }

    public function hasData($property) {
        $indicator_instruction_dao = new Indicator_instruction_dao();
        $instructions = $indicator_instruction_dao->get(array(
            Indicator_instruction_dao::INDICATOR_PROPERTY_FIELD => $property->getId()
        ));
        return (count($instructions) > 0) ? TRUE : FALSE;
    }

    public static function getAllDataTypes() {
        return array(
            "TEXT" => "TEXT",
            "LONG_TEXT" => "LONG TEXT",
            "INTEGER" => "INTEGER",
            "DATE" => "DATE"
        );
    }

    public static function generateUniqueToken() {
        while(TRUE) {
            $token = random_string('alnum', 10);
            if(Indicator_property_model::isTokenUnique($token)) {
                return $token;
            }
        }
    }

    private static function isTokenUnique($generated_token) {
        $indicator_property_dao = new Indicator_property_dao();
        $where_field = array(Indicator_property_dao::TOKEN_FIELD => $generated_token);
        $indicator_property = $indicator_property_dao->get($where_field);
        return (sizeof($indicator_property) > 0) ? FALSE : TRUE;
    }
}