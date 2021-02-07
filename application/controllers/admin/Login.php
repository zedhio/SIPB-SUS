<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
 		//Do your magic here
		$this->load->model('Mlogin');
		$this->load->model("Mpengaturan_u");	
	}

	// -------------------- Login Admin --------------------

	public function index()
	{
		$id_pengaturan = 1;
		$data['pengaturan'] = $this->Mpengaturan_u->ambil_pengaturan($id_pengaturan);

		if ($this->input->post()) {
			$check = $this->Mlogin->login_admin($this->input->post());
			if ($check=="admin") 
			{
				echo "<script>";
				echo "alert('Anda berhasil login sebagai Administration Gudang!');";
				echo "location='".base_url("admin/home")."';";
				echo "</script>";	
			}
			else
			{
				echo "<script>";
				echo "alert('Anda gagal login, periksa kembali atau hubungi developer anda!');";
				echo "location='".base_url("admin/login")."';";
				echo "</script>";
			}
		}

		$this->load->view('login/login_admin', $data);
	}

	function logout()
	{
		$this->Mlogin->logout_admin();
		echo "<script>";
		echo "alert('Anda Berhasil Logout');";
		echo "location='".base_url('admin/login')."';";
		echo "</script>";
	}

	// -------------------- Akhir Login Admin --------------------

}
?>