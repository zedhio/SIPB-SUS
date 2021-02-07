<section class="content">

  <h5>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url("user/home"); ?>"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Data Master</li>
      <li class="active"><a href="<?php echo base_url("user/data_master/style_glove/style_glove"); ?>" style="color: #777;">Style Glove</a></li>
    </ol>
  </h5>

  <div class="row">
    <div class="col-xs-12">
      <div class="panel panel-heading">
        <div class="box-header">
          <h3 class="box-title fa fa-building-o"> Style Glove</h3>
          <hr>
        </div>
        <div class="box-body">
          <table class="table table-bordered table-striped" id="example1"> 
            <thead style="background-color: #D3D3D3">
              <tr>
                <th class="text-center">No</th>
                <th class="text-center">Nama Style Glove</th>
                <th class="text-center">Keterangan</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($style as $key => $value): ?>
                <tr>
                  <td class="text-center" width="30"><?php echo $key+1; ?></td>
                  <td class="text-center" width="200"><?php echo $value['nama_style']; ?>
                  <td class="text-justify"><?php echo strip_tags($value['keterangan']); ?></td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>