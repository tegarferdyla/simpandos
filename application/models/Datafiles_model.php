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

	public function perhitungan($id_tahun, $id_jenis)
	{
		$query = $this->db->query("
			SELECT id_paket , sum(total) hasil , id_jenis from(SELECT id_paket, subdok ,COUNT(subdok) total ,id_jenis FROM (
        		SELECT id_paket , id_subdok subdok ,id_jenis from tbl_file where id_tahun = '$id_tahun' AND id_jenis ='$id_jenis' GROUP By id_paket, id_subdok) a
				GROUP by id_paket , subdok) b
			GROUP by id_paket ORDER by id_paket DESC");
		return $query->result(); 
	}
}

/* End of file Datafiles_model.php */
/* Location: ./application/models/Datafiles_model.php */