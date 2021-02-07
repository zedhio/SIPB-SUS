<section class="content">

  <h5>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url("admin/home"); ?>"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Data Master</li>
      <li class="active">Barang</li>
      <li class="active"><a href="<?php echo base_url("admin/data_master/barang/data_satuan/satuan"); ?>" style="color: #777;">Data Satuan</a></li>
    </ol>
  </h5>

  <div class="row">
    <div class="col-xs-12">
      <div class="panel panel-heading">
        <div class="box-header">
          <h3 class="box-title fa fa-cube"> Data Satuan</h3>
          <hr>
        </div>
        <div class="box-body">
          <table class="table table-bordered table-striped" id="example1"> 
            <thead style="background-color: #D3D3D3">
              <tr>
                <th class="text-center" width="30">No</th>
                <th class="text-center" width="150">Nama Satuan</th>
                <th class="text-center">Keterangan</th>
                <th class="text-center" width="120">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($satuan as $key => $value): ?>
                <tr>
                  <td class="text-center"><?php echo $key+1; ?></td>
                  <td class="text-center"><?php echo $value['satuan']; ?></td>
                  <td class="text-justify"><?php echo strip_tags($value['keterangan']); ?></td>
                  <td class="text-center">
                    <a href="<?php echo base_url("admin/data_master/barang/data_satuan/satuan/ubah/$value[id_satuan]"); ?>" class="btn btn-success btn-sm fa fa-pencil" title="Edit" data-content="Popover body content is set in this attribute." ></a>
                    <a href="<?php echo base_url("admin/data_master/barang/data_satuan/satuan/hapus/$value[id_satuan]"); ?>" class="btn btn-danger btn-sm fa fa-trash" title="Hapus" data-content="Popover body content is set in this attribute." onclick="return confirm('Apakah anda yakin ?')"></a>
                  </td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
          <br>
          <a class="btn btn-primary btn-sm fa fa-plus" title="Tambah" data-content="Popover body content is set in this attribute."  href="<?php echo base_url("admin/data_master/barang/data_satuan/satuan/tambah") ?>">  Tambah</a>
        </div>
      </div>
    </div>
  </div>
</section>