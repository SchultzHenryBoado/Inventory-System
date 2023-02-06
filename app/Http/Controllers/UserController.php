<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

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

        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
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

    public function update_password(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => ['required', 'confirmed']
        ]);

        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return back()->with("error", "Old Password Doesn't match!");
        }

        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with("status", "Password changed successfully!");
    }
}
