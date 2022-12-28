<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sc_input extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('logged_in') != TRUE) {
            redirect(base_url("auth"));
        }

        if (subMenuInputSCPlasa($this->session->userdata('level')) == false) {
            redirect(base_url("welcome"));
        }
    }

    public function index()
    {
        $data['title']    = 'Orders';
        $data['subtitle'] = 'Input SC Plasa';
        $this->load->view('template', [
            'content' => $this->load->view('sales/sc_input/data', $data, true)
        ]);
    }

    public function inputsc_list()
    {
        $list = $this->input_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $inputsc) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $inputsc->datel;
            $row[] = $inputsc->nama_pelanggan;
            $row[] = $inputsc->myir;
            $row[] = $inputsc->cp;
            $row[] = $inputsc->odp;
            $row[] = $inputsc->tgl_req_sc;
            $row[] = $inputsc->fullname;
            $row[] = $inputsc->status;
            $row[] = $inputsc->keterangan;
            if ($this->session->userdata('level') == 5) {
                $row[] = '<button type="button" class="btn btn-sm btn-icon btn-flat btn-primary" data-toggle="tooltip"
                              data-original-title="Edit" onclick="detail(' . "'" . $inputsc->sales_id . "'" . ')"><i class="icon md-edit"></i></button>
                <button type="button" class="btn btn-sm btn-icon btn-flat btn-danger" data-toggle="tooltip"
                data-original-title="Delete" onclick="delete_data(' . "'" . $inputsc->sales_id . "'" . ')"><i class="icon md-close"></i></a>';
            } else {
                $row[] = '<button type="button" class="btn btn-sm btn-icon btn-flat btn-primary" data-toggle="tooltip"
                              data-original-title="Edit" onclick="detail(' . "'" . $inputsc->sales_id . "'" . ')"><i class="icon md-edit"></i></button>';
            }
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->input_model->count_all(),
            "recordsFiltered" => $this->input_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function detail($id)
    {
        $data = $this->input_model->get_by_id($id);
        echo json_encode($data);
    }

    public function update()
    {
        $this->_validate();
        $sales_id = $this->input->post('id');
        if ($this->input->post('status_update') == 'donesc') {
            $data = array(
                'datel'          => $this->input->post('datel'),
                'nama_pelanggan' => $this->input->post('nama_pelanggan'),
                'paket'          => $this->input->post('paket'),
                'odp'            => $this->input->post('odp'),
                'sc'             => intval(preg_replace('/[^0-9]+/', '', $this->input->post('sc')), 10),
                'new_sc'         => intval(preg_replace('/[^0-9]+/', '', $this->input->post('sc')), 10),
                'tgl_update'     => date('Y-m-d H:i:s'),
                'tgl_input_sc'   => date('Y-m-d H:i:s'),
                'input_sc_by'    => $this->session->userdata('user_id'),
                'update_by'      => $this->session->userdata('user_id'),
                'status'         => $this->input->post('status_update'),
                'status_id'      => $this->input->post('status_id'),
                'keterangan'     => $this->input->post('ket')
            );

            $datalog = array(
                'sales_id'      => $sales_id,
                'action_by'     => $this->session->userdata('nama'),
                'action_on'     => date('Y-m-d H:i:s'),
                'action_status' => 5,
                'a_keterangan'  => $this->input->post('ket')
            );
        } else {
            if ($this->input->post('status_update') == 'progfcc' || $this->input->post('status_update') == 'blmdepo' || $this->input->post('status_update') == 'kendalasc') {
                $data = array(
                    'datel'          => $this->input->post('datel'),
                    'nama_pelanggan' => $this->input->post('nama_pelanggan'),
                    'paket'          => $this->input->post('paket'),
                    'odp'            => $this->input->post('odp'),
                    'tgl_update'     => date('Y-m-d H:i:s'),
                    'update_by'      => $this->session->userdata('user_id'),
                    'status'         => $this->input->post('status_update'),
                    'status_id'      => $this->input->post('status_id'),
                    'keterangan'     => $this->input->post('ket')
                );

                if ($this->input->post('status_update') == 'progfcc') {
                    $action_status = 4;
                } elseif ($this->input->post('status_update') == 'blmdepo') {
                    $action_status = 18;
                } elseif ($this->input->post('status_update') == 'kendalasc') {
                    $action_status = 19;
                } else {
                    $action_status = 999;
                }
                $datalog = array(
                    'sales_id'      => $sales_id,
                    'action_by'     => $this->session->userdata('nama'),
                    'action_on'     => date('Y-m-d H:i:s'),
                    'action_status' => $action_status,
                    'a_keterangan'  => $this->input->post('ket')
                );
            } else {
                $data = array(
                    'datel'          => $this->input->post('datel'),
                    'nama_pelanggan' => $this->input->post('nama_pelanggan'),
                    'paket'          => $this->input->post('paket'),
                    'odp'            => $this->input->post('odp'),
                    'keterangan'     => $this->input->post('ket')
                );
            }
        }

        $this->input_model->update(array('sales_id' => $this->input->post('id')), $data);
        $this->db->insert('tb_log', $datalog);
        echo json_encode(
            array(
                "status" => TRUE,
                'pesan' => '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>Well done!</b> Data successfully updated!</div>'
            )
        );

        $meid        = $this->input->post('meid');
        $sales_id    = $this->input->post('id');
        $updateby    = $this->session->userdata('nama');
        $sc          = intval(preg_replace('/[^0-9]+/', '', $this->input->post('sc')), 10);
        $alamat      = $this->input->post('alamat');
        $plgn        = $this->input->post('nama_pelanggan');
        $sales       = $this->input->post('sales_name');
        $odp         = $this->input->post('req_sc_odp');
        $cp          = $this->input->post('cp');
        $status_or   =  strtoupper($this->input->post('status_update'));
        $ket_up      = $this->input->post('ket');
        $loc         = $this->input->post('lat_long');
        $telegram_id = $this->input->post('mefrom');
        $telegram_id_t = $this->input->post('req_sc_by'); //hakim
        //$telegram_id = -391344461; //TES BOT
        if ($loc == null || $loc == "") {
            $lat = 0;
            $lng = 0;
        } else {
            $pecahloc   = explode(',', $loc);
            $lat        = str_replace(" ", "", $pecahloc[0]);
            $lng        = str_replace(" ", "", $pecahloc[1]);
        }

        if ($ket_up == null) {
            $ket_up = "-";
        } else {
            $ket_up = $ket_up;
        }

        if ($status_or == 'DONESC') {
            $message_text = "SC$sc\n";
            $message_text .= "NAMA PELANGGAN : $plgn\n";
            $message_text .= "ALAMAT : $alamat\n";
            $message_text .= "SALES : $sales\n";
            $message_text .= "CP : $cp\n";
            $message_text .= "ODP : $odp\n";
            $message_text .= "LOC : \nhttps://www.google.co.id/maps/search/$lat,+$lng";
        } else {
            if ($status_or == 'PROGFCC' || $status_or == 'BLMDEPO' || $status_or == 'KENDALASC') {
                $message_text = "STATUS ORDER : ($status_or) \n";
                $message_text .= "JA$sales_id\n";
                $message_text .= "NAMA PELANGGAN : $plgn\n";
                $message_text .= "ALAMAT : $alamat\n";
                $message_text .= "SALES : $sales\n";
                $message_text .= "CP : $cp\n";
                $message_text .= "ODP : $odp\n";
                $message_text .= "KET :\n";
                $message_text .= "$ket_up \n\n";
                $message_text .= " ~ $updateby";
            } else {
                $message_text = "";
            }
        }
        sendMessage($telegram_id, $message_text, $meid);
        sendChat($telegram_id_t, $message_text);
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
        $post = $this->input->post(NULL, TRUE);
        $sc   = intval(preg_replace('/[^0-9]+/', '', $post['sc']), 10);
        $cek  = $this->db->query("SELECT sc FROM tb_sales where sc='" . $sc . "'")->num_rows();

        if ($this->input->post('sc') != '' and $this->input->post('status_update') == '') {
            $data['inputerror'][] = 'status_update';
            $data['error_string'][] = 'STATUS is required';
            $data['status'] = FALSE;
        }
        if (($this->input->post('sc') != '') and ($cek > 0)) {
            $data['inputerror'][] = 'sc';
            $data['error_string'][] = 'SC already in use. Please use another SC!';
            $data['status'] = FALSE;
        }
        if ($this->input->post('status_update') == 'donesc') {
            if ($this->input->post('sc') == '') {
                $data['inputerror'][] = 'sc';
                $data['error_string'][] = 'SC is required';
                $data['status'] = FALSE;
            }
            if ($cek > 0) {
                $data['inputerror'][] = 'sc';
                $data['error_string'][] = 'SC already in use. Please use another SC!';
                $data['status'] = FALSE;
            }
        }
        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }

    public function delete($id)
    {
        $this->input_model->delete_by_id($id);
        echo json_encode(
            array(
                "status" => TRUE,
                'pesan' => '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>Well done!</b> Data successfully removed!</div>'
            )
        );
    }
}

/* End of file Sc_input.php */
/* Location: ./application/controllers/sales/Sc_input.php */