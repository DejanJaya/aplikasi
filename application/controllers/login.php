<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
		$this->load->view('v_login');
	}

	public function aksi()
	{

		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if($this->form_validation->run() != false){

			// menangkap data username dan password dari halaman login
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$where = array(
				'username' => $username,
				'password' => $password,
				'status' => 1
			);

			$this->load->model('m_data');

			// cek kesesuaian login pada table user
			$cek = $this->m_data->cek_login('user',$where)->num_rows();

			// cek jika login benar
			if($cek > 0){

				// ambil data user yang melakukan login
				$data = $this->m_data->cek_login('user',$where)->row();

				// buat session untuk user yang berhasil login
				$data_session = array(
					'p_username' => $data->username,
					'p_akses' => $data->akses,
					'p_ket' => 'telah_login'
				);
				$this->session->set_userdata($data_session);
                
				// alihkan halaman ke halaman dashboard user

				redirect(base_url().'dashboard');
			}else{
				redirect(base_url().'login?alert=gagal');
			}

		}else{
			$this->load->view('v_login');
			
		}
	}
}
