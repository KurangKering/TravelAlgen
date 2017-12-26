<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Md_map extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function insert_titik($data)
	{
		return $this->db->insert('titik', $data);
	}

}

/* End of file md_map.php */
/* Location: ./application/modules/map/models/md_map.php */