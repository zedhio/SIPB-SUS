<style type="text/css">
  .center {
    margin: auto;
    width: 100%;
    border: 1px solid white;
    padding-left: 0px;
  }
</style>

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
      <li><a href="<?php echo base_url("user/home"); ?>"><i class="fa fa-home"></i> Home</a></li>
    </ol>
  </h5>

  <div class="row">

    <div class="col-xs-9">

      <div class="panel panel-heading">

        <div class="box-header">
          <h3 class="box-title fa fa-align-justify"> Dashboard</h3>
          <hr>
        </div>

        <div class="alert alert-block alert" style="background-color: #E6E6FA;">
          <button type="button" class="close" data-dismiss="alert">
            <i class="ace-icon fa fa-times"></i>
          </button>
          <p class="text-center">Selamat datang <u><?php echo $user['nama_karyawan']; ?></u> di halaman Dashboard <?php echo $user['jabatan']; ?></p>
        </div>

        <!-- ================ Tampilan Home untuk level Staff PPIC ================ -->
        <?php if ($_SESSION['user']['level']=="Staff PPIC"): ?>
          <div class="box-body">
            <div class="row center-staff">
              <div class="col-md-3 text-center">
                <div class="info-box bg-white" style="padding-top: 20px;">
                  <label class="fa fa-th"> Data Master</label>
                  <h5> [ <?php echo count($style); ?> Style Glove ] [ <?php echo count($buyer); ?> Buyer ] </h5> 
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
                  <label class="fa fa-book"> Kartu Persediaan Barang</label>
                  <h5><?php echo count($kpb); ?></h5> 
                </div>
              </div>
              <div class="col-md-3 text-center">
                <div class="info-box bg-white" style="padding-top: 20px;">
                  <label class="fa fa-sticky-note-o"> Production Order</label>
                  <h5><?php echo count($production_order); ?></h5> 
                </div>
              </div>
              <div class="col-md-2 text-center">
                <div class="info-box bg-white" style="padding-top: 20px;">
                  <label class="fa fa-newspaper-o"> Rekapitulasi PO</label>
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
            </div>
          </div>
          <!-- ================ Tampilan Home untuk level Staff PPIC ================ -->

          <!-- ================ Tampilan Home untuk level K.Divisi Production Manager ================ -->
        <?php elseif($_SESSION['user']['level']=="Kepala Divisi Production Manager"): ?>
          <div class="box-body">
            <div class="row">
              <div class="col-md-2 text-center">
                <div class="info-box bg-white hidden" style="padding-top: 20px;">

                </div>
              </div>
              <div class="col-md-3 text-center">
                <div class="info-box bg-white" style="padding-top: 20px;">
                  <label class="fa fa-file-text-o"> Rekapitulasi Production Order</label>
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
                  <label class="fa fa-check"> Validasi</label>
                  <?php $total12; $total12 = count($validasi_po) / 3 + count($bpb1) ?>
                  <h5><?php echo $total12; ?></h5>    
                </div>
              </div>
              <div class="col-md-3 text-center">
                <div class="info-box bg-white" style="padding-top: 15px;">
                  <h5>[ <?php echo count($validasi_po) / 3; ?> Production Order]</h5>
                  <h5>[ <?php echo count($bpb1); ?> BPB]</h5>    
                </div>
              </div>
              <div class="col-md-1 text-center">
                <div class="info-box bg-white hidden" style="padding-top: 15px;">   
                </div>
              </div>
            </div>
          </div>
          <!-- ================ Tampilan Home untuk level K.Divisi Production Manager ================ -->

          <!-- ================ Tampilan Home untuk level K.Gudang ================ -->
        <?php elseif($_SESSION['user']['level']=="Kepala Gudang"): ?>
          <div class="box-body">
            <div class="row center">
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
                  <label class="fa fa-check"> Validasi</label>
                  <?php $total8 = count($validasi_po) / 3 + count($bpb2=[2]); ?>
                  <h5><?php echo $total8; ?></h5>
                </div>
              </div>
              <div class="col-md-3 text-center">
                <div class="info-box bg-white" style="padding-top: 13px;">

                  <h5>[ <?php echo count($validasi_po) / 3; ?> Production Order ]</h5>
                  <h5>[ <?php echo count($bpb1); ?> BPB ]</h5>
                </div>
              </div>
            </div>
          </div>
          <!-- ================ Tampilan Home untuk level K.Gudang ================ -->

          <!-- ================ Tampilan Home untuk level Direktur ================ -->
        <?php elseif($_SESSION['user']['level']=="Direktur"): ?>
          <div class="box-body">
            <div class="row">
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
              <div class="col-md-1 text-center">
                <div class="info-box bg-white" style="padding-top: 20px;">
                  <p> Validasi</p>
                  <?php $total_val = 0; $total_val = count($validasi_po) / 3; $total=0; $total = $total_val + count($sjk); ?>
                  <h5><?php echo $total; ?></h5>    
                </div>
              </div>
              <div class="col-md-2 text-center">
                <div class="info-box bg-white" style="padding-top: 13px;">
                  <?php $total_val = 0; $total_val = count($validasi_po) / 3; ?>
                  <h5>[ <?php echo $total_val; ?> Production Order]</h5>
                  <h5>[ <?php echo count($sjk); ?> Surat Jalan Keluar]</h5>    
                </div>
              </div>
              <div class="col-md-1 text-center">
                <div class="info-box bg-white" style="padding-top: 20px;">
                  <span style="width: 0px; height: 50px; border: 1px #777 solid;"></span>
                  <h5><span style="width: 0px; height: 50px; border: 1px #777 solid;"></span></h5>    
                </div>
              </div>
              <div class="col-md-1 text-center">
                <div class="info-box bg-white" style="padding-top: 20px;">
                  <p> Laporan</p>
                  <?php 
                  $total1 = 0;

                  $total100 = 0;

                  foreach ($sjk as $key => $value)
                  {
                    if (!empty($value['distribusi']))
                    {
                      $total100 = count($value['distribusi']) / 4;
                    }
                  }

                  $total1 = count($lap_lpb) + count($lap_bpb) + $total100;
                  ?>
                  <h5><?php echo $total1; ?></h5> 
                </div>
              </div>
              <div class="col-md-1 text-center">
                <div class="info-box bg-white" style="padding-top: 13px;">
                  <h5>[ <?php echo count($lap_lpb); ?> LPB ]</h5>
                  <h5>[ <?php echo count($lap_bpb); ?> BPB ]</h5>        
                </div>
              </div>
              <div class="col-md-2 text-center">
                <div class="info-box bg-white" style="padding-top: 13px;">
                  <h5> Surat Jalan Keluar</h5>
                  <h5> [ <?php foreach ($sjk as $key => $value): ?>
                <?php if (!empty($value['distribusi'])): ?>
                  <?php echo count($value['distribusi']) / 4; ?>
                <?php endif ?>
              <?php endforeach ?> ]</h5>    
                </div>
              </div>
            </div>
          </div>
          <!-- ================ Tampilan Home untuk level Direktur ================ -->

          <!-- ================ Tampilan Home untuk level K.Divisi Purchase Order ================ -->
        <?php elseif($_SESSION['user']['level']=="Kepala Divisi Purchase Order"): ?>
          <div class="box-body">
            <div class="row">
              <div class="col-md-1 text-center">
                <div class="info-box bg-white" style="padding-top: 20px;">

                </div>
              </div>
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
                  <label class="fa fa-check"> Validasi</label>
                  <h5>[ <?php echo count($validasi); ?> LPB ]</h5>    
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
                  <label class="fa fa-file-text-o"> Laporan</label>
                  <?php $total11=0; $total11 = count($lap_lpb) + count($lap_bpb); ?>
                  <h5><?php echo $total11; ?></h5>    
                </div>
              </div>
              <div class="col-md-1 text-center">
                <div class="info-box bg-white" style="padding-top: 13px;">
                  <h5>[ <?php echo count($lap_lpb); ?> LPB ]</h5>
                  <h5>[ <?php echo count($lap_bpb); ?> BPB ]</h5>        
                </div>
              </div>
              <div class="col-md-1 text-center">
                <div class="info-box bg-white" style="padding-top: 20px;">

                </div>
              </div>
            </div>
          </div>
          <!-- ================ Tampilan Home untuk level K.Divisi Purchase Order ================ -->

          <!-- ================ Tampilan Home untuk level K.Divisi Hutang Dagang ================ -->        
        <?php elseif($_SESSION['user']['level']=="Kepala Divisi Hutang Dagang"): ?>
          <div class="box-body">
            <div class="row">
              <div class="col-md-3 text-center">
                <div class="info-box bg-white hidden" style="padding-top: 20px;">

                </div>
              </div>
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
                  <label class="fa fa-file-text-o"> LPB</label>
                  <h5><?php echo count($lap_lpb); ?></h5>    
                </div>
              </div>
              <div class="col-md-3 text-center">
                <div class="info-box bg-white hidden" style="padding-top: 20px;">

                </div>
              </div>
            </div>
          </div>
          <!-- ================ Tampilan Home untuk level K.Divisi Hutang Dagang ================ -->

          <!-- ================ Tampilan Home untuk level K.Divisi Accounting ================ -->
        <?php elseif($_SESSION['user']['level']=="Kepala Divisi Accounting"): ?>
          <div class="box-body">
            <div class="row">
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
                  <label class="fa fa-file-text-o"> Laporan</label>
                  <?php $total8 = 0; $total8 = count($lap_lpb) + count($lap_bpb) + count($sjk); ?>
                  <h5><?php echo $total8; ?></h5>    
                </div>
              </div>
              <div class="col-md-1 text-center">
                <div class="info-box bg-white" style="padding-top: 13px;">
                  <h5>[ <?php echo count($lap_lpb); ?> LPB ]</h5>
                  <h5>[ <?php echo count($lap_bpb); ?> BPB ]</h5>        
                </div>
              </div>
              <div class="col-md-2 text-center">
                <div class="info-box bg-white" style="padding-top: 13px;">
                  <h5> Surat Jalan Keluar</h5>
                  <h5> [ <?php echo count($sjk); ?> ]</h5>    
                </div>
              </div>
            </div>
          </div>
          <!-- ================ Tampilan Home untuk level K.Divisi Accounting ================ -->

          <!-- ================ Tampilan Home untuk level K.Divisi EXIM ================ -->
        <?php elseif($_SESSION['user']['level']=="Kepala Divisi EXIM"): ?>
          <div class="box-body">
            <div class="row">
              <div class="col-md-3 text-center">
                <div class="info-box bg-white hidden" style="padding-top: 20px;">

                </div>
              </div>
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
                  <label class="fa fa-file-text-o"> Laporan</label>
                  <h5>[ <?php echo count($laporan1=[3]); ?> Surat Jalan Keluar]</h5>    
                </div>
              </div>
              <div class="col-md-3 text-center">
                <div class="info-box bg-white hidden" style="padding-top: 20px;">

                </div>
              </div>
            </div>
          </div>
          <!-- ================ Tampilan Home untuk level K.Divisi EXIM ================ -->

          <!-- ================ Tampilan Home untuk level Staff Unit Sewing ================ -->
        <?php elseif($_SESSION['user']['level']=="Staff Unit Sewing"): ?>
          <div class="box-body">
            <div class="row">
              <div class="col-md-2 text-center">
                <div class="info-box bg-white hidden" style="padding-top: 20px;">

                </div>
              </div>
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
              <div class="col-md-3 text-center">
                <div class="info-box bg-white" style="padding-top: 13px;">
                  <h5 class="fa fa-arrow-left"> <?php echo count($bon); ?> BON</h5><br>    
                  <h5 class="fa fa-arrow-circle-left"> <?php echo count($reject); ?> Reject Barang Produksi</h5>
                </div>
              </div>
              <div class="col-md-2 text-center">
                <div class="info-box bg-white" style="padding-top: 20px;">
                  <label class="fa fa-file-text-o"> Lap.Production Order</label>
                  <?php foreach ($laporan as $key => $value): ?>
                    <?php 
                    $total = 0;
                    ?>
                    <?php if (!empty($value['distribusi'])): ?>
                      <?php if ($value['distribusi'][1]['tujuan']=="Staff Unit Sewing"): ?>
                        <h5><?php echo $total+1; ?></h5>    
                      <?php endif ?>
                    <?php endif ?>
                  <?php endforeach ?>  
                </div>
              </div>
              <div class="col-md-2 text-center">
                <div class="info-box bg-white hidden" style="padding-top: 20px;">

                </div>
              </div>
            </div>
          </div>
          <!-- ================ Tampilan Home untuk level Staff Unit Sewing ================ -->

          <!-- ================ Tampilan Home untuk level K.Unit Sewing ================ -->          
        <?php else: ?>
          <div class="box-body">
            <div class="row">
              <div class="col-md-3 text-center">
                <div class="info-box bg-white hidden" style="padding-top: 20px;">
                  <label class="fa fa-newspaper-o"> Rekapitulasi Production Order</label>
                  <h5><?php echo count($rekap_po); ?></h5>    
                </div>
              </div>
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
                  <label class="fa fa-check"> Validasi</label>
                  <h5>[ <?php echo count($bpb1=[0]); ?> BPB ]</h5>    
                </div>
              </div>
              <div class="col-md-3 text-center">
                <div class="info-box bg-white hidden" style="padding-top: 20px;">
                  <label class="fa fa-newspaper-o"> Rekapitulasi Production Order</label>
                  <h5><?php echo count($rekap_po); ?></h5>    
                </div>
              </div>
            </div>
          </div>
          <!-- ================ Tampilan Home untuk level K.Unit Sewing ================ -->

        <?php endif ?>        
        <!-- <div class="box-body">
          <div class="col-md-12 text-center">
            <div id="mainb" style="height:350px;"></div>
          </div>
        </div> -->
      </div>
    </div>

    <div class="col-xs-3">
      <div class="panel panel-heading">
        <div class="box-header">
          <span class="box-title fa fa-align-justify"> Deskripsi Aplikasi</span>
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