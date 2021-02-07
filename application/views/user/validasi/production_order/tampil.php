<section class="content">

  <h5>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url("user/home"); ?>"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Validasi</li>
      <li class="active"><a href="<?php echo base_url("user/validasi/production_order"); ?>" style="color: #777;">Production Order</a></li>
    </ol>
  </h5>

  <div class="row">
    <div class="col-xs-12">
      <div class="panel panel-heading">
        <div class="box-header">
          <h3 class="box-title fa fa-check"> Validasi Production Order</h3>
          <hr>

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
                  <th style="padding-left: 10px;">Tanggal Pengiriman</th>
                  <th style="padding-left: 10px;">
                    <div class="input-group">
                      <input type="text" id="datepicker1" class="form-control" name="tgl_kirim" placeholder="22-10-2018" size="6">
                    </div>
                  </th>
                  <th style="padding-left: 10px;">
                    <button class="btn btn-primary fa fa-search" name="cari" value="cari" title="Cari" data-content="Popover body content is set in this attribute."> Cari</button>
                  </th>
                </tr>
              </thead>
            </table>
          </form>

        </div>
        <!-- <pre><?php //print_r($production_order); ?></pre> -->
        <div class="box-body ">
          <form method="POST">
            <table class="table table-bordered table-striped" id="example1"> 
              <thead style="background-color: #D3D3D3">
                <tr>
                  <th class="text-center" width="20">No</th>
                  <th class="text-center">No.Production Order</th>
                  <th class="text-center">Nama Production Order</th>
                  <th class="text-center">Buyer</th>
                  <th class="text-center">Qty</th>
                  <th class="text-center" width="90">Tanggal Diajukan</th>
                  <th class="text-center">Asal</th>
                  <th class="text-center">Perihal</th>
                  <th class="text-center" width="90">Tanggal Dikonfirmasi</th>
                  <th class="text-center">Status</th>
                  <th class="text-center">Aksi</th>
                </tr>
              </thead>

              <?php $no=1; ?>

              <tbody>
                <?php if($_SESSION['user']['level']=="Kepala Gudang"): ?>
                  <?php foreach ($production_order as $key => $value): ?>
                    <?php if (!empty($value['validasi'])): ?>
                      <?php if ($value['validasi'][0]['tujuan']=="Kepala Gudang"): ?>
                        <tr>
                          <td class="text-center"><?php echo $no++; ?></td>
                          <td class="text-center"><?php echo $value['no_po']; ?></td>
                          <td class="text-center"><?php echo $value['nama_po']; ?></td>
                          <td class="text-center"><?php echo $value['nama_buyer']; ?></td>
                          <td class="text-center"><?php echo $value['qty']." Pcs"; ?></td>
                          <td class="text-center"><?php echo $value['validasi'][0]['tgl_diajukan']; ?></td>
                          <td class="text-center"><?php echo $value['validasi'][0]['yang_meminta']; ?></td>
                          <td class="text-center"><?php echo $value['validasi'][0]['perihal']; ?></td>
                          <td class="text-center">
                            <?php if ($value['validasi'][0]['tgl_dikonfirmasi']=="0000-00-00"): ?>
                              <?php echo "-"; ?>
                            <?php elseif (!empty($value['validasi'][0]['tgl_dikonfirmasi'])): ?>
                              <?php echo $value['validasi'][0]['tgl_dikonfirmasi']; ?>
                            <?php endif ?>
                          </td>
                          <td class="text-center">
                            <?php if(!empty($value['validasi'][0]['status_pengajuan']=="Disetujui")): ?>
                              <a class="btn-success btn-sm" title="Kepala Gudang telah menyetujui data Production Order" data-content="Popover body content is set in this attribute."><i class="fa fa-check"></i> <?php echo $value['validasi'][0]['status_pengajuan']; ?></a>
                            <?php elseif(!empty($value['validasi'][0]['status_pengajuan']=="Ditolak")): ?>
                              <a class="btn-danger btn-sm" title="Kepala Gudang telah menolak data Production Order" data-content="Popover body content is set in this attribute."><i class="fa fa-close"></i> <?php echo $value['validasi'][0]['status_pengajuan']; ?></a>
                            <?php else: ?>
                              <a class="btn-warning btn-sm" readonly title="Klik tombol Konfirmasi Persetujuan pada kolom aksi" data-content="Popover body content is set in this attribute."><i class="fa fa-warning"></i> Mohon Dikonfirmasi</a>
                            <?php endif ?>
                          </td>
                          <td class="text-center">

                            <!-- Detail -->
                            <a href="<?php echo base_url("user/validasi/production_order/detail/$value[id_po]"); ?>" class="btn btn-primary btn-sm fa fa-info" title="Detail" data-content="Popover body content is set in this attribute." ></a>
                            <!-- Detail -->

                            <!-- Konfirmasi Persetujuan -->
                            <?php if (empty($value['validasi'][0]['status_pengajuan'])): ?>
                              <a href="#" class="konfirm-persetujuan-po btn btn-default btn-sm fa fa-check" title="Konfirmasi Persetujuan" data-content="Popover body content is set in this attribute." data-id="<?php echo $value['validasi'][0]['id_val_po']; ?>"></a>
                            <?php endif ?>
                            <!-- Konfirmasi Persetujuan -->

                          </td>
                        </tr>
                      <?php endif ?>
                    <?php endif ?>
                  <?php endforeach ?>

                <?php elseif($_SESSION['user']['level']=="Kepala Divisi Production Manager"): ?>
                  <?php foreach ($production_order as $key => $value): ?>
                    <?php if (!empty($value['validasi'])): ?>
                      <?php if ($value['validasi'][1]['tujuan']=="Kepala Divisi Production Manager"): ?>
                        <tr>
                          <td class="text-center"><?php echo $no++; ?></td>
                          <td class="text-center"><?php echo $value['no_po']; ?></td>
                          <td class="text-center"><?php echo $value['nama_po']; ?></td>
                          <td class="text-center"><?php echo $value['nama_buyer']; ?></td>
                          <td class="text-center"><?php echo $value['qty']." Pcs"; ?></td>
                          <td class="text-center"><?php echo $value['validasi'][1]['tgl_diajukan']; ?></td>
                          <td class="text-center"><?php echo $value['validasi'][1]['yang_meminta']; ?></td>
                          <td class="text-center"><?php echo $value['validasi'][1]['perihal']; ?></td>
                          <td class="text-center">
                            <?php if ($value['validasi'][1]['tgl_dikonfirmasi']=="0000-00-00"): ?>
                              <?php echo "-"; ?>
                            <?php elseif (!empty($value['validasi'][1]['tgl_dikonfirmasi'])): ?>
                              <?php echo $value['validasi'][1]['tgl_dikonfirmasi']; ?>
                            <?php endif ?>
                          </td>
                          <td class="text-center">
                            <?php if(!empty($value['validasi'][1]['status_pengajuan']=="Disetujui")): ?>
                              <a class="btn-success btn-sm" title="Kepala Divisi Production Manager telah menyetujui data Production Order" data-content="Popover body content is set in this attribute."><i class="fa fa-check"></i> <?php echo $value['validasi'][1]['status_pengajuan']; ?></a>
                            <?php elseif(!empty($value['validasi'][1]['status_pengajuan']=="Ditolak")): ?>
                              <a class="btn-danger btn-sm" title="Kepala Divisi Production Manager telah menolak data Production Order" data-content="Popover body content is set in this attribute."><i class="fa fa-close"></i> <?php echo $value['validasi'][1]['status_pengajuan']; ?></a>
                            <?php else: ?>
                              <a class="btn-warning btn-sm" readonly title="Klik tombol Konfirmasi Persetujuan pada kolom aksi" data-content="Popover body content is set in this attribute."><i class="fa fa-warning"></i> Mohon Dikonfirmasi</a>
                            <?php endif ?>
                          </td>
                          <td class="text-center">

                            <!-- Detail -->
                            <a href="<?php echo base_url("user/validasi/production_order/detail/$value[id_po]"); ?>" class="btn btn-primary btn-sm fa fa-info" title="Detail" data-content="Popover body content is set in this attribute." ></a>
                            <!-- Detail -->

                            <!-- Konfirmasi Persetujuan -->
                            <?php if (empty($value['validasi'][1]['status_pengajuan'])): ?>
                              <a href="#" class="konfirm-persetujuan-po btn btn-default btn-sm fa fa-check" title="Konfirmasi Persetujuan" data-content="Popover body content is set in this attribute." data-id="<?php echo $value['validasi'][1]['id_val_po']; ?>"></a>
                            <?php endif ?>
                            <!-- Konfirmasi Persetujuan -->

                          </td>
                        </tr>
                      <?php endif ?>
                    <?php endif ?>
                  <?php endforeach ?>

                <?php elseif($_SESSION['user']['level']=="Direktur"): ?>
                  <?php foreach ($production_order as $key => $value): ?>
                    <?php if (!empty($value['validasi'])): ?>
                      <?php if ($value['validasi'][2]['tujuan']=="Direktur"): ?>
                        <tr>
                          <td class="text-center"><?php echo $no++; ?></td>
                          <td class="text-center"><?php echo $value['no_po']; ?></td>
                          <td class="text-center"><?php echo $value['nama_po']; ?></td>
                          <td class="text-center"><?php echo $value['nama_buyer']; ?></td>
                          <td class="text-center"><?php echo $value['qty']." Pcs"; ?></td>
                          <td class="text-center"><?php echo $value['validasi'][2]['tgl_diajukan']; ?></td>
                          <td class="text-center"><?php echo $value['validasi'][2]['yang_meminta']; ?></td>
                          <td class="text-center"><?php echo $value['validasi'][2]['perihal']; ?></td>
                          <td class="text-center">
                            <?php if ($value['validasi'][2]['tgl_dikonfirmasi']=="0000-00-00"): ?>
                              <?php echo "-"; ?>
                            <?php elseif (!empty($value['validasi'][2]['tgl_dikonfirmasi'])): ?>
                              <?php echo $value['validasi'][2]['tgl_dikonfirmasi']; ?>
                            <?php endif ?>
                          </td>
                          <td class="text-center">
                            <?php if(!empty($value['validasi'][2]['status_pengajuan']=="Disetujui")): ?>
                              <a class="btn-success btn-sm" title="Direktur telah menyetujui data Production Order" data-content="Popover body content is set in this attribute."><i class="fa fa-check"></i> <?php echo $value['validasi'][2]['status_pengajuan']; ?></a>
                            <?php elseif(!empty($value['validasi'][2]['status_pengajuan']=="Ditolak")): ?>
                              <a class="btn-danger btn-sm" title="Direktur telah menolak data Production Order" data-content="Popover body content is set in this attribute."><i class="fa fa-close"></i> <?php echo $value['validasi'][2]['status_pengajuan']; ?></a>
                            <?php else: ?>
                              <a class="btn-warning btn-sm" readonly title="Klik tombol Konfirmasi Persetujuan pada kolom aksi" data-content="Popover body content is set in this attribute."><i class="fa fa-warning"></i> Mohon Dikonfirmasi</a>
                            <?php endif ?>
                          </td>
                          <td class="text-center">

                            <!-- Detail -->
                            <a href="<?php echo base_url("user/validasi/production_order/detail/$value[id_po]"); ?>" class="btn btn-primary btn-sm fa fa-info" title="Detail" data-content="Popover body content is set in this attribute." ></a>
                            <!-- Detail -->

                            <!-- Konfirmasi Persetujuan -->
                            <?php if (empty($value['validasi'][2]['status_pengajuan'])): ?>
                              <a href="#" class="konfirm-persetujuan-po btn btn-default btn-sm fa fa-check" title="Konfirmasi Persetujuan" data-content="Popover body content is set in this attribute." data-id="<?php echo $value['validasi'][2]['id_val_po']; ?>"></a>
                            <?php endif ?>
                            <!-- Konfirmasi Persetujuan -->

                          </td>
                        </tr>
                      <?php endif ?>
                    <?php endif ?>
                  <?php endforeach ?>
                <?php endif ?>

              </tbody>
            </table>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Konfirmasi Persetujuan -->
<div id="konfirmasi_persetujuan_po" class="modal fade" role="dialog">
  <div class="modal-dialog body-blue">

    <!-- Modal content-->
    <form method="POST">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title fa fa-cube"> <label>Beri Konfirmasi Persetujuan</label></h4>
        </div>
        <div class="modal-body">
          <input type="text" name="id_val_po" class="hidden">
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