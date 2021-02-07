<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Production_order extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		// Agar login user tidak jebol
		if (!$this->session->userdata('user')) {
			echo "<script>alert('Anda harus login terlebih dahulu');location='".base_url("login")."'</script>";
		}

		// nge-load model
		$this->load->model('Mprofil');
		$this->load->model('Mproduction_order');
	}

	// =================== lpb ============================

	public function index()
	{
		$session = $this->session->userdata('user');
		$data['user'] = $this->Mprofil->ambil_user($session['id_user']);
		$data['laporan'] = $this->Mproduction_order->tampil_laporan();


		if ($this->input->post('cari10')) {
			$data['laporan'] = $this->Mproduction_order->cari_lap_po_user($this->input->post());
		}

		// if ($this->input->post('rekap')) 
		// {
			// redirect('user/laporan/lpb/rekapitulasi_lpb','refresh');	
		// }

		$this->load->view('user/header',$data);	
		$this->load->view('user/navbar',$data);
		$this->load->view('user/laporan/production_order/tampil',$data);
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

	// ---------------------------- Notif Distribusi Lap PO Staff Unit Sewing ----------------------------
	function hitung_dis_po_sus()
	{
		$data['validasi'] = $this->Mproduction_order->hitung_dis_po_sus();
		if(count($data['validasi'])<=0)
		{
			echo "";
		}
		else
		{
			echo count($data['validasi']);
		}
	}

	function notif_data_dis_po_sus()
	{
		$data['validasi2'] = $this->Mproduction_order->data_dis_po_sus();
		echo json_encode($data['validasi2']);
	}

	function pesan_data_dis_po_sus()
	{
		$this->Mproduction_order->ubah_status_dis_po_sus($this->input->post('id_distribusi_po'));
	}
	// ---------------------------- Notif Distribusi Lap PO Staff Unit Sewing ----------------------------

	function preview_lap_po($id_po) 
	{
		$session = $this->session->userdata('user');
		$data['user'] = $this->Mprofil->ambil_user($session['id_user']);
		$data['production_order'] = $this->Mproduction_order->ambil_production_order($id_po);
		$data['ppic'] = $this->Mproduction_order->ambil_ppic($id_po);

		$title = base_url('assets/images/logo/pt_sus.png');

		$this->load->library('dompdf_gen');

		if (!empty($data['production_order'][0]['tgl_kirim']=="0000-00-00"))
		{
            $tgl_kirim = "-";
		}
        elseif (!empty($data['production_order'][0]['tgl_kirim']))
        {
            $tgl_kirim = $data['production_order'][0]['tgl_kirim'];
        }

		$ttd_okta = base_url("assets/images/ttd/ttd_okta.jpg");
		$ttd_rolisa = base_url("assets/images/ttd/ttd_rolisa.jpg");

		$back_palm = base_url("assets/images/foto_glove/".$data['production_order'][0]['foto_glove']);

        // ========================== TTD Atas ===============================

		if (!empty($data['production_order'][0]['konfirmasi'])) {
			$staff_ppic = '<img src='.$ttd_rolisa.' height="60">';
		}

		if ($data['production_order'][0]['validasi_po'][0]['status_pengajuan']=="Disetujui") {
			$kg = '<img src='.$ttd_rolisa.' height="60">';
		}

        if ($data['production_order'][0]['validasi_po'][1]['status_pengajuan']=="Disetujui")
        {
			$kmp = '<img src='.$ttd_rolisa.' height="60">';
        }

        if ($data['production_order'][0]['validasi_po'][2]['status_pengajuan']=="Disetujui")
        {
			$direktur = '<img src='.$ttd_rolisa.' height="60">';
        }

        // ========================== TTD Atas ===============================

        if (!empty($data['production_order'][0]['body'])) {
        	$body = $data['production_order'][0]['body'];
        }
        elseif (empty($data['production_order'][0]['body'])) {
        	$body = "-";
        }

        if (!empty($data['production_order'][0]['thumb'])) {
        	$thumb = $data['production_order'][0]['thumb'];
        }
        elseif (empty($data['production_order'][0]['thumb'])) {
        	$thumb = "-";
        }

        if (!empty($data['production_order'][0]['machi'])) {
        	$machi = $data['production_order'][0]['machi'];
        }
        elseif (empty($data['production_order'][0]['machi'])) {
        	$machi = "-";
        }
        
        if (!empty($data['production_order'][0]['velcro'])) {
        	$velcro1= $data['production_order'][0]['velcro'];
        }
        elseif (empty($data['production_order'][0]['velcro'])) {
        	$velcro1= "-";
        }

        $total=0;

        foreach ($data['production_order'][0]['mens_cadet'] as $key => $value) {
		   	$no = $key+1;
			$hands = $value['hands'];
			$size = $value['size'];
			$qty = $value['qty'];
			$total+=$value['qty'];
		}

		$total1 = 0;

        foreach ($data['production_order'][0]['ladies_cadet'] as $key => $value) {
		   	$no = $key+1;
			$hands = $value['hands'];
			$size = $value['size'];
			$qty = $value['qty'];
			$total1+=$value['qty'];
		}

		$sub_total = 0;

		$sub_total = $total + $total1;

		$foto = '<img src='.$back_palm.' style="width: 490px; height: 318px;">';

		$manuk = "<html><link rel='icon' href='".$title."'><title>Laporan PO No. ".$data['production_order'][0]['no_po']." - ".$data['production_order'][0]['nama_po']." Tanggal ".date('d-m-Y', strtotime($data['production_order'][0]['tgl_order']))."</title><style>@page{size: 21cm 29.7; margin-top: 4cm; margin-bottom: 3cm; margin-left: 4cm; margin-right: 3cm;}</style><style>@media print{.col-md-3{width: 30%;float: left;}.col-md-9{width: 70%;float: left;}}</style><style type='text/css'>.body-blue {border: 1px solid #3c8dbc;}</style><style type='text/css'>.body-black {border: 1px solid black;}</style><body><section class='content'>

		<div class='row'>
			<div class='col-xs-12'>
				<div class='box body-blue'>
					<div class='box-body' style='padding-top: 25px;'>
						<div class='form-group'>
							<div class='col-md-12'>
								<div>
									<h3 align='center'><u><b>LAPORAN PRODUCTION ORDER</b></u></h3>
								</div>
								<div style='position: absolute;'>
									<table align='center' style='margin-top: 140px;'>
										<tr style='font-size: 14px;' align='center'>
											<td>".$data['production_order'][0]['tgl_order']."</td>
										</tr>
										<tr style='font-size: 14px;'>
											<td><u>No : ".$data['production_order'][0]['no_po']."</u></td>
										</tr>
									</table>
								</div>
								<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
								
								<div>
									<div style='position: absolute;'>
						                <table style='margin-left: 50px; margin-top: 220px;'>
						                  <tr style='font-size:14px;'>
						                    <td><b>Nama Production Order</b></td>
						                    <td>:</td>
						                    <td>&nbsp;".$data['production_order'][0]['nama_po']."</td>
						                  </tr>
						                  <tr style='font-size:14px;'>
						                    <td><b>Buyer</b></td>
						                    <td>:</td>
						                    <td>&nbsp;".$data['production_order'][0]['nama_buyer']."</td>
						                  </tr>
						                  <tr style='font-size:14px;'>
						                    <td><b>Style</b></td>
						                    <td>:</td>
						                    <td>&nbsp;".$data['production_order'][0]['nama_style']."</td>
						                  </tr>
						                </table>
					            	</div>

					            	<div style='position: absolute;'>
						                <table style='margin-left: 330px; margin-top: 220px;'>
						                  <tr style='font-size:14px;'>
						                    <td><b>Qty</b></td>
						                    <td>:</td>
						                    <td>&nbsp;".$data['production_order'][0]['qty']." Pcs</td>
						                  </tr>
						                  <tr style='font-size:14px;'>
						                    <td><b>Ship Date</b></td>
						                    <td>:</td>
						                    <td>&nbsp;".$tgl_kirim."</td>
						                  </tr>
						                </table>
					            	</div>

					            	<div style='position: absolute;'>
						                <table style='margin-left: 750px; margin-top: 220px;'>
						                  <tr style='font-size:14px;'>
						                  	<th class='text-center body-black' height='20' width='100'><b>Staff PPIC</b></th>
						                    <th class='text-center body-black' width='110'><b>K.Manager Produksi</b></th>
						                    <th class='text-center body-black' width='100'><b>Direktur</b></th>
						                  </tr>
						                  <tr height='50'>
						                    <td class='body-black' align='center'>
						                    	".$staff_ppic."
						                    </td>
						                    <td class='body-black' align='center'>
						                    	".$kmp."
						                    </td>
						                    <td class='body-black' align='center'>
						                    	".$direktur."
						                    </td>
						                  </tr>  
						                </table>
					            	</div>

					            	<div style='position: absolute;'>
						                <table style='margin-left: 50px; margin-top: 360px;'>
						                  <tr align='center' style='font-size: 14px;'>
						                   	<th colspan='6' height='25' class='body-black'><b>Colour</b></th>
						                  </tr>
						                  <tr style='font-size: 14px;' align='center'>
						                    <td class='body-black' width='70' height='25'><b>Leather</b></td>
						                    <td class='body-black' width='65' ><b>Velcro</b></td>
						                    <td class='body-black' width='150' ><b>Logo</b></td>
						                    <td class='body-black' width='65' ><b>PU Tape</b></td>
						                    <td class='body-black' width='65' ><b>Lycra</b></td>
						                    <td class='body-black' width='65' ><b>Patch</b></td>
						                  </tr>";

						                  foreach ($data['production_order'][0]['colour_pos'] as $key => $value) {
											$leather = $value['leather'];
											$velcro = $value['velcro'];
											$logo = $value['logo'];
											$pu_tape = $value['pu_tape'];

											if (!empty($value['lycra']))
											{
                          						$lycra = $value['lycra'];
											}
                        					elseif (empty($value['lycra']))
                        					{
                          						$lycra = "No Lycra";
                        					}

                        					if (!empty($value['patch']))
                        					{
                          						$patch = $value['patch'];
                        					}
                        					elseif (empty($value['patch']))
                        					{
                          						$patch = "No Patch";
                        					}

											$manuk .= "<tr style='font-size: 14px;'>
										<td class='body-black' align='center' height='20'>".$leather."</td>
										<td class='body-black' align='center'>".$velcro."</td>
										<td class='body-black' align='center'>".$logo."</td>
										<td class='body-black' align='center'>".$pu_tape."</td>
										<td class='body-black' align='center'>".$lycra."</td>
										<td class='body-black' align='center'>".$patch."</td>
									</tr>";

										}

						                $manuk .= "</table>
					            	</div>

					            	<div style='position: absolute;'>
						                <table style='margin-left: 589px; margin-top: 360px;'>
						                  <tr align='center' style='font-size: 12px;'>
						                   	<th colspan='4' height='25' class='body-black'><b>Mens Cadet</b></th>
						                  </tr>
						                  <tr style='font-size: 12px;' align='center'>
						                    <td class='body-black' width='35' height='25'><b>No</b></td>
						                    <td class='body-black' width='60' ><b>Hands</b></td>
						                    <td class='body-black' width='55' ><b>Size</b></td>
						                    <td class='body-black' width='60' ><b>Qty (Pcs)</b></td>
						                  </tr>";

						                  foreach ($data['production_order'][0]['mens_cadet'] as $key => $value) {
						                  	$no = $key+1;
											$hands = $value['hands'];
											$size = $value['size'];
											$qty = $value['qty'];

											$manuk .= "<tr style='font-size: 14px;'>
												<td class='body-black' align='center' height='20' >".$no."</td>
												<td class='body-black' align='center' >".$hands."</td>
												<td class='body-black' align='center' >".$size."</td>
												<td class='body-black' align='center' >".$qty."</td>
											</tr>";

										  }

						                  $manuk .= "<tr style='font-size: 14px;'>
											<td class='body-black' colspan='3' align='center' height='20' ><b>Qty Total</b></td>
											<td class='body-black' align='center'>".$total."</td>
										  </tr>
						                </table>
					            	</div>

					            	<div style='position: absolute;'>
						                <table style='margin-left: 845px; margin-top: 360px;'>
						                  <tr align='center' style='font-size: 14px;'>
						                   	<th colspan='4' height='25' class='body-black'><b>Ladies Cadet</b></th>
						                  </tr>
						                  <tr style='font-size: 14px;' align='center'>
						                    <td class='body-black' width='35' height='25'><b>No</b></td>
						                    <td class='body-black' width='60' ><b>Hands</b></td>
						                    <td class='body-black' width='55' ><b>Size</b></td>
						                    <td class='body-black' width='60' ><b>Qty (Pcs)</b></td>
						                  </tr>";

						                  foreach ($data['production_order'][0]['ladies_cadet'] as $key => $value) {
						                  	$no1 = $key+1;
											$hands1 = $value['hands'];
											$size1 = $value['size'];
											$qty1 = $value['qty'];

											$manuk .= "<tr style='font-size: 14px;'>
												<td class='body-black' height='20' align='center'>".$no1."</td>
												<td class='body-black' align='center'>".$hands1."</td>
												<td class='body-black' align='center'>".$size1."</td>
												<td class='body-black' align='center'>".$qty1."</td>
											</tr>";

										  }

						                  $manuk .= "<tr style='font-size: 14px;'>
											<td class='body-black' colspan='3' align='center' height='20'><b>Qty Total</b></td>
											<td class='body-black' align='center'>".$total1."</td>
										  </tr>
						                </table>
					            	</div>

					            	<div style='position: absolute;'>
					            		<br>
						                <table style='margin-left: 845px; margin-top: 470px;'>
						                	<tr style='font-size: 14px;' align='center'>
						                		<td class='body-black' width='158' height='25'><b>Sub Total</b></td>
						                		<td class='body-black' width='60'>".$sub_total."</td>
						                	</tr>
						                </table>
						            </div>

						            <div style='position: absolute;'>
						                <table style='margin-left: 50px; margin-top: 570px;'>
						                	<tr style='font-size: 14px;' align='center'>
						                		<td class='body-black' height='25'><b>Back</b></td>
                    							<td class='body-black' ><b>Palm</b></td>
						                	</tr>
						                	<tr align='center'>
							                    <td colspan='2' class='body-black' width='480'>
							                      ".$foto."
							                    </td>
                  							</tr>
						                </table>
						            </div>

						            <div style='position: absolute;'>
						                <table style='margin-left: 589px; margin-top: 570px;'>
						                	<tr style='font-size: 14px;' align='center'>
						                		<td class='body-black' height='25' width='273'><b>Keterangan</b></td>
						                	</tr>
						                	<tr style='font-size: 14px;'>
							                    <td class='body-black'>
							                     	<p>".$data['production_order'][0]['keterangan']."</p>
							                    </td>
                  							</tr>
						                </table>
						            </div>

						            <div style='position: absolute;'>
						                <table style='margin-left: 885px; margin-top: 570px;'>
						                	<tr style='font-size: 14px;' align='center'>
						                		<td class='body-black' height='25' width='183'><b>Remark</b></td>
						                	</tr>
						                	<tr style='font-size: 14px;'>
							                    <td class='body-black'>
							                     	<p>".$data['production_order'][0]['remark']."</p>
							                    </td>
                  							</tr>
						                </table>
						            </div>

						            <div style='position: absolute;'>
						                <table style='margin-left: 555px; margin-top: 860px;'>
						                	<tr style='font-size: 14px;' align='center'>
						                		<td class='body-black'  height='25'><b>Body</b></td>
						                    	<td class='body-black' ><b>Thumb</b></td>
						                    	<td class='body-black' ><b>Machi</b></td>
						                    	<td class='body-black' ><b>Velcro</b></td>
						                	</tr>
						                	<tr style='font-size: 14px;' align='center'>
						                		<td class='body-black' width='65' height='20'>".$body."</td>
						                    	<td class='body-black' width='65'>".$thumb."</td>
						                    	<td class='body-black' width='65'>".$machi."</td>
						                    	<td class='body-black' width='65'>".$velcro1."</td>
						                	</tr>
						                </table>
						            </div>

					            </div>

							</div>
						</div>
					</div>
				</div>

				<div class='box body-blue'>
					<div class='box-body' style='padding-top: 25px;'>
						<div class='form-group'>
							<div class='col-md-12'>
								<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
								
								<div>
									<div style='position: absolute;'>
						                <table style='margin-left: 50px; margin-top: 220px;'>
						                  <tr style='font-size:20px;'>
						                    <td><b>Production Planning Inventory And Control (PPIC)</b></td>
						                  </tr>
						                </table>
					            	</div>

									<div style='position: absolute;'>
						                <table style='margin-left: 50px; margin-top: 260px;'>
						                  <tr style='font-size:14px;'>
						                    <td><b>Tanggal Order</b></td>
						                    <td>:</td>
						                    <td>&nbsp;".$data['production_order'][0]['tgl_order']."</td>
						                  </tr>
						                  <tr style='font-size:14px;'>
						                    <td><b>Style</b></td>
						                    <td>:</td>
						                    <td>&nbsp;".$data['production_order'][0]['nama_style']."</td>
						                  </tr>
						                  <tr style='font-size:14px;'>
						                    <td><b>Qty</b></td>
						                    <td>:</td>
						                    <td>&nbsp;".$data['production_order'][0]['qty']."</td>
						                  </tr>
						                </table>
					            	</div>

					            	<div style='position: absolute;'>
						                <table style='margin-left: 632px; margin-top: 220px;'>
						                  <tr style='font-size:14px;'>
						                  	<th class='text-center body-black' height='20' width='100'><b>Staff PPIC</b></th>
						                    <th class='text-center body-black' width='110'><b>K.Gudang</b></th>
						                    <th class='text-center body-black' width='110'><b>K.Manager Produksi</b></th>
						                    <th class='text-center body-black' width='100'><b>Direktur</b></th>
						                  </tr>
						                  <tr height='50'>
						                    <td class='body-black' align='center'>
						                    	".$staff_ppic."
						                    </td>
						                	<td class='body-black' align='center'>
						                    	".$kg."
						                    </td>
						                    <td class='body-black' align='center'>
						                    	".$kmp."
						                    </td>
						                    <td class='body-black' align='center'>
						                    	".$direktur."
						                    </td>
						                  </tr>  
						                </table>
					            	</div>

					            	<div style='position: absolute;'>
						                <table style='margin-left: 50px; margin-top: 360px;'>
						                  <tr align='center' style='font-size: 14px;'>
						                   	<th rowspan='2' height='25' width='20' class='body-black'><b>No</b></th>
						                   	<th rowspan='2' width='120' class='body-black'><b>Nama Barang</b></th>
						                   	<th rowspan='2' width='50' class='body-black'><b>Warna</b></th>
						                   	<th colspan='4' height='25' class='body-black'><b>Kebutuhan Sebelum Produksi</b></th>
						                   	<th rowspan='2' width='50' class='body-black'><b>Satuan</b></th>
						                   	<th rowspan='2' width='50' class='body-black'><b>Stock</b></th>
						                   	<th rowspan='2' width='75' class='body-black'><b>Kekurangan</b></th>
						                   	<th rowspan='2' width='75' class='body-black'><b>Supplier</b></th>
						                   	<th rowspan='2' width='75' class='body-black'><b>Rendement (Meter)</b></th>
						                   	<th colspan='2' class='body-black'><b>Actual Pemakaian</b></th>
						                  </tr>

						                  <tr align='center' style='font-size: 14px;'>
						                   	<td height='20' width='50' class='body-black'><b>Order</b></td>
						                   	<td width='50' class='body-black'><b>Satu Pcs</b></td>
						                   	<td width='50' class='body-black'><b>Rendement (Meter)</b></td>
						                   	<td width='50' class='body-black'><b>Total Kebutuhan</b></td>
						                   	<td width='87' class='body-black'><b>Total Produksi</b></td>
						                   	<td width='87' class='body-black'><b>Remarks</b></td>
						                  </tr>";

						                  foreach ($data['ppic'] as $key => $value) {
											$no = $key+1;
											$nama_barang = $value['nama_barang'];

											if (!empty($value['warna']))
											{
                          						$warna = $value['warna'];
											}
                        					elseif (empty($value['warna']))
                        					{
                          						$warna = "-";
                          					}

                          					$order = $value['ksp'][0]['order'];
                          					$per_pcs = $value['ksp'][0]['per_pcs'];
                          					$rendement_per_meter = $value['ksp'][0]['rendement_per_meter'];
                          					$total_kebutuhan = $value['ksp'][0]['total_kebutuhan'];
                          					$satuan = $value['satuan'];
                          					$stok = $value['stok'];

                          					if (!empty($value['ksp']))
                          					{
                        						$kekurangan = $value['stok'] - $value['ksp'][0]['total_kebutuhan'];
                        					}

                        					if (!empty($value['ksp']))
                        					{
                          						if ($kekurangan<0)
                          						{
                            						$kekurangan1 = $kekurangan;
                            					}
                          						elseif ($kekurangan>0)
                          						{
                            						$kekurangan1 = "-";
                            					}
                            				}

                            				if ($value['id_supplier']==0)
                            				{
                          						$supplier = "-";
                          					}
                        					elseif ($value['id_supplier']!==0)
                        					{
                          						$supplier = $value['nama_supplier'];
                        					}

                        					if ($value['rendement_satu_meter']==0)
                        					{
                          						$rendement = "-";
                          					}
                        					elseif ($value['rendement_satu_meter']!==0)
                        					{
                          						$rendement = $value['rendement_satu_meter'];
                        					}

                        					if (!empty($value['ap'][0]))
                        					{
                          						if ($value['ap'][0]['total_produksi']==0)
                          						{
                            						$total_produksi = "-";
                            					}
                          						elseif ($value['ap'][0]['total_produksi']!==0)
                          						{
                            						$total_produksi = $value['ap'][0]['total_produksi'];
                          						}
                          					}

                          					if (empty($value['ap'][0]['remark']))
                          					{
                          						$remark = "-";
                          					}
                        					elseif (!empty($value['ap'][0]['remark']))
                        					{
                          						$remark = $value['ap'][0]['remark'];
                          					}

											$manuk .= "<tr style='font-size: 14px;'>
										<td class='body-black' align='center' height='20'>".$no."</td>
										<td class='body-black' align='center'>".$nama_barang."</td>
										<td class='body-black' align='center'>".$warna."</td>
										<td class='body-black' align='center'>".$order."</td>
										<td class='body-black' align='center'>".$per_pcs."</td>
										<td class='body-black' align='center'>".$rendement_per_meter."</td>
										<td class='body-black' align='center'>".$total_kebutuhan."</td>
										<td class='body-black' align='center'>".$satuan."</td>
										<td class='body-black' align='center'>".$stok."</td>
										<td class='body-black' align='center'>".$kekurangan1."</td>
										<td class='body-black' align='center'>".$supplier."</td>
										<td class='body-black' align='center'>".$rendement."</td>
										<td class='body-black' align='center'>".$total_produksi."</td>
										<td class='body-black' align='center'>".$remark."</td>
									</tr>";

										}

						                $manuk .= "</table>
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
	$this->dompdf->set_paper("A3", "landscape");
	$this->dompdf->render();

	$this->dompdf->stream("", array("Attachment"=> 0));
}

	// =================== lpb ============================

}

?>