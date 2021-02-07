<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekapitulasi_production_order extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		// Agar login user tidak jebol
		if (!$this->session->userdata('user')) {
			echo "<script>alert('Anda harus login terlebih dahulu');location='".base_url("login")."'</script>";
		}

		// Nge-load model
		$this->load->model('Mprofil');
		$this->load->model('Mlaporan');
		$this->load->model('Mproduction_order');
	}

	public function index()
	{
		$session = $this->session->userdata('user');
		$data['user'] = $this->Mprofil->ambil_user($session['id_user']);
		$data['rekap_po'] = $this->Mproduction_order->tampil_rekap_po();

		$data['bulan']="";
		$data['tahun']="";

		if ($this->input->post('cari')) {
			$data['rekap_po'] = $this->Mproduction_order->cari_rekap_po($this->input->post());
			$data['bulan'] = $this->input->post('bulan');
			$data['tahun'] = $this->input->post('tahun');
		}
		
		$this->load->view('user/header',$data);	
		$this->load->view('user/navbar',$data);
		$this->load->view('user/rekapitulasi_production_order/tampil',$data);
		$this->load->view('user/footer');	
	}

}

?>