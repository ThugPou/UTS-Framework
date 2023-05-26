<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelMenu;
use App\Models\ModelKategori;

class Menu extends BaseController
{
    public $ModelMenu;
    public $ModelKategori;
    public function __construct()
    {
        $this->ModelMenu = new ModelMenu();
        $this->ModelKategori = new ModelKategori();
    }

    public function index()
    {
        $data = [
            'judul' => 'Admin',
            'subjudul' => 'Menu',
            'menu' => 'admin',
            'submenu' => 'menu',
            'page' => 'v_menu',
            'menu' => $this->ModelMenu->AllData(),
            'kategori' => $this->ModelKategori->AllData(),
        ];
        return view('v_template', $data);
    }

    public function InsertData()
    {
        if ($this->validate([
            'kode_menu' => [
                'label' => 'Kode Menu',
                'rules' => 'is_unique[tbl_menu.kode_menu]',
                'errors' => [
                    'is_unique' => '{field} Sudah Ada, Masukkan Kode Lain!!'
                ]
            ],
            'id_kategori' => [
                'label' => 'Kategori',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Belum Dipilih'
                ]
            ]
        ])) {
            $data = [
                'kode_menu' => $this->request->getPost('kode_menu'),
                'nama_menu' => $this->request->getPost('nama_menu'),
                'id_kategori' => $this->request->getPost('id_kategori'),
                'harga' => $this->request->getPost('harga'),
                'stok' => $this->request->getPost('stok'),
            ];
            $this->ModelMenu->InsertData($data);
            session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan');
            return redirect()->to('Menu');
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('Menu'))->withInput('validation', \Config\Services::validation());
        }
    }

    public function UpdateData($id_menu)
    {
        if ($this->validate([
            'id_kategori' => [
                'label' => 'Kategori',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Belum Dipilih'
                ]
            ]
        ])) {
            $data = [
                'id_menu' => $id_menu,
                'nama_menu' => $this->request->getPost('nama_menu'),
                'id_kategori' => $this->request->getPost('id_kategori'),
                'harga' => $this->request->getPost('harga'),
                'stok' => $this->request->getPost('stok'),
            ];
            $this->ModelMenu->UpdateData($data);
            session()->setFlashdata('pesan', 'Data Berhasil DiUpdate');
            return redirect()->to('Menu');
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('Menu'))->withInput('validation', \Config\Services::validation());
        }
    }

    public function DeleteData($id_menu)
    {
        $data = [
            'id_menu' => $id_menu,
        ];
        $this->ModelMenu->DeleteData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus');
        return redirect()->to('Menu');
    }
}
