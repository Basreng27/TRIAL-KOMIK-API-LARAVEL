<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Ambil kredensial dari request
        $credentials = $request->only('email', 'password');

        // Coba melakukan proses otentikasi
        if (Auth::attempt($credentials)) {
            // Jika otentikasi berhasil, dapatkan pengguna yang sedang login
            $user = Auth::user();
            // Buat token untuk pengguna
            $token = $user->createToken('API Token')->plainTextToken;

            // Kirim respons sukses
            return response()->json([
                'status' => true,
                'message' => 'Login berhasil',
                'user' => $user,
                'access_token' => $token,
            ]);
        }

        // Kirim respons gagal jika otentikasi gagal
        return response()->json([
            'status' => false,
            'message' => 'Email atau password salah',
        ], 401);
    }
}
