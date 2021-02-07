<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bon extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		// Agar login user tidak jebol
		if (!$this->session->userdata('user')) {
			echo "<script>alert('Anda harus login terlebih dahulu');location='".base_url("login")."'</script>";
		}

		// nge-load model
		$this->load->model('Mprofil');
		$this->load->model('Mbon');
		$this->load->model('Mproduction_order');
		$this->load->model('Mbarang');
	}

	// =================== bon ============================

	public function index()
	{
		$session = $this->session->userdata('user');
		$data['user'] = $this->Mprofil->ambil_user($session['id_user']);
		$data['bon'] = $this->Mbon->tampil_bon_validasi();

		if ($this->input->post('cari')) {
			$data['bon'] = $this->Mbon->cari_bon($this->input->post());
		}

		if ($this->input->post('ttd')) 
		{
			$id_bon = $this->input->post('ttd');
			$this->Mbon->ubah_ttd_bon($id_bon);

			echo "<script>";
			echo "alert('Berhasil memberi tanda terima');";
			echo "location='".base_url("user/bon/bon")."';";
			echo "</script>";
		}

		$this->load->view('user/header',$data);	
		$this->load->view('user/navbar',$data);
		$this->load->view('user/bon/tampil',$data);
		$this->load->view('user/footer');	
	}

	function tambah() 
	{
		$session = $this->session->userdata('user');
		$data['user'] = $this->Mprofil->ambil_user($session['id_user']);
		$data['po'] = $this->Mproduction_order->tampil_po();
		$data['kode_otomatis'] = $this->Mbon->kode_otomatis();

		if ($this->input->post('id_po')) 
		{
			$id_po = $this->input->post('id_po');
		}
		else
		{
			$id_po = "";
		}

		$data['ambil_po'] = $this->Mproduction_order->ambil_po($id_po);

		$data['ambil_bon'] = $this->Mproduction_order->ambil_bon($id_po);

		$data['barang'] = $this->Mproduction_order->tampil_barang($id_po);

		if ($this->input->post('nama_barang')) 
		{
			$id_barang = $this->input->post('nama_barang');
			$data['notif'] = $this->Mproduction_order->notif_po($id_po);
		}
		else
		{
			$id_barang = "";
			$data['notif'] = array();
		}

		$data['ambil'] = $this->Mproduction_order->ambil_barang($id_barang);

		if ($this->input->post('tambah')) 
		{
			$input = $this->input->post();

			$inputan['no_bon'] = $input['no_bon'];
			$inputan['id_po'] = $input['id_po'];
			$inputan['tgl_dibuat'] = $input['tgl_dibuat'];

			$_SESSION['bon'] = $inputan;

			$inputan['nama_barang'] = $input['nama_barang'];
			$inputan['jenis'] = $input['jenis'];
			$inputan['sub_jenis'] = $input['sub_jenis'];
			$inputan['warna'] = $input['warna'];
			$inputan['satuan'] = $input['satuan'];
			$inputan['qty_bon'] = $input['qty_bon'];
			$inputan['remaks'] = $input['remaks'];
			$inputan['nama_po'] = $input['nama_po'];

			// Kondisi jika ada session barang dan variabel inputan dengan pos nama barang
			if(isset($_SESSION['barang'][$inputan['nama_barang']]))
			{
				// menyimpan beberapa data input dan menambahkannya ke variabel inputan
				$inputan['qty_bon'] = $_SESSION['barang'][$inputan['nama_barang']]['qty_bon'] + $input['qty_bon'];
				$_SESSION['barang'][$inputan['nama_barang']] = $inputan;
			}
			else
			{
				$_SESSION['barang'][$inputan['nama_barang']] = $inputan;
			}			

			redirect('user/bon/bon/tambah','refresh');

		}

		if (isset($data['ambil'])) 
		{
			$data['ambil'] = $this->Mproduction_order->ambil_barang($id_barang);
			$data['notif'] = $this->Mproduction_order->notif_po($id_barang);
		}
		else
		{
			$data['notif'] = array('kalkulasi_bon'=>array(),'reject'=>array());	
		}

		// Data dari session barang akan ditampung di variabel tbl_bon
		$data['tbl_bon'] = $this->Mbarang->tampil_barang_bon();

		if (isset($_SESSION['bon']))
		{
			$data['bon'] = $_SESSION['bon'];
			$data['ambil_po'] = $this->Mproduction_order->ambil_po($_SESSION['bon']['id_po']);
			$data['barang'] = $this->Mproduction_order->tampil_barang($_SESSION['bon']['id_po']);
		}
		else
		{
			$data['bon'] = array('no_bon'=>'','id_po'=>'','tgl_dibuat'=>'');
		}

		if ($this->input->post('delete_record')) 
		{
			unset($_SESSION['barang'], $_SESSION['bon']);
			redirect('user/bon/bon/tambah','refresh');
		}

		if ($this->input->post('simpan1'))
		{
			$input = $this->input->post();

			// Menjalankan query pada model Msurat jalan masuk di fungsi tambah sjm
			$this->Mbon->tambah_bon($_SESSION['bon'], $_SESSION['barang']);

			// selesai disimpan session akan dihapus dan kembali ke halaman tampil
			unset($_SESSION['bon'], $_SESSION['barang']);

			echo "<script>";
			echo "alert('Data berhasil disimpan');";
			echo "location='".base_url("user/bon/bon")."';";
			echo "</script>";
		}

		$this->load->view('user/header',$data);  
		$this->load->view('user/navbar',$data);
		$this->load->view('user/bon/tambah',$data);
		$this->load->view('user/footer');
	}

	function ubah($id_bon) 
	{
		$session = $this->session->userdata('user');
		$data['user'] = $this->Mprofil->ambil_user($session['id_user']);
		$data['po'] = $this->Mproduction_order->tampil_production_order();
		$data['ambil_bon'] = $this->Mbon->ambil_bon($id_bon);

		$data['ambil_kalkulasi'] = $this->Mbon->ambil_kalkulasi($id_bon);
		$data['ambil'] = $this->Mbarang->ambil_barang($id_bon);
		$data['barang'] = $this->Mbarang->tampil_barang();

		if ($this->input->post('id_po')) 
		{
			$data['id_po'] = $this->input->post('id_po');
		}
		else
		{
			$data['id_po'] = $data['ambil_bon']['id_po'];
		}

		$data['ambil_po'] = $this->Mproduction_order->ambil_po($data['id_po']);

		if ($this->input->post('simpan_temp')) 
		{
			// simpan hal 1
			$input = $this->input->post();
			$inputan['no_bon'] = $input['no_bon'];
			$inputan['id_po'] = $input['id_po'];
			$inputan['tgl_dibuat'] = $input['tgl_dibuat'];

			$_SESSION['bon'] = $inputan;
			$this->Mbon->ubah_bon($_SESSION['bon'],$id_bon);

			echo "<script>";
			echo "location='".base_url("user/bon/bon/ubah_selanjutnya/$id_bon")."';";
			echo "</script>";
		}	

		$this->load->view('user/header',$data);  
		$this->load->view('user/navbar',$data);
		$this->load->view('user/bon/ubah',$data);
		$this->load->view('user/footer');	
	}

	function radio()
	{
		$id_kalkulasi_bon = $this->input->post('id_kalkulasi_bon');
		$data = $this->Mbon->detail_kalkulasi($id_kalkulasi_bon);
		echo json_encode($data);
	}

	function ubah_selanjutnya($id_bon)
	{
		$session = $this->session->userdata('user');
		$data['user'] = $this->Mprofil->ambil_user($session['id_user']);
		$data['ambil_kalkulasi'] = $this->Mbon->ambil_kalkulasi($id_bon);
		$data['ambil'] = $this->Mbarang->ambil_barang($id_bon);
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

		// // data dari variabel id_barang akan disimpan di variabel ambil untuk menampilkan pada inputan
		$data['brg'] = $this->Mbarang->ambil_barang_by_nama($id_barang);

		// Kondisi untuk menngubah data dari 2 sesion yaitu sjm dan barang ke 3
		if ($this->input->post('ubah'))
		{
			$input = $this->input->post();
      		// tampung data berdasarkan name (post) ke variabel input

			$inputan['nama_barang'] = $input['nama_barang'];
			$inputan['qty_bon'] = $input['qty_bon'];
			$inputan['remaks'] = $input['remaks'];
			$id_kalkulasi_bon = $input['id_kalkulasi_bon'];

			// Menjalankan query pada model Msurat jalan masuk di fungsi tambah sjm
			$this->Mbon->ubah_kalkulasi_bon($inputan,$id_kalkulasi_bon,$id_bon);

			echo "<script>";
			echo "location='".base_url("user/bon/bon/ubah_selanjutnya/$id_bon")."';";
			echo "</script>";
		}

		if ($this->input->post('ubah1')) 
		{
			echo "<script>";
			echo "alert('Data yang diubah berhasil disimpan');";
			echo "location='".base_url("user/bon/bon")."';";
			echo "</script>";	
		}

		$this->load->view('user/header',$data);  
		$this->load->view('user/navbar',$data);
		$this->load->view('user/bon/ubah_selanjutnya',$data);
		$this->load->view('user/footer');	
	}

	function detail($id_bon) 
	{
		$session = $this->session->userdata('user');
		$data['user'] = $this->Mprofil->ambil_user($session['id_user']);
		$data['ambil_bon'] = $this->Mbon->ambil_bon($id_bon);
		$data['ambil_kalkulasi'] = $this->Mbon->ambil_kalkulasi($id_bon);

		$this->load->view('user/header',$data);
		$this->load->view('user/navbar',$data);
		$this->load->view('user/bon/detail',$data);
		$this->load->view('user/footer');
	}

	public function hapus($id_bon) 
	{
		$this->Mbon->hapus_bon($id_bon);
		echo "<script>";
		echo "alert('Data berhasil dihapus');";
		echo "location='".base_url("user/bon/bon','refresh")."';";
		echo "</script>";
	}

	// =================== bon ============================

}

?>