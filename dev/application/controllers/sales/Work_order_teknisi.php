<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Work_order_teknisi extends MY_Controller
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

	public function job_today()
	{
		$get 	  = $this->input->get(NULL, TRUE);
		$datel 	  = $get['datel'];
		$kategori = $get['kategori'];
		$teknisi  = $get['teknisi'];
		$unit	  = $get['unit'];
		$segment  = getSegment($get['segment']);

		if ($teknisi == 'all') {
			$crew		 = $teknisi;
		} else {
			$id_teknisi = [];
			$cekTeknisi = $this->db->get_where('tb_teknisi', ['t_telegram_id' => $teknisi])->row_array();
			$cekCrewTeknisi = $this->db->get_where('tb_teknisi', ['crew' => $cekTeknisi['crew']])->result_array();
			foreach ($cekCrewTeknisi as $c) {
				array_push($id_teknisi, $c['t_telegram_id']);
			}

			$crew	= join(",", $id_teknisi);
		}

		$data['title'] 		    = 'Request SC';
		$data['subtitle'] 	    = 'Order ' . getTeknisi($teknisi) . ' Progress ' . kategori_progress($kategori) . ' Datel ' . $datel . ' Unit ' . strtoupper($unit);
		$data['datas'] 			= $this->wo_model->teknisi_progress_view($kategori, $datel, $crew, $segment, $unit)->result_array();
		$this->load->view('template', [
			'content' => $this->load->view('sales/work_order/deal/view/all', $data, true)
		]);
	}

	public function progress()
	{
		$get 	  = $this->input->get(NULL, TRUE);
		$datel 	  = $get['datel'];
		$kategori = $get['kategori'];
		$teknisi  = $get['teknisi'];
		$unit	  = $get['unit'];
		$segment  = getSegment($get['segment']);

		if ($teknisi == 'all') {
			$crew		 = $teknisi;
		} else {
			$id_teknisi = [];
			$cekTeknisi = $this->db->get_where('tb_teknisi', ['t_telegram_id' => $teknisi])->row_array();
			$cekCrewTeknisi = $this->db->get_where('tb_teknisi', ['crew' => $cekTeknisi['crew']])->result_array();
			foreach ($cekCrewTeknisi as $c) {
				array_push($id_teknisi, $c['t_telegram_id']);
			}

			$crew	= join(",", $id_teknisi);
		}

		$data['title'] 		    = 'Progress Order';
		$data['subtitle'] 	    = 'Order ' . getTeknisi($teknisi) . ' Progress ' . kategori_progress($kategori) . ' Datel ' . $datel . ' Unit ' . strtoupper($unit);
		$data['datas'] 			= $this->wo_model->teknisi_progress_view($kategori, $datel, $crew, $segment, $unit)->result_array();
		$data['teknisi'] 	 	= $this->wo_model->teknisi($datel)->result_array();
		$this->load->view('template', [
			'content' => $this->load->view('sales/work_order/amunisi/view/all', $data, true)
		]);
	}

	public function request_sc()
	{
		$get 	  = $this->input->get(NULL, TRUE);
		$datel 	  = $get['datel'];
		$kategori = $get['kategori'];
		$teknisi  = $get['teknisi'];
		$unit	  = $get['unit'];
		$segment  = getSegment($get['segment']);

		if ($teknisi == 'all') {
			$crew		 = $teknisi;
		} else {
			$id_teknisi = [];
			$cekTeknisi = $this->db->get_where('tb_teknisi', ['t_telegram_id' => $teknisi])->row_array();
			$cekCrewTeknisi = $this->db->get_where('tb_teknisi', ['crew' => $cekTeknisi['crew']])->result_array();
			foreach ($cekCrewTeknisi as $c) {
				array_push($id_teknisi, $c['t_telegram_id']);
			}

			$crew	= join(",", $id_teknisi);
		}

		$data['title'] 		    = 'Request SC';
		$data['subtitle'] 	    = 'Order ' . getTeknisi($teknisi) . ' Progress ' . kategori_progress($kategori) . ' Datel ' . $datel . ' Unit ' . strtoupper($unit);
		$data['datas'] 			= $this->wo_model->teknisi_progress_view($kategori, $datel, $crew, $segment, $unit)->result_array();
		$this->load->view('template', [
			'content' => $this->load->view('sales/work_order/deal/view/all', $data, true)
		]);
	}

	public function kendala()
	{
		$get 	  = $this->input->get(NULL, TRUE);
		$datel 	  = $get['datel'];
		$kategori = $get['kategori'];
		$teknisi  = $get['teknisi'];
		$unit	  = $get['unit'];
		$segment  = getSegment($get['segment']);

		if ($teknisi == 'all') {
			$crew		 = $teknisi;
		} else {
			$id_teknisi = [];
			$cekTeknisi = $this->db->get_where('tb_teknisi', ['t_telegram_id' => $teknisi])->row_array();
			$cekCrewTeknisi = $this->db->get_where('tb_teknisi', ['crew' => $cekTeknisi['crew']])->result_array();
			foreach ($cekCrewTeknisi as $c) {
				array_push($id_teknisi, $c['t_telegram_id']);
			}

			$crew	= join(",", $id_teknisi);
		}

		$data['title'] 		    = 'Kendala';
		$data['subtitle'] 	    = 'Order ' . getTeknisi($teknisi) . ' Progress ' . kategori_progress($kategori) . ' Datel ' . $datel . ' Unit ' . strtoupper($unit);
		$data['kate'] 	    	= $kategori;
		$data['datas'] 			= $this->wo_model->teknisi_progress_view($kategori, $datel, $crew, $segment, $unit)->result_array();
		$this->load->view('template', [
			'content' => $this->load->view('sales/work_order/kendala/view/all', $data, true)
		]);
	}

	public function provi()
	{
		$get 	 	= $this->input->get(NULL, TRUE);
		$datel 	    = $get['datel'];
		$kategori   = $get['kategori'];
		$teknisi    = $get['teknisi'];
		$unit	  	= $get['unit'];
		$segment    = getSegment($get['segment']);

		if ($teknisi == 'all') {
			$crew		 = $teknisi;
		} else {
			$id_teknisi = [];
			$cekTeknisi = $this->db->get_where('tb_teknisi', ['t_telegram_id' => $teknisi])->row_array();
			$cekCrewTeknisi = $this->db->get_where('tb_teknisi', ['crew' => $cekTeknisi['crew']])->result_array();
			foreach ($cekCrewTeknisi as $c) {
				array_push($id_teknisi, $c['t_telegram_id']);
			}

			$crew	= join(",", $id_teknisi);
		}

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
		$data['subtitle'] 	    = 'Order ' . getTeknisi($teknisi) . ' Progress ' . kategori_progress($kategori) . ' Datel ' . $datel . ' Unit ' . strtoupper($unit);
		$data['teknisi'] 	 	= $this->wo_model->teknisi($datel)->result_array();
		$data['datas'] 			= $this->wo_model->teknisi_progress_view($kategori, $datel, $crew, $segment, $unit)->result_array();
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
			$cekorder = $this->db->query("SELECT sales_id, status_id FROM tb_sales where sales_id='" . $pecah_id[$index] . "' AND status_id = 1")->num_rows();
			if ($cekorder > 0) {
				$this->wo_model->update(array('sales_id' => $pecah_id[$index]), $datas);
				$query = $this->db->get_where('tb_sales', array('sales_id' => $pecah_id[$index]))->row_array();

				/*save log data*/
				$queryt = $this->db->get_where('tb_teknisi', array('t_telegram_id' => $teknisi))->row_array();
				$datalog = array(
					'sales_id' 		=> $pecah_id[$index],
					'action_by' 	=> $this->session->userdata('nama'),
					'action_on' 	=> date('Y-m-d H:i:s'),
					'action_status' => 2,
					'a_keterangan' 	=> 'ORDER DI PROGRESS KE TEKNISI ' . $queryt['nama_teknisi']
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
				$message_text .= "LOKASI : \nhttps://www.google.co.id/maps/search/$lat,+$lng";
				$index++;
				sendChatHtml($telegram_id, $message_text);
			}
		}

		echo json_encode(
			array(
				"status" => TRUE,
				'pesan' => '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>Well done!</b> ' . $index . ' order sucessfully send to teknisi!</div>'
			)
		);
	}

	public function create_kendala()
	{
		$this->_validate();
		$sales_id  	= $this->input->post('id', NULL, TRUE);
		$mefrom   	= $this->input->post('mefrom', NULL, TRUE);
		$meid   	= $this->input->post('meid', NULL, TRUE);
		$kendala   	= $this->input->post('kendala', NULL, TRUE);
		$loc_cust   = $this->input->post('loc_cust', NULL, TRUE);
		$keterangan = $this->input->post('keterangan', NULL, TRUE);

		$ceksales_id = $this->db->query("SELECT sales_id FROM tb_kendala WHERE sales_id ='" . $sales_id . "'")->num_rows();
		if ($ceksales_id <= 0) {
			// jika belum ada
			if ($kendala == 'SUDAH PS') {
				$dataps = array(
					'status_id'     	=> 10,
					'status'			=> 'ps',
					'keterangan'     	=> $keterangan,
					'update_by'			=> $this->session->userdata('user_id'),
					'tgl_update'		=> date('Y-m-d H:i:s')
				);

				$datalog = array(
					'sales_id'      => $sales_id,
					'action_by'     => $this->session->userdata('nama'),
					'action_on'     => date('Y-m-d H:i:s'),
					'action_status' => 10,
					'a_keterangan'  => $keterangan
				);
				$this->wo_model->update_kendala(array('sales_id' => $sales_id), $dataps);
			} else {
				if ($kendala == 'RNA' || $kendala == 'ALAMAT' || $kendala == 'PENDING') {
					$jenis_kendala = 'P';
				} elseif ($kendala == 'BATAL') {
					$jenis_kendala = 'B';
				} else {
					$jenis_kendala = 'J';
				}
				$data = array(
					'sales_id'     		=> $sales_id,
					'jenis_kendala'		=> $jenis_kendala,
					'kendala'			=> $kendala,
					'keterangan'     	=> strtoupper($keterangan),
					'post_by'			=> $this->session->userdata('user_id'),
					'post_on'			=> date('Y-m-d H:i:s'),
					'last_update'		=> date('Y-m-d H:i:s')
				);
				$dataus = array(
					'status_id'     	=> 6,
					'status'			=> 'K' . $jenis_kendala,
					'keterangan'     	=> $keterangan,
					'loc_cust'			=> $loc_cust,
					'update_by'			=> $this->session->userdata('user_id'),
					'tgl_update'		=> date('Y-m-d H:i:s')
				);
				$datalog = array(
					'sales_id'      => $sales_id,
					'action_by'     => $this->session->userdata('nama'),
					'action_on'     => date('Y-m-d H:i:s'),
					'action_status' => 6,
					'a_keterangan'  => strtoupper($keterangan)
				);

				$this->db->insert('tb_kendala', $data);
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
					"status" => TRUE,
					'pesan' => '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>Well done!</b> Data successfully reported as kendala ' . $kendala . '!</div>'
				)
			);
		} else {
			// jika sudah ada
			echo json_encode(
				array(
					"status" => TRUE,
					'pesan' => '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>Failed!</b> JA' . $sales_id . ' sudah dilaporkan sebagai kendala yang sama!</div>'
				)
			);
		}
	}

	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;
		$sales_id = $this->input->post('sales_id');
		$cek  = $this->db->query("SELECT sales_id FROM tb_sales where sales_id='" . $sales_id . "'")->num_rows();

		if ($this->input->post('kendala') == '') {
			$data['inputerror'][] = 'kendala';
			$data['error_string'][] = 'KENDALA is required!';
			$data['status'] = FALSE;
		}
		if ($this->input->post('keterangan') == '') {
			$data['inputerror'][] = 'keterangan';
			$data['error_string'][] = 'Keterangan is required!';
			$data['status'] = FALSE;
		}
		if (!empty($this->input->post('loc_cust'))) {
			if ($this->input->post('kendala') != "SUDAH PS" && $this->input->post('kendala') != "RNA" && $this->input->post('kendala') != "ALAMAT" && $this->input->post('kendala') != "PENDING") {
				if ($this->input->post('loc_cust') == '') {
					$data['inputerror'][] = 'loc_cust';
					$data['error_string'][] = 'Lokasi Pelanggan is required!';
					$data['status'] = FALSE;
				} elseif (stripos($this->input->post('loc_cust'), 'https') !== false) {
					$data['inputerror'][] = 'loc_cust';
					$data['error_string'][] = 'Koordinat tidak valid.';
					$data['status'] = FALSE;
				} elseif (stripos($this->input->post('loc_cust'), ',') == false) {
					$data['inputerror'][] = 'loc_cust';
					$data['error_string'][] = 'Koordinat tidak valid.';
					$data['status'] = FALSE;
				}
			}
		}
		if ($cek > 0) {
			$data['inputerror'][] = 'kendala';
			$data['error_string'][] = 'JA' . $sales_id . ' sudah terupdate sebagai kendala.';
			$data['status'] = FALSE;
		}

		if ($data['status'] === FALSE) {
			echo json_encode($data);
			exit();
		}
	}
}

/* End of file Work_order.php */
/* Location: ./application/controllers/sales/Work_order_teknisi.php */