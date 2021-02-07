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
		$this->load->model('Mproduction_order');
	}

	// =================== bpb ============================

	public function index()
	{
		$session = $this->session->userdata('user');
		$data['user'] = $this->Mprofil->ambil_user($session['id_user']);
		$data['bpb1'] = $this->Mbpb->tampil_bpb_user();

		if ($this->input->post('cari')) {
			$data['bpb1'] = $this->Mbpb->cari_val_bpb($this->input->post());
		}

		if ($this->input->post('setuju')) 
		{
			$input = $this->input->post();
			
			$id_val_bpb = $input['id_val_bpb'];
			$id_bpb = $input['id_bpb'];
			$inputan['tgl_dikonfirmasi'] = $input['tgl_dikonfirmasi'];

			// echo "<pre>";
			// print_r($id_val_bpb);
			// echo "</pre>";

			$this->Mbpb->konfirmasi_persetujuan_bpb($id_bpb,$id_val_bpb, $inputan);
			echo "<script>";
			echo "alert('Bukti Pengeluaran Barang telah disetujui');";
			echo "location='".base_url("user/validasi/bpb")."';";
			echo "</script>";
		}

		if ($this->input->post('tolak')) 
		{
			$input = $this->input->post();
			$id_bpb = $input['id_val_bpb'];
			$inputan['status_pengajuan'] = $input['ditolak'];
			$inputan['alasan'] = $input['alasan'];
			$inputan['tgl_dikonfirmasi'] = $input['tgl_dikonfirmasi'];
			$this->Mbpb->konfirmasi_persetujuan_bpb_tolak($id_bpb,$inputan);
			echo "<script>";
			echo "alert('Bukti Pengeluaran Barang telah ditolak');";
			echo "location='".base_url("user/validasi/bpb")."';";
			echo "</script>";
		}

		$this->load->view('user/header',$data);	
		$this->load->view('user/navbar',$data);
		$this->load->view('user/validasi/bpb/tampil',$data);
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
		$this->load->view('user/validasi/bpb/detail',$data);
		$this->load->view('user/footer');
	}

	// ---------------------------- Notif Validasi BPB Kepala Unit Sewing ----------------------------
	function hitung_val_bpb_kus()
	{
		$data['validasi'] = $this->Mbpb->hitung_val_bpb_kus();
		if(count($data['validasi'])<=0)
		{
			echo "";
		}
		else
		{
			echo count($data['validasi']);
		}
	}

	function notif_data_val_bpb_kus()
	{
		$data['validasi2'] = $this->Mbpb->data_val_bpb_kus();
		echo json_encode($data['validasi2']);
	}

	function pesan_data_val_bpb_kus()
	{
		$this->Mbpb->ubah_status_val_bpb_kus($this->input->post('id_val_bpb'));
	}
	// ---------------------------- Notif Validasi BPB Kepala Unit Sewing ----------------------------

	// ---------------------------- Notif Validasi BPB Kepala Gudang ----------------------------
	function hitung_val_bpb_kg()
	{
		$data['validasi'] = $this->Mbpb->hitung_val_bpb_kg();
		if(count($data['validasi'])<=0)
		{
			echo "";
		}
		else
		{
			echo count($data['validasi']);
		}
	}

	function notif_data_val_bpb_kg()
	{
		$data['validasi2'] = $this->Mbpb->data_val_bpb_kg();
		echo json_encode($data['validasi2']);
	}

	function pesan_data_val_bpb_kg()
	{
		$this->Mbpb->ubah_status_val_bpb_kg($this->input->post('id_val_bpb'));
	}
	// ---------------------------- Notif Validasi BPB Kepala Unit Sewing ----------------------------

	// ---------------------------- Notif Validasi BPB Kepala Divisi Production Manager ----------------------------
	function hitung_val_bpb_kdpm()
	{
		$data['validasi'] = $this->Mbpb->hitung_val_bpb_kdpm();
		if(count($data['validasi'])<=0)
		{
			echo "";
		}
		else
		{
			echo count($data['validasi']);
		}
	}

	function notif_data_val_bpb_kdpm()
	{
		$data['validasi2'] = $this->Mbpb->data_val_bpb_kdpm();
		echo json_encode($data['validasi2']);
	}

	function pesan_data_val_bpb_kdpm()
	{
		$this->Mbpb->ubah_status_val_bpb_kdpm($this->input->post('id_val_bpb'));
	}
	// ---------------------------- Notif Validasi BPB Kepala Divisi Production Manager ----------------------------

	// =================== validasi bpb ============================

}

?>