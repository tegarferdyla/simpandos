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
		$data['data_user'] = $this->Datauser_model->getwhereuser($id_user);
		$data['data_ppk']  = $this->Datappk_model->getwhereppk($id_ppk);
		$data['data_tahun'] = $this->Datatahun_model->daftartahunppk($id_ppk);
		$data['data_jenis']	= $this->Datajenis_model->subjeniskontraktual();

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

	public function test()
	{
		$id_paket 	= $this->input->post('id_paket');
		$id_ppk 	= $this->session->userdata('id_ppk');
		$nama_ppk	= $this->Datappk_model->getwhereppk($id_ppk);
		$nama_ppk 	= $nama_ppk['nama_ppk'];

		$paket 		= $this->Datapaket_model->getwherepaket($id_paket);
		$id_jenis 	= $paket[0]['id_jenis'];
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
								'id_subdok'	=>	'SUB0001');
				$this->Datafiles_model->data_add($data);
				redirect('ppk/inputdokutama/'.$id_jenis."/".$id_paket,'refresh');
			}
		}
		if ($_FILES['smh']['name'][0]!=NUll) {
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
								'id_subdok'	=>	'SUB0002');
				$this->Datafiles_model->data_add($data);
				redirect('ppk/inputdokutama/'.$id_jenis."/".$id_paket,'refresh');
			}
		}
	}

	public function testinput()
	{
		$this->load->library('upload');
		if (isset($_FILES['smd'])) {
			$smdcount = count($_FILES['smd']['name']);
			for ($i = 0; $i < $smdcount; $i++){
				$_FILES['userfile']['name']     = $_FILES['smd']['name'][$i];
				$_FILES['userfile']['type']     = $_FILES['smd']['type'][$i];
				$_FILES['userfile']['tmp_name'] = $_FILES['smd']['tmp_name'][$i];
				$_FILES['userfile']['error']    = $_FILES['smd']['error'][$i];
				$_FILES['userfile']['size']     = $_FILES['smd']['size'][$i];
				$config = array(
					'allowed_types' => '*',
					'overwrite'     => FALSE,
					'upload_path'	=> './assets/data/'
				);
				$this->upload->initialize($config);
				$this->upload->do_upload();
				$a[] = $this->upload->data();
				print_r($a[$i]['file_name']);
				$data = array('nama_file'	=> $a[$i]['file_name'],
								'id_paket'	=> 'PKT0003',
								'id_subdok'	=>	'SUB0001');
				$this->Datafiles_model->data_add($data);
			}
		}
		if ($_FILES['smh']) {

		}
	}
	public function inputarr()
	{
		$this->load->view('ppk/test');
		// $this->load->view('ppk/footer');
	}
}
 ?>