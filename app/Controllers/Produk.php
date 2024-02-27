<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\MProduk;
use App\Models\MKategori;

class Produk extends BaseController
{

    public function __construct()
    {
        $this->MProduk = new MProduk();
        $this->MKategori = new MKategori();
    }


    public function index()
    {
        $data = [

            'judul' => 'Master Data',
            'subjudul' => 'Produk',
            'menu' => 'masterdata',
            'submenu' => 'produk',
            'page' => 'produk',
            'produk' => $this->MProduk->AllData(),
            'kategori' => $this->MKategori->AllData(),

        ];
        return view('template', $data);
    }

    public function TambahData()
    {
        if ($this->validate([
            'kode_produk' => [
                'label' => 'Kode Produk',
                'rules' => 'is_unique[tbl_produk.kode_produk]',
                'errors' => [
                    'is_unique' => '{field} Sudah Ada, Masukan Kode Lain!',
                ]
            ],
        ])) {
            $hargabeli = str_replace(",", "", $this->request->getPost('harga_beli'));
            $hargajual = str_replace(",", "", $this->request->getPost('harga_jual'));
            $data = [
                'kode_produk' => $this->request->getPost('kode_produk'),
                'nama_produk' => $this->request->getPost('nama_produk'),
                'harga_beli' => $hargabeli,
                'harga_jual' => $hargajual,
                'satuan' => $this->request->getPost('satuan'),
                'id_kategori' => $this->request->getPost('id_kategori'),
                'stok' => $this->request->getPost('stok'),
            ];

            $this->MProduk->TambahData($data);
            session()->setFlashdata('pesan', 'Data Berhasil Ditambah!');
            return redirect()->to(base_url('produk'));
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('Produk'))->withInput('validation', \Config\Services::validation());
        }
    }


    public function EditData($id_produk)
    {
        $hargabeli = str_replace(",", "", $this->request->getPost('harga_beli'));
        $hargajual = str_replace(",", "", $this->request->getPost('harga_jual'));
        $data = [
            'id_produk' => $id_produk, 
            'nama_produk' => $this->request->getPost('nama_produk'),
            'harga_beli' => $hargabeli,
            'harga_jual' => $hargajual,
            'satuan' => $this->request->getPost('satuan'),
            'id_kategori' => $this->request->getPost('id_kategori'),
            'stok' => $this->request->getPost('stok'),
        ];
        $this->MProduk->EditData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Diubah!');
        return redirect()->to(base_url('produk'));
    }

    public function HapusData($id_produk)
    {
        $data = [
            'id_produk' => $id_produk,
        ];
        $this->MProduk->HapusData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus!');
        return redirect()->to(base_url('produk'));
    }

}
