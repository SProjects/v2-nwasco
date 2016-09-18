<?php
require_once APPPATH.'models/Indicator_property_model.php';

class Indicator_property_dao extends CI_Model {
    const TABLE_NAME = 'indicator_properties';
    const ID_FIELD = 'id';
    const NAME_FIELD = 'name';
    const DESCRIPTION_FIELD = 'description';
    const DATATYPE_FIELD = 'datatype';
    const TOKEN_FIELD = 'token';
    const INDICATOR_FIELD = 'indicator_id';

    public function __construct() {
        parent::__construct();
    }

    public function getById($id) {
        $indicator_property = $this->get(array(self::ID_FIELD => $id));
        return count($indicator_property) == 1 ? $indicator_property[0] : NULL;
    }

    public function getByIndicator($indicator) {
        return $this->get(array(self::INDICATOR_FIELD => $indicator->getId()));
    }

    public function get($where_fields = array()) {
        $query = NULL;
        if(sizeof($where_fields) == 0) {
            $query = $this->db->get(self::TABLE_NAME);
        } else {
            $query = $this->db->get_where(self::TABLE_NAME, $where_fields);
        }
        return $this->fromArray($query->result_array());
    }

    public function post($indicator_property_object){
        $data = $this->fromObject($indicator_property_object);
        return $this->db->insert(self::TABLE_NAME, $data);
    }

    public function update($indicator_property) {
        $data = $this->fromObject($indicator_property);

        $this->db->where(array(self::ID_FIELD => $indicator_property->getId()));
        return $this->db->update(self::TABLE_NAME, $data);
    }

    public function delete($id) {
        $this->db->where(self::ID_FIELD, $id);
        return $this->db->delete(self::TABLE_NAME);
    }

    private function fromArray($indicator_properties = array()) {
        $indicator_property_objects = array();
        foreach ($indicator_properties as $indicator_property) {
            $indicator_property_object = new Indicator_property_model();
            $indicator_property_object->setId($indicator_property[self::ID_FIELD]);
            $indicator_property_object->setName($indicator_property[self::NAME_FIELD]);
            $indicator_property_object->setDescription($indicator_property[self::DESCRIPTION_FIELD]);
            $indicator_property_object->setDatatype($indicator_property[self::DATATYPE_FIELD]);
            $indicator_property_object->setToken($indicator_property[self::TOKEN_FIELD]);

            $indicator_id = $indicator_property[self::INDICATOR_FIELD];
            if($indicator_id != NULL) {
                $indicator_dao = new Indicator_dao();
                $indicator_property_object->setIndicator($indicator_dao->getById($indicator_id));
            }
            array_push($indicator_property_objects, $indicator_property_object);
        }
        return $indicator_property_objects;
    }

    private function fromObject($indicator_property) {
        return array(
            self::NAME_FIELD => $indicator_property->getName(),
            self::DESCRIPTION_FIELD => $indicator_property->getDescription(),
            self::DATATYPE_FIELD => $indicator_property->getDatatype(),
            self::TOKEN_FIELD => $indicator_property->getToken(),
            self::INDICATOR_FIELD => $indicator_property->getIndicator()->getId()
        );
    }
}