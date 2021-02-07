<section class="content">

  <h5>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url("user/home"); ?>"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Laporan</li>
      <li class="active"><a href="<?php echo base_url("user/laporan/production_order"); ?>" style="color: #777;">Production Order</a></li>
    </ol>
  </h5>

  <div class="row">
    <div class="col-xs-12">
      <div class="panel panel-heading">
        <div class="box-header">
          <h3 class="box-title fa fa-file-text-o"> Laporan Production Order</h3>
          <hr>
        </div>

        <div class="box-body">
          <form role="form" method="POST">
            <table>
              <thead>
                <tr>
                  <th width="160">Tanggal Diterima (Awal)</th>
                  <th width="150" style="padding-left: 10px;">
                    <div class="input-group">
                      <input type="text" id="datepicker" class="form-control" name="tgl_awal1" placeholder="2018-10-22" size="12">
                    </div>
                  </th>
                  <th width="175" style="padding-left: 10px;">Tanggal Diterima (Akhir)</th>
                  <th style="padding-left: 10px;">
                    <div class="input-group">
                      <input type="text" id="datepicker1" class="form-control" name="tgl_akhir1" placeholder="2018-10-22" size="8">
                    </div>
                  </th>
                  <th style="padding-left: 10px;">
                    <button name="cari10" value="cari10" class="btn btn-primary btn-sm fa fa-search"> Cari</button>
                  </th>
                  <!-- <th style="padding-left: 600px;">
                    <a href="<?php //echo base_url("user/rekapitulasi_production_order/rekapitulasi_production_order"); ?>" class="btn btn-info btn-sm fa fa-map-o" title="Lihat Rekap" data-content="Popover body content is set in this attribute."> Rekap.PO</a>
                  </th> -->
                </tr>
              </thead>
            </table>
          </form>
        </div>
        
        <?php if($_SESSION['user']['level']=="Staff Unit Sewing"): ?>
          <div class="box-body" style="padding-top: 10px;">
            <table class="table table-bordered table-striped" id="example1"> 
              <thead style="background-color: #D3D3D3">
                <tr>
                  <th class="text-center">No</th>
                  <th class="text-center">No.PO</th>
                  <!-- <th class="text-center">No.Surat Jalan Masuk</th> -->
                  <th class="text-center">Nama PO</th>
                  <th class="text-center">Style</th>
                  <th class="text-center">Buyer</th>
                  <th class="text-center">Qty</th>
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
                    <?php if ($value['distribusi'][1]['tujuan']=="Staff Unit Sewing"): ?>
                      <tr>
                        <td class="text-center"><?php echo $no++; ?></td>
                        <td class="text-center"><?php echo $value['no_po']; ?></td>
                        <td class="text-center"><?php echo $value['nama_po']; ?></td>
                        <td class="text-center"><?php echo $value['nama_style']; ?></td>
                        <td class="text-center"><?php echo $value['nama_buyer']; ?></td>
                        <td class="text-center"><?php echo $value['qty']; ?> Pcs</td>
                        <td class="text-center"><?php echo $value['distribusi'][1]['tgl_diterima']; ?></td>
                        <td class="text-center"><?php echo $value['distribusi'][1]['asal']; ?></td>
                        <td class="text-center">
                          <!-- detail -->
                          <a href="<?php echo base_url("user/laporan/production_order/preview_lap_po/$value[id_po]"); ?>" class="btn btn-info btn-sm" title="Lihat File (PDF)" data-content="Popover body content is set in this attribute."><i class="fa fa-file-pdf-o"></i></a>

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