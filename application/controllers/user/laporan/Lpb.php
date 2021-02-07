<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lpb extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		// Agar login user tidak jebol
		if (!$this->session->userdata('user')) {
			echo "<script>alert('Anda harus login terlebih dahulu');location='".base_url("login")."'</script>";
		}

		// nge-load model
		$this->load->model('Mprofil');
		$this->load->model('Mlaporan');
		$this->load->model('Msurat_jalan_masuk');
	}

	// =================== lpb ============================

	public function index()
	{
		$session = $this->session->userdata('user');
		$data['user'] = $this->Mprofil->ambil_user($session['id_user']);
		$data['laporan'] = $this->Mlaporan->tampil_laporan();

		if ($this->input->post('cari10')) {
			$data['laporan'] = $this->Mlaporan->cari_lpb_user($this->input->post());
		}

		if ($this->input->post('rekap')) 
		{
			redirect('user/laporan/lpb/rekapitulasi_lpb','refresh');	
		}

		$this->load->view('user/header',$data);	
		$this->load->view('user/navbar',$data);
		$this->load->view('user/laporan/lpb/tampil',$data);
		$this->load->view('user/footer');	
	}

	function rekapitulasi_lpb()
	{
		$session = $this->session->userdata('user');
		$data['user'] = $this->Mprofil->ambil_user($session['id_user']);
		$data['rekap_lpb'] = $this->Mlaporan->tampil_rekap_lpb();

		$data['bulan']="";
		$data['tahun']="";

		if ($this->input->post('cari')) {
			$data['rekap_lpb'] = $this->Mlaporan->cari_rekap_lpb($this->input->post());
			$data['bulan']=$this->input->post('bulan');
			$data['tahun']=$this->input->post('tahun');
		}

		$this->load->view('user/header',$data);	
		$this->load->view('user/navbar',$data);
		$this->load->view('user/laporan/lpb/rekapitulasi_lpb',$data);
		$this->load->view('user/footer');	
	}

	function detail($id_lpb) 
	{
		$session = $this->session->userdata('user');
		$data['user'] = $this->Mprofil->ambil_user($session['id_user']);
		$data['ambil_lpb'] = $this->Mlaporan->ambil_lpb($id_lpb);
		$data['ambil_kalkulasi'] = $this->Mlaporan->ambil_kalkulasi($data['ambil_lpb']['id_sjm']);
		$data['detail'] = $this->Mlaporan->validasi_lpb($id_lpb);
		

		$this->load->view('user/header',$data);
		$this->load->view('user/navbar',$data);
		$this->load->view('user/laporan/lpb/detail',$data);
		$this->load->view('user/footer');
	}

	// ---------------------------- Notif Distribusi LPB Kepala Divisi Purchase Order ----------------------------
	function hitung_dis_lpb_kdpo()
	{
		$data['validasi'] = $this->Mlaporan->hitung_dis_lpb_kdpo();
		if(count($data['validasi'])<=0)
		{
			echo "";
		}
		else
		{
			echo count($data['validasi']);
		}
	}

	function notif_data_dis_lpb_kdpo()
	{
		$data['validasi2'] = $this->Mlaporan->data_dis_lpb_kdpo();
		echo json_encode($data['validasi2']);
	}

	function pesan_data_dis_lpb_kdpo()
	{
		$this->Mlaporan->ubah_status_dis_lpb_kdpo($this->input->post('id_distribusi_lpb'));
	}
	// ---------------------------- Notif Distribusi LPB Kepala Divisi Purchase Order ----------------------------


	// ---------------------------- Notif Distribusi LPB Kepala Divisi Hutang Dagang ----------------------------
	function hitung_dis_lpb_kdhd()
	{
		$data['validasi'] = $this->Mlaporan->hitung_dis_lpb_kdhd();
		if(count($data['validasi'])<=0)
		{
			echo "";
		}
		else
		{
			echo count($data['validasi']);
		}
	}

	function notif_data_dis_lpb_kdhd()
	{
		$data['validasi2'] = $this->Mlaporan->data_dis_lpb_kdhd();
		echo json_encode($data['validasi2']);
	}

	function pesan_data_dis_lpb_kdhd()
	{
		$this->Mlaporan->ubah_status_dis_lpb_kdhd($this->input->post('id_distribusi_lpb'));
	}
	// ---------------------------- Notif Distribusi LPB Kepala Divisi Hutang Dagang ----------------------------

	// ---------------------------- Notif Distribusi LPB Kepala Divisi Accounting ----------------------------
	function hitung_dis_lpb_kda()
	{
		$data['validasi'] = $this->Mlaporan->hitung_dis_lpb_kda();
		if(count($data['validasi'])<=0)
		{
			echo "";
		}
		else
		{
			echo count($data['validasi']);
		}
	}

	function notif_data_dis_lpb_kda()
	{
		$data['validasi2'] = $this->Mlaporan->data_dis_lpb_kda();
		echo json_encode($data['validasi2']);
	}

	function pesan_data_dis_lpb_kda()
	{
		$this->Mlaporan->ubah_status_dis_lpb_kda($this->input->post('id_distribusi_lpb'));
	}
	// ---------------------------- Notif Distribusi LPB Kepala Divisi Accounting ----------------------------

	// ---------------------------- Notif Distribusi LPB Direktur ----------------------------
	function hitung_dis_lpb_direk()
	{
		$data['validasi'] = $this->Mlaporan->hitung_dis_lpb_direk();
		if(count($data['validasi'])<=0)
		{
			echo "";
		}
		else
		{
			echo count($data['validasi']);
		}
	}

	function notif_data_dis_lpb_direk()
	{
		$data['validasi2'] = $this->Mlaporan->data_dis_lpb_direk();
		echo json_encode($data['validasi2']);
	}

	function pesan_data_dis_lpb_direk()
	{
		$this->Mlaporan->ubah_status_dis_lpb_direk($this->input->post('id_distribusi_lpb'));
	}
	// ---------------------------- Notif Distribusi LPB Direktur ----------------------------

	function preview_lpb($id_lpb) 
	{
		$session = $this->session->userdata('user');
		$data['user'] = $this->Mprofil->ambil_user($session['id_user']);
		$data['ambil_lpb'] = $this->Mlaporan->ambil_lpb($id_lpb);
		$data['ambil_kalkulasi'] = $this->Mlaporan->ambil_kalkulasi($data['ambil_lpb']['id_sjm']);
		$data['detail'] = $this->Mlaporan->validasi_lpb($id_lpb);

		$title = base_url('assets/images/logo/pt_sus.png');
		$title = base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css');

		$this->load->library('dompdf_gen');

		if (!empty($data['ambil_lpb']['no_sjm'])) {
			$no_sjm = $data['ambil_lpb']['no_sjm'];
		}
		elseif (empty($data['ambil_lpb']['no_sjm']))
		{
			$no_sjm = "-";
		}

		if (!empty($data['ambil_lpb']['no_kendaraan'])) {
			$no_kendaraan = $data['ambil_lpb']['no_kendaraan'];
		}
		elseif (empty($data['ambil_lpb']['no_kendaraan']))
		{
			$no_kendaraan = "-";
		}

		foreach ($data['ambil_kalkulasi'] as $key => $value) {
			$no = $key+1;
			$nama_barang = $value['nama_barang'];
			$jenis = $value['jenis'];
			$sub_jenis = $value['sub_jenis'];
			$qty_sjm = $value['qty_sjm'];
			$satuan = $value['satuan'];

			if (!empty($value['ukuran'])) {
				$ukuran = $value['ukuran'];
			}
			elseif (empty($value['ukuran']))
			{
				$ukuran = "-";
			}

			$total =+ $value['qty_sjm'];
		}

		$keseluruhan = $total;

		$ttd_okta = base_url("assets/images/ttd/ttd_okta.jpg");
		$ttd_rolisa = base_url("assets/images/ttd/ttd_rolisa.jpg");

		if (!empty($data['ambil_lpb']['konfirmasi_ttd']) AND !empty($data['detail']['status_pengajuan'])) {
			$okta = '<div><label style="font-size: 12px; margin-left:20px;">Mengetahui</label><label style="font-size: 12px; margin-left:380px;">Diterima / Disetujui</label><div><img src='.$ttd_okta.' width="100"><img src='.$ttd_rolisa.' width="100" style="margin-left:355px;"></div><u style="font-size: 12px; margin-left:33px;">Okta</u><u style="font-size: 12px; margin-left:415px;">Rolisa Sutanti</u></div>';
		}

		$manuk = "<html><link rel='icon' href='".$title."'><title>LPB No. ".$data['ambil_lpb']['no_lpb']." - ".$data['ambil_lpb']['keterangan']."</title><style>@page{size: 21cm 29.7; margin-top: 4cm; margin-bottom: 3cm; margin-left: 4cm; margin-right: 3cm;}</style><style>@media print{.col-md-3{width: 30%;float: left;}.col-md-9{width: 70%;float: left;}}</style><style type='text/css'>.body-blue {border: 1px solid #3c8dbc;}</style><style type='text/css'>.body-black {border: 1px solid black;}</style><body><section class='content'>

		<div class='row'>
			<div class='col-xs-12'>
				<div class='box body-blue'>
					<div class='box-body' style='padding-top: 25px;'>
						<div class='form-group'>
							<div class='col-md-12'>
								<div>
									<h3 style='padding-left: 30px;'><i><b>PT. SINAR UTAMA SEJAHTERA</b></i></h3>
									<h3 align='center'><u><b>LAPORAN PENERIMAAN BARANG</b></u></h3>
								</div>
								<br><br>
								<div style='padding-left: 70px;'>
									<table align='justify'>
										<tr style='font-size: 12px;'>
											<td width='150'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>No.LPB</b></td>
											<td>:</td>
											<td>&nbsp;".$data['ambil_lpb']['no_lpb']."</td>

											<td width='130'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Tanggal Dibuat</b></td>
											<td>:</td>
											<td>&nbsp;".$data['ambil_lpb']['tgl_dibuat']."</td>

											<td width='130'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>No.Purchase Order</b></td>
											<td>:</td>
											<td>&nbsp;".$data['ambil_lpb']['no_purchase_order']."</td>
										</tr>
										<tr style='font-size: 12px;'>
											<td width='150'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>No.Surat Jalan Masuk</b></td>
											<td>:</td>
											<td>&nbsp;".$no_sjm."</td>

											<td width='130'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Supplier</b></td>
											<td>:</td>
											<td>&nbsp;".$data['ambil_lpb']['nama_supplier']."</td>

											<td width='130'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>No.Kendaran</b></td>
											<td>:</td>
											<td>&nbsp;".$no_kendaraan."</td>
										</tr>
									</table>
									<table align='justify'>
										<tr style='font-size: 12px;'>
											<td width='150'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Keterangan</b></td>
											<td>:</td>
											<td width='150'>&nbsp;".strip_tags($data['ambil_lpb']['keterangan'])."</td>
										</tr>
									</table>
								</div>

								<div class='col-xs-12' style='padding-left: 110px;'><br>
									<table>

										<tr align='center'>
											<th class='body-black' rowspan='2' width='30' style='padding-top: 10px; font-size:12px;'><b>No</b></th>
											<th class='body-black' rowspan='2' width='150' style='padding-top: 10px; font-size:12px;'><b>Nama Barang</b></th>
											<th class='body-black' rowspan='2' width='100' style='padding-top: 10px; font-size:12px;'><b>Jenis</b></th>
											<th class='body-black' rowspan='2' width='100' style='padding-top: 10px; font-size:12px;'><b>Sub Jenis</b></th>
											<th class='body-black' colspan='3' width='190' style='font-size: 12px;'><b>Jumlah</b></th>
										</tr>

										<tr>
											<td class='body-black' align='center' style='font-size: 12px;'><b>Qty Barang</b></td>
											<td class='body-black' align='center' style='font-size: 12px;'><b>Satuan</b></td>
											<td class='body-black' align='center' style='font-size: 12px;'><b>Ukuran</b></td>
										</tr>";

										foreach ($data['ambil_kalkulasi'] as $key => $value) {
											$no = $key+1;
											$nama_barang = $value['nama_barang'];
											$jenis = $value['jenis'];
											$sub_jenis = $value['sub_jenis'];
											$qty_sjm = $value['qty_sjm'];
											$satuan = $value['satuan'];
											$qty_total = $value['qty_total'];

											if (!empty($value['ukuran'])) {
												$ukuran = $value['ukuran'];
											}
											elseif (empty($value['ukuran']))
											{
												$ukuran = "-";
											}

											$manuk .= "<tr>
										<td class='body-black' align='center' style='font-size: 12px;'>".$no."</td>
										<td class='body-black' align='center' style='font-size: 12px;'>".$nama_barang."</td>
										<td class='body-black' align='center' style='font-size: 12px;'>".$jenis."</td>
										<td class='body-black' align='center' style='font-size: 12px;'>".$sub_jenis."</td>
										<td class='body-black' align='center' style='font-size: 12px;'>".$qty_sjm."</td>
										<td class='body-black' align='center' style='font-size: 12px;'>".$satuan."</td>
										<td class='body-black' align='center' style='font-size: 12px;'>".$ukuran."</td>
									</tr>";

										}

									$manuk .= "<tr>
									<td class='body-black' colspan='4' align='center' style='font-size: 12px;'><b>Qty Total</b></td>
									<td class='body-black' colspan='3' align='center' style='font-size: 12px;'>".$qty_total."</td>
								</tr>";

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
	</div>

</section></body></html>";
$this->dompdf->load_html($manuk);
$this->dompdf->set_paper("A4", "landscape");
$this->dompdf->render();

$this->dompdf->stream("", array("Attachment"=> 0));
}

	// =================== lpb ============================

}

?>