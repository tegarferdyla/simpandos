<?php
 defined('BASEPATH') OR exit ('No direct script access allowed');
 /**
  * 
  */
 class Datappk_model extends CI_Model
 {
 	
 	function __construct()
 	{
 		parent::__construct();
 	}

 	public function daftarppk()
 	{
 		$this->db->select('*');
		$this->db->from('tbl_ppk');
		$query = $this->db->get();
		return $query->result_array();
 	}

 	public function cekppk($namappk)
 	{
 		$this->db->select('*');
        $this->db->from('tbl_ppk');
        $this->db->where('nama_ppk',$namappk);
        $query = $this->db->get();
        return $query->num_rows();
 	}

 	public function tambahppk ($data , $table)
    {
        return $this->db->insert($table, $data);
    }

    public function getwhereppk($id_ppk)
    {
    	$this->db->select('*');
    	$this->db->from('tbl_ppk');
    	$this->db->where('id_ppk',$id_ppk);
    	$query = $this->db->get();
    	return $query->row_array();
    }

    public function Updateppk ($data_update,$id_ppk)
    {
        $this->db->where('id_ppk',$id_ppk);
        return $this->db->update('tbl_ppk',$data_update);
    }
    
    public function hapusppk($where, $table)
	{
		$this->db->where($where);
		$this->db->delete($table);
	}

    public function jumlahppk ()
    {
        $this->db->select('*');
        $this->db->from('tbl_ppk');
        $query = $this->db->get();
        return $query->num_rows();
    }
 }
?>