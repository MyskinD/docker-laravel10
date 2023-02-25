<?php

namespace App\Modules\Admin\Controllers;

use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index(): string
    {
        return view('admin');
    }
}
