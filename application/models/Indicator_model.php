<?php
require_once APPPATH.'models/daos/Indicator_property_dao.php';

class Indicator_model extends CI_Model {
    private $id;
    private $name;
    private $description;

    public function __construct($id=NULL, $name=NULL, $description=NULL) {
        parent::__construct();
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getIndicatorProperties($obj) {
        $indicator_property_dao = new Indicator_property_dao();
        return $indicator_property_dao->getByIndicator($obj);
    }
}