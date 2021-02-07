  <style type="text/css">
    .body-blue {
      border: 1px solid #3c8dbc;
    }
  </style>

  <section class="content">

    <h5>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url("user/home"); ?>"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Transaksi</li>
        <li class="active"><a href="<?php echo base_url("user/reject_barang_produksi/reject_barang_produksi"); ?>" style="color: #777;">Reject Barang Produksi</a></li>
      </ol>
    </h5>

    <div class="row">
      <div class="col-xs-12">
        <div class="panel panel-heading">
          <div class="box-header">
            <h3 class="box-title fa fa-arrow-circle-left"> Reject Barang Produksi</h3>
            <hr>
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
                      <button class="btn btn-primary fa fa-search" name="cari" value="cari" title="Cari" data-content="Popover body content is set in this attribute."> Cari</button>
                    </th>
                  </tr>
                </thead>
              </table>
            </form>
          </div>
          <div class="box-body">
            <form method="POST">
              <table class="table table-bordered table-striped"> 
                <thead style="background-color: #D3D3D3">
                  <tr>
                    <th class="text-center" width="25">No</th>
                    <th class="text-center" width="180">No.Reject Barang Produksi</th>
                    <th class="text-center" width="150">Tanggal Reject</th>
                    <th class="text-center">Untuk P.O</th>
                    <th class="text-center">Buyer</th>
                    <th class="text-center">Style Glove</th>
                    <th class="text-center">Nama Barang</th>
                    <th class="text-center" width="90">Qty Reject</th>
                    <th class="text-center">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach ($reject as $key => $value): ?>
                    <tr>
                      <td class="text-center"><?php echo $key+1; ?></td>
                      <td class="text-center"><?php echo $value['no_reject_barang_produksi']; ?></td>
                      <td class="text-center"><?php echo $value['tgl_reject']; ?></td>
                      <td class="text-center"><?php echo $value['nama_po']; ?></td>
                      <td class="text-center"><?php echo $value['nama_buyer']; ?></td>
                      <td class="text-center"><?php echo $value['nama_style']; ?></td>
                      <td class="text-center"><?php echo $value['nama_barang']; ?></td>
                      <td class="text-center"><?php echo $value['qty_reject']; ?></td>
                      <td class="text-center">

                        <a href="<?php echo base_url("user/reject_barang_produksi/reject_barang_produksi/detail/$value[id_reject_barang_produksi]"); ?>" class="btn btn-info btn-sm" title="Detail" data-content="Popover body content is set in this attribute." ><i class="fa fa-info"></i></a>

                        <!-- <a href="<?php //echo base_url("user/reject_barang_produksi/reject_barang_produksi/ubah/$value[id_reject_barang_produksi]"); ?>" class="btn btn-success btn-sm" title="Ubah" data-content="Popover body content is set in this attribute." ><i class="fa fa-pencil"></i></a> -->

                        <!-- <a href="<?php //echo base_url("user/reject_barang_produksi/reject_barang_produksi/hapus/$value[id_reject_barang_produksi]"); ?>" class="btn btn-danger btn-sm" title="Hapus" data-content="Popover body content is set in this attribute." ><i class="fa fa-trash"></i></a> -->

                      </td>
                    </tr>
                  <?php endforeach ?>
                </tbody>
              </table>
            </form>
            <br>
            <a class="btn btn-primary btn-sm fa fa-plus" title="Tambah" data-content="Popover body content is set in this attribute."  href="<?php echo base_url("user/reject_barang_produksi/reject_barang_produksi/tambah") ?>">  Tambah</a>
          </div>
        </div>
      </div>
    </div>
  </section>