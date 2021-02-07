<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Msurat_jalan_keluar extends CI_Model 
{

	function tampil_laporan_sjk() 
	{
		$ambil = $this->db->get('surat_jalan_keluar');
		$data = $ambil->result_array(); // menampilkan data banyak
		$semua = array();
		
		foreach ($data as $key => $value)
		{
			$this->db->join('lpb', 'pemeriksaan_barang.id_lpb = lpb.id_lpb', 'left');
			$this->db->join('surat_jalan_masuk', 'lpb.id_sjm = surat_jalan_masuk.id_sjm', 'left');
			$this->db->join('supplier', 'surat_jalan_masuk.id_supplier = supplier.id_supplier', 'left');
			$this->db->where('id_pemeriksaan_barang', $value['id_pemeriksaan_barang']);
			$ambil1 = $this->db->get('pemeriksaan_barang');
			$data1 = $ambil1->row_array();
			$value['sjm'] = $data1;

			$this->db->where('id_sjk', $value['id_sjk']);
			$ambil1 = $this->db->get('validasi_sjk');
			$data1 = $ambil1->row_array();
			$value['validasi'] = $data1;

			$this->db->where('id_sjk', $value['id_sjk']);
			$ambil1 = $this->db->get('distribusi_sjk');
			$data1 = $ambil1->result_array();
			$value['distribusi'] = $data1;

			$semua[] = $value;
		}

		return $semua;
	}

	function kirim_sjk($data)
	{

		foreach ($data['tujuan'] as $key => $value)
		{
			$hasil['id_sjk'] = $data['id_sjk'];
			$hasil['asal'] = $data['asal'];
			$hasil['tujuan'] = $value;
			$hasil['tgl_diterima'] = $data['tgl_diterima'];
			$this->db->insert('distribusi_sjk',$hasil);
		}
	}

	function cari_sjk($cari) 
	{
		$tgl_awal = $cari['tgl_awal'];
		$tgl_akhir = $cari['tgl_akhir'];

		$ambil = $this->db->query("SELECT id_sjk, no_sjk, id_pemeriksaan_barang FROM surat_jalan_keluar");
		$data = $ambil->result_array();
		
		$semua = array();
		
		foreach ($data as $key => $value)
		{
			$this->db->join('lpb', 'pemeriksaan_barang.id_lpb = lpb.id_lpb', 'left');
			$this->db->join('surat_jalan_masuk', 'lpb.id_sjm = surat_jalan_masuk.id_sjm', 'left');
			$this->db->join('supplier', 'surat_jalan_masuk.id_supplier = supplier.id_supplier', 'left');
			$this->db->where('id_pemeriksaan_barang', $value['id_pemeriksaan_barang']);
			$ambil1 = $this->db->get('pemeriksaan_barang');
			$data1 = $ambil1->row_array();
			$value['sjm'] = $data1;

			$this->db->where('id_sjk', $value['id_sjk']);
			$ambil1 = $this->db->get('validasi_sjk');
			$data1 = $ambil1->row_array();
			$value['validasi'] = $data1;

			$this->db->where('tgl_diterima BETWEEN "'. date('Y-m-d', strtotime($tgl_awal)). '" and "'. date('Y-m-d', strtotime($tgl_akhir)).'"');
			$this->db->where('id_sjk', $value['id_sjk']);
			$ambil1 = $this->db->get('distribusi_sjk');
			$data1 = $ambil1->result_array();
			$value['distribusi'] = $data1;

			$semua[] = $value;
		}

		return $semua;
	}

	function kode_otomatis()
	{
		$this->db->select('LEFT(surat_jalan_keluar.no_sjk,2) as kode', FALSE);
		$this->db->order_by('kode','DESC');    
		$this->db->limit(1);    
		$query = $this->db->get('surat_jalan_keluar');  //cek dulu apakah ada sudah ada kode di tabel.    
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
		$kodetampil = $no_urut."/GD/K SUS/".$romawi[date('n')]."/".$tahun;  //format kode
		return $kodetampil;  
	}

	// =============== Membuat Surat Jalan Keluar dari controller Pemeriksaan Barang ==================
	function tambah_sjk($data)
	{
		$this->db->insert('surat_jalan_keluar',$data);
	}
	// =============== Membuat Surat Jalan Keluar dari controller Pemeriksaan Barang ==================

	function ambil_qc_lpb_sjm($inputan)
	{
		$this->db->join('pemeriksaan_barang', 'surat_jalan_keluar.id_pemeriksaan_barang = pemeriksaan_barang.id_pemeriksaan_barang', 'left');
		$this->db->join('barang', 'pemeriksaan_barang.nama_barang = barang.nama_barang', 'left');
		$this->db->where('pemeriksaan_barang.id_pemeriksaan_barang', $inputan['id_pemeriksaan_barang']);
		$ambil = $this->db->get('surat_jalan_keluar');
		$data = $ambil->row_array();

		if ($data['nama_barang']=="-") 
		{
			$this->db->join('pemeriksaan_barang', 'surat_jalan_keluar.id_pemeriksaan_barang = pemeriksaan_barang.id_pemeriksaan_barang', 'left');
			$this->db->join('lpb', 'pemeriksaan_barang.id_lpb = lpb.id_lpb', 'left');
			$this->db->join('surat_jalan_masuk', 'lpb.id_sjm = surat_jalan_masuk.id_sjm', 'left');
			$this->db->join('kalkulasi_sjm', 'surat_jalan_masuk.id_sjm = kalkulasi_sjm.id_sjm', 'left');
			$this->db->where('pemeriksaan_barang.id_pemeriksaan_barang', $inputan['id_pemeriksaan_barang']);
			$ambil = $this->db->get('surat_jalan_keluar');
			$sjm = $ambil->row_array();

			$hasil1['id_sjk'] = $sjm['id_sjk'];
			$hasil1['nama_barang'] = $sjm['nama_barang'];
			$hasil1['qty_sjk'] = $sjm['qty_reject'];
			$hasil1['ukuran'] = $sjm['ukuran'];
			$this->db->insert('kalkulasi_sjk', $hasil1);	
		}
		elseif ($data['nama_barang']!=="-")
		{
			$hasil2['id_sjk'] = $data['id_sjk'];
			$hasil2['nama_barang'] = $data['nama_barang'];
			$hasil2['qty_sjk'] = $data['qty_reject'];
			$hasil2['ukuran'] = "-";
			$this->db->insert('kalkulasi_sjk', $hasil2);
		}
	}

	function ambil_sjk_qc($id_sjk)
	{
		$this->db->join('pemeriksaan_barang', 'surat_jalan_keluar.id_pemeriksaan_barang = pemeriksaan_barang.id_pemeriksaan_barang', 'left');
		$this->db->where('id_sjk', $id_sjk);
		$ambil = $this->db->get('surat_jalan_keluar');
		$data = $ambil->row_array();

		$this->db->where('id_sjk', $data['id_sjk']);
		$sjk = $this->db->get('kalkulasi_sjk')->row_array();

		$this->db->join('barang', 'kartu_persediaan_barang.id_barang = barang.id_barang', 'left');
		$this->db->where('barang.nama_barang', $sjk['nama_barang']);
		$kpb = $this->db->get('kartu_persediaan_barang')->row_array();

		$this->db->where('id_kpb', $kpb['id_kpb']);
		$bukti_kpb = $this->db->get('bukti_kpb')->row_array();

		$bukti_kpb = $this->db->query("SELECT * FROM bukti_kpb WHERE id_kpb='$kpb[id_kpb]' ORDER BY id_bukti_kpb DESC")->row_array();

		$hasil['id_kpb'] = $kpb['id_kpb'];
		$hasil['tgl_masuk'] = $data['tgl_dibuat'];
		$hasil['no_bukti'] = $data['no_sjk'];
		$hasil['keterangan'] = $data['tindakan'];
		$hasil['qty_keluar'] = $sjk['qty_sjk'];
		$hasil['saldo'] = $bukti_kpb['saldo']-$sjk['qty_sjk'];
		$this->db->insert('bukti_kpb', $hasil);
	}

	function tampil_sjk()
	{
		$ambil = $this->db->get('surat_jalan_keluar');
		$data = $ambil->result_array(); // menampilkan data banyak
		$semua = array();
		
		foreach ($data as $key => $value)
		{
			$this->db->join('lpb', 'pemeriksaan_barang.id_lpb = lpb.id_lpb', 'left');
			$this->db->join('surat_jalan_masuk', 'lpb.id_sjm = surat_jalan_masuk.id_sjm', 'left');
			$this->db->join('supplier', 'surat_jalan_masuk.id_supplier = supplier.id_supplier', 'left');
			$this->db->where('id_pemeriksaan_barang', $value['id_pemeriksaan_barang']);
			$ambil1 = $this->db->get('pemeriksaan_barang');
			$data1 = $ambil1->row_array();
			$value['sjm'] = $data1;

			$this->db->where('id_sjk', $value['id_sjk']);
			$ambil1 = $this->db->get('validasi_sjk');
			$data1 = $ambil1->row_array();
			$value['validasi'] = $data1;

			$this->db->where('id_sjk', $value['id_sjk']);
			$ambil1 = $this->db->get('distribusi_sjk');
			$data1 = $ambil1->result_array();
			$value['distribusi'] = $data1;

			$semua[] = $value;
		}

		return $semua;
	}

	function cari_val_sjk($cari)
	{
		$tgl_awal = $cari['tgl_awal'];
		$tgl_akhir = $cari['tgl_akhir'];

		$ambil = $this->db->query("SELECT id_sjk, id_pemeriksaan_barang, no_sjk, no_kendaraan FROM surat_jalan_keluar ");
		$data = $ambil->result_array();
		$semua = array();
		
		foreach ($data as $key => $value)
		{
			$this->db->join('lpb', 'pemeriksaan_barang.id_lpb = lpb.id_lpb', 'left');
			$this->db->join('surat_jalan_masuk', 'lpb.id_sjm = surat_jalan_masuk.id_sjm', 'left');
			$this->db->join('supplier', 'surat_jalan_masuk.id_supplier = supplier.id_supplier', 'left');
			$this->db->where('id_pemeriksaan_barang', $value['id_pemeriksaan_barang']);
			$ambil1 = $this->db->get('pemeriksaan_barang');
			$data1 = $ambil1->row_array();
			$value['sjm'] = $data1;

			$this->db->where('tgl_diajukan AND tgl_dikonfirmasi BETWEEN "'. date('Y-m-d', strtotime($tgl_awal)). '" and "'. date('Y-m-d', strtotime($tgl_akhir)).'"');
			$this->db->where('id_sjk', $value['id_sjk']);
			$ambil1 = $this->db->get('validasi_sjk');
			$data1 = $ambil1->row_array();
			$value['validasi'] = $data1;

			$this->db->where('id_sjk', $value['id_sjk']);
			$ambil1 = $this->db->get('distribusi_sjk');
			$data1 = $ambil1->result_array();
			$value['distribusi'] = $data1;

			$semua[] = $value;
		}

		return $semua;
	}

	function pengajuan_sjk($data) 
	{
		$this->db->insert('validasi_sjk',$data);
	}

	function ambil_sjk($id_sjk)
	{
		$this->db->join('pemeriksaan_barang', 'surat_jalan_keluar.id_pemeriksaan_barang = pemeriksaan_barang.id_pemeriksaan_barang', 'left');
		$this->db->join('lpb', 'pemeriksaan_barang.id_lpb = lpb.id_lpb', 'left');
		$this->db->where('id_sjk', $id_sjk);
		$ambil = $this->db->get('surat_jalan_keluar');
		$data = $ambil->row_array();
		return $data;
	}

	function ambil1_sjk($id_sjk)
	{
		$this->db->join('pemeriksaan_barang', 'surat_jalan_keluar.id_pemeriksaan_barang = pemeriksaan_barang.id_pemeriksaan_barang', 'left');
		$this->db->join('lpb', 'pemeriksaan_barang.id_lpb = lpb.id_lpb', 'left');
		$this->db->join('surat_jalan_masuk', 'lpb.id_sjm = surat_jalan_masuk.id_sjm', 'left');
		$this->db->join('supplier', 'surat_jalan_masuk.id_supplier = supplier.id_supplier', 'left');
		$this->db->where('id_sjk', $id_sjk);
		$ambil = $this->db->get('surat_jalan_keluar');
		$data = $ambil->row_array();
		return $data;
	}

	function ambil_kalkulasi($id_sjk)
	{
		$this->db->join('barang', 'kalkulasi_sjk.nama_barang = barang.nama_barang', 'left');
		$this->db->join('jenis', 'barang.id_jenis = jenis.id_jenis', 'left');
		$this->db->join('sub_jenis', 'barang.id_sub_jenis = sub_jenis.id_sub_jenis', 'left');
		$this->db->join('satuan', 'barang.id_satuan = satuan.id_satuan', 'left');
		$this->db->where('id_sjk', $id_sjk);
		$ambil = $this->db->get('kalkulasi_sjk');
		$data = $ambil->result_array();

		return $data;
	}

	function ambil_total($id_sjk)
	{
		$this->db->where('id_sjk', $id_sjk);
		$ambil = $this->db->get('total_sjk');
		$data = $ambil->row_array();
		return $data;
	}

	function ambil_validasi($id_sjk)
	{
		$this->db->where('id_sjk', $id_sjk);
		$ambil = $this->db->get('validasi_sjk');
		$data = $ambil->row_array();
		return $data;
	}

	function tambah_no_kendaraan($data,$id_sjk)
	{
		$this->db->where('id_sjk', $id_sjk);
		$this->db->update('surat_jalan_keluar', $data);
	}

	function ubah_ttd_sjk($id_sjk)
	{
		$data['konfirmasi']="Valid";
		$this->db->where('id_sjk', $id_sjk);
		$this->db->update('surat_jalan_keluar', $data);
	}

	function konfirmasi_persetujuan($id_sjk, $inputan)
	{
		$data['status_pengajuan'] = "Disetujui";
		$data['tgl_dikonfirmasi'] = $inputan['tgl_dikonfirmasi'];

		$this->db->where('id_sjk', $id_sjk);
		$this->db->update('validasi_sjk', $data);
	}

	function konfirmasi_persetujuan_tolak($id_sjk1,$inputan1)
	{
		$data1['status_pengajuan'] = "Ditolak";
		$data1['alasan'] = $inputan['alasan'];
		$data1['tgl_dikonfirmasi'] = $inputan['tgl_dikonfirmasi'];

		$this->db->where('id_sjk', $id_sjk1);
		$this->db->update('validasi_sjk', $data1);
	}

	function tampil_rekap_sjk()
	{
		$this->db->join('pemeriksaan_barang', 'surat_jalan_keluar.id_pemeriksaan_barang = pemeriksaan_barang.id_pemeriksaan_barang', 'left');
		$this->db->join('kalkulasi_sjk', 'surat_jalan_keluar.id_sjk = kalkulasi_sjk.id_sjk', 'left');
		$this->db->join('validasi_sjk', 'surat_jalan_keluar.id_sjk = validasi_sjk.id_sjk', 'left');
		$this->db->group_by("tgl_dibuat");
		$ambil = $this->db->get('surat_jalan_keluar');
		$data = $ambil->result_array();

		foreach ($data as $key => $value)
		{
			$this->db->join('surat_jalan_masuk', 'lpb.id_sjm = surat_jalan_masuk.id_sjm', 'left');
			$this->db->join('supplier', 'surat_jalan_masuk.id_supplier = supplier.id_supplier', 'left');
			$this->db->where('id_lpb', $value['id_lpb']);
			$ambil1 = $this->db->get('lpb');
			$data1 = $ambil1->result_array();
			$value['validasi'] = $data1;		
			$semua[] = $value;
		}

		return $semua;

	}

	function cari_rekap_sjk($cari) 
	{
		$bulan = $cari['bulan'];
		$tahun = $cari['tahun'];

		$ambil = $this->db->query("SELECT no_sjk, no_pemeriksaan_barang, tgl_dibuat, kalkulasi_sjk.nama_barang, qty_sjk, status_pengajuan, tindakan, id_lpb FROM surat_jalan_keluar JOIN pemeriksaan_barang ON surat_jalan_keluar.id_pemeriksaan_barang = pemeriksaan_barang.id_pemeriksaan_barang JOIN kalkulasi_sjk ON surat_jalan_keluar.id_sjk = kalkulasi_sjk.id_sjk JOIN validasi_sjk ON surat_jalan_keluar.id_sjk = validasi_sjk.id_sjk WHERE MONTH(tgl_dibuat) = '$bulan' AND YEAR(tgl_dibuat) = '$tahun' GROUP BY 'tgl_dibuat'");
		$data = $ambil->result_array();

		foreach ($data as $key => $value)
		{
			$this->db->join('surat_jalan_masuk', 'lpb.id_sjm = surat_jalan_masuk.id_sjm', 'left');
			$this->db->join('supplier', 'surat_jalan_masuk.id_supplier = supplier.id_supplier', 'left');
			$this->db->where('id_lpb', $value['id_lpb']);
			$ambil1 = $this->db->get('lpb');
			$data1 = $ambil1->result_array();
			$value['validasi'] = $data1;

			$semua[] = $value;
		}

		return $semua;

	}

	// ---------------------------- Notif Validasi SJK Direktur ----------------------------
	function hitung_val_sjk_direk()
	{
		$this->db->join('validasi_sjk', 'surat_jalan_keluar.id_sjk = validasi_sjk.id_sjk', 'left');
		$this->db->where('tujuan', 'Direktur');
		$this->db->where('status_pesan', '0');
		$ambil = $this->db->get('surat_jalan_keluar');
		$data = $ambil->result_array();

		return $data;
	}

	function data_val_sjk_direk()
	{
		$this->db->join('validasi_sjk', 'surat_jalan_keluar.id_sjk = validasi_sjk.id_sjk', 'left');
		$this->db->where('tujuan', 'Direktur');
		$this->db->where('status_pesan', '0');
		$ambil = $this->db->get('surat_jalan_keluar');
		$data = $ambil->row_array();

		return $data;
	}

	function ubah_status_val_sjk_direk($id_val_sjk)
	{
		$input['status_pesan'] = 1;
		$this->db->where('id_val_sjk', $id_val_sjk);
		$this->db->update('validasi_sjk', $input);
	}
	// ---------------------------- Notif Validasi SJK Direk ----------------------------

	// ---------------------------- Notif Distribusi SJK Direktur ----------------------------
	function hitung_dis_sjk_direk()
	{
		$this->db->join('distribusi_sjk', 'surat_jalan_keluar.id_sjk = distribusi_sjk.id_sjk', 'left');
		$this->db->where('tujuan', 'Direktur');
		$this->db->where('status_pesan', '0');
		$ambil = $this->db->get('surat_jalan_keluar');
		$data = $ambil->result_array();

		return $data;
	}

	function data_dis_sjk_direk()
	{
		$this->db->join('pemeriksaan_barang', 'surat_jalan_keluar.id_pemeriksaan_barang = pemeriksaan_barang.id_pemeriksaan_barang', 'left');
		$this->db->join('distribusi_sjk', 'surat_jalan_keluar.id_sjk = distribusi_sjk.id_sjk', 'left');
		$this->db->where('tujuan', 'Direktur');
		$this->db->where('status_pesan', '0');
		$ambil = $this->db->get('surat_jalan_keluar');
		$data = $ambil->row_array();

		return $data;
	}

	function ubah_status_dis_sjk_direk($id_distribusi_sjk)
	{
		$input['status_pesan'] = 1;
		$this->db->where('id_distribusi_sjk', $id_distribusi_sjk);
		$this->db->update('distribusi_sjk', $input);
	}
	// ---------------------------- Notif Distribusi SJK Direktur ----------------------------

	// ---------------------------- Notif Distribusi SJK Kepala Divisi Accounting ----------------------------
	function hitung_dis_sjk_kda()
	{
		$this->db->join('distribusi_sjk', 'surat_jalan_keluar.id_sjk = distribusi_sjk.id_sjk', 'left');
		$this->db->where('tujuan', 'Kepala Divisi Accounting');
		$this->db->where('status_pesan', '0');
		$ambil = $this->db->get('surat_jalan_keluar');
		$data = $ambil->result_array();

		return $data;
	}

	function data_dis_sjk_kda()
	{
		$this->db->join('pemeriksaan_barang', 'surat_jalan_keluar.id_pemeriksaan_barang = pemeriksaan_barang.id_pemeriksaan_barang', 'left');
		$this->db->join('distribusi_sjk', 'surat_jalan_keluar.id_sjk = distribusi_sjk.id_sjk', 'left');
		$this->db->where('tujuan', 'Kepala Divisi Accounting');
		$this->db->where('status_pesan', '0');
		$ambil = $this->db->get('surat_jalan_keluar');
		$data = $ambil->row_array();

		return $data;
	}

	function ubah_status_dis_sjk_kda($id_distribusi_sjk)
	{
		$input['status_pesan'] = 1;
		$this->db->where('id_distribusi_sjk', $id_distribusi_sjk);
		$this->db->update('distribusi_sjk', $input);
	}
	// ---------------------------- Notif Distribusi SJK Kepala Divisi Accounting ----------------------------

	// ---------------------------- Notif Distribusi SJK Kepala Divisi EXIM ----------------------------
	function hitung_dis_sjk_exim()
	{
		$this->db->join('distribusi_sjk', 'surat_jalan_keluar.id_sjk = distribusi_sjk.id_sjk', 'left');
		$this->db->where('tujuan', 'Kepala Divisi EXIM');
		$this->db->where('status_pesan', '0');
		$ambil = $this->db->get('surat_jalan_keluar');
		$data = $ambil->result_array();

		return $data;
	}

	function data_dis_sjk_exim()
	{
		$this->db->join('pemeriksaan_barang', 'surat_jalan_keluar.id_pemeriksaan_barang = pemeriksaan_barang.id_pemeriksaan_barang', 'left');
		$this->db->join('distribusi_sjk', 'surat_jalan_keluar.id_sjk = distribusi_sjk.id_sjk', 'left');
		$this->db->where('tujuan', 'Kepala Divisi EXIM');
		$this->db->where('status_pesan', '0');
		$ambil = $this->db->get('surat_jalan_keluar');
		$data = $ambil->row_array();

		return $data;
	}

	function ubah_status_dis_sjk_exim($id_distribusi_sjk)
	{
		$input['status_pesan'] = 1;
		$this->db->where('id_distribusi_sjk', $id_distribusi_sjk);
		$this->db->update('distribusi_sjk', $input);
	}
	// ---------------------------- Notif Distribusi SJK Kepala Divisi EXIM ----------------------------

	// ---------------------------- Notif Hasil Validasi SJK Direktur ----------------------------
	function hitung_hasil_val_sjk_direk()
	{
		$this->db->join('validasi_sjk', 'surat_jalan_keluar.id_sjk = validasi_sjk.id_sjk', 'left');
		$this->db->where('tujuan', 'Direktur');
		$this->db->where('status_pesan', '1');
		$this->db->where('status_hasil', '0');
		$ambil = $this->db->get('surat_jalan_keluar');
		$data = $ambil->result_array();

		return $data;
	}

	function data_hasil_val_sjk_direk()
	{
		$this->db->join('validasi_sjk', 'surat_jalan_keluar.id_sjk = validasi_sjk.id_sjk', 'left');
		$this->db->where('tujuan', 'Direktur');
		$this->db->where('status_pesan', '1');
		$this->db->where('status_hasil', '0');
		$ambil = $this->db->get('surat_jalan_keluar');
		$data = $ambil->row_array();

		return $data;
	}

	function ubah_status_hasil_val_sjk_direk($id_val_sjk)
	{
		$input['status_hasil'] = 1;
		$this->db->where('id_val_sjk', $id_val_sjk);
		$this->db->update('validasi_sjk', $input);
	}
	// ---------------------------- Notif Hasil Validasi SJK Direktur ----------------------------

}
?>