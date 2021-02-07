<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Style_glove extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		// Agar login user tidak jebol
		if (!$this->session->userdata('admin')) {
			echo "<script>alert('Anda harus login terlebih dahulu');location='".base_url("admin/login")."'</script>";
		}

		// nge-load model
		$this->load->model('Mprofil');
		$this->load->model('Mbuyer');
	}

	public function index()
	{
		$session = $this->session->userdata('admin');
		$data['admin'] = $this->Mprofil->ambil_admin($session['id_admin']);
		$data['style'] = $this->Mbuyer->tampil_style(); 
		
		$this->load->view('admin/header',$data);	
		$this->load->view('admin/navbar',$data);
		$this->load->view('admin/data_master/style_glove/tampil',$data);
		$this->load->view('admin/footer');	
	}

	// fungsi tambah
	function tambah() 
	{
		$session = $this->session->userdata('admin');
		$data['admin'] = $this->Mprofil->ambil_admin($session['id_admin']);

		$this->load->library("form_validation");
		$this->form_validation->set_rules("nama_style", "Nama Style Glove", "required|is_unique[style_glove.nama_style]");
		// mengatur pesan error
		$this->form_validation->set_message("required", "%s harus diisi");
		$this->form_validation->set_message("is_unique", "%s yang diisikan sudah ada");

		// jika ada inputan dari form validasi bernilai benar
		if ($this->form_validation->run() == TRUE) 
		{
			// Msupplier menjalankan fungsi tambah_supplier
			$this->Mbuyer->tambah_style($this->input->post());
			echo "<script>";
			echo "alert('Data berhasil ditambahkan');";
			echo "location='".base_url("admin/data_master/style_glove/style_glove")."';";
			echo "</script>";
		}
		// selain itu salah
		else
		{
			$data["error"] = validation_errors();
		}

		$this->load->view('admin/header',$data);  
		$this->load->view('admin/navbar',$data);
		$this->load->view('admin/data_master/style_glove/tambah',$data);
		$this->load->view('admin/footer');
	}
  	
	// fungsi ubah
	function ubah($id_style_glove) 
	{
		$session = $this->session->userdata('admin');
		$data['admin'] = $this->Mprofil->ambil_admin($session['id_admin']);
		$data['style'] = $this->Mbuyer->ambil_style($id_style_glove);

		if ($this->input->post()) 
		{
			$this->Mbuyer->ubah_style($this->input->post(),$id_style_glove);
			echo "<script>";
			echo "alert('Data berhasil diubah');";
			echo "location='".base_url("admin/data_master/style_glove/style_glove")."';";
			echo "</script>";
		}	

		$this->load->view('admin/header',$data);  
		$this->load->view('admin/navbar',$data);
		$this->load->view('admin/data_master/style_glove/ubah',$data);
		$this->load->view('admin/footer');	
	}

	// fungsi hapus
  	function hapus($id_style_glove)
  	{
		$this->Mproduction_order->hapus_style($id_style_glove);
		redirect('admin/data_master/style_glove/style_glove','refresh');
	}

}

?>