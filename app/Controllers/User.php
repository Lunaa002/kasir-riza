<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\MUser;

class User extends BaseController
{
    public function __construct()
    {
        $this->MUser = new MUser();
    }

    public function index()
    {
        $data = [
        
            'judul' => 'Master Data',
            'subjudul' => 'User',
            'menu' => 'masterdata',
            'submenu' => 'user',
            'page' => 'user',
            'user' => $this->MUser->AllData(),

        ];
        return view('template', $data);
    }

    public function TambahData()
    {
        $data = [
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'password' => sha1($this->request->getPost('password')),
            'level' => $this->request->getPost('level'),
        ];
        $this->MUser->TambahData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Ditambah!');
        return redirect()->to(base_url('user'));
    }

    public function EditData($id_user)
    {
        $data = [
            'id_user' => $id_user,
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'level' => $this->request->getPost('level'),
        ];
        $this->MUser->EditData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Diubah!');
        return redirect()->to(base_url('user'));
    }

    public function HapusData($id_user)
    {
        $data = [
            'id_user' => $id_user,
        ];
        $this->MUser->HapusData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus!');
        return redirect()->to(base_url('user'));
    }
}
