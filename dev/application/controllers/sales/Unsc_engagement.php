<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Unsc_engagement extends MY_Controller
{

  private $filename = "upload_unsc";

  public function __construct()
  {
    parent::__construct();
    if ($this->session->userdata('logged_in') != TRUE) {
      redirect(base_url("auth"));
    }

    if (menuUnscEngagement($this->session->userdata('level')) == false) {
      redirect(base_url("welcome"));
    }
  }

  public function index()
  {
    $data['title']    = 'Sales Order';
    $data['subtitle'] = 'UNSC & Engagement';
    $this->load->view('template', [
      'content' => $this->load->view('sales/unsc_eng/data', $data, true)
    ]);
  }

  public function unsc_eng_list()
  {
    $list = $this->unsc_engagement_model->get_datatables();
    $data = array();
    $no = $_POST['start'];
    foreach ($list as $inputsc) {
      $pecahloc   = explode(',', $inputsc->lat_long);
      $lat        = str_replace(" ", "", $pecahloc[0]);
      $lng        = str_replace(" ", "", $pecahloc[1]);
      $kat = $inputsc->kategori;
      if ($kat == 1) {
        $kategori = '<span class="badge badge-success">DEAL, ODP READY</span>';
      } elseif ($kat == 2) {
        $kategori = '<span class="badge badge-warning">NOT DEAL, ODP READY</span>';
      } elseif ($kat == 3) {
        $kategori = '<span class="badge badge-danger">UNSC</span>';
      } else {
        $kategori = 'NONE';
      }
      $no++;
      $row = array();
      $row[] = $inputsc->sales_id;
      $row[] = $inputsc->datel;
      $row[] = $inputsc->nama_pelanggan;
      $row[] = $inputsc->no_ktp;
      $row[] = $inputsc->alamat;
      $row[] = '<a href="https://www.google.co.id/maps/search/' . $lat . ',+' . $lng . ' " target="_blank"><i class="icon md-link"></i> Go To Maps</a>';
      $row[] = $inputsc->cp;
      $row[] = $inputsc->odp;
      $row[] = substr($inputsc->tgl_post, 0, 10);
      $row[] = $inputsc->fullname;
      $row[] = $inputsc->status;
      $row[] = $kategori;
      $row[] = '<a class="btn btn-xs btn-primary" href="javascript:void(0)" title="Follow UP" onclick="detail(' . "'" . $inputsc->sales_id . "'" . ')"><i class="icon md-edit"></i> Follow Up</a>';
      $data[] = $row;
    }

    $output = array(
      "draw" => $_POST['draw'],
      "recordsTotal" => $this->unsc_engagement_model->count_all(),
      "recordsFiltered" => $this->unsc_engagement_model->count_filtered(),
      "data" => $data,
    );
    //output to json format
    echo json_encode($output);
  }

  public function detail($id)
  {
    $data = $this->unsc_engagement_model->get_by_id($id);
    echo json_encode($data);
  }

  public function update()
  {
    //$this->_validate();
    $status_up   = $this->input->post('status_update');
    $id_sales    = $this->input->post('id');
    $kendala      = $this->input->post('kendala', NULL, TRUE);
    $keterangan  = $this->input->post('ket_update');
    if ($status_up > 10) {
      $cons = array(
        'last_update'    => date('Y-m-d H:i:s'),
        'sales_id'       => $id_sales,
        'updated_by'     => $this->session->userdata('user_id'),
        'keterangan'     => $this->input->post('ket_update'),
        'status'         => $this->input->post('status_update'),
        'post_on'        => date('Y-m-d H:i:s'),
        'post_by'        => $this->session->userdata('user_id'),
      );
      if ($status_up == '11') {
        $data2 = array(
          'kategori'      => 1,
          'status'        => 'SP',
          'status_id'     => 13,
          'keterangan'    => $this->input->post('ket_update')
        );
      } elseif ($status_up == '22') {
        $data2 = array(
          'kategori'      => 1,
          'status'        => 'DEPLOY',
          'status_id'     => 13,
          'keterangan'    => $this->input->post('ket_update')
        );
      } elseif ($status_up == '33') {
        $data2 = array(
          'kategori'      => 1,
          'status'        => 'remanja',
          'status_id'     => 1,
          'keterangan'    => $this->input->post('ket_update')
        );
      } elseif ($status_up == '44') {
        $data2 = array(
          'kategori'      => 1,
          'status'        => 'KC',
          'status_id'     => 13,
          'keterangan'    => $this->input->post('ket_update')
        );
      }
      $this->unsc_engagement_model->update_sales($id_sales, $data2);
      $this->db->insert('tb_construction', $cons);
    } else {
      if ($status_up == "") {
        if ($kendala == 'SUDAH PS') {
          $dataps = array(
            'status_id'       => 10,
            'status'          => 'ps',
            'keterangan'       => $keterangan,
            'update_by'        => $this->session->userdata('user_id'),
            'tgl_update'      => date('Y-m-d H:i:s')
          );

          $datalog = array(
            'sales_id'      => $id_sales,
            'action_by'     => $this->session->userdata('nama'),
            'action_on'     => date('Y-m-d H:i:s'),
            'action_status' => 10,
            'a_keterangan'  => $keterangan
          );
          $this->wo_model->update_kendala(array('sales_id' => $id_sales), $dataps);
        } else {
          if ($kendala == 'RNA' || $kendala == 'ALAMAT' || $kendala == 'PENDING') {
            $jenis_kendala = 'P';
          } elseif ($kendala == 'BATAL') {
            $jenis_kendala = 'B';
          } else {
            $jenis_kendala = 'J';
          }
          $data = array(
            'sales_id'         => $id_sales,
            'jenis_kendala'    => $jenis_kendala,
            'kendala'          => $kendala,
            'keterangan'       => strtoupper($keterangan),
            'post_by'          => $this->session->userdata('user_id'),
            'post_on'          => date('Y-m-d H:i:s'),
            'last_update'      => date('Y-m-d H:i:s')
          );
          $dataus = array(
            'status_id'       => 6,
            'status'          => 'K' . $jenis_kendala,
            'keterangan'       => $keterangan,
            'update_by'        => $this->session->userdata('user_id'),
            'tgl_update'      => date('Y-m-d H:i:s')
          );
          $datalog = array(
            'sales_id'      => $id_sales,
            'action_by'     => $this->session->userdata('nama'),
            'action_on'     => date('Y-m-d H:i:s'),
            'action_status' => 6,
            'a_keterangan'  => strtoupper($keterangan)
          );

          $this->db->insert('tb_kendala', $data);
          $this->wo_model->update_kendala(array('sales_id' => $id_sales), $dataus);
        }
        $this->db->insert('tb_log', $datalog);
      } else {
        $data2 = array(
          'kategori'      => 1,
          'status'        => 'remanja',
          'status_id'     => 1,
          'keterangan'    => $this->input->post('ket_update')
        );
        $this->unsc_engagement_model->update_sales($id_sales, $data2);
      }
    }

    echo json_encode(
      array(
        "status" => TRUE,
        'pesan' => '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>Well done!</b> Data successfully updated! Please Refresh The Page :)</div>'
      )
    );
  }

  public function import()
  {
    if (isset($_POST['upload'])) {
      $upload = $this->unsc_engagement_model->upload_file($this->filename);
      if ($upload['result'] == "success") {
        include APPPATH . 'third_party/PHPExcel/PHPExcel.php';
        $loadexcel = PHPExcel_IOFactory::load('uploads/' . $this->filename . '.xlsx');
        $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true, true);
        $data = array();
        $data2 = array();

        $numrow = 1;
        foreach ($sheet as $row) {
          if ($numrow > 1) {
            $nama = $row['A'];
            $cp   = $row['A'];
            $this->db->from('tb_sales');
            $this->db->where('nama_pelanggan', $nama);
            $this->db->where('cp', $cp);
            $query = $this->db->get();
            $rowcount = $query->num_rows();
            if ($rowcount <= 0) { //cek kalu belum ada maka $data, kalau sudah ada masuk $data2
              array_push($data, array(
                'qrcode'   => $bc
              ));
            } else {
              array_push($data2, array(
                'qrcode'   => $bc
              ));
            }
          }
          $numrow++;
        }
        if (!empty($data)) {
          $this->unsc_engagement_model->insert_multiple($data);
        } else {
          $this->session->set_flashdata('info', '<div class="alert alert-warning" role="alert"><strong>Failed!</strong> Data sudah ada pada database!</div>');
        }
        $this->session->set_flashdata('info', '<div class="alert alert-success" role="alert"><strong>Well Done!</strong> ' . sizeof($data) . ' data berhasil ditambahkan sebagai UNSC. </div>');
        redirect('unsc_engagement');
      } else {
        $data['upload_error'] = $upload['error'];
      }
    } else {
      $data['title']    = 'UNSC & Engagement';
      $data['subtitle'] = 'Import UNSC';
      $this->load->view('template', [
        'content' => $this->load->view('sales/unsc_eng/upload', $data, true)
      ]);
    }
  }
}

/* End of file Unsc_engagement.php */
/* Location: ./application/controllers/sales/Unsc_engagement.php */