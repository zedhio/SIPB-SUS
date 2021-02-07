<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sistem Informasi Persediaan Barang</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="icon" href="<?php echo base_url("assets/images/logo/pt_sus.png"); ?>">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url("assets/bower_components/bootstrap/dist/css/bootstrap.min.css"); ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url("assets/bower_components/font-awesome/css/font-awesome.min.css"); ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url("assets/bower_components/Ionicons/css/ionicons.min.css"); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url("assets/dist/css/AdminLTE.min.css") ?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins. -->
  <link rel="stylesheet" href="<?php echo base_url("assets/dist/css/skins/skin-blue.min.css"); ?>">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?php echo base_url("assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css"); ?>">
  <!-- Datatables -->
  <link rel="stylesheet" href="<?php echo base_url("assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css"); ?>">
  <!-- Google Font -->
  <link rel="stylesheet"
  href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <!-- Select2 Untuk Select Option -->
  <link href="<?php echo base_url("assets/bower_components/select2/dist/css/select2.min.css"); ?>" rel="stylesheet" />
  <style type="text/css">

    .field-icon 
    {
      float: right;
      margin-left: -25px;
      margin-top: -25px;
      position: relative;
      z-index: 2;
    }

  </style>

  <style type="text/css">
    .btn-file {
      position: relative;
      overflow: hidden;
    }
    .btn-file input[type=file] {
      position: absolute;
      top: 0;
      right: 0;
      min-width: 100%;
      min-height: 100%;
      font-size: 100px;
      text-align: right;
      filter: alpha(opacity=0);
      opacity: 0;
      outline: none;
      background: white;
      cursor: inherit;
      display: block;
    }

    #img-upload{
      width: 100%;
    }
  </style>

</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">

      <!-- Logo -->
      <a href="index2.html" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>SI</b>PB</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>SIPB</b>SUS</span>
      </a>

      <!-- Header Navbar -->
      <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="header"></span>
        </a>

        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- Tasks Menu -->
            <li class="dropdown tasks-menu">
              <!-- Menu Toggle Button -->

              <!-- ================ Notifikasi untuk level K.Gudang ================ -->
              <?php if ($_SESSION['user']['level']=="Kepala Gudang"): ?>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-flag-o"></i>

                  <span class="label label-danger" id="notif_val_po_kg"></span>

                  <span class="label label-danger" id="notif_val_bpb_kg"></span>

                  <audio style="display: none;" id="ringtone_kg" preload src="<?php echo base_url("assets/notifikasi/ringtone.mp3"); ?>">

                  </a>
                  <ul class="dropdown-menu">

                    <li class="pesan-val-po-kg">
                      <ul class="menu">
                        <li>
                          <a class="pesan_val_po_kg" style="color: black; cursor: pointer;" title="Klik Untuk menuju ke halaman validasi production order" data-content="Popover body content is set in this attribute.">
                            <div class="form-group">
                              <label> Validasi Production Order</label>
                              <table>
                                <tr>
                                  <td>Nama PO</td>
                                  <td class="text-center" width="80">:</td>
                                  <td><input type="text" id="nama_po1" style="border: 0; background-color: transparent;"></td>
                                </tr>
                                <tr>
                                  <td>No.PO</td>
                                  <td class="text-center" width="80">:</td>
                                  <td><input type="text" id="no_po1" style="border: 0; background-color: transparent;"></td>
                                </tr>
                                <tr>
                                  <td>Asal</td>
                                  <td class="text-center" width="80">:</td>
                                  <td><input type="text" id="asal4" style="border: 0; background-color: transparent;"></td>
                                </tr>
                                <tr>
                                  <td>Perihal</td>
                                  <td class="text-center" width="80">:</td>
                                  <td><input type="text" id="perihal1" style="border: 0; background-color: transparent;"></td>
                                </tr>
                              </table>
                            </div>
                          </a>
                        </li>
                      </ul>
                    </li>

                    <li class="pesan-val-bpb-kg">
                      <ul class="menu">
                        <li>
                          <a class="pesan_val_bpb_kg" style="color: black; cursor: pointer;" title="Klik Untuk menuju ke halaman validasi LPB" data-content="Popover body content is set in this attribute.">
                            <div class="form-group">
                              <label>Diterima Validasi BPB</label>
                              <table>
                                <tr>
                                  <td>No.BPB</td>
                                  <td class="text-center" width="80">:</td>
                                  <td><input type="text" id="nomor_bpb2" style="border: 0; background-color: transparent;"></td>
                                </tr>
                                <tr>
                                  <td>Asal</td>
                                  <td class="text-center" width="80">:</td>
                                  <td><input type="text" id="yang_meminta11" style="border: 0; background-color: transparent;"></td>
                                </tr>
                                <tr>
                                  <td>Perihal</td>
                                  <td class="text-center" width="80">:</td>
                                  <td><input type="text" id="perihal11" style="border: 0; background-color: transparent;"></td>
                                </tr>
                              </table>
                            </div>
                          </a>
                        </li>
                      </ul>
                    </li>

                  </ul>
                </li>
                <!-- ================ Notifikasi untuk level K.Gudang ================ -->

                <!-- ================ Notifikasi untuk level Staff PPIC ================ -->
              <?php elseif ($_SESSION['user']['level']=="Staff PPIC"): ?>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-flag-o"></i>

                  <span class="label label-danger" id="notif_hasil_val_po_kg"></span>

                  <span class="label label-danger" id="notif_hasil_val_po_kdpm"></span>

                  <span class="label label-danger" id="notif_hasil_val_po_direk"></span>

                  <span class="label label-danger" id="barang"></span>

                  <audio style="display: none;" id="ringtone_hasil_staff" preload src="<?php echo base_url("assets/notifikasi/ringtone.mp3"); ?>">

                  </a>
                  <ul class="dropdown-menu">

                    <li class="barang">
                      <ul class="menu">
                        <li>
                          <a class="barang_a" style="color: black; cursor: pointer;" title="Daftar stok barang yang kurang" data-content="Popover body content is set in this attribute.">
                            <table>
                              <tr>
                                <td>Stok barang telah melebihi batas minimal</td>
                              </tr>
                            </table>
                            <table>
                              <tr>
                                <td>atau akan habis. Berikut list:</td>
                              </tr>
                            </table>
                            <ul id="barang_b">

                            </ul>
                          </a>  
                        </li>
                      </ul>
                    </li>

                    <li class="pesan-hasil-val-po-kg">
                      <ul class="menu">
                        <li>
                          <a class="pesan_hasil_val_po_kg" style="color: black; cursor: pointer;" title="Klik Untuk menuju ke halaman production order" data-content="Popover body content is set in this attribute.">
                            <div class="form-group">
                              <label> Hasil Pengajuan PO No.<input type="text" id="no_po4" style="border: 0; background-color: transparent;"></label>
                              <table>
                                <tr>
                                  <td>Dari</td>
                                  <td style="padding-left: 5px;">:</td>
                                  <td><input type="text" id="tujuan2" style="border: 0; background-color: transparent; padding-left: 5px;"></td>
                                </tr>
                                <tr>
                                  <td>Status</td>
                                  <td style="padding-left: 5px;">:</td>
                                  <td><input type="text" id="status1" style="border: 0; background-color: transparent; padding-left: 5px;"></td>
                                </tr>
                                <tr>
                                  <td>Alasan</td>
                                  <td style="padding-left: 5px;">:</td>
                                  <td><input type="text" id="alasan1" style="border: 0; background-color: transparent; padding-left: 5px;"></td>
                                </tr>
                              </table>
                            </div>
                          </a>
                        </li>
                      </ul>
                    </li>

                    <li class="pesan-hasil-val-po-kdpm">
                      <ul class="menu">
                        <li>
                          <a class="pesan_hasil_val_po_kdpm" style="color: black; cursor: pointer;" title="Klik Untuk menuju ke halaman production order" data-content="Popover body content is set in this attribute.">
                            <div class="form-group">
                              <label> Hasil Pengajuan PO No.<input type="text" id="no_po5" style="border: 0; background-color: transparent;"></label>
                              <table>
                                <tr>
                                  <td>Dari</td>
                                  <td style="padding-left: 5px;">:</td>
                                  <td><input type="text" id="tujuan3" style="border: 0; background-color: transparent; padding-left: 5px;"></td>
                                </tr>
                                <tr>
                                  <td>Status</td>
                                  <td style="padding-left: 5px;">:</td>
                                  <td><input type="text" id="status2" style="border: 0; background-color: transparent; padding-left: 5px;"></td>
                                </tr>
                                <tr>
                                  <td>Alasan</td>
                                  <td style="padding-left: 5px;">:</td>
                                  <td><input type="text" id="alasan2" style="border: 0; background-color: transparent; padding-left: 5px;"></td>
                                </tr>
                              </table>
                            </div>
                          </a>
                        </li>
                      </ul>
                    </li>

                    <li class="pesan-hasil-val-po-direk">
                      <ul class="menu">
                        <li>
                          <a class="pesan_hasil_val_po_direk" style="color: black; cursor: pointer;" title="Klik Untuk menuju ke halaman production order" data-content="Popover body content is set in this attribute.">
                            <div class="form-group">
                              <label> Hasil Pengajuan PO No.<input type="text" id="no_po5" style="border: 0; background-color: transparent;"></label>
                              <table>
                                <tr>
                                  <td>Dari</td>
                                  <td style="padding-left: 5px;">:</td>
                                  <td><input type="text" id="tujuan4" style="border: 0; background-color: transparent; padding-left: 5px;"></td>
                                </tr>
                                <tr>
                                  <td>Status</td>
                                  <td style="padding-left: 5px;">:</td>
                                  <td><input type="text" id="status3" style="border: 0; background-color: transparent; padding-left: 5px;"></td>
                                </tr>
                                <tr>
                                  <td>Alasan</td>
                                  <td style="padding-left: 5px;">:</td>
                                  <td><input type="text" id="alasan3" style="border: 0; background-color: transparent; padding-left: 5px;"></td>
                                </tr>
                              </table>
                            </div>
                          </a>
                        </li>
                      </ul>
                    </li>

                  </ul>
                </li>
                <!-- ================ Notifikasi untuk level Staff PPIC ================ -->

                <!-- ================ Notifikasi untuk level K.Divisi Production Manager ================ -->
              <?php elseif ($_SESSION['user']['level']=="Kepala Divisi Production Manager"): ?>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-flag-o"></i>

                  <span class="label label-danger" id="notif_val_po_kdpm"></span>
                  
                  <span class="label label-danger" id="notif_val_bpb_kdpm"></span>

                  <audio style="display: none;" id="ringtone_kdpm" preload src="<?php echo base_url("assets/notifikasi/ringtone.mp3"); ?>">

                  </a>
                  <ul class="dropdown-menu">

                    <li class="pesan-val-po-kdpm">
                      <ul class="menu">
                        <li>
                          <a class="pesan_val_po_kdpm" style="color: black; cursor: pointer;" title="Klik Untuk menuju ke halaman validasi production order" data-content="Popover body content is set in this attribute.">
                            <div class="form-group">
                              <label> Validasi Production Order</label>
                              <table>
                                <tr>
                                  <td>Nama PO</td>
                                  <td class="text-center" width="80">:</td>
                                  <td><input type="text" id="nama_po2" style="border: 0; background-color: transparent;"></td>
                                </tr>
                                <tr>
                                  <td>No.PO</td>
                                  <td class="text-center" width="80">:</td>
                                  <td><input type="text" id="no_po2" style="border: 0; background-color: transparent;"></td>
                                </tr>
                                <tr>
                                  <td>Asal</td>
                                  <td class="text-center" width="80">:</td>
                                  <td><input type="text" id="asal5" style="border: 0; background-color: transparent;"></td>
                                </tr>
                                <tr>
                                  <td>Perihal</td>
                                  <td class="text-center" width="80">:</td>
                                  <td><input type="text" id="perihal2" style="border: 0; background-color: transparent;"></td>
                                </tr>
                              </table>
                            </div>
                          </a>
                        </li>
                      </ul>
                    </li>

                    <li class="pesan-val-bpb-kdpm">
                      <ul class="menu">
                        <li>
                          <a class="pesan_val_bpb_kdpm" style="color: black; cursor: pointer;" title="Klik Untuk menuju ke halaman validasi BPB" data-content="Popover body content is set in this attribute.">
                            <div class="form-group">
                              <label>Diterima Validasi BPB</label>
                              <table>
                                <tr>
                                  <td>No.BPB</td>
                                  <td class="text-center" width="80">:</td>
                                  <td><input type="text" id="nomor_bpb3" style="border: 0; background-color: transparent;"></td>
                                </tr>
                                <tr>
                                  <td>Asal</td>
                                  <td class="text-center" width="80">:</td>
                                  <td><input type="text" id="yang_meminta12" style="border: 0; background-color: transparent;"></td>
                                </tr>
                                <tr>
                                  <td>Perihal</td>
                                  <td class="text-center" width="80">:</td>
                                  <td><input type="text" id="perihal12" style="border: 0; background-color: transparent;"></td>
                                </tr>
                              </table>
                            </div>
                          </a>
                        </li>
                      </ul>
                    </li>

                  </ul>
                </li>
                <!-- ================ Notifikasi untuk level K.Divisi Production Manager ================ -->

                <!-- ================ Notifikasi untuk level Direktur ================ -->
              <?php elseif ($_SESSION['user']['level']=="Direktur"): ?>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-flag-o"></i>

                  <span class="label label-danger" id="notif_dis_lpb_direk"></span>

                  <span class="label label-danger" id="notif_dis_sjk_direk"></span>

                  <span class="label label-danger" id="notif_dis_bpb_direk"></span>

                  <span class="label label-danger" id="notif_val_po_direk"></span>

                  <span class="label label-danger" id="notif_val_sjk_direk"></span>

                  <audio style="display: none;" id="ringtone_direk" preload src="<?php echo base_url("assets/notifikasi/ringtone.mp3"); ?>">

                  </a>
                  <ul class="dropdown-menu">

                    <li class="pesan-dis-lpb-direk">
                      <ul class="menu">
                        <li>
                          <a class="pesan_dis_lpb_direk" style="color: black; cursor: pointer;" title="Klik Untuk menuju ke halaman laporan LPB" data-content="Popover body content is set in this attribute.">
                            <div class="form-group">
                              <label>Diterima Laporan LPB</label>
                              <table>
                                <tr>
                                  <td>No.LPB</td>
                                  <td class="text-center" width="80">:</td>
                                  <td><input type="text" id="nolpb1" style="border: 0; background-color: transparent;"></td>
                                </tr>
                                <tr>
                                  <td>No.Purc.Order</td>
                                  <td class="text-center" width="80">:</td>
                                  <td><input type="text" id="nopurchaseorder1" style="border: 0; background-color: transparent;"></td>
                                </tr>
                                <tr>
                                  <td>Asal</td>
                                  <td class="text-center" width="80">:</td>
                                  <td><input type="text" id="asal2" style="border: 0; background-color: transparent;"></td>
                                </tr>
                              </table>
                            </div>
                          </a>
                        </li>
                      </ul>
                    </li>

                    <li class="pesan-dis-sjk-direk">
                      <ul class="menu">
                        <li>
                          <a class="pesan_dis_sjk_direk" style="color: black; cursor: pointer;" title="Klik Untuk menuju ke halaman laporan Surat Jalan Keluar" data-content="Popover body content is set in this attribute.">
                            <div class="form-group">
                              <label>Diterima Laporan Surat Jalan Keluar</label>
                              <table>
                                <tr>
                                  <td>No.SJK</td>
                                  <td class="text-center" width="80">:</td>
                                  <td><input type="text" id="no_sjk1" style="border: 0; background-color: transparent;"></td>
                                </tr>
                                <tr>
                                  <td>Asal</td>
                                  <td class="text-center" width="80">:</td>
                                  <td><input type="text" id="asal100" style="border: 0; background-color: transparent;"></td>
                                </tr>
                                <tr>
                                  <td>Keterangan</td>
                                  <td class="text-center" width="80">:</td>
                                  <td><input type="text" id="keterangan1" style="border: 0; background-color: transparent;"></td>
                                </tr>
                              </table>
                            </div>
                          </a>
                        </li>
                      </ul>
                    </li>

                    <li class="pesan-val-po-direk">
                      <ul class="menu">
                        <li>
                          <a class="pesan_val_po_direk" style="color: black; cursor: pointer;" title="Klik Untuk menuju ke halaman validasi production order" data-content="Popover body content is set in this attribute.">
                            <div class="form-group">
                              <label> Validasi Production Order</label>
                              <table>
                                <tr>
                                  <td>Nama PO</td>
                                  <td class="text-center" width="80">:</td>
                                  <td><input type="text" id="nama_po3" style="border: 0; background-color: transparent;"></td>
                                </tr>
                                <tr>
                                  <td>No.PO</td>
                                  <td class="text-center" width="80">:</td>
                                  <td><input type="text" id="no_po3" style="border: 0; background-color: transparent;"></td>
                                </tr>
                                <tr>
                                  <td>Asal</td>
                                  <td class="text-center" width="80">:</td>
                                  <td><input type="text" id="asal6" style="border: 0; background-color: transparent;"></td>
                                </tr>
                                <tr>
                                  <td>Perihal</td>
                                  <td class="text-center" width="80">:</td>
                                  <td><input type="text" id="perihal3" style="border: 0; background-color: transparent;"></td>
                                </tr>
                              </table>
                            </div>
                          </a>
                        </li>
                      </ul>
                    </li>

                    <li class="pesan-val-sjk-direk">
                      <ul class="menu">
                        <li>
                          <a class="pesan_val_sjk_direk" style="color: black; cursor: pointer;" title="Klik Untuk menuju ke halaman validasi surat jalan keluar" data-content="Popover body content is set in this attribute.">
                            <div class="form-group">
                              <label> Validasi Surat Jalan Keluar</label>
                              <table>
                                <tr>
                                  <td>No.SJK</td>
                                  <td class="text-center" width="80">:</td>
                                  <td><input type="text" id="nomor_sjk" style="border: 0; background-color: transparent;"></td>
                                </tr>
                                <tr>
                                  <td>Asal</td>
                                  <td class="text-center" width="80">:</td>
                                  <td><input type="text" id="yang_meminta30" style="border: 0; background-color: transparent;"></td>
                                </tr>
                                <tr>
                                  <td>Perihal</td>
                                  <td class="text-center" width="80">:</td>
                                  <td><input type="text" id="perihal30" style="border: 0; background-color: transparent;"></td>
                                </tr>
                              </table>
                            </div>
                          </a>
                        </li>
                      </ul>
                    </li>

                    <li class="pesan-dis-bpb-direk">
                      <ul class="menu">
                        <li>
                          <a class="pesan_dis_bpb_direk" style="color: black; cursor: pointer;" title="Klik Untuk menuju ke halaman laporan BPB" data-content="Popover body content is set in this attribute.">
                            <div class="form-group">
                              <label>Diterima Laporan BPB</label>
                              <table>
                                <tr>
                                  <td>No.BPB </td>
                                  <td class="text-center" width="80">:</td>
                                  <td><input type="text" id="no_bpb102" style="border: 0; background-color: transparent;"></td>
                                </tr>
                                <tr>
                                  <td>No.Prod.Order </td>
                                  <td class="text-center" width="80">:</td>
                                  <td><input type="text" id="no_production_order102" style="border: 0; background-color: transparent;"></td>
                                </tr>
                                <tr>
                                  <td>Asal </td>
                                  <td class="text-center" width="80">:</td>
                                  <td><input type="text" id="asal102" style="border: 0; background-color: transparent;"></td>
                                </tr>
                              </table>
                            </div>
                          </a>
                        </li>
                      </ul>
                    </li>

                  </ul>
                </li>
                <!-- ================ Notifikasi untuk level Direktur ================ -->

                <!-- ================ Notifikasi untuk level K.Divisi Purchase Order ================ -->
              <?php elseif ($_SESSION['user']['level']=="Kepala Divisi Purchase Order"): ?>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-flag-o"></i>

                  <span class="label label-danger" id="notif_val_lpb_kdpo"></span>

                  <span class="label label-danger" id="notif_dis_lpb_kdpo"></span>

                  <span class="label label-danger" id="notif_dis_bpb_kdpo"></span>

                  <audio style="display: none;" id="ringtone_kdpo" preload src="<?php echo base_url("assets/notifikasi/ringtone.mp3"); ?>">
                  </a>
                  <ul class="dropdown-menu">

                    <li class="pesan-val-lpb-kdpo">
                      <ul class="menu">
                        <li>
                          <a class="pesan_val_lpb_kdpo" style="color: black; cursor: pointer;" title="Klik Untuk menuju ke halaman validasi LPB" data-content="Popover body content is set in this attribute.">
                            <div class="form-group">
                              <label>Diterima Validasi LPB No. <input type="text" id="nomor_lpb" style="border: 0; background-color: transparent;"></label>
                              <table>
                                <tr>
                                  <td>Asal</td>
                                  <td class="text-center" width="80">:</td>
                                  <td><input type="text" id="yang_meminta" style="border: 0; background-color: transparent;"></td>
                                </tr>
                                <tr>
                                  <td>Perihal</td>
                                  <td class="text-center" width="80">:</td>
                                  <td><input type="text" id="perihal" style="border: 0; background-color: transparent;"></td>
                                </tr>
                              </table>
                            </div>
                          </a>
                        </li>
                      </ul>
                    </li>

                    <li class="pesan-dis-lpb-kdpo">
                      <ul class="menu">
                        <li>
                          <a class="pesan_dis_lpb_kdpo" style="color: black; cursor: pointer;" title="Klik Untuk menuju ke halaman laporan LPB" data-content="Popover body content is set in this attribute.">
                            <div class="form-group">
                              <label>Diterima Laporan LPB</label>
                              <table>
                                <tr>
                                  <td>No.LPB</td>
                                  <td class="text-center" width="80">:</td>
                                  <td><input type="text" id="no_lpb" style="border: 0; background-color: transparent;"></td>
                                </tr>
                                <tr>
                                  <td>No.Purc.Order</td>
                                  <td class="text-center" width="80">:</td>
                                  <td><input type="text" id="no_purchase_order" style="border: 0; background-color: transparent;"></td>
                                </tr>
                                <tr>
                                  <td>Asal</td>
                                  <td class="text-center" width="80">:</td>
                                  <td><input type="text" id="asal" style="border: 0; background-color: transparent;"></td>
                                </tr>
                              </table>
                            </div>
                          </a>
                        </li>
                      </ul>
                    </li>

                    <li class="pesan-dis-bpb-kdpo">
                      <ul class="menu">
                        <li>
                          <a class="pesan_dis_bpb_kdpo" style="color: black; cursor: pointer;" title="Klik Untuk menuju ke halaman laporan BPB" data-content="Popover body content is set in this attribute.">
                            <div class="form-group">
                              <label>Diterima Laporan BPB</label>
                              <table>
                                <tr>
                                  <td>No.BPB </td>
                                  <td class="text-center" width="80">:</td>
                                  <td><input type="text" id="no_bpb" style="border: 0; background-color: transparent;"></td>
                                </tr>
                                <tr>
                                  <td>No.Prod.Order </td>
                                  <td class="text-center" width="80">:</td>
                                  <td><input type="text" id="no_production_order" style="border: 0; background-color: transparent;"></td>
                                </tr>
                                <tr>
                                  <td>Asal </td>
                                  <td class="text-center" width="80">:</td>
                                  <td><input type="text" id="asal100" style="border: 0; background-color: transparent;"></td>
                                </tr>
                              </table>
                            </div>
                          </a>
                        </li>
                      </ul>
                    </li>

                  </ul>
                </li>
                <!-- ================ Notifikasi untuk level K.Divisi Purchase Order ================ -->

                <!-- ================ Notifikasi untuk level K.Divisi Hutang Dagang ================ -->
              <?php elseif ($_SESSION['user']['level']=="Kepala Divisi Hutang Dagang"): ?>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-flag-o"></i>

                  <span class="label label-danger" id="notif_dis_lpb_kdhd"></span>

                  <audio style="display: none;" id="ringtone_kdhd" preload src="<?php echo base_url("assets/notifikasi/ringtone.mp3"); ?>">

                  </a>
                  <ul class="dropdown-menu">

                    <li class="pesan-dis-lpb-kdhd">
                      <ul class="menu">
                        <li>
                          <a class="pesan_dis_lpb_kdhd" style="color: black; cursor: pointer;" title="Klik Untuk menuju ke halaman laporan LPB" data-content="Popover body content is set in this attribute.">
                            <div class="form-group">
                              <label>Diterima Laporan LPB</label>
                              <table>
                                <tr>
                                  <td>No.LPB</td>
                                  <td class="text-center" width="80">:</td>
                                  <td><input type="text" id="nolpb" style="border: 0; background-color: transparent;"></td>
                                </tr>
                                <tr>
                                  <td>No.Purc.Order</td>
                                  <td class="text-center" width="80">:</td>
                                  <td><input type="text" id="nopurchaseorder" style="border: 0; background-color: transparent;"></td>
                                </tr>
                                <tr>
                                  <td>Asal</td>
                                  <td class="text-center" width="80">:</td>
                                  <td><input type="text" id="asal1" style="border: 0; background-color: transparent;"></td>
                                </tr>
                              </table>
                            </div>
                          </a>
                        </li>
                      </ul>
                    </li>

                  </ul>
                </li>
                <!-- ================ Notifikasi untuk level K.Divisi Hutang Dagang ================ -->

                <!-- ================ Notifikasi untuk level K.Divisi Accounting ================ -->
              <?php elseif ($_SESSION['user']['level']=="Kepala Divisi Accounting"): ?>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-flag-o"></i>

                  <span class="label label-danger" id="notif_dis_lpb_kda"></span>

                  <span class="label label-danger" id="notif_dis_sjk_kda"></span>

                  <span class="label label-danger" id="notif_dis_bpb_kda"></span>

                  <audio style="display: none;" id="ringtone_kda" preload src="<?php echo base_url("assets/notifikasi/ringtone.mp3"); ?>">

                  </a>
                  <ul class="dropdown-menu">

                    <li class="pesan-dis-lpb-kda">
                      <ul class="menu">
                        <li>
                          <a class="pesan_dis_lpb_kda" style="color: black; cursor: pointer;" title="Klik Untuk menuju ke halaman laporan LPB" data-content="Popover body content is set in this attribute.">
                            <div class="form-group">
                              <label>Diterima Laporan LPB</label>
                              <table>
                                <tr>
                                  <td>No.LPB</td>
                                  <td class="text-center" width="80">:</td>
                                  <td><input type="text" id="nolpb2" style="border: 0; background-color: transparent;"></td>
                                </tr>
                                <tr>
                                  <td>No.Purc.Order</td>
                                  <td class="text-center" width="80">:</td>
                                  <td><input type="text" id="nopurchaseorder2" style="border: 0; background-color: transparent;"></td>
                                </tr>
                                <tr>
                                  <td>Asal</td>
                                  <td class="text-center" width="80">:</td>
                                  <td><input type="text" id="asal3" style="border: 0; background-color: transparent;"></td>
                                </tr>
                              </table>
                            </div>
                          </a>
                        </li>
                      </ul>
                    </li>

                    <li class="pesan-dis-sjk-kda">
                      <ul class="menu">
                        <li>
                          <a class="pesan_dis_sjk_kda" style="color: black; cursor: pointer;" title="Klik Untuk menuju ke halaman laporan Surat Jalan Keluar" data-content="Popover body content is set in this attribute.">
                            <div class="form-group">
                              <label>Diterima Laporan Surat Jalan Keluar</label>
                              <table>
                                <tr>
                                  <td>No.SJK</td>
                                  <td class="text-center" width="80">:</td>
                                  <td><input type="text" id="no_sjk2" style="border: 0; background-color: transparent;"></td>
                                </tr>
                                <tr>
                                  <td>Asal</td>
                                  <td class="text-center" width="80">:</td>
                                  <td><input type="text" id="asal101" style="border: 0; background-color: transparent;"></td>
                                </tr>
                                <tr>
                                  <td>Keterangan</td>
                                  <td class="text-center" width="80">:</td>
                                  <td><input type="text" id="keterangan2" style="border: 0; background-color: transparent;"></td>
                                </tr>
                              </table>
                            </div>
                          </a>
                        </li>
                      </ul>
                    </li>

                    <li class="pesan-dis-bpb-kda">
                      <ul class="menu">
                        <li>
                          <a class="pesan_dis_bpb_kda" style="color: black; cursor: pointer;" title="Klik Untuk menuju ke halaman laporan BPB" data-content="Popover body content is set in this attribute.">
                            <div class="form-group">
                              <label>Diterima Laporan BPB</label>
                              <table>
                                <tr>
                                  <td>No.BPB </td>
                                  <td class="text-center" width="80">:</td>
                                  <td><input type="text" id="no_bpb101" style="border: 0; background-color: transparent;"></td>
                                </tr>
                                <tr>
                                  <td>No.Prod.Order </td>
                                  <td class="text-center" width="80">:</td>
                                  <td><input type="text" id="no_production_order101" style="border: 0; background-color: transparent;"></td>
                                </tr>
                                <tr>
                                  <td>Asal </td>
                                  <td class="text-center" width="80">:</td>
                                  <td><input type="text" id="asal101" style="border: 0; background-color: transparent;"></td>
                                </tr>
                              </table>
                            </div>
                          </a>
                        </li>
                      </ul>
                    </li>

                  </ul>
                </li>
                <!-- ================ Notifikasi untuk level K.Divisi Accounting ================ -->

                <!-- ================ Notifikasi untuk level K.Divisi EXIM ================ -->
              <?php elseif ($_SESSION['user']['level']=="Kepala Divisi EXIM"): ?>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-flag-o"></i>
                  
                  <span class="label label-danger" id="notif_dis_sjk_exim"></span>

                  <audio style="display: none;" id="ringtone_exim" preload src="<?php echo base_url("assets/notifikasi/ringtone.mp3"); ?>">
                </a>
                <ul class="dropdown-menu">
                  <li>
                    <!-- Inner menu: contains the tasks -->
                    <ul class="menu">
                      
                      <li class="pesan-dis-sjk-exim">
                      <ul class="menu">
                        <li>
                          <a class="pesan_dis_sjk_exim" style="color: black; cursor: pointer;" title="Klik Untuk menuju ke halaman laporan Surat Jalan Keluar" data-content="Popover body content is set in this attribute.">
                            <div class="form-group">
                              <label>Diterima Laporan Surat Jalan Keluar</label>
                              <table>
                                <tr>
                                  <td>No.SJK</td>
                                  <td class="text-center" width="80">:</td>
                                  <td><input type="text" id="no_sjk5" style="border: 0; background-color: transparent;"></td>
                                </tr>
                                <tr>
                                  <td>Asal</td>
                                  <td class="text-center" width="80">:</td>
                                  <td><input type="text" id="asal102" style="border: 0; background-color: transparent;"></td>
                                </tr>
                                <tr>
                                  <td>Keterangan</td>
                                  <td class="text-center" width="80">:</td>
                                  <td><input type="text" id="keterangan3" style="border: 0; background-color: transparent;"></td>
                                </tr>
                              </table>
                            </div>
                          </a>
                        </li>
                      </ul>
                    </li>

                    </ul>
                  </li>
                </ul>
              </li>
              <!-- ================ Notifikasi untuk level K.Divisi EXIM ================ -->


              <!-- ================ Notifikasi untuk level Staff Unit Sewing ================ -->
            <?php elseif ($_SESSION['user']['level']=="Staff Unit Sewing"): ?>
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-flag-o"></i>

                <span class="label label-danger" id="notif_dis_po_sus"></span>

                <audio style="display: none;" id="ringtone_sus" preload src="<?php echo base_url("assets/notifikasi/ringtone.mp3"); ?>">

                </a>
                <ul class="dropdown-menu">

                  <li class="pesan-dis-po-sus">
                    <ul class="menu">
                      <li>
                        <a class="pesan_dis_po_sus" style="color: black; cursor: pointer;" title="Klik Untuk menuju ke halaman laporan LPB" data-content="Popover body content is set in this attribute.">
                          <div class="form-group">
                            <label>Diterima Laporan Production Order</label>
                            <table>
                              <tr>
                                <td>No.PO</td>
                                <td style="padding-left: 10px;">: <input type="text" id="no_po20" style="border: 0; background-color: transparent;"></td>
                              </tr>
                              <tr>
                                <td>Asal</td>
                                <td style="padding-left: 10px;">: <input type="text" id="asal7" style="border: 0; background-color: transparent;"></td>
                              </tr>
                            </table>
                          </div>
                        </a>
                      </li>
                    </ul>
                  </li>

                </ul>
              </li>
              <!-- ================ Notifikasi untuk level Staff Unit Sewing ================ -->


              <!-- ================ Notifikasi untuk level K.Unit Sewing ================ -->
            <?php else: ?>
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-flag-o"></i>

                  <span class="label label-danger" id="notif_val_bpb_kus"></span>

                  <audio style="display: none;" id="ringtone_val_bpb_kus" preload src="<?php echo base_url("assets/notifikasi/ringtone.mp3"); ?>">
                  </a>
                  <ul class="dropdown-menu">

                    <li class="pesan-val-bpb-kus">
                      <ul class="menu">
                        <li>
                          <a class="pesan_val_bpb_kus" style="color: black; cursor: pointer;" title="Klik Untuk menuju ke halaman validasi LPB" data-content="Popover body content is set in this attribute.">
                            <div class="form-group">
                              <label>Diterima Validasi BPB</label>
                              <table>
                                <tr>
                                  <td>No.BPB</td>
                                  <td class="text-center" width="80">:</td>
                                  <td><input type="text" id="nomor_bpb1" style="border: 0; background-color: transparent;"></td>
                                </tr>
                                <tr>
                                  <td>Asal</td>
                                  <td class="text-center" width="80">:</td>
                                  <td><input type="text" id="yang_meminta10" style="border: 0; background-color: transparent;"></td>
                                </tr>
                                <tr>
                                  <td>Perihal</td>
                                  <td class="text-center" width="80">:</td>
                                  <td><input type="text" id="perihal10" style="border: 0; background-color: transparent;"></td>
                                </tr>
                              </table>
                            </div>
                          </a>
                        </li>
                      </ul>
                    </li>

                  </ul>
                </li>
              <!-- ================ Notifikasi untuk level K.Unit Sewing ================ -->


            <?php endif ?>

            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                <img src="<?php echo base_url("assets/images/foto_karyawan/".$user['foto_karyawan']); ?>" class="user-image" alt="User Image">
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs"></span>
              </a>
              <ul class="dropdown-menu">
                <!-- The user image in the menu -->
                <li class="user-header">
                  <?php if (!empty($user['foto_karyawan'])): ?>
                    <img src="<?php echo base_url("assets/images/foto_karyawan/".$user['foto_karyawan']); ?>" class="img-circle" alt="User Image">
                  <?php elseif (empty($user['foto_karyawan'])): ?>
                    <img src="<?php echo base_url("assets/images/foto_karyawan/logo-user.png"); ?>" class="profile-user-img img-circle">
                  <?php endif ?>

                  <p>
                    <small><?php echo $user['nama_karyawan']; ?></small>
                    <small><?php echo $user['jabatan']; ?></small>
                  </p>
                </li>
                <!-- Menu Body -->

                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="<?php echo base_url("user/profil"); ?>" class="btn btn-default btn-flat">Profil</a>
                  </div>
                  <div class="pull-right">
                    <a href="<?php echo base_url("login/logout"); ?>" class="btn btn-default btn-flat">Sign out</a>
                  </div>
                </li>
              </ul>
            </li>
            <!-- Control Sidebar Toggle Button -->
          </ul>
        </div>
      </nav>
    </header>