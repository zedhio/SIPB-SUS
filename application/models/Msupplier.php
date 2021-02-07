<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Msupplier extends CI_Model 
{

	// fungsi ambil supplier
	function ambil_supplier($id_supplier) 
	{
		$this->db->where('id_supplier', $id_supplier);
		$ambil = $this->db->get('supplier');
		$data = $ambil->row_array();
		return $data;
	}

	// fungsi menampilkan supplier
	function tampil_supplier() 
	{
		$this->db->order_by('kode_supplier', 'desc');
		$ambil = $this->db->get('supplier');
		$data = $ambil->result_array(); // menampilkan data banyak
		return $data;
	}

	// fungsi tambah (disambung dengan controller supplier, fungsi tambah)
	function tambah_supplier($data)
	{
		$config['upload_path']    = './assets/images/logo_supplier/';
		$config['allowed_types']  = 'gif|jpg|png';
		$config['max_size']       = 2048;

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('logo_supplier'))
		{
			$this->db->insert('supplier',$data);
		}
		else
		{
			$data['logo_supplier']=$this->upload->data('file_name');
			$this->db->insert('supplier',$data);
		}
	}

	// fungsi ubah (disambung dengan controller ubah, fungsi ubah)
	function ubah_supplier($data,$id_supplier)
	{	
		// mengambil data supplier berdasarkan id_supplier
		$supplier = $this->ambil_supplier($id_supplier);

		$config['upload_path']    = './assets/images/logo_supplier/';
		$config['allowed_types']  = 'gif|jpg|png';
		$config['max_size']       = 2048;

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('logo_supplier'))
		{
			$this->db->where('id_supplier',$id_supplier);
			$this->db->update('supplier',$data);
		}
		else
		{
			$data['logo_supplier']=$this->upload->data('file_name');
			$foto = $supplier['logo_supplier'];
			if(file_exists("./assets/images/logo_supplier/$foto"))
			{
				unlink("./assets/images/logo_supplier/$foto");
			}

			$this->db->where('id_supplier',$id_supplier);
			$this->db->update('supplier',$data);
		}
    }

	// fungsi hapus (disambung dengan controller hapus, fungsi hapus)
    function hapus_supplier($id_supplier) 
    {
        $ambil = $this->ambil_supplier($id_supplier);
    	$foto = $ambil['logo_supplier'];
        unlink("./assets/images/logo_supplier/$foto");
        $this->db->where('id_supplier', $id_supplier);
        $this->db->delete('supplier');
    }

    function kode_otomatis()
	{
		$this->db->select('LEFT(supplier.kode_supplier,2) as kode', FALSE);
		$this->db->order_by('kode','DESC');    
		$this->db->limit(1);    
		$query = $this->db->get('supplier');  //cek dulu apakah ada sudah ada kode di tabel.    
		if($query->num_rows() <> 0)
		{      
			   //cek kode jika telah tersedia    
			$data = $query->row();      
			$kode = intval($data->kode) + 1; 
		}
		else
		{      
			$kode = 1;  
			   //cek jika kode belum terdapat pada table
		}

		$no_urut = str_pad($kode, 2, "0", STR_PAD_LEFT);
		$bulan = date('m');
		$tahun = substr(date('Y'), 2, 4);
		$kodetampil = $no_urut."/SUP/".$bulan."/".$tahun;  //format kode
		return $kodetampil;  
	}

}
?>