<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Construction extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('logged_in') != TRUE) {
			redirect(base_url("auth"));
		}

		if (menuConstruction($this->session->userdata('level')) == false) {
			redirect(base_url("welcome"));
		}
	}

	public function index($segment = 'all', $unit = 'all', $by_tgl = 'tgl_ja', $start = null, $end = null)
	{
		$segment = getSegment($segment);
		$data['title'] 			= 'Jarvis Sales';
		$data['subtitle'] 		= 'Follow Up Kendala Construction';
		$data['segment'] 		= $segment;
		$data['unit'] 		    = $unit;
		$data['by_tgl']         = $by_tgl;
		$data['start']          = $start;
		$data['end']            = $end;
		$data['list_k']			= $this->construction_model->resume_kendala($segment, $unit, $by_tgl, $start, $end)->result_array();
		$data['k_total']		= $this->construction_model->resume_total_kendala($segment, $unit, $by_tgl, $start, $end)->row_array();
		$data['list_c']			= $this->construction_model->resume_const($segment, $unit, $by_tgl, $start, $end)->result_array();
		$data['c_total']		= $this->construction_model->resume_total_const($segment, $unit, $by_tgl, $start, $end)->row_array();
		$this->load->view('template', [
			'content' => $this->load->view('sales/construction/tabel', $data, true)
		]);
	}

	public function filter($by_tgl = 'tgl_ja', $start = null, $end = null)
	{
		$data['title'] 			= 'Jarvis Sales';
		$data['subtitle'] 		= 'Follow Up Kendala Construction';
		$data['segment']        = 'all';
		$data['unit']           = 'all';
		$data['start']          = $start;
		$data['end']            = $end;
		$data['list_k']			= $this->construction_model->resume_kendala($by_tgl, $start, $end)->result_array();
		$data['k_total']		= $this->construction_model->resume_total_kendala($by_tgl, $start, $end)->row_array();
		$data['list_c']			= $this->construction_model->resume_const($by_tgl, $start, $end)->result_array();
		$data['c_total']		= $this->construction_model->resume_total_const($by_tgl, $start, $end)->row_array();
		$this->load->view('template', [
			'content' => $this->load->view('sales/construction/tabel_filtered', $data, true)
		]);
	}

	public function show()
	{
		$get 	 = $this->input->get(NULL, TRUE);
		$datel 	 = $get['datel'];
		$order   = $get['order'];
		$unit    = $get['unit'];
		$by_tgl  = $get['by_tgl'];
		$start   = $get['start'];
		$end     = $get['end'];
		$cons 	 = getConstruction($get['cons']);
		if ($cons == 44) {
			$const = 'KENDALA GOLIVE';
		} elseif ($cons == 11) {
			$const = 'SURVEY & PLAN';
		} elseif ($cons == 22) {
			$const = 'DEPLOYMENT';
		} elseif ($cons == 33) {
			$const = 'PROSES GO LIVE';
		} elseif ($cons == 55) {
			$const = 'REDESAIN';
		} elseif ($cons == 66) {
			$const = 'APPROVAL AMO';
		} elseif ($cons == 77) {
			$const = 'NEXT PROJECT';
		} elseif ($cons == 88) {
			$const = 'SELESAI GOLIVE';
		} elseif ($cons == 99) {
			$const = 'TERMINATE';
		} elseif ($cons == 10) {
			$const = 'APPROVAL DATEL';
		} elseif ($cons == 100) {
			$const = 'REJECTED DATEL';
		} elseif ($cons == 'all') {
			$const = 'All Progress';
		} else {
			$const = 'UNDEFINED';
		}

		$data['title'] 		    = 'Under Construction';
		$data['subtitle'] 	    = 'Follow Up Contruction Order ' . $const;
		$data['datas'] 			= $this->construction_model->show_data($datel, $cons, $order, $unit, $by_tgl, $start, $end)->result_array();
		$this->load->view('template', [
			'content' => $this->load->view('sales/construction/data', $data, true)
		]);
	}

	public function show_filtered($datel, $cons, $by_tgl, $start, $end)
	{
		$const = getConstruction($cons);
		if ($const == 44) {
			$constr = 'KENDALA GOLIVE';
		} elseif ($const == 11) {
			$constr = 'SURVEY & PLAN';
		} elseif ($const == 22) {
			$constr = 'DEPLOYMENT';
		} elseif ($const == 33) {
			$constr = 'PROSES GO LIVE';
		} elseif ($const == 55) {
			$constr = 'REDESAIN';
		} elseif ($const == 66) {
			$constr = 'APPROVAL AMO';
		} elseif ($const == 77) {
			$constr = 'NEXT PROJECT';
		} elseif ($const == 88) {
			$constr = 'SELESAI GOLIVE';
		} elseif ($const == 'all') {
			$constr = 'All Progress';
		}
		$data['title'] 		    = 'Under Construction';
		$data['subtitle'] 	    = ' Contruction ' . $constr . ' Datel ' . $datel . ' Tanggal ' . date_indo($start) . ' - ' . date_indo($end) . ' ';
		$data['datas'] 			= $this->construction_model->show_filtered_data($datel, $const, $by_tgl, $start, $end)->result_array();
		$this->load->view('template', [
			'content' => $this->load->view('sales/construction/data', $data, true)
		]);
	}

	public function detail($id)
	{
		$data = $this->construction_model->get_by_id($id);
		echo json_encode($data);
	}

	public function update()
	{
		//$this->_validate();
		$status_up   = $this->input->post('status_update');
		$id_cons 	 = $this->input->post('id');
		$new_project_id = $this->input->post('project_id');
		$data_sales  = $this->db->get_where('tb_construction', array('construction_id' => $id_cons))->row_array();
		$id_sales    = $data_sales['sales_id'];
		$id_project  = $data_sales['project_id'];
		$keterangan  = !empty($this->input->post('ket_update')) ? $this->input->post('ket_update') : null;

		if (!empty($new_project_id)) {
			$project_id_input = intval(preg_replace('/[^0-9]+/', '', $this->input->post('project_id')), 10);
			$query = $this->db->get_where('tb_project', array('project_code' => $project_id_input), 1)->row_array();
			$get_odp_cons = $this->db->get_where('tb_construction', array('project_id' => $query['project_id']), 1)->row_array();

			$consprj = array(
				'last_update'    => date('Y-m-d H:i:s'),
				'project_id'     => $query['project_id'],
				'updated_by'     => $this->session->userdata('user_id'),
				'keterangan'     => $keterangan,
				'status'  		 => $query['status'],
				'odp_plan'       => !empty($get_odp_cons['odp_plan']) ? $get_odp_cons['odp_plan'] : null
			);
			$this->construction_model->update(array('construction_id' => $this->input->post('id')), $consprj);

			$data2 = array(
				'status'        => getStatusCons($query['status']),
				'status_id'     => 13,
				'keterangan'    => $keterangan,
				'tgl_update'    => date('Y-m-d H:i:s')
			);
			$this->construction_model->update_sales($id_sales, $data2);

			if ($query['jenis_prj'] == 'PT2 SIMPLE') {
				$lognya = 26;
			} elseif ($query['jenis_prj'] == 'PT3' || $query['jenis_prj'] == 'OTHERS') {
				$lognya = 28;
			} else {
				$lognya = 27;
			}

			$datalog = array(
				'sales_id'      => $id_sales,
				'action_by'     => $this->session->userdata('nama'),
				'action_on'     => date('Y-m-d H:i:s'),
				'action_status' => $lognya,
				'a_keterangan'  => strtoupper($keterangan)
			);
			$this->db->insert('tb_log', $datalog);
		} else {
			if ($status_up == 'MANJA ULANG') {
				$data2 = array(
					'status'        => 'remanja',
					'status_id'     => 1,
					'keterangan'    => $keterangan,
					'tgl_update'    => date('Y-m-d H:i:s'),
					'tgl_done_fcc'  => date('Y-m-d H:i:s')
				);

				$cons = array(
					'last_update'    => date('Y-m-d H:i:s'),
					'updated_by'     => $this->session->userdata('user_id'),
					'keterangan'     => $keterangan,
					'aktif'  		 => 0
				);

				$datalog = array(
					'sales_id'      => $id_sales,
					'action_by'     => $this->session->userdata('nama'),
					'action_on'     => date('Y-m-d H:i:s'),
					'action_status' => 31,
					'a_keterangan'  => strtoupper($keterangan)
				);
				$this->db->insert('tb_log', $datalog);

				broadcast_amunisi($id_sales, 'reorder');
			} elseif ($status_up == 'BATAL') {
				$data2 = array(
					'status_id'     	=> 6,
					'status'			=> 'KENDALA PELANGGAN',
					'kendala'			=> 'BATAL',
					'keterangan'     	=> $keterangan,
					'update_by'			=> $this->session->userdata('user_id'),
					'tgl_update'		=> date('Y-m-d H:i:s')
				);

				$cons = array(
					'last_update'    => date('Y-m-d H:i:s'),
					'updated_by'     => $this->session->userdata('user_id'),
					'keterangan'     => $keterangan,
					'aktif'  		 => 0
				);

				$datalog = array(
					'sales_id'      => $id_sales,
					'action_by'     => $this->session->userdata('nama'),
					'action_on'     => date('Y-m-d H:i:s'),
					'action_status' => 32,
					'a_keterangan'  => strtoupper($keterangan)
				);
				$this->db->insert('tb_log', $datalog);
			} elseif ($status_up == 'TERMINATE') {
				$data2 = array(
					'status_id'     	=> 6,
					'status'			=> 'TERMINATE',
					'kendala'			=> 'TERMINATE',
					'keterangan'     	=> $keterangan,
					'update_by'			=> $this->session->userdata('user_id'),
					'tgl_update'		=> date('Y-m-d H:i:s')
				);

				$cons = array(
					'last_update'    => date('Y-m-d H:i:s'),
					'updated_by'     => $this->session->userdata('user_id'),
					'keterangan'     => $keterangan,
					'aktif'  		 => 0
				);

				$datalog = array(
					'sales_id'      => $id_sales,
					'action_by'     => $this->session->userdata('nama'),
					'action_on'     => date('Y-m-d H:i:s'),
					'action_status' => 33,
					'a_keterangan'  => strtoupper($keterangan)
				);
				$this->db->insert('tb_log', $datalog);
			} else {
				$cons = array(
					'last_update'    => date('Y-m-d H:i:s'),
					'updated_by'     => $this->session->userdata('user_id'),
					'keterangan'     => $keterangan
				);
			}

			$this->construction_model->update_sales($id_sales, $data2);
			$this->construction_model->update(array('construction_id' => $this->input->post('id')), $cons);

			$cek_project  = $this->db->get_where('tb_construction', array('project_id' => $id_project, 'aktif' => 1))->result_array();
			if (empty($cek_project)) {
				$project_update = array(
					'last_update_status' => date('Y-m-d H:i:s'),
					'last_update_by' 	 => $this->session->userdata('user_id'),
					'progress' 			 => 'TERMINATE',
					'keterangan'     	 => $keterangan,
					'status'  		 	 => 99
				);
				$this->project_model->update(array('project_id' => $id_project), $project_update);
			}
		}

		echo json_encode(
			array(
				"status" => TRUE,
				'pesan' => '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>Well done!</b> Data successfully updated! Please Refresh The Page :)</div>'
			)
		);
	}

	public function search()
	{
		$search  = $this->input->post('search');
		$data['title']      = 'Sales Order';
		$data['subtitle']   = 'Hasil Pencarian JA' . $search . '';

		$data['results'] = $this->construction_model->search($search)->result_array();
		$this->load->view('template', [
			'content' => $this->load->view('sales/construction/result', $data, true)
		]);
	}

	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->input->post('status_update') == '') {
			$data['inputerror'][] = 'status_update';
			$data['error_string'][] = 'STATUS is required';
			$data['status'] = FALSE;
		}
		if ($this->input->post('ket_update') == '') {
			$data['inputerror'][] = 'ket_update';
			$data['error_string'][] = 'Keterangan is required';
			$data['status'] = FALSE;
		}
		if ($data['status'] === FALSE) {
			echo json_encode($data);
			exit();
		}
	}
}

/* End of file Kendala.php */
/* Location: ./application/controllers/sales/Kendala.php */