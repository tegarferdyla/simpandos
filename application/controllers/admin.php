<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
	/**
	 * 
	 */
	class admin extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			if (!$this->session->has_userdata('status')) {
				redirect('login');
			}else if ($this->session->userdata('bagian') == 'PPK') {
				redirect('ppk');
			}
		}

		public function index()
		{
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$data['jmluser']  = $this->Datauser_model->jumlahuser();
			$data['jmlppk']  = $this->Datappk_model->jumlahppk();	
			$data['data_ppk'] = $this->Datappk_model->daftarppk();
			$this->load->view('admin/dashboard', $data);
			$this->load->view('admin/footer',$data);
		}

		//----------------------------------------------------------
		//----------------------- Start Of PPK ---------------------
		//----------------------------------------------------------
		
		public function daftarppk ()
		{
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$data['data_ppk'] = $this->Datappk_model->daftarppk();
			$this->load->view('admin/daftarppk',$data);
			$this->load->view('admin/footer');
		}

		public function inputppk ()
		{
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$this->load->view('admin/inputppk');
			$this->load->view('admin/footer');
		}

		public function tambahppk()
		{
			$namappk = $this->input->post('namappk');
			$keterangan = $this->input->post('keterangan');
			$data = array (
				'id_ppk'		=> $this->Penomoran_model->IDPPK(),
				'nama_ppk'			=> $namappk,
				'keterangan' 	=> $keterangan
			);
			$ceknama = $this->Datappk_model->cekppk($namappk);
			if ($ceknama > 0) {
				$this->session->set_flashdata('namatersedia','true');
				redirect('admin/inputppk');
			}
			else {
				$input = $this->Datappk_model->tambahppk($data,'tbl_ppk');
				if ($input > 0) {
					$this->session->set_flashdata('berhasil','true');
					redirect(base_url('admin/daftarppk'));
				}
				else {
					$this->session->set_flashdata('gagal','true');
					redirect(base_url('admin/inputppk'));
				}
			}
		}

		public function editppk($id_ppk)
		{
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$data['get_ppk'] = $this->Datappk_model->getwhereppk($id_ppk); 
			$this->load->view('admin/editppk',$data);
			$this->load->view('admin/footer');
		}

		public function updateppk ()
		{
			$id_ppk		= $this->input->post('id_ppk');
			$nama_ppk 	= $this->input->post('namappk');
			$keterangan = $this->input->post('keterangan');

			$data_update = array (
				'id_ppk' 		=> $id_ppk,
				'nama_ppk' 		=> $nama_ppk,
				'keterangan'	=> $keterangan
			);
			$result = $this->Datappk_model->Updateppk($data_update, $id_ppk);
			if ($result > 0) {
				$this->session->set_flashdata('updateberhasil','true');
				redirect('admin/daftarppk');
			}
			else {
				$this->session->set_flashdata('updategagal','true');
				redirect('admin/daftarppk');
			}
		}

		public function hapusppk ($id_ppk)
		{
			$where = array ('id_ppk' =>$id_ppk);
			$result = $this->Datappk_model->hapusppk($where, 'tbl_ppk');
			$this->session->set_flashdata('deleteberhasil','true');
			redirect(base_url('admin/daftarppk'));
		}
		//----------------------------------------------------------
		//----------------------- End Of PPK -----------------------
		//----------------------------------------------------------

		//----------------------------------------------------------
		//----------------------- Star Of User -----------------------
		//----------------------------------------------------------

		public function daftaruser ()
		{
			$this->load->view('admin/header');
			$data['user_ppk'] = $this->Datauser_model->datauserppk();
			$data['user_bmn'] = $this->Datauser_model->datauserbmn();
			$data['user_spm'] = $this->Datauser_model->datauserspm();
			$data['user_bendahara'] = $this->Datauser_model->datauserbendahara();
			$this->load->view('admin/sidebar');
			$this->load->view('admin/daftaruser',$data);
			$this->load->view('admin/footer');
		}

		public function inputuser()
		{
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$data['data_ppk'] = $this->Datappk_model->daftarppk();
			$this->load->view('admin/inputuser',$data);
			$this->load->view('admin/footer');
		}

		public function tambahuserppk()
		{
			$this->form_validation->set_rules('nip' ,'NIP','trim|required|numeric|max_length[16]');
			$this->load->library('generate_token');

			if ($this->form_validation->run() == FALSE) {
				$this->load->view('admin/header');
				$this->load->view('admin/sidebar');
				$data['data_ppk'] = $this->Datappk_model->daftarppk();
				$this->load->view('admin/inputuser',$data);
				$this->load->view('admin/footer');
			}
			else {
				$nip 		= $this->input->post('nip');
				$nama 		= $this->input->post('nama');
				$id_ppk		= $this->input->post('id_ppk');
				$email		= $this->input->post('email');
				$alamat		= $this->input->post('alamat');
				$username	= $this->input->post('username');
				$password	= $this->generate_token->get_token(8);

				$data = array 
				(
					'id_user'		=> $this->Penomoran_model->IDUSER(),
					'username'		=> $username,
					'password'		=> md5($password),
					'nip'			=> $nip,
					'nama_user'		=> $nama,
					'bagian'		=> 'PPK',
					'email'			=> $email,
					'alamat'		=> $alamat,
					'foto'			=> 'default-avatar.jpg',
					'id_ppk'		=> $id_ppk
				);
				$resultchecknip = $this->Datauser_model->ceknip($nip);
				if ($resultchecknip > 0) {
					$this->session->set_flashdata('nipsalah','true');
					redirect('admin/inputuser');
				}
				else {
					$input = $this->Datauser_model->tambahuser($data,'tbl_user');
					if ($input > 0) {
						$this->load->library('email');
					    $config = array();
					    $config['charset'] = 'utf-8';
					    $config['useragent'] = 'Codeigniter';
					    $config['protocol']= "smtp";
					    $config['mailtype']= "html";
					    $config['smtp_host']= "ssl://smtp.gmail.com";//pengaturan smtp
					    $config['smtp_port']= "465";
					    $config['smtp_timeout']= "400";
					    $config['smtp_user']= "sipad.information@gmail.com"; // isi dengan email kamu
					    $config['smtp_pass']= "coba12345"; // isi dengan password kamu
					    $config['crlf']="\r\n"; 
					    $config['newline']="\r\n"; 
					    $config['wordwrap'] = TRUE;
					    //memanggil library email dan set konfigurasi untuk pengiriman email
					   
					    $this->email->initialize($config);
					    //konfigurasi pengiriman
					    $this->email->from('SIPAD Information');
					    $this->email->to($email);
					    $this->email->subject("Notifikasi");
					    $this->email->message(
					     "Selamat , ".$nama." akun anda berhasil dibuat dengan <br>
					     Username : ".$username." dan Password : ".$password
					    );
					    if($this->email->send())
					    {
							$this->session->set_flashdata('ppkberhasil','true');
							redirect(base_url('admin/daftaruser'));
						}
					}
					else{
						$this->session->set_flashdata('gagal','true');
						redirect(base_url('admin/inputuser'));
					}
				}
			}							
		}

		public function tambahuserbmn ()
		{
			$this->form_validation->set_rules('nip' ,'NIP','trim|required|numeric|max_length[16]');
			$this->load->library('generate_token');

			if ($this->form_validation->run() == FALSE) {
				$this->load->view('admin/header');
				$this->load->view('admin/sidebar');
				$data['data_ppk'] = $this->Datappk_model->daftarppk();
				$this->load->view('admin/inputuser',$data);
				$this->load->view('admin/footer');
			}
			else {
				$nip 		= $this->input->post('nip');
				$nama 		= $this->input->post('nama');
				$bagian		= $this->input->post('bagian');
				$email		= $this->input->post('email');
				$alamat 	= $this->input->post('alamat');
				$username 	= $this->input->post('username');
				$password	= $this->generate_token->get_token(8);

				$data = array 
				(
					'id_user'		=> $this->Penomoran_model->IDUSER(),
					'username'		=> $username,
					'password'		=> md5($password),
					'nip'			=> $nip,
					'nama_user'		=> $nama,
					'bagian'		=> $bagian,
					'email'			=> $email,
					'alamat'		=> $alamat,
					'foto'			=> 'default-avatar.jpg',
					'id_ppk'		=> ""
				);
				$resultchecknip = $this->Datauser_model->ceknip($nip);
				if ($resultchecknip > 0) {
					$this->session->set_flashdata('nipsalah','true');
					redirect('admin/inputuser');
				}
				else {
					$input = $this->Datauser_model->tambahuser($data,'tbl_user');
					if ($input > 0) {
						$this->load->library('email');
					    $config = array();
					    $config['charset'] = 'utf-8';
					    $config['useragent'] = 'Codeigniter';
					    $config['protocol']= "smtp";
					    $config['mailtype']= "html";
					    $config['smtp_host']= "ssl://smtp.gmail.com";//pengaturan smtp
					    $config['smtp_port']= "465";
					    $config['smtp_timeout']= "400";
					    $config['smtp_user']= "sipad.information@gmail.com"; // isi dengan email kamu
					    $config['smtp_pass']= "coba12345"; // isi dengan password kamu
					    $config['crlf']="\r\n"; 
					    $config['newline']="\r\n"; 
					    $config['wordwrap'] = TRUE;
					    //memanggil library email dan set konfigurasi untuk pengiriman email
					   
					    $this->email->initialize($config);
					    //konfigurasi pengiriman
					    $this->email->from('SIPAD Information');
					    $this->email->to($email);
					    $this->email->subject("Notifikasi");
					    $this->email->message(
					     "Selamat , ".$nama." akun anda berhasil dibuat dengan <br>
					     Username : ".$username." dan Password : ".$password
					    );
					    if($this->email->send())
					    {
							$this->session->set_flashdata('bmnberhasil','true');
							redirect(base_url('admin/daftaruser'));
						}
					}
					else{
						$this->session->set_flashdata('gagal','true');
						redirect(base_url('admin/inputuser'));
					}
				}
			}
		}

		public function tambahuserspm ()
		{
			$this->form_validation->set_rules('nip' ,'NIP','trim|required|numeric|max_length[16]');
			$this->load->library('generate_token');

			if ($this->form_validation->run() == FALSE) {
				$this->load->view('admin/header');
				$this->load->view('admin/sidebar');
				$data['data_ppk'] = $this->Datappk_model->daftarppk();
				$this->load->view('admin/inputuser',$data);
				$this->load->view('admin/footer');
			}
			else {
				$nip 		= $this->input->post('nip');
				$nama 		= $this->input->post('nama');
				$bagian		= $this->input->post('bagian');
				$email		= $this->input->post('email');
				$alamat 	= $this->input->post('alamat');
				$username 	= $this->input->post('username');
				$password	= $this->generate_token->get_token(8);

				$data = array 
				(
					'id_user'		=> $this->Penomoran_model->IDUSER(),
					'username'		=> $username,
					'password'		=> md5($password),
					'nip'			=> $nip,
					'nama_user'		=> $nama,
					'bagian'		=> $bagian,
					'email'			=> $email,
					'alamat'		=> $alamat,
					'foto'			=> 'default-avatar.jpg',
					'id_ppk'		=> ""
				);
				$resultchecknip = $this->Datauser_model->ceknip($nip);
				if ($resultchecknip > 0) {
					$this->session->set_flashdata('nipsalah','true');
					redirect('admin/inputuser');
				}
				else {
					$input = $this->Datauser_model->tambahuser($data,'tbl_user');
					if ($input > 0) {
						$this->load->library('email');
					    $config = array();
					    $config['charset'] = 'utf-8';
					    $config['useragent'] = 'Codeigniter';
					    $config['protocol']= "smtp";
					    $config['mailtype']= "html";
					    $config['smtp_host']= "ssl://smtp.gmail.com";//pengaturan smtp
					    $config['smtp_port']= "465";
					    $config['smtp_timeout']= "400";
					    $config['smtp_user']= "sipad.information@gmail.com"; // isi dengan email kamu
					    $config['smtp_pass']= "coba12345"; // isi dengan password kamu
					    $config['crlf']="\r\n"; 
					    $config['newline']="\r\n"; 
					    $config['wordwrap'] = TRUE;
					    //memanggil library email dan set konfigurasi untuk pengiriman email
					   
					    $this->email->initialize($config);
					    //konfigurasi pengiriman
					    $this->email->from('SIPAD Information');
					    $this->email->to($email);
					    $this->email->subject("Notifikasi");
					    $this->email->message(
					     "Selamat , ".$nama." akun anda berhasil dibuat dengan <br>
					     Username : ".$username." dan Password : ".$password
					    );
					    if($this->email->send())
					    {
							$this->session->set_flashdata('spmberhasil','true');
							redirect(base_url('admin/daftaruser'));
						}
					}
					else{
						$this->session->set_flashdata('gagal','true');
						redirect(base_url('admin/inputuser'));
					}
				}
			}
		}

		public function tambahuserbendahara ()
		{
			$this->form_validation->set_rules('nip' ,'NIP','trim|required|numeric|max_length[16]');
			$this->load->library('generate_token');

			if ($this->form_validation->run() == FALSE) {
				$this->load->view('admin/header');
				$this->load->view('admin/sidebar');
				$data['data_ppk'] = $this->Datappk_model->daftarppk();
				$this->load->view('admin/inputuser',$data);
				$this->load->view('admin/footer');
			}
			else {
				$nip 		= $this->input->post('nip');
				$nama 		= $this->input->post('nama');
				$bagian		= $this->input->post('bagian');
				$email		= $this->input->post('email');
				$alamat 	= $this->input->post('alamat');
				$username 	= $this->input->post('username');
				$password	= $this->generate_token->get_token(8);

				$data = array 
				(
					'id_user'		=> $this->Penomoran_model->IDUSER(),
					'username'		=> $username,
					'password'		=> md5($password),
					'nip'			=> $nip,
					'nama_user'		=> $nama,
					'bagian'		=> $bagian,
					'email'			=> $email,
					'alamat'		=> $alamat,
					'foto'			=> 'default-avatar.jpg',
					'id_ppk'		=> ""
				);
				$resultchecknip = $this->Datauser_model->ceknip($nip);
				if ($resultchecknip > 0) {
					$this->session->set_flashdata('nipsalah','true');
					redirect('admin/inputuser');
				}
				else {
					$input = $this->Datauser_model->tambahuser($data,'tbl_user');
					if ($input > 0) {
						$this->load->library('email');
					    $config = array();
					    $config['charset'] = 'utf-8';
					    $config['useragent'] = 'Codeigniter';
					    $config['protocol']= "smtp";
					    $config['mailtype']= "html";
					    $config['smtp_host']= "ssl://smtp.gmail.com";//pengaturan smtp
					    $config['smtp_port']= "465";
					    $config['smtp_timeout']= "400";
					    $config['smtp_user']= "sipad.information@gmail.com"; // isi dengan email kamu
					    $config['smtp_pass']= "coba12345"; // isi dengan password kamu
					    $config['crlf']="\r\n"; 
					    $config['newline']="\r\n"; 
					    $config['wordwrap'] = TRUE;
					    //memanggil library email dan set konfigurasi untuk pengiriman email
					   
					    $this->email->initialize($config);
					    //konfigurasi pengiriman
					    $this->email->from('SIPAD Information');
					    $this->email->to($email);
					    $this->email->subject("Notifikasi");
					    $this->email->message(
					     "Selamat , ".$nama." akun anda berhasil dibuat dengan <br>
					     Username : ".$username." dan Password : ".$password
					    );
					    if($this->email->send())
					    {
							$this->session->set_flashdata('bendaharaberhasil','true');
							redirect(base_url('admin/daftaruser'));
						}
					}
					else{
						$this->session->set_flashdata('gagal','true');
						redirect(base_url('admin/inputuser'));
					}
				}
			}
		}

		public function edituser($id_user)
		{
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$data['get_user'] = $this->Datauser_model->getwhereuser($id_user); 
			$this->load->view('admin/edituser',$data);
			$this->load->view('admin/footer');
		}

		public function updateuser()
		{
			$id_user 	= $this->input->post('id_user');
			$nip 		= $this->input->post('nip');
			$nama_user	= $this->input->post('nama');
			$bagian 	= $this->input->post('bagian');
			$email		= $this->input->post('email');
			$alamat		= $this->input->post('alamat');
			$username	= $this->input->post('username');

			$data_update = array (
				'id_user' 		=> $id_user,
				'nip' 			=> $nip,
				'nama_user' 	=> $nama_user,
				'email'			=> $email,
				'alamat'		=> $alamat,
				'username'		=> $username
			);
			$result = $this->Datauser_model->Updateuser($data_update, $id_user);
			if ($result > 0) {
				$this->session->set_flashdata('updateberhasil','true');
				redirect('admin/daftaruser');
			}
			else {
				$this->session->set_flashdata('updategagal','true');
				redirect('admin/daftaruser');
			}

		}

		public function hapususer ($id_user)
		{
			$where = array ('id_user' =>$id_user);
			$result = $this->Datauser_model->hapususer($where, 'tbl_user');
			$this->session->set_flashdata('deleteberhasil','true');
			redirect(base_url('admin/daftaruser'));
		}

		public function gantipassword ()
		{
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$this->load->view('admin/gantipassword');
			$this->load->view('admin/footer');
		}

		public function updatepassword ()
		{
			$id_admin 	= $this->session->userdata('id_admin');
			$oldpassword = $this->input->post('oldpassword');
			$newpassword = $this->input->post('newpassword');
			$renewpassword = $this->input->post('renewpassword');

			$data['admin'] = $this->Datauser_model->getwhereadmin($id_admin);
			$validasipass = $data['admin']['password'];

			if ($validasipass != md5($oldpassword)) {
				$this->session->set_flashdata('passwordsalah','true');
				redirect('admin/gantipassword');
			}
			elseif ($newpassword != $renewpassword) {
				$this->session->set_flashdata('passwordtidaksesuai','true');
				redirect('admin/gantipassword');	
			} else {
				$data_update = array('password'	=> md5($newpassword));
				$result = $this->Datauser_model->Updateadmin($data_update,$id_admin);
				if ($result > 0) {
					$this->session->set_flashdata('berhasil','true');
					redirect('admin/gantipassword');
				}				
			}

		}

		//----------------------------------------------------------
		//----------------------- End Of User ----------------------
		//----------------------------------------------------------

		//----------------------------------------------------------
		//----------------------- Start Of Jenis -------------------
		//----------------------------------------------------------

		public function daftarjenis()
		{
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$data['data_jenis']  = $this->Datajenis_model->daftarjenis();
			$this->load->view('admin/daftarjenis',$data);
			$this->load->view('admin/footer');
		}

		public function inputjenis()
		{
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$this->load->view('admin/inputjenis');
			$this->load->view('admin/footer');
		}

		public function tambahjenis()
		{
			$nama_jenis = $this->input->post('nama_jenis');
			$deskripsi	= $this->input->post('keterangan');
		
			if (!$this->input->post('topic1')) {
				$data = array (
					'id_jenis' 		=> $this->Penomoran_model->IDJENIS(),
					'main_jenis'	=> $nama_jenis,
					'sub_jenis'		=> "",
					'keterangan'	=> $deskripsi
				);
				$input = $this->Datajenis_model->tambahjenis($data, 'tbl_jenis');
				if ($input > 0) {
					$this->session->set_flashdata('berhasil','true');
					redirect('admin/daftarjenis');
				}
			}
			else{
				$sub_jenis	= $this->input->post('sub_jenis');
				$data = array (
					'id_jenis' 		=> $this->Penomoran_model->IDJENIS(),
					'main_jenis'	=> $nama_jenis,
					'sub_jenis'		=> $sub_jenis,
					'keterangan'	=> $deskripsi
				);
				$input = $this->Datajenis_model->tambahjenis($data, 'tbl_jenis');
				if ($input > 0) {
					$this->session->set_flashdata('berhasil','true');
					redirect('admin/daftarjenis');
				}
			}

			
		}
		public function editjenis($id_jenis)
		{
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$data['get_jenis']  = $this->Datajenis_model->getwherejenis($id_jenis);
			$this->load->view('admin/editjenis',$data);
			$this->load->view('admin/footer');
		}

		public function updatejenis()
		{
			$id_jenis 	= $this->input->post('id_jenis');
			$nama_jenis = $this->input->post('nama_jenis');
			$sub_jenis	= $this->input->post('sub_jenis');
			$deskripsi	= $this->input->post('keterangan');

			$data_update = array (
				'id_jenis' 		=> $id_jenis,
				'main_jenis' 	=> $nama_jenis,
				'sub_jenis' 	=> $sub_jenis,
				'keterangan'	=> $deskripsi
			);
			$result = $this->Datajenis_model->updatejenis($data_update, $id_jenis);
			if ($result > 0) {
				$this->session->set_flashdata('updateberhasil','true');
				redirect('admin/daftarjenis');
			}
			else {
				$this->session->set_flashdata('updategagal','true');
				redirect('admin/daftarjenis');
			}
		}

		public function hapusjenis($id_jenis)
		{
			$where = array ('id_jenis' =>$id_jenis);
			$result = $this->Datajenis_model->hapusjenis($where, 'tbl_jenis');
			$this->session->set_flashdata('deleteberhasil','true');
			redirect(base_url('admin/daftarjenis'));
		}
		//----------------------------------------------------------
		//----------------------- End Of Jenis ---------------------
		//----------------------------------------------------------

	}
 ?>