<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Kendala extends MY_Controller
{



    public function __construct()
    {

        parent::__construct();

        if ($this->session->userdata('logged_in') != TRUE) {

            redirect(base_url("auth"));
        }
    }



    public function index($segment = 'all', $unit = 'all', $by_tgl = 'tgl_ja', $start = null, $end = null)

    {

        $segment = getSegment($segment);

        $data['title']             = 'Jarvis Sales';

        $data['subtitle']         = 'Kendala';

        $data['segment']         = $segment;

        $data['unit']             = $unit;

        $data['by_tgl']             = $by_tgl;

        $data['start']             = $start;

        $data['end']             = $end;

        $data['list_k']            = $this->kendala_model->resume($segment, $unit, $by_tgl, $start, $end)->result_array();

        $data['k_total']        = $this->kendala_model->resume_total($segment, $unit, $by_tgl, $start, $end)->row_array();

        $this->load->view('template', [

            'content' => $this->load->view('sales/kendala/tabel', $data, true)

        ]);
    }



    public function progress($segment = 'all', $datel = 'all', $by_tgl = 'tgl_ja', $start = null, $end = null)

    {

        $segment = getSegment($segment);

        $data['title']             = 'Jarvis Sales';

        $data['subtitle']         = 'Progress Kendala';

        $data['segment']         = $segment;

        $data['datel']             = $datel;

        $data['by_tgl']             = $by_tgl;

        $data['start']             = $start;

        $data['end']             = $end;

        $data['kd_3']            = $this->kendala_model->progress_kendala('kd_3', $segment, $datel, $by_tgl, $start, $end)->row_array();

        $data['kd_7']            = $this->kendala_model->progress_kendala('kd_7', $segment, $datel, $by_tgl, $start, $end)->row_array();

        $data['kd_14']            = $this->kendala_model->progress_kendala('kd_14', $segment, $datel, $by_tgl, $start, $end)->row_array();

        $data['kd_30']            = $this->kendala_model->progress_kendala('kd_30', $segment, $datel, $by_tgl, $start, $end)->row_array();

        $data['lb_30']            = $this->kendala_model->progress_kendala('lb_30', $segment, $datel, $by_tgl, $start, $end)->row_array();

        $data['all']            = $this->kendala_model->progress_kendala('all', $segment, $datel, $by_tgl, $start, $end)->row_array();

        $this->load->view('template', [

            'content' => $this->load->view('sales/kendala/tabel_progress_new', $data, true)

        ]);
    }





    public function filter($segment = 'all', $unit = 'all', $by_tgl = 'tgl_ja', $start = null, $end = null)

    {

        $segment = getSegment($segment);

        $data['title']             = 'Jarvis Sales';

        $data['subtitle']         = 'Kendala';

        $data['start']          = $start;

        $data['end']            = $end;

        $data['segment']         = $segment;

        $data['unit']             = $unit;

        $data['list_k']            = $this->kendala_model->resume($segment, $unit, $by_tgl, $start, $end)->result_array();

        $data['k_total']        = $this->kendala_model->resume_total($segment, $unit, $by_tgl, $start, $end)->row_array();

        $this->load->view('template', [

            'content' => $this->load->view('sales/kendala/tabel_filtered', $data, true)

        ]);
    }



    public function show()

    {

        $get      = $this->input->get(NULL, TRUE);

        $datel      = $get['datel'];

        $kendala = getKendala($get['kendala']);

        $waktu   = $get['waktu'];

        $order   = $get['order'];

        $unit    = $get['unit'];

        $by_tgl    = $get['by_tgl'];

        $start    = $get['start'];

        $end    = $get['end'];

        $segment = getIDSegment($order);

        $data['title']             = 'Kendala';

        $data['kndala']         = $get['kendala'];

        $data['datel']          = $datel;

        $data['subtitle']         = '[' . strtoupper($segment) . '] ' . ucfirst($waktu == 'today' ? 'hari ini' : $waktu) . ' Kendala ' . $kendala . ' Datel ' . $datel . ' ';

        $data['datas']             = $this->kendala_model->show_data($datel, $kendala, $waktu, $order, $unit, 'kendala', $by_tgl, $start, $end)->result_array();

        $this->load->view('template', [

            'content' => $this->load->view('sales/kendala/data', $data, true)

        ]);
    }



    public function show_progress()

    {

        $get      = $this->input->get(NULL, TRUE);

        $datel      = $get['datel'];

        $order   = $get['order'];

        $status  = $get['status'];

        $last_u  = $get['last_update'];

        $kendala = getKendala($get['kendala']);

        $by_tgl    = $get['by_tgl'];

        $start    = $get['start'];

        $end    = $get['end'];

        $segment = getSegment($order);

        $sts_sls = getStatusProgress($status);

        $last_prog_k = getLastProgKendala($last_u);





        $data['title']             = 'Kendala';

        $data['kndala']         = $get['kendala'];

        $data['datel']          = $datel;

        $data['subtitle']         = '[' . strtoupper($segment) . '] ' . $sts_sls . ' Kendala ' . $kendala . ' Datel ' . $datel . ' Last Update ' . $last_prog_k . ' ';

        $data['datas']             = $this->kendala_model->show_progress_data($datel, $order, $sts_sls, $last_u, $kendala, $by_tgl, $start, $end)->result_array();

        $this->load->view('template', [

            'content' => $this->load->view('sales/kendala/data', $data, true)

        ]);
    }



    public function show_filtered($datel, $kendala, $by_tgl, $start, $end, $segment)

    {

        $data['kndala']         = $kendala;

        $kendala = getKendala($kendala);

        $order = getIDSegment($segment);

        $data['datel']          = $datel;

        $data['title']             = 'Kendala';

        $data['subtitle']         = '[' . strtoupper($order) . '] Kendala ' . $kendala . ' Datel ' . $datel . ' Tanggal ' . date_indo($start) . ' - ' . date_indo($end) . ' ';

        $data['datas']             = $this->kendala_model->show_filtered_data($datel, $kendala, $by_tgl, $start, $end, $order)->result_array();

        $this->load->view('template', [

            'content' => $this->load->view('sales/kendala/data', $data, true)

        ]);
    }



    public function detail($id)

    {

        $data = $this->kendala_model->get_by_id($id);

        echo json_encode($data);
    }



    public function update()

    {

        //$this->_validate();

        $status_up   = $this->input->post('status_update');

        $kendala     = $this->input->post('kendala');

        $keterangan  = $this->input->post('ket_update');

        $loc_cust    = !empty($this->input->post('loc_cust')) ? $this->input->post('loc_cust') : null;

        $id_sales    = $this->input->post('id');

        $project_id_input = $this->input->post('project_id');

        $data_sales  = $this->db->get_where('tb_sales', array('sales_id' => $id_sales))->row_array();

        if (!empty($project_id_input)) {

            $project_id_input = intval(preg_replace('/[^0-9]+/', '', $this->input->post('project_id')), 10);

            $query = $this->db->get_where('tb_project', array('project_code' => $project_id_input), 1)->row_array();

            $get_odp_cons = $this->db->get_where('tb_construction', array('project_id' => $query['project_id']), 1)->row_array();

            $consprj = array(

                'last_update'    => date('Y-m-d H:i:s'),

                'sales_id'       => $id_sales,

                'project_id'     => $query['project_id'],

                'updated_by'     => $this->session->userdata('user_id'),

                'keterangan'     => $this->input->post('ket_update'),

                'status'           => $query['status'],

                'odp_plan'       => !empty($get_odp_cons['odp_plan']) ? $get_odp_cons['odp_plan'] : null,

                'post_on'        => date('Y-m-d H:i:s'),

                'post_by'        => $this->session->userdata('user_id'),

            );

            $this->db->insert('tb_construction', $consprj);



            $data2 = array(

                'status'        => getStatusCons($query['status']),

                'status_id'     => 13,

                'keterangan'    => $this->input->post('ket_update'),

                'tgl_update'    => date('Y-m-d H:i:s')

            );

            $this->kendala_model->update_sales($id_sales, $data2);



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

            if (!empty($kendala) && $kendala == $data_sales['kendala']) {

                if (!empty($keterangan)) {

                    $dataus = array(

                        'keterangan'        => $keterangan,

                        'loc_cust'          => $loc_cust,

                        'update_by'            => $this->session->userdata('user_id'),

                        'tgl_update'        => date('Y-m-d H:i:s')

                    );



                    $datalog = array(

                        'sales_id'      => $id_sales,

                        'action_by'     => $this->session->userdata('nama'),

                        'action_on'     => date('Y-m-d H:i:s'),

                        'action_status' => 6,

                        'a_keterangan'  => 'MERUBAH KETERANGAN MENJADI : ' . $this->input->post('ket_update')

                    );

                    $this->db->insert('tb_log', $datalog);

                    $this->kendala_model->update_sales($id_sales, $dataus);
                }
            } else if ($kendala == "SUDAH PS") {

                $data2 = array(

                    'status_id'         => 10,

                    'status'            => 'ps',

                    'lat_long'          => $this->input->post('lat_long'),

                    'keterangan'         => !empty($keterangan) ? $keterangan : $data_sales['keterangan'],

                    'update_by'            => $this->session->userdata('user_id'),

                    'tgl_update'        => date('Y-m-d H:i:s')

                );

                $cons = array(
                    'last_update'    => date('Y-m-d H:i:s'),
                    'updated_by'     => $this->session->userdata('user_id'),
                    'keterangan'     => $keterangan,
                    'aktif'           => 0
                );

                $datalog = array(

                    'sales_id'      => $id_sales,

                    'action_by'     => $this->session->userdata('nama'),

                    'action_on'     => date('Y-m-d H:i:s'),

                    'action_status' => 10,

                    'a_keterangan'  => $keterangan

                );

                $this->db->insert('tb_log', $datalog);
                $this->construction_model->update(array('sales_id' => $id_sales), $cons);

                $this->kendala_model->update_sales($id_sales, $data2);
            } else if (!empty($kendala) && $kendala != "SUDAH PS") {

                if ($kendala == 'RNA' || $kendala == 'ALAMAT' || $kendala == 'PENDING' || $kendala == 'BATAL' || $kendala == 'IJIN TANAM TIANG' || $kendala == 'NJKI') {

                    $jenis_kendala = 'KENDALA PELANGGAN';
                } elseif ($kendala == 'TERMINATE') {

                    $jenis_kendala = 'TERMINATE';
                } else {

                    $jenis_kendala = 'KENDALA JARINGAN';
                }



                $data2 = array(

                    'status_id'         => 6,

                    'lat_long'          => $this->input->post('lat_long'),

                    'status'            => $jenis_kendala,

                    'kendala'            => $kendala,

                    'loc_cust'          => $loc_cust,

                    'keterangan'         => !empty($keterangan) ? $keterangan : $data_sales['keterangan'],

                    'update_by'            => $this->session->userdata('user_id'),

                    'tgl_update'        => date('Y-m-d H:i:s')

                );

                $datalog = array(

                    'sales_id'      => $id_sales,

                    'action_by'     => $this->session->userdata('nama'),

                    'action_on'     => date('Y-m-d H:i:s'),

                    'action_status' => 6,

                    'a_keterangan'  => 'Update to kendala : ' . $kendala . ' | ' . strtoupper($keterangan)

                );

                $this->db->insert('tb_log', $datalog);

                $this->kendala_model->update_sales($id_sales, $data2);
            } else if (!empty($status_up) && $status_up == '2') {

                $data2 = array(

                    'status'        => 'remanja',

                    'status_id'     => 1,

                    'lat_long'      => $this->input->post('lat_long'),

                    'keterangan'    => $this->input->post('ket_update'),

                    'tgl_done_fcc'  => date('Y-m-d H:i:s'),

                    'tgl_update'    => date('Y-m-d H:i:s'),

                    'kendala'       => null,

                    'tgl_lapor_k'   => null

                );

                $datalog = array(

                    'sales_id'      => $id_sales,

                    'action_by'     => $this->session->userdata('nama'),

                    'action_on'     => date('Y-m-d H:i:s'),

                    'action_status' => '1' . $status_up . '',

                    'a_keterangan'  => $this->input->post('ket_update')

                );

                $this->db->insert('tb_log', $datalog);

                $this->kendala_model->update_sales($id_sales, $data2);

                broadcast_amunisi($id_sales, 'reorder');
            } else if (!empty($status_up) && $status_up == '3') {

                $data2 = array(

                    'status'        => 'NOT FU',

                    'status_id'     => 1,

                    'keterangan'    => $this->input->post('ket_update'),

                    'tgl_update'    => date('Y-m-d H:i:s'),

                    'tgl_done_fcc'  => date('Y-m-d H:i:s'),

                    'kendala'       => null,

                    'tgl_lapor_k'   => null

                );

                $datalog = array(

                    'sales_id'      => $id_sales,

                    'action_by'     => $this->session->userdata('nama'),

                    'action_on'     => date('Y-m-d H:i:s'),

                    'action_status' => 43,

                    'a_keterangan'  => $this->input->post('ket_update')

                );

                $this->db->insert('tb_log', $datalog);

                $this->kendala_model->update_sales($id_sales, $data2);
            }
        }



        if (!empty($loc_cust)) {

            $this->db->set('loc_cust', $loc_cust);

            $this->db->where('sales_id', $id_sales);

            $this->db->update('tb_sales');
        }



        if ($loc_cust != $data_sales['loc_cust']) {

            $datalog = array(

                'sales_id'      => $id_sales,

                'action_by'     => $this->session->userdata('nama'),

                'action_on'     => date('Y-m-d H:i:s'),

                'action_status' => 29,

                'a_keterangan'  => 'MERUBAH LOKASI TEKNISI ' . $data_sales['loc_cust'] . ' MENJADI ' . $loc_cust . ''

            );

            $this->db->insert('tb_log', $datalog);
        }



        if ($keterangan != $data_sales['keterangan']) {

            $datalog = array(

                'sales_id'      => $id_sales,

                'action_by'     => $this->session->userdata('nama'),

                'action_on'     => date('Y-m-d H:i:s'),

                'action_status' => 30,

                'a_keterangan'  => 'MERUBAH KETERANGAN ' . $data_sales['keterangan'] . ' MENJADI ' . $keterangan . ''

            );

            $this->db->insert('tb_log', $datalog);
        }



        echo json_encode(

            array(

                "status" => TRUE,

                "id_sales" => $id_sales

            )

        );
    }



    public function kendala_today()

    {

        $data['isi']    = $this->kendala_model->resume_today()->result_array();

        $data['total']  = $this->kendala_model->resume_total_today()->row_array();



        echo json_encode($data);
    }



    public function kendala_all()

    {

        $data['isi']    = $this->kendala_model->resume(null, null)->result_array();

        $data['total']  = $this->kendala_model->resume_total(null, null)->row_array();



        echo json_encode($data);
    }



    public function search()

    {

        $search  = $this->input->post('search');

        $data['title']      = 'Sales Order';

        $data['subtitle']   = 'Hasil Pencarian JA' . $search . '';



        $data['results'] = $this->kendala_model->search($search)->result_array();

        $this->load->view('template', [

            'content' => $this->load->view('sales/kendala/result', $data, true)

        ]);
    }



    private function _validate()

    {

        $data = array();

        $data['error_string'] = array();

        $data['inputerror'] = array();

        $data['status'] = TRUE;



        if ($this->input->post('ket_update') == '' && !empty($this->input->post('status_update'))) {

            $data['inputerror'][] = 'ket_update';

            $data['error_string'][] = 'Keterangan is required';

            $data['status'] = FALSE;
        }



        if (!empty($this->input->post('loc_cust'))) {

            if (stripos($this->input->post('loc_cust'), 'https') !== false) {

                $data['inputerror'][] = 'loc_cust';

                $data['error_string'][] = 'Koordinat tidak valid.';

                $data['status'] = FALSE;
            } elseif (stripos($this->input->post('loc_cust'), ',') == false) {

                $data['inputerror'][] = 'loc_cust';

                $data['error_string'][] = 'Koordinat tidak valid.';

                $data['status'] = FALSE;
            }
        }



        if (!empty($this->input->post('project_id'))) {

            $project_id   = intval(preg_replace('/[^0-9]+/', '', $this->input->post('project_id')), 10);

            $cek  = $this->db->query("SELECT project_code FROM tb_project where project_code='" . $project_id . "'")->num_rows();

            if ($cek <= 0) {

                $data['inputerror'][] = 'project_id';

                $data['error_string'][] = 'PJ' . $this->input->post('project_id') . ' tidak ditemukan.';

                $data['status'] = FALSE;
            }
        }

        if ($data['status'] === FALSE) {

            echo json_encode($data);

            exit();
        }
    }
}



/* End of file Kendala.php */

/* Location: ./application/controllers/sales/Kendala.php */
