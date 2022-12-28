<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload_model extends CI_Model {

	public function upload_file($filename)
	{
	    $this->load->library('upload');

	    $config['upload_path'] = './uploads/';
	    $config['allowed_types'] = 'xlsx';
	    $config['max_size']  = '1024';
	    $config['overwrite'] = true;
	    $config['file_name'] = $filename;

	    $this->upload->initialize($config);
	    if($this->upload->do_upload('file')){
	      $return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
	      return $return;
	    }else{
	      $return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
	      return $return;
	    }
    }

    public function deal_insert($data_deal)
    {
        $this->db->insert('tb_sales', $data_deal);
        return $this->db->insert_id();
    }

	public function insert_multiple($data){
    	$this->db->insert_batch('tb_sales', $data);
  	}
      
      


}

/* End of file Upload_model.php */
/* Location: ./application/models/Upload_model.php */