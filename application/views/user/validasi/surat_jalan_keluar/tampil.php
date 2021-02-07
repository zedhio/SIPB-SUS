<section class="content">

  <h5>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url("user/home"); ?>"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Validasi</li>
      <li class="active"><a href="<?php echo base_url("user/validasi/surat_jalan_keluar"); ?>" style="color: #777;">Surat Jalan Keluar</a></li>
    </ol>
  </h5>

  <div class="row">
    <div class="col-xs-12">
      <div class="panel panel-heading">
        <div class="box-header">
          <h3 class="box-title fa fa-check"> Validasi Surat Jalan Keluar</h3>
          <hr>

          <form role="form" method="POST" >

            <table>
              <thead>
                <tr>
                  <th>Tanggal Diajukan</th>
                  <th style="padding-left: 10px;">
                    <div class="input-group">
                      <input type="text" id="datepicker" class="form-control" name="tgl_awal" placeholder="2018-10-22" size="6">
                    </div>
                  </th>
                  <th style="padding-left: 10px;">Tanggal Dikonfirmasi</th>
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
        <div class="box-body" style="padding-top: 10px;">
          <table class="table table-bordered table-striped"> 
            <thead style="background-color: #D3D3D3">
              <tr>
                <th class="text-center">No</th>
                <th class="text-center">No.Surat Jalan Keluar</th>
                <th class="text-center">No.Pemeriksaan Barang</th>
                <th class="text-center">Ditujukan</th>
                <th class="text-center">No.Kendaraan</th>
                <th class="text-center">Keterangan</th>
                <th class="text-center">Tanggal Diajukan</th>
                <th class="text-center">Asal</th>
                <th class="text-center">Perihal</th>
                <th class="text-center">Tanggal Dikonfirmasi</th>
                <th class="text-center">Status</th>
                <th class="text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($sjk as $key => $value): ?>
                <?php if (!empty($value['validasi']['yang_meminta'])): ?>
                <tr>
                  <td class="text-center" width="30"><?php echo $key+1; ?></td>
                  <td class="text-center" width="120"><?php echo $value['no_sjk']; ?></td>
                  <td class="text-center" width="120"><?php echo $value['sjm']['no_pemeriksaan_barang']; ?></td>
                  <td class="text-center" width="150"><?php echo $value['sjm']['nama_supplier']; ?></td>
                  <td class="text-center">
                    <?php if(!empty($value['no_kendaraan'])): ?>
                      <?php echo $value['no_kendaraan']; ?>
                    <?php else: ?>
                      <?php echo "-"; ?>
                    <?php endif ?>
                  </td>
                  <td class="text-center"><?php echo $value['sjm']['tindakan']; ?></td>
                  <td class="text-center"><?php echo $value['validasi']['tgl_diajukan']; ?></td>
                  <td class="text-center"><?php echo $value['validasi']['yang_meminta']; ?></td>
                  <td class="text-center"><?php echo $value['validasi']['perihal']; ?></td>
                  <td class="text-center">
                    <?php if ($value['validasi']['tgl_dikonfirmasi']=="0000-00-00"): ?>
                      <?php echo "-"; ?>
                    <?php elseif ($value['validasi']['tgl_diajukan']!=="0000-00-00"): ?>
                      <?php echo $value['validasi']['tgl_dikonfirmasi']; ?>
                    <?php endif ?>
                  </td>
                  <td class="text-center" width="150">
                    <?php if(!empty($value['validasi']['status_pengajuan']=="Disetujui")): ?>
                      <a class="btn-success btn-sm"><i class="fa fa-check"></i> <?php echo $value['validasi']['status_pengajuan']; ?></a>
                    <?php elseif(!empty($value['validasi']['status_pengajuan']=="Ditolak")): ?>
                      <a class="btn-danger btn-sm"><i class="fa fa-close"></i>  <?php echo $value['validasi']['status_pengajuan']; ?></a>
                    <?php elseif(!empty($value['validasi'])): ?>
                      <a class="btn-warning btn-sm" readonly> Menunggu Konfirmasi</a>
                    <?php else: ?>
                      <a class="btn btn-default btn-sm" readonly> Mohon Ajukan</a>
                    <?php endif ?>
                  </td>
                  <td class="text-center" width="75">

                    <!-- Detail surat jalan keluar -->
                    <a type="button" href="<?php echo base_url("user/validasi/surat_jalan_keluar/detail/$value[id_sjk]"); ?>" class="btn btn-primary btn-sm" title="Detail" data-content="Popover body content is set in this attribute."><i class="fa fa-info"></i></a>
                    <!-- Detail surat jalan keluar -->

                    <!-- Konfirmasi Persetujuan -->
                    <?php if (empty($value['validasi']['status_pengajuan'])): ?>
                      <a href="#" class="konfirm-persetujuan-sjk btn btn-default btn-sm" title="Konfirmasi Persetujuan" data-content="Popover body content is set in this attribute." data-id="<?php echo $value['id_sjk']; ?>"><i class="fa fa-check"></i></a>
                    <?php endif ?>

                  </td>
                </tr>
                <?php endif ?>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Konfirmasi Persetujuan -->
<div id="konfirmasi_persetujuan_sjk" class="modal fade" role="dialog">
  <div class="modal-dialog body-blue">

    <!-- Modal content-->
    <form method="POST">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title fa fa-cube"> <label>Beri Konfirmasi Persetujuan</label></h4>
        </div>
        <div class="modal-body">
          <input type="text" name="id_sjk" class="hidden">
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