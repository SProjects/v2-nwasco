<?php

class Scheme_model extends CI_Model {
    private $id;
    private $name;
    private $inspector;

    public function __construct($id=NULL, $name=NULL, $inspector=NULL) {
        parent::__construct();
        $this->id = $id;
        $this->name = $name;
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

    public function getInspector() {
        return $this->inspector;
    }

    public function getInspectorName() {
        $inspector = $this->inspector;
        return $inspector != NULL ? $inspector->last_name .' '. $inspector->first_name : NULL;
    }

    public function getInspectorId() {
        $inspector = $this->inspector;
        return $inspector != NULL ? $inspector->id : NULL;
    }

    public function setInspector($inspector) {
        $this->inspector = $inspector;
    }
}