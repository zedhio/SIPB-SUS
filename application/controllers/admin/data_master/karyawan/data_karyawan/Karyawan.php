<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Karyawan extends CI_Controller {

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
    $data['admin']=$this->Mprofil->ambil_admin($session['id_admin']);
    $data['karyawan'] = $this->Mkaryawan->tampil_karyawan(); 
    
    $this->load->view('admin/header',$data);  
    $this->load->view('admin/navbar',$data);
    $this->load->view('admin/data_master/karyawan/data_karyawan/tampil',$data);
    $this->load->view('admin/footer');  
  }

  // fungsi tambah
  function tambah() 
  {
    $session = $this->session->userdata('admin');
    $data['admin'] = $this->Mprofil->ambil_admin($session['id_admin']);
    $data['bagian'] = $this->Mkaryawan->tampil_bagian();
    $data['jabatan'] = $this->Mkaryawan->tampil_jabatan();
    // $data['kode_otomatis'] = $this->Mkaryawan->kode_otomatis();

    $this->form_validation->set_rules("nama_karyawan", "Nama Karyawan", "required|is_unique[karyawan.nama_karyawan]");
    $this->form_validation->set_message("required", "%s harus diisi");
    $this->form_validation->set_message("is_unique", "%s sudah ada");
    
    if ($this->form_validation->run() == TRUE) 
    {
      $this->Mkaryawan->tambah_karyawan($this->input->post());
      echo "<script>";
      echo "alert('Data berhasil ditambahkan');";
      echo "location='".base_url("admin/data_master/karyawan/data_karyawan/karyawan")."';";
      echo "</script>";
    }
    // selain itu salah
    else
    {
      $data["error"] = validation_errors();
    }

    $this->load->view('admin/header',$data);  
    $this->load->view('admin/navbar',$data);
    $this->load->view('admin/data_master/karyawan/data_karyawan/tambah',$data);
    $this->load->view('admin/footer');
  }
  // ./fungsi tambah

  // fungsi ubah
  function ubah($id_karyawan) 
  {
    $session = $this->session->userdata('admin');
    $data['admin'] = $this->Mprofil->ambil_admin($session['id_admin']);
    $data['bagian'] = $this->Mkaryawan->tampil_bagian();
    $data['jabatan'] = $this->Mkaryawan->tampil_jabatan();
    $data['karyawan'] = $this->Mkaryawan->ambil_karyawan($id_karyawan);
    
    $this->form_validation->set_rules("nama_karyawan", "Nama Karyawan", "required");
    // $this->form_validation->set_rules("tmp_lhr", "Tempat Lahir", "required");
    // $this->form_validation->set_rules("tgl_lhr", "Tanggal Laahir", "required");
    // $this->form_validation->set_rules("alamat", "Alamat", "required");
    $this->form_validation->set_message("required", "%s harus diisi");
    
    if ($this->form_validation->run() == TRUE) 
    {
      $this->input->post();
      $this->Mkaryawan->ubah_karyawan($this->input->post(),$id_karyawan);
      echo "<script>";
      echo "alert('Data berhasil diubah');";
      echo "location='".base_url("admin/data_master/karyawan/data_karyawan/karyawan")."';";
      echo "</script>";       
    }
    // selain itu salah
    else
    {
      $data["error"] = validation_errors();
    }    

    $this->load->view('admin/header',$data);  
    $this->load->view('admin/navbar',$data);
    $this->load->view('admin/data_master/karyawan/data_karyawan/ubah',$data);
    $this->load->view('admin/footer');
  }
  // ./fungsi ubah

  // fungsi hapus
  public function hapus($id_karyawan) 
  {
    $this->Mkaryawan->hapus_karyawan($id_karyawan);
    echo "<script>";
    echo "alert('Data berhasil dihapus');";
    echo "location='".base_url("admin/data_master/karyawan/data_karyawan/karyawan','refresh")."';";
    echo "</script>";
  }
  // ./fungsi hapus

  // fungsi detail
  function detail($id_karyawan) 
  {
    $session = $this->session->userdata('admin');
    $data['admin']=$this->Mprofil->ambil_admin($session['id_admin']);
    $data['karyawan']=$this->Mkaryawan->ambil_karyawan($id_karyawan);
    
    $this->load->view('admin/header',$data);
    $this->load->view('admin/navbar',$data);
    $this->load->view('admin/data_master/karyawan/data_karyawan/detail',$data);
    $this->load->view('admin/footer');
  }

} 
?>