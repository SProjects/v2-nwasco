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

    public function getInspectorName() {
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

    public static function getIndicatorInstructions($utility) {
        $indicatordao = new Indicator_dao();
        $indicatorinstructiondao = new Indicator_instruction_dao();

        $instructions = NULL;
        $indicator_properties = NULL;
        $indicators = $indicatordao->get(array(Indicator_dao::KIND_FIELD => Indicator_model::getUtilityKind()));

        if(sizeof($indicators) == 0)
            return array();

        foreach ($indicators as $indicator) {
            $instructions[$indicator->getName()] = array();
        }

        foreach($indicators as $indicator) {
            $instruction_objects = $indicatorinstructiondao->get(array(
                    Indicator_instruction_dao::INDICATOR_FIELD => $indicator->getId(),
                    Indicator_instruction_dao::UTILITY_FIELD => $utility->getId(),
                    Indicator_instruction_dao::DELETED_AT_FIELD => NULL
                )
            );

            if(count($instruction_objects) > 0) {
                foreach ($instruction_objects as $instruction_object) {
                    $instructions[$indicator->getName()][$instruction_object->getUnionToken()] = array();
                }

                foreach ($instruction_objects as $instruction_object) {
                    array_push(
                        $instructions[$indicator->getName()][$instruction_object->getUnionToken()],
                        $instruction_object
                    );
                }
            }
        }

        return $instructions;
    }
}