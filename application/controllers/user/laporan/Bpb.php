<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bpb extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		// Agar login user tidak jebol
		if (!$this->session->userdata('user')) {
			echo "<script>alert('Anda harus login terlebih dahulu');location='".base_url("login")."'</script>";
		}

		// nge-load model
		$this->load->model('Mprofil');
		$this->load->model('Mbpb');
	}

	// =================== lpb ============================

	public function index()
	{
		$session = $this->session->userdata('user');
		$data['user'] = $this->Mprofil->ambil_user($session['id_user']);
		$data['laporan'] = $this->Mbpb->tampil_laporan_bpb();

		//Kondisi jika klik tombol cari data lpb
		if ($this->input->post()) {
			$data['laporan'] = $this->Mbpb->cari_bpb($this->input->post());
		}

		if ($this->input->post('rekap_bpb')) 
		{
			redirect('user/laporan/bpb/rekapitulasi_bpb','refresh');	
		}

		$this->load->view('user/header',$data);	
		$this->load->view('user/navbar',$data);
		$this->load->view('user/laporan/bpb/tampil',$data);
		$this->load->view('user/footer');	
	}

	function rekapitulasi_bpb()
	{
		$session = $this->session->userdata('user');
		$data['user'] = $this->Mprofil->ambil_user($session['id_user']);
		$data['rekap_bpb'] = $this->Mbpb->tampil_rekap_bpb();

		$data['bulan']="";
		$data['tahun']="";

		if ($this->input->post('cari')) {
			$data['rekap_bpb'] = $this->Mbpb->cari_rekap_bpb($this->input->post());
			$data['bulan']=$this->input->post('bulan');
			$data['tahun']=$this->input->post('tahun');
		}

		$this->load->view('user/header',$data);	
		$this->load->view('user/navbar',$data);
		$this->load->view('user/laporan/bpb/rekapitulasi_bpb',$data);
		$this->load->view('user/footer');	
	}

	function detail($id_bpb) 
	{
		$session = $this->session->userdata('user');
		$data['user'] = $this->Mprofil->ambil_user($session['id_user']);
		$data['ambil_bpb'] = $this->Mbpb->ambil_bpb($id_bpb);
		$data['ambil_kalkulasi'] = $this->Mbpb->ambil_kalkulasi($id_bpb);

		$this->load->view('user/header',$data);
		$this->load->view('user/navbar',$data);
		$this->load->view('user/laporan/bpb/detail',$data);
		$this->load->view('user/footer');
	}

	// ---------------------------- Notif Distribusi BPB Kepala Divisi Purchase Order ----------------------------
	function hitung_dis_bpb_kdpo()
	{
		$data['validasi'] = $this->Mbpb->hitung_dis_bpb_kdpo();
		if(count($data['validasi'])<=0)
		{
			echo "";
		}
		else
		{
			echo count($data['validasi']);
		}
	}

	function notif_data_dis_bpb_kdpo()
	{
		$data['validasi2'] = $this->Mbpb->data_dis_bpb_kdpo();
		echo json_encode($data['validasi2']);
	}

	function pesan_data_dis_bpb_kdpo()
	{
		$this->Mbpb->ubah_status_dis_bpb_kdpo($this->input->post('id_distribusi_bpb'));
	}
	// ---------------------------- Notif Distribusi BPB Kepala Divisi Purchase Order ----------------------------

	// ---------------------------- Notif Distribusi BPB Kepala Divisi Accounting ----------------------------
	function hitung_dis_bpb_kda()
	{
		$data['validasi'] = $this->Mbpb->hitung_dis_bpb_kda();
		if(count($data['validasi'])<=0)
		{
			echo "";
		}
		else
		{
			echo count($data['validasi']);
		}
	}

	function notif_data_dis_bpb_kda()
	{
		$data['validasi2'] = $this->Mbpb->data_dis_bpb_kda();
		echo json_encode($data['validasi2']);
	}

	function pesan_data_dis_bpb_kda()
	{
		$this->Mbpb->ubah_status_dis_bpb_kda($this->input->post('id_distribusi_bpb'));
	}
	// ---------------------------- Notif Distribusi BPB Kepala Divisi Accounting ----------------------------

	// ---------------------------- Notif Distribusi BPB Kepala Divisi Direktur ----------------------------
	function hitung_dis_bpb_direk()
	{
		$data['validasi'] = $this->Mbpb->hitung_dis_bpb_direk();
		if(count($data['validasi'])<=0)
		{
			echo "";
		}
		else
		{
			echo count($data['validasi']);
		}
	}

	function notif_data_dis_bpb_direk()
	{
		$data['validasi2'] = $this->Mbpb->data_dis_bpb_direk();
		echo json_encode($data['validasi2']);
	}

	function pesan_data_dis_bpb_direk()
	{
		$this->Mbpb->ubah_status_dis_bpb_direk($this->input->post('id_distribusi_bpb'));
	}
	// ---------------------------- Notif Distribusi BPB Kepala Divisi Direktur ----------------------------

}

?>