<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat_jalan_keluar extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		// Agar login user tidak jebol
		if (!$this->session->userdata('admin')) {
			echo "<script>alert('Anda harus login terlebih dahulu');location='".base_url("admin/login")."'</script>";
		}

		// nge-load model
		$this->load->model('Mprofil');
		$this->load->model('Mlaporan');
		$this->load->model('Msurat_jalan_keluar');
	}

	// =================== lpb ============================

	public function index()
	{
		$session = $this->session->userdata('admin');
		$data['admin'] = $this->Mprofil->ambil_admin($session['id_admin']);
		$data['laporan'] = $this->Msurat_jalan_keluar->tampil_laporan_sjk();

		// echo "<pre>";
		// print_r ($data['laporan']);
		// echo "</pre>";

		//Kondisi jika klik tombol cari data lpb
		if ($this->input->post('cari')) {
			$data['laporan'] = $this->Msurat_jalan_keluar->cari_sjk($this->input->post());
		}

		if ($this->input->post('rekap_sjk')) 
		{
			redirect('admin/laporan/surat_jalan_keluar/rekapitulasi_sjk','refresh');	
		}

		$this->load->view('admin/header',$data);	
		$this->load->view('admin/navbar',$data);
		$this->load->view('admin/laporan/surat_jalan_keluar/tampil',$data);
		$this->load->view('admin/footer');	
	}

	function rekapitulasi_sjk()
	{
		$session = $this->session->userdata('admin');
		$data['admin'] = $this->Mprofil->ambil_admin($session['id_admin']);
		$data['rekap_sjk'] = $this->Msurat_jalan_keluar->tampil_rekap_sjk();
		// $data['rekap_lpb'] = array();

		$data['bulan']="";
		$data['tahun']="";

		if ($this->input->post('cari')) {
			$data['rekap_sjk'] = $this->Msurat_jalan_keluar->cari_rekap_sjk($this->input->post());
			$data['bulan']=$this->input->post('bulan');
			$data['tahun']=$this->input->post('tahun');
		}

		$this->load->view('admin/header',$data);	
		$this->load->view('admin/navbar',$data);
		$this->load->view('admin/laporan/surat_jalan_keluar/rekapitulasi_sjk',$data);
		$this->load->view('admin/footer');	
	}

	function detail($id_sjk) 
	{
		$session = $this->session->userdata('admin');
		$data['admin'] = $this->Mprofil->ambil_admin($session['id_admin']);
		$data['ambil_sjk'] = $this->Msurat_jalan_keluar->ambil_sjk($id_sjk);
		$data['detail'] = $this->Msurat_jalan_keluar->ambil1_sjk($id_sjk);
		$data['ambil_kalkulasi'] = $this->Msurat_jalan_keluar->ambil_kalkulasi($id_sjk);
		// $data['ambil_total'] = $this->Msurat_jalan_keluar->ambil_total($id_sjk);
		$data['validasi'] = $this->Msurat_jalan_keluar->ambil_validasi($id_sjk);
		

		$this->load->view('admin/header',$data);
		$this->load->view('admin/navbar',$data);
		$this->load->view('admin/laporan/surat_jalan_keluar/detail',$data);
		$this->load->view('admin/footer');
	}

	function unduh_file($id_sjk)
	{
		$session = $this->session->userdata('admin');
		$data['admin'] = $this->Mprofil->ambil_admin($session['id_admin']);
		$data['ambil_sjk'] = $this->Msurat_jalan_keluar->ambil_sjk($id_sjk);
		$data['detail'] = $this->Msurat_jalan_keluar->ambil1_sjk($id_sjk);
		$data['ambil_kalkulasi'] = $this->Msurat_jalan_keluar->ambil_kalkulasi($id_sjk);
		$data['validasi'] = $this->Msurat_jalan_keluar->ambil_validasi($id_sjk);

		$title = base_url('assets/images/logo/pt_sus.png');

		$this->load->library('dompdf_gen');

		if (!empty($ambil_sjk['no_kendaraan']))
		{
			$no_kendaraan = $ambil_sjk['no_kendaraan'];
		}
        elseif(empty($ambil_sjk['no_kendaraan']))
        {
        	$no_kendaraan = "-";
        }

		$ttd_okta = base_url("assets/images/ttd/ttd_okta.jpg");
		$ttd_rolisa = base_url("assets/images/ttd/ttd_rolisa.jpg");

		if (!empty($data['validasi']['status_pengajuan']=="Disetujui") AND !empty($data['ambil_sjk']['konfirmasi'])) {
			$okta = '<div><label style="font-size: 12px; margin-left:35px;">Diterima / Disetujui</label><label style="font-size: 12px; margin-left:300px;">Pembuat</label><div><img src='.$ttd_okta.' width="100" style="margin-left:35px;"><img src='.$ttd_rolisa.' width="100" style="margin-left:270px;"></div><u style="font-size: 12px; margin-left:30px;">Kus Supriyadinata, SE</u><u style="font-size: 12px; margin-left:250px;">Tia (Administrasi Gudang)</u></div>';
		}

		$manuk = "<html><link rel='icon' href='".$title."'><title>Surat Jalan Keluar No. ".$data['ambil_sjk']['no_sjk']." - ".$data['detail']['tindakan']." ke ".$data['detail']['nama_supplier']."</title><style>@page{size: 21cm 29.7; margin-top: 4cm; margin-bottom: 3cm; margin-left: 4cm; margin-right: 3cm;}</style><style>@media print{.col-md-3{width: 30%;float: left;}.col-md-9{width: 70%;float: left;}}</style><style type='text/css'>.body-blue {border: 1px solid #3c8dbc;}</style><style type='text/css'>.body-black {border: 1px solid black;}</style><body><section class='content'>

		<div class='row'>
			<div class='col-xs-12'>
				<div class='box body-blue'>
					<div class='box-body' style='padding-top: 25px;'>
						<div class='form-group'>
							<div class='col-md-12'>
								<div>
									<h3 style='padding-left: 30px;'><i><b>PT. SINAR UTAMA SEJAHTERA</b></i></h3>
									<h3 align='center'><u><b>LAPORAN SURAT JALAN KELUAR</b></u></h3>
								</div>
								<br><br>
								<div style='position:absolute; margin-left:97px;'>
									<table align='justify' style='margin-top:155px;'>
										<tr style='font-size: 12px;'>
											<td><img style='width:170px; height: 130px;' src='".$title."'></td>
										</tr>
									</table>
								</div>
								<div style='padding-left: 70px;'>
									
									<table align='justify' style='margin-left: 180px;'>
										<tr style='font-size: 12px;'>
											<td width='125'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b></b></td>
											<td></td>
											<td width='50'></td>

											<td width='85'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b></b></td>
											<td></td>
											<td></td>

										</tr>
									</table>

									<table align='justify' style='margin-left: 180px;'>
										<tr style='font-size: 12px;'>
											<td width='125'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>No.Surat Jalan Keluar</b></td>
											<td>:</td>
											<td width='50'>&nbsp;".$data['ambil_sjk']['no_sjk']."</td>

											<td width='85'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Ditujukan</b></td>
											<td>:</td>
											<td>&nbsp;".$data['detail']['nama_supplier']."</td>

										</tr>
									</table>
									
									<table align='justify' style='margin-left: 180px;'>
										<tr style='font-size: 12px;'>
											<td width='125'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>No.Pemeriksaan Barang</b></td>
											<td>:</td>
											<td width='75'>&nbsp;".$data['ambil_sjk']['no_pemeriksaan_barang']."</td>

											<td width='85'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>No.Kendaraan</b></td>
											<td>:</td>
											<td>&nbsp;".$no_kendaraan."</td>

										</tr>
									</table>

									<table align='justify' style='margin-left: 180px;'>
										<tr style='font-size: 12px;'>
											<td width='125'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Tgl.Dibuat Surat</b></td>
											<td>:</td>
											<td width='75'>&nbsp;".$data['ambil_sjk']['tgl_dibuat']."</td>

											<td width='85'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Keterangan</b></td>
											<td>:</td>
											<td>&nbsp;".$data['detail']['tindakan']."</td>

										</tr>
									</table>

								</div>

								<div class='col-xs-12' style='padding-left: 110px; padding-top:40px;'><br>
									<table>

										<tr align='center'>
											<th class='body-black' rowspan='2' width='150' style='padding-top: 10px; font-size:12px;'><b>Nama Barang</b></th>
											<th class='body-black' rowspan='2' width='115' style='padding-top: 10px; font-size:12px;'><b>Jenis</b></th>
											<th class='body-black' rowspan='2' width='115' style='padding-top: 10px; font-size:12px;'><b>Sub Jenis</b></th>
											<th class='body-black' colspan='3' width='190' style='font-size: 12px;'><b>Jumlah</b></th>
										</tr>

										<tr>
											<td class='body-black' align='center' style='font-size: 12px;'><b>Qty Barang</b></td>
											<td class='body-black' align='center' style='font-size: 12px;'><b>Satuan</b></td>
											<td class='body-black' align='center' style='font-size: 12px;'><b>Ukuran</b></td>
										</tr>";

										foreach ($data['ambil_kalkulasi'] as $key => $value) {
											$nama_barang = $value['nama_barang'];
											$jenis = $value['jenis'];
											$sub_jenis = $value['sub_jenis'];
											$qty_sjk = $value['qty_sjk'];
											$satuan = $value['satuan'];

											if (!empty($value['ukuran'])) {
												$ukuran = $value['ukuran'];
											}
											elseif (empty($value['ukuran']))
											{
												$ukuran = "-";
											}

											$manuk .= "<tr>
											<td class='body-black' align='center' style='font-size: 12px;'>".$nama_barang."</td>
											<td class='body-black' align='center' style='font-size: 12px;'>".$jenis."</td>
											<td class='body-black' align='center' style='font-size: 12px;'>".$sub_jenis."</td>
											<td class='body-black' align='center' style='font-size: 12px;'>".$qty_sjk."</td>
											<td class='body-black' align='center' style='font-size: 12px;'>".$satuan."</td>
											<td class='body-black' align='center' style='font-size: 12px;'>".$ukuran."</td>
										</tr>";

									}

								$manuk .= "</table>

								<div  style='padding-top: 20px; padding-left:110px; padding-bottom:30px'>
									".$okta."
								</div>


						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

		</section></body></html>";
		$this->dompdf->load_html($manuk);
		$this->dompdf->set_paper("A4", "landscape");
		$this->dompdf->render();

		$this->dompdf->stream("Surat Jalan Keluar No. ".$data['ambil_sjk']['no_sjk']." - ".$data['detail']['tindakan']." ke ".$data['detail']['nama_supplier'].".pdf", array("Attachment"=> 1));
	}

	// =================== lpb ============================

}

?>