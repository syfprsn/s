<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials=$request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)){
            $user = Auth::user();
            if ($user->level == 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->level == 'petugas') {
                return redirect()->route('petugas.index');
            } else {
                return redirect()->route('user.index');
            }
        }

        return back()->withErrors(['username' => 'Username atau password salah']);
    }

    public function showRegisterform()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|email|max:225|unique:users',
            'password' => 'required|string|min:6|convirmed',
            'nama' => 'required|string|max:225',
            'alamat' => 'required|text|max:225',
            'no_hp' => 'required|string|max:225',
        ]);

        $user=User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'level' => 'peminjam',
        ]);

        return redirect('/login')->with('sucess', 'Register Berhasil silahkan Login kembali');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}

