<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct () {
        $this->middleware(['auth', 'checkRole', 'onlyAdmin']);
    }

    public function adminHome () {
        return view ('admin.home', compact('a'));
    }
}
