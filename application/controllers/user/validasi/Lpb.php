<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lpb extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		// Agar login user tidak jebol
		if (!$this->session->userdata('user')) {
			echo "<script>alert('Anda harus login terlebih dahulu');location='".base_url("login")."'</script>";
		}

		// nge-load model
		$this->load->model('Mprofil');
		$this->load->model('Mlaporan');
		$this->load->model('Msurat_jalan_masuk');
	}

	// ======================================= LPB =======================================
	public function index()
	{
		$session = $this->session->userdata('user');
		$data['user'] = $this->Mprofil->ambil_user($session['id_user']);
		$data['validasi'] = $this->Mlaporan->tampil_validasi_lpb();

		// Kondisi jika klik tombol cari data lpb
		if ($this->input->post('cari')) {
			$data['validasi'] = $this->Mlaporan->cari_lpb_validasi($this->input->post());
		}

		// kondisi jika klik tombol tambah untuk no purchase order
		if ($this->input->post('tambah'))
		{

			$input = $this->input->post();
      		// tampung nilai variabel input post ke variabel inputan 
			$id_lpb = $input['id_lpb'];
			$inputan['no_purchase_order'] = $input['no_purchase_order'];
			$this->Mlaporan->tambah_no_po($inputan,$id_lpb);
			echo "<script>";
			echo "alert('Nomor Purchase Order telah berhasil ditambahkan');";
			echo "location='".base_url("user/validasi/lpb")."';";
			echo "</script>";
		}

		if ($this->input->post('setuju')) 
		{
			$input = $this->input->post();
			$id_lpb = $input['id_lpb'];
			$inputan['status_pengajuan'] = "Disetujui";
			$inputan['tgl_dikonfirmasi'] = $input['tgl_dikonfirmasi'];
			$this->Mlaporan->ambil_sjm_lpb($id_lpb);
			$this->Mlaporan->update_stok($id_lpb);
			$this->Mlaporan->konfirmasi_persetujuan($id_lpb, $inputan);
			echo "<script>";
			echo "alert('Laporan Penerimaan Barang telah disetujui');";
			echo "location='".base_url("user/validasi/lpb")."';";
			echo "</script>";
		}

		if ($this->input->post('tolak')) 
		{
			$input = $this->input->post();
			$id_lpb = $input['id_lpb'];
			$inputan['status_pengajuan'] = $input['ditolak'];
			$inputan['alasan'] = $input['alasan'];
			$this->Mlaporan->konfirmasi_persetujuan_tolak($id_lpb,$inputan);
			echo "<script>";
			echo "alert('Laporan Penerimaan Barang telah ditolak');";
			echo "location='".base_url("user/validasi/lpb")."';";
			echo "</script>";
		}

		$this->load->view('user/header',$data);	
		$this->load->view('user/navbar',$data);
		$this->load->view('user/validasi/lpb/tampil',$data);
		$this->load->view('user/footer');	
	}

	function detail($id_lpb) 
	{
		$session = $this->session->userdata('user');
		$data['user'] = $this->Mprofil->ambil_user($session['id_user']);
		$data['ambil_lpb'] = $this->Mlaporan->ambil_lpb($id_lpb);
		$data['ambil_kalkulasi'] = $this->Mlaporan->ambil_kalkulasi($data['ambil_lpb']['id_sjm']);
		$data['detail'] = $this->Mlaporan->validasi_lpb($id_lpb);
		

		$this->load->view('user/header',$data);
		$this->load->view('user/navbar',$data);
		$this->load->view('user/validasi/lpb/detail',$data);
		$this->load->view('user/footer');
	}

	function hitung_val_lpb_kdpo()
	{
		$data['validasi'] = $this->Mlaporan->hitung_val_lpb_kdpo();
		if(count($data['validasi'])<=0)
		{
			echo "";
		}
		else
		{
			echo count($data['validasi']);
		}
	}

	function notif_data_val_lpb_kdpo()
	{
		$data['validasi2'] = $this->Mlaporan->data_val_lpb_kdpo();
		echo json_encode($data['validasi2']);
	}

	function pesan_data_val_lpb_kdpo()
	{
		$this->Mlaporan->ubah_status_val_lpb_kdpo($this->input->post('id_val_lpb'));
	}

	// ======================================= LPB =======================================

}

?>