<?php
// update baru
$mempelaiRow = $mempelai->getFirstRow();
$nama_panggilan_pria = $mempelaiRow->nama_panggilan_pria ?? 'Mempelai Pria';
$nama_lengkap_pria = $mempelaiRow->nama_pria ?? $nama_panggilan_pria;
$nama_ayah_pria = $mempelaiRow->nama_ayah_pria ?? '';
$nama_ibu_pria = $mempelaiRow->nama_ibu_pria ?? '';
$nama_panggilan_wanita = $mempelaiRow->nama_panggilan_wanita ?? 'Mempelai Wanita';
$nama_lengkap_wanita = $mempelaiRow->nama_wanita ?? $nama_panggilan_wanita;
$nama_ayah_wanita = $mempelaiRow->nama_ayah_wanita ?? '';
$nama_ibu_wanita = $mempelaiRow->nama_ibu_wanita ?? '';

$ruleSet = $rules->getFirstRow();
$dataRow = $data->getFirstRow();
$eventRow = $acara->getFirstRow();

$rekeningList = [];
if ($rekening && method_exists($rekening, 'getResult')) {
    $rekeningList = $rekening->getResult();
}

$kunci = $dataRow->kunci ?? '';
$youtube = $dataRow->video ?? '';
$salam_pembuka = $dataRow->salam_pembuka ?? '';
$salam_penutup = $dataRow->salam_wa_bawah ?? '';
$maps = $dataRow->maps ?? '';
$musiknya = $kunci !== '' ? '/assets/users/' . $kunci . '/musik.mp3' : '';

$tanggal_akad = $eventRow->tanggal_akad ?? '';
$tanggal_resepsi = $eventRow->tanggal_resepsi ?? '';
$jam_akad = $eventRow->jam_akad ?? '';
$jam_resepsi = $eventRow->jam_resepsi ?? '';
$tempat_akad = $eventRow->tempat_akad ?? '';
$alamat_akad = $eventRow->alamat_akad ?? '';
$tempat_resepsi = $eventRow->tempat_resepsi ?? '';
$alamat_resepsi = $eventRow->alamat_resepsi ?? '';
$countdown = '';
if (!empty($tanggal_resepsi)) {
    $countdown = trim($tanggal_resepsi . ' ' . $jam_resepsi);
}

$shortDate = '';
if (!empty($tanggal_resepsi)) {
    $timestamp = strtotime($tanggal_resepsi);
    if ($timestamp !== false) {
        $shortDate = date('d.m.y', $timestamp);
    } else {
        $shortDate = $tanggal_resepsi;
    }
}

$rawInvite = is_string($invite) ? trim($invite) : '';
$inviteeName = $rawInvite !== '' ? esc(ucwords($rawInvite)) : 'Tamu Undangan';
$rawInviteAddress = is_string($alamat_tamu) ? trim($alamat_tamu) : '';
$inviteAddress = $rawInviteAddress !== '' ? esc(ucwords($rawInviteAddress)) : '';

function novianty_escape_multiline(?string $text): string
{
    if ($text === null) {
        return '';
    }
    return nl2br(esc($text));
}
?>
<!DOCTYPE html>
<html Content-Language="ID" lang="id" xml:lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="theme-color" content="#b07d80" />
    <meta property="og:title" content="<?php echo esc($nama_panggilan_pria . ' & ' . $nama_panggilan_wanita); ?>">
    <meta property="og:description" content="<?php echo 'Hello ' . esc($invite) . '! Kamu Di Undang..'; ?>">
    <meta property="og:url" content="<?php echo base_url() ?>">
    <meta property="og:image:width" content="300">
    <meta property="og:image:height" content="300">
    <meta property="og:type" content="website" />
    <title><?php echo esc($nama_panggilan_pria . ' & ' . $nama_panggilan_wanita); ?></title>
    <?php if ($kunci !== '') : ?>
        <link rel="icon" href="<?= base_url() ?>/assets/users/<?= esc($kunci); ?>/kita.png">
    <?php endif; ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&family=Playfair+Display:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simplelightbox/2.14.1/simple-lightbox.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/themes/novianty/css/style.css?v=1.2.0">
</head>

<body class="novianty-body">
    <div id="novianty-welcome" class="nov-welcome-screen">
        <div class="nov-welcome-inner">
            <?php if ($ruleSet && (int) $ruleSet->prokes === 1) : ?>
                <img class="img-fluid" src="<?php echo base_url() ?>/assets/base/img/prokes.png" alt="Protokol Kesehatan" style="max-width: 160px;">
            <?php endif; ?>
            <p>Selamat datang di undangan pernikahan kami.<br>Gunakan browser Chrome atau Safari agar website tampil sempurna.</p>
            <button class="nov-btn" data-nov-open>Buka Undangan</button>
        </div>
    </div>

    <main id="novianty-main">
        <section class="nov-section nov-section--cover" id="home">
            <div class="nov-card nov-card--photo" style="--nov-photo: url('<?= base_url() ?>/assets/users/<?= esc($kunci); ?>/kita.png');">
                <div class="nov-card-content">
                    <div class="nov-brand">
                        <span class="nov-brand-names"><span><?= esc($nama_panggilan_wanita); ?></span> <span class="nov-brand-heart">&#10084;</span> <span><?= esc($nama_panggilan_pria); ?></span></span>
                        <span class="nov-brand-date js-date-short"><?= esc($shortDate); ?></span>
                    </div>
                    <div class="nov-cover-copy">
                        <p class="nov-cover-greeting">Dengan hormat</p>
                        <h1 class="nov-cover-names"><?= esc($nama_panggilan_wanita); ?> <span>&amp;</span> <?= esc($nama_panggilan_pria); ?></h1>
                        <p class="nov-cover-date" id="tanggal-weddingnya"><?= esc($tanggal_resepsi); ?></p>
                        <div class="nov-cover-invite">
                            <span>Kepada Yth.</span>
                            <h2><?= $inviteeName; ?></h2>
                            <?php if ($inviteAddress !== '') : ?>
                                <p><?= $inviteAddress; ?></p>
                            <?php endif; ?>
                        </div>
                        <?php if ($salam_pembuka !== '') : ?>
                            <p class="nov-cover-message"><?= novianty_escape_multiline($salam_pembuka); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>

        <section class="nov-section nov-section--person">
            <div class="nov-card nov-card--photo" style="--nov-photo: url('<?= base_url() ?>/assets/users/<?= esc($kunci); ?>/bride.png');">
                <div class="nov-card-content">
                    <div class="nov-brand">
                        <span class="nov-brand-names"><span><?= esc($nama_panggilan_wanita); ?></span> <span class="nov-brand-heart">&#10084;</span> <span><?= esc($nama_panggilan_pria); ?></span></span>
                        <span class="nov-brand-date js-date-short"><?= esc($shortDate); ?></span>
                    </div>
                    <div class="nov-person">
                        <h2><?= esc($nama_lengkap_wanita); ?></h2>
                        <p>Putri dari Bpk. <?= esc($nama_ayah_wanita); ?><br>dan Ibu <?= esc($nama_ibu_wanita); ?></p>
                        <?php if (isset($mempelaiRow->instagram_wanita) && $mempelaiRow->instagram_wanita !== '') : ?>
                            <a class="nov-btn nov-btn--ghost" href="https://instagram.com/<?= esc($mempelaiRow->instagram_wanita); ?>" target="_blank" rel="noopener">@<?= esc($mempelaiRow->instagram_wanita); ?></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>

        <section class="nov-section nov-section--person">
            <div class="nov-card nov-card--photo" style="--nov-photo: url('<?= base_url() ?>/assets/users/<?= esc($kunci); ?>/groom.png');">
                <div class="nov-card-content">
                    <div class="nov-brand">
                        <span class="nov-brand-names"><span><?= esc($nama_panggilan_wanita); ?></span> <span class="nov-brand-heart">&#10084;</span> <span><?= esc($nama_panggilan_pria); ?></span></span>
                        <span class="nov-brand-date js-date-short"><?= esc($shortDate); ?></span>
                    </div>
                    <div class="nov-person">
                        <h2><?= esc($nama_lengkap_pria); ?></h2>
                        <p>Putra dari Bpk. <?= esc($nama_ayah_pria); ?><br>dan Ibu <?= esc($nama_ibu_pria); ?></p>
                        <?php if (isset($mempelaiRow->instagram_pria) && $mempelaiRow->instagram_pria !== '') : ?>
                            <a class="nov-btn nov-btn--ghost" href="https://instagram.com/<?= esc($mempelaiRow->instagram_pria); ?>" target="_blank" rel="noopener">@<?= esc($mempelaiRow->instagram_pria); ?></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>

        <?php if ($ruleSet && (int) $ruleSet->acara === 1) : ?>
            <section class="nov-section">
                <div class="nov-card nov-card--plain">
                    <div class="nov-card-content">
                        <div class="nov-brand">
                            <span class="nov-brand-names"><span><?= esc($nama_panggilan_wanita); ?></span> <span class="nov-brand-heart">&#10084;</span> <span><?= esc($nama_panggilan_pria); ?></span></span>
                            <span class="nov-brand-date js-date-short"><?= esc($shortDate); ?></span>
                        </div>
                        <div class="nov-events">
                            <h2>Akad Nikah</h2>
                            <p class="nov-event-date" id="tanggal-akad"><?= esc($tanggal_akad); ?></p>
                            <?php if ($jam_akad !== '') : ?>
                                <p class="nov-event-time">Pukul <?= esc($jam_akad); ?></p>
                            <?php endif; ?>
                            <?php if ($tempat_akad !== '') : ?>
                                <p class="nov-event-place"><?= esc($tempat_akad); ?></p>
                            <?php endif; ?>
                            <?php if ($alamat_akad !== '') : ?>
                                <p class="nov-event-address"><?= esc($alamat_akad); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="nov-events">
                            <h2>Resepsi</h2>
                            <p class="nov-event-date" id="tanggal-resepsi"><?= esc($tanggal_resepsi); ?></p>
                            <?php if ($jam_resepsi !== '') : ?>
                                <p class="nov-event-time">Pukul <?= esc($jam_resepsi); ?></p>
                            <?php endif; ?>
                            <?php if ($tempat_resepsi !== '') : ?>
                                <p class="nov-event-place"><?= esc($tempat_resepsi); ?></p>
                            <?php endif; ?>
                            <?php if ($alamat_resepsi !== '') : ?>
                                <p class="nov-event-address"><?= esc($alamat_resepsi); ?></p>
                            <?php endif; ?>
                            <?php if (!empty($maps)) : ?>
                                <button class="nov-btn nov-btn--ghost" type="button" data-bs-toggle="modal" data-bs-target="#novMapsModal">Gunakan Google Maps</button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <?php if ($ruleSet && (int) $ruleSet->lokasi === 1 && !empty($maps)) : ?>
            <section class="nov-section">
                <div class="nov-card nov-card--plain">
                    <div class="nov-card-content">
                        <div class="nov-brand">
                            <span class="nov-brand-names"><span><?= esc($nama_panggilan_wanita); ?></span> <span class="nov-brand-heart">&#10084;</span> <span><?= esc($nama_panggilan_pria); ?></span></span>
                            <span class="nov-brand-date js-date-short"><?= esc($shortDate); ?></span>
                        </div>
                        <h2><?= $tempat_resepsi !== '' ? esc($tempat_resepsi) : 'Lokasi Acara'; ?></h2>
                        <div class="nov-map-embed">
                            <div class="gmap_canvas"><?= $maps; ?></div>
                        </div>
                        <p class="nov-map-note">Demi kenyamanan perjalanan, mohon aktifkan akses lokasi dan gunakan panduan dari Google Maps.</p>
                        <button class="nov-btn" type="button" data-bs-toggle="modal" data-bs-target="#novMapsModal">Buka Google Maps</button>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <section class="nov-section">
            <div class="nov-card nov-card--plain">
                <div class="nov-card-content">
                    <div class="nov-brand">
                        <span class="nov-brand-names"><span><?= esc($nama_panggilan_wanita); ?></span> <span class="nov-brand-heart">&#10084;</span> <span><?= esc($nama_panggilan_pria); ?></span></span>
                        <span class="nov-brand-date js-date-short"><?= esc($shortDate); ?></span>
                    </div>
                    <h2>Menuju Hari Spesial Kami</h2>
                    <div class="nov-countdown" role="timer">
                        <div class="nov-countdown-box">
                            <div class="nov-countdown-number" id="countdown-days">00</div>
                            <div class="nov-countdown-label">Hari</div>
                        </div>
                        <div class="nov-countdown-box">
                            <div class="nov-countdown-number" id="countdown-hours">00</div>
                            <div class="nov-countdown-label">Jam</div>
                        </div>
                        <div class="nov-countdown-box">
                            <div class="nov-countdown-number" id="countdown-minutes">00</div>
                            <div class="nov-countdown-label">Menit</div>
                        </div>
                        <div class="nov-countdown-box">
                            <div class="nov-countdown-number" id="countdown-seconds">00</div>
                            <div class="nov-countdown-label">Detik</div>
                        </div>
                    </div>
                    <div id="nov-countdown-expired" class="nov-countdown-expired"></div>
                    <a class="nov-btn" href="#nov-guestbook">Konfirmasi &amp; Kirim Ucapan</a>
                </div>
            </div>
        </section>

        <?php if ($ruleSet && (int) $ruleSet->hadiah === 1 && !empty($rekeningList)) : ?>
            <section class="nov-section">
                <div class="nov-card nov-card--plain">
                    <div class="nov-card-content">
                        <div class="nov-brand">
                            <span class="nov-brand-names"><span><?= esc($nama_panggilan_wanita); ?></span> <span class="nov-brand-heart">&#10084;</span> <span><?= esc($nama_panggilan_pria); ?></span></span>
                            <span class="nov-brand-date js-date-short"><?= esc($shortDate); ?></span>
                        </div>
                        <h2>Terima Kasih</h2>
                        <p>Kehadiran dan doa terbaik Anda merupakan hadiah terindah. Jika ingin berbagi tanda kasih, silakan gunakan rekening berikut:</p>
                        <div class="nov-gift-list">
                            <?php foreach ($rekeningList as $row) : ?>
                                <div class="nov-gift-card">
                                    <div class="nov-gift-bank"><?= esc($row->nama_bank); ?></div>
                                    <div class="nov-gift-number"><?= esc($row->no_rekening); ?></div>
                                    <div class="nov-gift-owner">a.n <?= esc($row->nama_pemilik); ?></div>
                                    <button type="button" class="nov-btn nov-btn--ghost nov-copy" data-account="<?= esc($row->no_rekening); ?>">Salin Rekening</button>
                                    <?php if (!empty($row->qrcode_bank)) : ?>
                                        <img class="nov-gift-qris" src="<?= base_url() ?>/assets/users/<?= esc($kunci); ?>/rekening/<?= esc($row->qrcode_bank); ?>" alt="QR Pembayaran">
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <?php if ($alamat_resepsi !== '') : ?>
                            <div class="nov-gift-address">
                                <h3>Kirim Kado</h3>
                                <p>Anda dapat mengirim kado ke alamat berikut:</p>
                                <p class="nov-gift-address-text"><?= esc($alamat_resepsi); ?></p>
                                <button type="button" class="nov-btn nov-btn--ghost nov-copy" data-account="<?= esc($alamat_resepsi); ?>">Salin Alamat</button>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <?php if ($ruleSet && (int) $ruleSet->gallery === 1 && !empty($album)) : ?>
            <section class="nov-section nov-section--auto">
                <div class="nov-card nov-card--plain">
                    <div class="nov-card-content">
                        <div class="nov-brand">
                            <span class="nov-brand-names"><span><?= esc($nama_panggilan_wanita); ?></span> <span class="nov-brand-heart">&#10084;</span> <span><?= esc($nama_panggilan_pria); ?></span></span>
                            <span class="nov-brand-date js-date-short"><?= esc($shortDate); ?></span>
                        </div>
                        <h2>Galeri Kenangan</h2>
                        <div class="nov-gallery-grid nov-gallery">
                            <?php foreach ($album as $dataAlbum) : ?>
                                <a href="<?= base_url() ?>/assets/users/<?= esc($kunci); ?>/<?= esc($dataAlbum['album']); ?>.png" class="nov-gallery-item">
                                    <img src="<?= base_url() ?>/assets/users/<?= esc($kunci); ?>/<?= esc($dataAlbum['album']); ?>.png" alt="Galeri" loading="lazy">
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <?php if ($ruleSet && (int) $ruleSet->cerita === 1 && !empty($cerita)) : ?>
            <section class="nov-section nov-section--auto">
                <div class="nov-card nov-card--plain">
                    <div class="nov-card-content">
                        <div class="nov-brand">
                            <span class="nov-brand-names"><span><?= esc($nama_panggilan_wanita); ?></span> <span class="nov-brand-heart">&#10084;</span> <span><?= esc($nama_panggilan_pria); ?></span></span>
                            <span class="nov-brand-date js-date-short"><?= esc($shortDate); ?></span>
                        </div>
                        <h2>Kisah Kami</h2>
                        <div class="nov-story-list">
                            <?php foreach ($cerita as $story) : ?>
                                <div class="nov-story-item">
                                    <div class="nov-story-date"><?= esc($story['tanggal_cerita']); ?></div>
                                    <h3><?= esc($story['judul_cerita']); ?></h3>
                                    <p><?= esc($story['isi_cerita']); ?></p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <?php if (!empty($youtube)) : ?>
            <section class="nov-section nov-section--auto">
                <div class="nov-card nov-card--plain">
                    <div class="nov-card-content">
                        <div class="nov-brand">
                            <span class="nov-brand-names"><span><?= esc($nama_panggilan_wanita); ?></span> <span class="nov-brand-heart">&#10084;</span> <span><?= esc($nama_panggilan_pria); ?></span></span>
                            <span class="nov-brand-date js-date-short"><?= esc($shortDate); ?></span>
                        </div>
                        <h2>Cuplikan Cerita</h2>
                        <div class="nov-video-wrapper ratio ratio-16x9">
                            <?php
                            if ($youtube !== '') {
                                $embed = str_replace('youtu.be', 'www.youtube.com/embed', $youtube);
                                ?>
                                <iframe src="<?= esc($embed); ?>" allowfullscreen></iframe>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <?php if ($ruleSet && (int) $ruleSet->komen === 1) : ?>
            <section class="nov-section nov-section--auto" id="nov-guestbook">
                <div class="nov-card nov-card--plain">
                    <div class="nov-card-content">
                        <div class="nov-brand">
                            <span class="nov-brand-names"><span><?= esc($nama_panggilan_wanita); ?></span> <span class="nov-brand-heart">&#10084;</span> <span><?= esc($nama_panggilan_pria); ?></span></span>
                            <span class="nov-brand-date js-date-short"><?= esc($shortDate); ?></span>
                        </div>
                        <h2>Kirim Ucapan</h2>
                        <form id="guestbook" class="nov-guestbook" action="javascript:void(0);">
                            <div class="nov-form-group">
                                <label for="nama">Nama</label>
                                <input type="text" id="nama" name="nama" value="<?= esc($invite); ?>" readonly autocomplete="off">
                            </div>
                            <div class="nov-form-group">
                                <label for="komentar">Pesan/Doa</label>
                                <textarea id="komentar" name="komentar" rows="3" required></textarea>
                            </div>
                            <button type="submit" id="submitKomen" class="nov-btn">Kirim Doa</button>
                        </form>
                        <div class="nov-comments layout-komen">
                            <?php foreach ($komen as $dataKomen) : ?>
                                <div class="nov-comment-card">
                                    <div class="nov-comment-avatar">
                                        <img src="https://na.ui-avatars.com/api/?name=<?= str_replace(' ', '-', esc($dataKomen['nama_komentar'])); ?>&size=50" alt="Avatar" loading="lazy">
                                    </div>
                                    <div class="nov-comment-body">
                                        <h3><?= esc($dataKomen['nama_komentar']); ?></h3>
                                        <p><?= esc($dataKomen['isi_komentar']); ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <section class="nov-section nov-section--closing">
            <div class="nov-card nov-card--photo" style="--nov-photo: url('<?= base_url() ?>/assets/users/<?= esc($kunci); ?>/kita.png');">
                <div class="nov-card-content">
                    <div class="nov-brand">
                        <span class="nov-brand-names"><span><?= esc($nama_panggilan_wanita); ?></span> <span class="nov-brand-heart">&#10084;</span> <span><?= esc($nama_panggilan_pria); ?></span></span>
                        <span class="nov-brand-date js-date-short"><?= esc($shortDate); ?></span>
                    </div>
                    <div class="nov-closing">
                        <p><?= novianty_escape_multiline($salam_penutup); ?></p>
                        <div class="nov-closing-sign">
                            <span><?= esc($nama_panggilan_wanita); ?> &amp; <?= esc($nama_panggilan_pria); ?></span>
                            <?php if ($shortDate !== '') : ?>
                                <small><?= esc($shortDate); ?></small>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php if ($musiknya !== '') : ?>
        <audio id="novianty-music" loop src="<?php echo base_url() ?><?= esc($musiknya); ?>"></audio>
    <?php endif; ?>

    <div class="nov-floating-controls">
        <button id="novianty-music-control" class="nov-float-btn" type="button" aria-label="Putar Musik">
            <span class="nov-float-icon">&#9835;</span>
        </button>
        <?php if ($ruleSet && (int) $ruleSet->hadiah === 1 && !empty($rekeningList)) : ?>
            <button class="nov-float-btn" type="button" data-bs-toggle="modal" data-bs-target="#novGiftModal" aria-label="Kirim Hadiah">
                <span class="nov-float-icon">&#127873;</span>
            </button>
        <?php endif; ?>
        <?php if ($ruleSet && (int) $ruleSet->qrcode === 1) : ?>
            <button class="nov-float-btn" type="button" data-bs-toggle="modal" data-bs-target="#novQrModal" aria-label="Lihat QR Code">
                <span class="nov-float-icon">&#128273;</span>
            </button>
        <?php endif; ?>
    </div>

    <div class="modal fade" id="novGiftModal" tabindex="-1" aria-labelledby="novGiftLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="novGiftLabel">Kirim Hadiah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-center">Berikan tanda kasih untuk <?= esc($nama_panggilan_pria . ' & ' . $nama_panggilan_wanita); ?>.</p>
                    <div class="nov-gift-modal-list">
                        <?php foreach ($rekeningList as $row) : ?>
                            <div class="nov-gift-card">
                                <div class="nov-gift-bank"><?= esc($row->nama_bank); ?></div>
                                <div class="nov-gift-number"><?= esc($row->no_rekening); ?></div>
                                <div class="nov-gift-owner">a.n <?= esc($row->nama_pemilik); ?></div>
                                <button type="button" class="nov-btn nov-btn--ghost nov-copy" data-account="<?= esc($row->no_rekening); ?>">Salin Rekening</button>
                                <?php if (!empty($row->qrcode_bank)) : ?>
                                    <img class="nov-gift-qris" src="<?= base_url() ?>/assets/users/<?= esc($kunci); ?>/rekening/<?= esc($row->qrcode_bank); ?>" alt="QR Pembayaran">
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="novQrModal" tabindex="-1" aria-labelledby="novQrLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="novQrLabel">QR Code Tamu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <div id="qrcode"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="novMapsModal" tabindex="-1" aria-labelledby="novMapsLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="novMapsLabel">Lokasi Acara</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="ratio ratio-4x3">
                        <div class="gmap_canvas"><?= $maps; ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/simplelightbox/2.14.1/simple-lightbox.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/locale/id.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/themes/novianty/js/jquery.classyqr.js"></script>
    <script>
        window.noviantyConfig = {
            baseUrl: '<?php echo base_url() ?>',
            tanggalAkad: '<?= esc($tanggal_akad); ?>',
            tanggalResepsi: '<?= esc($tanggal_resepsi); ?>',
            tanggalPernikahan: '<?= esc($tanggal_resepsi); ?>',
            countdown: '<?= esc($countdown); ?>',
            qrcode: <?= json_encode($qrcode); ?>
        };
    </script>
    <script src="<?php echo base_url() ?>/assets/themes/novianty/js/theme.js?v=1.2.0"></script>
</body>

</html>