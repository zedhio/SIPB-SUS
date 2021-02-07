<section class="content">

  <h5>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url("admin/home"); ?>"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Transaksi</li>
      <li class="active"><a href="<?php echo base_url("admin/surat_jalan_keluar/surat_jalan_keluar"); ?>" style="color: #777;">Surat Jalan Keluar</a></li>
    </ol>
  </h5>

  <div class="row">
    <div class="col-xs-12">
      <div class="panel panel-heading">
        <div class="box-header">
          <h3 class="box-title fa fa-envelope"> Surat Jalan Keluar</h3>
          <hr>

          <!-- Bagian pencarian data surat jalan masuk berdasarkan tanggal -->
          <form role="form" method="POST" >
            <table>
              <thead>
                <tr>
                  <th>Tanggal Awal</th>
                  <th style="padding-left: 10px;">
                    <div class="input-group">
                      <input type="text" id="datepicker" class="form-control" name="tgl_awal" placeholder="22-10-2018" size="6">
                    </div>
                  </th>
                  <th style="padding-left: 10px;">Tanggal Akhir</th>
                  <th style="padding-left: 10px;">
                    <div class="input-group">
                      <input type="text" id="datepicker1" class="form-control" name="tgl_akhir" placeholder="22-10-2018" size="6">
                    </div>
                  </th>
                  <th style="padding-left: 10px;">
                    <button name="cari" value="cari" class="btn btn-primary btn-sm fa fa-search"> Cari</button>
                  </th>
                </tr>
              </thead>
            </table>
          </form>
          <!-- Bagian pencarian data surat jalan masuk berdasarkan tanggal -->

        </div>

        <div class="box-body">

          <!-- Bagian menampilkan semua data surat jalan keluar -->
          <form role="form" method="POST" >
            <table class="table table-bordered table-striped"> 
              <thead style="background-color: #D3D3D3">
                <tr>
                  <th class="text-center">No</th>
                  <th class="text-center">No.Surat Jalan Keluar</th>
                  <th class="text-center">No.Pemeriksaan Barang</th>
                  <th class="text-center">Tanggal Surat</th>
                  <th class="text-center">Ditujukan</th>
                  <th class="text-center">No.Kendaraan</th>
                  <th class="text-center">Keterangan</th>
                  <th class="text-center">Status</th>
                  <th class="text-center">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($sjk as $key => $value): ?>
                  <tr>
                    <td class="text-center" width="30"><?php echo $key+1; ?></td>
                    <td class="text-center" width="170"><?php echo $value['no_sjk']; ?></td>
                    <td class="text-center" width="180"><?php echo $value['sjm']['no_pemeriksaan_barang']; ?></td>
                    <td class="text-center" width="120"><?php echo $value['tgl_dibuat']; ?></td>
                    <td class="text-center"><?php echo $value['sjm']['nama_supplier']; ?></td>
                    <td class="text-center">
                      <?php if(!empty($value['no_kendaraan'])): ?>
                        <?php echo $value['no_kendaraan']; ?>
                      <?php else: ?>
                        <?php echo "-"; ?>
                      <?php endif ?>
                    </td>
                    <td class="text-center"><?php echo $value['sjm']['tindakan']; ?></td>
                    <td class="text-center" width="150">
                      <?php if(empty($value['konfirmasi'])): ?>
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
                    <td class="text-center" width="75">

                      <!-- Detail surat jalan keluar -->
                      <a type="button" href="<?php echo base_url("admin/surat_jalan_keluar/surat_jalan_keluar/detail/$value[id_sjk]"); ?>" class="btn btn-primary btn-sm" title="Detail" data-content="Popover body content is set in this attribute."><i class="fa fa-info"></i></a>
                      <!-- Detail surat jalan keluar -->

                      <!-- Beri No.Kendaraan -->
                      <?php if (empty($value['no_kendaraan'])): ?>
                        <a type="button" class="tambah-no-kendaraan btn btn-success btn-sm" title="Beri No.Kendaraan" data-content="Popover body content is set in this attribute." data-id="<?php echo $value['id_sjk']; ?>"><i class="fa fa-plus"></i></a>
                      <?php endif ?>
                      <!-- Beri No.Kendaraan -->

                      <!-- Beri TTD -->
                      <?php if (!empty($value['no_kendaraan'])): ?>
                        <?php if (empty($value['konfirmasi'])): ?>
                          <button class="btn btn-default btn-sm" name="ttd" value="<?php echo $value['id_sjk']; ?>"  title="Beri Tanda Terima" data-content="Popover body content is set in this attribute."><i class="fa fa-check"></i></button>
                        <?php endif ?>
                      <?php endif ?>
                      <!-- Beri TTD -->

                      <!-- Pengajuan approval ke Direktur dengan modal -->
                      <?php if(!empty($value['konfirmasi'])): ?>
                        <?php if(empty($value['validasi']['tujuan'])): ?>
                          <a type="button" class="validasi-sjk btn btn-warning btn-sm" title="Ajukan Persetujuan" data-content="Popover body content is set in this attribute." data-id="<?php echo $value['id_sjk']; ?>"><i class="fa fa-file-text-o"></i></a>
                        <?php endif ?>
                      <?php endif ?>
                      <!-- Pengajuan approval ke K.Purchase Order dengan modal -->


                      <?php if (empty($value['distribusi'])): ?>
                        <?php if (!empty($value['validasi']['status_pengajuan']=="Disetujui")): ?>

                          <!-- Mendistribusikan Surat Jalan Keluar dengan modal -->
                          <?php if (empty($value['distribusi']['tujuan'])): ?>
                            <a type="button" class="distribusi-sjk btn btn-info btn-sm" title="Kirim Data Sebagai Laporan" data-content="Popover body content is set in this attribute." data-id="<?php echo $value['id_sjk']; ?>"><i class="fa fa-send"></i></a>
                          <?php endif ?>  
                          <!-- Mendistribusikan Surat Jalan Keluar dengan modal -->

                        <?php endif ?>  
                      <?php endif ?>

                      <!-- Beri tanda terima surat jalan keluar -->
                      <!-- <button class="btn btn-warning btn-sm fa fa-check" title="Beri Tanda Terima" data-content="Popover body content is set in this attribute." name="ttd" value=""></button> -->
                      <!-- Beri tanda terima surat jalan keluar -->


                      <!-- Ubah surat jalan keluar -->
                      <!-- <a href="#" class="btn btn-success btn-sm fa fa-pencil" title="Edit" data-content="Popover body content is set in this attribute." ></a> -->
                      <!-- Ubah surat jalan keluar -->

                      <!-- Hapus surat jalan keluar -->
                      <!-- <a href="#" class="btn btn-danger btn-sm fa fa-trash" title="Hapus" data-content="Popover body content is set in this attribute." onclick="return confirm('Apakah anda yakin ?')"></a> -->
                      <!-- Hapus surat jalan keluar -->
                    </td>
                  </tr>
                <?php endforeach ?>
              </tbody>
            </table>
          </form>
          <!-- Bagian menampilkan semua data surat jalan masuk -->
          
        </div>

      </div>
    </div>
  </div>
</section>

<!-- Beri No Kendaraan -->
<div id="beri_no_kendaraan" class="modal fade" role="dialog">
  <div class="modal-dialog body-blue">

    <!-- Modal content-->
    <form method="POST">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title fa fa-cube"> <label>Beri No.Kendaraan</label></h4>
        </div>
        <div class="modal-body">
          <input type="text" name="id_sjk" class="hidden">
          <div class="form-group">
            <label>No.Kendaraan</label>
            <input type="text" class="form-control" name="no_kendaraan" placeholder="500-700">
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary fa fa-save" name="tambah" value="tambah" title="Beri No.Kendaraan" data-content="Popover body content is set in this attribute."> Tambah</button>
        </div>
      </div>
    </form>

  </div>
</div>
<!-- Beri No Purchase Order -->

<!-- Modal Pengajuan approval ke Direktur -->
<div id="ajukan_persetujuan_sjk" class="modal fade" role="dialog">
  <div class="modal-dialog body-blue">

    <!-- Modal content-->
    <form method="POST">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title fa fa-cube"><label>Ajukan Permohonan Persetujuan</label></h4>
        </div>
        <div class="modal-body">
          <label class="hidden"><input type="text" name="yang_meminta" value="<?php echo $admin['jabatan']; ?>"></label>
          <input type="text" name="id_sjk" hidden="hidden">
          <input type="text" name="tujuan" value="Direktur" hidden="hidden">
          <div class="form-group">
            <label>Diajukan Kepada :</label><span> Direktur</span>
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

<!-- Modal Distribusi Surat Jalan Keluar yang sudah approve ke Accounting dan EXIM -->
<div id="kirim_laporan_sjk" class="modal fade" role="dialog">
  <div class="modal-dialog body-blue">

    <!-- Modal content-->
    <form method="POST">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title fa fa-send"> <label>Kirim Data Surat Jalan Keluar Sebagai Laporan</label></h4>
        </div>
        <div class="modal-body">
          <input type="text" name="id_sjk" class="hidden">
          <input type="text" name="asal" class="hidden" value="Administrasi Gudang">
          <div class="form-group">
            <label>Laporan Surat Jalan Keluar ditujukan kepada :</label>
            <div class="checkbox">
              <label><input type="checkbox" name="tujuan[]" alt="Checkbox" value="Direktur">Direktur</label><br>
              <label><input type="checkbox" name="tujuan[]" alt="Checkbox" value="Kepala Divisi Accounting">Kepala Divisi Accounting</label><br>
              <label><input type="checkbox" name="tujuan[]" alt="Checkbox" value="Kepala Divisi EXIM">Kepala Divisi EXIM</label><br>
              <label><input type="checkbox" name="tujuan[]" alt="Checkbox" value="Administrasi Gudang">Administrasi Gudang (Arsip Gudang)</label><br>
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
<!-- Modal Distribusi Surat Jalan Keluar yang sudah approve ke Accounting dan EXIM -->