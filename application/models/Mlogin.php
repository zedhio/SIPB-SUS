<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mlogin extends CI_Model {

	// ------------------- Login Admin -------------------

	function login_admin($login_admin) 
	{
		$nik = $login_admin['nik'];
		$password = sha1($login_admin['password']);

		$this->db->where('nik', $nik);
		$this->db->where('password', $password);

		$ambil = $this->db->get('admin');
		$dataygcocok = $ambil->num_rows();

		if ($dataygcocok==1) 
		{
			$pecah = $ambil->row_array();
			$this->session->set_userdata('admin',$pecah);
			return "admin";
		}
		else
		{
			return "gagal_admin";
		}
	}


	function logout_admin() 
	{
		session_destroy();
	}

	// -------------------Akhir Login Admin -------------------

	// ------------------- Login User -------------------

	function login_user($login_user) 
	{
		$this->db->join('karyawan', 'user.id_karyawan = karyawan.id_karyawan', 'left');

		$nik = $login_user['nik'];
		$password = sha1($login_user['password']);

		$this->db->where('nik', $nik);
		$this->db->where('password', $password);

		$ambil = $this->db->get('user');
		$dataygcocok = $ambil->num_rows();

		if ($dataygcocok==1) 
		{
			$pecah = $ambil->row_array();
			$this->session->set_userdata('user',$pecah);
			return "user";
		}
		else
		{
			return "gagal_user";
		}
	}


	function logout_user() 
	{
		session_destroy();
	}

	// ------------------- Akhir Login User -------------------	 

	}

/* End of file Mlogin.php */
/* Location: ./application/models/Mlogin.php */
?>