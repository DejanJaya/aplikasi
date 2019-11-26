<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		date_default_timezone_set('Asia/Jakarta');

		$this->load->model('m_data');

		// cek session yang login, 
		// jika session status tidak sama dengan session telah_login, berarti pengguna belum login
		// maka halaman akan di alihkan kembali ke halaman login.
		if($this->session->userdata('p_ket')!="telah_login"){
			redirect(base_url().'login?alert=belum_login');
		}
	}

	public function index()
	{
		// hitung jumlah artikel
		$data['jumlah_barang'] = $this->m_data->get_data('barang')->num_rows();
		// hitung jumlah kategori
		$data['jumlah_supplier'] = $this->m_data->get_data('supplier')->num_rows();
		// hitung jumlah pengguna
		$data['jumlah_faktur'] = $this->m_data->get_data('faktur')->num_rows();
		// hitung jumlah halaman
		$data['jumlah_transaksi'] = $this->m_data->get_data('transaksi')->num_rows();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_index',$data);
		$this->load->view('dashboard/v_footer');
	}

	public function keluar()
	{
		$this->session->sess_destroy();
		redirect('login?alert=logout');
	}


	// CRUD barang
	public function barang()
	{
		$data['barang'] = $this->m_data->get_data('barang')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_barang',$data);
		$this->load->view('dashboard/v_footer');
	}

	public function barang_tambah()
	{
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_barang_tambah');
		$this->load->view('dashboard/v_footer');
	}

	public function barang_aksi()
	{
		$this->form_validation->set_rules('kd_barang','kd_Barang','required');
		$this->form_validation->set_rules('nm_barang','nm_Barang','required');
		$this->form_validation->set_rules('harga_barang','Harga_Barang','required');

		if($this->form_validation->run() != false){

			$kd_barang = $this->input->post('kd_barang');
			$nm_barang = $this->input->post('nm_barang');
			$harga_barang = $this->input->post('harga_barang');

			$data = array(
				'kd_barang' => $kd_barang,
				'nm_barang' => $nm_barang,
				'harga_barang' => $harga_barang
			);

			$this->m_data->insert_data($data,'barang');

			redirect(base_url().'dashboard/barang');
			
		}else{
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_barang_tambah');
			$this->load->view('dashboard/v_footer');
		}
	}

	public function barang_edit($id)
	{
		$where = array(
			'kd_barang' => $id
		);
		$data['barang'] = $this->m_data->edit_data($where,'barang')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_barang_edit',$data);
		$this->load->view('dashboard/v_footer');
	}

	public function barang_update()
	{
		$this->form_validation->set_rules('kd_barang','kd_Barang','required');
		$this->form_validation->set_rules('nm_barang','nm_Barang','required');
		$this->form_validation->set_rules('harga_barang','Harga_Barang','required');

		if($this->form_validation->run() != false){

			$id = $this->input->post('kd_barang');
			$nm_barang = $this->input->post('nm_barang');
			$harga_barang = $this->input->post('harga_barang');

			$where = array(
				'kd_barang' => $id
			);

			$data = array(
				'kd_barang' => $id,
				'nm_barang' => $nm_barang,
				'harga_barang' => $harga_barang
			);

			$this->m_data->update_data($where, $data,'barang');

			redirect(base_url().'dashboard/barang');
			
		}else{

			$id = $this->input->post('kd_barang');
			$where = array(
				'kd_barang' => $id
			);
			$data['barang'] = $this->m_data->edit_data($where,'barang')->result();
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_barang_edit',$data);
			$this->load->view('dashboard/v_footer');
		}
	}


	public function barang_hapus($id)
	{
		$where = array(
			'kd_barang' => $id
		);

		$this->m_data->delete_data($where,'barang');

		redirect(base_url().'dashboard/barang');
	}
	// END CRUD BARANG

	// CRUD SUPPLIER
	public function supplier()
	{
		$data['supplier'] = $this->m_data->get_data('supplier')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_supplier',$data);
		$this->load->view('dashboard/v_footer');
	}

	public function supplier_tambah()
	{
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_supplier_tambah');
		$this->load->view('dashboard/v_footer');
	}

	public function supplier_aksi()
	{
		$this->form_validation->set_rules('kd_supplier','kd_Supplier','required');
		$this->form_validation->set_rules('nm_supplier','nm_Supplier','required');

		if($this->form_validation->run() != false){

			$kd_supplier = $this->input->post('kd_supplier');
			$nm_supplier = $this->input->post('nm_supplier');

			$data = array(
				'kd_supplier' => $kd_supplier,
				'nm_supplier' => $nm_supplier
			);

			$this->m_data->insert_data($data,'supplier');

			redirect(base_url().'dashboard/supplier');
			
		}else{
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_supplier_tambah');
			$this->load->view('dashboard/v_footer');
		}
	}

	public function supplier_edit($id)
	{
		$where = array(
			'kd_supplier' => $id
		);
		$data['supplier'] = $this->m_data->edit_data($where,'supplier')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_supplier_edit',$data);
		$this->load->view('dashboard/v_footer');
	}

	public function supplier_update()
	{
		$this->form_validation->set_rules('kd_supplier','kd_Supplier','required');
		$this->form_validation->set_rules('nm_supplier','nm_Supplier','required');


		if($this->form_validation->run() != false){

			$id = $this->input->post('kd_supplier');
			$nm_supplier = $this->input->post('nm_supplier');

			$where = array(
				'kd_supplier' => $id
			);

			$data = array(
				'kd_supplier' => $id,
				'nm_supplier' => $nm_supplier
			);

			$this->m_data->update_data($where, $data,'supplier');

			redirect(base_url().'dashboard/supplier');
			
		}else{

			$id = $this->input->post('kd_supplier');
			$where = array(
				'kd_supplier' => $id
			);
			$data['supplier'] = $this->m_data->edit_data($where,'supplier')->result();
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_supplier_edit',$data);
			$this->load->view('dashboard/v_footer');
		}
	}


	public function supplier_hapus($id)
	{
		$where = array(
			'kd_supplier' => $id
		);

		$this->m_data->delete_data($where,'supplier');

		redirect(base_url().'dashboard/supplier');
	}
	// end crud SUPPLIER


	// CRUD FAKTUR
	public function faktur()
	{
		$data['faktur'] = $this->db->query("SELECT * FROM faktur f, supplier s WHERE f.kd_supplier=s.kd_supplier")->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_faktur',$data);
		$this->load->view('dashboard/v_footer');
	}

	public function faktur_tambah()
	{
		$data['supplier'] = $this->m_data->get_data('supplier')->result();
	//	print_r($data['supplier']);exit;
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_faktur_tambah',$data);
		$this->load->view('dashboard/v_footer');
	}

	public function faktur_aksi()
	{
		$this->form_validation->set_rules('no_faktur','no_Faktur','required');
		$this->form_validation->set_rules('kd_supplier','kd_Supplier','required');
		$this->form_validation->set_rules('tanggal','Tanggal','required');
		$this->form_validation->set_rules('jatuh_tempo','Jatuh_Tempo','required');
		$this->form_validation->set_rules('total','Total','required');
		$this->form_validation->set_rules('total_faktur','Total_Faktur','required');

		if($this->form_validation->run() != false){

			$no_faktur = $this->input->post('no_faktur');
			$kd_supplier = $this->input->post('kd_supplier');
			$tanggal = $this->input->post('tanggal');
			$jatuh_tempo = $this->input->post('jatuh_tempo');
			$total = $this->input->post('total');
			$total_faktur = $this->input->post('total_faktur');

			$data = array(
				'no_faktur' => $no_faktur,
				'kd_supplier' => $kd_supplier,
				'tanggal' => $tanggal,
				'jatuh_tempo' => $jatuh_tempo,
				'total' => $total,
				'total_faktur' => $total_faktur
			);
		//	print_r($data); exit;

			$this->m_data->insert_data($data,'faktur');

			redirect(base_url().'dashboard/faktur');
			
		}else{
			$data['supplier'] = $this->m_data->get_data('supplier')->result();
			//print_r($data['supplier'] ); exit;
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_faktur_tambah',$data);
			$this->load->view('dashboard/v_footer');
		}
	}

	public function faktur_edit($id)
	{
		$where = array(
			'no_faktur' => $id
		);
		$data['supplier'] = $this->m_data->get_data('supplier')->result();
		//print_r($data['supplier']); exit;
		$data['faktur'] = $this->m_data->edit_data($where,'faktur')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_faktur_edit',$data);
		$this->load->view('dashboard/v_footer');
	}

	public function faktur_update()
	{
		$this->form_validation->set_rules('no_faktur','no_Faktur','required');
		$this->form_validation->set_rules('kd_supplier','kd_Supplier','required');
		$this->form_validation->set_rules('tanggal','Tanggal','required');
		$this->form_validation->set_rules('jatuh_tempo','Jatuh_Tempo','required');
		$this->form_validation->set_rules('total','Total','required');
		$this->form_validation->set_rules('total_faktur','Total_Faktur','required');


		if($this->form_validation->run() != false){

			$id = $this->input->post('no_faktur');
			$kd_supplier = $this->input->post('kd_supplier');
			$tanggal = $this->input->post('tanggal');
			$jatuh_tempo = $this->input->post('jatuh_tempo');
			$total = $this->input->post('total');
			$total_faktur = $this->input->post('total_faktur');

			$where = array(
				'no_faktur' => $id
			);

			$data = array(
				'no_faktur' => $id,
				'kd_supplier' => $kd_supplier,
				'tanggal' => $tanggal,
				'jatuh_tempo' => $jatuh_tempo,
				'total' => $total,
				'total_faktur' => $total_faktur
			);

			$this->m_data->update_data($where, $data,'faktur');

			redirect(base_url().'dashboard/faktur');
			
		}else{

			$id = $this->input->post('no_faktur');
			$where = array(
				'no_faktur' => $id
			);
			$data['faktur'] = $this->m_data->edit_data($where,'faktur')->result();
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_faktur_edit',$data);
			$this->load->view('dashboard/v_footer');
		}
	}


	public function faktur_hapus($id)
	{
		$where = array(
			'no_faktur' => $id
		);

		$this->m_data->delete_data($where,'faktur');

		redirect(base_url().'dashboard/faktur');
	}
	// end crud FAKTUR
	

	// CRUD USER
	public function user()
	{
		$data['user'] = $this->m_data->get_data('user')->result();	
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_user',$data);
		$this->load->view('dashboard/v_footer');
	}

	public function user_tambah()
	{
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_user_tambah');
		$this->load->view('dashboard/v_footer');
	}

	public function user_aksi()
	{
		// Wajib isi
		$this->form_validation->set_rules('username','Username','required');
		$this->form_validation->set_rules('password','Password User','required');
		$this->form_validation->set_rules('nama','Nama User','required');
		$this->form_validation->set_rules('email','Email User','required|min_length[8]');
		$this->form_validation->set_rules('akses','Akses User','required');
		$this->form_validation->set_rules('status','Status User','required');

		if($this->form_validation->run() != false){

			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$nama = $this->input->post('nama');
			$email = $this->input->post('email');
			$akses = $this->input->post('akses');
			$status = $this->input->post('status');

			$data = array(
				'username' => $username,
				'password' => $password,
				'nama' => $nama,
				'email' => $email,
				'akses' => $akses,
				'status' => $status
			);


			$this->m_data->insert_data($data,'user');

			redirect(base_url().'dashboard/user');	

		}else{
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_user_tambah');
			$this->load->view('dashboard/v_footer');
		}
	}

	public function user_edit($id)
	{
		$where = array(
			'username' => $id
		);
		$data['user'] = $this->m_data->edit_data($where,'user')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_user_edit',$data);
		$this->load->view('dashboard/v_footer');
	}


	public function user_update()
	{
		// Wajib isi
		$this->form_validation->set_rules('username','Username','required');
		$this->form_validation->set_rules('password','Password User','required');
		$this->form_validation->set_rules('nama','Nama User','required');
		$this->form_validation->set_rules('email','Email User','required|min_length[8]');
		$this->form_validation->set_rules('akses','Akses User','required');
		$this->form_validation->set_rules('status','Status User','required');

		if($this->form_validation->run() != false){

			$id = $this->input->post('username');

			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$nama = $this->input->post('nama');
			$email = $this->input->post('email');
			$akses = $this->input->post('akses');
			$status = $this->input->post('status');

			if($this->input->post('password') == ""){
				$data = array(
					'username' => $username,
					//'password' => $password,
					'nama' => $nama,
					'email' => $email,
					'akses' => $akses,
					'status' => $status				
				);
			}else{
				$data = array(
					'username' => $username,
					'password' => $password,
					'nama' => $nama,
					'email' => $email,
					'akses' => $akses,
					'status' => $status				
				);
			}
			
			$where = array(
				'username' => $id
			);

			$this->m_data->update_data($where,$data,'user');

			redirect(base_url().'dashboard/user');
		}else{
			$id = $this->input->post('username');
			$where = array(
				'username' => $id
			);
			$data['user'] = $this->m_data->edit_data($where,'user')->result();
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_user_edit',$data);
			$this->load->view('dashboard/v_footer');
		}
		
	}

	/*public function user_hapus($id)
	{
		$where = array(
			'username' => $id
		);
		$data['user_hapus'] = $this->m_data->edit_data($where,'user')->row();
		//$data['user_lain'] = $this->db->query("SELECT * FROM user WHERE username = $id")->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_user_hapus',$data);
		$this->load->view('dashboard/v_footer');
	}

	public function user_hapus_aksi()
	{
		$user_hapus = $this->input->post('user_hapus');
		$user_tujuan = $this->input->post('user_tujuan');

		// hapus user
		$where = array(
			'username' => $user_hapus
		);

		$this->m_data->delete_data($where,'user');

		// pindahkan semua user yang dihapus ke user yang dipilih
		$w = array(
			'transaksi_author' => $user_hapus
		);

		$d = array(
			'transaksi_author' => $user_tujuan
		);

		$this->m_data->update_data($w,$d,'transaksi');

		redirect(base_url().'dashboard/user');
	}
	// end crud user
	*/
	public function user_hapus($id)
	{
		$where = array(
			'username' => $id
		);

		$this->m_data->delete_data($where,'user');

		redirect(base_url().'dashboard/user');
	}
	
}
