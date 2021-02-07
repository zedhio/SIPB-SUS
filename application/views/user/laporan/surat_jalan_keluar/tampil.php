<section class="content">

  <h5>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url("user/home"); ?>"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Laporan</li>
      <li class="active"><a href="<?php echo base_url("user/laporan/surat_jalan_keluar"); ?>" style="color: #777;">Surat Jalan Keluar</a></li>
    </ol>
  </h5>

  <div class="row">
    <div class="col-xs-12">
      <div class="panel panel-heading">
        <div class="box-header">
          <h3 class="box-title fa fa-file-text-o"> Laporan Surat Jalan Keluar</h3>
          <hr>
        </div>

        <div class="box-body">
          <form role="form" method="POST" >
            <table>
              <thead>
                <tr>
                  <th>Tanggal Diterima (Awal)</th>
                  <th style="padding-left: 10px;">
                    <div class="input-group">
                      <input type="text" id="datepicker" class="form-control" name="tgl_awal" placeholder="2018-10-22" size="6">
                    </div>
                  </th>
                  <th style="padding-left: 10px;">Tanggal Diterima (Akhir)</th>
                  <th style="padding-left: 10px;">
                    <div class="input-group">
                      <input type="text" id="datepicker1" class="form-control" name="tgl_akhir" placeholder="2018-10-22" size="6">
                    </div>
                  </th>
                  <th style="padding-left: 10px;">
                    <button name="cari" value="cari" class="btn btn-primary btn-sm fa fa-search"> Cari</button>
                  </th>
                  <th style="padding-left: 570px;">
                    <button name="rekap_sjk" value="rekap_sjk" class="btn btn-info btn-sm fa fa-map-o" title="Lihat Rekap" data-content="Popover body content is set in this attribute."> Rekapitulasi Laporan SJK</button>
                  </th>
                </tr>
              </thead>
            </table>
          </form>
        </div>
        
        <?php if($_SESSION['user']['level']=="Kepala Divisi Accounting"): ?>
          <div class="box-body" style="padding-top: 10px;">
            <table class="table table-bordered table-striped" id="example1"> 
              <thead style="background-color: #D3D3D3">
                <tr>
                  <th class="text-center">No</th>
                  <th class="text-center">No.Surat Jalan Keluar</th>
                  <th class="text-center">No.Pemeriksaan Barang</th>
                  <th class="text-center">Keterangan</th>
                  <th class="text-center">Ditujukan</th>
                  <th class="text-center">Tanggal Diterima</th>
                  <th class="text-center">Asal</th>
                  <th class="text-center">Aksi</th>
                </tr>
              </thead>

              <?php 
              $no = 1;
              ?>

              <tbody>
                <?php foreach ($laporan as $key => $value): ?>
                  <?php if (!empty($value['distribusi'])): ?>
                    <?php if ($value['distribusi'][1]['tujuan']=="Kepala Divisi Accounting"): ?>
                      <tr>
                        <td class="text-center" width="30"><?php echo $no++; ?></td>
                        <td class="text-center" width="170"><?php echo $value['no_sjk']; ?></td>
                        <td class="text-center" width="180">
                          <?php if (!empty($value['sjm']['no_pemeriksaan_barang'])): ?>
                            <?php echo $value['sjm']['no_pemeriksaan_barang']; ?>
                          <?php elseif (empty($value['sjm']['no_pemeriksaan_barang'])): ?>
                            <?php echo "-"; ?>
                          <?php endif ?>
                        </td>
                        <td class="text-center"><?php echo $value['sjm']['tindakan']; ?></td>
                        <td class="text-center"><?php echo $value['sjm']['nama_supplier']; ?></td>
                        <td class="text-center" width="150"><?php echo $value['distribusi'][0]['tgl_diterima']; ?></td>
                        <td class="text-center"><?php echo "Administrasi Gudang"; ?></td>
                        <td class="text-center">
                          <!-- detail -->
                          <!-- <a href="<?php //echo base_url("user/laporan/surat_jalan_keluar/detail/$value[id_sjk]"); ?>" class="btn btn-info btn-sm" title="Detail" data-content="Popover body content is set in this attribute."><i class="fa fa-info"></i></a> -->
                          <a href="<?php echo base_url("user/laporan/surat_jalan_keluar/preview_sjk/$value[id_sjk]"); ?>" class="btn btn-info btn-sm" title="Detail" data-content="Popover body content is set in this attribute."><i class="fa fa-file-pdf-o"></i></a>
                          <!-- detail -->
                        </td>
                      </tr>
                    <?php endif ?>
                  <?php endif ?>
                <?php endforeach ?>
              </tbody>
            </table>
          </div>

        <?php elseif($_SESSION['user']['level']=="Direktur"): ?>
          <div class="box-body" style="padding-top: 10px;">
            <table class="table table-bordered table-striped" id="example1"> 
              <thead style="background-color: #D3D3D3">
                <tr>
                  <th class="text-center">No</th>
                  <th class="text-center">No.Surat Jalan Keluar</th>
                  <th class="text-center">No.Pemeriksaan Barang</th>
                  <th class="text-center">Keterangan</th>
                  <th class="text-center">Ditujukan</th>
                  <th class="text-center">Tanggal Diterima</th>
                  <th class="text-center">Asal</th>
                  <th class="text-center">Aksi</th>
                </tr>
              </thead>

              <?php 
              $no = 1;
              ?>

              <tbody>
                <?php foreach ($laporan as $key => $value): ?>
                  <?php if (!empty($value['distribusi'])): ?>
                    <?php if ($value['distribusi'][0]['tujuan']=="Direktur"): ?>
                      <tr>
                        <td class="text-center" width="30"><?php echo $no++; ?></td>
                        <td class="text-center" width="170"><?php echo $value['no_sjk']; ?></td>
                        <td class="text-center" width="180">
                          <?php if (!empty($value['sjm']['no_pemeriksaan_barang'])): ?>
                            <?php echo $value['sjm']['no_pemeriksaan_barang']; ?>
                          <?php elseif (empty($value['sjm']['no_pemeriksaan_barang'])): ?>
                            <?php echo "-"; ?>
                          <?php endif ?>
                        </td>
                        <td class="text-center"><?php echo $value['sjm']['tindakan']; ?></td>
                        <td class="text-center"><?php echo $value['sjm']['nama_supplier']; ?></td>
                        <td class="text-center" width="150"><?php echo $value['distribusi'][0]['tgl_diterima']; ?></td>
                        <td class="text-center"><?php echo "Administrasi Gudang"; ?></td>
                        <td class="text-center">
                          <!-- detail -->
                          <!-- <a href="<?php //echo base_url("user/laporan/surat_jalan_keluar/detail/$value[id_sjk]"); ?>" class="btn btn-info btn-sm" title="Detail" data-content="Popover body content is set in this attribute."><i class="fa fa-info"></i></a> -->
                          <a href="<?php echo base_url("user/laporan/surat_jalan_keluar/preview_sjk/$value[id_sjk]"); ?>" class="btn btn-info btn-sm" title="Detail" data-content="Popover body content is set in this attribute."><i class="fa fa-file-pdf-o"></i></a>
                          <!-- detail -->
                        </td>
                      </tr>
                    <?php endif ?>
                  <?php endif ?>
                <?php endforeach ?>
              </tbody>
            </table>
          </div>

        <?php elseif($_SESSION['user']['level']=="Kepala Divisi EXIM"): ?>
          <div class="box-body" style="padding-top: 10px;">
            <table class="table table-bordered table-striped" id="example1"> 
              <thead style="background-color: #D3D3D3">
                <tr>
                  <th class="text-center">No</th>
                  <th class="text-center">No.Surat Jalan Keluar</th>
                  <th class="text-center">No.Pemeriksaan Barang</th>
                  <th class="text-center">Keterangan</th>
                  <th class="text-center">Ditujukan</th>
                  <th class="text-center">Tanggal Diterima</th>
                  <th class="text-center">Asal</th>
                  <th class="text-center">Aksi</th>
                </tr>
              </thead>

              <?php 
              $no = 1;
              ?>

              <tbody>
                <?php foreach ($laporan as $key => $value): ?>
                  <?php if (!empty($value['distribusi'])): ?>
                    <?php if ($value['distribusi'][2]['tujuan']=="Kepala Divisi EXIM"): ?>
                      <tr>
                        <td class="text-center" width="30"><?php echo $no++; ?></td>
                        <td class="text-center" width="170"><?php echo $value['no_sjk']; ?></td>
                        <td class="text-center" width="180">
                          <?php if (!empty($value['sjm']['no_pemeriksaan_barang'])): ?>
                            <?php echo $value['sjm']['no_pemeriksaan_barang']; ?>
                          <?php elseif (empty($value['sjm']['no_pemeriksaan_barang'])): ?>
                            <?php echo "-"; ?>
                          <?php endif ?>
                        </td>
                        <td class="text-center"><?php echo $value['sjm']['tindakan']; ?></td>
                        <td class="text-center"><?php echo $value['sjm']['nama_supplier']; ?></td>
                        <td class="text-center" width="150"><?php echo $value['distribusi'][0]['tgl_diterima']; ?></td>
                        <td class="text-center"><?php echo "Administrasi Gudang"; ?></td>
                        <td class="text-center">
                          <!-- detail -->
                          <!-- <a href="<?php //echo base_url("user/laporan/surat_jalan_keluar/detail/$value[id_sjk]"); ?>" class="btn btn-info btn-sm" title="Detail" data-content="Popover body content is set in this attribute."><i class="fa fa-info"></i></a> -->
                          <a href="<?php echo base_url("user/laporan/surat_jalan_keluar/preview_sjk/$value[id_sjk]"); ?>" class="btn btn-info btn-sm" title="Detail" data-content="Popover body content is set in this attribute."><i class="fa fa-file-pdf-o"></i></a>
                          <!-- detail -->
                        </td>
                      </tr>
                    <?php endif ?>
                  <?php endif ?>
                <?php endforeach ?>
              </tbody>
            </table>
          </div>

        <?php endif ?>
      </div>
    </div>
  </div>
</section>