<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemeriksaan_barang extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('Mprofil');
		$this->load->model('Mpemeriksaan_barang');
		$this->load->model('Mlaporan');
		$this->load->model('Msurat_jalan_keluar');
		
		// Agar login admin tidak jebol
		if (!$this->session->userdata('admin')) {
			echo "<script>alert('Anda harus login terlebih dahulu');location='".base_url("admin/login")."'</script>";
		}
	}

	public function index()
	{
		$session = $this->session->userdata('admin');
		$data['admin'] = $this->Mprofil->ambil_admin($session['id_admin']);
		$data['periksa'] = $this->Mpemeriksaan_barang->tampil_periksa_barang();
		$data['kode_otomatis'] = $this->Msurat_jalan_keluar->kode_otomatis();

		if ($this->input->post('cari')) {
			$data['periksa'] = $this->Mpemeriksaan_barang->cari_pemeriksaan($this->input->post());
		}

		if ($this->input->post('save')) {

			$input = $this->input->post();
      		// tampung nilai variabel input post ke variabel inputan 
			$inputan['id_pemeriksaan_barang'] = $input['id_pemeriksaan_barang'];
			$inputan['no_sjk'] = $input['no_sjk'];
			$inputan['tgl_dibuat'] = $input['tgl_dibuat'];

			$this->Msurat_jalan_keluar->tambah_sjk($inputan);
			$this->Msurat_jalan_keluar->ambil_qc_lpb_sjm($inputan);

			echo "<script>";
			echo "alert('Surat Jalan Keluar berhasil dibuat');";
			echo "location='".base_url("admin/pemeriksaan_barang/pemeriksaan_barang")."';";
			echo "</script>";

		}

		if ($this->input->post('ttd')) 
		{
			$id_pemeriksaan = $this->input->post('ttd');
			$this->Mpemeriksaan_barang->ubah_ttd_pemeriksaan($id_pemeriksaan);

			echo "<script>";
			echo "alert('Berhasil memberi tanda terima');";
			echo "location='".base_url("admin/pemeriksaan_barang/pemeriksaan_barang")."';";
			echo "</script>";
		}

		$this->load->view('admin/header',$data);	
		$this->load->view('admin/navbar',$data);
		$this->load->view('admin/pemeriksaan_barang/tampil',$data);
		$this->load->view('admin/footer');	
	}

	function select()
	{
		$id = $this->input->post('id_lpb');
		$data = $this->Mpemeriksaan_barang->ambil_lpb($id);
		echo json_encode($data);
	}

	function tambah()
	{
		$session = $this->session->userdata('admin');
		$data['admin'] = $this->Mprofil->ambil_admin($session['id_admin']);
		$data['kode_otomatis'] = $this->Mpemeriksaan_barang->kode_otomatis();
		$data['lpb'] = $this->Mpemeriksaan_barang->tampil_lpb();
		
		if ($this->input->post('id_lpb'))
		{
			$data['id_lpb'] = $this->input->post('id_lpb');
		}
		else
		{
			$data['id_lpb'] = "";
		}

		// data dari variabel id_barang akan disimpan di variabel ambil untuk menampilkan pada inputan
		$data['ambil'] = $this->Mpemeriksaan_barang->ambil_lpb($data['id_lpb']);

		$data['ambil_sjm'] = $this->Mpemeriksaan_barang->ambil_sjm($data['ambil']['id_sjm']);	

		$data['sjm'] = $this->Mpemeriksaan_barang->tampil_kalkulasi_sjm($data['ambil_sjm']['id_sjm']);		

		if ($this->input->post('nama_barang'))
		{
			$data['nama_barang'] = $this->input->post('nama_barang');
		}
		else
		{
			$data['nama_barang'] = "";
		}

		$data['ambil1'] = $this->Mpemeriksaan_barang->ambil_lpb1($data['nama_barang']);
		$data['ambil2'] = $this->Mpemeriksaan_barang->ambil_lpb2($data['id_lpb']);
		$data['ambil3'] = $this->Mpemeriksaan_barang->ambil_lpb3($data['nama_barang']);

		if ($this->input->post('tambah'))
		{
			$input = $this->input->post();

			$hitung = count($data['sjm']);

			if ($hitung>1) {
				$inputan['no_pemeriksaan_barang'] = $input['no_periksa'];
				$inputan['id_lpb'] = $input['id_lpb'];
				$inputan['tgl_periksa'] = $input['tgl_periksa'];
				$inputan['nama_barang'] = $input['nama_barang'];
				$inputan['qty_reject'] = $input['qty_reject'];
				$inputan['tindakan'] = $input['tindakan'];
				$inputan['hasil_periksa'] = $input['hasil_periksa'];

				$this->Mpemeriksaan_barang->tambah_periksa($inputan);
				$this->Mpemeriksaan_barang->minus_stok($inputan);
				$this->Mpemeriksaan_barang->ambil_sjm_lpb1($inputan);

				echo "<script>";
				echo "alert('Data yang ditambah berhasil disimpan');";
				echo "location='".base_url("admin/pemeriksaan_barang/pemeriksaan_barang")."';";
				echo "</script>";				
			}
			else {
				$inputan['no_pemeriksaan_barang'] = $input['no_periksa'];
				$inputan['id_lpb'] = $input['id_lpb'];
				$inputan['tgl_periksa'] = $input['tgl_periksa'];
				$inputan['nama_barang'] = "-";
				$inputan['qty_reject'] = $input['qty_reject'];
				$inputan['tindakan'] = $input['tindakan'];
				$inputan['hasil_periksa'] = $input['hasil_periksa'];

				$this->Mpemeriksaan_barang->tambah_periksa($inputan);
				$this->Mpemeriksaan_barang->minus_stok($inputan);
				$this->Mpemeriksaan_barang->ambil_sjm_lpb($inputan);	

				echo "<script>";
				echo "alert('Data yang ditambah berhasil disimpan');";
				echo "location='".base_url("admin/pemeriksaan_barang/pemeriksaan_barang")."';";
				echo "</script>";
			}

		}

		$this->load->view('admin/header',$data);	
		$this->load->view('admin/navbar',$data);
		$this->load->view('admin/pemeriksaan_barang/tambah',$data);
		$this->load->view('admin/footer');	
	}

	function detail($id_qc)
	{
		$session = $this->session->userdata('admin');
		$data['admin'] = $this->Mprofil->ambil_admin($session['id_admin']);
		$data['ambil_pemeriksaan'] = $this->Mpemeriksaan_barang->ambil_qc($id_qc);
		$data['ambil_periksa'] = $this->Mpemeriksaan_barang->ambil_qc1($id_qc);

		$this->load->view('admin/header',$data);	
		$this->load->view('admin/navbar',$data);
		$this->load->view('admin/pemeriksaan_barang/detail',$data);
		$this->load->view('admin/footer');	
	}

	function stiker($id_qc)
	{
		$session = $this->session->userdata('admin');
		$data['admin'] = $this->Mprofil->ambil_admin($session['id_admin']);
		$data['ambil_pemeriksaan'] = $this->Mpemeriksaan_barang->ambil_qc($id_qc);
		$data['ambil_periksa'] = $this->Mpemeriksaan_barang->ambil_qc1($id_qc);

		$this->load->view('admin/header',$data);	
		$this->load->view('admin/navbar',$data);
		$this->load->view('admin/pemeriksaan_barang/stiker',$data);
		$this->load->view('admin/footer');	
	}

	public function hapus($id_qc) 
	{
		$this->Mpemeriksaan_barang->hapus_qc($id_qc);
		echo "<script>";
		echo "alert('Data berhasil dihapus');";
		echo "location='".base_url("admin/pemeriksaan_barang/pemeriksaan_barang','refresh")."';";
		echo "</script>";
	}

	function cetak_stiker($id_qc)
	{
		$session = $this->session->userdata('admin');
		$data['admin'] = $this->Mprofil->ambil_admin($session['id_admin']);
		$data['ambil_pemeriksaan'] = $this->Mpemeriksaan_barang->ambil_qc($id_qc);
		$data['ambil_periksa'] = $this->Mpemeriksaan_barang->ambil_qc1($id_qc);

		$title = base_url('assets/images/logo/kop_pt_sus.jpg');

		$this->load->library('dompdf_gen');
		
		$ttd_okta = base_url("assets/images/ttd/ttd_okta.jpg");
		$ttd_rolisa = base_url("assets/images/ttd/ttd_rolisa.jpg");

		if (!empty($data['ambil_pemeriksaan']['nama_barang']=="-"))
		{
            $nama_barang = $data['ambil_periksa']['nama_barang'];
		}
        elseif (!empty($data['ambil_pemeriksaan']['nama_barang']!=="-"))
        {
            $nama_barang = $data['ambil_pemeriksaan']['nama_barang'];
        }

		if (!empty($data['ambil_pemeriksaan']['inspection_acceptable']))
		{
			$cap = base_url('assets/images/ttd/ttd_okta.jpg');
		}

		if (!empty($data['ambil_pemeriksaan']['tindakan']=="Dimusnahkan" OR $data['ambil_pemeriksaan']['tindakan']=="Return Barang"))
		{
			$qty_reject = $data['ambil_pemeriksaan']['qty_reject'];
		}
		elseif (!empty($data['ambil_pemeriksaan']['tindakan']=="Kosong"))
		{
			$qty_reject = "Passed Inpection";
		}

		if (!empty($data['ambil_pemeriksaan']['tindakan']=="Kosong"))
		{
			$tindakan = "<span class='fa fa-square-o'>Dimusnahkan</span><span class='fa fa-square-o'>Return &nbsp;&nbsp;&nbsp;</span>";
		}
		elseif (!empty($data['ambil_pemeriksaan']['tindakan']=="Dimusnahkan"))
		{
			$tindakan = "<span class='fa fa-check-square-o' style='padding-left:425px;'> Dimusnahkan</span>";
		}
		elseif (!empty($data['ambil_pemeriksaan']['tindakan']=="Return Barang"))
		{
			$tindakan = "<span class='fa fa-check-square-o' style='padding-left:430px;'> Return &nbsp;&nbsp;&nbsp;</span>";
		}

		if (!empty($data['ambil_pemeriksaan']['tindakan']=="Dimusnahkan"))
		{
			$title_pdf = "Dimusnahkan";
		}
		elseif (!empty($data['ambil_pemeriksaan']['tindakan']=="Return Barang"))
		{
			$title_pdf = "Return";
		}

		$manuk = "<html><link rel='icon' href='".$title."'><link rel='stylesheet' type='text/css' href='localhost/SIPB_SUS/assets/bower_components/bootstrap/dist/css/bootstrap.min.css'><title>Pemeriksaan Barang No. ".$data['ambil_pemeriksaan']['no_pemeriksaan_barang']." - ".$tindakan."</title><style>@media print{.col-md-3{width: 30%;float: left;}.col-md-9{width: 70%;float: left;}}</style><style type='text/css'>.body-blue {border: 1px solid #3c8dbc;}</style><style type='text/css'>.body-black {border: 1px solid black;}</style>

		<body>

			<div class='box body-blue'>

				<img class='profile-user-img img-circle' style='width:150px; height: 70px; padding-top: 20px;; padding-left:15px;' src='".$title."' class='profile-user-img img-circle'>
				<h5 style='padding-top: 45px;font-size: 14px; position: absolute; padding-left: 320px;'><b>PT.SINAR UTAMA SEJAHTERA</b></h5><span class='fa fa-square-o'></span>

				<div class='box-body' style='padding-top: 25px;'>

					<div class='form-group'>
						<div class='col-md-12'>

							<div class='col-md-2' style='font-size: 12px; padding-left:25px;'>
								<b>No.Pemeriksaan</b> <span style='padding-left: 10px;'>:</span> ".$data['ambil_pemeriksaan']['no_pemeriksaan_barang']."
								<br>
								<b>No.LPB</b> <span style='padding-left: 54px;'>:</span> ".$data['ambil_periksa']['no_lpb']."
								<br>
								<b>Dari Supplier</b> <span style='padding-left: 25px;'>:</span> ".$data['ambil_periksa']['nama_supplier']."
								<br>
								<b>Tgl.Pemeriksaan</b> <span style='padding-left: 8px;'>:</span> ".$data['ambil_pemeriksaan']['tgl_periksa']."
								<br>
								<b>Nama Barang</b> <span style='padding-left: 24px;'>:</span> ".$nama_barang."
								<br>
								<b>Warna</b> <span style='padding-left: 60px;'>:</span> ".$data['ambil_periksa']['warna']."
								<br>
								<b>Qty</b> <span style='padding-left: 76px;'>:</span> ".$data['ambil_periksa']['qty_sjm']."
								<br>
								<b>Qty Reject</b> <span style='padding-left: 40px;'>:</span> ".$data['ambil_pemeriksaan']['qty_reject']." ".$tindakan."
								<br><br>
								<label>*Note :</label><label style='font-size:14px; padding-left:480px;'>Inspection Acceptable</label><ol type='1'><li>Pemeriksaan Barang harus membuat <b>Material Swatch</b> & <b>Pengecekan Kualitas</b> barang.</li><li>Perhatikan ketentuan masa berlaku untuk pelaksana <i>Return</i> tiap - tiap suplier.</li></ol>
								<br><br><br><br><br><br>
								<img style='position: absolute; padding-left:552px; padding-top:300px;' src='".$cap."' width='100'>

							</div>

						</div>
					</div>

				</div>

			</div>

		</div>


	</body></html>";

	$this->dompdf->load_html($manuk);
	$this->dompdf->set_paper("A5", "landscape");
	$this->dompdf->render();

	$this->dompdf->stream("Pemeriksaan Barang No. ".$data['ambil_pemeriksaan']['no_pemeriksaan_barang']." - ".$title_pdf." .pdf", array("Attachment"=> 1));

}

}

?>