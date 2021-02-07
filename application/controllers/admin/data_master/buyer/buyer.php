<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buyer extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('Mprofil');
		$this->load->model('Mbuyer');
		
		// Agar admin user tidak jebol
		if (!$this->session->userdata('admin')) {
			echo "<script>alert('Anda harus login terlebih dahulu');location='".base_url("admin/login")."'</script>";
		}
	}

	public function index()
	{
		$session = $this->session->userdata('admin');
		$data['admin'] = $this->Mprofil->ambil_admin($session['id_admin']);
		$data['buyer'] = $this->Mbuyer->tampil_buyer();
		
		$this->load->view('admin/header',$data);	
		$this->load->view('admin/navbar',$data);
		$this->load->view('admin/data_master/buyer/tampil',$data);
		$this->load->view('admin/footer');	
	}

	// fungsi detail
	function detail($id_buyer) 
	{
		$session = $this->session->userdata('admin');
		$data['admin'] = $this->Mprofil->ambil_admin($session['id_admin']);
		$data['buyer'] = $this->Mbuyer->ambil_buyer($id_buyer);
		$data['view_buyer'] = $this->Mbuyer->tampil_buyer();

		$this->load->view('admin/header',$data);
		$this->load->view('admin/navbar',$data);
		$this->load->view('admin/data_master/buyer/detail',$data);
		$this->load->view('admin/footer');
	}

// fungsi tambah
	function tambah() 
	{
		$session = $this->session->userdata('admin');
		$data['admin'] = $this->Mprofil->ambil_admin($session['id_admin']);
		$data['kode_otomatis'] = $this->Mbuyer->kode_otomatis();

		// memanggil library form validation
		$this->load->library("form_validation");
		$this->form_validation->set_rules("nama_buyer", "Nama Buyer", "required|is_unique[buyer.nama_buyer]");
		// $this->form_validation->set_rules("no_telp", "No.Telepon", "required");
		// $this->form_validation->set_rules("no_fax", "No.Faximile", "required");
		// $this->form_validation->set_rules("email", "Email", "required|valid_email");
		$this->form_validation->set_message("required", "%s harus diisi");
		$this->form_validation->set_message("is_unique", "%s yang diisikan sudah ada");

		// jika ada inputan dari form validasi bernilai benar
		if ($this->form_validation->run() == TRUE) 
		{
			// Msupplier menjalankan fungsi tambah_supplier
			$this->Mbuyer->tambah_buyer($this->input->post());
			echo "<script>";
			echo "alert('Data berhasil ditambahkan');";
			echo "location='".base_url("admin/data_master/buyer/buyer")."';";
			echo "</script>";
		}
		// selain itu salah
		else
		{
			$data["error"] = validation_errors();
		}

		$this->load->view('admin/header',$data);  
		$this->load->view('admin/navbar',$data);
		$this->load->view('admin/data_master/buyer/tambah',$data);
		$this->load->view('admin/footer');
	}
	
	// fungsi ubah
	function ubah($id_buyer) 
	{
		$session = $this->session->userdata('admin');
		$data['admin'] = $this->Mprofil->ambil_admin($session['id_admin']);
		$data['buyer'] = $this->Mbuyer->ambil_buyer($id_buyer);
		$data['view_buyer'] = $this->Mbuyer->tampil_buyer();

		$this->form_validation->set_rules("nama_buyer", "Nama Buyer", "required");
		// $this->form_validation->set_rules("no_telp", "No.Telepon", "required");
		// $this->form_validation->set_rules("no_fax", "No.Faximile", "required");
		// $this->form_validation->set_rules("email", "Email", "required|valid_email");
		$this->form_validation->set_message("required", "%s harus diisi");

		if ($this->form_validation->run() == TRUE) 
		{
			$this->input->post();
			$this->Mbuyer->ubah_buyer($this->input->post(),$id_buyer);
			// redirect("admin/data_master/perusahaan/perusahaan","refresh");	
			echo "<script>";
			echo "alert('Data berhasil diubah');";
			echo "location='".base_url("admin/data_master/buyer/buyer")."';";
			echo "</script>";		
		}
		// selain itu salah
		else
		{
			$data["error"] = validation_errors();
		}

		$this->load->view('admin/header',$data);  
		$this->load->view('admin/navbar',$data);
		$this->load->view('admin/data_master/buyer/ubah',$data);
		$this->load->view('admin/footer');	
	}

	// fungsi hapus
	function hapus($id_buyer) 
	{
		$this->Mbuyer->hapus_buyer($id_buyer);
		echo "<script>";
		echo "alert('Data berhasil dihapus');";
		echo "location='".base_url("admin/data_master/buyer/buyer")."';";
		echo "</script>";
	}

}

?>