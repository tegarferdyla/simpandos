<?php 
defined('BASEPATH') OR exit ('No direct script access allowed');
/**
 * 
 */
class Datadokumen_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	// ------------------------------------------
	// ------------- Kepala Dokumen -------------
	// ------------------------------------------ 
	public function Tambahdokumen($data, $table) 
	{
		return $this->db->insert($table, $data);
	}

	public function daftarkepaladok()
	{
		$this->db->select('*');
		$this->db->from('tbl_kepaladok');
		$this->db->where('kategori','Dokumen Utama');
		$query = $this->db->get();
		return $query->result_array();
	}
	public function daftarkepaladokpend()
	{
		$this->db->select('*');
		$this->db->from('tbl_kepaladok');
		$this->db->where('kategori','Dokumen Pendukung');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function daftarkepaladokumenutama()
	{
		$query = $this->db->query("SELECT a.id_kepaladok , a.nama_kepala , a.kategori, b.main_jenis , b.sub_jenis from tbl_kepaladok a , tbl_jenis b where a.id_jenis = b.id_jenis and a.kategori ='Dokumen Utama'");
      	return $query->result();
	}

	public function daftarkepaladokumenpendukung()
	{
		$this->db->select('*');
		$this->db->from('tbl_kepaladok');
		$this->db->where('kategori', 'Dokumen Pendukung');
		$query = $this->db->get();
		return $query->result();
	}

	// ----------------------------------------------
	// ------------- Sub Kepala Dokumen -------------
	// ---------------------------------------------- 

	public function Tambahsubdokumen($data, $table) 
	{
		return $this->db->insert($table, $data);
	}

}
 ?>