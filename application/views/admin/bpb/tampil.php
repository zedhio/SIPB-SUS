<section class="content">

  <h5>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url("admin/home"); ?>"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Transaksi</li>
      <li class="active"><a href="<?php echo base_url("admin/bpb/bpb"); ?>" style="color: #777;">Bukti Pengeluaran Barang</a></li>
    </ol>
  </h5>

  <div class="row">
    <div class="col-xs-12">
      <div class="panel panel-heading">
        <div class="box-header">
          <h3 class="box-title fa fa-random"> Bukti Pengeluaran Barang</h3>
          <hr>

          <!-- Bagian pencarian data surat jalan masuk berdasarkan tanggal -->
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
                    <button name="cari" value="cari" class="btn btn-primary btn-sm fa fa-search"> Cari</button>
                  </th>
                </tr>
              </thead>
            </table>
          </form>
          <!-- Bagian pencarian data bon berdasarkan tanggal -->

        </div>
        <div class="box-body">

          <form role="form" method="POST">
            <table class="table table-bordered table-striped table-responsive"> 
              <thead style="background-color: #D3D3D3">
                <tr>
                  <th class="text-center">No</th>
                  <th class="text-center">No.BPB</th>
                  <th class="text-center">Tanggal Dibuat</th>
                  <th class="text-center">Untuk Bagian</th>
                  <th class="text-center">No.PO</th>
                  <th class="text-center">Untuk PO</th>
                  <th class="text-center">Buyer</th>
                  <th class="text-center">Style Glove</th>
                  <th class="text-center">Status</th>
                  <th class="text-center">Aksi</th>
                </tr>
              </thead>

              <tbody>
                <?php foreach ($bpb as $key => $value): ?>
                  <tr>
                    <td class="text-center" width="30"><?php echo $key+1; ?></td>
                    <td class="text-center" width="90"><?php echo $value['no_bpb']; ?></td>
                    <td class="text-center" width="120"><?php echo $value['tgl_dibuat']; ?></td>
                    <td class="text-center" width="110"><?php echo $value['bagian']; ?></td>
                    <td class="text-center" width="70"><?php echo $value['no_po']; ?></td>
                    <td class="text-center" width="130"><?php echo $value['nama_po']; ?></td>
                    <td class="text-center" width="130"><?php echo $value['nama_buyer']; ?></td>
                    <td class="text-center" width="130"><?php echo $value['nama_style']; ?></td>
                    <td class="text-center" width="125">
                      <?php if($value['validasi']==3): ?>
                        <a class="btn-success btn-sm" title="Pengajuan telah disetujui" data-content="Popover body content is set in this attribute."><i class="fa fa-check"></i> Disetujui</a>
                      <?php elseif($value['validasi']==1 AND $value['validasi2']==1): ?>
                        <a class="btn-danger btn-sm" title="Pengajuan telah ditolak" data-content="Popover body content is set in this attribute."><i class="fa fa-close"></i> Ditolak</a>
                      <?php elseif($value['validasi1']==3): ?>
                        <a class="btn-warning btn-sm" title="Tunggu konfirmasi dari Kepala Unit Sewing, Kepala Gudang dan Kepala Divisi Production Manager" data-content="Popover body content is set in this attribute." readonly> Menunggu Konfirmasi</a>
                      <?php elseif(empty($value['validasi11'])): ?>
                        <a class="btn-default btn-sm" title="Klik Ajukan Persetujuan Pada Kolom Aksi" data-content="Popover body content is set in this attribute." readonly> Mohon Ajukan</a>
                      <?php endif ?>
                    </td>
                    <td class="text-center" width="120">

                      <!-- Detail bon -->
                      <a href="<?php echo base_url("admin/bpb/bpb/detail/$value[id_bpb]"); ?>" class="btn btn-primary btn-sm fa fa-info" title="Detail" data-content="Popover body content is set in this attribute." ></a>
                      <!-- Detail bon -->

                      <!-- Detail Pengajuan dengan modal -->
                      <?php if($value['validasi']==1 OR $value['validasi']==2 OR $value['validasi']==3 OR $value['validasi2']==1 OR $value['validasi2']==2 OR $value['validasi2']==3): ?>
                        <a type="button" class="stat-alasan-bpb btn btn-warning fa fa-paint-brush btn-sm" title="Detail Pengajuan" data-content="Popover body content is set in this attribute." data-id="<?php echo $value['id_bpb']; ?>"></a>
                      <?php endif ?>
                      <!-- Status Pengajuan berupa alasan dengan modal -->
                      
                      <?php if(empty($value['validasi11'])): ?>
                        <!-- Mengajukan Persetujuan -->
                        <a href="<?php echo base_url("admin/bpb/bpb/hapus/$value[id_bpb]"); ?>" class="btn btn-danger btn-sm fa fa-trash" title="Hapus" data-content="Popover body content is set in this attribute."></a>
                        <!-- Mengajukan Persetujuan -->
                        
                        <!-- Mengajukan Persetujuan -->
                        <a type="button" class="validasi-bpb btn btn-warning fa fa-file-text-o btn-sm" title="Ajukan Persetujuan" data-content="Popover body content is set in this attribute." data-id="<?php echo $value['id_bpb']; ?>"></a>
                        <!-- Mengajukan Persetujuan -->
                      <?php endif ?>

                      <?php if (empty($value['distribusi'])): ?>
                        <?php if(!empty($value['validasi']==3)): ?>
                          <!-- Mendistribusikan laporan bpb dengan modal -->
                          <?php if (empty($value['distribusi']['tujuan'])): ?>
                            <a type="button" class="distribusi-bpb btn btn-primary btn-sm fa fa-send" title="Kirim Data BPB Sebagai Laporan" data-content="Popover body content is set in this attribute." data-id="<?php echo $value['id_bpb']; ?>"></a>
                          <?php endif ?>
                          <!-- Mendistribusikan LPB dengan modal -->
                        <?php endif ?>
                      <?php endif ?>

                    </td>
                  </tr>
                <?php endforeach ?>
              </tbody>
            </table>
          </form>
          <!-- Bagian menampilkan semua data bon -->

          <br>
          <!-- Tombol tambah data bon -->
          <a class="btn btn-primary btn-sm fa fa-plus" title="Tambah" data-content="Popover body content is set in this attribute."  href="<?php echo base_url("admin/bpb/bpb/tambah") ?>">  Tambah</a>
          <!-- Tombol tambah data bon -->
          
        </div>

      </div>
    </div>
  </div>
</section>

<!-- Modal Pengajuan approval ke K.Gudang dan Administrasi -->
<div id="ajukan_persetujuan_bpb" class="modal fade" role="dialog">
  <div class="modal-dialog body-blue">

    <!-- Modal content-->
    <form method="POST">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title fa fa-cube"><label>Ajukan Permohonan Persetujuan</label></h4>
        </div>
        <div class="modal-body">
          <input type="text" name="id_bpb" hidden="hidden">
          <label class="hidden"><input type="text" name="yang_meminta" value="<?php echo $admin['jabatan']; ?>"></label>
          <div class="form-group">
            <label>Diajukan kepada :</label>
            <div class="checkbox">
              <label><input type="checkbox" name="tujuan[]" alt="Checkbox" value="Kepala Unit Sewing">Kepala Unit Sewing</label><br>
              <label><input type="checkbox" name="tujuan[]" alt="Checkbox" value="Kepala Gudang">Kepala Gudang</label><br>
              <label><input type="checkbox" name="tujuan[]" alt="Checkbox" value="Kepala Divisi Production Manager">Kepala Divisi Production Manager</label>
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
<!-- Modal Pengajuan approval ke Kepala Gudang dan Administrasi -->

<!-- Modal Status alasan approval -->
<div id="status_alasan_bpb" class="modal fade" role="dialog">
  <div class="modal-dialog body-blue">

    <!-- Modal content-->
    <form method="POST">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title fa fa-cube"> <label>Detail Pengajuan</label></h4>
        </div>
        <div class="modal-body" id="detail_pengajuan_bpb"></div>
      </div>
    </form>

  </div>
</div>
<!-- Modal Status Alasan approval -->

<!-- Modal Distribusi LPB yang sudah approve ke Accounting, Hutang Dagang dan Purchase Order -->
<div id="kirim_laporan_bpb" class="modal fade" role="dialog">
  <div class="modal-dialog body-blue">

    <!-- Modal content-->
    <form method="POST">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title fa fa-send"> <label>Kirim Laporan Bukti Pengeluaran Barang</label></h4>
        </div>
        <div class="modal-body">
          <input type="text" name="id_bpb" class="hidden">
          <input type="text" name="asal" class="hidden" value="Administrasi Gudang">
          <div class="form-group">
            <label>Laporan Bukti Pengeluaran Barang ditujukan kepada :</label>
            <div class="checkbox">
              <label><input type="checkbox" name="tujuan[]" alt="Checkbox" value="Kepala Divisi Accounting">Kepala Divisi Accounting</label><br>
              <label><input type="checkbox" name="tujuan[]" alt="Checkbox" value="Kepala Divisi Purchase Order">Kepala Divisi Purchase Order</label><br>
              <label><input type="checkbox" name="tujuan[]" alt="Checkbox" value="Direktur">Direktur</label><br>
              <label><input type="checkbox" name="tujuan[]" alt="Checkbox" value="Administrasi Gudang">Administrasi Gudang [Arsip]</label>
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