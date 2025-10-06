<?php namespace App\Models\base;

use CodeIgniter\Model;

class OrderModel extends Model
{

    protected $db,$acara,$cerita,$data,$komen,$maps,$mempelai,$order,$rules,$themes,$users,$album;

    public function __construct() {

        parent::__construct();
        $this->db      = \Config\Database::connect();
        $this->acara = $this->db->table('acara');
        $this->cerita = $this->db->table('cerita');
        $this->data = $this->db->table('data');
        $this->komen = $this->db->table('komen');
        $this->maps = $this->db->table('maps');
        $this->mempelai = $this->db->table('mempelai');
        $this->order = $this->db->table('order');
        $this->rules = $this->db->table('rules');
        $this->themes = $this->db->table('themes');
        $this->users = $this->db->table('users');
        $this->album = $this->db->table('album');
        $this->pembayaran = $this->db->table('pembayaran');
        $this->testimoni = $this->db->table('testimoni');
        $this->setting = $this->db->table('setting');
    }

    //untuk mengecek domain
    //dan mengambil domain sesuai dengan data(domain) yang dikirim
    public function cek_domain($domain)
    {
        return $this->order->where('domain', $domain)->get();
    }


    public function cek_themes($kode){
        return $this->themes->where('kode_theme', $kode)->get();
    }

    public function cek_order($kode){
    	$builder = $this->db->table('data');
		$builder->select('*,pembayaran.status as statusPembayaran, order.status as statusWeb');
		$builder->join('users', 'users.id = data.id_user', 'left');
		$builder->join('order', 'users.id = order.id_user', 'left');
		$builder->join('pembayaran', 'users.id = pembayaran.id_user', 'left');
		$builder->where('data.kunci', $kode);
    	return $builder->get();

    }

     public function cek_order_domain($domain){
        // $db  = \Config\Database::connect();
        $builder = $this->db->table('data');
        $builder->select('*');
        $builder->join('users', 'users.id = data.id_user', 'left');
        $builder->join('order', 'users.id = order.id_user', 'left');
        $builder->where('order.domain', $domain);
        return $builder->get();

    }

    public function update_kode($kode,$id){
        $builder = $this->db->table('users');
        $builder->set('id_unik',$kode);
        $builder->where('id',$id);
        return $builder->update();
    }

    public function cek_email($email)
    {
        return $this->users->where('email', $email)->get();
    }

    public function save_user($data){

        $inserted = $this->users->insert($data);
        if (! $inserted) {
            return false;
        }

        return $this->db->insertID();

    }

    public function save_mempelai($data){

    	return $this->mempelai->insert($data);

    }

    public function save_order($data){

    	return $this->order->insert($data);

    }

    public function save_acara($data){

    	return $this->acara->insert($data);

    }

    public function save_cerita($data){

    	return $this->cerita->insert($data);

    }

    public function save_album($data){

    	return $this->album->insert($data);

    }

    public function save_data($data){

    	return $this->data->insert($data);

    }


    public function save_rules($data){

    	return $this->rules->insert($data);

    }
    public function get_harga(){
        $builder = $this->setting;
        $builder->select('harga');
        $builder->where('id','1');
        $query = $builder->get();
        return $query->getResult()[0]->harga;
    }
    public function get_salam(){
        $builder = $this->setting;
        $builder->select('salam_pembuka');
        $builder->where('id','1');
        $query = $builder->get();
        return $query->getResult()[0]->salam_pembuka;
    }

    public function save_pembayaran($data){

    	return $this->pembayaran->insert($data);

    }
    public function save_testimoni($data){

    	return $this->testimoni->insert($data);

    }
    public function get_setting(){
        $builder = $this->setting;
        $builder->select('*');
        $builder->where('id', '1');
        $query = $builder->get();
        return $query->getResult();
    }

}
