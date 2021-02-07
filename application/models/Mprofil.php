<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mprofil extends CI_Model {

	// --------------------- Model untuk Admin ---------------------

    function ambil_admin($id_admin) 
    {
      $this->db->where('id_admin', $id_admin);
      $ambil = $this->db->get('admin');
      $data = $ambil->row_array();
      return $data;
  }

  function ubah_admin($data,$id_admin) 
  {

		// mengmabil data admin berdasarkan id_admin
      $admin = $this->ambil_admin($id_admin);


      $config['upload_path']          = './assets/images/foto_admin/';
      $config['allowed_types']        = 'gif|jpg|png';
      $config['max_size']             = 2048;
                /*$config['max_width']            = 1024;
                $config['max_height']           = 768;*/

                $this->load->library('upload', $config);
                $data['password']= sha1($data['password']);
                if ( ! $this->upload->do_upload('foto'))
                {
                    $this->db->where('id_admin',$id_admin);
                    $this->db->update('admin',$data);
                }
                else
                {
                    $data['foto'] = $this->upload->data('file_name');
                    $foto = $admin['foto'];
                    if(file_exists("./assets/images/foto_admin/$foto"))
                    {
                        unlink("./assets/images/foto_admin/$foto");
                    }

                    $this->db->where('id_admin',$id_admin);
                    $this->db->update('admin',$data);
                }
            }

    // --------------------- Akhir model untuk Admin ---------------------

    // --------------------- Model untuk user ---------------------

            function ambil_karyawan($id_karyawan)
            {
                $this->db->where('id_karyawan', $id_karyawan);
                $ambil = $this->db->get('karyawan');
                $data = $ambil->row_array();
                return $data;
            }

            function ambil_user($id_user) 
            {
                $this->db->join('karyawan', 'user.id_karyawan = karyawan.id_karyawan', 'left');
                $this->db->join('jabatan', 'karyawan.id_jabatan = jabatan.id_jabatan', 'left');
                $this->db->join('bagian', 'karyawan.id_bagian = bagian.id_bagian', 'left');
                $this->db->where('id_user', $id_user);
                $ambil = $this->db->get('user');
                $data = $ambil->row_array();
                return $data;
            }

            function ubah_user($input_user, $inputan, $id_user) 
            {
                $user = $this->ambil_user($id_user);
                $karyawan = $this->ambil_karyawan($user['id_karyawan']);

                $config['upload_path']          = './assets/images/foto_karyawan/';
                $config['allowed_types']        = 'gif|jpg|jpeg|png|GIF|JPG|JPEG|PNG';

                $this->load->library('upload', $config);
                if ( ! $this->upload->do_upload('foto_karyawan'))
                {
                    if (! empty($input_user)) {
                        $input_user['password']= sha1($input_user['password']);
                        $this->db->where('id_user', $id_user);
                        $this->db->update('user', $input_user);    
                    }
                    $this->db->where('id_karyawan', $user['id_karyawan']);
                    $this->db->update('karyawan', $inputan);
                }
                else
                {
                    if (! empty($input_user)) {
                        $this->db->where('id_user', $id_user);
                        $this->db->update('user', $input_user);
                    }

                    $inputan['foto_karyawan'] = $this->upload->data('file_name');
                    $foto = $karyawan['foto_karyawan'];

                    if(file_exists("./assets/images/foto_karyawan/$foto"))
                    {
                        unlink("./assets/images/foto_karyawan/$foto");
                    }

                    $this->db->where('id_karyawan',$user['id_karyawan']);
                    $this->db->update('karyawan',$inputan);
                }
            }

        }
        ?>