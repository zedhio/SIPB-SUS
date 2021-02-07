<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kartu_persediaan_barang extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('Mprofil');
		$this->load->model('Mbarang');
		$this->load->model('Mkartu_persediaan_barang');
		
		// Agar login admin tidak jebol
		if (!$this->session->userdata('admin')) {
			echo "<script>alert('Anda harus login terlebih dahulu');location='".base_url("admin/login")."'</script>";
		}
	}

	public function index()
	{
		$session = $this->session->userdata('admin');
		$data['admin'] = $this->Mprofil->ambil_admin($session['id_admin']);
		$data['kpb'] = $this->Mkartu_persediaan_barang->tampil_kpb();

		if ($this->input->post('cari')) {
			$data['kpb'] = $this->Mkartu_persediaan_barang->cari_kpb($this->input->post());
		}

		$this->load->view('admin/header',$data);	
		$this->load->view('admin/navbar',$data);
		$this->load->view('admin/kartu_persediaan_barang/tampil',$data);
		$this->load->view('admin/footer');	
	}

	// Fungsi select untuk javascript ketika pilih nama barang pada tambah maupun ubah
	function select()
	{
		$id = $this->input->post('id_barang');
		$data = $this->Mbarang->ambil_barang_by_nama($id);
		echo json_encode($data);
	}

	function tambah()
	{
		$session = $this->session->userdata('admin');
		$data['admin'] = $this->Mprofil->ambil_admin($session['id_admin']);
		$data['barang'] = $this->Mbarang->tampil_barang();
		$data['kode_otomatis'] = $this->Mkartu_persediaan_barang->kode_otomatis();

		// Kondisi ketika select nama barang dipilih akan menampilkan input jenis, subjenis dan satuan
		if ($this->input->post('id_barang')) 
		{
			$id_barang = $this->input->post('id_barang');
		}
		else
		{
			$id_barang = "";
		}

		$data['ambil'] = $this->Mbarang->ambil_barang($id_barang);
		// Kondisi ketika select id barang dipilih akan menampilkan input jenis, subjenis dan satuan

		if ($this->input->post('simpan')) 
		{
			// simpan hal 1
			$input = $this->input->post();
			$inputan['no_kpb'] = $input['no_kpb'];
			$inputan['id_barang'] = $input['id_barang'];
			$inputan['ukuran'] = $input['ukuran'];
			$kpb1 = $inputan;

			$inputan1['tgl_masuk'] = $input['tgl_masuk'];
			$inputan1['keterangan'] = $input['keterangan'];
			$inputan1['saldo'] = $input['saldo'];
			$kpb2 = $inputan1;

			$this->Mkartu_persediaan_barang->tambah_kpb($kpb1, $kpb2);
			echo "<script>";
			echo "alert('Data berhasil disimpan');";
			echo "location='".base_url("admin/kartu_persediaan_barang/kartu_persediaan_barang")."';";
			echo "</script>";
		}

		$this->load->view('admin/header',$data);	
		$this->load->view('admin/navbar',$data);
		$this->load->view('admin/kartu_persediaan_barang/tambah',$data);
		$this->load->view('admin/footer');	
	}

	function ubah($id_kpb)
	{
		$session = $this->session->userdata('admin');
		$data['admin'] = $this->Mprofil->ambil_admin($session['id_admin']);
		$data['ambil_bukti_kpb'] = $this->Mkartu_persediaan_barang->ambil_bukti_kpb($id_kpb);
		// $data['ambil_kalkulasi'] = $this->Mkartu_persediaan_barang->ambil_kalkulasi_kpb($id_kpb);

		if ($this->input->post('edit1'))
		{
			$input = $this->input->post();
      		// tampung data berdasarkan name (post) ke variabel input

			$inputan['tgl_masuk'] = $input['tgl_masuk'];
			$inputan['keterangan'] = $input['keterangan'];
			$inputan['saldo'] = $input['saldo'];
			$id_bukti_kpb = $input['id_bukti_kpb'];

			// Menjalankan query pada model Msurat jalan masuk di fungsi tambah sjm
			$this->Mkartu_persediaan_barang->ubah_kpb($inputan,$id_bukti_kpb,$id_kpb);

			// echo "<script>";
			// echo "alert('Data berhasil diubah');";
			// echo "location='".base_url("admin/kartu_persediaan_barang/kartu_persediaan_barang/ubah_selanjutnya/$id_kpb")."';";
			// echo "</script>";
		}

		if ($this->input->post('edit'))
		{
			echo "<script>";
			echo "alert('Data berhasil diubah');";
			echo "location='".base_url("admin/kartu_persediaan_barang/kartu_persediaan_barang")."';";
			echo "</script>";
		}

		$this->load->view('admin/header',$data);	
		$this->load->view('admin/navbar',$data);
		$this->load->view('admin/kartu_persediaan_barang/edit',$data);
		$this->load->view('admin/footer');	
	}

	function radio()
	{
		$id_bukti_kpb = $this->input->post('id_bukti_kpb');
		$data = $this->Mkartu_persediaan_barang->ubah_kpb_radio($id_bukti_kpb);
		echo json_encode($data);
	}

	function detail($id_kpb)
	{
		$session = $this->session->userdata('admin');
		$data['admin'] = $this->Mprofil->ambil_admin($session['id_admin']);
		$data['ambil_kpb'] = $this->Mkartu_persediaan_barang->ambil_kpb($id_kpb);
		$data['ambil_bukti_kpb'] = $this->Mkartu_persediaan_barang->ambil_bukti_kpb($id_kpb);

		$data['bulan']="";
		$data['tahun']="";

		if ($this->input->post('cari')) {
			$data['ambil_bukti_kpb'] = $this->Mkartu_persediaan_barang->cari_rekap_kpb($this->input->post(), $id_kpb);
			$data['bulan']=$this->input->post('bulan');
			$data['tahun']=$this->input->post('tahun');
		}

		$this->load->view('admin/header',$data);	
		$this->load->view('admin/navbar',$data);
		$this->load->view('admin/kartu_persediaan_barang/detail',$data);
		$this->load->view('admin/footer');	
	}

	public function hapus($id_kpb) 
	{
		$this->Mkartu_persediaan_barang->hapus_kpb($id_kpb);
		echo "<script>";
		echo "alert('Data berhasil dihapus');";
		echo "location='".base_url("admin/kartu_persediaan_barang/kartu_persediaan_barang','refresh")."';";
		echo "</script>";
	}

}

?>