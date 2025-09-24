<div class="row mb-3">
    <a href="<?= base_url('admin/edit_pengguna/mempelai') ?>" type="button" class="btn btn-primary m-1 ">Mempelai</a>
    <a href="<?= base_url('admin/edit_pengguna/acara') ?>" type="button" class="btn btn-outline-primary m-1">Acara</a>
    <a href="<?= base_url('admin/edit_pengguna/video') ?>" type="button" class="btn btn-outline-primary m-1">Video</a>
    <a href="<?= base_url('admin/edit_pengguna/cerita') ?>" type="button" class="btn btn-outline-primary m-1">Cerita</a>
    <a href="<?= base_url('admin/edit_pengguna/gallery') ?>" type="button" class="btn btn-outline-primary m-1">Gallery</a>
    <a href="<?= base_url('admin/edit_pengguna/pengaturan') ?>" type="button" class="btn btn-outline-primary m-1">Pengaturan</a>
    <a href="<?= base_url('admin/edit_pengguna/profil') ?>" type="button" class="btn btn-outline-primary m-1">Profil</a>
</div>

<div class="row mb-3">
        <?php 
            $kunci = $data[0]->kunci;
            $fotogroom = "/assets/users/".$kunci."/groom.png";
            $fotobride = "/assets/users/".$kunci."/bride.png";
            $fotosampul = "/assets/users/".$kunci."/kita.png";
        ?>
        <div class="row">

          <div class="col-xl-6 col-lg-6 mb-4">
              <div class="card mb-4">
                  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                      <h6 class="m-0 font-weight-bold text-primary">Data Mempelai Pria</h6>
                  </div>
                  <div class="card-body">
                      <!-- CONTENT DISINI -->
                      <div class="upload-area-bg" style="text-align: center;">
                          <div class="col">
                              <div class="row">
                                  <div class="col-12 col-md-6 col-lg-6 d-flex align-items-center justify-content-center">
                                      <div class="upload-area" style="height: 100%;padding: 5px 5px;">
                                      <img src="<?php echo base_url() ?><?= $fotogroom ?>" id="profile-pic-groom" style='border-radius: 5px;height: 200px;width: 200px;'>
                                      </div>
                                  </div>
                                  <div class="col-12 col-md-6 col-lg-6 d-flex align-items-center justify-content-center mt-3">
                                      <div class="btn btn-primary">
                                          <input type="file" class="file-upload" id="groom"  name="profile_picture" accept="image/*"> Upload Foto
                                      </div>
                                  </div>
                              </div>   
                          </div>
                      </div>
                      <hr>
                      <div class="col mt-2">
                          <label>Nama Lengkap</label>
                          <input id="nama_lengkap_pria" type="text" class="form-control" placeholder="Contoh : Jack Dawson S.Kom" value="<?= $mempelai[0]->nama_pria ?>" required>
                      </div>

                      <div class="col mt-2">
                          <label>Nama Panggilan</label>
                          <input id="nama_panggilan_pria" type="text" class="form-control" placeholder="Contoh : Jack" value="<?=  $mempelai[0]->nama_panggilan_pria ?>" required>
                      </div>

                      <div class="col mt-2">
                          <label>Nama Ayah</label>
                          <input id="nama_ayah_pria" type="text" class="form-control" placeholder="Nama Ayah" value="<?= $mempelai[0]->nama_ayah_pria ?>" required>
                      </div>

                      <div class="col mt-2">
                          <label>Nama Ibu</label>
                          <input id="nama_ibu_pria" type="text" class="form-control" placeholder="Nama Ibu" value="<?= $mempelai[0]->nama_ibu_pria ?>" required>
                      </div>
                      <div class="col mt-3">
                          <button class="btn btn-primary" data-toggle="modal" data-target="#modalPria">Simpan</button>
                      </div>
                  </div>
              </div>
          </div>

          <div class="col-xl-6 col-lg-6 mb-4">
              <div class="card mb-4">
                  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                      <h6 class="m-0 font-weight-bold text-primary">Data Mempelai Wanita</h6>
                  </div>
                  <div class="card-body">
                      <!-- CONTENT DISINI -->
                      <div class="upload-area-bg" style="text-align: center;">
                          <div class="col">
                              <div class="row">
                                  <div class="col-12 col-md-6 col-lg-6 d-flex align-items-center justify-content-center">
                                      <div class="upload-area" style="height: 100%;padding: 5px 5px;">
                                      <img src="<?php echo base_url() ?><?= $fotobride ?>" id="profile-pic-bride" style='border-radius: 5px;height: 200px;width: 200px;'>
                                      </div>
                                  </div>
                                  <div class="col-12 col-md-6 col-lg-6 d-flex align-items-center justify-content-center mt-3">
                                      <div class="btn btn-primary">
                                          <input type="file" class="file-upload" id="bride"  name="profile_picture" accept="image/*"> Upload Foto
                                      </div>
                                  </div>
                              </div>   
                          </div>
                      </div>
                      <hr>
                      <div class="col mt-2">
                          <label>Nama Lengkap</label>
                          <input id="nama_lengkap_wanita" type="text" class="form-control" placeholder="Contoh : Fatimah Az Zahra" value="<?= $mempelai[0]->nama_wanita ?>" required>
                      </div>

                      <div class="col mt-2">
                          <label>Nama Panggilan</label>
                          <input id="nama_panggilan_wanita" type="text" class="form-control" placeholder="Contoh : Fatimah" value="<?=  $mempelai[0]->nama_panggilan_wanita ?>" required>
                      </div>

                      <div class="col mt-2">
                          <label>Nama Ayah</label>
                          <input id="nama_ayah_wanita" type="text" class="form-control" placeholder="Nama Ayah" value="<?= $mempelai[0]->nama_ayah_wanita ?>" required>
                      </div>

                      <div class="col mt-2">
                          <label>Nama Ibu</label>
                          <input id="nama_ibu_wanita" type="text" class="form-control" placeholder="Nama Ibu" value="<?= $mempelai[0]->nama_ibu_wanita ?>" required>
                      </div>

                      <div class="col mt-3">
                          <button class="btn btn-primary" data-toggle="modal" data-target="#modalWanita">Simpan</button>
                      </div>
                  </div>
              </div>
          </div>

          <div class="col-xl-6 col-lg-6 mb-4">
              <div class="card mb-4">
                  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                      <h6 class="m-0 font-weight-bold text-primary">Data Foto Sampul</h6>
                  </div>
                  <div class="card-body">
                      <!-- CONTENT DISINI -->
                      <div class="upload-area-bg" style="text-align: center;">
                          <div class="col">
                              <div class="row">
                                  <div class="col-12 col-md-6 col-lg-6 d-flex align-items-center justify-content-center">
                                      <div class="upload-area" style="height: 100%;padding: 5px 5px;">
                                      <img src="<?= base_url() ?><?= $fotosampul ?>" id="profile-pic-sampul" style='border-radius: 5px;height: 200px;width: 200px;'>
                                      </div>

                                  </div>
                                  <div class="col-12 col-md-6 col-lg-6 d-flex align-items-center justify-content-center mt-3">
                                      <div class="btn btn-dark">
                                          <input type="file" class="file-upload" id="sampul"  name="profile_picture" accept="image/*"> Upload Foto
                                      </div>
                                  </div>
                              </div>   
                          </div>
                      </div>
                    
                  </div>
              </div>
          </div>

          <div class="col-xl-6 col-lg-6 mb-4">
              <div class="card mb-4">
                  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                      <h6 class="m-0 font-weight-bold text-primary">Salam Pembuka</h6>
                  </div>
                  <div class="card-body">
                      <!-- CONTENT DISINI -->

                        <div class="row align-items-center">
                            <div class="col">
                                <label>Salam Pembuka</label>
                                <textarea id="salamPembukaData" type="text" class="form-control" placeholder="Maximal 500 Karakter" maxlength="500" rows="4" required><?= $data[0]->salam_pembuka ?></textarea>
                            </div>
                        </div>

                      <div class="col mt-3">
                          <button class="btn btn-primary" data-toggle="modal" data-target="#modalSalamPembuka">Simpan</button>
                      </div>
                  </div>
              </div>
          </div>

        </div>
</div>