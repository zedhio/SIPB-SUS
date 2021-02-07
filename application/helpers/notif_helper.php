<?php

function notif_persetujuan_lpb()
{
	$CI =& get_instance(); // memanggil semua fungsi controller
	$CI->db->where('status_pesan', $id_lpb);
	$CI->db->get('validasi_lpb');
	$data = $ambil->row_array();
	return $data;
}

function grafik(){
	$bulan = array(1,2,3,4,5,6,7,8,9,10,11,12);
	$tahun = date("Y");

	$CI =& get_instance(); // memanggil semua fungsi controller

	$data = $CI->db->query("SELECT * FROM kartu_persediaan_barang")->result_array();

		foreach ($bulan as $key => $bln) {
			$hasil[$bln] = $CI->db->query("SELECT SUM(saldo) as stok FROM bukti_kpb WHERE MONTH(tgl_masuk)='$bln' AND YEAR(tgl_masuk)='$tahun'")->row_array();
		}

		return $hasil;
}

?>