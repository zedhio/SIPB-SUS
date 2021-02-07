

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

  <script type="text/javascript">
    window.onload = function()
    {

      // ---------------------------- Notif Stok Barang ----------------------------
    function cek(){
      $.ajax({
        url:'<?php echo base_url(); ?>index.php/user/home/hitung',
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
        url:'<?php echo base_url(); ?>index.php/user/home/barang_kurang',
        success: function(data)
        {
          $("#barang_b").html(data);
          // document.getElementById('ringtone_admin').play();
        }
      });
    }

    setInterval(function(){ cek(); barang_kurang(); }, 500);
      // ---------------------------- Notif Stok Barang ----------------------------

      // ---------------------------- Notif Validasi LPB Kepala Divisi Purchase Order ----------------------------
      $.ajax({
        url:"<?php echo base_url("user/validasi/lpb/hitung_val_lpb_kdpo"); ?>",
        success: function(data)
        // console.log(data);
        {
          if (data=="") 
          {
            $(".pesan_val_lpb_kdpo").addClass("hidden");
          }
          $("#notif_val_lpb_kdpo").html(data);
        }
      });

      $.ajax({
        url:"<?php echo base_url();?>index.php/user/validasi/lpb/notif_data_val_lpb_kdpo", 
        dataType: 'json',
        success: function(data)
        // console.log(data);
        {
          if (data!==null) 
          {
            $(".pesan-val-lpb-kdpo").attr("data-id",data.id_val_lpb);
            $("#id_val_lpb").val(data.id_val_lpb);
            $("#nomor_lpb").val(data.no_lpb);
            $("#yang_meminta").val(data.yang_meminta);
            $("#perihal").val(data.perihal);
            document.getElementById('ringtone_kdpo').play();
          }
          else
          {
            $(".pesan-val-lpb-kdpo").attr("");
            $("#id_val_lpb").val("");
            $("#nomor_lpb").val("");
            $("#yang_meminta").val("");
            $("#perihal").val("");
            
          }
        }
      });
      // ---------------------------- Notif Validasi LPB Kepala Divisi Purchase Order ----------------------------

      // ---------------------------- Notif Distribusi LPB Kepala Divisi Purchase Order ----------------------------
      $.ajax({
        url:"<?php echo base_url("user/laporan/lpb/hitung_dis_lpb_kdpo"); ?>",
        success: function(data)
        // console.log(data);
        {
          if (data=="") 
          {
            $(".pesan_dis_lpb_kdpo").addClass("hidden");
          }
          $("#notif_dis_lpb_kdpo").html(data);
        }
      });

      $.ajax({
        url:"<?php echo base_url();?>index.php/user/laporan/lpb/notif_data_dis_lpb_kdpo", 
        dataType: 'json',
        success: function(data)
        // console.log(data);
        {
          if (data!==null) 
          {
            $(".pesan-dis-lpb-kdpo").attr("data-id",data.id_distribusi_lpb);
            $("#id_distribusi_lpb").val(data.id_distribusi_lpb);
            $("#no_lpb").val(data.no_lpb);
            $("#no_purchase_order").val(data.no_purchase_order);
            $("#asal").val(data.asal);
            document.getElementById('ringtone_kdpo').play();
          }
          else
          {
            $(".pesan-dis-lpb-kdpo").attr("");
            $("#id_distribusi_lpb").val("");
            $("#no_lpb").val("");
            $("#no_purchase_order").val("");
            $("#asal").val("");
            
          }
        }
      });
      // ---------------------------- Notif Distribusi LPB Kepala Divisi Purchase Order ----------------------------

      // ---------------------------- Notif Distribusi LPB Kepala Divisi Hutang Dagang ----------------------------
      $.ajax({
        url:"<?php echo base_url("user/laporan/lpb/hitung_dis_lpb_kdhd"); ?>",
        success: function(data)
        // console.log(data);
        {
          if (data=="") 
          {
            $(".pesan_dis_lpb_kdhd").addClass("hidden");
          }
          $("#notif_dis_lpb_kdhd").html(data);
        }
      });

      $.ajax({
        url:"<?php echo base_url();?>index.php/user/laporan/lpb/notif_data_dis_lpb_kdhd", 
        dataType: 'json',
        success: function(data)
        // console.log(data);
        {
          if (data!==null) 
          {
            $(".pesan-dis-lpb-kdhd").attr("data-id",data.id_distribusi_lpb);
            $("#id_distribusi_lpb").val(data.id_distribusi_lpb);
            $("#nolpb").val(data.no_lpb);
            $("#nopurchaseorder").val(data.no_purchase_order);
            $("#asal1").val(data.asal);
            document.getElementById('ringtone_kdhd').play();
          }
          else
          {
            $(".pesan-dis-lpb-kdhd").attr("");
            $("#id_distribusi_lpb").val("");
            $("#nolpb").val("");
            $("#nopurchaseorder").val("");
            $("#asal1").val("");
            
          }
        }
      });
      // ---------------------------- Notif Distribusi LPB Kepala Divisi Hutang Dagang ----------------------------

      // ---------------------------- Notif Distribusi LPB Kepala Divisi Accounting ----------------------------
      $.ajax({
        url:"<?php echo base_url("user/laporan/lpb/hitung_dis_lpb_kda"); ?>",
        success: function(data)
        // console.log(data);
        {
          if (data=="") 
          {
            $(".pesan_dis_lpb_kda").addClass("hidden");
          }
          $("#notif_dis_lpb_kda").html(data);
        }
      });

      $.ajax({
        url:"<?php echo base_url();?>index.php/user/laporan/lpb/notif_data_dis_lpb_kda", 
        dataType: 'json',
        success: function(data)
        // console.log(data);
        {
          if (data!==null) 
          {
            $(".pesan-dis-lpb-kda").attr("data-id",data.id_distribusi_lpb);
            $("#id_distribusi_lpb").val(data.id_distribusi_lpb);
            $("#nolpb2").val(data.no_lpb);
            $("#nopurchaseorder2").val(data.no_purchase_order);
            $("#asal3").val(data.asal);
            document.getElementById('ringtone_kda').play();
          }
          else
          {
            $(".pesan-dis-lpb-kda").attr("");
            $("#id_distribusi_lpb").val("");
            $("#nolpb2").val("");
            $("#nopurchaseorder2").val("");
            $("#asal3").val("");
          }
        }
      });
      // ---------------------------- Notif Distribusi LPB Kepala Divisi Accounting ----------------------------

      // ---------------------------- Notif Distribusi LPB Direktur ----------------------------
      $.ajax({
        url:"<?php echo base_url("user/laporan/lpb/hitung_dis_lpb_direk"); ?>",
        success: function(data)
        // console.log(data);
        {
          if (data=="") 
          {
            $(".pesan_dis_lpb_direk").addClass("hidden");
          }
          $("#notif_dis_lpb_direk").html(data);
        }
      });

      $.ajax({
        url:"<?php echo base_url();?>index.php/user/laporan/lpb/notif_data_dis_lpb_direk", 
        dataType: 'json',
        success: function(data)
        // console.log(data);
        {
          if (data!==null) 
          {
            $(".pesan-dis-lpb-direk").attr("data-id",data.id_distribusi_lpb);
            $("#id_distribusi_lpb").val(data.id_distribusi_lpb);
            $("#nolpb1").val(data.no_lpb);
            $("#nopurchaseorder1").val(data.no_purchase_order);
            $("#asal2").val(data.asal);
            document.getElementById('ringtone_direk').play();
          }
          else
          {
            $(".pesan-dis-lpb-direk").attr("");
            $("#id_distribusi_lpb").val("");
            $("#nolpb1").val("");
            $("#nopurchaseorder1").val("");
            $("#asal2").val("");
            
          }
        }
      });
      // ---------------------------- Notif Distribusi LPB Direktur ----------------------------

      // ---------------------------- Notif Validasi Production Order Kepala Gudang ----------------------------
      $.ajax({
        url:"<?php echo base_url("user/validasi/production_order/hitung_val_po_kg"); ?>",
        success: function(data)
        {
          if (data=="") 
          {
            $(".pesan_val_po_kg").addClass("hidden");
          }
          $("#notif_val_po_kg").html(data);
        }
      });

      $.ajax({
        url:"<?php echo base_url();?>index.php/user/validasi/production_order/notif_data_val_po_kg", 
        dataType: 'json',
        success: function(data)
        {
          if (data!==null) 
          {
            $(".pesan-val-po-kg").attr("data-id",data.id_val_po);
            $("#id_val_po").val(data.id_val_po);
            $("#nama_po1").val(data.nama_po);
            $("#no_po1").val(data.no_po);
            $("#asal4").val(data.yang_meminta);
            $("#perihal1").val(data.perihal);
            document.getElementById('ringtone_kg').play();
          }
          else
          {
            $(".pesan-val-po-kg").attr("");
            $("#id_val_po").val("");
            $("#nomor_po1").val("");
            $("#asal4").val("");
            $("#perihal1").val("");
            
          }
        }
      });
      // ---------------------------- Notif Validasi Production Order Kepala Gudang ----------------------------

      // ---------------------------- Notif Validasi Production Order Kepala Divisi Production Manager ----------------------------
      $.ajax({
        url:"<?php echo base_url("user/validasi/production_order/hitung_val_po_kdpm"); ?>",
        success: function(data)
        {
          if (data=="") 
          {
            $(".pesan_val_po_kdpm").addClass("hidden");
          }
          $("#notif_val_po_kdpm").html(data);
        }
      });

      $.ajax({
        url:"<?php echo base_url();?>index.php/user/validasi/production_order/notif_data_val_po_kdpm", 
        dataType: 'json',
        success: function(data)
        {
          if (data!==null) 
          {
            $(".pesan-val-po-kdpm").attr("data-id",data.id_val_po);
            $("#id_val_po").val(data.id_val_po);
            $("#nama_po2").val(data.nama_po);
            $("#no_po2").val(data.no_po);
            $("#asal5").val(data.yang_meminta);
            $("#perihal2").val(data.perihal);
            document.getElementById('ringtone_kdpm').play();
          }
          else
          {
            $(".pesan-val-po-kdpm").attr("");
            $("#id_val_po").val("");
            $("#nomor_po2").val("");
            $("#asal5").val("");
            $("#perihal2").val("");
            
          }
        }
      });
      // ---------------------------- Notif Validasi Production Manager Kepala Divisi Production Manager ----------------------------

      // ---------------------------- Notif Validasi Production Order Kepala Divisi Production Manager ----------------------------
      $.ajax({
        url:"<?php echo base_url("user/validasi/production_order/hitung_val_po_direk"); ?>",
        success: function(data)
        {
          if (data=="") 
          {
            $(".pesan_val_po_direk").addClass("hidden");
          }
          $("#notif_val_po_direk").html(data);
        }
      });

      $.ajax({
        url:"<?php echo base_url();?>index.php/user/validasi/production_order/notif_data_val_po_direk", 
        dataType: 'json',
        success: function(data)
        {
          if (data!==null) 
          {
            $(".pesan-val-po-direk").attr("data-id",data.id_val_po);
            $("#id_val_po").val(data.id_val_po);
            $("#nama_po3").val(data.nama_po);
            $("#no_po3").val(data.no_po);
            $("#asal6").val(data.yang_meminta);
            $("#perihal3").val(data.perihal);
            document.getElementById('ringtone_direk').play();
          }
          else
          {
            $(".pesan-val-po-direk").attr("");
            $("#id_val_po").val("");
            $("#nomor_po3").val("");
            $("#asal6").val("");
            $("#perihal3").val("");
            
          }
        }
      });
      // ---------------------------- Notif Validasi Production Order Direktur ----------------------------

      // ------------------ Notif Hasil Validasi Production Order dari Kep.Gudang Untuk Staff ---------------
      $.ajax({
        url:"<?php echo base_url("user/production_order/production_order/hitung_hasil_val_po_kg"); ?>",
        success: function(data)
        {
          if (data=="") 
          {
            $(".pesan_hasil_val_po_kg").addClass("hidden");
          }
          $("#notif_hasil_val_po_kg").html(data);
        }
      });

      $.ajax({
        url:"<?php echo base_url();?>index.php/user/production_order/production_order/notif_hasil_data_val_po_kg", 
        dataType: 'json',
        success: function(data)
        {
          if (data!==null) 
          {
            $(".pesan-hasil-val-po-kg").attr("data-id",data.id_val_po);
            $("#id_val_po").val(data.id_val_po);
            $("#no_po4").val(data.no_po);
            $("#tujuan2").val(data.tujuan);
            $("#status1").val(data.status_pengajuan);
            $("#alasan1").val(data.alasan);
            document.getElementById('ringtone_hasil_staff').play();
          }
          else
          {
            $(".pesan-hasil-val-po-kg").attr("");
            $("#id_val_po").val("");
            $("#no_po4").val(data.no_po);
            $("#tujuan5").val(data.tujuan);
            $("#status1").val(data.status_pengajuan);
            $("#alasan1").val(data.alasan);
          }
        }
      });
      // ---------------- Notif Hasil Validasi Production Order dari Kep.Gudang Untuk Staff PPIC ----------------

      // ------------------ Notif Hasil Validasi Production Order dari Kep.Div.Prod.Man Untuk Staff ---------------
      $.ajax({
        url:"<?php echo base_url("user/production_order/production_order/hitung_hasil_val_po_kdpm"); ?>",
        success: function(data)
        {
          if (data=="") 
          {
            $(".pesan_hasil_val_po_kdpm").addClass("hidden");
          }
          $("#notif_hasil_val_po_kdpm").html(data);
        }
      });

      $.ajax({
        url:"<?php echo base_url();?>index.php/user/production_order/production_order/notif_hasil_data_val_po_kdpm", 
        dataType: 'json',
        success: function(data)
        {
          if (data!==null) 
          {
            $(".pesan-hasil-val-po-kdpm").attr("data-id",data.id_val_po);
            $("#id_val_po").val(data.id_val_po);
            $("#no_po5").val(data.no_po);
            $("#tujuan3").val(data.tujuan);
            $("#status2").val(data.status_pengajuan);
            $("#alasan2").val(data.alasan);
            document.getElementById('ringtone_hasil_staff').play();
          }
          else
          {
            $(".pesan-hasil-val-po-kdpm").attr("");
            $("#id_val_po").val("");
            $("#no_po5").val(data.no_po);
            $("#tujuan3").val(data.tujuan);
            $("#status2").val(data.status_pengajuan);
            $("#alasan2").val(data.alasan);
          }
        }
      });
      // ---------------- Notif Hasil Validasi Production Order dari Kep.Div.Prod.Man Untuk Staff PPIC ----------------

      // ------------------ Notif Hasil Validasi Production Order dari Direktur Untuk Staff ---------------
      $.ajax({
        url:"<?php echo base_url("user/production_order/production_order/hitung_hasil_val_po_direk"); ?>",
        success: function(data)
        {
          if (data=="") 
          {
            $(".pesan_hasil_val_po_direk").addClass("hidden");
          }
          $("#notif_hasil_val_po_direk").html(data);
        }
      });

      $.ajax({
        url:"<?php echo base_url();?>index.php/user/production_order/production_order/notif_hasil_data_val_po_direk", 
        dataType: 'json',
        success: function(data)
        {
          if (data!==null) 
          {
            $(".pesan-hasil-val-po-direk").attr("data-id",data.id_val_po);
            $("#id_val_po").val(data.id_val_po);
            $("#no_po6").val(data.no_po);
            $("#tujuan4").val(data.tujuan);
            $("#status3").val(data.status_pengajuan);
            $("#alasan3").val(data.alasan);
            document.getElementById('ringtone_hasil_staff').play();
          }
          else
          {
            $(".pesan-hasil-val-po-direk").attr("");
            $("#id_val_po").val("");
            $("#no_po6").val(data.no_po);
            $("#tujuan4").val(data.tujuan);
            $("#status3").val(data.status_pengajuan);
            $("#alasan3").val(data.alasan);
          }
        }
      });
      // ---------------- Notif Hasil Validasi Production Order dari Direktur Untuk Staff PPIC ----------------

      // ---------------------------- Notif Distribusi Lap PO Staff Unit Sewing ----------------------------
      $.ajax({
        url:"<?php echo base_url("user/laporan/production_order/hitung_dis_po_sus"); ?>",
        success: function(data)
        // console.log(data);
        {
          if (data=="") 
          {
            $(".pesan_dis_po_sus").addClass("hidden");
          }
          $("#notif_dis_po_sus").html(data);
        }
      });

      $.ajax({
        url:"<?php echo base_url();?>index.php/user/laporan/production_order/notif_data_dis_po_sus", 
        dataType: 'json',
        success: function(data)
        // console.log(data);
        {
          if (data!==null) 
          {
            $(".pesan-dis-po-sus").attr("data-id",data.id_distribusi_po);
            $("#id_distribusi_po").val(data.id_distribusi_po);
            $("#no_po20").val(data.no_po);
            $("#asal7").val(data.asal);
            document.getElementById('ringtone_sus').play();
          }
          else
          {
            $(".pesan-dis-po-sus").attr("");
            $("#id_distribusi_po").val("");
            $("#no_po20").val("");
            $("#asal7").val("");
            
          }
        }
      });
      // ---------------------------- Notif Distribusi Lap PO Staff Unit Sewing ----------------------------

      // ------------------ Notif Hasil Validasi BPB dari Admin Untuk Kepala Unit Sewing ---------------
      $.ajax({
        url:"<?php echo base_url("user/validasi/bpb/hitung_val_bpb_kus"); ?>",
        success: function(data)
        // console.log(data);
        {
          if (data=="") 
          {
            $(".pesan_val_bpb_kus").addClass("hidden");
          }
          $("#notif_val_bpb_kus").html(data);
        }
      });

      $.ajax({
        url:"<?php echo base_url();?>index.php/user/validasi/bpb/notif_data_val_bpb_kus", 
        dataType: 'json',
        success: function(data)
        // console.log(data);
        {
          if (data!==null) 
          {
            $(".pesan-val-bpb-kus").attr("data-id",data.id_val_bpb);
            $("#id_val_bpb").val(data.id_val_bpb);
            $("#nomor_bpb1").val(data.no_bpb);
            $("#yang_meminta10").val(data.yang_meminta);
            $("#perihal10").val(data.perihal);
            document.getElementById('ringtone_val_bpb_kus').play();
          }
          else
          {
            $(".pesan-val-bpb-kus").attr("");
            $("#id_val_bpb").val("");
            $("#nomor_bpb1").val("");
            $("#yang_meminta10").val("");
            $("#perihal10").val("");
            
          }
        }
      });      
      // ---------------- Notif Hasil Validasi BPB dari Admin Untuk Kepala Unit Sewing ----------------

      // ------------------ Notif Hasil Validasi BPB dari Admin Untuk Kepala Gudang ---------------
      $.ajax({
        url:"<?php echo base_url("user/validasi/bpb/hitung_val_bpb_kg"); ?>",
        success: function(data)
        // console.log(data);
        {
          if (data=="") 
          {
            $(".pesan_val_bpb_kg").addClass("hidden");
          }
          $("#notif_val_bpb_kg").html(data);
        }
      });

      $.ajax({
        url:"<?php echo base_url();?>index.php/user/validasi/bpb/notif_data_val_bpb_kg", 
        dataType: 'json',
        success: function(data)
        // console.log(data);
        {
          if (data!==null) 
          {
            $(".pesan-val-bpb-kg").attr("data-id",data.id_val_bpb);
            $("#id_val_bpb").val(data.id_val_bpb);
            $("#nomor_bpb2").val(data.no_bpb);
            $("#yang_meminta11").val(data.yang_meminta);
            $("#perihal11").val(data.perihal);
            document.getElementById('ringtone_kg').play();
          }
          else
          {
            $(".pesan-val-bpb-kg").attr("");
            $("#id_val_bpb").val("");
            $("#nomor_bpb2").val("");
            $("#yang_meminta11").val("");
            $("#perihal11").val("");
            
          }
        }
      });      
      // ---------------- Notif Hasil Validasi BPB dari Admin Untuk Kepala Gudang ----------------

      // ------------------ Notif Hasil Validasi BPB dari Admin Untuk Kepala Divisi Production Manager ---------------
      $.ajax({
        url:"<?php echo base_url("user/validasi/bpb/hitung_val_bpb_kdpm"); ?>",
        success: function(data)
        // console.log(data);
        {
          if (data=="") 
          {
            $(".pesan_val_bpb_kdpm").addClass("hidden");
          }
          $("#notif_val_bpb_kdpm").html(data);
        }
      });

      $.ajax({
        url:"<?php echo base_url();?>index.php/user/validasi/bpb/notif_data_val_bpb_kdpm", 
        dataType: 'json',
        success: function(data)
        // console.log(data);
        {
          if (data!==null) 
          {
            $(".pesan-val-bpb-kdpm").attr("data-id",data.id_val_bpb);
            $("#id_val_bpb").val(data.id_val_bpb);
            $("#nomor_bpb3").val(data.no_bpb);
            $("#yang_meminta12").val(data.yang_meminta);
            $("#perihal12").val(data.perihal);
            document.getElementById('ringtone_kdpm').play();
          }
          else
          {
            $(".pesan-val-bpb-kdpm").attr("");
            $("#id_val_bpb").val("");
            $("#nomor_bpb3").val("");
            $("#yang_meminta12").val("");
            $("#perihal12").val("");
            
          }
        }
      });      
      // ---------------- Notif Hasil Validasi BPB dari Admin Untuk Kepala Divisi Production Manager ----------------

      // ------------------ Notif Hasil Validasi SJK dari Admin Untuk Direktur ---------------
      $.ajax({
        url:"<?php echo base_url("user/validasi/surat_jalan_keluar/hitung_val_sjk_direk"); ?>",
        success: function(data)
        // console.log(data);
        {
          if (data=="") 
          {
            $(".pesan_val_sjk_direk").addClass("hidden");
          }
          $("#notif_val_sjk_direk").html(data);
        }
      });

      $.ajax({
        url:"<?php echo base_url();?>index.php/user/validasi/surat_jalan_keluar/notif_data_val_sjk_direk", 
        dataType: 'json',
        success: function(data)
        // console.log(data);
        {
          if (data!==null) 
          {
            $(".pesan-val-sjk-direk").attr("data-id",data.id_val_sjk);
            $("#id_val_sjk").val(data.id_val_sjk);
            $("#nomor_sjk").val(data.no_sjk);
            $("#yang_meminta30").val(data.yang_meminta);
            $("#perihal30").val(data.perihal);
            document.getElementById('ringtone_direk').play();
          }
          else
          {
            $(".pesan-val-sjk-direk").attr("");
            $("#id_val_sjk").val("");
            $("#nomor_sjk").val("");
            $("#yang_meminta30").val("");
            $("#perihal30").val("");
          }
        }
      });      
      // ---------------- Notif Hasil Validasi SJK dari Admin Untuk Direktur ----------------

      // ---------------------------- Notif Distribusi Lap SJK Ke Direktur ----------------------------
      $.ajax({
        url:"<?php echo base_url("user/laporan/surat_jalan_keluar/hitung_dis_sjk_direk"); ?>",
        success: function(data)
        // console.log(data);
        {
          if (data=="") 
          {
            $(".pesan_dis_sjk_direk").addClass("hidden");
          }
          $("#notif_dis_sjk_direk").html(data);
        }
      });

      $.ajax({
        url:"<?php echo base_url();?>index.php/user/laporan/surat_jalan_keluar/notif_data_dis_sjk_direk", 
        dataType: 'json',
        success: function(data)
        // console.log(data);
        {
          if (data!==null) 
          {
            $(".pesan-dis-sjk-direk").attr("data-id",data.id_distribusi_sjk);
            $("#id_distribusi_sjk").val(data.id_distribusi_sjk);
            $("#no_sjk1").val(data.no_sjk);
            $("#asal100").val(data.asal);
            $("#keterangan1").val(data.tindakan);
            document.getElementById('ringtone_direk').play();
          }
          else
          {
            $(".pesan-dis-sjk-direk").attr("");
            $("#id_distribusi_sjk").val("");
            $("#no_sjk1").val("");
            $("#asal100").val("");
            $("#keterangan1").val("");
          }
        }
      });
      // ---------------------------- Notif Distribusi Lap SJK Ke Direktur ----------------------------

      // ---------------------------- Notif Distribusi Lap SJK Ke Kepala Divisi Accounting ----------------------------
      $.ajax({
        url:"<?php echo base_url("user/laporan/surat_jalan_keluar/hitung_dis_sjk_kda"); ?>",
        success: function(data)
        // console.log(data);
        {
          if (data=="") 
          {
            $(".pesan_dis_sjk_kda").addClass("hidden");
          }
          $("#notif_dis_sjk_kda").html(data);
        }
      });

      $.ajax({
        url:"<?php echo base_url();?>index.php/user/laporan/surat_jalan_keluar/notif_data_dis_sjk_kda", 
        dataType: 'json',
        success: function(data)
        // console.log(data);
        {
          if (data!==null) 
          {
            $(".pesan-dis-sjk-kda").attr("data-id",data.id_distribusi_sjk);
            $("#id_distribusi_sjk").val(data.id_distribusi_sjk);
            $("#no_sjk2").val(data.no_sjk);
            $("#asal101").val(data.asal);
            $("#keterangan2").val(data.tindakan);
            document.getElementById('ringtone_kda').play();
          }
          else
          {
            $(".pesan-dis-sjk-kda").attr("");
            $("#id_distribusi_sjk").val("");
            $("#no_sjk2").val("");
            $("#asal101").val("");
            $("#keterangan2").val("");
          }
        }
      });
      // ---------------------------- Notif Distribusi Lap SJK Ke Kepala Divisi Accounting ----------------------------

      // ---------------------------- Notif Distribusi Lap SJK Ke Kepala Divisi EXIM ----------------------------
      $.ajax({
        url:"<?php echo base_url("user/laporan/surat_jalan_keluar/hitung_dis_sjk_exim"); ?>",
        success: function(data)
        // console.log(data);
        {
          if (data=="") 
          {
            $(".pesan_dis_sjk_exim").addClass("hidden");
          }
          $("#notif_dis_sjk_exim").html(data);
        }
      });

      $.ajax({
        url:"<?php echo base_url();?>index.php/user/laporan/surat_jalan_keluar/notif_data_dis_sjk_exim", 
        dataType: 'json',
        success: function(data)
        {
          if (data!==null) 
          {
            $(".pesan-dis-sjk-exim").attr("data-id",data.id_distribusi_sjk);
            $("#id_distribusi_sjk").val(data.id_distribusi_sjk);
            $("#no_sjk5").val(data.no_sjk);
            $("#asal102").val(data.asal);
            $("#keterangan3").val(data.tindakan);
            document.getElementById('ringtone_exim').play();
          }
          else
          {
            $(".pesan-dis-sjk-exim").attr("");
            $("#id_distribusi_sjk").val("");
            $("#no_sjk3").val("");
            $("#asal102").val("");
            $("#keterangan3").val("");
          }
        }
      });
      // ---------------------------- Notif Distribusi Lap SJK Ke Kepala Divisi EXIM ----------------------------

      // ---------------------------- Notif Distribusi BPB Kepala Divisi Purchase Order ----------------------------
      $.ajax({
        url:"<?php echo base_url("user/laporan/bpb/hitung_dis_bpb_kdpo"); ?>",
        success: function(data)
        // console.log(data);
        {
          if (data=="") 
          {
            $(".pesan_dis_bpb_kdpo").addClass("hidden");
          }
          $("#notif_dis_bpb_kdpo").html(data);
        }
      });

      $.ajax({
        url:"<?php echo base_url();?>index.php/user/laporan/bpb/notif_data_dis_bpb_kdpo", 
        dataType: 'json',
        success: function(data)
        // console.log(data);
        {
          if (data!==null) 
          {
            $(".pesan-dis-bpb-kdpo").attr("data-id",data.id_distribusi_bpb);
            $("#id_distribusi_bpb").val(data.id_distribusi_bpb);
            $("#no_bpb").val(data.no_bpb);
            $("#no_production_order").val(data.no_po);
            $("#asal100").val(data.asal);
            document.getElementById('ringtone_kdpo').play();
          }
          else
          {
            $(".pesan-dis-bpb-kdpo").attr("");
            $("#id_distribusi_bpb").val("");
            $("#no_bpb").val("");
            $("#no_production_order").val("");
            $("#asal100").val("");
            
          }
        }
      });
      // ---------------------------- Notif Distribusi BPB Kepala Divisi Purchase Order ----------------------------

      // ---------------------------- Notif Distribusi BPB Kepala Divisi Accounting ----------------------------
      $.ajax({
        url:"<?php echo base_url("user/laporan/bpb/hitung_dis_bpb_kda"); ?>",
        success: function(data)
        // console.log(data);
        {
          if (data=="") 
          {
            $(".pesan_dis_bpb_kda").addClass("hidden");
          }
          $("#notif_dis_bpb_kda").html(data);
        }
      });

      $.ajax({
        url:"<?php echo base_url();?>index.php/user/laporan/bpb/notif_data_dis_bpb_kda", 
        dataType: 'json',
        success: function(data)
        // console.log(data);
        {
          if (data!==null) 
          {
            $(".pesan-dis-bpb-kda").attr("data-id",data.id_distribusi_bpb);
            $("#id_distribusi_bpb").val(data.id_distribusi_bpb);
            $("#no_bpb101").val(data.no_bpb);
            $("#no_production_order101").val(data.no_po);
            $("#asal101").val(data.asal);
            document.getElementById('ringtone_kda').play();
          }
          else
          {
            $(".pesan-dis-bpb-kda").attr("");
            $("#id_distribusi_bpb").val("");
            $("#no_bpb101").val("");
            $("#no_production_order101").val("");
            $("#asal101").val("");
            
          }
        }
      });
      // ---------------------------- Notif Distribusi BPB Kepala Divisi Accounting ----------------------------

      // ---------------------------- Notif Distribusi BPB Direktur ----------------------------
      $.ajax({
        url:"<?php echo base_url("user/laporan/bpb/hitung_dis_bpb_direk"); ?>",
        success: function(data)
        // console.log(data);
        {
          if (data=="") 
          {
            $(".pesan_dis_bpb_direk").addClass("hidden");
          }
          $("#notif_dis_bpb_direk").html(data);
        }
      });

      $.ajax({
        url:"<?php echo base_url();?>index.php/user/laporan/bpb/notif_data_dis_bpb_direk", 
        dataType: 'json',
        success: function(data)
        // console.log(data);
        {
          if (data!==null) 
          {
            $(".pesan-dis-bpb-direk").attr("data-id",data.id_distribusi_bpb);
            $("#id_distribusi_bpb").val(data.id_distribusi_bpb);
            $("#no_bpb102").val(data.no_bpb);
            $("#no_production_order102").val(data.no_po);
            $("#asal102").val(data.asal);
            document.getElementById('ringtone_direk').play();
          }
          else
          {
            $(".pesan-dis-bpb-direk").attr("");
            $("#id_distribusi_direk").val("");
            $("#no_bpb102").val("");
            $("#no_production_order102").val("");
            $("#asal102").val("");
          }
        }
      });
      // ---------------------------- Notif Distribusi BPB Direktur ----------------------------

    }
  </script>

  <!-- Javascript untuk menampilkan Modal Distribusi Laporan PO yang sudah approve ke Administrasi Gudang dan Staff Unit Sewing -->  
  <script type="text/javascript">
    $(document).ready(function() {
      $(".distribusi-po").on('click',function(){
        var kirim = $(this).data("id");
        $("#kirim_laporan_po").modal('show');
        $("input[name=id_po]").val(kirim);
        $("#kirim").hide();
      })
    });
  </script>
  <!-- Javascript untuk menampilkan Modal Distribusi Laporan PO yang sudah approve ke Administrasi Gudang dan Staff Unit Sewing -->

  <script type="text/javascript">

    // ---------------------------- Notif Distribusi Lap BPB Kepala Divisi Purchase Order ----------------------------
    $('.pesan-dis-bpb-kdpo').on('click', function()
    {
      var id = $(this).data("id");
      $.ajax({
        url: '<?php echo base_url();?>index.php/user/laporan/bpb/pesan_data_dis_bpb_kdpo',
        method: "POST",
        data: "id_distribusi_bpb="+id,
        success: function(){
          location='<?php echo base_url("user/laporan/bpb"); ?>';
        }
      })
    })
    // ---------------------------- Notif Distribusi Lap BPB Kepala Divisi Purchase Order ----------------------------

    // ---------------------------- Notif Distribusi Lap BPB Kepala Divisi Accounting ----------------------------
    $('.pesan-dis-bpb-kda').on('click', function()
    {
      var id = $(this).data("id");
      $.ajax({
        url: '<?php echo base_url();?>index.php/user/laporan/bpb/pesan_data_dis_bpb_kda',
        method: "POST",
        data: "id_distribusi_bpb="+id,
        success: function(){
          location='<?php echo base_url("user/laporan/bpb"); ?>';
        }
      })
    })
    // ---------------------------- Notif Distribusi Lap BPB Kepala Divisi Accounting ----------------------------

    // ---------------------------- Notif Distribusi Lap BPB Direktur ----------------------------
    $('.pesan-dis-bpb-direk').on('click', function()
    {
      var id = $(this).data("id");
      $.ajax({
        url: '<?php echo base_url();?>index.php/user/laporan/bpb/pesan_data_dis_bpb_direk',
        method: "POST",
        data: "id_distribusi_bpb="+id,
        success: function(){
          location='<?php echo base_url("user/laporan/bpb"); ?>';
        }
      })
    })
    // ---------------------------- Notif Distribusi Lap BPB Direktur ----------------------------

    // ---------------------------- Notif Validasi LPB Kepala Divisi Purchase Order ----------------------------
    $('.pesan-val-lpb-kdpo').on('click', function()
    {
      var id = $(this).data("id");
      $.ajax({
        url:'<?php echo base_url();?>index.php/user/validasi/lpb/pesan_data_val_lpb_kdpo',
        method:"POST",
        data:"id_val_lpb="+id,
        success: function(){
          location='<?php echo base_url("user/validasi/lpb"); ?>';
        }
      })
    })
    // ---------------------------- Notif Validasi LPB Kepala Divisi Purchase Order ----------------------------

    // ---------------------------- Notif Distribusi Lap Production Order Staff Unit Sewing ----------------------------
    $('.pesan-dis-po-sus').on('click', function()
    {
      var id = $(this).data("id");
      $.ajax({
        url: '<?php echo base_url();?>index.php/user/laporan/production_order/pesan_data_dis_po_sus',
        method: "POST",
        data: "id_distribusi_po="+id,
        success: function(){
          location='<?php echo base_url("user/laporan/production_order"); ?>';
        }
      })
    })
    // ---------------------------- Notif Distribusi Lap Production Order Staff Unit Sewing ----------------------------

    // ---------------------------- Notif Distribusi LPB Kepala Divisi Hutang Dagang ----------------------------
    $('.pesan-dis-lpb-kdhd').on('click', function()
    {
      var id = $(this).data("id");
      $.ajax({
        url: '<?php echo base_url();?>index.php/user/laporan/lpb/pesan_data_dis_lpb_kdhd',
        method: "POST",
        data: "id_distribusi_lpb="+id,
        success: function(){
          location='<?php echo base_url("user/laporan/lpb"); ?>';
        }
      })
    })
    // ---------------------------- Notif Distribusi LPB Kepala Divisi Hutang Dagang ----------------------------

    // ---------------------------- Notif Distribusi LPB Kepala Divisi Accounting ----------------------------
    $('.pesan-dis-lpb-kda').on('click', function()
    {
      var id = $(this).data("id");
      $.ajax({
        url: '<?php echo base_url();?>index.php/user/laporan/lpb/pesan_data_dis_lpb_kda',
        method: "POST",
        data: "id_distribusi_lpb="+id,
        success: function(){
          location='<?php echo base_url("user/laporan/lpb"); ?>';
        }
      })
    })
    // ---------------------------- Notif Distribusi LPB Kepala Divisi Accounting ----------------------------

    // ---------------------------- Notif Distribusi LPB Direktur ----------------------------
    $('.pesan-dis-lpb-direk').on('click', function()
    {
      var id = $(this).data("id");
      $.ajax({
        url: '<?php echo base_url();?>index.php/user/laporan/lpb/pesan_data_dis_lpb_direk',
        method: "POST",
        data: "id_distribusi_lpb="+id,
        success: function(){
          location='<?php echo base_url("user/laporan/lpb"); ?>';
        }
      })
    })
    // ---------------------------- Notif Distribusi LPB Direktur ----------------------------

    // ---------------------------- Notif Validasi Production Order Kepala Gudang ----------------------------
    $('.pesan-val-po-kg').on('click', function()
    {
      var id = $(this).data("id");
      $.ajax({
        url:'<?php echo base_url();?>index.php/user/validasi/production_order/pesan_data_val_po_kg',
        method:"POST",
        data:"id_val_po="+id,
        success: function(){
          location='<?php echo base_url("user/validasi/production_order"); ?>';
        }
      })
    })
    // ---------------------------- Notif Validasi Production Order Kepala Gudang ----------------------------

    // ---------------------------- Notif Validasi Production Order Kepala Divisi Production Manager ----------------------------
    $('.pesan-val-po-kdpm').on('click', function()
    {
      var id = $(this).data("id");
      $.ajax({
        url:'<?php echo base_url();?>index.php/user/validasi/production_order/pesan_data_val_po_kdpm',
        method:"POST",
        data:"id_val_po="+id,
        success: function(){
          location='<?php echo base_url("user/validasi/production_order"); ?>';
        }
      })
    })
    // ---------------------------- Notif Validasi Production Order Kepala Divisi Production Manager ----------------------------

    // ---------------------------- Notif Validasi Production Order Direktur ----------------------------
    $('.pesan-val-po-direk').on('click', function()
    {
      var id = $(this).data("id");
      $.ajax({
        url:'<?php echo base_url();?>index.php/user/validasi/production_order/pesan_data_val_po_direk',
        method:"POST",
        data:"id_val_po="+id,
        success: function(){
          location='<?php echo base_url("user/validasi/production_order"); ?>';
        }
      })
    })
    // ---------------------------- Notif Validasi Production Order Direktur ----------------------------

    // ---------------------------- Notif Hasil Validasi PO Dari Kepala Gudang ke Staff ----------------------------
    $('.pesan-hasil-val-po-kg').on('click', function()
    {
      var id = $(this).data("id");
      $.ajax({
        url:'<?php echo base_url();?>index.php/user/production_order/production_order/pesan_data_hasil_val_po_kg',
        method:"POST",
        data:"id_val_po="+id,
        success: function(){
          location='<?php echo base_url("user/production_order/production_order"); ?>';
        }
      })
    })
    // ---------------------------- Notif Hasil Validasi PO Dari Kepala Gudang ke Staff ----------------------------

    // ---------------------------- Notif Hasil Validasi PO Dari Kepala Divisi Production Manager ----------------------------
    $('.pesan-hasil-val-po-kdpm').on('click', function()
    {
      var id = $(this).data("id");
      $.ajax({
        url:'<?php echo base_url();?>index.php/user/production_order/production_order/pesan_data_hasil_val_po_kdpm',
        method:"POST",
        data:"id_val_po="+id,
        success: function(){
          location='<?php echo base_url("user/production_order/production_order"); ?>';
        }
      })
    })
    // ---------------------------- Notif Hasil Validasi PO Dari Kepala Divisi Production Manager ----------------------------

    // ---------------------------- Notif Hasil Validasi PO Dari Direktur ----------------------------
    $('.pesan-hasil-val-po-direk').on('click', function()
    {
      var id = $(this).data("id");
      $.ajax({
        url:'<?php echo base_url();?>index.php/user/production_order/production_order/pesan_data_hasil_val_po_direk',
        method:"POST",
        data:"id_val_po="+id,
        success: function(){
          location='<?php echo base_url("user/production_order/production_order"); ?>';
        }
      })
    })
    // ---------------------------- Notif Hasil Validasi PO Dari Direktur ----------------------------

    // ---------------------------- Notif Validasi BPB Kepala Unit Sewing ----------------------------
    $('.pesan-val-bpb-kus').on('click', function()
    {
      var id = $(this).data("id");
      $.ajax({
        url:'<?php echo base_url();?>index.php/user/validasi/bpb/pesan_data_val_bpb_kus',
        method:"POST",
        data:"id_val_bpb="+id,
        success: function(){
          location='<?php echo base_url("user/validasi/bpb"); ?>';
        }
      })
    })
    // ---------------------------- Notif Validasi BPB Kepala Unit Sewing ----------------------------

    // ---------------------------- Notif Validasi BPB Kepala Gudang ----------------------------
    $('.pesan-val-bpb-kg').on('click', function()
    {
      var id = $(this).data("id");
      $.ajax({
        url:'<?php echo base_url();?>index.php/user/validasi/bpb/pesan_data_val_bpb_kg',
        method:"POST",
        data:"id_val_bpb="+id,
        success: function(){
          location='<?php echo base_url("user/validasi/bpb"); ?>';
        }
      })
    })
    // ---------------------------- Notif Validasi BPB Kepala Gudang ----------------------------

    // ---------------------------- Notif Validasi BPB Kepala Divisi Production Manager ----------------------------
    $('.pesan-val-bpb-kdpm').on('click', function()
    {
      var id = $(this).data("id");
      $.ajax({
        url:'<?php echo base_url();?>index.php/user/validasi/bpb/pesan_data_val_bpb_kdpm',
        method:"POST",
        data:"id_val_bpb="+id,
        success: function(){
          location='<?php echo base_url("user/validasi/bpb"); ?>';
        }
      })
    })
    // ---------------------------- Notif Validasi BPB Kepala Divisi Production Manager ----------------------------

    // ---------------------------- Notif Validasi SJK Direktur ----------------------------
    $('.pesan-val-sjk-direk').on('click', function()
    {
      var id = $(this).data("id");
      $.ajax({
        url:'<?php echo base_url();?>index.php/user/validasi/surat_jalan_keluar/pesan_data_val_sjk_direk',
        method:"POST",
        data:"id_val_sjk="+id,
        success: function(){
          location='<?php echo base_url("user/validasi/surat_jalan_keluar"); ?>';
        }
      })
    })
    // ---------------------------- Notif Validasi SJK Direktur ----------------------------

    // ---------------------------- Notif Distribusi Lap SJK Direktur ----------------------------
    $('.pesan-dis-sjk-direk').on('click', function()
    {
      var id = $(this).data("id");
      $.ajax({
        url: '<?php echo base_url();?>index.php/user/laporan/surat_jalan_keluar/pesan_data_dis_sjk_direk',
        method: "POST",
        data: "id_distribusi_sjk="+id,
        success: function(){
          location='<?php echo base_url("user/laporan/surat_jalan_keluar"); ?>';
        }
      })
    })
    // ---------------------------- Notif Distribusi Lap SJK Direk ----------------------------

    // ---------------------------- Notif Distribusi Lap SJK Kepala Divisi Accounting ----------------------------
    $('.pesan-dis-sjk-kda').on('click', function()
    {
      var id = $(this).data("id");
      $.ajax({
        url: '<?php echo base_url();?>index.php/user/laporan/surat_jalan_keluar/pesan_data_dis_sjk_kda',
        method: "POST",
        data: "id_distribusi_sjk="+id,
        success: function(){
          location='<?php echo base_url("user/laporan/surat_jalan_keluar"); ?>';
        }
      })
    })
    // ---------------------------- Notif Distribusi Lap SJK Kepala Divisi Accounting ----------------------------

    // ---------------------------- Notif Distribusi Lap SJK Kepala Divisi EXIM ----------------------------
    $('.pesan-dis-sjk-exim').on('click', function()
    {
      var id = $(this).data("id");
      $.ajax({
        url: '<?php echo base_url();?>index.php/user/laporan/surat_jalan_keluar/pesan_data_dis_sjk_exim',
        method: "POST",
        data: "id_distribusi_sjk="+id,
        success: function(){
          location='<?php echo base_url("user/laporan/surat_jalan_keluar"); ?>';
        }
      })
    })
    // ---------------------------- Notif Distribusi Lap SJK Kepala Divisi EXIM ----------------------------

  </script>

  <!-- untuk konfirmasi persetujuan berdasrakan id_sjk menggunakan modal -->
  <script type="text/javascript">
    $(document).ready(function() {
      $(".konfirm-persetujuan-sjk").on('click',function(){
        var konfirmasi_persetujuan = $(this).data("id");
        $("#konfirmasi_persetujuan_sjk").modal('show');
        $("input[name=id_sjk]").val(konfirmasi_persetujuan);
      })
    });
  </script>

<!-- menampilkan Modal Status Pengajuan approval production order dari K.Gudang dan K.Divisi Production Manager, direktur  -->
  <script type="text/javascript">
    $(document).ready(function() {
      $(".stat-pengajuan").on('click',function(){
        var persetujuan = $(this).data("id");
        $("#status_pengajuan").modal('show');
        // console.log(persetujuan);
        $.ajax({
          url:'<?php echo base_url();?>index.php/user/production_order/production_order/status_pengajuan',
          method:'POST',
          dataType:'json',
          data:{id_po:persetujuan},
          success:function(data)
          {
            console.log(data);
            if(data!==null)
            {
              var pengajuan = "";
              for(var i=0;i<data.length;i++)
              {
                   pengajuan += "<input type='text' name='id_po' class='hidden' value='"+data[i].id_po+"'>"+"<input type='text' class='hidden' name='id_val_po' value='"+data[i].id_val_po+"'><div class='form-group'><label>Dari</label><span style='padding-left: 24px;'>: </span><span>"+data[i].tujuan+"</span></div><div class='form-group'><label>Status</label><span style='padding-left: 12px;'>: </span><span>"+data[i].status_pengajuan+"</span></div><div class='form-group'><label>Alasan</label><span style='padding-left: 12px;'>: </span><span>"+data[i].alasan+"</span></div><br>";           
              }
              console.log(pengajuan);

              $("#detail_pengajuan_approval").html(pengajuan);

            }
            else
            {
              for(var i=1;i<=data.length;i++)
              {
                $("input[name=id_po]").val("");
                $("input[name=id_val_po]").val("");
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

  <!-- Javascript untuk menampilkan Modal Status alasan approval bon dari K.Gudang dan K.Divisi Production Order -->
  <script type="text/javascript">
    $(document).ready(function() {
      $(".stat-alasan").on('click',function(){
        var persetujuan = $(this).data("id");
        $("#status_alasan").modal('show');
        // console.log(persetujuan);
        $.ajax({
          url:'<?php echo base_url();?>index.php/user/bon/bon/status_alasan',
          method:'POST',
          dataType:'json',
          data:{id_bon:persetujuan},
          success:function(data)
          {
            console.log(data);
            if(data!==null)
            {
              var kadal = "";
              for(var i=0;i<data.length;i++)
              {
                   kadal += "<input type='text' name='id_bon' class='hidden' value='"+data[i].id_bon+"'>"+"<input type='text' class='hidden' name='id_val_bon' value='"+data[i].id_val_bon+"'><div class='form-group'><label>Dari</label><span style='padding-left: 24px;'>: </span><span>"+data[i].tujuan+"</span></div><div class='form-group'><label>Status</label><span style='padding-left: 12px;'>: </span><span>"+data[i].status_pengajuan+"</span></div><div class='form-group'><label>Alasan</label><span style='padding-left: 12px;'>: </span><span>"+data[i].alasan+"</span></div><br>";           
              }
              console.log(kadal);

              $("#detail_pengajuan").html(kadal);

            }
            else
            {
              for(var i=1;i<=data.length;i++)
              {
                $("input[name=id_bon]").val("");
                $("input[name=id_val_bon]").val("");
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

  <!-- untuk konfirmasi persetujuan berdasrakan id_val_po menggunakan modal -->
  <script type="text/javascript">
    $(document).ready(function() {
      $(".konfirm-persetujuan-po").on('click',function(){
        var konfirmasi_persetujuan = $(this).data("id");
        $("#konfirmasi_persetujuan_po").modal('show');
        $("input[name=id_val_po]").val(konfirmasi_persetujuan);
        $("input[name=id_po]").val(konfirmasi_persetujuan);
      })
    });
  </script>

  <!-- untuk konfirmasi persetujuan berdasrakan id_bon menggunakan modal -->
  <script type="text/javascript">
    $(document).ready(function() {
      $(".konfirm-persetujuan-bon").on('click',function(){
        var konfirmasi_persetujuan = $(this).data("id");
        $("#konfirmasi_persetujuan_bon").modal('show');
        $("input[name=id_val_bon]").val(konfirmasi_persetujuan);
        $("input[name=id_bon]").val(konfirmasi_persetujuan);
      })
    });
  </script>

  <!-- untuk konfirmasi persetujuan berdasrakan id_bpb menggunakan modal -->
  <script type="text/javascript">
    $(document).ready(function() {
      $(".konfirm-persetujuan-bpb").on('click',function(){
        var konfirmasi_persetujuan = $(this).data("id");
        var id = $(this).data("bpb");
        $("#konfirmasi_persetujuan_bpb").modal('show');
        $("input[name=id_val_bpb]").val(konfirmasi_persetujuan);
        $("input[name=id_bpb]").val(id);
      })
    });
  </script>

  <!-- Javascript agar tidak reload untuk tampilan tambah dan ubah selanjutnya pada data production order --> 
  <script type="text/javascript">
    $(document).ready(function(){
      $('#barang').change(function(){
        var id=$(this).val();
        $.ajax({
          url : "<?php echo base_url();?>index.php/user/production_order/production_order/select",
          method : "POST",
          dataType:'json',
          data : {nama_barang: id},
          success: function(data){
            $('.warna').val(data.warna);
            $('.satuan').val(data.satuan);
          }
        });
      });
    });
  </script>

  <!-- Javascript agar tidak reload untuk tampilan tambah dan ubah selanjutnya pada ubah data surat jalan masuk --> 
  <script type="text/javascript">
    $(document).ready(function(){
      $('#barang').change(function(){
        var id=$(this).val();
        $.ajax({
          url : "<?php echo base_url();?>index.php/user/surat_jalan_masuk/surat_jalan_masuk/select",
          method : "POST",
          dataType:'json',
          data : {nama_barang: id},
          success: function(data){
            $('.jenis').val(data.jenis);
            $('.subjenis').val(data.sub_jenis);
            $('.warna').val(data.warna);
            $('.satuan').val(data.satuan);
          }
        });
      });
    });
  </script>
  <!-- Javascript agar tidak reload untuk tampilan ubah selanjutnya pada ubah data surat jalan masuk -->

  <!-- Javascript agar menampilkan data per id untuk tampilan ubah selanjutnya pada ubah data bon -->  
  <script>
    $(document).ready(function(){
      $("#bon").on('click',function(){
        var id = $(this).data("id");
        $.ajax({
          url:"<?php echo base_url(); ?>index.php/user/bon/bon/radio",
          method:"POST",
          data:{id_kalkulasi_bon:id},
          dataType:'json',
          success:function(data)
          {
            console.log(data);
            var select = document.getElementById('barang');
            console.log(select.value);
            $(select).removeAttr('disabled');
            $(select).val(data.nama_barang);
            $("#jenis").val(data.jenis);
            $("#sub_jenis").val(data.sub_jenis);
            $("#warna").val(data.warna);
            $("#qty_bon").removeAttr('readonly');
            $("#qty_bon").val(data.qty_bon);
            $("#satuan").val(data.satuan);
            $("#remaks").removeAttr('readonly');
            $("#remaks").val(data.remaks);
            $("#id_kalkulasi").val(data.id_kalkulasi_bon);
            $("#ubah").removeAttr('disabled');
          }
        })
      })
    })
  </script>
  <!-- Javascript agar menampilkan data per id untuk tampilan ubah selanjutnya pada ubah data bon -->

  <!-- Javascript untuk menampilkan Modal Pengajuan approval BON ke K.Gudang & Administrator -->
  <script type="text/javascript">
    $(document).ready(function() {
      $(".validasi-bon").on('click',function(){
        var pengajuan = $(this).data("id");
        $("#ajukan_persetujuan_bon").modal('show');
        $("input[name=id_bon]").val(pengajuan);
      })
    });
  </script>

  <!-- Javascript agar menampilkan data per id untuk tampilan ubah selanjutnya pada ubah data surat jalan masuk -->  
  <script>
    $(document).ready(function(){
      $("#sjm").on('click',function(){
        var id = $(this).data("id");
        $.ajax({
          url:"<?php echo base_url(); ?>index.php/user/surat_jalan_masuk/surat_jalan_masuk/radio",
          method:"POST",
          data:{id_kalkulasi_sjm:id},
          dataType:'json',
          success:function(data)
          {
            console.log(data);
            var select = document.getElementById('barang');
            console.log(select.value);
            $(select).val(data.nama_barang);
            $("#jenis").val(data.jenis);
            $("#sub_jenis").val(data.sub_jenis);
            $("#qty_sjm").val(data.qty_sjm);
            $("#satuan").val(data.satuan);
            $("#ukuran").val(data.ukuran);
            $("#id_kalkulasi").val(data.id_kalkulasi_sjm);
            $("#ubah").removeAttr('disabled');
          }
        })
      })
    })
  </script>
  <!-- Javascript agar menampilkan data per id untuk tampilan ubah selanjutnya pada ubah data surat jalan masuk -->

  <!-- untuk tambah no po berdasrakan id_lpb menggunakan modal -->
  <script type="text/javascript">
    $(document).ready(function() {
      $(".tambah-po").on('click',function(){
        var beri_po = $(this).data("id");
        $("#beri_po").modal('show');
        $("input[name=id_lpb]").val(beri_po);
      })
    });
  </script>

  <!-- untuk tambah tgl kirim production order berdasarkan id_po menggunakan modal -->
  <script type="text/javascript">
    $(document).ready(function() {
      $(".tambah-tgl-kirim").on('click',function(){
        var beri_tgl = $(this).data("id");
        $("#beri_tgl").modal('show');
        $("input[name=id_po]").val(beri_tgl);
      })
    });
  </script>

  <!-- untuk konfirmasi persetujuan berdasrakan id_lpb menggunakan modal -->
  <script type="text/javascript">
    $(document).ready(function() {
      $(".konfirm-persetujuan").on('click',function(){
        var konfirmasi_persetujuan = $(this).data("id");
        $("#konfirmasi_persetujuan").modal('show');
        $("input[name=id_lpb]").val(konfirmasi_persetujuan);
      })
    });
  </script>

  <!-- Untuk konfirmasi penolakan validasi production order dari Staff PPIC ke Direktur, Kepala Gudang, K.Production Manager -->
  <script type="text/javascript">
    $(document).ready(function() {
      $(".konfirmasi-ditolak").on('click',function(){
        var penolakan = $(this).data("id");
        $("#konfirmasi_ditolak").modal('show');
        $("input[name=id_po]").val(penolakan);
      })
    });
  </script>
  <!-- Untuk konfirmasi penolakan validasi production order dari Staff PPIC (Direktur, Kepala Gudang, K.Production Manager) -->

  <!-- untuk Detail konfirmasi permohonan persetujuan menggunakan modal -->
  <!-- <script type="text/javascript">
    $(document).ready(function() {
      $(".detail-konfirm").on('click',function(){
        var detail = $(this).data("id");
        console.log(detail);
        $.ajax({
          url:'<?php //echo base_url();?>index.php/user/validasi/lpb/detail_konfirmasi',
          method:'POST',
          dataType:'json',
          data:{id_lpb:detail},
          success:function(data)
          {

            console.log(data);
            $("#detail_konfirmasi").modal('show');
            if(data!==null)
            {
              $('#no_lpb').html(data.no_lpb);
              $('#yang_meminta').html(data.yang_meminta);
              $('#perihal').html(data.perihal); 
              $('#status').html(data.status_pengajuan); 
              $('#alasan').html(data.alasan); 
            }
            else
            {
              $('#no_lpb').html("");
              $('#yang_meminta').html("");
              $('#perihal').html(""); 
              $('#status').html(""); 
              $('#alasan').html(""); 
            }
          }
        });
      })
    });
  </script> -->

  <!-- untuk  pengajuan data production order ke menggunakan direktur, kepala gudang dan kepala production manager menggunakan modal -->
  <script type="text/javascript">
    $(document).ready(function() {
      $(".pengajuan-po").on('click',function(){
        var pengajuan = $(this).data("id");
        $("#pengajuan_po").modal('show');
        $("input[name=id_po]").val(pengajuan);
      })
    });
  </script>

  <!-- untuk status persetujuan production order dari user direktur, kepala gudang dan kepala production manager menggunakan modal -->
  <script type="text/javascript">
    $(document).ready(function() {
      $(".stat-persetujuan-po").on('click',function(){
        var persetujuan = $(this).data("id");
        $("#status_persetujuan_po").modal('show');
        console.log(persetujuan);
        $.ajax({
          url:'<?php echo base_url();?>index.php/user/production_order/production_order/status_persetujuan_po',
          method:'POST',
          dataType:'json',
          data:{id_po:persetujuan},
          success:function(data)
          {
            console.log(data);
            $("#status_persetujuan_po").modal('show');
            if(data!==null)
            {
              $('#no_po').html(data.no_po); 
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

  <!-- Javacsript untuk upload dan menampilkan foto -->
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
  <!-- Javacsript untuk upload dan menampilkan foto -->

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
        text: 'Pertumbuhan Production Order',
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
        data: ['Pers.Awal', 'Pers.Akhir', 'Top Index'],
        y: 'bottom'
      },
      xAxis: [{
        type: 'category',
        data: ['2007', '2008', '2009', '2010', '2011', '2012', '2013', '2014', '2015', '2016', '2017', '2018']
      }],
      yAxis: [{
        type: 'value',
        name: 'Order',
        axisLabel: {
          formatter: '{value} pcs'
        }
      }, {
        type: 'value',
        axisLabel: {
          formatter: '{value}'
        }
      }],
      series: [{
        name: 'Pers.Awal',
        type: 'bar',
        data: [0, 0, 202.00, 0, 2.00, 223.00, 0, 7.00, 0, 0, 0, 0]
      }, {
        name: 'Pers.Akhir',
        type: 'bar',
        data: [0, 0, 4, 0, 0, 0, 100, 0, 10, 0, 0, 0]
      }, {
        name: 'Top Index',
        type: 'line',
        yAxisIndex: 1,
        data: [0, 0, 202.00, 0, 2.00, 223.00, 100, 7.00, 10, 0, 0, 0]
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
  $(function()
  {
    $('#datepicker1').datepicker({
      format: "yyyy-mm-dd",
      autoclose: true
    })
    $('#datepicker2').datepicker({
      format: "yyyy-mm-dd",
      autoclose: true
    })
  })
</script>
<!-- Javascript menampilkan tanggal pada input text -->

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