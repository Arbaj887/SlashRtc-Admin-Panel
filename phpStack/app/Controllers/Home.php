<?php

namespace App\Controllers;

use CodeIgniter\Controller;


class Home extends BaseController
{
    public function index()
    {
        if ($this->session->get("user") && $this->session->get("user")->userRole =='admin') {
             
            return redirect()->to('/admin'); 
        }

        return view('login'); 
    }
}