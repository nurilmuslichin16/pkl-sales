<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sc_update extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('logged_in') != TRUE) {
            redirect(base_url("auth"));
        }

        if (menuRequestSc($this->session->userdata('level')) == false) {
            redirect(base_url("welcome"));
        }
    }

    public function index()
    {
        $data['title']    = 'Orders';
        $data['subtitle'] = 'Update SC';
        $this->load->view('template', [
            'content' => $this->load->view('sales/sc_update/search', $data, true)
        ]);
    }

    public function search_sc()
    {
        $search  = $this->input->post('search');
        $data['title']      = 'Orders';
        $data['subtitle']   = 'Hasil Pencarian ' . $search . '';

        $data['results'] = $this->update_model->search_sc($search)->result_array();
        $this->load->view('template', [
            'content' => $this->load->view('sales/sc_update/result', $data, true)
        ]);
    }

    public function detail($id)
    {
        $data = $this->update_model->get_by_id($id);
        echo json_encode($data);
    }

    public function update()
    {
        $new_sc     = intval(preg_replace('/[^0-9]+/', '', $this->input->post('new_sc')), 10);
        $sc_lama    = intval(preg_replace('/[^0-9]+/', '', $this->input->post('sc')), 10);
        $sales_id   = $this->input->post('id');
        if ($this->input->post('new_sc') != '') {
            $this->_validate();
        }

        if ($new_sc == '' && $sc_lama != '') {
            if ($this->input->post('segment') == 0) {
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
                    'status'         => 'donesc',
                    'status_id'      => 5,
                    'failwa'         => $this->input->post('failwa'),
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
                $data = array(
                    'datel'          => $this->input->post('datel'),
                    'nama_pelanggan' => $this->input->post('nama_pelanggan'),
                    'paket'          => $this->input->post('paket'),
                    'odp'            => $this->input->post('odp'),
                    'sc'             => intval(preg_replace('/[^0-9]+/', '', $this->input->post('sc')), 10),
                    'new_sc'         => intval(preg_replace('/[^0-9]+/', '', $this->input->post('sc')), 10),
                    'tgl_update'     => date('Y-m-d H:i:s'),
                    'update_by'      => $this->session->userdata('user_id'),
                    'failwa'         => $this->input->post('failwa'),
                    'keterangan'     => $this->input->post('ket')
                );
            }
        } elseif ($new_sc != '' && $sc_lama != '') {
            $data = array(
                'datel'          => $this->input->post('datel'),
                'nama_pelanggan' => $this->input->post('nama_pelanggan'),
                'paket'          => $this->input->post('paket'),
                'odp'            => $this->input->post('odp'),
                'failwa'         => $this->input->post('failwa'),
                'new_sc'         => intval(preg_replace('/[^0-9]+/', '', $this->input->post('new_sc')), 10),
                'tgl_update'     => date('Y-m-d H:i:s'),
                'update_by'      => $this->session->userdata('user_id'),
                'keterangan'     => $this->input->post('ket')
            );

            $datalog = array(
                'sales_id'      => $sales_id,
                'action_by'     => $this->session->userdata('nama'),
                'action_on'     => date('Y-m-d H:i:s'),
                'action_status' => 17,
                'a_keterangan'  => $this->input->post('ket')
            );
        } else {
            $data = array(
                'datel'          => $this->input->post('datel'),
                'nama_pelanggan' => $this->input->post('nama_pelanggan'),
                'alamat'         => $this->input->post('alamat'),
                'odp'            => $this->input->post('odp'),
                'failwa'         => $this->input->post('failwa'),
                'cp'             => $this->input->post('cp'),
                'lat_long'       => $this->input->post('lat_long'),
                'email'          => $this->input->post('email'),
                'myir'           => $this->input->post('myir'),
                'tgl_update'     => date('Y-m-d H:i:s'),
                'update_by'      => $this->session->userdata('user_id'),
                'keterangan'     => $this->input->post('ket')
            );
        }

        $this->update_model->update(array('sales_id' => $this->input->post('id')), $data);
        $this->db->insert('tb_log', $datalog);
        echo json_encode(
            array(
                "status" => TRUE,
                'pesan' => '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>Well done!</b> Data successfully updated!</div>'
            )
        );

        $meid        = $this->input->post('meid');
        $alamat      = $this->input->post('alamat');
        $plgn        = $this->input->post('nama_pelanggan');
        $sales       = $this->input->post('sales_name');
        $odp         = $this->input->post('odp');
        $cp          = $this->input->post('cp');
        $ket_up      = $this->input->post('ket');
        $loc         = $this->input->post('lat_long');
        $telegram_id = $this->input->post('mefrom');
        $telegram_id_t = $this->input->post('req_sc_by');

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

        if ($new_sc == '' && $sc_lama != '') {
            $sc          = intval(preg_replace('/[^0-9]+/', '', $this->input->post('sc')), 10);
            $message_text = "SC$sc\n";
            $message_text .= "NAMA PELANGGAN : $plgn\n";
            $message_text .= "ALAMAT : $alamat\n";
            $message_text .= "SALES : $sales\n";
            $message_text .= "CP : $cp\n";
            $message_text .= "ODP : $odp\n";
            $message_text .= "LOC : \nhttps://www.google.co.id/maps/search/$lat,+$lng";
        } elseif ($new_sc != '' && $sc_lama != '') {
            $sc          = intval(preg_replace('/[^0-9]+/', '', $this->input->post('new_sc')), 10);
            $message_text = "UPDATE SC$sc\n";
            $message_text .= "NAMA PELANGGAN : $plgn\n";
            $message_text .= "ALAMAT : $alamat\n";
            $message_text .= "SALES : $sales\n";
            $message_text .= "CP : $cp\n";
            $message_text .= "ODP : $odp\n";
            $message_text .= "LOC : \nhttps://www.google.co.id/maps/search/$lat,+$lng";
        } else {
            $message_text = "";
        }
        sendMessage($telegram_id, $message_text, $meid);
        sendChat($telegram_id_t, $message_text);
    }

    public function delete($id)
    {
        $this->update_model->delete_by_id($id);
        echo json_encode(
            array(
                "status" => TRUE,
                'pesan' => '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>Well done!</b> Data successfully removed! please refresh the page :)</div>'
            )
        );
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('new_sc') == '') {
            $data['inputerror'][] = 'new_sc';
            $data['error_string'][] = 'SC BARU is required';
            $data['status'] = FALSE;
        }
        if ($this->input->post('sc') == '') {
            $data['inputerror'][] = 'sc';
            $data['error_string'][] = 'You must input the SC first';
            $data['status'] = FALSE;
        }
        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }
}

/* End of file Sc_update.php */
/* Location: ./application/controllers/sales/Sc_update.php */