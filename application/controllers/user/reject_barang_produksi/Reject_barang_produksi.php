<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reject_barang_produksi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('Mprofil');
		$this->load->model('Mbon');
		$this->load->model('Mreject_barang_produksi');
		
		// Agar login admin tidak jebol
		if (!$this->session->userdata('user')) {
			echo "<script>alert('Anda harus login terlebih dahulu');location='".base_url("user/login")."'</script>";
		}
	}

	public function index()
	{
		$session = $this->session->userdata('user');
		$data['user'] = $this->Mprofil->ambil_user($session['id_user']);
		$data['reject'] = $this->Mreject_barang_produksi->tampil_reject();

		if ($this->input->post('cari')) {
			$data['reject'] = $this->Mreject_barang_produksi->cari_reject($this->input->post());
		}

		$this->load->view('user/header',$data);	
		$this->load->view('user/navbar',$data);
		$this->load->view('user/reject_barang_produksi/tampil',$data);
		$this->load->view('user/footer');	
	}

	function tambah()
	{
		$session = $this->session->userdata('user');
		$data['user'] = $this->Mprofil->ambil_user($session['id_user']);
		$data['kode_otomatis'] = $this->Mreject_barang_produksi->kode_otomatis();
		$data['po'] = $this->Mreject_barang_produksi->tampil_po();

		if ($this->input->post('id_po'))
		{
			$data['id_po'] = $this->input->post('id_po');
		}
		else
		{
			$data['id_po'] = "";
		}

		$data['barang'] = $this->Mreject_barang_produksi->tampil_barang($data['id_po']);

		if (!empty($data['id_po']))
		{
			$data['ambil_po'] = $this->Mreject_barang_produksi->ambil_po($data['id_po']);
		}
		else 
		{
			$data['ambil_po'][0]=array('nama_buyer'=>'','nama_style'=>'','qty'=>'','bon'=>array());
		}

		if ($this->input->post('tambah'))
		{
			$input = $this->input->post();
			$inputan['no_reject_barang_produksi'] = $input['no_reject'];
			$inputan['tgl_reject'] = $input['tgl_reject'];
			$inputan['id_po'] = $input['id_po'];
			$inputan['nama_barang'] = $input['nama_barang'];
			$inputan['qty_reject'] = $input['qty_reject'];
			$inputan['alasan_reject'] = $input['alasan_reject'];

			$this->Mreject_barang_produksi->tambah_reject($inputan);

			echo "<script>";
			echo "alert('Data yang diubah berhasil disimpan');";
			echo "location='".base_url("user/reject_barang_produksi/reject_barang_produksi")."';";
			echo "</script>";
		}

		$this->load->view('user/header',$data);	
		$this->load->view('user/navbar',$data);
		$this->load->view('user/reject_barang_produksi/tambah',$data);
		$this->load->view('user/footer');	
	}

	public function hapus($id_reject) 
	{
		$this->Mreject_barang_produksi->hapus_reject($id_reject);
		echo "<script>";
		echo "alert('Data berhasil dihapus');";
		echo "location='".base_url("user/reject_barang_produksi/reject_barang_produksi','refresh")."';";
		echo "</script>";
	}

	function ubah($id_reject)
	{
		$session = $this->session->userdata('user');
		$data['user'] = $this->Mprofil->ambil_user($session['id_user']);
		$data['ambil_reject'] = $this->Mreject_barang_produksi->ambil_reject($id_reject);
		$data['po'] = $this->Mreject_barang_produksi->tampil_po();

		if ($this->input->post('id_po'))
		{
			$data['id_po'] = $this->input->post('id_po');
		}
		else
		{
			$data['id_po'] = $data['ambil_reject']['id_po'];
		}

		$data['barang'] = $this->Mreject_barang_produksi->tampil_barang($data['id_po']);

		if (!empty($data['id_po']))
		{
			$data['ambil_po'] = $this->Mreject_barang_produksi->ambil_po($data['id_po']);
		}
		else 
		{
			$data['ambil_po']=array('nama_buyer'=>'','nama_style'=>'','qty'=>'','bon'=>array());
		}

		if ($this->input->post('ubah'))
		{
			$input = $this->input->post();
			$inputan['no_reject_barang_produksi'] = $input['no_reject'];
			$inputan['tgl_reject'] = $input['tgl_reject'];
			$inputan['id_po'] = $input['id_po'];
			$inputan['nama_barang'] = $input['nama_barang'];
			$inputan['qty_reject'] = $input['qty_reject'];
			$inputan['alasan_reject'] = $input['alasan_reject'];

			$this->Mreject_barang_produksi->ubah_reject($inputan, $id_reject);

			echo "<script>";
			echo "alert('Data yang diubah berhasil diubah');";
			echo "location='".base_url("user/reject_barang_produksi/reject_barang_produksi")."';";
			echo "</script>";
		}

		$this->load->view('user/header',$data);	
		$this->load->view('user/navbar',$data);
		$this->load->view('user/reject_barang_produksi/ubah',$data);
		$this->load->view('user/footer');	
	}

	function detail($id_reject)
	{
		$session = $this->session->userdata('user');
		$data['user'] = $this->Mprofil->ambil_user($session['id_user']);
		$data['ambil_reject'] = $this->Mreject_barang_produksi->ambil_reject($id_reject);

		$this->load->view('user/header',$data);	
		$this->load->view('user/navbar',$data);
		$this->load->view('user/reject_barang_produksi/detail',$data);
		$this->load->view('user/footer');	
	}

}

?>