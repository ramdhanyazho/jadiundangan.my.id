<?php namespace App\Controllers\base;
use PHPExcel;
use PHPExcel_IOFactory;
use CodeIgniter\Controller;
use App\Models\base\DashboardModel;
use Codenom\Midtrans;
class Dashboard extends Controller
{
    public function __construct() {
        //mengisi variable global dengan data
        $this->session = session();
        helper('form');
        helper('filesystem');
        $this->DashboardModel = new DashboardModel(); 
		$this->request = \Config\Services::request(); //memanggil class request
        $this->uri = $this->request->uri; //class request digunakan untuk request uri/url
        $this->render = \Config\Services::renderer();
        $this->midtrans = service('Midtrans');
        $this->config = config('Midtrans');
        $this->validate = \Config\Services::validation();
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['view'] = 'base/dashboard/index';
        $data['pembayaran'] = $this->DashboardModel->get_pembayaran_by_id_user();
        $data['order'] = $this->DashboardModel->get_order_by_id_user(); 
        $data['total_pengunjung'] = $this->DashboardModel->get_total_pengunjung();
        $data['total_komentar'] = $this->DashboardModel->get_total_komentar();
        $data['total_mingguan'] = $this->DashboardModel->get_total_pengunjung_mingguan();
        $data['komentar'] = $this->DashboardModel->get_all_komen();
        $data['pengunjung'] = $this->DashboardModel->get_all_pengunjung();
        $data['testimoni'] = $this->DashboardModel->get_testi_by_id_user();
        $data['setting'] = $this->DashboardModel->get_setting();
        $data['data'] = $this->DashboardModel->get_data_by_id_user();


        return view('base/dashboard/layout', $data);
        // echo $_SESSION['id'];
    }

    public function do_auth(){

        $data['email'] = $this->request->getPost('email');
        $data['password'] = md5($this->request->getPost('password'));
        $hasil = $this->DashboardModel->get_user($data);
        $setting = $this->DashboardModel->get_setting();
        if(count($hasil) > 0)
        {
            // set session
            $sess_data = array('masukUser' => TRUE, 'uname' => $hasil[0]->username, 'id' => $hasil[0]->id, 'no_wa' => $setting[0]->no_wa);
            $this->session->set($sess_data);
            return redirect()->to(base_url('user/dashboard'));
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
        if(session()->has('masukUser'))
        {
        	return redirect()->to(base_url('user/dashboard'));
        }
        $data['title'] = 'Selamat Datang!';
        $data['view'] = 'base/dashboard/auth/login';
        return view('base/dashboard/auth/layout', $data);
    }

    public function riwayat()
    {
        $data['title'] = 'Riwayat Pengunjung';
        $data['view'] = 'base/dashboard/riwayat';
        $data['total_pengunjung'] = $this->DashboardModel->get_total_pengunjung();
        $data['total_pengunjung_today'] = $this->DashboardModel->get_total_pengunjung_today();
        $data['total_mingguan'] = $this->DashboardModel->get_total_pengunjung_mingguan();
        $data['pengunjung'] = $this->DashboardModel->get_all_pengunjung();

        return view('base/dashboard/layout', $data);
    }
    
    public function do_hapus_riwayat(){
        $idpengunjung = $this->request->getPost('id');
        $hapus = $this->DashboardModel->delete_pengunjung_by_id($idpengunjung);
        if($hapus){
            $session = session();
            $session->setFlashdata("deleted", "Riwayat Pengunjung Berhasil dihapus");
            echo 'sukses';
        }else{
            $session = session();
            $session->setFlashdata("error", "Riwayat Pengunjung Gagal dihapus");
            echo 'gagal';
        }
    }
    
    public function hapusbanyakriwayat(){
        if($this->request->isAJAX()){
            $idPengunjung = $this->request->getVar('idRiwayat');
            $jmldata = count($idPengunjung);
            for ($i = 0; $i < $jmldata; $i++){
                $this->DashboardModel->delete_pengunjung_by_id($idPengunjung[$i]);
            }
            $msg = [
            'sukses' => "$jmldata data Pengunjung berhasil dihapus" 
            ];
            echo json_encode($msg);
        }
    }
    
    public function ucapan()
    {
        $data['title'] = 'Data Ucapan';
        $data['view'] = 'base/dashboard/komentar';
        $data['total_komentar'] = $this->DashboardModel->get_total_komentar();
        $data['total_komentar_today'] = $this->DashboardModel->get_total_komentar_today();
        $data['komentar'] = $this->DashboardModel->get_all_komen();

        return view('base/dashboard/layout', $data);
    }

    public function do_hapus_komentar(){
        $idkomentar = $this->request->getPost('id');
        $hapus = $this->DashboardModel->delete_komen_by_id($idkomentar);
        if($hapus){
            $session = session();
            $session->setFlashdata("deleted", "Komentar Berhasil dihapus");
            echo 'sukses';
        }else{
            $session = session();
            $session->setFlashdata("error", "Komentar Gagal dihapus");
            echo 'gagal';
        }
    }

    public function tampilan()
        {

        $data['tema'] = $this->DashboardModel->get_all_themes();
        $data['order'] = $this->DashboardModel->get_order_by_id_user();
        $data['data'] = $this->DashboardModel->get_data_by_id_user();
        $data['title'] = 'Tampilan Undangan';
        $data['view'] = 'base/dashboard/tampilan';
                //load view home
                return view('base/dashboard/layout', $data);
    }
    
    public function do_ganti_tema()
	{
        $data['theme'] = $this->request->getPost('id');
        $ganti = $this->DashboardModel->update_tema($data);
        if($ganti){
            $session = session();
            $session->setFlashdata("updated", "Tema Berhasil diupdate");
            echo 'sukses';
        }else{
            $session = session();
            $session->setFlashdata("error", "Tema Gagal diupdate");
            echo 'gagal';
        }
    }
    
    
    public function do_update_background_theme()
    {
        $order = $this->DashboardModel->get_order_by_id_user();
        $activeTheme = strtolower($order[0]->nama_theme ?? '');
        $redirect = redirect()->to(base_url('user/tampilan'));

        if ($activeTheme !== 'novianty') {
            $session = session();
            $session->setFlashdata("error", "Fitur ganti background hanya tersedia untuk tema Novianty.");
            return $redirect;
        }

        $validationRules = [
            'bg-theme' => [
                'rules' => 'uploaded[bg-theme]'
                    . '|mime_in[bg-theme,image/jpg,image/jpeg,image/png,image/gif]'
                    . '|max_size[bg-theme,2048]',
                'errors' => [
                    'uploaded' => 'Harus ada file yang diupload',
                    'mime_in' => 'File harus berformat JPG, JPEG, PNG, atau GIF',
                    'max_size' => 'Ukuran file maksimal 2 MB'
                ],
            ],
        ];

        if (!$this->validate($validationRules)) {
            $session = session();
            $session->setFlashdata("error", implode('<br>', $this->validator->getErrors()));
            return $redirect;
        }

        $background = $this->request->getFile('bg-theme');
        $data = $this->DashboardModel->get_data_by_id_user();
        $kunci = $data[0]->kunci ?? '';

        if ($kunci === '') {
            $session = session();
            $session->setFlashdata("error", "Data undangan tidak ditemukan.");
            return $redirect;
        }

        $path = 'assets/users/' . $kunci;
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $fileName = 'novianty-bg.png';
        $targetPath = $path . '/' . $fileName;
        if (file_exists($targetPath)) {
            unlink($targetPath);
        }

        $session = session();
        if ($background->isValid() && !$background->hasMoved()) {
            $background->move($path, $fileName);
            $session->setFlashdata("success", "Background tema Novianty berhasil diperbarui.");
        } else {
            $session->setFlashdata("error", "Background tema Novianty gagal diperbarui.");
        }

        return $redirect;
    }
    public function pengaturan()
	{
        $data['order'] = $this->DashboardModel->get_order_by_id_user();
        $data['fitur'] = $this->DashboardModel->get_fitur_by_id_user();
        $data['data'] = $this->DashboardModel->get_data_by_id_user();
        $data['title'] = 'Pengaturan Undangan';
        $data['view'] = 'base/dashboard/pengaturan';
		return view('base/dashboard/layout', $data);
    }

    public function do_update_fitur(){
        $data['cerita'] = $this->request->getPost('cerita');
        $data['gallery'] = $this->request->getPost('album');
        $data['komen'] = $this->request->getPost('ucapan');
        $data['lokasi'] = $this->request->getPost('lokasi');
        $data['qrcode'] = $this->request->getPost('qrcode');
        $data['prokes'] = $this->request->getPost('prokes');
        $data['hadiah'] = $this->request->getPost('hadiah');
        $update = $this->DashboardModel->update_fitur($data);
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
    public function do_update_salam(){
        $data['salam_pembuka'] = $this->request->getPost('salam_pembuka');
        $data['salam_wa_atas'] = $this->request->getPost('salam_wa_atas');
        $data['salam_wa_bawah'] = $this->request->getPost('salam_wa_bawah');
        $update = $this->DashboardModel->update_salam($data);
        if($update){
            $session = session();
            $session->setFlashdata("updated", "Salam Berhasil diupdate");
            echo 'sukses';
        }else{
            $session = session();
            $session->setFlashdata("error", "Salam Gagal diupdate");
            echo 'gagal';
        }
    }
    public function do_update_token(){
        $token_wa = $this->request->getPost('token_wa');
        
        $update = $this->DashboardModel->update_wa($token_wa);
        if($update){
            $session = session();
            $session->setFlashdata("updated", "Data Token Whatsapp Gateway Berhasil diupdate");
            echo 'sukses';
        }else{
            $session = session();
            $session->setFlashdata("error", "Data Token Whatsapp Gateway Gagal diupdate");
            echo 'gagal';
        }
    }

    public function do_update_domain(){
        $domain = $this->request->getPost('domain');
        
        if($domain != ''){
            $cek = $this->DashboardModel->cek_domain($domain); //cek dulu domain yg direkuest jika sdh ada maka feedback error
            if(count($cek) > 0){
                echo 'gagal';
                exit;
            }else{
                $update = $this->DashboardModel->update_domain($domain);
                
                if($update){
                    
                    $session = session();
            $session->setFlashdata("updated", "Data Undangan Berhasil diupdate");
            echo 'sukses';
        }else{
            $session = session();
            $session->setFlashdata("error", "Data Undangan Gagal diupdate");
            echo 'gagal';
        }
            }   
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
			return redirect()->to(base_url('user/pengaturan'));
		}
        $musik = $this->request->getFile('musik');
        $data = $this->DashboardModel->get_data_by_id_user();
        $kunci = $data[0]->kunci;
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
		return redirect()->to(base_url('user/pengaturan'));
    }

    public function mempelai()
	{
        $data['mempelai'] = $this->DashboardModel->get_mempelai_by_id_user();
        $data['data'] = $this->DashboardModel->get_data_by_id_user();
        $data['order'] = $this->DashboardModel->get_order_by_id_user();
        $data['title'] = 'Data Mempelai';
        $data['view'] = 'base/dashboard/mempelai';
      
		return view('base/dashboard/layout', $data);
		
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
				$this->session->set('foto_groom', 1);
			
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

        $update = $this->DashboardModel->update_mempelai($data);
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

     public function acara(){

        $data['acara'] = $this->DashboardModel->get_acara_by_id_user();
        $data['data'] = $this->DashboardModel->get_data_by_id_user();
        $data['order'] = $this->DashboardModel->get_order_by_id_user();
        $data['title'] = 'Data Acara';
        $data['view'] = 'base/dashboard/acara';
		return view('base/dashboard/layout', $data);
     }

    public function do_update_acara(){
         
        $datanyaSiapa = $this->request->getPost('datanyaSiapa'); //cara cepat pake variabel :)
        $data["tanggal_".$datanyaSiapa] = $this->request->getPost('tanggal');
        $data['jam_'.$datanyaSiapa] = $this->request->getPost('waktu');
        $data['tempat_'.$datanyaSiapa] = $this->request->getPost('lokasi');
        $data['alamat_'.$datanyaSiapa] = $this->request->getPost('alamat');

        $update = $this->DashboardModel->update_acara($data);
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

        $update = $this->DashboardModel->update_maps($data);
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

    public function gallery(){

        $data['album'] = $this->DashboardModel->get_album_by_id_user();
        $data['data'] = $this->DashboardModel->get_data_by_id_user();
        $data['order'] = $this->DashboardModel->get_order_by_id_user();
        $data['title'] = 'Data Gallery';
        $data['view'] = 'base/dashboard/gallery';
		return view('base/dashboard/layout', $data);
    }

    public function do_update_video(){
         
        $data['video'] = $this->request->getPost('video');

        $update = $this->DashboardModel->update_video($data);
        if($update){
            $session = session();
            $session->setFlashdata("updated", "Data Video Berhasil diupdate");
            echo 'sukses';
        }else{
            $session = session();
            $session->setFlashdata("error", "Data Video Gagal diupdate");
            echo 'gagal';
        }
    }

    // upload foto gallery
	public function do_update_gallery(){

        $avatar = $this->request->getFile('file'); //a
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
                    'id_user' => $_SESSION['id'],
                    'album' => 'album'.$i
  
                ];
                $saveAlbum = $this->DashboardModel->save_album($dataAlbum);
        		break;
        	} 
        }

       
    }

    public function do_del_gallery(){

       $id = $this->request->getPost('id');
       $kunci = $this->request->getPost('kunci');
       $file = 'assets/users/'.$kunci.'/album'.$id.'.png';
       unlink($file);
       $data['album'] = 'album'.$id;
       $data['id_user'] = $_SESSION['id'];
       $delete = $this->DashboardModel->delete_album($data);
       echo json_encode("sukses");
    }

    public function cerita(){

        $data['cerita'] = $this->DashboardModel->get_cerita_by_id_user();
        $data['order'] = $this->DashboardModel->get_order_by_id_user();
        $data['title'] = 'Data Cerita';
        $data['view'] = 'base/dashboard/cerita';
		return view('base/dashboard/layout', $data);
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
            $hpscerita = $this->DashboardModel->hapus_cerita();

            //SETELAH ITU KITA SIMPAN KE DB
            for($i=0;$i<$noTanggal;$i++){
				$tanggal_cerita = $this->session->get('tanggal_cerita'.$i);
				$judul_cerita = $this->session->get('judul_cerita'.$i);
				$isi_cerita = $this->session->get('isi_cerita'.$i);

				$dataCerita = [
					'id_user' => $_SESSION['id'],
					'tanggal_cerita' => $tanggal_cerita,
					'judul_cerita' => $judul_cerita,
					'isi_cerita' => $isi_cerita
				];

                $saveCerita = $this->DashboardModel->save_cerita($dataCerita);
            }
            $session = session();
            $session->setFlashdata("updated", "Data Cerita Berhasil diupdate");
            echo 'sukses';
            return redirect()->to(base_url('user/cerita'));
            

    }
    
     public function rekening(){
        $data['data'] = $this->DashboardModel->get_data_by_id_user();
        $data['rekening'] = $this->DashboardModel->get_rekening_by_id_user();
        $data['order'] = $this->DashboardModel->get_order_by_id_user();
        $data['title'] = 'Data Rekening';
        $data['view'] = 'base/dashboard/rekening';
		return view('base/dashboard/layout', $data);
    }

    public function do_update_rekening(){
        
        $data = $this->DashboardModel->get_data_by_id_user();
        $kunci = $data[0]->kunci;
            //HAPUS DULU SESSION SEBELUMNYA
            $jml_rekening_sebelumnya = $this->session->get('jml_rekening');

            for($i=0;$i<=$jml_rekening_sebelumnya;$i++){
                $this->session->remove('nama_bank'.$i);
                $this->session->remove('no_rekening'.$i);
                $this->session->remove('nama_pemilik'.$i);
                $this->session->remove('nama_qrcode'.$i);
                $this->session->remove('qrcode_bank'.$i);
            }

            //SEBAGAI ARRAY PENANDA
            $noBank = 0;
			$noRek = 0;
			$noNama = 0;
			$namaQr = 0;
			$fileQr = 0;
            //KITA KUMPULKAN DAN SIMPAN DATANYA DI SESSION DULU
			foreach ($this->request->getPost('nama_bank') as $value) {
                if($value == "")
                    continue;
                $this->session->set('nama_bank'.$noBank++, $value); 
                
			}

			foreach ($this->request->getPost('no_rekening') as $value) {
                if($value == "")
                continue;
                $this->session->set('no_rekening'.$noRek++, $value); 
			}

			foreach ($this->request->getPost('nama_pemilik') as $value) {
                if($value == "")
                continue;
                $this->session->set('nama_pemilik'.$noNama++, $value); 
            }
            foreach ($this->request->getPost('nama_qrcode') as $value) {
                $this->session->set('nama_qrcode'.$namaQr++, $value); 
            }

            $upload = $this->request->getFiles();
            $no = 0;
            $nomor = 1;
            foreach ($upload['qrcode_picture'] as $upl) {
                $path = 'assets/users/'.$kunci.'/rekening';
                if(!file_exists($path)){
        	    $create = mkdir($path, 0777,true);
                }
                $namafile = 'qrcode'.$nomor++.'.png';
                $nama_qrcode = $this->session->get('nama_qrcode'.$no);
                if($upl != ''){ //cek dulu ini fotonya siapa
                    if($nama_qrcode !=''){
                        $qrcode_bank = $nama_qrcode;
                    }else{
                        $qrcode_bank = $namafile;
                    }
                	$pathName = $path.'/'.$namafile;
                	if(file_exists($pathName)){
                		unlink($pathName); //hapus dulu foto yg lama
        	    	} 
        	    	$this->session->set('qrcode_bank'.$no++, $qrcode_bank); 
        			$upl->move($path, $namafile); //upload yg baru
                }else{
                    $this->session->set('qrcode_bank'.$no++, $nama_qrcode); 
                }
            }
        
            //KEMUDIAN HAPUS SEMUA DATA CERITA SEBULUMNYA
            $hpsrekening = $this->DashboardModel->hapus_rekening();

            //SETELAH ITU KITA SIMPAN KE DB
            for($i=0;$i<$noNama;$i++){
				$nama_bank = $this->session->get('nama_bank'.$i);
				$no_rekening = $this->session->get('no_rekening'.$i);
				$nama_pemilik = $this->session->get('nama_pemilik'.$i);
				$nama_qrcode = $this->session->get('nama_qrcode'.$i);
				$file_qrcode = $this->session->get('qrcode_bank'.$i);
				$urut = $i+1;
                if($file_qrcode != ''){
                    if($nama_qrcode != ''){
                        $qrcode_nama = $nama_qrcode;
                    }else{
                        $qrcode_nama = 'qrcode'.$urut.'.png';
                    }
                }else{
                    $qrcode_nama = '';
                }
				$dataRekening = [
					'id_user' => $_SESSION['id'],
					'nama_bank' => $nama_bank,
					'no_rekening' => $no_rekening,
					'nama_pemilik' => $nama_pemilik,
					'qrcode_bank'  => $qrcode_nama
				];

                $saveRekening = $this->DashboardModel->save_rekening($dataRekening);
            }
            $session = session();
            $session->setFlashdata("updated", "Data Rekening Berhasil diupdate");
            echo 'sukses';
            return redirect()->to(base_url('user/rekening'));

    }
    
    public function invoice(){
        $data['urlMidtrans'] = $this->config->urlMidtrans;
        $data['clientKey'] = $this->config->clientKey;
        $data['pembayaran'] = $this->DashboardModel->get_pembayaran_by_id_user();
        $data['user'] = $this->DashboardModel->get_user_by_id_user();
        $data['order'] = $this->DashboardModel->get_order_by_id_user();
        $data['setting'] = $this->DashboardModel->get_setting();
        $data['title'] = 'Pembayaran';
        $data['view'] = 'base/dashboard/invoice';
		return view('base/dashboard/layout', $data);
    }

    public function profil(){

        $data['user'] = $this->DashboardModel->get_user_by_id_user();
        $data['order'] = $this->DashboardModel->get_order_by_id_user();
        $data['title'] = 'Profil';
        $data['view'] = 'base/dashboard/profil';
		return view('base/dashboard/layout', $data);
    }

    public function do_update_user(){

        if($this->request->getPost('password') != ''){
            $data['password'] = md5($this->request->getPost('password'));
        }

        $data['username'] = $this->request->getPost('username');
        $data['email'] = $this->request->getPost('email');
        $data['hp'] = $this->request->getPost('hp');

        $update = $this->DashboardModel->update_user($data);
        if($update){
            $session = session();
            $this->session->set('uname', $data['username']);
            $session->setFlashdata("success", "Data Profil Berhasil diupdate");
            echo 'sukses';
        }else{ 
         $session = session();
        $session->setFlashdata("error", "Data Profil Gagal diupdate");
            echo 'gagal';
        }
       
    }

    public function do_konfirmasi(){
        $bukti = $this->request->getFile('bukti');
        $invoice = $this->request->getPost('invoice');
        $dataPembayaran['nama_lengkap'] = $this->request->getPost('nama_lengkap');
        $dataPembayaran['nama_bank'] = $this->request->getPost('nama_bank');
        $dataPembayaran['status'] = '1'; //status menunggu konfirmasi atau user sudah upload bukti
        $dataPembayaran['bukti'] = $invoice.'.png';

        if (!$bukti->isValid())
        {
            return redirect()->to(base_url('user/invoice')); //jika bukti lebih dari 2 mb tolak
        }

         //folder e
         if(!file_exists('assets/bukti')){
        	$create = mkdir('assets/bukti', 0777,true);
        }

        $pathName = 'assets/bukti/'.$invoice.'.png';
        if(file_exists($pathName)){
            unlink($pathName);
        } 

        $bukti->move('assets/bukti/',$invoice.'.png'); //uploadd

        //setelah di upload insert data ke db
        $update = $this->DashboardModel->update_pembayaran($dataPembayaran,$invoice);
        if($update){
            return redirect()->to(base_url('user/invoice'));
        }else{
            return redirect()->to(base_url('user/invoice'));
        }

    }
    public function do_pembayaran(){
        $invoice = $this->request->getPost('invoice');
        $dataPembayaran['nama_lengkap'] = $this->request->getPost('nama_lengkap');
        $dataPembayaran['status'] = '1'; //status menunggu konfirmasi atau user sudah upload bukti
        //setelah di upload insert data ke db
        $update = $this->DashboardModel->update_pembayaran($dataPembayaran,$invoice);
        if($update){
            return redirect()->to(base_url('user/invoice'));
        }else{
            return redirect()->to(base_url('user/invoice'));
        }

    }
    public function refresh_invoice(){
        $id_user = $_SESSION['id']; //ambil id user
		$today = date('ym');
	 	$kode = $today.$id_user.rand(10,99);
        //setelah di upload insert data ke db
        $update = $this->DashboardModel->refresh_invoice($kode);
        if($update){
            $session = session();
            $session->setFlashdata("success", "Invoice Berhasil diperbarui");
            echo 'sukses';
        }else{ 
         $session = session();
        $session->setFlashdata("error", "Invoice Gagal diperbarui");
            echo 'gagal';
        }

    }
    public function re_order(){
        $id_user = $_SESSION['id']; //ambil id user
		$today = date('ym');
		$data['id_user'] = $_SESSION['id']; 
	 	$data['invoice'] = $today.$id_user.rand(10,99);
        //setelah di upload insert data ke db
        foreach ($this->DashboardModel->get_setting() as $row){
            $data['harga'] = $row->harga;
        }
        $insert = $this->DashboardModel->re_order($data);
        if($insert){
            $session = session();
            $session->setFlashdata("success", "Invoice Baru Berhasil dibuat");
            echo 'sukses';
        }else{ 
         $session = session();
        $session->setFlashdata("error", "Invoice Baru Gagal dibuat");
            echo 'gagal';
        }

    }
    
    public function testimoni(){

        $data['user'] = $this->DashboardModel->get_user_by_id_user();
        $data['testimoni'] = $this->DashboardModel->get_testi_by_id_user();
        $data['order'] = $this->DashboardModel->get_order_by_id_user();
        $data['title'] = 'Testimonial';
        $data['view'] = 'base/dashboard/testimoni';
	return view('base/dashboard/layout', $data);
    }

    public function do_update_testi(){
        $data['nama_lengkap'] = $this->request->getPost('nama');
        $data['kota'] = $this->request->getPost('kota');
        $data['provinsi'] = $this->request->getPost('provinsi');
        $data['ulasan'] = $this->request->getPost('ulasan');
        $data['status'] = $this->request->getPost('status');
        $update = $this->DashboardModel->update_testi($data);
        if($update){
            $session = session();
            $session->setFlashdata("success", "Data Testimoni Berhasil disimpan");
            echo 'sukses';
        }else{
            $session = session();
            $session->setFlashdata("error", "Data Testimoni Gagal diupdate");
            echo 'gagal';
        }
       
    }
    
    public function tamu(){
        
        $data['tamu'] = $this->DashboardModel->get_tamu_by_id_user();
        $data['data'] = $this->DashboardModel->get_data_by_id_user();
        
        $data['title'] = 'Data Tamu';
        $data['view'] = 'base/dashboard/tamu';
		return view('base/dashboard/layout', $data);
     }

    public function do_update_tamu(){
         
        $data['nama_tamu'] = ucwords($this->request->getPost('nama_tamu'));
        $data['nama_slug'] = url_title($this->request->getPost('nama_tamu'), '+', TRUE);
        $data['alamat_tamu'] = ucwords($this->request->getPost('alamat_tamu'));
        $data['alamat_slug'] = url_title($this->request->getPost('alamat_tamu'), '+', TRUE);
        $data['no_wa'] = $this->request->getPost('no_wa');
        $data['tgl_kirim'] = $this->request->getPost('tgl_kirim');
        $id = $this->request->getPost('id_tamu');
        $domain= $this->DashboardModel->get_order_by_id_user()[0]->domain;
        $data['qrcode'] = md5($domain.$data['nama_slug'].$data['alamat_slug']);
        $update = $this->DashboardModel->update_tamu($data, $id);
        if($update){
            $session = session();
            $session->setFlashdata("updated", "Data tamu Berhasil diupdate");
            echo 'sukses';
        }else{
            $session = session();
            $session->setFlashdata("error", "Data tamu Gagal diupdate");
            echo 'gagal';
        }
    }
    
    public function do_save_tamu(){

        $data['id_user'] = $this->request->getPost('id_user');
        $data['nama_tamu'] = ucwords($this->request->getPost('nama_tamu'));
        $data['nama_slug'] = url_title($data['nama_tamu'], '+', TRUE);
        $data['alamat_tamu'] = ucwords($this->request->getPost('alamat_tamu'));
        $data['alamat_slug'] = url_title($data['alamat_tamu'], '+', TRUE);
        $data['no_wa'] = $this->request->getPost('no_wa');
        $data['tgl_kirim'] = $this->request->getPost('tgl_kirim');
        $domain= $this->DashboardModel->get_order_by_id_user()[0]->domain;
        $data['qrcode'] = md5($domain.$data['nama_slug'].$data['alamat_slug']);
        
         $save = $this->DashboardModel->save_tamu($data);
        if($save){
            $session = session();
            $session->setFlashdata("success", "Data tamu Berhasil ditambahkan");
            echo 'sukses';
            
        }else{
            $session = session();
            $session->setFlashdata("error", "Data tamu Gagal ditambahkan");
            echo 'gagal';
            
        }
        }
    

    public function do_hapus_tamu(){
        $id_tamu = $this->request->getPost('id_tamu');
        $data = $this->DashboardModel->get_data_by_id_user();
        $kunci = $data[0]->kunci;
        
        $hasil = $this->DashboardModel->get_tamu_by_id_tamu($id_tamu);
        $qrcode = $hasil[0]->qrcode;
        $file = 'assets/users/'.$kunci.'/'.$qrcode.'.png';
        $hapus = $this->DashboardModel->delete_tamu_by_id($id_tamu);
        if($hapus){
            if(file_exists($file)){
                unlink($file);
            }
            
            $session = session();
            $session->setFlashdata("deleted", "Data tamu Berhasil dihapus");
            echo 'sukses';
        }else{
            $session = session();
            $session->setFlashdata("error", "Data tamu Gagal dihapus");
            echo 'gagal';
        }
    }
    public function hapusbanyaktamu(){
        if($this->request->isAJAX()){
            $idTamu = $this->request->getVar('idTamu');
            
            $jmldata = count($idTamu);
            for ($i = 0; $i < $jmldata; $i++){
                $data = $this->DashboardModel->get_data_by_id_user();
                $kunci = $data[0]->kunci;
        
                $hasil = $this->DashboardModel->get_tamu_by_id_tamu($idTamu[$i]);
                $qrcode = $hasil[0]->qrcode;
                $file = 'assets/users/'.$kunci.'/'.$qrcode.'.png';
                $this->DashboardModel->delete_tamu_by_id($idTamu[$i]);
                if(file_exists($file)){
                unlink($file);
                }
            }
            
            $msg = [
            'sukses' => "$jmldata data Tamu berhasil dihapus" 
            ];
            echo json_encode($msg);
        }
    }
    public function setting_bukutamu(){
        $data['slider'] = $this->DashboardModel->get_slider_by_id_user();
        $data['mempelai'] = $this->DashboardModel->get_mempelai_by_id_user();
        $data['data'] = $this->DashboardModel->get_data_by_id_user();
        $data['order'] = $this->DashboardModel->get_order_by_id_user();
        $data['title'] = 'Setting Buku Tamu';
        $data['view'] = 'base/dashboard/setting_bukutamu';
		return view('base/dashboard/layout', $data);
		
    }
    
    public function do_update_slider_bukutamu(){
	    $avatar = $this->request->getFile('file'); //a
        $kunci = $this->request->getPost('kunci');
        $path = 'assets/users/'.$kunci;
        
        //folder e
        if(!file_exists($path)){
        	$create = mkdir('assets/users/'.$kunci, 0777,true);
        }

        //nama file e
        for($i=1;$i<=10;$i++){
        	$pathName = 'assets/users/'.$kunci.'/slider'.$i.'.png';
        	if(!file_exists($pathName)){
        		$ok = array("no"=>$i,"kunci"=>$kunci);
        		$avatar->move('assets/users/'.$kunci, 'slider'.$i.'.png');
                echo json_encode($ok);
                
                //save to db
                $dataAlbum = [
                    'id_user' => $_SESSION['id'],
                    'nama_slider' => 'slider'.$i
  
                ];
                $saveAlbum = $this->DashboardModel->save_slider($dataAlbum);
        		break;
        	} 
        }
        
     }
     public function do_del_slider_bukutamu(){

       $id = $this->request->getPost('id');
       $kunci = $this->request->getPost('kunci');
       $file = 'assets/users/'.$kunci.'/slider'.$id.'.png';
       unlink($file);
       $data['nama_slider'] = 'slider'.$id;
       $data['id_user'] = $_SESSION['id'];
       $delete = $this->DashboardModel->delete_slider_bukutamu($data);
       echo json_encode("sukses");
    }
     public function do_update_background_bukutamu(){
        
        if (!$this->validate([
			'bg-bukutamu' => [
				'rules' => 'uploaded[bg-bukutamu]'
                            . '|mime_in[bg-bukutamu,image/jpg,image/jpeg,image/gif,image/png]'
                            . '|max_size[bg-bukutamu,2048]',
				'errors' => [
					'uploaded' => 'Harus Ada File yang diupload',
					'mime_in' => 'File Extention Harus Berupa file mp3',
					'max_size' => 'Ukuran File Maksimal 2 MB'
				],
 			]
		])) {
		    $errors = $this->validate->getError();
			session()->setFlashdata("error", $errors);
			return redirect()->to(base_url('user/setting_bukutamu'));
		}
        $background = $this->request->getFile('bg-bukutamu');
        $data = $this->DashboardModel->get_data_by_id_user();
        $kunci = $data[0]->kunci;
        $path = 'assets/users/'.$kunci;
        if(!file_exists($path)){
            $create = mkdir('assets/users/'.$kunci, 0777,true);
        }
        $pathName = 'assets/users/'.$kunci.'/bg-tamu.png';
        if(file_exists($pathName)){
            unlink($pathName);
        } 
        if ($background->isValid() && !$background->hasMoved())
		{
		    $background->move('assets/users/'.$kunci,'bg-tamu.png');
		    $session = session();
		    $session->setFlashdata("success", "Background Buku Tamu Berhasil diperbarui");
		}else{
		    $session = session();
			$session->setFlashdata("error", "Background Buku Tamu Gagal diupdate");
		}
		return redirect()->to(base_url('user/setting_bukutamu'));
    }
     public function data_hadir(){

        $data['order'] = $this->DashboardModel->get_order_by_id_user(); 
        $data['data'] = $this->DashboardModel->get_data_by_id_user();
        $data['hadir'] = $this->DashboardModel->get_hadir_by_id_user();
        $data['title'] = 'Data Hadir Tamu';
        $data['view'] = 'base/dashboard/data_hadir';
		return view('base/dashboard/layout', $data);
     }
     
    public function autofill()
    {
        $qrcode =$_GET['qrcode'];
        $hasil = $this->DashboardModel->autofill($qrcode);
        
        if(count($hasil) > 0){
            foreach ($hasil as $row)
            $data[]= array('nama_tamu' => $row->nama_tamu, 'alamat_tamu' => $row->alamat_tamu, 'id_tamu' => $row->id_tamu);
            echo json_encode($data);
        } else {
        $data[]= array('nama_tamu' => '-', 'alamat_tamu' => '-');
        echo json_encode($data);
        }   
    }

    public function do_update_hadir(){
        $qrcode = $this->request->getPost('qrcode');
        $nama = $this->request->getPost('nama');
        // $id = $this->request->getPost('id');
        $cekhadir = $this->DashboardModel->cek_hadir($qrcode);
        foreach ($cekhadir->getResult() as $row)
        {   
        $id = $row->id_tamu;
        }
        if ( $nama != '-'){
	    if(is_null(($id))){
	    $update = $this->DashboardModel->update_hadir($qrcode);
        if($update){
            $session = session();
            $session->setFlashdata("success", "Data tamu Berhasil ditambahkan");
            echo 'sukses';
        }else{ 
         $session = session();
        $session->setFlashdata("error", "Data tamu Gagal diupdate");
            echo 'gagal';
        }
                
            }else{
        echo 'gagal';
                exit;
    }
    
    }else{
        echo 'gagal';
                exit;
    }
    }
    public function do_hapus_hadir(){
        $id = $this->request->getPost('id');
        $update = $this->DashboardModel->hapus_hadir($id);
        if($update){
        
            echo 'sukses';
        }else{
            echo 'gagal';
        }

    }
    public function kirim_undangan(){
	   $id_tamu = $this->request->getPost('id_tamu');
        $token_wa = $this->DashboardModel->get_token();
        foreach ($this->DashboardModel->get_all_undangan($id_tamu) as $row) {
        if($row->status_bayar == 2) {
	 	$domain = $row->domain_undangan;
	 	$id_tamu = $row->id_tamu;
                $nama_tamu = $row->nama_tamu;
                $nama_slug = $row->nama_slug;
                $alamat_tamu = $row->alamat_tamu;
                $alamat_slug = $row->alamat_slug;
                $link = urlencode(SITE_UNDANGAN.'/'.$domain.'/'.$id_tamu);
                $ayah_pria = $row->nama_ayah_pria;
                $ibu_pria = $row->nama_ibu_pria;
                $ayah_wanita = $row->nama_ayah_wanita;
                $ibu_wanita = $row->nama_ibu_wanita;
                $phone = $row->no_wa;
                $pria = $row->nama_panggilan_pria;
                $wanita = $row->nama_panggilan_wanita;
                $token_user = $row->token_wa;
                if(empty($token_user)){
                    $token = $token_wa;
                }else{
                    $token = $token_user;
                }
                
                $salam_wa_atas = $row->salam_wa_atas;
                $salam_wa_bawah = $row->salam_wa_bawah;
            $message = 'Kepada Yth: '.$nama_tamu.'

'.$salam_wa_atas.'

Silahkan lihat undangan lengkap dan detail acara di link undangan berikut:
'.$link.'

'.$salam_wa_bawah.'

Kami yang berbahagia,
*'.$pria.' & '.$wanita.'*

======================';
        $url = 'http://nusagateway.com/api/send-message.php';
        $curl = curl_init($url);
        $gateway = ['token' => $token,'phone' => $phone,'message' => $message];
         curl_setopt($curl, CURLOPT_POSTFIELDS, $gateway);
        // curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);
                    echo $response;
            $content = json_decode($response);
            $status = $content->result;
            if ($status == 'true') {
            $data['status_kirim'] = 'terkirim';
            $update = $this->DashboardModel->status_undangan($data, $id_tamu);
            $session = session();
            $session->setFlashdata("success", "Undangan Berhasil terkirim");
            echo 'sukses';
            }else{ 
                $data['status_kirim'] = 'tidak terkirim';
            $update = $this->DashboardModel->status_undangan($data, $id_tamu);
         $session = session();
        $session->setFlashdata("error", "Undangan Gagal dikirim");
            echo 'gagal';
        }

      }else{
         $session = session();
        $session->setFlashdata("error", "Undangan Gagal dikirim, harap lakukan pembayaran terlebih dahulu");
            echo 'gagal';
      }
    }
}
    public function prosesExcel()
	{
		$file = $this->request->getFile('fileexcel');
		if($file){
			$excelReader  = new PHPExcel();
			//mengambil lokasi temp file
			$fileLocation = $file->getTempName();
			//baca file
			$objPHPExcel = PHPExcel_IOFactory::load($fileLocation);
			//ambil sheet active
			$sheet	= $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
			//looping untuk mengambil data
			foreach ($sheet as $idx => $data) {
				//skip index 1 karena title excel
				if($idx==1){
					continue;
				}
				$nama_tamu = $data['A'];
				$alamat_tamu = $data['B'];
				$no_wa = $data['C'];
				$tgl_kirim = $data['D'];
				// insert data
				$nama_slug = url_title($nama_tamu, '+', TRUE);
                $alamat_slug = url_title($alamat_tamu, '+', TRUE);
                $domain= $this->DashboardModel->get_order_by_id_user()[0]->domain;
        $qrcode = md5($domain.$nama_slug.$alamat_slug);
        $dataTamu = [
                    'id_user' => $_SESSION['id'],
                    'nama_tamu' => $nama_tamu,
                    'alamat_tamu' => $alamat_tamu,
                    'nama_slug' => $nama_slug,
                    'alamat_slug' => $alamat_slug,
                    'no_wa' => $no_wa,
                    'tgl_kirim' => $tgl_kirim,
                    'qrcode' => $qrcode
  
        ];
         $save = $this->DashboardModel->save_tamu($dataTamu);
				}
		}
		session()->setFlashdata("success", "Data tamu Berhasil ditambahkan");
		return redirect()->to('/user/tamu');
		
	}
	
	 public function token()
    {
        $ordernya = $this->DashboardModel->get_pembayaran_by_id_user();
        foreach( $ordernya as $order){
            $order_id = $order->invoice;
            $harga = $order->harga;
            $email = $order->email;
            $hp = $order->hp;
        }
        // Required
        $transaction_details = array(
            'order_id' => $order_id,
            'gross_amount' => $harga // no decimal allowed for creditcard
        );
        $customer_details = array(
			'email'         => $email,
			'phone'         => $hp
		);
        // Data yang akan dikirim untuk request redirect_url.
        $credit_card['secure'] = true;
        //ser save_card true to enable oneclick or 2click
        //$credit_card['save_card'] = true;
        $transaction_data = array(
            'transaction_details' => $transaction_details,
            'customer_details'   	=> $customer_details,
            'credit_card'        => $credit_card
        );
        error_log(json_encode($transaction_data));

        $snapToken = $this->midtrans->getSnapToken($transaction_data);

        //response token
        echo $snapToken->token;
    }
    public function attemptOrder()
    {
        if ($result = \Codenom\Midtrans\Parse\JSONParse::decodeToObject($this->request->getPost('result_data'))) {
            if($result->payment_type == 'bank_transfer'){
            if(@$result->va_numbers){
                foreach ($result->va_numbers as $row){
                    $bank       = $row->bank;
                    $vaNumber   = $row->va_number;
                    $billerCode = '';

                }
            }else{
                    $bank        = 'permata';
                    $vaNumber    = $result->permata_va_number;
                    $billerCode  = '';
            }
        }elseif ($result->payment_type == 'echannel'){
                    $bank        = 'mandiri';
                    $vaNumber    = $result->bill_key;
                    $billerCode  = $result->biller_code;
        }else{
		            $bank        = 'alfamart/indomart';
		            $vaNumber    = $result->payment_code;
		            $billerCode  = '';
        }
        $order_id = $result->order_id;
            if($result->status_code == '201'){
                $status = '1';
            }elseif($result->status_code == '200'){
                $status = '2';
            }else{
                $status ='0';
            }
		$data = [
		    'status'            => $status,
            'payment_type'      => $result->payment_type,
            'nama_bank'         => $bank,
            'va_number'         => $vaNumber,
            'biller_code'       => $billerCode,
            'transaction_status'=> $result->transaction_status,
            'transaction_time'  => $result->transaction_time,
            'pdf_url'           => $result->pdf_url
        ];
            $save = $this->DashboardModel->update_pembayaran($data,$order_id);
            return redirect()->to(base_url('user/invoice'));
        }
    }

}
