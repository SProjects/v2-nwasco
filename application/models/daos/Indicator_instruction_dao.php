<?php
require_once APPPATH.'models/Indicator_instruction_model.php';
require_once APPPATH.'models/daos/Indicator_dao.php';
require_once APPPATH.'models/daos/Indicator_property_dao.php';
require_once APPPATH.'models/daos/Utility_dao.php';
require_once APPPATH.'models/daos/Scheme_dao.php';

class Indicator_instruction_dao extends CI_Model {
    const TABLE_NAME = 'indicator_instructions';
    const ID_FIELD = 'id';
    const VALUE_FIELD = 'value';
    const UNION_TOKEN_FIELD = 'union_token';
    const INDICATOR_PROPERTY_FIELD = 'indicator_property_id';
    const INDICATOR_FIELD = 'indicator_id';
    const UTILITY_FIELD = 'utility_id';
    const SCHEME_FIELD = 'scheme_id';
    const DELETED_AT_FIELD = 'deleted_at';

    public function __construct() {
        parent::__construct();
    }

    public function get($where_fields) {
        $this->db->select('*');
        $this->db->from(self::TABLE_NAME);
        $this->db->where($where_fields);
        $query = $this->db->get();
        return $this->fromArray($query->result_array());
    }

    public function post($indicator_instruction) {
        $data = $this->fromObject($indicator_instruction);
        return $this->db->insert(self::TABLE_NAME, $data);
    }

    public function update($indicator_instruction) {
        $data = $this->fromObject($indicator_instruction);

        $this->db->where(array(self::ID_FIELD => $indicator_instruction->getId()));
        return $this->db->update(self::TABLE_NAME, $data);
    }

    public function delete($id) {
        //TODO: Create a transaction to delete the Scheme object and attached Instruction objects
    }

    private function fromArray($indicator_instructions = array()) {
        $indicator_instruction_objects = array();
        foreach ($indicator_instructions as $indicator_instruction) {
            $indicator_instruction_object = new Indicator_instruction_model();
            $indicator_instruction_object->setId($indicator_instruction[self::ID_FIELD]);
            $indicator_instruction_object->setValue($indicator_instruction[self::VALUE_FIELD]);
            $indicator_instruction_object->setUnionToken($indicator_instruction[self::UNION_TOKEN_FIELD]);
            $indicator_instruction_object->setDeletedAt($indicator_instruction[self::DELETED_AT_FIELD]);

            $indicator_property_id = $indicator_instruction[self::INDICATOR_PROPERTY_FIELD];
            if($indicator_property_id != NULL) {
                $indicator_property_dao = new Indicator_property_dao();
                $indicator_instruction_object->setIndicatorProperty(
                    $indicator_property_dao->getById($indicator_property_id));
            }

            $indicator_id = $indicator_instruction[self::INDICATOR_FIELD];
            if($indicator_id != NULL) {
                $indicator_dao = new Indicator_dao();
                $indicator_instruction_object->setIndicator($indicator_dao->getById($indicator_id));
            }

            $utility_id = $indicator_instruction[self::UTILITY_FIELD];
            if($indicator_id != NULL) {
                $utility_dao = new Utility_dao();
                $indicator_instruction_object->setUtility($utility_dao->getById($utility_id));
            }

            $scheme_id = $indicator_instruction[self::SCHEME_FIELD];
            if($indicator_id != NULL) {
                $scheme_dao = new Scheme_dao();
                $indicator_instruction_object->setScheme($scheme_dao->getById($scheme_id));
            }
            array_push($indicator_instruction_objects, $indicator_instruction_object);
        }
        return $indicator_instruction_objects;
    }

    private function fromObject($indicator_instruction) {
        return array(
            self::VALUE_FIELD => $indicator_instruction->getValue(),
            self::UNION_TOKEN_FIELD => $indicator_instruction->getUnionToken(),
            self::INDICATOR_PROPERTY_FIELD => $indicator_instruction->getIndicatorProperty()->getId(),
            self::INDICATOR_FIELD => $indicator_instruction->getIndicator()->getId(),
            self::UTILITY_FIELD => ($indicator_instruction->isUtility()) ? $indicator_instruction->getUtility()->getId() : NULL,
            self::SCHEME_FIELD => ($indicator_instruction->isScheme()) ? $indicator_instruction->getScheme()->getId() : NULL,
            self::DELETED_AT_FIELD => $indicator_instruction->getDeletedAt()
        );
    }
}