<section class="content">

  <h5>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url("user/home"); ?>"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Transaksi</li>
      <li class="active"><a href="<?php echo base_url("user/production_order/production_order"); ?>" style="color: #777;">Data Production Order</a></li>
      <li class="active"><a href="<?php echo base_url("user/production_order/production_order/edit"); ?>" style="color: #777;">Edit</a></li>
      <li class="active"><a href="<?php echo base_url("user/production_order/production_order/edit_pos"); ?>" style="color: #777;">Edit POS</a></li>
      <li class="active">Edit PPIC</li>
    </ol>
  </h5>

  <div class="row">

    <div class="col-xs-12">

      <!-- /.box-header -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title fa fa-plus"> Form Tambah Data Production Order</h3>
          <button type="button" class="close" data-dismiss="modal" onclick="history.back(-1)" title="kembali" data-content="Popover body content is set in this attribute.">&times;</button>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <form role="form" method="POST" enctype="multipart/form-data">
            <!-- text input -->
            <div class="col-md-12">
              <div class="form-group">
                <div class="row">

                  <div class="box-header with-border">
                    <h3 class="box-title" style="font-size: 14px;"> <b>Input Data PPIC</b></h3>
                  </div>

                  <!-- Tabel Kalkulasi SJM -->
                  <div class="box-body">
                    <div class="col-xs-2">
                      <label>Nama Barang</label>
                      <select class="form-control js-example-basic-single name="">
                        <option>---- Pilih ----</option>
                        <option>Leather</option>
                      </select>
                    </div>
                    <div class="col-xs-2">
                      <label>Warna</label>
                      <select class="form-control js-example-basic-single name="">
                        <option>---- Pilih ----</option>
                        <option>Leather</option>
                      </select>
                    </div>
                    <div class="col-xs-2">
                      <label>Order</label>
                      <input type="number" name="order" class="form-control">
                    </div>
                    <div class="col-xs-2">
                      <label>Satu Pcs</label>
                      <input type="number" name="order" class="form-control">
                    </div>
                    <div class="col-xs-2">
                      <label>Rendement (Meter)</label>
                      <input type="number" name="order" class="form-control">
                    </div>
                    <div class="col-xs-2">
                      <label>Total Kebutuhan</label>
                      <input type="number" name="order" class="form-control">
                    </div>
                  </div>

                  <div class="box-body">
                    <div class="col-xs-2">
                      <label>Satuan</label>
                      <select class="form-control js-example-basic-single name="">
                        <option>---- Pilih ----</option>
                        <option>Leather</option>
                      </select>
                    </div>
                    <div class="col-xs-1">
                      <label>Stock</label>
                      <input type="number" name="stock" class="form-control">
                    </div>
                    <div class="col-xs-1">
                      <label>Kekurangan</label>
                      <input type="number" name="kekurangan" class="form-control">
                    </div>
                    <div class="col-xs-2">
                      <label>Supplier</label>
                      <select class="form-control js-example-basic-single name="">
                        <option>---- Pilih ----</option>
                        <option>Leather</option>
                      </select>
                    </div>
                    <div class="col-xs-2">
                      <label>Rendement Satu Meter</label>
                      <input type="number" name="order" class="form-control">
                    </div>
                    <div class="col-xs-2">
                      <label>Total Produksi</label>
                      <input type="number" name="order" class="form-control">
                    </div>
                    <div class="col-xs-2">
                      <label>Remark</label>
                      <input type="text" name="remark" class="form-control">
                    </div>
                  </div>

                  <div class="box-body">
                    <div class="col-xs-3">
                      <button class="btn btn-default fa fa-arrow-down" name="tambah" value="tambah" title="Tambah Record" data-content="Popover body content is set in this attribute."> Tambahkan Record</button>
                      &nbsp;&nbsp;
                      <button name="delete_record" value="delete_record" class="btn btn-default btn-sm fa fa-minus-square" title="Kosongkan Record" data-content="Popover body content is set in this attribute."> Hapus Record</button>
                    </div>  
                  </div>

                  <div class="box-body">
                    <div class="col-xs-12">
                      <table class="table table-bordered">
                        <!-- Header -->
                        <tr align="center">
                          <th rowspan="2" class="text-center" width="30"><h5 style="padding-top: 10px;"><b>No</b></h5></th>
                          <th rowspan="2" class="text-center" width="250"><h5 style="padding-top: 10px;"><b>Nama Barang</b></h5></th>
                          <th rowspan="2" class="text-center" width="200"><h5 style="padding-top: 10px;"><b>Sub Jenis</b></h5></th>
                          <th colspan="4" class="text-center" style="font-size: 14px;"><b>Kebutuhan Sebelum Produksi</b></th>
                          <th rowspan="2" class="text-center" width="200"><h5 style="padding-top: 10px;"><b>Unit</b></h5></th>
                          <th rowspan="2" class="text-center" width="200"><h5 style="padding-top: 10px;"><b>Stok</b></h5></th>
                          <th rowspan="2" class="text-center" width="200"><h5 style="padding-top: 10px;"><b>Kekurangan</b></h5></th>
                          <th rowspan="2" class="text-center" width="200"><h5 style="padding-top: 10px;"><b>Supplier</b></h5></th>
                          <th colspan="3" class="text-center" style="font-size: 14px;"><b>Kebutuhan Sebelum Produksi</b></th>
                        </tr>
                        <tr>
                          <td class="text-center" width="100" style="font-size: 14px;"><b>Order</b></td>
                          <td class="text-center" width="100" style="font-size: 14px;"><b>Satu Pcs</b></td>
                          <td class="text-center" width="300" style="font-size: 14px;"><b>Rendement (Meter)</b></td>
                          <td class="text-center" width="300" style="font-size: 14px;"><b>Total Kebutuhan</b></td>
                          <td class="text-center" width="100" style="font-size: 14px;"><b>Rendement (Meter)</b></td>
                          <td class="text-center" width="100" style="font-size: 14px;"><b>Total Produksi</b></td>
                          <td class="text-center" width="300" style="font-size: 14px;"><b>Remark</b></td>
                        </tr>
                        <!-- / Header -->

                        <!-- Record -->
                        <tr>
                          <td class="text-center" style="font-size: 14px;"><input type="radio" id="" data-id=""></td>
                          <td class="text-center" style="font-size: 14px;"></td>
                          <td class="text-center" style="font-size: 14px;"></td>
                          <td class="text-center" style="font-size: 14px;"></td>
                          <td class="text-center" style="font-size: 14px;"></td>
                          <td class="text-center" style="font-size: 14px;"></td>
                          <td class="text-center" style="font-size: 14px;"></td>
                          <td class="text-center" style="font-size: 14px;"></td>
                          <td class="text-center" style="font-size: 14px;"></td>
                          <td class="text-center" style="font-size: 14px;"></td>
                          <td class="text-center" style="font-size: 14px;"></td>
                          <td class="text-center" style="font-size: 14px;"></td>
                          <td class="text-center" style="font-size: 14px;"></td>
                          <td class="text-center" style="font-size: 14px;"></td>
                        </tr>
                        <!-- Record -->
                      </table>
                    </div>
                  </div>

                  <div class="box-body">
                    <div class="col-xs-12">
                      <button class="btn btn-primary fa fa-save" name="simpan" value="simpan" title="Simpan Data" data-content="Popover body content is set in this attribute."> Simpan Data</button>
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