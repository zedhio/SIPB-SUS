<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

		$this->load->model('Mprofil');
		$this->load->model('Msurat_jalan_masuk');
		$this->load->model('Mkartu_persediaan_barang');
		$this->load->model('Mlaporan');
		$this->load->model('Mbon');
		$this->load->model('Mpemeriksaan_barang');
		$this->load->model('Msurat_jalan_keluar');
		$this->load->model('Mproduction_order');
		$this->load->model('Mreject_barang_produksi');
		$this->load->model('Mbpb');

		// Agar login user tidak jebol
		if (!$this->session->userdata('admin')) {
			echo "<script>alert('Anda harus login terlebih dahulu');location='".base_url("admin/login")."'</script>";
		}

	}

	public function index()
	{
		$session = $this->session->userdata('admin');
		$data['admin'] = $this->Mprofil->ambil_admin($session['id_admin']);
		$data['login'] = $this->session->userdata('admin');
		$data['sjm'] = $this->Msurat_jalan_masuk->tampil_sjm();
		$data['kpb'] = $this->Mkartu_persediaan_barang->tampil_kpb();
		$data['lpb'] = $this->Mlaporan->tampil_plb();
		$data['bon'] = $this->Mbon->tampil_bon_validasi();
		$data['periksa'] = $this->Mpemeriksaan_barang->tampil_periksa_barang();
		$data['sjk'] = $this->Msurat_jalan_keluar->tampil_sjk();
		$data['rekap_po'] = $this->Mproduction_order->tampil_rekap_po();
		$data['reject'] = $this->Mreject_barang_produksi->tampil_reject();
		$data['bpb'] = $this->Mbpb->tampil_bpb();
		$data['laporan'] = $this->Mbpb->tampil_laporan_bpb_admin();
		$data['laporan1'] = $this->Msurat_jalan_keluar->tampil_laporan_sjk();
		$data['laporan2'] = $this->Mproduction_order->tampil_laporan();

		$this->load->view('admin/header',$data);
		$this->load->view('admin/navbar',$data);
		$this->load->view('admin/home', $data );
		$this->load->view('admin/footer');
	}

}

?>