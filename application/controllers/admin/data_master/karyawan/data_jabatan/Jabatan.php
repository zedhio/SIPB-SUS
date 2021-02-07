<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jabatan extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    //Do your magic here
    $this->load->model('Mprofil');
    $this->load->model('Mkaryawan');
    
    // Agar login admin tidak jebol
    if (!$this->session->userdata('admin')) {
      echo "<script>alert('Anda harus login terlebih dahulu');location='".base_url("admin/login")."'</script>";
    }
  }

  public function index()
  {
    $session = $this->session->userdata('admin');
    $data['admin'] = $this->Mprofil->ambil_admin($session['id_admin']);
    $data['jabatan'] = $this->Mkaryawan->tampil_jabatan(); 
    
    $this->load->view('admin/header',$data);  
    $this->load->view('admin/navbar',$data);
    $this->load->view('admin/data_master/karyawan/data_jabatan/tampil',$data);
    $this->load->view('admin/footer');  
  }

  // fungsi tambah
  function tambah() 
  {
    $session = $this->session->userdata('admin');
    $data['admin'] = $this->Mprofil->ambil_admin($session['id_admin']);

    $this->load->library("form_validation");
    $this->form_validation->set_rules("jabatan", "Nama Jabatan", "required|is_unique[jabatan.jabatan]");
    $this->form_validation->set_message("required", "%s harus diisi");
    $this->form_validation->set_message("is_unique", "%s yang diisikan sudah ada");
    
    if ($this->form_validation->run() == TRUE) 
    {
      // Msatuan menjalankan fungsi tambah_satuan
      $this->Mkaryawan->tambah_jabatan($this->input->post());
      echo "<script>";
      echo "alert('Data berhasil ditambahkan');";
      echo "location='".base_url("admin/data_master/karyawan/data_jabatan/jabatan")."';";
      echo "</script>";
    }
    else
    {
      // selain itu salah
      $data["error"] = validation_errors();
    }

    $this->load->view('admin/header',$data);  
    $this->load->view('admin/navbar',$data);
    $this->load->view('admin/data_master/karyawan/data_jabatan/tambah',$data);
    $this->load->view('admin/footer');
  }
  // ./fungsi tambah

  // fungsi ubah
  function ubah($id_jabatan) 
  {   
    $session = $this->session->userdata('admin');
    $data['admin'] = $this->Mprofil->ambil_admin($session['id_admin']);
    $data['jabatan'] = $this->Mkaryawan->ambil_jabatan($id_jabatan);

    $this->load->library("form_validation");
    $this->form_validation->set_rules("jabatan", "Nama Jabatan", "required");
    $this->form_validation->set_message("required", "%s harus diisi");

    if ($this->form_validation->run() == TRUE) 
    {
      $this->input->post();
      $this->Mjabatan->ubah_jabatan($this->input->post(),$id_jabatan);
      echo "<script>";
      echo "alert('Data berhasil diubah');";
      echo "location='".base_url("admin/data_master/karyawan/data_jabatan/jabatan")."';";
      echo "</script>";       
    }
    else
    {
      // selain itu salah
      $data["error"] = validation_errors();
    }    

    $this->load->view('admin/header',$data);  
    $this->load->view('admin/navbar',$data);
    $this->load->view('admin/data_master/karyawan/data_jabatan/ubah',$data);
    $this->load->view('admin/footer');
  }
  // ./fungsi ubah

  // fungsi hapus
  public function hapus($id_jabatan) 
  {
    $this->Mkaryawan->hapus_jabatan($id_jabatan);
    echo "<script>";
    echo "alert('Data berhasil dihapus');";
    echo "location='".base_url("admin/data_master/karyawan/data_jabatan/jabatan','refresh")."';";
    echo "</script>";
  }

} 
?>