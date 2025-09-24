<?php namespace App\Models\base;

use CodeIgniter\Model;

class BerandaModel extends Model
{
    protected $themes;

    public function __construct() {

        parent::__construct();
        $db      = \Config\Database::connect();

        //mendefinisikan varible themes
        //dan 'meload' table themes
        $this->themes = $db->table('themes'); 
        $this->acara = $db->table('acara');
        $this->cerita = $db->table('cerita');
        $this->data = $db->table('data');
        $this->komen = $db->table('komen');
        $this->mempelai = $db->table('mempelai');
        $this->rules = $db->table('rules');
        $this->themes = $db->table('themes');
        $this->users = $db->table('users');
        $this->album = $db->table('album');
        $this->setting = $db->table('setting');
        $this->testimoni = $db->table('testimoni');
        $this->pembayaran = $db->table('pembayaran');
        $this->tamu = $db->table('tamu');
        $this->order = $db->table('order');
        $this->rekening = $db->table('rekening');
        $this->videos = $db->table('themes_video');
    }
    

    //mengambil semua data pada table themes
    public function get_all_themes(){
        $builder = $this->themes;
        $builder->where('status', 1);
        return $builder->get();
    }
    public function get_all_themes_video(){
        $builder = $this->videos;
        return $builder->get();
    }
    public function get_total_pengguna(){
        $builder = $this->users;
        $builder->selectCount('id');
        $query = $builder->get();
        return $query->getResult()[0]->id;
    }
    public function get_total_tema(){
        $builder = $this->themes;
        $builder->selectCount('id');
        $query = $builder->get();
        return $query->getResult()[0]->id;
    }
    public function get_total_testimoni(){
        $builder = $this->testimoni;
        $builder->selectCount('id_testi');
        $builder->where('status', '2');
        $query = $builder->get();
        return $query->getResult()[0]->id_testi;
    }
    public function get_themes_by_name($nama){
        $query = $this->themes->where('nama_theme', $nama)->get();
        return $query->getResult();
    }
    public function get_tamu($id){
        return $this->tamu->where('id_tamu', $id)->get();
    }
    public function cek_tamu($id_user, $id_tamu)
    {
    $where = "id_tamu = ".$id_tamu." AND id_user=".$id_user;
        return $this->tamu->where($where)->get();
    }

    //mengambil data user
    public function get_users()
    {
        return $this->users->get()->getResultArray();
    }

    //mengambil data mempelai sesuai dengan data(id_user) yang dikirim
    public function get_mempelai($id){
        return $this->mempelai->where('id_user', $id)->get();
    }

    //mengambil data acara sesuai dengan data(id_user) yang dikirim
    public function get_acara($id){
        return $this->acara->where('id_user', $id)->get();
    }

    //mengambil data komen sesuai dengan data(id_user) yang dikirim
    public function get_komen($id){
        return $this->komen->where('id_user', $id)->get()->getResultArray();
    }

    //mengambil data data sesuai dengan data(id_user) yang dikirim
    public function get_data($id){
        return $this->data->where('id_user', $id)->get();
    }

    //mengambil data cerita sesuai dengan data(id_user) yang dikirim
    public function get_cerita($id){
        return $this->cerita->where('id_user', $id)->get()->getResultArray();
    }

    //mengambil data cerita album dengan data(id_user) yang dikirim
    public function get_album($id){
        return $this->album->where('id_user', $id)->get()->getResultArray();
    }

    //mengambil data rules sesuai dengan data(id_user) yang dikirim
    public function get_rules($id){
        return $this->rules->where('id_user', $id)->get();
    }
    public function get_setting(){
        $builder = $this->setting;
        $builder->select('*');
        $builder->where('id', '1');
        $query = $builder->get();
        return $query->getResult();
    }
    public function get_testimoni(){
        $builder = $this->testimoni;
        $builder->select('testimoni.*,data.kunci');
        $builder->join('data', 'data.id_user = testimoni.id_user');
        $builder->where('testimoni.status', '2');
        $query = $builder->get();
        return $query;
    }
    
    public function get_pembayaran($id){
        $builder = $this->pembayaran;
        $builder->select('*');
        $builder->where('id_user', $id);
        $query = $builder->get();
        return $query->getResult();
    }
    
    public function get_all_undangan(){
        $builder = $this->tamu;
        $builder->select('mempelai.*,tamu.*, data.*,order.domain as domain_undangan, pembayaran.status');
        $builder->join('users', 'users.id = tamu.id_user');
        $builder->join('order', 'order.id_user = tamu.id_user');
        $builder->join('mempelai', 'mempelai.id_user = tamu.id_user');
        $builder->join('data', 'data.id_user = tamu.id_user');
        $builder->join('pembayaran', 'pembayaran.id_user = tamu.id_user');
        $where = "pembayaran.status = '2' AND date(tamu.tgl_kirim) = CURDATE() AND tamu.status_kirim != 'terkirim'";
        $builder->where($where);
        $builder->limit(100);
        $query = $builder->get();
        return $query->getResult();
    }
    public function get_token(){
        $builder = $this->setting;
        $builder->select('token_wa');
        $builder->where('id','1');
        $query = $builder->get();
        return $query->getResult()[0]->token_wa;
    }
    
    public function status_undangan($data,$id_tamu){
        $builder = $this->tamu;
        $builder->where('id_tamu', $id_tamu);
        return $builder->update($data);
    }
    public function get_rekening($id){
        return $this->rekening->where('id_user', $id)->get();
    }
    public function get_pembayaran_by_invoice($invoice){
        $builder = $this->pembayaran;
        $builder->select('pembayaran.*, users.*');
        $builder->join('users', 'pembayaran.id_user = users.id');
        $where = "pembayaran.status = '1' AND pembayaran.invoice = ".$invoice;
        $builder->where($where);
        $query = $builder->get();
        return $query->getResult();
    }
    public function update_pembayaran($data,$invoice){
        $builder = $this->pembayaran;
        $builder->where('invoice', $invoice);
        return $builder->update($data);
    }
} 
