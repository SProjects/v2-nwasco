<?php
require APPPATH.'models/Utility_model.php';

class Utility_dao extends CI_Model {
    const TABLE_NAME = 'utilities';
    const ID_FIELD = 'id';
    const NAME_FIELD = 'name';
    const ABBREVIATION_FIELD = 'abbreviation';
    const INSPECTOR_FIELD = 'user_id';

    public function __construct() {
        parent::__construct();
    }

    public function getById($id) {
        $utility = $this->get(array(self::ID_FIELD => $id));
        return count($utility) == 1 ? $utility[0] : NULL;
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

    public function post($utilityObject) {
        $data = $this->fromObject($utilityObject);
        return $this->db->insert(self::TABLE_NAME, $data);
    }

    public function update($utilityObj) {
        $data = $this->fromObject($utilityObj);

        $this->db->where(array(self::ID_FIELD => $utilityObj->getId()));
        return $this->db->update(self::TABLE_NAME, $data);
    }

    public function delete($id) {
        $this->db->where(self::ID_FIELD, $id);
        return $this->db->delete(self::TABLE_NAME);
    }

    private function fromArray($utilities = array()) {
        $utilityObjects = array();
        foreach ($utilities as $utility) {
            $utilityObject = new Utility_model();
            $utilityObject->setId($utility[self::ID_FIELD]);
            $utilityObject->setName($utility[self::NAME_FIELD]);
            $utilityObject->setAbbreviation($utility[self::ABBREVIATION_FIELD]);

            $inspector_id = $utility[self::INSPECTOR_FIELD];
            if($inspector_id != NULL) {
                $ion_auth = new Ion_auth_model();
                $utilityObject->setInspector($ion_auth->user($inspector_id)->row());
            }
            array_push($utilityObjects, $utilityObject);
        }
        return $utilityObjects;
    }

    private function fromObject($utility) {
        return array(
            self::NAME_FIELD => $utility->getName(),
            self::ABBREVIATION_FIELD => $utility->getAbbreviation(),
            self::INSPECTOR_FIELD => $utility->getInspectorId()
        );
    }

}