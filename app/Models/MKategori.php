<?php

namespace App\Models;

use CodeIgniter\Model;

class MKategori extends Model
{
    public function AllData()
    {
        return $this->db->table('tbl_kategori')->get()->getResultArray();
    }

    public function TambahData($data)
    {
        $this->db->table('tbl_kategori')->insert($data);
    }

    public function EditData($data)
    {
        $this->db->table('tbl_kategori')
            ->where('id_kategori', $data['id_kategori'])
            ->update($data);
    }

    public function HapusData($data)
    {
        $this->db->table('tbl_kategori')
            ->where('id_kategori', $data['id_kategori'])
            ->delete($data);
    }
}
