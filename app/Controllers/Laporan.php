<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\MProduk;
use App\Models\MKategori;

class Laporan extends BaseController
{
    public function __construct()
    {
        $this->MProduk = new MProduk();
        $this->MKategori = new MKategori();
    }


    public function PrintDataProduk()
    {
        $data = [

            'judul' => 'Laporan Produk',
            
            'produk' => $this->MProduk->AllData(),
            
        ];
        return view('laporan/template_print', $data);
    }
}
