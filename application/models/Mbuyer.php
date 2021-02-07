<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mbuyer extends CI_Model 
{

	// fungsi ambil buyer
	function ambil_buyer($id_buyer) 
	{
		$this->db->where('id_buyer', $id_buyer);
		$ambil=$this->db->get('buyer');
		$data=$ambil->row_array();
		return $data;
	}

	function tampil_buyer() 
	{
		$this->db->order_by('kode_buyer', 'desc');
		$ambil = $this->db->get('buyer');
		$data = $ambil->result_array(); // menampilkan data banyak
		return $data;
	}

	// fungsi tambah (disambung dengan controller supplier, fungsi tambah)
	function tambah_buyer($data)
	{
		$config['upload_path']    = './assets/images/logo_buyer/';
		$config['allowed_types']  = 'gif|jpg|png';
		$config['max_size']       = 2048;

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('logo_buyer'))
		{
			$this->db->insert('buyer',$data);
		}
		else
		{
			$data['logo_buyer'] = $this->upload->data('file_name');
			$this->db->insert('buyer',$data);
		}
	}

	// fungsi ubah (disambung dengan controller ubah, fungsi ubah)
	function ubah_buyer($data,$id_buyer)
	{	
		// mengambil data supplier berdasarkan id_supplier
		$buyer = $this->ambil_buyer($id_buyer);

		$config['upload_path']    = './assets/images/logo_buyer/';
		$config['allowed_types']  = 'gif|jpg|png';
		$config['max_size']       = 2048;

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('logo_buyer'))
		{
			$this->db->where('id_buyer',$id_buyer);
			$this->db->update('buyer',$data);
		}
		else
		{
			$data['logo_buyer'] = $this->upload->data('file_name');
			$foto = $buyer['logo_buyer'];
			if(file_exists("./assets/images/logo_buyer/$foto"))
			{
				unlink("./assets/images/logo_buyer/$foto");
			}

			$this->db->where('id_buyer',$id_buyer);
			$this->db->update('buyer',$data);
		}
    }

	// fungsi hapus (disambung dengan controller hapus, fungsi hapus)
    function hapus_buyer($id_buyer) 
    {
    	$ambil = $this->ambil_buyer($id_buyer);
    	$foto = $ambil['logo_buyer'];
        unlink("./assets/images/logo_buyer/$foto");
        $this->db->where('id_buyer', $id_buyer);
        $this->db->delete('buyer');
    }

    function kode_otomatis()
	{
		$this->db->select('LEFT(buyer.kode_buyer,2) as kode', FALSE);
		$this->db->order_by('kode','DESC');    
		$this->db->limit(1);    
		$query = $this->db->get('buyer');  //cek dulu apakah ada sudah ada kode di tabel.    
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
		$kodetampil = $no_urut."/BUY/".$bulan."/".$tahun;  //format kode
		return $kodetampil;  
	}

	// ----------------- Model Untuk Style Glove - Buyer -----------------

	function tampil_style() 
	{
		$this->db->order_by('id_style_glove', 'desc');
		$ambil = $this->db->get('style_glove');
		$data = $ambil->result_array(); // menampilkan data banyak
		return $data;
	}


	function ambil_style($id_style_glove) 
	{
		$this->db->where('id_style_glove', $id_style_glove);
		$ambil = $this->db->get('style_glove');
		$data = $ambil->row_array();
		return $data;
	}

	function tambah_style($data)
	{
		$this->db->insert('style_glove', $data);
	}

	function ubah_style($ubah, $id_style_glove) 
	{
		$this->db->where('id_style_glove', $id_style_glove);
		$this->db->update('style_glove', $ubah);
	}

    function hapus_style($id_style_glove) 
    {
        $this->db->where('id_style_glove', $id_style_glove);
        $this->db->delete('style_glove');
    }

    // ----------------- Akhir model Untuk Style GLove - Buyer -----------------

}
?>