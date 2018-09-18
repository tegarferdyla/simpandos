\<?php 
defined('BASEPATH') OR exit ('No direct script access allowed');
/**
 * 
 */
class Datatahun_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function Tambahtahun($data, $table) 
	{
		return $this->db->insert($table, $data);
	}

	public function validasitahun($nama_tahun,$id_ppk)
	{
		$this->db->select('*');
        $this->db->from('tbl_tahun');
        $this->db->where('nama_tahun',$nama_tahun);
        $this->db->where('id_ppk',$id_ppk);
        $query = $this->db->get();
        return $query->num_rows();
	}

	public function daftartahun ()
	{
		$this->db->select('*');
		$this->db->from('tbl_tahun');
		$this->db->order_by('nama_tahun','ASC');
		$query = $this->db->get();
		return $query->result_array();
	}
	public function daftartahunppk ($id_ppk)
	{
		$this->db->select('*');
		$this->db->from('tbl_tahun');
		$this->db->where('id_ppk' ,$id_ppk);
		$this->db->order_by('nama_tahun','ASC');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getwheretahun($id_tahun)
    {
    	$this->db->select('*');
    	$this->db->from('tbl_tahun');
    	$this->db->where('id_tahun',$id_tahun);
    	$query = $this->db->get();
    	return $query->row_array();
    }
}
 ?>