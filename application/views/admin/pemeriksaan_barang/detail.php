<style>
  @media print{
    .col-md-3
    {
      width: 30%;
      float: left;
    }
    .col-md-9
    {
      width: 70%;
      float: left;
    }
  }
</style>

<style type="text/css">
  .body-blue {
    border: 1px solid #3c8dbc;
  }
</style>

<section class="content">

  <h5 class="hidden-print">
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url("admin/home"); ?>"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Transaksi</li>
      <li class="active"><a href="<?php echo base_url("admin/pemeriksaan_barang/pemeriksaan_barang"); ?>" style="color: #777;" onclick="return confirm('Anda yakin hendak meninggalkan halaman ini?')">Pemeriksaan Barang (QC)</a></li>
      <li class="active">Detail</li>
    </ol>
  </h5>

  <div class="row">

    <div class="col-xs-1"></div>

    <div class="col-xs-10">

      <!-- /.box-header -->
      <div class="box body-blue">
        <!-- /.box-header -->

        <div class="box-body" style="padding-top: 25px;">
          <!-- text input -->
          <div class="form-group">
            <div class="col-md-12">
              <div>
                <h3><i><b>PT. SINAR UTAMA SEJAHTERA</b></i></h3>
                <h3 class="text-center"><u><b>DETAIL PEMERIKSAAN BARANG</b></u></h3>
                <hr>
              </div>
              <div class="col-xs-12">
                <table>
                  <tr>
                    <th width="170"><h4 style="font-size: 14px;"><b>No.Pemeriksaan Barang</b></h4></th>
                    <td>:</td>
                    <td>&nbsp; <?php echo $ambil_pemeriksaan['no_pemeriksaan_barang']; ?></td>
                  </tr>
                </table>
              </div>
              <div class="col-xs-12">
                <table>
                  <tr>
                    <th width="170"><h4 style="font-size: 14px;"><b>No.LPB</b></h4></th>
                    <td>:</td>
                    <td>&nbsp; <?php echo $ambil_periksa['no_lpb']; ?></td>
                  </tr>
                </table>
              </div>
              <div class="col-xs-12">
                <table>
                  <tr>
                    <th width="170"><h4 style="font-size: 14px;"><b>Supplier</b></h4></th>
                    <td>:</td>
                    <td>&nbsp; <?php echo $ambil_periksa['nama_supplier']; ?></td>
                  </tr>
                </table>
              </div>
              <div class="col-xs-12">
                <table>
                  <tr>
                    <th width="170"><h4 style="font-size: 14px;"><b>Tanggal Pemeriksaan</b></h4></th>
                    <td>:</td>
                    <td>&nbsp; <?php echo $ambil_pemeriksaan['tgl_periksa']; ?></td>
                  </tr>
                </table>
              </div>
              <div class="col-xs-12">
                <table>
                  <tr>
                    <th width="170"><h4 style="font-size: 14px;"><b>Nama Barang</b></h4></th>
                    <td>:</td>
                    <td>&nbsp; 
                      <?php if (!empty($ambil_pemeriksaan['nama_barang']=="-")): ?>
                        <?php echo $ambil_periksa['nama_barang']; ?>
                      <?php elseif (!empty($ambil_pemeriksaan['nama_barang']!=="-")): ?>
                        <?php echo $ambil_pemeriksaan['nama_barang']; ?>
                      <?php endif ?>
                    </td>
                  </tr>
                </table>
              </div>
              <div class="col-xs-12">
                <table>
                  <tr>
                    <th width="170"><h4 style="font-size: 14px;"><b>Qty</b></h4></th>
                    <td>:</td>
                    <td>&nbsp; <?php echo $ambil_periksa['qty_sjm']; ?></td>
                  </tr>
                </table>
              </div>
              <div class="col-xs-12">
                <table>
                  <tr>
                    <th width="170"><h4 style="font-size: 14px;"><b>Qty Reject</b></h4></th>
                    <td>:</td>
                    <td>&nbsp; <?php echo $ambil_pemeriksaan['qty_reject']; ?></td>
                  </tr>
                </table>
              </div>
              <div class="col-xs-12">
                <table>
                  <tr>
                    <th width="170"><h4 style="font-size: 14px;"><b>Tindakan</b></h4></th>
                    <td>:</td>
                    <td>&nbsp; <?php echo $ambil_pemeriksaan['tindakan']; ?></td>
                  </tr>
                </table>
              </div>
              <div class="col-xs-12">
                <table>
                  <tr>
                    <th width="170"><h4 style="font-size: 14px;"><b>Hasil Pemeriksaan</b></h4></th>
                    <td>:</td>
                    <td>&nbsp; <?php echo strip_tags($ambil_pemeriksaan['hasil_periksa']); ?></td>
                  </tr>
                </table>
                <br>
              </div>
              <!-- <div class="col-xs-12">
                <table>
                  <tr>
                    <th width="170" style="padding-bottom: 210px;"><h4 style="font-size: 15px;"><b>Hasil Pemeriksaan</b></h4></th>
                    <td style="padding-bottom: 210px;">:</td>
                    <td width="1000" style="padding-left: 8px; padding-top: 10px;"><textarea class="ckeditor" id="ckeditor" disabled="true" ><?php //echo $ambil_pemeriksaan['hasil_periksa']; ?></textarea></td>
                  </tr>
                </table>
              </div> -->
              <!-- <div class="col-xs-12" style="padding-top: 15px; padding-bottom: 15px;">
                <button class="btn btn-primary fa fa-print hidden-print" onclick="window.print()"> Cetak PDF</button>
              </div> -->
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>