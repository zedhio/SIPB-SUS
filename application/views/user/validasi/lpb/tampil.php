<style type="text/css">
  .body-blue {
    border: 1px solid #3c8dbc;
  }
</style>

<section class="content">

  <h5>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url("user/home"); ?>"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Validasi</li>
      <li class="active"><a href="<?php echo base_url("user/validasi/lpb"); ?>" style="color: #777;">Laporan Penerimaan Barang</a></li>
    </ol>
  </h5>

  <div class="row">
    <div class="col-xs-12">
      <div class="panel panel-heading">
        <div class="box-header">
          <h3 class="box-title fa fa-check"> Validasi Laporan Penerimaan Barang</h3>
          <hr>

          <form role="form" method="POST" >
            <table>
              <thead>
                <tr>
                  <th>Tanggal Diajukan</th>
                  <th style="padding-left: 10px;">
                    <div class="input-group">
                      <input type="text" id="datepicker" class="form-control" name="tgl_awal" placeholder="2018-10-22" size="6">
                    </div>
                  </th>
                  <th style="padding-left: 10px;">Tanggal Dikonfirmasi</th>
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

          <div class="box-body" style="padding-top: 20px;">
            <table class="table table-bordered table-striped" id="example1"> 
              <thead style="background-color: #D3D3D3">
                <tr>
                  <th class="text-center">No</th>
                  <th class="text-center">No.LPB</th>
                  <th class="text-center">No.Purchase Order</th>
                  <th class="text-center">Tanggal Diajukan</th>
                  <th class="text-center">Asal</th>
                  <th class="text-center">Perihal</th>
                  <th class="text-center">Tanggal Dikonfirmasi</th>
                  <th class="text-center">Status</th>
                  <th class="text-center">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($validasi as $key => $value): ?>
                  <?php if (!empty($value['yang_meminta'])): ?>
                    <tr>
                      <td class="text-center"><?php echo $key+1; ?></td>
                      <td class="text-center"><?php echo $value['no_lpb']; ?></td>
                      <td class="text-center">
                        <?php if(!empty($value['no_purchase_order'])): ?>
                          <?php echo $value['no_purchase_order']; ?>
                        <?php elseif(empty($value['no_purchase_order'])): ?>
                          <a class="btn-default btn-sm" readonly><i class="fa fa-warning"></i> Mohon Diisi</a>
                        <?php endif ?>
                      </td>
                      <td class="text-center"><?php echo $value['tgl_diajukan']; ?></td>
                      <td class="text-center"><?php echo "Administrasi Gudang"; ?></td>
                      <td class="text-center"><?php echo $value['perihal']; ?></td>
                      <td class="text-center">
                        <?php if(!empty($value['tgl_dikonfirmasi'])): ?>
                          <?php echo $value['tgl_dikonfirmasi']; ?>
                        <?php elseif(empty($value['tgl_dikonfirmasi']=="0000-00-00")): ?>
                          <?php echo "-"; ?>
                        <?php endif ?>
                      </td>
                      <td class="text-center">
                        <?php if(!empty($value['status_pengajuan']=="Disetujui")): ?>
                          <a class="btn-success btn-sm"><i class="fa fa-check"></i> <?php echo $value['status_pengajuan']; ?></a>
                        <?php elseif(!empty($value['status_pengajuan']=="Ditolak")): ?>
                          <a class="btn-danger btn-sm" title="Lihat detail pada kolom aksi untuk melihat alasan ditolak" data-content="Popover body content is set in this attribute."><i class="fa fa-close"></i> <?php echo $value['status_pengajuan']; ?></a>
                        <?php else: ?>
                          <a class="btn-default btn-sm" readonly><i class="fa fa-warning"></i> Mohon Dikonfirmasi</a>
                        <?php endif ?>
                      </td>
                      <td class="text-center">
                        
                        <!-- detail -->
                        <a href="<?php echo base_url("user/validasi/lpb/detail/$value[id_lpb]"); ?>" class="btn btn-info btn-sm" title="Detail" data-content="Popover body content is set in this attribute."><i class="fa fa-info"></i></a>
                        <!-- detail -->

                        <!-- Beri No.PO -->
                        <?php if (empty($value['no_purchase_order'])): ?>
                          <a type="button" class="tambah-po btn btn-success btn-sm" title="Beri No.Purchase Order" data-content="Popover body content is set in this attribute." data-id="<?php echo $value['id_lpb']; ?>"><i class="fa fa-plus"></i></a>
                        <?php endif ?>
                        <!-- Beri No.PO -->

                        <!-- Konfirmasi Persetujuan -->
                        <?php if (empty($value['status_pengajuan'])): ?>
                          <a href="#" class="konfirm-persetujuan btn btn-default btn-sm" title="Konfirmasi Persetujuan" data-content="Popover body content is set in this attribute." data-id="<?php echo $value['id_lpb']; ?>"><i class="fa fa-check"></i></a>
                        <?php endif ?>
                        <!-- Konfirmasi Persetujuan -->

                        <!-- Detail Konfirmasi -->
                        <!-- <a href="#" class="detail-konfirm btn btn-primary btn-sm" title="Detail Konfirmasi" data-content="Popover body content is set in this attribute." data-id="<?php //echo $value['id_lpb']; ?>"><i class="fa fa-eye"></i></a> -->
                        <!-- Detail Konfirmasi -->
                      </td>
                    </tr>
                  <?php endif ?>
                <?php endforeach ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Beri No Purchase Order -->
  <div id="beri_po" class="modal fade" role="dialog">
    <div class="modal-dialog body-blue">

      <!-- Modal content-->
      <form method="POST">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title fa fa-cube"> <label>Beri No.Purchase Order</label></h4>
          </div>
          <div class="modal-body">
            <input type="text" name="id_lpb" class="hidden">
            <div class="form-group">
              <label>No.Purchase Order</label>
              <input type="text" class="form-control" name="no_purchase_order">
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-primary fa fa-save" name="tambah" value="tambah" title="Beri No.Purchase Order" data-content="Popover body content is set in this attribute."> Tambah</button>
          </div>
        </div>
      </form>

    </div>
  </div>
  <!-- Beri No Purchase Order -->

  <!-- Konfirmasi Persetujuan -->
  <div id="konfirmasi_persetujuan" class="modal fade" role="dialog">
    <div class="modal-dialog body-blue">

      <!-- Modal content-->
      <form method="POST">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title fa fa-cube"> <label>Beri Konfirmasi Persetujuan</label></h4>
          </div>
          <div class="modal-body">
            <input type="text" name="id_lpb" class="hidden">
            <div class="form-group">
              <button class="btn btn-success" title="Setuju" name="setuju"  value="setuju" data-content="Popover body content is set in this attribute.">Setuju</button>
              <button class="btn btn-danger" title="Tolak" name="tolak" value="tolak" data-content="Popover body content is set in this attribute.">Tolak</button>
              <input type="text" name="ditolak" value="Ditolak" class="hidden">
            </div>
            <div class="form-group">
              <label>Alasan</label>
              <input type="text" class="form-control" name="alasan">
            </div>
            <input type="text" name="tgl_dikonfirmasi" class="hidden" value="<?php echo date('Y-m-d'); ?>">
            <div class="form-group">
              <label>Note:</label>
              <ol>
                <li>Jika klik tombol Setuju, kosongkan kolom inputan alasan.</li>
                <li>Jika klik tombol Tolak, isi terlebih dahulu kolom alasan sebagai penjelasan.</li>
              </ol>
            </div>
          </div>
        </div>
      </form>

    </div>
  </div>
  <!-- Konfirmasi Persetujuan -->

  <!-- Konfirmasi Persetujuan -->
<!-- <div id="detail_konfirmasi" class="modal fade" role="dialog">
  <div class="modal-dialog body-blue"> -->

    <!-- Modal content-->
    <!-- <form method="POST">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title fa fa-cube"> <label>Detail Konfirmasi</label></h4>
        </div>
        <div class="modal-body">
          <input type="text" name="id_lpb" class="hidden">
          <div class="form-group">
            <label>Yang Meminta</label>
            <span style="padding-left: 15px;">:</span>
            <span id="yang_meminta"></span>
          </div>
          <div class="form-group">
            <label>Perihal</label>
            <span style="padding-left: 58px;">:</span>
            <span id="perihal"></span>
          </div>
          <div class="form-group">
            <label>Status</label>
            <span style="padding-left: 62px;">:</span>
            <span id="status"></span>
          </div>
          <div class="form-group">
            <label>Alasan</label>
            <span style="padding-left: 58px;">:</span>
            <span id="alasan"></span>
          </div>
        </div>
      </div>
    </form>

  </div>
</div> -->
<!-- Konfirmasi Persetujuan -->