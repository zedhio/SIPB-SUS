<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mkaryawan extends CI_Model 
{

	// -------------------- Model untuk satuan karyawan -------------------- //

	// fungsi menampilkan barang
	function tampil_karyawan() 
	{
		$this->db->order_by('nik', 'desc');
		$this->db->join('bagian', 'karyawan.id_bagian = bagian.id_bagian', 'left');
		$this->db->join('jabatan', 'karyawan.id_jabatan = jabatan.id_jabatan', 'left');
		$ambil = $this->db->get('karyawan');
		$data = $ambil->result_array(); // menampilkan data banyak
		return $data;
	}

	// fungsi ambil barang
	function ambil_karyawan($id_karyawan) 
	{
		$this->db->join('bagian', 'karyawan.id_bagian = bagian.id_bagian', 'left');
		$this->db->join('jabatan', 'karyawan.id_jabatan = jabatan.id_jabatan', 'left');
		$this->db->where('id_karyawan', $id_karyawan);
		$ambil = $this->db->get('karyawan');
		$data = $ambil->row_array();
		return $data;
	}

	// fungsi tambah barang
	function tambah_karyawan($data) 
	{
		$config['upload_path']    = './assets/images/foto_karyawan/';
		$config['allowed_types']  = 'gif|jpg|png';
		$config['max_size']       = 2048;

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('foto_karyawan'))
		{
			$this->db->insert('karyawan',$data);
		}
		else
		{
			$data['foto_karyawan'] = $this->upload->data('file_name');
			$this->db->insert('karyawan',$data);
		}
	}

	// fungsi ubah barang
	function ubah_karyawan($data,$id_karyawan) 
	{
		// mengmabil data barang berdasarkan id_barang
		$karyawan = $this->ambil_karyawan($id_karyawan);

		$config['upload_path']    = './assets/images/foto_karyawan/';
		$config['allowed_types']  = 'gif|jpg|png';
		$config['max_size']       = 2048;

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('foto_karyawan'))
		{
			$this->db->where('id_karyawan',$id_karyawan);
			$this->db->update('karyawan',$data);
		}
		else
		{
			$data['foto_karyawan']=$this->upload->data('file_name');
			$foto = $karyawan['foto_karyawan'];
			if(file_exists("./assets/images/foto_karyawan/$foto"))
			{
				unlink("./assets/images/foto_karyawan/$foto");
			}

			$this->db->where('id_karyawan',$id_karyawan);
			$this->db->update('karyawan',$data);
		}
	}
	
	// fungsi hapus (disambung dengan controller barang, fungsi hapus)
	function hapus_karyawan($id_karyawan) 
	{
		$ambil = $this->ambil_karyawan($id_karyawan);
    	$foto = $ambil['foto_karyawan'];
        unlink("./assets/images/foto_karyawan/$foto");
		$this->db->where('id_karyawan', $id_karyawan);
		$this->db->delete('karyawan');
	}

	function kode_otomatis()
	{
		$this->db->select('RIGHT(karyawan.nik,2) as kode', FALSE);
		$this->db->order_by('kode','DESC');    
		$this->db->limit(1);    
		$query = $this->db->get('karyawan');  //cek dulu apakah ada sudah ada kode di tabel.    
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
		$tanggal = date('d');
		$bulan = date('m');
		$tahun = substr(date('Y'), 2, 4);
		$kodetampil = $tanggal.$bulan.$tahun.$no_urut;  //format kode
		return $kodetampil;  
	}

	// -------------------- Akhir model untuk karyawan -------------------- //

	// -------------------- Model untuk bagian karyawan -------------------- //	

	// fungsi menampilkan jabatan
	function tampil_bagian() 
	{
		$this->db->order_by('id_bagian', 'desc');
		$ambil = $this->db->get('bagian');
		$data = $ambil->result_array(); // menampilkan data banyak
		return $data;
	}

	// fungsi mengambil data jabatan (disambung dengan controller jabatan, fungsi ambil)
	function ambil_bagian($id_bagian)
	{
		$this->db->where('id_bagian', $id_bagian);
		$ambil = $this->db->get('bagian'); 
		$data = $ambil->row_array(); // mengambil data hanya 1 row record dari table
		return $data;
	}

	// fungsi tambah (disambung dengan controller satuan, fungsi tambah)
	function tambah_bagian($id_bagian) 
	{
		$this->db->insert('bagian', $id_bagian);
	}

	// fungsi ubah (disambung dengan controller ubah, fungsi ubah)	
	function ubah_bagian($ubah,$id_bagian) 
	{
		$this->db->where('id_bagian', $id_bagian);
		$this->db->update('bagian', $ubah);
	} 

	// fungsi hapus (disambung dengan controller hapus, fungsi hapus)
	function hapus_bagian($id_bagian) 
	{
		$this->db->where('id_bagian', $id_bagian);
		$this->db->delete('bagian');
	}

	// -------------------- Akhir model untuk bagian karyawan -------------------- //

	// -------------------- Model untuk jabatan karyawan -------------------- //

	// fungsi menampilkan jabatan
	function tampil_jabatan() 
	{
		$this->db->order_by('id_jabatan', 'desc');
		$ambil = $this->db->get('jabatan');
		$data = $ambil->result_array(); // menampilkan data banyak
		return $data;
	}

	// fungsi mengambil data jabatan (disambung dengan controller jabatan, fungsi ambil)
	function ambil_jabatan($id_jabatan)
	{
		$this->db->where('id_jabatan', $id_jabatan);
		$ambil=$this->db->get('jabatan'); 
		$data = $ambil->row_array(); // mengambil data hanya 1 row record dari table
		return $data;
	}

	// fungsi tambah (disambung dengan controller satuan, fungsi tambah)
	function tambah_jabatan($id_jabatan) 
	{
		$this->db->insert('jabatan', $id_jabatan);
	}

	// fungsi ubah (disambung dengan controller ubah, fungsi ubah)	
	function ubah_jabatan($ubah,$id_jabatan) 
	{
		$this->db->where('id_jabatan', $id_jabatan);
		$this->db->update('jabatan', $ubah);
	} 

	// fungsi hapus (disambung dengan controller hapus, fungsi hapus)
	function hapus_jabatan($id_jabatan) 
	{
		$this->db->where('id_jabatan', $id_jabatan);
		$this->db->delete('jabatan');
	}

	// -------------------- Akhir model untuk jabatan karyawan -------------------- //	
}

?>