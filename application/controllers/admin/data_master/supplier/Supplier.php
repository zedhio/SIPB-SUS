<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('Mprofil');
		$this->load->model('Msupplier');
		
		// Agar login admin tidak jebol
		if (!$this->session->userdata('admin')) {
			echo "<script>alert('Anda harus login terlebih dahulu');location='".base_url("admin/login")."'</script>";
		}
	}

	public function index()
	{
		$session = $this->session->userdata('admin');
		$data['admin']=$this->Mprofil->ambil_admin($session['id_admin']);
		$data['supplier'] = $this->Msupplier->tampil_supplier(); 
		
		$this->load->view('admin/header',$data);	
		$this->load->view('admin/navbar',$data);
		$this->load->view('admin/data_master/supplier/tampil',$data);
		$this->load->view('admin/footer');	
	}

	// fungsi detail
	function detail($id_supplier) 
	{
		$session = $this->session->userdata('admin');
		$data['admin']=$this->Mprofil->ambil_admin($session['id_admin']);
		$data['supplier']=$this->Msupplier->ambil_supplier($id_supplier);
		$data['view_supplier'] = $this->Msupplier->tampil_supplier();

		$this->load->view('admin/header',$data);
		$this->load->view('admin/navbar',$data);
		$this->load->view('admin/data_master/supplier/detail',$data);
		$this->load->view('admin/footer');
	}

	// fungsi tambah
	function tambah() 
	{
		$session = $this->session->userdata('admin');
		$data['admin'] = $this->Mprofil->ambil_admin($session['id_admin']);
		$data['kode_otomatis'] = $this->Msupplier->kode_otomatis();

		// memanggil library form validation
		$this->load->library("form_validation");
		// menggunakan library form validation untuk meminta nama supplier
		$this->form_validation->set_rules("nama_supplier", "Nama Supplier", "required|is_unique[supplier.nama_supplier]");
		// mengatur pesan error
		$this->form_validation->set_message("required", "%s harus diisi");
		$this->form_validation->set_message("is_unique", "%s yang diisikan sudah ada");

		// jika ada inputan dari form validasi bernilai benar
		if ($this->form_validation->run() == TRUE) 
		{
			// Msupplier menjalankan fungsi tambah_supplier
			$this->Msupplier->tambah_supplier($this->input->post());
			echo "<script>";
			echo "alert('Data berhasil ditambahkan');";
			echo "location='".base_url("admin/data_master/supplier/supplier")."';";
			echo "</script>";
		}
		// selain itu salah
		else
		{
			$data["error"] = validation_errors();
		}

		$this->load->view('admin/header',$data);  
		$this->load->view('admin/navbar',$data);
		$this->load->view('admin/data_master/supplier/tambah',$data);
		$this->load->view('admin/footer');
	}
  	
	// fungsi ubah
	function ubah($id_supplier) 
	{
		$session = $this->session->userdata('admin');
		$data['admin']=$this->Mprofil->ambil_admin($session['id_admin']);
		$data['supplier']=$this->Msupplier->ambil_supplier($id_supplier);
		$data['view_supplier']=$this->Msupplier->tampil_supplier();

		// memanggil library form validation
		$this->load->library("form_validation");
		// menggunakan library form validation untuk meminta nama supplier
		$this->form_validation->set_rules("nama_supplier", "Nama Supplier", "required");
		// mengatur pesan error
		$this->form_validation->set_message("is_unique", "%s yang diisikan sudah ada");

		if ($this->form_validation->run() == TRUE) 
		{
			$this->input->post();
			$this->Msupplier->ubah_supplier($this->input->post(),$id_supplier);
			// redirect("admin/data_master/perusahaan/perusahaan","refresh");	
			echo "<script>";
			echo "alert('Data berhasil diubah');";
			echo "location='".base_url("admin/data_master/supplier/supplier")."';";
			echo "</script>";		
		}
		// selain itu salah
		else
		{
			$data["error"] = validation_errors();
		}

		$this->load->view('admin/header',$data);  
		$this->load->view('admin/navbar',$data);
		$this->load->view('admin/data_master/supplier/ubah',$data);
		$this->load->view('admin/footer');	
	}

	// fungsi hapus
  	function hapus($id_supplier) 
  	{
		$this->Msupplier->hapus_supplier($id_supplier);
		redirect('admin/data_master/supplier/supplier','refresh');
	}

}

?>