<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sub_jenis extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('Mprofil');
		$this->load->model('Mbarang');
		
		// Agar login admin tidak jebol
		if (!$this->session->userdata('admin')) {
			echo "<script>alert('Anda harus login terlebih dahulu');location='".base_url("admin/login")."'</script>";
		}
	}

	public function index()
	{
		$session = $this->session->userdata('admin');
		$data['admin'] = $this->Mprofil->ambil_admin($session['id_admin']);
		$data['sub_jenis'] = $this->Mbarang->tampil_sub_jenis(); 
		
		$this->load->view('admin/header',$data);	
		$this->load->view('admin/navbar',$data);
		$this->load->view('admin/data_master/barang/data_sub_jenis/tampil',$data);
		$this->load->view('admin/footer');	
	}

	// fungsi tambah
	function tambah() 
	{
		$session = $this->session->userdata('admin');
		$data['admin'] = $this->Mprofil->ambil_admin($session['id_admin']);
		$data['jenis'] = $this->Mbarang->tampil_jenis();

		$this->load->library("form_validation");
		$this->form_validation->set_rules("sub_jenis", "Nama Sub Jenis", "required|is_unique[sub_jenis.sub_jenis]");
		$this->form_validation->set_message("required", "%s harus diisi");
		$this->form_validation->set_message("is_unique", "%s yang diisikan sudah ada");
		
		if ($this->form_validation->run() == TRUE) 
		{
			// Msupplier menjalankan fungsi tambah_kategori
			$this->Mbarang->tambah_sub_jenis($this->input->post());
			echo "<script>";
			echo "alert('Data berhasil ditambahkan');";
			echo "location='".base_url("admin/data_master/barang/data_sub_jenis/sub_jenis")."';";
			echo "</script>";
		}
		else
		{
			// selain itu salah
			$data["error"] = validation_errors();
		}

		$this->load->view('admin/header',$data);	
		$this->load->view('admin/navbar',$data);
		$this->load->view('admin/data_master/barang/data_sub_jenis/tambah',$data);
		$this->load->view('admin/footer');
	}
	// ./fungsi tambah

	// fungsi ubah
	function ubah($id_sub_jenis) 
	{		
		$session = $this->session->userdata('admin');
		$data['admin'] = $this->Mprofil->ambil_admin($session['id_admin']);
		$data['sub_jenis'] = $this->Mbarang->ambil_sub_jenis($id_sub_jenis);
		$data['jenis'] = $this->Mbarang->tampil_jenis();

		$this->load->library("form_validation");
		$this->form_validation->set_rules("sub_jenis", "Nama Sub Jenis", "required");
		$this->form_validation->set_message("required", "%s harus diisi");

		if ($this->form_validation->run() == TRUE)
		{
			$this->input->post();
			$this->Mbarang->ubah_sub_jenis($this->input->post(),$id_sub_jenis);
			echo "<script>";
			echo "alert('Data berhasil diubah');";
			echo "location='".base_url("admin/data_master/barang/data_sub_jenis/sub_jenis")."';";
			echo "</script>";
		}
		else
		{
      		// selain itu salah
			$data["error"] = validation_errors();
		}

		$this->load->view('admin/header',$data);	
		$this->load->view('admin/navbar',$data);
		$this->load->view('admin/data_master/barang/data_sub_jenis/ubah',$data);
		$this->load->view('admin/footer');
	}
	// ./fungsi ubah

	// fungsi hapus
	public function hapus($id_sub_jenis) 
	{
		$this->Mbarang->hapus_sub_jenis($id_sub_jenis);
		echo "<script>";
		echo "alert('Data berhasil dihapus');";
		echo "location='".base_url("admin/data_master/barang/data_sub_jenis/sub_jenis','refresh")."';";
		echo "</script>";
	}

}
?>