<style>
  @media print{
    .col-md-3
    {
      width: 30%;
      float: left;
    }
    .col-md-9
    {
      width: 70%;
      float: left;
    }
  }
</style>

<style type="text/css">
  .body-blue {
    border: 1px solid #3c8dbc;
  }
</style>

<style type="text/css">
  .body-black {
    border: 1px solid black;
  }
</style>

<section class="content">

  <h5 class="hidden-print">
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url("user/home"); ?>"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Transaksi</li>
      <li class="active"><a href="<?php echo base_url("user/production_order/production_order"); ?>" style="color: #777;" onclick="return confirm('Anda yakin hendak meninggalkan halaman ini?')">Production Order</a></li>
      <li class="active">Detail</li>
    </ol>
  </h5>

  <div class="row">

    <div class="col-xs-12">

      <!-- /.box-header -->
      <div class="box body-blue">
        <div class="box-header with-border hidden-print">
          <h3 class="box-title fa fa-building"> Detail Production Order</h3>
        </div>
        <!-- /.box-header -->

        <div class="box-body" style="padding-top: 25px;">

          <!-- text input -->
          <div class="form-group">
            <div class="col-md-12">
              <div class="text-center">
                <h4><b>Production Order Sheet</b></h4>
                <h5><?php echo date('d-m-Y', strtotime($production_order[0]['tgl_order'])); ?></h5>
                <h5><u>No : <?php echo $production_order[0]['no_po']; ?></u></h5>
                <hr style="border: 0px; background-color: transparent;">
              </div>
              
              <!-- Production Order -->
              <div class="col-xs-4">
                <table>
                  <tr>
                    <th width="165">Nama Production Order</th>
                    <td>:</td>
                    <td>&nbsp;<?php echo $production_order[0]['nama_po']; ?></td>
                  </tr>
                  <tr>
                    <th width="150">Buyer</th>
                    <td>:</td>
                    <td>&nbsp;<?php echo $production_order[0]['nama_buyer']; ?></td>
                  </tr>
                  <tr>
                    <th width="150">Style</th>
                    <td>:</td>
                    <td>&nbsp;<?php echo $production_order[0]['nama_style']; ?></td>
                  </tr>
                </table>
              </div>
              <div class="col-xs-3">
                <table>
                  <tr>
                    <th width="70">Qty</th>
                    <td>:</td>
                    <td>&nbsp; <?php echo $production_order[0]['qty']." Pcs"; ?></td>
                  </tr>
                  <tr>
                    <th>Ship Date</th>
                    <td>:</td>
                    <td>&nbsp;
                      <?php if (!empty($production_order[0]['tgl_kirim']=="0000-00-00")): ?>
                        <?php echo "-"; ?>
                      <?php elseif (!empty($production_order[0]['tgl_kirim'])): ?>
                        <?php echo date('d-m-Y', strtotime($production_order[0]['tgl_kirim'])); ?>
                      <?php endif ?>
                    </td>
                  </tr>
                </table>
              </div>
              <!-- Production Order -->

              <!-- Production Order Sheet -->
              <!-- Tanda Tangan Dari Staff PPIC, K.Manager Produksi, Direktur -->
              <div class="col-xs-5">
                <table>
                  <tr align="center">
                    <th class="text-center body-black" width="150"><h5 style="padding-top: 10px;"><b>Staff PPIC</b></h5></th>
                    <th class="text-center body-black" width="233"><h5 style="padding-top: 10px;"><b>K.Manager Produksi</b></h5></th>
                    <th class="text-center body-black" width="150"><h5 style="padding-top: 10px;"><b>Direktur</b></h5></th>
                  </tr>
                  <tr height="80">
                    <td class="text-center body-black" style="font-size: 14px;">
                      <?php if (empty($production_order[0]['konfirmasi'])): ?>
                        <img height="65">
                      <?php elseif (!empty($production_order[0]['konfirmasi'])): ?>
                        <img src="<?php echo base_url("assets/images/ttd/ttd_rolisa.jpg"); ?>" height="65">
                      <?php endif ?>
                    </td>
                    <td class="text-center body-black" style="font-size: 14px;">
                      <?php if (empty($production_order[0]['validasi_po'][1]['status_pengajuan']) OR $production_order[0]['validasi_po'][1]['status_pengajuan']=="Ditolak"): ?>
                        <img height="65">
                      <?php elseif ($production_order[0]['validasi_po'][1]['status_pengajuan']=="Disetujui"): ?>
                        <img src="<?php echo base_url("assets/images/ttd/ttd_rolisa.jpg"); ?>" height="65">
                      <?php endif ?>
                    </td>
                    <td class="text-center body-black" style="font-size: 14px;">
                      <?php if (empty($production_order[0]['validasi_po'][2]['status_pengajuan']) OR $production_order[0]['validasi_po'][2]['status_pengajuan']=="Ditolak"): ?>
                        <img height="65">
                      <?php elseif ($production_order[0]['validasi_po'][2]['status_pengajuan']=="Disetujui"): ?>
                        <img src="<?php echo base_url("assets/images/ttd/ttd_rolisa.jpg"); ?>" height="65">
                      <?php endif ?>
                    </td>
                  </tr>
                </table>
              </div>
              <!-- Tanda Tangan Dari Staff PPIC, K.Manager Produksi, Direktur -->
              
              <!-- Spesifik Material -->
              <div class="col-xs-6"><br>
                <table>
                  <!-- Header -->
                  <tr align="center">
                    <th colspan="7" class="text-center body-black"><h5 style="padding-top: 10px;"><b>Colour</b></h5></th>
                  </tr>
                  <tr>
                    <td class="text-center body-black" width="100" height="30" style="font-size: 14px;"><b>Leather</b></td>
                    <td class="text-center body-black" width="100" style="font-size: 14px;"><b>Velcro</b></td>
                    <td class="text-center body-black" width="200" style="font-size: 14px;"><b>Logo</b></td>
                    <td class="text-center body-black" width="100" style="font-size: 14px;"><b>PU Tape</b></td>
                    <td class="text-center body-black" width="100" style="font-size: 14px;"><b>Lycra</b></td>
                    <td class="text-center body-black" width="100" style="font-size: 14px;"><b>Patch</b></td>
                  </tr>
                  <!-- / Header -->

                  <!-- <pre><?php print_r($production_order); ?></pre> -->

                  <!-- Record -->
                  <?php foreach ($production_order[0]['colour_pos'] as $key => $value): ?>
                    <tr>
                      <td class="text-center body-black" height="30" style="font-size: 14px;"><?php echo $value['leather']; ?></td>
                      <td class="text-center body-black" style="font-size: 14px;"><?php echo $value['velcro']; ?></td>
                      <td class="text-center body-black" style="font-size: 14px;"><?php echo $value['logo']; ?></td>
                      <td class="text-center body-black" style="font-size: 14px;"><?php echo $value['pu_tape']; ?></td>
                      <td class="text-center body-black" style="font-size: 14px;">
                        <?php if (!empty($value['lycra'])): ?>
                          <?php echo $value['lycra']; ?>
                        <?php elseif (empty($value['lycra'])): ?>
                          <?php echo "No Lycra"; ?>
                        <?php endif ?>
                      </td>
                      <td class="text-center body-black" style="font-size: 14px;">
                        <?php if (!empty($value['patch'])): ?>
                          <?php echo $value['patch']; ?>
                        <?php elseif (empty($value['patch'])): ?>
                          <?php echo "No Patch"; ?>
                        <?php endif ?>
                      </td>
                    </tr>
                  <?php endforeach ?>
                  <!-- Record -->
                </table>
              </div>
              <!-- Spesifik Material -->
              
              <!-- Hands of Mens Cadet -->
              <div class="col-xs-3"><br>
                <table>
                  <!-- Header -->
                  <tr align="center">
                    <th colspan="4" class="text-center body-black" width="500"><h5 style="padding-top: 10px;"><b>Mens Cadet</b></h5></th>
                  </tr>
                  <tr>
                    <td class="text-center body-black" width="50" height="30" style="font-size: 14px;"><b>No</b></td>
                    <td class="text-center body-black" width="80" style="font-size: 14px;"><b>Hands</b></td>
                    <td class="text-center body-black" width="60" style="font-size: 14px;"><b>Size</b></td>
                    <td class="text-center body-black" width="100" style="font-size: 14px;"><b>Qty (Pcs)</b></td>
                  </tr>
                  <!-- / Header -->

                  <!-- Record -->
                  <?php foreach ($production_order[0]['mens_cadet'] as $key => $value): ?>
                    <tr>
                      <td class="text-center body-black" height="30" style="font-size: 14px;"><?php echo $key+1; ?></td>
                      <td class="text-center body-black" style="font-size: 14px;"><?php echo $value['hands']; ?></td>
                      <td class="text-center body-black" style="font-size: 14px;"><?php echo $value['size']; ?></td>
                      <td class="text-center body-black" style="font-size: 14px;"><?php echo $value['qty']; ?></td>
                    </tr>
                  <?php endforeach ?>

                  <?php $total=0; ?>

                  <?php foreach ($production_order[0]['mens_cadet'] as $key => $value): ?>
                    <?php $total+=$value['qty']; ?>
                  <?php endforeach ?>

                  <tr>
                    <td colspan="3" class="text-center body-black" height="30" style="font-size: 14px;">Qty Total</td>
                    <td class="text-center body-black" style="font-size: 14px;"><?php echo $total; ?></td>
                  </tr>
                  <!-- Record -->
                </table>
              </div>
              <!-- Hands of Mens Cadet -->
              
              <!-- Hands of Ladies Cadet -->
              <div class="col-xs-3"><br>
                <table>
                  <!-- Header -->
                  <tr align="center">
                    <th colspan="4" class="text-center body-black"><h5 style="padding-top: 10px;"><b>Ladies Cadet</b></h5></th>
                  </tr>
                  <tr>
                    <td class="text-center body-black" width="50" height="30" style="font-size: 14px;"><b>No</b></td>
                    <td class="text-center body-black" width="80" style="font-size: 14px;"><b>Hands</b></td>
                    <td class="text-center body-black" width="60" style="font-size: 14px;"><b>Size</b></td>
                    <td class="text-center body-black" width="100" style="font-size: 14px;"><b>Qty (Pcs)</b></td>
                  </tr>
                  <!-- / Header -->

                  <?php $nomor = 0 ?>

                  <!-- Record -->
                  <?php foreach ($production_order[0]['ladies_cadet'] as $key => $value): ?>
                    <tr>
                      <?php if (!empty($value['size'])): ?>
                        <td class="text-center body-black" height="30" style="font-size: 14px;"><?php echo $key+1; ?></td>
                        <td class="text-center body-black" style="font-size: 14px;"><?php echo $value['hands']; ?></td>
                        <td class="text-center body-black" style="font-size: 14px;"><?php echo $value['size']; ?></td>
                        <td class="text-center body-black" style="font-size: 14px;"><?php echo $value['qty']; ?></td>
                      <!-- <?php //elseif (empty($value['size'])): ?> -->
                      <?php endif ?>
                    </tr>
                  <?php endforeach ?>

                  <?php $total1 = 0; ?>
                  
                  <?php foreach ($production_order[0]['ladies_cadet'] as $key => $value): ?>
                    <?php $total1+=$value['qty']; ?>
                  <?php endforeach ?>

                  <tr>
                    <td colspan="3" class="text-center body-black" height="30" style="font-size: 14px;">Qty Total</td>
                    <td class="text-center body-black" style="font-size: 14px;"><?php echo $total1; ?></td>
                  </tr>
                  <!-- Record -->
                </table><br>

                <table>
                  <!-- Header -->

                  <?php $sub_total = $total + $total1; ?>

                  <tr>
                    <td class="text-center body-black" width="190" height="30" style="font-size: 14px;">Sub Total</td>
                    <td class="text-center body-black" width="100" style="font-size: 14px;"><?php echo $sub_total; ?></td>
                  </tr>
                  <!-- Record -->
                </table>
              </div>
              <!-- Hands of Ladies Cadet -->

              <!-- Foto Sarung Tangan -->
              <div class="col-xs-6"><br>
                <table>
                  <!-- Header -->
                  <tr>
                    <td class="text-center body-black" height="30" style="font-size: 14px;"><b>Back</b></td>
                    <td class="text-center body-black" style="font-size: 14px;"><b>Palm</b></td>
                  </tr>
                  <!-- / Header -->

                  <!-- Record -->
                  <tr height="300">
                    <td colspan="2" class="text-center body-black" width="1000" style="font-size: 14px;">
                      <img class="profile-user-img img-thumbnail" style="width:450px; height: 300px;" src="<?php echo base_url("assets/images/foto_glove/".$production_order[0]['foto_glove']); ?>"  alt="Foto GLove" >
                    </td>
                  </tr>
                  <!-- Record -->
                </table>
                <br>
                <form method="POST">
                  <!-- <button class="btn btn-primary fa fa-arrow-right hidden-print" name="selanjutnya" value="selanjutnya" title="Detail PPIC" data-content="Popover body content is set in this attribute."> Selanjutnya</button> -->
                </form>
              </div>
              <!-- Foto Sarung Tangan -->

              <!-- Packing -->
              <div class="col-xs-3"><br>
                <table>
                  <!-- Header -->
                  <tr>
                    <td class="text-center body-black" height="30" style="font-size: 14px;"><b>Keterangan</b></td>
                  </tr>
                  <!-- / Header -->

                  <!-- Record -->
                  <tr height="225">
                    <td class="text-left body-black" width="500" style="font-size: 14px; padding-left: 10px;">
                      <p><?php echo $production_order[0]['keterangan']; ?></p>
                    </td>
                  </tr>
                  <!-- Record -->
                </table><br>

                <!-- Checklist Body, Thumb, Machi dan Velcro -->
                <table>
                  <!-- Header -->
                  <tr>
                    <td class="text-center body-black" width="100" height="30" style="font-size: 14px;"><b>Body</b></td>
                    <td class="text-center body-black" width="100" style="font-size: 14px;"><b>Thumb</b></td>
                    <td class="text-center body-black" width="100" style="font-size: 14px;"><b>Machi</b></td>
                    <td class="text-center body-black" width="100" style="font-size: 14px;"><b>Velcro</b></td>
                  </tr>
                  <!-- / Header -->

                  <!-- Record -->
                  <tr>
                    <td class="text-center body-black" height="30" style="font-size: 14px;"><?php echo $production_order[0]['body']; ?></td>
                    <td class="text-center body-black" style="font-size: 14px;"><?php echo $production_order[0]['thumb']; ?></td>
                    <td class="text-center body-black" style="font-size: 14px;"><?php echo $production_order[0]['machi']; ?></td>
                    <td class="text-center body-black" style="font-size: 14px;"><?php echo $production_order[0]['velcro']; ?></td>
                  </tr>
                  <!-- Record -->
                </table><br><br>
                <!-- Checklist Body, Thumb, Machi dan Velcro -->
              </div>
              <!-- Packing -->

              <!-- Remark -->
              <div class="col-xs-3"><br>
                <table>
                  <!-- Header -->
                  <tr>
                    <td class="text-center body-black" height="30" style="font-size: 14px;"><b>Remark</b></td>
                  </tr>
                  <!-- / Header -->

                  <!-- Record -->
                  <tr>
                    <td class="text-left body-black" width="290" style="font-size: 14px;">
                      <?php echo $production_order[0]['remark']; ?>
                    </td>
                  </tr>
                  <!-- Record -->
                </table><br>

              </div>
              <!-- Remark --> 

              <!-- Production Order Sheet -->

            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <div class="row">

    <div class="col-xs-12">

      <!-- /.box-header -->
      <div class="box body-blue">
        <div class="box-header with-border hidden-print">
          <h3 class="box-title fa fa-building"> Detail Production Order</h3>
        </div>
        <!-- /.box-header -->

        <div class="box-body" style="padding-top: 25px;">
          <!-- text input -->
          <div class="form-group">
            <div class="col-md-12">

              <!-- Production Order -->
              <div class="col-xs-6">
                <h4><b>Production Planning Inventory And Control (PPIC)</b></h4>
                <table>
                  <tr>
                    <th width="100">Tanggal Order</th>
                    <td>:</td>
                    <td>&nbsp;<?php echo date('d-m-Y', strtotime($production_order[0]['tgl_order'])); ?></td>
                  </tr>
                  <tr>
                    <th width="100">Style</th>
                    <td>:</td>
                    <td>&nbsp;<?php echo $production_order[0]['nama_style']; ?></td>
                  </tr>
                  <tr>
                    <th width="100">Qty</th>
                    <td>:</td>
                    <td>&nbsp;<?php echo $production_order[0]['qty']; ?></td>
                  </tr>
                </table>
              </div>
              <!-- Production Order -->

              <!-- Production Order Sheet -->
              <!-- Tanda Tangan Dari Staff PPIC, K.Manager Produksi, Direktur -->
              <div class="col-xs-6">
                <table>
                  <tr align="center">
                    <th class="text-center body-black" width="150"><h5 style="padding-top: 10px;"><b>Staff PPIC</b></h5></th>
                    <th class="text-center body-black" width="165"><h5 style="padding-top: 10px;"><b>Kepala Gudang</b></h5></th>
                    <th class="text-center body-black" width="183"><h5 style="padding-top: 10px;"><b>K.Manager Produksi</b></h5></th>
                    <th class="text-center body-black" width="150"><h5 style="padding-top: 10px;"><b>Direktur</b></h5></th>
                  </tr>
                  <tr height="80">
                    <td class="text-center body-black" style="font-size: 14px;">
                      <?php if (empty($production_order[0]['konfirmasi'])): ?>
                        <img height="65">
                      <?php elseif (!empty($production_order[0]['konfirmasi'])): ?>
                        <img src="<?php echo base_url("assets/images/ttd/ttd_rolisa.jpg"); ?>" height="65">
                      <?php endif ?>
                    </td>
                    <td class="text-center body-black" style="font-size: 14px;">
                      <?php if (empty($production_order[0]['validasi_po'][0]['status_pengajuan']) OR $production_order[0]['validasi_po'][0]['status_pengajuan']=="Ditolak"): ?>
                        <img height="65">
                      <?php elseif ($production_order[0]['validasi_po'][0]['status_pengajuan']=="Disetujui"): ?>
                        <img src="<?php echo base_url("assets/images/ttd/ttd_rolisa.jpg"); ?>" height="65">
                      <?php endif ?>
                    </td>
                    <td class="text-center body-black" style="font-size: 14px;">
                      <?php if (empty($production_order[0]['validasi_po'][1]['status_pengajuan']) OR $production_order[0]['validasi_po'][1]['status_pengajuan']=="Ditolak"): ?>
                        <img height="65">
                      <?php elseif ($production_order[0]['validasi_po'][1]['status_pengajuan']=="Disetujui"): ?>
                        <img src="<?php echo base_url("assets/images/ttd/ttd_rolisa.jpg"); ?>" height="65">
                      <?php endif ?>
                    </td>
                    <td class="text-center body-black" style="font-size: 14px;">
                      <?php if (empty($production_order[0]['validasi_po'][2]['status_pengajuan']) OR $production_order[0]['validasi_po'][2]['status_pengajuan']=="Ditolak"): ?>
                        <img height="65">
                      <?php elseif ($production_order[0]['validasi_po'][2]['status_pengajuan']=="Disetujui"): ?>
                        <img src="<?php echo base_url("assets/images/ttd/ttd_rolisa.jpg"); ?>" height="65">
                      <?php endif ?>
                    </td>
                  </tr>
                </table>
              </div>
              <!-- Tanda Tangan Dari Staff PPIC, K.Manager Produksi, Direktur -->

              <!-- PPIC -->
              <div class="col-xs-12"><br>
                <table>
                  <!-- Header -->
                  <tr align="center">
                    <th rowspan="2" class="text-center body-black" width="40"><h5 style="padding-top: 10px;"><b>No</b></h5></th>
                    <th rowspan="2" class="text-center body-black" width="200"><h5 style="padding-top: 10px;"><b>Nama Barang</b></h5></th>
                    <th rowspan="2" class="text-center body-black" width="80"><h5 style="padding-top: 10px;"><b>Warna</b></h5></th>
                    <th colspan="4" class="text-center body-black"><h5 style="padding-top: 10px;"><b>Kebutuhan Sebelum Produksi</b></h5></th>
                    <th rowspan="2" class="text-center body-black" width="70"><h5 style="padding-top: 10px;"><b>Satuan</b></h5></th>
                    <th rowspan="2" class="text-center body-black" width="70"><h5 style="padding-top: 10px;"><b>Stock</b></h5></th>
                    <th rowspan="2" class="text-center body-black" width="100"><h5 style="padding-top: 10px;"><b>Kekurangan</b></h5></th>
                    <th rowspan="2" class="text-center body-black" width="100"><h5 style="padding-top: 10px;"><b>Supplier</b></h5></th>
                    <th rowspan="2" class="text-center body-black" width="100"><h5 style="padding-top: 10px;"><b>Rendement (Meter)</b></h5></th>
                    <th colspan="2" class="text-center body-black"><h5 style="padding-top: 10px;"><b>Actual Pemakaian</b></h5></th>
                  </tr>
                  <tr>
                    <td class="text-center body-black" width="80" style="font-size: 14px;"><b>Order</b></td>
                    <td class="text-center body-black" width="80" style="font-size: 14px;"><b>Satu Pcs</b></td>
                    <td class="text-center body-black" width="80" style="font-size: 14px;"><b>Rendement (Meter)</b></td>
                    <td class="text-center body-black" width="80" style="font-size: 14px;"><b>Total Kebutuhan</b></td>
                    <td class="text-center body-black" width="110" style="font-size: 14px;"><b>Total Produksi</b></td>
                    <td class="text-center body-black" width="186" style="font-size: 14px;"><b>Remarks</b></td>
                  </tr>
                  <tr>

                  </tr>
                  <!-- / Header -->

                  <!-- Record -->
                  <?php foreach ($ppic as $key => $value): ?>
                    <tr>
                      <td class="text-center body-black" height="30" style="font-size: 14px;"><?php echo $key+1; ?></td>
                      <td class="text-center body-black" style="font-size: 14px;"><?php echo $value['nama_barang']; ?></td>
                      <td class="text-center body-black" style="font-size: 14px;">
                        <?php if (!empty($value['warna'])): ?>
                          <?php echo $value['warna']; ?>
                        <?php elseif (empty($value['warna'])): ?>
                          <?php echo "-"; ?>
                        <?php endif ?>
                      </td>
                      <td class="text-center body-black" style="font-size: 14px;"><?php echo $value['ksp'][0]['order']; ?></td>
                      <td class="text-center body-black" style="font-size: 14px;"><?php echo $value['ksp'][0]['per_pcs']; ?></td>
                      <td class="text-center body-black" style="font-size: 14px;"><?php echo $value['ksp'][0]['rendement_per_meter']; ?></td>
                      <td class="text-center body-black" style="font-size: 14px;"><?php echo $value['ksp'][0]['total_kebutuhan']; ?></td>
                      <td class="text-center body-black" style="font-size: 14px;"><?php echo $value['satuan']; ?></td>
                      <td class="text-center body-black" style="font-size: 14px;"><?php echo $value['stok']; ?></td>

                      <?php if (!empty($value['ksp'])): ?>
                        <?php $kekurangan = $value['stok'] - $value['ksp'][0]['total_kebutuhan']; ?>
                      <?php endif ?>

                      <td class="text-center body-black" style="font-size: 14px;">
                        <?php if (!empty($value['ksp'])): ?>
                          <?php if ($kekurangan<0): ?>
                            <?php echo $kekurangan; ?>
                          <?php elseif ($kekurangan>0): ?>
                            <?php echo "-"; ?>
                          <?php endif ?>
                        <?php endif ?>
                      </td>
                      <td class="text-center body-black" style="font-size: 14px;">
                        <?php if ($value['id_supplier']==0): ?>
                          <?php echo "-"; ?>
                        <?php elseif ($value['id_supplier']!==0): ?>
                          <?php echo $value['nama_supplier']; ?>
                        <?php endif ?>
                      </td>
                      <td class="text-center body-black" style="font-size: 14px;">
                        <?php if ($value['rendement_satu_meter']==0): ?>
                          <?php echo "-"; ?>
                        <?php elseif ($value['rendement_satu_meter']!==0): ?>
                          <?php echo $value['rendement_satu_meter']; ?>
                        <?php endif ?>
                      </td>  
                      <td class="text-center body-black" style="font-size: 14px;">
                        <?php if (!empty($value['ap'][0])): ?>
                          <?php if ($value['ap'][0]['total_produksi']==0): ?>
                            <?php echo "-"; ?>
                          <?php elseif ($value['ap'][0]['total_produksi']!==0): ?>
                            <?php echo $value['ap'][0]['total_produksi']; ?>
                          <?php endif ?>
                        <?php endif ?>
                      </td>
                      <td class="text-center body-black" style="font-size: 14px;">
                        <?php if (empty($value['ap'][0]['remark'])): ?>
                          <?php echo "-"; ?>
                        <?php elseif (!empty($value['ap'][0]['remark'])): ?>
                          <?php echo $value['ap'][0]['remark']; ?>
                        <?php endif ?>
                      </td>
                    </tr>
                  <?php endforeach ?>
                  <!-- Record -->
                </table><br>
                <!-- <button class="btn btn-primary fa fa-print hidden-print" onclick="window.print()"> Cetak PDF</button>&nbsp; -->
              </div>
              <!-- PPIC -->

              <!-- Production Order Sheet -->
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

</section><style>