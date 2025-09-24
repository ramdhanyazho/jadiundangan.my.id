<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?> - <?= $subtitle; ?></h1>
        <div>
        <a href="<?= SITE_UNDANGAN ?>/<?= $order[0]->domain ?>" class="btn btn-primary btn-sm">Lihat Website</a>
        </div>
    </div> 
    
    <?= view($view_2); ?>

</div>


<!-- Modal -->
<div class="modal fade" id="modalDomain" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Peringatan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Apakah kamu yakin ingin mengubah nama domain ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" id="simpanDomain">Ya</button>
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Batal</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modalFitur" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Peringatan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Apakah kamu yakin ingin menyimpan perubahan ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" id="simpanFitur">Ya</button>
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Batal</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
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
        Gagal mengganti nama domain..
        Nama domain sudah dipakai!!
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalAkad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Peringatan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Apakah kamu yakin ingin menyimpan perubahan ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" id="simpanAkad">Ya</button>
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Batal</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modalResepsi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Peringatan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Apakah kamu yakin ingin menyimpan perubahan ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" id="simpanResepsi">Ya</button>
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Batal</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalMaps" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Peringatan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Apakah kamu yakin ingin menyimpan perubahan ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" id="simpanMaps">Ya</button>
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Batal</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalVideo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Peringatan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Apakah kamu yakin ingin menyimpan perubahan ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" id="simpanVideo">Ya</button>
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Batal</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modalWanita" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Peringatan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Apakah kamu yakin ingin menyimpan perubahan ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" id="simpanWanita">Ya</button>
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Batal</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalPria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Peringatan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Apakah kamu yakin ingin menyimpan perubahan ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" id="simpanPria">Ya</button>
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Batal</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalSalamPembuka" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Peringatan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Apakah kamu yakin ingin menyimpan perubahan ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" id="simpanSalamPembuka">Ya</button>
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Batal</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modalUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Peringatan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Apakah kamu yakin ingin menyimpan perubahan ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" id="simpanUser">Ya</button>
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Batal</button>
      </div>
    </div>
  </div>
</div>



<script src="<?php echo base_url() ?>/assets/base/js/croppie.min.js"></script>
<script src="<?php echo base_url() ?>/assets/base/js/dropzone.js"></script>
<script src="<?php echo base_url() ?>/assets/base/js/pikaday.js"></script>

<script>

    // ============= CERITA       
    <?= 
        $jml_cerita = count($cerita); 
        $kunci = $data[0]->kunci;
    ?>            
    var i = <?php echo $jml_cerita ?>;

    $(document).on('click', '.btn_remove', function(){  

       var button_id = $(this).attr("id");
       $('#cerita'+button_id+'').remove();  
       i--;

       if(i == 0){
        $("..form-control").prop('required',true);
       }

     });  

    $('#addCerita').click(function(){  

      i++;  

      $('#konten-cerita').append('<div id="cerita'+i+'"><div class="row align-items-center mt-3"><div class="col-auto"><a style="color: #2c3e50;margin-bottom:0px;font-size: 20px;font-weight: 600;display: flex;">#'+i+'</a></div><div class="col"><a id="'+i+'" class="btn btn-sm btn_remove" style="background-color: #dc3545;padding: 5px;font-size: 12px;border-radius: 5px;">Hapus</a></div></div><div class="row align-items-center"><div class="col"><label>Tanggal</label><input name="tanggal_cerita[]" type="text" class="form-control" placeholder="Contoh : 14 Januari 2020 " required></div></div><div class="row align-items-center mt-3"><div class="col"><label>Judul</label><input name="judul_cerita[]" type="text" class="form-control" placeholder="Contoh : Pertama Bertemu" required></div></div><div class="row align-items-center mt-3"><div class="col"><label>Isi Cerita</label><textarea name="isi_cerita[]" type="text" class="form-control" placeholder="Maximal 500 Karakter" maxlength="500" rows="4" required></textarea></div></div></div>');  
        $(".form-control").prop('required',false);
    });


    // =========== ACARA


    moment.locale('id');
    $('#datepicker').val(moment('<?= $acara[0]->tanggal_akad ?>').format('dddd, Do MMMM YYYY'));
    var picker = new Pikaday({ 
      
      field: $('#datepicker')[0],
      format: 'dddd, Do MMMM YYYY',
      onSelect: function() {
        $('#tanggal_akad').val(this.getMoment().format('YYYY/MM/DD'));
      }
    });

    $('#datepicker2').val(moment('<?= $acara[0]->tanggal_resepsi ?>').format('dddd, Do MMMM YYYY'));
    var picker = new Pikaday({ 
      format: 'dddd, Do MMMM YYYY',
      field: $('#datepicker2')[0],
      onSelect: function() {
        $('#tanggal_resepsi').val(this.getMoment().format('YYYY/MM/DD'));
      }
    });
       
    $('#simpanAkad').on('click', function(event) {

        var datanyaSiapa = 'akad';
        var tanggal = $('#tanggal_akad').val();
        var waktu = $('#waktu_akad').val();
        var lokasi = $('#lokasi_akad').val();
        var alamat = $('#alamat_akad').val();

        $.ajax({
            url : "<?= base_url('admin/update_acara') ?>",
            method : "POST",
            data : {tanggal: tanggal,waktu: waktu, lokasi: lokasi, alamat: alamat, datanyaSiapa: datanyaSiapa},
            async : true,
            dataType : 'html',
            success: function($hasil){
                if($hasil == 'sukses'){
                    location.reload();
                }
            }
        });

    });

    $('#simpanResepsi').on('click', function(event) {

        var datanyaSiapa = 'resepsi';
        var tanggal = $('#tanggal_resepsi').val();
        var waktu = $('#waktu_resepsi').val();
        var lokasi = $('#lokasi_resepsi').val();
        var alamat = $('#alamat_resepsi').val();

        $.ajax({
            url : "<?= base_url('admin/update_acara') ?>",
            method : "POST",
            data : {tanggal: tanggal,waktu: waktu, lokasi: lokasi, alamat: alamat, datanyaSiapa: datanyaSiapa},
            async : true,
            dataType : 'html',
            success: function($hasil){
                if($hasil == 'sukses'){
                    location.reload();
                }
            }
        });

    });

    $('#simpanMaps').on('click', function(event) {

        var maps = $('#maps').val();
        $.ajax({
            url : "<?= base_url('admin/update_maps') ?>",
            method : "POST",
            data : {maps: maps},
            async : true,
            dataType : 'html',
            success: function($hasil){
                if($hasil == 'sukses'){
                    location.reload();
                }
            }
        });

    });



    

    $('#simpanVideo').on('click', function(event) {

        var video = $('#video').val();
        $.ajax({
            url : "<?= base_url('admin/update_video') ?>",
            method : "POST",
            data : {video: video},
            async : true,
            dataType : 'html',
            success: function($hasil){
                if($hasil == 'sukses'){
                    location.reload();
                }
            }
        });

    });



    // ========== MEMPELAI
    $(document).ready(function () {
         /** croppie shareurcodes.com **/
        var croppie = null;
        var el = document.getElementById('resizer');

        $.base64ImageToBlob = function(str) {
            /** extract content type and base64 payload from original string **/
            var pos = str.indexOf(';base64,');
            var type = str.substring(5, pos);
            var b64 = str.substr(pos + 8);
        
            /* decode base64 */
            var imageContent = atob(b64);
        
            /* create an ArrayBuffer and a view (as unsigned 8-bit) */
            var buffer = new ArrayBuffer(imageContent.length);
            var view = new Uint8Array(buffer);
        
            /* fill the view, using the decoded base64 */
            for (var n = 0; n < imageContent.length; n++) {
            view[n] = imageContent.charCodeAt(n);
            }
        
            /* convert ArrayBuffer to Blob */
            var blob = new Blob([buffer], { type: type });
        
            return blob;
        }

        $.getImage = function(input, croppie) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {  
                    croppie.bind({
                        url: e.target.result,
                    });
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        var fotonyasiapa = '';
        $(".file-upload").on("change", function(event) {
            $("#myModal").modal();
            fotonyasiapa = $(this).attr("id");
            console.log("foto_"+fotonyasiapa);
            /* Initailize croppie instance and assign it to global variable */
            croppie = new Croppie(el, {
                    viewport: {
                        width: 200,
                        height: 200,
                        type: 'square'
                    },
                    boundary: {
                        width: 250,
                        height: 250
                    },
                    enableOrientation: true
                });
            $.getImage(event.target, croppie); 
        });

        $("#upload").on("click", function() {
            croppie.result('base64').then(function(base64) {
                $("#myModal").modal("hide"); 
                $("#profile-pic").attr("src","/images/ajax-loader.gif");

                var url = "<?php echo base_url('admin/update_foto_mempelai') ?>";
                var formData = new FormData();
                formData.append("foto_"+fotonyasiapa, $.base64ImageToBlob(base64));
                formData.append("kunci", "<?= $kunci ?>");


                $.ajax({
                    type: 'POST',
                    url: url,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                    console.log(data);
                        if (data == "uploadedbride") {
                            $("#profile-pic-bride").attr("src", base64); 
                        } else if(data == "uploadedgroom"){
                            $("#profile-pic-groom").attr("src", base64); 
                        } else if(data == "uploadedsampul"){
                            $("#profile-pic-sampul").attr("src", base64); 
                        } else {
                            $("#profile-pic").attr("src","/images/icon-cam.png"); 
                            console.log(data['profile_picture']);
                        }
                    },
                    error: function(error) {
                        console.log(error);
                        $("#profile-pic").attr("src","/images/icon-cam.png"); 
                    }
                });
            });
        });

        /* To Rotate Image Left or Right */
        $(".rotate").on("click", function() {
            croppie.rotate(parseInt($(this).data('deg'))); 
        });

        $('#myModal').on('hidden.bs.modal', function (e) {
            /* This function will call immediately after model close */
            /* To ensure that old croppie instance is destroyed on every model close */
            setTimeout(function() { croppie.destroy(); }, 100);
        });

});

      $('#simpanWanita').on('click', function(event) {

        var datanyaSiapa = 'wanita';
        var nama = $('#nama_lengkap_wanita').val();
        var nama_panggilan = $('#nama_panggilan_wanita').val();
        var nama_ayah = $('#nama_ayah_wanita').val();
        var nama_ibu = $('#nama_ibu_wanita').val();
        console.log(nama);
        $.ajax({
            url : "<?= base_url('admin/update_mempelai') ?>",
            method : "POST",
            data : {nama: nama,nama_panggilan: nama_panggilan, nama_ayah: nama_ayah, nama_ibu: nama_ibu, datanyaSiapa: datanyaSiapa},
            async : true,
            dataType : 'html',
            success: function($hasil){
                if($hasil == 'sukses'){
                    location.reload();
                }
            }
        });

      });

      $('#simpanSalamPembuka').on('click', function(event) {

            var salam = $('#salamPembukaData').val();

            $.ajax({
                url : "<?= base_url('admin/update_salam_pembuka') ?>",
                method : "POST",
                data : {salam: salam},
                async : true,
                dataType : 'html',
                success: function($hasil){
                    if($hasil == 'sukses'){
                        location.reload();
                    }
                }
            });

        });

      $('#simpanPria').on('click', function(event) {

      var datanyaSiapa = 'pria';
      var nama = $('#nama_lengkap_pria').val();
      var nama_panggilan = $('#nama_panggilan_pria').val();
      var nama_ayah = $('#nama_ayah_pria').val();
      var nama_ibu = $('#nama_ibu_pria').val();

      $.ajax({
          url : "<?= base_url('admin/update_mempelai') ?>",
          method : "POST",
          data : {nama: nama,nama_panggilan: nama_panggilan, nama_ayah: nama_ayah, nama_ibu: nama_ibu, datanyaSiapa: datanyaSiapa},
          async : true,
          dataType : 'html',
          success: function($hasil){
              if($hasil == 'sukses'){
                  location.reload();
              }
          }
      });

      });


    //========== PENGATURAN 
    function nospaces(t){
      if(t.value.match(/\s/g)){
        t.value=t.value.replace(/\s/g,'');
      }
    }

    $('#simpanFitur').on('click', function(event) {

        var ucapan = $('#setUcapan').is(":checked") ? 1 : 0;
        var album = $('#setAlbum').is(":checked") ? 1 : 0;
        var cerita = $('#setCerita').is(":checked") ? 1 : 0;
        var lokasi = $('#setLokasi').is(":checked") ? 1 : 0;

        console.log(ucapan);

        $.ajax({
            url : "<?= base_url('admin/update_fitur') ?>",
            method : "POST",
            data : {ucapan: ucapan,album: album, cerita: cerita, lokasi: lokasi},
            async : true,
            dataType : 'html',
            success: function($hasil){
                if($hasil == 'sukses'){
                    location.reload();
                }
            }
        });

    });

    $('#simpanDomain').on('click', function(event) {

      var domain = $('#domain').val();      

      $.ajax({
          url : "<?= base_url('admin/update_domain') ?>",
          method : "POST",
          data : {domain: domain},
            async : true,
            dataType : 'html',
          success: function($hasil){
              if($hasil == 'sukses'){
                  location.reload();
              }else{
                  $('#modalDomain').modal('hide'); 
                  $('#modalGagal').modal('show'); 
              }

              console.log($hasil);
          }
      });

    });

    //=======PROFIL
    $('#simpanUser').on('click', function(event) {

        var username = $('#username').val();
        var hp = $('#hp').val();
        var password = $('#password').val();
        var email = $('#email').val();

        $.ajax({
            url : "<?= base_url('admin/update_user') ?>",
            method : "POST",
            data : {username: username,password: password, hp: hp, email: email},
            async : true,
            dataType : 'html',
            success: function($hasil){
                if($hasil == 'sukses'){
                    location.reload();
                }
            }
        });

    });

    // ============= GALLERY

    var myDropzone = new Dropzone(document.body, { 
    url: "<?php echo base_url('admin/update_gallery'); ?>", 
    paramName: "file",
    acceptedFiles: 'image/*',
    autoQueue: true,
    maxFilesize: 2,  //ukuran maksimal foto 
    clickable: ".do-add-btn" 
    });

    myDropzone.on("success", function(file,response){
        if(response == ""){
        $('.dz-preview').remove();
        alert('Batas Upload 10 Foto!');

        }else{
        var aql = JSON.parse(response);
        $('.dz-preview').remove();
        $("#previewss").prepend('<div id="preview'+aql.no+'" class="file-row preview-uploads"><div class="preview-uploads-img"><span class="preview"><img id="img3" src="<?= base_url() ?>/assets/users/'+aql.kunci+'/album'+aql.no+'.png"  style="height: 100%;object-position: center;object-fit: cover;width: 100%;" /></span></div><div class="preview-uploads-name"><p class="name" style="line-height: revert;font-size: 12px;" data-dz-name>album'+aql.no+'</p><strong class="error text-danger" style="line-height: revert;font-size: 12px;"  ></strong><p class="size" style="line-height: revert;font-size: 12px;" >-</p></div><div  class="preview-uploads-delete"><button id="'+aql.no+'" class="btn btn-danger delete btnhehe">Hapus</button></div></div>');
        }
        $('#loading').hide();
    });

    myDropzone.on("sending", function(file, xhr, formData) {
    $('.dz-preview').remove();
    formData.append("kunci", "<?= $kunci ?>");
    $('#loading').show();
    });


    myDropzone.on("error", function(file, response) {
    $('.dz-preview').remove();
    alert('Maximal File = 2MB!');
    $('#loading').hide();
    });

    $(document).on('click', '.btnhehe', function(){  

    var button_id = $(this).attr("id");
    var kunci = "<?= $kunci ?>";
    $.ajax({
        type: 'POST',
        url: '<?= base_url('admin/del_gallery') ?>',
        data: {id: button_id,kunci: kunci},
        success: function(data){
            console.log('success: ' + data);
            $('#preview'+button_id).remove();
        }
    });
    
    });

</script>