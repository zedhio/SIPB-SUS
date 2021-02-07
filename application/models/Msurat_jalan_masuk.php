<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Msurat_jalan_masuk extends CI_Model 
{
	// Controller Penerimaan Barang fungsi detail dan Controller Surat Jalan Masuk untuk ubah atau detail
	function ambil_sjm($id_sjm)
	{
		$this->db->join('supplier', 'surat_jalan_masuk.id_supplier = supplier.id_supplier', 'left');
		$this->db->where('id_sjm', $id_sjm);
		$ambil = $this->db->get('surat_jalan_masuk');
		$data = $ambil->row_array();
		return $data;
	}
	// Controller Penerimaan Barang fungsi detail dan Controller Surat Jalan Masuk untuk ubah atau detail

	function tampil_sjm() 
	{
		$this->db->join('supplier', 'surat_jalan_masuk.id_supplier = supplier.id_supplier', 'left');
		$this->db->order_by('id_sjm', "desc");
		$ambil = $this->db->get('surat_jalan_masuk');
		$data = $ambil->result_array(); // menampilkan data banyak
		return $data;
	}
	// Controller surat jalan masuk fungsi index

	// Controller surat jalan masuk fungsi index (Pencarian Data)
	function cari_sjm($cari) 
	{
		$tgl_awal = $cari['tgl_awal'];
		$tgl_akhir = $cari['tgl_akhir'];

		$ambil = $this->db->query("SELECT id_sjm, no_sjm, tgl_masuk, keterangan, konfirmasi, nama_supplier FROM surat_jalan_masuk JOIN supplier ON surat_jalan_masuk.id_supplier = supplier.id_supplier WHERE tgl_masuk BETWEEN '$tgl_awal' AND '$tgl_akhir'");
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
	// Controller surat jalan masuk fungsi index

	// Controller surat jalan masuk fungsi index (Beri tanda terima)
	function ubah_ttd($id_sjm)
	{
		$data['konfirmasi']="Valid";
		$this->db->where('id_sjm', $id_sjm);
		$this->db->update('surat_jalan_masuk', $data);
	}
	// Controller surat jalan masuk fungsi index

	// Controller surat jalan masuk fungsi ubah selanjutnya dan detail
	function ambil_kalkulasi($id_sjm)
	{
		$this->db->join('barang', 'kalkulasi_sjm.nama_barang = barang.nama_barang', 'left');
		$this->db->join('jenis', 'barang.id_jenis = jenis.id_jenis', 'left');
		$this->db->join('sub_jenis', 'barang.id_sub_jenis = sub_jenis.id_sub_jenis', 'left');
		$this->db->join('satuan', 'barang.id_satuan = satuan.id_satuan', 'left');
		$this->db->where('id_sjm', $id_sjm);
		$ambil = $this->db->get('kalkulasi_sjm');
		$data = $ambil->result_array();
		return $data;
	}
	// Controller surat jalan masuk fungsi ubah selanjutnya dan detail

	// Controller surat jalan masuk fungsi radio untuk ubah record surat jalan masuk
	function detail_kalkulasi($id_sjm)
	{
		$this->db->join('barang', 'kalkulasi_sjm.nama_barang = barang.nama_barang', 'left');
		$this->db->join('jenis', 'barang.id_jenis = jenis.id_jenis', 'left');
		$this->db->join('sub_jenis', 'barang.id_sub_jenis = sub_jenis.id_sub_jenis', 'left');
		$this->db->join('satuan', 'barang.id_satuan = satuan.id_satuan', 'left');
		$this->db->where('id_kalkulasi_sjm', $id_sjm);
		$ambil = $this->db->get('kalkulasi_sjm');
		$data = $ambil->row_array();
		return $data;
	}
	// Controller surat jalan masuk fungsi radio untuk ubah record surat jalan masuk

	// Controller surat jalan masuk fungsi detail untuk detail surat jalan masuk
	function ambil_total($id_sjm)
	{
		$this->db->where('id_sjm', $id_sjm);
		$ambil = $this->db->get('total_sjm');
		$data = $ambil->row_array();
		return $data;
	}
	// Controller surat jalan masuk fungsi detail untuk detail surat jalan masuk

	// Controller surat jalan masuk fungsi tambah dan tambah selanjutnya untuk memnambah data surat jalan masuk
	function tambah_sjm($surat_jalan_masuk, $barang) 
	{

		$total = 0;

		foreach ($barang as $key => $value) {
			$total+=$value['qty_sjm'];
		}

		$total_sjm['qty_total'] = $total;

		$this->db->insert('surat_jalan_masuk', $surat_jalan_masuk);

		$total_sjm['id_sjm'] = $this->db->insert_id('surat_jalan_masuk');

		// memasukkan nilai array total_sjm ke tabel total_sjm 
		$this->db->insert('total_sjm', $total_sjm);

		// perulangan untuk menyimpan nilai dari value barang ke tabel kalkulasi_sjm
		foreach ($barang as $key => $value)
		{
			$data['id_sjm'] = $total_sjm['id_sjm'];
			$data['nama_barang'] = $value['nama_barang'];
			$data['qty_sjm'] = $value['qty_sjm'];
			$data['ukuran'] = $value['ukuran'];

			// memasukkan nilai array variabel data ke tabel kalkulasi_sjm
			$this->db->insert('kalkulasi_sjm', $data);
		}
		
	}
	// Controller surat jalan masuk fungsi tambah dan tambah selanjutnya untuk memnambah data surat jalan masuk

	// Controller surat jalan masuk fungsi ubah selanjutnya untuk kalkulasi record surat jalan masuk
	function ubah_kalkulasi_sjm($inputan,$id_kalkulasi_sjm,$id_sjm)
	{
		$this->db->where('id_kalkulasi_sjm', $id_kalkulasi_sjm);
		$this->db->update('kalkulasi_sjm', $inputan);

		$data_kalkulasi = $this->ambil_kalkulasi($id_sjm);
		$total_sjm = 0;
		foreach ($data_kalkulasi as $key => $value)
		{
			$total_sjm+=$value['qty_sjm'];
		}

		$hasil['qty_total'] = $total_sjm;

		$this->db->where('id_sjm',$id_sjm);
		$this->db->update('total_sjm', $hasil);
	}
	// Controller surat jalan masuk fungsi ubah selanjutnya untuk kalkulasi record surat jalan masuk

	// Controller surat jalan masuk fungsi ubah untuk mengubah data surat jalan masuk
	function ubah_sjm($data,$sjm)
	{
		$this->db->where('id_sjm', $sjm);
		$this->db->update('surat_jalan_masuk', $data);		
	}
	// Controller surat jalan masuk fungsi ubah untuk mengubah data surat jalan masuk

	function hapus_sjm($id_sjm)
	{
		//menghapus berdasarkan id_sjm dari tiga tabel
		$this->db->where('id_sjm', $id_sjm);
		$this->db->delete('surat_jalan_masuk');

		$this->db->where('id_sjm', $id_sjm);
		$this->db->delete('kalkulasi_sjm');

		$this->db->where('id_sjm', $id_sjm);
		$this->db->delete('total_sjm');
	}

	function kode_otomatis()
	{
		$this->db->select('LEFT(surat_jalan_masuk.no_sjm,3) as kode', FALSE);
		$this->db->order_by('kode','DESC');    
		$this->db->limit(1);    
		$query = $this->db->get('surat_jalan_masuk');  //cek dulu apakah ada sudah ada kode di tabel.    
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
		$tahun = substr(date('Y'), 0, 4);
		$kodetampil = $no_urut."/SJM/".$bulan."/".$tahun;  //format kode
		return $kodetampil;  
	}

}
?>