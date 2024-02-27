<?php

namespace App\Models;

use CodeIgniter\Model;

class MProduk extends Model
{
    public function AllData()
    {
        return $this->db->table('tbl_produk')
        ->join('tbl_kategori', 'tbl_kategori.id_kategori=tbl_produk.id_kategori')
        ->orderBy('id_produk', 'DESC')
        ->get()
        ->getResultArray();
    }

    public function TambahData($data)
    {
        $this->db->table('tbl_produk')->insert($data);
    }

    public function EditData($data)
    {
        $this->db->table('tbl_produk')
            ->where('id_produk', $data['id_produk'])
            ->update($data);
    }

    public function HapusData($data)
    {
        $this->db->table('tbl_produk')
            ->where('id_produk', $data['id_produk'])
            ->delete($data);
    }

   
}
