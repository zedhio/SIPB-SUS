
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel">
      <div class="pull-left image">
        <?php if (!empty($admin['foto'])): ?>
          <img src="<?php echo base_url("assets/images/foto_admin/".$admin['foto']); ?>" class="img-circle" alt="User Image">
        <?php elseif (empty($admin['foto'])): ?>
          <img src="<?php echo base_url("assets/images/foto_admin/logo-user.png"); ?>" class="profile-user-img img-circle">
        <?php endif ?>
      </div>
      <div class="pull-left info">
        <p><?php echo $admin['nama_admin']; ?></p>
        <!-- Status -->
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>

    <!-- search form (Optional) -->
    <br>
    <!-- /.search form -->

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu" data-widget="tree">
      <!-- Optionally, you can add icons to the links -->
      <li class="active"><a href="<?php echo base_url("admin/home"); ?>"><i class="fa fa-home"></i> <span>Home</span></a></li>
      <li class="treeview">
        <a href="#"><i class="fa fa-th"></i> <span>Data Master</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <!-- <li>
            <a href="#"><i class="fa fa-home"></i><span> Gudang</span></a>
          </li> -->
          <li class="treeview">
            <a href=""><i class="fa fa-tasks"></i><span>  Barang</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?php echo base_url("admin/data_master/barang/data_barang/barang"); ?>"><i class="fa fa-circle-o"></i> Data Barang</a></li>
              <li><a href="<?php echo base_url("admin/data_master/barang/data_jenis/jenis"); ?>"><i class="fa fa-circle-o"></i> Data Jenis Barang</a></li>
              <li><a href="<?php echo base_url("admin/data_master/barang/data_sub_jenis/sub_jenis"); ?>"><i class="fa fa-circle-o"></i> Data Sub Jenis Barang</a></li>
              <!-- <li><a href="<?php //echo base_url("admin/data_master/barang/data_merek/merek"); ?>"><i class="fa fa-circle-o"></i> Data Merek Barang</a></li> -->
              <li><a href="<?php echo base_url("admin/data_master/barang/data_satuan/satuan"); ?>"><i class="fa fa-circle-o"></i> Data Satuan Barang</a></li>
            </ul>
          </li>
          <li><a href="<?php echo base_url("admin/data_master/supplier/supplier"); ?>"><i class="fa fa-truck"></i> Suplier</a></li>
          <li><a href="<?php echo base_url("admin/data_master/buyer/buyer"); ?>"><i class="fa fa-building-o"></i> Buyer</a></li>
          <li><a href="<?php echo base_url("admin/data_master/style_glove/style_glove"); ?>"><i class="fa fa-list-alt"></i> Style Glove</a></li>
          <li class="treeview">
            <a href=""><i class="fa fa-users"></i><span>  Karyawan</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?php echo base_url("admin/data_master/karyawan/data_karyawan/karyawan"); ?>"><i class="fa fa-circle-o"></i> Data Karyawan</a></li>
              <li><a href="<?php echo base_url("admin/data_master/karyawan/data_bagian/bagian"); ?>"><i class="fa fa-circle-o"></i> Data Bagian</a></li>
              <li><a href="<?php echo base_url("admin/data_master/karyawan/data_jabatan/jabatan"); ?>"><i class="fa fa-circle-o"></i> Data Jabatan</a></li>
            </ul>
          </li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="glyphicon glyphicon-transfer"></i>
          <span>Transaksi</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?php echo base_url("admin/rekapitulasi_production_order/rekapitulasi_production_order"); ?>"><i class="fa fa-newspaper-o"></i> Rekap.PO</a></li>
          <li><a href="<?php echo base_url("admin/surat_jalan_masuk/surat_jalan_masuk"); ?>"><i class="fa fa-envelope-o"></i> Surat Jalan Masuk</a></li>
          <li><a href="<?php echo base_url("admin/pemeriksaan_barang/pemeriksaan_barang"); ?>"><i class="fa fa-check-circle-o"></i> Pemeriksaaan Barang (QC)</a></li>
          <!-- <li><a href="<?php //echo base_url("admin/kartu_persediaan_barang/kartu_persediaan_barang"); ?>"><i class="fa fa-book"></i> Kartu Persediaan Barang</a></li> -->
          <li><a href="<?php echo base_url("admin/bon/bon"); ?>"><i class="fa fa-arrow-left"></i> BON Pengeluaran Barang</a></li>
          <li><a href="<?php echo base_url("admin/reject_barang_produksi/reject_barang_produksi"); ?>"><i class="fa fa-arrow-circle-left"></i> Reject Barang Produksi</a></li>
          <li><a href="<?php echo base_url("admin/bpb/bpb"); ?>"><i class="fa fa-random"></i> Bukti Pengeluaran Barang</a></li>
          <li><a href="<?php echo base_url("admin/surat_jalan_keluar/surat_jalan_keluar"); ?>"><i class="fa fa-envelope"></i> Surat Jalan Keluar</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-file-text-o"></i>
          <span>Laporan</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?php echo base_url("admin/laporan/kartu_persediaan_barang"); ?>"><i class="fa fa-file-text-o"></i> Kartu Persediaan Barang</a></li>
          <li><a href="<?php echo base_url("admin/laporan/lpb"); ?>"><i class="fa fa-file-text-o"></i> LPB</a></li>
          <li><a href="<?php echo base_url("admin/laporan/bpb"); ?>"><i class="fa fa-file-text-o"></i> BPB</a></li>
          <li><a href="<?php echo base_url("admin/laporan/surat_jalan_keluar"); ?>"><i class="fa fa-file-text-o"></i> Surat Jalan Keluar</a></li>
          <li><a href="<?php echo base_url("admin/laporan/production_order"); ?>"><i class="fa fa-file-text-o"></i> Production Order</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-wrench"></i>
          <span>Pengaturan</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?php echo base_url("admin/pengaturan/pengaturan_umum/pengaturan_umum"); ?>"><i class="fa fa-cog"></i> Pengaturan Umum</a></li>
          <li class="treeview">
            <a href="#"><i class="fa fa-users"></i> Hak Akses
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?php echo base_url("admin/pengaturan/user/user"); ?>"><i class="fa fa-user"></i> Data User</a></li>
            </ul>
          </li>
        </ul>
      </li>
    </ul>
    <!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->

  <!-- Main content -->
  <section class="content container-fluid">