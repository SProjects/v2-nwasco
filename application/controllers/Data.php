<?php
class Data extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('indicator_summary_model');
    }

    public function generateSummaryData() {
        set_time_limit(0);
        Indicator_summary_model::addBlankSummaryData();
        Indicator_summary_model::addSummaryData();
    }
}
