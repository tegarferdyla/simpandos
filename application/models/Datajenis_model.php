<?php 
defined('BASEPATH') OR exit ('No direct script access allowed');
/**
 * 
 */
class Datajenis_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function daftarjenis()
 	{
 		$this->db->select('*');
		$this->db->from('tbl_jenis');
		$this->db->order_by('main_jenis','ASC');
		$query = $this->db->get();
		return $query->result_array();
 	}

 	public function subjeniskontraktual()
 	{
 		$this->db->select('*');
		$this->db->from('tbl_jenis');
		$this->db->where('main_jenis','Kontraktual');
		$this->db->order_by('main_jenis','ASC');
		$query = $this->db->get();
		return $query->result_array();
 	}

 	public function subjenisswakelola()
 	{
 		$this->db->select('*');
		$this->db->from('tbl_jenis');
		$this->db->where('main_jenis','Swakelola');
		$this->db->order_by('main_jenis','ASC');
		$query = $this->db->get();
		return $query->result_array();
 	}

	public function Tambahjenis($data, $table) 
	{
		return $this->db->insert($table, $data);
	}

	public function getwherejenis($id_jenis)
    {
    	$this->db->select('*');
    	$this->db->from('tbl_jenis');
    	$this->db->where('id_jenis',$id_jenis);
    	$query = $this->db->get();
    	return $query->row_array();
    }

    public function updatejenis ($data_update,$id_jenis)
    {
        $this->db->where('id_jenis',$id_jenis);
        return $this->db->update('tbl_jenis',$data_update);
    }

    public function hapusjenis($where, $table)
	{
		$this->db->where($where);
		$this->db->delete($table);
	}
}
 ?>