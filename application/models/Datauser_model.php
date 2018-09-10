<?php
 defined('BASEPATH') OR exit ('No direct script access allowed');
 /**
  * 
  */
 class Datauser_model extends CI_Model
 {
 	
 	function __construct()
 	{
 		parent::__construct();
 	}

 	public function ceknip($nip)
 	{
 		$this->db->select('*');
        $this->db->from('tbl_user');
        $this->db->where('nip',$nip);
        $query = $this->db->get();
        return $query->num_rows();
 	}

 	public function tambahuser ($data , $table)
    {
        return $this->db->insert($table, $data);
    }

    public function datauserppk ()
    {
    	$query = $this->db->query("select a.nip, a.nama_user, b.nama_ppk as divisi, a.email, a.username, a.id_user from tbl_user a , tbl_ppk b WHERE a.id_ppk = b.id_ppk");
      	return $query->result();    
    }

    public function datauserbmn()
    {
      $query = $this->db->query("select id_user, nip , nama_user , bagian as divisi , email , username from tbl_user where bagian = 'BMN' ");
      return $query->result();  
    }

    public function datauserspm()
    {
      $query = $this->db->query("select id_user, nip , nama_user , bagian as divisi , email , username from tbl_user where bagian = 'SPM' ");
      return $query->result();  
    }

    public function datauserbendahara()
    {
      $query = $this->db->query("select id_user, nip , nama_user , bagian as divisi , email , username from tbl_user where bagian = 'Bendahara' ");
      return $query->result();  
    }

    public function getwhereuser($id_user)
    {
    	$this->db->select('*');
    	$this->db->from('tbl_user');
    	$this->db->where('id_user',$id_user);
    	$query = $this->db->get();
    	return $query->row_array();
    }

    public function Updateuser ($data_update,$id_user)
    {
        $this->db->where('id_user',$id_user);
        return $this->db->update('tbl_user',$data_update);
    }

     public function hapususer($where, $table)
	{
		$this->db->where($where);
		$this->db->delete($table);
	}
 }
?>