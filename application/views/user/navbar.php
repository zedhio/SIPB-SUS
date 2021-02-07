<aside class="main-sidebar">

  <section class="sidebar">

    <div class="user-panel">
      <div class="pull-left image">
        <?php if (!empty($user['foto_karyawan'])): ?>
          <img src="<?php echo base_url("assets/images/foto_karyawan/".$user['foto_karyawan']); ?>" class="img-circle" alt="User Image">
        <?php elseif (empty($user['foto_karyawan'])): ?>
          <img src="<?php echo base_url("assets/images/foto_karyawan/logo-user.png"); ?>" class="profile-user-img img-circle">
        <?php endif ?> 
      </div>
      <div class="pull-left info">
        <p><?php echo $user['nama_karyawan']; ?></p>
        <!-- Status -->
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>

    <br>

    <ul class="sidebar-menu" data-widget="tree">

      <li class="active"><a href="<?php echo base_url("user/home"); ?>"><i class="fa fa-home"></i> <span>Home</span></a></li>

      <!-- ========================== Menu Level K.Gudang ========================== -->
      <?php if($_SESSION['user']['level']=="Kepala Gudang"): ?>
        <li class="treeview">
          <a href="#">
            <i class="glyphicon glyphicon-transfer"></i>
            <span>Transaksi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url("user/rekapitulasi_production_order/rekapitulasi_production_order"); ?>"><i class="fa fa-newspaper-o"></i> Rekap.PO</a></li>
            <li><a href="<?php echo base_url("user/surat_jalan_masuk/surat_jalan_masuk"); ?>"><i class="fa fa-envelope-o"></i> Surat Jalan Masuk</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#"><i class="fa fa-check"></i> <span>Validasi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url("user/validasi/production_order"); ?>"><i class="fa fa-check-circle-o"></i> Production Order</a></li>
            <!-- <li><a href="<?php //echo base_url("user/validasi/bon"); ?>"><i class="fa fa-check-circle-o"></i> BON</a></li> -->
            <li><a href="<?php echo base_url("user/validasi/bpb"); ?>"><i class="fa fa-check-circle-o"></i> BPB</a></li>
          </ul>
        </li>
        <!-- ========================== Menu Level K.Gudang ========================== -->

        <!-- ========================== Menu Level Staff PPIC ========================== -->
      <?php elseif ($_SESSION['user']['level']=="Staff PPIC"): ?>
        <li class="treeview">
          <a href="#"><i class="fa fa-th"></i> <span>Data Master</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url("user/data_master/style_glove/style_glove"); ?>"><i class="fa fa-list-alt"></i> Style Glove</a></li>
            <li><a href="<?php echo base_url("user/data_master/buyer/buyer"); ?>"><i class="fa fa-building-o"></i> Buyer</a></li>
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
            <!-- <li><a href="<?php //echo base_url("user/rekapitulasi_production_order/rekapitulasi_production_order"); ?>"><i class="fa fa-file-text-o"></i> Rekapitulasi Production Order</a></li> -->
            <li><a href="<?php echo base_url("user/production_order/production_order"); ?>"><i class="fa fa-sticky-note-o"></i> Production Order</a></li>
            <!-- <li><a href="<?php //echo base_url("user/kartu_persediaan_barang/kartu_persediaan_barang"); ?>"><i class="fa fa-book"></i> Kartu Persediaan Barang</a></li> -->
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
          <li><a href="<?php echo base_url("user/laporan/kartu_persediaan_barang"); ?>"><i class="fa fa-file-text-o"></i> Kartu Persediaan Barang</a></li>
          </ul>
        </li>
        <!-- ========================== Menu Level Staff PPIC ========================== -->

        <!-- ========================== Menu Level K.Divisi Production Manager ========================== -->
      <?php elseif($_SESSION['user']['level']=="Kepala Divisi Production Manager"): ?>
        <li><a href="<?php echo base_url("user/rekapitulasi_production_order/rekapitulasi_production_order"); ?>"><i class="fa fa-newspaper-o"></i> Rekap.PO</a></li>
        <li class="treeview">
          <a href="#"><i class="fa fa-check"></i> <span>Validasi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url("user/validasi/production_order"); ?>"><i class="fa fa-check-circle-o"></i> Production Order</a></li>
            <!-- <li><a href="<?php //echo base_url("user/validasi/bon"); ?>"><i class="fa fa-check-circle-o"></i> BON</a></li> -->
            <li><a href="<?php echo base_url("user/validasi/bpb"); ?>"><i class="fa fa-check-circle-o"></i> BPB</a></li>
          </ul>
        </li>
        <!-- ========================== Menu Level K.Divisi Production Manager ========================== -->

        <!-- ========================== Menu Level Direktur ========================== -->
      <?php elseif($_SESSION['user']['level']=="Direktur"): ?>
        <li><a href="<?php echo base_url("user/rekapitulasi_production_order/rekapitulasi_production_order"); ?>"><i class="fa fa-newspaper-o"></i> Rekap.PO</a></li>
        <li class="treeview">
          <a href="#"><i class="fa fa-check"></i> <span>Validasi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url("user/validasi/production_order"); ?>"><i class="fa fa-clone"></i> Production Order</a></li>
            <li><a href="<?php echo base_url("user/validasi/surat_jalan_keluar"); ?>"><i class="fa fa-envelope-o"></i> Surat Jalan Keluar</a></li>
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
            <li><a href="<?php echo base_url("user/laporan/lpb"); ?>"><i class="fa fa-file-text-o"></i> LPB</a></li>
            <li><a href="<?php echo base_url("user/laporan/bpb"); ?>"><i class="fa fa-file-text-o"></i> Bukti Pengeluaran Barang</a>
              <li><a href="<?php echo base_url("user/laporan/surat_jalan_keluar"); ?>"><i class="fa fa-file-text-o"></i> Surat Jalan Keluar</a>
              </ul>
            </li>
            <!-- ========================== Menu Level Direktur ========================== -->

            <!-- ========================== Menu Level K.Divisi Purchase Order ========================== -->        
          <?php elseif($_SESSION['user']['level']=="Kepala Divisi Purchase Order"): ?>
            <li><a href="<?php echo base_url("user/rekapitulasi_production_order/rekapitulasi_production_order"); ?>"><i class="fa fa-newspaper-o"></i> Rekap.PO</a></li>
            <li class="treeview">
              <a href="#"><i class="fa fa-check"></i> <span>Validasi</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url("user/validasi/lpb"); ?>"><i class="fa fa-list-ol"></i> LPB</a></li>
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
                <li><a href="<?php echo base_url("user/laporan/lpb"); ?>"><i class="fa fa-file-text-o"></i> Laporan LPB</a></li>
                <li><a href="<?php echo base_url("user/laporan/bpb"); ?>"><i class="fa fa-file-text-o"></i> Laporan BPB</a></li>
              </ul>
            </li>
            <!-- ========================== Menu Level K.Divisi Purchase Order ========================== -->

            <!-- ========================== Menu Level Hutang Dagang ========================== -->
          <?php elseif($_SESSION['user']['level']=="Kepala Divisi Hutang Dagang"): ?>
            <li><a href="<?php echo base_url("user/rekapitulasi_production_order/rekapitulasi_production_order"); ?>"><i class="fa fa-newspaper-o"></i> Rekap.PO</a></li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-file-text-o"></i>
                <span>Laporan</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url("user/laporan/lpb"); ?>"><i class="fa fa-file-text-o"></i> LPB</a></li>
              </ul>
            </li>
            <!-- ========================== Menu Level K.Divisi Hutang Dagang ========================== -->

            <!-- ========================== Menu Level K.Divisi Accounting ========================== -->
          <?php elseif($_SESSION['user']['level']=="Kepala Divisi Accounting"): ?>
            <li><a href="<?php echo base_url("user/rekapitulasi_production_order/rekapitulasi_production_order"); ?>"><i class="fa fa-newspaper-o"></i> Rekap.PO</a></li>
            <li><a href="<?php echo base_url("user/surat_jalan_masuk/surat_jalan_masuk"); ?>"><i class="fa fa-envelope-o"></i> Surat Jalan Masuk</a></li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-file-text-o"></i>
                <span>Laporan</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url("user/laporan/lpb"); ?>"><i class="fa fa-file-text-o"></i> LPB</a></li>
                <li><a href="<?php echo base_url("user/laporan/bpb"); ?>"><i class="fa fa-file-text-o"></i> BPB</a></li>
                <li><a href="<?php echo base_url("user/laporan/surat_jalan_keluar"); ?>"><i class="fa fa-file-text-o"></i> Surat Jalan Keluar</a></li>
              </ul>
            </li>
            <!-- ========================== Menu Level K.Divisi Accounting ========================== -->

            <!-- ========================== Menu Level K.Divisi EXIM ========================== -->
          <?php elseif($_SESSION['user']['level']=="Kepala Divisi EXIM"): ?>
            <li><a href="<?php echo base_url("user/rekapitulasi_production_order/rekapitulasi_production_order"); ?>"><i class="fa fa-newspaper-o"></i> Rekap.PO</a></li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-file-text-o"></i>
                <span>Laporan</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url("user/laporan/surat_jalan_keluar"); ?>"><i class="fa fa-file-text-o"></i> Laporan Surat Jalan Keluar</a></li>
              </ul>
            </li>
            <!-- ========================== Menu Level K.Divisi EXIM ========================== -->

            <!-- ========================== Menu Level Staff Unit Sewing ========================== -->
          <?php elseif($_SESSION['user']['level']=="Staff Unit Sewing"): ?>
           <li><a href="<?php echo base_url("user/rekapitulasi_production_order/rekapitulasi_production_order"); ?>"><i class="fa fa-newspaper-o"></i> Rekap.PO</a></li>
           <li class="treeview">
            <a href="#">
              <i class="glyphicon glyphicon-transfer"></i>
              <span>Transaksi</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
             <li><a href="<?php echo base_url("user/bon/bon"); ?>"><i class="fa fa-arrow-left"></i> BON Pengeluaran Barang</a></li>
             <li><a href="<?php echo base_url("user/reject_barang_produksi/reject_barang_produksi"); ?>"><i class="fa fa-arrow-circle-left"></i> Reject Barang Produksi</a></li>
           </ul>
         </li>
         <li class="treeview">
          <a href="#">
            <i class="fa fa-file-text"></i>
            <span>Laporan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
           <li><a href="<?php echo base_url("user/laporan/production_order"); ?>"><i class="fa fa-file-text-o"></i> Production Order</a></li>
         </ul>
       </li>
       <!-- ========================== Menu Level Staff Unit Sewing ========================== -->

       <!-- ========================== Menu Level K.Unit Sewing ========================== -->
     <?php else: ?>
      <li><a href="<?php echo base_url("user/rekapitulasi_production_order/rekapitulasi_production_order"); ?>"><i class="fa fa-newspaper-o"></i> Rekap.PO</a></li>
      <li class="treeview">
        <a href="#"><i class="fa fa-check"></i> <span>Validasi</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?php echo base_url("user/validasi/bpb"); ?>"><i class="fa fa-list-ol"></i> BPB</a></li>
        </ul>
      </li>
      <!-- ========================== Menu Level K.Unit Sewing ========================== -->

    <?php endif ?>
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