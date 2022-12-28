<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelurusan extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('logged_in') != TRUE){
            redirect(base_url("auth"));
        }
    }

    public function index()
    {
        $data['title']          = 'Jarvis Sales';
        $data['subtitle']       = 'Pelurusan Daman';
        $this->load->view('template',[
            'content' => $this->load->view('sales/pelurusan/data',$data,true)
        ]);
    }

    public function list_data()
    {
        $list = $this->pelurusan_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $pelurusan) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $pelurusan->datel;
            $row[] = '<a class="btn btn-xs btn-primary" href="javascript:void(0)" title="Show SC" onclick="show_sc('."'".$pelurusan->odp_id."'".')">'.$pelurusan->odp_name.'</a>';
            $row[] = $pelurusan->progress;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->pelurusan_model->count_all(),
            "recordsFiltered" => $this->pelurusan_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function detail($id)
    {
        $data = $this->pelurusan_model->get_by_id($id);
        echo json_encode($data);
    }

    public function show_sc($odp)
    {
        $odp_name = getNameODP($odp);
        $data['isi'] = $this->pelurusan_model->show_sc($odp_name);
        echo json_encode($data);
    }

    public function update()
    {
        if (!empty($this->input->post('create_id'))) {
            $this->db->set('pelurusan', 1);
            $this->db->where('create_id', $this->input->post('create_id'));
            $this->db->update('tb_provisioning');

            echo json_encode(
                array(
                    "status"    => TRUE,
                )
            );
        }
        else{
            echo json_encode(
                array(
                    "status"    => FALSE,
                )
            );
        }
    }


}
