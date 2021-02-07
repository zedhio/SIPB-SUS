<section class="content">

  <h5>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url("user/home"); ?>"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Transaksi</li>
      <li class="active"><a href="<?php echo base_url("user/production_order/production_order"); ?>" style="color: #777;">Production Order</a></li>
      <li class="active"><a href="<?php echo base_url("user/production_order/production_order/tambah"); ?>" style="color: #777;">Tambah POS</a></li>
    </ol>
  </h5>

  <div class="row">

    <div class="col-xs-12">

      <!-- /.box-header -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title fa fa-plus"> Form Tambah Production Order Sheet</h3>
          <button type="button" class="close" data-dismiss="modal" onclick="history.back(-1)" title="kembali" data-content="Popover body content is set in this attribute.">&times;</button>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <form role="form" method="POST" enctype="multipart/form-data">
            <!-- text input -->
            <div class="col-md-12">
              <div class="form-group">
                <div class="row">

                  <!-- <pre><?php print_r($production_order); ?></pre>
                  <pre><?php print_r($colour_pos); ?></pre>
                  <pre><?php print_r($hands_mens); ?></pre>
                  <pre><?php print_r($hands_ladies); ?></pre>
                  <pre><?php print_r($kemudian); ?></pre> -->

                  <div class="box-header with-border">
                    <h3 class="box-title" style="font-size: 14px;"> <b>Production Order</b></h3>
                  </div>

                  <div class="box-body">
                    <div class="col-xs-2">
                      <label>No. Production Order</label>
                      <input type="text" class="form-control" name="no_po" value="<?php echo $kode_otomatis; ?>" readonly>  
                    </div>
                    <div class="col-xs-2">
                      <label>Nama Production Order</label>
                      <input type="text" class="form-control" name="nama_po" value="<?php echo $production_order['nama_po']; ?>" placeholder="Contoh: Marcia Glove">
                    </div>
                    <div class="col-xs-3">
                      <label>Buyer</label>
                      <select class="form-control js-example-basic-single" name="id_buyer">
                        <option value="Kosong">------ Pilih ------</option>
                        <?php foreach ($buyer as $key => $value): ?>
                          <option value="<?php echo $value['id_buyer']; ?>" <?php if($production_order['id_buyer']==$value['id_buyer']){echo "selected";} ?>><?php echo $value['nama_buyer']; ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                    <div class="col-xs-2">
                      <label>Qty</label>
                      <div class="input-group">
                        <input type="text" class="form-control" name="qty" placeholder="5650" value="<?php echo $production_order['qty']; ?>">
                        <div class="input-group-addon">
                          Pcs
                        </div>
                      </div>
                    </div>
                    <div class="col-xs-3">
                      <label>Style Glove</label>
                      <select class="form-control js-example-basic-single" name="id_style_glove">
                        <option value="Kosong">--- Pilih ---</option>
                        <?php foreach ($style as $key => $value): ?>
                          <option value="<?php echo $value['id_style_glove']; ?>" <?php if($production_order['id_style_glove']==$value['id_style_glove']){echo "selected";} ?>><?php echo $value['nama_style']; ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                  </div>

                  <div class="box-body">
                    <div class="col-xs-2">
                      <label>Tanggal Order</label>
                      <div class="input-group">
                        <input type="text" id="datepicker" class="form-control" name="tgl_order" value="<?php echo $production_order['tgl_order']; ?>" placeholder="22-10-2018">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar-plus-o"></i>
                        </div>
                      </div>
                    </div>
                    <div class="col-xs-2">
                      <label>Tanggal Pengiriman</label>
                      <div class="input-group">
                        <input type="text" id="datepicker1" class="form-control" name="tgl_kirim" value="<?php echo $production_order['tgl_kirim']; ?>" placeholder="22-10-2018">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar-plus-o"></i>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="box-header with-border">
                    <h3 class="box-title" style="font-size: 14px;"> <b>Color</b></h3>
                  </div>

                  <!-- Tabel Kalkulasi SJM -->
                  <div class="box-body">
                    <div class="col-xs-2">
                      <label>Leather</label>
                      <input type="text" class="form-control" name="leather">
                    </div>
                    <div class="col-xs-2">
                      <label>Velcro</label>
                      <input type="text" class="form-control" name="velcro1">
                    </div>
                    <div class="col-xs-2">
                      <label>Logo</label>
                      <input type="text" class="form-control" name="logo">
                    </div>
                    <div class="col-xs-2">
                      <label>PU.Tape</label>
                      <input type="text" class="form-control" name="pu_tape">
                    </div>
                    <div class="col-xs-2">
                      <label>Lycra</label>
                      <input type="text" class="form-control" name="lycra">
                    </div>
                    <div class="col-xs-2">
                      <label>Patch</label>
                      <input type="text" class="form-control" name="patch">
                    </div>
                  </div>

                  <div class="box-body">
                    <div class="col-xs-12">
                      <button class="btn btn-default fa fa-arrow-down" name="tambah" value="tambah" title="Tambah Record" data-content="Popover body content is set in this attribute."> Tambahkan Record</button>&nbsp;&nbsp;
                      <?php if (empty($colour_pos)): ?>
                        <button name="hapus_record" value="hapus_record" class="btn btn-default btn-sm fa fa-minus-square" title="Kosongkan Record" data-content="Popover body content is set in this attribute." disabled=""> Kosongkan Record</button>
                      <?php elseif (!empty($colour_pos)): ?>
                        <button name="hapus_record" value="hapus_record" class="btn btn-default btn-sm fa fa-minus-square" title="Kosongkan Record" data-content="Popover body content is set in this attribute."> Kosongkan Record</button>
                      <?php endif ?>
                    </div>  
                  </div>

                  <div class="box-body">
                    <div class="col-xs-12">

                      <table class="table table-bordered">
                        <!-- Header -->
                        <tr align="center">
                          <th class="text-center" width="30"><h5 style="padding-top: 10px;"><b>No</b></h5></th>
                          <th class="text-center" width="150"><h5 style="padding-top: 10px;"><b>Leather</b></h5></th>
                          <th class="text-center" width="150"><h5 style="padding-top: 10px;"><b>Velcro</b></h5></th>
                          <th class="text-center" width="200"><h5 style="padding-top: 10px;"><b>Logo</b></h5></th>
                          <th class="text-center" width="150"><h5 style="padding-top: 10px;"><b>PU Tape</b></h5></th>
                          <th class="text-center" width="150"><h5 style="padding-top: 10px;"><b>Lycra</b></h5></th>
                          <th class="text-center" width="150"><h5 style="padding-top: 10px;"><b>Patch</b></h5></th>
                        </tr>
                        <!-- / Header -->

                        <?php $no = 1; ?>

                        <!-- Record -->
                        <?php foreach ($colour_pos as $key => $value): ?>
                          <tr>
                            <td class="text-center" style="font-size: 14px;"><?php echo $no++; ?></td>
                            <td class="text-center" style="font-size: 14px;"><?php echo $value['leather']; ?></td>
                            <td class="text-center" style="font-size: 14px;"><?php echo $value['velcro']; ?></td>
                            <td class="text-center" style="font-size: 14px;"><?php echo $value['logo']; ?></td>
                            <td class="text-center" style="font-size: 14px;"><?php echo $value['pu_tape']; ?></td>
                            <td class="text-center" style="font-size: 14px;">
                              <?php if (!empty($value['lycra'])): ?>
                                <?php echo $value['lycra']; ?>
                              <?php elseif (empty($value['lycra'])): ?>
                                <?php echo "No Lycra"; ?>
                              <?php endif ?>
                            </td>
                            <td class="text-center" style="font-size: 14px;">
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
                  </div>

                </div>
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group">
                <div class="row">

                  <div class="box-header with-border">
                    <h3 class="box-title" style="font-size: 14px;"> <b>Hands</b></h3>
                  </div>

                  <!-- Tabel Kalkulasi SJM -->
                  <div class="box-body">
                    <div class="col-xs-6">
                      <div class="form-group">
                        <div class="row">
                          <div class="box-header with-border">
                            <h3 class="box-title" style="font-size: 14px;"> Mens Cadet</h3>
                          </div>

                          <div class="box-body">
                            <div class="col-xs-3">
                              <label>Hands</label>
                              <div class="radio">
                                <label><input type="radio" name="hands" alt="Radio" value="Left">Left</label>&nbsp;&nbsp;
                                <label><input type="radio" name="hands" alt="Radio" value="Right">Right</label>
                              </div>
                            </div>
                            <div class="col-xs-4">
                              <label>Size</label>
                              <input type="text" name="size1" class="form-control">
                            </div>
                            <div class="col-xs-4">
                              <label>Qty</label>
                              <input type="number" name="qty1" class="form-control">
                            </div>
                          </div>

                          <div class="box-body">
                            <div class="col-xs-12">
                              <button class="btn btn-default fa fa-arrow-down" name="tambah_hands_mens" value="tambah_hands_mens" title="Tambah Record" data-content="Popover body content is set in this attribute."> Tambahkan Record</button>
                              &nbsp;&nbsp;
                              <?php if (empty($hands_mens)): ?>
                                <button name="hapus_record1" value="hapus_record1" class="btn btn-default btn-sm fa fa-minus-square" title="Kosongkan Record" data-content="Popover body content is set in this attribute." disabled=""> Kosongkan Record</button>
                              <?php elseif (!empty($hands_mens)): ?>
                                <button name="hapus_record1" value="hapus_record1" class="btn btn-default btn-sm fa fa-minus-square" title="Kosongkan Record" data-content="Popover body content is set in this attribute."> Kosongkan Record</button>
                              <?php endif ?>
                            </div>  
                          </div>

                          <div class="box-body">
                            <div class="col-xs-12">
                              <table class="table table-bordered">
                                <!-- Header -->
                                <tr align="center">
                                  <th class="text-center" width="30"><h5 style="padding-top: 10px;"><b>No</b></h5></th>
                                  <th class="text-center"><h5 style="padding-top: 10px;"><b>Hands</b></h5></th>
                                  <th class="text-center"><h5 style="padding-top: 10px;"><b>Size</b></h5></th>
                                  <th class="text-center"><h5 style="padding-top: 10px;"><b>Qty (Pcs)</b></h5></th>
                                </tr>
                                <!-- / Header -->

                                <?php $no = 1; $total = 0; ?>

                                <!-- Record -->
                                <?php foreach ($hands_mens as $key => $value): ?>
                                  <tr>
                                    <td class="text-center" style="font-size: 14px;"><?php echo $no++; ?></td>
                                    <td class="text-center" style="font-size: 14px;"><?php echo $value['hands']; ?></td>
                                    <td class="text-center" style="font-size: 14px;"><?php echo $value['size'] ?></td>
                                    <td class="text-center" style="font-size: 14px;"><?php echo $value['qty']; ?></td>
                                  </tr>

                                  <?php 
                                  $total+=$value['qty']; 
                                  ?>

                                <?php endforeach ?>
                                <tr>
                                  <td colspan="3" class="text-center" style="font-size: 14px;"><b>Qty Total</b></td>
                                  <td colspan="2" class="text-center" style="font-size: 14px;"><?php echo $total; ?></td>
                                </tr>
                                <!-- Record -->
                              </table>
                            </div>
                          </div>

                        </div>
                      </div>
                    </div>

                    <div class="col-xs-6">
                      <div class="form-group">
                        <div class="row">
                          <div class="box-header with-border">
                            <h3 class="box-title" style="font-size: 14px;"> Ladies Cadet</h3>
                          </div>

                          <div class="box-body">
                            <div class="col-xs-3">
                              <label>Hands</label>
                              <div class="radio">
                                <label><input type="radio" name="hands2" alt="Radio" value="Left">Left</label>&nbsp;&nbsp;
                                <label><input type="radio" name="hands2" alt="Radio" value="Right">Right</label>
                              </div>
                            </div>
                            <div class="col-xs-4">
                              <label>Size</label>
                              <input type="text" name="size2" class="form-control">
                            </div>
                            <div class="col-xs-4">
                              <label>Qty</label>
                              <input type="number" name="qty2" class="form-control">
                            </div>
                          </div>

                          <div class="box-body">
                            <div class="col-xs-12">
                              <button class="btn btn-default fa fa-arrow-down" name="tambah_hands_ladies" value="tambah_hands_ladies" title="Tambah Record" data-content="Popover body content is set in this attribute."> Tambahkan Record</button>
                              &nbsp;&nbsp;
                              <?php if (empty($hands_ladies)): ?>
                                <button name="hapus_record2" value="hapus_record2" class="btn btn-default btn-sm fa fa-minus-square" title="Kosongkan Record" data-content="Popover body content is set in this attribute." disabled=""> Kosongkan Record</button>
                              <?php elseif (!empty($hands_ladies)): ?>
                                <button name="hapus_record2" value="hapus_record2" class="btn btn-default btn-sm fa fa-minus-square" title="Kosongkan Record" data-content="Popover body content is set in this attribute."> Kosongkan Record</button>
                              <?php endif ?>
                            </div>  
                          </div>

                          <div class="box-body">
                            <div class="col-xs-12">
                              <table class="table table-bordered">
                                <!-- Header -->
                                <tr align="center">
                                  <th class="text-center" width="30"><h5 style="padding-top: 10px;"><b>No</b></h5></th>
                                  <th class="text-center"><h5 style="padding-top: 10px;"><b>Hands</b></h5></th>
                                  <th class="text-center"><h5 style="padding-top: 10px;"><b>Size</b></h5></th>
                                  <th class="text-center"><h5 style="padding-top: 10px;"><b>Qty (Pcs)</b></h5></th>
                                </tr>
                                <!-- / Header -->

                                <?php $no = 1; $total1 = 0; ?>

                                <!-- Record -->
                                <!-- <?php //if ($hands_ladies = 0): ?> -->
                                  <?php foreach ($hands_ladies as $key => $value): ?>
                                    <tr>
                                      <td class="text-center" style="font-size: 14px;"><?php echo $no++; ?></td>
                                      <td class="text-center" style="font-size: 14px;"><?php echo $value['hands']; ?></td>
                                      <td class="text-center" style="font-size: 14px;"><?php echo $value['size'] ?></td>
                                      <td class="text-center" style="font-size: 14px;"><?php echo $value['qty']; ?></td>
                                    </tr>

                                    <?php 
                                    $total1+=$value['qty']; 
                                    ?>

                                  <?php endforeach ?>
                                <!-- <?php //elseif ($hands_ladies != 0): ?>
                                  <?php //foreach ($hands_ladies as $key => $value): ?>
                                    <tr>
                                      <td class="text-center" style="font-size: 14px;"><?php //echo $no++; ?></td>
                                      <td class="text-center" style="font-size: 14px;"><?php //echo $value['hands']; ?></td>
                                      <td class="text-center" style="font-size: 14px;"><?php //echo $value['size'] ?></td>
                                      <td class="text-center" style="font-size: 14px;"><?php //echo $value['qty']; ?></td>
                                    </tr>

                                    <?php 
                                    $total1//+=$value['qty']; 
                                    ?>

                                  <?php //endforeach ?> -->
                                <!-- <?php //endif ?> -->
                                <tr>
                                  <td colspan="3" class="text-center" style="font-size: 14px;"><b>Qty Total</b></td>
                                  <td colspan="2" class="text-center" style="font-size: 14px;"><?php echo $total1; ?></td>
                                </tr>
                                <!-- Record -->
                              </table>
                            </div>
                          </div>

                        </div>
                      </div>
                    </div>

                    <?php $subtotal = 0; ?>

                    <div class="box-body">
                      <div class="col-xs-12 text-center">
                        <?php $subtotal = $total+$total1; ?>
                        <label style="font-size: 16px;">Jumlah keseluruhan untuk Mens dan Ladies Cadet adalah <?php echo $subtotal; ?></label>
                      </div>
                    </div>

                    <div class="col-xs-6">
                      <div class="form-group">
                        <div class="row">
                          <div class="box-header with-border">
                            <h3 class="box-title" style="font-size: 14px;"> Picture Of Gloves (Back / Palm)</h3>
                          </div>

                          <div class="box-body">
                            <div class="col-xs-12">
                              <label>Sisipkan Foto Back / Palm</label>
                              <div class="input-group"  >
                                <span class="input-group-btn">
                                  <span class="btn btn-default btn-file">
                                    Browse… <input type="file" id="imgInp" name="foto_glove">
                                  </span>
                                </span>
                                <input type="text" class="form-control" value="" readonly>
                              </div>
                            </div>
                          </div>

                          <div class="box-body">
                            <div class="col-xs-12">
                              <table align="center">
                                <tr>
                                  <td width="270">
                                    <img class="profile-user-img img-thumbnail" src="<?php echo base_url("assets/images/foto_glove/no-image.png"); ?>" class="profile-user-img img-thumbnail" alt="Foto Glove" id="img-upload">
                                  </td>
                                </tr>
                              </table>
                            </div>
                          </div>

                        </div>
                      </div>
                    </div>

                    <div class="col-xs-6">
                      <div class="form-group">
                        <div class="row">
                          <div class="box-header with-border">
                            <h3 class="box-title" style="font-size: 14px;"> Keterangan</h3>
                          </div>

                          <div class="box-body">
                            <div class="col-xs-12">
                              <label>Keterangan</label>
                              <textarea id="ckeditor" class="ckeditor" name="keterangan" rows="1"></textarea>
                            </div>
                            <div class="col-xs-3" style="padding-top: 20px;">
                              <label>Body</label>
                              <input type="text" name="body" class="form-control" placeholder="">
                            </div>
                            <div class="col-xs-3" style="padding-top: 20px;">
                              <label>Thumb</label>
                              <input type="text" name="thumb" class="form-control" placeholder="">
                            </div>
                            <div class="col-xs-3" style="padding-top: 20px;">
                              <label>Machi</label>
                              <input type="text" name="machi" class="form-control" placeholder="">
                            </div>
                            <div class="col-xs-3" style="padding-top: 20px;">
                              <label>Velcro</label>
                              <input type="text" name="velcro" class="form-control" placeholder="">
                            </div>
                          </div>

                        </div>
                      </div>
                    </div>

                    <div class="col-xs-12">
                      <div class="form-group">
                        <div class="row">
                          <div class="box-header with-border">
                            <h3 class="box-title" style="font-size: 14px;"> Remarks</h3>
                          </div>

                          <div class="box-body">
                            <div class="col-xs-12">
                              <label>Remark</label>
                              <textarea id="ckeditor" class="ckeditor" name="remark" rows="1"></textarea>
                            </div>
                          </div>

                          <div class="box-body">
                            <div class="col-xs-12">
                              <button class="btn btn-primary fa fa-arrow-right" name="kemudian" value="kemudian" title="Selanjutnya" data-content="Popover body content is set in this attribute."> Selanjutnya</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>

                </div>
              </div>
            </div>
            <!-- Akhir Form Untuk Tambah -->
          </form>
        </div>
      </div>
    </div>

  </div>

</section>