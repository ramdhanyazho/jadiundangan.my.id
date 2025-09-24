<div class="row mb-3">
    <a href="<?= base_url('admin/edit_pengguna/mempelai') ?>" type="button" class="btn btn-outline-primary m-1">Mempelai</a>
    <a href="<?= base_url('admin/edit_pengguna/acara') ?>" type="button" class="btn btn-outline-primary m-1">Acara</a>
    <a href="<?= base_url('admin/edit_pengguna/video') ?>" type="button" class="btn btn-primary m-1">Video</a>
    <a href="<?= base_url('admin/edit_pengguna/cerita') ?>" type="button" class="btn btn-outline-primary m-1">Cerita</a>
    <a href="<?= base_url('admin/edit_pengguna/gallery') ?>" type="button" class="btn btn-outline-primary m-1">Gallery</a>
    <a href="<?= base_url('admin/edit_pengguna/pengaturan') ?>" type="button" class="btn btn-outline-primary m-1">Pengaturan</a>
    <a href="<?= base_url('admin/edit_pengguna/profil') ?>" type="button" class="btn btn-outline-primary m-1">Profil</a>
</div>

<div class="row mb-3">
<div class="col-xl-6 col-lg-6 mb-4">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Data Video</h6>
                </div>
                <div class="card-body">
                    <label>Youtube Link</label>
                    <textarea id="video" type="text" class="form-control" placeholder="Contoh : https://youtu.be/zlKzyYnhu-s" required><?= $data[0]->video ?></textarea>
                    <div class="mt-1">
                    <label class="form-check-label ">
                      <a href="<?= SITE_UTAMA ?>/youtube"><i class="fa fa-question-circle"></i>Cara Menambahkan Video</a>
                    </label>
                    </div>
                    <div class="col mt-3">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#modalVideo">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
        
</div>