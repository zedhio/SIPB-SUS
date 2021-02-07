<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mbon extends CI_Model 
{

	// fungsi menampilkan bon
	function tampil_bon_user() 
	{
		$this->db->join('production_order', 'bon.id_po = production_order.id_po');
		$this->db->join('buyer', 'production_order.id_buyer = buyer.id_buyer');
		$this->db->join('style_glove', 'production_order.id_style_glove = style_glove.id_style_glove');
		$this->db->join('kalkulasi_bon', 'bon.id_bon = kalkulasi_bon.id_bon');
		$this->db->join('total_bon', 'bon.id_bon = total_bon.id_bon');
		$ambil = $this->db->get('bon');
		$data = $ambil->result_array(); // menampilkan data banyak
		
		return $data;
	}


	function tampil_bon_validasi() 
	{
		$this->db->join('production_order', 'bon.id_po = production_order.id_po');
		$this->db->join('buyer', 'production_order.id_buyer = buyer.id_buyer');
		$this->db->join('style_glove', 'production_order.id_style_glove = style_glove.id_style_glove');
		$this->db->order_by('id_bon', 'DESC');
		$ambil = $this->db->get('bon');
		$data = $ambil->result_array();

		$semua = array();
		foreach ($data as $key => $value) {

			$this->db->where('id_bon', $value['id_bon']);
			$ambil1 = $this->db->get('kalkulasi_bon');
			$data1 = $ambil1->result_array();			

			$hasil = array();
			foreach ($data1 as $no => $isi) {
				$this->db->where('id_ppic', $isi['nama_barang']);
				$ambil3 = $this->db->get('ppic');
				$data3 = $ambil3->row_array();
				$isi['barang'] = $data3;

				$hasil[] = $isi;

			}

			$value['kalkulasi_bon'] = $hasil;

			$semua[] = $value;
		}
		
		return $semua;
	}

	function ubah_ttd_bon($id_bon)
	{
		$data['konfirmasi_ttd']="Valid";
		$this->db->where('id_bon', $id_bon);
		$this->db->update('bon', $data);
	}


	function cari_bon($cari) 
	{
		$tgl_awal = $cari['tgl_awal'];
		$tgl_akhir = $cari['tgl_akhir'];

		$ambil = $this->db->query("SELECT bon.id_bon, no_bon, tgl_dibuat, konfirmasi_ttd, nama_po, nama_buyer, nama_style FROM bon JOIN production_order ON bon.id_po = production_order.id_po JOIN buyer ON buyer.id_buyer = production_order.id_buyer JOIN style_glove ON style_glove.id_style_glove = production_order.id_style_glove WHERE tgl_dibuat BETWEEN '$tgl_awal' AND '$tgl_akhir'");
		$data = $ambil->result_array();

		$semua = array();
		foreach ($data as $key => $value) {

			$this->db->where('id_bon', $value['id_bon']);
			$ambil1 = $this->db->get('kalkulasi_bon');
			$data1 = $ambil1->result_array();			

			$hasil = array();
			foreach ($data1 as $no => $isi) {
				$this->db->where('id_ppic', $isi['nama_barang']);
				$ambil3 = $this->db->get('ppic');
				$data3 = $ambil3->row_array();
				$isi['barang'] = $data3;

				$hasil[] = $isi;

			}

			$value['kalkulasi_bon'] = $hasil;

			$semua[] = $value;
		}
		
		return $semua;
	}

	function tambah_bon($bon, $barang)
	{
		$this->db->insert('bon', $bon);

		$id_bon['id_bon'] = $this->db->insert_id('bon');

		foreach ($barang as $key => $value)
		{
			$data['id_bon'] = $id_bon['id_bon'];
			$data['nama_barang'] = $value['nama_barang'];
			$data['qty_bon'] = $value['qty_bon'];
			$data['remaks'] = $value['remaks'];

		// memasukkan nilai array variabel data ke tabel kalkulasi_sjm
			$this->db->insert('kalkulasi_bon', $data);
		}
	}

	function ambil_bon($id_bon)
	{
		$this->db->join('production_order', 'bon.id_po = production_order.id_po', 'left');
		$this->db->join('buyer', 'production_order.id_buyer = buyer.id_buyer', 'left');
		$this->db->join('style_glove', 'production_order.id_style_glove = style_glove.id_style_glove', 'left');
		$this->db->where('id_bon', $id_bon);
		$ambil = $this->db->get('bon');
		$data = $ambil->row_array();
		return $data;
	}

	function ambil_kalkulasi($id_bon)
	{
		$this->db->where('id_bon', $id_bon);
		$ambil = $this->db->get('kalkulasi_bon');
		$data = $ambil->result_array();
		
		$semua = array();
		foreach ($data as $key => $value) {
			$this->db->join('barang', 'ppic.nama_barang = barang.nama_barang', 'left');
			$this->db->join('jenis', 'barang.id_jenis = jenis.id_jenis', 'left');
			$this->db->join('sub_jenis', 'barang.id_sub_jenis = sub_jenis.id_sub_jenis', 'left');
			$this->db->join('satuan', 'barang.id_satuan = satuan.id_satuan', 'left');
			$this->db->where('id_ppic', $value['nama_barang']);
			$ambil1 = $this->db->get('ppic');
			$data1 = $ambil1->result_array();
			$value['barang'] = $data1;

			$semua[] = $value;
		}

		return $semua;
	}

	function detail_kalkulasi($id_bon)
	{
		$this->db->where('id_kalkulasi_bon', $id_bon);
		$ambil = $this->db->get('kalkulasi_bon');
		$data = $ambil->result_array();

		$semua = array();
		foreach ($data as $key => $value) {
			$this->db->join('barang', 'ppic.nama_barang = barang.nama_barang', 'left');
			$this->db->join('jenis', 'barang.id_jenis = jenis.id_jenis', 'left');
			$this->db->join('sub_jenis', 'barang.id_sub_jenis = sub_jenis.id_sub_jenis', 'left');
			$this->db->join('satuan', 'barang.id_satuan = satuan.id_satuan', 'left');
			$this->db->where('id_ppic', $value['nama_barang']);
			$ambil1 = $this->db->get('ppic');
			$data1 = $ambil1->result_array();
			$value['barang'] = $data1;

			$semua[] = $value;
		}

		return $semua;
	}

	function ubah_bon($data,$bon)
	{
		$this->db->where('id_bon', $bon);
		$this->db->update('bon', $data);		
	}

	function ubah_kalkulasi_bon($inputan,$id_kalkulasi_bon,$id_bon)
	{
		$this->db->where('id_kalkulasi_bon', $id_kalkulasi_bon);
		$this->db->update('kalkulasi_bon', $inputan);

		$data_kalkulasi = $this->ambil_kalkulasi($id_bon);
		$total_bon = 0;
		foreach ($data_kalkulasi as $key => $value)
		{
			$total_bon+=$value['qty_bon'];
		}

		$hasil['qty_total'] = $total_bon;

		$this->db->where('id_bon',$id_bon);
		$this->db->update('total_bon', $hasil);
	}

	function hapus_bon($id_bon)
	{
		$this->db->where('id_bon', $id_bon);
		$this->db->delete('bon');

		$this->db->where('id_bon', $id_bon);
		$this->db->delete('kalkulasi_bon');
	}

	function kode_otomatis()
	{
		$this->db->select('LEFT(bon.no_bon,2) as kode', FALSE);
		$this->db->order_by('kode','DESC');    
		$this->db->limit(1);    
		$query = $this->db->get('bon');  //cek dulu apakah ada sudah ada kode di tabel.    
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
		$kodetampil = $no_urut."/BON/".$bulan."/".$tahun;  //format kode
		return $kodetampil;  
	}

}
?>