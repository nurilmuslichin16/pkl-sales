<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api_model extends CI_Model
{

	public function getSales($sales_id)
	{
		$this->db->select("sales_id, datel, unit, nama_pelanggan, alamat, lat_long, cp");
		$this->db->from('tb_sales');
		$this->db->where('sales_id', $sales_id);

		$query = $this->db->get();
		return $query;
	}
}

/* End of file Dashboard_model.php */
/* Location: ./application/models/Dashboard_model.php */