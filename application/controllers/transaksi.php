<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class transaksi extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('m_transaksi');
	}

	public function index()
	{
		$this->load->view('dashboard/v_header');
	 	
		$this->load->view('dashboard/v_transaksi');
		$this->load->view('dashboard/v_transaksi_js');
		$this->load->view('dashboard/v_footer');
	}
	
	function getCombosupplier($nm_tabel){
		
	   $this->m_transaksi->getCombosupplier($nm_tabel);
	   
	  
	}
	function loaddataTabel(){
		$offset = $this->input->get("offset");
		$limit = $this->input->get("limit");
		$order = $this->input->get("order");
		 if($this->input->get("search")){
		 	$search = $this->input->get("search");
			 $where="(upper(a.no_faktur) like upper('%$search%')  or upper(a.nm_supplier) like upper('%$search%')
					or upper(a.tanggal) like upper('%$search%') or upper(a.total_faktur) like upper('%$search%'))  ";
			 
			 }else{
			 $where='a.no_faktur is not null';
			 }
		 
        $this->m_transaksi->loaddataTabel($offset,$limit,$order,$where); 
	}
	function loaddataBarang(){
	   $offset = $this->input->get("offset");
	   $limit = $this->input->get("limit");
	   $order = $this->input->get("order");
		 if($this->input->get("search")){
		 	$search = $this->input->get("search");
			 $where="(upper(a.kd_barang) like upper('%$search%')  or upper(a.nm_barang) like upper('%$search%'))  ";
			 
			 }else{
			 $where='a.kd_barang is not null';
			 }
		 
        $this->m_transaksi->loaddataBarang($offset,$limit,$order,$where); 
   }
   
   function simpanData(){
	   
	$this->db->trans_begin();
	$status=true;
	$totalcek=0;
	$no_faktur = trim($this->input->post('no_faktur'));
	$kd_supplier = trim($this->input->post('kd_supplier'));
	$tanggal = trim($this->input->post('tanggal'));
	
	$total_faktur = trim($this->input->post("total_faktur"));
	$set = trim($this->input->post("set"));
	$data=array(
		'no_faktur'=>$no_faktur,
		'tanggal'=>$tanggal,
		'kd_supplier'=>$kd_supplier,
		'total_faktur'=>$total_faktur);
		
	
	if($set==0){
		
		$ceksatu=$this->m_transaksi->simpanData($data);
		
	}else{
		$this->m_transaksi->hapusDetail($no_faktur);
		$ceksatu=$this->m_transaksi->editData($no_faktur,$data);
		
		
	}	
	if($ceksatu==1){
			$setsim="ok";	
		}else{
			$totalcek++;
		}

	
	
	
	
	
	
	if (isset($_POST['detail'])) {
			$detaildua = $this->input->post('detail');
			foreach ($detaildua as $key => $detaildua ) {
				 $kd_barang=trim($detaildua['kd_barang']);
				  $jumlah=trim($detaildua['jumlah']);
				  $harga=trim($detaildua['harga']);
			
				  $datamanual = array(
						'no_faktur'=>$no_faktur,
						'kd_barang'=>$kd_barang,
						'jumlah'=>$jumlah,
						'harga'=>$harga
					);
					$ceksatu=$this->m_transaksi->simpanDatadetai($datamanual);
					
					if($ceksatu==1){
						$setsim="ok";	
					}else{
						$totalcek++;
					}
				 
			}
		}
		
	
	$status = $this->db->trans_status();
	if($totalcek>0){
		$this->db->trans_rollback();
		echo json_encode(array("pesan" => "Informasi <br> Simpan Data Gagal1","status" => "error"));
	}else if ($status === FALSE) {
		$this->db->trans_rollback();
	//	echo $setsim;
		echo json_encode(array("pesan" => "Informasi <br> Simpan Data Gagal","status" => "error"));
	}else {
		$this->db->trans_commit();
	//	echo $setsim;
		echo json_encode(array("pesan" => "Informasi <br> Simpan data Berhasil","status" => "success"));
		}
	return $status;	
   }
   
   function getDetadetail(){
	   $no_faktur= $this->input->get("no_faktur");
	   echo $this->m_transaksi->getDetadetail($no_faktur); 
   }
   
   function hapusData(){
	    $no_faktur = $this->input->get("no_faktur");
		 $this->m_transaksi->hapusDetail($no_faktur);
		 $ceksatu=$this->m_transaksi->hapusData($no_faktur);
	
			if($ceksatu==1){
				echo json_encode(array("pesan" => "Informasi <br> Hapus data Berhasil","status" => "success"));
	
			}else{
				echo json_encode(array("pesan" => "Informasi <br> Hapus Data Gagal","status" => "error"));
			}
	
   }
}
?>
