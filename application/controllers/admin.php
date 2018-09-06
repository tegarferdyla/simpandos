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
			if (!$this->session->has_userdata('status')){
				redirect('login');
			}
		}

		public function index()
		{
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$this->load->view('admin/dashboard');
			$this->load->view('admin/footer');
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

		public function daftaruser ()
		{
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$this->load->view('admin/daftaruser');
			$this->load->view('admin/footer');
		}

	}
 ?>