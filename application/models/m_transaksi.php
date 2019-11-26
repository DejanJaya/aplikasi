<?php
class m_transaksi extends CI_Model{
	function getCombosupplier($nm_tabel){
		$data = array();
			$this->db->select('a.*');
			$this->db->from("$nm_tabel as a");
			
			
			$hasil = $this->db->get();
			foreach ($hasil->result_array() as $row){
			$data[] = $row;
			}

		$json = json_encode($data);
		 
		echo $json;
	}
	function loaddataTabel($offset,$limit,$order,$where){
		$level=$this->session->userdata('level');
		$kd_supplier=$this->session->userdata('kd_supplier');
		
		if (isset($_GET['sort'])) {
			$sort = $this->input->get("sort");
		}else{
			$sort = 'no_faktur';
		}
		
		
			$this->db->select('a.no_faktur');
			$this->db->from('faktur as a');
			$this->db->join('supplier as b ', 'a.kd_supplier = b.kd_supplier');
			
			$this->db->where($where);
			$hasil = $this->db->get();
			$total=$hasil->num_rows();
			
		
			$this->db->select("a.*,b.kd_supplier,b.nm_supplier
			");
			$this->db->from('faktur as a');
			$this->db->join('supplier as b ', 'a.kd_supplier = b.kd_supplier');
		
			$this->db->where($where);
			$this->db->order_by($sort, $order);
			 $this->db->limit($limit, $offset);
			
			$hasil = $this->db->get();
			
		//	echo $this->db->last_query();
			$rs = $hasil->result(); 
            $result["total"] = $total;
			 $items = array();
			foreach($rs as $row){
				 array_push($items, $row);
			}
			
            $result["rows"] = $items;
            echo json_encode($result);
	}
	function loaddataBarang($offset,$limit,$order,$where){
		if (isset($_GET['sort'])) {
			$sort = $this->input->get("sort");
		}else{
			$sort = 'kd_barang';
		}
			$this->db->select('a.kd_barang');
			$this->db->from('barang as a');
			$this->db->where($where);
			
			$hasil = $this->db->get();
			$total=$hasil->num_rows();
			
				$this->db->select("a.*"); 
				$this->db->from('barang as a');
			
			
			$this->db->where($where); 
			          
			$this->db->order_by($sort, $order);
			 $this->db->limit($limit, $offset);
			 
			$hasil = $this->db->get();
			
		//	echo $this->db->last_query();
			$rs = $hasil->result(); 
            $result["total"] = $total;
			 $items = array();
			foreach($rs as $row){
				 array_push($items, $row);
			}
			
            $result["rows"] = $items;
            echo json_encode($result);
	}
	
	function simpanData($data){
		$status=$this->db->insert('faktur', $data);
		if(!$status) return false;
			else return true;
	}
	
	function simpanDatadetai($datamanual){
		$status=$this->db->insert('transaksi', $datamanual);
		//echo $this->db->last_query(); exit;
			if(!$status) return false;
			else return true;
	}
	
	function editData($no_faktur,$data){
		$this->db->where('no_faktur',$no_faktur);
		$status=$this->db->update('faktur', $data);
	///	echo $this->db->last_query(); 
		if(!$status) return false;
		else return true;
	}	
	
	function hapusData($no_faktur){
		
		$this->db->where('no_faktur', $no_faktur);
		$status=$this->db->delete('faktur'); 
		if(!$status) return false;
			else return true;
		
	}

	function hapusDetail($no_faktur){
		$this->db->where('no_faktur', $no_faktur);
		$status=$this->db->delete('transaksi'); 
		if(!$status) return false;
			else return true;
	}
	
	function getDetadetail($no_faktur){
		$result = array();
			$this->db->select("a.*,b.nm_barang,(a.jumlah*a.harga) as jumlah_total");
			$this->db->from('transaksi as a');
			$this->db->join('barang as b ', 'a.kd_barang = b.kd_barang');
		$this->db->where('a.no_faktur',$no_faktur); 
		$hasil = $this->db->get();
		//echo $this->db->last_query();exit;
		$rs = $hasil->result(); 
		 $items = array();
		 $oData = new stdClass;
		 foreach($rs as $row){
			 
			 array_push($items, $row);
		}
		return json_encode($items);
	}
	
}
?>