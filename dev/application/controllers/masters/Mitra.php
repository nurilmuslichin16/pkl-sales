<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mitra extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('logged_in') != TRUE) {
            redirect(base_url("auth"));
        }

        if (menuMitra($this->session->userdata('level')) == false) {
            redirect(base_url("welcome"));
        }
    }

    public function index()
    {
        $data['title']         = 'Master';
        $data['subtitle']     = 'Mitra';
        $this->load->view('template', [
            'content' => $this->load->view('masters/mitra', $data, true)
        ]);
    }

    public function ajax_list()
    {
        $list = $this->mitra_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $mitra) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $mitra->nama_mitra;
            $row[] = $mitra->singkat;
            $row[] = $mitra->jenis_mitra;
            $row[] = $mitra->pic;
            $row[] = $mitra->no_hp;

            if (cannotDelete($this->session->userdata('level'))) {
                $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_data(' . "'" . $mitra->id_mitra . "'" . ')"><i class="fa fa-edit"></i> Edit</a>';
            } else {
                $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_data(' . "'" . $mitra->id_mitra . "'" . ')"><i class="fa fa-edit"></i> Edit</a>
                      <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_data(' . "'" . $mitra->id_mitra . "'" . ')"><i class="fa fa-trash"></i> Delete</a>';
            }

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->mitra_model->count_all(),
            "recordsFiltered" => $this->mitra_model->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function ajax_edit($id)
    {
        $data = $this->mitra_model->get_by_id($id);
        echo json_encode($data);
    }

    public function ajax_add()
    {
        $this->_validate();
        $data = array(
            'nama_mitra'    => $this->input->post('nama_mitra'),
            'singkat'         => $this->input->post('singkat'),
            'jenis_mitra'     => $this->input->post('jenis_mitra'),
            'pic'             => $this->input->post('pic'),
            'no_hp'         => $this->input->post('no_hp'),
            'alamat'         => !empty($this->input->post('alamat')) ? $this->input->post('alamat') : null
        );
        $insert = $this->mitra_model->save($data);
        echo json_encode(
            array(
                "status"    => TRUE,
            )
        );
    }

    public function ajax_update()
    {
        $this->_validate();
        $data = array(
            'nama_mitra'    => $this->input->post('nama_mitra'),
            'singkat'         => $this->input->post('singkat'),
            'jenis_mitra'     => $this->input->post('jenis_mitra'),
            'pic'             => $this->input->post('pic'),
            'no_hp'         => $this->input->post('no_hp'),
            'alamat'         => !empty($this->input->post('alamat')) ? $this->input->post('alamat') : null
        );
        $this->mitra_model->update(array('id_mitra' => $this->input->post('id')), $data);
        echo json_encode(
            array(
                "status"    => TRUE,
            )
        );
    }

    public function ajax_delete($id)
    {
        $this->mitra_model->delete_by_id($id);
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

        if ($this->input->post('nama_mitra') == '') {
            $data['inputerror'][] = 'nama_mitra';
            $data['error_string'][] = 'Nama Mitra is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('singkat') == '') {
            $data['inputerror'][] = 'singkat';
            $data['error_string'][] = 'Singkatan is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('jenis_mitra') == '') {
            $data['inputerror'][] = 'jenis_mitra';
            $data['error_string'][] = 'Kategori is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('pic') == '') {
            $data['inputerror'][] = 'pic';
            $data['error_string'][] = 'PIC is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('no_hp') == '') {
            $data['inputerror'][] = 'no_hp';
            $data['error_string'][] = 'Kontak is required';
            $data['status'] = FALSE;
        }

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }
}

/* End of file Mitra.php */
/* Location: ./application/controllers/Mitra.php */