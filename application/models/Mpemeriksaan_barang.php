<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mpemeriksaan_barang extends CI_Model 
{
	function tampil_periksa_barang()
	{
		$this->db->join('lpb', 'pemeriksaan_barang.id_lpb = lpb.id_lpb', 'left');
		$ambil = $this->db->get('pemeriksaan_barang');
		$data = $ambil->result_array();

		$semua = array();
		foreach ($data as $key => $value)
		{
			$this->db->where('id_pemeriksaan_barang', $value['id_pemeriksaan_barang']);
			$ambil1 = $this->db->get('surat_jalan_keluar');
			$data1 = $ambil1->row_array();
			$value['periksa']=$data1;			
			$semua[] = $value;
		}

		return $semua;

	}

	function tampil_lpb()
	{
		$this->db->order_by('id_lpb', "desc");
		$ambil = $this->db->get('lpb');
		$data = $ambil->result_array();
		return $data;
	}

	function ambil_pemeriksaan_barang($id_qc) 
	{
		$this->db->join('lpb', 'pemeriksaan_barang.id_lpb = lpb.id_lpb');
		$this->db->where('id_pemeriksaan_barang', $id_qc);
		$ambil = $this->db->get('pemeriksaan_barang');
		$data = $ambil->row_array();
		return $data;
	}

	function ubah_ttd_pemeriksaan($id_pemeriksaan)
	{
		$data['inspection_acceptable']="Valid";
		$this->db->where('id_pemeriksaan_barang', $id_pemeriksaan);
		$this->db->update('pemeriksaan_barang', $data);
	}

	function ambil_qc($id_qc) 
	{
		// $this->db->join('lpb', 'pemeriksaan_barang.id_lpb = lpb.id_lpb');
		// $this->db->join('surat_jalan_masuk', 'lpb.id_sjm = surat_jalan_masuk.id_sjm');
		// $this->db->join('kalkulasi_sjm', 'surat_jalan_masuk.id_sjm = kalkulasi_sjm.id_sjm');
		// $this->db->join('barang', 'kalkulasi_sjm.nama_barang = barang.nama_barang');
		// $this->db->join('supplier', 'surat_jalan_masuk.id_supplier = supplier.id_supplier');
		$this->db->where('id_pemeriksaan_barang', $id_qc);
		$ambil = $this->db->get('pemeriksaan_barang');
		$data = $ambil->row_array();
		return $data;
	}

	function ambil_qc1($id_qc) 
	{
		$this->db->join('lpb', 'pemeriksaan_barang.id_lpb = lpb.id_lpb');
		$this->db->join('surat_jalan_masuk', 'lpb.id_sjm = surat_jalan_masuk.id_sjm');
		$this->db->join('kalkulasi_sjm', 'surat_jalan_masuk.id_sjm = kalkulasi_sjm.id_sjm');
		$this->db->join('barang', 'kalkulasi_sjm.nama_barang = barang.nama_barang');
		$this->db->join('supplier', 'surat_jalan_masuk.id_supplier = supplier.id_supplier');
		$this->db->where('id_pemeriksaan_barang', $id_qc);
		$ambil = $this->db->get('pemeriksaan_barang');
		$data = $ambil->row_array();
		return $data;
	}	

	function ambil_lpb($id_lpb) 
	{
		$this->db->join('pemeriksaan_barang', 'lpb.id_lpb = pemeriksaan_barang.id_lpb', 'left');
		$this->db->where('lpb.id_lpb', $id_lpb);
		$ambil = $this->db->get('lpb');
		$data = $ambil->row_array();
		return $data;
	}

	function ambil_lpb1($nama_barang) 
	{
		// $this->db->join('pemeriksaan_barang', 'lpb.id_lpb = pemeriksaan_barang.id_lpb', 'left');
		$this->db->where('nama_barang', $nama_barang);
		$ambil = $this->db->get('pemeriksaan_barang');
		$data = $ambil->row_array();
		return $data;
	}

	function ambil_lpb2($id_lpb) 
	{
		// $this->db->join('pemeriksaan_barang', 'lpb.id_lpb = pemeriksaan_barang.id_lpb', 'left');
		$this->db->where('id_lpb', $id_lpb);
		$ambil = $this->db->get('pemeriksaan_barang');
		$data = $ambil->num_rows();

		return $data;
	}

	function ambil_lpb3($nama_barang) 
	{
		// $this->db->join('pemeriksaan_barang', 'lpb.id_lpb = pemeriksaan_barang.id_lpb', 'left');
		$this->db->where('nama_barang', $nama_barang);
		$ambil = $this->db->get('pemeriksaan_barang');
		$data = $ambil->row_array();
		return $data;
	}

	function tampil_kalkulasi_sjm($id_sjm)
	{
		$this->db->join('total_sjm', 'kalkulasi_sjm.id_sjm = total_sjm.id_sjm');
		$this->db->join('barang', 'kalkulasi_sjm.nama_barang = barang.nama_barang');
		$this->db->join('jenis', 'barang.id_jenis = jenis.id_jenis');
		$this->db->join('sub_jenis', 'barang.id_sub_jenis = sub_jenis.id_sub_jenis');
		$this->db->join('satuan', 'barang.id_satuan = satuan.id_satuan');
		$this->db->where('total_sjm.id_sjm', $id_sjm);
		$ambil = $this->db->get('kalkulasi_sjm');
		$data = $ambil->result_array();
		return $data;
	}

	function ambil_sjm($id_sjm) 
	{
		$this->db->join('lpb', 'surat_jalan_masuk.id_sjm = lpb.id_sjm');
		$this->db->where('lpb.id_sjm', $id_sjm);
		$ambil = $this->db->get('surat_jalan_masuk');
		$data = $ambil->row_array();
		return $data;
	}	

	function tambah_periksa($inputan)
	{
		$this->db->insert('pemeriksaan_barang', $inputan);
	}

	function minus_stok($inputan)
	{
		$this->db->join('lpb', 'pemeriksaan_barang.id_lpb = lpb.id_lpb', 'left');
		$this->db->join('surat_jalan_masuk', 'lpb.id_sjm = surat_jalan_masuk.id_sjm', 'left');
		$this->db->where('lpb.id_lpb', $inputan['id_lpb']);
		$ambil = $this->db->get('pemeriksaan_barang');
		$data = $ambil->row_array();

		$this->db->where('id_sjm', $data['id_sjm']);
		$sjm = $this->db->get('kalkulasi_sjm')->row_array();

		$this->db->where('nama_barang', $sjm['nama_barang']);
		$kpb = $this->db->get('barang')->row_array();

		if (!empty($data['tindakan']=="Dimusnahkan")) 
		{
			$id_barang['id_barang'] = $kpb['id_barang'];
			$total['stok'] = $kpb['stok'] - $data['qty_reject'];
			
			$this->db->where('id_barang', $id_barang['id_barang']);
			$this->db->update('barang', $total);

		}
		
	}

	function ambil_sjm_lpb($inputan)
	{

		$this->db->join('lpb', 'pemeriksaan_barang.id_lpb = lpb.id_lpb', 'left');
		$this->db->join('surat_jalan_masuk', 'lpb.id_sjm = surat_jalan_masuk.id_sjm', 'left');
		$this->db->where('lpb.id_lpb', $inputan['id_lpb']);
		$ambil = $this->db->get('pemeriksaan_barang');
		$data = $ambil->row_array();

		$this->db->where('id_sjm', $data['id_sjm']);
		$sjm = $this->db->get('kalkulasi_sjm')->row_array();

		$this->db->join('barang', 'kartu_persediaan_barang.id_barang = barang.id_barang', 'left');
		$this->db->where('barang.nama_barang', $sjm['nama_barang']);
		$kpb = $this->db->get('kartu_persediaan_barang')->row_array();

		$this->db->where('id_kpb', $kpb['id_kpb']);
		$bukti_kpb = $this->db->get('bukti_kpb')->row_array();

		$bukti_kpb = $this->db->query("SELECT * FROM bukti_kpb WHERE id_kpb='$kpb[id_kpb]' ORDER BY id_bukti_kpb DESC")->row_array();

		if (!empty($data['tindakan']=="Dimusnahkan")) 
		{
			$hasil['id_kpb'] = $kpb['id_kpb'];
			$hasil['tgl_masuk'] = $data['tgl_periksa'];
			$hasil['no_bukti'] = $data['no_pemeriksaan_barang'];
			$hasil['keterangan'] = $data['tindakan'];
			$hasil['qty_keluar'] = $data['qty_reject'];
			$hasil['saldo'] = $bukti_kpb['saldo']-$data['qty_reject'];
			$this->db->insert('bukti_kpb', $hasil);
		}

	}

	function ambil_sjm_lpb1($inputan)
	{
		$this->db->where('nama_barang', $inputan['nama_barang']);
		$ambil = $this->db->get('pemeriksaan_barang');
		$data = $ambil->row_array();

		$this->db->join('barang', 'kartu_persediaan_barang.id_barang = barang.id_barang', 'left');
		$this->db->where('barang.nama_barang', $data['nama_barang']);
		$kpb = $this->db->get('kartu_persediaan_barang')->row_array();

		$this->db->where('id_kpb', $kpb['id_kpb']);
		$bukti_kpb = $this->db->get('bukti_kpb')->row_array();

		$bukti_kpb = $this->db->query("SELECT * FROM bukti_kpb WHERE id_kpb='$kpb[id_kpb]' ORDER BY id_bukti_kpb DESC")->row_array();

		if (!empty($data['tindakan']=="Dimusnahkan")) 
		{
			$hasil['id_kpb'] = $kpb['id_kpb'];
			$hasil['tgl_masuk'] = $data['tgl_periksa'];
			$hasil['no_bukti'] = $data['no_pemeriksaan_barang'];
			$hasil['keterangan'] = $data['tindakan'];
			$hasil['qty_keluar'] = $data['qty_reject'];
			$hasil['saldo'] = $bukti_kpb['saldo']-$data['qty_reject'];
			$this->db->insert('bukti_kpb', $hasil);
		}

	}

	function kode_otomatis()
	{
		$this->db->select('LEFT(pemeriksaan_barang.no_pemeriksaan_barang,3) as kode', FALSE);
		$this->db->order_by('kode','DESC');    
		$this->db->limit(1);    
		$query = $this->db->get('pemeriksaan_barang');  //cek dulu apakah ada sudah ada kode di tabel.    
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
		$kodetampil = $no_urut."/QC/".$bulan."/".$tahun;  //format kode
		return $kodetampil;  
	}

	function cari_pemeriksaan($cari) 
	{
		$tgl_awal = $cari['tgl_awal'];
		$tgl_akhir = $cari['tgl_akhir'];

		$ambil = $this->db->query("SELECT id_pemeriksaan_barang, no_pemeriksaan_barang, no_lpb, tgl_periksa, qty_reject, tindakan, hasil_periksa, inspection_acceptable FROM pemeriksaan_barang JOIN lpb ON pemeriksaan_barang.id_lpb = lpb.id_lpb WHERE tgl_periksa BETWEEN '$tgl_awal' AND '$tgl_akhir'");
		$data = $ambil->result_array();
		
		$semua = array();
		foreach ($data as $key => $value)
		{
			$this->db->where('id_pemeriksaan_barang', $value['id_pemeriksaan_barang']);
			$ambil1 = $this->db->get('surat_jalan_keluar');
			$data1 = $ambil1->row_array();
			$value['periksa']=$data1;			
			$semua[] = $value;
		}

		return $semua;

	}

}
?>