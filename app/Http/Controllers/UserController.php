<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Http\Request;
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

    public function stock()
    {
        $data = Stock::all();

        return view('admin.stock', ['stocks' => $data]);
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

        return redirect('/user')->with('message', 'Created Successfully');
    }

    public function process(Request $request)
    {

        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required',
        ]);

        if (auth()->attempt($validated)) {

            if (auth()->user()->role == 'admin') {
                return redirect('/admin.dashboard');
            } else {
                return redirect('/user.receiving');
            }
            // $request->session()->regenerate();

            // return redirect('/dashboard');
        }
    }

    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function updateUser(Request $request, User $user)
    {
        $validated = $request->validate([
            'last_name' => ['required'],
            'first_name' => ['required'],
            'email' => ['required'],
            'password' => ['required'],
            'account_role' => ['required'],
            'account_status' => ['required']
        ]);

        $user->update($validated);

        return redirect('/user')->with('message_update', 'Updated Successfully');
    }
}
