<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mlaporan extends CI_Model 
{
	
	// =============== Tampil validasi dari controller LPB Admin ==================
	function tampil_validasi()
	{
		$ambil = $this->db->get('validasi_lpb');
		$data = $ambil->result_array(); // menampilkan data banyak
		
		$semua = array();
		foreach ($data as $key => $value)
		{
			$this->db->where('id_lpb', $value['id_lpb']);
			$ambil_lpb = $this->db->get('validasi_lpb');
			$lpb = $ambil_lpb->row_array();

			if(empty($lpb['mengetahui']))
			{
				$value['mengetahui']="kosong";
			}
			else
			{
				$value['mengetahui']="ada";
			}

			$semua[] = $value;
		}

		return $semua;
	}

	function tampil_plb()
	{
		$this->db->order_by('no_lpb', 'desc');
		$this->db->join('surat_jalan_masuk', 'lpb.id_sjm = surat_jalan_masuk.id_sjm', 'left');
		$ambil = $this->db->get('lpb');
		$data = $ambil->result_array();
		$semua=array();
		foreach ($data as $key => $value)
		{
			$this->db->where('id_lpb', $value['id_lpb']);
			$ambil1 = $this->db->get('validasi_lpb');
			$data1 = $ambil1->row_array();
			$value['validasi']=$data1;

			$this->db->where('id_lpb', $value['id_lpb']);
			$ambil1 = $this->db->get('distribusi_lpb');
			$data1 = $ambil1->row_array();
			$value['distribusi']=$data1;			
			$semua[] = $value;
		}

		return $semua;
	}
	// =============== Tampil validasi dari controller LPB Admin ==================

	// =============== Membuat LPB dari controller Penerimaan Barang ==================
	function tambah_lpb($data)
	{
		$this->db->insert('lpb',$data);
	}
	// =============== Membuat LPB dari controller Penerimaan Barang ==================

	// === Memilih No.LPB pada select membuat lpb dari controller Penerimaan Barang ===
	function select_sjm()
	{
		$ambil = $this->db->query('SELECT * FROM surat_jalan_masuk ORDER BY id_sjm DESC');
		$data = $ambil->result_array();
		return $data;	
	}
	// === Memilih No.LPB pada select membuat lpb dari controller Penerimaan Barang ===

	// Fungsi pendukung untuk Modal Status Pengajuan approval dari controller LPB
	function status_persetujuan($id_lpb)
	{
		$this->db->join('lpb', 'validasi_lpb.id_lpb = lpb.id_lpb', 'left');
		$this->db->where('validasi_lpb.id_lpb', $id_lpb);
		$ambil = $this->db->get('validasi_lpb');
		$data = $ambil->row_array();
		return $data;	
	}
	// Fungsi pendukung untuk Modal Status Pengajuan approval dari controller LPB

	// ============================ lpb ==============================
	function tampil_lpb() 
	{
		$this->db->join('surat_jalan_masuk', 'lpb.no_sjm = surat_jalan_masuk.no_sjm', 'left');
		$ambil = $this->db->get('lpb');
		$data = $ambil->result_array(); // menampilkan data banyak
		return $data;
	}

	function hitung_lpb() 
	{
		$ambil = $this->db->get('lpb');
		$data = $ambil->result_array(); // menampilkan data banyak

		$semua = array();
		foreach ($data as $key => $value)
		{
			$this->db->where('tujuan', "Direktur");
			$this->db->where('id_lpb', $value['id_lpb']);
			$ambil1 = $this->db->get('distribusi_lpb');
			$data1 = $ambil1->result_array();
			$value['distribusi'] = count($data1);			
			$semua[] = $value;
		}

		return $semua;
	}

	function tampil_laporan() 
	{
		$this->db->join('surat_jalan_masuk', 'lpb.id_sjm = surat_jalan_masuk.id_sjm', 'left');
		$this->db->order_by('lpb.id_lpb', 'DESC');
		$ambil = $this->db->get('lpb');
		$data = $ambil->result_array(); // menampilkan data banyak

		$semua = array();
		foreach ($data as $key => $value)
		{
			$this->db->where('id_lpb', $value['id_lpb']);
			$ambil1 = $this->db->get('validasi_lpb');
			$data1 = $ambil1->result_array();
			$value['validasi']=$data1;

			$this->db->where('id_lpb', $value['id_lpb']);
			$ambil1 = $this->db->get('distribusi_lpb');
			$data1 = $ambil1->result_array();
			$value['distribusi']=$data1;			
			$semua[] = $value;
		}

		return $semua;
	}	

	function tampil_rekap_lpb()
	{
		$this->db->join('surat_jalan_masuk', 'lpb.id_sjm = surat_jalan_masuk.id_sjm', 'left');
		$this->db->join('supplier', 'surat_jalan_masuk.id_supplier = supplier.id_supplier', 'left');
		$this->db->join('kalkulasi_sjm', 'surat_jalan_masuk.id_sjm = kalkulasi_sjm.id_sjm', 'left');
		$this->db->join('total_sjm', 'surat_jalan_masuk.id_sjm = total_sjm.id_sjm', 'left');
		$this->db->join('validasi_lpb', 'lpb.id_lpb = validasi_lpb.id_lpb', 'left');
		$this->db->group_by("tgl_dibuat");
		$this->db->order_by("tgl_dibuat", "desc");
		$ambil = $this->db->get('lpb');
		$data = $ambil->result_array();
		foreach ($data as $key => $value)
		{
			$this->db->join('surat_jalan_masuk', 'kalkulasi_sjm.id_sjm = surat_jalan_masuk.id_sjm', 'left');
			$this->db->join('supplier', 'surat_jalan_masuk.id_supplier = supplier.id_supplier', 'left');
			$this->db->join('lpb', 'surat_jalan_masuk.id_sjm = lpb.id_sjm', 'left');
			$this->db->where('lpb.tgl_dibuat', $value['tgl_dibuat']);
			$ambil1 = $this->db->get('kalkulasi_sjm');
			$data1 = $ambil1->result_array();
			$value['validasi']=$data1;		
			$semua[] = $value;
		}

		return $semua;

	}

	function tampil_validasi_lpb()
	{
		$this->db->join('surat_jalan_masuk', 'lpb.id_sjm = surat_jalan_masuk.id_sjm', 'left');
		$this->db->join('validasi_lpb', 'lpb.id_lpb = validasi_lpb.id_lpb', 'left');
		$this->db->order_by("lpb.id_lpb", "desc");
		$ambil = $this->db->get('lpb');
		$data = $ambil->result_array(); // menampilkan data banyak
		
		// $semua = array();
		// foreach ($data as $key => $value)
		// {
		// 	$this->db->where('id_lpb', $value['id_lpb']);
		// 	$ambil_lpb = $this->db->get('validasi_lpb');
		// 	$lpb = $ambil_lpb->row_array();

		// 	if(empty($lpb['yang_meminta']))
		// 	{
		// 		$value['yang_meminta']="kosong";
		// 	}
		// 	else
		// 	{
		// 		$value['yang_meminta']="ada";
		// 	}

		// 	$semua[] = $value;
		// }

		return $data;
	}

	// function detail_konfirmasi($id_lpb)
	// {
	// 	$this->db->join('lpb', 'validasi_lpb.id_lpb = lpb.id_lpb', 'left');
	// 	$this->db->where('validasi_lpb.id_lpb', $id_lpb);
	// 	$ambil = $this->db->get('validasi_lpb');
	// 	$data = $ambil->row_array();
	// 	return $data;	
	// }

	function pengajuan_lpb($data) 
	{
		$data['tujuan'] = "Kepala Divisi Purchase Order";
		$this->db->insert('validasi_lpb',$data);

		$ambil = $this->db->get('validasi_lpb');
		$data = $ambil->result_array(); // menampilkan data banyak

		$semua = array();
		foreach ($data as $key => $value)
		{
			$this->db->where('id_lpb', $value['id_lpb']);
			$ambil_lpb = $this->db->get('lpb');
			$lpb = $ambil_lpb->row_array();

			if(empty($lpb))
			{
				$value['pengajuan']="kosong";
			}
			else
			{
				$value['pengajuan']="ada";
			}

			$semua[] = $value;
		}


		return $semua;
	}

	function konfirmasi_persetujuan($id_lpb, $inputan)
	{
		$this->db->where('id_lpb', $id_lpb);
		$this->db->update('validasi_lpb', $inputan);
	}

	function konfirmasi_persetujuan_tolak($id_lpb,$data)
	{
		$this->db->where('id_lpb', $id_lpb);
		$this->db->update('validasi_lpb', $data);
	}

	function ambil_lpb($id_lpb) 
	{
		$this->db->join('surat_jalan_masuk', 'lpb.id_sjm = surat_jalan_masuk.id_sjm', 'left');
		$this->db->join('supplier', 'surat_jalan_masuk.id_supplier = supplier.id_supplier', 'left');
		$this->db->where('id_lpb', $id_lpb);
		$ambil = $this->db->get('lpb');
		$data = $ambil->row_array();
		return $data;
	}

	function validasi_lpb($id_lpb)
	{
		$this->db->where('id_lpb', $id_lpb);
		$ambil = $this->db->get('validasi_lpb');
		$data = $ambil->row_array();
		return $data;	
	}

	function kirim_lpb($data)
	{

		foreach ($data['tujuan'] as $key => $value)
		{
			$hasil['asal'] = $data['asal'];
			$hasil['id_lpb'] = $data['id_lpb'];
			$hasil['tujuan'] = $value;
			$hasil['tgl_diterima'] = $data['tgl_diterima'];
			$this->db->insert('distribusi_lpb',$hasil);
		}
	}

	function kode_otomatis()
	{
		$this->db->select('LEFT(lpb.no_lpb,2) as kode', FALSE);
		$this->db->order_by('kode','DESC');    
		$this->db->limit(1);    
		$query = $this->db->get('lpb');  //cek dulu apakah ada sudah ada kode di tabel.    
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
		$romawi = array('', 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII',);
		$tahun = substr(date('Y'), 2, 4);
		$kodetampil = $no_urut."/SUS/".$romawi[date('n')]."/".$tahun;  //format kode
		return $kodetampil;  
	}

	function ubah_ttd_lpb($id_lpb)
	{
		$data['konfirmasi_ttd']="Valid";
		$this->db->where('id_lpb', $id_lpb);
		$this->db->update('lpb', $data);
	}

	function ambil_kalkulasi($id_lpb)
	{
		$this->db->join('barang', 'kalkulasi_sjm.nama_barang = barang.nama_barang', 'left');
		$this->db->join('jenis', 'barang.id_jenis = jenis.id_jenis', 'left');
		$this->db->join('sub_jenis', 'barang.id_sub_jenis = sub_jenis.id_sub_jenis', 'left');
		$this->db->join('satuan', 'barang.id_satuan = satuan.id_satuan', 'left');
		$this->db->join('total_sjm', 'kalkulasi_sjm.id_sjm = total_sjm.id_sjm', 'left');
		$this->db->where('total_sjm.id_sjm', $id_lpb);
		$ambil = $this->db->get('kalkulasi_sjm');
		$data = $ambil->result_array();
		return $data;
	}

	function tambah_no_po($data,$id_lpb)
	{
		$this->db->where('id_lpb', $id_lpb);
		$this->db->update('lpb', $data);

		$ambil = $this->db->get('lpb');
		$data = $ambil->result_array(); // menampilkan data banyak

		$semua = array();
		foreach ($data as $key => $value)
		{
			$this->db->where('no_purchase_order', $value['no_purchase_order']);
			$ambil_lpb = $this->db->get('lpb');
			$lpb = $ambil_lpb->row_array();

			if(empty($lpb))
			{
				$value['no_po']="kosong";
			}
			else
			{
				$value['no_po']="ada";
			}

			$semua[] = $value;
		}


		return $semua;
	}

	function cek_modal_lpb()
	{
		$this->db->order_by('id_sjm', 'desc');
		$this->db->join('supplier', 'surat_jalan_masuk.id_supplier = supplier.id_supplier', 'left');
		$ambil = $this->db->get('surat_jalan_masuk');
		$data = $ambil->result_array();

		$semua = array();
		foreach ($data as $key => $value)
		{
			$this->db->where('id_sjm', $value['id_sjm']);
			$ambil_lpb = $this->db->get('lpb');
			$lpb = $ambil_lpb->row_array();

			if(empty($lpb))
			{
				$value['laporan']="kosong";
			}
			else
			{
				$value['laporan']="ada";
			}

			$semua[] = $value;
		}


		return $semua;
	}

	function cari_lpb($cari) 
	{
		$tgl_awal = $cari['tgl_awal'];
		$tgl_akhir = $cari['tgl_akhir'];

		$ambil = $this->db->query("SELECT id_lpb, no_lpb, konfirmasi_ttd, no_sjm, no_purchase_order, tgl_dibuat, keterangan FROM lpb JOIN surat_jalan_masuk ON lpb.id_sjm = surat_jalan_masuk.id_sjm WHERE tgl_dibuat BETWEEN '$tgl_awal' AND '$tgl_akhir'");
		$data = $ambil->result_array();

		$semua = array();
		foreach ($data as $key => $value)
		{
			$this->db->where('id_lpb', $value['id_lpb']);
			$ambil1 = $this->db->get('validasi_lpb');
			$data1 = $ambil1->row_array();
			$value['validasi'] = $data1;

			$this->db->where('id_lpb', $value['id_lpb']);
			$ambil1 = $this->db->get('distribusi_lpb');
			$data1 = $ambil1->row_array();
			$value['distribusi'] = $data1;	

			$semua[] = $value;
		}

		return $semua;

	}

	function cari_lpb_validasi($cari) 
	{
		$tgl_awal = $cari['tgl_awal'];
		$tgl_akhir = $cari['tgl_akhir'];

		$ambil = $this->db->query("SELECT lpb.id_lpb, no_lpb, konfirmasi_ttd, no_sjm, no_purchase_order, tgl_dibuat, keterangan, yang_meminta, tgl_diajukan, perihal, tgl_dikonfirmasi, status_pengajuan FROM lpb JOIN surat_jalan_masuk ON lpb.id_sjm = surat_jalan_masuk.id_sjm JOIN validasi_lpb ON lpb.id_lpb = validasi_lpb.id_lpb WHERE tgl_diajukan AND tgl_dikonfirmasi BETWEEN '$tgl_awal' AND '$tgl_akhir'");
		$data = $ambil->result_array();

		$semua = array();
		foreach ($data as $key => $value)
		{
			$this->db->where('id_lpb', $value['id_lpb']);
			$ambil1 = $this->db->get('validasi_lpb');
			$data1 = $ambil1->row_array();
			$value['validasi'] = $data1;

			$this->db->where('id_lpb', $value['id_lpb']);
			$ambil1 = $this->db->get('distribusi_lpb');
			$data1 = $ambil1->row_array();
			$value['distribusi'] = $data1;	

			$semua[] = $value;
			
		}

		return $semua;

	}

	function cari_lpb_user($cari) 
	{

		$ambil = $this->db->query("SELECT id_lpb, no_lpb, konfirmasi_ttd, no_sjm, no_purchase_order, tgl_dibuat, keterangan FROM lpb JOIN surat_jalan_masuk ON lpb.id_sjm = surat_jalan_masuk.id_sjm");
		$data = $ambil->result_array();

		$semua = array();
		$tgl_awal = $cari['tgl_awal1'];
		$tgl_akhir = $cari['tgl_akhir1'];

		foreach ($data as $key => $value)
		{
			$this->db->where('id_lpb', $value['id_lpb']);
			$ambil1 = $this->db->get('validasi_lpb');
			$data1 = $ambil1->row_array();
			$value['validasi'] = $data1;

			$this->db->where('tgl_diterima BETWEEN "'. date('Y-m-d', strtotime($tgl_awal)). '" and "'. date('Y-m-d', strtotime($tgl_akhir)).'"');
			$this->db->where('id_lpb', $value['id_lpb']);
			$ambil1 = $this->db->get('distribusi_lpb');
			$data1 = $ambil1->result_array();
			$value['distribusi'] = $data1;

			$semua[] = $value;
		}

		return $semua;

	}

	function cari_rekap_lpb($cari) 
	{
		$bulan = $cari['bulan'];
		$tahun = $cari['tahun'];

		$semua=array();

		$ambil = $this->db->query("SELECT tgl_dibuat, no_purchase_order, no_lpb, status_pengajuan FROM lpb JOIN validasi_lpb ON lpb.id_lpb = validasi_lpb.id_lpb WHERE MONTH(tgl_dibuat) = '$bulan' AND YEAR(tgl_dibuat) = '$tahun' GROUP BY tgl_dibuat ORDER BY lpb.id_lpb DESC");
		$array = $ambil->result_array();
		foreach ($array as $key => $value)
		{
			$this->db->join('surat_jalan_masuk', 'kalkulasi_sjm.id_sjm = surat_jalan_masuk.id_sjm', 'left');
			$this->db->join('supplier', 'surat_jalan_masuk.id_supplier = supplier.id_supplier', 'left');
			$this->db->join('lpb', 'surat_jalan_masuk.id_sjm = lpb.id_sjm', 'left');
			$this->db->where('lpb.tgl_dibuat', $value['tgl_dibuat']);
			//$this->db->group_by("tgl_dibuat");
			$ambil1 = $this->db->get('kalkulasi_sjm');
			$data1 = $ambil1->result_array();
			$value['validasi']=$data1;		
			$semua[] = $value;
		}

		return $semua;

	}

	// ============================ lpb ==============================

	function ambil_jabatan($id_jabatan)
	{
		$this->db->where('id_jabatan', $id_jabatan);
		$ambil = $this->db->get('jabatan');
		$data = $ambil->row_array();
		return $data;
	}

	function ambil_supplier($id_supplier) 
	{
		$this->db->where('id_supplier', $id_supplier);
		$ambil = $this->db->get('supplier');
		$data = $ambil->row_array();
		return $data;
	}

	function update_stok($id_lpb)
	{
		$this->db->join('surat_jalan_masuk', 'lpb.id_sjm = surat_jalan_masuk.id_sjm', 'left');
		$this->db->where('id_lpb', $id_lpb);
		$ambil1 = $this->db->get('lpb');
		$data1 = $ambil1->row_array();

		$this->db->where('id_sjm', $data1['id_sjm']);
		$sjm1 = $this->db->get('kalkulasi_sjm')->result_array();

		$semua1 = array();
		foreach ($sjm1 as $key => $value)
		{
			$this->db->where('nama_barang', $value['nama_barang']);
			$barang = $this->db->get('barang')->row_array();
			$value['id_barang'] = $barang['id_barang'];
			$semua1[] = $value;
		}

		$semua_nya1 = array();
		foreach ($semua1 as $key => $value)
		{
			$jumlah_barang['qty_sjm'] = $value['qty_sjm'];

			$this->db->where('id_barang', $value['id_barang']);
			$barang = $this->db->get('barang')->row_array();
			$total['stok'] = $barang['stok'];

			$stok['stok'] = $total['stok'] + $jumlah_barang['qty_sjm'];

			$this->db->where('id_barang', $value['id_barang']);
			$this->db->update('barang', $stok);

		}	
	
	}

	function ambil_sjm_lpb($id_lpb) 
	{
		$this->db->join('surat_jalan_masuk', 'lpb.id_sjm = surat_jalan_masuk.id_sjm', 'left');
		$this->db->where('id_lpb', $id_lpb);
		$ambil = $this->db->get('lpb');
		$data = $ambil->row_array();

		$this->db->where('id_sjm', $data['id_sjm']);
		$sjm = $this->db->get('kalkulasi_sjm')->result_array();

		$semua = array();
		foreach ($sjm as $key => $value)
		{
			$this->db->join('barang', 'kartu_persediaan_barang.id_barang = barang.id_barang', 'left');
			$this->db->where('barang.nama_barang', $value['nama_barang']);
			$kpb = $this->db->get('kartu_persediaan_barang')->row_array();
			$value['id_kpb'] = $kpb['id_kpb'];
			$semua[] = $value;
		}

		$semua_nya = array();
		foreach ($semua as $key => $value)
		{
			$bukti_kpb = $this->db->query("SELECT * FROM bukti_kpb WHERE id_kpb='$value[id_kpb]' ORDER BY id_bukti_kpb DESC")->row_array();
			$value['bukti'] = $bukti_kpb;
			$semua_nya[] = $value;
		}

		// ------------------ masuk otomatis ke kpb (bukti kpb) ------------------------------- //

		// ------------------ masuk otomatis ke kpb (kalkulasi kpb) ------------------------------- //

		foreach ($semua_nya as $key => $value)
		{

			$hasil['id_kpb'] = $value['id_kpb'];
			$hasil['tgl_masuk'] = $data['tgl_dibuat'];
			$hasil['no_bukti'] = $data['no_lpb'];
			$hasil['keterangan'] = $data['keterangan'];
			$hasil['qty_masuk'] = $value['qty_sjm'];
			$hasil['saldo'] = $value['bukti']['saldo']+$value['qty_sjm'];

			$this->db->insert('bukti_kpb', $hasil);
		}		
	}

	function hitung_val_lpb_kdpo()
	{
		$this->db->join('validasi_lpb', 'lpb.id_lpb = validasi_lpb.id_lpb', 'left');
		$this->db->where('status_pesan', '0');
		$ambil = $this->db->get('lpb');
		$data = $ambil->result_array();

		return $data;
	}

	function data_val_lpb_kdpo()
	{
		$this->db->join('validasi_lpb', 'lpb.id_lpb = validasi_lpb.id_lpb', 'left');
		$this->db->where('status_pesan', '0');
		$ambil = $this->db->get('lpb');
		$data = $ambil->row_array();

		return $data;
	}

	function ubah_status_val_lpb_kdpo($id_val_lpb)
	{
		$input['status_pesan'] = 1;
		$this->db->where('id_val_lpb', $id_val_lpb);
		$this->db->update('validasi_lpb', $input);
	}


	// ---------------------------- Notif Distribusi LPB Kepala Divisi Purchase Order ----------------------------
	function hitung_dis_lpb_kdpo()
	{
		$this->db->join('distribusi_lpb', 'lpb.id_lpb = distribusi_lpb.id_lpb', 'left');
		$this->db->where('tujuan', 'Kepala Divisi Purchase Order');
		$this->db->where('status_pesan', '0');
		$ambil = $this->db->get('lpb');
		$data = $ambil->result_array();

		return $data;
	}

	function data_dis_lpb_kdpo()
	{
		$this->db->join('distribusi_lpb', 'lpb.id_lpb = distribusi_lpb.id_lpb', 'left');
		$this->db->where('tujuan', 'Kepala Divisi Purchase Order');
		$this->db->where('status_pesan', '0');
		$ambil = $this->db->get('lpb');
		$data = $ambil->row_array();

		return $data;
	}

	function ubah_status_dis_lpb_kdpo($id_distribusi_lpb)
	{
		$input['status_pesan'] = 1;
		$this->db->where('id_distribusi_lpb', $id_distribusi_lpb);
		$this->db->update('distribusi_lpb', $input);
	}
	// ---------------------------- Notif Distribusi LPB Kepala Divisi Purchase Order ----------------------------


	// ---------------------------- Notif Distribusi LPB Kepala Divisi Hutang Dagang ----------------------------
	function hitung_dis_lpb_kdhd()
	{
		$this->db->join('distribusi_lpb', 'lpb.id_lpb = distribusi_lpb.id_lpb', 'left');
		$this->db->where('tujuan', 'Kepala Divisi Hutang Dagang');
		$this->db->where('status_pesan', '0');
		$ambil = $this->db->get('lpb');
		$data = $ambil->result_array();

		return $data;
	}

	function data_dis_lpb_kdhd()
	{
		$this->db->join('distribusi_lpb', 'lpb.id_lpb = distribusi_lpb.id_lpb', 'left');
		$this->db->where('tujuan', 'Kepala Divisi Hutang Dagang');
		$this->db->where('status_pesan', '0');
		$ambil = $this->db->get('lpb');
		$data = $ambil->row_array();

		return $data;
	}

	function ubah_status_dis_lpb_kdhd($id_distribusi_lpb)
	{
		$input['status_pesan'] = 1;
		$this->db->where('id_distribusi_lpb', $id_distribusi_lpb);
		$this->db->update('distribusi_lpb', $input);
	}
	// ---------------------------- Notif Distribusi LPB Kepala Divisi Hutang Dagang ----------------------------

	// ---------------------------- Notif Distribusi LPB Kepala Divisi Acccounting ----------------------------
	function hitung_dis_lpb_kda()
	{
		$this->db->join('distribusi_lpb', 'lpb.id_lpb = distribusi_lpb.id_lpb', 'left');
		$this->db->where('tujuan', 'Kepala Divisi Accounting');
		$this->db->where('status_pesan', '0');
		$ambil = $this->db->get('lpb');
		$data = $ambil->result_array();

		return $data;
	}

	function data_dis_lpb_kda()
	{
		$this->db->join('distribusi_lpb', 'lpb.id_lpb = distribusi_lpb.id_lpb', 'left');
		$this->db->where('tujuan', 'Kepala Divisi Accounting');
		$this->db->where('status_pesan', '0');
		$ambil = $this->db->get('lpb');
		$data = $ambil->row_array();

		return $data;
	}

	function ubah_status_dis_lpb_kda($id_distribusi_lpb)
	{
		$input['status_pesan'] = 1;
		$this->db->where('id_distribusi_lpb', $id_distribusi_lpb);
		$this->db->update('distribusi_lpb', $input);
	}
	// ---------------------------- Notif Distribusi LPB Kepala Divisi Accounting ----------------------------

	// ---------------------------- Notif Distribusi LPB Direktur ----------------------------
	function hitung_dis_lpb_direk()
	{
		$this->db->join('distribusi_lpb', 'lpb.id_lpb = distribusi_lpb.id_lpb', 'left');
		$this->db->where('tujuan', 'Direktur');
		$this->db->where('status_pesan', '0');
		$ambil = $this->db->get('lpb');
		$data = $ambil->result_array();

		return $data;
	}

	function data_dis_lpb_direk()
	{
		$this->db->join('distribusi_lpb', 'lpb.id_lpb = distribusi_lpb.id_lpb', 'left');
		$this->db->where('tujuan', 'Direktur');
		$this->db->where('status_pesan', '0');
		$ambil = $this->db->get('lpb');
		$data = $ambil->row_array();

		return $data;
	}

	function ubah_status_dis_lpb_direk($id_distribusi_lpb)
	{
		$input['status_pesan'] = 1;
		$this->db->where('id_distribusi_lpb', $id_distribusi_lpb);
		$this->db->update('distribusi_lpb', $input);
	}
	// ---------------------------- Notif Distribusi LPB Direktur ----------------------------

	// ---------------------------- Notif Hasil Validasi LPB Kepala Divisi Purchase Order ----------------------------
	function hitung_hasil_val_lpb_kdpo()
	{
		$this->db->join('validasi_lpb', 'lpb.id_lpb = validasi_lpb.id_lpb', 'left');
		$this->db->where('tujuan', 'Kepala Divisi Purchase Order');
		$this->db->where('status_pesan', '1');
		$this->db->where('status_hasil', '0');
		$ambil = $this->db->get('lpb');
		$data = $ambil->result_array();

		return $data;
	}

	function data_hasil_val_lpb_kdpo()
	{
		$this->db->join('validasi_lpb', 'lpb.id_lpb = validasi_lpb.id_lpb', 'left');
		$this->db->where('tujuan', 'Kepala Divisi Purchase Order');
		$this->db->where('status_pesan', '1');
		$this->db->where('status_hasil', '0');
		$ambil = $this->db->get('lpb');
		$data = $ambil->row_array();

		return $data;
	}

	function ubah_status_hasil_val_lpb_kdpo($id_val_lpb)
	{
		$input['status_hasil'] = 1;
		$this->db->where('id_val_lpb', $id_val_lpb);
		$this->db->update('validasi_lpb', $input);
	}
	// ---------------------------- Notif Hasil Validasi LPB Kepala Divisi Purchase Order ----------------------------

}
?>