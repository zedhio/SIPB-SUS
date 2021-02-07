<section class="content">

  <h5>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url("user/home"); ?>"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Validasi</li>
      <li class="active"><a href="<?php echo base_url("user/validasi/bpb"); ?>" style="color: #777;">Bukti Pengeluaran Barang</a></li>
    </ol>
  </h5>

  <div class="row">
    <div class="col-xs-12">
      <div class="panel panel-heading">
        <div class="box-header">
          <h3 class="box-title fa fa-check"> Validasi Bukti Pengeluaran Barang</h3>
          <hr>

          <!-- Bagian pencarian data surat jalan masuk berdasarkan tanggal -->
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
                  <th style="padding-left: 10px;">Tanggal Dikonfimarsi</th>
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

          <!-- Bagian menampilkan semua data bon pengeluaran barang -->
          <form role="form" method="POST" >
            <table class="table table-bordered table-striped table-responsive"> 
              <thead style="background-color: #D3D3D3">
                <tr>
                  <th class="text-center">No</th>
                  <th class="text-center">No.BPB</th>
                  <th class="text-center">Tanggal Diajukan</th>
                  <th class="text-center">No.PO</th>
                  <th class="text-center">Untuk PO</th>
                  <th class="text-center">Buyer</th>
                  <th class="text-center">Style Glove</th>
                  <th class="text-center">Tanggal Dikonfirmasi</th>
                  <th class="text-center">Status</th>
                  <th class="text-center">Aksi</th>
                </tr>
              </thead>

              <?php $no = 1; ?>

              <tbody>
                <?php if($_SESSION['user']['level']=="Kepala Unit Sewing"): ?>
                  <?php foreach ($bpb1 as $key => $value): ?>
                    <?php foreach ($value['validasi'] as $kunci => $isi): ?>
                      <?php if ($isi['tujuan']=="Kepala Unit Sewing"): ?>
                        <tr>
                          <td class="text-center" width="20"><?php echo $no++; ?></td>
                          <td class="text-center" width="90"><?php echo $value['no_bpb']; ?></td>
                          <td class="text-center" width="80"><?php echo $isi['tgl_diajukan']; ?></td>
                          <td class="text-center" width="80"><?php echo $value['po']['no_po']; ?></td>
                          <td class="text-center" width="110"><?php echo $value['po']['nama_po']; ?></td>
                          <td class="text-center" width="110"><?php echo $value['po']['nama_buyer']; ?></td>
                          <td class="text-center" width="96"><?php echo $value['po']['nama_style']; ?></td>
                          <td class="text-center" width="80">
                            <?php if ($isi['tgl_dikonfirmasi']=="0000-00-00"): ?>
                              <?php echo "-"; ?>
                            <?php elseif ($isi['tgl_dikonfirmasi']!=="0000-00-00"): ?>
                              <?php echo $isi['tgl_dikonfirmasi']; ?>
                            <?php endif ?>
                          </td>
                          <td class="text-center" width="110">
                            <?php if(!empty($isi['status_pengajuan']=="Disetujui")): ?>
                              <a class="btn-success btn-sm"><i class="fa fa-check"></i> <?php echo $isi['status_pengajuan']; ?></a>
                            <?php elseif(!empty($isi['status_pengajuan']=="Ditolak")): ?>
                              <a class="btn-danger btn-sm"><i class="fa fa-close"></i> <?php echo $isi['status_pengajuan']; ?></a>
                            <?php else: ?>
                              <a class="btn-warning btn-sm" readonly><i class="fa fa-warning"></i> Mohon Dikonfirmasi</a>
                            <?php endif ?>
                          </td>
                          <td class="text-center" width="60">

                            <!-- Detail bon -->
                            <a href="<?php echo base_url("user/validasi/bpb/detail/$value[id_bpb]"); ?>" class="btn btn-primary btn-sm fa fa-info" title="Detail" data-content="Popover body content is set in this attribute."></a>
                            <!-- Detail bon -->

                            <!-- Konfirmasi Persetujuan -->
                            <?php if (empty($isi['status_pengajuan'])): ?>
                              <a href="#" class="konfirm-persetujuan-bpb btn btn-default btn-sm fa fa-check" title="Konfirmasi Persetujuan" data-content="Popover body content is set in this attribute." data-bpb="<?php echo $value['id_bpb'] ?>" data-id="<?php echo $isi['id_val_bpb']; ?>"></a>
                            <?php endif ?>
                            <!-- Konfirmasi Persetujuan -->

                          </td>
                        </tr>
                      <?php endif ?>
                    <?php endforeach ?>
                  <?php endforeach ?>

                <?php elseif($_SESSION['user']['level']=="Kepala Gudang"): ?>
                  <?php foreach ($bpb1 as $key => $value): ?>
                    <?php foreach ($value['validasi'] as $kunci => $isi): ?>
                      <?php if ($isi['tujuan']=="Kepala Gudang"): ?>
                        <tr>
                          <td class="text-center" width="20"><?php echo $no++; ?></td>
                          <td class="text-center" width="90"><?php echo $value['no_bpb']; ?></td>
                          <td class="text-center" width="80"><?php echo $isi['tgl_diajukan']; ?></td>
                          <td class="text-center" width="80"><?php echo $value['po']['no_po']; ?></td>
                          <td class="text-center" width="110"><?php echo $value['po']['nama_po']; ?></td>
                          <td class="text-center" width="110"><?php echo $value['po']['nama_buyer']; ?></td>
                          <td class="text-center" width="96"><?php echo $value['po']['nama_style']; ?></td>
                          <td class="text-center" width="80">
                            <?php if ($isi['tgl_dikonfirmasi']=="0000-00-00"): ?>
                              <?php echo "-"; ?>
                            <?php elseif ($isi['tgl_dikonfirmasi']!=="0000-00-00"): ?>
                              <?php echo $isi['tgl_dikonfirmasi']; ?>
                            <?php endif ?>
                          </td>
                          <td class="text-center" width="110">
                            <?php if(!empty($isi['status_pengajuan']=="Disetujui")): ?>
                              <a class="btn-success btn-sm"><i class="fa fa-check"></i> <?php echo $isi['status_pengajuan']; ?></a>
                            <?php elseif(!empty($isi['status_pengajuan']=="Ditolak")): ?>
                              <a class="btn-danger btn-sm"><i class="fa fa-close"></i> <?php echo $isi['status_pengajuan']; ?></a>
                            <?php else: ?>
                              <a class="btn-warning btn-sm" readonly><i class="fa fa-warning"></i> Mohon Dikonfirmasi</a>
                            <?php endif ?>
                          </td>
                          <td class="text-center" width="60">

                            <!-- Detail bon -->
                            <a href="<?php echo base_url("user/validasi/bpb/detail/$value[id_bpb]"); ?>" class="btn btn-primary btn-sm fa fa-info" title="Detail" data-content="Popover body content is set in this attribute."></a>
                            <!-- Detail bon -->

                            <!-- Konfirmasi Persetujuan -->
                            <?php if (empty($isi['status_pengajuan'])): ?>
                              <a href="#" class="konfirm-persetujuan-bpb btn btn-default btn-sm fa fa-check" title="Konfirmasi Persetujuan" data-content="Popover body content is set in this attribute." data-bpb="<?php echo $value['id_bpb'] ?>" data-id="<?php echo $isi['id_val_bpb']; ?>"></a>
                            <?php endif ?>
                            <!-- Konfirmasi Persetujuan -->

                          </td>
                        </tr>
                      <?php endif ?>
                    <?php endforeach ?>
                  <?php endforeach ?>

                <?php elseif($_SESSION['user']['level']=="Kepala Divisi Production Manager"): ?>
                  <?php foreach ($bpb1 as $key => $value): ?>
                    <?php foreach ($value['validasi'] as $kunci => $isi): ?>
                      <?php if ($isi['tujuan']=="Kepala Divisi Production Manager"): ?>
                        <tr>
                          <td class="text-center" width="20"><?php echo $no++; ?></td>
                          <td class="text-center" width="90"><?php echo $value['no_bpb']; ?></td>
                          <td class="text-center" width="80"><?php echo $isi['tgl_diajukan']; ?></td>
                          <td class="text-center" width="80"><?php echo $value['po']['no_po']; ?></td>
                          <td class="text-center" width="110"><?php echo $value['po']['nama_po']; ?></td>
                          <td class="text-center" width="110"><?php echo $value['po']['nama_buyer']; ?></td>
                          <td class="text-center" width="96"><?php echo $value['po']['nama_style']; ?></td>
                          <td class="text-center" width="80">
                            <?php if ($isi['tgl_dikonfirmasi']=="0000-00-00"): ?>
                              <?php echo "-"; ?>
                            <?php elseif ($isi['tgl_dikonfirmasi']!=="0000-00-00"): ?>
                              <?php echo $isi['tgl_dikonfirmasi']; ?>
                            <?php endif ?>
                          </td>
                          <td class="text-center" width="110">
                            <?php if(!empty($isi['status_pengajuan']=="Disetujui")): ?>
                              <a class="btn-success btn-sm"><i class="fa fa-check"></i> <?php echo $isi['status_pengajuan']; ?></a>
                            <?php elseif(!empty($isi['status_pengajuan']=="Ditolak")): ?>
                              <a class="btn-danger btn-sm"><i class="fa fa-close"></i> <?php echo $isi['status_pengajuan']; ?></a>
                            <?php else: ?>
                              <a class="btn-warning btn-sm" readonly><i class="fa fa-warning"></i> Mohon Dikonfirmasi</a>
                            <?php endif ?>
                          </td>
                          <td class="text-center" width="60">

                            <!-- Detail bon -->
                            <a href="<?php echo base_url("user/validasi/bpb/detail/$value[id_bpb]"); ?>" class="btn btn-primary btn-sm fa fa-info" title="Detail" data-content="Popover body content is set in this attribute."></a>
                            <!-- Detail bon -->

                            <!-- Konfirmasi Persetujuan -->
                            <?php if (empty($isi['status_pengajuan'])): ?>
                              <a href="#" class="konfirm-persetujuan-bpb btn btn-default btn-sm fa fa-check" title="Konfirmasi Persetujuan" data-content="Popover body content is set in this attribute." data-bpb="<?php echo $value['id_bpb'] ?>" data-id="<?php echo $isi['id_val_bpb']; ?>"></a>
                            <?php endif ?>
                            <!-- Konfirmasi Persetujuan -->

                          </td>
                        </tr>
                      <?php endif ?>
                    <?php endforeach ?>
                  <?php endforeach ?>

                <?php endif ?>
              </tbody>
            </table>
          </form>
          <!-- Bagian menampilkan semua data bon -->

        </div>

      </div>
    </div>
  </div>
</section>

<!-- Konfirmasi Persetujuan -->
<div id="konfirmasi_persetujuan_bpb" class="modal fade" role="dialog">
  <div class="modal-dialog body-blue">

    <!-- Modal content-->
    <form method="POST">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title fa fa-cube"> <label>Beri Konfirmasi Persetujuan</label></h4>
        </div>
        <div class="modal-body">
          <input type="text" name="id_val_bpb" class="hidden">
          <input type="text" name="id_bpb" class="hidden">
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