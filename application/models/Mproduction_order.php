<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mproduction_order extends CI_Model 
{

    // ----------------- Model Untuk Production Order -----------------

	function hitung_val_po()
	{
		$ambil = $this->db->get('validasi_po');
		$data = $ambil->result_array(); // menampilkan data banyak

		// $semua = array();
		// foreach ($data as $key => $value)
		// {
			// $this->db->where('id_po', $value['id_po']);
			// $ambil1 = $this->db->get('validasi_po');
			// $data1 = $ambil1->result_array();
			// $value['validasi'] = $data1;			

			// $this->db->where('status_pengajuan', 'Disetujui');
			// $this->db->where('status_pesan', "1");
			// $this->db->where('status_hasil', "1");
			// $this->db->where('id_po', $value['id_po']);
			// $ambil1 = $this->db->get('validasi_po');
			// $data1 = $ambil1->result_array();
			// $value['validasi1'] = $data1;

			// $this->db->where('status_pengajuan', 'Ditolak');
			// $this->db->where('id_po', $value['id_po']);
			// $ambil1 = $this->db->get('validasi_po');
			// $data1 = $ambil1->result_array();
			// $value['validasi2'] = count($data1);

		// 	$semua[] = $value;
		// }

		return $data;
	}

	function tampil_ppic($ppic)
	{
		foreach ($ppic as $key => $value)
		{
			$this->db->where('nama_barang', $value['nama_barang']);

			$data = $this->db->get('barang')->row_array();

			$this->db->where('nama_barang', $data['nama_barang']);
			$data1 = $this->db->get('barang')->row_array();
			$value['detail'] = $data1;

			$this->db->where('id_supplier', $value['id_supplier']);
			$data2 = $this->db->get('supplier')->row_array();
			$value['supplier'] = $data2;				

			$semua[] = $value;
		}

		return $semua;
	}

	function simpan_session($input)
	{
		$config['upload_path'] 	= './assets/images/foto_glove';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size']      = 2048;
		
		$this->load->library('upload', $config);
		
		$this->upload->do_upload('foto_glove');

		$input['foto'] = $this->upload->data('file_name');

		$_SESSION['picture_packing_printing_remark'][] = $input;
	}

	function tampil_production_order() 
	{
		$this->db->join('buyer', 'production_order.id_buyer = buyer.id_buyer', 'left');
		$this->db->join('style_glove', 'production_order.id_style_glove = style_glove.id_style_glove', 'left');
		$this->db->order_by("id_po", "desc");
		$ambil = $this->db->get('production_order');
		$data = $ambil->result_array(); // menampilkan data banyak
		$semua = array();
		foreach ($data as $key => $value)
		{
			$this->db->where('id_po', $value['id_po']);
			$ambil1 = $this->db->get('distribusi_po');
			$data1 = $ambil1->result_array();
			$value['distribusi'] = $data1;

			$this->db->where('id_po', $value['id_po']);
			$ambil1 = $this->db->get('validasi_po');
			$data1 = $ambil1->result_array();
			$value['validasi'] = $data1;			

			$this->db->where('status_pengajuan', 'Disetujui');
			$this->db->where('id_po', $value['id_po']);
			$ambil1 = $this->db->get('validasi_po');
			$data1 = $ambil1->result_array();
			$value['validasi1'] = count($data1);

			$this->db->where('status_pengajuan', 'Ditolak');
			$this->db->where('id_po', $value['id_po']);
			$ambil1 = $this->db->get('validasi_po');
			$data1 = $ambil1->result_array();
			$value['validasi2'] = count($data1);

			$semua[] = $value;
		}

		return $semua;
	}

	function kirim_po($data)
	{

		foreach ($data['tujuan'] as $key => $value)
		{
			$hasil['asal'] = $data['asal'];
			$hasil['id_po'] = $data['id_po'];
			$hasil['tujuan'] = $value;
			$hasil['tgl_diterima'] = $data['tgl_diterima'];
			$this->db->insert('distribusi_po',$hasil);
		}
	}

	function pengajuan_production_order($data)
	{

		foreach ($data['tujuan'] as $key => $value)
		{
			$hasil['id_po'] = $data['id_po'];
			$hasil['yang_meminta'] = $data['yang_meminta'];
			$hasil['tujuan'] = $value;
			$hasil['perihal'] = $data['perihal'];
			$hasil['tgl_diajukan'] = $data['tgl_diajukan'];

			$this->db->insert('validasi_po',$hasil);
		}
	}

	function konfirmasi_persetujuan_po($id_po, $inputan)
	{
		$this->db->where('id_val_po', $id_po);
		$this->db->update('validasi_po', $inputan);
	}

	function konfirmasi_persetujuan_po_tolak($id_po,$inputan)
	{
		$this->db->where('id_val_po', $id_po);
		$this->db->update('validasi_po', $inputan);
	}

	function status_pengajuan($id_po)
	{
		$this->db->where('id_po', $id_po);
		$ambil = $this->db->get('validasi_po');
		$data = $ambil->result_array();
		return $data;	
	}

	function tampil_po()
	{
		$this->db->order_by("tgl_order", "desc");
		$ambil = $this->db->get('production_order');
		$data = $ambil->result_array();

		$semua = array();
		foreach ($data as $key => $value)
		{			
			$this->db->where('status_pengajuan', 'Disetujui');
			$this->db->where('id_po', $value['id_po']);
			$ambil1 = $this->db->get('validasi_po');
			$data1 = $ambil1->result_array();
			$value['count'] = count($data1);
			$semua[] = $value;
		}

		return $semua;
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

	function ambil_bon($id_po)
	{
		$this->db->where('id_po', $id_po);
		$ambil = $this->db->get('bon');
		$data = $ambil->row_array();

		// $semua = array();
		// foreach ($data as $key => $value) {
		$this->db->where('id_po', $data['id_po']);
		$ambil1 = $this->db->get('reject_barang_produksi');
		$data1 = $ambil1->result_array();
		$value['reject'] = $data1;		

		$data[] = $value;
		// }

		return $data;
	}

	function notif_po($id_barang)
	{
		$this->db->where('id_ppic', $id_barang);
		$ambil = $this->db->get('ppic');
		$data = $ambil->result_array();

		$semua = array();
		foreach ($data as $key => $value) {
			$this->db->where('nama_barang', $value['id_ppic']);
			$ambil1 = $this->db->get('kalkulasi_bon');
			$data1 = $ambil1->result_array();
			$value['kalkulasi_bon'] = $data1;		

			$semua[] = $value;
		}

		return $semua;
	}

	function tampil_barang($id_po)
	{
		$this->db->join('barang', 'ppic.nama_barang = barang.nama_barang', 'left');
		$this->db->join('satuan', 'barang.id_satuan = satuan.id_satuan', 'left');
		$this->db->join('supplier', 'ppic.id_supplier = supplier.id_supplier', 'left');
		$this->db->where('id_po', $id_po);
		$ambil = $this->db->get('ppic');
		$data = $ambil->result_array();
		
		return $data;
	}

	function ambil_barang($id_ppic)
	{
		$this->db->join('barang', 'ppic.nama_barang = barang.nama_barang', 'left');
		$this->db->join('jenis', 'barang.id_jenis = jenis.id_jenis', 'left');
		$this->db->join('sub_jenis', 'barang.id_sub_jenis = sub_jenis.id_sub_jenis', 'left');
		$this->db->join('satuan', 'barang.id_satuan = satuan.id_satuan', 'left');
		$this->db->join('kebutuhan_sebelum_produksi', 'ppic.id_ppic = kebutuhan_sebelum_produksi.id_ppic', 'left');
		$this->db->where('ppic.id_ppic', $id_ppic);
		$ambil = $this->db->get('ppic');
		$data = $ambil->row_array();

		return $data;
		
	}

	function ambil_ppic($id_po)
	{
		$this->db->join('barang', 'ppic.nama_barang = barang.nama_barang', 'left');
		$this->db->join('satuan', 'barang.id_satuan = satuan.id_satuan', 'left');
		$this->db->join('supplier', 'ppic.id_supplier = supplier.id_supplier', 'left');
		$this->db->where('id_po', $id_po);
		$ambil = $this->db->get('ppic');
		$data = $ambil->result_array();
		
		$semua = array();

		foreach ($data as $key => $value)
		{
			$this->db->where('id_ppic', $value['id_ppic']);
			$ambil1 = $this->db->get('kebutuhan_sebelum_produksi');
			$data1 = $ambil1->result_array();
			$value['ksp']=$data1;

			$this->db->where('id_ppic', $value['id_ppic']);
			$ambil1 = $this->db->get('actual_pemakaian');
			$data1 = $ambil1->result_array();
			$value['ap']=$data1;			
			$semua[] = $value;
		}

		return $semua;		
	}

	function tambah_production_order($po, $warna_pos, $mens_cadet, $ladies_cadet, $picture_packing_printing_remark, $ppic)
	{
		// =============================== Production Order ===============================

		$input1['no_po'] = $po['no_po'];
		$input1['nama_po'] = $po['nama_po'];
		$input1['id_buyer'] = $po['id_buyer'];
		$input1['qty'] = $po['qty'];
		$input1['id_style_glove'] = $po['id_style_glove'];
		$input1['tgl_order'] = $po['tgl_order'];
		$input1['tgl_kirim'] = $po['tgl_kirim'];

		$this->db->insert('production_order', $input1);

		// =============================== production order ===============================

		// =============================== POS ===============================

		$production_order['id_po'] = $this->db->insert_id('production_order');

		$input2['id_po'] = $production_order['id_po'];
		$input2['foto_glove'] = $picture_packing_printing_remark[0]['foto'];
		$input2['keterangan'] = $picture_packing_printing_remark[0]['keterangan'];
		$input2['remark'] = $picture_packing_printing_remark[0]['remark'];

		$this->db->insert('pos', $input2);

		// =============================== POS ===============================

		// =============================== Colour POS ===============================

		$colour_pos['id_pos'] = $this->db->insert_id('pos');	

		foreach ($warna_pos as $key => $value) {
			$input3['id_pos'] = $colour_pos['id_pos'];
			$input3['leather'] = $value['leather'];	
			$input3['velcro'] = $value['velcro'];	
			$input3['logo'] = $value['logo'];	
			$input3['pu_tape'] = $value['pu_tape'];	
			$input3['lycra'] = $value['lycra'];	
			$input3['patch'] = $value['patch'];

			$this->db->insert('colour_pos', $input3);			
		}

		// =============================== Colour POS ===============================

		// =============================== Colour POS ===============================

		$input9['id_pos'] = $colour_pos['id_pos'];
		$input9['body'] = $picture_packing_printing_remark[0]['body'];
		$input9['thumb'] = $picture_packing_printing_remark[0]['thumb'];
		$input9['machi'] = $picture_packing_printing_remark[0]['machi'];	
		$input9['velcro'] = $picture_packing_printing_remark[0]['velcro'];	

		$this->db->insert('printing_press_pos', $input9);

		// =============================== Colour POS ===============================

		// =============================== Hands Mens Cadet ===============================

		if (!empty($mens_cadet)) {
			$total_m = 0;

			foreach ($mens_cadet as $key => $value) {
				$input4['id_pos'] = $colour_pos['id_pos'];
				$input4['hands'] = $value['hands'];
				$input4['size'] = $value['size'];
				$input4['qty'] = $value['qty'];
				$total_m+=$value['qty'];

				$this->db->insert('hands_mens_cadet', $input4);			
			}

			$inputan3['qty_total'] = $total_m;	
		}

		// =============================== Hands Mens Cadet ===============================

		// =============================== Hands Ladies Cadet ===============================
		
		if (!empty($ladies_cadet)) {
			$total_l = 0;

			foreach ($ladies_cadet as $key => $value) {
				$input5['id_pos'] = $colour_pos['id_pos'];
				$input5['hands'] = $value['hands'];
				$input5['size'] = $value['size'];
				$input5['qty'] = $value['qty'];
				$total_l+=$value['qty'];

				$this->db->insert('hands_ladies_cadet', $input5);			
			}

			$inputanA['qty_total'] = $total_l;	
		}

		// =============================== Hands Ladies Cadet ===============================

		// =============================== Kalkulasi_hands ===============================

		if (!empty($mens_cadet)) {
			$input6['id_pos'] = $colour_pos['id_pos'];
			$input6['qty_total'] = $inputan3['qty_total'];

			$this->db->insert('kalkulasi_hands', $input6);	
		}
		elseif (!empty($ladies_cadet)) {
			$input6['id_pos'] = $colour_pos['id_pos'];
			$input6['qty_total'] = $inputanA['qty_total'];

			$this->db->insert('kalkulasi_hands', $input6);			
		}
		else
		{
			$input6['id_pos'] = $colour_pos['id_pos'];
			$input6['qty_total'] = $inputan3['qty_total'] + $inputanA['qty_total'];

			$this->db->insert('kalkulasi_hands', $input6);
		}

		// =============================== Kalkulasi_hands ===============================

		// =============================== ppic ===============================

		$semua = array();
		foreach ($ppic as $key => $value)
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
			$bukti_kpb = $this->db->query("SELECT * FROM barang WHERE nama_barang='$value[nama_barang]'")->row_array();
			$value['bukti'] = $bukti_kpb;
			$semua_nya[] = $value;
		}

		foreach ($ppic as $key => $value) {
			$inputan10['total_kebutuhan1'] = $value['order'] * $value['per_pcs'];
		}

		foreach ($semua_nya as $key => $value) {
			$input7['id_po'] = $production_order['id_po'];
			$input7['nama_barang'] = $value['nama_barang'];
			$input7['stok1'] = $value['bukti']['stok'];
			$inputan2['nilai2'] = $input7['stok'] - $inputan10['total_kebutuhan1'];
			
			if ($inputan2['nilai2']<0) {
				$input30['sisa_kebutuhan'] = $inputan2['nilai2'];
			}
			elseif ($inputan2['nilai2']>=0){
				$input30['sisa_kebutuhan'] = 0;	
			}

			$input7['kekurangan'] = $input30['sisa_kebutuhan'];
			$input7['id_supplier'] = $value['id_supplier'];
			$input7['rendement_satu_meter'] = $value['rendement_satu_meter'];			

			$this->db->insert('ppic', $input7);			
		}

		// =============================== ppic ===============================

		$this->db->where('id_po', $production_order['id_po']);
		$ambil1 = $this->db->get('ppic');
		$data11 = $ambil1->result_array();

		foreach ($data11 as $key => $value) {

			$input_an['id_ppic'] = $value['id_ppic'];

			foreach ($ppic as $key => $value) {			

			// ================= kebutuhan_sebelum_produksi` ======================
				$input8['id_ppic'] = $input_an['id_ppic'];
				$input8['order'] = $value['order'];
				$input8['per_pcs'] = $value['per_pcs'];
				$input8['rendement_per_meter'] = $value['rendement_per_meter'];
				$tb = $value['order'] * $value['per_pcs'];
				$input8['total_kebutuhan'] = $tb;

				$this->db->insert('kebutuhan_sebelum_produksi', $input8);
				// ================= kebutuhan_sebelum_produksi` ======================

				// ================= Actual Pemakaian ======================

				$input11['id_ppic'] = $input_an['id_ppic'];
				$input11['total_produksi'] = $value['total_produksi'];
				$input11['remark'] = $value['remark'];

				$this->db->insert('actual_pemakaian', $input11);
				// ================= Actual Pemakaian ======================

			}


		}
		
	}

	function tambah_tgl_kirim($data,$id_po)
	{
		$this->db->where('id_po', $id_po);
		$this->db->update('production_order', $data);
	}

	function ubah_ttd_po($id_po)
	{
		$data['konfirmasi']="Valid";
		$this->db->where('id_po', $id_po);
		$this->db->update('production_order', $data);
	}

	function kode_otomatis()
	{
		$this->db->select('RIGHT(production_order.no_po,2) as kode', FALSE);
		$this->db->order_by('kode','DESC');    
		$this->db->limit(1);    
		$query = $this->db->get('production_order');  //cek dulu apakah ada sudah ada kode di tabel.    
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
		$tahun = date('y');
		$kodetampil = $tahun.$bulan.$no_urut;  //format kode
		return $kodetampil;
	}	    

	function ambil_production_order($id_po)
	{
		$this->db->join('buyer', 'production_order.id_buyer = buyer.id_buyer', 'left');
		$this->db->join('style_glove', 'production_order.id_style_glove = style_glove.id_style_glove', 'left');
		$this->db->join('pos', 'production_order.id_po = pos.id_po', 'left');
		// $this->db->join('colour_pos', 'pos.id_pos = colour_pos.id_pos', 'left');
		$this->db->join('printing_press_pos', 'pos.id_pos = printing_press_pos.id_pos', 'left');
		$this->db->where('pos.id_po', $id_po);
		$ambil = $this->db->get('production_order');
		$data = $ambil->row_array();

		$semua = array();
		
		$this->db->where('id_pos', $data['id_pos']);
		$ambil1 = $this->db->get('colour_pos');
		$data1 = $ambil1->result_array();
		$data['colour_pos'] = $data1;

		$this->db->where('id_pos', $data['id_pos']);
		$ambil1 = $this->db->get('hands_mens_cadet');
		$data1 = $ambil1->result_array();
		$data['mens_cadet'] = $data1;

		$this->db->where('id_pos', $data['id_pos']);
		$ambil1 = $this->db->get('hands_ladies_cadet');
		$data1 = $ambil1->result_array();
		$data['ladies_cadet'] = $data1;

		$this->db->where('id_po', $data['id_po']);
		$ambil1 = $this->db->get('ppic');
		$data1 = $ambil1->result_array();
		$data['ppic'] = $data1;

		$this->db->where('id_po', $data['id_po']);
		$ambil1 = $this->db->get('validasi_po');
		$data1 = $ambil1->result_array();
		$data['validasi_po'] = $data1;

		$semua[] = $data;

		return $semua;
	}

	function hapus_production_order($id_po) 
	{
		$this->db->where('id_po', $id_po);
		$this->db->delete('production_order');

		$this->db->where('id_po', $id_po);
		$ambil1 = $this->db->get('production_order');
		$data10 = $ambil1->row_array();

		$this->db->where('id_po', $id_po);
		$ambil1 = $this->db->get('pos');
		$data11 = $ambil1->row_array();

		$this->db->where('id_po', $id_po);
		$ambil1 = $this->db->get('ppic');
		$data12 = $ambil1->result_array();

		$foto = $data11['foto_glove'];
		unlink("./assets/images/foto_glove/$foto");
		$this->db->where('id_po', $id_po);
		$this->db->delete('pos');

		$this->db->where('id_pos', $data11['id_pos']);
		$this->db->delete('colour_pos');

		$this->db->where('id_pos', $data11['id_pos']);
		$this->db->delete('hands_mens_cadet');

		$this->db->where('id_pos', $data11['id_pos']);
		$this->db->delete('hands_ladies_cadet');

		$this->db->where('id_pos', $data11['id_pos']);
		$this->db->delete('kalkulasi_hands');

		$this->db->where('id_po', $id_po);
		$this->db->delete('ppic');

		foreach ($data12 as $key => $value) {
			$input1 =  $value['id_ppic'];

			$this->db->where('id_ppic', $input1);
			$this->db->delete('kebutuhan_sebelum_produksi');

			$this->db->where('id_ppic', $input1);
			$this->db->delete('actual_pemakaian');

		}

	}

	function cari_po($cari) 
	{
		$tgl_awal = $cari['tgl_order'];
		$tgl_akhir = $cari['tgl_kirim'];

		$ambil = $this->db->query("SELECT id_po, no_po, nama_po, nama_buyer, qty, nama_style, tgl_order, tgl_kirim FROM production_order JOIN buyer ON production_order.id_buyer = buyer.id_buyer JOIN style_glove ON production_order.id_style_glove = style_glove.id_style_glove WHERE tgl_order AND tgl_kirim BETWEEN '$tgl_awal' AND '$tgl_akhir'");
		$data = $ambil->result_array();

		$semua=array();
		foreach ($data as $key => $value)
		{
			$this->db->where('id_po', $value['id_po']);
			$ambil1 = $this->db->get('validasi_po');
			$data1 = $ambil1->result_array();
			$value['validasi'] = $data1;			

			$this->db->where('status_pengajuan', 'Disetujui');
			$this->db->where('id_po', $value['id_po']);
			$ambil1 = $this->db->get('validasi_po');
			$data1 = $ambil1->result_array();
			$value['validasi1'] = count($data1);

			$this->db->where('status_pengajuan', 'Ditolak');
			$this->db->where('id_po', $value['id_po']);
			$ambil1 = $this->db->get('validasi_po');
			$data1 = $ambil1->result_array();
			$value['validasi2'] = count($data1);

			$this->db->where('id_po', $value['id_po']);
			$ambil1 = $this->db->get('validasi_po');
			$data1 = $ambil1->result_array();
			$value['validasi3'] = count($data1);

			$semua[] = $value;
		}

		return $semua;
	}	

	function tampil_rekap_po()
	{
		$ambil = $this->db->query("SELECT id_po, nama_buyer FROM production_order JOIN buyer ON production_order.id_buyer = buyer.id_buyer GROUP BY nama_buyer");
		$data = $ambil->result_array();
		
		$semua = array();
		foreach ($data as $key => $value)
		{
			$this->db->join('buyer', 'production_order.id_buyer = buyer.id_buyer', 'left');
			$this->db->join('style_glove', 'production_order.id_style_glove = style_glove.id_style_glove', 'left');
			$this->db->order_by('tgl_order', 'desc');
			$this->db->where('nama_buyer', $value['nama_buyer']);
			$ambil1 = $this->db->get('production_order');
			$data1 = $ambil1->result_array();

			$hasil = array();
			foreach ($data1 as $no => $isi)
			{
				$this->db->where('status_pengajuan', "Disetujui");
				$this->db->where('id_po', $isi['id_po']);
				$ambil1 = $this->db->get('validasi_po');
				$data2 = $ambil1->result_array();
				$isi['jml_disetujui'] = count($data2);	

				$hasil[] = $isi;
			}

			$value['po'] = $hasil;

			$semua[] = $value;

		}

		return $semua;
	}

	function cari_rekap_po($cari) 
	{
		$bulan = $cari['bulan'];
		$tahun = $cari['tahun'];


		$ambil = $this->db->query("SELECT id_po, nama_buyer FROM production_order JOIN buyer ON production_order.id_buyer = buyer.id_buyer WHERE MONTH(tgl_order) = '$bulan' AND YEAR(tgl_order) = '$tahun' GROUP BY nama_buyer");
		$data = $ambil->result_array();
		
		$semua = array();
		foreach ($data as $key => $value)
		{
			$this->db->join('buyer', 'production_order.id_buyer = buyer.id_buyer', 'left');
			$this->db->join('style_glove', 'production_order.id_style_glove = style_glove.id_style_glove', 'left');
			$this->db->order_by('tgl_order', 'desc');
			$this->db->where('nama_buyer', $value['nama_buyer']);
			$ambil1 = $this->db->get('production_order');
			$data1 = $ambil1->result_array();
			$hasil=array();
			foreach ($data1 as $no => $isi)
			{
				$this->db->where('status_pengajuan', "Disetujui");
				$this->db->where('id_po', $isi['id_po']);
				$ambil1 = $this->db->get('validasi_po');
				$data2 = $ambil1->result_array();
				$isi['jml_disetujui'] = count($data2);	
				$hasil[] = $isi;
			}

			$value['po'] = $hasil;

			$semua[] = $value;
		}
		return $semua;
	}

	// ---------------------------- Notif Validasi Production Order Kepala Gudang ----------------------------	
	function hitung_val_po_kg()
	{
		$this->db->join('validasi_po', 'production_order.id_po = validasi_po.id_po', 'left');
		$this->db->where('tujuan', 'Kepala Gudang');
		$this->db->where('status_pesan', '0');
		$ambil = $this->db->get('production_order');
		$data = $ambil->result_array();

		return $data;
	}

	function data_val_po_kg()
	{
		$this->db->join('validasi_po', 'production_order.id_po = validasi_po.id_po', 'left');
		$this->db->where('tujuan', 'Kepala Gudang');
		$this->db->where('status_pesan', '0');
		$ambil = $this->db->get('production_order');
		$data = $ambil->row_array();

		return $data;
	}

	function ubah_status_val_po_kg($id_val_po)
	{
		$input['status_pesan'] = 1;
		$this->db->where('id_val_po', $id_val_po);
		$this->db->update('validasi_po', $input);
	}
	// ---------------------------- Notif Validasi Production Order Kepala Gudang ----------------------------	

	// ---------------------------- Notif Validasi Production Order Kepala Divisi Production Manager ----------------------------	
	function hitung_val_po_kdpm()
	{
		$this->db->join('validasi_po', 'production_order.id_po = validasi_po.id_po', 'left');
		$this->db->where('tujuan', 'Kepala Divisi Production Manager');
		$this->db->where('status_pesan', '0');
		$ambil = $this->db->get('production_order');
		$data = $ambil->result_array();

		return $data;
	}

	function data_val_po_kdpm()
	{
		$this->db->join('validasi_po', 'production_order.id_po = validasi_po.id_po', 'left');
		$this->db->where('tujuan', 'Kepala Divisi Production Manager');
		$this->db->where('status_pesan', '0');
		$ambil = $this->db->get('production_order');
		$data = $ambil->row_array();

		return $data;
	}

	function ubah_status_val_po_kdpm($id_val_po)
	{
		$input['status_pesan'] = 1;
		$this->db->where('id_val_po', $id_val_po);
		$this->db->update('validasi_po', $input);
	}
	// ---------------------------- Notif Validasi Production Order Kepala Divisi Production Manager ----------------------------

	// ---------------------------- Notif Validasi Production Order Direktur ----------------------------	
	function hitung_val_po_direk()
	{
		$this->db->join('validasi_po', 'production_order.id_po = validasi_po.id_po', 'left');
		$this->db->where('tujuan', 'Direktur');
		$this->db->where('status_pesan', '0');
		$ambil = $this->db->get('production_order');
		$data = $ambil->result_array();

		return $data;
	}

	function data_val_po_direk()
	{
		$this->db->join('validasi_po', 'production_order.id_po = validasi_po.id_po', 'left');
		$this->db->where('tujuan', 'Direktur');
		$this->db->where('status_pesan', '0');
		$ambil = $this->db->get('production_order');
		$data = $ambil->row_array();

		return $data;
	}

	function ubah_status_val_po_direk($id_val_po)
	{
		$input['status_pesan'] = 1;
		$this->db->where('id_val_po', $id_val_po);
		$this->db->update('validasi_po', $input);
	}
	// ---------------------------- Notif Validasi Production Order Direktur ----------------------------	

	// ---------------- Notif Hasil Validasi Production Order dari Kep.Gudang Untuk Staff PPIC ----------------
	function hitung_hasil_val_po_kg()
	{
		$this->db->join('validasi_po', 'production_order.id_po = validasi_po.id_po', 'left');
		$this->db->where('tujuan', 'Kepala Gudang');
		$this->db->where('status_pesan', '1');
		$this->db->where('status_hasil', '0');
		$ambil = $this->db->get('production_order');
		$data = $ambil->result_array();

		return $data;
	}

	function data_hasil_val_po_kg()
	{
		$this->db->join('validasi_po', 'production_order.id_po = validasi_po.id_po', 'left');
		$this->db->where('tujuan', 'Kepala Gudang');
		$this->db->where('status_pesan', '1');
		$this->db->where('status_hasil', '0');
		$ambil = $this->db->get('production_order');
		$data = $ambil->row_array();

		return $data;
	}

	function ubah_status_hasil_val_po_kg($id_val_po)
	{
		$input['status_hasil'] = 1;
		$this->db->where('id_val_po', $id_val_po);
		$this->db->update('validasi_po', $input);
	}
	// ---------------- Notif Hasil Validasi Production Order dari Kep.Gudang Untuk Staff PPIC ----------------

	// ---------------- Notif Hasil Validasi Production Order dari Kep.Div.Pro.Man Untuk Staff PPIC ----------------
	function hitung_hasil_val_po_kdpm()
	{
		$this->db->join('validasi_po', 'production_order.id_po = validasi_po.id_po', 'left');
		$this->db->where('tujuan', 'Kepala Divisi Production Manager');
		$this->db->where('status_pesan', '1');
		$this->db->where('status_hasil', '0');
		$ambil = $this->db->get('production_order');
		$data = $ambil->result_array();

		return $data;
	}

	function data_hasil_val_po_kdpm()
	{
		$this->db->join('validasi_po', 'production_order.id_po = validasi_po.id_po', 'left');
		$this->db->where('tujuan', 'Kepala Divisi Production Manager');
		$this->db->where('status_pesan', '1');
		$this->db->where('status_hasil', '0');
		$ambil = $this->db->get('production_order');
		$data = $ambil->row_array();

		return $data;
	}

	function ubah_status_hasil_val_po_kdpm($id_val_po)
	{
		$input['status_hasil'] = 1;
		$this->db->where('id_val_po', $id_val_po);
		$this->db->update('validasi_po', $input);
	}
	// ---------------- Notif Hasil Validasi Production Order dari Kep.Gudang Untuk Staff PPIC ----------------

	// ---------------- Notif Hasil Validasi Production Order dari Direktur Untuk Staff PPIC ----------------
	function hitung_hasil_val_po_direk()
	{
		$this->db->join('validasi_po', 'production_order.id_po = validasi_po.id_po', 'left');
		$this->db->where('tujuan', 'Direktur');
		$this->db->where('status_pesan', '1');
		$this->db->where('status_hasil', '0');
		$ambil = $this->db->get('production_order');
		$data = $ambil->result_array();

		return $data;
	}

	function data_hasil_val_po_direk()
	{
		$this->db->join('validasi_po', 'production_order.id_po = validasi_po.id_po', 'left');
		$this->db->where('tujuan', 'Direktur');
		$this->db->where('status_pesan', '1');
		$this->db->where('status_hasil', '0');
		$ambil = $this->db->get('production_order');
		$data = $ambil->row_array();

		return $data;
	}

	function ubah_status_hasil_val_po_direk($id_val_po)
	{
		$input['status_hasil'] = 1;
		$this->db->where('id_val_po', $id_val_po);
		$this->db->update('validasi_po', $input);
	}
	// ---------------- Notif Hasil Validasi Production Order dari Direktur Untuk Staff PPIC ----------------

	// ---------------------------- Notif Distribusi Lap PO Staff Unit Sewing ----------------------------
	function hitung_dis_po_sus()
	{
		$this->db->join('distribusi_po', 'production_order.id_po = distribusi_po.id_po', 'left');
		$this->db->where('tujuan', 'Staff Unit Sewing');
		$this->db->where('status_pesan', '0');
		$ambil = $this->db->get('production_order');
		$data = $ambil->result_array();

		return $data;
	}

	function data_dis_po_sus()
	{
		$this->db->join('distribusi_po', 'production_order.id_po = distribusi_po.id_po', 'left');
		$this->db->where('tujuan', 'Staff Unit Sewing');
		$this->db->where('status_pesan', '0');
		$ambil = $this->db->get('production_order');
		$data = $ambil->row_array();

		return $data;
	}

	function ubah_status_dis_po_sus($id_distribusi_po)
	{
		$input['status_pesan'] = 1;
		$this->db->where('id_distribusi_po', $id_distribusi_po);
		$this->db->update('distribusi_po', $input);
	}
	// ---------------------------- Notif Distribusi Lap PO Staff Unit Sewing ----------------------------

	function tampil_laporan() 
	{
		$this->db->join('buyer', 'production_order.id_buyer = buyer.id_buyer', 'left');
		$this->db->join('style_glove', 'production_order.id_style_glove = style_glove.id_style_glove', 'left');
		$this->db->order_by('production_order.id_po', 'DESC');
		$ambil = $this->db->get('production_order');
		$data = $ambil->result_array();

		$semua = array();
		foreach ($data as $key => $value)
		{
			$this->db->where('id_po', $value['id_po']);
			$ambil1 = $this->db->get('distribusi_po');
			$data1 = $ambil1->result_array();
			$value['distribusi']=$data1;			
			$semua[] = $value;
		}

		return $semua;
	}	

	function cari_lap_po_user($cari) 
	{
		$ambil = $this->db->query("SELECT id_po, no_po, nama_po, nama_style, nama_buyer, qty FROM production_order JOIN buyer ON production_order.id_buyer = buyer.id_buyer JOIN style_glove ON production_order.id_style_glove = style_glove.id_style_glove");
		$data = $ambil->result_array();

		$semua = array();
		$tgl_awal = $cari['tgl_awal1'];
		$tgl_akhir = $cari['tgl_akhir1'];

		foreach ($data as $key => $value)
		{
			$this->db->where('tgl_diterima BETWEEN "'. date('Y-m-d', strtotime($tgl_awal)). '" and "'. date('Y-m-d', strtotime($tgl_akhir)).'"');
			$this->db->where('id_po', $value['id_po']);
			$ambil1 = $this->db->get('distribusi_po');
			$data1 = $ambil1->result_array();
			$value['distribusi'] = $data1;			
			$semua[] = $value;
		} 

		return $semua;

	}

}
?>