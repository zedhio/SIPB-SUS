<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {

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
		$data['admin']=$this->Mprofil->ambil_admin($session['id_admin']);
		$data['barang'] = $this->Mbarang->tampil_barang(); 
		$this->load->view('admin/header',$data);	
		$this->load->view('admin/navbar',$data);
		$this->load->view('admin/data_master/barang/data_barang/tampil',$data);
		$this->load->view('admin/footer');	
	}

	// fungsi tambah
	function tambah()
	{
		$session = $this->session->userdata('admin');
		$data['admin'] = $this->Mprofil->ambil_admin($session['id_admin']);
		$data['sub_jenis'] = $this->Mbarang->tampil_sub_jenis();
		$data['jenis'] = $this->Mbarang->tampil_jenis();
		$data['satuan'] = $this->Mbarang->tampil_satuan();
		$data['kode_otomatis'] = $this->Mbarang->kode_otomatis();

		if ($this->input->post('id_jenis')) 
		{
			$data['id_jenis'] = $this->input->post('id_jenis');
		}
		else
		{
			$data['id_jenis'] = "";
		}

		$data['ambil'] = $this->Mbarang->ambil_jenis_subjenis($data['id_jenis']);

		if ($this->input->post('simpan')) 
		{
		 	
			$input = $this->input->post();
      		// tampung nilai variabel input post ke variabel inputan 
			$inputan['kode_barang'] = $input['kode_barang'];
			$inputan['id_jenis'] = $input['id_jenis'];
			$inputan['id_sub_jenis'] = $input['id_sub_jenis'];
			$inputan['nama_barang'] = $input['nama_barang'];
			$inputan['stok'] = $input['stok'];
			$inputan['warna'] = $input['warna'];
			$inputan['id_satuan'] = $input['id_satuan'];
			$inputan['keterangan_barang'] = $input['keterangan_barang'];

		 	$this->Mbarang->tambah_barang($inputan);
		   	echo "<script>";
		   	echo "alert('Data berhasil ditambahkan');";
		   	echo "location='".base_url("admin/data_master/barang/data_barang/barang")."';";
		   	echo "</script>";
		}

		$this->load->view('admin/header',$data);	
		$this->load->view('admin/navbar',$data);
		$this->load->view('admin/data_master/barang/data_barang/tambah',$data);
		$this->load->view('admin/footer');
	}

	// fungsi detail
	function detail($id_barang) 
	{
		$session = $this->session->userdata('admin');
		$data['admin']=$this->Mprofil->ambil_admin($session['id_admin']);
		$data['barang']=$this->Mbarang->ambil_barang($id_barang);
		
		$this->load->view('admin/header',$data);
		$this->load->view('admin/navbar',$data);
		$this->load->view('admin/data_master/barang/data_barang/detail',$data);
		$this->load->view('admin/footer');
	}

	// fungsi ubah
	function ubah($id_barang) 
	{
		$session = $this->session->userdata('admin');
		$data['admin'] = $this->Mprofil->ambil_admin($session['id_admin']);
		$data['sub_jenis'] = $this->Mbarang->tampil_sub_jenis();
		$data['jenis'] = $this->Mbarang->tampil_jenis();
		// $data['merek'] = $this->Mbarang->tampil_merek();
		$data['satuan'] = $this->Mbarang->tampil_satuan();
		$data['barang'] = $this->Mbarang->ambil_barang($id_barang);
		
		// $this->load->library("form_validation");		
		// $this->form_validation->set_rules("nama_barang", "Nama Barang", "required");
		// $this->form_validation->set_message("required", "%s harus diisi");

		// if ($this->form_validation->run() == TRUE) 
		// {
		// 	$this->input->post();
		// 	$this->Mbarang->ubah_barang($this->input->post(),$id_barang);
		// 	echo "<script>";
		// 	echo "alert('Data berhasil diubah');";
		// 	echo "location='".base_url("admin/data_master/barang/data_barang/barang")."';";
		// 	echo "</script>";
		// }
		// else
		// {
		// 	// selain itu salah
		// 	$data["error"] = validation_errors();
		// }

		if ($this->input->post('id_jenis')) 
		{
			$data['id_jenis'] = $this->input->post('id_jenis');
		}
		else
		{
			$data['id_jenis'] = $data['barang']['id_jenis'];
		}

		$data['ambil'] = $this->Mbarang->ambil_jenis_subjenis($data['id_jenis']);

		if ($this->input->post('ubah')) 
		{
		 	
			$input = $this->input->post();
      		// tampung nilai variabel input post ke variabel inputan
      		$inputan['kode_barang'] = $input['kode_barang'];
			$inputan['id_jenis'] = $input['id_jenis'];
			$inputan['id_sub_jenis'] = $input['id_sub_jenis'];
			$inputan['nama_barang'] = $input['nama_barang'];
			$inputan['warna'] = $input['warna'];
			$inputan['stok'] = $input['stok'];
			$inputan['id_satuan'] = $input['id_satuan'];
			$inputan['keterangan_barang'] = $input['keterangan_barang'];

		 	 $this->Mbarang->ubah_barang($inputan,$id_barang);
		   	 echo "<script>";
		   	 echo "alert('Data berhasil diubah');";
		   	 echo "location='".base_url("admin/data_master/barang/data_barang/barang")."';";
		   	 echo "</script>";
		}

		$this->load->view('admin/header',$data);	
		$this->load->view('admin/navbar',$data);
		$this->load->view('admin/data_master/barang/data_barang/ubah',$data);
		$this->load->view('admin/footer');
	}
	// ./fungsi ubah

	// fungsi hapus
	public function hapus($id_barang) 
	{
		$this->Mbarang->hapus_barang($id_barang);
		echo "<script>";
		echo "alert('Data berhasil dihapus');";
		echo "location='".base_url("admin/data_master/barang/data_barang/barang','refresh")."';";
		echo "</script>";
	}
	// ./fungsi hapus

	function hitung(){
		$data = $this->Mbarang->kurang_stok();
		echo $data['total'];
	}

	function barang_kurang(){
		$data = $this->Mbarang->barang_kurang();
		foreach ($data as $key => $value) {
			echo "<li><a href='".base_url("admin/data_master/barang/data_barang/barang")."' style='color: #777;'>".$value['nama_barang']." Stok - ".$value['stok']."</a></li>";
			// echo "<li><a href='".base_url("admin/data_master/barang/data_barang/barang/ubah/".$value['id_barang'])."' style='color: #777;'>".$value['nama_barang']." Stok - ".$value['stok']."</a></li>";
		}
	}

}
?>