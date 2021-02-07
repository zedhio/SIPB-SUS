<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kartu_persediaan_barang extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('Mprofil');
		$this->load->model('Mbarang');
		$this->load->model('Mkartu_persediaan_barang');
		
		// Agar login admin tidak jebol
		if (!$this->session->userdata('user')) {
			echo "<script>alert('Anda harus login terlebih dahulu');location='".base_url("login")."'</script>";
		}
	}

	public function index()
	{
		$session = $this->session->userdata('user');
		$data['user'] = $this->Mprofil->ambil_user($session['id_user']);
		$data['kpb'] = $this->Mkartu_persediaan_barang->tampil_kpb();

		if ($this->input->post('cari')) {
			$data['kpb'] = $this->Mkartu_persediaan_barang->cari_kpb($this->input->post());
		}

		$this->load->view('user/header',$data);	
		$this->load->view('user/navbar',$data);
		$this->load->view('user/kartu_persediaan_barang/tampil',$data);
		$this->load->view('user/footer');	
	}

	function detail($id_kpb)
	{
		$session = $this->session->userdata('user');
		$data['user'] = $this->Mprofil->ambil_user($session['id_user']);
		$data['ambil_kpb'] = $this->Mkartu_persediaan_barang->ambil_kpb($id_kpb);
		$data['ambil_bukti_kpb'] = $this->Mkartu_persediaan_barang->ambil_bukti_kpb($id_kpb);

		$data['bulan']="";
		$data['tahun']="";

		if ($this->input->post('cari')) {
			$data['ambil_bukti_kpb'] = $this->Mkartu_persediaan_barang->cari_rekap_kpb($this->input->post(), $id_kpb);
			$data['bulan']=$this->input->post('bulan');
			$data['tahun']=$this->input->post('tahun');
		}

		$this->load->view('user/header',$data);	
		$this->load->view('user/navbar',$data);
		$this->load->view('user/kartu_persediaan_barang/detail',$data);
		$this->load->view('user/footer');	
	}

}

?>