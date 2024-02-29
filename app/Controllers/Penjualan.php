<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\MPenjualan;
use App\Models\MProduk;
use CodeIgniter\HTTP\Exceptions\RedirectException;
use PSpell\Config;

class Penjualan extends BaseController
{
    public function __construct()
    {
        $this->MPenjualan = new MPenjualan();
        $this->MProduk = new MProduk();
    }

    public function index()
    {
        $cart = \Config\Services::cart();
        $data = [
            'judul' => 'Penjualan',  
            'no_faktur' => $this->MPenjualan->NoFaktur(),
            'cart' => $cart->contents(),
            'total_harga' => $cart->total(),
            'produk' => $this->MPenjualan->AllProduk(),
        ];
        return view('penjualan', $data);
    }

    public function CekProduk(){
        $kode_produk = $this->request->getPost('kode_produk');;
        $produk = $this->MPenjualan->CekProduk($kode_produk);
        if ($produk == null) {
            $data = [
                'nama_produk' => '',
                'nama_kategori' => '',
                'satuan' => '',
                'harga_jual' => '',
            ];
        } else {
            $data = [
                'nama_produk' => $produk['nama_produk'],
                'nama_kategori' => $produk['nama_kategori'],
                'satuan' => $produk['satuan'],
                'harga_jual' => $produk['harga_jual'],
            ];
        }
        echo json_encode($data);
    }

    public function InsertCart(){
        $cart = \Config\Services::cart();
        $cart->insert(array(
            'id' => $this->request->getPost('kode_produk'),
            'qty' => $this->request->getPost('qty'),
            'price' => $this->request->getPost('harga_jual'),
            'name' => $this->request->getPost('nama_produk'),
            
            //'options' => array('Size' => 'L', 'Color' => 'Red'),
        ));
        return redirect()->to(base_url('Penjualan'));
    }

    public function ViewCart(){
        $cart = \Config\Services::cart();
        $data = $cart->contents();

        echo dd($data);
    }

    public function ResetCart(){
        $cart = \Config\Services::cart();
        $data = $cart->destroy();
        return redirect()->to(base_url('Penjualan'));
    }

    public function RemoveItemCart($rowid){
        $cart = \Config\Services::cart();
        $cart->remove($rowid);
        return redirect()->to(base_url('Penjualan'));
    }

    public function SimpanTransaksi(){
        $cart = \Config\Services::cart();
        $produk = $cart->contents();
        $no_faktur = $this->MPenjualan->NoFaktur();
        $cash = str_replace(",", "", $this->request->getPost('cash'));
        $kembalian = str_replace(",", "", $this->request->getPost('kembalian'));

        foreach ($produk as $key => $value){
            $data = [
                'no_faktur' => $no_faktur,
                'kode_produk' => $value['id'],
                'harga_jual' => $value['price'],
                'qty' => $value['qty'],
                'total_harga' => $value['subtotal'],
                
            ];
            $this->MPenjualan->InsertDetailPenjualan($data);
        }
        $data = [
            'no_faktur' => $no_faktur,
            'tgl_penjualan' => date('Ymd'),
            'jam' => date(' h:i:s A'),
            'total_harga' => $cart->total(),
            'cash' => $cash,
            'kembalian' => $kembalian,
            'id_user' => session()->get('id_user'),
        ];
        $this->MPenjualan->InsertPenjualan($data);

        session()->setFlashdata('pesan', 'Transaksi Berhasil Disimpan!!');
        return redirect()->to('Penjualan');
    }
}
