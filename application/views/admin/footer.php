

      <!--------------------------
        | Your Page Content Here |
        -------------------------->

      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer hidden-print">
      <!-- To the right -->
      <div class="pull-right hidden-xs">
        <b>Version</b> 2.4.0
      </div>
      <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
      reserved.
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED JS SCRIPTS -->

  <!-- jQuery 3 -->
  <script src="<?php echo base_url("assets/bower_components/jquery/dist/jquery.min.js"); ?>"></script>

  <!-- Bootstrap 3.3.7 -->
  <script src="<?php echo base_url("assets/bower_components/bootstrap/dist/js/bootstrap.min.js"); ?>"></script>

  <!-- AdminLTE App -->
  <script src="<?php echo base_url("assets/dist/js/adminlte.min.js"); ?>"></script>

  <!-- dataTables -->
  <script src="<?php echo base_url("assets/bower_components/datatables.net/js/jquery.dataTables.min.js"); ?>"></script>
  <script src="<?php echo base_url("assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"); ?>"></script>
  <script>
    $(function () {
      $('.table-bordered').DataTable()
    });
  </script>

  <!-- ChartJS -->
  <script src="<?php echo base_url("assets/bower_components/echarts/echarts.min.js"); ?>"></script>

  <!-- FastClick -->
  <script src="<?php echo base_url("assets/bower_components/fastclick/lib/fastclick.js"); ?>"></script>

  <!-- AdminLTE for demo purposes -->
  <script src="<?php echo base_url("assets/dist/js/demo.js"); ?>"></script>

  <!-- Tambah Stok Barang Pintas -->
  <script type="text/javascript">
    $(document).ready(function() {
      $(".tambah-stok").on('click',function(){
        var beri_stok = $(this).data("id");
        $("#beri_stok").modal('show');
        $("input[name=id_barang]").val(beri_stok);
      })
    });
  </script>
  <!-- Tambah Stok Barang Pintas -->

  <script type="text/javascript">

    // ---------------------------- Notif Hasil Validasi BPB Kepala Unit Sewing ----------------------------
    $.ajax({
      url:'<?php echo base_url(); ?>index.php/admin/bpb/bpb/hitung_hasil_val_bpb_kus',
      success: function(data)
      {
        if (data=="")
        {
          $(".pesan_hasil_val_bpb_kus").addClass("hidden");
        }
        $("#notif_hasil_val_bpb_kus").html(data);
      }
    });
    
    // console.log("dat");
    $.ajax({
      url:"<?php echo base_url("admin/bpb/bpb/notif_hasil_data_val_bpb_kus"); ?>",
      dataType: 'json',
      success: function(data)
      {
        console.log(data);
        if (data!==null)
        {
          $(".pesan-hasil-val-bpb-kus").attr("data-id",data.id_val_bpb);
          $("#id_val_bpb").val(data.id_val_bpb);
          $("#no_bpb103").val(data.no_bpb);
          $("#tujuan103").val(data.tujuan);
          $("#status103").val(data.status_pengajuan);
          $("#alasan103").val(data.alasan);
          document.getElementById('ringtone_admin').play();
        }
        else
        {
          $(".pesan-hasil-val-bpb-kus").attr("");
          $("#id_val_bpb").val("");
          $("#no_bpb103").val("");
          $("#tujuan103").val("");
          $("#status103").val("");
          $("#alasan103").val("");  
        }
      }
    })
    // ---------------------------- Notif Hasil Validasi BPB Kepala Unit Sewing ----------------------------

    // ---------------------------- Notif Hasil Validasi BPB Kepala Gudang ----------------------------
    $.ajax({
      url:'<?php echo base_url(); ?>index.php/admin/bpb/bpb/hitung_hasil_val_bpb_kg',
      success: function(data)
      {
        if (data=="")
        {
          $(".pesan_hasil_val_bpb_kg").addClass("hidden");
        }
        $("#notif_hasil_val_bpb_kg").html(data);
      }
    });
    
    // console.log("dat");
    $.ajax({
      url:"<?php echo base_url("admin/bpb/bpb/notif_hasil_data_val_bpb_kg"); ?>",
      dataType: 'json',
      success: function(data)
      {
        console.log(data);
        if (data!==null)
        {
          $(".pesan-hasil-val-bpb-kg").attr("data-id",data.id_val_bpb);
          $("#id_val_bpb").val(data.id_val_bpb);
          $("#no_bpb104").val(data.no_bpb);
          $("#tujuan104").val(data.tujuan);
          $("#status104").val(data.status_pengajuan);
          $("#alasan104").val(data.alasan);
          document.getElementById('ringtone_admin').play();
        }
        else
        {
          $(".pesan-hasil-val-bpb-kg").attr("");
          $("#id_val_bpb").val("");
          $("#no_bpb104").val("");
          $("#tujuan104").val("");
          $("#status104").val("");
          $("#alasan104").val("");  
        }
      }
    })
    // ---------------------------- Notif Hasil Validasi BPB Kepala Gudang ----------------------------

    // ---------------------------- Notif Hasil Validasi BPB Kepala Divisi Production Manager ----------------------------
    $.ajax({
      url:'<?php echo base_url(); ?>index.php/admin/bpb/bpb/hitung_hasil_val_bpb_kdpm',
      success: function(data)
      {
        if (data=="")
        {
          $(".pesan_hasil_val_bpb_kdpm").addClass("hidden");
        }
        $("#notif_hasil_val_bpb_kdpm").html(data);
      }
    });
    
    // console.log("dat");
    $.ajax({
      url:"<?php echo base_url("admin/bpb/bpb/notif_hasil_data_val_bpb_kdpm"); ?>",
      dataType: 'json',
      success: function(data)
      {
        console.log(data);
        if (data!==null)
        {
          $(".pesan-hasil-val-bpb-kdpm").attr("data-id",data.id_val_bpb);
          $("#id_val_bpb").val(data.id_val_bpb);
          $("#no_bpb105").val(data.no_bpb);
          $("#tujuan105").val(data.tujuan);
          $("#status105").val(data.status_pengajuan);
          $("#alasan105").val(data.alasan);
          document.getElementById('ringtone_admin').play();
        }
        else
        {
          $(".pesan-hasil-val-bpb-kdpm").attr("");
          $("#id_val_bpb").val("");
          $("#no_bpb105").val("");
          $("#tujuan105").val("");
          $("#status105").val("");
          $("#alasan105").val("");  
        }
      }
    })

    // notif barang
    function cek(){
      $.ajax({
        url:'<?php echo base_url(); ?>index.php/admin/data_master/barang/data_barang/barang/hitung',
        success: function(data)
        {
          if (data=="")
          {
            $(".barang").addClass("hidden");
          }
          $("#barang").html(data);
        }
      });
    }

    function barang_kurang() {
      $.ajax({
        url:'<?php echo base_url(); ?>index.php/admin/data_master/barang/data_barang/barang/barang_kurang',
        success: function(data)
        {
          $("#barang_b").html(data);
          // document.getElementById('ringtone_admin').play();
        }
      });
    }

    setInterval(function(){ cek(); barang_kurang(); }, 500);
    // notif barang
    // ---------------------------- Notif Hasil Validasi BPB Kepala Divisi Production Manager ----------------------------
    
    // ---------------------------- Notif Hasil Validasi SJK Direktur ----------------------------
    $.ajax({
      url:'<?php echo base_url(); ?>index.php/admin/surat_jalan_keluar/surat_jalan_keluar/hitung_hasil_val_sjk_direk',
      success: function(data)
      {
        if (data=="")
        {
          $(".pesan_hasil_val_sjk_direk").addClass("hidden");
        }
        $("#notif_hasil_val_sjk_direk").html(data);
      }
    });
    
    // console.log("dat");
    $.ajax({
      url:"<?php echo base_url("admin/surat_jalan_keluar/surat_jalan_keluar/notif_hasil_data_val_sjk_direk"); ?>",
      dataType: 'json',
      success: function(data)
      {
        console.log(data);
        if (data!==null)
        {
          $(".pesan-hasil-val-sjk-direk").attr("data-id",data.id_val_sjk);
          $("#id_val_sjk").val(data.id_val_sjk);
          $("#no_sjk100").val(data.no_sjk);
          $("#tujuan106").val(data.tujuan);
          $("#status106").val(data.status_pengajuan);
          $("#alasan106").val(data.alasan);
          document.getElementById('ringtone_admin').play();
        }
        else
        {
          $(".pesan-hasil-val-sjk-direk").attr("");
          $("#id_val_sjk").val("");
          $("#no_sjk100").val("");
          $("#tujuan106").val("");
          $("#status106").val("");
          $("#alasan106").val("");  
        }
      }
    })
    // ---------------------------- Notif Hasil Validasi SJK Direktur ----------------------------

    // ---------------------------- Notif Hasil Validasi LPB Kepala Divisi Purchase Order ----------------------------
    $.ajax({
      url:'<?php echo base_url(); ?>index.php/admin/laporan/lpb/hitung_hasil_val_lpb_kdpo',
      success: function(data)
      {
        if (data=="")
        {
          $(".pesan_hasil_val_lpb_kdpo").addClass("hidden");
        }
        $("#notif_hasil_val_lpb_kdpo").html(data);
      }
    });
    
    // console.log("dat");
    $.ajax({
      url:"<?php echo base_url("admin/laporan/lpb/notif_hasil_data_val_lpb_kdpo"); ?>",
      dataType: 'json',
      success: function(data)
      {
        console.log(data);
        if (data!==null)
        {
          $(".pesan-hasil-val-lpb-kdpo").attr("data-id",data.id_val_lpb);
          $("#id_val_lpb").val(data.id_val_lpb);
          $("#no_lpb100").val(data.no_lpb);
          $("#tujuan107").val(data.tujuan);
          $("#status107").val(data.status_pengajuan);
          $("#alasan107").val(data.alasan);
          document.getElementById('ringtone_admin').play();
        }
        else
        {
          $(".pesan-hasil-val-lpb-kdpo").attr("");
          $("#id_val_lpb").val("");
          $("#no_lpb100").val("");
          $("#tujuan107").val("");
          $("#status107").val("");
          $("#alasan107").val("");  
        }
      }
    })
    // ---------------------------- Notif Hasil Validasi LPB Kepala Divisi Purchase Order ----------------------------

  </script>

  <script type="text/javascript">

    // ---------------------------- Notif Hasil Validasi BPB Kepala Unit Sewing ----------------------------
    $('.pesan-hasil-val-bpb-kus').on('click', function()
    {
      var id = $(this).data("id");
      $.ajax({
        url:'<?php echo base_url("admin/bpb/bpb/pesan_data_hasil_val_bpb_kus"); ?>',
        method:"POST",
        data:"id_val_bpb="+id,
        success:function()
        {
          location='<?php echo base_url("admin/bpb/bpb"); ?>';
        }
      })
    })
    // ---------------------------- Notif Hasil Validasi BPB Kepala Unit Sewing ----------------------------

    // ---------------------------- Notif Hasil Validasi BPB Kepala Gudang ----------------------------
    $('.pesan-hasil-val-bpb-kg').on('click', function()
    {
      var id = $(this).data("id");
      $.ajax({
        url:'<?php echo base_url("admin/bpb/bpb/pesan_data_hasil_val_bpb_kg"); ?>',
        method:"POST",
        data:"id_val_bpb="+id,
        success:function()
        {
          location='<?php echo base_url("admin/bpb/bpb"); ?>';
        }
      })
    })
    // ---------------------------- Notif Hasil Validasi BPB Kepala Gudang ----------------------------

    // ---------------------------- Notif Hasil Validasi BPB Kepala Divisi Production manager ----------------------------
    $('.pesan-hasil-val-bpb-kdpm').on('click', function()
    {
      var id = $(this).data("id");
      $.ajax({
        url:'<?php echo base_url("admin/bpb/bpb/pesan_data_hasil_val_bpb_kdpm"); ?>',
        method:"POST",
        data:"id_val_bpb="+id,
        success:function()
        {
          location='<?php echo base_url("admin/bpb/bpb"); ?>';
        }
      })
    })
    // ---------------------------- Notif Hasil Validasi BPB Kepala Divisi Production Manager ----------------------------

    // ---------------------------- Notif Hasil Validasi SJK Direktur ----------------------------
    $('.pesan-hasil-val-sjk-direk').on('click', function()
    {
      var id = $(this).data("id");
      $.ajax({
        url:'<?php echo base_url("admin/surat_jalan_keluar/surat_jalan_keluar/pesan_data_hasil_val_sjk_direk"); ?>',
        method:"POST",
        data:"id_val_sjk="+id,
        success:function()
        {
          location='<?php echo base_url("admin/surat_jalan_keluar/surat_jalan_keluar"); ?>';
        }
      })
    })
    // ---------------------------- Notif Hasil Validasi SJK Direktur ----------------------------

    // ---------------------------- Notif Hasil Validasi LPB Kepala Divisi Purchase Order ----------------------------
    $('.pesan-hasil-val-lpb-kdpo').on('click', function()
    {
      var id = $(this).data("id");
      $.ajax({
        url:'<?php echo base_url("admin/laporan/lpb/pesan_data_hasil_val_lpb_kdpo"); ?>',
        method:"POST",
        data:"id_val_lpb="+id,
        success:function()
        {
          location='<?php echo base_url("admin/laporan/lpb"); ?>';
        }
      })
    })
    // ---------------------------- Notif Hasil Validasi LPB Kepala Divisi Purchase Order ----------------------------

  </script>

  <!-- Javascript agar menampi

  <script type="text/javascript"></script>lkan data per id untuk tampilan ubah selanjutnya pada ubah data kartu persediaan barang -->  
  <script>
    $(document).ready(function(){
      $("#kpb").on('click',function(){
        var id = $(this).data("id");
        $.ajax({
          url:"<?php echo base_url(); ?>index.php/admin/kartu_persediaan_barang/kartu_persediaan_barang/radio",
          method:"POST",
          data:{id_bukti_kpb:id},
          dataType:'json',
          success:function(data)
          {
            console.log(data.keterangan);
            $("#id_bukti_kpb").val(data.id_bukti_kpb);
            $("#tgl_masuk").val(data.tgl_masuk);
            // var ket = $(".keterangan").val(data.keterangan);
            // $(ket).attr("checked","checked");
            $("#no_bukti").val(data.no_bukti);
            $("#keterangan").val(data.keterangan);
            $("#qty_masuk").removeAttr("readonly");
            $("#qty_masuk").val(data.qty_masuk);
            $("#qty_keluar").removeAttr("readonly");
            $("#qty_keluar").val(data.qty_keluar);
            $("#saldo").removeAttr("saldo");
            $("#saldo").val(data.saldo);
            $("#ubah").removeAttr("disabled");
          }
        })
      })
    })
  </script>
  <!-- Javascript agar menampilkan data per id untuk tampilan ubah selanjutnya pada ubah data kartu persediaan barang -->

  <!-- untuk tambah no kendaraan berdasarkan id_sjk menggunakan modal -->
  <script type="text/javascript">
    $(document).ready(function() {
      $(".tambah-no-kendaraan").on('click',function(){
        var beri_no_kendaraan = $(this).data("id");
        $("#beri_no_kendaraan").modal('show');
        $("input[name=id_sjk]").val(beri_no_kendaraan);
      })
    });
  </script>

  <!-- Javascript untuk menampilkan Modal Pengajuan approval BPB ke K.Unit Sewing, K.Gudang & K.Div.Prod.Man -->
  <script type="text/javascript">
    $(document).ready(function() {
      $(".validasi-bpb").on('click',function(){
        var pengajuan = $(this).data("id");
        $("#ajukan_persetujuan_bpb").modal('show');
        $("input[name=id_bpb]").val(pengajuan);
      })
    });
  </script>

  <!-- Javascript untuk menampilkan Modal Status alasan approval bpb dari K.Unit Sewing, K.Gudang & K.Div.Prod.Man -->
  <script type="text/javascript">
    $(document).ready(function() {
      $(".stat-alasan-bpb").on('click',function(){
        var persetujuan = $(this).data("id");
        $("#status_alasan_bpb").modal('show');
        // console.log(persetujuan);
        $.ajax({
          url:'<?php echo base_url();?>index.php/admin/bpb/bpb/status_alasan',
          method:'POST',
          dataType:'json',
          data:{id_bpb:persetujuan},
          success:function(data)
          {
            console.log(persetujuan);
            if(data!==null)
            {
              var bpb = "";
              for(var i=0;i<data.length;i++)
              {
               bpb += "<input type='text' name='id_bpb' class='hidden' value='"+data[i].id_bpb+"'>"+"<input type='text' class='hidden' name='id_val_bpb' value='"+data[i].id_val_bpb+"'><div class='form-group'><label>Dari</label><span style='padding-left: 24px;'>: </span><span>"+data[i].tujuan+"</span></div><div class='form-group'><label>Status</label><span style='padding-left: 12px;'>: </span><span>"+data[i].status_pengajuan+"</span></div><div class='form-group'><label>Alasan</label><span style='padding-left: 12px;'>: </span><span>"+data[i].alasan+"</span></div><br>";           
             }

             $("#detail_pengajuan_bpb").html(bpb);

           }
           else
           {
            for(var i=1;i<=data.length;i++)
            {
              $("input[name=id_bpb]").val("");
              $("input[name=id_val_bpb]").val("");
              $('#tujuan').html("");
              $('#status').html("");
              $('#alasan').html("");              
            }
          }
        }
      });
      })
    });
  </script>
  
  <!-- Javascript untuk menampilkan Modal Pengajuan approval Surat Jalan Keluar ke Direktur -->
  <script type="text/javascript">
    $(document).ready(function() {
      $(".validasi-sjk").on('click',function(){
        var pengajuan = $(this).data("id");
        $("#ajukan_persetujuan_sjk").modal('show');
        $("input[name=id_sjk]").val(pengajuan);
      })
    });
  </script>
  <!-- Javascript untuk menampilkan Modal Pengajuan approval Surat Jalan Keluar ke Direktur -->

  <!-- Javascript untuk menampilkan Modal Pembuatan LPB ke Admin dari penerimaan barang -->
  <script type="text/javascript">
    $(document).ready(function() {
      $(".buat-lpb").on('click',function(){
        var make_lpb = $(this).data("id");
        var kode = $(this).data("kode");
        $("#buat_lpb").modal('show');
        $("input[name=id_sjm]").val(make_lpb);
        $("input[name=no_sjm]").val(kode);
      })
    });
  </script>

  <!-- Javascript untuk menampilkan Modal Pembuatan LPB ke Admin dari penerimaan barang -->
  <script type="text/javascript">
    $(document).ready(function() {
      $(".buat-sjk").on('click',function(){
        var make_sjk = $(this).data("id");
        var kode = $(this).data("kode");
        $("#buat_sjk").modal('show');
        $("input[name=id_pemeriksaan_barang]").val(make_sjk);
        $("input[name=no_pemeriksaan_barang]").val(kode);
      })
    });
  </script>

  <!-- Javascript untuk menampilkan Modal Pengajuan approval LPB ke K.Purchase Order -->
  <script type="text/javascript">
    $(document).ready(function() {
      $(".validasi-lpb").on('click',function(){
        var pengajuan = $(this).data("id");
        $("#ajukan_persetujuan").modal('show');
        $("input[name=id_lpb]").val(pengajuan);
      })
    });
  </script>
  <!-- Javascript untuk menampilkan Modal Pengajuan approval LPB ke K.Purchase Order -->

  <!-- Javascript untuk menampilkan Modal Status Pengajuan approval LPB dari K.Purchase Order -->
  <script type="text/javascript">
    $(document).ready(function() {
      $(".stat-persetujuan").on('click',function(){
        var persetujuan = $(this).data("id");
        $("#status_persetujuan").modal('show');
        console.log(persetujuan);
        $.ajax({
          url:'<?php echo base_url();?>index.php/admin/laporan/lpb/status_persetujuan',
          method:'POST',
          dataType:'json',
          data:{id_lpb:persetujuan},
          success:function(data)
          {
            console.log(data);
            $("#detail_konfirmasi").modal('show');
            if(data!==null)
            {
              $('#no_lpb').html(data.no_lpb); 
              $('#status').html(data.status_pengajuan); 
              $('#alasan').html(data.alasan); 
            }
            else
            {
              $('#no_lpb').html("");
              $('#status').html(""); 
              $('#alasan').html(""); 
            }
          }
        });
      })
    });
  </script>
  <!-- Javascript untuk menampilkan Modal Status Pengajuan approval LPB dari K.Purchase Order -->

  <!-- Javascript untuk menampilkan Modal Distribusi SJK yang sudah approve ke Accounting dan EXIM -->  
  <script type="text/javascript">
    $(document).ready(function() {
      $(".distribusi-sjk").on('click',function(){
        var kirim = $(this).data("id");
        $("#kirim_laporan_sjk").modal('show');
        $("input[name=id_sjk]").val(kirim);
        $("#kirim").hide();
      })
    });
  </script>
  <!-- Javascript untuk menampilkan Modal Distribusi LPB yang sudah approve ke Accounting, Hutang Dagang dan Purchase Order -->

  <!-- Javascript untuk menampilkan Modal Distribusi LPB yang sudah approve ke Accounting, Hutang Dagang dan Purchase Order -->  
  <script type="text/javascript">
    $(document).ready(function() {
      $(".distribusi-lpb").on('click',function(){
        var kirim = $(this).data("id");
        $("#kirim_laporan").modal('show');
        $("input[name=id_lpb]").val(kirim);
        $("#kirim").hide();
      })
    });
  </script>
  <!-- Javascript untuk menampilkan Modal Distribusi LPB yang sudah approve ke Accounting, Hutang Dagang dan Purchase Order -->

  <!-- Javascript untuk menampilkan Modal Distribusi SJK yang sudah approve ke Accounting dan EXIM -->  
  <script type="text/javascript">
    $(document).ready(function() {
      $(".distribusi-bpb").on('click',function(){
        var kirim = $(this).data("id");
        $("#kirim_laporan_bpb").modal('show');
        $("input[name=id_bpb]").val(kirim);
        $("#kirim").hide();
      })
    });
  </script>

  <!-- Javascript untuk membaca dan menampilkan foto -->
  <script type="text/javascript">
    $(document).ready( function() {
      $(document).on('change', '.btn-file :file', function() {
        var input = $(this),
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [label]);
      });

      $('.btn-file :file').on('fileselect', function(event, label) {

        var input = $(this).parents('.input-group').find(':text'),
        log = label;
        
        if( input.length ) {
          input.val(log);
        } else {
          if( log ) alert(log);
        }
        
      });

      function readURL(input) {
        if (input.files && input.files[0]) {
          var reader = new FileReader();
          
          reader.onload = function (e) {
            $('#img-upload').attr('src', e.target.result);
          }
          
          reader.readAsDataURL(input.files[0]);
        }
      }

      $("#imgInp").change(function(){
        readURL(this);
      });

    });
  </script>
  <!-- Javascript untuk membaca dan menampilkan foto -->

  <!-- EChart -->
  <script>
    var theme = {
      color: [
      '#26B99A', '#34495E', '#BDC3C7', '#3498DB',
      '#9B59B6', '#8abb6f', '#759c6a', '#bfd3b7'
      ],

      title: {
        itemGap: 8,
        textStyle: {
          fontWeight: 'normal',
          color: '#408829'
        }
      },

      dataRange: {
        color: ['#1f610a', '#97b58d']
      },

      toolbox: {
        color: ['#408829', '#408829', '#408829', '#408829']
      },

      tooltip: {
        backgroundColor: 'rgba(0,0,0,0.5)',
        axisPointer: {
          type: 'line',
          lineStyle: {
            color: '#408829',
            type: 'dashed'
          },
          crossStyle: {
            color: '#408829'
          },
          shadowStyle: {
            color: 'rgba(200,200,200,0.3)'
          }
        }
      },

      dataZoom: {
        dataBackgroundColor: '#eee',
        fillerColor: 'rgba(64,136,41,0.2)',
        handleColor: '#408829'
      },
      grid: {
        borderWidth: 0
      },

      categoryAxis: {
        axisLine: {
          lineStyle: {
            color: '#408829'
          }
        },
        splitLine: {
          lineStyle: {
            color: ['#eee']
          }
        }
      },

      valueAxis: {
        axisLine: {
          lineStyle: {
            color: '#408829'
          }
        },
        splitArea: {
          show: true,
          areaStyle: {
            color: ['rgba(250,250,250,0.1)', 'rgba(200,200,200,0.1)']
          }
        },
        splitLine: {
          lineStyle: {
            color: ['#eee']
          }
        }
      },
      timeline: {
        lineStyle: {
          color: '#408829'
        },
        controlStyle: {
          normal: {color: '#408829'},
          emphasis: {color: '#408829'}
        }
      },

      k: {
        itemStyle: {
          normal: {
            color: '#68a54a',
            color0: '#a9cba2',
            lineStyle: {
              width: 1,
              color: '#408829',
              color0: '#86b379'
            }
          }
        }
      },
      map: {
        itemStyle: {
          normal: {
            areaStyle: {
              color: '#ddd'
            },
            label: {
              textStyle: {
                color: '#c12e34'
              }
            }
          },
          emphasis: {
            areaStyle: {
              color: '#99d2dd'
            },
            label: {
              textStyle: {
                color: '#c12e34'
              }
            }
          }
        }
      },
      force: {
        itemStyle: {
          normal: {
            linkStyle: {
              strokeColor: '#408829'
            }
          }
        }
      },
      chord: {
        padding: 4,
        itemStyle: {
          normal: {
            lineStyle: {
              width: 1,
              color: 'rgba(128, 128, 128, 0.5)'
            },
            chordStyle: {
              lineStyle: {
                width: 1,
                color: 'rgba(128, 128, 128, 0.5)'
              }
            }
          },
          emphasis: {
            lineStyle: {
              width: 1,
              color: 'rgba(128, 128, 128, 0.5)'
            },
            chordStyle: {
              lineStyle: {
                width: 1,
                color: 'rgba(128, 128, 128, 0.5)'
              }
            }
          }
        }
      },
      gauge: {
        startAngle: 225,
        endAngle: -45,
        axisLine: {
          show: true,
          lineStyle: {
            color: [[0.2, '#86b379'], [0.8, '#68a54a'], [1, '#408829']],
            width: 8
          }
        },
        axisTick: {
          splitNumber: 10,
          length: 12,
          lineStyle: {
            color: 'auto'
          }
        },
        axisLabel: {
          textStyle: {
            color: 'auto'
          }
        },
        splitLine: {
          length: 18,
          lineStyle: {
            color: 'auto'
          }
        },
        pointer: {
          length: '90%',
          color: 'auto'
        },
        title: {
          textStyle: {
            color: '#333'
          }
        },
        detail: {
          textStyle: {
            color: 'auto'
          }
        }
      },
      textStyle: {
        fontFamily: 'Arial, Verdana, sans-serif'
      }
    };

    var echartBarLine = echarts.init(document.getElementById('mainb'), theme);

    echartBarLine.setOption({
      title: {
        x: 'center',
        y: 'top',
        padding: [0, 0, 20, 0],
        text: 'Persediaan Barang',
        textStyle: {
          fontSize: 15,
          fontWeight: 'normal'
        }
      },
      tooltip: {
        trigger: 'axis'
      },
      toolbox: {
        show: true,
        feature: {
          dataView: {
            show: true,
            readOnly: false,
            title: "Detail",
            lang: [
            "Detail",
            "Tutup",
            "Refresh",
            ],
          },
          restore: {
            show: true,
            title: 'Restore'
          },
          saveAsImage: {
            show: true,
            title: 'Simpan'
          }
        }
      },
      calculable: true,
      legend: {
        data: ['Index'],
        y: 'bottom'
      },
      xAxis: [{
        type: 'category',
        data: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des']
      }],
      yAxis: [{
        type: 'value',
        name: 'Qty',
        axisLabel: {
          formatter: '{value}'
        }
      }],
      series: [{
        name: 'Index',
        type: 'bar',
        data: [
        <?php foreach (grafik() as $key => $value): ?>
        <?php echo $value['stok']; ?>,
      <?php endforeach ?>
      ]
    }]
  });
</script>
<!-- /ECharts -->

<!-- CKEditor -->
<script src="<?php echo base_url("assets/ckeditor/ckeditor.js"); ?> "></script>

<!-- bootstrap datepicker -->
<script src="<?php echo base_url("assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"); ?>"></script>
<!-- Javascript menampilkan tanggal pada input text -->
<script>
  $(function () {

      //Date picker
      $('#datepicker').datepicker({
        format: "yyyy-mm-dd",
        autoclose: true
      })

    })
  </script>

  <script>
    $(function () {

      //Date picker
      $('#datepicker1').datepicker({
        format: "yyyy-mm-dd",
        autoclose: true
      })

    })
  </script>
  <!-- Javascript menampilkan tanggal pada input text -->

  <!-- Javascript untuk menampilkan jam berjalan -->
  <script type="text/javascript">
    window.onload = function() 
    { 
      jam(); 
    }

    function jam() 
    {
      var e = document.getElementById('jam'),
      d = new Date(), h, m, s;
      h = d.getHours();
      m = set(d.getMinutes());
      s = set(d.getSeconds());

      e.innerHTML = h +':'+ m +':'+ s;

      setTimeout('jam()', 1000);
    }

    function set(e) 
    {
      e = e < 10 ? '0'+ e : e;
      return e;
    }
  </script>
  <!-- Javascript untuk menampilkan jam berjalan -->

  <!-- Select2 untuk pencarian data menggunakan select option -->
  <script src="<?php echo base_url("assets/bower_components/select2/dist/js/select2.min.js"); ?> "></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('.js-example-basic-single').select2();
    });
  </script>
  <!-- Select2 untuk pencarian data menggunakan select option -->

</body>
</html>