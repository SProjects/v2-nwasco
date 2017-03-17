<?php
require_once APPPATH.'models/Indicator_model.php';
require_once APPPATH.'models/Utility_model.php';

class Indicator_summary_dao extends CI_Model {
    const TABLE_NAME = 'indicator_summaries';
    const ID_FIELD = 'id';
    const OVERDUE_FIELD = 'overdue';
    const ALMOST_FIELD = 'almost';
    const ACTIVE_FIELD = 'active';
    const INDICATOR_FIELD = 'indicator_id';
    const UTILITY_FIELD = 'utility_id';

    public function __construct() {
        parent::__construct();
    }

    public function getById($id) {
        $indicator_summary = $this->get(array(self::ID_FIELD => $id));
        return count($indicator_summary) == 1 ? $indicator_summary[0] : NULL;
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

    public function post($indicator_summary_object) {
        $data = $this->fromObject($indicator_summary_object);
        return $this->db->insert(self::TABLE_NAME, $data);
    }

    public function update($indicator_summary_object) {
        $data = $this->fromObject($indicator_summary_object);

        $this->db->where(array(self::ID_FIELD => $indicator_summary_object->getId()));
        return $this->db->update(self::TABLE_NAME, $data);
    }

    public function delete($id) {
        $this->db->where(self::ID_FIELD, $id);
        return $this->db->delete(self::TABLE_NAME);
    }

    private function fromArray($indicator_summaries = array()) {
        $indicator_summary_objects = array();
        foreach ($indicator_summaries as $indicator_summary) {
            $indicator_summary_object = new Indicator_summary_model();
            $indicator_summary_object->setId($indicator_summary[self::ID_FIELD]);
            $indicator_summary_object->setOverdue($indicator_summary[self::OVERDUE_FIELD]);
            $indicator_summary_object->setAlmost($indicator_summary[self::ALMOST_FIELD]);
            $indicator_summary_object->setActive($indicator_summary[self::ACTIVE_FIELD]);

            $indicator_id = $indicator_summary[self::INDICATOR_FIELD];
            if($indicator_id != NULL) {
                $indicator_dao = new Indicator_dao();
                $indicator_summary_object->setIndicator($indicator_dao->getById($indicator_id));
            }

            $utility_id = $indicator_summary[self::UTILITY_FIELD];
            if($utility_id != NULL) {
                $utility_dao = new Utility_dao();
                $indicator_summary_object->setUtility($utility_dao->getById($utility_id));
            }
            array_push($indicator_summary_objects, $indicator_summary_object);
        }
        return $indicator_summary_objects;
    }

    private function fromObject($indicator_summary) {
        return array(
            self::OVERDUE_FIELD => $indicator_summary->getOverdue(),
            self::ALMOST_FIELD => $indicator_summary->getAlmost(),
            self::ACTIVE_FIELD => $indicator_summary->getActive(),
            self::INDICATOR_FIELD => $indicator_summary->getIndicatorId(),
            self::UTILITY_FIELD => $indicator_summary->getUtilityId()
        );
    }

}