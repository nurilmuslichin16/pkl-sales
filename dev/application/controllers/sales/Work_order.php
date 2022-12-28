<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Work_order extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('logged_in') != TRUE) {
			redirect(base_url("auth"));
		}
	}

	public function index()
	{
	}

	public function progress()
	{
		$get 	  = $this->input->get(NULL, TRUE);
		$datel 	  = $get['datel'];
		$kategori = $get['kategori'];

		$data['title'] 		    = 'Progress Order';
		$data['subtitle'] 	    = 'Progress Order PDA ' . kategori_progress($kategori) . ' Datel ' . $datel;
		$data['datas'] 			= $this->wo_model->wo_progress_view($kategori, $datel)->result_array();
		$data['teknisi'] 	 	= $this->wo_model->teknisi($datel)->result_array();
		$this->load->view('template', [
			'content' => $this->load->view('sales/work_order/amunisi/view/all', $data, true)
		]);
	}

	public function amunisi()
	{
		$get 	 = $this->input->get(NULL, TRUE);
		$datel 	 = $get['datel'];
		$amunisi = $get['amunisi'];
		$unit	 = $get['unit'];
		$time	 = $get['time'];
		if ($amunisi == 'pagi') {
			$waktu = 'Pagi ' . date_indo(date("Y-m-d"));
		} elseif ($amunisi == 'sore') {
			$waktu = 'Sore ' . date_indo(date("Y-m-d"));
		} elseif ($amunisi == 'h_min_1') {
			$waktu = date_indo(date("Y-m-d", strtotime("-1 days")));
		} elseif ($amunisi == 'exp') {
			$waktu = 'Expaired';
		} elseif ($amunisi == 'reorder_pagi') {
			$waktu = 'Reorder Pagi';
		} elseif ($amunisi == 'reorder_sore') {
			$waktu = 'Reorder Sore';
		} elseif ($amunisi == 'not_fu') {
			$waktu = 'Tidak Ter-Follow Up Hari ini';
		} else {
			$waktu = 'Total';
		}

		$data['title'] 		    = 'Amunisi';
		$data['subtitle'] 	    = 'Amunisi ' . $waktu . ' Datel ' . $datel . ' Unit ' . strtoupper($unit);
		$data['datas'] 			= $this->wo_model->amunisi_view($datel, $amunisi, $unit, $time)->result_array();
		$data['teknisi'] 	 	= $this->wo_model->teknisi($datel)->result_array();

		$this->load->view('template', [
			'content' => $this->load->view('sales/work_order/amunisi/view/all', $data, true)
		]);
	}

	public function ba_amunisi()
	{
		$get 	 = $this->input->get(NULL, TRUE);
		$datel 	 = $get['datel'];
		$amunisi = $get['amunisi'];
		$teknisi = $get['teknisi'];
		$segment = $get['segment'];
		$ba      = $get['ba'];
		$unit	 = $get['unit'];
		if ($amunisi == 'pagi') {
			$waktu = 'Pagi ' . date_indo(date("Y-m-d"));
		} elseif ($amunisi == 'sore') {
			$waktu = 'Sore ' . date_indo(date("Y-m-d"));
		} elseif ($amunisi == 'h_min_1') {
			$waktu = date_indo(date("Y-m-d", strtotime("-1 days")));
		} elseif ($amunisi == 'exp') {
			$waktu = 'Expaired';
		} elseif ($amunisi == 'reorder') {
			$waktu = 'Reorder';
		} else {
			$waktu = 'Total';
		}
		$data['title'] 		    = 'Amunisi';
		$data['subtitle'] 	    = 'Amunisi ' . $waktu . ' Datel ' . $datel;
		$data['datas'] 			= $this->wo_model->ba_amunisi_view($datel, $amunisi, $teknisi, $segment, $ba, $unit)->result_array();
		$this->load->view('template', [
			'content' => $this->load->view('sales/work_order/amunisi/view/ba', $data, true)
		]);
	}

	public function deal()
	{
		$get 	 = $this->input->get(NULL, TRUE);
		$datel 	 = $get['datel'];
		$unit	 = $get['unit'];
		$kategori = $get['kategori'];
		$time	 = $get['time'];
		if ($kategori == 'today') {
			$waktu = date_indo(date("Y-m-d"));
		} else {
			$waktu = date_indo(date("Y-m-d", strtotime("-1 days")));
		}
		$data['title'] 		    = 'Deal Sales';
		$data['subtitle'] 	    = 'Deal Sales ' . $waktu . ' Datel ' . $datel . ' Unit ' . strtoupper($unit);
		$data['datas'] 			= $this->wo_model->deal_view($datel, $kategori, $unit, $time)->result_array();
		$this->load->view('template', [
			'content' => $this->load->view('sales/work_order/deal/view/all', $data, true)
		]);
	}

	public function pra_order()
	{
		$get 	 = $this->input->get(NULL, TRUE);
		$datel 	 = $get['datel'];
		$order   = $get['order'];
		$unit	 = $get['unit'];
		$time	 = $get['time'];
		if ($order == 'wait_fcc') {
			$ordernya = 'WAIT FCC';
		} elseif ($order == 'prog_fcc') {
			$ordernya = 'PROGRESS FCC';
		} else {
			$ordernya = 'KENDALA FCC';
		}
		$data['title'] 		    = 'Pra Order';
		$data['subtitle'] 	    = 'Pra Order ' . $ordernya . ' Datel ' . $datel . ' Unit ' . strtoupper($unit);
		$data['datas'] 			= $this->wo_model->pra_order_view($datel, $order, $unit, $time)->result_array();
		$this->load->view('template', [
			'content' => $this->load->view('sales/work_order/pra_order/view/all', $data, true)
		]);
	}

	public function request_sc()
	{
		$get 	 = $this->input->get(NULL, TRUE);
		$datel 	 = $get['datel'];
		$order   = $get['order'];
		$unit	 = $get['unit'];
		$time	 = $get['time'];
		if ($order == 'waitsc') {
			$ordernya = 'WAIT SC';
		} else {
			$ordernya = 'DONE SC';
		}
		$data['title'] 		    = 'Request SC';
		$data['subtitle'] 	    = 'Order ' . $ordernya . ' Datel ' . $datel . ' Unit ' . strtoupper($unit);
		$data['datas'] 			= $this->wo_model->request_sc_view($datel, $order, $unit, $time)->result_array();
		$this->load->view('template', [
			'content' => $this->load->view('sales/work_order/deal/view/all', $data, true)
		]);
	}

	public function kendala()
	{
		$get 	 = $this->input->get(NULL, TRUE);
		$datel 	 = $get['datel'];
		$kategori = $get['kategori'];
		$time = $get['time'];
		$unit	 = $get['unit'];
		$jenis    = empty($get['jenis']) ? 'psb' : $get['jenis'];
		if ($kategori == 'kp') {
			$knd = 'Pelanggan';
		} elseif ($kategori == 'cons') {
			$knd = 'Under Construction';
		} else {
			$knd = 'Jaringan';
		}
		$data['title'] 		    = 'Kendala';
		$data['subtitle'] 	    = 'Kendala ' . $knd . ' Datel ' . $datel . ' Unit ' . strtoupper($unit);
		$data['kate'] 	    	= $kategori;
		$data['datas'] 			= $this->wo_model->kendala_view($datel, $kategori, $jenis, $time, $unit);
		$this->load->view('template', [
			'content' => $this->load->view('sales/work_order/kendala/view/all', $data, true)
		]);
	}

	public function provi()
	{
		$get 	 	= $this->input->get(NULL, TRUE);
		$datel 	 	= $get['datel'];
		$kategori 	= $get['kategori'];
		$unit	 	= $get['unit'];
		$time	 = $get['time'];
		$jenis      = empty($get['jenis']) ? 'psb' : $get['jenis'];
		if ($get['kategori'] == 'wait_act') {
			$prov = 'WAIT ACT';
		}
		if ($get['kategori'] == 'prog_act') {
			$prov = 'Progress ACT';
		} elseif ($get['kategori'] == 'fact') {
			$prov = 'Fallout';
		} elseif ($get['kategori'] == 'comp') {
			$prov = 'COMP';
		} elseif ($get['kategori'] == 'ps') {
			$prov = 'PS';
		}
		$data['title'] 		    = 'Provisioning';
		$data['subtitle'] 	    = 'Progress Provisioning ' . date_indo(date("Y-m-d")) . ' ' . $prov . ' Datel ' . $datel . ' Unit ' . strtoupper($unit);
		$data['datas'] 			= $this->wo_model->provi_view($datel, $kategori, $jenis, $unit, $time)->result_array();
		$data['teknisi'] 	 	= $this->wo_model->teknisi($datel)->result_array();
		$this->load->view('template', [
			'content' => $this->load->view('sales/work_order/provi/view/all', $data, true)
		]);
	}

	public function send_order()
	{
		$sales_id  	= $this->input->post('sales_id', NULL, TRUE);
		$teknisi   	= $this->input->post('teknisi', NULL, TRUE);
		$pecah_id   = explode(',', $sales_id);
		$totalData  = sizeof($pecah_id);
		$index = 0;


		$datas = array(
			'tgl_progress' 	=> date('Y-m-d H:i:s'),
			'progress_by' 	=> $this->session->userdata('user_id'),
			'progress_to' 	=> $teknisi,
			'status' 		=> 'ordered',
			'status_id' 	=> 2,
			'tgl_update' 	=> date('Y-m-d H:i:s'),
			'update_by' 	=> $this->session->userdata('user_id')
		);

		for ($i = 0; $i < $totalData; $i++) {
			$cekorder = $this->db->query("SELECT sales_id, status_id FROM tb_sales where sales_id='" . $pecah_id[$index] . "' AND status_id >= 1")->num_rows();
			$query_before = $this->db->get_where('tb_sales', array('sales_id' => $pecah_id[$index]))->row_array();
			if ($cekorder > 0) {
				$querytbefore = $this->db->get_where('tb_teknisi', array('t_telegram_id' => $query_before['progress_to']))->row_array();
				$querytnew = $this->db->get_where('tb_teknisi', array('t_telegram_id' => $teknisi))->row_array();
				$crew = $querytbefore['crew'];
				$crewnew = $querytnew['crew'];
				$getTekBefore = $this->db->get_where('tb_teknisi', array('crew' => $crew, 'active' => 1))->result();
				$message_text = "ORDER JA$query_before[sales_id] telah dialihkan ke crew $crewnew\n";

				foreach ($getTekBefore as $row1) {
					sendChatHtml($row1->t_telegram_id, $message_text);
				}


				$this->wo_model->update(array('sales_id' => $pecah_id[$index]), $datas);
				$query = $this->db->get_where('tb_sales', array('sales_id' => $pecah_id[$index]))->row_array();

				/*save log data*/
				$queryt = $this->db->get_where('tb_teknisi', array('t_telegram_id' => $teknisi))->row_array();
				$datalog = array(
					'sales_id' 		=> $pecah_id[$index],
					'action_by' 	=> $this->session->userdata('nama'),
					'action_on' 	=> date('Y-m-d H:i:s'),
					'action_status' => 2,
					'a_keterangan' 	=> 'ORDER DI PROGRESS KE CREW ' . $queryt['crew']
				);
				$this->db->insert('tb_log', $datalog);
				/*end save log data*/

				$pecahloc   = explode(',', $query['lat_long']);
				$lat        = str_replace(" ", "", $pecahloc[0]);
				$lng        = str_replace(" ", "", $pecahloc[1]);
				$salesman   = getSalesman($query['kode']) == 'NULL' ? $query['kode'] :  getSalesman($query['kode']);

				$kat = $query['kategori'];

				if ($kat == 1) {
					$kategori = 'DEAL, ODP READY';
				} elseif ($kat == 2) {
					$kategori = 'NOT DEAL, ODP READY';
				} elseif ($kat == 3) {
					$kategori = 'UNSC';
				}

				$telegram_id = $queryt['t_telegram_id'];
				$crew = $queryt['crew'];
				$getTek = $this->db->get_where('tb_teknisi', array('crew' => $crew, 'active' => 1))->result();

				$message_text = "ORDER\n";
				$message_text .= "JA$query[sales_id]\n";
				$message_text .= "NAMA PELANGGAN : $query[nama_pelanggan]\n";
				$message_text .= "CP : $query[cp]\n";
				$message_text .= "ODP : $query[odp]\n";
				$message_text .= "ALAMAT : $query[alamat]\n";
				$message_text .= "JARAK TIANG : $query[jarak_tiang]\n";
				$message_text .= "KATEGORI : $kategori\n";
				$message_text .= "MYIR : $query[myir]\n";
				$message_text .= "PAKET : $query[paket]\n";
				$message_text .= "SALES : $salesman\n";
				$message_text .= "KETERANGAN : $query[keterangan]\n";
				$message_text .= "LOKASI : \nhttps://www.google.co.id/maps/search/$lat,+$lng";
				$index++;
				foreach ($getTek as $row0) {
					sendChatHtml($row0->t_telegram_id, $message_text);
				}
			}
		}

		echo json_encode(
			array(
				"status" => TRUE,
				'pesan' => '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>Well done!</b> ' . $index . ' order sucessfully send to teknisi!</div>'
			)
		);
	}

	public function resend_order()
	{
		$sales_id  	= $this->input->post('sales_id', NULL, TRUE);
		$teknisi   	= $this->input->post('teknisi', NULL, TRUE);
		$pecah_id   = explode(',', $sales_id);
		$totalData  = sizeof($pecah_id);
		$index = 0;


		$datas = array(
			'tgl_progress' 	=> date('Y-m-d H:i:s'),
			'progress_by' 	=> $this->session->userdata('user_id'),
			'progress_to' 	=> $teknisi,
			'tgl_update' 	=> date('Y-m-d H:i:s'),
			'update_by' 	=> $this->session->userdata('user_id')
		);

		for ($i = 0; $i < $totalData; $i++) {
			$cekorder = $this->db->query("SELECT sales_id, status_id FROM tb_sales where sales_id='" . $pecah_id[$index] . "' AND status_id <> 10")->num_rows();
			$query_before = $this->db->get_where('tb_sales', array('sales_id' => $pecah_id[$index]))->row_array();
			if ($cekorder > 0) {
				$querytbefore = $this->db->get_where('tb_teknisi', array('t_telegram_id' => $query_before['t_telegram_id']))->row_array();
				$querytnew = $this->db->get_where('tb_teknisi', array('t_telegram_id' => $teknisi))->row_array();
				$crew = $querytbefore['crew'];
				$crewnew = $querytnew['crew'];
				$getTekBefore = $this->db->get_where('tb_teknisi', array('crew' => $crew, 'active' => 1))->result();
				$message_text = "ORDER JA$query_before[sales_id] telah dialihkan ke crew $crewnew\n";

				foreach ($getTekBefore as $row1) {
					sendChatHtml($row1->t_telegram_id, $message_text);
				}


				$this->wo_model->update(array('sales_id' => $pecah_id[$index]), $datas);
				$query = $this->db->get_where('tb_sales', array('sales_id' => $pecah_id[$index]))->row_array();

				/*save log data*/
				$queryt = $this->db->get_where('tb_teknisi', array('t_telegram_id' => $teknisi))->row_array();
				$datalog = array(
					'sales_id' 		=> $pecah_id[$index],
					'action_by' 	=> $this->session->userdata('nama'),
					'action_on' 	=> date('Y-m-d H:i:s'),
					'action_status' => 2,
					'a_keterangan' 	=> 'ORDER DI PROGRESS KE CREW ' . $queryt['crew']
				);
				$this->db->insert('tb_log', $datalog);
				/*end save log data*/

				$pecahloc   = explode(',', $query['lat_long']);
				$lat        = str_replace(" ", "", $pecahloc[0]);
				$lng        = str_replace(" ", "", $pecahloc[1]);
				$salesman   = getSalesman($query['kode']) == 'NULL' ? $query['kode'] :  getSalesman($query['kode']);

				$kat = $query['kategori'];

				if ($kat == 1) {
					$kategori = 'DEAL, ODP READY';
				} elseif ($kat == 2) {
					$kategori = 'NOT DEAL, ODP READY';
				} elseif ($kat == 3) {
					$kategori = 'UNSC';
				}

				$telegram_id = $queryt['t_telegram_id'];
				$crew = $queryt['crew'];
				$getTek = $this->db->get_where('tb_teknisi', array('crew' => $crew, 'active' => 1))->result();

				$message_text = "ORDER\n";
				$message_text .= "JA$query[sales_id]\n";
				$message_text .= "NAMA PELANGGAN : $query[nama_pelanggan]\n";
				$message_text .= "CP : $query[cp]\n";
				$message_text .= "ODP : $query[odp]\n";
				$message_text .= "ALAMAT : $query[alamat]\n";
				$message_text .= "JARAK TIANG : $query[jarak_tiang]\n";
				$message_text .= "KATEGORI : $kategori\n";
				$message_text .= "MYIR : $query[myir]\n";
				$message_text .= "PAKET : $query[paket]\n";
				$message_text .= "SALES : $salesman\n";
				$message_text .= "KETERANGAN : $query[keterangan]\n";
				$message_text .= "LOKASI : \nhttps://www.google.co.id/maps/search/$lat,+$lng";
				$index++;
				foreach ($getTek as $row0) {
					sendChatHtml($row0->t_telegram_id, $message_text);
				}
			}
		}

		echo json_encode(
			array(
				"status" => TRUE,
				'pesan' => '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>Well done!</b> ' . $index . ' order sucessfully resend to teknisi!</div>'
			)
		);
	}

	public function create_kendala()
	{
		//$this->_validate();
		$sales_id  	= $this->input->post('id', NULL, TRUE);
		$mefrom   	= $this->input->post('mefrom', NULL, TRUE);
		$meid   	= $this->input->post('meid', NULL, TRUE);
		$kendala   	= $this->input->post('kendala', NULL, TRUE);
		$loc_cust   = $this->input->post('loc_cust', NULL, TRUE);
		$keterangan = !empty($this->input->post('keterangan')) ? $this->input->post('keterangan') : null;

		$ceksales_id = $this->db->query("SELECT sales_id FROM tb_sales WHERE sales_id ='" . $sales_id . "'")->num_rows();
		if ($ceksales_id > 0) {
			// jika ada
			if ($kendala == 'SUDAH PS') {
				$tglPS = !empty($this->input->post('tgl_ps')) ? $this->input->post('tgl_ps') : date('Y-m-d H:i:s');
				$dataps = array(
					'status_id'     	=> 10,
					'status'			=> 'ps',
					'keterangan'     	=> $keterangan . ' Tanggal PS : ' . $tglPS . ' ',
					'update_by'			=> $this->session->userdata('user_id'),
					'tgl_update'		=> $tglPS
				);

				$datalog = array(
					'sales_id'      => $sales_id,
					'action_by'     => $this->session->userdata('nama'),
					'action_on'     => date('Y-m-d H:i:s'),
					'action_status' => 10,
					'a_keterangan'  => $keterangan . ' Tanggal PS : ' . $tglPS . ' ',
				);
				$this->wo_model->update_kendala(array('sales_id' => $sales_id), $dataps);
			} else {
				if ($kendala == 'RNA' || $kendala == 'ALAMAT' || $kendala == 'PENDING' || $kendala == 'BATAL' || $kendala == 'IJIN TANAM TIANG' || $kendala == 'NJKI') {
					$jenis_kendala = 'KENDALA PELANGGAN';
				} elseif ($kendala == 'TERMINATE') {
					$jenis_kendala = 'TERMINATE';
				} else {
					$jenis_kendala = 'KENDALA JARINGAN';
				}

				$dataus = array(
					'status_id'     	=> 6,
					'status'			=> $jenis_kendala,
					'kendala'			=> $kendala,
					'keterangan'     	=> $keterangan,
					'loc_cust'			=> !empty($loc_cust) ? $loc_cust : null,
					'update_by'			=> $this->session->userdata('user_id'),
					'tgl_update'		=> date('Y-m-d H:i:s'),
					'tgl_lapor_k'		=> date('Y-m-d H:i:s')
				);
				$datalog = array(
					'sales_id'      => $sales_id,
					'action_by'     => $this->session->userdata('nama'),
					'action_on'     => date('Y-m-d H:i:s'),
					'action_status' => 6,
					'a_keterangan'  => strtoupper($kendala . "-" . $keterangan)
				);

				$this->wo_model->update_kendala(array('sales_id' => $sales_id), $dataus);
			}
			$this->db->insert('tb_log', $datalog);
			/*send message to sales*/
			$telegram_id = $this->input->post('mefrom', NULL, TRUE);
			$updateby    = $this->session->userdata('nama');
			$message_text = "ORDER SET TO KENDALA : ($kendala) \n";
			$message_text .= "JA$sales_id\n";
			$message_text .= "KET :\n";
			$message_text .= "$keterangan \n\n";
			$message_text .= " ~ $updateby";
			sendMessage($telegram_id, $message_text, $meid);
			/*end of send message to sales*/
			echo json_encode(
				array(
					"status"   => TRUE,
					'kendala'  => $kendala,
					'sales_id' => $sales_id
				)
			);
		} else {
			// jika sudah ada
			echo json_encode(
				array(
					"status"   => TRUE,
					'sales_id' => $sales_id
				)
			);
		}
	}

	public function ba_detail($id)
	{
		$data = $this->wo_model->get_ba_id($id);
		echo json_encode($data);
	}

	public function save_ba_amunisi()
	{
		$sales_id  	= $this->input->post('id');
		$evident  	= $this->input->post('evident');
		$keterangan = $this->input->post('keterangan');
		$alasan  	= $this->input->post('alasan');
		$data = array(
			'evident'     	=> $evident,
			'alasan'		=> $alasan,
			'keterangan'	=> $keterangan,
			'ba'     		=> 1
		);
		$this->wo_model->update_ba_amunisi(array('sales_id' => $sales_id), $data);
		echo json_encode(
			array(
				"status"   => TRUE,
				'sales_id' => $sales_id
			)
		);
	}

	public function update_fcc()
	{
		$this->_validate_fcc();
		$sales_id  	= $this->input->post('id', NULL, TRUE);
		$mefrom   	= $this->input->post('mefrom', NULL, TRUE);
		$meid   	= $this->input->post('meid', NULL, TRUE);
		$status_fcc = $this->input->post('status_fcc', NULL, TRUE);
		$unit = $this->input->post('unit', NULL, TRUE);
		$keterangan = $this->input->post('keterangan', NULL, TRUE);
		if ($status_fcc == '41') {
			$statusnya = 'wait_fcc';
			$lognya    = '22';
			$pesannya  = 'WAIT FCC';
		} elseif ($status_fcc == '42') {
			$statusnya = 'kndl_fcc';
			$lognya    = '23';
			$pesannya  = 'KENDALA FCC';
		} elseif ($status_fcc == '43') {
			$statusnya = 'prog_fcc';
			$lognya    = '24';
			$pesannya  = 'PROGRESS FCC';
		} elseif ($status_fcc == '1') {
			$statusnya = 'scbe';
			$lognya    = '25';
			$pesannya  = 'SCBE';
		}

		$dataus = array(
			'unit'				=> $unit,
			'status_id'     	=> $status_fcc,
			'status'			=> $statusnya,
			'keterangan'     	=> $keterangan,
			'tgl_done_fcc'      => $status_fcc == 1 ? date('Y-m-d H:i:s') : null,
			'update_by'			=> $this->session->userdata('user_id'),
			'tgl_update'		=> date('Y-m-d H:i:s')
		);
		$datalog = array(
			'sales_id'      => $sales_id,
			'action_by'     => $this->session->userdata('nama'),
			'action_on'     => date('Y-m-d H:i:s'),
			'action_status' => $lognya,
			'a_keterangan'  => strtoupper($keterangan)
		);

		print_r($dataus);

		$this->wo_model->update(array('sales_id' => $sales_id), $dataus);
		$this->db->insert('tb_log', $datalog);
		$dte = $this->db->get_where('tb_sales', array('sales_id' => $sales_id))->row_array();
		if ($dte['kategori'] == 1 && $statusnya == 'scbe') {
			$dtl = $dte['datel'];
			if ($dte['kategori'] == 1) {
				$kategori = 'DEAL, ODP READY';
			} elseif ($dte['kategori'] == 2) {
				$kategori = 'DEAL, ODP NOT READY';
			} elseif ($dte['kategori'] == 3) {
				$kategori = 'UNSC';
			}
			$pecahloc       = explode(',', $dte['lat_long']);
			$lat            = str_replace(" ", "", $pecahloc[0]);
			$lng            = str_replace(" ", "", $pecahloc[1]);

			$text = "ORDER\n";
			$text .= "JA$dte[sales_id] \n";
			$text .= "NAMA PELANGGAN : $dte[nama_pelanggan]\n";
			$text .= "CP : $dte[cp]\n";
			$text .= "ODP : $dte[odp]\n";
			$text .= "ALAMAT : $dte[alamat]\n";
			$text .= "JARAK TIANG : $dte[jarak_tiang]\n";
			$text .= "KATEGORI : $kategori\n";
			$text .= "MYIR : $dte[myir]\n";
			$text .= "PAKET : $dte[paket]\n";
			$text .= "SALES : $dte[fullname]\n";
			$text .= "LOKASI : \nhttps://www.google.co.id/maps/search/$lat,+$lng";

			$chatid = send_amunisi_grup($dtl, $unit);

			sendChat($chatid, $text);
		}

		/*send message to sales*/
		$telegram_id = $this->input->post('mefrom', NULL, TRUE);
		$updateby    = $this->session->userdata('nama');
		$message_text = "ORDER SET TO : ($pesannya) \n";
		$message_text .= "JA$sales_id\n";
		$message_text .= "KET :\n";
		$message_text .= "$keterangan \n\n";
		$message_text .= " ~ $updateby";
		sendMessage($telegram_id, $message_text, $meid);
		/*end of send message to sales*/
		echo json_encode(
			array(
				"status" => TRUE,
				'pesan' => '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>Well done!</b> Data successfully updated!</div>'
			)
		);
	}

	public function changeDatel()
	{
		$sales_id  	= $this->input->post('id', NULL, TRUE);
		$datel  	= $this->input->post('datel', NULL, TRUE);
		$keterangan = "Mengubah Datel menjadi $datel";

		$datalog = array(
			'sales_id'      => $sales_id,
			'action_by'     => $this->session->userdata('nama'),
			'action_on'     => date('Y-m-d H:i:s'),
			'action_status' => '111',
			'a_keterangan'  => strtoupper($keterangan)
		);

		$this->db->insert('tb_log', $datalog);

		$this->db->where('sales_id', $sales_id);
		$this->db->update('tb_sales', ['datel' => $datel]);

		// Broadcast To Grup Amunisi dan 
		$dta 	  = $this->db->get_where('tb_sales', array('sales_id' => $sales_id))->row_array();
		$unit = $dta['unit'];
		$pecahloc = explode(',', $dta['lat_long']);
		$lat      = str_replace(" ", "", $pecahloc[0]);
		$lng      = str_replace(" ", "", $pecahloc[1]);
		$salesman = getSalesman($dta['kode']) == 'NULL' ? $dta['kode'] :  getSalesman($dta['kode']);

		if ($dta['kategori'] == 1) {
			$kategori = 'DEAL, ODP READY';
		} elseif ($dta['kategori'] == 2) {
			$kategori = 'DEAL, ODP NOT READY';
		} elseif ($dta['kategori'] == 3) {
			$kategori = 'UNSC';
		}

		$text = "ORDER\n";
		$text .= "JA$dta[sales_id] \n";
		$text .= "NAMA PELANGGAN : $dta[nama_pelanggan]\n";
		$text .= "CP : $dta[cp]\n";
		$text .= "ODP : $dta[odp]\n";
		$text .= "ALAMAT : $dta[alamat]\n";
		$text .= "JARAK TIANG : $dta[jarak_tiang]\n";
		$text .= "KATEGORI : <b>$unit</b> $kategori\n";
		$text .= "MYIR : $dta[myir]\n";
		$text .= "PAKET : $dta[paket]\n";
		$text .= "SALES : $salesman\n";
		$text .= "LOKASI : \nhttps://www.google.co.id/maps/search/$lat,$lng";

		$chatid = send_amunisi_grup($datel, $unit);
		sendChatHtml($chatid, $text);

		echo json_encode(
			array(
				"status" => TRUE,
				"sales_id" => $sales_id
			)
		);
	}

	private function _validate_fcc()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->input->post('status_fcc') == '') {
			$data['inputerror'][] = 'status_fcc';
			$data['error_string'][] = 'STATUS is required!';
			$data['status'] = FALSE;
		}
		if ($this->input->post('datel') == '') {
			$data['inputerror'][] = 'datel';
			$data['error_string'][] = 'DATEL is required!';
			$data['status'] = FALSE;
		}
		if ($this->input->post('unit') == '') {
			$data['inputerror'][] = 'unit';
			$data['error_string'][] = 'UNIT is required!';
			$data['status'] = FALSE;
		}
		if ($data['status'] === FALSE) {
			echo json_encode($data);
			exit();
		}
	}
}

/* End of file Work_order.php */
/* Location: ./application/controllers/sales/Work_order.php */