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
			$data['view_paket'] = $this->Datapaket_model->viewjenispaket($id_tahun,$id_jenis,$id_ppk);
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
		$data['daftarkepala']	= $this->Datadokumen_model->daftarkepala($id_jenis);
		$this->load->view('ppk/inputdokutamaswakelola',$data);
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

	// 3. ----------------------------------- MC0 ---------------------------------------------------
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
			if ($_FILES['bal_ad2']['name'][0]!=NULL) {
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
			if ($_FILES['boq_ad2']['name'][0]!=NULL) {
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
			// if ($_FILES['jst_ad2']['name'][0]!=NULL) {
			// 	$jst_ad2count = count($_FILES['jst_ad2']['name']);
			// 	for ($i = 0; $i < $jst_ad2count; $i++){
			// 		$_FILES['userfile']['name']     = $_FILES['jst_ad2']['name'][$i];
			// 		$_FILES['userfile']['type']     = $_FILES['jst_ad2']['type'][$i];
			// 		$_FILES['userfile']['tmp_name'] = $_FILES['jst_ad2']['tmp_name'][$i];
			// 		$_FILES['userfile']['error']    = $_FILES['jst_ad2']['error'][$i];
			// 		$_FILES['userfile']['size']     = $_FILES['jst_ad2']['size'][$i];
			// 		$config = array(
			// 			'allowed_types' => '*',
			// 			'overwrite'	=> FALSE,
			// 			'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
			// 		);
			// 		$this->upload->initialize($config);
			// 		$this->upload->do_upload();
			// 		$c[] = $this->upload->data();
			// 		rename($c[$i]['full_path'], $c[$i]['file_path'] . $namabaru . $c[$i]['file_name']);
			// 		$data = array('nama_file'	=> $namabaru.$c[$i]['file_name'],
			// 						'id_paket'	=> $id_paket,
			// 						'id_tahun'	=> $id_tahun,
			// 						'id_jenis'	=> $id_jenis,
			// 						'id_subdok'	=> 'SUB0024');
			// 		$this->Datafiles_model->data_add($data);
			// 	}
			// }
			// if ($_FILES['slp_ad2']['name'][0]!=NULL) {
			// 	$slp_ad2count = count($_FILES['slp_ad2']['name']);
			// 	for ($i = 0; $i < $slp_ad2count; $i++){
			// 		$_FILES['userfile']['name']     = $_FILES['slp_ad2']['name'][$i];
			// 		$_FILES['userfile']['type']     = $_FILES['slp_ad2']['type'][$i];
			// 		$_FILES['userfile']['tmp_name'] = $_FILES['slp_ad2']['tmp_name'][$i];
			// 		$_FILES['userfile']['error']    = $_FILES['slp_ad2']['error'][$i];
			// 		$_FILES['userfile']['size']     = $_FILES['slp_ad2']['size'][$i];
			// 		$config = array(
			// 			'allowed_types' => '*',
			// 			'overwrite'	=> FALSE,
			// 			'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
			// 		);
			// 		$this->upload->initialize($config);
			// 		$this->upload->do_upload();
			// 		$d[] = $this->upload->data();
			// 		rename($d[$i]['full_path'], $d[$i]['file_path'] . $namabaru . $d[$i]['file_name']);
			// 		$data = array('nama_file'	=> $namabaru.$d[$i]['file_name'],
			// 						'id_paket'	=> $id_paket,
			// 						'id_tahun'	=> $id_tahun,
			// 						'id_jenis'	=> $id_jenis,
			// 						'id_subdok'	=> 'SUB0025');
			// 		$this->Datafiles_model->data_add($data);
			// 	}
			// }
			// if ($_FILES['kurva_ad2']['name'][0]!=NULL) {
			// 	$kurva_ad2count = count($_FILES['kurva_ad2']['name']);
			// 	for ($i = 0; $i < $kurva_ad2count; $i++){
			// 		$_FILES['userfile']['name']     = $_FILES['kurva_ad2']['name'][$i];
			// 		$_FILES['userfile']['type']     = $_FILES['kurva_ad2']['type'][$i];
			// 		$_FILES['userfile']['tmp_name'] = $_FILES['kurva_ad2']['tmp_name'][$i];
			// 		$_FILES['userfile']['error']    = $_FILES['kurva_ad2']['error'][$i];
			// 		$_FILES['userfile']['size']     = $_FILES['kurva_ad2']['size'][$i];
			// 		$config = array(
			// 			'allowed_types' => '*',
			// 			'overwrite'	=> FALSE,
			// 			'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
			// 		);
			// 		$this->upload->initialize($config);
			// 		$this->upload->do_upload();
			// 		$e[] = $this->upload->data();
			// 		rename($e[$i]['full_path'], $e[$i]['file_path'] . $namabaru . $e[$i]['file_name']);
			// 		$data = array('nama_file'	=> $namabaru.$e[$i]['file_name'],
			// 						'id_paket'	=> $id_paket,
			// 						'id_tahun'	=> $id_tahun,
			// 						'id_jenis'	=> $id_jenis,
			// 						'id_subdok'	=> 'SUB0026');
			// 		$this->Datafiles_model->data_add($data);
			// 	}
			// }
			// if ($_FILES['sd_ad2']['name'][0]!=NULL) {
			// 	$sd_ad2count = count($_FILES['sd_ad2']['name']);
			// 	for ($i = 0; $i < $sd_ad2count; $i++){
			// 		$_FILES['userfile']['name']     = $_FILES['sd_ad2']['name'][$i];
			// 		$_FILES['userfile']['type']     = $_FILES['sd_ad2']['type'][$i];
			// 		$_FILES['userfile']['tmp_name'] = $_FILES['sd_ad2']['tmp_name'][$i];
			// 		$_FILES['userfile']['error']    = $_FILES['sd_ad2']['error'][$i];
			// 		$_FILES['userfile']['size']     = $_FILES['sd_ad2']['size'][$i];
			// 		$config = array(
			// 			'allowed_types' => '*',
			// 			'overwrite'	=> FALSE,
			// 			'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
			// 		);
			// 		$this->upload->initialize($config);
			// 		$this->upload->do_upload();
			// 		$f[] = $this->upload->data();
			// 		rename($f[$i]['full_path'], $f[$i]['file_path'] . $namabaru . $f[$i]['file_name']);
			// 		$data = array('nama_file'	=> $namabaru.$f[$i]['file_name'],
			// 						'id_paket'	=> $id_paket,
			// 						'id_tahun'	=> $id_tahun,
			// 						'id_jenis'	=> $id_jenis,
			// 						'id_subdok'	=> 'SUB0027');
			// 		$this->Datafiles_model->data_add($data);
			// 	}
			// }
			// if ($_FILES['bakn_ad2']['name'][0]!=NULL) {
			// 	$bakn_ad2count = count($_FILES['bakn_ad2']['name']);
			// 	for ($i = 0; $i < $bakn_ad2count; $i++){
			// 		$_FILES['userfile']['name']     = $_FILES['bakn_ad2']['name'][$i];
			// 		$_FILES['userfile']['type']     = $_FILES['bakn_ad2']['type'][$i];
			// 		$_FILES['userfile']['tmp_name'] = $_FILES['bakn_ad2']['tmp_name'][$i];
			// 		$_FILES['userfile']['error']    = $_FILES['bakn_ad2']['error'][$i];
			// 		$_FILES['userfile']['size']     = $_FILES['bakn_ad2']['size'][$i];
			// 		$config = array(
			// 			'allowed_types' => '*',
			// 			'overwrite'	=> FALSE,
			// 			'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
			// 		);
			// 		$this->upload->initialize($config);
			// 		$this->upload->do_upload();
			// 		$g[] = $this->upload->data();
			// 		rename($g[$i]['full_path'], $g[$i]['file_path'] . $namabaru . $g[$i]['file_name']);
			// 		$data = array('nama_file'	=> $namabaru.$g[$i]['file_name'],
			// 						'id_paket'	=> $id_paket,
			// 						'id_tahun'	=> $id_tahun,
			// 						'id_jenis'	=> $id_jenis,
			// 						'id_subdok'	=> 'SUB0028');
			// 		$this->Datafiles_model->data_add($data);
			// 	}
			// }
			// if ($_FILES['na2']['name'][0]!=NULL) {
			// 	$na2count = count($_FILES['na2']['name']);
			// 	for ($i = 0; $i < $na2count; $i++){
			// 		$_FILES['userfile']['name']     = $_FILES['na2']['name'][$i];
			// 		$_FILES['userfile']['type']     = $_FILES['na2']['type'][$i];
			// 		$_FILES['userfile']['tmp_name'] = $_FILES['na2']['tmp_name'][$i];
			// 		$_FILES['userfile']['error']    = $_FILES['na2']['error'][$i];
			// 		$_FILES['userfile']['size']     = $_FILES['na2']['size'][$i];
			// 		$config = array(
			// 			'allowed_types' => '*',
			// 			'overwrite'	=> FALSE,
			// 			'upload_path' => './assets/data/'.$nama_tahun."/".$nama_ppk."/".$main_jenis."/".$sub_jenis."/".$nama_paket."/"
			// 		);
			// 		$this->upload->initialize($config);
			// 		$this->upload->do_upload();
			// 		$h[] = $this->upload->data();
			// 		rename($h[$i]['full_path'], $h[$i]['file_path'] . $namabaru . $h[$i]['file_name']);
			// 		$data = array('nama_file'	=> $namabaru.$h[$i]['file_name'],
			// 						'id_paket'	=> $id_paket,
			// 						'id_tahun'	=> $id_tahun,
			// 						'id_jenis'	=> $id_jenis,
			// 						'id_subdok'	=> 'SUB0029');
			// 		$this->Datafiles_model->data_add($data);
			// 	}
			// }
		}
		if ($this->input->post('topic2')){
			if ($_FILES['bal_ad3']['name'][0]!=NULL) {
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
		}
		$this->session->set_flashdata('berhasil', true);
		redirect('ppk/viewfile/'.$id_jenis."/".$id_paket);
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
		}
		$this->load->view('ppk/updatefilepembangunan',$data);
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
		$this->session->set_flashdata('deleteberhasil',true);
		redirect(base_url('ppk/viewfile/'.$id_jenis."/".$id_paket));
			
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