<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;
use Illuminate\Support\Str;

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

    public function forgot()
    {
        return view('user.forgot_password');
    }

    public function submit(Request $request)
    {
        $request->validate([
            'email' => ['email', 'required', 'exists:users']
        ]);

        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send('user.forgot', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return back()->with('message', 'We have e-mailed your password reset link!');
    }

    public function reset($token)
    {
        return view('user.reset_password', ['token' => $token]);
    }

    public function submit_reset_password(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users'],
            'password' => ['required', 'min:6', 'confirmed'],
            'password_confirmation' => 'required'
        ]);

        $updatePassword = DB::table('password_resets')
            ->where([
                'email' => $request->email,
                'token' => $request->token
            ])->first();

        if (!$updatePassword) {
            return back()->withInput()->with('error', 'Invalid Token');
        }

        User::where('email', $request->email)->update([
            'password' => Hash::make($request->password)
        ]);

        DB::table('password_resets')->where([
            'email' => $request->email
        ])->delete();

        return redirect('/user')->with('message', 'Your password has been changed!');
    }
}
