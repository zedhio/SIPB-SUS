<section class="content">

  <h5>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url("admin/home"); ?>"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Data Master</li>
      <li class="active"><a href="<?php echo base_url("admin/data_master/supplier/supplier"); ?>" style="color: #777;">Supplier</a></li>
    </ol>
  </h5>

  <div class="row">
    <div class="col-xs-12">
      <div class="panel panel-heading">
        <div class="box-header">
          <h3 class="box-title fa fa-cube"> Supplier</h3>
          <hr>
        </div>
        <div class="box-body">
          <table class="table table-bordered table-striped" id="example1"> 
            <thead style="background-color: #D3D3D3">
              <tr>
                <th class="text-center">No</th>
                <th class="text-center">Kode Supplier</th>
                <th class="text-center">Nama Supplier</th>
                <th class="text-center">Alamat</th>
                <th class="text-center">Logo</th>
                <th class="text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($supplier as $key => $value): ?>
                <tr>  
                  <td class="text-center"><?php echo $key+1; ?></td>
                  <td class="text-center"><?php echo $value['kode_supplier']; ?>
                  <td class="text-center"><?php echo $value['nama_supplier']; ?></td>
                  <td class="text-justify"><?php echo strip_tags($value['alamat']); ?></td>
                  <td class="text-center">
                    <?php if (!empty($value['logo_supplier'])): ?>
                      <img src="<?php echo base_url("assets/images/logo_supplier/".$value['logo_supplier']); ?>" class="profile-user-img img-thumbnail">
                    <?php elseif (empty($value['logo_perusahaan'])): ?>
                      <img src="<?php echo base_url("assets/images/logo_supplier/no-image.png"); ?>" class="profile-user-img img-thumbnail">
                    <?php endif ?>  
                  </td>
                  <td class="text-center"><!-- 
                    <a href="#" class="btn btn-info btn-sm fa fa-info" title="Detail" data-content="Popover body content is set in this attribute." data-toggle="modal" data-target="#detail"></a> -->
                    <a href="<?php echo base_url("admin/data_master/supplier/supplier/detail/$value[id_supplier]"); ?>" class="btn btn-info btn-sm fa fa-info" title="Detail" data-content="Popover body content is set in this attribute." ></a>
                    <a href="<?php echo base_url("admin/data_master/supplier/supplier/ubah/$value[id_supplier]"); ?>" class="btn btn-success btn-sm fa fa-pencil" title="Edit" data-content="Popover body content is set in this attribute." ></a>
                    <a href="<?php echo base_url("admin/data_master/supplier/supplier/hapus/$value[id_supplier]"); ?>" class="btn btn-danger btn-sm fa fa-trash" title="Hapus" data-content="Popover body content is set in this attribute." onclick="return confirm('Apakah anda yakin ?')"></a>
                  </td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
          <br>
          <a class="btn btn-primary btn-sm fa fa-plus" title="Tambah" data-content="Popover body content is set in this attribute."  href="<?php echo base_url("admin/data_master/supplier/supplier/tambah") ?>">  Tambah</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Modal Detail-->
<!-- <div id="detail" class="modal fade" role="dialog">
  <div class="modal-dialog"> -->

    <!-- Modal content-->
    <!-- <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Detail Waktu</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Dibuat Oleh</label>
          <input type="text" class="form-control" value="">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div> -->