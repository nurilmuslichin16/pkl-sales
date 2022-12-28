<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Publik extends MY_Controller {

	private $risma     = "risma";
    private $kpro      = "kpro";

	public function __construct()
    {
		parent::__construct();
	}

	public function import_risma()
	{
		include APPPATH.'third_party/PHPExcel/PHPExcel.php';
        $loadexcel = PHPExcel_IOFactory::load('uploads/'.$this->risma.'.xlsx');
        $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
		$data2 = array();
        $b = 'No Ref';
        $g = 'Ket Paket';
        $q = 'ODP';
        if ($b != $sheet[2]['B'] ||	$g != $sheet[2]['G'] || $q != $sheet[2]['Q']) {
            echo "Format tidak sesuai!";
        }
        else{
            $numrow = 1;
            foreach($sheet as $row){
                if($numrow > 2){
                    if (!empty($row['B'])) {
                        $pctrack_id    = explode("-",$row['N']);
                        $pcodp         = explode("-",$row['Q']);
                        $track_id      = $pctrack_id[1];
                        $datel         = set_datel(!empty($pcodp[1]) ? $pcodp[1] : 'ERR');
                        $lat_lng       = $row['R'];
                        $cekmyi        = $this->db->query("SELECT myir FROM tb_sales WHERE myir='".$track_id."' AND tgl_post >= now()-interval 3 MONTH")->num_rows();
                        if ($cekmyi <= 0) { //cek myir di database
                            if ($datel == 'UNF') {
                                $almt = strtolower($row['S']);
                                $datel = datel_by_alamat($almt);
                            }
                            $data_ins = array(
                                'datel'     	  => $datel,
                                'nama_pelanggan'  => $row['C'],
                                'alamat'      	  => $row['S'],
                                'cp'              => $row['D'],
                                'odp'             => $row['Q'],
                                'email'           => $row['F'],
                                'lat_long'	      => $lat_lng,
                                'kode'            => $row['J'],
                                'paket'  	      => $row['G'],
                                'myir'  	      => $track_id,
                                'kategori'	      => 1,
                                'message_id'	  => NULL,
                                'message_from'	  => 73913770,
                                'tgl_post'	      => date('Y-m-d H:i:s'),
                                'tgl_update'	  => date('Y-m-d H:i:s'),
                                'tgl_done_fcc'	  => date('Y-m-d H:i:s'),
                                'status_id'       => 1,
                                'status'          => 'scbe',
                                'keterangan'      => 'BULK INSERT RISMA - SYSTEM'
                            );
                            $dtinstid = $this->upload_model->deal_insert($data_ins);
                            $dta = $this->db->get_where('tb_sales', array('sales_id' => $dtinstid))->row_array();
                            $data_log = array(
                                'sales_id'    		=> $dtinstid,
                                'action_by'			=> $this->session->userdata('nama').'-Upload Bulk Risma by System',
                                'action_on'	        => date('Y-m-d H:i:s'),
                                'action_status'	    => 1
                            );
                            $this->db->insert('tb_log', $data_log);
                            if ($dta['kategori'] == 1) {
                                $dtl      = $dta['datel'];
                                $pecahloc = explode(',', $dta['lat_long']);
                                $lat      = str_replace(" ", "", $pecahloc[0]);
                                $lng      = str_replace(" ", "", $pecahloc[1]);
                                $salesman       = getSalesman($dta['kode']) == 'NULL' ? $dta['kode'] :  getSalesman($dta['kode']);
                            
                                $text = "ORDER\n";
                                $text .= "JA$dta[sales_id] \n";
                                $text .= "NAMA PELANGGAN : $dta[nama_pelanggan]\n";
                                $text .= "CP : $dta[cp]\n";
                                $text .= "ODP : $dta[odp]\n";
                                $text .= "ALAMAT : $dta[alamat]\n";
                                $text .= "JARAK TIANG : $dta[jarak_tiang]\n";
                                $text .= "KATEGORI : DEAL, ODP READY\n";
                                $text .= "MYIR : $dta[myir]\n";
                                $text .= "PAKET : $dta[paket]\n";
                                $text .= "SALES : $salesman\n";
                                $text .= "LOKASI : \nhttps://www.google.co.id/maps/search/$lat,+$lng";
                                
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
                                sendChatHtml($chatid, $text);
                            }
                        }
						else{
							$cekmyi2 = $this->db->query("SELECT myir FROM tb_sales WHERE myir='".$track_id."' AND (status_id = 41 OR status_id = 42 OR status_id = 43)")->num_rows();
							if ($cekmyi2 > 0) {
								$dte = $this->db->get_where('tb_sales', array('myir' => $track_id))->row_array();
								array_push($data2, array(
									'sales_id'        => $dte['sales_id'],
									'status_id'       => 1,
									'status'          => 'scbe',
                                    'paket'  	      => $row['G'],
									'keterangan'      => 'BULK UPDDATE TO SCBE - RISMA BY SYSTEM',
									'tgl_done_fcc'	  => date('Y-m-d H:i:s'),
                                    'tgl_update'	  => date('Y-m-d H:i:s')
								));
								if ($dte['kategori'] == 1) {
									$dtl = $dte['datel'];
									if ($dte['kategori'] == 1) {
										$kategori = 'DEAL, ODP READY';
									}
									elseif ($dte['kategori'] == 2) {
										$kategori = 'DEAL, ODP NOT READY';
									}
									elseif ($dte['kategori'] == 3) {
										$kategori = 'UNSC';
									}
									$pecahloc       = explode(',', $dte['lat_long']);
									$lat            = str_replace(" ", "", $pecahloc[0]);
									$lng            = str_replace(" ", "", $pecahloc[1]);
                                    $salesman       = getSalesman($dte['kode']) == 'NULL' ? $dte['kode'] :  getSalesman($dte['kode']);
								
									$text = "ORDER\n";
									$text .= "JA$dte[sales_id] \n";
									$text .= "NAMA PELANGGAN : $dte[nama_pelanggan]\n";
									$text .= "CP : $dte[cp]\n";
									$text .= "ODP : $dte[odp]\n";
									$text .= "ALAMAT : $dte[alamat]\n";
									$text .= "JARAK TIANG : $dte[jarak_tiang]\n";
									$text .= "KATEGORI : $kategori\n";
									$text .= "MYIR : $dte[myir]\n";
									$text .= "PAKET : $row[G]\n";
									$text .= "SALES : $salesman\n";
									$text .= "LOKASI : \nhttps://www.google.co.id/maps/search/$lat,+$lng";
									
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
									sendChatHtml($chatid, $text);
								}
								/*send message to sales*/
								$telegram_id = $dte['message_from'];
								$meid        = $dte['message_id'];
								$sales_id    = $dte['sales_id'];
								$updateby    = $this->session->userdata('nama');
								$message_text = "ORDER SET TO : (SCBE) \n";
								$message_text .= "JA$sales_id\n";
								$message_text .= "KET :\n";
								$message_text .= "- \n\n";
								$message_text .= " ~ $updateby";
								sendMessage($telegram_id, $message_text, $meid);
								/*end of send message to sales*/
							}
						}
                    }
                }
                $numrow++;
            }
            if(!empty($data2)) {
				$this->db->update_batch('tb_sales', $data2, 'sales_id');
			}
            echo "Done Execute ".date('Y-m-d H:i:s');
        }
	}

    public function import_kpro()
	{
		include APPPATH.'third_party/PHPExcel/PHPExcel.php';
        $excelreader = new PHPExcel_Reader_Excel2007();
        $loadexcel = PHPExcel_IOFactory::load('uploads/'.$this->kpro.'.xls');
        $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
        $b = 'ORDER_ID';
        $e = 'DATEL';
        $g = 'UNIT';
        $k = 'TYPE_CHANNEL';
        $n = 'STATUS_RESUME';
        $s = 'DEVICE_ID';
        $u = 'PACKAGE_NAME';
        $v = 'LOC_ID';
        $z = 'CUSTOMER_NAME';
        $aa = 'CONTACT_HP';
        $ab = 'INS_ADDRESS';
        $ae = 'KCONTACT';
        if ($b != $sheet[1]['B'] || $e != $sheet[1]['E'] || $g != $sheet[1]['G'] || $k != $sheet[1]['K'] || $n != $sheet[1]['N'] || $s != $sheet[1]['S'] || $u != $sheet[1]['U'] || $v != $sheet[1]['V'] || $z != $sheet[1]['Z'] || $aa != $sheet[1]['AA'] || $ab != $sheet[1]['AB'] || $ae != $sheet[1]['AE']){
            echo "Format KPRO tidak sesuai.";
        }
        else{
            $numrow = 1;
            foreach($sheet as $row){
                if($numrow > 1){
                    if ($row['B'] != "" && (empty($row['S']) || $row['S'] = '') && stripos($row['N'], 'WFM - UN-SCS') == false) {
                        $order_date     = $row['Q'];
                        $mod_od         = str_replace('/', '-', $order_date);
                        $year_od        = date('Y', strtotime($mod_od));
                        $month_od       = date('m', strtotime($mod_od));
                        if (($year_od == '2021' && $month_od == 12) || $year_od >= 2022) {
                            $pcodp         	= explode("-",$row['V']);
                            $pccontact     	= explode("/",$row['AE']);
                            $sc      		= $row['B'];
                            $datel          = set_datel($pcodp[1]);
                            $cutodp         = explode(" ",$row['V']);
                            $lat_lng        = '-6.8959407,109.6394839';
                            $ceksc          = $this->db->query("SELECT new_sc FROM tb_sales WHERE new_sc='".$sc."' AND tgl_post >= now()-interval 3 MONTH")->num_rows();
                            if ($ceksc <= 0) {
                                $data_ins = array(
                                    'datel'     	  => $datel,
                                    'nama_pelanggan'  => $row['Z'],
                                    'alamat'      	  => $row['AB'],
                                    'cp'              => $row['AA'],
                                    'odp'             => $cutodp[0],
                                    'lat_long'	      => $lat_lng,
                                    'kode'            => $row['G'].' '.$row['K'],
                                    'paket'  	      => $row['U'],
                                    'kategori'	      => 1,
                                    'message_id'	  => NULL,
                                    'sc'			  => $row['B'],
                                    'new_sc'		  => $row['B'],
                                    'message_from'	  => 73913770,
                                    'tgl_post'	      => date('Y-m-d H:i:s'),
                                    'tgl_update'	  => date('Y-m-d H:i:s'),
                                    'tgl_done_fcc'	  => date('Y-m-d H:i:s'),
                                    'status_id'       => 1,
                                    'status'          => 'scbe',
                                    'keterangan'      => 'BULK INSERT SCBE (KPRO) - SYSTEM'
                                );
                                $dtinstid = $this->upload_model->deal_insert($data_ins);
                                $dta = $this->db->get_where('tb_sales', array('sales_id' => $dtinstid))->row_array();
                                $data_log = array(
                                    'sales_id'    		=> $dtinstid,
                                    'action_by'			=> $this->session->userdata('nama').'-Upload Bulk Manual Source KPRO - SYSTEM',
                                    'action_on'	        => date('Y-m-d H:i:s'),
                                    'action_status'	    => 1
                                );
                                $this->db->insert('tb_log', $data_log);
                                if ($dta['kategori'] == 11) {
                                    $dtl      = $dta['datel'];
                                    $pecahloc = explode(',', $dta['lat_long']);
                                    $lat      = str_replace(" ", "", $pecahloc[0]);
                                    $lng      = str_replace(" ", "", $pecahloc[1]);
                                
                                    $text = "ORDER\n";
                                    $text .= "JA$dta[sales_id] \n";
                                    $text .= "NAMA PELANGGAN : $dta[nama_pelanggan]\n";
                                    $text .= "CP : $dta[cp]\n";
                                    $text .= "ODP : $dta[odp]\n";
                                    $text .= "ALAMAT : $dta[alamat]\n";
                                    $text .= "JARAK TIANG : $dta[jarak_tiang]\n";
                                    $text .= "KATEGORI : DEAL, ODP READY\n";
                                    $text .= "SC : $dta[new_sc]\n";
                                    $text .= "PAKET : $dta[paket]\n";
                                    $text .= "SALES : $dta[kode]\n";
                                    $text .= "LOKASI : \nhttps://www.google.co.id/maps/search/$lat,+$lng";
                                    
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
                                    sendChat($chatid, $text);
                                }
                            }
                        }
                    }	
                }
                $numrow++;
            }
            echo "Done Execute KPRO ".date('Y-m-d H:i:s');
        }
	}

}

/* End of file Upload.php */
/* Location: ./application/controllers/provisioning/Upload.php */