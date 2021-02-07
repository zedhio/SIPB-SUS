<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buyer extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		// Agar login user tidak jebol
		if (!$this->session->userdata('user')) {
			echo "<script>alert('Anda harus login terlebih dahulu');location='".base_url("login")."'</script>";
		}

		// Nge-load model
		$this->load->model('Mprofil');
		$this->load->model('Mbuyer');
	}

	public function index()
	{
		$session = $this->session->userdata('user');
		$data['user'] = $this->Mprofil->ambil_user($session['id_user']);
		$data['buyer'] = $this->Mbuyer->tampil_buyer(); 
		
		$this->load->view('user/header',$data);	
		$this->load->view('user/navbar',$data);
		$this->load->view('user/data_master/buyer/tampil',$data);
		$this->load->view('user/footer');	
	}

	function detail($id_buyer) 
	{
		$session = $this->session->userdata('user');
		$data['user'] = $this->Mprofil->ambil_user($session['id_user']);
		$data['buyer'] = $this->Mbuyer->ambil_buyer($id_buyer);

		$this->load->view('user/header',$data);
		$this->load->view('user/navbar',$data);
		$this->load->view('user/data_master/buyer/detail',$data);
		$this->load->view('user/footer');
	}

}

?>