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

<style type="text/css">
  .body-black {
    border: 1px solid black;
  }
</style>

<section class="content">

  <h5 class="hidden-print">
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url("user/home"); ?>"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Transaksi</li>
      <li class="active"><a href="<?php echo base_url("user/reject_barang_produksi/reject_barang_produksi"); ?>" style="color: #777;" onclick="return confirm('Anda yakin hendak meninggalkan halaman ini?')">Reject Barang Produksi</a></li>
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
                <h3 class="text-center"><u><b>REJECT BARANG PRODUKSI</b></u></h3>
                <hr>
              </div>
              <br><br>
              <div class="col-xs-12" style="padding-left: 450px;">
                <table>
                  <tr>
                    <th width="85" style="font-size: 15px;">Style Glove</th>
                    <td>:</td>
                    <td style="font-size: 15px;">&nbsp; <?php echo $ambil_reject['nama_style']; ?></td>
                  </tr>
                </table>
              </div>
              <div class="col-xs-12" style="padding-left: 450px;">
                <table>
                  <tr>
                    <th width="85" style="font-size: 15px;">Qty</th>
                    <td>:</td>
                    <td style="font-size: 15px;">&nbsp; <?php echo $ambil_reject['qty']; ?></td>
                  </tr>
                </table>
              </div>
              <div class="col-xs-3" style="padding-top: 40px;padding-left: 40px;">
                <table>
                  <tr>
                    <th width="50">Bagian</th>
                    <td>:</td>
                    <td>&nbsp; <?php echo "Unit Sewing"; ?></td>
                  </tr>
                </table>
              </div>
              <div class="col-xs-3" style="padding-top: 40px;padding-left: 20px;">
                <table>
                  <tr>
                    <th width="50">Buyer</th>
                    <td>:</td>
                    <td>&nbsp; <?php echo $ambil_reject['nama_buyer']; ?></td>
                  </tr>
                </table>
              </div>
              <div class="col-xs-3" style="padding-top: 40px;padding-left: 20px;">
                <table>
                  <tr>
                    <th width="30">P.O</th>
                    <td>:</td>
                    <td>&nbsp; <?php echo $ambil_reject['nama_po']; ?></td>
                  </tr>
                </table>
              </div>
              <div class="col-xs-3" style="padding-top: 40px;padding-left: 10px;">
                <table>
                  <tr>
                    <th width="140">Tanggal Reject Barang</th>
                    <td>:</td>
                    <td>&nbsp; <?php echo $ambil_reject['tgl_reject']; ?></td>
                  </tr>
                </table>
              </div>

              <div class="col-xs-12"><br>
                <table class="body-black">
                  <!-- Header -->
                  <tr style="background-color: #ddd;">
                    <th class="text-center body-black" height="30" width="40"><h5 style="padding-top: 10px;"><b>No</b></h5></th>
                    <th class="text-center body-black" width="250"><h5 style="padding-top: 10px;"><b>Nama Barang</b></h5></th>
                    <th class="text-center body-black" width="180"><h5 style="padding-top: 10px;"><b>Jenis</b></h5></th>
                    <th class="text-center body-black" width="180"><h5 style="padding-top: 10px;"><b>Sub Jenis</b></h5></th>
                    <th class="text-center body-black" width="100"><h5 style="padding-top: 10px;"><b>Qty Reject</b></h5></th>
                    <th class="text-center body-black" width="75"><h5 style="padding-top: 10px;"><b>Satuan</b></h5></th>
                    <th class="text-center body-black" width="270"><h5 style="padding-top: 10px;"><b>Alasan Reject</b></h5></th>
                  </tr>
                  <!-- / Header -->

                  <!-- <pre>
                    <?php //print_r($ambil_lpb); ?>
                  </pre> -->

                  <?php $key = 0; ?>

                  <!-- Record -->
                  <tr>
                    <td class="text-center body-black" height="30" style="font-size: 14px;"><?php echo $key+1; ?></td>
                    <td class="text-center body-black" style="font-size: 14px;"><?php echo $ambil_reject['nama_barang']; ?></td>
                    <td class="text-center body-black" style="font-size: 14px;"><?php echo $ambil_reject['jenis']; ?></td>
                    <td class="text-center body-black" style="font-size: 14px;"><?php echo $ambil_reject['sub_jenis']; ?></td>
                    <td class="text-center body-black" style="font-size: 14px;"><?php echo $ambil_reject['qty_reject']; ?></td>
                    <td class="text-center body-black" style="font-size: 14px;"><?php echo $ambil_reject['satuan']; ?></td>
                    <td class="text-center body-black" style="font-size: 14px;"><?php echo strip_tags(substr($ambil_reject['alasan_reject'], 0, 46)); ?></td>
                  </tr>
                  <!-- Record -->
                </table>
              </div>
              <div class="col-xs-12" style="padding-top: 30px;">
                <!-- <button class="btn btn-primary fa fa-print hidden-print" onclick="window.print()"> Cetak PDF</button> -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
</section>