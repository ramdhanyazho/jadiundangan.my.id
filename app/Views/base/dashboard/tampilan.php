<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
<div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
    </div>
        <?php
    clearstatcache();
    $kunci = $data[0]->kunci ?? '';
    $activeTheme = strtolower($order[0]->nama_theme ?? '');
    $noviantyBackgroundPreview = '/assets/themes/novianty/images/hero-texture.svg';
    if ($kunci !== '' && file_exists('assets/users/' . $kunci . '/novianty-bg.png')) {
        $noviantyBackgroundPreview = '/assets/users/' . $kunci . '/novianty-bg.png';
    }
    ?> 
    <div class="row mb-3">
        
        <div class="container">
        <!-- <div class="card h-100">
        <div class="card-body"> -->
        <div class="row">
            <div class="col-lg-3 col-md-6 col-xs-12 mt-5">
              <div class="card h-100 p-0" style="opacity:65%;">
                <img alt="image" class="img-fluid rounded-0" src="<?php echo base_url() ?>/assets/themes/<?= $order[0]->nama_theme ?>/preview.png">
      
                <div class="content p-2 d-flex justify-content-center">
                  <h3><strong><?= $order[0]->nama_theme ?></strong></h3>
                </div>

                <div class="d-flex justify-content-center">
                  <p class="mt-2 mr-2"><a href="#" class="btn btn-success btn-sm disabled" >Active</a></p>  
                </div>
              </div>
            </div>
          <?php foreach ($tema->getResult() as $row){ if($row->nama_theme == $order[0]->nama_theme) continue;?>
            <div class="col-lg-3 col-md-6 col-xs-12 mt-5">
              <div class="card h-100 p-0">
                <img alt="image" class="img-fluid rounded-0" src="<?php echo base_url() ?>/assets/themes/<?= $row->nama_theme ?>/preview.png">
      
                <div class="content p-2 d-flex justify-content-center">
                  <h3><strong><?= $row->nama_theme ?></strong></h3>
                </div>

                <div class="d-flex justify-content-center">
                  <p class="mt-2 mr-2">
                            <button class="btn btn-success btn-sm pilih" 
                            data-id="<?= $row->id?>" 
                            class="btn btn-sm btn-danger hapus" data-toggle="modal" data-target="#modalTema">Pilih</button></p>  
                  <p class="mt-2"><a href="<?= SITE_UTAMA.'/demo/'.$row->nama_theme ?>" class="btn btn-primary btn-sm">Demo</a></p>
                </div>
              </div>
            </div>
          <?php } ?>
          </div>
        <!-- </div>
          </div> -->
<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
<div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
    </div> 
    <?php
    clearstatcache();
    $kunci = $data[0]->kunci ?? '';
    $activeTheme = strtolower($order[0]->nama_theme ?? '');
    $noviantyBackgroundPreview = '/assets/themes/novianty/images/hero-texture.svg';
    if ($kunci !== '' && file_exists('assets/users/' . $kunci . '/novianty-bg.png')) {
        $noviantyBackgroundPreview = '/assets/users/' . $kunci . '/novianty-bg.png';
    }
    ?>
    <div class="row mb-3">
        
        <div class="container">
        <!-- <div class="card h-100">
        <div class="card-body"> -->
        <div class="row">
            <div class="col-lg-3 col-md-6 col-xs-12 mt-5">
              <div class="card h-100 p-0" style="opacity:65%;">
                <img alt="image" class="img-fluid rounded-0" src="<?php echo base_url() ?>/assets/themes/<?= $order[0]->nama_theme ?>/preview.png">
      
                <div class="content p-2 d-flex justify-content-center">
                  <h3><strong><?= $order[0]->nama_theme ?></strong></h3>
                </div>

                <div class="d-flex justify-content-center">
                  <p class="mt-2 mr-2"><a href="#" class="btn btn-success btn-sm disabled" >Active</a></p>  
                </div>
              </div>
            </div>
          <?php foreach ($tema->getResult() as $row){ if($row->nama_theme == $order[0]->nama_theme) continue;?>
            <div class="col-lg-3 col-md-6 col-xs-12 mt-5">
              <div class="card h-100 p-0">
                <img alt="image" class="img-fluid rounded-0" src="<?php echo base_url() ?>/assets/themes/<?= $row->nama_theme ?>/preview.png">
      
                <div class="content p-2 d-flex justify-content-center">
                  <h3><strong><?= $row->nama_theme ?></strong></h3>
                </div>

                <div class="d-flex justify-content-center">
                  <p class="mt-2 mr-2">
                            <button class="btn btn-success btn-sm pilih" 
                            data-id="<?= $row->id?>" 
                            class="btn btn-sm btn-danger hapus" data-toggle="modal" data-target="#modalTema">Pilih</button></p>  
                  <p class="mt-2"><a href="<?= SITE_UTAMA.'/demo/'.$row->nama_theme ?>" class="btn btn-primary btn-sm">Demo</a></p>
                </div>
              </div>
            </div>
          <?php } ?>
          </div>
        <!-- </div>
          </div> -->
        <?php if ($activeTheme === 'novianty') : ?>
          <div class="row mt-5">
            <div class="col-xl-6 col-lg-8 mb-4">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Background Tema Novianty</h6>
                </div>
                <div class="card-body">
                  <?= form_open_multipart(base_url('user/update_background_theme')); ?>
                  <div class="upload-area-bg" style="text-align: center;">
                    <div class="col">
                      <div class="row">
                        <div class="col-12 col-md-8 col-lg-8 d-flex align-items-center justify-content-center">
                          <div class="upload-area" style="height: 100%;padding: 5px 5px;">
                            <img src="<?php echo base_url() ?><?= $noviantyBackgroundPreview ?>" id="img-theme-bg" style='border-radius: 5px;height: 200px;max-width: 100%;object-fit: cover;'>
                          </div>
                        </div>
                        <div class="col-12 col-md-4 col-lg-4 d-flex align-items-center justify-content-center mt-3">
                          <div class="btn btn-primary">
                            <input type="file" class="file-upload" id="bg-theme"  name="bg-theme" accept="image/*" onchange="preview_novianty_bg(event)"> Upload Foto
                          </div>
                        </div>
                        <div class="col mt-3">
                          <button class="btn btn-primary btn-lg btn-block" type="submit">Simpan</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?= form_close() ?>
                  <div class="mt-3 text-left">
                    <p>Unggah gambar latar belakang khusus untuk tema Novianty. Gunakan format JPG atau PNG dengan ukuran maksimal 2 MB.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php endif; ?>
        </div>    

    </div>
    <!--Row-->
</div>
<!---Container Fluid-->

<!-- Modal -->
<div class="modal fade" id="modalTema" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Peringatan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Apakah kamu yakin ingin mengubah tema ?
        <input type="hidden" name="idTema" id="idTema" value=""/>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" id="pilihBtn">Ya</button>
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Batal</button>
      </div>
    </div>
  </div>
</div>


<script>
    
    $('.pilih').on('click', function (event) {
        var idtema = $(this).data('id');
        $(".modal-body #idTema").val( idtema );
    });

    $('#pilihBtn').on('click', function(event) {

        var idtema = $('#idTema').val();

        $.ajax({
            url : "<?= base_url('user/ganti_tema') ?>",
            method : "POST",
            data : {id: idtema},
            async : true,
            dataType : 'html',
            success: function($hasil){
               if($hasil == 'sukses'){
                location.reload();
               }
            }
        });

    });

</script>
<script>
  function preview_novianty_bg(event) {
    var reader = new FileReader();
    reader.onload = function () {
      var output = document.getElementById('img-theme-bg');
      if (output) {
        output.src = reader.result;
      }
    };
    if (event.target.files && event.target.files[0]) {
      reader.readAsDataURL(event.target.files[0]);
    }
  }
</script>