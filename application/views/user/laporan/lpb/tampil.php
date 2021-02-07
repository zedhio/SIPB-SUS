<section class="content">

  <h5>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url("user/home"); ?>"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Laporan</li>
      <li class="active"><a href="<?php echo base_url("user/laporan/lpb"); ?>" style="color: #777;">Penerimaan Barang</a></li>
    </ol>
  </h5>

  <div class="row">
    <div class="col-xs-12">
      <div class="panel panel-heading">
        <div class="box-header">
          <h3 class="box-title fa fa-file-text-o"> Laporan Penerimaan Barang</h3>
          <hr>
        </div>

        <div class="box-body">
          <form role="form" method="POST">
            <table>
              <thead>
                <tr>
                  <th width="150">Tanggal Diterima (Awal)</th>
                  <th width="150" style="padding-left: 10px;">
                    <div class="input-group">
                      <input type="text" id="datepicker" class="form-control" name="tgl_awal1" placeholder="2018-10-22" size="12">
                    </div>
                  </th>
                  <th width="170" style="padding-left: 10px;">Tanggal Diterima (Akhir)</th>
                  <th style="padding-left: 10px;">
                    <div class="input-group">
                      <input type="text" id="datepicker1" class="form-control" name="tgl_akhir1" placeholder="2018-10-22" size="8">
                    </div>
                  </th>
                  <th style="padding-left: 10px;">
                    <button name="cari10" value="cari10" class="btn btn-primary btn-sm fa fa-search"> Cari</button>
                  </th>
                  <th style="padding-left: 560px;">
                    <button name="rekap" value="rekap" class="btn btn-info btn-sm fa fa-map-o" title="Lihat Rekap" data-content="Popover body content is set in this attribute."> Rekapitulasi LPB</button>
                  </th>
                </tr>
              </thead>
            </table>
          </form>
        </div>
        
        <?php if($_SESSION['user']['level']=="Kepala Divisi Purchase Order"): ?>
          <div class="box-body" style="padding-top: 10px;">
            <table class="table table-bordered table-striped" id="example1"> 
              <thead style="background-color: #D3D3D3">
                <tr>
                  <th class="text-center">No</th>
                  <th class="text-center">No.LPB</th>
                  <!-- <th class="text-center">No.Surat Jalan Masuk</th> -->
                  <th class="text-center">Keterangan</th>
                  <th class="text-center">Tanggal Diterima</th>
                  <th class="text-center">Asal</th>
                  <th class="text-center">File</th>
                </tr>
              </thead>

              <?php 
              $no = 1;
              ?>

              <tbody>
                <?php foreach ($laporan as $key => $value): ?>
                  <?php if (!empty($value['distribusi'])): ?>
                    <?php if ($value['distribusi'][0]['tujuan']=="Kepala Divisi Purchase Order"): ?>
                      <tr>
                        <td class="text-center"><?php echo $no++; ?></td>
                        <td class="text-center"><?php echo $value['no_lpb']; ?></td>
                        <td class="text-center"><?php echo strip_tags($value['keterangan']); ?></td>
                        <td class="text-center"><?php echo $value['distribusi'][0]['tgl_diterima']; ?></td>
                        <td class="text-center"><?php echo "Administrasi Gudang"; ?></td>
                        <td class="text-center">
                          <!-- detail -->
                          <a href="<?php echo base_url("user/laporan/lpb/preview_lpb/$value[id_lpb]"); ?>" class="btn btn-info btn-sm" title="Lihat File (PDF)" data-content="Popover body content is set in this attribute."><i class="fa fa-file-pdf-o"></i></a>

                          <!-- <a href="<?php //echo base_url("user/laporan/lpb/detail/$value[id_lpb]"); ?>" class="btn btn-info btn-sm" title="Detail" data-content="Popover body content is set in this attribute."><i class="fa fa-info"></i></a> -->
                          
                          <!-- <a href="<?php //echo base_url("user/laporan/lpb/detail/$value[id_lpb]"); ?>" class="btn btn-info btn-sm" title="Detail" data-content="Popover body content is set in this attribute."><i class="fa fa-info"></i></a> -->
                          <!-- detail -->
                        </td>
                      </tr>
                    <?php endif ?>
                  <?php endif ?>
                <?php endforeach ?>
              </tbody>
            </table>
          </div>

        <?php elseif($_SESSION['user']['level']=="Kepala Divisi Hutang Dagang"): ?>
          <div class="box-body" style="padding-top: 10px;">
            <table class="table table-bordered table-striped" id="example1"> 
              <thead style="background-color: #D3D3D3">
                <tr>
                  <th class="text-center">No</th>
                  <th class="text-center">No.LPB</th>
                  <th class="text-center">Keterangan</th>
                  <th class="text-center">Tanggal Diterima</th>
                  <th class="text-center">Asal</th>
                  <th class="text-center">File</th>
                </tr>
              </thead>

              <?php 
              $no = 1;
              ?>

              <tbody>
                <?php foreach ($laporan as $key => $value): ?>
                  <?php if (!empty($value['distribusi'])): ?>
                    <?php if ($value['distribusi'][1]['tujuan']=="Kepala Divisi Hutang Dagang"): ?>
                      <tr>
                        <td class="text-center"><?php echo $no++; ?></td>
                        <td class="text-center"><?php echo $value['no_lpb']; ?></td>
                        <td class="text-center"><?php echo strip_tags($value['keterangan']); ?></td>
                        <td class="text-center"><?php echo $value['distribusi'][0]['tgl_diterima']; ?></td>
                        <td class="text-center"><?php echo "Administrasi Gudang"; ?></td>
                        <td class="text-center">
                          <a href="<?php echo base_url("user/laporan/lpb/preview_lpb/$value[id_lpb]"); ?>" class="btn btn-info btn-sm" title="Lihat File (PDF)" data-content="Popover body content is set in this attribute."><i class="fa fa-file-pdf-o"></i></a>
                        </td>
                      </tr>
                    <?php endif ?>
                  <?php endif ?>
                <?php endforeach ?>
              </tbody>
            </table>
          </div>

          <?php elseif($_SESSION['user']['level']=="Kepala Divisi Accounting"): ?>
          <div class="box-body" style="padding-top: 10px;">
            <table class="table table-bordered table-striped" id="example1"> 
              <thead style="background-color: #D3D3D3">
                <tr>
                  <th class="text-center">No</th>
                  <th class="text-center">No.LPB</th>
                  <th class="text-center">Keterangan</th>
                  <th class="text-center">Tanggal Diterima</th>
                  <th class="text-center">Asal</th>
                  <th class="text-center">File</th>
                </tr>
              </thead>

              <?php 
              $no = 1;
              ?>

              <tbody>
                <?php foreach ($laporan as $key => $value): ?>
                  <?php if (!empty($value['distribusi'])): ?>
                    <?php if ($value['distribusi'][2]['tujuan']=="Kepala Divisi Accounting"): ?>
                      <tr>
                        <td class="text-center"><?php echo $no++; ?></td>
                        <td class="text-center"><?php echo $value['no_lpb']; ?></td>
                        <td class="text-center"><?php echo strip_tags($value['keterangan']); ?></td>
                        <td class="text-center"><?php echo $value['distribusi'][0]['tgl_diterima']; ?></td>
                        <td class="text-center"><?php echo "Administrasi Gudang"; ?></td>
                        <td class="text-center">
                          <!-- detail -->
                          <a href="<?php echo base_url("user/laporan/lpb/preview_lpb/$value[id_lpb]"); ?>" class="btn btn-info btn-sm" title="Lihat File (PDF)" data-content="Popover body content is set in this attribute."><i class="fa fa-file-pdf-o"></i></a>
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
                  <th class="text-center">No.LPB</th>
                  <th class="text-center">Keterangan</th>
                  <th class="text-center">Tanggal Diterima</th>
                  <th class="text-center">Asal</th>
                  <th class="text-center">File</th>
                </tr>
              </thead>

              <?php 
              $no = 1;
              ?>

              <tbody>
                <?php foreach ($laporan as $key => $value): ?>
                  <?php if (!empty($value['distribusi'])): ?>
                    <?php if ($value['distribusi'][3]['tujuan']=="Direktur"): ?>
                      <tr>
                        <td class="text-center"><?php echo $no++; ?></td>
                        <td class="text-center"><?php echo $value['no_lpb']; ?></td>
                        <td class="text-center"><?php echo strip_tags($value['keterangan']); ?></td>
                        <td class="text-center"><?php echo $value['distribusi'][0]['tgl_diterima']; ?></td>
                        <td class="text-center"><?php echo "Administrasi Gudang"; ?></td>
                        <td class="text-center">
                          <a href="<?php echo base_url("user/laporan/lpb/preview_lpb/$value[id_lpb]"); ?>" class="btn btn-info btn-sm" title="Lihat File (PDF)" data-content="Popover body content is set in this attribute."><i class="fa fa-file-pdf-o"></i></a>
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