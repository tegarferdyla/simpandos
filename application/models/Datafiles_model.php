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
}

/* End of file Datafiles_model.php */
/* Location: ./application/models/Datafiles_model.php */