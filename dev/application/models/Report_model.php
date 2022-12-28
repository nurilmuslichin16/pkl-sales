<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_model extends CI_Model {

	public function search_sales($fdatel,$fkategori,$fstartdate,$fenddate)
	{
        $this->db->select('tb_sales.*, tb_salesman.fullname, tb_teknisi.nama_teknisi');
        $this->db->from('tb_sales');
        $this->db->join('tb_salesman', 'tb_salesman.s_telegram_id = tb_sales.message_from','left');
        $this->db->join('tb_teknisi', 'tb_teknisi.t_telegram_id = tb_sales.progress_to','left');
        if ($fdatel != 'all') {
        	$this->db->where('tb_sales.datel', $fdatel);
        }
        if ($fkategori != 'all') {
        	$this->db->where('tb_sales.kategori', $fkategori);
        }
        $this->db->where('DATE(tb_sales.tgl_post) >=',$fstartdate);
        $this->db->where('DATE(tb_sales.tgl_post) <=',$fenddate);
        $this->db->where("(tb_sales.segment = 0 OR tb_sales.segment = 2 OR tb_sales.segment = 3)");
        $this->db->order_by('tb_sales.sales_id', 'asc');
        return $this->db->get();
	}

}

/* End of file Report_model.php */
/* Location: ./application/models/Report_model.php */