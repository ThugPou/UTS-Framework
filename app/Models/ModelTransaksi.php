<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelTransaksi extends Model
{
    public function NoFaktur()
    {
        $tgl = date('Ymd');
        $query = $this->db->query("SELECT MAX(RIGHT(no_faktur,4)) as no_urut from tbl_transaksi where DATE(tgl_transaksi)='$tgl'");
        $hasil = $query->getRowArray();
        if ($hasil['no_urut'] > 0) {
            $tmp = $hasil['no_urut'] + 1;
            $kd = sprintf("%04s", $tmp);
        } else {
            $kd = "0001";
        }
        $no_faktur = date('Ymd') . $kd;
        return $no_faktur;
    }

    public function CekMenu($kode_menu)
    {
        return $this->db->table('tbl_menu')
            ->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_menu.id_kategori')
            ->where('kode_menu', $kode_menu)
            ->get()
            ->getRowArray();
    }

    public function AllData()
    {
        return $this->db->table('tbl_rinci_transaksi')
            ->get()
            ->getResultArray();
    }

    public function InsertData($data)
    {
        $this->db->table('tbl_rinci_transaksi')->insert($data);
    }

    public function DeleteData($data)
    {
        $this->db->table('tbl_rinci_transaksi')
            ->where('id_rinci', $data['id_rinci'])
            ->delete($data);
    }
}
