<?php
require APPPATH.'models/Scheme_model.php';

class Scheme_dao extends CI_Model {
    const TABLE_NAME = 'schemes';
    const ID_FIELD = 'id';
    const NAME_FIELD = 'name';
    const INSPECTOR_FIELD = 'user_id';

    public function __construct() {
        parent::__construct();
    }

    public function getById($id) {
        $scheme = $this->get(array(self::ID_FIELD => $id));
        return count($scheme) == 1 ? $scheme[0] : NULL;
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

    public function post($schemeObject) {
        $data = $this->fromObject($schemeObject);
        return $this->db->insert(self::TABLE_NAME, $data);
    }

    public function update($schemeObject) {
        $data = $this->fromObject($schemeObject);

        $this->db->where(array(self::ID_FIELD => $schemeObject->getId()));
        return $this->db->update(self::TABLE_NAME, $data);
    }

    public function delete($id) {
        //TODO: Create a transaction to delete the Scheme object and attached Instruction objects
    }

    private function fromArray($schemes = array()) {
        $schemeObjects = array();
        foreach ($schemes as $scheme) {
            $schemeObject = new Scheme_model();
            $schemeObject->setId($scheme[self::ID_FIELD]);
            $schemeObject->setName($scheme[self::NAME_FIELD]);

            $inspector_id = $scheme[self::INSPECTOR_FIELD];
            if($inspector_id != NULL) {
                $ion_auth = new Ion_auth_model();
                $schemeObject->setInspector($ion_auth->user($inspector_id)->row());
            }
            array_push($schemeObjects, $schemeObject);
        }
        return $schemeObjects;
    }

    private function fromObject($scheme) {
        return array(
            self::NAME_FIELD => $scheme->getName(),
            self::INSPECTOR_FIELD => $scheme->getInspectorId()
        );
    }
}