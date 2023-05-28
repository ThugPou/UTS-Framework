<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelTransaksi;
use App\Models\ModelMenu;
use App\Models\ModelKategori;

class Transaksi extends BaseController
{
    public $ModelTransaksi;
    public $ModelMenu;
    public $ModelKategori;
    public function __construct()
    {
        $this->ModelTransaksi = new ModelTransaksi();
        $this->ModelMenu = new ModelMenu();
        $this->ModelKategori = new ModelKategori();
    }
    public function index()
    {
        $data = [
            'judul' => 'Transaksi',
            'no_faktur' => $this->ModelTransaksi->NoFaktur(),
            'transaksi' => $this->ModelTransaksi->AllData(),
            'menu' => $this->ModelMenu->AllData(),
            'kategori' => $this->ModelKategori->AllData(),
        ];
        return view('v_transaksi', $data);
    }

    public function CekMenu()
    {
        $kode_menu = $this->request->getPost('kode_menu');
        $menu = $this->ModelTransaksi->CekMenu($kode_menu);
        if ($menu == null) {
            $data = [
                'nama_menu' => '',
                'nama_kategori' => '',
                'harga' => '',
            ];
        } else {
            $data = [
                'nama_menu' => $menu['nama_menu'],
                'nama_kategori' => $menu['nama_kategori'],
                'harga' => $menu['harga'],
            ];
        }
        echo json_encode($data);
    }

    public function InsertData()
    {
        $data = [
            'kode_menu' => $this->request->getPost('kode_menu'),
            'nama_menu' => $this->request->getPost('nama_menu'),
            'nama_kategori' => $this->request->getPost('nama_kategori'),
            'harga' => $this->request->getPost('harga'),
            'qty' => $this->request->getPost('qty'),
        ];
        $this->ModelTransaksi->InsertData($data);
        session()->setFlashdata('pesan', 'Pesanan Masuk Keranjang');
        return redirect()->to('Transaksi');
    }

    public function DeleteData($id_rinci)
    {
        $data = [
            'id_rinci' => $id_rinci,
        ];
        $this->ModelTransaksi->DeleteData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus');
        return redirect()->to('Transaksi');
    }
}
