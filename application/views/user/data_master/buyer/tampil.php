<section class="content">

  <h5>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url("user/home"); ?>"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Data Master</li>
      <li class="active"><a href="<?php echo base_url("user/data_master/buyer/buyer"); ?>" style="color: #777;">Buyer</a></li>
    </ol>
  </h5>

  <div class="row">
    <div class="col-xs-12">
      <div class="panel panel-heading">
        <div class="box-header">
          <h3 class="box-title fa fa-list-alt"> Buyer</h3>
          <hr>
        </div>
        <div class="box-body">
          <table class="table table-bordered table-striped" id="example1"> 
            <thead style="background-color: #D3D3D3">
              <tr>
                <th class="text-center">No</th>
                <th class="text-center">Kode Buyer</th>
                <th class="text-center">Nama Buyer</th>
                <th class="text-center" style="width: 400px;">Alamat</th>
                <th class="text-center">Logo</th>
                <th class="text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($buyer as $key => $value): ?>
                <tr>
                  <td class="text-center"><?php echo $key+1; ?></td>
                  <td class="text-center"><?php echo $value['kode_buyer']; ?>
                    <td class="text-center"><?php echo $value['nama_buyer']; ?></td>
                    <td class="text-justify"><?php echo strip_tags($value['alamat']); ?></td>
                    <td class="text-center">
                      <?php if (!empty($value['logo_buyer'])): ?>
                        <img src="<?php echo base_url("assets/images/logo_buyer/".$value['logo_buyer']); ?>" class="profile-user-img img-thumbnail">
                      <?php elseif (empty($value['logo_buyer'])): ?>
                        <img src="<?php echo base_url("assets/images/logo_buyer/no-image.png"); ?>" class="profile-user-img img-thumbnail">
                      <?php endif ?>
                    </td>
                  <td class="text-center"><!-- 
                    <a href="#" class="btn btn-info btn-sm fa fa-info" title="Detail" data-content="Popover body content is set in this attribute." data-toggle="modal" data-target="#detail"></a> -->
                    <a href="<?php echo base_url("user/data_master/buyer/buyer/detail/$value[id_buyer]"); ?>" class="btn btn-success btn-sm fa fa-info" title="Detail" data-content="Popover body content is set in this attribute." ></a>
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