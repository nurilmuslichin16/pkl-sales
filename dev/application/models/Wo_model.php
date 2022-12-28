<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Wo_model extends CI_Model
{

	public function amunisi_view($datel, $amunisi, $unit, $time)
	{
		$this->db->select('s.*, m.fullname,t.nama_teknisi');
		$this->db->from('tb_sales s');
		$this->db->join('tb_salesman m', 'm.s_telegram_id = s.message_from', 'left');
		$this->db->join('tb_teknisi t', 't.t_telegram_id = s.progress_to', 'left');


		if ($datel != 'all') {
			$this->db->where('s.datel', $datel);
		}

		switch ($amunisi) {
			case 'pagi':
				$this->db->where("(tgl_done_fcc>=CURDATE()) AND (TIME(tgl_done_fcc) BETWEEN '00:00:00' AND '11:59:00') AND (s.kategori = 1) AND (s.segment = 0) AND (status_id < 3) AND (status != 'remanja')");
				break;

			case 'sore':
				$this->db->where("(tgl_done_fcc>=CURDATE()) AND (TIME(tgl_done_fcc) BETWEEN '12:00:00' AND '23:59:00') AND (s.kategori = 1) AND (s.segment = 0) AND (status_id < 3) AND (status != 'remanja')");
				break;

			case 'h_min_1':
				$this->db->where("(DATE(tgl_done_fcc) = SUBDATE(CURDATE(),1)) AND ((status_id < 3)) AND (s.kategori = 1) AND (s.segment = 0)");
				break;

			case 'exp':
				$this->db->where("(DATE(tgl_done_fcc) < SUBDATE(CURDATE(),1)) AND ((status_id < 3)) AND (s.kategori = 1) AND (s.segment = 0)");
				break;

			case 'reorder_pagi':
				$this->db->where("(status_id < 3) AND (status = 'remanja') AND (s.segment = 0) AND (DATE(tgl_done_fcc) = CURDATE()) AND (TIME(tgl_done_fcc) BETWEEN '00:00:00' AND '11:59:00')");
				break;

			case 'reorder_sore':
				$this->db->where("(status_id < 3) AND (status = 'remanja') AND (s.segment = 0) AND (DATE(tgl_done_fcc) = CURDATE()) AND (TIME(tgl_done_fcc) BETWEEN '12:00:00' AND '23:59:00')");
				break;

			case 'not_fu':
				$this->db->where("(status_id < 3) AND (status = 'NOT FU') AND (s.segment = 0) AND (DATE(tgl_done_fcc) = CURDATE())");
				break;

			default:
				$this->db->where("((status_id <= 5 OR status_id = 11) AND s.kategori = 1 AND segment = 0) AND (tgl_done_fcc is NOT NULL)");
				break;
		}

		if ($unit != 'all') {
			if ($unit == 'egbis') {
				$this->db->where('unit <>', 'DCS');
			} else {
				$this->db->where('unit', $unit);
			}
		}

		if ($time == 'daily') {
			$this->db->where('DAY(tgl_update) = DAY(CURRENT_DATE()) AND MONTH(tgl_update) = MONTH(CURRENT_DATE()) AND YEAR(tgl_update) = YEAR(CURRENT_DATE())');
		}

		$this->db->order_by('sales_id', 'DESC');

		return $this->db->get();
	}

	public function deal_view($datel, $kategori, $unit, $time)
	{
		$this->db->select('*');
		$this->db->from('tb_sales s');
		$this->db->join('tb_salesman m', 'm.s_telegram_id = s.message_from', 'left');

		// datel segmentation
		if ($datel != 'all') {
			$this->db->where('s.datel', $datel);
		}

		if ($kategori == 'today') {
			$this->db->where('tgl_post>=CURDATE() AND segment = 0');
		} else {
			$this->db->where('DATE(tgl_post) = SUBDATE(CURDATE(),1) AND segment = 0');
		}

		if ($unit != 'all') {
			if ($unit == 'egbis') {
				$this->db->where('unit <>', 'DCS');
			} else {
				$this->db->where('unit', $unit);
			}
		}

		if ($time == 'daily') {
			$this->db->where('DAY(tgl_update) = DAY(CURRENT_DATE()) AND MONTH(tgl_update) = MONTH(CURRENT_DATE()) AND YEAR(tgl_update) = YEAR(CURRENT_DATE())');
		}

		$this->db->order_by('sales_id', 'DESC');

		return $this->db->get();
	}

	public function pra_order_view($datel, $order, $unit, $time)
	{
		$this->db->select('*');
		$this->db->from('tb_sales s');
		$this->db->join('tb_salesman m', 'm.s_telegram_id = s.message_from', 'left');

		// datel segmentation
		if ($datel != 'all') {
			$this->db->where('s.datel', $datel);
		}

		if ($order == 'wait_fcc') {
			$this->db->where("status_id = '41' AND segment = 0");
		} else if ($order == 'prog_fcc') {
			$this->db->where("status_id = '43' AND segment = 0");
		} else if ($order == 'kndl_fcc') {
			$this->db->where("status_id = '42' AND segment = 0");
		}

		if ($unit != 'all') {
			if ($unit == 'egbis') {
				$this->db->where('unit <>', 'DCS');
			} else {
				$this->db->where('unit', $unit);
			}
		}

		if ($time == 'daily') {
			$this->db->where('DAY(tgl_update) = DAY(CURRENT_DATE()) AND MONTH(tgl_update) = MONTH(CURRENT_DATE()) AND YEAR(tgl_update) = YEAR(CURRENT_DATE())');
		}

		$this->db->order_by('sales_id', 'DESC');

		return $this->db->get();
	}

	public function request_sc_view($datel, $order, $unit, $time)
	{
		$this->db->select('*');
		$this->db->from('tb_sales s');
		$this->db->join('tb_salesman m', 'm.s_telegram_id = s.message_from', 'left');

		// datel segmentation
		if ($datel != 'all') {
			$this->db->where('s.datel', $datel);
		}

		if ($order == 'waitsc') {
			$this->db->where("(status_id LIKE '3%' OR status_id = 12) AND segment = 0");
		} else if ($order == 'donesc') {
			$this->db->where("status_id = 5 AND segment = 0");
		}

		if ($unit != 'all') {
			if ($unit == 'egbis') {
				$this->db->where('unit <>', 'DCS');
			} else {
				$this->db->where('unit', $unit);
			}
		}

		if ($time == 'daily') {
			$this->db->where('DAY(tgl_update) = DAY(CURRENT_DATE()) AND MONTH(tgl_update) = MONTH(CURRENT_DATE()) AND YEAR(tgl_update) = YEAR(CURRENT_DATE())');
		}

		$this->db->order_by('sales_id', 'DESC');

		return $this->db->get();
	}

	public function kendala_view($datel, $kategori, $jenis, $time, $unit)
	{
		switch ($time) {
			case 'daily':
				$kon_ken = "AND date(tgl_lapor_k) = CURDATE()";
				$kon_cons = "AND date(tgl_update) = CURDATE()";
				break;

			default:
				$kon_ken = "";
				$kon_cons = "";
				break;
		}

		if ($unit != 'all') {
			if ($unit == 'egbis') {
				// $this->db->where('unit <>', 'DCS');
				$q_unit = "AND s.unit != 'DCS'";
			} else {
				// $this->db->where('unit', $unit);
				$q_unit = "AND s.unit = '$unit'";
			}
		}

		if ($jenis == 'psb') {
			if ($datel == 'all') {
				if ($kategori == 'kp') {
					$query = "SELECT s.*,m.fullname FROM tb_sales s LEFT JOIN tb_salesman m ON m.s_telegram_id=s.message_from WHERE s.status = 'KENDALA PELANGGAN' AND s.status_id = '6' $q_unit AND s.segment = 0 $kon_ken ORDER BY s.sales_id DESC";
				} elseif ($kategori == 'kj') {
					$query = "SELECT s.*,m.fullname  FROM tb_sales s LEFT JOIN tb_salesman m ON m.s_telegram_id=s.message_from WHERE s.status = 'KENDALA JARINGAN' AND s.status_id = '6' $q_unit AND s.segment = 0 $kon_ken ORDER BY s.sales_id DESC";
				} elseif ($kategori == 'cons') {
					$query = "SELECT * FROM tb_sales s LEFT JOIN tb_salesman m ON m.s_telegram_id=s.message_from WHERE (s.status = 'DEPLOY' OR s.status = 'KENDALA GOLIVE' OR s.status = 'APPROVAL AMO' OR s.status = 'APPROVAL DATEL' OR s.status = 'PROSES GOLIVE' OR s.status = 'REDESAIN') AND (s.status_id = '13') $q_unit AND (s.segment = 0 $kon_cons) ORDER BY s.sales_id DESC";
				}
			} else {
				if ($kategori == 'kp') {
					$query = "SELECT s.*,m.fullname FROM tb_sales s LEFT JOIN tb_salesman m ON m.s_telegram_id=s.message_from WHERE s.status = 'KENDALA PELANGGAN' AND s.status_id = '6' $q_unit AND s.datel = '$datel' AND s.segment = 0 $kon_ken ORDER BY s.sales_id DESC";
				} elseif ($kategori == 'kj') {
					$query = "SELECT s.*,m.fullname FROM tb_sales s LEFT JOIN tb_salesman m ON m.s_telegram_id=s.message_from WHERE s.status = 'KENDALA JARINGAN' AND s.status_id = '6' $q_unit AND s.datel = '$datel' AND s.segment = 0 $kon_ken ORDER BY s.sales_id DESC";
				} elseif ($kategori == 'cons') {
					$query = "SELECT * FROM tb_sales s LEFT JOIN tb_salesman m ON m.s_telegram_id=s.message_from WHERE (s.status = 'DEPLOY' OR s.status = 'KENDALA GOLIVE' OR s.status = 'APPROVAL AMO' OR s.status = 'APPROVAL DATEL' OR s.status = 'PROSES GOLIVE' OR s.status = 'REDESAIN') AND (s.status_id = '13') $q_unit AND (s.datel = '$datel') AND (s.segment = 0 $kon_cons) ORDER BY s.sales_id DESC";
				}
			}
		} elseif ($jenis == 'pda') {
			if ($datel == 'all') {
				if ($kategori == 'kp') {
					$query = "SELECT s.*,m.fullname FROM tb_sales s LEFT JOIN tb_salesman m ON m.s_telegram_id=s.message_from WHERE s.status = 'KENDALA PELANGGAN' AND s.status_id = '6' AND s.segment = 2 ORDER BY s.sales_id DESC";
				} elseif ($kategori == 'kj') {
					$query = "SELECT s.*,m.fullname FROM tb_sales s LEFT JOIN tb_salesman m ON m.s_telegram_id=s.message_from WHERE s.status = 'KENDALA JARINGAN' AND s.status_id = '6' AND s.segment = 2 ORDER BY s.sales_id DESC";
				} elseif ($kategori == 'cons') {
					$query = "SELECT * FROM tb_sales s LEFT JOIN tb_salesman m ON m.s_telegram_id=s.message_from WHERE (s.status = 'DEPLOY' OR s.status = 'KENDALA GOLIVE' OR s.status = 'APPROVAL AMO' OR s.status = 'APPROVAL DATEL' OR s.status = 'PROSES GOLIVE' OR s.status = 'REDESAIN') AND (s.status_id = '13') AND (s.segment = 2) ORDER BY s.sales_id DESC";
				}
			} else {
				if ($kategori == 'kp') {
					$query = "SELECT s.*,m.fullname FROM tb_sales s LEFT JOIN tb_salesman m ON m.s_telegram_id=s.message_from WHERE s.status = 'KENDALA PELANGGAN' AND s.status_id = '6' AND s.datel = '$datel' AND s.segment = 2 ORDER BY s.sales_id DESC";
				} elseif ($kategori == 'kj') {
					$query = "SELECT s.*,m.fullname FROM tb_sales s LEFT JOIN tb_salesman m ON m.s_telegram_id=s.message_from WHERE s.status = 'KENDALA JARINGAN' AND s.status_id = '6' AND s.datel = '$datel' AND s.segment = 2 ORDER BY s.sales_id DESC";
				} elseif ($kategori == 'cons') {
					$query = "SELECT * FROM tb_sales s LEFT JOIN tb_salesman m ON m.s_telegram_id=s.message_from WHERE (s.status = 'DEPLOY' OR s.status = 'KENDALA GOLIVE' OR s.status = 'APPROVAL AMO' OR s.status = 'APPROVAL DATEL' OR s.status = 'PROSES GOLIVE' OR s.status = 'REDESAIN') AND (s.status_id = '13') AND (s.datel = '$datel') AND (s.segment = 2) ORDER BY s.sales_id DESC";
				}
			}
		}

		return $query = $this->db->query($query)->result_array();
	}

	public function provi_view($datel, $kategori, $jenis, $unit, $time)
	{
		$this->db->select('s.*, m.fullname,t.nama_teknisi');
		$this->db->from('tb_sales s');
		$this->db->join('tb_salesman m', 'm.s_telegram_id = s.message_from', 'left');
		$this->db->join('tb_teknisi t', 't.t_telegram_id = s.progress_to', 'left');


		if ($datel != 'all') {
			$this->db->where('s.datel', $datel);
		}

		if ($jenis == 'psb') {
			$this->db->where('s.segment', '0');
		} else if ($jenis == 'pda') {
			$this->db->where('s.segment', '2');
		}

		switch ($kategori) {
			case 'wait_act':
				$this->db->where("s.status_id=7 AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND status_id!=10)");
				break;

			case 'prog_act':
				$this->db->where("status_id=71");
				break;

			case 'fact':
				$this->db->where("s.status_id=8 AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND status_id!=10)");
				break;

			case 'comp':
				$this->db->where("s.status_id=9 AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND status_id!=10)");
				break;

			default:
				$this->db->where("s.status_id=10 AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND status_id!=10)");
				break;
		}

		if ($unit != 'all') {
			if ($unit == 'egbis') {
				$this->db->where('unit <>', 'DCS');
			} else {
				$this->db->where('unit', $unit);
			}
		}

		if ($time == 'daily') {
			$this->db->where('DAY(tgl_update) = DAY(CURRENT_DATE()) AND MONTH(tgl_update) = MONTH(CURRENT_DATE()) AND YEAR(tgl_update) = YEAR(CURRENT_DATE())');
		}

		$this->db->order_by('sales_id', 'DESC');

		return $this->db->get();
	}

	public function teknisi($datel)
	{
		$this->db->where('datel', $datel);
		$this->db->where('active', 1);
		$this->db->where("(crew is NOT NULL AND crew != '0' AND crew != '-')");
		//$this->db->where("libur NOT LIKE '%" . date('d') . "%' ");
		$this->db->group_by('crew');
		return $this->db->get('tb_teknisi');
	}

	public function update($where, $data)
	{
		$this->db->update('tb_sales', $data, $where);
		return $this->db->affected_rows();
	}

	public function update_kendala($where, $data)
	{
		$this->db->update('tb_sales', $data, $where);
		return $this->db->affected_rows();
	}

	public function update_ba_amunisi($where, $data)
	{
		$this->db->update('tb_ba_amunisi', $data, $where);
		return $this->db->affected_rows();
	}

	public function get_ba_id($id)
	{
		$this->db->from("tb_ba_amunisi");
		$this->db->where('sales_id', $id);
		$query = $this->db->get();

		return $query->row();
	}

	public function update_no_kat($where, $data)
	{
		$this->db->update('tb_sales', $data, $where);
		return $this->db->affected_rows();
	}

	public function search_ja($sales_id)
	{
		$this->db->select('*');
		$this->db->from('tb_log');
		$this->db->join('tb_sales', 'tb_sales.sales_id = tb_log.sales_id');
		$this->db->join('tb_salesman', 'tb_salesman.s_telegram_id = tb_sales.message_from', 'left');
		$where = "(tb_log.sales_id = '$sales_id' OR tb_sales.myir = '$sales_id' OR tb_sales.cp = '$sales_id' OR tb_sales.new_sc = '$sales_id') AND (segment = '0' OR segment = '2' OR segment = '3')";
		$this->db->where($where);
		$this->db->order_by('log_id', 'asc');
		return $this->db->get();
	}

	public function ba_amunisi_view($datel, $amunisi, $teknisi, $segment, $ba, $unit)
	{
		$this->db->select('s.*, m.fullname, t.nama_teknisi, b.alasan, b.evident');
		$this->db->from('tb_sales s');
		$this->db->join('tb_ba_amunisi b', 'b.sales_id = s.sales_id');
		$this->db->join('tb_salesman m', 'm.s_telegram_id = s.message_from', 'left');
		$this->db->join('tb_teknisi t', 't.t_telegram_id = s.progress_to', 'left');

		$this->db->where('amunisi', $amunisi);

		// datel segmentation
		if ($datel != 'all') {
			$this->db->where('s.datel', $datel);
		}

		if ($teknisi != 'all') {
			$this->db->where('s.progress_to', $teknisi);
		}

		if ($ba != 'all') {
			$this->db->where("(b.ba = $ba)");
		}

		if ($segment != 'all') {
			$this->db->where("(segment = $segment)");
		} else {
			$this->db->where("(segment = 0 OR segment = 2 OR segment = 3)");
		}

		// unit
		if ($unit != 'all') {
			if ($unit == 'egbis') {
				$this->db->where('unit <>', 'DCS');
			} else {
				$this->db->where('unit', $unit);
			}
		}

		return $this->db->get();
	}

	public function provi_progress_view($kategori, $datel, $time, $order, $modtype, $unit)
	{
		$this->db->select('s.*, m.fullname, t.nama_teknisi');
		$this->db->from('tb_sales s');
		$this->db->join('tb_salesman m', 'm.s_telegram_id = s.message_from', 'left');
		$this->db->join('tb_teknisi t', 't.t_telegram_id = s.progress_to', 'left');

		if ($order == 'psb') {
			$this->db->where('segment', 0);
		} elseif ($order == 'pda') {
			$this->db->where('segment', 2);
		} elseif ($order == 'addon') {
			$this->db->where('segment', 3);
		} else {
			$this->db->where('segment', 0);
		}

		// datel segmentation
		if ($datel != 'all') {
			$this->db->where('s.datel', $datel);
		}

		// jenis segmentation
		if ($modtype != 'all') {
			$this->db->where('add_on_type', $modtype);
		}

		// time segmentation
		if ($order == 'psb') {
			if ($time == 'reorder') {
				$this->db->where("(kategori = 1) AND (s.status = 'remanja') AND (DATE(tgl_done_fcc) = CURDATE()) AND (TIME(tgl_done_fcc) BETWEEN '00:00:00' AND '11:59:00')");
			} elseif ($time == 'as_exp') {
				$this->db->where("(DATE(tgl_done_fcc) < SUBDATE(CURDATE(),1)) AND (kategori = 1)");
			} elseif ($time == 'as_h_min_1') {
				$this->db->where("(DATE(tgl_done_fcc) = SUBDATE(CURDATE(),1)) AND (kategori = 1)");
			} elseif ($time == 'pagi') {
				$this->db->where("(tgl_done_fcc>=CURDATE()) AND (TIME(tgl_done_fcc) BETWEEN '00:00:00' AND '11:59:00') AND (kategori = 1) AND (s.status != 'remanja')");
			} elseif ($time == 'sore') {
				$this->db->where("(tgl_done_fcc>=CURDATE()) AND (TIME(tgl_done_fcc) BETWEEN '12:00:00' AND '23:59:00') AND (kategori = 1)");
			} elseif ($time == 'total_non_sore') {
				$this->db->where("((kategori = 1 AND s.status = 'remanja' AND (TIME(tgl_done_fcc) BETWEEN '00:00:00' AND '11:59:00')) OR ((DATE(tgl_done_fcc) < SUBDATE(CURDATE(),1)) AND (kategori = 1 AND s.status != 'remanja')) OR ((DATE(tgl_done_fcc) = SUBDATE(CURDATE(),1)) AND (kategori = 1 AND s.status != 'remanja')) OR ((tgl_done_fcc>=CURDATE()) AND (TIME(tgl_done_fcc) BETWEEN '00:00:00' AND '11:59:00') AND (kategori = 1) AND (s.status != 'remanja')))");
			} elseif ($time == 'total_sore') {
				$this->db->where("((tgl_done_fcc>=CURDATE()) AND (TIME(tgl_done_fcc) BETWEEN '12:00:00' AND '23:59:00') AND kategori = 1)");
			} else {
				$this->db->where("(((kategori = 1) AND (s.status = 'remanja') AND (tgl_done_fcc is NOT NULL)) OR ((DATE(tgl_done_fcc) < SUBDATE(CURDATE(),1)) AND (kategori = 1 AND s.status != 'remanja')) OR ((DATE(tgl_done_fcc) = SUBDATE(CURDATE(),1)) AND (kategori = 1 AND s.status != 'remanja')) OR ((tgl_done_fcc>=CURDATE()) AND (TIME(tgl_done_fcc) BETWEEN '00:00:00' AND '11:59:00') AND (kategori = 1) AND (s.status != 'remanja')) OR ((tgl_done_fcc>=CURDATE()) AND (TIME(tgl_done_fcc) BETWEEN '12:00:00' AND '23:59:00') AND (kategori = 1) AND (s.status != 'remanja')) )");
			}
		} else {
			if ($time == 'reorder') {
				$this->db->where("(kategori = 1) AND (s.status = 'remanja') AND (tgl_done_fcc is NOT NULL)");
			} elseif ($time == 'as_exp') {
				$this->db->where("(DATE(tgl_done_fcc) < CURDATE()) AND (kategori = 1 AND s.status != 'remanja')");
			} elseif ($time == 'hi') {
				$this->db->where("(DATE(tgl_done_fcc) = CURDATE()) AND (kategori = 1 AND s.status != 'remanja')");
			} else {
				$this->db->where("(((kategori = 1) AND (s.status = 'remanja') AND (tgl_done_fcc is NOT NULL)) OR ((DATE(tgl_done_fcc) < CURDATE()) AND (kategori = 1 AND s.status != 'remanja')) OR ((DATE(tgl_done_fcc) = CURDATE()) AND (kategori = 1 AND s.status != 'remanja')) )");
			}
		}

		// kategori
		if ($kategori == 'wo') {
			$this->db->where("(s.status = 'scbe' OR s.status = 'remanja')");
		} elseif ($kategori == 'ordered') {
			$this->db->where("(s.status = 'ordered')");
		} elseif ($kategori == 'otw') {
			$this->db->where("(s.status = 'otw')");
		} elseif ($kategori == 'ogp') {
			$this->db->where("(s.status = 'ogp')");
		} elseif ($kategori == 'cek_onu') {
			$this->db->where("(s.status = 'cek_onu')");
		} elseif ($kategori == 'p_nok') {
			$this->db->where("(s.status = 'KENDALA PELANGGAN' AND s.status_id = '6' AND date(tgl_lapor_k) = CURDATE())");
		} elseif ($kategori == 'j_nok') {
			$this->db->where("(s.status = 'KENDALA JARINGAN' AND s.status_id = '6' AND date(tgl_lapor_k) = CURDATE())");
		} elseif ($kategori == 'terminate') {
			$this->db->where("(s.status = 'TERMINATE' AND s.status_id = '6' AND date(tgl_lapor_k) = CURDATE())");
		} elseif ($kategori == 'waitsc') {
			$this->db->where("(s.status_id = '3' OR s.status_id = '31' OR s.status_id = '32' OR s.status_id = '33' OR s.status_id=12)");
		} elseif ($kategori == 'donesc') {
			$this->db->where("(s.status_id = '5')");
		} elseif ($kategori == 'wait_act') {
			$this->db->where("((s.status_id=7) AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND s.status_id!=10))");
		} elseif ($kategori == 'prog_act') {
			$this->db->where("((s.status_id=71) AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND s.status_id!=10))");
		} elseif ($kategori == 'fact') {
			$this->db->where("((s.status_id=8) AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND s.status_id!=10))");
		} elseif ($kategori == 'comp') {
			$this->db->where("((s.status_id=9) AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND s.status_id!=10))");
		} elseif ($kategori == 'ps') {
			$this->db->where("((s.status_id=10) AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND s.status_id!=10))");
		} elseif ($kategori == 'total_wo') {
			$this->db->where("((s.status = 'scbe' OR s.status = 'remanja' OR s.status = 'ordered' OR s.status = 'otw' OR s.status = 'ogp' OR s.status = 'cek_onu') OR ((s.status = 'KENDALA PELANGGAN' OR s.status = 'KENDALA JARINGAN' OR s.status = 'TERMINATE') AND s.status_id = '6' AND date(tgl_lapor_k) = CURDATE()) OR (s.status_id = '3' OR s.status_id = '5' OR s.status_id = '31' OR s.status_id = '32' OR s.status_id = '33' OR s.status_id=12) OR ((s.status_id=7 OR s.status_id=71 OR s.status_id=8 OR s.status_id=9 OR s.status_id=10) AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND s.status_id!=10)))");
		} elseif ($kategori == 'total_prog') {
			$this->db->where("((s.status = 'ogp') OR ((s.status = 'KENDALA PELANGGAN' OR s.status = 'KENDALA JARINGAN' OR s.status = 'TERMINATE') AND s.status_id = '6' AND date(tgl_lapor_k) = CURDATE()) OR (s.status_id = '3' OR s.status_id = '5' OR s.status_id = '31' OR s.status_id = '32' OR s.status_id = '33' OR s.status_id=12) OR ((s.status_id=7 OR s.status_id=71 OR s.status_id=8 OR s.status_id=9 OR s.status_id=10) AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND s.status_id!=10)))");
		}

		// unit
		if ($unit != 'all') {
			if ($unit == 'egbis') {
				$this->db->where('unit <>', 'DCS');
			} else {
				$this->db->where('unit', $unit);
			}
		}

		return $this->db->get();
	}

	public function wo_progress_view($kategori, $datel)
	{
		$this->db->select('s.*, m.fullname, t.nama_teknisi');
		$this->db->from('tb_sales s');
		$this->db->join('tb_salesman m', 'm.s_telegram_id = s.message_from', 'left');
		$this->db->join('tb_teknisi t', 't.t_telegram_id = s.progress_to', 'left');

		// kategori
		if ($kategori == 'wo') {
			$this->db->where("(s.status = 'scbe')");
		} elseif ($kategori == 'ordered') {
			$this->db->where("(s.status = 'ordered')");
		} elseif ($kategori == 'otw') {
			$this->db->where("(s.status = 'otw')");
		} elseif ($kategori == 'ogp') {
			$this->db->where("(s.status = 'ogp')");
		} elseif ($kategori == 'cek_onu') {
			$this->db->where("(s.status = 'cek_onu')");
		} elseif ($kategori == 'hr_ont') {
			$this->db->where("(s.status = 'hr_ont')");
		} elseif ($kategori == 'p_nok') {
			$this->db->where("(s.status = 'KENDALA PELANGGAN' AND s.status_id = '6')");
		} elseif ($kategori == 'j_nok') {
			$this->db->where("(s.status = 'KENDALA JARINGAN' AND s.status_id = '6')");
		} elseif ($kategori == 'wait_act') {
			$this->db->where("((s.status_id=7) AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND s.status_id!=10) AND (s.segment = 2))");
		} elseif ($kategori == 'prog_act') {
			$this->db->where("((s.status_id=71) AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND s.status_id!=10) AND (s.segment = 2))");
		} elseif ($kategori == 'fact') {
			$this->db->where("((s.status_id=8) AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND s.status_id!=10) AND (s.segment = 2))");
		} elseif ($kategori == 'comp') {
			$this->db->where("((s.status_id=9) AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND s.status_id!=10) AND (s.segment = 2))");
		} elseif ($kategori == 'ps') {
			$this->db->where("((s.status_id=10) AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND s.status_id!=10) AND (s.segment = 2))");
		} else {
			// nothing
		}

		$this->db->where("(s.segment = 2)");

		// datel segmentation
		if ($datel != 'all') {
			$this->db->where("(s.datel = '$datel')");
		}


		return $this->db->get();
	}

	public function teknisi_progress_view($kategori, $datel, $teknisi, $segment, $unit)
	{
		$this->db->select('s.*, m.fullname, t.nama_teknisi');
		$this->db->from('tb_sales s');
		$this->db->join('tb_salesman m', 'm.s_telegram_id = s.message_from', 'left');
		$this->db->join('tb_teknisi t', 't.t_telegram_id = s.progress_to', 'left');
		//$this->db->where("libur NOT LIKE '%" . date('d') . "%' ");
		if ($segment != 'all') {
			$this->db->where("(segment = '$segment')");
		} else {
			$this->db->where("(segment = 0 OR segment = 2 OR segment = 3)");
		}

		// datel segmentation
		if ($datel != 'all') {
			$this->db->where('s.datel', $datel);
		}

		// time segmentation
		if ($teknisi != 'all') {
			// $this->db->where('s.progress_to', $teknisi);

			$id_crew = explode(",", $teknisi);
			$this->db->where("(s.progress_to = '$id_crew[0]' OR s.progress_to = '$id_crew[1]')");
		}

		// kategori
		if ($kategori == 'wo') {
			$this->db->where("(s.status = 'ordered')");
		} elseif ($kategori == 'otw') {
			$this->db->where("(s.status = 'otw')");
		} elseif ($kategori == 'ogp') {
			$this->db->where("(s.status = 'ogp')");
		} elseif ($kategori == 'cek_onu') {
			$this->db->where("(s.status = 'cek_onu')");
		} elseif ($kategori == 'p_nok') {
			$this->db->where("(s.status = 'KENDALA PELANGGAN' AND s.status_id = '6' AND date(tgl_lapor_k) = CURDATE())");
		} elseif ($kategori == 'j_nok') {
			$this->db->where("(s.status = 'KENDALA JARINGAN' AND s.status_id = '6' AND date(tgl_lapor_k) = CURDATE())");
		} elseif ($kategori == 'waitsc') {
			$this->db->where("(s.status_id = '3' OR s.status_id = '31' OR s.status_id = '32' OR s.status_id = '33')");
		} elseif ($kategori == 'donesc') {
			$this->db->where("(s.status_id = '5')");
		} elseif ($kategori == 'wait_act') {
			$this->db->where("((s.status_id=7) AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND s.status_id!=10))");
		} elseif ($kategori == 'prog_act') {
			$this->db->where("((s.status_id=71) AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND s.status_id!=10))");
		} elseif ($kategori == 'fact') {
			$this->db->where("((s.status_id=8) AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND s.status_id!=10))");
		} elseif ($kategori == 'comp') {
			$this->db->where("((s.status_id=9) AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND s.status_id!=10))");
		} elseif ($kategori == 'ps') {
			$this->db->where("((s.status_id=10) AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND s.status_id!=10))");
		} elseif ($kategori == 'all_today') {
			$this->db->where("((status_id IS NULL) OR (status_id > 1 AND status_id < 6) OR (status_id = 6 AND DATE(tgl_lapor_k) = CURDATE() AND kendala <> 'TERMINATE') OR (status_id >= 7 AND status_id <> 13 AND status_id <> 127 AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND status_id!=10)))");
		}

		// unit
		if ($unit != 'all') {
			if ($unit == 'egbis') {
				$this->db->where('unit <>', 'DCS');
			} else {
				$this->db->where('unit', $unit);
			}
		}

		$this->db->where('s.progress_to !=', NULL);

		return $this->db->get();
	}
}

/* End of file Wo_model.php */
/* Location: ./application/models/Wo_model.php */