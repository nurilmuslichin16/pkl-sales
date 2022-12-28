<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{

	public function work_order($waktu, $unit)
	{
		switch ($waktu) {
			case 'daily':
				$kon_ken = "AND date(tgl_lapor_k) = CURDATE()";
				break;

			default:
				$kon_ken = "";
				break;
		}

		$this->db->select("
				datel,

				/*DEAL*/
				SUM(CASE WHEN (tgl_post>=CURDATE()) THEN 1 ELSE 0 END) as deal_hi,
				SUM(CASE WHEN (DATE(tgl_post) = SUBDATE(CURDATE(),1)) THEN 1 ELSE 0 END) as deal_h_min_1,

				/*PRA ORDER*/
				SUM(CASE WHEN (status_id = '41') THEN 1 ELSE 0 END) as wait_fcc,
				SUM(CASE WHEN (status_id = '43') THEN 1 ELSE 0 END) as prog_fcc,
				SUM(CASE WHEN (status_id = '42') THEN 1 ELSE 0 END) as kndl_fcc,

				/*AMUNISI*/
				SUM(CASE WHEN ((tgl_done_fcc>=CURDATE()) AND (TIME(tgl_done_fcc) BETWEEN '00:00:00' AND '11:59:00') AND (kategori = 1) AND (status_id < 3) AND (status != 'remanja')) THEN 1 ELSE 0 END) as deal_pagi,
				SUM(CASE WHEN ((tgl_done_fcc>=CURDATE()) AND (TIME(tgl_done_fcc) BETWEEN '12:00:00' AND '23:59:00') AND (kategori = 1) AND (status_id < 3) AND (status != 'remanja')) THEN 1 ELSE 0 END) as deal_sore,
				SUM(CASE WHEN ((DATE(tgl_done_fcc) = SUBDATE(CURDATE(),1)) AND ((status_id < 3) AND kategori = 1)) THEN 1 ELSE 0 END) as as_h_min_1,
				SUM(CASE WHEN ((DATE(tgl_done_fcc) < SUBDATE(CURDATE(),1)) AND ((status_id < 3) AND kategori = 1)) THEN 1 ELSE 0 END) as as_exp,
				SUM(CASE WHEN ((status_id < 3) AND (kategori = 1) AND (status = 'remanja') AND (tgl_done_fcc is NOT NULL)) THEN 1 ELSE 0 END) as reorder,
				SUM(CASE WHEN ((status_id < 3) AND (status = 'remanja') AND (date(tgl_done_fcc) = CURDATE()) AND (TIME(tgl_done_fcc) BETWEEN '00:00:00' AND '11:59:00')) THEN 1 ELSE 0 END) as reorder_pagi,
				SUM(CASE WHEN ((status_id < 3) AND (status = 'remanja') AND (date(tgl_done_fcc) = CURDATE()) AND (TIME(tgl_done_fcc) BETWEEN '12:00:00' AND '23:59:00')) THEN 1 ELSE 0 END) as reorder_sore,
				SUM(CASE WHEN ((status_id < 3) AND (status = 'NOT FU') AND (date(tgl_done_fcc) = CURDATE())) THEN 1 ELSE 0 END) as today_not_fu,

				/*KENDALA*/
				SUM(CASE WHEN (status = 'KENDALA PELANGGAN' AND status_id = '6' " . $kon_ken . ") THEN 1 ELSE 0 END) as p_nok,
				SUM(CASE WHEN (status = 'KENDALA JARINGAN' AND status_id = '6' " . $kon_ken . ") THEN 1 ELSE 0 END) as j_nok,
				SUM(CASE WHEN (status_id = '13' AND (status = 'DEPLOY' OR status = 'KENDALA GOLIVE' OR status = 'APPROVAL AMO' OR status = 'APPROVAL DATEL' OR status = 'PROSES GOLIVE' OR status = 'REDESAIN')) THEN 1 ELSE 0 END) as u_cons,

				/*REQ SC*/
				SUM(CASE WHEN (status_id=3 OR status_id=12 OR status_id=31 OR status_id=32 OR status_id=33) THEN 1 ELSE 0 END) as waitsc,
				SUM(CASE WHEN (status_id=5) THEN 1 ELSE 0 END) as donesc,
				
				/*PROGRESS PROVI*/
				SUM(CASE WHEN (status_id=7) AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND status_id!=10) THEN 1 ELSE 0 END) as wait_act,
				SUM(CASE WHEN (status_id=71) AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND status_id!=10) THEN 1 ELSE 0 END) as prog_act,
				SUM(CASE WHEN (status_id=8) AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND status_id!=10) THEN 1 ELSE 0 END) as fact,
				SUM(CASE WHEN (status_id=9) AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND status_id!=10) THEN 1 ELSE 0 END) as comp,
				SUM(CASE WHEN (status_id=10) AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND status_id!=10) THEN 1 ELSE 0 END) as ps
            ");
		$this->db->from('tb_sales');
		$this->db->where('segment', 0);
		$this->db->where('datel !=', 'PKL');

		if ($waktu != 'all') {
			if ($waktu = 'daily') {
				$this->db->where("DAY(tgl_update) = DAY(CURRENT_DATE()) AND MONTH(tgl_update) = MONTH(CURRENT_DATE()) AND YEAR(tgl_update) = YEAR(CURRENT_DATE())");
			} elseif ($waktu == 'monthly') {
				$this->db->where("MONTH(tgl_update) = MONTH(CURRENT_DATE()) AND YEAR(tgl_update) = YEAR(CURRENT_DATE())");
			} elseif ($waktu == 'annual') {
				$this->db->where("YEAR(tgl_update) = YEAR(CURRENT_DATE())");
			}
		}

		if ($unit != 'all') {
			if ($unit == 'egbis') {
				$this->db->where('unit <>', 'DCS');
			} else {
				$this->db->where('unit', $unit);
			}
		}

		$this->db->group_by('datel');
		$this->db->order_by('datel', 'ASC');
		$query = $this->db->get();
		return $query;
	}

	public function work_order_total($waktu, $unit)
	{
		switch ($waktu) {
			case 'daily':
				$kon_ken = "AND date(tgl_lapor_k) = CURDATE()";
				break;

			default:
				$kon_ken = "";
				break;
		}

		$this->db->select("
		    datel,
			/*DEAL*/
			SUM(CASE WHEN (tgl_post>=CURDATE()) THEN 1 ELSE 0 END) as deal_hi,
			SUM(CASE WHEN (DATE(tgl_post) = SUBDATE(CURDATE(),1)) THEN 1 ELSE 0 END) as deal_h_min_1,
			/*PRA ORDER*/
			SUM(CASE WHEN (status_id = '41') THEN 1 ELSE 0 END) as wait_fcc,
			SUM(CASE WHEN (status_id = '43') THEN 1 ELSE 0 END) as prog_fcc,
			SUM(CASE WHEN (status_id = '42') THEN 1 ELSE 0 END) as kndl_fcc,
			/*AMUNISI*/
			SUM(CASE WHEN ((tgl_done_fcc>=CURDATE()) AND (TIME(tgl_done_fcc) BETWEEN '00:00:00' AND '11:59:00') AND (kategori = 1) AND (status_id < 3) AND (status != 'remanja')) THEN 1 ELSE 0 END) as deal_pagi,
			SUM(CASE WHEN ((tgl_done_fcc>=CURDATE()) AND (TIME(tgl_done_fcc) BETWEEN '12:00:00' AND '23:59:00') AND (kategori = 1) AND (status_id < 3) AND (status != 'remanja')) THEN 1 ELSE 0 END) as deal_sore,
			SUM(CASE WHEN ((DATE(tgl_done_fcc) = SUBDATE(CURDATE(),1)) AND ((status_id < 3) AND kategori = 1)) THEN 1 ELSE 0 END) as as_h_min_1,
			SUM(CASE WHEN ((DATE(tgl_done_fcc) < SUBDATE(CURDATE(),1)) AND ((status_id < 3) AND kategori = 1)) THEN 1 ELSE 0 END) as as_exp,
			SUM(CASE WHEN ((status_id < 3) AND (kategori = 1) AND (status = 'remanja') AND (tgl_done_fcc is NOT NULL)) THEN 1 ELSE 0 END) as reorder,
			SUM(CASE WHEN ((status_id < 3) AND (status = 'remanja') AND (date(tgl_done_fcc) = CURDATE()) AND (TIME(tgl_done_fcc) BETWEEN '00:00:00' AND '11:59:00')) THEN 1 ELSE 0 END) as reorder_pagi,
			SUM(CASE WHEN ((status_id < 3) AND (status = 'remanja') AND (date(tgl_done_fcc) = CURDATE()) AND (TIME(tgl_done_fcc) BETWEEN '12:00:00' AND '23:59:00')) THEN 1 ELSE 0 END) as reorder_sore,
			SUM(CASE WHEN ((status_id < 3) AND (status = 'NOT FU') AND (date(tgl_done_fcc) = CURDATE())) THEN 1 ELSE 0 END) as today_not_fu,
			/*KENDALA*/
			SUM(CASE WHEN (status = 'KENDALA PELANGGAN' AND status_id = '6' " . $kon_ken . ") THEN 1 ELSE 0 END) as p_nok,
			SUM(CASE WHEN (status = 'KENDALA JARINGAN' AND status_id = '6' " . $kon_ken . ") THEN 1 ELSE 0 END) as j_nok,
			SUM(CASE WHEN (status_id = '13' AND (status = 'DEPLOY' OR status = 'KENDALA GOLIVE' OR status = 'APPROVAL AMO' OR status = 'APPROVAL DATEL' OR status = 'PROSES GOLIVE' OR status = 'REDESAIN')) THEN 1 ELSE 0 END) as u_cons,
			/*REQ SC*/
			SUM(CASE WHEN (status_id=3 OR status_id=12 OR status_id=31 OR status_id=32 OR status_id=33) THEN 1 ELSE 0 END) as waitsc,
			SUM(CASE WHEN (status_id=5) THEN 1 ELSE 0 END) as donesc,
			/*PROGRESS PROVI*/
			SUM(CASE WHEN (status_id=7) AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND status_id!=10) THEN 1 ELSE 0 END) as wait_act,
			SUM(CASE WHEN (status_id=71) AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND status_id!=10) THEN 1 ELSE 0 END) as prog_act,
			SUM(CASE WHEN (status_id=8) AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND status_id!=10) THEN 1 ELSE 0 END) as fact,
			SUM(CASE WHEN (status_id=9) AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND status_id!=10) THEN 1 ELSE 0 END) as comp,
			SUM(CASE WHEN (status_id=10) AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND status_id!=10) THEN 1 ELSE 0 END) as ps
            ");
		$this->db->from('tb_sales');
		$this->db->where('segment', 0);
		if ($waktu != 'all') {
			if ($waktu = 'daily') {
				$this->db->where("DAY(tgl_update) = DAY(CURRENT_DATE()) AND MONTH(tgl_update) = MONTH(CURRENT_DATE()) AND YEAR(tgl_update) = YEAR(CURRENT_DATE())");
			} elseif ($waktu == 'monthly') {
				$this->db->where("MONTH(tgl_update) = MONTH(CURRENT_DATE()) AND YEAR(tgl_update) = YEAR(CURRENT_DATE())");
			} elseif ($waktu == 'annual') {
				$this->db->where("YEAR(tgl_update) = YEAR(CURRENT_DATE())");
			}
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

	public function work_order_pda($waktu)
	{
		$this->db->select("
				datel,
				/*AMUNISI*/
				SUM(CASE WHEN (status = 'scbe') THEN 1 ELSE 0 END) as wo,
				SUM(CASE WHEN (status = 'ordered') THEN 1 ELSE 0 END) as ordered,
				SUM(CASE WHEN (status = 'otw') THEN 1 ELSE 0 END) as otw,
				SUM(CASE WHEN (status = 'ogp') THEN 1 ELSE 0 END) as ogp,
				SUM(CASE WHEN (status = 'cek_onu') THEN 1 ELSE 0 END) as cek_onu,
				SUM(CASE WHEN (status = 'hr_ont') THEN 1 ELSE 0 END) as hr_ont,

				/*KENDALA*/
				SUM(CASE WHEN (status = 'KENDALA PELANGGAN' AND status_id = '6') THEN 1 ELSE 0 END) as p_nok,
				SUM(CASE WHEN (status = 'KENDALA JARINGAN' AND status_id = '6') THEN 1 ELSE 0 END) as j_nok,

				/*PROGRESS PROVI*/
				SUM(CASE WHEN (status_id=7) AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND status_id!=10) THEN 1 ELSE 0 END) as wait_act,
				SUM(CASE WHEN (status_id=71) AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND status_id!=10) THEN 1 ELSE 0 END) as prog_act,
				SUM(CASE WHEN (status_id=8) AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND status_id!=10) THEN 1 ELSE 0 END) as fact,
				SUM(CASE WHEN (status_id=9) AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND status_id!=10) THEN 1 ELSE 0 END) as comp,
				SUM(CASE WHEN (status_id=10) AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND status_id!=10) THEN 1 ELSE 0 END) as ps
            ");
		$this->db->from('tb_sales');
		$this->db->where('segment', 2);
		if ($waktu != 'all') {
			if ($waktu = 'daily') {
				$this->db->where("DAY(tgl_update) = DAY(CURRENT_DATE()) AND MONTH(tgl_update) = MONTH(CURRENT_DATE()) AND YEAR(tgl_update) = YEAR(CURRENT_DATE())");
			} elseif ($waktu == 'monthly') {
				$this->db->where("MONTH(tgl_update) = MONTH(CURRENT_DATE()) AND YEAR(tgl_update) = YEAR(CURRENT_DATE())");
			} elseif ($waktu == 'annual') {
				$this->db->where("YEAR(tgl_update) = YEAR(CURRENT_DATE())");
			}
		}
		$this->db->group_by('datel');
		$this->db->order_by('datel', 'ASC');
		$query = $this->db->get();
		return $query;
	}

	public function work_order_total_pda($waktu)
	{
		$this->db->select("
			datel,
			/*AMUNISI*/
			SUM(CASE WHEN (status = 'scbe') THEN 1 ELSE 0 END) as wo,
			SUM(CASE WHEN (status = 'ordered') THEN 1 ELSE 0 END) as ordered,
			SUM(CASE WHEN (status = 'otw') THEN 1 ELSE 0 END) as otw,
			SUM(CASE WHEN (status = 'ogp') THEN 1 ELSE 0 END) as ogp,
			SUM(CASE WHEN (status = 'cek_onu') THEN 1 ELSE 0 END) as cek_onu,
			SUM(CASE WHEN (status = 'hr_ont') THEN 1 ELSE 0 END) as hr_ont,

			/*KENDALA*/
			SUM(CASE WHEN (status = 'KENDALA PELANGGAN' AND status_id = '6') THEN 1 ELSE 0 END) as p_nok,
			SUM(CASE WHEN (status = 'KENDALA JARINGAN' AND status_id = '6') THEN 1 ELSE 0 END) as j_nok,

			/*PROGRESS PROVI*/
			SUM(CASE WHEN (status_id=7) AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND status_id!=10) THEN 1 ELSE 0 END) as wait_act,
			SUM(CASE WHEN (status_id=71) AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND status_id!=10) THEN 1 ELSE 0 END) as prog_act,
			SUM(CASE WHEN (status_id=8) AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND status_id!=10) THEN 1 ELSE 0 END) as fact,
			SUM(CASE WHEN (status_id=9) AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND status_id!=10) THEN 1 ELSE 0 END) as comp,
			SUM(CASE WHEN (status_id=10) AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND status_id!=10) THEN 1 ELSE 0 END) as ps
		");
		$this->db->from('tb_sales');
		$this->db->where('segment', 2);
		if ($waktu != 'all') {
			if ($waktu = 'daily') {
				$this->db->where("DAY(tgl_update) = DAY(CURRENT_DATE()) AND MONTH(tgl_update) = MONTH(CURRENT_DATE()) AND YEAR(tgl_update) = YEAR(CURRENT_DATE())");
			} elseif ($waktu == 'monthly') {
				$this->db->where("MONTH(tgl_update) = MONTH(CURRENT_DATE()) AND YEAR(tgl_update) = YEAR(CURRENT_DATE())");
			} elseif ($waktu == 'annual') {
				$this->db->where("YEAR(tgl_update) = YEAR(CURRENT_DATE())");
			}
		}
		$query = $this->db->get();
		return $query;
	}

	public function progress_order_psb($waktu, $datel, $time, $unit)
	{
		// SUM(CASE WHEN (status = 'TERMINATE' AND status_id = '6' AND date(tgl_lapor_k) = CURDATE()) THEN 1 ELSE 0 END) as terminate,
		// SUM(CASE WHEN ((status = 'KENDALA PELANGGAN' OR status = 'KENDALA JARINGAN' OR status = 'TERMINATE') AND status_id = '6' AND date(tgl_lapor_k) = CURDATE()) THEN 1 ELSE 0 END) as all_kendala,
		$this->db->select("
				datel,
				/*AMUNISI*/
				SUM(CASE WHEN (status = 'scbe' OR status = 'remanja') THEN 1 ELSE 0 END) as wo,
				SUM(CASE WHEN (status = 'ordered') THEN 1 ELSE 0 END) as ordered,
				SUM(CASE WHEN (status = 'otw') THEN 1 ELSE 0 END) as otw,
				SUM(CASE WHEN (status = 'ogp') THEN 1 ELSE 0 END) as ogp,
				SUM(CASE WHEN (status = 'cek_onu') THEN 1 ELSE 0 END) as cek_onu,

				/*KENDALA*/
				SUM(CASE WHEN (status = 'KENDALA PELANGGAN' AND status_id = '6' AND date(tgl_lapor_k) = CURDATE()) THEN 1 ELSE 0 END) as p_nok,
				SUM(CASE WHEN (status = 'KENDALA JARINGAN' AND status_id = '6' AND date(tgl_lapor_k) = CURDATE()) THEN 1 ELSE 0 END) as j_nok,
				SUM(CASE WHEN (status_id = '13' AND (status = 'DEPLOY' OR status = 'KENDALA GOLIVE' OR status = 'APPROVAL AMO' OR status = 'APPROVAL DATEL' OR status = 'PROSES GOLIVE' OR status = 'REDESAIN')) THEN 1 ELSE 0 END) as u_cons,

				/*REQ SC*/
				SUM(CASE WHEN (status_id=3 OR status_id=31 OR status_id=32 OR status_id=33 OR status_id=12) THEN 1 ELSE 0 END) as waitsc,
				SUM(CASE WHEN (status_id=5) THEN 1 ELSE 0 END) as donesc,

				/*PROGRESS PROVI*/
				SUM(CASE WHEN (status_id=7) AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND status_id!=10) THEN 1 ELSE 0 END) as wait_act,
				SUM(CASE WHEN (status_id=71) AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND status_id!=10) THEN 1 ELSE 0 END) as prog_act,
				SUM(CASE WHEN (status_id=8) AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND status_id!=10) THEN 1 ELSE 0 END) as fact,
				SUM(CASE WHEN (status_id=9) AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND status_id!=10) THEN 1 ELSE 0 END) as comp,
				SUM(CASE WHEN (status_id=10) AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND status_id!=10) THEN 1 ELSE 0 END) as ps,

				SUM(CASE WHEN (status = 'scbe' OR status = 'remanja' OR status = 'ordered' OR status = 'otw' OR status = 'ogp' OR status = 'cek_onu') THEN 1 ELSE 0 END) as all_amunisi,
				SUM(CASE WHEN ((status = 'KENDALA PELANGGAN' OR status = 'KENDALA JARINGAN') AND status_id = '6' AND date(tgl_lapor_k) = CURDATE()) THEN 1 ELSE 0 END) as all_kendala,
				SUM(CASE WHEN (status_id=3 OR status_id=31 OR status_id=32 OR status_id=33 OR status_id=12 OR status_id=5) THEN 1 ELSE 0 END) as all_reqsc,
				SUM(CASE WHEN ((status_id=7 OR status_id=71 OR status_id=8 OR status_id=9 OR status_id=10) AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND status_id!=10)) THEN 1 ELSE 0 END) as all_provi

            ");
		$this->db->from('tb_sales');
		$this->db->where('segment', 0);

		// datel segmentation
		if ($datel != 'ALL') {
			$this->db->where('datel', $datel);
		}

		// time segmentation
		if ($time == 'reorder') {
			$this->db->where("(kategori = 1) AND (status = 'remanja') AND (DATE(tgl_done_fcc) = CURDATE()) AND (TIME(tgl_done_fcc) BETWEEN '00:00:00' AND '11:59:00')");
		} elseif ($time == 'as_exp') {
			$this->db->where("(DATE(tgl_done_fcc) < SUBDATE(CURDATE(),1)) AND (kategori = 1)");
		} elseif ($time == 'as_h_min_1') {
			$this->db->where("(DATE(tgl_done_fcc) = SUBDATE(CURDATE(),1)) AND (kategori = 1)");
		} elseif ($time == 'pagi') {
			$this->db->where("(tgl_done_fcc>=CURDATE()) AND (TIME(tgl_done_fcc) BETWEEN '00:00:00' AND '11:59:00') AND (kategori = 1) AND (status != 'remanja')");
		} elseif ($time == 'sore') {
			$this->db->where("(tgl_done_fcc>=CURDATE()) AND (TIME(tgl_done_fcc) BETWEEN '12:00:00' AND '23:59:00') AND (kategori = 1)");
		} else {
			$this->db->where("(((kategori = 1) AND (status = 'remanja') AND (tgl_done_fcc is NOT NULL)) OR ((DATE(tgl_done_fcc) < SUBDATE(CURDATE(),1)) AND (kategori = 1 AND STATUS != 'remanja')) OR ((DATE(tgl_done_fcc) = SUBDATE(CURDATE(),1)) AND (kategori = 1 AND STATUS != 'remanja')) OR ((tgl_done_fcc>=CURDATE()) AND (TIME(tgl_done_fcc) BETWEEN '00:00:00' AND '11:59:00') AND (kategori = 1) AND (status != 'remanja')) OR ((tgl_done_fcc>=CURDATE()) AND (TIME(tgl_done_fcc) BETWEEN '12:00:00' AND '23:59:00') AND (kategori = 1) AND (status != 'remanja')) )");
		}

		if ($unit != 'all') {
			if ($unit == 'egbis') {
				$this->db->where('unit <>', 'DCS');
			} else {
				$this->db->where('unit', $unit);
			}
		}

		// filter waktu
		if ($waktu != 'all') {
			if ($waktu = 'daily') {
				$this->db->where("DAY(tgl_update) = DAY(CURRENT_DATE()) AND MONTH(tgl_update) = MONTH(CURRENT_DATE()) AND YEAR(tgl_update) = YEAR(CURRENT_DATE())");
			} elseif ($waktu == 'monthly') {
				$this->db->where("MONTH(tgl_update) = MONTH(CURRENT_DATE()) AND YEAR(tgl_update) = YEAR(CURRENT_DATE())");
			} elseif ($waktu == 'annual') {
				$this->db->where("YEAR(tgl_update) = YEAR(CURRENT_DATE())");
			}
		}

		$this->db->order_by('datel', 'ASC');
		$query = $this->db->get();
		return $query;
	}

	public function progress_order_pda($waktu, $datel, $time, $unit)
	{
		$this->db->select("
				datel,
				/*AMUNISI*/
				SUM(CASE WHEN (status = 'scbe' OR status = 'remanja') THEN 1 ELSE 0 END) as wo,
				SUM(CASE WHEN (status = 'ordered') THEN 1 ELSE 0 END) as ordered,
				SUM(CASE WHEN (status = 'otw') THEN 1 ELSE 0 END) as otw,
				SUM(CASE WHEN (status = 'ogp') THEN 1 ELSE 0 END) as ogp,
				SUM(CASE WHEN (status = 'cek_onu') THEN 1 ELSE 0 END) as cek_onu,

				/*KENDALA*/
				SUM(CASE WHEN (status = 'KENDALA PELANGGAN' AND status_id = '6' AND date(tgl_lapor_k) >= CURDATE()) THEN 1 ELSE 0 END) as p_nok,
				SUM(CASE WHEN (status = 'KENDALA JARINGAN' AND status_id = '6' AND date(tgl_lapor_k) >= CURDATE()) THEN 1 ELSE 0 END) as j_nok,

				/*PROGRESS PROVI*/
				SUM(CASE WHEN (status_id=7) AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND status_id!=10) THEN 1 ELSE 0 END) as wait_act,
				SUM(CASE WHEN (status_id=71) AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND status_id!=10) THEN 1 ELSE 0 END) as prog_act,
				SUM(CASE WHEN (status_id=8) AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND status_id!=10) THEN 1 ELSE 0 END) as fact,
				SUM(CASE WHEN (status_id=9) AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND status_id!=10) THEN 1 ELSE 0 END) as comp,
				SUM(CASE WHEN (status_id=10) AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND status_id!=10) THEN 1 ELSE 0 END) as ps
            ");
		$this->db->from('tb_sales');
		$this->db->where('segment', 2);

		// datel segmentation
		if ($datel != 'ALL') {
			$this->db->where('datel', $datel);
		}

		// time segmentation
		if ($time == 'reorder') {
			$this->db->where("(kategori = 1) AND (status = 'remanja') AND (tgl_done_fcc is NOT NULL)");
		} elseif ($time == 'as_exp') {
			$this->db->where("(DATE(tgl_done_fcc) < CURDATE()) AND (kategori = 1) AND (STATUS != 'remanja')");
		} elseif ($time == 'as_hi') {
			$this->db->where("(DATE(tgl_done_fcc) = CURDATE()) AND (kategori = 1) AND (STATUS != 'remanja')");
		} else {
			$this->db->where("(((kategori = 1) AND (status = 'remanja') AND (tgl_done_fcc is NOT NULL)) OR ((DATE(tgl_done_fcc) < CURDATE()) AND (kategori = 1 AND STATUS != 'remanja')) OR ((DATE(tgl_done_fcc) = CURDATE()) AND (kategori = 1 AND STATUS != 'remanja')) )");
		}

		// filter unit
		if ($unit != 'all') {
			if ($unit == 'egbis') {
				$this->db->where('unit <>', 'DCS');
			} else {
				$this->db->where('unit', $unit);
			}
		}

		// filter waktu
		if ($waktu != 'all') {
			if ($waktu = 'daily') {
				$this->db->where("DAY(tgl_update) = DAY(CURRENT_DATE()) AND MONTH(tgl_update) = MONTH(CURRENT_DATE()) AND YEAR(tgl_update) = YEAR(CURRENT_DATE())");
			} elseif ($waktu == 'monthly') {
				$this->db->where("MONTH(tgl_update) = MONTH(CURRENT_DATE()) AND YEAR(tgl_update) = YEAR(CURRENT_DATE())");
			} elseif ($waktu == 'annual') {
				$this->db->where("YEAR(tgl_update) = YEAR(CURRENT_DATE())");
			}
		}

		$this->db->order_by('datel', 'ASC');

		$query = $this->db->get();
		return $query;
	}

	public function progress_order_addon($waktu, $jenis, $datel, $time, $unit)
	{
		$this->db->select("
				datel,
				/*AMUNISI*/
				SUM(CASE WHEN (status = 'scbe' OR status = 'remanja') THEN 1 ELSE 0 END) as wo,
				SUM(CASE WHEN (status = 'ordered') THEN 1 ELSE 0 END) as ordered,
				SUM(CASE WHEN (status = 'otw') THEN 1 ELSE 0 END) as otw,
				SUM(CASE WHEN (status = 'ogp') THEN 1 ELSE 0 END) as ogp,
				SUM(CASE WHEN (status = 'cek_onu') THEN 1 ELSE 0 END) as cek_onu,

				/*KENDALA*/
				SUM(CASE WHEN (status = 'KENDALA PELANGGAN' AND status_id = '6' AND date(tgl_lapor_k) >= CURDATE()) THEN 1 ELSE 0 END) as p_nok,
				SUM(CASE WHEN (status = 'KENDALA JARINGAN' AND status_id = '6' AND date(tgl_lapor_k) >= CURDATE()) THEN 1 ELSE 0 END) as j_nok,

				/*PROGRESS PROVI*/
				SUM(CASE WHEN (status_id=7) AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND status_id!=10) THEN 1 ELSE 0 END) as wait_act,
				SUM(CASE WHEN (status_id=71) AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND status_id!=10) THEN 1 ELSE 0 END) as prog_act,
				SUM(CASE WHEN (status_id=8) AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND status_id!=10) THEN 1 ELSE 0 END) as fact,
				SUM(CASE WHEN (status_id=9) AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND status_id!=10) THEN 1 ELSE 0 END) as comp,
				SUM(CASE WHEN (status_id=10) AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND status_id!=10) THEN 1 ELSE 0 END) as ps
            ");
		$this->db->from('tb_sales');
		$this->db->where('segment', 3);

		// datel segmentation
		if ($datel != 'ALL') {
			$this->db->where('datel', $datel);
		}

		// jenis segmentation
		if ($jenis != 'all') {
			$this->db->where('add_on_type', $jenis);
		}

		// time segmentation
		if ($time == 'reorder') {
			$this->db->where("(kategori = 1) AND (status = 'remanja') AND (tgl_done_fcc is NOT NULL)");
		} elseif ($time == 'as_exp') {
			$this->db->where("(DATE(tgl_done_fcc) < CURDATE()) AND (kategori = 1 AND STATUS != 'remanja')");
		} elseif ($time == 'as_hi') {
			$this->db->where("(DATE(tgl_done_fcc) = CURDATE()) AND (kategori = 1 AND STATUS != 'remanja')");
		} else {
			$this->db->where("(((kategori = 1) AND (status = 'remanja') AND (tgl_done_fcc is NOT NULL)) OR ((DATE(tgl_done_fcc) < CURDATE()) AND (kategori = 1 AND STATUS != 'remanja')) OR ((DATE(tgl_done_fcc) = CURDATE()) AND (kategori = 1 AND STATUS != 'remanja')) )");
		}

		// filter unit
		if ($unit != 'all') {
			if ($unit == 'egbis') {
				$this->db->where('unit <>', 'DCS');
			} else {
				$this->db->where('unit', $unit);
			}
		}

		// filter waktu
		if ($waktu != 'all') {
			if ($waktu = 'daily') {
				$this->db->where("DAY(tgl_update) = DAY(CURRENT_DATE()) AND MONTH(tgl_update) = MONTH(CURRENT_DATE()) AND YEAR(tgl_update) = YEAR(CURRENT_DATE())");
			} elseif ($waktu == 'monthly') {
				$this->db->where("MONTH(tgl_update) = MONTH(CURRENT_DATE()) AND YEAR(tgl_update) = YEAR(CURRENT_DATE())");
			} elseif ($waktu == 'annual') {
				$this->db->where("YEAR(tgl_update) = YEAR(CURRENT_DATE())");
			}
		}

		$this->db->order_by('datel', 'ASC');

		$query = $this->db->get();
		return $query;
	}

	function work_order_teknisi($segment, $unit)
	{
		if ($segment != 'all') {
			$q_segment = "segment = $segment";
		} else {
			$q_segment = "segment = 0 OR segment = 2 OR segment = 3";
		}

		$this->db->select("
			sales_id,
			tb_teknisi.datel,
			nama_teknisi,
			crew,
			t_telegram_id,
			progress_to,

			/*AMUNISI*/
			SUM(CASE WHEN (status = 'ordered') THEN 1 ELSE 0 END) as wo,
			SUM(CASE WHEN (status = 'otw') THEN 1 ELSE 0 END) as otw,
			SUM(CASE WHEN (status = 'ogp') THEN 1 ELSE 0 END) as ogp,
			SUM(CASE WHEN (status = 'cek_onu') THEN 1 ELSE 0 END) as cek_onu,
			
			/*KENDALA*/
			SUM(CASE WHEN (status = 'KENDALA PELANGGAN' AND status_id = '6' AND date(tgl_lapor_k) = CURDATE()) THEN 1 ELSE 0 END) as p_nok,
			SUM(CASE WHEN (status = 'KENDALA JARINGAN' AND status_id = '6' AND date(tgl_lapor_k) = CURDATE()) THEN 1 ELSE 0 END) as j_nok,
			
			/*REQ SC*/
			SUM(CASE WHEN (status_id=3 OR status_id=12 OR status_id=31 OR status_id=32 OR status_id=33) THEN 1 ELSE 0 END) as waitsc,
			SUM(CASE WHEN (status_id=5) THEN 1 ELSE 0 END) as donesc,
			
			/*PROGRESS PROVI*/
			SUM(CASE WHEN (status_id=7) AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND status_id!=10) THEN 1 ELSE 0 END) as wait_act,
			SUM(CASE WHEN (status_id=71) AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND status_id!=10) THEN 1 ELSE 0 END) as prog_act,
			SUM(CASE WHEN (status_id=8) AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND status_id!=10) THEN 1 ELSE 0 END) as fact,
			SUM(CASE WHEN (status_id=9) AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND status_id!=10) THEN 1 ELSE 0 END) as comp,
			SUM(CASE WHEN (status_id=10) AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND status_id!=10) THEN 1 ELSE 0 END) as ps,

			SUM(CASE WHEN ((status_id IS NULL) OR (status_id > 1 AND status_id < 6) OR (status_id = 6 AND DATE(tgl_lapor_k) = CURDATE() AND kendala <> 'TERMINATE') OR (status_id >= 7 AND status_id <> 13 AND status_id <> 127 AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND status_id!=10))) THEN 1 ELSE 0 END) as all_today
		");
		$this->db->from('tb_teknisi');
		$this->db->join('tb_sales', 'tb_sales.progress_to = tb_teknisi.t_telegram_id', 'LEFT');

		// $this->db->where("((tb_teknisi.datel = tb_sales.datel) AND (tb_teknisi.active = 1) AND (tb_teknisi.crew is NOT NULL AND tb_teknisi.crew != '0' AND tb_teknisi.crew != '-') AND (libur NOT LIKE '%" . date('d') . "%') AND ($q_segment))");
		// $this->db->where("((tb_teknisi.datel = tb_sales.datel) AND (tb_teknisi.active = 1) AND (tb_teknisi.crew is NOT NULL AND tb_teknisi.crew != '0' AND tb_teknisi.crew != '-') AND ($q_segment))");
		$this->db->where("((tb_teknisi.active = 1) AND (tb_teknisi.crew is NOT NULL AND tb_teknisi.crew != '0' AND tb_teknisi.crew != '-') AND ($q_segment))");

		if ($unit != 'all') {
			if ($unit == 'egbis') {
				$this->db->where('unit <>', 'DCS');
			} else {
				$this->db->where('unit', $unit);
			}
		}

		$this->db->group_by('tb_teknisi.datel');
		$this->db->group_by('tb_teknisi.crew');
		$this->db->having('all_today > 0');
		$this->db->order_by('tb_teknisi.datel', 'ASC');

		$query = $this->db->get();
		return $query;
	}

	function all_datel($segment, $unit)
	{
		if ($segment != 'all') {
			$q_segment = "segment = $segment";
		} else {
			$q_segment = "segment = 0 OR segment = 2 OR segment = 3";
		}
		$this->db->select("
			tb_sales.datel,
			/*AMUNISI*/
			SUM(CASE WHEN (status = 'ordered') THEN 1 ELSE 0 END) as wo,
			SUM(CASE WHEN (status = 'otw') THEN 1 ELSE 0 END) as otw,
			SUM(CASE WHEN (status = 'ogp') THEN 1 ELSE 0 END) as ogp,
			SUM(CASE WHEN (status = 'cek_onu') THEN 1 ELSE 0 END) as cek_onu,
			
			/*KENDALA*/
			SUM(CASE WHEN (status = 'KENDALA PELANGGAN' AND status_id = '6' AND date(tgl_lapor_k) = CURDATE()) THEN 1 ELSE 0 END) as p_nok,
			SUM(CASE WHEN (status = 'KENDALA JARINGAN' AND status_id = '6' AND date(tgl_lapor_k) = CURDATE()) THEN 1 ELSE 0 END) as j_nok,
			
			/*REQ SC*/
			SUM(CASE WHEN (status_id=3 OR status_id=12 OR status_id=31 OR status_id=32 OR status_id=33) THEN 1 ELSE 0 END) as waitsc,
			SUM(CASE WHEN (status_id=5) THEN 1 ELSE 0 END) as donesc,
			
			/*PROGRESS PROVI*/
			SUM(CASE WHEN (status_id=7) AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND status_id!=10) THEN 1 ELSE 0 END) as wait_act,
			SUM(CASE WHEN (status_id=71) AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND status_id!=10) THEN 1 ELSE 0 END) as prog_act,
			SUM(CASE WHEN (status_id=8) AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND status_id!=10) THEN 1 ELSE 0 END) as fact,
			SUM(CASE WHEN (status_id=9) AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND status_id!=10) THEN 1 ELSE 0 END) as comp,
			SUM(CASE WHEN (status_id=10) AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND status_id!=10) THEN 1 ELSE 0 END) as ps,

			SUM(CASE WHEN ((status_id > 1 AND status_id < 6) OR (status_id = 6 AND DATE(tgl_lapor_k) = CURDATE() AND kendala <> 'TERMINATE') OR (status_id >= 7 AND status_id <> 13 AND status_id <> 127 AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND status_id!=10))) THEN 1 ELSE 0 END) as all_today
		");
		$this->db->from('tb_teknisi');
		$this->db->join('tb_sales', 'tb_sales.progress_to = tb_teknisi.t_telegram_id', 'LEFT');

		// $this->db->where("(tb_teknisi.active = 1) AND (tb_teknisi.crew is NOT NULL AND tb_teknisi.crew != '0' AND tb_teknisi.crew != '-') AND (libur NOT LIKE '%" . date('d') . "%' ) AND ($q_segment)");
		// $this->db->where("((tb_teknisi.datel = tb_sales.datel) AND (tb_teknisi.active = 1) AND (tb_teknisi.crew is NOT NULL AND tb_teknisi.crew != '0' AND tb_teknisi.crew != '-') AND ($q_segment))");
		$this->db->where("((tb_teknisi.active = 1) AND (tb_teknisi.crew is NOT NULL AND tb_teknisi.crew != '0' AND tb_teknisi.crew != '-') AND ($q_segment))");

		if ($unit != 'all') {
			if ($unit == 'egbis') {
				$this->db->where('unit <>', 'DCS');
			} else {
				$this->db->where('unit', $unit);
			}
		}

		$this->db->group_by('datel');
		$this->db->having('all_today > 0');
		$this->db->order_by('datel', 'ASC');
		$query = $this->db->get();
		return $query;
	}

	function total_work_order_teknisi($segment, $unit)
	{
		if ($segment != 'all') {
			$q_segment = "segment = $segment";
		} else {
			$q_segment = "segment = 0 OR segment = 2 OR segment = 3";
		}
		$this->db->select("
			tb_sales.datel,
			/*AMUNISI*/
			SUM(CASE WHEN (status = 'ordered') THEN 1 ELSE 0 END) as wo,
			SUM(CASE WHEN (status = 'otw') THEN 1 ELSE 0 END) as otw,
			SUM(CASE WHEN (status = 'ogp') THEN 1 ELSE 0 END) as ogp,
			SUM(CASE WHEN (status = 'cek_onu') THEN 1 ELSE 0 END) as cek_onu,
			
			/*KENDALA*/
			SUM(CASE WHEN (status = 'KENDALA PELANGGAN' AND status_id = '6' AND date(tgl_lapor_k) = CURDATE()) THEN 1 ELSE 0 END) as p_nok,
			SUM(CASE WHEN (status = 'KENDALA JARINGAN' AND status_id = '6' AND date(tgl_lapor_k) = CURDATE()) THEN 1 ELSE 0 END) as j_nok,
			
			/*REQ SC*/
			SUM(CASE WHEN (status_id=3 OR status_id=12 OR status_id=31 OR status_id=32 OR status_id=33) THEN 1 ELSE 0 END) as waitsc,
			SUM(CASE WHEN (status_id=5) THEN 1 ELSE 0 END) as donesc,
			
			/*PROGRESS PROVI*/
			SUM(CASE WHEN (status_id=7) AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND status_id!=10) THEN 1 ELSE 0 END) as wait_act,
			SUM(CASE WHEN (status_id=71) AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND status_id!=10) THEN 1 ELSE 0 END) as prog_act,
			SUM(CASE WHEN (status_id=8) AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND status_id!=10) THEN 1 ELSE 0 END) as fact,
			SUM(CASE WHEN (status_id=9) AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND status_id!=10) THEN 1 ELSE 0 END) as comp,
			SUM(CASE WHEN (status_id=10) AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND status_id!=10) THEN 1 ELSE 0 END) as ps,

			SUM(CASE WHEN ((status_id > 1 AND status_id < 6) OR (status_id = 6 AND DATE(tgl_lapor_k) = CURDATE() AND kendala <> 'TERMINATE') OR (status_id >= 7 AND status_id <> 13 AND status_id <> 127 AND (tgl_done_fcc >= CURDATE() OR tgl_update >= CURDATE() OR tgl_update < CURDATE() AND status_id!=10))) THEN 1 ELSE 0 END) as all_today
		");
		$this->db->from('tb_teknisi');
		$this->db->join('tb_sales', 'tb_sales.progress_to = tb_teknisi.t_telegram_id', 'LEFT');

		// $this->db->where("(tb_teknisi.active = 1) AND (tb_teknisi.crew is NOT NULL AND tb_teknisi.crew != '0' AND tb_teknisi.crew != '-') AND (libur NOT LIKE '%" . date('d') . "%' ) AND ($q_segment)");
		// $this->db->where("((tb_teknisi.datel = tb_sales.datel) AND (tb_teknisi.active = 1) AND (tb_teknisi.crew is NOT NULL AND tb_teknisi.crew != '0' AND tb_teknisi.crew != '-') AND ($q_segment))");
		$this->db->where("((tb_teknisi.active = 1) AND (tb_teknisi.crew is NOT NULL AND tb_teknisi.crew != '0' AND tb_teknisi.crew != '-') AND ($q_segment))");

		if ($unit != 'all') {
			if ($unit == 'egbis') {
				$this->db->where('unit <>', 'DCS');
			} else {
				$this->db->where('unit', $unit);
			}
		}

		$this->db->having('all_today > 0');
		$query = $this->db->get();
		return $query;
	}

	function monitoring_amunisi_teknisi($segment, $unit)
	{
		$this->db->select("
			tb_sales.datel,
			nama_teknisi,
			crew,
			t_telegram_id,
			/*AMUNISI*/
			SUM(CASE WHEN (amunisi = 'pagi' AND ba = 0) THEN 1 ELSE 0 END) as deal_pagi_blm_ba,
			SUM(CASE WHEN (amunisi = 'pagi' AND ba = 1) THEN 1 ELSE 0 END) as deal_pagi_sdh_ba,
			SUM(CASE WHEN (amunisi = 'h_min_1' AND ba = 0) THEN 1 ELSE 0 END) as as_h_min_1_blm_ba,
			SUM(CASE WHEN (amunisi = 'h_min_1' AND ba = 1) THEN 1 ELSE 0 END) as as_h_min_1_sdh_ba,
			SUM(CASE WHEN (amunisi = 'exp' AND ba = 0) THEN 1 ELSE 0 END) as as_exp_blm_ba,
			SUM(CASE WHEN (amunisi = 'exp' AND ba = 1) THEN 1 ELSE 0 END) as as_exp_sdh_ba,
			SUM(CASE WHEN (amunisi = 'reorder' AND ba = 0) THEN 1 ELSE 0 END) as reorder_blm_ba,
			SUM(CASE WHEN (amunisi = 'reorder' AND ba = 1) THEN 1 ELSE 0 END) as reorder_sdh_ba,
		");
		$this->db->from('tb_teknisi');
		$this->db->join('tb_sales', 'tb_sales.progress_to = tb_teknisi.t_telegram_id', 'left');
		$this->db->join('tb_ba_amunisi', 'tb_ba_amunisi.sales_id = tb_sales.sales_id');

		if ($segment != 'all') {
			$this->db->where("(segment = '$segment')");
		} else {
			$this->db->where("(segment = 0 OR segment = 2 OR segment = 3)");
		}

		if ($unit != 'all') {
			if ($unit == 'egbis') {
				$this->db->where('unit <>', 'DCS');
			} else {
				$this->db->where('unit', $unit);
			}
		}

		$this->db->where('tb_teknisi.active', 1);
		$this->db->where("(tb_teknisi.crew is NOT NULL AND tb_teknisi.crew != '0' AND tb_teknisi.crew != '-')");
		$this->db->group_by('tb_sales.datel');
		$this->db->group_by('tb_teknisi.crew');
		$this->db->order_by('datel', 'ASC');
		$query = $this->db->get();
		return $query;
	}

	function monitoring_amunisi_datel($segment, $unit)
	{
		$this->db->select("
			tb_sales.datel,
			/*AMUNISI*/
			SUM(CASE WHEN (amunisi = 'pagi' AND ba = 0) THEN 1 ELSE 0 END) as deal_pagi_blm_ba,
			SUM(CASE WHEN (amunisi = 'pagi' AND ba = 1) THEN 1 ELSE 0 END) as deal_pagi_sdh_ba,
			SUM(CASE WHEN (amunisi = 'h_min_1' AND ba = 0) THEN 1 ELSE 0 END) as as_h_min_1_blm_ba,
			SUM(CASE WHEN (amunisi = 'h_min_1' AND ba = 1) THEN 1 ELSE 0 END) as as_h_min_1_sdh_ba,
			SUM(CASE WHEN (amunisi = 'exp' AND ba = 0) THEN 1 ELSE 0 END) as as_exp_blm_ba,
			SUM(CASE WHEN (amunisi = 'exp' AND ba = 1) THEN 1 ELSE 0 END) as as_exp_sdh_ba,
			SUM(CASE WHEN (amunisi = 'reorder' AND ba = 0) THEN 1 ELSE 0 END) as reorder_blm_ba,
			SUM(CASE WHEN (amunisi = 'reorder' AND ba = 1) THEN 1 ELSE 0 END) as reorder_sdh_ba,
		");
		$this->db->from('tb_teknisi');
		$this->db->join('tb_sales', 'tb_sales.progress_to = tb_teknisi.t_telegram_id', 'left');
		$this->db->join('tb_ba_amunisi', 'tb_ba_amunisi.sales_id = tb_sales.sales_id');

		if ($segment != 'all') {
			$this->db->where("(segment = $segment)");
		} else {
			$this->db->where("(segment = 0 OR segment = 2 OR segment = 3)");
		}

		if ($unit != 'all') {
			if ($unit == 'egbis') {
				$this->db->where('unit <>', 'DCS');
			} else {
				$this->db->where('unit', $unit);
			}
		}

		$this->db->where('tb_teknisi.active', 1);
		$this->db->where("(tb_teknisi.crew is NOT NULL AND tb_teknisi.crew != '0' AND tb_teknisi.crew != '-')");
		$this->db->group_by('tb_sales.datel');
		$this->db->order_by('tb_sales.datel', 'ASC');
		$query = $this->db->get();
		return $query;
	}

	public function produktifitas($bulan, $tahun, $datel, $kategori)
	{
		$b = $bulan != 'now' ? $bulan : date('m');
		$t = $tahun != 'now' ? $tahun : date('Y');
		// $tanggal = "{$tahun}-{$bulan}-01";

		// $query_scbe = "AND ((DAY(tgl_done_fcc) = SUBDATE('{$tanggal}',1))";

		// SELECT
		switch ($kategori) {
			case 'scbe':
				$this->db->select("
					/*SCBE*/
					SUM(CASE WHEN ((status_id < 3 AND kategori = 1 AND status != 'remanja') AND (DAY(tgl_done_fcc) = 01 AND TIME(tgl_done_fcc) BETWEEN '00:00:00' AND '11:59:00')) THEN 1 ELSE 0 END) as scbe_1,
					SUM(CASE WHEN ((status_id < 3 AND kategori = 1 AND status != 'remanja') AND ((DAY(tgl_done_fcc) = 01 AND TIME(tgl_done_fcc) BETWEEN '12:00:00' AND '23:59:00') OR (DAY(tgl_done_fcc) = 02 AND TIME(tgl_done_fcc) BETWEEN '00:00:00' AND '11:59:00'))) THEN 1 ELSE 0 END) as scbe_2,
					SUM(CASE WHEN ((status_id < 3 AND kategori = 1 AND status != 'remanja') AND ((DAY(tgl_done_fcc) = 02 AND TIME(tgl_done_fcc) BETWEEN '12:00:00' AND '23:59:00') OR (DAY(tgl_done_fcc) = 03 AND TIME(tgl_done_fcc) BETWEEN '00:00:00' AND '11:59:00'))) THEN 1 ELSE 0 END) as scbe_3,
					SUM(CASE WHEN ((status_id < 3 AND kategori = 1 AND status != 'remanja') AND ((DAY(tgl_done_fcc) = 03 AND TIME(tgl_done_fcc) BETWEEN '12:00:00' AND '23:59:00') OR (DAY(tgl_done_fcc) = 04 AND TIME(tgl_done_fcc) BETWEEN '00:00:00' AND '11:59:00'))) THEN 1 ELSE 0 END) as scbe_4,
					SUM(CASE WHEN ((status_id < 3 AND kategori = 1 AND status != 'remanja') AND ((DAY(tgl_done_fcc) = 04 AND TIME(tgl_done_fcc) BETWEEN '12:00:00' AND '23:59:00') OR (DAY(tgl_done_fcc) = 05 AND TIME(tgl_done_fcc) BETWEEN '00:00:00' AND '11:59:00'))) THEN 1 ELSE 0 END) as scbe_5,
					SUM(CASE WHEN ((status_id < 3 AND kategori = 1 AND status != 'remanja') AND ((DAY(tgl_done_fcc) = 05 AND TIME(tgl_done_fcc) BETWEEN '12:00:00' AND '23:59:00') OR (DAY(tgl_done_fcc) = 06 AND TIME(tgl_done_fcc) BETWEEN '00:00:00' AND '11:59:00'))) THEN 1 ELSE 0 END) as scbe_6,
					SUM(CASE WHEN ((status_id < 3 AND kategori = 1 AND status != 'remanja') AND ((DAY(tgl_done_fcc) = 06 AND TIME(tgl_done_fcc) BETWEEN '12:00:00' AND '23:59:00') OR (DAY(tgl_done_fcc) = 07 AND TIME(tgl_done_fcc) BETWEEN '00:00:00' AND '11:59:00'))) THEN 1 ELSE 0 END) as scbe_7,
					SUM(CASE WHEN ((status_id < 3 AND kategori = 1 AND status != 'remanja') AND ((DAY(tgl_done_fcc) = 07 AND TIME(tgl_done_fcc) BETWEEN '12:00:00' AND '23:59:00') OR (DAY(tgl_done_fcc) = 08 AND TIME(tgl_done_fcc) BETWEEN '00:00:00' AND '11:59:00'))) THEN 1 ELSE 0 END) as scbe_8,
					SUM(CASE WHEN ((status_id < 3 AND kategori = 1 AND status != 'remanja') AND ((DAY(tgl_done_fcc) = 08 AND TIME(tgl_done_fcc) BETWEEN '12:00:00' AND '23:59:00') OR (DAY(tgl_done_fcc) = 09 AND TIME(tgl_done_fcc) BETWEEN '00:00:00' AND '11:59:00'))) THEN 1 ELSE 0 END) as scbe_9,
					SUM(CASE WHEN ((status_id < 3 AND kategori = 1 AND status != 'remanja') AND ((DAY(tgl_done_fcc) = 09 AND TIME(tgl_done_fcc) BETWEEN '12:00:00' AND '23:59:00') OR (DAY(tgl_done_fcc) = 10 AND TIME(tgl_done_fcc) BETWEEN '00:00:00' AND '11:59:00'))) THEN 1 ELSE 0 END) as scbe_10,
					SUM(CASE WHEN ((status_id < 3 AND kategori = 1 AND status != 'remanja') AND ((DAY(tgl_done_fcc) = 10 AND TIME(tgl_done_fcc) BETWEEN '12:00:00' AND '23:59:00') OR (DAY(tgl_done_fcc) = 11 AND TIME(tgl_done_fcc) BETWEEN '00:00:00' AND '11:59:00'))) THEN 1 ELSE 0 END) as scbe_11,
					SUM(CASE WHEN ((status_id < 3 AND kategori = 1 AND status != 'remanja') AND ((DAY(tgl_done_fcc) = 11 AND TIME(tgl_done_fcc) BETWEEN '12:00:00' AND '23:59:00') OR (DAY(tgl_done_fcc) = 12 AND TIME(tgl_done_fcc) BETWEEN '00:00:00' AND '11:59:00'))) THEN 1 ELSE 0 END) as scbe_12,
					SUM(CASE WHEN ((status_id < 3 AND kategori = 1 AND status != 'remanja') AND ((DAY(tgl_done_fcc) = 12 AND TIME(tgl_done_fcc) BETWEEN '12:00:00' AND '23:59:00') OR (DAY(tgl_done_fcc) = 13 AND TIME(tgl_done_fcc) BETWEEN '00:00:00' AND '11:59:00'))) THEN 1 ELSE 0 END) as scbe_13,
					SUM(CASE WHEN ((status_id < 3 AND kategori = 1 AND status != 'remanja') AND ((DAY(tgl_done_fcc) = 13 AND TIME(tgl_done_fcc) BETWEEN '12:00:00' AND '23:59:00') OR (DAY(tgl_done_fcc) = 14 AND TIME(tgl_done_fcc) BETWEEN '00:00:00' AND '11:59:00'))) THEN 1 ELSE 0 END) as scbe_14,
					SUM(CASE WHEN ((status_id < 3 AND kategori = 1 AND status != 'remanja') AND ((DAY(tgl_done_fcc) = 14 AND TIME(tgl_done_fcc) BETWEEN '12:00:00' AND '23:59:00') OR (DAY(tgl_done_fcc) = 15 AND TIME(tgl_done_fcc) BETWEEN '00:00:00' AND '11:59:00'))) THEN 1 ELSE 0 END) as scbe_15,
					SUM(CASE WHEN ((status_id < 3 AND kategori = 1 AND status != 'remanja') AND ((DAY(tgl_done_fcc) = 15 AND TIME(tgl_done_fcc) BETWEEN '12:00:00' AND '23:59:00') OR (DAY(tgl_done_fcc) = 16 AND TIME(tgl_done_fcc) BETWEEN '00:00:00' AND '11:59:00'))) THEN 1 ELSE 0 END) as scbe_16,
					SUM(CASE WHEN ((status_id < 3 AND kategori = 1 AND status != 'remanja') AND ((DAY(tgl_done_fcc) = 16 AND TIME(tgl_done_fcc) BETWEEN '12:00:00' AND '23:59:00') OR (DAY(tgl_done_fcc) = 17 AND TIME(tgl_done_fcc) BETWEEN '00:00:00' AND '11:59:00'))) THEN 1 ELSE 0 END) as scbe_17,
					SUM(CASE WHEN ((status_id < 3 AND kategori = 1 AND status != 'remanja') AND ((DAY(tgl_done_fcc) = 17 AND TIME(tgl_done_fcc) BETWEEN '12:00:00' AND '23:59:00') OR (DAY(tgl_done_fcc) = 18 AND TIME(tgl_done_fcc) BETWEEN '00:00:00' AND '11:59:00'))) THEN 1 ELSE 0 END) as scbe_18,
					SUM(CASE WHEN ((status_id < 3 AND kategori = 1 AND status != 'remanja') AND ((DAY(tgl_done_fcc) = 18 AND TIME(tgl_done_fcc) BETWEEN '12:00:00' AND '23:59:00') OR (DAY(tgl_done_fcc) = 19 AND TIME(tgl_done_fcc) BETWEEN '00:00:00' AND '11:59:00'))) THEN 1 ELSE 0 END) as scbe_19,
					SUM(CASE WHEN ((status_id < 3 AND kategori = 1 AND status != 'remanja') AND ((DAY(tgl_done_fcc) = 19 AND TIME(tgl_done_fcc) BETWEEN '12:00:00' AND '23:59:00') OR (DAY(tgl_done_fcc) = 20 AND TIME(tgl_done_fcc) BETWEEN '00:00:00' AND '11:59:00'))) THEN 1 ELSE 0 END) as scbe_20,
					SUM(CASE WHEN ((status_id < 3 AND kategori = 1 AND status != 'remanja') AND ((DAY(tgl_done_fcc) = 20 AND TIME(tgl_done_fcc) BETWEEN '12:00:00' AND '23:59:00') OR (DAY(tgl_done_fcc) = 21 AND TIME(tgl_done_fcc) BETWEEN '00:00:00' AND '11:59:00'))) THEN 1 ELSE 0 END) as scbe_21,
					SUM(CASE WHEN ((status_id < 3 AND kategori = 1 AND status != 'remanja') AND ((DAY(tgl_done_fcc) = 21 AND TIME(tgl_done_fcc) BETWEEN '12:00:00' AND '23:59:00') OR (DAY(tgl_done_fcc) = 22 AND TIME(tgl_done_fcc) BETWEEN '00:00:00' AND '11:59:00'))) THEN 1 ELSE 0 END) as scbe_22,
					SUM(CASE WHEN ((status_id < 3 AND kategori = 1 AND status != 'remanja') AND ((DAY(tgl_done_fcc) = 22 AND TIME(tgl_done_fcc) BETWEEN '12:00:00' AND '23:59:00') OR (DAY(tgl_done_fcc) = 23 AND TIME(tgl_done_fcc) BETWEEN '00:00:00' AND '11:59:00'))) THEN 1 ELSE 0 END) as scbe_23,
					SUM(CASE WHEN ((status_id < 3 AND kategori = 1 AND status != 'remanja') AND ((DAY(tgl_done_fcc) = 23 AND TIME(tgl_done_fcc) BETWEEN '12:00:00' AND '23:59:00') OR (DAY(tgl_done_fcc) = 24 AND TIME(tgl_done_fcc) BETWEEN '00:00:00' AND '11:59:00'))) THEN 1 ELSE 0 END) as scbe_24,
					SUM(CASE WHEN ((status_id < 3 AND kategori = 1 AND status != 'remanja') AND ((DAY(tgl_done_fcc) = 24 AND TIME(tgl_done_fcc) BETWEEN '12:00:00' AND '23:59:00') OR (DAY(tgl_done_fcc) = 25 AND TIME(tgl_done_fcc) BETWEEN '00:00:00' AND '11:59:00'))) THEN 1 ELSE 0 END) as scbe_25,
					SUM(CASE WHEN ((status_id < 3 AND kategori = 1 AND status != 'remanja') AND ((DAY(tgl_done_fcc) = 25 AND TIME(tgl_done_fcc) BETWEEN '12:00:00' AND '23:59:00') OR (DAY(tgl_done_fcc) = 26 AND TIME(tgl_done_fcc) BETWEEN '00:00:00' AND '11:59:00'))) THEN 1 ELSE 0 END) as scbe_26,
					SUM(CASE WHEN ((status_id < 3 AND kategori = 1 AND status != 'remanja') AND ((DAY(tgl_done_fcc) = 26 AND TIME(tgl_done_fcc) BETWEEN '12:00:00' AND '23:59:00') OR (DAY(tgl_done_fcc) = 27 AND TIME(tgl_done_fcc) BETWEEN '00:00:00' AND '11:59:00'))) THEN 1 ELSE 0 END) as scbe_27,
					SUM(CASE WHEN ((status_id < 3 AND kategori = 1 AND status != 'remanja') AND ((DAY(tgl_done_fcc) = 27 AND TIME(tgl_done_fcc) BETWEEN '12:00:00' AND '23:59:00') OR (DAY(tgl_done_fcc) = 28 AND TIME(tgl_done_fcc) BETWEEN '00:00:00' AND '11:59:00'))) THEN 1 ELSE 0 END) as scbe_28,
					SUM(CASE WHEN ((status_id < 3 AND kategori = 1 AND status != 'remanja') AND ((DAY(tgl_done_fcc) = 28 AND TIME(tgl_done_fcc) BETWEEN '12:00:00' AND '23:59:00') OR (DAY(tgl_done_fcc) = 29 AND TIME(tgl_done_fcc) BETWEEN '00:00:00' AND '11:59:00'))) THEN 1 ELSE 0 END) as scbe_29,
					SUM(CASE WHEN ((status_id < 3 AND kategori = 1 AND status != 'remanja') AND ((DAY(tgl_done_fcc) = 29 AND TIME(tgl_done_fcc) BETWEEN '12:00:00' AND '23:59:00') OR (DAY(tgl_done_fcc) = 30 AND TIME(tgl_done_fcc) BETWEEN '00:00:00' AND '11:59:00'))) THEN 1 ELSE 0 END) as scbe_30,
					SUM(CASE WHEN ((status_id < 3 AND kategori = 1 AND status != 'remanja') AND ((DAY(tgl_done_fcc) = 30 AND TIME(tgl_done_fcc) BETWEEN '12:00:00' AND '23:59:00') OR (DAY(tgl_done_fcc) = 31))) THEN 1 ELSE 0 END) as scbe_31,
					SUM(CASE WHEN (status_id < 3 AND kategori = 1 AND status != 'remanja') THEN 1 ELSE 0 END) as total_scbe
				");
				break;

			case 'reorder':
				$this->db->select("
					/*REORDER*/
					SUM(CASE WHEN ((status_id < 3) AND (status = 'remanja') AND (DAY(tgl_update) = 01)) THEN 1 ELSE 0 END) as reorder_1,
					SUM(CASE WHEN ((status_id < 3) AND (status = 'remanja') AND (DAY(tgl_update) = 02)) THEN 1 ELSE 0 END) as reorder_2,
					SUM(CASE WHEN ((status_id < 3) AND (status = 'remanja') AND (DAY(tgl_update) = 03)) THEN 1 ELSE 0 END) as reorder_3,
					SUM(CASE WHEN ((status_id < 3) AND (status = 'remanja') AND (DAY(tgl_update) = 04)) THEN 1 ELSE 0 END) as reorder_4,
					SUM(CASE WHEN ((status_id < 3) AND (status = 'remanja') AND (DAY(tgl_update) = 05)) THEN 1 ELSE 0 END) as reorder_5,
					SUM(CASE WHEN ((status_id < 3) AND (status = 'remanja') AND (DAY(tgl_update) = 06)) THEN 1 ELSE 0 END) as reorder_6,
					SUM(CASE WHEN ((status_id < 3) AND (status = 'remanja') AND (DAY(tgl_update) = 07)) THEN 1 ELSE 0 END) as reorder_7,
					SUM(CASE WHEN ((status_id < 3) AND (status = 'remanja') AND (DAY(tgl_update) = 08)) THEN 1 ELSE 0 END) as reorder_8,
					SUM(CASE WHEN ((status_id < 3) AND (status = 'remanja') AND (DAY(tgl_update) = 09)) THEN 1 ELSE 0 END) as reorder_9,
					SUM(CASE WHEN ((status_id < 3) AND (status = 'remanja') AND (DAY(tgl_update) = 10)) THEN 1 ELSE 0 END) as reorder_10,
					SUM(CASE WHEN ((status_id < 3) AND (status = 'remanja') AND (DAY(tgl_update) = 11)) THEN 1 ELSE 0 END) as reorder_11,
					SUM(CASE WHEN ((status_id < 3) AND (status = 'remanja') AND (DAY(tgl_update) = 12)) THEN 1 ELSE 0 END) as reorder_12,
					SUM(CASE WHEN ((status_id < 3) AND (status = 'remanja') AND (DAY(tgl_update) = 13)) THEN 1 ELSE 0 END) as reorder_13,
					SUM(CASE WHEN ((status_id < 3) AND (status = 'remanja') AND (DAY(tgl_update) = 14)) THEN 1 ELSE 0 END) as reorder_14,
					SUM(CASE WHEN ((status_id < 3) AND (status = 'remanja') AND (DAY(tgl_update) = 15)) THEN 1 ELSE 0 END) as reorder_15,
					SUM(CASE WHEN ((status_id < 3) AND (status = 'remanja') AND (DAY(tgl_update) = 16)) THEN 1 ELSE 0 END) as reorder_16,
					SUM(CASE WHEN ((status_id < 3) AND (status = 'remanja') AND (DAY(tgl_update) = 17)) THEN 1 ELSE 0 END) as reorder_17,
					SUM(CASE WHEN ((status_id < 3) AND (status = 'remanja') AND (DAY(tgl_update) = 18)) THEN 1 ELSE 0 END) as reorder_18,
					SUM(CASE WHEN ((status_id < 3) AND (status = 'remanja') AND (DAY(tgl_update) = 19)) THEN 1 ELSE 0 END) as reorder_19,
					SUM(CASE WHEN ((status_id < 3) AND (status = 'remanja') AND (DAY(tgl_update) = 20)) THEN 1 ELSE 0 END) as reorder_20,
					SUM(CASE WHEN ((status_id < 3) AND (status = 'remanja') AND (DAY(tgl_update) = 21)) THEN 1 ELSE 0 END) as reorder_21,
					SUM(CASE WHEN ((status_id < 3) AND (status = 'remanja') AND (DAY(tgl_update) = 22)) THEN 1 ELSE 0 END) as reorder_22,
					SUM(CASE WHEN ((status_id < 3) AND (status = 'remanja') AND (DAY(tgl_update) = 23)) THEN 1 ELSE 0 END) as reorder_23,
					SUM(CASE WHEN ((status_id < 3) AND (status = 'remanja') AND (DAY(tgl_update) = 24)) THEN 1 ELSE 0 END) as reorder_24,
					SUM(CASE WHEN ((status_id < 3) AND (status = 'remanja') AND (DAY(tgl_update) = 25)) THEN 1 ELSE 0 END) as reorder_25,
					SUM(CASE WHEN ((status_id < 3) AND (status = 'remanja') AND (DAY(tgl_update) = 26)) THEN 1 ELSE 0 END) as reorder_26,
					SUM(CASE WHEN ((status_id < 3) AND (status = 'remanja') AND (DAY(tgl_update) = 27)) THEN 1 ELSE 0 END) as reorder_27,
					SUM(CASE WHEN ((status_id < 3) AND (status = 'remanja') AND (DAY(tgl_update) = 28)) THEN 1 ELSE 0 END) as reorder_28,
					SUM(CASE WHEN ((status_id < 3) AND (status = 'remanja') AND (DAY(tgl_update) = 29)) THEN 1 ELSE 0 END) as reorder_29,
					SUM(CASE WHEN ((status_id < 3) AND (status = 'remanja') AND (DAY(tgl_update) = 30)) THEN 1 ELSE 0 END) as reorder_30,
					SUM(CASE WHEN ((status_id < 3) AND (status = 'remanja') AND (DAY(tgl_update) = 31)) THEN 1 ELSE 0 END) as reorder_31,
					SUM(CASE WHEN ((status_id < 3) AND (status = 'remanja')) THEN 1 ELSE 0 END) as total_reorder
				");
				break;

			case 'reqsc':
				$this->db->select("
					/*REQ SC*/
					SUM(CASE WHEN ((status_id=3 OR status_id=5 OR status_id=7 OR status_id=71 OR status_id=8 OR status_id=9 OR status_id=12 OR status_id=31 OR status_id=32 OR status_id=33) AND (DAY(tgl_req_sc) = 01)) THEN 1 ELSE 0 END) as reqsc_1,
					SUM(CASE WHEN ((status_id=3 OR status_id=5 OR status_id=7 OR status_id=71 OR status_id=8 OR status_id=9 OR status_id=12 OR status_id=31 OR status_id=32 OR status_id=33) AND (DAY(tgl_req_sc) = 02)) THEN 1 ELSE 0 END) as reqsc_2,
					SUM(CASE WHEN ((status_id=3 OR status_id=5 OR status_id=7 OR status_id=71 OR status_id=8 OR status_id=9 OR status_id=12 OR status_id=31 OR status_id=32 OR status_id=33) AND (DAY(tgl_req_sc) = 03)) THEN 1 ELSE 0 END) as reqsc_3,
					SUM(CASE WHEN ((status_id=3 OR status_id=5 OR status_id=7 OR status_id=71 OR status_id=8 OR status_id=9 OR status_id=12 OR status_id=31 OR status_id=32 OR status_id=33) AND (DAY(tgl_req_sc) = 04)) THEN 1 ELSE 0 END) as reqsc_4,
					SUM(CASE WHEN ((status_id=3 OR status_id=5 OR status_id=7 OR status_id=71 OR status_id=8 OR status_id=9 OR status_id=12 OR status_id=31 OR status_id=32 OR status_id=33) AND (DAY(tgl_req_sc) = 05)) THEN 1 ELSE 0 END) as reqsc_5,
					SUM(CASE WHEN ((status_id=3 OR status_id=5 OR status_id=7 OR status_id=71 OR status_id=8 OR status_id=9 OR status_id=12 OR status_id=31 OR status_id=32 OR status_id=33) AND (DAY(tgl_req_sc) = 06)) THEN 1 ELSE 0 END) as reqsc_6,
					SUM(CASE WHEN ((status_id=3 OR status_id=5 OR status_id=7 OR status_id=71 OR status_id=8 OR status_id=9 OR status_id=12 OR status_id=31 OR status_id=32 OR status_id=33) AND (DAY(tgl_req_sc) = 07)) THEN 1 ELSE 0 END) as reqsc_7,
					SUM(CASE WHEN ((status_id=3 OR status_id=5 OR status_id=7 OR status_id=71 OR status_id=8 OR status_id=9 OR status_id=12 OR status_id=31 OR status_id=32 OR status_id=33) AND (DAY(tgl_req_sc) = 08)) THEN 1 ELSE 0 END) as reqsc_8,
					SUM(CASE WHEN ((status_id=3 OR status_id=5 OR status_id=7 OR status_id=71 OR status_id=8 OR status_id=9 OR status_id=12 OR status_id=31 OR status_id=32 OR status_id=33) AND (DAY(tgl_req_sc) = 09)) THEN 1 ELSE 0 END) as reqsc_9,
					SUM(CASE WHEN ((status_id=3 OR status_id=5 OR status_id=7 OR status_id=71 OR status_id=8 OR status_id=9 OR status_id=12 OR status_id=31 OR status_id=32 OR status_id=33) AND (DAY(tgl_req_sc) = 10)) THEN 1 ELSE 0 END) as reqsc_10,
					SUM(CASE WHEN ((status_id=3 OR status_id=5 OR status_id=7 OR status_id=71 OR status_id=8 OR status_id=9 OR status_id=12 OR status_id=31 OR status_id=32 OR status_id=33) AND (DAY(tgl_req_sc) = 11)) THEN 1 ELSE 0 END) as reqsc_11,
					SUM(CASE WHEN ((status_id=3 OR status_id=5 OR status_id=7 OR status_id=71 OR status_id=8 OR status_id=9 OR status_id=12 OR status_id=31 OR status_id=32 OR status_id=33) AND (DAY(tgl_req_sc) = 12)) THEN 1 ELSE 0 END) as reqsc_12,
					SUM(CASE WHEN ((status_id=3 OR status_id=5 OR status_id=7 OR status_id=71 OR status_id=8 OR status_id=9 OR status_id=12 OR status_id=31 OR status_id=32 OR status_id=33) AND (DAY(tgl_req_sc) = 13)) THEN 1 ELSE 0 END) as reqsc_13,
					SUM(CASE WHEN ((status_id=3 OR status_id=5 OR status_id=7 OR status_id=71 OR status_id=8 OR status_id=9 OR status_id=12 OR status_id=31 OR status_id=32 OR status_id=33) AND (DAY(tgl_req_sc) = 14)) THEN 1 ELSE 0 END) as reqsc_14,
					SUM(CASE WHEN ((status_id=3 OR status_id=5 OR status_id=7 OR status_id=71 OR status_id=8 OR status_id=9 OR status_id=12 OR status_id=31 OR status_id=32 OR status_id=33) AND (DAY(tgl_req_sc) = 15)) THEN 1 ELSE 0 END) as reqsc_15,
					SUM(CASE WHEN ((status_id=3 OR status_id=5 OR status_id=7 OR status_id=71 OR status_id=8 OR status_id=9 OR status_id=12 OR status_id=31 OR status_id=32 OR status_id=33) AND (DAY(tgl_req_sc) = 16)) THEN 1 ELSE 0 END) as reqsc_16,
					SUM(CASE WHEN ((status_id=3 OR status_id=5 OR status_id=7 OR status_id=71 OR status_id=8 OR status_id=9 OR status_id=12 OR status_id=31 OR status_id=32 OR status_id=33) AND (DAY(tgl_req_sc) = 17)) THEN 1 ELSE 0 END) as reqsc_17,
					SUM(CASE WHEN ((status_id=3 OR status_id=5 OR status_id=7 OR status_id=71 OR status_id=8 OR status_id=9 OR status_id=12 OR status_id=31 OR status_id=32 OR status_id=33) AND (DAY(tgl_req_sc) = 18)) THEN 1 ELSE 0 END) as reqsc_18,
					SUM(CASE WHEN ((status_id=3 OR status_id=5 OR status_id=7 OR status_id=71 OR status_id=8 OR status_id=9 OR status_id=12 OR status_id=31 OR status_id=32 OR status_id=33) AND (DAY(tgl_req_sc) = 19)) THEN 1 ELSE 0 END) as reqsc_19,
					SUM(CASE WHEN ((status_id=3 OR status_id=5 OR status_id=7 OR status_id=71 OR status_id=8 OR status_id=9 OR status_id=12 OR status_id=31 OR status_id=32 OR status_id=33) AND (DAY(tgl_req_sc) = 20)) THEN 1 ELSE 0 END) as reqsc_20,
					SUM(CASE WHEN ((status_id=3 OR status_id=5 OR status_id=7 OR status_id=71 OR status_id=8 OR status_id=9 OR status_id=12 OR status_id=31 OR status_id=32 OR status_id=33) AND (DAY(tgl_req_sc) = 21)) THEN 1 ELSE 0 END) as reqsc_21,
					SUM(CASE WHEN ((status_id=3 OR status_id=5 OR status_id=7 OR status_id=71 OR status_id=8 OR status_id=9 OR status_id=12 OR status_id=31 OR status_id=32 OR status_id=33) AND (DAY(tgl_req_sc) = 22)) THEN 1 ELSE 0 END) as reqsc_22,
					SUM(CASE WHEN ((status_id=3 OR status_id=5 OR status_id=7 OR status_id=71 OR status_id=8 OR status_id=9 OR status_id=12 OR status_id=31 OR status_id=32 OR status_id=33) AND (DAY(tgl_req_sc) = 23)) THEN 1 ELSE 0 END) as reqsc_23,
					SUM(CASE WHEN ((status_id=3 OR status_id=5 OR status_id=7 OR status_id=71 OR status_id=8 OR status_id=9 OR status_id=12 OR status_id=31 OR status_id=32 OR status_id=33) AND (DAY(tgl_req_sc) = 24)) THEN 1 ELSE 0 END) as reqsc_24,
					SUM(CASE WHEN ((status_id=3 OR status_id=5 OR status_id=7 OR status_id=71 OR status_id=8 OR status_id=9 OR status_id=12 OR status_id=31 OR status_id=32 OR status_id=33) AND (DAY(tgl_req_sc) = 25)) THEN 1 ELSE 0 END) as reqsc_25,
					SUM(CASE WHEN ((status_id=3 OR status_id=5 OR status_id=7 OR status_id=71 OR status_id=8 OR status_id=9 OR status_id=12 OR status_id=31 OR status_id=32 OR status_id=33) AND (DAY(tgl_req_sc) = 26)) THEN 1 ELSE 0 END) as reqsc_26,
					SUM(CASE WHEN ((status_id=3 OR status_id=5 OR status_id=7 OR status_id=71 OR status_id=8 OR status_id=9 OR status_id=12 OR status_id=31 OR status_id=32 OR status_id=33) AND (DAY(tgl_req_sc) = 27)) THEN 1 ELSE 0 END) as reqsc_27,
					SUM(CASE WHEN ((status_id=3 OR status_id=5 OR status_id=7 OR status_id=71 OR status_id=8 OR status_id=9 OR status_id=12 OR status_id=31 OR status_id=32 OR status_id=33) AND (DAY(tgl_req_sc) = 28)) THEN 1 ELSE 0 END) as reqsc_28,
					SUM(CASE WHEN ((status_id=3 OR status_id=5 OR status_id=7 OR status_id=71 OR status_id=8 OR status_id=9 OR status_id=12 OR status_id=31 OR status_id=32 OR status_id=33) AND (DAY(tgl_req_sc) = 29)) THEN 1 ELSE 0 END) as reqsc_29,
					SUM(CASE WHEN ((status_id=3 OR status_id=5 OR status_id=7 OR status_id=71 OR status_id=8 OR status_id=9 OR status_id=12 OR status_id=31 OR status_id=32 OR status_id=33) AND (DAY(tgl_req_sc) = 30)) THEN 1 ELSE 0 END) as reqsc_30,
					SUM(CASE WHEN ((status_id=3 OR status_id=5 OR status_id=7 OR status_id=71 OR status_id=8 OR status_id=9 OR status_id=12 OR status_id=31 OR status_id=32 OR status_id=33) AND (DAY(tgl_req_sc) = 31)) THEN 1 ELSE 0 END) as reqsc_31,
					SUM(CASE WHEN (status_id=3 OR status_id=5 OR status_id=7 OR status_id=71 OR status_id=8 OR status_id=9 OR status_id=12 OR status_id=31 OR status_id=32 OR status_id=33) THEN 1 ELSE 0 END) as total_reqsc
				");
				break;

			case 'kendala':
				$this->db->select("
					/*KENDALA*/
					SUM(CASE WHEN ((status_id = 6 OR status_id = 13) AND (status = 'KENDALA PELANGGAN' OR status = 'KENDALA JARINGAN' OR status = 'DEPLOY' OR status = 'KENDALA GOLIVE' OR status = 'APPROVAL AMO' OR status = 'APPROVAL DATEL' OR status = 'PROSES GOLIVE' OR status = 'REDESAIN') AND (DAY(tgl_lapor_k) = 01)) THEN 1 ELSE 0 END) as kendala_1,
					SUM(CASE WHEN ((status_id = 6 OR status_id = 13) AND (status = 'KENDALA PELANGGAN' OR status = 'KENDALA JARINGAN' OR status = 'DEPLOY' OR status = 'KENDALA GOLIVE' OR status = 'APPROVAL AMO' OR status = 'APPROVAL DATEL' OR status = 'PROSES GOLIVE' OR status = 'REDESAIN') AND (DAY(tgl_lapor_k) = 02)) THEN 1 ELSE 0 END) as kendala_2,
					SUM(CASE WHEN ((status_id = 6 OR status_id = 13) AND (status = 'KENDALA PELANGGAN' OR status = 'KENDALA JARINGAN' OR status = 'DEPLOY' OR status = 'KENDALA GOLIVE' OR status = 'APPROVAL AMO' OR status = 'APPROVAL DATEL' OR status = 'PROSES GOLIVE' OR status = 'REDESAIN') AND (DAY(tgl_lapor_k) = 03)) THEN 1 ELSE 0 END) as kendala_3,
					SUM(CASE WHEN ((status_id = 6 OR status_id = 13) AND (status = 'KENDALA PELANGGAN' OR status = 'KENDALA JARINGAN' OR status = 'DEPLOY' OR status = 'KENDALA GOLIVE' OR status = 'APPROVAL AMO' OR status = 'APPROVAL DATEL' OR status = 'PROSES GOLIVE' OR status = 'REDESAIN') AND (DAY(tgl_lapor_k) = 04)) THEN 1 ELSE 0 END) as kendala_4,
					SUM(CASE WHEN ((status_id = 6 OR status_id = 13) AND (status = 'KENDALA PELANGGAN' OR status = 'KENDALA JARINGAN' OR status = 'DEPLOY' OR status = 'KENDALA GOLIVE' OR status = 'APPROVAL AMO' OR status = 'APPROVAL DATEL' OR status = 'PROSES GOLIVE' OR status = 'REDESAIN') AND (DAY(tgl_lapor_k) = 05)) THEN 1 ELSE 0 END) as kendala_5,
					SUM(CASE WHEN ((status_id = 6 OR status_id = 13) AND (status = 'KENDALA PELANGGAN' OR status = 'KENDALA JARINGAN' OR status = 'DEPLOY' OR status = 'KENDALA GOLIVE' OR status = 'APPROVAL AMO' OR status = 'APPROVAL DATEL' OR status = 'PROSES GOLIVE' OR status = 'REDESAIN') AND (DAY(tgl_lapor_k) = 06)) THEN 1 ELSE 0 END) as kendala_6,
					SUM(CASE WHEN ((status_id = 6 OR status_id = 13) AND (status = 'KENDALA PELANGGAN' OR status = 'KENDALA JARINGAN' OR status = 'DEPLOY' OR status = 'KENDALA GOLIVE' OR status = 'APPROVAL AMO' OR status = 'APPROVAL DATEL' OR status = 'PROSES GOLIVE' OR status = 'REDESAIN') AND (DAY(tgl_lapor_k) = 07)) THEN 1 ELSE 0 END) as kendala_7,
					SUM(CASE WHEN ((status_id = 6 OR status_id = 13) AND (status = 'KENDALA PELANGGAN' OR status = 'KENDALA JARINGAN' OR status = 'DEPLOY' OR status = 'KENDALA GOLIVE' OR status = 'APPROVAL AMO' OR status = 'APPROVAL DATEL' OR status = 'PROSES GOLIVE' OR status = 'REDESAIN') AND (DAY(tgl_lapor_k) = 08)) THEN 1 ELSE 0 END) as kendala_8,
					SUM(CASE WHEN ((status_id = 6 OR status_id = 13) AND (status = 'KENDALA PELANGGAN' OR status = 'KENDALA JARINGAN' OR status = 'DEPLOY' OR status = 'KENDALA GOLIVE' OR status = 'APPROVAL AMO' OR status = 'APPROVAL DATEL' OR status = 'PROSES GOLIVE' OR status = 'REDESAIN') AND (DAY(tgl_lapor_k) = 09)) THEN 1 ELSE 0 END) as kendala_9,
					SUM(CASE WHEN ((status_id = 6 OR status_id = 13) AND (status = 'KENDALA PELANGGAN' OR status = 'KENDALA JARINGAN' OR status = 'DEPLOY' OR status = 'KENDALA GOLIVE' OR status = 'APPROVAL AMO' OR status = 'APPROVAL DATEL' OR status = 'PROSES GOLIVE' OR status = 'REDESAIN') AND (DAY(tgl_lapor_k) = 10)) THEN 1 ELSE 0 END) as kendala_10,
					SUM(CASE WHEN ((status_id = 6 OR status_id = 13) AND (status = 'KENDALA PELANGGAN' OR status = 'KENDALA JARINGAN' OR status = 'DEPLOY' OR status = 'KENDALA GOLIVE' OR status = 'APPROVAL AMO' OR status = 'APPROVAL DATEL' OR status = 'PROSES GOLIVE' OR status = 'REDESAIN') AND (DAY(tgl_lapor_k) = 11)) THEN 1 ELSE 0 END) as kendala_11,
					SUM(CASE WHEN ((status_id = 6 OR status_id = 13) AND (status = 'KENDALA PELANGGAN' OR status = 'KENDALA JARINGAN' OR status = 'DEPLOY' OR status = 'KENDALA GOLIVE' OR status = 'APPROVAL AMO' OR status = 'APPROVAL DATEL' OR status = 'PROSES GOLIVE' OR status = 'REDESAIN') AND (DAY(tgl_lapor_k) = 12)) THEN 1 ELSE 0 END) as kendala_12,
					SUM(CASE WHEN ((status_id = 6 OR status_id = 13) AND (status = 'KENDALA PELANGGAN' OR status = 'KENDALA JARINGAN' OR status = 'DEPLOY' OR status = 'KENDALA GOLIVE' OR status = 'APPROVAL AMO' OR status = 'APPROVAL DATEL' OR status = 'PROSES GOLIVE' OR status = 'REDESAIN') AND (DAY(tgl_lapor_k) = 13)) THEN 1 ELSE 0 END) as kendala_13,
					SUM(CASE WHEN ((status_id = 6 OR status_id = 13) AND (status = 'KENDALA PELANGGAN' OR status = 'KENDALA JARINGAN' OR status = 'DEPLOY' OR status = 'KENDALA GOLIVE' OR status = 'APPROVAL AMO' OR status = 'APPROVAL DATEL' OR status = 'PROSES GOLIVE' OR status = 'REDESAIN') AND (DAY(tgl_lapor_k) = 14)) THEN 1 ELSE 0 END) as kendala_14,
					SUM(CASE WHEN ((status_id = 6 OR status_id = 13) AND (status = 'KENDALA PELANGGAN' OR status = 'KENDALA JARINGAN' OR status = 'DEPLOY' OR status = 'KENDALA GOLIVE' OR status = 'APPROVAL AMO' OR status = 'APPROVAL DATEL' OR status = 'PROSES GOLIVE' OR status = 'REDESAIN') AND (DAY(tgl_lapor_k) = 15)) THEN 1 ELSE 0 END) as kendala_15,
					SUM(CASE WHEN ((status_id = 6 OR status_id = 13) AND (status = 'KENDALA PELANGGAN' OR status = 'KENDALA JARINGAN' OR status = 'DEPLOY' OR status = 'KENDALA GOLIVE' OR status = 'APPROVAL AMO' OR status = 'APPROVAL DATEL' OR status = 'PROSES GOLIVE' OR status = 'REDESAIN') AND (DAY(tgl_lapor_k) = 16)) THEN 1 ELSE 0 END) as kendala_16,
					SUM(CASE WHEN ((status_id = 6 OR status_id = 13) AND (status = 'KENDALA PELANGGAN' OR status = 'KENDALA JARINGAN' OR status = 'DEPLOY' OR status = 'KENDALA GOLIVE' OR status = 'APPROVAL AMO' OR status = 'APPROVAL DATEL' OR status = 'PROSES GOLIVE' OR status = 'REDESAIN') AND (DAY(tgl_lapor_k) = 17)) THEN 1 ELSE 0 END) as kendala_17,
					SUM(CASE WHEN ((status_id = 6 OR status_id = 13) AND (status = 'KENDALA PELANGGAN' OR status = 'KENDALA JARINGAN' OR status = 'DEPLOY' OR status = 'KENDALA GOLIVE' OR status = 'APPROVAL AMO' OR status = 'APPROVAL DATEL' OR status = 'PROSES GOLIVE' OR status = 'REDESAIN') AND (DAY(tgl_lapor_k) = 18)) THEN 1 ELSE 0 END) as kendala_18,
					SUM(CASE WHEN ((status_id = 6 OR status_id = 13) AND (status = 'KENDALA PELANGGAN' OR status = 'KENDALA JARINGAN' OR status = 'DEPLOY' OR status = 'KENDALA GOLIVE' OR status = 'APPROVAL AMO' OR status = 'APPROVAL DATEL' OR status = 'PROSES GOLIVE' OR status = 'REDESAIN') AND (DAY(tgl_lapor_k) = 19)) THEN 1 ELSE 0 END) as kendala_19,
					SUM(CASE WHEN ((status_id = 6 OR status_id = 13) AND (status = 'KENDALA PELANGGAN' OR status = 'KENDALA JARINGAN' OR status = 'DEPLOY' OR status = 'KENDALA GOLIVE' OR status = 'APPROVAL AMO' OR status = 'APPROVAL DATEL' OR status = 'PROSES GOLIVE' OR status = 'REDESAIN') AND (DAY(tgl_lapor_k) = 20)) THEN 1 ELSE 0 END) as kendala_20,
					SUM(CASE WHEN ((status_id = 6 OR status_id = 13) AND (status = 'KENDALA PELANGGAN' OR status = 'KENDALA JARINGAN' OR status = 'DEPLOY' OR status = 'KENDALA GOLIVE' OR status = 'APPROVAL AMO' OR status = 'APPROVAL DATEL' OR status = 'PROSES GOLIVE' OR status = 'REDESAIN') AND (DAY(tgl_lapor_k) = 21)) THEN 1 ELSE 0 END) as kendala_21,
					SUM(CASE WHEN ((status_id = 6 OR status_id = 13) AND (status = 'KENDALA PELANGGAN' OR status = 'KENDALA JARINGAN' OR status = 'DEPLOY' OR status = 'KENDALA GOLIVE' OR status = 'APPROVAL AMO' OR status = 'APPROVAL DATEL' OR status = 'PROSES GOLIVE' OR status = 'REDESAIN') AND (DAY(tgl_lapor_k) = 22)) THEN 1 ELSE 0 END) as kendala_22,
					SUM(CASE WHEN ((status_id = 6 OR status_id = 13) AND (status = 'KENDALA PELANGGAN' OR status = 'KENDALA JARINGAN' OR status = 'DEPLOY' OR status = 'KENDALA GOLIVE' OR status = 'APPROVAL AMO' OR status = 'APPROVAL DATEL' OR status = 'PROSES GOLIVE' OR status = 'REDESAIN') AND (DAY(tgl_lapor_k) = 23)) THEN 1 ELSE 0 END) as kendala_23,
					SUM(CASE WHEN ((status_id = 6 OR status_id = 13) AND (status = 'KENDALA PELANGGAN' OR status = 'KENDALA JARINGAN' OR status = 'DEPLOY' OR status = 'KENDALA GOLIVE' OR status = 'APPROVAL AMO' OR status = 'APPROVAL DATEL' OR status = 'PROSES GOLIVE' OR status = 'REDESAIN') AND (DAY(tgl_lapor_k) = 24)) THEN 1 ELSE 0 END) as kendala_24,
					SUM(CASE WHEN ((status_id = 6 OR status_id = 13) AND (status = 'KENDALA PELANGGAN' OR status = 'KENDALA JARINGAN' OR status = 'DEPLOY' OR status = 'KENDALA GOLIVE' OR status = 'APPROVAL AMO' OR status = 'APPROVAL DATEL' OR status = 'PROSES GOLIVE' OR status = 'REDESAIN') AND (DAY(tgl_lapor_k) = 25)) THEN 1 ELSE 0 END) as kendala_25,
					SUM(CASE WHEN ((status_id = 6 OR status_id = 13) AND (status = 'KENDALA PELANGGAN' OR status = 'KENDALA JARINGAN' OR status = 'DEPLOY' OR status = 'KENDALA GOLIVE' OR status = 'APPROVAL AMO' OR status = 'APPROVAL DATEL' OR status = 'PROSES GOLIVE' OR status = 'REDESAIN') AND (DAY(tgl_lapor_k) = 26)) THEN 1 ELSE 0 END) as kendala_26,
					SUM(CASE WHEN ((status_id = 6 OR status_id = 13) AND (status = 'KENDALA PELANGGAN' OR status = 'KENDALA JARINGAN' OR status = 'DEPLOY' OR status = 'KENDALA GOLIVE' OR status = 'APPROVAL AMO' OR status = 'APPROVAL DATEL' OR status = 'PROSES GOLIVE' OR status = 'REDESAIN') AND (DAY(tgl_lapor_k) = 27)) THEN 1 ELSE 0 END) as kendala_27,
					SUM(CASE WHEN ((status_id = 6 OR status_id = 13) AND (status = 'KENDALA PELANGGAN' OR status = 'KENDALA JARINGAN' OR status = 'DEPLOY' OR status = 'KENDALA GOLIVE' OR status = 'APPROVAL AMO' OR status = 'APPROVAL DATEL' OR status = 'PROSES GOLIVE' OR status = 'REDESAIN') AND (DAY(tgl_lapor_k) = 28)) THEN 1 ELSE 0 END) as kendala_28,
					SUM(CASE WHEN ((status_id = 6 OR status_id = 13) AND (status = 'KENDALA PELANGGAN' OR status = 'KENDALA JARINGAN' OR status = 'DEPLOY' OR status = 'KENDALA GOLIVE' OR status = 'APPROVAL AMO' OR status = 'APPROVAL DATEL' OR status = 'PROSES GOLIVE' OR status = 'REDESAIN') AND (DAY(tgl_lapor_k) = 29)) THEN 1 ELSE 0 END) as kendala_29,
					SUM(CASE WHEN ((status_id = 6 OR status_id = 13) AND (status = 'KENDALA PELANGGAN' OR status = 'KENDALA JARINGAN' OR status = 'DEPLOY' OR status = 'KENDALA GOLIVE' OR status = 'APPROVAL AMO' OR status = 'APPROVAL DATEL' OR status = 'PROSES GOLIVE' OR status = 'REDESAIN') AND (DAY(tgl_lapor_k) = 30)) THEN 1 ELSE 0 END) as kendala_30,
					SUM(CASE WHEN ((status_id = 6 OR status_id = 13) AND (status = 'KENDALA PELANGGAN' OR status = 'KENDALA JARINGAN' OR status = 'DEPLOY' OR status = 'KENDALA GOLIVE' OR status = 'APPROVAL AMO' OR status = 'APPROVAL DATEL' OR status = 'PROSES GOLIVE' OR status = 'REDESAIN') AND (DAY(tgl_lapor_k) = 31)) THEN 1 ELSE 0 END) as kendala_31,
					SUM(CASE WHEN ((status_id = 6 OR status_id = 13) AND (status = 'KENDALA PELANGGAN' OR status = 'KENDALA JARINGAN' OR status = 'DEPLOY' OR status = 'KENDALA GOLIVE' OR status = 'APPROVAL AMO' OR status = 'APPROVAL DATEL' OR status = 'PROSES GOLIVE' OR status = 'REDESAIN')) THEN 1 ELSE 0 END) as total_kendala
				");
				break;

			case 'ps':
				$this->db->select("
					/*PS*/
					SUM(CASE WHEN (status_id = 10 AND (DAY(tgl_update) = 01)) THEN 1 ELSE 0 END) as ps_1,
					SUM(CASE WHEN (status_id = 10 AND (DAY(tgl_update) = 02)) THEN 1 ELSE 0 END) as ps_2,
					SUM(CASE WHEN (status_id = 10 AND (DAY(tgl_update) = 03)) THEN 1 ELSE 0 END) as ps_3,
					SUM(CASE WHEN (status_id = 10 AND (DAY(tgl_update) = 04)) THEN 1 ELSE 0 END) as ps_4,
					SUM(CASE WHEN (status_id = 10 AND (DAY(tgl_update) = 05)) THEN 1 ELSE 0 END) as ps_5,
					SUM(CASE WHEN (status_id = 10 AND (DAY(tgl_update) = 06)) THEN 1 ELSE 0 END) as ps_6,
					SUM(CASE WHEN (status_id = 10 AND (DAY(tgl_update) = 07)) THEN 1 ELSE 0 END) as ps_7,
					SUM(CASE WHEN (status_id = 10 AND (DAY(tgl_update) = 08)) THEN 1 ELSE 0 END) as ps_8,
					SUM(CASE WHEN (status_id = 10 AND (DAY(tgl_update) = 09)) THEN 1 ELSE 0 END) as ps_9,
					SUM(CASE WHEN (status_id = 10 AND (DAY(tgl_update) = 10)) THEN 1 ELSE 0 END) as ps_10,
					SUM(CASE WHEN (status_id = 10 AND (DAY(tgl_update) = 11)) THEN 1 ELSE 0 END) as ps_11,
					SUM(CASE WHEN (status_id = 10 AND (DAY(tgl_update) = 12)) THEN 1 ELSE 0 END) as ps_12,
					SUM(CASE WHEN (status_id = 10 AND (DAY(tgl_update) = 13)) THEN 1 ELSE 0 END) as ps_13,
					SUM(CASE WHEN (status_id = 10 AND (DAY(tgl_update) = 14)) THEN 1 ELSE 0 END) as ps_14,
					SUM(CASE WHEN (status_id = 10 AND (DAY(tgl_update) = 15)) THEN 1 ELSE 0 END) as ps_15,
					SUM(CASE WHEN (status_id = 10 AND (DAY(tgl_update) = 16)) THEN 1 ELSE 0 END) as ps_16,
					SUM(CASE WHEN (status_id = 10 AND (DAY(tgl_update) = 17)) THEN 1 ELSE 0 END) as ps_17,
					SUM(CASE WHEN (status_id = 10 AND (DAY(tgl_update) = 18)) THEN 1 ELSE 0 END) as ps_18,
					SUM(CASE WHEN (status_id = 10 AND (DAY(tgl_update) = 19)) THEN 1 ELSE 0 END) as ps_19,
					SUM(CASE WHEN (status_id = 10 AND (DAY(tgl_update) = 20)) THEN 1 ELSE 0 END) as ps_20,
					SUM(CASE WHEN (status_id = 10 AND (DAY(tgl_update) = 21)) THEN 1 ELSE 0 END) as ps_21,
					SUM(CASE WHEN (status_id = 10 AND (DAY(tgl_update) = 22)) THEN 1 ELSE 0 END) as ps_22,
					SUM(CASE WHEN (status_id = 10 AND (DAY(tgl_update) = 23)) THEN 1 ELSE 0 END) as ps_23,
					SUM(CASE WHEN (status_id = 10 AND (DAY(tgl_update) = 24)) THEN 1 ELSE 0 END) as ps_24,
					SUM(CASE WHEN (status_id = 10 AND (DAY(tgl_update) = 25)) THEN 1 ELSE 0 END) as ps_25,
					SUM(CASE WHEN (status_id = 10 AND (DAY(tgl_update) = 26)) THEN 1 ELSE 0 END) as ps_26,
					SUM(CASE WHEN (status_id = 10 AND (DAY(tgl_update) = 27)) THEN 1 ELSE 0 END) as ps_27,
					SUM(CASE WHEN (status_id = 10 AND (DAY(tgl_update) = 28)) THEN 1 ELSE 0 END) as ps_28,
					SUM(CASE WHEN (status_id = 10 AND (DAY(tgl_update) = 29)) THEN 1 ELSE 0 END) as ps_29,
					SUM(CASE WHEN (status_id = 10 AND (DAY(tgl_update) = 30)) THEN 1 ELSE 0 END) as ps_30,
					SUM(CASE WHEN (status_id = 10 AND (DAY(tgl_update) = 31)) THEN 1 ELSE 0 END) as ps_31,
					SUM(CASE WHEN (status_id = 10) THEN 1 ELSE 0 END) as total_ps
				");
				break;

			default:
				# code...
				break;
		}

		$this->db->from('tb_sales');
		$this->db->where('segment', 0);

		// WHERE
		switch ($kategori) {
			case 'scbe':
				// filter bulan
				$this->db->where('MONTH(tgl_done_fcc)', $b);

				// filter tahun
				$this->db->where('YEAR(tgl_done_fcc)', $t);
				break;

			case 'reorder':
				// filter bulan
				$this->db->where('MONTH(tgl_update)', $b);

				// filter tahun
				$this->db->where('YEAR(tgl_update)', $t);
				break;

			case 'reqsc':
				// filter bulan
				$this->db->where('MONTH(tgl_req_sc)', $b);

				// filter tahun
				$this->db->where('YEAR(tgl_req_sc)', $t);
				break;

			case 'kendala':
				// filter bulan
				$this->db->where('MONTH(tgl_lapor_k)', $b);

				// filter tahun
				$this->db->where('YEAR(tgl_lapor_k)', $t);
				break;

			case 'ps':
				// filter bulan
				$this->db->where('MONTH(tgl_update)', $b);

				// filter tahun
				$this->db->where('YEAR(tgl_update)', $t);
				break;

			default:
				# code...
				break;
		}

		// datel segmentation
		if ($datel != 'all') {
			$this->db->where('datel', $datel);
		}

		$query = $this->db->get();
		return $query;
	}
}

/* End of file Dashboard_model.php */
/* Location: ./application/models/Dashboard_model.php */