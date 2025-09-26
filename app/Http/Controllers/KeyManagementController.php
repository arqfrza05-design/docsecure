<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class KeyManagementController extends Controller
{
    public function index()
    {
        // Ambil semua user dengan peran user (selain admin)
        $staff = \App\Models\User::where('role', 'user')->with(['documents'])->get();
        return view('admin.key_management', compact('staff'));
    }
}
