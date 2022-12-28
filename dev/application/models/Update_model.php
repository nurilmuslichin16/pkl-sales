<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Update_model extends CI_Model {

    var $table = 'tb_sales';

	public function search_sc($search)
    {
        $this->db->select('sales_id, nama_pelanggan, alamat, unit, tgl_update, tb_sales.status, tb_sales.email, cp, odp, new_sc, myir, tgl_post, message_from, tb_salesman.fullname as nama_sales, tb_users.fullname as user_update');
        $this->db->from('tb_sales');
        $this->db->join('tb_salesman', 'tb_salesman.s_telegram_id = tb_sales.message_from', 'left');
        $this->db->join('tb_users', 'tb_users.users_id = tb_sales.update_by', 'left');
        $where = "(segment = 0 OR segment = 2 OR segment = 3) AND (new_sc = '$search' OR cp = '$search' OR sales_id = '$search' OR myir = '$search')";
        $this->db->where($where);
        return $this->db->get();
    }

    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->join('tb_salesman', 'tb_salesman.s_telegram_id = tb_sales.message_from','left');
        $this->db->where('sales_id',$id);
        $query = $this->db->get();
 
        return $query->row();
    }
 
    public function save($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
 
    public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }
 
    public function delete_by_id($id)
    {
        $this->db->where('sales_id', $id);
        $this->db->delete($this->table);
    }

}

/* End of file Update_model.php */
/* Location: ./application/models/Update_model.php */