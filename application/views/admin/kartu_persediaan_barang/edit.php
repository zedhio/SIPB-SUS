

<section class="content">

  <h5>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url("admin/home"); ?>"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Transaksi</li>
      <li class="active"><a href="<?php echo base_url("admin/kartu_persediaan_barang/kartu_persediaan_barang/"); ?>" style="color: #777;" onclick="return confirm('Anda punya perubahan yang belum disimpan; Anda yakin hendak meninggalkan halaman ini?')">Data Kartu Persediaan Barang</a></li>
      <li class="active">Edit</li>
    </ol>
  </h5>

  <div class="row">

    <div class="col-xs-12">

      <!-- /.box-header -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title fa fa-pencil"> Form Edit Data Kartu Persediaan Barang</h3>
          <button type="button" class="close" data-dismiss="modal" onclick="history.back(-1)" title="kembali" data-content="Popover body content is set in this attribute.">&times;</button>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <form role="form" method="POST" >

            <!-- Form Untuk Tambah -->
            <div class="col-md-12">
              <div class="form-group">
                <div class="row">

                  <div class="box-header with-border">
                    <h3 class="box-title"> Input Record</h3>
                  </div>

                  <!-- Tabel Kalkulasi SJM -->
                  <div class="box-body">
                    <!-- Patokan menampilkan id kalkulasi -->
                    <div class="col-xs-3 hidden">
                      <label>ID KPB</label>
                      <input type="text" name="id_bukti_kpb" id="id_bukti_kpb" class="form-control">
                    </div>
                    <!-- Patokan menampilkan id kalkulasi -->
                    <div class="col-xs-2">
                      <label>Tanggal</label>
                      <input type="text" class="form-control" id="tgl_masuk" name="tgl_masuk" readonly="readonly">
                    </div>
                    <div class="col-xs-2">
                      <label>Nomor Bukti</label>
                      <input type="text" class="form-control" id="no_bukti" name="no_bukti" readonly="true">
                    </div>
                    <!-- <div class="col-xs-2">
                      <label>Pilih Keterangan</label>
                      <div class="radio">
                        <label><input type="radio" name="keterangan" alt="Radio" class="keterangan"  value="Stok">Stok</label>&nbsp;&nbsp;&nbsp;
                        <label><input type="radio" name="keterangan" alt="Radio" class="keterangan" value="Pemindahan Saldo">Pemindahan Saldo</label>
                      </div>
                    </div> -->
                    <div class="col-xs-2">
                      <label>Keterangan</label>
                      <input type="text" class="form-control" id="keterangan" name="keterangan" readonly="readonly">
                    </div>
                    <div class="col-xs-2">
                      <label>Qty Masuk</label>
                      <input type="number" class="form-control" id="qty_masuk" name="qty_masuk" readonly="readonly">
                    </div>
                    <div class="col-xs-2">
                      <label>Qty Keluar</label>
                      <input type="number" class="form-control" id="qty_keluar" name="qty_keluar" readonly="readonly">
                    </div>
                    <div class="col-xs-2">
                      <label>Saldo</label>
                      <input type="text" name="saldo" class="form-control" id="saldo" readonly="readonly">
                    </div>
                  </div>

                  <div class="box-body">
                    <div class="col-xs-3">
                      <button class="btn btn-default fa fa-arrow-down" id="ubah" name="edit1" value="edit1" title="Ubah Record" data-content="Popover body content is set in this attribute." disabled="disabled"> Ubah Record</button>
                    </div>  
                  </div>
                </div>
              </div>
            </div>
            <!-- Akhir Form Untuk Tambah -->

            <!-- Tabel Output Record -->
            <div class="col-md-12">
              <div class="form-group">
                <div class="row">
                  <div class="box-header with-border">
                    <h3 class="box-title"> Detail Record</h3>
                  </div>
                  <div class="box-body">
                    <!-- <div class="col-xs-12">
                      <button name="hapus_record" value="hapus_record" id="hapus" class="btn btn-default btn-sm fa fa-minus-square" title="Kosongkan Record" data-content="Popover body content is set in this attribute." disabled="disabled"> Hapus Record</button>
                    </div> -->

                    <!-- <?php 
                    //echo "<pre>";
                    //print_r($tbl_sjm);
                    //echo "</pre>";
                    ?> -->

                    <div class="col-xs-12" style="padding-top: 10px;">
                      <table class="table table-bordered">
                        <!-- Header -->
                        <tr>
                          <th class="text-center" width="30"><h5 style="padding-top: 10px;"><b>No</b></h5></th>
                          <th class="text-center"><h5 style="padding-top: 10px;"><b>Tanggal</b></h5></th>
                          <th class="text-center"><h5 style="padding-top: 10px;"><b>Nomor Bukti</b></h5></th>
                          <th class="text-center"><h5 style="padding-top: 10px;"><b>Keterangan</b></h5></th>
                          <th class="text-center"><h5 style="padding-top: 10px;"><b>Qty Masuk</b></h5></th>
                          <th class="text-center"><h5 style="padding-top: 10px;"><b>Qty Keluar</b></h5></th>
                          <th class="text-center"><h5 style="padding-top: 10px;"><b>Saldo</b></h5></th>
                        </tr>

                        <?php 
                        $no = 1;
                        ?>

                        <!-- <pre><?php print_r($ambil_bukti_kpb); ?></pre> -->

                        <?php foreach ($ambil_bukti_kpb as $key => $value): ?>
                          <tr>
                            <td class="text-center" style="font-size: 14px;">
                            <input type="radio" id="kpb" data-id="<?php echo $value['id_bukti_kpb']; ?>"> <?php echo $no++; ?>
                            </td>
                            <td class="text-center" style="font-size: 14px;"><?php echo $value['tgl_masuk']; ?></td>
                            <td class="text-center" style="font-size: 14px;">
                              <?php if(!empty($value['no_bukti'])): ?>
                                <?php echo $value['no_bukti']; ?>
                              <?php elseif(empty($value['no_bukti'])): ?>
                                <?php echo "-"; ?>
                              <?php endif ?>
                            </td>
                            <td class="text-center" style="font-size: 14px;"><?php echo $value['keterangan']; ?></td>
                            <td class="text-center" style="font-size: 14px;">
                              <?php if(!empty($value['qty_masuk'])): ?>
                                <?php echo $value['qty_masuk']; ?>
                              <?php elseif(empty($value['qty_masuk'])): ?>
                                <?php echo "-"; ?>
                              <?php endif ?>
                            </td>
                            <td class="text-center" style="font-size: 14px;">
                              <?php if(!empty($value['qty_keluar'])): ?>
                                <?php echo $value['qty_keluar']; ?>
                              <?php elseif(empty($value['qty_keluar'])): ?>
                                <?php echo "-"; ?>
                              <?php endif ?>
                            </td>
                            <td class="text-center" style="font-size: 14px;"><?php echo $value['saldo']; ?></td>
                          </tr>
                        <?php endforeach ?>
                      </table>
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
                <div class="box-body">
                  <div class="col-xs-6">
                    <button class="btn btn-success fa fa-pencil" name="edit" value="edit" title="Edit Data" data-content="Popover body content is set in this attribute."> Ubah Data</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

</div>
</section>