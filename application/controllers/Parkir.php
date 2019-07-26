<?php
require APPPATH . 'libraries/REST_Controller.php';

class Parkir extends REST_Controller {
    
    public function __construct(Type $var = null) {
        parent::__construct();
        date_default_timezone_set( 'Asia/Jakarta' );
		$this->load->helper('date');
        $this->load->model('MParkir'); //model jika nanti di perlukan
    }

    //menampilkan semua data mobil yang parkir
    public function index_get()
    {
        $response = $this->MParkir->all_data();
        $this->response($response);
    }

    //method untuk registrasi kendaraan atau kendaraan masuk
    public function registrasi_post()
    {
        $datestring = '%Y-%m-%d %h:%i:%s';
		$time = time();
        $tanggal_masuk = mdate($datestring, $time);
        
        //Lot Parkit
        $response = $this->MParkir->registrasi(
            $this->post('plat_nomor'),
            $this->post('warna'),
            $tanggal_masuk,
            $this->post('tipe')
        );
        $this->response($response);
    }

    //method untuk kendaraan keluar
    public function keluarParkir_post()
    {
        $datestring = '%Y-%m-%d %h:%i:%s';
		$time = time();
        $tanggal_keluar = mdate($datestring, $time);
        
        $response = $this->MParkir->keluarParkir(
            $this->post('plat_nomor'),
            $tanggal_keluar
          );
        $this->response($response);
    }

    //method untuk report kendarran
    public function reportWarna_post()
    {
        $response = $this->MParkir->reportWarna(
            $this->post('warna')
          );
        $this->response($response);
    }

    //method untuk report kendarran
    public function reportTipe_post()
    {
        $response = $this->MParkir->reportTipe(
            $this->post('tipe')
          );
        $this->response($response);
    }

}