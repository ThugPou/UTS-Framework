<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelLaporan extends Model
{
    public function DataHarian($no_faktur)
    {
        return $this->db->table('tbl_rinci_transaksi')
            ->join('tbl_menu', 'tbl_menu.kode_menu=tbl_rinci_transaksi.kode_menu')
            ->join('tbl_transaksi', 'tbl_transaksi.no_faktur=tbl_rinci_transaksi.no_faktur')
            ->join('tbl_kategori', 'tbl_kategori.nama_kategori=tbl_rinci_transaksi.nama_kategori')
            ->where('tbl_transaksi.no_faktur', $no_faktur)
            ->select('tbl_transaksi.jam')
            ->select('tbl_rinci_transaksi.no_faktur')
            ->select('tbl_rinci_transaksi.kode_menu')
            ->select('tbl_rinci_transaksi.nama_menu')
            ->select('tbl_rinci_transaksi.nama_kategori')
            ->select('tbl_rinci_transaksi.harga')
            ->groupBy('tbl_rinci_transaksi.kode_menu')
            ->selectSum('tbl_rinci_transaksi.qty')
            ->selectSum('tbl_rinci_transaksi.total_harga')
            ->get()->getResultArray();
    }
}
