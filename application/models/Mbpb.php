<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mbpb extends CI_Model 
{
	function tampil_bpb()
	{
		$this->db->join('production_order', 'bpb.id_po = production_order.id_po', 'left');
		$this->db->join('buyer', 'production_order.id_buyer = buyer.id_buyer', 'left');
		$this->db->join('style_glove', 'production_order.id_style_glove = style_glove.id_style_glove', 'left');
		$ambil = $this->db->get('bpb');
		$data = $ambil->result_array();

		$semua = array();
		foreach ($data as $key => $value)
		{
			$this->db->where('status_pengajuan', 'Disetujui');
			$this->db->where('id_bpb', $value['id_bpb']);
			$ambil1 = $this->db->get('validasi_bpb');
			$data1 = $ambil1->result_array();
			$value['validasi'] = count($data1);	

			$this->db->where('id_bpb', $value['id_bpb']);
			$ambil1 = $this->db->get('validasi_bpb');
			$data1 = $ambil1->result_array();
			$value['validasi11'] = $data1;
			$value['validasi1'] = count($data1);

			$this->db->where('status_pengajuan', 'Ditolak');
			$this->db->where('id_bpb', $value['id_bpb']);
			$ambil1 = $this->db->get('validasi_bpb');
			$data1 = $ambil1->result_array();
			$value['validasi2'] = count($data1);

			$this->db->where('id_bpb', $value['id_bpb']);
			$ambil1 = $this->db->get('distribusi_bpb');
			$data1 = $ambil1->result_array();
			$value['distribusi'] = $data1;

			$semua[] = $value;
		}

		return $semua;
	}

	function kirim_bpb($data)
	{
		foreach ($data['tujuan'] as $key => $value)
		{
			$hasil['id_bpb'] = $data['id_bpb'];
			$hasil['asal'] = $data['asal'];
			$hasil['tujuan'] = $value;
			$hasil['tgl_diterima'] = $data['tgl_diterima'];
			$this->db->insert('distribusi_bpb',$hasil);
		}
	}

	function tampil_bpb_user() 
	{
		$ambil = $this->db->get('bpb');
		$data = $ambil->result_array();

		$semua = array();
		foreach ($data as $key => $value) {
			$this->db->join('buyer', 'production_order.id_buyer = buyer.id_buyer');
			$this->db->join('style_glove', 'production_order.id_style_glove = style_glove.id_style_glove');
			$this->db->where('id_po', $value['id_po']);
			$ambil1 = $this->db->get('production_order');
			$data1 = $ambil1->row_array();
			$value['po'] = $data1;

			$this->db->where('id_bpb', $value['id_bpb']);
			$ambil2 = $this->db->get('validasi_bpb');
			$data2 = $ambil2->result_array();
			$value['validasi'] = $data2;

			$semua[] = $value;
		}
		
		return $semua;
	}

	function konfirmasi_persetujuan_bpb($id_bpb,$id_val_bpb,$inputan)
	{
		$this->db->where('status_pengajuan', 'Disetujui');
		$this->db->where('id_bpb', $id_bpb);
		$ambil = $this->db->get('validasi_bpb')->num_rows();
		
		if($ambil>=2)
		{
			$this->db->join('production_order', 'bpb.id_po = production_order.id_po', 'left');
			$this->db->where('id_bpb', $id_bpb);
			$ambil = $this->db->get('bpb');
			$data = $ambil->row_array();

			$this->db->where('id_bpb', $data['id_bpb']);
			$bpb = $this->db->get('kalkulasi_bpb')->result_array();

			$semua = array();
			foreach ($bpb as $key => $value)
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

			foreach ($semua_nya as $key => $value)
			{
				$hasil['id_kpb'] = $value['id_kpb'];
				$hasil['tgl_masuk'] = $data['tgl_dibuat'];
				$hasil['no_bukti'] = $data['no_bpb'];
				$hasil['keterangan'] = "BPB /".$data['nama_po']." ".$data['no_po'];
				$hasil['qty_keluar'] = $value['qty_bpb'];
				$hasil['saldo'] = $value['bukti']['saldo']-$value['qty_bpb'];

				$this->db->insert('bukti_kpb', $hasil);
			}
		}

		$status['status_pengajuan'] = "Disetujui";
		$status['tgl_dikonfirmasi'] = $inputan['tgl_dikonfirmasi'];
		$this->db->where('id_val_bpb', $id_val_bpb);
		$this->db->update('validasi_bpb', $status);
	}

	function konfirmasi_persetujuan_bpb_tolak($id_bpb,$data)
	{
		$data['status_pengajuan']="Ditolak";
		$this->db->where('id_val_bpb', $id_bpb);
		$this->db->update('validasi_bpb', $data);
	}

	function ambil_po($id_po)
	{
		$this->db->join('buyer', 'production_order.id_buyer = buyer.id_buyer', 'left');
		$this->db->join('style_glove', 'production_order.id_style_glove = style_glove.id_style_glove', 'left');
		$this->db->order_by("tgl_order", "desc");
		$this->db->where('id_po', $id_po);
		$ambil = $this->db->get('production_order');
		$data = $ambil->row_array();

		return $data;
	}

	function ambil_reject($id_po)
	{
		$this->db->where('id_po', $id_po);
		$ambil = $this->db->get('reject_barang_produksi');
		$data = $ambil->row_array();

		return $data;
	}

	function ambil_bpb($id_bpb)
	{
		$this->db->join('production_order', 'bpb.id_po = production_order.id_po', 'left');
		$this->db->join('buyer', 'production_order.id_buyer = buyer.id_buyer', 'left');
		$this->db->join('style_glove', 'production_order.id_style_glove = style_glove.id_style_glove', 'left');
		$this->db->where('id_bpb', $id_bpb);
		$ambil = $this->db->get('bpb');
		$data = $ambil->row_array();
		
		$this->db->where('id_bpb', $data['id_bpb']);
		$ambil1 = $this->db->get('validasi_bpb');
		$data1 = $ambil1->result_array();
		$data['validasi'] = $data1;

		$this->db->where('status_pengajuan', 'Disetujui');
		$this->db->where('id_bpb', $data['id_bpb']);
		$ambil1 = $this->db->get('validasi_bpb');
		$data1 = $ambil1->result_array();
		$data['count_agree'] = count($data1);

		return $data;

	}

	function ambil_kalkulasi($id_bpb)
	{
		$this->db->join('barang', 'kalkulasi_bpb.nama_barang = barang.nama_barang', 'left');
		$this->db->join('jenis', 'barang.id_jenis = jenis.id_jenis', 'left');
		$this->db->join('sub_jenis', 'barang.id_sub_jenis = sub_jenis.id_sub_jenis', 'left');
		$this->db->join('satuan', 'barang.id_satuan = satuan.id_satuan', 'left');
		$this->db->where('id_bpb', $id_bpb);
		$ambil = $this->db->get('kalkulasi_bpb');
		$data = $ambil->result_array();
		return $data;
	}

	function ambil_bon($id_po)
	{
		$this->db->where('id_po', $id_po);
		$ambil = $this->db->get('bon');
		$data = $ambil ->result_array();

		$semua = array();
		foreach ($data as $key => $value) {
			$this->db->where('id_bon', $value['id_bon']);
			$ambil1 = $this->db->get('kalkulasi_bon');
			$data1 = $ambil1->result_array();

			$hasil = array();
			foreach ($data1 as $no => $isi) {
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

			$value['kalkulasi_bon'] = $hasil;

			$semua[] = $value;
		}

		return $semua;
	}

	function tambah_bpb($inputan, $id_po)
	{

		$this->db->insert('bpb', $inputan);
		$bpb['id_bpb'] = $this->db->insert_id('bpb');

		$kalkulasi_bpb = $this->ambil_bon($id_po);

		foreach ($kalkulasi_bpb as $key => $value) {
			foreach ($value['kalkulasi_bon'] as $kunci => $values) {
				$inputan1['qty_bon'] = $values['qty_bon'];
				if (empty($values['remaks'])) {
					foreach ($values['barang'] as $keys => $isi) {
						$input['id_bpb'] = $bpb['id_bpb'];
						$input['nama_barang'] = $isi['nama_barang'];
						$input['qty_bpb'] = $inputan1['qty_bon'];
						
						$this->db->insert('kalkulasi_bpb', $input);
					}
				}
			}
		}
	}

	function kode_otomatis()
	{
		$this->db->select('LEFT(bpb.no_bpb,2) as kode', FALSE);
		$this->db->order_by('kode','DESC');    
		$this->db->limit(1);    
		$query = $this->db->get('bpb');  //cek dulu apakah ada sudah ada kode di tabel.    
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
		$kodetampil = $no_urut."/WH/SUS/".$romawi[date('n')]."/".$tahun;  //format kode
		return $kodetampil;  
	}

	function cari_bpb($cari) 
	{
		$tgl_awal = $cari['tgl_awal'];
		$tgl_akhir = $cari['tgl_akhir'];

		$ambil = $this->db->query("SELECT id_bpb, no_bpb, tgl_dibuat, bagian, no_po, nama_po, nama_buyer, nama_style FROM bpb JOIN production_order ON bpb.id_po = production_order.id_po JOIN buyer ON production_order.id_buyer = buyer.id_buyer JOIN style_glove ON production_order.id_style_glove = style_glove.id_style_glove WHERE tgl_dibuat BETWEEN '$tgl_awal' AND '$tgl_akhir'");
		$data = $ambil->result_array();

		$semua = array();
		
		foreach ($data as $key => $value)
		{
			$this->db->where('status_pengajuan', 'Disetujui');
			$this->db->where('id_bpb', $value['id_bpb']);
			$ambil1 = $this->db->get('validasi_bpb');
			$data1 = $ambil1->result_array();
			$value['count_agree'] = count($data1);

			$this->db->where('status_pengajuan', 'Disetujui');
			$this->db->where('id_bpb', $value['id_bpb']);
			$ambil1 = $this->db->get('validasi_bpb');
			$data1 = $ambil1->result_array();
			$value['validasi'] = count($data1);	

			$this->db->where('id_bpb', $value['id_bpb']);
			$ambil1 = $this->db->get('validasi_bpb');
			$data1 = $ambil1->result_array();
			$value['validasi11'] = $data1;
			$value['validasi1'] = count($data1);

			$this->db->where('status_pengajuan', 'Ditolak');
			$this->db->where('id_bpb', $value['id_bpb']);
			$ambil1 = $this->db->get('validasi_bpb');
			$data1 = $ambil1->result_array();
			$value['validasi2'] = count($data1);

			$this->db->where('id_bpb', $value['id_bpb']);
			$ambil1 = $this->db->get('distribusi_bpb');
			$data1 = $ambil1->result_array();
			$value['distribusi'] = $data1;

			$semua[] = $value;
		}

		return $semua;
	}

	function cari_lap_bpb($cari) 
	{
		$tgl_awal = $cari['tgl_awal'];
		$tgl_akhir = $cari['tgl_akhir'];

		$ambil = $this->db->query("SELECT id_bpb, no_bpb, tgl_dibuat, no_po, nama_po, nama_buyer, nama_style FROM bpb JOIN production_order ON bpb.id_po = production_order.id_po JOIN buyer ON production_order.id_buyer = buyer.id_buyer JOIN style_glove ON production_order.id_style_glove = style_glove.id_style_glove WHERE tgl_dibuat BETWEEN '$tgl_awal' AND '$tgl_akhir'");
		$data = $ambil->result_array();

		$semua = array();
		
		foreach ($data as $key => $value)
		{
			$this->db->where('status_pengajuan', 'Disetujui');
			$this->db->where('id_bpb', $value['id_bpb']);
			$ambil1 = $this->db->get('validasi_bpb');
			$data1 = $ambil1->result_array();
			$value['count_agree'] = count($data1);

			$this->db->where('id_bpb', $value['id_bpb']);
			$ambil1 = $this->db->get('distribusi_bpb');
			$data1 = $ambil1->result_array();
			$value['distribusi'] = $data1;

			$semua[] = $value;
		}		

		return $semua;
	}

	function cari_val_bpb($cari) 
	{
		$tgl_awal = $cari['tgl_awal'];
		$tgl_akhir = $cari['tgl_akhir'];

		$ambil = $this->db->query("SELECT id_bpb, no_bpb, id_po FROM bpb ");
		$data = $ambil->result_array();

		$semua = array();
		foreach ($data as $key => $value) {
			$this->db->join('buyer', 'production_order.id_buyer = buyer.id_buyer');
			$this->db->join('style_glove', 'production_order.id_style_glove = style_glove.id_style_glove');
			$this->db->where('id_po', $value['id_po']);
			$ambil1 = $this->db->get('production_order');
			$data1 = $ambil1->row_array();
			$value['po'] = $data1;

			$this->db->where('tgl_diajukan AND tgl_dikonfirmasi BETWEEN "'. date('Y-m-d', strtotime($tgl_awal)). '" and "'. date('Y-m-d', strtotime($tgl_akhir)).'"');
			$this->db->where('id_bpb', $value['id_bpb']);
			$ambil2 = $this->db->get('validasi_bpb');
			$data2 = $ambil2->result_array();
			$value['validasi'] = $data2;

			$semua[] = $value;

		}		

		return $semua;
	}

	function pengajuan_bpb($data)
	{

		foreach ($data['tujuan'] as $key => $value)
		{
			$hasil['id_bpb'] = $data['id_bpb'];
			$hasil['yang_meminta'] = $data['yang_meminta'];
			$hasil['tujuan'] = $value;
			$hasil['perihal'] = $data['perihal'];
			$hasil['tgl_diajukan'] = $data['tgl_diajukan'];

			$this->db->insert('validasi_bpb',$hasil);
		}
	}

	function status_alasan($id_bpb)
	{
		// $this->db->join('lpb', 'validasi_lpb.id_lpb = lpb.id_lpb', 'left');
		$this->db->where('id_bpb', $id_bpb);
		$ambil = $this->db->get('validasi_bpb');
		$data = $ambil->result_array();
		return $data;	
	}

	function tampil_laporan_bpb() 
	{
		$this->db->join('production_order', 'bpb.id_po = production_order.id_po', 'left');
		$this->db->join('buyer', 'production_order.id_buyer = buyer.id_buyer', 'left');
		$this->db->join('style_glove', 'production_order.id_style_glove = style_glove.id_style_glove', 'left');
		$ambil = $this->db->get('bpb');
		$data = $ambil->result_array(); // menampilkan data banyak
		$semua = array();
		
		foreach ($data as $key => $value)
		{
			$this->db->where('id_bpb', $value['id_bpb']);
			$ambil1 = $this->db->get('distribusi_bpb');
			$data1 = $ambil1->result_array();
			$value['distribusi'] = $data1;

			$semua[] = $value;
		}

		return $semua;
	}


	function tampil_laporan_bpb_admin() 
	{
		$this->db->join('production_order', 'bpb.id_po = production_order.id_po', 'left');
		$this->db->join('buyer', 'production_order.id_buyer = buyer.id_buyer', 'left');
		$this->db->join('style_glove', 'production_order.id_style_glove = style_glove.id_style_glove', 'left');
		$ambil = $this->db->get('bpb');
		$data = $ambil->result_array(); // menampilkan data banyak
		$semua = array();
		
		foreach ($data as $key => $value)
		{
			$this->db->where('status_pengajuan', 'Disetujui');
			$this->db->where('id_bpb', $value['id_bpb']);
			$ambil1 = $this->db->get('validasi_bpb');
			$data1 = $ambil1->result_array();
			$value['count_agree'] = count($data1);

			$this->db->where('id_bpb', $value['id_bpb']);
			$ambil1 = $this->db->get('distribusi_bpb');
			$data1 = $ambil1->result_array();
			$value['distribusi'] = $data1;

			$semua[] = $value;
		}

		return $semua;
	}

	function tampil_rekap_bpb()
	{
		$this->db->group_by("tgl_dibuat");
		$ambil = $this->db->get('bpb');
		$data = $ambil->result_array();

		$semua = array();
		foreach ($data as $key => $value)
		{
			$this->db->where('id_bpb', $value['id_bpb']);
			$ambil0 = $this->db->get('distribusi_bpb');
			$data0 = $ambil0->num_rows();
			$value['distribusi'] = $data0;

			$this->db->join('bpb', 'kalkulasi_bpb.id_bpb = bpb.id_bpb', 'left');
			$this->db->join('production_order', 'bpb.id_po = production_order.id_po', 'left');
			$this->db->join('buyer', 'production_order.id_buyer = buyer.id_buyer', 'left');
			$this->db->join('style_glove', 'production_order.id_style_glove = style_glove.id_style_glove', 'left');
			$this->db->where('bpb.id_bpb', $value['id_bpb']);
			$ambil1 = $this->db->get('kalkulasi_bpb');
			$data1 = $ambil1->result_array();
			$value['kalkulasi']=$data1;		

			$this->db->where('status_pengajuan', 'Disetujui');
			$this->db->where('id_bpb', $value['id_bpb']);
			$ambil1 = $this->db->get('validasi_bpb');
			$data1 = $ambil1->result_array();
			$value['count_agree'] = count($data1);

			$semua[] = $value;
		}

		return $semua;

	}

	function cari_rekap_bpb($cari) 
	{
		$bulan = $cari['bulan'];
		$tahun = $cari['tahun'];

		$semua=array();

		$ambil = $this->db->query("SELECT id_bpb, tgl_dibuat FROM bpb WHERE MONTH(tgl_dibuat) = '$bulan' AND YEAR(tgl_dibuat) = '$tahun' GROUP BY 'tgl_dibuat'");
		$array = $ambil->result_array();

		foreach ($array as $key => $value)
		{	
			$this->db->join('bpb', 'kalkulasi_bpb.id_bpb = bpb.id_bpb', 'left');
			$this->db->join('production_order', 'bpb.id_po = production_order.id_po', 'left');
			$this->db->join('buyer', 'production_order.id_buyer = buyer.id_buyer', 'left');
			$this->db->join('style_glove', 'production_order.id_style_glove = style_glove.id_style_glove', 'left');
			$this->db->where('bpb.id_bpb', $value['id_bpb']);
			$ambil1 = $this->db->get('kalkulasi_bpb');
			$data1 = $ambil1->result_array();
			$value['kalkulasi']=$data1;

			$this->db->where('status_pengajuan', 'Disetujui');
			$this->db->where('id_bpb', $value['id_bpb']);
			$ambil1 = $this->db->get('validasi_bpb');
			$data1 = $ambil1->result_array();
			$value['count_agree'] = count($data1);

			$semua[] = $value;
		}

		return $semua;

	}

	function hapus($id_bpb)
	{
		$this->db->where('id_bpb', $id_bpb);
		$this->db->delete('bpb');

		$this->db->where('id_bpb', $id_bpb);
		$this->db->delete('kalkulasi_bpb');
	}

	// ---------------------------- Notif Validasi BPB Kepala Unit Sewing ----------------------------
	function hitung_val_bpb_kus()
	{
		$this->db->join('validasi_bpb', 'bpb.id_bpb = validasi_bpb.id_bpb', 'left');
		$this->db->where('tujuan', 'Kepala Unit Sewing');
		$this->db->where('status_pesan', '0');
		$ambil = $this->db->get('bpb');
		$data = $ambil->result_array();

		return $data;
	}

	function data_val_bpb_kus()
	{
		$this->db->join('validasi_bpb', 'bpb.id_bpb = validasi_bpb.id_bpb', 'left');
		$this->db->where('tujuan', 'Kepala Unit Sewing');
		$this->db->where('status_pesan', '0');
		$ambil = $this->db->get('bpb');
		$data = $ambil->row_array();

		return $data;
	}

	function ubah_status_val_bpb_kus($id_val_bpb)
	{
		$input['status_pesan'] = 1;
		$this->db->where('id_val_bpb', $id_val_bpb);
		$this->db->update('validasi_bpb', $input);
	}
	// ---------------------------- Notif Validasi BPB Kepala Unit Sewing ----------------------------

	// ---------------------------- Notif Validasi BPB Kepala Gudang ----------------------------
	function hitung_val_bpb_kg()
	{
		$this->db->join('validasi_bpb', 'bpb.id_bpb = validasi_bpb.id_bpb', 'left');
		$this->db->where('tujuan', 'Kepala Gudang');
		$this->db->where('status_pesan', '0');
		$ambil = $this->db->get('bpb');
		$data = $ambil->result_array();

		return $data;
	}

	function data_val_bpb_kg()
	{
		$this->db->join('validasi_bpb', 'bpb.id_bpb = validasi_bpb.id_bpb', 'left');
		$this->db->where('tujuan', 'Kepala Gudang');
		$this->db->where('status_pesan', '0');
		$ambil = $this->db->get('bpb');
		$data = $ambil->row_array();

		return $data;
	}

	function ubah_status_val_bpb_kg($id_val_bpb)
	{
		$input['status_pesan'] = 1;
		$this->db->where('id_val_bpb', $id_val_bpb);
		$this->db->update('validasi_bpb', $input);
	}
	// ---------------------------- Notif Validasi BPB Kepala Gudang ----------------------------

	// ---------------------------- Notif Validasi BPB Kepala Divisi Production Manager ----------------------------
	function hitung_val_bpb_kdpm()
	{
		$this->db->join('validasi_bpb', 'bpb.id_bpb = validasi_bpb.id_bpb', 'left');
		$this->db->where('tujuan', 'Kepala Divisi Production Manager');
		$this->db->where('status_pesan', '0');
		$ambil = $this->db->get('bpb');
		$data = $ambil->result_array();

		return $data;
	}

	function data_val_bpb_kdpm()
	{
		$this->db->join('validasi_bpb', 'bpb.id_bpb = validasi_bpb.id_bpb', 'left');
		$this->db->where('tujuan', 'Kepala Divisi Production Manager');
		$this->db->where('status_pesan', '0');
		$ambil = $this->db->get('bpb');
		$data = $ambil->row_array();

		return $data;
	}

	function ubah_status_val_bpb_kdpm($id_val_bpb)
	{
		$input['status_pesan'] = 1;
		$this->db->where('id_val_bpb', $id_val_bpb);
		$this->db->update('validasi_bpb', $input);
	}
	// ---------------------------- Notif Validasi BPB Kepala Divisi Production Manager ----------------------------

	// ---------------------------- Notif Distribusi BPB Kepala Divisi Purchase Order ----------------------------
	function hitung_dis_bpb_kdpo()
	{
		$this->db->join('distribusi_bpb', 'bpb.id_bpb = distribusi_bpb.id_bpb', 'left');
		$this->db->where('tujuan', 'Kepala Divisi Purchase Order');
		$this->db->where('status_pesan', '0');
		$ambil = $this->db->get('bpb');
		$data = $ambil->result_array();

		return $data;
	}

	function data_dis_bpb_kdpo()
	{
		$this->db->join('distribusi_bpb', 'bpb.id_bpb = distribusi_bpb.id_bpb', 'left');
		$this->db->join('production_order', 'bpb.id_po = production_order.id_po', 'left');
		$this->db->where('tujuan', 'Kepala Divisi Purchase Order');
		$this->db->where('status_pesan', '0');
		$ambil = $this->db->get('bpb');
		$data = $ambil->row_array();

		return $data;
	}

	function ubah_status_dis_bpb_kdpo($id_distribusi_bpb)
	{
		$input['status_pesan'] = 1;
		$this->db->where('id_distribusi_bpb', $id_distribusi_bpb);
		$this->db->update('distribusi_bpb', $input);
	}
	// ---------------------------- Notif Distribusi BPB Kepala Divisi Purchase Order ----------------------------

	// ---------------------------- Notif Distribusi BPB Kepala Divisi Accounting ----------------------------
	function hitung_dis_bpb_kda()
	{
		$this->db->join('distribusi_bpb', 'bpb.id_bpb = distribusi_bpb.id_bpb', 'left');
		$this->db->where('tujuan', 'Kepala Divisi Accounting');
		$this->db->where('status_pesan', '0');
		$ambil = $this->db->get('bpb');
		$data = $ambil->result_array();

		return $data;
	}

	function data_dis_bpb_kda()
	{
		$this->db->join('distribusi_bpb', 'bpb.id_bpb = distribusi_bpb.id_bpb', 'left');
		$this->db->join('production_order', 'bpb.id_po = production_order.id_po', 'left');
		$this->db->where('tujuan', 'Kepala Divisi Accounting');
		$this->db->where('status_pesan', '0');
		$ambil = $this->db->get('bpb');
		$data = $ambil->row_array();

		return $data;
	}

	function ubah_status_dis_bpb_kda($id_distribusi_bpb)
	{
		$input['status_pesan'] = 1;
		$this->db->where('id_distribusi_bpb', $id_distribusi_bpb);
		$this->db->update('distribusi_bpb', $input);
	}
	// ---------------------------- Notif Distribusi BPB Kepala Divisi Accounting ----------------------------

	// ---------------------------- Notif Distribusi BPB Direktur ----------------------------
	function hitung_dis_bpb_direk()
	{
		$this->db->join('distribusi_bpb', 'bpb.id_bpb = distribusi_bpb.id_bpb', 'left');
		$this->db->where('tujuan', 'Direktur');
		$this->db->where('status_pesan', '0');
		$ambil = $this->db->get('bpb');
		$data = $ambil->result_array();

		return $data;
	}

	function data_dis_bpb_direk()
	{
		$this->db->join('distribusi_bpb', 'bpb.id_bpb = distribusi_bpb.id_bpb', 'left');
		$this->db->join('production_order', 'bpb.id_po = production_order.id_po', 'left');
		$this->db->where('tujuan', 'Direktur');
		$this->db->where('status_pesan', '0');
		$ambil = $this->db->get('bpb');
		$data = $ambil->row_array();

		return $data;
	}

	function ubah_status_dis_bpb_direk($id_distribusi_bpb)
	{
		$input['status_pesan'] = 1;
		$this->db->where('id_distribusi_bpb', $id_distribusi_bpb);
		$this->db->update('distribusi_bpb', $input);
	}
	// ---------------------------- Notif Distribusi BPB Direk ----------------------------
	
	// ---------------------------- Notif Hasil Validasi BPB Kepala Unit Sewing ----------------------------
	function hitung_hasil_val_bpb_kus()
	{
		$this->db->join('validasi_bpb', 'bpb.id_bpb = validasi_bpb.id_bpb', 'left');
		$this->db->where('tujuan', 'Kepala Unit Sewing');
		$this->db->where('status_pesan', '1');
		$this->db->where('status_hasil', '0');
		$ambil = $this->db->get('bpb');
		$data = $ambil->result_array();

		return $data;
	}

	function data_hasil_val_bpb_kus()
	{
		$this->db->join('validasi_bpb', 'bpb.id_bpb = validasi_bpb.id_bpb', 'left');
		$this->db->where('tujuan', 'Kepala Unit Sewing');
		$this->db->where('status_pesan', '1');
		$this->db->where('status_hasil', '0');
		$ambil = $this->db->get('bpb');
		$data = $ambil->row_array();

		return $data;
	}

	function ubah_status_hasil_val_bpb_kus($id_val_bpb)
	{
		$input['status_hasil'] = 1;
		$this->db->where('id_val_bpb', $id_val_bpb);
		$this->db->update('validasi_bpb', $input);
	}
	// ---------------------------- Notif Hasil Validasi BPB Kepala Unit Sewing ----------------------------

	// ---------------------------- Notif Hasil Validasi BPB Kepala Gudang ----------------------------
	function hitung_hasil_val_bpb_kg()
	{
		$this->db->join('validasi_bpb', 'bpb.id_bpb = validasi_bpb.id_bpb', 'left');
		$this->db->where('tujuan', 'Kepala Gudang');
		$this->db->where('status_pesan', '1');
		$this->db->where('status_hasil', '0');
		$ambil = $this->db->get('bpb');
		$data = $ambil->result_array();

		return $data;
	}

	function data_hasil_val_bpb_kg()
	{
		$this->db->join('validasi_bpb', 'bpb.id_bpb = validasi_bpb.id_bpb', 'left');
		$this->db->where('tujuan', 'Kepala Gudang');
		$this->db->where('status_pesan', '1');
		$this->db->where('status_hasil', '0');
		$ambil = $this->db->get('bpb');
		$data = $ambil->row_array();

		return $data;
	}

	function ubah_status_hasil_val_bpb_kg($id_val_bpb)
	{
		$input['status_hasil'] = 1;
		$this->db->where('id_val_bpb', $id_val_bpb);
		$this->db->update('validasi_bpb', $input);
	}
	// ---------------------------- Notif Hasil Validasi BPB Kepala Gudang ----------------------------

	// ---------------------------- Notif Hasil Validasi BPB Kepala Divisi Production Manager ----------------------------
	function hitung_hasil_val_bpb_kdpm()
	{
		$this->db->join('validasi_bpb', 'bpb.id_bpb = validasi_bpb.id_bpb', 'left');
		$this->db->where('tujuan', 'Kepala Divisi Production Manager');
		$this->db->where('status_pesan', '1');
		$this->db->where('status_hasil', '0');
		$ambil = $this->db->get('bpb');
		$data = $ambil->result_array();

		return $data;
	}

	function data_hasil_val_bpb_kdpm()
	{
		$this->db->join('validasi_bpb', 'bpb.id_bpb = validasi_bpb.id_bpb', 'left');
		$this->db->where('tujuan', 'Kepala Divisi Production Manager');
		$this->db->where('status_pesan', '1');
		$this->db->where('status_hasil', '0');
		$ambil = $this->db->get('bpb');
		$data = $ambil->row_array();

		return $data;
	}

	function ubah_status_hasil_val_bpb_kdpm($id_val_bpb)
	{
		$input['status_hasil'] = 1;
		$this->db->where('id_val_bpb', $id_val_bpb);
		$this->db->update('validasi_bpb', $input);
	}
	// ---------------------------- Notif Hasil Validasi BPB Kepala Divisi Production Manager ----------------------------

}
?>