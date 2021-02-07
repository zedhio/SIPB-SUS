<style type="text/css">
  .scroll-y {
    overflow-x: scroll;
  }
</style>

<section class="content">

  <h5>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url("user/home"); ?>"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Transaksi</li>
      <li class="active"><a href="<?php echo base_url("user/production_order/production_order"); ?>" style="color: #777;">Production Order</a></li>
    </ol>
  </h5>

  <div class="row">
    <div class="col-xs-12">
      <div class="panel panel-heading">
        <div class="box-header">
          <h3 class="box-title fa fa-sticky-note-o"> Production Order</h3>
          <hr>
        </div>

        <div class="box-body">
          <form role="form" method="POST" >
            <table>
              <thead>
                <tr>
                  <th>Tanggal Order</th>
                  <th style="padding-left: 10px;">
                    <div class="input-group">
                      <input type="text" id="datepicker" class="form-control" name="tgl_order" placeholder="22-10-2018" size="6">
                    </div>
                  </th>
                  <th style="padding-left: 10px;">Tanggal Kirim</th>
                  <th style="padding-left: 10px;">
                    <div class="input-group">
                      <input type="text" id="datepicker1" class="form-control" name="tgl_kirim" placeholder="22-10-2018" size="6">
                    </div>
                  </th>
                  <th style="padding-left: 10px;">
                    <button name="cari" value="cari" class="btn btn-primary btn-sm fa fa-search"> Cari</button>
                  </th>
                  <th style="padding-left: 730px;">
                    <button name="rekap_po" value="rekap_po" class="btn btn-info btn-sm fa fa-map-o" title="Lihat Rekapitulasi Production Order" data-content="Popover body content is set in this attribute."> Rekapitulasi PO</button>
                  </th>
                </tr>
              </thead>
            </table>
          </form>
        </div>
        
        <div class="box-body">
          <form method="POST">
            <table class="table table-bordered table-striped" id="example1"> 
              <thead style="background-color: #D3D3D3">
                <tr>
                  <th class="text-center" width="20">No</th>
                  <th class="text-center">No.Production Order</th>
                  <th class="text-center">Nama Production Order</th>
                  <th class="text-center">Buyer</th>
                  <th class="text-center">Qty</th>
                  <th class="text-center">Style</th>
                  <th class="text-center">Tanggal Order</th>
                  <th class="text-center">Tanggal Pengiriman</th>
                  <th class="text-center" width="130">Status</th>
                  <th class="text-center">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($production_order as $key => $value): ?>
                  <tr>
                    <td class="text-center"><?php echo $key+1; ?></td>
                    <td class="text-center"><?php echo $value['no_po']; ?></td>
                    <td class="text-center"><?php echo $value['nama_po']; ?></td>
                    <td class="text-center"><?php echo $value['nama_buyer']; ?></td>
                    <td class="text-center"><?php echo $value['qty']." Pcs"; ?></td>
                    <td class="text-center"><?php echo $value['nama_style']; ?></td>
                    <td class="text-center"><?php echo $value['tgl_order']; ?></td>
                    <td class="text-center">
                      <?php if (!empty($value['tgl_kirim']=="0000-00-00")): ?>
                        <a class="btn-default btn-sm" title="Klik tombol Beri Tanggal Pengiriman Pada Kolom Aksi" data-content="Popover body content is set in this attribute." readonly><i class="fa fa-warning"></i> Mohon Diisi</a>
                      <?php elseif (!empty($value['tgl_kirim'])): ?>
                        <?php echo $value['tgl_kirim']; ?>
                      <?php endif ?>
                    </td>
                    <td class="text-center">
                      <?php if($value['validasi1']==3): ?>
                        <a class="btn-success btn-sm" title="Pengajuan Telah Disetujui, Lihat Detail Pengajuan" data-content="Popover body content is set in this attribute."><i class="fa fa-check"></i> Disetujui</a>
                      <?php elseif($value['validasi1']==2 AND $value['validasi2']==1): ?>
                        <a class="btn-danger btn-sm" title="Pengajuan Telah Ditolak, Lihat Detail Pengajuan" data-content="Popover body content is set in this attribute."><i class="fa fa-close"></i> Ditolak</a>
                      <?php elseif($value['validasi1']==1 AND $value['validasi2']==2): ?>
                        <a class="btn-danger btn-sm" title="Pengajuan Telah Ditolak, Lihat Detail Pengajuan" data-content="Popover body content is set in this attribute."><i class="fa fa-close"></i> Ditolak</a>
                      <?php elseif($value['validasi2']==3): ?>
                        <a class="btn-danger btn-sm" title="Pengajuan Telah Ditolak, Lihat Detail Pengajuan" data-content="Popover body content is set in this attribute."><i class="fa fa-close"></i> Ditolak</a>
                      <?php elseif(!empty($value['validasi']) OR $value['validasi1']==1 OR $value['validasi1']==2 OR $value['validasi2']==1 OR $value['validasi2']==2): ?>
                        <a class="btn-warning btn-sm" title="Klik Tombol Detail Pengajuan Pada Kolom Aksi" data-content="Popover body content is set in this attribute." readonly> Menunggu Konfirmasi</a>
                      <?php elseif (empty($value['konfirmasi'])): ?>
                        <a class="btn-default btn-sm" title="Klik Tombol Beri Tanda Terima Pada Kolom Aksi" data-content="Popover body content is set in this attribute." readonly> Mohon Beri Ttd</a>
                      <?php else: ?>
                        <a class="btn-default btn-sm" readonly> Mohon Ajukan</a>
                      <?php endif ?>  
                    </td>
                    <td class="text-center">

                      <!-- Detail -->
                      <a href="<?php echo base_url("user/production_order/production_order/detail/$value[id_po]"); ?>" class="btn btn-primary btn-sm fa fa-info" title="Detail" data-content="Popover body content is set in this attribute." ></a>
                      <!-- Detail -->

                      <!-- Beri Tgl Pengiriman -->
                      <?php if (!empty($value['tgl_kirim']=="0000-00-00")): ?>
                        <a type="button" class="tambah-tgl-kirim btn btn-info btn-sm fa fa-plus" title="Beri Tanggal Pengiriman" data-content="Popover body content is set in this attribute." data-id="<?php echo $value['id_po']; ?>"></a>
                      <?php endif ?>
                      <!-- Beri Tgl Pengiirman -->

                      <!-- Beri TTD -->
                      <?php if(empty($value['konfirmasi'])): ?>
                        <button class="btn btn-default btn-sm" name="ttd" value="<?php echo $value['id_po']; ?>"  title="Beri Tanda Terima" data-content="Popover body content is set in this attribute."><i class="fa fa-check"></i></button>
                        <!-- Beri TTD -->
                        
                        <!-- Edit -->
                        <!-- <a href="<?php //echo base_url("user/production_order/production_order/edit/$value[id_po]"); ?>" class="btn btn-success btn-sm fa fa-pencil" title="Edit" data-content="Popover body content is set in this attribute." ></a> -->
                        <!-- Edit -->

                        <!-- Hapus -->
                        <a href="<?php echo base_url("user/production_order/production_order/hapus/$value[id_po]"); ?>" class="btn btn-danger btn-sm fa fa-trash" title="Hapus" data-content="Popover body content is set in this attribute." onclick="return confirm('Apakah anda yakin ?')"></a>
                        <!-- Hapus -->
                      <?php endif ?>

                      <?php if(!empty($value['validasi1']==3)): ?>
                        <!-- Mendistribusikan PO dengan modal -->
                        <?php if (empty($value['distribusi'])): ?>
                          <a type="button" class="distribusi-po btn btn-primary btn-sm fa fa-send" title="Kirim Data Production Order Sebagai Laporan" data-content="Popover body content is set in this attribute." data-id="<?php echo $value['id_po']; ?>"></a>
                        <?php endif ?>
                        <!-- Mendistribusikan PO dengan modal -->
                      <?php endif ?>

                      <!-- Pengajuan approval ke K.Gudang, K.Manager Prod, Direktur dengan modal -->
                      <?php if(!empty($value['konfirmasi'])): ?>
                        <?php if(empty($value['validasi'][0]['tujuan'])): ?>
                          <a type="button" class="pengajuan-po btn btn-warning btn-sm fa fa-file-text-o" title="Ajukan Persetujuan" data-content="Popover body content is set in this attribute." data-id="<?php echo $value['id_po']; ?>"></a>
                        <?php endif ?>
                      <?php endif ?>
                      <!-- Pengajuan approval ke K.Gudang, K.Manager Prod, Direktur dengan modal -->

                      <!-- Detail Pengajuan dengan modal -->
                      <?php if(!empty($value['validasi']) OR $value['validasi1']==1 OR $value['validasi1']==2 OR $value['validasi1']==3 OR $value['validasi2']==1 OR $value['validasi2']==2 OR $value['validasi2']==3): ?>
                        <a type="button" class="stat-pengajuan btn btn-warning fa fa-eye btn-sm" title="Detail Pengajuan" data-content="Popover body content is set in this attribute." data-id="<?php echo $value['id_po']; ?>"></a>
                      <?php endif ?>
                      <!-- Status Pengajuan berupa alasan dengan modal -->

                    </td>
                  </tr>
                <?php endforeach ?>
              </tbody>
            </table>
          </form>
          <br>
          <a class="btn btn-primary btn-sm fa fa-plus" title="Tambah" data-content="Popover body content is set in this attribute."  href="<?php echo base_url("user/production_order/production_order/tambah_pos"); ?>">  Tambah</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Beri Tgl Pengiriman -->
<div id="beri_tgl" class="modal fade" role="dialog">
  <div class="modal-dialog body-blue">

    <!-- Modal content-->
    <form method="POST">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title fa fa-cube"> <label>Beri Tanggal Pengiriman</label></h4>
        </div>
        <div class="modal-body">
          <input type="text" name="id_po" class="hidden">
          <div class="form-group">
            <label>Tanggal Pengiriman</label>
            <div class="input-group">
              <input type="text" id="datepicker2" class="form-control" name="tgl_kirim" placeholder="2018-10-02">
              <div class="input-group-addon">
                <i class="fa fa-calendar-plus-o"></i>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary fa fa-save" name="tambah_tgl" value="tambah_tgl" title="Beri Tanggal Pengiriman" data-content="Popover body content is set in this attribute."> Tambah</button>
        </div>
      </div>
    </form>

  </div>
</div>
<!-- Beri Tgl Pengirman -->

<!-- Ajukan Persetujuan -->
<div id="pengajuan_po" class="modal fade" role="dialog">
  <div class="modal-dialog body-blue">

    <!-- Modal content-->
    <form method="POST">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title fa fa-cube"><label>Ajukan Permohonan Persetujuan</label></h4>
        </div>
        <div class="modal-body">
          <input type="text" name="id_po" class="hidden">
          <label class="hidden"><input type="text" name="yang_meminta" value="<?php echo $user['jabatan']; ?>"></label>
          <div class="form-group">
            <label>Diajukan kepada :</label>
            <div class="checkbox">
              <label><input type="checkbox" name="tujuan[]" alt="Checkbox" value="Kepala Gudang">Kepala Gudang</label><br>
              <label><input type="checkbox" name="tujuan[]" alt="Checkbox" value="Kepala Divisi Production Manager">Kepala Divisi Production Manager</label><br>
              <label><input type="checkbox" name="tujuan[]" alt="Checkbox" value="Direktur">Direktur</label>
            </div>
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
<!-- Ajukan Persetujuan -->

<!-- Modal Distribusi LPB yang sudah approve ke Accounting, Hutang Dagang dan Purchase Order -->
<div id="kirim_laporan_po" class="modal fade" role="dialog">
  <div class="modal-dialog body-blue">

    <!-- Modal content-->
    <form method="POST">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title fa fa-send"> <label>Kirim Data Production Order Sebagai Laporan</label></h4>
        </div>
        <div class="modal-body">
          <input type="text" name="id_po" class="hidden">
          <input type="text" name="asal" class="hidden" value="Staff PPIC">
          <div class="form-group">
            <label>Laporan Production Order ditujukan kepada :</label>
            <div class="checkbox">
              <label><input type="checkbox" name="tujuan[]" alt="Checkbox" value="Administrasi Gudang">Administrasi Gudang</label><br>
              <label><input type="checkbox" name="tujuan[]" alt="Checkbox" value="Staff Unit Sewing">Staff Unit Sewing</label>
            </div>
          </div>
          <input type="text" name="tgl_dikirim" class="hidden" value="<?php echo date('Y-m-d'); ?>">
          <div class="modal-footer">
            <button class="btn btn-success fa fa-send" name="kirim" value="kirim" title="Kirim Laporan" data-content="Popover body content is set in this attribute."> Kirim</button>
          </div>
        </div>
      </div>
    </form>

  </div>
</div>
<!-- Modal Distribusi LPB yang sudah approve ke Accounting, Hutang Dagang dan Purchase Order -->

<!-- Modal Status pengajuan approval -->
<div id="status_pengajuan" class="modal fade" role="dialog">
  <div class="modal-dialog body-blue">

    <!-- Modal content-->
    <form method="POST">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title fa fa-cube"> <label>Detail Pengajuan</label></h4>
        </div>
        <div class="modal-body" id="detail_pengajuan_approval"></div>
      </div>
    </form>

  </div>
</div>
<!-- Modal Status Alasan approval -->