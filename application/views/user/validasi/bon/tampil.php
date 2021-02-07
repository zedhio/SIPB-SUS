<section class="content">

  <h5>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url("user/home"); ?>"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Validasi</li>
      <li class="active"><a href="<?php echo base_url("user/validasi/bon"); ?>" style="color: #777;">Data BON Pengeluaran Barang</a></li>
    </ol>
  </h5>

  <div class="row">
    <div class="col-xs-12">
      <div class="panel panel-heading">
        <div class="box-header">
          <h3 class="box-title fa fa-check"> Validasi Data BON Pengeluaran Barang</h3>
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
          <!-- Bagian pencarian data bon berdasarkan tanggal -->

        </div>

        <?php if($_SESSION['user']['level']=="Kepala Gudang"): ?>
        <div class="box-body">

          <!-- <pre><?php print_r($bon1); ?></pre> -->

          <!-- Bagian menampilkan semua data bon pengeluaran barang -->
          <form role="form" method="POST" >
            <table class="table table-bordered table-striped table-responsive"> 
              <thead style="background-color: #D3D3D3">
                <tr>
                  <th class="text-center">No</th>
                  <th class="text-center">No.BON</th>
                  <th class="text-center">Tanggal Dibuat</th>
                  <th class="text-center">Untuk P.O</th>
                  <th class="text-center">Buyer</th>
                  <th class="text-center">Style Glove</th>
                  <th class="text-center">Qty Bon</th>
                  <th class="text-center">Status</th>
                  <!-- <th class="text-center">Alasan</th> -->
                  <th class="text-center">Aksi</th>
                </tr>
              </thead>

              <!-- <pre><?php //print_r($bon1); ?></pre> -->

              <?php $no = 1; ?>

              <tbody>
                <?php foreach ($bon1 as $key => $value): ?>
                  <?php if ($value['tujuan']=="Kepala Gudang"): ?>
                    <tr>
                      <td class="text-center" width="30"><?php echo $no++; ?></td>
                      <td class="text-center" width="90"><?php echo $value['no_bon']; ?></td>
                      <td class="text-center" width="105"><?php echo $value['tgl_dibuat']; ?></td>
                      <td class="text-center" width="110"><?php echo $value['nama_po']; ?></td>
                      <td class="text-center" width="130"><?php echo $value['nama_buyer']; ?></td>
                      <td class="text-center" width="130"><?php echo $value['nama_style']; ?></td>
                      <td class="text-center" width="96"><?php echo $value['qty_total']; ?></td>
                      <td class="text-center" width="100">
                        <?php if(!empty($value['status_pengajuan']=="Disetujui")): ?>
                          <a class="btn btn-success btn-sm"><i class="fa fa-check"></i> <?php echo $value['status_pengajuan']; ?></a>
                        <?php elseif(!empty($value['status_pengajuan']=="Ditolak")): ?>
                          <a class="btn btn-danger btn-sm"><i class="fa fa-close"></i> <?php echo $value['status_pengajuan']; ?></a>
                        <?php else: ?>
                          <a class="btn btn-warning btn-sm" readonly><i class="fa fa-warning"></i> Mohon Dikonfirmasi</a>
                        <?php endif ?>
                      </td>
                      <!-- <td class="text-center" width="100">
                        <?php //if(!empty($value['alasan'])): ?>
                          <?php //echo $value['alasan']; ?>
                        <?php //elseif(empty($value['alasan'])): ?>
                          <?php //echo "-"; ?>
                        <?php //endif ?>
                      </td> -->
                      <td class="text-center" width="60">

                        <!-- Detail bon -->
                        <a href="<?php echo base_url("user/validasi/bon/detail/$value[id_bon]"); ?>" class="btn btn-primary btn-sm fa fa-info" title="Detail" data-content="Popover body content is set in this attribute."></a>
                        <!-- Detail bon -->

                        <!-- Konfirmasi Persetujuan -->
                        <?php if (empty($value['status_pengajuan'])): ?>
                          <a href="#" class="konfirm-persetujuan-bon btn btn-default btn-sm fa fa-check" title="Konfirmasi Persetujuan" data-content="Popover body content is set in this attribute." data-id="<?php echo $value['id_val_bon']; ?>"></a>
                        <?php endif ?>
                        <!-- Konfirmasi Persetujuan -->

                      </td>
                    </tr>
                  <?php endif ?>
                <?php endforeach ?>
              </tbody>
            </table>
          </form>
          <!-- Bagian menampilkan semua data bon -->
          
        </div>

        <?php elseif($_SESSION['user']['level']=="Kepala Divisi Production Manager"): ?>
        <div class="box-body">

          <!-- <pre><?php print_r($bon1); ?></pre> -->

          <!-- Bagian menampilkan semua data bon pengeluaran barang -->
          <form role="form" method="POST" >
            <table class="table table-bordered table-striped table-responsive"> 
              <thead style="background-color: #D3D3D3">
                <tr>
                  <th class="text-center">No</th>
                  <th class="text-center">No.BON</th>
                  <th class="text-center">Tanggal Dibuat</th>
                  <th class="text-center">Untuk P.O</th>
                  <th class="text-center">Buyer</th>
                  <th class="text-center">Style Glove</th>
                  <th class="text-center">Qty Yang Diminta</th>
                  <th class="text-center">Status</th>
                  <!-- <th class="text-center">Alasan</th> -->
                  <th class="text-center">Aksi</th>
                </tr>
              </thead>

              <?php $no = 1; ?>

              <tbody>
                <?php foreach ($bon1 as $key => $value): ?>
                  <?php if ($value['tujuan']=="Kepala Divisi Production Manager"): ?>
                    <tr>
                      <td class="text-center" width="30"><?php echo $no++; ?></td>
                      <td class="text-center" width="90"><?php echo $value['no_bon']; ?></td>
                      <td class="text-center" width="105"><?php echo $value['tgl_dibuat']; ?></td>
                      <td class="text-center" width="110"><?php echo $value['nama_po']; ?></td>
                      <td class="text-center" width="130"><?php echo $value['nama_buyer']; ?></td>
                      <td class="text-center" width="130"><?php echo $value['nama_style']; ?></td>
                      <td class="text-center" width="96"><?php echo $value['qty_total']; ?></td>
                      <td class="text-center" width="100">
                        <?php if(!empty($value['status_pengajuan']=="Disetujui")): ?>
                          <a class="btn btn-success btn-sm"><i class="fa fa-check"></i> <?php echo $value['status_pengajuan']; ?></a>
                        <?php elseif(!empty($value['status_pengajuan']=="Ditolak")): ?>
                          <a class="btn btn-danger btn-sm"><i class="fa fa-close"></i> <?php echo $value['status_pengajuan']; ?></a>
                        <?php else: ?>
                          <a class="btn btn-warning btn-sm" readonly><i class="fa fa-warning"></i> Mohon Dikonfirmasi</a>
                        <?php endif ?>
                      </td>
                      <!-- <td class="text-center" width="100">
                        <?php //if(!empty($value['alasan'])): ?>
                          <?php //echo $value['alasan']; ?>
                        <?php //elseif(empty($value['alasan'])): ?>
                          <?php //echo "-"; ?>
                        <?php //endif ?>
                      </td> -->
                      <td class="text-center" width="60">

                        <!-- Detail bon -->
                        <a href="<?php echo base_url("user/validasi/bon/detail/$value[id_bon]"); ?>" class="btn btn-primary btn-sm fa fa-info" title="Detail" data-content="Popover body content is set in this attribute."></a>
                        <!-- Detail bon -->

                        <!-- Konfirmasi Persetujuan -->
                        <?php if (empty($value['status_pengajuan'])): ?>
                          <a href="#" class="konfirm-persetujuan-bon btn btn-default btn-sm fa fa-check" title="Konfirmasi Persetujuan" data-content="Popover body content is set in this attribute." data-id="<?php echo $value['id_val_bon']; ?>"></a>
                        <?php endif ?>
                        <!-- Konfirmasi Persetujuan -->

                      </td>
                    </tr>
                  <?php endif ?>
                <?php endforeach ?>
              </tbody>
            </table>
          </form>
          <!-- Bagian menampilkan semua data bon -->
          
        </div>
        <?php endif ?>

      </div>
    </div>
  </div>
</section>

<!-- Konfirmasi Persetujuan -->
<div id="konfirmasi_persetujuan_bon" class="modal fade" role="dialog">
  <div class="modal-dialog body-blue">

    <!-- Modal content-->
    <form method="POST">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title fa fa-cube"> <label>Beri Konfirmasi Persetujuan</label></h4>
        </div>
        <div class="modal-body">
          <input type="text" name="id_val_bon" class="hidden">
          <div class="form-group">
            <button class="btn btn-success" title="Setuju" name="setuju"  value="setuju" data-content="Popover body content is set in this attribute.">Setuju</button>
            <button class="btn btn-danger" title="Tolak" name="tolak" value="tolak" data-content="Popover body content is set in this attribute.">Tolak</button>
            <input type="text" name="ditolak" value="Ditolak" class="hidden">
          </div>
          <div class="form-group">
            <label>Alasan</label>
            <input type="text" class="form-control" name="alasan">
          </div>
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