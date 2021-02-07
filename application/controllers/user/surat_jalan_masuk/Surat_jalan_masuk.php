<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat_jalan_masuk extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		// Agar login user tidak jebol
		if (!$this->session->userdata('user')) {
			echo "<script>alert('Anda harus login terlebih dahulu');location='".base_url("login")."'</script>";
		}

		// Untuk load model yang dibutuhkan
		$this->load->model('Mprofil');
		$this->load->model('Msurat_jalan_masuk');
		$this->load->model('Msupplier');
		$this->load->model('Mbarang');
	}

	public function index()
	{
		$session = $this->session->userdata('user');
		$data['user'] = $this->Mprofil->ambil_user($session['id_user']);
		$data['sjm'] = $this->Msurat_jalan_masuk->tampil_sjm();

		// Kondisi jika klik tombol cari pada tampil data surat jalan masuk
		if ($this->input->post('cari')) {
			$data['sjm'] = $this->Msurat_jalan_masuk->cari_sjm($this->input->post());
		} 

		// Kondisi jika klik tombol tanda terima pada tampil data surat jalan masuk
		if ($this->input->post('ttd')) {
			$this->Msurat_jalan_masuk->ubah_ttd($this->input->post('ttd'));

			echo "<script>";
			echo "alert('Berhasil memberi tanda terima');";
			echo "location='".base_url("user/surat_jalan_masuk/surat_jalan_masuk")."';";
			echo "</script>";
		}
		
		$this->load->view('user/header',$data);	
		$this->load->view('user/navbar',$data);
		$this->load->view('user/surat_jalan_masuk/tampil',$data);
		$this->load->view('user/footer');	
	}

	// Fungsi select untuk javascript ketika pilih nama barang pada tambah maupun ubah
	function select()
	{
		$id = $this->input->post('nama_barang');
		$data = $this->Mbarang->ambil_barang_by_nama($id);
		echo json_encode($data);
	}

	// fungsi tambah
	function tambah() 
	{
		$session = $this->session->userdata('user');
		$data['user'] = $this->Mprofil->ambil_user($session['id_user']);
		$data['supplier'] = $this->Msupplier->tampil_supplier();
		$data['kode_otomatis'] = $this->Msurat_jalan_masuk->kode_otomatis();
		$data['satuan'] = $this->Mbarang->tampil_satuan();
		$data['barang'] = $this->Mbarang->tampil_barang();

		// Kondisi ketika select nama barang dipilih akan menampilkan input jenis, subjenis dan satuan
		if ($this->input->post('nama_barang')) 
		{
			$id_barang = $this->input->post('nama_barang');
		}
		else
		{
			$id_barang = "";
		}

		$data['ambil'] = $this->Mbarang->ambil_barang_by_nama($id_barang);
		// Kondisi ketika select nama barang dipilih akan menampilkan input jenis, subjenis dan satuan

		// Kondisi jika klik tombol tambah untuk menyimpan data surat jalan masuk
		if ($this->input->post('tambah')) 
		{
			$input = $this->input->post();
      		// tampung data berdasrakan name (post) ke variabel input

			// (input = semua data) (inputan = data per input)

			$inputan1['no_sjm'] = $input['no_sjm'];
			$inputan1['no_kendaraan'] = $input['no_kendaraan'];
			$inputan1['tgl_masuk'] = $input['tgl_masuk'];
			$inputan1['id_supplier'] = $input['id_supplier'];
			$inputan1['keterangan'] = $input['keterangan'];

			$_SESSION['surat_jalan_masuk'] = $inputan1;

			$inputan['nama_barang'] = $input['nama_barang'];
			$inputan['jenis'] = $input['jenis'];
			$inputan['sub_jenis'] = $input['sub_jenis'];
			$inputan['warna'] = $input['warna'];
			$inputan['qty_sjm'] = $input['qty_sjm'];
			$inputan['satuan'] = $input['satuan'];
			$inputan['ukuran'] = $input['ukuran'];

			// Kondisi jika ada session barang dan variabel inputan dengan pos nama barang
			if(isset($_SESSION['barang'][$inputan['nama_barang']]))
			{
			// 	// menyimpan beberapa data input dan menambahkannya ke variabel inputan
				$inputan['qty_sjm'] = $_SESSION['barang'][$inputan['nama_barang']]['qty_sjm'] + $input['qty_sjm'];
				$_SESSION['barang'][$inputan['nama_barang']] = $inputan;
			}
			else
			{
				$_SESSION['barang'][$inputan['nama_barang']] = $inputan;
			}			

			redirect('user/surat_jalan_masuk/surat_jalan_masuk/tambah','refresh');

		}

		if (isset($_SESSION['barang'])) 
		{
			$data['tbl_sjm'] = $_SESSION['barang'];
		}
		else
		{
			$data['tbl_sjm'] = array();		
		}

		// Data dari session barang akan ditampung di variabel tbl_sjm

		if (isset($_SESSION['surat_jalan_masuk']))
		{
			$data['sjm'] = $_SESSION['surat_jalan_masuk'];	
		}
		else
		{
			$data['sjm'] = array('no_sjm'=>'','no_kendaraan'=>'','tgl_masuk'=>'','id_supplier'=>'','keterangan'=>'',);
		}


		//Kondisi jika klik tombol delete_record untuk menghapus data pada session
		if ($this->input->post('delete_record')) 
		{
			unset($_SESSION['barang'],$_SESSION['surat_jalan_masuk']);
			redirect('user/surat_jalan_masuk/surat_jalan_masuk/tambah','refresh');
		}

		// echo "<pre>";
		// print_r($_SESSION['surat_jalan_masuk']);
		// echo "</pre>";

		// Kondisi jika klik tombol simpan untuk menyimpan data dari 2 sesion yaitu sjm dan barang
		if ($this->input->post('simpan1'))
		{

			// Menjalankan query pada model Msurat jalan masuk di fungsi tambah sjm
			$this->Msurat_jalan_masuk->tambah_sjm($_SESSION['surat_jalan_masuk'], $_SESSION['barang']);

			// selesai disimpan session akan dihapus dan kembali ke halaman tampil
			unset($_SESSION['surat_jalan_masuk'], $_SESSION['barang']);

			echo "<script>";
			echo "alert('Data berhasil disimpan');";
			echo "location='".base_url("user/surat_jalan_masuk/surat_jalan_masuk")."';";
			echo "</script>";
		}

		$this->load->view('user/header',$data);  
		$this->load->view('user/navbar',$data);
		$this->load->view('user/surat_jalan_masuk/tambah',$data);
		$this->load->view('user/footer');
	}  

	// function tambah_selanjutnya() 
	// {
	// 	$session = $this->session->userdata('user');
	// 	$data['user'] = $this->Mprofil->ambil_user($session['id_user']);
	// 	$data['satuan'] = $this->Mbarang->tampil_satuan();
	// 	$data['barang'] = $this->Mbarang->tampil_barang();




	// 	$this->load->view('user/header',$data);  
	// 	$this->load->view('user/navbar',$data);
	// 	$this->load->view('user/surat_jalan_masuk/tambah_selanjutnya',$data);
	// 	$this->load->view('user/footer');	
	// }

	function ubah($id_sjm) 
	{
		$session = $this->session->userdata('user');
		$data['user'] = $this->Mprofil->ambil_user($session['id_user']);
		$data['sjm'] = $this->Msurat_jalan_masuk->ambil_sjm($id_sjm);
		$data['supplier'] = $this->Msupplier->tampil_supplier();
		$data['ambil_kalkulasi'] = $this->Msurat_jalan_masuk->ambil_kalkulasi($id_sjm);
		$data['ambil'] = $this->Mbarang->ambil_barang($id_sjm);
		$data['barang'] = $this->Mbarang->tampil_barang();

		// Kondisi ketika select nama barang dipilih akan menampilkan input jenis, subjenis dan satuan
		if ($this->input->post('nama_brg')) 
		{
			$id_barang = $this->input->post('nama_brg');
		}
		else
		{
			$id_barang = "";
		}

		// data dari variabel id_barang akan disimpan di variabel ambil untuk menampilkan pada inputan
		$data['brg'] = $this->Mbarang->ambil_barang_by_nama($id_barang);

		if ($this->input->post('ubah'))
		{
			$input = $this->input->post();
      		// tampung data berdasarkan name (post) ke variabel input

			$inputan['nama_barang'] = $input['nama_barang'];
			$inputan['qty_sjm'] = $input['qty_sjm'];
			$inputan['ukuran'] = $input['ukuran'];
			$id_kalkulasi_sjm = $input['id_kalkulasi_sjm'];

			// Menjalankan query pada model Msurat jalan masuk di fungsi tambah sjm
			$this->Msurat_jalan_masuk->ubah_kalkulasi_sjm($inputan,$id_kalkulasi_sjm,$id_sjm);

			echo "<script>";
			echo "location='".base_url("user/surat_jalan_masuk/surat_jalan_masuk/ubah/$id_sjm")."';";
			echo "</script>";
		}

		if ($this->input->post('ubah1')) 
		{
			$input = $this->input->post();
			$inputan['no_sjm'] = $input['no_sjm'];
			$inputan['no_kendaraan'] = $input['no_kendaraan'];
			$inputan['tgl_masuk'] = $input['tgl_masuk'];
			$inputan['id_supplier'] = $input['id_supplier'];
			$inputan['keterangan'] = $input['keterangan'];

			$_SESSION['sjm'] = $inputan;
			$this->Msurat_jalan_masuk->ubah_sjm($_SESSION['sjm'],$id_sjm);			

			echo "<script>";
			echo "alert('Data yang diubah berhasil disimpan');";
			echo "location='".base_url("user/surat_jalan_masuk/surat_jalan_masuk")."';";
			echo "</script>";	
		}

		// if ($this->input->post('simpan_temp')) 
		// {
		// 	// simpan hal 1
		// 	$input = $this->input->post();
		// 	$inputan['no_sjm'] = $input['no_sjm'];
		// 	$inputan['no_kendaraan'] = $input['no_kendaraan'];
		// 	$inputan['tgl_masuk'] = $input['tgl_masuk'];
		// 	$inputan['id_supplier'] = $input['id_supplier'];
		// 	$inputan['keterangan'] = $input['keterangan'];

		// 	$_SESSION['sjm'] = $inputan;
		// 	$this->Msurat_jalan_masuk->ubah_sjm($_SESSION['sjm'],$id_sjm);

		// 	echo "<script>";
		// 	echo "location='".base_url("user/surat_jalan_masuk/surat_jalan_masuk/ubah_selanjutnya/$id_sjm")."';";
		// 	echo "</script>";
		// }	

		$this->load->view('user/header',$data);  
		$this->load->view('user/navbar',$data);
		$this->load->view('user/surat_jalan_masuk/ubah',$data);
		$this->load->view('user/footer');	
	}

	// Fungsi radio button untuk memilih salah satu record dan memampilkannya pada ubah selanjutnya surat jalan masuk
	function radio()
	{
		$id_kalkulasi_sjm = $this->input->post('id_kalkulasi_sjm');
		$data = $this->Msurat_jalan_masuk->detail_kalkulasi($id_kalkulasi_sjm);
		echo json_encode($data);
	}

	function ubah_selanjutnya($id_sjm)
	{
		$session = $this->session->userdata('user');
		$data['user'] = $this->Mprofil->ambil_user($session['id_user']);
		$data['ambil_kalkulasi'] = $this->Msurat_jalan_masuk->ambil_kalkulasi($id_sjm);
		$data['ambil'] = $this->Mbarang->ambil_barang($id_sjm);
		$data['barang'] = $this->Mbarang->tampil_barang();

		// Kondisi ketika select nama barang dipilih akan menampilkan input jenis, subjenis dan satuan
		if ($this->input->post('nama_brg')) 
		{
			$id_barang = $this->input->post('nama_brg');
		}
		else
		{
			$id_barang = "";
		}

		// data dari variabel id_barang akan disimpan di variabel ambil untuk menampilkan pada inputan
		$data['brg'] = $this->Mbarang->ambil_barang_by_nama($id_barang);

		// Kondisi untuk menngubah data dari 2 sesion yaitu sjm dan barang ke 3
		if ($this->input->post('ubah'))
		{
			$input = $this->input->post();
      		// tampung data berdasarkan name (post) ke variabel input

			$inputan['nama_barang'] = $input['nama_barang'];
			$inputan['qty_sjm'] = $input['qty_sjm'];
			$inputan['ukuran'] = $input['ukuran'];
			$id_kalkulasi_sjm = $input['id_kalkulasi_sjm'];

			// Menjalankan query pada model Msurat jalan masuk di fungsi tambah sjm
			$this->Msurat_jalan_masuk->ubah_kalkulasi_sjm($inputan,$id_kalkulasi_sjm,$id_sjm);

			echo "<script>";
			echo "location='".base_url("user/surat_jalan_masuk/surat_jalan_masuk/ubah_selanjutnya/$id_sjm")."';";
			echo "</script>";
		}

		if ($this->input->post('ubah1')) 
		{
			echo "<script>";
			echo "alert('Data yang diubah berhasil disimpan');";
			echo "location='".base_url("user/surat_jalan_masuk/surat_jalan_masuk")."';";
			echo "</script>";	
		}

		$this->load->view('user/header',$data);  
		$this->load->view('user/navbar',$data);
		$this->load->view('user/surat_jalan_masuk/ubah_selanjutnya',$data);
		$this->load->view('user/footer');	
	}

	function detail($id_sjm) 
	{
		$session = $this->session->userdata('user');
		$data['user'] = $this->Mprofil->ambil_user($session['id_user']);
		$data['ambil_sjm'] = $this->Msurat_jalan_masuk->ambil_sjm($id_sjm);
		$data['ambil_kalkulasi'] = $this->Msurat_jalan_masuk->ambil_kalkulasi($id_sjm);
		$data['ambil_total'] = $this->Msurat_jalan_masuk->ambil_total($id_sjm);
		$data['ambil'] = $this->Mbarang->ambil_barang($id_sjm);

		$this->load->view('user/header',$data);  
		$this->load->view('user/navbar',$data);
		$this->load->view('user/surat_jalan_masuk/detail',$data);
		$this->load->view('user/footer');
	}

	// fungsi hapus
	public function hapus($id_sjm) 
	{
		$this->Msurat_jalan_masuk->hapus_sjm($id_sjm);
		echo "<script>";
		echo "alert('Data berhasil dihapus');";
		echo "location='".base_url("user/surat_jalan_masuk/surat_jalan_masuk','refresh")."';";
		echo "</script>";
	}

}

?>