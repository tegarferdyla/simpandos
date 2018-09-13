<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
class ppk extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		if (!$this->session->has_userdata('status')) {
			redirect('login');
		} else if ($this->session->userdata('role') == 'admin'){
			redirect('admin');
		}
	}

	public function index()
	{
		$id_user = $this->session->userdata('id_user');
		$id_ppk = $this->session->userdata('id_ppk');
		$data['data_user'] = $this->Datauser_model->getwhereuser($id_user);
		$data['data_ppk']  = $this->Datappk_model->getwhereppk($id_ppk);
		$data['data_tahun'] = $this->Datatahun_model->daftartahun();

		$this->load->view('ppk/header',$data);
		$this->load->view('ppk/sidebar',$data);
		$this->load->view('ppk/dashboard',$data);
		$this->load->view('ppk/footer');
	}

	//----------------------------------------------------------
	//----------------------- Start Of TAHUN ---------------------
	//----------------------------------------------------------
	public function daftartahun()
	{
		$id_user = $this->session->userdata('id_user');
		$id_ppk = $this->session->userdata('id_ppk');
		$data['data_user'] = $this->Datauser_model->getwhereuser($id_user);
		$data['data_ppk']  = $this->Datappk_model->getwhereppk($id_ppk);
		$data['data_tahun'] = $this->Datatahun_model->daftartahun();

		$this->load->view('ppk/header',$data);
		$this->load->view('ppk/sidebar',$data);
		$this->load->view('ppk/daftartahun',$data);
		$this->load->view('ppk/footer');
	}

	public function inputtahun()
	{
		$id_user = $this->session->userdata('id_user');
		$id_ppk = $this->session->userdata('id_ppk');
		$data['data_user'] = $this->Datauser_model->getwhereuser($id_user);
		$data['data_ppk']  = $this->Datappk_model->getwhereppk($id_ppk);

		$this->load->view('ppk/header',$data);
		$this->load->view('ppk/sidebar',$data);
		$this->load->view('ppk/inputtahun');
		$this->load->view('ppk/footer');
	}

	public function tambahtahun ()
	{
		$this->form_validation->set_rules('namatahun', 'Tahun' ,'trim|required|numeric|max_length[4]');
		$id_ppk = $this->session->userdata('id_ppk');

		if ($this->form_validation->run() == FALSE) {
		 	$id_user = $this->session->userdata('id_user');
			$id_ppk = $this->session->userdata('id_ppk');
			$data['data_user'] = $this->Datauser_model->getwhereuser($id_user);
			$data['data_ppk']  = $this->Datappk_model->getwhereppk($id_ppk);

			$this->load->view('ppk/header',$data);
			$this->load->view('ppk/sidebar',$data);
			$this->load->view('ppk/inputtahun');
			$this->load->view('ppk/footer');
		 }
		 else {
		 	$nama_tahun = $this->input->post('namatahun');
		 	$deskripsi	= $this->input->post('keterangan');
		 	$data 		= array(
		 		'id_tahun' 		=> $this->Penomoran_model->IDTahun(),
		 		'nama_tahun'	=> $nama_tahun,
		 		'deskripsi'		=> $deskripsi,
		 		'input_by'		=> $this->session->userdata('nama_user'),
		 		'id_ppk'		=> $id_ppk
		 	);
		 	$cektahun	= $this->Datatahun_model->validasitahun($nama_tahun, $id_ppk);
		 	if ($cektahun > 0) {
		 		$this->session->set_flashdata('tahuntersedia', 'true');
			 	redirect('ppk/inputtahun');
		 	}
		 	else {
				$input = $this->Datatahun_model->Tambahtahun($data, 'tbl_tahun');
		 		if ($input > 0) {
		 			$lokasi = "./assets/data/" .$nama_tahun;
		 			mkdir($lokasi,0777,true);
		 			$this->session->set_flashdata('berhasil','true');
		 			redirect(base_url('ppk/daftartahun'));
		 		}
		 		else {
		 			$this->session->set_flashdata('gagal','true');
		 			redirect(base_url('ppk/daftartahun'));	
		 		}
		 	}
		 }

	}


	//----------------------------------------------------------
	//----------------------- End Of Tahun ---------------------
	//----------------------------------------------------------

	//----------------------------------------------------------
	//----------------------- Start of Paket -------------------
	//----------------------------------------------------------

	public function inputpaket()
	{
		$id_user = $this->session->userdata('id_user');
		$id_ppk = $this->session->userdata('id_ppk');
		$data['data_user'] 	= $this->Datauser_model->getwhereuser($id_user);
		$data['data_ppk']  	= $this->Datappk_model->getwhereppk($id_ppk);
		$data['data_jenis']	= $this->Datajenis_model->subjeniskontraktual();
		$data['data_tahun'] = $this->Datatahun_model->daftartahun();

		$this->load->view('ppk/header',$data);
		$this->load->view('ppk/sidebar',$data);
		$this->load->view('ppk/inputpaket',$data);
		$this->load->view('ppk/footer');
	}

	public function tambahkontraktual()
	{
		$nama_paket = $this->input->post('nama_paket');
		$deskripsi  = $this->input->post('deskripsi');
		$input_by	= $this->session->userdata('nama_user');
		$id_jenis 	= $this->input->post('id_jenis');
		$id_tahun 	= $this->input->post('id_tahun');
		$id_ppk 	= $this->session->userdata('id_ppk');
		
		$data = array(
			'id_paket'		=> $this->Penomoran_model->IDPaket(),
			'nama_paket'	=> ucwords($nama_paket),
			'deskripsi'		=> $deskripsi,
			'input_by'		=> $input_by,
			'id_jenis'		=> $id_jenis,
			'id_tahun'		=> $id_tahun,
			'id_ppk'		=> $id_ppk
		);
		$validasipaket = $this->Datapaket_model->validasipaket($nama_paket, $id_tahun);
		if ($validasipaket > 0) {
			$this->session->set_flashdata('pakettersedia','true');
			redirect('ppk/inputpaket');
		}
		else {
			$input = $this->Datapaket_model->Tambahpaket($data, 'tbl_paket');
			if ($input > 0) {
				//Nama Tahun
				$nama_tahun	= $this->Datatahun_model->getwheretahun($id_tahun);
				$data 		= array ('nama_tahun' => $nama_tahun['nama_tahun']);
				$nama_tahun = $data['nama_tahun'];
				//Nama PPK
				$nama_ppk	= $this->Datappk_model->getwhereppk($id_ppk);
				$data 		= array ('nama_ppk' => $nama_ppk['nama_ppk']);
				$nama_ppk 	= $data['nama_ppk'];
				//Jenis dan Sub Jenis
				$nama_jenis	= $this->Datajenis_model->getwherejenis($id_jenis);
				$data 		= array (
					'main_jenis' 	=> $nama_jenis['main_jenis'],
					'sub_jenis'		=> $nama_jenis['sub_jenis']
				);
				$main_jenis = $data['main_jenis'];
				$sub_jenis 	= $data['sub_jenis'];

				$lokasi = "./assets/data/". $nama_tahun . "/" . $nama_ppk . "/" . $main_jenis . "/" . $sub_jenis . "/" . ucwords($nama_paket);
				mkdir($lokasi,0777,true);
				$this->session->set_flashdata('kontraktualberhasil', 'true');
				redirect(base_url('ppk/inputpaket'));	
			}
			else {
				$this->session->set_flashdata('gagal', 'true');
				redirect(base_url('ppk/inputpaket'));
			}
		}
	}

	public function tambahswakelola()
	{
		$nama_paket = $this->input->post('nama_paket');
		$deskripsi  = $this->input->post('deskripsi');
		$input_by	= $this->session->userdata('nama_user');
		$id_jenis 	= $this->input->post('id_jenis');
		$id_tahun 	= $this->input->post('id_tahun');
		$id_ppk 	= $this->session->userdata('id_ppk');
		$data = array(
			'id_paket'		=> $this->Penomoran_model->IDPaket(),
			'nama_paket'	=> ucwords($nama_paket),
			'deskripsi'		=> $deskripsi,
			'input_by'		=> $input_by,
			'id_jenis'		=> $id_jenis,
			'id_tahun'		=> $id_tahun,
			'id_ppk'		=> $id_ppk
		);
		$validasipaket = $this->Datapaket_model->validasipaket($nama_paket, $id_tahun);
		if ($validasipaket > 0) {
			$this->session->set_flashdata('pakettersedia','true');
			redirect('ppk/inputpaket');
		}
		else {
			$input = $this->Datapaket_model->Tambahpaket($data, 'tbl_paket');
			if ($input > 0) {
				//Nama Tahun
				$nama_tahun	= $this->Datatahun_model->getwheretahun($id_tahun);
				$data 		= array ('nama_tahun' => $nama_tahun['nama_tahun']);
				$nama_tahun = $data['nama_tahun'];
				//Nama PPK
				$nama_ppk	= $this->Datappk_model->getwhereppk($id_ppk);
				$data 		= array ('nama_ppk' => $nama_ppk['nama_ppk']);
				$nama_ppk 	= $data['nama_ppk'];
				//Jenis dan Sub Jenis
				$nama_jenis	= $this->Datajenis_model->getwherejenis($id_jenis);
				$data 		= array (
					'main_jenis' 	=> $nama_jenis['main_jenis']
				);
				$main_jenis = $data['main_jenis'];

				$lokasi = "./assets/data/". $nama_tahun . "/" . $nama_ppk . "/" . $main_jenis . "/". ucwords($nama_paket);
				mkdir($lokasi,0777,true);
				$this->session->set_flashdata('swakelolaberhasil', 'true');
				redirect(base_url('ppk/inputpaket'));	
			}
			else {
				$this->session->set_flashdata('gagal', 'true');
				redirect(base_url('ppk/inputpaket'));
			}
		}
	}

	public function daftarkontraktual()
	{
		$this->load->view('header');
	}

	public function daftarswakelola()
	{
		
	}


	public function test()
	{
		$id_tahun 	= "THN0001";
		$nama_tahun	= $this->Datatahun_model->getwheretahun($id_tahun);
		$data 		= array ('nama_tahun' => $nama_tahun['nama_tahun']);
		$nama_tahun = $data['nama_tahun'];

		$id_jenis 	= "JNS0005";
		$nama_jenis	= $this->Datajenis_model->getwherejenis($id_jenis);
		$data 		= array (
			'main_jenis' 	=> $nama_jenis['main_jenis'],
			'sub_jenis' 	=> $nama_jenis['sub_jenis'],

		);
		$main_jenis = $data['main_jenis'];
		$sub_jenis = $data['sub_jenis'];


		$id_ppk 	= $this->session->userdata('id_ppk');
		$nama_ppk	= $this->Datappk_model->getwhereppk($id_ppk);
		$data 		= array ('nama_ppk' => $nama_ppk['nama_ppk']);
		$nama_ppk 	= $data['nama_ppk'];

		echo "$nama_tahun / $nama_ppk / $main_jenis / $sub_jenis";
	}


}
 ?>