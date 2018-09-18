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

	//Penomoran ID PPK
	public function IDTahun() {
		$this->db->select("RIGHT(id_tahun,4) AS kode");
		$this->db->order_by('id_tahun', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get('tbl_tahun');
		if ($query->num_rows() > 0) {
			$data = $query->row();
			$kode = intval($data->kode) + 1;
		} else {
			$kode = 1;
		}
		$kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT);
		$kodejadi = "THN" . $kodemax;
		return $kodejadi;
	}

	public function IDJENIS() {
		$this->db->select("RIGHT(id_jenis,4) AS kode");
		$this->db->order_by('id_jenis', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get('tbl_jenis');
		if ($query->num_rows() > 0) {
			$data = $query->row();
			$kode = intval($data->kode) + 1;
		} else {
			$kode = 1;
		}
		$kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT);
		$kodejadi = "JNS" . $kodemax;
		return $kodejadi;
	}

	public function IDPaket() {
		$this->db->select("RIGHT(id_paket,4) AS kode");
		$this->db->order_by('id_paket', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get('tbl_paket');
		if ($query->num_rows() > 0) {
			$data = $query->row();
			$kode = intval($data->kode) + 1;
		} else {
			$kode = 1;
		}
		$kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT);
		$kodejadi = "PKT" . $kodemax;
		return $kodejadi;
	}

	public function IDDOKUMEN() {
		$this->db->select("RIGHT(id_kepaladok,4) AS kode");
		$this->db->order_by('id_kepaladok', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get('tbl_kepaladok');
		if ($query->num_rows() > 0) {
			$data = $query->row();
			$kode = intval($data->kode) + 1;
		} else {
			$kode = 1;
		}
		$kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT);
		$kodejadi = "KPL" . $kodemax;
		return $kodejadi;
	}

	public function IDSUBDOKUMEN() {
		$this->db->select("RIGHT(id_subdok,4) AS kode");
		$this->db->order_by('id_subdok', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get('tbl_subdok');
		if ($query->num_rows() > 0) {
			$data = $query->row();
			$kode = intval($data->kode) + 1;
		} else {
			$kode = 1;
		}
		$kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT);
		$kodejadi = "SUB" . $kodemax;
		return $kodejadi;
	}
 }
?>