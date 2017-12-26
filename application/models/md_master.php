<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Md_master extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function get_master_data()
	{
		return $this->db->order_by('date_created')->get('titik')->result();

	}

	public function insert_data($data)
	{

		return $this->db->insert('titik', $data);
	}

}

/* End of file md_master.php */
/* Location: ./application/models/md_master.php */