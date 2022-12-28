<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Track_order extends MY_Controller {

	public function __construct(){
        parent::__construct();
        if($this->session->userdata('logged_in') != TRUE){
            redirect(base_url("auth"));
        }
    }

	public function index()
	{
		$data['title']    = 'Sales';
		$data['subtitle'] = 'Track Order';
		$this->load->view('template',[
			'content' => $this->load->view('sales/track_order/form',$data,true)
		]);
	}

	public function log()
    {
        $sales_id  = $this->input->post('sales_id');
        $data['title']      = 'LOG ORDER';
        $data['subtitle']   = "Hasil Penelusuran JA$sales_id";

        $data['results'] = $this->wo_model->search_ja($sales_id)->result_array();
        $this->load->view('template',[
            'content' => $this->load->view('sales/track_order/result',$data,true)
        ]);
    }

    public function history_popup($id)
    {
        $data['isi'] = $this->wo_model->search_ja($id)->result_array();
        echo json_encode($data);
    }

    public function history_project($id)
    {
        $data['isi'] = $this->project_model->search_project($id)->result_array();
        echo json_encode($data);
    }

    public function history($id)
    {
        $data['title']      = 'LOG ORDER';
        $data['subtitle']   = "History JA$id";

        $data['results'] = $this->wo_model->search_ja($id)->result_array();
        $this->load->view('template',[
            'content' => $this->load->view('sales/track_order/histroy',$data,true)
        ]);
    }

}

/* End of file Track_order.php */
/* Location: ./application/controllers/sales/Track_order.php */