<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $query = \App\Models\Document::with('user');
        $search = $request->input('search');
        $staff_id = $request->input('staff_id');
        $staff_name = $request->input('staff');
        if ($search) {
            $query->where('original_name', 'like', "%$search%");
        }
        if ($staff_id) {
            $query->where('user_id', $staff_id);
        }
        $documents = $query->get();
        // Untuk autocomplete staff
        $staffOptions = [];
        if ($staff_name) {
            $staffOptions = \App\Models\User::where('role', 'user')
                ->where('name', 'like', "%$staff_name%")
                ->limit(10)
                ->get(['id', 'name']);
        }
        return view('home', compact('documents', 'search', 'staff_id', 'staff_name', 'staffOptions'));
    }
}
