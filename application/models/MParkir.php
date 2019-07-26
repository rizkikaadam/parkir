<?php

// extends class Model
class MParkir extends CI_Model{
    
    //data array mobil
    /*public $dataMobil = array(
        array(
            'plat_nomor' => "B 123 34",
            'warna' => "Hitam",
            'tipe' => "SUV",
            'parkir_lot' => "isi parkir lota nanti",
            'tanggal_masuk' => "isi tanggal nanti",
            'tanggal_keluar' => "isi tanggal keluar nanti"   

        )
         ,
         array(
            'plat_nomor' => "B 456",
            'warna' => "Hitam",
            'tipe' => "SUV",
            'parkir_lot' => "isi parkir lota nanti",
            'tanggal_masuk' => "isi tanggal nanti",
            'tanggal_keluar' => "isi tanggal keluar nanti"   

        ) );*/

    // response jika field ada yang kosong
    public function empty_response(){
        $response['status']=502;
        $response['error']=true;
        $response['message']='Field tidak boleh kosong';
        return $response;
    }

    //menampilkan seluruh data pada array
    public function all_data()
    {
        $all = $this->db->get("tbl_Transaksi")->result();
        $response['person']=$all;
        return $response;
        return $response;
    }

    //Registrasi Mobil Masuk
    public function registrasi($plat_nomor,$warna,$tanggal_masuk,$tipe)
    {
        if(empty($plat_nomor) || empty($warna) || empty($tipe)){
            return $this->empty_response();
          }else{
              
            $data = array(
                    'plat_nomor' => $plat_nomor,
                    'warna' => $warna,
                    'tipe' => $tipe,
                    'tanggal_masuk' => $tanggal_masuk);

            
            $reg = $this->db->insert("tbl_Transaksi", $data);
            
            $query = $this->db->query("SELECt id from tbl_Transaksi where plat_nomor='$plat_nomor'");
            
            foreach ($query->result() as $row)
            {
                $id = $row->id;
            }

            $parLot = "A".intval($id);

            //memasukan parking lot
            $data_parlot = array(
                'parkir_lot' => $parLot
            );
            $this->db->where('plat_nomor', $plat_nomor);
            $this->db->update('tbl_Transaksi',$data_parlot);

            if($reg){
              $response['plat_nomor'] = $plat_nomor;
              $response['parking_lot'] = $parLot;
              $response['tanggal_masuk'] = $tanggal_masuk;

              return $response;
            }else{
              $response['message']='error';
              return $response;
            }
          }
    }

    //Mobil Keluar
    public function keluarParkir($plat_nomor, $tanggal_keluar)
    {
        $data = array(
            'tanggal_keluar' => $tanggal_keluar);
           
        $this->db->where('plat_nomor', $plat_nomor);
        $this->db->update('tbl_Transaksi', $data);
        
        //mengambil data tanggal masuk
        $query = $this->db->query("SELECt tanggal_masuk from tbl_Transaksi where plat_nomor='$plat_nomor'");
            
            foreach ($query->result() as $row)
            {
                $tanggal_masuk = $row->tanggal_masuk;
            }

        if(empty($plat_nomor)) {
            $response['message']='Field tipe tidak boleh kosong';
            return $response;
        } else {

            $query = $this->db->query("SELECt datediff(tanggal_keluar, tanggal_masuk) as durasi, plat_nomor, tanggal_masuk, tanggal_keluar FROM tbl_Transaksi where plat_nomor='$plat_nomor'"); 

            foreach ($query->result() as $data2)
            {
                $durasi = $data2->durasi;
            }
            if ($durasi < 1) {
                $jumlah_bayar = 25000; 
            } else {
                $jumlah_bayar = (($durasi - 1)*20000)+25000;
            };

            $data_keluar = array(
                'plat_nomor' => $plat_nomor,
                'tanggal_masuk' => $tanggal_masuk,
                'tanggal_keluar' => $tanggal_keluar,
                'jumlah_bayar'  => $jumlah_bayar
            );
            
            $this->db->where('plat_nomor', $plat_nomor);
            $this->db->delete('tbl_Transaksi');
                        
            $response['message']='Data ditemukan';
            $response['hasil'] = $data_keluar;
            
            return $response;
        }
    }

    //Report data berdasarkan warna 
    public function reportWarna($warna)
    {
        if(empty($warna)) {
            $response['message']='Field tipe tidak boleh kosong';
            return $response;
        } else {

            $this->db->where('warna',$warna);
            $this->db->select("plat_nomor");
            $find = $this->db->get("tbl_Transaksi")->result();
            

            $response['message']='Data ditemukan';
            $response['hasil'] = $find;
            return $response;
        }
    }

    //Report data berdasarkan tipe kendaraan
    public function reportTipe($tipe)
    {
        if(empty($tipe)) {
            $response['message']='Field tipe tidak boleh kosong';
            return $response;
        } else {

            $query = $this->db->query("SELECt COUNT(*) AS Jumlah_Kendaraan from tbl_Transaksi where tipe='$tipe'");

            $hitung = $query->row();
            

            $response = $hitung;
            return $response;
        }
    }
}