<?php

class Utility_model extends CI_Model {
    private $id;
    private $name;
    private $abbreviation;
    private $inspector;

    public function __construct($id=NULL, $name=NULL, $abbreviation=NULL, $inspector=NULL) {
        parent::__construct();
        $this->id = $id;
        $this->name = $name;
        $this->abbreviation = $abbreviation;
        $this->inspector = $inspector;
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

    public function getAbbreviation() {
        return $this->abbreviation;
    }

    public function setAbbreviation($abbreviation) {
        $this->abbreviation = $abbreviation;
    }

    public function getInspector() {
        return $this->inspector;
    }

    public function getInspectorString() {
        $inspector = $this->inspector;
        return $inspector != NULL ? $inspector->last_name .' '. $inspector->first_name : NULL;
    }

    public function getInspectorId() {
        $inspector = $this->inspector;
        return $inspector != NULL ? $inspector->id : NULL;
    }

    public function setInspector($inspector=NULL) {
        $this->inspector = $inspector;
    }

}