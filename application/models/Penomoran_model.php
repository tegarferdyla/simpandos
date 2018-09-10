<?php
 defined('BASEPATH') OR exit ('No direct script access allowed');
 /**
  * 
  */
 class Penomoran_model extends CI_Model
 {
 	
 	function __construct()
 	{
 		parent::__construct();
 	}

 	//Penomoran ID PPK
	public function IDPPK() {
		$this->db->select("RIGHT(id_ppk,4) AS kode");
		$this->db->order_by('id_ppk', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get('tbl_ppk');
		if ($query->num_rows() > 0) {
			$data = $query->row();
			$kode = intval($data->kode) + 1;
		} else {
			$kode = 1;
		}
		$kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT);
		$kodejadi = "PPK" . $kodemax;
		return $kodejadi;
	}

	//Penomoran ID PPK
	public function IDUSER() {
		$this->db->select("RIGHT(id_user,4) AS kode");
		$this->db->order_by('id_user', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get('tbl_user');
		if ($query->num_rows() > 0) {
			$data = $query->row();
			$kode = intval($data->kode) + 1;
		} else {
			$kode = 1;
		}
		$kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT);
		$kodejadi = "USR" . $kodemax;
		return $kodejadi;
	}
 }
?>