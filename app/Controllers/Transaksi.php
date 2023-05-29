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
        $cart = \Config\Services::cart();
        $data = [
            'judul' => 'Transaksi',
            'no_faktur' => $this->ModelTransaksi->NoFaktur(),
            'menu' => $this->ModelMenu->AllData(),
            'kategori' => $this->ModelKategori->AllData(),
            'cart' => $cart->contents(),
            'grand_total' => $cart->total(),
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

    public function InsertCart()
    {

        $cart = \Config\Services::cart();
        $cart->insert(array(
            'id'    => $this->request->getPost('kode_menu'),
            'qty'   => $this->request->getPost('qty'),
            'price' => $this->request->getPost('harga'),
            'name'  => $this->request->getPost('nama_menu'),
            'options' => array(
                'kategori'  => $this->request->getPost('nama_kategori'),
            )
        ));
        return redirect()->to(base_url('Transaksi'));
    }

    public function ViewCart()
    {
        $cart = \Config\Services::cart();
        $data = $cart->contents();
        echo dd($data);
    }

    public function ResetCart()
    {
        $cart = \Config\Services::cart();
        $cart->destroy();
        return redirect()->to(base_url('Transaksi'));
    }

    public function RemoveItemCart($rowid)
    {
        $cart = \Config\Services::cart();
        $cart->remove($rowid);
        return redirect()->to(base_url('Transaksi'));
    }

    public function SimpanTransaksi()
    {
        $cart = \Config\Services::cart();
        $produk = $cart->contents();
        $no_faktur = $this->ModelTransaksi->NoFaktur();
        foreach ($produk as $key => $value) {
            $data = [
                'no_faktur' => $no_faktur,
                'kode_menu' => $value['id'],
                'nama_menu'  => $value['name'],
                'nama_kategori'  => $value['options']['kategori'],
                'harga' => $value['price'],
                'qty' => $value['qty'],
                'total_harga' => $value['subtotal'],

            ];
            $this->ModelTransaksi->InsertRinciTransaksi($data);
        }
        $data = [
            'no_faktur' => $no_faktur,
            'tgl_transaksi' => date('Y-m-d'),
            'jam' => date('H:i:s'),
            'grand_total' => $cart->total(),
        ];
        $this->ModelTransaksi->InsertTransaksi($data);
        $cart->destroy();
        session()->setFlashdata('pesan', 'Transaksi Berhasil Disimpan!');
        return redirect()->to('Transaksi');
    }
}
