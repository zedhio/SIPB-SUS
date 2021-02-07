<style type="text/css">
  .body-blue {
    border: 1px solid #3c8dbc;
  }
</style>

<section class="content">

  <h5>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url("admin/home"); ?>"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Transaksi</li>
      <li class="active"><a href="<?php echo base_url("admin/surat_jalan_masuk/surat_jalan_masuk"); ?>" style="color: #777;">Surat Jalan Masuk</a></li>
    </ol>
  </h5>

  <div class="row">
    <div class="col-xs-12">
      <div class="panel panel-heading">
        <div class="box-header">
          <h3 class="box-title fa fa-envelope-o"> Surat Jalan Masuk</h3>
          <hr>

          <!-- Bagian pencarian data penerimaan barang -->
          <form role="form" method="POST" >
            <table>
              <thead>
                <tr>
                  <th>Tanggal Awal</th>
                  <th style="padding-left: 10px;">
                    <div class="input-group">
                      <input type="text" id="datepicker" class="form-control" name="tgl_awal" placeholder="2018-10-22" size="6">
                    </div>
                  </th>
                  <th style="padding-left: 10px;">Tanggal Akhir</th>
                  <th style="padding-left: 10px;">
                    <div class="input-group">
                      <input type="text" id="datepicker1" class="form-control" name="tgl_akhir" placeholder="2018-10-22" size="6">
                    </div>
                  </th>
                  <th style="padding-left: 10px;">
                    <button class="btn btn-primary fa fa-search" name="cari" value="cari" title="Cari" data-content="Popover body content is set in this attribute."> Cari</button>
                  </th>
                </tr>
              </thead>
            </table>
          </form>
          <!-- Bagian pencarian data penerimaan barang -->

        </div>
        <div class="box-body">

          <!-- Bagian tampilan data penerimaan barang -->
          <table class="table table-bordered table-striped" id="example1"> 
            <thead style="background-color: #D3D3D3">
              <tr>
                <th class="text-center">No</th>
                <th class="text-center">No.Surat Jalan Masuk</th>
                <th class="text-center">Tanggal Surat</th>
                <th class="text-center">Supplier</th>
                <th class="text-center">Keterangan</th>
                <th class="text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($sjm as $key => $value): ?>
                <?php if(!empty($value['konfirmasi'])): ?>
                <tr>
                  <td class="text-center"><?php echo $key+1; ?></td>
                  <td class="text-center">
                  <?php if (!empty($value['no_sjm'])): ?>
                    <?php echo $value['no_sjm']; ?>
                  <?php elseif (empty($value['no_sjm'])): ?>
                    <?php echo "-"; ?>
                  <?php endif ?>
                  </td>
                  <td class="text-center"><?php echo $value['tgl_masuk']; ?></td>
                  <td class="text-center"><?php echo $value['nama_supplier']; ?></td>
                  <td class="text-center"><?php echo strip_tags($value['keterangan']); ?></td>
                  <td class="text-center">
                    <!-- Detail -->
                    <a href="<?php echo base_url("admin/surat_jalan_masuk/surat_jalan_masuk/detail/$value[id_sjm]"); ?>" class="btn btn-info btn-sm fa fa-info" title="Detail" data-content="Popover body content is set in this attribute." ></a>
                    <!-- Detail -->

                    <!-- Buat Laporan Penerimaan Barang dengan modal -->
                    <?php if ($value['laporan']=="kosong"): ?>
                      <a href="#" class="buat-lpb btn btn-warning btn-sm fa fa-file-text-o" title="Buat Laporan Penerimaan Barang" data-content="Popover body content is set in this attribute." data-id="<?php echo $value['id_sjm']; ?>" data-kode="<?php echo $value['no_sjm']; ?>"></a>
                    <?php endif ?>
                    <!-- Buat Laporan Penerimaan Barang dengan modal -->

                  </td>
                </tr>
                <?php endif ?>
              <?php endforeach ?>
            </tbody>
          </table>
          <!-- Bagian tampilan data penerimaan barang -->

        </div>
      </div>
    </div>
  </div>
</section>

<!-- ================= Modal buat laporan penerimaan barang ================= -->
<div id="buat_lpb" class="modal fade" role="dialog">
  <div class="modal-dialog body-blue">

    <!-- Modal content-->
    <form method="POST">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title fa fa-cube"> <label>Buat Laporan Penerimaan Barang (LPB)</label></h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>No.Laporan Penerimaan Barang</label>
            <input type="text" class="form-control" name="no_lpb" value="<?php echo $kode_otomatis; ?>" readonly="readonly">
          </div>
          <div class="form-group">
            <label>Tanggal Dibuat</label>
            <input type="text" class="form-control" name="tgl_dibuat" readonly="readonly" value="<?php echo date('d-m-Y'); ?>">
          </div>
          <div class="form-group">
            <label>No.Surat Jalan Masuk</label>
            <input type="text" class="form-control" name="no_sjm" readonly="readonly">
          </div>
          <input type="text" class="form-control hidden" name="id_sjm">
          <div class="modal-footer">
            <button class="btn btn-primary fa fa-save" name="save" value="save" title="Simpan Data" data-content="Popover body content is set in this attribute."> Simpan Data</button>
          </div>
        </div>
      </form>

    </div>
  </div>
  <!-- ================= Modal buat laporan penerimaan barang ================= -->