<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AdminPagination extends BaseController
{
    public function dashboard()
    {
        return view('admin/dashboard');
    }
}
