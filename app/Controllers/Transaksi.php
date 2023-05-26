<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelTransaksi;
use App\Models\ModelMenu;

class Transaksi extends BaseController
{

    public function __construct()
    {
        $this->ModelTransaksi = new ModelTransaksi();
    }
    public function index()
    {
        $data = [
            'judul' => 'Transaksi',
            'no_faktur' => $this->ModelTransaksi->NoFaktur(),
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
}
