<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('logged_in') != TRUE) {
			redirect(base_url("auth"));
		}

		if (menuReport($this->session->userdata('level')) == false) {
			redirect(base_url("welcome"));
		}
	}

	public function index()
	{
		$data['title'] 		    = 'Report';
		$data['subtitle'] 	    = 'Sales Report';
		$this->load->view('template', [
			'content' => $this->load->view('sales/report/form', $data, true)
		]);
	}

	public function download()
	{
		include APPPATH . 'third_party/PHPExcel/PHPExcel.php';

		$excel = new PHPExcel();
		$excel->getProperties()->setCreator('DamanPKL')
			->setLastModifiedBy('DamanPKL')
			->setTitle("Laporan Sales")
			->setSubject("Sales")
			->setDescription("Laporan Sales Witel PKL")
			->setKeywords("Laporan Sales");

		$style_col = array(
			'font' => array('bold' => true),
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
			),
			'fill' => array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'color' => array('rgb' => '8cb3f2')
			)
		);
		// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
		$style_row = array(
			'alignment' => array(
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
			)
		);
		// Buat header tabel nya pada baris ke 3
		$excel->setActiveSheetIndex(0)->setCellValue('A1', "NO");
		$excel->setActiveSheetIndex(0)->setCellValue('B1', "JA");
		$excel->setActiveSheetIndex(0)->setCellValue('C1', "DATEL");
		$excel->setActiveSheetIndex(0)->setCellValue('D1', "NAMA PELANGGAN");
		$excel->setActiveSheetIndex(0)->setCellValue('E1', "NO KTP");
		$excel->setActiveSheetIndex(0)->setCellValue('F1', "ALAMAT");
		$excel->setActiveSheetIndex(0)->setCellValue('G1', "LAT,LNG");
		$excel->setActiveSheetIndex(0)->setCellValue('H1', "CP");
		$excel->setActiveSheetIndex(0)->setCellValue('I1', "EMAIL");
		$excel->setActiveSheetIndex(0)->setCellValue('J1', "ODP");
		$excel->setActiveSheetIndex(0)->setCellValue('K1', "KODE SALES");
		$excel->setActiveSheetIndex(0)->setCellValue('L1', "PAKET");
		$excel->setActiveSheetIndex(0)->setCellValue('M1', "JARAK TIANG");
		$excel->setActiveSheetIndex(0)->setCellValue('N1', "SC");
		$excel->setActiveSheetIndex(0)->setCellValue('O1', "SC BARU");
		$excel->setActiveSheetIndex(0)->setCellValue('P1', "MYIR");
		$excel->setActiveSheetIndex(0)->setCellValue('Q1', "KATEGORI");
		$excel->setActiveSheetIndex(0)->setCellValue('R1', "SALES BY");
		$excel->setActiveSheetIndex(0)->setCellValue('S1', "TGL MASUK");
		$excel->setActiveSheetIndex(0)->setCellValue('T1', "TEKNISI");
		$excel->setActiveSheetIndex(0)->setCellValue('U1', "KENDALA");
		$excel->setActiveSheetIndex(0)->setCellValue('V1', "STATUS");
		$excel->setActiveSheetIndex(0)->setCellValue('W1', "KETERANGAN");
		$excel->setActiveSheetIndex(0)->setCellValue('X1', "LAST UPDATE");
		$excel->setActiveSheetIndex(0)->setCellValue('Y1', "UNIT");
		$excel->setActiveSheetIndex(0)->setCellValue('Z1', "JENIS");

		// Apply style header yang telah kita buat tadi ke masing-masing kolom header
		$excel->getActiveSheet()->getStyle('A1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('B1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('C1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('D1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('E1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('F1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('G1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('H1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('I1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('J1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('K1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('L1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('M1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('N1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('O1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('P1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('Q1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('R1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('S1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('T1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('U1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('V1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('W1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('X1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('Y1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('Z1')->applyFromArray($style_col);

		// Panggil function view
		$fdatel    		= $this->input->post('fdatel');
		$fkategori    	= $this->input->post('fkategori');
		$fstartdate  	= $this->input->post('fstartdate');
		$fenddate    	= $this->input->post('fenddate');

		$query = $this->report_model->search_sales($fdatel, $fkategori, $fstartdate, $fenddate)->result_array();
		$numrow = 2; // Set baris pertama untuk isi tabel adalah baris ke 4
		$no = 1;
		foreach ($query as $data) {
			$kat = $data['kategori'];
			if ($kat == 1) {
				$kategori = 'DEAL, ODP READY';
			} elseif ($kat == 2) {
				$kategori = 'NOT DEAL, ODP READY';
			} elseif ($kat == 3) {
				$kategori = 'UNSC';
			} else {
				$kategori = 'NOT SET';
			}

			$excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $no++);
			$excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, 'JA' . $data['sales_id']);
			$excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, $data['datel']);
			$excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $data['nama_pelanggan']);
			$excel->setActiveSheetIndex(0)->setCellValue('E' . $numrow, $data['no_ktp']);
			$excel->setActiveSheetIndex(0)->setCellValue('F' . $numrow, $data['alamat']);
			$excel->setActiveSheetIndex(0)->setCellValue('G' . $numrow, $data['lat_long']);
			$excel->setActiveSheetIndex(0)->setCellValue('H' . $numrow, $data['cp']);
			$excel->setActiveSheetIndex(0)->setCellValue('I' . $numrow, $data['email']);
			$excel->setActiveSheetIndex(0)->setCellValue('J' . $numrow, $data['odp']);
			$excel->setActiveSheetIndex(0)->setCellValue('K' . $numrow, $data['kode']);
			$excel->setActiveSheetIndex(0)->setCellValue('L' . $numrow, $data['paket']);
			$excel->setActiveSheetIndex(0)->setCellValue('M' . $numrow, $data['jarak_tiang']);
			$excel->setActiveSheetIndex(0)->setCellValue('N' . $numrow, $data['sc']);
			$excel->setActiveSheetIndex(0)->setCellValue('O' . $numrow, $data['new_sc']);
			$excel->setActiveSheetIndex(0)->setCellValue('P' . $numrow, $data['myir']);
			$excel->setActiveSheetIndex(0)->setCellValue('Q' . $numrow, $kategori);
			$excel->setActiveSheetIndex(0)->setCellValue('R' . $numrow, $data['fullname']);
			$excel->setActiveSheetIndex(0)->setCellValue('S' . $numrow, $data['tgl_post']);
			$excel->setActiveSheetIndex(0)->setCellValue('T' . $numrow, $data['nama_teknisi']);
			$excel->setActiveSheetIndex(0)->setCellValue('U' . $numrow, $data['kendala']);
			$excel->setActiveSheetIndex(0)->setCellValue('V' . $numrow, $data['status']);
			$excel->setActiveSheetIndex(0)->setCellValue('W' . $numrow, $data['keterangan']);
			$excel->setActiveSheetIndex(0)->setCellValue('X' . $numrow, $data['tgl_update']);
			$excel->setActiveSheetIndex(0)->setCellValue('Y' . $numrow, $data['unit']);
			$excel->setActiveSheetIndex(0)->setCellValue('Z' . $numrow, getIDSegment($data['segment']));

			// Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
			$excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('G' . $numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('H' . $numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('I' . $numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('J' . $numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('K' . $numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('L' . $numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('M' . $numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('N' . $numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('O' . $numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('P' . $numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('Q' . $numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('R' . $numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('S' . $numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('T' . $numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('U' . $numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('V' . $numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('W' . $numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('X' . $numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('Y' . $numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('Z' . $numrow)->applyFromArray($style_row);

			$numrow++; // Tambah 1 setiap kali looping
		}
		// Set width kolom
		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(10); // Set width kolom A
		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(10); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('C')->setWidth(15); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('D')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('E')->setWidth(10); // Set width kolom E
		$excel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
		$excel->getActiveSheet()->getColumnDimension('G')->setWidth(18);
		$excel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
		$excel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
		$excel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
		$excel->getActiveSheet()->getColumnDimension('K')->setWidth(15);
		$excel->getActiveSheet()->getColumnDimension('L')->setWidth(15);
		$excel->getActiveSheet()->getColumnDimension('M')->setWidth(15);
		$excel->getActiveSheet()->getColumnDimension('N')->setWidth(15);
		$excel->getActiveSheet()->getColumnDimension('O')->setWidth(15);
		$excel->getActiveSheet()->getColumnDimension('P')->setWidth(15);
		$excel->getActiveSheet()->getColumnDimension('Q')->setWidth(15);
		$excel->getActiveSheet()->getColumnDimension('R')->setWidth(15);
		$excel->getActiveSheet()->getColumnDimension('S')->setWidth(15);
		$excel->getActiveSheet()->getColumnDimension('T')->setWidth(15);
		$excel->getActiveSheet()->getColumnDimension('U')->setWidth(15);
		$excel->getActiveSheet()->getColumnDimension('V')->setWidth(15);
		$excel->getActiveSheet()->getColumnDimension('W')->setWidth(15);
		$excel->getActiveSheet()->getColumnDimension('X')->setWidth(15);
		$excel->getActiveSheet()->getColumnDimension('Y')->setWidth(15);
		$excel->getActiveSheet()->getColumnDimension('Z')->setWidth(15);

		// Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
		$excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
		// Set orientasi kertas jadi LANDSCAPE
		$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		// Set judul file excel nya
		$excel->getActiveSheet(0)->setTitle("DATA SALES");
		$excel->setActiveSheetIndex(0);
		// Proses file excel
		//set_time_limit(1000000);
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="LAPORAN SALES ' . shortdate_indo($fstartdate) . ' - ' . shortdate_indo($fenddate) . '.xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');
		$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$write->save('php://output');
	}
}

/* End of file Report.php */
/* Location: ./application/controllers/sales/Report.php */