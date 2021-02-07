<style type="text/css">
  .body-blue {
    border: 1px solid #3c8dbc;
  }
</style>

<section class="content">

  <h5>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url("user/home"); ?>"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Laporan</li>
      <li class="active"><a href="<?php echo base_url("user/laporan/kartu_persediaan_barang"); ?>" style="color: #777;">Kartu Persediaan Barang</a></li>
    </ol>
  </h5>

  <div class="row">
    <div class="col-xs-12">
      <div class="panel panel-heading">
        <div class="box-header">
          <h3 class="box-title fa fa-file-text-o"> Kartu Persediaan Barang</h3>
          <hr>

          <!-- Bagian pencarian data laporan penerimaan barang -->
          <form role="form" method="POST" >
            <table>
              <thead>
                <tr>
                  <th>No.Kartu Persediaan Barang</th>
                  <th style="padding-left: 10px;">
                    <div class="input-group">
                      <input type="text" class="form-control" name="no_kpb" placeholder="HANG/H1/KPB/001">
                    </div>
                  </th>
                  <th style="padding-left: 10px;">
                    <button name="cari" value="cari" class="btn btn-primary btn-sm fa fa-search" title="Cari" data-content="Popover body content is set in this attribute."> Cari</button>
                  </th>
                </tr>
              </thead>
            </table>
          </form>
          
        </div>
        <div class="box-body">
          <table class="table table-bordered table-striped" id="example1"> 
            <thead style="background-color: #D3D3D3">
              <tr>
                <th class="text-center">No</th>
                <th class="text-center">No.Kartu Persediaan Barang</th>
                <th class="text-center">Kode Barang</th>
                <th class="text-center">Nama Barang</th>
                <th class="text-center">Jenis Barang</th>
                <th class="text-center">Sub Jenis Barang</th>
                <th class="text-center">Ukuran</th>
              </tr>
            </thead>
            <tbody>
                <?php foreach ($kpb as $key => $value): ?>
                <tr>
                  <td class="text-center"><?php echo $key+1; ?></td>
                  <td class="text-center">
                    <a href="<?php echo base_url("user/kartu_persediaan_barang/kartu_persediaan_barang/detail/$value[id_kpb]"); ?>">
                    <?php echo $value['no_kpb']; ?>
                    </a>
                  </td>
                  <td class="text-center"><?php echo $value['kode_barang']; ?></td>
                  <td class="text-center"><?php echo $value['nama_barang']; ?></td>
                  <td class="text-center"><?php echo $value['jenis']; ?></td>
                  <td class="text-center"><?php echo $value['sub_jenis']; ?></td>
                  <td class="text-center">
                    <?php if (!empty($value['ukuran'])): ?>
                      <?php echo $value['ukuran']; ?>
                    <?php elseif (empty($value['ukuran'])): ?>
                      <?php echo "-"; ?>
                    <?php endif ?>
                  </td>
                </tr>
                <?php endforeach ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>