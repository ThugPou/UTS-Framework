<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelUser;
use App\Models\ModelMenu;
use App\Models\ModelKategori;

class Admin extends BaseController
{
    public $ModelUser;
    public $ModelMenu;
    public $ModelKategori;
    public function __construct()
    {
        $this->ModelUser = new ModelUser();
        $this->ModelMenu = new ModelMenu();
        $this->ModelKategori = new ModelKategori();
    }
    public function index()
    {
        $data = [
            'judul' => 'Dashboard',
            'subjudul' => '',
            'menu' => 'dashboard',
            'submenu' => '',
            'page' => 'v_admin',
            'user'  => $this->ModelUser->countAllResults(),
            'menue' => $this->ModelMenu->countAllResults(),
            'kategori' => $this->ModelKategori->countAllResults(),
        ];
        return view('v_template', $data);
    }

    public function Setting()
    {
        $data = [
            'judul' => 'Setting',
            'subjudul' => '',
            'menu' => 'setting',
            'submenu' => '',
            'page' => 'v_setting',
        ];
        return view('v_template', $data);
    }
}
