<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$sales_id	= $_GET['ja'];

		if (is_null($sales_id)) {
			echo "GET : Kode JA harus di isi.";
		} else {
			$data = $this->api_model->getSales($sales_id)->row_array();
			echo json_encode($data);
		}
	}

	public function post()
	{
		$post	 	= $this->input->post(NULL, TRUE);
		$sales_id	= $post['ja'];

		if (is_null($sales_id)) {
			echo "POST : Kode JA harus di isi.";
		} else {
			$data = $this->api_model->getSales($sales_id)->row_array();
			echo json_encode($data);
		}
	}
}
