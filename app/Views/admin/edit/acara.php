<div class="row mb-3">
    <a href="<?= base_url('admin/edit_pengguna/mempelai') ?>" type="button" class="btn btn-outline-primary m-1">Mempelai</a>
    <a href="<?= base_url('admin/edit_pengguna/acara') ?>" type="button" class="btn btn-primary m-1">Acara</a>
    <a href="<?= base_url('admin/edit_pengguna/video') ?>" type="button" class="btn btn-outline-primary m-1">Video</a>
    <a href="<?= base_url('admin/edit_pengguna/cerita') ?>" type="button" class="btn btn-outline-primary m-1">Cerita</a>
    <a href="<?= base_url('admin/edit_pengguna/gallery') ?>" type="button" class="btn btn-outline-primary m-1">Gallery</a>
    <a href="<?= base_url('admin/edit_pengguna/pengaturan') ?>" type="button" class="btn btn-outline-primary m-1">Pengaturan</a>
    <a href="<?= base_url('admin/edit_pengguna/profil') ?>" type="button" class="btn btn-outline-primary m-1">Profil</a>
</div>

<div class="row mb-3">
        <div class="col-xl-6 col-lg-6 mb-4">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Data Akad Nikah</h6>
                </div>
                <div class="card-body">
                    <!-- CONTENT DISINI -->
                    <div class="col mt-2">
                        <label>Tanggal </label>
                        <input type="text" class="form-control" id="datepicker" placeholder="Tanggal" readonly="readonly" style="cursor:pointer; background-color: #FFFFFF" value="Jumat, 17 Januari 2020" required>
                        <input type="hidden" id="tanggal_akad" value="<?= $acara[0]->tanggal_akad ?>">
                    </div>

                    <div class="col mt-2">
                        <label>Waktu / Jam</label>
                        <input id="waktu_akad" type="text" class="form-control" placeholder="Contoh : 10.00 Pagi" value="<?= $acara[0]->jam_akad ?>" required>
                    </div>

                    <div class="col mt-2">
                        <label>Tempat / Lokasi</label>
                        <input id="lokasi_akad" type="text" class="form-control" placeholder="Contoh : Kediaman Mempelai Wanita " value="<?= $acara[0]->tempat_akad ?>" required>
                    </div>

                    <div class="col mt-2">
                        <label>Alamat</label>
                        <textarea id="alamat_akad" type="text" class="form-control" placeholder="Contoh : JL. Ahmad Yani No.1"><?= $acara[0]->alamat_akad ?></textarea>
                    </div>

                    <div class="col mt-3">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAkad">Simpan</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-lg-6 mb-4">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Data Resepsi Nikah</h6>
                </div>
                <div class="card-body">
                    <!-- CONTENT DISINI -->
                    <div class="col mt-2">
                        <label>Tanggal </label>
                        <input type="text" class="form-control" id="datepicker2" placeholder="Tanggal" readonly="readonly" style="cursor:pointer; background-color: #FFFFFF" value="<?= $acara[0]->tanggal_resepsi ?>" required> 
                        <input type="hidden" id="tanggal_resepsi" value="<?= $acara[0]->tanggal_akad ?>">
                    </div>

                    <div class="col mt-2">
                        <label>Waktu / Jam</label>
                        <input id="waktu_resepsi" type="text" class="form-control" placeholder="Contoh : 10.00 Pagi" value="<?= $acara[0]->jam_resepsi ?>" required>
                    </div>

                    <div class="col mt-2">
                        <label>Tempat / Lokasi</label>
                        <input id="lokasi_resepsi" type="text" class="form-control" placeholder="Contoh : Kediaman Mempelai Wanita " value="<?= $acara[0]->tempat_resepsi ?>" required>
                    </div>

                    <div class="col mt-2">
                        <label>Alamat</label>
                        <textarea id="alamat_resepsi" type="text" class="form-control" placeholder="Contoh : JL. Ahmad Yani No.1"><?= $acara[0]->alamat_resepsi ?></textarea>
                    </div>

                    <div class="col mt-3">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#modalResepsi">Simpan</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-lg-6 mb-4">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Data Maps</h6>
                </div>
                <div class="card-body">
                    <label>Google Maps Link</label>
                    <textarea id="maps" type="text" class="form-control" placeholder="Contoh : Kediaman Mempelai Wanita" required><?= $data[0]->maps ?></textarea>
                    <div class="mt-1">
                    <label class="form-check-label ">
                      <a href="<?= SITE_UTAMA ?>/maps" target="_blank"><i class="fa fa-question-circle"></i>&nbsp Cara Menambahkan Maps</a>
                    </label>
                    </div>
                    <div class="col mt-3">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#modalMaps">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
</div>