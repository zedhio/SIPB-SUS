<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    //Do your magic here
    $this->load->model('Mprofil');
    $this->load->model('Mkaryawan');
    $this->load->model('Mpengaturan_u');
    
    // Agar login admin tidak jebol
    if (!$this->session->userdata('admin')) {
      echo "<script>alert('Anda harus login terlebih dahulu');location='".base_url("admin/login")."'</script>";
    }
  }

  public function index()
  {
    $session = $this->session->userdata('admin');
    $data['admin'] = $this->Mprofil->ambil_admin($session['id_admin']);
    $data['user'] = $this->Mpengaturan_u->tampil_user(); 
    
    $this->load->view('admin/header',$data);  
    $this->load->view('admin/navbar',$data);
    $this->load->view('admin/pengaturan/user/tampil',$data);
    $this->load->view('admin/footer');  
  }

  function tambah() 
  {
    $session = $this->session->userdata('admin');
    $data['admin'] = $this->Mprofil->ambil_admin($session['id_admin']);
    $data['karyawan'] = $this->Mkaryawan->tampil_karyawan();
    $data['jabatan'] = $this->Mkaryawan->tampil_jabatan();
    
    // mengambil nama karyawan ketika input pilih nik
    if ($this->input->post('id_karyawan')) 
    {
      $id_karyawan = $this->input->post('id_karyawan');
    }
    else
    {
      $id_karyawan = "";
    }

    $data['ambil'] = $this->Mkaryawan->ambil_karyawan($id_karyawan);

    if($this->input->post('simpan'))
    {
      $input = $this->input->post();
      // tampung nilai variabel input post ke variabel inputan 
      $inputan['id_karyawan'] = $input['id_karyawan'];
      $inputan['password'] = $input['password'];
      $inputan['level'] = $input['level'];

      // echo "<pre>";
      // echo print_r($input);
      // echo "</pre>";

      $this->Mpengaturan_u->tambah_user($inputan);
      echo "<script>";
      echo "alert('Data berhasil ditambahkan');";
      echo "location='".base_url("admin/pengaturan/user/user")."';";
      echo "</script>";
    }

    $this->load->view('admin/header',$data);  
    $this->load->view('admin/navbar',$data);
    $this->load->view('admin/pengaturan/user/tambah',$data);
    $this->load->view('admin/footer');
  }

  function ubah($id_user) 
  {
    $session = $this->session->userdata('admin');
    $data['admin'] = $this->Mprofil->ambil_admin($session['id_admin']);
    $data['karyawan'] = $this->Mkaryawan->tampil_karyawan();
    $data['jabatan'] = $this->Mkaryawan->tampil_jabatan();
    $data['user'] = $this->Mpengaturan_u->ambil_user($id_user);
    $data['ambil'] = $this->Mkaryawan->ambil_karyawan($id_user);

    if ($this->input->post()) 
    {
      $this->Mpengaturan_u->ubah_user($this->input->post(),$id_user);
      echo "<script>";
      echo "alert('Data berhasil diubah');";
      echo "location='".base_url("admin/pengaturan/user/user")."';";
      echo "</script>";
    }

    $this->load->view('admin/header',$data);  
    $this->load->view('admin/navbar',$data);
    $this->load->view('admin/pengaturan/user/ubah',$data);
    $this->load->view('admin/footer');
  }

  // fungsi hapus
  public function hapus($id_user) 
  {
    $this->Mpengaturan_u->hapus_user($id_user);
    echo "<script>";
    echo "alert('Data berhasil dihapus');";
    echo "location='".base_url("admin/pengaturan/user/user','refresh")."';";
    echo "</script>";
  }
  // ./fungsi hapus

} 
?>