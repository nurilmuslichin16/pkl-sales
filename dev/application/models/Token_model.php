<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Token_model extends CI_Model
{
    var $table = 'tb_token';

    public function getToken($user_id, $type)
    {
        $this->db->select("*");
        $this->db->from($this->table);
        $this->db->join('tb_users', 'tb_users.users_id = tb_token.users_id');
        $this->db->where(['tb_token.users_id' => $user_id, 'type' => $type]);

        $query = $this->db->get();
        return $query;
    }

    public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }
}

/* End of file Dashboard_model.php */
/* Location: ./application/models/Dashboard_model.php */