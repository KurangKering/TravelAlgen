<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Map extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}
	public function index()
	{
		$this->load->view('vw_map');
	}

	public function insert()
	{
		$this->load->model('md_map');

		$data['nama'] = $this->input->post('nama');
		$data['kode'] = $this->_extract_string($data['nama']);
		$data['latitude'] = $this->input->post('lat');
		$data['longitude'] = $this->input->post('lng');
		$result = $this->md_map->insert_titik($data);
		return "OK";

	}

	public function _extract_string($string)
	{
		if (!preg_match('/\s/',$string))
			return substr($string, 0, 4);
		$pecah = explode(' ', $string);
		$akro = "";

		foreach ($pecah as $p) {
			if (strlen($p) > 1) {
				$akro .= $p[0]. $p[1];
			}
			else
				$akro .= $p[0];
			
		}
		return preg_replace('/[^.\w]/', '', $akro);
	}

}

/* End of file Map.php */
/* Location: ./application/modules/map/controllers/Map.php */