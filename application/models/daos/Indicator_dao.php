<?php
require_once APPPATH.'models/Indicator_model.php';

class Indicator_dao extends CI_Model {
    const TABLE_NAME = 'indicators';
    const ID_FIELD = 'id';
    const NAME_FIELD = 'name';
    const DESCRIPTION_FIELD = 'description';
    const KIND_FIELD = 'kind';
    const DAYS_TO_EXPIRE_FIELD = 'days_to_expire';
    const HAVE_CHART_FIELD = 'have_chart';

    public function __construct() {
        parent::__construct();
    }

    public function getById($id) {
        $indicator = $this->get(array(self::ID_FIELD => $id));
        return count($indicator) == 1 ? $indicator[0] : NULL;
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

    public function post($indicatorObject) {
        $data = $this->fromObject($indicatorObject);
        return $this->db->insert(self::TABLE_NAME, $data);
    }

    public function update($indicatorObject) {
        $data = $this->fromObject($indicatorObject);

        $this->db->where(self::ID_FIELD, $indicatorObject->getId());
        return $this->db->update(self::TABLE_NAME, $data);
    }

    public function delete($id) {
        $this->db->where(self::ID_FIELD, $id);
        return $this->db->delete(self::TABLE_NAME);
    }

    private function fromArray($indicators = array()) {
        $indicatorObjects = array();
        if(sizeof($indicators) > 0) {
            foreach ($indicators as $indicator) {
                $indicatorObject = new Indicator_model();
                $indicatorObject->setId($indicator[self::ID_FIELD]);
                $indicatorObject->setName($indicator[self::NAME_FIELD]);
                $indicatorObject->setDescription($indicator[self::DESCRIPTION_FIELD]);
                $indicatorObject->setKind($indicator[self::KIND_FIELD]);
                $indicatorObject->setDaysToExpire($indicator[self::DAYS_TO_EXPIRE_FIELD]);
                $indicatorObject->setHaveChart($indicator[self::HAVE_CHART_FIELD]);
                array_push($indicatorObjects, $indicatorObject);
            }
        }
        return $indicatorObjects;
    }

    private function fromObject($indicator) {
        return array(
            self::NAME_FIELD => $indicator->getName(),
            self::DESCRIPTION_FIELD => $indicator->getDescription(),
            self::KIND_FIELD => $indicator->getKind(),
            self::DAYS_TO_EXPIRE_FIELD => $indicator->getDaysToExpire(),
            self::HAVE_CHART_FIELD => $indicator->getHaveChart()
        );
    }

}