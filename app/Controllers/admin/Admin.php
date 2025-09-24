<?php namespace App\Controllers\admin;

use CodeIgniter\Controller;
use App\Models\admin\AdminModel;
use ZipArchive;
class Admin extends Controller
{
    public function __construct() {
        //mengisi variable global dengan data
        $this->session = session();
        $this->AdminModel = new AdminModel(); 
	    $this->request = \Config\Services::request(); //memanggil class request
        $this->uri = $this->request->uri; //class request digunakan untuk request uri/url
        $this->email = \Config\Services::email();
        $this->validate = \Config\Services::validation();
    }

    public function index()
    {
        echo 'Tidak ada apapun disini';
    }

    public function do_auth(){

        $data['email'] = $this->request->getPost('email');
        $data['password'] = md5($this->request->getPost('password'));
        $hasil = $this->AdminModel->get_admin($data);
        
        if(count($hasil) > 0)
        {
            // set session
            $sess_data = array('masukAdmin' => TRUE, 'uname_admin' => $hasil[0]->username, 'id_admin' => $hasil[0]->id);
            $this->session->set($sess_data);
            return redirect()->to(base_url('admin/dashboard'));
            exit();
        }
        else
        {
            $this->session->setFlashdata('errors', ['Password Salah']);
            return redirect()->to(base_url('/login'));
        }
		
    }
    
    public function do_unauth(){

        $this->session->destroy();
        return redirect()->to(base_url('/login'));
		
	}

    public function login()
    {
        if(session()->has('masukAdmin'))
        {
        	return redirect()->to(base_url('admin/dashboard'));
        }
        $data['title'] = 'Selamat Datang!';
        $data['view'] = 'admin/auth/login';
        return view('admin/auth/layout', $data);
    }

    public function dashboard()
    {
        $data['title'] = 'Admin Dashboard';
        $data['view'] = 'admin/index';
        $data['join'] = $this->AdminModel->get_all_join();
        $data['totalPending'] = $this->AdminModel->get_total_pending();
        $data['totalKeuntungan'] = $this->AdminModel->get_total_keuntungan();
        $data['setting'] = $this->AdminModel->get_setting();
        return view('admin/layout', $data);
    }

    public function pengguna()
    {
        $data['title'] = 'Data Pengguna';
        $data['view'] = 'admin/pengguna';
        $data['join'] = $this->AdminModel->get_all_pembayaran();
        $data['setting'] = $this->AdminModel->get_setting();
        return view('admin/layout', $data);
    }
    

    public function do_hapus_user(){

        $id = $this->request->getPost('id');

        $kunci= $this->request->getPost('kunci');
        
        $path = 'assets/users/'.$kunci;
        if(file_exists($path)){
        helper('filesystem'); // load the helper
        delete_files($path, true); // delete all files/folders inside images folder
        $remove = rmdir($path);
        }

        $delete = $this->AdminModel->delete_user($id);
            
        if($delete){
        $session = session();
            $session->setFlashdata("deleted", "Data Pengguna Berhasil dihapus");
            echo 'sukses';
        }else{
            $session = session();
            $session->setFlashdata("error", "Data Pengguna Gagal dihapus");
            echo 'gagal';
        }

    }
    
    public function testimoni()
    {
        $data['testimoni'] = $this->AdminModel->get_testimoni();
        $data['title'] = 'Data Testimonial';
        $data['view'] = 'admin/testimoni';
        
        return view('admin/layout', $data);
    }
    public function aktiftesti(){

        $id = $this->request->getPost('id');

        $update = $this->AdminModel->aktiftesti($id);
        if($update){
        $session = session();
            $session->setFlashdata("updated", "Testimoni Berhasil diaktifkan");
            echo 'sukses';
        }else{
            $session = session();
            $session->setFlashdata("error", "Testimoni Gagal diaktifkan");
            echo 'gagal';
        }
    }
    public function nonaktiftesti(){

        $id = $this->request->getPost('id');

        $update = $this->AdminModel->nonaktiftesti($id);
        if($update){
        $session = session();
            $session->setFlashdata("updated", "Testimoni Berhasil dinonaktfikan");
            echo 'sukses';
        }else{
            $session = session();
            $session->setFlashdata("error", "Testimoni Gagal dinonaktfikan");
            echo 'gagal';
        }
    }
    
    public function hapus_testi(){

        $id = $this->request->getPost('id');

        $delete = $this->AdminModel->delete_testi($id);
        if($delete){
        $session = session();
            $session->setFlashdata("deleted", "Testimoni Berhasil dihapus");
            echo 'sukses';
        }else{
            $session = session();
            $session->setFlashdata("error", "Testimoni Gagal dihapus");
            echo 'gagal';
        }

    }
    
    public function pembayaran(){
        $data['title'] = 'Data Pembayaran';
        $data['view'] = 'admin/pembayaran';
        $data['join'] = $this->AdminModel->get_all_join();
        $data['setting'] = $this->AdminModel->get_setting();
        return view('admin/layout', $data);
    }

    public function do_konfirmasi(){

        $id = $this->request->getPost('id');
        $update = $this->AdminModel->konfirmasi_user($id);
        if($update){
            foreach ($this->AdminModel->get_setting() as $row) {
                $token = $row->token_wa;
           }
            foreach ($this->AdminModel->get_user_all($id) as $row) {
                $phone = $row->hp;
                $email = $row->email;
                $invoice = $row->invoice;
                $domain = $row->domain;
           }
            
            $pesan = "<h2>Konfirmasi Pembayaran</h2>Halo Kak, Terima Kasih Sudah Memesan Undangan Digital <b>".DOMAIN_UTAMA."</b><br><br>Pembayaran Anda <b>#".$invoice."</b> dengan domain <b>".$domain."</b> Berhasil dikonfirmasi oleh Admin <b>".DOMAIN_UTAMA."</b><br><br><b>Terima Kasih Dan Sukses Selalu</b>";
            $message = 'Halo Kak, Terima Kasih Sudah Memesan Undangan Digital '.DOMAIN_UTAMA.'
            
Pembayaran Anda #'.$invoice.' dengan domain *'.$domain.'* Berhasil dikonfirmasi oleh Admin '.DOMAIN_UTAMA.'.

*Terima Kasih Dan Sukses Selalu*';
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'http://nusagateway.com/api/send-message.php',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array('token' => $token,'phone' => $phone,'message' => $message),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            $this->sendEmail($email, 'Konfirmasi Pembayaran', $pesan);
	 		$session = session();
            $session->setFlashdata("updated", "Pembayaran Berhasil dikonfirmasi");
            echo 'sukses';
        }else{
            $session = session();
            $session->setFlashdata("error", "Pembayaran Gagal dikonfirmasi");
            echo 'gagal';
	 	}
    }
    
    private function sendEmail($to, $title, $pesan){
        foreach ($this->AdminModel->get_setting() as $row) {
                $host_email = $row->host_email;
                $email_kirim = $row->email;
                $pass_email = $row->pass_email;
        }
        $nama = SITE_NAME;
        $email_smtp = \Config\Services::email();
        $config["protocol"] = "smtp";
        //isi sesuai nama domain/mail server
        $config["SMTPHost"]  = $host_email;
        //alamat email SMTP
        $config["SMTPUser"]  = $email_kirim; 

        //password email SMTP
        $config["SMTPPass"]  = $pass_email; 
        $config["SMTPPort"]  = 587;
        $config["SMTPCrypto"] = "tls";

        $email_smtp->initialize($config);

		$email_smtp->setFrom($email_kirim, $nama);
		$email_smtp->setTo($to);
		$email_smtp->setSubject($title);
		$email_smtp->setMessage($pesan);

		if(!$email_smtp->send()){
			return false;
		}else{
			return true;
		}
    }

    public function profil(){
        $data['admin'] = $this->AdminModel->get_admin_by_id();
        $data['title'] = 'Profil Admin';
        $data['view'] = 'admin/profil';
		return view('admin/layout', $data);
    }

    public function do_update_admin(){

        if($this->request->getPost('password') != ''){
            $data['password'] = md5($this->request->getPost('password'));
        }

        $data['username'] = $this->request->getPost('username');
        $data['nama_lengkap'] = $this->request->getPost('nama');
        $data['email'] = $this->request->getPost('email');

        $update = $this->AdminModel->update_admin($data);
        if($update){
            $this->session->set('uname_admin', $data['username']);
            echo 'sukses';
        }else{
            echo 'gagal';
        }
       
    }

    public function setting(){
        $data['setting'] = $this->AdminModel->get_setting();
        $data['title'] = 'Setting Web';
        $data['view'] = 'admin/setting';
		return view('admin/layout', $data);
    }

    public function do_update_setting_1(){
        $data['midtrans'] = $this->request->getPost('midtrans');
        $data['harga'] = $this->request->getPost('harga');
        $data['nama_bank'] = $this->request->getPost('bank');
        $data['nama_pemilik'] = $this->request->getPost('nama');
        $data['norek'] = $this->request->getPost('norek');
        $update = $this->AdminModel->update_setting($data);
        if($update){
            $session = session();
            $session->setFlashdata("updated", "Data Setting Berhasil diupdate");
            echo 'sukses';
        }else{
            $session = session();
            $session->setFlashdata("error", "Data Setting Gagal diupdate");
            echo 'gagal';
        }

    }
        public function do_update_setting_2(){
        $data['host_email'] = $this->request->getPost('host_email');
        $data['email'] = $this->request->getPost('email');
        $data['pass_email'] = $this->request->getPost('pass_email');
        $data['trial'] = $this->request->getPost('trial');
        $data['aktif'] = $this->request->getPost('aktif');
        $data['token_wa'] = $this->request->getPost('token_wa');
        $data['no_wa'] = $this->request->getPost('no_wa');
        $data['pesan_wa'] = $this->request->getPost('pesan_wa');
        $data['salam_pembuka'] = $this->request->getPost('salam_pembuka');
        $data['salam_wa_atas'] = $this->request->getPost('salam_wa_atas');
        $data['salam_wa_bawah'] = $this->request->getPost('salam_wa_bawah');
        
        $update = $this->AdminModel->update_setting($data);
        if($update){
            $session = session();
            $session->setFlashdata("updated", "Data Setting Berhasil diupdate");
            echo 'sukses';
        }else{
            $session = session();
            $session->setFlashdata("error", "Data Setting Gagal diupdate");
            echo 'gagal';
        }

    }

    public function edit_pengguna(){

        if($this->request->getMethod() == 'post'){
            $id = $this->request->getPost('id');
            $this->session->set('id_usernya', $id);
        }
        $data['title'] = 'Edit Pengguna';
        $data['view'] = 'admin/edit_pengguna';

        $data['user'] = $this->AdminModel->get_user_by_id_user();
        $data['fitur'] = $this->AdminModel->get_fitur_by_id_user();
        $data['acara'] = $this->AdminModel->get_acara_by_id_user();
        $data['mempelai'] = $this->AdminModel->get_mempelai_by_id_user();
        $data['cerita'] = $this->AdminModel->get_cerita_by_id_user(); 
        $data['album'] = $this->AdminModel->get_album_by_id_user();
        $data['data'] = $this->AdminModel->get_data_by_id_user();
        $data['order'] = $this->AdminModel->get_order_by_id_user();
        return view('admin/layout', $data);

    }

    public function do_update_user(){

        if($this->request->getPost('password') != ''){
            $data['password'] = md5($this->request->getPost('password'));
        }

        $data['username'] = $this->request->getPost('username');
        $data['email'] = $this->request->getPost('email');
        $data['hp'] = $this->request->getPost('hp');

        $update = $this->AdminModel->update_user($data);
        if($update){
            $this->session->set('uname', $data['username']);
            echo 'sukses';
        }else{
            echo 'gagal';
        }
       
    }

    public function do_update_cerita(){

        //HAPUS DULU SESSION SEBELUMNYA
        $jml_cerita_sebelumnya = $this->session->get('jml_cerita');

        for($i=0;$i<=$jml_cerita_sebelumnya;$i++){
            $this->session->remove('tanggal_cerita'.$i);
            $this->session->remove('judul_cerita'.$i);
            $this->session->remove('isi_cerita'.$i);
        }

        //SEBAGAI ARRAY PENANDA
        $noTanggal = 0;
        $noJudul = 0;
        $noIsi = 0;
        
        //KITA KUMPULKAN DAN SIMPAN DATANYA DI SESSION DULU
        foreach ($this->request->getPost('tanggal_cerita') as $value) {
            if($value == "")
                continue;
            $this->session->set('tanggal_cerita'.$noTanggal++, $value); 
            
        }

        foreach ($this->request->getPost('judul_cerita') as $value) {
            if($value == "")
            continue;
            $this->session->set('judul_cerita'.$noJudul++, $value); 
        }

        foreach ($this->request->getPost('isi_cerita') as $value) {
            if($value == "")
            continue;
            $this->session->set('isi_cerita'.$noIsi++, $value); 
        }
        
        //KEMUDIAN HAPUS SEMUA DATA CERITA SEBULUMNYA
        $hpscerita = $this->AdminModel->hapus_cerita();

        //SETELAH ITU KITA SIMPAN KE DB
        for($i=0;$i<$noTanggal;$i++){
            $tanggal_cerita = $this->session->get('tanggal_cerita'.$i);
            $judul_cerita = $this->session->get('judul_cerita'.$i);
            $isi_cerita = $this->session->get('isi_cerita'.$i);

            $dataCerita = [
                'id_user' => $_SESSION['id_usernya'],
                'tanggal_cerita' => $tanggal_cerita,
                'judul_cerita' => $judul_cerita,
                'isi_cerita' => $isi_cerita
            ];

            $saveCerita = $this->AdminModel->save_cerita($dataCerita);
        }

        return redirect()->to(base_url('admin/edit_pengguna'));

    }

    public function do_update_video(){
         
        $data['video'] = $this->request->getPost('video');

        $update = $this->AdminModel->update_video($data);
        if($update){
            echo 'sukses';
        }else{
            echo 'gagal';
        }
    }

    // upload foto gallery
	public function do_update_gallery(){

        $avatar = $this->request->getFile('file');
        $kunci = $this->request->getPost('kunci');
        $path = 'assets/users/'.$kunci;
        
        //folder e
        if(!file_exists($path)){
        	$create = mkdir('assets/users/'.$kunci, 0777,true);
        }

        //nama file e
        for($i=1;$i<=10;$i++){
        	$pathName = 'assets/users/'.$kunci.'/album'.$i.'.png';
        	if(!file_exists($pathName)){
        		$ok = array("no"=>$i,"kunci"=>$kunci);
        		$avatar->move('assets/users/'.$kunci, 'album'.$i.'.png');
                echo json_encode($ok);
                
                //save to db
                $dataAlbum = [
                    'id_user' => $_SESSION['id_usernya'],
                    'album' => 'album'.$i
  
                ];
                $saveAlbum = $this->AdminModel->save_album($dataAlbum);
        		break;
        	} 
        }

    }

    public function do_del_gallery(){

       $id = $this->request->getPost('id');
       $kunci = $this->request->getPost('kunci');
       $file = 'assets/users/'.$kunci.'/album'.$id.'.png';
       $data['album'] = 'album'.$id;
       $data['id_user'] = $_SESSION['id_usernya'];
       $delete = $this->AdminModel->delete_album($data);
       unlink($file);
       echo json_encode("sukses");
    }


    public function do_update_acara(){
         
        $datanyaSiapa = $this->request->getPost('datanyaSiapa'); //cara cepat pake variabel :)
        $data["tanggal_".$datanyaSiapa] = $this->request->getPost('tanggal');
        $data['jam_'.$datanyaSiapa] = $this->request->getPost('waktu');
        $data['tempat_'.$datanyaSiapa] = $this->request->getPost('lokasi');
        $data['alamat_'.$datanyaSiapa] = $this->request->getPost('alamat');

        $update = $this->AdminModel->update_acara($data);
        if($update){
         $session = session();
            $session->setFlashdata("updated", "Data Acara Berhasil diupdate");
            echo 'sukses';
        }else{
            $session = session();
            $session->setFlashdata("error", "Data Acara Gagal diupdate");
            echo 'gagal';
        }
    }

    public function do_update_maps(){
         
        $data['maps'] = $this->request->getPost('maps');

        $update = $this->AdminModel->update_maps($data);
        if($update){
        $session = session();
            $session->setFlashdata("updated", "Data Maps Berhasil diupdate");
            echo 'sukses';
        }else{
            $session = session();
            $session->setFlashdata("error", "Data Maps Gagal diupdate");
            echo 'gagal';
        }
    }

    //upload foto mempelai
	public function do_update_foto_mempelai(){

        $groom = $this->request->getFile('foto_groom');
        $bride = $this->request->getFile('foto_bride');
        $sampul = $this->request->getFile('foto_sampul');
        $kunci = $this->request->getPost('kunci');
        $path = 'assets/users/'.$kunci;
        
        //cek folder e
        if(!file_exists($path)){
        	$create = mkdir('assets/users/'.$kunci, 0777,true);
        }
         
        if($groom != ''){ //cek dulu ini fotonya siapa
        	$avatar = $groom;
        	$pathName = 'assets/users/'.$kunci.'/groom.png';
        	if(file_exists($pathName)){
        		unlink($pathName); //hapus dulu foto yg lama
	    	} 
				$avatar->move('assets/users/'.$kunci, 'groom.png'); //upload yg baru
				echo 'uploadedgroom'; //give feedback ke jquery.. agar tampilan fotonya di ubah dgn yg baru
        }else if($bride != ''){
            $avatar = $bride;
            $pathName = 'assets/users/'.$kunci.'/bride.png';
            if(file_exists($pathName)){
                unlink($pathName);
            } 
            $avatar->move('assets/users/'.$kunci, 'bride.png');
            $this->session->set('foto_bride', 1);
            echo 'uploadedbride';
            
        }else{
            $avatar = $sampul;
            $pathName = 'assets/users/'.$kunci.'/kita.png';
            if(file_exists($pathName)){
                unlink($pathName);
            } 
            $avatar->move('assets/users/'.$kunci, 'kita.png');
            $this->session->set('foto_sampul', 1);
            echo 'uploadedsampul';
        } 	


    }
     
    public function do_update_mempelai(){
         
        $datanyaSiapa = $this->request->getPost('datanyaSiapa'); //cara cepat pake variabel :)
        $data["nama_".$datanyaSiapa] = $this->request->getPost('nama');
        $data['nama_panggilan_'.$datanyaSiapa] = $this->request->getPost('nama_panggilan');
        $data['nama_ayah_'.$datanyaSiapa] = $this->request->getPost('nama_ayah');
        $data['nama_ibu_'.$datanyaSiapa] = $this->request->getPost('nama_ibu');

        $update = $this->AdminModel->update_mempelai($data);
        if($update){
        $session = session();
            $session->setFlashdata("updated", "Data Mempelai Berhasil diupdate");
            echo 'sukses';
        }else{
            $session = session();
            $session->setFlashdata("error", "Data Mempelai Gagal diupdate");
            echo 'gagal';
        }
    }

    public function do_update_musik(){
        
        if (!$this->validate([
			'musik' => [
				'rules' => 'uploaded[musik]'
                            . '|mime_in[musik,audio/mpeg,audio/mpg,audio/x-mpeg,audio/mp3]'
                            . '|max_size[musik,2048]',
				'errors' => [
					'uploaded' => 'Harus Ada File yang diupload',
					'mime_in' => 'File Extention Harus Berupa file mp3',
					'max_size' => 'Ukuran File Maksimal 2 MB'
				],
 			]
		])) {
		    $errors = $this->validate->getError();
			session()->setFlashdata("error", $errors);
			return redirect()->back()->withInput(); 
		}
        $musik = $this->request->getFile('musik');
        $kunci = $this->request->getPost('kunci');
        $path = 'assets/users/'.$kunci;
        if(!file_exists($path)){
            $create = mkdir('assets/users/'.$kunci, 0777,true);
        }
        $pathName = 'assets/users/'.$kunci.'/musik.mp3';
        if(file_exists($pathName)){
            unlink($pathName);
        } 
        if ($musik->isValid() && !$musik->hasMoved())
		{
		    $musik->move('assets/users/'.$kunci,'musik.mp3');
		    $session = session();
		    $session->setFlashdata("success", "Musik Berhasil diperbarui");
		}else{
		    $session = session();
			$session->setFlashdata("error", "Musik Gagal diupdate");
		}
		return redirect()->back()->withInput(); 
	}

    public function do_update_fitur(){
        $data['cerita'] = $this->request->getPost('cerita');
        $data['gallery'] = $this->request->getPost('album');
        $data['komen'] = $this->request->getPost('ucapan');
        $data['lokasi'] = $this->request->getPost('lokasi');
        $data['qrcode'] = $this->request->getPost('qrcode');
        $data['prokes'] = $this->request->getPost('prokes');
        $data['hadiah'] = $this->request->getPost('hadiah');
        $update = $this->AdminModel->update_fitur($data);
        if($update){
        $session = session();
            $session->setFlashdata("updated", "Data Fitur Berhasil diupdate");
            echo 'sukses';
        }else{
            $session = session();
            $session->setFlashdata("error", "Data Fitur Gagal diupdate");
            echo 'gagal';
        }
    }

    public function do_update_domain(){
        $domain = $this->request->getPost('domain');

        if($domain != ''){
            $cek = $this->AdminModel->cek_domain($domain); //cek dulu domain yg direkuest jika sdh ada maka feedback error
            if(count($cek) > 0){
                echo 'gagal';
                exit;
            }else{
                $update = $this->AdminModel->update_domain($domain);
                if($update){
                $session = session();
            $session->setFlashdata("updated", "Data Domain Berhasil diupdate");
            echo 'sukses';
        }else{
            $session = session();
            $session->setFlashdata("error", "Data Domain Gagal diupdate");
            echo 'gagal';
        }
            }   
        }
    }
    public function tema()
	{
        $data['tema'] = $this->AdminModel->get_all_themes(); 
        $dariDB = $this->AdminModel->create_code(); 
        // contoh JRD0004, angka 3 adalah awal pengambilan angka, dan 4 jumlah angka yang diambil
        $nourut = substr($dariDB, 1, 3);
        $kodeBarangSekarang = $nourut +1;
        $data['kode'] = $kodeBarangSekarang; 
        $data['title'] = 'Tampilan Undangan';
        $data['view'] = 'admin/tampilan';
		//load view home
		return view('admin/layout', $data);
    }
    public function tema_video()
	{
        $data['tema'] = $this->AdminModel->get_all_themes_video(); 
        $data['title'] = 'Tampilan Undangan';
        $data['view'] = 'admin/tema_video';
		//load view home
		return view('admin/layout', $data);
    }
    public function do_aktif_tema()
	{
        $id = $this->request->getPost('id');
        $ganti = $this->AdminModel->aktif_tema($id);
        if($ganti){
         $session = session();
            $session->setFlashdata("updated", "Tema Berhasil diaktifkan");
            echo 'sukses';
        }else{
            $session = session();
            $session->setFlashdata("error", "Tema Gagal diaktifkan");
            echo 'gagal';
        }
    }
    public function do_nonaktif_tema()
	{
        $id= $this->request->getPost('id');
        $ganti = $this->AdminModel->nonaktif_tema($id);
        if($ganti){
         $session = session();
            $session->setFlashdata("updated", "Tema Berhasil dinonaktifkan");
            echo 'sukses';
        }else{
            $session = session();
            $session->setFlashdata("error", "Tema Gagal dinonaktifkan");
            echo 'gagal';
        }
    }
    
    
    public function upload_theme(){
        $session = session();
        $view = $this->request->getFile('viewfile');
        $asset = $this->request->getFile('assetfile');
        $namafolder = trim((string) $this->request->getPost('namatema'));

        if ($namafolder === '' || $view === null || !$view->isValid() || $asset === null || !$asset->isValid()) {
            $session->setFlashdata("error", "Data tema tidak lengkap atau file tidak valid.");
            return redirect()->to(base_url('admin/tema'));
        }

        if (!class_exists('ZipArchive')) {
            $session->setFlashdata("error", "Ekstensi ZipArchive pada server belum aktif sehingga file tidak dapat diekstrak.");
            return redirect()->to(base_url('admin/tema'));
        }

        $pathassets = FCPATH.'assets/themes/'.$namafolder;
        $pathview = APPPATH.'Views/undangan/themes/';
        $viewTarget = $pathview.$namafolder.'.php';

        helper('filesystem');

        if (is_dir($pathassets)) {
            delete_files($pathassets, true);
        } elseif (!mkdir($pathassets, 0777, true)) {
            $session->setFlashdata("error", "Folder tujuan tidak dapat dibuat.");
            return redirect()->to(base_url('admin/tema'));        
    }

            if (is_file($viewTarget)) {
            unlink($viewTarget);
        }
            try {
            $view->move($pathview, $namafolder.'.php');
        } catch (\Throwable $th) {
            $session->setFlashdata("error", "File view tema gagal disimpan.");
            return redirect()->to(base_url('admin/tema'));
        }

        $tempDir = WRITEPATH.'uploads';
        $tempName = $asset->getRandomName();

        try {
            $asset->move($tempDir, $tempName);
        } catch (\Throwable $th) {
            if (is_file($viewTarget)) {
                unlink($viewTarget);
            }
            $session->setFlashdata("error", "File assets tema gagal diunggah.");
            return redirect()->to(base_url('admin/tema'));
        }

        $zipPath = $tempDir.DIRECTORY_SEPARATOR.$tempName;
        $zip = new ZipArchive();
        $zipResult = $zip->open($zipPath);

        if ($zipResult === true) {
            $zip->extractTo($pathassets);
            $zip->close();
            unlink($zipPath);
        } else {
            unlink($zipPath);
            if (is_dir($pathassets)) {
                delete_files($pathassets, true);
                if (count(array_diff(scandir($pathassets), ['.', '..'])) === 0) {
                    rmdir($pathassets);
                }
            }
            if (is_file($viewTarget)) {
                unlink($viewTarget);
            }
            $session->setFlashdata("error", "File assets tidak dapat dibuka.");
            return redirect()->to(base_url('admin/tema'));
        }

        $data['nama_theme'] = $namafolder;
        $data['kode_theme'] = $this->request->getPost('kodetema');

        if (!$this->AdminModel->save_themes($data)) {
            if (is_dir($pathassets)) {
                delete_files($pathassets, true);
                if (count(array_diff(scandir($pathassets), ['.', '..'])) === 0) {
                    rmdir($pathassets);
                }
            }
            if (is_file($viewTarget)) {
                unlink($viewTarget);
            }
            $session->setFlashdata("error", "Tema gagal disimpan ke database.");
            return redirect()->to(base_url('admin/tema'));
        }

        $session->setFlashdata("success", "Tema Berhail diupload");
        return redirect()->to(base_url('admin/tema'));
    }
    public function delete_theme()
	{
        $id = $this->request->getPost('id');
        $nama = $this->AdminModel->get_theme($id);
        helper('filesystem'); // load the helper
        
        unlink(ROOTPATH.'app/Views/undangan/themes/'.$nama.'.php');
        delete_files('assets/themes/'.$nama, true);
        $remove = rmdir('assets/themes/'.$nama);
        $hapus = $this->AdminModel->delete_theme($id);
        
        //delete_files(ROOTPATH.'app/Views/undangan/themes/'.$nama.'.php');
        //rmdir('assets/themes/'.$nama);
        if($hapus){
        $session = session();
            $session->setFlashdata("deleted", "Tema Berhail dihapus");
            echo 'sukses';
        }else{
            $session = session();
            $session->setFlashdata("error", "Tema Gagal dihapus");
            echo 'gagal';
        }
    }
    public function upload_theme_video(){
        $view = $this->request->getFile('viewfile');
        $namafile = strtolower(str_replace(" ", "_", $this->request->getPost('namatema')));
        $pathasset = 'assets/themes_video/';
        helper('filesystem');
            $view->move($pathasset, $namafile.'.png');
            $data['nama_tema'] = $this->request->getPost('namatema');
            $data['harga'] = $this->request->getPost('hargatema');
            $data['preview'] = $namafile.'.png';
            $data['url_video'] =$this->request->getPost('urltema');
           $save = $this->AdminModel->save_themes_video($data);
           $session = session();
            $session->setFlashdata("success", "Tema Berhail diupload");
        return redirect()->to(base_url('admin/tema_video'));
        
    }
    public function update_theme_video(){
        $id = $this->request->getPost('idTema');
        $view = $this->request->getFile('viewFile');
        $namafile = strtolower(str_replace(" ", "_", $this->request->getPost('namaTema')));
        $pathasset = 'assets/themes_video/';
        helper('filesystem');
        if(!empty($view->getName())){
            unlink($pathasset.''.$namafile.'.png');
            $view->move($pathasset, $namafile.'.png');
            $data['preview'] = $namafile.'.png';
        }
            $data['nama_tema'] = $this->request->getPost('namaTema');
            $data['harga'] = $this->request->getPost('hargaTema');

            $data['url_video'] =$this->request->getPost('urlTema');
           $save = $this->AdminModel->update_themes_video($id, $data);
           $session = session();
            $session->setFlashdata("success", "Tema Berhail diupdate");
        return redirect()->to(base_url('admin/tema_video'));
        
    }
    public function delete_theme_video()
	{
        $id = $this->request->getPost('id');
        $nama = $this->request->getPost('nama');
        helper('filesystem'); // load the helper
        unlink('assets/themes_video/'.$nama);
        $hapus = $this->AdminModel->delete_theme_video($id);

        if($hapus){
        $session = session();
            $session->setFlashdata("deleted", "Tema Berhail dihapus");
            echo 'sukses';
        }else{
            $session = session();
            $session->setFlashdata("error", "Tema Gagal dihapus");
            echo 'gagal';
        }
    }
}