<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class surat_jalan_keluar extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		// Untuk load model
		$this->load->model('Mprofil');
		$this->load->model('Msurat_jalan_keluar');
		
		// Agar login admin tidak jebol
		if (!$this->session->userdata('user')) {
			echo "<script>alert('Anda harus login terlebih dahulu');location='".base_url("login")."'</script>";
		}
	}

	public function index()
	{
		$session = $this->session->userdata('user');
		$data['user'] = $this->Mprofil->ambil_user($session['id_user']);
		$data['sjk'] = $this->Msurat_jalan_keluar->tampil_sjk();

		if ($this->input->post('cari')) {
			$data['sjk'] = $this->Msurat_jalan_keluar->cari_val_sjk($this->input->post());
		}

		if ($this->input->post('setuju')) 
		{
			$input = $this->input->post();
			$id_sjk = $input['id_sjk'];
			$inputan['tgl_dikonfirmasi'] = $input['tgl_dikonfirmasi'];

			$this->Msurat_jalan_keluar->ambil_sjk_qc($id_sjk);
			$this->Msurat_jalan_keluar->konfirmasi_persetujuan($id_sjk, $inputan);
			echo "<script>";
			echo "alert('Surat Jalan Keluar telah disetujui');";
			echo "location='".base_url("user/validasi/surat_jalan_keluar")."';";
			echo "</script>";
		}

		if ($this->input->post('tolak')) 
		{
			$input1 = $this->input->post();
			$id_sjk1 = $input1['id_sjk'];
			$inputan1['status_pengajuan'] = $input1['ditolak'];
			$inputan1['alasan'] = $input1['alasan'];
			$inputan1['tgl_dikonfirmasi'] = $input1['tgl_dikonfirmasi'];
			$this->Msurat_jalan_keluar->konfirmasi_persetujuan_tolak($id_sjk1,$inputan1);
			echo "<script>";
			echo "alert('Surat Jalan Keluar telah ditolak');";
			echo "location='".base_url("user/validasi/surat_jalan_keluar")."';";
			echo "</script>";
		}

		if ($this->input->post('kirim2')) 
		{
			$input = $this->input->post();

			$inputan['id_sjk'] = $input['id_sjk'];
			$inputan['asal'] = $input['asal'];
			$inputan['tujuan'] = $input['tujuan'];

			$this->Msurat_jalan_keluar->kirim_sjk($inputan);

			// echo "<script>";
			// echo "alert('Berhasil mengirim laporan lpb');";
			// echo "location='".base_url("admin/laporan/lpb")."';";
			// echo "</script>";
		}

		$this->load->view('user/header',$data);	
		$this->load->view('user/navbar',$data);
		$this->load->view('user/validasi/surat_jalan_keluar/tampil',$data);
		$this->load->view('user/footer');	
	}

	function detail($id_sjk) 
	{
		$session = $this->session->userdata('user');
		$data['user'] = $this->Mprofil->ambil_user($session['id_user']);
		$data['ambil_sjk'] = $this->Msurat_jalan_keluar->ambil_sjk($id_sjk);
		$data['detail'] = $this->Msurat_jalan_keluar->ambil1_sjk($id_sjk);
		$data['ambil_kalkulasi'] = $this->Msurat_jalan_keluar->ambil_kalkulasi($id_sjk);
		$data['validasi'] = $this->Msurat_jalan_keluar->ambil_validasi($id_sjk);

		$this->load->view('user/header',$data);  
		$this->load->view('user/navbar',$data);
		$this->load->view('user/validasi/surat_jalan_keluar/detail',$data);
		$this->load->view('user/footer');
	}

	// ---------------------------- Notif Validasi SJK Direk ----------------------------
	function hitung_val_sjk_direk()
	{
		$data['validasi'] = $this->Msurat_jalan_keluar->hitung_val_sjk_direk();
		if(count($data['validasi'])<=0)
		{
			echo "";
		}
		else
		{
			echo count($data['validasi']);
			// echo "<pre>";
			// print_r($data['validasi']);
			// echo "</pre>";
		}
	}

	function notif_data_val_sjk_direk()
	{
		$data['validasi2'] = $this->Msurat_jalan_keluar->data_val_sjk_direk();
		echo json_encode($data['validasi2']);
	}

	function pesan_data_val_sjk_direk()
	{
		$this->Msurat_jalan_keluar->ubah_status_val_sjk_direk($this->input->post('id_val_sjk'));
	}
	// ---------------------------- Notif Validasi SJK Direk ----------------------------

}

?>