<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (Auth::guard('admin')->attempt($validated)) {
            $request->session()->regenerateToken();
            return redirect('/dashboard');
        } else {
            return back();
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        return redirect('/admin');
    }
}
