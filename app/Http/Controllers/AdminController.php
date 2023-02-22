<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use App\Models\Receiving;
use App\Models\TransferOut;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function dashboard()
    {
        $dataReceiving = Receiving::count();
        $dataTransferOut = TransferOut::count();
        $dataIssue = Issue::count();

        return view('admin.dashboard', ['dataReceiving' => $dataReceiving, 'dataTransferOut' => $dataTransferOut, 'dataIssue' => $dataIssue]);
    }

    public function index()
    {
        $data = User::all();

        return view('admin.user', ['user' => $data]);
    }

    // Create Users
    public function store(Request $request)
    {
        $validated = $request->validate([
            'last_name' => 'required',
            'first_name' => 'required',
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|confirmed|min:6',
            'account_status' => 'required',
            'role' => 'required'
        ]);

        $validated['password'] = bcrypt($validated['password']);

        User::create($validated);

        return redirect('/user_profiles')->with('success', 'You created successfully!');
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'last_name' => 'required',
            'first_name' => 'required',
            'email' => 'required',
            'password' => 'required|min:6',
            'account_status' => 'required',
            'role' => 'required'
        ]);

        $user->update($validated);

        return redirect('/user_profiles')->with('updated', 'You updated successfully!');
    }
}
