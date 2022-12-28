<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Project extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('logged_in') != TRUE) {
			redirect(base_url("auth"));
		}
	}

	public function index($start = null, $end = null)
	{
		$data['title'] 			= 'Jarvis Sales';
		$data['subtitle'] 		= 'Project Construction';
		$data['list_p']			= $this->project_model->resume_prj($start, $end)->result_array();
		$data['p_total']		= $this->project_model->resume_total_prj($start, $end)->row_array();
		$this->load->view('template', [
			'content' => $this->load->view('sales/project/tabel', $data, true)
		]);
	}

	public function new_project($kendala, $datel)
	{
		$data['title']      = 'New Project Construction';
		$data['subtitle']   = 'New Project Construction Datel ' . $datel . ' ';
		$kendala = getKendala($kendala);
		$data['datas'] 		= $this->kendala_model->show_data($datel, $kendala, 'all', 'all', 'all', 'create_project')->result_array();
		$this->load->view('template', [
			'content' => $this->load->view('sales/project/new', $data, true)
		]);
	}

	public function follow_up($project, $id)
	{
		$query = $this->db->get_where('tb_project', array('project_id' => $id))->row();
		$data['title']      = 'Follow Up Project';
		$data['subtitle']   = 'Follow Up Project ' . $query->project_code . ' - ' . $query->nama_lop . ' ';
		$jenis_mitra = $project == 'approval_amo' ? 'AMO' : 'DEPLOYER';
		$data['mitra']   = $this->db->get_where('tb_mitra', array('jenis_mitra' => $jenis_mitra))->result_array();
		if ($project == 'approval_amo') {
			$data['project'] = $this->db->get_where('tb_project', array('project_id' => $id))->row();
		} elseif ($project == 'deploy' || $project == 'redesain') {
			$data['project'] = $this->project_model->project_deployer($id);
		} else {
			$data['project'] = $this->db->get_where('tb_project', array('project_id' => $id))->row();
		}


		if ($project == 'approval_amo') {
			$this->load->view('template', [
				'content' => $this->load->view('sales/project/amo/follow_up', $data, true)
			]);
		} elseif ($project == 'deploy') {
			$this->load->view('template', [
				'content' => $this->load->view('sales/project/deploy/follow_up', $data, true)
			]);
		} elseif ($project == 'redesain') {
			$this->load->view('template', [
				'content' => $this->load->view('sales/project/redesain/follow_up', $data, true)
			]);
		}
	}

	public function golive($project, $id)
	{
		$query = $this->db->get_where('tb_project', array('project_id' => $id))->row();
		$data['title']      = 'Progress Go Live Project';
		$data['subtitle']   = 'Progress Go Live Project ' . $query->project_code . ' - ' . $query->nama_lop . ' ';
		$data['project']    = $this->project_model->project_record_deployer($id);

		$this->load->view('template', [
			'content' => $this->load->view('sales/project/deploy/golive', $data, true)
		]);
	}

	public function change_odp_plan()
	{
		if (!empty($this->input->post('new_odp_plan'))) {
			$this->db->set('odp_live', $this->input->post('new_odp_plan'));
			$this->db->where('odp_id', $this->input->post('odp_id'));
			$this->db->update('tb_odp_construction');

			echo json_encode(
				array(
					"status"    => TRUE,
				)
			);
		} else {
			echo json_encode(
				array(
					"status"    => FALSE,
				)
			);
		}
	}

	public function record($project, $id)
	{
		$query = $this->db->get_where('tb_project', array('project_id' => $id))->row();
		$data['title']      = 'Data Project';
		$data['subtitle']   = 'Data Project ' . $query->project_code . ' - ' . $query->nama_lop . ' ';

		if ($project == 'deploy' || $project == 'golive' || $project == 'redesain' || $project == 'kc') {
			$data['project'] = $this->project_model->project_record_deployer($id);
		} else {
			$data['project'] = $this->db->get_where('tb_project', array('project_id' => $id))->row();
		}

		if ($project == 'deploy' || $project == 'redesain') {
			$this->load->view('template', [
				'content' => $this->load->view('sales/project/deploy/record', $data, true)
			]);
		} else {
			$this->load->view('template', [
				'content' => $this->load->view('sales/project/golive/record', $data, true)
			]);
		}
	}

	public function create_project()
	{
		//$number_of_files = sizeof($_FILES['userfile']['tmp_name']);
		//$file   		 = $_FILES['userfile'];
		$nama_loop  = $this->input->post('nama_loop', NULL, TRUE);
		$jenis_prj  = $this->input->post('jenis_prj', NULL, TRUE);
		$link_gd    = $this->input->post('link_gd', NULL, TRUE);
		$lokasi   	= $this->input->post('lokasi', NULL, TRUE);
		$keterangan = !empty($this->input->post('keterangan_project', NULL, TRUE)) ? $this->input->post('keterangan_project', NULL, TRUE) : NULL;
		$datel 		= $this->input->post('datel', NULL, TRUE);
		$kendala 	= $this->input->post('kendala', NULL, TRUE);
		$nama_loop_folder  = str_replace(" ", "_", $this->input->post('nama_loop', NULL, TRUE));
		$digits = 3;
		$code_prj = rand(pow(10, $digits - 1), pow(10, $digits) - 1) . '' . date('is');

		if ($jenis_prj == 'PT2 SIMPLE') {
			$lognya = 26;
			$logpr = 1;
			$status_id = 10;
			$status_sales = "APPROVAL DATEL";
			$progress = 'APPROVAL DATEL';
		} elseif ($jenis_prj == 'PT3' || $jenis_prj == 'OTHERS' || $jenis_prj == 'STTF' || $jenis_prj == 'TCloud') {
			$lognya = 28;
			$logpr = 2;
			$status_id = 77;
			$status_sales = "NEXT PROJECT";
			$progress = 'NEXT PROJECT';
		} else {
			$lognya = 27;
			$logpr = 3;
			$status_id = 10;
			$status_sales = "APPROVAL DATEL";
			$progress = 'APPROVAL DATEL';
		}

		$datas = array(
			'datel'    			 => $datel,
			'nama_lop'    		 => $nama_loop,
			'link_gd'    		 => $link_gd,
			'project_code'		 => $code_prj,
			'jenis_prj'    		 => $jenis_prj,
			'lokasi'    		 => $lokasi,
			'keterangan'    	 => $keterangan,
			'status'			 => $status_id,
			'progress'           => $progress,
			'last_update_status' => date("Y-m-d H:i:s"),
			'last_update_by'     => $this->session->userdata('user_id')
		);
		$this->db->insert('tb_project', $datas);
		$project_id = $this->db->insert_id();

		$datalog_project = array(
			'project_id'    => $project_id,
			'action_by'     => $this->session->userdata('nama'),
			'action_on'     => date('Y-m-d H:i:s'),
			'action_status' => $logpr,
			'a_keterangan'  => $keterangan
		);
		$this->db->insert('tb_log_project', $datalog_project);

		$id_sales  = $this->input->post('sales_id_selected', NULL, TRUE);
		$odp_plan  = $this->input->post('odp_plan');
		$number_of_sales = sizeof($id_sales);
		$data_cons = array();
		$data_log  = array();
		$index_c   = 0;
		$data_sales = array(
			'status'        => $status_sales,
			'status_id'     => 13,
			'keterangan'    => $keterangan,
			'tgl_update'    => date('Y-m-d H:i:s')
		);
		for ($i = 0; $i < $number_of_sales; $i++) {
			$pecah_ja   = explode(',', $id_sales[$index_c]);
			$totalData  = sizeof($pecah_ja);
			$index_ja   = 0;
			for ($j = 0; $j < $totalData; $j++) {
				$cekConst = $this->db->get_where('tb_construction', array('sales_id' => $pecah_ja[$index_ja]))->row();
				if (empty($cekConst)) {
					array_push($data_cons, array(
						'last_update'    => date('Y-m-d H:i:s'),
						'sales_id'       => $pecah_ja[$index_ja],
						'odp_plan'       => $odp_plan[$index_c],
						'project_id'     => $project_id,
						'updated_by'     => $this->session->userdata('user_id'),
						'keterangan'     => $keterangan,
						'status'  		 => $status_id,
						'post_on'        => date('Y-m-d H:i:s'),
						'post_by'        => $this->session->userdata('user_id'),
					));
				} else {
					$cons = array(
						'project_id'     => $project_id,
						'last_update'    => date('Y-m-d H:i:s'),
						'updated_by' 	 => $this->session->userdata('user_id'),
						'keterangan'     => $keterangan,
						'status'  		 => $status_id,
						'aktif'			 => 1
					);
					$this->construction_model->update(array('sales_id' => $pecah_ja[$index_ja], 'aktif' => 1), $cons);
				}
				array_push($data_log, array(
					'sales_id'      => $pecah_ja[$index_ja],
					'action_by'     => $this->session->userdata('nama'),
					'action_on'     => date('Y-m-d H:i:s'),
					'action_status' => $lognya,
					'a_keterangan'  => strtoupper($keterangan)
				));
				$this->kendala_model->update_sales($pecah_ja[$index_ja], $data_sales);
				$index_ja++;
			}
			$index_c++;
		}
		$this->project_model->save_construction($data_cons);
		$this->project_model->save_log($data_log);

		// insert ODP
		$odp		= $this->input->post('odp_plan');
		$totalData	= sizeof($odp);
		$data2_odp  = array();
		$index      = 0;
		if (!empty($odp)) {
			for ($i = 0; $i < $totalData; $i++) {
				array_push($data2_odp, array(
					'project_id' => $project_id,
					'odp_name' 	 => $odp[$index],
					'odp_live' 	 => $odp[$index]
				));
				$index++;
			}
			$this->project_model->save_odp($data2_odp);
		}

		$this->session->set_flashdata('info', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Project ID <b>' . $code_prj . ' </b> Berhasil Dibuat!</div>');
		redirect('sales/project/new_project/' . $kendala . '/' . $datel . '', 'refresh');
	}

	public function approval_datel()
	{
		$status_up   = $this->input->post('status_update');
		$id_project  = $this->input->post('id');
		$keterangan  = !empty($this->input->post('ket_update')) ? $this->input->post('ket_update') : null;
		$jenis_prj   = $this->input->post('jenis_prj');
		$data_sales  = $this->db->get_where('tb_construction', array('project_id' => $id_project, 'aktif' => 1))->result_array();

		if ($status_up == '66') {
			if ($jenis_prj == 'PT2 SIMPLE') {
				$status_id = 22;
				$status_sales = "DEPLOY";
				$log_s = 44;
				$logpr = 16;
				$progress = 'PERSIAPAN DAN TUNJUK MITRA DEPLOYER';
			} elseif ($jenis_prj == 'PT3' || $jenis_prj == 'OTHERS' || $jenis_prj == 'STTF' || $jenis_prj == 'TCloud') {
				$status_id = 77;
				$status_sales = "NEXT PROJECT";
				$progress = 'NEXT PROJECT';
				$log_s = 44;
				$logpr = 16;
			} else {
				$status_id = 66;
				$status_sales = "APPROVAL AMO";
				$log_s = 44;
				$logpr = 16;
				$progress = 'APPROVAL AMO';
			}
		} elseif ($status_up == '55') {
			$status_sales = 'REDESAIN';
			$log_s = 36;
			$logpr = 18;
			$progress = 'REDESAIN';
			$status_id = 55;
		} else {
			$status_sales = 'REJECTED DATEL';
			$log_s = 45;
			$logpr = 17;
			$progress = 'REJECTED DATEL';
			$status_id = 100;
		}


		$project = array(
			'last_update_status' => date('Y-m-d H:i:s'),
			'last_update_by'     => $this->session->userdata('user_id'),
			'keterangan'         => $keterangan,
			'status'  		     => $status_id,
			'progress'           => $progress
		);

		$cons = array(
			'last_update'    => date('Y-m-d H:i:s'),
			'updated_by' 	 => $this->session->userdata('user_id'),
			'keterangan'     => !empty($this->input->post('ket_update')) ? $this->input->post('ket_update') : null,
			'status'  		 => $status_id
		);

		$datalog_project = array(
			'project_id'    => $id_project,
			'action_by'     => $this->session->userdata('nama'),
			'action_on'     => date('Y-m-d H:i:s'),
			'action_status' => $logpr,
			'a_keterangan'  => $keterangan
		);
		$this->db->insert('tb_log_project', $datalog_project);

		$data2 = array(
			'status'        => $status_sales,
			'status_id'     => 13,
			'keterangan'    => $this->input->post('ket_update'),
			'tgl_update'    => date('Y-m-d H:i:s')
		);

		if (!empty($data_sales)) {
			foreach ($data_sales as $value) {
				$id_sales = $value['sales_id'];
				$this->project_model->update_sales($id_sales, $data2);

				$datalog = array(
					'sales_id'      => $id_sales,
					'action_by'     => $this->session->userdata('nama'),
					'action_on'     => date('Y-m-d H:i:s'),
					'action_status' => $log_s,
					'a_keterangan'  => $this->input->post('ket_update')
				);
				$this->db->insert('tb_log', $datalog);
			}
		}

		$this->project_model->update(array('project_id' => $this->input->post('id')), $project);
		$this->construction_model->update(array('project_id' => $this->input->post('id'), 'aktif' => 1), $cons);

		echo json_encode(
			array(
				"status" => TRUE,
				'pesan' => '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>Well done!</b> Data successfully updated!</div>'
			)
		);
	}

	public function filter($start = null, $end = null)
	{
		$data['title'] 			= 'Jarvis Sales';
		$data['subtitle'] 		= 'Project Construction';
		$data['start']          = $start;
		$data['end']            = $end;
		$data['list_p']			= $this->project_model->resume_prj($start, $end)->result_array();
		$data['p_total']		= $this->project_model->resume_total_prj($start, $end)->row_array();
		$this->load->view('template', [
			'content' => $this->load->view('sales/project/tabel_filtered', $data, true)
		]);
	}

	public function show()
	{
		$get 	   = $this->input->get(NULL, TRUE);
		$datel 	 = $get['datel'];
		$mode 	 = !empty($get['mode']) ? $get['mode'] : 'data';
		$cons 	 = getConstruction($get['project']);
		if ($cons == 44) {
			$const = 'KENDALA GOLIVE';
		} elseif ($cons == 11) {
			$const = 'SURVEY & PLAN';
		} elseif ($cons == 22) {
			$const = 'DEPLOYMENT';
		} elseif ($cons == 33) {
			$const = 'GO LIVE';
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
		} elseif ($cons == 'all') {
			$const = 'All Progress';
		}
		$data['title'] 		    = 'Under Construction';
		$data['subtitle'] 	  = 'Project ' . $const . ' Datel ' . strtoupper($datel) . ' ';
		$data['datas'] 			  = $this->project_model->show_data($datel, $cons)->result_array();
		$jenis_mitra = $get['project'] == 'approval_amo' ? 'AMO' : 'DEPLOYER';
		$data['project']        = $get['project'];
		$data['mitra'] = $this->db->get_where('tb_mitra', array('jenis_mitra' => $jenis_mitra))->result_array();
		if ($get['project'] == 'next_project' || $get['project'] == 'terminate') {
			$this->load->view('template', [
				'content' => $this->load->view('sales/project/next_project', $data, true)
			]);
		} elseif ($get['project'] == 'deploy') {
			if ($mode == 'data') {
				$this->load->view('template', [
					'content' => $this->load->view('sales/project/deploy/data', $data, true)
				]);
			} else {
				$data['list_pr']		= $this->project_model->deploy_progress($datel)->result_array();
				$data['pr_total']		= $this->project_model->deploy_progress_total($datel)->row_array();
				$this->load->view('template', [
					'content' => $this->load->view('sales/project/deploy/pivot', $data, true)
				]);
			}
		} elseif ($get['project'] == 'golive') {
			$this->load->view('template', [
				'content' => $this->load->view('sales/project/golive/data', $data, true)
			]);
		} elseif ($get['project'] == 'redesain') {
			$this->load->view('template', [
				'content' => $this->load->view('sales/project/redesain/data', $data, true)
			]);
		} elseif ($get['project'] == 'kc') {
			$this->load->view('template', [
				'content' => $this->load->view('sales/project/kendala_live/data', $data, true)
			]);
		} else {
			$this->load->view('template', [
				'content' => $this->load->view('sales/project/data', $data, true)
			]);
		}
	}

	public function show_deploy()
	{
		$get 	     = $this->input->get(NULL, TRUE);
		$datel 	   = $get['datel'];
		$progress  = progress_deploy($get['progress']);
		$data['title'] 		    = 'Progress Deployer';
		$data['subtitle'] 	  = 'Progress Deployer ' . $progress . ' Datel ' . strtoupper($datel) . ' ';
		$data['datas'] 			  = $this->project_model->show_data_progress($datel, $progress)->result_array();
		$data['project']      = 'deploy';
		$this->load->view('template', [
			'content' => $this->load->view('sales/project/deploy/progress', $data, true)
		]);
	}

	public function show_filtered($datel, $cons, $start, $end)
	{
		$const = getConstruction($cons);
		if ($const == 44) {
			$constr = 'TERKENDALA';
		} elseif ($const == 11) {
			$constr = 'SURVEY & PLAN';
		} elseif ($const == 22) {
			$constr = 'DEPLOYMENT';
		} elseif ($const == 33) {
			$constr = 'GO LIVE';
		} elseif ($const == 55) {
			$constr = 'REDESAIN';
		} elseif ($const == 66) {
			$constr = 'APPROVAL AMO';
		} elseif ($const == 77) {
			$constr = 'NEXT PROJECT';
		} elseif ($const == 88) {
			$const = 'SELESAI GOLIVE';
		} elseif ($cons == 99) {
			$const = 'TERMINATE';
		} elseif ($cons == 10) {
			$const = 'APPROVAL DATEL';
		} elseif ($const == 'all') {
			$constr = 'All Progress';
		}
		$data['title'] 		    = 'Under Construction';
		$data['subtitle'] 	    = ' Project ' . $constr . ' Datel ' . $datel . ' Tanggal ' . date_indo($start) . ' - ' . date_indo($end) . ' ';
		$data['project'] 		= $const;
		$data['datas'] 			= $this->project_model->show_filtered_data($datel, $const, $start, $end)->result_array();
		$this->load->view('template', [
			'content' => $this->load->view('sales/project/data', $data, true)
		]);
	}

	public function detail($id)
	{
		$data = $this->project_model->get_by_id($id);
		echo json_encode($data);
	}

	public function download_kml($id)
	{
		$row = $this->db->get_where('tb_project', array('project_id' => $id))->row();

		$this->load->helper('download');
		force_download("./uploads/project/" . str_replace(' ', '_', $row->nama_lop) . "/" . $row->file_kml, NULL);
	}

	public function download_mcore($id)
	{
		$row = $this->db->get_where('tb_project', array('project_id' => $id))->row();

		$this->load->helper('download');
		force_download("./uploads/project/" . str_replace(' ', '_', $row->nama_lop) . "/" . $row->file_mc, NULL);
	}

	public function download_golive_mc($id)
	{
		$row = $this->db->get_where('tb_deployer', array('project_id' => $id))->row();
		$project = $this->db->get_where('tb_project', array('project_id' => $id))->row();
		$this->load->helper('download');
		force_download("./uploads/project/" . str_replace(' ', '_', $project->nama_lop) . "/golive/" . $row->file_maincore, NULL);
	}

	public function download_golive_kml($id)
	{
		$row = $this->db->get_where('tb_deployer', array('project_id' => $id))->row();
		$project = $this->db->get_where('tb_project', array('project_id' => $id))->row();
		$this->load->helper('download');
		force_download("./uploads/project/" . str_replace(' ', '_', $project->nama_lop) . "/golive/" . $row->file_kml, NULL);
	}

	public function download_golive_foto_luar_odp($id)
	{
		$row = $this->db->get_where('tb_deployer', array('project_id' => $id))->row();
		$project = $this->db->get_where('tb_project', array('project_id' => $id))->row();
		$this->load->helper('download');
		force_download("./uploads/project/" . str_replace(' ', '_', $project->nama_lop) . "/golive/" . $row->foto_luar_odp, NULL);
	}

	public function download_golive_foto_dalam_odp($id)
	{
		$row = $this->db->get_where('tb_deployer', array('project_id' => $id))->row();
		$project = $this->db->get_where('tb_project', array('project_id' => $id))->row();
		$this->load->helper('download');
		force_download("./uploads/project/" . str_replace(' ', '_', $project->nama_lop) . "/golive/" . $row->foto_dalam_odp, NULL);
	}

	public function download_golive_foto_terminasi_odc($id)
	{
		$row = $this->db->get_where('tb_deployer', array('project_id' => $id))->row();
		$project = $this->db->get_where('tb_project', array('project_id' => $id))->row();
		$this->load->helper('download');
		force_download("./uploads/project/" . str_replace(' ', '_', $project->nama_lop) . "/golive/" . $row->foto_terminasi_odc, NULL);
	}

	public function download_golive_foto_terminasi_ftm($id)
	{
		$row = $this->db->get_where('tb_deployer', array('project_id' => $id))->row();
		$project = $this->db->get_where('tb_project', array('project_id' => $id))->row();
		$this->load->helper('download');
		force_download("./uploads/project/" . str_replace(' ', '_', $project->nama_lop) . "/golive/" . $row->foto_terminasi_ftm, NULL);
	}

	public function update_amo()
	{
		$this->_validate_amo();
		$status_up   = $this->input->post('status_update');
		$id_project  = $this->input->post('id');

		if ($status_up == '22') {
			$progress = 'PERSIAPAN DAN TUNJUK MITRA DEPLOYER';
			$log_p = 4;
			$log_s = 34;
		} elseif ($status_up == '55') {
			$progress = 'REDESAIN';
			$log_p = 15;
			$log_s = 36;
		} else {
			$progress = 'NEXT PROJECT';
			$log_p = 5;
			$log_s = 35;
		}

		$project = array(
			'last_update_status' => date('Y-m-d H:i:s'),
			'last_update_by'     => $this->session->userdata('user_id'),
			'keterangan'         => !empty($this->input->post('ket_update')) ? $this->input->post('ket_update') : null,
			'status'  		     => $this->input->post('status_update'),
			'progress'           => $progress
		);

		$cons = array(
			'last_update'    => date('Y-m-d H:i:s'),
			'updated_by' 	 => $this->session->userdata('user_id'),
			'keterangan'     => !empty($this->input->post('ket_update')) ? $this->input->post('ket_update') : null,
			'status'  		 => $this->input->post('status_update')
		);

		$datalog_project = array(
			'project_id'    => $id_project,
			'action_by'     => $this->session->userdata('nama'),
			'action_on'     => date('Y-m-d H:i:s'),
			'action_status' => $log_p,
			'a_keterangan'  => $this->input->post('ket_update')
		);
		$this->db->insert('tb_log_project', $datalog_project);

		if ($status_up == '22') {
			$data2 = array(
				'status'        => 'DEPLOY',
				'status_id'     => 13,
				'keterangan'    => $this->input->post('ket_update'),
				'tgl_update'    => date('Y-m-d H:i:s')
			);
			$cekdep = $this->db->query("SELECT project_id FROM tb_deployer WHERE project_id = $id_project ")->num_rows();
			if ($cekdep > 0) {
				$deployer_update = array(
					'last_update_status' 		 => date('Y-m-d H:i:s'),
					'mitra_deployer'     		 => null,
					'progress'			 		 => 'PERSIAPAN DAN TUNJUK MITRA DEPLOYER',
					'file_maincore'		 		 => null,
					'file_kml'		 			 => null,
					'foto_luar_odp'		 		 => null,
					'foto_dalam_odp'		 	 => null,
					'foto_terminasi_odc'		 => null,
					'evident_delivery_material'	 => null,
					'evident_tanam_tiang'		 => null,
					'evident_tarik_kabel'		 => null,
					'evident_install_odp'		 => null,
					'evident_penyambungan'		 => null,
					'evident_selesai_fisik'		 => null,
					'id_valins'		 			 => null,
				);
				$this->project_model->update_deployer(array('project_id' => $this->input->post('id')), $deployer_update);
			} else {
				$deployer = array(
					'last_update_status' => date('Y-m-d H:i:s'),
					'project_id'         => $id_project,
					'progress'			 => 'PERSIAPAN DAN TUNJUK MITRA DEPLOYER',
				);
				$this->db->insert('tb_deployer', $deployer);
			}
		} else if ($status_up == '55') {
			$data2 = array(
				'status'        => 'REDESAIN',
				'status_id'     => 13,
				'keterangan'    => !empty($this->input->post('ket_update')) ? $this->input->post('ket_update') : null,
				'tgl_update'    => date('Y-m-d H:i:s')
			);
		} else {
			$data2 = array(
				'status'        => 'NEXT PROJECT',
				'status_id'     => 13,
				'keterangan'    => $this->input->post('ket_update'),
				'tgl_update'    => date('Y-m-d H:i:s')
			);
		}

		$data_sales  = $this->db->get_where('tb_construction', array('project_id' => $id_project, 'aktif' => 1))->result_array();
		if (!empty($data_sales)) {
			foreach ($data_sales as $value) {
				$id_sales = $value['sales_id'];
				$this->project_model->update_sales($id_sales, $data2);

				$datalog = array(
					'sales_id'      => $id_sales,
					'action_by'     => $this->session->userdata('nama'),
					'action_on'     => date('Y-m-d H:i:s'),
					'action_status' => $log_s,
					'a_keterangan'  => $this->input->post('ket_update')
				);
				$this->db->insert('tb_log', $datalog);
			}
		}

		$data_amo  = $this->db->get_where('tb_optima', ['project_id' => $id_project])->row_array();
		if (!empty($data_amo)) {
			$amo = [
				'mitra_amo'		     => !empty($this->input->post('mitra_amo')) ? $this->input->post('mitra_amo') : null,
				'approve'			 => $status_up == '22' ? 1 : 0,
				'keterangan'         => !empty($this->input->post('ket_update')) ? $this->input->post('ket_update') : null,
				'last_update_status' => date('Y-m-d H:i:s'),
			];

			$this->project_model->update_amo(['project_id' => $id_project], $amo);
		} else {
			$amo = [
				'project_id'    	 => $id_project,
				'mitra_amo'		     => !empty($this->input->post('mitra_amo')) ? $this->input->post('mitra_amo') : null,
				'approve'			 => $status_up == '22' ? 1 : 0,
				'keterangan'         => !empty($this->input->post('ket_update')) ? $this->input->post('ket_update') : null,
				'last_update_status' => date('Y-m-d H:i:s'),
			];
			$this->db->insert('tb_optima', $amo);
		}

		$this->project_model->update(array('project_id' => $this->input->post('id')), $project);
		$this->construction_model->update(array('project_id' => $this->input->post('id'), 'aktif' => 1), $cons);

		echo json_encode(
			array(
				"status" => TRUE,
				'pesan' => '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>Well done!</b> Data successfully updated!</div>'
			)
		);
	}

	public function update_mitra_deployer()
	{
		$id_project  = $this->input->post('id');
		$data_sales  = $this->db->get_where('tb_construction', array('project_id' => $id_project, 'aktif' => 1))->result_array();
		if (!empty($this->input->post('status_update')) && ($this->input->post('status_update') == 55)) {
			$project = array(
				'last_update_status' => date('Y-m-d H:i:s'),
				'last_update_by' 	 => $this->session->userdata('user_id'),
				'keterangan'     	 => !empty($this->input->post('ket_update')) ? $this->input->post('ket_update') : null,
				'progress'		 	 => 'REDESAIN',
				'status'			 => 55
			);

			$cons = array(
				'last_update'    => date('Y-m-d H:i:s'),
				'updated_by' 	 => $this->session->userdata('user_id'),
				'keterangan'     => !empty($this->input->post('ket_update')) ? $this->input->post('ket_update') : null,
				'status'  		 => $this->input->post('status_update')
			);
			$this->construction_model->update(array('project_id' => $this->input->post('id'), 'aktif' => 1), $cons);

			$datalog_project = array(
				'project_id'    => $id_project,
				'action_by'     => $this->session->userdata('nama'),
				'action_on'     => date('Y-m-d H:i:s'),
				'action_status' => 6,
				'a_keterangan'  => $this->input->post('ket_update')
			);
			$this->db->insert('tb_log_project', $datalog_project);

			$data2 = array(
				'status'        => 'REDESAIN',
				'status_id'     => 13,
				'keterangan'    => $this->input->post('ket_update'),
				'tgl_update'    => date('Y-m-d H:i:s')
			);

			if (!empty($data_sales)) {
				foreach ($data_sales as $value) {
					$id_sales = $value['sales_id'];
					$this->project_model->update_sales($id_sales, $data2);

					$datalog = array(
						'sales_id'      => $id_sales,
						'action_by'     => $this->session->userdata('nama'),
						'action_on'     => date('Y-m-d H:i:s'),
						'action_status' => 36,
						'a_keterangan'  => $this->input->post('ket_update')
					);
					$this->db->insert('tb_log', $datalog);
				}
			}
		} else {

			$project = array(
				'last_update_status' => date('Y-m-d H:i:s'),
				'last_update_by' 	 => $this->session->userdata('user_id'),
				'keterangan'     	 => !empty($this->input->post('ket_update')) ? $this->input->post('ket_update') : null,
				'progress'		 	 => 'DELIVERY MATERIAL'
			);

			$data_deployer  = $this->db->get_where('tb_deployer', ['project_id' => $id_project])->row_array();
			if (!empty($data_deployer)) {
				$deployer = [
					'last_update_status' => date('Y-m-d H:i:s'),
					'mitra_deployer'	 => !empty($this->input->post('mitra_deployer')) ? $this->input->post('mitra_deployer') : null,
					'progress'			 => 'DELIVERY MATERIAL'
				];

				$this->project_model->update_deployer(['project_id' => $this->input->post('id')], $deployer);
			} else {
				$deployer = array(
					'project_id'		 => $id_project,
					'last_update_status' => date('Y-m-d H:i:s'),
					'mitra_deployer'	 => !empty($this->input->post('mitra_deployer')) ? $this->input->post('mitra_deployer') : null,
					'progress'			 => 'DELIVERY MATERIAL'
				);
				$this->db->insert('tb_deployer', $deployer);
			}

			$datalog_project = array(
				'project_id'    => $id_project,
				'action_by'     => $this->session->userdata('nama'),
				'action_on'     => date('Y-m-d H:i:s'),
				'action_status' => 7,
				'a_keterangan'  => $this->input->post('ket_update')
			);
			$this->db->insert('tb_log_project', $datalog_project);
		}

		$this->project_model->update(array('project_id' => $this->input->post('id')), $project);

		echo json_encode(
			array(
				"status" => TRUE,
				'pesan' => '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>Well done!</b> Data successfully updated!</div>'
			)
		);
	}

	public function update_progress_deployer()
	{
		$this->_validate_progress();
		$id_project  = $this->input->post('id');
		$progress    = $this->input->post('progress');
		$jenis_prj   = $this->input->post('jenis_prj');
		$folder      = str_replace(" ", "_", $this->input->post('nama_loop', NULL, TRUE));
		$data_sales  = $this->db->get_where('tb_construction', array('project_id' => $id_project, 'aktif' => 1))->result_array();
		if ($this->input->post('progress_update') == 'KENDALA') {
			$cons = array(
				'last_update'    => date('Y-m-d H:i:s'),
				'updated_by' 	 => $this->session->userdata('user_id'),
				'keterangan'     => !empty($this->input->post('ket_update')) ? $this->input->post('ket_update') : null,
				'status'  		 => 55
			);

			$data2 = array(
				'status'        => 'REDESAIN',
				'status_id'     => 13,
				'keterangan'    => !empty($this->input->post('ket_update')) ? $this->input->post('ket_update') : null,
				'tgl_update'    => date('Y-m-d H:i:s')
			);

			$project_update = array(
				'last_update_status' => date('Y-m-d H:i:s'),
				'last_update_by' 	 => $this->session->userdata('user_id'),
				'progress' 			 => 'REDESAIN',
				'keterangan'     	 => !empty($this->input->post('ket_update')) ? $this->input->post('ket_update') : null,
				'status'  		 	 => 55
			);

			$datalog_project = array(
				'project_id'    => $id_project,
				'action_by'     => $this->session->userdata('nama'),
				'action_on'     => date('Y-m-d H:i:s'),
				'action_status' => 6,
				'a_keterangan'  => $this->input->post('ket_update')
			);
			$this->db->insert('tb_log_project', $datalog_project);

			if (!empty($data_sales)) {
				foreach ($data_sales as $value) {
					$id_sales = $value['sales_id'];
					$this->project_model->update_sales($id_sales, $data2);

					$datalog = array(
						'sales_id'      => $id_sales,
						'action_by'     => $this->session->userdata('nama'),
						'action_on'     => date('Y-m-d H:i:s'),
						'action_status' => 36,
						'a_keterangan'  => $this->input->post('ket_update')
					);
					$this->db->insert('tb_log', $datalog);
				}
			}

			$this->construction_model->update(array('project_id' => $this->input->post('id'), 'aktif' => 1), $cons);
		} else {
			$project_update = array(
				'last_update_status' => date('Y-m-d H:i:s'),
				'last_update_by' 	 => $this->session->userdata('user_id'),
				'progress' 			 => $this->input->post('progress_update'),
				'keterangan'     	 => !empty($this->input->post('ket_update')) ? $this->input->post('ket_update') : null,
			);

			$deployer = array(
				'last_update_status' => date('Y-m-d H:i:s'),
				'progress'			 => $this->input->post('progress_update')
			);

			/*if(!empty($_FILES['photo']['name']))
			{
				$upload = $this->_do_upload($folder);
				if ($progress == 'DELIVERY MATERIAL' && $jenis_prj == 'PT2 SIMPLE') {
					$deployer['evident_delivery_material'] = $upload;
				}
				elseif ($progress == 'DELIVERY MATERIAL' && $jenis_prj == 'PT2 PLUS') {
					$deployer['evident_delivery_material'] = $upload;
				}
				elseif ($progress == 'PENANAMAN TIANG') {
					$deployer['evident_tanam_tiang'] = $upload;
				}
				elseif ($progress == 'PENARIKAN KABEL') {
					$deployer['evident_tarik_kabel'] = $upload;
				}
				elseif ($progress == 'INSTALL ODP') {
					$deployer['evident_install_odp'] = $upload;
				}
				elseif ($progress == 'PENYAMBUNGAN') {
					$deployer['evident_penyambungan'] = $upload;
				}
				elseif ($progress == 'SELESAI FISIK & MENUNGGU MAINCORE') {
					$deployer['evident_penyambungan'] = $upload;
				}
			}*/

			$this->project_model->update_deployer(array('project_id' => $this->input->post('id')), $deployer);
		}

		$this->project_model->update(array('project_id' => $this->input->post('id')), $project_update);
		echo json_encode(array("status" => TRUE));
	}

	public function selesai_deployment()
	{
		$id_project      = $this->input->post('id');
		$deployer_id     = $this->input->post('deployer_id');
		// $file_maincore        = !empty($this->input->post('file_maincore')) ? $this->input->post('file_maincore') : null;
		// $file_kml             = !empty($this->input->post('file_kml')) ? $this->input->post('file_kml') : null;
		// $foto_luar_odp        = !empty($this->input->post('foto_luar_odp')) ? $this->input->post('foto_luar_odp') : null;
		// $foto_dalam_odp       = !empty($this->input->post('foto_dalam_odp')) ? $this->input->post('foto_dalam_odp') : null;
		// $foto_terminasi_ftm   = !empty($this->input->post('foto_terminasi_ftm')) ? $this->input->post('foto_terminasi_ftm') : null;
		// $foto_terminasi_odc   = !empty($this->input->post('foto_terminasi_odc')) ? $this->input->post('foto_terminasi_odc') : null;
		// $number_of_files = sizeof($_FILES['userfile']['tmp_name']);
		// $file   		 = $_FILES['userfile'];
		$id_valins       = $this->input->post('id_valins');
		$lokasi_odp      = $this->input->post('lokasi_odp');
		$keterangan      = !empty($this->input->post('ket_update', NULL, TRUE)) ? $this->input->post('ket_update', NULL, TRUE) : NULL;
		//$nama_loop_folder  = str_replace(" ", "_", $this->input->post('nama_lop',NULL,TRUE));

		// if (!is_dir('uploads/project/' . $nama_loop_folder .'/golive')) {
		// 	mkdir('./uploads/project/'.$nama_loop_folder.'/golive', 0777, true);
		// }

		// $config['upload_path']          = './uploads/project/'.$nama_loop_folder.'/golive';
		// $config['allowed_types']        = 'xls|XLS|xlsx|XLSX|kml|ods|csv|CSV|jpg|jpeg|png|JPG|JPEG|pdf';
		// $config['max_size']             = 20000;
		// $this->load->library('upload', $config);
		// $this->upload->initialize($config);
		// for ($i=0; $i < $number_of_files; $i++) {
		// 	$_FILES['userfile']['name'] 	= $file['name'][$i];
		// 	$_FILES['userfile']['type'] 	= $file['type'][$i];
		// 	$_FILES['userfile']['tmp_name'] = $file['tmp_name'][$i];
		// 	$_FILES['userfile']['error'] 	= $file['error'][$i];
		// 	$_FILES['userfile']['size'] 	= $file['size'][$i];
		// 	$this->upload->do_upload();

		// }

		$deployer_update = array(
			'last_update_status' => date("Y-m-d H:i:s"),
			'id_valins'    		 => $id_valins,
			'lokasi_odp'         => $lokasi_odp,
			'progress' 			 => 'SELESAI PEMBANGUNAN',
		);
		$this->project_model->update_deployer(array('project_id' => $this->input->post('id')), $deployer_update);

		$project_update = array(
			'last_update_status' => date('Y-m-d H:i:s'),
			'last_update_by' 	 => $this->session->userdata('user_id'),
			'progress' 			 => 'VALIDASI GOLIVE',
			'status'			 => 33,
			'keterangan'     	 => !empty($this->input->post('ket_update')) ? $this->input->post('ket_update') : null,
		);
		$this->project_model->update(array('project_id' => $this->input->post('id')), $project_update);

		$cons = array(
			'last_update'    => date('Y-m-d H:i:s'),
			'updated_by' 	 => $this->session->userdata('user_id'),
			'keterangan'     => !empty($this->input->post('ket_update')) ? $this->input->post('ket_update') : null,
			'status'  		 => 33
		);
		$this->construction_model->update(array('project_id' => $this->input->post('id'), 'aktif' => 1), $cons);

		$datag = array(
			'project_id'    	 => $id_project,
			'deployer_id'    	 => $deployer_id,
			'last_update_status' => date("Y-m-d H:i:s"),
			'progress' 			 => 'VALIDASI',
		);
		$this->db->insert('tb_golive', $datag);

		$datalog_project = array(
			'project_id'    => $id_project,
			'action_by'     => $this->session->userdata('nama'),
			'action_on'     => date('Y-m-d H:i:s'),
			'action_status' => 8,
			'a_keterangan'  => $this->input->post('ket_update')
		);
		$this->db->insert('tb_log_project', $datalog_project);

		$data2 = array(
			'status'        => 'PROSES GOLIVE',
			'status_id'     => 13,
			'keterangan'    => $this->input->post('ket_update'),
			'tgl_update'    => date('Y-m-d H:i:s')
		);
		$data_sales  = $this->db->get_where('tb_construction', array('project_id' => $id_project, 'aktif' => 1))->result_array();
		if (!empty($data_sales)) {
			foreach ($data_sales as $value) {
				$id_sales = $value['sales_id'];
				$this->project_model->update_sales($id_sales, $data2);

				$datalog = array(
					'sales_id'      => $id_sales,
					'action_by'     => $this->session->userdata('nama'),
					'action_on'     => date('Y-m-d H:i:s'),
					'action_status' => 37,
					'a_keterangan'  => $this->input->post('ket_update')
				);
				$this->db->insert('tb_log', $datalog);
			}
		}

		$this->session->set_flashdata('info', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Well Done, Data Successfully updated!</div>');
		redirect('sales/project/golive/deploy/' . $id_project . '', 'refresh');
	}

	public function golive_update()
	{
		$id_project      = $this->input->post('id');
		$progress      	 = $this->input->post('progress');
		if ($this->input->post('progress_update') == 'KENDALA') {
			$cons = array(
				'last_update'    => date('Y-m-d H:i:s'),
				'updated_by' 	 => $this->session->userdata('user_id'),
				'keterangan'     => !empty($this->input->post('ket_update')) ? $this->input->post('ket_update') : null,
				'status'		 => 44
			);

			$project_update = array(
				'last_update_status' => date('Y-m-d H:i:s'),
				'last_update_by' 	 => $this->session->userdata('user_id'),
				'progress' 			 => 'KENDALA GOLIVE',
				'keterangan'     	 => !empty($this->input->post('ket_update')) ? $this->input->post('ket_update') : null,
				'status'		     => 44
			);

			$golive = array(
				'last_update_status'    => date('Y-m-d H:i:s'),
				'progress' 			 	=> 'KENDALA GOLIVE',
			);

			$datalog_project = array(
				'project_id'    => $id_project,
				'action_by'     => $this->session->userdata('nama'),
				'action_on'     => date('Y-m-d H:i:s'),
				'action_status' => 10,
				'a_keterangan'  => $this->input->post('ket_update')
			);
			$this->db->insert('tb_log_project', $datalog_project);

			$data2 = array(
				'status'        => 'KENDALA GOLIVE',
				'status_id'     => 13,
				'keterangan'    => $this->input->post('ket_update'),
				'tgl_update'    => date('Y-m-d H:i:s')
			);
			$data_sales  = $this->db->get_where('tb_construction', array('project_id' => $id_project, 'aktif' => 1))->result_array();

			if (empty($data_sales)) {
				foreach ($data_sales as $value) {
					$id_sales = $value['sales_id'];
					$this->project_model->update_sales($id_sales, $data2);

					$datalog = array(
						'sales_id'      => $id_sales,
						'action_by'     => $this->session->userdata('nama'),
						'action_on'     => date('Y-m-d H:i:s'),
						'action_status' => 38,
						'a_keterangan'  => $this->input->post('ket_update')
					);
					$this->db->insert('tb_log', $datalog);
				}
			}
		} elseif ($this->input->post('progress_update') == 'PERBAIKAN MAINCORE') {
			$cons = array(
				'last_update'    => date('Y-m-d H:i:s'),
				'updated_by' 	 => $this->session->userdata('user_id'),
				'status'		 => 22,
				'keterangan'     => !empty($this->input->post('ket_update')) ? $this->input->post('ket_update') : null
			);

			$project_update = array(
				'last_update_status' => date('Y-m-d H:i:s'),
				'last_update_by' 	 => $this->session->userdata('user_id'),
				'progress' 			 => $this->input->post('progress_update'),
				'status'		 	 => 22,
				'keterangan'     	 => !empty($this->input->post('ket_update')) ? $this->input->post('ket_update') : null
			);

			$golive = array(
				'last_update_status'    => date('Y-m-d H:i:s'),
				'progress' 			 	=> $this->input->post('progress_update'),
			);

			$deployer = array(
				'last_update_status' => date('Y-m-d H:i:s'),
				'progress'			 => $this->input->post('progress_update'),
			);
			$this->project_model->update_deployer(array('project_id' => $this->input->post('id')), $deployer);

			$datalog_project = array(
				'project_id'    => $id_project,
				'action_by'     => $this->session->userdata('nama'),
				'action_on'     => date('Y-m-d H:i:s'),
				'action_status' => 9,
				'a_keterangan'  => $this->input->post('ket_update')
			);
			$this->db->insert('tb_log_project', $datalog_project);

			$data2 = array(
				'status'        => 'DEPLOY',
				'status_id'     => 13,
				'keterangan'    => $this->input->post('ket_update'),
				'tgl_update'    => date('Y-m-d H:i:s')
			);
			$data_sales  = $this->db->get_where('tb_construction', array('project_id' => $id_project, 'aktif' => 1))->result_array();
			if (empty($data_sales)) {
				foreach ($data_sales as $value) {
					$id_sales = $value['sales_id'];
					$this->project_model->update_sales($id_sales, $data2);

					$datalog = array(
						'sales_id'      => $id_sales,
						'action_by'     => $this->session->userdata('nama'),
						'action_on'     => date('Y-m-d H:i:s'),
						'action_status' => 39,
						'a_keterangan'  => $this->input->post('ket_update')
					);
					$this->db->insert('tb_log', $datalog);
				}
			}
		} elseif ($this->input->post('progress_update') == 'GOLIVE') {
			$cons = array(
				'last_update'    => date('Y-m-d H:i:s'),
				'updated_by' 	 => $this->session->userdata('user_id'),
				'status'		 => 88,
				'keterangan'     => !empty($this->input->post('ket_update')) ? $this->input->post('ket_update') : null
			);

			$project_update = array(
				'last_update_status' => date('Y-m-d H:i:s'),
				'last_update_by' 	 => $this->session->userdata('user_id'),
				'progress' 			 => 'SELESAI GOLIVE',
				'status'		     => 88,
				'keterangan'     	 => !empty($this->input->post('ket_update')) ? $this->input->post('ket_update') : null
			);

			$golive = array(
				'last_update_status'    => date('Y-m-d H:i:s'),
				'progress' 			 	=> $this->input->post('progress_update'),
			);

			$datalog_project = array(
				'project_id'    => $id_project,
				'action_by'     => $this->session->userdata('nama'),
				'action_on'     => date('Y-m-d H:i:s'),
				'action_status' => 11,
				'a_keterangan'  => $this->input->post('ket_update')
			);
			$this->db->insert('tb_log_project', $datalog_project);

			$data_sales  = $this->db->get_where('tb_construction', array('project_id' => $id_project, 'aktif' => 1))->result_array();
			foreach ($data_sales as $value) {
				$odp_plan = $value['odp_plan'];
				$id_sales = $value['sales_id'];

				$datalog = array(
					'sales_id'      => $id_sales,
					'action_by'     => $this->session->userdata('nama'),
					'action_on'     => date('Y-m-d H:i:s'),
					'action_status' => 40,
					'a_keterangan'  => $this->input->post('ket_update')
				);
				$this->db->insert('tb_log', $datalog);

				$data2 = array(
					'status'        => 'remanja',
					'status_id'     => 1,
					'keterangan'    => 'SELESAI PEMBANGUNAN ' . $odp_plan . '',
					'tgl_update'    => date('Y-m-d H:i:s'),
					'tgl_done_fcc'  => date('Y-m-d H:i:s')
				);
				$this->project_model->update_sales($id_sales, $data2);
				broadcast_amunisi($id_sales, 'reorder');
			}
		} else {
			$cons = array(
				'last_update'    => date('Y-m-d H:i:s'),
				'updated_by' 	 => $this->session->userdata('user_id'),
				'keterangan'     => !empty($this->input->post('ket_update')) ? $this->input->post('ket_update') : null
			);

			$project_update = array(
				'last_update_status' => date('Y-m-d H:i:s'),
				'last_update_by' 	 => $this->session->userdata('user_id'),
				'progress' 			 => $this->input->post('progress_update'),
				'keterangan'     	 => !empty($this->input->post('ket_update')) ? $this->input->post('ket_update') : null
			);

			$golive = array(
				'last_update_status'    => date('Y-m-d H:i:s'),
				'progress' 			 	=> $this->input->post('progress_update'),
			);

			$data2 = array(
				'status'        => 'PROSES GOLIVE',
				'status_id'     => 13,
				'keterangan'    => $this->input->post('ket_update'),
				'tgl_update'    => date('Y-m-d H:i:s')
			);

			$datalog_project = array(
				'project_id'    => $id_project,
				'action_by'     => $this->session->userdata('nama'),
				'action_on'     => date('Y-m-d H:i:s'),
				'action_status' => 12,
				'a_keterangan'  => $this->input->post('ket_update')
			);
			$this->db->insert('tb_log_project', $datalog_project);

			$data_sales  = $this->db->get_where('tb_construction', array('project_id' => $id_project, 'aktif' => 1))->result_array();
			if (empty($data_sales)) {
				foreach ($data_sales as $value) {
					$id_sales = $value['sales_id'];
					$this->project_model->update_sales($id_sales, $data2);

					$datalog = array(
						'sales_id'      => $id_sales,
						'action_by'     => $this->session->userdata('nama'),
						'action_on'     => date('Y-m-d H:i:s'),
						'action_status' => 41,
						'a_keterangan'  => $this->input->post('ket_update')
					);
					$this->db->insert('tb_log', $datalog);
				}
			}
		}
		$this->construction_model->update(array('project_id' => $this->input->post('id'), 'aktif' => 1), $cons);
		$this->project_model->update_golive(array('project_id' => $this->input->post('id')), $golive);
		$this->project_model->update(array('project_id' => $this->input->post('id')), $project_update);
		echo json_encode(array("status" => TRUE));
	}

	public function redesain_update()
	{
		$status_up   = $this->input->post('status_update');
		$id_project  = $this->input->post('id');
		$data_sales  = $this->db->get_where('tb_construction', array('project_id' => $id_project, 'aktif' => 1))->result_array();
		$jenis_prj  = $this->input->post('jenis_prj');

		if ($jenis_prj == 'PT2 SIMPLE') {
			$status_id = 22;
			$status_sales = "DEPLOY";
			$log_s = 44;
			$logpr = 16;
			$progress = 'PERSIAPAN DAN TUNJUK MITRA DEPLOYER';
		} elseif ($jenis_prj == 'PT3' || $jenis_prj == 'OTHERS' || $jenis_prj == 'STTF' || $jenis_prj == 'TCloud') {
			$status_id = 77;
			$status_sales = "NEXT PROJECT";
			$progress = 'NEXT PROJECT';
			$log_s = 44;
			$logpr = 16;
		} else {
			$status_id = 66;
			$status_sales = "APPROVAL AMO";
			$log_s = 44;
			$logpr = 16;
			$progress = 'APPROVAL AMO';

			$cekamo = $this->db->query("SELECT project_id FROM tb_optima WHERE project_id = $id_project ")->num_rows();
			if ($cekamo > 0) {
				// sdh ada
				$amo_update = array(
					'last_update_status' => date('Y-m-d H:i:s'),
					'mitra_amo'		     => null,
					'approve'			 => null,
					'keterangan'         => !empty($this->input->post('ket_update')) ? $this->input->post('ket_update') : null,
				);
				$this->project_model->update_amo(array('project_id' => $this->input->post('id')), $amo_update);
			} else {
				// blm ada
				$amo_create = array(
					'project_id'    	 => $id_project,
					'last_update_status' => date("Y-m-d H:i:s"),
					'keterangan'         => !empty($this->input->post('ket_update')) ? $this->input->post('ket_update') : null,
				);
				$this->db->insert('tb_optima', $amo_create);
			}
		}

		if (!empty($this->input->post('update_gdrive'))) {
			$link_gd = $this->input->post('update_gdrive');
		} else {
			$link_gd = $this->input->post('old_gdrive');
		}

		$cons = array(
			'last_update'    => date('Y-m-d H:i:s'),
			'updated_by' 	 => $this->session->userdata('user_id'),
			'keterangan'     => !empty($this->input->post('ket_update')) ? $this->input->post('ket_update') : null,
			'status'  		 => $status_id
		);

		$data2 = array(
			'status'        => $status_sales,
			'status_id'     => 13,
			'keterangan'    => !empty($this->input->post('ket_update')) ? $this->input->post('ket_update') : null,
			'tgl_update'    => date('Y-m-d H:i:s')
		);

		$project_update = array(
			'nama_lop' 			 => $this->input->post('nama_lop'),
			'jenis_prj' 	     => $this->input->post('jenis_prj'),
			'link_gd' 	     	 => $link_gd,
			'last_update_status' => date('Y-m-d H:i:s'),
			'last_update_by' 	 => $this->session->userdata('user_id'),
			'progress' 			 => $progress,
			'keterangan'     	 => !empty($this->input->post('ket_update')) ? $this->input->post('ket_update') : null,
			'status'  		 	 => $status_id
		);

		$datalog_project = array(
			'project_id'    => $id_project,
			'action_by'     => $this->session->userdata('nama'),
			'action_on'     => date('Y-m-d H:i:s'),
			'action_status' => $logpr,
			'a_keterangan'  => $this->input->post('ket_update')
		);
		$this->db->insert('tb_log_project', $datalog_project);

		if (!empty($data_sales)) {
			foreach ($data_sales as $value) {
				$id_sales = $value['sales_id'];
				$this->project_model->update_sales($id_sales, $data2);

				$datalog = array(
					'sales_id'      => $id_sales,
					'action_by'     => $this->session->userdata('nama'),
					'action_on'     => date('Y-m-d H:i:s'),
					'action_status' => $log_s,
					'a_keterangan'  => $this->input->post('ket_update')
				);
				$this->db->insert('tb_log', $datalog);
			}
		}

		$this->construction_model->update(array('project_id' => $this->input->post('id'), 'aktif' => 1), $cons);
		$this->project_model->update(array('project_id' => $this->input->post('id')), $project_update);
		echo json_encode(array("status" => TRUE));
	}

	public function kendala_live_update()
	{
		$status_up   = $this->input->post('status_update');
		$id_project  = $this->input->post('id');

		$cons = array(
			'last_update'    => date('Y-m-d H:i:s'),
			'updated_by' 	 => $this->session->userdata('user_id'),
			'keterangan'     => !empty($this->input->post('ket_update')) ? $this->input->post('ket_update') : null,
			'status'  		 => 33
		);


		$project_update = array(
			'last_update_status' => date('Y-m-d H:i:s'),
			'last_update_by' 	 => $this->session->userdata('user_id'),
			'progress' 			 => 'VALIDASI GOLIVE',
			'keterangan'     	 => !empty($this->input->post('ket_update')) ? $this->input->post('ket_update') : null,
			'status'  		 	 => 33
		);

		$golive = array(
			'last_update_status'    => date('Y-m-d H:i:s'),
			'progress' 			 	=> 'VALIDASI GOLIVE',
		);

		$datalog_project = array(
			'project_id'    => $id_project,
			'action_by'     => $this->session->userdata('nama'),
			'action_on'     => date('Y-m-d H:i:s'),
			'action_status' => 12,
			'a_keterangan'  => $this->input->post('ket_update')
		);
		$this->db->insert('tb_log_project', $datalog_project);

		$this->construction_model->update(array('project_id' => $this->input->post('id'), 'aktif' => 1), $cons);
		$this->project_model->update(array('project_id' => $this->input->post('id')), $project_update);
		$this->project_model->update_golive(array('project_id' => $this->input->post('id')), $golive);
		echo json_encode(array("status" => TRUE));
	}

	public function update_next_project()
	{
		$id_project  = $this->input->post('id');
		$data_sales  = $this->db->get_where('tb_construction', array('project_id' => $id_project, 'aktif' => 1))->result_array();
		$project = array(
			'last_update'    => date('Y-m-d H:i:s'),
			'last_update_by' => $this->session->userdata('user_id'),
			'keterangan'     => $this->input->post('ket_update')
		);

		$cons = array(
			'last_update'    => date('Y-m-d H:i:s'),
			'updated_by' 	 => $this->session->userdata('user_id'),
			'keterangan'     => $this->input->post('ket_update')
		);

		$data2 = array(
			'keterangan'    => $this->input->post('ket_update'),
			'tgl_update'    => date('Y-m-d H:i:s')
		);

		$datalog_project = array(
			'project_id'    => $id_project,
			'action_by'     => $this->session->userdata('nama'),
			'action_on'     => date('Y-m-d H:i:s'),
			'action_status' => 14,
			'a_keterangan'  => $this->input->post('ket_update')
		);
		$this->db->insert('tb_log_project', $datalog_project);

		if (!empty($data_sales)) {
			foreach ($data_sales as $value) {
				$id_sales = $value['sales_id'];
				$this->project_model->update_sales($id_sales, $data2);
			}
		}

		$this->project_model->update(array('project_id' => $this->input->post('id')), $project);
		$this->construction_model->update(array('project_id' => $this->input->post('id'), 'aktif' => 1), $cons);

		echo json_encode(
			array(
				"status" => TRUE
			)
		);
	}

	public function cek_odp()
	{
		$get = $this->input->get();
		$odp = $get['odp'];
		$query = $this->project_model->cek_odp($odp);
		//print_r($query);
		if (!empty($query)) {
			echo json_encode(
				array(
					"status" => false,
					"pesan"  => "ODP $odp sudah digunakan " . $query->nama_lop . " . Gunakan ODP lain atau masukan JA ke project ID " . $query->project_code . " ",
					"data"   => $query
				)
			);
		} else {
			echo json_encode(
				array(
					"status" => true,
					"pesan" => "ODP Valid.",
					"data"   => $query
				)
			);
		}
	}

	public function update()
	{
		$this->_validate();
		$status_up   = $this->input->post('status_update');
		$id_project  = $this->input->post('id');
		$data_sales  = $this->db->get_where('tb_construction', array('project_id' => $id_project, 'aktif' => 1))->result_array();

		if ($status_up == '22') {
			$project = array(
				'last_update'    => date('Y-m-d H:i:s'),
				'last_update_by' => $this->session->userdata('user_id'),
				'keterangan'     => $this->input->post('ket_update'),
				'status'  		 => $this->input->post('status_update'),
				'mitra_amo'		 => $this->input->post('mitra_amo')
			);
		} else {
			$project = array(
				'last_update'    => date('Y-m-d H:i:s'),
				'last_update_by' => $this->session->userdata('user_id'),
				'keterangan'     => $this->input->post('ket_update'),
				'status'  		 => $this->input->post('status_update')
			);
		}


		$cons = array(
			'last_update'    => date('Y-m-d H:i:s'),
			'updated_by' 	 => $this->session->userdata('user_id'),
			'keterangan'     => $this->input->post('ket_update'),
			'status'  		 => $this->input->post('status_update')
		);

		if ($status_up == '11') {
			$data2 = array(
				'status'        => 'SP',
				'status_id'     => 13,
				'keterangan'    => $this->input->post('ket_update'),
				'tgl_update'    => date('Y-m-d H:i:s')
			);
		} elseif ($status_up == '22') {
			$data2 = array(
				'status'        => 'DEPLOY',
				'status_id'     => 13,
				'keterangan'    => $this->input->post('ket_update'),
				'tgl_update'    => date('Y-m-d H:i:s')
			);
		} elseif ($status_up == '33') {
			$data2 = array(
				'status'        => 'PROSES GOLIVE',
				'status_id'     => 13,
				'keterangan'    => $this->input->post('ket_update'),
				'tgl_update'    => date('Y-m-d H:i:s')
			);
		} elseif ($status_up == '44') {
			$data2 = array(
				'status'        => 'KENDALA GOLIVE',
				'status_id'     => 13,
				'keterangan'    => $this->input->post('ket_update'),
				'tgl_update'    => date('Y-m-d H:i:s')
			);
		} elseif ($status_up == '55') {
			$data2 = array(
				'status'        => 'REDESAIN',
				'status_id'     => 13,
				'keterangan'    => $this->input->post('ket_update'),
				'tgl_update'    => date('Y-m-d H:i:s')
			);
		} elseif ($status_up == '66') {
			$data2 = array(
				'status'        => 'APPROVAL AMO',
				'status_id'     => 13,
				'keterangan'    => $this->input->post('ket_update'),
				'tgl_update'    => date('Y-m-d H:i:s')
			);
		} elseif ($status_up == '77') {
			$data2 = array(
				'status'        => 'NEXT PROJECT',
				'status_id'     => 13,
				'keterangan'    => $this->input->post('ket_update'),
				'tgl_update'    => date('Y-m-d H:i:s')
			);
		} elseif ($status_up == '2') {
			$data2 = array(
				'status'        => 'remanja',
				'status_id'     => 1,
				'keterangan'    => $this->input->post('ket_update'),
				'tgl_update'    => date('Y-m-d H:i:s')
			);
			foreach ($data_sales as $value) {
				$id_sales = $value['sales_id'];
				$this->project_model->delete_by_sales($id_sales);
			}
		}

		foreach ($data_sales as $value) {
			$id_sales = $value['sales_id'];
			$this->project_model->update_sales($id_sales, $data2);
		}

		$this->project_model->update(array('project_id' => $this->input->post('id')), $project);
		$this->construction_model->update(array('project_id' => $this->input->post('id'), 'aktif' => 1), $cons);

		echo json_encode(
			array(
				"status" => TRUE,
				'pesan' => '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>Well done!</b> Data successfully updated!</div>'
			)
		);
	}

	public function search()
	{
		$search  = $this->input->post('search');
		$data['title']      = 'Project Construction';
		$data['subtitle']   = 'Hasil Pencarian PJ' . $search . '';

		$data['results'] = $this->project_model->search($search)->result_array();
		$this->load->view('template', [
			'content' => $this->load->view('sales/project/result', $data, true)
		]);
	}

	public function delete($id)
	{
		$this->project_model->delete_project_id($id);
		echo json_encode(
			array(
				"status"    => TRUE,
			)
		);
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

	private function _validate_amo()
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
		if ($data['status'] === FALSE) {
			echo json_encode($data);
			exit();
		}
	}

	private function _validate_progress()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->input->post('progress_update') == '') {
			$data['inputerror'][] = 'progress_update';
			$data['error_string'][] = 'PROGRESS is required';
			$data['status'] = FALSE;
		}
		if ($data['status'] === FALSE) {
			echo json_encode($data);
			exit();
		}
	}

	private function _validate_project()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->input->post('jenis_prj') == '') {
			$data['inputerror'][] = 'jenis_prj';
			$data['error_string'][] = 'Jenis is required';
			$data['status'] = FALSE;
		}
		if ($this->input->post('nama_loop') == '') {
			$data['inputerror'][] = 'nama_loop';
			$data['error_string'][] = 'Nama LOP is required';
			$data['status'] = FALSE;
		}
		if ($data['status'] === FALSE) {
			echo json_encode($data);
			exit();
		}
	}

	private function _do_upload($folder)
	{
		$config['upload_path']          = './uploads/project/' . $folder . '';
		$config['allowed_types']        = 'jpg|JPG|jpeg|JPEG|png|PNG';
		$config['max_size']             = 2000;
		$config['encrypt_name']         = TRUE;

		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if (!$this->upload->do_upload('photo')) {
			$data['inputerror'][] = 'photo';
			$data['error_string'][] = 'Upload error: ' . $this->upload->display_errors('', ''); //show ajax error
			$data['status'] = FALSE;
			echo json_encode($data);
			exit();
		}

		return $this->upload->data('file_name');
	}
}

/* End of file Kendala.php */
/* Location: ./application/controllers/sales/Project.php */
