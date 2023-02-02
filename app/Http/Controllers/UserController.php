<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Receiving;
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

    public function stock()
    {
        $data = Stock::all();

        return view('admin.stock', ['stocks' => $data]);
    }

    public function receive()
    {
        $data = Receiving::all();

        return view('user.receiving', ['receive' => $data]);
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

            $request->session()->regenerate();

            return redirect('/receiving');
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
