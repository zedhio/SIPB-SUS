<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('Mprofil');
		
		// Agar login user tidak jebol
		if (!$this->session->userdata('admin')) {
			echo "<script>alert('Anda harus login terlebih dahulu');location='".base_url("admin/login")."'</script>";
		}
	}

	public function index()
	{
		$session = $this->session->userdata('admin');
		$data['admin'] = $this->Mprofil->ambil_admin($session['id_admin']);
		
		if ($this->input->post()) {
			$this->Mprofil->ubah_admin($this->input->post(),$session['id_admin']);
			echo "<script>";
			echo "alert('Success');";
			echo "location='".base_url("admin/profil")."';";
			echo "</script>";
		}

		$this->load->view('admin/header',$data);
		$this->load->view('admin/navbar',$data);
		$this->load->view('admin/profil/Vprofil',$data);
		$this->load->view('admin/footer');

	}

}

?>