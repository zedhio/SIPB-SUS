<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		// Agar login user tidak jebol
		if (!$this->session->userdata('user')) {
			echo "<script>alert('Anda harus login terlebih dahulu');location='".base_url("login")."'</script>";
		}

		// Nge-load model
		$this->load->model('Mprofil');
		$this->load->model('Mkaryawan');
	}

	public function index()
	{
		$session = $this->session->userdata('user');
		$data['user'] = $this->Mprofil->ambil_user($session['id_user']);

		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";
		
		if($this->input->post('simpan'))
	    {
	      $input = $this->input->post();
	      // tampung nilai variabel input post ke variabel inputan
	      $input_user['password'] = $input['password']; 
	      $inputan['nama_karyawan'] = $input['nama_karyawan'];
	      $inputan['tmp_lhr'] = $input['tmp_lhr'];
	      $inputan['tgl_lhr'] = $input['tgl_lhr'];
	      $inputan['alamat'] = $input['alamat'];

	      $this->Mprofil->ubah_user($input_user, $inputan, $session['id_user']);
	      echo "<script>";
	      echo "alert('Profil anda berhasil diubah');";
	      echo "location='".base_url("user/profil")."';";
	      echo "</script>";
	    }

		$this->load->view('user/header',$data);
		$this->load->view('user/navbar',$data);
		$this->load->view('user/profil/tampil',$data);
		$this->load->view('user/footer');

	}

}

?>