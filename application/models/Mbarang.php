<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mbarang extends CI_Model 
{

	// -------------------- Model untuk barang -------------------- //

	function tambah_stok($data,$id_barang)
	{
		$this->db->where('id_barang', $id_barang);
		$this->db->update('barang', $data);
	}

	function kurang_stok(){
		$hasil = $this->db->query("SELECT COUNT(*) as total FROM barang WHERE stok < 50.00")->row_array();
		return $hasil;
	}

	function barang_kurang(){
		$hasil = $this->db->query("SELECT * FROM barang WHERE stok < 50.00")->result_array();
		return $hasil;
	}

	// Controller surat jalan masuk fungsi select (Menampilkan Data Per id)
	function ambil_barang_by_nama($nama_barang) 
	{
		$this->db->join('jenis', 'barang.id_jenis = jenis.id_jenis', 'left');
		$this->db->join('sub_jenis', 'barang.id_sub_jenis = sub_jenis.id_sub_jenis', 'left');
		// $this->db->join('merek', 'barang.id_merek = merek.id_merek', 'left');
		$this->db->join('satuan', 'barang.id_satuan = satuan.id_satuan', 'left');
		$this->db->where('nama_barang', $nama_barang);
		$ambil = $this->db->get('barang');
		$data = $ambil->row_array();
		return $data;
	}

	// fungsi menampilkan barang
	function tampil_barang() 
	{
		$this->db->join('jenis', 'barang.id_jenis = jenis.id_jenis', 'left');
		$this->db->join('sub_jenis', 'barang.id_sub_jenis = sub_jenis.id_sub_jenis', 'left');
		// $this->db->join('merek', 'barang.id_merek = merek.id_merek', 'left');
		$this->db->join('satuan', 'barang.id_satuan = satuan.id_satuan', 'left');
		$this->db->order_by('kode_barang', 'DESC');
		$ambil = $this->db->get('barang');
		$data = $ambil->result_array(); // menampilkan data banyak
		return $data;
	}

	function tampil_barang_sjm()
	{
		// menyimpan array ke variabel data
		$data = array();

		// kondisi jika ada session barang maka
		if (isset($_SESSION['barang'])) 
		{
			// perulangan untuk mendapatkan nilai dari value barang
			foreach ($_SESSION['barang'] as $key => $value)
			{
				// berdasarkan field id_barang pada  nilai nama barang
				$this->db->where('nama_barang', $value['nama_barang']);
				$ambil = $this->db->get('barang');
				$barang = $ambil->row_array();
				$value['nama_barang'] = $barang['nama_barang'];
				$data[] = $value;
			}	
		}

		return $data;
	}

	function tampil_barang_bon()
	{
		// menyimpan array ke variabel data
		$data = array();

		// kondisi jika ada session barang maka
		if (isset($_SESSION['barang'])) 
		{
			// perulangan untuk mendapatkan nilai dari value barang
			foreach ($_SESSION['barang'] as $key => $value)
			{
				// berdasarkan field id_barang pada  nilai nama barang
				$this->db->where('id_ppic', $value['nama_barang']);
				$ambil = $this->db->get('ppic');
				$barang = $ambil->row_array();
				$value['nama_barang'] = $barang['nama_barang'];

				$data[] = $value;

 			}
		}

		return $data;
	}

	// fungsi ambil barang
	function ambil_barang($id_barang) 
	{
		$this->db->join('jenis', 'barang.id_jenis = jenis.id_jenis', 'left');
		$this->db->join('sub_jenis', 'barang.id_sub_jenis = sub_jenis.id_sub_jenis', 'left');
		// $this->db->join('merek', 'barang.id_merek = merek.id_merek', 'left');
		$this->db->join('satuan', 'barang.id_satuan = satuan.id_satuan', 'left');
		$this->db->where('id_barang', $id_barang);
		$ambil = $this->db->get('barang');
		$data = $ambil->row_array();
		return $data;
	}

	// fungsi tambah barang
	function tambah_barang($inputan) 
	{
		$config['upload_path']    = './assets/images/foto_barang/';
		$config['allowed_types']  = 'gif|jpg|png|jpeg';
		$config['max_size']       = 2048;

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('foto_barang'))
		{
			$data['kode_barang'] = $inputan['kode_barang'];
			$data['id_jenis'] = $inputan['id_jenis'];
			$data['id_sub_jenis'] = $inputan['id_sub_jenis'];
			$data['nama_barang'] = $inputan['nama_barang'];
			$data['warna'] = $inputan['warna'];
			$data['stok'] = $inputan['stok'];
			$data['id_satuan'] = $inputan['id_satuan'];
			$data['keterangan_barang'] = $inputan['keterangan_barang'];

			$this->db->insert('barang',$data);
		}
		else
		{
			$data['kode_barang'] = $inputan['kode_barang'];
			$data['id_jenis'] = $inputan['id_jenis'];
			$data['id_sub_jenis'] = $inputan['id_sub_jenis'];
			$data['nama_barang'] = $inputan['nama_barang'];
			$data['warna'] = $inputan['warna'];
			$data['stok'] = $inputan['stok'];
			$data['id_satuan'] = $inputan['id_satuan'];
			$data['foto_barang'] = $this->upload->data('file_name');
			$data['keterangan_barang'] = $inputan['keterangan_barang'];
			
			$this->db->insert('barang',$data);
		}
	}	

	// fungsi ubah barang
	function ubah_barang($inputan,$id_barang) 
	{
		// mengmabil data barang berdasarkan id_barang
		$barang = $this->ambil_barang($id_barang);

		$config['upload_path']    = './assets/images/foto_barang/';
		$config['allowed_types']  = 'gif|jpg|png|jpeg';
		$config['max_size']       = 2048;

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('foto_barang'))
		{
			$data['kode_barang'] = $inputan['kode_barang'];
			$data['id_jenis'] = $inputan['id_jenis'];
			$data['id_sub_jenis'] = $inputan['id_sub_jenis'];
			$data['nama_barang'] = $inputan['nama_barang'];
			$data['warna'] = $inputan['warna'];
			$data['stok'] = $inputan['stok'];
			$data['id_satuan'] = $inputan['id_satuan'];
			$data['keterangan_barang'] = $inputan['keterangan_barang'];			

			$this->db->where('id_barang',$id_barang);
			$this->db->update('barang',$data);
		}
		else
		{
			$data['foto_barang'] = $this->upload->data('file_name');
			$foto = $barang['foto_barang'];
			if(file_exists("./assets/images/foto_barang/$foto"))
			{
				unlink("./assets/images/foto_barang/$foto");
			}

			$data['kode_barang'] = $inputan['kode_barang'];
			$data['id_jenis'] = $inputan['id_jenis'];
			$data['id_sub_jenis'] = $inputan['id_sub_jenis'];
			$data['nama_barang'] = $inputan['nama_barang'];
			$data['warna'] = $inputan['warna'];
			$data['stok'] = $inputan['stok'];
			$data['id_satuan'] = $inputan['id_satuan'];
			$data['keterangan_barang'] = $inputan['keterangan_barang'];

			$this->db->where('id_barang',$id_barang);
			$this->db->update('barang',$data);
		}
	}

	// fungsi hapus (disambung dengan controller barang, fungsi hapus)
	function hapus_barang($id_barang) 
	{
		$ambil = $this->ambil_barang($id_barang);
    	$foto = $ambil['foto_barang'];
        unlink("./assets/images/foto_barang/$foto");
		$this->db->where('id_barang', $id_barang);
		$this->db->delete('barang');
	}

	function kode_otomatis()
	{
		$this->db->select('LEFT(barang.kode_barang,2) as kode', FALSE);
		$this->db->order_by('kode','DESC');    
		$this->db->limit(1);    
		$query = $this->db->get('barang');  //cek dulu apakah ada sudah ada kode di tabel.    
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
		$kodetampil = $no_urut."/BAR/GD1/".$bulan."/".$tahun;  //format kode
		return $kodetampil;  
	}

	// -------------------- Akhir model untuk barang -------------------- //


	// -------------------- Model untuk jenis barang -------------------- //

	// fungsi menampilkan jenis
	function tampil_jenis() 
	{
		$this->db->order_by('id_jenis', 'desc');
		$ambil = $this->db->get('jenis');
		$data = $ambil->result_array(); // menampilkan data banyak
		return $data;
	}

	// fungsi mengambil data jenis (disambung dengan controller jenis, fungsi ambil)
	function ambil_jenis($id_jenis)
	{
		$this->db->where('id_jenis', $id_jenis);
		$ambil = $this->db->get('jenis'); 
		$data = $ambil->row_array(); // mengambil data hanya 1 row record dari table
		return $data;
	}

	function ambil_jenis_subjenis($id_jenis)
	{
		$this->db->where('id_jenis', $id_jenis);
		$ambil = $this->db->get('sub_jenis'); 
		$data = $ambil->result_array(); // mengambil data hanya 1 row record dari table
		return $data;
	}

	// fungsi tambah (disambung dengan controller jenis, fungsi tambah)
	function tambah_jenis($jenis) 
	{
		$this->db->insert('jenis', $jenis);
	}

	// fungsi ubah (disambung dengan controller ubah, fungsi ubah)	
	function ubah_jenis($ubah,$id_jenis) 
	{
		$this->db->where('id_jenis', $id_jenis);
		$this->db->update('jenis', $ubah);
	} 

	// fungsi hapus (disambung dengan controller jenis, fungsi hapus)
	function hapus_jenis ($id_jenis) 
	{
		$this->db->where('id_jenis', $id_jenis);
		$this->db->delete('jenis');
	}

	// -------------------- Akhir model untuk Jenis Barang -------------------- //

	// -------------------- Model untuk sub jenis barang -------------------- //

	// fungsi menampilkan sub jenis
	function tampil_sub_jenis() 
	{
		$this->db->order_by('id_sub_jenis', 'desc');
		$ambil = $this->db->get('sub_jenis');
		$data = $ambil->result_array(); // menampilkan data banyak
		return $data;
	}

    // fungsi mengambil data sub jenis (disambung dengan controller sub jenis, fungsi ambil)
	function ambil_sub_jenis($id_sub_jenis)
	{
		$this->db->where('id_sub_jenis', $id_sub_jenis);
		$ambil = $this->db->get('sub_jenis'); 
		$data = $ambil->row_array(); // mengambil data hanya 1 row record dari table
		return $data;
	}

	// fungsi tambah (disambung dengan controller sub jenis, fungsi tambah)
	function tambah_sub_jenis($sub_jenis) 
	{
		$this->db->insert('sub_jenis', $sub_jenis);
	}

	// fungsi ubah (disambung dengan controller sub jenis, fungsi ubah)
	function ubah_sub_jenis($ubah,$id_sub_jenis) 
	{
		$this->db->where('id_sub_jenis', $id_sub_jenis);
		$this->db->update('sub_jenis', $ubah);
	} 	

	// fungsi hapus (disambung dengan controller sub jenis, fungsi hapus)
	function hapus_sub_jenis($id_sub_jenis) 
	{
		$this->db->where('id_sub_jenis', $id_sub_jenis);
		$this->db->delete('sub_jenis');
	}

	// -------------------- Akhir model untuk sub jenis Barang -------------------- //	

	// -------------------- Model untuk merek barang -------------------- //

	// fungsi menampilkan merek
	function tampil_merek() 
	{
		$ambil = $this->db->get('merek');
		$data = $ambil->result_array(); // menampilkan data banyak
		return $data;
	}

	// fungsi mengambil data merek (disambung dengan controller merek, fungsi ambil)
	function ambil_merek($id_merek)
	{
		$this->db->where('id_merek', $id_merek);
		$ambil = $this->db->get('merek'); 
		$data = $ambil->row_array(); // mengambil data hanya 1 row record dari table
		return $data;
	}

	// fungsi tambah (disambung dengan controller merek, fungsi tambah)
	function tambah_merek($merek) 
	{
		$this->db->insert('merek', $merek);
	}

	// fungsi ubah (disambung dengan controller merek, fungsi ubah)	
	function ubah_merek($ubah,$id_merek) 
	{
		$this->db->where('id_merek', $id_merek);
		$this->db->update('merek', $ubah);
	} 

	// fungsi hapus (disambung dengan controller merek, fungsi hapus)
	function hapus_merek ($id_merek) 
	{
		$this->db->where('id_merek', $id_merek);
		$this->db->delete('merek');
	}

	// -------------------- Akhir model untuk merek Barang -------------------- //

	// -------------------- Model untuk satuan Barang -------------------- //	

	// fungsi menampilkan satuan
	function tampil_satuan() 
	{
		$this->db->order_by('id_satuan', 'desc');
		$ambil = $this->db->get('satuan');
		$data = $ambil->result_array(); // menampilkan data banyak
		return $data;
	}

	// fungsi mengambil data satuan (disambung dengan controller satuan, fungsi ambil)
	function ambil_satuan($id_satuan)
	{
		$this->db->where('id_satuan', $id_satuan);
		$ambil = $this->db->get('satuan'); 
		$data = $ambil->row_array(); // mengambil data hanya 1 row record dari table
		return $data;
	}

	// fungsi tambah (disambung dengan controller satuan, fungsi tambah)
	function tambah_satuan($id_satuan) 
	{
		$this->db->insert('satuan', $id_satuan);
	}

	// fungsi ubah (disambung dengan controller ubah, fungsi ubah)	
	function ubah_satuan($ubah,$id_satuan) 
	{
		$this->db->where('id_satuan', $id_satuan);
		$this->db->update('satuan', $ubah);
	} 

	// fungsi hapus (disambung dengan controller hapus, fungsi hapus)
	function hapus_satuan($id_satuan) 
	{
		$this->db->where('id_satuan', $id_satuan);
		$this->db->delete('satuan');
	}

	// -------------------- Akhir model untuk satuan Barang -------------------- //	

}

?>