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
		$this->load->model('Mproduction_order');
	}

	// =================== bon ============================

	public function index()
	{
		$session = $this->session->userdata('admin');
		$data['admin'] = $this->Mprofil->ambil_admin($session['id_admin']);
		$data['bpb'] = $this->Mbpb->tampil_bpb();

		if ($this->input->post('cari')) {
			$data['bpb'] = $this->Mbpb->cari_bpb($this->input->post());
		}

		if ($this->input->post('ajukan')) {

			$input = $this->input->post();
			 
			$inputan['id_bpb'] = $input['id_bpb'];
			$inputan['yang_meminta'] = $input['yang_meminta'];
			$inputan['tujuan'] = $input['tujuan'];
			$inputan['perihal'] = $input['perihal'];
			$inputan['tgl_diajukan'] = $input['tgl_diajukan'];

			$this->Mbpb->pengajuan_bpb($inputan);
			echo "<script>";
			echo "alert('Pengajuan Persetujuan Bukti Pengeluaran Barang Telah Dikirim');";
			echo "location='".base_url("admin/bpb/bpb")."';";
			echo "</script>";
		}

		if ($this->input->post('kirim')) 
		{
			$input = $this->input->post();
			$inputan['id_bpb'] = $input['id_bpb'];
			$inputan['asal'] = $input['asal'];
			$inputan['tujuan'] = $input['tujuan'];
			$inputan['tgl_diterima'] = $input['tgl_diterima'];

			$this->Mbpb->kirim_bpb($inputan);

			echo "<script>";
			echo "alert('Berhasil mengirim laporan bpb');";
			echo "location='".base_url("admin/bpb/bpb")."';";
			echo "</script>";
		}

		$this->load->view('admin/header',$data);	
		$this->load->view('admin/navbar',$data);
		$this->load->view('admin/bpb/tampil',$data);
		$this->load->view('admin/footer');	
	}

	function status_alasan()
	{
		$id = $this->input->post('id_bpb');
		$data = $this->Mbpb->status_alasan($id);
		echo json_encode($data);
	}

	function tambah() 
	{
		$session = $this->session->userdata('admin');
		$data['admin'] = $this->Mprofil->ambil_admin($session['id_admin']);
		$data['kode_otomatis'] = $this->Mbpb->kode_otomatis();
		$data['po'] = $this->Mproduction_order->tampil_po();

		if ($this->input->post('id_po')) 
		{
			$id_po = $this->input->post('id_po');
		}
		else
		{
			$id_po = "";
		}

		$data['ambil_po'] = $this->Mbpb->ambil_po($id_po);

		$data['ambil_bon'] = $this->Mbpb->ambil_bon($id_po);

		$data['ambil_reject'] = $this->Mbpb->ambil_reject($id_po);
		
		if ($this->input->post('simpan1')) 
		{
			$input = $this->input->post();

			$inputan['no_bpb'] = $input['no_bpb'];
			$inputan['tgl_dibuat'] = $input['tgl_dibuat'];
			$inputan['bagian'] = $input['bagian'];
			$inputan['id_po'] = $input['id_po'];

			$this->Mbpb->tambah_bpb($inputan, $input['id_po']);
			echo "<script>";
			echo "alert('Data berhasil disimpan');";
			echo "location='".base_url("admin/bpb/bpb")."';";
			echo "</script>";

		}
		$this->load->view('admin/header',$data);  
		$this->load->view('admin/navbar',$data);
		$this->load->view('admin/bpb/tambah',$data);
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
		$this->load->view('admin/bpb/detail',$data);
		$this->load->view('admin/footer');
	}

	function hapus($id_bpb)
	{
		$this->Mbpb->hapus_bpb($id_bpb);
		echo "<script>";
		echo "alert('Data berhasil dihapus');";
		echo "location='".base_url("user/bpb/bpb','refresh")."';";
		echo "</script>";
	}

	// ---------------------------- Notif Hasil Validasi BPB Kepala Unit SEwing ----------------------------
	function hitung_hasil_val_bpb_kus()
	{
		$data['validasi'] = $this->Mbpb->hitung_hasil_val_bpb_kus();
		if(count($data['validasi'])<=0)
		{
			echo "";
		}
		else
		{
			echo count($data['validasi']);
		}
	}

	function notif_hasil_data_val_bpb_kus()
	{
		$data['validasi2'] = $this->Mbpb->data_hasil_val_bpb_kus();
		echo json_encode($data['validasi2']);
	}

	function pesan_data_hasil_val_bpb_kus()
	{
		$this->Mbpb->ubah_status_hasil_val_bpb_kus($this->input->post('id_val_bpb'));
	}
	// ---------------------------- Notif Hasil Validasi BPB Kepala Unit Sewing ----------------------------

	// ---------------------------- Notif Hasil Validasi BPB Kepala Gudang ----------------------------
	function hitung_hasil_val_bpb_kg()
	{
		$data['validasi'] = $this->Mbpb->hitung_hasil_val_bpb_kg();
		if(count($data['validasi'])<=0)
		{
			echo "";
		}
		else
		{
			echo count($data['validasi']);
		}
	}

	function notif_hasil_data_val_bpb_kg()
	{
		$data['validasi2'] = $this->Mbpb->data_hasil_val_bpb_kg();
		echo json_encode($data['validasi2']);
	}

	function pesan_data_hasil_val_bpb_kg()
	{
		$this->Mbpb->ubah_status_hasil_val_bpb_kg($this->input->post('id_val_bpb'));
	}
	// ---------------------------- Notif Hasil Validasi BPB Kepala Gudang ----------------------------	

	// ---------------------------- Notif Hasil Validasi BPB Kepala Divisi Production Manager ----------------------------
	function hitung_hasil_val_bpb_kdpm()
	{
		$data['validasi'] = $this->Mbpb->hitung_hasil_val_bpb_kdpm();
		if(count($data['validasi'])<=0)
		{
			echo "";
		}
		else
		{
			echo count($data['validasi']);
		}
	}

	function notif_hasil_data_val_bpb_kdpm()
	{
		$data['validasi2'] = $this->Mbpb->data_hasil_val_bpb_kdpm();
		echo json_encode($data['validasi2']);
	}

	function pesan_data_hasil_val_bpb_kdpm()
	{
		$this->Mbpb->ubah_status_hasil_val_bpb_kdpm($this->input->post('id_val_bpb'));
	}
	// ---------------------------- Notif Hasil Validasi BPB Kepala Divisi Production Manager ----------------------------	

}

?>