<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

	/**
	 * 
	 */
	class login extends CI_Controller
	{	
		public function __construct ()
		{
			parent::__construct();
			if (isset($_GET['logout']) == 'signout') {
			$this->session->sess_destroy();
			redirect('');
			}
			else {
					if ($this->session->has_userdata('status')) {
						if ($this->session->userdata('role') == "admin") {
							redirect('admin');
						}else if ($this->session->userdata('bagian')=='Kasatker') {
							redirect('Kasatker');
						}elseif ($this->session->userdata('bagian')=='PPK') {
							redirect('PPK1');
						}elseif ($this->session->userdata('bagian')=='BMN') {
							redirect('Nmn');
						}elseif ($this->session->userdata('bagian')=='Keuangan') {
							redirect('Keuangan');
						}elseif ($this->session->userdata('bagian')=='Bendahara') {
							redirect('Bendahara');
						}    
					}
				}
		}
		public function index()
		{
			$this->load->view('login.php');
		}

		public function ceklogin()
		{
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$where = array 
			(
				'username' => $username,
				'password' => md5($password)
			);
			$cekadmin = $this->Datalogin_model->cekloginadmin('admin', $where)->num_rows();
			$cekuser = $this->Datalogin_model->cekloginuser('tbl_user' , $where)->num_rows();

			if ($cekadmin > 0) {
				$result = $this->db->get_where('admin',$where)->row_array();
				$data_session = array 
				(
					'id_admin' 	=> $result['id_admin'],
					'nama'  	=> $result['nama'],
					'status'	=> "login",
					'role'		=> "admin"
				);
				$this->session->set_userdata($data_session);
				redirect(base_url('admin'));
			}
			elseif ($cekuser > 0) {
				$result = $this->db->get_where('tbl_user',$where)->row_array();
				$data_session = array
				(
					'id_user'	=> $result['id_user'],
					'id_ppk'	=> $result['id_ppk'],
					'bagian'	=> $result['bagian'],
					'status'	=> "login",
					'nama_user'	=> $result['nama_user'] 
				);
				$this->session->set_userdata($data_session);
				if ($this->session->userdata('bagian')== 'PPK') {
					redirect(base_url('ppk'));
				}
			}
			else {
				$this->session->set_flashdata('gagallogin','true');
				redirect('login');
			}

		}
	}
 ?>