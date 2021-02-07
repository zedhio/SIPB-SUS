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
		$this->load->model('Mbuyer');
		$this->load->model('Mbarang');
		$this->load->model('Msupplier');
	}

	public function index()
	{
		$session = $this->session->userdata('user');
		$data['user'] = $this->Mprofil->ambil_user($session['id_user']);
		$data['production_order'] = $this->Mproduction_order->tampil_production_order(); 

		if ($this->input->post('cari')) {
			$data['production_order'] = $this->Mproduction_order->cari_po($this->input->post());
		}

		if ($this->input->post('setuju')) 
		{
			$input = $this->input->post();
			$id_po = $input['id_val_po'];
			$inputan['status_pengajuan'] = "Disetujui";
			$inputan['tgl_dikonfirmasi'] = $input['tgl_dikonfirmasi'];
			$this->Mproduction_order->konfirmasi_persetujuan_po($id_po, $inputan);
			echo "<script>";
			echo "alert('Production order telah disetujui');";
			echo "location='".base_url("user/validasi/production_order")."';";
			echo "</script>";
		}

		if ($this->input->post('tolak')) 
		{
			$input = $this->input->post();
			$id_po = $input['id_val_po'];
			$inputan['status_pengajuan'] = $input['ditolak'];
			$inputan['alasan'] = $input['alasan'];
			$inputan['tgl_dikonfirmasi'] = $input['tgl_dikonfirmasi'];
			$this->Mproduction_order->konfirmasi_persetujuan_po_tolak($id_po,$inputan);
			echo "<script>";
			echo "alert('Production order telah ditolak');";
			echo "location='".base_url("user/validasi/production_order")."';";
			echo "</script>";
		}
		
		$this->load->view('user/header',$data);	
		$this->load->view('user/navbar',$data);
		$this->load->view('user/validasi/production_order/tampil',$data);
		$this->load->view('user/footer');	
	}

	function detail($id_po)
	{
		$session = $this->session->userdata('user');
		$data['user'] = $this->Mprofil->ambil_user($session['id_user']);
		$data['production_order'] = $this->Mproduction_order->ambil_production_order($id_po);
		$data['ppic'] = $this->Mproduction_order->ambil_ppic($id_po);

		$this->load->view('user/header',$data);  
		$this->load->view('user/navbar',$data);
		$this->load->view('user/validasi/production_order/detail',$data);
		$this->load->view('user/footer');	
	}

	// ---------------------------- Notif Validasi Production Order Kepala Gudang ----------------------------
	function hitung_val_po_kg()
	{
		$data['validasi'] = $this->Mproduction_order->hitung_val_po_kg();
		if(count($data['validasi'])<=0)
		{
			echo "";
		}
		else
		{
			echo count($data['validasi']);
		}
	}

	function notif_data_val_po_kg()
	{
		$data['validasi2'] = $this->Mproduction_order->data_val_po_kg();
		echo json_encode($data['validasi2']);
	}

	function pesan_data_val_po_kg()
	{
		$this->Mproduction_order->ubah_status_val_po_kg($this->input->post('id_val_po'));
	}
	// ---------------------------- Notif Validasi Production Order Kepala Gudang ----------------------------	

	// ---------------------------- Notif Validasi Production Order Kepala Divisi Production Manager ----------------------------
	function hitung_val_po_kdpm()
	{
		$data['validasi'] = $this->Mproduction_order->hitung_val_po_kdpm();
		if(count($data['validasi'])<=0)
		{
			echo "";
		}
		else
		{
			echo count($data['validasi']);
		}
	}

	function notif_data_val_po_kdpm()
	{
		$data['validasi2'] = $this->Mproduction_order->data_val_po_kdpm();
		echo json_encode($data['validasi2']);
	}

	function pesan_data_val_po_kdpm()
	{
		$this->Mproduction_order->ubah_status_val_po_kdpm($this->input->post('id_val_po'));
	}
	// ---------------------------- Notif Validasi Production Order Kepala Divisi Production Manager ----------------------------

	// ---------------------------- Notif Validasi Production Order Direktur ----------------------------
	function hitung_val_po_direk()
	{
		$data['validasi'] = $this->Mproduction_order->hitung_val_po_direk();
		if(count($data['validasi'])<=0)
		{
			echo "";
		}
		else
		{
			echo count($data['validasi']);
		}
	}

	function notif_data_val_po_direk()
	{
		$data['validasi2'] = $this->Mproduction_order->data_val_po_direk();
		echo json_encode($data['validasi2']);
	}

	function pesan_data_val_po_direk()
	{
		$this->Mproduction_order->ubah_status_val_po_direk($this->input->post('id_val_po'));
	}
	// ---------------------------- Notif Validasi Production Order Direktur ----------------------------	

}

?>