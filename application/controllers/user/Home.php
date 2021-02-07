<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller 
{
	
	public function __construct()
	{
		parent::__construct();

		// Agar login user tidak jebol
		if (!$this->session->userdata('user')) {
			echo "<script>alert('Anda harus login terlebih dahulu');location='".base_url("login")."'</script>";
		}

		// nge-load model
		$this->load->model('Mprofil');
		$this->load->model('Mbuyer');
		$this->load->model('Mkaryawan');
		$this->load->model('Mlaporan');
		$this->load->model('Mkartu_persediaan_barang');
		$this->load->model('Msurat_jalan_masuk');
		$this->load->model('Msurat_jalan_keluar');
		$this->load->model('Mproduction_order');
		$this->load->model('Mbon');
		$this->load->model('Mbpb');
		$this->load->model('Mreject_barang_produksi');
		$this->load->model('Mbarang');

	}

	public function index()
	{
		$session = $this->session->userdata('user');
		$data['user'] = $this->Mprofil->ambil_user($session['id_user']);
		$data['login'] = $this->session->userdata('user');
		$data['style'] = $this->Mbuyer->tampil_style();
		$data['buyer'] = $this->Mbuyer->tampil_buyer();
		$data['kpb'] = $this->Mkartu_persediaan_barang->tampil_kpb();
		$data['sjm'] = $this->Msurat_jalan_masuk->tampil_sjm();
		$data['validasi'] = $this->Mlaporan->tampil_validasi_lpb();
		$data['lap_lpb'] = $this->Mlaporan->hitung_lpb();
		$data['sjk'] = $this->Msurat_jalan_keluar->tampil_sjk();
		$data['bon'] = $this->Mbon->tampil_bon_validasi();
		$data['production_order'] = $this->Mproduction_order->tampil_production_order();
		$data['validasi_po'] = $this->Mproduction_order->hitung_val_po();
		$data['lap_bpb'] = $this->Mbpb->tampil_laporan_bpb();
		$data['bpb1'] = $this->Mbpb->tampil_bpb_user();
		$data['reject'] = $this->Mreject_barang_produksi->tampil_reject();
		$data['laporan1'] = $this->Msurat_jalan_keluar->tampil_laporan_sjk();
		$data['bpb2'] = $this->Mbpb->tampil_bpb_user();
		$data['rekap_po'] = $this->Mproduction_order->tampil_rekap_po();
		$data['laporan'] = $this->Mproduction_order->tampil_laporan();

		$this->load->view('user/header',$data);
		$this->load->view('user/navbar',$data);
		$this->load->view('user/home', $data );
		$this->load->view('user/footer');
	}

	function hitung(){
		$data = $this->Mbarang->kurang_stok();
		echo $data['total'];
	}

	function barang_kurang(){
		$data = $this->Mbarang->barang_kurang();
		foreach ($data as $key => $value) {
			echo "<li>".$value['nama_barang']." Stok - ".$value['stok']."</a></li>";
			// echo "<li><a href='".base_url("admin/data_master/barang/data_barang/barang/ubah/".$value['id_barang'])."' style='color: #777;'>".$value['nama_barang']." Stok - ".$value['stok']."</a></li>";
		}
	}

}

/* End of file Home.php */
/* Location: ./application/controllers/admin/Home.php */ 
?>