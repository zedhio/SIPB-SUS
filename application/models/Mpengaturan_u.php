<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mpengaturan_u extends CI_Model 
{

    // fungsi ambil pengaturan  umum
	function ambil_pengaturan($id_pengaturan) 
	{
		$this->db->where('id_pengaturan_umum', $id_pengaturan);
		$ambil=$this->db->get('pengaturan_umum');
		$data=$ambil->row_array();
		return $data;
	}


    // fungsi ubah pengaturan  umum
	function ubah_pengaturan($data,$id_pengaturan) 
	{
		
		// mengmabil data admin berdasarkan id_admin
		$pengaturan = $this->ambil_pengaturan($id_pengaturan);


		$config['upload_path']          = './assets/images/logo/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 2048;
                /*$config['max_width']            = 1024;
                $config['max_height']           = 768;*/

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('logo'))
        {
            $this->db->where('id_pengaturan_umum',$id_pengaturan);
            $this->db->update('pengaturan_umum',$data);
        }
        else
        {
            $data['logo']=$this->upload->data('file_name');
            $logo = $pengaturan['logo'];
            if(file_exists("./assets/images/logo/$logo"))
            {
               	unlink("./assets/images/logo/$logo");
            }

            $this->db->where('id_pengaturan_umum',$id_pengaturan);
            $this->db->update('pengaturan_umum',$data);
        }
    }

    // fungsi menampilkan user
    function tampil_user() 
    {
        $this->db->order_by('nik', 'desc');
        $this->db->join('karyawan', 'user.id_karyawan = karyawan.id_karyawan', 'left');
        $ambil = $this->db->get('user');
        $data = $ambil->result_array(); // menampilkan data banyak
        return $data;
    }

    // fungsi ambil user
    function ambil_user($id_user) 
    {
        $this->db->join('karyawan', 'user.id_karyawan = karyawan.id_karyawan', 'left');
        $this->db->where('id_user', $id_user);
        $ambil = $this->db->get('user');
        $data = $ambil->row_array();
        return $data;
    }

    // fungsi tambah user
    function tambah_user($data) 
    {
        $data['password']= sha1($data['password']);
        $this->db->insert('user', $data);
    }

    // fungsi ubah user  
    function ubah_user($ubah,$id_user) 
    {
        $ubah['password']= sha1($ubah['password']);
        $this->db->where('id_user', $id_user);
        $this->db->update('user', $ubah);
    }

    // fungsi hapus user
    function hapus_user($id_user) 
    {
        $this->db->where('id_user', $id_user);
        $this->db->delete('user');
    }

}
?>