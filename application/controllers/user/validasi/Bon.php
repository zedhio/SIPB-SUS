<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bon extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		// Agar login user tidak jebol
		if (!$this->session->userdata('user')) {
			echo "<script>alert('Anda harus login terlebih dahulu');location='".base_url("login")."'</script>";
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
		$session = $this->session->userdata('user');
		$data['user'] = $this->Mprofil->ambil_user($session['id_user']);
		$data['bon1'] = $this->Mbon->tampil_bon_user();

		if ($this->input->post('cari')) {
			$data['bon1'] = $this->Mbon->cari_bon($this->input->post());
		}

		if ($this->input->post('setuju')) 
		{
			$input = $this->input->post();
			$id_bon = $input['id_val_bon'];
			$this->Mbon->konfirmasi_persetujuan_bon($id_bon);
			echo "<script>";
			echo "alert('BON Pengeluaran Barang telah disetujui');";
			echo "location='".base_url("user/validasi/bon")."';";
			echo "</script>";
		}

		if ($this->input->post('tolak')) 
		{
			$input = $this->input->post();
			$id_bon = $input['id_val_bon'];
			$inputan['status_pengajuan'] = $input['ditolak'];
			$inputan['alasan'] = $input['alasan'];
			$this->Mbon->konfirmasi_persetujuan_bon_tolak($id_bon,$inputan);
			echo "<script>";
			echo "alert('BON Pengeluaran Barang telah ditolak');";
			echo "location='".base_url("user/validasi/bon")."';";
			echo "</script>";
		}

		$this->load->view('user/header',$data);	
		$this->load->view('user/navbar',$data);
		$this->load->view('user/validasi/bon/tampil',$data);
		$this->load->view('user/footer');	
	}

	function detail($id_bon) 
	{
		$id_bagian = 10;
		$session = $this->session->userdata('user');
		$data['user'] = $this->Mprofil->ambil_user($session['id_user']);
		$data['ambil_bon'] = $this->Mbon->ambil_bon($id_bon);
		$data['ambil_kalkulasi'] = $this->Mbon->ambil_kalkulasi($id_bon);
		$data['ambil_total'] = $this->Mbon->ambil_total($id_bon);
		$data['acc'] = $this->Mbon->tampil_acc($id_bon);
		$data['acc1'] = $this->Mbon->tampil_acc1($id_bon);
		$data['acc1'] = $this->Mbon->tampil_acc1($id_bon);
		$data['bagian'] = $this->Mkaryawan->ambil_bagian($id_bagian);

		$this->load->view('user/header',$data);
		$this->load->view('user/navbar',$data);
		$this->load->view('user/validasi/bon/detail',$data);
		$this->load->view('user/footer');
	}

	// =================== bon ============================

}

?>