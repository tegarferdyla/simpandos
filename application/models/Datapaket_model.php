<?php 
defined('BASEPATH') OR exit ('No direct script access allowed');
/**
 * 
 */
class Datapaket_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function Tambahpaket($data, $table) {
		return $this->db->insert($table, $data);
	}
	
	public function validasipaket($nama_paket,$id_tahun)
	{
		$this->db->select('*');
        $this->db->from('tbl_paket');
        $this->db->where('nama_paket',$nama_paket);
        $this->db->where('id_tahun',$id_tahun);
        $query = $this->db->get();
        return $query->num_rows();
	}
}
 ?>