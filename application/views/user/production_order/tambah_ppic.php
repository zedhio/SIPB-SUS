  <section class="content">

    <h5>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url("user/home"); ?>"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Transaksi</li>
        <li class="active"><a href="<?php echo base_url("user/production_order/production_order"); ?>" style="color: #777;">roduction Order</a></li>
        <li class="active"><a href="<?php echo base_url("user/production_order/production_order/tambah_pos"); ?>" style="color: #777;">Tambah POS</a></li>
        <li class="active">Tambah PPIC</li>
      </ol>
    </h5>

    <div class="row">

      <div class="col-xs-12">

        <!-- /.box-header -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title fa fa-plus"> Form Tambah PPIC</h3>
            <button type="button" class="close" data-dismiss="modal" onclick="history.back(-1)" title="kembali" data-content="Popover body content is set in this attribute.">&times;</button>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <form role="form" method="POST" enctype="multipart/form-data">
              <!-- text input -->
              <div class="col-md-12">
                <div class="form-group">
                  <div class="row">

                    <!-- <pre><?php print_r($ppic); ?></pre>
                    <pre><?php print_r($_SESSION['po']); ?></pre>
                    <pre><?php print_r($_SESSION['warna_pos']); ?></pre>
                    <pre><?php print_r($_SESSION['mens_cadet']); ?></pre>
                    <?php if (!empty($_SESSION['ladies_cadet'])): ?>
                      <pre><?php print_r($_SESSION['ladies_cadet']); ?></pre>
                    <?php elseif (empty($_SESSION['ladies_cadet'])): ?>
                      <?php "-" ?>
                    <?php endif ?> -->
                    <!-- <pre><?php print_r($_SESSION['picture_packing_printing_remark']); ?></pre> -->
                    <!-- <?php if (!empty($_SESSION['ppic'])): ?>
                      <pre><?php print_r($_SESSION['ppic']); ?></pre>
                    <?php elseif (empty($_SESSION['ppic'])): ?>
                      <?php "-" ?>
                    <?php endif ?> -->

                    <div class="box-header with-border">
                      <h3 class="box-title" style="font-size: 14px;"> <b>Input Data PPIC</b></h3>
                    </div>

                    <!-- Tabel Kalkulasi SJM -->
                    <div class="box-body">
                      <div class="col-xs-2">
                        <label>Nama Barang</label>
                        <select class="form-control js-example-basic-single" name="nama_barang" id="barang" onchange="submit()">
                          <option value="Kosong">- Pilih -</option>
                          <?php foreach ($barang as $key => $value): ?>
                            <option value="<?php echo $value['nama_barang']; ?>" <?php if($ambil['nama_barang']==$value['nama_barang']){echo "selected";} ?>><?php echo $value['nama_barang']; ?></option>
                          <?php endforeach ?>
                        </select>
                      </div>
                      <div class="col-xs-2">
                        <label>Warna</label>
                        <input type="text" class="form-control" name="warna" value="<?php echo $ambil['warna']; ?>" readonly="">
                      </div>
                      <div class="col-xs-2">
                        <label>Order</label>
                        <input type="number" name="order" class="form-control">
                      </div>
                      <div class="col-xs-2">
                        <label>Satu Pcs</label>
                        <input type="number" name="per_pcs" step="any" class="form-control">
                      </div>
                      <div class="col-xs-2">
                        <label>Rendement (1 Meter)</label>
                        <input type="number" name="rendement_per_meter" step="any" class="form-control">
                      </div>
                      <div class="col-xs-2">
                        <label>Satuan</label>
                        <input type="text" class="form-control" name="satuan" value="<?php echo $ambil['satuan']; ?>" readonly="">
                      </div>
                      <!-- <div class="col-xs-2">
                        <label>Total Kebutuhan</label>
                        <input type="number" name="total_kebutuhan" class="form-control">
                      </div> -->
                    </div>

                    <div class="box-body">
                      <!-- <div class="col-xs-2">
                        <label>Satuan</label>
                        <input type="text" class="form-control" name="satuan" value="<?php echo $ambil['satuan']; ?>" readonly="">
                      </div> -->
                      <!-- <div class="col-xs-1">
                        <label>Stock</label>
                        <input type="number" name="stok" class="form-control" readonly="">
                      </div>
                      <div class="col-xs-1">
                        <label>Kekurangan</label>
                        <input type="number" name="kekurangan" class="form-control">
                      </div> -->
                      <div class="col-xs-2">
                        <label>Supplier</label>
                        <select class="form-control js-example-basic-single" name="id_supplier">
                          <option>- Pilih -</option>
                          <?php foreach ($supplier as $key => $value): ?>
                            <option value="<?php echo $value['id_supplier']; ?>"><?php echo $value['nama_supplier']; ?></option>
                          <?php endforeach ?>
                        </select>
                      </div>
                      <div class="col-xs-2">
                        <label>Rendement Satu Meter</label>
                        <input type="number" name="rendement_satu_meter" step="any" class="form-control">
                      </div>
                      <div class="col-xs-2">
                        <label>Total Produksi</label>
                        <input type="number" name="total_produksi" class="form-control">
                      </div>
                      <div class="col-xs-2">
                        <label>Remark</label>
                        <input type="text" name="remark" class="form-control">
                      </div>
                    </div>

                    <div class="box-body">
                      <div class="col-xs-6">
                        <?php if (empty($ambil)): ?>
                          <button class="btn btn-default fa fa-arrow-down" name="tambah3" value="tambah3" title="Tambah Record" data-content="Popover body content is set in this attribute." disabled=""> Tambahkan Record</button>
                          &nbsp;
                        <?php elseif (!empty($ambil)): ?>
                          <button class="btn btn-default fa fa-arrow-down" name="tambah3" value="tambah3" title="Tambah Record" data-content="Popover body content is set in this attribute."> Tambahkan Record</button>
                          &nbsp;
                        <?php endif ?>

                        <?php if (empty($ppic)): ?>
                          <button name="hapus_record3" value="hapus_record3" class="btn btn-default btn-sm fa fa-minus-square" title="Kosongkan Record" data-content="Popover body content is set in this attribute." disabled=""> Kosongkan Record</button>
                        <?php elseif (!empty($ppic)): ?>
                          <button name="hapus_record3" value="hapus_record3" class="btn btn-default btn-sm fa fa-minus-square" title="Kosongkan Record" data-content="Popover body content is set in this attribute."> Kosongkan Record</button>
                        <?php endif ?>
                      </div>
                    </div>

                    <div class="box-body">
                      <div class="col-xs-12">
                        <table class="table table-bordered">
                          <!-- Header -->
                          <tr align="center">
                            <th rowspan="2" class="text-center" width="30"><h5 style="padding-top: 10px;"><b>No</b></h5></th>
                            <th rowspan="2" class="text-center" width="250"><h5 style="padding-top: 10px;"><b>Nama Barang</b></h5></th>
                            <th rowspan="2" class="text-center" width="200"><h5 style="padding-top: 10px;"><b>Warna</b></h5></th>
                            <th colspan="4" class="text-center" style="font-size: 14px;"><b>Kebutuhan Sebelum Produksi</b></th>
                            <th rowspan="2" class="text-center" width="200"><h5 style="padding-top: 10px;"><b>Unit</b></h5></th>
                            <th rowspan="2" class="text-center" width="200"><h5 style="padding-top: 10px;"><b>Stok</b></h5></th>
                            <th rowspan="2" class="text-center" width="200"><h5 style="padding-top: 10px;"><b>Kekurangan</b></h5></th>
                            <th rowspan="2" class="text-center" width="200"><h5 style="padding-top: 10px;"><b>Supplier</b></h5></th>
                            <th rowspan="2" class="text-center" width="200"><h5 style="padding-top: 10px;"><b>Rendement Satu Meter</b></h5></th>
                            <th colspan="2" class="text-center" style="font-size: 14px;"><b>Actual Pemakaian</b></th>
                          </tr>
                          <tr>
                            <td class="text-center" width="100" style="font-size: 14px;"><b>Order</b></td>
                            <td class="text-center" width="100" style="font-size: 14px;"><b>Satu Pcs</b></td>
                            <td class="text-center" width="300" style="font-size: 14px;"><b>Rendement (1 Meter)</b></td>
                            <td class="text-center" width="300" style="font-size: 14px;"><b>Total Kebutuhan</b></td>
                            <td class="text-center" width="100" style="font-size: 14px;"><b>Total Produksi</b></td>
                            <td class="text-center" width="300" style="font-size: 14px;"><b>Remark</b></td>
                          </tr>
                          <!-- / Header -->

                          <?php $no=1; ?>

                          <!-- Record -->
                          <?php foreach ($ppic as $key => $value): ?>
                            <tr>
                              <td class="text-center" style="font-size: 14px;"><?php echo $no++; ?></td>
                              <td class="text-center" style="font-size: 14px;"><?php echo $value['nama_barang']; ?></td>
                              <td class="text-center" style="font-size: 14px;">
                                <?php if (!empty($value['warna'])): ?>
                                  <?php echo $value['warna']; ?>
                                <?php elseif (empty($value['warna'])): ?>
                                  <?php echo "-"; ?>
                                <?php endif ?>
                              </td>
                              <td class="text-center" style="font-size: 14px;"><?php echo $value['order']; ?></td>
                              <td class="text-center" style="font-size: 14px;"><?php echo $value['per_pcs']; ?></td>
                              <td class="text-center" style="font-size: 14px;">
                                <?php if (!empty($value['rendement_per_meter'])): ?>
                                  <?php echo $value['rendement_per_meter']; ?>
                                <?php elseif (empty($value['rendement_per_meter'])): ?>
                                  <?php echo "-"; ?>
                                <?php endif ?>
                              </td>

                              <?php 
                              $total = $value['order'] * $value['per_pcs'];
                              $total1 = $value['detail']['stok'] - $total;
                              ?>

                              <td class="text-center" style="font-size: 14px;"><?php echo $total; ?></td>
                              <td class="text-center" style="font-size: 14px;"><?php echo $value['satuan']; ?></td>
                              <td class="text-center" style="font-size: 14px;"><?php echo $value['detail']['stok']; ?></td>
                              <td class="text-center" style="font-size: 14px;">
                                <?php if ($total1<0): ?>
                                  <?php echo $total1; ?>
                                <?php elseif ($total1>0): ?>
                                  <?php echo "-"; ?>
                                <?php endif ?>
                              </td>
                              <td class="text-center" style="font-size: 14px;">
                                <?php if (!empty($value['supplier']['nama_supplier'])): ?>
                                  <?php echo $value['supplier']['nama_supplier']; ?>
                                <?php elseif (empty($value['supplier']['nama_supplier'])): ?>
                                  <?php echo "-"; ?>
                                <?php endif ?>
                              </td>
                              <td class="text-center" style="font-size: 14px;">
                                <?php if (!empty($value['rendement_satu_meter'])): ?>
                                  <?php echo $value['rendement_satu_meter']; ?>
                                <?php elseif (empty($value['rendement_satu_meter'])): ?>
                                  <?php echo "-"; ?>
                                <?php endif ?>
                              </td>
                              <td class="text-center" style="font-size: 14px;">
                                <?php if (!empty($value['total_produksi'])): ?>
                                  <?php echo $value['total_produksi']; ?>
                                <?php elseif (empty($value['total_produksi'])): ?>
                                  <?php echo "-"; ?>
                                <?php endif ?>
                              </td>
                              <td class="text-center" style="font-size: 14px;">
                                <?php if (!empty($value['remark'])): ?>
                                  <?php echo $value['remark']; ?>
                                <?php elseif (empty($value['remark'])): ?>
                                  <?php echo "-"; ?>
                                <?php endif ?>
                              </td>
                            </tr>
                          <?php endforeach ?>
                          <!-- Record -->
                        </table>
                      </div>
                    </div>

                    <div class="box-body">
                      <div class="col-xs-12">
                      <?php if (!empty($ppic)): ?>
                        <button class="btn btn-primary fa fa-save" name="simpan1" value="simpan1" title="Simpan Data" data-content="Popover body content is set in this attribute."> Simpan Data</button>
                      <?php elseif (empty($ppic)): ?>
                        <button class="btn btn-primary fa fa-save" title="Anda tidak bisa menyimpan data" data-content="Popover body content is set in this attribute." disabled=""> Simpan Data</button>
                      <?php endif ?>
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