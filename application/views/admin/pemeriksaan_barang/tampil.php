  <style type="text/css">
    .body-blue {
      border: 1px solid #3c8dbc;
    }
  </style>

  <section class="content">

    <h5>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url("admin/home"); ?>"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Transaksi</li>
        <li class="active"><a href="<?php echo base_url("admin/pemeriksaan_barang/pemeriksaan_barang"); ?>" style="color: #777;">Pemeriksaan Barang (QC)</a></li>
      </ol>
    </h5>

    <div class="row">
      <div class="col-xs-12">
        <div class="panel panel-heading">
          <div class="box-header">
            <h3 class="box-title fa fa-check"> Pemeriksaan Barang</h3>
            <hr>
            <form role="form" method="POST" >
              <table>
                <thead>
                  <tr>
                    <th>Tanggal Awal</th>
                    <th style="padding-left: 10px;">
                      <div class="input-group">
                        <input type="text" id="datepicker" class="form-control" name="tgl_awal" placeholder="2018=10-22" size="6">
                      </div>
                    </th>
                    <th style="padding-left: 10px;">Tanggal Akhir</th>
                    <th style="padding-left: 10px;">
                      <div class="input-group">
                        <input type="text" id="datepicker1" class="form-control" name="tgl_akhir" placeholder="2018-10-22" size="6">
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
          <div class="box-body">
            <form method="POST">
              <table class="table table-bordered table-striped" id="example1"> 
                <thead style="background-color: #D3D3D3">
                  <tr>
                    <th class="text-center" width="25">No</th>
                    <th class="text-center" width="180">No.Pemeriksaan Barang</th>
                    <th class="text-center">No.LPB</th>
                    <th class="text-center" width="150">Tanggal Pemeriksaan</th>
                    <th class="text-center" width="90">Qty Reject</th>
                    <th class="text-center">Tindakan</th>
                    <th class="text-center">Hasil Ringkas Pemeriksaan</th>
                    <th class="text-center">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($periksa as $key => $value): ?>
                    <tr>
                      <td class="text-center"><?php echo $key+1; ?></td>
                      <td class="text-center"><?php echo $value['no_pemeriksaan_barang']; ?></td>
                      <td class="text-center"><?php echo $value['no_lpb']; ?></td>
                      <td class="text-center"><?php echo $value['tgl_periksa']; ?></td>
                      <td class="text-center"><?php echo $value['qty_reject']; ?></td>
                      <td class="text-center"><?php echo $value['tindakan']; ?></td>
                      <td class="text-center"><?php echo strip_tags(substr($value['hasil_periksa'], 0, 46)); ?></td>
                      <td class="text-center">

                        <a href="<?php echo base_url("admin/pemeriksaan_barang/pemeriksaan_barang/detail/$value[id_pemeriksaan_barang]"); ?>" class="btn btn-info btn-sm" title="Detail" data-content="Popover body content is set in this attribute." ><i class="fa fa-info"></i></a>

                        <!-- Beri TTD -->
                        <?php if(empty($value['inspection_acceptable'])): ?>
                          <button class="btn btn-default btn-sm" name="ttd" value="<?php echo $value['id_pemeriksaan_barang']; ?>"  title="Beri Tanda Terima Stiker" data-content="Popover body content is set in this attribute."><i class="fa fa-check"></i></button>
                        <?php endif ?>
                        <!-- Beri TTD -->

                        <!-- <a href="<?php //echo base_url("admin/pemeriksaan_barang/pemeriksaan_barang/hapus/$value[id_pemeriksaan_barang]"); ?>" class="btn btn-danger btn-sm" title="Hapus" data-content="Popover body content is set in this attribute."><i class="fa fa-trash"></i></a> -->

                        <!-- Stiker LPB -->
                        <?php if(!empty($value['inspection_acceptable'])): ?>
                          <a href="<?php echo base_url("admin/pemeriksaan_barang/pemeriksaan_barang/stiker/$value[id_pemeriksaan_barang]"); ?>" class="btn btn-primary btn-sm" title="Stiker" data-content="Popover body content is set in this attribute."><i class="fa fa-print"></i></a>

                          <!-- Buat SJK -->
                          <?php if (empty($value['periksa']['no_sjk'])): ?>
                            <?php if (!empty($value['tindakan']=="Return Barang")): ?>
                              <a href="#" class="buat-sjk btn btn-warning btn-sm" title="Buat Surat Jalan Keluar" data-content="Popover body content is set in this attribute." data-id="<?php echo $value['id_pemeriksaan_barang']; ?>" data-kode="<?php echo $value['no_pemeriksaan_barang']; ?>"><i class="fa fa-file-text-o"></i></a>
                            <?php endif ?>
                          <?php endif ?>
                          <!-- Buat SJK -->
                        <?php endif ?>
                        <!-- Stiker LPB -->

                        <!-- <a href="#"" class="btn btn-success btn-sm" title="Edit" data-content="Popover body content is set in this attribute." ><i class="fa fa-pencil"></i></a> -->
                        <!-- Detail -->
                      </td>
                    </tr>
                  <?php endforeach ?>
                </tbody>
              </table>
            </form>
            <br>
            <a class="btn btn-primary btn-sm fa fa-plus" title="Tambah" data-content="Popover body content is set in this attribute."  href="<?php echo base_url("admin/pemeriksaan_barang/pemeriksaan_barang/tambah") ?>">  Tambah</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ================= Modal buat surat jalan keluar ================= -->
  <div id="buat_sjk" class="modal fade" role="dialog">
    <div class="modal-dialog body-blue">

      <!-- Modal content-->
      <form method="POST">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title fa fa-cube"> <label>Buat Surat Jalan Keluar</label></h4>
          </div>
          <div class="modal-body">
            <input type="text" class="form-control hidden" name="id_pemeriksaan_barang" readonly="readonly">
            <div class="form-group">
              <label>No.Surat Jalan Keluar</label>
              <input type="text" class="form-control" name="no_sjk" value="<?php echo $kode_otomatis; ?>" readonly="readonly">
            </div>
            <div class="form-group">
              <label>Tanggal Dibuat</label>
              <input type="text" class="form-control" name="tgl_dibuat" readonly="readonly" value="<?php echo date('Y-m-d'); ?>">
            </div>
            <div class="form-group">
              <label>No.Pemeriksaan Barang</label>
              <input type="text" class="form-control" name="no_pemeriksaan_barang" readonly="readonly">
            </div>
            <div class="modal-footer">
              <button class="btn btn-primary fa fa-save" name="save" value="save" title="Simpan Data" data-content="Popover body content is set in this attribute."> Simpan Data</button>
            </div>
          </div>
        </form>

      </div>
    </div>
  <!-- ================= Modal buat surat jalan keluar ================= -->