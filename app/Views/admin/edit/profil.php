<div class="row mb-3">
    <a href="<?= base_url('admin/edit_pengguna/mempelai') ?>" type="button" class="btn btn-outline-primary m-1">Mempelai</a>
    <a href="<?= base_url('admin/edit_pengguna/acara') ?>" type="button" class="btn btn-outline-primary m-1">Acara</a>
    <a href="<?= base_url('admin/edit_pengguna/video') ?>" type="button" class="btn btn-outline-primary m-1">Video</a>
    <a href="<?= base_url('admin/edit_pengguna/cerita') ?>" type="button" class="btn btn-outline-primary m-1">Cerita</a>
    <a href="<?= base_url('admin/edit_pengguna/gallery') ?>" type="button" class="btn btn-outline-primary m-1">Gallery</a>
    <a href="<?= base_url('admin/edit_pengguna/pengaturan') ?>" type="button" class="btn btn-outline-primary m-1">Pengaturan</a>
    <a href="<?= base_url('admin/edit_pengguna/profil') ?>" type="button" class="btn btn-primary m-1">Profil</a>
</div>

<div class="row mb-3">

<div class="col-xl-6 col-lg-6 mb-4">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Profil Pengguna</h6>
                </div>
                <div class="card-body">

                    <div class="form-group">
                        <label>Username</label>
                        <input id="username" type="text" class="form-control" placeholder="Contoh : reydinda" value="<?= $user[0]->username ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input id="password" type="password" class="form-control" placeholder="********" value="" required>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input id="email" type="email" class="form-control" placeholder="Contoh : reydinda" value="<?= $user[0]->email ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Nomor Hp</label>
                        <input id="hp" type="number" class="form-control" placeholder="Contoh : 081234567890" value="<?= $user[0]->hp ?>" required>
                    </div>

                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalUser">Simpan</button>
                </div>
            </div>
        </div>
        
</div>