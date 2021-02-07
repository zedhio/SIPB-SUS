<style type="text/css">
  .center-staff {
    margin: auto;
    width: 100%;
    border: 1px solid white;
    padding-left: 0px;
  }
</style>

<section class="content">

  <h5>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url("admin/home"); ?>"><i class="fa fa-home"></i> Home</a></li>
    </ol>
  </h5>

  <div class="row">

    <div class="col-xs-9">
      <div class="panel panel-heading">
        <div class="box-body">
          <h3 style="font-size: 18px;" class="box-title fa fa-align-justify"> Dashboard</h3>
          <hr>
          <div class="row center-staff">
            <div class="col-md-3 text-center">
              <div class="info-box bg-white" style="padding-top: 20px;">
                <label class="fa fa-newspaper-o"> Rekapitulasi Production Order</label>
                <?php foreach ($rekap_po as $key => $value): ?>
                    <?php 
                    $total = 0;
                    ?>
                    <?php foreach ($value['po'] as $number => $content): ?>
                      <?php if ($content['jml_disetujui']==3): ?>
                        <?php 
                        $total+=1; 
                        ?>
                        <h5><?php echo $total; ?></h5>    
                      <?php endif ?>
                    <?php endforeach ?>
                  <?php endforeach ?>
              </div>
            </div>
            <div class="col-md-1 text-center">
              <div class="info-box bg-white" style="padding-top: 20px;">
                <span style="width: 0px; height: 50px; border: 1px #777 solid;"></span>
                <h5><span style="width: 0px; height: 50px; border: 1px #777 solid;"></span></h5>    
              </div>
            </div>
            <div class="col-md-2 text-center">
              <div class="info-box bg-white" style="padding-top: 20px;">
                <label class="fa fa-envelope-o"> Surat Jalan Masuk</label>
                <h5><?php echo count($sjm); ?></h5> 
              </div>
            </div>
            <div class="col-md-1 text-center">
              <div class="info-box bg-white" style="padding-top: 20px;">
                <span style="width: 0px; height: 50px; border: 1px #777 solid;"></span>
                <h5><span style="width: 0px; height: 50px; border: 1px #777 solid;"></span></h5>    
              </div>
            </div>
            <div class="col-md-2 text-center">
              <div class="info-box bg-white" style="padding-top: 20px;">
                <label class="fa fa-check-circle-o"> Pemeriksaan Barang</label>
                <h5><?php echo count($periksa); ?></h5> 
              </div>
            </div>
            <div class="col-md-1 text-center">
              <div class="info-box bg-white" style="padding-top: 20px;">
                <span style="width: 0px; height: 50px; border: 1px #777 solid;"></span>
                <h5><span style="width: 0px; height: 50px; border: 1px #777 solid;"></span></h5>    
              </div>
            </div>
            <!-- <div class="col-md-2 text-center">
              <div class="info-box bg-white" style="padding-top: 20px;">
                <label class="fa fa-book"> Kartu Persediaan Barang</label>
                <h5><?php //echo count($kpb); ?></h5> 
              </div>
            </div> -->
            <div class="col-md-2 text-center">
              <div class="info-box bg-white" style="padding-top: 20px;">
                <label class="fa fa-arrow-circle-left"> Reject Barang Produksi</label>
                <h5><?php echo count($reject); ?></h5> 
              </div>
            </div>
            <!-- <div class="col-md-3 text-center">
              <div class="info-box bg-white" style="padding-top: 20px;">
                <label class="fa fa-arrow-circle-left"> Reject Barang Produksi</label>
                <h5><?php //echo count($reject); ?></h5> 
              </div>
            </div> -->
            <div class="col-md-1 text-center">
              <div class="info-box bg-white hidden" style="padding-top: 20px;">

              </div>
            </div>
            <div class="col-md-3 text-center">
              <div class="info-box bg-white" style="padding-top: 20px;">
                <label class="fa fa-arrow-left"> BON</label>
                <h5><?php echo count($bon); ?></h5> 
              </div>
            </div>
            <div class="col-md-1 text-center">
              <div class="info-box bg-white" style="padding-top: 20px;">
                <span style="width: 0px; height: 50px; border: 1px #777 solid;"></span>
                <h5><span style="width: 0px; height: 50px; border: 1px #777 solid;"></span></h5>    
              </div>
            </div>
            <div class="col-md-2 text-center">
              <div class="info-box bg-white" style="padding-top: 20px;">
                <label class="fa fa-random"> BPB</label>
                <h5><?php echo count($bpb); ?></h5> 
              </div>
            </div>
            <div class="col-md-1 text-center">
              <div class="info-box bg-white" style="padding-top: 20px;">
                <span style="width: 0px; height: 50px; border: 1px #777 solid;"></span>
                <h5><span style="width: 0px; height: 50px; border: 1px #777 solid;"></span></h5>    
              </div>
            </div>
            <div class="col-md-3 text-center">
              <div class="info-box bg-white" style="padding-top: 20px;">
                <label class="fa fa-envelope"> Surat Jalan Keluar</label>
                <h5><?php echo count($sjk); ?></h5> 
              </div>
            </div>
            <div class="col-md-1 text-center">
              <div class="info-box bg-white hidden" style="padding-top: 20px;">
                
              </div>
            </div>
            <div class="col-md-2 text-center">
              <div class="info-box bg-white hidden" style="padding-top: 20px;">
              
              </div>
            </div>
            <div class="col-md-2 text-center">
              <div class="info-box bg-white" style="padding-top: 20px;">
                <label class="fa fa-file-text-o"> Laporan</label>
                <?php $total = 0; $total= count($lpb) + count($laporan) + count($laporan1); ?>
                <h5><?php echo $total; ?></h5>    
              </div>
            </div>
            <div class="col-md-1 text-center">
              <div class="info-box bg-white" style="padding-top: 13px;">
                <h5>[ <?php echo count($lpb); ?> LPB ]</h5>
                <h5>[ <?php echo count($laporan); ?> BPB ]</h5>        
              </div>
            </div>
            <div class="col-md-3 text-center">
              <div class="info-box bg-white" style="padding-top: 13px;">
                <h5>[ <?php echo count($laporan1); ?> Surat Jalan Keluar ]</h5>
                <h5>[ <?php foreach ($laporan2 as $key => $value): ?> <?php $total = 0; ?> <?php if (!empty($value['distribusi'])): ?>
                      <?php if ($value['distribusi'][0]['tujuan']=="Administrasi Gudang"): ?>
                        <?php echo $total+1; ?>    
                      <?php endif ?>
                    <?php endif ?> <?php endforeach ?> Production Order ]</h5>        
              </div>
            </div>
            <div class="col-md-3 text-center">
              <div class="info-box bg-white" style="padding-top: 13px;">
                <h5> Kartu Persediaan Barang</h5>
                <h5><?php echo count($kpb); ?></h5>
              </div>
            </div>
         </div>
       </div>
       <div class="box-body">
        <div class="col-md-12 text-center">
          <div id="mainb" style="height:350px;"></div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xs-3">
    <div class="panel panel-heading">
      <div class="box-header">
        <h3 class="box-title fa fa-align-justify"> Deskripsi Aplikasi</h3>
        <hr>
      </div>
      <div class="box-body">
        <label style="color: #3c8dbc;" class="fa fa-home"> SIPB SUS</label>
        <p align="justify" style="padding-top: 10px;">
          <b>Sistem Informasi Persediaan Barang (SIPB)</b> adalah sebuah aplikasi spesial yang mendukung operasional dari hari ke hari di gudang.
        </p>
        <h5 style="padding-top: 10px;"><b>Perusahaan</b></h5>
        <p>
          PT Sinar Utama Sejahtera
        </p>
      </div>
    </div>
  </div>

</div>

</section>