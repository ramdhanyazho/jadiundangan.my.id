<?php namespace App\Controllers\base;

use CodeIgniter\Controller;
use App\Models\base\BerandaModel; //load BerandaModel
use App\Models\base\VideoModel; //load VideoModel
use App\Models\base\TemaModel; //load TemaModel
use App\Libraries\autoload;

class Beranda extends Controller
{

	//mendefinisikan variable agar bisa digunakan
	//secara global
	protected $BerandaModel;

	public function __construct() {
        
		$request = \Config\Services::request();

		//mengisi variable global dengan data
		$this->BerandaModel = new BerandaModel();  //load BerandaModel
		
		$request = \Config\Services::request(); //memanggil class request
		$this->uri = $request->uri; //class request digunakan untuk request uri/url
		$this->render = \Config\Services::renderer();
        $this->veritrans = service('Veritrans');
		
    }

	public function index()
	{
	    //mengambil semua data themes dari BerandaModel
		$data['tema'] = $this->BerandaModel->get_all_themes();
		$data['tema_video'] = $this->BerandaModel->get_all_themes_video();
		$data['setting'] = $this->BerandaModel->get_setting();
        $data['testimoni'] = $this->BerandaModel->get_testimoni();
        $data['total_testi'] = $this->BerandaModel->get_total_testimoni();
        $data['total_users'] = $this->BerandaModel->get_total_pengguna();
        $data['total_tema'] = $this->BerandaModel->get_total_tema();
		//load view home
		return view('base/beranda/home', $data);
	}

	 public function themes()
	{
		$model = new TemaModel();
		$data = [
            'tema' => $model->asObject()->paginate(12, 'tema'),
            'pager' => $model->pager
        ];
        $data['setting'] = $this->BerandaModel->get_setting();
		//kirim data ke view
		return view('base/beranda/tema',$data);

	}
	public function themes_video()
	{   
	    $model = new VideoModel();
		$data = [
            'tema_video' => $model->asObject()->paginate(12, 'tema'),
            'pager' => $model->pager
        ];
		$data['setting'] = $this->BerandaModel->get_setting();
		//kirim data ke view
		return view('base/beranda/tema_video',$data);

	}

	public function demo(){
		$idnya = '1'; //id user khusus demo
		$temanya = $this->uri->getSegment(3); //get tema
		$cek = $this->BerandaModel->get_themes_by_name(urldecode($temanya));
		if(count($cek) > 0){

 			//get all data
			$data['web'] = urldecode('demo');
			
			$data['mempelai'] = $this->BerandaModel->get_mempelai($idnya);
			$data['acara'] = $this->BerandaModel->get_acara($idnya);
			$data['komen'] = $this->BerandaModel->get_komen($idnya);
			$data['data'] = $this->BerandaModel->get_data($idnya);
			$data['cerita'] = $this->BerandaModel->get_cerita($idnya);
			$data['album'] = $this->BerandaModel->get_album($idnya);
			$data['rules'] = $this->BerandaModel->get_rules($idnya);
			$data['rekening'] = $this->BerandaModel->get_rekening($idnya);
			$data['pembayaran'] = $this->BerandaModel->get_pembayaran($idnya);
			$data['setting'] = $this->BerandaModel->get_setting($idnya);
			
			if($this->uri->getTotalSegments() > 3){
			$invite = $this->uri->getSegment(4); //orang yang diundang disini
			$tamunya = $this->BerandaModel->get_tamu($invite);
			$cektamu = $this->BerandaModel->cek_tamu($idnya, $invite);
			if(!empty($cektamu->getResult())){
			  foreach ($tamunya->getResult() as $row){ 
				$nama_tamu= $row->nama_tamu;
				$alamat_tamu = $row->alamat_tamu;
				$qrcode = $row->qrcode;
			  }
			  $data['invite'] = $nama_tamu;
			$data['invite_slug'] = preg_replace('/%20/', '+', $nama_tamu);
			$data['alamat_tamu'] = $alamat_tamu;
			$data['alamat_slug'] = preg_replace('/%20/', '+', $alamat_tamu);
			$data['qrcode'] = $qrcode;
			}else{
			$nama_tamu= 'Tamu Undangan';
			$alamat_tamu = 'Di Tempat';
			  $data['invite'] = $nama_tamu;
			$data['invite_slug'] = preg_replace('/%20/', '+', $nama_tamu);
			$data['alamat_tamu'] = $alamat_tamu;
			$data['alamat_slug'] = preg_replace('/%20/', '+', $alamat_tamu);
			$data['qrcode'] = 'Tidak Ada Qrcode';
			}
			}else{
			$nama_tamu= 'Tamu Undangan';
			$alamat_tamu = 'Di Tempat';
			$data['invite'] = $nama_tamu;
			$data['invite_slug'] = preg_replace('/%20/', '+', $nama_tamu);
			$data['alamat_tamu'] = $alamat_tamu;
			$data['alamat_slug'] = preg_replace('/%20/', '+', $alamat_tamu);
			$data['qrcode'] = 'Tidak Ada Qrcode';
			}
			
			//insert traffic to db
			if($nama_tamu != NULL){
				$dataTraffic['nama_pengunjung'] = urldecode($nama_tamu);
			}else{
				$dataTraffic['nama_pengunjung'] = "Unknown";
			}
			return view('undangan/themes/'.$temanya, $data);

		}else{
			echo "Tidak ada apapun disini!";
		}

	}

	public function youtube()
	{
		return view('base/youtube');
	}

	public function maps()
	{
		return view('base/maps');
	}
	public function import_tamu()
	{
		return view('base/import_tamu');
	}

	public function kirim_undangan(){
	    
        $token_wa = $this->BerandaModel->get_token();
        foreach ($this->BerandaModel->get_all_undangan() as $row) {
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
            $update = $this->BerandaModel->status_undangan($data, $id_tamu);
            }else{ 
                $data['status_kirim'] = 'tidak terkirim';
            $update = $this->BerandaModel->status_undangan($data, $id_tamu);
        }
           
       }
    }
    public function notification()
    {
        $json_result = file_get_contents('php://input');
        $result = json_decode($json_result);

        if ($result) {
            $notif = $this->veritrans->getStatus($result->order_id);
        }

        error_log(print_r($result, TRUE));

        //notification handler sample

        $transaction = $notif->transaction_status;
        $order_id = $result->order_id;
        $token = $this->BerandaModel->get_token();
        foreach( $this->BerandaModel->get_pembayaran_by_invoice($order_id) as $order){
            $phone = $order->hp;
        }
        if($notif->status_code == '200'){
            $status = '2';
            $message = 'Halo Kak, Terima Kasih Sudah Memesan Undangan Digital '.DOMAIN_UTAMA.'
            
Pembayaran Anda #'.$order_id.' Telah Berhasil.

*Terima Kasih Dan Sukses Selalu*';
        }else{
            $status ='0';
             $message = 'Halo Kak, Terima Kasih Sudah Memesan Undangan Digital '.DOMAIN_UTAMA.'
            
Pembayaran Anda #'.$order_id.' Gagal, Silahkan Ulangi Kembali.

*Terima Kasih Dan Sukses Selalu*';
        }
        $data = [
                'created_at' => date('Y-m-d H:i:s'),
                'status' => $status,
                'transaction_status' => $transaction
                ];
        $save = $this->BerandaModel->update_pembayaran($data,$order_id);
        
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
    }
    
}
