<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Menu extends BaseController
{
    public function index()
    {
        $data = [
            'judul' => 'Admin',
            'subjudul' => 'Menu',
            'menu' => 'admin',
            'submenu' => 'menu',
            'page' => 'v_menu',
        ];
        return view('v_template', $data);
    }
}
