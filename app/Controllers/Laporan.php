<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelTransaksi;
use App\Models\ModelMenu;
use App\Models\ModelKategori;
use App\Models\ModelLaporan;

class Laporan extends BaseController
{
    public $ModelTransaksi;
    public $ModelMenu;
    public $ModelKategori;
    public $ModelLaporan;
    public function __construct()
    {
        $this->ModelTransaksi = new ModelTransaksi();
        $this->ModelMenu = new ModelMenu();
        $this->ModelKategori = new ModelKategori();
        $this->ModelLaporan = new ModelLaporan();
    }

    public function index()
    {
        $data = [
            'judul' => 'Laporan',
            'subjudul' => 'Laporan Harian',
            'menu' => 'laporan',
            'submenu' => 'laporan-harian',
            'page' => 'v_laporan_harian',
        ];
        return view('v_template', $data);
    }

    public function PrintLaporanHarian($no_faktur)
    {
        $data = [
            'judul' => 'Laporan Harian',
            'dataharian' => $this->ModelLaporan->DataHarian($no_faktur),
            'page' => 'v_tabel_laporan_harian',
            'no_faktur' => $no_faktur,
        ];
        return view('v_template_print_laporan', $data);
    }

    public function ViewLaporanHarian()
    {
        $no_faktur = $this->request->getPost('no_faktur');
        $data = [
            'dataharian' => $this->ModelLaporan->DataHarian($no_faktur),
            'no_faktur' => $no_faktur,
        ];

        $response = [
            'data' => view('v_tabel_laporan_harian', $data)
        ];

        echo json_encode($response);
        // echo dd($this->ModelLaporan->DataHarian($tanggal));
    }
}
