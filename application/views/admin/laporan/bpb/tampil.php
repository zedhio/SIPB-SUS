<section class="content">

  <h5>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url("admin/home"); ?>"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Laporan</li>
      <li class="active"><a href="<?php echo base_url("admin/laporan/bpb"); ?>" style="color: #777;">BPB</a></li>
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
                  <th style="padding-left: 700px;">
                    <button name="rekap_bpb" value="rekap_bpb" class="btn btn-info btn-sm fa fa-map-o" title="Lihat Rekap" data-content="Popover body content is set in this attribute."> Rekapitulasi Laporan BPB</button>
                  </th>
                </tr>
              </thead>
            </table>
          </form>
        </div>
        
        <div class="box-body" style="padding-top: 10px;">
          <table class="table table-bordered table-striped" id="example1"> 
            <thead style="background-color: #D3D3D3">
              <tr>
                <th class="text-center">No</th>
                <th class="text-center">No.BPB</th>
                <th class="text-center">Tanggal Dibuat</th>
                <th class="text-center">No.PO</th>
                <th class="text-center">Nama PO</th>
                <th class="text-center">Buyer</th>
                <th class="text-center">Style</th>
                <th class="text-center">Aksi</th>
              </tr>
            </thead>

            <?php 
            $no = 1;
            ?>

            <tbody>
              <?php foreach ($laporan as $key => $value): ?>
                <?php foreach ($value['distribusi'] as $kunci => $isi): ?>
                  <?php if (!empty($isi['tujuan']=="Administrasi Gudang")): ?>
                    <tr>
                      <td class="text-center"><?php echo $no++; ?></td>
                      <td class="text-center"><?php echo $value['no_bpb']; ?></td>
                      <td class="text-center"><?php echo $value['tgl_dibuat']; ?></td>
                      <td class="text-center"><?php echo $value['no_po']; ?></td>
                      <td class="text-center"><?php echo $value['nama_po']; ?></td>
                      <td class="text-center"><?php echo $value['nama_buyer']; ?></td>
                      <td class="text-center"><?php echo $value['nama_style']; ?></td>
                      <td class="text-center">
                        <!-- detail -->
                        <a href="<?php echo base_url("admin/laporan/bpb/detail/$value[id_bpb]"); ?>" class="btn btn-info btn-sm" title="Detail" data-content="Popover body content is set in this attribute."><i class="fa fa-info"></i></a>

                        <a href="<?php echo base_url("admin/laporan/bpb/preview_bpb/$value[id_bpb]"); ?>" class="btn btn-primary btn-sm" title="Download File (PDF)" data-content="Popover body content is set in this attribute."><i class="fa fa-download"></i></a>
                        <!-- detail -->
                      </td>
                    </tr>
                  <?php endif ?>
                <?php endforeach ?>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>
        
      </div>
    </div>
  </div>
</section>