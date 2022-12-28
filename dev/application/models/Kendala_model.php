<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Kendala_model extends CI_Model
{



	public function resume($segment, $unit, $by_tgl, $start, $end)

	{

		$this->db->select("

				s.datel as datel,

				SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA PELANGGAN' AND kendala = 'RNA') THEN 1 ELSE 0 END) as rna,

				SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA PELANGGAN' AND kendala = 'ALAMAT') THEN 1 ELSE 0 END) as alamat,

				SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA PELANGGAN' AND kendala = 'PENDING') THEN 1 ELSE 0 END) as pending,

				SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA PELANGGAN' AND kendala = 'NJKI') THEN 1 ELSE 0 END) as njki,

				SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA PELANGGAN' AND kendala = 'BATAL') THEN 1 ELSE 0 END) as batal,

				SUM(CASE WHEN (status_id = 6 AND s.`status` = 'TERMINATE' AND kendala = 'TERMINATE') THEN 1 ELSE 0 END) as terminate,

				SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA JARINGAN' AND kendala = 'PENDING INSTALASI') THEN 1 ELSE 0 END) as pending_instalasi,

				SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA JARINGAN' AND kendala = 'ODP FULL') THEN 1 ELSE 0 END) as odp_full,

				SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA JARINGAN' AND kendala = 'ODP LOSS') THEN 1 ELSE 0 END) as odp_loss,

				SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA JARINGAN' AND kendala = 'ODP RETI') THEN 1 ELSE 0 END) as odp_reti,

				SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA JARINGAN' AND kendala = 'ODP BLM LIVE') THEN 1 ELSE 0 END) as odp_blm_live,

				SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA JARINGAN' AND kendala = 'TIANG') THEN 1 ELSE 0 END) as tiang,

				SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA JARINGAN' AND kendala = 'PT2') THEN 1 ELSE 0 END) as pt_dua,

				SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA JARINGAN' AND kendala = 'NO FO/ODP') THEN 1 ELSE 0 END) as no_fo,

				SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA JARINGAN' AND kendala = 'RUTE INSTALASI') THEN 1 ELSE 0 END) as rute,

				SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA PELANGGAN' AND kendala = 'IJIN TANAM TIANG') THEN 1 ELSE 0 END) as ijin_tanam_tiang,

				SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA JARINGAN' AND kendala = 'ONU > 32') THEN 1 ELSE 0 END) as onu_32,

				SUM(CASE WHEN ((status_id = 6 AND s.status <> 'TERMINATE' AND kendala <> '') OR (s.status_id = 13 AND (s.status = 'REDESAIN' OR s.status = 'APPROVAL DATEL' OR s.status = 'APPROVAL AMO' OR s.status = 'DEPLOY' OR s.status = 'PROSES GOLIVE' OR s.status = 'KENDALA GOLIVE'))) THEN 1 ELSE 0 END) as subtotal,

				SUM(CASE WHEN (status_id = 6 AND s.status = 'KENDALA PELANGGAN' AND (kendala = 'RNA' OR kendala = 'BATAL' OR kendala = 'ALAMAT' OR kendala = 'PENDING' OR kendala = 'NJKI' OR kendala = 'IJIN TANAM TIANG')) THEN 1 ELSE 0 END) as all_kp,

				SUM(CASE WHEN (status_id = 6 AND s.status = 'KENDALA JARINGAN' AND (kendala = 'TIANG' OR kendala = 'RUTE INSTALASI' OR kendala = 'PENDING INSTALASI')) THEN 1 ELSE 0 END) as all_ki,

				SUM(CASE WHEN (status_id = 6 AND s.status = 'KENDALA JARINGAN' AND (kendala = 'ODP LOSS' OR kendala = 'ODP RETI' OR kendala = 'ONU > 32')) THEN 1 ELSE 0 END) as all_m,

				SUM(CASE WHEN (s.status = 'KENDALA JARINGAN' AND (kendala = 'ODP FULL' OR kendala = 'PT2' OR kendala = 'NO FO/ODP' OR kendala = 'ODP BLM LIVE')) THEN 1 ELSE 0 END) as all_t,

				SUM(CASE WHEN (s.status_id = 13 AND s.`status` = 'NEXT PROJECT') THEN 1 ELSE 0 END) as next_project,

				SUM(CASE WHEN (s.status_id = 13 AND (s.status = 'REDESAIN' OR s.status = 'APPROVAL DATEL' OR s.status = 'APPROVAL AMO' OR s.status = 'DEPLOY' OR s.status = 'PROSES GOLIVE' OR s.status = 'KENDALA GOLIVE')) THEN 1 ELSE 0 END) as on_cons

            ");

		$this->db->from('tb_sales as s');
		$this->db->where('datel !=', 'PKL');



		if ($start != null && $end != null) {

			if ($by_tgl == 'tgl_ja') {

				$this->db->where('DATE(tgl_post) >=', $start);

				$this->db->where('DATE(tgl_post) <=', $end);
			} else {

				$this->db->where('DATE(tgl_lapor_k) >=', $start);

				$this->db->where('DATE(tgl_lapor_k) <=', $end);
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



	public function resume_total($segment, $unit, $by_tgl, $start, $end)

	{

		$this->db->select("

				s.datel as datel,

				SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA PELANGGAN' AND kendala = 'RNA') THEN 1 ELSE 0 END) as rna,

				SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA PELANGGAN' AND kendala = 'ALAMAT') THEN 1 ELSE 0 END) as alamat,

				SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA PELANGGAN' AND kendala = 'PENDING') THEN 1 ELSE 0 END) as pending,

				SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA PELANGGAN' AND kendala = 'NJKI') THEN 1 ELSE 0 END) as njki,

				SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA PELANGGAN' AND kendala = 'BATAL') THEN 1 ELSE 0 END) as batal,

				SUM(CASE WHEN (status_id = 6 AND s.`status` = 'TERMINATE' AND kendala = 'TERMINATE') THEN 1 ELSE 0 END) as terminate,

				SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA JARINGAN' AND kendala = 'PENDING INSTALASI') THEN 1 ELSE 0 END) as pending_instalasi,

				SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA JARINGAN' AND kendala = 'ODP FULL') THEN 1 ELSE 0 END) as odp_full,

				SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA JARINGAN' AND kendala = 'ODP LOSS') THEN 1 ELSE 0 END) as odp_loss,

				SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA JARINGAN' AND kendala = 'ODP RETI') THEN 1 ELSE 0 END) as odp_reti,

				SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA JARINGAN' AND kendala = 'ODP BLM LIVE') THEN 1 ELSE 0 END) as odp_blm_live,

				SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA JARINGAN' AND kendala = 'TIANG') THEN 1 ELSE 0 END) as tiang,

				SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA JARINGAN' AND kendala = 'PT2') THEN 1 ELSE 0 END) as pt_dua,

				SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA JARINGAN' AND kendala = 'NO FO/ODP') THEN 1 ELSE 0 END) as no_fo,

				SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA JARINGAN' AND kendala = 'RUTE INSTALASI') THEN 1 ELSE 0 END) as rute,

				SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA PELANGGAN' AND kendala = 'IJIN TANAM TIANG') THEN 1 ELSE 0 END) as ijin_tanam_tiang,

				SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA JARINGAN' AND kendala = 'ONU > 32') THEN 1 ELSE 0 END) as onu_32,

				SUM(CASE WHEN ((status_id = 6 AND s.status <> 'TERMINATE' AND kendala <> '') OR (s.status_id = 13 AND (s.status = 'REDESAIN' OR s.status = 'APPROVAL DATEL' OR s.status = 'APPROVAL AMO' OR s.status = 'DEPLOY' OR s.status = 'PROSES GOLIVE' OR s.status = 'KENDALA GOLIVE'))) THEN 1 ELSE 0 END) as subtotal,

				SUM(CASE WHEN (status_id = 6 AND s.status = 'KENDALA PELANGGAN' AND (kendala = 'RNA' OR kendala = 'BATAL' OR kendala = 'ALAMAT' OR kendala = 'PENDING' OR kendala = 'NJKI' OR kendala = 'IJIN TANAM TIANG')) THEN 1 ELSE 0 END) as all_kp,

				SUM(CASE WHEN (status_id = 6 AND s.status = 'KENDALA JARINGAN' AND (kendala = 'TIANG' OR kendala = 'RUTE INSTALASI' OR kendala = 'PENDING INSTALASI')) THEN 1 ELSE 0 END) as all_ki,

				SUM(CASE WHEN (status_id = 6 AND s.status = 'KENDALA JARINGAN' AND (kendala = 'ODP LOSS' OR kendala = 'ODP RETI' OR kendala = 'ONU > 32')) THEN 1 ELSE 0 END) as all_m,

				SUM(CASE WHEN (s.status = 'KENDALA JARINGAN' AND (kendala = 'ODP FULL' OR kendala = 'PT2' OR kendala = 'NO FO/ODP' OR kendala = 'ODP BLM LIVE')) THEN 1 ELSE 0 END) as all_t,

				SUM(CASE WHEN (s.status_id = 13 AND s.`status` = 'NEXT PROJECT') THEN 1 ELSE 0 END) as next_project,

				SUM(CASE WHEN (s.status_id = 13 AND (s.status = 'REDESAIN' OR s.status = 'APPROVAL DATEL' OR s.status = 'APPROVAL AMO' OR s.status = 'DEPLOY' OR s.status = 'PROSES GOLIVE' OR s.status = 'KENDALA GOLIVE')) THEN 1 ELSE 0 END) as on_cons

            ");

		$this->db->from('tb_sales as s');
		$this->db->where('datel !=', 'PKL');



		if ($start != null && $end != null) {

			if ($by_tgl == 'tgl_ja') {

				$this->db->where('DATE(tgl_post) >=', $start);

				$this->db->where('DATE(tgl_post) <=', $end);
			} else {

				$this->db->where('DATE(tgl_lapor_k) >=', $start);

				$this->db->where('DATE(tgl_lapor_k) <=', $end);
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



	public function resume_today()

	{

		$this->db->select("

				s.datel as datel,

				SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA PELANGGAN' AND kendala = 'RNA') THEN 1 ELSE 0 END) as rna,

				SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA PELANGGAN' AND kendala = 'ALAMAT') THEN 1 ELSE 0 END) as alamat,

				SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA PELANGGAN' AND kendala = 'PENDING') THEN 1 ELSE 0 END) as pending,

				SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA PELANGGAN' AND kendala = 'NJKI') THEN 1 ELSE 0 END) as njki,

				SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA PELANGGAN' AND kendala = 'BATAL') THEN 1 ELSE 0 END) as batal,

				SUM(CASE WHEN (status_id = 6 AND s.`status` = 'TERMINATE' AND kendala = 'TERMINATE') THEN 1 ELSE 0 END) as terminate,

				SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA JARINGAN' AND kendala = 'PENDING INSTALASI') THEN 1 ELSE 0 END) as pending_instalasi,

				SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA JARINGAN' AND kendala = 'ODP FULL') THEN 1 ELSE 0 END) as odp_full,

				SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA JARINGAN' AND kendala = 'ODP LOSS') THEN 1 ELSE 0 END) as odp_loss,

				SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA JARINGAN' AND kendala = 'ODP RETI') THEN 1 ELSE 0 END) as odp_reti,

				SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA JARINGAN' AND kendala = 'ODP BLM LIVE') THEN 1 ELSE 0 END) as odp_blm_live,

				SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA JARINGAN' AND kendala = 'TIANG') THEN 1 ELSE 0 END) as tiang,

				SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA JARINGAN' AND kendala = 'PT2') THEN 1 ELSE 0 END) as pt_dua,

				SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA JARINGAN' AND kendala = 'NO FO/ODP') THEN 1 ELSE 0 END) as no_fo,

				SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA JARINGAN' AND kendala = 'RUTE INSTALASI') THEN 1 ELSE 0 END) as rute,

				SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA PELANGGAN' AND kendala = 'IJIN TANAM TIANG') THEN 1 ELSE 0 END) as ijin_tanam_tiang,

				SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA JARINGAN' AND kendala = 'ONU > 32') THEN 1 ELSE 0 END) as onu_32,

				SUM(CASE WHEN ((status_id = 6 AND s.status <> 'TERMINATE') OR (s.status_id = 13 AND (s.status = 'REDESAIN' OR s.status = 'APPROVAL AMO' OR s.status = 'DEPLOY' OR s.status = 'PROSES GOLIVE' OR s.status = 'KENDALA GOLIVE'))) THEN 1 ELSE 0 END) as subtotal,

				SUM(CASE WHEN (status_id = 6 AND s.status = 'KENDALA PELANGGAN' AND (kendala = 'RNA' OR kendala = 'BATAL' OR kendala = 'ALAMAT' OR kendala = 'PENDING' OR kendala = 'NJKI' OR kendala = 'IJIN TANAM TIANG')) THEN 1 ELSE 0 END) as all_kp,

				SUM(CASE WHEN (status_id = 6 AND s.status = 'KENDALA JARINGAN' AND (kendala = 'TIANG' OR kendala = 'RUTE INSTALASI' OR kendala = 'PENDING INSTALASI')) THEN 1 ELSE 0 END) as all_ki,

				SUM(CASE WHEN (status_id = 6 AND s.status = 'KENDALA JARINGAN' AND (kendala = 'ODP LOSS' OR kendala = 'ODP RETI' OR kendala = 'ODP BLM LIVE' OR kendala = 'ONU > 32')) THEN 1 ELSE 0 END) as all_m,

				SUM(CASE WHEN (s.status = 'KENDALA JARINGAN' AND (kendala = 'ODP FULL' OR kendala = 'PT2' OR kendala = 'NO FO/ODP')) THEN 1 ELSE 0 END) as all_t,

				SUM(CASE WHEN (s.status_id = 13 AND s.`status` = 'NEXT PROJECT') THEN 1 ELSE 0 END) as next_project,

				SUM(CASE WHEN (s.status_id = 13 AND (s.status = 'REDESAIN' OR s.status = 'APPROVAL AMO' OR s.status = 'DEPLOY' OR s.status = 'PROSES GOLIVE' OR s.status = 'KENDALA GOLIVE')) THEN 1 ELSE 0 END) as on_cons

            ");

		$this->db->from('tb_sales as s');

		$this->db->where("(s.segment = 0 OR s.segment = 2 OR s.segment = 3) AND s.datel <> 'UNF'");

		$this->db->where('date(tgl_update)', date('Y-m-d'));

		$this->db->group_by('s.datel');

		$query = $this->db->get();

		return $query;
	}



	public function resume_total_today()

	{

		$this->db->select("

				s.datel as datel,

				SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA PELANGGAN' AND kendala = 'RNA') THEN 1 ELSE 0 END) as rna,

				SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA PELANGGAN' AND kendala = 'ALAMAT') THEN 1 ELSE 0 END) as alamat,

				SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA PELANGGAN' AND kendala = 'PENDING') THEN 1 ELSE 0 END) as pending,

				SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA PELANGGAN' AND kendala = 'NJKI') THEN 1 ELSE 0 END) as njki,

				SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA PELANGGAN' AND kendala = 'BATAL') THEN 1 ELSE 0 END) as batal,

				SUM(CASE WHEN (status_id = 6 AND s.`status` = 'TERMINATE' AND kendala = 'TERMINATE') THEN 1 ELSE 0 END) as terminate,

				SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA JARINGAN' AND kendala = 'PENDING INSTALASI') THEN 1 ELSE 0 END) as pending_instalasi,

				SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA JARINGAN' AND kendala = 'ODP FULL') THEN 1 ELSE 0 END) as odp_full,

				SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA JARINGAN' AND kendala = 'ODP LOSS') THEN 1 ELSE 0 END) as odp_loss,

				SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA JARINGAN' AND kendala = 'ODP RETI') THEN 1 ELSE 0 END) as odp_reti,

				SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA JARINGAN' AND kendala = 'ODP BLM LIVE') THEN 1 ELSE 0 END) as odp_blm_live,

				SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA JARINGAN' AND kendala = 'TIANG') THEN 1 ELSE 0 END) as tiang,

				SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA JARINGAN' AND kendala = 'PT2') THEN 1 ELSE 0 END) as pt_dua,

				SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA JARINGAN' AND kendala = 'NO FO/ODP') THEN 1 ELSE 0 END) as no_fo,

				SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA JARINGAN' AND kendala = 'RUTE INSTALASI') THEN 1 ELSE 0 END) as rute,

				SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA PELANGGAN' AND kendala = 'IJIN TANAM TIANG') THEN 1 ELSE 0 END) as ijin_tanam_tiang,

				SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA JARINGAN' AND kendala = 'ONU > 32') THEN 1 ELSE 0 END) as onu_32,

				SUM(CASE WHEN ((status_id = 6 AND s.status <> 'TERMINATE') OR (s.status_id = 13 AND (s.status = 'REDESAIN' OR s.status = 'APPROVAL AMO' OR s.status = 'DEPLOY' OR s.status = 'PROSES GOLIVE' OR s.status = 'KENDALA GOLIVE'))) THEN 1 ELSE 0 END) as subtotal,

				SUM(CASE WHEN (status_id = 6 AND s.status = 'KENDALA PELANGGAN' AND (kendala = 'RNA' OR kendala = 'BATAL' OR kendala = 'ALAMAT' OR kendala = 'PENDING' OR kendala = 'NJKI' OR kendala = 'IJIN TANAM TIANG')) THEN 1 ELSE 0 END) as all_kp,

				SUM(CASE WHEN (status_id = 6 AND s.status = 'KENDALA JARINGAN' AND (kendala = 'TIANG' OR kendala = 'RUTE INSTALASI' OR kendala = 'PENDING INSTALASI')) THEN 1 ELSE 0 END) as all_ki,

				SUM(CASE WHEN (status_id = 6 AND s.status = 'KENDALA JARINGAN' AND (kendala = 'ODP LOSS' OR kendala = 'ODP RETI' OR kendala = 'ODP BLM LIVE' OR kendala = 'ONU > 32')) THEN 1 ELSE 0 END) as all_m,

				SUM(CASE WHEN (s.status = 'KENDALA JARINGAN' AND (kendala = 'ODP FULL' OR kendala = 'PT2' OR kendala = 'NO FO/ODP')) THEN 1 ELSE 0 END) as all_t,

				SUM(CASE WHEN (s.status_id = 13 AND s.`status` = 'NEXT PROJECT') THEN 1 ELSE 0 END) as next_project,

				SUM(CASE WHEN (s.status_id = 13 AND (s.status = 'REDESAIN' OR s.status = 'APPROVAL AMO' OR s.status = 'DEPLOY' OR s.status = 'PROSES GOLIVE' OR s.status = 'KENDALA GOLIVE')) THEN 1 ELSE 0 END) as on_cons

            ");

		$this->db->from('tb_sales as s');

		$this->db->where("(s.segment = 0 OR s.segment = 2 OR s.segment = 3) AND s.datel <> 'UNF'");

		$this->db->where('date(tgl_update)', date('Y-m-d'));

		$query = $this->db->get();

		return $query;
	}



	public function show_data($datel, $kendala, $waktu, $segment, $unit, $mode = 'kendala', $by_tgl = 'tgl_ja', $start = null, $end = null)

	{

		$this->db->select('s.*, u.fullname, m.fullname as nama_sales');

		$this->db->from('tb_sales as s');

		$this->db->join('tb_users as u', 'u.users_id = s.update_by', 'left');

		$this->db->join('tb_salesman as m', 'm.s_telegram_id = s.message_from', 'left');



		if ($kendala == 'all') {

			$this->db->where("((status_id = 6 AND s.status <> 'TERMINATE') OR (s.status_id = 13 AND (s.status = 'REDESAIN' OR s.status = 'APPROVAL AMO' OR s.status = 'DEPLOY' OR s.status = 'PROSES GOLIVE' OR s.status = 'KENDALA GOLIVE')))");
		} else {

			if ($kendala == 'TEKNIS' && $mode == 'kendala') {

				$this->db->where("(s.kendala = 'ODP FULL' OR s.kendala = 'PT2' OR s.kendala = 'NO FO/ODP')");

				$this->db->where('s.status_id', 6);
			} elseif ($kendala == 'TEKNIS' && $mode == 'create_project') {

				$this->db->where("(s.kendala = 'ODP FULL' OR s.kendala = 'PT2' OR s.kendala = 'NO FO/ODP') OR (s.status = 'unsc')");

				$this->db->where('(s.status_id = 6 OR s.status_id = 40 OR s.status_id = 1)');
			} elseif ($kendala == 'PELANGGAN') {

				$this->db->where("s.status = 'KENDALA PELANGGAN'");

				$this->db->where('s.status_id', 6);
			} elseif ($kendala == 'INSTALLASI') {

				$this->db->where("(kendala = 'TIANG' OR kendala = 'RUTE INSTALASI' OR kendala = 'PENDING INSTALASI')");

				$this->db->where('s.status_id', 6);
			} elseif ($kendala == 'MAINTENANCE') {

				$this->db->where("(kendala = 'ODP LOSS' OR kendala = 'ODP RETI' OR kendala = 'ONU > 32')");

				$this->db->where('s.status_id', 6);
			} elseif ($kendala == 'UNSC') {

				$this->db->where("((status_id = 1 OR status_id = 40) AND s.status = 'unsc')");
			} else {

				$this->db->where('s.kendala', $kendala);

				$this->db->where('s.status_id', 6);
			}
		}



		if ($waktu == 'today') {

			$this->db->where('date(tgl_update)', date('Y-m-d'));
		}

		if ($datel != 'all') {

			$this->db->where('s.datel', $datel);
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

				$this->db->where('DATE(tgl_post) >=', $start);

				$this->db->where('DATE(tgl_post) <=', $end);
			} else {

				$this->db->where('DATE(tgl_lapor_k) >=', $start);

				$this->db->where('DATE(tgl_lapor_k) <=', $end);
			}
		}

		$this->db->order_by('s.sales_id', 'desc');

		return $this->db->get();
	}



	public function show_progress_data($datel, $order, $sts_sls, $last_u, $kendala, $by_tgl, $start, $end)

	{

		$this->db->select('s.*, u.fullname');

		$this->db->from('tb_sales as s');

		$this->db->join('tb_users as u', 'u.users_id = s.update_by', 'left');



		$this->db->where("(s.status = 'KENDALA PELANGGAN' OR s.status = 'KENDALA JARINGAN' OR s.status = 'APPROVAL AMO' OR s.status = 'REDESAIN' OR s.status = 'DEPLOY' OR s.status = 'PROSES GOLIVE' OR s.status = 'KENDALA GOLIVE')");



		if ($kendala != 'all') {

			$this->db->where('s.kendala', $kendala);
		}



		switch ($last_u) {

			case 'kd_3':

				$this->db->where("(DATEDIFF(CURDATE(), DATE(tgl_update))) < 3");

				break;



			case 'kd_7':

				$this->db->where("(DATEDIFF(CURDATE(), DATE(tgl_update))) >= 3 AND (DATEDIFF(CURDATE(), DATE(tgl_update))) < 7");

				break;



			case 'kd_14':

				$this->db->where("(DATEDIFF(CURDATE(), DATE(tgl_update))) >= 7 AND (DATEDIFF(CURDATE(), DATE(tgl_update))) < 14");

				break;



			case 'kd_30':

				$this->db->where("(DATEDIFF(CURDATE(), DATE(tgl_update))) >= 14 AND (DATEDIFF(CURDATE(), DATE(tgl_update))) < 30");

				break;



			case 'lb_30':

				$this->db->where("(DATEDIFF(CURDATE(), DATE(tgl_update))) >= 30");

				break;



			default:

				$this->db->where("status IS NOT null");

				break;
		}





		if ($datel != 'all') {

			$this->db->where('s.datel', $datel);
		}



		if ($sts_sls != 'all') {

			$this->db->where('s.status', $sts_sls);
		}



		if ($order != 'all') {

			$this->db->where("(s.segment = $order)");
		} else {

			$this->db->where("(s.segment = 0 OR s.segment = 2 OR s.segment = 3)");
		}


		if ($start != null && $end != null) {

			if ($by_tgl == 'tgl_ja') {

				$this->db->where('DATE(tgl_post) >=', $start);

				$this->db->where('DATE(tgl_post) <=', $end);
			} else {

				$this->db->where('DATE(tgl_lapor_k) >=', $start);

				$this->db->where('DATE(tgl_lapor_k) <=', $end);
			}
		}


		$this->db->order_by('s.sales_id', 'desc');

		return $this->db->get();
	}



	public function show_filtered_data($datel, $kendala, $by_tgl, $start, $end, $segment)

	{

		$this->db->select('s.*, u.fullname');

		$this->db->from('tb_sales as s');

		$this->db->join('tb_users as u', 'u.users_id = s.update_by', 'left');

		$this->db->where('s.status_id', 6);

		$this->db->where("(s.segment = 0 OR s.segment = 2 OR s.segment = 3)");

		if ($by_tgl == 'tgl_ja') {

			$this->db->where('s.tgl_post >=', $start);

			$this->db->where('s.tgl_post <=', $end);
		} else {

			$this->db->where('s.tgl_lapor_k >=', $start);

			$this->db->where('s.tgl_lapor_k <=', $end);
		}



		if ($datel != 'all') {

			$this->db->where('s.datel', $datel);
		}



		if ($kendala != 'all') {

			if ($kendala == 'TEKNIS') {

				$this->db->where("(s.kendala = 'ODP FULL' OR s.kendala = 'PT2' OR s.kendala = 'NO FO/ODP')");
			} else {

				$this->db->where('s.kendala', $kendala);
			}
		}



		if ($segment != 'all') {

			$this->db->where("(s.segment = $segment)");
		} else {

			$this->db->where("(s.segment = 0 OR s.segment = 2 OR s.segment = 3)");
		}



		$this->db->order_by('s.sales_id', 'asc');

		return $this->db->get();
	}



	public function get_by_id($id)

	{

		$this->db->select('*');

		$this->db->from('tb_sales as s');

		$this->db->where('s.sales_id', $id);

		$query = $this->db->get();

		return $query->row();
	}



	public function update_sales($where, $data2)

	{

		$this->db->where('sales_id', $where);

		$this->db->update('tb_sales', $data2);
	}



	public function search($search)

	{

		$this->db->select('s.*, u.fullname');

		$this->db->from('tb_sales as s');

		$this->db->join('tb_users as u', 'u.users_id = s.update_by', 'left');

		$where = "(s.segment = 0 OR s.segment = 2 OR s.segment = 3) AND (s.sales_id = '$search' OR s.myir = '$search' OR s.new_sc = '$search' OR s.cp = '$search')";

		$this->db->where($where);

		return $this->db->get();
	}



	function progress_kendala($j_time, $segment, $datel, $by_tgl, $start, $end)

	{

		$this->db->select("

			status,

			SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA PELANGGAN' AND kendala = 'RNA') THEN 1 ELSE 0 END) as rna,

			SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA PELANGGAN' AND kendala = 'ALAMAT') THEN 1 ELSE 0 END) as alamat,

			SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA PELANGGAN' AND kendala = 'PENDING') THEN 1 ELSE 0 END) as pending,

			SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA PELANGGAN' AND kendala = 'NJKI') THEN 1 ELSE 0 END) as njki,

			SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA PELANGGAN' AND kendala = 'BATAL') THEN 1 ELSE 0 END) as batal,

			SUM(CASE WHEN (status_id = 6 AND s.`status` = 'TERMINATE' AND kendala = 'TERMINATE') THEN 1 ELSE 0 END) as terminate,

			SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA JARINGAN' AND kendala = 'PENDING INSTALASI') THEN 1 ELSE 0 END) as pending_instalasi,

			SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA JARINGAN' AND kendala = 'ODP FULL') THEN 1 ELSE 0 END) as odp_full,

			SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA JARINGAN' AND kendala = 'ODP LOSS') THEN 1 ELSE 0 END) as odp_loss,

			SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA JARINGAN' AND kendala = 'ODP RETI') THEN 1 ELSE 0 END) as odp_reti,

			SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA JARINGAN' AND kendala = 'ODP BLM LIVE') THEN 1 ELSE 0 END) as odp_blm_live,

			SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA JARINGAN' AND kendala = 'TIANG') THEN 1 ELSE 0 END) as tiang,

			SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA JARINGAN' AND kendala = 'PT2') THEN 1 ELSE 0 END) as pt_dua,

			SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA JARINGAN' AND kendala = 'NO FO/ODP') THEN 1 ELSE 0 END) as no_fo,

			SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA JARINGAN' AND kendala = 'RUTE INSTALASI') THEN 1 ELSE 0 END) as rute,

			SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA PELANGGAN' AND kendala = 'IJIN TANAM TIANG') THEN 1 ELSE 0 END) as ijin_tanam_tiang,

			SUM(CASE WHEN (status_id = 6 AND s.`status` = 'KENDALA JARINGAN' AND kendala = 'ONU > 32') THEN 1 ELSE 0 END) as onu_32,

			SUM(CASE WHEN (status_id = 6 AND s.status = 'KENDALA PELANGGAN' AND (kendala = 'RNA' OR kendala = 'BATAL' OR kendala = 'ALAMAT' OR kendala = 'PENDING' OR kendala = 'NJKI' OR kendala = 'IJIN TANAM TIANG')) THEN 1 ELSE 0 END) as all_kp,

			SUM(CASE WHEN (status_id = 6 AND s.status = 'KENDALA JARINGAN' AND (kendala = 'TIANG' OR kendala = 'RUTE INSTALASI' OR kendala = 'PENDING INSTALASI')) THEN 1 ELSE 0 END) as all_ki,

			SUM(CASE WHEN (status_id = 6 AND s.status = 'KENDALA JARINGAN' AND (kendala = 'ODP LOSS' OR kendala = 'ODP RETI' OR kendala = 'ONU > 32')) THEN 1 ELSE 0 END) as all_m,

			SUM(CASE WHEN (s.status = 'KENDALA JARINGAN' AND (kendala = 'ODP FULL' OR kendala = 'PT2' OR kendala = 'NO FO/ODP' OR kendala = 'ODP BLM LIVE')) THEN 1 ELSE 0 END) as all_t,

			SUM(CASE WHEN (s.status_id = 13 AND s.`status` = 'APPROVAL AMO') THEN 1 ELSE 0 END) as approval_amo,

			SUM(CASE WHEN (s.status_id = 13 AND s.`status` = 'DEPLOY') THEN 1 ELSE 0 END) as deploy,

			SUM(CASE WHEN (s.status_id = 13 AND s.`status` = 'REDESAIN') THEN 1 ELSE 0 END) as redesain,

			SUM(CASE WHEN (s.status_id = 13 AND s.`status` = 'PROSES GOLIVE') THEN 1 ELSE 0 END) as proses_golive,

			SUM(CASE WHEN (s.status_id = 13 AND s.`status` = 'KENDALA GOLIVE') THEN 1 ELSE 0 END) as kendala_golive,

			SUM(CASE WHEN (status IS NOT null) THEN 1 ELSE 0 END) AS total

		");

		$this->db->from('tb_sales s');

		$this->db->where("(s.status = 'KENDALA PELANGGAN' OR s.status = 'KENDALA JARINGAN' OR s.status = 'APPROVAL AMO' OR s.status = 'REDESAIN' OR s.status = 'DEPLOY' OR s.status = 'PROSES GOLIVE' OR s.status = 'KENDALA GOLIVE')");



		switch ($j_time) {

			case 'kd_3':

				$this->db->where("(DATEDIFF(CURDATE(), DATE(tgl_update))) < 3");

				break;



			case 'kd_7':

				$this->db->where("(DATEDIFF(CURDATE(), DATE(tgl_update))) >= 3 AND (DATEDIFF(CURDATE(), DATE(tgl_update))) < 7");

				break;



			case 'kd_14':

				$this->db->where("(DATEDIFF(CURDATE(), DATE(tgl_update))) >= 7 AND (DATEDIFF(CURDATE(), DATE(tgl_update))) < 14");

				break;



			case 'kd_30':

				$this->db->where("(DATEDIFF(CURDATE(), DATE(tgl_update))) >= 14 AND (DATEDIFF(CURDATE(), DATE(tgl_update))) < 30");

				break;



			case 'lb_30':

				$this->db->where("(DATEDIFF(CURDATE(), DATE(tgl_update))) >= 30");

				break;



			default:

				$this->db->where("status IS NOT null");

				break;
		}

		if ($start != null && $end != null) {

			if ($by_tgl == 'tgl_ja') {

				$this->db->where('DATE(tgl_post) >=', $start);

				$this->db->where('DATE(tgl_post) <=', $end);
			} else {

				$this->db->where('DATE(tgl_lapor_k) >=', $start);

				$this->db->where('DATE(tgl_lapor_k) <=', $end);
			}
		}



		if ($segment != 'all') {

			$this->db->where("(s.segment = $segment) AND s.datel <> 'UNF'");
		} else {

			$this->db->where("(s.segment = 0 OR s.segment = 2 OR s.segment = 3) AND s.datel <> 'UNF'");
		}



		if ($datel != 'all') {

			$this->db->where('datel', $datel);
		}



		$this->db->order_by('s.status_id', 'ASC');

		$this->db->order_by('s.status', 'ASC');

		$query = $this->db->get();

		return $query;
	}
}



/* End of file Kendala_model.php */

/* Location: ./application/models/Kendala_model.php */