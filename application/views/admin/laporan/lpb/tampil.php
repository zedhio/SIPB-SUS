<style type="text/css">
  .body-blue {
    border: 1px solid #3c8dbc;
  }
</style>

<section class="content">

  <h5>
    <ol class="breadcrumb hidden-print">
      <li><a href="<?php echo base_url("admin/home"); ?>"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Laporan</li>
      <li class="active"><a href="<?php echo base_url("admin/laporan/lpb"); ?>" style="color: #777;">LPB</a></li>
    </ol>
  </h5>

  <div class="row">
    <div class="col-xs-12">
      <div class="panel panel-heading">
        <div class="box-header hidden-print">
          <h3 class="box-title fa fa-file-text-o"> Laporan Penerimaan Barang</h3>
          <hr>

          <!-- Bagian pencarian data laporan penerimaan barang -->
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
                    <button name="cari" value="cari" class="btn btn-primary btn-sm fa fa-search" title="Cari" data-content="Popover body content is set in this attribute."> Cari</button>
                  </th>
                  <th style="padding-left: 735px;">
                    <button name="rekap" value="rekap" class="btn btn-info btn-sm fa fa-map-o" title="Lihat Rekap" data-content="Popover body content is set in this attribute."> Rekapitulasi LPB</button>
                  </th>
                </tr>
              </thead>
            </table>
          </form>
          <!-- Bagian pencarian data laporan penerimaan barang -->

        </div>

        <div class="box-body hidden-print">
          <form role="form" method="POST" >

            <!-- Bagian tampilan data laporan penerimaan barang -->
            <table class="table table-bordered table-striped" id="example1"> 
              <thead style="background-color: #D3D3D3">
                <tr>
                  <th class="text-center" width="30">No</th>
                  <th class="text-center" width="80">No.LPB</th>
                  <th class="text-center" width="170">No.Surat Jalan Masuk</th>
                  <th class="text-center" width="150">No.Purchase Order</th>
                  <th class="text-center" width="140">Tanggal Dibuat</th>
                  <th class="text-center" >Keterangan</th>
                  <th class="text-center" >Status</th>
                  <th class="text-center" >Alasan</th>
                  <th class="text-center" >Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($lpb as $key => $value): ?>
                  <tr>
                    <td class="text-center"><?php echo $key+1; ?></td>
                    <td class="text-center"><?php echo $value['no_lpb']; ?></td>
                    <td class="text-center">
                      <?php if(!empty($value['no_sjm'])): ?>
                        <?php echo $value['no_sjm']; ?>
                      <?php elseif(empty($value['no_sjm'])): ?>
                        <?php echo "-"; ?>
                      <?php endif ?>
                    </td>
                    <td class="text-center">
                      <?php if(!empty($value['no_purchase_order'])): ?>
                        <?php echo $value['no_purchase_order']; ?>
                      <?php elseif(empty($value['no_purchase_order'])): ?>
                        <?php echo "<a class='btn-default btn-sm'> Mohon Tunggu</a>"; ?>
                      <?php endif ?>
                    </td>
                    <td class="text-center"><?php echo $value['tgl_dibuat']; ?></td>
                    <td class="text-center" width="300"><?php echo $value['keterangan']; ?></td>
                    <td class="text-center" width="150">
                      <?php if(empty($value['konfirmasi_ttd'])): ?>
                        <a class="btn-default btn-sm" readonly> Mohon Beri TTD</a>
                      <?php elseif(empty($value['validasi']['yang_meminta'])): ?>
                        <a class="btn-default btn-sm" readonly> Mohon Ajukan</a>
                      <?php elseif(empty($value['validasi']['status_pengajuan'])): ?>
                        <a class="btn-warning btn-sm" readonly> Menunggu Konfirmasi</a>
                      <?php elseif(!empty($value['validasi']['status_pengajuan']=="Disetujui")): ?>
                        <a class="btn-success btn-sm"><i class="fa fa-check"></i> <?php echo $value['validasi']['status_pengajuan']; ?></a>
                      <?php elseif(!empty($value['validasi']['status_pengajuan']=="Ditolak")): ?>
                        <a class="btn-danger btn-sm"><i class="fa fa-close"></i>  <?php echo $value['validasi']['status_pengajuan']; ?></a>
                      <?php endif ?>
                    </td>
                    <td class="text-center" width="150">
                      <?php if(!empty($value['validasi']['alasan'])): ?>
                        <?php echo $value['validasi']['alasan']; ?>
                      <?php else: ?>
                        <?php echo "-"; ?>
                      <?php endif ?>
                    </td>
                    <td class="text-center" width="130">

                      <!-- Detail LPB -->
                      <a href="<?php echo base_url("admin/laporan/lpb/detail/$value[id_lpb]"); ?>" class="btn btn-info btn-sm" title="Detail" data-content="Popover body content is set in this attribute."><i class="fa fa-info"></i></a>
                      <!-- Detail LPB -->

                      <?php if(!empty($value['validasi']['status_pengajuan']=="Disetujui")): ?>
                        <a href="<?php echo base_url("admin/laporan/lpb/preview_lpb/$value[id_lpb]"); ?>" class="btn btn-primary btn-sm" title="Download File (PDF)" data-content="Popover body content is set in this attribute."><i class="fa fa-download"></i></a>
                      <?php endif ?>

                      <!-- Pengajuan approval ke K.Purchase Order dengan modal -->
                      <?php if(!empty($value['konfirmasi_ttd'])): ?>
                        <?php if(empty($value['validasi']['tujuan'])): ?>
                          <a type="button" class="validasi-lpb btn btn-warning btn-sm" title="Ajukan Persetujuan" data-content="Popover body content is set in this attribute." data-id="<?php echo $value['id_lpb']; ?>"><i class="fa fa-file-text-o"></i></a>
                        <?php endif ?>
                      <?php endif ?>
                      <!-- Pengajuan approval ke K.Purchase Order dengan modal -->

                      <!-- Beri TTD -->
                      <?php if(empty($value['konfirmasi_ttd'])): ?>
                        <button class="btn btn-default btn-sm" name="ttd" value="<?php echo $value['id_lpb']; ?>"  title="Beri Tanda Terima" data-content="Popover body content is set in this attribute."><i class="fa fa-check"></i></button>
                      <?php endif ?>
                      <!-- Beri TTD -->

                      <?php if(!empty($value['validasi']['status_pengajuan']=="Disetujui")): ?>
                        <!-- Mendistribusikan LPB dengan modal -->
                        <?php if (empty($value['distribusi']['tujuan'])): ?>
                          <a type="button" class="distribusi-lpb btn btn-primary btn-sm" title="Kirim Laporan" data-content="Popover body content is set in this attribute." data-id="<?php echo $value['id_lpb']; ?>"><i class="fa fa-send"></i></a>
                        <?php endif ?>
                        <!-- Mendistribusikan LPB dengan modal -->
                      <?php endif ?>

                      <!-- Status Pengajuan approval dari K.Purchase Order dengan modal -->
                      <!-- <a type="button" class="stat-persetujuan btn btn-success btn-sm" title="Status Pengajuan" data-content="Popover body content is set in this attribute." data-id="<?php echo $value['id_lpb']; ?>"><i class="fa fa-eye"></i></a> -->
                      <!-- Status Pengajuan approval dari K.Purchase Order dengan modal -->

                    </td>
                  </tr>
                <?php endforeach ?> 
              </tbody>
            </table>
            <!-- Bagian tampilan data laporan penerimaan barang -->

          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Modal Pengajuan approval ke K.Purchase Order -->
<div id="ajukan_persetujuan" class="modal fade" role="dialog">
  <div class="modal-dialog body-blue">

    <!-- Modal content-->
    <form method="POST">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title fa fa-cube"><label>Ajukan Permohonan Persetujuan</label></h4>
        </div>
        <div class="modal-body">
          <input type="text" name="id_lpb" hidden="hidden">
          <label class="hidden"><input type="text" name="yang_meminta" value="<?php echo $admin['jabatan']; ?>"></label>
          <div class="form-group">
            <label>Diajukan Kepada :</label><span> <?php echo $jabatan['jabatan']; ?></span>
          </div>
          <div class="form-group">
            <label>Perihal</label>
            <input type="text" class="form-control" name="perihal" placeholder="Contoh: Memohon Persetujuan">
          </div>
          <input type="text" name="tgl_diajukan" class="hidden" value="<?php echo date('Y-m-d'); ?>">
          <div class="modal-footer">
            <button class="btn btn-success fa fa-send" name="ajukan" value="ajukan" title="Ajukan Persetujuan" data-content="Popover body content is set in this attribute."> Ajukan</button>
          </div>
        </div>
      </div>
    </form>

  </div>
</div>
<!-- Modal Pengajuan approval ke K.Purchase Order -->

<!-- Modal Status Pengajuan approval dari K.Purchase Order -->
<div id="status_persetujuan" class="modal fade" role="dialog">
  <div class="modal-dialog body-blue">

    <!-- Modal content-->
    <form method="POST">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title fa fa-cube"> <label>Status Persetujuan</label></h4>
        </div>
        <div class="modal-body">
          <input type="text" name="id_lpb" class="hidden">
          <div class="form-group">
            <label>Status</label>
            <span style="padding-left: 94px;">:</span>
            <span id="status"></span>
          </div>
          <div class="form-group">
            <label>Alasan</label>
            <span style="padding-left: 92px;">:</span>
            <span id="alasan"></span>
          </div>
        </div>
      </div>
    </form>

  </div>
</div>
<!-- Modal Status Pengajuan approval dari K.Purchase Order -->

<!-- Modal Distribusi LPB yang sudah approve ke Accounting, Hutang Dagang dan Purchase Order -->
<div id="kirim_laporan" class="modal fade" role="dialog">
  <div class="modal-dialog body-blue">

    <!-- Modal content-->
    <form method="POST">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title fa fa-send"> <label>Kirim Laporan Penerimaan Barang</label></h4>
        </div>
        <div class="modal-body">
          <input type="text" name="id_lpb" class="hidden">
          <input type="text" name="asal" class="hidden" value="Administrasi Gudang">
          <div class="form-group">
            <label>Laporan Penerimaan Barang ditujukan kepada :</label>
            <div class="checkbox">
              <label><input type="checkbox" name="tujuan[]" alt="Checkbox" value="Kepala Divisi Purchase Order">Kepala Divisi Purchase Order</label><br>
              <label><input type="checkbox" name="tujuan[]" alt="Checkbox" value="Kepala Divisi Hutang Dagang">Kepala Divisi Hutang Dagang</label><br>
              <label><input type="checkbox" name="tujuan[]" alt="Checkbox" value="Kepala Divisi Accounting">Kepala Divisi Accounting</label><br>
              <label><input type="checkbox" name="tujuan[]" alt="Checkbox" value="Direktur">Direktur</label>
            </div>
          </div>
          <input type="text" name="tgl_diterima" class="hidden" value="<?php echo date('Y-m-d'); ?>">
          <div class="modal-footer">
            <button class="btn btn-success fa fa-send" name="kirim" value="kirim" title="Kirim Laporan" data-content="Popover body content is set in this attribute."> Kirim</button>
          </div>
        </div>
      </div>
    </form>

  </div>
</div>
<!-- Modal Distribusi LPB yang sudah approve ke Accounting, Hutang Dagang dan Purchase Order -->