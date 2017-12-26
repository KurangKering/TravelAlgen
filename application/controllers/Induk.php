<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Induk extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}
	public function index()
	{
		redirect('induk/tampil_data','refresh');
	}


	public function hitungSendiri()
	{

		if (!class_exists('City')) {
			require_once(APPPATH.'library/City'.EXT);
		}
		if (!class_exists('GA')) {
			require_once(APPPATH.'library/GA'.EXT);
		}
		if (!class_exists('Tour')) {
			require_once(APPPATH.'library/Tour'.EXT);
		}
		if (!class_exists('TourManager')) {
			require_once(APPPATH.'library/TourManager'.EXT);
		}
		if (!class_exists('Population')) {
			require_once(APPPATH.'library/City'.EXT);
		}
		
		$kumpulanTitik = $this->db->get('titik')->result_array();
		$kumpulanJarak = $this->db->get('bobot')->result_array();
		
		$jarakKe = array();
		foreach ($kumpulanTitik as $key => $value) {

			foreach ($kumpulanJarak as $key1 => $value1) {
				if ($value1['awal'] === $value['kode']) {
					$jarakKe[$value1['tujuan']] = $value1['jarak'];
				}
				
			}

			$city[] = new City("","",$value['kode'], $jarakKe);
			TourManager::addCity($city[$key]);
		}

		 
		
		

// //Create and add our cities
// 		$city1 = new City(60, 200);
// 		TourManager::addCity($city1);
// 		$city2 = new City(180, 200);
// 		TourManager::addCity($city2);
// 		$city3 = new City(80, 180);
// 		TourManager::addCity($city3);
// 		$city4 = new City(140, 180);
// 		TourManager::addCity($city4);
// 		$city5 = new City(20, 160);
// 		TourManager::addCity($city5);
// 		$city6 = new City(100, 160);
// 		TourManager::addCity($city6);
// 		$city7 = new City(200, 160);
// 		TourManager::addCity($city7);
// 		$city8 = new City(140, 140);
// 		TourManager::addCity($city8);
// 		$city9 = new City(40, 120);
// 		TourManager::addCity($city9);
// 		$city10 = new City(100, 120);
// 		TourManager::addCity($city10);
// 		$city11 = new City(180, 100);
// 		TourManager::addCity($city11);
// 		$city12 = new City(60, 80);
// 		TourManager::addCity($city12);
// 		$city13 = new City(120, 80);
// 		TourManager::addCity($city13);
// 		$city14 = new City(180, 60);
// 		TourManager::addCity($city14);
// 		$city15 = new City(20, 40);
// 		TourManager::addCity($city15);
// 		$city16 = new City(100, 40);
// 		TourManager::addCity($city16);
// 		$city17 = new City(200, 40);
// 		TourManager::addCity($city17);
// 		$city18 = new City(20, 20);
// 		TourManager::addCity($city18);
// 		$city19 = new City(60, 20);
// 		TourManager::addCity($city19);
// 		$city20 = new City(160, 20);
// 		TourManager::addCity($city20);


		$pop = new Population(50, true);
		print("Initial distance: " . $pop->getFittest()->getDistance());

// Evolve population for 100 generations
		$pop = GA::evolvePopulation($pop);
		for ($i = 0; $i < 100; $i++) {
			$pop = GA::evolvePopulation($pop);
		}

// Print final results
		print("<br>Finished.");
		print("<br>Final distance: " . $pop->getFittest()->getDistance());
		print("<br>Solution:");
		print($pop->getFittest());

	}
	public function chromosom()
	{
		$v = $this->db->get('titik')->result_array();
		$n = 1;
		$newArr = array();
		$befArr = array();
		foreach ($v as $key => $value) {
			$newArr[$key]['label'] = $n++; 
			$newArr[$key]['name'] = $value['nama']; 
			$newArr[$key]['lat'] = $value['lat']; 
			$newArr[$key]['lng'] = $value['lng']; 
			$newArr[$key]['latlng'] = '('.$value['lat'].', '.$value['lng'].')'; 
		}
		echo print_r($newArr);

		$chromosom = array( 0 => array ( 'label' => 1, 'name' => 'Stasiun Ka Tugu Yogyakarta', 'lat' => '-7.789198799999999', 'lng' => '110.36346630000003', 'latlng' => '(-7.789198799999999, 110.36346630000003)' ), 
			1 => array ( 'label' => 2, 'name' => 'Jalan Malioboro Yogyakarta', 'lat' => '-7.7940023', 'lng' => '110.36565350000001', 'latlng' => '(-7.7940023, 110.36565350000001)' ), 
			2 => array ( 'label' => 3, 'name' => 'Kompleks Taman Pintar Yogyakarta', 'lat' => '-7.800767999999999', 'lng' => '110.36813299999994', 'latlng' => '(-7.800767999999999, 110.36813299999994)' ), 
			3 => array ( 'label' => 4, 'name' => 'Jalan Monumen Jogja Kembali Yogyakarta', 'lat' => '-7.757295099999999', 'lng' => '110.3697621', 'latlng' => '(-7.757295099999999, 110.3697621) '), 
			4 => array ( 'label' => 5, 'name' => 'Gembira Loka Zoo Yogyakarta', 'lat' => '-7.8038943', 'lng' => '110.3978128', 'latlng' => '(-7.8038943, 110.3978128)' ), 
			5 => array ( 'label' => 6, 'name' => 'Pantai Depok Yogyakarta', 'lat' => '-8.0137087', 'lng' => '110.29147769999997', 'latlng' => '(-8.0137087, 110.29147769999997)' ) ); 

		print_r($chromosom);
	}

	public function tampil_data()
	{

		// <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCiDdGyp6n2hKHPECuB6JZIT-8dVHCpwI0&language=id&region=pekanbaru&libraries=places"></script>
		// 
		if ($this->input->post()) {
			$this->load->library('datatables');

			$this->datatables->select('kode, nama, lng, lat, date_created')
			->from('titik')
			->add_column('no_urut', '0')
			->add_column('action', '<a href="../induk/hapus_data/$1" class="btn btn-round btn-danger btn-xs">Delete</a>', 'kode');
			echo $this->datatables->generate();
			return;

		}
		$this->template->css_add('assets/plugins/DataTables/DataTables-1.10.16/css/jquery.dataTables.min.css');
		$this->template->css_add('assets/plugins/DataTables/DataTables-1.10.16/css/dataTables.bootstrap.min.css');

		$this->template->js_add('https://maps.googleapis.com/maps/api/js?key=AIzaSyCiDdGyp6n2hKHPECuB6JZIT-8dVHCpwI0&language=id&region=pekanbaru&libraries=places', 'url');
		$this->template->js_add('assets/plugins/DataTables/DataTables-1.10.16/js/jquery.dataTables.min.js');
		$this->template->js_add('assets/plugins/DataTables/DataTables-1.10.16/js/dataTables.bootstrap.min.js');


		$this->template->render('vw_tampil_data');
	}

	public function hapus_data($id)
	{
		$this->db->delete('titik', array('kode' => $id));
		redirect('induk/tampil_data','refresh');
	}

	public function input_data()
	{
		if ($this->input->post('type') == 'lakukanInput') {
			$input['nama'] = $this->input->post('nama');
			$input['kode'] =$this->_extract_string($input['nama']);
			$input['lat'] = $this->input->post('lat');
			$input['lng'] = $this->input->post('lng'); 
			$result = $this->db->insert('titik', $input);
			echo "ok";
			return;
		}
		$this->load->view('vw_input_data');
	}

	public function dummy()
	{
		print_r($this->db->get('bobot')->result_array());
	}
	public function _hitung_bobot()
	{
		
		$titikDariDB = $this->db->get('titik')->result();
		$titikArray = array();
		$penampungInsert;
		foreach ($titikDariDB as $k => $v) {
			$titikArray[$v->kode] = $v->lat .','.$v->lng;
		}
		
		$dataJson = @file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins=".implode('|', $titikArray)."&destinations=".implode('|', $titikArray)."&key=AIzaSyCiDdGyp6n2hKHPECuB6JZIT-8dVHCpwI0");
		if ($dataJson === FALSE ) {
			return 'kontlo';
		}
		$dataJson = json_decode($dataJson);
		for ($i=0; $i < count($titikDariDB) ; $i++) { 
			for ($j=0; $j < count($titikDariDB); $j++) { 
				$awal = $titikDariDB[$i]->kode;
				$tujuan = $titikDariDB[$j]->kode;
				$jarak = $dataJson->rows[$i]->elements[$j]->distance->value;
				$penampungInsert[] = array('awal' => $awal, 'tujuan' => $tujuan , 'jarak' => $jarak );
			}
		}
		$this->db->truncate('bobot');
		$result = $this->db->insert_batch('bobot', $penampungInsert);
		return $result ; 
		
	}

	public function tambah_data()
	{

	}


	public function hitung()
	{

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

/* End of file Induk.php */
/* Location: ./application/controllers/Induk.php */