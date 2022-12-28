<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends MY_Controller
{

	private $table = 'tb_users';

	public function __construct()
	{
		parent::__construct();
	}

	public function login()
	{
		$this->load->view('auth/login');
	}

	public function getlogin()
	{
		$post = $this->input->post(NULL, TRUE);

		$secret		= '6LdzsT4iAAAAAOsl6HNb3lcTg3U9AXvRVDghUSMf';
		$response	= $post['g-recaptcha-response'];
		$remoteip	= $this->input->ip_address();
		$url		= "https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$remoteip";
		$data		= file_get_contents($url);
		$row		= json_decode($data, true);

		// if ($row['success']) {
		$cekemail = $this->db->query("SELECT email FROM tb_users where email='" . $post['email'] . "'")->num_rows();
		$cekea 	  = $this->db->query("SELECT email FROM tb_users where email='" . $post['email'] . "' AND active = 1")->num_rows();
		if ($cekemail > 0) {
			if ($cekea > 0) {
				$user_detail = $this->db->get_where('tb_users', array('email' => $post['email'], 'active' => 1), 1, NULL)->row();

				if (@$user_detail->password == crypt($post['password'], @$user_detail->password) && @$user_detail->active == 1) {

					$login_data = array(
						'user_id' 	=> $user_detail->users_id,
						'username' 	=> $user_detail->username,
						'email'  	=> $post['email'],
						'logged_in' => TRUE,
						'nama' 		=> $user_detail->fullname,
						'level' 	=> $user_detail->level,
						'active' 	=> $user_detail->active
					);

					$this->session->set_userdata($login_data);
					$this->db->where('users_id', $user_detail->users_id);
					$this->db->update('tb_users', array('last_login' => date('Y-m-d H:i:s')));
					redirect(base_url("welcome"));
				} else {

					$this->session->set_flashdata('info', '<div class="alert alert-danger" role="alert"><strong>Maaf!</strong> kombinasi email dan password anda tidak tepat.</div>');
					redirect('auth');
				}
			} else {
				$this->session->set_flashdata('info', '<div class="alert alert-danger" role="alert"><strong>Maaf!</strong> email sudah terdaftar namun belum mendapat approve manajemen. silahkan hubungi manajemen untuk aktifasi akun.</div>');
				redirect('auth');
			}
		} else {
			$this->session->set_flashdata('info', '<div class="alert alert-danger" role="alert"><strong>Maaf!</strong> email belum terdaftar, silahkan hubungi manajemen untuk pendaftaran akun.</div>');
			redirect('auth');
		}
		// } else {
		// 	$this->session->set_flashdata('info', '<div class="alert alert-danger" role="alert"><strong>Maaf!</strong> recaptcha tidak valid, silahkan ulangi.</div>');
		// 	redirect('auth');
		// }
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url('auth'));
	}

	public function register()
	{
		if (isset($_POST['daftar'])) {
			$post = $this->input->post(NULL, TRUE);
			$cek = $this->db->query("SELECT email FROM tb_users where email='" . $post['email'] . "'")->num_rows();
			if ($cek <= 0) {

				$activation_code = randoms_string(25);

				$data = array(
					'username' 	=> strtolower(str_replace(' ', '_', $post['first_name'])),
					'password' 	=> bCrypt($post['password'], 12),
					'level'		=> 'user',
					'fullname'	=> $post['first_name'],
					'email'		=> $post['email'],
					'active'	=> 0,
					'activation_code' => $activation_code
				);

				$insert = $this->db->insert('tb_users', $data);


				if ($insert) {
					$this->session->set_flashdata('info', '<div class="alert alert-success" role="alert">Pendaftaran Berhasil! Silahkan hubungi admin untuk aktifasi akun anda.</div>');
					redirect('auth/register');
				} else {
					$this->session->set_flashdata('info', '<div class="alert alert-danger" role="alert">Maaf gagal register akun baru</div>');
					redirect('auth/register');
				}
			} else {
				$this->session->set_flashdata('info', '<div class="alert alert-danger" role="alert">Maaf email sudah digunakan!</div>');
				redirect('auth/register');
			}
		}
	}

	public function reset_password()
	{
		$post = $this->input->post(NULL, TRUE);
		$newpass = date('His');
		$cek = $this->db->query("SELECT email FROM tb_users WHERE email='" . $post['forgotEmail'] . "'")->num_rows();
		if ($cek > 0) {

			$data = array(
				'password' => bCrypt($newpass, 12)
			);
			$this->db->where('email', $post['forgotEmail']);
			$this->db->update('tb_users', $data);

			$config = [
				'mailtype'  => 'html',
				'charset'   => 'utf-8',
				'protocol'  => 'smtp',
				'smtp_host' => 'ssl://mail.jarvisid.com',
				'smtp_user' => 'support@jarvisid.com',
				'smtp_pass'   => 'jarvismail123456789',
				'smtp_port'   => 465,
				'wordwrap' => TRUE
			];

			$this->load->library('email', $config);

			$this->email->set_newline("\r\n");
			$email_setting  = array('mailtype' => 'html');
			$this->email->initialize($email_setting);

			$this->email->from('support@jarvisid.com', 'Jarvis Team');
			$this->email->to($post['forgotEmail']);

			$this->email->subject('Forgot Password | JARVIS');
			$this->email->message("
				User yang terhormat,<br><br>
				Terimakasih telah melakukan Lupa Password pada aplikasi Jarvis.<br>
				=======================================================================<br>
				<b>User Login		: " . $post['forgotEmail'] . "<br>
				Password Baru	: " . $newpass . "<br>
				Harap segera melakukan pergantian password.<br>
				Dengan cara :<br>
				1. Klik Foto Profile<br>
				2. Klik Menu Change Password</b><br>
				=======================================================================<br>
				Selamat bekerja !!<br><br>

				Salam, Telkom Indonesia---------------------
			");
			//$this->email->set_mailtype("html");
			$send = $this->email->send();

			//echo $this->email->print_debugger();

			if ($send) {
				$this->session->set_flashdata('info', '<div class="alert alert-success" role="alert">Silahkan cek email ' . $post['forgotEmail'] . ' dan lakukan login kembali.</div>');
				redirect('auth');
			} else {
				$this->session->set_flashdata('info', '<div class="alert alert-success" role="alert">Silahkan cek email ' . $post['forgotEmail'] . ' dan lakukan login kembali.</div>');
				// $this->session->set_flashdata('info','<div class="alert alert-danger" role="alert">Maaf email password gagal terkirim.</div>');
				redirect('auth');
			}
		} else {
			$this->session->set_flashdata('info', '<div class="alert alert-danger" role="alert">Maaf email ' . $post['forgotEmail'] . ' tidak terdaftar!</div>');
			redirect('auth');
		}
	}

	public function changePassword()
	{
		$data['title']		= 'User';
		$data['subtitle']	= 'Change Password';
		if (isset($_POST['submit'])) {
			$this->form_validation->set_rules('oldpass', 'Old Password', 'required');
			$this->form_validation->set_rules('newpass', 'New Password', 'required');
			$this->form_validation->set_rules('repass', 'Re Password', 'required|matches[newpass]');
			if ($this->form_validation->run() == FALSE) {
				redirect('changePassword');
			} else {
				$users_id		= $this->input->post('users_id');
				$old 			= $this->input->post('oldpass');
				$new 			= $this->input->post('newpass');

				$user_detail = $this->db->get_where('tb_users', array('users_id' => $users_id), 1, NULL)->row();
				if (@$user_detail->password == crypt($old, @$user_detail->password)) {
					$object = array(
						'password' 	 => bCrypt($new, 12)
					);
					$this->db->where('users_id', $users_id);
					$this->db->update('tb_users', $object);
					$this->session->set_flashdata('info', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Password Berhasil Diubah!</div>');
					redirect('changePassword');
				} else {
					$this->session->set_flashdata('info', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Password lama tidak sesuai!</div>');
					redirect('changePassword');
				}
			}
		}
		$this->load->view('template', [
			'content' => $this->load->view('auth/change_pass', $data, true)
		]);
	}
}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */
