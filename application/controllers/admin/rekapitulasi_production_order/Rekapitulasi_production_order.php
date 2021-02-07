<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekapitulasi_production_order extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		// Agar login user tidak jebol
		if (!$this->session->userdata('admin')) {
			echo "<script>alert('Anda harus login terlebih dahulu');location='".base_url("admin/login")."'</script>";
		}

		// Nge-load model
		$this->load->model('Mprofil');
		$this->load->model('Mlaporan');
		$this->load->model('Mproduction_order');
	}

	public function index()
	{
		$session = $this->session->userdata('admin');
		$data['admin'] = $this->Mprofil->ambil_admin($session['id_admin']);
		$data['rekap_po'] = $this->Mproduction_order->tampil_rekap_po();

		$data['bulan']="";
		$data['tahun']="";

		if ($this->input->post('cari')) {
			$data['rekap_po'] = $this->Mproduction_order->cari_rekap_po($this->input->post());
			$data['bulan'] = $this->input->post('bulan');
			$data['tahun'] = $this->input->post('tahun');
		}
		
		$this->load->view('admin/header',$data);	
		$this->load->view('admin/navbar',$data);
		$this->load->view('admin/rekapitulasi_production_order/tampil',$data);
		$this->load->view('admin/footer');	
	}

}

?>