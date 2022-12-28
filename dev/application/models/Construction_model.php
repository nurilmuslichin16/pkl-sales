<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Construction_model extends CI_Model
{

	public function resume_kendala($segment, $unit, $by_tgl, $start, $end)
	{
		$this->db->select("
                s.datel as datel,
                SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA JARINGAN' AND kendala = 'ODP FULL') THEN 1 ELSE 0 END) as odp_full,
                SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA JARINGAN' AND kendala = 'PT2') THEN 1 ELSE 0 END) as pt_dua,
                SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA JARINGAN' AND kendala = 'NO FO/ODP') THEN 1 ELSE 0 END) as no_fo,
				SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA JARINGAN' AND kendala = 'ODP BLM LIVE') THEN 1 ELSE 0 END) as odp_blm_live,
				SUM(CASE WHEN ((status_id = 1 OR status_id = 40) AND s.`status` = 'unsc') THEN 1 ELSE 0 END) as unsc,
                SUM(CASE WHEN (s.status_id = 6 AND (s.kendala = 'ODP FULL' OR s.kendala = 'PT2' OR s.kendala = 'NO FO/ODP')) THEN 1 ELSE 0 END) as subtotalcons
            ");
		$this->db->from('tb_sales as s');
		$this->db->where('datel !=', 'PKL');

		if ($start != null && $end != null) {
			if ($by_tgl == 'tgl_ja') {
				$this->db->where('DATE(s.tgl_post) >=', $start);
				$this->db->where('DATE(s.tgl_post) <=', $end);
			} else {
				$this->db->where('DATE(s.tgl_lapor_k) >=', $start);
				$this->db->where('DATE(s.tgl_lapor_k) <=', $end);
			}
		}

		if ($segment != 'all') {
			$this->db->where("(s.segment = $segment) AND s.datel <> 'UNF'");
		} else {
			$this->db->where("(s.segment = 0 OR s.segment = 2 OR s.segment = 3) AND s.datel <> 'UNF'");
		}

		if ($unit != 'all') {
			if ($unit == 'egbis') {
				$this->db->where('unit <>', 'DCS');
			} else {
				$this->db->where('unit', $unit);
			}
		}
		$this->db->group_by('s.datel');
		$this->db->order_by('s.datel', 'ASC');
		$query = $this->db->get();
		return $query;
	}

	public function resume_const($segment, $unit, $by_tgl, $start, $end)
	{
		$this->db->select("
				s.datel as datel,
				SUM(CASE WHEN (s.`status` = 'SP' AND c.status = '11') THEN 1 ELSE 0 END) as sp,
				SUM(CASE WHEN (s.`status` = 'DEPLOY' AND c.status = '22') THEN 1 ELSE 0 END) as deploy,
				SUM(CASE WHEN (s.status = 'PROSES GOLIVE' AND c.status = '33') THEN 1 ELSE 0 END) as golive,
				SUM(CASE WHEN (s.status = 'KENDALA GOLIVE' AND c.status = '44') THEN 1 ELSE 0 END) as kc,
				SUM(CASE WHEN (s.`status` = 'REDESAIN' AND c.status = '55') THEN 1 ELSE 0 END) as redesain,
				SUM(CASE WHEN (s.`status` = 'APPROVAL AMO' AND c.status = '66') THEN 1 ELSE 0 END) as approval_amo,
				SUM(CASE WHEN (s.`status` = 'NEXT PROJECT' AND c.status = '77') THEN 1 ELSE 0 END) as next_project,
				SUM(CASE WHEN (c.status = '88') THEN 1 ELSE 0 END) as selesai_golive,
				SUM(CASE WHEN (s.`status` = 'APPROVAL DATEL' AND c.status = '10') THEN 1 ELSE 0 END) as approval_datel,
				SUM(CASE WHEN (s.status_id = 13 AND (s.status = 'REDESAIN' OR s.status = 'APPROVAL AMO' OR s.status = 'DEPLOY' OR s.status = 'PROSES GOLIVE' OR s.status = 'KENDALA GOLIVE' OR s.status = 'APPROVAL DATEL')) THEN 1 ELSE 0 END) as subtotalfu
            ");
		$this->db->from('tb_sales as s');
		$this->db->join('tb_construction as c', 'c.sales_id = s.sales_id');
		$this->db->where('datel !=', 'PKL');

		if ($start != null && $end != null) {
			if ($by_tgl == 'tgl_ja') {
				$this->db->where('DATE(s.tgl_post) >=', $start);
				$this->db->where('DATE(s.tgl_post) <=', $end);
			} else {
				$this->db->where('DATE(s.tgl_lapor_k) >=', $start);
				$this->db->where('DATE(s.tgl_lapor_k) <=', $end);
			}
		}

		if ($segment != 'all') {
			$this->db->where("(s.segment = $segment) AND s.datel <> 'UNF' AND c.aktif = 1");
		} else {
			$this->db->where("(s.segment = 0 OR s.segment = 2 OR s.segment = 3) AND s.datel <> 'UNF' AND c.aktif = 1");
		}

		if ($unit != 'all') {
			if ($unit == 'egbis') {
				$this->db->where('unit <>', 'DCS');
			} else {
				$this->db->where('unit', $unit);
			}
		}
		$this->db->group_by('s.datel');
		$this->db->order_by('s.datel', 'ASC');
		$query = $this->db->get();
		return $query;
	}

	public function resume_total_kendala($segment, $unit, $by_tgl, $start, $end)
	{
		$this->db->select("
				s.datel as datel,
				SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA JARINGAN' AND kendala = 'ODP FULL') THEN 1 ELSE 0 END) as odp_full,
				SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA JARINGAN' AND kendala = 'PT2') THEN 1 ELSE 0 END) as pt_dua,
				SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA JARINGAN' AND kendala = 'NO FO/ODP') THEN 1 ELSE 0 END) as no_fo,
				SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA JARINGAN' AND kendala = 'ODP BLM LIVE') THEN 1 ELSE 0 END) as odp_blm_live,
				SUM(CASE WHEN ((status_id = 1 OR status_id = 40) AND s.`status` = 'unsc') THEN 1 ELSE 0 END) as unsc,
				SUM(CASE WHEN (s.status_id = 6 AND (s.kendala = 'ODP FULL' OR s.kendala = 'PT2' OR s.kendala = 'NO FO/ODP')) THEN 1 ELSE 0 END) as subtotalcons
            ");
		$this->db->from('tb_sales as s');

		if ($start != null && $end != null) {
			if ($by_tgl == 'tgl_ja') {
				$this->db->where('DATE(s.tgl_post) >=', $start);
				$this->db->where('DATE(s.tgl_post) <=', $end);
			} else {
				$this->db->where('DATE(s.tgl_lapor_k) >=', $start);
				$this->db->where('DATE(s.tgl_lapor_k) <=', $end);
			}
		}

		if ($segment != 'all') {
			$this->db->where("(s.segment = $segment) AND s.datel <> 'UNF'");
		} else {
			$this->db->where("(s.segment = 0 OR s.segment = 2 OR s.segment = 3) AND s.datel <> 'UNF'");
		}

		if ($unit != 'all') {
			if ($unit == 'egbis') {
				$this->db->where('unit <>', 'DCS');
			} else {
				$this->db->where('unit', $unit);
			}
		}
		$query = $this->db->get();
		return $query;
	}

	public function resume_total_const($segment, $unit, $by_tgl, $start, $end)
	{
		$this->db->select("
				s.datel as datel,
				SUM(CASE WHEN (s.`status` = 'SP' AND c.status = '11') THEN 1 ELSE 0 END) as sp,
				SUM(CASE WHEN (s.`status` = 'DEPLOY' AND c.status = '22') THEN 1 ELSE 0 END) as deploy,
				SUM(CASE WHEN (s.status = 'PROSES GOLIVE' AND c.status = '33') THEN 1 ELSE 0 END) as golive,
				SUM(CASE WHEN (s.status = 'KENDALA GOLIVE' AND c.status = '44') THEN 1 ELSE 0 END) as kc,
				SUM(CASE WHEN (s.`status` = 'REDESAIN' AND c.status = '55') THEN 1 ELSE 0 END) as redesain,
				SUM(CASE WHEN (s.`status` = 'APPROVAL AMO' AND c.status = '66') THEN 1 ELSE 0 END) as approval_amo,
				SUM(CASE WHEN (s.`status` = 'NEXT PROJECT' AND c.status = '77') THEN 1 ELSE 0 END) as next_project,
				SUM(CASE WHEN (c.status = '88') THEN 1 ELSE 0 END) as selesai_golive,
				SUM(CASE WHEN (s.`status` = 'APPROVAL DATEL' AND c.status = '10') THEN 1 ELSE 0 END) as approval_datel,
				SUM(CASE WHEN (s.status_id = 13 AND (s.status = 'REDESAIN' OR s.status = 'APPROVAL AMO' OR s.status = 'DEPLOY' OR s.status = 'PROSES GOLIVE' OR s.status = 'KENDALA GOLIVE' OR s.status = 'APPROVAL DATEL')) THEN 1 ELSE 0 END) as subtotalfu
            ");
		$this->db->from('tb_sales as s');
		$this->db->join('tb_construction as c', 'c.sales_id = s.sales_id');
		$this->db->where('datel !=', 'PKL');

		if ($start != null && $end != null) {
			if ($by_tgl == 'tgl_ja') {
				$this->db->where('DATE(s.tgl_post) >=', $start);
				$this->db->where('DATE(s.tgl_post) <=', $end);
			} else {
				$this->db->where('DATE(s.tgl_lapor_k) >=', $start);
				$this->db->where('DATE(s.tgl_lapor_k) <=', $end);
			}
		}

		if ($segment != 'all') {
			$this->db->where("(s.segment = $segment) AND s.datel <> 'UNF' AND c.aktif = 1");
		} else {
			$this->db->where("(s.segment = 0 OR s.segment = 2 OR s.segment = 3) AND s.datel <> 'UNF' AND c.aktif = 1");
		}

		if ($unit != 'all') {
			if ($unit == 'egbis') {
				$this->db->where('unit <>', 'DCS');
			} else {
				$this->db->where('unit', $unit);
			}
		}
		$query = $this->db->get();
		return $query;
	}

	public function show_data($datel, $cons, $segment, $unit, $by_tgl, $start, $end)
	{
		$this->db->select('k.*, s.nama_pelanggan, s.datel, s.alamat, s.cp, s.myir, s.lat_long, s.odp, s.unit, s.loc_cust, s.status as status_ja, u.fullname, m.fullname as nama_sales');
		$this->db->from('tb_construction as k');
		$this->db->join('tb_sales as s', 's.sales_id = k.sales_id');
		$this->db->join('tb_users as u', 'u.users_id = s.update_by', 'left');
		$this->db->join('tb_salesman as m', 'm.s_telegram_id = s.message_from', 'left');
		$this->db->where('k.aktif', 1);
		if ($datel != 'all') {
			$this->db->where('s.datel', $datel);
		}

		if ($cons == 'all') {
			$this->db->where("(s.status = 'REDESAIN' OR s.status = 'APPROVAL DATEL' OR s.status = 'APPROVAL AMO' OR s.status = 'DEPLOY' OR s.status = 'PROSES GOLIVE' OR s.status = 'KENDALA GOLIVE')");
			$this->db->where('s.status_id', 13);
		} else {
			$this->db->where('k.status', $cons);
		}

		if ($segment != 'all') {
			$this->db->where("(s.segment = $segment)");
		} else {
			$this->db->where("(s.segment = 0 OR s.segment = 2 OR s.segment = 3)");
		}

		if ($unit != 'all') {
			if ($unit == 'egbis') {
				$this->db->where('unit <>', 'DCS');
			} else {
				$this->db->where('unit', $unit);
			}
		}

		if ($start != null && $end != null) {
			if ($by_tgl == 'tgl_ja') {
				$this->db->where('DATE(s.tgl_post) >=', $start);
				$this->db->where('DATE(s.tgl_post) <=', $end);
			} else {
				$this->db->where('DATE(s.tgl_lapor_k) >=', $start);
				$this->db->where('DATE(s.tgl_lapor_k) <=', $end);
			}
		}

		$this->db->order_by('k.construction_id', 'asc');
		return $this->db->get();
	}

	public function show_filtered_data($datel, $cons, $by_tgl, $start, $end)
	{
		if ($datel == 'all') {
			if ($cons == 'all') {
				$this->db->select('k.*, s.nama_pelanggan, s.datel, s.alamat, s.cp, s.myir, s.lat_long, s.odp, s.unit, u.fullname');
				$this->db->from('tb_construction as k');
				$this->db->join('tb_sales as s', 's.sales_id = k.sales_id');
				$this->db->join('tb_users as u', 'u.users_id = s.update_by', 'left');
				$this->db->where('s.status_id', 13);
				$this->db->where("(s.status = 'REDESAIN' OR s.status = 'APPROVAL AMO' OR s.status = 'DEPLOY' OR s.status = 'PROSES GOLIVE' OR s.status = 'KENDALA GOLIVE')");
				$this->db->where("(s.segment = 0 OR s.segment = 2 OR s.segment = 3)");
				if ($by_tgl == 'tgl_ja') {
					$this->db->where('s.tgl_post >=', $start);
					$this->db->where('s.tgl_post <=', $end);
				} else {
					$this->db->where('s.tgl_lapor_k >=', $start);
					$this->db->where('s.tgl_lapor_k <=', $end);
				}
				$this->db->order_by('k.construction_id', 'asc');
				return $this->db->get();
			} else {
				$this->db->select('k.*, s.nama_pelanggan, s.datel, s.alamat, s.cp, s.myir, s.lat_long, s.odp, s.unit, u.fullname');
				$this->db->from('tb_construction as k');
				$this->db->join('tb_sales as s', 's.sales_id = k.sales_id');
				$this->db->join('tb_users as u', 'u.users_id = s.update_by', 'left');
				$this->db->where('k.status', $cons);
				$this->db->where('s.status_id', 13);
				$this->db->where("(s.segment = 0 OR s.segment = 2 OR s.segment = 3)");
				if ($by_tgl == 'tgl_ja') {
					$this->db->where('s.tgl_post >=', $start);
					$this->db->where('s.tgl_post <=', $end);
				} else {
					$this->db->where('s.tgl_lapor_k >=', $start);
					$this->db->where('s.tgl_lapor_k <=', $end);
				}
				$this->db->order_by('k.construction_id', 'asc');
				return $this->db->get();
			}
		} else {
			if ($cons == 'all') {
				$this->db->select('k.*, s.nama_pelanggan, s.datel, s.alamat, s.cp, s.myir, s.lat_long, s.odp, s.unit, u.fullname');
				$this->db->from('tb_construction as k');
				$this->db->join('tb_sales as s', 's.sales_id = k.sales_id');
				$this->db->join('tb_users as u', 'u.users_id = s.update_by', 'left');
				$this->db->where('s.datel', $datel);
				$this->db->where('s.status_id', 13);
				$this->db->where("(s.status = 'REDESAIN' OR s.status = 'APPROVAL AMO' OR s.status = 'DEPLOY' OR s.status = 'PROSES GOLIVE' OR s.status = 'KENDALA GOLIVE')");
				$this->db->where("(s.segment = 0 OR s.segment = 2 OR s.segment = 3)");
				if ($by_tgl == 'tgl_ja') {
					$this->db->where('s.tgl_post >=', $start);
					$this->db->where('s.tgl_post <=', $end);
				} else {
					$this->db->where('s.tgl_lapor_k >=', $start);
					$this->db->where('s.tgl_lapor_k <=', $end);
				}
				$this->db->order_by('k.construction_id', 'asc');
				return $this->db->get();
			} else {
				$this->db->select('k.*, s.nama_pelanggan, s.datel, s.alamat, s.cp, s.myir, s.lat_long, s.odp, s.unit, u.fullname');
				$this->db->from('tb_construction as k');
				$this->db->join('tb_sales as s', 's.sales_id = k.sales_id');
				$this->db->join('tb_users as u', 'u.users_id = s.update_by', 'left');
				$this->db->where('k.status', $cons);
				$this->db->where('s.datel', $datel);
				$this->db->where('s.status_id', 13);
				$this->db->where("(s.segment = 0 OR s.segment = 2 OR s.segment = 3)");
				if ($by_tgl == 'tgl_ja') {
					$this->db->where('s.tgl_post >=', $start);
					$this->db->where('s.tgl_post <=', $end);
				} else {
					$this->db->where('s.tgl_lapor_k >=', $start);
					$this->db->where('s.tgl_lapor_k <=', $end);
				}
				$this->db->order_by('k.construction_id', 'asc');
				return $this->db->get();
			}
		}
	}

	public function get_by_id($id)
	{
		$this->db->select('k.*, s.nama_pelanggan, s.datel, s.cp, s.alamat, p.project_code');
		$this->db->from('tb_construction as k');
		$this->db->join('tb_sales as s', 's.sales_id = k.sales_id');
		$this->db->join('tb_project as p', 'p.project_id = k.project_id', 'LEFT');
		$this->db->where('k.construction_id', $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function update($where, $data)
	{
		$this->db->update('tb_construction', $data, $where);
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

	public function delete_by_sales($id_sales)
	{
		$this->db->where('sales_id', $id_sales);
		$this->db->delete('tb_construction');
	}

	public function search($search)
	{
		$this->db->select('c.*, s.nama_pelanggan, s.datel, s.alamat, s.cp, s.myir, s.lat_long, s.odp, s.unit, u.fullname');
		$this->db->from('tb_construction as c');
		$this->db->join('tb_sales as s', 's.sales_id = c.sales_id', 'left');
		$this->db->join('tb_users as u', 'u.users_id = c.updated_by', 'left');
		$where = "(s.segment = 0 OR s.segment = 2 OR s.segment = 3) AND (s.sales_id = '$search' OR s.myir = '$search' OR s.new_sc = '$search' OR s.cp = '$search') AND (c.aktif = 1)";
		$this->db->where($where);
		return $this->db->get();
	}
}

/* End of file Kendala_model.php */
/* Location: ./application/models/Kendala_model.php */