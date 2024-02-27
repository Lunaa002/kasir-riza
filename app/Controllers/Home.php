<?php

namespace App\Controllers;

use App\Models\MUser;
use CodeIgniter\Commands\Database\Seed;

class Home extends BaseController
{
    public function __construct()
    {
        $this->MUser = new MUser();
    }


    public function index()
    {
        $data = [
            'judul' => 'Login',
        ];
        return view('login', $data);
    }

    public function CekLogin()
    {
        if ($this->validate([
            'email' => [
                'label' => 'Email',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Masih Kosong!',
                ]
            ],

            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Masih Kosong!',
                ]
            ],

        ])) {
            $email = $this->request->getPost('email');
            $password = sha1($this->request->getPost('password'));
            $cek_login = $this->MUser->LoginUser($email, $password);
            if($cek_login){
                session()->set('id_user', $cek_login['id_user']);
                session()->set('nama', $cek_login['nama']);
                session()->set('level', $cek_login['level']);
                if($cek_login['level'] == 1){
                    return redirect()->to(base_url('Admin'));
                } else {
                    return redirect()->to(base_url('Penjualan'));
                }
            } else {
                session()->setFlashdata('gagal', 'Email atau Password salah!');
                return redirect()->to(base_url('Home'));
            }

        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('Home'))->withInput('validation', \Config\Services::validation());
        }
    }

    public function LogOut(){
        session()->remove('id_user');
        session()->remove('nama');
        session()->remove('level');
        session()->setFlashdata('pesan', 'Anda berhasil Logout!');
        return redirect()->to(base_url('Home'));

    }
}
