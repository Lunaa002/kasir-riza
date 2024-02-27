<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\MKategori;

class Kategori extends BaseController
{

    public function __construct()
    {
        $this->MKategori = new MKategori();
    }


    public function index()
    {
        $data = [

            'judul' => 'Master Data',
            'subjudul' => 'Kategori',
            'menu' => 'masterdata',
            'submenu' => 'kategori',
            'page' => 'kategori',
            'kategori' => $this->MKategori->AllData(),
        ];
        return view('template', $data);
    }

    public function TambahData()
    {
        $data = ['nama_kategori' => $this->request->getPost('nama_kategori')];
        $this->MKategori->TambahData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Ditambah!');
        return redirect()->to(base_url('kategori'));
    }

    public function EditData($id_kategori)
    {
        $data = [
            'id_kategori' => $id_kategori,
            'nama_kategori' => $this->request->getPost('nama_kategori')
        ];
        $this->MKategori->EditData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Diubah!');
        return redirect()->to(base_url('kategori'));
    }

    public function HapusData($id_kategori)
    {
        $data = [
            'id_kategori' => $id_kategori,

        ];
        $this->MKategori->HapusData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus!');
        return redirect()->to(base_url('kategori'));
    }
}
