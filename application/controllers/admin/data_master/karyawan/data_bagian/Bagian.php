<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bagian extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    //Do your magic here
    $this->load->model('Mprofil');
    $this->load->model('Mkaryawan');
    
    // Agar login user tidak jebol
    if (!$this->session->userdata('admin')) {
      echo "<script>alert('Anda harus login terlebih dahulu');location='".base_url("admin/login")."'</script>";
    }
  }

  public function index()
  {
    $session = $this->session->userdata('admin');
    $data['admin'] = $this->Mprofil->ambil_admin($session['id_admin']);
    $data['bagian'] = $this->Mkaryawan->tampil_bagian(); 
    
    $this->load->view('admin/header',$data);  
    $this->load->view('admin/navbar',$data);
    $this->load->view('admin/data_master/karyawan/data_bagian/tampil',$data);
    $this->load->view('admin/footer');  
  }

  // fungsi tambah
  function tambah() 
  {
    $session = $this->session->userdata('admin');
    $data['admin'] = $this->Mprofil->ambil_admin($session['id_admin']);

    $this->load->library("form_validation");
    $this->form_validation->set_rules("bagian", "Nama Bagian", "required|is_unique[bagian.bagian]");
    $this->form_validation->set_message("required", "%s harus diisi");
    $this->form_validation->set_message("is_unique", "%s yang diisikan sudah ada");
    
    if ($this->form_validation->run() == TRUE) 
    {
      // Msatuan menjalankan fungsi tambah_satuan
      $this->Mkaryawan->tambah_bagian($this->input->post());
      echo "<script>";
      echo "alert('Data berhasil ditambahkan');";
      echo "location='".base_url("admin/data_master/karyawan/data_bagian/bagian")."';";
      echo "</script>";
    }
    else
    {
      // selain itu salah
      $data["error"] = validation_errors();
    }

    $this->load->view('admin/header',$data);  
    $this->load->view('admin/navbar',$data);
    $this->load->view('admin/data_master/karyawan/data_bagian/tambah',$data);
    $this->load->view('admin/footer');
  }
  // ./fungsi tambah

  // fungsi ubah
  function ubah($id_bagian) 
  {   
    $session = $this->session->userdata('admin');
    $data['admin']=$this->Mprofil->ambil_admin($session['id_admin']);
    $data['bagian']=$this->Mkaryawan->ambil_bagian($id_bagian);

    $this->load->library("form_validation");
    $this->form_validation->set_rules("bagian", "Nama Bagian", "required");
    $this->form_validation->set_message("required", "%s harus diisi");

    if ($this->form_validation->run() == TRUE) 
    {
      $this->input->post();
      $this->Mkaryawan->ubah_bagian($this->input->post(),$id_bagian);
      echo "<script>";
      echo "alert('Data berhasil diubah');";
      echo "location='".base_url("admin/data_master/karyawan/data_bagian/bagian")."';";
      echo "</script>";         
    }
    else
    {
      // selain itu salah
      $data["error"] = validation_errors();
    }

    $this->load->view('admin/header',$data);  
    $this->load->view('admin/navbar',$data);
    $this->load->view('admin/data_master/karyawan/data_bagian/ubah',$data);
    $this->load->view('admin/footer');
  }
  // ./fungsi ubah

  // fungsi hapus
  public function hapus($id_bagian) 
  {
    $this->Mkaryawan->hapus_bagian($id_bagian);
    echo "<script>";
    echo "alert('Data berhasil dihapus');";
    echo "location='".base_url("admin/data_master/karyawan/data_bagian/bagian','refresh")."';";
    echo "</script>";
  }

} 
?>