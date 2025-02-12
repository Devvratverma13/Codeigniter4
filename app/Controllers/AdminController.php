<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AdminController extends BaseController
{
    public function login()
    {
        return view('admin/login');
    }

    public function forgotPassword(){
        return view('admin/forgot-password');
    }
}
