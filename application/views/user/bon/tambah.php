<style type="text/css">
  .body-black {
    border: 1px solid black;
  }
</style>

<section class="content">

  <h5>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url("user/home"); ?>"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Transaksi</li>
      <li class="active"><a href="<?php echo base_url("user/bon/bon"); ?>" style="color: #777;" onclick="return confirm('Anda punya perubahan yang belum disimpan; Anda yakin hendak meninggalkan halaman ini?')">BON Pengeluaran Barang</a></li>
      <li class="active">Tambah</li>
    </ol>
  </h5>

  <div class="row">

    <div class="col-xs-1"></div>

    <div class="col-xs-10">

      <!-- /.box-header -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title fa fa-plus"> Form Tambah BON Pengeluaran Barang</h3>
          <button type="button" class="close" data-dismiss="modal" onclick="history.back(-1)" title="kembali" data-content="Popover body content is set in this attribute.">&times;</button>
        </div>

        <!-- /.box-header -->
        <div class="box-body">
          <form role="form" method="POST" >

            <!-- Form Untuk Tambah -->
            <div class="col-md-12">
              <div class="form-group">
                <div class="row">
                  <div class="col-xs-12">
                    <label>No.BON</label>
                    <input type="text" class="form-control" name="no_bon" value="<?php echo $kode_otomatis; ?>" readonly="readonly">
                  </div>
                  <div class="col-xs-12" style="padding-top: 15px;">
                    <label>Tanggal Dibuat</label>
                    <input type="text" class="form-control" name="tgl_dibuat" value="<?php echo date('Y-m-d'); ?>" readonly="readonly">
                  </div>
                  <div class="col-xs-12" style="padding-top: 15px;">
                    <label>Untuk P.O</label>
                    <select class="form-control js-example-basic-single" name="id_po" onchange="submit()">
                      <option value="Kosong">------ Pilih -----</option>
                      <?php foreach ($po as $key => $value): ?>
                        <?php if (!empty($value['count']==3)): ?>
                          <option value="<?php echo $value['id_po']; ?>" <?php if($ambil_po['id_po']==$value['id_po']){echo "selected";} ?>><?php echo $value['nama_po']; ?></option>
                        <?php endif ?>
                      <?php endforeach ?>
                    </select>
                  </div>
                  <div class="col-xs-12" style="padding-top: 15px;">
                    <label>Buyer</label>
                    <input type="text" class="form-control" value="<?php echo $ambil_po['nama_buyer']; ?>" readonly="readonly">
                  </div>
                  <div class="col-xs-12" style="padding-top: 15px;">
                    <label>Style Glove</label>
                    <input type="text" class="form-control" value="<?php echo $ambil_po['nama_style']; ?>" readonly="readonly">
                  </div>
                  <div class="col-xs-12" style="padding-top: 15px;">
                    <label>Qty</label>
                    <input type="text" class="form-control" value="<?php echo $ambil_po['qty']; ?>" readonly="readonly">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="box-header with-border">
                    <h5 class="box-title"> Input Barang</h5>
                  </div>
                  <br>
                  <div class="col-xs-2">
                    <label>Nama Barang</label>
                    <select class="form-control js-example-basic-single" name="nama_barang" onchange="submit()">
                      <option value="">- Pilih -</option>
                      <?php foreach ($barang as $key => $value): ?>
                        <option value="<?php echo $value['id_ppic']; ?>" <?php if($ambil['id_ppic']==$value['id_ppic']){echo "selected";} ?>><?php echo $value['nama_barang']; ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                  <div class="col-xs-2">
                    <label>Jenis</label>
                    <input type="text" class="form-control jenis" name="jenis" value="<?php echo $ambil['jenis']; ?>" readonly>
                  </div>
                  <div class="col-xs-2">
                    <label>Sub Jenis</label>
                    <input type="text" class="form-control subjenis" name="sub_jenis" value="<?php echo $ambil['sub_jenis']; ?>" readonly>
                  </div>
                  <div class="col-xs-2">
                    <label>Warna</label>
                    <input type="text" class="form-control warna" name="warna" value="<?php echo $ambil['warna']; ?>" readonly="readonly">
                  </div>
                  <div class="col-xs-2">
                    <label>Qty Yang Diminta</label>
                    <input type="any" class="form-control" name="qty_bon" placeholder="0">
                  </div>
                  <div class="col-xs-2">
                    <label>Satuan</label>
                    <input type="text" class="form-control satuan" name="satuan" value="<?php echo $ambil['satuan']; ?>" readonly>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="row">
                  <div class="col-xs-6">
                    <label>Remaks</label>
                    <input type="text" name="remaks" class="form-control" placeholder="129 pcs">
                  </div>
                </div>
              </div>

              <?php if (!empty($notif)): ?>
                <?php $total = 0; $total2 = 0; $total3 = 0; $total4 = 0; $total5 = 0; $notif1 = 0; $notif2 = 0; $qty_reject = 0; ?>

                <?php foreach ($notif as $key => $value): ?>

                  <?php if (!empty($value['nama_barang'])): ?>
                    <?php $goods1 = $value['nama_barang']; ?>
                  <?php endif ?>

                  <?php if (!empty($value['kalkulasi_bon'])): ?>
                    <?php foreach ($value['kalkulasi_bon'] as $kunci => $konten): ?>
                      <?php $notif1+=$konten['qty_bon']; ?>
                    <?php endforeach ?>
                  <?php endif ?>
                <?php endforeach ?> 

                <?php foreach ($ambil_bon[0]['reject'] as $key => $value): ?>
                  <?php $goods2 = $value['nama_barang']; ?>
                  <?php $notif2+=$value['qty_reject']; ?>
                  <?php $qty_reject=$value['qty_reject']; ?>
                <?php endforeach ?>

                <?php if (!empty($notif['nama_barang']) AND !empty($goods2)): ?>      
                  <?php if ($goods1==$goods2): ?>      
                    <?php $total3 = $notif1 - $notif2; ?>
                  <?php endif ?>
                <?php endif ?>

                <?php foreach ($tbl_bon as $key => $value): ?>
                  <?php $total4 = $value['qty_bon']; ?>
                <?php endforeach ?>

                <?php $total5 = $qty_reject - $total4; ?>



                <?php 
                $subtotal = $total - $total2; 
                $subtotal1 = $ambil['total_kebutuhan'] - $subtotal; 
                ?>

                <!--  Batas -->

                <?php $total_bon = 0; $jml_bon = 0; ?>

                <?php foreach ($tbl_bon as $key => $value): ?>
                  <?php if ($value['nama_barang']==$ambil['nama_barang']): ?>
                    <?php $jml_bon = $value['qty_bon']; ?>
                  <?php endif ?>
                <?php endforeach ?>

                <?php $total_bon = $ambil['total_kebutuhan'] - $jml_bon; ?>

                <!--  Batas -->

                <div class="form-group">
                  <div class="row">
                    <div class="col-xs-12">
                      <input type="text" name="nama_po" value="<?php echo $po[0]['nama_po']; ?>" class="hidden">
                      <input type="text" name="total" value="<?php echo $total; ?>" class="hidden">
                      <input type="text" name="total1" value="<?php echo $total2; ?>" class="hidden">
                      <input type="text" name="total2" value="<?php echo $ambil['total_kebutuhan']; ?>" class="hidden">
                      <?php if ($total_bon>0): ?>
                        <button class="btn btn-default fa fa-arrow-down" name="tambah" value="tambah" title="Tambah Record" data-content="Popover body content is set in this attribute."> Tambahkan</button>
                      <?php elseif ($total_bon<=0): ?>
                        <button class="btn btn-default fa fa-arrow-down" title="Tambah Record" data-content="Popover body content is set in this attribute." disabled="disabled"> Tambahkan</button>
                      <?php endif ?>
                      &nbsp;&nbsp;
                      <?php if(empty($tbl_bon)): ?>
                        <button name="delete_record" value="delete_record" class="btn btn-default btn-sm fa fa-minus-square" title="Kosongkan Record" data-content="Popover body content is set in this attribute." > Kosongkan Record</button>
                      <?php elseif(!empty($tbl_bon)): ?>
                        <button name="delete_record" value="delete_record"  class="btn btn-default btn-sm fa fa-minus-square" title="Kosongkan Record" data-content="Popover body content is set in this attribute."> Kosongkan Record</button>
                      <?php endif ?>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="row">
                    <div class="box-header with-border">
                      <h5 class="box-title"> Detail Record</h5>
                    </div>
                    <div class="col-xs-12">

                      <?php if (!empty($ambil) AND $total_bon<=0): ?>
                        <div class="alert alert-block alert" style="background-color: #FAEBD7;">
                          <button type="button" class="close" data-dismiss="alert">
                            <i class="ace-icon fa fa-times"></i>
                          </button>

                          <p class="text-center" style="color: red">Sisa barang <u><?php echo $ambil['nama_barang']; ?></u> yang diminta untuk production order dengan nomor <u><?php echo $po[0]['no_po']; ?></u> tersisa <?php echo $total_bon; ?> <?php echo $ambil['satuan']; ?>. Anda tidak bisa menambahkan barang ini lagi.</p>
                        </div>

                      <!-- <?php //elseif (!empty($ambil)): ?>
                        <div class="alert alert-block alert" style="background-color: #FAEBD7;">
                          <button type="button" class="close" data-dismiss="alert">
                            <i class="ace-icon fa fa-times"></i>
                          </button>

                          <p class="text-center" style="color: red">Sisa barang <u><?php //echo $ambil['nama_barang']; ?></u> yang diminta untuk production order dengan nomor <u><?php //echo $po[0]['no_po']; ?></u> tersisa <?php //echo $ambil['total_kebutuhan']; ?> <?php //echo $ambil['satuan']; ?>.</p>
                        </div> -->

                      <?php elseif (!empty($ambil_bon['konfirmasi_ttd'])): ?>
                        <div class="alert alert-block alert" style="background-color: #FAEBD7;">
                          <button type="button" class="close" data-dismiss="alert">
                            <i class="ace-icon fa fa-times"></i>
                          </button>

                          <p class="text-center" style="color: red">Anda tidak bisa melakukan bon untuk production order <u><?php echo $ambil_po['nama_po']; ?></u> dengan no <?php echo $ambil_po['no_po']; ?> dikarenakan anda sudah melakukan bon sebelumnya atau memenuhi kebutuhan <?php echo $ambil_po['nama_po']; ?>.</p>
                        </div>

                      <?php elseif (!empty($qty_reject==$total_bon)): ?>
                        <?php foreach ($tbl_bon as $key => $value): ?>
                          <div class="alert alert-block alert" style="background-color: #FAEBD7;">
                            <button type="button" class="close" data-dismiss="alert">
                              <i class="ace-icon fa fa-times"></i>
                            </button>

                            <p class="text-center" style="color: red">Anda sudah tidak bisa menambahkan bon barang <?php echo $value['nama_barang']; ?> lagi dikarenakan sisa yang diminta sudah habis.</p>
                          </div>
                        <?php endforeach ?>

                      <?php endif ?>

                      <?php if (!empty($ambil_bon[0]['reject'])): ?>
                        <?php foreach ($notif as $key => $value): ?>
                          <?php if (!empty($value['nama_barang'])): ?>
                            <?php if ($goods1==$goods2 AND $qty_reject<=$total_bon): ?>
                              <div class="alert alert-block alert" style="background-color: #FAEBD7;">
                                <button type="button" class="close" data-dismiss="alert">
                                  <i class="ace-icon fa fa-times"></i>
                                </button>

                                <?php if (!empty($notif)): ?>
                                  <p class="text-center" style="color: red">Sisa bon dari selisih reject untuk barang <u><?php echo $goods1; ?></u> tersisa <?php echo $qty_reject; ?> <?php echo $ambil['satuan']; ?>.</p>
                                <?php endif ?>

                              </div>
                            <?php endif ?>
                          <?php endif ?>
                        <?php endforeach ?>
                      <?php endif ?>

                    </div> 
                    <br>

                    <div class="col-xs-12" style="padding-top: 10px;">
                      <table class="body-black">
                        <!-- Header -->
                        <tr style="background-color: #ddd;">
                          <th rowspan="2" class="text-center body-black" width="40"><h5 style="padding-top: 10px;"><b>No</b></h5></th>
                          <th rowspan="2" class="text-center body-black" width="250"><h5 style="padding-top: 10px;"><b>Nama Barang</b></h5></th>
                          <th rowspan="2" class="text-center body-black" width="200"><h5 style="padding-top: 10px;"><b>Jenis</b></h5></th>
                          <th rowspan="2" class="text-center body-black" width="200"><h5 style="padding-top: 10px;"><b>Sub Jenis</b></h5></th>
                          <th colspan="4" class="text-center body-black" height="30" style="font-size: 14px;"><b>Jumlah</b></th>
                        </tr>
                        <tr style="background-color: #ddd;">
                          <td class="text-center body-black" width="100" height="30" style="font-size: 14px;"><b>Warna</b></td>
                          <td class="text-center body-black" width="100" style="font-size: 14px;"><b>Qty Bon</b></td>
                          <td class="text-center body-black" width="100" style="font-size: 14px;"><b>Satuan</b></td>
                          <td class="text-center body-black" width="200" style="font-size: 14px;"><b>Remaks</b></td>
                        </tr>
                        <!-- / Header -->

                        <!-- Record -->
                        <?php 
                        $no = 1;
                        $total = 0;
                        ?>

                        <?php foreach ($tbl_bon as $key => $value): ?>
                          <tr>
                            <td class="text-center body-black" height="30" style="font-size: 14px;"><?php echo $no++; ?></td>
                            <td class="text-center body-black" style="font-size: 14px;"><?php echo $value['nama_barang']; ?></td>
                            <td class="text-center body-black" style="font-size: 14px;"><?php echo $value['jenis']; ?></td>
                            <td class="text-center body-black" style="font-size: 14px;"><?php echo $value['sub_jenis']; ?></td>
                            <td class="text-center body-black" style="font-size: 14px;">
                              <?php if (!empty($value['warna'])): ?>
                                <?php echo $value['warna']; ?>
                              <?php elseif (empty($value['warna'])): ?>
                                <?php echo "-"; ?>
                              <?php endif ?>
                            </td>
                            <td class="text-center body-black" style="font-size: 14px;"><?php echo $value['qty_bon']; ?></td>
                            <td class="text-center body-black" style="font-size: 14px;"><?php echo $value['satuan']; ?></td>
                            <td class="text-center body-black" style="font-size: 14px;">
                              <?php if (!empty($value['remaks'])): ?>
                                <?php echo $value['remaks']; ?>
                              <?php elseif (empty($value['remaks'])): ?>
                                <?php echo "-"; ?>
                              <?php endif ?>
                            </td>
                          </tr>

                        <?php endforeach ?>
                        <!-- Record -->
                      </table>
                    </div>
                  </div>
                </div>

                <!-- <?php //if ($subtotal7>=0 AND !empty($tbl_bon)): ?>
                  <div class="alert alert-block alert" style="background-color: #FAEBD7;">
                    <button type="button" class="close" data-dismiss="alert">
                      <i class="ace-icon fa fa-times"></i>
                    </button>

                    <p class="text-center" style="color: red">Jika anda menambahkan bon barang <u><?php //echo $tbl_bon[0]['nama_barang']; ?></u> dengan jumlah <u><?php //echo $tbl_bon[0]['qty_bon']; ?></u>, maka sisa yang dapat di bon tersisa <?php //echo $subtotal7; ?> <?php //echo $tbl_bon[0]['satuan']; ?>.</p>
                  </div>
                  <?php //endif ?> -->

                  <div class="form-group">
                    <div class="row">
                      <div class="col-xs-12">
                        <?php if (!empty($tbl_bon)): ?>
                          <button class="btn btn-primary fa fa-save" name="simpan1" value="simpan1" title="Simpan Data" data-content="Popover body content is set in this attribute."> Simpan Data</button>
                        <?php elseif (empty($tbl_bon) OR empty($ambil_bon['konfirmasi_ttd'])): ?>
                          <button class="btn btn-primary fa fa-save" title="Simpan Data" data-content="Popover body content is set in this attribute." disabled="disabled"> Simpan Data</button>
                        <?php endif ?>
                      </div>
                    </div>
                  </div>
                <?php endif ?>

              </div>
              <!-- Akhir Form Untuk Tambah -->

            </form>
          </div>

        </div>
      </div>

      <div class="col-xs-1"></div>

    </div>
  </section>