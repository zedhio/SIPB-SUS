<section class="content">

  <h5>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url("user/home"); ?>"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Transaksi</li>
      <li class="active"><a href="<?php echo base_url("user/production_order/production_order"); ?>" style="color: #777;">Data Production Order</a></li>
      <li class="active"><a href="<?php echo base_url("user/production_order/production_order/edit"); ?>" style="color: #777;">Edit</a></li>
      <li class="active">Edit POS</li>
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
                    <h3 class="box-title" style="font-size: 14px;"> <b>Spesifikasi Material</b></h3>
                  </div>

                  <!-- Tabel Kalkulasi SJM -->
                  <div class="box-body">
                    <div class="col-xs-2">
                      <label>Body</label>
                      <select class="form-control name="">
                        <option>---- Pilih ----</option>
                        <option>Leather</option>
                      </select>
                    </div>
                    <div class="col-xs-2">
                      <label>Machi</label>
                      <select class="form-control name="">
                        <option>---- Pilih ----</option>
                        <option>Leather</option>
                      </select>
                    </div>
                    <div class="col-xs-1">
                      <label>Warna Velcro</label>
                      <select class="form-control name="">
                        <option>- Pilih -</option>
                        <option>Leather</option>
                      </select>
                    </div>
                    <div class="col-xs-2">
                      <label>Warna PU Tape</label>
                      <select class="form-control name="">
                        <option>---- Pilih ----</option>
                        <option>Leather</option>
                      </select>
                    </div>
                    <div class="col-xs-2">
                      <label>Logo</label>
                      <select class="form-control name="">
                        <option>---- Pilih ----</option>
                        <option>Leather</option>
                      </select>
                    </div>
                    <div class="col-xs-1">
                      <label>Patch</label>
                      <div class="radio">
                        <label><input type="radio" name="patch" alt="Radio" value="Yes">Yes</label>&nbsp;
                        <label><input type="radio" name="patch" alt="Radio" value="No">No</label>
                      </div>
                    </div>
                    <div class="col-xs-2">
                      <label>Variasi</label>
                      <select class="form-control name="">
                        <option>---- Pilih ----</option>
                        <option>Leather</option>
                      </select>
                    </div>
                  </div>

                  <div class="box-body">
                    <div class="col-xs-3">
                      <button class="btn btn-default fa fa-arrow-down" name="tambah" value="tambah" title="Tambah Record" data-content="Popover body content is set in this attribute."> Edit Record</button>
                      &nbsp;&nbsp;
                      <button name="delete_record" value="delete_record" class="btn btn-default btn-sm fa fa-minus-square" title="Kosongkan Record" data-content="Popover body content is set in this attribute."> Kosongkan Record</button>
                    </div>  
                  </div>

                  <div class="box-body">
                    <div class="col-xs-12">
                      <table class="table table-bordered">
                        <!-- Header -->
                        <tr align="center">
                          <th class="text-center" width="30"><h5 style="padding-top: 10px;"><b>No</b></h5></th>
                          <th class="text-center"><h5 style="padding-top: 10px;"><b>Body</b></h5></th>
                          <th class="text-center"><h5 style="padding-top: 10px;"><b>Machi</b></h5></th>
                          <th class="text-center" width="130"><h5 style="padding-top: 10px;"><b>Warna Velcro</b></h5></th>
                          <th class="text-center" width="150"><h5 style="padding-top: 10px;"><b>Warna PU Tape</b></h5></th>
                          <th class="text-center"><h5 style="padding-top: 10px;"><b>Logo</b></h5></th>
                          <th class="text-center" width="70"><h5 style="padding-top: 10px;"><b>Patch</b></h5></th>
                          <th class="text-center" width="130"><h5 style="padding-top: 10px;"><b>Variasi</b></h5></th>
                        </tr>
                        <!-- / Header -->

                        <!-- Record -->
                        <tr>
                          <td class="text-center" style="font-size: 14px;"><input type="radio" name="" alt="Radio" value=""></td>
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
                                <label><input type="radio" name="patch" alt="Radio" value="Left">Left</label>&nbsp;&nbsp;
                                <label><input type="radio" name="patch" alt="Radio" value="Right">Right</label>
                              </div>
                            </div>
                            <div class="col-xs-4">
                              <label>Size</label>
                              <input type="number" name="size" class="form-control">
                            </div>
                            <div class="col-xs-4">
                              <label>Qty</label>
                              <input type="number" name="qty" class="form-control">
                            </div>
                          </div>

                          <div class="box-body">
                            <div class="col-xs-12">
                              <button class="btn btn-default fa fa-arrow-down" name="edit" value="edit" title="Tambah Record" data-content="Popover body content is set in this attribute."> Edit Record</button>
                              &nbsp;&nbsp;
                              <button name="delete_record" value="delete_record" class="btn btn-default btn-sm fa fa-minus-square" title="Kosongkan Record" data-content="Popover body content is set in this attribute."> Kosongkan Record</button>
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

                                <!-- Record -->
                                <tr>
                                  <td class="text-center" style="font-size: 14px;"><input type="radio" name="" alt="Radio" value=""></td>
                                  <td class="text-center" style="font-size: 14px;"></td>
                                  <td class="text-center" style="font-size: 14px;"></td>
                                  <td class="text-center" style="font-size: 14px;"></td>
                                </tr>

                                <tr>
                                  <td colspan="3" class="text-center" style="font-size: 14px;"><b>Qty Total</b></td>
                                  <td colspan="2" class="text-center" style="font-size: 14px;"></td>
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
                                <label><input type="radio" name="patch" alt="Radio" value="Left">Left</label>&nbsp;&nbsp;
                                <label><input type="radio" name="patch" alt="Radio" value="Right">Right</label>
                              </div>
                            </div>
                            <div class="col-xs-4">
                              <label>Size</label>
                              <input type="number" name="size" class="form-control">
                            </div>
                            <div class="col-xs-4">
                              <label>Qty</label>
                              <input type="number" name="qty" class="form-control">
                            </div>
                          </div>

                          <div class="box-body">
                            <div class="col-xs-12">
                              <button class="btn btn-default fa fa-arrow-down" name="edit" value="edit" title="Tambah Record" data-content="Popover body content is set in this attribute."> Edit Record</button>
                              &nbsp;&nbsp;
                              <button name="delete_record" value="delete_record" class="btn btn-default btn-sm fa fa-minus-square" title="Kosongkan Record" data-content="Popover body content is set in this attribute."> Kosongkan Record</button>
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

                                <!-- Record -->
                                <tr>
                                  <td class="text-center" style="font-size: 14px;"><input type="radio" name="" alt="Radio" value=""></td>
                                  <td class="text-center" style="font-size: 14px;"></td>
                                  <td class="text-center" style="font-size: 14px;"></td>
                                  <td class="text-center" style="font-size: 14px;"></td>
                                </tr>

                                <tr>
                                  <td colspan="3" class="text-center" style="font-size: 14px;"><b>Qty Total</b></td>
                                  <td colspan="2" class="text-center" style="font-size: 14px;"></td>
                                </tr>
                                <!-- Record -->
                              </table>
                            </div>
                          </div>

                        </div>
                      </div>
                    </div>

                    <div class="box-body">
                    <div class="col-xs-12 text-center">
                        <label style="font-size: 16px;">Jumlah keseluruhan untuk Mens dan Ladies Cadet adalah 0</label>
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
                                    Browse… <input type="file" id="imgInp" name="">
                                  </span>
                                </span>
                                <input type="text" class="form-control" value="" readonly>
                              </div>
                            </div>
                          </div>

                          <div class="box-body">
                            <div class="col-xs-12">
                              <img class="profile-user-img img-thumbnail" width="100" height="50" src=""  alt="Tampak Belakang" id="img-upload">
                            </div>
                          </div>

                        </div>
                      </div>
                    </div>

                    <div class="col-xs-6">
                      <div class="form-group">
                        <div class="row">
                          <div class="box-header with-border">
                            <h3 class="box-title" style="font-size: 14px;"> Packing</h3>
                          </div>

                          <div class="box-body">
                            <div class="col-xs-12">
                              <label>Keterangan</label>
                              <textarea id="ckeditor" class="ckeditor" name="" rows="1"></textarea>
                            </div>
                            <div class="col-xs-3" style="padding-top: 20px;">
                              <label>Body</label>
                              <div class="radio">
                                <label><input type="radio" name="patch" alt="Radio" value="Yes">Yes</label>&nbsp;&nbsp;
                                <label><input type="radio" name="patch" alt="Radio" value="No">No</label>
                              </div>
                            </div>
                            <div class="col-xs-3" style="padding-top: 20px;">
                              <label>Thumb</label>
                              <div class="radio">
                                <label><input type="radio" name="patch" alt="Radio" value="Yes">Yes</label>&nbsp;&nbsp;
                                <label><input type="radio" name="patch" alt="Radio" value="No">No</label>
                              </div>
                            </div>
                            <div class="col-xs-3" style="padding-top: 20px;">
                              <label>Machi</label>
                              <div class="radio">
                                <label><input type="radio" name="patch" alt="Radio" value="Yes">Yes</label>&nbsp;&nbsp;
                                <label><input type="radio" name="patch" alt="Radio" value="No">No</label>
                              </div>
                            </div>
                            <div class="col-xs-3" style="padding-top: 20px;">
                              <label>Velcro</label>
                              <div class="radio">
                                <label><input type="radio" name="patch" alt="Radio" value="Yes">Yes</label>&nbsp;&nbsp;
                                <label><input type="radio" name="patch" alt="Radio" value="No">No</label>
                              </div>
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
                              <textarea id="ckeditor" class="ckeditor" name="" rows="1"></textarea>
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