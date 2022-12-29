<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Upload extends MY_Controller
{

	private $filename        	= "upload_sales";
	private $filename_scbe   	= "scbe_bulk";
	private $filename_hsi    	= "scbe_hsi_bulk";
	private $filename_bges   	= "scbe_bges_bulk";
	private $filename_kpro   	= "psb_bulk";
	private $filename_pda    	= "pda_bulk";
	private $filename_addon  	= "addon_bulk";
	private $filename_jadwal 	= "jadwal_bulk";
	private $filename_dorongps 	= "dorongps_bulk";
	private $filename_risma  	= "risma_bulk";
	private $filename_reset 	= "reset_bulk";

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('logged_in') != TRUE) {
			redirect(base_url("auth"));
		}

		if (menuUpload($this->session->userdata('level')) == false) {
			redirect(base_url("welcome"));
		}
	}

	public function deal_sales()
	{
		$data = array();
		if (isset($_POST['upload'])) {
			$upload = $this->upload_model->upload_file($this->filename);
			if ($upload['result'] == "success") {
				include APPPATH . 'third_party/PHPExcel/PHPExcel.php';
				$loadexcel = PHPExcel_IOFactory::load('uploads/' . $this->filename . '.xlsx');
				$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true, true);
				$data = array();
				$data2 = array();

				$numrow = 1;
				foreach ($sheet as $row) {
					if ($numrow > 1) {

						$datel       = $row['A'];
						$nama_plgn   = $row['B'];
						$ktp  		 = $row['C'];
						$alamat      = $row['D'];
						$lat_lng 	 = $row['E'];
						$cp 		 = $row['F'];
						$email 		 = $row['G'];
						$odp 		 = $row['H'];
						$kode_sales  = $row['I'];
						$paket 		 = $row['J'];
						$jarak_tiang = $row['K'];
						$myir 		 = $row['L'];

						$data_deal = array(
							'datel'    			=> $datel,
							'nama_pelanggan'	=> $nama_plgn,
							'no_ktp'	        => $ktp,
							'alamat'	        => $alamat,
							'lat_long'	        => $lat_lng,
							'cp'	        	=> $cp,
							'email'	        	=> $email,
							'odp'	        	=> $odp,
							'kode'	        	=> $kode_sales,
							'paket'	        	=> $paket,
							'jarak_tiang'		=> $jarak_tiang,
							'myir'	        	=> $myir,
							'kategori'	    	=> 1,
							'message_id'		=> NULL,
							'message_from'		=> 73913770,
							'tgl_post'	    	=> date('Y-m-d H:i:s'),
							'tgl_update'	    => date('Y-m-d H:i:s')
						);

						$instid = $this->upload_model->deal_insert($data_deal);
						$d = $this->db->get_where('tb_sales', array('sales_id' => $instid))->row_array();
						$data_log = array(
							'sales_id'    		=> $instid,
							'action_by'			=> $this->session->userdata('nama') . '-Upload System',
							'action_on'	        => date('Y-m-d H:i:s'),
							'action_status'	    => 1
						);
						$this->db->insert('tb_log', $data_log);
						if ($instid) {
							$text = "ORDER\n";
							$text .= "JA$instid \n";
							$text .= "NAMA PELANGGAN : $d[nama_pelanggan]\n";
							$text .= "CP : $d[cp]\n";
							$text .= "ODP : $d[odp]\n";
							$text .= "ALAMAT : $d[alamat]\n";
							$text .= "JARAK TIANG : $d[jarak_tiang]\n";
							$text .= "PAKET : $d[paket]\n";
							$text .= "KATEGORI : DEAL, ODP READY\n";
							$text .= "MYIR : $d[myir]\n";
							$text .= "SALES : JARVIS \n";
							$text .= "LOKASI : \nhttps://www.google.co.id/maps/search";

							$chatid = send_amunisi_grup($datel, 'DCS');
						}
						sendChat($chatid, $text);
					}
					$numrow++;
				}
				$this->session->set_flashdata('info', '<div class="alert alert-success" role="alert">' . sizeof($data) . ' deal sales successfuly added! </div>');
				redirect('sales/upload/deal_sales');
			} else {
				$data['upload_error'] = $upload['error'];
			}
		}
		$data['title'] 		 = 'Deal Sales';
		$data['subtitle'] 	 = 'Upload';
		$this->load->view('template', [
			'content' => $this->load->view('sales/upload/deal_upload', $data, true)
		]);
	}

	public function myi()
	{
		if (isset($_POST['upload'])) {
			$source = $this->input->post('source');

			if ($source == "scbe") {
				$upload = $this->upload_model->upload_file($this->filename_scbe);
			} elseif ($source == "kpro") {
				$upload = $this->upload_model->upload_file($this->filename_kpro);
			} elseif ($source == "pda") {
				$upload = $this->upload_model->upload_file($this->filename_pda);
			} elseif ($source == "addon") {
				$upload = $this->upload_model->upload_file($this->filename_addon);
			} elseif ($source == "scbe_hsi") {
				$upload = $this->upload_model->upload_file($this->filename_hsi);
			} elseif ($source == "scbe_bges") {
				$upload = $this->upload_model->upload_file($this->filename_bges);
			} elseif ($source == "risma") {
				$upload = $this->upload_model->upload_file($this->filename_risma);
			}

			if ($upload['result'] == "success") {
				include APPPATH . 'third_party/PHPExcel/PHPExcel.php';
				if ($source == "scbe") {
					$loadexcel = PHPExcel_IOFactory::load('uploads/' . $this->filename_scbe . '.xlsx');
				} elseif ($source == "kpro") {
					$loadexcel = PHPExcel_IOFactory::load('uploads/' . $this->filename_kpro . '.xlsx');
				} elseif ($source == "pda") {
					$loadexcel = PHPExcel_IOFactory::load('uploads/' . $this->filename_pda . '.xlsx');
				} elseif ($source == "addon") {
					$loadexcel = PHPExcel_IOFactory::load('uploads/' . $this->filename_addon . '.xlsx');
				} elseif ($source == "scbe_hsi") {
					$loadexcel = PHPExcel_IOFactory::load('uploads/' . $this->filename_hsi . '.xlsx');
				} elseif ($source == "scbe_bges") {
					$loadexcel = PHPExcel_IOFactory::load('uploads/' . $this->filename_bges . '.xlsx');
				} elseif ($source == "risma") {
					$loadexcel = PHPExcel_IOFactory::load('uploads/' . $this->filename_risma . '.xlsx');
				}
				$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true, true);
				$data  = array();
				$data2 = array();
				$data3 = array();
				$data4 = array();
				$datahsi = array();
				$databgs = array();
				$datarisma = [];
				$statuserror = false;
				$pesanerror = '';

				if ($source == "scbe") {
					$a = 'Track ID';
					$b = 'Order Date';
					$c = 'Customer Name';
					$d = 'Alpro Name';
					$e = 'TN Number';
					$f = 'Status';
					$g = 'Witel';
					$h = 'Appointment';
					$i = 'Kcontact';
					$j = 'Address_Instalation';
					$k = 'Package';
					$l = 'SC ID';
					$m = 'Agent';
					$n = 'Action';
					if ($a != $sheet[1]['A'] ||	$b != $sheet[1]['B'] ||	$c != $sheet[1]['C'] ||	$d != $sheet[1]['D'] ||	$e != $sheet[1]['E'] ||	$f != $sheet[1]['F'] ||	$g != $sheet[1]['G'] ||	$h != $sheet[1]['H'] ||	$i != $sheet[1]['I'] ||	$j != $sheet[1]['J'] ||	$k != $sheet[1]['K'] ||	$l != $sheet[1]['L'] ||	$m != $sheet[1]['M'] ||	$n != $sheet[1]['N']) {
						$this->session->set_flashdata('error', '<b>Failed!</b> <br> Format file SCBE tidak sesuai! ');
					} else {
						$numrow = 1;
						foreach ($sheet as $row) {
							if ($numrow > 1) {
								if ($row['A'] != "" || $row['A'] != null) {
									$pctrack_id    = explode("-", $row['A']);
									$pcodp         = explode("-", $row['D']);
									$pccontact     = explode(";", $row['I']);
									$track_id      = $pctrack_id[1];
									$datel         = set_datel($pcodp[1]);
									$lat_lng       = '-6.8959407,109.6394839';
									$cekmyi        = $this->db->query("SELECT myir FROM tb_sales WHERE myir='" . $track_id . "' AND tgl_post >= now()-interval 3 MONTH")->num_rows();
									$dta           = $this->db->get_where('tb_sales', array('myir' => $track_id))->row_array();
									if ($cekmyi <= 0) { //cek myir di database
										$data_ins = array(
											'datel'     	  => $datel,
											'unit'            => 'DCS',
											'nama_pelanggan'  => $row['C'],
											'alamat'      	  => $row['J'],
											'cp'              => $pccontact[4],
											'odp'             => $row['D'],
											'lat_long'	      => $lat_lng,
											'kode'            => $pccontact[2],
											'paket'  	      => $row['K'],
											'myir'  	      => $track_id,
											'kategori'	      => 1,
											'message_id'	  => NULL,
											'message_from'	  => 73913770,
											'tgl_post'	      => date('Y-m-d H:i:s'),
											'tgl_update'	  => date('Y-m-d H:i:s'),
											'tgl_done_fcc'	  => date('Y-m-d H:i:s'),
											'status_id'       => 1,
											'status'          => 'scbe',
											'keterangan'      => 'BULK INSERT SCBE'
										);
										$dtinstid = $this->upload_model->deal_insert($data_ins);
										$dta = $this->db->get_where('tb_sales', array('sales_id' => $dtinstid))->row_array();
										$data_log = array(
											'sales_id'    		=> $dtinstid,
											'action_by'			=> $this->session->userdata('nama') . '-Upload Bulk MYI',
											'action_on'	        => date('Y-m-d H:i:s'),
											'action_status'	    => 1
										);
										$this->db->insert('tb_log', $data_log);
										if ($dta['kategori'] == 1) {
											$dtl      = $dta['datel'];
											$pecahloc = explode(',', $dta['lat_long']);
											$lat      = str_replace(" ", "", $pecahloc[0]);
											$lng      = str_replace(" ", "", $pecahloc[1]);
											$salesman = getSalesman($dta['kode']) == 'NULL' ? $dta['kode'] :  getSalesman($dta['kode']);

											$text = "ORDER\n";
											$text .= "JA$dta[sales_id] \n";
											$text .= "NAMA PELANGGAN : $dta[nama_pelanggan]\n";
											$text .= "CP : $dta[cp]\n";
											$text .= "ODP : $dta[odp]\n";
											$text .= "ALAMAT : $dta[alamat]\n";
											$text .= "JARAK TIANG : $dta[jarak_tiang]\n";
											$text .= "KATEGORI : <b>DCS</b> DEAL, ODP READY\n";
											$text .= "MYIR : $dta[myir]\n";
											$text .= "PAKET : $dta[paket]\n";
											$text .= "SALES : $salesman\n";
											$text .= "LOKASI : \nhttps://www.google.co.id/maps/search/$lat,$lng";

											$chatid = send_amunisi_grup($dtl, 'DCS');

											sendChatHtml($chatid, $text);
										}
									} else {
										$cekmyi2 = $this->db->query("SELECT myir FROM tb_sales WHERE myir='" . $track_id . "' AND (status_id = 41 OR status_id = 42 OR status_id = 43)")->num_rows();
										if ($cekmyi2 > 0) {
											$dte = $this->db->get_where('tb_sales', array('myir' => $track_id))->row_array();
											array_push($data2, array(
												'sales_id'        => $dte['sales_id'],
												'unit'            => 'DCS',
												'status_id'       => 1,
												'status'          => 'scbe',
												'paket'  	      => $row['K'],
												'keterangan'      => 'BULK UPDDATE TO SCBE',
												'tgl_done_fcc'	  => date('Y-m-d H:i:s'),
												'tgl_update'	  => date('Y-m-d H:i:s'),
											));
											if ($dte['kategori'] == 1) {
												$dtl = $dte['datel'];
												if ($dte['kategori'] == 1) {
													$kategori = 'DEAL, ODP READY';
												} elseif ($dte['kategori'] == 2) {
													$kategori = 'DEAL, ODP NOT READY';
												} elseif ($dte['kategori'] == 3) {
													$kategori = 'UNSC';
												}
												$pecahloc       = explode(',', $dte['lat_long']);
												$lat            = str_replace(" ", "", $pecahloc[0]);
												$lng            = str_replace(" ", "", $pecahloc[1]);
												$salesman = getSalesman($dta['kode']) == 'NULL' ? $dta['kode'] :  getSalesman($dta['kode']);

												$text = "ORDER\n";
												$text .= "JA$dte[sales_id] \n";
												$text .= "NAMA PELANGGAN : $dte[nama_pelanggan]\n";
												$text .= "CP : $dte[cp]\n";
												$text .= "ODP : $dte[odp]\n";
												$text .= "ALAMAT : $dte[alamat]\n";
												$text .= "JARAK TIANG : $dte[jarak_tiang]\n";
												$text .= "KATEGORI : <b>DCS</b> $kategori\n";
												$text .= "MYIR : $dte[myir]\n";
												$text .= "PAKET : $row[K]\n";
												$text .= "SALES : $salesman\n";
												$text .= "LOKASI : \nhttps://www.google.co.id/maps/search/$lat,$lng";

												$chatid = send_amunisi_grup($dtl, 'DCS');

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
								// else {
								// 	$statuserror = true;
								// 	$pesanerror = "<b>Failed!</b> <br> Baris $numrow pastikan Track ID tidak kosong!";
								// }
							}
							$numrow++;
						}

						if ($statuserror) {
							$this->session->set_flashdata('error', $pesanerror);
						} else {
							if (!empty($data2)) {
								$this->db->update_batch('tb_sales', $data2, 'sales_id');
							}

							$this->session->set_flashdata('info', '<b>Well Done</b> <br> Data sucessfully uploaded!');
						}

						redirect('sales/upload/myi');
					}
				} elseif ($source == 'kpro') {
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
					if ($b != $sheet[1]['B'] || $e != $sheet[1]['E'] || $g != $sheet[1]['G'] || $k != $sheet[1]['K'] || $n != $sheet[1]['N'] || $s != $sheet[1]['S'] || $u != $sheet[1]['U'] || $v != $sheet[1]['V'] || $z != $sheet[1]['Z'] || $aa != $sheet[1]['AA'] || $ab != $sheet[1]['AB'] || $ae != $sheet[1]['AE']) {
						$this->session->set_flashdata('error', '<b>Failed!</b> <br> Format file KPRO tidak sesuai! ');
					} else {
						$numrow = 1;
						foreach ($sheet as $row) {
							if ($numrow > 1) {
								if ($row['B'] != "" && (empty($row['S']) || $row['S'] = '') && stripos($row['N'], 'WFM - UN-SCS') == false) {
									// $order_date     = date('d/m/Y', strtotime($row['Q']));
									// $mod_od         = str_replace('/', '-', $order_date);
									// $year_od        = date('Y', strtotime($mod_od));
									// $month_od       = date('m', strtotime($mod_od));

									$space_date = (explode(" ", $row['Q']));
									$slash_date = (explode("/", $space_date[0]));
									$year_od	= $slash_date[2];
									if (($year_od == '2021' && $month_od == 12) || $year_od >= 2022) {
										$pcodp          = strpos($row['V'], '-') !== false ? explode("-", $row['V']) : 'ODP-UNF';
										$sc             = $row['B'];
										$datel          = set_datel($pcodp[1]);
										$cutodp         = explode(" ", $row['V']);
										$lat_lng        = '-6.8959407,109.6394839';
										if (strpos($row['AE'], 'MYDB-') !== false) {
											$pccontact      = explode("|", $row['AE']);
											$getmydb        = !empty($pccontact) ? $pccontact[2] : NULL;
											$mydb           = !empty($getmydb) ? str_replace("MYDB-", "", $getmydb) : null;
											if (!empty($mydb)) {

												$cekdoublemyi  = $this->db->query("SELECT myir FROM tb_sales WHERE myir='" . $mydb . "' AND segment != 0")->num_rows();
												if ($cekdoublemyi <= 0) {
													$cekmyi        = $this->db->query("SELECT myir FROM tb_sales WHERE myir='" . $mydb . "' AND tgl_post >= now()-interval 3 MONTH")->num_rows();
													if ($cekmyi <= 0) {
														$data_ins = array(
															'datel'           => $datel,
															'unit'            => $row['G'],
															'nama_pelanggan'  => $row['Z'],
															'alamat'          => $row['AB'],
															'cp'              => $row['AA'],
															'odp'             => $cutodp[0],
															'lat_long'        => $lat_lng,
															'kode'            => $row['G'] . ' ' . $row['K'],
															'paket'           => $row['U'],
															'kategori'        => 1,
															'message_id'      => NULL,
															'myir'            => $mydb,
															'message_from'    => $row['G'] == 'DCS' ? 73913770 : 115716760,
															'tgl_post'        => date('Y-m-d H:i:s'),
															'tgl_update'      => date('Y-m-d H:i:s'),
															'tgl_done_fcc'    => date('Y-m-d H:i:s'),
															'status_id'       => 1,
															'status'          => 'scbe',
															'keterangan'      => 'BULK INSERT SCBE (KPRO) - SYSTEM'
														);
														$dtinstid = $this->upload_model->deal_insert($data_ins);
														$dta      = $this->db->get_where('tb_sales', array('sales_id' => $dtinstid))->row_array();
														$data_log = array(
															'sales_id'          => $dtinstid,
															'action_by'         => 'System-Upload Bulk Source KPRO - SYSTEM',
															'action_on'         => date('Y-m-d H:i:s'),
															'action_status'     => 1
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
															$text .= "KATEGORI : <b>$dta[unit]</b> DEAL, ODP READY\n";
															$text .= "SC : $dta[new_sc]\n";
															$text .= "PAKET : $dta[paket]\n";
															$text .= "SALES : $salesman\n";
															$text .= "LOKASI : \nhttps://www.google.co.id/maps/search/$lat,$lng";

															$chatid = send_amunisi_grup($dtl, $dta['unit']);

															sendChatHtml($chatid, $text);
														}
													} else {
														$cekmyi2 = $this->db->query("SELECT myir FROM tb_sales WHERE myir='" . $mydb . "' AND (status_id = 41 OR status_id = 42 OR status_id = 43)")->num_rows();
														if ($cekmyi2 > 0) {
															$dte = $this->db->get_where('tb_sales', array('myir' => $mydb))->row_array();
															array_push($data4, array(
																'sales_id'        => $dte['sales_id'],
																'unit'            => $row['G'],
																'myir'            => $mydb,
																'status_id'       => 1,
																'status'          => 'scbe',
																'keterangan'      => 'BULK UPDDATE TO SCBE (KPRO) - SYSTEM',
																'tgl_done_fcc'    => date('Y-m-d H:i:s'),
																'tgl_update'      => date('Y-m-d H:i:s')
															));
															if ($dte['kategori'] == 1) {
																$dtl = $dte['datel'];
																if ($dte['kategori'] == 1) {
																	$kategori = 'DEAL, ODP READY';
																} elseif ($dte['kategori'] == 2) {
																	$kategori = 'DEAL, ODP NOT READY';
																} elseif ($dte['kategori'] == 3) {
																	$kategori = 'UNSC';
																}
																$pecahloc       = explode(',', $dte['lat_long']);
																$lat            = str_replace(" ", "", $pecahloc[0]);
																$lng            = str_replace(" ", "", $pecahloc[1]);
																$salesman       = getSalesman($dta['kode']) == 'NULL' ? $dta['kode'] :  getSalesman($dta['kode']);

																$text = "ORDER\n";
																$text .= "JA$dte[sales_id] \n";
																$text .= "NAMA PELANGGAN : $dte[nama_pelanggan]\n";
																$text .= "CP : $dte[cp]\n";
																$text .= "ODP : $dte[odp]\n";
																$text .= "ALAMAT : $dte[alamat]\n";
																$text .= "JARAK TIANG : $dte[jarak_tiang]\n";
																$text .= "KATEGORI : <b>$dta[unit]</b> $kategori\n";
																$text .= "SC : $dte[new_sc]\n";
																$text .= "PAKET : $dte[paket]\n";
																$text .= "SALES : $salesman\n";
																$text .= "LOKASI : \nhttps://www.google.co.id/maps/search/$lat,$lng";

																$chatid = send_amunisi_grup($dtl, $dta['unit']);

																sendChatHtml($chatid, $text);
															}
															/*send message to sales*/
															$telegram_id = $dte['message_from'];
															$meid        = $dte['message_id'];
															$sales_id    = $dte['sales_id'];
															$updateby    = 'SYSTEM';
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
										} else {

											$cekdoublesc    = $this->db->query("SELECT new_sc FROM tb_sales WHERE (new_sc='" . $sc . "' OR myir='" . $sc . "')  AND segment != 0")->num_rows();
											if ($cekdoublesc <= 0) {
												$pccontact      = explode("/", $row['AE']);
												$ceksc          = $this->db->query("SELECT new_sc FROM tb_sales WHERE (new_sc='" . $sc . "' OR myir='" . $sc . "') AND tgl_post >= now()-interval 3 MONTH")->num_rows();
												if ($ceksc <= 0) {
													$data_ins = array(
														'datel'           => $datel,
														'unit'            => $row['G'],
														'nama_pelanggan'  => $row['Z'],
														'alamat'          => $row['AB'],
														'cp'              => $row['AA'],
														'odp'             => $cutodp[0],
														'lat_long'        => $lat_lng,
														'kode'            => $row['G'] . ' ' . $row['K'],
														'paket'           => $row['U'],
														'kategori'        => 1,
														'message_id'      => NULL,
														'myir'            => $row['B'],
														'message_from'    => $row['G'] == 'DCS' ? 73913770 : 115716760,
														'tgl_post'        => date('Y-m-d H:i:s'),
														'tgl_update'      => date('Y-m-d H:i:s'),
														'tgl_done_fcc'    => date('Y-m-d H:i:s'),
														'status_id'       => 1,
														'status'          => 'scbe',
														'keterangan'      => 'BULK INSERT SCBE (KPRO) - SYSTEM'
													);
													$dtinstid = $this->upload_model->deal_insert($data_ins);
													$dta = $this->db->get_where('tb_sales', array('sales_id' => $dtinstid))->row_array();
													$data_log = array(
														'sales_id'          => $dtinstid,
														'action_by'         => 'System-Upload Bulk Source KPRO - SYSTEM',
														'action_on'         => date('Y-m-d H:i:s'),
														'action_status'     => 1
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
														$text .= "KATEGORI : <b>$dta[unit]</b> DEAL, ODP READY\n";
														$text .= "SC : $dta[new_sc]\n";
														$text .= "PAKET : $dta[paket]\n";
														$text .= "SALES : $salesman\n";
														$text .= "LOKASI : \nhttps://www.google.co.id/maps/search/$lat,$lng";

														$chatid = send_amunisi_grup($dtl, $dta['unit']);

														sendChatHtml($chatid, $text);
													}
												} else {
													$ceksc2 = $this->db->query("SELECT myir FROM tb_sales WHERE myir='" . $sc . "' AND (status_id = 41 OR status_id = 42 OR status_id = 43)")->num_rows();
													$dta    = $this->db->query("SELECT * FROM tb_sales WHERE (new_sc='" . $sc . "' OR myir='" . $sc . "')")->row_array();
													if ($ceksc2 > 0) {
														$dte = $this->db->get_where('tb_sales', array('myir' => $sc))->row_array();
														array_push($data3, array(
															'sales_id'        => $dte['sales_id'],
															'unit'            => $row['G'],
															'status_id'       => 1,
															'status'          => 'scbe',
															'keterangan'      => 'BULK UPDDATE TO SCBE (KPRO) - SYSTEM',
															'tgl_done_fcc'    => date('Y-m-d H:i:s'),
															'tgl_update'      => date('Y-m-d H:i:s')
														));
														if ($dte['kategori'] == 1) {
															$dtl = $dte['datel'];
															if ($dte['kategori'] == 1) {
																$kategori = 'DEAL, ODP READY';
															} elseif ($dte['kategori'] == 2) {
																$kategori = 'DEAL, ODP NOT READY';
															} elseif ($dte['kategori'] == 3) {
																$kategori = 'UNSC';
															}
															$pecahloc       = explode(',', $dte['lat_long']);
															$lat            = str_replace(" ", "", $pecahloc[0]);
															$lng            = str_replace(" ", "", $pecahloc[1]);
															$salesman       = getSalesman($dta['kode']) == 'NULL' ? $dta['kode'] :  getSalesman($dta['kode']);

															$text = "ORDER\n";
															$text .= "JA$dte[sales_id] \n";
															$text .= "NAMA PELANGGAN : $dte[nama_pelanggan]\n";
															$text .= "CP : $dte[cp]\n";
															$text .= "ODP : $dte[odp]\n";
															$text .= "ALAMAT : $dte[alamat]\n";
															$text .= "JARAK TIANG : $dte[jarak_tiang]\n";
															$text .= "KATEGORI : <b>$dta[unit]</b> $kategori\n";
															$text .= "SC : $dte[new_sc]\n";
															$text .= "PAKET : $dte[paket]\n";
															$text .= "SALES : $salesman\n";
															$text .= "LOKASI : \nhttps://www.google.co.id/maps/search/$lat,$lng";

															$chatid = send_amunisi_grup($dtl, $dta['unit']);

															sendChatHtml($chatid, $text);
														}
														/*send message to sales*/
														$telegram_id = $dte['message_from'];
														$meid        = $dte['message_id'];
														$sales_id    = $dte['sales_id'];
														$updateby    = 'SYSTEM';
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
									}
									// else {
									// 	$statuserror = true;
									// 	$pesanerror = "<b>Failed!</b> <br> Baris $numrow pastikan order tersebut bukan sebelum Tahun 2022!";
									// }
								}
								// else {
								// 	$statuserror = true;
								// 	$pesanerror = "<b>Failed!</b> <br> Baris $numrow pastikan Order ID tidak kosong, Device ID kosong dan Status Resume bukan WFM - UN-SCS";
								// }
							}
							$numrow++;
						}

						if ($statuserror) {
							$this->session->set_flashdata('error', $pesanerror);
						} else {
							if (!empty($data3)) {
								$this->db->update_batch('tb_sales', $data3, 'sales_id');
							}

							if (!empty($data4)) {
								$this->db->update_batch('tb_sales', $data4, 'sales_id');
							}

							$this->session->set_flashdata('info', '<b>Well Done</b> <br> Data sucessfully uploaded!');
						}

						redirect('sales/upload/myi');
					}
				} elseif ($source == 'pda') {
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
					if ($b != $sheet[1]['B'] || $e != $sheet[1]['E'] || $g != $sheet[1]['G'] || $k != $sheet[1]['K'] || $n != $sheet[1]['N'] || $s != $sheet[1]['S'] || $u != $sheet[1]['U'] || $v != $sheet[1]['V'] || $z != $sheet[1]['Z'] || $aa != $sheet[1]['AA'] || $ab != $sheet[1]['AB'] || $ae != $sheet[1]['AE']) {
						$this->session->set_flashdata('error', '<b>Failed!</b> <br> Format file KPRO tidak sesuai! ');
					} else {
						$numrow = 1;
						foreach ($sheet as $row) {
							if ($numrow > 1) {
								$pcodp         	= explode("-", $row['V']);
								$pccontact     	= explode("/", $row['AE']);
								$sc      		= $row['B'];
								$datel          = set_datel($pcodp[1]);
								$cutodp         = explode(" ", $row['V']);
								$lat_lng        = '-6.8959407,109.6394839';

								$cekdoublesc    = $this->db->query("SELECT new_sc FROM tb_sales WHERE (new_sc='" . $sc . "' OR myir='" . $sc . "')  AND segment != 2")->num_rows();
								if ($cekdoublesc <= 0) {
									$ceksc          = $this->db->query("SELECT new_sc FROM tb_sales WHERE (new_sc='" . $sc . "' OR myir='" . $sc . "') AND tgl_post >= now()-interval 3 MONTH")->num_rows();
									if ($ceksc <= 0) {
										if ($row['N'] == 'OSS - PROVISIONING START' || $row['N'] == '7 | OSS - PROVISIONING ISSUED' || $row['N'] == 'Fallout (UIM)' || $row['N'] == 'Fallout (WFM)' || $row['N'] == 'Fallout (Activation)' || $row['N'] == 'OSS - FALLOUT' || $row['N'] == '7 | OSS - FALLOUT') {
											$data_ins = array(
												'datel'     	  => $datel,
												'unit'			  => $row['G'],
												'nama_pelanggan'  => $row['Z'],
												'alamat'      	  => $row['AE'],
												'cp'              => $row['AA'],
												'odp'             => $cutodp[0],
												'lat_long'	      => $lat_lng,
												'kode'            => $row['G'] . ' ' . $row['K'],
												'paket'  	      => $row['U'],
												'kategori'	      => 1,
												'segment'		  => 2,
												'message_id'	  => NULL,
												'sc'			  => $row['B'],
												'new_sc'		  => $row['B'],
												'message_from'	  => 73913770,
												'tgl_post'	      => date('Y-m-d H:i:s'),
												'tgl_update'	  => date('Y-m-d H:i:s'),
												'tgl_done_fcc'	  => date('Y-m-d H:i:s'),
												'status_id'       => 1,
												'status'          => 'scbe',
												'keterangan'      => 'BULK INSERT PDA (KPRO)'
											);
											$dtinstid = $this->upload_model->deal_insert($data_ins);
											$dta = $this->db->get_where('tb_sales', array('sales_id' => $dtinstid))->row_array();
											$data_log = array(
												'sales_id'    		=> $dtinstid,
												'action_by'			=> $this->session->userdata('nama') . '-Upload PDA Bulk Manual Source KPRO',
												'action_on'	        => date('Y-m-d H:i:s'),
												'action_status'	    => 1
											);
											$this->db->insert('tb_log', $data_log);
											if ($dta['kategori'] == 1) {
												$dtl      = $dta['datel'];
												$pecahloc = explode(',', $dta['lat_long']);
												$lat      = str_replace(" ", "", $pecahloc[0]);
												$lng      = str_replace(" ", "", $pecahloc[1]);
												$salesman = getSalesman($dta['kode']) == 'NULL' ? $dta['kode'] :  getSalesman($dta['kode']);

												$text = "ORDER\n";
												$text .= "JA$dta[sales_id] \n";
												$text .= "NAMA PELANGGAN : $dta[nama_pelanggan]\n";
												$text .= "CP : $dta[cp]\n";
												$text .= "ODP : $dta[odp]\n";
												$text .= "ALAMAT : $dta[alamat]\n";
												$text .= "JARAK TIANG : $dta[jarak_tiang]\n";
												$text .= "KATEGORI : <b>[PDA]</b> <b>$dta[unit]</b> DEAL, ODP READY\n";
												$text .= "SC : $dta[new_sc]\n";
												$text .= "PAKET : $dta[paket]\n";
												$text .= "SALES : $salesman\n";
												$text .= "LOKASI : \nhttps://www.google.co.id/maps/search/$lat,$lng";

												$chatid = send_amunisi_grup($dtl, $dta['unit']);

												sendChatHtml($chatid, $text);
											}
										}
										// else {
										// 	$statuserror = true;
										// 	$pesanerror = "<b>Failed!</b> <br> Baris $numrow pastikan Status Resume sudah benar!";
										// }
									} else {
										$ceksc2 = $this->db->query("SELECT myir FROM tb_sales WHERE myir='" . $sc . "' AND (status_id = 41 OR status_id = 42 OR status_id = 43)")->num_rows();
										if ($ceksc2 > 0) {
											if ($row['N'] == 'OSS - PROVISIONING START' || $row['N'] == '7 | OSS - PROVISIONING ISSUED' || $row['N'] == 'Fallout (UIM)' || $row['N'] == 'Fallout (WFM)' || $row['N'] == 'Fallout (Activation)' || $row['N'] == 'OSS - FALLOUT') {
												$dte = $this->db->get_where('tb_sales', array('myir' => $sc))->row_array();
												array_push($data2, array(
													'sales_id'        => $dte['sales_id'],
													'unit'			  => $row['G'],
													'odp'             => $cutodp[0],
													'kode'            => $row['G'] . ' ' . $row['K'],
													'paket'  	      => $row['U'],
													'kategori'	      => 1,
													'segment'		  => 2,
													'sc'			  => $row['B'],
													'new_sc'		  => $row['B'],
													'tgl_update'	  => date('Y-m-d H:i:s'),
													'tgl_done_fcc'	  => date('Y-m-d H:i:s'),
													'status_id'       => 1,
													'status'          => 'scbe',
													'keterangan'      => 'BULK UPDATE PDA (KPRO)'
												));

												$dta = $this->db->get_where('tb_sales', array('sales_id' => $dte['sales_id']))->row_array();
												$data_log = array(
													'sales_id'    		=> $dte['sales_id'],
													'action_by'			=> $this->session->userdata('nama') . '-Upload PDA Bulk Manual Source KPRO',
													'action_on'	        => date('Y-m-d H:i:s'),
													'action_status'	    => 1
												);
												$this->db->insert('tb_log', $data_log);

												if ($dta['kategori'] == 1) {
													$dtl      = $dta['datel'];
													$pecahloc = explode(',', $dta['lat_long']);
													$lat      = str_replace(" ", "", $pecahloc[0]);
													$lng      = str_replace(" ", "", $pecahloc[1]);
													$salesman = getSalesman($dta['kode']) == 'NULL' ? $dta['kode'] :  getSalesman($dta['kode']);

													$text = "ORDER\n";
													$text .= "JA$dta[sales_id] \n";
													$text .= "NAMA PELANGGAN : $dta[nama_pelanggan]\n";
													$text .= "CP : $dta[cp]\n";
													$text .= "ODP : $dta[odp]\n";
													$text .= "ALAMAT : $dta[alamat]\n";
													$text .= "JARAK TIANG : $dta[jarak_tiang]\n";
													$text .= "KATEGORI : <b>[PDA]</b> <b>$dta[unit]</b> DEAL, ODP READY\n";
													$text .= "SC : $dta[new_sc]\n";
													$text .= "PAKET : $dta[paket]\n";
													$text .= "SALES : $salesman\n";
													$text .= "LOKASI : \nhttps://www.google.co.id/maps/search/$lat,$lng";

													$chatid = send_amunisi_grup($dtl, $dta['unit']);

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
											}
											// else {
											// 	$statuserror = true;
											// 	$pesanerror = "<b>Failed!</b> <br> Baris $numrow pastikan Status Resume sudah benar!";
											// }
										}
									}
								}
							}
							$numrow++;
						}

						if ($statuserror) {
							$this->session->set_flashdata('error', $pesanerror);
						} else {
							if (!empty($data2)) {
								$this->db->update_batch('tb_sales', $data2, 'sales_id');
							}

							$this->session->set_flashdata('info', '<b>Well Done</b> <br> Data sucessfully uploaded!');
						}

						redirect('sales/upload/myi');
					}
				} elseif ($source == 'addon') {
					$b = 'ORDER_ID';
					$c = 'JENIS';
					$f = 'DATEL';
					$h = 'UNIT';
					$l = 'TYPE_CHANNEL';
					$o = 'STATUS_RESUME';
					$t = 'DEVICE_ID';
					$v = 'PACKAGE_NAME';
					$w = 'LOC_ID';
					$aa = 'CUSTOMER_NAME';
					$ab = 'CONTACT_HP';
					$ac = 'INS_ADDRESS';
					$af = 'KCONTACT';
					if ($b != $sheet[1]['B'] || $c != $sheet[1]['C'] || $f != $sheet[1]['F'] || $h != $sheet[1]['H'] || $l != $sheet[1]['L'] || $o != $sheet[1]['O'] || $t != $sheet[1]['T'] || $v != $sheet[1]['V'] || $w != $sheet[1]['W'] || $aa != $sheet[1]['AA'] || $ab != $sheet[1]['AB'] || $ac != $sheet[1]['AC'] || $af != $sheet[1]['AF']) {
						$this->session->set_flashdata('error', '<b>Failed!</b> <br> Format file ADDON tidak sesuai! ');
					} else {
						$numrow = 1;
						foreach ($sheet as $row) {
							if ($numrow > 1) {
								if ($row['B'] != "" || $row['B'] != null) {
									$pcodp         	= explode("-", $row['W']);
									$pccontact     	= explode(";", $row['AF']);
									$sc      		= $row['B'];
									$datel          = set_datel($pcodp[1]);
									$cutodp         = explode(" ", $row['W']);
									$lat_lng        = '-6.8959407,109.6394839';

									$cekdoublesc    = $this->db->query("SELECT new_sc FROM tb_sales WHERE (new_sc='" . $sc . "' OR myir='" . $sc . "')  AND segment != 3")->num_rows();
									if ($cekdoublesc <= 0) {
										$ceksc          = $this->db->query("SELECT new_sc FROM tb_sales WHERE (new_sc='" . $sc . "' OR myir='" . $sc . "') AND tgl_post >= now()-interval 3 MONTH")->num_rows();
										if ($ceksc <= 0) {
											$data_ins = array(
												'datel'     	  => $datel,
												'unit'			  => check_unit_dcs_or_dbs($row['H']),
												'add_on_type'	  => add_on_type($row['C']),
												'nama_pelanggan'  => $row['AA'],
												'alamat'      	  => $row['AC'],
												'cp'              => $row['AF'],
												'odp'             => $cutodp[0],
												'lat_long'	      => $lat_lng,
												'kode'            => $row['H'] . ' ' . $row['L'],
												'paket'  	      => $row['V'],
												'kategori'	      => 1,
												'segment'		  => 3,
												'message_id'	  => NULL,
												'sc'			  => $row['B'],
												'new_sc'		  => $row['B'],
												'message_from'	  => 73913770,
												'tgl_post'	      => date('Y-m-d H:i:s'),
												'tgl_update'	  => date('Y-m-d H:i:s'),
												'tgl_done_fcc'	  => date('Y-m-d H:i:s'),
												'status_id'       => 1,
												'status'          => 'scbe',
												'keterangan'      => 'BULK INSERT ADDON (KPRO)'
											);
											$dtinstid = $this->upload_model->deal_insert($data_ins);
											$dta = $this->db->get_where('tb_sales', array('sales_id' => $dtinstid))->row_array();
											$data_log = array(
												'sales_id'    		=> $dtinstid,
												'action_by'			=> $this->session->userdata('nama') . '-Upload ADDON Bulk Manual Source KPRO',
												'action_on'	        => date('Y-m-d H:i:s'),
												'action_status'	    => 1
											);
											$this->db->insert('tb_log', $data_log);
											if ($dta['kategori'] == 1) {
												$dtl      = $dta['datel'];
												$pecahloc = explode(',', $dta['lat_long']);
												$lat      = str_replace(" ", "", $pecahloc[0]);
												$lng      = str_replace(" ", "", $pecahloc[1]);
												$salesman = getSalesman($dta['kode']) == 'NULL' ? $dta['kode'] :  getSalesman($dta['kode']);

												$text = "ORDER\n";
												$text .= "JA$dta[sales_id] \n";
												$text .= "NAMA PELANGGAN : $dta[nama_pelanggan]\n";
												$text .= "CP : $dta[cp]\n";
												$text .= "ODP : $dta[odp]\n";
												$text .= "ALAMAT : $dta[alamat]\n";
												$text .= "JARAK TIANG : $dta[jarak_tiang]\n";
												$text .= "KATEGORI : <b>$dta[add_on_type]</b> <b>$dta[unit]</b> DEAL, ODP READY\n";
												$text .= "SC : $dta[new_sc]\n";
												$text .= "PAKET : $dta[paket]\n";
												$text .= "SALES : $salesman\n";
												$text .= "LOKASI : \nhttps://www.google.co.id/maps/search/$lat,$lng";

												$chatid = send_amunisi_grup($dtl, $dta['unit']);

												sendChatHtml($chatid, $text);
											}
										}
									}
								}
							}
							$numrow++;
						}
						$this->session->set_flashdata('info', '<b>Well Done</b> <br> Data sucessfully uploaded!');
						redirect('sales/upload/myi');
					}
				} elseif ($source == "scbe_hsi") {
					$a = '#SCID';
					$b = '#Date';
					$c = '#Order';
					$d = 'NCLI';
					$e = 'Nama Customer';
					$f = 'Alamat Instalasi';
					$g = 'INTERNET';
					$h = 'VOICE';
					$i = 'STATUS';
					$j = 'NAMA ALPRO';
					$k = 'WITEL';
					$l = 'K-KONTAK';
					$m = 'USER ID';
					$n = 'STO';
					if ($a != $sheet[1]['A'] ||	$b != $sheet[1]['B'] ||	$c != $sheet[1]['C'] ||	$d != $sheet[1]['D'] ||	$e != $sheet[1]['E'] ||	$f != $sheet[1]['F'] ||	$g != $sheet[1]['G'] ||	$h != $sheet[1]['H'] ||	$i != $sheet[1]['I'] ||	$j != $sheet[1]['J'] ||	$k != $sheet[1]['K'] ||	$l != $sheet[1]['L'] ||	$m != $sheet[1]['M'] ||	$n != $sheet[1]['N']) {
						$this->session->set_flashdata('error', '<b>Failed!</b> <br> Format file SCBE HSI tidak sesuai! ');
					} else {
						$numrow = 1;
						foreach ($sheet as $row) {
							if ($numrow > 1) {
								if ($row['A'] != "" || $row['A'] != null) {
									$datel         = set_datel($row['N']);
									$odp           = !empty($row['J']) ? explode(" ", $row['J']) : null;
									$new_sc	       = $row['A'];
									$cp            = substr($row['L'], strpos($row['L'], "MB/") + 3);
									$kcontact	   = explode("/", $row['L']);
									$lat_lng       = '-6.8959407,109.6394839';
									$ceksc        = $this->db->query("SELECT myir FROM tb_sales WHERE (myir='" . $new_sc . "' OR new_sc='" . $new_sc . "') AND tgl_post >= now()-interval 3 MONTH")->num_rows();
									if ($ceksc <= 0) { //cek myir di database
										$data_ins = array(
											'datel'     	  => $datel,
											'unit'            => 'BGES',
											'nama_pelanggan'  => $row['E'],
											'alamat'      	  => $row['F'],
											'cp'              => $cp,
											'odp'             => !empty($odp) ? $odp[0] : null,
											'lat_long'	      => $lat_lng,
											'kode'            => $kcontact[1],
											'paket'  	      => $kcontact[6] . ' ' . $kcontact[7],
											'kategori'	      => 1,
											'myir'	      	  => $new_sc,
											'message_id'	  => NULL,
											'message_from'	  => 115716760,
											'tgl_post'	      => date('Y-m-d H:i:s'),
											'tgl_update'	  => date('Y-m-d H:i:s'),
											'tgl_done_fcc'	  => date('Y-m-d H:i:s'),
											'status_id'       => 1,
											'status'          => 'scbe',
											'keterangan'      => 'BULK INSERT SCBE HSI'
										);
										$dtinstid = $this->upload_model->deal_insert($data_ins);
										$dta = $this->db->get_where('tb_sales', array('sales_id' => $dtinstid))->row_array();
										$data_log = array(
											'sales_id'    		=> $dtinstid,
											'action_by'			=> $this->session->userdata('nama') . '-Upload Bulk SCBE HSI',
											'action_on'	        => date('Y-m-d H:i:s'),
											'action_status'	    => 1
										);
										$this->db->insert('tb_log', $data_log);
										if ($dta['kategori'] == 1) {
											$dtl      = $dta['datel'];
											$pecahloc = explode(',', $dta['lat_long']);
											$lat      = str_replace(" ", "", $pecahloc[0]);
											$lng      = str_replace(" ", "", $pecahloc[1]);
											$salesman = getSalesman($dta['kode']) == 'NULL' ? 'ANTOK' :  getSalesman($dta['kode']);

											$text = "ORDER\n";
											$text .= "JA$dta[sales_id] \n";
											$text .= "NAMA PELANGGAN : $dta[nama_pelanggan]\n";
											$text .= "CP : $dta[cp]\n";
											$text .= "ODP : $dta[odp]\n";
											$text .= "ALAMAT : $dta[alamat]\n";
											$text .= "JARAK TIANG : $dta[jarak_tiang]\n";
											$text .= "KATEGORI : <b>[BGES]</b> DEAL, ODP READY\n";
											$text .= "SC : $dta[myir]\n";
											$text .= "PAKET : $dta[paket]\n";
											$text .= "SALES : $salesman\n";
											$text .= "LOKASI : \nhttps://www.google.co.id/maps/search/$lat,$lng";

											$chatid = send_amunisi_grup($dtl, 'BGES');

											sendChatHtml($chatid, $text);
										}
									} else {
										$ceksc2 = $this->db->query("SELECT myir FROM tb_sales WHERE (myir='" . $new_sc . "' OR new_sc='" . $new_sc . "') AND (status_id = 41 OR status_id = 42 OR status_id = 43)")->num_rows();
										if ($ceksc2 > 0) {
											$dte = $this->db->query("SELECT * FROM tb_sales WHERE myir='" . $new_sc . "' OR new_sc='" . $new_sc . "'")->row_array();
											array_push($datahsi, array(
												'sales_id'        => $dte['sales_id'],
												'unit'            => 'BGES',
												'status_id'       => 1,
												'status'          => 'scbe',
												'paket'  	      => $kcontact[6] . ' ' . $kcontact[7],
												'keterangan'      => 'BULK UPDDATE HSI TO SCBE',
												'tgl_done_fcc'	  => date('Y-m-d H:i:s'),
												'tgl_update'	  => date('Y-m-d H:i:s'),
											));
											if ($dte['kategori'] == 1) {
												$dtl = $dte['datel'];
												if ($dte['kategori'] == 1) {
													$kategori = 'DEAL, ODP READY';
												} elseif ($dte['kategori'] == 2) {
													$kategori = 'DEAL, ODP NOT READY';
												} elseif ($dte['kategori'] == 3) {
													$kategori = 'UNSC';
												}
												$pecahloc       = explode(',', $dte['lat_long']);
												$lat            = str_replace(" ", "", $pecahloc[0]);
												$lng            = str_replace(" ", "", $pecahloc[1]);
												$salesman = getSalesman($dta['kode']) == 'NULL' ? 'ANTOK' :  getSalesman($dta['kode']);

												$text = "ORDER\n";
												$text .= "JA$dte[sales_id] \n";
												$text .= "NAMA PELANGGAN : $dte[nama_pelanggan]\n";
												$text .= "CP : $dte[cp]\n";
												$text .= "ODP : $dte[odp]\n";
												$text .= "ALAMAT : $dte[alamat]\n";
												$text .= "JARAK TIANG : $dte[jarak_tiang]\n";
												$text .= "KATEGORI : <b>BGES</b> $kategori\n";
												$text .= "SC : $dte[myir]\n";
												$text .= "PAKET : $dte[paket]\n";
												$text .= "SALES : $salesman\n";
												$text .= "LOKASI : \nhttps://www.google.co.id/maps/search/$lat,$lng";

												$chatid = send_amunisi_grup($dtl, 'BGES');

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

						if (!empty($datahsi)) {
							$this->db->update_batch('tb_sales', $datahsi, 'sales_id');
						}
						$this->session->set_flashdata('info', '<b>Well Done</b> <br> Data sucessfully uploaded!');
						redirect('sales/upload/myi');
					}
				} elseif ($source == "scbe_bges") {
					$a = '#SCID';
					$b = '#Date';
					$c = '#Order';
					$d = 'NCLI';
					$e = 'Nama Customer';
					$f = 'Alamat Instalasi';
					$g = 'INTERNET';
					$h = 'VOICE';
					$i = 'STATUS';
					$j = 'NAMA ALPRO';
					$k = 'WITEL';
					$l = 'K-KONTAK';
					$m = 'USER ID';
					$n = 'STO';
					if ($a != $sheet[1]['A'] ||	$b != $sheet[1]['B'] ||	$c != $sheet[1]['C'] ||	$d != $sheet[1]['D'] ||	$e != $sheet[1]['E'] ||	$f != $sheet[1]['F'] ||	$g != $sheet[1]['G'] ||	$h != $sheet[1]['H'] ||	$i != $sheet[1]['I'] ||	$j != $sheet[1]['J'] ||	$k != $sheet[1]['K'] ||	$l != $sheet[1]['L'] ||	$m != $sheet[1]['M'] ||	$n != $sheet[1]['N']) {
						$this->session->set_flashdata('error', '<b>Failed!</b> <br> Format file SCBE HSI tidak sesuai! ');
					} else {
						$numrow = 1;
						foreach ($sheet as $row) {
							if ($numrow > 1) {
								if ($row['C'] != "" || $row['C'] != null) {
									$datel         = set_datel($row['N']);
									$odp           = !empty($row['J']) ? explode(" ", $row['J']) : null;
									$mydb	       = str_replace("MYDB-", "", $row['C']);
									$cp            = substr($row['L'], strpos($row['L'], "MB/") + 3);
									$kcontact	   = explode("/", $row['L']);
									$lat_lng       = '-6.8959407,109.6394839';
									$cekmyi        = $this->db->query("SELECT myir FROM tb_sales WHERE myir='" . $mydb . "' AND tgl_post >= now()-interval 3 MONTH")->num_rows();
									if ($cekmyi <= 0) { //cek myir di database
										$data_ins = array(
											'datel'     	  => $datel,
											'unit'            => 'DBS',
											'nama_pelanggan'  => $row['E'],
											'alamat'      	  => $row['F'],
											'cp'              => $cp,
											'odp'             => !empty($odp) ? $odp[0] : null,
											'lat_long'	      => $lat_lng,
											'kode'            => $kcontact[1],
											'paket'  	      => $kcontact[6] . ' ' . $kcontact[7],
											'kategori'	      => 1,
											'myir'            => $mydb,
											'message_id'	  => NULL,
											'message_from'	  => 115716760,
											'tgl_post'	      => date('Y-m-d H:i:s'),
											'tgl_update'	  => date('Y-m-d H:i:s'),
											'tgl_done_fcc'	  => date('Y-m-d H:i:s'),
											'status_id'       => 1,
											'status'          => 'scbe',
											'keterangan'      => 'BULK INSERT SCBE BGES'
										);
										$dtinstid = $this->upload_model->deal_insert($data_ins);
										$dta = $this->db->get_where('tb_sales', array('sales_id' => $dtinstid))->row_array();
										$data_log = array(
											'sales_id'    		=> $dtinstid,
											'action_by'			=> $this->session->userdata('nama') . '-Upload Bulk SCBE BGES',
											'action_on'	        => date('Y-m-d H:i:s'),
											'action_status'	    => 1
										);
										$this->db->insert('tb_log', $data_log);
										if ($dta['kategori'] == 1) {
											$dtl      = $dta['datel'];
											$pecahloc = explode(',', $dta['lat_long']);
											$lat      = str_replace(" ", "", $pecahloc[0]);
											$lng      = str_replace(" ", "", $pecahloc[1]);
											$salesman = getSalesman($dta['kode']) == 'NULL' ? 'ANTOK' :  getSalesman($dta['kode']);

											$text = "ORDER\n";
											$text .= "JA$dta[sales_id] \n";
											$text .= "NAMA PELANGGAN : $dta[nama_pelanggan]\n";
											$text .= "CP : $dta[cp]\n";
											$text .= "ODP : $dta[odp]\n";
											$text .= "ALAMAT : $dta[alamat]\n";
											$text .= "JARAK TIANG : $dta[jarak_tiang]\n";
											$text .= "KATEGORI : <b>[DBS]</b> DEAL, ODP READY\n";
											$text .= "MYDB : $dta[myir]\n";
											$text .= "PAKET : $dta[paket]\n";
											$text .= "SALES : $salesman\n";
											$text .= "LOKASI : \nhttps://www.google.co.id/maps/search/$lat,$lng";

											$chatid = send_amunisi_grup($dtl, 'DBS');

											sendChatHtml($chatid, $text);
										}
									} else {
										$cekmyi2 = $this->db->query("SELECT myir FROM tb_sales WHERE myir='" . $mydb . "' AND (status_id = 41 OR status_id = 42 OR status_id = 43)")->num_rows();
										if ($cekmyi2 > 0) {
											$dte = $this->db->get_where('tb_sales', array('myir' => $mydb))->row_array();
											array_push($databgs, array(
												'sales_id'        => $dte['sales_id'],
												'unit'            => 'DBS',
												'status_id'       => 1,
												'status'          => 'scbe',
												'paket'  	      => $kcontact[6] . ' ' . $kcontact[7],
												'keterangan'      => 'BULK UPDDATE BGES TO SCBE',
												'tgl_done_fcc'	  => date('Y-m-d H:i:s'),
												'tgl_update'	  => date('Y-m-d H:i:s'),
											));
											if ($dte['kategori'] == 1) {
												$dtl = $dte['datel'];
												if ($dte['kategori'] == 1) {
													$kategori = 'DEAL, ODP READY';
												} elseif ($dte['kategori'] == 2) {
													$kategori = 'DEAL, ODP NOT READY';
												} elseif ($dte['kategori'] == 3) {
													$kategori = 'UNSC';
												}
												$pecahloc       = explode(',', $dte['lat_long']);
												$lat            = str_replace(" ", "", $pecahloc[0]);
												$lng            = str_replace(" ", "", $pecahloc[1]);
												$salesman = getSalesman($dta['kode']) == 'NULL' ? 'ANTOK' :  getSalesman($dta['kode']);

												$text = "ORDER\n";
												$text .= "JA$dte[sales_id] \n";
												$text .= "NAMA PELANGGAN : $dte[nama_pelanggan]\n";
												$text .= "CP : $dte[cp]\n";
												$text .= "ODP : $dte[odp]\n";
												$text .= "ALAMAT : $dte[alamat]\n";
												$text .= "JARAK TIANG : $dte[jarak_tiang]\n";
												$text .= "KATEGORI : <b>DBS</b> $kategori\n";
												$text .= "MYDB : $dte[myir]\n";
												$text .= "PAKET : $dte[paket]\n";
												$text .= "SALES : $salesman\n";
												$text .= "LOKASI : \nhttps://www.google.co.id/maps/search/$lat,$lng";

												$chatid = send_amunisi_grup($dtl, 'DBS');

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
								// else {
								// 	$statuserror = true;
								// 	$pesanerror = "<b>Failed!</b> <br> Baris $numrow pastikan Order ID tidak kosong!";
								// }
							}
							$numrow++;
						}

						if ($statuserror) {
							$this->session->set_flashdata('error', $pesanerror);
						} else {
							if (!empty($databgs)) {
								$this->db->update_batch('tb_sales', $databgs, 'sales_id');
							}

							$this->session->set_flashdata('info', '<b>Well Done</b> <br> Data sucessfully uploaded!');
						}

						redirect('sales/upload/myi');
					}
				} elseif ($source == "risma") {
					$b = 'Track ID';
					$g = 'Ket Paket';
					$p = 'ODP';
					if ($b != $sheet[2]['B'] ||	$g != $sheet[2]['G'] || $p != $sheet[2]['P']) {
						$this->session->set_flashdata('error', '<b>Failed!</b> <br> Format file RISMA tidak sesuai! ');
					} else {
						$numrow = 1;
						foreach ($sheet as $row) {
							if ($numrow > 2) {
								if (!empty($row['B'])) {
									$pctrack_id    = explode("-", $row['B']);
									$pcodp         = explode("-", $row['P']);
									$track_id      = $pctrack_id[1];
									$datel         = set_datel(!empty($pcodp[1]) ? $pcodp[1] : 'ERR');
									$lat_lng       = $row['Q'];
									if (!empty($track_id)) {
										$cekmyi        = $this->db->query("SELECT myir FROM tb_sales WHERE myir='" . $track_id . "' AND tgl_post >= now()-interval 3 MONTH")->num_rows();
										if ($cekmyi <= 0) { //cek myir di database
											if ($datel == 'UNF') {
												$almt = strtolower($row['R']);
												$datel = datel_by_alamat($almt);
											}
											$data_ins = array(
												'datel'     	  => $datel,
												'unit'            => 'DCS',
												'nama_pelanggan'  => $row['C'],
												'alamat'      	  => $row['R'],
												'cp'              => $row['D'],
												'odp'             => $row['P'],
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
												'action_by'			=> 'System-Upload Bulk Risma by System',
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

												$chatid = send_amunisi_grup($dtl, 'DCS');

												sendChatHtml($chatid, $text);
											}
										} else {
											$cekmyi2 = $this->db->query("SELECT myir FROM tb_sales WHERE myir='" . $track_id . "' AND (status_id = 41 OR status_id = 42 OR status_id = 43)")->num_rows();
											if ($cekmyi2 > 0) {
												$dte = $this->db->get_where('tb_sales', array('myir' => $track_id))->row_array();
												array_push($datarisma, array(
													'sales_id'        => $dte['sales_id'],
													'unit'            => 'DCS',
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
													} elseif ($dte['kategori'] == 2) {
														$kategori = 'DEAL, ODP NOT READY';
													} elseif ($dte['kategori'] == 3) {
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

													$chatid = send_amunisi_grup($dtl, 'DCS');

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
								} else {
									$statuserror = true;
									$pesanerror = "<b>Failed!</b> <br> Baris $numrow pastikan Track ID tidak kosong!";
								}
							}
							$numrow++;
						}

						if ($statuserror) {
							$this->session->set_flashdata('error', $pesanerror);
						} else {
							if (!empty($datarisma)) {
								$this->db->update_batch('tb_sales', $datarisma, 'sales_id');
							}

							$last_import = date("Y-m-d H:i:s");
							$uimport = array(
								'last_import' => $last_import
							);
							$this->db->update('tb_import', $uimport, array('id' => 1));

							$this->session->set_flashdata('info', '<b>Well Done</b> <br> Data sucessfully uploaded!');
						}

						redirect('sales/upload/myi');
					}
				}
			} else {
				$data['upload_error'] = $upload['error'];
			}
		}
		$data['title'] 		 = 'Deal Sales';
		$data['subtitle'] 	 = 'Upload MYI';
		$this->load->view('template', [
			'content' => $this->load->view('sales/upload/deal_upload_myi', $data, true)
		]);
	}

	public function jadwal()
	{
		if (isset($_POST['upload'])) {
			$jdatel = $this->input->post('jdatel');
			$jmonth = $this->input->post('jmonth');

			$upload = $this->upload_model->upload_file($this->filename_jadwal . '_' . $jdatel);

			if ($upload['result'] == "success") {
				include APPPATH . 'third_party/PHPExcel/PHPExcel.php';
				$loadexcel = PHPExcel_IOFactory::load('uploads/' . $this->filename_jadwal . '_' . $jdatel . '.xlsx');
				$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true, true);
				$data_u  = array();

				$a = 'TELEGRAM ID';
				$b = 'NAMA';
				$c = 'TGL LIBUR';
				if ($a != $sheet[1]['A'] ||	$b != $sheet[1]['B'] ||	$c != $sheet[1]['C']) {
					$this->session->set_flashdata('error', '<b>Failed!</b> <br> Format file JADWAL tidak sesuai! ');
				} else {
					$numrow = 1;
					foreach ($sheet as $row) {
						if ($numrow > 1) {
							if ($row['A'] != "" || $row['A'] != null) {
								$tgl_libur     = $row['C'];
								$expldTgl = explode(",", $tgl_libur);
								$totLibur = count($expldTgl);
								$liburFix = "";
								for ($i = 0; $i < $totLibur; $i++) {
									$dayLibur = trim($expldTgl[$i]);
									if (strlen($dayLibur) == 1) {
										$liburFix .= "0" . $dayLibur . ",";
									} else {
										$liburFix .= $dayLibur . ",";
									}
								}
								$fixTglLibur = rtrim($liburFix, ",");

								$t_telegram_id = $row['A'];
								$dta           = $this->db->get_where('tb_teknisi', array('t_telegram_id' => $t_telegram_id))->row_array();
								if ($dta > 0) {
									if ($jmonth == 'thismonth') {
										array_push($data_u, array(
											't_telegram_id'   => $t_telegram_id,
											'libur'		  	  => $fixTglLibur
										));
									} else {
										array_push($data_u, array(
											't_telegram_id'    => $t_telegram_id,
											'libur_next_month' => $fixTglLibur
										));
									}
								}
							}
						}
						$numrow++;
					}

					if (!empty($data_u)) {
						$this->db->update_batch('tb_teknisi', $data_u, 't_telegram_id');
					}
					$this->session->set_flashdata('info', '<b>Well Done</b> <br> Jadwal sucessfully uploaded!');
					redirect('sales/upload/jadwal');
				}
			} else {
				$data['upload_error'] = $upload['error'];
			}
		}
		$data['title'] 		 = 'Upload';
		$data['subtitle'] 	 = 'Jadwal Bulanan Teknisi';
		$this->load->view('template', [
			'content' => $this->load->view('sales/upload/jadwal', $data, true)
		]);
	}

	public function dorong_ps()
	{
		if (isset($_POST['upload'])) {
			$userweb_id    = $this->session->userdata('user_id');
			$userweb_name  = $this->session->userdata('nama');

			$upload = $this->upload_model->upload_file($this->filename_dorongps);

			if ($upload['result'] == "success") {
				include APPPATH . 'third_party/PHPExcel/PHPExcel.php';

				$loadexcel = PHPExcel_IOFactory::load('uploads/' . $this->filename_dorongps . '.xlsx');

				$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true, true);
				$data_sales = array();
				$data_log 	= array();
				$data_provi = array();

				$a = 'JA';
				$b = 'SC';
				$c = 'Tanggal PS';
				if ($a != $sheet[1]['A'] ||	$b != $sheet[1]['B'] ||	$c != $sheet[1]['C']) {
					$this->session->set_flashdata('error', '<b>Failed!</b> <br> Format file DORONG PS tidak sesuai! ');
				} else {
					$numrow = 1;
					foreach ($sheet as $row) {
						if ($numrow > 1) {
							if ($row['A'] != "" || $row['A'] != null) {
								$sales_id	= str_replace("JA", "", $row['A']);
								$sc			= str_replace("SC", "", $row['B']);
								$tanggal_ps	= $row['C'];
								//$ceksales   = $this->db->query("SELECT sales_id FROM tb_sales WHERE sales_id='" . $sales_id . "'")->num_rows();
								$dta        = $this->db->get_where('tb_sales', array('sales_id' => $sales_id))->row_array();
								if (!empty($dta)) { //cek myir di database
									array_push($data_sales, array(
										'sales_id'        => $sales_id,
										'tgl_update'      => $tanggal_ps,
										'tgl_req_act'     => $tanggal_ps,
										'status'          => 'ps',
										'status_id'  	  => 10,
										'keterangan'      => 'BULK UPDDATE TO STATUS PS'
									));

									array_push($data_log, array(
										'sales_id'          => $sales_id,
										'action_by'         => $this->session->userdata('nama') . ' - Upload Bulk Dorong PS',
										'action_on'         => date('Y-m-d H:i:s'),
										'action_status'     => 10
									));

									array_push($data_provi, array(
										'datel'        	=> $dta['datel'],
										'order_type'    => 'MYI',
										'layanan'     	=> '2P',
										'atas_nama'     => $dta['nama_pelanggan'],
										'alamat'  	  	=> $dta['alamat'],
										'cp'      		=> $dta['cp'],
										'voice'  	  	=> '-',
										'internet'  	=> '-',
										'odp'  	  		=> $dta['req_sc_odp'] == NULL ? $dta['odp'] : $dta['req_sc_odp'],
										'port'  	  	=> $dta['req_sc_port'],
										'sisa'  	  	=> '-',
										'sn'  	  		=> '-',
										'sc'  	  		=> $sc,
										'sc_baru'  	  	=> $sc,
										'mitra'  	  	=> '-',
										'hd_penerima'  	=> '91056926',
										'tgl_masuk'  	=> $tanggal_ps,
										'tgl_update'  	=> $tanggal_ps,
										'tgl_comp_fact' => $tanggal_ps,
										'tgl_ps'  	  	=> $tanggal_ps,
										'updated_by'  	=> $userweb_id,
										'status'  	  	=> 'ps',
										'status_id'  	=> 7
									));

									/*send message to grup*/
									$text = "<b>[$dta[datel]]</b>\n";
									$text .= "JA$sales_id \n";
									$text .= "$dta[nama_pelanggan]\n";
									$text .= "CP : $dta[cp]\n\n";
									$text .= "⚠️ Status Order PS oleh System-Upload Bulk Dorong PS\n\n";
									$message_text .= " ~ $userweb_name";

									sendChatHtml('-463350751', $text);
									/*end of send message to grup*/

									/*send message to sales*/
									$telegram_id = $dta['message_from'];
									$meid        = $dta['message_id'];
									$sales_id    = $dta['sales_id'];
									$message_text = "ORDER SET TO : PS \n";
									$message_text .= "JA$sales_id\n";
									$message_text .= "KET :\n";
									$message_text .= "System-Upload Bulk Dorong PS - SYSTEM \n\n";
									$message_text .= " ~ $userweb_name";

									sendMessage($telegram_id, $message_text, $meid);
									/*end of send message to sales*/
								}
							}
						}
						$numrow++;
					}

					if (!empty($data_sales)) {
						$this->db->update_batch('tb_sales', $data_sales, 'sales_id');
					}

					if (!empty($data_log)) {
						$this->db->insert_batch('tb_log', $data_log);
					}

					if (!empty($data_provi)) {
						$this->db->insert_batch('tb_provisioning', $data_provi);
					}

					$this->session->set_flashdata('info', '<b>Well Done</b> <br> Data sucessfully uploaded!');
					redirect('sales/upload/dorong_ps');
				}
			} else {
				$data['upload_error'] = $upload['error'];
			}
		}
		$data['title'] 		 = 'Dorong PS';
		$data['subtitle'] 	 = 'Geser Status Order PS';
		$this->load->view('template', [
			'content' => $this->load->view('sales/upload/dorong_ps', $data, true)
		]);
	}

	public function reset_order()
	{
		if (isset($_POST['upload'])) {
			$userweb_id    = $this->session->userdata('user_id');
			$userweb_name  = $this->session->userdata('nama');

			$upload = $this->upload_model->upload_file($this->filename_reset);

			if ($upload['result'] == "success") {
				include APPPATH . 'third_party/PHPExcel/PHPExcel.php';

				$loadexcel = PHPExcel_IOFactory::load('uploads/' . $this->filename_reset . '.xlsx');

				$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true, true);
				$data_sales = array();
				$data_log 	= array();
				$datenow	= date('Y-m-d H:i:s');

				$a = 'JA';
				if ($a != $sheet[1]['A']) {
					$this->session->set_flashdata('error', '<b>Failed!</b> <br> Format file RESET ORDER tidak sesuai! ');
				} else {
					$numrow = 1;
					foreach ($sheet as $row) {
						if ($numrow > 1) {
							if ($row['A'] != "" || $row['A'] != null) {
								$sales_id	= str_replace("JA", "", $row['A']);
								$dta        = $this->db->get_where('tb_sales', array('sales_id' => $sales_id))->row_array();
								if (!empty($dta)) { //cek myir di database
									array_push($data_sales, array(
										'sales_id'        	=> $sales_id,
										'sc'     			=> null,
										'new_sc'     		=> null,
										'req_sc_odp'     	=> null,
										'req_sc_port'     	=> null,
										'req_sc_dc'     	=> null,
										'progress_by'     	=> null,
										'progress_to'     	=> null,
										'req_sc_by'     	=> null,
										'input_sc_by'     	=> null,
										'progress_sc_by'    => null,
										'tgl_progress'     	=> null,
										'tgl_req_sc'     	=> null,
										'tgl_input_sc'     	=> null,
										'tgl_req_act'     	=> null,
										'tgl_lapor_k'     	=> null,
										'tgl_update'      	=> $datenow,
										'status'          	=> 'scbe',
										'status_id'  	  	=> 1,
										'kendala'     		=> null,
										'keterangan'      	=> 'BULK RESET ORDER TO AMUNISI'
									));

									array_push($data_log, array(
										'sales_id'          => $sales_id,
										'action_by'         => $this->session->userdata('nama') . ' - Upload Bulk RESET ORDER',
										'action_on'         => date('Y-m-d H:i:s'),
										'action_status'     => 1
									));

									if ($dta['new_sc'] != null && $dta['new_sc'] != '') {
										$this->db->delete('tb_provisioning ', array('sc' => $dta['new_sc']));
									}

									/*send message to grup*/
									$text = "<b>[$dta[datel]]</b>\n";
									$text .= "JA$sales_id \n";
									$text .= "$dta[nama_pelanggan]\n";
									$text .= "CP : $dta[cp]\n\n";
									$text .= "⚠️ Status Order Menjadi Amunisi oleh $userweb_name - Upload Bulk Reset Order\n\n";
									$message_text .= " ~ $userweb_name";

									sendChatHtml('-463350751', $text);
									/*end of send message to grup*/

									/*send message to sales*/
									$telegram_id = $dta['message_from'];
									$meid        = $dta['message_id'];
									$sales_id    = $dta['sales_id'];
									$message_text = "ORDER SET TO : WO \n";
									$message_text .= "JA$sales_id\n";
									$message_text .= "KET :\n";
									$message_text .= "$userweb_name - Upload Bulk Reset Order\n\n";
									$message_text .= " ~ $userweb_name";

									sendMessage($telegram_id, $message_text, $meid);
									/*end of send message to sales*/
								}
							}
						}
						$numrow++;
					}

					if (!empty($data_sales)) {
						$this->db->update_batch('tb_sales', $data_sales, 'sales_id');
					}

					if (!empty($data_log)) {
						$this->db->insert_batch('tb_log', $data_log);
					}

					$this->session->set_flashdata('info', '<b>Well Done</b> <br> Data sucessfully uploaded!');
					redirect('sales/upload/reset_order');
				}
			} else {
				$data['upload_error'] = $upload['error'];
			}
		}
		$data['title'] 		 = 'Reset Order';
		$data['subtitle'] 	 = 'Ubah Status Order Menjadi Amunisi / WO';
		$this->load->view('template', [
			'content' => $this->load->view('sales/upload/reset_order', $data, true)
		]);
	}

	public function download_template()
	{
		if (isset($_POST['upload'])) {
			$source_template = $this->input->post('source_template');

			if ($source_template == "scbe") {
				$nama_file = "./uploads/templates/SCBE.xlsx";
			} elseif ($source_template == "scbe_hsi") {
				$nama_file = "./uploads/templates/SCBE_HSI.xlsx";
			} elseif ($source_template == "scbe_bges") {
				$nama_file = "./uploads/templates/SCBE_BGES.xlsx";
			} elseif ($source_template == "kpro") {
				$nama_file = "./uploads/templates/KPRO_PSB.xlsx";
			} elseif ($source_template == "pda") {
				$nama_file = "./uploads/templates/KPRO_PDA.xlsx";;
			} elseif ($source_template == "addon") {
				$nama_file = "./uploads/templates/KPRO_ADDON.xlsx";;
			}

			$this->load->helper('download');
			force_download($nama_file, NULL);
		}
	}
}

/* End of file Upload.php */
/* Location: ./application/controllers/provisioning/Upload.php */