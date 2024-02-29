<?php

namespace App\Models;

use CodeIgniter\Database\Query;
use CodeIgniter\Model;


class MPenjualan extends Model
{



    public function NoFaktur(){
        $tgl = date('Ymd');
        $query = $this->db->query("SELECT MAX(RIGHT(no_faktur,4)) AS no_urut FROM tbl_penjualan WHERE DATE(tgl_penjualan)='$tgl'");
        $hasil = $query->getRowArray();
        if ($hasil['no_urut'] > 0){
            $tmp = $hasil['no_urut'] + 1;
            $kd = sprintf("%04s", $tmp);
        } else {
            $kd = "0001";
        }
        $no_faktur = date('Ymd') . $kd;
        return $no_faktur;
    }

    public function CekProduk($kode_produk)
    {
        return $this->db->table('tbl_produk')
        ->join('tbl_kategori', 'tbl_kategori.id_kategori=tbl_produk.id_kategori')
        ->where('kode_produk', $kode_produk)
        ->get()
        ->getRowArray();
    }

    public function AllProduk()
    {
        return $this->db->table('tbl_produk')
        ->join('tbl_kategori', 'tbl_kategori.id_kategori=tbl_produk.id_kategori')
        ->orderBy('id_produk', 'DESC')
        ->get()
        ->getResultArray();
    }


    public function InsertPenjualan($data){
        $this->db->table('tbl_penjualan')->insert($data);
    }

    public function InsertDetailPenjualan($data){
        $this->db->table('tbl_detailpenjualan')->insert($data);
    }
}
