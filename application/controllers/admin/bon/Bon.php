<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bon extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		// Agar login user tidak jebol
		if (!$this->session->userdata('admin')) {
			echo "<script>alert('Anda harus login terlebih dahulu');location='".base_url("admin/login")."'</script>";
		}

		// nge-load model
		$this->load->model('Mprofil');
		$this->load->model('Mbon');
		$this->load->model('Mproduction_order');
		$this->load->model('Mbarang');
		$this->load->model('Mkaryawan');
	}

	// =================== bon ============================

	public function index()
	{
		$session = $this->session->userdata('admin');
		$data['admin'] = $this->Mprofil->ambil_admin($session['id_admin']);
		$data['bon'] = $this->Mbon->tampil_bon_validasi();

		if ($this->input->post('cari')) {
			$data['bon'] = $this->Mbon->cari_bon($this->input->post());
		}

		$this->load->view('admin/header',$data);	
		$this->load->view('admin/navbar',$data);
		$this->load->view('admin/bon/tampil',$data);
		$this->load->view('admin/footer');	
	}

	function detail($id_bon) 
	{
		$id_bagian = 10;
		$session = $this->session->userdata('admin');
		$data['admin'] = $this->Mprofil->ambil_admin($session['id_admin']);
		$data['ambil_bon'] = $this->Mbon->ambil_bon($id_bon);
		$data['ambil_kalkulasi'] = $this->Mbon->ambil_kalkulasi($id_bon);

		$this->load->view('admin/header',$data);
		$this->load->view('admin/navbar',$data);
		$this->load->view('admin/bon/detail',$data);
		$this->load->view('admin/footer');
	}

	// =================== bon ============================

}

?>