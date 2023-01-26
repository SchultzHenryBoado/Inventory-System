<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function user()
    {
        $data = User::all();

        return view('admin.user', ['user' => $data]);
    }

    public function company()
    {
        $dataCompany = Company::all();

        return view('admin.company', ['company' => $dataCompany]);
    }

    public function stock_profile()
    {
        return view('admin.stock');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'last_name' => ['required', 'max:255'],
            'first_name' => ['required', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|confirmed|min:6',
            'account_role' => ['required'],
            'account_status' => ['required']

        ]);


        $validated['password'] = bcrypt($validated['password']);

        User::create($validated);

        return redirect('/user');
    }

    public function process(Request $request)
    {

        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required',
        ]);

        if (auth()->attempt($validated)) {
            $request->session()->regenerate();

            return redirect('/dashboard');
        }
    }

    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
