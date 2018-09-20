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

	public function daftarkepala($id_jenis)
	{
		$this->db->select('*');
		$this->db->from('tbl_kepaladok');
		$this->db->where('id_jenis', $id_jenis);
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

	public function daftarsubkepaladokutama()
	{
		$query = $this->db->query('SELECT a.id_subdok, a.sub_dokumen, b.nama_kepala,b.kategori FROM tbl_subdok a ,tbl_kepaladok b where a.id_kepaladok = b.id_kepaladok AND b.kategori="Dokumen Utama" ');
		return $query->result_array();
	}

	public function daftarsubkepaladokpend()
	{
		$query = $this->db->query('SELECT a.id_subdok, a.sub_dokumen, b.nama_kepala,b.kategori FROM tbl_subdok a ,tbl_kepaladok b where a.id_kepaladok = b.id_kepaladok AND b.kategori="Dokumen Pendukung" ');
		return $query->result_array();
	}

	public function getwheresubdok($id_subdok)
    {
    	$query = $this->db->query("SELECT a.id_subdok, a.sub_dokumen,a.id_kepaladok, b.nama_kepala FROM tbl_subdok a , tbl_kepaladok b WHERE a.id_kepaladok = b.id_kepaladok AND a.id_subdok = '$id_subdok' ");
    	return $query->row_array();
    }

    public function updatesubdok ($data_update,$id_subdok)
    {
        $this->db->where('id_subdok',$id_subdok);
        return $this->db->update('tbl_subdok',$data_update);
    }

    public function deletesubdok($where, $table)
	{
		$this->db->where($where);
		$this->db->delete($table);
	}

}
 ?>