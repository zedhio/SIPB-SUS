<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mkartu_persediaan_barang extends CI_Model 
{

	function tampil_kpb() 
	{
		$this->db->join('barang', 'kartu_persediaan_barang.id_barang = barang.id_barang', 'left');
		$this->db->join('jenis', 'barang.id_jenis = jenis.id_jenis', 'left');
		$this->db->join('sub_jenis', 'barang.id_sub_jenis = sub_jenis.id_sub_jenis', 'left');
		$this->db->order_by('id_kpb', 'desc');
		$ambil = $this->db->get('kartu_persediaan_barang');
		$data = $ambil->result_array(); // menampilkan data banyak
		return $data;
	}

	function tampil_kpb_validasi() 
	{
		$this->db->join('barang', 'kartu_persediaan_barang.id_barang = barang.id_barang', 'left');
		$this->db->join('jenis', 'barang.id_jenis = jenis.id_jenis', 'left');
		$this->db->join('sub_jenis', 'barang.id_sub_jenis = sub_jenis.id_sub_jenis', 'left');
		$this->db->join('bukti_kpb', 'kartu_persediaan_barang.id_kpb = bukti_kpb.id_kpb', 'left');
		$this->db->join('kalkulasi_kpb', 'kartu_persediaan_barang.id_kpb = kalkulasi_kpb.id_kpb', 'left');
		$ambil = $this->db->get('kartu_persediaan_barang');
		$data = $ambil->result_array(); // menampilkan data banyak
		return $data;
	}

	function cari_rekap_kpb($cari, $id_kpb) 
	{
		$bulan = $cari['bulan'];
		$tahun = $cari['tahun'];

		$semua=array();

		$ambil = $this->db->query("SELECT tgl_masuk, no_bukti, keterangan, qty_masuk, qty_keluar, saldo FROM bukti_kpb WHERE MONTH(tgl_masuk) = '$bulan' AND YEAR(tgl_masuk) = '$tahun' AND id_kpb='$id_kpb'");
		// $this->db->where('id_kpb');
		$array = $ambil->result_array();

		return $array;
	}	

	function ambil_kpb($id_kpb)
	{
		$this->db->join('barang', 'kartu_persediaan_barang.id_barang = barang.id_barang', 'left');
		$this->db->join('jenis', 'barang.id_jenis = jenis.id_jenis', 'left');
		$this->db->join('sub_jenis', 'barang.id_sub_jenis = sub_jenis.id_sub_jenis', 'left');
		$this->db->join('satuan', 'barang.id_satuan = satuan.id_satuan', 'left');
		// $this->db->join('bukti_kpb', 'kartu_persediaan_barang.id_kpb = bukti_kpb.id_kpb', 'left');
		// $this->db->join('kalkulasi_kpb', 'kartu_persediaan_barang.id_kpb = kalkulasi_kpb.id_kpb', 'left');
		$this->db->where('id_kpb', $id_kpb);
		$ambil = $this->db->get('kartu_persediaan_barang');
		$data = $ambil->row_array();
		return $data;
	}

	function ambil_bukti_kpb($id_kpb)
	{
		$this->db->where('id_kpb', $id_kpb);
		$ambil = $this->db->get('bukti_kpb');
		$data = $ambil->result_array();
		return $data;
	}

	// Controller surat jalan masuk fungsi tambah dan tambah selanjutnya untuk memnambah data kartu persediaan barang
	function tambah_kpb($kpb1, $kpb2) 
	{

		// Memasukkan nilai array variabel kpb ke tabel kartu persediaan barang
		$this->db->insert('kartu_persediaan_barang', $kpb1);

		// mendapatkan id id_kpb dari tabel kartu persediaan barang ke field id kpb ditampung ke variabel kalkulasi_kpb
		$kalkulasi_kpb['id_kpb'] = $this->db->insert_id('kartu_persediaan_barang');

		$bukti_kpb['id_kpb'] = $kalkulasi_kpb['id_kpb'];
		$bukti_kpb['tgl_masuk'] = $kpb2['tgl_masuk'];
		$bukti_kpb['keterangan'] = $kpb2['keterangan'];
		$bukti_kpb['saldo'] = $kpb2['saldo'];

		// // memasukkan nilai array kalkulasi_kpb ke tabel kalkulasi_kpb 
		$this->db->insert('bukti_kpb', $bukti_kpb);

	}
	// Controller kartu persediaan barang fungsi tambah dan tambah selanjutnya untuk menambah data kartu persediaan barang

	function ubah_kpb($inputan,$id_bukti_kpb,$id_kpb)
	{
		foreach ($inputan as $key => $value)
		{
			$data['id_bukti_kpb'] = $id_bukti_kpb['id_bukti_kpb'];
			$data['tgl_masuk'] = $value['tgl_masuk'];
			$data['keterangan'] = $value['keterangan'];

			$this->db->where('id_bukti_kpb', $id_bukti_kpb['id_bukti_kpb']);
			$this->db->update('bukti_kpb', $data);	
		}

		// perulangan untuk mengambil nilai dari value qty_sjm untuk total sjm
		foreach ($inputan as $key => $value) {
			$saldo=$value['saldo'];
		}

		// field qty_total pada tabel total sjm 
		$kalkulasi_kpb['saldo'] = $saldo;

		$this->db->where('id_kalkulasi_kpb',$id_kpb);
		$this->db->update('kalkulasi_kpb', $kalkulasi_kpb);
	}
	// Controller kartu persediaan barang fungsi ubah untuk kalkulasi record kartu persediaan barang

	function kode_otomatis()
	{
		$this->db->select('RIGHT(kartu_persediaan_barang.no_kpb,3) as kode', FALSE);
		$this->db->order_by('kode','DESC');    
		$this->db->limit(1);    
		$query = $this->db->get('kartu_persediaan_barang');  //cek dulu apakah ada sudah ada kode di tabel.    
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

		$no_urut = str_pad($kode, 3, "0", STR_PAD_LEFT);
		$bulan = date('m');
		$tahun = substr(date('Y'), 2, 4);
		$kodetampil = "/KPB/".$no_urut;  //format kode
		return $kodetampil;  
	}

	function ubah_kpb_radio($id_kpb)
	{
		$this->db->join('kartu_persediaan_barang', 'bukti_kpb.id_kpb = kartu_persediaan_barang.id_kpb', 'left');
		$this->db->where('id_bukti_kpb', $id_kpb);
		$ambil = $this->db->get('bukti_kpb');
		$data = $ambil->row_array();
		return $data;
	}

	function cari_kpb($cari) 
	{
		$no_kpb = $cari['no_kpb'];

		$ambil = $this->db->query("SELECT id_kpb, no_kpb, ukuran, kode_barang, nama_barang, jenis, sub_jenis FROM kartu_persediaan_barang JOIN barang ON kartu_persediaan_barang.id_barang = barang.id_barang JOIN jenis ON barang.id_jenis = jenis.id_jenis JOIN sub_jenis ON barang.id_sub_jenis = sub_jenis.id_sub_jenis WHERE no_kpb LIKE '$no_kpb'");
		$array = $ambil->result_array();
		return $array;
	}

	function hapus_kpb($id_kpb)
	{
		//menghapus berdasarkan id_sjm dari tiga tabel
		$this->db->where('id_kpb', $id_kpb);
		$this->db->delete('kartu_persediaan_barang');

		$this->db->where('id_kpb', $id_kpb);
		$this->db->delete('bukti_kpb');
	}

}
?>