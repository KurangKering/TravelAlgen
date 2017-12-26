	<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Master extends CI_Controller {
		public function __construct()
		{
			parent::__construct();
			$this->load->model('md_master');
	//Do your magic here
		}
		public function index()
		{
			$this->master_data();
		}
		public function master_data()
		{
			$data['result'] = $this->md_master->get_master_data();
			$this->form_validation->set_rules('nama', 'Nama', 'required');
			$this->form_validation->set_rules('lng', 'Longitude', 'required');
			$this->form_validation->set_rules('lat', 'Latitude', 'required');
			if ($this->form_validation->run()) {
				$this->_ins();
				$this->_hitung_bobot();
				redirect('master','refresh');
			} else {
				$this->template->render('vw_master_data', $data);
			}
		}

		public function ins()
		{
			$data['nama'] = $this->input->post('nama');
			$data['kode'] = $this->_extract_string($data['nama']);
			$data['lng'] = $this->input->post('lng');
			$data['lat'] = $this->input->post('lat');
			$result = $this->md_master->insert_data($data);
			$this->_hitung_bobot();
			echo "OK";
		}
		private function _hitung_bobot() {
			$untukInsert = array();
			$data['master_data'] = $this->db->order_by('date_created')->get('titik')->result_array();
			$data['jarak'] = array();
			foreach ($data['master_data'] as $master) {
				$data['jarak'][] = $master->lat . ',' . $master->lng;
			}
			$dataJson = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins=".implode('|', $data['jarak'])."&destinations=".implode('|', $data['jarak'])."&key=AIzaSyCiDdGyp6n2hKHPECuB6JZIT-8dVHCpwI0");
			$data['kumpulan'] = json_decode($dataJson, true);
			$this->db->truncate('bobot');
			for ($i=0; $i < count($data['master_data']); $i++) { 
				for ($j=0; $j < count($data['master_data']); $j++) { 
					$awal = $data['master_data'][$i]->kode;
					$tujuan = $data['master_data'][$j]->kode;
					$jarak = $data['kumpulan']['rows'][$i]['elements'][$j]['distance']['value'];
					$untukInsert[] = array('awal' => $awal, 'tujuan' => $tujuan, 'jarak' => $jarak);
				}
			}

		//return $this->db->insert('bobot', $untukInsert);

		}

		public function dummy() {

			$untukInsert = array();
			$data['master_data'] = $this->md_master->get_master_data();
			$data['jarak'] = array();
			foreach ($data['master_data'] as $master) {
				$data['jarak'][] = $master->lat . ',' . $master->lng;
			}
			$dataJson = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins=".implode('|', $data['jarak'])."&destinations=".implode('|', $data['jarak'])."&key=AIzaSyCiDdGyp6n2hKHPECuB6JZIT-8dVHCpwI0");
			$data['kumpulan'] = json_decode($dataJson, true);
			$this->db->truncate('bobot');
			for ($i=0; $i < count($data['master_data']); $i++) { 
				for ($j=0; $j < count($data['master_data']); $j++) { 
					$awal = $data['master_data'][$i]->kode;
					$tujuan = $data['master_data'][$j]->kode;
					$jarak = $data['kumpulan']['rows'][$i]['elements'][$j]['distance']['text'];
					$untukInsert[] = array('awal' => $awal, 'tujuan' => $tujuan, 'jarak' => $jarak);
				}
			}
			print_r($data['kumpulan']);

		//return $this->db->insert('bobot', $untukInsert);


		}
		public function bobot()
		{
			$data['master_data'] = $this->md_master->get_master_data();
			$data['jarak'] = array();
			foreach ($data['master_data'] as $master) {
				$data['jarak'][] = $master->lat . ',' . $master->lng;
			}
			$dataJson = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins=".implode('|', $data['jarak'])."&destinations=".implode('|', $data['jarak'])."&key=AIzaSyCiDdGyp6n2hKHPECuB6JZIT-8dVHCpwI0");
			$data['kumpulan'] = json_decode($dataJson, true);
			$this->template->render('vw_bobot', $data);
		}
		public function hitung()
		{
			print_r($this->db->order_by('date_created')->get('titik')->result_array());
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
	/* End of file Master.php */
/* Location: ./application/controllers/Master.php */