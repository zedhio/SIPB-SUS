<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Merek extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
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
    $data['merek'] = $this->Mbarang->tampil_merek(); 
    
    $this->load->view('admin/header',$data);  
    $this->load->view('admin/navbar',$data);
    $this->load->view('admin/data_master/barang/data_merek/tampil',$data);
    $this->load->view('admin/footer');  
  }

  // fungsi tambah
  function tambah() 
  {
    $session = $this->session->userdata('admin');
    $data['admin'] = $this->Mprofil->ambil_admin($session['id_admin']);

    $this->load->library("form_validation");
    $this->form_validation->set_rules("merek", "Nama Merek", "required|is_unique[merek.merek]");
    $this->form_validation->set_message("required", "%s harus diisi");
    $this->form_validation->set_message("is_unique", "%s yang diisikan sudah ada");
    
    if ($this->form_validation->run() == TRUE) 
    {
      // Msupplier menjalankan fungsi tambah_jenis
      $this->Mbarang->tambah_merek($this->input->post());
      echo "<script>";
      echo "alert('Data berhasil ditambahkan');";
      echo "location='".base_url("admin/data_master/barang/data_merek/merek")."';";
      echo "</script>";
    }
    else
    {
      // selain itu salah
      $data["error"] = validation_errors();
    }

    $this->load->view('admin/header',$data);  
    $this->load->view('admin/navbar',$data);
    $this->load->view('admin/data_master/barang/data_merek/tambah',$data);
    $this->load->view('admin/footer');
  }
  // ./fungsi tambah

  // fungsi ubah
  function ubah($id_merek) 
  {   
    $session = $this->session->userdata('admin');
    $data['admin'] = $this->Mprofil->ambil_admin($session['id_admin']);
    $data['merek'] = $this->Mbarang->ambil_merek($id_merek);

    $this->load->library("form_validation");
    $this->form_validation->set_rules("merek", "Nama Merek", "required");
    $this->form_validation->set_message("required", "%s harus diisi");

    if ($this->form_validation->run() == TRUE)
    {
      $this->input->post();
      $this->Mbarang->ubah_merek($this->input->post(),$id_merek);
      echo "<script>";
      echo "alert('Data berhasil diubah');";
      echo "location='".base_url("admin/data_master/barang/data_merek/merek")."';";
      echo "</script>";
    }
    else
    {
      // selain itu salah
      $data["error"] = validation_errors();
    }

    $this->load->view('admin/header',$data);  
    $this->load->view('admin/navbar',$data);
    $this->load->view('admin/data_master/barang/data_merek/ubah',$data);
    $this->load->view('admin/footer');
  }
  // ./fungsi ubah

  // fungsi hapus
  public function hapus($id_merek) 
  {
    $this->Mbarang->hapus_merek($id_merek);
    echo "<script>";
    echo "alert('Data berhasil dihapus');";
    echo "location='".base_url("admin/data_master/barang/data_merek/merek','refresh")."';";
    echo "</script>";
  }

} 
?>