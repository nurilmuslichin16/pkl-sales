<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class No_kategori extends MY_Controller {

	public function __construct(){
        parent::__construct();
        show_404();
    }

	public function index()
	{
		$data['title'] 		    = 'Sales Order';
		$data['subtitle'] 	    = 'NULL kategori';
		$data['datas'] 	 		= $this->db->from('tb_sales')->join('tb_salesman', 'tb_salesman.s_telegram_id = tb_sales.message_from')->join('tb_teknisi', 'tb_teknisi.t_telegram_id = tb_sales.progress_to','left')->where('kategori',null)->where('status','waiting')->get()->result_array();
        $this->load->view('template',[
            'content' => $this->load->view('sales/work_order/no_kat/view/all',$data,true)
        ]);
	}

	public function send_no_kat()
	{
		$user_ids   = $this->input->post('user_ids');
		$list       = implode(",", $user_ids);
	    $pecah      = explode(",", $list);
	    $totalData  = sizeof($pecah);
	    $index = 0;

	    $datas = array(
	    	'kategori' 		=> 1
	    );

	    for ($i=0; $i < $totalData; $i++) {
	    	$cekorder = $this->db->query("SELECT sales_id, status_id FROM tb_sales where sales_id='".$pecah[$index]."' AND status_id = 1")->num_rows();
	    	if ($cekorder > 0) {
	    		$this->wo_model->update_no_kat(array('sales_id' => $pecah[$index]), $datas);
			    $query = $this->db->get_where('tb_sales', array('sales_id' => $pecah[$index]))->row_array();

			    $to_sales = $query['message_from'];
			    $dtl 	  = $query['datel'];

			    $pecahloc   = explode(',', $query['lat_long']);
	            $lat        = str_replace(" ", "", $pecahloc[0]);
	            $lng        = str_replace(" ", "", $pecahloc[1]);

	            $kat = $query['kategori'];

	            if ($kat == 1) {
	              $kategori = 'DEAL, ODP READY';
	            }
	            elseif ($kat == 2) {
	              $kategori = 'NOT DEAL, ODP READY';
	            }
	            elseif ($kat == 3) {
	              $kategori = 'UNSC';
	            }
		        
		        $message_text = "ORDER\n";
		        $message_text .= "JA$pecah[$index] \n";
		        $message_text .= "NAMA PELANGGAN : $query[nama_pelanggan]\n";
		        $message_text .= "CP : $query[cp]\n";
		        $message_text .= "ODP : $query[odp]\n";
		        $message_text .= "ALAMAT : $query[alamat]\n";
		        $message_text .= "JARAK TIANG : $query[jarak_tiang]\n";
		        $message_text .= "KATEGORI : $kategori\n";
		        $message_text .= "MYIR : $query[myir]\n";
		        $message_text .= "LOKASI : \nhttps://www.google.co.id/maps/search/$lat,+$lng";
		        $index++;
		        sendChat($to_sales, $message_text);

		        switch ($dtl) {
				    case 'PKL':
				        $chatid = -263944966;
				        break;
				    case 'BRB':
				        $chatid = -341677349;
				        break;
				    case 'BTG':
				        $chatid = -280898518;
				        break;
				    case 'TEG':
				        $chatid = -338613303;
				        break;
				    case 'SLW':
				        $chatid = -336766109;
				        break;
				    case 'PML':
				        $chatid = -371367732;
				        break;

				    default:
				        
						break;
				}

				sendChat($chatid, $message_text);
	    	}
	    }

	    echo json_encode(
            array(
                "status" => TRUE,
                'pesan'=>'<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>Well done!</b> '.$index.' order sucessfully send to sales & amunisi grup!</div>'
            )
        );
	}

}

/* End of file Work_order.php */
/* Location: ./application/controllers/sales/Work_order.php */