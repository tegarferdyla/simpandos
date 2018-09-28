<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datafiles_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}

	public function data_add($data)
	{
		return $this->db->insert('tbl_file', $data);
	}

	public function daftarfile($id_paket)
	{
		$this->db->select('*');
		$this->db->from('tbl_file');
		$this->db->where('id_paket',$id_paket);
		// $this->db->where('id_subdok',$id_subdok);
		$query = $this->db->get();
		return $query->result_array();
	}
	public function daftarsubdok($id_paket,$id_subdok)
	{
		$this->db->select('*');
		$this->db->from('tbl_file');
		$this->db->where('id_paket',$id_paket);
		$this->db->where('id_subdok',$id_subdok);
		$query = $this->db->get();
		return $query->result_array();
	}
	public function getwherefile($id_file)
	{
		$this->db->select('*');
		$this->db->from('tbl_file');
		$this->db->where('id_file', $id_file);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function hapusfile($where, $table)
	{
		$this->db->where($where);
		$this->db->delete($table);
	}
}

/* End of file Datafiles_model.php */
/* Location: ./application/models/Datafiles_model.php */