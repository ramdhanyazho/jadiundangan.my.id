 <!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
        <div>
        
        
        <a href="<?= SITE_UNDANGAN ?>/<?= $order[0]->domain ?>" class="btn btn-primary btn-sm">Lihat Website</a>
        
        </div>
    </div> 

    <div class="row mb-3">
        <div class="col-xl-12 col-lg-12 mb-4">
            <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <?php 
                    $midtrans = $setting[0]->midtrans;
                    $masa_aktif = $setting[0]->aktif;
                    $trial = $setting[0]->trial;
                    $durasi = '+'.$trial.' days';
                    $tglDaftar = $order[0]->created_at;
                    $tglExp = strtotime($durasi, strtotime($tglDaftar));
                    $tglExpFormated = date("d-m-Y H:i A",$tglExp);
                    $today = strtotime('now');
                    $tglBayar =  $pembayaran[0]->tglBayar;
                    $tglTransaksi = $pembayaran[0]->transaction_time;
                    $expiry = strtotime('1 days', strtotime($tglTransaksi));
                    $expiry_date = date("d-m-Y H:i A",$expiry);
                    $aktif = '+'.$masa_aktif.' days';
                    $tglNonaktif = strtotime($aktif, strtotime( $tglBayar));
                    $tglNonaktifFormated = date("d-m-Y H:i A", $tglNonaktif );
                    
                    if($pembayaran[0]->status == 0){ ?>
                    <h6 class="m-0 font-weight-bold " style="color:red">Invoice : Masa Trial Anda Akan Berakhir pada tanggal <?= $tglExpFormated ?>, Segera lakukan pembayaran</h6>
                    <?php }else if($pembayaran[0]->status == 1){ 
                    if($midtrans == 0) {?>
                    <h6 class="m-0 font-weight-bold " style="color:orange">Invoice : Pembayaran anda menunggu konfirmasi</h6>
                    <?php }else{ ?>
                    <h6 class="m-0 font-weight-bold " style="color:orange">Invoice : Selesaikan Pembayaran anda sebelum <?= $expiry_date ?> </h6>
                    <?php }
                    } else if($pembayaran[0]->status == 2 && $today >= $tglNonaktif ){ 
                    ?>
                    <h6 class="m-0 font-weight-bold " style="color:red"> Masa Aktif Undangan sudah habis pada tanggal <?= $tglNonaktifFormated ?>, Silahkan lakukan pembayaran lagi untuk memperpanjang masa aktif undangan </h6>
                    <?php }else{ ?>
                    <h6 class="m-0 font-weight-bold " style="color:#005CAA">Undangan Anda aktif sampai tanggal <?= $tglNonaktifFormated ?></h6>
                    <?php } ?>
               </div>
            </div>
        </div>
    

        <div class="col-xl-6 col-lg-6 mb-4">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Tagihan Pembayaran</h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Kode Pesanan</label>
                        <div class="upload-area-bg" style="margin-top: 5px;text-align: center;background: #f1f2f6 !important;">                       
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                    <a style="font-size: 16px;text-transform: uppercase;color: #2c3e50;font-weight:600;" >#<?= $pembayaran[0]->invoice ?></a>
                                    </div>
                                    <div class="col-auto">
                                    <?php if($pembayaran[0]->status == 2){ 
                                    if($pembayaran[0]->status == 2 && $today >= $tglNonaktif ){ ?>
                                        <button id="re_order" class="btn-danger btn-sm btn" title="refresh perpanjangan"><i class="fas fa-sync-alt" aria-hidden="true"></i></button>
                                        <button  class="btn-alert btn-sm btn" >Tidak Aktif</button>
                                    <?php } else { ?>
                                        <button  class="btn-success btn-sm btn" >Lunas</button>
                                    <?php }
                                    }else if($pembayaran[0]->status == 1){ ?>
                                        <button id="refresh" class="btn-danger btn-sm btn" title="refresh pembayaran"><i class="fas fa-sync-alt" aria-hidden="true"></i></button>
                                        <?php if($midtrans == 0){?>
                                        <button class="btn-warning btn-sm btn" >Menunggu Konfirmasi</button>
                                        <?php }else { if ($pembayaran[0]->status == 1 && $today >= $expiry ) { ?>
                                        <button class="btn-danger btn-sm btn" >Silahkan Refresh Invoice</button>
                                        <?php }else{ 
                                        ?>
                                        <button class="btn-warning btn-sm btn" >Menunggu Pembayaran</button>
                                    <?php }
                                        }
                                    }else if($pembayaran[0]->status == 0){ ?>
                                        <button id="refresh" class="btn-danger btn-sm btn" title="refresh pembayaran"><i class="fas fa-sync-alt" aria-hidden="true"></i></button>
                                        <button class="btn-warning btn-sm btn" >Belum Lunas</button>
                                    <?php } ?>
                                    </div>
                                </div>   
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Total Tagihan</label>
                        <div class="upload-area-bg" style="margin-top: 5px;text-align: center;background: #f1f2f6;">
                            <a style="font-size: 18px;color: #2c3e50;font-weight:bolder" ><?= rupiah($pembayaran[0]->harga) ?></a>
                        </div>
                    </div>
                    <form id="payment-form" method="post" action="<?= base_url('user/finish') ?>">
                        <input type="hidden" name="result_type" id="result-type" value="">
                        <input type="hidden" name="result_data" id="result-data" value="">
                    </form>
                    <?php if($pembayaran[0]->status == 2 && $today >= $tglNonaktif ){ ?>
                    <button class="btn btn-primary btn-block" id="pay-button">Perpanjangan</button>
                    <?php }else if($pembayaran[0]->status == 2){ ?>
                        <button class="btn btn-primary btn-block" id="pay-button" disabled>Lunas</button>
                    <?php }else if($pembayaran[0]->status == 1){ 
                            if($midtrans == 0) {?> 
                        <button class="btn btn-primary btn-block" disabled>Menunggu Konfirmasi</button>
                        <?php }else{ ?>
                        <button class="btn btn-primary btn-block" id="pay-button" disabled>Menunggu Pembayaran</button>
                    <?php }
                    }else if($pembayaran[0]->status == 0){ 
                            if($midtrans == 0) {?>
                        <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#modalKonfirmasi">Konfirmasi</button>
                        <?php }else{ ?>
                        <button class="btn btn-primary btn-block" id="pay-button">Pembayaran</button>
                    <?php } 
                    }?>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6 mb-4" style="<?php if($midtrans == 0) { echo 'display:block'; } else { if($pembayaran[0]->status != 0){ echo 'display:block'; } else{ echo 'display:none'; } }?>">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Rekening Pembayaran </h6>
                </div>
                <div class="card-body">
                    <?php if($midtrans == 0) { ?>
                    <div class="form-group">
                        <label>Nama Bank</label>
                        <div class="upload-area-bg d-flex justify-content-between" style="margin-top: 5px;text-align: center;background: #f1f2f6;">
                            <img src="<?= base_url() ?>/assets/base/img/bank.png" height="40px" width="80px">      
                            <a style="font-size: 16px;text-transform: uppercase;color: #2c3e50;" ><?= $setting[0]->nama_bank ?></a>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Nomor Rekening</label>
                        <div class="upload-area-bg d-flex justify-content-between" style="margin-top: 5px;text-align: center;background: #f1f2f6;">
                            <a style="font-size: 18px;text-transform: uppercase;color: #2c3e50;" ><span id="norek"><?= $setting[0]->norek ?></span></a>   
                            <button class="btn btn-sm btn-secondary" onclick="copyToClipboard('#norek')">Salin</button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Atas Nama</label>
                        <div class="upload-area-bg" style="margin-top: 5px;text-align: center;background: #f1f2f6;">
                            <a style="font-size: 18px;text-transform: uppercase;color: #2c3e50;" ><?= strtoupper($setting[0]->nama_pemilik) ?></a>   
                        </div>
                    </div>
                    <?php } else {?>
                    <div class="form-group">
                        <label>Nama Bank</label>
                        <div class="upload-area-bg d-flex justify-content-between" style="margin-top: 5px;text-align: center;background: #f1f2f6;">
                            <a style="font-size: 16px;text-transform: uppercase;color: #2c3e50;" ><?= $pembayaran[0]->nama_bank ?></a>
                        </div>
                    </div>
                    <?php if($pembayaran[0]->payment_type=='echannel') {?>
                    <div class="form-group">
                        <label>Biller Code</label>
                        <div class="upload-area-bg d-flex justify-content-between" style="margin-top: 5px;text-align: center;background: #f1f2f6;">
                            <a style="font-size: 18px;text-transform: uppercase;color: #2c3e50;" ><span id="biller_code"><?= $pembayaran[0]->biller_code ?></span></a>   
                            <button class="btn btn-sm btn-secondary" onclick="copyToClipboard('#biller_code')">Salin</button>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="form-group">
                        <label>Nomor Rekening</label>
                        <div class="upload-area-bg d-flex justify-content-between" style="margin-top: 5px;text-align: center;background: #f1f2f6;">
                            <a style="font-size: 18px;text-transform: uppercase;color: #2c3e50;" ><span id="norek"><?= $pembayaran[0]->va_number ?></span></a>   
                            <button class="btn btn-sm btn-secondary" onclick="copyToClipboard('#norek')">Salin</button>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <!--Row-->
</div>

<!-- Modal -->
<div class="modal fade" id="modalMenunggu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Peringatan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       Pembayaran anda sudah kami terima.<br>Mohon tunggu tim kami sedang melakukan verifikasi..
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="modalKonfirmasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> 
      <form method="POST" enctype="multipart/form-data"  action="<?php echo base_url('user/konfirmasi'); ?>">
      <div class="modal-body">
        <div class="col mt-2">
            <label>Nama Lengkap</label>
            <input name="nama_lengkap" type="text" class="form-control" placeholder="Contoh : Dinda Rahma" value="" required>
        </div>
        <div class="col mt-2">
            <label>Nama Bank</label>
            <input name="nama_bank" type="text" class="form-control" placeholder="Contoh : BRI " value="" required>
        </div>        
        <div class="col mt-2 mb-2">
            <label>Bukti Transfer (max 2MB)</label>
            <input type="file"  id="bukti" name="bukti">
        </div>
        <input type="hidden"  value="<?= $pembayaran[0]->invoice ?>" name="invoice">
      <div class="modal-footer">
        <button type="submit" class="btn btn-sm btn-primary" id="simpanKonfimasi">Konfirmasi</button>
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Batal</button>
      </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript" src="<?= $urlMidtrans ?>" data-client-key="<?= $clientKey ?>"></script>
<script type="text/javascript">
    $('#pay-button').click(function(event) {
        event.preventDefault();
        $(this).attr("disabled", "disabled");
        $.ajax({
            url: '<?= base_url('user/token') ?>',
           cache: false,

            success: function(data) {
                //location = data;

                console.log('token = ' + data);

                var resultType = document.getElementById('result-type');
                var resultData = document.getElementById('result-data');

                function changeResult(type, data) {
                    $("#result-type").val(type);
                    $("#result-data").val(JSON.stringify(data));
                    //resultType.innerHTML = type;
                    //resultData.innerHTML = JSON.stringify(data);
                }

                snap.pay(data, {
                    onSuccess: function(result) {
                        changeResult('success', result);
                        console.log(result.status_message);
                        console.log(result);
                        $("#payment-form").submit();
                    },
                    onPending: function(result) {
                        changeResult('pending', result);
                        console.log(result.status_message);
                        $("#payment-form").submit();
                    },
                    onError: function(result) {
                        changeResult('error', result);
                        console.log(result.status_message);
                        $("#payment-form").submit();
                    }
                });
            }
        });
    });
    $('#refresh').on('click', function(event) {
        $.ajax({
            url : "<?= base_url('user/refresh_invoice') ?>",
            method : "POST",
            async : true,
            dataType : 'html',
            success: function($hasil){
               if($hasil == 'sukses'){
                location.reload();
               }
            }
        });
    });
    $('#re_order').on('click', function(event) {
        $.ajax({
            url : "<?= base_url('user/re_order') ?>",
            method : "POST",
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