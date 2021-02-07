<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Production_order extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		// Agar login user tidak jebol
		if (!$this->session->userdata('user')) {
			echo "<script>alert('Anda harus login terlebih dahulu');location='".base_url("login")."'</script>";
		}

		// nge-load model
		$this->load->model('Mprofil');
		$this->load->model('Mproduction_order');
		$this->load->model('Mbuyer');
		$this->load->model('Mbarang');
		$this->load->model('Msupplier');
	}

	public function index()
	{
		$session = $this->session->userdata('user');
		$data['user'] = $this->Mprofil->ambil_user($session['id_user']);
		$data['production_order'] = $this->Mproduction_order->tampil_production_order();
		
		// kondisi jika klik tombol tambah untuk no purchase order
		if ($this->input->post('tambah_tgl'))
		{
			$input = $this->input->post();
      		// tampung nilai variabel input post ke variabel inputan 
			$id_po = $input['id_po'];
			$inputan['tgl_kirim'] = $input['tgl_kirim'];
			$this->Mproduction_order->tambah_tgl_kirim($inputan,$id_po);
			echo "<script>";
			echo "alert('Tanggal Pengiriman telah berhasil ditambahkan');";
			echo "location='".base_url("user/production_order/production_order")."';";
			echo "</script>";
		}

		if ($this->input->post('ttd')) 
		{
			$id_po = $this->input->post('ttd');
			$this->Mproduction_order->ubah_ttd_po($id_po);

			echo "<script>";
			echo "alert('Berhasil memberi tanda terima');";
			echo "location='".base_url("user/production_order/production_order")."';";
			echo "</script>";
		}

		if ($this->input->post('ajukan')) {

			$input = $this->input->post();
      		// tampung nilai variabel input post ke variabel inputan 
			$inputan['id_po'] = $input['id_po'];
			$inputan['yang_meminta'] = $input['yang_meminta'];
			$inputan['tujuan'] = $input['tujuan'];
			$inputan['perihal'] = $input['perihal'];
			$inputan['tgl_diajukan'] = $input['tgl_diajukan'];

			$this->Mproduction_order->pengajuan_production_order($inputan);
			echo "<script>";
			echo "alert('Pengajuan Persetujuan Production Order Telah Dikirim');";
			echo "location='".base_url("user/production_order/production_order")."';";
			echo "</script>";
		}

		if ($this->input->post('kirim')) 
		{
			$input = $this->input->post();
			$inputan['id_po'] = $input['id_po'];
			$inputan['asal'] = $input['asal'];
			$inputan['tujuan'] = $input['tujuan'];
			$inputan['tgl_diterima'] = $input['tgl_dikirim'];

			$this->Mproduction_order->kirim_po($inputan);

			echo "<script>";
			echo "alert('Berhasil mengirim laporan production order');";
			echo "location='".base_url("user/production_order/production_order")."';";
			echo "</script>";
		}

		if ($this->input->post('rekap_po')) 
		{
			redirect('user/rekapitulasi_production_order/rekapitulasi_production_order','refresh');	
		}
		
		$this->load->view('user/header',$data);	
		$this->load->view('user/navbar',$data);
		$this->load->view('user/production_order/tampil',$data);
		$this->load->view('user/footer');	
	}

	function status_pengajuan()
	{
		$id = $this->input->post('id_po');
		$data = $this->Mproduction_order->status_pengajuan($id);
		echo json_encode($data);
	}

	// function rekapitulasi_production_order()
	// {
	// 	$session = $this->session->userdata('user');
	// 	$data['user'] = $this->Mprofil->ambil_user($session['id_user']);
	// 	$data['rekap_po'] = $this->Mproduction_order->tampil_rekap_po();

	// 	$data['bulan']="";
	// 	$data['tahun']="";

	// 	if ($this->input->post('cari')) {
	// 		$data['rekap_po'] = $this->Mproduction_order->cari_rekap_po($this->input->post());
	// 		$data['bulan'] = $this->input->post('bulan');
	// 		$data['tahun'] = $this->input->post('tahun');
	// 	}

	// 	$this->load->view('user/header',$data);	
	// 	$this->load->view('user/navbar',$data);
	// 	$this->load->view('user/rekapitulasi_production_order/tampil',$data);
	// 	$this->load->view('user/footer');
	// }

	function tambah_pos()
	{
		$session = $this->session->userdata('user');
		$data['user'] = $this->Mprofil->ambil_user($session['id_user']);
		$data['buyer'] = $this->Mbuyer->tampil_buyer();
		$data['style'] = $this->Mbuyer->tampil_style();
		$data['kode_otomatis'] = $this->Mproduction_order->kode_otomatis();

		// ================================= Colour POS ====================================== //

		if ($this->input->post('tambah')) 
		{
			$input = $this->input->post();

			$inputan['no_po'] = $input['no_po'];
			$inputan['nama_po'] = $input['nama_po'];
			$inputan['id_buyer'] = $input['id_buyer'];
			$inputan['qty'] = $input['qty'];
			$inputan['id_style_glove'] = $input['id_style_glove'];
			$inputan['tgl_order'] = $input['tgl_order'];
			$inputan['tgl_kirim'] = $input['tgl_kirim'];

			$_SESSION['po'] = $inputan;

			$inputan1['leather'] = $input['leather'];
			$inputan1['velcro'] = $input['velcro1'];
			$inputan1['logo'] = $input['logo'];
			$inputan1['pu_tape'] = $input['pu_tape'];
			$inputan1['lycra'] = $input['lycra'];
			$inputan1['patch'] = $input['patch'];

			$_SESSION['warna_pos'][] = $inputan1;

			redirect('user/production_order/production_order/tambah_pos','refresh');
		}

		if (isset($_SESSION['warna_pos'])) 
		{
			$data['colour_pos'] = $_SESSION['warna_pos'];
		}
		else
		{
			$data['colour_pos'] = array();
		}

		if (isset($_SESSION['po']))
		{
			$data['production_order']=$_SESSION['po'];	
		}
		else
		{
			$data['production_order']=array('no_po'=>'','nama_po'=>'','id_buyer'=>'','qty'=>'','id_style_glove'=>'', 'tgl_order'=>'', 'tgl_kirim'=>'');
		}

		if ($this->input->post('hapus_record')) 
		{
			unset($_SESSION['warna_pos']);
			redirect('user/production_order/production_order/tambah_pos','refresh');
		}

		// ================================= Colour POS ====================================== //

		// ================================= Hands Mens Cadet ====================================== //

		if ($this->input->post('tambah_hands_mens')) 
		{
			$input = $this->input->post();

			$inputan2['hands'] = $input['hands'];
			$inputan2['size'] = $input['size1'];
			$inputan2['qty'] = $input['qty1'];

			$_SESSION['mens_cadet'][] = $inputan2;
			// $_SESSION['ladies_cadet'][] = 0;

			redirect('user/production_order/production_order/tambah_pos','refresh');
		}		

		if (isset($_SESSION['mens_cadet'])) 
		{
			$data['hands_mens'] = $_SESSION['mens_cadet'];
		}
		else
		{
			$data['hands_mens'] = array();
		}

		if ($this->input->post('hapus_record1')) 
		{
			unset($_SESSION['mens_cadet']);
			redirect('user/production_order/production_order/tambah_pos','refresh');
		}

		// ================================= Hands Mens Cadet ====================================== //

		// ================================= Hands Ladies Cadet ====================================== //

		if ($this->input->post('tambah_hands_ladies')) 
		{
			$input = $this->input->post();

			$inputan3['hands'] = $input['hands2'];
			$inputan3['size'] = $input['size2'];
			$inputan3['qty'] = $input['qty2'];

			$_SESSION['ladies_cadet'][] = $inputan3;

			redirect('user/production_order/production_order/tambah_pos','refresh');
		}		

		if (isset($_SESSION['ladies_cadet'])) 
		{
			$data['hands_ladies'] = $_SESSION['ladies_cadet'];
		}
		elseif (!isset($_SESSION['ladies_cadet']))
		{
			$data['hands_ladies'] = array();
		}

		if ($this->input->post('hapus_record2')) 
		{
			unset($_SESSION['ladies_cadet']);
			redirect('user/production_order/production_order/tambah_pos','refresh');
		}

		// ================================= Hands Ladies Cadet ====================================== //
		
		// ================ Picture Of GLoves | Packing | Printing Press POS | Remark ================ //

		if ($this->input->post('kemudian')) 
		{
			$input = $this->input->post();

			$inputan4['keterangan'] = $input['keterangan'];
			$inputan4['body'] = $input['body'];
			$inputan4['thumb'] = $input['thumb'];
			$inputan4['machi'] = $input['machi'];
			$inputan4['velcro'] = $input['velcro'];
			$inputan4['remark'] = $input['remark'];


			$this->Mproduction_order->simpan_session($inputan4);

			redirect('user/production_order/production_order/tambah_ppic','refresh');	
		}

		if (isset($_SESSION['picture_packing_printing_remark'])) 
		{
			$data['kemudian'] = $_SESSION['picture_packing_printing_remark'];
		}
		else
		{
			$data['kemudian'] = array();
		}

		// ================ Picture Of GLoves | Packing | Printing Press POS | Remark ================ //

		$this->load->view('user/header',$data);  
		$this->load->view('user/navbar',$data);
		$this->load->view('user/production_order/tambah_pos',$data);
		$this->load->view('user/footer');	
	}

	function select()
	{
		$id = $this->input->post('nama_barang');
		$data = $this->Mbarang->ambil_barang_by_nama($id);
		echo json_encode($data);
	}

	function tambah_ppic()
	{
		$session = $this->session->userdata('user');
		$data['user'] = $this->Mprofil->ambil_user($session['id_user']);
		$data['barang'] = $this->Mbarang->tampil_barang();
		$data['supplier'] = $this->Msupplier->tampil_supplier();

		// ================ Fungsi Select Barang ================ //

		if ($this->input->post('nama_barang')) 
		{
			$id_barang = $this->input->post('nama_barang');
		}
		else
		{
			$id_barang = "";
		}

		$data['ambil'] = $this->Mbarang->ambil_barang_by_nama($id_barang);

		// ================ Fungsi Select Barang ================ //

		// ================ PPIC ================ //

		if ($this->input->post('tambah3')) 
		{
			$input = $this->input->post();

			$inputan5['nama_barang'] = $input['nama_barang'];
			$inputan5['warna'] = $input['warna'];
			$inputan5['order'] = $input['order'];
			$inputan5['per_pcs'] = $input['per_pcs'];
			$inputan5['rendement_per_meter'] = $input['rendement_per_meter'];
			// $inputan5['total_kebutuhan'] = $input['total_kebutuhan'];
			$inputan5['satuan'] = $input['satuan'];
			// $inputan5['stok'] = $input['stok'];
			// $inputan5['kekurangan'] = $input['kekurangan'];
			$inputan5['id_supplier'] = $input['id_supplier'];
			$inputan5['rendement_satu_meter'] = $input['rendement_satu_meter'];
			$inputan5['total_produksi'] = $input['total_produksi'];
			$inputan5['remark'] = $input['remark'];

			$_SESSION['ppic'][] = $inputan5;

			redirect('user/production_order/production_order/tambah_ppic','refresh');
		}

		if (isset($_SESSION['ppic'])) 
		{
			$data['ppic'] = $this->Mproduction_order->tampil_ppic($_SESSION['ppic']);		
		}
		else
		{
			$data['ppic'] = array();
		}

		if ($this->input->post('hapus_record3')) 
		{
			unset($_SESSION['ppic']);
			redirect('user/production_order/production_order/tambah_ppic','refresh');
		}

		// ================ Fungsi PPIC ================ //

		if ($this->input->post('simpan1'))
		{
			if (empty($_SESSION['mens_cadet'])) {	
				$this->Mproduction_order->tambah_production_order($_SESSION['po'], $_SESSION['warna_pos'], null, $_SESSION['ladies_cadet'], $_SESSION['picture_packing_printing_remark'], $_SESSION['ppic']);
			}
			elseif (empty($_SESSION['ladies_cadet'])) {	
				$this->Mproduction_order->tambah_production_order($_SESSION['po'], $_SESSION['warna_pos'], $_SESSION['mens_cadet'], null, $_SESSION['picture_packing_printing_remark'], $_SESSION['ppic']);
			}
			else 
			{
				$this->Mproduction_order->tambah_production_order($_SESSION['po'], $_SESSION['warna_pos'], $_SESSION['mens_cadet'], $_SESSION['ladies_cadet'], $_SESSION['picture_packing_printing_remark'], $_SESSION['ppic']);
			}
			
			unset($_SESSION['po'], $_SESSION['warna_pos'], $_SESSION['mens_cadet'], $_SESSION['ladies_cadet'], $_SESSION['picture_packing_printing_remark'], $_SESSION['ppic']);

			echo "<script>";
			echo "alert('Data berhasil disimpan');";
			echo "location='".base_url("user/production_order/production_order")."';";
			echo "</script>";
		}

		$this->load->view('user/header',$data);  
		$this->load->view('user/navbar',$data);
		$this->load->view('user/production_order/tambah_ppic',$data);
		$this->load->view('user/footer');	
	}

	function edit_pos()
	{
		$session = $this->session->userdata('user');
		$data['user'] = $this->Mprofil->ambil_user($session['id_user']);

		if ($this->input->post('kemudian')) 
		{
			echo "<script>";
			echo "location='".base_url("user/production_order/production_order/edit_ppic")."';";
			echo "</script>";	
		}

		$this->load->view('user/header',$data);  
		$this->load->view('user/navbar',$data);
		$this->load->view('user/production_order/edit_pos',$data);
		$this->load->view('user/footer');	
	}

	function edit_ppic()
	{
		$session = $this->session->userdata('user');
		$data['user'] = $this->Mprofil->ambil_user($session['id_user']);

		$this->load->view('user/header',$data);  
		$this->load->view('user/navbar',$data);
		$this->load->view('user/production_order/edit_ppic',$data);
		$this->load->view('user/footer');	
	}

	function detail($id_po)
	{
		$session = $this->session->userdata('user');
		$data['user'] = $this->Mprofil->ambil_user($session['id_user']);
		$data['production_order'] = $this->Mproduction_order->ambil_production_order($id_po);
		$data['ppic'] = $this->Mproduction_order->ambil_ppic($id_po);

		$this->load->view('user/header',$data);  
		$this->load->view('user/navbar',$data);
		$this->load->view('user/production_order/detail',$data);
		$this->load->view('user/footer');	
	}

	function hapus($id_po) 
	{
		$this->Mproduction_order->hapus_production_order($id_po);
		echo "<script>";
		echo "alert('Data berhasil dihapus');";
		echo "location='".base_url("user/production_order/production_order")."';";
		echo "</script>";
	}

	// ---------------- Notif Hasil Validasi Production Order dari Kep.Gudang Untuk Staff PPIC ----------------
	function hitung_hasil_val_po_kg()
	{
		$data['validasi'] = $this->Mproduction_order->hitung_hasil_val_po_kg();
		if(count($data['validasi'])<=0)
		{
			echo "";
		}
		else
		{
			echo count($data['validasi']);
		}
	}

	function notif_hasil_data_val_po_kg()
	{
		$data['validasi2'] = $this->Mproduction_order->data_hasil_val_po_kg();
		echo json_encode($data['validasi2']);
	}

	function pesan_data_hasil_val_po_kg()
	{
		$this->Mproduction_order->ubah_status_hasil_val_po_kg($this->input->post('id_val_po'));
	}
	// ---------------- Notif Hasil Validasi Production Order dari Kep.Gudang Untuk Staff PPIC ----------------

	// ---------------- Notif Hasil Validasi Production Order dari Kep.Div.Pro.Man Untuk Staff PPIC ----------------
	function hitung_hasil_val_po_kdpm()
	{
		$data['validasi'] = $this->Mproduction_order->hitung_hasil_val_po_kdpm();
		if(count($data['validasi'])<=0)
		{
			echo "";
		}
		else
		{
			echo count($data['validasi']);
		}
	}

	function notif_hasil_data_val_po_kdpm()
	{
		$data['validasi2'] = $this->Mproduction_order->data_hasil_val_po_kdpm();
		echo json_encode($data['validasi2']);
	}

	function pesan_data_hasil_val_po_kdpm()
	{
		$this->Mproduction_order->ubah_status_hasil_val_po_kdpm($this->input->post('id_val_po'));
	}
	// ---------------- Notif Hasil Validasi Production Order dari Kep.Div.Pro.Man Untuk Staff PPIC ----------------

	// ---------------- Notif Hasil Validasi Production Order dari Direktur Untuk Staff PPIC ----------------
	function hitung_hasil_val_po_direk()
	{
		$data['validasi'] = $this->Mproduction_order->hitung_hasil_val_po_direk();
		if(count($data['validasi'])<=0)
		{
			echo "";
		}
		else
		{
			echo count($data['validasi']);
		}
	}

	function notif_hasil_data_val_po_direk()
	{
		$data['validasi2'] = $this->Mproduction_order->data_hasil_val_po_direk();
		echo json_encode($data['validasi2']);
	}

	function pesan_data_hasil_val_po_direk()
	{
		$this->Mproduction_order->ubah_status_hasil_val_po_direk($this->input->post('id_val_po'));
	}
	// ---------------- Notif Hasil Validasi Production Order dari Direktur Untuk Staff PPIC ----------------

}

?>