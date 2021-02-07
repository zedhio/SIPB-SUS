<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaturan_umum extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('Mprofil');
		$this->load->model('Mpengaturan_u');
		
		// Agar login admin tidak jebol
		if (!$this->session->userdata('admin')) {
			echo "<script>alert('Anda harus login terlebih dahulu');location='".base_url("admin/login")."'</script>";
		}
	}

	public function index()
	{
		$id_pengaturan = 1;
		$session = $this->session->userdata('admin');
		$data['admin']=$this->Mprofil->ambil_admin($session['id_admin']);
		$data['pengaturan'] = $this->Mpengaturan_u->ambil_pengaturan($id_pengaturan); 
		
		if ($this->input->post()) {
			$this->Mpengaturan_u->ubah_pengaturan($this->input->post(),$id_pengaturan);
			echo "<script>";
			echo "alert('Data berhasil diubah.');";
			echo "location='".base_url("admin/pengaturan/pengaturan_umum/pengaturan_umum")."';";
			echo "</script>";
		}

		$this->load->view('admin/header',$data);	
		$this->load->view('admin/navbar',$data);
		$this->load->view('admin/pengaturan/pengaturan_umum/tampil',$data);
		$this->load->view('admin/footer');	
	}

}

?>