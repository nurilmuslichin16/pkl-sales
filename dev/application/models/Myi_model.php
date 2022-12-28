<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Myi_model extends CI_Model
{

    var $table = 'tb_sales';
    var $column_order = array('nama_pelanggan', 'datel', null, null, null, null, null, null, 'status_id', null, null, null);
    var $column_search = array('nama_pelanggan', 'sales_id', 'cp', 'status', 'new_sc');
    var $order = array('sales_id' => 'desc');

    public function __construct()
    {
        parent::__construct();
    }

    private function _get_datatables_query()
    {
        $this->db->select('tb_sales.*,tb_salesman.fullname as fullname, tb_users.fullname as updated_by');
        $this->db->from($this->table);
        $this->db->join('tb_salesman', 'tb_salesman.s_telegram_id = tb_sales.message_from');
        $this->db->join('tb_users', 'tb_users.users_id = tb_sales.progress_sc_by', 'left');

        $where = "(sc IS NULL) AND (new_sc IS NULL) AND (myir !=0) AND (status_id = 3 OR status_id = 4 OR status_id = 3 OR status_id = 31 OR status_id = 32 OR status_id = 33 OR status_id = 12 OR status_id = 31) AND (segment = 0)";
        $this->db->where($where);
        $this->db->order_by('tgl_req_sc', 'DESC');

        $i = 0;

        foreach ($this->column_search as $item) // loop column 
        {
            if ($_POST['search']['value']) // if datatable send POST for search
            {

                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->join('tb_salesman', 'tb_salesman.s_telegram_id = tb_sales.message_from');
        $this->db->where('sales_id', $id);
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

    public function tabel_grup()
    {
        $this->db->select('datel,
            SUM(CASE WHEN (status_id=3) THEN 1 ELSE 0 END) as waitsc,
            SUM(CASE WHEN (status_id=4) THEN 1 ELSE 0 END) as progfcc,
            SUM(CASE WHEN (status_id=11) THEN 1 ELSE 0 END) as blmdepo,
            SUM(CASE WHEN (status_id=12) THEN 1 ELSE 0 END) as kendalasc,
            SUM(CASE WHEN (status_id=3 OR status_id=4 OR status_id=11 OR status_id=12) THEN 1 ELSE 0 END) as total');
        $this->db->from('tb_sales');
        $where = "(sc IS NULL) AND (new_sc IS NULL) AND (myir !=0) AND (status_id = 3 OR status_id = 4 OR status_id = 11 OR status_id = 12) AND (segment = 0)";
        $this->db->where($where);
        $this->db->group_by('datel');
        $query = $this->db->get();
        return $query;
    }

    public function tabel_total()
    {
        $this->db->select('datel,
            SUM(CASE WHEN (status_id=3) THEN 1 ELSE 0 END) as waitsc,
            SUM(CASE WHEN (status_id=4) THEN 1 ELSE 0 END) as progfcc,
            SUM(CASE WHEN (status_id=11) THEN 1 ELSE 0 END) as blmdepo,
            SUM(CASE WHEN (status_id=12) THEN 1 ELSE 0 END) as kendalasc,
            SUM(CASE WHEN (status_id=3 OR status_id=4 OR status_id=11 OR status_id=12) THEN 1 ELSE 0 END) as total');
        $this->db->from('tb_sales');
        $where = "(sc IS NULL) AND (new_sc IS NULL) AND (myir !=0) AND (status_id = 3 OR status_id = 4 OR status_id = 11 OR status_id = 12) AND (segment = 0)";
        $this->db->where($where);
        $query = $this->db->get();
        return $query;
    }
}

/* End of file Myi_model.php */
/* Location: ./application/models/Myi_model.php */