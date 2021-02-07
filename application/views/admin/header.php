<!-- set waktu zona asia dengan ibukota jakarta -->
<?php date_default_timezone_set('Asia/Jakarta'); ?>

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

              <?php if ($_SESSION['admin']['jabatan']=="Administrasi Gudang"): ?>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-flag-o"></i>

                  <span class="label label-danger" id="notif_hasil_val_bpb_kus"></span>

                  <span class="label label-danger" id="notif_hasil_val_bpb_kg"></span>

                  <span class="label label-danger" id="notif_hasil_val_bpb_kdpm"></span>

                  <span class="label label-danger" id="notif_hasil_val_sjk_direk"></span>

                  <span class="label label-danger" id="notif_hasil_val_lpb_kdpo"></span>

                  <span class="label label-danger" id="barang"></span>

                  <audio style="display: none;" id="ringtone_admin" preload src="<?php echo base_url("assets/notifikasi/ringtone.mp3"); ?>">

                  </a>
                  <ul class="dropdown-menu">

                    <li class="barang">
                      <ul class="menu">
                        <li>
                          <a class="barang_a" style="color: black; cursor: pointer;" title="Klik Untuk menuju ke halaman barang" data-content="Popover body content is set in this attribute.">
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

                    <li class="pesan-hasil-val-bpb-kus">
                      <ul class="menu">
                        <li>
                          <a class="pesan_hasil_val_bpb_kus" style="color: black; cursor: pointer;">
                            <div class="form-group">
                              <label> Hasil Pengajuan BPB No.<input type="text" id="no_bpb103" style="border: 0; background-color: transparent;"></label>
                              <table>
                                <tr>
                                  <td>Dari</td>
                                  <td style="padding-left: 5px;">:</td>
                                  <td><input type="text" id="tujuan103" style="border: 0; background-color: transparent; padding-left: 5px;"></td>
                                </tr>
                                <tr>
                                  <td>Status</td>
                                  <td style="padding-left: 5px;">:</td>
                                  <td><input type="text" id="status103" style="border: 0; background-color: transparent; padding-left: 5px;"></td>
                                </tr>
                                <tr>
                                  <td>Alasan</td>
                                  <td style="padding-left: 5px;">:</td>
                                  <td><input type="text" id="alasan103" style="border: 0; background-color: transparent; padding-left: 5px;"></td>
                                </tr>
                              </table>
                            </div>
                          </a>
                        </li>
                      </ul>
                    </li>

                    <li class="pesan-hasil-val-bpb-kg">
                      <ul class="menu">
                        <li>
                          <a class="pesan_hasil_val_bpb_kg" style="color: black; cursor: pointer;">
                            <div class="form-group">
                              <label> Hasil Pengajuan BPB No.<input type="text" id="no_bpb104" style="border: 0; background-color: transparent;"></label>
                              <table>
                                <tr>
                                  <td>Dari</td>
                                  <td style="padding-left: 5px;">:</td>
                                  <td><input type="text" id="tujuan104" style="border: 0; background-color: transparent; padding-left: 5px;"></td>
                                </tr>
                                <tr>
                                  <td>Status</td>
                                  <td style="padding-left: 5px;">:</td>
                                  <td><input type="text" id="status104" style="border: 0; background-color: transparent; padding-left: 5px;"></td>
                                </tr>
                                <tr>
                                  <td>Alasan</td>
                                  <td style="padding-left: 5px;">:</td>
                                  <td><input type="text" id="alasan104" style="border: 0; background-color: transparent; padding-left: 5px;"></td>
                                </tr>
                              </table>
                            </div>
                          </a>
                        </li>
                      </ul>
                    </li>

                    <li class="pesan-hasil-val-bpb-kdpm">
                      <ul class="menu">
                        <li>
                          <a class="pesan_hasil_val_bpb_kdpm" style="color: black; cursor: pointer;">
                            <div class="form-group">
                              <label> Hasil Pengajuan BPB No.<input type="text" id="no_bpb105" style="border: 0; background-color: transparent;"></label>
                              <table>
                                <tr>
                                  <td>Dari</td>
                                  <td style="padding-left: 5px;">:</td>
                                  <td><input type="text" id="tujuan105" style="border: 0; background-color: transparent; padding-left: 5px;"></td>
                                </tr>
                                <tr>
                                  <td>Status</td>
                                  <td style="padding-left: 5px;">:</td>
                                  <td><input type="text" id="status105" style="border: 0; background-color: transparent; padding-left: 5px;"></td>
                                </tr>
                                <tr>
                                  <td>Alasan</td>
                                  <td style="padding-left: 5px;">:</td>
                                  <td><input type="text" id="alasan105" style="border: 0; background-color: transparent; padding-left: 5px;"></td>
                                </tr>
                              </table>
                            </div>
                          </a>
                        </li>
                      </ul>
                    </li>

                    <li class="pesan-hasil-val-sjk-direk">
                      <ul class="menu">
                        <li>
                          <a class="pesan_hasil_val_sjk_direk" style="color: black; cursor: pointer;">
                            <div class="form-group">
                              <label> Hasil Pengajuan SJK No.<input type="text" id="no_sjk100" style="border: 0; background-color: transparent;"></label>
                              <table>
                                <tr>
                                  <td>Dari</td>
                                  <td style="padding-left: 5px;">:</td>
                                  <td><input type="text" id="tujuan106" style="border: 0; background-color: transparent; padding-left: 5px;"></td>
                                </tr>
                                <tr>
                                  <td>Status</td>
                                  <td style="padding-left: 5px;">:</td>
                                  <td><input type="text" id="status106" style="border: 0; background-color: transparent; padding-left: 5px;"></td>
                                </tr>
                                <tr>
                                  <td>Alasan</td>
                                  <td style="padding-left: 5px;">:</td>
                                  <td><input type="text" id="alasan106" style="border: 0; background-color: transparent; padding-left: 5px;"></td>
                                </tr>
                              </table>
                            </div>
                          </a>
                        </li>
                      </ul>
                    </li>

                    <li class="pesan-hasil-val-lpb-kdpo">
                      <ul class="menu">
                        <li>
                          <a class="pesan_hasil_val_lpb_kdpo" style="color: black; cursor: pointer;">
                            <div class="form-group">
                              <label> Hasil Pengajuan LPB No.<input type="text" id="no_lpb100" style="border: 0; background-color: transparent;"></label>
                              <table>
                                <tr>
                                  <td>Dari</td>
                                  <td style="padding-left: 5px;">:</td>
                                  <td><input type="text" id="tujuan107" style="border: 0; background-color: transparent; padding-left: 5px;"></td>
                                </tr>
                                <tr>
                                  <td>Status</td>
                                  <td style="padding-left: 5px;">:</td>
                                  <td><input type="text" id="status107" style="border: 0; background-color: transparent; padding-left: 5px;"></td>
                                </tr>
                                <tr>
                                  <td>Alasan</td>
                                  <td style="padding-left: 5px;">:</td>
                                  <td><input type="text" id="alasan107" style="border: 0; background-color: transparent; padding-left: 5px;"></td>
                                </tr>
                              </table>
                            </div>
                          </a>
                        </li>
                      </ul>
                    </li>

                  </ul>
                </li>

              </li>
              
            <?php endif ?>

            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                <img src="<?php echo base_url("assets/images/foto_admin/".$admin['foto']); ?>" class="user-image" alt="User Image">
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs"></span>
              </a>
              <ul class="dropdown-menu">
                <!-- The user image in the menu -->
                <li class="user-header">
                  <?php if (!empty($admin['foto'])): ?>
                    <img src="<?php echo base_url("assets/images/foto_admin/".$admin['foto']); ?>" class="img-circle" alt="User Image">
                  <?php elseif (empty($admin['foto'])): ?>
                    <img src="<?php echo base_url("assets/images/foto_admin/logo-user.png"); ?>" class="profile-user-img img-circle">
                  <?php endif ?>
                  <p>
                    <small><?php echo $admin['nama_admin']; ?></small>
                    <small>Sebagai <?php echo $admin['jabatan']; ?></small>
                  </p>
                </li>
                <!-- Menu Body -->

                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="<?php echo base_url("admin/profil"); ?>" class="btn btn-default btn-flat">Profil</a>
                  </div>
                  <div class="pull-right">
                    <a href="<?php echo base_url("admin/login"); ?>" class="btn btn-default btn-flat">Sign out</a>
                  </div>
                </li>
              </ul>
            </li>
            <!-- Control Sidebar Toggle Button -->
          </ul>
        </div>
      </nav>
    </header>