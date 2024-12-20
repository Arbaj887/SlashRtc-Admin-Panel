<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ChatController extends BaseController
{
    public function index()
    {
        return view('chat');
    }
}
