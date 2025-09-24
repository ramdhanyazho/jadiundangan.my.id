<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes(true);

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */

 /* =================== UNTUK SUB DOMAIN UNDANGAN ======================= */
if(isset($_SERVER['HTTP_HOST'])){
 if($_SERVER['HTTP_HOST'] == DOMAIN_UNDANGAN){

	$routes->setDefaultNamespace('App\Controllers\undangan');
	$routes->setDefaultController('Undangan');
	$routes->post('add_komentar', 'Undangan::do_add_komentar');
	$routes->add('(:any)', 'Undangan::Undangan');
	
/* =================== UNTUK ADMIN PANEL ======================= */		
}else if($_SERVER['HTTP_HOST'] == DOMAIN_ADMIN){

	$routes->setDefaultNamespace('App\Controllers\admin');
	$routes->setDefaultController('Admin');
	$routes->add('admin', 'Admin::dashboard');
	$routes->add('admin/dashboard', 'Admin::dashboard');
	$routes->add('admin/pembayaran', 'Admin::pembayaran');
	$routes->add('admin/pengguna', 'Admin::pengguna');
	$routes->add('admin/profil', 'Admin::profil');
	$routes->add('admin/setting', 'Admin::setting');
	$routes->get('login', 'Admin::login');
	$routes->add('admin/edit_pengguna', 'Admin::edit_pengguna');
	$routes->add('admin/edit_pengguna/(:any)', 'Admin::edit_pengguna');
	$routes->add('admin/testimoni', 'Admin::testimoni');
	$routes->add('admin/tema', 'Admin::tema');
	$routes->add('admin/tema_video', 'Admin::tema_video');
	$routes->add('logout', 'Admin::do_unauth');
	
	$routes->post('do_auth', 'Admin::do_auth');
	$routes->post('admin/update_setting1', 'Admin::do_update_setting_1');
	$routes->post('admin/update_setting2', 'Admin::do_update_setting_2');
	$routes->post('admin/update_admin', 'Admin::do_update_admin');
	$routes->post('admin/konfirmasi', 'Admin::do_konfirmasi');
	$routes->post('admin/hapus_user', 'Admin::do_hapus_user');
	$routes->post('admin/update_fitur', 'Admin::do_update_fitur');
	$routes->post('admin/update_domain', 'Admin::do_update_domain');
	$routes->post('admin/update_foto_mempelai', 'Admin::do_update_foto_mempelai');
	$routes->post('admin/update_mempelai', 'Admin::do_update_mempelai');
	$routes->post('admin/update_acara', 'Admin::do_update_acara');
	$routes->post('admin/update_maps', 'Admin::do_update_maps');
	$routes->post('admin/update_gallery', 'Admin::do_update_gallery');
	$routes->post('admin/del_gallery', 'Admin::do_del_gallery');
	
	$routes->post('admin/update_cerita', 'Admin::do_update_cerita');
	$routes->post('admin/update_user', 'Admin::do_update_user');
	$routes->post('admin/update_musik', 'Admin::do_update_musik');
	$routes->post('admin/update_video', 'Admin::do_update_video');
	$routes->post('admin/update_salam_pembuka', 'Admin::update_salam_pembuka');
	$routes->post('admin/aktiftesti', 'Admin::aktiftesti');
	$routes->post('admin/nonaktiftesti', 'Admin::nonaktiftesti');
	$routes->post('admin/hapustesti', 'Admin::hapus_testi');
    $routes->post('admin/aktif_tema', 'Admin::do_aktif_tema');
    $routes->post('admin/nonaktif_tema', 'Admin::do_nonaktif_tema');
    $routes->post('admin/upload_theme', 'Admin::upload_theme');
    $routes->post('admin/delete_theme', 'Admin::delete_theme');
    $routes->post('admin/upload_theme_video', 'Admin::upload_theme_video');
    $routes->post('admin/update_theme_video', 'Admin::update_theme_video');
    $routes->post('admin/delete_theme_video', 'Admin::delete_theme_video');
}else if($_SERVER['HTTP_HOST'] == DOMAIN_BUKUTAMU){

	$routes->setDefaultNamespace('App\Controllers\bukutamu');
	$routes->setDefaultController('Bukutamu');
	$routes->get('bukutamu/autofill', 'Bukutamu::autofill');
	$routes->post('add_hadir', 'Bukutamu::do_add_hadir');
	$routes->add('(:any)', 'Bukutamu::bukutamu');

/* =================== UNTUK DOMAIN UTAMA ======================= */	
}else{

	$routes->setDefaultNamespace('App\Controllers\base');
	$routes->setDefaultController('Beranda');

	//TUTORIAL
	$routes->add('youtube', 'Beranda::youtube');
	$routes->add('maps', 'Beranda::maps');
	$routes->add('import_tamu', 'Beranda::import_tamu');
	$routes->add('qrcode', 'Beranda::qrcode');
	//TEMA
	$routes->add('tema', 'Beranda::themes');
	$routes->add('tema_video', 'Beranda::themes_video');
    $routes->add('kirim_undangan', 'Beranda::kirim_undangan');
    $routes->add('notifikasi', 'Beranda::notification');
	//DEMO
	$routes->add('demo/(:any)', 'Beranda::demo');
    $routes->add('home', 'Beranda::home');
	//ORDER
	$routes->add('order', 'Order');
	$routes->add('order/1', 'Order');
	$routes->add('order/2', 'Order::mempelai');
	$routes->add('order/3', 'Order::acara');
	$routes->add('order/4', 'Order::cerita');
	$routes->add('order/5', 'Order::gallery');
	$routes->add('order/del', 'Order::del');
	$routes->add('order/upload', 'Order::fileUpload');
	$routes->add('order/imgupload', 'Order::imgupload');
	$routes->add('order/save', 'Order::saveData');
	$routes->add('order/finish', 'Order::finish');
	$routes->add('order/success/(:any)', 'Order::success');
	$routes->add('order/any', 'Order::any');
	$routes->add('order/(:any)', 'Order');


	//DASHBOARD USER
	$routes->get('login', 'Dashboard::login');
	$routes->get('notification', 'Dashboard::showSweetAlertMessages');
	$routes->get('user/dashboard', 'Dashboard::index');
	$routes->get('user/riwayat', 'Dashboard::riwayat');
	$routes->get('user/ucapan', 'Dashboard::ucapan');
	$routes->get('user/tampilan', 'Dashboard::tampilan');
	$routes->get('user/pengaturan', 'Dashboard::pengaturan');
	$routes->get('user/mempelai', 'Dashboard::mempelai');
	$routes->get('user/acara', 'Dashboard::acara');
	$routes->get('user/album', 'Dashboard::gallery');
	$routes->get('user/cerita', 'Dashboard::cerita');
	$routes->get('user/rekening', 'Dashboard::rekening');
	$routes->get('user/invoice', 'Dashboard::invoice');
	$routes->get('user/profil', 'Dashboard::profil');
	$routes->get('user/logout', 'Dashboard::do_unauth');
	$routes->get('user/testimoni', 'Dashboard::testimoni');
	$routes->get('user/tamu', 'Dashboard::tamu');
	$routes->get('user/setting_bukutamu', 'Dashboard::setting_bukutamu');
	$routes->get('user/data_hadir', 'Dashboard::data_hadir');
	$routes->get('user/autofill', 'Dashboard::autofill');
	
	$routes->get('user/token', 'Dashboard::token');
	$routes->post('user/finish', 'Dashboard::attemptOrder');
	
	$routes->add('user/save_tamu', 'Dashboard::do_save_tamu');
    $routes->add('user/prosesExcel', 'Dashboard::prosesExcel');
	$routes->post('do_auth', 'Dashboard::do_auth');
	$routes->post('user/hapus_riwayat', 'Dashboard::do_hapus_riwayat');
	$routes->post('user/hapusbanyakriwayat', 'Dashboard::hapusbanyakriwayat');
	$routes->post('user/hapus_komentar', 'Dashboard::do_hapus_komentar');
	$routes->post('user/ganti_tema', 'Dashboard::do_ganti_tema');
	$routes->post('user/update_fitur', 'Dashboard::do_update_fitur');
	$routes->post('user/update_domain', 'Dashboard::do_update_domain');
	$routes->post('user/update_wa', 'Dashboard::do_update_token');
	$routes->post('user/update_foto_mempelai', 'Dashboard::do_update_foto_mempelai');
	$routes->post('user/update_mempelai', 'Dashboard::do_update_mempelai');
	$routes->post('user/update_acara', 'Dashboard::do_update_acara');
	$routes->post('user/update_maps', 'Dashboard::do_update_maps');
	$routes->post('user/update_gallery', 'Dashboard::do_update_gallery');
	$routes->post('user/del_gallery', 'Dashboard::do_del_gallery');
	$routes->post('user/del_slider_bukutamu', 'Dashboard::do_del_slider_bukutamu');
	$routes->post('user/update_cerita', 'Dashboard::do_update_cerita');
	$routes->post('user/update_rekening', 'Dashboard::do_update_rekening');
	$routes->post('user/update_user', 'Dashboard::do_update_user');
	$routes->post('user/update_musik', 'Dashboard::do_update_musik');
	$routes->post('user/update_video', 'Dashboard::do_update_video');
	$routes->post('user/konfirmasi', 'Dashboard::do_konfirmasi');
	$routes->post('user/update_salam', 'Dashboard::do_update_salam');
	$routes->post('user/update_testi', 'Dashboard::do_update_testi');
	$routes->post('user/kirim_undangan', 'Dashboard::kirim_undangan');
	$routes->post('user/hapus_tamu', 'Dashboard::do_hapus_tamu');
	$routes->post('user/hapusbanyaktamu', 'Dashboard::hapusbanyaktamu');
	$routes->post('user/update_tamu', 'Dashboard::do_update_tamu');
	$routes->post('user/update_hadir', 'Dashboard::do_update_hadir');
	$routes->add('user/kirim_undangan', 'Dashboard::kirim_undangan');
    $routes->post('user/hapus_hadir', 'Dashboard::do_hapus_hadir');
    $routes->post('user/refresh_invoice', 'Dashboard::refresh_invoice');
    $routes->add('user/re_order', 'Dashboard::re_order');
    $routes->post('user/update_slider_bukutamu', 'Dashboard::do_update_slider_bukutamu');
	$routes->post('user/update_background_theme', 'Dashboard::do_update_background_theme');
    $routes->post('user/update_background_bukutamu', 'Dashboard::do_update_background_bukutamu');
    $routes->get('lupa_password', 'Lupa_password::index');
    $routes->post('do_kirim', 'Lupa_password::do_kirim');
    $routes->get('ganti_password/(:any)', 'Lupa_password::ganti_password');
    $routes->post('update_password', 'Lupa_password::update_password');
	//REDIRECT SEMUA ROUTES TIDAK DIKENAL KE HOME
	$routes->add('(:any)', 'Beranda');

}
}





/* =================== DEFAULT ROUTES ======================= */	
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// $routes->get('/', 'Home::index');
// $routes->add('theme', 'Anu::demo');
// $routes->add('(:any)', 'Anu::index');

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
