<section class="content">

  <h5>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url("user/home"); ?>"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Transaksi</li>
      <li class="active"><a href="<?php echo base_url("user/bon/bon"); ?>" style="color: #777;">BON Pengeluaran Barang</a></li>
    </ol>
  </h5>

  <div class="row">
    <div class="col-xs-12">
      <div class="panel panel-heading">
        <div class="box-header">
          <h3 class="box-title fa fa-envelope-o"> BON Pengeluaran Barang</h3>
          <hr>

          <!-- Bagian pencarian data surat jalan masuk berdasarkan tanggal -->
          <form role="form" method="POST" >
            <table>
              <thead>
                <tr>
                  <th>Tanggal Awal</th>
                  <th style="padding-left: 10px;">
                    <div class="input-group">
                      <input type="text" id="datepicker" class="form-control" name="tgl_awal" placeholder="2018-10-22" size="6">
                    </div>
                  </th>
                  <th style="padding-left: 10px;">Tanggal Akhir</th>
                  <th style="padding-left: 10px;">
                    <div class="input-group">
                      <input type="text" id="datepicker1" class="form-control" name="tgl_akhir" placeholder="2018-10-22" size="6">
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

        <div class="box-body">

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
                  <th class="text-center">Nama Barang</th>
                  <th class="text-center">Qty Bon</th>
                  <th class="text-center">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($bon as $key => $value): ?>
                  <tr>
                    <td class="text-center" width="30"><?php echo $key+1; ?></td>
                    <td class="text-center" width="90"><?php echo $value['no_bon']; ?></td>
                    <td class="text-center" width="105"><?php echo date('d-m-Y', strtotime($value['tgl_dibuat'])); ?></td>
                    <td class="text-center" width="110"><?php echo $value['nama_po']; ?></td>
                    <td class="text-center" width="130"><?php echo $value['nama_buyer']; ?></td>
                    <td class="text-center" width="130"><?php echo $value['nama_style']; ?></td>
                    <td class="text-center" width="130">
                      <ul type="square">
                        <?php foreach ($value['kalkulasi_bon'] as $no => $content): ?>
                          <li><?php echo $content['barang']['nama_barang']; ?></li>
                          <br>
                        <?php endforeach ?>
                      </ul>
                    </td>
                    <td class="text-center" width="96">
                      <ul type="square">
                        <?php foreach ($value['kalkulasi_bon'] as $no => $content): ?>
                          <li><?php echo $content['qty_bon']; ?></li>
                          <br>
                        <?php endforeach ?>
                      </ul>
                    </td>
                    <td class="text-center" width="120">

                      <!-- Detail bon -->
                      <a href="<?php echo base_url("user/bon/bon/detail/$value[id_bon]"); ?>" class="btn btn-primary btn-sm fa fa-info" title="Detail" data-content="Popover body content is set in this attribute." ></a>
                      <!-- Detail bon -->

                      <?php if(empty($value['konfirmasi_ttd'])): ?>
                        <!-- Beri TTD -->
                        <button class="btn btn-default btn-sm fa fa-check" name="ttd" value="<?php echo $value['id_bon']; ?>"  title="Beri Tanda Terima" data-content="Popover body content is set in this attribute."></button>
                        <!-- Beri TTD -->

                        <!-- Ubah bon -->
                        <!-- <a href="<?php ///echo base_url("user/bon/bon/ubah/$value[id_bon]"); ?>" class="btn btn-success btn-sm fa fa-pencil" title="Edit" data-content="Popover body content is set in this attribute." ></a> -->
                        <!-- Ubah bon -->

                        <!-- Hapus bon -->
                        <!-- <a href="<?php //echo base_url("user/bon/bon/hapus/$value[id_bon]"); ?>" class="btn btn-danger btn-sm fa fa-trash" title="Hapus" data-content="Popover body content is set in this attribute." onclick="return confirm('Apakah anda yakin ?')"></a> -->
                        <!-- Hapus bon -->
                      <?php endif ?>

                    </td>
                  </tr>
                <?php endforeach ?>
              </tbody>
            </table>
          </form>
          <!-- Bagian menampilkan semua data bon -->

          <br>
          <!-- Tombol tambah data bon -->
          <a class="btn btn-primary btn-sm fa fa-plus" title="Tambah" data-content="Popover body content is set in this attribute."  href="<?php echo base_url("user/bon/bon/tambah") ?>">  Tambah</a>
          <!-- Tombol tambah data bon -->
          
        </div>

      </div>
    </div>
  </div>
</section>

<!-- Modal Pengajuan approval ke K.Gudang dan Administrasi -->
<div id="ajukan_persetujuan_bon" class="modal fade" role="dialog">
  <div class="modal-dialog body-blue">

    <!-- Modal content-->
    <form method="POST">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title fa fa-cube"><label>Ajukan Permohonan Persetujuan</label></h4>
        </div>
        <div class="modal-body">
          <input type="text" name="id_bon" hidden="hidden">
          <label class="hidden"><input type="text" name="yang_meminta" value="<?php echo $user['jabatan']; ?>"></label>
          <div class="form-group">
            <label>Diajukan kepada :</label>
            <div class="checkbox">
              <label><input type="checkbox" name="tujuan[]" alt="Checkbox" value="Kepala Divisi Production Manager">Kepala Divisi Production Manager</label><br>
              <label><input type="checkbox" name="tujuan[]" alt="Checkbox" value="Kepala Gudang">Kepala Gudang</label>
            </div>
          </div>
          <div class="form-group">
            <label>Perihal</label>
            <input type="text" class="form-control" name="perihal" placeholder="Contoh: Memohon Persetujuan">
          </div>
          <div class="modal-footer">
            <button class="btn btn-success fa fa-send" name="ajukan" value="ajukan" title="Ajukan Persetujuan" data-content="Popover body content is set in this attribute."> Ajukan</button>
          </div>
        </div>
      </div>
    </form>

  </div>
</div>
<!-- Modal Pengajuan approval ke Kepala Gudang dan Administrasi -->

<!-- Modal Status alasan approval -->
<div id="status_alasan" class="modal fade" role="dialog">
  <div class="modal-dialog body-blue">

    <!-- Modal content-->
    <form method="POST">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title fa fa-cube"> <label>Detail Pengajuan</label></h4>
        </div>
        <div class="modal-body" id="detail_pengajuan"></div>
      </div>
    </form>

  </div>
</div>
<!-- Modal Status Alasan approval -->