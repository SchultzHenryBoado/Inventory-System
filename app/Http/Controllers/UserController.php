<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index');
    }

    public function user_profiles()
    {
        $data = User::all();

        return view('admin.user', ['user' => $data]);
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

        return redirect('/user');
    }

    // Create Users
    public function store(Request $request)
    {
        $validated = $request->validate([
            'last_name' => 'required',
            'first_name' => 'required',
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|confirmed|min:6',
            'account_status' => 'required'
        ]);

        $validated['password'] = bcrypt($validated['password']);

        User::create($validated);

        return redirect('/user_profiles');
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'last_name' => 'required',
            'first_name' => 'required',
            'email' => 'required',
            'password' => 'required|min:6',
            'account_status' => 'required'
        ]);

        $user->update($validated);

        return redirect('/user_profiles')->with('message_update', 'Updated Successfully');
    }

    public function changePass()
    {
        return view('user.change_password');
    }
}
