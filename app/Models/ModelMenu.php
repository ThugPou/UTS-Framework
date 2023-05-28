<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelMenu extends Model
{
    protected $table      = 'tbl_menu';

    public function AllData()
    {
        return $this->db->table('tbl_menu')
            ->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_menu.id_kategori')
            // ->orderBy('id_menu', 'DESC')
            ->get()
            ->getResultArray();
    }

    public function InsertData($data)
    {
        $this->db->table('tbl_menu')->insert($data);
    }

    public function UpdateData($data)
    {
        $this->db->table('tbl_menu')
            ->where('id_menu', $data['id_menu'])
            ->update($data);
    }

    public function DeleteData($data)
    {
        $this->db->table('tbl_menu')
            ->where('id_menu', $data['id_menu'])
            ->delete($data);
    }
}
