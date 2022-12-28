<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Project_model extends CI_Model
{

    public function resume_prj($start, $end)
    {
        $this->db->select("
                datel,
                SUM(CASE WHEN (status = '11') THEN 1 ELSE 0 END) as sp,
                SUM(CASE WHEN (status = '22') THEN 1 ELSE 0 END) as deploy,
                SUM(CASE WHEN (status = '33') THEN 1 ELSE 0 END) as golive,
                SUM(CASE WHEN (status = '44') THEN 1 ELSE 0 END) as kc,
                SUM(CASE WHEN (status = '55') THEN 1 ELSE 0 END) as redesain,
                SUM(CASE WHEN (status = '66') THEN 1 ELSE 0 END) as approval_amo,
				SUM(CASE WHEN (status = '77') THEN 1 ELSE 0 END) as next_project,
				SUM(CASE WHEN (status = '88') THEN 1 ELSE 0 END) as selesai_golive,
                SUM(CASE WHEN (status = '99' OR status = '100') THEN 1 ELSE 0 END) as terminate,
                SUM(CASE WHEN (status = '10') THEN 1 ELSE 0 END) as approval_datel,
                SUM(CASE WHEN (status = '22' OR status = '33' OR status = '44' OR status = '55' OR status = '66' OR status = '10' OR status = '100') THEN 1 ELSE 0 END) as subtotal
            ");
        $this->db->from('tb_project');
        if ($start != null && $end != null) {
            $this->db->where('last_update >=', $start);
            $this->db->where('last_update <=', $end);
        }
        $this->db->group_by('datel');
        $this->db->order_by('datel', 'ASC');
        $query = $this->db->get();
        return $query;
    }

    public function resume_total_prj($start, $end)
    {
        $this->db->select("
                datel,
                SUM(CASE WHEN (status = '11') THEN 1 ELSE 0 END) as sp,
                SUM(CASE WHEN (status = '22') THEN 1 ELSE 0 END) as deploy,
                SUM(CASE WHEN (status = '33') THEN 1 ELSE 0 END) as golive,
                SUM(CASE WHEN (status = '44') THEN 1 ELSE 0 END) as kc,
                SUM(CASE WHEN (status = '55') THEN 1 ELSE 0 END) as redesain,
                SUM(CASE WHEN (status = '66') THEN 1 ELSE 0 END) as approval_amo,
				SUM(CASE WHEN (status = '77') THEN 1 ELSE 0 END) as next_project,
				SUM(CASE WHEN (status = '88') THEN 1 ELSE 0 END) as selesai_golive,
                SUM(CASE WHEN (status = '99' OR status = '100') THEN 1 ELSE 0 END) as terminate,
                SUM(CASE WHEN (status = '10') THEN 1 ELSE 0 END) as approval_datel,
                SUM(CASE WHEN (status = '22' OR status = '33' OR status = '44' OR status = '55' OR status = '66' OR status = '10' OR status = '100') THEN 1 ELSE 0 END) as subtotal
            ");
        $this->db->from('tb_project');
        if ($start != null && $end != null) {
            $this->db->where('last_update >=', $start);
            $this->db->where('last_update <=', $end);
        }
        $query = $this->db->get();
        return $query;
    }

    public function deploy_progress($datel)
    {
        $this->db->select("
        datel,
        SUM(CASE WHEN (progress = 'PERSIAPAN DAN TUNJUK MITRA DEPLOYER') THEN 1 ELSE 0 END) as tunjuk_mitra,
        SUM(CASE WHEN (progress = 'DELIVERY MATERIAL') THEN 1 ELSE 0 END) as delivery_material,
        SUM(CASE WHEN (progress = 'PENANAMAN TIANG') THEN 1 ELSE 0 END) as tanam_tiang,
        SUM(CASE WHEN (progress = 'PENARIKAN KABEL') THEN 1 ELSE 0 END) as tarik_kabel,
        SUM(CASE WHEN (progress = 'INSTALL ODP') THEN 1 ELSE 0 END) as install_odp,
        SUM(CASE WHEN (progress = 'PENYAMBUNGAN') THEN 1 ELSE 0 END) as penyambungan,
        SUM(CASE WHEN (progress = 'SELESAI FISIK & MENUNGGU MAINCORE') THEN 1 ELSE 0 END) as selesai_fisik,
        SUM(CASE WHEN (progress = 'PERBAIKAN MAINCORE') THEN 1 ELSE 0 END) as perbaikan_mc,
        SUM(CASE WHEN (status LIKE '22%') THEN 1 ELSE 0 END) as total,
    ");
        $this->db->from('tb_project');
        $this->db->where('status', 22);
        if ($datel != 'all') {
            $this->db->where('datel', $datel);
        }
        if ($datel == 'all') {
            $this->db->group_by('datel');
        }
        $query = $this->db->get();
        return $query;
    }

    public function deploy_progress_total($datel)
    {
        $this->db->select("
        datel,
        SUM(CASE WHEN (progress = 'PERSIAPAN DAN TUNJUK MITRA DEPLOYER') THEN 1 ELSE 0 END) as tunjuk_mitra,
        SUM(CASE WHEN (progress = 'DELIVERY MATERIAL') THEN 1 ELSE 0 END) as delivery_material,
        SUM(CASE WHEN (progress = 'PENANAMAN TIANG') THEN 1 ELSE 0 END) as tanam_tiang,
        SUM(CASE WHEN (progress = 'PENARIKAN KABEL') THEN 1 ELSE 0 END) as tarik_kabel,
        SUM(CASE WHEN (progress = 'INSTALL ODP') THEN 1 ELSE 0 END) as install_odp,
        SUM(CASE WHEN (progress = 'PENYAMBUNGAN') THEN 1 ELSE 0 END) as penyambungan,
        SUM(CASE WHEN (progress = 'SELESAI FISIK & MENUNGGU MAINCORE') THEN 1 ELSE 0 END) as selesai_fisik,
        SUM(CASE WHEN (progress = 'PERBAIKAN MAINCORE') THEN 1 ELSE 0 END) as perbaikan_mc,
        SUM(CASE WHEN (status LIKE '22%') THEN 1 ELSE 0 END) as total,
    ");
        $this->db->from('tb_project');
        $this->db->where('status', 22);
        if ($datel != 'all') {
            $this->db->where('datel', $datel);
        }
        $query = $this->db->get();
        return $query;
    }

    public function show_data($datel, $cons)
    {
        if ($datel == 'all') {
            if ($cons == 'all') {
                $this->db->select('*');
                $this->db->from('tb_project');
                $this->db->where('project_code !=', null);
                $this->db->where("(status = '22' OR status = '33' OR status = '44' OR status = '55' OR status = '66' OR status = '10')");
                $this->db->order_by('project_id', 'asc');
                return $this->db->get();
            } else if ($cons == 99) {
                $this->db->select('*');
                $this->db->from('tb_project');
                $this->db->where("(status = '99' OR status = '100')");
                // $this->db->where('status', '99');
                // $this->db->or_where('status', '100');
                $this->db->where('project_code !=', null);
                $this->db->order_by('project_id', 'asc');
                return $this->db->get();
            } else {
                $this->db->select('*');
                $this->db->from('tb_project');
                $this->db->where('status', $cons);
                $this->db->where('project_code !=', null);
                $this->db->order_by('project_id', 'asc');
                return $this->db->get();
            }
        } else {
            if ($cons == 'all') {
                $this->db->select('*');
                $this->db->from('tb_project');
                $this->db->where('datel', $datel);
                $this->db->where('project_code !=', null);
                $this->db->where("(status = '22' OR status = '33' OR status = '44' OR status = '55' OR status = '66' OR status = '10')");
                $this->db->order_by('project_id', 'asc');
                return $this->db->get();
            } else if ($cons == 99) {
                $this->db->select('*');
                $this->db->from('tb_project');
                $this->db->where('datel', $datel);
                $this->db->where("(status = '99' OR status = '100')");
                // $this->db->where('status', '99');
                // $this->db->or_where('status', '100');
                $this->db->where('project_code !=', null);
                $this->db->order_by('project_id', 'asc');
                return $this->db->get();
            } else {
                $this->db->select('*');
                $this->db->from('tb_project');
                $this->db->where('datel', $datel);
                $this->db->where('status', $cons);
                $this->db->where('project_code !=', null);
                $this->db->order_by('project_id', 'asc');
                return $this->db->get();
            }
        }
    }

    public function show_data_progress($datel, $progress)
    {
        if ($datel == 'all') {
            if ($progress == 'all') {
                $this->db->select('*');
                $this->db->from('tb_project');
                $this->db->where('status', 22);
                $this->db->where('project_code !=', null);
                $this->db->order_by('project_id', 'asc');
                return $this->db->get();
            } else {
                $this->db->select('*');
                $this->db->from('tb_project');
                $this->db->where('status', 22);
                $this->db->where('progress', $progress);
                $this->db->where('project_code !=', null);
                $this->db->order_by('project_id', 'asc');
                return $this->db->get();
            }
        } else {
            if ($progress == 'all') {
                $this->db->select('*');
                $this->db->from('tb_project');
                $this->db->where('status', 22);
                $this->db->where('datel', $datel);
                $this->db->where('project_code !=', null);
                $this->db->order_by('project_id', 'asc');
                return $this->db->get();
            } else {
                $this->db->select('*');
                $this->db->from('tb_project');
                $this->db->where('datel', $datel);
                $this->db->where('status', 22);
                $this->db->where('progress', $progress);
                $this->db->where('project_code !=', null);
                $this->db->order_by('project_id', 'asc');
                return $this->db->get();
            }
        }
    }

    public function show_filtered_data($datel, $cons, $start, $end)
    {
        if ($datel == 'all') {
            if ($cons == 'all') {
                $this->db->select('*');
                $this->db->from('tb_project');
                if ($start != null && $end != null) {
                    $this->db->where('last_update >=', $start);
                    $this->db->where('last_update <=', $end);
                }
                $this->db->where("(status = '22' OR status = '33' OR status = '44' OR status = '55' OR status = '66' OR status = '10')");
                $this->db->order_by('project_id', 'asc');

                return $this->db->get();
            } else {
                $this->db->select('*');
                $this->db->from('tb_project');
                if ($start != null && $end != null) {
                    $this->db->where('last_update >=', $start);
                    $this->db->where('last_update <=', $end);
                }
                $this->db->where('status', $cons);
                $this->db->order_by('project_id', 'asc');
                return $this->db->get();
            }
        } else {
            if ($cons == 'all') {
                $this->db->select('*');
                $this->db->from('tb_project');
                if ($start != null && $end != null) {
                    $this->db->where('last_update >=', $start);
                    $this->db->where('last_update <=', $end);
                }
                $this->db->where('datel', $datel);
                $this->db->where("(status = '22' OR status = '33' OR status = '44' OR status = '55' OR status = '66' OR status = '10')");
                $this->db->order_by('project_id', 'asc');
                return $this->db->get();
            } else {
                $this->db->select('*');
                $this->db->from('tb_project');
                if ($start != null && $end != null) {
                    $this->db->where('last_update >=', $start);
                    $this->db->where('last_update <=', $end);
                }
                $this->db->where('datel', $datel);
                $this->db->where('status', $cons);
                $this->db->order_by('project_id', 'asc');
                return $this->db->get();
            }
        }
    }

    public function get_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('tb_project');
        $this->db->where('project_id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function project_deployer($id)
    {
        $this->db->select('tb_project.*,tb_optima.mitra_amo');
        $this->db->from('tb_project');
        $this->db->join('tb_optima', 'tb_optima.project_id = tb_project.project_id', 'left');
        $this->db->where('tb_project.project_id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function project_record_deployer($id)
    {
        $this->db->select('tb_project.*,tb_optima.mitra_amo, tb_deployer.*');
        $this->db->from('tb_project');
        $this->db->join('tb_optima', 'tb_optima.project_id = tb_project.project_id', 'left');
        $this->db->join('tb_deployer', 'tb_deployer.project_id = tb_project.project_id', 'left');
        $this->db->where('tb_project.project_id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function update($where, $data)
    {
        $this->db->update('tb_project', $data, $where);
        return $this->db->affected_rows();
    }

    public function update_amo($where, $data)
    {
        $this->db->update('tb_optima', $data, $where);
        return $this->db->affected_rows();
    }

    public function update_deployer($where, $data)
    {
        $this->db->update('tb_deployer', $data, $where);
        return $this->db->affected_rows();
    }

    public function update_golive($where, $data)
    {
        $this->db->update('tb_golive', $data, $where);
        return $this->db->affected_rows();
    }

    public function update_sales($where, $data2)
    {
        $this->db->where('sales_id', $where);
        $this->db->update('tb_sales', $data2);
    }

    public function delete_by_id($id)
    {
        $this->db->where('construction_id', $id);
        $this->db->delete('tb_construction');
    }

    public function delete_project_id($id)
    {
        $this->db->where('project_id', $id);
        $this->db->delete('tb_project');
    }

    public function delete_by_sales($id_sales)
    {
        $this->db->where('sales_id', $id_sales);
        $this->db->delete('tb_construction');
    }

    public function search($search)
    {
        $this->db->select('*');
        $this->db->from('tb_project as p');
        $this->db->join('tb_users as u', 'u.users_id = p.last_update_by', 'left');
        $where = "(p.project_code = '$search')";
        $this->db->where($where);
        return $this->db->get();
    }

    public function cek_odp($odp)
    {
        $this->db->select('*');
        $this->db->from('tb_odp_construction o');
        $this->db->join('tb_project p', 'p.project_id = o.project_id');
        $where = "o.odp_live = '$odp' AND o.odp_live <> '-' AND (p.status = '22' OR p.status = '33' OR p.status = '44' OR p.status = '55' OR p.status = '66' OR p.status = '88')";
        $this->db->where($where);
        $this->db->order_by('odp_id', 'desc');
        $query = $this->db->get();
        return $query->row();
    }

    function save_odp($data_odp)
    {
        $this->db->insert_batch('tb_odp_construction', $data_odp);
        return $this->db->insert_id();
    }

    function save_construction($data_cons)
    {
        $this->db->insert_batch('tb_construction', $data_cons);
        return $this->db->insert_id();
    }

    function save_log($data_log)
    {
        $this->db->insert_batch('tb_log', $data_log);
        return $this->db->insert_id();
    }

    function search_project($project_id)
    {
        $this->db->select('*');
        $this->db->from('tb_log_project');
        $where = "(project_id = '$project_id')";
        $this->db->where($where);
        $this->db->order_by('log_project_id', 'asc');
        return $this->db->get();
    }
}

/* End of file Project_model.php */
/* Location: ./application/models/Project_model.php */
