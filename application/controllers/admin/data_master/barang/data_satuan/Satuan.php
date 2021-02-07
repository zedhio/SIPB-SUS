<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Satuan extends CI_Controller {

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
    $data['satuan'] = $this->Mbarang->tampil_satuan(); 
    
    $this->load->view('admin/header',$data);  
    $this->load->view('admin/navbar',$data);
    $this->load->view('admin/data_master/barang/data_satuan/tampil',$data);
    $this->load->view('admin/footer');  
  }

  // fungsi tambah
  function tambah() 
  {
    $session = $this->session->userdata('admin');
    $data['admin'] = $this->Mprofil->ambil_admin($session['id_admin']);

    // memanggil library form validation
    $this->load->library("form_validation");

    // menggunakan library form validation untuk mengatur validasi yang ditentukan seperti input required / data unik
    $this->form_validation->set_rules("satuan", "Nama Satuan", "required|is_unique[satuan.satuan]");

    // mengatur pesan error bahwa nilai inputan nama satuan tidak boleh kosong
    $this->form_validation->set_message("required", "%s harus diisi");
    // mengatur pesan error bahwa nilai inputan nama satuan tidak boleh sama dengan nama yang sudah ada
    $this->form_validation->set_message("is_unique", "%s yang diisikan sudah ada");
    
    if ($this->form_validation->run() == TRUE)
    {
      // Mbarang menjalankan fungsi tambah_satuan
      $this->Mbarang->tambah_satuan($this->input->post());
      echo "<script>";
      echo "alert('Data berhasil ditambahkan');";
      echo "location='".base_url("admin/data_master/barang/data_satuan/satuan")."';";
      echo "</script>";
    }
    else
    {
      // selain itu salah
      $data["error"] = validation_errors();
    }

    $this->load->view('admin/header',$data);  
    $this->load->view('admin/navbar',$data);
    $this->load->view('admin/data_master/barang/data_satuan/tambah',$data);
    $this->load->view('admin/footer');
  }
  // ./fungsi tambah

  // fungsi ubah
  function ubah($id_satuan) 
  {   
    $session = $this->session->userdata('admin');
    $data['admin'] = $this->Mprofil->ambil_admin($session['id_admin']);
    $data['satuan'] = $this->Mbarang->ambil_satuan($id_satuan);

    // memanggil library form validation
    $this->load->library("form_validation");

    // menggunakan library form validation untuk mengatur validasi yang ditentukan seperti input required / data unik
    $this->form_validation->set_rules("satuan", "Nama Satuan", "required");

    // mengatur pesan error bahwa nilai inputan nama satuan tidak boleh kosong
    $this->form_validation->set_message("required", "%s harus diisi");

    if ($this->form_validation->run() == TRUE)
    {
      $this->input->post();
      $this->Mbarang->ubah_satuan($this->input->post(),$id_satuan);
      echo "<script>";
      echo "alert('Data berhasil diubah');";
      echo "location='".base_url("admin/data_master/barang/data_satuan/satuan")."';";
      echo "</script>";
    }
    else
    {
      // selain itu salah
      $data["error"] = validation_errors();
    }

    $this->load->view('admin/header',$data);  
    $this->load->view('admin/navbar',$data);
    $this->load->view('admin/data_master/barang/data_satuan/ubah',$data);
    $this->load->view('admin/footer');
  }
  // ./fungsi ubah

  // fungsi hapus
  public function hapus($id_satuan) 
  {
    $this->Mbarang->hapus_satuan($id_satuan);
    echo "<script>";
    echo "alert('Data berhasil dihapus');";
    echo "location='".base_url("admin/data_master/barang/data_satuan/satuan','refresh")."';";
    echo "</script>";
  }

} 
?>