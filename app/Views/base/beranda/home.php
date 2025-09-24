<!DOCTYPE html>
<html Content-Language="ID" lang="id" xml:lang="id">
<head>
  <title><?= SITE_NAME ?> - Undangan Pernikahan Digital Premium</title>
  <link rel="icon" href="<?php echo base_url() ?>/assets/base/img/favicon.png?<?= date("Y-m-d"); ?>">

  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Undangan digital berupa website untuk pernikahanmu. Lebih praktis, keren dan kekinian.">
  <meta name="keywords" content="Undangan digital, Website pernikahan, Undangan kekinian, Web undangan kren">
  <meta name="theme-color" content="#005CAA" />
  <meta name="author" content="MC Project">

  <!-- Favicons -->
  <link rel="shortcut icon" href="<?php echo base_url() ?>/assets/base/img/favicon.png">
  <link rel="apple-touch-icon" href="<?php echo base_url() ?>/assets/base/img/favicon.png">
  <link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url() ?>/assets/base/img/favicon.png">
  <link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url() ?>/assets/base/img/favicon.png">

  <link rel="stylesheet" href="<?php echo base_url() ?>/assets/beranda/themes/assets/css/sw-main.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>/assets/beranda/themes/assets/css/sw-responsive.css">

</head>
<body>

<header class="header">
  <nav class="navbar-me navbar navbar-default" id="mainNav">
    <div class="container">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-ex1-collapse">
        <span class="sr-only">Toggle Navigation
        </span>
        <i class="fa fa-bars">
        </i>
      </button>
      <a class="navbar-brand pull-left" href="<?php echo base_url() ?>" title="Undangan Pernikahan Digital">
        <img class="img-responsive" src="<?php echo base_url() ?>/assets/base/img/logo4.png" alt="Undangan Pernikahan Digital">
      </a>          
      <div class="collapse navbar-collapse navbar-ex1-collapse nav-right">
        <ul class="nav navbar-nav main-navbar-nav">
            <li>
              <a href="<?= base_url('#beranda') ?>">Beranda
              </a>
            </li>
            <li>
              <a class="nav-link js-scroll-trigger" href="<?= base_url('#fitur') ?>">Fitur Unggulan
              </a>
            </li>
            <li>
              <a class="nav-link js-scroll-trigger" href="<?= base_url('#themes') ?>">Web Undangan
              </a>
            </li>
            <li>
              <a class="nav-link js-scroll-trigger" href="<?= base_url('#themes_video') ?>">Video Undangan
              </a>
            </li>
            <li>
              <a class="btn sw-button btn-publish btn-login" href="<?= base_url('login') ?>">
                <i class="fa fa-user">
                </i> Login Akun
              </a>
            </li>
          </li>
      </div> 
      <!-- /.navbar-collapse -->                
    </div>
  </nav>
</header>

<section class="slider-1">
  <div id="carousel-id-slider" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carousel-id" class="active" data-slide-to="0" class="">
      </li>
      <li data-target="#carousel-id" data-slide-to="1" class="">
      </li>
    </ol>
    <div class="carousel-inner">
      <div class="item active">
        <img src="<?php echo base_url() ?>/assets/beranda/themes/slider/sw-kalaujodoh-slider-1.jpg" alt="Undangan Pernikahan Digital">
        <div class="container">
          <div class="content-slider">
            <div class="row">
              <div class="col-xs-8 col-sm-8 col-md-6 col-lg-6">
                <a href="<?= base_url('#themes') ?>" class="btn sw-button btn-slider">Web Undangan
                </a>
                <br>
                <a href="<?= base_url('#themes_video') ?>" class="btn sw-button btn-slider">Video Undangan
                </a>
                <br><br><br><br><br>
                <a href="<?= base_url('order') ?>" class="btn sw-button btn-slider">Trial 7 Hari
                </a>
                <br>
                <a href="<?= base_url('login') ?>" class="btn sw-button btn-slider">Login Akun
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="item">
        <img src="<?php echo base_url() ?>/assets/beranda/themes/slider/sw-kalaujodoh-slider-2.jpg" alt="Undangan Pernikahan Digital">
        <div class="container">
          <div class="content-slider">
            <div class="row">
              <div class="col-xs-8 col-sm-8 col-md-6 col-lg-6">
                <h1><?= SITE_NAME ?>
                </h1>
                <h2>Undangan Pernikahan Digital Premium
                </h2>
                <p>Buat dan bagikan undanganmu dengan berbagai pilihan tema premium.
                </p>
                <p>Lebih hemat, praktis, dan kekinian untuk memberikan kesan terbaik.
                </p>
                <a href="<?= base_url() ?>/order" class="btn sw-button btn-slider">Buat Undangan
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <a class="left carousel-control" href="#carousel-id-slider" data-slide="prev">
      <span class="icon-prev">
      </span>
    </a>
    <a class="right carousel-control" href="#carousel-id-slider" data-slide="next">
      <span class="icon-next">
      </span>
    </a>
  </div>
</section>

<!-- SERVICE -->
<section class="sw-container sw-img-1 sw-bg-3 intro">
  <div class="container">
    <div class="row">
      <div class="area-title text-center">
        <h2>Solusi <span>Praktis</span> di <span>Momen Spesialmu</span>
        </h2>
        <div class="title_border">
        </div>
        <p>Apa saja keuntungan menggunakan undangan pernikahan digital berbasis web?
        </p>
      </div>
      <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
        <div class="services-box-2">
          <div class="icon">
            <img src="<?php echo base_url() ?>/assets/beranda/themes/img/dollar.png" class="img-responsive">
          </div>
          <div class="services-title">
            <h4>Mudah, Cepat & Murah
            </h4>
          </div>
          <p>Kamu bisa buat undangan online dengan mudah dengan harga termurah dan sistem penyebaran yang mudah ke semua kontak WhatsApp.
          </p>
        </div>
      </div>
      <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
        <div class="services-box-2">
          <div class="icon">
            <img src="<?php echo base_url() ?>/assets/beranda/themes/img/domain.png" class="img-responsive">
          </div>
          <div class="services-title">
            <h4>URL Sesuai Keinginan
            </h4>
          </div>
          <p>Sangat mudah untuk membuat URL unik untuk undanganmu, kamu bisa menggunakan gabungan namamu dan pasangan, sepenuhnya dapat diatur sesuai keinginanmu.
          </p>
        </div>
      </div>
      <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
        <div class="services-box-2">
          <div class="icon">
            <img src="<?php echo base_url() ?>/assets/beranda/themes/img/social-media.png" class="img-responsive">
          </div>
          <div class="services-title">
            <h4>Sebar dengan Sekali Klik
            </h4>
          </div>
          <p>Kamu dapat membagikan tautan undangan secara massal ke daftar kontak WA yang dipilih, juga tersedia fitur import data kontak via excel.
          </p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- FEATURE -->
<section class="sw-container" id="fitur">
  <div class="container">
    <div class="row ">
      <div class="area-title text-center">
        <h2>Fitur 
          <span>Premium
          </span>
        </h2>
        <div class="title_border">
        </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
        <div class="services-box">
          <div class="services-title">
            <i class="flaticon-web-design">
            </i>
            <h4>Tema Yang Menarik & Ekslusif
            </h4>
          </div>
          <p>Kamu dapat memilih template undangan sesuka hati, tersedia berbagai pilihan tema yang unik dan menarik yang kami sediakan.
          </p>             
        </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
        <div class="services-box">
          <div class="services-title">
            <i class="flaticon-book">
            </i>
            <h4>Story di Undangan
            </h4>
          </div>
          <p>Kamu bisa membuat story di undangan, bagaimana ceritamu dan pasangan bertemu hingga melanjutkan ke jenjang pernikahan.
          </p>             
        </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
        <div class="services-box">
          <div class="services-title">
            <i class="flaticon-rings">
            </i>
            <h4>Waktu Akad dan Resepsi
            </h4>
          </div>
          <p>Kamu dapat memberikan Informasi yang pastinya penting dalam pesta pernikahan, yaitu waktu dan lokasi resepsi dengan Google Maps.
          </p>             
        </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
        <div class="services-box">
          <div class="services-title">
            <i class="flaticon-clothes">
            </i>
            <h4>Informasi Kedua Pasangan
            </h4>
          </div>
          <p>Kamu dapat menginformasikan tentang dirimu dan pasangan secara rinci, dan juga tersedia fitur berbagi foto untuk semua template undangan.
          </p>             
        </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
        <div class="services-box">
          <div class="services-title">
            <i class="flaticon-camera">
            </i>
            <h4>Gallery Pra Wedding
            </h4>
          </div>
          <p>Dengan fitur gallery, pra wedding kamu bisa diupload di halaman undangan, foto-fotomu dan pasangan ditampilkan di website undangan.
          </p>             
        </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
        <div class="services-box">
          <div class="services-title">
            <i class="flaticon-notebook">
            </i>
            <h4>Buku Tamu
            </h4>
          </div>
          <p>Fitur ini digunakan sebagai pengganti buku tamu, untuk mencatat kehadiran dengan Scan QR Code saat para tamu menghadiri pesta.
          </p>             
        </div>
      </div>
    </div>
  </div>
</section> 

<!-- ======= harga Section ======= -->
<section id="harga" class="harga">

  <div class="container" data-aos="fade-up">

    <div class="area-title text-center">
      <h2><span>Undangan Digital</span> Termurah
      </h2>
      <div class="title_border">
      </div>
    </div>

    <div class="row">
      <div class="col-lg-12 col-md-12">
        <div class="service-box blue">
          <i class="fa fa-money icon"></i>
          <h3>Rp. <?= number_format($setting[0]->harga); ?></h3>
          <p>Aktif <?= $setting[0]->aktif; ?> Hari</p>
          <a href="<?= base_url() ?>/order" class="read-more"><span>Order</span> <i
            class="fa fa-arrow-right"></i></a>
          </div>
        </div>


      </div>

    </div>

  </section><!-- End harga Section -->

  <!-- THEME -->
  <section class="sw-container" id="themes">
    <div class="container">
      <div class="row text-center">
        <div class="area-title text-center">
          <h2>Pilihan Tema Undangan
          </h2>
          <div class="title_border"></div>
          <p>Penasaran bagaimana tampilannya? Pilih salah satu untuk melihat demo, <?= SITE_NAME ?>  memiliki berbagai pilihan tema undangan digital yang menarik dengan desain premium.
          </p>
        </div>
        <?php
        $no = 1;
        foreach ($tema->getResult() as $row) { ?>
          <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
            <div class="sw-theme">
              <figure>
                <img src="<?= base_url() ?>/assets/themes/<?= $row->nama_theme ?>/preview.png" alt="<?= htmlentities($row->nama_theme) ?>" />
              </figure>
              <div class="desc">
                <h3><?= htmlentities($row->nama_theme) ?></h3>
                <div class="readmore">
                  <a href="<?= base_url('demo/'.$row->nama_theme) ?>" target="_blank" class="btn sw-button btn-preview">Demo
                  </a>
                  <a href="<?= base_url('order/'.$row->kode_theme) ?>" class="btn sw-button btn-shop">Buat
                  </a>
                </div>
              </div>
            </div>  
          </div>
          <?php 
          if ($no++ == 6) break;
        }  ?>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
          <h3>Berbagai Template Premium  
            <?= SITE_NAME ?>
          </h3>
          <a href="<?= base_url() ?>/tema" class="btn sw-button btn-register-lg">Selengkapnya
          </a>
        </div>
      </div>
    </div>
  </section>
  <section class="sw-container" id="themes_video">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
         <div class="area-title text-center">
          <h2>Undangan <span>Video</span></h2>
          <div class="title_border"></div>
        </div>
        <div class="owl-carousel slider-undangan owl-theme">
          <?php
          $i = 1;
          foreach ($tema_video->getResult() as $row) { ?>
            <article class="sw-theme">
              <figure><img src="<?php echo base_url() ?>/assets/themes_video/<?= $row->preview ?>" alt="<?= $row->nama_tema ?>" class="img-responsive"/>
              </figure>
              <div class="desc">
                <h3><?= $row->nama_tema ?></h3>
                <span class="price"><ins><span class="amount">Rp. <?= number_format($row->harga) ?></span></ins>  
              </span>
              <div class="readmore text-center">
                <a class="btn sw-button btn-shop-2 btn-preview btn-details btn-demo" data-link="<?= htmlentities($row->url_video); ?>" data-nama="<?= $row->nama_tema; ?>" title="Demo Video"><i class="fa fa-eye"></i></a>
                <a class="btn sw-button btn-shop-2 btn-shop btn-details" target="_blank" href="https://api.whatsapp.com/send?phone=<?= $setting[0]->no_wa; ?>&text=Assalamualaikum, Kak saya mau pesan Video Undangan <?= $row->nama_tema ?>%0ABagaimana cara pesannya kak?" title="Pesan Sekarang"><i class="fa fa-shopping-basket"></i></a>
              </div>
            </div>
          </article>
          <?php if ($i++ == 8) break; } ?>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
          <a href="<?= base_url() ?>/tema_video" class="btn sw-button btn-register-lg">Selengkapnya</a>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="sw-container sw-bg-3 howto">
  <div class="container">
    <div class="row">
      <div class="area-title text-center">
        <h2>Bagaimana <span>Cara</span> Mendaftar?</h2>
        <div class="title_border"></div>
      </div>

      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
        <div class="setps-content">
          <li class="setps-content-inner step1">
            <div class="step-content-number">
              <span>1</span>
            </div>
            <div class="step-content-text">
              <h3>Pilih Tema</h3>
              <p>Kamu bebas memilih tema yang sesuai dengan tema pernikahanmu</p>
            </div>
          </li>
          <li class="setps-content-inner step1">
            <div class="step-content-number">
              <span>2</span>
            </div>
            <div class="step-content-text">
              <h3>Mendaftar</h3>
              <p>Mendaftar dengan Email, Isi data Pernikahanmu, dan login ke halaman dashboard untuk mengedit undangan</p>
            </div>
          </li>
        </div>
      </div>

      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
        <div class="setps-content">

          <li class="setps-content-inner step1">
            <div class="step-content-number">
              <span>3</span>
            </div>
            <div class="step-content-text">
              <h3>Aktivasi Undangan kamu</h3>
              <p>Buka menu tagihan, lakukan aktivasi paket untuk mengaktifkan fitur undanganmu</p>
            </div>
          </li>

          <li class="setps-content-inner step1">
            <div class="step-content-number">
              <span>4</span>
            </div>
            <div class="step-content-text">
              <h3>Undangan Aktif</h3>
              <p>Kamu bisa mengubah dan melengkapi undangan kemudian kamu dapat menyebarkannya</p>
            </div>
          </li>

        </div>
      </div>
      
    </div>
  </div>
</section>

<!-- COUNT -->
<section class="sw-container sw-counter-wrapper">
  <div class="container">
    <div class="row">
      <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
        <div class="sw-counter-grid">
          <h3 class="sw-counter" data-count="<?= $total_users ?>">0
          </h3>
          <h4>Member
          </h4>
        </div>
      </div>
      <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
        <div class="sw-counter-grid">
          <h3 class="sw-counter" data-count="<?= $total_users ?>">0
          </h3>
          <h4>Undangan
          </h4>
        </div>
      </div>
      <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
        <div class="sw-counter-grid">
          <h3 class="sw-counter" data-count="<?= $total_tema ?>">0
          </h3>
          <h4>Desain
          </h4>
        </div>
      </div>
      <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
        <div class="sw-counter-grid">
          <h3 class="sw-counter" data-count="<?= $total_testi ?>">0
          </h3>
          <h4>Ulasan
          </h4>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- TESTIMONI -->
<section class="blog-container sw-bg-3" style="border-bottom-left-radius: 35px;border-bottom-right-radius: 35px;">
  <div class="container">
    <div class="row text-center">
      <div class="area-title text-center">
        <h2>Apa 
          <span>Kata
          </span> Mereka?
        </h2>
        <div class="title_border">
        </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-centered">
        <div class="testimonials-slider">
          <div class="owl-carousel testimonial-slider owl-theme">
            <?php
            $i = 1;
            foreach ($testimoni->getResult() as $row) { ?>
              <div class="item">  
                <div class="sw-content-desc">
                  <div class="sw-person text-center">
                    <img src="<?php echo base_url() ?>/assets/users/<?= $row->kunci ?>/kita.png" class="img-responsive img-circle"/>
                  </div>
                  <h3><?= htmlentities($row->nama_lengkap) ?>
                  </h3>
                  <p><?= htmlentities($row->ulasan) ?>
                  </p>
                  <p><?= htmlentities($row->kota) ?>,<?= htmlentities($row->provinsi) ?>
                  </p>
                </div>
              </div>
              <?php
              }
              ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="sw-container">
  <div class="container">
    <div class="media-partner">
      <div class="row">
        <h2>Partner Terintegrasi
        </h2>
        <div class="powered-slider owl-carousel text-center">
          <div class="media-partner-img">
            <img src="<?php echo base_url() ?>/assets/beranda/themes/powered/nusagateway.png" alt="Nusagateway"/>
          </div>
          <div class="media-partner-img">
            <img src="<?php echo base_url() ?>/assets/beranda/themes/powered/midtrans-logo.png" alt="Midtrans Gateway"/>
          </div>
          <div class="media-partner-img">
            <img src="<?php echo base_url() ?>/assets/beranda/themes/powered/wa.png" alt="WhatsApp"/>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="modal fade" id="sw-demo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title"> Preview Video <span class="nama_tema" id="nama_tema"></span></h4>
      </div>
      <div class="modal-body">
        <div class="demo text-center">
          <span class="demo-video" id="demo-video"></span>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- FOOTER -->
<footer>
  <a href="#" id="back-to-top" class="back-to-top" data-toggle="tooltip" data-placement="top" title="Back to top">
    <i class="fa fa-angle-up">
    </i>
  </a>
  <div class="container">
    <div class="row">
      <div class="footer-widget">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 clearfix">
          <div class="footer-widget">
            <div class="title_widget">
              <h3>TENTANG KAMI
              </h3>
            </div>
            <div class="footer_content">
              <div class="about-us">
                <p><?= SITE_NAME ?> adalah platform pembuatan undangan pernikahan digital kualitas premium. Undangan pernikahanmu akan lebih praktis dan kekinian, dengan url yang dapat disebar otomatis ke semua kontak WhatsApp, kamu telah memberikan kesan terbaik di momen spesial.
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 clearfix">
          <div class="footer-widget">
            <div class="title_widget">
              <h3>HALAMAN
              </h3>
            </div>
            <div class="footer_content">
              <div class="category">
                <ul>
                  <li>
                    <a href="<?= base_url() ?>/order">
                      <i class="fa fa-user">
                      </i> Pesan Undangan
                    </a>
                  </li>
                  <li>
                    <a href="<?= base_url() ?>/tema">
                      <i class="fa fa-file">
                      </i> Web Undangan
                    </a>
                  </li>
                  <li>
                    <a href="<?= base_url() ?>/tema_video">
                      <i class="fa fa-play">
                      </i> Video Undangan
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 clearfix">
          <div class="footer-widget">
            <div class="title_widget">
              <h3>KONTAK
              </h3>
            </div>
            <div class="footer_content">
              <ul class="address">
                <li>
                  <i class="fa fa-phone">
                  </i>
                  <span>WA: <?= $setting[0]->no_wa ?>
                </span>
              </li>
              <li>
                <i class="fa fa-envelope-o">
                </i>
                <span>
                  <a href="mailto:<?= $setting[0]->email ?>">Email: <?= $setting[0]->email ?>
                </a>
              </span>
            </li>
            
          </ul>
        </div>
      </div>
    </div>
  </div>
</footer>

<div class="copyright">
  <div class="container">
    <div class="row text-center">
      <p>Copyright &#169; 
        <?= date('Y') ?> 
        <?= SITE_NAME ?>. All Rights Reserved
      </p>
    </div>
  </div>
</div>
<!-- End footer -->

<!-- LIVE CHAT -->
<div class="sw-box-chat">
  <div class="sw-box-form-chat" id="sw-box-chat">
    <div class="sw-header-chat">
      <div class="sw-header-user">
        <img src="<?php echo base_url() ?>/assets/base/img/favicon.png" alt="image" class="img-responsive img-circle">
      </div>
      <div class="sw-header-title">
        <h3><?= DOMAIN_UTAMA ?></h3>
        <label>Online</label>
      </div>

      <div class="sw-btn-close" id="closeChat">
        <a href="javascript:void(0);"><i class="fa fa-times"></i></a>
      </div>
    </div>
    <div class="sw-body-chat">
      <p>Halo kaka ada yang bisa kami bantu?</p>
      <form id="form-chat" action="https://api.whatsapp.com/send" method="GET" role="form" target="_blank">
        <div class="form-group">
          <label>Pilih Admin</label>
          <select name="phone" id="input" class="form-control" required="required">
            <option value="<?= $setting[0]->no_wa; ?>">Admin <?= SITE_NAME ?></option>
          </select>
        </div>
        <div class="form-group">
          <label>Pesan</label>
          <textarea name="text" class="form-control" rows="3" required="required"></textarea>
        </div>

        <button type="submit" class="btn sw-button sw-button-chat"><i class="fa fa-paper-plane-o"></i> Kirim</button>
      </form>
    </div>
  </div>
  <a href="javascript:void(0);" id="showChat" class="sw-chat-whatsapp">
    <div class="sw_live_chat_icon"><i class="fa fa-whatsapp" aria-hidden="true"></i></div>
  </a>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js">
</script>
<script src="<?php echo base_url() ?>/assets/beranda/themes/assets/js/sw-plugins.js">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js">
</script>
<script src="<?php echo base_url() ?>/assets/beranda/themes/assets/js/sw-main.js">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/scrollReveal.js/2.0.0/scrollReveal.js">
</script>
<script src="<?php echo base_url() ?>/assets/beranda/themes/assets/js/particles.js">
</script>
<script src="<?php echo base_url() ?>/assets/beranda/themes/assets/js/sw-particles.js">
</script>
<script type="text/javascript">
  $('.sw-counter').each(function() {
    var $this = $(this),
    countTo = $this.attr('data-count');
    $({
      countNum: $this.text()}
      ).animate({
        countNum: countTo
      }
      ,
      {
        duration: 1000,
        easing:'linear',
        step: function() {
          $this.text(Math.floor(this.countNum));
        }
        ,
        complete: function() {
          $this.text(this.countNum);
        //alert('finished');
      }
    }
    );
    }
    );
  $(document).ready(function(){
    $('.btn-demo').on('click',function(){
            // get data from button edit
            const link_video = $(this).data('link');
            const nama_tema = $(this).data('nama');
            // Set data to Form Edit
            $('.demo-video').html(link_video);
            $('.nama_tema').html(nama_tema)
            // Call Modal Edit
            $('#sw-demo').modal('show');
          });
    $('#sw-demo').on('hide.bs.modal', function(){
      $('.demo-video').html('');
    });
  });
</script>
<!-- Facebook Pixel Code -->
<!-- </body></html> -->
</body>
</html>
