<?php
require_once APPPATH.'models/Request_model.php';
require_once APPPATH.'models/daos/Indicator_dao.php';
require_once APPPATH.'models/daos/Indicator_instruction_dao.php';

class Request_dao extends CI_Model {
    const TABLE_NAME = 'requests';
    const ID_FIELD = 'id';
    const KIND_FIELD = 'kind';
    const STATUS_FIELD = 'status';
    const CREATED_AT_FIELD = 'created_at';
    const INSTRUCTION_FIELD = 'instruction_token';
    const REASON_FIELD = 'reason';
    const USER_FIELD = 'user_id';
    const INDICATOR_FIELD = 'indicator_id';
    const DELETED_AT_FIELD = 'deleted_at';

    public function __construct() {
        parent::__construct();
    }

    public function getById($id) {
        $request = $this->get(array(self::ID_FIELD => $id));
        return count($request) == 1 ? $request[0] : NULL;
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

    public function post($request_object) {
        $data = $this->fromObject($request_object);
        return $this->db->insert(self::TABLE_NAME, $data);
    }

    public function update($request_object) {
        $data = $this->fromObject($request_object);

        $this->db->where(self::ID_FIELD, $request_object->getId());
        return $this->db->update(self::TABLE_NAME, $data);
    }

    public function delete($id) {
        $this->db->where(self::ID_FIELD, $id);
        return $this->db->delete(self::TABLE_NAME);
    }

    private function fromArray($request = array()) {
        $request_objects = array();
        foreach ($request as $request) {
            $request_object = new Request_model();
            $request_object->setId($request[self::ID_FIELD]);
            $request_object->setKind($request[self::KIND_FIELD]);
            $request_object->setStatus($request[self::STATUS_FIELD]);
            $request_object->setCreatedAt($request[self::CREATED_AT_FIELD]);
            $request_object->setDeletedAt($request[self::DELETED_AT_FIELD]);
            $request_object->setReason($request[self::REASON_FIELD]);

            $indicator_id = $request[self::INDICATOR_FIELD];
            if($indicator_id != NULL) {
                $indicator_dao = new Indicator_dao();
                $request_object->setIndicator($indicator_dao->getById($indicator_id));
            }

            $instruction_token = $request[self::INSTRUCTION_FIELD];
            if ($instruction_token != NULL) {
                $indicator_instruction_dao = new Indicator_instruction_dao();
                $request_object->setInstructions($indicator_instruction_dao->get(array(
                    Indicator_instruction_dao::UNION_TOKEN_FIELD => $instruction_token
                )));
            }

            $user_id = $request[self::USER_FIELD];
            if($user_id != NULL) {
                $ion_auth = new Ion_auth_model();
                $request_object->setUser($ion_auth->user($user_id)->row());
            }
            array_push($request_objects, $request_object);
        }
        return $request_objects;
    }

    private function fromObject($request) {
        return array(
            self::KIND_FIELD => $request->getKind(),
            self::STATUS_FIELD => $request->getStatus(),
            self::CREATED_AT_FIELD => $request->getCreatedAt(),
            self::INSTRUCTION_FIELD => $request->getInstructions()[0]->getUnionToken(),
            self::REASON_FIELD => $request->getReason(),
            self::USER_FIELD => $request->getUser()->id,
            self::INDICATOR_FIELD => $request->getIndicator()->getId(),
            self::DELETED_AT_FIELD => $request->getDeletedAt()
        );
    }
}