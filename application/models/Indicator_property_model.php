<?php

class Indicator_property_model extends CI_Model {
    private $id;
    private $name;
    private $description;
    private $datatype;
    private $indicator;

    public function __construct($id=NULL, $name=NULL, $description=NULL, $datatype=NULL, $indicator=NULL) {
        parent::__construct();
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->datatype = $datatype;
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

    public static function getAllDataTypes() {
        return array(
            "TEXT" => "TEXT",
            "LONG_TEXT" => "LONG TEXT",
            "INT" => "INTEGER",
            "DATE" => "DATE"
        );
    }
}