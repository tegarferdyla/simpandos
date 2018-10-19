<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

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
		$tahun = date('Y');
		$cetaktahun =$this->Datatahun_model->cektahunppk($tahun,$id_ppk);
		if ($cetaktahun !=NULL) {
			$id_tahun = $cetaktahun->id_tahun;
		}
		else{
			$id_tahun = NULL;
		}
		$data['chart']		= $this->Datapaket_model->chart($id_tahun);
		$data['data_user'] 	= $this->Datauser_model->getwhereuser($id_user);
		$data['data_ppk']  	= $this->Datappk_model->getwhereppk($id_ppk);
		$data['data_tahun'] = $this->Datatahun_model->daftartahunppk($id_ppk);
		$data['data_jenis']	= $this->Datajenis_model->subjeniskontraktual();

		$this->load->view('ppk/header',$data);
		$this->load->view('ppk/sidebar',$data);
		$this->load->view('ppk/dashboard',$data);
		$this->load->view('ppk/footer',$data);
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
		$data['data_tahun'] = $this->Datatahun_model->daftartahunppk($id_ppk);
		$data['data_jenis']	= $this->Datajenis_model->subjeniskontraktual();

		$this->load->view('ppk/header',$data);
		$this->load->view('ppk/sidebar',$data);
		$this->load->view('ppk/daftartahun',$data);
		$this->load->view('admin/footer');
	}

	public function inputtahun()
	{
		$id_user = $this->session->userdata('id_user');
		$id_ppk = $this->session->userdata('id_ppk');
		$data['data_user'] = $this->Datauser_model->getwhereuser($id_user);
		$data['data_ppk']  = $this->Datappk_model->getwhereppk($id_ppk);
		$data['data_jenis']	= $this->Datajenis_model->subjeniskontraktual();

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
		$data['data_tahun'] = $this->Datatahun_model->daftartahunppk($id_ppk);
		$data['data_jenis']	= $this->Datajenis_model->subjeniskontraktual();

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

	public function daftarpaket($id_jenis)
	{
		$id_user = $this->session->userdata('id_user');
		$id_ppk = $this->session->userdata('id_ppk');
		$data['data_user'] = $this->Datauser_model->getwhereuser($id_user);
		$data['data_ppk']  = $this->Datappk_model->getwhereppk($id_ppk);
		$data['data_jenis']	 	= $this->Datajenis_model->subjeniskontraktual();
		$data['daftarpaket']	= $this->Datapaket_model->daftarpaket($id_jenis,$id_ppk);
		$data['get_jenis']  = $this->Datajenis_model->getwherejenis($id_jenis);

		$this->load->view('ppk/header',$data);
		$this->load->view('ppk/sidebar',$data);
		$this->load->view('ppk/daftarpaket',$data);
		$this->load->view('admin/footer');
	}

	public function deletepaketkontraktual($id_paket)
	{
		//Nama PPK
		$id_ppk 	= $this->session->userdata('id_ppk');
		$nama_ppk	= $this->Datappk_model->getwhereppk($id_ppk);
		$data 		= array ('nama_ppk' => $nama_ppk['nama_ppk']);
		$nama_ppk 	= $data['nama_ppk'];
		//Nama Paket, Main Jenis , Sub Jenis , Tahun 
		$paket 		= $this->Datapaket_model->getwherepaket($id_paket);
		$id_jenis 	= $paket[0]['id_jenis'];
		$nama_paket	= $paket[0]['nama_paket'];
		$nama_tahun	= $paket[0]['nama_tahun'];
		$main_jenis	= $paket[0]['main_jenis'];
		$sub_jenis	= $paket[0]['sub_jenis'];

		delete_files('./assets/data/'. $nama_tahun . "/" . $nama_ppk . "/" . $main_jenis . "/" . $sub_jenis . "/" .$nama_paket. '/' , TRUE);
		rmdir('./assets/data/'. $nama_tahun . '/' . $nama_ppk . '/' . $main_jenis . '/' . $sub_jenis . '/' .$nama_paket. '/');
		$where = array ('id_paket' =>$id_paket);
		$deletepaket = $this->Datapaket_model->deletepaket($where,'tbl_paket');
		// if ($deletepaket > 0) {
			$this->session->set_flashdata('deleteberhasil', true);
			redirect('ppk/daftarpaket/'.$id_jenis);
		// }
	}

	public function deletepaketswakelola($id_paket)
	{
		//Nama PPK
		$id_ppk 	= $this->session->userdata('id_ppk');
		$nama_ppk	= $this->Datappk_model->getwhereppk($id_ppk);
		$data 		= array ('nama_ppk' => $nama_ppk['nama_ppk']);
		$nama_ppk 	= $data['nama_ppk'];
		//Nama Paket, Main Jenis , Sub Jenis , Tahun 
		$paket 		= $this->Datapaket_model->getwherepaket($id_paket);
		$id_jenis 	= $paket[0]['id_jenis'];
		$nama_paket	= $paket[0]['nama_paket'];
		$nama_tahun	= $paket[0]['nama_tahun'];
		$main_jenis	= $paket[0]['main_jenis'];

		delete_files('./assets/data/'. $nama_tahun . "/" . $nama_ppk . "/" . $main_jenis . "/" .$nama_paket. '/' , TRUE);
		rmdir('./assets/data/'. $nama_tahun . '/' . $nama_ppk . '/' . $main_jenis . '/'  .$nama_paket. '/');
		
		$where = array ('id_paket' =>$id_paket);
		$deletepaket = $this->Datapaket_model->deletepaket($where,'tbl_paket');
		// if ($deletepaket > 0) {
			$this->session->set_flashdata('deleteberhasil', true);
			redirect('ppk/daftarpaket/'.$id_jenis);
		// }
	}
	
	//----------------------------------------------------------
	//----------------------- End of Paket ---------------------
	//----------------------------------------------------------
	//----------------------------------------------------------
	//----------------------- Start of Jenis -------------------
	//----------------------------------------------------------

	public function jenispaket($id_tahun)
	{
		$id_user = $this->session->userdata('id_user');
		$id_ppk = $this->session->userdata('id_ppk');
		$data['data_user'] = $this->Datauser_model->getwhereuser($id_user);
		$data['data_ppk']  = $this->Datappk_model->getwhereppk($id_ppk);
		$data['data_jenis']	= $this->Datajenis_model->subjeniskontraktual();
		$data['data_tahun'] = $this->Datatahun_model->getwheretahun($id_tahun);


		$this->load->view('ppk/header',$data);
		$this->load->view('ppk/sidebar',$data);
		$this->load->view('ppk/jenispaket',$data);
		$this->load->view('ppk/footer');
	}

	public function pilihpaket($id_tahun, $id_jenis)
	{
		$id_user = $this->session->userdata('id_user');
		$id_ppk = $this->session->userdata('id_ppk');
		$data['data_user'] = $this->Datauser_model->getwhereuser($id_user);
		$data['data_ppk']  = $this->Datappk_model->getwhereppk($id_ppk);
		$data['data_tahun'] = $this->Datatahun_model->getwheretahun($id_tahun);
		$data['where_jenis']= $this->Datajenis_model->getwherejenis($id_jenis);
		$data['data_jenis']	= $this->Datajenis_model->subjeniskontraktual();
		$data['cek_paket']	=$this->Datapaket_model->cekpaket($id_tahun,$id_jenis,$id_ppk);
			
		if ($data['cek_paket'] == NULL) {
			$this->session->set_flashdata('kosong', 'true');
			redirect('ppk/jenispaket/' . $id_tahun);	
		}
		else
		{
			$view_paket = $this->Datapaket_model->viewjenispaket($id_tahun,$id_jenis,$id_ppk);
			// Perhitungan
			$countdata['perhitungan'] = $this->Datafiles_model->perhitungan($id_tahun,$id_jenis);
			for($i=0; $i<count($view_paket); $i++){
				$id_paket 		= $view_paket[$i]['id_paket'];
				$id_jenis 		= $view_paket[$i]['id_jenis'];
				$id_tahun 		= $view_paket[$i]['id_tahun'];
				$nama_paket		= $view_paket[$i]['nama_paket'];
				if (!empty($countdata['perhitungan'][$i]->hasil)) {
					$id_paket 	= $view_paket[$i]['id_paket']; 
					$perhitungan = $countdata['perhitungan'][$i]->hasil;
				}
				elseif (empty($countdata['perhitungan'][$i]->hasil)) {
					$perhitungan = '0';
				}
				$json[] = array(
						'id_paket' 	 		=> $id_paket,
						'id_jenis' 	 		=> $id_jenis,
						'id_tahun' 	 		=> $id_tahun,
						'nama_paket' 		=> $nama_paket,
						'paket_terkumpul'	=> $perhitungan
				);
				
			}
			$cetak = json_encode($json);
			$data['hasil'] = json_decode($cetak);
			$this->load->view('ppk/header',$data);
			$this->load->view('ppk/sidebar',$data);
			$this->load->view('ppk/pilihpaket',$data);
			$this->load->view('ppk/footer');
		}
	}

	public function inputdokutama($id_jenis, $id_paket)
	{	
		$id_user = $this->session->userdata('id_user');
		$id_ppk = $this->session->userdata('id_ppk');
		$data['data_user'] = $this->Datauser_model->getwhereuser($id_user);
		$data['data_ppk']  = $this->Datappk_model->getwhereppk($id_ppk);
		$data['data_jenis']	= $this->Datajenis_model->subjeniskontraktual();

		$this->load->view('ppk/header',$data);
		$this->load->view('ppk/sidebar',$data);

		$data['where_paket'] 	= $this->Datapaket_model->wherepaket($id_paket);
		$data['daftarkepala']	= $this->Datadokumen_model->daftarkepala($id_jenis);
		$this->load->view('ppk/inputdokutama',$data);
		$this->load->view('ppk/footer');
	}

// -----------------------------------------------------------------------------------------------------------
//--------------------------------------- SAVE DOKUMEN UTAMA PEMBANGUNAN -------------------------------------
// -----------------------------------------------------------------------------------------------------------
	
	// ------------------------------ 1. Readiness Criteria -------------------------------------------------
	public function readyness()
	{
		$id_paket 	= $this->input->post('id_paket');
		$id_ppk 	= $this->session->userdata('id_ppk');
		$nama_ppk	= $this->Datappk_model->getwhereppk($id_ppk);
		$nama_ppk 	= $nama_ppk['nama_ppk'];

		$paket 		= $this->Datapaket_model->getwherepaket($id_paket);
		$id_jenis 	= $paket[0]['id_jenis'];
		$id_tahun	= $paket[0]['id_tahun'];
		$nama_paket	= $paket[0]['nama_paket'];
		$nama_tahun	= $paket[0]['nama_tahun'];
		$main_jenis	= $paket[0]['main_jenis'];
		$sub_jenis	= $paket[0]['sub_jenis'];
		$namabaru 	= $nama_tahun."-".$nama_paket."-";
		$this->load->library('upload');
		if ($_FILES['smd']['name'][0]!=NULL) {
			$smdcount = count($_FILES['smd']['name']);
			for ($i = 0; $i < $smdcount; $i++){
				$_FILES['userfile']['name']     = $_FILES['smd']['name'][$i];
				$_FILES['userfile']['type']     = $_FILES['smd']['type'][$i];
				$_FILES['userfile']['tmp_name'] = $_FILES['smd']['tmp_name'][$i];
				$_FILES['userfile']['error']    = $_FILES['smd']['error'][$i];
				$_FILES['userfile']['size']     = $_FILES['smd']['size'][$i];
				$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
				);
				$this->upload->initialize($config);
				$this->upload->do_upload();
				$a[] = $this->upload->data();
				rename($a[$i]['full_path'], $a[$i]['file_path'] . $namabaru . $a[$i]['file_name']);
				$data = array('nama_file'	=> $namabaru.$a[$i]['file_name'],
								'id_paket'	=> $id_paket,
								'id_tahun'	=> $id_tahun,
								'id_jenis'	=> $id_jenis,
								'id_subdok'	=>	'SUB0001');
				$this->Datafiles_model->data_add($data);
			}
		}
		if ($_FILES['smh']['name'][0]!=NULL) {
			$smhcount = count($_FILES['smh']['name']);
			for ($i = 0; $i < $smhcount; $i++){
				$_FILES['userfile']['name']     = $_FILES['smh']['name'][$i];
				$_FILES['userfile']['type']     = $_FILES['smh']['type'][$i];
				$_FILES['userfile']['tmp_name'] = $_FILES['smh']['tmp_name'][$i];
				$_FILES['userfile']['error']    = $_FILES['smh']['error'][$i];
				$_FILES['userfile']['size']     = $_FILES['smh']['size'][$i];
				$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
				);
				$this->upload->initialize($config);
				$this->upload->do_upload();
				$b[] = $this->upload->data();
				rename($b[$i]['full_path'], $b[$i]['file_path'] . $namabaru . $b[$i]['file_name']);
				$data = array('nama_file'	=> $namabaru.$b[$i]['file_name'],
								'id_paket'	=> $id_paket,
								'id_tahun'	=> $id_tahun,
								'id_jenis'	=> $id_jenis,
								'id_subdok'	=>	'SUB0002');
				$this->Datafiles_model->data_add($data);
			}
		}
		if ($_FILES['skl']['name'][0]!=NULL) {
			$sklcount = count($_FILES['skl']['name']);
			for ($i = 0; $i < $sklcount; $i++){
				$_FILES['userfile']['name']     = $_FILES['skl']['name'][$i];
				$_FILES['userfile']['type']     = $_FILES['skl']['type'][$i];
				$_FILES['userfile']['tmp_name'] = $_FILES['skl']['tmp_name'][$i];
				$_FILES['userfile']['error']    = $_FILES['skl']['error'][$i];
				$_FILES['userfile']['size']     = $_FILES['skl']['size'][$i];
				$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
				);
				$this->upload->initialize($config);
				$this->upload->do_upload();
				$c[] = $this->upload->data();
				rename($c[$i]['full_path'], $c[$i]['file_path'] . $namabaru . $c[$i]['file_name']);
				$data = array('nama_file'	=> $namabaru.$c[$i]['file_name'],
								'id_paket'	=> $id_paket,
								'id_tahun'	=> $id_tahun,
								'id_jenis'	=> $id_jenis,
								'id_subdok'	=>	'SUB0003');
				$this->Datafiles_model->data_add($data);
			}
		}
		if ($_FILES['ksb']['name'][0]!=NULL) {
			$ksbcount = count($_FILES['ksb']['name']);
			for ($i = 0; $i < $ksbcount; $i++){
				$_FILES['userfile']['name']     = $_FILES['ksb']['name'][$i];
				$_FILES['userfile']['type']     = $_FILES['ksb']['type'][$i];
				$_FILES['userfile']['tmp_name'] = $_FILES['ksb']['tmp_name'][$i];
				$_FILES['userfile']['error']    = $_FILES['ksb']['error'][$i];
				$_FILES['userfile']['size']     = $_FILES['ksb']['size'][$i];
				$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
				);
				$this->upload->initialize($config);
				$this->upload->do_upload();
				$d[] = $this->upload->data();
				rename($d[$i]['full_path'], $d[$i]['file_path'] . $namabaru . $d[$i]['file_name']);
				$data = array('nama_file'	=> $namabaru.$d[$i]['file_name'],
								'id_paket'	=> $id_paket,
								'id_tahun'	=> $id_tahun,
								'id_jenis'	=> $id_jenis,
								'id_subdok'	=>	'SUB0004');
				$this->Datafiles_model->data_add($data);
			}
		}
		if ($_FILES['pks']['name'][0]!=NULL) {
			$pkscount = count($_FILES['pks']['name']);
			for ($i = 0; $i < $pkscount; $i++){
				$_FILES['userfile']['name']     = $_FILES['pks']['name'][$i];
				$_FILES['userfile']['type']     = $_FILES['pks']['type'][$i];
				$_FILES['userfile']['tmp_name'] = $_FILES['pks']['tmp_name'][$i];
				$_FILES['userfile']['error']    = $_FILES['pks']['error'][$i];
				$_FILES['userfile']['size']     = $_FILES['pks']['size'][$i];
				$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
				);
				$this->upload->initialize($config);
				$this->upload->do_upload();
				$e[] = $this->upload->data();
				rename($e[$i]['full_path'], $e[$i]['file_path'] . $namabaru . $e[$i]['file_name']);
				$data = array('nama_file'	=> $namabaru.$e[$i]['file_name'],
								'id_paket'	=> $id_paket,
								'id_tahun'	=> $id_tahun,
								'id_jenis'	=> $id_jenis,
								'id_subdok'	=>	'SUB0005');
				$this->Datafiles_model->data_add($data);
			}
		}
		if ($_FILES['sk']['name'][0]!=NULL) {
			$skcount = count($_FILES['sk']['name']);
			for ($i = 0; $i < $skcount; $i++){
				$_FILES['userfile']['name']     = $_FILES['sk']['name'][$i];
				$_FILES['userfile']['type']     = $_FILES['sk']['type'][$i];
				$_FILES['userfile']['tmp_name'] = $_FILES['sk']['tmp_name'][$i];
				$_FILES['userfile']['error']    = $_FILES['sk']['error'][$i];
				$_FILES['userfile']['size']     = $_FILES['sk']['size'][$i];
				$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
				);
				$this->upload->initialize($config);
				$this->upload->do_upload();
				$f[] = $this->upload->data();
				rename($f[$i]['full_path'], $f[$i]['file_path'] . $namabaru . $f[$i]['file_name']);
				$data = array('nama_file'	=> $namabaru.$f[$i]['file_name'],
								'id_paket'	=> $id_paket,
								'id_tahun'	=> $id_tahun,
								'id_jenis'	=> $id_jenis,
								'id_subdok'	=>	'SUB0006');
				$this->Datafiles_model->data_add($data);
			}
		}
		$this->session->set_flashdata('berhasil', true);
		redirect('ppk/viewfile/'.$id_jenis."/".$id_paket);
	}

	//---------------------------------- 2. Kontrak -------------------------------------------
	public function kontrak()
	{
		$id_paket 	= $this->input->post('id_paket');
		$id_ppk 	= $this->session->userdata('id_ppk');
		$nama_ppk	= $this->Datappk_model->getwhereppk($id_ppk);
		$nama_ppk 	= $nama_ppk['nama_ppk'];

		$paket 		= $this->Datapaket_model->getwherepaket($id_paket);
		$id_jenis 	= $paket[0]['id_jenis'];
		$id_tahun	= $paket[0]['id_tahun'];
		$nama_paket	= $paket[0]['nama_paket'];
		$nama_tahun	= $paket[0]['nama_tahun'];
		$main_jenis	= $paket[0]['main_jenis'];
		$sub_jenis	= $paket[0]['sub_jenis'];
		$namabaru 	= $nama_tahun."-".$nama_paket."-";
		$this->load->library('upload');
		if ($_FILES['sppbj']['name'][0]!=NULL) {
			$sppbjcount = count($_FILES['sppbj']['name']);
			for ($i = 0; $i < $sppbjcount; $i++){
				$_FILES['userfile']['name']     = $_FILES['sppbj']['name'][$i];
				$_FILES['userfile']['type']     = $_FILES['sppbj']['type'][$i];
				$_FILES['userfile']['tmp_name'] = $_FILES['sppbj']['tmp_name'][$i];
				$_FILES['userfile']['error']    = $_FILES['sppbj']['error'][$i];
				$_FILES['userfile']['size']     = $_FILES['sppbj']['size'][$i];
				$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
				);
				$this->upload->initialize($config);
				$this->upload->do_upload();
				$a[] = $this->upload->data();
				rename($a[$i]['full_path'], $a[$i]['file_path'] . $namabaru . $a[$i]['file_name']);
				$data = array('nama_file'	=> $namabaru.$a[$i]['file_name'],
								'id_paket'	=> $id_paket,
								'id_tahun'	=> $id_tahun,
								'id_jenis'	=> $id_jenis,
								'id_subdok'	=>	'SUB0007');
				$this->Datafiles_model->data_add($data);
			}
		}
		if ($_FILES['spmk']['name'][0]!=NULL) {
			$spmkcount = count($_FILES['spmk']['name']);
			for ($i = 0; $i < $spmkcount; $i++){
				$_FILES['userfile']['name']     = $_FILES['spmk']['name'][$i];
				$_FILES['userfile']['type']     = $_FILES['spmk']['type'][$i];
				$_FILES['userfile']['tmp_name'] = $_FILES['spmk']['tmp_name'][$i];
				$_FILES['userfile']['error']    = $_FILES['spmk']['error'][$i];
				$_FILES['userfile']['size']     = $_FILES['spmk']['size'][$i];
				$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
				);
				$this->upload->initialize($config);
				$this->upload->do_upload();
				$b[] = $this->upload->data();
				rename($b[$i]['full_path'], $b[$i]['file_path'] . $namabaru . $b[$i]['file_name']);
				$data = array('nama_file'	=> $namabaru.$b[$i]['file_name'],
								'id_paket'	=> $id_paket,
								'id_tahun'	=> $id_tahun,
								'id_jenis'	=> $id_jenis,
								'id_subdok'	=>	'SUB0008');
				$this->Datafiles_model->data_add($data);
			}
		}
		if ($_FILES['naskon']['name'][0]!=NULL) {
			$naskoncount = count($_FILES['naskon']['name']);
			for ($i = 0; $i < $naskoncount; $i++){
				$_FILES['userfile']['name']     = $_FILES['naskon']['name'][$i];
				$_FILES['userfile']['type']     = $_FILES['naskon']['type'][$i];
				$_FILES['userfile']['tmp_name'] = $_FILES['naskon']['tmp_name'][$i];
				$_FILES['userfile']['error']    = $_FILES['naskon']['error'][$i];
				$_FILES['userfile']['size']     = $_FILES['naskon']['size'][$i];
				$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
				);
				$this->upload->initialize($config);
				$this->upload->do_upload();
				$c[] = $this->upload->data();
				rename($c[$i]['full_path'], $c[$i]['file_path'] . $namabaru . $c[$i]['file_name']);
				$data = array('nama_file'	=> $namabaru.$c[$i]['file_name'],
								'id_paket'	=> $id_paket,
								'id_tahun'	=> $id_tahun,
								'id_jenis'	=> $id_jenis,
								'id_subdok'	=>	'SUB0009');
				$this->Datafiles_model->data_add($data);
			}
		}
		if ($_FILES['rmk']['name'][0]!=NULL) {
			$rmkcount = count($_FILES['rmk']['name']);
			for ($i = 0; $i < $rmkcount; $i++){
				$_FILES['userfile']['name']     = $_FILES['rmk']['name'][$i];
				$_FILES['userfile']['type']     = $_FILES['rmk']['type'][$i];
				$_FILES['userfile']['tmp_name'] = $_FILES['rmk']['tmp_name'][$i];
				$_FILES['userfile']['error']    = $_FILES['rmk']['error'][$i];
				$_FILES['userfile']['size']     = $_FILES['rmk']['size'][$i];
				$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
				);
				$this->upload->initialize($config);
				$this->upload->do_upload();
				$d[] = $this->upload->data();
				rename($d[$i]['full_path'], $d[$i]['file_path'] . $namabaru . $d[$i]['file_name']);
				$data = array('nama_file'	=> $namabaru.$d[$i]['file_name'],
								'id_paket'	=> $id_paket,
								'id_tahun'	=> $id_tahun,
								'id_jenis'	=> $id_jenis,
								'id_subdok'	=>	'SUB0010');
				$this->Datafiles_model->data_add($data);
			}
		}
		$this->session->set_flashdata('berhasil', true);
		redirect('ppk/viewfile/'.$id_jenis."/".$id_paket);
	}

	// 3. -----------------------------------3. MC0 ---------------------------------------------------
	public function mc0()
	{
		$id_paket 	= $this->input->post('id_paket');
		$id_ppk 	= $this->session->userdata('id_ppk');
		$nama_ppk	= $this->Datappk_model->getwhereppk($id_ppk);
		$nama_ppk 	= $nama_ppk['nama_ppk'];

		$paket 		= $this->Datapaket_model->getwherepaket($id_paket);
		$id_jenis 	= $paket[0]['id_jenis'];
		$id_tahun	= $paket[0]['id_tahun'];
		$nama_paket	= $paket[0]['nama_paket'];
		$nama_tahun	= $paket[0]['nama_tahun'];
		$main_jenis	= $paket[0]['main_jenis'];
		$sub_jenis	= $paket[0]['sub_jenis'];
		$namabaru 	= $nama_tahun."-".$nama_paket."-";
		$this->load->library('upload');
		if ($_FILES['dd']['name'][0]!=NULL) {
			$ddcount = count($_FILES['dd']['name']);
			for ($i = 0; $i < $ddcount; $i++){
				$_FILES['userfile']['name']     = $_FILES['dd']['name'][$i];
				$_FILES['userfile']['type']     = $_FILES['dd']['type'][$i];
				$_FILES['userfile']['tmp_name'] = $_FILES['dd']['tmp_name'][$i];
				$_FILES['userfile']['error']    = $_FILES['dd']['error'][$i];
				$_FILES['userfile']['size']     = $_FILES['dd']['size'][$i];
				$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
				);
				$this->upload->initialize($config);
				$this->upload->do_upload();
				$a[] = $this->upload->data();
				rename($a[$i]['full_path'], $a[$i]['file_path'] . $namabaru . $a[$i]['file_name']);
				$data = array('nama_file'	=> $namabaru.$a[$i]['file_name'],
								'id_paket'	=> $id_paket,
								'id_tahun'	=> $id_tahun,
								'id_jenis'	=> $id_jenis,
								'id_subdok'	=> 'SUB0011');
				$this->Datafiles_model->data_add($data);
			}
		}
		if ($_FILES['bal_mco']['name'][0]!=NULL) {
			$bal_mcocount = count($_FILES['bal_mco']['name']);
			for ($i = 0; $i < $bal_mcocount; $i++){
				$_FILES['userfile']['name']     = $_FILES['bal_mco']['name'][$i];
				$_FILES['userfile']['type']     = $_FILES['bal_mco']['type'][$i];
				$_FILES['userfile']['tmp_name'] = $_FILES['bal_mco']['tmp_name'][$i];
				$_FILES['userfile']['error']    = $_FILES['bal_mco']['error'][$i];
				$_FILES['userfile']['size']     = $_FILES['bal_mco']['size'][$i];
				$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
				);
				$this->upload->initialize($config);
				$this->upload->do_upload();
				$b[] = $this->upload->data();
				rename($b[$i]['full_path'], $b[$i]['file_path'] . $namabaru . $b[$i]['file_name']);
				$data = array('nama_file'	=> $namabaru.$b[$i]['file_name'],
								'id_paket'	=> $id_paket,
								'id_tahun'	=> $id_tahun,
								'id_jenis'	=> $id_jenis,
								'id_subdok'	=> 'SUB0012');
				$this->Datafiles_model->data_add($data);
			}
		}
		if ($_FILES['jst_mco']['name'][0]!=NULL) {
			$jst_mcocount = count($_FILES['jst_mco']['name']);
			for ($i = 0; $i < $jst_mcocount; $i++){
				$_FILES['userfile']['name']     = $_FILES['jst_mco']['name'][$i];
				$_FILES['userfile']['type']     = $_FILES['jst_mco']['type'][$i];
				$_FILES['userfile']['tmp_name'] = $_FILES['jst_mco']['tmp_name'][$i];
				$_FILES['userfile']['error']    = $_FILES['jst_mco']['error'][$i];
				$_FILES['userfile']['size']     = $_FILES['jst_mco']['size'][$i];
				$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
				);
				$this->upload->initialize($config);
				$this->upload->do_upload();
				$c[] = $this->upload->data();
				rename($c[$i]['full_path'], $c[$i]['file_path'] . $namabaru . $c[$i]['file_name']);
				$data = array('nama_file'	=> $namabaru.$c[$i]['file_name'],
								'id_paket'	=> $id_paket,
								'id_tahun'	=> $id_tahun,
								'id_jenis'	=> $id_jenis,
								'id_subdok'	=> 'SUB0013');
				$this->Datafiles_model->data_add($data);
			}
		}
		if ($_FILES['pcm']['name'][0]!=NULL) {
			$pcmcount = count($_FILES['pcm']['name']);
			for ($i = 0; $i < $pcmcount; $i++){
				$_FILES['userfile']['name']     = $_FILES['pcm']['name'][$i];
				$_FILES['userfile']['type']     = $_FILES['pcm']['type'][$i];
				$_FILES['userfile']['tmp_name'] = $_FILES['pcm']['tmp_name'][$i];
				$_FILES['userfile']['error']    = $_FILES['pcm']['error'][$i];
				$_FILES['userfile']['size']     = $_FILES['pcm']['size'][$i];
				$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
				);
				$this->upload->initialize($config);
				$this->upload->do_upload();
				$d[] = $this->upload->data();
				rename($d[$i]['full_path'], $d[$i]['file_path'] . $namabaru . $d[$i]['file_name']);
				$data = array('nama_file'	=> $namabaru.$d[$i]['file_name'],
								'id_paket'	=> $id_paket,
								'id_tahun'	=> $id_tahun,
								'id_jenis'	=> $id_jenis,
								'id_subdok'	=> 'SUB0014');
				$this->Datafiles_model->data_add($data);
			}
		}
		$this->session->set_flashdata('berhasil', true);
		redirect('ppk/viewfile/'.$id_jenis."/".$id_paket);
	}
	//---------------------------------------- 4. Hasil Klarifikasi Pasca MC0 -----------------------
	public function pasca()
	{
		$id_paket 	= $this->input->post('id_paket');
		$id_ppk 	= $this->session->userdata('id_ppk');
		$nama_ppk	= $this->Datappk_model->getwhereppk($id_ppk);
		$nama_ppk 	= $nama_ppk['nama_ppk'];

		$paket 		= $this->Datapaket_model->getwherepaket($id_paket);
		$id_jenis 	= $paket[0]['id_jenis'];
		$id_tahun	= $paket[0]['id_tahun'];
		$nama_paket	= $paket[0]['nama_paket'];
		$nama_tahun	= $paket[0]['nama_tahun'];
		$main_jenis	= $paket[0]['main_jenis'];
		$sub_jenis	= $paket[0]['sub_jenis'];
		$namabaru 	= $nama_tahun."-".$nama_paket."-";
		$this->load->library('upload');
		if ($_FILES['boq_psc']['name'][0]!=NULL) {
			$boq_psccount = count($_FILES['boq_psc']['name']);
			for ($i = 0; $i < $boq_psccount; $i++){
				$_FILES['userfile']['name']     = $_FILES['boq_psc']['name'][$i];
				$_FILES['userfile']['type']     = $_FILES['boq_psc']['type'][$i];
				$_FILES['userfile']['tmp_name'] = $_FILES['boq_psc']['tmp_name'][$i];
				$_FILES['userfile']['error']    = $_FILES['boq_psc']['error'][$i];
				$_FILES['userfile']['size']     = $_FILES['boq_psc']['size'][$i];
				$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
				);
				$this->upload->initialize($config);
				$this->upload->do_upload();
				$a[] = $this->upload->data();
				rename($a[$i]['full_path'], $a[$i]['file_path'] . $namabaru . $a[$i]['file_name']);
				$data = array('nama_file'	=> $namabaru.$a[$i]['file_name'],
								'id_paket'	=> $id_paket,
								'id_tahun'	=> $id_tahun,
								'id_jenis'	=> $id_jenis,
								'id_subdok'	=> 'SUB0015');
				$this->Datafiles_model->data_add($data);
			}
		}
		if ($_FILES['jst_psc']['name'][0]!=NULL) {
			$jst_psccount = count($_FILES['jst_psc']['name']);
			for ($i = 0; $i < $jst_psccount; $i++){
				$_FILES['userfile']['name']     = $_FILES['jst_psc']['name'][$i];
				$_FILES['userfile']['type']     = $_FILES['jst_psc']['type'][$i];
				$_FILES['userfile']['tmp_name'] = $_FILES['jst_psc']['tmp_name'][$i];
				$_FILES['userfile']['error']    = $_FILES['jst_psc']['error'][$i];
				$_FILES['userfile']['size']     = $_FILES['jst_psc']['size'][$i];
				$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
				);
				$this->upload->initialize($config);
				$this->upload->do_upload();
				$b[] = $this->upload->data();
				rename($b[$i]['full_path'], $b[$i]['file_path'] . $namabaru . $b[$i]['file_name']);
				$data = array('nama_file'	=> $namabaru.$b[$i]['file_name'],
								'id_paket'	=> $id_paket,
								'id_tahun'	=> $id_tahun,
								'id_jenis'	=> $id_jenis,
								'id_subdok'	=> 'SUB0016');
				$this->Datafiles_model->data_add($data);
			}
		}
		if ($_FILES['slp_psc']['name'][0]!=NULL) {
			$slp_psccount = count($_FILES['slp_psc']['name']);
			for ($i = 0; $i < $slp_psccount; $i++){
				$_FILES['userfile']['name']     = $_FILES['slp_psc']['name'][$i];
				$_FILES['userfile']['type']     = $_FILES['slp_psc']['type'][$i];
				$_FILES['userfile']['tmp_name'] = $_FILES['slp_psc']['tmp_name'][$i];
				$_FILES['userfile']['error']    = $_FILES['slp_psc']['error'][$i];
				$_FILES['userfile']['size']     = $_FILES['slp_psc']['size'][$i];
				$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
				);
				$this->upload->initialize($config);
				$this->upload->do_upload();
				$c[] = $this->upload->data();
				rename($c[$i]['full_path'], $c[$i]['file_path'] . $namabaru . $c[$i]['file_name']);
				$data = array('nama_file'	=> $namabaru.$c[$i]['file_name'],
								'id_paket'	=> $id_paket,
								'id_tahun'	=> $id_tahun,
								'id_jenis'	=> $id_jenis,
								'id_subdok'	=> 'SUB0017');
				$this->Datafiles_model->data_add($data);
			}
		}
		if ($_FILES['kurva_psc']['name'][0]!=NULL) {
			$kurva_psccount = count($_FILES['kurva_psc']['name']);
			for ($i = 0; $i < $kurva_psccount; $i++){
				$_FILES['userfile']['name']     = $_FILES['kurva_psc']['name'][$i];
				$_FILES['userfile']['type']     = $_FILES['kurva_psc']['type'][$i];
				$_FILES['userfile']['tmp_name'] = $_FILES['kurva_psc']['tmp_name'][$i];
				$_FILES['userfile']['error']    = $_FILES['kurva_psc']['error'][$i];
				$_FILES['userfile']['size']     = $_FILES['kurva_psc']['size'][$i];
				$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
				);
				$this->upload->initialize($config);
				$this->upload->do_upload();
				$d[] = $this->upload->data();
				rename($d[$i]['full_path'], $d[$i]['file_path'] . $namabaru . $d[$i]['file_name']);
				$data = array('nama_file'	=> $namabaru.$d[$i]['file_name'],
								'id_paket'	=> $id_paket,
								'id_tahun'	=> $id_tahun,
								'id_jenis'	=> $id_jenis,
								'id_subdok'	=> 'SUB0018');
				$this->Datafiles_model->data_add($data);
			}
		}
		if ($_FILES['sd_psc']['name'][0]!=NULL) {
			$sd_psccount = count($_FILES['sd_psc']['name']);
			for ($i = 0; $i < $sd_psccount; $i++){
				$_FILES['userfile']['name']     = $_FILES['sd_psc']['name'][$i];
				$_FILES['userfile']['type']     = $_FILES['sd_psc']['type'][$i];
				$_FILES['userfile']['tmp_name'] = $_FILES['sd_psc']['tmp_name'][$i];
				$_FILES['userfile']['error']    = $_FILES['sd_psc']['error'][$i];
				$_FILES['userfile']['size']     = $_FILES['sd_psc']['size'][$i];
				$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
				);
				$this->upload->initialize($config);
				$this->upload->do_upload();
				$e[] = $this->upload->data();
				rename($e[$i]['full_path'], $e[$i]['file_path'] . $namabaru . $e[$i]['file_name']);
				$data = array('nama_file'	=> $namabaru.$e[$i]['file_name'],
								'id_paket'	=> $id_paket,
								'id_tahun'	=> $id_tahun,
								'id_jenis'	=> $id_jenis,
								'id_subdok'	=> 'SUB0019');
				$this->Datafiles_model->data_add($data);
			}
		}
		if ($_FILES['bakn_psc']['name'][0]!=NULL) {
			$bakn_psccount = count($_FILES['bakn_psc']['name']);
			for ($i = 0; $i < $bakn_psccount; $i++){
				$_FILES['userfile']['name']     = $_FILES['bakn_psc']['name'][$i];
				$_FILES['userfile']['type']     = $_FILES['bakn_psc']['type'][$i];
				$_FILES['userfile']['tmp_name'] = $_FILES['bakn_psc']['tmp_name'][$i];
				$_FILES['userfile']['error']    = $_FILES['bakn_psc']['error'][$i];
				$_FILES['userfile']['size']     = $_FILES['bakn_psc']['size'][$i];
				$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
				);
				$this->upload->initialize($config);
				$this->upload->do_upload();
				$e[] = $this->upload->data();
				rename($e[$i]['full_path'], $e[$i]['file_path'] . $namabaru . $e[$i]['file_name']);
				$data = array('nama_file'	=> $namabaru.$e[$i]['file_name'],
								'id_paket'	=> $id_paket,
								'id_tahun'	=> $id_tahun,
								'id_jenis'	=> $id_jenis,
								'id_subdok'	=> 'SUB0020');
				$this->Datafiles_model->data_add($data);
			}
		}
		if ($_FILES['na1']['name'][0]!=NULL) {
			$na1count = count($_FILES['na1']['name']);
			for ($i = 0; $i < $na1count; $i++){
				$_FILES['userfile']['name']     = $_FILES['na1']['name'][$i];
				$_FILES['userfile']['type']     = $_FILES['na1']['type'][$i];
				$_FILES['userfile']['tmp_name'] = $_FILES['na1']['tmp_name'][$i];
				$_FILES['userfile']['error']    = $_FILES['na1']['error'][$i];
				$_FILES['userfile']['size']     = $_FILES['na1']['size'][$i];
				$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
				);
				$this->upload->initialize($config);
				$this->upload->do_upload();
				$e[] = $this->upload->data();
				rename($e[$i]['full_path'], $e[$i]['file_path'] . $namabaru . $e[$i]['file_name']);
				$data = array('nama_file'	=> $namabaru.$e[$i]['file_name'],
								'id_paket'	=> $id_paket,
								'id_tahun'	=> $id_tahun,
								'id_jenis'	=> $id_jenis,
								'id_subdok'	=> 'SUB0021');
				$this->Datafiles_model->data_add($data);
			}
		}
		$this->session->set_flashdata('berhasil', true);
		redirect('ppk/viewfile/'.$id_jenis."/".$id_paket);
	}
	//---------------------------------------- 5. Addendum -----------------------
	public function addendum ()
	{
		$id_paket 	= $this->input->post('id_paket');
		$id_ppk 	= $this->session->userdata('id_ppk');
		$nama_ppk	= $this->Datappk_model->getwhereppk($id_ppk);
		$nama_ppk 	= $nama_ppk['nama_ppk'];

		$paket 		= $this->Datapaket_model->getwherepaket($id_paket);
		$id_jenis 	= $paket[0]['id_jenis'];
		$id_tahun	= $paket[0]['id_tahun'];
		$nama_paket	= $paket[0]['nama_paket'];
		$nama_tahun	= $paket[0]['nama_tahun'];
		$main_jenis	= $paket[0]['main_jenis'];
		$sub_jenis	= $paket[0]['sub_jenis'];
		$namabaru 	= $nama_tahun."-".$nama_paket."-";
		$this->load->library('upload');

		if ($this->input->post('topic1')) {
			if (isset($_FILES['bal_ad2'])) {
				$bal_ad2count = count($_FILES['bal_ad2']['name']);
				for ($i = 0; $i < $bal_ad2count; $i++){
					$_FILES['userfile']['name']     = $_FILES['bal_ad2']['name'][$i];
					$_FILES['userfile']['type']     = $_FILES['bal_ad2']['type'][$i];
					$_FILES['userfile']['tmp_name'] = $_FILES['bal_ad2']['tmp_name'][$i];
					$_FILES['userfile']['error']    = $_FILES['bal_ad2']['error'][$i];
					$_FILES['userfile']['size']     = $_FILES['bal_ad2']['size'][$i];
					$config = array(
						'allowed_types' => '*',
						'overwrite'	=> FALSE,
						'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
					);
					$this->upload->initialize($config);
					$this->upload->do_upload();
					$a[] = $this->upload->data();
					rename($a[$i]['full_path'], $a[$i]['file_path'] . $namabaru . $a[$i]['file_name']);
					$data = array('nama_file'	=> $namabaru.$a[$i]['file_name'],
									'id_paket'	=> $id_paket,
									'id_tahun'	=> $id_tahun,
									'id_jenis'	=> $id_jenis,
									'id_subdok'	=> 'SUB0022');
					$this->Datafiles_model->data_add($data);
				}
			}
			if (isset($_FILES['boq_ad2'])) {
				$boq_ad2count = count($_FILES['boq_ad2']['name']);
				for ($i = 0; $i < $boq_ad2count; $i++){
					$_FILES['userfile']['name']     = $_FILES['boq_ad2']['name'][$i];
					$_FILES['userfile']['type']     = $_FILES['boq_ad2']['type'][$i];
					$_FILES['userfile']['tmp_name'] = $_FILES['boq_ad2']['tmp_name'][$i];
					$_FILES['userfile']['error']    = $_FILES['boq_ad2']['error'][$i];
					$_FILES['userfile']['size']     = $_FILES['boq_ad2']['size'][$i];
					$config = array(
						'allowed_types' => '*',
						'overwrite'	=> FALSE,
						'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
					);
					$this->upload->initialize($config);
					$this->upload->do_upload();
					$b[] = $this->upload->data();
					rename($b[$i]['full_path'], $b[$i]['file_path'] . $namabaru . $b[$i]['file_name']);
					$data = array('nama_file'	=> $namabaru.$b[$i]['file_name'],
									'id_paket'	=> $id_paket,
									'id_tahun'	=> $id_tahun,
									'id_jenis'	=> $id_jenis,
									'id_subdok'	=> 'SUB0023');
					$this->Datafiles_model->data_add($data);
				}
			}
			if (isset($_FILES['jst_ad2'])) {
				$jst_ad2count = count($_FILES['jst_ad2']['name']);
				for ($i = 0; $i < $jst_ad2count; $i++){
					$_FILES['userfile']['name']     = $_FILES['jst_ad2']['name'][$i];
					$_FILES['userfile']['type']     = $_FILES['jst_ad2']['type'][$i];
					$_FILES['userfile']['tmp_name'] = $_FILES['jst_ad2']['tmp_name'][$i];
					$_FILES['userfile']['error']    = $_FILES['jst_ad2']['error'][$i];
					$_FILES['userfile']['size']     = $_FILES['jst_ad2']['size'][$i];
					$config = array(
						'allowed_types' => '*',
						'overwrite'	=> FALSE,
						'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
					);
					$this->upload->initialize($config);
					$this->upload->do_upload();
					$c[] = $this->upload->data();
					rename($c[$i]['full_path'], $c[$i]['file_path'] . $namabaru . $c[$i]['file_name']);
					$data = array('nama_file'	=> $namabaru.$c[$i]['file_name'],
									'id_paket'	=> $id_paket,
									'id_tahun'	=> $id_tahun,
									'id_jenis'	=> $id_jenis,
									'id_subdok'	=> 'SUB0024');
					$this->Datafiles_model->data_add($data);
				}
			}
			if (isset($_FILES['slp_ad2'])) {
				$slp_ad2count = count($_FILES['slp_ad2']['name']);
				for ($i = 0; $i < $slp_ad2count; $i++){
					$_FILES['userfile']['name']     = $_FILES['slp_ad2']['name'][$i];
					$_FILES['userfile']['type']     = $_FILES['slp_ad2']['type'][$i];
					$_FILES['userfile']['tmp_name'] = $_FILES['slp_ad2']['tmp_name'][$i];
					$_FILES['userfile']['error']    = $_FILES['slp_ad2']['error'][$i];
					$_FILES['userfile']['size']     = $_FILES['slp_ad2']['size'][$i];
					$config = array(
						'allowed_types' => '*',
						'overwrite'	=> FALSE,
						'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
					);
					$this->upload->initialize($config);
					$this->upload->do_upload();
					$d[] = $this->upload->data();
					rename($d[$i]['full_path'], $d[$i]['file_path'] . $namabaru . $d[$i]['file_name']);
					$data = array('nama_file'	=> $namabaru.$d[$i]['file_name'],
									'id_paket'	=> $id_paket,
									'id_tahun'	=> $id_tahun,
									'id_jenis'	=> $id_jenis,
									'id_subdok'	=> 'SUB0025');
					$this->Datafiles_model->data_add($data);
				}
			}
			if (isset($_FILES['kurva_ad2'])) {
				$kurva_ad2count = count($_FILES['kurva_ad2']['name']);
				for ($i = 0; $i < $kurva_ad2count; $i++){
					$_FILES['userfile']['name']     = $_FILES['kurva_ad2']['name'][$i];
					$_FILES['userfile']['type']     = $_FILES['kurva_ad2']['type'][$i];
					$_FILES['userfile']['tmp_name'] = $_FILES['kurva_ad2']['tmp_name'][$i];
					$_FILES['userfile']['error']    = $_FILES['kurva_ad2']['error'][$i];
					$_FILES['userfile']['size']     = $_FILES['kurva_ad2']['size'][$i];
					$config = array(
						'allowed_types' => '*',
						'overwrite'	=> FALSE,
						'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
					);
					$this->upload->initialize($config);
					$this->upload->do_upload();
					$e[] = $this->upload->data();
					rename($e[$i]['full_path'], $e[$i]['file_path'] . $namabaru . $e[$i]['file_name']);
					$data = array('nama_file'	=> $namabaru.$e[$i]['file_name'],
									'id_paket'	=> $id_paket,
									'id_tahun'	=> $id_tahun,
									'id_jenis'	=> $id_jenis,
									'id_subdok'	=> 'SUB0026');
					$this->Datafiles_model->data_add($data);
				}
			}
			if (isset($_FILES['sd_ad2'])) {
				$sd_ad2count = count($_FILES['sd_ad2']['name']);
				for ($i = 0; $i < $sd_ad2count; $i++){
					$_FILES['userfile']['name']     = $_FILES['sd_ad2']['name'][$i];
					$_FILES['userfile']['type']     = $_FILES['sd_ad2']['type'][$i];
					$_FILES['userfile']['tmp_name'] = $_FILES['sd_ad2']['tmp_name'][$i];
					$_FILES['userfile']['error']    = $_FILES['sd_ad2']['error'][$i];
					$_FILES['userfile']['size']     = $_FILES['sd_ad2']['size'][$i];
					$config = array(
						'allowed_types' => '*',
						'overwrite'	=> FALSE,
						'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
					);
					$this->upload->initialize($config);
					$this->upload->do_upload();
					$f[] = $this->upload->data();
					rename($f[$i]['full_path'], $f[$i]['file_path'] . $namabaru . $f[$i]['file_name']);
					$data = array('nama_file'	=> $namabaru.$f[$i]['file_name'],
									'id_paket'	=> $id_paket,
									'id_tahun'	=> $id_tahun,
									'id_jenis'	=> $id_jenis,
									'id_subdok'	=> 'SUB0027');
					$this->Datafiles_model->data_add($data);
				}
			}
			if (isset($_FILES['bakn_ad2'])) {
				$bakn_ad2count = count($_FILES['bakn_ad2']['name']);
				for ($i = 0; $i < $bakn_ad2count; $i++){
					$_FILES['userfile']['name']     = $_FILES['bakn_ad2']['name'][$i];
					$_FILES['userfile']['type']     = $_FILES['bakn_ad2']['type'][$i];
					$_FILES['userfile']['tmp_name'] = $_FILES['bakn_ad2']['tmp_name'][$i];
					$_FILES['userfile']['error']    = $_FILES['bakn_ad2']['error'][$i];
					$_FILES['userfile']['size']     = $_FILES['bakn_ad2']['size'][$i];
					$config = array(
						'allowed_types' => '*',
						'overwrite'	=> FALSE,
						'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
					);
					$this->upload->initialize($config);
					$this->upload->do_upload();
					$g[] = $this->upload->data();
					rename($g[$i]['full_path'], $g[$i]['file_path'] . $namabaru . $g[$i]['file_name']);
					$data = array('nama_file'	=> $namabaru.$g[$i]['file_name'],
									'id_paket'	=> $id_paket,
									'id_tahun'	=> $id_tahun,
									'id_jenis'	=> $id_jenis,
									'id_subdok'	=> 'SUB0028');
					$this->Datafiles_model->data_add($data);
				}
			}
			if (isset($_FILES['na2'])) {
				$na2count = count($_FILES['na2']['name']);
				for ($i = 0; $i < $na2count; $i++){
					$_FILES['userfile']['name']     = $_FILES['na2']['name'][$i];
					$_FILES['userfile']['type']     = $_FILES['na2']['type'][$i];
					$_FILES['userfile']['tmp_name'] = $_FILES['na2']['tmp_name'][$i];
					$_FILES['userfile']['error']    = $_FILES['na2']['error'][$i];
					$_FILES['userfile']['size']     = $_FILES['na2']['size'][$i];
					$config = array(
						'allowed_types' => '*',
						'overwrite'	=> FALSE,
						'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
					);
					$this->upload->initialize($config);
					$this->upload->do_upload();
					$h[] = $this->upload->data();
					rename($h[$i]['full_path'], $h[$i]['file_path'] . $namabaru . $h[$i]['file_name']);
					$data = array('nama_file'	=> $namabaru.$h[$i]['file_name'],
									'id_paket'	=> $id_paket,
									'id_tahun'	=> $id_tahun,
									'id_jenis'	=> $id_jenis,
									'id_subdok'	=> 'SUB0029');
					$this->Datafiles_model->data_add($data);
				}
			}
		}
		if ($this->input->post('topic2')){
			if (isset($_FILES['bal_ad3'])) {
				$bal_ad3count = count($_FILES['bal_ad3']['name']);
				for ($i = 0; $i < $bal_ad3count; $i++){
					$_FILES['userfile']['name']     = $_FILES['bal_ad3']['name'][$i];
					$_FILES['userfile']['type']     = $_FILES['bal_ad3']['type'][$i];
					$_FILES['userfile']['tmp_name'] = $_FILES['bal_ad3']['tmp_name'][$i];
					$_FILES['userfile']['error']    = $_FILES['bal_ad3']['error'][$i];
					$_FILES['userfile']['size']     = $_FILES['bal_ad3']['size'][$i];
					$config = array(
						'allowed_types' => '*',
						'overwrite'	=> FALSE,
						'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
					);
					$this->upload->initialize($config);
					$this->upload->do_upload();
					$a[] = $this->upload->data();
					rename($a[$i]['full_path'], $a[$i]['file_path'] . $namabaru . $a[$i]['file_name']);
					$data = array('nama_file'	=> $namabaru.$a[$i]['file_name'],
									'id_paket'	=> $id_paket,
									'id_tahun'	=> $id_tahun,
									'id_jenis'	=> $id_jenis,
									'id_subdok'	=> 'SUB0030');
					$this->Datafiles_model->data_add($data);
				}
			}
			if (isset($_FILES['boq_ad3'])) {
				$boq_ad3count = count($_FILES['boq_ad3']['name']);
				for ($i = 0; $i < $boq_ad3count; $i++){
					$_FILES['userfile']['name']     = $_FILES['boq_ad3']['name'][$i];
					$_FILES['userfile']['type']     = $_FILES['boq_ad3']['type'][$i];
					$_FILES['userfile']['tmp_name'] = $_FILES['boq_ad3']['tmp_name'][$i];
					$_FILES['userfile']['error']    = $_FILES['boq_ad3']['error'][$i];
					$_FILES['userfile']['size']     = $_FILES['boq_ad3']['size'][$i];
					$config = array(
						'allowed_types' => '*',
						'overwrite'	=> FALSE,
						'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
					);
					$this->upload->initialize($config);
					$this->upload->do_upload();
					$b[] = $this->upload->data();
					rename($b[$i]['full_path'], $b[$i]['file_path'] . $namabaru . $b[$i]['file_name']);
					$data = array('nama_file'	=> $namabaru.$b[$i]['file_name'],
									'id_paket'	=> $id_paket,
									'id_tahun'	=> $id_tahun,
									'id_jenis'	=> $id_jenis,
									'id_subdok'	=> 'SUB0031');
					$this->Datafiles_model->data_add($data);
				}
			}
			if (isset($_FILES['jst_ad3'])) {
				$jst_ad3count = count($_FILES['jst_ad3']['name']);
				for ($i = 0; $i < $jst_ad3count; $i++){
					$_FILES['userfile']['name']     = $_FILES['jst_ad3']['name'][$i];
					$_FILES['userfile']['type']     = $_FILES['jst_ad3']['type'][$i];
					$_FILES['userfile']['tmp_name'] = $_FILES['jst_ad3']['tmp_name'][$i];
					$_FILES['userfile']['error']    = $_FILES['jst_ad3']['error'][$i];
					$_FILES['userfile']['size']     = $_FILES['jst_ad3']['size'][$i];
					$config = array(
						'allowed_types' => '*',
						'overwrite'	=> FALSE,
						'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
					);
					$this->upload->initialize($config);
					$this->upload->do_upload();
					$c[] = $this->upload->data();
					rename($c[$i]['full_path'], $c[$i]['file_path'] . $namabaru . $c[$i]['file_name']);
					$data = array('nama_file'	=> $namabaru.$c[$i]['file_name'],
									'id_paket'	=> $id_paket,
									'id_tahun'	=> $id_tahun,
									'id_jenis'	=> $id_jenis,
									'id_subdok'	=> 'SUB0032');
					$this->Datafiles_model->data_add($data);
				}
			}
			if (isset($_FILES['slp_ad3'])) {
				$slp_ad3count = count($_FILES['slp_ad3']['name']);
				for ($i = 0; $i < $slp_ad3count; $i++){
					$_FILES['userfile']['name']     = $_FILES['slp_ad3']['name'][$i];
					$_FILES['userfile']['type']     = $_FILES['slp_ad3']['type'][$i];
					$_FILES['userfile']['tmp_name'] = $_FILES['slp_ad3']['tmp_name'][$i];
					$_FILES['userfile']['error']    = $_FILES['slp_ad3']['error'][$i];
					$_FILES['userfile']['size']     = $_FILES['slp_ad3']['size'][$i];
					$config = array(
						'allowed_types' => '*',
						'overwrite'	=> FALSE,
						'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
					);
					$this->upload->initialize($config);
					$this->upload->do_upload();
					$d[] = $this->upload->data();
					rename($d[$i]['full_path'], $d[$i]['file_path'] . $namabaru . $d[$i]['file_name']);
					$data = array('nama_file'	=> $namabaru.$d[$i]['file_name'],
									'id_paket'	=> $id_paket,
									'id_tahun'	=> $id_tahun,
									'id_jenis'	=> $id_jenis,
									'id_subdok'	=> 'SUB0033');
					$this->Datafiles_model->data_add($data);
				}
			}
			if (isset($_FILES['kurva_ad3'])) {
				$kurva_ad3count = count($_FILES['kurva_ad3']['name']);
				for ($i = 0; $i < $kurva_ad3count; $i++){
					$_FILES['userfile']['name']     = $_FILES['kurva_ad3']['name'][$i];
					$_FILES['userfile']['type']     = $_FILES['kurva_ad3']['type'][$i];
					$_FILES['userfile']['tmp_name'] = $_FILES['kurva_ad3']['tmp_name'][$i];
					$_FILES['userfile']['error']    = $_FILES['kurva_ad3']['error'][$i];
					$_FILES['userfile']['size']     = $_FILES['kurva_ad3']['size'][$i];
					$config = array(
						'allowed_types' => '*',
						'overwrite'	=> FALSE,
						'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
					);
					$this->upload->initialize($config);
					$this->upload->do_upload();
					$e[] = $this->upload->data();
					rename($e[$i]['full_path'], $e[$i]['file_path'] . $namabaru . $e[$i]['file_name']);
					$data = array('nama_file'	=> $namabaru.$e[$i]['file_name'],
									'id_paket'	=> $id_paket,
									'id_tahun'	=> $id_tahun,
									'id_jenis'	=> $id_jenis,
									'id_subdok'	=> 'SUB0034');
					$this->Datafiles_model->data_add($data);
				}
			}
			if (isset($_FILES['sd_ad3'])) {
				$sd_ad3count = count($_FILES['sd_ad3']['name']);
				for ($i = 0; $i < $sd_ad3count; $i++){
					$_FILES['userfile']['name']     = $_FILES['sd_ad3']['name'][$i];
					$_FILES['userfile']['type']     = $_FILES['sd_ad3']['type'][$i];
					$_FILES['userfile']['tmp_name'] = $_FILES['sd_ad3']['tmp_name'][$i];
					$_FILES['userfile']['error']    = $_FILES['sd_ad3']['error'][$i];
					$_FILES['userfile']['size']     = $_FILES['sd_ad3']['size'][$i];
					$config = array(
						'allowed_types' => '*',
						'overwrite'	=> FALSE,
						'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
					);
					$this->upload->initialize($config);
					$this->upload->do_upload();
					$f[] = $this->upload->data();
					rename($f[$i]['full_path'], $f[$i]['file_path'] . $namabaru . $f[$i]['file_name']);
					$data = array('nama_file'	=> $namabaru.$f[$i]['file_name'],
									'id_paket'	=> $id_paket,
									'id_tahun'	=> $id_tahun,
									'id_jenis'	=> $id_jenis,
									'id_subdok'	=> 'SUB0035');
					$this->Datafiles_model->data_add($data);
				}
			}
			if (isset($_FILES['bakn_ad3'])) {
				$bakn_ad3count = count($_FILES['bakn_ad3']['name']);
				for ($i = 0; $i < $bakn_ad3count; $i++){
					$_FILES['userfile']['name']     = $_FILES['bakn_ad3']['name'][$i];
					$_FILES['userfile']['type']     = $_FILES['bakn_ad3']['type'][$i];
					$_FILES['userfile']['tmp_name'] = $_FILES['bakn_ad3']['tmp_name'][$i];
					$_FILES['userfile']['error']    = $_FILES['bakn_ad3']['error'][$i];
					$_FILES['userfile']['size']     = $_FILES['bakn_ad3']['size'][$i];
					$config = array(
						'allowed_types' => '*',
						'overwrite'	=> FALSE,
						'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
					);
					$this->upload->initialize($config);
					$this->upload->do_upload();
					$g[] = $this->upload->data();
					rename($g[$i]['full_path'], $g[$i]['file_path'] . $namabaru . $g[$i]['file_name']);
					$data = array('nama_file'	=> $namabaru.$g[$i]['file_name'],
									'id_paket'	=> $id_paket,
									'id_tahun'	=> $id_tahun,
									'id_jenis'	=> $id_jenis,
									'id_subdok'	=> 'SUB0036');
					$this->Datafiles_model->data_add($data);
				}
			}
			if (isset($_FILES['na3'])) {
				$na3count = count($_FILES['na3']['name']);
				for ($i = 0; $i < $na3count; $i++){
					$_FILES['userfile']['name']     = $_FILES['na3']['name'][$i];
					$_FILES['userfile']['type']     = $_FILES['na3']['type'][$i];
					$_FILES['userfile']['tmp_name'] = $_FILES['na3']['tmp_name'][$i];
					$_FILES['userfile']['error']    = $_FILES['na3']['error'][$i];
					$_FILES['userfile']['size']     = $_FILES['na3']['size'][$i];
					$config = array(
						'allowed_types' => '*',
						'overwrite'	=> FALSE,
						'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
					);
					$this->upload->initialize($config);
					$this->upload->do_upload();
					$h[] = $this->upload->data();
					rename($h[$i]['full_path'], $h[$i]['file_path'] . $namabaru . $h[$i]['file_name']);
					$data = array('nama_file'	=> $namabaru.$h[$i]['file_name'],
									'id_paket'	=> $id_paket,
									'id_tahun'	=> $id_tahun,
									'id_jenis'	=> $id_jenis,
									'id_subdok'	=> 'SUB0037');
					$this->Datafiles_model->data_add($data);
				}
			}
		}
		if ($this->input->post('topic3')){
			if (isset($_FILES['bal_ad4'])) {
				$bal_ad4count = count($_FILES['bal_ad4']['name']);
				for ($i = 0; $i < $bal_ad4count; $i++){
					$_FILES['userfile']['name']     = $_FILES['bal_ad4']['name'][$i];
					$_FILES['userfile']['type']     = $_FILES['bal_ad4']['type'][$i];
					$_FILES['userfile']['tmp_name'] = $_FILES['bal_ad4']['tmp_name'][$i];
					$_FILES['userfile']['error']    = $_FILES['bal_ad4']['error'][$i];
					$_FILES['userfile']['size']     = $_FILES['bal_ad4']['size'][$i];
					$config = array(
						'allowed_types' => '*',
						'overwrite'	=> FALSE,
						'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
					);
					$this->upload->initialize($config);
					$this->upload->do_upload();
					$a[] = $this->upload->data();
					rename($a[$i]['full_path'], $a[$i]['file_path'] . $namabaru . $a[$i]['file_name']);
					$data = array('nama_file'	=> $namabaru.$a[$i]['file_name'],
									'id_paket'	=> $id_paket,
									'id_tahun'	=> $id_tahun,
									'id_jenis'	=> $id_jenis,
									'id_subdok'	=> 'SUB0038');
					$this->Datafiles_model->data_add($data);
				}
			}
			if (isset($_FILES['boq_ad4'])) {
				$boq_ad4count = count($_FILES['boq_ad4']['name']);
				for ($i = 0; $i < $boq_ad4count; $i++){
					$_FILES['userfile']['name']     = $_FILES['boq_ad4']['name'][$i];
					$_FILES['userfile']['type']     = $_FILES['boq_ad4']['type'][$i];
					$_FILES['userfile']['tmp_name'] = $_FILES['boq_ad4']['tmp_name'][$i];
					$_FILES['userfile']['error']    = $_FILES['boq_ad4']['error'][$i];
					$_FILES['userfile']['size']     = $_FILES['boq_ad4']['size'][$i];
					$config = array(
						'allowed_types' => '*',
						'overwrite'	=> FALSE,
						'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
					);
					$this->upload->initialize($config);
					$this->upload->do_upload();
					$b[] = $this->upload->data();
					rename($b[$i]['full_path'], $b[$i]['file_path'] . $namabaru . $b[$i]['file_name']);
					$data = array('nama_file'	=> $namabaru.$b[$i]['file_name'],
									'id_paket'	=> $id_paket,
									'id_tahun'	=> $id_tahun,
									'id_jenis'	=> $id_jenis,
									'id_subdok'	=> 'SUB0039');
					$this->Datafiles_model->data_add($data);
				}
			}
			if (isset($_FILES['jst_ad4'])) {
				$jst_ad4count = count($_FILES['jst_ad4']['name']);
				for ($i = 0; $i < $jst_ad4count; $i++){
					$_FILES['userfile']['name']     = $_FILES['jst_ad4']['name'][$i];
					$_FILES['userfile']['type']     = $_FILES['jst_ad4']['type'][$i];
					$_FILES['userfile']['tmp_name'] = $_FILES['jst_ad4']['tmp_name'][$i];
					$_FILES['userfile']['error']    = $_FILES['jst_ad4']['error'][$i];
					$_FILES['userfile']['size']     = $_FILES['jst_ad4']['size'][$i];
					$config = array(
						'allowed_types' => '*',
						'overwrite'	=> FALSE,
						'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
					);
					$this->upload->initialize($config);
					$this->upload->do_upload();
					$c[] = $this->upload->data();
					rename($c[$i]['full_path'], $c[$i]['file_path'] . $namabaru . $c[$i]['file_name']);
					$data = array('nama_file'	=> $namabaru.$c[$i]['file_name'],
									'id_paket'	=> $id_paket,
									'id_tahun'	=> $id_tahun,
									'id_jenis'	=> $id_jenis,
									'id_subdok'	=> 'SUB0040');
					$this->Datafiles_model->data_add($data);
				}
			}
			if (isset($_FILES['slp_ad4'])) {
				$slp_ad4count = count($_FILES['slp_ad4']['name']);
				for ($i = 0; $i < $slp_ad4count; $i++){
					$_FILES['userfile']['name']     = $_FILES['slp_ad4']['name'][$i];
					$_FILES['userfile']['type']     = $_FILES['slp_ad4']['type'][$i];
					$_FILES['userfile']['tmp_name'] = $_FILES['slp_ad4']['tmp_name'][$i];
					$_FILES['userfile']['error']    = $_FILES['slp_ad4']['error'][$i];
					$_FILES['userfile']['size']     = $_FILES['slp_ad4']['size'][$i];
					$config = array(
						'allowed_types' => '*',
						'overwrite'	=> FALSE,
						'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
					);
					$this->upload->initialize($config);
					$this->upload->do_upload();
					$d[] = $this->upload->data();
					rename($d[$i]['full_path'], $d[$i]['file_path'] . $namabaru . $d[$i]['file_name']);
					$data = array('nama_file'	=> $namabaru.$d[$i]['file_name'],
									'id_paket'	=> $id_paket,
									'id_tahun'	=> $id_tahun,
									'id_jenis'	=> $id_jenis,
									'id_subdok'	=> 'SUB0041');
					$this->Datafiles_model->data_add($data);
				}
			}
			if (isset($_FILES['kurva_ad4'])) {
				$kurva_ad4count = count($_FILES['kurva_ad4']['name']);
				for ($i = 0; $i < $kurva_ad4count; $i++){
					$_FILES['userfile']['name']     = $_FILES['kurva_ad4']['name'][$i];
					$_FILES['userfile']['type']     = $_FILES['kurva_ad4']['type'][$i];
					$_FILES['userfile']['tmp_name'] = $_FILES['kurva_ad4']['tmp_name'][$i];
					$_FILES['userfile']['error']    = $_FILES['kurva_ad4']['error'][$i];
					$_FILES['userfile']['size']     = $_FILES['kurva_ad4']['size'][$i];
					$config = array(
						'allowed_types' => '*',
						'overwrite'	=> FALSE,
						'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
					);
					$this->upload->initialize($config);
					$this->upload->do_upload();
					$e[] = $this->upload->data();
					rename($e[$i]['full_path'], $e[$i]['file_path'] . $namabaru . $e[$i]['file_name']);
					$data = array('nama_file'	=> $namabaru.$e[$i]['file_name'],
									'id_paket'	=> $id_paket,
									'id_tahun'	=> $id_tahun,
									'id_jenis'	=> $id_jenis,
									'id_subdok'	=> 'SUB0042');
					$this->Datafiles_model->data_add($data);
				}
			}
			if (isset($_FILES['sd_ad4'])) {
				$sd_ad4count = count($_FILES['sd_ad4']['name']);
				for ($i = 0; $i < $sd_ad4count; $i++){
					$_FILES['userfile']['name']     = $_FILES['sd_ad4']['name'][$i];
					$_FILES['userfile']['type']     = $_FILES['sd_ad4']['type'][$i];
					$_FILES['userfile']['tmp_name'] = $_FILES['sd_ad4']['tmp_name'][$i];
					$_FILES['userfile']['error']    = $_FILES['sd_ad4']['error'][$i];
					$_FILES['userfile']['size']     = $_FILES['sd_ad4']['size'][$i];
					$config = array(
						'allowed_types' => '*',
						'overwrite'	=> FALSE,
						'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
					);
					$this->upload->initialize($config);
					$this->upload->do_upload();
					$f[] = $this->upload->data();
					rename($f[$i]['full_path'], $f[$i]['file_path'] . $namabaru . $f[$i]['file_name']);
					$data = array('nama_file'	=> $namabaru.$f[$i]['file_name'],
									'id_paket'	=> $id_paket,
									'id_tahun'	=> $id_tahun,
									'id_jenis'	=> $id_jenis,
									'id_subdok'	=> 'SUB0043');
					$this->Datafiles_model->data_add($data);
				}
			}
			if (isset($_FILES['bakn_ad4'])) {
				$bakn_ad4count = count($_FILES['bakn_ad4']['name']);
				for ($i = 0; $i < $bakn_ad4count; $i++){
					$_FILES['userfile']['name']     = $_FILES['bakn_ad4']['name'][$i];
					$_FILES['userfile']['type']     = $_FILES['bakn_ad4']['type'][$i];
					$_FILES['userfile']['tmp_name'] = $_FILES['bakn_ad4']['tmp_name'][$i];
					$_FILES['userfile']['error']    = $_FILES['bakn_ad4']['error'][$i];
					$_FILES['userfile']['size']     = $_FILES['bakn_ad4']['size'][$i];
					$config = array(
						'allowed_types' => '*',
						'overwrite'	=> FALSE,
						'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
					);
					$this->upload->initialize($config);
					$this->upload->do_upload();
					$g[] = $this->upload->data();
					rename($g[$i]['full_path'], $g[$i]['file_path'] . $namabaru . $g[$i]['file_name']);
					$data = array('nama_file'	=> $namabaru.$g[$i]['file_name'],
									'id_paket'	=> $id_paket,
									'id_tahun'	=> $id_tahun,
									'id_jenis'	=> $id_jenis,
									'id_subdok'	=> 'SUB0044');
					$this->Datafiles_model->data_add($data);
				}
			}
			if (isset($_FILES['na4'])) {
				$na4count = count($_FILES['na4']['name']);
				for ($i = 0; $i < $na4count; $i++){
					$_FILES['userfile']['name']     = $_FILES['na4']['name'][$i];
					$_FILES['userfile']['type']     = $_FILES['na4']['type'][$i];
					$_FILES['userfile']['tmp_name'] = $_FILES['na4']['tmp_name'][$i];
					$_FILES['userfile']['error']    = $_FILES['na4']['error'][$i];
					$_FILES['userfile']['size']     = $_FILES['na4']['size'][$i];
					$config = array(
						'allowed_types' => '*',
						'overwrite'	=> FALSE,
						'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
					);
					$this->upload->initialize($config);
					$this->upload->do_upload();
					$h[] = $this->upload->data();
					rename($h[$i]['full_path'], $h[$i]['file_path'] . $namabaru . $h[$i]['file_name']);
					$data = array('nama_file'	=> $namabaru.$h[$i]['file_name'],
									'id_paket'	=> $id_paket,
									'id_tahun'	=> $id_tahun,
									'id_jenis'	=> $id_jenis,
									'id_subdok'	=> 'SUB0045');
					$this->Datafiles_model->data_add($data);
				}
			}
		}
		if ($this->input->post('topic4')){
			if (isset($_FILES['bal_ad5'])) {
				$bal_ad5count = count($_FILES['bal_ad5']['name']);
				for ($i = 0; $i < $bal_ad5count; $i++){
					$_FILES['userfile']['name']     = $_FILES['bal_ad5']['name'][$i];
					$_FILES['userfile']['type']     = $_FILES['bal_ad5']['type'][$i];
					$_FILES['userfile']['tmp_name'] = $_FILES['bal_ad5']['tmp_name'][$i];
					$_FILES['userfile']['error']    = $_FILES['bal_ad5']['error'][$i];
					$_FILES['userfile']['size']     = $_FILES['bal_ad5']['size'][$i];
					$config = array(
						'allowed_types' => '*',
						'overwrite'	=> FALSE,
						'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
					);
					$this->upload->initialize($config);
					$this->upload->do_upload();
					$a[] = $this->upload->data();
					rename($a[$i]['full_path'], $a[$i]['file_path'] . $namabaru . $a[$i]['file_name']);
					$data = array('nama_file'	=> $namabaru.$a[$i]['file_name'],
									'id_paket'	=> $id_paket,
									'id_tahun'	=> $id_tahun,
									'id_jenis'	=> $id_jenis,
									'id_subdok'	=> 'SUB0046');
					$this->Datafiles_model->data_add($data);
				}
			}
			if (isset($_FILES['boq_ad5'])) {
				$boq_ad5count = count($_FILES['boq_ad5']['name']);
				for ($i = 0; $i < $boq_ad5count; $i++){
					$_FILES['userfile']['name']     = $_FILES['boq_ad5']['name'][$i];
					$_FILES['userfile']['type']     = $_FILES['boq_ad5']['type'][$i];
					$_FILES['userfile']['tmp_name'] = $_FILES['boq_ad5']['tmp_name'][$i];
					$_FILES['userfile']['error']    = $_FILES['boq_ad5']['error'][$i];
					$_FILES['userfile']['size']     = $_FILES['boq_ad5']['size'][$i];
					$config = array(
						'allowed_types' => '*',
						'overwrite'	=> FALSE,
						'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
					);
					$this->upload->initialize($config);
					$this->upload->do_upload();
					$b[] = $this->upload->data();
					rename($b[$i]['full_path'], $b[$i]['file_path'] . $namabaru . $b[$i]['file_name']);
					$data = array('nama_file'	=> $namabaru.$b[$i]['file_name'],
									'id_paket'	=> $id_paket,
									'id_tahun'	=> $id_tahun,
									'id_jenis'	=> $id_jenis,
									'id_subdok'	=> 'SUB0047');
					$this->Datafiles_model->data_add($data);
				}
			}
			if (isset($_FILES['jst_ad5'])) {
				$jst_ad5count = count($_FILES['jst_ad5']['name']);
				for ($i = 0; $i < $jst_ad5count; $i++){
					$_FILES['userfile']['name']     = $_FILES['jst_ad5']['name'][$i];
					$_FILES['userfile']['type']     = $_FILES['jst_ad5']['type'][$i];
					$_FILES['userfile']['tmp_name'] = $_FILES['jst_ad5']['tmp_name'][$i];
					$_FILES['userfile']['error']    = $_FILES['jst_ad5']['error'][$i];
					$_FILES['userfile']['size']     = $_FILES['jst_ad5']['size'][$i];
					$config = array(
						'allowed_types' => '*',
						'overwrite'	=> FALSE,
						'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
					);
					$this->upload->initialize($config);
					$this->upload->do_upload();
					$c[] = $this->upload->data();
					rename($c[$i]['full_path'], $c[$i]['file_path'] . $namabaru . $c[$i]['file_name']);
					$data = array('nama_file'	=> $namabaru.$c[$i]['file_name'],
									'id_paket'	=> $id_paket,
									'id_tahun'	=> $id_tahun,
									'id_jenis'	=> $id_jenis,
									'id_subdok'	=> 'SUB0048');
					$this->Datafiles_model->data_add($data);
				}
			}
			if (isset($_FILES['slp_ad5'])) {
				$slp_ad5count = count($_FILES['slp_ad5']['name']);
				for ($i = 0; $i < $slp_ad5count; $i++){
					$_FILES['userfile']['name']     = $_FILES['slp_ad5']['name'][$i];
					$_FILES['userfile']['type']     = $_FILES['slp_ad5']['type'][$i];
					$_FILES['userfile']['tmp_name'] = $_FILES['slp_ad5']['tmp_name'][$i];
					$_FILES['userfile']['error']    = $_FILES['slp_ad5']['error'][$i];
					$_FILES['userfile']['size']     = $_FILES['slp_ad5']['size'][$i];
					$config = array(
						'allowed_types' => '*',
						'overwrite'	=> FALSE,
						'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
					);
					$this->upload->initialize($config);
					$this->upload->do_upload();
					$d[] = $this->upload->data();
					rename($d[$i]['full_path'], $d[$i]['file_path'] . $namabaru . $d[$i]['file_name']);
					$data = array('nama_file'	=> $namabaru.$d[$i]['file_name'],
									'id_paket'	=> $id_paket,
									'id_tahun'	=> $id_tahun,
									'id_jenis'	=> $id_jenis,
									'id_subdok'	=> 'SUB0049');
					$this->Datafiles_model->data_add($data);
				}
			}
			if (isset($_FILES['kurva_ad5'])) {
				$kurva_ad5count = count($_FILES['kurva_ad5']['name']);
				for ($i = 0; $i < $kurva_ad5count; $i++){
					$_FILES['userfile']['name']     = $_FILES['kurva_ad5']['name'][$i];
					$_FILES['userfile']['type']     = $_FILES['kurva_ad5']['type'][$i];
					$_FILES['userfile']['tmp_name'] = $_FILES['kurva_ad5']['tmp_name'][$i];
					$_FILES['userfile']['error']    = $_FILES['kurva_ad5']['error'][$i];
					$_FILES['userfile']['size']     = $_FILES['kurva_ad5']['size'][$i];
					$config = array(
						'allowed_types' => '*',
						'overwrite'	=> FALSE,
						'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
					);
					$this->upload->initialize($config);
					$this->upload->do_upload();
					$e[] = $this->upload->data();
					rename($e[$i]['full_path'], $e[$i]['file_path'] . $namabaru . $e[$i]['file_name']);
					$data = array('nama_file'	=> $namabaru.$e[$i]['file_name'],
									'id_paket'	=> $id_paket,
									'id_tahun'	=> $id_tahun,
									'id_jenis'	=> $id_jenis,
									'id_subdok'	=> 'SUB0050');
					$this->Datafiles_model->data_add($data);
				}
			}
			if (isset($_FILES['sd_ad5'])) {
				$sd_ad5count = count($_FILES['sd_ad5']['name']);
				for ($i = 0; $i < $sd_ad5count; $i++){
					$_FILES['userfile']['name']     = $_FILES['sd_ad5']['name'][$i];
					$_FILES['userfile']['type']     = $_FILES['sd_ad5']['type'][$i];
					$_FILES['userfile']['tmp_name'] = $_FILES['sd_ad5']['tmp_name'][$i];
					$_FILES['userfile']['error']    = $_FILES['sd_ad5']['error'][$i];
					$_FILES['userfile']['size']     = $_FILES['sd_ad5']['size'][$i];
					$config = array(
						'allowed_types' => '*',
						'overwrite'	=> FALSE,
						'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
					);
					$this->upload->initialize($config);
					$this->upload->do_upload();
					$f[] = $this->upload->data();
					rename($f[$i]['full_path'], $f[$i]['file_path'] . $namabaru . $f[$i]['file_name']);
					$data = array('nama_file'	=> $namabaru.$f[$i]['file_name'],
									'id_paket'	=> $id_paket,
									'id_tahun'	=> $id_tahun,
									'id_jenis'	=> $id_jenis,
									'id_subdok'	=> 'SUB0051');
					$this->Datafiles_model->data_add($data);
				}
			}
			if (isset($_FILES['bakn_ad5'])) {
				$bakn_ad5count = count($_FILES['bakn_ad5']['name']);
				for ($i = 0; $i < $bakn_ad5count; $i++){
					$_FILES['userfile']['name']     = $_FILES['bakn_ad5']['name'][$i];
					$_FILES['userfile']['type']     = $_FILES['bakn_ad5']['type'][$i];
					$_FILES['userfile']['tmp_name'] = $_FILES['bakn_ad5']['tmp_name'][$i];
					$_FILES['userfile']['error']    = $_FILES['bakn_ad5']['error'][$i];
					$_FILES['userfile']['size']     = $_FILES['bakn_ad5']['size'][$i];
					$config = array(
						'allowed_types' => '*',
						'overwrite'	=> FALSE,
						'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
					);
					$this->upload->initialize($config);
					$this->upload->do_upload();
					$g[] = $this->upload->data();
					rename($g[$i]['full_path'], $g[$i]['file_path'] . $namabaru . $g[$i]['file_name']);
					$data = array('nama_file'	=> $namabaru.$g[$i]['file_name'],
									'id_paket'	=> $id_paket,
									'id_tahun'	=> $id_tahun,
									'id_jenis'	=> $id_jenis,
									'id_subdok'	=> 'SUB0052');
					$this->Datafiles_model->data_add($data);
				}
			}
			if (isset($_FILES['na5'])) {
				$na5count = count($_FILES['na5']['name']);
				for ($i = 0; $i < $na5count; $i++){
					$_FILES['userfile']['name']     = $_FILES['na5']['name'][$i];
					$_FILES['userfile']['type']     = $_FILES['na5']['type'][$i];
					$_FILES['userfile']['tmp_name'] = $_FILES['na5']['tmp_name'][$i];
					$_FILES['userfile']['error']    = $_FILES['na5']['error'][$i];
					$_FILES['userfile']['size']     = $_FILES['na5']['size'][$i];
					$config = array(
						'allowed_types' => '*',
						'overwrite'	=> FALSE,
						'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
					);
					$this->upload->initialize($config);
					$this->upload->do_upload();
					$h[] = $this->upload->data();
					rename($h[$i]['full_path'], $h[$i]['file_path'] . $namabaru . $h[$i]['file_name']);
					$data = array('nama_file'	=> $namabaru.$h[$i]['file_name'],
									'id_paket'	=> $id_paket,
									'id_tahun'	=> $id_tahun,
									'id_jenis'	=> $id_jenis,
									'id_subdok'	=> 'SUB0053');
					$this->Datafiles_model->data_add($data);
				}
			}
		}                            
		$this->session->set_flashdata('berhasil', true);
		redirect('ppk/viewfile/'.$id_jenis."/".$id_paket);
	}
//---------------------------------------- 6. Laporan -----------------------
	public function laporan()
	{
		$id_paket 	= $this->input->post('id_paket');
		$id_ppk 	= $this->session->userdata('id_ppk');
		$nama_ppk	= $this->Datappk_model->getwhereppk($id_ppk);
		$nama_ppk 	= $nama_ppk['nama_ppk'];

		$paket 		= $this->Datapaket_model->getwherepaket($id_paket);
		$id_jenis 	= $paket[0]['id_jenis'];
		$id_tahun	= $paket[0]['id_tahun'];
		$nama_paket	= $paket[0]['nama_paket'];
		$nama_tahun	= $paket[0]['nama_tahun'];
		$main_jenis	= $paket[0]['main_jenis'];
		$sub_jenis	= $paket[0]['sub_jenis'];
		$namabaru 	= $nama_tahun."-".$nama_paket."-";
		$this->load->library('upload');
		if (isset($_FILES['lh'])) {
			$lhcount = count($_FILES['lh']['name']);
			for ($i = 0; $i < $lhcount; $i++){
				$_FILES['userfile']['name']     = $_FILES['lh']['name'][$i];
				$_FILES['userfile']['type']     = $_FILES['lh']['type'][$i];
				$_FILES['userfile']['tmp_name'] = $_FILES['lh']['tmp_name'][$i];
				$_FILES['userfile']['error']    = $_FILES['lh']['error'][$i];
				$_FILES['userfile']['size']     = $_FILES['lh']['size'][$i];
				$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
				);
				$this->upload->initialize($config);
				$this->upload->do_upload();
				$a[] = $this->upload->data();
				rename($a[$i]['full_path'], $a[$i]['file_path'] . $namabaru . $a[$i]['file_name']);
				$data = array('nama_file'	=> $namabaru.$a[$i]['file_name'],
								'id_paket'	=> $id_paket,
								'id_tahun'	=> $id_tahun,
								'id_jenis'	=> $id_jenis,
								'id_subdok'	=> 'SUB0054');
				$this->Datafiles_model->data_add($data);
			}
		}
		if (isset($_FILES['lm'])) {
			$lmcount = count($_FILES['lm']['name']);
			for ($i = 0; $i < $lmcount; $i++){
				$_FILES['userfile']['name']     = $_FILES['lm']['name'][$i];
				$_FILES['userfile']['type']     = $_FILES['lm']['type'][$i];
				$_FILES['userfile']['tmp_name'] = $_FILES['lm']['tmp_name'][$i];
				$_FILES['userfile']['error']    = $_FILES['lm']['error'][$i];
				$_FILES['userfile']['size']     = $_FILES['lm']['size'][$i];
				$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
				);
				$this->upload->initialize($config);
				$this->upload->do_upload();
				$b[] = $this->upload->data();
				rename($b[$i]['full_path'], $b[$i]['file_path'] . $namabaru . $b[$i]['file_name']);
				$data = array('nama_file'	=> $namabaru.$b[$i]['file_name'],
								'id_paket'	=> $id_paket,
								'id_tahun'	=> $id_tahun,
								'id_jenis'	=> $id_jenis,
								'id_subdok'	=> 'SUB0055');
				$this->Datafiles_model->data_add($data);
			}
		}
		if (isset($_FILES['lb'])) {
			$lbcount = count($_FILES['lb']['name']);
			for ($i = 0; $i < $lbcount; $i++){
				$_FILES['userfile']['name']     = $_FILES['lb']['name'][$i];
				$_FILES['userfile']['type']     = $_FILES['lb']['type'][$i];
				$_FILES['userfile']['tmp_name'] = $_FILES['lb']['tmp_name'][$i];
				$_FILES['userfile']['error']    = $_FILES['lb']['error'][$i];
				$_FILES['userfile']['size']     = $_FILES['lb']['size'][$i];
				$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
				);
				$this->upload->initialize($config);
				$this->upload->do_upload();
				$c[] = $this->upload->data();
				rename($c[$i]['full_path'], $c[$i]['file_path'] . $namabaru . $c[$i]['file_name']);
				$data = array('nama_file'	=> $namabaru.$c[$i]['file_name'],
								'id_paket'	=> $id_paket,
								'id_tahun'	=> $id_tahun,
								'id_jenis'	=> $id_jenis,
								'id_subdok'	=> 'SUB0056');
				$this->Datafiles_model->data_add($data);
			}
		}
		if (isset($_FILES['sp'])) {
			$spcount = count($_FILES['sp']['name']);
			for ($i = 0; $i < $spcount; $i++){
				$_FILES['userfile']['name']     = $_FILES['sp']['name'][$i];
				$_FILES['userfile']['type']     = $_FILES['sp']['type'][$i];
				$_FILES['userfile']['tmp_name'] = $_FILES['sp']['tmp_name'][$i];
				$_FILES['userfile']['error']    = $_FILES['sp']['error'][$i];
				$_FILES['userfile']['size']     = $_FILES['sp']['size'][$i];
				$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
				);
				$this->upload->initialize($config);
				$this->upload->do_upload();
				$d[] = $this->upload->data();
				rename($d[$i]['full_path'], $d[$i]['file_path'] . $namabaru . $d[$i]['file_name']);
				$data = array('nama_file'	=> $namabaru.$d[$i]['file_name'],
								'id_paket'	=> $id_paket,
								'id_tahun'	=> $id_tahun,
								'id_jenis'	=> $id_jenis,
								'id_subdok'	=> 'SUB0057');
				$this->Datafiles_model->data_add($data);
			}
		}
		$this->session->set_flashdata('berhasil', true);
		redirect('ppk/viewfile/'.$id_jenis."/".$id_paket);
	}
//---------------------------------------- 7. Uji Kualitas Konstruksi ------------------------------
	public function ujikualitas()
	{
		$id_paket 	= $this->input->post('id_paket');
		$id_ppk 	= $this->session->userdata('id_ppk');
		$nama_ppk	= $this->Datappk_model->getwhereppk($id_ppk);
		$nama_ppk 	= $nama_ppk['nama_ppk'];

		$paket 		= $this->Datapaket_model->getwherepaket($id_paket);
		$id_jenis 	= $paket[0]['id_jenis'];
		$id_tahun	= $paket[0]['id_tahun'];
		$nama_paket	= $paket[0]['nama_paket'];
		$nama_tahun	= $paket[0]['nama_tahun'];
		$main_jenis	= $paket[0]['main_jenis'];
		$sub_jenis	= $paket[0]['sub_jenis'];
		$namabaru 	= $nama_tahun."-".$nama_paket."-";
		$this->load->library('upload');
		if (isset($_FILES['bapm'])) {
			$bapmcount = count($_FILES['bapm']['name']);
			for ($i = 0; $i < $bapmcount; $i++){
				$_FILES['userfile']['name']     = $_FILES['bapm']['name'][$i];
				$_FILES['userfile']['type']     = $_FILES['bapm']['type'][$i];
				$_FILES['userfile']['tmp_name'] = $_FILES['bapm']['tmp_name'][$i];
				$_FILES['userfile']['error']    = $_FILES['bapm']['error'][$i];
				$_FILES['userfile']['size']     = $_FILES['bapm']['size'][$i];
				$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
				);
				$this->upload->initialize($config);
				$this->upload->do_upload();
				$a[] = $this->upload->data();
				rename($a[$i]['full_path'], $a[$i]['file_path'] . $namabaru . $a[$i]['file_name']);
				$data = array('nama_file'	=> $namabaru.$a[$i]['file_name'],
								'id_paket'	=> $id_paket,
								'id_tahun'	=> $id_tahun,
								'id_jenis'	=> $id_jenis,
								'id_subdok'	=> 'SUB0058');
				$this->Datafiles_model->data_add($data);
			}
		}
		$this->session->set_flashdata('berhasil', true);
		redirect('ppk/viewfile/'.$id_jenis."/".$id_paket);
	}
//---------------------------------------- 8. Show Cause Meeting  -----------------------------------
	public function scm()
	{
		$id_paket 	= $this->input->post('id_paket');
		$id_ppk 	= $this->session->userdata('id_ppk');
		$nama_ppk	= $this->Datappk_model->getwhereppk($id_ppk);
		$nama_ppk 	= $nama_ppk['nama_ppk'];

		$paket 		= $this->Datapaket_model->getwherepaket($id_paket);
		$id_jenis 	= $paket[0]['id_jenis'];
		$id_tahun	= $paket[0]['id_tahun'];
		$nama_paket	= $paket[0]['nama_paket'];
		$nama_tahun	= $paket[0]['nama_tahun'];
		$main_jenis	= $paket[0]['main_jenis'];
		$sub_jenis	= $paket[0]['sub_jenis'];
		$namabaru 	= $nama_tahun."-".$nama_paket."-";
		$this->load->library('upload');
		if (isset($_FILES['scm'])) {
			$scmcount = count($_FILES['scm']['name']);
			for ($i = 0; $i < $scmcount; $i++){
				$_FILES['userfile']['name']     = $_FILES['scm']['name'][$i];
				$_FILES['userfile']['type']     = $_FILES['scm']['type'][$i];
				$_FILES['userfile']['tmp_name'] = $_FILES['scm']['tmp_name'][$i];
				$_FILES['userfile']['error']    = $_FILES['scm']['error'][$i];
				$_FILES['userfile']['size']     = $_FILES['scm']['size'][$i];
				$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
				);
				$this->upload->initialize($config);
				$this->upload->do_upload();
				$a[] = $this->upload->data();
				rename($a[$i]['full_path'], $a[$i]['file_path'] . $namabaru . $a[$i]['file_name']);
				$data = array('nama_file'	=> $namabaru.$a[$i]['file_name'],
								'id_paket'	=> $id_paket,
								'id_tahun'	=> $id_tahun,
								'id_jenis'	=> $id_jenis,
								'id_subdok'	=> 'SUB0059');
				$this->Datafiles_model->data_add($data);
			}
		}
		$this->session->set_flashdata('berhasil', true);
		redirect('ppk/viewfile/'.$id_jenis."/".$id_paket);
	}
//---------------------------------------- 9. PHO  -----------------------------------
	public function pho ()
	{
		$id_paket 	= $this->input->post('id_paket');
		$id_ppk 	= $this->session->userdata('id_ppk');
		$nama_ppk	= $this->Datappk_model->getwhereppk($id_ppk);
		$nama_ppk 	= $nama_ppk['nama_ppk'];

		$paket 		= $this->Datapaket_model->getwherepaket($id_paket);
		$id_jenis 	= $paket[0]['id_jenis'];
		$id_tahun	= $paket[0]['id_tahun'];
		$nama_paket	= $paket[0]['nama_paket'];
		$nama_tahun	= $paket[0]['nama_tahun'];
		$main_jenis	= $paket[0]['main_jenis'];
		$sub_jenis	= $paket[0]['sub_jenis'];
		$namabaru 	= $nama_tahun."-".$nama_paket."-";
		$this->load->library('upload');
		if (isset($_FILES['sp_pho'])) {
			$sp_phocount = count($_FILES['sp_pho']['name']);
			for ($i = 0; $i < $sp_phocount; $i++){
				$_FILES['userfile']['name']     = $_FILES['sp_pho']['name'][$i];
				$_FILES['userfile']['type']     = $_FILES['sp_pho']['type'][$i];
				$_FILES['userfile']['tmp_name'] = $_FILES['sp_pho']['tmp_name'][$i];
				$_FILES['userfile']['error']    = $_FILES['sp_pho']['error'][$i];
				$_FILES['userfile']['size']     = $_FILES['sp_pho']['size'][$i];
				$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
				);
				$this->upload->initialize($config);
				$this->upload->do_upload();
				$a[] = $this->upload->data();
				rename($a[$i]['full_path'], $a[$i]['file_path'] . $namabaru . $a[$i]['file_name']);
				$data = array('nama_file'	=> $namabaru.$a[$i]['file_name'],
								'id_paket'	=> $id_paket,
								'id_tahun'	=> $id_tahun,
								'id_jenis'	=> $id_jenis,
								'id_subdok'	=> 'SUB0060');
				$this->Datafiles_model->data_add($data);
			}
		}
		if (isset($_FILES['ba_pho'])) {
			$ba_phocount = count($_FILES['ba_pho']['name']);
			for ($i = 0; $i < $ba_phocount; $i++){
				$_FILES['userfile']['name']     = $_FILES['ba_pho']['name'][$i];
				$_FILES['userfile']['type']     = $_FILES['ba_pho']['type'][$i];
				$_FILES['userfile']['tmp_name'] = $_FILES['ba_pho']['tmp_name'][$i];
				$_FILES['userfile']['error']    = $_FILES['ba_pho']['error'][$i];
				$_FILES['userfile']['size']     = $_FILES['ba_pho']['size'][$i];
				$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
				);
				$this->upload->initialize($config);
				$this->upload->do_upload();
				$b[] = $this->upload->data();
				rename($b[$i]['full_path'], $b[$i]['file_path'] . $namabaru . $b[$i]['file_name']);
				$data = array('nama_file'	=> $namabaru.$b[$i]['file_name'],
								'id_paket'	=> $id_paket,
								'id_tahun'	=> $id_tahun,
								'id_jenis'	=> $id_jenis,
								'id_subdok'	=> 'SUB0061');
				$this->Datafiles_model->data_add($data);
			}
		}
		if (isset($_FILES['basv_pho'])) {
			$basv_phocount = count($_FILES['basv_pho']['name']);
			for ($i = 0; $i < $basv_phocount; $i++){
				$_FILES['userfile']['name']     = $_FILES['basv_pho']['name'][$i];
				$_FILES['userfile']['type']     = $_FILES['basv_pho']['type'][$i];
				$_FILES['userfile']['tmp_name'] = $_FILES['basv_pho']['tmp_name'][$i];
				$_FILES['userfile']['error']    = $_FILES['basv_pho']['error'][$i];
				$_FILES['userfile']['size']     = $_FILES['basv_pho']['size'][$i];
				$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
				);
				$this->upload->initialize($config);
				$this->upload->do_upload();
				$c[] = $this->upload->data();
				rename($c[$i]['full_path'], $c[$i]['file_path'] . $namabaru . $c[$i]['file_name']);
				$data = array('nama_file'	=> $namabaru.$c[$i]['file_name'],
								'id_paket'	=> $id_paket,
								'id_tahun'	=> $id_tahun,
								'id_jenis'	=> $id_jenis,
								'id_subdok'	=> 'SUB0062');
				$this->Datafiles_model->data_add($data);
			}
		}
		if (isset($_FILES['bastp_pho'])) {
			$bastp_phocount = count($_FILES['bastp_pho']['name']);
			for ($i = 0; $i < $bastp_phocount; $i++){
				$_FILES['userfile']['name']     = $_FILES['bastp_pho']['name'][$i];
				$_FILES['userfile']['type']     = $_FILES['bastp_pho']['type'][$i];
				$_FILES['userfile']['tmp_name'] = $_FILES['bastp_pho']['tmp_name'][$i];
				$_FILES['userfile']['error']    = $_FILES['bastp_pho']['error'][$i];
				$_FILES['userfile']['size']     = $_FILES['bastp_pho']['size'][$i];
				$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
				);
				$this->upload->initialize($config);
				$this->upload->do_upload();
				$d[] = $this->upload->data();
				rename($d[$i]['full_path'], $d[$i]['file_path'] . $namabaru . $d[$i]['file_name']);
				$data = array('nama_file'	=> $namabaru.$d[$i]['file_name'],
								'id_paket'	=> $id_paket,
								'id_tahun'	=> $id_tahun,
								'id_jenis'	=> $id_jenis,
								'id_subdok'	=> 'SUB0063');
				$this->Datafiles_model->data_add($data);
			}
		}
		$this->session->set_flashdata('berhasil', true);
		redirect('ppk/viewfile/'.$id_jenis."/".$id_paket);
	}
	//---------------------------------------- 10. FHO  -----------------------------------
	public function fho ()
	{
		$id_paket 	= $this->input->post('id_paket');
		$id_ppk 	= $this->session->userdata('id_ppk');
		$nama_ppk	= $this->Datappk_model->getwhereppk($id_ppk);
		$nama_ppk 	= $nama_ppk['nama_ppk'];

		$paket 		= $this->Datapaket_model->getwherepaket($id_paket);
		$id_jenis 	= $paket[0]['id_jenis'];
		$id_tahun	= $paket[0]['id_tahun'];
		$nama_paket	= $paket[0]['nama_paket'];
		$nama_tahun	= $paket[0]['nama_tahun'];
		$main_jenis	= $paket[0]['main_jenis'];
		$sub_jenis	= $paket[0]['sub_jenis'];
		$namabaru 	= $nama_tahun."-".$nama_paket."-";
		$this->load->library('upload');
		if (isset($_FILES['sp_fho'])) {
			$sp_fhocount = count($_FILES['sp_fho']['name']);
			for ($i = 0; $i < $sp_fhocount; $i++){
				$_FILES['userfile']['name']     = $_FILES['sp_fho']['name'][$i];
				$_FILES['userfile']['type']     = $_FILES['sp_fho']['type'][$i];
				$_FILES['userfile']['tmp_name'] = $_FILES['sp_fho']['tmp_name'][$i];
				$_FILES['userfile']['error']    = $_FILES['sp_fho']['error'][$i];
				$_FILES['userfile']['size']     = $_FILES['sp_fho']['size'][$i];
				$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
				);
				$this->upload->initialize($config);
				$this->upload->do_upload();
				$a[] = $this->upload->data();
				rename($a[$i]['full_path'], $a[$i]['file_path'] . $namabaru . $a[$i]['file_name']);
				$data = array('nama_file'	=> $namabaru.$a[$i]['file_name'],
								'id_paket'	=> $id_paket,
								'id_tahun'	=> $id_tahun,
								'id_jenis'	=> $id_jenis,
								'id_subdok'	=> 'SUB0064');
				$this->Datafiles_model->data_add($data);
			}
		}
		if (isset($_FILES['ba_fho'])) {
			$ba_fhocount = count($_FILES['ba_fho']['name']);
			for ($i = 0; $i < $ba_fhocount; $i++){
				$_FILES['userfile']['name']     = $_FILES['ba_fho']['name'][$i];
				$_FILES['userfile']['type']     = $_FILES['ba_fho']['type'][$i];
				$_FILES['userfile']['tmp_name'] = $_FILES['ba_fho']['tmp_name'][$i];
				$_FILES['userfile']['error']    = $_FILES['ba_fho']['error'][$i];
				$_FILES['userfile']['size']     = $_FILES['ba_fho']['size'][$i];
				$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
				);
				$this->upload->initialize($config);
				$this->upload->do_upload();
				$b[] = $this->upload->data();
				rename($b[$i]['full_path'], $b[$i]['file_path'] . $namabaru . $b[$i]['file_name']);
				$data = array('nama_file'	=> $namabaru.$b[$i]['file_name'],
								'id_paket'	=> $id_paket,
								'id_tahun'	=> $id_tahun,
								'id_jenis'	=> $id_jenis,
								'id_subdok'	=> 'SUB0065');
				$this->Datafiles_model->data_add($data);
			}
		}
		if (isset($_FILES['basv_fho'])) {
			$basv_fhocount = count($_FILES['basv_fho']['name']);
			for ($i = 0; $i < $basv_fhocount; $i++){
				$_FILES['userfile']['name']     = $_FILES['basv_fho']['name'][$i];
				$_FILES['userfile']['type']     = $_FILES['basv_fho']['type'][$i];
				$_FILES['userfile']['tmp_name'] = $_FILES['basv_fho']['tmp_name'][$i];
				$_FILES['userfile']['error']    = $_FILES['basv_fho']['error'][$i];
				$_FILES['userfile']['size']     = $_FILES['basv_fho']['size'][$i];
				$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
				);
				$this->upload->initialize($config);
				$this->upload->do_upload();
				$c[] = $this->upload->data();
				rename($c[$i]['full_path'], $c[$i]['file_path'] . $namabaru . $c[$i]['file_name']);
				$data = array('nama_file'	=> $namabaru.$c[$i]['file_name'],
								'id_paket'	=> $id_paket,
								'id_tahun'	=> $id_tahun,
								'id_jenis'	=> $id_jenis,
								'id_subdok'	=> 'SUB0066');
				$this->Datafiles_model->data_add($data);
			}
		}
		if (isset($_FILES['bastp_fho'])) {
			$bastp_fhocount = count($_FILES['bastp_fho']['name']);
			for ($i = 0; $i < $bastp_fhocount; $i++){
				$_FILES['userfile']['name']     = $_FILES['bastp_fho']['name'][$i];
				$_FILES['userfile']['type']     = $_FILES['bastp_fho']['type'][$i];
				$_FILES['userfile']['tmp_name'] = $_FILES['bastp_fho']['tmp_name'][$i];
				$_FILES['userfile']['error']    = $_FILES['bastp_fho']['error'][$i];
				$_FILES['userfile']['size']     = $_FILES['bastp_fho']['size'][$i];
				$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
				);
				$this->upload->initialize($config);
				$this->upload->do_upload();
				$d[] = $this->upload->data();
				rename($d[$i]['full_path'], $d[$i]['file_path'] . $namabaru . $d[$i]['file_name']);
				$data = array('nama_file'	=> $namabaru.$d[$i]['file_name'],
								'id_paket'	=> $id_paket,
								'id_tahun'	=> $id_tahun,
								'id_jenis'	=> $id_jenis,
								'id_subdok'	=> 'SUB0067');
				$this->Datafiles_model->data_add($data);
			}
		}
		$this->session->set_flashdata('berhasil', true);
		redirect('ppk/viewfile/'.$id_jenis."/".$id_paket);
	}
	//---------------------------------------- 11. Dokumentasi  -------------------------------------
	public function dokumentasi()
	{
		$id_paket 	= $this->input->post('id_paket');
		$id_ppk 	= $this->session->userdata('id_ppk');
		$nama_ppk	= $this->Datappk_model->getwhereppk($id_ppk);
		$nama_ppk 	= $nama_ppk['nama_ppk'];

		$paket 		= $this->Datapaket_model->getwherepaket($id_paket);
		$id_jenis 	= $paket[0]['id_jenis'];
		$id_tahun	= $paket[0]['id_tahun'];
		$nama_paket	= $paket[0]['nama_paket'];
		$nama_tahun	= $paket[0]['nama_tahun'];
		$main_jenis	= $paket[0]['main_jenis'];
		$sub_jenis	= $paket[0]['sub_jenis'];
		$namabaru 	= $nama_tahun."-".$nama_paket."-";
		$this->load->library('upload');
		if (isset($_FILES['dok'])) {
			$dokcount = count($_FILES['dok']['name']);
			for ($i = 0; $i < $dokcount; $i++){
				$_FILES['userfile']['name']     = $_FILES['dok']['name'][$i];
				$_FILES['userfile']['type']     = $_FILES['dok']['type'][$i];
				$_FILES['userfile']['tmp_name'] = $_FILES['dok']['tmp_name'][$i];
				$_FILES['userfile']['error']    = $_FILES['dok']['error'][$i];
				$_FILES['userfile']['size']     = $_FILES['dok']['size'][$i];
				$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
				);
				$this->upload->initialize($config);
				$this->upload->do_upload();
				$a[] = $this->upload->data();
				rename($a[$i]['full_path'], $a[$i]['file_path'] . $namabaru . $a[$i]['file_name']);
				$data = array('nama_file'	=> $namabaru.$a[$i]['file_name'],
								'id_paket'	=> $id_paket,
								'id_tahun'	=> $id_tahun,
								'id_jenis'	=> $id_jenis,
								'id_subdok'	=> 'SUB0068');
				$this->Datafiles_model->data_add($data);
			}
		}
	}

// --------------------------------------------------------------------------------------------------
// --------------------------------- VIEW FILE JENIS PEMBANGUNAN ------------------------------------
// --------------------------------------------------------------------------------------------------
	public function viewfile($id_jenis, $id_paket)
	{
		$id_user = $this->session->userdata('id_user');
		$id_ppk = $this->session->userdata('id_ppk');
		$data['data_user'] = $this->Datauser_model->getwhereuser($id_user);
		$data['data_ppk']  = $this->Datappk_model->getwhereppk($id_ppk);
		$data['data_jenis']	= $this->Datajenis_model->subjeniskontraktual();

		$this->load->view('ppk/header',$data);
		$this->load->view('ppk/sidebar',$data);

		$data['where_paket'] 	= $this->Datapaket_model->wherepaket($id_paket);
		$daftarfile		= $this->Datafiles_model->daftarfile($id_paket);
		// die(print_r($daftarfile));
		foreach ($daftarfile as $r) {
			if ($r['id_subdok']=="SUB0001") {
				$data['file_smd'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0001');
			}
			if ($r['id_subdok']=="SUB0002") {
				$data['file_smh'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0002');
			}
			if ($r['id_subdok']=="SUB0003") {
				$data['file_skl'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0003');
			}
			if ($r['id_subdok']=="SUB0004") {
				$data['file_ksb'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0004');
			}
			if ($r['id_subdok']=="SUB0005") {
				$data['file_pks'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0005');
			}
			if ($r['id_subdok']=="SUB0006") {
				$data['file_sk'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0006');
			}
			if ($r['id_subdok']=="SUB0007") {
				$data['file_sppbj'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0007');
			}
			if ($r['id_subdok']=="SUB0008") {
				$data['file_spmk'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0008');
			}
			if ($r['id_subdok']=="SUB0009") {
				$data['file_naskon'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0009');
			}
			if ($r['id_subdok']=="SUB0010") {
				$data['file_rmk'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0010');
			}
			if ($r['id_subdok']=="SUB0011") {
				$data['file_dd'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0011');
			}
			if ($r['id_subdok']=="SUB0012") {
				$data['file_bal_mco'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0012');
			}
			if ($r['id_subdok']=="SUB0013") {
				$data['file_jst_mco'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0013');
			}
			if ($r['id_subdok']=="SUB0014") {
				$data['file_pcm'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0014');
			}
			if ($r['id_subdok']=="SUB0015") {
				$data['file_boq_psc'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0015');
			}
			if ($r['id_subdok']=="SUB0016") {
				$data['file_jst_psc'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0016');
			}
			if ($r['id_subdok']=="SUB0017") {
				$data['file_slp_psc'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0017');
			}
			if ($r['id_subdok']=="SUB0018") {
				$data['file_kurva_psc'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0018');
			}
			if ($r['id_subdok']=="SUB0019") {
				$data['file_sd_psc'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0019');
			}
			if ($r['id_subdok']=="SUB0020") {
				$data['file_bakn_psc'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0020');
			}
			if ($r['id_subdok']=="SUB0021") {
				$data['file_na1'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0021');
			}
			if ($r['id_subdok']=="SUB0022") {
				$data['file_bal_ad2'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0022');
			}
			if ($r['id_subdok']=="SUB0023") {
				$data['file_boq_ad2'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0023');
			}
			if ($r['id_subdok']=="SUB0024") {
				$data['file_jst_ad2'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0024');
			}
			if ($r['id_subdok']=="SUB0025") {
				$data['file_slp_ad2'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0025');
			}
			if ($r['id_subdok']=="SUB0026") {
				$data['file_kurva_ad2'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0026');
			}
			if ($r['id_subdok']=="SUB0027") {
				$data['file_sd_ad2'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0027');
			}
			if ($r['id_subdok']=="SUB0028") {
				$data['file_bakn_ad2'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0028');
			}
			if ($r['id_subdok']=="SUB0029") {
				$data['file_na2'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0029');
			}
			if ($r['id_subdok']=="SUB0030") {
				$data['file_bal_ad3'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0030');
			}
			if ($r['id_subdok']=="SUB0031") {
				$data['file_boq_ad3'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0031');
			}
			if ($r['id_subdok']=="SUB0032") {
				$data['file_jst_ad3'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0032');
			}
			if ($r['id_subdok']=="SUB0033") {
				$data['file_slp_ad3'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0033');
			}
			if ($r['id_subdok']=="SUB0034") {
				$data['file_kurva_ad3'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0034');
			}
			if ($r['id_subdok']=="SUB0035") {
				$data['file_sd_ad3'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0035');
			}
			if ($r['id_subdok']=="SUB0036") {
				$data['file_bakn_ad3'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0036');
			}
			if ($r['id_subdok']=="SUB0037") {
				$data['file_na3'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0037');
			}
			if ($r['id_subdok']=="SUB0038") {
				$data['file_bal_ad4'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0038');
			}
			if ($r['id_subdok']=="SUB0039") {
				$data['file_boq_ad4'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0039');
			}
			if ($r['id_subdok']=="SUB0040") {
				$data['file_jst_ad4'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0040');
			}
			if ($r['id_subdok']=="SUB0041") {
				$data['file_slp_ad4'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0041');
			}
			if ($r['id_subdok']=="SUB0042") {
				$data['file_kurva_ad4'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0042');
			}
			if ($r['id_subdok']=="SUB0043") {
				$data['file_sd_ad4'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0043');
			}
			if ($r['id_subdok']=="SUB0044") {
				$data['file_bakn_ad4'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0044');
			}
			if ($r['id_subdok']=="SUB0045") {
				$data['file_na4'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0045');
			}
			if ($r['id_subdok']=="SUB0046") {
				$data['file_bal_ad5'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0046');
			}
			if ($r['id_subdok']=="SUB0047") {
				$data['file_boq_ad5'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0047');
			}
			if ($r['id_subdok']=="SUB0048") {
				$data['file_jst_ad5'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0048');
			}
			if ($r['id_subdok']=="SUB0049") {
				$data['file_slp_ad5'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0049');
			}
			if ($r['id_subdok']=="SUB0050") {
				$data['file_kurva_ad5'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0050');
			}
			if ($r['id_subdok']=="SUB0051") {
				$data['file_sd_ad5'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0051');
			}
			if ($r['id_subdok']=="SUB0052") {
				$data['file_bakn_ad5'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0052');
			}
			if ($r['id_subdok']=="SUB0053") {
				$data['file_na5'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0053');
			}
			if ($r['id_subdok']=="SUB0054") {
				$data['file_lh'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0054');
			}
			if ($r['id_subdok']=="SUB0055") {
				$data['file_lm'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0055');
			}
			if ($r['id_subdok']=="SUB0056") {
				$data['file_lb'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0056');
			}
			if ($r['id_subdok']=="SUB0057") {
				$data['file_sp'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0057');
			}
			if ($r['id_subdok']=="SUB0058") {
				$data['file_bapm'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0058');
			}
			if ($r['id_subdok']=="SUB0059") {
				$data['file_scm'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0059');
			}
			if ($r['id_subdok']=="SUB0060") {
				$data['file_sp_pho'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0060');
			}
			if ($r['id_subdok']=="SUB0061") {
				$data['file_ba_pho'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0061');
			}
			if ($r['id_subdok']=="SUB0062") {
				$data['file_basv_pho'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0062');
			}
			if ($r['id_subdok']=="SUB0063") {
				$data['file_bastp_pho'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0063');
			}
			if ($r['id_subdok']=="SUB0064") {
				$data['file_sp_fho'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0064');
			}
			if ($r['id_subdok']=="SUB0065") {
				$data['file_ba_fho'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0065');
			}
			if ($r['id_subdok']=="SUB0066") {
				$data['file_basv_fho'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0066');
			}
			if ($r['id_subdok']=="SUB0067") {
				$data['file_bastp_fho'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0067');
			}
			if ($r['id_subdok']=="SUB0068") {
				$data['file_dok'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0068');
			}
		}
		$this->load->view('ppk/viewfilepembangunan',$data);
		$this->load->view('ppk/footer');
	}
// --------------------------------------------------------------------------------------------------
// ------------------------------- UPDATE FILE JENIS PEMBANGUNAN ------------------------------------
// --------------------------------------------------------------------------------------------------.
	public function updatefilepembangunan($id_jenis, $id_paket)
	{
		$id_user = $this->session->userdata('id_user');
		$id_ppk = $this->session->userdata('id_ppk');
		$data['data_user'] = $this->Datauser_model->getwhereuser($id_user);
		$data['data_ppk']  = $this->Datappk_model->getwhereppk($id_ppk);
		$data['data_jenis']	= $this->Datajenis_model->subjeniskontraktual();

		$this->load->view('ppk/header',$data);
		$this->load->view('ppk/sidebar',$data);

		$data['where_paket'] 	= $this->Datapaket_model->wherepaket($id_paket);
		$daftarfile		= $this->Datafiles_model->daftarfile($id_paket);
		// die(print_r($daftarfile));
		foreach ($daftarfile as $r) {
			if ($r['id_subdok']=="SUB0001") {
				$data['file_smd'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0001');
			}
			if ($r['id_subdok']=="SUB0002") {
				$data['file_smh'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0002');
			}
			if ($r['id_subdok']=="SUB0003") {
				$data['file_skl'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0003');
			}
			if ($r['id_subdok']=="SUB0004") {
				$data['file_ksb'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0004');
			}
			if ($r['id_subdok']=="SUB0005") {
				$data['file_pks'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0005');
			}
			if ($r['id_subdok']=="SUB0006") {
				$data['file_sk'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0006');
			}
			if ($r['id_subdok']=="SUB0007") {
				$data['file_sppbj'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0007');
			}
			if ($r['id_subdok']=="SUB0008") {
				$data['file_spmk'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0008');
			}
			if ($r['id_subdok']=="SUB0009") {
				$data['file_naskon'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0009');
			}
			if ($r['id_subdok']=="SUB0010") {
				$data['file_rmk'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0010');
			}
			if ($r['id_subdok']=="SUB0011") {
				$data['file_dd'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0011');
			}
			if ($r['id_subdok']=="SUB0012") {
				$data['file_bal_mco'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0012');
			}
			if ($r['id_subdok']=="SUB0013") {
				$data['file_jst_mco'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0013');
			}
			if ($r['id_subdok']=="SUB0014") {
				$data['file_pcm'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0014');
			}
			if ($r['id_subdok']=="SUB0015") {
				$data['file_boq_psc'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0015');
			}
			if ($r['id_subdok']=="SUB0016") {
				$data['file_jst_psc'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0016');
			}
			if ($r['id_subdok']=="SUB0017") {
				$data['file_slp_psc'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0017');
			}
			if ($r['id_subdok']=="SUB0018") {
				$data['file_kurva_psc'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0018');
			}
			if ($r['id_subdok']=="SUB0019") {
				$data['file_sd_psc'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0019');
			}
			if ($r['id_subdok']=="SUB0020") {
				$data['file_bakn_psc'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0020');
			}
			if ($r['id_subdok']=="SUB0021") {
				$data['file_na1'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0021');
			}
			if ($r['id_subdok']=="SUB0022") {
				$data['file_bal_ad2'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0022');
			}
			if ($r['id_subdok']=="SUB0023") {
				$data['file_boq_ad2'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0023');
			}
			if ($r['id_subdok']=="SUB0024") {
				$data['file_jst_ad2'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0024');
			}
			if ($r['id_subdok']=="SUB0025") {
				$data['file_slp_ad2'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0025');
			}
			if ($r['id_subdok']=="SUB0026") {
				$data['file_kurva_ad2'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0026');
			}
			if ($r['id_subdok']=="SUB0027") {
				$data['file_sd_ad2'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0027');
			}
			if ($r['id_subdok']=="SUB0028") {
				$data['file_bakn_ad2'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0028');
			}
			if ($r['id_subdok']=="SUB0029") {
				$data['file_na2'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0029');
			}
			if ($r['id_subdok']=="SUB0030") {
				$data['file_bal_ad3'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0030');
			}
			if ($r['id_subdok']=="SUB0031") {
				$data['file_boq_ad3'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0031');
			}
			if ($r['id_subdok']=="SUB0032") {
				$data['file_jst_ad3'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0032');
			}
			if ($r['id_subdok']=="SUB0033") {
				$data['file_slp_ad3'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0033');
			}
			if ($r['id_subdok']=="SUB0034") {
				$data['file_kurva_ad3'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0034');
			}
			if ($r['id_subdok']=="SUB0035") {
				$data['file_sd_ad3'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0035');
			}
			if ($r['id_subdok']=="SUB0036") {
				$data['file_bakn_ad3'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0036');
			}
			if ($r['id_subdok']=="SUB0037") {
				$data['file_na3'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0037');
			}
			if ($r['id_subdok']=="SUB0038") {
				$data['file_bal_ad4'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0038');
			}
			if ($r['id_subdok']=="SUB0039") {
				$data['file_boq_ad4'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0039');
			}
			if ($r['id_subdok']=="SUB0040") {
				$data['file_jst_ad4'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0040');
			}
			if ($r['id_subdok']=="SUB0041") {
				$data['file_slp_ad4'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0041');
			}
			if ($r['id_subdok']=="SUB0042") {
				$data['file_kurva_ad4'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0042');
			}
			if ($r['id_subdok']=="SUB0043") {
				$data['file_sd_ad4'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0043');
			}
			if ($r['id_subdok']=="SUB0044") {
				$data['file_bakn_ad4'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0044');
			}
			if ($r['id_subdok']=="SUB0045") {
				$data['file_na4'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0045');
			}
			if ($r['id_subdok']=="SUB0046") {
				$data['file_bal_ad5'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0046');
			}
			if ($r['id_subdok']=="SUB0047") {
				$data['file_boq_ad5'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0047');
			}
			if ($r['id_subdok']=="SUB0048") {
				$data['file_jst_ad5'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0048');
			}
			if ($r['id_subdok']=="SUB0049") {
				$data['file_slp_ad5'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0049');
			}
			if ($r['id_subdok']=="SUB0050") {
				$data['file_kurva_ad5'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0050');
			}
			if ($r['id_subdok']=="SUB0051") {
				$data['file_sd_ad5'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0051');
			}
			if ($r['id_subdok']=="SUB0052") {
				$data['file_bakn_ad5'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0052');
			}
			if ($r['id_subdok']=="SUB0053") {
				$data['file_na5'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0053');
			}
			if ($r['id_subdok']=="SUB0054") {
				$data['file_lh'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0054');
			}
			if ($r['id_subdok']=="SUB0055") {
				$data['file_lm'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0055');
			}
			if ($r['id_subdok']=="SUB0056") {
				$data['file_lb'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0056');
			}
			if ($r['id_subdok']=="SUB0057") {
				$data['file_sp'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0057');
			}
			if ($r['id_subdok']=="SUB0058") {
				$data['file_bapm'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0058');
			}
			if ($r['id_subdok']=="SUB0059") {
				$data['file_scm'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0059');
			}
			if ($r['id_subdok']=="SUB0060") {
				$data['file_sp_pho'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0060');
			}
			if ($r['id_subdok']=="SUB0061") {
				$data['file_ba_pho'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0061');
			}
			if ($r['id_subdok']=="SUB0062") {
				$data['file_basv_pho'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0062');
			}
			if ($r['id_subdok']=="SUB0063") {
				$data['file_bastp_pho'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0063');
			}
			if ($r['id_subdok']=="SUB0064") {
				$data['file_sp_fho'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0064');
			}
			if ($r['id_subdok']=="SUB0065") {
				$data['file_ba_fho'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0065');
			}
			if ($r['id_subdok']=="SUB0066") {
				$data['file_basv_fho'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0066');
			}
			if ($r['id_subdok']=="SUB0067") {
				$data['file_bastp_fho'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0067');
			}
			if ($r['id_subdok']=="SUB0068") {
				$data['file_dok'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0068');
			}
		}	
		$this->load->view('ppk/updatefilepembangunan',$data);
		$this->load->view('ppk/footer');
	}
// -----------------------------------------------------------------------------------------------------------
//--------------------------------------- SAVE DOKUMEN UTAMA KONSULTAN -------------------------------------
// -----------------------------------------------------------------------------------------------------------
	// 1. Laporan Perencanaan
	public function konsultan()
	{
		$id_paket 	= $this->input->post('id_paket');
		$id_ppk 	= $this->session->userdata('id_ppk');
		$nama_ppk	= $this->Datappk_model->getwhereppk($id_ppk);
		$nama_ppk 	= $nama_ppk['nama_ppk'];

		$paket 		= $this->Datapaket_model->getwherepaket($id_paket);
		$id_jenis 	= $paket[0]['id_jenis'];
		$id_tahun	= $paket[0]['id_tahun'];
		$nama_paket	= $paket[0]['nama_paket'];
		$nama_tahun	= $paket[0]['nama_tahun'];
		$main_jenis	= $paket[0]['main_jenis'];
		$sub_jenis	= $paket[0]['sub_jenis'];
		$namabaru 	= $nama_tahun."-".$nama_paket."-";
		$this->load->library('upload');
		if ($_FILES['lpn']['name'][0]!=NULL) {
			$lpncount = count($_FILES['lpn']['name']);
			for ($i = 0; $i < $lpncount; $i++){
				$_FILES['userfile']['name']     = $_FILES['lpn']['name'][$i];
				$_FILES['userfile']['type']     = $_FILES['lpn']['type'][$i];
				$_FILES['userfile']['tmp_name'] = $_FILES['lpn']['tmp_name'][$i];
				$_FILES['userfile']['error']    = $_FILES['lpn']['error'][$i];
				$_FILES['userfile']['size']     = $_FILES['lpn']['size'][$i];
				$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
				);
				$this->upload->initialize($config);
				$this->upload->do_upload();
				$a[] = $this->upload->data();
				rename($a[$i]['full_path'], $a[$i]['file_path'] . $namabaru . $a[$i]['file_name']);
				$data = array('nama_file'	=> $namabaru.$a[$i]['file_name'],
								'id_paket'	=> $id_paket,
								'id_tahun'	=> $id_tahun,
								'id_jenis'	=> $id_jenis,
								'id_subdok'	=> 'SUB0069');
				$this->Datafiles_model->data_add($data);
			}
		}
		if ($_FILES['lan']['name'][0]!=NULL) {
			$lancount = count($_FILES['lan']['name']);
			for ($i = 0; $i < $lancount; $i++){
				$_FILES['userfile']['name']     = $_FILES['lan']['name'][$i];
				$_FILES['userfile']['type']     = $_FILES['lan']['type'][$i];
				$_FILES['userfile']['tmp_name'] = $_FILES['lan']['tmp_name'][$i];
				$_FILES['userfile']['error']    = $_FILES['lan']['error'][$i];
				$_FILES['userfile']['size']     = $_FILES['lan']['size'][$i];
				$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
				);
				$this->upload->initialize($config);
				$this->upload->do_upload();
				$b[] = $this->upload->data();
				rename($b[$i]['full_path'], $b[$i]['file_path'] . $namabaru . $b[$i]['file_name']);
				$data = array('nama_file'	=> $namabaru.$b[$i]['file_name'],
								'id_paket'	=> $id_paket,
								'id_tahun'	=> $id_tahun,
								'id_jenis'	=> $id_jenis,
								'id_subdok'	=> 'SUB0070');
				$this->Datafiles_model->data_add($data);
			}
		}
		if ($_FILES['dlp']['name'][0]!=NULL) {
			$dlpcount = count($_FILES['dlp']['name']);
			for ($i = 0; $i < $dlpcount; $i++){
				$_FILES['userfile']['name']     = $_FILES['dlp']['name'][$i];
				$_FILES['userfile']['type']     = $_FILES['dlp']['type'][$i];
				$_FILES['userfile']['tmp_name'] = $_FILES['dlp']['tmp_name'][$i];
				$_FILES['userfile']['error']    = $_FILES['dlp']['error'][$i];
				$_FILES['userfile']['size']     = $_FILES['dlp']['size'][$i];
				$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
				);
				$this->upload->initialize($config);
				$this->upload->do_upload();
				$c[] = $this->upload->data();
				rename($c[$i]['full_path'], $c[$i]['file_path'] . $namabaru . $c[$i]['file_name']);
				$data = array('nama_file'	=> $namabaru.$c[$i]['file_name'],
								'id_paket'	=> $id_paket,
								'id_tahun'	=> $id_tahun,
								'id_jenis'	=> $id_jenis,
								'id_subdok'	=> 'SUB0071');
				$this->Datafiles_model->data_add($data);
			}
		}
		if ($_FILES['lak']['name'][0]!=NULL) {
			$lakcount = count($_FILES['lak']['name']);
			for ($i = 0; $i < $lakcount; $i++){
				$_FILES['userfile']['name']     = $_FILES['lak']['name'][$i];
				$_FILES['userfile']['type']     = $_FILES['lak']['type'][$i];
				$_FILES['userfile']['tmp_name'] = $_FILES['lak']['tmp_name'][$i];
				$_FILES['userfile']['error']    = $_FILES['lak']['error'][$i];
				$_FILES['userfile']['size']     = $_FILES['lak']['size'][$i];
				$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
				);
				$this->upload->initialize($config);
				$this->upload->do_upload();
				$d[] = $this->upload->data();
				rename($d[$i]['full_path'], $d[$i]['file_path'] . $namabaru . $d[$i]['file_name']);
				$data = array('nama_file'	=> $namabaru.$d[$i]['file_name'],
								'id_paket'	=> $id_paket,
								'id_tahun'	=> $id_tahun,
								'id_jenis'	=> $id_jenis,
								'id_subdok'	=> 'SUB0072');
				$this->Datafiles_model->data_add($data);
			}
		}
		$this->session->set_flashdata('berhasil', true);
		redirect('ppk/viewfilekonsultan/'.$id_jenis."/".$id_paket);
	}
// -------------------------------------------------------------------------------------------------------------
// ------------------------------------------------ VIEW & UPDATE FILE JENIS KONSULTAN --------------------------------
// -------------------------------------------------------------------------------------------------------------
	public function viewfilekonsultan($id_jenis, $id_paket)
	{
		$id_user = $this->session->userdata('id_user');
		$id_ppk = $this->session->userdata('id_ppk');
		$data['data_user'] = $this->Datauser_model->getwhereuser($id_user);
		$data['data_ppk']  = $this->Datappk_model->getwhereppk($id_ppk);
		$data['data_jenis']	= $this->Datajenis_model->subjeniskontraktual();

		$this->load->view('ppk/header',$data);
		$this->load->view('ppk/sidebar',$data);

		$data['where_paket'] 	= $this->Datapaket_model->wherepaket($id_paket);
		$daftarfile		= $this->Datafiles_model->daftarfile($id_paket);
		foreach ($daftarfile as $r) {
			if ($r['id_subdok']=="SUB0069") {
				$data['file_lpn'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0069');
			}
			if ($r['id_subdok']=="SUB0070") {
				$data['file_lan'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0070');
			}
			if ($r['id_subdok']=="SUB0071") {
				$data['file_dla'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0071');
			}
			if ($r['id_subdok']=="SUB0072") {
				$data['file_lak'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0072');
			}
		}

		$this->load->view('ppk/viewfilekonsultan',$data);
		$this->load->view('ppk/footer');
	}	
	public function updatefilekonsultan($id_jenis, $id_paket)
	{
		$id_user = $this->session->userdata('id_user');
		$id_ppk = $this->session->userdata('id_ppk');
		$data['data_user'] = $this->Datauser_model->getwhereuser($id_user);
		$data['data_ppk']  = $this->Datappk_model->getwhereppk($id_ppk);
		$data['data_jenis']	= $this->Datajenis_model->subjeniskontraktual();

		$this->load->view('ppk/header',$data);
		$this->load->view('ppk/sidebar',$data);

		$data['where_paket'] 	= $this->Datapaket_model->wherepaket($id_paket);
		$daftarfile		= $this->Datafiles_model->daftarfile($id_paket);
		foreach ($daftarfile as $r) {
			if ($r['id_subdok']=="SUB0069") {
				$data['file_lpn'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0069');
			}
			if ($r['id_subdok']=="SUB0070") {
				$data['file_lan'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0070');
			}
			if ($r['id_subdok']=="SUB0071") {
				$data['file_dla'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0071');
			}
			if ($r['id_subdok']=="SUB0072") {
				$data['file_lak'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0072');
			}
		}
		$this->load->view('ppk/updatefilekonsultan',$data);
		$this->load->view('ppk/footer');
	}
// -------------------------------------------------------------------------------------------------------------
// ------------------------------------------------ VIEW & UPDATE FILE JENIS PENGADAAN -------------------------
// -------------------------------------------------------------------------------------------------------------
	public function viewfilepengadaan($id_jenis, $id_paket)
	{
		$id_user = $this->session->userdata('id_user');
		$id_ppk = $this->session->userdata('id_ppk');
		$data['data_user'] = $this->Datauser_model->getwhereuser($id_user);
		$data['data_ppk']  = $this->Datappk_model->getwhereppk($id_ppk);
		$data['data_jenis']	= $this->Datajenis_model->subjeniskontraktual();

		$this->load->view('ppk/header',$data);
		$this->load->view('ppk/sidebar',$data);

		$data['where_paket'] 	= $this->Datapaket_model->wherepaket($id_paket);
		$daftarfile		= $this->Datafiles_model->daftarfile($id_paket);
		foreach ($daftarfile as $r) {
			if ($r['id_subdok']=="SUB0073") {
				$data['file_sm'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0073');
			}
			if ($r['id_subdok']=="SUB0074") {
				$data['file_spmh'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0074');
			}
			if ($r['id_subdok']=="SUB0075") {
				$data['file_pk'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0075');
			}
			if ($r['id_subdok']=="SUB0076") {
				$data['file_bast'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0076');
			}
			if ($r['id_subdok']=="SUB0077") {
				$data['file_sk_kemen'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0077');
			}
			if ($r['id_subdok']=="SUB0078") {
				$data['file_rekomtek'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0078');
			}
			if ($r['id_subdok']=="SUB0079") {
				$data['file_hibah_kemen'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0079');
			}
			if ($r['id_subdok']=="SUB0080") {
				$data['file_hibah_satker'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0080');
			}
			if ($r['id_subdok']=="SUB0081") {
				$data['file_naskah_hibah'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0081');
			}
			if ($r['id_subdok']=="SUB0082") {
				$data['file_ph'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0082');
			}
			if ($r['id_subdok']=="SUB0083") {
				$data['file_dh'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0083');
			}
		}

		$this->load->view('ppk/viewfilepengadaan',$data);
		$this->load->view('ppk/footer');
	}
	public function updatefilepengadaan($id_jenis, $id_paket)
	{
		$id_user = $this->session->userdata('id_user');
		$id_ppk = $this->session->userdata('id_ppk');
		$data['data_user'] = $this->Datauser_model->getwhereuser($id_user);
		$data['data_ppk']  = $this->Datappk_model->getwhereppk($id_ppk);
		$data['data_jenis']	= $this->Datajenis_model->subjeniskontraktual();

		$this->load->view('ppk/header',$data);
		$this->load->view('ppk/sidebar',$data);

		$data['where_paket'] 	= $this->Datapaket_model->wherepaket($id_paket);
		$daftarfile		= $this->Datafiles_model->daftarfile($id_paket);
		foreach ($daftarfile as $r) {
			if ($r['id_subdok']=="SUB0073") {
				$data['file_sm'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0073');
			}
			if ($r['id_subdok']=="SUB0074") {
				$data['file_spmh'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0074');
			}
			if ($r['id_subdok']=="SUB0075") {
				$data['file_pk'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0075');
			}
			if ($r['id_subdok']=="SUB0076") {
				$data['file_bast'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0076');
			}
			if ($r['id_subdok']=="SUB0077") {
				$data['file_sk_kemen'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0077');
			}
			if ($r['id_subdok']=="SUB0078") {
				$data['file_rekomtek'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0078');
			}
			if ($r['id_subdok']=="SUB0079") {
				$data['file_hibah_kemen'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0079');
			}
			if ($r['id_subdok']=="SUB0080") {
				$data['file_hibah_satker'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0080');
			}
			if ($r['id_subdok']=="SUB0081") {
				$data['file_naskah_hibah'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0081');
			}
			if ($r['id_subdok']=="SUB0082") {
				$data['file_ph'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0082');
			}
			if ($r['id_subdok']=="SUB0083") {
				$data['file_dh'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0083');
			}
		}
		$this->load->view('ppk/updatefilepengadaan',$data);
		$this->load->view('ppk/footer');
	}
// -----------------------------------------------------------------------------------------------------------
//--------------------------------------- SAVE DOKUMEN UTAMA PENGADAAN  -------------------------------------
// -----------------------------------------------------------------------------------------------------------
	public function pengadaan ()
	{
		$id_paket 	= $this->input->post('id_paket');
		$id_ppk 	= $this->session->userdata('id_ppk');
		$nama_ppk	= $this->Datappk_model->getwhereppk($id_ppk);
		$nama_ppk 	= $nama_ppk['nama_ppk'];

		$paket 		= $this->Datapaket_model->getwherepaket($id_paket);
		$id_jenis 	= $paket[0]['id_jenis'];
		$id_tahun	= $paket[0]['id_tahun'];
		$nama_paket	= $paket[0]['nama_paket'];
		$nama_tahun	= $paket[0]['nama_tahun'];
		$main_jenis	= $paket[0]['main_jenis'];
		$sub_jenis	= $paket[0]['sub_jenis'];
		$namabaru 	= $nama_tahun."-".$nama_paket."-";
		$this->load->library('upload');
		if (isset($_FILES['sm'])) {
			$smcount = count($_FILES['sm']['name']);
			for ($i = 0; $i < $smcount; $i++){
				$_FILES['userfile']['name']     = $_FILES['sm']['name'][$i];
				$_FILES['userfile']['type']     = $_FILES['sm']['type'][$i];
				$_FILES['userfile']['tmp_name'] = $_FILES['sm']['tmp_name'][$i];
				$_FILES['userfile']['error']    = $_FILES['sm']['error'][$i];
				$_FILES['userfile']['size']     = $_FILES['sm']['size'][$i];
				$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
				);
				$this->upload->initialize($config);
				$this->upload->do_upload();
				$a[] = $this->upload->data();
				rename($a[$i]['full_path'], $a[$i]['file_path'] . $namabaru . $a[$i]['file_name']);
				$data = array('nama_file'	=> $namabaru.$a[$i]['file_name'],
								'id_paket'	=> $id_paket,
								'id_tahun'	=> $id_tahun,
								'id_jenis'	=> $id_jenis,
								'id_subdok'	=> 'SUB0073');
				$this->Datafiles_model->data_add($data);
			}
		}
		if (isset($_FILES['spmh'])) {
			$spmhcount = count($_FILES['spmh']['name']);
			for ($i = 0; $i < $spmhcount; $i++){
				$_FILES['userfile']['name']     = $_FILES['spmh']['name'][$i];
				$_FILES['userfile']['type']     = $_FILES['spmh']['type'][$i];
				$_FILES['userfile']['tmp_name'] = $_FILES['spmh']['tmp_name'][$i];
				$_FILES['userfile']['error']    = $_FILES['spmh']['error'][$i];
				$_FILES['userfile']['size']     = $_FILES['spmh']['size'][$i];
				$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
				);
				$this->upload->initialize($config);
				$this->upload->do_upload();
				$b[] = $this->upload->data();
				rename($b[$i]['full_path'], $b[$i]['file_path'] . $namabaru . $b[$i]['file_name']);
				$data = array('nama_file'	=> $namabaru.$b[$i]['file_name'],
								'id_paket'	=> $id_paket,
								'id_tahun'	=> $id_tahun,
								'id_jenis'	=> $id_jenis,
								'id_subdok'	=> 'SUB0074');
				$this->Datafiles_model->data_add($data);
			}
		}
		if (isset($_FILES['pk'])) {
			$pkcount = count($_FILES['pk']['name']);
			for ($i = 0; $i < $pkcount; $i++){
				$_FILES['userfile']['name']     = $_FILES['pk']['name'][$i];
				$_FILES['userfile']['type']     = $_FILES['pk']['type'][$i];
				$_FILES['userfile']['tmp_name'] = $_FILES['pk']['tmp_name'][$i];
				$_FILES['userfile']['error']    = $_FILES['pk']['error'][$i];
				$_FILES['userfile']['size']     = $_FILES['pk']['size'][$i];
				$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
				);
				$this->upload->initialize($config);
				$this->upload->do_upload();
				$c[] = $this->upload->data();
				rename($c[$i]['full_path'], $c[$i]['file_path'] . $namabaru . $c[$i]['file_name']);
				$data = array('nama_file'	=> $namabaru.$c[$i]['file_name'],
								'id_paket'	=> $id_paket,
								'id_tahun'	=> $id_tahun,
								'id_jenis'	=> $id_jenis,
								'id_subdok'	=> 'SUB0075');
				$this->Datafiles_model->data_add($data);
			}
		}
		if (isset($_FILES['bast'])) {
			$bastcount = count($_FILES['bast']['name']);
			for ($i = 0; $i < $bastcount; $i++){
				$_FILES['userfile']['name']     = $_FILES['bast']['name'][$i];
				$_FILES['userfile']['type']     = $_FILES['bast']['type'][$i];
				$_FILES['userfile']['tmp_name'] = $_FILES['bast']['tmp_name'][$i];
				$_FILES['userfile']['error']    = $_FILES['bast']['error'][$i];
				$_FILES['userfile']['size']     = $_FILES['bast']['size'][$i];
				$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
				);
				$this->upload->initialize($config);
				$this->upload->do_upload();
				$d[] = $this->upload->data();
				rename($d[$i]['full_path'], $d[$i]['file_path'] . $namabaru . $d[$i]['file_name']);
				$data = array('nama_file'	=> $namabaru.$d[$i]['file_name'],
								'id_paket'	=> $id_paket,
								'id_tahun'	=> $id_tahun,
								'id_jenis'	=> $id_jenis,
								'id_subdok'	=> 'SUB0076');
				$this->Datafiles_model->data_add($data);
			}
		}
		if (isset($_FILES['sk_kemen'])) {
			$sk_kemencount = count($_FILES['sk_kemen']['name']);
			for ($i = 0; $i < $sk_kemencount; $i++){
				$_FILES['userfile']['name']     = $_FILES['sk_kemen']['name'][$i];
				$_FILES['userfile']['type']     = $_FILES['sk_kemen']['type'][$i];
				$_FILES['userfile']['tmp_name'] = $_FILES['sk_kemen']['tmp_name'][$i];
				$_FILES['userfile']['error']    = $_FILES['sk_kemen']['error'][$i];
				$_FILES['userfile']['size']     = $_FILES['sk_kemen']['size'][$i];
				$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
				);
				$this->upload->initialize($config);
				$this->upload->do_upload();
				$e[] = $this->upload->data();
				rename($e[$i]['full_path'], $e[$i]['file_path'] . $namabaru . $e[$i]['file_name']);
				$data = array('nama_file'	=> $namabaru.$e[$i]['file_name'],
								'id_paket'	=> $id_paket,
								'id_tahun'	=> $id_tahun,
								'id_jenis'	=> $id_jenis,
								'id_subdok'	=> 'SUB0077');
				$this->Datafiles_model->data_add($data);
			}
		}
		if (isset($_FILES['rekomtek'])) {
			$rekomtekcount = count($_FILES['rekomtek']['name']);
			for ($i = 0; $i < $rekomtekcount; $i++){
				$_FILES['userfile']['name']     = $_FILES['rekomtek']['name'][$i];
				$_FILES['userfile']['type']     = $_FILES['rekomtek']['type'][$i];
				$_FILES['userfile']['tmp_name'] = $_FILES['rekomtek']['tmp_name'][$i];
				$_FILES['userfile']['error']    = $_FILES['rekomtek']['error'][$i];
				$_FILES['userfile']['size']     = $_FILES['rekomtek']['size'][$i];
				$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
				);
				$this->upload->initialize($config);
				$this->upload->do_upload();
				$f[] = $this->upload->data();
				rename($f[$i]['full_path'], $f[$i]['file_path'] . $namabaru . $f[$i]['file_name']);
				$data = array('nama_file'	=> $namabaru.$f[$i]['file_name'],
								'id_paket'	=> $id_paket,
								'id_tahun'	=> $id_tahun,
								'id_jenis'	=> $id_jenis,
								'id_subdok'	=> 'SUB0078');
				$this->Datafiles_model->data_add($data);
			}
		}
		if (isset($_FILES['hibah_kemen'])) {
			$hibah_kemencount = count($_FILES['hibah_kemen']['name']);
			for ($i = 0; $i < $hibah_kemencount; $i++){
				$_FILES['userfile']['name']     = $_FILES['hibah_kemen']['name'][$i];
				$_FILES['userfile']['type']     = $_FILES['hibah_kemen']['type'][$i];
				$_FILES['userfile']['tmp_name'] = $_FILES['hibah_kemen']['tmp_name'][$i];
				$_FILES['userfile']['error']    = $_FILES['hibah_kemen']['error'][$i];
				$_FILES['userfile']['size']     = $_FILES['hibah_kemen']['size'][$i];
				$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
				);
				$this->upload->initialize($config);
				$this->upload->do_upload();
				$g[] = $this->upload->data();
				rename($g[$i]['full_path'], $g[$i]['file_path'] . $namabaru . $g[$i]['file_name']);
				$data = array('nama_file'	=> $namabaru.$g[$i]['file_name'],
								'id_paket'	=> $id_paket,
								'id_tahun'	=> $id_tahun,
								'id_jenis'	=> $id_jenis,
								'id_subdok'	=> 'SUB0079');
				$this->Datafiles_model->data_add($data);
			}
		}
		if (isset($_FILES['hibah_satker'])) {
			$hibah_satkercount = count($_FILES['hibah_satker']['name']);
			for ($i = 0; $i < $hibah_satkercount; $i++){
				$_FILES['userfile']['name']     = $_FILES['hibah_satker']['name'][$i];
				$_FILES['userfile']['type']     = $_FILES['hibah_satker']['type'][$i];
				$_FILES['userfile']['tmp_name'] = $_FILES['hibah_satker']['tmp_name'][$i];
				$_FILES['userfile']['error']    = $_FILES['hibah_satker']['error'][$i];
				$_FILES['userfile']['size']     = $_FILES['hibah_satker']['size'][$i];
				$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
				);
				$this->upload->initialize($config);
				$this->upload->do_upload();
				$h[] = $this->upload->data();
				rename($h[$i]['full_path'], $h[$i]['file_path'] . $namabaru . $h[$i]['file_name']);
				$data = array('nama_file'	=> $namabaru.$h[$i]['file_name'],
								'id_paket'	=> $id_paket,
								'id_tahun'	=> $id_tahun,
								'id_jenis'	=> $id_jenis,
								'id_subdok'	=> 'SUB0080');
				$this->Datafiles_model->data_add($data);
			}
		}
		if (isset($_FILES['naskah_hibah'])) {
			$naskah_hibahcount = count($_FILES['naskah_hibah']['name']);
			for ($i = 0; $i < $naskah_hibahcount; $i++){
				$_FILES['userfile']['name']     = $_FILES['naskah_hibah']['name'][$i];
				$_FILES['userfile']['type']     = $_FILES['naskah_hibah']['type'][$i];
				$_FILES['userfile']['tmp_name'] = $_FILES['naskah_hibah']['tmp_name'][$i];
				$_FILES['userfile']['error']    = $_FILES['naskah_hibah']['error'][$i];
				$_FILES['userfile']['size']     = $_FILES['naskah_hibah']['size'][$i];
				$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
				);
				$this->upload->initialize($config);
				$this->upload->do_upload();
				$j[] = $this->upload->data();
				rename($j[$i]['full_path'], $j[$i]['file_path'] . $namabaru . $j[$i]['file_name']);
				$data = array('nama_file'	=> $namabaru.$j[$i]['file_name'],
								'id_paket'	=> $id_paket,
								'id_tahun'	=> $id_tahun,
								'id_jenis'	=> $id_jenis,
								'id_subdok'	=> 'SUB0081');
				$this->Datafiles_model->data_add($data);
			}
		}
		if (isset($_FILES['ph'])) {
			$phcount = count($_FILES['ph']['name']);
			for ($i = 0; $i < $phcount; $i++){
				$_FILES['userfile']['name']     = $_FILES['ph']['name'][$i];
				$_FILES['userfile']['type']     = $_FILES['ph']['type'][$i];
				$_FILES['userfile']['tmp_name'] = $_FILES['ph']['tmp_name'][$i];
				$_FILES['userfile']['error']    = $_FILES['ph']['error'][$i];
				$_FILES['userfile']['size']     = $_FILES['ph']['size'][$i];
				$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
				);
				$this->upload->initialize($config);
				$this->upload->do_upload();
				$k[] = $this->upload->data();
				rename($k[$i]['full_path'], $k[$i]['file_path'] . $namabaru . $k[$i]['file_name']);
				$data = array('nama_file'	=> $namabaru.$k[$i]['file_name'],
								'id_paket'	=> $id_paket,
								'id_tahun'	=> $id_tahun,
								'id_jenis'	=> $id_jenis,
								'id_subdok'	=> 'SUB0082');
				$this->Datafiles_model->data_add($data);
			}
		}
		if (isset($_FILES['dh'])) {
			$dhcount = count($_FILES['dh']['name']);
			for ($i = 0; $i < $dhcount; $i++){
				$_FILES['userfile']['name']     = $_FILES['dh']['name'][$i];
				$_FILES['userfile']['type']     = $_FILES['dh']['type'][$i];
				$_FILES['userfile']['tmp_name'] = $_FILES['dh']['tmp_name'][$i];
				$_FILES['userfile']['error']    = $_FILES['dh']['error'][$i];
				$_FILES['userfile']['size']     = $_FILES['dh']['size'][$i];
				$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
				);
				$this->upload->initialize($config);
				$this->upload->do_upload();
				$k[] = $this->upload->data();
				rename($k[$i]['full_path'], $k[$i]['file_path'] . $namabaru . $k[$i]['file_name']);
				$data = array('nama_file'	=> $namabaru.$k[$i]['file_name'],
								'id_paket'	=> $id_paket,
								'id_tahun'	=> $id_tahun,
								'id_jenis'	=> $id_jenis,
								'id_subdok'	=> 'SUB0083');
				$this->Datafiles_model->data_add($data);
			}
		}
		$this->session->set_flashdata('berhasil', true);
		redirect('ppk/viewfilepengadaan/'.$id_jenis."/".$id_paket);
	}
// -------------------------------------------------------------------------------------------------------------
// ------------------------------------------------ View dan Update Swakelola -----------------------------------------------
// -------------------------------------------------------------------------------------------------------------
	public function inputdokutamaswakelola($id_jenis, $id_paket)
	{
		$id_user = $this->session->userdata('id_user');
		$id_ppk = $this->session->userdata('id_ppk');
		$data['data_user'] = $this->Datauser_model->getwhereuser($id_user);
		$data['data_ppk']  = $this->Datappk_model->getwhereppk($id_ppk);
		$data['data_jenis']	= $this->Datajenis_model->subjeniskontraktual();

		$this->load->view('ppk/header',$data);
		$this->load->view('ppk/sidebar',$data);

		$data['where_paket'] 	= $this->Datapaket_model->wherepaket($id_paket);
		$daftarfile		= $this->Datafiles_model->daftarfile($id_paket);
		foreach ($daftarfile as $r) {
			if ($r['id_subdok']=="SUB0084") {
				$data['file_swa'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0084');
			}
		}
		$this->load->view('ppk/inputdokutamaswakelola',$data);
		$this->load->view('ppk/footer');
	}

	public function viewfileswakelola($id_jenis, $id_paket)
	{
		$id_user = $this->session->userdata('id_user');
		$id_ppk = $this->session->userdata('id_ppk');
		$data['data_user'] = $this->Datauser_model->getwhereuser($id_user);
		$data['data_ppk']  = $this->Datappk_model->getwhereppk($id_ppk);
		$data['data_jenis']	= $this->Datajenis_model->subjeniskontraktual();

		$this->load->view('ppk/header',$data);
		$this->load->view('ppk/sidebar',$data);

		$data['where_paket'] 	= $this->Datapaket_model->wherepaket($id_paket);
		$daftarfile		= $this->Datafiles_model->daftarfile($id_paket);
		foreach ($daftarfile as $r) {
			if ($r['id_subdok']=="SUB0084") {
				$data['file_swa'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0084');
			}
		}
		$this->load->view('ppk/viewswakelola',$data);
		$this->load->view('ppk/footer');
	}
	// ---------------------------------------------------------------------------------------------------------
// ------------------------------------------------ Save Swakelola ---------------------------------------------
// -------------------------------------------------------------------------------------------------------------
	public function saveswakelola()
	{
		$id_paket 	= $this->input->post('id_paket');
		$id_ppk 	= $this->session->userdata('id_ppk');
		$nama_ppk	= $this->Datappk_model->getwhereppk($id_ppk);
		$nama_ppk 	= $nama_ppk['nama_ppk'];

		$paket 		= $this->Datapaket_model->getwherepaket($id_paket);
		$id_jenis 	= $paket[0]['id_jenis'];
		$id_tahun	= $paket[0]['id_tahun'];
		$nama_paket	= $paket[0]['nama_paket'];
		$nama_tahun	= $paket[0]['nama_tahun'];
		$main_jenis	= $paket[0]['main_jenis'];
		$sub_jenis	= $paket[0]['sub_jenis'];
		$namabaru 	= $nama_tahun."-".$nama_paket."-";
		$this->load->library('upload');
		if (isset($_FILES['swa'])) {
			$swacount = count($_FILES['swa']['name']);
			for ($i = 0; $i < $swacount; $i++){
				$_FILES['userfile']['name']     = $_FILES['swa']['name'][$i];
				$_FILES['userfile']['type']     = $_FILES['swa']['type'][$i];
				$_FILES['userfile']['tmp_name'] = $_FILES['swa']['tmp_name'][$i];
				$_FILES['userfile']['error']    = $_FILES['swa']['error'][$i];
				$_FILES['userfile']['size']     = $_FILES['swa']['size'][$i];
				$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$nama_paket."/"
				);
				$this->upload->initialize($config);
				$this->upload->do_upload();
				$a[] = $this->upload->data();
				rename($a[$i]['full_path'], $a[$i]['file_path'] . $namabaru . $a[$i]['file_name']);
				$data = array('nama_file'	=> $namabaru.$a[$i]['file_name'],
								'id_paket'	=> $id_paket,
								'id_tahun'	=> $id_tahun,
								'id_jenis'	=> $id_jenis,
								'id_subdok'	=> 'SUB0084');
				$this->Datafiles_model->data_add($data);
			}
		}
		$this->session->set_flashdata('berhasil', true);
		redirect('ppk/viewfileswakelola/'.$id_jenis."/".$id_paket);
	}
// -------------------------------------------------------------------------------------------------------------
// ------------------------------------------------ Dokumen Pendukung ------------------------------------------
// -------------------------------------------------------------------------------------------------------------
	// ------------------------------------------------1. BMN ------------------------------------------
	public function bmn()
	{
		$id_paket 	= $this->input->post('id_paket');
		$id_ppk 	= $this->session->userdata('id_ppk');
		$nama_ppk	= $this->Datappk_model->getwhereppk($id_ppk);
		$nama_ppk 	= $nama_ppk['nama_ppk'];

		$paket 		= $this->Datapaket_model->getwherepaket($id_paket);
		$id_jenis 	= $paket[0]['id_jenis'];
		$id_tahun	= $paket[0]['id_tahun'];
		$nama_paket	= $paket[0]['nama_paket'];
		$nama_tahun	= $paket[0]['nama_tahun'];
		$main_jenis	= $paket[0]['main_jenis'];
		$sub_jenis	= $paket[0]['sub_jenis'];
		$namabaru 	= $nama_tahun."-".$nama_paket."- Pendukung -";
		$this->load->library('upload');
		if (isset($_FILES['sas'])) {
			$sascount = count($_FILES['sas']['name']);
			for ($i = 0; $i < $sascount; $i++){
				$_FILES['userfile']['name']     = $_FILES['sas']['name'][$i];
				$_FILES['userfile']['type']     = $_FILES['sas']['type'][$i];
				$_FILES['userfile']['tmp_name'] = $_FILES['sas']['tmp_name'][$i];
				$_FILES['userfile']['error']    = $_FILES['sas']['error'][$i];
				$_FILES['userfile']['size']     = $_FILES['sas']['size'][$i];
				if ($id_jenis == 'JNS0005') {
					$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$nama_paket."/"
					);
				}
				elseif ($id_jenis != 'JNS0005') {
					$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/". $sub_jenis. "/".$nama_paket."/"
					);
				}
				$this->upload->initialize($config);
				$this->upload->do_upload();
				$a[] = $this->upload->data();
				rename($a[$i]['full_path'], $a[$i]['file_path'] . $namabaru . $a[$i]['file_name']);
				$data = array('nama_file'	=> $namabaru.$a[$i]['file_name'],
								'id_paket'	=> $id_paket,
								'id_tahun'	=> $id_tahun,
								'id_jenis'	=> $id_jenis,
								'id_subdok'	=> 'SUB0085');
				$this->Datafiles_model->data_add($data);
			}
		}
		if (isset($_FILES['rt'])) {
			$rtcount = count($_FILES['rt']['name']);
			for ($i = 0; $i < $rtcount; $i++){
				$_FILES['userfile']['name']     = $_FILES['rt']['name'][$i];
				$_FILES['userfile']['type']     = $_FILES['rt']['type'][$i];
				$_FILES['userfile']['tmp_name'] = $_FILES['rt']['tmp_name'][$i];
				$_FILES['userfile']['error']    = $_FILES['rt']['error'][$i];
				$_FILES['userfile']['size']     = $_FILES['rt']['size'][$i];
				if ($id_jenis == 'JNS0005') {
					$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$nama_paket."/"
					);
				}
				elseif ($id_jenis != 'JNS0005') {
					$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/". $sub_jenis. "/".$nama_paket."/"
					);
				}
				$this->upload->initialize($config);
				$this->upload->do_upload();
				$b[] = $this->upload->data();
				rename($b[$i]['full_path'], $b[$i]['file_path'] . $namabaru . $b[$i]['file_name']);
				$data = array('nama_file'	=> $namabaru.$b[$i]['file_name'],
								'id_paket'	=> $id_paket,
								'id_tahun'	=> $id_tahun,
								'id_jenis'	=> $id_jenis,
								'id_subdok'	=> 'SUB0086');
				$this->Datafiles_model->data_add($data);
			}
		}
		if (isset($_FILES['shkk'])) {
			$shkkcount = count($_FILES['shkk']['name']);
			for ($i = 0; $i < $shkkcount; $i++){
				$_FILES['userfile']['name']     = $_FILES['shkk']['name'][$i];
				$_FILES['userfile']['type']     = $_FILES['shkk']['type'][$i];
				$_FILES['userfile']['tmp_name'] = $_FILES['shkk']['tmp_name'][$i];
				$_FILES['userfile']['error']    = $_FILES['shkk']['error'][$i];
				$_FILES['userfile']['size']     = $_FILES['shkk']['size'][$i];
				if ($id_jenis == 'JNS0005') {
					$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$nama_paket."/"
					);
				}
				elseif ($id_jenis != 'JNS0005') {
					$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/". $sub_jenis. "/".$nama_paket."/"
					);
				}
				$this->upload->initialize($config);
				$this->upload->do_upload();
				$c[] = $this->upload->data();
				rename($c[$i]['full_path'], $c[$i]['file_path'] . $namabaru . $c[$i]['file_name']);
				$data = array('nama_file'	=> $namabaru.$c[$i]['file_name'],
								'id_paket'	=> $id_paket,
								'id_tahun'	=> $id_tahun,
								'id_jenis'	=> $id_jenis,
								'id_subdok'	=> 'SUB0087');
				$this->Datafiles_model->data_add($data);
			}
		}
		$this->session->set_flashdata('berhasil', true);
		redirect('ppk/viewfilependukung/'.$id_jenis."/".$id_paket);
	}
	// ------------------------------------------------2. SPM ------------------------------------------
	public function spm ()
	{
		$id_paket 	= $this->input->post('id_paket');
		$id_ppk 	= $this->session->userdata('id_ppk');
		$nama_ppk	= $this->Datappk_model->getwhereppk($id_ppk);
		$nama_ppk 	= $nama_ppk['nama_ppk'];

		$paket 		= $this->Datapaket_model->getwherepaket($id_paket);
		$id_jenis 	= $paket[0]['id_jenis'];
		$id_tahun	= $paket[0]['id_tahun'];
		$nama_paket	= $paket[0]['nama_paket'];
		$nama_tahun	= $paket[0]['nama_tahun'];
		$main_jenis	= $paket[0]['main_jenis'];
		$sub_jenis	= $paket[0]['sub_jenis'];
		$namabaru 	= $nama_tahun."-".$nama_paket."- Pendukung -";
		$this->load->library('upload');
		if (isset($_FILES['pp'])) {
			$ppcount = count($_FILES['pp']['name']);
			for ($i = 0; $i < $ppcount; $i++){
				$_FILES['userfile']['name']     = $_FILES['pp']['name'][$i];
				$_FILES['userfile']['type']     = $_FILES['pp']['type'][$i];
				$_FILES['userfile']['tmp_name'] = $_FILES['pp']['tmp_name'][$i];
				$_FILES['userfile']['error']    = $_FILES['pp']['error'][$i];
				$_FILES['userfile']['size']     = $_FILES['pp']['size'][$i];
				if ($id_jenis == 'JNS0005') {
					$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$nama_paket."/"
					);
				}
				elseif ($id_jenis != 'JNS0005') {
					$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/". $sub_jenis. "/".$nama_paket."/"
					);
				}
				$this->upload->initialize($config);
				$this->upload->do_upload();
				$a[] = $this->upload->data();
				rename($a[$i]['full_path'], $a[$i]['file_path'] . $namabaru . $a[$i]['file_name']);
				$data = array('nama_file'	=> $namabaru.$a[$i]['file_name'],
								'id_paket'	=> $id_paket,
								'id_tahun'	=> $id_tahun,
								'id_jenis'	=> $id_jenis,
								'id_subdok'	=> 'SUB0088');
				$this->Datafiles_model->data_add($data);
			}
		}
		if (isset($_FILES['kuitansi'])) {
			$kuitansicount = count($_FILES['kuitansi']['name']);
			for ($i = 0; $i < $kuitansicount; $i++){
				$_FILES['userfile']['name']     = $_FILES['kuitansi']['name'][$i];
				$_FILES['userfile']['type']     = $_FILES['kuitansi']['type'][$i];
				$_FILES['userfile']['tmp_name'] = $_FILES['kuitansi']['tmp_name'][$i];
				$_FILES['userfile']['error']    = $_FILES['kuitansi']['error'][$i];
				$_FILES['userfile']['size']     = $_FILES['kuitansi']['size'][$i];
				if ($id_jenis == 'JNS0005') {
					$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$nama_paket."/"
					);
				}
				elseif ($id_jenis != 'JNS0005') {
					$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/". $sub_jenis. "/".$nama_paket."/"
					);
				}
				$this->upload->initialize($config);
				$this->upload->do_upload();
				$b[] = $this->upload->data();
				rename($b[$i]['full_path'], $b[$i]['file_path'] . $namabaru . $b[$i]['file_name']);
				$data = array('nama_file'	=> $namabaru.$b[$i]['file_name'],
								'id_paket'	=> $id_paket,
								'id_tahun'	=> $id_tahun,
								'id_jenis'	=> $id_jenis,
								'id_subdok'	=> 'SUB0089');
				$this->Datafiles_model->data_add($data);
			}
		}
		if (isset($_FILES['karwas'])) {
			$karwascount = count($_FILES['karwas']['name']);
			for ($i = 0; $i < $karwascount; $i++){
				$_FILES['userfile']['name']     = $_FILES['karwas']['name'][$i];
				$_FILES['userfile']['type']     = $_FILES['karwas']['type'][$i];
				$_FILES['userfile']['tmp_name'] = $_FILES['karwas']['tmp_name'][$i];
				$_FILES['userfile']['error']    = $_FILES['karwas']['error'][$i];
				$_FILES['userfile']['size']     = $_FILES['karwas']['size'][$i];
				if ($id_jenis == 'JNS0005') {
					$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$nama_paket."/"
					);
				}
				elseif ($id_jenis != 'JNS0005') {
					$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/". $sub_jenis. "/".$nama_paket."/"
					);
				}
				$this->upload->initialize($config);
				$this->upload->do_upload();
				$c[] = $this->upload->data();
				rename($c[$i]['full_path'], $c[$i]['file_path'] . $namabaru . $c[$i]['file_name']);
				$data = array('nama_file'	=> $namabaru.$c[$i]['file_name'],
								'id_paket'	=> $id_paket,
								'id_tahun'	=> $id_tahun,
								'id_jenis'	=> $id_jenis,
								'id_subdok'	=> 'SUB0090');
				$this->Datafiles_model->data_add($data);
			}
		}
		if (isset($_FILES['fp'])) {
			$fpcount = count($_FILES['fp']['name']);
			for ($i = 0; $i < $fpcount; $i++){
				$_FILES['userfile']['name']     = $_FILES['fp']['name'][$i];
				$_FILES['userfile']['type']     = $_FILES['fp']['type'][$i];
				$_FILES['userfile']['tmp_name'] = $_FILES['fp']['tmp_name'][$i];
				$_FILES['userfile']['error']    = $_FILES['fp']['error'][$i];
				$_FILES['userfile']['size']     = $_FILES['fp']['size'][$i];
				if ($id_jenis == 'JNS0005') {
					$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$nama_paket."/"
					);
				}
				elseif ($id_jenis != 'JNS0005') {
					$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/". $sub_jenis. "/".$nama_paket."/"
					);
				}
				$this->upload->initialize($config);
				$this->upload->do_upload();
				$d[] = $this->upload->data();
				rename($d[$i]['full_path'], $d[$i]['file_path'] . $namabaru . $d[$i]['file_name']);
				$data = array('nama_file'	=> $namabaru.$d[$i]['file_name'],
								'id_paket'	=> $id_paket,
								'id_tahun'	=> $id_tahun,
								'id_jenis'	=> $id_jenis,
								'id_subdok'	=> 'SUB0091');
				$this->Datafiles_model->data_add($data);
			}
		}
		if (isset($_FILES['ppn'])) {
			$ppncount = count($_FILES['ppn']['name']);
			for ($i = 0; $i < $ppncount; $i++){
				$_FILES['userfile']['name']     = $_FILES['ppn']['name'][$i];
				$_FILES['userfile']['type']     = $_FILES['ppn']['type'][$i];
				$_FILES['userfile']['tmp_name'] = $_FILES['ppn']['tmp_name'][$i];
				$_FILES['userfile']['error']    = $_FILES['ppn']['error'][$i];
				$_FILES['userfile']['size']     = $_FILES['ppn']['size'][$i];
				if ($id_jenis == 'JNS0005') {
					$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$nama_paket."/"
					);
				}
				elseif ($id_jenis != 'JNS0005') {
					$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/". $sub_jenis. "/".$nama_paket."/"
					);
				}
				$this->upload->initialize($config);
				$this->upload->do_upload();
				$e[] = $this->upload->data();
				rename($e[$i]['full_path'], $e[$i]['file_path'] . $namabaru . $e[$i]['file_name']);
				$data = array('nama_file'	=> $namabaru.$e[$i]['file_name'],
								'id_paket'	=> $id_paket,
								'id_tahun'	=> $id_tahun,
								'id_jenis'	=> $id_jenis,
								'id_subdok'	=> 'SUB0092');
				$this->Datafiles_model->data_add($data);
			}
		}
		if (isset($_FILES['spp'])) {
			$sppcount = count($_FILES['spp']['name']);
			for ($i = 0; $i < $sppcount; $i++){
				$_FILES['userfile']['name']     = $_FILES['spp']['name'][$i];
				$_FILES['userfile']['type']     = $_FILES['spp']['type'][$i];
				$_FILES['userfile']['tmp_name'] = $_FILES['spp']['tmp_name'][$i];
				$_FILES['userfile']['error']    = $_FILES['spp']['error'][$i];
				$_FILES['userfile']['size']     = $_FILES['spp']['size'][$i];
				if ($id_jenis == 'JNS0005') {
					$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$nama_paket."/"
					);
				}
				elseif ($id_jenis != 'JNS0005') {
					$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/". $sub_jenis. "/".$nama_paket."/"
					);
				}
				$this->upload->initialize($config);
				$this->upload->do_upload();
				$f[] = $this->upload->data();
				rename($f[$i]['full_path'], $f[$i]['file_path'] . $namabaru . $f[$i]['file_name']);
				$data = array('nama_file'	=> $namabaru.$f[$i]['file_name'],
								'id_paket'	=> $id_paket,
								'id_tahun'	=> $id_tahun,
								'id_jenis'	=> $id_jenis,
								'id_subdok'	=> 'SUB0093');
				$this->Datafiles_model->data_add($data);
			}
		}
		if (isset($_FILES['spm'])) {
			$spmcount = count($_FILES['spm']['name']);
			for ($i = 0; $i < $spmcount; $i++){
				$_FILES['userfile']['name']     = $_FILES['spm']['name'][$i];
				$_FILES['userfile']['type']     = $_FILES['spm']['type'][$i];
				$_FILES['userfile']['tmp_name'] = $_FILES['spm']['tmp_name'][$i];
				$_FILES['userfile']['error']    = $_FILES['spm']['error'][$i];
				$_FILES['userfile']['size']     = $_FILES['spm']['size'][$i];
				if ($id_jenis == 'JNS0005') {
					$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$nama_paket."/"
					);
				}
				elseif ($id_jenis != 'JNS0005') {
					$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/". $sub_jenis. "/".$nama_paket."/"
					);
				}
				$this->upload->initialize($config);
				$this->upload->do_upload();
				$f[] = $this->upload->data();
				rename($f[$i]['full_path'], $f[$i]['file_path'] . $namabaru . $f[$i]['file_name']);
				$data = array('nama_file'	=> $namabaru.$f[$i]['file_name'],
								'id_paket'	=> $id_paket,
								'id_tahun'	=> $id_tahun,
								'id_jenis'	=> $id_jenis,
								'id_subdok'	=> 'SUB0094');
				$this->Datafiles_model->data_add($data);
			}
		}
		if (isset($_FILES['sp2d'])) {
			$sp2dcount = count($_FILES['sp2d']['name']);
			for ($i = 0; $i < $sp2dcount; $i++){
				$_FILES['userfile']['name']     = $_FILES['sp2d']['name'][$i];
				$_FILES['userfile']['type']     = $_FILES['sp2d']['type'][$i];
				$_FILES['userfile']['tmp_name'] = $_FILES['sp2d']['tmp_name'][$i];
				$_FILES['userfile']['error']    = $_FILES['sp2d']['error'][$i];
				$_FILES['userfile']['size']     = $_FILES['sp2d']['size'][$i];
				if ($id_jenis == 'JNS0005') {
					$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$nama_paket."/"
					);
				}
				elseif ($id_jenis != 'JNS0005') {
					$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/". $sub_jenis. "/".$nama_paket."/"
					);
				}
				$this->upload->initialize($config);
				$this->upload->do_upload();
				$f[] = $this->upload->data();
				rename($f[$i]['full_path'], $f[$i]['file_path'] . $namabaru . $f[$i]['file_name']);
				$data = array('nama_file'	=> $namabaru.$f[$i]['file_name'],
								'id_paket'	=> $id_paket,
								'id_tahun'	=> $id_tahun,
								'id_jenis'	=> $id_jenis,
								'id_subdok'	=> 'SUB0095');
				$this->Datafiles_model->data_add($data);
			}
		}
		$this->session->set_flashdata('berhasil', true);
		redirect('ppk/viewfilependukung/'.$id_jenis."/".$id_paket);
	}

	public function bendahara()
	{
		$id_paket	= $this->input->post('id_paket');
		$id_ppk		= $this->session->userdata('id_ppk');
		$nama_ppk	= $this->Datappk_model->getwhereppk($id_ppk);
		$nama_ppk	= $nama_ppk['nama_ppk'];

		$paket 		= $this->Datapaket_model->getwherepaket($id_paket);
		$id_jenis	= $paket[0]['id_jenis'];
		$id_tahun	= $paket[0]['id_tahun'];
		$nama_paket	= $paket[0]['nama_paket'];
		$nama_tahun	= $paket[0]['nama_tahun'];
		$main_jenis	= $paket[0]['main_jenis'];
		$sub_jenis	= $paket[0]['sub_jenis'];
		$namabaru	= $nama_tahun."-".$nama_paket."- Pendukung -";
		$this->load->library('upload');
		if (isset($_FILES['lpj'])) {
			$lpjcount = count($_FILES['lpj']['name']);
			for ($i = 0; $i < $lpjcount; $i++){
				$_FILES['userfile']['name']     = $_FILES['lpj']['name'][$i];
				$_FILES['userfile']['type']     = $_FILES['lpj']['type'][$i];
				$_FILES['userfile']['tmp_name'] = $_FILES['lpj']['tmp_name'][$i];
				$_FILES['userfile']['error']    = $_FILES['lpj']['error'][$i];
				$_FILES['userfile']['size']     = $_FILES['lpj']['size'][$i];
				if ($id_jenis == 'JNS0005') {
					$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$nama_paket."/"
					);
				}
				elseif ($id_jenis != 'JNS0005') {
					$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/". $sub_jenis. "/".$nama_paket."/"
					);
				}
				$this->upload->initialize($config);
				$this->upload->do_upload();
				$a[] = $this->upload->data();
				rename($a[$i]['full_path'], $a[$i]['file_path'] . $namabaru . $a[$i]['file_name']);
				$data = array('nama_file'	=> $namabaru.$a[$i]['file_name'],
								'id_paket'	=> $id_paket,
								'id_tahun'	=> $id_tahun,
								'id_jenis'	=> $id_jenis,
								'id_subdok'	=> 'SUB0096');
				$this->Datafiles_model->data_add($data);
			}
		}
		if (isset($_FILES['rekonsi'])) {
			$rekonsicount = count($_FILES['rekonsi']['name']);
			for ($i = 0; $i < $rekonsicount; $i++){
				$_FILES['userfile']['name']     = $_FILES['rekonsi']['name'][$i];
				$_FILES['userfile']['type']     = $_FILES['rekonsi']['type'][$i];
				$_FILES['userfile']['tmp_name'] = $_FILES['rekonsi']['tmp_name'][$i];
				$_FILES['userfile']['error']    = $_FILES['rekonsi']['error'][$i];
				$_FILES['userfile']['size']     = $_FILES['rekonsi']['size'][$i];
				if ($id_jenis == 'JNS0005') {
					$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$nama_paket."/"
					);
				}
				elseif ($id_jenis != 'JNS0005') {
					$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/". $sub_jenis. "/".$nama_paket."/"
					);
				}
				$this->upload->initialize($config);
				$this->upload->do_upload();
				$b[] = $this->upload->data();
				rename($b[$i]['full_path'], $b[$i]['file_path'] . $namabaru . $b[$i]['file_name']);
				$data = array('nama_file'	=> $namabaru.$b[$i]['file_name'],
								'id_paket'	=> $id_paket,
								'id_tahun'	=> $id_tahun,
								'id_jenis'	=> $id_jenis,
								'id_subdok'	=> 'SUB0097');
				$this->Datafiles_model->data_add($data);
			}
		}
		if (isset($_FILES['rk'])) {
			$rkcount = count($_FILES['rk']['name']);
			for ($i = 0; $i < $rkcount; $i++){
				$_FILES['userfile']['name']     = $_FILES['rk']['name'][$i];
				$_FILES['userfile']['type']     = $_FILES['rk']['type'][$i];
				$_FILES['userfile']['tmp_name'] = $_FILES['rk']['tmp_name'][$i];
				$_FILES['userfile']['error']    = $_FILES['rk']['error'][$i];
				$_FILES['userfile']['size']     = $_FILES['rk']['size'][$i];
				if ($id_jenis == 'JNS0005') {
					$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$nama_paket."/"
					);
				}
				elseif ($id_jenis != 'JNS0005') {
					$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/". $sub_jenis. "/".$nama_paket."/"
					);
				}
				$this->upload->initialize($config);
				$this->upload->do_upload();
				$c[] = $this->upload->data();
				rename($c[$i]['full_path'], $c[$i]['file_path'] . $namabaru . $c[$i]['file_name']);
				$data = array('nama_file'	=> $namabaru.$c[$i]['file_name'],
								'id_paket'	=> $id_paket,
								'id_tahun'	=> $id_tahun,
								'id_jenis'	=> $id_jenis,
								'id_subdok'	=> 'SUB0098');
				$this->Datafiles_model->data_add($data);
			}
		}
		if (isset($_FILES['bapk'])) {
			$bapkcount = count($_FILES['bapk']['name']);
			for ($i = 0; $i < $bapkcount; $i++){
				$_FILES['userfile']['name']     = $_FILES['bapk']['name'][$i];
				$_FILES['userfile']['type']     = $_FILES['bapk']['type'][$i];
				$_FILES['userfile']['tmp_name'] = $_FILES['bapk']['tmp_name'][$i];
				$_FILES['userfile']['error']    = $_FILES['bapk']['error'][$i];
				$_FILES['userfile']['size']     = $_FILES['bapk']['size'][$i];
				if ($id_jenis == 'JNS0005') {
					$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$nama_paket."/"
					);
				}
				elseif ($id_jenis != 'JNS0005') {
					$config = array(
					'allowed_types' => '*',
					'overwrite'	=> FALSE,
					'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/". $sub_jenis. "/".$nama_paket."/"
					);
				}
				$this->upload->initialize($config);
				$this->upload->do_upload();
				$d[] = $this->upload->data();
				rename($d[$i]['full_path'], $d[$i]['file_path'] . $namabaru . $d[$i]['file_name']);
				$data = array('nama_file'	=> $namabaru.$d[$i]['file_name'],
								'id_paket'	=> $id_paket,
								'id_tahun'	=> $id_tahun,
								'id_jenis'	=> $id_jenis,
								'id_subdok'	=> 'SUB0099');
				$this->Datafiles_model->data_add($data);
			}
		}
		$this->session->set_flashdata('berhasil', true);
		redirect('ppk/viewfilependukung/'.$id_jenis."/".$id_paket);
	}
// -------------------------------------------------------------------------------------------------------------
// ------------------------------------------------ View dan Update Pendukung ----------------------------------
// -------------------------------------------------------------------------------------------------------------
	public function viewfilependukung($id_jenis, $id_paket)
	{
		$id_user = $this->session->userdata('id_user');
		$id_ppk = $this->session->userdata('id_ppk');
		$data['data_user'] = $this->Datauser_model->getwhereuser($id_user);
		$data['data_ppk']  = $this->Datappk_model->getwhereppk($id_ppk);
		$data['data_jenis']	= $this->Datajenis_model->subjeniskontraktual();

		$this->load->view('ppk/header',$data);
		$this->load->view('ppk/sidebar',$data);

		$data['where_paket'] 	= $this->Datapaket_model->wherepaket($id_paket);
		$daftarfile		= $this->Datafiles_model->daftarfile($id_paket);
		$daftarfile		= $this->Datafiles_model->daftarfile($id_paket);
		foreach ($daftarfile as $r) {
			if ($r['id_subdok']=="SUB0085") {
				$data['file_sas'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0085');
			}
			if ($r['id_subdok']=="SUB0086") {
				$data['file_rt'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0086');
			}
			if ($r['id_subdok']=="SUB0087") {
				$data['file_shkk'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0087');
			}
			if ($r['id_subdok']=="SUB0088") {
				$data['file_pp'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0088');
			}
			if ($r['id_subdok']=="SUB0089") {
				$data['file_kuitansi'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0089');
			}
			if ($r['id_subdok']=="SUB0090") {
				$data['file_karwas'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0090');
			}
			if ($r['id_subdok']=="SUB0091") {
				$data['file_fp'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0091');
			}
			if ($r['id_subdok']=="SUB0092") {
				$data['file_ppn'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0092');
			}
			if ($r['id_subdok']=="SUB0093") {
				$data['file_spp'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0093');
			}
			if ($r['id_subdok']=="SUB0094") {
				$data['file_spm'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0094');
			}
			if ($r['id_subdok']=="SUB0095") {
				$data['file_sp2d'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0095');
			}
			if ($r['id_subdok']=="SUB0096") {
				$data['file_lpj'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0096');
			}
			if ($r['id_subdok']=="SUB0097") {
				$data['file_rekonsi'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0097');
			}
			if ($r['id_subdok']=="SUB0098") {
				$data['file_rk'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0098');
			}
			if ($r['id_subdok']=="SUB0099") {
				$data['file_bapk'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0099');
			}
		}
		$this->load->view('ppk/viewfilependukung',$data);
		$this->load->view('ppk/footer');
	}
	public function updatefilependukung($id_jenis, $id_paket)
	{
		$id_user = $this->session->userdata('id_user');
		$id_ppk = $this->session->userdata('id_ppk');
		$data['data_user'] = $this->Datauser_model->getwhereuser($id_user);
		$data['data_ppk']  = $this->Datappk_model->getwhereppk($id_ppk);
		$data['data_jenis']	= $this->Datajenis_model->subjeniskontraktual();

		$this->load->view('ppk/header',$data);
		$this->load->view('ppk/sidebar',$data);

		$data['where_paket'] 	= $this->Datapaket_model->wherepaket($id_paket);
		$daftarfile		= $this->Datafiles_model->daftarfile($id_paket);
		$daftarfile		= $this->Datafiles_model->daftarfile($id_paket);
		foreach ($daftarfile as $r) {
			if ($r['id_subdok']=="SUB0085") {
				$data['file_sas'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0085');
			}
			if ($r['id_subdok']=="SUB0086") {
				$data['file_rt'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0086');
			}
			if ($r['id_subdok']=="SUB0087") {
				$data['file_shkk'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0087');
			}
			if ($r['id_subdok']=="SUB0088") {
				$data['file_pp'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0088');
			}
			if ($r['id_subdok']=="SUB0089") {
				$data['file_kuitansi'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0089');
			}
			if ($r['id_subdok']=="SUB0090") {
				$data['file_karwas'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0090');
			}
			if ($r['id_subdok']=="SUB0091") {
				$data['file_fp'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0091');
			}
			if ($r['id_subdok']=="SUB0092") {
				$data['file_ppn'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0092');
			}
			if ($r['id_subdok']=="SUB0093") {
				$data['file_spp'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0093');
			}
			if ($r['id_subdok']=="SUB0094") {
				$data['file_spm'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0094');
			}
			if ($r['id_subdok']=="SUB0095") {
				$data['file_sp2d'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0095');
			}
			if ($r['id_subdok']=="SUB0096") {
				$data['file_lpj'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0096');
			}
			if ($r['id_subdok']=="SUB0097") {
				$data['file_rekonsi'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0097');
			}
			if ($r['id_subdok']=="SUB0098") {
				$data['file_rk'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0098');
			}
			if ($r['id_subdok']=="SUB0099") {
				$data['file_bapk'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0099');
			}
		}
		$this->load->view('ppk/updatefilependukung',$data);
		$this->load->view('ppk/footer');
	} 		
// -------------------------------------------------------------------------------------------------------------
// ------------------------------------------------ FUNGSI HAPUS -----------------------------------------------
// -------------------------------------------------------------------------------------------------------------
	public function hapusfilekontraktual($id_paket,$id_file)
	{
		$id_ppk 	= $this->session->userdata('id_ppk');
		$nama_ppk	= $this->Datappk_model->getwhereppk($id_ppk);
		$nama_ppk 	= $nama_ppk['nama_ppk'];
		$paket 		= $this->Datapaket_model->getwherepaket($id_paket);
		$file 		= $this->Datafiles_model->getwherefile($id_file);

		$id_jenis 	= $paket[0]['id_jenis'];
		$nama_paket	= $paket[0]['nama_paket'];
		$nama_tahun	= $paket[0]['nama_tahun'];
		$main_jenis	= $paket[0]['main_jenis'];
		$sub_jenis	= $paket[0]['sub_jenis'];
		$nama_file	= $file[0]['nama_file'];

		$where = array ('id_file' =>$id_file);
		$result = $this->Datafiles_model->hapusfile($where, 'tbl_file');
		// if ($result > 0) {
		$target = 'assets/data/'.$nama_tahun.'/'.$nama_ppk.'/'.$main_jenis.'/'.$sub_jenis.'/'.$nama_paket.'/'.$nama_file;
		unlink($target);
		if ($id_jenis == 'JNS0002') {
			$this->session->set_flashdata('deleteberhasil',true);
			redirect(base_url('ppk/viewfile/'.$id_jenis."/".$id_paket));
		}
		elseif ($id_jenis == 'JNS0003') {
			$this->session->set_flashdata('deleteberhasil',true);
			redirect(base_url('ppk/viewfilekonsultan/'.$id_jenis."/".$id_paket));
		}
		elseif ($id_jenis == 'JNS0004') {
			$this->session->set_flashdata('deleteberhasil',true);
			redirect(base_url('ppk/viewfilepengadaan/'.$id_jenis."/".$id_paket));
		}	
	}
	public function hapusfileswakelola($id_paket,$id_file)
	{
		$id_ppk 	= $this->session->userdata('id_ppk');
		$nama_ppk	= $this->Datappk_model->getwhereppk($id_ppk);
		$nama_ppk 	= $nama_ppk['nama_ppk'];
		$paket 		= $this->Datapaket_model->getwherepaket($id_paket);
		$file 		= $this->Datafiles_model->getwherefile($id_file);

		$id_jenis 	= $paket[0]['id_jenis'];
		$nama_paket	= $paket[0]['nama_paket'];
		$nama_tahun	= $paket[0]['nama_tahun'];
		$main_jenis	= $paket[0]['main_jenis'];
		$sub_jenis	= $paket[0]['sub_jenis'];
		$nama_file	= $file[0]['nama_file'];

		$where = array ('id_file' =>$id_file);
		$result = $this->Datafiles_model->hapusfile($where, 'tbl_file');
		// if ($result > 0) {
		$target = 'assets/data/'.$nama_tahun.'/'.$nama_ppk.'/'.$main_jenis.'/'.$nama_paket.'/'.$nama_file;
		unlink($target);
		$this->session->set_flashdata('deleteberhasil',true);
		redirect(base_url('ppk/viewfileswakelola/'.$id_jenis."/".$id_paket));
	}

	public function hapusfilependukung($id_paket,$id_file)
	{
		$id_ppk 	= $this->session->userdata('id_ppk');
		$nama_ppk	= $this->Datappk_model->getwhereppk($id_ppk);
		$nama_ppk 	= $nama_ppk['nama_ppk'];
		$paket 		= $this->Datapaket_model->getwherepaket($id_paket);
		$file 		= $this->Datafiles_model->getwherefile($id_file);

		$id_jenis 	= $paket[0]['id_jenis'];
		$nama_paket	= $paket[0]['nama_paket'];
		$nama_tahun	= $paket[0]['nama_tahun'];
		$main_jenis	= $paket[0]['main_jenis'];
		$sub_jenis	= $paket[0]['sub_jenis'];
		$nama_file	= $file[0]['nama_file'];

		$where = array ('id_file' =>$id_file);
		$result = $this->Datafiles_model->hapusfile($where, 'tbl_file');
		if ($id_jenis == 'JNS0005') {
			$target = 'assets/data/'.$nama_tahun.'/'.$nama_ppk.'/'.$main_jenis.'/'.$nama_paket.'/'.$nama_file;
		}
		elseif($id_jenis != 'JNS0005'){
			$target = 'assets/data/'.$nama_tahun.'/'.$nama_ppk.'/'.$main_jenis.'/'.$sub_jenis.'/'.$nama_paket.'/'.$nama_file;	
		}
		unlink($target);
		$this->session->set_flashdata('deleteberhasil',true);
		redirect(base_url('ppk/viewfilependukung/'.$id_jenis."/".$id_paket));
	}

	public function printlaporankonsultan ($id_jenis, $id_paket)
	{
		$id_user = $this->session->userdata('id_user');
		$id_ppk = $this->session->userdata('id_ppk');
		$data['data_ppk']  = $this->Datappk_model->getwhereppk($id_ppk);
		$data['where_paket'] 	= $this->Datapaket_model->wherepaket($id_paket);
		$daftarfile		= $this->Datafiles_model->daftarfile($id_paket);
		foreach ($daftarfile as $r) {
			if ($r['id_subdok']=="SUB0069") {
				$data['file_lpn'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0069');
			}
			if ($r['id_subdok']=="SUB0070") {
				$data['file_lan'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0070');
			}
			if ($r['id_subdok']=="SUB0071") {
				$data['file_dla'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0071');
			}
			if ($r['id_subdok']=="SUB0072") {
				$data['file_lak'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0072');
			}
			//File Pendukung
			if ($r['id_subdok']=="SUB0085") {
				$data['file_sas'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0085');
			}
			if ($r['id_subdok']=="SUB0086") {
				$data['file_rt'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0086');
			}
			if ($r['id_subdok']=="SUB0087") {
				$data['file_shkk'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0087');
			}
			if ($r['id_subdok']=="SUB0088") {
				$data['file_pp'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0088');
			}
			if ($r['id_subdok']=="SUB0089") {
				$data['file_kuitansi'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0089');
			}
			if ($r['id_subdok']=="SUB0090") {
				$data['file_karwas'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0090');
			}
			if ($r['id_subdok']=="SUB0091") {
				$data['file_fp'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0091');
			}
			if ($r['id_subdok']=="SUB0092") {
				$data['file_ppn'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0092');
			}
			if ($r['id_subdok']=="SUB0093") {
				$data['file_spp'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0093');
			}
			if ($r['id_subdok']=="SUB0094") {
				$data['file_spm'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0094');
			}
			if ($r['id_subdok']=="SUB0095") {
				$data['file_sp2d'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0095');
			}
			if ($r['id_subdok']=="SUB0096") {
				$data['file_lpj'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0096');
			}
			if ($r['id_subdok']=="SUB0097") {
				$data['file_rekonsi'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0097');
			}
			if ($r['id_subdok']=="SUB0098") {
				$data['file_rk'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0098');
			}
			if ($r['id_subdok']=="SUB0099") {
				$data['file_bapk'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0099');
			}
		}
		$this->load->view('ppk/detaillaporankonsultan',$data);
	}

	public function printlaporanpengadaan($id_jenis, $id_paket)
	{
		$id_user = $this->session->userdata('id_user');
		$id_ppk = $this->session->userdata('id_ppk');
		$data['data_ppk']  = $this->Datappk_model->getwhereppk($id_ppk);
		$data['where_paket'] 	= $this->Datapaket_model->wherepaket($id_paket);
		$daftarfile		= $this->Datafiles_model->daftarfile($id_paket);

		foreach ($daftarfile as $r){
			if ($r['id_subdok']=="SUB0073") {
				$data['file_sm'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0073');
			}
			if ($r['id_subdok']=="SUB0074") {
				$data['file_spmh'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0074');
			}
			if ($r['id_subdok']=="SUB0075") {
				$data['file_pk'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0075');
			}
			if ($r['id_subdok']=="SUB0076") {
				$data['file_bast'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0076');
			}
			if ($r['id_subdok']=="SUB0077") {
				$data['file_sk_kemen'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0077');
			}
			if ($r['id_subdok']=="SUB0078") {
				$data['file_rekomtek'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0078');
			}
			if ($r['id_subdok']=="SUB0079") {
				$data['file_hibah_kemen'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0079');
			}
			if ($r['id_subdok']=="SUB0080") {
				$data['file_hibah_satker'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0080');
			}
			if ($r['id_subdok']=="SUB0081") {
				$data['file_naskah_hibah'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0081');
			}
			if ($r['id_subdok']=="SUB0082") {
				$data['file_ph'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0082');
			}
			if ($r['id_subdok']=="SUB0083") {
				$data['file_dh'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0083');
			}

			//File Pendukung
			if ($r['id_subdok']=="SUB0085") {
				$data['file_sas'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0085');
			}
			if ($r['id_subdok']=="SUB0086") {
				$data['file_rt'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0086');
			}
			if ($r['id_subdok']=="SUB0087") {
				$data['file_shkk'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0087');
			}
			if ($r['id_subdok']=="SUB0088") {
				$data['file_pp'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0088');
			}
			if ($r['id_subdok']=="SUB0089") {
				$data['file_kuitansi'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0089');
			}
			if ($r['id_subdok']=="SUB0090") {
				$data['file_karwas'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0090');
			}
			if ($r['id_subdok']=="SUB0091") {
				$data['file_fp'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0091');
			}
			if ($r['id_subdok']=="SUB0092") {
				$data['file_ppn'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0092');
			}
			if ($r['id_subdok']=="SUB0093") {
				$data['file_spp'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0093');
			}
			if ($r['id_subdok']=="SUB0094") {
				$data['file_spm'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0094');
			}
			if ($r['id_subdok']=="SUB0095") {
				$data['file_sp2d'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0095');
			}
			if ($r['id_subdok']=="SUB0096") {
				$data['file_lpj'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0096');
			}
			if ($r['id_subdok']=="SUB0097") {
				$data['file_rekonsi'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0097');
			}
			if ($r['id_subdok']=="SUB0098") {
				$data['file_rk'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0098');
			}
			if ($r['id_subdok']=="SUB0099") {
				$data['file_bapk'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0099');
			}
		}
		$this->load->view('ppk/detaillaporanpengadaan',$data);
	}

	public function printlaporanswakelola ($id_jenis, $id_paket)
	{
		$id_user = $this->session->userdata('id_user');
		$id_ppk = $this->session->userdata('id_ppk');
		$data['data_ppk']  = $this->Datappk_model->getwhereppk($id_ppk);
		$data['where_paket'] 	= $this->Datapaket_model->wherepaket($id_paket);
		$daftarfile		= $this->Datafiles_model->daftarfile($id_paket);

		foreach ($daftarfile as $r){
			if ($r['id_subdok']=="SUB0084") {
				$data['file_swa'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0084');
			}

			//File Pendukung
			if ($r['id_subdok']=="SUB0085") {
				$data['file_sas'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0085');
			}
			if ($r['id_subdok']=="SUB0086") {
				$data['file_rt'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0086');
			}
			if ($r['id_subdok']=="SUB0087") {
				$data['file_shkk'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0087');
			}
			if ($r['id_subdok']=="SUB0088") {
				$data['file_pp'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0088');
			}
			if ($r['id_subdok']=="SUB0089") {
				$data['file_kuitansi'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0089');
			}
			if ($r['id_subdok']=="SUB0090") {
				$data['file_karwas'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0090');
			}
			if ($r['id_subdok']=="SUB0091") {
				$data['file_fp'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0091');
			}
			if ($r['id_subdok']=="SUB0092") {
				$data['file_ppn'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0092');
			}
			if ($r['id_subdok']=="SUB0093") {
				$data['file_spp'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0093');
			}
			if ($r['id_subdok']=="SUB0094") {
				$data['file_spm'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0094');
			}
			if ($r['id_subdok']=="SUB0095") {
				$data['file_sp2d'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0095');
			}
			if ($r['id_subdok']=="SUB0096") {
				$data['file_lpj'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0096');
			}
			if ($r['id_subdok']=="SUB0097") {
				$data['file_rekonsi'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0097');
			}
			if ($r['id_subdok']=="SUB0098") {
				$data['file_rk'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0098');
			}
			if ($r['id_subdok']=="SUB0099") {
				$data['file_bapk'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0099');
			}
		}
		$this->load->view('ppk/detaillaporanswakelola',$data);
	}

	public function printlaporanpembangunan($id_jenis, $id_paket)
	{
		$id_user = $this->session->userdata('id_user');
		$id_ppk = $this->session->userdata('id_ppk');
		$data['data_ppk']  = $this->Datappk_model->getwhereppk($id_ppk);
		$data['where_paket'] 	= $this->Datapaket_model->wherepaket($id_paket);
		$daftarfile		= $this->Datafiles_model->daftarfile($id_paket);
		foreach ($daftarfile as $r){
			if ($r['id_subdok']=="SUB0001") {
				$data['file_smd'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0001');
			}
			if ($r['id_subdok']=="SUB0002") {
				$data['file_smh'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0002');
			}
			if ($r['id_subdok']=="SUB0003") {
				$data['file_skl'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0003');
			}
			if ($r['id_subdok']=="SUB0004") {
				$data['file_ksb'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0004');
			}
			if ($r['id_subdok']=="SUB0005") {
				$data['file_pks'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0005');
			}
			if ($r['id_subdok']=="SUB0006") {
				$data['file_sk'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0006');
			}
			if ($r['id_subdok']=="SUB0007") {
				$data['file_sppbj'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0007');
			}
			if ($r['id_subdok']=="SUB0008") {
				$data['file_spmk'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0008');
			}
			if ($r['id_subdok']=="SUB0009") {
				$data['file_naskon'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0009');
			}
			if ($r['id_subdok']=="SUB0010") {
				$data['file_rmk'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0010');
			}
			if ($r['id_subdok']=="SUB0011") {
				$data['file_dd'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0011');
			}
			if ($r['id_subdok']=="SUB0012") {
				$data['file_bal_mco'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0012');
			}
			if ($r['id_subdok']=="SUB0013") {
				$data['file_jst_mco'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0013');
			}
			if ($r['id_subdok']=="SUB0014") {
				$data['file_pcm'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0014');
			}
			if ($r['id_subdok']=="SUB0015") {
				$data['file_boq_psc'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0015');
			}
			if ($r['id_subdok']=="SUB0016") {
				$data['file_jst_psc'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0016');
			}
			if ($r['id_subdok']=="SUB0017") {
				$data['file_slp_psc'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0017');
			}
			if ($r['id_subdok']=="SUB0018") {
				$data['file_kurva_psc'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0018');
			}
			if ($r['id_subdok']=="SUB0019") {
				$data['file_sd_psc'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0019');
			}
			if ($r['id_subdok']=="SUB0020") {
				$data['file_bakn_psc'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0020');
			}
			if ($r['id_subdok']=="SUB0021") {
				$data['file_na1'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0021');
			}
			if ($r['id_subdok']=="SUB0022") {
				$data['file_bal_ad2'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0022');
			}
			if ($r['id_subdok']=="SUB0023") {
				$data['file_boq_ad2'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0023');
			}
			if ($r['id_subdok']=="SUB0024") {
				$data['file_jst_ad2'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0024');
			}
			if ($r['id_subdok']=="SUB0025") {
				$data['file_slp_ad2'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0025');
			}
			if ($r['id_subdok']=="SUB0026") {
				$data['file_kurva_ad2'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0026');
			}
			if ($r['id_subdok']=="SUB0027") {
				$data['file_sd_ad2'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0027');
			}
			if ($r['id_subdok']=="SUB0028") {
				$data['file_bakn_ad2'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0028');
			}
			if ($r['id_subdok']=="SUB0029") {
				$data['file_na2'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0029');
			}
			if ($r['id_subdok']=="SUB0030") {
				$data['file_bal_ad3'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0030');
			}
			if ($r['id_subdok']=="SUB0031") {
				$data['file_boq_ad3'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0031');
			}
			if ($r['id_subdok']=="SUB0032") {
				$data['file_jst_ad3'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0032');
			}
			if ($r['id_subdok']=="SUB0033") {
				$data['file_slp_ad3'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0033');
			}
			if ($r['id_subdok']=="SUB0034") {
				$data['file_kurva_ad3'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0034');
			}
			if ($r['id_subdok']=="SUB0035") {
				$data['file_sd_ad3'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0035');
			}
			if ($r['id_subdok']=="SUB0036") {
				$data['file_bakn_ad3'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0036');
			}
			if ($r['id_subdok']=="SUB0037") {
				$data['file_na3'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0037');
			}
			if ($r['id_subdok']=="SUB0038") {
				$data['file_bal_ad4'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0038');
			}
			if ($r['id_subdok']=="SUB0039") {
				$data['file_boq_ad4'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0039');
			}
			if ($r['id_subdok']=="SUB0040") {
				$data['file_jst_ad4'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0040');
			}
			if ($r['id_subdok']=="SUB0041") {
				$data['file_slp_ad4'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0041');
			}
			if ($r['id_subdok']=="SUB0042") {
				$data['file_kurva_ad4'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0042');
			}
			if ($r['id_subdok']=="SUB0043") {
				$data['file_sd_ad4'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0043');
			}
			if ($r['id_subdok']=="SUB0044") {
				$data['file_bakn_ad4'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0044');
			}
			if ($r['id_subdok']=="SUB0045") {
				$data['file_na4'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0045');
			}
			if ($r['id_subdok']=="SUB0046") {
				$data['file_bal_ad5'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0046');
			}
			if ($r['id_subdok']=="SUB0047") {
				$data['file_boq_ad5'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0047');
			}
			if ($r['id_subdok']=="SUB0048") {
				$data['file_jst_ad5'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0048');
			}
			if ($r['id_subdok']=="SUB0049") {
				$data['file_slp_ad5'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0049');
			}
			if ($r['id_subdok']=="SUB0050") {
				$data['file_kurva_ad5'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0050');
			}
			if ($r['id_subdok']=="SUB0051") {
				$data['file_sd_ad5'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0051');
			}
			if ($r['id_subdok']=="SUB0052") {
				$data['file_bakn_ad5'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0052');
			}
			if ($r['id_subdok']=="SUB0053") {
				$data['file_na5'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0053');
			}
			if ($r['id_subdok']=="SUB0054") {
				$data['file_lh'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0054');
			}
			if ($r['id_subdok']=="SUB0055") {
				$data['file_lm'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0055');
			}
			if ($r['id_subdok']=="SUB0056") {
				$data['file_lb'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0056');
			}
			if ($r['id_subdok']=="SUB0057") {
				$data['file_sp'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0057');
			}
			if ($r['id_subdok']=="SUB0058") {
				$data['file_bapm'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0058');
			}
			if ($r['id_subdok']=="SUB0059") {
				$data['file_scm'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0059');
			}
			if ($r['id_subdok']=="SUB0060") {
				$data['file_sp_pho'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0060');
			}
			if ($r['id_subdok']=="SUB0061") {
				$data['file_ba_pho'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0061');
			}
			if ($r['id_subdok']=="SUB0062") {
				$data['file_basv_pho'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0062');
			}
			if ($r['id_subdok']=="SUB0063") {
				$data['file_bastp_pho'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0063');
			}
			if ($r['id_subdok']=="SUB0064") {
				$data['file_sp_fho'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0064');
			}
			if ($r['id_subdok']=="SUB0065") {
				$data['file_ba_fho'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0065');
			}
			if ($r['id_subdok']=="SUB0066") {
				$data['file_basv_fho'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0066');
			}
			if ($r['id_subdok']=="SUB0067") {
				$data['file_bastp_fho'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0067');
			}
			if ($r['id_subdok']=="SUB0068") {
				$data['file_dok'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0068');
			}

			//File Pendukung
			if ($r['id_subdok']=="SUB0085") {
				$data['file_sas'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0085');
			}
			if ($r['id_subdok']=="SUB0086") {
				$data['file_rt'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0086');
			}
			if ($r['id_subdok']=="SUB0087") {
				$data['file_shkk'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0087');
			}
			if ($r['id_subdok']=="SUB0088") {
				$data['file_pp'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0088');
			}
			if ($r['id_subdok']=="SUB0089") {
				$data['file_kuitansi'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0089');
			}
			if ($r['id_subdok']=="SUB0090") {
				$data['file_karwas'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0090');
			}
			if ($r['id_subdok']=="SUB0091") {
				$data['file_fp'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0091');
			}
			if ($r['id_subdok']=="SUB0092") {
				$data['file_ppn'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0092');
			}
			if ($r['id_subdok']=="SUB0093") {
				$data['file_spp'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0093');
			}
			if ($r['id_subdok']=="SUB0094") {
				$data['file_spm'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0094');
			}
			if ($r['id_subdok']=="SUB0095") {
				$data['file_sp2d'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0095');
			}
			if ($r['id_subdok']=="SUB0096") {
				$data['file_lpj'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0096');
			}
			if ($r['id_subdok']=="SUB0097") {
				$data['file_rekonsi'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0097');
			}
			if ($r['id_subdok']=="SUB0098") {
				$data['file_rk'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0098');
			}
			if ($r['id_subdok']=="SUB0099") {
				$data['file_bapk'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0099');
			}
		}
		$this->load->view('ppk/detaillaporanpembangunan',$data);
	}

// -------------------------------------------------------------------------------------------------------------
// ------------------------------------------------ FUNGSI TESTER ----------------------------------------------
// -------------------------------------------------------------------------------------------------------------
	public function testinput()
	{
		// $this->load->library('upload');
		// if (isset($_FILES['smd'])) {
		// 	$smdcount = count($_FILES['smd']['name']);
		// 	for ($i = 0; $i < $smdcount; $i++){
		// 		$_FILES['userfile']['name']     = $_FILES['smd']['name'][$i];
		// 		$_FILES['userfile']['type']     = $_FILES['smd']['type'][$i];
		// 		$_FILES['userfile']['tmp_name'] = $_FILES['smd']['tmp_name'][$i];
		// 		$_FILES['userfile']['error']    = $_FILES['smd']['error'][$i];
		// 		$_FILES['userfile']['size']     = $_FILES['smd']['size'][$i];
		// 		$config = array(
		// 			'allowed_types' => '*',
		// 			'overwrite'     => FALSE,
		// 			'upload_path'	=> './assets/data/'
		// 		);
		// 		$this->upload->initialize($config);
		// 		$this->upload->do_upload();
		// 		$a[] = $this->upload->data();
		// 		print_r($a[$i]['file_name']);
		// 		$data = array('nama_file'	=> $a[$i]['file_name'],
		// 						'id_paket'	=> 'PKT0003',
		// 						'id_subdok'	=>	'SUB0001');
		// 		$this->Datafiles_model->data_add($data);
		// 	}
		// }
		// if ($_FILES['smh']) {

		// }
		// $id_paket = 'PKT0003';
		// $data_file = $this->Datafiles_model->daftarfile($id_paket);
		// // die(print_r($data_file));
		// foreach ($data_file as $u) {
		// 	// die(print_r($u['id_subdok']));
		// 	if ($u['id_subdok']=='SUB0001') {
		// 		// $data['smh'] = $this->Datafiles_model->daftarsubdok($id_paket,'SUB0001');
		// 		echo "ini smd";
		// 	}
		// 	if ($u['id_subdok']=='SUB0002') {
		// 		echo  "ini smh";
		// 	}
		// }

	}
	public function inputarr()
	{
		$id_paket 	= 'PKT0003';
		$paket 		= $this->Datapaket_model->getwherepaket($id_paket);
		$id_jenis 	= $paket[0]['id_jenis'];
		$id_tahun	= $paket[0]['id_tahun'];
		echo $id_jenis.$id_tahun;
		// $this->load->view('ppk/test');
		// $this->load->view('ppk/footer');
	}
}
 ?>