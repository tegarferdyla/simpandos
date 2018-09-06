<?php 
defined('BASEPATH') OR exit('No direct script are allowed');
/**
 * 
 */
class Datalogin_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function cekloginadmin($table,$where)
	{
		return $this->db->get_where($table,$where);
	}
}

 ?>