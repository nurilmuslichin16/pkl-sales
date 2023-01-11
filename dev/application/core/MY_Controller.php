<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{

	public $data = array();

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('api_model', 'token_model', 'input_model', 'myi_model', 'update_model', 'wo_model', 'report_model', 'dashboard_model', 'kendala_model', 'unsc_engagement_model', 'construction_model', 'upload_model', 'project_model', 'mitra_model', 'pelurusan_model', 'teknisi_model'));
	}
}
