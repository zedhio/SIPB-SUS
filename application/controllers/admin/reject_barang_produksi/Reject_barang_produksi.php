<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reject_barang_produksi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('Mprofil');
		$this->load->model('Mbon');
		$this->load->model('Mreject_barang_produksi');
		
		// Agar login admin tidak jebol
		if (!$this->session->userdata('admin')) {
			echo "<script>alert('Anda harus login terlebih dahulu');location='".base_url("admin/login")."'</script>";
		}
	}

	public function index()
	{
		$session = $this->session->userdata('admin');
		$data['admin'] = $this->Mprofil->ambil_admin($session['id_admin']);
		$data['reject'] = $this->Mreject_barang_produksi->tampil_reject();

		if ($this->input->post('cari')) {
			$data['reject'] = $this->Mreject_barang_produksi->cari_reject($this->input->post());
		}

		$this->load->view('admin/header',$data);	
		$this->load->view('admin/navbar',$data);
		$this->load->view('admin/reject_barang_produksi/tampil',$data);
		$this->load->view('admin/footer');	
	}

	function detail($id_reject)
	{
		$session = $this->session->userdata('admin');
		$data['admin'] = $this->Mprofil->ambil_admin($session['id_admin']);
		$data['ambil_reject'] = $this->Mreject_barang_produksi->ambil_reject($id_reject);

		$this->load->view('admin/header',$data);	
		$this->load->view('admin/navbar',$data);
		$this->load->view('admin/reject_barang_produksi/detail',$data);
		$this->load->view('admin/footer');	
	}

}

?>