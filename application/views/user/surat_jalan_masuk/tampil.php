<section class="content">

  <h5>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url("user/home"); ?>"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Transaksi</li>
      <li class="active"><a href="<?php echo base_url("user/surat_jalan_masuk/surat_jalan_masuk"); ?>" style="color: #777;">Surat Jalan Masuk</a></li>
    </ol>
  </h5>

  <div class="row">
    <div class="col-xs-12">
      <div class="panel panel-heading">
        <div class="box-header">
          <h3 class="box-title fa fa-envelope-o"> Surat Jalan Masuk</h3>
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
          <!-- Bagian pencarian data surat jalan masuk berdasarkan tanggal -->

        </div>

        <?php if($_SESSION['user']['level']=="Kepala Gudang"): ?>
          <div class="box-body">

            <!-- Bagian menampilkan semua data surat jalan masuk -->
            <form role="form" method="POST" >
              <table class="table table-bordered table-striped"> 
                <thead style="background-color: #D3D3D3">
                  <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">No.Surat Jalan Masuk</th>
                    <th class="text-center">Tanggal Surat</th>
                    <th class="text-center">Supplier</th>
                    <th class="text-center">Keterangan</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($sjm as $key => $value): ?>
                    <tr>
                      <td class="text-center" width="30"><?php echo $key+1; ?></td>
                      <td class="text-center">
                        <?php if (!empty($sjm['no_sjm'])): ?>
                          <?php echo $value['no_sjm']; ?>
                        <?php elseif (empty($sjm['no_sjm'])): ?>
                          <?php echo "-"; ?>
                        <?php endif ?>
                      </td>
                      <td class="text-center"><?php echo date('d-m-Y',strtotime($value['tgl_masuk'])); ?></td>
                      <td class="text-center"><?php echo $value['nama_supplier']; ?></td>
                      <td class="text-center"><?php echo strip_tags($value['keterangan']); ?></td>
                      <td class="text-center">
                        <?php if (!empty($value['konfirmasi'])): ?>
                          <a class="btn-success btn-sm fa fa-check" title="Valid" data-content="Popover body content is set in this attribute."> <?php echo $value['konfirmasi']; ?></a>
                        <?php elseif (empty($value['konfirmasi'])): ?>
                          <a class="btn-default btn-sm" title="Not Valid" data-content="Popover body content is set in this attribute."> Mohon Beri TTD</a>
                        <?php endif ?>
                      </td>
                      <td class="text-center">
                        <!-- Beri tanda terima surat jalan masuk -->
                        <?php if (empty($value['konfirmasi'])): ?>
                          <button class="btn btn-warning btn-sm fa fa-check" title="Beri Tanda Terima" data-content="Popover body content is set in this attribute." name="ttd" value="<?php echo $value['id_sjm']; ?>"></button>
                        <?php endif ?>
                        <!-- Beri tanda terima surat jalan masuk -->

                        <!-- Detail surat jalan masuk -->
                        <a href="<?php echo base_url("user/surat_jalan_masuk/surat_jalan_masuk/detail/$value[id_sjm]"); ?>" class="btn btn-primary btn-sm fa fa-info" title="Detail" data-content="Popover body content is set in this attribute." ></a>
                        <!-- Detail surat jalan masuk -->

                        <?php if (empty($value['konfirmasi'])): ?>
                          <!-- Ubah surat jalan masuk -->
                          <a href="<?php echo base_url("user/surat_jalan_masuk/surat_jalan_masuk/ubah/$value[id_sjm]"); ?>" class="btn btn-success btn-sm fa fa-pencil" title="Edit" data-content="Popover body content is set in this attribute." ></a>
                          <!-- Ubah surat jalan masuk -->

                          <!-- Hapus surat jalan masuk -->
                          <a href="<?php echo base_url("user/surat_jalan_masuk/surat_jalan_masuk/hapus/$value[id_sjm]"); ?>" class="btn btn-danger btn-sm fa fa-trash" title="Hapus" data-content="Popover body content is set in this attribute." onclick="return confirm('Apakah anda yakin ?')"></a>
                          <!-- Hapus surat jalan masuk -->
                        <?php endif ?>
                      </td>
                    </tr>
                  <?php endforeach ?>
                </tbody>
              </table>
            </form>
            <!-- Bagian menampilkan semua data surat jalan masuk -->

            <br>
            <!-- Tombol tambah data surat jalan masuk -->
            <a class="btn btn-primary btn-sm fa fa-plus" title="Tambah" data-content="Popover body content is set in this attribute."  href="<?php echo base_url("user/surat_jalan_masuk/surat_jalan_masuk/tambah") ?>">  Tambah</a>
            <!-- Tombol tambah data surat jalan masuk -->

          </div>

        <?php elseif($_SESSION['user']['level']=="Kepala Divisi Accounting"): ?>
          <div class="box-body">
            <form role="form" method="POST" >
              <table class="table table-bordered table-striped"> 
                <thead style="background-color: #D3D3D3">
                  <tr>
                  <th class="text-center" width="30">No</th>
                    <th class="text-center">No.Surat Jalan Masuk</th>
                    <th class="text-center">Tanggal Surat</th>
                    <th class="text-center">Supplier</th>
                    <th class="text-center">Keterangan</th>
                    <th class="text-center">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($sjm as $key => $value): ?>
                    <tr>
                      <td class="text-center"><?php echo $key+1; ?></td>
                      <td class="text-center">
                        <?php if (!empty($value['no_sjm'])): ?>
                          <?php echo $value['no_sjm']; ?>
                        <?php elseif (empty($value['no_sjm'])): ?>
                          <?php echo "-"; ?>
                        <?php endif ?>
                      </td>
                      <td class="text-center"><?php echo $value['tgl_masuk']; ?></td>
                      <td class="text-center"><?php echo $value['nama_supplier']; ?></td>
                      <td class="text-center"><?php echo $value['keterangan']; ?></td>
                      <td class="text-center">
                        <a href="<?php echo base_url("user/surat_jalan_masuk/surat_jalan_masuk/detail/$value[id_sjm]"); ?>" class="btn btn-primary btn-sm fa fa-info" title="Detail" data-content="Popover body content is set in this attribute."></a>
                      </td>
                    </tr>
                  <?php endforeach ?>
                </tbody>
              </table>
            </form>

          </div>

        <?php endif ?>

      </div>
    </div>
  </div>
</section>