<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mreject_barang_produksi extends CI_Model 
{
	function tampil_reject()
	{
		$this->db->join('production_order', 'reject_barang_produksi.id_po = production_order.id_po', 'left');
		$this->db->join('buyer', 'production_order.id_buyer = buyer.id_buyer', 'left');
		$this->db->join('style_glove', 'production_order.id_style_glove = style_glove.id_style_glove', 'left');
		$ambil = $this->db->get('reject_barang_produksi');
		$data = $ambil->result_array();
		return $data;
	}

	function ambil_reject($id_reject)
	{
		$this->db->join('barang', 'reject_barang_produksi.nama_barang = barang.nama_barang', 'left');
		$this->db->join('jenis', 'barang.id_jenis = jenis.id_jenis', 'left');
		$this->db->join('sub_jenis', 'barang.id_sub_jenis = sub_jenis.id_sub_jenis', 'left');
		$this->db->join('satuan', 'barang.id_satuan = satuan.id_satuan', 'left');
		$this->db->join('production_order', 'reject_barang_produksi.id_po = production_order.id_po', 'left');
		$this->db->join('buyer', 'production_order.id_buyer = buyer.id_buyer', 'left');
		$this->db->join('style_glove', 'production_order.id_style_glove = style_glove.id_style_glove', 'left');
		$this->db->where('id_reject_barang_produksi', $id_reject);
		$ambil = $this->db->get('reject_barang_produksi');
		$data = $ambil->row_array();
		return $data;
	}

	function ubah_reject($inputan, $id_reject)
	{
		$this->db->where('id_reject_barang_produksi', $id_reject);
		$this->db->update('reject_barang_produksi', $inputan);
	}

	function tampil_po()
	{	
		// $this->db->join('bon', 'production_order.id_po = bon.id_po', 'left');
		$this->db->order_by("tgl_order", "desc");
		$ambil = $this->db->get('production_order');
		$data = $ambil->result_array();

		$semua = array();
		foreach ($data as $key => $value) {
			
			$this->db->where('id_po', $value['id_po']);
			$this->db->where('status_pengajuan', "Disetujui");
			$ambil1 = $this->db->get('validasi_po');
			$data1 = $ambil1->result_array();
			$value['count'] = count($data1);			

			$this->db->where('id_po', $value['id_po']);
			$ambil1 = $this->db->get('bon');
			$data1 = $ambil1->result_array();
			$value['bon'] = $data1;

			$semua[] = $value;
		}

		return $semua;
	}


	function tampil_barang($id_po) 
	{
		$this->db->where('id_po', $id_po);
		$this->db->order_by('id_ppic', 'desc');
		$ambil = $this->db->get('ppic');
		$data = $ambil->result_array();
		
		return $data;
	}	

	function hapus_reject($id_reject)
	{
		$this->db->where('id_reject_barang_produksi', $id_reject);
		$this->db->delete('reject_barang_produksi');
	}

	function ambil_po($id_po) 
	{
		$this->db->join('buyer', 'production_order.id_buyer = buyer.id_buyer', 'left');
		$this->db->join('style_glove', 'production_order.id_style_glove = style_glove.id_style_glove', 'left');
		$this->db->join('bon', 'production_order.id_po = bon.id_po', 'left');
		$this->db->where('production_order.id_po', $id_po);
		$ambil1 = $this->db->get('production_order');
		$data1 = $ambil1->result_array();

		$semua = array();
		foreach ($data1 as $key => $value)
		{			
			$this->db->where('id_bon', $value['id_bon']);
			$ambil2 = $this->db->get('kalkulasi_bon');
			$data2 = $ambil2->result_array();

			$hasil = array();
			foreach ($data2 as $no => $isi) {
				$this->db->join('barang', 'ppic.nama_barang = barang.nama_barang', 'left');
				$this->db->join('jenis', 'barang.id_jenis = jenis.id_jenis', 'left');
				$this->db->join('sub_jenis', 'barang.id_sub_jenis = sub_jenis.id_sub_jenis', 'left');
				$this->db->join('satuan', 'barang.id_satuan = satuan.id_satuan', 'left');
				$this->db->where('id_ppic', $isi['nama_barang']);
				$ambil3 = $this->db->get('ppic');
				$data3 = $ambil3->result_array();
				$isi['barang'] = $data3;

				$hasil[] = $isi;
			}

			$value['kalkulasi'] = $hasil;

			$semua[] = $value;
		}

		return $semua;
	}	

	function tambah_reject($inputan)
	{
		$this->db->insert('reject_barang_produksi', $inputan);
	}

	function kode_otomatis()
	{
		$this->db->select('LEFT(reject_barang_produksi.no_reject_barang_produksi,3) as kode', FALSE);
		$this->db->order_by('kode','DESC');    
		$this->db->limit(1);    
		$query = $this->db->get('reject_barang_produksi');  //cek dulu apakah ada sudah ada kode di tabel.    
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
		$kodetampil = $no_urut."/Rjc/".$bulan."/".$tahun;  //format kode
		return $kodetampil;  
	}

	function cari_reject($cari) 
	{
		$tgl_awal = $cari['tgl_awal'];
		$tgl_akhir = $cari['tgl_akhir'];

		$ambil = $this->db->query("SELECT id_reject_barang_produksi, no_reject_barang_produksi, tgl_reject, nama_po, nama_buyer, nama_style, nama_barang, qty_reject FROM reject_barang_produksi JOIN production_order ON reject_barang_produksi.id_po = production_order.id_po JOIN buyer ON production_order.id_buyer = buyer.id_buyer JOIN style_glove ON production_order.id_style_glove = style_glove.id_style_glove WHERE tgl_reject BETWEEN '$tgl_awal' AND '$tgl_akhir'");
		$data = $ambil->result_array();
		
		return $data;

	}

}
?>