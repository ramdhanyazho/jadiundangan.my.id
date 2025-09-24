<div class="row mb-3">
    <a href="<?= base_url('admin/edit_pengguna/mempelai') ?>" type="button" class="btn btn-outline-primary m-1">Mempelai</a>
    <a href="<?= base_url('admin/edit_pengguna/acara') ?>" type="button" class="btn btn-outline-primary m-1">Acara</a>
    <a href="<?= base_url('admin/edit_pengguna/video') ?>" type="button" class="btn btn-outline-primary m-1">Video</a>
    <a href="<?= base_url('admin/edit_pengguna/cerita') ?>" type="button" class="btn btn-outline-primary m-1">Cerita</a>
    <a href="<?= base_url('admin/edit_pengguna/gallery') ?>" type="button" class="btn btn-outline-primary m-1">Gallery</a>
    <a href="<?= base_url('admin/edit_pengguna/pengaturan') ?>" type="button" class="btn btn-primary m-1">Pengaturan</a>
    <a href="<?= base_url('admin/edit_pengguna/profil') ?>" type="button" class="btn btn-outline-primary m-1">Profil</a>
</div>

<div class="row mb-3">
<div class="col-xl-6 col-lg-6 mb-4">
              <!-- Form Basic -->
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Pengaturan Undangan</h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                    <label>Nama Domain / URL Undangan</label>
                    <label style="bottom: -12.3px;position: inherit;padding-left: 15px;color: #005CAA;font-weight: bold;display: table;margin-bottom: -2.1rem;">u.ngulemind.online/</label>
                    <input id="domain" type="text" class="form-control" placeholder="akudandia" style="padding-left: 9.5rem;" value="<?= $order[0]->domain ?>"  onkeyup="nospaces(this)" required>
                    </div>

                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalDomain">Simpan</button>
                </div>
              </div>
        </div>

        <div class="col-xl-6 col-lg-6 mb-4">
              <!-- Form Basic -->
              <form method="post" enctype="multipart/form-data" action="<?php echo base_url('admin/update_musik'); ?>">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Musik</h6>
                </div>
                <div class="card-body">

                    <label>Musik Latar (max 2MB)</label>
                    <div class="form-group">
                      <div class="custom-file">
                        <input type="file" name="musik" id="musik" accept=".mp3">
                      </div>
                    </div>

                    <button class="btn btn-primary" type="submit">Simpan</button>
                </div>
              </div>
              </form>
        </div>

        <div class="col-xl-6 col-lg-6 mb-4">
         <!-- Form Basic -->
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Fitur Undangan</h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                      <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" disabled checked id="setSampul">
                        <label class="custom-control-label" for="setSampul" >Halaman Sampul</label>
                      </div>
                      <div class="custom-control custom-switch mt-2">
                        <input type="checkbox" class="custom-control-input" disabled checked id="setMempelai">
                        <label class="custom-control-label" for="setMempelai" >Halaman Mempelai</label>
                      </div>
                      <div class="custom-control custom-switch mt-2">
                        <input type="checkbox" class="custom-control-input" disabled checked id="setAcara">
                        <label class="custom-control-label" for="setAcara" >Halaman Acara</label>
                      </div>
                      <div class="custom-control custom-switch mt-2">
                        <input type="checkbox" class="custom-control-input" id="setUcapan" 
                        <?php if($fitur[0]->komen == '1') echo 'checked'; ?>>
                        <label class="custom-control-label" for="setUcapan" >Halaman Ucapan</label>
                      </div>
                      <div class="custom-control custom-switch mt-2">
                        <input type="checkbox" class="custom-control-input" id="setAlbum"
                        <?php if($fitur[0]->gallery == '1') echo 'checked'; ?>>
                        <label class="custom-control-label" for="setAlbum" >Halaman Gallery/Album</label>
                      </div>
                      <div class="custom-control custom-switch mt-2">
                        <input type="checkbox" class="custom-control-input" id="setCerita"
                        <?php if($fitur[0]->cerita == '1') echo 'checked'; ?>>
                        <label class="custom-control-label" for="setCerita">Halaman Cerita</label>
                      </div>
                      <div class="custom-control custom-switch mt-2">
                        <input type="checkbox" class="custom-control-input" id="setLokasi"
                        <?php if($fitur[0]->lokasi == '1') echo 'checked'; ?>>
                        <label class="custom-control-label" for="setLokasi" >Halaman Lokasi</label>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#modalFitur">Simpan</button>
                </div>
            </div>
        </div>
        
</div>