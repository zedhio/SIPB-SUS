<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();

 		// nge-load model
		$this->load->model('Mlogin');
		$this->load->model("Mpengaturan_u");	
	}

	// -------------------- Login User --------------------

	public function index()
	{
		$id_pengaturan = 1;
		$data['pengaturan'] = $this->Mpengaturan_u->ambil_pengaturan($id_pengaturan);

		if ($this->input->post()) {
			$check = $this->Mlogin->login_user($this->input->post());
			if ($check=="user") 
			{
				echo "<script>";
				echo "alert('Anda berhasil login!');";
				echo "location='".base_url("user/home")."';";
				echo "</script>";	
			}
			else
			{
				echo "<script>";
				echo "alert('Anda gagal login, periksa kembali atau hubungi developer anda!');";
				echo "location='".base_url("login")."';";
				echo "</script>";
			}
		}

		$this->load->view('login/login_user', $data);
	}

	function logout()
	{
		$this->Mlogin->logout_user();
		echo "<script>";
		echo "alert('Anda Berhasil Logout');";
		echo "location='".base_url('login')."';";
		echo "</script>";
	}

	// -------------------- Akhir Login Admin --------------------

}

?>