<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class surat_jalan_masuk extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		// Untuk load model
		$this->load->model('Mprofil');
		$this->load->model('Msurat_jalan_masuk');
		$this->load->model('Mlaporan');
		
		// Agar login admin tidak jebol
		if (!$this->session->userdata('admin')) {
			echo "<script>alert('Anda harus login terlebih dahulu');location='".base_url("admin/login")."'</script>";
		}
	}

	public function index()
	{
		$session = $this->session->userdata('admin');
		$data['admin']=$this->Mprofil->ambil_admin($session['id_admin']);
		$data['sjm'] = $this->Mlaporan->cek_modal_lpb();
		$data['id_sjm'] = $this->Mlaporan->select_sjm();
		$data['kode_otomatis'] = $this->Mlaporan->kode_otomatis();

		// Kondisi jika klik tombol cari data penerimaan barang dari surat jalan masuk
		if ($this->input->post('cari')) {
			$data['sjm'] = $this->Msurat_jalan_masuk->cari_sjm($this->input->post());
		}

		// kondisi jika klik tombol save untuk membuat laporan penerimaan barang
		if ($this->input->post('save')) {

			$input = $this->input->post();
      		// tampung nilai variabel input post ke variabel inputan 
			$inputan['no_lpb'] = $input['no_lpb'];
			$inputan['tgl_dibuat'] = $input['tgl_dibuat'];
			$inputan['id_sjm'] = $input['id_sjm'];

			$this->Mlaporan->tambah_lpb($inputan);
			echo "<script>";
			echo "alert('LPB berhasil dibuat');";
			echo "location='".base_url("admin/surat_jalan_masuk/surat_jalan_masuk")."';";
			echo "</script>";
		}

		$this->load->view('admin/header',$data);	
		$this->load->view('admin/navbar',$data);
		$this->load->view('admin/surat_jalan_masuk/tampil',$data);
		$this->load->view('admin/footer');	
	}

	function detail($id_sjm) 
	{
		$session = $this->session->userdata('admin');
		$data['admin'] = $this->Mprofil->ambil_admin($session['id_admin']);
		$data['ambil_sjm'] = $this->Msurat_jalan_masuk->ambil_sjm($id_sjm);
		$data['ambil_kalkulasi'] = $this->Msurat_jalan_masuk->ambil_kalkulasi($data['ambil_sjm']['id_sjm']);
		$data['ambil_total'] = $this->Msurat_jalan_masuk->ambil_total($id_sjm);

		$this->load->view('admin/header',$data);  
		$this->load->view('admin/navbar',$data);
		$this->load->view('admin/surat_jalan_masuk/detail',$data);
		$this->load->view('admin/footer');
	}

}

?>