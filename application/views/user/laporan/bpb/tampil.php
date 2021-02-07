<section class="content">

  <h5>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url("user/home"); ?>"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Laporan</li>
      <li class="active"><a href="<?php echo base_url("user/laporan/bpb"); ?>" style="color: #777;">Laporan Bukti Pengeluaran Barang</a></li>
    </ol>
  </h5>

  <div class="row">
    <div class="col-xs-12">
      <div class="panel panel-heading">
        <div class="box-header">
          <h3 class="box-title fa fa-file-text-o"> Laporan Bukti Pengeluaran Barang</h3>
          <hr>
        </div>

        <div class="box-body">
          <form role="form" method="POST" >
            <table>
              <thead>
                <tr>
                  <th>Tanggal Awal</th>
                  <th style="padding-left: 10px;">
                    <div class="input-group">
                      <input type="text" id="datepicker" class="form-control" name="tgl_awal" placeholder="22-10-2018" size="6">
                    </div>
                  </th>
                  <th style="padding-left: 10px;">Tanggal Akhir</th>
                  <th style="padding-left: 10px;">
                    <div class="input-group">
                      <input type="text" id="datepicker1" class="form-control" name="tgl_akhir" placeholder="22-10-2018" size="6">
                    </div>
                  </th>
                  <th style="padding-left: 10px;">
                    <button name="cari" value="cari" class="btn btn-primary btn-sm fa fa-search"> Cari</button>
                  </th>
                  <th style="padding-left: 703px;">
                    <button name="rekap_bpb" value="rekap_bpb" class="btn btn-info btn-sm fa fa-map-o" title="Lihat Rekap" data-content="Popover body content is set in this attribute."> Rekapitulasi Laporan BPB</button>
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
                  <th class="text-center">No.BPB</th>
                  <th class="text-center">No.PO</th>
                  <th class="text-center">Nama PO</th>
                  <th class="text-center">Buyer</th>
                  <th class="text-center">Style</th>
                  <th class="text-center">Tanggal Dibuat</th>
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
                    <?php if ($value['distribusi'][0]['tujuan']=="Kepala Divisi Accounting"): ?>
                      <tr>
                        <td class="text-center"><?php echo $no++; ?></td>
                        <td class="text-center"><?php echo $value['no_bpb']; ?></td>
                        <td class="text-center"><?php echo $value['no_po']; ?></td>
                        <td class="text-center"><?php echo $value['nama_po']; ?></td>
                        <td class="text-center"><?php echo $value['nama_buyer']; ?></td>
                        <td class="text-center"><?php echo $value['nama_style']; ?></td>
                        <td class="text-center"><?php echo $value['tgl_dibuat']; ?></td>
                        <td class="text-center"><?php echo $value['distribusi'][0]['asal']; ?></td>
                        <td class="text-center">
                          <!-- detail -->
                          <a href="<?php echo base_url("user/laporan/bpb/detail/$value[id_bpb]"); ?>" class="btn btn-info btn-sm" title="Detail" data-content="Popover body content is set in this attribute."><i class="fa fa-info"></i></a>
                          <!-- detail -->
                        </td>
                      </tr>
                    <?php endif ?>
                  <?php endif ?>
                <?php endforeach ?>
              </tbody>
            </table>
          </div>

        <?php elseif($_SESSION['user']['level']=="Kepala Divisi Purchase Order"): ?>
          <div class="box-body" style="padding-top: 10px;">
            <table class="table table-bordered table-striped" id="example1"> 
              <thead style="background-color: #D3D3D3">
                <tr>
                  <th class="text-center">No</th>
                  <th class="text-center">No.BPB</th>
                  <th class="text-center">No.PO</th>
                  <th class="text-center">Nama PO</th>
                  <th class="text-center">Buyer</th>
                  <th class="text-center">Style</th>
                  <th class="text-center">Tanggal Dibuat</th>
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
                    <?php if ($value['distribusi'][1]['tujuan']=="Kepala Divisi Purchase Order"): ?>
                      <tr>
                        <td class="text-center"><?php echo $no++; ?></td>
                        <td class="text-center"><?php echo $value['no_bpb']; ?></td>
                        <td class="text-center"><?php echo $value['no_po']; ?></td>
                        <td class="text-center"><?php echo $value['nama_po']; ?></td>
                        <td class="text-center"><?php echo $value['nama_buyer']; ?></td>
                        <td class="text-center"><?php echo $value['nama_style']; ?></td>
                        <td class="text-center"><?php echo $value['tgl_dibuat']; ?></td>
                        <td class="text-center"><?php echo $value['distribusi'][1]['asal']; ?></td>
                        <td class="text-center">
                          <!-- detail -->
                          <a href="<?php echo base_url("user/laporan/bpb/detail/$value[id_bpb]"); ?>" class="btn btn-info btn-sm" title="Detail" data-content="Popover body content is set in this attribute."><i class="fa fa-info"></i></a>
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
                  <th class="text-center">No.BPB</th>
                  <th class="text-center">No.PO</th>
                  <th class="text-center">Nama PO</th>
                  <th class="text-center">Buyer</th>
                  <th class="text-center">Style</th>
                  <th class="text-center">Tanggal Dibuat</th>
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
                    <?php if ($value['distribusi'][2]['tujuan']=="Direktur"): ?>
                      <tr>
                        <td class="text-center"><?php echo $no++; ?></td>
                        <td class="text-center"><?php echo $value['no_bpb']; ?></td>
                        <td class="text-center"><?php echo $value['no_po']; ?></td>
                        <td class="text-center"><?php echo $value['nama_po']; ?></td>
                        <td class="text-center"><?php echo $value['nama_buyer']; ?></td>
                        <td class="text-center"><?php echo $value['nama_style']; ?></td>
                        <td class="text-center"><?php echo $value['tgl_dibuat']; ?></td>
                        <td class="text-center"><?php echo $value['distribusi'][2]['asal']; ?></td>
                        <td class="text-center">
                          <!-- detail -->
                          <a href="<?php echo base_url("user/laporan/bpb/detail/$value[id_bpb]"); ?>" class="btn btn-info btn-sm" title="Detail" data-content="Popover body content is set in this attribute."><i class="fa fa-info"></i></a>
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