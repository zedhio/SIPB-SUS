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
		if (!$this->session->userdata('admin')) {
			echo "<script>alert('Anda harus login terlebih dahulu');location='".base_url("admin/login")."'</script>";
		}
	}

	public function index()
	{
		$session = $this->session->userdata('admin');
		$data['admin'] = $this->Mprofil->ambil_admin($session['id_admin']);
		$data['sjk'] = $this->Msurat_jalan_keluar->tampil_sjk();

		if ($this->input->post('cari')) {
			$data['sjk'] = $this->Msurat_jalan_keluar->cari_sjk($this->input->post());
		}

		if ($this->input->post('tambah'))
		{

			$input = $this->input->post();
      		// tampung nilai variabel input post ke variabel inputan 
			$id_sjk = $input['id_sjk'];
			$inputan['no_kendaraan'] = $input['no_kendaraan'];
			$this->Msurat_jalan_keluar->tambah_no_kendaraan($inputan,$id_sjk);
			
			echo "<script>";
			echo "alert('Nomor Kendaraan telah berhasil ditambahkan');";
			echo "location='".base_url("admin/surat_jalan_keluar/surat_jalan_keluar")."';";
			echo "</script>";
		}

		if ($this->input->post('ajukan')) {

			$input = $this->input->post();
      		// tampung nilai variabel input post ke variabel inputan 
			$inputan['id_sjk'] = $input['id_sjk'];
			$inputan['yang_meminta'] = $input['yang_meminta'];
			$inputan['perihal'] = $input['perihal'];
			$inputan['tujuan'] = $input['tujuan'];
			$inputan['tgl_diajukan'] = $input['tgl_diajukan'];

			$this->Msurat_jalan_keluar->pengajuan_sjk($inputan);

			echo "<script>";
			echo "alert('Pengajuan Persetujuan Surat Jalan Keluar Telah Dikirim');";
			echo "location='".base_url("admin/surat_jalan_keluar/surat_jalan_keluar")."';";
			echo "</script>";
		}

		if ($this->input->post('ttd')) 
		{
			$id_sjk = $this->input->post('ttd');
			$this->Msurat_jalan_keluar->ubah_ttd_sjk($id_sjk);

			echo "<script>";
			echo "alert('Berhasil memberi tanda terima');";
			echo "location='".base_url("admin/surat_jalan_keluar/surat_jalan_keluar")."';";
			echo "</script>";
		}

		if ($this->input->post('kirim')) 
		{
			$input = $this->input->post();
			$inputan['id_sjk'] = $input['id_sjk'];
			$inputan['asal'] = $input['asal'];
			$inputan['tujuan'] = $input['tujuan'];
			$inputan['tgl_diterima'] = $input['tgl_diterima'];

			$this->Msurat_jalan_keluar->kirim_sjk($inputan);

			echo "<script>";
			echo "alert('Berhasil mengirim laporan surat jalan keluar');";
			echo "location='".base_url("admin/surat_jalan_keluar/surat_jalan_keluar")."';";
			echo "</script>";
		}

		$this->load->view('admin/header',$data);	
		$this->load->view('admin/navbar',$data);
		$this->load->view('admin/surat_jalan_keluar/tampil',$data);
		$this->load->view('admin/footer');	
	}

	function detail($id_sjk) 
	{
		$session = $this->session->userdata('admin');
		$data['admin'] = $this->Mprofil->ambil_admin($session['id_admin']);
		$data['ambil_sjk'] = $this->Msurat_jalan_keluar->ambil_sjk($id_sjk);
		$data['detail'] = $this->Msurat_jalan_keluar->ambil1_sjk($id_sjk);
		$data['ambil_kalkulasi'] = $this->Msurat_jalan_keluar->ambil_kalkulasi($id_sjk);
		// $data['ambil_total'] = $this->Msurat_jalan_keluar->ambil_total($id_sjk);
		$data['validasi'] = $this->Msurat_jalan_keluar->ambil_validasi($id_sjk);

		$this->load->view('admin/header',$data);  
		$this->load->view('admin/navbar',$data);
		$this->load->view('admin/surat_jalan_keluar/detail',$data);
		$this->load->view('admin/footer');
	}

	// ---------------------------- Notif Hasil Validasi SJK Direktur ----------------------------
	function hitung_hasil_val_sjk_direk()
	{
		$data['validasi'] = $this->Msurat_jalan_keluar->hitung_hasil_val_sjk_direk();
		if(count($data['validasi'])<=0)
		{
			echo "";
		}
		else
		{
			echo count($data['validasi']);
		}
	}

	function notif_hasil_data_val_sjk_direk()
	{
		$data['validasi2'] = $this->Msurat_jalan_keluar->data_hasil_val_sjk_direk();
		echo json_encode($data['validasi2']);
	}

	function pesan_data_hasil_val_sjk_direk()
	{
		$this->Msurat_jalan_keluar->ubah_status_hasil_val_sjk_direk($this->input->post('id_val_sjk'));
	}
	// ---------------------------- Notif Hasil Validasi SJK Direktur ----------------------------		

}

?>