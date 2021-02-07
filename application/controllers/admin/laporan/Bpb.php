<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bpb extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		// Agar login user tidak jebol
		if (!$this->session->userdata('admin')) {
			echo "<script>alert('Anda harus login terlebih dahulu');location='".base_url("admin/login")."'</script>";
		}

		// nge-load model
		$this->load->model('Mprofil');
		$this->load->model('Mbpb');
	}

	// =================== lpb ============================

	public function index()
	{
		$session = $this->session->userdata('admin');
		$data['admin'] = $this->Mprofil->ambil_admin($session['id_admin']);
		$data['laporan'] = $this->Mbpb->tampil_laporan_bpb_admin();

		//Kondisi jika klik tombol cari data lpb
		if ($this->input->post()) {
			$data['laporan'] = $this->Mbpb->cari_lap_bpb($this->input->post());
		}

		if ($this->input->post('rekap_bpb')) 
		{
			redirect('admin/laporan/bpb/rekapitulasi_bpb','refresh');	
		}

		$this->load->view('admin/header',$data);	
		$this->load->view('admin/navbar',$data);
		$this->load->view('admin/laporan/bpb/tampil',$data);
		$this->load->view('admin/footer');	
	}

	function rekapitulasi_bpb()
	{
		$session = $this->session->userdata('admin');
		$data['admin'] = $this->Mprofil->ambil_admin($session['id_admin']);
		$data['rekap_bpb'] = $this->Mbpb->tampil_rekap_bpb();

		$data['bulan']="";
		$data['tahun']="";

		if ($this->input->post('cari')) {
			$data['rekap_bpb'] = $this->Mbpb->cari_rekap_bpb($this->input->post());
			$data['bulan'] = $this->input->post('bulan');
			$data['tahun'] = $this->input->post('tahun');
		}

		$this->load->view('admin/header',$data);	
		$this->load->view('admin/navbar',$data);
		$this->load->view('admin/laporan/bpb/rekapitulasi_bpb',$data);
		$this->load->view('admin/footer');	
	}

	function detail($id_bpb) 
	{
		$session = $this->session->userdata('admin');
		$data['admin'] = $this->Mprofil->ambil_admin($session['id_admin']);
		$data['ambil_bpb'] = $this->Mbpb->ambil_bpb($id_bpb);
		$data['ambil_kalkulasi'] = $this->Mbpb->ambil_kalkulasi($id_bpb);

		$this->load->view('admin/header',$data);
		$this->load->view('admin/navbar',$data);
		$this->load->view('admin/laporan/bpb/detail',$data);
		$this->load->view('admin/footer');
	}

	function preview_bpb($id_bpb) 
	{
		$session = $this->session->userdata('admin');
		$data['admin'] = $this->Mprofil->ambil_admin($session['id_admin']);
		$data['ambil_bpb'] = $this->Mbpb->ambil_bpb($id_bpb);
		$data['ambil_kalkulasi'] = $this->Mbpb->ambil_kalkulasi($id_bpb);

		$title = base_url('assets/images/logo/pt_sus.png');
		$title = base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css');

		$this->load->library('dompdf_gen');

		$ttd_okta = base_url("assets/images/ttd/ttd_okta.jpg");
		$ttd_rolisa = base_url("assets/images/ttd/ttd_rolisa.jpg");

		if ($data['ambil_bpb']['count_agree']==3) {
			$okta = '<div><label style="font-size: 12px; margin-left:20px;">Yang Meminta</label><label style="font-size: 12px; margin-left:165px;">Yang Menyerahkan</label><label style="font-size: 12px; margin-left:165px;">Disetujui</label><div><img src='.$ttd_okta.' width="100"><img src='.$ttd_rolisa.' width="100" style="margin-left:160px;"><img src='.$ttd_rolisa.' width="100" style="margin-left:130px;"></div><u style="font-size: 12px; margin-left:33px;">Daryuti</u><u style="font-size: 12px; margin-left:225px;">Okta</u><u style="font-size: 12px; margin-left:210px;">Ribut</u></div>';	
		}

		$manuk = "<html><link rel='icon' href='".$title."'><title>BPB No. ".$data['ambil_bpb']['nama_po']." -  ".$data['ambil_bpb']['no_po']."</title><style>@page{size: 21cm 29.7; margin-top: 4cm; margin-bottom: 3cm; margin-left: 4cm; margin-right: 3cm;}</style><style>@media print{.col-md-3{width: 30%;float: left;}.col-md-9{width: 70%;float: left;}}</style><style type='text/css'>.body-blue {border: 1px solid #3c8dbc;}</style><style type='text/css'>.body-black {border: 1px solid black;}</style><body><section class='content'>

		<div class='row'>
			<div class='col-xs-12'>
				<div class='box body-blue'>
					<div class='box-body' style='padding-top: 25px;'>
						<div class='form-group'>
							<div class='col-md-12'>
								<div>
									<h3 style='padding-left: 30px;'><i><b>PT. SINAR UTAMA SEJAHTERA</b></i></h3>
									<h3 align='center'><u><b>LAPORAN BUKTI PENGELUARAN BARANG</b></u></h3>
								</div>
								<br><br>
								<div class='col-xs-12'>
									<table style='padding-left: 380px;'>
										<tr>
											<th width='82' style='font-size: 14px;'>No.BPB</th>
											<td>:</td>
											<td style='font-size: 14px;'>&nbsp; ".$data['ambil_bpb']['no_bpb']."</td>
										</tr>
										<tr>
											<th width='82' style='font-size: 14px;'>Tanggal</th>
											<td>:</td>
											<td style='font-size: 14px;'>&nbsp; ".$data['ambil_bpb']['tgl_dibuat']."</td>
										</tr>
										<tr>
											<th width='82' style='font-size: 14px;'>Bagian</th>
											<td>:</td>
											<td style='font-size: 14px;'>&nbsp; ".$data['ambil_bpb']['bagian']."</td>
										</tr>
									</table>
									<table style='padding-left: 120px;padding-top: 20px;'>
										<tr>

											<th width='20' style='font-size: 14px;'>P.O</th>
											<td>:</td>
											<td style='font-size: 14px;'>&nbsp; ".$data['ambil_bpb']['nama_po']." (".$data['ambil_bpb']['no_po'].")</td>

											<th width='20' style='font-size: 14px; padding-left: 20px;'>Order</th>
											<td>:</td>
											<td style='font-size: 14px;'>&nbsp; ".$data['ambil_bpb']['qty']." Pcs</td>

											<th width='20' style='font-size: 14px; padding-left: 20px;'>Buyer</th>
											<td>:</td>
											<td style='font-size: 14px;'>&nbsp; ".$data['ambil_bpb']['nama_buyer']."</td>

											<th width='20' style='font-size: 14px; padding-left: 20px;'>Style Glove</th>
											<td>:</td>
											<td style='font-size: 14px;'>&nbsp; ".$data['ambil_bpb']['nama_style']."</td>

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
											$qty_bpb = $value['qty_bpb'];
											$satuan = $value['satuan'];

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
											<td class='body-black' align='center' style='font-size: 12px;'>".$qty_bpb."</td>
											<td class='body-black' align='center' style='font-size: 12px;'>".$satuan."</td>
											<td class='body-black' align='center' style='font-size: 12px;'>".$ukuran."</td>
										</tr>";

									}

								// 	$manuk .= "<tr>
								// 	<td class='body-black' colspan='4' align='center' style='font-size: 12px;'><b>Qty Total</b></td>
								// 	<td class='body-black' colspan='3' align='center' style='font-size: 12px;'>".$qty_total."</td>
								// </tr>";

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

	$this->dompdf->stream("BPB No. ".$data['ambil_bpb']['no_bpb']." - ".$data['ambil_bpb']['nama_po']." ( ".$data['ambil_bpb']['no_po']." ).pdf", array("Attachment"=> 1));
}

	// =================== lpb ============================

}

?>