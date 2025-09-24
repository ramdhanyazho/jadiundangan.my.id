<!DOCTYPE html>
<html Content-Language="ID" lang="id" xml:lang="id">
<head>
  <?php foreach ($mempelai->getResult() as $row){ ?>
    <title><?php echo $row->nama_panggilan_pria." & ".$row->nama_panggilan_wanita; ?> </title> 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:title" content="<?php echo $row->nama_panggilan_pria." & ".$row->nama_panggilan_wanita; ?>">
    <meta property="og:url" content="<?php echo base_url() ?>">
    <meta property="og:image:width" content="300">
    <meta property="og:image:height" content="300">
    <meta property="og:type" content="website" />
  <?php }?>

  <!-- CSS STYLE AREA	 -->
  <?php foreach ($data->getResult() as $row){
    $kunci = $row->kunci;
  }
  ?>
  <link rel="icon" href="<?= base_url() ?>/assets/users/<?= $kunci; ?>/kita.png">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>/assets/bukutamu/css/style.css">
  <script src="<?= base_url('assets/dashboard'); ?>/vendor/jquery/jquery.min.js"></script>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <!--<script src="https://rawgit.com/sitepoint-editors/jsqrcode/master/src/qr_packed.js"></script>-->
  <script src="<?= base_url() ?>/assets/base/js/qr_packed.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.css">
  <style>
    @media (max-width: 300px) {
      #camera video {
        max-width: 80%;
        max-height: 80%;
      }


    }
  </style>
</head>

<body style="background-image: url('<?= base_url() ?>/assets/users/<?= $kunci; ?>/bg-tamu.png');">
  <?php
  $satu_hari        = mktime(0,0,0,date("n"),date("j"),date("Y"));
  function tglIndonesia($str){
    $tr   = trim($str);
    $str    = str_replace(array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'), array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'), $tr);
    return $str;
  }
  ?>

  <div class="container" style="padding-top:10px">
    <div class="row">
      <div class="col-sm-8" >
        <div id="myCarousel" style="border: 5px solid #333333;" class="carousel slide" data-ride="carousel">
          <!-- Indicators -->
          <ol class="carousel-indicators">
            <?php

            foreach ($slider as $key => $data) {
              $active = ($key == 0) ? 'active' : '';
              echo '<li data-target="#carousel-berita" data-slide-to="' . $key . '" class="' . $active . '"></li>';
            }
            ?>
          </ol>

          <!-- Wrapper for slides -->
          <div class="carousel-inner" role="listbox">
            <?php
            foreach($slider as $key => $data) {
              $active = ($key == 0) ? 'active' : '';
              echo '<div class="item ' . $active . '">' ?>
              <img src="<?php echo base_url() ?>/assets/users/<?php echo $kunci.'/'.$data['nama_slider']; ?>.png" alt="img-fluid">
            </div>
          <?php }
          ?>

        </div>

        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="well" style="background-image: linear-gradient(black,white); color:white; border: 5px solid #333333;">
        <?php foreach ($mempelai->getResult() as $row){  ?>
          <p class="utama-mempelai"><u><?php echo $row->nama_panggilan_pria; ?> & <?php echo $row->nama_panggilan_wanita; ?></p></u> <?php } ?>
          <?php foreach ($acara->getResult() as $row){ 
            $tanggal_resepsi =  $row->tanggal_resepsi;
            $tanggal_sekarang = date('Y/m/d');
            ?>
            <b><p class="utama-detail" id="tanggal-acara-resepsi"><?php echo $row->tanggal_resepsi; ?></p></b>
            <p class="utama-detail"><?php echo $row->tempat_resepsi; ?></p>
            <span class="utama-detail"><?php echo $row->alamat_resepsi; ?></span>
          <?php } ?>


        </div>
        <div class="well" style="border: 5px solid #333333;">
          <h1 class="utama-detail" id="tanggal-sekarang-acara"><?php echo $tanggal_sekarang; ?></h1>
          <h1 class="utama-detail" id="jam"></h1>
        </div>
      </div>
    </div>
    <hr>
  </div>

  <div class="container text-center" id ="scan-hadir-tamu">    
    <div class="row">
      <div class="col col-sm-3">
        <b><h4>Scan QR Code</h4></b>
        <div class="well" style="border: 5px solid #333333;">
          <a id="btn-scan-qr">
            <img src="<?php echo base_url() ?>/assets/dashboard/img/qrscan.png" alt="Image" class="img-fluid">
          </a>
          <canvas hidden="" id="qr-canvas"></canvas>
        </div>
      </div>
      <div class="col col-sm-3" > 
        <b><h4>Capture Foto Selfi</h4></b>
        <div class="well" id="canvas-camera" style="border: 5px solid #333333">
          <a id="btn-capture" onClick="configure()">
            <img src="<?php echo base_url() ?>/assets/bukutamu/img/photo-capture.png" alt="Image" class="img-fluid"></a>
            <div id="camera" hidden="" style="display:none;"></div>
            <div id="webcam" hidden="" style="display:none;">
              <input type="button" class="btn btn-sm btn-danger" value="Capture" id="btn-capture" onClick="preview()" >
            </div>
            <div id="simpan" hidden="" style="display:none">
              <button type="button" class="btn btn-sm btn-danger" id="reset" onClick="batal()">Remove</button>
              <button type="button" class="btn btn-sm btn-primary" name="save" id="save" >Simpan</button>
              <input type="hidden" name="image" class="image-tag">
            </div>
          </div>  
        </div>
        <div class="col-sm-3">
          <b><h4>Identitas Tamu</h4></b>
          <div class="well" style="border: 5px solid #333333;">

            <div class="col mt-2" id="qr-result" >
              <label>QR Code Tamu</label>
              <input id="outputData" type="text" class="form-control" onfocus="autofill(this.value)" placeholder="QR Code Tamu Undangan" required>
            </div>

            <div class="col mt-2">
              <label>Nama Tamu</label>
              <input id="nama_tamu" type="text" class="form-control" placeholder="Contoh : Jack Dawson S.Kom" value="" disabled required>
            </div>

            <div class="col mt-2">
              <label>Alamat Tamu</label>
              <input id="alamat_tamu" type="text" class="form-control" placeholder="Contoh : Jack" value="" disabled required>
            </div>
          </div>
        </div>
        <div class="col-sm-3">
          <b><h4>Kehadiran Tamu</h4></b>
          <div>
           <ul class="list-group" style="border: 5px solid #333333;">
             <?php if(empty($hadir)) {?>
              <li class="list-group-item"><strong>Belum Ada Data Tamu Hadir</strong></li>
            <?php }else { ?>
              <?php foreach($hadir as $row){ 
                ?>
                <li class="list-group-item"><strong><?= $row->nama_tamu ?></strong><br><small><?= $row->alamat_tamu ?></small></li>
              <?php }
            } ?>
          </ul>


        </div>
      </div>  
    </div>
  </div>
  <div class="modal fade" id="modalGagal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Kesalahan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Mohon Maaf, Tamu Undangan Sudah Mengisi Form Kehadiran/ tidak ditemukan
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function () {
      $('#save').on('click', function(event) {
        event.preventDefault();
        var image = $('.image-tag').val();
        var qrcode2 = $('#outputData').val();
        var nama =  $('#nama_tamu').val();
        $.ajax({
          url : base_url+'/add_hadir',
          method : "POST",
          data : {qrcode:qrcode2, image : image, nama:nama},
          async : true,
          dataType : 'html',
          success: function($hasil){
            if($hasil == 'sukses'){
              location.reload();

            }else{
              $('#modalHadir').modal('hide'); 
              $('#modalGagal').modal('show'); 
            }
            console.log($hasil);
          }
        });
      });
    });
  </script>
  <script language="JavaScript">
    function preview() {
      const x = document.getElementById('camera');
            // untuk preview gambar sebelum di upload
            Webcam.snap( function(data_uri) {
              $(".image-tag").val(data_uri);
              Webcam.freeze();
            // ganti display webcam menjadi none dan simpan menjadi terlihat
            document.getElementById('webcam').hidden = true;
            document.getElementById('simpan').hidden= false;
            //document.getElementById('webcam').style.display = 'none';
            document.getElementById('simpan').style.display = '';
            x.getElementsByTagName("video")[0].hidden= true;
          } );
          }

          function batal() {
            // batal preview
            Webcam.unfreeze();
            const x = document.getElementById('camera');
            // ganti display webcam dan simpan seperti semula
            document.getElementById('webcam').hidden = false;
            document.getElementById('simpan').hidden = true;
            document.getElementById('webcam').style.display = '';
            x.getElementsByTagName("video")[0].hidden= false;
            //document.getElementById('simpan').style.display = 'none';
          }
        </script>
        <script>

          $(document).ready(function () {
            const qrcode = window.qrcode;
            const video = document.createElement("video");
            const canvasElement = document.getElementById("qr-canvas");
            const canvas = canvasElement.getContext("2d");
            const qrResult = document.getElementById("qr-result");
            const outputData = document.getElementById("outputData");
            const btnScanQR = document.getElementById("btn-scan-qr");
            let scanning = false;

            qrcode.callback = res => {
              if (res) {
                $("#outputData").val(res);
                scanning = false;

                video.srcObject.getTracks().forEach(track => {
                  track.stop();
                });

                qrResult.hidden = false;
                canvasElement.hidden = true;
                btnScanQR.hidden = false;
                document.getElementById('outputData').focus();
                Webcam.set({
                  width: 187,
                  height: 140,
            dest_width: 187, // device capture size
            dest_height: 140,
    crop_width: 187, // final cropped size
    crop_height: 140,
    image_format: 'jpg',
    jpeg_quality: 100
  });
                Webcam.attach('#camera');
                document.getElementById('btn-capture').hidden = true;
                document.getElementById('webcam').style.display = '';
                document.getElementById('webcam').hidden = false;
                document.getElementById('camera').style.display = '';
                document.getElementById('camera').hidden = false;

              }
            };

            btnScanQR.onclick = () => {
              navigator.mediaDevices
              .getUserMedia({ video: { facingMode: "environment" } })
              .then(function(stream) {
                scanning = true;
                qrResult.hidden = false;
                btnScanQR.hidden = true;
                canvasElement.hidden = false;
                Webcam.unfreeze();
                document.getElementById('simpan').style.display = 'none';
                document.getElementById('btn-capture').hidden = false;
                document.getElementById('camera').style.display = 'none';
                document.getElementById('webcam').hidden = true;
                document.getElementById('camera').hidden = true;

      video.setAttribute("playsinline", true); // required to tell iOS safari we don't want fullscreen
      video.srcObject = stream;
      video.play();
      tick();
      scan();
    });
            };

            function tick() {
              canvasElement.height = video.videoHeight;
              canvasElement.width = video.videoWidth;
              canvas.drawImage(video, 0, 0, canvasElement.width, canvasElement.height);

              scanning && requestAnimationFrame(tick);
            }

            function scan() {
              try {
                qrcode.decode();
              } catch (e) {
                setTimeout(scan, 300);
              }
            }
          });
        </script>

        <script>
          function autofill(){
           var qrcode = $("#outputData").val();
           $.ajax({
            url:"<?= base_url('bukutamu/autofill') ?>",
            data:'&qrcode='+qrcode,
            success:function(data){
              var hasil = JSON.parse(data);
              $.each(hasil, function(key,val){ 
                document.getElementById('nama_tamu').value=val.nama_tamu;
                document.getElementById('alamat_tamu').value=val.alamat_tamu;

              });
            }
          });
         }
       </script>
       <script type="text/javascript">
         window.onload = function() { jam(); }

         function jam() {
          var e = document.getElementById('jam'),
          d = new Date(), h, m, s;
          h = d.getHours();
          m = set(d.getMinutes());
          s = set(d.getSeconds());

          e.innerHTML = h +':'+ m +':'+ s;

          setTimeout('jam()', 1000);
        }

        function set(e) {
          e = e < 10 ? '0'+ e : e;
          return e;
        }
      </script>
      <script>
        $(function(){
          <?php if(session()->has("success")) { ?>
            Swal.fire({
              icon: 'success',
              title: 'Great!',
              text: '<?= session("success") ?>'
            })
          <?php } ?>
          <?php if(session()->has("deleted")) { ?>
            Swal.fire({
              icon: 'warning',
              title: 'Great!',
              text: '<?= session("deleted") ?>'
            })
          <?php } ?>
          <?php if(session()->has("updated")) { ?>
            Swal.fire({
              icon: 'success',
              title: 'Great!',
              text: '<?= session("updated") ?>'
            })
          <?php } ?>
          <?php if(session()->has("error")) { ?>
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: '<?= session("error") ?>'
            })
          <?php } ?>
        });
      </script>
    </body>
    <script>var base_url = '<?php echo base_url() ?>';</script>
    <script>var tanggal_resepsi = '<?php echo $tanggal_resepsi; ?>';</script>
    <script>var tanggal_sekarang = '<?php echo $tanggal_sekarang; ?>';</script>
    <script src="<?php echo base_url() ?>/assets/bukutamu/js/moment-with-locales.js"></script>
    <script src="<?php echo base_url() ?>/assets/bukutamu/js/script.js"></script>
    </html>