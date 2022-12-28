<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Teknisi extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('logged_in') != TRUE) {
            redirect(base_url("auth"));
        }

        if (menuTeknisi($this->session->userdata('level')) == false) {
            redirect(base_url("welcome"));
        }
    }

    public function index()
    {
        $data['title']             = 'Users';
        $data['subtitle']         = 'Teknisi';
        $this->load->view('template', [
            'content' => $this->load->view('users/teknisi/data', $data, true)
        ]);
    }

    public function users_list()
    {
        $list = $this->teknisi_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $users) {
            $no++;
            $row = array();
            $row[] = '<label class="pos-rel">
						<input type="checkbox" class="ace" id="check-item" name="idtele[]" value="' . $users->t_telegram_id . '" />
						<span class="lbl"></span>
					</label>';
            $row[] = $users->datel;
            $row[] = $users->nik;
            $row[] = $users->nama_teknisi;
            $row[] = $users->crew;
            $row[] = $users->mitra;
            $row[] = $users->jenis == 'rb' ? "Resources Base" : ($users->jenis == 'ob' ? "Order Based" : "");
            $row[] = $users->active == 1 ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Blocked</span>';

            if (cannotDelete($this->session->userdata('level'))) {
                $row[] = '<a class="btn btn-xs btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_users(' . "'" . $users->t_telegram_id . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>';
            } else {
                $row[] = '<a class="btn btn-xs btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_users(' . "'" . $users->t_telegram_id . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                      <a class="btn btn-xs btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_users(' . "'" . $users->t_telegram_id . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            }

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->teknisi_model->count_all(),
            "recordsFiltered" => $this->teknisi_model->count_filtered(),
            "data" => $data,
        );

        echo json_encode($output);
    }

    public function users_edit($id)
    {
        $data = $this->teknisi_model->get_by_id($id);
        echo json_encode($data);
    }

    public function users_update()
    {
        $this->_validate();
        $data = array(
            'nik'             => $this->input->post('nik'),
            'datel'         => $this->input->post('datel'),
            'nama_teknisi'     => $this->input->post('nama_teknisi'),
            'crew'             => $this->input->post('crew'),
            'mitra'         => $this->input->post('mitra'),
            'active'         => $this->input->post('active'),
            'libur'         => $this->input->post('libur'),
            'jenis'         => $this->input->post('jenis')
        );
        $this->teknisi_model->update(array('t_telegram_id' => $this->input->post('id')), $data);
        echo json_encode(
            array(
                "status" => TRUE,
                'pesan' => '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>Well done!</b> User successfully changed!</div>'
            )
        );
    }

    public function users_delete($id)
    {
        $this->teknisi_model->delete_by_id($id);
        echo json_encode(
            array(
                "status" => TRUE,
                'pesan' => '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>Well done!</b> User successfully removed!</div>'
            )
        );
    }

    public function approve_user()
    {
        $user_ids     = $this->input->post('user_ids');
        $list        = implode(",", $user_ids);
        $pecah        = explode(",", $list);
        $totalData  = sizeof($pecah);
        $index         = 0;

        $datas = array(
            'active' => 1
        );


        for ($i = 0; $i < $totalData; $i++) {
            $cek = $this->db->query("SELECT datel,t_telegram_id FROM tb_teknisi WHERE t_telegram_id='" . $pecah[$index] . "' AND active = 0")->row();
            if (!empty($cek)) {
                //insert dummy order for dashboard teknisi
                $data_dummy_order = array(
                    'datel' => $cek->datel,
                    'nama_pelanggan' => 'DUMMY ' . $cek->t_telegram_id,
                    'progress_to' => $cek->t_telegram_id,
                    'tgl_update' => date('Y-m-d H:i:s'),
                    'status' => 'DUMMY',
                    'status_id' => 127,
                    'keterangan' => 'DUMMY ORDER DAILY'
                );
                $this->db->insert('tb_sales', $data_dummy_order);
                // update teknisi to active
                $this->db->update('tb_teknisi', $datas, array('t_telegram_id' => $pecah[$index]));
                $query = $this->db->get_where('tb_teknisi', array('t_telegram_id' => $pecah[$index]))->row_array();
                $message_text = "Salam $query[nama_teknisi], kamu telah diapprove sebagai teknisi provisioning.. Selamat Bekerja :)";
                sendChat($pecah[$index], $message_text);
                $index++;
            }
        }

        echo json_encode(
            array(
                "status" => TRUE,
                'pesan' => '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>Well done!</b> ' . $totalData . ' User successfully activated!</div>'
            )
        );
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('nik') == '') {
            $data['inputerror'][] = 'nik';
            $data['error_string'][] = 'NIK is required';
            $data['status'] = FALSE;
        }
        if ($this->input->post('nama_teknisi') == '') {
            $data['inputerror'][] = 'nama_teknisi';
            $data['error_string'][] = 'Nama Teknisi is required';
            $data['status'] = FALSE;
        }
        if ($this->input->post('crew') == '') {
            $data['inputerror'][] = 'crew';
            $data['error_string'][] = 'CREW is required';
            $data['status'] = FALSE;
        }

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }
}

/* End of file Teknisi.php */
/* Location: ./application/controllers/users/Teknisi.php */