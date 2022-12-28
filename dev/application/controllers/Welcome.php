<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('logged_in') != TRUE) {
			redirect(base_url("auth"));
		}
	}

	public function index($waktu = 'all', $unit = 'all')
	{
		if ($unit == 'all') {
			$st_unit = ucwords($unit);
		} else {
			$st_unit = strtoupper($unit);
		}

		$data['title'] 			= 'Jarvis Sales';
		$data['subtitle'] 		= $waktu == 'all' && $unit == 'all' ? 'Dashboard Sales All' : 'Dashboard Sales ' . ucwords($waktu) . ' & Unit ' . $st_unit;
		$data['list_wo']		= $this->dashboard_model->work_order($waktu, $unit)->result_array();
		$data['wo_total']		= $this->dashboard_model->work_order_total($waktu, $unit)->row_array();
		// $data['list_wo_pda']	= $this->dashboard_model->work_order_pda($waktu)->result_array();
		// $data['wo_total_pda']	= $this->dashboard_model->work_order_total_pda($waktu)->row_array();
		$data['time']			= $waktu;
		$data['unit']			= $unit;
		$this->load->view('template', [
			'content' => $this->load->view('dashboard', $data, true)
		]);
	}

	public function provisioning($waktu = 'all', $datel = 'all', $unit = 'all')
	{
		if (menuProgressProvi($this->session->userdata('level'))) {
			switch ($datel) {
				case 'pkl1':
					$st_datel = 'PEKALONGAN 1';
					break;

				case 'pkl2':
					$st_datel = 'PEKALONGAN 2';
					break;

				case 'btg':
					$st_datel = 'BATANG';
					break;

				case 'pml':
					$st_datel = 'PEMALANG';
					break;

				case 'brb':
					$st_datel = 'BREBES';
					break;

				case 'slw':
					$st_datel = 'SLAWI';
					break;

				case 'teg':
					$st_datel = 'TEGAL';
					break;

				default:
					$st_datel = 'ALL';
					break;
			}

			if ($unit == 'all') {
				$st_unit = ucwords($unit);
			} else {
				$st_unit = strtoupper($unit);
			}

			$data['title'] 			= 'Jarvis Sales';
			//$data['subtitle'] 		= 'Dashboard Progres Provisioning PSB ' . $st_datel . ' & Unit ' . $st_unit;
			$data['subtitle'] 		= $datel == 'all' && $unit == 'all' ? 'Dashboard Progres Provisioning PSB All' : 'Dashboard Progres Provisioning PSB ' . $st_datel . ' & Unit ' . $st_unit;
			$data['datel']          = $datel;
			$data['unit']			= $unit;

			//BRB
			$data['brb_reorder']	= $this->dashboard_model->progress_order_psb($waktu, 'BRB', 'reorder', $unit)->row_array();
			$data['brb_as_exp']		= $this->dashboard_model->progress_order_psb($waktu, 'BRB', 'as_exp', $unit)->row_array();
			$data['brb_as_h_min_1']	= $this->dashboard_model->progress_order_psb($waktu, 'BRB', 'as_h_min_1', $unit)->row_array();
			$data['brb_pagi']		= $this->dashboard_model->progress_order_psb($waktu, 'BRB', 'pagi', $unit)->row_array();
			$data['brb_sore']		= $this->dashboard_model->progress_order_psb($waktu, 'BRB', 'sore', $unit)->row_array();
			$data['brb_all']		= $this->dashboard_model->progress_order_psb($waktu, 'BRB', 'all', $unit)->row_array();

			//BTG
			$data['btg_reorder']	= $this->dashboard_model->progress_order_psb($waktu, 'BTG', 'reorder', $unit)->row_array();
			$data['btg_as_exp']		= $this->dashboard_model->progress_order_psb($waktu, 'BTG', 'as_exp', $unit)->row_array();
			$data['btg_as_h_min_1']	= $this->dashboard_model->progress_order_psb($waktu, 'BTG', 'as_h_min_1', $unit)->row_array();
			$data['btg_pagi']		= $this->dashboard_model->progress_order_psb($waktu, 'BTG', 'pagi', $unit)->row_array();
			$data['btg_sore']		= $this->dashboard_model->progress_order_psb($waktu, 'BTG', 'sore', $unit)->row_array();
			$data['btg_all']		= $this->dashboard_model->progress_order_psb($waktu, 'BTG', 'all', $unit)->row_array();

			//PKL1
			$data['pkl1_reorder']		= $this->dashboard_model->progress_order_psb($waktu, 'PKL1', 'reorder', $unit)->row_array();
			$data['pkl1_as_exp']		= $this->dashboard_model->progress_order_psb($waktu, 'PKL1', 'as_exp', $unit)->row_array();
			$data['pkl1_as_h_min_1']	= $this->dashboard_model->progress_order_psb($waktu, 'PKL1', 'as_h_min_1', $unit)->row_array();
			$data['pkl1_pagi']			= $this->dashboard_model->progress_order_psb($waktu, 'PKL1', 'pagi', $unit)->row_array();
			$data['pkl1_sore']			= $this->dashboard_model->progress_order_psb($waktu, 'PKL1', 'sore', $unit)->row_array();
			$data['pkl1_all']			= $this->dashboard_model->progress_order_psb($waktu, 'PKL1', 'all', $unit)->row_array();

			//PKL2
			$data['pkl2_reorder']		= $this->dashboard_model->progress_order_psb($waktu, 'PKL2', 'reorder', $unit)->row_array();
			$data['pkl2_as_exp']		= $this->dashboard_model->progress_order_psb($waktu, 'PKL2', 'as_exp', $unit)->row_array();
			$data['pkl2_as_h_min_1']	= $this->dashboard_model->progress_order_psb($waktu, 'PKL2', 'as_h_min_1', $unit)->row_array();
			$data['pkl2_pagi']			= $this->dashboard_model->progress_order_psb($waktu, 'PKL2', 'pagi', $unit)->row_array();
			$data['pkl2_sore']			= $this->dashboard_model->progress_order_psb($waktu, 'PKL2', 'sore', $unit)->row_array();
			$data['pkl2_all']			= $this->dashboard_model->progress_order_psb($waktu, 'PKL2', 'all', $unit)->row_array();

			//PML
			$data['pml_reorder']	= $this->dashboard_model->progress_order_psb($waktu, 'PML', 'reorder', $unit)->row_array();
			$data['pml_as_exp']		= $this->dashboard_model->progress_order_psb($waktu, 'PML', 'as_exp', $unit)->row_array();
			$data['pml_as_h_min_1']	= $this->dashboard_model->progress_order_psb($waktu, 'PML', 'as_h_min_1', $unit)->row_array();
			$data['pml_pagi']		= $this->dashboard_model->progress_order_psb($waktu, 'PML', 'pagi', $unit)->row_array();
			$data['pml_sore']		= $this->dashboard_model->progress_order_psb($waktu, 'PML', 'sore', $unit)->row_array();
			$data['pml_all']		= $this->dashboard_model->progress_order_psb($waktu, 'PML', 'all', $unit)->row_array();

			//SLW
			$data['slw_reorder']	= $this->dashboard_model->progress_order_psb($waktu, 'SLW', 'reorder', $unit)->row_array();
			$data['slw_as_exp']		= $this->dashboard_model->progress_order_psb($waktu, 'SLW', 'as_exp', $unit)->row_array();
			$data['slw_as_h_min_1']	= $this->dashboard_model->progress_order_psb($waktu, 'SLW', 'as_h_min_1', $unit)->row_array();
			$data['slw_pagi']		= $this->dashboard_model->progress_order_psb($waktu, 'SLW', 'pagi', $unit)->row_array();
			$data['slw_sore']		= $this->dashboard_model->progress_order_psb($waktu, 'SLW', 'sore', $unit)->row_array();
			$data['slw_all']		= $this->dashboard_model->progress_order_psb($waktu, 'SLW', 'all', $unit)->row_array();

			//TEG
			$data['teg_reorder']	= $this->dashboard_model->progress_order_psb($waktu, 'TEG', 'reorder', $unit)->row_array();
			$data['teg_as_exp']		= $this->dashboard_model->progress_order_psb($waktu, 'TEG', 'as_exp', $unit)->row_array();
			$data['teg_as_h_min_1']	= $this->dashboard_model->progress_order_psb($waktu, 'TEG', 'as_h_min_1', $unit)->row_array();
			$data['teg_pagi']		= $this->dashboard_model->progress_order_psb($waktu, 'TEG', 'pagi', $unit)->row_array();
			$data['teg_sore']		= $this->dashboard_model->progress_order_psb($waktu, 'TEG', 'sore', $unit)->row_array();
			$data['teg_all']		= $this->dashboard_model->progress_order_psb($waktu, 'TEG', 'all', $unit)->row_array();

			//ALL
			$data['all_reorder']	= $this->dashboard_model->progress_order_psb($waktu, 'ALL', 'reorder', $unit)->row_array();
			$data['all_as_exp']		= $this->dashboard_model->progress_order_psb($waktu, 'ALL', 'as_exp', $unit)->row_array();
			$data['all_as_h_min_1']	= $this->dashboard_model->progress_order_psb($waktu, 'ALL', 'as_h_min_1', $unit)->row_array();
			$data['all_pagi']		= $this->dashboard_model->progress_order_psb($waktu, 'ALL', 'pagi', $unit)->row_array();
			$data['all_sore']		= $this->dashboard_model->progress_order_psb($waktu, 'ALL', 'sore', $unit)->row_array();
			$data['all_all']		= $this->dashboard_model->progress_order_psb($waktu, 'ALL', 'all', $unit)->row_array();

			$this->load->view('template', [
				'content' => $this->load->view('dashboard_provi', $data, true)
			]);
		} else {
			redirect(base_url("welcome"));
		}
	}

	public function pda($waktu = 'all', $unit = 'all')
	{
		if (menuProgressProvi($this->session->userdata('level'))) {
			if ($unit == 'all') {
				$st_unit = ucwords($unit);
			} else {
				$st_unit = strtoupper($unit);
			}

			$data['title'] 			= 'Jarvis Sales';
			$data['unit']			= $unit;
			//$data['subtitle'] 		= 'Dashboard Progres Provisioning PDA ' . ucwords($waktu) . ' ';
			$data['subtitle'] 		= $unit == 'all' ? 'Dashboard Progres Provisioning PDA All' : 'Dashboard Progres Provisioning PDA Unit ' . $st_unit;

			//BRB
			$data['brb_reorder']	= $this->dashboard_model->progress_order_pda($waktu, 'BRB', 'reorder', $unit)->row_array();
			$data['brb_as_exp']		= $this->dashboard_model->progress_order_pda($waktu, 'BRB', 'as_exp', $unit)->row_array();
			$data['brb_hi']			= $this->dashboard_model->progress_order_pda($waktu, 'BRB', 'as_hi', $unit)->row_array();
			$data['brb_all']		= $this->dashboard_model->progress_order_pda($waktu, 'BRB', 'all', $unit)->row_array();

			//BTG
			$data['btg_reorder']	= $this->dashboard_model->progress_order_pda($waktu, 'BTG', 'reorder', $unit)->row_array();
			$data['btg_as_exp']		= $this->dashboard_model->progress_order_pda($waktu, 'BTG', 'as_exp', $unit)->row_array();
			$data['btg_hi']			= $this->dashboard_model->progress_order_pda($waktu, 'BTG', 'as_hi', $unit)->row_array();
			$data['btg_all']		= $this->dashboard_model->progress_order_pda($waktu, 'BTG', 'all', $unit)->row_array();

			//PKL1
			$data['pkl1_reorder']	= $this->dashboard_model->progress_order_pda($waktu, 'PKL1', 'reorder', $unit)->row_array();
			$data['pkl1_as_exp']	= $this->dashboard_model->progress_order_pda($waktu, 'PKL1', 'as_exp', $unit)->row_array();
			$data['pkl1_hi']		= $this->dashboard_model->progress_order_pda($waktu, 'PKL1', 'as_hi', $unit)->row_array();
			$data['pkl1_all']		= $this->dashboard_model->progress_order_pda($waktu, 'PKL1', 'all', $unit)->row_array();

			//PKL2
			$data['pkl2_reorder']	= $this->dashboard_model->progress_order_pda($waktu, 'PKL2', 'reorder', $unit)->row_array();
			$data['pkl2_as_exp']	= $this->dashboard_model->progress_order_pda($waktu, 'PKL2', 'as_exp', $unit)->row_array();
			$data['pkl2_hi']		= $this->dashboard_model->progress_order_pda($waktu, 'PKL2', 'as_hi', $unit)->row_array();
			$data['pkl2_all']		= $this->dashboard_model->progress_order_pda($waktu, 'PKL2', 'all', $unit)->row_array();

			//PML
			$data['pml_reorder']	= $this->dashboard_model->progress_order_pda($waktu, 'PML', 'reorder', $unit)->row_array();
			$data['pml_as_exp']		= $this->dashboard_model->progress_order_pda($waktu, 'PML', 'as_exp', $unit)->row_array();
			$data['pml_hi']			= $this->dashboard_model->progress_order_pda($waktu, 'PML', 'as_hi', $unit)->row_array();
			$data['pml_all']		= $this->dashboard_model->progress_order_pda($waktu, 'PML', 'all', $unit)->row_array();

			//SLW
			$data['slw_reorder']	= $this->dashboard_model->progress_order_pda($waktu, 'SLW', 'reorder', $unit)->row_array();
			$data['slw_as_exp']		= $this->dashboard_model->progress_order_pda($waktu, 'SLW', 'as_exp', $unit)->row_array();
			$data['slw_hi']			= $this->dashboard_model->progress_order_pda($waktu, 'SLW', 'as_hi', $unit)->row_array();
			$data['slw_all']		= $this->dashboard_model->progress_order_pda($waktu, 'SLW', 'all', $unit)->row_array();

			//TEG
			$data['teg_reorder']	= $this->dashboard_model->progress_order_pda($waktu, 'TEG', 'reorder', $unit)->row_array();
			$data['teg_as_exp']		= $this->dashboard_model->progress_order_pda($waktu, 'TEG', 'as_exp', $unit)->row_array();
			$data['teg_hi']			= $this->dashboard_model->progress_order_pda($waktu, 'TEG', 'as_hi', $unit)->row_array();
			$data['teg_all']		= $this->dashboard_model->progress_order_pda($waktu, 'TEG', 'all', $unit)->row_array();

			//ALL
			$data['all_reorder']	= $this->dashboard_model->progress_order_pda($waktu, 'ALL', 'reorder', $unit)->row_array();
			$data['all_as_exp']		= $this->dashboard_model->progress_order_pda($waktu, 'ALL', 'as_exp', $unit)->row_array();
			$data['all_hi']			= $this->dashboard_model->progress_order_pda($waktu, 'ALL', 'as_hi', $unit)->row_array();
			$data['all_all']		= $this->dashboard_model->progress_order_pda($waktu, 'ALL', 'all', $unit)->row_array();

			$data['unf_all']		= $this->dashboard_model->progress_order_pda($waktu, 'UNF', 'all', $unit)->row_array();

			$this->load->view('template', [
				'content' => $this->load->view('dashboard_pda', $data, true)
			]);
		} else {
			redirect(base_url("welcome"));
		}
	}

	public function addon($waktu = 'all', $jenis = 'all', $unit = 'all')
	{
		if (menuProgressProvi($this->session->userdata('level'))) {
			if ($unit == 'all') {
				$st_unit = ucwords($unit);
			} else {
				$st_unit = strtoupper($unit);
			}

			$data['title'] 			= 'Jarvis Sales';
			$data['subtitle'] 		= 'Dashboard Progres Provisioning Addon Jenis ' . ucwords($jenis) . ' ';
			$data['subtitle'] 		= $jenis == 'all' && $unit == 'all' ? 'Dashboard Progres Provisioning Addon All' : 'Dashboard Progres Provisioning Addon ' . ucwords($jenis) . ' & Unit ' . $st_unit;
			$data['jenis']		    = $jenis;
			$data['unit']		    = $unit;

			$jenis = str_replace("_", " ", $jenis);

			//BRB
			$data['brb_reorder']	= $this->dashboard_model->progress_order_addon($waktu, $jenis, 'BRB', 'reorder', $unit)->row_array();
			$data['brb_as_exp']		= $this->dashboard_model->progress_order_addon($waktu, $jenis, 'BRB', 'as_exp', $unit)->row_array();
			$data['brb_hi']			= $this->dashboard_model->progress_order_addon($waktu, $jenis, 'BRB', 'as_hi', $unit)->row_array();
			$data['brb_all']		= $this->dashboard_model->progress_order_addon($waktu, $jenis, 'BRB', 'all', $unit)->row_array();

			//BTG
			$data['btg_reorder']	= $this->dashboard_model->progress_order_addon($waktu, $jenis, 'BTG', 'reorder', $unit)->row_array();
			$data['btg_as_exp']		= $this->dashboard_model->progress_order_addon($waktu, $jenis, 'BTG', 'as_exp', $unit)->row_array();
			$data['btg_hi']			= $this->dashboard_model->progress_order_addon($waktu, $jenis, 'BTG', 'as_hi', $unit)->row_array();
			$data['btg_all']		= $this->dashboard_model->progress_order_addon($waktu, $jenis, 'BTG', 'all', $unit)->row_array();

			//PKL1
			$data['pkl1_reorder']	= $this->dashboard_model->progress_order_addon($waktu, $jenis, 'PKL1', 'reorder', $unit)->row_array();
			$data['pkl1_as_exp']	= $this->dashboard_model->progress_order_addon($waktu, $jenis, 'PKL1', 'as_exp', $unit)->row_array();
			$data['pkl1_hi']		= $this->dashboard_model->progress_order_addon($waktu, $jenis, 'PKL1', 'as_hi', $unit)->row_array();
			$data['pkl1_all']		= $this->dashboard_model->progress_order_addon($waktu, $jenis, 'PKL1', 'all', $unit)->row_array();

			//PKL2
			$data['pkl2_reorder']	= $this->dashboard_model->progress_order_addon($waktu, $jenis, 'PKL2', 'reorder', $unit)->row_array();
			$data['pkl2_as_exp']	= $this->dashboard_model->progress_order_addon($waktu, $jenis, 'PKL2', 'as_exp', $unit)->row_array();
			$data['pkl2_hi']		= $this->dashboard_model->progress_order_addon($waktu, $jenis, 'PKL2', 'as_hi', $unit)->row_array();
			$data['pkl2_all']		= $this->dashboard_model->progress_order_addon($waktu, $jenis, 'PKL2', 'all', $unit)->row_array();

			//PML
			$data['pml_reorder']	= $this->dashboard_model->progress_order_addon($waktu, $jenis, 'PML', 'reorder', $unit)->row_array();
			$data['pml_as_exp']		= $this->dashboard_model->progress_order_addon($waktu, $jenis, 'PML', 'as_exp', $unit)->row_array();
			$data['pml_hi']			= $this->dashboard_model->progress_order_addon($waktu, $jenis, 'PML', 'as_hi', $unit)->row_array();
			$data['pml_all']		= $this->dashboard_model->progress_order_addon($waktu, $jenis, 'PML', 'all', $unit)->row_array();

			//SLW
			$data['slw_reorder']	= $this->dashboard_model->progress_order_addon($waktu, $jenis, 'SLW', 'reorder', $unit)->row_array();
			$data['slw_as_exp']		= $this->dashboard_model->progress_order_addon($waktu, $jenis, 'SLW', 'as_exp', $unit)->row_array();
			$data['slw_hi']			= $this->dashboard_model->progress_order_addon($waktu, $jenis, 'SLW', 'as_hi', $unit)->row_array();
			$data['slw_all']		= $this->dashboard_model->progress_order_addon($waktu, $jenis, 'SLW', 'all', $unit)->row_array();

			//TEG
			$data['teg_reorder']	= $this->dashboard_model->progress_order_addon($waktu, $jenis, 'TEG', 'reorder', $unit)->row_array();
			$data['teg_as_exp']		= $this->dashboard_model->progress_order_addon($waktu, $jenis, 'TEG', 'as_exp', $unit)->row_array();
			$data['teg_hi']			= $this->dashboard_model->progress_order_addon($waktu, $jenis, 'TEG', 'as_hi', $unit)->row_array();
			$data['teg_all']		= $this->dashboard_model->progress_order_addon($waktu, $jenis, 'TEG', 'all', $unit)->row_array();

			//ALL
			$data['all_reorder']	= $this->dashboard_model->progress_order_addon($waktu, $jenis, 'ALL', 'reorder', $unit)->row_array();
			$data['all_as_exp']		= $this->dashboard_model->progress_order_addon($waktu, $jenis, 'ALL', 'as_exp', $unit)->row_array();
			$data['all_hi']			= $this->dashboard_model->progress_order_addon($waktu, $jenis, 'ALL', 'as_hi', $unit)->row_array();
			$data['all_all']		= $this->dashboard_model->progress_order_addon($waktu, $jenis, 'ALL', 'all', $unit)->row_array();

			$data['unf_all']		= $this->dashboard_model->progress_order_addon($waktu, $jenis, 'UNF', 'ALL', $unit)->row_array();

			$this->load->view('template', [
				'content' => $this->load->view('dashboard_addon', $data, true)
			]);
		} else {
			redirect(base_url("welcome"));
		}
	}

	public function teknisi($segment = 'all', $unit = 'all')
	{
		if (menuDashboardTeknisi($this->session->userdata('level'))) {
			$data['segment']        = $segment;
			$data['unit']			= $unit;
			$segment 				= getSegment($segment);
			$data['title'] 			= 'Jarvis Sales';
			$data['subtitle'] 		= 'Dashboard Order Teknisi';
			$data['all_datel']    	= $this->dashboard_model->all_datel($segment, $unit)->result_array();
			$data['all_teknisi']    = $this->dashboard_model->work_order_teknisi($segment, $unit)->result_array();
			$data['all_total']    	= $this->dashboard_model->total_work_order_teknisi($segment, $unit)->row_array();

			$this->load->view('template', [
				'content' => $this->load->view('dashboard_teknisi', $data, true)
			]);
		} else {
			redirect(base_url("welcome"));
		}
	}

	public function monitoring_amunisi($jenis = 'all', $unit = 'all')
	{
		if (menuMonitoringBA($this->session->userdata('level'))) {
			$segment = getSegmentID($jenis);

			if ($jenis == 'all') {
				$st_jenis = ucwords($jenis);
			} else {
				$st_jenis = strtoupper($jenis);
			}

			if ($unit == 'all') {
				$st_unit = ucwords($unit);
			} else {
				$st_unit = strtoupper($unit);
			}

			$data['title'] 			= 'Jarvis Sales';
			$data['segment'] 		= $segment;
			//$data['subtitle'] 		= 'Dashboard Monitoring Amunisi ' . strtoupper($jenis) . ' ';
			$data['subtitle'] 		= $jenis == 'all' && $unit == 'all' ? 'Dashboard Monitoring Amunisi All' : 'Dashboard Monitoring Amunisi ' . $st_jenis . ' & Unit ' . $st_unit;
			$data['all_teknisi']    = $this->dashboard_model->monitoring_amunisi_teknisi($segment, $unit)->result_array();
			$data['all_datel']    	= $this->dashboard_model->monitoring_amunisi_datel($segment, $unit)->result_array();
			$data['select_segment'] = $jenis;
			$data['select_unit']	= $unit;
			$this->load->view('template', [
				'content' => $this->load->view('dashboard_amunisi', $data, true)
			]);
		} else {
			redirect(base_url("welcome"));
		}
	}

	public function produktifitas($bulan = 'now', $tahun = 'now', $datel = 'all')
	{
		if (menuProduktifitasPsb($this->session->userdata('level'))) {
			$data['title'] 			= 'Jarvis Sales';
			$data['subtitle'] 		= 'Dashboard Produktifitas PSB';
			$data['list_scbe']		= $this->dashboard_model->produktifitas($bulan, $tahun, $datel, 'scbe')->row_array();
			$data['list_reorder']	= $this->dashboard_model->produktifitas($bulan, $tahun, $datel, 'reorder')->row_array();
			$data['list_reqsc']		= $this->dashboard_model->produktifitas($bulan, $tahun, $datel, 'reqsc')->row_array();
			$data['list_kendala']	= $this->dashboard_model->produktifitas($bulan, $tahun, $datel, 'kendala')->row_array();
			$data['list_ps']		= $this->dashboard_model->produktifitas($bulan, $tahun, $datel, 'ps')->row_array();
			$data['bulan']			= $bulan;
			$data['tahun']			= $tahun;
			$data['datel']			= $datel;
			$this->load->view('template', [
				'content' => $this->load->view('dashboard_produktifitas', $data, true)
			]);
		} else {
			redirect(base_url("welcome"));
		}
	}
}
