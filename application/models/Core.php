<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Utility Model
*
*/

class Core extends CI_Model
{

 public function __construct()
    {
        parent::__construct();
    }
    function getAllUtilities(){

        $this->db->order_by('utility', 'ASC');
        $query = $this->db->get('cus');

        return $query->result();

    }

	function getSchemes(){

   	    $this->db->order_by('scheme', 'ASC');
        $query = $this->db->get('private_schemes');

		return $query->result();

    }


  function getIndicators(){

        $query = $this->db->get('indicators');

    return $query->result();

    }



	function getSchemeIndicators(){

        $query = $this->db->get('scheme_indicators');

		return $query->result();

    }





	public function getIndicatorCounts($cu_id){

        $query = $this->db->get_where('cunits', array('cu_id' => $id));

		if ($query->num_rows() > 0) 
		foreach ($query->result() as $row)
          {
            return $row;
        }

    }




     public function getById($id) {
      if($id != FALSE) {
        $query = $this->db->get_where('cunits', array('cu_id' => $id));
        return $query->row_array();
      }
      else {
        return FALSE;
      }
    }



	 public function getSchemesById($id) {
	  if($id != FALSE) {
		$query = $this->db->get_where('private_schemes', array('ps_id' => $id));
		return $query->row_array();
	  }
	  else {
		return FALSE;
	  }
	}



//List Licence Conditions for CU
   public function listLcondtions($id) {
      $query = $this->db->get_where('licence_conditions', array('utility_id' => $id));

      foreach ($query->result() as $row)
		{
            return $row;
        }

    }




//List Directives for CU
    public function listTowns($id) {
        $query = $this->db->get_where('towns', array('utility_id' => $id));

        foreach ($query->result() as $row)
		{
            return $row;
        }

    }


//List Directives for CU
   public function listDirectives($id) {
        $query = $this->db->get_where('directives', array('utility_id' => $id));

        return $query->result();

    }


//List Scheme Directives
   public function listSchemeDirectives($id) {
        $query = $this->db->get_where('sdirectives', array('ps_id' => $id));

        return $query->result();

    }




//List Projects for CU
    public function listTarrifs($id) {
        $query = $this->db->get_where('tariff_conditions', array('utility_id' => $id));

	    return $query->result();
    }




//List Projects for CU
    public function listProjects($id) {
        $query = $this->db->get_where('projects', array('utility_id' => $id));

		return $query->result();

    }





//List Projects for CU
    public function listSRS($id) {
        $query = $this->db->get_where('srs', array('utility_id' => $id));

		return $query->result();

    }




// Get Tariffs by id
	 public function tariffById($id) {
		$query = $this->db->get_where('tariff_conditions', array('tariff_id' => $id));

		foreach ($query->result() as $row)
		{
            return $row;
        }

    }


    // Function To Fetch All directives Record
    function show_directives(){
    $query = $this->db->get('directives');
    $query_result = $query->result();
    return $query_result;
    }
    // Function To Fetch Selected Student Record
    function edit_directive($data){
    $this->db->select('*');
    $this->db->from('directives');
    $this->db->where('dir_id', $data);
    $query = $this->db->get();
    $result = $query->result();
    return $result;
    }

  // Update Query For Selected Student
  function update_directive($id,$data){
  $this->db->where('dir_id', $id);
  $this->db->update('directives', $data);
  }

}