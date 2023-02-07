<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use App\Models\Receiving;
use App\Models\TransferOut;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function dashboard()
    {
        $dataReceiving = Receiving::count();
        $dataTransferOut = TransferOut::count();
        $dataIssue = Issue::count();

        return view('admin.dashboard', ['dataReceiving' => $dataReceiving, 'dataTransferOut' => $dataTransferOut, 'dataIssue' => $dataIssue]);
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
            return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin');
    }
}
